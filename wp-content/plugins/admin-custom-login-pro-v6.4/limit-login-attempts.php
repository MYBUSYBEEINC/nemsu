<?php
/**
 * CLASS LIMIT LOGIN ATTEMPTS
 * Prevent Mass WordPress Login Attacks by setting locking the system when login fail.
 * To be added in functions.php or as an external file.
 */
if ( ! class_exists( 'Limit_Login_Attempts' ) ) {
	class Limit_Login_Attempts {

		/*var $failed_login_limit = 10; */                    /*Number of authentification accepted*/
		/*var $lockout_duration   = 1800;*/                 /*Stop authentification process for 30 minutes: 60*30 = 1800*/
		public $failed_login_limit;
		public $lockout_duration_1;
		var $transient_name = 'attempted_login';    /*Transient used*/
		public $lockout_duration;


		public function __construct( $login_attempts, $duration ) {
			add_filter( 'authenticate', array( $this, 'check_attempted_login' ), 30, 3 );
			add_action( 'wp_login_failed', array( $this, 'login_failed' ), 10, 1 );

			$this->failed_login_limit = $login_attempts;
			$this->lockout_duration_1 = $duration;
			$this->lockout_duration   = $this->lockout_duration_1 * 60; /* calculating the time in seconds */

		}

		/**
		 * @param Lock login attempts of failed login limit is reached
		 */
		public function check_attempted_login( $user, $username, $password ) 
		{
			if ( get_transient( $this->transient_name ) )
			{
				$datas = get_transient( $this->transient_name );
                 $user_exists = true;
				if ( $datas['tried'] >= $this->failed_login_limit ) {
					$until = get_option( '_transient_timeout_' . $this->transient_name );
					$time  = $this->when( $until );

					//Display error message to the user when limit is reached
					return new WP_Error( 'too_many_tried', sprintf( __( '<strong>ERROR</strong>: You have reached authentification limit, you will be able to try again in %1$s.' ), $time ) );
				}elseif (!username_exists( $username ) && !email_exists( $username )) 
				{

					if ( $datas['tried'] < $this->failed_login_limit ) 
					{
						$total_attempt   = $this->failed_login_limit;
						$remaing         = $total_attempt - $datas['tried'];
						$print_remaining = "<p><strong>you have only $remaing attempts remain</strong></p>";

						return new WP_Error( 'too_many_tried', $print_remaining );
				    }
				}else{
				$datas = array(
					'tried' => 0
				);
				set_transient( $this->transient_name, $datas, $this->lockout_duration );
				return $user;
			}

					             				 			
			}else{

				return $user;
			}

			
		}

		/**
		 * Add transient
		 */
		public function login_failed( $username ) {
			$datas = get_transient( $this->transient_name );
			if ( $datas ) {
				$datas['tried']++;

				if ( $datas['tried'] <= $this->failed_login_limit ) {
					set_transient( $this->transient_name, $datas, $this->lockout_duration );
				}
			} else {
				$datas = array(
					'tried' => 1
				);
				set_transient( $this->transient_name, $datas, $this->lockout_duration );
			}
		}

		/**
		 * Return difference between 2 given dates
		 *
		 * @param  int $time Date as Unix timestamp
		 *
		 * @return string           Return string
		 */
		private function when( $time ) {
			if ( ! $time ) {
				return;
			}

			$right_now = time();

			$diff = abs( $right_now - $time );

			$second = 1;
			$minute = $second * 60;
			$hour   = $minute * 60;
			$day    = $hour * 24;

			if ( $diff < $minute ) {
				return floor( $diff / $second ) . ' seconds';
			}

			if ( $diff < $minute * 2 ) {
				return "about 1 minute ago";
			}

			if ( $diff < $hour ) {
				return floor( $diff / $minute ) . ' minutes';
			}

			if ( $diff < $hour * 2 ) {
				return 'about 1 hour';
			}

			return floor( $diff / $hour ) . ' hours';
		}
	}
}

//Enable it:
//new Limit_Login_Attempts();
?>