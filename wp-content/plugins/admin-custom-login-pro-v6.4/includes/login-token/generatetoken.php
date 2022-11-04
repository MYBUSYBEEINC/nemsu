<?php
/* Genrate token and save */
if ( ! class_exists( 'Generatetoken' ) ) {
	class Generatetoken {
		/**
		 * This class will generate the username, password and access token for new user
		 * If user is already exist and its login period is expired then it will also renew
		 */

		public $user_form_value;

		public function __construct() {
			global $wpdb;
			$this->db = $wpdb;
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
		 * Get the redable time elapsed string
		 *
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
		 * Generate The Access URL
		 *
		 *
		 */
		public static function get_login_url( $user_id ) {
			$wacl_token = get_user_meta( $user_id, 'wacl_token', true );
			if ( empty( $wacl_token ) ) {
				return '';
			}

			$login_url = add_query_arg( 'wacl_token', $wacl_token, trailingslashit( admin_url() ) );

			return $login_url;
		}


		/**
		 * Get the usermeta of Temp Users
		 *
		 * @param user name
		 * @param user detail
		 * @param access link
		 * @param Print Table to show Temporary Users
		 *
		 */

		public function get_temp_user_data( $user_id ) {
			$nickname        = get_user_meta( $user_id, 'nickname', true );
			$wp_capabilities = get_user_meta( $user_id, 'wp_capabilities', false );
			$wacl_user       = get_user_meta( $user_id, 'wacl_user', true );
			$wacl_expiry     = get_user_meta( $user_id, 'wacl_expiry', true );
			/* Get status */
			$current_timestamp = self::get_current_gmt_timestamp();
			@$xyz = $wacl_expiry - $current_timestamp;
			$avb = floor( $xyz / ( 60 * 60 * 24 ) );


			if ( $wacl_expiry >= $current_timestamp ) {
				$status = "Active";
			} else {
				$status = "Expired";
			}
			$wacl_token = self::get_login_url( $user_id );
			if ( $wacl_user ) {
				?>
                <tr>
                    <td>
						<?php echo $nickname; ?>
                    </td>

                    <td>
						<?php echo self::time_elapsed_string( $wacl_expiry ); ?>
                    </td>
                    <td>
						<?php echo $wacl_token; ?>
                    </td>
                    <td>
                        <a href="#" class="del_token extra_action" onclick="del_token(<?php echo $user_id; ?>)"><i
                                    class="fas fa-trash-alt"></i></a>
                        <!-- <a href="#update_token" class="edit_token extra_action" data-backdrop="true" data-toggle="modal"  data-id="<?php echo $user_id; ?>"><i class="fas fa-pencil-alt"></i></a> -->
                    </td>
                </tr>
				<?php
			}
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
			/* get all users id */
			$users = get_users( array( 'fields' => array( 'ID' ) ) );
			foreach ( $users as $user_id ) {
				// print_r(get_user_meta ( $user_id->ID));
				$user_id = $user_id->ID;
				self::get_temp_user_data( $user_id );
			}
		}


		/**
		 * Get valid temporary user based on token
		 *
		 *
		 * @param string $token
		 * @param string $fields
		 *
		 * @return array|bool
		 */
		public static function get_valid_user_based_on_wtlwp_token( $token = '', $fields = 'all' ) {
			if ( empty( $token ) ) {
				return false;
			}

			$args = array(
				'fields'     => $fields,
				'meta_key'   => 'wacl_expiry',
				'order'      => 'DESC',
				'orderby'    => 'meta_value',
				'meta_query' => array(
					0 => array(
						'key'     => 'wacl_token',
						'value'   => sanitize_text_field( $token ),
						'compare' => '=',
					),
				),
			);

			$users = new WP_User_Query( $args );

			$users_data = $users->get_results();
			if ( empty( $users_data ) ) {
				return "false";
			}
			foreach ( $users_data as $key => $user ) {
				$expire = get_user_meta( $user->ID, 'wacl_expiry', true );
				if ( $expire <= self::get_current_gmt_timestamp() ) {
					unset( $users_data[ $key ] );
				}
			}

			return $users_data;
		}

		/**
		 * Get all pages which needs to be blocked for temporary users
		 *
		 *
		 * @return array
		 */
		public static function get_blocked_pages() {
			$blocked_pages = array( 'admin_custom_login', 'users.php', 'user-new.php', 'user-edit.php', 'profile.php' );
			$blocked_pages = apply_filters( 'wacl_restricted_pages_for_temporary_users', $blocked_pages );

			return $blocked_pages;
		}

		/**
		 * Up the token expiry value by one day
		 *
		 *
		 *
		 */

		/*public function up_token($user_id){
			$valid_user = self::is_valid_temporary_login($user_id);
			if($valid_user == true){
				$check_expiry = self::is_login_expired($user_id);
				if($check_expiry == true){
					return "ok";
				}
			}
		}*/

	} /* class end*/
}
?>