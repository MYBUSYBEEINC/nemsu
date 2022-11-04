<?php

/**
 * Adds widget.
 */
class About_author extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'about_author', // Base ID
			'About Author', // Name
			array(
				'description' => 'An efficient way to display author information on your wordpress blog.',
				'text_domain'
			) // Args
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
		$Title = apply_filters( 'Abt_widget_title', $instance['Title'] );
		echo $args['before_widget'];

		$ABTId = apply_filters( 'abt_widget_shortcode', $instance['Shortcode'] );

		if ( is_numeric( $ABTId ) ) {
			if ( ! empty( $instance['Title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['Title'] ) . $args['after_title'];
			}
			echo do_shortcode( '[ABTM id=' . $ABTId . ']' );
		} else {
			echo "<p>Sorry! No About Author Shortcode Found.</p>";
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
	public function form( $instance ) {

		if ( isset( $instance['Title'] ) ) {
			$Title = $instance['Title'];
		} else {
			$Title = "About Author";
		}

		if ( isset( $instance['Shortcode'] ) ) {
			$Shortcode = $instance['Shortcode'];
		} else {
			$Shortcode = "Select Any About Author  settings";
		}
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php _e( 'Widget Title' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'Title' ); ?>"
                   name="<?php echo $this->get_field_name( 'Title' ); ?>" type="text"
                   value="<?php echo esc_attr( $Title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'Shortcode' ); ?>"><?php _e( 'Select Any' ); ?>
                (Required)</label>
			<?php
			/**
			 * Get All about_author Shortcode Custom Post Type
			 */
			$ABT_CPT_Name  = "about_author";
			$ABT_All_Posts = wp_count_posts( $ABT_CPT_Name )->publish;
			global $All_ABTM;
			$All_ABTM = array( 'post_type' => $ABT_CPT_Name, 'orderby' => 'ASC', 'posts_per_page' => $ABT_All_Posts );
			$All_ABTM = new WP_Query( $All_ABTM );
			?>
            <select id="<?php echo $this->get_field_id( 'Shortcode' ); ?>"
                    name="<?php echo $this->get_field_name( 'Shortcode' ); ?>" style="width: 100%;">
                <option value="Select Any Settings" <?php if ( $Shortcode == "Select Any Settings" ) {
					echo 'selected="selected"';
				} ?>><?php _e( "Select Any Settings", WL_ABTM_TXT_DM ); ?></option>
				<?php
				if ( $All_ABTM->have_posts() ) { ?>
					<?php while ( $All_ABTM->have_posts() ) : $All_ABTM->the_post();
						$PostId    = get_the_ID();
						$PostTitle = get_the_title( $PostId );
						?>
                        <option value="<?php echo esc_attr( $PostId ); ?>" <?php if ( $Shortcode == $PostId ) {
							echo 'selected="selected"';
						} ?>><?php if ( $PostTitle ) {
								echo esc_attr( $PostTitle );
							} else {
								_e( "No Title", WL_ABTM_TXT_DM );
							} ?></option>
					<?php endwhile; ?>
					<?php
				} else {
					echo "<option>Sorry! No About Author Shortcode Found.</option>";
				}
				?>
            </select>
        </p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = array();
		$instance['Title']     = ( ! empty( $new_instance['Title'] ) ) ? strip_tags( $new_instance['Title'] ) : '';
		$instance['Shortcode'] = ( ! empty( $new_instance['Shortcode'] ) ) ? strip_tags( $new_instance['Shortcode'] ) : 'Select Any About Author';

		return $instance;
	}
} // end of class Instagram Shortcode Pro Widget Class

// Register Instagram Shortcode Pro Widget
add_action( 'widgets_init', 'register_About_author' );
function register_About_author() {
	register_widget( 'About_author' );
} ?>