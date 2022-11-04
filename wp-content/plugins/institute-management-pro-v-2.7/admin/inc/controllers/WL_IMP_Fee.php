<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Fee {
	/* Get installment data to display on table */
	public static function get_installment_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0 ORDER BY id DESC" );
		$student_data = $wpdb->get_results( "SELECT id, first_name, last_name FROM {$wpdb->prefix}wl_im_students ORDER BY first_name, last_name, id DESC", OBJECT_K );

		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id             =  $row->id;
				$receipt        =  WL_IMP_Helper::get_receipt( $id );
				$amount         = $row->amount;
				$payment_method = $row->payment_method ? $row->payment_method : '-';
				$payment_id     = $row->payment_id ? $row->payment_id : '-';
				$date           = date_format( date_create( $row->created_at ), "d-m-Y g:i A" );
				$added_by       = ( $user = get_userdata( $row->added_by ) ) ? $user->user_login : '-';

				$student_name = '-';
				if ( $row->student_id && isset( $student_data[$row->student_id] ) ) {
					$student_name  = $student_data[$row->student_id]->first_name . " " . $student_data[$row->student_id]->last_name;
					$enrollment_id = WL_IMP_Helper::get_enrollment_id( $student_data[$row->student_id]->id );
				}

				$results["data"][] = array(
					$receipt . '<a class="ml-2" href="#print-installment-fee-receipt" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-print"></i></a>',
					$amount,
					$enrollment_id,
					$student_name,
					$payment_method,
					$payment_id,
					$date,
					$added_by,
					'<a class="mr-3" href="#update-installment" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" delete-installment-security="' . wp_create_nonce( "delete-installment-$id" ) . '"delete-installment-id="' . $id . '" class="delete-installment"> <i class="fa fa-trash text-danger"></i></a>',
					'<a href="#print-student-fees-report" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Add new installment */
	public static function add_installment() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-installment'], 'add-installment' ) ) {
			die();
		}
		global $wpdb;

		$amount     = number_format( isset( $_POST['amount'] ) ? max( floatval( sanitize_text_field( $_POST['amount'] ) ), 0 ) : 0, 2, '.', '' );
		$student_id = isset( $_POST['student'] ) ? intval( sanitize_text_field( $_POST['student'] ) ) : NULL;

		$payment_method = isset( $_POST['payment_method'] ) ? sanitize_text_field( $_POST['payment_method'] ) : '';
		$payment_id     = isset( $_POST['payment_id'] ) ? sanitize_text_field( $_POST['payment_id'] ) : '';

		$errors = [];

		if ( $amount <= 0 ) {
			$errors['amount'] = __( 'Amount must be positive.', WL_IMP_DOMAIN );
		}

		$student = $wpdb->get_row( "SELECT fees_payable, fees_paid, course_id FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND is_active = 1 AND id = $student_id" );

		if ( ! $student ) {
			$errors['student'] = __( 'Please select a valid student.', WL_IMP_DOMAIN );
		}

		$course = $wpdb->get_row( "SELECT fees FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 AND id = $student->course_id" );

		if ( ! $course ) {
			$errors['student'] = __( 'Student is not enrolled in any course.', WL_IMP_DOMAIN );
		}

		if ( $student->fees_payable < ( $student->fees_paid + $amount ) ) {
			$errors['amount'] = __( 'Total amount exceeded payable amount.', WL_IMP_DOMAIN );
		}

		if ( ! empty( $payment_method ) && ! in_array( $payment_method, WL_IMP_Helper::get_payment_method_list() ) ) {
			$errors['payment_method'] = __( 'Please select a valid payment_method.', WL_IMP_DOMAIN );
		}

		if ( ! empty( $payment_id ) ) {
			// Check if payment_id exists.
			$installment_exits = $wpdb->get_row( $wpdb->prepare("SELECT id FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0 AND payment_id = %s", $payment_id) );

			if ( $installment_exits ) {
				wp_send_json_error( __( 'Transaction / Payment ID already exists.', WL_IMP_DOMAIN ) );
			}
		}

		if ( count( $errors ) < 1 ) {
			try {
			  	$wpdb->query( 'BEGIN;' );

				$data = array(
					'amount'         => $amount,
					'student_id'     => $student_id,
					'payment_method' => $payment_method,
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
				wp_send_json_success( array( 'message' => __( 'Installment added successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Fetch installment to update */
	public static function fetch_installment() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}
		$student = $wpdb->get_row( "SELECT id, course_id, fees_payable, fees_paid, first_name, last_name FROM {$wpdb->prefix}wl_im_students WHERE id = $row->student_id" );
		if ( ! $student ) {
			die();
		}
		$course = $wpdb->get_row( "SELECT course_code, course_name FROM {$wpdb->prefix}wl_im_courses WHERE id = $student->course_id" );
		if ( ! $course ) {
			die();
		}
		$pending_fees = number_format( $student->fees_payable - $student->fees_paid, 2, '.', '' );
		?>
		<form id="wlim-update-installment-form">
			<?php $nonce = wp_create_nonce( "update-installment-$id" ); ?>
		    <input type="hidden" name="update-installment-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
			<div class="row" id="wlim-student-enrollment_id">
				<div class="col">
					<label  class="col-form-label pb-0"><?php _e( 'Student', WL_IMP_DOMAIN ); ?>:</label>
					<div class="card mb-3 mt-2">
						<div class="card-block">
		    				<span class="text-dark"><?php echo $student->first_name . " " . $student->last_name; ?> (<?php echo WL_IMP_Helper::get_enrollment_id( $student->id ); ?>)</span>
		  				</div>
					</div>
					<ul class="list-group list-group-flush border-bottom mt-4 mb-3">
						<li class="list-group-item"><?php _e( 'Course', WL_IMP_DOMAIN ); ?>: <strong><?php echo "$course->course_name ($course->course_code)"; ?></strong></li>
						<li class="list-group-item"><?php _e( 'Fees Payable', WL_IMP_DOMAIN ); ?>: <strong><?php echo $student->fees_payable; ?></strong></li>
						<li class="list-group-item"><?php _e( 'Fees Paid', WL_IMP_DOMAIN ); ?>: <strong><?php echo $student->fees_paid; ?></strong></li>
						<li class="list-group-item"><?php _e( 'Pending Fees', WL_IMP_DOMAIN ); ?>: <strong class="text-danger"><?php echo $pending_fees; ?></strong></li>
					</ul>
				</div>
			</div>
			<div class="form-group">
				<label for="wlim-installment-amount_update" class="col-form-label"><?php _e( 'Amount', WL_IMP_DOMAIN ); ?>:</label>
				<input name="amount" type="number" class="form-control" id="wlim-installment-amount_update" placeholder="<?php _e( "Amount", WL_IMP_DOMAIN ); ?>" min="0" value="<?php echo $row->amount; ?>">
			</div>
			<?php if ( ! in_array( $row->payment_method, WL_IMP_Helper::get_payment_methods() ) ) { ?>
			<div class="form-group">
				<label for="wlim_update_payment_method"><?php esc_html_e( 'Payment Method', WL_IMP_DOMAIN ); ?></label>
				<select class="form-control" name="payment_method" id="wlim_update_payment_method">
					<option value=""><?php esc_html_e( 'Select Payment Method', WL_IMP_DOMAIN ); ?></option>
					<?php foreach ( WL_IMP_Helper::get_payment_method_list() as $value ) { ?>
						<option <?php selected( $row->payment_method, $value, true ); ?> value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $value ); ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="wlim_update_payment_id"><?php esc_html_e( 'Transaction / Payment ID', WL_IMP_DOMAIN ); ?></label>
				<input type="text" name="payment_id" class="form-control" id="wlim_update_payment_id" value="<?php echo esc_attr( $row->payment_id ); ?>" placeholder="<?php echo esc_attr( 'Transaction / Payment ID', WL_IMP_DOMAIN ); ?>">
			</div>
			<?php } else { ?>
			<div class="form-group">
				<label><?php esc_html_e( 'Payment Method', WL_IMP_DOMAIN ); ?></label>
				<div class="font-weight-bold"><?php echo esc_html( $row->payment_method ); ?></div>
			</div>
			<div class="form-group">
				<label><?php esc_html_e( 'Transaction / Payment ID', WL_IMP_DOMAIN ); ?></label>
				<div class="font-weight-bold"><?php echo esc_html( $row->payment_id ); ?></div>
			</div>
			<?php } ?>

			<input type="hidden" name="installment_id" value="<?php echo $row->id; ?>">
		</form>
	<?php
		die();
	}

	/* Update installment */
	public static function update_installment() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['installment_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-installment-$id"], "update-installment-$id" ) ) {
			die();
		}
		global $wpdb;

		$amount = number_format( isset( $_POST['amount'] ) ? max( floatval( sanitize_text_field( $_POST['amount'] ) ), 0 ) : 0, 2, '.', '' );

		$payment_method = isset( $_POST['payment_method'] ) ? sanitize_text_field( $_POST['payment_method'] ) : '';
		$payment_id     = isset( $_POST['payment_id'] ) ? sanitize_text_field( $_POST['payment_id'] ) : '';

		$errors = [];

		if ( $amount <= 0 ) {
			$errors['amount'] = __( 'Amount must be positive.', WL_IMP_DOMAIN );
		}

		$installment = $wpdb->get_row( "SELECT amount, student_id, payment_method FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0 AND id = $id" );

		if ( ! $installment ) {
			$errors['amount'] = __( 'Installment not found.', WL_IMP_DOMAIN );
		}

		$student = $wpdb->get_row( "SELECT id, fees_payable, fees_paid, course_id FROM {$wpdb->prefix}wl_im_students WHERE id = $installment->student_id" );

		if ( ! $student ) {
			$errors['student'] = __( 'Please select a valid student.', WL_IMP_DOMAIN );
		}

		if ( $student->fees_payable < ( $student->fees_paid - $installment->amount + $amount ) ) {
			$errors['amount'] = __( 'Total amount exceeded payable amount.', WL_IMP_DOMAIN );
		}

		if ( ! in_array( $installment->payment_method, WL_IMP_Helper::get_payment_methods() ) ) {
			if ( ! empty( $payment_method ) && ! in_array( $payment_method, WL_IMP_Helper::get_payment_method_list() ) ) {
				$errors['payment_method'] = __( 'Please select a valid payment_method.', WL_IMP_DOMAIN );
			}

			if ( ! empty( $payment_id ) ) {
				// Check if payment_id exists.
				$installment_exits = $wpdb->get_row( $wpdb->prepare("SELECT id FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0 AND id != %d AND payment_id = %s", $id, $payment_id ) );

				if ( $installment_exits ) {
					wp_send_json_error( __( 'Transaction / Payment ID already exists.', WL_IMP_DOMAIN ) );
				}
			}
		}

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				$data = array(
					'amount'     => $amount,
				    'updated_at' => date('Y-m-d H:i:s')
				);

				if ( ! in_array( $installment->payment_method, WL_IMP_Helper::get_payment_methods() ) ) {
					$data['payment_method'] = $payment_method;
					$data['payment_id']     = $payment_id;
				}

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_installments", $data, array( 'is_deleted' => 0, 'id' => $id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$data = array(
					'fees_paid' => $student->fees_paid - $installment->amount + $amount,
				    'updated_at' => date('Y-m-d H:i:s')
				);

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_students", $data, array( 'id' => $student->id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Installment updated successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Delete installment */
	public static function delete_installment() {
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-installment-$id"], "delete-installment-$id" ) ) {
			die();
		}
		global $wpdb;

		try {
			$installment = $wpdb->get_row( "SELECT amount, student_id FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0 AND id = $id" );

			if ( ! $installment ) {
	  			throw new Exception( __( 'Installment not found.', WL_IMP_DOMAIN ) );
			}

			$student = $wpdb->get_row( "SELECT id, fees_paid FROM {$wpdb->prefix}wl_im_students WHERE id = $installment->student_id" );

			if ( ! $student ) {
	  			throw new Exception( __( 'Student not found for this installment.', WL_IMP_DOMAIN ) );
			}

			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_installments",
					array(
						'is_deleted' => 1,
						'deleted_at' => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'id' => $id )
				);
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$data = array(
				'fees_paid' => $student->fees_paid - $installment->amount,
			    'updated_at' => date('Y-m-d H:i:s')
			);

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_students", $data, array( 'id' => $student->id ) );
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$wpdb->query( 'COMMIT;' );
			wp_send_json_success( array( 'message' => __( 'Installment removed successfully.', WL_IMP_DOMAIN ) ) );
		} catch ( Exception $exception ) {
	  		$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error( __( $exception->getMessage(), WL_IMP_DOMAIN ) );
		}
	}

	/* Fetch Fee */
	public static function fetch_fees() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id      = intval( sanitize_text_field( $_POST['id'] ) );
		$student = $wpdb->get_row( "SELECT fees_payable, fees_paid, course_id FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id" );
		if ( ! $student ) {
			die();
		}
		$course = $wpdb->get_row( "SELECT course_code, course_name FROM {$wpdb->prefix}wl_im_courses WHERE id = $student->course_id" );
		if ( ! $course ) {
			die();
		}
		$pending_fees = number_format( $student->fees_payable - $student->fees_paid, 2, '.', '' );
		?>
		<ul class="list-group list-group-flush border-top mt-4">
			<li class="list-group-item"><?php _e( 'Course', WL_IMP_DOMAIN ); ?>: <strong><?php echo "$course->course_name ($course->course_code)"; ?></strong></li>
			<li class="list-group-item"><?php _e( 'Fees Payable', WL_IMP_DOMAIN ); ?>: <strong><?php echo $student->fees_payable; ?></strong></li>
			<li class="list-group-item"><?php _e( 'Fees Paid', WL_IMP_DOMAIN ); ?>: <strong><?php echo $student->fees_paid; ?></strong></li>
			<li class="list-group-item"><?php _e( 'Pending Fees', WL_IMP_DOMAIN ); ?>: <strong class="text-danger"><?php echo $pending_fees; ?></strong></li>
		</ul>
		<?php
		die();
	}

	/* View and print installment fee receipt */
	public static function print_installment_fee_receipt() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id  = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}
		$student = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE id = $row->student_id" );
		if ( ! $student ) {
			die();
		}
		$pending_fees = number_format( $student->fees_payable - $student->fees_paid, 2, '.', '' );
		?>
		<div class="row">
			<div class="col">
				<div class="mb-3 mt-2">
					<div class="text-center">
						<button type="button" id="wl-installment-fee-receipt-print" class="btn btn-sm btn-success"><i class="fa fa-print text-white"></i>&nbsp;<?php _e( 'Print Installment Fee Receipt', WL_IMP_DOMAIN ); ?></button><hr>
					</div>
					<div>
						<?php
						require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_fee_receipt.php' ); ?>
						<script>
							/* Function to print installment fee receipt */
							jQuery('#wl-installment-fee-receipt-print').on('click', function() {
				                jQuery.print("#wl-installment-fee-receipt");
				            });
						</script>
	  				</div>
				</div>
			</div>
		</div>
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . '/assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
	<?php
		die();
	}

	/* Check permission to manage installment */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_fees' ) ) {
			die();
		}
	}
}
