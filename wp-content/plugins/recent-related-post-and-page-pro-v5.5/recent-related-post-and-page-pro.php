<?php
/*
* Plugin Name: Recent Related Post And Page Pro
* Version: 5.5
* Description: Display the Recent, Related posts and pages with beautifully designs layouts and increase your post views. keep your audience on your site for longer by helping them discover the right content at the right time.
* Author: WebLizar
* Author URI: https://www.weblizar.com
* Plugin URI: https://www.weblizar.com/plugins/
*/
define("WL_RP_RP_PLUGIN_URL", plugin_dir_url(__FILE__));
define("RRPPP_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("WL_R_P_R_P", "WL_R_P_R_P");
define( 'RPRP_PLUGIN_LINK', 'https://weblizar.com/plugins/recent-related-post-and-page-pro');
define( 'RPRP_VERSION', '5.5'); // Plugin Version Number
include 'rprp-update-checker.php';

register_deactivation_hook( __FILE__, 'RRPPP_WeblizarDoDeactivation_pro' );
register_uninstall_hook( __FILE__, 'RRPPP_WeblizarDoDeactivation_pro' );
function RRPPP_WeblizarDoDeactivation_pro() {
	RRPPP_wl_remove_items();
}

final class WL_RRPPP {
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
WL_RRPPP::get_instance();
require_once( RRPPP_PLUGIN_DIR_PATH . '/init.php' )
?>