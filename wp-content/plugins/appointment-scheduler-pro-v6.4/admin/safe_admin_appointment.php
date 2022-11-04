<script>
//IF NEW APPOINTMENT IS CREATED
jQuery(document).ready(function() {
	jQuery('#s_price').val('');   
	jQuery('#service_name').change(function() {
		jQuery('#s_price').val(jQuery(this).find("option:selected").attr("title"));
	});	
});
jQuery(document).ready(function() {
	jQuery(document).on("change", '#a_customer', function (event) {	
		jQuery('#customer_email').val(jQuery(this).find("option:selected").attr("title"));
	});
});
// multiple select checkbox
jQuery(document).ready(function() {
   jQuery('#select_appointment').click(function(event) {  //on click
        if(this.checked) { // check select status
            jQuery('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
            jQuery('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });
});
//insert appointment
function save_appointment()
{
	if(jQuery("#provider_name").val()=="0")
	{
		jQuery(".validation_alert").hide(); 
		jQuery("#provider_name_alert").show(); 
		jQuery("#provider_name").focus();
		return false;
	}
	if(jQuery("#service_name").val()=="0")
	{
		jQuery(".validation_alert").hide(); 
		jQuery("#service_name_alert").show(); 
		jQuery("#service_name").focus();
		return false;
	}
	if(jQuery("#ap_datepicker").val()=="")
	{
		jQuery(".validation_alert").hide(); 
		jQuery("#ap_datepicker_alert").show(); 
              // jQuery("#ap_datepicker").focus();
              return false;
          }
          if(jQuery("#start_period").val()=="")
          {
          	jQuery(".validation_alert").hide(); 
          	jQuery("#start_period_alert").show(); 
               //jQuery("#start_period").focus();
               return false;
           }
           if(jQuery("#end_period").val()=="")
           {
           	jQuery(".validation_alert").hide(); 
           	jQuery("#end_period_alert").show(); 
               //jQuery("#end_period").focus();
               return false;
           }
           if(jQuery("#a_customer").val()=="0")
           {
           	jQuery(".validation_alert").hide();
           	jQuery("#a_customer_alert").show(); 
           	jQuery("#a_customer").focus();
           	return false;
           }
			  /* if(jQuery("#contact_no").val()=="")
			  {
			   jQuery("#provider_name_alert").hide();
			   jQuery("#service_name_alert").hide();
			   jQuery("#ap_datepicker_alert").hide();
			   jQuery("#start_period_alert").hide();
			   jQuery("#end_period_alert").hide(); 
			   jQuery("#a_customer_alert").hide();
			   jQuery("#contact_no_alert").show(); 
			   jQuery("#status_alert").hide(); 
               jQuery("#contact_no").focus();
                return false;
			  }
			  if(!jQuery.isNumeric(jQuery("#contact_no").val()))
			  {
			   jQuery("#provider_name_alert").hide();
			   jQuery("#service_name_alert").hide();
			   jQuery("#ap_datepicker_alert").hide();
			   jQuery("#start_period_alert").hide();
			   jQuery("#end_period_alert").hide(); 
			   jQuery("#a_customer_alert").hide();
			   jQuery("#contact_no_alert").hide(); 
			   jQuery("#number_contact_alert").show(); 
			   jQuery("#status_alert").hide(); 
               jQuery("#contact_no").focus();
                return false;
            }*/
            if(jQuery("#status").val()=="0")
            {
            	jQuery(".validation_alert").hide(); 
            	jQuery("#status_alert").show(); 
            	jQuery("#status").focus();
            	return false;
            }
            if(jQuery("#appt_payment_status").val()=="0")
            {
            	jQuery(".validation_alert").hide(); 
            	jQuery("#pay_status_alert").show(); 
            	jQuery("#appt_payment_status").focus();
            	return false;
            }
             if(jQuery("#appt_location_id").val()=="0")
            {
            	jQuery(".validation_alert").hide(); 
            	jQuery("#location_alert").show(); 
            	jQuery("#appt_location_status").focus();
            	return false;
            }
            jQuery("#save_appointment_details").prop('disabled', true);
            jQuery('#save_appointment_details').html('<i class="fas fa-spinner fa-spin"></i><?php _e("Saving",WL_A_P_SYSTEM); ?>');
            jQuery.ajax({
            	url: location.href,
            	type: "POST",
            	data: jQuery("form#appoint_form").serialize(),
            	dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#save_appointment_details").prop('disabled', false);
			jQuery('#save_appointment_details').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			jQuery('form#appoint_form')[0].reset();
			jQuery('div#appoint').modal('hide');
			jQuery(".validation_alert").hide(); 
			jQuery.notify("<?php _e('Appointment Created Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			jQuery('#appointment_example').DataTable().ajax.reload(null, false);
			jQuery('#table_payment').DataTable().ajax.reload(null, false);
			jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
			jQuery('#bootstrapModalFullCalendar').fullCalendar('refetchEvents');
		}
	});
        }
        jQuery(document).ready(function() {
        	var table = jQuery('#appointment_example').DataTable( {
        		stateSave: true,
        		responsive: true,
        		ajax: ajaxurl+'?action=fn_my_appointment_dataloader_ajax',
        		"aoColumnDefs" : [
        		{ 'bSortable' : false, className: 'all', 'aTargets' : ['nosort'],},
        		{className: 'all', orderable: true, targets:['sh_ow']}],
        		"language": {
        			"loadingRecords": "<?php _e('No Customer Add',WL_A_P_SYSTEM); ?>"
        		},     
        	} );
        } );
			//fetch records on  model
			jQuery(document).ready(function(){
				jQuery('#update_appoin_model').on('show.bs.modal', function (e) {
					var rowid = jQuery(e.relatedTarget).data('id');
					jQuery.ajax({
						type : 'post',
						url : ajaxurl+'?action=appointment_ajax_request',  
            data :  'appoint_info='+ rowid, //Pass $id
            success : function(data){
            	jQuery('#fetch_appoint_model').html(data);
			// console.log(data);
			 var dateToday = new Date();
			 jQuery( ".a_date" ).datepicker({minDate: dateToday,});
			 jQuery(".phone").intlTelInput();
			}
		});
	});
});
//update appointment
function update_appointment()
{
	if(jQuery("#u_provider_name").val()=="0")
	{
		jQuery(".validation_alert").hide(); 
		jQuery("#u_provider_name_alert").show(); 
		jQuery("#u_provider_name").focus();
		return false;
	}
	if(jQuery("#u_service_name").val()=="0")
	{
		jQuery("#u_provider_name_alert").hide();
		jQuery("#u_service_name_alert").show(); 
		jQuery("#u_service_name").focus();
		return false;
	}
	if(jQuery("#u_datepicker").val()=="")
	{
		jQuery(".validation_alert").hide();
		jQuery("#u_datepicker_alert").show(); 
              // jQuery("#ap_datepicker").focus();
              return false;
          }
          if(jQuery("#u_start_period").val()=="")
          {
          	jQuery(".validation_alert").hide();
          	jQuery("#u_start_period_alert").show();
               //jQuery("#start_period").focus();
               return false;
           }
           if(jQuery("#u_end_period").val()=="")
           {
           	jQuery(".validation_alert").hide();
           	jQuery("#u_end_period_alert").show();  
               //jQuery("#u_end_period").focus();
               return false;
           }
           if(jQuery("#u_a_customer").val()=="0")
           {
           	jQuery(".validation_alert").hide();
           	jQuery("#u_a_customer_name_alert").show(); 
           	jQuery("#a_customer").focus();
           	return false;
           }
			 /*  if(jQuery("#u_contact_no").val()=="")
			  {
			   jQuery("#u_provider_name_alert").hide();
			   jQuery("#u_service_name_alert").hide();
			   jQuery("#u_datepicker_alert").hide();
			   jQuery("#u_start_period_alert").hide();
			   jQuery("#u_end_period_alert").hide(); 
			   jQuery("#u_a_customer_name_alert").hide();
			   jQuery("#u_contact_no_alert").show(); 
			   jQuery("#u_status_alert").hide(); 
               jQuery("#u_contact_no").focus();
                return false;
			  }
			  if(!jQuery.isNumeric(jQuery("#u_contact_no").val()))
			  {
			   jQuery("#u_provider_name_alert").hide();
			   jQuery("#u_service_name_alert").hide();
			   jQuery("#u_datepicker_alert").hide();
			   jQuery("#u_start_period_alert").hide();
			   jQuery("#u_end_period_alert").hide(); 
			   jQuery("#u_a_customer_name_alert").hide();
			   jQuery("#u_contact_no_alert").hide(); 
			   jQuery("#u_number_contact_alert").show(); 
			   jQuery("#u_status_alert").hide(); 
               jQuery("#u_contact_no").focus();
                return false;
            }*/
            if(jQuery("#u_status").val()=="0")
            {
            	jQuery(".validation_alert").hide(); 
            	jQuery("#u_status_alert").show(); 
            	jQuery("#u_status").focus();
            	return false;
            }
            if(jQuery("#u_payment_status").val()=="0")
            {
            	jQuery(".validation_alert").hide(); 
            	jQuery("#u_p_status_alert").show(); 
            	jQuery("#u_payment_status").focus();
            	return false;
            }
            if(jQuery("#u_location").val()=="0")
            {
            	jQuery(".validation_alert").hide(); 
            	jQuery("#u_location_alert").show(); 
            	jQuery("#u_location").focus();
            	return false;
            }
            jQuery("#update_appointment_details").prop('disabled', true);
            jQuery('#update_appointment_details').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Updating",WL_A_P_SYSTEM); ?>');
            jQuery.ajax({
            	url: location.href,
            	type: "POST",
            	data: jQuery("form#update_appoint_form").serialize(),
            	dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#update_appointment_details").prop('disabled', false);
			jQuery('#update_appointment_details').html('<?php _e("Update",WL_A_P_SYSTEM); ?>');
			jQuery('form#update_appoint_form')[0].reset();
			jQuery('div#update_appoin_model').modal('hide');
			jQuery(".validation_alert").hide();
			jQuery.notify("<?php _e('Appointment Updated Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			jQuery('#appointment_example').DataTable().ajax.reload(null, false);
			jQuery('#table_payment').DataTable().ajax.reload(null, false);
			jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
			jQuery('#bootstrapModalFullCalendar').fullCalendar('refetchEvents');
		}
	});
        }
//single delete
jQuery(document).on("click", '.del_appoint', function (event) {
	var d_id = jQuery(this).attr('href');
	var res = d_id.substring(1);
	jQuery.confirm({
		title: '<?php _e("Please Confirm",WL_A_P_SYSTEM); ?>',
		theme: 'black',
		content: '<?php _e("Are you sure to Delete Appointment",WL_A_P_SYSTEM); ?>?',
		animation: 'rotate',
		closeAnimation: 'rotateXR',
		icon: 'far fa-check-square',
		confirmButton: '<?php _e("Delete",WL_A_P_SYSTEM); ?>',
		cancelButton: '<?php _e("Cancel",WL_A_P_SYSTEM); ?>',
		confirm: function () {
			jQuery.ajax({
				data:"appoint_id="+res,
				url: location.href,
				type:"POST",
				success:function(data)
				{
					jQuery.notify("<?php _e('Appointment Delete Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
					jQuery('#appointment_example').DataTable().ajax.reload(null, false);
					jQuery('#table_payment').DataTable().ajax.reload(null, false);
				}
			});
		},
	});
	
});
// multiple delete
jQuery(function(){
	jQuery("a.appoint_delete").click(function(){
		ids=new Array()
		a=0;
		jQuery("#appoint_check:checked").each(function(i){
			ids[i]=jQuery(this).val();
		})
		if(ids.length == 0){
			jQuery.notify("<?php _e('Please Select At Least One Appointment To Delete',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"}); 
		}
		else{
		jQuery.confirm({
			title: '<?php _e("Please Confirm",WL_A_P_SYSTEM); ?>',
			theme: 'black',
			content: '<?php _e("Are you sure to Delete Appointment?",WL_A_P_SYSTEM); ?>',
			animation: 'rotate',
			closeAnimation: 'rotateXR',
			icon: 'far fa-check-square',
			confirmButton: '<?php _e("Delete",WL_A_P_SYSTEM); ?>',
			cancelButton: '<?php _e("Cancel",WL_A_P_SYSTEM); ?>',
			confirm: function () {
				jQuery(".appoint_delete").prop('disabled', true);
				jQuery('.appoint_delete').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Deleting",WL_A_P_SYSTEM); ?>');
				jQuery.ajax({
					data:"multi_appoint_id="+ids,
					url: location.href,
					type:"POST",
					success:function(res)
					{
						jQuery(".appoint_delete").prop('disabled', false);
						jQuery('.appoint_delete').html('<?php _e("Delete",WL_A_P_SYSTEM); ?>');
						jQuery.notify("<?php _e('Approved Delete Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"}); 
						jQuery('#appointment_example').DataTable().ajax.reload(null, false);
						jQuery('#table_payment').DataTable().ajax.reload(null, false);
						jQuery('input[type=checkbox]').attr('checked',false); 
						if(res==1)
						{
							jQuery("#appoint_check:checked").each(function(){
								jQuery(this).parent.remove();
							})
						}
					}
				});
			},
		});
	}
return false;
})
});
jQuery(document).on("change", '.payment_status_value', function (event) {	 
	var status = jQuery(this).val();
	var id = jQuery(this).attr("data-id");
	var apt_client_email = jQuery(this).attr("title");
	var apt_staff_email = jQuery(this).attr("apt_staff_email");
	var apt_client_name = jQuery(this).attr("apt_client_name");
	var apt_time = jQuery(this).attr("apt_time");
	var apt_end_time = jQuery(this).attr("apt_end_time");
	var apt_date = jQuery(this).attr("apt_date");
	var apt_service_name = jQuery(this).attr("apt_service_name");
	var apt_staff_name = jQuery(this).attr("apt_staff_name");
	//alert(apt_time);
	jQuery.ajax({
		url: location.href,
		type: "POST",
		data : {status: status, id: id},
		dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			
		}
	});
	if(status !=="completed"){
		jQuery.confirm({
			title: '<?php _e("Please Confirm",WL_A_P_SYSTEM); ?>Please Confirm',
			theme: 'black',
			content: '<?php _e("Status Updated. Do you want to send mail",WL_A_P_SYSTEM); ?>?',
			animation: 'rotate',
			closeAnimation: 'rotateXR',
			icon: 'far fa-check-square',
			confirmButton: '<?php _e("Yes",WL_A_P_SYSTEM); ?>',
			cancelButton: '<?php _e("No",WL_A_P_SYSTEM); ?>',
			confirm: function () {
				jQuery.ajax({
					url: location.href,
					type: "POST",
					data : {status: status, id: id, apt_client_email: apt_client_email,apt_staff_email: apt_staff_email,apt_client_name: apt_client_name,apt_time: apt_time ,apt_end_time:apt_end_time,apt_date: apt_date,apt_service_name: apt_service_name,apt_staff_name: apt_staff_name},
					dataType: "html",
				//Do not cache the page
				cache: false,
				//success
				success: function (html) {
					jQuery.notify("<?php _e('Mail Sent Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
				}
			});
			},
		});	
	}else{
		jQuery.notify("<?php _e('Status Updated Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
	}	
});
</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#location_appointment').on('change', function() {
			var id = jQuery('#location_appointment option:selected').val();
			alert(id);	
			var datastring = 'location_id='+id;	
			alert("datastring value="+ datastring);		
			jQuery.ajax({
            	url: "<?php plugin_dir_url(__FILE__).'appointment-json.php' ?>",
            	type: "POST",
            	data: datastring,
            	dataType: "html",
				//Do not cache the page
				cache: false,
				//success
				success: function (html) {					
					jQuery('#appointment_example').DataTable().ajax.reload(null, false);
					jQuery('#table_payment').DataTable().ajax.reload(null, false);					
					// console.log(html);
				}
			});
		})
	});
</script>
<?php
//insert appointment
global $wpdb;
$email_settings= get_option("Appoint_notification");
$settings_table =	$wpdb->prefix."apt_settings";
$staff_table =	$wpdb->prefix."apt_staff";
if (isset($_REQUEST['status'],$_REQUEST['id'])) 
{
	$status= $_REQUEST['status'];
	$id= $_REQUEST['id'];
	$wpdb->update(
		$wpdb->prefix.'apt_appointments',
		array('status' =>$status),array('id'=>$id));
	$wpdb->show_errors(); 
	$wpdb->print_error();
}
// get saved client id and secret id
	$google_sync_settings = get_option('weblizar_ap_calendar_sync_settings');
	//print_r($google_sync_settings);
	if(is_array($google_sync_settings)){
		$clientid = $google_sync_settings['ap_cal_client_id'];
		$clientsecret = $google_sync_settings['ap_cal_secret_key'];
	}
	else{
		$clientid = "";
		$clientsecret = "";
	}
	// get refresh token and access token from db
	$refresh_saved = get_option('weblizar_ap_calendar_refresh_token');
	//print_r($refresh_saved);
	if(is_array($refresh_saved)){
		$saved_access_toekn = 	$refresh_saved['access_token'];
		$saved_refresh_token = $refresh_saved['refresh_token'];
		$saved_expireTime = $refresh_saved['expireTime'];
	}
	else{
		$saved_access_toekn = 	"";
		$saved_refresh_token = "";
		$saved_expireTime = "";
	}
	//set session variable
	$_SESSION['refresh_token'] = $saved_refresh_token;
	$_SESSION['expireTime'] = $saved_expireTime;
	if(!empty($_SESSION['refresh_token']) && !empty($_SESSION['expireTime']) && time() > $_SESSION['expireTime']){		
		$data = $Gsync_ojb->GetRefreshedAccessToken($clientid, $saved_refresh_token, $clientsecret);
		$_SESSION['access_token'] = $data['access_token'];
		$_SESSION['access_token_expiry'] = time() + $data['expires_in'];
		$expireTime = $_SESSION['access_token_expiry'];
	}
	else{
		$_SESSION['access_token'] = $saved_access_toekn;
	}// get saved client id and secret id
	$google_sync_settings = get_option('weblizar_ap_calendar_sync_settings');
	//print_r($google_sync_settings);
	if(is_array($google_sync_settings)){
		$clientid = $google_sync_settings['ap_cal_client_id'];
		$clientsecret = $google_sync_settings['ap_cal_secret_key'];
	}
	else{
		$clientid = "";
		$clientsecret = "";
	}
	// get refresh token and access token from db
	$refresh_saved = get_option('weblizar_ap_calendar_refresh_token');
	//print_r($refresh_saved);
	if(is_array($refresh_saved)){
		$saved_access_toekn = 	$refresh_saved['access_token'];
		$saved_refresh_token = $refresh_saved['refresh_token'];
		$saved_expireTime = $refresh_saved['expireTime'];
	}
	else{
		$saved_access_toekn = 	"";
		$saved_refresh_token = "";
		$saved_expireTime = "";
	}
	//set session variable
	$_SESSION['refresh_token'] = $saved_refresh_token;
	$_SESSION['expireTime'] = $saved_expireTime;
	if(!empty($_SESSION['refresh_token']) && !empty($_SESSION['expireTime']) && time() > $_SESSION['expireTime']){		
		$data = $Gsync_ojb->GetRefreshedAccessToken($clientid, $saved_refresh_token, $clientsecret);
		$_SESSION['access_token'] = $data['access_token'];
		$_SESSION['access_token_expiry'] = time() + $data['expires_in'];
		$expireTime = $_SESSION['access_token_expiry'];
	}
	else{
		$_SESSION['access_token'] = $saved_access_toekn;
	}
if(isset($_REQUEST['provider_name']))
{
	$provider_name=$_REQUEST['provider_name'];
	$service_name=$_REQUEST['service_name'];
	$start_period=$_REQUEST['start_period'];
	$end_period=$_REQUEST['end_period'];
	$a_customer=$_REQUEST['a_customer'];
	$contact_no=$_REQUEST['contact_no'];
	$status=$_REQUEST['status'];
	$payment_status=$_REQUEST['payment_status'];
	$newDate = sanitize_text_field( $_REQUEST['ap_datepicker'] );
	$ap_datepicker = date("Y-m-d", strtotime($newDate));
	$customer_email=$_REQUEST['customer_email'];
	$location_id = $_REQUEST['location_id'];
	$s_price = sanitize_text_field( $_REQUEST['s_price'] );
	$staff_details = $wpdb->get_col( "SELECT staff_email from $staff_table where id='$provider_name'" ); 
	$staff_email	= $staff_details[0];
	$staff_name_details = $wpdb->get_col( "SELECT staff_member_name from $staff_table where id='$provider_name'" ); 
	$staff_member_name	= $staff_name_details[0];
	if(empty($staff_email)){
		$staff_email = "xyz@gmail.com";
	}
	$appoint_unique_id = uniqid();
	
	// $settings_payment_currency = $wpdb->get_col( "SELECT currency from $settings_table" ); 
	// $payment_currency	= $settings_payment_currency[0];
	$settings_payment_currency = get_option( "weblizar_aps_payment_setting" ); 
	$payment_currency	= $settings_payment_currency['payment_currency'];
	$wpdb->insert(
		$wpdb->prefix.'apt_appointments',
		array(
				'client_name' => $a_customer,
				'staff_member' => $provider_name,
				'service_type' => $service_name,
				'contact' 	=> $contact_no,
				'booking_date' => $ap_datepicker,
				'start_time' => $start_period,
				'end_time' => $end_period,
				'status' => $status,
				'payment_status' => $payment_status,
				'client_email' => $customer_email,
				'appt_unique_id' => $appoint_unique_id,
				'staff_email'=>$staff_email, 
				'appt_booked_by' => 'by_admin',
				'repeat_appointment'=>'Non',
				're_days'=>'1',
				're_weeks'=>'1',
				're_months'=>'1',
				'location_id'=>$location_id,
			));
	$wpdb->show_errors();
	$wpdb->print_error();
	// $appointment_id = $wpdb->insert_id;
	$wpdb->insert(
		$wpdb->prefix.'apt_payment',
		array(
			'payment_type'=>'Cash',
			'customer'=>$a_customer,
			'customer_email'=>$customer_email,
			'staff'=>$staff_member_name,
			'appointment_date'=>$ap_datepicker,
			'service'=>$service_name,
			'amount'=>$s_price .' '.$payment_currency,
			'status'=>$payment_status,
			// 'appoint_update_id' => $appointment_id
		));
/*google calendar event create*/
	//$start_period
	//$end_period
	//$ap_datepicker
/*google calendar event create*/
/* after payment confirmed gsync add start */
		$time_format = get_option( 'time_format' );
		$temp_ap_start_time = strtotime($start_time);
		$appt_start_time=	date("H:i", $temp_ap_start_time);
			
		$temp_ap_end_time = strtotime($end_time);
		$appt_end_time=	date("H:i", $temp_ap_end_time);
			
	    $appointment_time= $appt_start_time . "-" . $appt_end_time;
		
		$date_format = get_option( 'date_format' );
		$booking_date=date($date_format, strtotime($ap_booking_date));
		$booking_date_sync = date("Y-m-d", strtotime($ap_booking_date));
		$start_time = $booking_date_sync."T".$appt_start_time.':00';
		$end_time = $booking_date_sync."T".$appt_end_time.':00';
		$event_date = "";
		$event_time	= array('start_time' => $start_time,'end_time' => $end_time,'event_date' => $event_date);
		if(isset($_SESSION['access_token'])) {
		//$_SESSION['user_timezone'] = $capi->GetUserCalendarTimezone($_SESSION['access_token']);
		$event_id = $Gsync_ojb->CreateCalendarEvent('primary', $service_name, "0", $event_time, 'Asia/Calcutta', $_SESSION['access_token']);	

		$GS_table_name =$wpdb->prefix ."apt_sync";
		$Insert_GS_data="INSERT INTO `$GS_table_name` (`id` ,`app_id`,`timeoff_id` ,`app_sync_details`) VALUES ('', '$appoint_unique_id', 's1_1', '$event_id' );";
		$wpdb->query($Insert_GS_data);	
		?>
			<script>
				console.log("<?php echo $event_id; ?>");
			</script>
		<?php
		}
}
	
	
//single delete
if(isset($_REQUEST['appoint_id']))
{
	$id = $_REQUEST['appoint_id'];
	$ap_sync_get = $wpdb->get_row("select * from $wpdb->prefix"."apt_sync WHERE app_id = $id ");
	$google_event_id = $ap_sync_get->app_sync_details;
	$del=$_REQUEST['appoint_id'];
	$wpdb->delete( $wpdb->prefix.'apt_appointments', array( 'id' => $del ));
	$Gsync_ojb->DeleteCalendarEvent($google_event_id, 'primary', $_SESSION['access_token']); //delete from google calendar
	$wpdb->delete( $wpdb->prefix.'apt_sync', array( 'app_id' => $id ));
}
// multi delete
if(isset($_REQUEST['multi_appoint_id']))
{ 
	echo $id_array =$_REQUEST['multi_appoint_id'];
	$arr=explode(',',$id_array);
	echo $id_count = count($arr);
	for($i=0;$i<=$id_count;$i++)
	{    
		$del=$arr[$i];
		$wpdb->delete( $wpdb->prefix.'apt_appointments', array( 'id' =>$del ) );
		$wpdb->show_errors();
		$wpdb->print_error();
	}
	for($j=0;$j<=$id_count;$j++){
		$del=$arr[$j];
		$ap_sync_get = $wpdb->get_row("select * from $wpdb->prefix"."apt_sync WHERE app_id = $del ");
		$google_event_id = $ap_sync_get->app_sync_details;
		$Gsync_ojb->DeleteCalendarEvent($google_event_id, 'primary', $_SESSION['access_token']); //delete from google calendar
		$wpdb->delete( $wpdb->prefix.'apt_sync', array( 'app_id' => $del ));
	}
}
//update appointment
if(isset($_REQUEST['u_provider_name']))
{
	$id=$_REQUEST['id_appoint'];
	$u_provider_name=$_REQUEST['u_provider_name'];
	$u_service_name=$_REQUEST['u_service_name'];
	$u_start_period=$_REQUEST['u_start_period'];
	$u_end_period=$_REQUEST['u_end_period'];
	$u_a_customer=$_REQUEST['u_a_customer'];
	$u_contact_no=$_REQUEST['u_contact_no'];
	$u_status=$_REQUEST['u_status'];
	$u_payment_status=$_REQUEST['u_payment_status'];
	$u_newDate = sanitize_text_field( $_REQUEST['u_datepicker'] );
	$u_datepicker = date("Y-m-d", strtotime($u_newDate));
	$u_location = $_REQUEST['u_location'];
	$wpdb->update(
		$wpdb->prefix.'apt_appointments',
		array(
			'client_name' => $u_a_customer,
			'staff_member' => $u_provider_name,
			'service_type' => $u_service_name,
			'contact' 	=> $u_contact_no,
			'booking_date' => $u_datepicker,
			'start_time' => $u_start_period,
			'end_time' => $u_end_period,
			'status' => $u_status,
			'payment_status' => $u_payment_status,
			'location_id' => $u_location,
		),array( 'id'=>$id ));
	$wpdb->show_errors();
	$wpdb->print_error();
	// $wpdb->update(
	// $wpdb->prefix.'apt_payment',
	// 	array(
	// 		'status'=>$u_payment_status,
	// 		'customer' => $u_a_customer
	// ), array('appoint_update_id' => $id ));
	$ap_appoint_gsync = $wpdb->get_row("select * from $wpdb->prefix"."apt_sync WHERE app_id = $id");	
	$google_event_id = $ap_appoint_gsync->app_sync_details;
	/* update the appointment on google calendar */
	$temp_ap_start_time = strtotime($u_start_period);
	$appt_start_time=	date("H:i", $temp_ap_start_time);
		
	$temp_ap_end_time = strtotime($u_end_period);
	$appt_end_time=	date("H:i", $temp_ap_end_time);
	$start_time = $u_datepicker."T".$appt_start_time.':00';
	$end_time = $u_datepicker."T".$appt_end_time.':00';
	$event_date = "";
	$event_time	= array('start_time' => $start_time,'end_time' => $end_time,'event_date' => $event_date);
	$new_event_name = $u_service_name;
	$Gsync_ojb->UpdateCalendarEvent($google_event_id, 'primary', $new_event_name, '0', $event_time, 'Asia/Calcutta', $_SESSION['access_token']);
	
	?>
	<script>
	alert("<?php echo $google_event_id; ?>");
	</script>
	<?php
}
if (isset($_REQUEST['apt_client_email'])) 
{
	$client_email =  $_REQUEST['apt_client_email'] ;
	$staff_email =  $_REQUEST['apt_staff_email'] ;
	$status= $_REQUEST['status'];
	
	$client_name= $_REQUEST['apt_client_name'];
	$apt_start_time= $_REQUEST['apt_time'];
	$ap_booking_end_time= $_REQUEST['apt_end_time'];
	$appoint_date= $_REQUEST['apt_date'];
	$service_name= $_REQUEST['apt_service_name'];
	$staff_name= $_REQUEST['apt_staff_name'];
	
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
	$time_format = get_option( 'time_format' );
	$temp_ap_start_time = strtotime($apt_start_time);
	$appt_start_time=	date($time_format, $temp_ap_start_time);
	
	
	$temp_ap_end_time = strtotime($ap_booking_end_time);
	$appt_end_time=	date($time_format, $temp_ap_end_time);
	
	$apt_time= $appt_start_time . "-" . $appt_end_time;
	$date_format = get_option( 'date_format' );
	$apt_date=date($date_format, strtotime($appoint_date));
	
	$site_url=get_site_url();
	$blog_name= get_bloginfo();
	
	
	$notification_enable= $email_settings['enable'];
	$notification_emailtype= $email_settings['emailtype'];
	if($notification_enable =="yes" ){ 
			//WP MAIL
		if($notification_emailtype=="wpmail"){
			$notification_admin_wp_email= $email_settings['wpemail'];
			if($status=="pending"){
				$notification_client_pending= $email_settings['send_notification_client_pending'];
				if($notification_admin_wp_email !==""){
								//CLIENT PENDING
					if($notification_client_pending=="yes"){
						$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
						$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
						$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
							$to_client_email_pending = $client_email ;
							$subject_client_pending = $notification_subject_client_pending;
							$body_client_pending = $notification_body_client_pending;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_client = wp_mail( $to_client_email_pending, $subject_client_pending, $body_client_pending, $from_admin_email );
						}
					}
								//STAFF PENDING
					$notification_staff_pending= $email_settings['send_notification_staff_pending'];
					if($notification_staff_pending=="yes"){
						$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_pending'];
						$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
						$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
							$to_staff_email_pending = $staff_email ;
							$subject_staff_pending = $notification_subject_staff_pending;
							$body_staff_pending = $notification_body_staff_pending;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_staff = wp_mail( $to_staff_email_pending, $subject_staff_pending, $body_staff_pending, $from_admin_email );
						}
					}
								//ADMIN PENDING
					$notification_admin_pending= $email_settings['send_notification_admin_pending'];
					if($notification_admin_pending=="yes"){
						$temp_notification_subject_admin_pending= $email_settings['subject_admin_pending'];
						$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
						$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
							$to_admin_email_pending = $notification_admin_wp_email ;
							$subject_admin_pending = $notification_subject_admin_pending;
							$body_admin_pending = $notification_body_admin_pending;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_admin = wp_mail( $to_admin_email_pending, $subject_admin_pending, $body_admin_pending, $from_admin_email );
						}
					}
				}
			}
			if($status=="approved"){
							//CLIENT APPROVED
				$notification_client_approved= $email_settings['send_notification_client_approval'];
				if($notification_admin_wp_email !==""){
					if($notification_client_approved=="yes"){
						$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
						$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
						$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
							$to_client_email_approved = $client_email ;
							$subject_client_approved = $notification_subject_client_approved;
							$body_client_approved = $notification_body_client_approved;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_client = wp_mail( $to_client_email_approved, $subject_client_approved, $body_client_approved, $from_admin_email );
						}
					}
								//STAFF APPROVED
					$notification_staff_approved= $email_settings['send_notification_staff_approval'];
					if($notification_staff_approved=="yes"){
						$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
						$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
						$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
							$to_staff_email_approved = $staff_email ;
							$subject_staff_approved = $notification_subject_staff_approved;
							$body_staff_approved = $notification_body_staff_approved;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_staff = wp_mail( $to_staff_email_approved, $subject_staff_approved, $body_staff_approved, $from_admin_email );
						}
					}
								//ADMIN APPROVED
					$notification_admin_approved= $email_settings['send_notification_admin_approved'];
					if($notification_admin_approved=="yes"){
						$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
						$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
						$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
							$to_admin_email_approved = $notification_admin_wp_email ;
							$subject_admin_approved = $notification_subject_admin_approved;
							$body_admin_approved = $notification_body_admin_approved;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_admin = wp_mail( $to_admin_email_approved, $subject_admin_approved, $body_admin_approved, $from_admin_email );
						}
					}
				}
			}
			if($status=="cancel"){
							//CLIENT CANCEL
				$notification_client_cancel= $email_settings['send_notification_client_cancel'];
				if($notification_admin_wp_email !==""){
					if($notification_client_cancel=="yes"){
						$temp_notification_subject_client_cancel= $email_settings['subject_notification_client_cancel'];
						$notification_subject_client_cancel =  strtr($temp_notification_subject_client_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_client_cancel= $email_settings['body_notification_client_cancel'];
						$notification_body_client_cancel =  strtr($temp_notification_body_client_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_client_cancel !=="" &&  $notification_body_client_cancel !==""){
							$to_client_email_cancel = $client_email ;
							$subject_client_cancel = $notification_subject_client_cancel;
							$body_client_cancel = $notification_body_client_cancel;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_client = wp_mail( $to_client_email_cancel, $subject_client_cancel, $body_client_cancel, $from_admin_email );
						}
					}
								//STAFF CANCEL
					$notification_staff_cancel= $email_settings['send_notification_staff_cancel'];
					if($notification_staff_cancel=="yes"){
						$temp_notification_subject_staff_cancel= $email_settings['subject_notification_staff_cancel'];
						$notification_subject_staff_cancel =  strtr($temp_notification_subject_staff_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_staff_cancel= $email_settings['body_notification_staff_cancel'];
						$notification_body_staff_cancel =  strtr($temp_notification_body_staff_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_staff_cancel !=="" &&  $notification_body_staff_cancel !==""){
							$to_staff_email_cancel = $staff_email ;
							$subject_staff_cancel = $notification_subject_staff_cancel;
							$body_staff_cancel = $notification_body_staff_cancel;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_staff = wp_mail( $to_staff_email_cancel, $subject_staff_cancel, $body_staff_cancel, $from_admin_email );
						}
					}
								//ADMIN CANCEL
					$notification_admin_cancel= $email_settings['send_notification_admin_cancelled'];
					if($notification_admin_cancel=="yes"){
						$temp_notification_subject_admin_cancel= $email_settings['subject_admin_cancelled'];
						$notification_subject_admin_cancel =  strtr($temp_notification_subject_admin_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_admin_cancel= $email_settings['admin_body_cancelled'];
						$notification_body_admin_cancel =  strtr($temp_notification_body_admin_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_admin_cancel !=="" &&  $notification_body_admin_cancel !==""){
							$to_admin_email_cancel = $notification_admin_wp_email ;
							$subject_admin_cancel = $notification_subject_admin_cancel;
							$body_admin_cancel = $notification_body_admin_cancel;
							$from_admin_email = $notification_admin_wp_email;
							$wp_mail_check_admin = wp_mail( $to_admin_email_cancel, $subject_admin_cancel, $body_admin_cancel, $from_admin_email );
						}
					}
				}
			}
		}
				//PHP MAIL
		if($notification_emailtype=="phpmail"){
			$notification_admin_php_email= $email_settings['phpemail'];
			if($status=="pending"){
				$notification_client_pending= $email_settings['send_notification_client_pending'];
				if($notification_admin_php_email !==""){
					if($notification_client_pending=="yes"){
									//CLIENT PENDING
						$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
						$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
						$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
							$to_client_email_pending = $client_email;
							$subject_client_pending = $notification_subject_client_pending;
							$body_client_pending = $notification_body_client_pending;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_client_pending = mail ($to_client_email_pending,$subject_client_pending,$body_client_pending,$from_admin_email);
						}
					}
								//STAFF PENDING
					$notification_staff_pending= $email_settings['send_notification_staff_pending'];
					if($notification_staff_pending=="yes"){
						$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_pending'];
						$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
						$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
							$to_staff_email_pending = $staff_email;
							$subject_staff_pending = $notification_subject_staff_pending;
							$body_staff_pending = $notification_body_staff_pending;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_staff_pending = mail ($to_staff_email_pending,$subject_staff_pending,$body_staff_pending,$from_admin_email);
						}
					}
								//ADMIN PENDING							
					$notification_admin_pending= $email_settings['send_notification_admin_pending'];
					if($notification_admin_pending=="yes"){
						$temp_notification_subject_admin_pending= $email_settings['subject_admin_pending'];
						$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
						$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
							$to_admin_email_pending = $notification_admin_php_email;
							$subject_admin_pending = $notification_subject_admin_pending;
							$body_admin_pending = $notification_body_admin_pending;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_admin_pending = mail ($to_admin_email_pending,$subject_admin_pending,$body_admin_pending,$from_admin_email);
						}
					}	
				}
			}
			if($status=="approved"){
				$notification_client_approved= $email_settings['send_notification_client_approval'];
				if($notification_admin_php_email !==""){
					if($notification_client_approved=="yes"){
									//CLIENT APPROVED
						$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
						$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
						$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
							$to_client_email_approved = $client_email;
							$subject_client_approved = $notification_subject_client_approved;
							$body_client_approved = $notification_body_client_approved;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_client_approved = mail ($to_client_email_approved,$subject_client_approved,$body_client_approved,$from_admin_email);
						}
					}
								//STAFF APPROVED
					$notification_staff_approved= $email_settings['send_notification_staff_approval'];
					if($notification_staff_approved=="yes"){
						$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
						$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
						$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
							$to_staff_email_approved = $staff_email;
							$subject_staff_approved = $notification_subject_staff_approved;
							$body_staff_approved = $notification_body_staff_approved;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_staff_approved = mail ($to_staff_email_approved,$subject_staff_approved,$body_staff_approved,$from_admin_email);
						}
					}	
								//ADMIN APPROVED
					$notification_admin_approved= $email_settings['send_notification_admin_approved'];
					if($notification_admin_approved=="yes"){
						$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
						$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
						$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
							$to_admin_email_approved = $notification_admin_php_email;
							$subject_admin_approved = $notification_subject_admin_approved;
							$body_admin_pending = $notification_body_admin_approved;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_admin_approved = mail ($to_admin_email_approved,$subject_admin_approved,$body_admin_pending,$from_admin_email);
						}
					}	
				}
			}
			if($status=="cancel"){
				$notification_client_cancel= $email_settings['send_notification_client_cancel'];
				if($notification_admin_php_email !==""){
					if($notification_client_cancel=="yes"){
									//CLIENT CANCEL
						$temp_notification_subject_client_cancel= $email_settings['subject_notification_client_cancel'];
						$notification_subject_client_cancel =  strtr($temp_notification_subject_client_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_client_cancel= $email_settings['body_notification_client_cancel'];
						$notification_body_client_cancel =  strtr($temp_notification_body_client_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_client_cancel !=="" &&  $notification_body_client_cancel !==""){
							$to_client_email_cancel = $client_email;
							$subject_client_cancel = $notification_subject_client_cancel;
							$body_client_cancel = $notification_body_client_cancel;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_client_cancel = mail ($to_client_email_cancel,$subject_client_cancel,$body_client_cancel,$from_admin_email);
						}
					}
								//STAFF CANCEL
					$notification_staff_cancel= $email_settings['send_notification_staff_cancel'];
					if($notification_staff_cancel=="yes"){
						$temp_notification_subject_staff_cancel= $email_settings['subject_notification_staff_cancel'];
						$notification_subject_staff_cancel =  strtr($temp_notification_subject_staff_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_staff_cancel= $email_settings['body_notification_staff_cancel'];
						$notification_body_staff_cancel =  strtr($temp_notification_body_staff_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_staff_cancel !=="" &&  $notification_body_staff_cancel !==""){
							$to_staff_email_cancel = $staff_email;
							$subject_staff_cancel = $notification_subject_staff_cancel;
							$body_staff_cancel = $notification_body_staff_cancel;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_staff_cancel = mail ($to_staff_email_cancel,$subject_staff_cancel,$body_staff_cancel,$from_admin_email);
						}
					}	
								//ADMIN CANCEL
					$notification_admin_cancelled= $email_settings['send_notification_admin_cancelled'];
					if($notification_admin_cancelled=="yes"){
						$temp_notification_subject_admin_cancel= $email_settings['subject_admin_cancelled'];
						$notification_subject_admin_cancelled =  strtr($temp_notification_subject_admin_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_admin_cancel= $email_settings['admin_body_cancelled'];
						$notification_body_admin_cancelled =  strtr($temp_notification_body_admin_cancel, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_admin_cancelled !=="" &&  $notification_body_admin_cancelled !==""){
							$to_admin_email_cancel = $notification_admin_php_email;
							$subject_admin_cancel = $notification_subject_admin_cancelled;
							$body_admin_cancel = $notification_body_admin_cancelled;
							$from_admin_email = $notification_admin_php_email;
							$mail_check_admin_cancel = mail ($to_admin_email_cancel,$subject_admin_cancel,$body_admin_cancel,$from_admin_email);
						}
					}	
				}
			}
		}
		if($notification_emailtype=="smtp"){
			require 'mailfiles/PHPMailerAutoload.php';
			$notification_admin_smtp_hostname= $email_settings['hostname'];
			$notification_admin_smtp_port= $email_settings['portno'];
			$notification_admin_smtp_mail= $email_settings['smtpemail'];
			$notification_admin_smtp_password= $email_settings['password'];
			if($status=="pending"){
							//CLIENT PENDING
				$notification_client_pending= $email_settings['send_notification_client_pending'];
				if($notification_admin_smtp_hostname !=="" && $notification_admin_smtp_port !=="" && $notification_admin_smtp_mail !=="" && $notification_admin_smtp_password !==""){
					if($notification_client_pending=="yes"){
						$temp_notification_subject_client_pending= $email_settings['subject_notification_client_pending'];
						$notification_subject_client_pending =  strtr($temp_notification_subject_client_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						$temp_notification_body_client_pending= $email_settings['body_notification_client_pending'];
						$notification_body_client_pending =  strtr($temp_notification_body_client_pending, array( 
							'[SERVICE_NAME]'	=>	$service_name,
							'[APPOINTMENT_DATE]'	=>	$apt_date,
							'[APPOINTMENT_TIME]'	=>	$apt_time,
							'[CLIENT_NAME]'	=>	$client_name,
							'[CLIENT_EMAIL]'	=>	$client_email,
							'[STAFF_NAME]'	=>	$staff_name,
							'[APPOINTMENT_STATUS]'	=>	$status,
							'[ADMIN_NAME]'	=>	$admin_name,
							'[BLOG_NAME]'	=>	$blog_name,
							'[SITE_URL]'	 => $site_url));
						if($notification_subject_client_pending !=="" &&  $notification_body_client_pending !==""){
							$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                // SMTP username
										$mail->Password = $notification_admin_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
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
								//STAFF PENDING
								$notification_staff_pending= $email_settings['send_notification_staff_pending'];
								if($notification_staff_pending=="yes"){
									$temp_notification_subject_staff_pending= $email_settings['subject_notification_staff_pending'];
									$notification_subject_staff_pending =  strtr($temp_notification_subject_staff_pending, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									$temp_notification_body_staff_pending= $email_settings['body_notification_staff_pending'];
									$notification_body_staff_pending =  strtr($temp_notification_body_staff_pending, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									if($notification_subject_staff_pending !=="" &&  $notification_body_staff_pending !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname;  					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                 // SMTP username
										$mail->Password =  $notification_admin_smtp_password;                            // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
										$mail->addReplyTo($staff_email, 'Information');
										$mail->addAddress($staff_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
										$mail->Subject = $notification_subject_staff_pending;
										$mail->Body    = '<pre>'.$notification_body_staff_pending.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
										if(!$mail->send()) {
										   // echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										  //  echo 'Message has been sent';
										}
									}
								}
								//ADMIN PENDING
								$notification_admin_pending= $email_settings['send_notification_admin_pending'];
								if($notification_admin_pending=="yes"){
									$temp_notification_subject_admin_pending= $email_settings['subject_admin_pending'];
									$notification_subject_admin_pending =  strtr($temp_notification_subject_admin_pending, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									$temp_notification_body_admin_pending= $email_settings['admin_body_pending'];
									$notification_body_admin_pending =  strtr($temp_notification_body_admin_pending, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									if($notification_subject_admin_pending !=="" &&  $notification_body_admin_pending !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname;  					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                 // SMTP username
										$mail->Password =  $notification_admin_smtp_password;                            // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
										$mail->addReplyTo($notification_admin_smtp_mail, 'Information');
										$mail->addAddress($notification_admin_smtp_mail, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
										$mail->Subject = $notification_subject_admin_pending;
										$mail->Body    = '<pre>'.$notification_body_admin_pending.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
										if(!$mail->send()) {
										   // echo 'Message could not be sent.';
										    //echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}
								}
							}
						}
						if($status=="approved"){
							$notification_client_approved= $email_settings['send_notification_client_approval'];
							if($notification_admin_smtp_hostname !=="" && $notification_admin_smtp_port !=="" && $notification_admin_smtp_mail !=="" && $notification_admin_smtp_password !==""){
								if($notification_client_approved=="yes"){
									//CLIENT APPROVED
									$temp_notification_subject_client_approved= $email_settings['subject_notification_client_approval'];
									$notification_subject_client_approved =  strtr($temp_notification_subject_client_approved, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									$temp_notification_body_client_approved= $email_settings['body_notification_client_approval'];
									$notification_body_client_approved =  strtr($temp_notification_body_client_approved, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									if($notification_subject_client_approved !=="" &&  $notification_body_client_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                // SMTP username
										$mail->Password = $notification_admin_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
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
								//STAFF APPROVED
								$notification_staff_approved= $email_settings['send_notification_staff_approval'];
								if($notification_staff_approved=="yes"){
									$temp_notification_subject_staff_approved= $email_settings['subject_notification_staff_approval'];
									$notification_subject_staff_approved =  strtr($temp_notification_subject_staff_approved, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									$temp_notification_body_staff_approved= $email_settings['body_notification_staff_approval'];
									$notification_body_staff_approved =  strtr($temp_notification_body_staff_approved, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									if($notification_subject_staff_approved !=="" &&  $notification_body_staff_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname;  					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                 // SMTP username
										$mail->Password =  $notification_admin_smtp_password;                            // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
										$mail->addReplyTo($staff_email, 'Information');
										$mail->addAddress($staff_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
										$mail->Subject = $notification_subject_staff_approved;
										$mail->Body    =  '<pre>'.$notification_body_staff_approved.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
										if(!$mail->send()) {
										   // echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										  //  echo 'Message has been sent';
										}
									}
								}
								//ADMIN APPROVED
								$notification_admin_approved= $email_settings['send_notification_admin_approved'];
								if($notification_admin_approved=="yes"){
									$temp_notification_subject_admin_approved= $email_settings['subject_admin_approved'];
									$notification_subject_admin_approved =  strtr($temp_notification_subject_admin_approved, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									$temp_notification_body_admin_approved= $email_settings['admin_body_approved'];
									$notification_body_admin_approved =  strtr($temp_notification_body_admin_approved, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									if($notification_subject_admin_approved !=="" &&  $notification_body_admin_approved !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname;  					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                 // SMTP username
										$mail->Password =  $notification_admin_smtp_password;                            // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
										$mail->addReplyTo($notification_admin_smtp_mail, 'Information');
										$mail->addAddress($notification_admin_smtp_mail, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
										$mail->Subject = $notification_subject_admin_approved;
										$mail->Body    = '<pre>'.$notification_body_admin_approved.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
										if(!$mail->send()) {
										   // echo 'Message could not be sent.';
										    //echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}
								}
							}
						}
						if($status=="cancel"){
							$notification_client_cancel= $email_settings['send_notification_client_cancel'];
							if($notification_admin_smtp_hostname !=="" && $notification_admin_smtp_port !=="" && $notification_admin_smtp_mail !=="" && $notification_admin_smtp_password !==""){
								if($notification_client_cancel=="yes"){
									//CLIENT CANCEL
									$temp_notification_subject_client_cancel= $email_settings['subject_notification_client_cancel'];
									$notification_subject_client_cancel =  strtr($temp_notification_subject_client_cancel, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									$temp_notification_body_client_cancel= $email_settings['body_notification_client_cancel'];
									$notification_body_client_cancel =  strtr($temp_notification_body_client_cancel, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									if($notification_subject_client_cancel !=="" &&  $notification_body_client_cancel !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname; 					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                // SMTP username
										$mail->Password = $notification_admin_smtp_password;                             // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
										$mail->addReplyTo($client_email, 'Information');
										$mail->addAddress($client_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
										$mail->Subject = $notification_subject_client_cancel;
										$mail->Body    ='<pre>'.$notification_body_client_cancel.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
										if(!$mail->send()) {
										  //  echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
										
										
									}
								}
								//STAFF CANCEL
								$notification_staff_cancel= $email_settings['send_notification_staff_cancel'];
								if($notification_staff_cancel=="yes"){
									$temp_notification_subject_staff_cancel= $email_settings['subject_notification_staff_cancel'];
									$notification_subject_staff_cancel =  strtr($temp_notification_subject_staff_cancel, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									$temp_notification_body_staff_cancel= $email_settings['body_notification_staff_cancel'];
									$notification_body_staff_cancel =  strtr($temp_notification_body_staff_cancel, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									if($notification_subject_staff_cancel !=="" &&  $notification_body_staff_cancel !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname;  					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                 // SMTP username
										$mail->Password =  $notification_admin_smtp_password;                            // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
										$mail->addReplyTo($staff_email, 'Information');
										$mail->addAddress($staff_email, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
										$mail->Subject = $notification_subject_staff_cancel;
										$mail->Body    = '<pre>'.$notification_body_staff_cancel.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
										if(!$mail->send()) {
										   // echo 'Message could not be sent.';
										  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										  //  echo 'Message has been sent';
										}
									}
								}
								//ADMIN CANCEL
								$notification_admin_cancel= $email_settings['send_notification_admin_cancelled'];
								if($notification_admin_cancel=="yes"){
									$temp_notification_subject_admin_cancel= $email_settings['subject_admin_cancelled'];
									$notification_subject_admin_cancel =  strtr($temp_notification_subject_admin_cancel, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									$temp_notification_body_admin_cancel= $email_settings['admin_body_cancelled'];
									$notification_body_admin_cancel =  strtr($temp_notification_body_admin_cancel, array( 
										'[SERVICE_NAME]'	=>	$service_name,
										'[APPOINTMENT_DATE]'	=>	$apt_date,
										'[APPOINTMENT_TIME]'	=>	$apt_time,
										'[CLIENT_NAME]'	=>	$client_name,
										'[CLIENT_EMAIL]'	=>	$client_email,
										'[STAFF_NAME]'	=>	$staff_name,
										'[APPOINTMENT_STATUS]'	=>	$status,
										'[ADMIN_NAME]'	=>	$admin_name,
										'[BLOG_NAME]'	=>	$blog_name,
										'[SITE_URL]'	 => $site_url));
									
									
									
									if($notification_subject_admin_cancel !=="" &&  $notification_body_admin_cancel !==""){
										$mail = new PHPMailer;
										$mail->isSMTP();                                     // Set mailer to use SMTP
										$mail->Host = $notification_admin_smtp_hostname;  					// Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = $notification_admin_smtp_mail;                 // SMTP username
										$mail->Password =  $notification_admin_smtp_password;                            // SMTP password
										$mail->SMTPSecure = 'ssl';  
										$mail->Port = $notification_admin_smtp_port; 
										$mail->addReplyTo($notification_admin_smtp_mail, 'Information');
										$mail->addAddress($notification_admin_smtp_mail, 'Site Admin');     // Add a recipient
										$mail->isHTML(true); 
										$mail->Subject = $notification_subject_admin_cancel;
										$mail->Body    = '<pre>'.$notification_body_admin_cancel.'</pre>';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
										if(!$mail->send()) {
										   // echo 'Message could not be sent.';
										    //echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
										   // echo 'Message has been sent';
										}
									}
								}
							}
						}
					}
					
				}
			}
$appointment_staff_details = $wpdb->get_results( "select * from $wpdb->prefix"."apt_staff");
$appointment_service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_services");
$appointment_client_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_clients");
$location_table = $wpdb->prefix."apt_location";
$location_info = $wpdb->get_results("select * from $location_table");
/*staff permission for non admin users*/
$current_user = wp_get_current_user();
$current_user_email = $current_user->user_email;
$staff_table =	$wpdb->prefix."apt_staff";
$client_table = $wpdb->prefix.'apt_clients';
$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `$staff_table` WHERE staff_email = %s", $current_user_email));
	/* for customer */
$count_client = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `$client_table` WHERE email = %s", $current_user_email));

if($count == 1 || $current_role == "administrator" ){
	function staff_appoint_auth(){
		$weblizar_aps_staff_dashboard = get_option("weblizar_aps_staff_dashboard_settings"); 
		$staff_appointment_setting = $weblizar_aps_staff_dashboard['appointment_edit'];
		$current_user = wp_get_current_user();
		$current_staff_email = $current_user->user_email;
		$role = $current_user->roles;
		$current_role = $role[0];
		if($current_role != "administrator" && $staff_appointment_setting == "no"){
			echo 'style="display: none;"';
		}
	}
}
else if($count_client == 1){
	function staff_appoint_auth(){
		$current_user = wp_get_current_user();
		$current_staff_email = $current_user->user_email;
		$role = $current_user->roles;
		$current_role = $role[0];
		if($current_role != "administrator"){
			echo 'style="display: none;"';
		}
	}
}

		
?>				
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fas fa-thumbtack"></i><span class="panel_heading"><?php _e("Appointments",WL_A_P_SYSTEM );?></span> 
					<div class="theme-export">
						<a <?php staff_appoint_auth(); ?> class="btn theme-customer"  href="<?php echo plugins_url('appointment-all-csv.php', __FILE__ ); ?>"><?php _e("Download All",WL_A_P_SYSTEM );?> </a>
					</div>
					<div class="theme-new-customer">
						<button <?php staff_appoint_auth(); ?> type="button" class="btn theme-customer" data-toggle="modal" data-target="#appoint"><i class="fas fa-plus" aria-hidden="true"></i><?php _e(" New Appoinment",WL_A_P_SYSTEM );?> </button>
						<div class="modal fade" id="appoint" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><?php _e("New Appointment",WL_A_P_SYSTEM );?> </h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<form action="" method="post" id="appoint_form">
												<div class="row">
													<div class="col-md-6 cus-reg" id="appoint_staff">
														<label><?php _e("Staff Member Name:",WL_A_P_SYSTEM );?>  </label>
														<select <?php staff_appoint_auth(); ?> class="a-member form-control" name="provider_name" id="provider_name">
															<option value="0"><?php _e("Select Staff",WL_A_P_SYSTEM );?> </option>
															<?php foreach($appointment_staff_details as $appointment_staff_single_detail){ ?>
															<option value="<?php echo $appointment_staff_single_detail->id;?>"><?php echo $appointment_staff_single_detail->staff_member_name;?></option>
															<?php } ?>
														</select>
														<span  class="validation_alert" id="provider_name_alert"><?php _e("Please select one",WL_A_P_SYSTEM ); ?></span>
													</div>
													<div class="col-md-6 cus-reg" id="appoint_service">
														<label><?php _e("Service Name:",WL_A_P_SYSTEM );?>  </label>
														<select <?php staff_appoint_auth(); ?> class="a-services form-control" name="service_name" id="service_name">
															<option value="0" class="" selected="selected"><?php _e("-- Select a service --",WL_A_P_SYSTEM );?> </option>
															<?php foreach($appointment_category_details as $appointment_category_single_detail){ ?>
															<optgroup label="<?php echo $appointment_category_single_detail->name;?>">
																<?php $service_table=	$wpdb->prefix."apt_services";
																$appointment_details = $wpdb->get_results( "SELECT * from $service_table where category= '$appointment_category_single_detail->id'");  
																foreach($appointment_details as $appointment_single_detail){	?>
																<option title="<?php echo $appointment_single_detail->price ?>" value="<?php echo $appointment_single_detail->name ?>"><?php echo $appointment_single_detail->name ?></option>
																<?php } ?>
															</optgroup>
															<?php } ?>
														</select>
														<input type="hidden" class="form-control" name="s_price" id="s_price"/>
														<span  class="validation_alert" id="service_name_alert"><?php _e("Please select one",WL_A_P_SYSTEM ); ?></span>
													</div>
												</div>
												<div class="col-md-6 cus-reg">
													<label><?php _e("Date:",WL_A_P_SYSTEM );?>  </label>
													<input <?php staff_appoint_auth(); ?> type="text" class="col-md-12 a_date" id="ap_datepicker" name="ap_datepicker">
													<span  class="validation_alert" id="ap_datepicker_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
												</div>
												<div class="cus-reg">
													<div class="row">
														<div class="col-md-6">
															<label> <?php _e("Start Time:",WL_A_P_SYSTEM );?>  </label>
															<div class="input-group clockpicker off_use_time" data-placement="left" data-align="top" data-autoclose="true">
																<input <?php staff_appoint_auth(); ?> required="required" type="text" name="start_period" id="start_period" class="field form-control" placeholder="Time">
															</div>
														</div>
														<span  class="validation_alert" id="start_period_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
														<div class="col-md-6">
															<label> <?php _e("End Time:",WL_A_P_SYSTEM );?>  </label>
															<div class="input-group clockpicker off_use_time" data-placement="left" data-align="top" data-autoclose="true">
																<input <?php staff_appoint_auth(); ?> required="required" type="text" name="end_period" id="end_period" class="field form-control" placeholder="Time">
															</div>
														</div>
														<span  class="validation_alert" id="end_period_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
													</div>
												</div>
												<div class="row cus-reg" id="appoint_customer">
													<label><?php _e("Customer:",WL_A_P_SYSTEM );?>  </label>
													<select <?php staff_appoint_auth(); ?> name="a_customer" id="a_customer" class="form-control">
														<option value="0"> <?php _e("Select Customer",WL_A_P_SYSTEM );?> </option>
														<?php foreach($appointment_client_details as $appointment_client_single_detail){ ?>
														<option title="<?php echo $appointment_client_single_detail->email; ?>" value="<?php echo $appointment_client_single_detail->first_name; ?> <?php echo $appointment_client_single_detail->last_name; ?>"><?php echo $appointment_client_single_detail->first_name; ?> <?php echo $appointment_client_single_detail->last_name; ?></option>
														<?php } ?>
													</select>
													<input type="hidden" class="form-control" name="customer_email" id="customer_email"/>
													<span  class="validation_alert" id="a_customer_alert"><?php _e("Please select/create one",WL_A_P_SYSTEM ); ?></span>
												</div>
												<div class="row cus-reg">
													<label> <?php _e("Contact No.:",WL_A_P_SYSTEM );?>  </label>
													<input <?php staff_appoint_auth(); ?> type="tel" name="contact_no"  id="contact_no" class="form-control phone">
													<span  class="validation_alert" id="contact_no_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>	
													<span  class="validation_alert" id="number_contact_alert"><?php _e("This field is required number",WL_A_P_SYSTEM ); ?></span>
												</div>
												<div class="row cus-reg">
													<label> <?php _e("Status:",WL_A_P_SYSTEM );?>  </label>
													<select <?php staff_appoint_auth(); ?> name="status" id="status"  class="form-control">
														<option value="0"><?php _e("--- Select Status ---",WL_A_P_SYSTEM );?> </option>
														<option value="approved"><?php _e("Approved",WL_A_P_SYSTEM );?> </option>
														<option value="pending"><?php _e("Pending",WL_A_P_SYSTEM );?> </option>
														<option value="cancel"><?php _e("Cancel",WL_A_P_SYSTEM );?> </option>
														<option value="completed"><?php _e("Completed",WL_A_P_SYSTEM );?> </option>
													</select>
													<span  class="validation_alert" id="status_alert"><?php _e("Please select one",WL_A_P_SYSTEM ); ?></span>
												</div>
												<div class="row cus-reg">
													<label> <?php _e("Payment Status:",WL_A_P_SYSTEM );?>  </label>
													<select <?php staff_appoint_auth(); ?> name="payment_status" id="appt_payment_status"  class="form-control">
														<option value="0"><?php _e("--- Select Status ---",WL_A_P_SYSTEM );?> </option>
														<option value="approved"><?php _e("Approved",WL_A_P_SYSTEM );?> </option>
														<option value="pending"><?php _e("Pending",WL_A_P_SYSTEM );?> </option>
													</select>
													<span  class="validation_alert" id="pay_status_alert"><?php _e("Please select one",WL_A_P_SYSTEM ); ?></span>
												</div>
												<div class="row cus-reg">
													<label> <?php _e("Location:",WL_A_P_SYSTEM );?>  </label>
													<select <?php staff_appoint_auth(); ?> name="location_id" id="appt_location_id"  class="form-control">
														<option value="0"><?php _e("--- Select Location ---",WL_A_P_SYSTEM );?> </option>
														<?php	
																												
															foreach($location_info as $location_data){
																?>
																	<option value="<?php echo $location_data->id; ?>"><?php echo $location_data->location_add; ?></option>
																<?php 
															}
														 	
														?>
													</select>
													<span  class="validation_alert" id="location_alert"><?php _e("Please select one",WL_A_P_SYSTEM ); ?></span>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button <?php staff_appoint_auth(); ?> type="button"  class="btn btn-info" id='save_appointment_details' onclick="return save_appointment();"><?php _e("Save",WL_A_P_SYSTEM );?> </button>
											<button <?php staff_appoint_auth(); ?> type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Cancel",WL_A_P_SYSTEM );?> </button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" id="update_appoin_model" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><?php _e("Edit Appointment",WL_A_P_SYSTEM );?> </h4>
									</div>
									<div id="fetch_appoint_model">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="mydiv" class="table-responsive">
					<form method="post" id="multi_del" name="multi_del" >
						<table  id="appointment_example" class="display" cellspacing="0" width="100%">
							<thead>
								<!-- <tr>
									<th>Select location</th>
									<th>
										<?php 
											//$locatoin_table = $wpdb->prefix."apt_location";
											//$q = 'select * from wp_apt_location' ;
											//$locations = $wpdb->get_results($q);
										?>
										<select id="location_appointment">
											<option>Select Location</option>
												<?php
													//foreach($locations as $locations_data){
												?>						
													<option value="<?php //echo $locations_data->id; ?>"><?php //echo $locations_data->location_add; ?></option>						
												<?php
													//}
												?>
										</select>
									</th>
								</tr> -->
								<tr>
									<th style="padding: 10px 12px;" class="nosort"><input type="checkbox" name="select_appointment" id="select_appointment" value=""> </th>
									<th class="sh_ow"><?php _e("Booking Id",WL_A_P_SYSTEM );?> </th>
									<th><?php _e("Appoinment Date",WL_A_P_SYSTEM );?> </th>
									<th><?php _e("Employee",WL_A_P_SYSTEM );?> </th>
									<th><?php _e("Client Name",WL_A_P_SYSTEM );?> </th>
									<th><?php _e("Service",WL_A_P_SYSTEM );?> </th>
									<th><?php _e("Status",WL_A_P_SYSTEM );?> </th>
									<th><?php _e("Contact",WL_A_P_SYSTEM );?> </th>
									<th class="nosort" ><?php _e("Action",WL_A_P_SYSTEM );?> </th>
								</tr>
							</thead>
						</table>
						<a <?php staff_appoint_auth(); ?> href="#"  class="appoint_delete btn btn-link"><i class="fas fa-trash-o" aria-hidden="true"></i><?php _e(" Delete",WL_A_P_SYSTEM );?> </a></td>
					</form>
				</div>
			</div>
<script>
	var dateToday = new Date();
	jQuery(function() {
		jQuery( ".a_date" ).datepicker({
			minDate: dateToday,
		 //beforeShowDay: DisableSpecificDates
		}); 
	}); 
	jQuery(document).ready(function(){
		jQuery('.clockpicker').clockpicker();
	});
</script>