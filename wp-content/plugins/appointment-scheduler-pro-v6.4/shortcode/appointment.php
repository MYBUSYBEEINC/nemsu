<?php
//main file 
global $wpdb;
require_once( "vendor/autoload.php" );

$appointment_staff_details = $wpdb->get_results( "select * from $wpdb->prefix"."apt_staff");
$appearence_table =	$wpdb->prefix."apt_appearence";
$staff_table =	$wpdb->prefix."apt_staff";
$client_table = $wpdb->prefix."apt_clients";
$location_table =	$wpdb->prefix."apt_location";
$settings_table =	$wpdb->prefix."apt_settings"; 
$general_settings = get_option('weblizar_aps_general_setting');
//extract the extra information coming with shortcode
if(isset($id['id'])){
 	$location_id = $id['id'];
 }
 else{
 	$location_id = 1;
 }
 // get all staff off days
$all_staffs_query = "SELECT * FROM `$staff_table`";
if($all_staffs = $wpdb->get_results($all_staffs_query)) {
   // print_r($all_staffs);
   //echo "<hr>";
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
var ap_location_id;

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
	var ap_location_id = jQuery('#ap_location_id').val();	
	
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
			data :  'apt_dates='+ appointment_date  + '&service='+ appointment_service + '&staff_member='+ appointment_staff  + '&date_label='+ selected_date  + '&current_time='+ current_time + '&current_url='+ current_url + '&ap_location_id='+ ap_location_id , 
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
	var ap_location_id = jQuery('#ap_location_id').val();
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
			            data :  'current_id='+ current_id + '&staff='+ appointment_staff + '&service='+ appointment_service + '&booking_st='+ appointment_time + '&apt_date='+ appointment_date + '&apt_time_format='+ appt_time_format + '&ap_location_id='+ ap_location_id, 
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
			}else{
				?>

				// alert("no");
				if(jQuery('.radio_button').is(':checked')) {
		
					document.getElementById("stepnext2").href="#step3";
					jQuery("#stepnext2").prop('disabled', true);
					jQuery('#stepnext2').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Please Wait", WL_A_P_SYSTEM); ?>');
					
					jQuery.ajax({
		            type : 'post',
		            url : frontendajax.ajaxurl+'?action=details_ajax_request',  
		            data :  'apt_time='+ appointment_time  + '&service='+ appointment_service + '&time_format='+ appt_time_format + '&staff_member='+ appointment_staff + '&apt_date='+ appointment_date + '&ap_location_id='+ ap_location_id , 
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
					
			}
			else{
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
	var ap_location_id = jQuery('#ap_location_id').val();
	//alert(ap_location_id);			
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
//STEP 5 BACK
function step5_back() {
		 jQuery('#step3').hide();
		 jQuery('#step1').hide();
		 jQuery('#step2').hide();
		 jQuery('#step4').show();
		 jQuery('#step5').hide();
		 jQuery('#step6').hide();
}
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
				jQuery('#stepnext5_stripe').hide();				
			}else if(test=="paypal") {
				jQuery('#stepnext5_paypal').show(); 
				jQuery('#stepnext5').hide(); 
				jQuery('#stepnext5_razorpay').hide();
				jQuery('#stepnext5_stripe').hide();	
			}else if(test=="razorpay") {
				jQuery('#stepnext5_razorpay').show(); 
				jQuery('#stepnext5_paypal').hide(); 
				jQuery('#stepnext5').hide(); 
				jQuery('#stepnext5_stripe').hide();	
			}else if(test == "stripe") {
				jQuery('#stepnext5_stripe').show();
				jQuery('#stepnext5_razorpay').hide();
				jQuery('#stepnext5_paypal').hide(); 
				jQuery('#stepnext5').hide(); 
			}
        }

//APPLY COUPON CODE		
jQuery(document).on("click", '#apply_coupon', function (event) {
	alert("calling");
	appoint_coupon= jQuery('#appoint_coupon').val();
	alert(appoint_coupon);
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
       	jQuery(".phone").intlTelInput({
       		preferredCountries: ['in'],
       	});
   });
</script>
<?php	
$email_settings= get_option("Appoint_notification");

require_once 'gapi/googlecalendarapi.php';
$Gsync_ojb = new GoogleCalendarApi();

/*assign the value and check the expire time and get new access_token start*/
	$google_sync_settings = get_option('weblizar_ap_calendar_sync_settings');

	$sync_email = $google_sync_settings['ap_cal_google_mail']??'';
	$clientid = $google_sync_settings['ap_cal_client_id']??'';
	$clientsecret = $google_sync_settings['ap_cal_secret_key']??'';
	$refresh_saved = get_option('weblizar_ap_calendar_refresh_token');
	if(!empty($sync_email) && !empty($clientid) && !empty($clientsecret)){
	//print_r($refresh_saved);
		if(isset($refresh_saved['code'])){
			$saved_code = $refresh_saved['code'];
		}
		else{
			$saved_code = "";
		}
		if(isset($refresh_saved['access_token'])){
			$saved_access_token = 	$refresh_saved['access_token'];
		}
		else{
			$saved_access_token = 	"";
		}
		if(isset($refresh_saved['refresh_token'])){
			$saved_refresh_token = $refresh_saved['refresh_token'];
		}
		else{
			$saved_refresh_token = "";
		}
		if(isset($refresh_saved['expireTime'])){
			$saved_expireTime = $refresh_saved['expireTime'];
		}
		else{
			$saved_expireTime = "";
		}
		//$saved_code = $refresh_saved['code'];
		//$saved_access_token = 	$refresh_saved['access_token'];
		//$saved_refresh_token = $refresh_saved['refresh_token'];
		//$saved_expireTime = $refresh_saved['expireTime'];

		$_SESSION['refresh_token'] = $saved_refresh_token;
		$_SESSION['expireTime'] = $saved_expireTime;
		
		if(!empty($_SESSION['refresh_token']) && !empty($_SESSION['expireTime']) && time() > $_SESSION['expireTime']){
			//echo "rror";
			$data = $Gsync_ojb->GetRefreshedAccessToken($clientid, $saved_refresh_token, $clientsecret);

			// Again save the expiry time of the new token
			$_SESSION['access_token_expiry'] = time() + $data['expires_in'];
			$expireTime = $_SESSION['access_token_expiry'];
			// The new access token
			$_SESSION['access_token'] = $data['access_token'];	
		}
		else{
			$_SESSION['access_token'] = $saved_access_token;
		}
	}

/*assign the value and check the expire time and get new access_token end*/

//BOOK APPOINTMENT & 
//PAYMENT IF SERVICE IS FREE
if(isset($_REQUEST['appoint_staff_id'])){	
	$ap_payment_customer 		 = sanitize_text_field( $_REQUEST['ap_payment_customer'] );
	$ap_staff_id 				 = sanitize_text_field( $_REQUEST['appoint_staff_id'] );
	$appointment_payment_service = sanitize_text_field( $_REQUEST['ap_payment_service'] );
	$ap_client_contact_detail 	 = sanitize_text_field( $_REQUEST['ap_client_contact_detail'] );
	$temp_date 			   		 = sanitize_text_field( $_REQUEST['ap_payment_date'] );
	$ap_payment_date 	   		 = date("Y-m-d", strtotime($temp_date));
	$ap_booking_start_time 		 = sanitize_text_field( $_REQUEST['ap_booking_start_time'] );
	$temp_time 			   		 = sanitize_text_field( $_REQUEST['ap_booking_end_time'] );
	$endTime 			   		 = strtotime('+'.$temp_time, strtotime($ap_booking_start_time));
	$ap_booking_end_time         = date('H:i', $endTime);
								
	$client_email_address   	 = sanitize_text_field( $_REQUEST['client_email_address'] );
	$appoint_unique_id 	    	 = sanitize_text_field( $_REQUEST['appoint_unique_id'] );
	$ap_payment_staff_email 	 = sanitize_text_field( $_REQUEST['ap_payment_staff_email'] );
	//$ap_location_id = sanitize_text_field( $_REQUEST['ap_location_id'] );
	if(isset($_REQUEST['ap_location_id'])){
		$location_id = sanitize_text_field($_REQUEST['ap_location_id']);
	}
	else{
		$location_id = 1;
	}
	
		/*location info*/
	$tablename 		= $wpdb->prefix . "apt_location";		
	$lo_info        = $wpdb->get_row("select * from $tablename where id = '$location_id'");
	$ap_location_id = $lo_info->location_add;
									
	$table_name =$wpdb->prefix ."apt_appointments";
	$Insert_Appointments="INSERT INTO `$table_name` (`id` ,client_name,`staff_member` ,`service_type` ,`contact` ,`booking_date` ,`start_time` ,`end_time` ,`status` ,`payment_status`,`client_email`, `appt_unique_id` , `staff_email`, `appt_booked_by` , `repeat_appointment` , `location_id`) VALUES ('NULL', '$ap_payment_customer', '$ap_staff_id', '$appointment_payment_service', '$ap_client_contact_detail', '$ap_payment_date', '$ap_booking_start_time', '$ap_booking_end_time', 'pending', 'pending', '$client_email_address', '$appoint_unique_id', '$ap_payment_staff_email','by_user','Non','$location_id');";
															
	$wpdb->query($Insert_Appointments);
		$last_appointment_id= $wpdb->insert_id; 
	update_user_meta( get_current_user_id(), 'last_appointment_id', $last_appointment_id );
	$ap_payment_service_id = sanitize_text_field( $_REQUEST['ap_payment_service_id'] );
	$ap_payment_staff 	   = sanitize_text_field( $_REQUEST['ap_payment_staff'] );
	
	//$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
	$settings_accept_payment = get_option("weblizar_aps_payment_setting");
	$show_payment_section	 = $settings_accept_payment['accept_payment'];
	
	$service_details =$wpdb->get_results("select * from $wpdb->prefix"."apt_services WHERE id='$ap_payment_service_id'");
	foreach($service_details as $service_detail){
		$service_type  = $service_detail->service_type;
		$service_price = $service_detail->price;
		
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
		$appt_id  = $appointment_detail->id;
		$ap_booking_date= $appointment_detail->booking_date;
		$start_time= $appointment_detail->start_time;
		$end_time= $appointment_detail->end_time;
		$staff_member_id= $appointment_detail->staff_member;
		$staff_details=$wpdb->get_row("select * from $wpdb->prefix"."apt_staff WHERE id = '$staff_member_id' ");
		$staff_member_name= $staff_details->staff_member_name;
		$client_email= $appointment_detail->client_email;
		$staff_email= $appointment_detail->staff_email;
		//if client name is empty
		if(!empty($appointment_detail->client_name)){
			$client_name= $appointment_detail->client_name;
		}
		else{
			$client_name= $client_email;
		}
		$location_id = $appointment_detail->location_id;
			/*location info*/
		$tablename = $wpdb->prefix . "apt_location";
		
		$lo_info = $wpdb->get_row("select * from $tablename where id = '$location_id'");
		$ap_location_id = $lo_info->location_add;		

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
		
		$site_url = get_site_url();
		$blog_name = get_bloginfo();
		
		$time_format = get_option( 'time_format' );
		$temp_ap_start_time = strtotime($start_time);
		$appt_start_time =	date("H:i", $temp_ap_start_time);
			
		$temp_ap_end_time = strtotime($end_time);
		$appt_end_time=	date("H:i", $temp_ap_end_time);
			
	    $appointment_time= $appt_start_time . "-" . $appt_end_time;
		
		$date_format = get_option( 'date_format' );
		$booking_date=date($date_format, strtotime($ap_booking_date));
		$booking_date_sync = date("Y-m-d", strtotime($ap_booking_date));
		$start_time = $booking_date_sync."T".$appt_start_time.':00';
		$end_time = $booking_date_sync."T".$appt_end_time.':00';
		$event_date = "";
	?>
	<script>
		console.log("<?php echo $start_time; ?>");
		console.log("<?php echo $end_time ?>");
	</script>	
	<?php
		$event_time	= array('start_time' => $start_time,'end_time' => $end_time,'event_date' => $event_date);
		// $event_time	= array('start_time' => $start_time,'end_time' => $end_time,'event_date' => "2018-01-18");

		$notification_enable= $email_settings['enable'];
		$notification_emailtype= $email_settings['emailtype'];

		/* after payment confirmed gsync add start */

		$get_sync_settings = get_option('weblizar_ap_calendar_sync_settings');
		$sync_email = $get_sync_settings['ap_cal_google_mail'];
		$ap_cal_client_id = $get_sync_settings['ap_cal_client_id'];
		$ap_cal_secret_key = $get_sync_settings['ap_cal_secret_key'];
		if(!empty($sync_email) && !empty($ap_cal_client_id) && !empty($ap_cal_secret_key)){

			if(isset($_SESSION['access_token'])) {
			//$_SESSION['user_timezone'] = $capi->GetUserCalendarTimezone($_SESSION['access_token']);
			$event_id = $Gsync_ojb->CreateCalendarEvent('primary', $service_name, "0", $event_time, 'Asia/Calcutta', $_SESSION['access_token']);	

			$GS_table_name =$wpdb->prefix ."apt_sync";
			$Insert_GS_data="INSERT INTO `$GS_table_name` (`id` ,`app_id`,`timeoff_id` ,`app_sync_details`) VALUES ('', '$appt_id', 's1_1', '$event_id' );";
			$wpdb->query($Insert_GS_data);	
			?>
				<script>
					console.log("<?php echo $event_id; ?>");
				</script>
			<?php
			}
		}
		/* after payment confirmed gsync add end */
		
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
															'[SITE_URL]'			=>  $site_url,
															'[LOC_ID]' 				=>  $ap_location_id));
															
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
															'[SITE_URL]'			=>  $site_url,
															'[LOC_ID]' 				=>  $ap_location_id));
								
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
															'[SITE_URL]'			=>  $site_url,
															'[LOC_ID]' 				=>  $ap_location_id));
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
															'[SITE_URL]'			=>  $site_url,
															'[LOC_ID]' 				=>  $ap_location_id));
								
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
															'[SITE_URL]'			=>  $site_url,
															'[LOC_ID]' 				=>  $ap_location_id));
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
															'[SITE_URL]'			=>  $site_url,
															'[LOC_ID]' 				=>  $ap_location_id));
								
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email_php;
										$subject_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_admin_email_approved,$subject_admin_approved,$body_admin_approved,$from_admin_email);
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email;
										$subject_staff_approved = $notification_subject_staff_approved;
										$body_staff_approved = $notification_body_staff_approved;
										$from_staff_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_staff_email_approved,$subject_staff_approved,$body_staff_approved,$from_staff_email);
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
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
		//$client_name= $appointment_detail->client_name;
		$staff_member_id= $appointment_detail->staff_member;
		$staff_details=$wpdb->get_row("select * from $wpdb->prefix"."apt_staff WHERE id = '$staff_member_id' ");
		$staff_member_name= $staff_details->staff_member_name;
		$client_email= $appointment_detail->client_email;
		$staff_email= $appointment_detail->staff_email;
		//if client name is empty
		if(!empty($appointment_detail->client_name)){
			$client_name= $appointment_detail->client_name;
		}
		else{
			$client_name= $client_email;
		}

		$location_id= $appointment_detail->location_id;
			/*location info*/
		//$location_id = sanitize_text_field($_REQUEST['ap_location_id']);
		// $lo_info = $wpdb->prepare("select location_add from $location_table where id = '$location_id'");
		// $location_information = $wpdb->get_col($lo_info);
		// $ap_location_id = $location_information[0];
				/*location info*/
		$tablename = $wpdb->prefix . "apt_location";
		
		$lo_info = $wpdb->get_row("select * from $tablename where id = '$location_id'");
		$ap_location_id = $lo_info->location_add;
		
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
										'[SERVICE_NAME]' 	   => $service_name,
										'[APPOINTMENT_DATE]'   => $booking_date,
										'[APPOINTMENT_TIME]'   => $appointment_time,
										'[CLIENT_NAME]' 	   => $client_name,
										'[CLIENT_EMAIL]'       => $client_email,
										'[STAFF_NAME]'		   => $staff_member_name,
										'[APPOINTMENT_STATUS]' => 'approved',
										'[ADMIN_NAME]'		   => $admin_name,
										'[BLOG_NAME]'		   => $blog_name,
										'[SITE_URL]'		   => $site_url,
										'[LOC_ID]' 	           => $ap_location_id)
									);
															
									$temp_notification_body_client_approved = $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
										'[SERVICE_NAME]'		=> $service_name,
										'[APPOINTMENT_DATE]'	=> $booking_date,
										'[APPOINTMENT_TIME]'	=> $appointment_time,
										'[CLIENT_NAME]'			=> $client_name,
										'[CLIENT_EMAIL]'		=> $client_email,
										'[STAFF_NAME]'			=> $staff_member_name,
										'[APPOINTMENT_STATUS]'	=> 'approved',
										'[ADMIN_NAME]'			=> $admin_name,
										'[BLOG_NAME]'			=> $blog_name,
										'[SITE_URL]'			=> $site_url,
										'[LOC_ID]' 				=> $ap_location_id)
									);
								
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
								
								if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email ;
										$subject_notification_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_admin = wp_mail( $to_admin_email_approved, $subject_notification_admin_approved, $body_admin_approved, $from_admin_email );
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
								
								if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email ;
										$subject_notification_staff_approved = $notification_subject_staff_approved;
										$body_notification_staff_approved = $notification_body_staff_approved;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_staff = wp_mail( $to_staff_email_approved, $subject_notification_staff_approved, $body_notification_staff_approved, $from_admin_email );
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$to_client_email_approved = $client_email;
										$subject_client_approved = $notification_subject_client_approved;
										$body_client_approved = $notification_body_client_approved;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_approved = mail ($to_client_email_approved,$subject_client_approved,$body_client_approved,$from_admin_email);
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email_php;
										$subject_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_admin_email_approved,$subject_admin_approved,$body_admin_approved,$from_admin_email);
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email;
										$subject_staff_approved = $notification_subject_staff_approved;
										$body_staff_approved = $notification_body_staff_approved;
										$from_staff_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_staff_email_approved,$subject_staff_approved,$body_staff_approved,$from_staff_email);
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
															'[SITE_URL]'			=>  $site_url,
															'[LOC_ID]'			=>  $location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
															
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
															
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
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
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
															
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
/* Stripe status update and mail sending code */
/* check whether stripe token is not empty */
if(isset( $_POST['stripeToken'] ) && !empty($_POST['stripeToken'])){
	$token  			 = isset( $_POST['stripeToken'] ) ? $_POST['stripeToken'] : NULL;
    $name 			 	 = "testing account";
    $client_email 		 = isset( $_POST['wl-customer-Email'] ) ? $_POST['wl-customer-Email'] : NULL;
    $card_num 			 = isset( $_POST['customer_card'] ) ? $_POST['customer_card'] : NULL;
    $card_cvc 			 = isset( $_POST['customer_cvc'] ) ? $_POST['customer_cvc'] : NULL;
    $card_exp_month 	 = isset( $_POST['exp_month'] ) ? $_POST['exp_month'] : NULL;
    $card_exp_year  	 = isset( $_POST['exp_year'] ) ? $_POST['exp_year'] : NULL;
	
	$payable_amount_temp = isset( $_POST['ap_payment_amount'] ) ? $_POST['ap_payment_amount'] : 1000;
	$payable_amount 	 = intval($payable_amount_temp);
	$ap_payment_customer = isset( $_POST['ap_payment_customer'] ) ? $_POST['ap_payment_customer'] : NULL;
	$payment_unique_id 	 = isset( $_POST['payment_unique_id'] ) ? $_POST['payment_unique_id'] : NULL;
	$ap_location_id 	 = isset( $_POST['ap_location_id'] ) ? $_POST['ap_location_id'] : NULL;
	$service_name		 = isset( $_POST['ap_payment_service'] ) ? $_POST['ap_payment_service'] : NULL;
	$booking_date 		 = isset( $_POST['ap_payment_date'] ) ? $_POST['ap_payment_date'] : NULL;
	$appointment_time 	 = isset( $_POST['appointment_time'] ) ? $_POST['appointment_time'] : NULL;
	$client_name 		 = isset( $_POST['ap_payment_customer'] ) ? $_POST['ap_payment_customer'] : NULL;
	$staff_member_name 	 = isset( $_POST['ap_payment_staff'] ) ? $_POST['ap_payment_staff'] : NULL;
	$admin_name			 = isset( $_POST['ap_payment_staff'] ) ? $_POST['ap_payment_staff'] : "admin name";
	$blog_name			 = get_bloginfo( 'name' );
	$site_url			 = get_bloginfo( 'url' );
	$staff_email		 = isset( $_POST['ap_payment_staff_email'] ) ? $_POST['ap_payment_staff_email'] : "";
	$client_email_id 	 = isset( $_REQUEST['ap_email_notification'] ) ? $_REQUEST['ap_email_notification'] : "";
	$weblizar_payment_settings = get_option("weblizar_aps_payment_setting");	
	/* Stripe payment gateway info */

	$strip_pkey    = $weblizar_payment_settings['stripe_apikey'];
	$strip_skey    = $weblizar_payment_settings['stripe_secretkey'];
    //set api key
    $stripe = array(
      "secret_key"      => $strip_skey,
      "publishable_key" => $strip_pkey
    );
    
    \Stripe\Stripe::setApiKey($stripe['secret_key']);
	\Stripe\Stripe::setAppInfo("Appointment Scheduler Pro"); 

	/* add customer to stripe */
    $customer = \Stripe\Customer::create(array(
        'email'  => $client_email,
        'source' => $token
    ));
	
    /* item information */
	$itemName   = $ap_payment_customer;
	$itemNumber = $payment_unique_id;
	$itemPrice  = $payable_amount;
	$currency   = "usd";
	$orderID    = $payment_unique_id;

	/* charge a credit or a debit card */
    $charge = \Stripe\Charge::create(array(
        'customer' 	  => $customer->id,
        'amount'   	  => $itemPrice,
        'currency' 	  => $currency,
        'description' => $itemName,
        'metadata' 	  => array(
           'order_id' => $orderID
        )
    ));

    /* retrieve charge details */

    if($charge && $charge->captured){

    	/* order details */
        $amount 		     = $charge->amount;
        $balance_transaction = $charge->balance_transaction;
        $currency 			 = $charge->currency;
        $status_stripe 		 = $charge->status;
        $date 				 = date("Y-m-d H:i:s");

        if($status_stripe == 'succeeded'){
            $statusMsg = "<h2>The transaction was successful.</h2>";

            $appoint_update_id = $wpdb->get_var( "SELECT id FROM {$wpdb->prefix}apt_appointments WHERE appt_unique_id =  '$payment_unique_id'" );
			$wpdb->insert( $wpdb->prefix.'apt_payment',
				array( 
					'status' => 'approved',
					'payment_type' => 'stripe',
					'customer' => $client_name,
					'staff' => $staff_member_name,
					'appointment_date' => $booking_date,
					'amount' => number_format( $amount, 2, '.', '' ) . ' USD',
					'service' => $service_name,
					'customer_email' => $client_email_id,
					'appt_unique_id' => $payment_unique_id,
					'appoint_update_id' => $appoint_update_id
				)
			);
		$wpdb->update( $wpdb->prefix.'apt_appointments', array( 
			'status' => 'approved', 
			'payment_status' => 'approved', 
			),
				array( 'appt_unique_id' => $payment_unique_id )
			);	
			
			$notification_enable 	= $email_settings['enable'];
			$notification_emailtype = $email_settings['emailtype'];	
			/*print_r($email_settings);*/
			//WP MAIL
			//$to 	 = 'migssaxena@gmail.com';
			/*$to 	 = $client_email_id;
			$subject = 'The Stripe';
			$body 	 = 'Mail recieve after successful stripe payment 1156';
			$headers = array('Content-Type: text/html; charset=UTF-8');
			 
			wp_mail( $to, $subject, $body, $headers );*/
			$status = 'approved';
			stripe_mail_sending($payable_amount_temp,$payable_amount,$ap_payment_customer,$payment_unique_id,$ap_location_id,$service_name,$service_name,$booking_date,$appointment_time,$client_name,$staff_member_name,$admin_name,$blog_name,$site_url,$client_email_id,$staff_email, $status);
			?>
			<script>
				jQuery.notify("<?php _e('Payment Successfull', WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
			</script>		
			 <?php
				
        }else{
            //$statusMsg = "Transaction has been failed";
			$wpdb->update( $wpdb->prefix.'apt_payment', array( 
			'status' => 'pending', ),
				array( 'appt_unique_id' => $payment_unique_id )
			);
		$wpdb->update( $wpdb->prefix.'apt_appointments', array( 
			'status' => 'pending', 
			'payment_status' => 'failed', 
			),
				array( 'appt_unique_id' => $payment_unique_id )
			);
			
			$status = 'cancel';
			stripe_mail_sending($payable_amount_temp,$payable_amount,$ap_payment_customer,$payment_unique_id,$ap_location_id,$service_name,$service_name,$booking_date,$appointment_time,$client_name,$staff_member_name,$admin_name,$blog_name,$site_url,$client_email_id,$staff_email, $status);
			?>
				<script>
					jQuery.notify("<?php _e('Transaction has been failed', WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
				</script>		
			 <?php
        }
    }else{
        //$statusMsg = "Transaction has been failed";
		$wpdb->update( $wpdb->prefix.'apt_payment', array( 
			'status' => 'pending', ),
				array( 'appt_unique_id' => $payment_unique_id )
			);
		$wpdb->update( $wpdb->prefix.'apt_appointments', array( 
			'status' => 'pending', 
			'payment_status' => 'failed', 
			),
				array( 'appt_unique_id' => $payment_unique_id )
			);
			$status = 'cancel';
			stripe_mail_sending($payable_amount_temp,$payable_amount,$ap_payment_customer,$payment_unique_id,$ap_location_id,$service_name,$booking_date,$appointment_time,$client_name,$staff_member_name,$admin_name,$blog_name,$site_url,$client_email_id,$staff_email, $status);
		?>
		<script>
			jQuery.notify("<?php _e('Transaction has been failed', WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		</script>		
	 <?php
    }

  }

//PAYPAL PAYMENT CANCELLED - PENDING MAIL
if(isset($_GET['payment-status'])) {
	if($_GET['payment-status'] == "cancelled") {	
	$payment_item_id= $_GET['id'];
	/*change the status in appointment table*/
			$wpdb->update( $wpdb->prefix.'apt_payment', array( 
				'status' => 'cancel', ),
					array( 'appt_unique_id' => $payment_item_id )
				);
			$wpdb->update( $wpdb->prefix.'apt_appointments', array( 
				'status' => 'cancel', 
				'payment_status' => 'cancel', 
				),
					array( 'appt_unique_id' => $payment_item_id )
				);
	/*change the status in appointment table*/	
		
	
	$appointment_details=$wpdb->get_results("select * from $wpdb->prefix"."apt_appointments WHERE appt_unique_id='$payment_item_id'");
	foreach($appointment_details as $appointment_detail){
		$service_name= $appointment_detail->service_type;
		$ap_booking_date= $appointment_detail->booking_date;
		$start_time= $appointment_detail->start_time;
		$end_time= $appointment_detail->end_time;
		//$client_name= $appointment_detail->client_name;
		$staff_member_id= $appointment_detail->staff_member;
		$staff_details=$wpdb->get_row("select * from $wpdb->prefix"."apt_staff WHERE id = '$staff_member_id' ");
		$staff_member_name= $staff_details->staff_member_name;
		$client_email= $appointment_detail->client_email;
		$staff_email= $appointment_detail->staff_email;
		//if client name is empty
		if(!empty($appointment_detail->client_name)){
			$client_name= $appointment_detail->client_name;
		}
		else{
			$client_name= $client_email;
		}
		$location_id = $appointment_detail->location_id;
			/*location info*/
		//$location_id = sanitize_text_field($_REQUEST['ap_location_id']);
			/*location info*/
		 $tablename = $wpdb->prefix . "apt_location";
		
		$lo_info = $wpdb->get_row("select * from $tablename where id = '$location_id'");
		$ap_location_id = $lo_info->location_add;
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
							$notification_client_pending= $email_settings['send_notification_client_cancel'];
							if($notification_client_pending=="yes"){
									$temp_notification_subject_client_pending= $email_settings['body_notification_client_cancel'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_cancel'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
								
								if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
										$to_client_email_pending = $client_email ;
										$subject_client_pending = $notification_subject_client_pending;
										$body_client_pending = $notification_body_client_pending;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_client = wp_mail( $to_client_email_pending, $subject_client_pending, $body_client_pending, $from_admin_email );
									}
									
							}
							//ADMIN PENDING
							$notification_admin_pending= $email_settings['send_notification_admin_cancelled'];
							if($notification_admin_pending=="yes"){
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_cancelled'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_cancelled'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
								
								if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
										$to_admin_email_pending = $notification_admin_email ;
										$subject_notification_admin_pending = $notification_subject_admin_pending;
										$body_admin_pending = $notification_body_admin_pending;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_admin = wp_mail( $to_admin_email_pending, $subject_notification_admin_pending, $body_admin_pending, $from_admin_email );
								}	
							}
							//STAFF PENDING
							$notification_staff_pending= $email_settings['send_notification_staff_cancel'];
							if($notification_staff_pending=="yes"){
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_cancel'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_cancel'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
								
								if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$to_staff_email_pending = $staff_email ;
										$subject_notification_staff_pending = $notification_subject_staff_pending;
										$body_notification_staff_pending = $notification_body_staff_pending;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_staff = wp_mail( $to_staff_email_pending, $subject_notification_staff_pending, $body_notification_staff_pending, $from_admin_email );
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
									$temp_notification_subject_client_pending= $email_settings['subject_notification_client_cancel'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_cancel'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
										$to_client_email_pending = $client_email;
										$subject_client_pending = $notification_subject_client_pending;
										$body_client_pending = $notification_body_client_pending;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_client_email_pending,$subject_client_pending,$body_client_pending,$from_admin_email);
									}						
							}
							//ADMIN PENDING
							$notification_admin_pending= $email_settings['send_notification_admin_cancelled'];
							if($notification_admin_pending=="yes"){
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_cancelled'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_cancelled'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
										$to_admin_email_pending = $notification_admin_email_php;
										$subject_admin_pending = $notification_subject_admin_pending;
										$body_admin_pending = $notification_body_admin_pending;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_admin_email_pending,$subject_admin_pending,$body_admin_pending,$from_admin_email);
									}						
							}
							//STAFF PENDING
							$notification_staff_pending= $email_settings['send_notification_staff_cancel'];
							if($notification_staff_pending=="yes"){
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_cancel'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_cancel'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$to_staff_email_pending = $staff_email;
										$subject_staff_pending = $notification_subject_staff_pending;
										$body_staff_pending = $notification_body_staff_pending;
										$from_staff_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_staff_email_pending,$subject_staff_pending,$body_staff_pending,$from_staff_email);
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
							$notification_client_pending= $email_settings['send_notification_client_cancel'];
							if($notification_client_pending=="yes"){
									$temp_notification_subject_client_pending= $email_settings['subject_notification_client_cancel'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_cancel'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
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
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_cancelled'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_cancelled'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
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
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_cancel'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_cancel'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	'cancelled',
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
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

/* 
	* fetch user info to check profile is complete or not. 
	* if profile is not completed then show link and ask to complete.
*/
/*

											
				?>
		

*/

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

		/*Fetch data According to location*/
			$loc_data = $wpdb->get_results("select * from $location_table where id = '$location_id'");
			// to get location's category and service 			
			foreach($loc_data as $loc_cat){
				$loc_cat = unserialize($loc_cat->location_service_cat);
			}
			//to get service
			foreach($loc_data as $loc_service){
				$loc_service = unserialize($loc_service->location_service);
			}
			//to get location's status and related message
			$ap_fetch_location_based = $wpdb->get_results("SELECT `status`, `message` FROM $location_table WHERE `id` = $location_id ");
			//print_r($ap_fetch_location_based);
			$loc_based_data = $ap_fetch_location_based[0];
			$loc_status = $loc_based_data->status;
			$loc_message = $loc_based_data->message;			
			
		/*According to location End*/

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
					foreach($loc_data as $data_loc)	{
							$loc_detail = unserialize($data_loc->location_detail);
							$data       = $loc_detail;
							$biz_phone  = $data[1] ?? '';
							$biz_email  = $data[2] ?? '';
							$blog_title = $data[7] ?? '';
							$b_tag_line = $data[0] ?? '';
							$b_name     = $data[7] ?? '';
						?>	
							<!-- $ap_show_email = $loc_status = $data_loc->status; -->
						<?php
					}
					$biz_profile_default = get_option("weblizar_aps_bizprofile_setting");
					// Default name
					$b_name_default = $biz_profile_default['b_name'];
					//Default Blog Title
					$blog_title_default = get_bloginfo( 'name' ); 														
				?>
						
					<label class="app_business_name"><?php  if($b_name==""){ echo $b_name_default; } else{ echo $b_name; } ?></label><br>	
					<label class="app_business_name"><?php  if($b_tag_line==""){ echo $blog_title_default; } else{ echo $b_tag_line; } ?></label><br>	
					<?php  $current_date=date('d-m-Y');

					$current_day= date("D",strtotime($current_date));									
					if($current_day=="Mon"){
						$settings_bh_monday_st = get_option("weblizar_aps_business_$location_id");
						$monday                = unserialize($settings_bh_monday_st['bh_monday']);
						$start_time            = $monday[0]['start_time'] ?? '';
						$end_time              = $monday[0]['end_time'] ?? '';
					}
					if($current_day=="Tue"){
						$settings_bh_tuesday_st = get_option("weblizar_aps_business_$location_id");
						$tuesday                = unserialize($settings_bh_tuesday_st['bh_tuesday']);
						$start_time             = $tuesday[0]['start_time'] ?? '';
						$end_time               = $tuesday[0]['end_time'] ?? '';
					}
					if($current_day=="Wed"){
						$settings_bh_wednesday_st = get_option("weblizar_aps_business_$location_id");
						$wednesday                = unserialize($settings_bh_wednesday_st['bh_wednesday']);
						$start_time               = $wednesday[0]['start_time'] ?? '';
						$end_time                 = $wednesday[0]['end_time'] ?? '';
					}
					if($current_day=="Thu"){
						$settings_bh_thursday_st = get_option("weblizar_aps_business_$location_id");
						$thursday                = unserialize($settings_bh_thursday_st['bh_thursday']);
						$start_time              = $thursday[0]['start_time'] ?? '';
						$end_time                = $thursday[0]['end_time'] ?? '';
					}
					if($current_day=="Fri"){
						$settings_bh_friday_st = get_option("weblizar_aps_business_$location_id");
						$friday                = unserialize($settings_bh_friday_st['bh_friday'] ?? '');
						$start_time            = $friday[0]['start_time'] ?? '';
						$end_time              = $friday[0]['end_time'] ?? '';
					}
					if($current_day=="Sat"){
						$settings_bh_saturday_st = get_option("weblizar_aps_business_$location_id");
						$saturday                = unserialize($settings_bh_saturday_st['bh_saturday']);
						$start_time              = $saturday[0]['start_time'] ?? '';
						$end_time                = $saturday[0]['end_time'] ?? '';
					}
					if($current_day=="Sun"){
						$settings_bh_sunday_st = get_option("weblizar_aps_business_$location_id");
						$sunday                = unserialize($settings_bh_sunday_st['bh_sunday']);
						$start_time            = $sunday[0]['start_time'] ?? '';
						$end_time              = $sunday[0]['end_time'] ?? '';
					} 								
						$time_format = get_option( 'time_format' );
						$biz_st      = strtotime($start_time);
						$biz_et      = strtotime($end_time);
							
						$biz_start_time	=	date($time_format, $biz_st);
						$biz_end_time	=	date($time_format, $biz_et);
						
					
					?>
					<span class="bs_opening_hours"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo $biz_start_time; ?><?php  echo " - ".$biz_end_time; ?></span><br>
					<?php 					
						$appearence_ap_show_phone_no =get_option('appearance_general_settings');									
						$ap_show_phone_no	= $appearence_ap_show_phone_no['ap_show_phone_no'];
						$ap_phone_icon = $appearence_ap_show_phone_no['ap_phone_icon'];
						if($ap_show_phone_no=="yes"){ ?>
						<span class="phone_number_info"><i class="<?php  echo $ap_phone_icon; ?>"></i>&nbsp;<?php /* echo "&nbsp;".$biz_profile['b_phone']; */ echo "&nbsp;".$biz_phone; ?></span>
						<?php } 
						
						$appearence_ap_show_email = get_option('appearance_general_settings'); 
						$ap_email_icon	= $appearence_ap_show_email['ap_email_icon'];									
						$ap_show_email	= $appearence_ap_show_email['ap_show_email'];
						
						if($ap_show_email=="yes"){ ?>
							<span class="email_address_info"><i class="<?php  echo $ap_email_icon; ?>"></i>&nbsp;<?php  /*echo $biz_profile['b_email'];*/ echo $biz_email; ?></span>
						<?php } ?>
					
					
				</div>
				<div class="col-md-3 social-info">
					<ul class="social">
					<?php
						$appearence_ap_social_link = get_option('appearance_general_settings');										
						
						$ap_social_link1	= $appearence_ap_social_link['ap_social_link1'];								
						$ap_social_icon1	= $appearence_ap_social_link['ap_social_icon1'];
						
						$ap_social_link2	= $appearence_ap_social_link['ap_social_link2'];										
						$ap_social_icon2	= $appearence_ap_social_link['ap_social_icon2'];
						
						$ap_social_link3	= $appearence_ap_social_link['ap_social_link3'];
						$ap_social_icon3	= $appearence_ap_social_link['ap_social_icon3'];
						
						$ap_social_link4	= $appearence_ap_social_link['ap_social_link4'];
						$ap_social_icon4	= $appearence_ap_social_link['ap_social_icon4'];
						
						$ap_social_link5	= $appearence_ap_social_link['ap_social_link5'];
						$ap_social_icon5	= $appearence_ap_social_link['ap_social_icon5'];
						
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
		<?php
			if($loc_status == "close" || $loc_status == "vaction"){
				?>
		<div id="step0">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<p class="loc_message">
						<?php echo $loc_message; ?>
					</p>
				</div>
			</div>
		</div>
		<div id="step1" class="ap_class_active">
			<div class="row ap-steps">
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
					<div class="col-md-3 col-sm-6 ap-category">
						<label><?php _e('Services',WL_A_P_SYSTEM); ?></label>						
						 <select class="form-control " id="groups" name="service_name" >
							<option value='default'>--<?php _e('Select',WL_A_P_SYSTEM); ?>--</option>
							<?php
								$no_of_category = count($loc_cat);
								for($i = 0; $i<$no_of_category; $i++){
									$j = $loc_cat[$i];								
								$appointment_category_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_category where id= '$j'" );
								$settings_payment_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
								$payment_currency	= $settings_payment_currency['currency'];
								foreach($appointment_category_details as $appointment_category_single_detail){ ?>
									<optgroup label="<?php echo $appointment_category_single_detail->name;?>">
								
								<?php 
									$no_of_services = count($loc_service);
									for($k=0;$k<$no_of_services; $k++){
									 $m = $loc_service[$k];	
									$apt_shortcode_service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id= '$m' and category = '$j'");
									foreach($apt_shortcode_service_details as $appointment_service_single_detail){
								?>
									<option value="<?php echo $appointment_service_single_detail->id ?>"><?php echo $appointment_service_single_detail->name; ?></option>

								<?php
									}
								 }
								
								?>
								</optgroup>
								<?php
								}
							  }
							?>
						</select>
					</div>
					<div class="col-md-3 col-sm-6 ap-employee">
						<label><?php _e('Staff',WL_A_P_SYSTEM); ?></label>
						<select class="form-control staff" id="sub_groups"  name="staff_member"   >
							<option data-group='SHOW' value='0'>-- <?php _e('Select',WL_A_P_SYSTEM); ?> --</option>
								
						</select>
					</div>
					<div class="col-md-3 col-sm-6 ap-dates">
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
				<input type="hidden" class="ap_location_id" name="ap_location_id" id="ap_location_id" value="<?php echo $location_id;?>" />
			<?php $appearence_service_navigation_text = $wpdb->get_col( "SELECT service_navigation_text from $appearence_table" );
					$service_navigation_text	= $appearence_service_navigation_text[0]; ?>
				<button id="step1_next" type="button" class="btn step-right"><?php if (!empty($service_navigation_text)) {   echo __("$service_navigation_text", WL_A_P_SYSTEM); } else { _e("Next",WL_A_P_SYSTEM); } ?></button> 
			</div>
			</form>
		</div>

				<?php

			}
			else{
				?>
				<div id="step1">
					<div class="row ap-steps">
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
							<div class="col-md-3 col-sm-6 ap-category">
								<label><?php _e('Services',WL_A_P_SYSTEM); ?></label>						
								 <select class="form-control " id="groups" name="service_name" >
									<option value='default'>--<?php _e('Select',WL_A_P_SYSTEM); ?>--</option>
									<?php
										$no_of_category = count($loc_cat);
										for($i = 0; $i<$no_of_category; $i++){
											$j = $loc_cat[$i];								
										$appointment_category_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_category where id= '$j'" );
										$settings_payment_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
										$payment_currency	= $settings_payment_currency['currency'];
										foreach($appointment_category_details as $appointment_category_single_detail){ ?>
											<optgroup label="<?php echo $appointment_category_single_detail->name;?>">
										
										<?php 
											$no_of_services = count($loc_service);
											for($k=0;$k<$no_of_services; $k++){
											 $m = $loc_service[$k];	
											$apt_shortcode_service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id= '$m' and category = '$j'");
											foreach($apt_shortcode_service_details as $appointment_service_single_detail){
										?>
											<option value="<?php echo $appointment_service_single_detail->id ?>"><?php echo $appointment_service_single_detail->name; ?></option>

										<?php
											}
										 }
										
										?>
										</optgroup>
										<?php
										}
									  }
									?>
								</select>
							</div>
							<div class="col-md-3 col-sm-6 ap-employee">
								<label><?php _e('Staff',WL_A_P_SYSTEM); ?></label>
								<select class="form-control staff" id="sub_groups"  name="staff_member"   >
									<option data-group='SHOW' value='0'>-- <?php _e('Select',WL_A_P_SYSTEM); ?> --</option>
										
								</select>
							</div>
							<div class="col-md-3 col-sm-6 ap-dates">
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
						<input type="hidden" class="ap_location_id" name="ap_location_id" id="ap_location_id" value="<?php echo $location_id;?>" />
					<?php $appearence_service_navigation_text = $wpdb->get_col( "SELECT service_navigation_text from $appearence_table" );
							$service_navigation_text	= $appearence_service_navigation_text[0]; ?>
						<button id="step1_next" type="button" class="btn step-right"><?php if (!empty($service_navigation_text)) {   echo __("$service_navigation_text", WL_A_P_SYSTEM); } else { _e("Next",WL_A_P_SYSTEM); } ?></button> 
					</div>
					</form>
				</div>

				<?php
			}
		?>		
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
					<div class="row ap-steps">
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
	line-height: 70px;
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
<?php
	$staff_holidays = array();
	$get_staff_holiday = $wpdb->get_results( "SELECT * from $staff_table" );
	foreach($get_staff_holiday as $aa){
		$staff_record[] = array(
			'staff_id' => $aa->id,
			//$aa->id => 	"$aa->sun_all_off,$aa->mon_all_off,$aa->tue_all_off,$aa->wed_all_off,$aa->thu_all_off,$aa->fri_all_off,$aa->sat_all_off",
			'off' => 	"$aa->sun_all_off,$aa->mon_all_off,$aa->tue_all_off,$aa->wed_all_off,$aa->thu_all_off,$aa->fri_all_off,$aa->sat_all_off",
		);
	}
	// print_r($staff_record);

	foreach ($staff_record as $staff_ids => $staff_value) {
		$days_string = $staff_value['off'];
		$days_array = explode(',', $days_string);				
		foreach ($days_array as $k => $v) {
			array_push($staff_holidays, $v);
		}
		
	}
?>
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
	var all_staff_off_days = '<?php echo json_encode($all_staff_off_days ); ?>';
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
<?php 
function stripe_mail_sending($payable_amount_temp,$payable_amount,$ap_payment_customer,$payment_unique_id,$ap_location_id,$service_name,$booking_date,$appointment_time,$client_name,$staff_member_name,$admin_name,$blog_name,$site_url,$client_email,$staff_email,$status) {
global $wpdb;
//$client_email = "migssaxena@gmail";
$email_settings 		= get_option("Appoint_notification");
$notification_enable 	= $email_settings['enable'];
$notification_emailtype = $email_settings['emailtype'];
// $location_id = $appointment_detail->location_id;
// /*location info*/
// $tablename = $wpdb->prefix . "apt_location";

// $lo_info = $wpdb->get_row("select * from $tablename where id = '$location_id'");
// $ap_location_id = $lo_info->location_add;		

$admin_info = get_userdata(1);
$admin_name= $admin_info->first_name . " " . $admin_info->last_name;

$first_name =  $admin_info->first_name; 
$last_name  = $admin_info->last_name;
if (!empty($first_name) && !empty($last_name)){
	$admin_name= $admin_info->first_name . " " . $admin_info->last_name;
}
else{
	$admin_name = $admin_info->user_login;
}
		
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
										'[SERVICE_NAME]' 	   => $service_name,
										'[APPOINTMENT_DATE]'   => $booking_date,
										'[APPOINTMENT_TIME]'   => $appointment_time,
										'[CLIENT_NAME]' 	   => $client_name,
										'[CLIENT_EMAIL]'       => $client_email,
										'[STAFF_NAME]'		   => $staff_member_name,
										'[APPOINTMENT_STATUS]' => $status,
										'[ADMIN_NAME]'		   => $admin_name,
										'[BLOG_NAME]'		   => $blog_name,
										'[SITE_URL]'		   => $site_url,
										'[LOC_ID]' 	           => $ap_location_id)
									);
															
									$temp_notification_body_client_approved = $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
										'[SERVICE_NAME]'		=> $service_name,
										'[APPOINTMENT_DATE]'	=> $booking_date,
										'[APPOINTMENT_TIME]'	=> $appointment_time,
										'[CLIENT_NAME]'			=> $client_name,
										'[CLIENT_EMAIL]'		=> $client_email,
										'[STAFF_NAME]'			=> $staff_member_name,
										'[APPOINTMENT_STATUS]'	=> $status,
										'[ADMIN_NAME]'			=> $admin_name,
										'[BLOG_NAME]'			=> $blog_name,
										'[SITE_URL]'			=> $site_url,
										'[LOC_ID]' 				=> $ap_location_id)
									);
								
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
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
								
								if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email ;
										$subject_notification_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_admin = wp_mail( $to_admin_email_approved, $subject_notification_admin_approved, $body_admin_approved, $from_admin_email );
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
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
								
								if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email ;
										$subject_notification_staff_approved = $notification_subject_staff_approved;
										$body_notification_staff_approved = $notification_body_staff_approved;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_staff = wp_mail( $to_staff_email_approved, $subject_notification_staff_approved, $body_notification_staff_approved, $from_admin_email );
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
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$to_client_email_approved = $client_email;
										$subject_client_approved = $notification_subject_client_approved;
										$body_client_approved = $notification_body_client_approved;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_approved = mail ($to_client_email_approved,$subject_client_approved,$body_client_approved,$from_admin_email);
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
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'			=>	$admin_name,
										'[BLOG_NAME]'			=>	$blog_name,
										'[SITE_URL]'			=> $site_url,
										'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
										'[SERVICE_NAME]'		=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$booking_date,
										'[APPOINTMENT_TIME]'	=>	$appointment_time,
										'[CLIENT_NAME]'			=>	$client_name,
										'[CLIENT_EMAIL]'		=>	$client_email,
										'[STAFF_NAME]'			=>	$staff_member_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'			=>	$admin_name,
										'[BLOG_NAME]'			=>	$blog_name,
										'[SITE_URL]'			=> $site_url,
										'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$to_admin_email_approved = $notification_admin_email_php;
										$subject_admin_approved = $notification_subject_admin_approved;
										$body_admin_approved = $notification_body_admin_approved;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_admin_email_approved,$subject_admin_approved,$body_admin_approved,$from_admin_email);
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
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'			=>	$admin_name,
										'[BLOG_NAME]'			=>	$blog_name,
										'[SITE_URL]'			=> $site_url,
										'[LOC_ID]' 				=> $ap_location_id));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
										'[SERVICE_NAME]'		=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$booking_date,
										'[APPOINTMENT_TIME]'	=>	$appointment_time,
										'[CLIENT_NAME]'			=>	$client_name,
										'[CLIENT_EMAIL]'		=>	$client_email,
										'[STAFF_NAME]'			=>	$staff_member_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'			=>	$admin_name,
										'[BLOG_NAME]'			=>	$blog_name,
										'[SITE_URL]'			=> $site_url,
										'[LOC_ID]' 				=> $ap_location_id));
															
									if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$to_staff_email_approved = $staff_email;
										$subject_staff_approved = $notification_subject_staff_approved;
										$body_staff_approved = $notification_body_staff_approved;
										$from_staff_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_staff_email_approved,$subject_staff_approved,$body_staff_approved,$from_staff_email);
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
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=>  $site_url,
															'[LOC_ID]'			=>  $location_id));
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
															
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
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
															
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
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
															'[SERVICE_NAME]'		=>	$service_name,
															'[APPOINTMENT_DATE]'	=>	$booking_date,
															'[APPOINTMENT_TIME]'	=>	$appointment_time,
															'[CLIENT_NAME]'			=>	$client_name,
															'[CLIENT_EMAIL]'		=>	$client_email,
															'[STAFF_NAME]'			=>	$staff_member_name,
															'[APPOINTMENT_STATUS]'	=>	$status,
															'[ADMIN_NAME]'			=>	$admin_name,
															'[BLOG_NAME]'			=>	$blog_name,
															'[SITE_URL]'			=> $site_url,
															'[LOC_ID]'			=>  $location_id));
															
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

