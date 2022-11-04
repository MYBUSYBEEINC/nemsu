<script>
jQuery(window).load(function(){
	jQuery(document).on("click", '#fetch_location', function (event) {
		var d_id = jQuery( "#fetch_location" ).first().attr('href');
		// alert(d_id);
		var loc = d_id.substring(1);
		//alert("under load = " + loc);
		jQuery.ajax({
				data:"loc_show="+loc,
				url:ajaxurl+'?action=location_ajax_request', 
				type:"POST",
				success:function(data){
					jQuery('#'+loc).html(data);
				}
			})
	});
	jQuery('#fetch_location').click();
});
jQuery(document).on("click", '.fetch_location', function (event) {
	var d_id = jQuery(this).attr('href');
	//alert(d_id);
	var loc = d_id.substring(1);
	//alert("tar" + loc);
	jQuery.ajax({
		data:"loc_show="+loc,
		url:ajaxurl+'?action=location_ajax_request', 
		type:"POST",
		success:function(data){
			console.log(data);
			jQuery('#'+loc).html(data);
		}
	})	
});
function Save_location(){
	if(jQuery("#location_name").val()==""){
		jQuery("#location_name_alert").show();
		jQuery("#location_name").focus();
		return false;
	}
	jQuery(".save_service_location").prop('disabled', true);
	jQuery('.save_service_location').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Saving",WL_A_P_SYSTEM); ?>');
	jQuery.ajax({
		url: location.href,
		type: "POST",
		data: jQuery("form#loc_form").serialize(),
		dataType: "html",
		//Do not cache the page
		//success
		success: function (html) {
			jQuery(".save_service_location").prop('disabled', false);
			jQuery('.save_service_location').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');

			jQuery.notify("<?php _e('Location Created Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
			jQuery('form#loc_form')[0].reset();
			jQuery('div#addlocation').modal('hide');
			jQuery("#loc_table").load(location.href + " #loc_table");
			jQuery("#div_loc").load(location.href + " #div_loc");
			//jQuery("#cat_gallery").load(location.href + " #cat_gallery");
			//jQuery("#appoint_service").load(location.href + " #appoint_service");
			//jQuery("#coupon_service_name").load(location.href + " #coupon_service_name");
			//jQuery(".collapse").collapse('hide');			
		}
	});

}
//fetch records on location  model
jQuery(document).ready(function(){
	jQuery('#as_update_location').on('show.bs.modal', function (e) {
		var rowid = jQuery(e.relatedTarget).data('id');
	//alert(rowid);
		jQuery.ajax({
			type : 'post',
			url : ajaxurl+'?action=location_fetch_ajax_request',  
		    data :  'loc_fetch_info='+ rowid, //Pass $id
		    success : function(data){
				jQuery('#ap_fetch_record_location').html(data);
				//jQuery(".phone").intlTelInput();
				//console.log(data);
			}
		});
	});	
});
/*UPDATE THE LOCATION*/
function Update_loc(){
  if(jQuery("#u_location_name").val()=="")
	  {
	   jQuery("#u_location_name_alert").show();
       jQuery("#u_location_name").focus();
        return false;
    }
    jQuery(".update_appt_location").prop('disabled', true);
    jQuery('.update_appt_location').html('<i class="fas fa-spinner fa-spin"></i> <?php _e("Updating",WL_A_P_SYSTEM); ?>');
     jQuery.ajax({
    	url: location.href,
    	type: "POST",
    	data: jQuery("form#u_loc_form").serialize(),
    	dataType: "html",
    	success: function (html) {
		jQuery(".update_appt_location").prop('disabled', false);
		jQuery('.update_appt_location').html('<?php _e("Update",WL_A_P_SYSTEM); ?>');
		
		jQuery.notify("<?php _e('Location Updated Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
		jQuery('form#u_loc_form')[0].reset();
		jQuery('div#as_update_location').modal('hide');
		jQuery("#loc_table").load(location.href + " #loc_table");
	} 
  });
}

//location delete
jQuery(document).on("click", '.loc_del_id', function (event) {
	var d_id = jQuery(this).val();
	jQuery.confirm({
		title: '<?php _e("Please Confirm",WL_A_P_SYSTEM); ?>',
		theme: 'black',
		content: '<?php _e("Are you sure to Delete Location",WL_A_P_SYSTEM); ?>?',
		animation: 'rotate',
		closeAnimation: 'rotateXR',
		icon: 'far fa-check-square',
		confirmButton: '<?php _e("Delete",WL_A_P_SYSTEM); ?>',
		cancelButton: '<?php _e("Cancel",WL_A_P_SYSTEM); ?>',
		confirm: function () {
			jQuery.ajax({
				data:"loc_id="+d_id,
				url: location.href,
				type:"POST",
				success:function(data)
				{
					jQuery.notify("<?php _e('Location Deleted Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
					jQuery("#loc_table").load(location.href + " #loc_table");
				}
			})
		},
	});
});
	
//save location based service
function save_loc_service(location_id){
	// var loc_office_status = jQuery('#loc_office_status').val();
	var location_id = location_id;
	//alert(location_id);
	var loc_tag_line = jQuery("#loc_tag_line").val();
	var loc_phone_no = jQuery("#loc_phone_no").val();
	var loc_email = jQuery("#loc_email").val();
	var loc_biz_add = jQuery("#loc_biz_add").val();
	var form_id = "location_form_"+location_id;
	alert(form_id);
	if(loc_tag_line ==""){
		jQuery("#loc_tag_line_alert").show();
		jQuery("#loc_tag_line").focus();
		return false;
	}
	if(loc_phone_no ==""){
		jQuery("#loc_phone_no_alert").show();
		jQuery("#loc_phone_no").focus();
		return false;
	}
	if(loc_email ==""){
		jQuery("#loc_email_alert").show();
		jQuery("#loc_email").focus();
		return false;
	}
	if(loc_biz_add ==""){
		jQuery("#loc_biz_add_alert").show();
		jQuery("#loc_biz_add").focus();
		return false;
	}

	//alert(location_id);
	jQuery.ajax({
		url: location.href,
		type: "POST",
		data: jQuery("form#form_id").serialize(),            	
		dataType: "html",
		success: function (html) {
			jQuery(".save_loc_id").prop('disabled', false);
			jQuery('.save_loc_id').html('<?php _e("Save",WL_A_P_SYSTEM); ?>');
			console.log(html);
			jQuery.notify("<?php _e('Saved Successfully',WL_A_P_SYSTEM); ?>", {type:"success",icon:"check",align:"center", verticalAlign:"middle",color: "#3c763d", background: "#dff0d8"});
		} 
	});
}

</script>
<?php 
	global $wpdb;
	$location_table = $wpdb->prefix.'apt_location';
	// Add New Location Name
	if(isset($_REQUEST['location_name'])){
			$category_name=sanitize_text_field($_REQUEST['location_name']);
			$category_icon=sanitize_text_field($_REQUEST['category_icon']);
			$wpdb->insert(
			$wpdb->prefix.'apt_location',
			array('location_add' => $category_name,
		));
	}
	//fetch location
	$ap_fetch_loc=$wpdb->get_results("select * from $wpdb->prefix"."apt_location");	
	//update location
	if(isset($_REQUEST['u_location_name'])){
		$u_location_name = sanitize_text_field($_REQUEST['u_location_name']);
		$update_location_value = sanitize_text_field($_REQUEST['update_location_value']);
		$wpdb->update($location_table,array('location_add' => $u_location_name),array('id'=>$update_location_value));
	}
	// DELETE THE LOCATION
	if(isset($_REQUEST['loc_id'])){
		$loc_id = sanitize_text_field($_REQUEST['loc_id']);
		$wpdb->delete( $location_table, array( 'id' => $loc_id ) );
	}
	//save data accroding to location 
	 if(isset($_POST['loc_office_status'])){	
	 	$servicetable= $wpdb->prefix."apt_services";
	 	$category1 = array();
		if(isset($_REQUEST['location_services'])){
			if(isset($_REQUEST['location_cate_service'])){
				$category1 =  $_REQUEST['location_cate_service'];
				$serialize_category1 = serialize($category1);
				$location_services 	   =  $_REQUEST['location_services'];
				$serialize_location_service = serialize($location_services);
				//print_r($category1);
			}
			else{
					$location_services = $_REQUEST['location_services'];
					$serialize_location_service = serialize($location_services);
					$temp_loc = $_REQUEST['location_services'];	 
					$num = count($temp_loc);
					//$category1 = array();
					for($i=0;$i<$num;$i++){
					 	$j = $temp_loc[$i];
					  $getcat = $wpdb->get_results("select category from $servicetable where id = '$j'");
					  foreach($getcat as $temp_cat){
					  	if(!in_array($temp_cat->category,$category1)){
					  		array_push($category1, $temp_cat->category);
					  	}	
					  }					
					}
					$serialize_category1 = serialize($category1);					
				}				
		}		
		 
		 $loc_office_status = sanitize_text_field($_POST['loc_office_status']);
		 $location_id 		= sanitize_text_field($_POST['location_id']);	
		 $loc_biz_name		= sanitize_text_field($_POST['loc_biz_name']);
		 $loc_tag_line 		= sanitize_text_field($_POST['loc_tag_line']);
		 $loc_phone_no 		= sanitize_text_field($_POST['loc_phone_no']);
		 $loc_email 		= sanitize_text_field($_POST['loc_email']);
		 $loc_fax 			= sanitize_text_field($_POST['loc_fax']);
		 $loc_blog 			= sanitize_text_field($_POST['loc_blog']);
		 $loc_postal 		= sanitize_text_field($_POST['loc_postal']);
		 $loc_biz_add   	= sanitize_text_field($_POST['loc_biz_add']);
		 $loc_message		= sanitize_text_field($_POST['loc_message']);
		 // print_r($service_name);
		$serialized_info = serialize(array($loc_tag_line,$loc_phone_no,$loc_email,$loc_fax,$loc_blog,$loc_postal,$loc_biz_add,$loc_biz_name));
		$wpdb->update($location_table, array('status' => $loc_office_status, 'location_detail'=>$serialized_info, 'location_service_cat'=>$serialize_category1, 'location_service'=>$serialize_location_service, 'message'=>$loc_message), array('id'=>$location_id));
		
		if(isset($_REQUEST['bh_hour'])){
			
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
			$business_hours = array(
				'bh_sunday'=>serialize($sunday_setting),
				'bh_monday'=>serialize($monday_setting),
				'bh_tuesday'=>serialize($tuesday_setting),
				'bh_wednesday'=>serialize($wednesday_setting),
				'bh_thursday'=>serialize($thursday_setting),
				'bh_friday'=>serialize($friday_setting),
				'bh_saturday'=>serialize($saturday_setting),
			);
			update_option("weblizar_aps_business_$location_id", $business_hours);
		}
}	
/*Service display settings*/
	$current_user = wp_get_current_user();
	$role = $current_user->roles;
	$current_role = $role[0];
	$data_0 = get_option('weblizar_aps_staff_dashboard_settings');
 	$weblizar_aps_staff_dashboard = get_option("weblizar_aps_staff_dashboard_settings");
 	$weblizar_aps_loc_view = $weblizar_aps_staff_dashboard['staff_loc_setting'];
 	//print_r($weblizar_aps_staff_dashboard);
 	$loc_edit = $weblizar_aps_staff_dashboard['loc_edit'];
 
 	//if($current_role != "administrator" && $loc_edit == "yes")
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fas fa-server"></i><span class="panel_heading"><?php _e("Location",WL_A_P_SYSTEM ); ?></span>
	</div>
	<div class="panel-body" id="location_div">
		<div class="app-loc" >
			<ul class="nav nav-tabs" id="loc_table" >
				<li class="cat-all active">
					<a data-toggle="tab" href="#all" class="service_cate_list">
						<span><i class="fas fa-th-list"></i>&nbsp;&nbsp;<?php _e("Location Name",WL_A_P_SYSTEM ); ?></span>
					</a>
				</li>
				<?php foreach($ap_fetch_loc as $loc_value){ ?>
				<li>
					<a data-toggle="tab" href="#<?php echo 'loc'.$loc_value->id?>" class="fetch_location" id="fetch_location">
						<span> <?php echo $loc_value->location_add; ?> </span>
						<?php
							$loc_id	= $loc_value->id;
							if($current_role != "administrator"){
								if($weblizar_aps_loc_view == 'yes'){
									if($loc_edit == 'no'){
									?>
									<button type="button" class="btn del-link" data-toggle="modal" data-id="<?php echo $loc_value->id;?>" data-target="#as_update_location" disabled><i class="fas fa-pen"></i></button>
									<?php
									}
									else if($loc_edit == 'yes'){
										?>
											<button type="button" class="btn del-link" data-toggle="modal" data-id="<?php echo $loc_value->id;?>" data-target="#as_update_location"><i class="fas fa-pen"></i></button>
										<?php
										if($loc_id !=='1'){ ?>
											<button class="loc_del_id btn del-link" value="<?php echo $loc_value->id?>"><i class="fas fa-times"></i></button>
										<?php } 
									}
								}
							}							
							else if($current_role == "administrator"){
								?>
								<button type="button" class="btn del-link" data-toggle="modal" data-id="<?php echo $loc_value->id;?>" data-target="#as_update_location"><i class="fas fa-pen"></i></button>
								<?php
										if($loc_id !=='1'){ ?>
									<button class="loc_del_id btn del-link" value="<?php echo $loc_value->id?>"><i class="fas fa-times"></i></button>
								<?php } 
							}
						?>
						<!-- <button type="button" class="btn del-link" data-toggle="modal" data-id="<?php echo $loc_value->id;?>" data-target="#as_update_location"><i class="fas fa-pen"></i></button> -->

						
					</a>
				</li>
				<?php } ?>
			</ul>
			<?php
			if($current_role != "administrator"){
				if($weblizar_aps_loc_view == 'yes'){
					if($loc_edit == 'no'){
						echo "";
					}
					else if(($current_role != "administrator" && $loc_edit == 'yes') || $current_role == "administrator"){
						?>
							<button id="add_loc_cation" type="button" class="btn btn-link" data-toggle="modal" data-target="#addlocation"><span><i class="fas fa-plus" aria-hidden="true"></i><?php _e(" Add Location",WL_A_P_SYSTEM ); ?></span></button>
						<?php
					}
				}
			}
			else{
				?>
					<button id="add_loc_cation" type="button" class="btn btn-link" data-toggle="modal" data-target="#addlocation"><span><i class="fas fa-plus" aria-hidden="true"></i><?php _e(" Add Location",WL_A_P_SYSTEM ); ?></span></button>
				<?php
			}				
			?>
			<!-- <button id="add_loc_cation" type="button" class="btn btn-link" data-toggle="modal" data-target="#addlocation"><span><i class="fas fa-plus" aria-hidden="true"></i><?php _e(" Add Location",WL_A_P_SYSTEM ); ?></span></button> -->
			<!--Add New Location Name -->
			<div class="modal fade" id="addlocation" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content" id="set_model">
						<div class="modal-body">
							<form id="loc_form" method="post">
								<input type="text" name="location_name" id="location_name" class="form-control" placeholder="Location Name"/>
								<span  class="validation_alert" id="category_name_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
								<input class="regular-text" type="hidden" id="icon_picker_example_icon1" name="category_icon" value="dashicons dashicons-category" readonly="readonly"/>
								<label id="icon_label"><?php _e("Select Icon",WL_A_P_SYSTEM ); ?></label>
								<div id="preview_icon_picker_example_icon1" data-target="#icon_picker_example_icon1" class="button icon-picker dashicons dashicons-category" ></div>
								<div>
									<button id="#btn3" name="add" type="button" class="btn location-link save_service_category" onclick="return Save_location();"><?php _e("Save",WL_A_P_SYSTEM ); ?></button>
									<button type="reset" name="cancel" class="btn cat-link" data-dismiss="modal"><?php _e("Cancel",WL_A_P_SYSTEM ); ?></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Update The location -->
			<div class="modal fade" id="as_update_location" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content" id="set_model">
						<div class="modal-body">
							<div id="ap_fetch_record_location">

							</div>
							<div>
								<button id="#btn4" name="add" type="button" class="btn cat-link update_appt_location" onclick="return Update_loc();"><?php _e("Update",WL_A_P_SYSTEM ); ?></button>
								<button type="reset" name="cancel" class="btn cat-link" data-dismiss="modal"><?php _e("Cancel",WL_A_P_SYSTEM ); ?></button>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="app-location-detail">
			<div class="tab-content" id="div_loc">
				<?php 
					foreach($ap_fetch_loc as $loc_city){?>
						<?php $loc_city->id; ?>
							<div id="<?php echo 'loc'.$loc_city->id ?>" class="tab-pane fade">
								
							</div>
						<?php 
					}
				?>
				<!-- <div class=""></div> -->
			</div>
		</div>
	</div>
</div>
<style>
	.app-loc{
		float: left;
		width: 22%;
	}
	.app-loc {
	    display: inline-block;
	    float: left;
	    padding: 10px;
	    width: 22%;
	}
	.app-location-detail{
		float: left;
		width: 77%;
	}

	.app-loc .nav-tabs li {
		width: 100%;
	    font-size: 18px;
	    border-bottom: 1px solid rgb(231, 231, 231)
	}	
	.app-loc .nav-tabs li a:hover, .app-loc .nav-tabs li:hover a {
    background-color: rgb(51, 122, 183);
    color: rgb(255, 255, 255) !important;
}
	.app-loc .nav-tabs li:hover, .app-loc .nav-tabs li a:hover, .app-loc .nav-tabs li:hover a {
		background-color: rgb(51, 122, 183);
		color: rgb(255, 255, 255) !important;
	}
	.app-loc .del-link, .app-loc .del-link:hover {
	    float: none !important;
	}

	.loc-all {
	    background-color: rgb(51, 122, 183) !important;
	    /* color: rgb(255, 255, 255) !important; */
	}
	.app-loc .del-link, .app-loc .del-link:hover {
	    background-color: rgb(51, 122, 183);
	    border: 1px solid;
	    color: rgb(255, 255, 255);
	    display: inline-block;
	    float: right;
	    font-size: 15px;
	    margin: 0;
	    margin-top: 10px !important;
	    padding: 3px 5px !important;
	}
	.app-loc .del-link, .app-loc .del-link:hover {
	    float: none !important;	    
	}
	
	.app-loc .nav-tabs li span {
		display: inline-block;
		float: left;
		margin-right: 0;
		width: 85%;
	}

	#div_loc .ap-sercs-name {
	    display: inline-block;
	    width: 30%;
	    float: left;
	    min-height: 40px;
	    margin-right: 10px;
	    margin-left: 30px;
	}
</style>