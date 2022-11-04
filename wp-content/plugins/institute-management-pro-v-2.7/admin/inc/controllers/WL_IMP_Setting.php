<?php
defined( 'ABSPATH' ) || die();

class WL_IMP_Setting {
	/* Register settings */
	public static function register_settings() {
		register_setting( 'wl_im_settings_group', 'enable_enquiry_form_title' );
		register_setting( 'wl_im_settings_group', 'enquiry_form_title' );
		register_setting( 'wl_im_settings_group', 'institute_pro_logo', array( 'WL_IMP_Setting', 'handle_institute_pro_logo' ) );
		register_setting( 'wl_im_settings_group', 'enable_institute_pro_logo' );
		register_setting( 'wl_im_settings_group', 'institute_pro_name' );
		register_setting( 'wl_im_settings_group', 'institute_pro_address' );
		register_setting( 'wl_im_settings_group', 'institute_pro_phone' );
		register_setting( 'wl_im_settings_group', 'institute_pro_email' );

		register_setting( 'wl_im_settings_group', 'institute_pro_email_host' );
		register_setting( 'wl_im_settings_group', 'institute_pro_email_username' );
		register_setting( 'wl_im_settings_group', 'institute_pro_email_password', array( 'WL_IMP_Setting', 'handle_institute_pro_email_password' ) );
		register_setting( 'wl_im_settings_group', 'institute_pro_email_encryption' );
		register_setting( 'wl_im_settings_group', 'institute_pro_email_port' );
		register_setting( 'wl_im_settings_group', 'institute_pro_email_from' );

		register_setting( 'wl_im_settings_group', 'institute_pro_business' );
		register_setting( 'wl_im_settings_group', 'institute_pro_paypal' );
		register_setting( 'wl_im_settings_group', 'institute_pro_razorpay' );
		register_setting( 'wl_im_settings_group', 'institute_pro_paystack' );

		register_setting( 'wl_im_settings_group', 'institute_pro_settings' );
	}

	public static function handle_institute_pro_logo() {
		if( ! empty( $_FILES["institute_pro_logo"]["tmp_name"] ) ) {
		    $urls = wp_handle_upload( $_FILES["institute_pro_logo"], array( 'test_form' => FALSE ) );
		    $temp = $urls["url"];
		    return $temp;
		}
	  	return get_option( 'institute_pro_logo' );
	}

	public static function handle_institute_pro_email_password() {
		if( ! empty( $_POST["institute_pro_email_password"] ) ) {
		    return $_POST["institute_pro_email_password"];
		}
	  	return get_option( 'institute_pro_email_password' );
	}
}