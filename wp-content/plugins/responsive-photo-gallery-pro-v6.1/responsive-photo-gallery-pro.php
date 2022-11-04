<?php
/*
 * Plugin Name: Responsive Photo Gallery Pro
 * Version: 6.1
 * Description: Responsive Photo Gallery Pro allow you to add unlimited images galleries integrated with various light box, animation hover effects, font styles, icons, colors.
 * Author: Weblizar
 * Author URI: https://weblizar.com/plugins/responsive-photo-gallery-pro/
 * Plugin URI: https://weblizar.com/plugins/responsive-photo-gallery-pro/
 */

/**
 * Constant Variable
 */

define( "RPGP_TEXT_DOMAIN", "weblizar_image_gallery" );
define( 'RPGPro_PLUGIN_URL', 'https://weblizar.com/plugins/responsive-photo-gallery-pro/' );
define( "RPGP_PLUGIN_DIR_PATH", plugin_dir_path( __FILE__ ) );
define( 'RPGP_VERSION', '6.1' ); // Plugin Version Number
define( "RPGP_PLUGIN_URL", plugin_dir_url( __FILE__ ) );
include 'rpgp_update-checker.php';

final class WL_RPGP {
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

WL_RPGP::get_instance();

register_deactivation_hook( __FILE__, 'RPGP_WeblizarDoDeactivation_pro' );
register_uninstall_hook( __FILE__, 'RPGP_WeblizarDoDeactivation_pro' );
function RPGP_WeblizarDoDeactivation_pro() {
	RPGP_wl_remove_items();
}

require_once( RPGP_PLUGIN_DIR_PATH . '/init.php' );
?>