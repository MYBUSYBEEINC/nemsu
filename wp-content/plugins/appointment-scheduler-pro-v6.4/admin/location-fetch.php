<?php
//CATEGORY DATA LOADS ON NEW APPOINTMENT BOOKING
global $wpdb;
if(isset($_REQUEST['loc_fetch_info']))
{
	$fetch_var=$_REQUEST['loc_fetch_info'];
	$ap_location_fecthes=$wpdb->get_row("select * from $wpdb->prefix"."apt_location WHERE id = $fetch_var ");
//$appointment_category_details = $wpdb->get_results( "SELECT * from $wpdb->prefix"."apt_category");
}?>
<form id="u_loc_form" method="post">
	<input type="text" name="u_location_name" id="u_location_name" class="form-control" placeholder="Location" value="<?php echo $ap_location_fecthes->location_add; ?>"/>
	<span  class="validation_alert" id="u_location_name_alert">This field is required</span>
	<input type="hidden" name="update_location_value" value="<?php echo $ap_location_fecthes->id; ?>">
</form>