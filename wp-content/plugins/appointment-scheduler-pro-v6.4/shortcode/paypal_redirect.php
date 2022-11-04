<?php
//IF PAYMENT TYPE SELECTED IS CASH
global $wpdb;
$email_settings= get_option("Appoint_notification");
$appearence_table =	$wpdb->prefix."apt_appearence";
$settings_table =	$wpdb->prefix."apt_settings";
$location_table = $wpdb->prefix."apt_location";
//PAYMENT TABLE
if(isset($_REQUEST['payment']))
{
		$id 				  = isset($_REQUEST['appoint_id']) ? $_REQUEST['appoint_id'] : 0;
		$payment 			  = sanitize_text_field( $_REQUEST['payment'] );
		$ap_payment_customer  = sanitize_text_field( $_REQUEST['ap_payment_customer'] );
		$ap_payment_staff     = sanitize_text_field( $_REQUEST['ap_payment_staff'] );
		$temp_date 			  = sanitize_text_field( $_REQUEST['ap_payment_date'] );
		$ap_payment_date 	  = date("Y-m-d", strtotime($temp_date));
		$ap_payment_service   = sanitize_text_field( $_REQUEST['ap_payment_service'] );
		$ap_payment_amount    = sanitize_text_field( $_REQUEST['ap_payment_amount'] );
		$ap_discount_amount   = sanitize_text_field( $_REQUEST['ap_discount_amount'] );
		$appoint_coupon 	  = sanitize_text_field( $_REQUEST['appoint_coupon'] );
		$client_email_address = sanitize_text_field( $_REQUEST['client_email_address'] );
		$payment_unique_id    = sanitize_text_field( $_REQUEST['payment_unique_id'] );
			/*location info*/
			if(!empty($_REQUEST['ap_location_id'])){
				$location_id = sanitize_text_field($_REQUEST['ap_location_id']);		
			}
			else{
				$location_id = 1;	
			}
		
		$lo_info = $wpdb->get_row("select * from $location_table where id = '$location_id'");
		// $wpdb->show_errors(); 
		// $wpdb->print_error();
		
		$last_appointment_id = get_user_meta( get_current_user_id(), 'last_appointment_id' );

		$wpdb->insert(
		$wpdb->prefix.'apt_payment',
		array(
				'payment_type' 			=> $payment,
				'customer' 				=> $ap_payment_customer,
				'customer_email' 		=> $client_email_address,
				'staff' 				=> $ap_payment_staff,
				'appointment_date' 		=> $ap_payment_date,
				'service' 				=> $ap_payment_service,
				'amount' 				=> $ap_payment_amount,
				'amount_after_discount' => $ap_discount_amount,
				'coupon_code_applied' 	=> $appoint_coupon,
				'status'			    => 'pending',
				'appt_unique_id' 		=> $payment_unique_id,
				'appoint_update_id'     => $last_appointment_id
			));
			// $wpdb->show_errors(); 
			// $wpdb->print_error();				
}
if(isset($_REQUEST['payment'])){	
	$ap_service_name = sanitize_text_field( $_REQUEST['ap_payment_service'] );
	$payment_type = sanitize_text_field( $_REQUEST['payment'] );
  if($payment_type == "Cash") {	
	$temp_date = sanitize_text_field( $_REQUEST['ap_payment_date'] );
	$booking_date = date("Y-m-d", strtotime($temp_date));
	$appt_start_time = sanitize_text_field( $_REQUEST['ap_booking_start_time'] );
	$temp_time = sanitize_text_field( $_REQUEST['ap_booking_end_time'] );
	//$ap_customer_name = sanitize_text_field( $_REQUEST['ap_payment_customer'] );
	$ap_staff_name = sanitize_text_field( $_REQUEST['ap_payment_staff'] );
	
	$admin_info = get_userdata(1);
    $admin_name = $admin_info->user_login;
	
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

	$client_email_address = sanitize_text_field( $_REQUEST['ap_email_notification'] );
	$ap_staff_email = sanitize_text_field( $_REQUEST['ap_payment_staff_email'] );
	//if client name is empty
	if(!empty(sanitize_text_field( $_REQUEST['ap_payment_customer'] ))){
		$ap_customer_name = sanitize_text_field( $_REQUEST['ap_payment_customer'] );
	}
	else{
		$ap_customer_name = $client_email_address;
	}
	
	$date_format = get_option( 'date_format' );
	$ap_booking_date=date($date_format, strtotime($booking_date));
	
	$time_format = get_option( 'time_format' );
	$temp_ap_start_time = strtotime($appt_start_time);
	$appt_st=	date($time_format, $temp_ap_start_time);
		
	$endTime = strtotime('+'.$temp_time, strtotime($appt_start_time));
	$ap_booking_end_time= date('H:i', $endTime);
		
		
	$temp_ap_end_time = strtotime($ap_booking_end_time);
	$appt_et=	date($time_format, $temp_ap_end_time);
		
	$ap_start_time= $appt_st . "-" . $appt_et;
	
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
															'[SERVICE_NAME]'	=>	$ap_service_name,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$ap_start_time,
															'[CLIENT_NAME]'	=>	$ap_customer_name,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_staff_name,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
															
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'	=>	$ap_service_name,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$ap_start_time,
															'[CLIENT_NAME]'	=>	$ap_customer_name,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_staff_name,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
								
								if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
										$to_client_email_pending = $client_email_address ;
										$subject_client_pending = $notification_subject_client_pending;
										$body_client_pending = $notification_body_client_pending;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_client = wp_mail( $to_client_email_pending, $subject_client_pending, $body_client_pending, $from_admin_email );
									}
									
							}
							//ADMIN PENDING
							$notification_admin_pending= $email_settings['send_notification_admin_pending'];
							if($notification_admin_pending=="yes"){
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_pending'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
								
								if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
										$to_admin_email_pending = $notification_admin_email ;
										$subject_notification_admin_pending = $notification_subject_admin_pending;
										$body_admin_pending = $notification_body_admin_pending;
										$from_admin_email = $notification_admin_email;
										$wp_mail_check_admin = wp_mail( $to_admin_email_pending, $subject_notification_admin_pending, $body_admin_pending, $from_admin_email );
									}	
							}
							//STAFF PENDING
							$notification_staff_pending= $email_settings['send_notification_staff_pending'];
							if($notification_staff_pending=="yes"){
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_pending'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
								
								if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$to_staff_email_pending = $ap_staff_email ;
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
									$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
										
									if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
										$to_client_email_pending = $client_email_address;
										$subject_client_pending = $notification_subject_client_pending;
										$body_client_pending = $notification_body_client_pending;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_client_email_pending,$subject_client_pending,$body_client_pending,$from_admin_email);
									}						
							}
							//ADMIN PENDING
							$notification_admin_pending= $email_settings['send_notification_admin_pending'];
							if($notification_admin_pending=="yes"){
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_pending'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
															
									if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
										$to_admin_email_pending = $notification_admin_email_php;
										$subject_admin_pending = $notification_subject_admin_pending;
										$body_admin_pending = $notification_body_admin_pending;
										$from_admin_email = $notification_admin_email_php;
										$mail_check_client_pending = mail ($to_admin_email_pending,$subject_admin_pending,$body_admin_pending,$from_admin_email);
									}						
							}
							//STAFF PENDING
							$notification_staff_pending= $email_settings['send_notification_staff_pending'];
							if($notification_staff_pending=="yes"){
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_pending'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
															
									if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$to_staff_email_pending = $ap_staff_email;
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
							$notification_client_pending= $email_settings['send_notification_client_pending'];
							if($notification_client_pending=="yes"){
									$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
															
									if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($client_email_address, 'Information');
										$mail->addAddress($client_email_address, 'Site Admin');     // Add a recipient
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
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
															
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
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
										'[SERVICE_NAME]'	=>	$ap_service_name,
										'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
										'[APPOINTMENT_TIME]'	=>	$ap_start_time,
										'[CLIENT_NAME]'	=>	$ap_customer_name,
										'[CLIENT_EMAIL]'	=>	$client_email_address,
										'[APPOINTMENT_STATUS]'	=>	'pending',
										'[STAFF_NAME]'	=>	$ap_staff_name,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url,
										'[LOC_ID]' => $ap_location_id));
															
									if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_smtp_email;                // SMTP username
										$mail->Password = $notification_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_smtp_port_no; 
										$mail->addReplyTo($ap_staff_email, 'Information');
										$mail->addAddress($ap_staff_email, 'Site Admin');     // Add a recipient
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
				
			}	?>
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
					<div class="col-md-2 col-sm-2 ap-step4 Details complete">
						<label><?php _e("Confirm",WL_A_P_SYSTEM); ?> </label>
						<span></span>
					</div>
					<?php 
						//$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
						$settings_accept_payment = get_option("weblizar_aps_payment_setting");
						$accept_payment	= $settings_accept_payment['accept_payment'];
				 
						if($accept_payment=="yes") {	?>
						<div class="col-md-2 col-sm-2 ap-step5 payment">
							<label><?php _e("Payment",WL_A_P_SYSTEM); ?></label>
							<span></span>
						</div>
						<?php } ?>
					<div class="col-md-2 col-sm-2 ap-step5 done active">
						<label><?php _e("Done",WL_A_P_SYSTEM); ?></label>
						<span></span>
					</div>
				</div>
			<!-- Step 6 -->
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
					
					
					<h4 class="ap-heading"><?php  echo "Booking Done" ;    ?></h4>
					<div class="row service-form">
						<p> <?php _e("Thank You! Your Booking Is Complete",WL_A_P_SYSTEM); ?> </p>
					</div>
					<?php } ?>
				</div>
			<!-- Step 6 -->			
			<?php
	} 
	 
}

?>