<?php
defined( 'ABSPATH' ) || die();

require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/UISP_Slider_Admin.php';

add_filter( 'manage_edit-urisp_slider_columns', array( 'UISP_Slider_Admin', 'edit_columns' ) );

add_action( 'manage_urisp_slider_posts_custom_column', array( 'UISP_Slider_Admin', 'custom_column' ), 10, 2 );

add_action( 'add_meta_boxes', array( 'UISP_Slider_Admin', 'add_meta_boxes' ) );

add_action( 'admin_enqueue_scripts', array( 'UISP_Slider_Admin', 'enqueue_scripts_styles' ) );

add_action( 'save_post', array( 'UISP_Slider_Admin', 'save_metaboxes' ), 10, 2 );

add_action( 'admin_menu', array( 'UISP_Slider_Admin', 'create_menu' ) );
