<?php
defined( 'ABSPATH' ) or die();

class WL_RPGP_Menu {
	public static function create_menu() {
		$wl_admin_menu = add_menu_page( __( 'Responsive Photo Gallery Pro', RPGP_TEXT_DOMAIN ), __( 'Responsive Photo Gallery Pro', RPGP_TEXT_DOMAIN ), 'manage_options', 'responsive-photo-gallery-pro-license', array(
			'WL_RPGP_Menu',
			'admin_menu'
		), 'dashicons-format-gallery', 4 );
		add_action( 'admin_print_styles-' . $wl_admin_menu, array( 'WL_RPGP_Menu', 'admin_menu_assets' ) );

		$wl_admin_submenu = add_submenu_page( 'responsive-photo-gallery-pro-license', __( 'Responsive Photo Gallery Pro', RPGP_TEXT_DOMAIN ), __( 'Responsive Photo Gallery Pro', RPGP_TEXT_DOMAIN ), 'manage_options', 'responsive-photo-gallery-pro-license', array(
			'WL_RPGP_Menu',
			'admin_menu'
		) );
		add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'WL_RPGP_Menu', 'admin_menu_assets' ) );
	}

	public static function admin_menu() {
		require_once( 'inc/admin_menu.php' );
	}

	public static function admin_menu_assets() {
		wp_enqueue_style( 'wp_rpgp_lc', RPGP_PLUGIN_URL . '/admin/inc/css/admin_menu.css' );
	}
}

?>