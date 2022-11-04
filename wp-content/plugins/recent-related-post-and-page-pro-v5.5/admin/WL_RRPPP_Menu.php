<?php
defined( 'ABSPATH' ) or die();

class WL_RRPPP_Menu {
	public static function create_menu() {
		$wl_admin_menu = add_menu_page( __( 'RR Post & Page Pro', 'rp_and_rp' ), __( 'RR Post & Page Pro', 'rp_and_rp' ), 'manage_options', 'recent-relate-page-and-post-license', array( 'WL_RRPPP_Menu', 'admin_menu' ), 'dashicons-admin-post', 10 );
		add_action( 'admin_print_styles-' . $wl_admin_menu, array( 'WL_RRPPP_Menu', 'admin_menu_assets' ) );

		$wl_admin_submenu = add_submenu_page( 'recent-relate-page-and-post-license', __( 'RR Post & Page Pro', 'rp_and_rp' ), __( 'RR Post & Page Pro', 'rp_and_rp' ), 'manage_options', 'recent-relate-page-and-post-license', array( 'WL_RRPPP_Menu', 'admin_menu' ) );
		add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'WL_RRPPP_Menu', 'admin_menu_assets' ) );
	}

	public static function admin_menu() {
		require_once( 'inc/admin_menu.php' );
	}

	public static function admin_menu_assets() {
		wp_enqueue_style( 'wp_rrppp_lc', WL_RP_RP_PLUGIN_URL . '/admin/inc/css/admin_menu.css' );
	}
}
?>