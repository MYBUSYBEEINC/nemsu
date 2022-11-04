<?php
defined( 'ABSPATH' ) or die();

class WL_IMP_Noticeboard_Widget extends WP_Widget {
	/* Widget information set up */
	public function __construct() {
		$widget_options = array( 'classname' => 'wl_im_noticeboard_widget', 'description' => __( 'Display institute notices.', WL_IMP_DOMAIN ) );
		parent::__construct( 'wl_im_noticeboard_widget', __( 'Institute Noticeboard', WL_IMP_DOMAIN ), $widget_options );

		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action( 'wp_head', array( $this, 'noticeboard_assets' ) );
		}
	}

	/* Widget output */
	public function widget( $args, $instance ) {
		global $wpdb;

		$title              = apply_filters( 'widget_title', $instance[ 'title' ] );
		$notices_number     = $instance[ 'notices_number' ];
		$animation_interval = $instance[ 'animation_interval' ];
		$max_height         = $instance[ 'max_height' ];
		$min_height         = $instance[ 'min_height' ];

		/* Get notices */
		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_notices WHERE is_deleted = 0 AND is_active = 1 ORDER BY priority ASC, id DESC LIMIT $notices_number" );

		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		if( count( $data ) > 0 ) { ?>
			<style>
				.wlim-noticeboard-section {
					max-height: <?php echo $max_height; ?>px;
					min-height: <?php echo $min_height; ?>px;
				}
				.wlim-noticeboard {
			    	animation: marquee <?php echo $animation_interval; ?>s linear infinite;
				}
			</style>
			<div class="wlim-noticeboard-section">
				<ul class="wlim-noticeboard">
				<?php
				foreach( $data as $key => $row ) {
					if( $row->link_to == 'url' ) {
						$link_to = $row->url;
					} elseif ( $row->link_to == 'attachment' ) {
						$link_to = wp_get_attachment_url( $row->attachment );
					} else {
						$link_to = '#';
					}
				?>
					<li>
						<a target="_blank" href="<?php echo esc_url( $link_to ); ?>"><?php echo stripcslashes( $row->title ); ?></a>
						<?php
						if ( $key < 3 ) { ?>
						<img class="wlim-noticeboard-new" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/newicon.gif'; ?>">
						<?php
						} ?>
					</li>
				<?php
				} ?>
				</ul>
			</div>
			<?php
		} else { ?>
			<p><?php _e( 'There is no notice.', WL_IMP_DOMAIN ); ?></p>
		<?php
		} ?>
		<?php echo $args['after_widget'];
	}

	/* Widget options form */
	public function form( $instance ) {
		$fields = array(
			'title'              => __( 'Noticeboard', WL_IMP_DOMAIN ),
			'notices_number'     => 6,
			'animation_interval' => 8,
			'max_height'         => 380,
			'min_height'         => 100,
		);
		$instance = wp_parse_args( (array) $instance, $fields );

		$title              = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$notices_number     = ! empty( $instance['notices_number'] ) ? $instance['notices_number'] : '';
		$animation_interval = ! empty( $instance['animation_interval'] ) ? $instance['animation_interval'] : '';
		$max_height         = ! empty( $instance['max_height'] ) ? $instance['max_height'] : 380;
		$min_height         = ! empty( $instance['min_height'] ) ? $instance['min_height'] : 100; ?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', WL_IMP_DOMAIN ); ?>:</label><br>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'notices_number' ); ?>"><?php _e( 'Number of Notices', WL_IMP_DOMAIN ); ?>:</label><br>
		<input type="number" id="<?php echo $this->get_field_id( 'notices_number' ); ?>" name="<?php echo $this->get_field_name( 'notices_number' ); ?>" value="<?php echo esc_attr( $notices_number ); ?>" /><br>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'animation_interval' ); ?>"><?php _e( 'Animation Interval (in seconds)', WL_IMP_DOMAIN ); ?>:</label><br>
		<input type="number" id="<?php echo $this->get_field_id( 'animation_interval' ); ?>" name="<?php echo $this->get_field_name( 'animation_interval' ); ?>" value="<?php echo esc_attr( $animation_interval ); ?>" /><br>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'max_height' ); ?>"><?php _e( 'Maximum Height (in pixels)', WL_IMP_DOMAIN ); ?>:</label><br>
		<input type="number" id="<?php echo $this->get_field_id( 'max_height' ); ?>" name="<?php echo $this->get_field_name( 'max_height' ); ?>" value="<?php echo esc_attr( $max_height ); ?>" /><br>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'min_height' ); ?>"><?php _e( 'Minimum Height (in pixels)', WL_IMP_DOMAIN ); ?>:</label><br>
		<input type="number" id="<?php echo $this->get_field_id( 'min_height' ); ?>" name="<?php echo $this->get_field_name( 'min_height' ); ?>" value="<?php echo esc_attr( $min_height ); ?>" /><br>
		</p><?php
	}

	/* Process widget options on save */
	public function update( $new_instance, $old_instance ) {
		$instance                       = $old_instance;
		$instance['title']              = strip_tags( $new_instance[ 'title' ] );
		$instance['notices_number']     = intval( strip_tags( $new_instance[ 'notices_number' ] ) );
		$instance['animation_interval'] = intval( strip_tags( $new_instance[ 'animation_interval' ] ) );
		$instance['max_height']         = intval( strip_tags( $new_instance[ 'max_height' ] ) );
		$instance['min_height']         = intval( strip_tags( $new_instance[ 'min_height' ] ) );

		if ( empty( $instance['animation_interval'] ) ) {
			$instance['animation_interval'] = 8;
		}
		return $instance;
	}

	/* Noticeboard widget assets */
	public function noticeboard_assets() { ?>
		<style>
			.wlim-noticeboard-section {
				max-height: 380px;
				overflow: hidden;
			}
			.wlim-noticeboard {
				overflow: hidden;
			    top: 6em;
			    position: relative;
			    box-sizing: border-box;
			}
			.wlim-noticeboard:hover {
			    animation-play-state: paused;
			}
			.wlim-noticeboard li {
				margin-bottom: 5px;
			}
			@keyframes marquee {
			    0%   { top: 8em }
			    100% { top: -8em }
			}
			.wlim-noticeboard-new {
				display: inline;
				margin-left: 4px;
			}
		</style>
	<?php
	}
}
?>