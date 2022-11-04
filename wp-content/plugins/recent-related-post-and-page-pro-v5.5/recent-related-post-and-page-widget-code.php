<?php
/**
 * Adds widget.
 */
class R_P_AND_R_P extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
				'rp_and_rp', // Base ID
				 ' Recent Related Post And Page', // Name
			   array( 'description' => 'Display Related And Recent Posts', 'text_domain'  ) // Args
			   );
	}
			     /*
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		  @param array $instance Saved values from database.
		 */

		  public function widget( $args, $instance ) {
		  	$Title    	=   apply_filters( 'Abt_widget_title', $instance['Title'] );
		  	echo $args['before_widget'];

		  	$ABTId	=   apply_filters( 'abt_widget_shortcode', $instance['Shortcode'] );

		  	if(is_numeric($ABTId))
		  	{
		  		if ( ! empty( $instance['Title'] ) )
		  		{
		  			echo $args['before_title'] . apply_filters( 'widget_title', $instance['Title'] ). $args['after_title'];
		  		}
		  		echo do_shortcode( '[RRPP id='.$ABTId.']' );
		  	} else {
		  		echo "<p>Sorry! No Related-posts-and-recent posts Shortcode Found.</p>";
		  	}
		  	echo $args['after_widget'];
		  	wp_reset_query();
		  }

	 /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
	 public function form( $instance )
	 {

	 	if ( isset( $instance[ 'Title' ] ) )
	 	{
	 		$Title = $instance[ 'Title' ];
	 	} else
	 	{
	 		$Title = " Recent Related Post And Page";
	 	}

	 	if ( isset( $instance[ 'Shortcode' ] ) )
	 	{
	 		$Shortcode = $instance[ 'Shortcode' ];
	 	} else
	 	{
	 		$Shortcode = "Select Any Recent Related Post And Page settings";
	 	}
	 	?>
	 	<p>
	 		<label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php _e( 'Widget Title' ); ?></label>
	 		<input class="widefat" id="<?php echo $this->get_field_id( 'Title' ); ?>" name="<?php echo $this->get_field_name( 'Title' ); ?>" type="text" value="<?php echo esc_attr( $Title ); ?>">
	 	</p>

	 	<p>
	 		<label for="<?php echo $this->get_field_id( 'Shortcode' ); ?>"><?php _e( 'Select Any' ); ?> (Required)</label>
	 		<?php
			/**
			 * Get All about_m_e Shortcode Custom Post Type
			 */
			$RPARP_CPT_Name = "rp_and_rp";
			$RPARP_All_Posts = wp_count_posts( $RPARP_CPT_Name )->publish;
			global $All_RPARP;
			$All_RPARP = array('post_type' => $RPARP_CPT_Name, 'orderby' => 'ASC', 'posts_per_page' => $RPARP_All_Posts);
			$All_RPARP = new WP_Query( $All_RPARP );
			?>
			<select id="<?php echo $this->get_field_id( 'Shortcode' ); ?>" name="<?php echo $this->get_field_name( 'Shortcode' ); ?>" style="width: 100%;">
				<option value="Select Any Settings" <?php if($Shortcode == "Select Any Settings") echo 'selected="selected"'; ?>>Select Any Settings</option>
				<?php
				if( $All_RPARP->have_posts() ) {	 ?>
				<?php while ( $All_RPARP->have_posts() ) : $All_RPARP->the_post();
				$PostId = get_the_ID();
				$PostTitle = get_the_title($PostId);
				?>
				<option value="<?php echo $PostId; ?>" <?php if($Shortcode == $PostId) echo 'selected="selected"'; ?>><?php if($PostTitle) echo $PostTitle; else _e("No Title", WL_R_P_R_P); ?></option>
			<?php endwhile; ?>
			<?php
		}
		else
		{
			echo "<option>Sorry! No Related-posts-and-recent posts Shortcode Found.</option>";
		}
		?>
	</select>
</p>

<?php
}
public  function update( $new_instance, $old_instance )
{
	$instance = array();
	$instance['Title'] = ( ! empty( $new_instance['Title'] ) ) ? strip_tags( $new_instance['Title'] ) : '';
	$instance['Shortcode'] = ( ! empty( $new_instance['Shortcode'] ) ) ? strip_tags( $new_instance['Shortcode'] ) : 'Select Any Recent Related Post And Page';

	return $instance;
}
	} // end of class Related-posts-and-recent posts Shortcode Shortcode Pro Widget Class

// Register Related-posts-and-recent posts Shortcode Shortcode Pro Widget
	add_action( 'widgets_init', 'register_R_P_AND_R_P' );
	function register_R_P_AND_R_P()
	{
		register_widget( 'R_P_AND_R_P' );
	}?>