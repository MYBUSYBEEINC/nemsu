<?php
	/* staff Json to get the details of holidays in data table */
	global $wpdb;
	if(isset($_REQUEST['staff_id'])){
		$staff_id = $_REQUEST['staff_id'];
	}
	$staff_holiday = $wpdb->get_results("select * from $wpdb->prefix"."apt_staff_holiday_table where staff_id = '$staff_id'");
	$num_rows=count($staff_holiday);
	if($num_rows != 0 ){
		foreach($staff_holiday as $value){
			$id = $value->id;
			$staff_id = $value->staff_id;
			$type_of_leaves = $value->type_of_leaves;
			$single_leave = $value->single_leave;
			$multiple_leaves_start = $value->multiple_leaves_start;
			$multiple_leaves_end = $value->multiple_leaves_end;
			$status = $value->status;
			$results["data"][] = array($type_of_leaves,$single_leave,$multiple_leaves_start,$multiple_leaves_end,"<a style='margin-right: 5px;' href='#update_holiday_models'  data-backdrop='true' data-toggle='modal' data-id='<?php echo $val->id; ?>'><i class='fas fa-pen'></i></a> &nbsp; <a href='#<?php echo $val->id; ?>' class='del_staff_holiday'>  <i class='fas fa-trash'></i></a>");
		}
	}
?>