<script>
//SHOW APPOINTMENTS IN DASHBOARD
jQuery(document).ready(function() {
jQuery('[data-toggle=popover_coupon_used]').popover({
    content: jQuery('#popover_coupon_used').html(),
    html: true
}).on("mouseenter", function () {
    jQuery(this).popover('show');
}).on("mouseleave", function () {
    jQuery(this).popover('hide');
});
jQuery('[data-toggle=coupon_used_month]').popover({
    content: jQuery('#coupon_used_month').html(),
    html: true
}).on("mouseenter", function () {
    jQuery(this).popover('show');
}).on("mouseleave", function () {
    jQuery(this).popover('hide');
});
});
</script>
<style>
.popover-content{
	background-color: white !important;
	color:black !important;	
}
</style>

<?php
global $wpdb;
$appointments_table =	$wpdb->prefix."apt_appointments";
$staff_table =	$wpdb->prefix."apt_staff";
$clients_table =	$wpdb->prefix."apt_clients";
$payment_table =	$wpdb->prefix."apt_payment";
$coupon_table =	$wpdb->prefix."apt_coupons";
$services_table =	$wpdb->prefix."apt_services";

$current_date_time= current_time( 'mysql' );
$current_date = substr($current_date_time, 0, -8);

$tommorrow_date= date("Y-m-d", time()+86400);

$week_start_date = substr($current_date_time, 0, -8);

$week_date =  date('Y-m-d',strtotime('+1 weeks', strtotime($week_start_date))); 
$week_end_date = date('Y-m-d',strtotime($week_date) - (24*3600*1)); 

$month_start_date = date('Y-m-01'); // hard-coded '01' for first day
$month_end_date = date('Y-m-t', strtotime($month_start_date));

if($user_type == 'admin') {
	$approved_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where status='approved'" );
	$pending_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where status='pending'" );
	$cancelled_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where status='cancel'" );
	$completed_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where status='completed'" );
	$today_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where booking_date='$current_date'" );
	$tommorrow_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where booking_date='$tommorrow_date'" );
	$this_week = $wpdb->get_var( "select COUNT(*) from $appointments_table where booking_date between '$week_start_date' and '$week_end_date'" );
	$month_appts = $wpdb->get_var( "select COUNT(*) from $appointments_table where booking_date between '$month_start_date' and '$month_end_date'" );

} elseif ( $user_type == 'staff' ) {
	$staff_mail = $current_user->user_email;
  	$staff = $user_staff = $wpdb->get_row( "SELECT * FROM `$staff_table` WHERE staff_email = '$staff_mail'" );

	$approved_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where status='approved' AND staff_member= '$staff->id'" );
	$pending_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where status='pending' AND staff_member= '$staff->id'" );
	$cancelled_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where status='cancel' AND staff_member= '$staff->id'" );
	$completed_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where status='completed' AND staff_member= '$staff->id'" );
	$today_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where booking_date='$current_date' AND staff_member= '$staff->id'" );
	$tommorrow_appointments = $wpdb->get_var( "select COUNT(*) from $appointments_table where booking_date='$tommorrow_date' AND staff_member= '$staff->id'" );
	$this_week = $wpdb->get_var( "select COUNT(*) from $appointments_table where booking_date between '$week_start_date' AND '$week_end_date' AND staff_member= '$staff->id'" );
	$month_appts = $wpdb->get_var( "select COUNT(*) from $appointments_table where booking_date between '$month_start_date' and '$month_end_date' AND staff_member= '$staff->id'" );
}
?>
<div class="panel panel-default">
	<div class="panel-heading"><i class="fas fa-home"></i><span class="panel_heading"><?php _e( 'Dashboard',WL_A_P_SYSTEM ) ?></span></div>
	<div class="panel-body" id="dashboard_div">
		<div class="ap-total-graph">
			<h3><?php _e( 'Appointment Reports',WL_A_P_SYSTEM ) ?></h3>
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-thumbs-up dashboard_icons" aria-hidden="true"></i><?php _e( 'Status',WL_A_P_SYSTEM ) ?>  </div>
						<div class="number"><?php echo $approved_appointments; ?><i class="icon-arrow-up"></i></div>
						<div class="title"><?php _e( 'Approved',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'Approved Report',WL_A_P_SYSTEM ) ?>  </div>
						</div>	
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-unlock dashboard_icons" aria-hidden="true"></i><?php _e( 'Status',WL_A_P_SYSTEM ) ?>  </div>
						<div class="number"><?php echo $pending_appointments; ?><i class="icon-arrow-up"></i></div>
						<div class="title"><?php _e( 'Pending',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'Pending Report',WL_A_P_SYSTEM ) ?>  </div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-times dashboard_icons" aria-hidden="true"></i><?php _e( 'Status',WL_A_P_SYSTEM ) ?>  </div>
						<div class="number"><?php echo $cancelled_appointments; ?><i class="icon-arrow-up"></i></div>
						<div class="title"><?php _e( 'Cancel',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'Cancel Report',WL_A_P_SYSTEM ) ?>  </div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox orange" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="far fa-check-square dashboard_icons" aria-hidden="true"></i><?php _e( 'Status',WL_A_P_SYSTEM ) ?> </div>
						<div class="number"><?php echo $completed_appointments; ?><i class="icon-arrow-down"></i></div>
						<div class="title"><?php _e( 'Complete',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'Complete Report',WL_A_P_SYSTEM ) ?>  </div>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox greenDark" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-arrows-alt dashboard_icons" aria-hidden="true"></i><?php _e( 'Appointments Details',WL_A_P_SYSTEM ) ?>  </div>
						<div class="number"><?php echo $today_appointments; ?><i class="icon-arrow-up"></i></div>
						<div class="title"><?php _e( 'Today',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'Todays Appointments',WL_A_P_SYSTEM ) ?>  </div>
						</div>	
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-arrows-alt dashboard_icons" aria-hidden="true"></i><?php _e( 'Appointments Details',WL_A_P_SYSTEM ) ?>  </div>
						<div class="number"><?php echo $tommorrow_appointments; ?><i class="icon-arrow-up"></i></div>
						<div class="title"><?php _e( 'Tommorrow',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'Tommorrows Appointments',WL_A_P_SYSTEM ) ?>  </div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox pink" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-arrows-alt dashboard_icons" aria-hidden="true"></i><?php _e( 'Appointments Details',WL_A_P_SYSTEM ) ?>  </div>
						<div class="number"><?php echo $this_week; ?><i class="icon-arrow-up"></i></div>
						<div class="title"><?php _e('This Week',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'This Week Appointments',WL_A_P_SYSTEM ) ?>  </div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
					<div class="boxchart"><i class="fas fa-arrows-alt dashboard_icons" aria-hidden="true"></i><?php _e( ' Appointments Details',WL_A_P_SYSTEM ) ?> </div>
						<div class="number"><?php echo $this_month ?? ''; ?><i class="icon-arrow-down"></i></div>
						<div class="title"><?php _e( 'This Month',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'This Month Appointments',WL_A_P_SYSTEM ) ?>  </div>
						</div>
					</div>
				</div>		
		    </div>
		</div>
	
		<?php if($user_type == 'admin') { ?>
		<div class="ap-services-graph">
			<h3><?php _e( 'Overall Report',WL_A_P_SYSTEM ) ?></h3>
			<div class="row">
				<div class="col-md-3 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox orange">
							<div class="header dashboard_appt"><?php _e('Total Customer',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e( 'Regular',WL_A_P_SYSTEM ) ?></span>
							<div class="circleStat" >
								<?php   $customer_email_id = $wpdb->get_col( "Select client_email from $appointments_table Group By client_email Having count(client_email) > 1");
								$regular_clients= count($customer_email_id);
								?>
								<input type="text" value="<?php echo $regular_clients ;?>" class="whiteCircle" />
							</div>		
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox purple">
							<div class="header dashboard_appt"><?php _e('Pending Payment',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e('Pending',WL_A_P_SYSTEM ) ?></span>
							<div class="circleStat">
								<?php   $pending_payment_details = $wpdb->get_col( "SELECT id from $payment_table where status='pending'");
								$pending_payments= count($pending_payment_details);
								?>
								<input type="text" value="<?php echo $pending_payments ;?>" class="whiteCircle" />
							</div>		
							
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox black">
							<div class="header dashboard_appt"><?php _e('Coupons',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e('Mostly Used',WL_A_P_SYSTEM ) ?></span>
							
							<a ng-href=""  data-toggle="popover_coupon_used"><span class="badge"></span> 
								<div class="circleStat">
									<?php  $apt_coupons_used = $wpdb->get_col( "SELECT coupon_code_applied FROM  $payment_table GROUP BY coupon_code_applied ORDER BY COUNT(*) DESC LIMIT 1");
									if (empty($apt_coupons_used)) {
										$coupons_used= 'No Coupon';
									}else{
										$coupons_used	= $apt_coupons_used[0];
									}
									
									$filtered_coupons= array_filter($apt_coupons_used);													
									$coupons_mostly_used= count($filtered_coupons);?>
									<input type="text" value="<?php  echo $coupons_mostly_used ;  ?>" class="whiteCircle" />
								</div>
							</a>						
							<div style="display:none" id="popover_coupon_used">
								<?php  echo $coupons_used ;  ?>
							</div>						
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox pink">
							<div class="header dashboard_appt"><?php _e( 'Received Payment',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e( 'Received',WL_A_P_SYSTEM ) ?></span>
							<div class="circleStat">
								<?php   $approved_payment_details = $wpdb->get_col( "SELECT id from $payment_table where status='approved'");
								$approved_payments= count($approved_payment_details);
								?>
								<input type="text" value="<?php echo $approved_payments ;?>" class="whiteCircle" />
							</div>		
							
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="ap-services-graph">
			<h3><?php _e( 'This Month Report',WL_A_P_SYSTEM ) ?></h3>
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox greenLight">
							<div class="header dashboard_appt"><?php _e( 'Active Staff',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e( 'Working',WL_A_P_SYSTEM ) ?></span>
							<div class="circleStat">
								<?php $staff_ids = $wpdb->get_col( "SELECT id from $staff_table");
								$appt_staff_ids = $wpdb->get_col( "SELECT staff_member from $appointments_table where booking_date between '$month_start_date' and '$month_end_date'");
								$appt_staff=array_intersect($staff_ids,$appt_staff_ids);
								$working_staff = count($appt_staff);?>
								<input type="text" value="<?php echo $working_staff ;?>" class="whiteCircle" />
							</div>		
							<div class="footer">
								<span class="count">
									<?php echo $working_staff ;?>
								</span>
								<span class="unit"><?php _e('Working',WL_A_P_SYSTEM ) ?></span>
								<span class="sep"> / </span>
								<span class="value">
									<?php $total_staff= count($staff_ids); ?>
									<span class="number"><?php echo $total_staff; ?></span>
									<span class="unit"><?php _e('Total',WL_A_P_SYSTEM ) ?></span>
								</span>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox orange">
							<div class="header dashboard_appt"><?php _e('Total Customer',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e( 'Regular',WL_A_P_SYSTEM ) ?></span>
							<div class="circleStat">
								<?php   $customer_email_id = $wpdb->get_col( "Select client_email from $appointments_table where booking_date between '$month_start_date' and '$month_end_date' Group By client_email Having count(client_email) > 1");
								$regular_clients= count($customer_email_id);
								?>
								<input type="text" value="<?php echo $regular_clients ;?>" class="whiteCircle" />
							</div>		
							<div class="footer">
								<span class="count">
									<?php echo $regular_clients ;?>
								</span>
								<span class="unit"><?php _e('Regular',WL_A_P_SYSTEM ) ?></span>
								<span class="sep"> / </span>
								<span class="value">
									<?php $clients_members = $wpdb->get_col( "SELECT id from $clients_table");
									$total_customers= count($clients_members); ?>
									<span class="number"><?php echo $total_customers; ?></span>
									<span class="unit"><?php _e('Total',WL_A_P_SYSTEM ) ?></span>
								</span>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox greenDark">
							<div class="header dashboard_appt"><?php _e( 'Active Services',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e('Mostly Used',WL_A_P_SYSTEM ) ?></span>
							<div class="circleStat">
								<?php   $apt_service_details = $wpdb->get_col( "Select service_type from $appointments_table where booking_date between '$month_start_date' and '$month_end_date' Group By service_type Having count(service_type) > 1");
								$services_mostly_used= count($apt_service_details);
								?>
								<input type="text" value="<?php  echo $services_mostly_used ;  ?>" class="whiteCircle" />
							</div>		
							<div class="footer">
								<span class="count">
									<?php echo $services_mostly_used ;?>
								</span>
								<span class="unit"><?php _e('Mostly Used',WL_A_P_SYSTEM ) ?></span>
								<span class="sep"> / </span>
								<span class="value">
									<?php $service_details = $wpdb->get_col( "SELECT id from $services_table");
									$total_services= count($service_details); ?>
									<span class="number"><?php echo $total_services; ?></span>
									<span class="unit"><?php _e('Total',WL_A_P_SYSTEM ) ?></span>
								</span>	
							</div>
						</div>
					</div>
				</div>			
				<div class="col-md-4 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox purple">
							<div class="header dashboard_appt"><?php _e('Pending Payment',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e('Pending',WL_A_P_SYSTEM ) ?></span>
							<div class="circleStat">
								<?php   $pending_payment_details = $wpdb->get_col( "SELECT id from $payment_table where status='pending'");
								$pending_payments= count($pending_payment_details);
								?>
								<input type="text" value="<?php echo $pending_payments ;?>" class="whiteCircle" />
							</div>		
							<div class="footer">
								<span class="count">
									<?php echo $pending_payments ;?>
								</span>
								<span class="unit"><?php _e('Pending',WL_A_P_SYSTEM ) ?></span>
								<span class="sep"> / </span>
								<span class="value">
									<?php $payment_details = $wpdb->get_col( "SELECT id from $payment_table");
									$total_payments= count($payment_details); ?>
									<span class="number"><?php echo $total_payments; ?></span>
									<span class="unit"><?php _e('Total',WL_A_P_SYSTEM ) ?></span>
								</span>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox black">
							<div class="header dashboard_appt"><?php _e('Coupons',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e('Mostly Used',WL_A_P_SYSTEM ) ?></span>
							<a ng-href="" data-toggle="coupon_used_month"><span class="badge"></span> 
								<div class="circleStat">
									<?php  $apt_coupons_used = $wpdb->get_col( "Select coupon_code_applied from $payment_table where appointment_date between '$month_start_date' and '$month_end_date' GROUP BY coupon_code_applied ORDER BY COUNT(*) DESC LIMIT    1");
									if (empty($apt_coupons_used)) {
										$coupons_used_monthly= 'No Coupon';
									}else{
										$coupons_used_monthly	= $apt_coupons_used[0];
									}
									$filtered_coupons= array_filter($apt_coupons_used);													
									$coupons_mostly_used= count($filtered_coupons);?>
									<input type="text" value="<?php  echo $coupons_mostly_used ;  ?>" class="whiteCircle" />
								</div>
							</a>
							
							<div style="display:none" id="coupon_used_month">
								<?php  echo $coupons_used_monthly ;  ?>
							</div>
							<div class="footer">
								<span class="count">
									<?php echo $coupons_mostly_used ;?>
								</span>
								<span class="unit"><?php _e('Mostly Used',WL_A_P_SYSTEM ) ?></span>
								<span class="sep"> / </span>
								<span class="value">
									<?php $coupons_details = $wpdb->get_col( "SELECT id from $coupon_table");
									$total_coupons= count($coupons_details); ?>
									<span class="number"><?php echo $total_coupons; ?></span>
									<span class="unit"><?php _e('Total',WL_A_P_SYSTEM ) ?></span>
								</span>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="span2" onTablet="span4" onDesktop="span2">
						<div class="circleStatsItemBox pink">
							<div class="header dashboard_appt"><?php _e( 'Received Payment',WL_A_P_SYSTEM ) ?></div>
							<span class="percent"><?php _e( 'Received',WL_A_P_SYSTEM ) ?></span>
							<div class="circleStat">
								<?php   $approved_payment_details = $wpdb->get_col( "SELECT id from $payment_table where status='approved'");
								$approved_payments= count($approved_payment_details);
								?>
								<input type="text" value="<?php echo $approved_payments ;?>" class="whiteCircle" />
							</div>		
							<div class="footer">
								<span class="count">
									<?php echo $approved_payments ;?>
								</span>
								<span class="unit"><?php _e( 'Received',WL_A_P_SYSTEM ) ?></span>
								<span class="sep"> / </span>
								<span class="value">
									<span class="number"><?php echo $total_payments; ?></span>
									<span class="unit"><?php _e('Total',WL_A_P_SYSTEM ) ?></span>
								</span>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
				