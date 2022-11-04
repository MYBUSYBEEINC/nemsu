<?php
defined( 'ABSPATH' ) || die();

require_once UISP_PLUGIN_DIR_PATH . 'includes/UISP_Helper.php';

class UISP_Slider_Admin {
	public static function add_meta_boxes() {
		add_meta_box( 'urisp-images', esc_html__( 'Add Images', 'urisp' ), array( 'UISP_Slider_Admin', 'images_meta_box' ), 'urisp_slider', 'normal', 'low' );

		add_meta_box( 'urisp-settings', esc_html__( 'Apply Settings On Ultimate Image Slider', 'urisp' ), array( 'UISP_Slider_Admin', 'settings_meta_box' ), 'urisp_slider', 'normal', 'low' );

		add_meta_box('urisp-copy-shortcode', esc_html__( 'Copy Image Slider Shortcode', 'urisp' ), array( 'UISP_Slider_Admin', 'copy_shortcode_meta_box' ), 'urisp_slider', 'side', 'low' );

		add_meta_box('urisp-do-shortcode', esc_html__( 'Display Slider in your Theme', 'urisp' ), array( 'UISP_Slider_Admin', 'do_shortcode_meta_box' ), 'urisp_slider', 'side', 'low' );
	}

	public static function create_menu() {
		if ( UISP_Helper::lm_valid() ) {
			$help_support = add_submenu_page( 'edit.php?post_type=urisp_slider', esc_html__( 'Help and Support', 'urisp' ), esc_html__( 'Help and Support', 'urisp' ), 'manage_options', 'urisp_help_support', array( 'UISP_Slider_Admin', 'help_support' ) );
			add_action( 'admin_print_styles-' . $help_support, array( 'UISP_Slider_Admin', 'help_support_assets' ) );

			$wl_admin_submenu = add_submenu_page( 'edit.php?post_type=urisp_slider', esc_html__( 'License', 'urisp' ), esc_html__( 'License', 'urisp' ), 'manage_options', 'urisp_license', array( 'UISP_Slider_Admin', 'admin_menu' ) );
			add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'UISP_Slider_Admin', 'admin_menu_assets' ) );
		} else {
			$wl_admin_submenu = add_menu_page( esc_html__( 'Ultimate Image Slider Pro', 'urisp' ), esc_html__( 'Ultimate Image Slider Pro', 'urisp' ), 'manage_options', 'urisp_license', array( 'UISP_Slider_Admin', 'admin_menu' ), 'dashicons-format-gallery', 27 );
			add_action( 'admin_print_styles-' . $wl_admin_submenu, array( 'UISP_Slider_Admin', 'admin_menu_assets' ) );
		}
	}

	public static function admin_menu() {
		require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/pages/admin_menu.php';
	}

	public static function admin_menu_assets() {
		wp_enqueue_style( 'uisp_lc', UISP_PLUGIN_URL . 'assets/css/admin_menu.css' );
	}

	public static function help_support() {
		require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/pages/help_support.php';
	}

	public static function images_meta_box( $post ) {
		require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/metaboxes/images.php';
	}

	public static function settings_meta_box( $post ) {
		require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/metaboxes/settings.php';
	}

	public static function copy_shortcode_meta_box( $post ) {
		require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/metaboxes/copy_shortcode.php';
	}

	public static function do_shortcode_meta_box( $post ) {
		require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/metaboxes/do_shortcode.php';
	}

	public static function help_support_assets() {
		/* Enqueue styles */
		wp_enqueue_style( 'bootstrap', UISP_PLUGIN_URL . 'assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'urisp-admin', UISP_PLUGIN_URL . 'assets/css/urisp-admin.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'popper', UISP_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'bootstrap', UISP_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'popper' ), true, true );
	}

	public static function enqueue_scripts_styles( $hook_suffix ) {
		if ( in_array( $hook_suffix, array('post.php', 'post-new.php') ) ) {
			$screen = get_current_screen();
			if ( is_object( $screen ) && 'urisp_slider' == $screen->post_type ) {
				/* Enqueue styles */
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style( 'bootstrap', UISP_PLUGIN_URL . 'assets/css/bootstrap.min.css' );
				wp_enqueue_style( 'codemirror', UISP_PLUGIN_URL . 'assets/css/codemirror.css' );
				wp_enqueue_style( 'blackboard', UISP_PLUGIN_URL . 'assets/css/blackboard.css' );
				wp_enqueue_style( 'fontselect', UISP_PLUGIN_URL . 'assets/css/fontselect.css' );
				wp_enqueue_style( 'urisp-admin', UISP_PLUGIN_URL . 'assets/css/urisp-admin.css' );

				/* Enqueue scripts */
				wp_enqueue_media();
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( 'popper', UISP_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'bootstrap', UISP_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'popper' ), true, true );
				wp_enqueue_script( 'codemirror', UISP_PLUGIN_URL . 'assets/js/codemirror.js', array(), true, true );
				wp_enqueue_script( 'jquery-fontselect', UISP_PLUGIN_URL . 'assets/js/jquery.fontselect.min.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'urisp-admin', UISP_PLUGIN_URL . 'assets/js/urisp-admin.js', array( 'jquery', 'codemirror' ), true, true );
			}
		}
	}

	public static function save_metaboxes( $post_id, $post ) {
		if ( ! isset( $_POST['slider_meta_' . $post_id] ) || ! wp_verify_nonce( $_POST['slider_meta_' . $post_id], 'save_slider_meta_' . $post_id ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		if ( wp_is_post_revision( $post ) ) {
			return;
		}
		if ( 'urisp_slider' !== $post->post_type ) {
			return;
		}

		require_once UISP_PLUGIN_DIR_PATH . 'includes/UISP_Helper.php';

		/* Images */
		$images       = ( isset( $_POST['image'] ) && is_array( $_POST['image'] ) ) ? $_POST['image'] : array();
		$images_title = ( isset( $_POST['image_title'] ) && is_array( $_POST['image_title'] ) ) ? $_POST['image_title'] : array();
		$images_desc  = ( isset( $_POST['image_desc'] ) && is_array( $_POST['image_desc'] ) ) ? $_POST['image_desc'] : array();
		$images_link  = ( isset( $_POST['image_link'] ) && is_array( $_POST['image_link'] ) ) ? $_POST['image_link'] : array();

		if ( count( $images ) > 0 && ( count( $images ) === count( $images_title ) ) && ( count( $images ) === count( $images_desc ) ) && ( count( $images ) === count( $images_link ) ) ) {

			$data_images = array();
			foreach( $images as $key => $image ) {
				array_push(
					$data_images,
					array(
						'id'    => absint( $image ),
						'title' => ( isset( $images_title[ $key ] ) && ! empty( $images_title[ $key ] ) ) ? sanitize_text_field( $images_title[ $key ] ) : '',
						'desc'  => ( isset( $images_desc[ $key ] ) && ! empty( $images_desc[ $key ] ) ) ? wp_kses_post( $images_desc[ $key ] ) : '',
						'link'  => ( isset( $images_link[ $key ] ) && ! empty( $images_link[ $key ] ) ) ? strip_tags( stripslashes( filter_var( $images_link[ $key ], FILTER_VALIDATE_URL ) ) ) : '',
					)
				);
			}

			update_post_meta( $post_id, 'urisp_image', $data_images );
		}

		/* Settings: General */
		$layout = isset( $_POST['layout'] ) ? sanitize_text_field( $_POST['layout'] ) : 'layout1';
		$display_slide_title = isset( $_POST['display_slide_title'] ) ? (bool) $_POST['display_slide_title'] : true;

		if ( ! in_array( $layout, array( 'layout1', 'layout2', 'layout3', 'layout4' ) ) ) {
			$layout = 'layout1';
		}

		$data_general = array(
			'layout'              => $layout,
			'display_slide_title' => $display_slide_title,
		);

		update_post_meta( $post_id, 'urisp_general_setting', $data_general );

		/* Settings: Layout 1 */
		$l1_custom_css = isset( $_POST['l1_custom_css'] ) ? sanitize_text_field( $_POST['l1_custom_css'] ) : '';

		$l1_autoplay          = isset( $_POST['l1_autoplay'] ) ? (bool) $_POST['l1_autoplay'] : true;
		$l1_autoplay_interval = isset( $_POST['l1_autoplay_interval'] ) ? abs( $_POST['l1_autoplay_interval'] ) : 5000;
		$l1_autoplay_on_hover = isset( $_POST['l1_autoplay_on_hover'] ) ? sanitize_text_field( $_POST['l1_autoplay_on_hover'] ) : 'pause';

		$l1_full_screen = isset( $_POST['l1_full_screen'] ) ? sanitize_text_field( $_POST['l1_full_screen'] ) : true;

		$l1_width_type       = isset( $_POST['l1_width_type'] ) ? sanitize_text_field( $_POST['l1_width_type'] ) : 'fixed';
		$l1_width_fixed      = isset( $_POST['l1_width_fixed'] ) ? abs( $_POST['l1_width_fixed'] ) : 500;
		$l1_width_percentage = isset( $_POST['l1_width_percentage'] ) ? abs( $_POST['l1_width_percentage'] ) : 100;
		$l1_force_size       = isset( $_POST['l1_force_size'] ) ? sanitize_text_field( $_POST['l1_force_size'] ) : 'none';

		$l1_height_type       = isset( $_POST['l1_height_type'] ) ? sanitize_text_field( $_POST['l1_height_type'] ) : 'fixed';
		$l1_height_fixed      = isset( $_POST['l1_height_fixed'] ) ? abs( $_POST['l1_height_fixed'] ) : 300;
		$l1_height_percentage = isset( $_POST['l1_height_percentage'] ) ? abs( $_POST['l1_height_percentage'] ) : 100;
		$l1_auto_height       = isset( $_POST['l1_auto_height'] ) ? (bool) $_POST['l1_auto_height'] : false;

		$l1_fade = isset( $_POST['l1_fade'] ) ? (bool) $_POST['l1_fade'] : false;

		$l1_image_scale_mode = isset( $_POST['l1_image_scale_mode'] ) ? sanitize_text_field( $_POST['l1_image_scale_mode'] ) : 'cover';

		$l1_slide_distance = isset( $_POST['l1_slide_distance'] ) ? abs( $_POST['l1_slide_distance'] ) : 10;

		$l1_orientation = isset( $_POST['l1_orientation'] ) ? sanitize_text_field( $_POST['l1_orientation'] ) : 'horizontal';

		$l1_navigation = isset( $_POST['l1_navigation'] ) ? (bool) $_POST['l1_navigation'] : true;

		$l1_thumbnail_type = isset( $_POST['l1_thumbnail_type'] ) ? sanitize_text_field( $_POST['l1_thumbnail_type'] ) : 'image';

		$l1_arrows                  = isset( $_POST['l1_arrows'] ) ? (bool) $_POST['l1_arrows'] : false;
		$l1_thumbnail_arrows        = isset( $_POST['l1_thumbnail_arrows'] ) ? (bool) $_POST['l1_thumbnail_arrows'] : true;
		$l1_thumbnail_pointer       = isset( $_POST['l1_thumbnail_pointer'] ) ? (bool) $_POST['l1_thumbnail_pointer'] : false;
		$l1_thumbnail_pointer_color = isset( $_POST['l1_thumbnail_pointer_color'] ) ? sanitize_hex_color( $_POST['l1_thumbnail_pointer_color'] ) : '#ff0000';

		$l1_thumbnails_position = isset( $_POST['l1_thumbnails_position'] ) ? sanitize_text_field( $_POST['l1_thumbnails_position'] ) : 'bottom';

		$l1_thumbnail_width  = isset( $_POST['l1_thumbnail_width'] ) ? abs( $_POST['l1_thumbnail_width'] ) : 100;
		$l1_thumbnail_height = isset( $_POST['l1_thumbnail_height'] ) ? abs( $_POST['l1_thumbnail_height'] ) : 80;

		$l1_shuffle = isset( $_POST['l1_shuffle'] ) ? (bool) $_POST['l1_shuffle'] : false;

		$l1_title_link_color         = isset( $_POST['l1_title_link_color'] ) ? sanitize_hex_color( $_POST['l1_title_link_color'] ) : '#ffffff';
		$l1_layer_text_color         = isset( $_POST['l1_layer_text_color'] ) ? sanitize_hex_color( $_POST['l1_layer_text_color'] ) : '#000000';
		$l1_layer_background_color   = isset( $_POST['l1_layer_background_color'] ) ? sanitize_hex_color( $_POST['l1_layer_background_color'] ) : '#ffffff';
		$l1_layer_background_opacity = isset( $_POST['l1_layer_background_opacity'] ) ? sanitize_text_field( $_POST['l1_layer_background_opacity'] ) : '0.7';

		$l1_layer_title_font_size     = isset( $_POST['l1_layer_title_font_size'] ) ? abs( $_POST['l1_layer_title_font_size'] ) : 18;
		$l1_layer_text_font_size      = isset( $_POST['l1_layer_text_font_size'] ) ? abs( $_POST['l1_layer_text_font_size'] ) : 14;
		$l1_thumbnail_title_font_size = isset( $_POST['l1_thumbnail_title_font_size'] ) ? abs( $_POST['l1_thumbnail_title_font_size'] ) : 18;
		$l1_thumbnail_text_font_size  = isset( $_POST['l1_thumbnail_text_font_size'] ) ? abs( $_POST['l1_thumbnail_text_font_size'] ) : 14;

		$l1_layer_text_align     = isset( $_POST['l1_layer_text_align'] ) ? sanitize_text_field( $_POST['l1_layer_text_align'] ) : 'left';
		$l1_title_layer_position = isset( $_POST['l1_title_layer_position'] ) ? sanitize_text_field( $_POST['l1_title_layer_position'] ) : 'centerCenter';
		$l1_text_layer_position  = isset( $_POST['l1_text_layer_position'] ) ? sanitize_text_field( $_POST['l1_text_layer_position'] ) : 'bottomLeft';

		$l1_link_new_tab = isset( $_POST['l1_link_new_tab'] ) ? (bool) $_POST['l1_link_new_tab'] : true;

		$l1_show_thumbnails = isset( $_POST['l1_show_thumbnails'] ) ? (bool) $_POST['l1_show_thumbnails'] : true;

		$l1_font_family = isset( $_POST['l1_font_family'] ) ? sanitize_text_field( $_POST['l1_font_family'] ) : '';

		if ( $l1_autoplay_interval <= 0 ) {
			$l1_autoplay_interval = 5000;
		}

		if ( ! in_array( $l1_autoplay_on_hover, array( 'pause', 'stop', 'none' ) ) ) {
			$l1_autoplay_on_hover = 'pause';
		}

		if ( ! in_array( $l1_width_type, array( 'fixed', 'percentage' ) ) ) {
			$l1_width_type = 'fixed';
		}

		if ( $l1_width_fixed <= 0 ) {
			$l1_width_fixed = 500;
		}

		if ( $l1_width_percentage <= 0 || $l1_width_percentage > 100 ) {
			$l1_width_percentage = 100;
		}

		if ( ! in_array( $l1_force_size, array( 'none', 'fullWidth', 'fullWindow' ) ) ) {
			$l1_force_size = 'none';
		}

		if ( ! in_array( $l1_height_type, array( 'fixed', 'percentage' ) ) ) {
			$l1_height_type = 'fixed';
		}

		if ( $l1_height_fixed <= 0 ) {
			$l1_height_fixed = 300;
		}

		if ( $l1_height_percentage <= 0 || $l1_height_percentage > 100 ) {
			$l1_height_percentage = 100;
		}

		if ( ! in_array( $l1_image_scale_mode, array( 'cover', 'contain', 'exact', 'none' ) ) ) {
			$l1_image_scale_mode = 'cover';
		}

		if ( $l1_slide_distance < 0 ) {
			$l1_slide_distance = 10;
		}

		if ( ! in_array( $l1_orientation, array( 'horizontal', 'vertical' ) ) ) {
			$l1_orientation = 'horizontal';
		}

		if ( ! in_array( $l1_thumbnail_type, array( 'image', 'text' ) ) ) {
			$l1_thumbnail_type = 'image';
		}

		if ( ! in_array( $l1_thumbnails_position, array( 'top', 'bottom', 'right', 'left' ) ) ) {
			$l1_thumbnails_position = 'bottom';
		}

		if ( ! in_array( $l1_layer_text_align, array( 'left', 'center', 'right' ) ) ) {
			$l1_layer_text_align = 'left';
		}

		if ( $l1_thumbnail_width <= 0 ) {
			$l1_thumbnail_width = 100;
		}

		if ( $l1_thumbnail_height <= 0 ) {
			$l1_thumbnail_height = 80;
		}

		if ( ! in_array( $l1_layer_background_opacity, UISP_Helper::layer_background_opacity() ) ) {
			$l1_layer_background_opacity = '0.7';
		}

		if ( ! in_array( $l1_title_layer_position, array( 'topLeft', 'topCenter', 'topRight', 'bottomLeft', 'bottomCenter', 'bottomRight', 'centerLeft', 'centerRight', 'centerCenter' ) ) ) {
			$l1_title_layer_position = 'centerCenter';
		}

		if ( ! in_array( $l1_text_layer_position,  array( 'topLeft', 'topCenter', 'topRight', 'bottomLeft', 'bottomCenter', 'bottomRight', 'centerLeft', 'centerRight', 'centerCenter' ) ) ) {
			$l1_title_layer_position = 'bottomLeft';
		}

		$data_layout1 = array(
			'custom_css'                => $l1_custom_css,
			'autoplay'                  => $l1_autoplay,
			'autoplay_interval'         => $l1_autoplay_interval,
			'autoplay_on_hover'         => $l1_autoplay_on_hover,
			'full_screen'               => $l1_full_screen,
			'width_type'                => $l1_width_type,
			'width_fixed'               => $l1_width_fixed,
			'width_percentage'          => $l1_width_percentage,
			'force_size'                => $l1_force_size,
			'height_type'               => $l1_height_type,
			'height_fixed'              => $l1_height_fixed,
			'height_percentage'         => $l1_height_percentage,
			'auto_height'               => $l1_auto_height,
			'fade'                      => $l1_fade,
			'image_scale_mode'          => $l1_image_scale_mode,
			'slide_distance'            => $l1_slide_distance,
			'orientation'               => $l1_orientation,
			'pagination'                => $l1_navigation,
			'thumbnail_type'            => $l1_thumbnail_type,
			'arrows'                    => $l1_arrows,
			'thumbnail_arrows'          => $l1_thumbnail_arrows,
			'thumbnail_pointer'         => $l1_thumbnail_pointer,
			'thumbnail_pointer_color'   => $l1_thumbnail_pointer_color,
			'thumbnails_position'       => $l1_thumbnails_position,
			'thumbnail_width'           => $l1_thumbnail_width,
			'thumbnail_height'          => $l1_thumbnail_height,
			'shuffle'                   => $l1_shuffle,
			'title_link_color'          => $l1_title_link_color,
			'layer_text_color'          => $l1_layer_text_color,
			'layer_background_color'    => $l1_layer_background_color,
			'layer_background_opacity'  => $l1_layer_background_opacity,
			'layer_title_font_size'     => $l1_layer_title_font_size,
			'layer_text_font_size'      => $l1_layer_text_font_size,
			'thumbnail_title_font_size' => $l1_thumbnail_title_font_size,
			'thumbnail_text_font_size'  => $l1_thumbnail_text_font_size,
			'layer_text_align'          => $l1_layer_text_align,
			'title_layer_position'      => $l1_title_layer_position,
			'text_layer_position'       => $l1_text_layer_position,
			'link_new_tab'              => $l1_link_new_tab,
			'show_thumbnails'       	=> $l1_show_thumbnails,
			'font_family'               => $l1_font_family,
		);

		update_post_meta( $post_id, 'urisp_layout1_setting', $data_layout1 );

		/* Settings: Layout 2 */
		$l2_custom_css = isset( $_POST['l2_custom_css'] ) ? sanitize_text_field( $_POST['l2_custom_css'] ) : '';

		$l2_show_thumbnails = isset( $_POST['l2_show_thumbnails'] ) ? (bool) $_POST['l2_show_thumbnails'] : true;
		$l2_show_toolbar    = isset( $_POST['l2_show_toolbar'] ) ? (bool) $_POST['l2_show_toolbar'] : true;
		$l2_show_infobar    = isset( $_POST['l2_show_infobar'] ) ? (bool) $_POST['l2_show_infobar'] : true;

		$l2_arrows = isset( $_POST['l2_arrows'] ) ? (bool) $_POST['l2_arrows'] : true;

		$l2_title_color      = isset( $_POST['l2_title_color'] ) ? sanitize_hex_color( $_POST['l2_title_color'] ) : '#ffffff';
		$l2_title_link_color = isset( $_POST['l2_title_link_color'] ) ? sanitize_hex_color( $_POST['l2_title_link_color'] ) : '#1e73be';
		$l2_desc_color       = isset( $_POST['l2_desc_color'] ) ? sanitize_hex_color( $_POST['l2_desc_color'] ) : '#ffffff';

		$l2_link_new_tab = isset( $_POST['l2_link_new_tab'] ) ? (bool) $_POST['l2_link_new_tab'] : true;

		$l2_font_family = isset( $_POST['l2_font_family'] ) ? sanitize_text_field( $_POST['l2_font_family'] ) : '';

		$data_layout2 = array(
			'custom_css'       => $l2_custom_css,
			'show_thumbnails'  => $l2_show_thumbnails,
			'show_toolbar'     => $l2_show_toolbar,
			'show_infobar'     => $l2_show_infobar,
			'arrows'           => $l2_arrows,
			'title_color'      => $l2_title_color,
			'title_link_color' => $l2_title_link_color,
			'desc_color'       => $l2_desc_color,
			'link_new_tab'     => $l2_link_new_tab,
			'font_family'      => $l2_font_family,
		);

		update_post_meta( $post_id, 'urisp_layout2_setting', $data_layout2 );

		/* Settings: Layout 3 */
		$l3_custom_css = isset( $_POST['l3_custom_css'] ) ? sanitize_text_field( $_POST['l3_custom_css'] ) : '';

		$l3_autoplay   = isset( $_POST['l3_autoplay'] ) ? (bool) $_POST['l3_autoplay'] : true;
		$l3_auto_hover = isset( $_POST['l3_auto_hover'] ) ? (bool) $_POST['l3_auto_hover'] : true;
		$l3_speed      = isset( $_POST['l3_speed'] ) ? abs( $_POST['l3_speed'] ) : 800;
		$l3_pause      = isset( $_POST['l3_pause'] ) ? abs( $_POST['l3_pause'] ) : 3000;

		$l3_arrows = isset( $_POST['l3_arrows'] ) ? (bool) $_POST['l3_arrows'] : true;
		$l3_pager  = isset( $_POST['l3_pager'] ) ? (bool) $_POST['l3_pager'] : true;

		$l3_transition = isset( $_POST['l3_transition'] ) ? sanitize_text_field( $_POST['l3_transition'] ) : 'fade';

		$l3_adaptive_height  = isset( $_POST['l3_adaptive_height'] ) ? (bool) $_POST['l3_adaptive_height'] : true;
		$l3_max_height       = isset( $_POST['l3_max_height'] ) ? sanitize_text_field( $_POST['l3_max_height'] ) : 'unset';
		$l3_max_height_fixed = isset( $_POST['l3_max_height_fixed'] ) ? abs( $_POST['l3_max_height_fixed'] ) : '';

		$l3_title_color                = isset( $_POST['l3_title_color'] ) ? sanitize_hex_color( $_POST['l3_title_color'] ) : '#ffffff';
		$l3_title_link_color           = isset( $_POST['l3_title_link_color'] ) ? sanitize_hex_color( $_POST['l3_title_link_color'] ) : '#e24b70';
		$l3_desc_color                 = isset( $_POST['l3_desc_color'] ) ? sanitize_hex_color( $_POST['l3_desc_color'] ) : '#ffffff';
		$l3_pager_background_color     = isset( $_POST['l3_pager_background_color'] ) ? sanitize_hex_color( $_POST['l3_pager_background_color'] ) : '#e24b70';
		$l3_caption_background_color   = isset( $_POST['l3_caption_background_color'] ) ? sanitize_hex_color( $_POST['l3_caption_background_color'] ) : '#000000';
		$l3_caption_background_opacity = isset( $_POST['l3_caption_background_opacity'] ) ? sanitize_text_field( $_POST['l3_caption_background_opacity'] ) : '0.5';

		$l3_title_font_size = isset( $_POST['l3_title_font_size'] ) ? abs( $_POST['l3_title_font_size'] ) : 18;
		$l3_text_font_size  = isset( $_POST['l3_text_font_size'] ) ? abs( $_POST['l3_text_font_size'] ) : 14;
		$l3_title_align     = isset( $_POST['l3_title_align'] ) ? sanitize_text_field( $_POST['l3_title_align'] ) : 'left';
		$l3_text_align      = isset( $_POST['l3_text_align'] ) ? sanitize_text_field( $_POST['l3_text_align'] ) : 'left';

		$l3_link_new_tab = isset( $_POST['l3_link_new_tab'] ) ? (bool) $_POST['l3_link_new_tab'] : true;

		$l3_font_family = isset( $_POST['l3_font_family'] ) ? sanitize_text_field( $_POST['l3_font_family'] ) : '';

		if ( $l3_speed <= 0 ) {
			$l3_speed = 800;
		}

		if ( $l3_pause <= 0 ) {
			$l3_pause = 3000;
		}

		if ( ! in_array( $l3_transition, array( 'fade', 'horizontal', 'vertical', 'kenburns', '' ) ) ) {
			$l3_transition = 'fade';
		}

		if ( ! in_array( $l3_caption_background_opacity, UISP_Helper::layer_background_opacity() ) ) {
			$l3_caption_background_opacity = '0.5';
		}

		if ( 'fixed' !== $l3_max_height ) {
			$l3_max_height_fixed = '';
		}

		if ( ! in_array( $l3_title_align, array( 'left', 'center', 'right' ) ) ) {
			$l3_title_align = 'left';
		}

		if ( ! in_array( $l3_text_align, array( 'left', 'center', 'right' ) ) ) {
			$l3_text_align = 'left';
		}

		$data_layout3 = array(
			'custom_css'                 => $l3_custom_css,
			'autoplay'                   => $l3_autoplay,
			'auto_hover'                 => $l3_auto_hover,
			'speed'                      => $l3_speed,
			'pause'                      => $l3_pause,
			'arrows'                     => $l3_arrows,
			'pager'                      => $l3_pager,
			'transition'                 => $l3_transition,
			'adaptive_height'            => $l3_adaptive_height,
			'max_height_fixed'           => $l3_max_height_fixed,
			'title_color'                => $l3_title_color,
			'title_link_color'           => $l3_title_link_color,
			'desc_color'                 => $l3_desc_color,
			'pager_background_color'     => $l3_pager_background_color,
			'caption_background_color'   => $l3_caption_background_color,
			'caption_background_opacity' => $l3_caption_background_opacity,
			'title_font_size'            => $l3_title_font_size,
			'text_font_size'             => $l3_text_font_size,
			'title_align'                => $l3_title_align,
			'text_align'                 => $l3_text_align,
			'link_new_tab'               => $l3_link_new_tab,
			'font_family'                => $l3_font_family,
		);

		update_post_meta( $post_id, 'urisp_layout3_setting', $data_layout3 );

		/* Settings: Layout 4 */
		$l4_custom_css = isset( $_POST['l4_custom_css'] ) ? sanitize_text_field( $_POST['l4_custom_css'] ) : '';

		$l4_overlay     = isset( $_POST['l4_overlay'] ) ? (bool) $_POST['l4_overlay'] : true;
		$l4_spinner     = isset( $_POST['l4_spinner'] ) ? (bool) $_POST['l4_spinner'] : true;
		$l4_nav         = isset( $_POST['l4_nav'] ) ? (bool) $_POST['l4_nav'] : true;
		$l4_close       = isset( $_POST['l4_close'] ) ? (bool) $_POST['l4_close'] : true;
		$l4_swipe_close = isset( $_POST['l4_swipe_close'] ) ? (bool) $_POST['l4_swipe_close'] : true;
		$l4_doc_close   = isset( $_POST['l4_doc_close'] ) ? (bool) $_POST['l4_doc_close'] : true;
		$l4_counter     = isset( $_POST['l4_counter'] ) ? (bool) $_POST['l4_counter'] : true;
		$l4_preloading  = isset( $_POST['l4_preloading'] ) ? (bool) $_POST['l4_preloading'] : true;
		$l4_keyboard    = isset( $_POST['l4_keyboard'] ) ? (bool) $_POST['l4_keyboard'] : true;
		$l4_loop        = isset( $_POST['l4_loop'] ) ? (bool) $_POST['l4_loop'] : true;

		$l4_width_ratio  = isset( $_POST['l4_width_ratio'] ) ? sanitize_text_field( $_POST['l4_width_ratio'] ) : '0.8';
		$l4_height_ratio = isset( $_POST['l4_height_ratio'] ) ? sanitize_text_field( $_POST['l4_height_ratio'] ) : '0.9';

		$l4_scale_image_to_ratio = isset( $_POST['l4_scale_image_to_ratio'] ) ? (bool) $_POST['l4_scale_image_to_ratio'] : false;
		$l4_disable_right_click  = isset( $_POST['l4_disable_right_click'] ) ? (bool) $_POST['l4_disable_right_click'] : false;

		$l4_double_tap_zoom = isset( $_POST['l4_double_tap_zoom'] ) ? absint( $_POST['l4_double_tap_zoom'] ) : 2;
		$l4_max_zoom        = isset( $_POST['l4_max_zoom'] ) ? absint( $_POST['l4_max_zoom'] ) : 10;

		$l4_animation_slide = isset( $_POST['l4_animation_slide'] ) ? (bool) $_POST['l4_animation_slide'] : true;
		$l4_animation_speed = isset( $_POST['l4_animation_speed'] ) ? absint( $_POST['l4_animation_speed'] ) : 250;

		$l4_caption          = isset( $_POST['l4_caption'] ) ? (bool) $_POST['l4_caption'] : true;
		$l4_caption_position = isset( $_POST['l4_caption_position'] ) ? sanitize_text_field( $_POST['l4_caption_position'] ) : 'bottom';

		$l4_title_color              = isset( $_POST['l4_title_color'] ) ? sanitize_hex_color( $_POST['l4_title_color'] ) : '#ffffff';
		$l4_title_link_color         = isset( $_POST['l4_title_link_color'] ) ? sanitize_hex_color( $_POST['l4_title_link_color'] ) : '#0274be';
		$l4_desc_color               = isset( $_POST['l4_desc_color'] ) ? sanitize_hex_color( $_POST['l4_desc_color'] ) : '#ffffff';
		$l4_caption_background_color = isset( $_POST['l4_caption_background_color'] ) ? sanitize_hex_color( $_POST['l4_caption_background_color'] ) : '#000000';

		$l4_title_font_size = isset( $_POST['l4_title_font_size'] ) ? abs( $_POST['l4_title_font_size'] ) : 16;
		$l4_text_font_size  = isset( $_POST['l4_text_font_size'] ) ? abs( $_POST['l4_text_font_size'] ) : 13;
		$l4_title_align     = isset( $_POST['l4_title_align'] ) ? sanitize_text_field( $_POST['l4_title_align'] ) : 'left';
		$l4_text_align      = isset( $_POST['l4_text_align'] ) ? sanitize_text_field( $_POST['l4_text_align'] ) : 'left';

		$l4_link_new_tab = isset( $_POST['l4_link_new_tab'] ) ? (bool) $_POST['l4_link_new_tab'] : true;

		$l4_font_family = isset( $_POST['l4_font_family'] ) ? sanitize_text_field( $_POST['l4_font_family'] ) : '';

		if ( ! in_array( $l4_width_ratio, UISP_Helper::width_height_ratio() ) ) {
			$l4_width_ratio = '0.8';
		}
		if ( ! in_array( $l4_height_ratio, UISP_Helper::width_height_ratio() ) ) {
			$l4_height_ratio = '0.9';
		}
		if ( ! in_array( $l4_caption_position, array( 'top', 'bottom' ) ) ) {
			$l4_caption_position = 'bottom';
		}

		$data_layout4 = array(
			'custom_css'               => $l4_custom_css,
			'overlay'                  => $l4_overlay,
			'spinner'                  => $l4_spinner,
			'nav'                      => $l4_nav,
			'close'                    => $l4_close,
			'swipe_close'              => $l4_swipe_close,
			'doc_close'                => $l4_doc_close,
			'counter'                  => $l4_counter,
			'preloading'               => $l4_preloading,
			'keyboard'                 => $l4_keyboard,
			'loop'                     => $l4_loop,
			'width_ratio'              => $l4_width_ratio,
			'height_ratio'             => $l4_height_ratio,
			'font_family'              => $l4_font_family,
			'scale_image_to_ratio'     => $l4_scale_image_to_ratio,
			'disable_right_click'      => $l4_disable_right_click,
			'double_tap_zoom'          => $l4_double_tap_zoom,
			'max_zoom'                 => $l4_max_zoom,
			'animation_slide'          => $l4_animation_slide,
			'animation_speed'          => $l4_animation_speed,
			'caption'                  => $l4_caption,
			'caption_position'         => $l4_caption_position,
			'title_color'              => $l4_title_color,
			'title_link_color'         => $l4_title_link_color,
			'desc_color'               => $l4_desc_color,
			'caption_background_color' => $l4_caption_background_color,
			'title_font_size'          => $l4_title_font_size,
			'text_font_size'           => $l4_text_font_size,
			'title_align'              => $l4_title_align,
			'text_align'               => $l4_text_align,
			'link_new_tab'             => $l4_link_new_tab,
		);

		update_post_meta( $post_id, 'urisp_layout4_setting', $data_layout4 );
	}

	public static function edit_columns( $columns ) {
		$columns = array(
			'cb'           => '<input type="checkbox" />',
			'title'        => esc_html__( 'Ultimate Image Slider Title', 'urisp' ),
			'author'       => esc_html__( 'Author', 'urisp' ),
			'shortcode'    => esc_html__( 'Ultimate Image Slider Pro Shortcode', 'urisp' ),
			'do_shortcode' => esc_html__( 'Display Slider in Theme', 'urisp' ),
			'date'         => esc_html__( 'Date', 'urisp' ),
		);

		return $columns;
	}

	public static function custom_column( $column, $post_id ) {
		global $post;
		switch ( $column ) {
			case 'shortcode':
				echo '<input type="text" value="[UISP id=' . esc_attr( $post_id ) . ']" readonly="readonly" />';
				break;
			case 'do_shortcode':
				echo '<input type="text" value="<?php echo do_shortcode( \'[UISP id=' . esc_attr( $post_id ) . ']\' ); ?>" readonly="readonly" />';
				break;
			default:
				break;
		}
	}
}
