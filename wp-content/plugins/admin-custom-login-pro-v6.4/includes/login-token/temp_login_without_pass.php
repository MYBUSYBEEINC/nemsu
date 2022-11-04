<?php
require_once( 'generatetoken.php' );

class Temp_login_without_pass extends Generatetoken {
	/**
	 * This class will check the access token and validate user
	 * If access token is expired it won't allow a user to login and give an error message
	 * This class will initiate just after the plugin load and run wp authentication
	 */

	public function __construct() {
		//$this->login_user();
		add_action( 'init', array( $this, 'login_user' ) );
	}

	/**
	 * This function will check that a user is logged in or not and get the access coming from URL
	 * Validate the access token
	 */

	/*
		public function login_user(){
		if( !is_user_logged_in() && !empty($_GET['wacl_token'])){
			$wacl_token = $_GET['wacl_token'];
			//$token = self::fetch_user_info($wacl_token);
			echo $wacl_token."<br>";
			$users       = Generatetoken::get_valid_user_based_on_wtlwp_token( $wacl_token );
			//print_r($users);
			$user = $users[0];
			echo "<pre>";
			var_dump($user);
			echo "</pre>";
			exit();
		}

	}
	*/

	public function login_user() {
		if ( ! is_user_logged_in() && ! empty( $_GET['wacl_token'] ) ) {
			echo $wacl_token = $_GET['wacl_token'];
			//$token = self::fetch_user_info($wacl_token);
			if ( ! empty( $wacl_token ) ) {
				$users = Generatetoken::get_valid_user_based_on_wtlwp_token( $wacl_token );
				if ( empty( $users ) ) {
					wp_safe_redirect( home_url() );
				} else {
					$user = $users[0];

					$user_id    = $user->ID;
					$user_login = $user->login;

					wp_set_current_user( $user_id, $user_login );
					wp_set_auth_cookie( $user_id );

					$redirect_to     = admin_url();
					$redirect_to_url = apply_filters( 'login_redirect', $redirect_to, isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '', $user );

					do_action( 'wp_login', $user_login, $user );

					// If empty redirect user to admin page.
					if ( ! empty( $redirect_to_url ) ) {
						$redirect_to = $redirect_to_url;
					}

					wp_safe_redirect( $redirect_to ); // Redirect to given url after successfull login.
				}
				exit();
			}
		}

		/**
		 *
		 * @param This will check current user is logged in or not
		 * @param If user is logged in then check for block pages
		 * @param If he is on page listed in block pages then error message will be throne and user cam't see the page
		 *
		 *
		 */

		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();
			if ( is_user_logged_in() ) {
				$user_id = get_current_user_id();
				if ( ! empty( $user_id ) && Generatetoken::is_valid_temporary_login( $user_id, false ) ) {
					if ( Generatetoken::is_login_expired( $user_id ) ) {
						wp_logout();
						wp_safe_redirect( home_url() );
						exit();
					} else {
						global $pagenow;
						$bloked_pages = Generatetoken::get_blocked_pages();
						$page         = ! empty( $_GET['page'] ) ? $_GET['page'] : '';
						if ( ! empty( $page ) && in_array( $page, $bloked_pages ) || ( ! empty( $pagenow ) && ( in_array( $pagenow, $bloked_pages ) ) ) || ( ! empty( $pagenow ) && ( 'users.php' === $pagenow && isset( $_GET['action'] ) && ( 'deleteuser' === $_GET['action'] || 'delete' === $_GET['action'] ) ) ) ) {
							wp_die( esc_attr__( "Access Denied", 'temporary-login-without-password' ) );
						}
					}
				}


			}
		}
	}

	/**
	 * This function will check the request is vaild or not
	 * Validate the access token
	 * Fetch User Info
	 */

	private function fetch_user_info( $wacl_token ) {
		if ( empty( $wacl_token ) ) {
			return false;
		} else {
			$user_id = get_user_meta( $wacl_token, 'user_id', true );

			return $user_id;
		}
	}
} /* class end */
?>