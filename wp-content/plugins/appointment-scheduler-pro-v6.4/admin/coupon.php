<script>//CREATE NEW COUPON// multiple select checkboxjQuery(document).ready(function() {   jQuery('#select_coupon').click(function(event) {  //on click        if(this.checked) { // check select status            jQuery('.checkbox1').each(function() { //loop through each checkbox                this.checked = true;  //select all checkboxes with class "checkbox1"            });        }else{            jQuery('.checkbox1').each(function() { //loop through each checkbox                this.checked = false; //deselect all checkboxes with class "checkbox1"            });        }    });});function save_coupon(){		if(jQuery("#coupon_code").val()=="")	{		jQuery(".validation_alert").hide(); 	  		jQuery("#coupon_code_alert").show();		jQuery("#coupon_code").focus();		return false;	}		  	if(jQuery("#c_service_name").val()==null)	{		jQuery(".validation_alert").hide(); 		jQuery("#c_service_name_alert").show();		jQuery("#c_service_name").focus();		return false;	}	if(jQuery("#time_limit").val()=="")	{		jQuery(".validation_alert").hide(); 		jQuery("#time_limit_alert").show();		jQuery("#time_limit").focus();		return false;	}	else if(jQuery("#time_limit").val() < "0")	{		jQuery(".validation_alert").hide(); 		jQuery("#time_limit_alert_2").show();		jQuery("#time_limit").focus();		return false;	}	if(!jQuery.isNumeric(jQuery('#time_limit').val()))	{		jQuery(".validation_alert").hide(); 		jQuery("#time_limit_no_alert").show();		jQuery("#time_limit").focus();		return false;	}	if(jQuery("#per_user_limit").val()=="")	{		jQuery(".validation_alert").hide(); 		jQuery("#per_user_limit_alert").show(); 		jQuery("#per_user_limit").focus();		return false;	}	else if(jQuery("#per_user_limit").val() < "0")	{		jQuery(".validation_alert").hide(); 		jQuery("#per_user_limit_alert_2").show(); 		jQuery("#per_user_limit").focus();		return false;	}	if(!jQuery.isNumeric(jQuery("#per_user_limit").val()))	{		jQuery(".validation_alert").hide(); 		jQuery("#per_user_limit_no_alert").show(); 		jQuery("#per_user_limit").focus();		return false;	}	if(jQuery("#discount_type").val()=="")	{		jQuery(".validation_alert").hide(); 		jQuery("#discount_type_alert").show();		jQuery("#discount_type_alert_2").show();		jQuery("#discount_type").focus();		return false;	}	else if(jQuery("#discount_type").val() <"0")	{		jQuery(".validation_alert").hide(); 		jQuery("#discount_type_alert_2").show();		jQuery("#discount_type").focus();		return false;	}	if(jQuery("#discount_method").val()=="0")	{		jQuery(".validation_alert").hide(); 		jQuery("#c_discount_type_alert").show();		jQuery("#discount_method").focus();		return false;	}	if(jQuery("#coupon_start_date").val()=="")	{		jQuery(".validation_alert").hide(); 		jQuery("#coupon_start_date_alert").show();               // jQuery("#coupon_start_date").focus();              return false;          }          if(jQuery("#coupon_end_date").val()=="")          {          	jQuery(".validation_alert").hide();            	jQuery("#coupon_end_date_alert").show();               //jQuery("#coupon_end_date").focus();               return false;           }           var	coupon_time_limit=parseInt(jQuery('#time_limit').val());           var	per_user_limit=parseInt(jQuery('#per_user_limit').val());           if(coupon_time_limit < per_user_limit){           	jQuery.notify("<?php _e('No. of per person cannot be greater than No. of time used',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#fff", background: "#FF0000"});           }else{           	jQuery("#save_coupon_details").prop('disabled', true);           	jQuery('#save_coupon_details').html('<i class="fas fa-spinner fa-spin"></i><?php _e("Saving",WL_A_P_SYSTEM); ?> ');	           	jQuery.ajax({           		url: location.href,           		type: "POST",           		data: jQuery("form#ap_add_coupon").serialize(),           		dataType: "html",		//Do not cache the page		cache: false,		//success		success: function (html) {			jQuery("#save_coupon_details").prop('disabled', false);			jQuery('#save_coupon_details').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');			jQuery.notify("<?php _e('Coupon Created Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});			jQuery('form#ap_add_coupon')[0].reset();			jQuery('div#addcoupon').modal('hide');			jQuery('#coupon_use').DataTable().ajax.reload(null, false);		}	});   } }	//datatable on coupon	jQuery(document).ready(function() {		var table = jQuery('#coupon_use').DataTable( {			stateSave: true,			responsive: true,			ajax: ajaxurl+'?action=fn_my_coupon_dataloader_ajax',			"aoColumnDefs" : [			{ 'bSortable' : false, className: 'all', 'aTargets' : ['nosort'],},			{className: 'all', orderable: true, targets:['sh_ow']}			],			"language": {				"loadingRecords": "No Customer Add"			},		} );	} );			//fetch records on  model		jQuery(document).ready(function(){			jQuery('#update_coupon_model').on('show.bs.modal', function (e) {				var rowid = jQuery(e.relatedTarget).data('id');				jQuery.ajax({					type : 'post',					url : ajaxurl+'?action=coupon_ajax_request',              data :  'coupon_info='+ rowid, //Pass $id            success : function(data){            	jQuery('#fetch_coupon_con').html(data);			// console.log(data);		}	});			});			jQuery(document).ajaxComplete(function(){				var dateToday = new Date();				jQuery( "#u_coupon_start_date, #u_coupon_end_date" ).datepicker({					minDate: dateToday,				 //beforeShowDay: DisableSpecificDates				}); 			});		});// update recordsfunction update_coupon(){	if(jQuery("#u_coupon_code").val()=="")	{		jQuery(".validation_alert").hide();		jQuery("#u_coupon_code_alert").show();		jQuery("#u_coupon_code").focus();		return false;	}	if(jQuery("#u_service_name").val()==null)	{		jQuery(".validation_alert").hide();		jQuery("#u_service_name_alert").show();		jQuery("#u_service_name").focus();		return false;	}	if(jQuery("#u_time_limit").val()=="")	{		jQuery(".validation_alert").hide();		jQuery("#u_time_limit_alert").show();		jQuery("#u_time_limit").focus();		return false;	}	else if(jQuery("#u_time_limit").val() < "0")	{		jQuery(".validation_alert").hide();		jQuery("#u_time_limit_alert_2").show();		jQuery("#u_time_limit").focus();		return false;	}	if(!jQuery.isNumeric(jQuery('#u_time_limit').val()))	{		jQuery(".validation_alert").hide(); 		jQuery("#u_time_limit_no_alert").show();		jQuery("#u_time_limit").focus();		return false;	}	if(jQuery("#u_per_user_limit").val()=="")	{		jQuery(".validation_alert").hide();		jQuery("#u_per_user_limit_alert").show(); 		jQuery("#u_per_user_limit").focus();		return false;	}	else if(jQuery("#u_per_user_limit").val() < "0")	{		jQuery(".validation_alert").hide();		jQuery("#u_per_user_limit_alert_2").show(); 		jQuery("#u_per_user_limit").focus();		return false;	}	if(!jQuery.isNumeric(jQuery("#u_per_user_limit").val()))	{		jQuery(".validation_alert").hide(); 		jQuery("#u_per_user_limit_no_alert").show(); 		jQuery("#u_per_user_limit").focus();		return false;	}	if(jQuery("#u_discount_type").val()=="")	{		jQuery(".validation_alert").hide();		jQuery("#u_discount_type_alert").show();		jQuery("#u_discount_type").focus();		return false;	}	else if(jQuery("#u_discount_type").val() < "0")	{		jQuery(".validation_alert").hide();		jQuery("#u_discount_type_alert_2").show();		jQuery("#u_discount_type").focus();		return false;	}	if(jQuery("#u_discount_method").val()=="0")	{		jQuery(".validation_alert").hide();		jQuery("#c_discount_method_alert").show();		jQuery("#u_discount_method").focus();		return false;	}	if(jQuery("#u_coupon_start_date").val()=="")	{		jQuery(".validation_alert").hide();		jQuery("#u_coupon_start_date_alert").show();               // jQuery("#u_coupon_start_date").focus();              return false;          }          if(jQuery("#u_coupon_end_date").val()=="")          {          	jQuery(".validation_alert").hide();           	jQuery("#u_coupon_end_date_alert").show();               //jQuery("#u_coupon_end_date").focus();               return false;           }           var	coupon_time_limit=parseInt(jQuery('#u_time_limit').val());           var	per_user_limit=parseInt(jQuery('#u_per_user_limit').val());           if(coupon_time_limit < per_user_limit){           	jQuery.notify("<?php _e('No. of per person cannot be greater than No. of time used',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#fff", background: "#FF0000"});           }else{           	jQuery("#update_coupon_details").prop('disabled', true);           	jQuery('#update_coupon_details').html('<i class="fas fa-spinner fa-spin"></i><?php _e("Updating",WL_A_P_SYSTEM); ?>');           	jQuery.ajax({           		url: location.href,           		type: "POST",           		data: jQuery("form#ap_update_coupon").serialize(),           		dataType: "html",		//Do not cache the page		cache: false,		//success		success: function (html) {			jQuery("#update_coupon_details").prop('disabled', false);			jQuery('#update_coupon_details').html('<?php _e("Update",WL_A_P_SYSTEM); ?>');			jQuery.notify("<?php _e('Coupon Update Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});			jQuery('form#ap_update_coupon')[0].reset();			jQuery('div#update_coupon_model').modal('hide');			jQuery('#coupon_use').DataTable().ajax.reload(null, false);		}	});           }       }		//single delete		jQuery(document).on("click", '.del_coupon', function (event) {			var d_id = jQuery(this).attr('href');			var res = d_id.substring(1);			jQuery.confirm({				title: '<?php _e("Please Confirm",WL_A_P_SYSTEM); ?>',				theme: 'black',				content: '<?php _e("Are you sure to Delete Coupon",WL_A_P_SYSTEM); ?>?',				animation: 'rotate',				closeAnimation: 'rotateXR',				icon: 'far fa-check-square',				confirmButton: '<?php _e("Delete",WL_A_P_SYSTEM); ?>',				cancelButton: '<?php _e("Cancel",WL_A_P_SYSTEM); ?>',				confirm: function () {					jQuery.ajax({						data:"coupon_id="+res,						url: location.href,						type:"POST",						success:function(data)						{							jQuery.notify("<?php _e('Coupon Delete Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});	 							jQuery('#coupon_use').DataTable().ajax.reload(null, false);						}					})				},			});		});// multiple deletejQuery(function(){	jQuery("a.c_delete").click(function(){		ids=new Array()		a=0;		jQuery("#coupon_check:checked").each(function(i){			ids[i]=jQuery(this).val();		})		 if(ids.length == 0){ 			jQuery.notify("<?php _e('Please Select Atleast One Coupon To Delete',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"}); 		} 		else{		jQuery.confirm({			title: '<?php _e("Please Confirm",WL_A_P_SYSTEM); ?>',			theme: 'black',			content: '<?php _e("Are you sure to Delete Coupon",WL_A_P_SYSTEM); ?>?',			animation: 'rotate',			closeAnimation: 'rotateXR',			icon: 'far fa-check-square',			confirmButton: '<?php _e("Delete",WL_A_P_SYSTEM); ?>',			cancelButton: '<?php _e("Cancel",WL_A_P_SYSTEM); ?>',			confirm: function () {				jQuery(".c_delete").prop('disabled', true);				jQuery('.c_delete').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Deleting",WL_A_P_SYSTEM); ?>');						jQuery.ajax({					data:"multi_coupon_id="+ids,					url: location.href,					type:"POST",					success:function(res)					{						jQuery(".c_delete").prop('disabled', false);						jQuery('.c_delete').html('<?php _e("Delete",WL_A_P_SYSTEM); ?>');						jQuery.notify("<?php _e('Coupon Delete Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});							jQuery('#coupon_use').DataTable().ajax.reload(null, false);						jQuery('input[type=checkbox]').attr('checked',false); 						if(res==1)						{							jQuery("#coupon_check:checked").each(function(){								jQuery(this).parent.remove();							})						}					}				})			},		});	}return false;})});</script><?phpglobal $wpdb;if(isset($_REQUEST['coupon_code'])){	$coupon_code = sanitize_text_field( $_REQUEST['coupon_code'] ); 	//$service_name =sanitize_text_field($_REQUEST['service_name']);		$service_name =  implode("," , $_REQUEST['service_name']);		$time_limit = sanitize_text_field( $_REQUEST['time_limit'] );	$per_user_limit = sanitize_text_field( $_REQUEST['per_user_limit'] );	$discount_type = sanitize_text_field( $_REQUEST['discount_type'] );	$discount_method = sanitize_text_field( $_REQUEST['discount_method'] );	$startDate = sanitize_text_field( $_REQUEST['coupon_start_date'] );	$coupon_start_date = date("Y-m-d", strtotime($startDate));	$endDate = sanitize_text_field( $_REQUEST['coupon_end_date'] );	$coupon_end_date = date("Y-m-d", strtotime($endDate));		$wpdb->insert(		$wpdb->prefix.'apt_coupons',		array(			'coupon_code' => $coupon_code,			'service_name' => $service_name,			'time_limit' => $time_limit,			'per_user_limit' 	=> $per_user_limit,			'discount_type' => $discount_type,			'discount_method' => $discount_method,			'coupon_start_date' => $coupon_start_date,			'coupon_end_date' => $coupon_end_date,			));	$wpdb->show_errors();	$wpdb->print_error();	$coupon_id = $wpdb->id;			$wpdb->insert(		$wpdb->prefix.'apt_payment',		array(			'coupon_code_applied' => $coupon_id		));}if(isset($_REQUEST['delete_coupon'])){		echo $del= $_REQUEST['delete_user'];	$wpdb->delete( $wpdb->prefix.'apt_coupons', array( 'id' => $del ) ); }if(isset($_REQUEST['u_coupon_code'])){  	$coupon_use_id = sanitize_text_field( $_REQUEST['coupon_use_id'] );	$u_coupon_code = sanitize_text_field( $_REQUEST['u_coupon_code'] ); 	//$u_service_name =sanitize_text_field($_REQUEST['u_service_name']);		$u_service_name =  implode("," , $_REQUEST['u_service_name']);		$u_time_limit = sanitize_text_field( $_REQUEST['u_time_limit'] );	$u_per_user_limit = sanitize_text_field( $_REQUEST['u_per_user_limit'] );	$u_discount_type = sanitize_text_field( $_REQUEST['u_discount_type'] );	$u_discount_method = sanitize_text_field( $_REQUEST['u_discount_method'] );	$u_startDate = sanitize_text_field( $_REQUEST['u_coupon_start_date'] );	$u_coupon_start_date = date("Y-m-d", strtotime($u_startDate));	$u_endDate = sanitize_text_field( $_REQUEST['u_coupon_end_date'] );	$u_coupon_end_date = date("Y-m-d", strtotime($u_endDate));		$wpdb->update(		$wpdb->prefix.'apt_coupons',		array(			'coupon_code' => $u_coupon_code,			'service_name' => $u_service_name,			'time_limit' => $u_time_limit,			'per_user_limit' 	=> $u_per_user_limit,			'discount_type' => $u_discount_type,			'discount_method' => $u_discount_method,			'coupon_start_date' => $u_coupon_start_date,			'coupon_end_date' => $u_coupon_end_date,			),array('id'=>$coupon_use_id));	$wpdb->show_errors();	$wpdb->print_error();}//single deleteif(isset($_REQUEST['coupon_id'])){	$del=sanitize_text_field($_REQUEST['coupon_id']);	$wpdb->delete( $wpdb->prefix.'apt_coupons', array( 'id' => $del ));}// multi deleteif(isset($_REQUEST['multi_coupon_id'])){ 	$id_array =sanitize_text_field($_REQUEST['multi_coupon_id']);	$arr=explode(',',$id_array);	echo $id_count = count($arr);	for($i=0;$i<=$id_count;$i++)	{    		$del=$arr[$i];		$wpdb->delete( $wpdb->prefix.'apt_coupons', array( 'id' =>$del ) );		$wpdb->show_errors();		$wpdb->print_error();	}}?><div class="panel panel-default">	<div class="panel-heading"><i class="fas fa-gift"></i><span class="panel_heading"><?php _e('Coupon',WL_A_P_SYSTEM); ?></span>		<button class="btn theme-add-coupon" data-target="#addcoupon" data-toggle="modal" type="button"><i class="fas fa-plus" aria-hidden="true"></i><?php _e(' Add Coupon',WL_A_P_SYSTEM); ?></button>	</div>	<form style="margin-bottom: 0;" action="" method="POST" id="delete_all" name="delete_all">		<div class="panel-body">			<div id="mydiv" class="table-responsive">				<form method="post" id="multi_del" name="multi_del" >					<table  id="coupon_use" class="display" cellspacing="0" width="100%">						<thead>							<tr>								<th style="padding: 10px 12px;" class="nosort"><input type="checkbox" name="select_coupon" id="select_coupon" value=""></th>								<th class="sh_ow"><?php _e('Code',WL_A_P_SYSTEM); ?></th>								<th><?php _e('Service',WL_A_P_SYSTEM); ?></th>								<th><?php _e('Discount',WL_A_P_SYSTEM); ?></th>								<th><?php _e('Type',WL_A_P_SYSTEM); ?></th>								<th><?php _e('Per Person Can Use',WL_A_P_SYSTEM); ?></th>								<th><?php _e('No. Of Time Used:',WL_A_P_SYSTEM); ?></th>								<th><?php _e('Start Date',WL_A_P_SYSTEM); ?></th>								<th><?php _e('Expire Date',WL_A_P_SYSTEM); ?></th>								<th class="nosort" ><?php _e('Action',WL_A_P_SYSTEM); ?></th>							</tr>						</thead>					</table>				</form>			</div>			<div>				<a href="#" class="c_delete btn btn-link"><i class="fas fa-trash-o" aria-hidden="true"></i><?php _e(' Delete',WL_A_P_SYSTEM); ?></a></td>			</div>		</div>	</form></div><div class="modal fade" id="addcoupon" role="dialog">	<div class="modal-dialog">		<div class="modal-content">			<form style="margin-bottom: 0;" action="" method="POST" id="ap_add_coupon">				<div class="modal-header">					<h4 class="modal-title"><?php _e('Add Coupon',WL_A_P_SYSTEM); ?></h4>				</div>				<div class="modal-body">					<div class="form-group">						<div class="row cus-reg">							<div class="col-md-12 col-sm-12 col-xs-12 form-group">								<label><?php _e('Coupon Code:',WL_A_P_SYSTEM); ?> </label>								<input type="text" class="coupon form-control" name="coupon_code" id="coupon_code" placeholder="Add Coupon">								<span  class="validation_alert" id="coupon_code_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>							</div>						</div>						<div class="cus-reg" id="coupon_service_name">							<div class="row">								<label><?php _e('Service Name:',WL_A_P_SYSTEM); ?></label>								<select  name="service_name[]" multiple id="c_service_name" class="cat1" style=" width:100%;">									<optgroup label="<?php echo "Select Service";?>">										<?php foreach($appointment_category_details as $appointment_category_single_detail){ ?>										<optgroup label="<?php echo $appointment_category_single_detail->name;?>">											<?php $service_table=	$wpdb->prefix."apt_services";											$appointment_details = $wpdb->get_results( "SELECT * from $service_table where category= '$appointment_category_single_detail->id'");  											foreach($appointment_details as $appointment_single_detail){	?>											<option value="<?php echo $appointment_single_detail->id ?>"><?php echo $appointment_single_detail->name ?></option>											<?php } ?>										</optgroup>										<?php } ?>								</select>									<span  class="validation_alert" id="c_service_name_alert"><?php _e("Please select one",WL_A_P_SYSTEM ); ?></span>							</div>						</div>						<div class="row">							<div class="col-md-6 col-sm-12 col-xs-12 form-group">								<div class="row cus-reg">									<label><?php _e("No. of Total Time Used: ",WL_A_P_SYSTEM ); ?></label>									<input type="number" min="1" max="10001" class="a-time form-control" name="time_limit" id="time_limit">									<span  class="validation_alert" id="time_limit_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>									<span  class="validation_alert" id="time_limit_alert_2"><?php _e("Please Enter Positive Number",WL_A_P_SYSTEM ); ?></span>									<span  class="validation_alert" id="time_limit_no_alert"><?php _e("This field required number",WL_A_P_SYSTEM ); ?></span>								</div>							</div>							<div class="col-md-6 col-sm-12 col-xs-12 form-group">								<div class="row cus-reg">									<label><?php _e("No. of Per Person Used:",WL_A_P_SYSTEM ); ?></label>									<input type="number" min="1" max="10001" class="a-user form-control" name="per_user_limit" id="per_user_limit">									<span  class="validation_alert" id="per_user_limit_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>									<span  class="validation_alert" id="per_user_limit_alert_2"><?php _e("Please Enter positive number",WL_A_P_SYSTEM ); ?></span>									<span  class="validation_alert" id="per_user_limit_no_alert"><?php _e("This field required number",WL_A_P_SYSTEM ); ?></span>								</div>							</div>						</div>						<div class="row">							<div class="col-md-6 col-sm-12 col-xs-12 form-group">								<div class="cus-reg">									<label><?php _e("Discount:",WL_A_P_SYSTEM ); ?> </label>									<input type="text" class="a-discount form-control" name="discount_type" id="discount_type">									<span  class="validation_alert" id="discount_type_alert"><?php _e("This field is required",WL_A_P_SYSTEM); ?></span>									<span  class="validation_alert" id="discount_type_alert_2"><?php _e("Please Enter Positive Number ",WL_A_P_SYSTEM); ?></span>									<span  class="validation_alert" id="discount_type_no_alert"><?php _e("This field required number",WL_A_P_SYSTEM); ?></span>								</div>							</div>							<div class="col-md-6 col-sm-12 col-xs-12 form-group">								<div class="cus-reg">									<label><?php _e('Discount Type:',WL_A_P_SYSTEM); ?></label>									<select  name="discount_method" id="discount_method" class="cat1">										<option value="0" class="" selected="selected"><?php _e('-- Select Discount Type --',WL_A_P_SYSTEM); ?></option>										<option value="Flat"><?php _e("Flat Discount",WL_A_P_SYSTEM ); ?></option>										<option value="Percent"><?php _e("Percent Discount",WL_A_P_SYSTEM ); ?></option>									</select>									<span  class="validation_alert" id="c_discount_type_alert"><?php _e("Please select one",WL_A_P_SYSTEM ); ?></span>								</div>							</div>						</div>							<div class="cus-reg">							<div class="row">								<div class="col-md-6 col-sm-12 col-xs-12 form-group">									<label><?php _e("Starting Date:",WL_A_P_SYSTEM ); ?></label>									<input id="coupon_start_date" name="coupon_start_date"  class="form-control cs-date" type="text"/>									<span  class="validation_alert" id="coupon_start_date_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>								</div>								<div class="col-md-6 col-sm-12 col-xs-12 form-group">									<label><?php _e("Ending Date:",WL_A_P_SYSTEM ); ?> </label>									<input id="coupon_end_date" name="coupon_end_date"  class="form-control cs-date" type="text"/>									<span  class="validation_alert" id="coupon_end_date_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>								</div>							</div>						</div>					</div>				</div>				<div class="modal-footer">					<button  type="button" class="btn btn-info" id='save_coupon_details' onclick="return save_coupon();"><?php _e("Save",WL_A_P_SYSTEM ); ?></button>					<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Cancel",WL_A_P_SYSTEM ); ?></button>				</div>			</form>		</div>	</div></div><div class="modal fade" id="update_coupon_model" role="dialog">	<div class="modal-dialog">		<div class="modal-content" >			<div class="modal-header">				<h4 class="modal-title"><?php _e("Edit Coupon",WL_A_P_SYSTEM ); ?></h4>			</div>			<div class="col-md-12 modal-body" id="fetch_coupon_con">			</div>			<div class="modal-footer">				<button  type="button" class="btn btn-info"  id='update_coupon_details' onclick="return update_coupon();"><?php _e("Update",WL_A_P_SYSTEM ); ?></button>				<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Cancel",WL_A_P_SYSTEM ); ?></button>			</div>		</div>	</div></div><script>var dateToday = new Date();jQuery(function() {	jQuery( "#coupon_start_date, #coupon_end_date" ).datepicker({		minDate: dateToday,				 //beforeShowDay: DisableSpecificDates				}); }); </script>