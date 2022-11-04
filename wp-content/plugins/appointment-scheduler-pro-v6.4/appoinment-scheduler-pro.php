<?php
/*
* Plugin Name: Appointment Scheduler Pro
* Version: 6.4
* Description: Appointment Scheduler Pro adds a booking system to WordPress, allowing customers to book and pay for appointments, service that needs to be scheduled by date and time.
* Author: Weblizar
* Author URI: https://weblizar.com/
* Plugin URI: https://weblizar.com/plugins/appointment-scheduler-pro/
*/

define( 'ASP_VERSION', '6.4' ); // Plugin Version Number
define( 'ASP_PLUGIN_URL', 'https://weblizar.com/plugins/appointment-scheduler-pro/' );
// include 'asp_update-checker.php';

define( 'WEBLIZAR_A_P_SYSTEM', plugin_dir_url( __FILE__ ) );
define( 'ASP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WL_A_P_SYSTEM', 'WL_A_P_SYSTEM' );

final class WL_ASP {
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
		require_once 'admin/index.php';
	}
}
WL_ASP::get_instance();

register_activation_hook( __FILE__, 'Ap_InstallScript_function' );
function Ap_InstallScript_function() {
	include 'install_script.php';
}

/*this function will tranlate the plugin*/
add_action( 'plugins_loaded', 'ASP_LoadTranslation' );
function ASP_LoadTranslation() {
	load_plugin_textdomain( WL_A_P_SYSTEM, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/*
function UninstallScript_function() {
	include('uninstall.php');
}
register_deactivation_hook( __FILE__, 'UninstallScript_function' );
*/
register_deactivation_hook( __FILE__, 'ASP_WeblizarDoDeactivation_pro' );
register_uninstall_hook( __FILE__, 'ASP_WeblizarDoDeactivation_pro' );
function ASP_WeblizarDoDeactivation_pro() {
	ASP_wl_remove_items();
}
require_once ASP_PLUGIN_DIR_PATH . '/init.php';
function appointment_scheduler_page_contentt() {
	if (! is_admin() ) {
		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . '/bootstrap/css/bootstrap.min.css', array(), true );
	wp_enqueue_style( 'ap_dataTables_bootstrap', WEBLIZAR_A_P_SYSTEM . '/css/dataTables.bootstrap.min.css', array(), true );
	wp_enqueue_style( 'ap_bootstrap-table', WEBLIZAR_A_P_SYSTEM . '/css/bootstrap-table.css', array(), true );
	wp_enqueue_style( 'font-awesome', WEBLIZAR_A_P_SYSTEM . '/css/all.min.css', array(), true );
	wp_enqueue_style( 'ap_animate_css', WEBLIZAR_A_P_SYSTEM . '/css/animate.css', array(), true );
	wp_enqueue_style( 'ap_animate', WEBLIZAR_A_P_SYSTEM . '/css/animate.min.css', array(), true );
	wp_enqueue_style( 'ap_icon_picker', WEBLIZAR_A_P_SYSTEM . '/css/icon-picker.css', array(), true );
	wp_enqueue_style( 'ap_genericons_css', WEBLIZAR_A_P_SYSTEM . '/css/genericons.css', array(), true );
	wp_enqueue_style( 'ap_style', WEBLIZAR_A_P_SYSTEM . '/css/ap_style.css', array(), true );
	wp_enqueue_style( 'ap_style_css_2', WEBLIZAR_A_P_SYSTEM . '/css/style_2.css', array(), true );
	wp_enqueue_style( 'responsive_dataTables', WEBLIZAR_A_P_SYSTEM . '/css/responsive.dataTables.min.css', array(), true );

	wp_enqueue_style( 'cal_themes', WEBLIZAR_A_P_SYSTEM . '/calender/jquery-ui.min.css', array(), true );
	wp_enqueue_style( 'fullcalendarcss', WEBLIZAR_A_P_SYSTEM . 'calender/fullcalendar.css', array(), true );
	wp_enqueue_script( 'moment_min_js', WEBLIZAR_A_P_SYSTEM . '/calender/moment_min.js', true );
	wp_enqueue_script( 'jquery_ui_custom_min', WEBLIZAR_A_P_SYSTEM . '/calender/jquery_ui_custom_min.js', true );
	wp_enqueue_script( 'fullcalendar_min', WEBLIZAR_A_P_SYSTEM . '/calender/fullcalendar_min.js', true );
	wp_enqueue_style( 'bootstrap-year-calendar_css', WEBLIZAR_A_P_SYSTEM . '/calender/bootstrap-year-calendar.css', array(), true );
	wp_enqueue_script( 'bootstrap-year-calendar_js', WEBLIZAR_A_P_SYSTEM . '/calender/bootstrap-year-calendar.js', true );
	wp_enqueue_script( 'date_picker_js', WEBLIZAR_A_P_SYSTEM . 'js/date_picker.js', array( 'jquery' ) );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'custom_script_js', WEBLIZAR_A_P_SYSTEM . 'js/custom-script.js', array( 'jquery' ) );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_script( 'ap_upload_media_widget', WEBLIZAR_A_P_SYSTEM . 'js/upload-media.js', array( 'jquery' ) );
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_script( 'ap_dataTables_min', WEBLIZAR_A_P_SYSTEM . '/js/jquery.dataTables.min.js', array( 'jquery' ) );
	wp_enqueue_style( 'data_table_css', WEBLIZAR_A_P_SYSTEM . '/css/jquery.dataTables.min.css', array(), true );
	wp_enqueue_script( 'ap_bootstrap_js', WEBLIZAR_A_P_SYSTEM . '/js/dataTables.bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap', WEBLIZAR_A_P_SYSTEM . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'ap_bootstrap_table', WEBLIZAR_A_P_SYSTEM . '/js/bootstrap-table.js', array( 'jquery' ) );
	wp_enqueue_script( 'ap_icon_picker_js', WEBLIZAR_A_P_SYSTEM . '/js/icon-picker.js', array( 'jquery' ) );
	wp_enqueue_script( 'ap_fullcalendar_min_js', WEBLIZAR_A_P_SYSTEM . '/js/fullcalendar.min.js', array( 'jquery' ) );

	wp_enqueue_script( 'ap_jquery_flot', WEBLIZAR_A_P_SYSTEM . '/js/jquery.flot.js', array( 'jquery' ) );
	wp_enqueue_script( 'ap_jquery_knob', WEBLIZAR_A_P_SYSTEM . '/js/jquery.knob.modified.js', array( 'jquery' ) );
	wp_enqueue_script( 'ap_jquery_sparkline', WEBLIZAR_A_P_SYSTEM . '/js/jquery.sparkline.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'ap_counter_js', WEBLIZAR_A_P_SYSTEM . 'js/counter.js', array( 'jquery' ) );
	wp_enqueue_script( 'ap_custom_custom_js', WEBLIZAR_A_P_SYSTEM . 'js/custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'dataTables_responsive', WEBLIZAR_A_P_SYSTEM . '/js/dataTables.responsive.min.js', array( 'jquery' ) );

	wp_enqueue_style( 'ap_tel_css', WEBLIZAR_A_P_SYSTEM . 'js/contact/intlTelInput.css', array(), true );
	wp_enqueue_script( 'ap_tel_js', WEBLIZAR_A_P_SYSTEM . '/js/contact/intlTelInput.js', array( 'jquery' ) );
	wp_enqueue_script( 'data-table-js', WEBLIZAR_A_P_SYSTEM . '/js/jquery.dataTables.min.js', true );
	wp_enqueue_script( 'jquery.flot.pie-js', WEBLIZAR_A_P_SYSTEM . '/js/jquery.flot.pie.js', true );
	wp_enqueue_style( 'font_family_css', WEBLIZAR_A_P_SYSTEM . '/css/googleapis.css', array(), true );
	wp_enqueue_style( 'ap_style_css', WEBLIZAR_A_P_SYSTEM . '/css/style.css', array(), true );
	wp_enqueue_style( 'ap_media_screen', WEBLIZAR_A_P_SYSTEM . '/css/media-screen.css', array(), true );
	wp_enqueue_script( 'notify_js', WEBLIZAR_A_P_SYSTEM . '/js/alertbox/notify.js', array( 'jquery' ) );
	wp_enqueue_style( 'alert_css', WEBLIZAR_A_P_SYSTEM . 'js/alertbox/notify.css', array(), true );
	wp_enqueue_script( 'confirmation_js', WEBLIZAR_A_P_SYSTEM . '/js/confirmation/jquery-confirm.min.js', true );
	wp_enqueue_style( 'confirmation_css', WEBLIZAR_A_P_SYSTEM . '/js/confirmation/jquery-confirm.min.css', array(), true );
	wp_enqueue_script( 'multidatespicker_js', WEBLIZAR_A_P_SYSTEM . '/js/multidatespicker/jquery-ui.multidatespicker.js', true );
	wp_enqueue_style( 'ap_multiselect_css', WEBLIZAR_A_P_SYSTEM . 'js/multi-select/jquery.multiselect.css', array(), true );
	wp_enqueue_script( 'ap_multiselect_js', WEBLIZAR_A_P_SYSTEM . '/js/multi-select/jquery.multiselect.js', array( 'jquery' ), true );
	wp_enqueue_style( 'clockpicker_css', WEBLIZAR_A_P_SYSTEM . '/js/timepicker_assets/clockpicker.css', array(), true );
	wp_enqueue_script( 'clockpicker_js', WEBLIZAR_A_P_SYSTEM . '/js/timepicker_assets/clockpicker.js', array( 'jquery' ), true );
	wp_enqueue_style( 'preloader_css', WEBLIZAR_A_P_SYSTEM . 'js/preloader/examples.css', array(), true );
	wp_enqueue_script( 'preloader_js', WEBLIZAR_A_P_SYSTEM . '/js/preloader/jquery.preloader.min.js', array( 'jquery' ), true );
	wp_enqueue_style( 'timepicker_css', WEBLIZAR_A_P_SYSTEM . 'js/timepicker_assets/wickedpicker.min.css', array(), true );
	wp_enqueue_script( 'timepicker_js', WEBLIZAR_A_P_SYSTEM . '/js/timepicker_assets/wickedpicker.js', array( 'jquery' ), true );

	// js scripts

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'owl_carousel_js', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/owl-carousel/owl.carousel.js', true );
	wp_enqueue_script( 'razorpay_js', 'https://checkout.razorpay.com/v1/checkout.js', true );
	wp_enqueue_style( 'owl_carousel_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/owl-carousel/owl.carousel.css', array(), true );
	wp_enqueue_style( 'owl_carousel_theme_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/owl-carousel/owl.theme.css', array(), true );
	wp_enqueue_script( 'confirmation_js', WEBLIZAR_A_P_SYSTEM . '/js/confirmation/jquery-confirm.min.js', true );
	wp_enqueue_style( 'confirmation_css', WEBLIZAR_A_P_SYSTEM . '/js/confirmation/jquery-confirm.min.css', array(), true );
	wp_enqueue_script( 'ajax_custom_script', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/js/jquery-migrate-1.4.1.min.js', array( 'jquery' ) );
	wp_localize_script( 'ajax_custom_script', 'frontendajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'swiper_js', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/swiper.min.js', true );
	wp_enqueue_style( 'media_screen_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/media_screen.css', array(), true );
	wp_enqueue_style( 'swiper_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/swiper.min.css', array(), true );
	wp_enqueue_style( 'font-awesome', WEBLIZAR_A_P_SYSTEM . '/css/all.min.css', array(), true );
	wp_enqueue_style( 'bootstrap', WEBLIZAR_A_P_SYSTEM . '/bootstrap/css/bootstrap.min.css', array(), true );
	wp_enqueue_script( 'bootstrap', WEBLIZAR_A_P_SYSTEM . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'dated_js', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/datedropper_assets/datedropper.js', true );
	wp_enqueue_style( 'dated_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/datedropper_assets/datedropper.css', array(), true );
	wp_enqueue_script( 'preloader_js', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/jquery.preloader.min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'date_picker_js', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/date_picker.js', array( 'jquery' ), true );
	wp_enqueue_style( 'datepicker_smoothness_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/datepicker_smoothness.css', array(), true );
	wp_enqueue_script( 'notify_js', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/alertbox/notify.js', true );
	wp_enqueue_style( 'notify_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/alertbox/notify.css', array(), true );
	wp_enqueue_style( 'examples_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/examples.css', array(), true );
	wp_enqueue_style( 'style_03_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/style_03.css', array(), true );
	wp_enqueue_style( 'media_css', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/media_screen.css', array(), true );
	wp_enqueue_style( 'ap_tel', WEBLIZAR_A_P_SYSTEM . 'shortcode/frontend/contact/intlTelInput.css', array(), true );
	wp_enqueue_script( 'ap_tel', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/contact/intlTelInput.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom-script_js', WEBLIZAR_A_P_SYSTEM . '/shortcode/frontend/custom-script.js', array( 'jquery' ), true );
	wp_enqueue_script( 'js-stripe', 'https://js.stripe.com/v2/' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'bootstrap', WEBLIZAR_A_P_SYSTEM . 'bootstrap/css/bootstrap.min.css', array(), true );
	}
}

add_action('wp_enqueue_scripts', 'appointment_scheduler_page_contentt');
add_action('admin_enqueue_scripts', 'appointment_scheduler_page_contentt');

