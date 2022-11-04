<?php
if($service_type=="free_service"){
			$wpdb->insert(
			$wpdb->prefix.'apt_payment',
			array(
					'payment_type'=>'No Payment Type',
					'customer'=>$ap_payment_customer,
					'customer_email'=>$client_email_address,
					'staff'=>$ap_payment_staff,
					'appointment_date'=>$ap_payment_date,
					'service'=>$appointment_payment_service,
					'amount'=>'Free Service',
					'status'=>'pending',
					'appoint_update_id' => $last_appointment_id
					));
					
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
							
			$date_format = get_option( 'date_format' );
			$ap_booking_date=date($date_format, strtotime($ap_payment_date));	
							
							
			$time_format = get_option( 'time_format' );
			$temp_ap_start_time = strtotime($ap_booking_start_time);
			$appt_st=	date($time_format, $temp_ap_start_time);	

			$temp_ap_end_time = strtotime($ap_booking_end_time);
			$appt_et=	date($time_format, $temp_ap_end_time);

			$appt_time= $appt_st . "-" . $appt_et;

			$notification_enable= $email_settings['enable'];
			$notification_emailtype= $email_settings['emailtype'];				
			if($notification_enable =="yes" ){ 
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
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
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
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
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
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
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
			//WP MAIL
				if($notification_emailtype=="wpmail"){
					$notification_admin_email= $email_settings['wpemail'];
						if($notification_admin_email !==""){
							//CLIENT PENDING
							$notification_client_pending= $email_settings['send_notification_client_pending'];
							if($notification_client_pending=="yes"){
									$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
									$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array(
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
															
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
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
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
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
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
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
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url));
									$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
									$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url));
															
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
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
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
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
															'[ADMIN_NAME]'	=>	$admin_name,
															'[BLOG_NAME]'	=>	$blog_name,
															'[SITE_URL]'	 => $site_url,
															'[LOC_ID]' => $ap_location_id));
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
															'[SERVICE_NAME]'	=>	$appointment_payment_service,
															'[APPOINTMENT_DATE]'	=>	$ap_booking_date,
															'[APPOINTMENT_TIME]'	=>	$appt_time,
															'[CLIENT_NAME]'	=>	$ap_payment_customer,
															'[CLIENT_EMAIL]'	=>	$client_email_address,
															'[APPOINTMENT_STATUS]'	=>	'pending',
															'[STAFF_NAME]'	=>	$ap_payment_staff,
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
			}	
		}
		
		?>