<?php 
	global $wpdb;
	$staff_table =	$wpdb->prefix."apt_staff";
	$client_table = $wpdb->prefix.'apt_clients';
	// include class g-sync file & make object
	include('gsync-class.php');
	$Gsync_ojb = new GoogleCalendarApi();
	
	// get saved refresh & access token
	$refresh_saved = get_option('weblizar_ap_calendar_refresh_token');
	if(is_array($refresh_saved)){
		$saved_access_toekn = 	$refresh_saved['access_token'];
		$saved_refresh_token = $refresh_saved['refresh_token'];
	} else {
		$saved_access_toekn = "";
		$saved_refresh_token = "";
	}
	$current_user = wp_get_current_user();
	//print_r($current_user);
	//$current_staff_email = $current_user->user_email;
	$current_user_email = $current_user->user_email;
	$role = $current_user->roles;
	$current_role = $role[0];

	$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `$staff_table` WHERE staff_email = %s", $current_user_email));
	/* for customer */
	$count_client = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `$client_table` WHERE email = %s", $current_user_email));

	$weblizar_aps_staff_service = get_option("weblizar_aps_staff_dashboard_settings");
	$current_user = wp_get_current_user();
	$role = $current_user->roles;
	$current_role = $role[0];

	$staff_dash_setting = isset($weblizar_aps_staff_service['staff_dashboard_setting']) ? $weblizar_aps_staff_service['staff_dashboard_setting'] : 'no';
	$staff_appoint_setting = isset($weblizar_aps_staff_service['staff_appointment_setting']) ? $weblizar_aps_staff_service['staff_appointment_setting'] : 'no';
	$staff_loc_setting = isset($weblizar_aps_staff_service['staff_loc_setting']) ? $weblizar_aps_staff_service['staff_loc_setting'] : 'no';
	$staff_service_setting = isset($weblizar_aps_staff_service['staff_service_setting']) ? $weblizar_aps_staff_service['staff_service_setting'] : 'no';
	$staff_calendar_setting = isset($weblizar_aps_staff_service['staff_calendar_setting']) ? $weblizar_aps_staff_service['staff_calendar_setting'] : 'no';
	$staff_profile_setting = isset($weblizar_aps_staff_service['staff_profile_setting']) ? $weblizar_aps_staff_service['staff_profile_setting'] : 'no';

    $mark_active = true;
	$mark_page_active = true;

	if($count == 0 && $current_role == "administrator"){
		$user_type = "admin";
    	$mark_active = false;
    	$mark_page_active = false;
	}
	else if($count == 1 && $current_role != "administrator"){
		$user_type = "staff";
	}
	else {
		$user_type = "client";
		$weblizar_aps_client_service = get_option("weblizar_aps_client_dashboard_settings");
		$client_appointment = isset($weblizar_aps_client_service['client_appointment']) ? $weblizar_aps_client_service['client_appointment'] : 'no';
	}
?>
<script type="text/javascript">
//TOGGLE TABS ON CLICK
jQuery(window).on('load', function() {
   jQuery("#ap_main_div").show();
   jQuery("#wpfooter").show();
   jQuery('#bootstrapModalFullCalendar').fullCalendar('render');	
});
jQuery(document).ready(function(){
    jQuery('a.ap_main_side_bar').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        jQuery('#myTab a[href="' + activeTab + '"]').tab('show');
		
    }
});
 jQuery(window).load(function () 
 {
	 jQuery("container-fluid").hide();
 		jQuery(window).preloader({ });
 });
	
jQuery(function() {
	var calendarInit = false;	
	jQuery('a#calendarTab ').on('shown.bs.tab', function (e) {
		if(jQuery(e.target).attr('href') == '#calendars' && !calendarInit) {
		    jQuery('#bootstrapModalFullCalendar').fullCalendar('render');
			jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
            jQuery('#bootstrapModalFullCalendar').fullCalendar('refetchEvents');
		}
	});
	
	jQuery('a#dashboardTab ').on('shown.bs.tab', function (e) 
	{
	 jQuery.ajax({
			data: "action=dashboard_fetch_ajax_request&user_type=<?php echo $user_type; ?>",
			url:ajaxurl, 
			type:"POST",
			success:function(data)
			{	
				// console.log(data);
				jQuery("#dashboard_div" ).empty();   
				jQuery('#dashboard_div').html(data);
				circle_progess();
			}
		});
	});
});
</script>
<!--Preloader element -->
<!-- <div id="preloader">
    <div id="preloader-inner">
	</div>
</div> -->
<div class="wrapper" id="ap_main_div" style="display:none;">
	<!-- Home Start -->
	<div class="container-fluid ap-home theme-menu">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 theme-sidemenu">
				<div class="tab-toggle-btn">
                    <a href="#"><i class="fas fa-bars"></i></a>
                </div>
				<ul class="nav nav-tabs nav-pills service-tab" id="myTab" role="tablist">
					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_dash_setting == 'yes') ) { ?>
					<li class="nav-item active"><a id="dashboardTab" data-toggle="tab" class="theme-link ap_main_side_bar" href="#dashboard"><i class="fas fa-home"></i><span class="panel_heading"><?php _e('Dashboard',WL_A_P_SYSTEM); ?> </span></a></li>
					<?php 
					$mark_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_calendar_setting == 'yes') ) { ?>
					<li class="nav-item <?php echo $mark_active ? 'active' : ''; ?>"><a id="calendarTab" data-toggle="tab" class="theme-link ap_main_side_bar" href="#calendars"><i class="fas fa-calendar"></i><span class="panel_heading"><?php _e('Calendar',WL_A_P_SYSTEM); ?> </span></a></li>
					<?php 
					$mark_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_loc_setting == 'yes') ) { ?>
					<li class="nav-item <?php echo $mark_active ? 'active' : ''; ?>"><a id="LocationTab" data-toggle="tab" class="theme-link ap_main_side_bar" href="#location"><i class="fas fa-location-arrow"></i><span class="panel_heading"><?php _e('Location',WL_A_P_SYSTEM); ?> </span></a></li>
					<?php 
					$mark_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_service_setting == 'yes') ) { ?>
					<li class="nav-item <?php echo $mark_active ? 'active' : ''; ?>"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#service"><i class="fas fa-server"></i><span class="panel_heading"><?php _e('Services',WL_A_P_SYSTEM); ?></span></a></li>
					<?php 
					$mark_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_profile_setting == 'yes') ) { ?>
					<li class="nav-item <?php echo $mark_active ? 'active' : ''; ?>"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#staff"><i class="fas fa-user"></i><span class="panel_heading"><?php _e('Staff Members',WL_A_P_SYSTEM); ?> </span></a></li>
					<?php 
					$mark_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_appoint_setting == 'yes') || ($user_type == 'client' && $client_appointment == 'yes') ) { ?>
					<li class="nav-item <?php echo $mark_active ? 'active' : ''; ?>"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#appointment"><i class="fas fa-thumbtack"></i><span class="panel_heading"><?php _e('Appointments',WL_A_P_SYSTEM); ?> </span></a></li>
					<?php 
					$mark_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) ) { ?>
					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#customer"><i class="fas fa-users"></i><span class="panel_heading"><?php _e('Customers',WL_A_P_SYSTEM); ?> </span></a></li>

					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#payment"><i class="far fa-money-bill-alt"></i><span class="panel_heading"><?php _e('Payments',WL_A_P_SYSTEM); ?> </span></a></li>

					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#coupon"><i class="fas fa-gift"></i><span class="panel_heading"><?php _e('Coupons',WL_A_P_SYSTEM); ?> </span></a></li>

					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#appearance"><i class="fas fa-hourglass-start"></i><span class="panel_heading"><?php _e('Appearance',WL_A_P_SYSTEM); ?> </span></a></li>

					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#email-notification"><i class="fas fa-envelope"></i><span class="panel_heading"><?php _e('Email Notification',WL_A_P_SYSTEM); ?></span></a></li>

					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#holiday"><i class="fas fa-coffee"></i><span class="panel_heading"><?php _e('Holiday',WL_A_P_SYSTEM); ?></span></a></li>

					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#reminder_log"><i class="fas fa-bell"></i><span class="panel_heading"><?php _e('Reminders Log',WL_A_P_SYSTEM); ?></span></a></li>

					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#settings"><i class="fas fa-cog"></i><span class="panel_heading"><?php _e('Settings',WL_A_P_SYSTEM); ?> </span></a></li>

					<li class="nav-item"><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#details"><i class="fas fa-share-square"></i><span class="panel_heading"><?php _e('Plugin Details',WL_A_P_SYSTEM); ?> </span></a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 theme-side-details">
				<div class="tab-content">
					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_dash_setting == 'yes') ) { ?>
					<!-- Index -->
					<div id="dashboard" class="tab-pane fade in active theme-home">
						<?php include("dashboard.php");?>
					</div>
					<!-- Index -->
					<?php 
					$mark_page_active = false;
					} ?>
					
					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_calendar_setting == 'yes') ) { ?>
					<!-- calendar -->
					<div id="calendars" class="tab-pane fade <?php echo $mark_page_active ? 'in active' : ''; ?> theme-calendar">
						<?php include("calendar.php");?>
					</div>
					<!-- calendar -->
					<?php 
					$mark_page_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_loc_setting == 'yes') ) { ?>
					<!-- location -->
					<div id="location" class="tab-pane fade <?php echo $mark_page_active ? 'in active' : ''; ?> theme-calendar">
						<?php include("locations.php");?>
					</div>
					<!-- location -->
					<?php 
					$mark_page_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_service_setting == 'yes') ) { ?>
					<!-- service -->
					<div id="service" class="tab-pane fade <?php echo $mark_page_active ? 'in active' : ''; ?> theme-services">
						<?php include("service.php");?>
					</div>
					<!-- service -->
					<?php 
					$mark_page_active = false;
					} ?>
					
					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_profile_setting == 'yes') ) { ?>
					<!-- staff -->
					<div id="staff" class="tab-pane fade <?php echo $mark_page_active ? 'in active' : ''; ?> theme-staff">
					<?php include("staff.php");?>
						</div>
					<!-- staff -->
					<?php 
					$mark_page_active = false;
					} ?>
					
					<?php if ( ('admin' == $user_type) || ($user_type == 'staff' && $staff_appoint_setting == 'yes') || ($user_type == 'client' && $client_appointment == 'yes') ) { ?>
					<!-- appointment -->
					<div id="appointment" class="tab-pane fade <?php echo $mark_page_active ? 'in active' : ''; ?> theme-appoint">
						<?php include("appointment.php");?>
					</div>
					<!-- appointment -->
					<?php 
					$mark_page_active = false;
					} ?>

					<?php if ( ('admin' == $user_type) ) { ?>
					<!-- customer -->
					<div id="customer" class="tab-pane fade theme-customer">
						<?php include("customer.php");?>
					</div>
					<!-- customer -->
					
					<!-- email-notification -->
					<div id="email-notification" class="tab-pane fade theme-notification">
						<?php include("email-notification.php");?>
						</div>
					<!-- email-notification -->
					
					<!-- payment -->
					<div id="payment" class="tab-pane fade theme-payment">
						<?php include("payment.php");?>
					</div>
					<!-- payment -->
					
					<!-- holiday -->
					<div id="holiday" class="tab-pane fade theme-payment">
						<?php include("holiday.php");?>
					</div>
					<!-- holiday -->
					
					<!-- reminder -->
					<div id="reminder_log" class="tab-pane fade theme-settings">
						<?php include("reminder_log.php");?>
					</div>
					<!-- reminder -->
					
					<!-- appearance -->
						<div id="appearance" class="tab-pane fade theme-apperance ">
						<?php include("appearance.php");?>
					</div>
					<!-- appearance -->
					
					<!-- coupon -->
					<div id="coupon" class="tab-pane fade theme-coupon">
						<?php include("coupon.php"); ?>
						
					</div>
					<!-- coupon -->
					
					<!-- settings -->
					<div id="settings" class="tab-pane fade theme-settings">
						<?php include("setting.php"); ?>
						</div>
					<!-- settings -->	
					
					
					<!-- details -->
					<div id="details" class="tab-pane fade theme-settings">
						<?php include("appt_details.php"); ?>
						</div>
					<!-- details -->	
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- Home End -->
</div>
