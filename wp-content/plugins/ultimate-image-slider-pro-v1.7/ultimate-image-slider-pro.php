<?php
/*
 * Plugin Name: Ultimate Image Slider Pro
 * Plugin URI: https://weblizar.com/plugins
 * Description: Ultimate Image Slider Pro comes with different slider layouts which can be used to create and display multiple sliders on your WordPress website.
 * Version: 1.7
 * Author: Weblizar
 * Author URI: https://weblizar.com
 * Text Domain: urisp
*/

defined( 'ABSPATH' ) || die();

if ( ! defined( 'UISP_PLUGIN_URL' ) ) {
	define( 'UISP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'UISP_PLUGIN_DIR_PATH' ) ) {
	define( 'UISP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

define( 'UISP_WEBLIZAR_PLUGIN_URL', 'https://weblizar.com/plugins/ultimate-image-slider-pro/' );
define( 'UISP_VERSION', '1.7' );

final class UISP {
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
		require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/UISP_Database.php';
		register_deactivation_hook( __FILE__, array( 'UISP_Database', 'deactivation' ) );
		register_uninstall_hook( __FILE__, array( 'UISP_Database', 'deactivation' ) );
		
		if ( is_admin() ) {
			require_once UISP_PLUGIN_DIR_PATH . 'admin/admin.php';
		}
		require_once UISP_PLUGIN_DIR_PATH . 'public/public.php';
	}
}
UISP::get_instance();
