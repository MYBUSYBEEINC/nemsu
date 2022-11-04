<div id="wl-certificate">
	<style>
		#wl-certificate {
			width: 1240px;
			height: 1754px;
			border: 1px solid #b3b3b3;
			padding: 20px;
			margin: 0 auto;
		}
		#wl-certificate-box {
			margin-top: 30px;
		}
		#wl-certificate-content-box {
			margin: 100px;
		}
		#wl-institute-pro-certificate-logo {
			max-height: 120px;
			max-width: 120px;
		}
		#wl-certificate-number {
			font-size: 16px;
		}
		#wl-certificate-name {
			font-size: 44px;
			font-weight: 400;
		}
		.wl-certificate-text {
			font-size: 36px;
		}
		.wl-certificate-signature-box-row {
			margin-top: 200px;
			font-size: 25px;
			font-weight: 500;
		}
		@media print {
			body {
				-webkit-print-color-adjust: exact;
			}
		}
	</style>
	<?php
		$enrollment_id      = WL_IMP_Helper::get_enrollment_id( $row->id );
		$certificate_number = WL_IMP_Helper::get_certificate_number( $row->id );
		$course             = $wpdb->get_row( "SELECT course_name, course_code, duration, duration_in FROM {$wpdb->prefix}wl_im_courses WHERE id = $row->course_id" );

		$name            = $row->first_name . " $row->last_name";
		$course          = ( ! empty ( $course ) ) ? $course->course_name : '-';
		$completion_date = ( ! empty ( $row->completion_date ) ) ? date_format( date_create( $row->completion_date ), "d M, Y" ) : '-';

		$institute_pro_logo = get_option( 'institute_pro_logo' );
		$institute_pro_name = get_option( 'institute_pro_name' );
		$show_logo          = get_option( 'enable_institute_pro_logo' ) == 'yes';
	?>
	<div id="wl-certificate-box">
		<div class="row">
			<div class="col mx-auto">
				<span class="float-right" id="wl-certificate-number"><?php _e( 'Certificate No.', WL_IMP_DOMAIN ); ?> <strong><?php echo $certificate_number; ?></strong></span>
			</div>
		</div>
		<div id="wl-certificate-content-box">
			<div class="row mt-4 pt-4">
				<div class="col-12">
					<h1 class="text-center display-3"><?php _e( 'Certificate of Completion', WL_IMP_DOMAIN ); ?></h1>
				</div>
			</div>
			<div class="row mt-4 pt-4">
				<div class="col-12 text-center">
					<p class="wl-certificate-text display-4"><?php echo __( 'This is to certify that', WL_IMP_DOMAIN ) . " " . $name . " " . __( 'successfully completed', WL_IMP_DOMAIN ) . " " . $course . " " . __( 'course on', WL_IMP_DOMAIN ) . " " . $completion_date; ?>.</p>
				</div>
			</div>

			<?php if ( $show_logo ) { ?>
			<div class="row mt-4">
				<div class="col-12 text-center">
					<img src="<?php echo esc_url( $institute_pro_logo ); ?>" id="wl-institute-pro-certificate-logo" class="img-responsive mx-auto d-block">
				</div>
			</div>
			<?php
			} ?>
			<div class="row justify-content-center align-items-center">
				<div class="col-12">
					<h3 class="text-center" id="wl-certificate-name"><?php echo $institute_pro_name; ?></h3>
				</div>
			</div>
		</div>
		<div class="row wl-certificate-signature-box-row">
			<div class="col-6 text-left"></div>
			<div class="col-6">
				<div class="text-right mr-5"><?php _e( 'Authorised By', WL_IMP_DOMAIN ); ?></div>
			</div>
		</div>
	</div>
</div>