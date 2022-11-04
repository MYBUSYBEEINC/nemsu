<?php
//DISABLE PREVIOUS BOOKED TIME SLOTS ACCORDING TO STATUS SET BY ADMIN IN SETTING TAB
//CHECK STAFF LEAVE ON SELECTED DATE
//CHECK CURRENT TIME WITH BUSINESS HOURS- FOR BUSINESS CLOSED
global $wpdb;
$appointments_table =$wpdb->prefix ."apt_appointments";
$appearence_table =	$wpdb->prefix."apt_appearence";
$settings_table =	$wpdb->prefix."apt_settings";
$staff_table =	$wpdb->prefix."apt_staff";
$holidays_table = $wpdb->prefix.'apt_holidays';

$staff_id= $_REQUEST['staff_member'] ;
$current_url= $_REQUEST['current_url'] ;
$service_id= $_REQUEST['service'] ;
$appointment_date=  $_REQUEST['apt_dates'];
$appointment_date_saved = $appointment_date;
$current_time= $_REQUEST['current_time'] ;
$ap_location_id = $_REQUEST['ap_location_id'];
$current_date= date("m/d/Y");

$settings_time_slots = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT time_slots from $settings_table" ); 
$time_slots	= $settings_time_slots['time_slots'];

$settings_custom_slot = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT custom_slot from $settings_table" ); 
$custom_slot	= $settings_custom_slot['custom_slot'];	?>							
	
<?php
	$AppointmentDate = date("Y-m-d", strtotime($_REQUEST['apt_dates']));
	$weekday = date('l', strtotime($AppointmentDate));

	$staff_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_staff where id='$staff_id'");
	foreach($staff_details as $staff_detail){
	$sunday_off= $staff_detail->sun_all_off;
	$monday_off= $staff_detail->mon_all_off;
	$tuesday_off= $staff_detail->tue_all_off;
	$wednesday_off= $staff_detail->wed_all_off;
	$thursday_off= $staff_detail->thu_all_off;
	$friday_off= $staff_detail->fri_all_off;
	$saturday_off= $staff_detail->sat_all_off;
	$staff_member_name= $staff_detail->staff_member_name;

	/* staff holiday */

	function createDateRange($startDate, $endDate, $format = "m/d/Y") {
	    $begin = new DateTime($startDate);
	    $end = new DateTime($endDate);

	    $interval = new DateInterval('P1D'); // 1 Day
	    $dateRange = new DatePeriod($begin, $interval, $end);

	    $range = [];
	    foreach ($dateRange as $date) {
	        $range[] = $date->format($format);
	    }
		array_push($range,$endDate);
	    return $range;
	}
		$cat_rows = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."apt_staff_holiday_table WHERE staff_id ='$staff_id'");

		$c=array();
		foreach ($cat_rows as $val) {
			if($val->type_of_leaves=="Single") {
				$c[] = $val->single_leave;
			}
		}
		$i=1;
		$d=array();
		$xyz = '';
		foreach ($cat_rows as $value) {
			if($value->type_of_leaves=="Multiple") {
				$xyz_temp = implode(",",createDateRange($value->multiple_leaves_start, $value->multiple_leaves_end));
				if($i>1){
					$xyz .= ",".$xyz_temp;
				}
				else{
					$xyz .= $xyz_temp;
				}
				$i++;
			}
		}	
		$multiple_date = explode(",",$xyz);
		$total_leave_dates = array_merge($c,$multiple_date);
		
		
//STAFF PARTICULAR DAY OFF		
if($weekday !== $sunday_off && $weekday !== $monday_off && $weekday !== $tuesday_off && $weekday !== $wednesday_off && $weekday !== $thursday_off && $weekday !== $friday_off && $weekday !== $saturday_off && !in_array($appointment_date_saved,$total_leave_dates)){  ?>
	<div class="ap-steps">
		<div class="col-md-12 col-sm-12 ap-steps">
			<div class="col-md-2 col-sm-2 ap-step1 services complete">
				<label><?php _e('Services',WL_A_P_SYSTEM); ?></label>
				<span></span>
			</div>
			<div class="col-md-2 col-sm-2 ap-step2 time active">
				<label><?php _e('Time',WL_A_P_SYSTEM); ?></label>
				<span></span>
			</div>
			<div class="col-md-2 col-sm-2 ap-step3 time">
				<label><?php _e('Details',WL_A_P_SYSTEM); ?></label>
				<span></span>
			</div>
			<div class="col-md-2 col-sm-2 ap-step4 Details">
				<label><?php _e('Confirm',WL_A_P_SYSTEM); ?> </label>
				<span></span>
			</div>
			<?php $settings_accept_payment = get_option("weblizar_aps_payment_setting"); 
				$accept_payment	= $settings_accept_payment['accept_payment'];
		 
				if($accept_payment=="yes") {	?>
				<div class="col-md-2 col-sm-2 ap-step5 payment">
					<label><?php _e('Payment',WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
			<?php } ?>
			<div class="col-md-2 col-sm-2 ap-step6 done">
				<label><?php _e('Done',WL_A_P_SYSTEM); ?></label>
				<span></span>
			</div>
		</div>
	</div>
	<form style="margin-bottom: 0;" action="" method="POST" id="appoint_time" name="appoint_time">
		<input type="hidden" class="ap_location_id" name="ap_location_id" id="ap_location_id" value="<?php echo $ap_location_id; ?>" />
		<div id="2" class="ap-steps-detail1">
			<p>
			<span><?php _e('Available time slots for',WL_A_P_SYSTEM); ?>&nbsp;</span><span class="service_tag">
			<?php  
			$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
			foreach($service_details as $service_detail){	
				$service_name=$service_detail->name;
				$service_duration=$service_detail->duration;
				$service_p_before=$service_detail->p_before;
				$service_p_after=$service_detail->p_after;
				
				$service_duration_with_padding = $service_duration + $service_p_before;
				
				
				$settings_service_duration_type = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT service_duration_type from $settings_table" ); 
				$service_duration_type	= $settings_service_duration_type['service_duration_type'];
				if($service_duration_type=='sd'){
				
					echo $service_name;
					echo '&nbsp;('.$service_duration.'&nbsp;minutes)&nbsp;';
				
				}else{
					echo $service_name;
					echo '&nbsp;('.$service_duration_with_padding.'&nbsp;minutes)';
				}	
			  } 
			?>
			</span><span><?php _e('by',WL_A_P_SYSTEM); ?>&nbsp;</span>
											
			<span class="staff_tag"><?php  echo $staff_member_name;  ?></span>
			<?php
			$date_format = get_option( 'date_format' );
			
			$appt_date_format=date($date_format, strtotime($appointment_date)); 
			?>
			<span>&nbsp;<?php _e('on',WL_A_P_SYSTEM); ?>&nbsp;</span><span class="date_tag"><?php echo $appt_date_format ; ?></span>
		</p>
			<input type="hidden" id="appt_date_format" name="appt_date_format" value="<?php echo $appt_date_format ; ?>">
			<div class="service-form">
				<div class="swiper-container home-timing">
					<div class="swiper-wrapper ">
						<div class="swiper-slide">
							<div class="step-time">
								<div class="aps-date">
									<label id="date_01" class="tm-value" ><?php echo $selected_date= $_REQUEST['date_label'] ; ?></label>
								</div>
								<ul class="stp-duration">
								<div class="row justify-content-md-center">							
								<?php	//BUSINESS HOURS FOR SELECTED DAY (START AND END SLOT)
								$AppointmentDate = date("Y-m-d", strtotime($_REQUEST['apt_dates']));
								$weekday = date('l', strtotime($AppointmentDate));
								if($weekday=="Sunday"){
									$settings_bh_sunday_st = $wpdb->get_col( "SELECT schedule_sunday from $staff_table where id='$staff_id'" );
									$sunday_time = unserialize($settings_bh_sunday_st[0]); 
									$sunday_start_time_staff=  $sunday_time[0]['start_time'];
									$sunday_end_time_staff= $sunday_time[0]['end_time'];
									
									$lunch_start_time_staff=  $sunday_time[0]['break_start'];
									$lunch_end_time_staff= $sunday_time[0]['break_end'];
										
									$biz_start_time = strtotime($sunday_start_time_staff);	
									$t20 = strtotime($sunday_end_time_staff);
									
										$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
										foreach($service_details as $service_detail){
											$service_duration= $service_detail->duration;
											$service_p_after= $service_detail->p_after;
											$service_p_before= $service_detail->p_before;
											
											$biz_end_time = $t20 - (60*($service_p_after)) + (60*5) - (60*($service_duration)) - (60*($service_p_before)); 												
										}
								}
								if($weekday=="Monday"){
									$settings_bh_monday_st = $wpdb->get_col( "SELECT schedule_monday from $staff_table where id='$staff_id'" );
									$monday_time = unserialize($settings_bh_monday_st[0]); 
									$monday_start_time_staff=  $monday_time[0]['start_time'];
									$monday_end_time_staff= $monday_time[0]['end_time'];
									
									$lunch_start_time_staff=  $monday_time[0]['break_start'];
									$lunch_end_time_staff= $monday_time[0]['break_end'];
									
									$biz_start_time = strtotime($monday_start_time_staff);			
									$t20 = strtotime($monday_end_time_staff);
									
										$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
										foreach($service_details as $service_detail){
											$service_duration= $service_detail->duration;
											$service_p_after= $service_detail->p_after;
											$service_p_before= $service_detail->p_before;
											
											$biz_end_time = $t20 - (60*($service_p_after)) + (60*5) - (60*($service_duration)) - (60*($service_p_before)); 												
										}
								}
								if($weekday=="Tuesday"){
									$settings_bh_tuesday_st = $wpdb->get_col( "SELECT schedule_tuesday from $staff_table where id='$staff_id'" );
									$tuesday_time = unserialize($settings_bh_tuesday_st[0]); 
									$tuesday_start_time_staff=  $tuesday_time[0]['start_time'];
									$tuesday_end_time_staff= $tuesday_time[0]['end_time'];
									
									$lunch_start_time_staff=  $tuesday_time[0]['break_start'];
									$lunch_end_time_staff= $tuesday_time[0]['break_end'];
										
									$biz_start_time = strtotime($tuesday_start_time_staff);		
									$t20 = strtotime($tuesday_end_time_staff);
									
										$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
										foreach($service_details as $service_detail){
											$service_duration= $service_detail->duration;
											$service_p_after= $service_detail->p_after;
											$service_p_before= $service_detail->p_before;
											
											$biz_end_time = $t20 - (60*($service_p_after)) + (60*5) - (60*($service_duration)) - (60*($service_p_before)); 	 											
										}									
								}
								if($weekday=="Wednesday"){
									$settings_bh_wednesday_st = $wpdb->get_col( "SELECT schedule_wednesday from $staff_table where id='$staff_id'" );
									$wednesday_time = unserialize($settings_bh_wednesday_st[0]); 
									$wednesday_start_time_staff=  $wednesday_time[0]['start_time'];
									$wednesday_end_time_staff= $wednesday_time[0]['end_time'];
									
									$lunch_start_time_staff=  $wednesday_time[0]['break_start'];
									$lunch_end_time_staff= $wednesday_time[0]['break_end'];
									
									$biz_start_time = strtotime($wednesday_start_time_staff);
									$t20 = strtotime($wednesday_end_time_staff);
									
										$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
										foreach($service_details as $service_detail){
											$service_duration= $service_detail->duration;
											$service_p_after= $service_detail->p_after;
											$service_p_before= $service_detail->p_before;
											
											$biz_end_time = $t20 - (60*($service_p_after)) + (60*5) - (60*($service_duration)) - (60*($service_p_before)); 												
										}
								}
								if($weekday=="Thursday"){
									$settings_bh_thursday_st = $wpdb->get_col( "SELECT schedule_thursday from $staff_table where id='$staff_id'" );	
									$thursday_time = unserialize($settings_bh_thursday_st[0]); 
									$thursday_start_time_staff=  $thursday_time[0]['start_time'];
									$thursday_end_time_staff= $thursday_time[0]['end_time'];
											
									$lunch_start_time_staff=  $thursday_time[0]['break_start'];
									$lunch_end_time_staff= $thursday_time[0]['break_end'];
											
									$biz_start_time = strtotime($thursday_start_time_staff);
									$t20 = strtotime($thursday_end_time_staff);
									
										$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
										foreach($service_details as $service_detail){
											$service_duration= $service_detail->duration;
											$service_p_after= $service_detail->p_after;
											$service_p_before= $service_detail->p_before;
											
											$biz_end_time = $t20 - (60*($service_p_after)) + (60*5) - (60*($service_duration)) - (60*($service_p_before)); 											
										}
								}
								if($weekday=="Friday"){
									$settings_bh_friday_st = $wpdb->get_col( "SELECT schedule_friday from $staff_table where id='$staff_id'" );
									$friday_time = unserialize($settings_bh_friday_st[0]); 
									$friday_start_time_staff=  $friday_time[0]['start_time'];
									$friday_end_time_staff= $friday_time[0]['end_time'];
									
									$lunch_start_time_staff=  $friday_time[0]['break_start'];
									$lunch_end_time_staff= $friday_time[0]['break_end'];
									
									$biz_start_time = strtotime($friday_start_time_staff);	
									$t20 = strtotime($friday_end_time_staff);
									
										$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
										foreach($service_details as $service_detail){
											$service_duration= $service_detail->duration;
											$service_p_after= $service_detail->p_after;
											$service_p_before= $service_detail->p_before;
											
											$biz_end_time = $t20 - (60*($service_p_after)) + (60*5) - (60*($service_duration)) - (60*($service_p_before)); 	 											
										}
								}
								if($weekday=="Saturday"){
									$settings_bh_saturday_st = $wpdb->get_col( "SELECT schedule_saturday from $staff_table where id='$staff_id'" );
									$saturday_time = unserialize($settings_bh_saturday_st[0]); 
									$saturday_start_time_staff=  $saturday_time[0]['start_time'];
									$saturday_end_time_staff= $saturday_time[0]['end_time'];
									
									$lunch_start_time_staff=  $saturday_time[0]['break_start'];
									$lunch_end_time_staff= $saturday_time[0]['break_end'];
								
									$biz_start_time = strtotime($saturday_start_time_staff);	
									$t20 = strtotime($saturday_end_time_staff);
									
										$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
										foreach($service_details as $service_detail){
											$service_duration= $service_detail->duration;
											$service_p_after= $service_detail->p_after;
											$service_p_before= $service_detail->p_before;
											
											$biz_end_time = $t20  - (60*($service_p_after))  + (60*5) - (60*($service_duration)) - (60*($service_p_before)); 	 											
										}
								}
																	
								$settings_appt_status = get_option('weblizar_aps_general_setting');  
								$appt_status	= $settings_appt_status['appt_status']; //pending/aaproved

								$settings_appt_status_pending = get_option('weblizar_aps_general_setting'); 
								$appt_status_pending	= $settings_appt_status_pending['appt_status_pending']; //pending/aaproved
								 
										
								//DISABLED SLOTS ARRAY
								$disabled_slots = array();    
									
								//DISABLE PREVIOUS BOOKED TIME SLOTS	
									if($appt_status_pending == "yes"){
										$booked_appointments = $wpdb->get_results("SELECT * FROM $appointments_table where (status = 'approved' or status = 'pending') and staff_member = '$staff_id'");	
									}
									else if($appt_status_pending == "no"){
										$booked_appointments = $wpdb->get_results("SELECT * FROM $appointments_table where status='approved' and staff_member = '$staff_id'");		
									}
									foreach($booked_appointments as $single_booked_appointment){	
										$appt_repeat_value= $single_booked_appointment->repeat_appointment;
											if($appt_repeat_value=="Non" || $appt_repeat_value==""){
												$booked_appt_date= $single_booked_appointment->booking_date; 
												$appt_date = date("Y-m-d", strtotime($appointment_date));
													if($appt_date==$booked_appt_date){
											
														$appt_start_time= $single_booked_appointment->start_time; 
														$appt_end_time= $single_booked_appointment->end_time;
														
														$temp_start_time = strtotime($appt_start_time);
														$temp_end_time = strtotime($appt_end_time);
														
														$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
														foreach($service_details as $service_detail){
															$service_duration= $service_detail->duration;
															$service_p_after= $service_detail->p_after;
															$service_p_before= $service_detail->p_before;
															
															//INTERSECT B4_PADDING TIME(FOR NEXT APPT), DURATION, B4_PADDING TIME(FOR CURRENT APPT), AFTER_PADDING TIME
															$appointment_start_time = $temp_start_time  + (60*5) - (60*($service_duration)) - (60*($service_p_before)) - (60*($service_p_after)); 
															
															$appointment_end_time = $temp_end_time - (60*5) + (60*($service_p_before)) +   (60*($service_p_after));  ;									
														}
														while ($appointment_start_time <= $appointment_end_time) {
															$appointment_start_time = $appointment_start_time + (60*5) ;
															$slots_view = $appointment_start_time - (60*5);
															$booked_slots= date(" H:i", $slots_view);
															$temp_appt_booked_time_slots[] = $booked_slots;
														}
														foreach($temp_appt_booked_time_slots as $temp_appt_booked_single_time_slot){
															$appt_booked_time_slots= substr($temp_appt_booked_single_time_slot, 1); 
															array_push($disabled_slots,$appt_booked_time_slots );
														}
													}
											}		

											$daily_appts = array();
											if($appt_repeat_value=="daily" ){
												$re_days=$single_booked_appointment->re_days;
													for($i=0;$i<=$re_days;$i++){
													$date_format=date("'m/d/Y", strtotime('+'.$i.'days', strtotime($single_booked_appointment->booking_date))); 
													$daily_off= substr($date_format, 1); 
													array_push($daily_appts,$daily_off);
												}
												
												if (in_array($appointment_date, $daily_appts)){
													$appt_daily_st= $single_booked_appointment->start_time; 
													$appt_daily_et= $single_booked_appointment->end_time;
																	 
															$temp_appt_start_time = strtotime($appt_daily_st);
															$temp_appt_end_time = strtotime($appt_daily_et);
															foreach($service_details as $service_detail){
																$service_duration= $service_detail->duration;
																$service_p_after= $service_detail->p_after;
																$service_p_before= $service_detail->p_before;
																$appt_start_time = $temp_appt_start_time + (60*5)   - (60*($service_duration))  - (60*($service_p_before)) - (60*($service_p_after)); 
																$appt_end_time = $temp_appt_end_time - (60*5) +  (60*($service_p_before))  + (60*($service_p_after));
															}
															
															
															while ($appt_start_time <= $appt_end_time) {
																$appt_start_time = $appt_start_time + (60*5) ;
																$appt_daily_off_schedule = $appt_start_time - (60*5);
																			
																$daily_appt_off= date(" H:i", $appt_daily_off_schedule);
																$temp_appt_offs[] = $daily_appt_off;
															}
															foreach($temp_appt_offs as $temp_appt_off){
																$appt_daily_off= substr($temp_appt_off, 1); 
																array_push($disabled_slots,$appt_daily_off );
															}
												}
											}
											
											$weekly_appts = array();
											if($appt_repeat_value=="weekly" ){
												$re_weeks=$single_booked_appointment->re_weeks;
													for($i=0;$i<=$re_weeks;$i++){
													$date_format=date("'m/d/Y", strtotime('+'.$i.'week', strtotime($single_booked_appointment->booking_date))); 
													$weekly_off= substr($date_format, 1); 
													array_push($weekly_appts,$weekly_off);
												}
												if (in_array($appointment_date, $weekly_appts)){
													$appt_weekly_st= $single_booked_appointment->start_time; 
													$appt_weekly_et= $single_booked_appointment->end_time;
																	 
													$temp_appt_start_time = strtotime($appt_weekly_st);
													$temp_appt_end_time = strtotime($appt_weekly_et);
													foreach($service_details as $service_detail){
														$service_duration= $service_detail->duration;
														$service_p_after= $service_detail->p_after;
														$service_p_before= $service_detail->p_before;
														$appt_start_time = $temp_appt_start_time + (60*5)  - (60*($service_duration))  - (60*($service_p_before)) - (60*($service_p_after)); 
														$appt_end_time = $temp_appt_end_time - (60*5) +  (60*($service_p_before))  + (60*($service_p_after));
													}
															
													while ($appt_start_time <= $appt_end_time) {
														$appt_start_time = $appt_start_time + (60*5) ;
														$appt_weekly_off_schedule = $appt_start_time - (60*5);
																	
														$weekly_appt_off= date(" H:i", $appt_weekly_off_schedule);
														$temp_appt_offs[] = $weekly_appt_off;
													}
													foreach($temp_appt_offs as $temp_appt_off){
														$appt_weekly_off= substr($temp_appt_off, 1); 
														array_push($disabled_slots,$appt_weekly_off );
													}
												}
											}
											
											$monthly_appts = array();
											if($appt_repeat_value=="monthly" ){
												$re_months=$single_booked_appointment->re_months;
													for($i=0;$i<=$re_months;$i++){
													$date_format=date("'m/d/Y", strtotime('+'.$i.'months', strtotime($single_booked_appointment->booking_date))); 
													$monthly_off= substr($date_format, 1); 
													array_push($monthly_appts,$monthly_off);
												}
												if (in_array($appointment_date, $monthly_appts)){
													$appt_monthly_st= $single_booked_appointment->start_time; 
													$appt_monthly_et= $single_booked_appointment->end_time;
																	 
													$temp_appt_start_time = strtotime($appt_monthly_st);
													$temp_appt_end_time = strtotime($appt_monthly_et);
													foreach($service_details as $service_detail){
														$service_duration= $service_detail->duration;
														$service_p_after= $service_detail->p_after;
														$service_p_before= $service_detail->p_before;
														$appt_start_time = $temp_appt_start_time + (60*5)  - (60*($service_duration))  - (60*($service_p_before)) - (60*($service_p_after)); 
														$appt_end_time = $temp_appt_end_time - (60*5) +  (60*($service_p_before))  + (60*($service_p_after));
													}
													
													while ($appt_start_time <= $appt_end_time) {
														$appt_start_time = $appt_start_time + (60*5) ;
														$appt_monthly_off_schedule = $appt_start_time - (60*5);
																	
														$monthly_appt_off= date(" H:i", $appt_monthly_off_schedule);
														$temp_appt_offs[] = $monthly_appt_off;
													}
													foreach($temp_appt_offs as $temp_appt_off){
														$appt_monthly_off= substr($temp_appt_off, 1); 
														array_push($disabled_slots,$appt_monthly_off );
													}
												}
											}
											
											
											if($appt_repeat_value=="PD" ){
												$appt_start_date= $single_booked_appointment->re_start_date; 
												$appt_end_date= $single_booked_appointment->re_end_date;
												
												function appt_pd_off($start, $end, $format = 'm/d/Y') {
													$array = array();
													$interval = new DateInterval('P1D');

													$realEnd = new DateTime($end);
													$realEnd->add($interval);
													$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

													foreach($period as $date) { 
														$array[] = $date->format($format); 
													}
													return $array;
												}
												// Call the function
												$appt_date_range = appt_pd_off($appt_start_date, $appt_end_date);


												if (in_array($appointment_date, $appt_date_range)){
													$appt_monthly_st= $single_booked_appointment->start_time; 
													$appt_monthly_et= $single_booked_appointment->end_time;
																	 
													$temp_appt_start_time = strtotime($appt_monthly_st);
													$temp_appt_end_time = strtotime($appt_monthly_et);
													foreach($service_details as $service_detail){
														$service_duration= $service_detail->duration;
														$service_p_after= $service_detail->p_after;
														$service_p_before= $service_detail->p_before;
														$appt_start_time = $temp_appt_start_time + (60*5)  - (60*($service_duration))  - (60*($service_p_before)) - (60*($service_p_after)); 
														$appt_end_time = $temp_appt_end_time - (60*5) +  (60*($service_p_before))  + (60*($service_p_after));
													}
															
													while ($appt_start_time <= $appt_end_time) {
														$appt_start_time = $appt_start_time + (60*5) ;
														$appt_pd_off_schedule = $appt_start_time - (60*5);
																			
														$pd_appt_off= date(" H:i", $appt_pd_off_schedule);
														$temp_appt_offs[] = $pd_appt_off;
													}
													foreach($temp_appt_offs as $temp_appt_off){
														$appt_particular_dayz_off= substr($temp_appt_off, 1); 
														array_push($disabled_slots,$appt_particular_dayz_off );
													}
												}

											}
										}
										
										
									//DISABLE LUNCH TIME SLOTS	
										$temp_lunch_st_time = strtotime($lunch_start_time_staff);
										$temp_lunch_end_time = strtotime($lunch_end_time_staff);
										
										$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
										foreach($service_details as $service_detail){
											$service_duration= $service_detail->duration;
											$service_p_after= $service_detail->p_after;
											$service_p_before= $service_detail->p_before;
											$lunch_start_time = $temp_lunch_st_time + (60*5)  - (60*($service_duration)) - (60*($service_p_after)) - (60*($service_p_before)); 
										}
														
										$lunch_end_time = $temp_lunch_end_time -  (60*5);
														

										while ($lunch_start_time <= $lunch_end_time) {
											$lunch_start_time = $lunch_start_time + (60*5);
											$slots_view = $lunch_start_time - (60*5);
											$lunch_slots= date(" H:i", $slots_view);
											$multiple_lunch_off[] = $lunch_slots;
										}
										foreach($multiple_lunch_off as $single_lunch_off){
											$lunch_off= substr($single_lunch_off, 1); 
											array_push($disabled_slots,$lunch_off );
										}	
														
									//DISABLE  HOLIDAY TIME SLOTS	
									$multiple_holidays = $wpdb->get_results("SELECT * FROM $holidays_table where all_off='0'");
										
										foreach($multiple_holidays as $single_holiday){
											$holiday_all_off= $single_holiday->all_off; 
											if($holiday_all_off=="0"){
												$holiday_repeat_value= $single_holiday->repeat_value;
												if($holiday_repeat_value=="no"){
													$holiday_date= $single_holiday->holiday_date; 
													
													if($appointment_date==$holiday_date){
														$holiday_start_date= $single_holiday->start_time; 
														$holiday_end_date= $single_holiday->end_time;
														 
														$temp_start_time = strtotime($holiday_start_date);
														$temp_end_time = strtotime($holiday_end_date);
														$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
														foreach($service_details as $service_detail){
															$service_duration= $service_detail->duration;
															$service_p_after= $service_detail->p_after;
															$service_p_before= $service_detail->p_before;
															$no_repeat_holiday_st = $temp_start_time - (60*($service_duration)) + (60*5) - (60*($service_p_before)) - (60*($service_p_after)) ; 
														}
														
														$no_repeat_holiday_et = $temp_end_time - (60*5)  ;
														
														while ($no_repeat_holiday_st <= $no_repeat_holiday_et) {
															$no_repeat_holiday_st = $no_repeat_holiday_st + (60*5) ;
															$today_holiday_off_slots = $no_repeat_holiday_st - (60*5);
															$no_repeat_holidays= date(" H:i", $today_holiday_off_slots);
															$temp_holiday_off_no_repeats[] = $no_repeat_holidays;
														}
														foreach($temp_holiday_off_no_repeats as $temp_holiday_off_no_repeat){
															$holiday_off_no_repeat= substr($temp_holiday_off_no_repeat, 1); 
															array_push($disabled_slots,$holiday_off_no_repeat );
														}
													}
												}
												
												if($holiday_repeat_value=="p_d"){
														
													$holiday_start_date= $single_holiday->start_date; 
													$holiday_end_date= $single_holiday->end_date;
															
													function holiday_pd_off($start, $end, $format = 'm/d/Y') {
														$array = array();
														$interval = new DateInterval('P1D');

														$realEnd = new DateTime($end);
														$realEnd->add($interval);
														$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

														foreach($period as $date) { 
															$array[] = $date->format($format); 
														}
														return $array;
													}
														// Call the function
														$date_period = holiday_pd_off($holiday_start_date, $holiday_end_date); 
															
													if (in_array($appointment_date, $date_period)){
														$holiday_start_time= $single_holiday->start_time; 
														$holiday_end_time= $single_holiday->end_time;
																	 
														$temp_holiday_start_time = strtotime($holiday_start_time);
														$temp_end_time = strtotime($holiday_end_time);
														foreach($service_details as $service_detail){
															$service_duration= $service_detail->duration;
															$service_p_after= $service_detail->p_after;
															$service_p_before= $service_detail->p_before;
															$pd_holiday_st = $temp_holiday_start_time - (60*($service_duration)) + (60*5) - (60*($service_p_before)) - (60*($service_p_after)); 
														}
															
														$pd_holiday_et = $temp_end_time - (60*5) ;
														while ($pd_holiday_st <= $pd_holiday_et) {
															$pd_holiday_st = $pd_holiday_st + (60*5) ;
															$pd_holiday_off_slots = $pd_holiday_st - (60*5);
																			
															$pd_holiday_off= date(" H:i", $pd_holiday_off_slots);
															$temp_holiday_time_slots[] = $pd_holiday_off;
														}
														foreach($temp_holiday_time_slots as $temp_holiday_time_slot){
															$holiday_off_pd= substr($temp_holiday_time_slot, 1); 
															array_push($disabled_slots,$holiday_off_pd );
														}
													}
												
												}
												if($holiday_repeat_value=="daily"){
													
													$holiday_start_date=date("m/d/Y", strtotime($single_holiday->holiday_date));  
													$add_days=$single_holiday->repeat_days;
													$holiday_end_date = date('m/d/Y',strtotime($holiday_start_date) + (24*3600*$add_days)); 
													
													function holiday_daily_off($start, $end, $format = 'm/d/Y') {
														$array = array();
														$interval = new DateInterval('P1D');

														$realEnd = new DateTime($end);
														$realEnd->add($interval);

														$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

														foreach($period as $date) { 
															$array[] = $date->format($format); 
														}
														return $array;
													}
													$date_range = holiday_daily_off($holiday_start_date, $holiday_end_date);
													
													if (in_array($appointment_date, $date_range)){
														$holiday_start_time= $single_holiday->start_time; 
														$holiday_end_time= $single_holiday->end_time;
																	 
														$temp_holiday_start_time = strtotime($holiday_start_time);
														$temp_end_time = strtotime($holiday_end_time);
															
														foreach($service_details as $service_detail){
															$service_duration= $service_detail->duration;
															$service_p_after= $service_detail->p_after;
															$service_p_before= $service_detail->p_before;
															$daily_holiday_st = $temp_holiday_start_time - (60*($service_duration)) + (60*5) - (60*($service_p_before)) - (60*($service_p_after)); 
														}
														$daily_holiday_et = $temp_end_time - (60*5) ;
															
														while ($daily_holiday_st <= $daily_holiday_et) {
															$daily_holiday_st = $daily_holiday_st + (60*5) ;
															$daily_holiday_off_slots = $daily_holiday_st - (60*5);
																			
															$daily_holiday_off= date(" H:i", $daily_holiday_off_slots);
															$temp_holiday_time_slots[] = $daily_holiday_off;
														}
														foreach($temp_holiday_time_slots as $temp_holiday_time_slot){
															$holiday_off_daily= substr($temp_holiday_time_slot, 1); 
															array_push($disabled_slots,$holiday_off_daily );
														}
													}
												}
												
												if($holiday_repeat_value=="weekly"){
													
													$weekz=$single_holiday->repeat_weeks;
													$holiday_start_date= $single_holiday->holiday_date;
													$holiday_end_date =  date('m/d/Y',strtotime('+'.$weekz.' weeks', strtotime($holiday_start_date))); 
													function holiday_week_off($start, $end, $format = 'm/d/Y') {
														$array = array();
														$interval = new DateInterval('P7D');

														$realEnd = new DateTime($end);
														$realEnd->add($interval);

														$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

														foreach($period as $date) { 
															$array[] = $date->format($format); 
														}
														return $array;
													}
													  $weekly_off = holiday_week_off($holiday_start_date, $holiday_end_date);
													  
													  if (in_array($appointment_date, $weekly_off)){
															$holiday_start_time= $single_holiday->start_time; 
															$holiday_end_time= $single_holiday->end_time;
																	 
															$temp_holiday_start_time = strtotime($holiday_start_time);
															$temp_end_time = strtotime($holiday_end_time);
															foreach($service_details as $service_detail){
																$service_duration= $service_detail->duration;
																$service_p_after= $service_detail->p_after;
																$service_p_before= $service_detail->p_before;
																$weekly_holiday_st = $temp_holiday_start_time - (60*($service_duration)) + (60*5) - (60*($service_p_before)) - (60*($service_p_after)); 
															}
															
															$weekly_holiday_et = $temp_end_time - (60*5) ;
															
															while ($weekly_holiday_st <= $weekly_holiday_et) {
																$weekly_holiday_st = $weekly_holiday_st + (60*5) ;
																$weekly_holiday_off_slots = $weekly_holiday_st - (60*5);
																			
																$weekly_holiday_off= date(" H:i", $weekly_holiday_off_slots);
																$temp_holiday_time_slots[] = $weekly_holiday_off;
															}
															foreach($temp_holiday_time_slots as $temp_holiday_time_slot){
																$holiday_off_weekly= substr($temp_holiday_time_slot, 1); 
																array_push($disabled_slots,$holiday_off_weekly );
															}
													}
												}
												if($holiday_repeat_value=="bi_weekly"){
													
														$temp_weekz=$single_holiday->repeat_bi_weeks;
														$weekz= $temp_weekz + 1;
														$holiday_start_date= $single_holiday->holiday_date;
														$holiday_end_date =  date('m/d/Y',strtotime('+'.$weekz.' weeks', strtotime($holiday_start_date))); 
														
														
															function holiday_bi_weekly($start, $end, $format = 'm/d/Y') {
																$array = array();
																$interval = new DateInterval('P14D');

																$realEnd = new DateTime($end);
																$realEnd->add($interval);

																$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

																foreach($period as $date) { 
																	$array[] = $date->format($format); 
																}
																return $array;
															}
														$bi_weekly = holiday_bi_weekly($holiday_start_date, $holiday_end_date);
														
														if (in_array($appointment_date, $bi_weekly)){
															$holiday_start_time= $single_holiday->start_time; 
															$holiday_end_time= $single_holiday->end_time;
																	 
															$temp_holiday_start_time = strtotime($holiday_start_time);
															$temp_end_time = strtotime($holiday_end_time);
															foreach($service_details as $service_detail){
																$service_duration= $service_detail->duration;
																$service_p_after= $service_detail->p_after;
																$service_p_before= $service_detail->p_before;
																$bi_weekly_holiday_st = $temp_holiday_start_time - (60*($service_duration)) + (60*5) - (60*($service_p_before)) - (60*($service_p_after)); 
															}
															
															
															$bi_weekly_holiday_et = $temp_end_time - (60*5) ;
															
															while ($bi_weekly_holiday_st <= $bi_weekly_holiday_et) {
																$bi_weekly_holiday_st = $bi_weekly_holiday_st + (60*5) ;
																$bi_weekly_holiday_off = $bi_weekly_holiday_st - (60*5);
																			
																$bi_weekly_holiday= date(" H:i", $bi_weekly_holiday_off);
																$temp_holiday_time_slots[] = $bi_weekly_holiday;
															}
															foreach($temp_holiday_time_slots as $temp_holiday_time_slot){
																$holiday_bi_weekly_off= substr($temp_holiday_time_slot, 1); 
																array_push($disabled_slots,$holiday_bi_weekly_off );
															}
														}
												}
												$monthly_holidays = array();
												if($holiday_repeat_value=="monthly"){
														$months=$single_holiday->repeat_month;
														for($i=0;$i<=$months;$i++)
													 {
														   $date_format=date("'m/d/Y", strtotime('+'.$i.'months', strtotime($single_holiday->holiday_date))); 
															$monthly_off= substr($date_format, 1); 
															array_push($monthly_holidays,$monthly_off);
													}
														if (in_array($appointment_date, $monthly_holidays)){
																 $holiday_start_time= $single_holiday->start_time; 
																 $holiday_end_time= $single_holiday->end_time;
																		 
																$temp_holiday_start_time = strtotime($holiday_start_time);
																$temp_end_time = strtotime($holiday_end_time);
																foreach($service_details as $service_detail){
																	$service_duration= $service_detail->duration;
																	$service_p_after= $service_detail->p_after;
																	$service_p_before= $service_detail->p_before;
																	$monthly_holiday_st = $temp_holiday_start_time - (60*($service_duration)) + (60*5) - (60*($service_p_before)) - (60*($service_p_after)); 
																}
																$monthly_holiday_et = $temp_end_time - (60*5) ;
																
																while ($monthly_holiday_st <= $monthly_holiday_et) {
																	$monthly_holiday_st = $monthly_holiday_st + (60*5) ;
																	$monthly_holiday_off = $monthly_holiday_st - (60*5);
																				
																	$monthly_holiday= date(" H:i", $monthly_holiday_off);
																	$temp_holiday_time_slots[] = $monthly_holiday;
																}
																foreach($temp_holiday_time_slots as $temp_holiday_time_slot){
																	 $holiday_monthly_off= substr($temp_holiday_time_slot, 1); 
																	array_push($disabled_slots,$holiday_monthly_off );
																}
															}
												}
												
											}	
										}
										
								//TOTAL TIME SLOTS
										if($time_slots=="service_slots"){
											$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service_id'");
											foreach($service_details as $service_detail){
												$service_duration= $service_detail->duration;
													for( $i = $biz_start_time; $i < $biz_end_time; $i += (60*($service_duration))) 
												{
													$total_time_slots[] = date('H:i', $i);
												}
																								
											}
										}else{
													for( $i = $biz_start_time; $i < $biz_end_time; $i += (60*($custom_slot))){
														$total_time_slots[] = date('H:i', $i);
													}
										}
										
									//DISABLE PREVIOUS TIME SLOTS FOR CURRENT DATE	
											if($appointment_date == $current_date){
													
													$temp_end_slot_time=	date(" H:i", $biz_end_time);
													$end_slot_time= substr($temp_end_slot_time, 1); 
													//print_r($available_slots);
													if($current_time < $end_slot_time){
														$slots= array_filter($total_time_slots, function ($x) use ($current_time) { return $x > $current_time; });
														$available_slots = array_diff($slots, $disabled_slots);
														
														if($available_slots ==""){
															$time_slots_available = $slots;	
														}else{
															$time_slots_available = $available_slots;
														}
															
														foreach ($time_slots_available as $slot ) {
															$time_format = get_option( 'time_format' ); 
															$temp_time_slot_format = strtotime($slot);
															$time_slot_format=	date($time_format, $temp_time_slot_format);
														?>
															<li id="ap_slots" class="col-md-3 col-xs-6"><input class="radio_button" title="<?php echo $time_slot_format; ?>" value="<?php echo $slot; ?>" id="radio<?php echo $slot; ?>" type="radio" name="ap_time" /><label for="radio<?php echo $slot; ?>" id="tm-value" class="tm-value"><span id="time_value<?php echo $slot; ?>"></span> <?php echo $time_slot_format; ?></label></li>
															<?php	
														} 
													
													}else{
														echo "<center><?php _e('Business Hours Closed For Today. Please Select Another Date.',WL_A_P_SYSTEM); ?></center><br><center><?php _e('Thank You',WL_A_P_SYSTEM); ?></center>"; 
													}
											}
									//DISABLE PREVIOUS TIME SLOTS FOR OTHER DAYS
											else{
												$available_slots = array_diff($total_time_slots, $disabled_slots);
												//print_r($available_slots);
												foreach ($available_slots as $slot ) {
													
														$time_format = get_option( 'time_format' ); 
														$temp_time_slot_format = strtotime($slot);
														
														$time_slot_format=	date($time_format, $temp_time_slot_format);
													?>
													<li id="ap_slots" class="col-md-3 col-xs-6">
														<input class="radio_button" title="<?php echo $time_slot_format; ?>"  value="<?php echo $slot; ?>" id="radio<?php echo $slot; ?>" type="radio" name="ap_time" /><label for="radio<?php echo $slot; ?>" id="tm-value" class="tm-value"><span id="time_value<?php echo $slot; ?>"></span> <?php echo $time_slot_format; ?></label>
													</li>
	<?php	
												} 
											}	
											?>
											</div>					
										</ul>	
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php  $time_editor_content= get_option("time_tips");
						if (!empty($time_editor_content)) {	?>
							<div class="row step-description">
								<div> <?php echo "<pre class='pre_bg' style='display:block !important;'>".$time_editor_content."</pre>"; ?>  </div> 
							</div> <?php 
						} ?> 
				</div>
				<!-- Step 2 -->
				<div class="ap-step-link">
					<?php   $appearence_time_navigation_text_backward = $wpdb->get_col( "SELECT time_navigation_text_backward from $appearence_table" );
						$time_navigation_text_backward	= $appearence_time_navigation_text_backward[0]; 
											
						$appearence_time_navigation_text_forward= $wpdb->get_col( "SELECT time_navigation_text_forward from $appearence_table" );
						$time_navigation_text_forward	= $appearence_time_navigation_text_forward[0]; ?>
						
						<button id="stepback2" href="#step1" type="button"  onclick="return step2_back();" class="btn step-left"><?php if (!empty($time_navigation_text_backward)) { echo __("$time_navigation_text_backward",WL_A_P_SYSTEM); } else { _e("Back",WL_A_P_SYSTEM);  } ?></button> 
						<button id="stepnext2" type="button"  onclick="return step2_next();" class="btn step-right"><?php if (!empty($time_navigation_text_forward)) { echo __("$time_navigation_text_forward",WL_A_P_SYSTEM); } else {_e("Next",WL_A_P_SYSTEM); } ?></button> 
				</div>
			</form>
			<?php
		} 
		else{	?>
			<div class="ap-steps">
				<div class="col-md-12 col-sm-12 ap-steps">
					<div class="col-md-2 col-sm-2 ap-step1 services active">
						<label><?php _e('Services',WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
					<div class="col-md-2 col-sm-2 ap-step2 time ">
						<label><?php _e('Time',WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
					<div class="col-md-2 col-sm-2 ap-step3 time">
						<label><?php _e('Details',WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
					<div class="col-md-2 col-sm-2 ap-step4 Details">
						<label><?php _e('Confirm',WL_A_P_SYSTEM); ?> </label>
						<span></span>
					</div>
					<?php $settings_accept_payment = get_option("weblizar_aps_payment_setting"); 
						$accept_payment	= $settings_accept_payment['accept_payment'];
				 
						if($settings_accept_payment=="yes") {	?>
						<div class="col-md-2 col-sm-2 ap-step5 payment">
							<label><?php _e('Payment',WL_A_P_SYSTEM); ?></label>
							<span></span>
						</div>
					<?php } ?>
					<div class="col-md-2 col-sm-2 ap-step6 done">
						<label><?php _e('Done',WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
				</div>
			</div>
			
			<div  id="1" class="ap-steps-detail">
				<center><p id='staff_off_text'><?php echo $staff_member_name ."&nbsp;". __('is not Available on',WL_A_P_SYSTEM); echo "&nbsp;".$weekday ?>.</p></center><center><p id='staff_off_text'><?php _e('Thank You',WL_A_P_SYSTEM); ?></p></center>
				<?php 
				 $service_editor_content= get_option("service_tips");
				if (!empty($service_editor_content)) {	?>
					<div class="row step-description">
						<div> <?php echo "<pre class='pre_bg' style='display:block !important;'>".$service_editor_content."</pre>"; ?>  </div> 
					</div>
					<?php 
				} ?> 
			</div>
			<div class="ap-step-link">
				<a  href="<?php echo $current_url ; ?>" class="btn step-right"><?php _e('Try Another',WL_A_P_SYSTEM); ?></a>
			</div>
			<?php				
			 
		}
	}
	?>
	