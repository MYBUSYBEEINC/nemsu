<?php
global $wpdb;
$staff_table =	$wpdb->prefix."apt_staff";
$appearence_table =	$wpdb->prefix."apt_appearence";
$settings_table =	$wpdb->prefix."apt_settings";
$settings_b_name = get_option( "weblizar_aps_bizprofile_setting" );
$b_name	= $settings_b_name["b_name"];

$blog_title = get_bloginfo( 'name' ); 

$appearence_ap_phone_icon =  get_option('appearance_general_settings');//$wpdb->get_col( "SELECT ap_phone_icon from $appearence_table" );
$ap_phone_icon	= $appearence_ap_phone_icon['ap_phone_icon'];

$appearence_ap_phone_no= get_option( "weblizar_aps_bizprofile_setting" );
$ap_phone_no	= $appearence_ap_phone_no['b_phone'];

$appearence_ap_email_icon = get_option('appearance_general_settings'); //$wpdb->get_col( "SELECT ap_email_icon from $appearence_table" );
$ap_email_icon	= $appearence_ap_email_icon['ap_email_icon'];

$appearence_ap_email= get_option( "weblizar_aps_bizprofile_setting" );
$ap_email	= $appearence_ap_email['b_email'];

$current_date=date('d-m-Y');
$current_day= date("D",strtotime($current_date));

if($current_day=="Mon"){
	$settings_bh_monday_st = get_option( "weblizar_aps_business_hours" );
	$monday = unserialize($settings_bh_monday_st['bh_monday']); 
	$start_time= $monday[0]['start_time'];
	$end_time= $monday[0]['end_time'];
}
if($current_day=="Tue"){
	$settings_bh_tuesday_st = get_option( "weblizar_aps_business_hours" ); 
	$tuesday= unserialize($settings_bh_tuesday_st['bh_tuesday']);
	$start_time= $tuesday[0]['start_time'];
	$end_time= $tuesday[0]['end_time'];
}
if($current_day=="Wed"){
	$settings_bh_wednesday_st = get_option( "weblizar_aps_business_hours" ); 
	$wednesday= unserialize($settings_bh_wednesday_st['bh_wednesday']);
	$start_time= $wednesday[0]['start_time'];
	$end_time= $wednesday[0]['end_time'];
}
if($current_day=="Thu"){
	$settings_bh_thursday_st = get_option( "weblizar_aps_business_hours" ); 
	$thursday= unserialize($settings_bh_thursday_st['bh_thursday']);
	$start_time= $thursday[0]['start_time'];
	$end_time= $thursday[0]['end_time'];
}
if($current_day=="Fri"){
	$settings_bh_friday_st = get_option( "weblizar_aps_business_hours" ); 
	$friday	= unserialize($settings_bh_friday_st['bh_friday']);
	$start_time= $friday[0]['start_time'];
	$end_time= $friday[0]['end_time'];
}
if($current_day=="Sat"){
	$settings_bh_saturday_st = get_option( "weblizar_aps_business_hours" ); 
	$saturday = unserialize($settings_bh_saturday_st['bh_saturday']);
	$start_time= $saturday[0]['start_time'];
	$end_time= $saturday[0]['end_time'];
}
if($current_day=="Sun"){
	$settings_bh_sunday_st = get_option( "weblizar_aps_business_hours" ); 
	$sunday	= unserialize($settings_bh_sunday_st['bh_sunday']);
	$start_time= $sunday[0]['start_time'];
	$end_time= $sunday[0]['end_time'];
}

$time_format = get_option( 'time_format' ); 
$biz_st = strtotime($start_time);
$biz_et = strtotime($end_time);

$biz_start_time=	date($time_format, $biz_st);
$biz_end_time=	date($time_format, $biz_et);

$appearence_ap_show_phone_no = get_option('appearance_general_settings'); //$wpdb->get_col( "SELECT ap_show_phone_no from $appearence_table" );
$ap_show_phone_no	= $appearence_ap_show_phone_no['ap_show_phone_no'];
?>