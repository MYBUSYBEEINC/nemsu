<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
acf_form_head();
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
    <script src="https://kit.fontawesome.com/7fddb8c633.js" crossorigin="anonymous"></script>

  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script  type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js?ver=3.7.0"></script>
    <![endif]-->
    
    <script type="text/javascript" id="gwt-pst">
        (function(d, eId) {
        var js, gjs = d.getElementById(eId);
        js = d.createElement('script'); js.id = 'gwt-pst-jsdk';
        js.src = "<?php echo get_stylesheet_directory_uri(); ?>/js/gwtpst.js?"+new Date().getTime();
        gjs.parentNode.insertBefore(js, gjs);
        }(document, 'gwt-pst'));
    </script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php
	global $loggedin;
	if ( is_user_logged_in() ) {
       $loggedin = "y";
       global $current_user; wp_get_current_user();
    } else {
       $loggedin = "";
    }
	?>
	<div id="page" class="hfeed site">
		<div class="topbar-wrapper">
			<div class="topbar-container">
				<div class="topbar-fl">
				    <?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_class'     => 'nav-menu',
							'menu_id'        => 'primary-menu',
						)
					); ?>
				</div>

				<div class="topbar-fr">
					<?php get_search_form(); ?>
					<!--<button type="button" class="a11y-toggle-contrast toggle-contrast" id="is_normal_contrast" aria-pressed="false"><span class="offscreen"><i class="fa fa-universal-access fa-2x" aria-hidden="true"></i></span><span class="aticon aticon-adjust" aria-hidden="true"></span></button>-->
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
		<div class="auxmenu-wrapper">
			<div class="auxmenu-container">
			    <div class="web-logo fl">
			        
			    </div>
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Auxiliary Menu') ) : ?><?php endif; ?>
                <div class="web-pst fr">
			        <div class="web-pst-container">
    			        <div id="pst-container">
                            <div>Philippine Standard Time:</div>
                            <div id="pst-time"></div>
                        </div>
			        </div>
			    </div>
                <div class="clear"></div>
			</div>
		</div>
		
		<div id="main" class="site-main">
