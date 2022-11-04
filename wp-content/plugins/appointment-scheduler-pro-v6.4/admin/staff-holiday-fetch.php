<?php
//FETCH Staff Holiday DETAILS ON UPDATE COUPON

global $wpdb;
if(isset($_REQUEST['staff_holiday_info']))
{
	$fetch_var=$_REQUEST['staff_holiday_info'];
	$ap_holiday_fecthes=$wpdb->get_row("select * from $wpdb->prefix"."apt_staff_holiday_table WHERE id = $fetch_var ");
	//$appointment_category_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_category");
}?>

<form id="ap_staff_holiday_update" method="post">
		<div class="form-group">
			<div class="row">
				<div class="col-md-6" style="margin-bottom:20px">
					<strong><?php _e("Single Day",WL_A_P_SYSTEM );?></strong>&nbsp;&nbsp;<input type="radio"  <?php if($ap_holiday_fecthes->type_of_leaves=="Single") { echo "checked='checked'";} ?> value="Single" class="staff_single_holiday_cls" name="update_staff_single_holiday"  id="staff_single_holiday_<?php echo $ap_holiday_fecthes->id; ?>" onclick="single_holiday_show(<?php echo $ap_holiday_fecthes->id; ?>);"  />
				</div>
				
				<div class="col-md-6" style="margin-bottom:20px">
					<strong><?php _e("Multiple Day",WL_A_P_SYSTEM );?></strong>:&nbsp;&nbsp;<input type="radio" value="Multiple" <?php if($ap_holiday_fecthes->type_of_leaves=="Multiple") { echo "checked='checked'";} ?> class="staff_single_holiday_cls" name="update_staff_single_holiday"  id="staff_multiple_holiday_<?php echo $ap_holiday_fecthes->id; ?>" onclick="multiple_holiday_show(<?php echo $ap_holiday_fecthes->id; ?>);"  />
				</div>
			</div>
			<div class="row">	
				<div class="col-md-12 col-sm-12 col-xs-12 staff_single_holiday_div_<?php echo $ap_holiday_fecthes->id; ?>" style="display:none">
					<label><?php _e("Choose Date",WL_A_P_SYSTEM );?></label>
					<input type="text" Placeholder="Choose Date" value="<?php echo $ap_holiday_fecthes->single_leave;?>" name="update_staff_single_holiday_box" id="staff_single_holiday_box"  class="staff_holiday_box form-control" />
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 staff_multiple_holiday_div_<?php echo $ap_holiday_fecthes->id; ?>" style="display:none" >
					<div class="row">
						<div class="col-md-5 col-sm-12 col-xs-12">
							<label><?php _e("Choose Start Date",WL_A_P_SYSTEM );?></label>
							<input type="text" Placeholder="Choose Date" value="<?php echo $ap_holiday_fecthes->multiple_leaves_start;?>" name="update_staff_multiple_holiday_box_1" id="staff_multiple_holiday_box_1"  class="staff_holiday_box form-control" />
						</div>
						<div class="col-md-5 col-sm-12 col-xs-12">
							<label><?php _e("Update",WL_A_P_SYSTEM );?></label>
							<input type="text" Placeholder="Choose Date"  value="<?php echo $ap_holiday_fecthes->multiple_leaves_end;?>" name="update_staff_multiple_holiday_box_2" id="staff_multiple_holiday_box_2"  class="staff_holiday_box form-control" />
						</div>
					</div>
				</div>
			</div>
				 <div class="col-md-12 col-sm-12 col-xs-12">
					<!--<button data-spinner-size="40" data-style="zoom-in" class="btn ser-btn" id='save_staff_holiday_<?php echo $ap_holiday_fecthes->id; ?>' onclick="return staff_holiday_update();" type="button"><?php _e("Save",WL_A_P_SYSTEM );?></button>-->
				</div>
		
			<!--<button type="reset" class="btn ser-btn"><?php _e("Reset",WL_A_P_SYSTEM );?></button>-->  
			<input type="hidden"  name="staff_holiday_update_id" value="<?php echo $ap_holiday_fecthes->id; ?>">
			<input type="hidden"  name="update_staff_holiday_id" value="<?php echo $ap_holiday_fecthes->staff_id; ?>">
			<!--<input type="submit" name="submit" value="submit"-->
		</div>
</form>

<script>
jQuery(document).ready(function() {
if(jQuery('#staff_single_holiday_'+<?php echo $ap_holiday_fecthes->id; ?>).is(":checked")) {																	
	jQuery(".staff_single_holiday_div_"+<?php echo $ap_holiday_fecthes->id; ?>).show();
	jQuery(".staff_multiple_holiday_div_"+<?php echo $ap_holiday_fecthes->id; ?>).hide();
}

if (jQuery('#staff_multiple_holiday_'+<?php echo $ap_holiday_fecthes->id; ?>).is(":checked")) {
	jQuery(".staff_multiple_holiday_div_"+<?php echo $ap_holiday_fecthes->id; ?>).show();
	jQuery(".staff_single_holiday_div_"+<?php echo $ap_holiday_fecthes->id; ?>).hide();
}
} );
</script>
