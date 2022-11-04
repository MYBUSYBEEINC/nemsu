<?php
	if(isset($_REQUEST['user_id'])){
		$user_id = $_REQUEST['user_id'];
		require_once '../../../../wp-load.php';
		header('Content-Type: text/csv');
		header('Content-Disposition: inline; filename="Staff Holiday List-'.date('Y-m-d-H-i-s').'.csv"');
		$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_staff_holiday_table where staff_id = '$user_id'");
		echo "Type of Leave,Single Leave, Multiple Leave Start, Multiple Leave End,Status\r\n";
		if (count($results)){
			foreach($results as $result){
		echo $result->type_of_leaves .",".$result->single_leave .",".$result->multiple_leaves_start .",".$result->multiple_leaves_end .",".$result->status ."\r\n";
			}
		}
	}
?>