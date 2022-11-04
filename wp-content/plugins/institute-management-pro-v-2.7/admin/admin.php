<?php
defined( 'ABSPATH' ) || die();

require_once( 'WL_IMP_LM.php' );
require_once( 'WL_IMP_Menu.php' );
require_once( 'inc/controllers/WL_IMP_Setting.php' );
require_once( 'inc/controllers/WL_IMP_Administrator.php' );
require_once( 'inc/controllers/WL_IMP_Course.php' );
require_once( 'inc/controllers/WL_IMP_Batch.php' );
require_once( 'inc/controllers/WL_IMP_Enquiry.php' );
require_once( 'inc/controllers/WL_IMP_Student.php' );
require_once( 'inc/controllers/WL_IMP_Fee.php' );
require_once( 'inc/controllers/WL_IMP_Result.php' );
require_once( 'inc/controllers/WL_IMP_Report.php' );
require_once( 'inc/controllers/WL_IMP_Notification.php' );
require_once( 'inc/controllers/WL_IMP_Notice.php' );
require_once( 'inc/controllers/WL_IMP_Payment.php' );
require_once( 'inc/controllers/WL_IMP_Reset.php' );

/* Action for creating institute management menu pages */
add_action( 'admin_menu', array( 'WL_IMP_Menu', 'create_menu' ) );

/* On admin init */
add_action( 'admin_init', array( 'WL_IMP_Setting', 'register_settings' ) );

/* Actions for administrator */
add_action( 'wp_ajax_wl-im-get-administrator-data', array( 'WL_IMP_Administrator', 'get_administrator_data' ) );
add_action( 'wp_ajax_wl-im-add-administrator', array( 'WL_IMP_Administrator', 'add_administrator' ) );
add_action( 'wp_ajax_wl-im-fetch-administrator', array( 'WL_IMP_Administrator', 'fetch_administrator' ) );
add_action( 'wp_ajax_wl-im-update-administrator', array( 'WL_IMP_Administrator', 'update_administrator' ) );

/* Actions for course */
add_action( 'wp_ajax_wl-im-get-course-data', array( 'WL_IMP_Course', 'get_course_data' ) );
add_action( 'wp_ajax_wl-im-add-course', array( 'WL_IMP_Course', 'add_course' ) );
add_action( 'wp_ajax_wl-im-fetch-course', array( 'WL_IMP_Course', 'fetch_course' ) );
add_action( 'wp_ajax_wl-im-update-course', array( 'WL_IMP_Course', 'update_course' ) );
add_action( 'wp_ajax_wl-im-delete-course', array( 'WL_IMP_Course', 'delete_course' ) );

/* Actions for batch */
add_action( 'wp_ajax_wl-im-get-batch-data', array( 'WL_IMP_Batch', 'get_batch_data' ) );
add_action( 'wp_ajax_wl-im-add-batch', array( 'WL_IMP_Batch', 'add_batch' ) );
add_action( 'wp_ajax_wl-im-fetch-batch', array( 'WL_IMP_Batch', 'fetch_batch' ) );
add_action( 'wp_ajax_wl-im-update-batch', array( 'WL_IMP_Batch', 'update_batch' ) );
add_action( 'wp_ajax_wl-im-delete-batch', array( 'WL_IMP_Batch', 'delete_batch' ) );

/* Actions for enquiry */
add_action( 'wp_ajax_wl-im-get-enquiry-data', array( 'WL_IMP_Enquiry', 'get_enquiry_data' ) );
add_action( 'wp_ajax_wl-im-add-enquiry', array( 'WL_IMP_Enquiry', 'add_enquiry' ) );
add_action( 'wp_ajax_wl-im-fetch-enquiry', array( 'WL_IMP_Enquiry', 'fetch_enquiry' ) );
add_action( 'wp_ajax_wl-im-update-enquiry', array( 'WL_IMP_Enquiry', 'update_enquiry' ) );
add_action( 'wp_ajax_wl-im-delete-enquiry', array( 'WL_IMP_Enquiry', 'delete_enquiry' ) );

/* Actions for student */
add_action( 'wp_ajax_wl-im-get-student-data', array( 'WL_IMP_Student', 'get_student_data' ) );
add_action( 'wp_ajax_wl-im-add-student', array( 'WL_IMP_Student', 'add_student' ) );
add_action( 'wp_ajax_wl-im-fetch-student', array( 'WL_IMP_Student', 'fetch_student' ) );
add_action( 'wp_ajax_wl-im-update-student', array( 'WL_IMP_Student', 'update_student' ) );
add_action( 'wp_ajax_wl-im-delete-student', array( 'WL_IMP_Student', 'delete_student' ) );
add_action( 'wp_ajax_wl-im-add-student-fetch-course-batches', array( 'WL_IMP_Student', 'fetch_course_batches' ) );
add_action( 'wp_ajax_wl-im-add-student-fetch-course-update-batches', array( 'WL_IMP_Student', 'fetch_course_update_batches' ) );
add_action( 'wp_ajax_wl-im-add-student-fetch-enquiries', array( 'WL_IMP_Student', 'fetch_enquiries' ) );
add_action( 'wp_ajax_wl-im-add-student-fetch-enquiry', array( 'WL_IMP_Student', 'fetch_enquiry' ) );
add_action( 'wp_ajax_wl-im-add-student-fetch-fees-payable', array( 'WL_IMP_Student', 'fetch_fees_payable' ) );
add_action( 'wp_ajax_wl-im-add-student-form', array( 'WL_IMP_Student', 'add_student_form' ) );

/* Actions for fee */
add_action( 'wp_ajax_wl-im-get-installment-data', array( 'WL_IMP_Fee', 'get_installment_data' ) );
add_action( 'wp_ajax_wl-im-add-installment', array( 'WL_IMP_Fee', 'add_installment' ) );
add_action( 'wp_ajax_wl-im-fetch-installment', array( 'WL_IMP_Fee', 'fetch_installment' ) );
add_action( 'wp_ajax_wl-im-update-installment', array( 'WL_IMP_Fee', 'update_installment' ) );
add_action( 'wp_ajax_wl-im-delete-installment', array( 'WL_IMP_Fee', 'delete_installment' ) );
add_action( 'wp_ajax_wl-im-add-installment-fetch-fees', array( 'WL_IMP_Fee', 'fetch_fees' ) );
add_action( 'wp_ajax_wl-im-print-installment-fee-receipt', array( 'WL_IMP_Fee', 'print_installment_fee_receipt' ) );

/* Actions for exam */
add_action( 'wp_ajax_wl-im-get-exam-data', array( 'WL_IMP_Result', 'get_exam_data' ) );
add_action( 'wp_ajax_wl-im-add-exam', array( 'WL_IMP_Result', 'add_exam' ) );
add_action( 'wp_ajax_wl-im-fetch-exam', array( 'WL_IMP_Result', 'fetch_exam' ) );
add_action( 'wp_ajax_wl-im-update-exam', array( 'WL_IMP_Result', 'update_exam' ) );
add_action( 'wp_ajax_wl-im-delete-exam', array( 'WL_IMP_Result', 'delete_exam' ) );

/* Actions for result */
add_action( 'wp_ajax_wl-im-add-result-fetch-course-batches', array( 'WL_IMP_Result', 'fetch_course_batches' ) );
add_action( 'wp_ajax_wl-im-add-result-fetch-batch-students', array( 'WL_IMP_Result', 'fetch_batch_students' ) );
add_action( 'wp_ajax_wl-im-save-result', array( 'WL_IMP_Result', 'save_result' ) );
add_action( 'wp_ajax_wl-im-get-exam-results', array( 'WL_IMP_Result', 'get_exam_results' ) );
add_action( 'wp_ajax_wl-im-get-result-data', array( 'WL_IMP_Result', 'get_result_data' ) );
add_action( 'wp_ajax_wl-im-add-result', array( 'WL_IMP_Result', 'add_result' ) );
add_action( 'wp_ajax_wl-im-fetch-result', array( 'WL_IMP_Result', 'fetch_result' ) );
add_action( 'wp_ajax_wl-im-update-result', array( 'WL_IMP_Result', 'update_result' ) );
add_action( 'wp_ajax_wl-im-delete-result', array( 'WL_IMP_Result', 'delete_result' ) );

/* Actions for report */
add_action( 'wp_ajax_wl-im-view-report', array( 'WL_IMP_Report', 'view_report' ) );
add_action( 'wp_ajax_wl-im-print-student', array( 'WL_IMP_Report', 'print_student' ) );
add_action( 'wp_ajax_wl-im-print-student-admission-detail', array( 'WL_IMP_Report', 'print_student_admission_detail' ) );
add_action( 'wp_ajax_wl-im-print-student-fees-report', array( 'WL_IMP_Report', 'print_student_fees_report' ) );
add_action( 'wp_ajax_wl-im-print-student-certificate', array( 'WL_IMP_Report', 'print_student_certificate' ) );

/* Actions for notifications */
add_action( 'wp_ajax_wl-im-notification-configure', array( 'WL_IMP_Notification', 'notification_configure' ) );
add_action( 'wp_ajax_wl-im-send-notification', array( 'WL_IMP_Notification', 'send_notification' ) );

/* Actions for noticeboard */
add_action( 'wp_ajax_wl-im-get-notice-data', array( 'WL_IMP_Notice', 'get_notice_data' ) );
add_action( 'wp_ajax_wl-im-add-notice', array( 'WL_IMP_Notice', 'add_notice' ) );
add_action( 'wp_ajax_wl-im-fetch-notice', array( 'WL_IMP_Notice', 'fetch_notice' ) );
add_action( 'wp_ajax_wl-im-update-notice', array( 'WL_IMP_Notice', 'update_notice' ) );
add_action( 'wp_ajax_wl-im-delete-notice', array( 'WL_IMP_Notice', 'delete_notice' ) );

/* Actions for payments */
add_action( 'wp_ajax_wl-im-pay-fees', array( 'WL_IMP_Payment', 'pay_fees' ) );
add_action( 'wp_ajax_wl-im-pay-razorpay', array( 'WL_IMP_Payment', 'process_razorpay' ) );
add_action( 'wp_ajax_wl-im-pay-paystack', array( 'WL_IMP_Payment', 'process_paystack' ) );

/* Action for reset */
add_action( 'wp_ajax_wl-im-reset-plugin', array( 'WL_IMP_Reset', 'perform_reset' ) );
?>