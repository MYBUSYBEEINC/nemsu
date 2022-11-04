<div id="wl-fees-report" class="row">
	<style>
		.wl-fees-report-section {
			width: 1131px;
			height: 1600px;
			border: 1px solid #b3b3b3;
			padding: 20px;
			margin: 0 auto;
		}
		.wl-fees-report-box {
			margin-top: 30px;
		}
		.wl-institute-pro-fees-report-logo {
			max-height: 70px;
			max-width: 70px;
		}
		.wl-fees-report-section .list-group-item {
			font-size: 12px;
		}
		.wl-fees-report-section table tr {
			font-size: 12px;
		}
	 	.wl-fees-report-address {
	 		font-size: 11px;
		 }
		.wl-fees-report-contact-phone, .wl-fees-report-contact-email {
			font-size: 11px;
		}
		.wl-fees-report-subtitle {
			font-size: 14px;
			text-align: center;
			font-weight: 600;
			background-color: #6c757d !important;
			padding-top: 2px;
			padding-bottom: 3px;
		}
		.wl-fees-report-copy {
			font-size: 14px;
		}
		.wl-fees-report-name {
			font-size: 17px;
		}
		.wl-fees-report-authorised-by-row {
			margin-top: 24px;
			font-size: 12px;
			float: right;
		}
		@media print {
			body {
				-webkit-print-color-adjust: exact;
			}
		}
	</style>
	<?php
		$enrollment_id = WL_IMP_Helper::get_enrollment_id( $row->id );
		$course        = $wpdb->get_row( "SELECT course_name, course_code, duration, duration_in FROM {$wpdb->prefix}wl_im_courses WHERE id = $row->course_id" );
		$duration      = $course->duration;
		$duration_in   = $course->duration_in;
		$duration_in   = ( $duration < 2 ) ? __( substr( $duration_in, 0, -1 ), WL_IMP_DOMAIN ) : __( $duration_in, 0, -1, WL_IMP_DOMAIN );

		$name           = $row->first_name . " $row->last_name";
		$course         = ( ! empty ( $course ) ) ? "{$course->course_name} ({$course->course_code})" : '-';
		$duration       = "{$duration} {$duration_in}";
		$phone          = ( ! empty ( $row->phone ) ) ? $row->phone : '-';
		$admission_date = ( ! empty ( $row->created_at ) ) ? date_format( date_create( $row->created_at ), "d M, Y" ) : '-';
		$fees_paid      = $row->fees_paid;

		$institute_pro_logo    = get_option( 'institute_pro_logo' );
		$institute_pro_name    = get_option( 'institute_pro_name' );
		$institute_pro_address = get_option( 'institute_pro_address' );
		$institute_pro_phone   = get_option( 'institute_pro_phone' );
		$institute_pro_email   = get_option( 'institute_pro_email' );
		$photo                 = $row->photo_id;
		$signature             = $row->signature_id;
		$show_logo             = get_option( 'enable_institute_pro_logo' ) == 'yes';

		if ( isset( $installments_recent ) ) {
			$installments = $installments_recent;
		}
	?>
	<div class="wl-fees-report-section col-6 col-6-offset-3">
		<div class="wl-fees-report-box">
			<div class="row">
				<div class="col mx-auto">
					<span class="float-right text-right wl-fees-report-copy">
						<div class="text-secondary mb-2"><?php _e( 'Student Copy', WL_IMP_DOMAIN ); ?></div>
					</span>
				</div>
			</div>
			<div class="row">
				<?php if ( $show_logo ) { ?>
				<div class="col-3 mx-auto">
					<img src="<?php echo esc_url( $institute_pro_logo ); ?>" class="wl-institute-pro-fees-report-logo img-responsive float-right">
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
						<h3 class="wl-fees-report-name mt-1"><?php echo $institute_pro_name; ?></h3>
						<?php
						if( ! empty( $institute_pro_address ) ) { ?>
						<span class="wl-fees-report-address"><?php echo $institute_pro_address; ?></span><br>
						<?php
						}
						if( ! empty( $institute_pro_phone ) ) { ?>
						<span class="wl-fees-report-contact-phone"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?> - <strong><?php echo $institute_pro_phone; ?></strong>
						<?php
						if( ! empty( $institute_pro_email ) ) { ?> | <?php } ?>
						</span>
						<?php
						}
						if( ! empty( $institute_pro_email ) ) { ?>
						<span class="wl-fees-report-contact-email"><?php _e( 'Email', WL_IMP_DOMAIN ); ?> - <strong><?php echo $institute_pro_email; ?></strong></span>
						<?php
						} ?>
					</span>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-12 mx-auto">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<span class="list-group-heading font-weight-bold"><?php _e( 'Name', WL_IMP_DOMAIN ); ?>: </span>
							<span class="list-group-value"><?php echo $name; ?></span>
						</li>
						<li class="list-group-item">
							<span class="list-group-heading font-weight-bold"><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?>: </span>
							<span class="list-group-value"><?php echo $enrollment_id; ?></span>
						</li>
						<li class="list-group-item">
							<span class="list-group-heading font-weight-bold"><?php _e( 'Course', WL_IMP_DOMAIN ); ?>: </span>
							<span class="list-group-value"><?php echo $course; ?></span>
						</li>
					</ul>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col mx-auto">
					<div class="mb-2 wl-fees-report-subtitle text-white"><?php _e( 'Fees Report', WL_IMP_DOMAIN ); ?></div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mx-auto">
					<table class="table">
						<thead>
							<tr>
								<th scope="col"><?php _e( 'Receipt', WL_IMP_DOMAIN ); ?></th>
								<th scope="col"><?php _e( 'Amount', WL_IMP_DOMAIN ); ?></th>
								<th scope="col"><?php _e( 'Date', WL_IMP_DOMAIN ); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ( count( $installments ) !== 0 ) {
								foreach ( $installments as $installment ) {
									$id       =  $installment->id;
									$receipt  =  WL_IMP_Helper::get_receipt( $id );
									$amount   = $installment->amount;
									$date     = date_format( date_create( $installment->created_at ), "d-m-Y g:i A" );
									$added_by = ( $user = get_userdata( $installment->added_by ) ) ? $user->user_login : '-';
							?>
							<tr>
								<td><?php echo $receipt; ?></td>
								<td><?php echo $amount; ?></td>
								<td><?php echo $date; ?></td>
							</tr>
							<?php
								}
								if ( isset( $installments_remaining ) && count( $installments_remaining ) !== 0 ) {
									$amount = 0;
									foreach ( $installments_remaining as $installment ) {
										$amount += $installment->amount;
									} ?>
								<tr>
									<td><?php echo WL_IMP_Helper::get_receipt( $installments_remaining[0]->id ) . " - " . WL_IMP_Helper::get_receipt( $installments_remaining[count( $installments_remaining ) - 1]->id ); ?></td>
									<td><?php echo $amount; ?></td>
									<td><?php echo date_format( date_create( $installments_remaining[0]->created_at ), "d-m-Y g:i A" ) . " - " . date_format( date_create( $installments_remaining[count( $installments_remaining ) - 1]->created_at ), "d-m-Y g:i A" ); ?></td>
								</tr>
							<?php
								}
							} ?>
							<tr>
								<th scope="col"><?php _e( 'Total', WL_IMP_DOMAIN ); ?></th>
								<th scope="col"><?php echo $fees_paid; ?></th>
								<th scope="col"></th>
							</tr>
							<tr>
								<th scope="col"><span class="text-danger"><?php _e( 'Pending Fees', WL_IMP_DOMAIN ); ?></span></th>
								<th scope="col"><?php echo $pending_fees; ?></th>
								<th scope="col"></th>
							</tr>
							<tr>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row wl-fees-report-authorised-by-row">
				<div class="font-weight-bold mr-3"><?php _e( 'Authorised Signed By', WL_IMP_DOMAIN ); ?></div>
			</div>
		</div>
	</div>
</div>