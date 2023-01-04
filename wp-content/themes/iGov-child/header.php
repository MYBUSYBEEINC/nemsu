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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script  type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
    <script src="https://kit.fontawesome.com/7fddb8c633.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

	<style>.collapse{
			margin-top:-5x;
			color:#fff;
			border-radius: 8px;
		}div .list-menu{
			height: 35px !important;
			padding-bottom:8px;
			color:#fff;
		}
	</style>
	
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
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
		<div class="navbar-wrapper">
			<div class="navbar-container">
				<div class="sidenav">
					<ul>
						<li>
							<a href="#">
							<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/Vector.png" alt=""><br>
							<span>Dashboard</span>
							</a>
						</li>
						<li>
							<a href="<?= get_site_url()?>/students">
							<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/Vector.png" alt=""><br>
							<span>Students</span>
							</a>
						</li>

						<li <?php if(get_the_id() == 239){ echo 'class="active"'; }?> >
							<a href="<?= get_site_url()?>/enrollment">
							<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/Vector.png" alt=""><br>
							<span>Enrollment</span>
							</a>
						</li>
						<li <?php if(get_the_id() == 39){ echo 'class="active"'; }?> >
							<a href="<?= get_site_url()?>/course-schedule-proposal">
							<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/Vector.png" alt=""><br>
							<span>Course Scheduling</span>
							</a>
						</li>
						<li <?php if(get_the_id() == 41){ echo 'class="active"'; }?> >
							<a href="#" id="financeCollapse">
								<div><img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/Vector.png"></div>Finance
							</a>
						</li>
						<div class="collapseContent bg-primary" style="display:none">
							<div class="list-group">
								<a href="<?= get_site_url()?>/finance-dashboard/" class='pt-2 pl-2 pr-2 bg-primary list-menu'>Dashboard</a>
								<a href="<?= get_site_url()?>/finance-dashboard/accept-collection/" class='pt-2 pl-2 pr-2 bg-primary list-menu'>Accept Collection</a>
								<a href="<?= get_site_url()?>/finance-dashboard/create-encashment/" class="pt-2 pl-2 pr-2 bg-primary list-menu">Create Encashment</a>
								<a href="<?= get_site_url()?>/finance-dashboard/create-cash-count/" class="pt-2 pl-2 pr-2 bg-primary list-menu">Create Cash Count</a>
								<a href="<?= get_site_url()?>/finance-dashboard/enter-daily-collection-deposit/" class="pt-2 pl-2 pr-2 bg-primary list-menu">Enter Daily Collection Deposit</a>
								<a href="<?= get_site_url()?>/finance-dashboard/enter-adjustment/" class="pt-2 pl-2 pr-2 bg-primary list-menu">Enter Adjustments</a>
								<a href="<?= get_site_url()?>/finance-dashboard/enter-group-adjustments//" class="pt-2 pl-2 pr-2 bg-primary list-menu">Enter Group Adjustments</a>
								<a href="<?= get_site_url()?>/finance-dashboard/set-subsidiary-ledger/" class="pt-2 pl-2 pr-2 bg-primary list-menu">View Subsidiary Ledger</a>
								<a href="<?= get_site_url()?>/finance-dashboard/print-admission-slip/" class="pt-2 pl-2 pr-2 bg-primary list-menu">Print Admission Slip</a>
								<a href="<?= get_site_url()?>/finance-dashboard/approve-scholarship-grant/" class="pt-2 pl-2 pr-2 bg-primary list-menu">Approve Scholarship or Grant</a>
								<a href="<?= get_site_url()?>/finance-dashboard/" class="pt-2 pl-2 pr-2 bg-primary list-menu">Set Teller OR Number Range</a>
							</div>
						</div>
						<li>
							<a href="#">
							<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/Vector.png" alt=""><br>
							<span>Reports</span>
							</a>
						</li>
						<li <?php if(get_the_id() == 393){ echo 'class="active"'; }?> >
							<a href="<?php echo site_url().'/system/'; ?>">
							<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/Vector.png" alt=""><br>
							<span>System</span>
							</a>
						</li>
					</ul>
				</div>

				<div class="topnav">
						<div class="logos-homepage">
							<img class="school-logo" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/277525637_3113550885536569_8640785450851110724_n-1.png" alt="">
							
							<div class="school-name ">
							<h1>NEMSU</h1>
							<h4>School Management System</h4>
							</div>
						</div>
						
						
						<div class="flex-jc white">
						<div class="welcome white">
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
		</div>
		<div id="main" class="site-main">

		<script>
			$(document).ready(function(){
				// Finance module
				$('#financeCollapse').click(function () {
					if ($('.collapseContent').is(':hidden')) {
						$('.collapseContent').show();
					} else {
						$('.collapseContent').hide();
					}
				}); 
			});

		</script>
