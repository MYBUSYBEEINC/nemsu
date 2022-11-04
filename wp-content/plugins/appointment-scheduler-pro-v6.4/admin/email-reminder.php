<?php
//EMAIL REMINDER 

global $wpdb;
$settings_table =	$wpdb->prefix."apt_settings";
$appointment_table =	$wpdb->prefix."apt_appointments";
$staff_table =	$wpdb->prefix."apt_staff";
$reminder_table =	$wpdb->prefix."apt_reminder";
$email_settings= get_option("Appoint_notification");
$email_reminder_settings= get_option("Appoint_reminder_notification");

$settings_reminder_time = $wpdb->get_col( "SELECT reminder_time from $settings_table" ); 
$reminder_time	= $settings_reminder_time[0];

$settings_enable_reminder = $wpdb->get_col( "SELECT enable_reminder from $settings_table" ); 
$enable_reminder	= $settings_enable_reminder[0];

if($enable_reminder=="yes")
{
	
	$reminder_frequency = date("Y-m-d", strtotime("+$reminder_time day"));
	$appointment_details=$wpdb->get_results("select * from $appointment_table WHERE booking_date='$reminder_frequency' AND `status` = 'approved'");
	foreach($appointment_details as $appointment_single_detail)
	{
		
			// check if already reminder sent but failure
		$reminder_filter = $wpdb->get_row( "SELECT * FROM $reminder_table WHERE app_id = $appointment_single_detail->id" );
		if($reminder_filter->status == 'failure')
		{
			$reminder_retries = $reminder_filter->retries + 1;
		}
		
			//get service details
		$service_name = $appointment_single_detail->	service_type;
		
			//get client details
		$client_email = $appointment_single_detail->client_email;
		$client_name = $appointment_single_detail->client_name;
		
			//get staff details
		$temp_staff_name = $wpdb->get_col("SELECT staff_member_name FROM $staff_table WHERE `id` = $appointment_single_detail->staff_member"); 
		$staff_name	= $temp_staff_name[0];
		
      //$staff_name = $wpdb->get_row("SELECT * FROM $staff_table WHERE `id` = '$appointment_single_detail->staff_member' ");
		
			//get appointment status
		$appt_status = $appointment_single_detail->status;
		
			//date & time format
		$date_format = get_option( 'date_format' );
		$time_format = get_option( 'time_format' ); 
		
			//blog name
		$blog_name =  get_bloginfo();
		
			//site url
		$site_url=get_site_url();
		
			//admin info
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
		
			//check appointment repeatation
		if($appointment_single_detail->repeat_appointment == 'Non') 
		{
			
				//appointment date
			$ap_booking_date= $appointment_single_detail->booking_date;
			$appointment_booking_date=date($date_format, strtotime($ap_booking_date));
			
				//appointment time
			$start_time= $appointment_single_detail->start_time;
			$end_time= $appointment_single_detail->end_time;
			$temp_ap_start_time = strtotime($start_time);
			$appt_start_time=	date($time_format, $temp_ap_start_time);
			$temp_ap_end_time = strtotime($end_time);
			$appt_end_time=	date($time_format, $temp_ap_end_time);
			
			$appointment_time= $appt_start_time . "-" . $appt_end_time;
			
			$notification_enable= $email_settings['enable'];
			$notification_emailtype= $email_settings['emailtype'];
			if($notification_enable =="yes" ){ 
				
				if(!$reminder_filter || $reminder_filter->status != 'success')
				{	
					
					$temp_subject_reminder= $email_reminder_settings['subject_notification_reminder'];
					$subject_reminder =  strtr($temp_subject_reminder, array( 
						'[CLIENT_NAME]'	=>	$client_name,
						'[CLIENT_EMAIL]'	=>	$client_email,
						'[STAFF_NAME]'	=>	$staff_name,
						'[SERVICE_NAME]'	=>	$service_name,
						'[APPOINTMENT_TIME]'	=>	$appointment_time,
						'[APPOINTMENT_STATUS]'	=>	$appt_status,
						'[BLOG_NAME]'	=>	$blog_name,
						'[ADMIN_NAME]'	=>	$admin_name,
						'[SITE_URL]'	 => $site_url,
						'[APPOINTMENT_DATE]'	 => $appointment_booking_date)); 
					
					$temp_body_reminder= $email_reminder_settings['body_notification_reminder'];
					$body_reminder =  strtr($temp_body_reminder, array( 
						'[CLIENT_NAME]'	=>	$client_name,
						'[CLIENT_EMAIL]'	=>	$client_email,
						'[STAFF_NAME]'	=>	$staff_name,
						'[SERVICE_NAME]'	=>	$service_name,
						'[APPOINTMENT_TIME]'	=>	$appointment_time,
						'[APPOINTMENT_STATUS]'	=>	$appt_status,
						'[BLOG_NAME]'	=>	$blog_name,
						'[ADMIN_NAME]'	=>	$admin_name,
						'[SITE_URL]'	 => $site_url,
						'[APPOINTMENT_DATE]'	 => $appointment_booking_date)); 
					
					
					
            //SMTP MAIL
					if($notification_emailtype=="smtp"){
						
						$notification_smtp_hostname= $email_settings['hostname'];
						$notification_smtp_port_no= $email_settings['portno'];
						$notification_smtp_email= $email_settings['smtpemail'];
						$notification_smtp_password= $email_settings['password'];
						
						if($notification_smtp_hostname !=="" && $notification_smtp_port_no !=="" &&  $notification_smtp_email !=="" &&  $notification_smtp_password !==""){
							if($subject_reminder !=="" &&  $body_reminder !==""){
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
									$mail->Subject = $subject_reminder;
									$mail->Body    = '<pre>'.$body_reminder.'</pre>';
									$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
									
									if(!$mail->send()) {
										if($reminder_filter)
										{
											// update reminder failure
											$wpdb->query("UPDATE `$reminder_table` SET `status` = 'failure', `retries` = '$reminder_retries' WHERE `id` = '$reminder_filter->id'; ");
										}
										else if(!$reminder_filter || $reminder_filter->status != 'success')
										{
											// insert reminder failure
											$wpdb->query("INSERT INTO `$reminder_table` (`id`, `app_id`, `reminder_type`, `reminder_client_name`, `reminder_client_email`,`status`, `retries`, `error`, `time_date`) VALUES (NULL, '$appointment_single_detail->id', 'email', '$appointment_single_detail->client_name',  '$appointment_single_detail->client_email', 'failure', '1', '$mail->ErrorInfo', CURRENT_TIMESTAMP);");
										}
									} 
									else 
									{
										if($reminder_filter)
										{
											// update reminder success
											$wpdb->query("UPDATE `$reminder_table` SET `status` = 'success', `retries` = '$reminder_retries' WHERE `id` = '$reminder_filter->id'; ");
										}
										else
										{
											// insert reminder success
											$wpdb->query("INSERT INTO `$reminder_table` (`id`, `app_id`, `reminder_type`, `reminder_client_name`, `reminder_client_email`, `status`, `retries`, `error`, `time_date`) VALUES (NULL, '$appointment_single_detail->id', 'email', '$appointment_single_detail->client_name',  '$appointment_single_detail->client_email', 'success', '1', '$mail->ErrorInfo', CURRENT_TIMESTAMP);");
										}
									}
								}
							}
						}	
						
						//PHP MAIL
						if($notification_emailtype=="phpmail"){
							
							$notification_admin_php_email= $email_settings['phpemail'];
							if($notification_admin_php_email !==""){
								
								if($subject_reminder !=="" &&  $body_reminder !==""){
									
									$to_client_email_reminder = $client_email;
									$subject_client_reminder = $subject_reminder;
									$body_client_reminder = $body_reminder;
									$from_admin_email = $notification_admin_php_email;
									$mail_check_client_reminder = mail ($to_client_email_reminder,$subject_client_reminder,$body_client_reminder,$from_admin_email);
									
									if(!$mail_check_client_reminder) {   
										if($reminder_filter)
										{
														// update reminder failure
											$wpdb->query("UPDATE `$reminder_table` SET `status` = 'failure', `retries` = '$reminder_retries' WHERE `id` = '$reminder_filter->id'; ");
										}
										else if(!$reminder_filter || $reminder_filter->status != 'success')
										{
														// insert reminder failure
											$wpdb->query("INSERT INTO `$reminder_table` (`id`, `app_id`, `reminder_type`, `reminder_client_name`, `reminder_client_email`, `status`, `retries`, `error`, `time_date`) VALUES (NULL, '$appointment_single_detail->id', 'email',  '$appointment_single_detail->client_name',  '$appointment_single_detail->client_email' , 'failure', '1', 'ErrorInfo', CURRENT_TIMESTAMP);");
										}
									} else
									{
										if($reminder_filter)
										{
											// update reminder success
											$wpdb->query("UPDATE `$reminder_table` SET `status` = 'success', `retries` = '$reminder_retries' WHERE `id` = '$reminder_filter->id'; ");
										}
										else
										{
											// insert reminder success
											$wpdb->query("INSERT INTO `$reminder_table` (`id`, `app_id`, `reminder_type`, `reminder_client_name`, `reminder_client_email`, `status`, `retries`, `error`, `time_date`) VALUES (NULL, '$appointment_single_detail->id', 'email',  '$appointment_single_detail->client_name',  '$appointment_single_detail->client_email' ,'success', '1', 'ErrorInfo', CURRENT_TIMESTAMP);");
										}
										
									}
								}
							}
						}
						//WP MAIL
						if($notification_emailtype=="wpmail"){
							$notification_admin_wp_email= $email_settings['wpemail'];
							if($notification_admin_wp_email !==""){
								if($subject_reminder !=="" &&  $body_reminder !==""){
									$to_client_email_pending = $client_email ;
									$subject_client_pending = $subject_reminder;
									$body_client_pending = $body_reminder;
									$from_admin_email = $notification_admin_wp_email;
									$wp_appt_reminder = wp_mail( $to_client_email_pending, $subject_client_pending, $body_client_pending, $from_admin_email );
									
									if(!$wp_appt_reminder) {   
										if($reminder_filter)
										{
											// update reminder failure
											$wpdb->query("UPDATE `$reminder_table` SET `status` = 'failure', `retries` = '$reminder_retries' WHERE `id` = '$reminder_filter->id'; ");
										}
										else if(!$reminder_filter || $reminder_filter->status != 'success')
										{
											// insert reminder failure
											$wpdb->query("INSERT INTO `$reminder_table` (`id`, `app_id`, `reminder_type`, `reminder_client_name`, `reminder_client_email`, `status`, `retries`, `error`, `time_date`) VALUES (NULL, '$appointment_single_detail->id', 'email', $appointment_single_detail->client_name',  '$appointment_single_detail->client_email',  'failure', '1', 'ErrorInfo', CURRENT_TIMESTAMP);");
										}
									} 
									else 
									{
										if($reminder_filter)
										{
											// update reminder success
											$wpdb->query("UPDATE `$reminder_table` SET `status` = 'success', `retries` = '$reminder_retries' WHERE `id` = '$reminder_filter->id'; ");
										}
										else
										{
											// insert reminder success
											$wpdb->query("INSERT INTO `$reminder_table` (`id`, `app_id`, `reminder_type`, `reminder_client_name`, `reminder_client_email`, `status`, `retries`, `error`, `time_date`) VALUES (NULL, '$appointment_single_detail->id', 'email',  $appointment_single_detail->client_name',  '$appointment_single_detail->client_email' ,'success', '1', '$wp_appt_reminder', CURRENT_TIMESTAMP);");
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	?>
