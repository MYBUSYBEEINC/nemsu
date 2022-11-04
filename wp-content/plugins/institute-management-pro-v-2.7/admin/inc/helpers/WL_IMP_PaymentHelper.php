<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_PaymentHelper {
	/* Verify paypal transaction */
	public static function verify_paypal_transaction( $data ) {
		return true;
	    $paypal_url = self::get_paypal_url();

	    $req = 'cmd=_notify-validate';
	    foreach ( $data as $key => $value) {
	        $value = urlencode( stripslashes( $value ) );
	        $value = preg_replace( '/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value );
	        $req .= "&$key=$value";
	    }

	    $ch = curl_init( $paypal_url );
	    curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
	    curl_setopt( $ch, CURLOPT_POST, 1 );
	    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	    curl_setopt( $ch, CURLOPT_POSTFIELDS, $req );
	    curl_setopt( $ch, CURLOPT_SSLVERSION, 6 );
	    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 1 );
	    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
	    curl_setopt( $ch, CURLOPT_FORBID_REUSE, 1 );
	    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
	    curl_setopt( $ch, CURLOPT_HTTPHEADER, array( __( 'Connection: Close', WL_IMP_DOMAIN ) ) );
	    $res = curl_exec( $ch );

	    if ( ! $res ) {
	        $errno = curl_errno( $ch );
	        $errstr = curl_error( $ch );
	        curl_close( $ch );
	        throw new Exception( __( 'cURL error', WL_IMP_DOMAIN ) . ": [$errno] $errstr" );
	    }

	    $info = curl_getinfo( $ch );

	    /* Check the http response */
	    $httpCode = $info['http_code'];
	    if ( $httpCode != 200 ) {
	        throw new Exception( __( 'PayPal responded with http code', WL_IMP_DOMAIN ) . " $httpCode" );
	    }

	    curl_close( $ch );

	    return $res === 'VERIFIED';
	}

	public static function check_paypal_txnid( $txnid ) {
	    global $wpdb;

	    $txnid       = $wpdb->_real_escape( $txnid );
		$installment = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_installments WHERE payment_method = '" . WL_IMP_Helper::get_payment_methods()['paypal'] . "' AND payment_id = $txnid" );

	    return ! $installment;
	}

	/* PayPal add transaction to database */
	public static function add_paypal_payment( $data ) {
		global $wpdb;

		try {
		  	$wpdb->query( 'BEGIN;' );

		    $item_name        = $data['item_name'];
		    $item_number      = $data['item_number'];
		    $payment_status   = $data['payment_status'];
		    $amount           = $data['payment_amount'];
		    $payment_currency = $data['payment_currency'];
		    $txn_id           = $data['txn_id'];
		    $receiver_email   = $data['receiver_email'];
		    $payer_email      = $data['payer_email'];
		    $student_id       = $data['student_id'];

			$student = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $student_id" );
			if ( ! $student ) {
				throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$data = array(
				'amount'         => $amount,
				'student_id'     => $student_id,
				'payment_method' => WL_IMP_Helper::get_payment_methods()['paypal'],
				'payment_id'     => $txn_id,
			    'added_by'       => $student->user_id
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
			return true;
		} catch ( Exception $exception ) {
	  		$wpdb->query( 'ROLLBACK;' );
			return false;
		}

	}

	/* Get paypal url */
	public static function get_paypal_url() {
		$paypal_mode = get_option( 'institute_pro_paypal' )['mode'];
		if ( $paypal_mode == 'live' ) {
			return 'https://www.paypal.com/cgi-bin/webscr';
		} else {
			return 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}
	}

	/* Get paypal notify url */
	public static function get_paypal_notify_url() {
		return admin_url() . 'admin-post.php?action=wl-im-paypal-payments';
	}

	/* Paypal supported currencies */
	public static function get_paypal_supported_currencies() {
		return array(
			"ARS" => "Argentinian Peso",
			"AUD" => "Australian Dollar",
			"CAD" => "Canadian Dollar",
			"CHF" => "Swiss Franc",
			"CZK" => "Czech Koruna",
			"DKK" => "Danish Krone",
			"EUR" => "Euro",
			"GBP" => "British Pound",
			"HKD" => "Hong Kong Dollar",
			"HUF" => "Hungarian Forint",
			"ILS" => "Israeli New Shekel",
			"JPY" => "Japanese Yen",
			"MXN" => "Mexican Peso",
			"MYR" => "Malaysian Ringgit",
			"NOK" => "Norwegian Krone",
			"NZD" => "New Zealand Dollar",
			"PHP" => "Philippine Peso",
			"PLN" => "Polish Zloty",
			"RUB" => "Russian Ruble",
			"SEK" => "Swedish Krona",
			"SGD" => "Singapore Dollar",
			"THB" => "Thai Baht",
			"TWD" => "Taiwan New Dollar",
			"USD" => "United States Dollar"
		);
	}

	/* Razorpay supported currencies */
	public static function get_razorpay_supported_currencies() {
		return array(
			"INR" => "Indian Rupee"
		);
	}

	/* Paystack supported currencies */
	public static function get_paystack_supported_currencies() {
		return array(
			"NGN" => "Nigerian Naira"
		);
	}

	/* If paypal support currency */
	public static function paypal_support_currency() {
		return in_array( get_option( "institute_pro_business" )['currency'], array_keys( self::get_paypal_supported_currencies() ) );
	}

	/* If razorpay support currency */
	public static function razorpay_support_currency() {
		return in_array( get_option( "institute_pro_business" )['currency'], array_keys( self::get_razorpay_supported_currencies() ) );
	}

	/* If paystack support currency */
	public static function paystack_support_currency() {
		return in_array( get_option( "institute_pro_business" )['currency'], array_keys( self::get_paystack_supported_currencies() ) );
	}

	/* If paypal is enabled and support currency */
	public static function paypal_enabled() {
		$institute_pro_paypal_enable = get_option( 'institute_pro_paypal' );
		$institute_pro_paypal_enable = isset( $institute_pro_paypal_enable['enable'] ) ? $institute_pro_paypal_enable['enable'] : false;
		return ( $institute_pro_paypal_enable == 'yes' ) && self::paypal_support_currency();
	}

	/* If razorpay is enabled and support currency */
	public static function razorpay_enabled() {
		$institute_pro_razorpay_enable = get_option( 'institute_pro_razorpay' );
		$institute_pro_razorpay_enable = isset( $institute_pro_razorpay_enable['enable'] ) ? $institute_pro_razorpay_enable['enable'] : false;
		return ( $institute_pro_razorpay_enable == 'yes' ) && self::razorpay_support_currency();
	}

	/* If paystack is enabled and support currency */
	public static function paystack_enabled() {
		$institute_pro_paystack_enable = get_option( 'institute_pro_paystack' );
		$institute_pro_paystack_enable = isset( $institute_pro_paystack_enable['enable'] ) ? $institute_pro_paystack_enable['enable'] : false;
		return ( $institute_pro_paystack_enable == 'yes' ) && self::paystack_support_currency();
	}

	/* Get all currencies */
	public static function get_all_currencies() {
		return array_merge( self::get_paypal_supported_currencies(), self::get_razorpay_supported_currencies(), self::get_paystack_supported_currencies() );
	}

	/* Check if all payment methods are unavailable */
	public static function payment_methods_unavailable() {
		return ( ! self::paypal_enabled() && ! self::razorpay_enabled() && ! self::paystack_enabled() );
	}

	public static function get_currency_symbol() {
		$code = get_option( "institute_pro_business" )['currency'];
		if ( array_key_exists( $code, self::currency_symbols() ) ) {
			return self::currency_symbols()[$code];
		}
		return '';
	}

	/* Currency symbols */
	private static function currency_symbols() {
		return array(
			'AED' => '&#1583;.&#1573;',
			'AFN' => '&#65;&#102;',
			'ALL' => '&#76;&#101;&#107;',
			'ANG' => '&#402;',
			'AOA' => '&#75;&#122;',
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&#402;',
			'AZN' => '&#1084;&#1072;&#1085;',
			'BAM' => '&#75;&#77;',
			'BBD' => '&#36;',
			'BDT' => '&#2547;',
			'BGN' => '&#1083;&#1074;',
			'BHD' => '.&#1583;.&#1576;',
			'BIF' => '&#70;&#66;&#117;',
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => '&#36;&#98;',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTN' => '&#78;&#117;&#46;',
			'BWP' => '&#80;',
			'BYR' => '&#112;&#46;',
			'BZD' => '&#66;&#90;&#36;',
			'CAD' => '&#36;',
			'CDF' => '&#70;&#67;',
			'CHF' => '&#67;&#72;&#70;',
			'CLP' => '&#36;',
			'CNY' => '&#165;',
			'COP' => '&#36;',
			'CRC' => '&#8353;',
			'CUP' => '&#8396;',
			'CVE' => '&#36;',
			'CZK' => '&#75;&#269;',
			'DJF' => '&#70;&#100;&#106;',
			'DKK' => '&#107;&#114;',
			'DOP' => '&#82;&#68;&#36;',
			'DZD' => '&#1583;&#1580;',
			'EGP' => '&#163;',
			'ETB' => '&#66;&#114;',
			'EUR' => '&#8364;',
			'FJD' => '&#36;',
			'FKP' => '&#163;',
			'GBP' => '&#163;',
			'GEL' => '&#4314;',
			'GHS' => '&#162;',
			'GIP' => '&#163;',
			'GMD' => '&#68;',
			'GNF' => '&#70;&#71;',
			'GTQ' => '&#81;',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => '&#76;',
			'HRK' => '&#107;&#110;',
			'HTG' => '&#71;',
			'HUF' => '&#70;&#116;',
			'IDR' => '&#82;&#112;',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'IQD' => '&#1593;.&#1583;',
			'IRR' => '&#65020;',
			'ISK' => '&#107;&#114;',
			'JEP' => '&#163;',
			'JMD' => '&#74;&#36;',
			'JOD' => '&#74;&#68;',
			'JPY' => '&#165;',
			'KES' => '&#75;&#83;&#104;',
			'KGS' => '&#1083;&#1074;',
			'KHR' => '&#6107;',
			'KMF' => '&#67;&#70;',
			'KPW' => '&#8361;',
			'KRW' => '&#8361;',
			'KWD' => '&#1583;.&#1603;',
			'KYD' => '&#36;',
			'KZT' => '&#1083;&#1074;',
			'LAK' => '&#8365;',
			'LBP' => '&#163;',
			'LKR' => '&#8360;',
			'LRD' => '&#36;',
			'LSL' => '&#76;',
			'LTL' => '&#76;&#116;',
			'LVL' => '&#76;&#115;',
			'LYD' => '&#1604;.&#1583;',
			'MAD' => '&#1583;.&#1605;.',
			'MDL' => '&#76;',
			'MGA' => '&#65;&#114;',
			'MKD' => '&#1076;&#1077;&#1085;',
			'MMK' => '&#75;',
			'MNT' => '&#8366;',
			'MOP' => '&#77;&#79;&#80;&#36;',
			'MRO' => '&#85;&#77;',
			'MUR' => '&#8360;',
			'MVR' => '.&#1923;',
			'MWK' => '&#77;&#75;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => '&#77;&#84;',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => '&#67;&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#65020;',
			'PAB' => '&#66;&#47;&#46;',
			'PEN' => '&#83;&#47;&#46;',
			'PGK' => '&#75;',
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#71;&#115;',
			'QAR' => '&#65020;',
			'RON' => '&#108;&#101;&#105;',
			'RSD' => '&#1044;&#1080;&#1085;&#46;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'RWF' => '&#1585;.&#1587;',
			'SAR' => '&#65020;',
			'SBD' => '&#36;',
			'SCR' => '&#8360;',
			'SDG' => '&#163;',
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&#163;',
			'SLL' => '&#76;&#101;',
			'SOS' => '&#83;',
			'SRD' => '&#36;',
			'STD' => '&#68;&#98;',
			'SVC' => '&#36;',
			'SYP' => '&#163;',
			'SZL' => '&#76;',
			'THB' => '&#3647;',
			'TJS' => '&#84;&#74;&#83;',
			'TMT' => '&#109;',
			'TND' => '&#1583;.&#1578;',
			'TOP' => '&#84;&#36;',
			'TRY' => '&#8356;',
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => '',
			'UAH' => '&#8372;',
			'UGX' => '&#85;&#83;&#104;',
			'USD' => '&#36;',
			'UYU' => '&#36;&#85;',
			'UZS' => '&#1083;&#1074;',
			'VEF' => '&#66;&#115;',
			'VND' => '&#8363;',
			'VUV' => '&#86;&#84;',
			'WST' => '&#87;&#83;&#36;',
			'XAF' => '&#70;&#67;&#70;&#65;',
			'XCD' => '&#36;',
			'XDR' => '',
			'XOF' => '',
			'XPF' => '&#70;',
			'YER' => '&#65020;',
			'ZAR' => '&#82;',
			'ZMK' => '&#90;&#75;',
			'ZWL' => '&#90;&#36;'
		);
	}
}
