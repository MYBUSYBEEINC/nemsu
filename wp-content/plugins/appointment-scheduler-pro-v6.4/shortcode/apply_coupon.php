<?php
//apply coupon
global $wpdb;
$coupon_table =	$wpdb->prefix."apt_coupons";
$payment_table =	$wpdb->prefix."apt_payment";

if(isset($_REQUEST['coupon_names']))
{
		$coupon_name				= $_REQUEST['coupon_names'];
		$appt_date				= $_REQUEST['appt_date'];
		$appt_client_email			= $_REQUEST['appt_client_email'];
		$appoint_service_name			= $_REQUEST['appt_service_name'];
		$appoint_service_price			= $_REQUEST['service_price'];
		
		if($coupon_name==""){	?>
			<script>
				jQuery.notify("<?php _e('Please Enter Coupon Code',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
			</script>
			<?php
		}
		else{
			$coupon_details = $wpdb->get_results("SELECT * FROM `$coupon_table` WHERE `coupon_code` = '$coupon_name'");
			if (!empty($coupon_details)) {
				foreach($coupon_details as $coupon_single_detail){
					$c_service_id	= $coupon_single_detail->service_name;
					$coupon_service_id=explode(',',$c_service_id);
					foreach($coupon_service_id as $coupon_service_i){
						
						$service_details=$wpdb->get_results("select * from $wpdb->prefix"."apt_services where id='$coupon_service_i'");
						foreach($service_details as $service_detail){	
							$coupon_service_name =$service_detail->name; 
							$coupon_time_limit		= $coupon_single_detail->time_limit;
							$per_user_limit		= $coupon_single_detail->per_user_limit;
							$coupon_discount_type	= $coupon_single_detail->discount_type;
							$coupon_discount_method= $coupon_single_detail->discount_method;
								$temp_coupon_start_date		= $coupon_single_detail->coupon_start_date;
							$coupon_start_date = date("m/d/Y", strtotime($temp_coupon_start_date));
								$temp_coupon_end_date		= $coupon_single_detail->coupon_end_date;
							$coupon_end_date = date("m/d/Y", strtotime($temp_coupon_end_date));	
					
							//COUPON SERVICE
							if($appoint_service_name == $coupon_service_name){
								$payment_coupon_used = $wpdb->get_results("SELECT * FROM `$payment_table` WHERE `coupon_code_applied` = '$coupon_name'");
								$total_times_coupon_used= count($payment_coupon_used);
								
								//NO OF TIMES COUPON USED
								if($total_times_coupon_used < $coupon_time_limit ){
									$payment_coupon_emails_used = $wpdb->get_results("SELECT * FROM `$payment_table` WHERE `coupon_code_applied` = '$coupon_name' AND `customer_email` = '$appt_client_email'");
									$per_person_used= count($payment_coupon_emails_used);
									
									//PER PERSON COUPON USED
									if($per_person_used < $per_user_limit){
										$coupon_dates = new DatePeriod(new DateTime($coupon_start_date), new DateInterval('P1D'), new DateTime($coupon_end_date.' +1 day'));
										foreach ($coupon_dates as $coupon_single_date) {
											$coupon_session[] = $coupon_single_date->format("m/d/Y");
										}
										
										//COUPON SESSION
										if (in_array($appt_date, $coupon_session)) { 
												$price_value=  round($appoint_service_price);  
											?>
										<script>
												appoint_service_price= '<?php echo $appoint_service_price;?>';
												price_value = parseFloat(appoint_service_price.replace( /[^\d\.]*/g, ''));
												<?php if($coupon_discount_method=='Percent'){
															$coupon_price=  $price_value/100 *  $coupon_discount_type ; 
															$temp_discount_price =$price_value - $coupon_price ; 
															$discount_price = 	$temp_discount_price *100;													
												?>
												coupon_price= price_value/100*'<?php echo $coupon_discount_type;?>' ;
												discount_service_price= price_value - coupon_price;
												<?php $settings_table =	$wpdb->prefix."apt_settings";
												$settings_payment_currency = $wpdb->get_col( "SELECT currency from $settings_table" ); 
												$payment_currency	= $settings_payment_currency[0];?>
												jQuery.notify("Updated Service Price is"+ " " +discount_service_price + " " +'<?php if ($payment_currency==""){echo 'USD';} else{ echo $payment_currency;}?>', {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
												jQuery('.ap_discount_amount').val(discount_service_price + " "+ '<?php if ($payment_currency==""){echo 'USD';} else{ echo $payment_currency;} ?>');
												
												
												jQuery('.razorpay_amount').val('<?php echo $discount_price ; ?>');
												
												jQuery('.paypal_service_amount').val(discount_service_price);
												<?php } else{ 
													$temp_discount_price =$price_value - $coupon_discount_type ;
													$discount_price = 	$temp_discount_price *100 ;
												?>
																		
												discount_service_price=price_value-<?php echo $coupon_discount_type;?>;
												<?php $settings_table =	$wpdb->prefix."apt_settings";
												$settings_payment_currency = $wpdb->get_col( "SELECT currency from $settings_table" ); 
												$payment_currency	= $settings_payment_currency[0];?>
												jQuery.notify("Updated Service Price is"+ " " +discount_service_price + " " +'<?php if ($payment_currency==""){echo 'USD';} else{ echo $payment_currency;}?>', {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
												jQuery('.ap_discount_amount').val(discount_service_price + " "+ '<?php if ($payment_currency==""){echo 'USD';} else{ echo $payment_currency;} ?>');
												
												jQuery('.razorpay_amount').val('<?php echo $discount_price ; ?>');
												
												jQuery('.paypal_service_amount').val(discount_service_price);
												<?php } ?>
										</script>	<?php
										}
										else{ ?>
										<script>
											jQuery.notify("<?php _e('Coupon Session Expired',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
										</script>
											<?php
											
										}
									}else{	?>
										<script>
										jQuery.notify("<?php _e('Your Coupon Usage limit is Over',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
										</script>
											<?php
									} 
								}else{ ?>
										<script>
										jQuery.notify("<?php _e('Coupon limit is over',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
										</script>
									<?php
								}
							}
						}
					}
				}
			}
			else{	?>
				<script>
				jQuery.notify("<?php _e('Invalid Coupon Code',WL_A_P_SYSTEM); ?> ", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
				</script>
			<?php
			}	
		}
}	?>							
