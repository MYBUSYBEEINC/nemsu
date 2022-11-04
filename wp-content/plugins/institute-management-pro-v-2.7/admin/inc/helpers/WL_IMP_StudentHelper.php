<?php
defined( 'ABSPATH' ) || die();

class WL_IMP_StudentHelper {
	/* Get student */
	public static function get_student() {
		global $wpdb;
		if ( $user_id = get_current_user_id() ) {
			$student = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND user_id = $user_id" );
			return $student;
		}
		return null;
	}

	/* Get notices */
	public static function get_notices( $limit = NULL ) {
		global $wpdb;
		$limit = $limit ? "LIMIT $limit" : "";
		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_notices WHERE is_deleted = 0 AND is_active = 1 ORDER BY priority ASC, id DESC $limit" );
	}
}
?>