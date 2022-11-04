<?php
defined( 'ABSPATH' ) || die();

class WL_IMP_Menu {
	/* Add menu */
	public static function create_menu() {
		$wl_im_lm = WL_IMP_LM::get_instance();
		$wl_im_lm_val = $wl_im_lm->is_valid();

		if ( ( isset( $wl_im_lm_val ) && $wl_im_lm_val ) ) {
			/* Dashboard menu */
			$dashboard = add_menu_page( __( 'Institute Management Pro', WL_IMP_DOMAIN ), __( 'Institute Pro', WL_IMP_DOMAIN ), 'wl_im_manage_dashboard', 'institute-management-pro', array( 'WL_IMP_Menu', 'dashboard' ), 'dashicons-welcome-learn-more', 25 );
			add_action( 'admin_print_styles-' . $dashboard, array( 'WL_IMP_Menu', 'dashboard_assets' ) );

			/* Dashboard submenu */
			$dashboard_submenu = add_submenu_page( 'institute-management-pro', __( 'Institute Management Pro', WL_IMP_DOMAIN ), __( 'Dashboard', WL_IMP_DOMAIN ), 'wl_im_manage_dashboard', 'institute-management-pro', array( 'WL_IMP_Menu', 'dashboard' ) );
			add_action( 'admin_print_styles-' . $dashboard_submenu, array( 'WL_IMP_Menu', 'dashboard_assets' ) );

			/* Courses submenu */
			$courses = add_submenu_page( 'institute-management-pro', __( 'Courses', WL_IMP_DOMAIN ), __( 'Courses', WL_IMP_DOMAIN ), 'wl_im_manage_courses', 'institute-management-pro-courses', array( 'WL_IMP_Menu', 'courses' ) );
			add_action( 'admin_print_styles-' . $courses, array( 'WL_IMP_Menu', 'courses_assets' ) );

			/* Batches submenu */
			$batches = add_submenu_page( 'institute-management-pro', __( 'Batches', WL_IMP_DOMAIN ), __( 'Batches', WL_IMP_DOMAIN ), 'wl_im_manage_batches', 'institute-management-pro-batches', array( 'WL_IMP_Menu', 'batches' ) );
			add_action( 'admin_print_styles-' . $batches, array( 'WL_IMP_Menu', 'batches_assets' ) );

			/* Enquiries submenu */
			$enquiries = add_submenu_page( 'institute-management-pro', __( 'Enquiries', WL_IMP_DOMAIN ), __( 'Enquiries', WL_IMP_DOMAIN ), 'wl_im_manage_enquiries', 'institute-management-pro-enquiries', array( 'WL_IMP_Menu', 'enquiries' ) );
			add_action( 'admin_print_styles-' . $enquiries, array( 'WL_IMP_Menu', 'enquiries_assets' ) );

			/* Students submenu */
			$students = add_submenu_page( 'institute-management-pro', __( 'Students', WL_IMP_DOMAIN ), __( 'Students', WL_IMP_DOMAIN ), 'wl_im_manage_students', 'institute-management-pro-students', array( 'WL_IMP_Menu', 'students' ) );
			add_action( 'admin_print_styles-' . $students, array( 'WL_IMP_Menu', 'students_assets' ) );

			/* Fees submenu */
			$fees = add_submenu_page( 'institute-management-pro', __( 'Fees', WL_IMP_DOMAIN ), __( 'Fees', WL_IMP_DOMAIN ), 'wl_im_manage_fees', 'institute-management-pro-fees', array( 'WL_IMP_Menu', 'fees' ) );
			add_action( 'admin_print_styles-' . $fees, array( 'WL_IMP_Menu', 'fees_assets' ) );

			/* Results submenu */
			$results = add_submenu_page( 'institute-management-pro', __( 'Exam Results', WL_IMP_DOMAIN ), __( 'Exam Results', WL_IMP_DOMAIN ), 'wl_im_manage_results', 'institute-management-pro-exam-results', array( 'WL_IMP_Menu', 'results' ) );
			add_action( 'admin_print_styles-' . $results, array( 'WL_IMP_Menu', 'results_assets' ) );

			/* Report submenu */
			$report = add_submenu_page( 'institute-management-pro', __( 'Report', WL_IMP_DOMAIN ), __( 'Report', WL_IMP_DOMAIN ), 'wl_im_manage_report', 'institute-management-pro-report', array( 'WL_IMP_Menu', 'report' ) );
			add_action( 'admin_print_styles-' . $report, array( 'WL_IMP_Menu', 'report_assets' ) );

			/* Notifications submenu */
			$notifications = add_submenu_page( 'institute-management-pro', __( 'Notifications', WL_IMP_DOMAIN ), __( 'Notifications', WL_IMP_DOMAIN ), 'wl_im_manage_notifications', 'institute-management-pro-notifications', array( 'WL_IMP_Menu', 'notifications' ) );
			add_action( 'admin_print_styles-' . $notifications, array( 'WL_IMP_Menu', 'notifications_assets' ) );

			/* Noticeboard submenu */
			$noticeboard = add_submenu_page( 'institute-management-pro', __( 'Noticeboard', WL_IMP_DOMAIN ), __( 'Noticeboard', WL_IMP_DOMAIN ), 'wl_im_manage_noticeboard', 'institute-management-pro-noticeboard', array( 'WL_IMP_Menu', 'noticeboard' ) );
			add_action( 'admin_print_styles-' . $noticeboard, array( 'WL_IMP_Menu', 'noticeboard_assets' ) );

			/* Administrators submenu */
			$administrators = add_submenu_page( 'institute-management-pro', __( 'Administrators', WL_IMP_DOMAIN ), __( 'Administrators', WL_IMP_DOMAIN ), 'wl_im_manage_administrators', 'institute-management-pro-administrators', array( 'WL_IMP_Menu', 'administrators' ) );
			add_action( 'admin_print_styles-' . $administrators, array( 'WL_IMP_Menu', 'administrators_assets' ) );

			/* Settings submenu */
			$settings = add_submenu_page( 'institute-management-pro', __( 'Settings', WL_IMP_DOMAIN ), __( 'Settings', WL_IMP_DOMAIN ), 'wl_im_manage_settings', 'institute-management-pro-settings', array( 'WL_IMP_Menu', 'settings' ) );
			add_action( 'admin_print_styles-' . $settings, array( 'WL_IMP_Menu', 'settings_assets' ) );

			/* Student dashboard */
			$student_dashboard = add_menu_page( __( 'Student Dashboard', WL_IMP_DOMAIN ), __( 'Student Dashboard', WL_IMP_DOMAIN ), 'wl_im_student', 'institute-management-pro-student-dashboard', array( 'WL_IMP_Menu', 'student_dashboard' ), 'dashicons-welcome-learn-more', 25 );
			add_action( 'admin_print_styles-' . $student_dashboard, array( 'WL_IMP_Menu', 'student_dashboard_assets' ) );

			/* Student dashboard submenu */
			$student_dashboard_submenu = add_submenu_page( 'institute-management-pro-student-dashboard', __( 'Student Dashboard', WL_IMP_DOMAIN ), __( 'Student Dashboard', WL_IMP_DOMAIN ), 'wl_im_student', 'institute-management-pro-student-dashboard', array( 'WL_IMP_Menu', 'student_dashboard' ) );
			add_action( 'admin_print_styles-' . $student_dashboard_submenu, array( 'WL_IMP_Menu', 'student_dashboard_assets' ) );

			/* Student noticeboard submenu */
			$student_noticeboard_submenu = add_submenu_page( 'institute-management-pro-student-dashboard', __( 'Noticeboard', WL_IMP_DOMAIN ), __( 'Noticeboard', WL_IMP_DOMAIN ), 'wl_im_student', 'institute-management-pro-student-noticeboard', array( 'WL_IMP_Menu', 'student_noticeboard' ) );
			add_action( 'admin_print_styles-' . $student_noticeboard_submenu, array( 'WL_IMP_Menu', 'student_noticeboard_assets' ) );

			/* Reset plugin submenu */
			$reset_plugin_submenu = add_submenu_page( 'institute-management-pro', __( 'Reset Plugin', WL_IMP_DOMAIN ), __( 'Reset Plugin', WL_IMP_DOMAIN ), 'administrator', 'institute-management-pro-reset', array( 'WL_IMP_Menu', 'reset' ) );
			add_action( 'admin_print_styles-' . $reset_plugin_submenu, array( 'WL_IMP_Menu', 'reset_assets' ) );

			$wl_admin_submenu = add_submenu_page( 'institute-management-pro', __( 'License', WL_IMP_DOMAIN ), __( 'License', WL_IMP_DOMAIN ), 'administrator', 'institute-management-pro-license', array( 'WL_IMP_Menu', 'admin_menu' ) );
			add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'WL_IMP_Menu', 'admin_menu_assets' ) );
		}
	}

	public static function reset() {
		require_once( 'inc/wl_im_reset.php' );
	}

	public static function reset_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	public static function admin_menu() {
		require_once( 'inc/admin_menu.php' );
	}

	public static function admin_menu_assets() {
		wp_enqueue_style( 'wp_im_lc', WL_IMP_PLUGIN_URL . 'admin/css/admin_menu.css' );
	}

	/* Dashboard menu/submenu callback */
	public static function dashboard() {
		require_once( 'inc/wl_im_dashboard.php' );
	}

	/* Dashboard menu/submenu assets */
	public static function dashboard_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Courses menu callback */
	public static function courses() {
		require_once( 'inc/wl_im_courses.php' );
	}

	/* Courses menu assets */
	public static function courses_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Batches menu callback */
	public static function batches() {
		require_once( 'inc/wl_im_batches.php' );
	}

	/* Batches menu assets */
	public static function batches_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Enquiries menu callback */
	public static function enquiries() {
		require_once( 'inc/wl_im_enquiries.php' );
	}

	/* Enquiries menu assets */
	public static function enquiries_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Students menu callback */
	public static function students() {
		require_once( 'inc/wl_im_students.php' );
	}

	/* Students menu assets */
	public static function students_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_datatable_export_assets();
		self::enqueue_filters_assets();
		self::enqueue_custom_assets();
	}

	/* Fees menu callback */
	public static function fees() {
		require_once( 'inc/wl_im_fees.php' );
	}

	/* Fees menu assets */
	public static function fees_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Results menu callback */
	public static function results() {
		require_once( 'inc/wl_im_results.php' );
	}

	/* Results menu assets */
	public static function results_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Report menu callback */
	public static function report() {
		require_once( 'inc/wl_im_report.php' );
	}

	/* Report menu assets */
	public static function report_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Notifications menu callback */
	public static function notifications() {
		require_once( 'inc/wl_im_notifications.php' );
	}

	/* Notifications menu assets */
	public static function notifications_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Noticeboard menu callback */
	public static function noticeboard() {
		require_once( 'inc/wl_im_noticeboard.php' );
	}

	/* Noticeboard menu assets */
	public static function noticeboard_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Administrators menu callback */
	public static function administrators() {
		require_once( 'inc/wl_im_administrators.php' );
	}

	/* Administrators menu assets */
	public static function administrators_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Settings menu callback */
	public static function settings() {
		require_once( 'inc/wl_im_settings.php' );
	}

	/* Settings menu assets */
	public static function settings_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Student dashboard menu/submenu callback */
	public static function student_dashboard() {
		require_once( 'inc/wl_im_student_dashboard.php' );
	}

	/* Student dashboard menu/submenu assets */
	public static function student_dashboard_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Student noticeboard menu/submenu callback */
	public static function student_noticeboard() {
		require_once( 'inc/wl_im_student_noticeboard.php' );
	}

	/* Student noticeboard menu/submenu assets */
	public static function student_noticeboard_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Enqueue third party libraties */
	public static function enqueue_libraries() {
		/* Enqueue styles */
		wp_enqueue_style( 'wl-im-bootstrap', WL_IMP_PLUGIN_URL . 'admin/css/bootstrap.min.css' );
		wp_enqueue_style( 'wl-im-font-awesome', WL_IMP_PLUGIN_URL . 'assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'wl-im-bootstrap-select', WL_IMP_PLUGIN_URL . 'assets/css/bootstrap-select.min.css' );
		wp_enqueue_style( 'wl-im-bootstrap-datetimepicker', WL_IMP_PLUGIN_URL . 'assets/css/bootstrap-datetimepicker.min.css' );
		wp_enqueue_style( 'wl-im-toastr', WL_IMP_PLUGIN_URL . 'assets/css/toastr.min.css' );
		wp_enqueue_style( 'wl-im-jquery-confirm', WL_IMP_PLUGIN_URL . 'admin/css/jquery-confirm.min.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'jquery-form' );
		wp_enqueue_script( 'wl-im-popper-js', WL_IMP_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-bootstrap-js', WL_IMP_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-bootstrap-select-js', WL_IMP_PLUGIN_URL . 'assets/js/bootstrap-select.min.js', array( 'wl-im-bootstrap-js' ), true, true );
		wp_enqueue_script( 'wl-im-moment-js', WL_IMP_PLUGIN_URL . 'assets/js/moment.min.js', array(), true, true );
		wp_enqueue_script( 'wl-im-bootstrap-datetimepicker-js', WL_IMP_PLUGIN_URL . 'assets/js/bootstrap-datetimepicker.min.js', array( 'wl-im-bootstrap-js' ), true, true );
		wp_enqueue_script( 'wl-im-toastr-js', WL_IMP_PLUGIN_URL . 'assets/js/toastr.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-jquery-confirm-js', WL_IMP_PLUGIN_URL . 'admin/js/jquery-confirm.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-jQuery-print-js', WL_IMP_PLUGIN_URL . 'assets/js/jQuery.print.js', array( 'jquery' ), true, true );
	}

	/* Enqueue datatable assets */
	public static function enqueue_datatable_assets() {
		/* Enqueue styles */
		wp_enqueue_style( 'wl-im-dataTables-bootstrap4', WL_IMP_PLUGIN_URL . 'admin/css/dataTables.bootstrap4.min.css' );
		wp_enqueue_style( 'wl-im-responsive-bootstrap4', WL_IMP_PLUGIN_URL . 'admin/css/responsive.bootstrap4.min.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'wl-im-jquery-dataTables-js', WL_IMP_PLUGIN_URL . 'admin/js/jquery.dataTables.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-dataTables-bootstrap4-js', WL_IMP_PLUGIN_URL . 'admin/js/dataTables.bootstrap4.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-dataTables-responsive-js', WL_IMP_PLUGIN_URL . 'admin/js/dataTables.responsive.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-responsive-bootstrap4-js', WL_IMP_PLUGIN_URL . 'admin/js/responsive.bootstrap4.min.js', array( 'jquery' ), true, true );
	}

	/* Enqueue datatable export assets */
	public static function enqueue_datatable_export_assets() {
		/* Enqueue styles */
		wp_enqueue_style( 'wl-im-jquery-dataTables', WL_IMP_PLUGIN_URL . 'admin/css/jquery.dataTables.min.css' );
		wp_enqueue_style( 'wl-im-buttons-bootstrap4', WL_IMP_PLUGIN_URL . 'admin/css/buttons.bootstrap4.min.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'wl-im-dataTables-buttons-js', WL_IMP_PLUGIN_URL . 'admin/js/dataTables.buttons.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-buttons-bootstrap4-js', WL_IMP_PLUGIN_URL . 'admin/js/buttons.bootstrap4.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-jszip-js', WL_IMP_PLUGIN_URL . 'admin/js/jszip.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-pdfmake-js', WL_IMP_PLUGIN_URL . 'admin/js/pdfmake.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-vfs_fonts-js', WL_IMP_PLUGIN_URL . 'admin/js/vfs_fonts.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-jszip-js', WL_IMP_PLUGIN_URL . 'admin/js/jszip.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-buttons-html5-js', WL_IMP_PLUGIN_URL . 'admin/js/buttons.html5.min.js', array( 'wl-im-jszip-js' ), true, true );
		wp_enqueue_script( 'wl-im-buttons-print-js', WL_IMP_PLUGIN_URL . 'admin/js/buttons.print.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-buttons-colVis-js', WL_IMP_PLUGIN_URL . 'admin/js/buttons.colVis.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wl-im-datatable-export-js', WL_IMP_PLUGIN_URL . 'admin/js/wl-im-datatable-export.js', array( 'jquery' ), '2.4', true );
		wp_enqueue_script( 'wl-im-dataTables-select-js', WL_IMP_PLUGIN_URL . 'admin/js/dataTables.select.min.js', array( 'jquery' ), '2.4', true );
	}

	/* Enqueue filters assets */
	public static function enqueue_filters_assets() {
		/* Enqueue scripts */
		wp_enqueue_script( 'wl-im-filters-js', WL_IMP_PLUGIN_URL . 'admin/js/wl-im-filters.js', array( 'jquery' ), true, true );
	}

	/* Enqueue custom assets */
	public static function enqueue_custom_assets() {
		/* Enqueue styles */
		wp_enqueue_style( 'wl-im-style', WL_IMP_PLUGIN_URL . 'admin/css/wl-im-style.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'wl-im-script-js', WL_IMP_PLUGIN_URL . 'admin/js/wl-im-script.js', array( 'jquery' ), '2.5', true );
		wp_enqueue_script( 'wl-im-ajax-js', WL_IMP_PLUGIN_URL . 'admin/js/wl-im-ajax.js', array( 'jquery' ), '2.5', true );
		wp_localize_script( 'wl-im-ajax-js', 'WLIMAjax', array( 'security' => wp_create_nonce( 'wl-im' ) ) );
		wp_localize_script( 'wl-im-ajax-js', 'WL_IMP_PLUGIN_URL', WL_IMP_PLUGIN_URL );
		wp_localize_script( 'wl-im-ajax-js', 'WL_IMP_ADMIN_URL', admin_url() );
	}
}
?>