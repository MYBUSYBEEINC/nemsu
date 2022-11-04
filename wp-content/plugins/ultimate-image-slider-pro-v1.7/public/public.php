<?php
defined( 'ABSPATH' ) || die();

require_once UISP_PLUGIN_DIR_PATH . 'public/inc/UISP_Language.php';
require_once UISP_PLUGIN_DIR_PATH . 'public/inc/UISP_Slider.php';
require_once UISP_PLUGIN_DIR_PATH . 'public/inc/UISP_Shortcode.php';

/* Load translation */
add_action( 'plugins_loaded', array( 'UISP_Language', 'load_translation' ) );

add_action( 'init', array( 'UISP_Slider', 'register_slider_post_type' ) );

add_shortcode( 'UISP', array( 'UISP_Shortcode', 'shortcode' ) );

add_action( 'wp_enqueue_scripts', array( 'UISP_Shortcode', 'shortcode_assets' ) );
