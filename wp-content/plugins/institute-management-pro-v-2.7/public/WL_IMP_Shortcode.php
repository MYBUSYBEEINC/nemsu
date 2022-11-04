<?php
defined( 'ABSPATH' ) or die();

class WL_IMP_Shortcode {
	public static function create_enquiry_form( $attr ) {
		ob_start();
		require_once( 'inc/wl_im_enquiry_form.php' );
		return ob_get_clean();
	}

	public static function create_result_form( $attr ) {
		ob_start();
		require_once( 'inc/wl_im_result_form.php' );
		return ob_get_clean();
	}

	public static function shortcode_assets() {
	    global $post;
	    if( is_a( $post, 'WP_Post' ) ) {
	    	if ( has_shortcode( $post->post_content, 'institute_enquiry_form') || has_shortcode( $post->post_content, 'institute_exam_result') ) {
				/* Enqueue styles */
				wp_enqueue_style( 'wl-im-bootstrap', WL_IMP_PLUGIN_URL . 'public/css/bootstrap.min.css' );
				wp_enqueue_style( 'wl-im-font-awesome', WL_IMP_PLUGIN_URL . 'assets/css/font-awesome.min.css' );
				wp_enqueue_style( 'wl-im-toastr', WL_IMP_PLUGIN_URL . 'assets/css/toastr.min.css' );
				wp_enqueue_style( 'wl-im-bootstrap-datetimepicker', WL_IMP_PLUGIN_URL . 'assets/css/bootstrap-datetimepicker.min.css' );
				wp_enqueue_style( 'wl-im-style', WL_IMP_PLUGIN_URL . 'public/css/wl-im-style.css' );

				/* Enqueue scripts */
				wp_enqueue_script( 'jquery-form' );
				wp_enqueue_script( 'wl-im-popper-js', WL_IMP_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'wl-im-bootstrap-js', WL_IMP_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'wl-im-toastr-js', WL_IMP_PLUGIN_URL . 'assets/js/toastr.min.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'wl-im-moment-js', WL_IMP_PLUGIN_URL . 'assets/js/moment.min.js', array(), true, true );
				wp_enqueue_script( 'wl-im-bootstrap-datetimepicker-js', WL_IMP_PLUGIN_URL . 'assets/js/bootstrap-datetimepicker.min.js', array( 'wl-im-bootstrap-js' ), true, true );
				wp_enqueue_script( 'wl-im-script-js', WL_IMP_PLUGIN_URL . 'public/js/wl-im-script.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'wl-im-ajax-js', WL_IMP_PLUGIN_URL . 'public/js/wl-im-ajax.js', array( 'jquery' ), true, true );
				wp_localize_script( 'wl-im-ajax-js', 'WLIMAjax', array( 'security' => wp_create_nonce( 'wl-im' ) ) );
				wp_localize_script( 'wl-im-ajax-js', 'wlimajaxurl', esc_url( admin_url( 'admin-post.php' ) ) );
	    	}
	    }
	}
}