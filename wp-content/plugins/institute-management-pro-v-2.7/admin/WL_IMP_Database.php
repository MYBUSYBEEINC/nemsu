<?php
defined( 'ABSPATH' ) || die();

require_once( 'inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Database {
	/* On plugin activation */
	public static function activation() {
		if ( class_exists( 'WL_IM_InstituteManagement' ) ) {
			deactivate_plugins( 'institute-management/institute-management.php' );
		}

		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		/* Create courses table */
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_im_courses (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				course_code varchar(191) NOT NULL,
				course_name varchar(255) DEFAULT NULL,
				course_detail text DEFAULT NULL,
				duration int(11) UNSIGNED DEFAULT NULL,
				duration_in varchar(255) DEFAULT NULL,
				fees decimal(12,2) UNSIGNED DEFAULT NULL,
				is_active tinyint(1) NOT NULL DEFAULT '1',
				added_by bigint(20) UNSIGNED DEFAULT NULL,
				is_deleted tinyint(1) NOT NULL DEFAULT '0',
				created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at timestamp NULL DEFAULT NULL,
				deleted_at timestamp NULL DEFAULT NULL,
				PRIMARY KEY (id),
				UNIQUE (course_code, is_deleted, deleted_at),
				INDEX (added_by),
				FOREIGN KEY (added_by) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL
				) $charset_collate";
		dbDelta( $sql );

		/* Create enquiries table */
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_im_enquiries (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				course_id bigint(20) UNSIGNED DEFAULT NULL,
				first_name varchar(255) NOT NULL,
				last_name varchar(255) DEFAULT NULL,
				phone varchar(255) DEFAULT NULL,
				email varchar(255) DEFAULT NULL,
				message text DEFAULT NULL,
				is_active tinyint(1) NOT NULL DEFAULT '1',
				added_by bigint(20) UNSIGNED DEFAULT NULL,
				is_deleted tinyint(1) NOT NULL DEFAULT '0',
				created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at timestamp NULL DEFAULT NULL,
				deleted_at timestamp NULL DEFAULT NULL,
				PRIMARY KEY (id),
				INDEX (course_id),
				INDEX (added_by),
				FOREIGN KEY (course_id) REFERENCES {$wpdb->prefix}wl_im_courses (id) ON DELETE SET NULL,
				FOREIGN KEY (added_by) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL
				) $charset_collate";
		dbDelta( $sql );

		/* Add gender, date_of_birth, id_proof, father_name, mother_name, address, city, zip, state, nationality, qualification, photo_id, signature_id columns if not exists to enquiries table */
		$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = '{$wpdb->prefix}wl_im_enquiries' AND COLUMN_NAME = 'signature_id'" );
		if ( empty( $row ) ) {
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_enquiries ADD (
				gender varchar(255) NOT NULL,
				date_of_birth date NULL DEFAULT NULL,
				id_proof bigint(20) UNSIGNED DEFAULT NULL,
				father_name varchar(255) DEFAULT NULL,
				mother_name varchar(255) DEFAULT NULL,
				address text DEFAULT NULL,
				city varchar(255) DEFAULT NULL,
				zip varchar(255) DEFAULT NULL,
				state varchar(255) DEFAULT NULL,
				nationality varchar(255) DEFAULT NULL,
				qualification varchar(255) DEFAULT NULL,
				photo_id bigint(20) UNSIGNED DEFAULT NULL,
				signature_id bigint(20) UNSIGNED DEFAULT NULL
			)" );
		}

		/* Create students table */
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_im_students (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				course_id bigint(20) UNSIGNED DEFAULT NULL,
				first_name varchar(255) NOT NULL,
				last_name varchar(255) DEFAULT NULL,
				phone varchar(255) DEFAULT NULL,
				email varchar(255) DEFAULT NULL,
				address text DEFAULT NULL,
				city varchar(255) DEFAULT NULL,
				zip varchar(255) DEFAULT NULL,
				fees_payable decimal(12,2) UNSIGNED DEFAULT '0',
				fees_paid decimal(12,2) UNSIGNED DEFAULT '0',
				is_active tinyint(1) NOT NULL DEFAULT '1',
				added_by bigint(20) UNSIGNED DEFAULT NULL,
				course_completed tinyint(1) NOT NULL DEFAULT '0',
				completion_date timestamp NULL DEFAULT NULL,
				is_deleted tinyint(1) NOT NULL DEFAULT '0',
				created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at timestamp NULL DEFAULT NULL,
				deleted_at timestamp NULL DEFAULT NULL,
				PRIMARY KEY (id),
				INDEX (course_id),
				INDEX (added_by),
				FOREIGN KEY (course_id) REFERENCES {$wpdb->prefix}wl_im_courses (id) ON DELETE SET NULL,
				FOREIGN KEY (added_by) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL
				) $charset_collate";
		dbDelta( $sql );

		/* Add gender, date_of_birth, id_proof, father_name, mother_name, state, nationality, qualification, photo_id, signature_id columns if not exists to students table */
		$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = '{$wpdb->prefix}wl_im_students' AND COLUMN_NAME = 'signature_id'" );
		if ( empty( $row ) ) {
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_students ADD (
				gender varchar(255) DEFAULT NULL,
				date_of_birth date NULL DEFAULT NULL,
				id_proof bigint(20) UNSIGNED DEFAULT NULL,
				father_name varchar(255) DEFAULT NULL,
				mother_name varchar(255) DEFAULT NULL,
				state varchar(255) DEFAULT NULL,
				nationality varchar(255) DEFAULT NULL,
				qualification varchar(255) DEFAULT NULL,
				photo_id bigint(20) UNSIGNED DEFAULT NULL,
				signature_id bigint(20) UNSIGNED DEFAULT NULL
			)" );
		}

		/* Create installments table */
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_im_installments (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				student_id bigint(20) UNSIGNED DEFAULT NULL,
				amount decimal(12,2) UNSIGNED DEFAULT NULL,
				added_by bigint(20) UNSIGNED DEFAULT NULL,
				is_deleted tinyint(1) NOT NULL DEFAULT '0',
				created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at timestamp NULL DEFAULT NULL,
				deleted_at timestamp NULL DEFAULT NULL,
				PRIMARY KEY (id),
				INDEX (student_id),
				INDEX (added_by),
				FOREIGN KEY (student_id) REFERENCES {$wpdb->prefix}wl_im_students (id) ON DELETE SET NULL,
				FOREIGN KEY (added_by) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL
				) $charset_collate";
		dbDelta( $sql );

		/* Create batches table */
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_im_batches (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				course_id bigint(20) UNSIGNED DEFAULT NULL,
				batch_code varchar(191) NOT NULL,
				batch_name varchar(255) DEFAULT NULL,
				is_active tinyint(1) NOT NULL DEFAULT '1',
				added_by bigint(20) UNSIGNED DEFAULT NULL,
				is_deleted tinyint(1) NOT NULL DEFAULT '0',
				created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at timestamp NULL DEFAULT NULL,
				deleted_at timestamp NULL DEFAULT NULL,
				PRIMARY KEY (id),
				UNIQUE (batch_code, course_id, is_deleted, deleted_at),
				INDEX (course_id),
				INDEX (added_by),
				FOREIGN KEY (course_id) REFERENCES {$wpdb->prefix}wl_im_courses (id) ON DELETE SET NULL,
				FOREIGN KEY (added_by) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL
				) $charset_collate";
		dbDelta( $sql );

		/* Add batch_id column if not exists to students table */
		$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = '{$wpdb->prefix}wl_im_students' AND COLUMN_NAME = 'batch_id'" );
		if ( empty( $row ) ) {
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_students ADD batch_id bigint(20) UNSIGNED DEFAULT NULL" );
			$wpdb->query( "CREATE INDEX batch_id ON {$wpdb->prefix}wl_im_students (batch_id)" );
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_students ADD FOREIGN KEY (batch_id) REFERENCES {$wpdb->prefix}wl_im_batches (id) ON DELETE SET NULL" );
		}

		/* Create notices table */
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_im_notices (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				title text NOT NULL,
				attachment bigint(20) UNSIGNED DEFAULT NULL,
				url text DEFAULT NULL,
				link_to varchar(255) DEFAULT 'url',
				priority int(11) DEFAULT 10,
				is_active tinyint(1) NOT NULL DEFAULT '1',
				added_by bigint(20) UNSIGNED DEFAULT NULL,
				is_deleted tinyint(1) NOT NULL DEFAULT '0',
				created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at timestamp NULL DEFAULT NULL,
				deleted_at timestamp NULL DEFAULT NULL,
				PRIMARY KEY (id),
				INDEX (added_by),
				FOREIGN KEY (added_by) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL
				) $charset_collate";
		dbDelta( $sql );

		/* Add user_id, allow_login columns if not exists to students table */
		$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = '{$wpdb->prefix}wl_im_students' AND COLUMN_NAME = 'user_id'" );
		if ( empty( $row ) ) {
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_students ADD user_id bigint(20) UNSIGNED DEFAULT NULL" );
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_students ADD CONSTRAINT UNIQUE (user_id, is_deleted, deleted_at)" );
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_students ADD FOREIGN KEY (user_id) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL" );
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_students ADD allow_login tinyint(1) NOT NULL DEFAULT '0'" );
		}

		/* Add payment_method, payment_id columns if not exists to installments table */
		$row = $wpdb->get_results( "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = '{$wpdb->prefix}wl_im_installments' AND COLUMN_NAME = 'payment_id'" );
		if ( empty( $row ) ) {
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_installments ADD payment_method varchar(255) DEFAULT NULL" );
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}wl_im_installments ADD payment_id text DEFAULT NULL" );
		}

		/* Create exams table */
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_im_exams (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				exam_code varchar(191) NOT NULL,
				exam_title text DEFAULT NULL,
				exam_date date NULL DEFAULT NULL,
				marks text DEFAULT NULL,
				is_published tinyint(1) NOT NULL DEFAULT '0',
				published_at timestamp NULL DEFAULT NULL,
				added_by bigint(20) UNSIGNED DEFAULT NULL,
				is_deleted tinyint(1) NOT NULL DEFAULT '0',
				created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at timestamp NULL DEFAULT NULL,
				deleted_at timestamp NULL DEFAULT NULL,
				PRIMARY KEY (id),
				UNIQUE (exam_code, is_deleted, deleted_at),
				INDEX (added_by),
				FOREIGN KEY (added_by) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL
				) $charset_collate";
		dbDelta( $sql );

		/* Create results table */
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_im_results (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				student_id bigint(20) UNSIGNED DEFAULT NULL,
				exam_id bigint(20) UNSIGNED DEFAULT NULL,
				marks text DEFAULT NULL,
				added_by bigint(20) UNSIGNED DEFAULT NULL,
				is_deleted tinyint(1) NOT NULL DEFAULT '0',
				created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at timestamp NULL DEFAULT NULL,
				deleted_at timestamp NULL DEFAULT NULL,
				PRIMARY KEY (id),
				UNIQUE (exam_id, student_id, is_deleted, deleted_at),
				INDEX (exam_id),
				INDEX (added_by),
				FOREIGN KEY (student_id) REFERENCES {$wpdb->prefix}wl_im_students (id) ON DELETE SET NULL,
				FOREIGN KEY (exam_id) REFERENCES {$wpdb->prefix}wl_im_exams (id) ON DELETE SET NULL,
				FOREIGN KEY (added_by) REFERENCES {$wpdb->base_prefix}users (ID) ON DELETE SET NULL
				) $charset_collate";
		dbDelta( $sql );

		/* Assign custom capabilities to admin */
		WL_IMP_Helper::assign_capabilities();

		/* Add default options */
		WL_IMP_Database::add_options();
	}

	/* On plugin deactivation */
	public static function deactivation() {
		/* Remove custom capabilities of admin */
		WL_IMP_Helper::remove_capabilities();
        delete_option( 'wl-imp-code' );
	}

	public static function add_options() {
		add_option( 'enable_enquiry_form_title', 'yes' );
		add_option( 'enquiry_form_title', __( 'Online Admission Form', WL_IMP_DOMAIN ) );
		$custom_logo_id  = get_theme_mod( 'custom_logo', '' );
		$custom_logo_url = wp_get_attachment_image_src( $custom_logo_id , [0], 'full' );
		add_option( 'institute_pro_logo', $custom_logo_url );
		add_option( 'enable_institute_pro_logo', '' );
		add_option( 'institute_pro_name', __( 'Sample Institute Name', WL_IMP_DOMAIN ) );
		add_option( 'institute_pro_address', __( 'Sample Institute Address', WL_IMP_DOMAIN ) );
		add_option( 'institute_pro_phone', __( '9999999999', WL_IMP_DOMAIN ) );
		add_option( 'institute_pro_email', __( 'sample_institute@domain.com', WL_IMP_DOMAIN ) );

		add_option( 'institute_pro_email_host', '' );
		add_option( 'institute_pro_email_username', '' );
		add_option( 'institute_pro_email_password', '' );
		add_option( 'institute_pro_email_encryption', 'tls' );
		add_option( 'institute_pro_email_port', '587' );
		add_option( 'institute_pro_email_from', '' );
	}
}
