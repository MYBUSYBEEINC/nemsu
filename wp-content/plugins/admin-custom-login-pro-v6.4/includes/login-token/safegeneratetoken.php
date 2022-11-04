<?php
/* Genrate token and save */

class Generatetoken {
	/**
	 * This class will generate the username, password and access token for new user
	 * If user is already exist and its login period is expired then it will also renew
	 */

	public $user_form_value;

	public function __construct() {

	}

	public function get_form_data( $user_data ) {
		$this->user_form_value = $user_data;
	}

	public function create_new_user() {
		$first_name   = $this->user_form_value['first_name'];
		$last_name    = $this->user_form_value['last_name'];
		$new_user_eid = sanitize_email( $this->user_form_value['new_user_eid'] );
		$role_user    = $this->user_form_value['role_user'];
		//$expiry = $this->user_form_value['expiry'];
		$password         = self::generate_password();
		$expiry_option    = ! empty( $this->user_form_value['expiry'] ) ? $this->user_form_value['expiry'] : 'day';
		$date             = ! empty( $this->user_form_value['custom_date'] ) ? $this->user_form_value['custom_date'] : '';
		$user_exist_check = self::check_user( $new_user_eid );
		if ( $user_exist_check == 0 ) {
			$user_data = array(
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'user_pass'  => $password,
				'user_email' => $new_user_eid,
				'user_login' => $new_user_eid,

				'role' => $role_user
			);
			$user_id   = wp_insert_user( $user_data );
			add_action( 'admin_init', array( $this, 'wp_insert_user' ) );
			/* update the user meta field */
			if ( is_wp_error( $user_id ) ) {
				$code              = $user_id->get_error_code();
				$result['errcode'] = $code;
				$result['message'] = $user_id->get_error_message( $code );
			} else {
				$wacl_token = self::generate_wacl_token( $user_id );
				$expiry     = self::get_user_expire_time( $expiry_option, $date );
				update_user_meta( $user_id, 'wacl_user', true );
				update_user_meta( $user_id, 'wacl_created', self::get_current_gmt_timestamp() );
				update_user_meta( $user_id, 'wacl_token', $wacl_token );
				update_user_meta( $user_id, 'wacl_expiry', $expiry );

				update_user_meta( $user_id, 'show_welcome_panel', 0 );
			}

		}
	}

	/**
	 * Check User Exist or Not for new Token generation.
	 *
	 * @return 0 or 1
	 */
	private function check_user( $new_user_eid ) {
		$exist = email_exists( $new_user_eid );
		if ( ! $exist ) {
			return 0;
		} else {
			return 1;
		}
	}

	/**
	 * Generate password for new user.
	 *
	 * @return string
	 */
	public static function generate_password() {
		return wp_generate_password( absint( 15 ), true, false );

	}

	/**
	 * Generate Token.
	 *
	 * @return string
	 */
	public static function generate_wacl_token( $user_id ) {
		$str = $user_id . time() . uniqid( '', true );

		return md5( $str );
	}


	/**
	 * Checks whether user is valid temporary user
	 *
	 * @param int $user_id
	 * @param bool $check_expiry
	 *
	 * @return bool
	 */
	public static function is_valid_temporary_login( $user_id = 0, $check_expiry = true ) {

		if ( empty( $user_id ) ) {
			return false;
		}

		$check = get_user_meta( $user_id, 'wacl_user', true );

		if ( ! empty( $check ) && $check_expiry ) {
			$check = ! ( self::is_login_expired( $user_id ) );
		}

		return ! empty( $check ) ? true : false;

	}

	/**
	 * Check if temporary login expired
	 *
	 * @since 1.0
	 *
	 * @param int $user_id
	 *
	 * @return bool
	 */
	public static function is_login_expired( $user_id = 0 ) {

		if ( empty( $user_id ) ) {
			$user_id = get_current_user_id();
		}

		if ( empty( $user_id ) ) {
			return false;
		}

		$expire = get_user_meta( $user_id, 'wacl_expiry', true );

		return ! empty( $expire ) && self::get_current_gmt_timestamp() >= floatval( $expire ) ? true : false;

	}

	/**
	 * Get current GMT date time
	 *
	 *
	 * @return false|int
	 */
	public static function get_current_gmt_timestamp() {
		return strtotime( gmdate( 'Y-m-d H:i:s', time() ) );

	}

	/**
	 * Get the expiration time based on string
	 *
	 * @param string $expiry_option
	 * @param string $date
	 *
	 *
	 * @return false|float|int
	 */
	public static function get_user_expire_time( $expiry_option = 'day', $date = '' ) {

		$timestamps = array(
			'3_days'      => DAY_IN_SECONDS * 3,
			'day'         => DAY_IN_SECONDS,
			'3_hours'     => HOUR_IN_SECONDS * 3,
			'hour'        => HOUR_IN_SECONDS,
			'week'        => WEEK_IN_SECONDS,
			'month'       => MONTH_IN_SECONDS,
			'custom_date' => strtotime( $date ),
		);

		$expiry_option = in_array( $expiry_option, array_keys( $timestamps ) ) ? $expiry_option : 'day';

		$current_timestamp = self::get_current_gmt_timestamp();

		if ( 'custom_date' === $expiry_option ) {
			$current_timestamp = 0;
		}

		$timestamp = $timestamps[ $expiry_option ];

		return $current_timestamp + floatval( $timestamp );

	}

	/**
	 * Get Temporary Logins
	 *
	 * @since 1.0
	 *
	 * @param string $role
	 *
	 * @return array|bool
	 */
	public static function get_temporary_logins( $role = '' ) {

		$args = array(
			'fields'     => 'all',
			'meta_key'   => 'wacl_expiry',
			'order'      => 'DESC',
			'orderby'    => 'meta_value',
			'meta_query' => array(
				0 => array(
					'key'   => 'wacl_user',
					'value' => 1,
				),
			),
		);

		if ( ! empty( $role ) ) {
			$args['role'] = $role;
		}

		$users = new WP_User_Query( $args );

		$users_data = $users->get_results();

		return $users_data;

	}


	/**
	 * Get the redable time elapsed string
	 *
	 * @since 1.0
	 *
	 * @param int $time
	 * @param bool $ago
	 *
	 * @return string
	 */
	public static function time_elapsed_string( $time, $ago = false ) {

		if ( $ago ) {
			$etime = self::get_current_gmt_timestamp() - $time;
		} else {
			$etime = $time - self::get_current_gmt_timestamp();
		}

		if ( $etime < 1 ) {
			return __( 'Expired', 'temporary-login-without-password' );
		}

		$a = array(
			// 365 * 24 * 60 * 60 => 'year',
			// 30 * 24 * 60 * 60 => 'month',
			24 * 60 * 60 => 'day',
			60 * 60      => 'hour',
			60           => 'minute',
			1            => 'second',
		);

		$a_plural = array(
			'year'   => 'years',
			'month'  => 'months',
			'day'    => 'days',
			'hour'   => 'hours',
			'minute' => 'minutes',
			'second' => 'seconds',
		);

		foreach ( $a as $secs => $str ) {
			$d = $etime / $secs;

			if ( $d >= 1 ) {
				$r = round( $d );

				$time_string = ( $r > 1 ) ? $a_plural[ $str ] : $str;

				if ( $ago ) {
					return __( sprintf( '%d %s ago', $r, $time_string ), 'temporary-login-without-password' );
				} else {
					return __( sprintf( '%d %s remaining', $r, $time_string ), 'temporary-login-without-password' );
				}
			}
		}

		return __( 'Expired', 'temporary-login-without-password' );

	}

	/**
	 * Prepare single user row
	 *
	 * @param WP_User|int $user WP_User object.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public static function prepare_single_user_row( $user = OBJECT ) {
		global $wpdb;
		if ( is_numeric( $user ) && ! is_object( $user ) ) {
			$user = get_user_by( 'id', $user );
		}

		$expire          = get_user_meta( $user->ID, 'wacl_expiry', true ); // phpcs:ignore
		$last_login_time = get_user_meta( $user->ID, 'wacl_lastlogin', true ); // phpcs:ignore

		$last_login_str = __( 'Not yet logged in', 'temporary-login-without-password' );
		if ( ! empty( $last_login_time ) ) {
			$last_login_str = self::time_elapsed_string( $last_login_time, true );
		}

		$wtlwp_status = 'Active';
		if ( self::is_login_expired( $user->ID ) ) {
			$wtlwp_status = 'Expired';
		}

		if ( is_multisite() && is_super_admin( $user->ID ) ) {
			$user_role = __( 'Super Admin', 'temporary-login-without-password' );
		} else {
			$capabilities = $user->{$wpdb->prefix . 'capabilities'};
			$wp_roles     = new WP_Roles();
			$user_role    = '';
			foreach ( $wp_roles->role_names as $role => $name ) {
				if ( array_key_exists( $role, $capabilities ) ) {
					$user_role = $name;
				}
			}
		}

		$user_details = '<div><span>';
		if ( ( esc_attr( $user->first_name ) ) ) {
			$user_details .= '<span>' . esc_attr( $user->first_name ) . '</span>';
		}

		if ( ( esc_attr( $user->last_name ) ) ) {
			$user_details .= '<span> ' . esc_attr( $user->last_name ) . '</span>';
		}

		$user_details .= "  (<span class='wtlwp-user-login'>" . esc_attr( $user->user_login ) . ')</span><br />';

		if ( ( esc_attr( $user->user_email ) ) ) {
			$user_details .= '<span><b>' . esc_attr( $user->user_email ) . '</b></span> <br />';
		}

		$user_details .= '</span></div>';

		$row = '';

		$row .= '<tr id="single-user-' . absint( $user->ID ) . '" class="tempadmin-single-user-row">';
		$row .= '<td class="email column-details" colspan="2">' . $user_details . '</td>';
		$row .= '<td class="wtlwp-token column-role">' . esc_attr( $user_role ) . '</td>';
		$row .= '<td class="wtlwp-token column-last-login">' . esc_attr( $last_login_str ) . '</td>';

		$row .= '<td class="expired column-expired wtlwp-status-' . strtolower( $wtlwp_status ) . '">';
		if ( ! empty( $expire ) ) {
			$row .= self::time_elapsed_string( $expire );
		}
		$row .= '</td>';
		$row .= '<td class="wtlwp-token column-email">' . self::prepare_row_actions( $user, $wtlwp_status ) . '</td>';
		$row .= '</tr>';

		return $row;
	}


	/**
	 * Prepare user actions row.
	 *
	 * @param WP_User $user WP_User object.
	 * @param string $wtlwp_status Current wtlwp_status.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public static function prepare_row_actions( $user, $wtlwp_status ) {

		$is_active = ( 'active' === strtolower( $wtlwp_status ) ) ? true : false;
		$user_id   = $user->ID;
		$email     = $user->user_email;

		$delete_login_url     = self::get_manage_login_url( $user_id, 'delete' );
		$update_login_url     = add_query_arg(
			array(
				'page'    => 'wp-temporary-login-without-password',
				'user_id' => $user_id,
				'action'  => 'update',
			), admin_url( 'users.php' )
		);
		$disable_login_url    = self::get_manage_login_url( $user_id, 'disable' );
		$enable_login_url     = self::get_manage_login_url( $user_id, 'enable' );
		$temporary_login_link = self::get_login_url( $user_id );
		//$mail_to_link         = self::generate_mailto_link( $email, $temporary_login_link );
		$mail_to_link = "";

		$action_row = '<div class="actions">';

		if ( $is_active ) {
			$action_row .= "<span class='disable'><a title='" . __( 'Disable', 'temporary-login-without-password' ) . "' href='{$disable_login_url}'><span class='dashicons dashicons-unlock'></span></a></span>";
		} else {
			$action_row .= "<span class='enable'><a title='" . __( 'Reactivate for one day', 'temporary-login-without-password' ) . "' href='{$enable_login_url}'><span class='dashicons dashicons-lock'></a></span></span>";
		}

		$action_row .= "<span class='delete'><a title='" . __( 'Delete', 'temporary-login-without-password' ) . "' href='{$delete_login_url}'><span class='dashicons dashicons-no'></span></a></span>";
		$action_row .= "<span class='edit'><a title='" . __( 'Edit', 'temporary-login-without-password' ) . "' href='{$update_login_url}'><span class='dashicons dashicons-edit'></span></a></span>";

		// Shows these link only if temporary login active.
		if ( $is_active ) {
			$action_row .= "<span class='email'><a title='" . __( 'Email login link', 'temporary-login-without-password' ) . "' href='{$mail_to_link}'><span class='dashicons dashicons-email'></span></a></span>";
			$action_row .= "<span class='copy'><span id='text-{$user_id}' class='dashicons dashicons-admin-links wtlwp-copy-to-clipboard' title='" . __( 'Copy login link', 'temporary-login-without-password' ) . "' data-clipboard-text='{$temporary_login_link}'></span></span>";
			$action_row .= "<span id='copied-text-{$user_id}' class='copied-text-message'></span>";
		}

		$action_row .= '</div>';

		return $action_row;
	}


	/**
	 * Get temporary login manage url
	 *
	 * @since 1.0
	 *
	 * @param $user_id
	 * @param string $action
	 *
	 * @return string
	 */
	public static function get_manage_login_url( $user_id, $action = '' ) {

		if ( empty( $user_id ) || empty( $action ) ) {
			return '';
		}

		$base_url = menu_page_url( 'wp-temporary-login-without-password', false );
		$args     = array();

		$valid_actions = array( 'disable', 'enable', 'delete', 'update' );
		if ( in_array( $action, $valid_actions ) ) {
			$args = array(
				'wtlwp_action' => $action,
				'user_id'      => $user_id,
			);
		}

		$manage_login_url = '';
		if ( ! empty( $args ) ) {
			$base_url         = add_query_arg( $args, trailingslashit( $base_url ) );
			$manage_login_url = wp_nonce_url( $base_url, 'manage-temporary-login_' . $user_id, 'manage-temporary-login' );
		}

		return $manage_login_url;

	}


	/**
	 * Get temporary login url
	 *
	 * @since 1.0
	 *
	 * @param $user_id
	 *
	 * @return string
	 */
	public static function get_login_url( $user_id ) {

		if ( empty( $user_id ) ) {
			return '';
		}

		$is_valid_temporary_login = self::is_valid_temporary_login( $user_id, false );
		if ( ! $is_valid_temporary_login ) {
			return '';
		}

		$wtlwp_token = get_user_meta( $user_id, '_wtlwp_token', true );
		if ( empty( $wtlwp_token ) ) {
			return '';
		}

		$login_url = add_query_arg( 'wtlwp_token', $wtlwp_token, trailingslashit( admin_url() ) );

		return $login_url;

	}


	/**
	 * Get the List of Temp Users
	 *
	 * @param user name
	 * @param user detail
	 * @param access link
	 *
	 *
	 */
	public function get_list_users() {
		$users = self::get_temporary_logins();
		if ( is_array( $users ) && count( $users ) > 0 ) {

			foreach ( $users as $user ) {
				echo self::prepare_single_user_row( $user );
			}
		} else {
			//echo Wp_Temporary_Login_Without_Password_Layout::prepare_empty_user_row();
		}
	}

} /* class end*/

?>
