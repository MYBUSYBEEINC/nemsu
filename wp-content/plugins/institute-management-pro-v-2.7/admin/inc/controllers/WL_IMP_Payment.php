<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_StudentHelper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_PaymentHelper.php' );

class WL_IMP_Payment {
	/* Pay fees */
	public static function pay_fees() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['pay-fees'], 'pay-fees' ) ) {
			die();
		}

		$student = WL_IMP_StudentHelper::get_student();
		if ( ! $student ) {
			die();
		}

		$pending_fees   = number_format( $student->fees_payable - $student->fees_paid, 2, '.', '' );
		$amount         = number_format( isset( $_POST['amount'] ) ? max( floatval( sanitize_text_field( $_POST['amount'] ) ), 0 ) : 0, 2, '.', '' );
		$payment_method = isset( $_POST['payment_method'] ) ? sanitize_text_field( $_POST['payment_method'] ) : '';

		/* Validations */
		$errors = [];
		if ( $amount <= 0 ) {
			$errors['amount'] = __( 'Please specify amount to pay.', WL_IMP_DOMAIN );
		}

		if ( empty( $payment_method ) ) {
			$errors['payment_method'] = __( 'Please specify payment method.', WL_IMP_DOMAIN );
		}

		if ( $amount > $pending_fees ) {
			$errors['amount'] = __( 'Entered amount exceeded pending fees.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			$amount_in_paisa = $amount * 100;
			$name    = $student->first_name;
			$email   = $student->email;
			$address = $student->address;
			$city    = $student->city;
			$zip     = $student->zip;
			$state   = $student->state;

			if ( $student->last_name ) {
				$name .= " $student->last_name";
			}
			if ( $student->city ) {
				$address = "$student->address - $student->city";
			}
			if ( $student->state ) {
				$address = "$address, $student->state";
			}
			if( $student->zip ) {
				$address = "$address - $student->zip";
			}

			$institute_pro_logo = esc_url( get_option( 'institute_pro_logo' ) );
			$institute_pro_name = get_option( 'institute_pro_name' );
			$description        = __( 'Course Fees', WL_IMP_DOMAIN );

			if ( $payment_method == 'razorpay' && WL_IMP_PaymentHelper::razorpay_enabled() ) {
				$currency_symbol    = WL_IMP_PaymentHelper::get_currency_symbol();
				$pay_with_razorpay  = __( 'Pay Amount', WL_IMP_DOMAIN ) . ' ' . $currency_symbol . $amount . ' ' . __( 'with Razorpay', WL_IMP_DOMAIN );
				$security           = wp_create_nonce( 'pay-razorpay' );
				$back_button        = __( 'Go Back', WL_IMP_DOMAIN );
				$key                = get_option( "institute_pro_razorpay" )['key'];
				$currency           = get_option( "institute_pro_business" )['currency'];
				$data = <<<EOT
<button class='mt-2 float-left btn btn-info' onclick='location.reload()'>$back_button</button>
<button class='mt-2 float-right btn btn-success' id='rzp-button1'>$pay_with_razorpay</button>
<script>
var options = {
    'key': '$key',
    'amount': '$amount_in_paisa',
    'currency': '$currency',
    'name': '$institute_pro_name',
    'description': '$description',
    'image': '$institute_pro_logo',
    'handler': function (response) {
		var data = {
			action: 'wl-im-pay-razorpay',
			security: '$security',
			payment_id: response.razorpay_payment_id,
			amount: $amount_in_paisa,
		};
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			data: data,
			success: function(response) {
				if(response.success) {
					toastr.success(response.data.message);
					location.reload();
				} else {
					toastr.error(response.data);
				}
			},
			error: function(response) {
				toastr.error(response.statusText);
			},
			dataType: 'json'
		});
    },
    'prefill': {
        'name': '$name',
        'email': '$email'
    },
    'notes': {
        'address': '$address'
    },
    'theme': {
        'color': '#F37254'
    }
};
var rzp1 = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
EOT;
				wp_send_json_success( array( 'html' => $data ) );
			} elseif ( $payment_method == 'paystack' && WL_IMP_PaymentHelper::paystack_enabled() ) {
				$currency_symbol    = WL_IMP_PaymentHelper::get_currency_symbol();
				$pay_with_paystack  = __( 'Pay Amount', WL_IMP_DOMAIN ) . ' ' . $currency_symbol . $amount . ' ' . __( 'with Razorpay', WL_IMP_DOMAIN );
				$security           = wp_create_nonce( 'pay-paystack' );
				$student_id         = $student->id;
				$back_button        = __( 'Go Back', WL_IMP_DOMAIN );
				$key                = get_option( "institute_pro_paystack" )['key'];
				$currency           = get_option( "institute_pro_business" )['currency'];
				$amount_x_100       = $amount_in_paisa;
				$data = <<<EOT
<button class='mt-2 float-left btn btn-info' onclick='location.reload()'>$back_button</button>
<button class='mt-2 float-right btn btn-success' id='paystack-button'>$pay_with_paystack</button>
<script>
var ptk = PaystackPop.setup({
	key: '$key',
	email: '$email',
	amount: $amount_x_100,
	currency: '$currency',
	metadata: {
		custom_fields: [
			{
				display_name: '$institute_pro_name',
				amount: parseFloat($amount_x_100)
			}
		]
	},
	callback: function(response) {
		var paystackData = {
			'action': 'wl-im-pay-paystack',
			'security': '$security',
			'amount': parseFloat($amount_x_100),
			'reference': response.reference
		};

		// Send Paystack data to server.
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			data: paystackData,
			success: function (response) {
				if (response.success) {
					toastr.success(response.data.message);
					location.reload();
				} else {
					toastr.error(response.data);
				}
			},
			error: function (response) {
				toastr.error(response.statusText);
			},
			dataType: 'json'
		});
	},
	onClose: function() {
	}
});

document.getElementById('paystack-button').onclick = function(e){
	ptk.openIframe();
    e.preventDefault();
}
</script>
EOT;
				wp_send_json_success( array( 'html' => $data ) );
			} elseif ( $payment_method == 'paypal' && WL_IMP_PaymentHelper::paypal_enabled() ) {
				$currency_symbol = WL_IMP_PaymentHelper::get_currency_symbol();
				$pay_with_paypal = __( 'Pay Amount', WL_IMP_DOMAIN ) . ' ' . $currency_symbol . $amount . ' ' . __( 'with PayPal', WL_IMP_DOMAIN );
				$back_button     = __( 'Go Back', WL_IMP_DOMAIN );
				$item_number     = uniqid();
				$notify_url      = WL_IMP_PaymentHelper::get_paypal_notify_url();
				$cancel_url      = menu_page_url( 'institute-management-pro-student-dashboard', false );
				$return_url      = menu_page_url( 'institute-management-pro-student-dashboard', false );
				$student_id      = $student->id;
				$paypal_url      = WL_IMP_PaymentHelper::get_paypal_url();
				$business_email  = get_option( "institute_pro_paypal" )['business_email'];
				$currency        = get_option( "institute_pro_business" )['currency'];
				$data = <<<EOT
<form action="$paypal_url" method="post">
    <input type="hidden" name="business" value="$business_email">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="$description">
    <input type="hidden" name="item_number" value="$item_number">
    <input type="hidden" name="amount" value="$amount">
    <input type="hidden" name="currency_code" value="$currency">
    <input type='hidden' name='cancel_return' value='$cancel_url'>
    <input type='hidden' name='return' value='$return_url'>
    <input type="hidden" name="notify_url" value="$notify_url">
    <input type="hidden" name="custom" value="$student_id">
	<button class='mt-2 float-left btn btn-info' onclick='location.reload()'>$back_button</button>
	<button type="submit" class='mt-2 float-right btn btn-success'>$pay_with_paypal</button>
</form>
EOT;
				wp_send_json_success( array( 'html' => $data ) );
			} else {
				wp_send_json_error( __( 'Please select a valid payment method.', WL_IMP_DOMAIN ) );
			}
		}
		wp_send_json_error( $errors );
	}

	public static function process_razorpay() {
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'pay-razorpay' ) ) {
			die();
		}

		if ( isset( $_POST['payment_id'] ) ) {
			$payment_id      = $_POST['payment_id'];
			$amount_in_paisa = $_POST['amount'];
			$key             = get_option( "institute_pro_razorpay" )['key'];
			$secret          = get_option( "institute_pro_razorpay" )['secret'];
			$url             = "https://$key:$secret@api.razorpay.com/v1/payments";

			$response = wp_remote_post( "$url/$payment_id/capture", array(
				'method' => 'POST',
				'headers' => array(),
				'body' => array( 'amount' => $amount_in_paisa ),
				'cookies' => array()
			) );

			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				wp_send_json_error( $error_message );
			}

			$student = WL_IMP_StudentHelper::get_student();
			if ( ! $student ) {
				die();
			}

			$data = json_decode( $response['body'] );

			if ( ! $data->captured ) {
				wp_send_json_error( 'Unable to capture the payment.' );
			}

			global $wpdb;
			$amount     = ( $data->amount ) / 100;
			$student_id = $student->id;

			try {
			  	$wpdb->query( 'BEGIN;' );

				$data = array(
					'amount'         => $amount,
					'student_id'     => $student_id,
					'payment_method' => WL_IMP_Helper::get_payment_methods()['razorpay'],
					'payment_id'     => $payment_id,
				    'added_by'       => get_current_user_id()
				);

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_installments", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$data = array(
					'fees_paid' => $student->fees_paid + $amount,
				    'updated_at' => date('Y-m-d H:i:s')
				);

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_students", $data, array( 'is_deleted' => 0, 'id' => $student_id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

		  		$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Payment made successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		} else {
			die();
		}
	}

	public static function process_paystack() {
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'pay-paystack' ) ) {
			die();
		}

		if ( isset( $_POST['reference'] ) ) {
			$payment_id      = $_POST['reference'];
			$amount_in_paisa = $_POST['amount'];
			$key             = get_option( "institute_pro_paystack" )['key'];
			$secret          = get_option( "institute_pro_paystack" )['secret'];
			$url             = "https://api.paystack.co/transaction/verify/$payment_id";

			$response = wp_remote_get(
				$url,
				array(
					'headers' => array( 'Authorization' => 'Bearer ' . $secret )
				)
			);

			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				wp_send_json_error( $error_message );
			}

			$student = WL_IMP_StudentHelper::get_student();
			if ( ! $student ) {
				die();
			}

			$data = json_decode( $response['body'] );

			if ( ! $data->status || ( 'success' !== $data->data->status ) ) {
				wp_send_json_error( esc_html__( 'Unable to verify the transaction.', WL_IMP_DOMAIN ) );
			}

			global $wpdb;
			$amount = ( $data->data->amount ) / 100;
			$student_id = $student->id;

			try {
			  	$wpdb->query( 'BEGIN;' );

				$data = array(
					'amount'         => $amount,
					'student_id'     => $student_id,
					'payment_method' => WL_IMP_Helper::get_payment_methods()['paystack'],
					'payment_id'     => $payment_id,
				    'added_by'       => get_current_user_id()
				);

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_installments", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$data = array(
					'fees_paid' => $student->fees_paid + $amount,
				    'updated_at' => date('Y-m-d H:i:s')
				);

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_students", $data, array( 'is_deleted' => 0, 'id' => $student_id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

		  		$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Payment made successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		} else {
			die();
		}
	}

	/* Check permission to make payment */
	private static function check_permission() {
		if ( ! current_user_can( WL_IMP_Helper::get_student_capability() ) ) {
			die();
		}
	}
}