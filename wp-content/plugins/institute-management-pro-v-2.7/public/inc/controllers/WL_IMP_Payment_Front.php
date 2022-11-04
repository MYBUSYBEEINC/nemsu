<?php
defined( 'ABSPATH' ) or die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_PaymentHelper.php' );

class WL_IMP_Payment_Front {
	/* Paypal instant payment notification handler */
	public static function paypal_payments() {
		if ( ! ( ! isset( $_POST["txn_id"] ) && ! isset( $_POST["txn_type"] ) ) ) {

			$data = array(
			    'item_name'        => $_POST['item_name'],
			    'item_number'      => $_POST['item_number'],
			    'payment_status'   => $_POST['payment_status'],
			    'payment_amount'   => $_POST['mc_gross'],
			    'payment_currency' => $_POST['mc_currency'],
			    'txn_id'           => $_POST['txn_id'],
			    'receiver_email'   => $_POST['receiver_email'],
			    'payer_email'      => $_POST['payer_email'],
			    'student_id'       => $_POST['custom']
			);

			if ( WL_IMP_PaymentHelper::verify_paypal_transaction( $_POST ) && WL_IMP_PaymentHelper::check_paypal_txnid( $data['txn_id'] ) ) {
			    if ( WL_IMP_PaymentHelper::add_paypal_payment( $data ) !== false ) {
			    }
			}
		}
	}
}