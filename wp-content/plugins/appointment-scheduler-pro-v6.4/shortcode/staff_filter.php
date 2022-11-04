<?php
echo "<option value='0'>--Select--</option>";
global $wpdb;
$appointment_staff_details = $wpdb->get_results( "select * from $wpdb->prefix"."apt_staff");
if(isset($_REQUEST['service_id'])){
	$service_id = $_REQUEST['service_id'];
	foreach($appointment_staff_details as $appointment_single_detail){
		$temp_staff_services = $appointment_single_detail->staff_services;
		$services= explode(",",$temp_staff_services);
		foreach($services as $service){ 
			if(!empty($service) && $service_id == $service){
				?>
					<option value="<?php echo $appointment_single_detail->id;?>"><?php echo $appointment_single_detail->staff_member_name;?></option>
				<?php 
			}			
		}			
	}
}
?>