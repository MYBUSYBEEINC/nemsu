<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function acl_er_login_logo_pro() {
	//Get all options from db
	$er_options          = get_option( 'plugin_erident_settings' );
	$top_page            = unserialize( get_option( 'Admin_custome_login_top' ) );
	$login_page          = unserialize( get_option( 'Admin_custome_login_login' ) );
	$text_and_color_page = unserialize( get_option( 'Admin_custome_login_text' ) );
	$logo_page           = unserialize( get_option( 'Admin_custome_login_logo' ) );
	$Social_page         = unserialize( get_option( 'Admin_custome_login_Social' ) );

	if ( isset( $login_page['login_custom_css'] ) ) {
		$login_custom_css = $login_page['login_custom_css'];
	} else {
		$login_custom_css = "";
	}
	if ( isset( $login_page['login_form_float'] ) ) {
		$login_form_float = $login_page['login_form_float'];
	} else {
		$login_form_float = "center";
	}
	if ( isset( $login_page['login_form_position'] ) ) {
		$login_form_position = $login_page['login_form_position'];
	} else {
		$login_form_position = "default";
	}

	if ( $top_page['top_bg_type'] == "slider-background" ) {
		if ( $top_page['top_bg_slider_animation'] == "slider-style1" ) {
			require_once( 'css/slider-style1.php' );
		} else if ( $top_page['top_bg_slider_animation'] == "slider-style2" ) {
			require_once( 'css/slider-style2.php' );
		} else if ( $top_page['top_bg_slider_animation'] == "slider-style3" ) {
			require_once( 'css/slider-style3.php' );
		} else if ( $top_page['top_bg_slider_animation'] == "slider-style4" ) {
			require_once( 'css/slider-style4.php' );
		}
	}

	if ( $text_and_color_page['enable_link_shadow'] == "yes" ) {
		$link_shadow_color = $text_and_color_page['link_shadow_color'] . ' 0 1px 0';
	} else {
		$link_shadow_color = "none";
	}
	if ( $login_page['login_enable_shadow'] == "yes" ) {
		$login_shadow_color = '0 4px 10px -1px ' . $login_page['login_shadow_color'];
	} else {
		$login_shadow_color = "none";
	}

	// Check if opacity field is empty
	if ( $login_page['login_form_opacity'] == "10" ) {
		$login_form_opacity = "1";
	} else {
		$login_form_opacity = '0.' . $login_page['login_form_opacity'];
	}

	function weblizar_hex2rgb( $colour ) {
		if ( $colour[0] == '#' ) {
			$colour = substr( $colour, 1 );
		}
		if ( strlen( $colour ) == 6 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
		} elseif ( strlen( $colour ) == 3 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
		} else {
			return false;
		}
		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );

		return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	}

	$btnrgba = weblizar_hex2rgb( $text_and_color_page['button_color'] );
	$loginbg = weblizar_hex2rgb( $login_page['login_bg_color'] );
	//require social icon css
	require_once( 'css/socialcss.php' );
	?>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
    <script type="text/javascript">
        WebFont.load({
            google: {
                families: ['<?php echo $text_and_color_page["heading_font_style"]; ?>'] // saved value
            }
        });
        WebFont.load({
            google: {
                families: ["<?php echo $text_and_color_page['input_font_style']; ?>"] // saved value
            }
        });
        WebFont.load({
            google: {
                families: ["<?php echo $text_and_color_page['link_font_style']; ?>"] // saved value
            }
        });
        WebFont.load({
            google: {
                families: ["<?php echo $text_and_color_page['button_font_style']; ?>"] // saved value
            }
        });
    </script>
	<?php
	/* Logo URL */
	function my_login_logo_url() {
		if ( get_option( 'Admin_custome_login_logo' ) ) {
			$logo_page = unserialize( get_option( 'Admin_custome_login_logo' ) );
			if ( isset( $logo_page['logo_url'] ) ) {
				return $logo_page['logo_url'];
			} else {
				return home_url();
			}
			// make get option varibles and use
		} else {
			return home_url();
			/*create default variables and use*/
		}
	}

	add_filter( 'login_headerurl', 'my_login_logo_url' );

	/* Logo URL Title */
	function my_login_logo_url_title() {
		if ( get_option( 'Admin_custome_login_logo' ) ) {
			$logo_page = unserialize( get_option( 'Admin_custome_login_logo' ) );
			if ( isset( $logo_page['logo_url_title'] ) ) {
				return $logo_page['logo_url_title'];
			} else {
				return "Your Site Name and Info";
			}
		} else {
			return "Your Site Name and Info";
		}
	}

	add_filter( 'login_headertext', 'my_login_logo_url_title' );
	?>
    <style type="text/css">
        <?php echo $login_custom_css; ?>

        /* Styles loading for Admin Custome Login */
        html {
            background: none !important;
        }

        <?php if($top_page['top_bg_type'] == "static-background-color"){ ?>
        html body.login {
            background: <?php echo $top_page['top_color'] ?>;
        }

        <?php } else if ($top_page['top_bg_type'] == "static-background-image"){ ?>
        html body.login {
        <?php if($top_page['top_cover']=="yes") { ?> background: url(<?php echo $top_page['top_image'] ?>) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        <?php } else { ?> background: url(<?php echo $top_page['top_image'] ?>) <?php echo $top_page['top_repeat'] ?> <?php echo $top_page['top_position'] ?> !important;
            background-size: auto !important;
        <?php } ?>
        }

        <?php } else if ($top_page['top_bg_type'] == "slider-background"){ ?>
        html body.login {
            background: #000;
        }

        <?php }

		if(isset( $logo_page['logo_show'] ) && ($logo_page['logo_show'] == 'no')) {
		?>
		body.login div#login > h1 {
			display: none;
		}
		<?php
		} else {
		?>
        /* Styles for logo image */
        body.login div#login h1 a {
            background-image: url(<?php echo $logo_page['logo_image']; ?>) !important;
            padding-bottom: 30px;
        <?php if($login_form_float == "center") {?> margin: 0 auto;
        <?php }?> <?php if($login_form_float == "left") {?> margin-left: 30px;
        <?php }?> <?php if($login_form_float == "right") {?> margin-right: 25px;
        <?php }?> background-size: <?php echo $logo_page['logo_width'] ?>px <?php echo $logo_page['logo_height'] ?>px;
            width: <?php echo $logo_page['logo_width'] ?>px;
            height: <?php echo $logo_page['logo_height'] ?>px;
       	}
		<?php
		} 
		if($login_form_position == 'lf_float_style') { ?>
        #login {
            float: <?php echo $login_form_float; ?> !important;
            position: relative !important;
        <?php if($login_form_float == "left") { ?> padding-left: 25px !important;
        <?php }?> <?php if($login_form_float == "right") { ?> padding-right: 25px !important;
        <?php } ?>
        }

        <?php } ?>

        <?php if($login_form_position == 'lf_customize_style') { ?>
        #login {
            position: relative !important;
        <?php if($login_page['login_form_left'] !== "") { ?> margin-left: <?php echo $login_page['login_form_left']; ?>px !important;
        <?php } ?> <?php if($login_page['login_form_top'] !== "") { ?> padding-top: <?php echo $login_page['login_form_top']; ?>px !important;
        <?php } ?>
        }

        <?php }?>

        body.login #login {
            width: <?php echo $login_page['login_form_width'] ?>px;
        }

        .login form {
            border-radius: <?php echo $login_page['login_form_radius'] ?>px;
            border: <?php echo $login_page['login_border_thikness'] ?>px<?php echo $login_page['login_border_style'] ?> <?php echo $login_page['login_border_color'] ?>;
            -moz-box-shadow: <?php echo $login_shadow_color ?>;
            -webkit-box-shadow: <?php echo $login_shadow_color ?>;
            box-shadow: <?php echo $login_shadow_color ?> !important;
        <?php if($Social_page['enable_social_icon'] == "inner" || $Social_page['enable_social_icon'] == "both"){ ?> padding: 26px 24px 8px;
        <?php } ?> position: relative;
            z-index: 1;

            /* for ie */
            background-color: rgb(<?php echo $loginbg['red'];?>,<?php echo $loginbg['green']?>,<?php echo $loginbg['blue']?>);
            background: url(<?php echo $login_page['login_bg_image'] ?>)<?php echo $login_page['login_bg_repeat'] ?> <?php echo $login_page['login_bg_position'] ?>;
            background: rgba(<?php echo $loginbg['red'];?>,<?php echo $loginbg['green']?>,<?php echo $loginbg['blue']?>,<?php echo $login_form_opacity ?>) !important;;
        <?php if($login_page['login_bg_type'] == "static-background-image" ){?> background: url('<?php echo WEBLIZAR_ACL_PLUGIN_URL_PRO.'css/img/'.$login_page['login_bg_effect'].'.png'; ?>') repeat scroll left top, url(<?php echo $login_page['login_bg_image'] ?>) <?php echo $login_page['login_bg_repeat'] ?> <?php echo $login_page['login_bg_position'] ?> !important;
        <?php } ?>
        }

        .icon-ph {
            color: <?php echo $text_and_color_page['input_font_color'] ?>;
        }

        body.login div#login form p label, body.login div#login form #pwd_input_lable label, body.login div#login form #log_input_lable, body.login div#login form .user-pass-wrap {
			color:<?php echo esc_attr($text_and_color_page['heading_font_color']); ?>;
			font-size:<?php echo esc_attr($text_and_color_page['heading_font_size']); ?>px;
			font-family:<?php echo esc_attr($text_and_color_page['heading_font_style']); ?>;
		}

        body.login #loginform p.submit .button-primary, body.wp-core-ui .button-primary {
            background: <?php echo $text_and_color_page['button_color'] ?> !important;
            color: <?php echo isset( $text_and_color_page['button_text_color'] ) ? $text_and_color_page['button_text_color'] : '#ffffff'; ?> !important;
            font-size: <?php echo $text_and_color_page['button_font_size'] ?>px;
            border: none !important;
            text-shadow: <?php echo $link_shadow_color ?>;
            font-family: <?php echo $text_and_color_page['button_font_style'] ?>;
        }

        body.login #loginform p.submit .button-primary:hover, body.login #loginform p.submit .button-primary:focus, body.wp-core-ui .button-primary:hover {
            background: rgba(<?php echo $btnrgba['red'];?>,<?php echo $btnrgba['green']?>,<?php echo $btnrgba['blue']?>, 0.9) !important;
        }

        body.login div#login form .input, .login input[type="text"] {
            color: <?php echo $text_and_color_page['input_font_color'] ?>;
            font-size: <?php echo $text_and_color_page['input_font_size'] ?>px;
            font-family: <?php echo $text_and_color_page['input_font_style'] ?>;
            -webkit-box-shadow: 0 0 0px 1000px white inset;
            -webkit-text-fill-color: <?php echo $text_and_color_page['input_font_color'] ?> !important;
        }

        body.login #nav a, body.login #backtoblog a {
            color: <?php echo $text_and_color_page['link_color'] ?> !important;
            font-family: <?php echo $text_and_color_page['link_font_style'] ?> !important;
			float: unset !important;
        }

        body.login #nav, body.login #backtoblog {
            text-shadow: <?php echo $link_shadow_color ?>;
        }

        .divfooter {
            color: #fff;
            padding-top: 10px !important;
            text-align: center;
            width: 335px;
        }

      	.divfooter a, body.login #backtoblog .divfooter {
		    color: <?php echo esc_attr( isset( $login_page['login_tagline_text_color'] ) ? $login_page['login_tagline_text_color'] : '#ffffff' ); ?> !important;
		    text-shadow: none;
		}
		.divfooter a, body.login #backtoblog .divfooter a {
		    color: <?php echo esc_attr( isset( $login_page['login_tagline_link_color'] ) ? $login_page['login_tagline_link_color'] : '#f00' ); ?> !important;
		    text-shadow: none;
		}

        .login-msg-above {
            background: #ffffff9e;
            padding: 12px !important;
            margin: 4px 0px !important;
            border-bottom: 3px solid #fff;
            border-radius: 25px;
            line-height: 1.4;
            box-shadow: 0 1px 1px 0 hsla(0, 0%, 0%, 0.1);
            font-size: <?php if(isset($login_page['login_msg_fontsize'])) { echo $login_page['login_msg_fontsize']; } else { echo 16; } ?>px !important;
            text-align: center;
            font-weight: 500;
            color: <?php if(isset($login_page['login_msg_font_color'])) { echo $login_page['login_msg_font_color']; } else { echo "#000"; } ?> !important;
        }
    </style>
	<?php
	// Message Above Login Form
	function acl_login_message( $message ) {
		$login_page = unserialize(get_option('Admin_custome_login_login'));
	    if (!empty($login_page['log_form_above_msg']) ){
	    	  $log_form_above_msg = $login_page['log_form_above_msg'];
	   		  return "<p class='login-msg-above'>".html_entity_decode(stripslashes($log_form_above_msg))."</p>";
	    } else {
	       return $message;
	    }
	}
	add_filter( 'login_message', 'acl_login_message' );
}

$dashboard_page   = unserialize( get_option( 'Admin_custome_login_dashboard' ) );
$dashboard_status = $dashboard_page['dashboard_status'];
if ( $dashboard_status == "enable" ) {
	add_action( 'login_enqueue_scripts', 'acl_er_login_logo_pro' );
}
add_action( 'init', 'acl_social_login' );

function acl_social_login() {
	global $enable_google_login;
	global $enable_facebook_login;
	global $enable_twitter_login;
	global $google_redirect_url;
	global $facebook_redirect_url;
	global $twitter_oauth_callback;
	global $google_client_id;
	global $google_client_secret;
	global $facebook_app_id;
	global $facebook_app_secret;
	global $twitter_consumer_key;
	global $twitter_consumer_secret;
	@session_start();
	if ( ! is_user_logged_in() && ! isset( $_GET['oauth_token'] ) && ! isset( $_GET['code'] ) ) {
		unset( $_SESSION['acl_provider'] );
		unset( $_SESSION['acl_callback'] );
	}
	$enable_google_login   = $enable_google_login == 'yes';
	$enable_facebook_login = $enable_facebook_login == 'yes';
	$enable_twitter_login  = $enable_twitter_login == 'yes';
	if ( isset( $_GET["auth_provider"] ) ) {
		if ( $_GET["auth_provider"] == 'google' ) {
			$_SESSION['acl_provider'] = 'Google';
			$_SESSION['acl_callback'] = $google_redirect_url;
		} elseif ( $_GET["auth_provider"] == 'facebook' ) {
			$_SESSION['acl_provider'] = 'Facebook';
			$_SESSION['acl_callback'] = $facebook_redirect_url;
		} elseif ( $_GET["auth_provider"] == 'twitter' ) {
			$_SESSION['acl_provider'] = 'Twitter';
			$_SESSION['acl_callback'] = $twitter_oauth_callback;
		}
	}
	if ( isset( $_SESSION['acl_callback'] ) && isset( $_SESSION['acl_provider'] ) ) {
		require_once WEBLIZAR_ACL_PLUGIN_DIR_PATH_PRO . 'includes/social-login/vendor/autoload.php';
		$config = [
			'callback'  => $_SESSION['acl_callback'],
			'providers' => [
				'Google'   => [
					'enabled' => $enable_google_login,
					'keys'    => [ 'id' => $google_client_id, 'secret' => $google_client_secret ]
				],
				'Facebook' => [
					'enabled' => $enable_facebook_login,
					'keys'    => [ 'id' => $facebook_app_id, 'secret' => $facebook_app_secret ],
					'scope'   => 'email'
				],
				'Twitter'  => [
					'enabled' => $enable_twitter_login,
					'keys'    => [ 'id' => $twitter_consumer_key, 'secret' => $twitter_consumer_secret ]
				]
			]
		];
		try {
			$hybridauth = new Hybridauth\Hybridauth( $config );
			$adapter    = $hybridauth->authenticate( $_SESSION['acl_provider'] );
			$callback   = $_SESSION['acl_callback'];
			$provider   = $_SESSION['acl_provider'];
			unset( $_SESSION['acl_callback'] );
			unset( $_SESSION['acl_provider'] );
			if ( $provider == 'Google' ) {
				$meta_key = 'acl_google_id';
			} elseif ( $provider == 'Facebook' ) {
				$meta_key = 'acl_facebook_id';
			} elseif ( $provider == 'Twitter' ) {
				$meta_key = 'acl_twitter_id';
			}
			$isConnected    = $adapter->isConnected();
			$userProfile    = $adapter->getUserProfile();
			$provider_id    = $userProfile->identifier;
			$email          = $userProfile->email;
			$username       = explode( ' ', $userProfile->displayName )[0];
			$firstname      = explode( ' ', $userProfile->displayName )[0];
			$lastname       = explode( ' ', $userProfile->displayName )[1];
			$user_full_name = $firstname . " " . $lastname;
			$users          = get_users( array(
				'meta_key'     => $meta_key,
				'meta_value'   => $provider_id,
				'meta_compare' => '=='
			) );
			if ( ! count( $users ) ) {
				$user = get_user_by( 'email', $email );
				if ( $user ) {
					$id = $user->ID;
				} else {
					$i = 0;
					while ( username_exists( $username ) ) {
						$i ++;
						$username = $username . $i;
					}
					$userdata   = array(
						'user_pass'    => wp_generate_password(),
						'user_login'   => $username,
						'user_email'   => $email,
						'display_name' => $userProfile->displayName,
						'first_name'   => $firstname,
						'last_name'    => $lastname
					);
					$id         = wp_insert_user( $userdata );
					$adminemail = get_option( 'admin_email' );
					$subject    = "New Registration Using $provider Account";
					//$message = "New user has registered from social media account, $provider. User: $user_full_name, email id: $email";
					$message = "$email has registered to your website.";
					wp_mail( $adminemail, $subject, $message );
				}
				add_user_meta( $id, $meta_key, $provider_id, true );
			} else {
				$user = $users[0];
				$id   = $user->ID;
			}
			wp_set_auth_cookie( $id );
			wp_set_current_user( $id );
			$adapter->disconnect();
			wp_redirect( $callback );
			exit;
		} catch ( \Exception $e ) {
			_e( 'Oops, we ran into an issue! ' . $e->getMessage(), WEBLIZAR_ACL_PRO );
		}
	}
}
?>