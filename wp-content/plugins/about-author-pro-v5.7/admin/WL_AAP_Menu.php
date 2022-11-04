<?php
defined( 'ABSPATH' ) or die();

class WL_AAP_Menu {
	public static function create_menu() {
		$wl_admin_menu = add_menu_page( __( 'About Author', WL_ABTM_TXT_DM ), __( 'About Author', WL_ABTM_TXT_DM ), 'manage_options', 'about-author-pro-license', array(
			'WL_AAP_Menu',
			'admin_menu'
		), 'dashicons-id', 10 );
		add_action( 'admin_print_styles-' . $wl_admin_menu, array( 'WL_AAP_Menu', 'admin_menu_assets' ) );

		$wl_admin_submenu = add_submenu_page( 'about-author-pro-license', __( 'About Author', WL_ABTM_TXT_DM ), __( 'About Author', WL_ABTM_TXT_DM ), 'manage_options', 'about-author-pro-license', array(
			'WL_AAP_Menu',
			'admin_menu'
		) );
		add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'WL_AAP_Menu', 'admin_menu_assets' ) );
	}

	public static function admin_menu() {
		require_once( 'inc/admin_menu.php' );
	}

	public static function admin_menu_assets() {
		wp_enqueue_style( 'wp_aap_lc', WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . '/admin/inc/css/admin_menu.css' );
	}
}

?>