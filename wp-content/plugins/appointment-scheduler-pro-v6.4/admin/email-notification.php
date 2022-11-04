<script>
//EMAIL NOTIFICATION- TEST MAIL
function save_notification()
     {	  
		emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		}
	
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_pending" ).show();
					jQuery( "#send_mail_client_pending" ).show();
					jQuery( "#send_mail_preview_client_pending" ).hide();
					jQuery("#save_email_notification").prop('disabled', true);
		jQuery('#save_email_notification').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		 
        jQuery.ajax({
		url: location.href,
		type: "POST",
		data: jQuery("form#notification_form").serialize(),
		dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#save_email_notification").prop('disabled', false);
			jQuery('#save_email_notification').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			jQuery.notify("Data Inserted Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			
			jQuery("#send_notification_client_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_client_approval").css("border","1px solid #b4b9be");
			jQuery("#send_notification_client_cancel").css("border","1px solid #b4b9be");
			
			jQuery("#send_notification_staff_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_staff_approval").css("border","1px solid #b4b9be");
			jQuery("#send_notification_staff_cancel").css("border","1px solid #b4b9be");
			
			jQuery("#send_notification_admin_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_admin_approved").css("border","1px solid #b4b9be");
			jQuery("#send_notification_admin_cancelled").css("border","1px solid #b4b9be");
		}
	});	
				}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_pending" ).show();
					jQuery( "#send_mail_client_pending" ).show();
					jQuery( "#send_mail_preview_client_pending" ).hide();
					jQuery("#save_email_notification").prop('disabled', true);
		jQuery('#save_email_notification').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		 
        jQuery.ajax({
		url: location.href,
		type: "POST",
		data: jQuery("form#notification_form").serialize(),
		dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#save_email_notification").prop('disabled', false);
			jQuery('#save_email_notification').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			jQuery.notify("Data Inserted Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			
			jQuery("#send_notification_client_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_client_approval").css("border","1px solid #b4b9be");
			jQuery("#send_notification_client_cancel").css("border","1px solid #b4b9be");
			
			jQuery("#send_notification_staff_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_staff_approval").css("border","1px solid #b4b9be");
			jQuery("#send_notification_staff_cancel").css("border","1px solid #b4b9be");
			
			jQuery("#send_notification_admin_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_admin_approved").css("border","1px solid #b4b9be");
			jQuery("#send_notification_admin_cancelled").css("border","1px solid #b4b9be");
		}
	});	
				}		
		}	
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
			if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_pending" ).show();
					jQuery( "#send_mail_client_pending" ).show();
					jQuery( "#send_mail_preview_client_pending" ).hide();
					jQuery("#save_email_notification").prop('disabled', true);
		jQuery('#save_email_notification').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
		 
        jQuery.ajax({
		url: location.href,
		type: "POST",
		data: jQuery("form#notification_form").serialize(),
		dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#save_email_notification").prop('disabled', false);
			jQuery('#save_email_notification').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			jQuery.notify("Data Inserted Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			
			jQuery("#send_notification_client_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_client_approval").css("border","1px solid #b4b9be");
			jQuery("#send_notification_client_cancel").css("border","1px solid #b4b9be");
			
			jQuery("#send_notification_staff_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_staff_approval").css("border","1px solid #b4b9be");
			jQuery("#send_notification_staff_cancel").css("border","1px solid #b4b9be");
			
			jQuery("#send_notification_admin_pending").css("border","1px solid #b4b9be");
			jQuery("#send_notification_admin_approved").css("border","1px solid #b4b9be");
			jQuery("#send_notification_admin_cancelled").css("border","1px solid #b4b9be");
		}
	});	
					}
		}		
			
  }
  else
	{
		jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
	}
		
}
function client_notification_pending() {
	if (document.getElementById('send_notification_client_pending').checked) {
		var preview_mail_client_pending= jQuery('#send_client_email_pending').val();
		var send_mail_client_pending= jQuery('#send_mail_client_pending').val('send_mail_client_pending');
		if(preview_mail_client_pending == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_client_email_pending_alert").show();
			jQuery("#send_client_email_pending").focus();
			return false;
		}
		 jQuery.ajax({
			url: location.href,
			type: "POST",
			data :  'preview_mail_client_pending='+ preview_mail_client_pending + '&send_mail_client_pending='+ send_mail_client_pending ,
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				//alert("Mail Sent Successfully");
				jQuery.notify("<?php _e('Mail Sent Successfully',WL_A_P_SYSTEM); ?>",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});  
	}
	else{
		
		jQuery.notify("<?php _e('Save Notification Checkbox',WL_A_P_SYSTEM); ?>", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		jQuery("#send_notification_client_pending").css("border","1px solid #ec0505");
	}
}
function client_notification_approved() {
	
	if (document.getElementById('send_notification_client_approval').checked) {
		var preview_mail_client_approval= jQuery('#send_client_email_approval').val();
		if(preview_mail_client_approval == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_client_email_approv_alert").show();
			jQuery("#send_client_email_approval").focus();
			return false;
		}
		var send_mail_client_approved= jQuery('#send_mail_client_approved').val('send_mail_client_approved');
		
		jQuery.ajax({
			url: location.href,
			type: "POST",
			data :  'preview_mail_client_approval='+ preview_mail_client_approval + '&send_mail_client_approved='+ send_mail_client_approved ,
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery.notify("<?php _e('Mail Sent Successfully',WL_A_P_SYSTEM); ?>",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});
	}
	else{
			jQuery.notify("<?php _e('Save Notification Checkbox',WL_A_P_SYSTEM); ?>", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
			jQuery("#send_notification_client_approval").css("border","1px solid #ec0505");
	}
	
}
function client_notification_cancel() {
	if (document.getElementById('send_notification_client_cancel').checked) {
	
		var preview_mail_client_cancel= jQuery('#send_client_email_cancel').val();
		var send_mail_client_cancel= jQuery('#send_mail_client_cancel').val('send_mail_client_cancel');
		if(preview_mail_client_cancel == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_client_email_cancel_alert").show();
			jQuery("#send_client_email_cancel").focus();
			return false;
		}
		 jQuery.ajax({
		  url: location.href,
		  type: "POST",
		data :  'preview_mail_client_cancel='+ preview_mail_client_cancel + '&send_mail_client_cancel='+ send_mail_client_cancel ,
		  dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery.notify("Mail Sent Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});
	}
	else{
		jQuery.notify(" Save Notification Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		jQuery("#send_notification_client_cancel").css("border","1px solid #ec0505");
	}
	
}
function staff_notification_pending() {
	if (document.getElementById('send_notification_staff_pending').checked) {
	
		var preview_mail_staff_pending= jQuery('#send_staff_email_pending').val();
		var send_mail_staff_pending= jQuery('#send_mail_staff_pending').val('send_mail_staff_pending');
		if(preview_mail_staff_pending == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_staff_email_pending_alert").show();
			jQuery("#send_staff_email_pending").focus();
			return false;
		}
		
		jQuery.ajax({
			url: location.href,
			type: "POST",
			data :  'preview_mail_staff_pending='+ preview_mail_staff_pending + '&send_mail_staff_pending='+ send_mail_staff_pending ,
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery.notify("Mail Sent Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});
	}
	else{
		jQuery.notify(" Save Notification Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		jQuery("#send_notification_staff_pending").css("border","1px solid #ec0505");
	}
	
}
function staff_notification_approved() {
	if (document.getElementById('send_notification_staff_approval').checked) {
		var preview_mail_staff_approval= jQuery('#send_staff_email_approved').val();
		var send_mail_staff_approved= jQuery('#send_mail_staff_approved').val('send_mail_staff_approved');
		if(preview_mail_staff_approval == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_staff_email_approv_alert").show();
			jQuery("#send_staff_email_approved").focus();
			return false;
		}
		jQuery.ajax({
			url: location.href,
			type: "POST",
			data :  'preview_mail_staff_approval='+ preview_mail_staff_approval + '&send_mail_staff_approved='+ send_mail_staff_approved ,
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery.notify("Mail Sent Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});
	}
	else{
		jQuery.notify(" Save Notification Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		jQuery("#send_notification_staff_approval").css("border","1px solid #ec0505");
	}
	
}
function staff_notification_cancel() {
	if (document.getElementById('send_notification_staff_cancel').checked) {	
		var preview_mail_staff_cancel= jQuery('#send_staff_email_cancel').val();
		var send_mail_staff_cancel= jQuery('#send_mail_staff_cancel').val('send_mail_staff_cancel');
		if(preview_mail_staff_cancel == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_staff_email_cancel_alert").show();
			jQuery("#send_staff_email_cancel").focus();
			return false;
		}
		jQuery.ajax({
			url: location.href,
			type: "POST",
			data :  'preview_mail_staff_cancel='+ preview_mail_staff_cancel + '&send_mail_staff_cancel='+ send_mail_staff_cancel ,
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery.notify("Mail Sent Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});
	}
	else{
		jQuery.notify(" Save Notification Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		jQuery("#send_notification_staff_cancel").css("border","1px solid #ec0505");
	}
	
}
function admin_notification_pending() {
	if (document.getElementById('send_notification_admin_pending').checked) {	
		var preview_mail_admin_pending= jQuery('#send_admin_email_pending').val();
		var send_mail_admin_pending= jQuery('#send_mail_admin_pending').val('send_mail_admin_pending');
		if(preview_mail_admin_pending == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_admin_email_pending_alert").show();
			jQuery("#send_admin_email_pending").focus();
			return false;
		}
		jQuery.ajax({
			url: location.href,
			type: "POST",
			data :  'preview_mail_admin_pending='+ preview_mail_admin_pending + '&send_mail_admin_pending='+ send_mail_admin_pending ,
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery.notify("Mail Sent Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});
	}
	else{
		jQuery.notify(" Save Notification Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		jQuery("#send_notification_admin_pending").css("border","1px solid #ec0505");
	}
	
}
function admin_notification_approved() {
	if (document.getElementById('send_notification_admin_approved').checked) {	
		var preview_mail_admin_approved= jQuery('#send_admin_email_approval').val();
		var send_mail_admin_approved= jQuery('#send_mail_admin_approved').val('send_mail_admin_approved');
		if(preview_mail_admin_approved == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_admin_email_approv_alert").show();
			jQuery("#send_admin_email_approval").focus();
			return false;
		}
		jQuery.ajax({
			url: location.href,
			type: "POST",
			data :  'preview_mail_admin_approved='+ preview_mail_admin_approved + '&send_mail_admin_approved='+ send_mail_admin_approved ,
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery.notify("Mail Sent Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});
	}
	else{
		jQuery.notify(" Save Notification Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		jQuery("#send_notification_admin_approved").css("border","1px solid #ec0505");
	}
	
}
function admin_notification_cancelled() {
	if (document.getElementById('send_notification_admin_cancelled').checked) {
		var preview_mail_admin_cancelled= jQuery('#send_admin_email_cancel').val();
		var send_mail_admin_cancel= jQuery('#send_mail_admin_cancel').val('send_mail_admin_cancel');
		if(preview_mail_admin_cancelled == ""){
			jQuery(".validation_alert").hide(); 
			jQuery("#send_admin_email_cancel_alert").show();
			jQuery("#send_admin_email_cancel").focus();
			return false;
		}
		jQuery.ajax({
			url: location.href,
			type: "POST",
			data :  'preview_mail_admin_cancelled='+ preview_mail_admin_cancelled + '&send_mail_admin_cancel='+ send_mail_admin_cancel ,
			dataType: "html",
			//Do not cache the page
			cache: false,
			//success
			success: function (html) {
				jQuery.notify("Mail Sent Successfully",{type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			}
		});
	}
	else{
		jQuery.notify(" Save Notification Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		jQuery("#send_notification_admin_cancelled").css("border","1px solid #ec0505");
	}
	
}
function client_pending() {
	emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		}
	
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_pending" ).show();
					jQuery( "#send_mail_client_pending" ).show();
					jQuery( "#send_mail_preview_client_pending" ).hide();
				}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_pending" ).show();
					jQuery( "#send_mail_client_pending" ).show();
					jQuery( "#send_mail_preview_client_pending" ).hide();
				}		
		}
		
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
			if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_pending" ).show();
					jQuery( "#send_mail_client_pending" ).show();
					jQuery( "#send_mail_preview_client_pending" ).hide();
					}
		}
		
		}else{
			jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
	}
}
	
function client_approval() {
	//emailtype=document.getElementById("emailtype").value;
	emailtype = jQuery("#emailtype").val();
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		}
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_approval" ).show();
					jQuery( "#send_mail_client_approval" ).show();
					jQuery( "#send_mail_preview_client_approval" ).hide();
				}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger",icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_approval" ).show();
					jQuery( "#send_mail_client_approval" ).show();
					jQuery( "#send_mail_preview_client_approval" ).hide();
				}		
		}
		
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
				if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_approval" ).show();
					jQuery( "#send_mail_client_approval" ).show();
					jQuery( "#send_mail_preview_client_approval" ).hide();
				}	
		}
		
		}else{
		jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		
	}
}
function client_cancel() {
	emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		}
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_cancel" ).show();
					jQuery( "#send_mail_client_cancel" ).show();
					jQuery( "#send_mail_preview_client_cancel" ).hide();
					
				}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_cancel" ).show();
					jQuery( "#send_mail_client_cancel" ).show();
					jQuery( "#send_mail_preview_client_cancel" ).hide();
				}		
		}
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
				if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_client_cancel" ).show();
					jQuery( "#send_mail_client_cancel" ).show();
					jQuery( "#send_mail_preview_client_cancel" ).hide();
					}
				
		}
		
		}else{
			jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
	}
	
}
function staff_pending() {
	emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		}
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_pending" ).show();
					jQuery( "#send_mail_staff_pending" ).show();
					jQuery( "#send_mail_preview_staff_pending" ).hide();
					}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_pending" ).show();
					jQuery( "#send_mail_staff_pending" ).show();
					jQuery( "#send_mail_preview_staff_pending" ).hide();
					}		
		}
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
				if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_pending" ).show();
					jQuery( "#send_mail_staff_pending" ).show();
					jQuery( "#send_mail_preview_staff_pending" ).hide();
					}
			}
		}else{
		jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
	}
}
function staff_approval() {
	emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		}
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_approval" ).show();
					jQuery( "#send_mail_staff_approval" ).show();
					jQuery( "#send_mail_preview_staff_approval" ).hide();
					}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_approval" ).show();
					jQuery( "#send_mail_staff_approval" ).show();
					jQuery( "#send_mail_preview_staff_approval" ).hide();
					}		
		}
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
				if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_approval" ).show();
					jQuery( "#send_mail_staff_approval" ).show();
					jQuery( "#send_mail_preview_staff_approval" ).hide();
					}
			}
		}else{
			jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
	}
	
}
function staff_cancel() {
	emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		}
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_cancel" ).show();
					jQuery( "#send_mail_staff_cancel" ).show();
					jQuery( "#send_mail_preview_staff_cancel" ).hide();
					}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_cancel" ).show();
					jQuery( "#send_mail_staff_cancel" ).show();
					jQuery( "#send_mail_preview_staff_cancel" ).hide();
					}		
		}
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
				if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_staff_cancel" ).show();
					jQuery( "#send_mail_staff_cancel" ).show();
					jQuery( "#send_mail_preview_staff_cancel" ).hide();
					}
				}
		}else{
		jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		
	}
	
}
function admin_pending() {
	emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		}
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
					
				}else{
						jQuery( "#preview_mail_admin_pending" ).show();
						jQuery( "#send_mail_admin_pending" ).show();
						jQuery( "#send_mail_preview_admin_pending" ).hide();
						}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				}else{
					jQuery( "#preview_mail_admin_pending" ).show();
					jQuery( "#send_mail_admin_pending" ).show();
					jQuery( "#send_mail_preview_admin_pending" ).hide();
					}		
		}
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
				if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
					
				}else{
					jQuery( "#preview_mail_admin_pending" ).show();
					jQuery( "#send_mail_admin_pending" ).show();
					jQuery( "#send_mail_preview_admin_pending" ).hide();
					}
				}
		}else{
			jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		
	}
					
		
}
function admin_approved() {
	emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
			
		}
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
					
				}else{
					jQuery( "#preview_mail_admin_approved" ).show();
					jQuery( "#send_mail_admin_approved" ).show();
					jQuery( "#send_mail_preview_admin_approved" ).hide();
					}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
					
				}else{
					jQuery( "#preview_mail_admin_approved" ).show();
					jQuery( "#send_mail_admin_approved" ).show();
					jQuery( "#send_mail_preview_admin_approved" ).hide();
					}		
		}
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
				if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger",icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
					
				}else{
					jQuery( "#preview_mail_admin_approved" ).show();
					jQuery( "#send_mail_admin_approved" ).show();
					jQuery( "#send_mail_preview_admin_approved" ).hide();
					}
				}
		}else{
			jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		
	}
	
}
function admin_cancelled() {
	emailtype=document.getElementById("emailtype").value;
	if(jQuery('#enable').is(':checked')) {
		if(emailtype=="default"){
			jQuery.notify(" Select Email Type", {type:"danger", icon:"warning",  align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
			
		}
		if(emailtype=="wpmail"){
			wpemail=document.getElementById("wpemail").value;
				if(wpemail==""){
					jQuery.notify(" Enter Wp Email", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
				
				}else{
					jQuery( "#preview_mail_admin_cancelled" ).show();
					jQuery( "#send_mail_admin_cancelled" ).show();
					jQuery( "#send_mail_preview_admin_cancelled" ).hide();
					}	
		}
		
		if(emailtype=="phpmail"){
			phpemail=document.getElementById("phpemail").value;
				if(phpemail==""){
					jQuery.notify(" Enter Php Email", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
					
				}else{
					jQuery( "#preview_mail_admin_cancelled" ).show();
					jQuery( "#send_mail_admin_cancelled" ).show();
					jQuery( "#send_mail_preview_admin_cancelled" ).hide();
					}		
		}
		
		if(emailtype=="smtp"){
			hostname=document.getElementById("hostname").value;
			portno=document.getElementById("portno").value;
			smtpemail=document.getElementById("smtpemail").value;
			password=document.getElementById("password").value;
				if(hostname=="" || portno=="" || smtpemail=="" || password==""){
					jQuery.notify(" Enter SMTP Fields", {type:"danger",  icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
					
				}else{
					jQuery( "#preview_mail_admin_cancelled" ).show();
					jQuery( "#send_mail_admin_cancelled" ).show();
					jQuery( "#send_mail_preview_admin_cancelled" ).hide();
					}
				}
		}else{
			jQuery.notify(" Enable Email Checkbox", {type:"danger", icon:"warning", align:"center", verticalAlign:"middle", blur: 0.8, delay: 0});
		
	}
	
}
</script>
<?php
//SAVE EMAIL DETAILS
global $wpdb;
if(isset($_REQUEST['emailtype']))
{
    //$enable = sanitize_text_field( $_REQUEST['enable'] );
	if(isset($_REQUEST["enable"])){
		$enable = ( $_REQUEST['enable'] );
	}else{
		$enable = "";
	}
    $emailtype = ( $_REQUEST['emailtype'] );
	if($emailtype=='wpmail'){
		$wpemail = ( $_REQUEST['wpemail'] );
	}
	else{
		$wpemail	=	'';
	}
	
	
	if($emailtype=='phpmail'){
		$phpemail = ( $_REQUEST['phpemail'] );
	}
	else{
		$phpemail	=	'';
	}
	if($emailtype=='smtp'){
		$hostname = ( $_REQUEST['hostname'] );
		$portno = ( $_REQUEST['portno'] );
		$smtpemail = ( $_REQUEST['smtpemail'] );
		$password = ( $_REQUEST['password'] );
	}
    else{
		$hostname	=	'';
		$portno		=	'';
		$smtpemail	=	'';
		$password	=	'';
	}
   
	if(isset($_REQUEST["send_notification_client_pending"])){
		$send_notification_client_pending = ( $_REQUEST['send_notification_client_pending'] );
	}
	else{
		$send_notification_client_pending = "";
	}
		$subject_notification_client_pending = ( $_REQUEST['subject_notification_client_pending'] );
		$body_notification_client_pending = ( $_REQUEST['body_notification_client_pending'] );
		
	 if(isset($_REQUEST["send_notification_client_approval"])){
		$send_notification_client_approval = ( $_REQUEST['send_notification_client_approval'] );
	}
	else{
		$send_notification_client_approval = "";
	}
		$subject_notification_client_approval = ( $_REQUEST['subject_notification_client_approval'] );
		$body_notification_client_approval = ( $_REQUEST['body_notification_client_approval'] );
	 if(isset($_REQUEST["send_notification_client_cancel"])){
		$send_notification_client_cancel = ( $_REQUEST['send_notification_client_cancel'] );
	}
	else{
		$send_notification_client_cancel = "";
	}
		$subject_notification_client_cancel = ( $_REQUEST['subject_notification_client_cancel'] );
		$body_notification_client_cancel = ( $_REQUEST['body_notification_client_cancel'] );
     if(isset($_REQUEST["send_notification_staff_pending"])){
		$send_notification_staff_pending = ( $_REQUEST['send_notification_staff_pending'] );
	}
	else{
		$send_notification_staff_pending = "";
	}
		$subject_notification_staff_pending = ( $_REQUEST['subject_notification_staff_pending'] );
		$body_notification_staff_pending = ( $_REQUEST['body_notification_staff_pending'] );
	if(isset($_REQUEST["send_notification_staff_approval"])){
		$send_notification_staff_approval = ( $_REQUEST['send_notification_staff_approval'] );
	}
	else{
		$send_notification_staff_approval = "";
	}
		$subject_notification_staff_approval = ( $_REQUEST['subject_notification_staff_approval'] );
		$body_notification_staff_approval = ( $_REQUEST['body_notification_staff_approval'] );
	if(isset($_REQUEST["send_notification_staff_cancel"])){
		$send_notification_staff_cancel = ( $_REQUEST['send_notification_staff_cancel'] );
	}
	else{
		$send_notification_staff_cancel = "";
	}
		$subject_notification_staff_cancel = ( $_REQUEST['subject_notification_staff_cancel'] );
		$body_notification_staff_cancel = ( $_REQUEST['body_notification_staff_cancel'] );
	if(isset($_REQUEST["send_notification_admin_pending"])){
		$send_notification_admin_pending = ( $_REQUEST['send_notification_admin_pending'] );
	}
	else{
		$send_notification_admin_pending = "";
	}
		$subject_admin_pending = ( $_REQUEST['subject_admin_pending'] );
		$admin_body_pending = ( $_REQUEST['admin_body_pending'] );
    if(isset($_REQUEST["send_notification_admin_approved"])){
		$send_notification_admin_approved = ( $_REQUEST['send_notification_admin_approved'] );
	}
	else{
		$send_notification_admin_approved = "";
	}
		$subject_admin_approved = ( $_REQUEST['subject_admin_approved'] );
		$admin_body_approved = ( $_REQUEST['admin_body_approved'] );
	if(isset($_REQUEST["send_notification_admin_cancelled"])){
		$send_notification_admin_cancelled = ( $_REQUEST['send_notification_admin_cancelled'] );
	 }
	 else{
		$send_notification_admin_cancelled = "";
	}
		$subject_admin_cancelled = ( $_REQUEST['subject_admin_cancelled'] );
		$admin_body_cancelled = ( $_REQUEST['admin_body_cancelled'] );
	
	
	$Appoint_settings = array(
		'enable' => $enable, 
		 'emailtype' => $emailtype,
		  'wpemail' => $wpemail,
		  'phpemail' => $phpemail,
		  'hostname' => $hostname,
		  'portno' => $portno,
		  'smtpemail' => $smtpemail,
		  'password' => $password,  
		  'send_notification_client_pending' => 			$send_notification_client_pending, 
		  'subject_notification_client_pending' => 		$subject_notification_client_pending,
		  'body_notification_client_pending' => 			$body_notification_client_pending,
		  'send_notification_client_approval' => 			$send_notification_client_approval, 
		  'subject_notification_client_approval' => $subject_notification_client_approval, 
		  'body_notification_client_approval' => $body_notification_client_approval,
		  'send_notification_client_cancel' => $send_notification_client_cancel, 
		  'subject_notification_client_cancel' => $subject_notification_client_cancel, 
		  'body_notification_client_cancel' => $body_notification_client_cancel,
		  'send_notification_staff_pending' => $send_notification_staff_pending, 
		  'subject_notification_staff_pending' => $subject_notification_staff_pending, 
		  'body_notification_staff_pending' => $body_notification_staff_pending, 
		  'send_notification_staff_approval' => $send_notification_staff_approval, 
		  'subject_notification_staff_approval' => $subject_notification_staff_approval, 
		  'body_notification_staff_approval' => $body_notification_staff_approval, 
		  'send_notification_staff_cancel' => $send_notification_staff_cancel, 
		  'subject_notification_staff_cancel' => $subject_notification_staff_cancel, 
		  'body_notification_staff_cancel' => $body_notification_staff_cancel, 
		  'send_notification_admin_pending' => $send_notification_admin_pending, 
		  'subject_admin_pending' => $subject_admin_pending, 
		  'admin_body_pending' => $admin_body_pending, 
		  'send_notification_admin_approved' => $send_notification_admin_approved, 
		  'subject_admin_approved' => $subject_admin_approved, 
		  'admin_body_approved' => $admin_body_approved, 
		  'send_notification_admin_cancelled' => $send_notification_admin_cancelled, 
		  'subject_admin_cancelled' => $subject_admin_cancelled, 
		  'admin_body_cancelled' => $admin_body_cancelled,
	);
	update_option("Appoint_notification", $Appoint_settings);
}
?>
<?php
$email_settings= get_option("Appoint_notification");
if ($email_settings != null) {
	$enable = $email_settings['enable'];
}
?>
<div class="panel panel-default">
				<div class="panel-heading"><i class="fas fa-envelope"></i><span class="panel_heading"><?php _e('Email Notification',WL_A_P_SYSTEM); ?></span></div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST"  name="notification_form" id="notification_form" novalidate>
							<div class="note-form">
								<div class="row ap-note1 form-group">
									<div class="col-md-4">
										<label> <?php _e('Enable',WL_A_P_SYSTEM); ?> </label>
										<?php $enable = $email_settings['enable'];?>
										<input id="enable" type="checkbox"  name="enable" class="sl-select" value="yes" <?php  if($enable=='yes'){ echo 'checked'; } else{ echo ''; } ?>  />
									</div>
								</div>
								<div class="row ap-note1 form-group">
									<div class="col-md-3">
										<label> <?php _e('Email Type',WL_A_P_SYSTEM); ?></label>
									</div>
									<div class="col-md-5">
										<?php $emailtype= $email_settings['emailtype'];?>
										<select class="form-control" name="emailtype" id="emailtype">
											<option value="default" selected="selected"> <?php _e('SELECT MAIL',WL_A_P_SYSTEM); ?></option>
											<option value="wpmail" <?php if($emailtype == 'wpmail') { echo 'selected'; } else { echo ''; } ?>> <?php _e('WP Mail',WL_A_P_SYSTEM); ?></option>
											<option value="phpmail" <?php if($emailtype == 'phpmail') { echo 'selected'; } else { echo ''; } ?>> <?php _e('PHP Mail',WL_A_P_SYSTEM); ?></option>
											<option value="smtp" <?php if($emailtype == 'smtp') { echo 'selected'; } else { echo ''; } ?>> <?php _e('SMTP Mail',WL_A_P_SYSTEM); ?></option>
										<select>
									</div>
								</div>
								<div class="ap-note phpmail form-group">
									<h2> <?php _e('PHP Mail',WL_A_P_SYSTEM); ?></h2>
									<div class="row">
										<div class="col-md-3">
											<label> <?php _e('Email-Id',WL_A_P_SYSTEM); ?></label>
										</div>
										<div class="col-md-5">
												<?php $phpemail= $email_settings['phpemail'];?>
											<input type="text" class="form-control" id="phpemail" name="phpemail" placeholder="Email Id" value="<?php echo esc_attr($phpemail); ?>" />
											<span  class="validation_alert" id="phpemail_empty_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
										</div>
									</div>
								</div>
								<div class="ap-note wpmail form-group">
									<h2> <?php _e('WP Mail',WL_A_P_SYSTEM); ?></h2>
									<div class="row">
										<div class="col-md-3">
											<label> <?php _e('Email-Id',WL_A_P_SYSTEM); ?></label>
										</div>
										<div class="col-md-5">
											<?php $wpemail= $email_settings['wpemail'];?>
											<input type="text" class="form-control" id="wpemail" name="wpemail" placeholder="Email Id" value="<?php echo esc_attr($wpemail);  ?>" />
											<span  class="validation_alert" id="wpemail_empty_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
										</div>
									</div>
								</div>
								<div class="ap-note smtp form-group">
									<h2> <?php _e('SMTP Mail',WL_A_P_SYSTEM); ?></h2>
									<div class="row">
										<div class="col-md-6">
											<label> <?php _e('Host Name',WL_A_P_SYSTEM); ?></label>
											<?php $hostname= $email_settings['hostname'];?>
											<input type="text" class="form-control" name="hostname" placeholder="Host Name" id="hostname" value="<?php echo esc_attr($hostname);  ?>" />
										</div>
										<div class="col-md-6">
											<label> <?php _e('Port No.',WL_A_P_SYSTEM); ?></label>
											<?php $portno= $email_settings['portno'];?>
											<input type="text" class="form-control" id="portno" name="portno" placeholder="Port No" value="<?php echo esc_attr($portno);  ?>" />
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<label> <?php _e('Email-Id',WL_A_P_SYSTEM); ?></label>
											<?php $smtpemail= $email_settings['smtpemail'];?>
											<input type="email" class="form-control" id="smtpemail" name="smtpemail" placeholder="Email Id" value="<?php echo esc_attr($smtpemail);  ?>"/>
											<span  class="validation_alert" id="smtpemail_empty_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
										</div>
										<div class="col-md-6">
											<label> <?php _e('Password',WL_A_P_SYSTEM); ?></label>
											<?php $password= $email_settings['password'];?>
											<input type="password" id="password" class="form-control" name="password" placeholder="Password" value="<?php echo esc_attr($password);  ?>" />
										</div>
									</div>
								</div>
							</div>
							<h3 class="c_n_t"> <?php _e('Customer Notification',WL_A_P_SYSTEM); ?></h3>
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
									<?php $send_notification_client_pending= $email_settings['send_notification_client_pending'];?>
										<input type="checkbox" id="send_notification_client_pending" name="send_notification_client_pending" class="sl-services" value="yes" <?php  if($send_notification_client_pending=='yes'){ echo 'checked'; } else{ echo ''; } ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#customer1">
											<div class="ser-name">
												  <?php _e('Notification to customer about pending appointment',WL_A_P_SYSTEM); ?>
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								   
									<div id="customer1" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label>  <?php _e('Subject:',WL_A_P_SYSTEM); ?></label>
															<?php $subject_notification_client_pending= $email_settings['subject_notification_client_pending'];?>
														<input type="text" name="subject_notification_client_pending" id="subject_notification_client_pending" class="form-control" placeholder="Subject" value="<?php echo esc_attr($subject_notification_client_pending);  ?>" />
													</div>
													<div class="row form-group">
														<label> <?php _e('Message:',WL_A_P_SYSTEM); ?> </label>
														<?php $body_notification_client_pending= $email_settings['body_notification_client_pending'];?>
														<textarea name="body_notification_client_pending" class="form-control" rows="8" placeholder="Message Body" id="body_notification_client_pending"><?php echo esc_attr($body_notification_client_pending);  ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_client_pending" class="btn save-link" onclick="client_pending()"> <?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_client_pending" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?> </label>
														<input name="preview_mail_client_pending" id="send_client_email_pending" required="required" placeholder="Enter Email Address" type="text" >												
														<span class="validation_alert" id="send_client_email_pending_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>
													</div>
													<div class="row form-group" >
														<button type="button" name="send_mail_client_pending" id="send_mail_client_pending" style="display:none" class="btn-primary" onclick="client_notification_pending()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
														
													</div>
												</div>
												
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
										<?php $send_notification_client_approval= $email_settings['send_notification_client_approval'];?>
										<input type="checkbox" name="send_notification_client_approval" id="send_notification_client_approval" class="sl-services" value="yes" <?php if($send_notification_client_approval=='yes'){ echo 'checked'; } else{ echo ''; }  ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#customer2">
											<div class="ser-name">
												  <?php _e('Notification to customer about Approved appointment',WL_A_P_SYSTEM); ?> 
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								    <div id="customer2" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label> <?php _e('Subject:',WL_A_P_SYSTEM); ?> </label>
														<?php $subject_notification_client_approval= $email_settings['subject_notification_client_approval'];?>
														<input type="text" name="subject_notification_client_approval" id="subject_notification_client_approval" class="form-control" placeholder="Subject" value="<?php echo esc_attr($subject_notification_client_approval);  ?>" />
													</div>
													<div class="row form-group">
														<label> <?php _e('Message:',WL_A_P_SYSTEM); ?> </label>
														<?php $body_notification_client_approval= $email_settings['body_notification_client_approval'];?>
														<textarea name="body_notification_client_approval" id="body_notification_client_approval" class="form-control" rows="8" placeholder="Message Body"><?php echo esc_attr($body_notification_client_approval); ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_client_approval" class="btn save-link" onclick="client_approval()"><?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_client_approval" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?></label>
													<input name="preview_mail_client_approval" id="send_client_email_approval" required="required" placeholder="Enter Email Address" type="text">
													<span class="validation_alert" id="send_client_email_approv_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>												
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_client_approved" id="send_mail_client_approval" style="display:none" class="btn btn-primary" onclick="client_notification_approved()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
														
													</div>
												</div>
												
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> 	
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
										<?php $send_notification_client_cancel= $email_settings['send_notification_client_cancel'];?>
										<input type="checkbox" name="send_notification_client_cancel" id="send_notification_client_cancel" class="sl-services" value="yes" <?php if($send_notification_client_cancel=='yes'){ echo 'checked'; } else{ echo ''; }  ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#customer3">
											<div class="ser-name">
												  <?php _e('Notification to Customer about Cancel appointment',WL_A_P_SYSTEM); ?>
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								    <div id="customer3" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label>  <?php _e('Subject:',WL_A_P_SYSTEM); ?></label>
														<?php $subject_notification_client_cancel= $email_settings['subject_notification_client_cancel'];?>
														<input type="text" id="subject_notification_client_cancel" name="subject_notification_client_cancel" class="form-control" placeholder="Subject" value="<?php echo esc_attr($subject_notification_client_cancel);  ?>" />
													</div>
													<div class="row form-group">
														<label>  <?php _e('Message:',WL_A_P_SYSTEM); ?></label>
														<?php $body_notification_client_cancel= $email_settings['body_notification_client_cancel'];?>
														<textarea id="body_notification_client_cancel" name="body_notification_client_cancel" class="form-control" rows="8" placeholder="Subject"><?php echo esc_attr($body_notification_client_cancel);  ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_client_cancel" class="btn save-link" onclick="client_cancel()"> <?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_client_cancel" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?> </label>
														<input name="preview_mail_client_cancel"  id="send_client_email_cancel" required="required" placeholder="Enter Email Address"  type="text">												
														<span class="validation_alert" id="send_client_email_cancel_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>												
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_client_cancel" id="send_mail_client_cancel" style="display:none" class="btn btn-primary" onclick="client_notification_cancel()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
													</div>
												</div>
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h3> <?php _e('Staff Notification',WL_A_P_SYSTEM); ?></h3>
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
									<?php $send_notification_staff_pending= $email_settings['send_notification_staff_pending'];?>
										<input id="send_notification_staff_pending" type="checkbox" name="send_notification_staff_pending" class="sl-services" value="yes" <?php if($send_notification_staff_pending=='yes'){ echo 'checked'; } else{ echo ''; }  ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#staffs1">
											<div class="ser-name">
												  <?php _e('Notification to Staff about Pending appointment',WL_A_P_SYSTEM); ?>
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								    <div id="staffs1" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label> <?php _e('Subject:',WL_A_P_SYSTEM); ?> </label>
														<?php $subject_notification_staff_pending= $email_settings['subject_notification_staff_pending'];?>
														<input type="text" name="subject_notification_staff_pending" id="subject_notification_staff_pending" class="form-control" placeholder="Subject" value="<?php echo esc_attr($subject_notification_staff_pending);  ?>" />
													</div>
													<div class="row form-group">
														<label> <?php _e('Message:',WL_A_P_SYSTEM); ?> </label>
														<?php $body_notification_staff_pending= $email_settings['body_notification_staff_pending'];?>
														<textarea id="body_notification_staff_pending" name="body_notification_staff_pending" class="form-control" rows="8" placeholder="Subject"><?php echo esc_attr($body_notification_staff_pending);  ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_staff_pending" class="btn save-link" onclick="staff_pending()"> <?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_staff_pending" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?> </label>
														<input name="preview_mail_staff_pending" id="send_staff_email_pending" required="required" placeholder="Enter Email Address" type="text">												
														<span class="validation_alert" id="send_staff_email_pending_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_staff_pending" id="send_mail_staff_pending" style="display:none" class="btn btn-primary" onclick="staff_notification_pending()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
													</div>
												</div>
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
									<?php $send_notification_staff_approval= $email_settings['send_notification_staff_approval'];?>
										<input type="checkbox" id="send_notification_staff_approval" name="send_notification_staff_approval" class="sl-services" value="yes" <?php if($send_notification_staff_approval=='yes'){ echo 'checked'; } else{ echo ''; }  ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#staffs2">
											<div class="ser-name">
												  <?php _e('Notification to Staff about Approved appointment',WL_A_P_SYSTEM); ?> 
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								    <div id="staffs2" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label> <?php _e('Subject:',WL_A_P_SYSTEM); ?> </label>
														<?php $subject_notification_staff_approval= $email_settings['subject_notification_staff_approval'];?>
														<input id="subject_notification_staff_approval" type="text" name="subject_notification_staff_approval" class="form-control" placeholder="Subject" value="<?php echo esc_attr($subject_notification_staff_approval);  ?>" />
													</div>
													<div class="row form-group">
														<label> <?php _e('Message:',WL_A_P_SYSTEM); ?></label>
														<?php $body_notification_staff_approval= $email_settings['body_notification_staff_approval'];?>
														<textarea id="body_notification_staff_approval" name="body_notification_staff_approval" class="form-control" rows="8" placeholder="Subject"><?php echo esc_attr($body_notification_staff_approval);  ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_staff_approval" class="btn save-link" onclick="staff_approval()"> <?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_staff_approval" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?></label>
														<input name="preview_mail_staff_approval" id="send_staff_email_approved" required="required" placeholder="Enter Email Address" type="text">
														<span class="validation_alert" id="send_staff_email_approv_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_staff_approved" id="send_mail_staff_approval" style="display:none" class="btn btn-primary" onclick="staff_notification_approved()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
													</div>
												</div>
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
									<?php $send_notification_staff_cancel= $email_settings['send_notification_staff_cancel'];?>
										<input type="checkbox" id="send_notification_staff_cancel" name="send_notification_staff_cancel" class="sl-services" value="yes" <?php if($send_notification_staff_cancel=='yes'){ echo 'checked'; } else{ echo ''; }  ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#staffs3">
											<div class="ser-name">
												  <?php _e('Notification to Staff about Cancel appointment',WL_A_P_SYSTEM); ?> 
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								    <div id="staffs3" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label> <?php _e('Subject:',WL_A_P_SYSTEM); ?></label>
														<?php $subject_notification_staff_cancel= $email_settings['subject_notification_staff_cancel'];?>
														<input type="text" name="subject_notification_staff_cancel" id="subject_notification_staff_cancel" class="form-control" placeholder="Subject" value="<?php echo esc_attr($subject_notification_staff_cancel);  ?>" />
													</div>
													<div class="row form-group">
														<label> <?php _e('Message:',WL_A_P_SYSTEM); ?></label>
														<?php $body_notification_staff_cancel= $email_settings['body_notification_staff_cancel'];?>
														<textarea id="body_notification_staff_cancel" name="body_notification_staff_cancel" class="form-control" rows="8" placeholder="Subject"><?php echo esc_attr($body_notification_staff_cancel);  ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_staff_cancel" class="btn save-link" onclick="staff_cancel()"> <?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_staff_cancel" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?></label>
														<input name="preview_mail_staff_cancel" id="send_staff_email_cancel" required="required" placeholder="Enter Email Address" type="text">
														<span class="validation_alert" id="send_staff_email_cancel_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_staff_cancel" id="send_mail_staff_cancel" style="display:none" class="btn btn-primary" onclick="staff_notification_cancel()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
													</div>
												</div>
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<h3> <?php _e('Admin Notification',WL_A_P_SYSTEM); ?></h3>
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
										<?php $send_notification_admin_pending= $email_settings['send_notification_admin_pending'];?>
										<input type="checkbox" id="send_notification_admin_pending" name="send_notification_admin_pending" class="sl-services" value="yes" <?php if($send_notification_admin_pending=='yes'){ echo 'checked'; } else{ echo ''; } ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#admin1">
											<div class="ser-name">
												   <?php _e('Notification to admin about pending appointment',WL_A_P_SYSTEM); ?>
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								   
									<div id="admin1" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label> <?php _e('Subject:',WL_A_P_SYSTEM); ?></label>
														<?php $subject_admin_pending= $email_settings['subject_admin_pending'];?>
														<input type="text" name="subject_admin_pending" id="subject_admin_pending" class="form-control" placeholder="Subject" value="<?php echo esc_attr($subject_admin_pending);?>" />
													</div>
													<div class="row form-group">
														<label> <?php _e('Message:',WL_A_P_SYSTEM); ?></label>
														<?php $admin_body_pending= $email_settings['admin_body_pending'];?>
														<textarea id="admin_body_pending" name="admin_body_pending" class="form-control" rows="8" placeholder="Subject"><?php echo esc_attr($admin_body_pending);  ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_admin_pending" class="btn save-link" onclick="admin_pending()"> <?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_admin_pending" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?></label>
														<input name="preview_mail_admin_pending" id="send_admin_email_pending" required="required" placeholder="Enter Email Address" type="text">												
														<span class="validation_alert" id="send_admin_email_pending_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_admin_pending" id="send_mail_admin_pending" style="display:none" class="btn btn-primary" onclick="admin_notification_pending()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
													</div>
												</div>
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
									<?php $send_notification_admin_approved= $email_settings['send_notification_admin_approved'];?>
										<input type="checkbox" name="send_notification_admin_approved" class="sl-services" id="send_notification_admin_approved" value="yes" <?php if($send_notification_admin_approved=='yes'){ echo 'checked'; } else{ echo ''; } ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#admin2">
											<div class="ser-name">
												  <?php _e('Notification to admin about Approved appointment',WL_A_P_SYSTEM); ?> 
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								    <div id="admin2" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label><?php _e('Subject:',WL_A_P_SYSTEM); ?> </label>
														<?php $subject_admin_approved= $email_settings['subject_admin_approved'];?>
														<input type="text" name="subject_admin_approved" class="form-control" placeholder="Subject" id="subject_admin_approved" value="<?php echo esc_attr($subject_admin_approved);?>" />
													</div>
													<div class="row form-group">
														<label> <?php _e('Message:',WL_A_P_SYSTEM); ?> </label>
														<?php $admin_body_approved= $email_settings['admin_body_approved'];?>
														<textarea id="admin_body_approved" name="admin_body_approved" class="form-control" rows="8" placeholder="Body"><?php echo esc_attr($admin_body_approved); ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_admin_approved" class="btn save-link" onclick="admin_approved()"><?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_admin_approved" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?> </label>
														<input name="preview_mail_admin_approved" id="send_admin_email_approval" required="required" placeholder="Enter Email Address" type="text">												
														<span class="validation_alert" id="send_admin_email_approv_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_admin_approved" id="send_mail_admin_approved" style="display:none" class="btn btn-primary" onclick="admin_notification_approved()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
														
													</div>
												</div>
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> 	
							<div class="panel-group accordion">
								<div class="panel panel-default">
									<div class="panel-heading n_check">
										<?php $send_notification_admin_cancelled= $email_settings['send_notification_admin_cancelled'];?>
										<input type="checkbox" id="send_notification_admin_cancelled" name="send_notification_admin_cancelled" class="sl-services" value="yes" <?php if($send_notification_admin_cancelled=='yes'){ echo 'checked'; } else{ echo ''; }  ?> />
										<h4 class="panel-title" data-toggle="collapse" data-parent=".accordion" href="#admin3">
											<div class="ser-name">
												 <?php _e(' Notification to admin about Cancel appointment',WL_A_P_SYSTEM); ?> 
											</div>
											<i class="fas fa-angle-down icon"></i>
										</h4>
									</div>
								    <div id="admin3" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row form-group">
														<label><?php _e('Subject:',WL_A_P_SYSTEM); ?> </label>
														<?php $subject_admin_cancelled= $email_settings['subject_admin_cancelled'];?>
														<input id="subject_admin_cancelled" type="text" name="subject_admin_cancelled" class="form-control" placeholder="Subject" value="<?php echo esc_attr($subject_admin_cancelled);  ?>" />
													</div>
													<div class="row form-group">
														<label> <?php _e('Message:',WL_A_P_SYSTEM); ?> </label>
														<?php $admin_body_cancelled= $email_settings['admin_body_cancelled'];?>
														<textarea id="admin_body_cancelled" name="admin_body_cancelled" class="form-control" rows="8" placeholder="Body"><?php echo esc_attr($admin_body_cancelled);  ?></textarea>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_preview" id="send_mail_preview_admin_cancelled" class="btn save-link" onclick="admin_cancelled()"> <?php _e('Send Test Mail',WL_A_P_SYSTEM); ?></button>
													</div>
													<div class="row form-group" id="preview_mail_admin_cancelled" style="display:none">
														<label> <?php _e('Enter Receivers Email:',WL_A_P_SYSTEM); ?> </label>
														<input name="preview_mail_admin_cancelled" id="send_admin_email_cancel" required="required" placeholder="Enter Email Address" type="text">
														<span class="validation_alert" id="send_admin_email_cancel_alert"><?php _e("Please Enter An E-mail",WL_A_P_SYSTEM ); ?></span>
													</div>
													<div class="row form-group">
														<button type="button" name="send_mail_admin_cancel" id="send_mail_admin_cancelled" style="display:none" class="btn btn-primary" onclick="admin_notification_cancelled()"> <?php _e('Send',WL_A_P_SYSTEM); ?></button>
														
													</div>
												</div>
												<div class="col-md-6">
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
														<tr>
															<td> <?php _e('Location:',WL_A_P_SYSTEM); ?></td> <td>[LOC_ID]</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 note-form">
								<button  type="button" class="btn save-link" id='save_email_notification' onclick="return save_notification();"><?php _e('Save',WL_A_P_SYSTEM); ?></button>
							</div>
						</form>
					</div>
				</div>
				
				
<?php 
//SMTP MAIL
	if($emailtype=='smtp'){
		//CLIENT
		if(isset($_POST['send_mail_client_pending'])) {
			require 'mailfiles/PHPMailerAutoload.php';
			if($send_notification_client_pending=='yes'){
				
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
		
				$preview_mail_client_pending = ( $_REQUEST['preview_mail_client_pending'] );
				$mail->addReplyTo($preview_mail_client_pending, 'Information');
				$mail->addAddress($preview_mail_client_pending, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				
				$mail->Subject = $subject_notification_client_pending;
				$mail->Body    = '<pre>'.$body_notification_client_pending.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			}
		}
		if(isset($_POST['send_mail_client_approved'])) {
			require 'mailfiles/PHPMailerAutoload.php';
			if($send_notification_client_approval=='yes'){
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
				
				$preview_mail_client_approval = ( $_REQUEST['preview_mail_client_approval'] );
				$mail->addReplyTo($preview_mail_client_approval, 'Information');
				$mail->addAddress($preview_mail_client_approval, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				
				$mail->Subject = $subject_notification_client_approval;
				$mail->Body    = '<pre>'.$body_notification_client_approval.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} 
				else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			}
		}
		
		if(isset($_POST['send_mail_client_cancel'])) {
			require 'mailfiles/PHPMailerAutoload.php';		
			if($send_notification_client_cancel=='yes'){
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
				
				$preview_mail_client_cancel = ( $_REQUEST['preview_mail_client_cancel'] );
				$mail->addReplyTo($preview_mail_client_cancel, 'Information');
				$mail->addAddress($preview_mail_client_cancel, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				
				$mail->Subject = $subject_notification_client_cancel;
				$mail->Body    = '<pre>'.$body_notification_client_cancel.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} 
				else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			}
		}
		//STAFF
		if(isset($_POST['send_mail_staff_pending'])) {
			require 'mailfiles/PHPMailerAutoload.php';
			if($send_notification_staff_pending=='yes'){
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
				
				$preview_mail_staff_pending = ( $_REQUEST['preview_mail_staff_pending'] );
				$mail->addReplyTo($preview_mail_staff_pending, 'Information');
				$mail->addAddress($preview_mail_staff_pending, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				
				$mail->Subject = $subject_notification_staff_pending;
				$mail->Body    = '<pre>'.$body_notification_staff_pending.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} 
				else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			}
		}
		if(isset($_POST['send_mail_staff_approved'])) {
			require 'mailfiles/PHPMailerAutoload.php';
			if($send_notification_staff_approval=='yes'){
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
				
				$preview_mail_staff_approval = ( $_REQUEST['preview_mail_staff_approval'] );
				$mail->addReplyTo($preview_mail_staff_approval, 'Information');
				$mail->addAddress($preview_mail_staff_approval, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				
				$mail->Subject = $subject_notification_staff_approval;
				$mail->Body    = '<pre>'.$body_notification_staff_approval.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} 
				else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			}
		}
			
		if(isset($_POST['send_mail_staff_cancel'])) {
			require 'mailfiles/PHPMailerAutoload.php';
			if($send_notification_staff_cancel=='yes'){
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
				
				$preview_mail_staff_cancel = ( $_REQUEST['preview_mail_staff_cancel'] );
				$mail->addReplyTo($preview_mail_staff_cancel, 'Information');
				$mail->addAddress($preview_mail_staff_cancel, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				
				$mail->Subject = $subject_notification_staff_cancel;
				$mail->Body    = '<pre>'.$body_notification_staff_cancel.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} 
				else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			} 
		}
		//ADMIN
		if(isset($_POST['send_mail_admin_pending'])) {
			require 'mailfiles/PHPMailerAutoload.php';
			if($send_notification_admin_pending=='yes'){
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
				
				$preview_mail_admin_pending = ( $_REQUEST['preview_mail_admin_pending'] );
				$mail->addReplyTo($preview_mail_admin_pending, 'Information');
				$mail->addAddress($preview_mail_admin_pending, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				
				$mail->Subject = $subject_admin_pending;
				$mail->Body    = '<pre>'.$admin_body_pending.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} 
				else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			}
		}
		if(isset($_POST['send_mail_admin_approved'])) {
			require 'mailfiles/PHPMailerAutoload.php';
			if($send_notification_admin_approved=='yes'){
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
				
				$preview_mail_admin_approved = ( $_REQUEST['preview_mail_admin_approved'] );
				$mail->addReplyTo($preview_mail_admin_approved, 'Information');
				$mail->addAddress($preview_mail_admin_approved, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				 
				$mail->Subject = $subject_admin_approved;
				$mail->Body    = '<pre>'.$admin_body_approved.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} 
				else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			}
		}
		if(isset($_POST['send_mail_admin_cancel'])) {
			require 'mailfiles/PHPMailerAutoload.php';
			if($send_notification_admin_cancelled=='yes'){
				$mail = new PHPMailer;
				$mail->isSMTP();                                     // Set mailer to use SMTP
				$mail->Host = $hostname;  					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $smtpemail;                 // SMTP username
				$mail->Password =  $password;                            // SMTP password
				$mail->SMTPSecure = 'ssl';  
				$mail->Port = $portno;
				
				$preview_mail_admin_cancelled = ( $_REQUEST['preview_mail_admin_cancelled'] );
				$mail->addReplyTo($preview_mail_admin_cancelled, 'Information');
				$mail->addAddress($preview_mail_admin_cancelled, 'Site Admin');     // Add a recipient
				$mail->isHTML(true); 
				
				$mail->Subject = $subject_admin_cancelled;
				$mail->Body    = '<pre>'.$admin_body_cancelled.'</pre>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				if(!$mail->send()) {
					/* echo "<font size='3'; color='green'>";
					echo '<b><center>Mail could not be sent.</b></center>';
					echo "</font>";
					echo 'Mailer Error: ' . $mail->ErrorInfo; */
				} 
				else {
					/* echo "<font size='3'; color='green'>";
					echo "<b><center>Mail sent successfully...</center></b>";
					echo "</font>"; */
				}
			}
		}
			
			
		
			
}	
	//WP MAIL
	if($emailtype=='wpmail'){
				
			if(isset($_POST['send_mail_admin_approved'])) {
				if($send_notification_admin_approved=='yes'){
					$preview_mail_admin_approved = ( $_REQUEST['preview_mail_admin_approved'] );
					$subject = $subject_admin_approved;
					$body = $admin_body_approved;
					$to = $preview_mail_admin_approved;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}	
					 else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}	
			}
			if(isset($_POST['send_mail_admin_pending'])) {
				if($send_notification_admin_pending=='yes'){
					$preview_mail_admin_pending = ( $_REQUEST['preview_mail_admin_pending'] );
					$subject = $subject_admin_pending;
					$body = $admin_body_pending;
					$to = $preview_mail_admin_pending;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}	
					else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}	
			}
			if(isset($_POST['send_mail_admin_cancel'])) {
				if($send_notification_admin_cancelled=='yes'){
					$preview_mail_admin_cancelled = ( $_REQUEST['preview_mail_admin_cancelled'] );
					$subject = $subject_admin_cancelled;
					$body = $admin_body_cancelled;
					$to = $preview_mail_admin_cancelled;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}	
			}
			if(isset($_POST['send_mail_client_approved'])) {
				if($send_notification_client_approval=='yes'){
					$preview_mail_client_approval = ( $_REQUEST['preview_mail_client_approval'] );
					$subject = $subject_notification_client_approval;
					$body = $body_notification_client_approval;
					$to = $preview_mail_client_approval;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}	
					 else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}				
			if(isset($_POST['send_mail_client_pending'])) {
				if($send_notification_client_pending=='yes'){
					$preview_mail_client_pending = ( $_REQUEST['preview_mail_client_pending'] );
					$subject = $subject_notification_client_pending;
					$body = $body_notification_client_pending;
					$to = $preview_mail_client_pending;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}	
					else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}	
			}
			if(isset($_POST['send_mail_client_cancel'])) {
				if($send_notification_client_cancel=='yes'){
					$preview_mail_client_cancel = ( $_REQUEST['preview_mail_client_cancel'] );
					$subject = $subject_notification_client_cancel;
					$body = $body_notification_client_cancel;
					$to = $preview_mail_client_cancel;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}	
					else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}				
			if(isset($_POST['send_mail_staff_approved'])) {
				if($send_notification_staff_approval=='yes'){
					$preview_mail_staff_approval = ( $_REQUEST['preview_mail_staff_approval'] );
					$subject = $subject_notification_staff_approval;
					$body = $body_notification_staff_approval;
					$to = $preview_mail_staff_approval;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}	
					else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}				
			if(isset($_POST['send_mail_staff_pending'])) {
				if($send_notification_staff_pending=='yes'){
					$preview_mail_staff_pending = ( $_REQUEST['preview_mail_staff_pending'] );
					$subject = $subject_notification_staff_pending;
					$body = $body_notification_staff_pending;
					$to = $preview_mail_staff_pending;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}	
					else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}	
			}
			if(isset($_POST['send_mail_staff_cancel'])) {
				if($send_notification_staff_cancel=='yes'){
					$preview_mail_staff_cancel = ( $_REQUEST['preview_mail_staff_cancel'] );
					$subject = $subject_notification_staff_cancel;
					$body = $body_notification_staff_cancel;
					$to = $preview_mail_staff_cancel;
					$headers = $wpemail;
					$wp_mail_check = wp_mail( $to, $subject, $body, $headers );
					
					if( $wp_mail_check == true ) {
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}	
					else{
						/* echo "<b><font size='3'; color='blue'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
				
			}				
				
	}
			
			
//PHP MAIL
if($emailtype=='phpmail'){
			if(isset($_POST['send_mail_admin_approved'])) {
				if($send_notification_admin_approved=='yes'){
					$preview_mail_admin_approved = ( $_REQUEST['preview_mail_admin_approved'] );
					$to = $preview_mail_admin_approved;
					$subject = $subject_admin_approved;
					$message = $admin_body_approved;
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}
			if(isset($_POST['send_mail_admin_pending'])) {	
				if($send_notification_admin_pending=='yes'){
					$preview_mail_admin_pending = ( $_REQUEST['preview_mail_admin_pending'] );
					$to = $preview_mail_admin_pending;
					$subject = $subject_admin_pending;
					$message = $admin_body_pending;
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}
			if(isset($_POST['send_mail_admin_cancel'])) {		
				if($send_notification_admin_cancelled=='yes'){
					$preview_mail_admin_cancelled = ( $_REQUEST['preview_mail_admin_cancelled'] );
					$to = $preview_mail_admin_cancelled;
					$subject = $subject_admin_cancelled;
					$message = $admin_body_cancelled;
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}
			if(isset($_POST['send_mail_client_approved'])) {	
				if($send_notification_client_approval=='yes'){
					$preview_mail_client_approval = ( $_REQUEST['preview_mail_client_approval'] );
					$to = $preview_mail_client_approval;
					$subject = $subject_notification_client_approval;
					$message = $body_notification_client_approval;
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}
			if(isset($_POST['send_mail_client_pending'])) {
				
				if($send_notification_client_pending=='yes'){
					$preview_mail_client_pending = ( $_REQUEST['preview_mail_client_pending'] );
					$to = $preview_mail_client_pending;
					$subject = $subject_notification_client_pending;
					$message = $body_notification_client_pending;
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}
			if(isset($_POST['send_mail_client_cancel'])) {	
				if($send_notification_client_cancel=='yes'){
					$preview_mail_client_cancel = ( $_REQUEST['preview_mail_client_cancel'] );
					$to = $preview_mail_client_cancel;
					$subject = $subject_notification_client_cancel;
					$message = $body_notification_client_cancel;
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}
			if(isset($_POST['send_mail_staff_approved'])) {	
		
				if($send_notification_staff_approval=='yes'){
					$preview_mail_staff_approval = ( $_REQUEST['preview_mail_staff_approval'] );
					$to = $preview_mail_staff_approval;
					$subject = $subject_notification_staff_approval;
					$message = $body_notification_staff_approval;
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}
			if(isset($_POST['send_mail_staff_pending'])) {	
				if($send_notification_staff_pending=='yes'){
					$preview_mail_staff_pending = ( $_REQUEST['preview_mail_staff_pending'] );
					$to = $preview_mail_staff_pending;
					$subject = $subject_notification_staff_pending;
					$message = $body_notification_staff_pending;					
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}
			if(isset($_POST['send_mail_staff_cancel'])) {	
				if($send_notification_staff_cancel=='yes'){
					$preview_mail_staff_cancel = ( $_REQUEST['preview_mail_staff_cancel'] );
					$to = $preview_mail_staff_cancel;
					$subject = $subject_notification_staff_cancel;
					$message = $body_notification_staff_cancel;
					$mail_check = mail ($to,$subject,$message,$header);
					
					if( $mail_check == true ) {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center>Mail sent successfully...</center>";
						echo "</font></b>"; */
					}
					else {
						/* echo "<b><font size='3'; color='red'>";
						echo "<center><b>Mail could not be sent...</b></center>";
						echo "</font></b>"; */
					}
				}
			}		
	
}	?>	