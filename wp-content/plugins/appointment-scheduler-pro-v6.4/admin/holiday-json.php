<?php
//SHOW HOLIDAY DATA IN DATATABLE
global $wpdb;
$ap_fecth=$wpdb->get_results("select * from $wpdb->prefix"."apt_holidays");
$num_rows=count($ap_fecth);
if($num_rows !==0)
{
 foreach($ap_fecth as $value)
{
  //$status_show ="Upcoming" ;	
  $status=date("m/d/Y");	
  $all_off=$value->all_off;	
  $id=$value->id;
  $name=$value->name;
  $start_date=$value->start_date;
  $end_date=$value->end_date;
  $all_day_off="";
  if($all_off=="1")
  {
  $start_time="12:00am" ;
  $end_time="11:59pm";
  $all_day_off="Full Day Off";
  }
  else
  {
   $start_time =$value->start_time ;
   $end_time=$value->end_time ; 
  }
  $repeat =$value->repeat_value;
  if($repeat=="p_d")
  {
	$date=array($start_date." To ".$end_date); 
	if($status==$end_date)
	{
		$status_show ="Runnning";
    }
	if($status>$end_date)
	{
		$status_show ="Gone";
    }
	if($status<$end_date)
	{
		$status_show ="Upcoming";
    }
  }
  else
  {
	$date=$value->holiday_date;  
	if($status==$date)
	{
		$status_show ="Runnning";
    }
	if($status>$date)
	{
		$status_show ="Gone";
    }
	if($status<$date)
	{
		$status_show ="Upcoming";
    }
  }	
   if($repeat=="no")
  {
	  $show_repeat="No Repeat";
  }	  
  
  if($repeat=="p_d")
  {
	  $show_repeat="Particular Date(s)";
  }	
  
  if($repeat=="daily")
  {
	  $show_repeat="Daily";
  }	
  
   if($repeat=="weekly")
  {
	  $show_repeat="Weekly";
  }	
  if($repeat=="bi_weekly")
  {
	  $show_repeat="Bi-Weekly";
  }	
   if($repeat=="monthly")
  {
	  $show_repeat="Monthly";
  }
  $notes =$value->notes ;
  $results["data"][] =array('<input type="checkbox" name="check[]" id="my_check_holiday" class="checkbox_1" value="'.$id.'"/>',$name,$date,array($start_time." To ".$end_time),array($show_repeat." ".$all_day_off),$status_show,array('<a style="margin-right: 5px;" href="#holi_day_update"  data-backdrop="true" data-toggle="modal" data-id="'.$id.'"><i class="fas fa-pen"></i></a> &nbsp <a href="#'.$id.'" class="del_holi_day">  <i class="fas fa-trash"></i></a>'));
}
}
else
{
$results["data"][] =array(null,null,null,__('No Holiday Add',WL_A_P_SYSTEM),null,null,null);
}
 if($results != null)
    {
        wp_send_json($results); // encode and send response
    }
    else wp_send_json_error(); // {"success":false}
	?>