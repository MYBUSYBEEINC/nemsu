<?php
//main file 
global $wpdb;
$appointment_staff_details = $wpdb->get_results( "select * from $wpdb->prefix"."apt_staff");
$apt_shortcode_service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services");
$appointment_category_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_category");
$appearence_table =	$wpdb->prefix."apt_appearence";
$staff_table =	$wpdb->prefix."apt_staff";
$settings_table =	$wpdb->prefix."apt_settings"; 
$general_settings = get_option('weblizar_aps_general_setting');
 
 // get all staff off days
$all_staffs_query = "SELECT * FROM `$staff_table`";
if($all_staffs = $wpdb->get_results($all_staffs_query)) {
   $all_staff_off_days = array();

   foreach ($all_staffs as $staff_key => $staff_val) {
       
       $staff_id = $staff_val->id;
       $all_staff_off_days[$staff_id] = array();
       
       $staff_monday_schedule = $staff_val->mon_all_off;
       if($staff_monday_schedule) {  array_push($all_staff_off_days[$staff_id], 1); }
              
       $staff_tuesday_schedule = $staff_val->tue_all_off;
       if($staff_tuesday_schedule) {  array_push($all_staff_off_days[$staff_id], 2); }
              
       $staff_wednesday_schedule = ($staff_val->wed_all_off);
       if($staff_wednesday_schedule) {  array_push($all_staff_off_days[$staff_id], 3); }
              
       $staff_thursday_schedule = ($staff_val->thu_all_off);
       if($staff_thursday_schedule) {  array_push($all_staff_off_days[$staff_id], 4); }
              
       $staff_friday_schedule = ($staff_val->fri_all_off);
       if($staff_friday_schedule) {  array_push($all_staff_off_days[$staff_id], 5); }
              
       $staff_saturday_schedule = ($staff_val->sat_all_off);
       if($staff_saturday_schedule) {  array_push($all_staff_off_days[$staff_id], 6); }
       
       $staff_sunday_schedule = ($staff_val->sun_all_off);
       if($staff_sunday_schedule) {  array_push($all_staff_off_days[$staff_id], 0); }     
 
   }
}
?>

<script>
//global variables
var appointment_username;
var appointment_date;
var appointment_service;
var appointment_staff;
var appointment_time;
var appointment_first_name;
var appointment_last_name;
var appointment_client_password;
var appointment_client_contact;
var appointment_client_email;
var appointment_skype_id;
var appointment_login_email;
var appointment_login_password;
var appointment_staff_email;
var appointment_id;
var appt_date_format;
var appt_time_format;
var appointment_service_amount;

jQuery(window).on('load', function() 
{
   jQuery("#ap_fornt_main_div").show();
   
});


jQuery( document ).ready(function() {
    jQuery(".ap_class_active").hide();
});
	  
	  
//STEP 1 NEXT
jQuery(document).on("click", '#step1_next', function (event) {
	appointment_date= jQuery('#apt_date').val();
	var date = new Date(appointment_date);
	
	day_01= date.setDate(date.getDate());
	date_001 = new Date(day_01);
	var selected_date = date_001.toString().substr(0, 15);
	
	
	appointment_service= jQuery('#groups').val();
	
	appointment_staff= jQuery('#sub_groups').val();
	
	var today_date = new Date();
	current_time = today_date.toString().substr(16,5);
	
		var current_date = new Date(appointment_date);
		var current_day = current_date.getDay();
	
	if(appointment_service=='default'){
		 jQuery.notify("<?php _e('Please Select Service',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		 jQuery('#service_name').focus();
		 document.getElementById("step1").style.opacity = "1";
		
	}
	else if(appointment_staff=='0'){
		jQuery.notify("<?php _e('Please Select Staff',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		jQuery('#staff_member').focus();
		document.getElementById("step1").style.opacity = "1";
		
	}
	else if(appointment_date==''){
		jQuery.notify("<?php _e('Please Select date',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		jQuery('#apt_date').focus();
		document.getElementById("step1").style.opacity = "1";
		
	}
	
	else{
		var current_url = jQuery(location).attr('href');
		
		jQuery('#img-thumbnail').removeClass('img-thumbnail ap-dashboard ap-front');
		jQuery('#img-thumbnail').addClass('img-thumbnail ap-dashboard');
		 
		jQuery("#step1_next").prop('disabled', true);
		jQuery('#step1_next').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Please Wait", WL_A_P_SYSTEM); ?>');
		 
		
		 jQuery.ajax({
			type : 'post',
			url : frontendajax.ajaxurl+'?action=time_ajax_request',  
			data :  'apt_dates='+ appointment_date  + '&service='+ appointment_service + '&staff_member='+ appointment_staff  + '&date_label='+ selected_date  + '&current_time='+ current_time + '&current_url='+ current_url, 
			success : function(data){
				jQuery("#step1_next").prop('disabled', false);
				jQuery('#step1_next').html('<?php _e("Next",WL_A_P_SYSTEM); ?>');
				jQuery('#form_02').html(data);
				jQuery('#step2').show();
				jQuery('#step1').hide();
				jQuery('#step3').hide();
				jQuery('#step4').hide();
				jQuery('#step5').hide();
				jQuery('#step6').hide();
			 }
		});
	 }
});
	
//STEP 2 NEXT
function step2_next(){
	var appt_date_format = jQuery('#appt_date_format').val();
	jQuery('.date_tag').text(appt_date_format);
	var checked_radio = jQuery('input[name=ap_time]:checked');
	var appointment_time = checked_radio.val();
	var appt_time_format = checked_radio.attr("title");
	jQuery('.time_tag').text(appt_time_format);
	<?php 
	$staff_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_staff");
	foreach($staff_details as $staff_detail){	
		$staff_id=$staff_detail->id; 
		$staff_name=$staff_detail->staff_member_name;
	?>
	if(appointment_staff=='<?php echo $staff_id;?>'){
		jQuery('.staff_tag').text('<?php echo $staff_name;?>');
	}
	<?php } 
	/*current user info*/
	if(is_user_logged_in()){
		$current_user_id = get_current_user_id();
	?>
		var current_id = <?php echo $current_user_id; ?>;
		if(jQuery('.radio_button').is(':checked')) {		
			document.getElementById("stepnext2").href="#step4";
			jQuery("#stepnext2").prop('disabled', true);
			jQuery('#stepnext2').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Please Wait", WL_A_P_SYSTEM); ?>');
			jQuery.ajax({
				type : 'post',
	            url : frontendajax.ajaxurl+'?action=login_ajax_request',  
	            data :  'current_id='+ current_id + '&staff='+ appointment_staff + '&service='+ appointment_service + '&booking_st='+ appointment_time + '&apt_date='+ appointment_date + '&apt_time_format='+ appt_time_format, 
	            success : function(data){
					jQuery('#step4').html(data);
					jQuery('#step4').show();
					jQuery('#step1').hide();
					jQuery('#step2').hide();
					jQuery('#step3').hide();
					jQuery('#step5').hide();
					jQuery('#step6').hide();
					// jQuery('#existing').hide();
					// jQuery('#new').hide();					
				}
	        });					
		}
		else{
			jQuery.notify("<?php _e('Please Select Appointment Time', WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		}
	<?php
	} //user logged in
	else{
		?>
		
		if(jQuery('.radio_button').is(':checked')) {
		
		document.getElementById("stepnext2").href="#step3";
			jQuery("#stepnext2").prop('disabled', true);
			jQuery('#stepnext2').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Please Wait", WL_A_P_SYSTEM); ?>');
			
			jQuery.ajax({
            	type : 'post',
            	url : frontendajax.ajaxurl+'?action=details_ajax_request',  
            	data :  'apt_time='+ appointment_time  + '&service='+ appointment_service + '&time_format='+ appt_time_format + '&staff_member='+ appointment_staff + '&apt_date='+ appointment_date , 
            	success : function(data){
	            	console.log(data);
					jQuery("#stepnext2").prop('disabled', false);
					jQuery('#stepnext2').html('<?php _e("Next", WL_A_P_SYSTEM); ?>');
				
					jQuery('#user_details').html(data);
						jQuery('#step3').show();
						jQuery('#step1').hide();
						jQuery('#step2').hide();
						jQuery('#step4').hide();
						jQuery('#step5').hide();
						jQuery('#step6').hide();
				 	 }
        		});
			
	}else{
		jQuery.notify("<?php _e('Please Select Appointment Time', WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
	}

	<?php		
	}
	?>
}
	 
//STEP 2 BACK
function step2_back(){
	jQuery('.stp-duration').empty();
	//	jQuery('form#step_01')[0].reset();
	 jQuery('#step1').show();
	 jQuery('#step2').hide();
	 jQuery('#step3').hide();
	 jQuery('#step4').hide();
	 jQuery('#step5').hide();
	 jQuery('#step6').hide();
	}	
	
//STEP 3 NEXT
function step3_next(){ 
	 var login_button = document.getElementById("appoint_login");
	 if (login_button.clicked == true) { 
	 }else{
		 jQuery.notify("<?php _e('Please Login To Your Account', WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
	 }
}   
//STEP 3 BACK 
function step3_back(){
	 jQuery('#step2').show();
	 jQuery('#step1').hide();
	 jQuery('#step3').hide();
	 jQuery('#step4').hide();
	 jQuery('#step5').hide();
	 jQuery('#step6').hide();
}	
	
//STEP 4 NEXT	
function step4_next(){
	var appointment_id= jQuery('.appoint_unique_id').val();
	var selected_service= jQuery('.ap_payment_service_id').val();
	var razorpay_amount= jQuery('.razorpay_amount').val();
				
	<?php
	$coupon_code_services = array();   
	$coupon_table =	$wpdb->prefix."apt_coupons";
	$appointment_coupons = $wpdb->get_results( "SELECT * from $coupon_table");
		if (!empty($appointment_coupons)) {
				
			foreach($appointment_coupons as $appointment_coupon){
				$temp_appy_service_name= $appointment_coupon->service_name;
				$temp_coupon= explode(",",$temp_appy_service_name);
				array_push($coupon_code_services,$temp_coupon );
			}
		}	?>
		var coupon_services = '<?php echo json_encode($coupon_code_services ); ?>';
		if (jQuery.inArray(selected_service, coupon_services ) == -1) 
	{
		jQuery('#coupon_service').hide();
	}
					
	
				
	<?php $service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services");
	foreach($service_details as $service_detail){	
		$service_id=$service_detail->id; 
		$service_name=$service_detail->name;
		$service_price=$service_detail->price;
		$service_duration=$service_detail->duration;?>
			if(appointment_service=='<?php echo $service_id;?>'){
				jQuery('.paypal_service_name').val('<?php echo $service_name;?>');
				jQuery('.paypal_service_amount').val('<?php echo $service_price;?>');
				
				appointment_service_amount= '<?php echo $service_price;?>';
				
			}
	<?php } ?>
					
		jQuery('.razorpay_amount').val(razorpay_amount);
		jQuery('.paypal_item_number').val(appointment_id);
		//jQuery('.appoint_unique_id').val(appointment_id);
		jQuery('.payment_unique_id').val(appointment_id);
		jQuery("#stepnext4").prop('disabled', true);
		jQuery('#stepnext4').html('<i class="fas fa-spinner fa-spin"></i><?php _e("please Wait",WL_A_P_SYSTEM); ?>');
		jQuery.ajax({
			type: "POST",
			data: jQuery("form#confirm_appointment").serialize(),
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery("#stepnext4").prop('disabled', false);
				jQuery('#stepnext4').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
					
				<?php $service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services");
				foreach($service_details as $service_detail){	
					$service_id=$service_detail->id; 
					$service_type=$service_detail->service_type; ?>
					if(appointment_service=='<?php echo $service_id;?>'){	<?php
						if($service_type=='paid_service'){ ?>
							jQuery('#step5').show();
							jQuery('#step1').hide();
							jQuery('#step2').hide();
							jQuery('#step3').hide();
							jQuery('#step4').hide();
							jQuery('#step6').hide();
								<?php }
								//$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
								$settings_accept_payment = get_option("weblizar_aps_payment_setting");
								$show_payment_section	= $settings_accept_payment['accept_payment'];

						if($service_type=='free_service' || $show_payment_section=="no"){	?>
							jQuery('#step6_free_service').show();
							jQuery('#step1').hide();
							jQuery('#step2').hide();
							jQuery('#step3').hide();
							jQuery('#step4').hide();
							jQuery('#step5').hide();	<?php	
						} ?>
					}
				<?php } ?>
			}
		});
}
//STEP 4 BACK	
<?php 
	if(is_user_logged_in()){
?>
	function step4_back(){
		 jQuery('#step3').hide();
		 jQuery('#step1').hide();
		 jQuery('#step2').show();
		 jQuery("#stepnext2").prop('disabled', false);
		 jQuery('#stepnext2').html('<?php _e("Next",WL_A_P_SYSTEM); ?>');
		 jQuery('#step4').hide();
		 jQuery('#step5').hide();
		 jQuery('#step6').hide();
	}
<?php
}
else{
?>
	function step4_back(){
		 jQuery('#step3').show();
		 jQuery('#step1').hide();
		 jQuery('#step2').hide();
		 jQuery('#step4').hide();
		 jQuery('#step5').hide();
		 jQuery('#step6').hide();
    }
<?php
	}
?>
//STEP 6 BACK
function step6_back(){
	 jQuery('#step5').show();
	 jQuery('#step1').hide();
	 jQuery('#step2').hide();
	 jQuery('#step3').hide();
	 jQuery('#step4').hide();
	 jQuery('#step6').hide();
	}
	
//SHOW NEW USER TAB
function New(){
	 jQuery('#new').show();
	 jQuery('#existing').hide();
	}
//SHOW LOGIN TAB	
function existing(){
		jQuery('form#ap_login')[0].reset();
		jQuery('#existing').show();
		jQuery('#new').hide();
		
	}
			
// PAYMENT SUCCESS- PAYPAL
function success_payment()
{
	var currenturl = jQuery(location).attr('href');
	jQuery.ajax({
		dataType : 'html',
		type: 'POST',
		url : currenturl,
		cache: false,
		//data : Datastring, 
		complete : function() {  },
		success:function (html) {
			var currenturl = jQuery(location).attr('href');
			
			let url = new URL(currenturl);          ;
			let searchParams = new URLSearchParams(url.search);
			var ap_id= searchParams.get('payment-id');
			
			if(currenturl.indexOf("payment-status=confirmed")>=0){
				currenturl=currenturl.replace('?&payment-status=confirmed', '');
				location.href = currenturl;
			}
			else if(currenturl.indexOf("?payment-id="+ap_id )>=0){
				currenturl=currenturl.replace('?payment-id='+ap_id, '');
				location.href = currenturl;
			}
		}
	});
}

//SHOW STAFF ACCORDING TO SERVICE
jQuery(function(){
    jQuery('#groups').on('change', function(){
        var val = jQuery(this).val();
    	var datas = "service_id="+ val;
    	jQuery.ajax({
    		type: "POST",
    		url: frontendajax.ajaxurl+'?action=staff_ajax_request',
    		dataType : 'html',
    		data: datas,
    		success: function(response){
    			jQuery("#sub_groups").html(response);
    		}
    	});
    });
   jQuery('#groups').trigger('change');
});

// TOGGLE CASH/PAYMENT BUTTON ONCHANGE
function OnChangeRadio (radio) {
	 var test=radio.value;
			if(test=="Cash"){
				jQuery('#stepnext5').show(); 
				jQuery('#stepnext5_paypal').hide(); 
				jQuery('#stepnext5_razorpay').hide(); 
			}else if(test=="paypal") {
				jQuery('#stepnext5_paypal').show(); 
				jQuery('#stepnext5').hide(); 
				jQuery('#stepnext5_razorpay').hide(); 
			}else if(test=="razorpay") {
				jQuery('#stepnext5_razorpay').show(); 
				jQuery('#stepnext5_paypal').hide(); 
				jQuery('#stepnext5').hide(); 
			}
        }

//APPLY COUPON CODE		
jQuery(document).on("click", '#apply_coupon', function (event) {
	appoint_coupon= jQuery('#appoint_coupon').val();
	appoint_date= jQuery('.ap_payment_date').val();
	appoint_client_email= jQuery('.ap_email_notification').val();
	appoint_service_name = jQuery('.ap_payment_service').val();
	appoint_service_price= jQuery('#c_service_price').val();
	
	jQuery.ajax({
        type : 'post',
        url : frontendajax.ajaxurl+'?action=front_coupon_ajax_request',  
		data :  'coupon_names='+ appoint_coupon + '&appt_date='+ appoint_date + '&appt_client_email='+ appoint_client_email + '&appt_service_name='+ appoint_service_name  + '&service_price='+ appoint_service_price, 
        success : function(data){
			jQuery('#step1').empty();	
			jQuery('#step2').html(data);
		}
    });
	
}); 
	
//CONTACT PICKER	
jQuery(document).ajaxComplete(function(){
       	jQuery(".phone").intlTelInput();
   });
</script>
 <?php	
 $email_settings= get_option("Appoint_notification");
 
//BOOK APPOINTMENT & 
//PAYMENT IF SERVICE IS FREE
if(isset($_REQUEST['appoint_staff_id']))
{
	
	$ap_payment_customer = sanitize_text_field( $_REQUEST['ap_payment_customer'] );
	$ap_staff_id = sanitize_text_field( $_REQUEST['appoint_staff_id'] );
	$appointment_payment_service = sanitize_text_field( $_REQUEST['ap_payment_service'] );
	$ap_client_contact_detail = sanitize_text_field( $_REQUEST['ap_client_contact_detail'] );
	$temp_date = sanitize_text_field( $_REQUEST['ap_payment_date'] );
	$ap_payment_date = date("Y-m-d", strtotime($temp_date));
	$ap_booking_start_time = sanitize_text_field( $_REQUEST['ap_booking_start_time'] );
	$temp_time = sanitize_text_field( $_REQUEST['ap_booking_end_time'] );
	$endTime = strtotime('+'.$temp_time, strtotime($ap_booking_start_time));
	$ap_booking_end_time= date('H:i', $endTime);
								
	$client_email_address = sanitize_text_field( $_REQUEST['client_email_address'] );
	$appoint_unique_id = sanitize_text_field( $_REQUEST['appoint_unique_id'] );
	$ap_payment_staff_email = sanitize_text_field( $_REQUEST['ap_payment_staff_email'] );
									
	$table_name =$wpdb->prefix ."apt_appointments";
	$Insert_Appointments="INSERT INTO `$table_name` (`id` ,client_name,`staff_member` ,`service_type` ,`contact` ,`booking_date` ,`start_time` ,`end_time` ,`status` ,`payment_status`,`client_email`, `appt_unique_id` , `staff_email`, `appt_booked_by` , `repeat_appointment`) VALUES ('NULL', '$ap_payment_customer', '$ap_staff_id', '$appointment_payment_service', '$ap_client_contact_detail', '$ap_payment_date', '$ap_booking_start_time', '$ap_booking_end_time', 'pending', 'pending', '$client_email_address', '$appoint_unique_id', '$ap_payment_staff_email','by_user','Non');";
															
	$wpdb->query($Insert_Appointments);
	//	$last_appointment_id= $wpdb->insert_id; 

	
	$ap_payment_service_id = sanitize_text_field( $_REQUEST['ap_payment_service_id'] );
	$ap_payment_staff = sanitize_text_field( $_REQUEST['ap_payment_staff'] );
	
	//$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
	$settings_accept_payment = get_option("weblizar_aps_payment_setting");
	$show_payment_section	= $settings_accept_payment['accept_payment'];
	
	$service_details =$wpdb->get_results("select * from $wpdb->prefix"."apt_services WHERE id='$ap_payment_service_id'");
	foreach($service_details as $service_detail){
		$service_type= $service_detail->service_type;
		$service_price= $service_detail->price;
		
		//if accept payment is "NO"
			include("hide_payment.php");
		
		//if service is free
			include("free_service.php");
	}
}


 if(isset($_GET['payment-status'])) {
	if($_GET['payment-status']== "confirmed") {	?>
		
	<?php }
	
 }

//UPDATE APPOINTMENT & PAYMENT STATUS ON PAYMENT CONFIRM
//PAYPAL PAYMENT CONFIRMED - approved MAIL
 if(isset($_GET['payment-status'])) {
	if($_GET['payment-status']== "confirmed") {	
	$payment_item_id = sanitize_text_field( $_REQUEST['item_number'] );
	$wpdb->update( $wpdb->prefix.'apt_payment', array( 
		'status' => 'approved', ),
			array( 'appt_unique_id' => $payment_item_id )
		);
	$wpdb->update( $wpdb->prefix.'apt_appointments', array( 
		'status' => 'approved', 
		'payment_status' => 'approved', 
		),
			array( 'appt_unique_id' => $payment_item_id )
		);	
		
		
	$appointment_details=$wpdb->get_results("select * from $wpdb->prefix"."apt_appointments WHERE appt_unique_id='$payment_item_id'");
	foreach($appointment_details as $appointment_detail){
		$service_name= $appointment_detail->service_type;
		$ap_booking_date= $appointment_detail->booking_date;
		$start_time= $appointment_detail->start_time;
		$end_time= $appointment_detail->end_time;
		$client_name= $appointment_detail->client_name;
		$staff_member_id= $appointment_detail->staff_member;
		$staff_details=$wpdb->get_row("select * from $wpdb->prefix"."apt_staff WHERE id = '$staff_member_id' ");
		$staff_member_name= $staff_details->staff_member_name;
		$client_email= $appointment_detail->client_email;
		$staff_email= $appointment_detail->staff_email;
		
		
		$admin_info = get_userdata(1);
		$admin_name= $admin_info->first_name . " " . $admin_info->last_name;
	
		$first_name=  $admin_info->first_name; 
		$last_name= $admin_info->last_name;
		if (!empty($first_name) && !empty($last_name)){
			$admin_name= $admin_info->first_name . " " . $admin_info->last_name;
		}
		else{
			$admin_name = $admin_info->user_login;
		}
		
		$site_url=get_site_url();
		$blog_name= get_bloginfo();
		
	$time_format = get_option( 'time_format' );
	$temp_ap_start_time = strtotime($start_time);
	$appt_start_time=	date($time_format, $temp_ap_start_time);
		
	$temp_ap_end_time = strtotime($end_time);
	$appt_end_time=	date($time_format, $temp_ap_end_time);
		
	$appointment_time= $appt_start_time . "-" . $appt_end_time;
	
	$date_format = get_option( 'date_format' );
	$booking_date=date($date_format, strtotime($ap_booking_date));
		
		$notification_enable= $email_settings['enable'];
		$notification_emailtype= $email_settings['emailtype'];
		
		if($notification_enable =="yes" ){ 
		//WP MAIL
				if($notification_emailtype=="wpmail"){
					$notification_admin_email= $email_settings['wpemail'];
						if($notification_admin_email !==""){
							//APPOINTMENT APPROVED
							$notification_client_approved= $email_settings['send_notification_client_approval'];
							if($notification_client_approved=="yes"){
									$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
									$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$to_client_email_approved = $client_email ;
										$subject_client_approved = $notification_subject_client_approved;
										$body_client_approved = $notification_body_client_approved;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_client = wp_mail( $to_client_email_approved, $subject_client_approved, $body_client_approved, $from_admin_email );
								}
									
							}
							//ADMIN APPROVED
							$notification_admin_approved= $email_settings['send_notification_admin_approved'];
							if($notification_admin_approved=="yes"){
									$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
									$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email ;
										$subject_notification_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$wp_mail_check_admin = wp_mail( $to_admin_email_approved, $subject_notification_admin_approved, $body_admin_approved, $header );
									}	
							}
							//STAFF APPROVED
							$notification_staff_approved= $email_settings['send_notification_staff_approval'];
							if($notification_staff_approved=="yes"){
									$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
									$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email ;
										$subject_notification_staff_approved = $notification_subject_staff_approved;
										$body_notification_staff_approved = $notification_body_staff_approved;
										$from_admin_email = $notification_admin_email;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$wp_mail_check_staff = wp_mail( $to_staff_email_approved, $subject_notification_staff_approved, $body_notification_staff_approved, $header );
									}	
							}
							
						}
				}
		//PHP MAIL
				if($notification_emailtype=="phpmail"){
					$notification_admin_email_php= $email_settings['phpemail'];
						if($notification_admin_email_php !==""){
							//CLIENT APPROVED
							$notification_client_approved= $email_settings['send_notification_client_approval'];
							if($notification_client_approved=="yes"){
									$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
									$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$to_client_email_approved = $client_email;
										$subject_client_approved = $notification_subject_client_approved;
										$body_client_approved = $notification_body_client_approved;
										$from_admin_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$mail_check_client_approved = mail ($to_client_email_approved,$subject_client_approved,$body_client_approved,$header);
									}						
							}
							//ADMIN APPROVED
							$notification_admin_approved= $email_settings['send_notification_admin_approved'];
							if($notification_admin_approved=="yes"){
									$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
									$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email_php;
										$subject_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$mail_check_client_pending = mail ($to_admin_email_approved,$subject_admin_approved,$body_admin_approved,$header);
									}						
							}
							//STAFF APPROVED
							$notification_staff_approved= $email_settings['send_notification_staff_approval'];
							if($notification_staff_approved=="yes"){
									$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
									$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email;
										$subject_staff_approved = $notification_subject_staff_approved;
										$body_staff_approved = $notification_body_staff_approved;
										$from_staff_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_staff_email>" . "\r\n";
										$mail_check_client_pending = mail ($to_staff_email_approved,$subject_staff_approved,$body_staff_approved,$header);
									}						
							}
						}
				}
				//SMTP MAIL
				if($notification_emailtype=="smtp"){
					require 'mailfiles/PHPMailerAutoload.php';
					$notification_smtp_hostname= $email_settings['hostname'];
					$notification_smtp_port_no= $email_settings['portno'];
					$notification_smtp_email= $email_settings['smtpemail'];
					$notification_smtp_password= $email_settings['password'];
					
					if($notification_smtp_hostname !=="" && $notification_smtp_port_no !=="" && $notification_smtp_email !=="" && $notification_smtp_password !==""){
						//CLIENT APPROVED
							$notification_client_approved= $email_settings['send_notification_client_approval'];
							if($notification_client_approved=="yes"){
									$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
									$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($client_email, 'Information');
										$mail->addAddress($client_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_client_approved;
										$mail->Body    = '<pre>'.$notification_body_client_approved.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
							//ADMIN APPROVED
							$notification_admin_approved= $email_settings['send_notification_admin_approved'];
							if($notification_admin_approved=="yes"){
									$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
									$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($notification_smtp_email, 'Information');
										$mail->addAddress($notification_smtp_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_admin_approved;
										$mail->Body    = '<pre>'.$notification_body_admin_approved.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
							//STAFF APPROVED
							$notification_staff_approved= $email_settings['send_notification_staff_approval'];
							if($notification_staff_approved=="yes"){
									$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
									$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($staff_email, 'Information');
										$mail->addAddress($staff_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_staff_approved;
										$mail->Body    = '<pre>'.$notification_body_staff_approved.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
						}
				}
		}
			
	}
 } ?>
		<script>
			jQuery.notify("<?php _e('Payment Successfull', WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		</script>
		<style>
		#step1,#failed_payment{
			display: none !important;
		}
		#payment_successful{
			display: block !important;
		}
		</style>
 <?php
	
}


//RAZORPAY STAUS UPDATE

if(isset($_GET['payment-id'])) {
	 $razorpay_payment_id= $_GET['payment-id'];
	 $wpdb->update( $wpdb->prefix.'apt_payment', array( 
		'status' => 'approved', ),
			array( 'appt_unique_id' => $razorpay_payment_id )
		);
	 
	 $wpdb->update( $wpdb->prefix.'apt_appointments', array( 
		'status' => 'approved',
		'payment_status' => 'approved', 		),
			array( 'appt_unique_id' => $razorpay_payment_id )
		);	
	 
	 
	 $appointment_details=$wpdb->get_results("select * from $wpdb->prefix"."apt_appointments WHERE appt_unique_id='$razorpay_payment_id'");
	foreach($appointment_details as $appointment_detail){
		$service_name= $appointment_detail->service_type;
		$ap_booking_date= $appointment_detail->booking_date;
		$start_time= $appointment_detail->start_time;
		$end_time= $appointment_detail->end_time;
		$client_name= $appointment_detail->client_name;
			$staff_member_id= $appointment_detail->staff_member;
			$staff_details=$wpdb->get_row("select * from $wpdb->prefix"."apt_staff WHERE id = '$staff_member_id' ");
		$staff_member_name= $staff_details->staff_member_name;
		$client_email= $appointment_detail->client_email;
		$staff_email= $appointment_detail->staff_email;
		
		
		$admin_info = get_userdata(1);
		$admin_name= $admin_info->first_name . " " . $admin_info->last_name;
	
		$first_name=  $admin_info->first_name; 
		$last_name= $admin_info->last_name;
		if (!empty($first_name) && !empty($last_name)){
			$admin_name= $admin_info->first_name . " " . $admin_info->last_name;
		}
		else{
			$admin_name = $admin_info->user_login;
		}
		
		$site_url=get_site_url();
		$blog_name= get_bloginfo();
		
	$time_format = get_option( 'time_format' );
	$temp_ap_start_time = strtotime($start_time);
	$appt_start_time=	date($time_format, $temp_ap_start_time);
		
	$temp_ap_end_time = strtotime($end_time);
	$appt_end_time=	date($time_format, $temp_ap_end_time);
		
	$appointment_time= $appt_start_time . "-" . $appt_end_time;
	
	$date_format = get_option( 'date_format' );
	$booking_date=date($date_format, strtotime($ap_booking_date));
		
		$notification_enable= $email_settings['enable'];
		$notification_emailtype= $email_settings['emailtype'];
		
		if($notification_enable =="yes" ){ 
		//WP MAIL
				if($notification_emailtype=="wpmail"){
					$notification_admin_email= $email_settings['wpemail'];
						if($notification_admin_email !==""){
							//APPOINTMENT APPROVED
							$notification_client_approved= $email_settings['send_notification_client_approval'];
							if($notification_client_approved=="yes"){
									$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
									$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$to_client_email_approved = $client_email ;
										$subject_client_approved = $notification_subject_client_approved;
										$body_client_approved = $notification_body_client_approved;
										$from_admin_email = $notification_admin_email;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$wp_mail_check_client = wp_mail( $to_client_email_approved, $subject_client_approved, $body_client_approved, $header );
								}
									
							}
							//ADMIN APPROVED
							$notification_admin_approved= $email_settings['send_notification_admin_approved'];
							if($notification_admin_approved=="yes"){
									$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
									$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email ;
										$subject_notification_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$wp_mail_check_admin = wp_mail( $to_admin_email_approved, $subject_notification_admin_approved, $body_admin_approved, $header );
									}	
							}
							//STAFF APPROVED
							$notification_staff_approved= $email_settings['send_notification_staff_approval'];
							if($notification_staff_approved=="yes"){
									$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
									$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email ;
										$subject_notification_staff_approved = $notification_subject_staff_approved;
										$body_notification_staff_approved = $notification_body_staff_approved;
										$from_admin_email = $notification_admin_email;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$wp_mail_check_staff = wp_mail( $to_staff_email_approved, $subject_notification_staff_approved, $body_notification_staff_approved, $header );
									}	
							}
							
						}
				}
		//PHP MAIL
				if($notification_emailtype=="phpmail"){
					$notification_admin_email_php= $email_settings['phpemail'];
						if($notification_admin_email_php !==""){
							//CLIENT APPROVED
							$notification_client_approved= $email_settings['send_notification_client_approval'];
							if($notification_client_approved=="yes"){
									$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
									$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$to_client_email_approved = $client_email;
										$subject_client_approved = $notification_subject_client_approved;
										$body_client_approved = $notification_body_client_approved;
										$from_admin_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$mail_check_client_approved = mail ($to_client_email_approved,$subject_client_approved,$body_client_approved,$header);
									}						
							}
							//ADMIN APPROVED
							$notification_admin_approved= $email_settings['send_notification_admin_approved'];
							if($notification_admin_approved=="yes"){
									$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
									$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email_php;
										$subject_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$mail_check_client_pending = mail ($to_admin_email_approved,$subject_admin_approved,$body_admin_approved,$header);
									}						
							}
							//STAFF APPROVED
							$notification_staff_approved= $email_settings['send_notification_staff_approval'];
							if($notification_staff_approved=="yes"){
									$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
									$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email;
										$subject_staff_approved = $notification_subject_staff_approved;
										$body_staff_approved = $notification_body_staff_approved;
										$from_staff_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_staff_email>" . "\r\n";
										$mail_check_client_pending = mail ($to_staff_email_approved,$subject_staff_approved,$body_staff_approved,$header);
									}						
							}
						}
				}
				//SMTP MAIL
				if($notification_emailtype=="smtp"){
					
					require 'mailfiles/PHPMailerAutoload.php';
					$notification_smtp_hostname= $email_settings['hostname'];
					$notification_smtp_port_no= $email_settings['portno'];
					$notification_smtp_email= $email_settings['smtpemail'];
					$notification_smtp_password= $email_settings['password'];
					
					if($notification_smtp_hostname !=="" && $notification_smtp_port_no !=="" && $notification_smtp_email !=="" && $notification_smtp_password !==""){
						//CLIENT APPROVED
							$notification_client_approved= $email_settings['send_notification_client_approval'];
							if($notification_client_approved=="yes"){
									$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
									$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($client_email, 'Information');
										$mail->addAddress($client_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_client_approved;
										$mail->Body    = '<pre>'.$notification_body_client_approved.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
							//ADMIN APPROVED
							$notification_admin_approved= $email_settings['send_notification_admin_approved'];
							if($notification_admin_approved=="yes"){
									$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
									$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($notification_smtp_email, 'Information');
										$mail->addAddress($notification_smtp_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_admin_approved;
										$mail->Body    = '<pre>'.$notification_body_admin_approved.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
							//STAFF APPROVED
							$notification_staff_approved= $email_settings['send_notification_staff_approval'];
							if($notification_staff_approved=="yes"){
									$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
									$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'approved',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($staff_email, 'Information');
										$mail->addAddress($staff_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_staff_approved;
										$mail->Body    = '<pre>'.$notification_body_staff_approved.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
						}
				}
		}
			
	}
?>
	<script>
			jQuery.notify(" Razorpay Payment successful ", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		</script>
		<style>
		#step1,#failed_payment{
			display: none !important;
		}
		#payment_successful{
			display: block !important;
		}
		</style>
	<?php
 }
	

//PAYPAL PAYMENT CANCELLED - PENDING MAIL
if(isset($_GET['payment-status'])) {
	if($_GET['payment-status'] == "cancelled") {	
	$payment_item_id= $_GET['id'];
	
	$appointment_details=$wpdb->get_results("select * from $wpdb->prefix"."apt_appointments WHERE appt_unique_id='$payment_item_id'");
	foreach($appointment_details as $appointment_detail){
		$service_name= $appointment_detail->service_type;
		$ap_booking_date= $appointment_detail->booking_date;
		$start_time= $appointment_detail->start_time;
		$end_time= $appointment_detail->end_time;
		$client_name= $appointment_detail->client_name;
		$staff_member_id= $appointment_detail->staff_member;
		$staff_details=$wpdb->get_row("select * from $wpdb->prefix"."apt_staff WHERE id = '$staff_member_id' ");
		$staff_member_name= $staff_details->staff_member_name;
		$client_email= $appointment_detail->client_email;
		$staff_email= $appointment_detail->staff_email;
		
		$admin_info = get_userdata(1);
		$admin_name = $admin_info->user_login;
	
		$site_url=get_site_url();
		$blog_name= get_bloginfo();
		
		
	$time_format = get_option( 'time_format' );
	$temp_ap_start_time = strtotime($start_time);
	$appt_start_time=	date($time_format, $temp_ap_start_time);
		
	$temp_ap_end_time = strtotime($end_time);
	$appt_end_time=	date($time_format, $temp_ap_end_time);
		
	$appointment_time= $appt_start_time . "-" . $appt_end_time;
	
	$date_format = get_option( 'date_format' );
	$booking_date=date($date_format, strtotime($ap_booking_date));
		
		$notification_enable= $email_settings['enable'];
		$notification_emailtype= $email_settings['emailtype'];
		
		if($notification_enable =="yes" ){ 
		//WP MAIL
				if($notification_emailtype=="wpmail"){
					$notification_admin_email= $email_settings['wpemail'];
						if($notification_admin_email !==""){
							//CLIENT PENDING
							$notification_client_pending= $email_settings['send_notification_client_pending'];
							if($notification_client_pending=="yes"){
									$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
										$to_client_email_pending = $client_email ;
										$subject_client_pending = $notification_subject_client_pending;
										$body_client_pending = $notification_body_client_pending;
										$from_admin_email = $notification_admin_email;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$wp_mail_check_client = wp_mail( $to_client_email_pending, $subject_client_pending, $body_client_pending, $header );
									}
									
							}
							//ADMIN PENDING
							$notification_admin_pending= $email_settings['send_notification_admin_pending'];
							if($notification_admin_pending=="yes"){
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_pending'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
										$to_admin_email_pending = $notification_admin_email ;
										$subject_notification_admin_pending = $notification_subject_admin_pending;
										$body_admin_pending = $notification_body_admin_pending;
										$from_admin_email = $notification_admin_email;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$wp_mail_check_admin = wp_mail( $to_admin_email_pending, $subject_notification_admin_pending, $body_admin_pending, $header );
								}	
							}
							//STAFF PENDING
							$notification_staff_pending= $email_settings['send_notification_staff_pending'];
							if($notification_staff_pending=="yes"){
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_pending'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
								
								if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$to_staff_email_pending = $staff_email ;
										$subject_notification_staff_pending = $notification_subject_staff_pending;
										$body_notification_staff_pending = $notification_body_staff_pending;
										$from_admin_email = $notification_admin_email;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$wp_mail_check_staff = wp_mail( $to_staff_email_pending, $subject_notification_staff_pending, $body_notification_staff_pending, $header );
									}	
							}
						}
				}
				//PHP MAIL
				if($notification_emailtype=="phpmail"){
					$notification_admin_email_php= $email_settings['phpemail'];
						if($notification_admin_email_php !==""){
							//CLIENT PENDING
							$notification_client_pending= $email_settings['send_notification_client_pending'];
							if($notification_client_pending=="yes"){
									$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
										$to_client_email_pending = $client_email;
										$subject_client_pending = $notification_subject_client_pending;
										$body_client_pending = $notification_body_client_pending;
										$from_admin_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$mail_check_client_pending = mail ($to_client_email_pending,$subject_client_pending,$body_client_pending,$header);
									}						
							}
							//ADMIN PENDING
							$notification_admin_pending= $email_settings['send_notification_admin_pending'];
							if($notification_admin_pending=="yes"){
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_pending'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
										$to_admin_email_pending = $notification_admin_email_php;
										$subject_admin_pending = $notification_subject_admin_pending;
										$body_admin_pending = $notification_body_admin_pending;
										$from_admin_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_admin_email>" . "\r\n";
										$mail_check_client_pending = mail ($to_admin_email_pending,$subject_admin_pending,$body_admin_pending,$header);
									}						
							}
							//STAFF PENDING
							$notification_staff_pending= $email_settings['send_notification_staff_pending'];
							if($notification_staff_pending=="yes"){
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_pending'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$to_staff_email_pending = $staff_email;
										$subject_staff_pending = $notification_subject_staff_pending;
										$body_staff_pending = $notification_body_staff_pending;
										$from_staff_email = $notification_admin_email_php;
										$header = "From: $admin_name <$from_staff_email>" . "\r\n";
										$mail_check_client_pending = mail ($to_staff_email_pending,$subject_staff_pending,$body_staff_pending,$header);
									}						
							}
						}
				}
				//SMTP MAIL
				if($notification_emailtype=="smtp"){
					require 'mailfiles/PHPMailerAutoload.php';
					$notification_smtp_hostname= $email_settings['hostname'];
					$notification_smtp_port_no= $email_settings['portno'];
					$notification_smtp_email= $email_settings['smtpemail'];
					$notification_smtp_password= $email_settings['password'];
					
					if($notification_smtp_hostname !=="" && $notification_smtp_port_no !=="" && $notification_smtp_email !=="" && $notification_smtp_password !==""){
						//CLIENT PENDING
							$notification_client_pending= $email_settings['send_notification_client_pending'];
							if($notification_client_pending=="yes"){
									$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($client_email, 'Information');
										$mail->addAddress($client_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_client_pending;
										$mail->Body    = '<pre>'.$notification_body_client_pending.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
							//ADMIN PENDING
							$notification_admin_pending= $email_settings['send_notification_admin_pending'];
							if($notification_admin_pending=="yes"){
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_pending'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($notification_smtp_email, 'Information');
										$mail->addAddress($notification_smtp_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_admin_pending;
										$mail->Body    = '<pre>'.$notification_body_admin_pending.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
							//STAFF PENDING
							$notification_staff_pending= $email_settings['send_notification_staff_pending'];
							if($notification_staff_pending=="yes"){
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_pending'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url));
															
									if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($staff_email, 'Information');
										$mail->addAddress($staff_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
												 
										$mail->Subject = $notification_subject_staff_pending;
										$mail->Body    = '<pre>'.$notification_body_staff_pending.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}						
							}
							
					}
				}
			}
	}
	?>
		<script>
		jQuery.notify("Sorry! Your Payment was not successful ", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		</script>
		<style>
		#payment_successful{
			display: none !important;
		}
		#step1{
			display: none !important;
		}
		#failed_payment{
			display: block !important;
		}
		</style>
		
	<?php }
}
 
?>
<div class="ap_wrapper1">
	<div id="img-thumbnail" class="img-thumbnail ap-dashboard ap-front">	
		<div id="preloader">
			<div id="preloader-inner"></div>
		</div>
		<div id="change-loader" class="change-loader" style="display:none">
			<div id="change-loader-inner"></div>
		</div>
	   <div id="ap_fornt_main_div" style="display:none;">  
	     	<div class="ap-logo">
		<?php 	
			    $appearence_ap_show_logo = get_option('appearance_general_settings'); //$wpdb->get_col( "SELECT ap_show_logo from $appearence_table" );
				$ap_show_logo	= $appearence_ap_show_logo['ap_show_logo'];
				if($ap_show_logo=="yes"){ ?>
				<div class="row">
					<div class="col-md-3 app_logo">
						<?php	$appearence_ap_logo = get_option('appearance_general_settings');// $wpdb->get_col( "SELECT ap_logo from $appearence_table" );
						$ap_logo	= $appearence_ap_logo['ap_logo']; ?>
						<img src="<?php  echo $ap_logo;  ?>" class="img-responsive" alt=""/>
					</div>
					<?php } ?>
					<div class="col-md-6 contact-info">
					<?php
							$biz_profile = get_option("weblizar_aps_bizprofile_setting");
							//$settings_b_name = $wpdb->get_col( "SELECT b_name from $settings_table" );
							$b_name	= $biz_profile['b_name'];

							$blog_title = get_bloginfo( 'name' ); 
							 
							$appearence_ap_phone_icon = get_option('appearance_general_settings'); 
							$ap_phone_icon	= $appearence_ap_phone_icon['ap_phone_icon'];							
						?>							
						<label class="app_business_name"><?php  if($b_name==""){ echo $blog_title; } else{ echo stripslashes($b_name); } ?></label><br>	
						<?php  $current_date=date('d-m-Y');
						$current_day= date("D",strtotime($current_date));									
						if($current_day=="Mon"){
							$settings_bh_monday_st = get_option("weblizar_aps_business_hours");
							$monday = unserialize($settings_bh_monday_st['bh_monday']); 
							$start_time= $monday[0]['start_time'];
							$end_time= $monday[0]['end_time'];
						}
						if($current_day=="Tue"){
							$settings_bh_tuesday_st = get_option("weblizar_aps_business_hours"); 
							$tuesday= unserialize($settings_bh_tuesday_st['bh_tuesday']);
							$start_time= $tuesday[0]['start_time'];
							$end_time= $tuesday[0]['end_time'];
						}
						if($current_day=="Wed"){
							$settings_bh_wednesday_st = get_option("weblizar_aps_business_hours"); 
							$wednesday= unserialize($settings_bh_wednesday_st['bh_wednesday']);
							$start_time= $wednesday[0]['start_time'];
							$end_time= $wednesday[0]['end_time'];
						}
						if($current_day=="Thu"){
							$settings_bh_thursday_st = get_option("weblizar_aps_business_hours"); 
							$thursday= unserialize($settings_bh_thursday_st['bh_thursday']);
							$start_time= $thursday[0]['start_time'];
							$end_time= $thursday[0]['end_time'];
						}
						if($current_day=="Fri"){
							$settings_bh_friday_st = get_option("weblizar_aps_business_hours"); 
							$friday	= unserialize($settings_bh_friday_st['bh_friday']);
							$start_time= $friday[0]['start_time'];
							$end_time= $friday[0]['end_time'];
						}
						if($current_day=="Sat"){
							$settings_bh_saturday_st = get_option("weblizar_aps_business_hours"); 
							$saturday = unserialize($settings_bh_saturday_st['bh_saturday']);
							$start_time= $saturday[0]['start_time'];
							$end_time= $saturday[0]['end_time'];
						}
						if($current_day=="Sun"){
							$settings_bh_sunday_st = get_option("weblizar_aps_business_hours"); 
							$sunday	= unserialize($settings_bh_sunday_st['bh_sunday']);
							$start_time= $sunday[0]['start_time'];
							$end_time= $sunday[0]['end_time'];
						} 								
							$time_format = get_option( 'time_format' ); 
							$biz_st = strtotime($start_time);
							$biz_et = strtotime($end_time);
								
							$biz_start_time=	date($time_format, $biz_st);
							$biz_end_time=	date($time_format, $biz_et);
						
						?>
						<span class="bs_opening_hours"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo $biz_start_time; ?><?php  echo " - ".$biz_end_time; ?></span><br>
						<?php 
						$appearence_ap_show_phone_no =get_option('appearance_general_settings');									
						$ap_show_phone_no	= $appearence_ap_show_phone_no['ap_show_phone_no'];
						$ap_phone_icon = $appearence_ap_show_phone_no['ap_phone_icon'];
						if($ap_show_phone_no=="yes"){ ?>
						<span class="phone_number_info"><i class="<?php  echo $ap_phone_icon; ?>"></i><?php  echo "&nbsp;".$biz_profile['b_phone']; ?></span>
						<?php } 
						
						$appearence_ap_show_email = get_option('appearance_general_settings'); 
						$ap_email_icon	= $appearence_ap_show_email['ap_email_icon'];									
						$ap_show_email	= $appearence_ap_show_email['ap_show_email'];
						
						if($ap_show_email=="yes"){ ?>
							<span class="email_address_info"><i class="<?php  echo $ap_email_icon; ?>"></i> <?php  echo $biz_profile['b_email']; ?></span>
						<?php } ?>
											
					</div>
					<div class="col-md-3 social-info">
						<ul class="social">
						<?php
							$appearence_ap_social_link = get_option('appearance_general_settings');										
							
							$ap_social_link1	= $appearence_ap_social_link['ap_social_link1'];								
							$ap_social_icon1= $appearence_ap_social_link['ap_social_icon1'];
							
							$ap_social_link2	= $appearence_ap_social_link['ap_social_link2'];										
							$ap_social_icon2	= $appearence_ap_social_link['ap_social_icon2'];
							
							$ap_social_link3= $appearence_ap_social_link['ap_social_link3'];
							$ap_social_icon3= $appearence_ap_social_link['ap_social_icon3'];
							
							$ap_social_link4= $appearence_ap_social_link['ap_social_link4'];
							$ap_social_icon4= $appearence_ap_social_link['ap_social_icon4'];
							
							$ap_social_link5	= $appearence_ap_social_link['ap_social_link5'];
							$ap_social_icon5= $appearence_ap_social_link['ap_social_icon5'];
							
						?>
						
							<?php if (!empty($ap_social_link1)) { ?><li><a href="<?php  echo $ap_social_link1; ?>"><i class="<?php echo $ap_social_icon1; ?>"></i></a></li> <?php } ?>
							<?php if (!empty($ap_social_link2)) { ?><li><a href="<?php  echo $ap_social_link2; ?>"><i class="<?php echo $ap_social_icon2; ?>"></i></a></li><?php } ?>
							<?php if (!empty($ap_social_link3)) { ?><li><a href="<?php  echo $ap_social_link3; ?>"><i class="<?php echo $ap_social_icon3; ?>"></i></a></li><?php } ?>
							<?php if (!empty($ap_social_link4)) { ?><li><a href="<?php  echo $ap_social_link4; ?>"><i class="<?php echo $ap_social_icon4; ?>"></i></a></li><?php } ?>
							<?php if (!empty($ap_social_link5)) { ?><li><a href="<?php  echo $ap_social_link5; ?>"><i class="<?php echo $ap_social_icon5; ?>"></i></a></li><?php } ?>
						</ul>							
					</div>
				</div>
			</div>
	
			<div id="step1">
				<div class="col-md-12 col-sm-12  ap-steps">
					<div class="col-md-2 col-sm-2 col-xm-12 ap-step1 services active">
						<label><?php _e('Services',WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
					<div class="col-md-2 col-sm-2 ap-step2 time">
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
					<?php 
					//$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
					$settings_accept_payment =  get_option("weblizar_aps_payment_setting");
					 $accept_payment	= $settings_accept_payment['accept_payment'];
					 
					 if($accept_payment=="yes") {	
					 ?>
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
				<!-- Step 1 -->
				<form style="margin-bottom: 0;" action="" method="POST" id="step_01" name="step_01">
				<div  id="1" class="ap-steps-detail">
					<div class="row service-form">
						<div class="col-md-4 col-sm-6 ap-category">
							<label><?php _e('Services',WL_A_P_SYSTEM); ?></label>
							<select class="form-control "  id="groups" name="service_name" >
								<option value='default'>--<?php _e('Select',WL_A_P_SYSTEM); ?>--</option>
								<?php $settings_table =	$wpdb->prefix."apt_settings";
										$settings_payment_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
										$payment_currency	= $settings_payment_currency['currency'];
									foreach($appointment_category_details as $appointment_category_single_detail){ ?>
										<optgroup label="<?php echo $appointment_category_single_detail->name;?>">
											<?php $service_table=	$wpdb->prefix."apt_services";
											$appointment_details = $wpdb->get_results( "SELECT * from $service_table where category= '$appointment_category_single_detail->id'");  
												foreach($appointment_details as $appointment_single_detail){	?>
													<option value="<?php echo $appointment_single_detail->id ?>" ><?php echo $appointment_single_detail->name ?> (<?php echo $appointment_single_detail->price ?><?php if ($payment_currency==""){echo ' USD';} else{ echo ' '.$payment_currency;} ?>)</option>
												<?php } ?>
												</optgroup>
										<?php } ?>
							</select>
						</div>
						<div class="col-md-4 col-sm-6 ap-employee">
							<label><?php _e('Employee',WL_A_P_SYSTEM); ?></label>
							<select class="form-control staff" id="sub_groups"  name="staff_member"></select>
						</div>
						<div class="col-md-4 col-sm-6 ap-dates">
							<label> <?php _e('Date',WL_A_P_SYSTEM); ?></label>
							<input id="apt_date" name="apt_date" placeholder="<?php _e('Select date',WL_A_P_SYSTEM);?> @ <?php _e('eg',WL_A_P_SYSTEM);?> <?php echo $date = date('m/d/Y'); ?>" class="form-control ap-date"  type="text"/>
							
						</div>
					</div>
					
					 <?php  $service_editor_content= get_option("service_tips");
						if (!empty($service_editor_content)) {	?>
							<div class="row step-description">
								<div> <?php echo "<pre class='pre_bg' style='display:block !important;'>".$service_editor_content."</pre>"; ?>  </div> 
							</div>
					<?php } ?> 
				</div>
				<!-- Step 1 -->
				<div class="ap-step-link">
				<?php $appearence_service_navigation_text = $wpdb->get_col( "SELECT service_navigation_text from $appearence_table" );
						$service_navigation_text	= $appearence_service_navigation_text[0]; ?>
					<button id="step1_next" type="button" class="btn step-right"><?php if (!empty($service_navigation_text)) {   echo __("$service_navigation_text", WL_A_P_SYSTEM); } else { _e("Next",WL_A_P_SYSTEM); } ?></button> 
				</div>
				</form>
			</div>
			
			<!-- Step 2 -->
			<div id="step2" class="ap_class_active">
				<div id="form_02">
				</div>
			</div>
			
			<!-- Step 3 -->
			<div id="step3" class="ap_class_active" >
				<div id="user_details">
				</div>
			</div>
			
			<!-- Step 4 -->						
			<div id="step4" class="ap_class_active">
			</div>
			
			<!-- Step 5 -->
			<div id="step5" class="ap_class_active">
				<?php
				//$settings_table =	$wpdb->prefix."apt_settings";
				//$settings_paypal_email = $wpdb->get_col( "SELECT paypal_email from $settings_table" ); 
				 $settings_paypal_email = get_option("weblizar_aps_payment_setting");
				$appoint_paypal_email	= $settings_paypal_email['paypal_email'];
				
				$appoint_currency = 'USD';
				$appoint_successful_url	= "http://".$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
				$appoint_failed_url = $appoint_successful_url."?&failed=failed&cancelled=cancelled";
				
				$appoint_service_name="Demo Service";
				$appoint_paycost= "250";
				
				$last_appointment_id= "1";
				
				include_once ('paypal-api/WeblizarPaypal.php');	
				$obj = new WeblizarPaypal();	
				$obj->TakePayment($appoint_paypal_email, $appoint_currency, $appoint_successful_url, $appoint_failed_url, $appoint_service_name, $appoint_paycost, $last_appointment_id);
				?>
			</div>
				
			<!-- Step 6 -->	
			<div id="step6" class="ap_class_active">
			</div>
				
			<!-- Step 6- FREE SERVICE -->	
			<div id="step6_free_service" class="ap_class_active">
						<div class="col-md-12 col-sm-12 ap-steps">
						<div class="col-md-2 col-sm-2 ap-step1 services complete">
							<label>Services</label>
							<span></span>
						</div>
						<div class="col-md-2 col-sm-2 ap-step2 time complete">
							<label>Time</label>
							<span></span>
						</div>
						<div class="col-md-2 col-sm-2 ap-step3 time complete">
							<label>Details</label>
							<span></span>
						</div>
						<div class="col-md-2 col-sm-2 ap-step4 Details complete">
							<label>Confirm </label>
							<span></span>
						</div>
						<?php //$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
							$settings_accept_payment = get_option("weblizar_aps_payment_setting");
							$accept_payment	= $settings_accept_payment['accept_payment'];
					 
							if($accept_payment=="yes") {	?>
							<div class="col-md-2 col-sm-2 ap-step5 payment">
								<label>Payment</label>
								<span></span>
							</div>
							<?php } ?>
						<div class="col-md-2 col-sm-2 ap-step6 done active">
							<label>Done</label>
							<span></span>
						</div>
					</div>
					
					<div id="6" class="ap-steps-detail6">
					<?php $appearence_done_page_icon = $wpdb->get_col( "SELECT done_page_icon from $appearence_table" );
						$done_page_icon	= $appearence_done_page_icon[0]; ?>
						<?php  if (!empty($done_page_icon)) { ?><i class="<?php echo $done_page_icon; ?>"></i><?php  }  ?>
						<?php  $done_editor_content= get_option("done_tips");
						if (!empty($done_editor_content)) {	?>
							<div class="row step-description">
								<div> <?php echo "<pre class='pre_bg' style='display:block !important;'>".$done_editor_content."</pre>"; ?> </div> 
							</div>
					<?php } else { ?> 
						
						
						<h4 class="ap-heading"><?php _e('Booking Done',WL_A_P_SYSTEM); ?></h4>
						<div class="row service-form">
							<p> <?php _e('Thank You! Your Booking Is Complete.',WL_A_P_SYSTEM); ?> </p>
						</div>
						<?php } ?>
					</div>
			</div>
				
			<!-- PAYPAL PAYMENT FAILED -->	
			<div style="display:none" id="failed_payment" class="ap_class_active">
				<!-- Step payment_failed -->
				<div id="6" class="ap-steps-detail6">
					<span><?php _e('Sorry! Your appointment was not successfull',WL_A_P_SYSTEM); ?></span>
					<div class="ap-step-link">
						<a class="btn step-right"  onclick="document.location.href='<?php echo site_url(); ?>';">Close</a>
					</div>
				</div>
				<!-- Step payment_failed -->
			</div>
			
			<!-- PAYPAL PAYMENT SUCCESS -->
			<div style="display:none" id="payment_successful" class="ap_class_active">
				<!-- Step payment_failed -->
				<div id="6" class="ap-steps-detail6">
					<span><?php _e('Payment received and your appointment has been confirmed',WL_A_P_SYSTEM); ?></span><br>
					<span><?php _e('Thank you scheduling appointment with us',WL_A_P_SYSTEM); ?>.</span>
					<div class="row service-form">
					
					<div class="ap-step-link">
						<a class="btn step-left"  onclick="return success_payment();"><?php _e('Book New Appointment',WL_A_P_SYSTEM); ?></a>
					</div>
						
					</div>
				</div>
				<!-- Step payment_failed -->
			</div>
		</div>		
	</div>				
</div>
<style>
#staff_off_text{
	color: #337ab7 !important;
}

.alert_box{
   background: #304CD8;
   background: -webkit-linear-gradient(left, #304CD8 0%, #9F3762 100%);
   background: -ms-linear-gradient(left, #304CD8 0%, #9F3762 100%);
   background: linear-gradient(to right, #304CD8 0%, #9F3762 100%);
   color: #fff;
   font-size: 25px;
   padding: 35px;
   text-align: center;
}

#dd-w-0 .dd-c .dd-s{
	background:#337ab7 !important;
}
.step3-form {
    min-height: 90px !important;
}
#date_01{
	height:70px !important;
	    width: 100%;
    border-radius: 5px;
	text-align:center;
}

/*.ap-steps-detail1 p{
	float:left !important;
}*/
.ap-steps-detail1 p{
	padding-left: 20px;
	padding-right: 20px;
}
/*.ap-steps-detail3 p{
	float:left !important;
}*/
.ap-steps-detail3 p{
	padding-right: 20px;
	padding-left: 20px;
}
.swiper-container{
	overflow:visible !important;
}
.signup-info{
	clear:both !important;
}
.service_tag, .staff_tag, .date_tag, .service_price_tag, .time_tag {
	
	font-style: oblique !important;
}
#date_01{
	font-size:30px !important;
}
.b_closed{
	font-size:25px !important;
}
input[type="tel"]{
	padding-left: 50px !important;
}
#app_business_name{
	font-size:18px !important;
	padding-top:10px !important;
}
#appoint_register, #appoint_login{
	color: #fff !important;
    background-color: #f0ad4e !important;;
    border-color: #eea236 !important;;
}

#register_button{
	color: #fff !important;
    background-color: #c9302c !important;
    border-color: #ac2925 !important; 
}

#login_button{
	color: #fff !important;
    background-color: #449d44 !important;
    border-color: #398439 !important;
}
#img-thumbnail img{
	transform: none !important;
	transition: none !important;
}
<?php 
$appearence_ap_theme_color = get_option('appearance_general_settings'); //$wpdb->get_col( "SELECT 	ap_bg_color from $appearence_table" ); 
$ap_theme_color	= $appearence_ap_theme_color['ap_bg_color'];?>
.ap-steps .active span , .ap-steps .complete span, .ap-step-link .step-right,.ap-step-link .step-left, .aps-date .tm-value,.step4-form .save ,.social-info .social li{
	background-color:<?php echo $ap_theme_color;?> !important;
}
<?php if (!empty($ap_theme_color)) { ?>
.ap-dashboard .form-control:focus, .stp-duration li {
    border: 2px solid <?php echo $ap_theme_color;?> !important;
}
<?php } ?>
.stp-duration .tm-value {
	color: <?php echo $ap_theme_color;?> !important;
}
<?php $appearence_ap_progress_bar = get_option('appearance_general_settings'); //$wpdb->get_col( "SELECT ap_progress_bar from $appearence_table" );
$ap_progress_bar	= $appearence_ap_progress_bar['ap_progress_bar'];
if($ap_progress_bar=="no"){ ?>
.col-md-12.col-sm-12.ap-steps{
	display:none !important;
}
<?php }	
 $appearence_ap_logo_setting = get_option('appearance_general_settings');
$appearence_ap_logo_width = $appearence_ap_logo_setting['ap_logo_width']; //$wpdb->get_col( "SELECT ap_logo_width from $appearence_table" );
$ap_logo_width	= $appearence_ap_logo_width;

$appearence_ap_logo_height = $appearence_ap_logo_setting['ap_logo_height']; //$wpdb->get_col( "SELECT ap_logo_height from $appearence_table" );
$ap_logo_height	= $appearence_ap_logo_height;
?>

.app_logo img {
    height: <?php echo $ap_logo_height;?>px !important;
    width: <?php echo $ap_logo_width;?>px !important;
}



<?php if ( !wp_is_mobile() ) { ?>
#ap_slots{
	width:24% !important;
}

.social-info {
    margin-top: 80px !important;
} 
<?php } 
else{ ?>
#ap_slots{
	width:31% !important;
}	
<?php }?>

.pre_bg{
	background-color:white !important;
}

div#existing:focus ,div#new:focus {
    outline: none !important;
}
<?php 
 $temp_custom_css = $wpdb->get_col( "SELECT custom_css from $settings_table" ); 
 $appt_custom_css= $temp_custom_css[0];
if(isset($appt_custom_css)) echo $appt_custom_css; ?>
</style>

<script>
<?php

//DISABLE HOLIDAYS IN DATEPICKER
$holiday_table =	$wpdb->prefix."apt_holidays";
$business_holidays = $wpdb->get_results( "SELECT * from $holiday_table" );

$total_holidays = array();

/*Function declaration start*/
	/*Particular date off*/
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
	/*daily off*/
function appt_daily_off($start, $end, $format = 'm/d/Y') {
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

	/*bi weekly*/
function appt_bi_weekly($start, $end, $format = 'm/d/Y') {
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
	/*week off*/
function appt_week_off($start, $end, $format = 'm/d/Y') {
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

/*Function declaration end*/

if (!empty($business_holidays)) {
	$full_day_off = $wpdb->get_col("SELECT holiday_date FROM $holiday_table where repeat_value='no' AND all_off='1'"); 
	if (!empty($full_day_off)) {
		array_push($total_holidays,$full_day_off );
	}
	foreach($business_holidays as $business_holiday){
			if($business_holiday->repeat_value=="p_d" && $business_holiday->all_off=="1") {
				$date_start=date("m/d/Y", strtotime($business_holiday->start_date));
				$date_end=date("m/d/Y", strtotime($business_holiday->end_date));
			
				
					// Call the function
					$date_period = appt_pd_off($date_start, $date_end); 
					array_push($total_holidays,$date_period );
			}	
	
			if($business_holiday->repeat_value =="daily" && $business_holiday->all_off=="1") {
				$holiday_start_date=date("m/d/Y", strtotime($business_holiday->holiday_date));  
				$temp_add_days=$business_holiday->repeat_days;
				$add_days= $temp_add_days ;
				$holiday_end_date = date('m/d/Y',strtotime($holiday_start_date) + (24*3600*$add_days)); 
			
				
				$date_range = appt_daily_off($holiday_start_date, $holiday_end_date);
				array_push($total_holidays,$date_range );
			}	
			if($business_holiday->repeat_value =="weekly" && $business_holiday->all_off=="1") {
				$temp_weekz=$business_holiday->repeat_weeks;
				$weekz= $temp_weekz;
				$start_date= $business_holiday->holiday_date;
				$end_date =  date('m/d/Y',strtotime('+'.$weekz.' weeks', strtotime($start_date))); 
					
				  $weekly_off = appt_week_off($start_date, $end_date);
				  array_push($total_holidays,$weekly_off );
			}
			if($business_holiday->repeat_value =="bi_weekly" && $business_holiday->all_off=="1") {
				
				$temp_weekz=$business_holiday->repeat_bi_weeks;
				$weekz= $temp_weekz + 1;
				$start_date= $business_holiday->holiday_date;
				$end_date =  date('m/d/Y',strtotime('+'.$weekz.' weeks', strtotime($start_date))); 
				
				
					
				   $bi_weekly = appt_bi_weekly($start_date, $end_date);
				   array_push($total_holidays,$bi_weekly );
			}	
		
			
			$monthly_holidays = array();
			if($business_holiday->repeat_value =="monthly" && $business_holiday->all_off=="1") {
				$months=$business_holiday->repeat_month;
					for($i=0;$i<=$months;$i++)
				{
					$date_format=date("'m/d/Y", strtotime('+'.$i.'months', strtotime($business_holiday->holiday_date))); 
					$monthly_off= substr($date_format, 1); 
					array_push($monthly_holidays,$monthly_off);
				}
				
				array_push($total_holidays,$monthly_holidays );
			}

		if($business_holiday->repeat_value =="monthly" && $business_holiday->all_off=="1") {
				
				$months=$business_holiday->repeat_month;
				$start_date= $business_holiday->holiday_date;
				$end_date =  date('m/d/Y',strtotime('+'.$months.' months', strtotime($start_date))          ); 
				
				$begin = new DateTime($start_date);
				$end = new DateTime($end_date);
				

				while ($begin <= $end) {
						$date_months= $begin->format('m/d/Y');
						
						$month_off= array($date_months);
						
						array_push($total_holidays,$month_off );
						$begin->modify('first day of next month');
				}
			}	 ?>
		
			var disableddates = '<?php echo json_encode($total_holidays ); ?>';
		
			function DisableSpecificDates(date) {
                var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                return (disableddates.indexOf(string) == -1);
            }
            
            //disable staff off days
            function DisableStaffOffDays(date){
                var all_staff_off_days = [];
                all_staff_off_days = '<?php echo json_encode($all_staff_off_days ); ?>';
                //console.log(all_staff_off_days);
                all_staff_off_days = JSON.parse(all_staff_off_days);
                //console.log(all_staff_off_days);
                var day = date.getDay(); // get day number of given date
                var days = false;
                var selected_staff_off_days = [];
                var selected_staff_id = "";        
                
                //get selected staff id
                selected_staff_id = jQuery("select[name='staff_member']").find(":selected").val();
                if(selected_staff_id > 0){
                    for (var key in all_staff_off_days) {
                        if(selected_staff_id == key) {
                            //console.log("staff id " + selected_staff_id +" key " + key + " has value " + all_staff_off_days[key]);
                            selected_staff_off_days = all_staff_off_days[key];
                            //console.log(selected_staff_off_days);
                            if(selected_staff_off_days.includes(day)){
                                days = false;
                            } else {
                                days = true;
                            }
                        }
                    }
                }
                return days;
            }
            
            // Check Holidays and Staff OffDays
            function Check_Off_Days_HOlidays(date){
                var days = [false];
                var Holidays = false;
                var OffDays = false;
                
                var Holidays = DisableSpecificDates(date);
                var OffDays = DisableStaffOffDays(date);            
                
                if(Holidays && OffDays){
                    return days = [true];
                } else {
                    return days = [false];
                }
            }
        
            var dateToday = new Date();
            jQuery(function() {
            jQuery("#apt_date").datepicker({
                    minDate: dateToday,
                    dateFormat: 'mm/dd/yy',
                    beforeShowDay: Check_Off_Days_HOlidays
                });
            });	
			<?php
		
		
	} 
} else { ?>
	function DisableStaffOffDays(date){
	    var all_staff_off_days = [];
	    all_staff_off_days = '<?php echo json_encode($all_staff_off_days ); ?>';
	    //console.log(all_staff_off_days);
	    all_staff_off_days = JSON.parse(all_staff_off_days);
	    //console.log(all_staff_off_days);
	    var day = date.getDay(); // get day number of given date
	    var days = [false];
	    var selected_staff_off_days = [];
	    var selected_staff_id = "";        
	    
	    //get selected staff id
	    selected_staff_id = jQuery("select[name='staff_member']").find(":selected").val();
	    if(selected_staff_id > 0){
	        for (var key in all_staff_off_days) {
	            if(selected_staff_id == key) {
	                console.log("staff id " + selected_staff_id +" key " + key + " has value " + all_staff_off_days[key]);
	                selected_staff_off_days = all_staff_off_days[key];
	                console.log(selected_staff_off_days);
	                if(selected_staff_off_days.includes(day)){
	                    days = [false];
	                } else {
	                    days = [true];
	                }
	            }
	        }
	    }   
	    
	    return days;    
	}

	var dateToday = new Date();
	jQuery.noConflict()(function (jQuery) {
		jQuery(function() {
			jQuery( "#apt_date" ).datepicker({
				dateFormat: 'mm/dd/yy',
				minDate: dateToday,		//DISABLE PREVIOUS DATES
				beforeShowDay: DisableStaffOffDays
			}); 
			jQuery("#apt_date").datepicker("setDate", dateToday);
		}); 
	});
<?php } ?>
</script>


	
	/* update the appointment on google calendar */
	$temp_ap_start_time = strtotime($edit_start_time);
	$appt_start_time=	date("H:i", $temp_ap_start_time);

	echo $current_id."<br>";
			// $post_meta_detail = get_user_meta($current_id,'post_id',true);
			// print_r($post_meta_detail);
			## ==> Define HERE the statuses of that orders 
$order_statuses = array('wc-on-hold', 'wc-processing', 'wc-completed');

## ==> Define HERE the customer ID
$customer_user_id = get_current_user_id(); // current user ID here for example

// Getting current customer orders
$customer_orders = wc_get_orders( array(
    'meta_key' => '_customer_user',
    'meta_value' => $customer_user_id,
    'post_status' => $order_statuses,
    'numberposts' => -1
) );

$post_meta_detail = get_post_meta("15");
		print_r($post_meta_detail);
		
	$temp_ap_end_time = strtotime($edit_end_time);
	$appt_end_time=	date("H:i", $temp_ap_end_time);
	$start_time = $edit_booking_date."T".$appt_start_time.':00';
	$end_time = $edit_booking_date."T".$appt_end_time.':00';
	$event_date = "";
	$event_time	= array('start_time' => $start_time,'end_time' => $end_time,'event_date' => $event_date);
	$new_event_name = $edit_service_type;
	$Gsync_ojb->UpdateCalendarEvent($google_event_id, 'primary', $new_event_name, '0', $event_time, 'Asia/Calcutta', $_SESSION['access_token']);
	?>
	<script>
	console.log("google event id<?php echo $google_event_id; ?>");
	</script>
<?php

/* update the appointment on google calendar */
	/*$ap_appoint_gsync = $wpdb->get_row("select * from $wpdb->prefix"."apt_sync WHERE app_id = $id");	
	$google_event_id = $ap_appoint_gsync->app_sync_details;
	$temp_ap_start_time = strtotime($edit_start_time);
	$appt_start_time=	date("H:i", $temp_ap_start_time);
		
	$temp_ap_end_time = strtotime($edit_end_time);
	$appt_end_time=	date("H:i", $temp_ap_end_time);
	$start_time = $edit_booking_date."T".$appt_start_time.':00';
	$end_time = $edit_booking_date."T".$appt_end_time.':00';
	$event_date = "";
	$event_time	= array('start_time' => $start_time,'end_time' => $end_time,'event_date' => $event_date);
	$new_event_name = $edit_service_type;
	$Gsync_ojb->UpdateCalendarEvent($google_event_id, 'primary', $new_event_name, '0', $event_time, 'Asia/Calcutta', $_SESSION['access_token']);		
*/
	// get saved client id and secret id
	$google_sync_settings = get_option('weblizar_ap_calendar_sync_settings');
	//print_r($google_sync_settings);
	if(is_array($google_sync_settings)){
		$clientid = $google_sync_settings['ap_cal_client_id'];
		$clientsecret = $google_sync_settings['ap_cal_secret_key'];
	}
	else{
		$clientid = "";
		$clientsecret = "";
	}
	// get refresh token and access token from db
	$refresh_saved = get_option('weblizar_ap_calendar_refresh_token');
	//print_r($refresh_saved);
	if(is_array($refresh_saved)){
		$saved_access_toekn = 	$refresh_saved['access_token'];
		$saved_refresh_token = $refresh_saved['refresh_token'];
		$saved_expireTime = $refresh_saved['expireTime'];
	}
	else{
		$saved_access_toekn = 	"";
		$saved_refresh_token = "";
		$saved_expireTime = "";
	}
	//set session variable
	$_SESSION['refresh_token'] = $saved_refresh_token;
	$_SESSION['expireTime'] = $saved_expireTime;
	if(!empty($_SESSION['refresh_token']) && !empty($_SESSION['expireTime']) && time() > $_SESSION['expireTime']){		
		$data = $Gsync_ojb->GetRefreshedAccessToken($clientid, $saved_refresh_token, $clientsecret);
		$_SESSION['access_token'] = $data['access_token'];
		$_SESSION['access_token_expiry'] = time() + $data['expires_in'];
		$expireTime = $_SESSION['access_token_expiry'];
	}
	else{
		$_SESSION['access_token'] = $saved_access_toekn;
	}
	
	$ap_appoint_gsync = $wpdb->get_row("select * from $wpdb->prefix"."apt_sync WHERE app_id = $id");	
	$google_event_id = $ap_appoint_gsync->app_sync_details;
	$temp_ap_start_time = strtotime($edit_start_time);
	$appt_start_time=	date("H:i", $temp_ap_start_time);
		
	$temp_ap_end_time = strtotime($edit_end_time);
	$appt_end_time=	date("H:i", $temp_ap_end_time);
	$start_time = $edit_booking_date."T".$appt_start_time.':00';
	$end_time = $edit_booking_date."T".$appt_end_time.':00';
	$event_date = "";
	$event_time	= array('start_time' => $start_time,'end_time' => $end_time,'event_date' => $event_date);
	$new_event_name = $edit_service_type;
	$Gsync_ojb->UpdateCalendarEvent($google_event_id, 'primary', $new_event_name, '0', $event_time, 'Asia/Calcutta', $_SESSION['access_token']);



	?>

	#example3_23 .title-in-bg{ background: none !important; } 
	
	p.sp-layer.sp-white.sp-padding.title-in.title-in-bg.hide-small-screen{ top: 5px !important; bottom: auto; } #example3_4998 .desc-in{ width: 100% !important; }

	https://chloestravelogue.com/2018/03/07/best-food-drinks-kaohsiung/
#example3_23 .title-in{ top: -50% !important; }


enigma theme im ready to buy the the $39 package
info@bernardopacheco.com

http://autoreport24.de/?p=4999 
#example3_4998 .desc-in-bg{
		width: 100%;
	}
#example3_4998 .desc-in{
	width: 100%;
}

#example3_4998 .desc-in{ width: 100% !important; min-height: 30% !important; }

Hello saschavalentin,

please try the following CSS code. it will increase the width and also set the min height. if you don't want to set the height then please remove the height.

<blockquote>#example3_4998 .desc-in{ width: 100% !important; min-height: 30% !important; }</blockquote>

Note: Here "4998" is a shortcode id [URIS id=4998]
example3_480 .sp-slide p.title-in{
	top: 5px !important;
	bottom: auto !important;
}	

I can confirm that woocommerce orders are a custom post type so they are stored in wp_posts as you found.

http://codecharismatic.com/sql-script-to-get-all-woocommerce-orders-including-metadata/

hi saschavalentin,

We find out the solution, if you are familiar with coding then please follow the instruction:

1) go to plugin folder, there you will find uris-layout.php

2) now go to line no 255 or search strlen($Desc) > 300 ( you will get this line: <?php if(strlen($Desc) > 300 ) echo substr($Desc,0,300)."..."; else echo $Desc; ?>)

3) edit the 300 to 500 in both places. (<?php if(strlen($Desc) > 500 ) echo substr($Desc,0,500)."..."; else echo $Desc; ?>)

This will solve the problem.

Thank you.

WordPress database error: []
SELECT post_id FROM wp_postmeta WHERE meta_value = 3

Array ( [0] => stdClass Object ( [post_id] => 20 ) )


Notice: Trying to get property of non-object in /opt/lampp/htdocs/FREE/wp-content/themes/personal-premium/theme-update-checker.php on line 69
http://www.isupervise.com.au/make-a-booking/

INSTAGRAM PLUGIN

https://primephysiquenutrition.com/wp-admin 
Username: fzahid001@gmail.com 
Password: S@manabad123
[IGF id=6067]
684089654.1677ed0.b23befeae73b4251a41e21de23296a3f
footer 2 widget code [IGF id=13294]

	wp_enqueue_style('pongstagr.am.css', IMGF_PLUGIN_URL.'css/pongstagr.am.css');
	wp_enqueue_script('pongstagr.am.js', IMGF_PLUGIN_URL.'js/pongstagr.am.js', array('jquery'), '', true);
	here are the credentials for ftp
	FTP Username: primephysiquenutrition@conqueroreczemaacademy.com 
	FTP Server: ftp.conqueroreczemaacademy.com 
	FTP & explicit FTPS port: 21
	Password: upworkjob552


	you can access the file manager using following url
https://secureusm38.sgcpanel.com:2083/cpsess9558288868/frontend/Crystal/filemanager/index.html?dirselect=domainrootselect&domainselect=primephysiquenutrition.com&dir=%2fhome%2fconque40%2fpublic_html%2fprimephysiquenutrition.com&showhidden=1&login=1&post_login=62636550170249 

Username: conque40
password: upworkjob552


https://pongstr.io/pongstgrm/
plugin name which conflict: PHP for posts

my insta user id: 1666292456
Access token: 

error:

DataTables warning: table id=appointment_example - Requested unknown parameter '9' for row 0, column 9. For more information about this error, please see http://datatables.net/tn/4

.fc-unthemed .fc-today { background: #fff !important;  }

.fc-unthemed .fc-today {
    background: rgb(252, 248, 227) !important;
}

Sector - A, 1365, Rama Krishna Puram, Kota, Kota-Rajasthan - 324005, Ph. No. 2472456 

<div class="modal fade" id="reports" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><?php _e("Download Reports",WL_A_P_SYSTEM );?> </h4>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 modal-body">
							<div class="form-group">
								<form method="post" id="download_report_form">
									<div class="row cus-reg" id="appoint_staff">
										<label><?php _e("Staff Member Name:",WL_A_P_SYSTEM );?>  </label>
										<input type="text" class="col-md-12 a_date" id="ap_datepicker_reports" name="ap_datepicker">
									</div>													
								</form>
							</div>										 
						</div>
					</div>
				</div>
			</div>


"SELECT * FROM logs WHERE date BETWEEN '" . $from_date . "' AND  '" . $to_date . "' ORDER by id DESC"


http://localhost/FREE/wp-admin/admin-ajax.php?action=download_ajax_reports


vishal3976@gmail.com 
Vishal@123


location: 
enquiry@creativenanny.co

Business: The Creative Nanny

tag line: Singapore's Most Creative Nanny Service

----
email notification

enquiry@creativenanny.co
wp mail

---

payment setting: Linda@creativenanny.co, singapore Dollar 10:30 6:00
fax no : +1 9988776655
phone no: +65 82186928
Postal code: 987665

time slots : custom slots
30



DataTables warning: table id=appointment_example - 
Requested unknown parameter '9' for row 0, column 9. For more information about this error, 
please see http://datatables.net/tn/4

http://www.blueladybirdpottery.co.uk

Staff Settings
email id : blueladybirdpottery@gmail.com
phone no : +44 07837 371021

1) Debbie - Thursday Slot
	service : Brackley - 1 February - The Rooms
	thursday: 10:30 13:00

2) Debbie - Saturday Slots
	Service  : Towcester - 28th April - Towcester Library
	saturday: 10:00 to 13:00
3) Debbie - Monday Slots
	Service : No service selected
	Monday : 10:00 to 13:00

4) Debbie - Tuesday Slots
	Service : no service selected
	tuesday: 10:00 to 13:00

5) Debbie - Wednesday Slots
	Service : No
	wednesday: 10:00 to 13:00

6) Debbie - Friday Slots
	Service : no
	Friday : 10:00 to 13:00

7) Debbie - Sunday Slots
	Service : No
	sunday: 10:00 to 13:00


Email Notification
PHP mail
blueladybirdpottery@gmail.com

Customer Notification last two selected
Staff Notification None
Admin Notification All Selected

Payment setting
only cash enabled

Business Hours

Mon to Fri
10:00 to 15:00


jQuery(function(){

    var enableDays = ["7-8-2013"];

    function enableAllTheseDays(date) {
        var sdate = $.datepicker.formatDate( 'd-m-yy', date)
        if($.inArray(sdate, enableDays) != -1) {
            return [true];
        }
        return [false];
    }

    $('#datepicker').datepicker({dateFormat: 'dd-mm-yy', beforeShowDay: enableAllTheseDays});
})

else if(isset($Specific)){
	?>
	//var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
	var enableDate = ['03/28/2018'];
	//var enableDate = '<?php echo json_encode($Specific ); ?>';
	var dateToday = new Date();
	console.log(dateToday);
	function enableThisDay(date) { 
	var sdate = jQuery.datepicker.formatDate('mm/dd/yy', date);       
        if(jQuery.inArray(sdate, enableDate) != -1) {
            return [true];
        }
        return [false];
    }
	jQuery.noConflict()(function (jQuery) {
		jQuery(function() {
			jQuery( "#apt_date" ).datepicker(
			{	dateFormat: 'mm/dd/yy',
				beforeShowDay: enableThisDay,		//enable Specific Date
				selectMultiple:true
			}); 
			//jQuery("#apt_date").datepicker("setDate", dateToday);
		}); 
	});
	
	<?php
	}

	$option_name = 'weblizar_service_date_'.$lastid;
?>
	kd@2017_123
	enquiry@creativenanny.co
	
password: opS5Ki@QjJT5X2lNHt2RGOS#

migssaxena
password: et4R6rViL!$lKwbI!UFNvGEv

$wpdb->show_errors(); 
$wpdb->print_error();

http://demo.weblizar.com/testing/wp-admin/users.php
u  - kolineha8@gmail.com / kolineha8
p - kolineha8


/*dashboard*/
<div class="panel panel-default">
	<div class="panel-heading" ><i class="fas fa-home"></i><span class="panel_heading"><?php _e( 'Dashboard',WL_A_P_SYSTEM ) ?></span> </div>
	<div class="panel-body" id="dashboard_div">
		<div class="ap-total-graph">
			<h3><?php _e( 'Appointment Reports',WL_A_P_SYSTEM ) ?></h3>
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-thumbs-up dashboard_icons" aria-hidden="true"></i><?php _e( 'Status',WL_A_P_SYSTEM ) ?>  </div>
						<?php $approved_appointment_details = $wpdb->get_results( "select * from $appointments_table where status='approved'");
						$approved_appointments= count($approved_appointment_details);?>

						<div class="number"><?php echo $approved_appointments; ?><i class="icon-arrow-up"></i></div>
						<div class="title"><?php _e( 'Approved',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'Approved Report',WL_A_P_SYSTEM ) ?></div>
						</div>	
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-unlock dashboard_icons" aria-hidden="true"></i><?php _e( 'Status',WL_A_P_SYSTEM ) ?>  </div>
						<?php $pending_appointment_details = $wpdb->get_results( "select * from $appointments_table where status='pending'");
						$pending_appointments= count($pending_appointment_details);?>
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
						<?php $cancelled_appointment_details = $wpdb->get_results( "select * from $appointments_table where status='cancelled'");
						$cancelled_appointments= count($cancelled_appointment_details);?>
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
						<?php $completed_appointment_details = $wpdb->get_results( "select * from $appointments_table where status='completed'");
						$completed_appointments= count($completed_appointment_details);
						?>
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
						<?php $current_date_time= current_time( 'mysql' );
						$current_date = substr($current_date_time, 0, -8);

						$today_appointment_details = $wpdb->get_results( "select * from $appointments_table where booking_date='$current_date'");
						$today_appointments= count($today_appointment_details);										?>
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
						<?php  $tommorrow_date= date("Y-m-d", time()+86400);
						$tommorrow_appointment_details = $wpdb->get_results( "select * from $appointments_table where booking_date='$tommorrow_date'");
						$tommorrow_appointments= count($tommorrow_appointment_details);												?>
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
						<?php
						$current_date_time= current_time( 'mysql' );
						$week_start_date = substr($current_date_time, 0, -8);

						$week_date =  date('Y-m-d',strtotime('+1 weeks', strtotime($week_start_date))); 
						$week_end_date = date('Y-m-d',strtotime($week_date) - (24*3600*1)); 

						$week_appts = $wpdb->get_col( "SELECT booking_date from $appointments_table where booking_date between '$week_start_date' and '$week_end_date'");
						$this_week= count($week_appts);?>

						<div class="number"><?php echo $this_week; ?><i class="icon-arrow-up"></i></div>
						<div class="title"><?php _e('This Week',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'This Week Appointments',WL_A_P_SYSTEM ) ?>  </div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
						<div class="boxchart"><i class="fas fa-arrows-alt dashboard_icons" aria-hidden="true"></i>
						<?php _e( 'Appointments Details',WL_A_P_SYSTEM )?></div>
						<?php
						$month_start_date = date('Y-m-01'); // hard-coded '01' for first day
						$month_end_date = date('Y-m-t', strtotime($month_start_date));
						
						$month_appts = $wpdb->get_col( "SELECT booking_date from $appointments_table where booking_date between '$month_start_date' and '$month_end_date'");
						$this_month= count($month_appts);?>
						<div class="number"><?php echo $this_month; ?><i class="icon-arrow-down"></i></div>
						<div class="title"><?php _e( 'This Month',WL_A_P_SYSTEM ) ?></div>
						<div class="footer">
							<div class="boxchart"><?php _e( 'This Month Appointments',WL_A_P_SYSTEM ) ?>  </div>
						</div>
					</div>
				</div>		
			</div>		
		</div>
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
	</div>
</div>