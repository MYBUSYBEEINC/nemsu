<div id="wl-installment-fee-receipt">
	<style>
		#wl-installment-fee-receipt {
			width: 1240px;
			height: 1754px;
			margin: 0 auto;
		}
		#wl-installment-fee-receipt-box {
			max-width: 750px;
			max-height: 750px;
			border: 1px solid #b3b3b3;
			padding: 20px;
			margin: 0 auto;
			margin-top: 30px;
		}
		#wl-installment-fee-receipt .list-group-item {
			font-size: 14px;
		}
		#wl-installment-fee-receipt table tr {
			font-size: 14px;
		}
		#wl-installment-fee-receipt-photo-box, #wl-installment-fee-receipt-photo {
			height: 160px;
			width: 124px;
		}
		#wl-installment-fee-receipt-photo-box {
			border: 1px solid #b3b3b3;
		}
		#wl-installment-fee-receipt-signature-box, #wl-installment-fee-receipt-signature {
			height: 70px;
			width: 124px;
			border: 1px solid #b3b3b3;
		}
		#wl-installment-fee-receipt-signature-box {
			border: 1px solid #b3b3b3;
		}
		#wl-institute-pro-fee-receipt-logo {
			max-height: 70px;
			max-width: 70px;
		}
	 	#wl-fee-receipt-address {
	 		font-size: 12px;
		 }
		#wl-installment-fee-receipt-title-box {
			padding-top: 25px;
		}
		#wl-installment-fee-receipt-title {
			font-weight: 600;
			background-color: #6c757d !important;
			padding-top: 2px;
			padding-bottom: 3px;
		}
		#wl-fee-receipt-contact-phone, #wl-fee-receipt-contact-email {
			font-size: 12px;
		}
		.wl-receipt-number {
			font-size: 13px;
		}
		#wl-fee-receipt-name {
			font-size: 19px;
		}
		@media print {
			body {
				-webkit-print-color-adjust: exact;
			}
		}
	</style>
	<?php
		$enrollment_id  = WL_IMP_Helper::get_enrollment_id( $student->id );
		$course         = $wpdb->get_row( "SELECT course_name, course_code, duration, duration_in FROM {$wpdb->prefix}wl_im_courses WHERE id = $student->course_id" );

		$receipt_number = WL_IMP_Helper::get_receipt( $row->id );
		$name           = $student->first_name . " $student->last_name";
		$course         = ( ! empty ( $course ) ) ? "{$course->course_name} ({$course->course_code})" : '-';
		$phone          = ( ! empty ( $student->phone ) ) ? $student->phone : '-';
		$email          = ( ! empty ( $student->email ) ) ? $student->email : '-';
		$amount         = $row->amount;
		$date           = ( ! empty ( $row->created_at ) ) ? date_format( date_create( $row->created_at ), "d M, Y" ) : '-';

		$institute_pro_logo    = get_option( 'institute_pro_logo' );
		$institute_pro_name    = get_option( 'institute_pro_name' );
		$institute_pro_address = get_option( 'institute_pro_address' );
		$institute_pro_phone   = get_option( 'institute_pro_phone' );
		$institute_pro_email   = get_option( 'institute_pro_email' );
		$show_logo             = get_option( 'enable_institute_pro_logo' ) == 'yes';
	?>
	<div id="wl-installment-fee-receipt-box">
		<div class="row">
			<div class="col mx-auto">
				<span class="float-right wl-receipt-number"><?php _e( 'Receipt No.', WL_IMP_DOMAIN ); ?> <strong><?php echo $receipt_number; ?></strong></span>
			</div>
		</div>
		<div class="row">
			<?php if ( $show_logo ) { ?>
			<div class="col-3 mx-auto">
				<img src="<?php echo esc_url( $institute_pro_logo ); ?>" id="wl-institute-pro-fee-receipt-logo" class="img-responsive float-right">
			</div>
			<?php
			} ?>
			<div class="<?php echo $show_logo ? "col-9 " : "col-12 text-center "; ?>mx-auto">
				<?php if ( $show_logo ) { ?>
				<span class="float-left">
				<?php
				} else { ?>
				<span>
				<?php
				} ?>
					<h4 class="mt-1" id="wl-fee-receipt-name"><?php echo $institute_pro_name; ?></h4>
					<?php
					if( ! empty( $institute_pro_address ) ) { ?>
					<span id="wl-fee-receipt-address"><?php echo $institute_pro_address; ?></span><br>
					<?php
					}
					if( ! empty( $institute_pro_phone ) ) { ?>
					<span id="wl-fee-receipt-contact-phone"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?> - <strong><?php echo $institute_pro_phone; ?></strong>
					<?php
					if( ! empty( $institute_pro_email ) ) { ?> | <?php } ?>
					</span>
					<?php
					}
					if( ! empty( $institute_pro_email ) ) { ?>
					<span id="wl-fee-receipt-contact-email"><?php _e( 'Email', WL_IMP_DOMAIN ); ?> - <strong><?php echo $institute_pro_email; ?></strong></span>
					<?php
					} ?>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-10 col-offset-1 mx-auto">
				<table class="table mt-1">
					<tbody>
						<tr>
							<th scope="col"><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?></th>
							<td><?php echo $enrollment_id; ?></td>
						</tr>
						<tr>
							<th scope="col"><?php _e( 'Name', WL_IMP_DOMAIN ); ?></th>
							<td><?php echo $name; ?></td>
						</tr>
						<tr>
							<th scope="col"><?php _e( 'Course', WL_IMP_DOMAIN ); ?></th>
							<td><?php echo $course; ?></td>
						</tr>
						<tr>
							<th scope="col"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?></th>
							<td><?php echo $phone; ?></td>
						</tr>
						<tr>
							<th scope="col"><?php _e( 'Email', WL_IMP_DOMAIN ); ?></th>
							<td><?php echo $email; ?></td>
						</tr>
						<tr>
							<th scope="col"><?php _e( 'Amount', WL_IMP_DOMAIN ); ?></th>
							<td><strong><?php echo $amount; ?></strong></td>
						</tr>
						<tr>
							<th scope="col"><?php _e( 'Date', WL_IMP_DOMAIN ); ?></th>
							<td><?php echo $date; ?></td>
						</tr>
						<tr>
							<th scope="col"></th>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>