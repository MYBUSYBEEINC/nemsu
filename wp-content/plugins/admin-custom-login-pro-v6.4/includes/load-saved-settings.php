<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Get value of Dashboard page
$dashboard_page   = unserialize( get_option( 'Admin_custome_login_dashboard' ) );
$dashboard_status = $dashboard_page['dashboard_status'];

// Get value of Top page
$top_page       = unserialize( get_option( 'Admin_custome_login_top' ) );
$top_bg_type    = $top_page['top_bg_type'];
$top_color      = $top_page['top_color'];
$top_image      = $top_page['top_image'];
$top_cover      = $top_page['top_cover'];
$top_repeat     = $top_page['top_repeat'];
$top_position   = $top_page['top_position'];
$top_attachment = $top_page['top_attachment'];
global $top_slideshow_no;
$top_slideshow_no        = $top_page['top_slideshow_no'];
$top_bg_slider_animation = $top_page['top_bg_slider_animation'];

// Load Login Form Settings
$login_page               = unserialize( get_option( 'Admin_custome_login_login' ) );
$login_form_position      = isset( $login_page['login_form_position'] ) ? $login_page['login_form_position'] : 'default';
$login_form_left          = $login_page['login_form_left'];
$login_form_top           = $login_page['login_form_top'];
$login_form_float     	  = isset( $login_page['login_form_float'] ) ? $login_page['login_form_float'] : 'center';
$login_bg_type            = $login_page['login_bg_type'];
$login_bg_color           = $login_page['login_bg_color'];
$login_bg_effect          = $login_page['login_bg_effect'];
$login_bg_image           = $login_page['login_bg_image'];
$login_form_opacity       = $login_page['login_form_opacity'];
$login_form_width         = $login_page['login_form_width'];
$login_form_radius        = $login_page['login_form_radius'];
$login_border_style       = $login_page['login_border_style'];
$login_border_thikness    = $login_page['login_border_thikness'];
$login_border_color       = $login_page['login_border_color'];
$login_bg_repeat          = $login_page['login_bg_repeat'];
$login_bg_position        = $login_page['login_bg_position'];
$login_enable_shadow      = $login_page['login_enable_shadow'];
$login_shadow_color       = $login_page['login_shadow_color'];
$login_custom_css         = isset( $login_page['login_custom_css'] ) ? $login_page['login_custom_css'] : '';
$login_redirect_user      = isset( $login_page['login_redirect_user'] ) ? $login_page['login_redirect_user'] : '';
$login_redirect_force     = isset( $login_page['login_redirect_force'] ) ? $login_page['login_redirect_force'] : "no";
$login_force_redirect_url = isset( $login_page['login_force_redirect_url'] ) ? $login_page['login_force_redirect_url'] : get_home_url() . "/wp-login.php";
$log_form_above_msg       = $login_page['log_form_above_msg'];
$custom_error_msg         = isset( $login_page['custom_error_msg'] ) ? $login_page['custom_error_msg'] : '';
$login_msg_fontsize       = $login_page['login_msg_fontsize'];
$login_msg_font_color     = $login_page['login_msg_font_color'];
$login_tagline_text_color = isset($login_page['login_tagline_text_color']) ? $login_page['login_tagline_text_color'] : '#ffffff';
$login_tagline_link_color = isset($login_page['login_tagline_link_color']) ? $login_page['login_tagline_link_color'] : '#f00';
$tagline_msg              = $login_page['tagline_msg'];
if ( isset( $login_page['user_cust_lbl'] ) ) {
	$user_cust_lbl = $login_page['user_cust_lbl'];
} else {
	$user_cust_lbl = "Type Username or Email";
}
if ( isset( $login_page['pass_cust_lbl'] ) ) {
	$pass_cust_lbl = $login_page['pass_cust_lbl'];
} else {
	$pass_cust_lbl = "Type Password";
}

if ( isset( $login_page['label_username'] ) ) {
	$label_username = $login_page['label_username'];
} else {
	$label_username = "Username or Email";
}
if ( isset( $login_page['label_password'] ) ) {
	$label_password = $login_page['label_password'];
} else {
	$label_password = "Password";
}
if ( isset( $login_page['label_loginButton'] ) ) {
	$label_loginButton = $login_page['label_loginButton'];
} else {
	$label_loginButton = "Log In";
}

// Get value of Text and Color page
$text_and_color_page  = unserialize( get_option( 'Admin_custome_login_text' ) );
$heading_font_color   = $text_and_color_page['heading_font_color'];
$input_font_color     = $text_and_color_page['input_font_color'];
$link_color           = $text_and_color_page['link_color'];
$button_color         = $text_and_color_page['button_color'];
$button_text_color    = isset( $text_and_color_page['button_text_color'] ) ? $text_and_color_page['button_text_color'] : '#ffffff';
$heading_font_size    = $text_and_color_page['heading_font_size'];
$input_font_size      = $text_and_color_page['input_font_size'];
$link_size            = $text_and_color_page['link_size'];
$button_font_size     = $text_and_color_page['button_font_size'];
$enable_link_shadow   = $text_and_color_page['enable_link_shadow'];
$link_shadow_color    = $text_and_color_page['link_shadow_color'];
$heading_font_style   = $text_and_color_page['heading_font_style'];
$input_font_style     = $text_and_color_page['input_font_style'];
$link_font_style      = $text_and_color_page['link_font_style'];
$button_font_style    = $text_and_color_page['button_font_style'];
$enable_inputbox_icon = $text_and_color_page['enable_inputbox_icon'];
$user_input_icon      = $text_and_color_page['user_input_icon'];
$password_input_icon  = $text_and_color_page['password_input_icon'];
if ( isset( $text_and_color_page['google_font_token'] ) ) {
	$google_font_token = $text_and_color_page['google_font_token'];
} else {
	$google_font_token = null;
}

// Get value of Logo page
$logo_page      = unserialize( get_option( 'Admin_custome_login_logo' ) );
$logo_image     = $logo_page['logo_image'];
$logo_show		= isset( $logo_page['logo_show'] ) ? $logo_page['logo_show'] : 'yes';
$logo_width     = $logo_page['logo_width'];
$logo_height    = $logo_page['logo_height'];
$logo_url       = $logo_page['logo_url'];
$logo_url_title = $logo_page['logo_url_title'];

// Get value of Gcaptcha page
$g_page = unserialize(get_option('Admin_custome_login_gcaptcha'));
$site_key = $g_page['site_key'];
$secret_key = $g_page['secret_key'];
$site_key_v3 = isset( $g_page['site_key_v3'] ) ? $g_page['site_key_v3'] : '';
$secret_key_v3 = isset( $g_page['secret_key_v3'] ) ? $g_page['secret_key_v3'] : '';
$login_enable_gcaptcha = $g_page['login_enable_gcaptcha'];

$login_v_gcaptcha = isset( $g_page['login_v_gcaptcha'] ) ? $g_page['login_v_gcaptcha'] : 'v2';

if(isset($g_page['acl_gcaptcha_theme'])){ $acl_gcaptcha_theme = $g_page['acl_gcaptcha_theme']; } else { $acl_gcaptcha_theme="yes" ;}

// Get value of Slidshow image
$Slidshow_image   = unserialize( get_option( 'Admin_custome_login_Slidshow' ) );
$Slidshow_image_1 = $Slidshow_image['Slidshow_image_1'];
$Slidshow_image_2 = $Slidshow_image['Slidshow_image_2'];
$Slidshow_image_3 = $Slidshow_image['Slidshow_image_3'];
$Slidshow_image_4 = $Slidshow_image['Slidshow_image_4'];
$Slidshow_image_5 = $Slidshow_image['Slidshow_image_5'];
$Slidshow_image_6 = $Slidshow_image['Slidshow_image_6'];

$Slidshow_image_label_1 = $Slidshow_image['Slidshow_image_label_1'];
$Slidshow_image_label_2 = $Slidshow_image['Slidshow_image_label_2'];
$Slidshow_image_label_3 = $Slidshow_image['Slidshow_image_label_3'];
$Slidshow_image_label_4 = $Slidshow_image['Slidshow_image_label_4'];
$Slidshow_image_label_5 = $Slidshow_image['Slidshow_image_label_5'];
$Slidshow_image_label_6 = $Slidshow_image['Slidshow_image_label_6'];

$Social_page               = unserialize( get_option( 'Admin_custome_login_Social' ) );
$enable_social_icon        = $Social_page['enable_social_icon'];
$social_icon_size          = $Social_page['social_icon_size'];
$social_icon_layout        = $Social_page['social_icon_layout'];
$social_icon_color         = $Social_page['social_icon_color'];
$social_icon_color_onhover = $Social_page['social_icon_color_onhover'];
$social_icon_bg            = $Social_page['social_icon_bg'];
$social_icon_bg_onhover    = $Social_page['social_icon_bg_onhover'];
$social_facebook_link      = $Social_page['social_facebook_link'];
$social_twitter_link       = $Social_page['social_twitter_link'];
$social_linkedin_link      = $Social_page['social_linkedin_link'];
$social_google_plus_link   = $Social_page['social_google_plus_link'];
$social_pinterest_link     = $Social_page['social_pinterest_link'];
$social_digg_link          = $Social_page['social_digg_link'];
$social_youtube_link       = $Social_page['social_youtube_link'];
$social_flickr_link        = $Social_page['social_flickr_link'];
$social_tumblr_link        = $Social_page['social_tumblr_link'];
$social_skype_link         = $Social_page['social_skype_link'];
$social_instagram_link     = $Social_page['social_instagram_link'];
$social_telegram_link      = isset( $Social_page['social_telegram_link'] ) ? $Social_page['social_telegram_link'] : 'https://telegram.org/';
$social_whatsapp_link      = isset( $Social_page['social_whatsapp_link'] ) ? $Social_page['social_whatsapp_link'] : 'https://whatsapp.com/';

/* Get Social Login values */
$Social_login            = unserialize( get_option( 'Admin_custome_login_Social_login' ) );
$enable_facebook_login   = $Social_login['enable_facebook_login'];
$enable_google_login     = $Social_login['enable_google_login'];
$enable_twitter_login    = $Social_login['enable_twitter_login'];
$facebook_app_id         = $Social_login['facebook_app_id'];
$facebook_app_secret     = $Social_login['facebook_app_secret'];
$facebook_redirect_url   = $Social_login['facebook_redirect_url'];
$google_client_id        = $Social_login['google_client_id'];
$google_client_secret    = $Social_login['google_client_secret'];
$google_redirect_url     = $Social_login['google_redirect_url'];
$twitter_consumer_key    = $Social_login['twitter_consumer_key'];
$twitter_consumer_secret = $Social_login['twitter_consumer_secret'];
$twitter_oauth_callback  = $Social_login['twitter_oauth_callback'];


/* Get Login Attempt value */
//(isset($login_page['custom_error_msg'])) ? $login_page['custom_error_msg']: '';
$attempt_settings = unserialize( get_option( 'Admin_custome_login_attempts' ) );

$no_attempts               = $attempt_settings['no_attempts'];
$time_duration_nxt_attempt = $attempt_settings['time_duration_nxt_attempt'];
$enable_login_attempts     = $attempt_settings['enable_login_attempts'];
//$enable_login_form_key = $attempt_settings['enable_login_form_key'];
if ( isset( $attempt_settings['enable_login_form_key'] ) ) {
	$enable_login_form_key = $attempt_settings['enable_login_form_key'];
} else {
	$enable_login_form_key = '';
}

/* Restriction */
$user_restriction         = unserialize( get_option( 'Admin_custome_login_restrict' ) );
$enable_restrict_attempts = $user_restriction['enable_restrict_attempts'];
$user_role                = $user_restriction['user_role'];

$user_restriction_maxuser = unserialize( get_option( 'Admin_custome_login_restrict_maxuser' ) );
$enable_restrict_maxuser  = $user_restriction_maxuser['enable_restrict_maxuser'];
$max_user                 = $user_restriction_maxuser['max_users'];

/* Get Roles */
global $wp_roles;
$roles = $wp_roles->get_names();
/*IP Restriction*/
$ip_restriction     = unserialize( get_option( 'Admin_custome_login_allow_ip' ) );
$ip_address         = $ip_restriction['ip_address'];
$enable_restrict_ip = $ip_restriction['enable_restrict_ip'];
/* Change URL */
$churl         = unserialize( get_option( 'Admin_custome_login_churl' ) );
$wacl_slug     = isset($churl['wacl_slug'])? $churl['wacl_slug'] : null;
$wacl_slug_val = isset($churl['wacl_slug_val'])? $churl['wacl_slug_val'] : null;
/*banned user by name*/
$banned_user       = unserialize( get_option( 'Admin_custome_banned_user' ) );
$banned_user_array = array();
$banned_user_allow = $banned_user['enable_restrict_user'];
$banned_user_array = $banned_user['banned_user'];
?>