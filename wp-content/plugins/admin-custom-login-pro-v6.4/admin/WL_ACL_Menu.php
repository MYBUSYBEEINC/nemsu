<?php
defined( 'ABSPATH' ) or die();

class WL_ACL_Menu {
	public static function create_menu() {
		$wl_admin_menu = add_menu_page( __( 'Admin Custom Login Pro', WEBLIZAR_ACL_PRO ), __( 'Admin Custom Login Pro', WEBLIZAR_ACL_PRO ), 'manage_options', 'admin-custom-login-pro-license', array(
			'WL_ACL_Menu',
			'admin_menu'
		), 'dashicons-art', 10 );
		add_action( 'admin_print_styles-' . $wl_admin_menu, array( 'WL_ACL_Menu', 'admin_menu_assets' ) );

		$wl_admin_submenu = add_submenu_page( 'admin-custom-login-pro-license', __( 'Admin Custom Login Pro', WEBLIZAR_ACL_PRO ), __( 'Admin Custom Login Pro', WEBLIZAR_ACL_PRO ), 'manage_options', 'admin-custom-login-pro-license', array(
			'WL_ACL_Menu',
			'admin_menu'
		) );
		add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'WL_ACL_Menu', 'admin_menu_assets' ) );
	}

	public static function admin_menu() {
		require_once( 'inc/admin_menu.php' );
	}

	public static function admin_menu_assets() {
		wp_enqueue_style( 'wp_acl_lc', WEBLIZAR_ACL_PLUGIN_URL_PRO . '/admin/inc/css/admin_menu.css' );
	}
}

?>