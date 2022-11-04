<?php
defined( 'ABSPATH' ) || die();

require_once UISP_PLUGIN_DIR_PATH . 'includes/UISP_Helper.php';

class UISP_Slider {
	public static function register_slider_post_type() {
		if ( UISP_Helper::lm_valid() ) {
			$valid = true;
		} else {
			$valid = false;
		}
		$labels = array(
			'name'               => esc_html_x( 'Ultimate Image Slider Pro', 'General Name', 'urisp' ),
			'singular_name'      => esc_html_x( 'Ultimate Image Slider Pro', 'Singular name', 'urisp' ),
			'add_new'            => esc_html__( 'Add New Image Slider', 'urisp' ),
			'add_new_item'       => esc_html__( 'Add New Image Slider', 'urisp' ),
			'edit_item'          => esc_html__( 'Edit Image Slider', 'urisp' ),
			'new_item'           => esc_html__( 'New Image Slider', 'urisp' ),
			'view_item'          => esc_html__( 'View Image Slider', 'urisp' ),
			'search_items'       => esc_html__( 'Search Image Slider', 'urisp' ),
			'not_found'          => esc_html__( 'No Image Slider found', 'urisp' ),
			'not_found_in_trash' => esc_html__( 'No Image Slider found in Trash', 'urisp' ),
			'parent_item_colon'  => esc_html__( 'Parent Image Slider:', 'urisp' ),
			'all_items'          => esc_html__( 'All Image Sliders', 'urisp' ),
			'menu_name'          => esc_html_x( 'Ultimate Image Slider Pro', 'Menu Name', 'urisp' ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'supports'            => array( 'title' ),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => $valid,
			'menu_position'       => 10,
			'menu_icon'           => 'dashicons-format-gallery',
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => false,
			'capability_type'     => 'post',
		);

		register_post_type( 'urisp_slider', $args );
	}
}
