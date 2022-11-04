<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . 'admin/inc/helpers/WL_IMP_Helper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . 'admin/WL_IMP_Database.php' );

class WL_IMP_Reset {
	/* Perform reset */
	public static function perform_reset() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! wp_verify_nonce( $_POST["reset-plugin"], "reset-plugin" ) ) {
			die();
		}

		global $wpdb;

		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}wl_im_enquiries'" ) == "{$wpdb->prefix}wl_im_enquiries" ) {
			/* Delete enquiry attachments */
			$enquiries = $wpdb->get_results( "SELECT id_proof, photo_id, signature_id FROM {$wpdb->prefix}wl_im_enquiries" );
			if ( $enquiries && count( $enquiries ) ) {
				foreach( $enquiries as $enquiry ) {
					if ( $enquiry->id_proof ) {
						wp_delete_attachment( $enquiry->id_proof, true );
					}
					if ( $enquiry->photo_id ) {
						wp_delete_attachment( $enquiry->photo_id, true );
					}
					if ( $enquiry->signature_id ) {
						wp_delete_attachment( $enquiry->signature_id, true );
					}
				}
			}
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}wl_im_students'" ) == "{$wpdb->prefix}wl_im_students" ) {
			/* Delete student attachments and user account */
			$students = $wpdb->get_results( "SELECT user_id, id_proof, photo_id, signature_id FROM {$wpdb->prefix}wl_im_students" );
			if ( $students && count( $students ) ) {
				foreach( $students as $student ) {
					if ( $student->id_proof ) {
						wp_delete_attachment( $student->id_proof, true );
					}
					if ( $student->photo_id ) {
						wp_delete_attachment( $student->photo_id, true );
					}
					if ( $student->signature_id ) {
						wp_delete_attachment( $student->signature_id, true );
					}
					if ( $student->user_id ) {
						wp_delete_user( $student->user_id );
					}
				}
			}
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}wl_im_notices'" ) == "{$wpdb->prefix}wl_im_notices" ) {
			/* Delete notice attachments */
			$notices = $wpdb->get_results( "SELECT attachment FROM {$wpdb->prefix}wl_im_notices" );
			if ( $notices && count( $notices ) ) {
				foreach( $notices as $notice ) {
					if ( $notice->attachment ) {
						wp_delete_attachment( $notice->attachment, true );
					}
				}
			}
		}

		/* Remove custom capabilities of admin */
		WL_IMP_Helper::remove_capabilities();

		/* Drop results table */
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wl_im_results" );

		/* Drop exams table */
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wl_im_exams" );

		/* Drop notices table */
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wl_im_notices" );

		/* Drop installments table */
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wl_im_installments" );

		/* Drop students table */
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wl_im_students" );

		/* Drop batches table */
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wl_im_batches" );

		/* Drop enquiries table */
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wl_im_enquiries" );

		/* Drop courses table */
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wl_im_courses" );

		/* Unregister settings */
		unregister_setting( 'wl_im_settings_group', 'enable_enquiry_form_title' );
		unregister_setting( 'wl_im_settings_group', 'enquiry_form_title' );
		unregister_setting( 'wl_im_settings_group', 'enable_institute_pro_logo' );
		unregister_setting( 'wl_im_settings_group', 'institute_pro_logo' );
		unregister_setting( 'wl_im_settings_group', 'institute_pro_name' );
		unregister_setting( 'wl_im_settings_group', 'institute_pro_address' );
		unregister_setting( 'wl_im_settings_group', 'institute_pro_phone' );
		unregister_setting( 'wl_im_settings_group', 'institute_pro_email' );
		delete_option( 'enable_enquiry_form_title' );
		delete_option( 'enquiry_form_title' );
		delete_option( 'institute_pro_logo' );
		delete_option( 'enable_institute_pro_logo' );
		delete_option( 'institute_pro_name' );
		delete_option( 'institute_pro_address' );
		delete_option( 'institute_pro_phone' );
		delete_option( 'institute_pro_email' );

		delete_option( 'institute_pro_email_host' );
		delete_option( 'institute_pro_email_username' );
		delete_option( 'institute_pro_email_password' );
		delete_option( 'institute_pro_email_encryption' );
		delete_option( 'institute_pro_email_port' );
		delete_option( 'institute_pro_email_from' );

		delete_option( 'institute_pro_business' );
		delete_option( 'institute_pro_paypal' );
		delete_option( 'institute_pro_razorpay' );
		delete_option( 'institute_pro_paystack' );

		WL_IMP_Database::activation();

		wp_send_json_success( array( 'message' => __( 'Plugin has been reset to its initial state.', WL_IMP_DOMAIN ) ) );
	}
}