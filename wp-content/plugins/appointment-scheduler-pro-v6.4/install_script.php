<?php
//CREATE DATABASE ON ACTIVATION
//REGISTER DEMO STAFF AS SUBSCRIBER BY MAIL- xyz@mail.com
global $wpdb;
function mycode_table_column_exists($table_name, $column_name) {
	global $wpdb;
	$column = $wpdb->get_results($wpdb->prepare(
		"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
		DB_NAME,
		$table_name,
		$column_name
	));
	if (!empty($column)) {
		return true;
	}
	return false;
}
$appointments_table = $wpdb->prefix . 'apt_appointments';
if ($wpdb->get_var("SHOW TABLES LIKE '$appointments_table'") != $appointments_table) {
	//table not in database. Create new table
	//1. create apt_appointments table
	$AppointmentsManagerTable = $wpdb->prefix . "apt_appointments";
	$AppointmentsManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$AppointmentsManagerTable` (
`id` int(11) NOT NULL AUTO_INCREMENT,
	`client_name` varchar(500) NOT NULL,
	`staff_member` varchar(500) NOT NULL,
	`service_type` varchar(500) NOT NULL,
	`contact` varchar(500) NOT NULL,
	`booking_date` varchar(100) NOT NULL,
	`start_time` varchar(100) NOT NULL,
	`end_time` varchar(100) NOT NULL,
	`status` varchar(100) NOT NULL,
	`payment_status` varchar(100) NOT NULL,
	`client_email` varchar(100) NOT NULL,
	`staff_email` varchar(100) NOT NULL,
	`appt_unique_id` varchar(100) NOT NULL,
	`repeat_appointment` varchar(100) NOT NULL,
	`re_days` varchar(100) NOT NULL,
	`re_weeks` varchar(100) NOT NULL,
	`re_months` varchar(100) NOT NULL,
	`re_start_date` varchar(100) NOT NULL,
	`re_end_date` varchar(100) NOT NULL,
	`appt_booked_by` varchar(100) NOT NULL,
	`location_id` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($AppointmentsManagerTable_sql);
} else {
	$chcek_location_id = mycode_table_column_exists($appointments_table, 'location_id');
	if ($chcek_location_id == false) {
		$alter_table_appoint = "ALTER TABLE `$appointments_table` ADD `location_id` varchar(100) NOT NULL AFTER `appt_booked_by`";
		$wpdb->query($alter_table_appoint);
	}
}
//2. create apt_staff table
$staff_table = $wpdb->prefix . 'apt_staff';
if ($wpdb->get_var("SHOW TABLES LIKE '$staff_table'") != $staff_table) {
	//table not in database. Create new table
	$StaffManagerTableName = $wpdb->prefix . "apt_staff";
	$StaffTableManager_sql = "CREATE TABLE IF NOT EXISTS `$StaffManagerTableName` (
`id` int(30) NOT NULL AUTO_INCREMENT,
	`staff_member_name` varchar(500) NOT NULL,
	`staff_icon` varchar(100) NOT NULL,
	`staff_member_image` varchar(1000) NOT NULL,
	`staff_email` varchar(50) NOT NULL,
	`staff_skype_id` varchar(50) NOT NULL,
	`staff_contact` varchar(50) NOT NULL,
	`staff_info` varchar(500) NOT NULL,
	`staff_services` varchar(5000) NOT NULL,
	`staff_service_category` varchar(1000) NOT NULL,
	`schedule_sunday` varchar(1000) NOT NULL,
	`schedule_monday` varchar(1000) NOT NULL,
	`schedule_tuesday` varchar(1000) NOT NULL,
	`schedule_wednesday` varchar(1000) NOT NULL,
	`schedule_thursday` varchar(1000) NOT NULL,
	`schedule_friday` varchar(1000) NOT NULL,
	`schedule_saturday` varchar(1000) NOT NULL,
	`sun_all_off` varchar(100) NOT NULL,
	`mon_all_off` varchar(100) NOT NULL,
	`tue_all_off` varchar(100) NOT NULL,
	`wed_all_off` varchar(100) NOT NULL,
	`thu_all_off` varchar(100) NOT NULL,
	`fri_all_off` varchar(100) NOT NULL,
	`sat_all_off` varchar(100) NOT NULL,

	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($StaffTableManager_sql);
	$sunday_staff[] = array('start_time' => "10:00", 'end_time' => "18:00", 'break_start' => "14:30", 'break_end' => "15:00");
	$monday_staff[] = array('start_time' => "10:00", 'end_time' => "18:00", 'break_start' => "14:30", 'break_end' => "15:00");
	$tuesday_staff[] = array('start_time' => "10:00", 'end_time' => "18:00", 'break_start' => "14:30", 'break_end' => "15:00");
	$wednesday_staff[] = array('start_time' => "10:00", 'end_time' => "18:00", 'break_start' => "14:30", 'break_end' => "15:00");
	$thursday_staff[] = array('start_time' => "10:00", 'end_time' => "18:00", 'break_start' => "14:30", 'break_end' => "15:00");
	$friday_staff[] = array('start_time' => "10:00", 'end_time' => "18:00", 'break_start' => "14:30", 'break_end' => "15:00");
	$saturday_staff[] = array('start_time' => "10:00", 'end_time' => "18:00", 'break_start' => "14:30", 'break_end' => "15:00");
	$wpdb->insert($wpdb->prefix . 'apt_staff', array('id' => "1", 'schedule_sunday' => serialize($sunday_staff), 'schedule_monday' => serialize($monday_staff), 'schedule_tuesday' => serialize($tuesday_staff), 'schedule_wednesday' => serialize($wednesday_staff), 'schedule_thursday' => serialize($thursday_staff), 'schedule_friday' => serialize($friday_staff), 'schedule_saturday' => serialize($saturday_staff),  'staff_member_name' => "Demo staff", 'staff_email' => "xyz@mail.com", 'staff_icon' => "fas fa-briefcase", 'staff_skype_id' => "123456789", 'staff_contact' => "+1 9876543210", 'staff_info' => "This is Demo Staff", 'staff_services' => "1", 'staff_service_category' => "1"));

	//REFISTER DEMO STAFF AS SUBSCRIBER
	$user_data = array(
		'user_pass' => 'xyz@mail.com',
		'user_email' =>  'xyz@mail.com',
		'user_login' => 'xyz@mail.com',
		'role' => 'subscriber' // Use default role or another role, e.g. 'editor'
	);
	$user_id = wp_insert_user($user_data);
	add_action('admin_init', 'wp_insert_user');
}

//3. create apt_services table
$service_table = $wpdb->prefix . 'apt_services';
if ($wpdb->get_var("SHOW TABLES LIKE '$service_table'") != $service_table) {
	//table not in database. Create new table
	$ServiceManagerTable = $wpdb->prefix . "apt_services";
	$ServiceManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$ServiceManagerTable` (
`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`icon` varchar(100) NOT NULL,
	`color` varchar(100) NOT NULL,
	`duration` varchar(100) NOT NULL,
	`p_before` varchar(100) NOT NULL,
	`p_after` varchar(100) NOT NULL,
	`service_type` varchar(100) NOT NULL,
	`price` varchar(100) NOT NULL,
	`capacity` varchar(100) NOT NULL,
	`category` varchar(100) NOT NULL,
	`info_message` varchar(1000) NOT NULL,
	 PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($ServiceManagerTable_sql);
	$wpdb->insert($wpdb->prefix . 'apt_services', array('name' => "Demo Service", 'icon' => "fas fa-adjust", 'color' => "#dd9933", 'duration' => "30", 'p_before' => "0", 'p_after' => '15',  'service_type' => 'paid_service', 'price' => "10.00", 'capacity' => "0", 'category' => "1", 'info_message' => "It is demo category"));
}

//4. create apt_clients table
$clients_table = $wpdb->prefix . 'apt_clients';
if ($wpdb->get_var("SHOW TABLES LIKE '$clients_table'") != $clients_table) {
	//table not in database. Create new table
	$ClientsManagerTable = $wpdb->prefix . "apt_clients";
	$ClientsManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$ClientsManagerTable` (
`id` int(11) NOT NULL AUTO_INCREMENT,
	`first_name` varchar(100) NOT NULL,
	`last_name` varchar(100) NOT NULL,
	`phone` varchar(30) NOT NULL,
	`skype_id` varchar(30) NOT NULL,
	`email` varchar(100) NOT NULL,
	`notes` varchar(3000) NOT NULL,
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($ClientsManagerTable_sql);
}
//5. create apt_payment table
$payment_table = $wpdb->prefix . 'apt_payment';
if ($wpdb->get_var("SHOW TABLES LIKE '$payment_table'") != $payment_table) {
	//table not in database. Create new table
	$PaymentManagerTable = $wpdb->prefix . "apt_payment";
	$PaymentManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$PaymentManagerTable` (
`id` int(11) NOT NULL AUTO_INCREMENT,
	`payment_type` varchar(1000) NOT NULL,
	`customer` varchar(500) NOT NULL,
	`customer_email` varchar(1000) NOT NULL,
	`staff` varchar(1000) NOT NULL,
	`appointment_date` varchar(1000) NOT NULL,
	`service` varchar(1000) NOT NULL,
	`coupon_code_applied` varchar(1000) NOT NULL,
	`amount_after_discount` varchar(1000) NOT NULL,
	`amount` varchar(1000) NOT NULL,
	`status` varchar(1000) NOT NULL,
	`appt_unique_id` varchar(1000) NOT NULL,
 `appoint_update_id` varchar(1000) NOT NULL,
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($PaymentManagerTable_sql);
}

$chcek_col = mycode_table_column_exists($payment_table, 'appoint_update_id');
if ($chcek_col == false) {
	$appoint_update_query = "ALTER TABLE $payment_table ADD appoint_update_id int(11) DEFAULT NULL";
	$wpdb->query($appoint_update_query);
}

//6. create apt_appearence table
$appearence_table = $wpdb->prefix . 'apt_appearence';
if ($wpdb->get_var("SHOW TABLES LIKE '$appearence_table'") != $appearence_table) {
	//table not in database. Create new table
	$AppearenceManagerTable = $wpdb->prefix . "apt_appearence";
	$AppearenceManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$AppearenceManagerTable` (
`id` bigint(11) NOT NULL AUTO_INCREMENT,
	`service_navigation_text` varchar(100) NOT NULL,
	`time_navigation_text_backward` varchar(100) NOT NULL,
	`time_navigation_text_forward` varchar(100) NOT NULL,
	`details_navigation_text_backward` varchar(100) NOT NULL,
	`details_navigation_text_forward` varchar(100) NOT NULL,
	`confirm_navigation_text_backward` varchar(100) NOT NULL,
	`confirm_navigation_text_forward` varchar(100) NOT NULL,
	`p_confirm_message_box` varchar(100) NOT NULL,
	`payment_navigation_text_forward` varchar(100) NOT NULL,
	`done_page_icon` varchar(100) NOT NULL,
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($AppearenceManagerTable_sql);

	$appt_logo = plugin_dir_url(__FILE__) . "images/logo.png";
	$Insert_Appearance = "INSERT INTO `$appearence_table`(`id`,`service_navigation_text` ,`time_navigation_text_backward` ,
`time_navigation_text_forward` ,`details_navigation_text_backward` ,`details_navigation_text_forward` ,`confirm_navigation_text_backward` ,`confirm_navigation_text_forward`, `p_confirm_message_box` ,`payment_navigation_text_forward` ,`done_page_icon` ) 
VALUES ( '1', 'Next', 'Back', 'Next', 'Back', 'Next', 'Back', 'Next', 'Do you want to confirm payment', 'Next', 'fas fa-thumbs-up');";
	$wpdb->query($Insert_Appearance);
} else {
	$chcek_p_confirm_message_box = mycode_table_column_exists($appearence_table, 'p_confirm_message_box');
	if ($chcek_p_confirm_message_box == false) {
		$AppearenceManagerTable = $wpdb->prefix . "apt_appearence";
		$Insert_Appearance_2 = "ALTER TABLE $AppearenceManagerTable ADD p_confirm_message_box varchar(255) NOT NULL DEFAULT 'Do you want to confirm payment' AFTER confirm_navigation_text_forward";
		$wpdb->query($Insert_Appearance_2);
	}
}


$appt_logo = plugin_dir_url(__FILE__) . "images/logo.png";
$appearance_general_settings = array(
	'ap_bg_color' => '#337ab7',
	'ap_progress_bar' => 'yes',
	'ap_show_logo' => 'yes',
	'ap_logo' => "$appt_logo",
	'ap_logo_width' => '150',
	'ap_logo_height' => '150',
	'ap_show_phone_no' => 'yes',
	'ap_phone_icon' => 'fas fa-phone',
	'ap_show_email' => 'yes',
	'ap_email_icon' => 'fas fa-envelope',
	'ap_social_link1' => 'http://facebook.com',
	'ap_social_link2' => 'http://google.com',
	'ap_social_link3' => 'http://twitter.com',
	'ap_social_link4' => 'http://pinterest.com',
	'ap_social_link5' => 'http://instagram.com',
	'ap_social_icon1' => 'fab fa-facebook',
	'ap_social_icon2' => 'fab fa-google-plus',
	'ap_social_icon3' => 'fab fa-twitter',
	'ap_social_icon4' => 'fab fa-pinterest',
	'ap_social_icon5' => 'fab fa-instagram'
);
add_option('appearance_general_settings', $appearance_general_settings);

$appearance_general_settings = get_option('appearance_general_settings');
if (isset($appearance_general_settings['ap_social_icon1'])) {
	$facebook_icon = $appearance_general_settings['ap_social_icon1'];
	if (preg_match("/^fa /", $facebook_icon)) {
		$appearance_general_settings['ap_social_icon1'] = 'fab fa-facebook';
		$appearance_general_settings['ap_social_icon2'] = 'fab fa-google-plus';
		$appearance_general_settings['ap_social_icon3'] = 'fab fa-twitter';
		$appearance_general_settings['ap_social_icon4'] = 'fab fa-pinterest';
		$appearance_general_settings['ap_social_icon5'] = 'fab fa-instagram';
		update_option('appearance_general_settings', $appearance_general_settings);
	}
}

//7. create apt_holidays table
$holidays_table = $wpdb->prefix . 'apt_holidays';
if ($wpdb->get_var("SHOW TABLES LIKE '$holidays_table'") != $holidays_table) {
	//table not in database. Create new table
	$HolidaysManagerTable = $wpdb->prefix . "apt_holidays";
	$HolidaysManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$HolidaysManagerTable` (
`id` int(11) NOT NULL AUTO_INCREMENT,
    `all_off` varchar(30) NOT NULL,
	`name` varchar(100) NOT NULL,
	`start_time` varchar(100) NOT NULL,
	`end_time` varchar(100) NOT NULL,
	`holiday_date` varchar(100) NOT NULL,
	`repeat_value` varchar(100) NOT NULL,
	`repeat_days` varchar(100) NOT NULL,
	`repeat_weeks` varchar(100) NOT NULL,
	`repeat_bi_weeks` varchar(100) NOT NULL,
	`repeat_month` varchar(100) NOT NULL,
	`start_date` varchar(100) NOT NULL,
	`end_date` varchar(100) NOT NULL,
	`notes` varchar(100) NOT NULL,
	
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($HolidaysManagerTable_sql);
}

//8. create apt_coupons table
$coupons_table = $wpdb->prefix . 'apt_coupons';
if ($wpdb->get_var("SHOW TABLES LIKE '$coupons_table'") != $coupons_table) {
	//table not in database. Create new table
	$CouponsManagerTable = $wpdb->prefix . "apt_coupons";
	$CouponsManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$CouponsManagerTable` (
`id` int(11) NOT NULL AUTO_INCREMENT,
	`coupon_code` varchar(100) NOT NULL,
	`service_name` varchar(500) NOT NULL,
	`time_limit` varchar(100) NOT NULL,
	`per_user_limit` varchar(30) NOT NULL,
	`discount_type` varchar(100) NOT NULL,
	`discount_method` varchar(100) NOT NULL,
	`coupon_start_date` varchar(30) NOT NULL,
	`coupon_end_date` varchar(30) NOT NULL,
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($CouponsManagerTable_sql);
}

//9. create apt_settings table
$settings_table = $wpdb->prefix . 'apt_settings';
if ($wpdb->get_var("SHOW TABLES LIKE '$settings_table'") != $settings_table) {
	//table not in database. Create new table
	$SettingManagerTable = $wpdb->prefix . "apt_settings";
	$SettingManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$SettingManagerTable` (
`id` int(11) NOT NULL ,
    `time_zone` varchar(300) NOT NULL,	
	`ap_mintime` varchar(30) NOT NULL,
	`staff_weekly_off` varchar(1000) NOT NULL,
	`checkout` varchar(30) NOT NULL,
	`api_username` varchar(30) NOT NULL,
	`api_password` varchar(30) NOT NULL,
	`api_signature` varchar(30) NOT NULL,
	`advance_booking_time` varchar(30) NOT NULL,
	`advance_cancel_time` varchar(30) NOT NULL,
	`enable_reminder` varchar(30) NOT NULL,
	`reminder_time` varchar(30) NOT NULL,
	`staff_service` varchar(500) NOT NULL,
	`staff_id` varchar(500) NOT NULL,
	`staff_date` varchar(500) NOT NULL,
	`custom_css` text NOT NULL,
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($SettingManagerTable_sql);
	$sunday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$monday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$tuesday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$wednesday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$thursday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$friday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$saturday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$wpdb->insert($wpdb->prefix . 'apt_settings', array('id' => "1", 'enable_reminder' => 'yes', 'reminder_time' => '1'));
}
/*CALENDAR SETTINGS*/
$calendar_view_setting = array(
	'cal_theme_style' => 'theme_01',
	'cal_date_format' => 'd-m-Y',
	'cal_time_format' => 'H:i',
	'cal_view' => 'month',
	'cal_first_day' => '0',
	'cal_pending_color' => '#e9cb31',
	'cal_approved_color' => 'green',
	'cal_cancelled_color' => 'red',
	'cal_completed_color' => '#337ab7',
	'cal_off_time_color' => '#676778',
	'cal_font_style' => 'Arial black'
);
add_option('weblizar_aps_calendar_view_setting', $calendar_view_setting);
/*BUSINESS HOURS*/
$sunday[] = array('start_time' => "10:00", 'end_time' => "18:00");
$monday[] = array('start_time' => "10:00", 'end_time' => "18:00");
$tuesday[] = array('start_time' => "10:00", 'end_time' => "18:00");
$wednesday[] = array('start_time' => "10:00", 'end_time' => "18:00");
$thursday[] = array('start_time' => "10:00", 'end_time' => "18:00");
$friday[] = array('start_time' => "10:00", 'end_time' => "18:00");
$saturday[] = array('start_time' => "10:00", 'end_time' => "18:00");
$business_hours = array(
	'bh_sunday' => serialize($sunday),
	'bh_monday' => serialize($monday),
	'bh_tuesday' => serialize($tuesday),
	'bh_wednesday' => serialize($wednesday),
	'bh_thursday' => serialize($thursday),
	'bh_friday' => serialize($friday),
	'bh_saturday' => serialize($saturday),
);
add_option('weblizar_aps_business_hours', $business_hours);

/*BUSINESS PROFILE*/
$business_profile = array(
	'b_name' => 'Your Business Name',
	'b_owner' => 'Your Name',
	'b_phone' => '+1 9876543210',
	'b_fax' => '+1 9988776655',
	'b_email' => 'info@bizname.com',
	'b_blog_url' => '',
	'b_postal_code' => '987665',
	'b_address' => 'Your Office Address',
	'b_website' => 'www.bizname.com',
);
add_option('weblizar_aps_bizprofile_setting', $business_profile);


$payment_options = get_option('weblizar_aps_payment_setting', true);
if ($payment_options && is_array($payment_options)) {
	if (!isset($payment_options['stripe_enable'])) {
		$payment_options['stripe_enable'] = 's-disable';
		$payment_options['stripe_apikey'] = '';
		$payment_options['stripe_secretkey'] = '';
		update_option('weblizar_aps_payment_setting', $payment_options);
	}
} else {
	/*PAYMENT OPTIONS*/
	$payment_options = array(
		'accept_payment' => 'yes',
		'payment_currency' => 'USD',
		'cash_checkout' => 'yes',
		'payment_mode' => 'direct_paypal_mode',
		'paypal_checkout' => 'p-disable',
		'checkout_sandbox_mode' => '',
		'paypal_email' => 'xyz@gmail.com',
		'razorpay_checkout' => 'r-disable',
		'razorpay_api_key' => '',
		'razorpay_name' => 'ABC',
		'razorpay_description' => 'BBC',
		'razorpay_currency' => 'USD',
		'razorpay_theme_color' => '#FFB904',
		'razorpay_logo' => '',
		'stripe_enable' => 's-disable',
		'stripe_apikey' => '',
		'stripe_secretkey' => ''
	);
	add_option('weblizar_aps_payment_setting', $payment_options);
}

/*GENERAL SETTINGS*/
$general_setting = array(
	'currency' => "INR",
	'ap_theme_color' => "#337ab7",
	'time_slots' => "custom_slots",
	'custom_slot' => "5",
	'service_duration_type' => "sd",
	'appt_status' => "pending",
	'appt_status_pending' => "yes"
);
add_option('weblizar_aps_general_setting', $general_setting);

//10. create apt_category table
$category_table = $wpdb->prefix . 'apt_category';
if ($wpdb->get_var("SHOW TABLES LIKE '$category_table'") != $category_table) {
	//table not in database. Create new table
	$CategoryManagerTable = $wpdb->prefix . "apt_category";
	$CategoryManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$CategoryManagerTable` (
`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`icon` varchar(100) NOT NULL,
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($CategoryManagerTable_sql);
	$wpdb->insert($wpdb->prefix . 'apt_category', array('name' => "Demo Category", 'icon' => "dashicons dashicons-category"));
}
//11. create apt_reminder table
$reminder_table = $wpdb->prefix . 'apt_reminder';
if ($wpdb->get_var("SHOW TABLES LIKE '$reminder_table'") != $reminder_table) {
	//table not in database. Create new table
	$ReminderManagerTable = $wpdb->prefix . "apt_reminder";
	$ReminderManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$ReminderManagerTable` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`app_id` INT NOT NULL ,
	`reminder_type` VARCHAR( 10 ) NOT NULL ,
	`reminder_client_name` VARCHAR( 100 ) NOT NULL ,
	`reminder_client_email` VARCHAR( 100 ) NOT NULL ,
	`status` VARCHAR( 10 ) NOT NULL ,
	`retries` INT NOT NULL ,
	`error` TEXT NOT NULL,
	`time_date` TIMESTAMP NOT NULL
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($ReminderManagerTable_sql);
}

/*12. create apt_location table*/
$location_table = $wpdb->prefix . 'apt_location';
if ($wpdb->get_var("SHOW TABLES LIKE '$location_table'") != $location_table) {
	//table not in database. Create new table
	$LocationManagerTable = $wpdb->prefix . "apt_location";
	$LocationManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$LocationManagerTable` (
`id` int(11) NOT NULL AUTO_INCREMENT,
	`location_add` varchar(100) NOT NULL,
	`location_contact` varchar(100) NOT NULL,
	`location_detail` text NOT NULL,
	`location_service_cat` text NOT NULL,
	`location_service` text NOT NULL,
	`location_map` text NOT NULL,
	`business_hours` text NOT NULL,
	`status` text NOT NULL,
	`message` text NOT NULL,
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$sunday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$monday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$tuesday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$wednesday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$thursday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$friday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$saturday[] = array('start_time' => "10:00", 'end_time' => "18:00");
	$business_hours = array(
		'bh_sunday' => serialize($sunday),
		'bh_monday' => serialize($monday),
		'bh_tuesday' => serialize($tuesday),
		'bh_wednesday' => serialize($wednesday),
		'bh_thursday' => serialize($thursday),
		'bh_friday' => serialize($friday),
		'bh_saturday' => serialize($saturday),
	);
	$wpdb->query($LocationManagerTable_sql);
	@$wpdb->insert($wpdb->prefix . 'apt_location', array('location_add' => "Location One", 'location_contact' => "+1 123456789", 'location_detail' => "", 'location_map' => "Location Map", 'location_service_cat' => "", 'location_service' => "", 'business_hours' => "$business_hours", 'status' => "open"));
} else {
	$chcek_location_detail = mycode_table_column_exists($location_table, 'location_detail');
	$chcek_location_service_cat = mycode_table_column_exists($location_table, 'location_service_cat');
	$chcek_location_service = mycode_table_column_exists($location_table, 'location_service');
	$chcek_business_hours = mycode_table_column_exists($location_table, 'business_hours');
	$chcek_status = mycode_table_column_exists($location_table, 'status');
	$chcek_message = mycode_table_column_exists($location_table, 'message');

	if ($chcek_location_detail == false) {
		$a_q_1 = "ALTER TABLE `$location_table` ADD `location_detail` TEXT NOT NULL AFTER `location_contact`";
		$wpdb->query($a_q_1);
	}
	if ($chcek_location_service_cat == false) {
		$a_q_2 = "ALTER TABLE `$location_table` ADD `location_service_cat` TEXT NOT NULL AFTER `location_detail`";
		$wpdb->query($a_q_2);
	}
	if ($chcek_location_service == false) {
		$a_q_3 = "ALTER TABLE `$location_table` ADD `location_service` TEXT NOT NULL AFTER `location_service_cat`";
		$wpdb->query($a_q_3);
	}
	if ($chcek_business_hours == false) {
		$a_q_4 = "ALTER TABLE `$location_table` ADD `business_hours` TEXT NOT NULL AFTER `location_map`";
		$wpdb->query($a_q_4);
	}
	if ($chcek_status == false) {
		$a_q_5 = "ALTER TABLE `$location_table` ADD `status` TEXT NOT NULL AFTER `business_hours`";
		$wpdb->query($a_q_5);
	}
	if ($chcek_message == false) {
		$a_q_6 = "ALTER TABLE `$location_table` ADD `message` TEXT NOT NULL AFTER `status`";
		$wpdb->query($a_q_6);
	}
}

//13. Create google calendar sync table
$aps_cal_sync = $wpdb->prefix . "apt_sync";
if ($wpdb->get_var("SHOW TABLES LIKE '$aps_cal_sync'") != $aps_cal_sync) {

	$aps_cal_sync = $wpdb->prefix . "apt_sync";
	$aps_cla_sync_data = "CREATE TABLE IF NOT EXISTS `$aps_cal_sync` ( 
	 	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	 	`app_id` INT NOT NULL ,
	 	`timeoff_id` INT NOT NULL ,
	 	`app_sync_details` TEXT NOT NULL
	 	)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($aps_cla_sync_data);
}
//14. Create Staff Dashboard Setting Fields in Option Table with Default value
$new_appointment_staff_settings = array(
	'staff_calendar_setting' => 'no',
	'calendar_edit' => 'no',
	'staff_loc_setting' => 'no',
	'loc_edit' => 'no',
	'staff_service_setting' => 'no',
	'service_edit' => 'no',
	'staff_profile_setting' => 'no',
	'profile_edit' => 'no',
	'staff_appointment_setting' => 'no',
	'staff_dashboard_setting' => 'no',
	'appointment_edit' => 'no',
);
update_option('weblizar_aps_staff_dashboard_settings', $new_appointment_staff_settings);

/*15. Create staff holiday table*/
$staff_holiday_table = $wpdb->prefix . 'apt_staff_holiday_table';
if ($wpdb->get_var("SHOW TABLES LIKE '$staff_holiday_table'") != $staff_holiday_table) {
	//table not in database. Create new table
	$StaffHolidayTable = $wpdb->prefix . "apt_staff_holiday_table";
	$StaffHolidayTable_sql = "CREATE TABLE IF NOT EXISTS `$StaffHolidayTable` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`staff_id` INT NOT NULL ,
		`type_of_leaves` VARCHAR( 10 ) NOT NULL,
		`single_leave` VARCHAR( 100 ) NOT NULL,
		`multiple_leaves_start` VARCHAR( 100 ) NOT NULL,
		`multiple_leaves_end` VARCHAR( 100 ) NOT NULL,
		`status` VARCHAR( 10 ) NOT NULL 
		)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
	$wpdb->query($StaffHolidayTable_sql);
}
