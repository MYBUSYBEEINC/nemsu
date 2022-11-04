<?php
defined( 'ABSPATH' ) || die();

class WL_IMP_Helper {
	public static $core_capability = 'update_core';
	/* Get capabilities */
	public static function get_capabilities() {
		return array(
			'wl_im_manage_dashboard'      => 'Manage Dashboard',
			'wl_im_manage_courses'        => 'Manage Courses',
			'wl_im_manage_batches'        => 'Manage Batches',
			'wl_im_manage_enquiries'      => 'Manage Enquiries',
			'wl_im_manage_students'       => 'Manage Students',
			'wl_im_manage_results'        => 'Manage Results',
			'wl_im_manage_report'         => 'Manage Report',
			'wl_im_manage_fees'           => 'Manage Fees',
			'wl_im_manage_notifications'  => 'Manage Notifications',
			'wl_im_manage_noticeboard'    => 'Manage Noticeboard',
			'wl_im_manage_administrators' => 'Manage Administrators',
			'wl_im_manage_settings'       => 'Manage Settings' );
	}

	/* Get student capability */
	public static function get_student_capability() {
		return 'wl_im_student';
	}

	/* Assign custom capabilities to admin */
	public static function assign_capabilities() {
		$roles = get_editable_roles();
		foreach ( $GLOBALS['wp_roles']->role_objects as $key => $role ) {
			if ( isset( $roles[$key] ) && $role->has_cap( self::$core_capability ) ) {
				foreach( self::get_capabilities() as $capability_key => $capability_value ) {
					$role->add_cap( $capability_key );
				}
			}
		}
	}

	/* Remove custom capabilities of admin */
	public static function remove_capabilities() {
		$roles = get_editable_roles();
		foreach ( $GLOBALS['wp_roles']->role_objects as $key => $role ) {
			if ( isset ( $roles[$key] ) && $role->has_cap( self::$core_capability ) ) {
				foreach( self::get_capabilities() as $capability_key => $capability_value ) {
					$role->remove_cap( $capability_key );
				}
			}
		}
	}

	/* Get duration in */
	public static function get_duration_in() {
		return array( 'Days', 'Months', 'Years' );
	}

	/* Get payment method list */
	public static function get_payment_method_list() {
		return array(
			'Cash',
			'Cheque',
			'Card',
			'Bank Transfer',
			'Demand Draft'
		);
	}

	/* Get notification by list */
	public static function get_notification_by_list() {
		return array(
			'by-batch'               => 'By Batch',
			'by-course'              => 'By Course',
			'by-pending-fees'        => 'By Pending Fees',
			'by-current-students'    => 'By Current Students',
			'by-former-students'     => 'By Former Students',
			'by-individual-students' => 'By Individual Student'
		);
	}

	/* Get active courses */
	public static function get_active_courses() {
		global $wpdb;
		return $wpdb->get_results( "SELECT id, course_name, fees, course_code FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 ORDER BY course_name" );
	}

	/* Get students */
	public static function get_students() {
		global $wpdb;
		return $wpdb->get_results( "SELECT id, first_name, last_name FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND is_active = 1 ORDER BY first_name, last_name, id DESC" );
	}

	/* Get active students */
	public static function get_active_students() {
		global $wpdb;
		return $wpdb->get_results( "SELECT id, first_name, last_name FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND is_active = 1 ORDER BY first_name, last_name, id DESC" );
	}

	/* Get payment methods */
	public static function get_payment_methods() {
		return array(
			'razorpay' => 'Razorpay',
			'paystack' => 'Paystack',
			'paypal'   => 'PayPal',
		);
	}

	/* Get enquiry ID */
	public static function get_enquiry_id( $id ) {
		return "E" . ( $id + 10000 );
	}

	/* Get valid gender data */
	public static function get_gender_data() {
		return array( 'male', 'female' );
	}

	/* Get valid enquiry action data */
	public static function get_enquiry_action_data() {
		return array( 'delete_enquiry', 'mark_enquiry_inactive' );
	}

	/* Get id_proof file types */
	public static function get_id_proof_file_types() {
		return array( 'image/jpg', 'image/jpeg', 'image/png', 'application/pdf' );
	}

	/* Get image file types */
	public static function get_image_file_types() {
		return array( 'image/jpg', 'image/jpeg', 'image/png' );
	}

	/* Get Notice attachment file types */
	public static function get_notice_attachment_file_types() {
		return array( 'image/jpg', 'image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation' );
	}

	/* Get enrollment ID */
	public static function get_enrollment_id( $id ) {
		$prefix = get_option( "institute_pro_settings" )['enrollment_id_prefix'];
		if ( ! $prefix ) {
			$prefix = 'EN';
		}
		return $prefix . ( $id + 10000 );
	}

	/* Get student ID */
	public static function get_student_id( $enrollment_id ) {
		$prefix = get_option( "institute_pro_settings" )['enrollment_id_prefix'];
		if ( ! $prefix ) {
			$prefix = 'EN';
		}
		return intval( substr( $enrollment_id, strlen( $prefix ), strlen( $enrollment_id ) ) ) - 10000;
	}

	/* Get form number */
	public static function get_form_number( $id ) {
		return ( $id + 10000 );
	}

	/* Get certificate number */
	public static function get_certificate_number( $id ) {
		return ( $id + 10000 );
	}

	/* Get receipt number */
	public static function get_receipt( $id ) {
		$prefix = get_option( "institute_pro_settings" )['receipt_number_prefix'];
		if ( ! $prefix ) {
			$prefix = 'R';
		}
		return $prefix . ( $id + 10000 );
	}

	/* Get exams */
	public static function get_exams() {
		global $wpdb;
		return $wpdb->get_results( "SELECT id, exam_title, exam_code FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 ORDER BY id DESC" );
	}

	/* Get published exams */
	public static function get_published_exams() {
		global $wpdb;
		return $wpdb->get_results( "SELECT id, exam_title, exam_code FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND is_published = 1 ORDER BY id DESC" );
	}

	/* Get course */
	public static function get_course( $id ) {
		global $wpdb;
		$id   = intval( sanitize_text_field( $id ) );
		$row = $wpdb->get_row( "SELECT course_code, course_name FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			return null;
		}
		return $row;
	}

	/* Get batch */
	public static function get_batch( $id ) {
		global $wpdb;
		$id   = intval( sanitize_text_field( $id ) );
		$row = $wpdb->get_row( "SELECT batch_code FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			return null;
		}
		return $row;
	}

	/* Get data for dashboard */
	public static function get_data() {
		global $wpdb;
		$sql = "SELECT
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 ) as courses, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 ) as batches, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_enquiries WHERE is_deleted = 0 ) as enquiries, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 ) as students, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0 ) as installments, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 ) as courses_active, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND is_active = 1 ) as batches_active, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_enquiries WHERE is_deleted = 0 AND is_active = 1 ) as enquiries_active, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND is_active = 1 AND course_completed = 0) as students_current, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND course_completed = 1 ) as students_former, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND course_completed = 0 AND is_active = 0 ) as students_discontinued, 
  		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND is_active = 1 AND ( fees_payable - fees_paid > 0 ) ) as students_fees_pending, 
		  ( SELECT COUNT(*) FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND ( fees_payable - fees_paid <= 0 ) ) as students_fees_paid";
		$count = $wpdb->get_row( $sql );

		$course_data = $wpdb->get_results( "SELECT id, course_name, course_code, is_deleted, is_active FROM {$wpdb->prefix}wl_im_courses ORDER BY course_name", OBJECT_K );

		$sql = "SELECT id, course_id, created_at FROM {$wpdb->prefix}wl_im_enquiries WHERE is_deleted = 0 AND is_active = 1 ORDER BY id DESC LIMIT 5";
		$recent_enquiries = $wpdb->get_results( $sql );

		$sql = "SELECT course_id, COUNT( course_id ) as students FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 GROUP BY course_id ORDER BY COUNT( course_id ) DESC LIMIT 5";
		$popular_courses_enquiries = $wpdb->get_results( $sql );

		$sql = "SELECT SUM(amount) as revenue FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0";
		$revenue = $wpdb->get_var( $sql );

		return array(
			'count'                     => $count,
			'course_data'               => $course_data,
			'recent_enquiries'          => $recent_enquiries,
			'popular_courses_enquiries' => $popular_courses_enquiries,
			'revenue'                   => $revenue
		);
	}
}
?>