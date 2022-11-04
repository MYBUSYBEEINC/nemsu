<?php
//BACKUP OF DETAILS
if(isset($_REQUEST['customer']))
{
require_once '../../../../wp-load.php';
header('Content-Type: text/csv');
header('Content-Disposition: inline; filename="All Customer List-'.date('Y-m-d-H-i-s').'.csv"');
$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_clients");
echo "First Name,Last Name,Phone,Skype Id,Email,Notes\r\n";   
if (count($results))  {
	foreach($results as $result) {
		echo $result->first_name.",".$result->last_name .",".$result->phone.",".$result->skype_id .", ".$result->email .",".$result->notes."\r\n";
	}
}
}

if(isset($_REQUEST['services']))
{
require_once '../../../../wp-load.php';
header('Content-Type: text/csv');
header('Content-Disposition: inline; filename="All Services List-'.date('Y-m-d-H-i-s').'.csv"');
$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_services");
echo "Services Name,Icon,Color,Duration,Padding Time Before,Padding After,Service Type,Price,Capacity,Category,Info Message\r\n";   
if (count($results))  {
	foreach($results as $result) {
		echo $result->name.",".$result->icon .",".$result->color.",".$result->duration .", ".$result->p_before .",".$result->p_after.",".$result->service_type.",".$result->price.",".$result->capacity.",".$result->category.",".$result->info_message."\r\n";
	}
}
}

if(isset($_REQUEST['payments']))
{
require_once '../../../../wp-load.php';
header('Content-Type: text/csv');
header('Content-Disposition: inline; filename="All Payments List-'.date('Y-m-d-H-i-s').'.csv"');
$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_payment");
echo "Payment Type,Customer,Customer Email,Staff,Appointment Date,Service,Coupon Code Applied,Amount After Discount,Amount,Status,Appointment Unique Id\r\n";   
if (count($results))  {
	foreach($results as $result) {
echo $result->payment_type.",".$result->customer .",".$result->customer_email.",".$result->staff .",".$result->appointment_date.",".$result->service.",".$result->coupon_code_applied.",".$result->amount_after_discount.",".$result->amount.",".$result->status.",".$result->appt_unique_id."\r\n";
	}
}
}


if(isset($_REQUEST['appoinment']))
{
require_once '../../../../wp-load.php';
header('Content-Type: text/csv');
header('Content-Disposition: inline; filename="All Appointment List-'.date('Y-m-d-H-i-s').'.csv"');
$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_appointments");
echo "Client Name,Staff Member,Service Type	,Contact,Booking Date,Start Time,End Time,Status,Client Email,Staff Email,Appointment Unique Id\r\n";   
if (count($results))  {
	foreach($results as $result) {
echo $result->client_name.",".$result->staff_member .",".$result->service_type.",".$result->contact .",".$result->booking_date.",".$result->start_time.",".$result->end_time.",".$result->status.", ".$result->payment_status." ,".$result->client_email.",".$result->staff_email.",".$result->appt_unique_id."\r\n";
	}
}
}


if(isset($_REQUEST['staff']))
{
require_once '../../../../wp-load.php';
header('Content-Type: text/csv');
header('Content-Disposition: inline; filename="All Staff List-'.date('Y-m-d-H-i-s').'.csv"');
$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_staff");
echo "Staff Member Name,Staff Icon,Staff Member Image,Staff Email,Staff Skype Id,Staff Contact,Staff Info,Staff Services,Staff Service Category,Schedule Sunday,Schedule Monday,Schedule Tuesday,Schedule Wednesday,Schedule Thursday,Schedule Friday,Schedule Saturday,Staff All Off,Staff Start_time,Staff End Time,Staff date,Staff Repeat,Staff Start Date,Staff End Date,Staff Repeat Day,Staff Repeat Week,Staff Repeat Bi Week,Staff Repeat Month Id\r\n";   
if (count($results))  {
	foreach($results as $result) {
echo $result->staff_member_name.",".$result->staff_icon .",".$result->staff_member_image.",".$result->staff_email .",".$result->staff_skype_id.",".$result->staff_contact.",".$result->staff_info.",".$result->staff_services.",".$result->staff_service_category.",".$result->schedule_sunday.",".$result->schedule_monday.",".$result->schedule_tuesday.",".$result->schedule_wednesday.",".$result->schedule_thursday.",".$result->schedule_friday.",".$result->schedule_saturday.",".$result->	sun_all_off.",".$result->mon_all_off.",".$result->tue_all_off.",".$result->wed_all_off.",".$result->thu_all_off.",".$result->fri_all_off.",".$result->sat_all_off."\r\n";
	}
}
}


if(isset($_REQUEST['coupons']))
{
require_once '../../../../wp-load.php';
header('Content-Type: text/csv');
header('Content-Disposition: inline; filename="All Coupons List-'.date('Y-m-d-H-i-s').'.csv"');
$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix ."apt_coupons");
echo "Coupon Code,Service Name,Time Limit,Per User Limit,Discount Type,Discount Method,Coupon Start Date,Coupon End date\r\n";   
if (count($results))  {
	foreach($results as $result) {
echo $result->coupon_code.",".$result->service_name .",".$result->time_limit.",".$result->per_user_limit .",".$result->discount_type.",".$result->discount_method.",".$result->coupon_start_date.",".$result->coupon_end_date."\r\n";
	}
}
}