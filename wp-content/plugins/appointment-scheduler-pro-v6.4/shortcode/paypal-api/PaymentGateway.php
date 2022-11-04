<?php
global $wpdb;
$settings_table =	$wpdb->prefix."apt_settings";
?>
<script>
//CHECK SELECTED PAYMENT TYPE 
//IF SELECTED PAYMENT TYPE IS CASH- REDIRECT TO payment_redirect.php file
//IF SELECTED PAYMENT TYPE IS PAYPAL REDIRECT TO THE PAYPAL URL
//IF SELECTED PAYMENT TYPE IS RAZORPAY REDIRECT TO THE RAZORPAY URL

function step5_next(){
	ap_email_notification 	 = jQuery('.ap_email_notification').val();
	razorpay_amount 		 = jQuery('.razorpay_amount').val();
	ap_payment_customer 	 = jQuery('.ap_payment_customer').val();
	ap_payment_staff 		 = jQuery('.ap_payment_staff').val();
	ap_payment_date 		 = jQuery('.ap_payment_date').val();
	ap_payment_service 		 = jQuery('.ap_payment_service').val();
	ap_payment_amount 		 = jQuery('.ap_payment_amount').val();
	ap_payment_staff_email   = jQuery('.ap_payment_staff_email').val();
	ap_client_contact_detail = jQuery('.ap_client_contact_detail').val();
	ap_staff_id 			 = jQuery('.ap_staff_id').val();
	ap_booking_start_time    = jQuery('.ap_booking_start_time').val();
	ap_booking_end_time 	 = jQuery('.ap_booking_end_time').val();
	client_email_address     = jQuery('.client_email_address').val();
	ap_discount_amount       = jQuery('.ap_discount_amount').val();
	payment_unique_id 		 = jQuery('.payment_unique_id').val();
	appoint_coupon 			 = jQuery('#appoint_coupon').val();
	razorpay_discount_amount = jQuery('.razorpay_discount_amount').val();
	ap_payment_service_id 	 = jQuery('.ap_payment_service_id').val();
	ap_location_id 			 = jQuery('.ap_location_id').val();
	//console.log("paymentGateway file" + ap_location_id);	
	var checked_payment = jQuery('input[name=payment]:checked');
	var checked_payment_value = checked_payment.val();
	
	/* if(ap_discount_amount==""){
		var razorpay_pay_amount= razorpay_amount;
	}else{
		var razorpay_pay_amount= ap_discount_amount;
	} */	
	if(jQuery('.payment').is(':checked')) {
	 //If Cash is checked
		if(checked_payment_value=="Cash"){
				jQuery("#stepnext5").prop('disabled', true);
					jQuery('#stepnext5').html('<i class="fas fa-spinner fa-spin"></i>  <?php _e("Please Wait",WL_A_P_SYSTEM); ?>');
			
					jQuery.ajax({
						type : 'post',
						url : frontendajax.ajaxurl+'?action=paypal_ajax_request',  
						data : 'payment='+ checked_payment_value + '&ap_email_notification='+ ap_email_notification + '&ap_payment_customer='+ ap_payment_customer + '&ap_payment_staff='+ ap_payment_staff + '&ap_payment_date='+ ap_payment_date + '&ap_payment_service='+ ap_payment_service + '&ap_payment_amount='+ ap_payment_amount + '&ap_payment_staff_email='+ ap_payment_staff_email + '&ap_client_contact_detail='+ ap_client_contact_detail + '&ap_staff_id='+ ap_staff_id + '&ap_booking_start_time='+ ap_booking_start_time + '&ap_booking_end_time='+ ap_booking_end_time + '&client_email_address='+ client_email_address +  '&ap_discount_amount='+ ap_discount_amount +  '&payment_unique_id='+ payment_unique_id +  '&appoint_coupon='+ appoint_coupon + '&ap_location_id='+ ap_location_id,
						success : function(data){
							jQuery("#stepnext5").prop('disabled', false);
							jQuery('#stepnext5').html('<?php _e("Please Wait",WL_A_P_SYSTEM); ?>');
					
							jQuery('#step6').html(data);
							jQuery('#step6').show();
							jQuery('#step1').hide();
							jQuery('#step2').hide();
							jQuery('#step3').hide();
							jQuery('#step4').hide();
							jQuery('#step5').hide();
								
						}
					});					
			}	
			//If Paypal is checked
			else if(checked_payment_value=="paypal"){
				jQuery("#stepnext5_paypal").prop('disabled', true);
					jQuery('#stepnext5_paypal').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Please Wait",WL_A_P_SYSTEM); ?>');
			
					jQuery.ajax({
						type : 'post',
						url: location.href, 
						data : 'payment='+ checked_payment_value + '&ap_email_notification='+ ap_email_notification + '&ap_payment_customer='+ ap_payment_customer + '&ap_payment_staff='+ ap_payment_staff + '&ap_payment_date='+ ap_payment_date + '&ap_payment_service='+ ap_payment_service + '&ap_payment_amount='+ ap_payment_amount + '&ap_payment_staff_email='+ ap_payment_staff_email + '&ap_client_contact_detail='+ ap_client_contact_detail + '&ap_staff_id='+ ap_staff_id + '&ap_booking_start_time='+ ap_booking_start_time + '&ap_booking_end_time='+ ap_booking_end_time + '&client_email_address='+ client_email_address +  '&ap_discount_amount='+ ap_discount_amount +  '&payment_unique_id='+ payment_unique_id +  '&appoint_coupon='+ appoint_coupon,  
						success : function(data){
							jQuery("#stepnext5_paypal").prop('disabled', false);
							jQuery('#stepnext5_paypal').html('<?php _e("Please Wait",WL_A_P_SYSTEM); ?>');
					<?php
					
					//$settings_paypal_email = $wpdb->get_col( "SELECT paypal_email from $settings_table" ); 
					$settings_paypal_email = get_option("weblizar_aps_payment_setting");
					$paypal_email		   = $settings_paypal_email['paypal_email'];

					//$settings_payment_currency = $wpdb->get_col( "SELECT payment_currency from $settings_table" ); 
					$settings_payment_currency = get_option("weblizar_aps_payment_setting");
					$payment_currency		   = $settings_payment_currency['payment_currency'];

					$success_current_url  = "http://".$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."?";
					$failed_redirect_url  = $success_current_url."&payment-status=cancelled";
					$success_redirect_url = $success_current_url."&payment-status=confirmed";
					//$settings_payment_mode = $wpdb->get_col( "SELECT payment_mode from $settings_table" ); 
					$settings_payment_mode = get_option("weblizar_aps_payment_setting");
					$payment_mode  = $settings_payment_mode['payment_mode'];
					if($payment_mode == 'direct_paypal_mode') { 
						$paypal_redirect = "https://www.paypal.com/cgi-bin/webscr?";
					}
					else{
						$paypal_redirect ="https://www.sandbox.paypal.com/cgi-bin/webscr?";
					}
					?>						
						 var array = { "rm":"2", 
						 "cmd":"_xclick", 
						 "business":"<?php echo $paypal_email; ?>", 
						 "currency_code":"<?php echo $payment_currency; ?>", 
						 "return":"<?php echo $success_redirect_url; ?>",  
						 "cancel_return":"<?php echo $failed_redirect_url.'&id='; ?>" + payment_unique_id, 
						 "notify_url":"<?php echo $success_redirect_url; ?>", 
						 "item_name": appointment_service, 
						 "amount": appointment_service_amount, 
						 "item_number": payment_unique_id };
						 
					var str = jQuery.param(array);
					window.open("<?php echo $paypal_redirect; ?>" + str,'_self');
						}
					});
				
			}
			/* If stripe is checked */
			else if( checked_payment_value == "stripe" ) {
				<?php 
					$weblizar_payment_settings = get_option("weblizar_aps_payment_setting");
					/* Stripe payment gateway info */
					$strip_pkey    = $weblizar_payment_settings['stripe_apikey'];					
				?>
				Stripe.setPublishableKey("<?php echo $strip_pkey; ?>");
				jQuery("#stepnext5_stripe").prop('disabled', true);
				jQuery("#wl_loading").html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Please Wait",WL_A_P_SYSTEM); ?>');
				jQuery('#myModal').modal('show');
				jQuery('#wl-customer-Email').val(client_email_address);
				jQuery("#wl-pay-btn").on('click',function(event) {
				jQuery('#myModal').modal('hide');			
					
				var wl_customer_Email = jQuery("#wl-customer-Email").val();
				var wl_customer_card  = jQuery("#wl-customer-card").val();
				var wl_customer_cvc   = jQuery("#wl-customer-cvc").val();
				var wl_exp_month 	  = jQuery("#wl_exp_month").val();
				var wl_exp_year 	  = jQuery("#wl_exp_year").val();
					
				function stripeResponseHandler(status, response) {
					if (response.error) {
						//enable the submit button
						// jQuery('#payBtn').removeAttr("disabled");
						//display the errors on the form
						//jQuery(".payment-errors").html(response.error.message);
						jQuery.notify(response.error.message, {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
						jQuery("#stepnext5_stripe").removeAttr("disabled");	
						jQuery("#wl_loading").hide();

					} else {
						var form$ = jQuery("#wl-payby-stripe");
						//get token id
						var token = response['id'];
						//insert the token into the form
						form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
						//submit form to the server
						form$.get(0).submit();
					}
				}
					
					//create single-use token to charge the user
			        Stripe.createToken({
			            number: jQuery("#wl-customer-card").val(),
			            cvc: jQuery("#wl-customer-cvc").val(),
			            exp_month: jQuery("#wl_exp_month").val(),
			            exp_year: jQuery("#wl_exp_year").val()
			        }, stripeResponseHandler);
				        
			        //submit from callback
			        return false;
				});
				jQuery(".mclose").on('click', function() {
					var abc = jQuery(".mclose").attr('data-value');
					console.log(abc);
					jQuery("#stepnext5_stripe").removeAttr("disabled");	
					jQuery("#wl_loading").hide(500);
				} );
			}
			
			//If Razorpay is checked
			else if(checked_payment_value=="razorpay") {
				
					jQuery("#stepnext5_razorpay").prop('disabled', true);
					jQuery('#stepnext5_razorpay').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Please Wait",WL_A_P_SYSTEM); ?>');
				
						<?php
						
						//$settings_table =	$wpdb->prefix."apt_settings";
						$setting_razor_pay = get_option("weblizar_aps_payment_setting");
						//$settings_razorpay_api_key = $wpdb->get_col( "SELECT razorpay_api_key from $settings_table" ); 
						$razorpay_api_key	= $setting_razor_pay['razorpay_api_key'];

						//$settings_razorpay_name = $wpdb->get_col( "SELECT razorpay_name from $settings_table" ); 
						$razorpay_name	= $setting_razor_pay['razorpay_name'];

						//$settings_razorpay_description = $wpdb->get_col( "SELECT razorpay_description from $settings_table" ); 
						$razorpay_description	= $setting_razor_pay['razorpay_description'];
						
						 //$settings_razorpay_currency = $wpdb->get_col( "SELECT razorpay_currency from $settings_table" ); 
						$razorpay_currency	= $setting_razor_pay['razorpay_currency'];
						
						//$setting_razorpay_logo = $wpdb->get_col( "SELECT razorpay_logo from $settings_table" ); 
						$razorpay_logo	= $setting_razor_pay['razorpay_logo'];
						
						//$setting_razorpay_theme_color = $wpdb->get_col( "SELECT razorpay_theme_color from $settings_table" ); 
						$razorpay_theme_color	= $setting_razor_pay['razorpay_theme_color'];	
						
						if($razorpay_theme_color==""){
							$razorpay_theme_color=="#ffb904";
						}
					?>			
						
				var options = {
					
				
					"key": "<?php echo $razorpay_api_key; ?>",

					"amount": razorpay_amount,       

					"name": "<?php echo $razorpay_name; ?>",

					"description":  "<?php echo $razorpay_description; ?>",

					"image": "<?php echo $razorpay_logo; ?>",

					"handler": function (response){		

					jQuery.ajax({
							type: "post",
							//url: location.href,
							data : 'payment='+ checked_payment_value + '&ap_email_notification='+ ap_email_notification + '&ap_payment_customer='+ ap_payment_customer + '&ap_payment_staff='+ ap_payment_staff + '&ap_payment_date='+ ap_payment_date + '&ap_payment_service='+ ap_payment_service + '&ap_payment_amount='+ ap_payment_amount + '&ap_payment_staff_email='+ ap_payment_staff_email + '&ap_client_contact_detail='+ ap_client_contact_detail + '&ap_staff_id='+ ap_staff_id + '&ap_booking_start_time='+ ap_booking_start_time + '&ap_booking_end_time='+ ap_booking_end_time + '&client_email_address='+ client_email_address +  '&ap_discount_amount='+ ap_discount_amount +  '&payment_unique_id='+ payment_unique_id +  '&appoint_coupon='+ appoint_coupon,
							/* success: function(s)
							{	
								
							},	 */

							complete: function()
							{	
								jQuery("#stepnext5_razorpay").prop('disabled', false);
								jQuery('#stepnext5_razorpay').html('<?php _e("Please Wait",WL_A_P_SYSTEM); ?>');
								var array = { 
										 "payment-id": payment_unique_id 
								};
								<?php	
								$success_current_url = "http://".$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."?"; ?>
								var str = jQuery.param(array);
								window.open("<?php echo $success_current_url; ?>" + str,'_self');
							}						

						});

						return false;				

					},

					"prefill": {

						"name": ap_payment_customer,

						"email": client_email_address,

						"contact": ap_client_contact_detail

					},

					"theme": {

						"color": "<?php echo $razorpay_theme_color; ?>",


					},
				};

				var rzp1 = new Razorpay(options);
				jQuery(document).ready(function(){
					rzp1.open();
					//	e.preventDefault();
				});
			}
		}
		else{
			jQuery.notify("<?php _e('Please Select Payment Method',WL_A_P_SYSTEM); ?>", {class:"alert_box", type:"danger", align:"center", verticalAlign:"middle"});
		}
}
</script>
<?php
//PAYMENT TABLE FOR PAYPAL		
if(isset($_REQUEST['payment'])){
	$payment 			  = sanitize_text_field( $_REQUEST['payment'] );
	$ap_payment_customer  = sanitize_text_field( $_REQUEST['ap_payment_customer'] );
	$ap_payment_staff 	  = sanitize_text_field( $_REQUEST['ap_payment_staff'] );
	$temp_date   		  = sanitize_text_field( $_REQUEST['ap_payment_date'] );
	$ap_payment_date 	  = date("Y-m-d", strtotime($temp_date));
	$ap_payment_service   = sanitize_text_field( $_REQUEST['ap_payment_service'] );
	$ap_payment_amount    = sanitize_text_field( $_REQUEST['ap_payment_amount'] );
	$ap_discount_amount   = sanitize_text_field( $_REQUEST['ap_discount_amount'] );
	$appoint_coupon 	  = sanitize_text_field( $_REQUEST['appoint_coupon'] );
	$client_email_address = sanitize_text_field( $_REQUEST['client_email_address'] );
	$payment_unique_id 	  = sanitize_text_field( $_REQUEST['payment_unique_id'] );
	
	//$ap_location_id = sanitize_text_field($_REQUEST['ap_location_id']);
	$location_id 		  = sanitize_text_field($_REQUEST['ap_location_id']);
	// $lo_info = $wpdb->prepare("select location_add from $location_table where id = '$location_id'");
	// $location_information = $wpdb->get_col($lo_info);
	// $ap_location_id = $location_information[0];
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
			'status' 				=> 'pending',
			'appt_unique_id' 		=> $payment_unique_id,
			'appoint_update_id'     => $last_appointment_id
		));		
}
// update_option( 'amountbbbbb', $ap_discount_amount );
/**
 * Payment Gateway
 *
 * This library provides generic payment gateway handling functionlity
 * to the other payment gateway classes in an uniform way. Please have
 * a look on them for the implementation details.
 *
 * @package     Payment Gateway
 * @category    Library
 * @author      Md Emran Hasan <phpfour@gmail.com>
 * @link        http://www.phpfour.com
 */

abstract class PaymentGateway
{
    /**
     * Holds the last error encountered
     *
     * @var string
     */
    public $lastError;

    /**
     * Do we need to log IPN results ?
     *
     * @var boolean
     */
    public $logIpn;

    /**
     * File to log IPN results
     *
     * @var string
     */
    public $ipnLogFile;

    /**
     * Payment gateway IPN response
     *
     * @var string
     */
    public $ipnResponse;

    /**
     * Are we in test mode ?
     *
     * @var boolean
     */
    public $testMode;

    /**
     * Field array to submit to gateway
     *
     * @var array
     */
    public $fields = array();

    /**
     * IPN post values as array
     *
     * @var array
     */
    public $ipnData = array();

    /**
     * Payment gateway URL
     *
     * @var string
     */
    public $gatewayUrl;

    /**
     * Initialization constructor
     *
     * @param none
     * @return void
     */
    public function __construct()
    {
        // Some default values of the class
        $this->lastError = '';
        $this->logIpn = TRUE;
        $this->ipnResponse = '';
        $this->testMode = FALSE;
    }

    /**
     * Adds a key=>value pair to the fields array
     *
     * @param string key of field
     * @param string value of field
     * @return
     */
    public function addField($field, $value)
    {
        $this->fields["$field"] = $value;
    }

    /**
     * Submit Payment Request
     *
     * Generates a form with hidden elements from the fields array
     * and submits it to the payment gateway URL. The user is presented
     * a redirecting message along with a button to click.
     *
     * @param none
     * @return void
     */
    public function submitPayment()
    {	
		global $wpdb;
		$settings_table =	$wpdb->prefix."apt_settings";
	?>		
       <form method="POST" name="payment_type" style="margin-bottom: 0;"  id="payment_type" >
			<div class="ap-steps">
				<div class="ap-step1 services complete">
					<label><?php _e("Services",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
				<div class="ap-step2 time complete">
					<label><?php _e("Time",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
				<div class="ap-step3 time complete">
					<label><?php _e("Details",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
				<div class="ap-step4 Details complete">
					<label><?php _e("Confirm",WL_A_P_SYSTEM); ?> </label>
					<span></span>
				</div>
				<?php
				 //$settings_accept_payment = $wpdb->get_col( "SELECT accept_payment from $settings_table" ); 
					$settings_accept_payment = get_option("weblizar_aps_payment_setting");
					$accept_payment	= $settings_accept_payment['accept_payment'];
		 
				if($accept_payment=="yes") { ?>
				<div class="col-md-2 col-sm-2 ap-step5 payment active">
					<label><?php _e("Payment",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
				<?php } ?>
				<div class="ap-step6 done">
					<label><?php _e("Done",WL_A_P_SYSTEM); ?></label>
					<span></span>
				</div>
			</div>
			<!-- Step 5 -->
			<div  id="5" class="ap-steps-detail5">
				<div class="service-form">
					<div class="step-payment">
						<div class="row">
							<div class="col-md-12 step4-form" id='coupon_service'>
								<label><?php _e("Apply Coupon",WL_A_P_SYSTEM); ?> :</label>
								<input type="text" class="coupon" id="appoint_coupon" name="appoint_coupon" placeholder="Coupon"/>
								<input type="hidden" class="coupon" id="c_service_price" name="c_service_price" placeholder="Coupon"/>
								<a id="apply_coupon" class="btn save" data-toggle="tab" aria-expanded="false"><?php _e("Apply Coupon",WL_A_P_SYSTEM); ?></a>
							</div>
							
							<div class="col-md-12 step4-form">
								<p><?php _e("Please tell us how you would like to pay",WL_A_P_SYSTEM); ?>:</p>
								<?php  
								$cash_checkout_settings = get_option("weblizar_aps_payment_setting"); 
								$cash_checkout = $cash_checkout_settings['cash_checkout'];
									if($cash_checkout == 'yes'){
								?>
								<div class="row step4-payment">
									<input onclick="OnChangeRadio (this)" class="payment" value="Cash" type="radio" name="payment" /><span> <?php _e("I will pay Cash",WL_A_P_SYSTEM); ?></span>
								</div>
								<?php
									 }
								?>
								<?php  
								//$settings_table =	$wpdb->prefix."apt_settings";
								//$settings_razorpay_checkout = $wpdb->get_col( "SELECT razorpay_checkout from $settings_table" ); 
								$settings_razorpay_checkout = get_option("weblizar_aps_payment_setting");
								$razorpay_checkout	= $settings_razorpay_checkout['razorpay_checkout'];
								if($razorpay_checkout == 'r-enable') { ?>
								
								<div class="row step4-payment">
									<input onclick="OnChangeRadio (this)" class="payment" value="razorpay" type="radio" name="payment" /><span><?php _e("I will pay Razorpay",WL_A_P_SYSTEM); ?> </span>
									<span class="pics"><img class="img-responsive" src="<?php echo WEBLIZAR_A_P_SYSTEM.'/shortcode/images/razorpay_logo.png'; ?>"></span>
								</div>
								<?php }
								?>							
								<?php  
								//$settings_table =	$wpdb->prefix."apt_settings";
								//$settings_paypal_checkout = $wpdb->get_col( "SELECT paypal_checkout from $settings_table" ); 
								$settings_paypal_checkout = get_option("weblizar_aps_payment_setting");
								$paypal_checkout		  = $settings_paypal_checkout['paypal_checkout'];
								if ($settings_paypal_checkout['stripe_enable']) {
									$stripe_enable 		 = $settings_paypal_checkout['stripe_enable'];
								}
								if($paypal_checkout == 'p-enable') { ?>
								<div class="row step4-payment">
									<input onclick="OnChangeRadio (this)" class="payment" value="paypal" type="radio" name="payment"/> <span><?php _e("I will pay now with PayPal",WL_A_P_SYSTEM); ?> </span>
									<span class="pics"><img class="img-responsive" src="<?php echo WEBLIZAR_A_P_SYSTEM.'/shortcode/images/paypal.png'; ?>"></span>
								</div>
										 <?php }
									
									if($stripe_enable == "s-enable") {
											?>
										<div class="row step4-payment">
											<input onclick="OnChangeRadio (this)" class="payment" value="stripe" type="radio" name="payment"/> <span><?php _e("I will pay now with Stripe",WL_A_P_SYSTEM); ?> </span>
										</div>
									<?php	
										}

										 else if($cash_checkout=="no" && $razorpay_checkout == "r-disable" && $paypal_checkout == "p-disable"){
										 	//echo "<h2>__('No Payment Option is Enable. Please Contact To Administrator',WL_A_P_SYSTEM).</h2><>$cash_checkout";
										 	echo "<h2>".__('No Payment Option is Enable. Please Contact To Administrator',WL_A_P_SYSTEM)."</h2>";
										}
								?>							
								<input type="hidden" class="ap_email_notification" name="ap_email_notification" >
								<input type="hidden" class="ap_payment_customer" name="ap_payment_customer"/>
								<input type="hidden" class="ap_payment_staff" name="ap_payment_staff"/>
								<input type="hidden" class="ap_payment_date" name="ap_payment_date"/>
								<input type="hidden" class="ap_payment_service" name="ap_payment_service"/>
								<input type="hidden" class="ap_payment_amount" name="ap_payment_amount"/>
								<input type="hidden" class="ap_payment_staff_email" name="ap_payment_staff_email"/>
								<input type="hidden" class="ap_client_contact_detail" name="ap_client_contact_detail">
								<input type="hidden" class="ap_staff_id" name="ap_staff_id">
								<input type="hidden" class="ap_booking_start_time" name="ap_booking_start_time">
								<input type="hidden" class="ap_booking_end_time" name="ap_booking_end_time">
								<input type="hidden" class="client_email_address" name="client_email_address">
								<input type="hidden" class="ap_discount_amount" name="ap_discount_amount"/>
								<input type="hidden" class="payment_unique_id" name="payment_unique_id"/>
								<input type="hidden" class="razorpay_amount" name="razorpay_amount"/>
								<input type="hidden" class="razorpay_discount_amount" name="razorpay_discount_amount"/>
								<input type="hidden" class="ap_location_id" name="ap_location_id"/>
							</div>
						</div>
					</div>
				</div>
				
				<?php  $payment_editor_content= get_option("payment_tips");
				if (!empty($payment_editor_content)) {	?>
					<div class="row step-description">
						<ul> <?php echo "<pre class='pre_bg' style='display:block !important;'>".$payment_editor_content."</pre>"; ?> </ul>
					</div>
			<?php } ?> 
				</div>
			<!-- Step 5 -->
			<div class="ap-step-link">
			<?php $appearence_table =	$wpdb->prefix."apt_appearence";
				$appearence_payment_navigation_text_forward = $wpdb->get_col( "SELECT payment_navigation_text_forward from $appearence_table" );
				$payment_navigation_text_forward = $appearence_payment_navigation_text_forward[0]; ?>
				<a id="stepback5" href="#step4" onclick="return step5_back();" class="btn step-left" data-toggle="tab" aria-expanded="false"><?php if (!empty($confirm_navigation_text_backward)) {  echo __("Next",WL_A_P_SYSTEM); } else { echo __("Back",WL_A_P_SYSTEM); } ?></a>
				<span id="wl_loading"></span>
				<button id="stepnext5" name="stepnext5" onclick="return step5_next();"  type="button" class="btn step-right paypal"><?php if (!empty($payment_navigation_text_forward)) {  _e("$payment_navigation_text_forward",WL_A_P_SYSTEM); } else {_e("Next",WL_A_P_SYSTEM); } ?></button>
				<button id="stepnext5_paypal" onclick="return step5_next();" style="display: none;" type="button" class="btn step-right paypal"><?php _e("Pay With Paypal",WL_A_P_SYSTEM); ?></button>				
				<button id="stepnext5_razorpay" onclick="return step5_next();" style="display: none;" type="button" class="btn step-right razorpay"><?php _e("Pay With Razorpay",WL_A_P_SYSTEM); ?></button>
				<button id="stepnext5_stripe" onclick="return step5_next();" style="display: none;" type="button" class="btn step-right stripe"><?php _e("Pay With Stripe",WL_A_P_SYSTEM); ?></button>
			</div>
		</form>	
   <?php }

    /**
     * Perform any pre-posting actions
     *
     * @param none
     * @return none
     */
    protected function prepareSubmit()
    {
        // Fill if needed
    }

    /**
     * Enables the test mode
     *
     * @param none
     * @return none
     */
    abstract protected function enableTestMode();

    /**
     * Validate the IPN notification
     *
     * @param none
     * @return boolean
     */
    abstract protected function validateIpn();

    /**
     * Logs the IPN results
     *
     * @param boolean IPN result
     * @return void
     */
    public function logResults($success)
    {

        if (!$this->logIpn) return;

        // Timestamp
        $text = '[' . date('m/d/Y g:i A').'] - ';

        // Success or failure being logged?
        $text .= ($success) ? "SUCCESS!\n" : 'FAIL: ' . $this->lastError . "\n";

        // Log the POST variables
        $text .= "IPN POST Vars from gateway:\n";
        foreach ($this->ipnData as $key=>$value)
        {
            $text .= "$key=$value, ";
        }

        // Log the response from the paypal server
        $text .= "\nIPN Response from gateway Server:\n " . $this->ipnResponse;

        // Write to log
        $fp = fopen($this->ipnLogFile,'a');
        fwrite($fp, $text . "\n\n");
        fclose($fp);
    }
}
?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close mclose" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php _e( "Stripe Payment", WL_A_P_SYSTEM ); ?></h4>
      </div>
      <div class="modal-body">
        <form id="wl-payby-stripe" method="post">
          <div class="form-group">
            <label for="wl-customer-Email" class="col-form-label"><?php _e( "Customer Email", WL_A_P_SYSTEM ); ?>:</label>
            <input type="text" class="form-control" id="wl-customer-Email" name="customer_email">
          </div>

          <div class="form-group">
            <label for="wl-customer-card" class="col-form-label"><?php _e( "Card Number", WL_A_P_SYSTEM ); ?>:</label>
            <input type="text" class="form-control" id="wl-customer-card" name="customer_card">
          </div>

          <div class="form-group">
            <label for="wl-customer-cvc" class="col-form-label"><?php _e( "CVC", WL_A_P_SYSTEM ); ?>:</label>
            <input type="password" class="form-control" id="wl-customer-cvc" name="customer_cvc">
          </div>

		  <div class="form-group wl-stripe-carddate">
			<label for="" class="col-form-label"><?php _e( "Expiration", WL_A_P_SYSTEM ); ?> (MM/YYYY):</label>			
			<!--<input type="text" class="form-control card-expiry-month"  id="wl_exp_month" name="exp_month" size="2" />-->
			<select class="form-control card-expiry-month"  id="wl_exp_month" name="exp_month" style="display: inline-block;">
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select> 
	        <span> / </span>
	        <!--<input type="text" class="form-control card-expiry-year" id="wl_exp_year" name="exp_year" size="4" />-->
			<select class="form-control card-expiry-year" id="wl_exp_year" name="exp_year" style="display: inline-block;">
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				<option value="2021">2021</option>
				<option value="2022">2022</option>
				<option value="2023">2023</option>
				<option value="2024">2024</option>
				<option value="2025">2025</option>
				<option value="2026">2026</option>
				<option value="2027">2027</option>
				<option value="2028">2028</option>
				<option value="2029">2029</option>
				<option value="2030">2030</option>
				<option value="2031">2031</option>
				<option value="2032">2032</option>
				<option value="2033">2033</option>
				<option value="2034">2034</option>
				<option value="2035">2035</option>
				<option value="2036">2036</option>
				<option value="2037">2037</option>
			</select> 
		  </div>
		  
			<input type="hidden" class="ap_email_notification" name ="ap_email_notification" >
			<input type="hidden" class="ap_payment_customer" name ="ap_payment_customer"/>
			<input type="hidden" class="ap_payment_staff" name ="ap_payment_staff"/>
			<input type="hidden" class="ap_payment_date" name ="ap_payment_date"/>
			<input type="hidden" class="ap_payment_service" name ="ap_payment_service"/>
			<input type="hidden" class="ap_payment_amount" name ="ap_payment_amount"/>
			<input type="hidden" class="ap_payment_staff_email" name ="ap_payment_staff_email"/>
			<input type="hidden" class="ap_client_contact_detail" name ="ap_client_contact_detail" />
			<input type="hidden" class="ap_staff_id" name ="ap_staff_id" />
			<input type="hidden" class="ap_booking_start_time" name ="ap_booking_start_time" />
			<input type="hidden" class="ap_booking_end_time" name ="ap_booking_end_time" />
			<input type="hidden" class="client_email_address" name ="client_email_address" />
			<input type="hidden" class="ap_discount_amount" name ="ap_discount_amount"/>
			<input type="hidden" class="payment_unique_id" name ="payment_unique_id"/>
			<input type="hidden" class="razorpay_amount" name ="razorpay_amount"/>
			<input type="hidden" class="razorpay_discount_amount" name ="razorpay_discount_amount"/>
			<input type="hidden" class="ap_location_id" name ="ap_location_id"/>
		  <button type="button" id="wl-pay-btn"><?php _e( "Pay By Stripe", WL_A_P_SYSTEM ); ?></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default mclose" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<style>
	.wl-stripe-carddate input, .wl-stripe-carddate  span {
		display: inline-block;
	}
	.wl-stripe-carddate .card-expiry-month{
		width: 100px;
	}
	.wl-stripe-carddate .card-expiry-year {
		width: 200px;
	}
	#wl_loading {
		position: fixed;
		display: block !important;
		padding: 15px;
		background-color: #4c4c4c;
		left:0;
		right:0;
	}
</style>
