<script>
	jQuery('.clockpicker').clockpicker();

/* to show hide message block according to status */
// loc_office_status
// loc_reason_message
jQuery(document).ready(function(){
    jQuery('.loc_office_status').on('change', function(){
        var val = jQuery(this).val();
        if(val == "close" || val == "vaction"){
        	jQuery(".loc_reason_message").show();
        }
        else{
        	jQuery(".loc_reason_message").hide();
        }
    });
});
</script>
<?php
	global $wpdb; 
	$service_table = $wpdb->prefix.'apt_service';
	$location_table = $wpdb->prefix.'apt_location';
	if(isset($_REQUEST['loc_show'])){
		 $loc_show = substr($_REQUEST['loc_show'], 3);			
	}
	
	$ap_fetch_location_based=$wpdb->get_results("select * from $wpdb->prefix"."apt_location WHERE id = $loc_show ");
	$current_user = wp_get_current_user();
	//print_r($current_user);
	$current_staff_email = $current_user->user_email;
	$role = $current_user->roles;
	$current_role = $role[0];
	$weblizar_aps_staff_dashboard = get_option("weblizar_aps_staff_dashboard_settings");
	$weblizar_aps_loc_view = $weblizar_aps_staff_dashboard['staff_loc_setting'];
 	// print_r($weblizar_aps_staff_dashboard);
 	$loc_edit = $weblizar_aps_staff_dashboard['loc_edit'];
?>
<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<div class="ser-name"> 
					<?php foreach($ap_fetch_location_based as $locdata){ ?>
						<span><?php echo $locdata->location_add; ?></span>
					<?php } ?>					
				</div>
			</h4>
			</div>
		<div class="panel-body">
				<div class="row ad-ser loc-short">
					<div class="col-md-6 col-sm-12 col-xm-12 form-group">
						<label><?php echo "Copy the shortcodeFor Location".$loc_show; ?> </label>							
					</div>
					<div class="col-md-3 col-sm-12 col-xm-12 form-group">
						<code><?php echo "[appointment id=$loc_show]"; ?></code>						
					</div>	
				</div>	
			 <form method="post" name="location_form_<?php echo $loc_show; ?>" id="location_form_<?php echo $loc_show; ?>">
			 	<?php foreach($ap_fetch_location_based as $locdata){ 
			 		$status =  $locdata->status;			 		
			 		if(!empty($locdata->message)){
			 			$message = $locdata->message;
			 		}
			 		else{
			 			$message = "Just Vacation";
			 		}
			 	?>
			 	<input type="hidden" name="location_id" id="location_id" value="<?php echo $loc_show; ?>" /> 
				<div class="row ad-ser">
					<div class="col-md-6 col-sm-12 col-xm-12 form-group">
						<label><?php _e("Status:",WL_A_P_SYSTEM );?> </label>							
					</div>
					<div class="col-md-3 col-sm-12 col-xm-12 form-group">
						<select class="form-control loc_office_status" name="loc_office_status" id="loc_office_status_<?php echo $loc_show; ?>" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> >
							<option value="open"  <?php echo ($status == "open") ?"selected":"" ?>>Open</option>
							<option value="close" <?php echo ($status == "close") ?"selected":"" ?>>Close</option>
							<option value="vaction" <?php echo ($status == "vaction") ?"selected":"" ?>>Vacation</option>
						</select>
					</div>	
				</div>			
				<div class="row loc_reason_message" id="loc_reason_message" <?php if($status == "close" || $status == "vaction") {?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?>>
					<div class="col-md-6 col-sm-12 col-xm-12 form-group">
						<label><?php _e("Close/Vacation Message:",WL_A_P_SYSTEM );?> </label>							
					</div>
					<div class="col-md-6">
						<textarea name="loc_message" id="loc_message" class="loc_message my_st_class" ><?php echo $message; ?></textarea>
					</div>
				</div>
			<?php 
				/* local business detail and default value */
				$uns_service = unserialize($locdata->location_detail);				
				if(!empty($uns_service[7])){
					$loc_biz_name = $uns_service[7];
				}
				else{
					$loc_biz_name = "Business";
				}
				
				if(!empty($uns_service[0])){
					$loc_biz_tagline = $uns_service[0];
				}
				else{
					$loc_biz_tagline = "Tag Line";
				}
				
				if(!empty($uns_service[1])){
					$loc_biz_phoneno = $uns_service[1];
				}
				else{
					$loc_biz_phoneno = "9876543210";
				}
				
				if(!empty($uns_service[2])){
					$loc_biz_email = $uns_service[2];
				}
				else{
					$loc_biz_email = "biz@gmail.com";
				}
				
				if(!empty($uns_service[3])){
					$loc_biz_faxno = $uns_service[3];
				}
				else{
					$loc_biz_faxno = "011-987-654-321";
				}
				
				if(!empty($uns_service[4])){
					$loc_biz_blogname=  $uns_service[4];
				}
				else{
					$loc_biz_blogname=  "biz@blogspot.com";
				}
				
				if(!empty($uns_service[5])){
					$loc_biz_pincode = $uns_service[5];
				}
				else{
					$loc_biz_pincode = "654321";
				}
				
				if(!empty($uns_service[6])){
					$loc_biz_add = $uns_service[6];
				}
				else{
					$loc_biz_add = "17/18, 6443 Adligenswil,Switzerland";
				}			
			?>	

			<div class="row ad-ser">						
				<div class="col-md-6 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Services:",WL_A_P_SYSTEM );?> </label>							
				</div>				
				<div class="col-md-12 col-sm-12 col-xm-12 form-group">
					<div clas="row">
						<div class="col-md-12">	
						<?php 
						$loc_data = $wpdb->get_results("select * from $location_table where id = '$loc_show'");
						// to get location's category and service 			
						foreach($loc_data as $loc_cat){
							$loc_cat = unserialize($loc_cat->location_service_cat);
						}
						//to get service
						foreach($loc_data as $loc_service){
							$loc_service = unserialize($loc_service->location_service);
						}
						$ap_fetch_service_cat=$wpdb->get_results("select * from $wpdb->prefix"."apt_category");
						foreach( $ap_fetch_service_cat as $ap_fetch_service_cat_single ) { ?>
									<?php $ap_fetch_service_staff=$wpdb->get_results("select * from $wpdb->prefix"."apt_services where category='$ap_fetch_service_cat_single->id'");?>
									<?php if($ap_fetch_service_staff != null){ ?>
										<div class="col-md-12 col-sm-12 col-xs-12 form-group apt_services_category">
										 <div class="row ap-serv">
											 <input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="checkbox" class="apt_category_checkbox apt_category_<?php echo $ap_fetch_service_cat_single->id ?> my_st_class" data-category-id="<?php echo $ap_fetch_service_cat_single->id ?>" name="location_cate_service[]" value="<?php echo $ap_fetch_service_cat_single->id; ?>" 
										 <?php 
										   foreach($loc_data as $loc_cat){
										   	$loc_cat = unserialize($loc_cat->location_service_cat);
										 	$no_of_category = count($loc_cat);
										   		for($i = 0; $i<$no_of_category; $i++){
													$j = $loc_cat[$i];
										 	 if($ap_fetch_service_cat_single->id == $j){ 
												echo "checked='checked'";
											} 											
										}
									   } ?> data-toggle="tooltip" title="Select all service" />
												<span class="s-ser"><strong><?php echo $ap_fetch_service_cat_single->name ?> </strong></span>
											</div>										
											
											<?php foreach($ap_fetch_service_staff as $ap_fetch_service_staff_single ) { ?>											
												<div class=" form-group apt_category_services">
													<div class="ap-sercs-name">
														<label><strong></strong></label>
														<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="checkbox" class="ab_service_checkbox apt_category_<?php echo $ap_fetch_service_staff_single->category?> my_st_class" 
														data-category-id="<?php echo $ap_fetch_service_staff_single->category?>"
														 name="location_services[]" 
														 value="<?php  echo $ap_fetch_service_staff_single->id; ?>"
														<?php
														  // $ser_cat = explode(",",$staff_single_member_name->staff_services); 
														 foreach($loc_data as $loc_service){
														 	$loc_service = unserialize($loc_service->location_service);
														 	$no_of_services = count($loc_service);
															for($k=0;$k<$no_of_services; $k++){
														 if($ap_fetch_service_staff_single->id==$loc_service[$k] ){
														 	echo "checked='checked'";
														 } 
														} 
													}?> />
														<span class="s-ser"><?php echo $ap_fetch_service_staff_single->name?></span>											
													</div>
												</div>
												<div class="clearfix"></div>
											<?php } ?>
									  </div>
									<?php }
								 } ?>
									<!-- <span class="validation_alert" id="staff_service_alert"><?php _e("You must select at least 1 service",WL_A_P_SYSTEM ); ?></span> -->										
						</div>	
					</div>
				</div>
			</div>

			<div class="row ad-ser">
				
				<div class="col-md-6 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Business Name:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 form-group">
					<input type="text" name="loc_biz_name" id="loc_biz_name" class="form-control" value="<?php echo $loc_biz_name; ?>" placeholder="Business Name" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?>/>
					<span  class="validation_alert" id="loc_biz_name_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
				</div>
			</div>
			
			<div class="row ad-ser">
				
				<div class="col-md-6 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Tag Line:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 form-group">
					<input type="text" name="loc_tag_line" id="loc_tag_line" class="form-control" value="<?php echo $loc_biz_tagline; ?>" placeholder="Title or tag Line" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?>/>
					<span  class="validation_alert" id="loc_tag_line_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
				</div>
			</div>
			<div class="row ad-ser">
				<div class="col-md-12 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Contact Detail:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Phone No:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 form-group">
					<input type="tel" name="loc_phone_no" id="loc_phone_no" class="phone form-control" value="<?php echo $loc_biz_phoneno; ?>" placeholder="Phone No" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?>/>
					<span  class="validation_alert" id="loc_phone_no_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
				</div>
				<div class="col-md-12 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Email Address:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 form-group">
					<input type="text" name="loc_email" id="loc_email" class="form-control" value="<?php echo $loc_biz_email; ?>" placeholder="Business Email" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?>/>
					<span  class="validation_alert" id="loc_email_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
				</div>

				<div class="col-md-12 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Fax No:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 form-group">
					<input type="text" name="loc_fax" id="loc_fax" class="form-control" value="<?php echo $loc_biz_faxno; ?>" placeholder="Fax No" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?>/>
					<!-- <span  class="validation_alert" id="loc_email_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span> -->
				</div>

				<div class="col-md-12 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Blog URL:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 form-group">
					<input type="text" name="loc_blog" id="loc_blog" class="form-control" value="<?php echo $loc_biz_blogname; ?>" placeholder="Blog Url" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?>/>
					<!-- <span  class="validation_alert" id="loc_email_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span> -->
				</div>

				<div class="col-md-12 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Postal Code:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 form-group">
					<input type="text" name="loc_postal" id="loc_postal" class="form-control" value="<?php echo $loc_biz_pincode; ?>" placeholder="Postal Code" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?>/>
					<!-- <span  class="validation_alert" id="loc_email_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span> -->
				</div>

			</div>
			<div class="row ad-ser">
				<?php
					$loc_biz_add_wr = preg_replace('/\s+/', ' ', $loc_biz_add);
				 ?>
				<div class="col-md-6 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Address:",WL_A_P_SYSTEM );?> </label>							
				</div>
				<div class="col-md-12 form-group">
					<textarea class="form-control" name="loc_biz_add" id="loc_biz_add" placeholder="Business Address" <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?>><?php echo $loc_biz_add_wr; ?></textarea>
					<span  class="validation_alert" id="loc_biz_add_alert"><?php _e("This field is required",WL_A_P_SYSTEM ); ?></span>
				</div>
			</div>		
			<div class="row ad-ser">
				<div class="col-md-6 col-sm-12 col-xm-12 form-group">
					<label><?php _e("Operating Hours:",WL_A_P_SYSTEM );?> </label>							
				</div>			
				<div class="col-md-12">
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
									<?php  $settings_bh_monday_st = get_option("weblizar_aps_business_$loc_show");
									$monday = unserialize($settings_bh_monday_st['bh_monday']);
									if(empty($monday)){
										$monday_st = "10:00";
										$monday_et = "18:00";
									}
									else{
										$monday_st = $monday[0]['start_time'];;
										$monday_et = $monday[0]['end_time'];
									}
									?>
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_monday_st" id="bh_monday_st" value="<?php echo $monday_st;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
								<td class="end-tm">
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_monday_et" id="bh_monday_et"  value="<?php echo $monday_et;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="day"> <?php _e('Tuesday',WL_A_P_SYSTEM); ?></td>
								<td class="start-tm">
									<?php $settings_bh_tuesday_st = get_option("weblizar_aps_business_$loc_show"); 
									$tuesday= unserialize($settings_bh_tuesday_st['bh_tuesday']);
									if(empty($tuesday)){
										$tuesday_st = "10:00";
										$tuesday_et = "18:00";
									}
									else{
										$tuesday_st = $tuesday[0]['start_time'];;
										$tuesday_et = $tuesday[0]['end_time'];
									}
									?>
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_tuesday_st" id="bh_tuesday_st" value="<?php echo $tuesday_st;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
								<td class="end-tm">
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_tuesday_et" id="bh_tuesday_et" value="<?php  echo $tuesday_et;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="day"> <?php _e('Wednesday',WL_A_P_SYSTEM); ?></td>
								<td class="start-tm">
									<?php $settings_bh_wednesday_st = get_option("weblizar_aps_business_$loc_show"); 
									$wednesday= unserialize($settings_bh_wednesday_st['bh_wednesday']);
									if(empty($wednesday)){
										$wednesday_st = "10:00";
										$wednesday_et = "18:00";
									}
									else{
										$wednesday_st = $wednesday[0]['start_time'];;
										$wednesday_et = $wednesday[0]['end_time'];
									}
									?>
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_wednesday_st" id="bh_wednesday_st" value="<?php echo $wednesday_st;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
								<td class="end-tm">
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_wednesday_et" id="bh_wednesday_et" value="<?php echo $wednesday_et;?>" class="time_show form-control floating-label" placeholder="Time">
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
									$settings_bh_thursday_st = get_option("weblizar_aps_business_$loc_show"); 
									$thursday= unserialize($settings_bh_thursday_st['bh_thursday']);
									if(empty($thursday)){
										$thursday_st = "10:00";
										$thursday_et = "18:00";
									}
									else{
										$thursday_st = $thursday[0]['start_time'];;
										$thursday_et = $thursday[0]['end_time'];
									}
									?>
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_thursday_st" id="bh_thursday_st" value="<?php  echo $thursday_st;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>

								</td>
								<td class="end-tm">
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_thursday_et" id="bh_thursday_et" value="<?php echo $thursday_et;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
								
							</tr>
							<tr>
								<td class="day"> <?php _e('Friday',WL_A_P_SYSTEM); ?></td>
								<td class="start-tm">
									<?php $settings_bh_friday_st = get_option("weblizar_aps_business_$loc_show");; 
									$friday	= unserialize($settings_bh_friday_st['bh_friday']);
									if(empty($friday)){
										$friday_st = "10:00";
										$friday_et = "18:00";
									}
									else{
										$friday_st = $friday[0]['start_time'];;
										$friday_et = $friday[0]['end_time'];
									}
									?>	
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_friday_st" id="bh_friday_st" value="<?php echo $friday_st;?>" class=" time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
								<td class="end-tm">
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_friday_et" id="bh_friday_et" value="<?php echo $friday_et;?>" class=" time_show form-control floating-label" placeholder="Time">
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
									$settings_bh_saturday_st = get_option("weblizar_aps_business_$loc_show");
									$saturday =  unserialize($settings_bh_saturday_st['bh_saturday']);																			
									if(empty($saturday)){
										$saturday_st = "10:00";
										$saturday_et = "18:00";
									}
									else{
										$saturday_st = $saturday[0]['start_time'];;
										$saturday_et = $saturday[0]['end_time'];
									}
									?>

									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_saturday_st" id="bh_saturday_st" value="<?php  echo $saturday_st;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
								<td class="end-tm">
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_saturday_et" id="bh_saturday_et" value="<?php  echo $saturday_et;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
								
							</tr>
							<tr>
								<td class="day"> <?php _e('Sunday',WL_A_P_SYSTEM); ?></td>
								<td class="start-tm">
									<?php $settings_bh_sunday_st = get_option("weblizar_aps_business_$loc_show"); 
									$sunday	= unserialize($settings_bh_sunday_st['bh_sunday']);
									if(empty($sunday)){
										$sunday_st = "10:00";
										$sunday_et = "18:00";
									}
									else{
										$sunday_st = $sunday[0]['start_time'];;
										$sunday_et = $sunday[0]['end_time'];
									}
									?>
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_sunday_st" id="bh_sunday_st" value="<?php echo $sunday_st;?>" class="time_show form-control floating-label" placeholder="Time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</td>
								<td class="end-tm">
									<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
										<input <?php if($current_role != "administrator" && $loc_edit == "no") {echo "disabled"; } ?> type="text" name="bh_sunday_et" id="bh_sunday_et" value="<?php echo $sunday_et;?>" class=" time_show form-control floating-label" placeholder="Time">
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
			</div>

			<div class="row ad-ser">
				<div class="col-md-12 col-sm-12 col-xm-12 form-group">
					<div class="form-group">
						<?php
						if($current_role != "administrator"){
						
							if($weblizar_aps_loc_view == 'yes'){
								if($loc_edit == 'no'){
									echo "";
								}
								else if($loc_edit == 'yes'){
									?>
										<input type="submit" name="loc_sub" class="btn ser-btn"  value="Save"/>
										<button class="btn ser-btn" data-toggle="collapse" data-parent=".accordion" ><?php _e("Cancel",WL_A_P_SYSTEM);?></button>
									<?php
								}
							}
						}
						else{
							?>
							<input type="submit" name="loc_sub" class="btn ser-btn"  value="Save"/>
							<button class="btn ser-btn" data-toggle="collapse" data-parent=".accordion" ><?php _e("Cancel",WL_A_P_SYSTEM);?></button>
							<?php
						}
						?>						
						 <!-- <button class="btn ser-btn" data-toggle="collapse" data-parent=".accordion" id='save_<?php echo $loc_show; ?>' onclick="return save_loc_service('<?php echo $loc_show; ?>');"><?php _e("Save",WL_A_P_SYSTEM );?> </button> -->
						 <!-- <button class="btn ser-btn" data-toggle="collapse" data-parent=".accordion" ><?php _e("Cancel",WL_A_P_SYSTEM);?></button> -->
					</div>
				</div>
			</div>
			<?php } ?>
			 </form>
		</div>
</div>