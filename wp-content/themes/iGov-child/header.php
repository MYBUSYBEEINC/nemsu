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

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js?ver=3.7.0"></script>
    <![endif]-->
    
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
					<img class="school-logo" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/277525637_3113550885536569_8640785450851110724_n-1.png" alt="">
					<div class="school-name">
						<h1>NEMSU</h1>
						<h4>School Management System</h4>
					</div>
				</div>
				<div class="topbar-fln">
					<div class="topnav">
						<div class="title-branch">
						<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/Vector.png" alt="">	
						<h2>Welcome to <b>NEMSU</b> School Management System</h2>
						</div>
						<?php get_search_form(); ?>
						<div class="notifications">
						<i class="far fa-bell"></i>
						<i class="fas fa-user-circle"></i>
						</div>	
							
						
						</div>
				</div>
				<div class="clear"></div>
				<div class="sidenav">
					<ul>
						<li>
							<a href="http://" target="_blank" rel="noopener noreferrer">Nav 1</a>
						</li>
						<li>
							<a href="http://" target="_blank" rel="noopener noreferrer">Nav 2</a>
						</li>
						<li>
							<a href="http://" target="_blank" rel="noopener noreferrer">Nav 3</a>
						</li>
						<li>
							<a href="http://" target="_blank" rel="noopener noreferrer">Nav 4</a>
						</li>
						<li>
							<a href="http://" target="_blank" rel="noopener noreferrer">Nav 5</a>
						</li>
						<li>
							<a href="http://" target="_blank" rel="noopener noreferrer">Nav 6</a>
						</li>
						<li>
							<a href="http://" target="_blank" rel="noopener noreferrer">Nav 7</a>
						</li>
						
					</ul>
				</div>
				<!-- <div class="clear"></div> -->
				
			</div>
			
		</div>

		
		<div id="main" class="site-main">
