<?php
add_action( 'init', 'remove_halt' );
function remove_halt() {
	$attempt_settings = unserialize( get_option( 'Admin_custome_login_attempts' ) );
	if ( isset( $attempt_settings['enable_login_form_key'] ) ) {
		$enable_login_form_key = $attempt_settings['enable_login_form_key'];
	} else {
		$enable_login_form_key = '';
	}
	if ( isset( $_GET['enable_login_form_key'] ) && $enable_login_form_key == $_GET['enable_login_form_key'] ) {
		$enable_login_form_key = $_GET['enable_login_form_key'];
		$transient_name        = 'attempted_login';
		$transient_timeout     = '_transient_timeout_' . $transient_name;
		delete_option( '_transient_attempted_login' );
		delete_option( "_transient_timeout_attempted_login" );
	}
}

//_transient_attempted_login
//_transient_timeout_attempted_login
?>