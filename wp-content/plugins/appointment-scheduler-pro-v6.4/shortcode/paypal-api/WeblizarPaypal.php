<?php
include_once('Paypal.php');			
class WeblizarPaypal //extends Paypal
{
	// Create an instance of the paypal library
	function TakePayment($appoint_paypal_email, $appoint_currency, $appoint_successful_url, $appoint_failed_url, $appoint_service_name, $appoint_paycost, $last_appoint_id)
	{	
		//include_once('Paypal.php');	
		$myPaypal = new Paypal();					
		// Specify your paypal email
		$myPaypal->addField('business', $appoint_paypal_email);					
		// Specify the currency
		$myPaypal->addField('currency_code', $appoint_currency);	 				//$currencyname			
		// Specify the url where paypal will send the user on success/failure
		$myPaypal->addField('return', $appoint_successful_url);						//Success
		$myPaypal->addField('cancel_return', $appoint_failed_url);					//Failed
		// Specify the url where paypal will send the IPN
		$myPaypal->addField('notify_url', $appoint_successful_url);
		// Specify the product information
		$myPaypal->addField('item_name', $appoint_service_name);
		$myPaypal->addField('amount', $appoint_paycost); //$$servicecost
		$myPaypal->addField('item_number', $last_appoint_id); 
		
		// Enable test mode if needed
		$myPaypal->enableTestMode();					
		// Let's start the train!
		$myPaypal->submitPayment();
	}	
}

?>