<?php
//ON LOGIN CHECK USER ALREADY EXIST OR NOT 
//ON REGISTER CREATE USER AS SUBSCRIBER
global $wpdb;
$appearence_table =	$wpdb->prefix."apt_appearence";

$staff_member 	 = isset($_REQUEST['staff'] ) ? $_REQUEST['staff'] :"";
$service 		 = isset($_REQUEST['service'] ) ? $_REQUEST['service'] :"";
$booking_st 	 = isset($_REQUEST['booking_st'] ) ? $_REQUEST['booking_st'] :"";
$apt_time_format = isset($_REQUEST['apt_time_format'] ) ? $_REQUEST['apt_time_format'] :"";

$login_email 	= isset( $_REQUEST['login_email'] ) ? $_REQUEST['login_email'] : "";	//login
$login_password = isset( $_REQUEST['login_password'] ) ? $_REQUEST['login_password'] : "";	//login

$client_email 	  = isset( $_REQUEST['client_email'] ) ? $_REQUEST['client_email'] : "";	//registeration
$appoint_username = isset( $_REQUEST['appoint_username'] ) ? $_REQUEST['appoint_username'] : "";	
$full_name 		  = isset( $_REQUEST['full_name'] ) ? $_REQUEST['full_name'] : "" ;	
$client_contact   = isset( $_REQUEST['client_contact'] ) ? $_REQUEST['client_contact'] : "";	
$skype_id 		  = isset( $_REQUEST['skype_id'] ) ? $_REQUEST['skype_id'] : "";	
$apt_date 		  = isset( $_REQUEST['apt_date'] ) ? $_REQUEST['apt_date'] : "";	
$first_name 	  = isset( $_REQUEST['first_name'] ) ? $_REQUEST['first_name'] : "";	
$last_name 		  = isset( $_REQUEST['last_name'] ) ? $_REQUEST['last_name'] : "" ;	
$appoint_notes 	  = isset( $_REQUEST['appoint_notes'] ) ? $_REQUEST['appoint_notes'] : "" ;	
$client_password  = isset( $_REQUEST['client_password'] ) ? $_REQUEST['client_password'] : "" ;	
$ap_location_id   = isset( $_REQUEST['ap_location_id'] ) ? $_REQUEST['ap_location_id'] : "";

$date_format 	  = get_option( 'date_format' );
$appt_date_format = date($date_format, strtotime($apt_date));
											
$time_format 		   = get_option( 'time_format' ); 
$temp_time_slot_format = strtotime($booking_st);
$time_slot_format 	   = date($time_format, $temp_time_slot_format);
$current_id 		   = isset( $_REQUEST['current_id'] ) ? $_REQUEST['current_id']: "";

//LOGIN ACCOUNT
 if(isset($_REQUEST['login_email'])) { 
	$client = get_user_by( 'email',$login_email);	
	if (!empty( $client )) {
		$user_password = $client->user_pass;		
		require_once( ABSPATH . WPINC . '/class-phpass.php');
		$wp_hasher = new PasswordHash(8, TRUE);
				
		if($wp_hasher->CheckPassword($login_password, $user_password)) { ?>
			<script>
				<?php
					$client_first_name = $client->first_name;
					$client_last_name  = $client->last_name;
					$client_user_email = $client->user_email;
					$client_username   = $client->user_login;
				?>
				
				jQuery.notify("<?php _e('Login Successfull',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
						
				document.getElementById('client_username_detail').innerHTML = '<strong><?php _e("Username",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' +  '<?php echo $client_username;?>';
				document.getElementById('client_fullname_detail').innerHTML = '<strong><?php _e("Name",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $client_first_name;?><?php echo " ".$client_last_name;?>';
				document.getElementById('client_email_detail').innerHTML = '<strong><?php _e("Email Id",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' + '<?php echo $client_user_email;?>';
					
				jQuery('.ap_payment_customer').val('<?php echo $client_first_name;?><?php echo " ".$client_last_name;?>');
				document.getElementById('date_detail').innerHTML = '<strong><?php _e("Date",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo date_i18n("$date_format", strtotime($appt_date_format));?>';
				document.getElementById('time_detail').innerHTML = '<strong><?php _e("Appointment Time",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $apt_time_format;?>';
					
				jQuery('.client_email_address').val('<?php echo $client_user_email;?>');
					
				<?php $clients_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_clients where email='$login_email'");
				foreach($clients_details as $clients_detail){
					$client_contact =$clients_detail->phone; 
					$skype_id =$clients_detail->skype_id; ?>
					document.getElementById('client_contact_detail').innerHTML = '<strong><?php _e("Contact No",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' + '<?php echo $client_contact;?>';
					jQuery('.ap_client_contact_detail').val('<?php echo $client_contact;?>');
					document.getElementById('client_skype_detail').innerHTML = '<strong><?php _e("Skype Id",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' + '<?php echo $skype_id;?>';
				<?php  } ?>
				jQuery('.ap_email_notification').val('<?php echo $login_email; ?>');
				jQuery('.ap_payment_date').val(appointment_date);
				jQuery('.ap_staff_id').val(appointment_staff);	
				jQuery('.appoint_staff_id').val(appointment_staff);	
				jQuery('.ap_location_id').val(ap_location_id);
				<?php $staff_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_staff where id='$staff_member'" );
				foreach($staff_details as $staff_detail){	
					$staff_id=$staff_detail->id; 
					$staff_name=$staff_detail->staff_member_name;
					$staff_email=$staff_detail->staff_email;?>
						
						document.getElementById('staff_detail').innerHTML = '<strong><?php _e("Staff Member",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $staff_name;?>';
						jQuery('.ap_payment_staff').val('<?php echo $staff_name;?>');
						jQuery('.ap_payment_staff_email').val('<?php echo $staff_email;?>');
				<?php } ?>
				<?php $service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
					foreach($service_details as $service_detail){	
						$service_id=$service_detail->id; 
						$service_name=$service_detail->name;
						$service_price=$service_detail->price;
						$service_duration=$service_detail->duration;
						$service_p_before=$service_detail->p_before;
						$service_p_after=$service_detail->p_after;
						$service_type=$service_detail->service_type;
						$service_duration_with_padding = $service_duration + $service_p_before;
												
						$settings_table =	$wpdb->prefix."apt_settings";
						$settings_payment_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
						$payment_currency	= $settings_payment_currency['currency'];?>
						
						
						<?php if($service_type=='free_service'){	?>
							
							 jQuery("#appt_confirm").show();
							 jQuery("#payment_confirm").hide();
							<?php	
					   }else{ ?>
						   
							jQuery("#appt_confirm").hide();
							 jQuery("#payment_confirm").show();
						   
					   <?php } ?>		
						document.getElementById('service_detail').innerHTML = '<strong><?php _e("Name",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $service_name;?>';
						document.getElementById('service_price').innerHTML = '<strong><?php _e("Price",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $service_price." ".$payment_currency;?>';
						
						<?php
						$settings_service_duration_type = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT service_duration_type from $settings_table" ); 
						$service_duration_type	= $settings_service_duration_type['service_duration_type'];
						if($service_duration_type=='sd'){	?>
							document.getElementById('service_duration').innerHTML = '<strong><?php _e("Duration",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $service_duration;?><?php echo "minutes";?>' ;
							<?php 
						} else{ ?>
							document.getElementById('service_duration').innerHTML = '<strong><?php _e("Duration",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $service_duration_with_padding;?><?php echo "minutes";?>' ;
							<?php 
						} ?>
						
						jQuery('.ap_booking_end_time').val('<?php echo $service_duration;?><?php echo " minutes";?>');
						jQuery('.ap_payment_service').val('<?php echo $service_name;?>');
		
													
						jQuery('.ap_payment_amount').val('<?php echo $service_price;?><?php if ($payment_currency==""){echo ' USD';} else{ echo ' '.$payment_currency;} ?>');
						jQuery('#c_service_price').val('<?php echo $service_price;?>');
						jQuery('.service_tag').text('<?php echo $service_name;?>');
						jQuery('.service_price_tag').text('<?php echo $service_price;?><?php if ($payment_currency==""){echo ' USD';} else{ echo ' '.$payment_currency;} ?>');
					<?php } ?>
						jQuery('.ap_booking_start_time').val('<?php echo $booking_st;?>');
						jQuery('.ap_payment_service_id').val('<?php echo $service;?>');
			</script>
			<style type="text/css">
			<?php
				if ( empty( $skype_id ) ) {
					?>
					#client_skype_detail {
						display: none;
					}
					<?php
				}
			?>				
			</style>
			<form style="margin-bottom: 0;" action="" method="POST" id="confirm_appointment" name="confirm_appointment">
				<div class="col-md-12 col-sm-12 ap-steps">
					<div class="col-md-2 col-sm-2 ap-step1 services complete">
						<label><?php _e("Services",WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
					<div class="col-md-2 col-sm-2 ap-step2 time complete">
						<label><?php _e("Time",WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
					<div class="col-md-2 col-sm-2 ap-step3 time complete">
						<label><?php _e("Details",WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
					<div class="col-md-2 col-sm-2 ap-step4 Details active">
						<label><?php _e("Confirm",WL_A_P_SYSTEM); ?> </label>
						<span></span>
					</div>
					<?php //$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
					$settings_accept_payment = get_option('weblizar_aps_payment_setting');
					$accept_payment	= $settings_accept_payment['accept_payment'];
			 
					if($accept_payment=="yes") {	?>
					<div class="col-md-2 col-sm-2 ap-step5 payment">
						<label><?php _e("Payment",WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
					<?php } ?>
					<div class="col-md-2 col-sm-2 ap-step6 done">
						<label><?php _e("Done",WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
				</div>
				<!-- Step 4 -->
				<div  id="4" class="ap-steps-detail5">
					<div class="row">
						<div class="col-md-6 col-sm-6">
						<h4 class="ap-heading"><?php _e("Service Detail",WL_A_P_SYSTEM); ?></h4>
							<p id="service_detail"></p>
							<p id="service_price"></p>
							<p id="service_duration"></p>
							<p id="staff_detail"></p>
							<p id="time_detail"> </p>
							<p id="date_detail"></p>
						</div>
						<div class="col-md-6 col-sm-6">
							<h4 class="ap-heading"><?php _e("User Detail",WL_A_P_SYSTEM); ?></h4>
								<p id="client_username_detail"></p>
								<p id="client_fullname_detail"></p>
								<p id="client_contact_detail"></p>
								<p id="client_email_detail"></p>
								<p id="client_skype_detail"></p>
						</div>
					</div>
					<input type="hidden" class="ap_email_notification" name="ap_email_notification">
					<input type="hidden" class="ap_payment_customer" name="ap_payment_customer"/>
					<input type="hidden" class="ap_payment_staff" name="ap_payment_staff"/>
					<input type="hidden" class="ap_payment_date" name="ap_payment_date"/>
					<input type="hidden" class="ap_payment_service" name="ap_payment_service"/>
					<input type="hidden" class="ap_payment_amount" name="ap_payment_amount"/>
					<input type="hidden" class="ap_payment_staff_email" name="ap_payment_staff_email"/>
					<input type="hidden" class="ap_client_contact_detail" name="ap_client_contact_detail">
					<input type="hidden" class="appoint_staff_id" name="appoint_staff_id">
					<input type="hidden" class="ap_booking_start_time" name="ap_booking_start_time">
					<input type="hidden" class="ap_booking_end_time" name="ap_booking_end_time">
					<input type="hidden" class="client_email_address" name="client_email_address">
					<input type="hidden" class="appoint_unique_id" name="appoint_unique_id" value="<?php echo uniqid(); ?>">
					<input type="hidden" class="ap_payment_service_id" name="ap_payment_service_id"/>
					<input type="hidden" class="ap_location_id" name="ap_location_id" value="<?php echo $ap_location_id; ?>" />
					
					<?php
					global $wpdb;
					$settings_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
					$currency_value = $settings_currency['currency'];

					if($currency_value !=="INR"){
						function convertCurrency($amount, $from, $to){
							$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
							$data = file_get_contents($url);

							preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
							$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
							return round($converted, 3);
						}
						
							$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
							foreach($service_details as $service_detail){	
								$service_price=$service_detail->price;
								$convertCurrency= convertCurrency($service_price, $currency_value, "INR");
							}
							$razorpay_conversion=  round($convertCurrency);  
							$razorpay_amount=  $razorpay_conversion * 100 ;  ?>
							<input type="hidden" class="razorpay_amount" name="razorpay_amount" value="<?php echo $razorpay_amount; ?>">
							<?php
					}else{
						$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
						foreach($service_details as $service_detail){	
							$service_price=$service_detail->price;	
							$service_price_conversion= $service_price * 100;?>
							<input type="hidden" class="razorpay_amount" name="razorpay_amount" value="<?php echo $service_price_conversion; ?>">
							<?php
						}
					}
				?>	
				<div style="display:none" class="col-md-12 col-sm-12 confirm-link" id="payment_confirm">
					<?php												 
						 $settings_app_confirm_payment = $wpdb->get_col( "SELECT p_confirm_message_box from $appearence_table" );
						 $p_confirm_message_box = $settings_app_confirm_payment[0];
					?>
					<p>
					<strong><?php echo $p_confirm_message_box; ?></strong>
					</p>
				</div>
				<div style="display:none" class="col-md-12 col-sm-12 confirm-link" id="appt_confirm">
					<p>
					<strong><?php _e("Do you want to confirm Appointment",WL_A_P_SYSTEM); ?> ? </strong>
					</p>
				</div>
				<?php  $confirm_editor_content= get_option("confirm_tips");
					if (!empty($confirm_editor_content)) {	?>
						<div class="col-md-12 step-description">
							<ul> <?php echo "<pre class='pre_bg' style='display:block !important;'>".$confirm_editor_content."</pre>"; ?>  </ul>
						</div>
				<?php } ?>
				
				</div>
				<!-- Step 4 -->
				<div class="ap-step-link">
					<?php $appearence_confirm_navigation_text_backward = $wpdb->get_col( "SELECT confirm_navigation_text_backward from $appearence_table" );
						$confirm_navigation_text_backward	= $appearence_confirm_navigation_text_backward[0]; 
								
						$appearence_confirm_navigation_text_forward = $wpdb->get_col( "SELECT confirm_navigation_text_forward from $appearence_table" );
						$confirm_navigation_text_forward	= $appearence_confirm_navigation_text_forward[0]; ?>
					<a id="stepback4" href="#step3" onclick="return step4_back();" class="btn step-left" data-toggle="tab" aria-expanded="false"><?php if (!empty($confirm_navigation_text_backward)) {  echo __("$confirm_navigation_text_backward",WL_A_P_SYSTEM); } else { echo __("Back",WL_A_P_SYSTEM); } ?></a>
					<button id="stepnext4" name="stepnext4" href="#step5" type="button" onclick="return step4_next();" class="btn step-right"><?php if (!empty($confirm_navigation_text_forward)) { echo __("$confirm_navigation_text_forward", WL_A_P_SYSTEM); } else { echo __("Next",WL_A_P_SYSTEM); } ?></button> 
				</div>
			</form>
					<?php
			}else {
			?>
			<script>
					jQuery.notify("Invalid Password", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
			</script>
			<div class="col-md-12 col-sm-12 ap-steps">
				<div class="col-md-2 col-sm-2 ap-step1 services complete">
					<label><?php _e("Services",WL_A_P_SYSTEM); ?></label>
						<span></span>
				</div>
				<div class="col-md-2 col-sm-2 ap-step2 time complete">
					<label><?php _e("Time",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
				<div class="col-md-2 col-sm-2 ap-step3 time active">
					<label><?php _e("Details",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
				<div class="col-md-2 col-sm-2 ap-step4 Details">
					<label><?php _e("Confirm",WL_A_P_SYSTEM); ?> </label>
					<span></span>
				</div>
				<?php //$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
						$settings_accept_payment = get_option('weblizar_aps_payment_setting');
						$accept_payment	= $settings_accept_payment['accept_payment'];
					 
				if($accept_payment=="yes") {	?>
				<div class="col-md-2 col-sm-2 ap-step5 payment">
					<label><?php _e("Payment",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
				<?php } ?>
				<div class="col-md-2 col-sm-2 ap-step6 done">
					<label><?php _e("Done",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
			</div>
						
			<div class="col-md-12 col-sm-12 step3-form">
				<center><p><?php _e('You have entered invalid Password',WL_A_P_SYSTEM); ?>,<?php _e('Please Try Again',WL_A_P_SYSTEM); ?> </center><br><center><?php _e('Thank You', WL_A_P_SYSTEM); ?></center></p>
			</div>		
			<?php  $detail_editor_content= get_option("details_tips");
			if (!empty($detail_editor_content)) {	?>
				<div class="row step-description">
					<div><?php echo "<pre class='pre_bg' style='display:block !important;'>".$detail_editor_content."</pre>"; ?></div> 
				</div>
			<?php } ?> 
			<div class="ap-step-link">
				<a id="stepnext2"  onclick="return step2_next();" class="btn step-right" data-toggle="tab" aria-expanded="false"><?php  _e("Try Again",WL_A_P_SYSTEM); ?></a>
			</div>				
		
		
			<?php }
	}else{	?>
						<script>
								jQuery.notify("<?php _e('Email Does Not Exist',WL_A_P_SYSTEM); ?>.", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
						</script>
						<div class="col-md-12 col-sm-12 ap-steps">
							<div class="col-md-2 col-sm-2 ap-step1 services complete">
								<label><?php _e("Services",WL_A_P_SYSTEM); ?></label>
									<span></span>
							</div>
							<div class="col-md-2 col-sm-2 ap-step2 time complete">
								<label><?php _e("Time",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
							<div class="col-md-2 col-sm-2 ap-step3 time active">
								<label><?php _e("Details",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
							<div class="col-md-2 col-sm-2 ap-step4 Details">
								<label><?php _e("Confirm",WL_A_P_SYSTEM); ?> </label>
								<span></span>
							</div>
							<?php //$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
							$settings_accept_payment = get_option('weblizar_aps_payment_setting');
							$accept_payment	= $settings_accept_payment['accept_payment'];
								 
							if($accept_payment=="yes") {	?>
							<div class="col-md-2 col-sm-2 ap-step5 payment">
								<label><?php _e("Payment",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
							<?php } ?>
							<div class="col-md-2 col-sm-2 ap-step6 done">
								<label><?php _e("Done",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
						</div>
						
						<div class="col-md-12 col-sm-12 step3-form">
							<center><p><?php _e('Email Does Not Exist',WL_A_P_SYSTEM); ?>,<?php _e('Please Register Your Account',WL_A_P_SYSTEM); ?></center><br><center><?php _e('Thank You',WL_A_P_SYSTEM); ?></center></p>
						</div>		
						<?php  $detail_editor_content= get_option("details_tips");
						if (!empty($detail_editor_content)) {	?>
							<div class="row step-description">
								<div><?php echo "<pre class='pre_bg' style='display:block !important;'>".$detail_editor_content."</pre>"; ?></div> 
							</div>
						<?php } ?> 
						<div class="ap-step-link">
							<a id="stepnext2"  onclick="return step2_next();" class="btn step-right" data-toggle="tab" aria-expanded="false"><?php _e("Try Again",WL_A_P_SYSTEM); ?></a>
						</div>
		<?php
	}
} ?>

 <?php
//if user is already login wp-admin
 if(isset($_REQUEST['current_id'])){
	$current_id = $_REQUEST['current_id'];
	$client = get_user_by( 'id',$current_id);
	if (!empty($client)) {
		$client_first_name=$client->first_name;
		$client_last_name=$client->last_name;
		$client_user_email=$client->user_email;
		$client_username = $client->user_login;
		$clients_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_clients where email='$client_user_email'");
			if(count($clients_details) == 0){				 
				$wpdb->insert(
				$wpdb->prefix.'apt_clients',
				array(
						'first_name'=>$client_first_name,
						'last_name' => $client_last_name,						
						'email' 	=> $client_user_email						
					));
			}
	?>
		<script>
		//alert("<?php echo 'loginfile'.$ap_location_id; ?>");
			document.getElementById('client_username_detail').innerHTML = '<strong><?php _e("Username",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' +  '<?php echo $client_username;?>';
			document.getElementById('client_fullname_detail').innerHTML = '<strong><?php _e("Name",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $client_first_name;?><?php echo " ".$client_last_name;?>';
			document.getElementById('client_email_detail').innerHTML = '<strong><?php _e("Email Id",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' + '<?php echo $client_user_email;?>';
				
			jQuery('.ap_payment_customer').val('<?php echo $client_first_name;?><?php echo " ".$client_last_name;?>');
			document.getElementById('date_detail').innerHTML = '<strong><?php _e("Date",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo date_i18n("$date_format", strtotime($appt_date_format));?>';
			document.getElementById('time_detail').innerHTML = '<strong><?php _e("Appointment Time",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $apt_time_format;?>';
				
			jQuery('.client_email_address').val('<?php echo $client_user_email;?>');

			<?php 
			$clients_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_clients where email='$client_user_email'");

			foreach($clients_details as $clients_detail){
				$client_contact =$clients_detail->phone; 
				$skype_id =$clients_detail->skype_id; ?>
				document.getElementById('client_contact_detail').innerHTML = '<strong><?php _e("Contact No",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' + '<?php echo $client_contact;?>';
				jQuery('.ap_client_contact_detail').val('<?php echo $client_contact;?>');
				document.getElementById('client_skype_detail').innerHTML = '<strong><?php _e("Skype Id",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' + '<?php echo $skype_id;?>';
				<?php 
				 } 
				?>
				jQuery('.ap_email_notification').val('<?php echo $client_user_email; ?>');
				jQuery('.ap_payment_date').val(appointment_date);
				jQuery('.ap_staff_id').val(appointment_staff);	
				jQuery('.appoint_staff_id').val(appointment_staff);	
				//jQuery('.ap_location_id').val(ap_location_id);
				<?php $staff_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_staff where id='$staff_member'" );
				foreach($staff_details as $staff_detail){	
					$staff_id=$staff_detail->id; 
					$staff_name=$staff_detail->staff_member_name;
					$staff_email=$staff_detail->staff_email;?>
						
						document.getElementById('staff_detail').innerHTML = '<strong><?php _e("Staff Member",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $staff_name;?>';
						jQuery('.ap_payment_staff').val('<?php echo $staff_name;?>');
						jQuery('.ap_payment_staff_email').val('<?php echo $staff_email;?>');
				<?php } ?>
				<?php $service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
					foreach($service_details as $service_detail){	
						$service_id=$service_detail->id; 
						$service_name=$service_detail->name;
						$service_price=$service_detail->price;
						$service_duration=$service_detail->duration;
						$service_p_before=$service_detail->p_before;
						$service_p_after=$service_detail->p_after;
						$service_type=$service_detail->service_type;
						$service_duration_with_padding = $service_duration + $service_p_before;
												
						$settings_table =	$wpdb->prefix."apt_settings";
						$settings_payment_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
						$payment_currency	= $settings_payment_currency['currency'];?>
						
						
						<?php if($service_type=='free_service'){	?>
							
							 jQuery("#appt_confirm").show();
							 jQuery("#payment_confirm").hide();
							<?php	
					   }else{ ?>
						   
							jQuery("#appt_confirm").hide();
							 jQuery("#payment_confirm").show();
						   
					   <?php } ?>
						
						
											
						document.getElementById('service_detail').innerHTML = '<strong><?php _e("Name",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $service_name;?>';
						document.getElementById('service_price').innerHTML = '<strong><?php _e("Price",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $service_price." ".$payment_currency;?>';
						
						
						<?php
						$settings_service_duration_type = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT service_duration_type from $settings_table" ); 
						$service_duration_type	= $settings_service_duration_type['service_duration_type'];
						if($service_duration_type=='sd'){	?>
							document.getElementById('service_duration').innerHTML = '<strong><?php _e("Duration",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $service_duration;?><?php echo "minutes";?>' ;
							<?php 
						} else{ ?>
							document.getElementById('service_duration').innerHTML = '<strong><?php _e("Duration",WL_A_P_SYSTEM); ?> : &nbsp;</strong>' + '<?php echo $service_duration_with_padding;?><?php echo "minutes";?>' ;
							<?php 
						} ?>
						
						jQuery('.ap_booking_end_time').val('<?php echo $service_duration;?><?php echo " minutes";?>');
						jQuery('.ap_payment_service').val('<?php echo $service_name;?>');
		
													
						jQuery('.ap_payment_amount').val('<?php echo $service_price;?><?php if ($payment_currency==""){echo ' USD';} else{ echo ' '.$payment_currency;} ?>');
						jQuery('#c_service_price').val('<?php echo $service_price;?>');
						jQuery('.service_tag').text('<?php echo $service_name;?>');
						jQuery('.service_price_tag').text('<?php echo $service_price;?><?php if ($payment_currency==""){echo ' USD';} else{ echo ' '.$payment_currency;} ?>');
					<?php } ?>
						jQuery('.ap_booking_start_time').val('<?php echo $booking_st;?>');
						jQuery('.ap_payment_service_id').val('<?php echo $service;?>');
		</script>
		<style type="text/css">
			<?php
				if ( empty( $skype_id ) ) {
					?>
					#client_skype_detail {
						display: none;
					}
					<?php
				}
			?>				
			</style>
		<form style="margin-bottom: 0;" action="" method="POST" id="confirm_appointment" name="confirm_appointment">
						<div class="col-md-12 col-sm-12 ap-steps">
							<div class="col-md-2 col-sm-2 ap-step1 services complete">
								<label><?php _e("Services",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
							<div class="col-md-2 col-sm-2 ap-step2 time complete">
								<label><?php _e("Time",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
							<div class="col-md-2 col-sm-2 ap-step3 time complete">
								<label><?php _e("Details",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
							<div class="col-md-2 col-sm-2 ap-step4 Details active">
								<label><?php _e("Confirm",WL_A_P_SYSTEM); ?> </label>
								<span></span>
							</div>
							<?php //$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
							$settings_accept_payment = get_option('weblizar_aps_payment_setting');
							$accept_payment	= $settings_accept_payment['accept_payment'];
					 
							if($accept_payment=="yes") {	?>
							<div class="col-md-2 col-sm-2 ap-step5 payment">
								<label><?php _e("Payment",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
							<?php } ?>
							<div class="col-md-2 col-sm-2 ap-step6 done">
								<label><?php _e("Done",WL_A_P_SYSTEM); ?></label>
								<span></span>
							</div>
						</div>
						<!-- Step 4 -->
						<div  id="4" class="ap-steps-detail5">
							<div class="row">
								<div class="col-md-6 col-sm-6">
								<h4 class="ap-heading"><?php _e("Service Detail",WL_A_P_SYSTEM); ?></h4>
									<p id="service_detail"></p>
									<p id="service_price"></p>
									<p id="service_duration"></p>
									<p id="staff_detail"></p>
									<p id="time_detail"> </p>
									<p id="date_detail"></p>
								</div>
								<div class="col-md-6 col-sm-6">
									<h4 class="ap-heading"><?php _e("User Detail",WL_A_P_SYSTEM); ?></h4>
										<p id="client_username_detail"></p>
										<p id="client_fullname_detail"></p>
										<p id="client_contact_detail"></p>
										<p id="client_email_detail"></p>
										<p id="client_skype_detail"></p>
								</div>
							</div>
								<input type="hidden" class="ap_email_notification" name="ap_email_notification">
								<input type="hidden" class="ap_payment_customer" name="ap_payment_customer"/>
								<input type="hidden" class="ap_payment_staff" name="ap_payment_staff"/>
								<input type="hidden" class="ap_payment_date" name="ap_payment_date"/>
								<input type="hidden" class="ap_payment_service" name="ap_payment_service"/>
								<input type="hidden" class="ap_payment_amount" name="ap_payment_amount"/>
								<input type="hidden" class="ap_payment_staff_email" name="ap_payment_staff_email"/>
								<input type="hidden" class="ap_client_contact_detail" name="ap_client_contact_detail">
								<input type="hidden" class="appoint_staff_id" name="appoint_staff_id">
								<input type="hidden" class="ap_booking_start_time" name="ap_booking_start_time">
								<input type="hidden" class="ap_booking_end_time" name="ap_booking_end_time">
								<input type="hidden" class="client_email_address" name="client_email_address" >
								<input type="hidden" class="appoint_unique_id" name="appoint_unique_id" value="<?php echo uniqid(); ?>">
								<input type="hidden" class="ap_payment_service_id" name="ap_payment_service_id"/>
								<input type="hidden" class="ap_location_id" name="ap_location_id" value="<?php echo $ap_location_id; ?>" />
										
						<?php
							global $wpdb;
							$settings_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
							$currency_value = $settings_currency['currency'];

							if($currency_value !=="INR"){
								function convertCurrency($amount, $from, $to){
									$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
									$data = file_get_contents($url);

									preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
									$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
									return round($converted, 3);
								}
								
									$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
									foreach($service_details as $service_detail){	
										$service_price=$service_detail->price;
										$convertCurrency= convertCurrency($service_price, $currency_value, "INR");
									}
									$razorpay_conversion=  round($convertCurrency);  
									$razorpay_amount=  $razorpay_conversion * 100 ;  ?>
									<input type="hidden" class="razorpay_amount" name="razorpay_amount" value="<?php echo $razorpay_amount; ?>">
									<?php
							}else{
								$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
								foreach($service_details as $service_detail){	
									$service_price=$service_detail->price;	
									$service_price_conversion= $service_price * 100;?>
									<input type="hidden" class="razorpay_amount" name="razorpay_amount" value="<?php echo $service_price_conversion; ?>">
									<?php
								}
							}
						?>
											
						<div style="display:none" class="col-md-12 col-sm-12 confirm-link" id="payment_confirm">
							<?php												 
								 $settings_app_confirm_payment = $wpdb->get_col( "SELECT p_confirm_message_box from $appearence_table" );
								 $p_confirm_message_box = $settings_app_confirm_payment[0];
							?>
							<p>
							<strong><?php echo $p_confirm_message_box; ?></strong>
							</p>
						</div>
						<div style="display:none" class="col-md-12 col-sm-12 confirm-link" id="appt_confirm">
							<p>
							<strong><?php _e("Do you want to confirm Appointment",WL_A_P_SYSTEM); ?> ? </strong>
							</p>
						</div>
						<?php  $confirm_editor_content= get_option("confirm_tips");
							if (!empty($confirm_editor_content)) {	?>
								<div class="col-md-12 step-description">
									<ul> <?php echo "<pre class='pre_bg' style='display:block !important;'>".$confirm_editor_content."</pre>"; ?>  </ul>
								</div>
						<?php } ?> 
					
					</div>
					<!-- Step 4 -->
					<div class="ap-step-link">
						<?php $appearence_confirm_navigation_text_backward = $wpdb->get_col( "SELECT confirm_navigation_text_backward from $appearence_table" );
							$confirm_navigation_text_backward	= $appearence_confirm_navigation_text_backward[0]; 
									
							$appearence_confirm_navigation_text_forward = $wpdb->get_col( "SELECT confirm_navigation_text_forward from $appearence_table" );
							$confirm_navigation_text_forward	= $appearence_confirm_navigation_text_forward[0]; ?>
						<a id="stepback4" href="#step2" onclick="return step4_back();" class="btn step-left" data-toggle="tab" aria-expanded="false"><?php if (!empty($confirm_navigation_text_backward)) {  echo __("$confirm_navigation_text_backward",WL_A_P_SYSTEM); } else { echo __("Back",WL_A_P_SYSTEM); } ?></a>
						<button id="stepnext4" name="stepnext4" href="#step5" type="button" onclick="return step4_next();" class="btn step-right"><?php if (!empty($confirm_navigation_text_forward)) { echo __("Next", WL_A_P_SYSTEM); } else { echo __("Next",WL_A_P_SYSTEM); } ?></button> 
					</div>
				</form>
		<?php
	}
	

}







//REGISTER CUSTOMER AND ADD SUBSCRIBER
  if(isset($_REQUEST['client_email']))
{	


$user_reg_email = get_user_by( 'email',$client_email);
if (empty($user_reg_email)) {

	$wpdb->insert(
	$wpdb->prefix.'apt_clients',
	array(
			'first_name'=>$first_name,
			'last_name' => $last_name,
			'phone' => $client_contact,
			'skype_id' => $skype_id,
			'email' 	=> $client_email,
			'notes' 	=> $appoint_notes,
		));


		$user_data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'user_pass' => $client_password,
			'user_email' => $client_email,
			'user_login' => $client_email,
			
			'role' => 'subscriber' // Use default role or another role, e.g. 'editor'
		);
			$user_id = wp_insert_user( $user_data );
			wp_set_current_user( $user_id );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $client_email );
			add_action( 'admin_init', 'wp_insert_user' );
?>	
<script>
			<?php $settings_table =	$wpdb->prefix."apt_settings";
				$settings_payment_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
				$payment_currency	= $settings_payment_currency['currency'];
				$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
					foreach($service_details as $service_detail){	
						$service_id=$service_detail->id; 
						$service_name=$service_detail->name;
						$service_price=$service_detail->price;
						$service_duration=$service_detail->duration;
						$service_p_before=$service_detail->p_before;
						$service_p_after=$service_detail->p_after;
						$service_type=$service_detail->service_type;
						
						$service_duration_with_padding = $service_duration + $service_p_before;
						
						$settings_service_duration_type = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT service_duration_type from $settings_table" ); 
						$service_duration_type	= $settings_service_duration_type['service_duration_type'];
						
						if($service_duration_type=='sd'){	?>		
							document.getElementById('service_duration').innerHTML = '<strong><?php _e("Duration",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $service_duration;?><?php echo " minutes";?>' ;
							<?php 
						} else{ ?>
							
							document.getElementById('service_duration').innerHTML = '<strong><?php _e("Duration",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $service_duration_with_padding;?><?php echo " minutes";?>' ;
						<?php } ?>
						
						<?php if($service_type=='free_service'){	?>
							
							 jQuery("#appt_confirm").show();
							 jQuery("#payment_confirm").hide();
							<?php	
					   }else{ ?>
						   
							jQuery("#appt_confirm").hide();
							 jQuery("#payment_confirm").show();
						   
					   <?php } ?>
								jQuery('#c_service_price').val('<?php echo $service_price;?>');
								jQuery('.ap_payment_amount').val('<?php echo $service_price;?><?php if ($payment_currency==""){echo ' USD';} else{ echo ' '.$payment_currency;} ?>');
								document.getElementById('service_detail').innerHTML = '<strong><?php _e("Name",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $service_name;?>';
								document.getElementById('service_price').innerHTML = '<strong><?php _e("Price",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $service_price;?><?php if ($payment_currency==""){echo ' USD';} else{ echo ' '.$payment_currency;} ?>';
								jQuery('.ap_booking_end_time').val('<?php echo $service_duration;?><?php echo " minutes";?>');
								jQuery('.ap_payment_service').val('<?php echo $service_name;?>');
					
					<?php } ?>
					<?php $staff_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_staff where id='$staff_member'" );
					foreach($staff_details as $staff_detail){	
						$staff_id=$staff_detail->id; 
						$staff_name=$staff_detail->staff_member_name;
						$staff_email=$staff_detail->staff_email;?>
								jQuery('.ap_payment_staff_email').val('<?php echo $staff_email;?>');
								document.getElementById('staff_detail').innerHTML = '<strong><?php _e("Staff Member",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $staff_name;?>';
								jQuery('.ap_payment_staff').val('<?php echo $staff_name;?>');
					<?php } ?>
					
					
					document.getElementById('date_detail').innerHTML = '<strong><?php _e("Date",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $appt_date_format;?>';
					document.getElementById('time_detail').innerHTML = '<strong><?php _e("Appointment Time",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $apt_time_format;?>';
					
					jQuery('.ap_booking_start_time').val('<?php echo $booking_st;?>');
					jQuery('.ap_email_notification').val('<?php echo $client_email; ?>');
					jQuery('.ap_payment_customer').val('<?php echo $full_name;?>');
					
					jQuery('.ap_payment_date').val('<?php echo $apt_date; ?>');
					jQuery('.ap_staff_id').val('<?php echo $staff_member; ?>');
					jQuery('.appoint_staff_id').val('<?php echo $staff_member; ?>');
					document.getElementById('client_username_detail').innerHTML = '<strong><?php _e("Username",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' + '<?php echo $appoint_username;?>';
					document.getElementById('client_fullname_detail').innerHTML = '<strong><?php _e("Name",WL_A_P_SYSTEM); ?>: &nbsp;</strong>' +  '<?php echo $full_name;?>';
					document.getElementById('client_email_detail').innerHTML = '<strong><?php _e("Email Id",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' +  '<?php echo $client_email;?>';
					jQuery('.client_email_address').val(appointment_client_email);
					document.getElementById('client_contact_detail').innerHTML = '<strong><?php _e("Contact No",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' +  '<?php echo $client_contact;?>';
					jQuery('.ap_client_contact_detail').val(appointment_client_contact);
					document.getElementById('client_skype_detail').innerHTML = '<strong><?php _e("Skype Id",WL_A_P_SYSTEM); ?>.: &nbsp;</strong>' + '<?php echo $skype_id;?>';
					
					jQuery('.ap_payment_service_id').val('<?php echo $service;?>');					
			</script>
			<style type="text/css">
			<?php
				if ( empty( $skype_id ) ) {
					?>
					#client_skype_detail {
						display: none;
					}
					<?php
				}
			?>				
			</style>
<form style="margin-bottom: 0;" action="" method="POST" id="confirm_appointment" name="confirm_appointment">
									<div class="col-md-12 col-sm-12 ap-steps">
										<div class="col-md-2 col-sm-2 ap-step1 services complete">
											<label><?php _e("Services",WL_A_P_SYSTEM); ?></label>
											<span></span>
										</div>
										<div class="col-md-2 col-sm-2 ap-step2 time complete">
											<label><?php _e("Time",WL_A_P_SYSTEM); ?></label>
											<span></span>
										</div>
										<div class="col-md-2 col-sm-2 ap-step3 time complete">
											<label><?php _e("Details",WL_A_P_SYSTEM); ?></label>
											<span></span>
										</div>
										<div class="col-md-2 col-sm-2 ap-step4 Details active">
											<label><?php _e("Confirm",WL_A_P_SYSTEM); ?> </label>
											<span></span>
										</div>
										<?php //$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
										$settings_accept_payment = get_option('weblizar_aps_payment_setting');
										$accept_payment	= $settings_accept_payment['accept_payment'];
								 
										if($accept_payment=="yes") {	?>
										<div class="col-md-2 col-sm-2 ap-step5 payment">
											<label><?php _e("Payment",WL_A_P_SYSTEM); ?></label>
											<span></span>
										</div>
										<?php } ?>
										<div class="col-md-2 col-sm-2 ap-step6 done">
											<label><?php _e("Done",WL_A_P_SYSTEM); ?></label>
											<span></span>
										</div>
									</div>
									<!-- Step 4 -->
									<div  id="4" class="ap-steps-detail5">
										<div class="row">
											<div class="col-md-6 col-sm-6">
											<h4 class="ap-heading"><?php _e("Service Detail",WL_A_P_SYSTEM); ?></h4>
												<p id="service_detail"></p>
												<p id="service_price"></p>
												<p id="service_duration"></p>
												<p id="staff_detail"></p>
												<p id="time_detail"> </p>
												<p id="date_detail"></p>
											</div>
											<div class="col-md-6 col-sm-6">
											<h4 class="ap-heading"><?php _e("User Detail",WL_A_P_SYSTEM); ?></h4>
													<p id="client_username_detail"></p>
													<p id="client_fullname_detail"></p>
													<p id="client_contact_detail"></p>
													<p id="client_email_detail"></p>
													<p id="client_skype_detail"></p>
											</div>
										</div>
										<input type="hidden" class="ap_email_notification" name="ap_email_notification">
										<input type="hidden" class="ap_payment_customer" name="ap_payment_customer"/>
										<input type="hidden" class="ap_payment_staff" name="ap_payment_staff"/>
										<input type="hidden" class="ap_payment_date" name="ap_payment_date"/>
										<input type="hidden" class="ap_payment_service" name="ap_payment_service"/>
										<input type="hidden" class="ap_payment_amount" name="ap_payment_amount"/>
										<input type="hidden" class="ap_payment_staff_email" name="ap_payment_staff_email"/>
										<input type="hidden" class="ap_client_contact_detail" name="ap_client_contact_detail">
										<input type="hidden" class="appoint_staff_id" name="appoint_staff_id">
										<input type="hidden" class="ap_booking_start_time" name="ap_booking_start_time">
										<input type="hidden" class="ap_booking_end_time" name="ap_booking_end_time">
										<input type="hidden" class="client_email_address" name="client_email_address">
										<input type="hidden" class="appoint_unique_id" name="appoint_unique_id" value="<?php echo uniqid(); ?>">
										<input type="hidden" class="ap_payment_service_id" name="ap_payment_service_id"/>
										<input type="hidden" class="ap_location_id" name="ap_location_id" id="ap_location_id" value="<?php echo $ap_location_id; ?>" />		
													
										<?php
										global $wpdb;
										$settings_currency = get_option('weblizar_aps_general_setting'); //$wpdb->get_col( "SELECT currency from $settings_table" ); 
										$currency_value = $settings_currency['currency'];

											if($currency_value !=="INR"){
											function convertCurrency($amount, $from, $to){
												$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
												$data = file_get_contents($url);

												preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
												$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
												return round($converted, 3);
											}
											
											$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
												foreach($service_details as $service_detail){	
													$service_price=$service_detail->price;
													$convertCurrency= convertCurrency($service_price, $currency_value, "INR");
												}
												$razorpay_conversion=  round($convertCurrency);  
												$razorpay_amount=  $razorpay_conversion * 100 ;  
												?>
												<input type="hidden" class="razorpay_amount" name="razorpay_amount" value="<?php echo $razorpay_amount; ?>">
												<?php
											}else{
												$service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services where id='$service'");
												foreach($service_details as $service_detail){	
													$service_price=$service_detail->price;	
													$service_price_conversion= $service_price * 100;
													?>
												<input type="hidden" class="razorpay_amount" name="razorpay_amount" value="<?php echo $service_price_conversion; ?>">
											<?php	}
											}
										?>
										<div style="display:none" class="col-md-12 col-sm-12 confirm-link" id="payment_confirm">
											<p>
											<strong><?php _e("Do you want to confirm payment",WL_A_P_SYSTEM); ?> ? </strong>
											</p>
										</div>
										<div style="display:none" class="col-md-12 col-sm-12 confirm-link" id="appt_confirm">
											<p>
											<strong><?php _e("Do you want to confirm Appointment",WL_A_P_SYSTEM); ?> ? </strong>
											</p>
										</div>
								<?php  $confirm_editor_content= get_option("confirm_tips");
									if (!empty($confirm_editor_content)) {	?>
										<div class="col-md-12 step-description">
											<ul> <?php echo "<pre class='pre_bg' style='display:block !important;'>".$confirm_editor_content."</pre>"; ?>  </ul>
										</div>
								<?php } ?> 
								
								</div>
									<!-- Step 4 -->
									<div class="ap-step-link">
									<?php $appearence_confirm_navigation_text_backward = $wpdb->get_col( "SELECT confirm_navigation_text_backward from $appearence_table" );
											$confirm_navigation_text_backward	= $appearence_confirm_navigation_text_backward[0]; 
													
											$appearence_confirm_navigation_text_forward = $wpdb->get_col( "SELECT confirm_navigation_text_forward from $appearence_table" );
											$confirm_navigation_text_forward	= $appearence_confirm_navigation_text_forward[0]; ?>
										<a id="stepback4" href="#step3" onclick="return step4_back();" class="btn step-left" data-toggle="tab" aria-expanded="false"><?php if (!empty($confirm_navigation_text_backward)) {  echo $confirm_navigation_text_backward; } else { _e('Back',WL_A_P_SYSTEM) ; } ?></a>
										<button id="stepnext4" name="stepnext4" href="#step5" type="button" onclick="return step4_next();" class="btn step-right"><?php if (!empty($confirm_navigation_text_forward)) { echo $confirm_navigation_text_forward; } else { _e('Next',WL_A_P_SYSTEM); } ?></button> 
									
									</div>
								</form>
		<!-- Step 4 -->
		 
<?php	}	
		else{	?>
								<script>
										jQuery.notify("Email Already Registered.", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
								</script>
								<div class="col-md-12 col-sm-12 ap-steps">
									<div class="col-md-2 col-sm-2 ap-step1 services complete">
										<label><?php _e("Services",WL_A_P_SYSTEM); ?></label>
											<span></span>
									</div>
									<div class="col-md-2 col-sm-2 ap-step2 time complete">
										<label><?php _e("Time",WL_A_P_SYSTEM); ?></label>
										<span></span>
									</div>
									<div class="col-md-2 col-sm-2 ap-step3 time active">
										<label><?php _e("Details",WL_A_P_SYSTEM); ?></label>
										<span></span>
									</div>
									<div class="col-md-2 col-sm-2 ap-step4 Details">
										<label><?php _e("Confirm",WL_A_P_SYSTEM); ?> </label>
										<span></span>
									</div>
									<?php //$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
									$settings_accept_payment = get_option('weblizar_aps_payment_setting');
										$accept_payment	= $settings_accept_payment['accept_payment'];
								 
										if($accept_payment=="yes") {	?>
										<div class="col-md-2 col-sm-2 ap-step5 payment">
											<label><?php _e("Payment",WL_A_P_SYSTEM); ?></label>
											<span></span>
										</div>
										<?php } ?>
									<div class="col-md-2 col-sm-2 ap-step6 done">
										<label><?php _e("Done",WL_A_P_SYSTEM); ?></label>
										<span></span>
									</div>
								</div>
								
								<div class="col-md-12 col-sm-12 step3-form">
									<center><p><?php _e('The Email You Entered is already registered with us',WL_A_P_SYSTEM); ?>,<?php _e('Please Login Your Account',WL_A_P_SYSTEM); ?> .</center><center><?php _e('Thank You',WL_A_P_SYSTEM); ?></center></p>
								</div>		
								<?php  $detail_editor_content= get_option("details_tips");
								if (!empty($detail_editor_content)) {	?>
									<div class="row step-description">
										<div><?php echo "<pre class='pre_bg' style='display:block !important;'>".$detail_editor_content."</pre>"; ?></div> 
									</div>
								<?php } ?> 
								<div class="ap-step-link">
									<a id="stepnext2"  onclick="return step2_next();" class="btn step-right" data-toggle="tab" aria-expanded="false"><?php _e('Try Again',WL_A_P_SYSTEM);  ?></a>
								</div>
				<?php
		}

}
 ?>	  