<?php
//SHOW REMINDER LOG DATA IN DATATABLE
global $wpdb;
$apt_reminder=$wpdb->get_results("select * from $wpdb->prefix"."apt_reminder");
$num_rows=count($apt_reminder);
if($num_rows !==0)
{
 foreach($apt_reminder as $value)
{
  $app_id=$value->app_id;
  $reminder_client_name=$value->reminder_client_name;
  $reminder_client_email=$value->reminder_client_email;
  $retries=$value->retries;
  $time_date=$value->time_date;
  $status=$value->status;
 
  $results["data"][] =array($app_id,$reminder_client_name, $reminder_client_email, $retries,$time_date,$status,
);
}
}
else
{
$results["data"][] =array(null,null, null,__('No Reminder Log Found',WL_A_P_SYSTEM),null,null,null);
}
 if($results != null)
    {
        wp_send_json($results); // encode and send response
    }
    else wp_send_json_error(); // {"success":false}?>