<?php
     include('../../../../wp-load.php');
     global $wpdb;
	//download_reports
	if(isset($_REQUEST['ap_datepicker_single'])){
		$date = $_REQUEST['ap_datepicker_single'];
		$real_date = date('Y-m-d',strtotime($date));
		//echo "Return Date is: ". $real_date;
		//PRINT ALL APPOINTMENT DATA	
		
		header('Content-Type: text/csv');
		header('Content-Disposition: inline; filename="All Appointment List-'.date($real_date).'.csv"');
		$table_name = $wpdb->prefix ."apt_appointments";
		$query = "SELECT * FROM `$table_name` WHERE booking_date = '$real_date'";
		//$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_appointments");
		$results = $wpdb->get_results($query);
		// $results = $wpdb->get_results("SELECT * FROM `wp_apt_appointments` WHERE booking_date = '2018-03-15'");
		// $wpdb->show_errors(); 
		// $wpdb->print_error();
		echo "Booking Id,Appoinment Date, Start Time,End Time,Employee,Customer Name,Service,Status,Contact No\r\n";   
		if (count($results))  {
			foreach($results as $result) {
				echo $result->id.",".$result->booking_date .",".$result->start_time .",".$result->end_time .", ".$result->staff_member .",".$result->client_name .",".$result->service_type .",".$result->status .",".$result->contact ."\r\n";
			}
		}
	}
	else if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date'])){
		$temp_start_date = $_REQUEST['start_date'];
		$temp_end_date = $_REQUEST['end_date'];
		$start_date = date('Y-m-d',strtotime($temp_start_date));
		$end_date = date('Y-m-d',strtotime($temp_end_date));

		header('Content-Type: text/csv');
		header('Content-Disposition: inline; filename="All Appointment List-'.date($real_date).'.csv"');
		$table_name = $wpdb->prefix ."apt_appointments";
		//$query = "SELECT * FROM `$table_name` WHERE booking_date = '$real_date'";
		$query = "SELECT * FROM `$table_name` WHERE date(booking_date) between '$start_date' and '$end_date'";
		//$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_appointments");
		$results = $wpdb->get_results($query);		
		echo "Booking Id,Appoinment Date, Start Time,End Time,Employee,Customer Name,Service,Status,Contact No\r\n";   
		if (count($results))  {
			foreach($results as $result) {
				echo $result->id.",".$result->booking_date .",".$result->start_time .",".$result->end_time .", ".$result->staff_member .",".$result->client_name .",".$result->service_type .",".$result->status .",".$result->contact ."\r\n";
			}
		}
	}
	else if(isset($_REQUEST['month'])){
		$month = $_REQUEST['month'];	

		header('Content-Type: text/csv');
		header('Content-Disposition: inline; filename="All Appointment List-'.date($real_date).'.csv"');
		$table_name = $wpdb->prefix ."apt_appointments";
		//$query = "SELECT * FROM `$table_name` WHERE booking_date = '$real_date'";
		$query = "SELECT * FROM `$table_name` WHERE MONTH(booking_date) = '$month'";
		//$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_appointments");
		$results = $wpdb->get_results($query);		
		echo "Booking Id,Appoinment Date, Start Time,End Time,Employee,Customer Name,Service,Status,Contact No\r\n";   
		if (count($results))  {
			foreach($results as $result) {
				echo $result->id.",".$result->booking_date .",".$result->start_time .",".$result->end_time .", ".$result->staff_member .",".$result->client_name .",".$result->service_type .",".$result->status .",".$result->contact ."\r\n";
			}
		}
	}
	else if(isset($_REQUEST['year'])){
		$year = $_REQUEST['year'];	

		header('Content-Type: text/csv');
		header('Content-Disposition: inline; filename="All Appointment List-'.date($real_date).'.csv"');
		$table_name = $wpdb->prefix ."apt_appointments";
		//$query = "SELECT * FROM `$table_name` WHERE booking_date = '$real_date'";
		$query = "SELECT * FROM `$table_name` WHERE YEAR(booking_date) = '$year'";
		//$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_appointments");
		$results = $wpdb->get_results($query);		
		echo "Booking Id,Appoinment Date, Start Time,End Time,Employee,Customer Name,Service,Status,Contact No\r\n";   
		if (count($results))  {
			foreach($results as $result) {
				echo $result->id.",".$result->booking_date .",".$result->start_time .",".$result->end_time .", ".$result->staff_member .",".$result->client_name .",".$result->service_type .",".$result->status .",".$result->contact ."\r\n";
			}
		}
	}

