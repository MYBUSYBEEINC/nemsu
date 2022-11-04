<script>
//SAVE SETTING DETAILS
function save_general_settings(){
	if(jQuery("#ap_timezone").val()=="0")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#time_zone_alert").show(); 
               jQuery("#ap_timezone").focus();
                return false;
			  }
	 if(jQuery("#language").val()=="0")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#language_alert").show(); 
               jQuery("#language").focus();
                return false;
			  }
	 if(jQuery("#currency").val()=="0")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#currency_alert").show(); 
               jQuery("#currency").focus();
                return false;
			  }
	 if(jQuery("#ap_mintime").val()=="0")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#ap_mintime_alert").show(); 
               jQuery("#ap_mintime").focus();
                return false;
			  }		 
		jQuery("#save_settings_01").prop('disabled', true);
		jQuery('#save_settings_01').html('<i class="fas fa-spinner fa-spin"></i> <?php _e( "Saving", WL_A_P_SYSTEM ); ?>');			  
			  
        jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_general_settings").serialize(),
		  dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			 
			jQuery("#save_settings_01").prop('disabled', false);
			jQuery('#save_settings_01').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			
			jQuery.notify("Settings Saved", {type:"success",icon:"check", align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			jQuery(".validation_alert").hide();
		}
	});
 }
	
	
	function save_bp_setting()
    {
		
		 
	 function ValidateEmail(email) 
			{
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
            };
			
	  if(jQuery("#b_name").val()=="")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_name_alert").show();
               jQuery("#b_name").focus();
                return false;
			  }
	if(jQuery("#b_owner").val()=="")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_owner_alert").show();
               jQuery("#b_owner").focus();
                return false;
			  }
	/* if(jQuery("#b_phone").val()=="")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_phone_alert").show();
               jQuery("#b_phone").focus();
                return false;
			  }	
			  if(!jQuery.isNumeric(jQuery("#b_phone").val()))
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_no_phone_alert").show();
               jQuery("#b_phone").focus();
                return false;
			  }*/
			  
	 /*if(jQuery("#b_fax").val()=="")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_fax_alert").show(); 
               jQuery("#b_fax").focus();
                return false;
			  }*/
	if(jQuery("#b_email").val()=="")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_email_alert").show();
               jQuery("#b_email").focus();
                return false;
			  }
			  
			   if (!ValidateEmail(jQuery("#b_email").val())) 
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_Invalid_email_alert").show();
               jQuery("#b_email").focus();
                return false;
			  }
			  
	if(jQuery("#b_blog_url").val()=="")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_fax_alert").hide(); 
               jQuery("#b_blog_url").focus();
                return false;
			  }
	if(jQuery("#b_postal_code").val()=="")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_postal_code_alert").show();
               jQuery("#b_postal_code").focus();
                return false;
			  }
			  if(!jQuery.isNumeric(jQuery("#b_postal_code").val()))
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_postal_number_alert").show();
               jQuery("#b_postal_code").focus();
                return false;
			  }
	if(jQuery("#b_address").val()=="")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#b_address_alert").show();
               jQuery("#b_address").focus();
                return false;
			  }		  
	jQuery("#save_settings_02").prop('disabled', true);
	jQuery('#save_settings_02').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		
        jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_bp_settings").serialize(),
          dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#save_settings_02").prop('disabled', false);
			jQuery('#save_settings_02').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			
			jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			jQuery(".validation_alert").hide(); 
		}
	});
    }
	function save_bh_setting()
     {
		jQuery("#save_settings_03").prop('disabled', true);
		jQuery('#save_settings_03').html('<i class="fas fa-spinner fa-spin"></i> Saving');
		 
        jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_bh_settings").serialize(),
          dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
		jQuery("#save_settings_03").prop('disabled', false);
		jQuery('#save_settings_03').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
		jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
        jQuery(".validation_alert").hide(); 
		}
	});
    }
	function save_payment_setting()
     {
             if(jQuery("#payment_currency").val()=="0")
			  {
			   jQuery(".validation_alert").hide(); 
			   jQuery("#payment_currency_alert").show();
               jQuery("#payment_currency").focus();
                return false;
			  }
			  if(jQuery("#paypal_email").val()=="")
			  {
				jQuery(".validation_alert").hide();
				jQuery("#paypal_email_alert").show();
				jQuery("#paypal_email").focus();
                return false;
			  }
			  if(jQuery('#razorpay').val()=="r-enable")
			  {
					if(jQuery("#razorpay_api_key").val()=='')
					{	
						jQuery(".validation_alert").hide();					
						jQuery("#razorpay_api_alert").show();
						jQuery("#razorpay_api_key").focus();
						return false;
					}
			  }
			  if( jQuery('#stripe_enable').val() == "s-enable" ){
			  	 if( jQuery('#stripe_apikey').val() == '' ){
						jQuery(".validation_alert").hide();					
						jQuery("#stripe_apikey_alert").show();
						jQuery("#stripe_apikey").focus();
						return false;
			  	 }

			  	 if( jQuery('#stripe_secretkey').val() == '' ){
					jQuery(".validation_alert").hide();					
					jQuery("#stripe_secretkey_alert").show();
					jQuery("#stripe_apikey").focus();
					return false;
			  	 }
			  }
			jQuery("#save_settings_04").prop('disabled', true);
			jQuery('#save_settings_04').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
              
        jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_payment_settings").serialize(),
          dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
		jQuery("#save_settings_04").prop('disabled', false);
		jQuery('#save_settings_04').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
		jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
        jQuery(".validation_alert").hide();
		}
	});
    }
	function save_calender_setting()
     {
		jQuery("#save_settings_05").prop('disabled', true);
		jQuery('#save_settings_05').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		 
        jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_calender_settings").serialize(),
          dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
		jQuery("#save_settings_05").prop('disabled', false);
		jQuery('#save_settings_05').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
		jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
		jQuery("#ca_lendar_settings").load(location.href + " #ca_lendar_settings");
		jQuery("#new_calendar_div_div").load(location.href + " #new_calendar_div_div");
		}
	});
    }
	function save_advance_setting()
     {
		jQuery("#save_settings_06").prop('disabled', true);
		jQuery('#save_settings_06').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		 
        jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_advance_settings").serialize(),
          dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
		jQuery("#save_settings_06").prop('disabled', false);
		jQuery('#save_settings_06').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
		jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
		}
	});
    }
	
	function save_reminder_setting()
     {
		 if(jQuery("#reminder_time").val()=="0")
			  {
			   jQuery(".validation_alert").hide();
			   jQuery("#reminder_time_alert").show();
               jQuery("#reminder_time").focus();
                return false;
			  }
			  if(jQuery("#subject_reminder").val()=="")
			  {
			   jQuery(".validation_alert").hide();
			   jQuery("#subject_reminder_alert").show();
               jQuery("#subject_reminder").focus();
                return false;
			  }
			  if(jQuery("#body_reminder").val()=="")
			  {
			   jQuery(".validation_alert").hide();
			   jQuery("#body_reminder_alert").show();
               jQuery("#body_reminder").focus();
                return false;
			  }
		jQuery("#save_settings_07").prop('disabled', true);
		jQuery('#save_settings_07').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		
        jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_reminder_settings").serialize(),
          dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
		jQuery("#save_settings_07").prop('disabled', false);
		jQuery('#save_settings_07').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
		jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check", align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			jQuery(".validation_alert").hide();
		}
	});
    }
	
	jQuery(document).ready(function(){
    jQuery('a.ap_second_side_bar').on('show.bs.tab', function(e) {
        localStorage.setItem('second_activeTab', jQuery(e.target).attr('href'));
    });
    var second_activeTab = localStorage.getItem('second_activeTab');
    if(second_activeTab){
        jQuery('#setting_tab a[href="' + second_activeTab + '"]').tab('show');
    }
});

jQuery(document).ready(function(){
    jQuery("#time_slots").change(function(){
        jQuery(this).find("option:selected").each(function(){
			if(jQuery(this).attr("value")=="custom_slots"){
                jQuery(".custom-time-slots").not(".custom").hide();
                jQuery(".custom").show();
            }
			else{
                jQuery(".custom").hide();
            }
        });
    }).change();
});

	
function remove_plugin_setting()
{
	localStorage.setItem('activeTab',"0");
	jQuery.confirm({
		title: '<?php _e("Please Confirm",WL_A_P_SYSTEM); ?>',
		theme: 'black',
		content: '<?php _e("Are you sure to REMOVE PLUGIN?",WL_A_P_SYSTEM); ?>',
		animation: 'rotate',
		closeAnimation: 'rotateXR',
		icon: 'far fa-check-square',
		confirmButton: '<?php _e("Remove",WL_A_P_SYSTEM); ?>',
		cancelButton: '<?php _e("Cancel",WL_A_P_SYSTEM); ?>',
		confirm: function () {
			jQuery("#uninstallapcal").prop('disabled', true);
			jQuery('#uninstallapcal').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Removing",WL_A_P_SYSTEM); ?> ');
			location.href = "<?php echo plugins_url('../uninstall.php?uninstall_info=deactivate', __FILE__ ); ?>"; 

		},
	});	 
}
	  
	function payment_function (radio) {
		var payment_value=radio.value;
			if(payment_value=="no"){
				jQuery('#payment_disabled').show(); 
				jQuery('#payment_accept').hide(); 
				
			}
			if(payment_value=="yes"){
				jQuery('#payment_disabled').hide(); 
				jQuery('#payment_accept').show(); 
				
			}
        }
            /*save staff dashboard settings*/
     function loc_function (radio) {
		var loc_value=radio.value;
			if(loc_value=="no"){
				//jQuery('#show_location_tab').show(); 
				jQuery('#show_location_tab').hide(); 
				
			}
			if(loc_value=="yes"){
				//jQuery('#show_location_tab').hide(); 
				jQuery('#show_location_tab').show(); 
				
			}
        }
        function cal_function (radio) {
			var cal_value=radio.value;
			if(cal_value=="no"){
				//jQuery('#show_location_tab').show(); 
				jQuery('#show_calendar_tab').hide(); 
				
			}
			if(cal_value=="yes"){
				//jQuery('#show_location_tab').hide(); 
				jQuery('#show_calendar_tab').show(); 
				
			}
        }
        function service_function (radio) {
			var service_value=radio.value;
			if(service_value=="no"){
				//jQuery('#show_location_tab').show(); 
				jQuery('#show_service_tab').hide(); 
				
			}
			if(service_value=="yes"){
				//jQuery('#show_location_tab').hide(); 
				jQuery('#show_service_tab').show(); 
				
			}
        }
        function profile_function (radio) {
			var profile_value=radio.value;
			if(profile_value=="no"){
				//jQuery('#show_location_tab').show(); 
				jQuery('#show_profile_tab').hide(); 
				
			}
			if(profile_value=="yes"){
				//jQuery('#show_location_tab').hide(); 
				jQuery('#show_profile_tab').show(); 
				
			}
        }
         function appointment_function (radio) {
			var appointment_value=radio.value;
			if(appointment_value=="no"){
				//jQuery('#show_location_tab').show(); 
				jQuery('#show_appointment_tab').hide(); 
				
			}
			if(appointment_value=="yes"){
				//jQuery('#show_location_tab').hide(); 
				jQuery('#show_appointment_tab').show(); 
				
			}
        }
    	function save_staff_dash_setting(){
			jQuery("#save_settings_dashboard").prop('disabled', true);
			jQuery('#save_settings_dashboard').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
			jQuery.ajax({
	          url: location.href,
	          type: "POST",
	          data: jQuery("form#ap_staff_dashboard_settings").serialize(),
	          dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery("#save_settings_dashboard").prop('disabled', false);
				jQuery('#save_settings_dashboard').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
				jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
		        jQuery(".validation_alert").hide();
			}
	  	});
	}
	/*Client dashboard*/
	
	function save_client_dash_setting(){
		jQuery("#save_client_settings_dashboard").prop('disabled', true);
		jQuery('#save_client_settings_dashboard').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_client_dashboard_settings").serialize(),
          dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#save_client_settings_dashboard").prop('disabled', false);
			jQuery('#save_client_settings_dashboard').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
	        jQuery(".validation_alert").hide();
		}
	  });
	}
	/*google calendar sync setting starts*/
	function save_sync_setting(){
		if(jQuery("#ap_cal_google_mail").val()==""){
		   jQuery(".validation_alert").hide();
		   jQuery("#ap_cal_google_mail_alert").show();
           jQuery("#ap_cal_google_mail").focus();
            return false;
		 }
		if(jQuery("#ap_cal_client_id").val()==""){
			jQuery(".validation_alert").hide();
			jQuery("#ap_cal_client_id_alert").show();
			jQuery("#ap_cal_client_id").focus();
			return false;
		}
		if(jQuery("#ap_cal_secret_key").val()==""){
			jQuery(".validation_alert").hide();
			jQuery("#ap_cal_secret_key_alert").show();
			jQuery("#ap_cal_secret_key").focus();
			return false;
		}
			  
		jQuery("#save_settings_sync").prop('disabled', true);
		jQuery('#save_settings_sync').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		jQuery.ajax({
          url: location.href,
          type: "POST",
          data: jQuery("form#ap_sync_settings").serialize(),
          dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#save_settings_sync").prop('disabled', false);
			jQuery('#save_settings_sync').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			jQuery.notify("<?php _e('Settings Saved',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
	        jQuery(".validation_alert").hide();
	        //jQuery("#connecttogoogle").show();
	        location.reload(true);
		}
	  });
	}
	function d_sync_google(dval){
			var dval = dval;
			//alert(dval);
			var ds = "dval="+dval;
			jQuery.ajax({
		          url: location.href,
		          type: "POST",
		          data: ds,
		          dataType: "html",
				//Do not cache the page
				cache: false,
				//success
				success: function (html) {
					jQuery("#sync_google").prop('disabled', true);
					jQuery('#sync_google').html('<?php _e("Connected",WL_A_P_SYSTEM); ?>');
					jQuery.notify("<?php _e('Google DSync Done',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			        jQuery(".validation_alert").hide();
			        jQuery(".d_sync_google").show("fade");
			        location.reload(true);
				}
			});
			
		}
		
		jQuery(document).ready( function(){
			jQuery('#stripe_enable').on('change', function() {
				var stripe_enable = this.value;
				//alert(stripe_enable);
				if( stripe_enable == 's-enable' ) {
					jQuery(".wl-stripe-block-enable").show(500);
				}
				else{
					jQuery(".wl-stripe-block-enable").hide(500);	
				}
				
			});
		});
</script>
<?php
global $wpdb;

if(isset($_REQUEST['currency']))
{
	$ap_timezone =sanitize_text_field($_REQUEST['ap_timezone']) ;
    $currency = sanitize_text_field( $_REQUEST['currency']);
 	$ap_theme_color =sanitize_text_field($_REQUEST['ap_theme_color']) ;
 	$ap_mintime = sanitize_text_field( $_REQUEST['ap_mintime'] );
 	$time_slots = sanitize_text_field( $_REQUEST['time_slots'] );
 	$custom_slot = sanitize_text_field( $_REQUEST['custom_slot'] );
 	$appt_status = sanitize_text_field( $_REQUEST['appt_status'] );
 	$appt_status_pending = sanitize_text_field( $_REQUEST['appt_status_pending'] );
 	$service_duration_type = sanitize_text_field( $_REQUEST['service_duration_type'] );
 	
		// $wpdb->update(
		//       $wpdb->prefix.'apt_settings',
		//       array(
		//      'time_zone' => $ap_timezone,
		//         'currency' => $currency,
		// 	 'ap_theme_color' => $ap_theme_color, 
		// 	 'time_slots' => $time_slots, 
		// 	 'custom_slot' => $custom_slot, 
		// 	 'appt_status' => $appt_status,
		// 	 'appt_status_pending' => $appt_status_pending, 
		// 	 'service_duration_type' => $service_duration_type, 
		// 	 'ap_mintime' => $ap_mintime, ),
		// 	  array( 'id' => '1' )
		// 	);
	$general_setting = array(
		'time_zone' => $ap_timezone,
		'currency' => $currency,
		'ap_theme_color' =>$ap_theme_color,
		'time_slots' =>$time_slots, 
		'custom_slot' =>$custom_slot, 
		'service_duration_type' =>$service_duration_type, 
		'appt_status' =>$appt_status,
		'appt_status_pending' => $appt_status_pending,
		'ap_mintime' => $ap_mintime
	);
update_option('weblizar_aps_general_setting', $general_setting);
}
if(isset($_REQUEST['b_name']))
{
    $b_name = sanitize_text_field( $_REQUEST['b_name'] );
	$b_owner = sanitize_text_field( $_REQUEST['b_owner'] );
    $b_phone = sanitize_text_field( $_REQUEST['b_phone'] );
    $b_fax = sanitize_text_field( $_REQUEST['b_fax'] );
    $b_email = sanitize_text_field( $_REQUEST['b_email'] );
    $b_blog_url = sanitize_text_field( $_REQUEST['b_blog_url'] );
    $b_postal_code = sanitize_text_field( $_REQUEST['b_postal_code'] );
    $b_address = sanitize_text_field( $_REQUEST['b_address'] );
	$update_business_profile = array(
		'b_name' => $b_name,
		'b_owner' => $b_owner,
		'b_phone' => $b_phone,
		'b_fax' => $b_fax,
		'b_email' => $b_email,
		'b_blog_url' => $b_blog_url,
		'b_postal_code' => $b_postal_code,
		'b_address' => $b_address,
		);
	update_option('weblizar_aps_bizprofile_setting',$update_business_profile);
  
}
if(isset($_REQUEST['bh_hour']))
{
	
	$monday_st = sanitize_text_field( $_REQUEST['bh_monday_st'] );
	$bh_monday_st= substr_replace($monday_st, ':', 2, -2);
	$monday_et = sanitize_text_field( $_REQUEST['bh_monday_et'] );
	$bh_monday_et= substr_replace($monday_et, ':', 2, -2);
  
    
	$tuesday_st = sanitize_text_field( $_REQUEST['bh_tuesday_st'] );
	$bh_tuesday_st=substr_replace($tuesday_st, ':', 2, -2);
    $tuesday_et =sanitize_text_field( $_REQUEST['bh_tuesday_et'] );
	$bh_tuesday_et=substr_replace($tuesday_et, ':', 2, -2);
	
	$wednesday_st = sanitize_text_field( $_REQUEST['bh_wednesday_st'] );
	$bh_wednesday_st= substr_replace($wednesday_st, ':', 2, -2);
    $wednesday_et = sanitize_text_field( $_REQUEST['bh_wednesday_et'] );
	$bh_wednesday_et= substr_replace($wednesday_et, ':', 2, -2);
	
	$thursday_st = sanitize_text_field( $_REQUEST['bh_thursday_st'] );
	$bh_thursday_st= substr_replace($thursday_st, ':', 2, -2);
    $thursday_et = sanitize_text_field( $_REQUEST['bh_thursday_et'] );
	$bh_thursday_et= substr_replace($thursday_et, ':', 2, -2);
	
	$friday_st = sanitize_text_field( $_REQUEST['bh_friday_st'] );
	$bh_friday_st= substr_replace($friday_st, ':', 2, -2);
	$friday_et = sanitize_text_field( $_REQUEST['bh_friday_et'] );
	$bh_friday_et= substr_replace($friday_et, ':', 2, -2);
	
	$saturday_st = sanitize_text_field( $_REQUEST['bh_saturday_st'] );
	$bh_saturday_st= substr_replace($saturday_st, ':', 2, -2);
	$saturday_et = sanitize_text_field( $_REQUEST['bh_saturday_et'] );
	$bh_saturday_et= substr_replace($saturday_et, ':', 2, -2);
	
	$sunday_st = sanitize_text_field( $_REQUEST['bh_sunday_st'] );
	$bh_sunday_st= substr_replace($sunday_st, ':', 2, -2);
	$sunday_et = sanitize_text_field( $_REQUEST['bh_sunday_et'] );
	$bh_sunday_et= substr_replace($sunday_et, ':', 2, -2);
	
	
	
	
	
$sunday_setting[] = array('start_time'=>$bh_sunday_st,'end_time'=>$bh_sunday_et);
$monday_setting[] = array('start_time'=>$bh_monday_st,'end_time'=>$bh_monday_et);
$tuesday_setting[] = array('start_time'=>$bh_tuesday_st,'end_time'=>$bh_tuesday_et);
$wednesday_setting[] = array('start_time'=>$bh_wednesday_st,'end_time'=>$bh_wednesday_et);
$thursday_setting[] = array('start_time'=>$bh_thursday_st,'end_time'=>$bh_thursday_et);
$friday_setting[] = array('start_time'=>$bh_friday_st,'end_time'=>$bh_friday_et);
$saturday_setting[] = array('start_time'=>$bh_saturday_st,'end_time'=>$bh_saturday_et);
	
// $wpdb->update( $wpdb->prefix.'apt_settings', array(
// 'bh_sunday'=>serialize($sunday_setting),
// 'bh_monday'=>serialize($monday_setting),
// 'bh_tuesday'=>serialize($tuesday_setting),
// 'bh_wednesday'=>serialize($wednesday_setting),
// 'bh_thursday'=>serialize($thursday_setting),
// 'bh_friday'=>serialize($friday_setting),
// 'bh_saturday'=>serialize($saturday_setting),
// ),array( 'id' =>'1'));

//BUSINESS HOURS OPTION IN OPTION TABLE
$business_hours = array(
						'bh_sunday'=>serialize($sunday_setting),
						'bh_monday'=>serialize($monday_setting),
						'bh_tuesday'=>serialize($tuesday_setting),
						'bh_wednesday'=>serialize($wednesday_setting),
						'bh_thursday'=>serialize($thursday_setting),
						'bh_friday'=>serialize($friday_setting),
						'bh_saturday'=>serialize($saturday_setting),
					);

		update_option('weblizar_aps_business_hours', $business_hours);
}
if(isset($_REQUEST['accept_payment']))
{
	
    $payment_currency = sanitize_text_field( $_REQUEST['payment_currency'] );
    $accept_payment = sanitize_text_field( $_REQUEST['accept_payment'] );
    $cash_status = sanitize_text_field( $_REQUEST['cash_checkout'] );
	$checkout = sanitize_text_field( $_REQUEST['checkout'] );
    $api_username = sanitize_text_field( $_REQUEST['api_username'] );
	$api_password = sanitize_text_field( $_REQUEST['api_password'] );
	$api_signature = sanitize_text_field( $_REQUEST['api_signature'] );
    $checkout_sandbox_mode = sanitize_text_field( $_REQUEST['checkout_sandbox_mode'] );
    $paypal_checkout = sanitize_text_field( $_REQUEST['paypal_checkout'] );
    $paypal_email = sanitize_text_field( $_REQUEST['paypal_email'] );
    $payment_mode = sanitize_text_field( $_REQUEST['payment_mode'] );
    $razorpay_checkout = sanitize_text_field( $_REQUEST['razorpay_checkout'] );
	$razorpay_api_key = sanitize_text_field( $_REQUEST['razorpay_api_key'] );
    $razorpay_name = sanitize_text_field( $_REQUEST['razorpay_name'] );
    $razorpay_description = sanitize_text_field( $_REQUEST['razorpay_description'] );
    $razorpay_logo = sanitize_text_field( $_REQUEST['razorpay_logo'] );
    $razorpay_theme_color = sanitize_text_field( $_REQUEST['razorpay_theme_color'] );
	$stripe_enable = sanitize_text_field( $_REQUEST['stripe_enable'] );
    $stripe_apikey = sanitize_text_field( $_REQUEST['stripe_apikey'] );
    $stripe_secretkey = sanitize_text_field( $_REQUEST['stripe_secretkey'] );
	
    $newpaymentoptions = array(
    	'payment_currency' => "$payment_currency", 
    	'accept_payment' => "$accept_payment", 
    	'cash_checkout' => "$cash_status",
    	'api_username' => "$api_username", 
    	'api_password' => "$api_password",
    	'api_signature' => "$api_signature",
    	'checkout_sandbox_mode' => "$checkout_sandbox_mode", 
    	'paypal_checkout' => "$paypal_checkout", 
    	'paypal_email' => "$paypal_email",
    	'payment_mode' => "$payment_mode",
    	'razorpay_checkout' => "$razorpay_checkout",
    	'razorpay_api_key' => "$razorpay_api_key",
    	'razorpay_name' => "$razorpay_name",
    	'razorpay_currency'=>'USD',
    	'razorpay_description' => "$razorpay_description",
    	'razorpay_theme_color' => "$razorpay_theme_color", 
    	'razorpay_logo' => "$razorpay_logo",
		'stripe_enable' => "$stripe_enable",
    	'stripe_apikey' => "$stripe_apikey",
    	'stripe_secretkey' => "$stripe_secretkey",
		);

   	update_option('weblizar_aps_payment_setting',$newpaymentoptions);
}
if(isset($_REQUEST['cal_theme_style']))
{
    $cal_theme_style = sanitize_text_field( $_REQUEST['cal_theme_style'] );
	$ap_cal_date_format = sanitize_text_field( $_REQUEST['ap_cal_date_format'] );
	$ap_cal_time_format = sanitize_text_field( $_REQUEST['ap_cal_time_format'] );
	$calendar_view = sanitize_text_field( $_REQUEST['calendar_view'] );
    $calendar_start_day = sanitize_text_field( $_REQUEST['calendar_start_day'] );
	$pending_color = sanitize_text_field( $_REQUEST['pending_color'] );
	$approved_color = sanitize_text_field( $_REQUEST['approved_color'] );
	$cancelled_color = sanitize_text_field( $_REQUEST['cancelled_color'] );
	$completed_color = sanitize_text_field( $_REQUEST['completed_color'] );
	$time_off_color = sanitize_text_field( $_REQUEST['time_off_color'] );
    $cal_font_style = sanitize_text_field( $_REQUEST['cal_font_style'] );
   
  //   $wpdb->update(
  //       $wpdb->prefix.'apt_settings',
  //       array(
		//  'cal_theme_style' => $cal_theme_style,
		//  'cal_font_style' => $cal_font_style,
		//  'cal_date_format' => $ap_cal_date_format,
		//  'cal_time_format' => $ap_cal_time_format,
		//  'cal_view' => $calendar_view,
		//  'cal_first_day' => $calendar_start_day, 
		//   'cal_pending_color' => $pending_color,
		//  'cal_approved_color' => $approved_color, 
		//   'cal_cancelled_color' => $cancelled_color, 
		//   'cal_completed_color' => $completed_color, 
		//  'cal_off_time_color' => $time_off_color,
		//  ),
		//   array( 'id' => '1' )
		// );
    $calendar_view_setting = array(
		 'cal_theme_style' => $cal_theme_style,
		 'cal_font_style' => $cal_font_style,
		 'cal_date_format' => $ap_cal_date_format,
		 'cal_time_format' => $ap_cal_time_format,
		 'cal_view' => $calendar_view,
		 'cal_first_day' => $calendar_start_day, 
		  'cal_pending_color' => $pending_color,
		 'cal_approved_color' => $approved_color, 
		  'cal_cancelled_color' => $cancelled_color, 
		  'cal_completed_color' => $completed_color, 
		 'cal_off_time_color' => $time_off_color,
		 );
    update_option('weblizar_aps_calendar_view_setting',$calendar_view_setting);
}
if(isset($_REQUEST['advance_booking_time']))
{
    $advance_booking_time = sanitize_text_field( $_REQUEST['advance_booking_time'] );
	$advance_cancel_time = sanitize_text_field( $_REQUEST['advance_cancel_time'] );
   
   $wpdb->update(
        $wpdb->prefix.'apt_settings',
        array(
		 'advance_booking_time' => $advance_booking_time,
		 'advance_cancel_time' => $advance_cancel_time, ),
		  array( 'id' => '1' )
		);
}
if(isset($_REQUEST['reminder_time']))
{
		$enable_reminder =  $_REQUEST['enable_reminder'] ;
		$reminder_time =  $_REQUEST['reminder_time'] ;
		$subject_reminder = $_REQUEST['subject_reminder'] ;
		$body_reminder = $_REQUEST['body_reminder'] ;
	
	$wpdb->update(
        $wpdb->prefix.'apt_settings',
        array(
		'enable_reminder' => $enable_reminder,
		'reminder_time' => $reminder_time,),
		  array( 'id' => '1' )
		);
		
		$Appoint_reminder_settings = array(
			'subject_notification_reminder' => $subject_reminder, 
		  'body_notification_reminder' => $body_reminder,
	);
	update_option("Appoint_reminder_notification", $Appoint_reminder_settings);
}

$settings_table =	$wpdb->prefix."apt_settings";
?>
<?php 
	$date_format = get_option( 'date_format' );
	$time_format = get_option( 'time_format' ); 
	$email_reminder_settings= get_option("Appoint_reminder_notification");
 	/*Staff Dashboard Settings*/
	if(isset($_REQUEST['staff_calendar_setting'])){
		$staff_calendar_setting = $_REQUEST['staff_calendar_setting'];
		$staff_calendar_edit = $_REQUEST['calendar_edit'];
		$staff_loc_setting = $_REQUEST['staff_loc_setting'];
		$staff_loc_edit = $_REQUEST['loc_edit'];
		$staff_service_setting = $_REQUEST['staff_service_setting'];
		$staff_service_edit = $_REQUEST['service_edit'];
		$staff_profile_setting = $_REQUEST['staff_profile_setting'];
		$staff_profile_edit = $_REQUEST['profile_edit'];
		$staff_appointment_setting = $_REQUEST['staff_appointment_setting'];
		$staff_dashboard_setting = $_REQUEST['staff_dashboard_setting'];
		$staff_appointment_edit = $_REQUEST['appointment_edit'];
		$new_appointment_staff_settings = array(
			'staff_calendar_setting' => $staff_calendar_setting,
		 	'calendar_edit' => $staff_calendar_edit,
		 	'staff_loc_setting' => $staff_loc_setting,
	 		'loc_edit' => $staff_loc_edit,
	 		'staff_service_setting' => $staff_service_setting,
	 		'service_edit' => $staff_service_edit,
	 		'staff_profile_setting' => $staff_profile_setting,
	 		'profile_edit' => $staff_profile_edit,
	 		'staff_appointment_setting' => $staff_appointment_setting,
	 		'staff_dashboard_setting' => $staff_dashboard_setting,
	 		'appointment_edit' => $staff_appointment_edit,
		);
		update_option('weblizar_aps_staff_dashboard_settings',$new_appointment_staff_settings);
	}
	/*customer login*/
	if(isset($_REQUEST['client_appointment'])){
		$client_appointment = $_REQUEST['client_appointment'];
		$new_appointment_client_settings = array(
			'client_appointment' => $client_appointment
		);
		update_option('weblizar_aps_client_dashboard_settings',$new_appointment_client_settings);
	}
	/*google calendar sync settings start*/
	if(isset($_REQUEST['ap_cal_google_mail'])){
		$ap_cal_google_mail = $_REQUEST['ap_cal_google_mail'];
		$ap_cal_client_id = $_REQUEST['ap_cal_client_id'];
		$ap_cal_secret_key = $_REQUEST['ap_cal_secret_key'];
		$ap_redirect_uri = get_site_url()."/wp-admin/admin.php?page=ap_system";
		$ap_redirect_uri = $ap_redirect_uri;
		// $ap_two_way_sync = $_REQUEST['ap_two_way_sync'];
		if(isset($_REQUEST['ap_two_way_sync']) && !empty($_REQUEST['ap_two_way_sync'])){
			$ap_two_way_sync = $_REQUEST['ap_two_way_sync'];
		}
		else{
			$ap_two_way_sync = "no";
		} 
		$ap_calendar_sync_settings = array(
			'ap_cal_google_mail' => $ap_cal_google_mail,
			'ap_cal_client_id' => $ap_cal_client_id,
			'ap_cal_secret_key' => $ap_cal_secret_key,			 
			'ap_redirect_url' => $ap_redirect_uri,
			'ap_two_way_sync' => $ap_two_way_sync		
		);
		update_option('weblizar_ap_calendar_sync_settings',$ap_calendar_sync_settings);
	}
	$Gsync_ojb = new GoogleCalendarApi();
	if(isset($_GET['code'])){
		$code = $_GET['code'];
		$save_sync_setting = get_option('weblizar_ap_calendar_sync_settings');
		$ap_cal_client_id = $save_sync_setting['ap_cal_client_id'];			
		$ap_cal_secret_key = $save_sync_setting['ap_cal_secret_key'];
		$ap_redirect_uri = $save_sync_setting['ap_redirect_url'];
		
		// check if access token and refresh token already set
		if(!$saved_access_toekn && !$saved_refresh_token) {
			$data = $Gsync_ojb->GetAccessToken($ap_cal_client_id, $ap_redirect_uri, $ap_cal_secret_key, $_GET['code']);
			
			$_SESSION['access_token_expiry'] = time() + $data['expires_in'];
			$expireTime = $_SESSION['access_token_expiry'];
			$expireTime = time() + $data['expires_in'];
			if(array_key_exists('refresh_token', $data)){
				$refresh_token = $data['refresh_token'];	
				$_SESSION['refresh_token'] = $data['refresh_token'];
			}
			$refresh_token = $data['refresh_token'];
			$_SESSION['refresh_token'] = $data['refresh_token'];
			$access_token = $data['access_token'];
			$_SESSION['access_token'] = $data['access_token'];
			$_SESSION['access_token_expiry'] = time() + $data['expires_in'];
			$sync_setting = array(
				'code' => $code,
				'access_token' => $access_token,
				'refresh_token' => $refresh_token,
				'expireTime' => $expireTime		
			);
			update_option('weblizar_ap_calendar_refresh_token', $sync_setting);	
			$url_to_redirect = get_site_url()."/wp-admin/admin.php?page=ap_system";
			//header("location: $url_to_redirect");
			//@wp_redirect($url_to_redirect);
			//exit;
			?>
			<script>
				window.location = "<?php echo $url_to_redirect; ?>";
			</script>
			<?php
		}		
	}
	
	//DSYNC
	$url_to_redirect = get_site_url()."/wp-admin/admin.php?page=ap_system";
	if(isset($_REQUEST['dval'])){
		$dval = $_REQUEST['dval'];
		if($_REQUEST['dval'] == "1"){
			$sync_setting = array(
			'access_token' => "",
			'refresh_token' => "",
			'expireTime' => ""		
		 );
			update_option('weblizar_ap_calendar_refresh_token', $sync_setting);
			//header("location: $url_to_redirect");
		}
	}
?>
<div class="panel panel-default">
						<div class="panel-heading"><i class="fas fa-cog"></i><span class="panel_heading"><?php _e('Settings',WL_A_P_SYSTEM); ?></span></div>
						<div class="panel-body">
							<div class="app-settings-menu" >
								<ul class="nav nav-tabs" id="setting_tab">
									<li class="general active"><a data-toggle="tab" class="ap_second_side_bar" href="#general"><i class="fas fa-th-list "></i>
									<span class="panel_heading">  <?php _e('General Setting',WL_A_P_SYSTEM); ?></span></a></li>
									<li class="bussiness"><a data-toggle="tab" class="ap_second_side_bar" href="#bussiness"><i class="fas fa-building"></i>
									<span class="panel_heading"><?php _e('Business Info ',WL_A_P_SYSTEM); ?></span></a></li>
									<li class="bussiness-hour"><a data-toggle="tab" class="ap_second_side_bar" href="#bussiness-hour"><i class="fas fa-clock"></i>
									<span class="panel_heading"><?php _e('Business Hours',WL_A_P_SYSTEM); ?></span></a></li>
									<li class="payment"><a data-toggle="tab" class="ap_second_side_bar" href="#g-payment"><i class="far fa-money-bill-alt"></i>
									<span class="panel_heading"><?php _e('Payment Setting',WL_A_P_SYSTEM); ?></span></a></li>
									<li class="st-calendar"><a data-toggle="tab" class="ap_second_side_bar" href="#st-calendar"><i class="fas fa-calendar"></i>
									<span class="panel_heading"><?php _e('Calendar Setting',WL_A_P_SYSTEM); ?></span> </a></li>
									<li class="sync_dashboard"><a data-toggle="tab" class="ap_second_side_bar" href="#sync_setting"><i class="fas fa-cog"></i>
									<span class="panel_heading"><?php _e('Calendar Sync',WL_A_P_SYSTEM); ?></span></a></li>
									<!--<li class="cancel-appoint"><a data-toggle="tab" class="ap_second_side_bar" href="#cancel-appoint"><i class="far fa-money-bill-alt"></i>
									<span class="panel_heading"><?php _e('Cancel Appointment',WL_A_P_SYSTEM); ?></span></a></li>-->
									<li class="reminder"><a data-toggle="tab" class="ap_second_side_bar" href="#reminder"><i class="fas fa-clock"></i>
									<span class="panel_heading"><?php _e('Reminder Setting',WL_A_P_SYSTEM); ?></span></a></li>
									<li class="staff_dashboard"><a data-toggle="tab" class="ap_second_side_bar" href="#staff_dashboard"><i class="fas fa-cog"></i>
									<span class="panel_heading"><?php _e('Staff Dashboard',WL_A_P_SYSTEM); ?></span></a></li>
									<li class="client_dashboard"><a data-toggle="tab" class="ap_second_side_bar" href="#client_dashboard"><i class="fas fa-cog"></i>
									<span class="panel_heading"><?php _e('Client Dashboard',WL_A_P_SYSTEM); ?></span></a></li>
									<li class="remove"><a data-toggle="tab" class="ap_second_side_bar" href="#remove"><i class="fas fa-eraser"></i>
									<span class="panel_heading"><?php _e('Remove Plugin',WL_A_P_SYSTEM); ?></span></a></li>
								</ul>
							</div>
							<div class="app-settings">
								<div class="tab-content">
									<div id="general" class="tab-pane fade in active">
										<h2> <?php _e('General Setting',WL_A_P_SYSTEM); ?></h2>
										<div class="col-md-8 bussiness-form">
											<form style="margin-bottom: 0;" action="" method="POST" id="ap_general_settings" >
											<div class="col-md-12 bs-form form-group">
													<div class="col-md-4"><label><?php _e('Date Format',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-8">
													 <span class="date-time-text format-i18n"><?php echo date($date_format);?></span><code><?php echo $date_format  ?></code>
													</div>
											</div>
											<div class="col-md-12 bs-form form-group">
													<div class="col-md-4"><label><?php _e('Time Format',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-8">
											         <span class="date-time-text format-i18n"><?php echo date($time_format);?></span><code><?php echo $time_format;?></code>
													</div>
													
											</div>
											<div class="col-md-12 bs-form form-group">
													<div class="col-md-4"></div>
													<div class="col-md-8">
											         <a href="options-general.php" class="btn btn-info"><?php _e('Click Here To Change',WL_A_P_SYSTEM); ?></a>
													</div>
											</div>
												<div class="col-md-12 bs-form form-group">
													<div class="col-md-4"><label> <?php _e('Currency Setting',WL_A_P_SYSTEM); ?></label></div>
													<?php $settings_currency = get_option('weblizar_aps_general_setting'); 
													$currency = $settings_currency['currency'];?>
													<div class="col-md-6">
														<select name="currency" class="form-control" id="currency">
														<option value="0" selected="selected"> <?php _e('Select Currency',WL_A_P_SYSTEM); ?></option>
															    <option value="AED" <?php selected($currency, 'AED' ); ?>>United Arab Emirates dirham</option>
																<option value="AFN" <?php selected($currency, 'AFN' ); ?>>Afghan afghani</option>
																<option value="ALL" <?php selected($currency, 'ALL' ); ?>>Albanian lek</option>
																<option value="AMD" <?php selected($currency, 'AMD' ); ?>>Armenian dram</option>
																<option value="AOA" <?php selected($currency, 'AOA' ); ?>>Angolan kwanza</option>
																<option value="ARS" <?php selected($currency, 'ARS' ); ?>>Argentine peso</option>
																<option value="AUD" <?php selected($currency, 'AUD' ); ?>>Australian dollar</option>
																<option value="AWG" <?php selected($currency, 'AWG' ); ?>>Aruban florin</option>
																<option value="AZN" <?php selected($currency, 'AZN' ); ?>>Azerbaijani manat</option>
																<option value="BAM" <?php selected($currency, 'BAM' ); ?>>Bosnia and Herzegovina convertible mark</option>
																<option value="BBD" <?php selected($currency, 'BBD' ); ?>>Barbadian dollar</option>
																<option value="BDT" <?php selected($currency, 'BDT' ); ?>>Bangladeshi taka</option>
																<option value="BGN" <?php selected($currency, 'BGN' ); ?>>Bulgarian lev</option>
																<option value="BHD" <?php selected($currency, 'BHD' ); ?>>Bahraini dinar</option>
																<option value="BIF" <?php selected($currency, 'BIF' ); ?>>Burundian franc</option>
																<option value="BMD" <?php selected($currency, 'BMD' ); ?>>Bermudian dollar</option>
																<option value="BND" <?php selected($currency, 'BND' ); ?>>Brunei dollar</option>
																<option value="BOB" <?php selected($currency, 'BOB' ); ?>>Bolivian boliviano</option>
																<option value="BRL" <?php selected($currency, 'BRL' ); ?>>Brazilian real</option>
																<option value="BSD" <?php selected($currency, 'BSD' ); ?>>Bahamian dollar</option>
																<option value="BTN" <?php selected($currency, 'BTN' ); ?>>Bhutanese ngultrum</option>
																<option value="BWP" <?php selected($currency, 'BWP' ); ?>>Botswana pula</option>
																<option value="BYR" <?php selected($currency, 'BYR' ); ?>>Belarusian ruble</option>
																<option value="BZD" <?php selected($currency, 'BZD' ); ?>>Belize dollar</option>
																<option value="CAD" <?php selected($currency, 'CAD' ); ?>>Canadian dollar</option>
																<option value="CDF" <?php selected($currency, 'CDF' ); ?>>Congolese franc</option>
																<option value="CHF" <?php selected($currency, 'CHF' ); ?>>Swiss franc</option>
																<option value="CLP" <?php selected($currency, 'CLP' ); ?>>Chilean peso</option>
																<option value="CNY" <?php selected($currency, 'CNY' ); ?>>Chinese yuan</option>
																<option value="COP" <?php selected($currency, 'COP' ); ?>>Colombian peso</option>
																<option value="CRC" <?php selected($currency, 'CRC' ); ?>>Costa Rican colon</option>
																<option value="CUP" <?php selected($currency, 'CUP' ); ?>>Cuban convertible peso</option>
																<option value="CVE" <?php selected($currency, 'CVE' ); ?>>Cape Verdean escudo</option>
																<option value="CZK" <?php selected($currency, 'CZK' ); ?>>Czech koruna</option>
																<option value="DJF" <?php selected($currency, 'DJF' ); ?>>Djiboutian franc</option>
																<option value="DKK" <?php selected($currency, 'DKK' ); ?>>Danish krone</option>
																<option value="DOP" <?php selected($currency, 'DOP' ); ?>>Dominican peso</option>
																<option value="DZD" <?php selected($currency, 'DZD' ); ?>>Algerian dinar</option>
																<option value="EGP" <?php selected($currency, 'EGP' ); ?>>Egyptian pound</option>
																<option value="ERN" <?php selected($currency, 'ERN' ); ?>>Eritrean nakfa</option>
																<option value="ETB" <?php selected($currency, 'ETB' ); ?>>Ethiopian birr</option>
																<option value="EUR" <?php selected($currency, 'EUR' ); ?>>Euro</option>
																<option value="FJD" <?php selected($currency, 'FJD' ); ?>>Fijian dollar</option>
																<option value="FKP" <?php selected($currency, 'FKP' ); ?>>Falkland Islands pound</option>
																<option value="GBP" <?php selected($currency, 'GBP' ); ?>>British pound</option>
																<option value="GEL" <?php selected($currency, 'GEL' ); ?>>Georgian lari</option>
																<option value="GHS" <?php selected($currency, 'GHS' ); ?>>Ghana cedi</option>
																<option value="GMD" <?php selected($currency, 'GMD' ); ?>>Gambian dalasi</option>
																<option value="GNF" <?php selected($currency, 'GNF' ); ?>>Guinean franc</option>
																<option value="GTQ" <?php selected($currency, 'GTQ' ); ?>>Guatemalan quetzal</option>
																<option value="GYD" <?php selected($currency, 'GYD' ); ?>>Guyanese dollar</option>
																<option value="HKD" <?php selected($currency, 'HKD' ); ?>>Hong Kong dollar</option>
																<option value="HNL" <?php selected($currency, 'HNL' ); ?>>Honduran lempira</option>
																<option value="HRK" <?php selected($currency, 'HRK' ); ?>>Croatian kuna</option>
																<option value="HTG" <?php selected($currency, 'HTG' ); ?>>Haitian gourde</option>
																<option value="HUF" <?php selected($currency, 'HUF' ); ?>>Hungarian forint</option>
																<option value="IDR" <?php selected($currency, 'IDR' ); ?>>Indonesian rupiah</option>
																<option value="ILS" <?php selected($currency, 'ILS' ); ?>>Israeli new shekel</option>
																<option value="IMP" <?php selected($currency, 'IMP' ); ?>>Manx pound</option>
																<option value="INR" <?php selected($currency, 'INR' ); ?>>Indian rupee</option>
																<option value="IQD" <?php selected($currency, 'IQD' ); ?>>Iraqi dinar</option>
																<option value="IRR" <?php selected($currency, 'IRR' ); ?>>Iranian rial</option>
																<option value="ISK" <?php selected($currency, 'ISK' ); ?>>Icelandic krona</option>
																<option value="JEP" <?php selected($currency, 'JEP' ); ?>>Jersey pound</option>
																<option value="JMD" <?php selected($currency, 'JMD' ); ?>>Jamaican dollar</option>
																<option value="JOD" <?php selected($currency, 'JOD' ); ?>>Jordanian dinar</option>
																<option value="JPY" <?php selected($currency, 'JPY' ); ?>>Japanese yen</option>
																<option value="KES" <?php selected($currency, 'KES' ); ?>>Kenyan shilling</option>
																<option value="KGS" <?php selected($currency, 'KGS' ); ?>>Kyrgyzstani som</option>
																<option value="KHR" <?php selected($currency, 'KHR' ); ?>>Cambodian riel</option>
																<option value="KMF" <?php selected($currency, 'KMF' ); ?>>Comorian franc</option>
																<option value="KPW" <?php selected($currency, 'KPW' ); ?>>North Korean won</option>
																<option value="KRW" <?php selected($currency, 'KRW' ); ?>>South Korean won</option>
																<option value="KWD" <?php selected($currency, 'KWD' ); ?>>Kuwaiti dinar</option>
																<option value="KYD" <?php selected($currency, 'KYD' ); ?>>Cayman Islands dollar</option>
																<option value="KZT" <?php selected($currency, 'KZT' ); ?>>Kazakhstani tenge</option>
																<option value="LAK" <?php selected($currency, 'LAK' ); ?>>Lao kip</option>
																<option value="LBP" <?php selected($currency, 'LBP' ); ?>>Lebanese pound</option>
																<option value="LKR" <?php selected($currency, 'LKR' ); ?>>Sri Lankan rupee</option>
																<option value="LRD" <?php selected($currency, 'LRD' ); ?>>Liberian dollar</option>
																<option value="LSL" <?php selected($currency, 'LSL' ); ?>>Lesotho loti</option>
																<option value="LTL" <?php selected($currency, 'LTL' ); ?>>Lithuanian litas</option>
																<option value="LVL" <?php selected($currency, 'LVL' ); ?>>Latvian lats</option>
																<option value="LYD" <?php selected($currency, 'LYD' ); ?>>Libyan dinar</option>
																<option value="MAD" <?php selected($currency, 'MAD' ); ?>>Moroccan dirham</option>
																<option value="MDL" <?php selected($currency, 'MDL' ); ?>>Moldovan leu</option>
																<option value="MGA" <?php selected($currency, 'MGA' ); ?>>Malagasy ariary</option>
																<option value="MKD" <?php selected($currency, 'MKD' ); ?>>Macedonian denar</option>
																<option value="MMK" <?php selected($currency, 'MMK' ); ?>>Burmese kyat</option>
																<option value="MNT" <?php selected($currency, 'MNT' ); ?>>Mongolian togrog</option>
																<option value="MOP" <?php selected($currency, 'MOP' ); ?>>Macanese pataca</option>
																<option value="MRO" <?php selected($currency, 'MRO' ); ?>>Mauritanian ouguiya</option>
																<option value="MUR" <?php selected($currency, 'MUR' ); ?>>Mauritian rupee</option>
																<option value="MVR" <?php selected($currency, 'MVR' ); ?>>Maldivian rufiyaa</option>
																<option value="MWK" <?php selected($currency, 'MWK' ); ?>>Malawian kwacha</option>
																<option value="MXN" <?php selected($currency, 'MXN' ); ?>>Mexican peso</option>
																<option value="MYR" <?php selected($currency, 'MYR' ); ?>>Malaysian ringgit</option>
																<option value="MZN" <?php selected($currency, 'MZN' ); ?>>Mozambican metical</option>
																<option value="NAD" <?php selected($currency, 'NAD' ); ?>>Namibian dollar</option>
																<option value="NGN" <?php selected($currency, 'NGN' ); ?>>Nigerian naira</option>
																<option value="NIO" <?php selected($currency, 'NIO' ); ?>>Nicaraguan cordoba</option>
																<option value="NOK" <?php selected($currency, 'NOK' ); ?>>Norwegian krone</option>
																<option value="NPR" <?php selected($currency, 'NPR' ); ?>>Nepalese rupee</option>
																<option value="NZD" <?php selected($currency, 'NZD' ); ?>>New Zealand dollar</option>
																<option value="OMR" <?php selected($currency, 'OMR' ); ?>>Omani rial</option>
																<option value="PAB" <?php selected($currency, 'PAB' ); ?>>Panamanian balboa</option>
																<option value="PEN" <?php selected($currency, 'PEN' ); ?>>Peruvian nuevo sol</option>
																<option value="PGK" <?php selected($currency, 'PGK' ); ?>>Papua New Guinean kina</option>
																<option value="PHP" <?php selected($currency, 'PHP' ); ?>>Philippine peso</option>
																<option value="PKR" <?php selected($currency, 'PKR' ); ?>>Pakistani rupee</option>
																<option value="PLN" <?php selected($currency, 'PLN' ); ?>>Polish zloty</option>
																<option value="PRB" <?php selected($currency, 'PRB' ); ?>>Transnistrian ruble</option>
																<option value="PYG" <?php selected($currency, 'PYG' ); ?>>Paraguayan guarani</option>
																<option value="QAR" <?php selected($currency, 'QAR' ); ?>>Qatari riyal</option>
																<option value="RON" <?php selected($currency, 'RON' ); ?>>Romanian leu</option>
																<option value="RSD" <?php selected($currency, 'RSD' ); ?>>Serbian dinar</option>
																<option value="RUB" <?php selected($currency, 'RUB' ); ?>>Russian ruble</option>
																<option value="RWF" <?php selected($currency, 'RWF' ); ?>>Rwandan franc</option>
																<option value="SAR" <?php selected($currency, 'SAR' ); ?>>Saudi riyal</option>
																<option value="SBD" <?php selected($currency, 'SBD' ); ?>>Solomon Islands dollar</option>
																<option value="SCR" <?php selected($currency, 'SCR' ); ?>>Seychellois rupee</option>
																<option value="SDG" <?php selected($currency, 'SDG' ); ?>>Singapore dollar</option>
																<option value="SEK" <?php selected($currency, 'SEK' ); ?>>Swedish krona</option>
																<option value="SGD" <?php selected($currency, 'SGD' ); ?>>Singapore dollar</option>
																<option value="SHP" <?php selected($currency, 'SHP' ); ?>>Saint Helena pound</option>
																<option value="SLL" <?php selected($currency, 'SLL' ); ?>>Sierra Leonean leone</option>
																<option value="SOS" <?php selected($currency, 'SOS' ); ?>>Somali shilling</option>
																<option value="SRD" <?php selected($currency, 'SRD' ); ?>>Surinamese dollar</option>
																<option value="SSP" <?php selected($currency, 'SSP' ); ?>>South Sudanese pound</option>
																<option value="STD" <?php selected($currency, 'STD' ); ?>>Sao Tome and Principe dobra</option>
																<option value="SVC" <?php selected($currency, 'SVC' ); ?>>Salvadoran colon</option>
																<option value="SYP" <?php selected($currency, 'SYP' ); ?>>Syrian pound</option>
																<option value="SZL" <?php selected($currency, 'SZL' ); ?>>Swazi lilangeni</option>
																<option value="THB" <?php selected($currency, 'THB' ); ?>>Thai baht</option>
																<option value="TJS" <?php selected($currency, 'TJS' ); ?>>Tajikistani somoni</option>
																<option value="TMT" <?php selected($currency, 'TMT' ); ?>>Turkmenistan manat</option>
																<option value="TND" <?php selected($currency, 'TND' ); ?>>Tunisian dinar</option>
																<option value="TOP" <?php selected($currency, 'TOP' ); ?>>Tongan pa?anga</option>
																<option value="TRY" <?php selected($currency, 'TRY' ); ?>>Turkish lira</option>
																<option value="TTD" <?php selected($currency, 'TTD' ); ?>>Trinidad and Tobago dollar</option>
																<option value="TWD" <?php selected($currency, 'TWD' ); ?>>New Taiwan dollar</option>
																<option value="TZS" <?php selected($currency, 'TZS' ); ?>>Tanzanian shilling</option>
																<option value="UAH" <?php selected($currency, 'UAH' ); ?>>Ukrainian hryvnia</option>
																<option value="UGX" <?php selected($currency, 'UGX' ); ?>>Ugandan shilling</option>
																<option value="USD" <?php selected($currency, 'USD' ); ?>>United States dollar</option>
																<option value="UYU"<?php selected($currency, 'UYU' ); ?>>Uruguayan peso</option>
																<option value="UZS" <?php selected($currency, 'UZS' ); ?>>Uzbekistani som</option>
																<option value="VEF" <?php selected($currency, 'VEF' ); ?>>Venezuelan bolivar</option>
																<option value="VND" <?php selected($currency, 'VND' ); ?>>Vietnamese d?ng</option>
																<option value="VUV" <?php selected($currency, 'VUV' ); ?>>Vanuatu vatu</option>
																<option value="WST" <?php selected($currency, 'WST' ); ?>>Samoan tala</option>
																<option value="XAF"<?php selected($currency, 'XAF' ); ?>>Central African CFA franc</option>
																<option value="XCD" <?php selected($currency, 'XCD' ); ?>>East Caribbean dollar</option>
																<option value="XOF" <?php selected($currency, 'XOF' ); ?>>West African CFA franc</option>
																<option value="XPF" <?php selected($currency, 'XPF' ); ?>>CFP franc</option>
																<option value="YER" <?php selected($currency, 'YER' ); ?>>Yemeni rial</option>
																<option value="ZAR" <?php selected($currency, 'ZAR' ); ?>>South African rand</option>
																<option value="ZMW" <?php selected($currency, 'ZMW' ); ?>>Zambian kwacha</option>
																<option value="ZWL" <?php selected($currency, 'ZWL' ); ?>>Zimbabwean dollar</option>
														</select>
														 <span class="validation_alert" id="currency_alert"><?php _e("Please select Currency",WL_A_P_SYSTEM ); ?></span>
													</div>
												</div>
												<div class="col-md-12 bs-form form-group">
													<div class="row">
														<div class="col-md-3"><label> <?php _e('Theme Color',WL_A_P_SYSTEM); ?></label></div>
														<div class="col-md-6">
															<?php $settings_ap_theme_color = get_option('weblizar_aps_general_setting'); 
															$ap_theme_color	= $settings_ap_theme_color['ap_theme_color'];?>
															<input type="text" name="ap_theme_color" name="ap_theme_color" class="theme_color_picker" value="<?php echo $ap_theme_color; ?>"/>
														</div>
													</div>
												</div>	
												
												<div class="col-md-12 bs-form form-group">
													<div class="col-md-4"><label> <?php _e('Show Time Slots by',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-6">
														<select id="time_slots" name="time_slots" id="time_slots" class="form-control">
														<?php $settings_time_slots = get_option('weblizar_aps_general_setting'); 
														$time_slots	= $settings_time_slots['time_slots'];?>
															<option value="" selected="selected"> <?php _e('Select Time Slots',WL_A_P_SYSTEM); ?></option>
															<option value="service_slots" <?php if($time_slots == 'service_slots') { echo 'selected'; } else { echo ''; } ?>> <?php _e('Service',WL_A_P_SYSTEM); ?></option>
															<option value="custom_slots" <?php if($time_slots == 'custom_slots') { echo 'selected'; } else { echo ''; } ?>> <?php _e('Custom Slots',WL_A_P_SYSTEM); ?></option>
														</select>
													</div>
												</div>	
												
												
												<div class="col-md-12 bs-form form-group custom">
													<div class="col-md-4"><label> <?php _e('Time Slots (in minutes):',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-6">
															<?php $settings_custom_slot = get_option('weblizar_aps_general_setting'); 
															$custom_slot	= $settings_custom_slot['custom_slot'];?>
															<select name="custom_slot" id="custom_slot" class="form-control">

															<?php 
															for($i=5; $i<=300; $i+=5)
															{	?>
																
																<option value="<?php echo $i; ?>" <?php selected($custom_slot,  $i ); ?>><?php echo $i; ?></option>
															<?php }	?> 
															</select>
													</div>
												</div>
												
												<div class="col-md-12 bs-form form-group service_duration_type">
													<div class="col-md-4"><label><?php _e('Show Service Duration to User According to :',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-6">
															<?php $settings_service_duration_type = get_option('weblizar_aps_general_setting'); 
															$service_duration_type	= $settings_service_duration_type['service_duration_type'];?>
															<select name="service_duration_type" id="service_duration_type" class="form-control">
																<option value="" selected="selected"><?php _e('Select',WL_A_P_SYSTEM); ?></option>
																<option value="sd" <?php if($service_duration_type == 'sd') { echo 'selected'; } else { echo ''; } ?>><?php _e('Service Duration',WL_A_P_SYSTEM); ?></option>
																<option value="sd_pt" <?php if($service_duration_type == 'sd_pt') { echo 'selected'; } else { echo ''; } ?>><?php _e('Service Duration & Padding Time(before)',WL_A_P_SYSTEM); ?></option>
															</select>
													</div>
												</div>
												
												<!-- <div class="col-md-12 bs-form form-group">
													<div class="col-md-4"><label> <?php _e('Disable Time Slots Acoording to Appointment Status',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-6">
															<?php $settings_appt_status = get_option('weblizar_aps_general_setting'); 
																  $appt_status	= $settings_appt_status['appt_status'];?>
														<input type="radio" name="appt_status"  id="appt_status" value="pending" <?php if($appt_status=='pending'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Pending',WL_A_P_SYSTEM); ?>
														<input type="radio" name="appt_status"  id="appt_status" value="approved" <?php if($appt_status=='approved'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Approved',WL_A_P_SYSTEM); ?>
													</div>
												</div> -->
												<div class="col-md-12 bs-form form-group">
													<div class="col-md-4"><label> <?php _e('Disable Time Slots For Pending Appointment Status',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-6">
															<?php $settings_appt_status = get_option('weblizar_aps_general_setting'); 
																  $appt_status_pending	= $settings_appt_status['appt_status_pending'];?>
														<input type="radio" name="appt_status_pending"  id="appt_status_pending" value="yes" <?php if($appt_status_pending=='yes'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Yes',WL_A_P_SYSTEM); ?>
														<input type="radio" name="appt_status_pending"  id="appt_status_pending" value="no" <?php if($appt_status_pending=='no'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('No',WL_A_P_SYSTEM); ?>
													</div>
												</div>

												<div class="col-md-12 bs-form form-group">
													<button  type="button" class="btn save-link" id='save_settings_01'  onclick="return save_general_settings();"><?php _e('Save',WL_A_P_SYSTEM); ?></button>
												</div>
											</form>
										</div>
									</div>
									<div id="bussiness" class="tab-pane fade">
										<h2> <?php _e('Business Profile',WL_A_P_SYSTEM); ?></h2>
										<?php $biz_profile = get_option("weblizar_aps_bizprofile_setting"); ?>
										<div class="col-md-12 bussiness-form">
											<form style="margin-bottom: 0;" action="" method="POST" id="ap_bp_settings">
                                              <div class="row ad-ser">
												<div class="col-md-6 col-sm-6 bs-form form-group">
													<label> <?php _e('Business Name',WL_A_P_SYSTEM); ?></label>
													<?php //$settings_b_name = $wpdb->get_col( "SELECT b_name from $settings_table" ); 
													//$b_name	= $settings_b_name[0];?>
													<input type="text" name="b_name" id="b_name" class="form-control" value="<?php echo stripslashes( $biz_profile['b_name'] ); ?> <?php //echo $biz_profile['b_name'];?>" placeholder="Business Name"/>
													<span class="validation_alert" id="b_name_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
												</div>
												<div class="col-md-6 col-sm-6 bs-form form-group">
													<label><?php _e('Business Owner',WL_A_P_SYSTEM); ?></label>
													<?php //$settings_b_owner = $wpdb->get_col( "SELECT b_owner from $settings_table" ); 
													//$b_owner	= $settings_b_owner[0];?>
													<input type="text" name="b_owner" id="b_owner" class="form-control" value="<?php echo $biz_profile['b_owner'];?>" placeholder="Business Owner"/>
													<span class="validation_alert" id="b_owner_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
												</div>
                                                </div>
                                                 <div class="row ad-ser">  
												<div class="col-md-6 col-sm-6 bs-form form-group">
													<label> <?php _e('Phone No',WL_A_P_SYSTEM); ?></label>
													<?php //$settings_b_phone = $wpdb->get_col( "SELECT b_phone from $settings_table" ); 
													//$b_phone = $settings_b_phone[0];?>
													<input  name="b_phone" id="b_phone" class="phone form-control" value="<?php echo $biz_profile['b_phone'];?>" type="tel">
													<span class="validation_alert" id="b_phone_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
													<span class="validation_alert" id="b_no_phone_alert"><?php _e("This field is required number",WL_A_P_SYSTEM ); ?></span>
												</div>
												<div class="col-md-6 col-sm-6 bs-form form-group">
													<label> <?php _e('Fax No',WL_A_P_SYSTEM); ?></label>
													<?php //$settings_b_fax = $wpdb->get_col( "SELECT b_fax from $settings_table" ); 
													//$b_fax= $settings_b_fax[0];?>
													<input type="text" name="b_fax" id="b_fax" class="form-control" value="<?php echo $biz_profile['b_fax'];?>" placeholder="Fax No."/>
													<span class="validation_alert" id="b_fax_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
												</div>
                                                </div>
                                                 <div class="row ad-ser"> 
												<div class="col-md-6 col-sm-6 bs-form form-group">
													<label> <?php _e('Email-Id',WL_A_P_SYSTEM); ?></label>
													<?php //$settings_b_email = $wpdb->get_col( "SELECT b_email from $settings_table" ); 
													//$b_email	= $settings_b_email[0];?>
													<input type="email" name="b_email" id="b_email" class="form-control" value="<?php echo $biz_profile['b_email'];?>" placeholder="Email Id"/>
													<span class="validation_alert" id="b_email_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
													<span class="validation_alert" id="b_Invalid_email_alert"><?php _e("Invalid email",WL_A_P_SYSTEM ); ?></span>
												</div>
												<div class="col-md-6 col-sm-6 bs-form form-group">
													<label> <?php _e('Blog Url',WL_A_P_SYSTEM); ?></label>
													<?php //$settings_b_blog_url = $wpdb->get_col( "SELECT b_blog_url from $settings_table" ); 
													//$b_blog_url	= $settings_b_blog_url[0];?>
													<input type="text" name="b_blog_url" id="b_blog_url" value="<?php echo $biz_profile['b_blog_url'];?>" class="form-control" placeholder="Blog Url"/>
													<span class="validation_alert" id="b_blog_url_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
												</div>
                                                </div>
                                                <div class="row ad-ser">  
												<div class="col-md-6 col-sm-6 bs-form form-group">
													<label> <?php _e('Postel Code',WL_A_P_SYSTEM); ?></label>
													<?php //$settings_b_postal_code = $wpdb->get_col( "SELECT b_postal_code from $settings_table" ); 
													//$b_postal_code	= $settings_b_postal_code[0];?>
													<input type="text" name="b_postal_code" id="b_postal_code" value="<?php echo $biz_profile['b_postal_code'];?>" class="form-control" placeholder="Postel Code"/>
													<span class="validation_alert" id="b_postal_code_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
													<span class="validation_alert" id="b_postal_number_alert"><?php _e("This field is number",WL_A_P_SYSTEM ); ?></span>
												</div>
                                                </div> 
                                                 <div class="row ad-ser"> 
												<div class="col-md-12 col-sm-12 bs-form form-group">
													<label><?php _e('Business Address',WL_A_P_SYSTEM); ?></label>
													<?php //$settings_b_address = $wpdb->get_col( "SELECT b_address from $settings_table" ); 
													//$b_address	= $settings_b_address[0];?>
													<textarea name="b_address" id="b_address" rows="5" class="form-control" placeholder="Business Address"><?php echo $biz_profile['b_address'];?></textarea>
													<span class="validation_alert" id="b_address_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
												</div>
                                               </div>
												<div class="col-md-12 col-sm-12 bs-form form-group">
													<button  type="button" class="btn save-link" id='save_settings_02' onclick="return save_bp_setting();"> <?php _e('Save',WL_A_P_SYSTEM); ?></button>
												</div>
											</form>
										</div>
									</div>
									<div id="bussiness-hour" class="tab-pane fade">
										<h2> <?php _e('Business Hours',WL_A_P_SYSTEM); ?></h2>
										<div class="col-md-12 bussiness-form">
											<form style="margin-bottom: 0;" action="" method="POST" id="ap_bh_settings" name="ap_bh_settings">
												<div class="col-md-12 bs-form form-group table-responsive">
													<table class="schedule" style="width:100%">
																<thead>
																	<tr>
																		<th class="day"> <?php _e('Day',WL_A_P_SYSTEM); ?></th>
																		<th class="start-tm"> <?php _e('Start Time',WL_A_P_SYSTEM); ?></th>
																		<th class="end-tm"> <?php _e('End Time',WL_A_P_SYSTEM); ?></th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td class="day"> <?php _e('Monday',WL_A_P_SYSTEM); ?></td>
																		<td class="start-tm">
																			<?php  $settings_bh_monday_st = get_option("weblizar_aps_business_hours");
																			$monday = unserialize($settings_bh_monday_st['bh_monday']); ?>
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_monday_st" id="bh_monday_st" value="<?php echo $monday[0]['start_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		<td class="end-tm">
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_monday_et" id="bh_monday_et"  value="<?php echo $monday[0]['end_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td class="day"> <?php _e('Tuesday',WL_A_P_SYSTEM); ?></td>
																		<td class="start-tm">
																			<?php $settings_bh_tuesday_st = get_option("weblizar_aps_business_hours"); 
																			$tuesday= unserialize($settings_bh_tuesday_st['bh_tuesday']);?>
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_tuesday_st" id="bh_tuesday_st" value="<?php echo $tuesday[0]['start_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		<td class="end-tm">
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_tuesday_et" id="bh_tuesday_et" value="<?php  echo $tuesday[0]['end_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td class="day"> <?php _e('Wednesday',WL_A_P_SYSTEM); ?></td>
																		<td class="start-tm">
																			<?php $settings_bh_wednesday_st = get_option("weblizar_aps_business_hours"); 
																			$wednesday= unserialize($settings_bh_wednesday_st['bh_wednesday']);?>
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_wednesday_st" id="bh_wednesday_st" value="<?php echo $wednesday[0]['start_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		<td class="end-tm">
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_wednesday_et" id="bh_wednesday_et" value="<?php echo $wednesday[0]['end_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		
																	</tr>
																	<tr>
																		<td class="day"> <?php _e('Thursday',WL_A_P_SYSTEM); ?></td>
																		<td class="start-tm">
																			<?php 
																			$settings_bh_thursday_st = get_option("weblizar_aps_business_hours"); 
																			$thursday= unserialize($settings_bh_thursday_st['bh_thursday']);?>
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_thursday_st" id="bh_thursday_st" value="<?php  echo $thursday[0]['start_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>

																		</td>
																		<td class="end-tm">
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_thursday_et" id="bh_thursday_et" value="<?php echo $thursday[0]['end_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		
																	</tr>
																	<tr>
																		<td class="day"> <?php _e('Friday',WL_A_P_SYSTEM); ?></td>
																		<td class="start-tm">
																			<?php $settings_bh_friday_st = get_option("weblizar_aps_business_hours");; 
																			$friday	= unserialize($settings_bh_friday_st['bh_friday']);?>	
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_friday_st" id="bh_friday_st" value="<?php echo $friday[0]['start_time'];?>" class=" time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		<td class="end-tm">
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_friday_et" id="bh_friday_et" value="<?php echo $friday[0]['end_time'];?>" class=" time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		
																	</tr>
																	<tr>
																		<td class="day"> <?php _e('Saturday',WL_A_P_SYSTEM); ?></td>
																		<td class="start-tm">
																			<?php
																			$settings_bh_saturday_st = get_option("weblizar_aps_business_hours");
																			$saturday =  unserialize($settings_bh_saturday_st['bh_saturday']);																			
																			?>

																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_saturday_st" id="bh_saturday_st" value="<?php  echo $saturday[0]['start_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		<td class="end-tm">
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_saturday_et" id="bh_saturday_et" value="<?php  echo $saturday[0]['end_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		
																	</tr>
																	<tr>
																		<td class="day"> <?php _e('Sunday',WL_A_P_SYSTEM); ?></td>
																		<td class="start-tm">
																			<?php $settings_bh_sunday_st = get_option("weblizar_aps_business_hours"); 
																			$sunday	= unserialize($settings_bh_sunday_st['bh_sunday']);?>
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_sunday_st" id="bh_sunday_st" value="<?php echo $sunday[0]['start_time'];?>" class="time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>
																		<td class="end-tm">
																			<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
																				<input type="text" name="bh_sunday_et" id="bh_sunday_et" value="<?php echo $sunday[0]['end_time'];?>" class=" time_show form-control floating-label" placeholder="Time">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-time"></span>
																				</span>
																			</div>
																		</td>

																		<td>
																			<input type="hidden" value="1" name="bh_hour">
																		</td>
																	</tr>
																</tbody>
															</table>
												</div>
												<div class="col-md-12 bs-form form-group">
													<button  type="button"  class="btn save-link" id='save_settings_03' onclick="return save_bh_setting();" ><?php _e('Save',WL_A_P_SYSTEM); ?></button>
												</div>
											</form>
										</div>
									</div>
								<div id="g-payment" class="tab-pane fade">
										<h2> <?php _e('Payment Setting',WL_A_P_SYSTEM); ?></h2>
										<div class="col-md-12 bussiness-form">
											<?php 
												$payment_ops = get_option("weblizar_aps_payment_setting");
											?>
											<form style="margin-bottom: 0;" action="" method="POST" id="ap_payment_settings" name="ap_payment_settings">
												<div class="col-md-12 bs-form form-group">
													<div class="col-md-4"><label> <?php _e('Accept Payment',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-6">
															 <?php $accept_payment= $payment_ops['accept_payment'];?>
														<input onclick="payment_function(this)" type="radio" name="accept_payment"  id="accept_payment" value="yes" <?php if($accept_payment=='yes'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Yes',WL_A_P_SYSTEM); ?>
														<input onclick="payment_function(this)" type="radio" name="accept_payment"  id="accept_payment" value="no" <?php if($accept_payment=='no'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('No',WL_A_P_SYSTEM); ?>
													</div>
												</div>
												
												<div id="payment_disabled" style="<?php if($accept_payment == 'yes') { echo "display: none";} else{ echo "display: block";} ?>">
													<div class="col-md-12 bs-form form-group">
														<h3>Note</h3>
														<p> Payment Instructions:</p>
														<ol>
															<li>If Accepting Payment is Disabled, payment section will be skipped. </li>
															<li>No Payment type (Cash, Paypal and Razorpay) will be available to client. </li>
														</ol>
													</div>
												</div>
												
												<div class="col-md-12" id="payment_accept" style="<?php if($accept_payment == 'yes') { echo "display: block";} else{ echo "display: none";} ?>">
													<div class="panel panel-default">
														<!--<div class="panel-heading"><label>2Checkout</label></div>
														 <div class="panel-body">
															<div class="col-md-6">
																<select name="checkout" id="2checkout" class="form-control">
																	<?php $settings_checkout = $wpdb->get_col( "SELECT checkout from $settings_table" ); 
																	$checkout	= $settings_checkout[0];?>
																		
																		<option value="2-disable" <?php if($checkout == '2-disable') { echo 'selected'; } else { echo ''; } ?>>Disable</option>
																		<option value="2-enable" <?php if($checkout == '2-enable') { echo 'selected'; } else { echo ''; } ?>>2Checkout Standard Checkout</option>
																</select>
															</div>
															<div class="col-md-12 bs-2Checkout-form 2-enable">
																<div class="col-md-12 bs-form form-group">
																	<h3>Instruction</h3>
																	<p>In Checkout Options of your 2Checkout account do the following steps: </p>
																	<ol>
																		<li>In <b>Direct Return</b> select <b>Header Redirect (Your URL)</b>.</li>
																		<li>In <b>Approved URL</b> enter the URL of your booking page.</li>
																	</ol>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label>API Username</label></div>
																	<div class="col-md-6">
																	<?php $settings_api_username = $wpdb->get_col( "SELECT api_username from $settings_table" ); 
																	$api_username	= $settings_api_username[0];?>
																		<input type="text" class=" form-control" value="<?php //echo $api_username;  ?>" name="api_username" id="api_username" placeholder="API Username"/>
																	</div>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label>API Password</label></div>
																	<div class="col-md-6">
																	<?php $settings_api_password = $wpdb->get_col( "SELECT api_password from $settings_table" ); 
																	$api_password	= $settings_api_password[0];?>
																		<input type="text" class=" form-control" value="<?php //echo $api_password;  ?>" name="api_password" id="api_password"  placeholder="API Password"/>
																	</div>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label>API Signature</label></div>
																	<div class="col-md-6">
																	<?php $settings_api_signature = $wpdb->get_col( "SELECT api_signature from $settings_table" ); 
																	$api_signature	= $settings_api_signature[0];?>
																		<input type="text" class=" form-control" value="<?php //echo $api_signature;  ?>" name="api_signature" id="api_signature" placeholder="API Signature"/>
																	</div>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label>SandBox Mode</label></div>
																	<div class="col-md-6">
																		<select name="checkout_sandbox_mode" id="checkout_sandbox_mode" class="form-control">
																		<?php $settings_checkout_sandbox_mode = $wpdb->get_col( "SELECT checkout_sandbox_mode from $settings_table" ); 
																		$checkout_sandbox_mode	= $settings_checkout_sandbox_mode[0];?>
																			<option value="default">Select</option>
																			<option value="no" <?php //if($checkout_sandbox_mode == 'no') { echo 'selected'; } else { echo ''; } ?>>No</option>
																			<option value="yes" <?php // if($checkout_sandbox_mode == 'yes') { echo 'selected'; } else { echo ''; } ?>>Yes</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>-->
													</div> 
													<div class="panel panel-default">
														<div class="panel-heading"><label> <?php _e('Cash Payment',WL_A_P_SYSTEM); ?></label></div>
														<div class="panel-body">
															<div class="row">
																<div class="col-md-6 paymt">
																	<select id="cash" name="cash_checkout"  class="form-control">
																		<?php $cash_checkout = get_option( "weblizar_aps_payment_setting" ); ?>
																		<option value="no" <?php if($cash_checkout['cash_checkout'] == 'no') { echo 'selected'; } else { echo ''; } ?>> <?php _e('Disabled',WL_A_P_SYSTEM); ?></option>
																		<option value="yes" <?php if($cash_checkout['cash_checkout'] == 'yes') { echo 'selected'; } else { echo ''; } ?>> <?php _e('Enable',WL_A_P_SYSTEM); ?></option>
																	</select>
																</div>															
															</div>															
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading"><label> <?php _e('PayPal',WL_A_P_SYSTEM); ?></label></div>
														<div class="panel-body">
															<div class="row">
																<div class="col-md-6 paymt">
																	<select id="paypal" name="paypal_checkout"  class="form-control">
																		<?php //$settings_paypal_checkout = $wpdb->get_col( "SELECT paypal_checkout from $settings_table" ); 
																			//$paypal_checkout	= $settings_paypal_checkout[0];
																			$paypal_checkout = $payment_ops['paypal_checkout'];
																		?>
																			<option value="p-disable" <?php if($paypal_checkout == 'p-disable') { echo 'selected'; } else { echo ''; } ?>> <?php _e('Disabled',WL_A_P_SYSTEM); ?></option>
																			<option value="p-enable" <?php if($paypal_checkout == 'p-enable') { echo 'selected'; } else { echo ''; } ?>> <?php _e('PayPal Standard Checkout',WL_A_P_SYSTEM); ?></option>
																	</select>
																</div>
															</div>
															<div class="row bs-paypal-form p-enable">
																<div class="col-md-12 bs-form form-group">
																	<h3> <?php _e('Instruction',WL_A_P_SYSTEM); ?></h3>
																	<p> <?php _e('Payment mode Instructions:',WL_A_P_SYSTEM); ?></p>
																	<ol>
																		<li> <?php _e('In',WL_A_P_SYSTEM); ?> <b> <?php _e('Direct Paypal Mode',WL_A_P_SYSTEM); ?></b><?php _e('the url rediection will be directly to the paypal account.',WL_A_P_SYSTEM); ?> </li>
																		<li><?php _e('In',WL_A_P_SYSTEM); ?> <b><?php _e('Sandbox Mode',WL_A_P_SYSTEM); ?></b> <?php _e('the url rediection will be in Sandbox mode to the paypal account...for testing purpose',WL_A_P_SYSTEM); ?></li>
																		
																	</ol>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label><?php _e('Email Id',WL_A_P_SYSTEM); ?></label></div>
																	<div class="col-md-6 paymt">
																	<?php //$settings_paypal_email = $wpdb->get_col( "SELECT paypal_email from $settings_table" ); 
																		$paypal_email	= $payment_ops['paypal_email'];?>
																		<input type="text" class=" form-control" value="<?php echo $paypal_email; ?>" name="paypal_email" id="paypal_email" placeholder="Enter Email Address"/>
																		<span  class="validation_alert" id="paypal_email_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
																	</div>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label><?php _e('Paypal Payment Currency',WL_A_P_SYSTEM); ?></label></div>
																	<div class="col-md-6">
																		<select name="payment_currency" id="payment_currency" class="form-control" >
																				<?php  $settings_payment_currency = $wpdb->get_col( "SELECT payment_currency from $settings_table" ); 
																				$payment_currency	= $payment_ops['payment_currency'];?>
																					<option value="0" selected="selected"><?php _e('Select Currency',WL_A_P_SYSTEM); ?></option>
																					<option value="USD" <?php selected($payment_currency, 'USD' ); ?>>United States dollar (<?php echo '&#36;'?>)</option>
																					<option value="AUD" <?php selected($payment_currency, 'AUD' ); ?>>Australian dollar (<?php echo '&#36;'?>)</option>
																					<option value="BRL" <?php selected($payment_currency, 'BRL' ); ?>>Brazilian Real  (<?php echo 'R$'?>))</option>
																					<option value="CAD" <?php selected($payment_currency, 'CAD' ); ?>>Canadian dollar (<?php echo '&#36;'?>)</option>
																					<option value="CZK" <?php selected($payment_currency, 'CZK' ); ?>>Czech koruna (<?php echo 'Kc'?>)</option>
																					<option value="DKK" <?php selected($payment_currency, 'DKK' ); ?>>Danish Krone (<?php echo 'DKK'?>)</option>
																					<option value="EUR" <?php selected($payment_currency, 'Euro' ); ?>>Euro (<?php echo '&euro;'?>)</option>
																					<option value="HKD" <?php selected($payment_currency, 'HKD' ); ?>>Hong Kong dollar (<?php echo '&#36;'?>)</option>
																					<option value="HUF" <?php selected($payment_currency, 'HUF' ); ?>>Hungarian Forint </option>
																					<option value="ILS" <?php selected($payment_currency, 'ILS' ); ?>>Israeli new shekel (<?php echo 'ILS'?>)</option>
																					<option value="JPY" <?php selected($payment_currency, 'JPY' ); ?>>Japanese yen (<?php echo '&yen;'?>)</option>
																					<option value="MYR" <?php selected($payment_currency, 'MYR' ); ?>>Malaysian ringgit (<?php echo 'RM'?>)</option>
																					<option value="MXN" <?php selected($payment_currency, 'MXN' ); ?>>Mexican peso (<?php echo '&#36;'?>)</option>
																					<option value="NOK" <?php selected($payment_currency, 'NOK' ); ?>>Norwegian krone (<?php echo 'kr'?>)</option>
																					<option value="NZD" <?php selected($payment_currency, 'NZD' ); ?>>New Zealand dollar (<?php echo '&#36;'?>)</option>
																					<option value="PHP" <?php selected($payment_currency, 'PHP' ); ?>>Philippine peso (<?php echo 'PHP'?>)</option>
																					<option value="PLN" <?php selected($payment_currency, 'PLN' ); ?>>Polish Zloty (<?php echo 'PLN'?>)</option>
																					<option value="GBP" <?php selected($payment_currency, 'GBP' ); ?>>Pound Sterling (<?php echo 'GBP'?>)</option>
																					<option value="SGD" <?php selected($payment_currency, 'SGD' ); ?>>Singapore dollar (<?php echo '&#36;'?>)</option>
																					<option value="SEK" <?php selected($payment_currency, 'SEK' ); ?>>Swedish krona (<?php echo 'Kr'?>)</option>
																					<option value="CHF" <?php selected($payment_currency, 'CHF' ); ?>>Swiss franc (<?php echo 'Fr'?>)</option>
																					<option value="TWD" <?php selected($payment_currency, 'TWD' ); ?>>Taiwan New dollar (<?php echo 'NT$'?>)</option>
																					<option value="THB" <?php selected($payment_currency, 'THB' ); ?>>Thai baht (<?php echo 'THB'?>)</option>
																		</select>
																			 <span class="validation_alert" id="payment_currency_alert"><?php _e("Please select one ",WL_A_P_SYSTEM ); ?></span>
																	</div>
																</div>
																
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label><?php _e('Paypal Payment Mode',WL_A_P_SYSTEM); ?></label></div>
																	<div class="col-md-6">
																		<select name="payment_mode" id="payment_mode" class="payment_mode form-control">
																		<?php 
																			$payment_mode	= $payment_ops['payment_mode'];?>																			
																			<option value="direct_paypal_mode" <?php if($payment_mode == 'direct_paypal_mode') { echo 'selected'; } else { echo ''; } ?>><?php _e('Direct Paypal Mode',WL_A_P_SYSTEM); ?></option>
																			<option value="sandbox_mode" <?php if($payment_mode == 'sandbox_mode') { echo 'selected'; } else { echo ''; } ?>><?php _e('Sandbox Mode',WL_A_P_SYSTEM); ?></option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
													<div class="panel panel-default">
														<div class="panel-heading"><label> <?php _e('Razorpay',WL_A_P_SYSTEM); ?></label></div>
														<div class="panel-body">
															<div class="row">
																<div class="col-md-6 paymt">
																	<select id="razorpay" name="razorpay_checkout"  class="form-control">
																		<?php //$settings_razorpay_checkout = $wpdb->get_col( "SELECT razorpay_checkout from $settings_table" ); 
																			$razorpay_checkout	= $payment_ops['razorpay_checkout'];?>
																			<option value="r-disable" <?php if($razorpay_checkout == 'r-disable') { echo 'selected'; } else { echo ''; } ?>> <?php _e('Disabled',WL_A_P_SYSTEM); ?></option>
																			<option value="r-enable" <?php if($razorpay_checkout == 'r-enable') { echo 'selected'; } else { echo ''; } ?>> <?php _e('Razorpay Standard Checkout',WL_A_P_SYSTEM); ?></option>
																	</select>
																</div>
															</div>
															<div class="row bs-razorpay-form r-enable">
															<div class="col-md-12 bs-form form-group">
																	<h3> <?php _e('Instruction',WL_A_P_SYSTEM); ?></h3>
																	<p> <?php _e('Payment mode Instructions:',WL_A_P_SYSTEM); ?></p>
																	<ol>
																		<li> <?php _e('API keys that can be generated through',WL_A_P_SYSTEM); ?> <a class="razorpay_links" target="_blank" href="https://dashboard.razorpay.com"> <?php _e('Razorpay dashboard',WL_A_P_SYSTEM);?></a> </li>
																		<li> <?php _e('Test the',WL_A_P_SYSTEM); ?> <a class="razorpay_links" target="_blank" href="https://razorpay.com/demo/"><?php _e('Demo Razorpay Payment',WL_A_P_SYSTEM); ?></a></li>
																	</ol>
																</div>
															
															
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label><?php _e('API Key',WL_A_P_SYSTEM); ?></label></div>
																	<div class="col-md-6">
																	<?php  
																		$razorpay_api_key	= $payment_ops['razorpay_api_key'];?>
																		<input type="text" class=" form-control" value="<?php echo $razorpay_api_key; ?>" name="razorpay_api_key" id="razorpay_api_key" placeholder="Enter API Key"/>
																		<span  class="validation_alert" id="razorpay_api_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
																	</div>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label><?php _e('Name', WL_A_P_SYSTEM); ?></label></div>
																	<div class="col-md-6">
																	<?php //$settings_razorpay_name = $wpdb->get_col( "SELECT razorpay_name from $settings_table" ); 
																			$razorpay_name	= $payment_ops['razorpay_name'];
																	?>
																		<input type="text" class=" form-control" value="<?php echo $razorpay_name; ?>" name="razorpay_name" id="razorpay_name" placeholder="Enter Name"/>
																	</div>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5"><label><?php _e('Description',WL_A_P_SYSTEM); ?></label></div>
																	<div class="col-md-6">
																	<?php //$settings_razorpay_description = $wpdb->get_col( "SELECT razorpay_description from $settings_table" ); 
																		$razorpay_description	= $payment_ops['razorpay_description'];?>
																		<input type="text" class=" form-control" value="<?php echo $razorpay_description; ?>" name="razorpay_description" id="razorpay_description" placeholder="Enter Description"/>
																	</div>
																</div>
																
																<div class="col-md-12 bs-form form-group">
																	<div class="row">
																		<div class="col-md-3"><label><?php _e('Razorpay Theme Color',WL_A_P_SYSTEM); ?></label></div>
																		<div class="col-md-6">
																		<?php  //$setting_razorpay_theme_color = $wpdb->get_col( "SELECT razorpay_theme_color from $settings_table" ); 
																					$razorpay_theme_color	= $payment_ops['razorpay_theme_color'];?>
																				<input type="text" name="razorpay_theme_color" value="<?php echo $razorpay_theme_color; ?>" id="razorpay_theme_color" class="ap_color_picker" />
																		</div>
																	</div>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="row">
																		<div class="col-md-2"><label><?php _e('Razorpay Logo',WL_A_P_SYSTEM); ?></label></div>
																		<div class="col-md-6">
																		<?php // $setting_razorpay_logo = $wpdb->get_col( "SELECT razorpay_logo from $settings_table" ); 
																					$razorpay_logo	= $payment_ops['razorpay_logo'];?>
																				<input type="text" class=" form-control" name="razorpay_logo" id="razorpay_logo" placeholder="<?php _e('No media selected!',WL_A_P_SYSTEM)?>" readonly 
																				value="<?php if($razorpay_logo==null) {echo WEBLIZAR_A_P_SYSTEM.'/images/razorpay_logo.png';} else {  echo $razorpay_logo ; } ?>"/>
																		</div>
																		<div class="col-md-4">
																			<input type="button" value="<?php _e('Upload',WEBLIZAR_A_P_SYSTEM)?>"  class="button-primary upload_image_button paymt"  />
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
													<?php 
														$stripe_enable    = isset($payment_ops['stripe_enable']) ? $payment_ops['stripe_enable'] : "s-disable";
														$stripe_apikey 	  = isset($payment_ops['stripe_apikey']) ? $payment_ops['stripe_apikey'] : NULL;
														$stripe_secretkey = isset($payment_ops['stripe_secretkey']) ? $payment_ops['stripe_secretkey'] : NULL;

														if( $stripe_enable == "s-disable" ) {
															?>
																<style type="text/css">
																	.wl-stripe-block-enable{
																		display: none;
																	}	
																</style>
															<?php
														}
													?>
													<div class="panel panel-default">
														<div class="panel-heading">
															<label> <?php _e('Stripe',WL_A_P_SYSTEM); ?></label>
														</div>
														<div class="panel-body">
															<div class="row">
																<div class="col-md-6 paymt">
																	<select id="stripe_enable" class="form-control" name="stripe_enable">
																		<option value="s-enable"><?php _e( 'Enable', WL_A_P_SYSTEM ); ?></option>
																		<option value="s-disable"><?php _e( 'Disable', WL_A_P_SYSTEM ); ?></option>
																	</select>

																<script type="text/javascript">
																	var stripe_enable_save_val = '<?php echo "$stripe_enable"; ?>';
																	jQuery('#stripe_enable').find('option[value="' + stripe_enable_save_val + '"]').attr('selected', 'selected');
																</script>
																</div>
															</div>
															<div class="row bs-stripe-form wl-stripe-block-enable">
																<div class="col-md-12 bs-form form-group">
																	<h3> <?php _e('Instruction',WL_A_P_SYSTEM); ?></h3>
																	<p> <?php _e('Payment mode Instructions:',WL_A_P_SYSTEM); ?></p>
																	<ol>
																		<li> <?php _e('API keys that can be generated through',WL_A_P_SYSTEM); ?> <a class="razorpay_links" target="_blank" href="https://dashboard.stripe.com/"> <?php _e('Stripe Dashboard',WL_A_P_SYSTEM);?></a> </li>
																		<!--<li> <?php// _e('Test the',WL_A_P_SYSTEM); ?> <a class="razorpay_links" target="_blank" href=""><?php //_e('Demo Stripe Payment',WL_A_P_SYSTEM); ?></a></li> -->
																	</ol>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5">
																		<label>
																			<?php _e('API key',WL_A_P_SYSTEM); ?>	
																		</label>
																	</div>
																	<div class="col-md-6">
																		<input id="stripe_apikey" type="text" class=" form-control" name="stripe_apikey" value="<?php echo $stripe_apikey; ?>">
																		<span  class="validation_alert" id="stripe_apikey_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
																	</div>
																</div>
																<div class="col-md-12 bs-form form-group">
																	<div class="col-md-5">
																		<label><?php _e('Secret Key',WL_A_P_SYSTEM); ?>
																		</label>
																	</div>
																	<div class="col-md-6">
																		<input type="text" id="stripe_secretkey" class="form-control" name="stripe_secretkey" value="<?php echo $stripe_secretkey; ?>">
																		<span  class="validation_alert" id="stripe_secretkey_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
																	</div>
																</div>
															</div>												
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<button  type="button" class="btn save-link" id='save_settings_04' onclick="return save_payment_setting();"><?php _e('Save',WL_A_P_SYSTEM); ?></button>
												</div>
											</form>
										</div>
									</div>
									<div id="st-calendar" class="tab-pane fade">
										<h2> <?php _e('Calendar Setting',WL_A_P_SYSTEM); ?></h2>
										<?php 
											//fetching calendar theme setting
											$settings_cal_theme_setting = get_option('weblizar_aps_calendar_view_setting'); 
											$cal_theme_style	= $settings_cal_theme_setting['cal_theme_style'];
											$cal_date_format = $settings_cal_theme_setting['cal_date_format'];
											$cal_time_format = $settings_cal_theme_setting['cal_time_format'];
											$cal_view = $settings_cal_theme_setting['cal_view'];
											$cal_first_day = $settings_cal_theme_setting['cal_first_day'];
											$cal_pending_color = $settings_cal_theme_setting['cal_pending_color'];
											$cal_approved_color = $settings_cal_theme_setting['cal_approved_color'];
											$cal_cancelled_color = $settings_cal_theme_setting['cal_cancelled_color'];
											$cal_completed_color = $settings_cal_theme_setting['cal_completed_color'];
											$cal_off_time_color = $settings_cal_theme_setting['cal_off_time_color'];
											$cal_font_color = $settings_cal_theme_setting['cal_font_style'];
										?>
										<form style="margin-bottom: 0;" action="" method="POST" id="ap_calender_settings">
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-3"><label> <?php _e('Calendar Themes',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-4">															
														<input type="radio" name="cal_theme_style"  id="cal_theme_style" value="theme_01" <?php if($cal_theme_style=='theme_01'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Theme 01',WL_A_P_SYSTEM); ?>
														<input type="radio" name="cal_theme_style"  id="cal_theme_style" value="theme_02" <?php if($cal_theme_style=='theme_02'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Theme 02',WL_A_P_SYSTEM); ?>
													</div>
												</div>
											</div>
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-3"><label> <?php _e('Date Format',WL_A_P_SYSTEM); ?></label></div>														
													<div class="col-md-4">
													<select name="ap_cal_date_format" id="ap_cal_date_format">
														  <option value="d-m-Y" <?php if($cal_date_format=='d-m-Y'){ echo 'selected'; }?> ><?php _e('DD-MM-YYYY',WL_A_P_SYSTEM); ?></option>
														  <option value="m-d-Y" <?php if($cal_date_format=='m-d-Y'){ echo 'selected'; }?>><?php _e('MM-DD-YYYY',WL_A_P_SYSTEM); ?></option>
														  <option value="Y-m-d" <?php if($cal_date_format=='Y-m-d'){ echo 'selected'; }?>><?php _e('YYYY-MM-DD',WL_A_P_SYSTEM); ?></option>
													</select>
													</div>
												</div>
											</div>
										    <div class="col-md-12 calendar-form">	
													<div class="row bs-form form-group">
															<div class="col-md-3"><label><?php _e('Time Format',WL_A_P_SYSTEM); ?></label></div>															
															<div class="col-md-4">
															<select name="ap_cal_time_format" id="ap_cal_time_format">
																	  <option value="h:i"  <?php if($cal_time_format=='h:i'){ echo 'selected'; }?>><?php _e('12 Hour Time',WL_A_P_SYSTEM); ?></option>
																	  <option value="H:i"  <?php if($cal_time_format=='H:i'){ echo 'selected'; }?>><?php _e('24 Hour Time',WL_A_P_SYSTEM); ?></option>
															 </select>
															 </div>
													</div>
											</div>	
                                             <div class="col-md-12 calendar-form">														
													<div class="row bs-form form-group">
															<div class="col-md-3"><label> <?php _e('Calendar View',WL_A_P_SYSTEM); ?></label></div>
															<div class="col-md-4">
															<select id="calendar_view" name="calendar_view">
																<option value="agendaDay" <?php if($cal_view=='agendaDay'){ echo 'selected'; }?>><?php _e('Day',WL_A_P_SYSTEM); ?></option>
																<option value="agendaWeek" <?php if($cal_view=='agendaWeek'){ echo 'selected'; }?>><?php _e('Week',WL_A_P_SYSTEM); ?></option>
																<option value="month" <?php if($cal_view=='month'){ echo 'selected'; }?>><?php _e('Month',WL_A_P_SYSTEM); ?></option>
														   </select>
															
															</div>
													</div>
											</div>
											<div class="col-md-12 calendar-form">	
											
									                <div class="row bs-form form-group">
													<div class="col-md-3"><label><?php _e('Calendar First Days',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-4">
														<select name="calendar_start_day" id="calendar_start_day">
															  <option value="1" <?php if($cal_first_day=='1'){ echo 'selected'; }?>><?php _e('Monday',WL_A_P_SYSTEM); ?></option>
															  <option value="2" <?php if($cal_first_day=='2'){ echo 'selected'; }?>><?php _e('Tuesday',WL_A_P_SYSTEM); ?></option>
															  <option value="3" <?php if($cal_first_day=='3'){ echo 'selected'; }?>><?php _e('Wednesday',WL_A_P_SYSTEM); ?></option>
															  <option value="4" <?php if($cal_first_day=='4'){ echo 'selected'; }?>><?php _e('Thursday',WL_A_P_SYSTEM); ?></option>
															  <option value="5" <?php if($cal_first_day=='5'){ echo 'selected'; }?>><?php _e('Friday',WL_A_P_SYSTEM); ?></option>
															  <option value="6" <?php if($cal_first_day=='6'){ echo 'selected'; }?>><?php _e('Saturday',WL_A_P_SYSTEM); ?></option>
															  <option value="0" <?php if($cal_first_day=='7'){ echo 'selected'; }?>><?php _e('Sunday',WL_A_P_SYSTEM); ?></option>
														</select>													
													</div>
												</div>
											</div>	
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-12"><label> <?php _e('Appointment Status Color',WL_A_P_SYSTEM); ?></label></div>
												</div>
											</div>
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-3"><label> <?php _e('Pending',WL_A_P_SYSTEM); ?></label></div>													
													<div class="col-md-4">
														<input type="text" name="pending_color" value="<?php echo $cal_pending_color; ?>" id="pending_color" class="ap_color_picker" />
													</div>
												</div>
											</div>
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-3"><label> <?php _e('Approved',WL_A_P_SYSTEM); ?></label></div>													
													<div class="col-md-4">
														<input type="text" name="approved_color" value="<?php echo $cal_approved_color; ?>" id="approved_color" class="ap_color_picker" />
													</div>
												</div>
											</div>
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-3"><label> <?php _e('Cancelled',WL_A_P_SYSTEM); ?></label></div>													
													<div class="col-md-4">
														<input type="text" name="cancelled_color" value="<?php echo $cal_cancelled_color; ?>" id="cancelled_color" class="ap_color_picker" />
													</div>
												</div>
											</div>
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-3"><label> <?php _e('Completed',WL_A_P_SYSTEM); ?></label></div>													
													<div class="col-md-4">
														<input type="text" name="completed_color" value="<?php echo $cal_completed_color; ?>"  id="completed_color" class="ap_color_picker" />
													</div>
												</div>
											</div>
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-3"><label> <?php _e('Time off Color',WL_A_P_SYSTEM); ?></label></div>													
													<div class="col-md-4">
														<input type="text" name="time_off_color" value="<?php echo $cal_off_time_color; ?>"  id="time_off_color" class="ap_color_picker" />
													</div>
												</div>
											</div>
											<div class="col-md-12 calendar-form">
												<div class="row bs-form form-group">
													<div class="col-md-3"><label> <?php _e('Font Style',WL_A_P_SYSTEM); ?></label></div>
													<div class="col-md-4">
														<select name="cal_font_style" class="form-control" id="cal_font_style" class="standard-dropdown">
																<optgroup label="Default Fonts">
																<option value="Arial" <?php selected($cal_font_style, 'Arial' ); ?> >Arial</option>
																<option value="Arial black" <?php selected($cal_font_style, 'Arial black' ); ?> >Arial Black</option>
																<option value="Courier New" <?php selected($cal_font_style, 'Courier New' ); ?> >Courier New</option>
																<option value="Georgia" <?php selected($cal_font_style, 'Georgia' ); ?> >Georgia</option>
																<option value="Grande" <?php selected($cal_font_style, 'Grande' ); ?> >Grande</option>
																<option value="helvetica neue" <?php selected($cal_font_style, 'helvetica neue' ); ?> >Helvetica Neue</option>
																<option value="impact" <?php selected($cal_font_style, 'impact' ); ?> >Impact</option>
																<option value="lucida" <?php selected($cal_font_style, 'lucida' ); ?> >Lucida</option>
																<option value="Lucida Grande" <?php selected($cal_font_style, 'Lucida Grande' ); ?> >Lucida Grande</option>
																<option value="OpenSansBold" <?php selected($cal_font_style, 'OpenSansBold' ); ?> >OpenSansBold</option>
																<option value="palatino" <?php selected($cal_font_style, 'palatino' ); ?> >Palatino</option>
																<option value="Sans" <?php selected($cal_font_style, 'Sans' ); ?> > Sans</option>
																<option value="Sans-Serif" <?php selected($cal_font_style, 'Sans-Serif' ); ?> >Sans-Serif</option>
																<option value="tahoma" <?php selected($cal_font_style, 'tahoma' ); ?> >Tahoma</option>
																<option value="Times New Roman"<?php selected($cal_font_style, 'Times New Roman' ); ?> >Times New Roman</option>
																<option value="Trebuchet" <?php selected($cal_font_style, 'Trebuchet' ); ?> >Trebuchet</option>
																<option value="verdana" <?php selected($cal_font_style, 'verdana' ); ?> >Verdana</option>
																<option value="cursive" <?php selected($cal_font_style, 'cursive' ); ?> >cursive</option>
																<option value="monospace" <?php selected($cal_font_style, 'monospace' ); ?> >monospace</option>
															</optgroup>
															<optgroup label="Google Fonts">
																<option value="Abel"<?php selected($cal_font_style, 'Abel' ); ?> >Abel</option>
																<option value="Roboto Condensed"<?php selected($cal_font_style, 'Roboto Condensed' ); ?> >Roboto Condensed</option>
																<option value="Abril Fatface" <?php selected($cal_font_style, 'Abril Fatface' ); ?> >Abril Fatface</option>
																<option value="Aclonica" <?php selected($cal_font_style, 'Aclonica' ); ?> >Aclonica</option>
																<option value="Acme" <?php selected($cal_font_style, 'Acme' ); ?> >Acme</option>
																<option value="Actor" <?php selected($cal_font_style, 'Actor' ); ?> >Actor</option>
																<option value="Adamina" <?php selected($cal_font_style, 'Adamina' ); ?> >Adamina</option>
																<option value="Advent Pro" <?php selected($cal_font_style, 'Advent Pro' ); ?> >Advent Pro</option>
																<option value="Aguafina Script" <?php selected($cal_font_style, 'Aguafina Script' ); ?> >Aguafina Script</option>
																<option value="Aladin" <?php selected($cal_font_style, 'Aladin' ); ?> >Aladin</option>
																<option value="Aldrich" <?php selected($cal_font_style, 'Aldrich' ); ?> >Aldrich</option>
																<option value="Alegreya" <?php selected($cal_font_style, 'Alegreya' ); ?> >Alegreya</option>
																<option value="Alegreya SC" <?php selected($cal_font_style, 'Alegreya SC' ); ?> >Alegreya SC</option>
																<option value="Alex Brush" <?php selected($cal_font_style, 'Alex Brush' ); ?> >Alex Brush</option>
																<option value="Alfa Slab One" <?php selected($cal_font_style, 'Alfa Slab One' ); ?> >Alfa Slab One</option>
																<option value="Alice" <?php selected($cal_font_style, 'Alice' ); ?> >Alice</option>
																<option value="Alike" <?php selected($cal_font_style, 'Alike' ); ?> >Alike</option>
																<option value="Alike Angular" <?php selected($cal_font_style, 'Alike Angular' ); ?> >Alike Angular</option>
																<option value="Allan" <?php selected($cal_font_style, 'Allan' ); ?> >Allan</option>
																<option value="Allerta" <?php selected($cal_font_style, 'Allerta' ); ?> >Allerta</option>
																<option value="Allerta Stencil"<?php selected($cal_font_style, 'Allerta Stencil' ); ?> >Allerta Stencil</option>
																<option value="Allura" <?php selected($cal_font_style, 'Allura' ); ?> >Allura</option>
																<option value="Almendra" <?php selected($cal_font_style, 'Almendra' ); ?> >Almendra</option>
																<option value="Almendra SC"<?php selected($cal_font_style, 'Almendra SC' ); ?> >Almendra SC</option>
																<option value="Amaranth" <?php selected($cal_font_style, 'Amaranth' ); ?> >Amaranth</option>
																<option value="Amatic SC"<?php selected($cal_font_style, 'Amatic SC' ); ?> >Amatic SC</option>
																<option value="Amethysta" <?php selected($cal_font_style, 'Amethysta' ); ?> >Amethysta</option>
																<option value="Andada"<?php selected($cal_font_style, 'Andada' ); ?> >Andada</option>
																<option value="Andika" <?php selected($cal_font_style, 'Andika' ); ?> > Andika</option>
																<option value="Angkor" <?php selected($cal_font_style, 'Angkor' ); ?> >Angkor</option>
																<option value="Annie Use Your Telescope" <?php selected($cal_font_style, 'Annie Use Your Telescope' ); ?> >Annie Use Your Telescope</option>
																<option value="Anonymous Pro" <?php selected($cal_font_style, 'Anonymous Pro' ); ?> >Anonymous Pro</option>
																<option value="Antic" <?php selected($cal_font_style, 'Antic' ); ?> > Antic</option>
																<option value="Antic Didone" <?php selected($cal_font_style, 'Antic Didone' ); ?> >Antic Didone</option>
																<option value="Antic Slab" <?php selected($cal_font_style, 'Antic Slab' ); ?> >Antic Slab</option>
																<option value="Anton" <?php selected($cal_font_style, 'Anton' ); ?> >Anton</option>
																<option value="Arapey" <?php selected($cal_font_style, 'Arapey' ); ?> >Arapey</option>
																<option value="Arbutus" <?php selected($cal_font_style, 'Arbutus' ); ?> >Arbutus</option>
																<option value="Architects Daughter" <?php selected($cal_font_style, 'Architects Daughter' ); ?> >Architects Daughter</option>
																<option value="Arimo" <?php selected($cal_font_style, 'Arimo' ); ?> >Arimo</option>
																<option value="Arizonia" <?php selected($cal_font_style, 'Arizonia' ); ?> >Arizonia</option>
																<option value="Armata" <?php selected($cal_font_style, 'Armata' ); ?> >Armata</option>
																<option value="Artifika" <?php selected($cal_font_style, 'Artifika' ); ?> >Artifika</option>
																<option value="Arvo" <?php selected($cal_font_style, 'Arvo' ); ?> >Arvo</option>
																<option value="Asap" <?php selected($cal_font_style, 'Asap' ); ?> >Asap</option>
																<option value="Asset" <?php selected($cal_font_style, 'Asset' ); ?> >Asset</option>
																<option value="Astloch" <?php selected($cal_font_style, 'Astloch' ); ?> >Astloch</option>
																<option value="Asul" <?php selected($cal_font_style, 'Asul' ); ?> >Asul</option>
																<option value="Atomic Age" <?php selected($cal_font_style, 'Atomic Age' ); ?> >Atomic Age</option>
																<option value="Aubrey" <?php selected($cal_font_style, 'Aubrey' ); ?> >Aubrey</option>
																<option value="Audiowide" <?php selected($cal_font_style, 'Audiowide' ); ?> >Audiowide</option>
																<option value="Average" <?php selected($cal_font_style, 'Average' ); ?> >Average</option>
																<option value="Averia Gruesa Libre" <?php selected($cal_font_style, 'Averia Gruesa Libre' ); ?> >Averia Gruesa Libre</option>
																<option value="Averia Libre" <?php selected($cal_font_style, 'Averia Libre' ); ?> >Averia Libre</option>
																<option value="Averia Sans Libre" <?php selected($cal_font_style, 'Averia Sans Libre' ); ?> >Averia Sans Libre</option>
																<option value="Averia Serif Libre" <?php selected($cal_font_style, 'Averia Serif Libre' ); ?> >Averia Serif Libre</option>
																<option value="Bad Script" <?php selected($cal_font_style, 'Bad Script' ); ?> >Bad Script</option>
																<option value="Balthazar" <?php selected($cal_font_style, 'Balthazar' ); ?> >Balthazar</option>
																<option value="Bangers" <?php selected($cal_font_style, 'Bangers' ); ?> >Bangers</option>
																<option value="Basic" <?php selected($cal_font_style, 'Basic' ); ?> >Basic</option>
																<option value="Battambang" <?php selected($cal_font_style, 'Battambang' ); ?> >Battambang</option>
																<option value="Baumans" <?php selected($cal_font_style, 'Baumans' ); ?> >Baumans</option>
																<option value="Bayon" <?php selected($cal_font_style, 'Bayon' ); ?> >Bayon</option>
																<option value="Belgrano"<?php selected($cal_font_style, 'Belgrano' ); ?> >Belgrano</option>
																<option value="Belleza" <?php selected($cal_font_style, 'Belleza' ); ?> >Belleza</option>
																<option value="Bentham" <?php selected($cal_font_style, 'Bentham' ); ?> >Bentham</option>
																<option value="Berkshire Swash"<?php selected($cal_font_style, 'Berkshire Swash' ); ?> >Berkshire Swash</option>
																<option value="Bevan"  <?php selected($cal_font_style, 'Bevan' ); ?> >Bevan</option>
																<option value="Bigshot One"<?php selected($cal_font_style, 'Bigshot One' ); ?> >Bigshot One</option>
																<option value="Bilbo" <?php selected($cal_font_style, 'Bilbo' ); ?> >Bilbo</option>
																<option value="Bilbo Swash Caps" <?php selected($cal_font_style, 'Bilbo Swash Caps' ); ?> >Bilbo Swash Caps</option>
																<option value="Bitter" <?php selected($cal_font_style, 'Bitter' ); ?> >Bitter</option>
																<option value="Black Ops One" <?php selected($cal_font_style, 'Black Ops One' ); ?> >Black Ops One</option>
																<option value="Bokor" <?php selected($cal_font_style, 'Bokor' ); ?> >Bokor</option>
																<option value="Bonbon" <?php selected($cal_font_style, 'Bonbon' ); ?> >Bonbon</option>
																<option value="Boogaloo" <?php selected($cal_font_style, 'Boogaloo' ); ?> >Boogaloo</option>
																<option value="Bowlby One" <?php selected($cal_font_style, 'Bowlby One' ); ?> >Bowlby One</option>
																<option value="Bowlby One SC" <?php selected($cal_font_style, 'Bowlby One SC' ); ?> >Bowlby One SC</option>
																<option value="Brawler" <?php selected($cal_font_style, 'Brawler' ); ?> >Brawler</option>
																<option value="Bree Serif" <?php selected($cal_font_style, 'Bree Serif' ); ?> >Bree Serif</option>
																<option value="Bubblegum Sans"  <?php selected($cal_font_style, 'Bubblegum Sans' ); ?> >Bubblegum Sans</option>
																<option value="Buda"  <?php selected($cal_font_style, 'Buda' ); ?> >Buda</option>
																<option value="Buenard"  <?php selected($cal_font_style, 'Buenard' ); ?> >Buenard</option>
																<option value="Butcherman"  <?php selected($cal_font_style, 'Butcherman' ); ?> >Butcherman</option>
																<option value="Butterfly Kids" <?php selected($cal_font_style, 'Butterfly Kids' ); ?> >Butterfly Kids</option>
																<option value="Cabin"  <?php selected($cal_font_style, 'Cabin' ); ?> >Cabin</option>
																<option value="Cabin Condensed"  <?php selected($cal_font_style, 'Cabin Condensed' ); ?> >Cabin Condensed</option>
																<option value="Cabin Sketch"  <?php selected($cal_font_style, 'Cabin Sketch' ); ?> >Cabin Sketch</option>
																<option value="Caesar Dressing"  <?php selected($cal_font_style, 'Caesar Dressing' ); ?> >Caesar Dressing</option>
																<option value="Cagliostro"  <?php selected($cal_font_style, 'Cagliostro' ); ?> >Cagliostro</option>
																<option value="Calligraffitti"  <?php selected($cal_font_style, 'Calligraffitti' ); ?> >Calligraffitti</option>
																<option value="Cambo"  <?php selected($cal_font_style, 'Cambo' ); ?> >Cambo</option>
																<option value="Candal"  <?php selected($cal_font_style, 'Candal' ); ?> >Candal</option>
																<option value="Cantarell"  <?php selected($cal_font_style, 'Cantarell' ); ?> >Cantarell</option>
																<option value="Cantata One"  <?php selected($cal_font_style, 'Cantata One' ); ?> >Cantata One</option>
																<option value="Cardo"  <?php selected($cal_font_style, 'Cardo' ); ?> >Cardo</option>
																<option value="Carme"  <?php selected($cal_font_style, 'Carme' ); ?> >Carme</option>
																<option value="Carter One"  <?php selected($cal_font_style, 'Carter One' ); ?> >Carter One</option>
																<option value="Caudex"  <?php selected($cal_font_style, 'Caudex' ); ?> >Caudex</option>
																<option value="Cedarville Cursive"  <?php selected($cal_font_style, 'Cedarville Cursive' ); ?> >Cedarville Cursive</option>
																<option value="Ceviche One"  <?php selected($cal_font_style, 'Ceviche One' ); ?> >Ceviche One</option>
																<option value="Changa One"  <?php selected($cal_font_style, 'Changa One' ); ?> >Changa One</option>
																<option value="Chango"  <?php selected($cal_font_style, 'Chango' ); ?> >Chango</option>
																<option value="Chau Philomene One"  <?php selected($cal_font_style, 'Chau Philomene One' ); ?> >Chau Philomene One</option>
																<option value="Chelsea Market"  <?php selected($cal_font_style, 'Chelsea Market' ); ?> >Chelsea Market</option>
																<option value="Chenla"  <?php selected($cal_font_style, 'Chenla' ); ?> >Chenla</option>
																<option value="Cherry Cream Soda"  <?php selected($cal_font_style, 'Cherry Cream Soda' ); ?> >Cherry Cream Soda</option>
																<option value="Chewy"  <?php selected($cal_font_style, 'Chewy' ); ?> >Chewy</option>
																<option value="Chicle"  <?php selected($cal_font_style, 'Chicle' ); ?> >Chicle</option>
																<option value="Chivo"  <?php selected($cal_font_style, 'Chivo' ); ?> >Chivo</option>
																<option value="Coda"  <?php selected($cal_font_style, 'Coda' ); ?> >Coda</option>
																<option value="Coda Caption"  <?php selected($cal_font_style, 'Coda Caption' ); ?> >Coda Caption</option>
																<option value="Codystar"  <?php selected($cal_font_style, 'Codystar' ); ?> >Codystar</option>
																<option value="Comfortaa"  <?php selected($cal_font_style, 'Comfortaa' ); ?> >Comfortaa</option>
																<option value="Coming Soon"  <?php selected($cal_font_style, 'Coming Soon' ); ?> >Coming Soon</option>
																<option value="Concert One"  <?php selected($cal_font_style, 'Concert One' ); ?> >Concert One</option>
																<option value="Condiment"  <?php selected($cal_font_style, 'Condiment' ); ?> >Condiment</option>
																<option value="Content"  <?php selected($cal_font_style, 'Content' ); ?> >Content</option>
																<option value="Contrail One"  <?php selected($cal_font_style, 'Contrail One' ); ?> >Contrail One</option>
																<option value="Convergence"  <?php selected($cal_font_style, 'Convergence' ); ?> >Convergence</option>
																<option value="Cookie"  <?php selected($cal_font_style, 'Cookie' ); ?> >Cookie</option>
																<option value="Copse"  <?php selected($cal_font_style, 'Copse' ); ?> >Copse</option>
																<option value="Corben"  <?php selected($cal_font_style, 'Corben' ); ?> >Corben</option>
																<option value="Courgette"  <?php selected($cal_font_style, 'Courgette' ); ?> >Courgette</option>
																<option value="Cousine"  <?php selected($cal_font_style, 'Cousine' ); ?> >Cousine</option>
																<option value="Coustard"  <?php selected($cal_font_style, 'Coustard' ); ?> >Coustard</option>
																<option value="Covered By Your Grace"  <?php selected($cal_font_style, 'Covered By Your Grace' ); ?> >Covered By Your Grace</option>
																<option value="Crafty Girls"  <?php selected($cal_font_style, 'Crafty Girls' ); ?> >Crafty Girls</option>
																<option value="Creepster"  <?php selected($cal_font_style, 'Creepster' ); ?> >Creepster</option>
																<option value="Crete Round"  <?php selected($cal_font_style, 'Crete Round' ); ?> >Crete Round</option>
																<option value="Crimson Text"  <?php selected($cal_font_style, 'Crimson Text' ); ?> >Crimson Text</option>
																<option value="Crushed"  <?php selected($cal_font_style, 'Crushed' ); ?> >Crushed</option>
																<option value="Cuprum"  <?php selected($cal_font_style, 'Cuprum' ); ?> >Cuprum</option>
																<option value="Cutive"  <?php selected($cal_font_style, 'Cutive' ); ?> >Cutive</option>
																<option value="Damion"  <?php selected($cal_font_style, 'Damion' ); ?> >Damion</option>
																<option value="Dancing Script"  <?php selected($cal_font_style, 'Dancing Script' ); ?> >Dancing Script</option>
																<option value="Dangrek"  <?php selected($cal_font_style, 'Dangrek' ); ?> >Dangrek</option>
																<option value="Dawning of a New Day"  <?php selected($cal_font_style, 'Dawning of a New Day' ); ?> >Dawning of a New Day</option>
																<option value="Days One"  <?php selected($cal_font_style, 'Days One' ); ?> >Days One</option>
																<option value="Delius"  <?php selected($cal_font_style, 'Delius' ); ?> >Delius</option>
																<option value="Delius Swash Caps"  <?php selected($cal_font_style, 'Delius Swash Caps' ); ?> >Delius Swash Caps</option>
																<option value="Delius Unicase"  <?php selected($cal_font_style, 'Delius Unicase' ); ?> >Delius Unicase</option>
																<option value="Della Respira"  <?php selected($cal_font_style, 'Della Respira' ); ?> >Della Respira</option>
																<option value="Devonshire"  <?php selected($cal_font_style, 'Devonshire' ); ?> >Devonshire</option>
																<option value="Didact Gothic"  <?php selected($cal_font_style, 'Didact Gothic' ); ?> >Didact Gothic</option>
																<option value="Diplomata"  <?php selected($cal_font_style, 'Diplomata' ); ?> >Diplomata</option>
																<option value="Diplomata SC"  <?php selected($cal_font_style, 'Diplomata SC' ); ?> >Diplomata SC</option>
																<option value="Doppio One"  <?php selected($cal_font_style, 'Doppio One' ); ?> >Doppio One</option>
																<option value="Dorsa"  <?php selected($cal_font_style, 'Dorsa' ); ?> >Dorsa</option>
																<option value="Dosis"  <?php selected($cal_font_style, 'Dosis' ); ?> >Dosis</option>
																<option value="Dr Sugiyama"  <?php selected($cal_font_style, 'Dr Sugiyama' ); ?> >Dr Sugiyama</option>
																<option value="Droid Sans"  <?php selected($cal_font_style, 'Droid Sans' ); ?> >Droid Sans</option>
																<option value="Droid Sans Mono"  <?php selected($cal_font_style, 'Droid Sans Mono' ); ?> >Droid Sans Mono</option>
																<option value="Droid Serif" <?php selected($cal_font_style, 'Droid Serif' ); ?> >Droid Serif</option>
																<option value="Duru Sans" <?php selected($cal_font_style, 'Duru Sans' ); ?> >Duru Sans</option>
																<option value="Dynalight" <?php selected($cal_font_style, 'Dynalight' ); ?> >Dynalight</option>
																<option value="EB Garamond" <?php selected($cal_font_style, 'EB Garamond' ); ?> >EB Garamond</option>
																<option value="Eater" <?php selected($cal_font_style, 'Eater' ); ?> >Eater</option>
																<option value="Economica" <?php selected($cal_font_style, 'Economica' ); ?> >Economica</option>
																<option value="Electrolize" <?php selected($cal_font_style, 'Electrolize' ); ?> >Electrolize</option>
																<option value="Emblema One" <?php selected($cal_font_style, 'Emblema One' ); ?> >Emblema One</option>
																<option value="Emilys Candy" <?php selected($cal_font_style, 'Emilys Candy' ); ?> >Emilys Candy</option>
																<option value="Engagement" <?php selected($cal_font_style, 'Engagement' ); ?> >Engagement</option>
																<option value="Enriqueta" <?php selected($cal_font_style, 'Enriqueta' ); ?> >Enriqueta</option>
																<option value="Erica One" <?php selected($cal_font_style, 'Erica One' ); ?> >Erica One</option>
																<option value="Esteban" <?php selected($cal_font_style, 'Esteban' ); ?> >Esteban</option>
																<option value="Euphoria Script" <?php selected($cal_font_style, 'Euphoria Script' ); ?>>Euphoria Script</option>
																<option value="Ewert" <?php selected($cal_font_style, 'Ewert' ); ?> >Ewert</option>
																<option value="Exo" <?php selected($cal_font_style, 'Exo' ); ?> >Exo</option>
																<option value="Expletus Sans" <?php selected($cal_font_style, 'Expletus Sans' ); ?> >Expletus Sans</option>
																<option value="Fanwood Text" <?php selected($cal_font_style, 'Fanwood Text' ); ?> >Fanwood Text</option>
																<option value="Fascinate" <?php selected($cal_font_style, 'Fascinate' ); ?> >Fascinate</option>
																<option value="Fascinate Inline" <?php selected($cal_font_style, 'Fascinate Inline' ); ?> >Fascinate Inline</option>
																<option value="Federant" <?php selected($cal_font_style, 'Federant' ); ?> >Federant</option>
																<option value="Federo" <?php selected($cal_font_style, 'Federo' ); ?> >Federo</option>
																<option value="Felipa" <?php selected($cal_font_style, 'Felipa' ); ?> >Felipa</option>
																<option value="Fjord One" <?php selected($cal_font_style, 'Fjord One' ); ?> >Fjord One</option>
																<option value="Flamenco" <?php selected($cal_font_style, 'Flamenco' ); ?> >Flamenco</option>
																<option value="Flavors" <?php selected($cal_font_style, 'Flavors' ); ?> >Flavors</option>
																<option value="Fondamento" <?php selected($cal_font_style, 'Fondamento' ); ?> >Fondamento</option>
																<option value="Fontdiner Swanky" <?php selected($cal_font_style, 'Fontdiner Swanky' ); ?> >Fontdiner Swanky</option>
																<option value="Forum" <?php selected($cal_font_style, 'Forum' ); ?> >Forum</option>
																<option value="Francois One" <?php selected($cal_font_style, 'Francois One' ); ?> >Francois One</option>
																<option value="Fredericka the Great" <?php selected($cal_font_style, 'Fredericka the Great' ); ?> >Fredericka the Great</option>
																<option value="Fredoka One" <?php selected($cal_font_style, 'Fredoka One' ); ?> >Fredoka One</option>
																<option value="Freehand" <?php selected($cal_font_style, 'Freehand' ); ?> >Freehand</option>
																<option value="Fresca" <?php selected($cal_font_style, 'Fresca' ); ?> >Fresca</option>
																<option value="Frijole" <?php selected($cal_font_style, 'Frijole' ); ?> >Frijole</option>
																<option value="Fugaz One" <?php selected($cal_font_style, 'Fugaz One' ); ?> >Fugaz One</option>
																<option value="GFS Didot" <?php selected($cal_font_style, 'GFS Didot' ); ?> >GFS Didot</option>
																<option value="GFS Neohellenic" <?php selected($cal_font_style, 'GFS Neohellenic' ); ?> >GFS Neohellenic</option>
																<option value="Galdeano" <?php selected($cal_font_style, 'Galdeano' ); ?> >Galdeano</option>
																<option value="Gentium Basic" <?php selected($cal_font_style, 'Gentium Basic' ); ?> >Gentium Basic</option>
																<option value="Gentium Book Basic" <?php selected($cal_font_style, 'Gentium Book Basic' ); ?> >Gentium Book Basic</option>
																<option value="Geo" <?php selected($cal_font_style, 'Geo' ); ?> >Geo</option>
																<option value="Geostar" <?php selected($cal_font_style, 'Geostar' ); ?> >Geostar</option>
																<option value="Geostar Fill" <?php selected($cal_font_style, 'Geostar Fill' ); ?> >Geostar Fill</option>
																<option value="Germania One" <?php selected($cal_font_style, 'Germania One' ); ?> >Germania One</option>
																<option value="Give You Glory" <?php selected($cal_font_style, 'Give You Glory' ); ?> >Give You Glory</option>
																<option value="Glass Antiqua" <?php selected($cal_font_style, 'Glass Antiqua' ); ?> >Glass Antiqua</option>
																<option value="Glegoo" <?php selected($cal_font_style, 'Glegoo' ); ?> >Glegoo</option>
																<option value="Gloria Hallelujah" <?php selected($cal_font_style, 'Gloria Hallelujah' ); ?> >Gloria Hallelujah</option>
																<option value="Goblin One" <?php selected($cal_font_style, 'Goblin One' ); ?> >Goblin One</option>
																<option value="Gochi Hand" <?php selected($cal_font_style, 'Gochi Hand' ); ?> >Gochi Hand</option>
																<option value="Gorditas" <?php selected($cal_font_style, 'Gorditas' ); ?> >Gorditas</option>
																<option value="Goudy Bookletter 1911" <?php selected($cal_font_style, 'Goudy Bookletter 191' ); ?> >Goudy Bookletter 1911</option>
																<option value="Graduate" <?php selected($cal_font_style, 'Graduate' ); ?> >Graduate</option>
																<option value="Gravitas One" <?php selected($cal_font_style, 'Gravitas One' ); ?> >Gravitas One</option>
																<option value="Great Vibes" <?php selected($cal_font_style, 'Great Vibes' ); ?> >Great Vibes</option>
																<option value="Gruppo" <?php selected($cal_font_style, 'Gruppo' ); ?> >Gruppo</option>
																<option value="Gudea" <?php selected($cal_font_style, 'Gudea' ); ?> >Gudea</option>
																<option value="Habibi" <?php selected($cal_font_style, 'Habibi' ); ?> >Habibi</option>
																<option value="Hammersmith One" <?php selected($cal_font_style, 'Hammersmith One' ); ?> >Hammersmith One</option>
																<option value="Handlee" <?php selected($cal_font_style, 'Handlee' ); ?> >Handlee</option>
																<option value="Hanuman" <?php selected($cal_font_style, 'Hanuman' ); ?> >Hanuman</option>
																<option value="Happy Monkey" <?php selected($cal_font_style, 'Happy Monkey' ); ?> >Happy Monkey</option>
																<option value="Henny Penny" <?php selected($cal_font_style, 'Henny Penny' ); ?> >Henny Penny</option>
																<option value="Herr Von Muellerhoff" <?php selected($cal_font_style, 'Herr Von Muellerhoff' ); ?> >Herr Von Muellerhoff</option>
																<option value="Holtwood One SC" <?php selected($cal_font_style, 'Holtwood One SC' ); ?> >Holtwood One SC</option>
																<option value="Homemade Apple" <?php selected($cal_font_style, 'Homemade Apple' ); ?> >Homemade Apple</option>
																<option value="Homenaje" <?php selected($cal_font_style, 'Homenaje' ); ?> >Homenaje</option>
																<option value="IM Fell DW Pica" <?php selected($cal_font_style, 'IM Fell DW Pica' ); ?> >IM Fell DW Pica</option>
																<option value="IM Fell DW Pica SC" <?php selected($cal_font_style, 'IM Fell DW Pica SC' ); ?> >IM Fell DW Pica SC</option>
																<option value="IM Fell Double Pica" <?php selected($cal_font_style, 'IM Fell Double Pica' ); ?> >IM Fell Double Pica</option>
																<option value="IM Fell Double Pica SC" <?php selected($cal_font_style, 'IM Fell Double Pica SC' ); ?> >IM Fell Double Pica SC</option>
																<option value="IM Fell English" <?php selected($cal_font_style, 'IM Fell English' ); ?> >IM Fell English</option>
																<option value="IM Fell English SC" <?php selected($cal_font_style, 'IM Fell English SC' ); ?> >IM Fell English SC</option>
																<option value="IM Fell French Canon" <?php selected($cal_font_style, 'IM Fell French Canon' ); ?> >IM Fell French Canon</option>
																<option value="IM Fell French Canon SC" <?php selected($cal_font_style, 'IM Fell French Canon SC' ); ?> >IM Fell French Canon SC</option>
																<option value="IM Fell Great Primer" <?php selected($cal_font_style, 'IM Fell Great Primer' ); ?> >IM Fell Great Primer</option>
																<option value="IM Fell Great Primer SC" <?php selected($cal_font_style, 'IM Fell Great Primer SC' ); ?> >IM Fell Great Primer SC</option>
																<option value="Iceberg" <?php selected($cal_font_style, 'Iceberg' ); ?> >Iceberg</option>
																<option value="Iceland" <?php selected($cal_font_style, 'Iceland' ); ?> >Iceland</option>
																<option value="Imprima" <?php selected($cal_font_style, 'Imprima' ); ?> >Imprima</option>
																<option value="Inconsolata" <?php selected($cal_font_style, 'Inconsolata' ); ?> >Inconsolata</option>
																<option value="Inder" <?php selected($cal_font_style, 'Inder' ); ?> >Inder</option>
																<option value="Indie Flower" <?php selected($cal_font_style, 'Indie Flower' ); ?> >Indie Flower</option>
																<option value="Inika" <?php selected($cal_font_style, 'Inika' ); ?> >Inika</option>
																<option value="Irish Grover" <?php selected($cal_font_style, 'Irish Grover' ); ?> >Irish Grover</option>
																<option value="Istok Web" <?php selected($cal_font_style, 'Istok Web' ); ?> >Istok Web</option>
																<option value="Italiana" <?php selected($cal_font_style, 'Italiana' ); ?> >Italiana</option>
																<option value="Italianno" <?php selected($cal_font_style, 'Italianno' ); ?> >Italianno</option>
																<option value="Jim Nightshade" <?php selected($cal_font_style, 'Jim Nightshade' ); ?> >Jim Nightshade</option>
																<option value="Jockey One" <?php selected($cal_font_style, 'Jockey One' ); ?> >Jockey One</option>
																<option value="Jolly Lodger" <?php selected($cal_font_style, 'Jolly Lodger' ); ?> >Jolly Lodger</option>
																<option value="Josefin Sans" <?php selected($cal_font_style, 'Josefin Sans' ); ?> >Josefin Sans</option>
																<option value="Josefin Slab" <?php selected($cal_font_style, 'Josefin Slab' ); ?> >Josefin Slab</option>
																<option value="Judson" <?php selected($cal_font_style, 'Judson' ); ?> >Judson</option>
																<option value="Julee" <?php selected($cal_font_style, 'Julee' ); ?> >Julee</option>
																<option value="Junge" <?php selected($cal_font_style, 'Junge' ); ?> >Junge</option>
																<option value="Jura" <?php selected($cal_font_style, 'Jura' ); ?> >Jura</option>
																<option value="Just Another Hand" <?php selected($cal_font_style, 'Just Another Hand' ); ?> >Just Another Hand</option>
																<option value="Just Me Again Down Here" <?php selected($cal_font_style, 'Just Me Again Down Here' ); ?> >Just Me Again Down Here</option>
																<option value="Kameron" <?php selected($cal_font_style, 'Kameron' ); ?> >Kameron</option>
																<option value="Karla" <?php selected($cal_font_style, 'Karla' ); ?> >Karla</option>
																<option value="Kaushan Script" <?php selected($cal_font_style, 'Kaushan Script' ); ?> >Kaushan Script</option>
																<option value="Kelly Slab" <?php selected($cal_font_style, 'Kelly Slab' ); ?> >Kelly Slab</option>
																<option value="Kenia" <?php selected($cal_font_style, 'Kenia' ); ?> >Kenia</option>
																<option value="Khmer" <?php selected($cal_font_style, 'Khmer' ); ?> >Khmer</option>
																<option value="Knewave" <?php selected($cal_font_style, 'Knewave' ); ?> >Knewave</option>
																<option value="Kotta One" <?php selected($cal_font_style, 'Kotta One' ); ?> >Kotta One</option>
																<option value="Koulen" <?php selected($cal_font_style, 'Koulen' ); ?> >Koulen</option>
																<option value="Kranky" <?php selected($cal_font_style, 'Kranky' ); ?> >Kranky</option>
																<option value="Kreon" <?php selected($cal_font_style, 'Kreon' ); ?> >Kreon</option>
																<option value="Kristi" <?php selected($cal_font_style, 'Kristi' ); ?> >Kristi</option>
																<option value="Krona One" <?php selected($cal_font_style, 'Krona One' ); ?> >Krona One</option>
																<option value="La Belle Aurore" <?php selected($cal_font_style, 'La Belle Aurore' ); ?> >La Belle Aurore</option>
																<option value="Lancelot" <?php selected($cal_font_style, 'Lancelot' ); ?> >Lancelot</option>
																<option value="Lato" <?php selected($cal_font_style, 'Lato' ); ?> >Lato</option>
																<option value="League Script" <?php selected($cal_font_style, 'League Script' ); ?> >League Script</option>
																<option value="Leckerli One" <?php selected($cal_font_style, 'Leckerli One' ); ?> >Leckerli One</option>
																<option value="Ledger" <?php selected($cal_font_style, 'Ledger' ); ?> >Ledger</option>
																<option value="Lekton" <?php selected($cal_font_style, 'Lekton' ); ?> >Lekton</option>
																<option value="Lemon" <?php selected($cal_font_style, 'Lemon' ); ?> >Lemon</option>
																<option value="Lilita One" <?php selected($cal_font_style, 'Lilita One' ); ?> >Lilita One</option>
																<option value="Limelight" <?php selected($cal_font_style, 'Limelight' ); ?> >Limelight</option>
																<option value="Linden Hill" <?php selected($cal_font_style, 'Linden Hill' ); ?> >Linden Hill</option>
																<option value="Lobster" <?php selected($cal_font_style, 'Lobster' ); ?> >Lobster</option>
																<option value="Lobster Two" <?php selected($cal_font_style, 'Lobster Two' ); ?> >Lobster Two</option>
																<option value="Londrina Outline" <?php selected($cal_font_style, 'Londrina Outline' ); ?> >Londrina Outline</option>
																<option value="Londrina Shadow" <?php selected($cal_font_style, 'Londrina Shadow' ); ?> >Londrina Shadow</option>
																<option value="Londrina Sketch" <?php selected($cal_font_style, 'Londrina Sketch' ); ?> >Londrina Sketch</option>
																<option value="Londrina Solid" <?php selected($cal_font_style, 'Londrina Solid' ); ?> >Londrina Solid</option>
																<option value="Lora" <?php selected($cal_font_style, 'Lora' ); ?> >Lora</option>
																<option value="Love Ya Like A Sister" <?php selected($cal_font_style, 'Love Ya Like A Sister' ); ?> >Love Ya Like A Sister</option>
																<option value="Loved by the King" <?php selected($cal_font_style, 'Loved by the King' ); ?> >Loved by the King</option>
																<option value="Lovers Quarrel" <?php selected($cal_font_style, 'Lovers Quarrel' ); ?> >Lovers Quarrel</option>
																<option value="Luckiest Guy" <?php selected($cal_font_style, 'Luckiest Guy' ); ?> >Luckiest Guy</option>
																<option value="Lusitana" <?php selected($cal_font_style, 'Lusitana' ); ?> >Lusitana</option>
																<option value="Lustria" <?php selected($cal_font_style, 'Lustria' ); ?> >Lustria</option>
																<option value="Macondo" <?php selected($cal_font_style, 'Macondo' ); ?> >Macondo</option>
																<option value="Macondo Swash Caps" <?php selected($cal_font_style, 'Macondo Swash Caps' ); ?> >Macondo Swash Caps</option>
																<option value="Magra" <?php selected($cal_font_style, 'Magra' ); ?> >Magra</option>
																<option value="Maiden Orange" <?php selected($cal_font_style, 'Maiden Orange' ); ?> >Maiden Orange</option>
																<option value="Mako" <?php selected($cal_font_style, 'Mako' ); ?> >Mako</option>
																<option value="Marck Script" <?php selected($cal_font_style, 'Marck Script' ); ?> >Marck Script</option>
																<option value="Marko One" <?php selected($cal_font_style, 'Marko One' ); ?> >Marko One</option>
																<option value="Marmelad" <?php selected($cal_font_style, 'Marmelad' ); ?> >Marmelad</option>
																<option value="Marvel" <?php selected($cal_font_style, 'Marvel' ); ?> >Marvel</option>
																<option value="Mate" <?php selected($cal_font_style, 'Mate' ); ?> >Mate</option>
																<option value="Mate SC" <?php selected($cal_font_style, 'Mate SC' ); ?> >Mate SC</option>
																<option value="Maven Pro" <?php selected($cal_font_style, 'Maven Pro' ); ?> >Maven Pro</option>
																<option value="Meddon" <?php selected($cal_font_style, 'Meddon' ); ?> >Meddon</option>
																<option value="MedievalSharp" <?php selected($cal_font_style, 'MedievalSharp' ); ?> >MedievalSharp</option>
																<option value="Medula One" <?php selected($cal_font_style, 'Medula One' ); ?> >Medula One</option>
																<option value="Megrim" <?php selected($cal_font_style, 'Megrim' ); ?> >Megrim</option>
																<option value="Merienda One" <?php selected($cal_font_style, 'Merienda One' ); ?> >Merienda One</option>
																<option value="Merriweather" <?php selected($cal_font_style, 'Merriweather' ); ?> >Merriweather</option>
																<option value="Metal" <?php selected($cal_font_style, 'Metal' ); ?> >Metal</option>
																<option value="Metamorphous"<?php selected($cal_font_style, 'Metamorphous' ); ?> >Metamorphous</option>
																<option value="Metrophobic" <?php selected($cal_font_style, 'Metrophobic' ); ?> >Metrophobic</option>
																<option value="Michroma" <?php selected($cal_font_style, 'Michroma' ); ?> >Michroma</option>
																<option value="Miltonian" <?php selected($cal_font_style, 'Miltonian' ); ?> >Miltonian</option>
																<option value="Miltonian Tattoo" <?php selected($cal_font_style, 'Miltonian Tattoo' ); ?> >Miltonian Tattoo</option>
																<option value="Miniver" <?php selected($cal_font_style, 'Miniver' ); ?> >Miniver</option>
																<option value="Miss Fajardose" <?php selected($cal_font_style, 'Miss Fajardose' ); ?> >Miss Fajardose</option>
																<option value="Modern Antiqua" <?php selected($cal_font_style, 'Modern Antiqua' ); ?> >Modern Antiqua</option>
																<option value="Molengo" <?php selected($cal_font_style, 'Molengo' ); ?> >Molengo</option>
																<option value="Monofett" <?php selected($cal_font_style, 'Monofett' ); ?> >Monofett</option>
																<option value="Monoton" <?php selected($cal_font_style, 'Monoton' ); ?> >Monoton</option>
																<option value="Monsieur La Doulaise" <?php selected($cal_font_style, 'Monsieur La Doulaise' ); ?> >Monsieur La Doulaise</option>
																<option value="Montaga" <?php selected($cal_font_style, 'Montaga' ); ?> >Montaga</option>
																<option value="Montez" <?php selected($cal_font_style, 'Montez' ); ?> >Montez</option>
																<option value="Montserrat" <?php selected($cal_font_style, 'Montserrat' ); ?> >Montserrat</option>
																<option value="Moul" <?php selected($cal_font_style, 'Moul' ); ?> >Moul</option>
																<option value="Moulpali" <?php selected($cal_font_style, 'Moulpali' ); ?> >Moulpali</option>
																<option value="Mountains of Christmas" <?php selected($cal_font_style, 'Mountains of Christmas' ); ?> >Mountains of Christmas</option>
																<option value="Mr Bedfort" <?php selected($cal_font_style, 'Mr Bedfort' ); ?> >Mr Bedfort</option>
																<option value="Mr Dafoe" <?php selected($cal_font_style, 'Mr Dafoe' ); ?> >Mr Dafoe</option>
																<option value="Mr De Haviland" <?php selected($cal_font_style, 'Mr De Haviland' ); ?> >Mr De Haviland</option>
																<option value="Mrs Saint Delafield" <?php selected($cal_font_style, 'Mrs Saint Delafield' ); ?> >Mrs Saint Delafield</option>
																<option value="Mrs Sheppards" <?php selected($cal_font_style, 'Mrs Sheppards' ); ?> >Mrs Sheppards</option>
																<option value="Muli" <?php selected($cal_font_style, 'Muli' ); ?> >Muli</option>
																<option value="Mystery Quest" <?php selected($cal_font_style, 'Mystery Quest' ); ?> >Mystery Quest</option>
																<option value="Neucha" <?php selected($cal_font_style, 'Neucha' ); ?> >Neucha</option>
																<option value="Neuton" <?php selected($cal_font_style, 'Neuton' ); ?> >Neuton</option>
																<option value="News Cycle" <?php selected($cal_font_style, 'News Cycle' ); ?> >News Cycle</option>
																<option value="Niconne" <?php selected($cal_font_style, 'Niconne' ); ?> >Niconne</option>
																<option value="Nixie One" <?php selected($cal_font_style, 'Nixie One' ); ?> >Nixie One</option>
																<option value="Nobile" <?php selected($cal_font_style, 'Nobile' ); ?> >Nobile</option>
																<option value="Nokora" <?php selected($cal_font_style, 'Nokora' ); ?> >Nokora</option>
																<option value="Norican" <?php selected($cal_font_style, 'Norican' ); ?> >Norican</option>
																<option value="Nosifer" <?php selected($cal_font_style, 'Nosifer' ); ?> >Nosifer</option>
																<option value="Nothing You Could Do" <?php selected($cal_font_style, 'Nothing You Could Do' ); ?> >Nothing You Could Do</option>
																<option value="Noticia Text" <?php selected($cal_font_style, 'Noticia Text' ); ?> >Noticia Text</option>
																<option value="Nova Cut" <?php selected($cal_font_style, 'Nova Cut' ); ?> >Nova Cut</option>
																<option value="Nova Flat" <?php selected($cal_font_style, 'Nova Flat' ); ?> >Nova Flat</option>
																<option value="Nova Mono" <?php selected($cal_font_style, 'Nova Mono' ); ?> >Nova Mono</option>
																<option value="Nova Oval" <?php selected($cal_font_style, 'Nova Oval' ); ?> >Nova Oval</option>
																<option value="Nova Round" <?php selected($cal_font_style, 'Nova Round' ); ?> >Nova Round</option>
																<option value="Nova Script" <?php selected($cal_font_style, 'Nova Script' ); ?> >Nova Script</option>
																<option value="Nova Slim" <?php selected($cal_font_style, 'Nova Slim' ); ?> >Nova Slim</option>
																<option value="Nova Square" <?php selected($cal_font_style, 'Nova Square' ); ?> >Nova Square</option>
																<option value="Numans" <?php selected($cal_font_style, 'Numans' ); ?> >Numans</option>
																<option value="Nunito" <?php selected($cal_font_style, 'Nunito' ); ?> >Nunito</option>
																<option value="Odor Mean Chey" <?php selected($cal_font_style, 'Odor Mean Chey' ); ?> >Odor Mean Chey</option>
																<option value="Old Standard TT" <?php selected($cal_font_style, 'Old Standard TT' ); ?> >Old Standard TT</option>
																<option value="Oldenburg" <?php selected($cal_font_style, 'Oldenburg' ); ?> >Oldenburg</option>
																<option value="Oleo Script" <?php selected($cal_font_style, 'Oleo Script' ); ?> >Oleo Script</option>
																<option value="Open Sans" <?php selected($cal_font_style, 'Open Sans' ); ?> >Open Sans</option>
																<option value="Open Sans Condensed" <?php selected($cal_font_style, 'Open Sans Condensed' ); ?> >Open Sans Condensed</option>
																<option value="Orbitron" <?php selected($cal_font_style, 'Orbitron' ); ?> >Orbitron</option>
																<option value="Original Surfer" <?php selected($cal_font_style, 'Original Surfer' ); ?> >Original Surfer</option>
																<option value="Oswald" <?php selected($cal_font_style, 'Oswald' ); ?> >Oswald</option>
																<option value="Over the Rainbow" <?php selected($cal_font_style, 'Over the Rainbow' ); ?> >Over the Rainbow</option>
																<option value="Overlock" <?php selected($cal_font_style, 'Overlock' ); ?> >Overlock</option>
																<option value="Overlock SC" <?php selected($cal_font_style, 'Overlock SC' ); ?> >Overlock SC</option>
																<option value="Ovo" <?php selected($cal_font_style, 'Ovo' ); ?> >Ovo</option>
																<option value="Oxygen" <?php selected($cal_font_style, 'Oxygen' ); ?> >Oxygen</option>
																<option value="PT Mono" <?php selected($cal_font_style, 'PT Mono' ); ?> >PT Mono</option>
																<option value="PT Sans" <?php selected($cal_font_style, 'PT Sans' ); ?> >PT Sans</option>
																<option value="PT Sans Caption" <?php selected($cal_font_style, 'PT Sans Caption' ); ?> >PT Sans Caption</option>
																<option value="PT Sans Narrow" <?php selected($cal_font_style, 'PT Sans Narrow' ); ?> >PT Sans Narrow</option>
																<option value="PT Serif" <?php selected($cal_font_style, 'PT Serif' ); ?> >PT Serif</option>
																<option value="PT Serif Caption" <?php selected($cal_font_style, 'PT Serif Caption' ); ?> >PT Serif Caption</option>
																<option value="Pacifico" <?php selected($cal_font_style, 'Pacifico' ); ?> >Pacifico</option>
																<option value="Parisienne" <?php selected($cal_font_style, 'Parisienne' ); ?> >Parisienne</option>
																<option value="Passero One" <?php selected($cal_font_style, 'Passero One' ); ?> >Passero One</option>
																<option value="Passion One" <?php selected($cal_font_style, 'Passion One' ); ?> >Passion One</option>
																<option value="Patrick Hand" <?php selected($cal_font_style, 'Patrick Hand' ); ?> >Patrick Hand</option>
																<option value="Patua One" <?php selected($cal_font_style, 'Patua One' ); ?> >Patua One</option>
																<option value="Paytone One" <?php selected($cal_font_style, 'Paytone One' ); ?> >Paytone One</option>
																<option value="Permanent Marker" <?php selected($cal_font_style, 'Permanent Marker' ); ?> >Permanent Marker</option>
																<option value="Petrona" <?php selected($cal_font_style, 'Petrona' ); ?> >Petrona</option>
																<option value="Philosopher" <?php selected($cal_font_style, 'Philosopher' ); ?> >Philosopher</option>
																<option value="Piedra" <?php selected($cal_font_style, 'Piedra' ); ?> >Piedra</option>
																<option value="Pinyon Script" <?php selected($cal_font_style, 'Pinyon Script' ); ?> >Pinyon Script</option>
																<option value="Plaster" <?php selected($cal_font_style, 'Plaster' ); ?> >Plaster</option>
																<option value="Play" <?php selected($cal_font_style, 'Play' ); ?> >Play</option>
																<option value="Playball" <?php selected($cal_font_style, 'Playball' ); ?> >Playball</option>
																<option value="Playfair Display" <?php selected($cal_font_style, 'Playfair Display' ); ?> >Playfair Display</option>
																<option value="Podkova" <?php selected($cal_font_style, 'Podkova' ); ?> >Podkova</option>
																<option value="Poiret One" <?php selected($cal_font_style, 'Poiret One' ); ?> >Poiret One</option>
																<option value="Poller One" <?php selected($cal_font_style, 'Poller One' ); ?> >Poller One</option>
																<option value="Poly" <?php selected($cal_font_style, 'Poly' ); ?> >Poly</option>
																<option value="Pompiere" <?php selected($cal_font_style, 'Pompiere' ); ?> >Pompiere</option>
																<option value="Pontano Sans" <?php selected($cal_font_style, 'Pontano Sans' ); ?> >Pontano Sans</option>
																<option value="Port Lligat Sans" <?php selected($cal_font_style, 'Port Lligat Sans' ); ?> >Port Lligat Sans</option>
																<option value="Port Lligat Slab" <?php selected($cal_font_style, 'Port Lligat Slab' ); ?> >Port Lligat Slab</option>
																<option value="Prata" <?php selected($cal_font_style, 'Prata' ); ?> >Prata</option>
																<option value="Preahvihear" <?php selected($cal_font_style, 'Preahvihear' ); ?> >Preahvihear</option>
																<option value="Press Start 2P" <?php selected($cal_font_style, 'Press Start 2P' ); ?> >Press Start 2P</option>
																<option value="Princess Sofia" <?php selected($cal_font_style, 'Princess Sofia' ); ?> >Princess Sofia</option>
																<option value="Prociono" <?php selected($cal_font_style, 'Prociono' ); ?> >Prociono</option>
																<option value="Prosto One" <?php selected($cal_font_style, 'Prosto One' ); ?> >Prosto One</option>
																<option value="Puritan" <?php selected($cal_font_style, 'Puritan' ); ?> >Puritan</option>
																<option value="Quantico" <?php selected($cal_font_style, 'Quantico' ); ?> >Quantico</option>
																<option value="Quattrocento" <?php selected($cal_font_style, 'Quattrocento' ); ?> >Quattrocento</option>
																<option value="Quattrocento Sans" <?php selected($cal_font_style, 'Quattrocento Sans' ); ?> >Quattrocento Sans</option>
																<option value="Questrial" <?php selected($cal_font_style, 'Questrial' ); ?> >Questrial</option>
																<option value="Quicksand" <?php selected($cal_font_style, 'Quicksand' ); ?> >Quicksand</option>
																<option value="Qwigley" <?php selected($cal_font_style, 'Qwigley' ); ?> >Qwigley</option>
																<option value="Radley" <?php selected($cal_font_style, 'Radley' ); ?> >Radley</option>
																<option value="Raleway" <?php selected($cal_font_style, 'Raleway' ); ?> >Raleway</option>
																<option value="Rammetto One" <?php selected($cal_font_style, 'Rammetto One' ); ?> >Rammetto One</option>
																<option value="Rancho" <?php selected($cal_font_style, 'Rancho' ); ?> >Rancho</option>
																<option value="Rationale" <?php selected($cal_font_style, 'Rationale' ); ?> >Rationale</option>
																<option value="Redressed" <?php selected($cal_font_style, 'Redressed' ); ?> >Redressed</option>
																<option value="Reenie Beanie" <?php selected($cal_font_style, 'Reenie Beanie' ); ?> >Reenie Beanie</option>
																<option value="Revalia" <?php selected($cal_font_style, 'Revalia' ); ?> >Revalia</option>
																<option value="Ribeye" <?php selected($cal_font_style, 'Ribeye' ); ?> >Ribeye</option>
																<option value="Ribeye Marrow" <?php selected($cal_font_style, 'Ribeye Marrow' ); ?> >Ribeye Marrow</option>
																<option value="Righteous" <?php selected($cal_font_style, 'Righteous' ); ?> >Righteous</option>
																<option value="Rochester" <?php selected($cal_font_style, 'Rochester' ); ?> >Rochester</option>
																<option value="Rock Salt" <?php selected($cal_font_style, 'Rock Salt' ); ?> >Rock Salt</option>
																<option value="Rokkitt" <?php selected($cal_font_style, 'Rokkitt' ); ?> >Rokkitt</option>
																<option value="Ropa Sans" <?php selected($cal_font_style, 'Ropa Sans' ); ?> >Ropa Sans</option>
																<option value="Rosario" <?php selected($cal_font_style, 'Rosario' ); ?> >Rosario</option>
																<option value="Rosarivo" <?php selected($cal_font_style, 'Rosarivo' ); ?> >Rosarivo</option>
																<option value="Rouge Script" <?php selected($cal_font_style, 'Rouge Script' ); ?> >Rouge Script</option>
																<option value="Ruda" <?php selected($cal_font_style, 'Ruda' ); ?> >Ruda</option>
																<option value="Ruge Boogie" <?php selected($cal_font_style, 'Ruge Boogie' ); ?> >Ruge Boogie</option>
																<option value="Ruluko" <?php selected($cal_font_style, 'Ruluko' ); ?> >Ruluko</option>
																<option value="Ruslan Display" <?php selected($cal_font_style, 'Ruslan Display' ); ?> >Ruslan Display</option>
																<option value="Russo One" <?php selected($cal_font_style, 'Russo One' ); ?> >Russo One</option>
																<option value="Ruthie" <?php selected($cal_font_style, 'Ruthie' ); ?> >Ruthie</option>
																<option value="Sail" <?php selected($cal_font_style, 'Sail' ); ?> >Sail</option>
																<option value="Salsa" <?php selected($cal_font_style, 'Salsa' ); ?> >Salsa</option>
																<option value="Sancreek" <?php selected($cal_font_style, 'Sancreek' ); ?> >Sancreek</option>
																<option value="Sansita One" <?php selected($cal_font_style, 'Sansita One' ); ?> >Sansita One</option>
																<option value="Sarina" <?php selected($cal_font_style, 'Sarina' ); ?> >Sarina</option>
																<option value="Satisfy" <?php selected($cal_font_style, 'Satisfy' ); ?> >Satisfy</option>
																<option value="Schoolbell" <?php selected($cal_font_style, 'Schoolbell' ); ?> >Schoolbell</option>
																<option value="Seaweed Script" <?php selected($cal_font_style, 'Seaweed Script' ); ?> >Seaweed Script</option>
																<option value="Sevillana" <?php selected($cal_font_style, 'Sevillana' ); ?> >Sevillana</option>
																<option value="Shadows Into Light" <?php selected($cal_font_style, 'Shadows Into Light' ); ?> >Shadows Into Light</option>
																<option value="Shadows Into Light Two" <?php selected($cal_font_style, 'Shadows Into Light Two' ); ?> >Shadows Into Light Two</option>
																<option value="Shanti" <?php selected($cal_font_style, 'Shanti' ); ?> >Shanti</option>
																<option value="Share" <?php selected($cal_font_style, 'Share' ); ?> >Share</option>
																<option value="Shojumaru" <?php selected($cal_font_style, 'Shojumaru' ); ?> >Shojumaru</option>
																<option value="Short Stack" <?php selected($cal_font_style, 'Short Stack' ); ?> >Short Stack</option>
																<option value="Siemreap"<?php selected($cal_font_style, 'Siemreap' ); ?> >Siemreap</option>
																<option value="Sigmar One" <?php selected($cal_font_style, 'Sigmar One' ); ?> >Sigmar One</option>
																<option value="Signika"<?php selected($cal_font_style, 'Signika' ); ?> >Signika</option>
																<option value="Signika Negative" <?php selected($cal_font_style, 'Signika Negative' ); ?> >Signika Negative</option>
																<option value="Simonetta" <?php selected($cal_font_style, 'Simonetta' ); ?> >Simonetta</option>
																<option value="Sirin Stencil" <?php selected($cal_font_style, 'Sirin Stencil' ); ?> >Sirin Stencil</option>
																<option value="Six Caps" <?php selected($cal_font_style, 'Six Caps' ); ?> >Six Caps</option>
																<option value="Slackey" <?php selected($cal_font_style, 'Slackey' ); ?> >Slackey</option>
																<option value="Smokum" <?php selected($cal_font_style, 'Smokum' ); ?> >Smokum</option>
																<option value="Smythe" <?php selected($cal_font_style, 'Smythe' ); ?> >Smythe</option>
																<option value="Sniglet" <?php selected($cal_font_style, 'Sniglet' ); ?> >Sniglet</option>
																<option value="Snippet" <?php selected($cal_font_style, 'Snippet' ); ?> >Snippet</option>
																<option value="Sofia" <?php selected($cal_font_style, 'Sofia' ); ?> >Sofia</option>
																<option value="Sonsie One" <?php selected($cal_font_style, 'Sonsie One' ); ?> >Sonsie One</option>
																<option value="Sorts Mill Goudy" <?php selected($cal_font_style, 'Sorts Mill Goudy' ); ?> >Sorts Mill Goudy</option>
																<option value="Special Elite" <?php selected($cal_font_style, 'Special Elite' ); ?> >Special Elite</option>
																<option value="Spicy Rice" <?php selected($cal_font_style, 'Spicy Rice' ); ?> >Spicy Rice</option>
																<option value="Spinnaker" <?php selected($cal_font_style, 'Spinnaker' ); ?> >Spinnaker</option>
																<option value="Spirax" <?php selected($cal_font_style, 'Spirax' ); ?> >Spirax</option>
																<option value="Squada One" <?php selected($cal_font_style, 'Squada One' ); ?> >Squada One</option>
																<option value="Stardos Stencil" <?php selected($cal_font_style, 'Stardos Stencil' ); ?> >Stardos Stencil</option>
																<option value="Stint Ultra Condensed" <?php selected($cal_font_style, 'Stint Ultra Condensed' ); ?> >Stint Ultra Condensed</option>
																<option value="Stint Ultra Expanded" <?php selected($cal_font_style, 'Stint Ultra Expanded' ); ?> >Stint Ultra Expanded</option>
																<option value="Stoke" <?php selected($cal_font_style, 'Stoke' ); ?> >Stoke</option>
																<option value="Sue Ellen Francisco" <?php selected($cal_font_style, 'Sue Ellen Francisco' ); ?> >Sue Ellen Francisco</option>
																<option value="Sunshiney" <?php selected($cal_font_style, 'Sunshiney' ); ?> >Sunshiney</option>
																<option value="Supermercado One" <?php selected($cal_font_style, 'Supermercado One' ); ?> >Supermercado One</option>
																<option value="Suwannaphum" <?php selected($cal_font_style, 'Suwannaphum' ); ?> >Suwannaphum</option>
																<option value="Swanky and Moo Moo" <?php selected($cal_font_style, 'Swanky and Moo Moo' ); ?> >Swanky and Moo Moo</option>
																<option value="Syncopate" <?php selected($cal_font_style, 'Syncopate' ); ?> >Syncopate</option>
																<option value="Tangerine" <?php selected($cal_font_style, 'Tangerine' ); ?> >Tangerine</option>
																<option value="Taprom" <?php selected($cal_font_style, 'Taprom' ); ?> >Taprom</option>
																<option value="Telex" <?php selected($cal_font_style, 'Telex' ); ?> >Telex</option>
																<option value="Tenor Sans" <?php selected($cal_font_style, 'Tenor Sans' ); ?> >Tenor Sans</option>
																<option value="The Girl Next Door" <?php selected($cal_font_style, 'The Girl Next Door' ); ?> >The Girl Next Door</option>
																<option value="Tienne" <?php selected($cal_font_style, 'Tienne' ); ?> >Tienne</option>
																<option value="Tinos" <?php selected($cal_font_style, 'Tinos' ); ?> >Tinos</option>
																<option value="Titan One" <?php selected($cal_font_style, 'Titan One' ); ?> >Titan One</option>
																<option value="Trade Winds" <?php selected($cal_font_style, 'Trade Winds' ); ?> >Trade Winds</option>
																<option value="Trocchi" <?php selected($cal_font_style, 'Trocchi' ); ?> >Trocchi</option>
																<option value="Trochut" <?php selected($cal_font_style, 'Trochut' ); ?> >Trochut</option>
																<option value="Trykker" <?php selected($cal_font_style, 'Trykker' ); ?> >Trykker</option>
																<option value="Tulpen One" <?php selected($cal_font_style, 'Tulpen One' ); ?> >Tulpen One</option>
																<option value="Ubuntu" <?php selected($cal_font_style, 'Ubuntu' ); ?> >Ubuntu</option>
																<option value="Ubuntu Condensed" <?php selected($cal_font_style, 'Ubuntu Condensed' ); ?> >Ubuntu Condensed</option>
																<option value="Ubuntu Mono" <?php selected($cal_font_style, 'Ubuntu Mono' ); ?> >Ubuntu Mono</option>
																<option value="Ultra" <?php selected($cal_font_style, 'Ultra' ); ?> >Ultra</option>
																<option value="Uncial Antiqua" <?php selected($cal_font_style, 'Uncial Antiqua' ); ?> >Uncial Antiqua</option>
																<option value="UnifrakturCook" <?php selected($cal_font_style, 'UnifrakturCook' ); ?> >UnifrakturCook</option>
																<option value="UnifrakturMaguntia" <?php selected($cal_font_style, 'UnifrakturMaguntia' ); ?> >UnifrakturMaguntia</option>
																<option value="Unkempt" <?php selected($cal_font_style, 'Unkempt' ); ?> >Unkempt</option>
																<option value="Unlock" <?php selected($cal_font_style, 'Unlock' ); ?> >Unlock</option>
																<option value="Unna" <?php selected($cal_font_style, 'Unna' ); ?> >Unna</option>
																<option value="VT323" <?php selected($cal_font_style, 'VT323' ); ?> >VT323</option>
																<option value="Varela" <?php selected($cal_font_style, 'Varela' ); ?> >Varela</option>
																<option value="Varela Round" <?php selected($cal_font_style, 'Varela Round' ); ?> >Varela Round</option>
																<option value="Vast Shadow" <?php selected($cal_font_style, 'Vast Shadow' ); ?> >Vast Shadow</option>
																<option value="Vibur" <?php selected($cal_font_style, 'Vibur' ); ?> >Vibur</option>
																<option value="Vidaloka" <?php selected($cal_font_style, 'Vidaloka' ); ?> >Vidaloka</option>
																<option value="Viga" <?php selected($cal_font_style, 'Viga' ); ?> >Viga</option>
																<option value="Voces" <?php selected($cal_font_style, 'Voces' ); ?> >Voces</option>
																<option value="Volkhov" <?php selected($cal_font_style, 'Volkhov' ); ?> >Volkhov</option>
																<option value="Vollkorn" <?php selected($cal_font_style, 'Vollkorn' ); ?> >Vollkorn</option>
																<option value="Voltaire" <?php selected($cal_font_style, 'Voltaire' ); ?> >Voltaire</option>
																<option value="Waiting for the Sunrise" <?php selected($cal_font_style, 'Waiting for the Sunrise' ); ?> >Waiting for the Sunrise</option>
																<option value="Wallpoet" <?php selected($cal_font_style, 'Wallpoet' ); ?> >Wallpoet</option>
																<option value="Walter Turncoat" <?php selected($cal_font_style, 'Walter Turncoat' ); ?> >Walter Turncoat</option>
																<option value="Wellfleet" <?php selected($cal_font_style, 'Wellfleet' ); ?> >Wellfleet</option>
																<option value="Wire One" <?php selected($cal_font_style, 'Wire One' ); ?> >Wire One</option>
																<option value="Yanone Kaffeesatz" <?php selected($cal_font_style, 'Yanone Kaffeesatz' ); ?> >Yanone Kaffeesatz</option>
																<option value="Yellowtail" <?php selected($cal_font_style, 'Yellowtail' ); ?> >Yellowtail</option>
																<option value="Yeseva One" <?php selected($cal_font_style, 'Yeseva One' ); ?> >Yeseva One</option>
																<option value="Yesteryear" <?php selected($cal_font_style, 'Yesteryear' ); ?> >Yesteryear</option>
																<option value="Zeyada" <?php selected($cal_font_style, 'Zeyada' ); ?> >Zeyada</option>
															</optgroup>
														</select>
													</div>
												</form>
											</div>
										</div>
				                         <div class="col-md-12 calendar-form">
														<button  type="button" class="btn save-link" id='save_settings_05'  onclick="return save_calender_setting();"> <?php _e('Save',WL_A_P_SYSTEM); ?></button>
													</div>
									</div>
											
											<div id="cancel-appoint" class="tab-pane fade">
												<form style="margin-bottom: 0;" action="" method="POST" id="ap_advance_settings">
												<h2><?php _e('Cancel Appoinment',WL_A_P_SYSTEM); ?></h2>
												<center><img  src="<?php echo WEBLIZAR_A_P_SYSTEM.'/images/coming_soon.png'; ?>"  width="300" height="250" /><center>
												<!--<div class="col-md-12 bs-form form-group">												
													<div class="col-md-6"><label>Advance Boooking Time</label></div>
															<div class="col-md-3">
																<select name="advance_booking_time" id="advance_booking_time" class="standard-dropdown form-control">
																	<?php $settings_advance_booking_time = $wpdb->get_col( "SELECT advance_booking_time from $settings_table" ); 
																			$advance_booking_time	= $settings_advance_booking_time[0];?>
																	<optgroup label="In Hours">
																		<option value="select">Select</option>
																		<option value="1_hr" <?php //selected($advance_booking_time, '1_hr' ); ?> >1 Hour</option>
																		<option value="2_hr" <?php //selected($advance_booking_time, '2_hr' ); ?> >2 Hours</option>
																		<option value="3_hr" <?php //selected($advance_booking_time, '3_hr' ); ?> >3 Hours</option>
																		<option value="4_hr" <?php //selected($advance_booking_time, '4_hr' ); ?> >4 Hours</option>
																		<option value="5_hr" <?php //selected($advance_booking_time, '5_hr' ); ?> >5 Hours</option>
																		<option value="6_hr" <?php //selected($advance_booking_time, '6_hr' ); ?> >6 Hours</option>
																		<option value="8_hr" <?php //selected($advance_booking_time, '8_hr' ); ?> >8 Hours</option>
																		<option value="10_hr" <?php //selected($advance_booking_time, '10_hr' ); ?> >10 Hours</option>
																		<option value="12_hr" <?php //selected($advance_booking_time, '12_hr' ); ?> >12 Hours</option>
																	</optgroup>
																	<optgroup label="In Days">
																		<option value="1_day" <?php //selected($advance_booking_time, '1_day' ); ?> >1 Day</option>
																		<option value="2_day" <?php //selected($advance_booking_time, '2_day' ); ?> >2 Days</option>
																		<option value="3_day" <?php //selected($advance_booking_time, '3_day' ); ?> >3 Days</option>
																		<option value="4_day" <?php //selected($advance_booking_time, '4_day' ); ?> >4 Days</option>
																		<option value="5_day" <?php //selected($advance_booking_time, '5_day' ); ?> >5 Days</option>
																	</optgroup>
																	<optgroup label="In Weeks">
																		<option value="1_week" <?php //selected($advance_booking_time, '1_week' ); ?> >1 Week</option>
																		<option value="2_week" <?php //selected($advance_booking_time, '2_week' ); ?> >2 Weeks</option>
																		<option value="3_week" <?php //selected($advance_booking_time, '3_week' ); ?> >3 Weeks</option>
																		<option value="4_week" <?php //selected($advance_booking_time, '4_week' ); ?> >4 Weeks</option>
																	</optgroup>
																</select>
															</div>
													
												</div>
												<div class="col-md-12 bs-form form-group">
													<div class="col-md-6"><label>Advance Booking Cancel</label></div>
													<div class="col-md-3">
														<select name="advance_cancel_time" id="advance_cancel_time" class="standard-dropdown form-control">
														<?php $settings_advance_cancel_time = $wpdb->get_col( "SELECT advance_cancel_time from $settings_table" ); 
																			$advance_cancel_time	= $settings_advance_cancel_time[0];?>
															<optgroup label="In Hours">
																<option value="select">Select</option>
																<option value="1_hr" <?php //selected($advance_cancel_time, '1_hr' ); ?> >1 Hour</option>
																<option value="2_hr" <?php //selected($advance_cancel_time, '2_hr' ); ?> >2 Hours</option>
																<option value="3_hr" <?php //selected($advance_cancel_time, '3_hr' ); ?> >3 Hours</option>
																<option value="4_hr" <?php //selected($advance_cancel_time, '4_hr' ); ?> >4 Hours</option>
																<option value="5_hr" <?php //selected($advance_cancel_time, '5_hr' ); ?> >5 Hours</option>
																<option value="6_hr" <?php //selected($advance_cancel_time, '6_hr' ); ?> >6 Hours</option>
																<option value="8_hr" <?php //selected($advance_cancel_time, '8_hr' ); ?> >8 Hours</option>
																<option value="10_hr" <?php //selected($advance_cancel_time, '10_hr' ); ?> >10 Hours</option>
																<option value="12_hr" <?php //selected($advance_cancel_time, '12_hr' ); ?> >12 Hours</option>
															</optgroup>
															<optgroup label="In Days">
																<option value="1_day" <?php //selected($advance_cancel_time, '1_day' ); ?> >1 Day</option>
																<option value="2_day" <?php //selected($advance_cancel_time, '2_day' ); ?> >2 Days</option>
																<option value="3_day" <?php //selected($advance_cancel_time, '3_day' ); ?> >3 Days</option>
																<option value="4_day" <?php //selected($advance_cancel_time, '5_day' ); ?> >4 Days</option>
																<option value="5_day" <?php //selected($advance_cancel_time, '5_day' ); ?> >5 Days</option>
															</optgroup>
															<optgroup label="In Weeks">
																<option value="1_week" <?php //selected($advance_cancel_time, '1_week' ); ?> >1 Week</option>
																<option value="2_week" <?php //selected($advance_cancel_time, '2_week' ); ?> >2 Weeks</option>
																<option value="3_week" <?php //selected($advance_cancel_time, '3_week' ); ?> >3 Weeks</option>
																<option value="4_week" <?php //selected($advance_cancel_time, '4_week' ); ?> >4 Weeks</option>
																<option value="5_week" <?php //selected($advance_cancel_time, '5_week' ); ?> >5 Weeks</option>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="col-md-12 bs-form form-group">
													<button  type="button" class="btn save-link" id='save_settings_06' onclick="return save_advance_setting();">Save</button>
												</div>-->
												</form>
											</div>
											
									<div id="reminder" class="tab-pane fade">
										<h2><?php _e('Reminder Setting',WL_A_P_SYSTEM); ?></h2>
										
										<div class="col-md-12 bussiness-form">
											<form style="margin-bottom: 0;" action="" method="POST" id="ap_reminder_settings" >
											<div class="col-md-12 bs-form form-group">
													<div class="col-md-3"><label>Enable</label></div>
													<div class="col-md-9">
													<?php $settings_enable_reminder = $wpdb->get_col( "SELECT enable_reminder from $settings_table" ); 
															$enable_reminder	= $settings_enable_reminder[0];?>
													<input id="enable_reminder" type="checkbox"  name="enable_reminder" class="sl-select" value="yes" <?php  if($enable_reminder=='yes'){ echo 'checked'; } else{ echo ' '; } ?>  />  
													</div>
												</div>
											<div class="col-md-12 bs-form form-group">
													<div class="col-md-3"><label>Select Time </label></div>
													<div class="col-md-9">
														<select name="reminder_time" id="reminder_time" class="form-control">
														<option value="0">Select one</option>
														<?php $settings_reminder_time = $wpdb->get_col( "SELECT reminder_time from $settings_table" ); 
																$reminder_time	= $settings_reminder_time[0];?>
															
															<optgroup label="In Days">
																<option value="1" <?php selected($reminder_time, '1' ); ?> >1 Day</option>
																<option value="2" <?php selected($reminder_time, '2' ); ?> >2 Days</option>
																<option value="3" <?php selected($reminder_time, '3' ); ?> >3 Days</option>
																<option value="4" <?php selected($reminder_time, '4' ); ?> >4 Days</option>
																<option value="5" <?php selected($reminder_time, '5' ); ?> >5 Days</option>
																<option value="6" <?php selected($reminder_time, '6' ); ?> >6 Days</option>
																<option value="7" <?php selected($reminder_time, '7' ); ?> >7 Days</option>
																<option value="8" <?php selected($reminder_time, '8' ); ?> >8 Days</option>
																<option value="9" <?php selected($reminder_time, '9' ); ?> >9 Days</option>
																<option value="10" <?php selected($reminder_time, '10' ); ?> >10 Days</option>
															</optgroup>
															
														</select>
														<span  class="validation_alert" id="reminder_time_alert"><?php _e("Please select one",WL_A_P_SYSTEM ); ?></span>
													</div>
												</div>
												
												<div class="col-md-12 bs-form form-group">
													<div class="col-md-3"><label>Subject</label></div>
													<div class="col-md-9">
													<?php $subject_reminder= $email_reminder_settings['subject_notification_reminder'];?>
														<input class="form-control" type="text" name="subject_reminder" value="<?php echo esc_attr($subject_reminder);  ?>" id="subject_reminder" placeholder="Subject"/>  
														<span  class="validation_alert" id="subject_reminder_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
													</div>
												</div>
												<div class="col-md-12 bs-form form-group">
													<div class="col-md-3"><label>Message</label></div>
													<div class="col-md-9">
													<?php $body_reminder= $email_reminder_settings['body_notification_reminder'];?>
														<textarea class="form-control" name="body_reminder" id="body_reminder"  placeholder="Message" rows="8"><?php echo esc_attr($body_reminder);  ?></textarea>
														<span  class="validation_alert" id="body_reminder_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
													</div>
												</div>
												<div class="col-md-12 reminder_mail_codes">
												<table class="note-table">
															<tr>
														<td><h4> <?php _e('Variables',WL_A_P_SYSTEM); ?></h4></td><td><h4><?php _e('Codes',WL_A_P_SYSTEM); ?></h4></td>
													</tr>
													<tr>
														<td><?php _e('Service:',WL_A_P_SYSTEM); ?></td><td>[SERVICE_NAME]</td>
													</tr>
													<tr>
														<td><?php _e('Staff:',WL_A_P_SYSTEM); ?></td><td>[STAFF_NAME]</td>
													</tr>
													<tr>
														<td><?php _e('Date:',WL_A_P_SYSTEM); ?></td> <td>[APPOINTMENT_DATE]</td>
													</tr>
													<tr>
														<td><?php _e('Time:',WL_A_P_SYSTEM); ?></td> <td>[APPOINTMENT_TIME]</td>
													</tr>
													<tr>
														<td> <?php _e('Status:',WL_A_P_SYSTEM); ?></td> <td>[APPOINTMENT_STATUS]</td>
													</tr>
													<tr>
														<td><?php _e('Client name:',WL_A_P_SYSTEM); ?></td> <td>[CLIENT_NAME]</td>
													</tr>
													<tr>
														<td><?php _e('Client email:',WL_A_P_SYSTEM); ?></td> <td>[CLIENT_EMAIL]</td>
													</tr>
													
													<tr>
														<td><?php _e('Admin Name:',WL_A_P_SYSTEM); ?></td> <td>[ADMIN_NAME]</td>
													</tr>
													<tr>
														<td><?php _e('Blog Name:',WL_A_P_SYSTEM); ?></td> <td>[BLOG_NAME]</td>
													</tr>
													<tr>
														<td> <?php _e('Site URL:',WL_A_P_SYSTEM); ?></td> <td>[SITE_URL]</td>
													</tr>
												</table>
											</div>
												<div class="col-md-12 bs-form form-group">
													<div class="col-md-3"></div>
													<div class="col-md-9">
														<button  type="button" class="btn save-link"  id='save_settings_07' onclick="return save_reminder_setting();">Save</button>
													</div>
												</div>
											</form>
										</div>
									</div>
	<!--staff Dashboard -->
	<?php
		$weblizar_aps_staff_dashboard = get_option("weblizar_aps_staff_dashboard_settings"); 
		if(!empty($weblizar_aps_staff_dashboard['staff_loc_setting'])){
			$staff_loc_setting = $weblizar_aps_staff_dashboard['staff_loc_setting'];
		}
		else{
			$staff_loc_setting = "no";
		}
		
		if(!empty($weblizar_aps_staff_dashboard['staff_calendar_setting'])){
			$staff_calendar_setting = $weblizar_aps_staff_dashboard['staff_calendar_setting'];
		}
		else{
			$staff_calendar_setting = "no";
		 }

		if(!empty($weblizar_aps_staff_dashboard['staff_service_setting'])){
		 	$staff_service_setting = $weblizar_aps_staff_dashboard['staff_service_setting'];
		 }
		else{
		 	$staff_service_setting = "no";
		 }
		if(!empty($weblizar_aps_staff_dashboard['staff_profile_setting'])){
		 	$staff_profile_setting = $weblizar_aps_staff_dashboard['staff_profile_setting'];
		 }
		else{
		 	$staff_profile_setting = "no";
		 }
		if(!empty($weblizar_aps_staff_dashboard['staff_appointment_setting'])){
			$staff_appointment_setting = $weblizar_aps_staff_dashboard['staff_appointment_setting'];
		}
		else{
			$staff_appointment_setting = "no";
		}
		if(!empty($weblizar_aps_staff_dashboard['staff_dashboard_setting'])){
			$staff_dashboard_setting = $weblizar_aps_staff_dashboard['staff_dashboard_setting'];
		}
		else{
			$staff_dashboard_setting = "no";
		}

		//sub settings
		if(!empty($weblizar_aps_staff_dashboard['loc_edit'])){
			$loc_edit = $weblizar_aps_staff_dashboard['loc_edit'];
		}		
		else{
			$loc_edit = "no";
		}
		if(!empty($weblizar_aps_staff_dashboard['calendar_edit'])){
			$calendar_edit = $weblizar_aps_staff_dashboard['calendar_edit'];
		}
		else{
			$calendar_edit = "no";
		}
		if(!empty($weblizar_aps_staff_dashboard['service_edit'])){
			$service_edit = $weblizar_aps_staff_dashboard['service_edit'];
		}
		else{
			$service_edit = "no";
		}
		if(!empty($weblizar_aps_staff_dashboard['profile_edit'])){
			$profile_edit = $weblizar_aps_staff_dashboard['profile_edit'];
		}
		else{
			$profile_edit = "no";
		}
		if(!empty($weblizar_aps_staff_dashboard['appointment_edit'])){
			$appointment_edit = $weblizar_aps_staff_dashboard['appointment_edit'];
		}
		else{
			$appointment_edit = "no";
		}
	?>
<div id="staff_dashboard" class="tab-pane fade">
		<h2> <?php _e('Staff Dashboard',WL_A_P_SYSTEM); ?></h2>
		<form style="margin-bottom: 0;" method="POST" id="ap_staff_dashboard_settings" name="ap_staff_dashboard_settings">
			<div class="panel panel-default">
				<div class="panel-heading"><label> <?php _e('Staff Location',WL_A_P_SYSTEM); ?></label></div>
				<div class="panel-body">
					<div class="col-md-12"><label> <?php _e('Show Location Tab',WL_A_P_SYSTEM); ?></label></div>
					<div class="col-md-12">
						<input onclick="loc_function(this)" type="radio" name="staff_loc_setting" value="yes" <?php if($staff_loc_setting=='yes'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Yes',WL_A_P_SYSTEM); ?>
						<input onclick="loc_function(this)" type="radio" name="staff_loc_setting" value="no" <?php if($staff_loc_setting=='no'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('No',WL_A_P_SYSTEM); ?>
						<hr>
					</div>														
					<div class="col-md-12" id="show_location_tab" style="<?php if($staff_loc_setting == 'yes') { echo "display: block";} else{ echo "display: none";} ?>">
						<div class="col-md-12"><label> <?php _e('Permission To Add & Edit Location',WL_A_P_SYSTEM); ?></label></div>
						<div class="col-md-12">											
							<?php //$weblizar_location_edit = get_option( "weblizar_aps_staff_settings" ); ?>
							<input type="radio" name="loc_edit" value="yes" <?php if($loc_edit == 'yes') { echo 'checked'; } else { echo ''; } ?>> <?php _e('Yes',WL_A_P_SYSTEM); ?>
							<input type="radio" name="loc_edit" value="no" <?php if($loc_edit == 'no') { echo 'checked'; } else { echo ''; } ?>> <?php _e('No',WL_A_P_SYSTEM); ?>										
						</div>
					</div>															
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><label> <?php _e('Staff Calendar',WL_A_P_SYSTEM); ?></label></div>
				<div class="panel-body">
					<div class="col-md-12"><label> <?php _e('Show Calendar Tab',WL_A_P_SYSTEM); ?></label></div>
					<div class="col-md-12">
						<input onclick="cal_function(this)" type="radio" name="staff_calendar_setting" value="yes" <?php if($staff_calendar_setting=='yes'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Yes',WL_A_P_SYSTEM); ?>
						<input onclick="cal_function(this)" type="radio" name="staff_calendar_setting" value="no" <?php if($staff_calendar_setting=='no'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('No',WL_A_P_SYSTEM); ?>
						<hr>
					</div>														
					<div class="col-md-12" id="show_calendar_tab" style="<?php if($staff_calendar_setting == 'yes') { echo "display: block";} else{ echo "display: none";} ?>">
						<div class="col-md-12"><label> <?php _e('Permission To Add & Edit Calendar',WL_A_P_SYSTEM); ?></label></div>
						<div class="col-md-12">																											
							<input type="radio" name="calendar_edit" value="yes" <?php if($calendar_edit == 'yes') { echo 'checked'; } else { echo ''; } ?>> <?php _e('Yes',WL_A_P_SYSTEM); ?>
							<input type="radio" name="calendar_edit" value="no" <?php if($calendar_edit == 'no') { echo 'checked'; } else { echo ''; } ?>> <?php _e('No',WL_A_P_SYSTEM); ?>										
						</div>
					</div>															
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><label> <?php _e('Staff Service',WL_A_P_SYSTEM); ?></label></div>
				<div class="panel-body">
					<div class="col-md-12"><label> <?php _e('Show Service Tab',WL_A_P_SYSTEM); ?></label></div>
					<div class="col-md-12">
						<input onclick="service_function(this)" type="radio" name="staff_service_setting" value="yes" <?php if($staff_service_setting=='yes'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Yes',WL_A_P_SYSTEM); ?>
						<input onclick="service_function(this)" type="radio" name="staff_service_setting" value="no" <?php if($staff_service_setting=='no'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('No',WL_A_P_SYSTEM); ?>
						<hr>
					</div>														
					<div class="col-md-12" id="show_service_tab" style="<?php if($staff_service_setting == 'yes') { echo "display: block";} else{ echo "display: none";} ?>">
						<div class="col-md-12"><label> <?php _e('Permission To Add & Edit Service',WL_A_P_SYSTEM); ?></label></div>
						<div class="col-md-12">																											
							<input type="radio" name="service_edit" value="yes" <?php if($service_edit == 'yes') { echo 'checked'; } else { echo ''; } ?>> <?php _e('Yes',WL_A_P_SYSTEM); ?>
							<input type="radio" name="service_edit" value="no" <?php if($service_edit == 'no') { echo 'checked'; } else { echo ''; } ?>> <?php _e('No',WL_A_P_SYSTEM); ?>
						</div>
					</div>																
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><label> <?php _e('Staff Profile',WL_A_P_SYSTEM); ?></label></div>
				<div class="panel-body">
					<div class="col-md-12"><label> <?php _e('Show Profile Tab',WL_A_P_SYSTEM); ?></label></div>
					<div class="col-md-12">
						<input onclick="profile_function(this)" type="radio" name="staff_profile_setting"  value="yes" <?php if($staff_profile_setting=='yes'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Yes',WL_A_P_SYSTEM); ?>
						<input onclick="profile_function(this)" type="radio" name="staff_profile_setting"  value="no" <?php if($staff_profile_setting=='no'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('No',WL_A_P_SYSTEM); ?>
						<hr>
					</div>														
					<div class="col-md-12" id="show_profile_tab" style="<?php if($staff_profile_setting == 'yes') { echo "display: block";} else{ echo "display: none";} ?>">
						<div class="col-md-12"><label> <?php _e('Permission To Add & Edit Profile',WL_A_P_SYSTEM); ?></label></div>
						<div class="col-md-12">																											
							<input type="radio" name="profile_edit" value="yes" <?php if($profile_edit == 'yes') { echo 'checked'; } else { echo ''; } ?>> <?php _e('Yes',WL_A_P_SYSTEM); ?>
							<input type="radio" name="profile_edit" value="no" <?php if($profile_edit == 'no') { echo 'checked'; } else { echo ''; } ?>> <?php _e('No',WL_A_P_SYSTEM); ?>										
						</div>
					</div>																
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><label> <?php _e('Staff Appointment',WL_A_P_SYSTEM); ?></label></div>
				<div class="panel-body">
					<div class="col-md-12"><label> <?php _e('Show Appointment Tab',WL_A_P_SYSTEM); ?></label></div>
					<div class="col-md-12">
						<input onclick="appointment_function(this)" type="radio" name="staff_appointment_setting" value="yes" <?php if($staff_appointment_setting=='yes'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Yes',WL_A_P_SYSTEM); ?>
						<input onclick="appointment_function(this)" type="radio" name="staff_appointment_setting" value="no" <?php if($staff_appointment_setting=='no'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('No',WL_A_P_SYSTEM); ?>
						<hr>
					</div>														
					<div class="col-md-12" id="show_appointment_tab" style="<?php if($staff_appointment_setting == 'yes') { echo "display: block";} else{ echo "display: none";} ?>">
						<div class="col-md-12"><label> <?php _e('Permission To Add & Edit Appointment',WL_A_P_SYSTEM); ?></label></div>
						<div class="col-md-12">																											
							<input type="radio" name="appointment_edit" value="yes" <?php if($appointment_edit == 'yes') { echo 'checked'; } else { echo ''; } ?>> <?php _e('Yes',WL_A_P_SYSTEM); ?>
							<input type="radio" name="appointment_edit" value="no" <?php if($appointment_edit == 'no') { echo 'checked'; } else { echo ''; } ?>> <?php _e('No',WL_A_P_SYSTEM); ?>										
						</div>
					</div>														
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><label> <?php _e('Staff Dashboard',WL_A_P_SYSTEM); ?></label></div>
				<div class="panel-body">
					<div class="col-md-12"><label> <?php _e('Show Dashboard Tab',WL_A_P_SYSTEM); ?></label></div>
					<div class="col-md-12">
						<input type="radio" name="staff_dashboard_setting" value="yes" <?php if($staff_dashboard_setting=='yes'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('Yes',WL_A_P_SYSTEM); ?>
						<input type="radio" name="staff_dashboard_setting" value="no" <?php if($staff_dashboard_setting=='no'){ echo 'checked'; } else{ echo ''; }  ?> > <?php _e('No',WL_A_P_SYSTEM); ?>
						<hr>
					</div>		
				</div>
			</div>
			<div class="col-md-12">
				<button  type="button" class="btn save-link" id='save_settings_dashboard' onclick="return save_staff_dash_setting();"><?php _e('Save',WL_A_P_SYSTEM); ?></button>
			</div>
	</form>
</div>
<!-- staff dashboard end -->
<!-- client Dashboard-->
<?php
	$client_dashboard = get_option('weblizar_aps_client_dashboard_settings');
	if(!empty($client_dashboard['client_appointment'])){
		$client_appointment = $client_dashboard['client_appointment']; 
	}
	else{
		$client_appointment = 'no';
	}
?>

<div id="client_dashboard" class="tab-pane fade">
	<h2> <?php _e('Client Dashboard',WL_A_P_SYSTEM); ?></h2>
	<form style="margin-bottom: 0;" method="POST" id="ap_client_dashboard_settings" name="ap_client_dashboard_settings">
			<div class="panel panel-default">
				<div class="panel-heading"><label> <?php _e('Client Appointment',WL_A_P_SYSTEM); ?></label></div>
				<div class="panel-body">
					<div class="col-md-12"><label> <?php _e('Show Client Appointments',WL_A_P_SYSTEM); ?></label></div>
					<div class="col-md-12">
						<input onclick="customer_function(this)" type="radio" name="client_appointment" value="yes" <?php if($client_appointment == 'yes') { echo "checked"; } ?>> <?php _e('Yes',WL_A_P_SYSTEM); ?>
						<input onclick="customer_function(this)" type="radio" name="client_appointment" value="no" <?php if($client_appointment == 'no') { echo "checked"; } ?>> <?php _e('No',WL_A_P_SYSTEM); ?>
						<hr>
					</div>																																	
				</div>
			</div>
			<div class="col-md-12">
				<button  type="button" class="btn save-link" id='save_client_settings_dashboard' onclick="return save_client_dash_setting();"><?php _e('Save',WL_A_P_SYSTEM); ?></button>
			</div>
	</form>

</div>
	<!-- gsync setting -->
	<?php
		// get google calendar saved settings
		$google_sync_settings = get_option('weblizar_ap_calendar_sync_settings');
		$google_sync_tokens = get_option('weblizar_ap_calendar_refresh_token');

		if(isset($google_sync_settings['ap_cal_google_mail'])) {
			$ap_cal_google_mail = $google_sync_settings['ap_cal_google_mail'];
		} else {
			$ap_cal_google_mail = "";
		}
		
		if(isset($google_sync_settings['ap_cal_client_id'])) {
			$ap_cal_client_id = $google_sync_settings['ap_cal_client_id'];
		} else {
			$ap_cal_client_id = "";
		}
		
		if(isset($google_sync_settings['ap_cal_secret_key'])) {
			$ap_cal_secret_key = $google_sync_settings['ap_cal_secret_key'];
		} else {
			$ap_cal_secret_key = "";
		}
		
		if(isset($google_sync_settings['ap_two_way_sync'])){
			$ap_two_way_sync = $google_sync_settings['ap_two_way_sync'];
		} else{
			$ap_two_way_sync = "no";
		}
		//saved_access_toekn,saved_refresh_token,refresh_token,access_token
		if(isset($google_sync_tokens['access_token'])){
			$saved_access_toekn = $google_sync_tokens['access_token'];
		}else{
			$saved_access_toekn = "";
		}
		if(isset($google_sync_tokens['refresh_token'])){
			$saved_refresh_token = $google_sync_tokens['refresh_token'];
		}else{
			$saved_refresh_token = "";
		}
	?>
	<div id="sync_setting" class="tab-pane fade">
			<h2> <?php _e('Google Calendar Syncronization Settings',WL_A_P_SYSTEM); ?></h2>			
			<div class="col-md-12 bussiness-form">
			<form style="margin-bottom: 0;" method="POST" id="ap_sync_settings" name="ap_sync_settings">
				<div class="row ad-ser">
					<div class="col-md-12 col-sm-12 bs-form form-group">
						<label> <?php _e('Google E-mail',WL_A_P_SYSTEM); ?></label>
						<?php ?>
						<input type="text" name="ap_cal_google_mail" id="ap_cal_google_mail" class="form-control" value="<?php echo $ap_cal_google_mail; ?>" placeholder="Google Email"/>
						<span class="validation_alert" id="ap_cal_google_mail_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
					</div>
					<div class="col-md-12 col-sm-12 bs-form form-group">
						<label> <?php _e('Google Calendar Client ID',WL_A_P_SYSTEM); ?></label>
						<?php ?>
						<input type="text" name="ap_cal_client_id" id="ap_cal_client_id" class="form-control" value="<?php echo $ap_cal_client_id; ?>" placeholder="Google App Client ID"/>
						<span class="validation_alert" id="ap_cal_client_id_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
					</div>
				</div>
				<div class="row ad-ser">
					<div class="col-md-12 col-sm-12 bs-form form-group">
						<label> <?php _e('Google Calendar Client Secret Key',WL_A_P_SYSTEM); ?></label>
						<?php ?>
						<input type="text" name="ap_cal_secret_key" id="ap_cal_secret_key" class="form-control" value="<?php echo $ap_cal_secret_key; ?>" placeholder="Google Calendar Secret Key"/>
						<span class="validation_alert" id="ap_cal_secret_key_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
					</div>
					<div class="col-md-12 col-sm-12 bs-form form-group" style="">
						<label> <?php _e('Redirect URIs',WL_A_P_SYSTEM); ?></label>
						<?php ?>
						<input type="text" readonly name="ap_redirect_uri" id="ap_redirect_uri" class="form-control" value="<?php echo get_site_url()."/wp-admin/admin.php?page=ap_system" ?>" placeholder="Redirect URIs"/>
						<span class="validation_alert" id="ap_redirect_uri_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
					</div>	
					<div class="col-md-6 col-sm-6 bs-form form-group" style="">
						<label> <?php _e('Two Way Sync',WL_A_P_SYSTEM); ?></label>
						
					</div>	
					<div class="col-md-6 col-sm-6">
						<input type="radio" id="ap_two_way_sync" name="ap_two_way_sync" value="yes" <?php if($ap_two_way_sync == 'yes') { echo 'checked'; } else { echo ''; } ?>> <?php _e('Yes',WL_A_P_SYSTEM); ?>
						&nbsp;&nbsp;<input type="radio" id="ap_two_way_sync" name="ap_two_way_sync" value="no" <?php if($ap_two_way_sync == 'no') { echo 'checked'; } else { echo ''; } ?>> <?php _e('No',WL_A_P_SYSTEM); ?>
					</div>
				</div>
				<!-- Google Connect And Status Buttons-->
				<div class="row ad-ser">
					<div class="col-md-12 col-sm-12 bs-form form-group">
						<label> <?php _e('Google Calendar Status',WL_A_P_SYSTEM); ?></label>																									
					</div>
					<?php if($saved_access_toekn && $saved_refresh_token){ ?>
						<div class="col-md-12 col-sm-12 bs-form form-group">
							<label class="btn btn-success" > <?php _e('On',WL_A_P_SYSTEM); ?></label>
							<button type="button" onclick="d_sync_google('1')" class="btn btn-danger" >Disconnect GCAL SYNC</button>
						 </div>
						<?php
						} else {
							?>
							<div class="col-md-12 col-sm-12 bs-form form-group">
								<label class="btn btn-danger"> <?php _e('Off',WL_A_P_SYSTEM); ?></label>													
							</div>
							<?php
						}
						// show this button if email + client id + secret is set
						// if($ap_cal_google_mail && $ap_cal_client_id && $ap_cal_secret_key && $saved_access_toekn =="" && $saved_refresh_token == "") {
						if(empty($saved_access_toekn) && empty($saved_refresh_token)) {
							$redirect_uri_link = get_site_url()."/wp-admin/admin.php?page=ap_system";
							$login_url = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/calendar') . '&redirect_uri=' . urlencode($redirect_uri_link ?? '') . '&response_type=code&client_id=' . $google_sync_settings['ap_cal_client_id'] ?? '' . '&access_type=offline&prompt=consent'; ?>							
						<div id="connecttogoogle" class="col-md-12 col-sm-12 bs-form form-group sync_google" >
							<label> <?php _e('Link with google',WL_A_P_SYSTEM); ?></label>
							<a class="btn btn-success" href="<?= $login_url ?>">Connect To Google Calendar</a>													
						</div> 
						<?php
						}
					?>
				</div>
				<div class="row ad-ser">												
					<div class="col-md-12">
						<button type="button" class="btn save-link" id='save_settings_sync' onclick="return save_sync_setting();"><?php _e('Save',WL_A_P_SYSTEM); ?></button>
					</div>
				</div>
			</form>
			
		</div>
	</div>


	<div id="remove" class="tab-pane fade">
		<h2> <?php _e('Remove Plugin',WL_A_P_SYSTEM); ?></h2>
		<div class="row form-group">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<a class="btn btn-info" style="padding-right:20px;padding-left:19px;" href="<?php echo plugins_url('backup-csv.php?customer=customer', __FILE__ ); ?>"> <?php _e('Customer Backup',WL_A_P_SYSTEM); ?></a>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<a class="btn btn-info" href="<?php echo plugins_url('backup-csv.php?services=services', __FILE__ ); ?>"><?php _e('Services Backup ',WL_A_P_SYSTEM); ?></a>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<a class="btn btn-info" href="<?php echo plugins_url('backup-csv.php?payments=payments', __FILE__ ); ?>"><?php _e('Payments  Backup ',WL_A_P_SYSTEM); ?></a>
			</div>
		</div>
		
		<div class="row form-group">
			<div class="col-md-4 col-sm-12 col-xs-12">
		    	<a class="btn btn-info" href="<?php echo plugins_url('backup-csv.php?appoinment=appoinment', __FILE__ ); ?>"> <?php _e('Appoinment Backup',WL_A_P_SYSTEM); ?></a>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<a class="btn btn-info" style="padding-right:25px;padding-left:25px;" href="<?php echo plugins_url('backup-csv.php?staff=staff', __FILE__ ); ?>"><?php _e('Staff Backup',WL_A_P_SYSTEM); ?></a>
			
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<a style="padding-right:15px;padding-left:15px;" class="btn btn-info" href="<?php echo plugins_url('backup-csv.php?coupons=coupons', __FILE__ ); ?>"><?php _e('Coupons Backup',WL_A_P_SYSTEM); ?></a>
			</div>
		</div>
		<div class="col-md-12 remove-form">
			<div class="alert alert-error" style="width:95%;">
					<h3><?php _e('Remove Appointment Scheduler Pro Plugin',WL_A_P_SYSTEM); ?></h3>
					<p><?php _e('This operation wiil delete all Appointment Scheduler Pro data &amp; settings. If you continue, You will not be able to retrieve or restore your appointments entries.',WL_A_P_SYSTEM); ?></p>
					<button  type="button" class="btn btn-danger" id='uninstallapcal'name="uninstallapcal" onclick="return remove_plugin_setting();"><i class="fas fa-trash-o" aria-hidden="true"></i><?php _e(' REMOVE PLUGIN',WL_A_P_SYSTEM); ?></button>
					<div id="remove_plugin_div"></div>
			</div>
		</div>
	</div>
							</div>
						</div>
					</div>
				</div>