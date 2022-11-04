<?php
/*
* Plugin Name: About Author Pro 
* Version: 5.7
* Description: Displaying a brief biography about the author at the end of the post and anywhere on WordPress Sites.
* Author: WebLizar
* Author URI: https://www.weblizar.com
* Plugin URI: https://weblizar.com/plugins/about-author-pro/
*/

define( "WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL", plugin_dir_url( __FILE__ ) );
define( "AAP_PLUGIN_DIR_PATH", plugin_dir_path( __FILE__ ) );
define( 'WL_ABTM_TXT_DM', 'WL_ABTM_TXT_DM' );
define( 'ABTMPro_PLUGIN_URL', 'https://weblizar.com/plugins/about-author-pro/' );
define( 'ABTM_VERSION', '5.7' ); // Plugin Version Number
include 'abtm_update-checker.php';

register_deactivation_hook( __FILE__, 'AAP_WeblizarDoDeactivation_pro' );
register_uninstall_hook( __FILE__, 'AAP_WeblizarDoDeactivation_pro' );
function AAP_WeblizarDoDeactivation_pro() {
	AAP_wl_remove_items();
}

final class WL_AAP {
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

WL_AAP::get_instance();

require_once( AAP_PLUGIN_DIR_PATH . '/init.php' );
?>