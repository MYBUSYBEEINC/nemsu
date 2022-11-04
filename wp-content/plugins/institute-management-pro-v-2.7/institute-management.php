<?php
/*
 * Plugin Name: Institute Management Pro
 * Plugin URI: https://weblizar.com
 * Description: Institute Management Pro is a comprehensive plugin to manage institute related activities such as courses, batches, enquiries, registrations, fees, students, staff etc. Print student details, id card, fees report, completion certificate etc. Also, send notifications to students. Students can pay their fees with PayPal or Razorpay payment methods.
 * Version: 2.7
 * Author: Weblizar
 * Author URI: https://weblizar.com
 * Text Domain: WL-IMP
*/

defined( 'ABSPATH' ) or die();

if ( ! defined( 'WL_IMP_DOMAIN' ) ) {
	define( 'WL_IMP_DOMAIN', 'WL-IMP' );
}

if ( ! defined( 'WL_IMP_PLUGIN_URL') ) {
	define( 'WL_IMP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WL_IMP_PLUGIN_DIR_PATH' ) ) {
	define( 'WL_IMP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

define( 'WL_IMP_WEBLIZAR_PLUGIN_URL', 'https://weblizar.com/plugins/institute-management-pro/' );
define( 'WL_IMP_VERSION', '2.7' );
include 'wlim-update-checker.php';

final class WL_IMP_InstituteManagement {
	private static $instance = null;

	private function __construct() {
		$this->initialize_hooks();
		$this->setup_database();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function initialize_hooks() {
		if ( is_admin() ) {
			require_once( 'admin/index.php' );
			require_once( 'admin/admin.php' );
		}
		require_once( 'public/public.php' );
	}

	private function setup_database() {
		require_once( 'admin/WL_IMP_Database.php' );
		register_activation_hook( __FILE__, array( 'WL_IMP_Database', 'activation' ) );
		register_deactivation_hook( __FILE__, array( 'WL_IMP_Database', 'deactivation' ) );
		register_uninstall_hook( __FILE__, array( 'WL_IMP_Database', 'deactivation' ) );
	}
}
WL_IMP_InstituteManagement::get_instance(); ?>