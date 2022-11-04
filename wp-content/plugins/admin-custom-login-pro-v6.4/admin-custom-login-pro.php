<?php
/**
 * Plugin Name: Admin Custom Login Pro
 * Version: 6.4
 * Description: Customize Your WordPress Login Screen Amazingly
 * Author: Weblizar
 * Author URI: https://weblizar.com/plugins/
 * Plugin URI: https://weblizar.com/plugins/
 * Text Domain: admin-custom-login
 * Domain Path: /languages
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
register_activation_hook( __FILE__, 'deactivate_other' );
function deactivate_other() {
	if ( is_plugin_active( 'admin-custom-login/admin-custom-login.php' ) ) {
		add_action( 'update_option_active_plugins', 'deactivate_lite_version' );
	}
}

function deactivate_lite_version() {
	deactivate_plugins( 'admin-custom-login/admin-custom-login.php' );
}

define( "WEBLIZAR_ACL_PLUGIN_URL_PRO", plugin_dir_url( __FILE__ ) );
define( "WEBLIZAR_ACL_PLUGIN_DIR_PATH_PRO", plugin_dir_path( __FILE__ ) );
define( "WEBLIZAR_ACL_PRO", "admin-custom-login");
define( 'WACL_VERSION', '6.4' ); /* Plugin Version Number */
require_once( WEBLIZAR_ACL_PLUGIN_DIR_PATH_PRO . '/wacl-update-checker.php' );

final class WL_ACL {
	private static $instance = null;

	private function __construct() {
		$this->initialize_hooks();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function initialize_hooks() {
		require_once( 'admin/index.php' );
	}
}

WL_ACL::get_instance();

/*** Admin Custom Login installation script ***/

register_activation_hook( __FILE__, 'ACL_WeblizarDoInstallation_pro' );
function ACL_WeblizarDoInstallation_pro() {
	require_once( 'installation.php' );
}

/*** Admin Custom Login deactivation/uninstall script */

register_deactivation_hook( __FILE__, 'ACL_WeblizarDoDeactivation_pro' );
register_uninstall_hook( __FILE__, 'ACL_WeblizarDoDeactivation_pro' );
function ACL_WeblizarDoDeactivation_pro() {
	ACL_wl_remove_items();
}
require_once( WEBLIZAR_ACL_PLUGIN_DIR_PATH_PRO . '/init.php' );
?>
