<?php
defined( 'ABSPATH' ) or die();

class WL_ASP_Menu {
	public static function create_menu() {
		$wl_admin_menu = add_menu_page( __( 'Appointment Scheduler Pro', WL_A_P_SYSTEM ), __( 'Appointment Scheduler Pro', WL_A_P_SYSTEM ), 'manage_options', 'appointment-scheduler-pro-license', array( 'WL_ASP_Menu', 'admin_menu' ), 'dashicons-calendar', 10 );
		add_action( 'admin_print_styles-' . $wl_admin_menu, array( 'WL_ASP_Menu', 'admin_menu_assets' ) );

		$wl_admin_submenu = add_submenu_page( 'appointment-scheduler-pro-license', __( 'Appointment Scheduler Pro', WL_A_P_SYSTEM ), __( 'Appointment Scheduler Pro', WL_A_P_SYSTEM ), 'manage_options', 'appointment-scheduler-pro-license', array( 'WL_ASP_Menu', 'admin_menu' ) );
		add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'WL_ASP_Menu', 'admin_menu_assets' ) );
	}

	public static function admin_menu() {
		require_once( 'inc/admin_menu.php' );
	}

	public static function admin_menu_assets() {
		wp_enqueue_style( 'wp_asp_lc', WEBLIZAR_A_P_SYSTEM . '/admin/inc/css/admin_menu.css' );
	}
}
?>