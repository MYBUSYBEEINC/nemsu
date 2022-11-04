<?php
$login_page = unserialize( get_option( 'Admin_custome_login_login' ) );

if ( isset( $login_page['login_redirect_force'] ) ) {
	$login_redirect_force = $login_page['login_redirect_force'];
} else {
	$login_redirect_force = "no";
}
if ( $login_redirect_force == "yes" ) {
	add_action( 'template_redirect', function () {
		// no non-authenticated users allowed
		if ( ! is_user_logged_in() ) {
			$login_page = unserialize( get_option( 'Admin_custome_login_login' ) );
			wp_redirect( $login_page['login_force_redirect_url'], 302 );
			exit();
		}
	} );
}

$g_page = unserialize( get_option( 'Admin_custome_login_gcaptcha' ) );
if ( isset( $g_page['login_enable_gcaptcha'] ) ) {
	$login_enable_gcaptcha = $g_page['login_enable_gcaptcha'];
	if ( $login_enable_gcaptcha == "yes" ) {
		/* Gcaptcha code */
		include( 'acl-gcaptcha.php' );
	}
}
/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 *
 * @return string
 */
function ACL_login_redirect_pro( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		// get and load custom redirect option after user login
		$login_page          = unserialize( get_option( 'Admin_custome_login_login' ) );
		$login_redirect_user = $login_page['login_redirect_user'];
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect admin to the default place
			return $redirect_to;
		} else {
			// redirect users to another place
			if ( $login_redirect_user != "" ) {
				return $login_redirect_user;
			} else {
				return $redirect_to;
			}
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'ACL_login_redirect_pro', 10, 3 );
// load plugin translation
add_action( 'plugins_loaded', 'ACL_GetReadyTranslation_pro' );
function ACL_GetReadyTranslation_pro() {
	load_plugin_textdomain( WEBLIZAR_ACL_PRO, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * @param Premium Features start
 */
/**
 * @param set login attempts
 */
$attempt_settings = unserialize( get_option( 'Admin_custome_login_attempts' ) );
$no_attempts      = ( isset( $attempt_settings['no_attempts'] ) ? $attempt_settings['no_attempts'] : '' );

$time_duration_nxt_attempt = ( isset( $attempt_settings['time_duration_nxt_attempt'] ) ? $attempt_settings['time_duration_nxt_attempt'] : '' );

$enable_login_attempts = ( isset( $attempt_settings['enable_login_attempts'] ) ? $attempt_settings['enable_login_attempts'] : '' );
$time_duration_nxt_attempt;

if ( $enable_login_attempts == "yes" ) {
	include( 'limit-login-attempts.php' );
	new Limit_Login_Attempts( $no_attempts, $time_duration_nxt_attempt );
}
include 'remove-halt.php';
/**
 * @param Set Custom Error Message
 */
$cust_messages = unserialize( get_option( 'Admin_custome_login_login' ) );
if ( $enable_login_attempts == "no" && ! empty( $cust_messages['custom_error_msg'] ) ) {
	add_filter( 'login_errors', 'login_error_message' );
}
function login_error_message( $error ) {
	/* fetch error message */
	$cust_messages = unserialize( get_option( 'Admin_custome_login_login' ) );
	if ( isset( $cust_messages['custom_error_msg'] ) && ! empty( $cust_messages['custom_error_msg'] ) ) {
		$error_message = $cust_messages['custom_error_msg'];
	} else {
		$error_message = "Error";
	}
	//check if that's the error you are looking for
	$pos = strpos( $error, 'incorrect' );
	if ( is_int( $pos ) ) {
		//its the right error so you can overwrite it
		$error = $error_message;
	}

	return $error;
}

/**
 * @param login with token
 */
include( "includes/login-token/temp_login_without_pass.php" );
$at = new Temp_login_without_pass();
/**
 * @param IP Restriction
 */
$ip_restriction     = unserialize( get_option( 'Admin_custome_login_allow_ip' ) );
$enable_restrict_ip = $ip_restriction['enable_restrict_ip'];
if ( $enable_restrict_ip == "yes" ) {
	add_action( 'admin_init', 'ip_allow' );
}
function ip_allow() {
	$ip_restriction     = unserialize( get_option( 'Admin_custome_login_allow_ip' ) );
	$enable_restrict_ip = $ip_restriction['enable_restrict_ip'];
	$ip_address         = $ip_restriction['ip_address'];

	$ip_addresses = explode(',', $ip_address);

	$ip_addresses = array_map(function($ip_address) {
		$ip_explode = explode( ".", $ip_address );
		$ip_range   = $ip_explode[0] . "." . $ip_explode[1] . "." . $ip_explode[2];
		return $ip_range;
	}, $ip_addresses);

	$client_ip = $_SERVER['REMOTE_ADDR'];
	if ( is_user_logged_in() ) {
		$user_id   = get_current_user_id();
		$user_info = get_userdata( $user_id );
		$user_role = implode( ', ', $user_info->roles );

		if ( $user_role == "administrator" ) {
			$client_ip_explode = explode( ".", $client_ip );
			$client_ip = $client_ip_explode[0] . "." . $client_ip_explode[1] . "." . $client_ip_explode[2];
			if ( in_array( $client_ip, $ip_addresses ) ) {
				
			} else {
				wp_logout();
				wp_redirect( home_url() );
				exit;
			}	
		}
	}
}

/**
 * @param Role Restriction
 */
$user_restriction         = unserialize( get_option( 'Admin_custome_login_restrict' ) );
$enable_restrict_attempts = $user_restriction['enable_restrict_attempts'];
$user_role                = $user_restriction['user_role'];
if ( $enable_restrict_attempts == "yes" && ! empty( $user_role ) ) {
	add_action( 'init', 'role_reg' );
}
function role_reg() {
	$user_restriction = unserialize( get_option( 'Admin_custome_login_restrict' ) );
	$fetch_user_role  = $user_restriction['user_role'];
	if ( is_user_logged_in() ) {
		$user_id = get_current_user_id();
		/**
		 * @param getting user role
		 * @param first getting user data with current user id
		 */
		$user_info = get_userdata( $user_id );
		$user_role = implode( ', ', $user_info->roles );
		if ( $user_role == $fetch_user_role ) {
			// wp_die("Access Denied");
			// exit();
			wp_logout();
			//wp_die("<h1 style='color: red'>Access Denied</h1>");
			wp_redirect( home_url() );
			exit;
		}
	}
}

/**
 * @param no of logged in users
 * @param list
 */
$user_restriction_maxuser = unserialize( get_option( 'Admin_custome_login_restrict_maxuser' ) );
$enable_restrict_maxuser  = $user_restriction_maxuser['enable_restrict_maxuser'];
if ( $enable_restrict_maxuser == "yes" ) {
	add_action( 'wp_login', 'limitted_users', 10, 2 );
}

function ACL_wl_remove_items() {
	delete_option( 'wl-acl-key' );
	delete_option( 'wl-acl-valid' );
	delete_option( 'wl-acl-cache' );
	delete_option( 'Admin_custome_updation_detail' );
}

function limitted_users( $user_login, $user ) {
	$user_restriction_maxuser = unserialize( get_option( 'Admin_custome_login_restrict_maxuser' ) );
	$max_user                 = $user_restriction_maxuser['max_users'];
	$error_code               = 'max_session_reached';
	$error_message            = "Maximum 2 login sessions are allowed. Please contact site administrator.";

	if ( isset( $user->ID ) && $user->ID !== 1 ) {
		$aUsers   = get_users( [
			'meta_key'     => 'session_tokens',
			'meta_compare' => 'EXISTS'
		] );
		$sessions = WP_Session_Tokens::get_instance( $user->ID );
		$xx       = count( $aUsers );
		if ( $xx > $max_user ) {
			$sessions->destroy_all();

			return new WP_Error( $error_code, $error_message );
		}
	}
}

/**
 * @param restrict user by name
 */
$banned_user = unserialize( get_option( 'Admin_custome_banned_user' ) );
if ( isset( $banned_user['enable_restrict_user'] ) && $banned_user['enable_restrict_user'] == 'yes' ) {
	add_action( 'init', 'banned_user_byname' );
}
function banned_user_byname() {
	$banned_user = unserialize( get_option( 'Admin_custome_banned_user' ) );
	/*Get User*/
	$ss_user_ID = get_current_user_id();
	/*check user*/
	if ( is_array( $banned_user['banned_user'] ) ) {
		if ( in_array( $ss_user_ID, $banned_user['banned_user'] ) ) {
			wp_logout();
			wp_die( __( "You Are Blocked By Admin", WEBLIZAR_ACL_PRO ) );
		}
	}
}

/**
 * @param change the label text
 */

/**
 * Admin Custom Login menu
 */

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

$wl_acl_lm_val = WL_ACL_LM::get_instance()->is_valid();

require_once( "login-form-screen.php" );
add_action( 'admin_menu', 'acl_weblizar_admin_custom_login_menu_pro' );
function acl_weblizar_admin_custom_login_menu_pro() {
	global $wl_acl_lm_val;
	if ( current_user_can( 'administrator' ) ) {
		if ( isset( $wl_acl_lm_val ) && $wl_acl_lm_val ) {
			//plugin menu page under the settings page
			// $acl_menu = add_menu_page('Admin custom Login', 'Admin custom Login','administrator', 'admin_custom_login','acl_admin_custom_login_content_pro');
			$acl_menu = add_submenu_page( 'admin-custom-login-pro-license', __( 'Settings', WEBLIZAR_ACL_PRO ), __( 'Settings', WEBLIZAR_ACL_PRO ), 'administrator', 'admin_custom_login', 'acl_admin_custom_login_content_pro' );
			add_action( 'admin_print_styles-' . $acl_menu, 'acl_admin_custom_login_css_pro' );
		}
	}
}

add_action( 'admin_menu', array( 'WL_ACL_Menu', 'create_menu' ), 1 );

function acl_admin_custom_login_css_pro() {
	// load CSS Files only With Admin Custom Login Menu Page
	if ( strpos( $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'admin_custom_login' ) == true ) {
		wp_enqueue_style( 'dashboard' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_style( 'acl-bootstrap-css', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/bootstrap.min.css' );
		wp_enqueue_style( 'acl-isotop-css', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/isotope_css.css' );
		wp_enqueue_style( 'acl-smartech-css', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/smartech.css' );
		wp_enqueue_style( 'acl-jquery-ui-css', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/jquery-ui.css' );
		wp_enqueue_style( 'acl-font-awesome_min', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'font-awesome-latest/css/fontawesome-all.min.css' );
		wp_enqueue_style( 'acl-font-animate', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/animate.css' );
		wp_enqueue_style( 'acl-fontawesome-iconpicker', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/fontawesome-iconpicker.css' );
		wp_enqueue_style( 'acl-recom', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/recom.css' );

		wp_enqueue_style( 'acl-dialog', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/dialog/dialog.css' );
		wp_enqueue_style( 'acl-dialog-box-style', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/dialog/dialog-box-style.css' );
		wp_enqueue_style( 'acl-dialog-jamie', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/dialog/dialog-jamie.css' );
		wp_enqueue_style( 'acl-custom-css', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/custom.css' );

		wp_enqueue_style( 'acl-googleapis-css_01', 'https://fonts.googleapis.com/css?family=Dosis:600,700,800' );
		wp_enqueue_style( 'acl-googleapis-css_02', 'https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900' );
		wp_enqueue_style( 'acl-googleapis-css_03', 'https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Montserrat:400,700' );
		wp_enqueue_style( 'acl-confirm-css', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/jquery-confirm.min.css' );
	}
}

add_action( 'admin_print_scripts', 'acl_admin_custom_login_js_pro' );
function acl_admin_custom_login_js_pro() {
	// load JS Files only With Admin Custom Login Menu Page
	if ( strpos( $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'admin_custom_login' ) == true ) {
		wp_enqueue_script( 'theme-preview' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'acl-media-uploads', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/acl-media-upload-script.js', array(
			'media-upload',
			'thickbox',
			'jquery-ui-slider',
			'jquery'
		) );
		wp_enqueue_script( 'acl-color-picker-script', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/acl-color-picker-script.js', array( 'wp-color-picker' ), false, true );
		wp_enqueue_script( 'acl-bootstrap-min-js', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/bootstrap.min.js' );
		wp_enqueue_script( 'acl-metisMenu', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/plugins/metisMenu/metisMenu.min.js' );
		wp_enqueue_script( 'aclsmartech', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/smartech.js', array( 'jquery' ) );
		wp_enqueue_script( 'acl-nalf-sidebar-nav', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/nalf_sidebar_nav.js' );
		wp_enqueue_script( 'acl-media-upload-script-2-js', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/acl-media-upload-script-2.js' );
		wp_enqueue_script( 'acl-font-icon-picker-js', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/fontawesome-iconpicker.js' );

		wp_enqueue_script( 'acl-snap-svg-min', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/dialog/snap.svg-min.js' );
		wp_enqueue_script( 'acl-modernizr-custom', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/dialog/modernizr.custom.js' );
		wp_enqueue_script( 'acl-classie', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/dialog/classie.js' );
		wp_enqueue_script( 'acl-dialogFx', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/dialog/dialogFx.js' );
		wp_enqueue_script( 'acl-jquery-confirm', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/jquery-confirm.min.js' );
	}
}

function acl_advanced_login_form_plugin_pro() {
	wp_enqueue_script( 'jquery' );
	$dashboard_page = unserialize( get_option( 'Admin_custome_login_dashboard' ) );
	$top_page       = unserialize( get_option( 'Admin_custome_login_top' ) );
	if ( $top_page['top_bg_type'] == "slider-background" && $dashboard_page['dashboard_status'] == "enable" ) {
		wp_enqueue_script( 'modernizr', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'js/modernizr.custom.86080.js' );
		wp_enqueue_style( 'demo', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/demo.css' );
	}
	wp_enqueue_style( 'font-awesome_min', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'font-awesome-latest/css/fontawesome-all.min.css' );
	wp_enqueue_style( 'custom-css', WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/acl-custom.css' );
}

add_action( 'login_enqueue_scripts', 'acl_advanced_login_form_plugin_pro' );

/*To change the Login Button Text starts*/
add_action( 'login_form', 'WACL_login_button_text' );
function WACL_login_button_text() {
	add_filter( 'gettext', 'WACL_loginbutton_gettext', 10, 2 );
}

function WACL_loginbutton_gettext( $translation, $text ) {

	if ( get_option( 'Admin_custome_login_login' ) ) {
		$label_login_button = unserialize( get_option( 'Admin_custome_login_login' ) );
		if ( isset( $label_login_button['label_loginButton'] ) ) {
			$label_text = $label_login_button['label_loginButton'];
		} else {
			$label_text = "Log In";
		}
	} else {
		$label_text = "Log In";
	}

	if ( 'Log In' == $text ) {
		return $label_text;
	}

	return $translation;
}

/*To change the Login Button Text ends*/

function acl_footer_func_pro() {
	$text_and_color_page  = unserialize( get_option( 'Admin_custome_login_text' ) );
	$user_input_icon      = $text_and_color_page['user_input_icon'];
	$password_input_icon  = $text_and_color_page['password_input_icon'];
	$enable_inputbox_icon = $text_and_color_page['enable_inputbox_icon'];
	$heading_font_color   = $text_and_color_page['heading_font_color'];
	$heading_font_size    = $text_and_color_page['heading_font_size'];
	$input_font_size      = $text_and_color_page['input_font_size'];
	$top_page             = unserialize( get_option( 'Admin_custome_login_top' ) );
	$Social_page          = unserialize( get_option( 'Admin_custome_login_Social' ) );

	$login_page = unserialize( get_option( 'Admin_custome_login_login' ) );
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
		$label_username = "Username / Email";
	}
	if ( isset( $login_page['label_password'] ) ) {
		$label_password = $login_page['label_password'];
	} else {
		$label_password = "Password";
	}
	?>
    <script>
        jQuery(document).ready(function () {
            jQuery('html body').attr('id', 'screen');
            jQuery('#loginform label[for="user_login"]').attr('id', 'log_input_lable');
            jQuery('#loginform label[for="user_pass"]').attr('id', 'pwd_input_lable');
            jQuery('#loginform p').attr('id', 'log_input_lable');
			jQuery('#loginform .user-pass-wrap').attr('id', 'pwd_input_lable');

			<?php if($enable_inputbox_icon == 'yes'){?>
            if (jQuery('#log_input_lable').length) {
                document.getElementById("log_input_lable").innerHTML = "<?php echo $label_username; ?><div class='input-container'> <div class='icon-ph'><i class='fa <?php echo $user_input_icon; ?>'></i></div> <input id='user_login' name='log' class='input' type='text' placeholder='<?php echo $user_cust_lbl; ?>'></div>";
                document.getElementById("pwd_input_lable").innerHTML = "<?php echo $label_password; ?><div class='input-container'> <div class='icon-ph'><i class='fa <?php echo $password_input_icon; ?>'></i></div> <input id='user_pass' name='pwd' class='input' type='password' placeholder='<?php echo $pass_cust_lbl; ?>'></div>";
                jQuery('body.login div#login form .input, .login input[type="text"]').css('padding', '5px 5px 5px 45px');
            }
			<?php } else { ?>
            if (jQuery('#log_input_lable').length) {
                jQuery('#loginform #user_login').attr('placeholder', '<?php echo $user_cust_lbl; ?>');
                jQuery('#loginform #user_pass').attr('placeholder', '<?php echo $pass_cust_lbl; ?>');
                jQuery('body.login div#login form .input, .login input[type="text"]').css('padding', '5px 5px 5px 5px');
            }
			<?php }?>

			<?php
			$g_page = unserialize( get_option( 'Admin_custome_login_gcaptcha' ) );
			$site_key = $g_page['site_key'];
			$secret_key = $g_page['secret_key'];
			?>

			<?php if ($top_page['top_bg_type'] == "slider-background"){ ?>
            jQuery('#screen').prepend('<ul class="cb-slideshow"> <li><span>Image 01</span></li> <li><span>Image 02</span></li> <li><span>Image 03</span></li>  <li><span>Image 04</span></li>  <li><span>Image 05</span></li> <li><span>Image 06</span></li></ul>');
			<?php } ?>

			<?php if ( ! empty( $Social_page['social_link_new_window'] ) && $Social_page['social_link_new_window'] == 'yes' ) {
			$target = "_blank";
			} else {
				$target = "_self";
			} 
			?>
        	<!--enable Social Icon In inner login form-->
			<?php if($Social_page['enable_social_icon'] == "inner" || $Social_page['enable_social_icon'] == "both") {?>
                jQuery(".forgetmenot, #lostpasswordform").append('<div class="acl-social-inner" style="padding-top:16px"><div class="acl-social-text" style="color:<?php echo $heading_font_color; ?>; font-size:<?php echo $heading_font_size;?>px; "><?php _e( 'Find Us On Social Media', WEBLIZAR_ACL_PRO ); ?></div><div style="padding-top:5px"><?php if($Social_page['social_twitter_link'] != ''){ ?><a href="<?php echo $Social_page['social_twitter_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button twitter"><i class="fab fa-twitter"></i><span></span></a><?php } if($Social_page['social_facebook_link'] != ''){ ?> <a href="<?php echo $Social_page['social_facebook_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button facebook"><i class="fab fa-facebook-f"></i><span></span></a> <?php } if($Social_page['social_google_plus_link'] != ''){ ?> <a href="<?php echo $Social_page['social_google_plus_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button google-plus"><i class="fab fa-google-plus-g"></i><span></span></a><?php } if($Social_page['social_linkedin_link'] != ''){ ?> <a href="<?php echo $Social_page['social_linkedin_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button linkedin"> <i class="fab fa-linkedin-in"> </i> <span></span> </a> <?php } if($Social_page['social_pinterest_link'] != ''){ ?><a href="<?php echo $Social_page['social_pinterest_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button pinterest"><i class="fab fa-pinterest-p"></i><span></span></a><?php } if($Social_page['social_digg_link'] != ''){ ?><a href="<?php echo $Social_page['social_digg_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button digg"><i class="fab fa-digg"></i><span></span></a><?php } if($Social_page['social_youtube_link'] != ''){ ?><a href="<?php echo $Social_page['social_youtube_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button youtube"><i class="fab fa-youtube-square"></i><span></span></a><?php } if($Social_page['social_flickr_link'] != ''){ ?><a href="<?php echo $Social_page['social_flickr_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button flickr"><i class="fab fa-flickr"></i><span></span></a><?php } if($Social_page['social_tumblr_link'] != ''){ ?><a href="<?php echo $Social_page['social_tumblr_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button tumblr"><i class="fab fa-tumblr"></i><span></span></a><?php } if($Social_page['social_skype_link'] != ''){ ?><a href="<?php echo $Social_page['social_skype_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button skype"><i class="fab fa-skype"></i><span></span></a><?php } if($Social_page['social_instagram_link'] != ''){ ?><a href="<?php echo $Social_page['social_instagram_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button instagram"><i class="fab fa-instagram"></i><span></span></a><?php } if($Social_page['social_telegram_link'] != ''){ ?><a href="<?php echo $Social_page['social_telegram_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button telegram"><i class="fab fa-telegram-plane"></i><span></span></a><?php }if($Social_page['social_whatsapp_link'] != ''){ ?><a href="<?php echo $Social_page['social_whatsapp_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button whatsapp"><i class="fab fa-whatsapp"></i><span></span></a><?php } ?><div></div>');
			<?php } ?>
            <!--enable Social Icon In outer login form-->
            <?php if ( ! empty( $Social_page['social_link_new_window'] ) && $Social_page['social_link_new_window'] == 'yes' ) {
			$target = "_blank";
			} else {
				$target = "_self";
			} 
			?>
			<?php if($Social_page['enable_social_icon'] == "outer" || $Social_page['enable_social_icon'] == "both") {?>
            jQuery("#backtoblog").append('<div class="divsocial"><?php if($Social_page['social_twitter_link'] != ''){?> <a href="<?php echo $Social_page['social_twitter_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button twitter"><i class="fab fa-twitter"></i><span></span></a><?php } if($Social_page['social_facebook_link'] != ''){?><a href="<?php echo $Social_page['social_facebook_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button facebook"><i class="fab fa-facebook-f"></i><span></span></a> <?php } if($Social_page['social_google_plus_link'] != ''){?><a href="<?php echo $Social_page['social_google_plus_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button google-plus"><i class="fab fa-google-plus-g"></i><span></span></a><?php } if($Social_page['social_linkedin_link'] != ''){?><a href="<?php echo $Social_page['social_linkedin_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button linkedin"><i class="fab fa-linkedin-in"></i><span></span></a><?php } if($Social_page['social_pinterest_link'] != ''){?><a href="<?php echo $Social_page['social_pinterest_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button pinterest"><i class="fab fa-pinterest-p"></i><span></span></a><?php } if($Social_page['social_digg_link'] != ''){?> <a href="<?php echo $Social_page['social_digg_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button digg"><i class="fab fa-digg"></i><span></span></a><?php } if($Social_page['social_youtube_link'] != ''){?><a href="<?php echo $Social_page['social_youtube_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button youtube"><i class="fab fa-youtube-square"></i><span></span></a><?php } if($Social_page['social_flickr_link'] != ''){?><a href="<?php echo $Social_page['social_flickr_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button flickr"><i class="fab fa-flickr"></i><span></span></a><?php } if($Social_page['social_tumblr_link'] != ''){?><a href="<?php echo $Social_page['social_tumblr_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button tumblr"><i class="fab fa-tumblr"></i><span></span></a><?php } if($Social_page['social_skype_link'] != ''){?><a href="<?php echo $Social_page['social_skype_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button skype"><i class="fab fa-skype"></i><span></span></a><?php } if($Social_page['social_instagram_link'] != ''){?><a href="<?php echo $Social_page['social_instagram_link']; ?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button instagram"><i class="fab fa-instagram"></i><span></span></a><?php }if($Social_page['social_telegram_link'] != ''){ ?><a href="<?php echo $Social_page['social_telegram_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button telegram"><i class="fab fa-telegram-plane"></i><span></span></a><?php }if($Social_page['social_whatsapp_link'] != ''){ ?><a href="<?php echo $Social_page['social_whatsapp_link'];?>" target="<?php echo esc_attr( $target ); ?>" class="icon-button whatsapp"><i class="fab fa-whatsapp"></i><span></span></a><?php } ?></div>');
			<?php }
			$login_page = unserialize( get_option( 'Admin_custome_login_login' ) );
			if ( isset( $login_page['tagline_msg'] ) ) {
				$tagline_msg      = $login_page['tagline_msg'];
				$edit_tagline_msg = stripslashes( $tagline_msg );
			} else {
				$edit_tagline_msg = "";
			}
			?>
            jQuery("#backtoblog").append('<div class="divfooter"><?php echo html_entity_decode( $edit_tagline_msg );?></div>');
        })
    </script>
	<?php
}

add_action( 'login_form', 'weblizar_social_media_login' );
function weblizar_social_media_login() {
	$nonce = wp_create_nonce( 'acl-social-login' );
	global $enable_facebook_login;
	global $enable_google_login;
	global $enable_twitter_login;
	?>
    <div class="weblizar_social_login">
		<?php
		if ( $enable_twitter_login == 'yes' || $enable_google_login == 'yes' || $enable_facebook_login == 'yes' ) {
			?>
            <p>Login with social Media</p>
			<?php
		}
		if ( $enable_twitter_login == 'yes' ) {
			?>
            <a href="<?php echo site_url( '?auth_provider=twitter' ); ?>"><img
                        src="<?php echo WEBLIZAR_ACL_PLUGIN_URL_PRO . "images/twitter_32.png"; ?>"></a>
			<?php
		}
		if ( $enable_google_login == 'yes' ) {
			?>
            <a href="<?php echo site_url( '?auth_provider=google' ); ?>"><img
                        src="<?php echo WEBLIZAR_ACL_PLUGIN_URL_PRO . "images/google_32.png"; ?>"></a>
			<?php
		}
		if ( $enable_facebook_login == 'yes' ) {
			?>
            <a href="<?php echo site_url( '?auth_provider=facebook' ); ?>"><img
                        src="<?php echo WEBLIZAR_ACL_PLUGIN_URL_PRO . "images/facebook_32.png"; ?>"></a>
			<?php
		}
		?>
    </div>
    <style>
        .weblizar_social_login {
            text-align: center;
            padding-bottom: 10px;
        }

        .weblizar_social_login p {
            text-align: left;
            padding: 2.5px 0px 3.5px 0px;
            color: #fff;
        }

        .weblizar_social_login a {
            display: inline-block;
            padding: 5px;
            text-decoration: none;
        }
    </style>
	<?php
}

$dashboard_page = unserialize( get_option( 'Admin_custome_login_dashboard' ) );
if ( $dashboard_page['dashboard_status'] == "enable" ) {
	add_action( 'login_head', 'acl_footer_func_pro' );
}
function acl_admin_custom_login_content_pro() {
	require_once( 'includes/content.php' );
}

/**
 * Process a settings export that generates a .json file of the shop settings
 */
function acl_export_settings_pro() {

	if ( empty( $_POST['acl_action'] ) || 'export_settings' != $_POST['acl_action'] ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['acl_export_nonce'], 'acl_export_nonce' ) ) {
		return;
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
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

	// Get value of Login page
	$login_page               = unserialize( get_option( 'Admin_custome_login_login' ) );
	$login_form_left          = $login_page['login_form_left'];
	$login_form_top           = $login_page['login_form_top'];
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
	$log_form_above_msg       = $login_page['log_form_above_msg'];
	$login_redirect_force     = $login_page['login_redirect_force'];
	$login_force_redirect_url = $login_page['login_force_redirect_url'];
	$login_msg_fontsize       = $login_page['login_msg_fontsize'];
	$login_msg_font_color     = $login_page['login_msg_font_color'];
	$login_tagline_text_color = isset( $login_page['login_tagline_text_color'] ) ? $login_page['login_tagline_text_color'] : '#ffffff';
	$login_tagline_link_color = isset( $login_page['login_tagline_link_color'] ) ? $login_page['login_tagline_link_color'] : '#f00';
	$tagline_msg              = $login_page['tagline_msg'];
	$user_cust_lbl            = $login_page['user_cust_lbl'];
	$pass_cust_lbl            = $login_page['pass_cust_lbl'];
	$custom_error_msg         = isset( $login_page['custom_error_msg'] ) ? $login_page['custom_error_msg'] : '';
	$label_username           = $login_page['label_username'];
	$label_password           = $login_page['label_password'];
	$label_loginButton        = $login_page['label_loginButton'];


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

	// Get value of Logo page
	$logo_page      = unserialize( get_option( 'Admin_custome_login_logo' ) );
	$logo_show 		= isset( $logo_page['logo_show'] ) ? $logo_page['logo_show'] : 'yes';
	$logo_image     = $logo_page['logo_image'];
	$logo_width     = $logo_page['logo_width'];
	$logo_height    = $logo_page['logo_height'];
	$logo_url       = $logo_page['logo_url'];
	$logo_url_title = $logo_page['logo_url_title'];

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
	$social_link_new_window    = $Social_page['social_link_new_window'];
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

	$g_page                = unserialize( get_option( 'Admin_custome_login_gcaptcha' ) );
	$site_key              = $g_page['site_key'];
	$secret_key            = $g_page['secret_key'];
	$login_enable_gcaptcha = $g_page['login_enable_gcaptcha'];
	$acl_gcaptcha_theme    = isset( $g_page['acl_gcaptcha_theme'] ) ? $g_page['acl_gcaptcha_theme'] : 'light';

	/* Get Login Attempt value */
	$attempt_settings = unserialize( get_option( 'Admin_custome_login_attempts' ) );

	$no_attempts               = $attempt_settings['no_attempts'];
	$time_duration_nxt_attempt = $attempt_settings['time_duration_nxt_attempt'];
	$enable_login_attempts     = $attempt_settings['enable_login_attempts'];

	/* Restriction */
	$user_restriction         = unserialize( get_option( 'Admin_custome_login_restrict' ) );
	$enable_restrict_attempts = $user_restriction['enable_restrict_attempts'];
	$user_role                = $user_restriction['user_role'];

	$user_restriction_maxuser = unserialize( get_option( 'Admin_custome_login_restrict_maxuser' ) );
	$enable_restrict_maxuser  = $user_restriction_maxuser['enable_restrict_maxuser'];
	$max_user                 = $user_restriction_maxuser['max_users'];

	/*IP Restriction*/
	$ip_restriction     = unserialize( get_option( 'Admin_custome_login_allow_ip' ) );
	$ip_address         = $ip_restriction['ip_address'];
	$enable_restrict_ip = $ip_restriction['enable_restrict_ip'];

	/*banned user by name*/
	$banned_user       = unserialize( get_option( 'Admin_custome_banned_user' ) );
	$banned_user_array = array();
	$banned_user_allow = $banned_user['enable_restrict_user'];
	$banned_user_array = $banned_user['banned_user'];

	$ACL_ALL_Settings = serialize( array(
		'dashboard_status'        => $dashboard_status,
		'top_bg_type'             => $top_bg_type,
		'top_color'               => $top_color,
		'top_image'               => $top_image,
		'top_cover'               => $top_cover,
		'top_repeat'              => $top_repeat,
		'top_position'            => $top_position,
		'top_attachment'          => $top_attachment,
		'top_slideshow_no'        => $top_slideshow_no,
		'top_bg_slider_animation' => $top_bg_slider_animation,

		'login_form_left'          => $login_form_left,
		'login_form_top'           => $login_form_top,
		'login_bg_type'            => $login_bg_type,
		'login_bg_color'           => $login_bg_color,
		'login_bg_effect'          => $login_bg_effect,
		'login_bg_image'           => $login_bg_image,
		'login_form_opacity'       => $login_form_opacity,
		'login_form_width'         => $login_form_width,
		'login_form_radius'        => $login_form_radius,
		'login_border_style'       => $login_border_style,
		'login_border_thikness'    => $login_border_thikness,
		'login_border_color'       => $login_border_color,
		'login_bg_repeat'          => $login_bg_repeat,
		'login_bg_position'        => $login_bg_position,
		'login_enable_shadow'      => $login_enable_shadow,
		'login_shadow_color'       => $login_shadow_color,
		'log_form_above_msg'       => $log_form_above_msg,
		'login_redirect_force'     => $login_redirect_force,
		'login_force_redirect_url' => $login_force_redirect_url,
		'custom_error_msg'         => $custom_error_msg,
		'login_msg_fontsize'       => $login_msg_fontsize,
		'login_msg_font_color'     => $login_msg_font_color,
		'login_tagline_text_color' 	=> $login_tagline_text_color,
		'login_tagline_link_color' 	=> $login_tagline_link_color,
		'tagline_msg'              => $tagline_msg,
		'user_cust_lbl'            => $user_cust_lbl,
		'pass_cust_lbl'            => $pass_cust_lbl,
		'label_username'          => $label_username,
		'label_password'           => $label_password,
		'label_loginButton'        => $label_loginButton,

		'heading_font_color'   => $heading_font_color,
		'input_font_color'     => $input_font_color,
		'link_color'           => $link_color,
		'button_color'         => $button_color,
		'button_text_color'    => $button_text_color,
		'heading_font_size'    => $heading_font_size,
		'input_font_size'      => $input_font_size,
		'link_size'            => $link_size,
		'button_font_size'     => $button_font_size,
		'enable_link_shadow'   => $enable_link_shadow,
		'link_shadow_color'    => $link_shadow_color,
		'heading_font_style'   => $heading_font_style,
		'input_font_style'     => $input_font_style,
		'link_font_style'      => $link_font_style,
		'button_font_style'    => $button_font_style,
		'enable_inputbox_icon' => $enable_inputbox_icon,
		'user_input_icon'      => $user_input_icon,
		'password_input_icon'  => $password_input_icon,

		'logo_show'		 => $logo_show,
		'logo_image'     => $logo_image,
		'logo_width'     => $logo_width,
		'logo_height'    => $logo_height,
		'logo_url'       => $logo_url,
		'logo_url_title' => $logo_url_title,

		'enable_social_icon'        => $enable_social_icon,
		'social_icon_size'          => $social_icon_size,
		'social_icon_layout'        => $social_icon_layout,
		'social_link_new_window'	=> $social_link_new_window,
		'social_icon_color'         => $social_icon_color,
		'social_icon_color_onhover' => $social_icon_color_onhover,
		'social_icon_bg'            => $social_icon_bg,
		'social_icon_bg_onhover'    => $social_icon_bg_onhover,
		'social_facebook_link'      => $social_facebook_link,
		'social_twitter_link'       => $social_twitter_link,
		'social_linkedin_link'      => $social_linkedin_link,
		'social_google_plus_link'   => $social_google_plus_link,
		'social_pinterest_link'     => $social_pinterest_link,
		'social_digg_link'          => $social_digg_link,
		'social_youtube_link'       => $social_youtube_link,
		'social_flickr_link'        => $social_flickr_link,
		'social_tumblr_link'        => $social_tumblr_link,
		'social_skype_link'         => $social_skype_link,
		'social_instagram_link'     => $social_instagram_link,
		'social_telegram_link'      => $social_telegram_link,
		'social_whatsapp_link'      => $social_whatsapp_link,

		'Slidshow_image_1'       => $Slidshow_image_1,
		'Slidshow_image_2'       => $Slidshow_image_2,
		'Slidshow_image_3'       => $Slidshow_image_3,
		'Slidshow_image_4'       => $Slidshow_image_4,
		'Slidshow_image_5'       => $Slidshow_image_5,
		'Slidshow_image_6'       => $Slidshow_image_6,
		'Slidshow_image_label_1' => $Slidshow_image_label_1,
		'Slidshow_image_label_2' => $Slidshow_image_label_2,
		'Slidshow_image_label_3' => $Slidshow_image_label_3,
		'Slidshow_image_label_4' => $Slidshow_image_label_4,
		'Slidshow_image_label_5' => $Slidshow_image_label_5,
		'Slidshow_image_label_6' => $Slidshow_image_label_6,

		'site_key'              => $site_key,
		'secret_key'            => $secret_key,
		'login_enable_gcaptcha' => $login_enable_gcaptcha,
		'acl_gcaptcha_theme'    => $acl_gcaptcha_theme,

		'no_attempts'               => $no_attempts,
		'time_duration_nxt_attempt' => $time_duration_nxt_attempt,
		'enable_login_attempts'     => $enable_login_attempts,
		'user_restriction'          => $user_restriction,
		'enable_restrict_attempts'  => $enable_restrict_attempts,
		'user_role'                 => $user_role,
		'user_restriction_maxuser'  => $user_restriction_maxuser,
		'enable_restrict_maxuser'   => $enable_restrict_maxuser,
		'max_user'                  => $max_user,
		'ip_restriction'            => $ip_restriction,
		'ip_address'                => $ip_address,
		'enable_restrict_ip'        => $enable_restrict_ip,
		'banned_user_allow'         => $banned_user_allow,
		'banned_user_array'         => $banned_user_array

	) );

	ignore_user_abort( true );

	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=pwsix-settings-export-' . date( 'm-d-Y' ) . '.json' );
	header( "Expires: 0" );

	echo json_encode( $ACL_ALL_Settings );
	exit;
}

add_action( 'admin_init', 'acl_export_settings_pro' );

/**
 * Process a settings import from a json file
 */
function acl_import_settings_pro() {

	if ( empty( $_POST['acl_action'] ) || 'import_settings' != $_POST['acl_action'] ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['acl_import_nonce'], 'acl_import_nonce' ) ) {
		return;
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	list( $oteher_extension, $extension ) = explode( ".", $_FILES['import_file']['name'] );
	//$extension = end( explode( '.', $_FILES['import_file']['name'] ) );

	if ( $extension != 'json' ) {
		wp_die( __( 'Please upload a valid .json file' ) );
	}

	$import_file = $_FILES['import_file']['tmp_name'];

	if ( empty( $import_file ) ) {
		wp_die( __( 'Please upload a file to import' ) );
	}

	// Retrieve the settings from the file.
	$settings = json_decode( file_get_contents( $import_file ) );

	$ACL_Settings = unserialize( $settings );

	$dashboard_status = $ACL_Settings['dashboard_status'];

	$top_bg_type             = $ACL_Settings['top_bg_type'];
	$top_color               = $ACL_Settings['top_color'];
	$top_image               = $ACL_Settings['top_image'];
	$top_cover               = $ACL_Settings['top_cover'];
	$top_repeat              = $ACL_Settings['top_repeat'];
	$top_position            = $ACL_Settings['top_position'];
	$top_attachment          = $ACL_Settings['top_attachment'];
	$top_slideshow_no        = $ACL_Settings['top_slideshow_no'];
	$top_bg_slider_animation = $ACL_Settings['top_bg_slider_animation'];

	$login_form_left          = $ACL_Settings['login_form_left'];
	$login_form_top           = $ACL_Settings['login_form_top'];
	$login_bg_type            = $ACL_Settings['login_bg_type'];
	$login_bg_color           = $ACL_Settings['login_bg_color'];
	$login_bg_effect          = $ACL_Settings['login_bg_effect'];
	$login_bg_image           = $ACL_Settings['login_bg_image'];
	$login_form_opacity       = $ACL_Settings['login_form_opacity'];
	$login_form_width         = $ACL_Settings['login_form_width'];
	$login_form_radius        = $ACL_Settings['login_form_radius'];
	$login_border_style       = $ACL_Settings['login_border_style'];
	$login_border_thikness    = $ACL_Settings['login_border_thikness'];
	$login_border_color       = $ACL_Settings['login_border_color'];
	$login_bg_repeat          = $ACL_Settings['login_bg_repeat'];
	$login_bg_position        = $ACL_Settings['login_bg_position'];
	$login_enable_shadow      = $ACL_Settings['login_enable_shadow'];
	$login_shadow_color       = $ACL_Settings['login_shadow_color'];
	$log_form_above_msg       = $ACL_Settings['log_form_above_msg'];
	$login_redirect_force     = $ACL_Settings['login_redirect_force'];
	$login_force_redirect_url = $ACL_Settings['login_force_redirect_url'];
	$login_msg_fontsize       = $ACL_Settings['login_msg_fontsize'];
	$login_msg_font_color     = $ACL_Settings['login_msg_font_color'];
	$login_tagline_text_color = isset( $ACL_Settings['login_tagline_text_color'] ) ? $ACL_Settings['login_tagline_text_color'] : '#ffffff';
	$login_tagline_link_color = isset( $ACL_Settings['login_tagline_link_color'] ) ? $ACL_Settings['login_tagline_link_color'] : '#f00';
	$tagline_msg              = $ACL_Settings['tagline_msg'];
	$user_cust_lbl            = $ACL_Settings['user_cust_lbl'];
	$pass_cust_lbl            = $ACL_Settings['pass_cust_lbl'];
	$custom_error_msg         = isset( $ACL_Settings['custom_error_msg'] ) ? $ACL_Settings['custom_error_msg'] : '';
	$label_username           = $ACL_Settings['label_username'];
	$label_password           = $ACL_Settings['label_password'];
	$label_loginButton        = $ACL_Settings['label_loginButton'];

	$heading_font_color   = $ACL_Settings['heading_font_color'];
	$input_font_color     = $ACL_Settings['input_font_color'];
	$link_color           = $ACL_Settings['link_color'];
	$button_color         = $ACL_Settings['button_color'];
	$button_text_color    = isset( $ACL_Settings['button_text_color'] ) ? $ACL_Settings['button_text_color'] : '#ffffff';
	$heading_font_size    = $ACL_Settings['heading_font_size'];
	$input_font_size      = $ACL_Settings['input_font_size'];
	$link_size            = $ACL_Settings['link_size'];
	$button_font_size     = $ACL_Settings['button_font_size'];
	$enable_link_shadow   = $ACL_Settings['enable_link_shadow'];
	$link_shadow_color    = $ACL_Settings['link_shadow_color'];
	$heading_font_style   = $ACL_Settings['heading_font_style'];
	$input_font_style     = $ACL_Settings['input_font_style'];
	$link_font_style      = $ACL_Settings['link_font_style'];
	$button_font_style    = $ACL_Settings['button_font_style'];
	$enable_inputbox_icon = $ACL_Settings['enable_inputbox_icon'];
	$user_input_icon      = $ACL_Settings['user_input_icon'];
	$password_input_icon  = $ACL_Settings['password_input_icon'];

	$logo_image     = $ACL_Settings['logo_image'];
	$logo_show      = isset( $ACL_Settings['logo_show'] ) ? $ACL_Settings['logo_show'] : 'yes';
	$logo_width     = $ACL_Settings['logo_width'];
	$logo_height    = $ACL_Settings['logo_height'];
	$logo_url       = $ACL_Settings['logo_url'];
	$logo_url_title = $ACL_Settings['logo_url_title'];

	$Slidshow_image_1 = $ACL_Settings['Slidshow_image_1'];
	$Slidshow_image_2 = $ACL_Settings['Slidshow_image_2'];
	$Slidshow_image_3 = $ACL_Settings['Slidshow_image_3'];
	$Slidshow_image_4 = $ACL_Settings['Slidshow_image_4'];
	$Slidshow_image_5 = $ACL_Settings['Slidshow_image_5'];
	$Slidshow_image_6 = $ACL_Settings['Slidshow_image_6'];

	$Slidshow_image_label_1 = $ACL_Settings['Slidshow_image_label_1'];
	$Slidshow_image_label_2 = $ACL_Settings['Slidshow_image_label_2'];
	$Slidshow_image_label_3 = $ACL_Settings['Slidshow_image_label_3'];
	$Slidshow_image_label_4 = $ACL_Settings['Slidshow_image_label_4'];
	$Slidshow_image_label_5 = $ACL_Settings['Slidshow_image_label_5'];
	$Slidshow_image_label_6 = $ACL_Settings['Slidshow_image_label_6'];

	$enable_social_icon        = $ACL_Settings['enable_social_icon'];
	$social_icon_size          = $ACL_Settings['social_icon_size'];
	$social_icon_layout        = $ACL_Settings['social_icon_layout'];
	$social_link_new_window	   = $ACL_Settings['social_link_new_window'];
	$social_icon_color         = $ACL_Settings['social_icon_color'];
	$social_icon_color_onhover = $ACL_Settings['social_icon_color_onhover'];
	$social_icon_bg            = $ACL_Settings['social_icon_bg'];
	$social_icon_bg_onhover    = $ACL_Settings['social_icon_bg_onhover'];
	$social_facebook_link      = $ACL_Settings['social_facebook_link'];
	$social_twitter_link       = $ACL_Settings['social_twitter_link'];
	$social_linkedin_link      = $ACL_Settings['social_linkedin_link'];
	$social_google_plus_link   = $ACL_Settings['social_google_plus_link'];
	$social_pinterest_link     = $ACL_Settings['social_pinterest_link'];
	$social_digg_link          = $ACL_Settings['social_digg_link'];
	$social_youtube_link       = $ACL_Settings['social_youtube_link'];
	$social_flickr_link        = $ACL_Settings['social_flickr_link'];
	$social_tumblr_link        = $ACL_Settings['social_tumblr_link'];
	// $social_vkontakte_link     = $ACL_Settings['social_vkontakte_link'];
	$social_skype_link         = $ACL_Settings['social_skype_link'];
	$social_instagram_link     = $ACL_Settings['social_instagram_link'];
	$social_telegram_link      = isset( $ACL_Settings['social_telegram_link'] ) ? $ACL_Settings['social_telegram_link'] : 'https://telegram.org/';
	$social_whatsapp_link      = isset( $ACL_Settings['social_whatsapp_link'] ) ? $ACL_Settings['social_whatsapp_link'] : 'https://whatsapp.com/';

	$site_key              = $ACL_Settings['site_key'];
	$secret_key            = $ACL_Settings['secret_key'];
	$login_enable_gcaptcha = $ACL_Settings['login_enable_gcaptcha'];
	$acl_gcaptcha_theme    = isset( $ACL_Settings['acl_gcaptcha_theme'] ) ? $ACL_Settings['acl_gcaptcha_theme'] : 'light';

	$no_attempts               = $ACL_Settings['no_attempts'];
	$time_duration_nxt_attempt = $ACL_Settings['time_duration_nxt_attempt'];
	$enable_login_attempts     = $ACL_Settings['enable_login_attempts'];

	$enable_restrict_attempts = $ACL_Settings['enable_restrict_attempts'];
	$user_role                = $ACL_Settings['user_role'];
	$enable_restrict_maxuser  = $ACL_Settings['enable_restrict_maxuser'];
	$max_user                 = isset( $ACL_Settings['max_users'] ) ? $ACL_Settings['max_users'] : 0;
	$ip_address               = $ACL_Settings['ip_address'];
	$enable_restrict_ip       = $ACL_Settings['enable_restrict_ip'];

	$banned_user_allow = isset( $ACL_Settings['enable_restrict_user'] ) ? $ACL_Settings['enable_restrict_user'] : 'no';
	$banned_user_array = isset( $ACL_Settings['banned_user'] ) ? $ACL_Settings['banned_user'] : '';

	$upload_dir  = wp_upload_dir();
	$plugins_dir = plugins_url();

	// Top Background Image
	$data = $top_image;
	if ( strpos( $data, 'uploads' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "uploads", $data );
		$top_image = $upload_dir['baseurl'] . $image_path;
	} else if ( strpos( $data, 'plugins' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "plugins", $data );
		$top_image = $plugins_dir . $image_path;
	}

	// Login From Background Image
	$data1 = $login_bg_image;
	if ( strpos( $data1, 'uploads' ) == true ) {
		list( $oteher_path1, $image_path1 ) = explode( "uploads", $data1 );
		$login_bg_image = $upload_dir['baseurl'] . $image_path1;
	} else if ( strpos( $data1, 'plugins' ) == true ) {
		list( $oteher_path1, $image_path1 ) = explode( "plugins", $data1 );
		$login_bg_image = $plugins_dir . $image_path1;
	}

	// Login From Background Image
	$data2 = $logo_image;
	if ( strpos( $data2, 'uploads' ) == true ) {
		list( $oteher_path2, $image_path2 ) = explode( "uploads", $data2 );
		$logo_image = $upload_dir['baseurl'] . $image_path2;
	} else if ( strpos( $data2, 'plugins' ) == true ) {
		list( $oteher_path2, $image_path2 ) = explode( "plugins", $data2 );
		$logo_image = $plugins_dir . $image_path2;
	}

	// Slider Image 1
	$Slidshow_image_url_1 = $Slidshow_image_1;
	if ( strpos( $Slidshow_image_url_1, 'uploads' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "uploads", $Slidshow_image_url_1 );
		$Slidshow_image_1 = $upload_dir['baseurl'] . $image_path;
	} else if ( strpos( $Slidshow_image_url_1, 'plugins' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "plugins", $Slidshow_image_url_1 );
		$Slidshow_image_1 = $plugins_dir . $image_path;
	}

	// Slider Image 2
	$Slidshow_image_url_2 = $Slidshow_image_2;
	if ( strpos( $Slidshow_image_url_2, 'uploads' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "uploads", $Slidshow_image_url_2 );
		$Slidshow_image_2 = $upload_dir['baseurl'] . $image_path;
	} else if ( strpos( $Slidshow_image_url_2, 'plugins' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "plugins", $Slidshow_image_url_2 );
		$Slidshow_image_2 = $plugins_dir . $image_path;
	}

	// Slider Image 3
	$Slidshow_image_url_3 = $Slidshow_image_3;
	if ( strpos( $Slidshow_image_url_3, 'uploads' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "uploads", $Slidshow_image_url_3 );
		$Slidshow_image_3 = $upload_dir['baseurl'] . $image_path;
	} else if ( strpos( $Slidshow_image_url_3, 'plugins' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "plugins", $Slidshow_image_url_3 );
		$Slidshow_image_3 = $plugins_dir . $image_path;
	}

	// Slider Image 4
	$Slidshow_image_url_4 = $Slidshow_image_4;
	if ( strpos( $Slidshow_image_url_4, 'uploads' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "uploads", $Slidshow_image_url_4 );
		$Slidshow_image_4 = $upload_dir['baseurl'] . $image_path;
	} else if ( strpos( $Slidshow_image_url_4, 'plugins' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "plugins", $Slidshow_image_url_4 );
		$Slidshow_image_4 = $plugins_dir . $image_path;
	}

	// Slider Image 5
	$Slidshow_image_url_5 = $Slidshow_image_5;
	if ( strpos( $Slidshow_image_url_5, 'uploads' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "uploads", $Slidshow_image_url_5 );
		$Slidshow_image_5 = $upload_dir['baseurl'] . $image_path;
	} else if ( strpos( $Slidshow_image_url_5, 'plugins' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "plugins", $Slidshow_image_url_5 );
		$Slidshow_image_5 = $plugins_dir . $image_path;
	}

	// Slider Image 6
	$Slidshow_image_url_6 = $Slidshow_image_6;
	if ( strpos( $Slidshow_image_url_6, 'uploads' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "uploads", $Slidshow_image_url_6 );
		$Slidshow_image_6 = $upload_dir['baseurl'] . $image_path;
	} else if ( strpos( $Slidshow_image_url_6, 'plugins' ) == true ) {
		list( $oteher_path, $image_path ) = explode( "plugins", $Slidshow_image_url_6 );
		$Slidshow_image_6 = $plugins_dir . $image_path;
	}

	$dashboard_page = serialize( array(
		'dashboard_status' => $dashboard_status
	) );
	update_option( 'Admin_custome_login_dashboard', $dashboard_page );

	$top_page = serialize( array(
		'top_bg_type'             => $top_bg_type,
		'top_color'               => $top_color,
		'top_image'               => $top_image,
		'top_cover'               => $top_cover,
		'top_repeat'              => $top_repeat,
		'top_position'            => $top_position,
		'top_attachment'          => $top_attachment,
		'top_slideshow_no'        => $top_slideshow_no,
		'top_bg_slider_animation' => $top_bg_slider_animation
	) );
	update_option( 'Admin_custome_login_top', $top_page );

	$login_page = serialize( array(
		'login_form_left'          => $login_form_left,
		'login_form_top'           => $login_form_top,
		'login_bg_type'            => $login_bg_type,
		'login_bg_color'           => $login_bg_color,
		'login_bg_effect'          => $login_bg_effect,
		'login_bg_image'           => $login_bg_image,
		'login_form_opacity'       => $login_form_opacity,
		'login_form_width'         => $login_form_width,
		'login_form_radius'        => $login_form_radius,
		'login_border_style'       => $login_border_style,
		'login_border_thikness'    => $login_border_thikness,
		'login_border_color'       => $login_border_color,
		'login_bg_repeat'          => $login_bg_repeat,
		'login_bg_position'        => $login_bg_position,
		'login_enable_shadow'      => $login_enable_shadow,
		'login_shadow_color'       => $login_shadow_color,
		'log_form_above_msg'       => $log_form_above_msg,
		'login_redirect_force'     => $login_redirect_force,
		'login_force_redirect_url' => $login_force_redirect_url,
		'login_msg_fontsize'       => $login_msg_fontsize,
		'login_msg_font_color'     => $login_msg_font_color,
		'login_tagline_text_color' 	=> $login_tagline_text_color,
		'login_tagline_link_color' 	=> $login_tagline_link_color,
		'tagline_msg'              => $tagline_msg,
		'user_cust_lbl'            => $user_cust_lbl,
		'pass_cust_lbl'            => $pass_cust_lbl,
		'label_username'           => $label_username,
		'label_password'           => $label_password,
		'label_loginButton'        => $label_loginButton,
	) );
	update_option( 'Admin_custome_login_login', $login_page );

	$text_and_color_page = serialize( array(
		'heading_font_color'   => $heading_font_color,
		'input_font_color'     => $input_font_color,
		'link_color'           => $link_color,
		'button_color'         => $button_color,
		'button_text_color'    => $button_text_color,
		'heading_font_size'    => $heading_font_size,
		'input_font_size'      => $input_font_size,
		'link_size'            => $link_size,
		'button_font_size'     => $button_font_size,
		'enable_link_shadow'   => $enable_link_shadow,
		'link_shadow_color'    => $link_shadow_color,
		'heading_font_style'   => $heading_font_style,
		'input_font_style'     => $input_font_style,
		'link_font_style'      => $link_font_style,
		'button_font_style'    => $button_font_style,
		'enable_inputbox_icon' => $enable_inputbox_icon,
		'user_input_icon'      => $user_input_icon,
		'password_input_icon'  => $password_input_icon
	) );
	update_option( 'Admin_custome_login_text', $text_and_color_page );

	$logo_page = serialize( array(
		'logo_image'     => $logo_image,
		'logo_show'		 => $logo_show,
		'logo_width'     => $logo_width,
		'logo_height'    => $logo_height,
		'logo_url'       => $logo_url,
		'logo_url_title' => $logo_url_title
	) );
	update_option( 'Admin_custome_login_logo', $logo_page );

	$Social_page = serialize( array(
		'enable_social_icon'        => $enable_social_icon,
		'social_icon_size'          => $social_icon_size,
		'social_icon_layout'        => $social_icon_layout,
		'social_link_new_window'    => $social_link_new_window,
		'social_icon_color'         => $social_icon_color,
		'social_icon_color_onhover' => $social_icon_color_onhover,
		'social_icon_bg'            => $social_icon_bg,
		'social_icon_bg_onhover'    => $social_icon_bg_onhover,
		'social_facebook_link'      => $social_facebook_link,
		'social_twitter_link'       => $social_twitter_link,
		'social_linkedin_link'      => $social_linkedin_link,
		'social_google_plus_link'   => $social_google_plus_link,
		'social_pinterest_link'     => $social_pinterest_link,
		'social_digg_link'          => $social_digg_link,
		'social_youtube_link'       => $social_youtube_link,
		'social_flickr_link'        => $social_flickr_link,
		'social_tumblr_link'        => $social_tumblr_link,
		// 'social_vkontakte_link'     => $social_vkontakte_link,
		'social_skype_link'         => $social_skype_link,
		'social_instagram_link'     => $social_instagram_link,
		'social_telegram_link'      => $social_telegram_link,
		'social_whatsapp_link'      => $social_whatsapp_link,
	) );
	update_option( 'Admin_custome_login_Social', $Social_page );

	$Slidshow_image = serialize( array(
		'Slidshow_image_1'       => $Slidshow_image_1,
		'Slidshow_image_2'       => $Slidshow_image_2,
		'Slidshow_image_3'       => $Slidshow_image_3,
		'Slidshow_image_4'       => $Slidshow_image_4,
		'Slidshow_image_5'       => $Slidshow_image_5,
		'Slidshow_image_6'       => $Slidshow_image_6,
		'Slidshow_image_label_1' => $Slidshow_image_label_1,
		'Slidshow_image_label_2' => $Slidshow_image_label_2,
		'Slidshow_image_label_3' => $Slidshow_image_label_3,
		'Slidshow_image_label_4' => $Slidshow_image_label_4,
		'Slidshow_image_label_5' => $Slidshow_image_label_5,
		'Slidshow_image_label_6' => $Slidshow_image_label_6
	) );
	update_option( 'Admin_custome_login_Slidshow', $Slidshow_image );

	$g_page = serialize( array(
		'site_key'              => $site_key,
		'secret_key'            => $secret_key,
		'login_enable_gcaptcha' => $login_enable_gcaptcha,
		'acl_gcaptcha_theme'    => $acl_gcaptcha_theme

	) );
	update_option( 'Admin_custome_login_gcaptcha', $g_page );

	//wp_safe_redirect( admin_url( 'options-general.php?page=admin_custom_login' ) ); exit;
}

add_action( 'admin_init', 'acl_import_settings_pro' );
?>