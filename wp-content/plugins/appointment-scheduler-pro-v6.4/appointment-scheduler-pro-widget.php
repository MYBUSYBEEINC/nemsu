<?php
/**
 * Adds Foo_Widget widget.
 */
class AppointmentSchedulerPro extends WP_Widget {
	 /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'appointment_scheduler', // Base ID
            'Appointment Scheduler Pro Widget', // Name
            array( 'description' => __( 'Display Appointment Schedules in any widget area.', WEBLIZAR_A_P_SYSTEM ), ) // Args
        );
	}
	
	/**
     * Front-end display of widget.
     */
    public function widget( $args, $instance ) {
	    
	    $title = apply_filters( 'title', $instance['title'] );		

		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		include("widget-shortcode.php");
		$enable_biz_details    	=   apply_filters( 'enable_b_detail', $instance['enable_biz_details'] );
		$staff_selected    		=   apply_filters( 'staff_selected', $instance['staff_selected'] );

		if($enable_biz_details =='yes'){ ?>
		<div id="business_info" align='center'>
			<p>
				<b><span id="business_details"><?php  if($b_name==""){ echo $blog_title; } else{ echo $b_name; } ?></span></b><br>
				<span class="business_hours"><?php echo "Opening Hours: ".$biz_start_time; ?><?php  echo " - ".$biz_end_time; ?></span><br>
				<span class="contact_number"><i class="<?php  echo $ap_phone_icon; ?>"></i><?php  echo $ap_phone_no; ?></span><br>
				<span class="email_address"><i class="<?php  echo $ap_email_icon; ?>"></i> <?php  echo $ap_email; ?></span>
			</p>
		</div> 
		<?php }	?>
			
			<div id="appointment-scheduler-staff-carousel" class="owl-carousel">
				<?php
				$time_format = get_option( 'time_format' ); 
				if (!empty($staff_selected)) {
					foreach($staff_selected  as $single_staff_selected )	{
						$appointment_staff_details = $wpdb->get_results( "select * from $staff_table where id='$single_staff_selected'");
						foreach($appointment_staff_details as $appointment_staff_detail){	?>
							<div class="staff_swiper_info"> 
								<?php 
								echo "<div class='staff_name_align' >Staff Hours - <b>".$staff_member_name= $appointment_staff_detail->staff_member_name.'</b></div>';
								$monday= unserialize($appointment_staff_detail->schedule_monday);
									$temp_monday_start_time = $monday[0]['start_time'];
									$temp_monday_end_time = $monday[0]['end_time'];
										
									$monday_start = strtotime($temp_monday_start_time);
									$monday_end = strtotime($temp_monday_end_time);

									$monday_st=	date($time_format, $monday_start);
									$monday_et=	date($time_format, $monday_end);
										
								$tuesday= unserialize($appointment_staff_detail->schedule_tuesday);
									$temp_tuesday_start_time =$tuesday[0]['start_time'];
									$temp_tuesday_end_time =$tuesday[0]['end_time'];
										
									$tuesday_start = strtotime($temp_tuesday_start_time);
									$tuesday_end = strtotime($temp_tuesday_end_time);

									$tuesday_st=	date($time_format, $tuesday_start);
									$tuesday_et=	date($time_format, $tuesday_end);
										
										
								$wednesday= unserialize($appointment_staff_detail->schedule_wednesday);
									$temp_wednesday_start_time =$wednesday[0]['start_time'];
									$temp_wednesday_end_time =$wednesday[0]['end_time'];
										
									$wednesday_start = strtotime($temp_wednesday_start_time);
									$wednesday_end = strtotime($temp_wednesday_end_time);

									$wednesday_st=	date($time_format, $wednesday_start);
									$wednesday_et=	date($time_format, $wednesday_end);
										
								$thursday= unserialize($appointment_staff_detail->schedule_thursday);
									$temp_thursday_start_time = $thursday[0]['start_time'];
									$temp_thursday_end_time =$thursday[0]['end_time'];
										
									$thursday_start = strtotime($temp_thursday_start_time);
									$thursday_end = strtotime($temp_thursday_end_time);
													
									$thursday_st=	date($time_format, $thursday_start);
									$thursday_et=	date($time_format, $thursday_end);
										
										
								$friday= unserialize($appointment_staff_detail->schedule_friday);
									$temp_friday_start_time =$friday[0]['start_time'];
									$temp_friday_end_time =$friday[0]['end_time'];
										
									$friday_start = strtotime($temp_friday_start_time);
									$friday_end = strtotime($temp_friday_end_time);
													
									$friday_st=	date($time_format, $friday_start);
									$friday_et=	date($time_format, $friday_end);
										
								$saturday= unserialize($appointment_staff_detail->schedule_saturday);
									$temp_saturday_start_time =$saturday[0]['start_time'];
									$temp_saturday_end_time =$saturday[0]['end_time'];
										
									$saturday_start = strtotime($temp_saturday_start_time);
									$saturday_end = strtotime($temp_saturday_end_time);
													
									$saturday_st=	date($time_format, $saturday_start);
									$saturday_et=	date($time_format, $saturday_end);
										
								$sunday= unserialize($appointment_staff_detail->schedule_sunday);
									$temp_sunday_start_time =$sunday[0]['start_time'];
									$temp_sunday_end_time =$sunday[0]['end_time'];
										
									$sunday_start = strtotime($temp_sunday_start_time);
									$sunday_end = strtotime($temp_sunday_end_time);
													
									$sunday_st=	date($time_format, $sunday_start);
									$sunday_et=	date($time_format, $sunday_end);
										
								echo "<div class='staff_booking_details'>";
									echo "<div class='staff_appt_day'>";
										echo "Monday<br>";
										echo "Tuesday<br>";
										echo "Wednesday<br>";
										echo "Thursday<br>";
										echo "Friday<br>";
										echo "Saturday<br>";
										echo "Sunday<br>";
									echo "</div>";

									echo "<div class='staff_appt_time'>";
										echo $monday_st.' - '. $monday_et.'<br>';
										echo $tuesday_st.' - '. $tuesday_et.'<br>';
										echo $wednesday_st.' - '. $wednesday_et.'<br>';
										echo $thursday_st.' - '. $thursday_et.'<br>';
										echo $friday_st.' - '. $friday_et.'<br>';
										echo $saturday_st.' - '. $saturday_et.'<br>';
										echo $sunday_st.' - '. $sunday_et.'<br>';
									echo "</div>";
								echo "</div>";	?>
							</div>	<?php	
						}
					}
				}	?>
			</div>
		<?php
		$appt_description	=   apply_filters( 'appt_description', $instance['appt_description'] );
		if($appt_description !==''){ ?>
			<div align='center'><span id="business_desc"><?php echo $appt_description; ?></span></div><br><?php
		}
		$button_text    	=   apply_filters( 'button_text', $instance['button_text'] );
		$button_link    	=   apply_filters( 'button_link', $instance['button_link'] );?>
		<div id="book_appt_redirect" align='center'>
			<a class="btn btn-default"  id="asp_booking_button" href="<?php echo $button_link; ?>"   target="_new" ><?php if($button_text !==''){ echo $button_text; } else { echo "Book Appointment !!" ;} ?></a>
		</div><?php
		echo $args['after_widget'];
	}
    

    /**
     * Back-end widget form.
     */
    public function form( $instance ) {
		wp_enqueue_script('jquery');
		wp_enqueue_style('bootstrap',WEBLIZAR_A_P_SYSTEM.'/bootstrap/css/bootstrap.min.css' , array() ,true);
		wp_enqueue_style('ap_bootstrap-table',WEBLIZAR_A_P_SYSTEM.'/css/bootstrap-table.css' , array() ,true);
		wp_enqueue_style('font-awesome',WEBLIZAR_A_P_SYSTEM.'/css/all.min.css' , array() ,true);
		wp_enqueue_style('ap_genericons_css',WEBLIZAR_A_P_SYSTEM.'/css/genericons.css' , array() ,true);
		wp_enqueue_script('ap_bootstrap_js', WEBLIZAR_A_P_SYSTEM.'/bootstrap/js/bootstrap.min.js', array('jquery'));
		wp_enqueue_style('font_family_css',WEBLIZAR_A_P_SYSTEM.'/css/googleapis.css' , array() ,true);
		wp_enqueue_style('ap_style_css',WEBLIZAR_A_P_SYSTEM.'/css/style.css' , array() ,true);
		wp_enqueue_script('notify_js', WEBLIZAR_A_P_SYSTEM.'/js/alertbox/notify.js', array('jquery') );
		wp_enqueue_style('alert_css',WEBLIZAR_A_P_SYSTEM.'js/alertbox/notify.css' , array() ,true);		
		
		include("widget-shortcode.php");
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = "New Title";
		}
		
		if ( isset( $instance[ 'enable_biz_details' ] ) ) {
			$enable_biz_details = $instance[ 'enable_biz_details' ];
		} else {
			$enable_biz_details = "yes";
		}

		if ( isset( $instance[ 'appt_description' ] ) ) {
			$appt_description = $instance[ 'appt_description' ];
		} else {
			$appt_description = "Follow the simple steps and get your appointment fixed online!";
		}
		if ( isset( $instance[ 'button_text' ] ) ) {
			$button_text = $instance[ 'button_text' ];
		} else {
			$button_text = "Book Appointment !!";
		}
		if ( isset( $instance[ 'button_link' ] ) ) {
			$button_link = $instance[ 'button_link' ];
		} else {
			$button_link = "";
		}
		
		if ( isset( $instance[ 'staff_selected' ] ) ) {
			$staff_selected = isset($instance['staff_selected']) ? $instance['staff_selected'] : array();
		} else {
			$staff_selected = array('1');
		}	
		?>	
		
		<div class="col-md-12  appt_title">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title' ); ?></label>
				<center><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></center>
			</p>
		</div>		
		
		<div class="col-md-12  appt_enable_detail">
			<p>
				<label for="<?php echo $this->get_field_id( 'enable_biz_details' ); ?>"><?php _e( 'Show Business Details' ); ?></label>
				<input id="enable_biz_details" type="checkbox" name="<?php echo $this->get_field_name( 'enable_biz_details' ); ?>"  value="yes" <?php  if($enable_biz_details=='yes'){ echo 'checked'; } else{ echo ''; } ?>  />
			</p>
		</div>
		
		<div class="col-md-12" id="business_info" align='center'>
			<p>
				<b><span id="business_details"><?php  if($b_name==""){ echo $blog_title; } else{ echo $b_name; } ?></span></b><br>
				<span class="business_hours"><?php echo "Opening Hours : " ?>
				<?php echo $biz_start_time ?><?php  echo " - ".$biz_end_time; ?></span><br>
				<span class="contact_number"><i class="<?php  echo $ap_phone_icon; ?>"></i><?php  echo $ap_phone_no; ?></span><br>
				<span class="email_address"><i class="<?php  echo $ap_email_icon; ?>"></i> <?php  echo $ap_email; ?></span>
			</p>
		</div>

		<div class="widget-content">			
			<div class="col-md-12 show_appt_staff">
				<p>
					<label for="<?php echo $this->get_field_id( 'staff_selected' ); ?>"><?php _e( 'Select Staff Schedule to Show:' ); ?></label> 
					<?php 
					$appointment_staff_details = $wpdb->get_results( "select * from $staff_table");
					foreach($appointment_staff_details as $appointment_staff_detail ){ ?>
						<div class="col-md-6 col-sm-6 show_appt_staff">
							<input type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('staff_selected') ?>[]" value="<?php echo $appointment_staff_detail->id ?>" <?php checked(in_array($appointment_staff_detail->id, $staff_selected)) ?> />
							<span><?php  echo $appointment_staff_detail->staff_member_name; ?></span>
						</div>
					<?php } ?>
				</p>
			</div>
				
			<div class="col-md-12  show_appt_desc">
				<p>
					<label for="<?php echo $this->get_field_id( 'appt_description' ); ?>"><?php _e( 'Description' ); ?></label>
					<center><input class="widefat" id="<?php echo $this->get_field_id( 'appt_description' ); ?>" name="<?php echo $this->get_field_name( 'appt_description' ); ?>" type="text" value="<?php echo esc_attr( $appt_description ); ?>"></center>
				</p>
			</div>
				
			<div class="col-md-12  appt_bn_text">
				<p>
					<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text' ); ?></label>
					<center><input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>"></center>
				</p>
			</div>
				
			<div class="col-md-12  appt_btn_link">
				<p>
					<label for="<?php echo $this->get_field_id( 'button_link' ); ?>"><?php _e( 'Button Link' ); ?></label>
					<center><input class="widefat" id="<?php echo $this->get_field_id( 'button_link' ); ?>" name="<?php echo $this->get_field_name( 'button_link' ); ?>" type="text" value="<?php echo esc_attr( $button_link ); ?>"></center>
				</p>
			</div>
			
		</div>	<?php
	}
		
    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
		return array(
			'title' 		=> isset($new_instance['title']) ? strip_tags($new_instance['title']) : $old_instance['title'],
			'enable_biz_details' 	=> isset($new_instance['enable_biz_details']) ? strip_tags( $new_instance['enable_biz_details'] ) : '',
			'appt_description'   => isset($new_instance['appt_description']) ? strip_tags($new_instance['appt_description']) : $old_instance['appt_description'],
			'button_text'    => isset($new_instance['button_text']) ? strip_tags($new_instance['button_text']) : $old_instance['button_text'],
			'button_link'   => isset($new_instance['button_link']) ? strip_tags($new_instance['button_link']) : $old_instance['button_link'],
			'staff_selected' 	=> isset($new_instance['staff_selected']) ? array_filter(array_map(function($id) { return intval($id); }, (array) $new_instance['staff_selected'])) : ''
		);        
		return $instance;
    }
} // end of class Appointment Scheduler Pro Widget Class

// Register Appointment Scheduler Pro Widget
function AppointmentSchedulerPro() {
    register_widget( 'AppointmentSchedulerPro' );
}
add_action( 'widgets_init', 'AppointmentSchedulerPro' );
?>