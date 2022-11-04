<div id="wl-admission-detail">
	<style>
		#wl-admission-detail {
			width: 1240px;
			height: 1754px;
			border: 1px solid #b3b3b3;
			padding: 20px;
			margin: 0 auto;
		}
		#wl-admission-detail-box {
			margin-top: 30px;
		}
		#wl-admission-detail .list-group-item, #wl-admission-detail table {
			font-size: 16px;
		}
		#wl-admission-detail-photo-box {
			height: 245px;
		}
		#wl-admission-detail-photo {
			height: 225px;
		}
		#wl-admission-detail-signature-box {
			height: 95px;
		}
		#wl-admission-detail-signature {
			height: 85px;
		}
		#wl-admission-detail-photo, #wl-admission-detail-signature {
			width: 175px;
		}
		.wl-admission-detail-signature-box-row {
			margin-top: 540px;
		}
		#wl-admission-detail-photo-box, #wl-admission-detail-signature-box {
			width: 185px;
			border: 1px solid #b3b3b3;
			padding: 5px;
		}
		#wl-institute-pro-admission-detail-logo {
			max-height: 80px;
			max-width: 80px;
		}
	 	#wl-admission-detail-address {
	 		font-size: 15px;
		 }
		#wl-admission-detail-contact-phone, #wl-admission-detail-contact-email {
			font-size: 15px;
		}
		.wl-admission-detail-subtitle {
			font-size: 22px;
			text-align: center;
			font-weight: 600;
			background-color: #e4e4e4 !important;
		}
		#wl-admission-detail-form-number {
			font-size: 14px;
		}
		#wl-admission-detail-name {
			font-size: 22px;
		}
		@media print {
			body {
				-webkit-print-color-adjust: exact;
			}
		}
	</style>
	<?php
		$enrollment_id = WL_IMP_Helper::get_enrollment_id( $row->id );
		$form_number   = WL_IMP_Helper::get_form_number( $row->id );
		$course        = $wpdb->get_row( "SELECT course_name, course_code, duration, duration_in FROM {$wpdb->prefix}wl_im_courses WHERE id = $row->course_id" );
		$duration      = $course->duration;
		$duration_in   = $course->duration_in;
		$duration_in   = ( $duration < 2 ) ? __( substr( $duration_in, 0, -1 ), WL_IMP_DOMAIN ) : __( $duration_in, 0, -1, WL_IMP_DOMAIN );

		$name           = $row->first_name . " $row->last_name";
		$father_name    = $row->father_name;
		$mother_name    = $row->mother_name;
		$course         = ( ! empty ( $course ) ) ? "{$course->course_name} ({$course->course_code})" : '-';
		$duration       = "{$duration} {$duration_in}";
		$phone          = ( ! empty ( $row->phone ) ) ? $row->phone : '-';
		$email          = ( ! empty ( $row->email ) ) ? $row->email : '-';
		$gender         = ( $row->gender == 'male' ) ? __( 'Male', WL_IMP_DOMAIN ) : __( 'Female', WL_IMP_DOMAIN );
		$date_of_birth  = ( ! empty ( $row->date_of_birth ) ) ? date_format( date_create( $row->date_of_birth ), "d M, Y" ) : '-';
		$nationality    = ( ! empty ( $row->nationality ) ) ? $row->nationality : '-';
		$address        = ( ! empty ( $row->address ) ) ? $row->address : '-';
		$city           = ( ! empty ( $row->city ) ) ? $row->city : '-';
		$state          = ( ! empty ( $row->state ) ) ? $row->state : '-';
		$zip            = ( ! empty ( $row->zip ) ) ? $row->zip : '-';
		$admission_date = ( ! empty ( $row->created_at ) ) ? date_format( date_create( $row->created_at ), "d M, Y" ) : '-';

		$institute_pro_logo    = get_option( 'institute_pro_logo' );
		$institute_pro_name    = get_option( 'institute_pro_name' );
		$institute_pro_address = get_option( 'institute_pro_address' );
		$institute_pro_phone   = get_option( 'institute_pro_phone' );
		$institute_pro_email   = get_option( 'institute_pro_email' );
		$photo                 = $row->photo_id;
		$signature             = $row->signature_id;
		$show_logo             = get_option( 'enable_institute_pro_logo' ) == 'yes';
	?>
	<div id="wl-admission-detail-box">
		<div class="row">
			<div class="col mx-auto">
				<span class="float-right" id="wl-admission-detail-form-number"><?php _e( 'Form No.', WL_IMP_DOMAIN ); ?> <strong><?php echo $form_number; ?></strong></span>
			</div>
		</div>
		<div class="row">
			<?php if ( $show_logo ) { ?>
			<div class="col-4 mx-auto">
				<img src="<?php echo esc_url( $institute_pro_logo ); ?>" id="wl-institute-pro-admission-detail-logo" class="img-responsive float-right">
			</div>
			<?php
			} ?>
			<div class="<?php echo $show_logo ? "col-8 " : "col-12 text-center "; ?>mx-auto">
				<?php if ( $show_logo ) { ?>
				<span class="float-left">
				<?php
				} else { ?>
				<span>
				<?php
				} ?>
					<h3 class="mt-1" id="wl-admission-detail-name"><?php echo $institute_pro_name; ?></h3>
					<?php
					if( ! empty( $institute_pro_address ) ) { ?>
					<span id="wl-admission-detail-address"><?php echo $institute_pro_address; ?></span><br>
					<?php
					}
					if( ! empty( $institute_pro_phone ) ) { ?>
					<span id="wl-admission-detail-contact-phone"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?> - <strong><?php echo $institute_pro_phone; ?></strong>
					<?php
					if( ! empty( $institute_pro_email ) ) { ?> | <?php } ?>
					</span>
					<?php
					}
					if( ! empty( $institute_pro_email ) ) { ?>
					<span id="wl-admission-detail-contact-email"><?php _e( 'Email', WL_IMP_DOMAIN ); ?> - <strong><?php echo $institute_pro_email; ?></strong></span>
					<?php
					} ?>
				</span>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col mx-auto">
				<div class="wl-admission-detail-subtitle"><?php _e( 'Basic Details', WL_IMP_DOMAIN ); ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-9 mx-auto">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $enrollment_id; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Student Name', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $name; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( "Father's Name", WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $father_name; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( "Mother's Name", WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $mother_name; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Course', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $course; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Duration', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $duration; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Registration Date', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $admission_date; ?></span>
					</li>
				</ul>
			</div>
			<div class="col-3 mx-auto">
				<div class="ml-5">
					<div id="wl-admission-detail-photo-box" class="mt-2">
						<?php if( ! empty ( $photo ) ) { ?>
					    <img src="<?php echo wp_get_attachment_url( $photo ); ?>" id="wl-admission-detail-photo" class="img-responsive">
						<?php } ?>
				    </div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col mx-auto">
				<div class="wl-admission-detail-subtitle"><?php _e( 'Contact Details', WL_IMP_DOMAIN ); ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-9 mx-auto">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Address', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $address; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'City / State', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo "$city, $state"; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Zip', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $zip; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $email; ?></span>
					</li>
					<li class="list-group-item">
						<span class="list-group-heading font-weight-bold"><?php _e( 'Email', WL_IMP_DOMAIN ); ?>: </span>
						<span class="list-group-value float-right"><?php echo $phone; ?></span>
					</li>
				</ul>
			</div>
			<div class="col-3 mx-auto">
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col mx-auto">
				<div class="wl-admission-detail-subtitle"><?php _e( 'Personal Details', WL_IMP_DOMAIN ); ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 mx-auto">
				<table class="table">
					<thead>
						<tr class="d-flex">
							<th class="col" scope="col"><?php _e( 'Date of Birth', WL_IMP_DOMAIN ); ?></th>
							<th class="col" scope="col"><?php _e( 'Gender', WL_IMP_DOMAIN ); ?></th>
							<th class="col" scope="col"><?php _e( 'Nationality', WL_IMP_DOMAIN ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="d-flex">
							<td class="col"><?php echo $date_of_birth; ?></td>
							<td class="col"><?php echo $gender; ?></td>
							<td class="col"><?php echo $nationality; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div class="row wl-admission-detail-signature-box-row">
			<div class="col-6 text-left">
				<div class="font-weight-bold"><?php _e( 'Candidate Signature', WL_IMP_DOMAIN ); ?></div>
				<div class="wl-admission-detail-signature-box mt-1"></div>
			</div>
			<div class="col-6 text-right">
				<div class="font-weight-bold"><?php _e( 'Authorized By', WL_IMP_DOMAIN ); ?></div>
				<div class="wl-admission-detail-signature-box mt-1 float-right"></div>
			</div>
		</div>
	</div>
</div>