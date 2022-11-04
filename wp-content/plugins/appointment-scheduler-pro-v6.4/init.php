<?php
/*
function UninstallScript_function() {
	include('uninstall.php');
}
register_deactivation_hook( __FILE__, 'UninstallScript_function' );
*/
function user_id_exists( $user ) {
	global $wpdb;
	$staff_table  = $wpdb->prefix . 'apt_staff';
	$client_table = $wpdb->prefix . 'apt_clients';

	$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `$staff_table` WHERE staff_email = %s", $user ) );
	/* for customer */
	$count_client = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `$client_table` WHERE email = %s", $user ) );

	$client_dashboard = get_option( 'weblizar_aps_client_dashboard_settings' );

	if ( ! empty( $client_dashboard['client_appointment'] ) ) {
		$client_appointment = $client_dashboard['client_appointment'];
	} else {
		$client_appointment = 'no';
	}

	if ( $count == 1 ) {
		return true; }
	if ( $count_client == 1 && $client_appointment == 'yes' ) {
		return true; } else {
		return false; }
}

$wl_asp_lm_val = WL_ASP_LM::get_instance()->is_valid();

add_action( 'admin_menu', 'appointment_scheduler_menu' );
function appointment_scheduler_menu() {
	global $wl_asp_lm_val;
	$cuid   = get_current_user_id();
	$client = get_user_by( 'id', $cuid );
	// var_dump($client);
	if ( isset( $wl_asp_lm_val ) && $wl_asp_lm_val ) {
		if ( ! empty( $client ) ) {
			$client_user_email = $client->user_email;
			$role              = $client->roles;
			$user_role         = $role[0];
		}

		if ( user_id_exists( $client_user_email ) && $user_role != 'administrator' ) {
			// it does exists
			// dashboard menu page
			add_menu_page( 'Appointment Scheduler Pro', 'Appointment Scheduler Pro', 'subscriber', 'ap_system', 'appointment_scheduler_page_content', 'dashicons-calendar', '10' );
			add_submenu_page( 'ap_system', __( 'Appointment Scheduler Pro', WL_A_P_SYSTEM ), __( 'Appointment Scheduler Pro', WL_A_P_SYSTEM ), 'subscriber', 'ap_system', 'appointment_scheduler_page_content' );
		} else {
			// it doesn't
			// dashboard menu page
			add_menu_page( 'Appointment Scheduler Pro', 'Appointment Scheduler Pro', 'manage_options', 'ap_system', 'appointment_scheduler_page_content', 'dashicons-calendar', '10' );
			add_submenu_page( 'ap_system', __( 'Appointment Scheduler Pro', WL_A_P_SYSTEM ), __( 'Appointment Scheduler Pro', WL_A_P_SYSTEM ), 'manage_options', 'ap_system', 'appointment_scheduler_page_content' );
			$wl_admin_submenu = add_submenu_page( 'ap_system', __( 'License', WL_A_P_SYSTEM ), __( 'License', WL_A_P_SYSTEM ), 'manage_options', 'appointment-scheduler-pro-license', array( 'WL_ASP_Menu', 'admin_menu' ) );
			add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'WL_ASP_Menu', 'admin_menu_assets' ) );
		}
	}
}

if ( ! ( isset( $wl_asp_lm_val ) && $wl_asp_lm_val ) ) {
	add_action( 'admin_menu', array( 'WL_ASP_Menu', 'create_menu' ), 1 );
}

/*for woocommerce function*/
	add_filter( 'woocommerce_disable_admin_bar', '_wc_disable_admin_bar', 10, 1 );

function _wc_disable_admin_bar( $prevent_admin_access ) {

	return false;
}

	add_filter( 'woocommerce_prevent_admin_access', '_wc_prevent_admin_access', 10, 1 );

function _wc_prevent_admin_access( $prevent_admin_access ) {

	return false;
}
/*for woocommerce function*/

function appointment_scheduler_page_content() {
	include 'admin/main_page.php';

}

function appointment_scheduler_assets() {

	// # only register and queue scripts & styles on POST edit screen of admin
	if ( $_GET['page'] == 'ap_system' ) {

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
	}
}
require_once 'appointment-scheduler-pro-widget.php';

add_action( 'admin_enqueue_scripts', 'appointment_scheduler_assets' );

// customer json
function fn_my_ajaxified_dataloader_ajax() {
	include 'admin/customer-json.php';
	die();
}

add_action( 'wp_ajax_fn_my_ajaxified_dataloader_ajax', 'fn_my_ajaxified_dataloader_ajax' );
add_action( 'wp_ajax_nopriv_fn_my_ajaxified_dataloader_ajax', 'fn_my_ajaxified_dataloader_ajax' );
// customer fetch
function example_ajax_request() {
	include 'admin/customer-fetch.php';
	die();
}
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );

// coupon json
function fn_my_coupon_dataloader_ajax() {
	include 'admin/coupon-json.php';
	die();
}
add_action( 'wp_ajax_fn_my_coupon_dataloader_ajax', 'fn_my_coupon_dataloader_ajax' );
add_action( 'wp_ajax_nopriv_fn_my_coupon_dataloader_ajax', 'fn_my_coupon_dataloader_ajax' );

// coupon fetch
function coupon_ajax_request() {
	include 'admin/coupon-fetch.php';
	die();
}
add_action( 'wp_ajax_coupon_ajax_request', 'coupon_ajax_request' );

function APPT_activation_hook() {
	add_option( 'APPT_plugin_do_activation_redirect', true );
}
register_activation_hook( __FILE__, 'APPT_activation_hook' );

function APPT_activation_redirect() {
	if ( get_option( 'APPT_plugin_do_activation_redirect', false ) ) {
		delete_option( 'APPT_plugin_do_activation_redirect' );
		if ( ! isset( $_GET['activate-multi'] ) ) {
			wp_redirect( 'admin.php?page=ap_system' );
		}
	}
}
add_action( 'admin_init', 'APPT_activation_redirect' );

// Staff holiday fetch
function staff_holiday_ajax_request() {
	include 'admin/staff-holiday-fetch.php';
	die();
}
add_action( 'wp_ajax_staff_holiday_ajax_request', 'staff_holiday_ajax_request' );

/*Plugin Setting Moved to option table for old users of pro or not for first timer user*/
add_action( 'admin_notices', 'setting_not_moved_error_notice' );
function setting_not_moved_error_notice() {
	global $wpdb;
	$SettingManagerTable = $wpdb->prefix . 'apt_settings';
	if ( $wpdb->get_var( "SHOW TABLES LIKE '$SettingManagerTable'" ) == $SettingManagerTable ) {
		$query   = "SHOW COLUMNS FROM $SettingManagerTable LIKE 'paypal_checkout'";
		$resultt = $wpdb->get_results( $query, ARRAY_A );
		if ( ! empty( $resultt ) && $resultt[0]['Field'] == 'paypal_checkout' ) {
			$paymentsetting    = get_option( 'weblizar_aps_payment_setting' );
			$paypal_checkout   = $paymentsetting['paypal_checkout'];
			$razorpay_checkout = $paymentsetting['razorpay_checkout'];
			$paypal_email      = $paymentsetting['paypal_email'];
			$razorpay_api      = $paymentsetting['razorpay_api_key'];
			if ( $paypal_checkout == 'p-enable' && $paypal_email == 'xyz@gmail.com' ) {
				?>
				<div class="error notice">
				<p><?php _e( 'Please Update The Payment Settings', WL_A_P_SYSTEM ); ?></p>
				</div>
				<?php
			} elseif ( $razorpay_checkout == 'r-enable' && $razorpay_api == '' ) {
				?>
				<div class="error notice">
					<p><?php _e( 'Please Update The Payment Settings', WL_A_P_SYSTEM ); ?></p>
				</div>
				<?php
			}
		}
	}

	$paymentsetting        = get_option( 'weblizar_aps_payment_setting' );
		$paypal_checkout   = $paymentsetting['paypal_checkout'];
		$razorpay_checkout = $paymentsetting['razorpay_checkout'];
		$paypal_email      = $paymentsetting['paypal_email'];
		$razorpay_api      = $paymentsetting['razorpay_api_key'];
	if ( $paypal_checkout == 'p-enable' && $paypal_email == 'xyz@gmail.com' ) {
		?>
				<div class="error notice">
				<p><?php _e( 'Please Update The Payment Settings', WL_A_P_SYSTEM ); ?></p>
				</div>
			<?php
	} elseif ( $razorpay_checkout == 'r-enable' && $razorpay_api == '' ) {
		?>
				<div class="error notice">
					<p><?php _e( 'Please Update The Payment Settings', WL_A_P_SYSTEM ); ?></p>
				</div>
			<?php
	}
}
// appointment json
function fn_my_appointment_dataloader_ajax() {
	include 'admin/appointment-json.php';
	die();
}
add_action( 'wp_ajax_fn_my_appointment_dataloader_ajax', 'fn_my_appointment_dataloader_ajax' );
add_action( 'wp_ajax_nopriv_fn_my_appointment_dataloader_ajax', 'fn_my_appointment_dataloader_ajax' );

// appointment fetch
function appointment_ajax_request() {
	include 'admin/appointment-fetch.php';
	die();
}
add_action( 'wp_ajax_appointment_ajax_request', 'appointment_ajax_request' );

// service fetch
function service_ajax_request() {
	include 'admin/service-ajax.php';
	die();
}
add_action( 'wp_ajax_service_ajax_request', 'service_ajax_request' );

// service fetch
function staff_service_ajax_request() {
	include 'admin/staff-service.php';
	die();
}
add_action( 'wp_ajax_staff_service_ajax_request', 'staff_service_ajax_request' );

// Location Service fetch
function location_ajax_request() {
	include 'admin/location-ajax.php';
	die();
}
add_action( 'wp_ajax_location_ajax_request', 'location_ajax_request' );

// fullcalender json
function full_calendar_dataloader_ajax() {
	include 'admin/json-events.php';
	die();
}
add_action( 'wp_ajax_full_calendar_dataloader_ajax', 'full_calendar_dataloader_ajax' );

// calendar customer fetch
function calendar_customer_ajax_request() {
	include 'admin/calendar_customer.php';
	die();
}
add_action( 'wp_ajax_calendar_customer_ajax_request', 'calendar_customer_ajax_request' );

// calendar staff fetch
function calendar_staff_ajax_request() {
	include 'admin/calendar_staff.php';
	die();
}
add_action( 'wp_ajax_calendar_staff_ajax_request', 'calendar_staff_ajax_request' );

// calendar service fetch
function calendar_service_ajax_request() {
	include 'admin/calendar_service.php';
	die();
}
add_action( 'wp_ajax_calendar_service_ajax_request', 'calendar_service_ajax_request' );

// category fetch on model
function category_fetch_ajax_request() {
	include 'admin/category-fetch.php';
	die();
}
add_action( 'wp_ajax_category_fetch_ajax_request', 'category_fetch_ajax_request' );

// Location fetch on model
function location_fetch_ajax_request() {
	include 'admin/location-fetch.php';
	die();
}
add_action( 'wp_ajax_location_fetch_ajax_request', 'location_fetch_ajax_request' );

// Payment fetch on model
function payment_fetch_ajax_request() {
	include 'admin/payment-fetch.php';
	die();
}
add_action( 'wp_ajax_payment_fetch_ajax_request', 'payment_fetch_ajax_request' );

// payment json
function payment_json_ajax_request() {
	include 'admin/payment-json.php';
	die();
}
add_action( 'wp_ajax_payment_json_ajax_request', 'payment_json_ajax_request' );



// reminder json
function reminder_json_ajax_request() {
	include 'admin/reminder_log-json.php';
	die();
}
add_action( 'wp_ajax_reminder_json_ajax_request', 'reminder_json_ajax_request' );

// holiday json
function holiday_json_ajax_request() {
	include 'admin/holiday-json.php';
	die();
}
add_action( 'wp_ajax_holiday_json_ajax_request', 'holiday_json_ajax_request' );

// holiday fetch on model
function holiday_fetch_ajax_request() {
	include 'admin/holiday-fetch.php';
	die();
}
 add_action( 'wp_ajax_holiday_fetch_ajax_request', 'holiday_fetch_ajax_request' );

// dashboard data fecth
function dashboard_fetch_ajax_request() {
	include 'admin/dashboard-ajax.php';
	die();
}
add_action( 'wp_ajax_dashboard_fetch_ajax_request', 'dashboard_fetch_ajax_request' );

// dashboard reports download
function download_ajax_reports() {
	include 'admin/download_reports.php';
	die();
}
add_action( 'wp_ajax_download_ajax_reports', 'download_ajax_reports' );


// front_end - ajax coupon details
function front_coupon_ajax_request() {
	include 'shortcode/apply_coupon.php';
	die();
}
add_action( 'wp_ajax_front_coupon_ajax_request', 'front_coupon_ajax_request' );
add_action( 'wp_ajax_nopriv_front_coupon_ajax_request', 'front_coupon_ajax_request' );


function paypal_ajax_request() {
	include 'shortcode/paypal_redirect.php';
	die();
}
add_action( 'wp_ajax_paypal_ajax_request', 'paypal_ajax_request' );
add_action( 'wp_ajax_nopriv_paypal_ajax_request', 'paypal_ajax_request' );

function time_ajax_request() {
	include 'shortcode/time-slot-calculate.php';
	die();
}
add_action( 'wp_ajax_time_ajax_request', 'time_ajax_request' );
add_action( 'wp_ajax_nopriv_time_ajax_request', 'time_ajax_request' );

// staff fileter
function staff_ajax_request() {
	include 'shortcode/staff_filter.php';
	die();
}
add_action( 'wp_ajax_staff_ajax_request', 'staff_ajax_request' );
add_action( 'wp_ajax_nopriv_staff_ajax_request', 'staff_ajax_request' );

function details_ajax_request() {
	include 'shortcode/details.php';
	die();
}
add_action( 'wp_ajax_details_ajax_request', 'details_ajax_request' );
add_action( 'wp_ajax_nopriv_details_ajax_request', 'details_ajax_request' );

function login_ajax_request() {
	include 'shortcode/login.php';
	die();
}
add_action( 'wp_ajax_login_ajax_request', 'login_ajax_request' );
add_action( 'wp_ajax_nopriv_login_ajax_request', 'login_ajax_request' );

function ap_shortcode() {
	include 'shortcode/ap_system.php';
}
add_action( 'init', 'ap_shortcode' );

// run cron reminder
add_action( 'plugins_loaded', 'weblizar_load_apcal_reminder', 10 ); // this hook for wp_mail use after all plugins_loaded
function weblizar_load_apcal_reminder() {

	// insert row every second 5 second on recurring visit by any user on site
	add_action( 'wp', 'weblizar_apcal_reminder_activation' );
	function weblizar_apcal_reminder_activation() {
		if ( ! wp_next_scheduled( 'apcal_reminder_event' ) ) {
			wp_schedule_event( time(), 'customrecurrence', 'apcal_reminder_event' );
		}
	}

	add_action( 'apcal_reminder_event', 'weblizar_send_apcal_reminders' );
	function weblizar_send_apcal_reminders() {

		// Including Email Reminder Class
		include_once 'mailfiles/PHPMailerAutoload.php';
		include_once 'admin/email-reminder.php';
	}

	// custom recurrence
	function weblizar_custom_recurrence_time( $schedules ) {
		$schedules['customrecurrence'] = array(
			'interval' => 60 * 60,
			'display'  => __( 'Every Hour' ),
		);
		return $schedules;
	}
	add_filter( 'cron_schedules', 'weblizar_custom_recurrence_time' );
}

register_activation_hook( __FILE__, 'APPOINT_NotificationSettings' );
function APPOINT_NotificationSettings() {
	// Notify Admin On Pending Appointment
	$admin_pending_subject = 'Hi  [ADMIN_NAME]  : New Appointment Scheduled By [CLIENT_NAME] is [APPOINTMENT_STATUS]';
	$admin_pending_body    = '
Hi Admin,
	
Appointment Details:

Client Name: [CLIENT_NAME]
Client Email: [CLIENT_EMAIL]
Appointment For: [SERVICE_NAME]
Appointment Date: 	[APPOINTMENT_DATE]
Appointment Time: 	[APPOINTMENT_TIME]
Appointment Status: 	[APPOINTMENT_STATUS]

View this appointment at [SITE_URL] dashboard.

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';

	// Notify Admin On Approved Appointment
	$admin_approved_subject = 'Hi  [ADMIN_NAME]  : New Appointment Scheduled By [CLIENT_NAME] is [APPOINTMENT_STATUS]';
	$admin_approved_body    = '
Hi Admin,
	
Appointment Details:

Client Name: [CLIENT_NAME]
Client Email: [CLIENT_EMAIL]
Appointment For: [SERVICE_NAME]
Appointment Date: 	[APPOINTMENT_DATE]
Appointment Time: 	[APPOINTMENT_TIME]
Appointment Status: 	[APPOINTMENT_STATUS]

View this appointment at [SITE_URL] dashboard.

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';

	// Notify Admin On Cancelled Appointment
	$admin_cancel_subject = 'Hi  [ADMIN_NAME]  : New Appointment Scheduled By [CLIENT_NAME] is [APPOINTMENT_STATUS]';
	$admin_cancel_body    = '
Hi Admin,
	
Appointment Details:

Client Name: [CLIENT_NAME]
Client Email: [CLIENT_EMAIL]
Appointment For: [SERVICE_NAME]
Appointment Date: 	[APPOINTMENT_DATE]
Appointment Time: 	[APPOINTMENT_TIME]
Appointment Status: 	[APPOINTMENT_STATUS]

View this appointment at [SITE_URL] dashboard.

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';

	// Notify Client On Pending Appointment
	$client_pending_subject = '[BLOG_NAME] : Appointment Status.';
	$client_pending_body    = '
Hi [CLIENT_NAME],

Your appointment for [SERVICE_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] is [APPOINTMENT_STATUS]..

Thank you for scheduling appointment with [BLOG_NAME].

Please Dont forget!!!

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';
	// Notify Client On Approved Appointment
	$client_approved_subject = '[BLOG_NAME] : Appointment Status.';
	$client_approved_body    = '
Hi [CLIENT_NAME],

Your scheduled appointment for [SERVICE_NAME] on [APPOINTMENT_DATE] from [APPOINTMENT_TIME] has been [APPOINTMENT_STATUS].

Thank you for scheduling appointment with [BLOG_NAME].

Please Dont forget!!!

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';
	// Notify Client On Cancelled Appointment
	$client_cancel_subject = '[BLOG_NAME] : Appointment Status.';
	$client_cancel_body    = '
Hi [CLIENT_NAME],

Your scheduled appointment for [SERVICE_NAME] on [APPOINTMENT_DATE] from [APPOINTMENT_TIME] has been [APPOINTMENT_STATUS].

Thank you for scheduling appointment with [BLOG_NAME].


Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';

	// Notify Staff On Pending Appointment
	$staff_pending_subject = '[BLOG_NAME].: Appointment Status.';
	$staff_pending_body    = '
Hi [STAFF_NAME],

Your appointment for [SERVICE_NAME] with [CLIENT_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] is [APPOINTMENT_STATUS].

Please Dont forget!!!

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';

	// Notify Staff On Approved Appointment
	$staff_approved_subject = '[BLOG_NAME]: Appointment Status.';
	$staff_approved_body    = '
Hi [STAFF_NAME],

Your appointment for [SERVICE_NAME] with [CLIENT_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] has been [APPOINTMENT_STATUS].

Please Dont forget!!!

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';
	// Notify Staff On Cancelled Appointment
	$staff_cancelled_subject = '[BLOG_NAME]: Appointment Status.';
	$staff_cancelled_body    = '
Hi [STAFF_NAME],

Your appointment for [SERVICE_NAME] with [CLIENT_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] has been [APPOINTMENT_STATUS].

Please Dont forget!!!

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';

	// Notify Reminder Appointment
	$subject_notification_reminder = '[BLOG_NAME]: Appointment Reminder.';
	$body_notification_reminder    = '
Hi [CLIENT_NAME],

Your appointment for [SERVICE_NAME] with [CLIENT_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] is [APPOINTMENT_STATUS].

Please Dont forget!!!

Best Regards 
[ADMIN_NAME]
[BLOG_NAME]
[SITE_URL]
';

	$admin_email     = get_option( 'admin_email' );
	$DefaultSettings = array(
		'emailtype'                            => 'phpmail',
		'enable'                               => 'yes',
		'wpemail'                              => '',
		'phpemail'                             => $admin_email,
		'hostname'                             => '',
		'portno'                               => '',
		'smtpemail'                            => '',
		'password'                             => '',
		'send_notification_admin_approved'     => 'yes',
		'subject_admin_approved'               => $admin_approved_subject,
		'admin_body_approved'                  => $admin_approved_body,
		'send_notification_admin_pending'      => 'yes',
		'subject_admin_pending'                => $admin_pending_subject,
		'admin_body_pending'                   => $admin_pending_body,
		'send_notification_admin_cancelled'    => 'yes',
		'subject_admin_cancelled'              => $admin_cancel_subject,
		'admin_body_cancelled'                 => $admin_cancel_body,
		'send_notification_client_approval'    => 'yes',
		'subject_notification_client_approval' => $client_approved_subject,
		'body_notification_client_approval'    => $client_approved_body,
		'send_notification_client_pending'     => 'yes',
		'subject_notification_client_pending'  => $client_pending_subject,
		'body_notification_client_pending'     => $client_pending_body,
		'send_notification_client_cancel'      => 'yes',
		'subject_notification_client_cancel'   => $client_cancel_subject,
		'body_notification_client_cancel'      => $client_cancel_body,
		'send_notification_staff_approval'     => 'yes',
		'subject_notification_staff_approval'  => $staff_approved_subject,
		'body_notification_staff_approval'     => $staff_approved_body,
		'send_notification_staff_pending'      => 'yes',
		'subject_notification_staff_pending'   => $staff_pending_subject,
		'body_notification_staff_pending'      => $staff_pending_body,
		'send_notification_staff_cancel'       => 'yes',
		'subject_notification_staff_cancel'    => $staff_cancelled_subject,
		'body_notification_staff_cancel'       => $staff_cancelled_body,
	);
	add_option( 'Appoint_notification', $DefaultSettings );

	$DefaultReminderSettings = array(
		'subject_notification_reminder' => $subject_notification_reminder,
		'body_notification_reminder'    => $body_notification_reminder,
	);
	add_option( 'Appoint_reminder_notification', $DefaultReminderSettings );
}

register_activation_hook( __FILE__, 'Appoint_Service_Tips' );
function Appoint_Service_Tips() {

	$service_tips = '
<b>Follow The Step:</b></center>

* Select Service.
* Select Appointment Staff.
* Select Appointment Date.
';

	$DefaultSettings = $service_tips;
	add_option( 'service_tips', $DefaultSettings );
}
register_activation_hook( __FILE__, 'Appoint_Time_Tips' );

function Appoint_Time_Tips() {
	$time_tips       = '
<b>Follow The Step:</b>

* Select Appointment Time.
';
	$DefaultSettings = $time_tips;
	add_option( 'time_tips', $DefaultSettings );
}

register_activation_hook( __FILE__, 'Appoint_Details_Tips' );
function Appoint_Details_Tips() {

	$detail_tips     = '
<b>Follow The Step:</b>

* Sign-Up If You Are New User. 
* Login If You Are Existing User. 
';
	$DefaultSettings = $detail_tips;
	add_option( 'details_tips', $DefaultSettings );
}
register_activation_hook( __FILE__, 'Appoint_Confirm_Tips' );
function Appoint_Confirm_Tips() {
	$confirm_tips    = '
<b>Follow The Step:</b>

* Please Check The Appointment Details
';
	$DefaultSettings = $confirm_tips;
	add_option( 'confirm_tips', $DefaultSettings );
}
register_activation_hook( __FILE__, 'Appoint_Payment_Tips' );
function Appoint_Payment_Tips() {
	$payment_tips    = '
<b>Coupon Will only be applied according to Service. Make Payment if Service is paid.</b>

* Apply Coupon If Any.
* Select Payment Method.
';
	$DefaultSettings = $payment_tips;
	add_option( 'payment_tips', $DefaultSettings );
}
register_activation_hook( __FILE__, 'Appoint_Done_Tips' );
function Appoint_Done_Tips() {
	$done_tips = '
<b>BOOKING DONE.</b>
Thank You! Your Booking Is Complete.
';

	$DefaultSettings = $done_tips;
	add_option( 'done_tips', $DefaultSettings );
}

function ASP_wl_remove_items() {
	delete_option( 'wl-asp-key' );
	delete_option( 'wl-asp-valid' );
	delete_option( 'wl-asp-cache' );
	delete_option( 'Appointment_scheduler_updation_detail' );
}

/**
 * Shortcode Button On Page/Post
 */

add_action( 'media_buttons_context', 'add_aps_custom_button' );
add_action( 'admin_footer', 'add_aps_inline_popup_content' );
function add_aps_custom_button( $context ) {
	$container_id = 'APS';
	$title        = 'Select Location to generate the appointment shortcode';
	$context     .= '<a class="button button-primary thickbox" title="Select Location to generate the appointment shortcode " href="#TB_inline?width=400&inlineId=' . $container_id . '">
	Appointment Scheduler Pro Shortcode</a>';
	return $context;
}

function add_aps_inline_popup_content() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#apsinsert').on('click', function() {
				var id = jQuery('#aps-select option:selected').val();
				window.send_to_editor('<p>[appointment loc=' + id + ']</p>');
				tb_remove();
			})
		});
	</script>
	<?php
	global $wpdb;
	$locatoin_table    = $wpdb->prefix . 'apt_location';
	$q                 = "select * from $locatoin_table";
			$locations = $wpdb->get_results( $q );
	?>
	<div id="APS" style="display: none;">

		<h3>Select Location to use appointment plugin</h3>
		
		<select id="aps-select">
			<option>Select Location</option>
			<?php
			foreach ( $locations as $locations_data ) {
				?>
											
							<option value="<?php echo $locations_data->id; ?>"><?php echo $locations_data->location_add; ?></option>						
					<?php
			}
			?>
		</select>
		<button class='button primary' id='apsinsert'>Insert Appointment Shortcode</button>
	</div>	
	<?php
}
?>
