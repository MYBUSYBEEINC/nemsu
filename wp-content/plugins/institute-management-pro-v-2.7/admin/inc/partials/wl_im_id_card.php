<div id="wl-id-card">
	<style>
		#wl-id-card .list-group-item {
			padding: 3px 0;
		}
		#wl-id-card {
			width: 1240px;
			height: 1754px;
			margin: 0 auto;
		}
		#wl-id-card-box {
			max-width: 550px;
			max-height: 386px;
			border: 1px solid #b3b3b3;
			padding: 5px 0;
			margin: 0 auto;
			margin-top: 30px;
		}
		#wl-id-card .list-group-item {
			font-size: 14px;
		}
	 	#wl-id-card-address {
	 		font-size: 12px;
		 }
		#wl-id-card-photo-box {
			height: 150px;
		}
		#wl-id-card-photo {
			height: 148px;
			width: 98px;
		}
		#wl-id-card-signature-box {
			height: 30px;
		}
		#wl-id-card-photo-box, #wl-id-card-signature-box {
			width: 100px;
			border: 1px solid #b3b3b3;
		}
		#wl-institute-pro-id-card-logo {
			max-height: 70px;
			max-width: 70px;
		}
		#wl-id-card-title-box {
			padding-top: 5px;
		}
		#wl-id-card-title {
			font-size: 13px;
			font-weight: 600;
			background-color: #6c757d !important;
			padding-top: 2px;
			padding-bottom: 3px;
		}
		#wl-id-card-contact-phone, #wl-id-card-contact-email {
			font-size: 12px;
		}
		#wl-id-card-name {
			font-size: 17px;
			margin-bottom: 0;
		}
		.wl-id-card-signature-box-row {
			margin-top: 5px;
			font-size: 11px;
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

		$name          = $row->first_name . " $row->last_name";
		$course        = ( ! empty ( $course ) ) ? "{$course->course_name} ({$course->course_code})" : '-';
		$duration      = "{$duration} {$duration_in}";
		$admission_date = date_format( date_create( $row->created_at ), "d M, Y" );
		$phone         = ( ! empty ( $row->phone ) ) ? $row->phone : '-';
		$email         = ( ! empty ( $row->email ) ) ? $row->email : '-';

		$institute_pro_logo    = get_option( 'institute_pro_logo' );
		$institute_pro_name    = get_option( 'institute_pro_name' );
		$institute_pro_address = get_option( 'institute_pro_address' );
		$institute_pro_phone   = get_option( 'institute_pro_phone' );
		$institute_pro_email   = get_option( 'institute_pro_email' );
		$photo                 = $row->photo_id;
		$signature             = $row->signature_id;
		$show_logo             = get_option( 'enable_institute_pro_logo' ) == 'yes';
	?>
	<div id="wl-id-card-box">
		<div class="row">
			<?php if ( $show_logo ) { ?>
			<div class="col-3 mx-auto">
				<img src="<?php echo esc_url( $institute_pro_logo ); ?>" id="wl-institute-pro-id-card-logo" class="img-responsive float-right">
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
					<h4 id="wl-id-card-name" class="mt-1"><?php echo $institute_pro_name; ?></h4>
					<?php
					if( ! empty( $institute_pro_address ) ) { ?>
					<span id="wl-id-card-address"><?php echo $institute_pro_address; ?></span><br>
					<?php
					}
					if( ! empty( $institute_pro_phone ) ) { ?>
					<span id="wl-id-card-contact-phone"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?> - <strong><?php echo $institute_pro_phone; ?></strong>
					<?php
					if( ! empty( $institute_pro_email ) ) { ?> | <?php } ?>
					</span>
					<?php
					}
					if( ! empty( $institute_pro_email ) ) { ?>
					<span id="wl-id-card-contact-email"><?php _e( 'Email', WL_IMP_DOMAIN ); ?> - <strong><?php echo $institute_pro_email; ?></strong></span>
					<?php
					} ?>
				</span>
			</div>
		</div>
		<div class="row text-center">
			<div class="col" id="wl-id-card-title-box">
				<h5 id="wl-id-card-title" class="text-white"><?php _e( 'STUDENT IDENTITY CARD', WL_IMP_DOMAIN ); ?></h5>
			</div>
		</div>
		<div class="row">
			<div class="col-4 pl-5">
				<div id="wl-id-card-photo-box" class="mt-2">
					<?php if( ! empty ( $photo ) ) { ?>
				    <img src="<?php echo wp_get_attachment_url( $photo ); ?>" id="wl-id-card-photo" class="img-responsive">
					<?php } ?>
				</div>
			</div>
			<div class="col-8 mx-auto">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value"><?php echo $enrollment_id; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Name', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value"><?php echo $name; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Course', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value"><?php echo $course; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Duration', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value"><?php echo $duration; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Admission Date', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value"><?php echo $admission_date; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value"><?php echo $phone; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Email', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value"><?php echo $email; ?></span>
					</li>
				</ul>
			</div>
		</div>
		<div class="row wl-id-card-signature-box-row">
			<div class="col-6 text-left">
				<div class="pl-4 ml-4"><?php _e( 'Authorized By', WL_IMP_DOMAIN ); ?></div>
				<div class="wl-id-card-signature-box ml-4"></div>
			</div>
		</div>
	</div>
</div>