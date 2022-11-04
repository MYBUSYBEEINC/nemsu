<?php
defined( 'ABSPATH' ) or die();

require_once( 'WL_IMP_Language.php' );
require_once( 'WL_IMP_Widget.php' );
require_once( 'WL_IMP_Shortcode.php' );
require_once( 'inc/controllers/WL_IMP_Enquiry_Front.php' );
require_once( 'inc/controllers/WL_IMP_Result_Front.php' );
require_once( 'inc/controllers/WL_IMP_Payment_Front.php' );

/* Load Translation */
add_action( 'plugins_loaded', array( 'WL_IMP_Language', 'load_translation' ) );

/* Register Widgets */
add_action( 'widgets_init', array( 'WL_IMP_Widget', 'register_widgets' ) );

/* Enquiry Form Assets */
add_action( 'wp_enqueue_scripts', array( 'WL_IMP_Shortcode', 'shortcode_assets' ) );

/* Enquiry Form Shortcode */
add_shortcode( 'institute_enquiry_form', array( 'WL_IMP_Shortcode', 'create_enquiry_form' ) );

/* Result Form Shortcode */
add_shortcode( 'institute_exam_result', array( 'WL_IMP_Shortcode', 'create_result_form' ) );

/* Actions to add enquiry */
add_action( 'admin_post_wl-im-add-enquiry', array( 'WL_IMP_Enquiry_Front', 'add_enquiry' ) );
add_action( 'admin_post_nopriv_wl-im-add-enquiry', array( 'WL_IMP_Enquiry_Front', 'add_enquiry' ) );

/* Actions to get exam result */
add_action( 'admin_post_wl-im-get-exam-result', array( 'WL_IMP_Result_Front', 'get_result' ) );
add_action( 'admin_post_nopriv_wl-im-get-exam-result', array( 'WL_IMP_Result_Front', 'get_result' ) );

/* Actions for paypal transaction status */
add_action( 'admin_post_wl-im-paypal-payments', array( 'WL_IMP_Payment_Front', 'paypal_payments' ) );
add_action( 'admin_post_nopriv_wl-im-paypal-payments', array( 'WL_IMP_Payment_Front', 'paypal_payments' ) );
?>