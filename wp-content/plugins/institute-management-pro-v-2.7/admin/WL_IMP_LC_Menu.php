<?php
defined( 'ABSPATH' ) or die();

class WL_IMP_LC_Menu {
	public static function create_menu() {
		require_once WL_IMP_PLUGIN_DIR_PATH . '/admin/WL_IMP_LM.php';
		$wl_imp_lm = WL_IMP_LM::get_instance();
		$wl_imp_lm_val = $wl_imp_lm->is_valid();

		if ( ! ( isset( $wl_imp_lm_val ) && $wl_imp_lm_val ) ) {
			$wl_admin_menu = add_menu_page( __( 'Institute Management Pro', WL_IMP_DOMAIN ), __( 'Institute Pro', WL_IMP_DOMAIN ), 'manage_options', 'institute-management-pro-license', array( 'WL_IMP_LC_Menu', 'admin_menu' ), 'dashicons-welcome-learn-more', 25 );
			add_action( 'admin_print_styles-' . $wl_admin_menu, array( 'WL_IMP_LC_Menu', 'admin_menu_assets' ) );
			$wl_admin_submenu = add_submenu_page( 'institute-management-pro-license', __( 'License', WL_IMP_DOMAIN ), __( 'License', WL_IMP_DOMAIN ), 'manage_options', 'institute-management-pro-license', array( 'WL_IMP_LC_Menu', 'admin_menu' ) );
			add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'WL_IMP_LC_Menu', 'admin_menu_assets' ) );
		}
	}

	public static function admin_menu() {
		require_once( 'inc/admin_menu.php' );
	}

	public static function admin_menu_assets() {
		wp_enqueue_style( 'wp_imp_lc', WL_IMP_PLUGIN_URL . '/admin/css/admin_menu.css' );
	}
}
?>