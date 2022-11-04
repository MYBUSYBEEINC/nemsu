<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Enquiry {
	/* Get enquiry data to display on table */
	public static function get_enquiry_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$data        = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_enquiries WHERE is_deleted = 0 ORDER BY id DESC" );
		$course_data = $wpdb->get_results( "SELECT id, course_name, course_code FROM {$wpdb->prefix}wl_im_courses ORDER BY course_name", OBJECT_K );

		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id         = $row->id;
				$enquiry_id = WL_IMP_Helper::get_enquiry_id( $row->id );
				$first_name = $row->first_name ? $row->first_name : '-';
				$last_name  = $row->last_name ? $row->last_name : '-';
				$phone      = $row->phone ? $row->phone : '-';
				$email      = $row->email ? $row->email : '-';
				$is_acitve  = $row->is_active ? __( 'Yes', WL_IMP_DOMAIN ) : __( 'No', WL_IMP_DOMAIN );
				$added_by   = ( $user = get_userdata( $row->added_by ) ) ? $user->user_login : '-';
				$date       = date_format( date_create( $row->created_at ), "d-m-Y g:i A" );

				$course = '-';
				if ( $row->course_id && isset( $course_data[$row->course_id] ) ) {
					$course_name = $course_data[$row->course_id]->course_name;
					$course_code = $course_data[$row->course_id]->course_code;
					$course      = "$course_name ($course_code)";
				}

				$results["data"][] = array(
					$enquiry_id,
					$course,
					$first_name,
					$last_name,
					$phone,
					$email,
					$is_acitve,
					$added_by,
					$date,
					'<a class="mr-3" href="#update-enquiry" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" delete-enquiry-security="' . wp_create_nonce( "delete-enquiry-$id" ) . '"delete-enquiry-id="' . $id . '" class="delete-enquiry"> <i class="fa fa-trash text-danger"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Add new enquiry */
	public static function add_enquiry() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-enquiry'], 'add-enquiry' ) ) {
			die();
		}
		global $wpdb;

		$course_id     = isset( $_POST['course'] ) ? intval( sanitize_text_field( $_POST['course'] ) ) : NULL;
		$first_name    = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
		$last_name     = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
		$gender        = isset( $_POST['gender'] ) ? sanitize_text_field( $_POST['gender'] ) : '';
		$date_of_birth = ( isset( $_POST['date_of_birth'] ) && ! empty( $_POST['date_of_birth'] ) ) ? date( "Y-m-d", strtotime( sanitize_text_field( $_REQUEST['date_of_birth'] ) ) ) : NULL;
		$id_proof      = ( isset( $_FILES['id_proof'] ) && is_array( $_FILES['id_proof'] ) ) ? $_FILES['id_proof'] : NULL;
		$father_name   = isset( $_POST['father_name'] ) ? sanitize_text_field( $_POST['father_name'] ) : '';
		$mother_name   = isset( $_POST['mother_name'] ) ? sanitize_text_field( $_POST['mother_name'] ) : '';
		$address       = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
		$city          = isset( $_POST['city'] ) ? sanitize_text_field( $_POST['city'] ) : '';
		$zip           = isset( $_POST['zip'] ) ? sanitize_text_field( $_POST['zip'] ) : '';
		$state         = isset( $_POST['state'] ) ? sanitize_text_field( $_POST['state'] ) : '';
		$nationality   = isset( $_POST['nationality'] ) ? sanitize_text_field( $_POST['nationality'] ) : '';
		$phone         = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
		$qualification = isset( $_POST['qualification'] ) ? sanitize_text_field( $_POST['qualification'] ) : '';
		$email         = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
		$photo         = ( isset( $_FILES['photo'] ) && is_array( $_FILES['photo'] ) ) ? $_FILES['photo'] : NULL;
		$signature     = ( isset( $_FILES['signature'] ) && is_array( $_FILES['signature'] ) ) ? $_FILES['signature'] : NULL;
		$message       = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';
		$is_active     = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $course_id ) ) {
			$errors['course'] = __( 'Please select a course.', WL_IMP_DOMAIN );
		}

		if ( empty( $first_name ) ) {
			$errors['first_name'] = __( 'Please provide first name.', WL_IMP_DOMAIN );
		}

		if ( strlen( $first_name ) > 255 ) {
			$errors['first_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $last_name ) > 255 ) {
			$errors['last_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( ! in_array( $gender, WL_IMP_Helper::get_gender_data() ) ) {
			throw new Exception( __( 'Please select valid gender.', WL_IMP_DOMAIN ) );
		}

		if ( empty( $date_of_birth ) ) {
			$errors['date_of_birth'] = __( 'Please provide date of birth.', WL_IMP_DOMAIN );
		}

		if( ! empty( $date_of_birth ) && ( strtotime( date('Y') - 2 ) <= strtotime( $date_of_birth ) ) ) {
			$errors['date_of_birth'] = __( 'Please provide valid date of birth.', WL_IMP_DOMAIN );
		}

		if( ! empty( $id_proof ) ) {
			$file_name = sanitize_file_name( $id_proof['name'] );
			$file_type = $id_proof['type'];
			$allowed_file_types = WL_IMP_Helper::get_id_proof_file_types();

			if( ! in_array( $file_type, $allowed_file_types ) ) {
				$errors['id_proof'] = __( 'Please provide ID Proof in PDF, JPG, JPEG or PNG format.', WL_IMP_DOMAIN );
			}
		}

		if ( strlen( $father_name ) > 255 ) {
			$errors['father_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $mother_name ) > 255 ) {
			$errors['mother_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $city ) > 255 ) {
			$errors['city'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $zip ) > 255 ) {
			$errors['zip'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $state ) > 255 ) {
			$errors['state'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $nationality ) > 255 ) {
			$errors['nationality'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( empty( $phone ) ) {
			$errors['phone'] = __( 'Please provide phone number.', WL_IMP_DOMAIN );
		}

		if ( strlen( $phone ) > 255 ) {
			$errors['phone'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $qualification ) > 255 ) {
			$errors['qualification'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $email ) > 255 ) {
			$errors['email'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( ! empty( $email ) && ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			$errors['email'] = __( 'Please provide a valid email address.', WL_IMP_DOMAIN );
		}

		if( ! empty( $photo ) ) {
			$file_name = sanitize_file_name( $photo['name'] );
			$file_type = $photo['type'];
			$allowed_file_types = WL_IMP_Helper::get_image_file_types();

			if( ! in_array( $file_type, $allowed_file_types ) ) {
				$errors['photo'] = __( 'Please provide photo in JPG, JPEG or PNG format.', WL_IMP_DOMAIN );
			}
		}

		if( ! empty( $signature ) ) {
			$file_name = sanitize_file_name( $signature['name'] );
			$file_type = $signature['type'];
			$allowed_file_types = WL_IMP_Helper::get_image_file_types();
			if( ! in_array( $file_type, $allowed_file_types ) ) {
				$errors['signature'] = __( 'Please provide signature in JPG, JPEG or PNG format.', WL_IMP_DOMAIN );
			}
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 AND id = $course_id" );

		if ( ! $count ) {
			$errors['course'] = __( 'Please select a valid course.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
			  	$wpdb->query( 'BEGIN;' );

				if( ! empty( $id_proof ) ) {
					$id_proof = media_handle_upload( 'id_proof', 0 );
					if ( is_wp_error( $id_proof ) ) {
	  					throw new Exception( __( $id_proof->get_error_message(), WL_IMP_DOMAIN ) );
					}
				}

				if( ! empty( $photo ) ) {
					$photo = media_handle_upload( 'photo', 0 );
					if ( is_wp_error( $photo ) ) {
	  					throw new Exception( __( $photo->get_error_message(), WL_IMP_DOMAIN ) );
					}
				}

				if( ! empty( $signature ) ) {
					$signature = media_handle_upload( 'signature', 0 );
					if ( is_wp_error( $signature ) ) {
	  					throw new Exception( __( $signature->get_error_message(), WL_IMP_DOMAIN ) );
					}
				}

				$data = array(
					'course_id'     => $course_id,
					'first_name'    => $first_name,
				    'last_name'     => $last_name,
					'gender'        => $gender,
					'date_of_birth' => $date_of_birth,
					'id_proof'      => $id_proof,
					'father_name'   => $father_name,
					'mother_name'   => $mother_name,
					'address'       => $address,
					'city'          => $city,
					'zip'           => $zip,
				    'state'         => $state,
				    'nationality'   => $nationality,
				    'phone'         => $phone,
				    'qualification' => $qualification,
				    'email'         => $email,
				    'photo_id'      => $photo,
				    'signature_id'  => $signature,
				    'message'       => $message,
				    'is_active'     => $is_active,
				    'added_by'      => get_current_user_id()
				);

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_enquiries", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

		  		$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Enquiry added successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Fetch enquiry to update */
	public static function fetch_enquiry() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_enquiries WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}
		$wlim_active_courses = WL_IMP_Helper::get_active_courses();
		?>
		<?php $nonce = wp_create_nonce( "update-enquiry-$id" ); ?>
	    <input type="hidden" name="update-enquiry-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
	    <input type="hidden" name="action" value="wl-im-update-enquiry">
		<div class="row" id="wlim-enquiry-enquiry_id">
			<div class="col">
				<label  class="col-form-label pb-0"><?php _e( 'Enquiry ID', WL_IMP_DOMAIN ); ?>:</label>
				<div class="card mb-3 mt-2">
					<div class="card-block">
	    				<span class="text-dark"><?php echo WL_IMP_Helper::get_enquiry_id( $row->id ); ?></span>
	  				</div>
				</div>
			</div>
		</div>
		<div class="form-group">
            <label for="wlim-enquiry-course_update" class="col-form-label">* <?php _e( "Admission For", WL_IMP_DOMAIN ); ?>:</label>
            <select name="course" class="form-control selectpicker" id="wlim-enquiry-course_update">
                <option value="">-------- <?php _e( "Select a Course", WL_IMP_DOMAIN ); ?> --------</option>
            <?php
            if ( count( $wlim_active_courses ) > 0 ) {
                foreach ( $wlim_active_courses as $active_course ) {  ?>
		        <option value="<?php echo $active_course->id; ?>"><?php echo "$active_course->course_name ($active_course->course_code)"; ?></option>
            <?php
                }
            } ?>
            </select>
        </div>
        <div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-first_name_update" class="col-form-label">* <?php _e( 'First Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="first_name" type="text" class="form-control" id="wlim-enquiry-first_name_update" placeholder="<?php _e( "First Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->first_name; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-last_name_update" class="col-form-label"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="last_name" type="text" class="form-control" id="wlim-enquiry-last_name_update" placeholder="<?php _e( "Last Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->last_name; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="col-form-label">* <?php _e( 'Gender', WL_IMP_DOMAIN ); ?>:</label><br>
		    	<div class="row mt-2">
		    		<div class="col-sm-12">
						<label class="radio-inline mr-3"><input type="radio" name="gender" class="mr-2" value="male" id="wlim-enquiry-male_update"><?php _e( 'Male', WL_IMP_DOMAIN ); ?></label>
		    			<label class="radio-inline"><input type="radio" name="gender" class="mr-2" value="female" id="wlim-enquiry-female_update"><?php _e( 'Female', WL_IMP_DOMAIN ); ?></label>
	    			</div>
		    	</div>
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-date_of_birth_update" class="col-form-label">* <?php _e( 'Date of Birth', WL_IMP_DOMAIN ); ?>:</label>
				<input name="date_of_birth" type="text" class="form-control wlim-date_of_birth_update" id="wlim-enquiry-date_of_birth_update" placeholder="<?php _e( "Date of Birth", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-father_name_update" class="col-form-label"><?php _e( 'Father Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="father_name" type="text" class="form-control" id="wlim-enquiry-father_name_update" placeholder="<?php _e( "Father Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->father_name; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-mother_name_update" class="col-form-label"><?php _e( 'Mother Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="mother_name" type="text" class="form-control" id="wlim-enquiry-mother_name_update" placeholder="<?php _e( "Mother Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->mother_name; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-address_update" class="col-form-label"><?php _e( 'Address', WL_IMP_DOMAIN ); ?>:</label>
				<textarea name="address" class="form-control" rows="4" id="wlim-enquiry-address_update" placeholder="<?php _e( "Address", WL_IMP_DOMAIN ); ?>"><?php echo $row->address; ?></textarea>
			</div>
			<div class="col-sm-6 form-group">
				<div>
					<label for="wlim-enquiry-city_update" class="col-form-label"><?php _e( 'City', WL_IMP_DOMAIN ); ?>:</label>
					<input name="city" type="text" class="form-control" id="wlim-enquiry-city_update" placeholder="<?php _e( "City", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->city; ?>">
				</div>
				<div>
					<label for="wlim-enquiry-zip_update" class="col-form-label"><?php _e( 'Zip Code', WL_IMP_DOMAIN ); ?>:</label>
					<input name="zip" type="text" class="form-control" id="wlim-enquiry-zip_update" placeholder="<?php _e( "Zip Code", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->zip; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-state_update" class="col-form-label"><?php _e( 'State', WL_IMP_DOMAIN ); ?>:</label>
				<input name="state" type="text" class="form-control" id="wlim-enquiry-state_update" placeholder="<?php _e( "State", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->state; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-nationality_update" class="col-form-label"><?php _e( 'Nationality', WL_IMP_DOMAIN ); ?>:</label>
				<input name="nationality" type="text" class="form-control" id="wlim-enquiry-nationality_update" placeholder="<?php _e( "Nationality", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->nationality; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-phone_update" class="col-form-label">* <?php _e( 'Phone', WL_IMP_DOMAIN ); ?>:</label>
				<input name="phone" type="text" class="form-control" id="wlim-enquiry-phone_update" placeholder="<?php _e( "Phone", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->phone; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-email_update" class="col-form-label"><?php _e( 'Email', WL_IMP_DOMAIN ); ?>:</label>
				<input name="email" type="text" class="form-control" id="wlim-enquiry-email_update" placeholder="<?php _e( "Email", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->email; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-qualification_update" class="col-form-label"><?php _e( 'Qualification', WL_IMP_DOMAIN ); ?>:</label>
				<input name="qualification" type="text" class="form-control" id="wlim-enquiry-qualification_update" placeholder="<?php _e( "Qualification", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->qualification; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-id_proof_update" class="col-form-label"><?php _e( 'ID Proof', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->id_proof ) ) { ?>
			    <a href="<?php echo wp_get_attachment_url( $row->id_proof ); ?>" target="_blank" class="btn btn-sm btn-outline-primary"><?php _e( 'View ID Proof', WL_IMP_DOMAIN ); ?></a>
				<input type="hidden" name="id_proof_in_db" value="<?php echo $row->id_proof; ?>">
				<?php } ?>
			    <input name="id_proof" type="file" id="wlim-enquiry-id_proof_update">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-photo_update" class="col-form-label"><?php _e( 'Photo', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->photo_id ) ) { ?>
			    <img src="<?php echo wp_get_attachment_url( $row->photo_id ); ?>" class="img-responsive photo-signature">
				<input type="hidden" name="photo_in_db" value="<?php echo $row->photo_id; ?>">
				<?php } ?>
			    <input name="photo" type="file" id="wlim-enquiry-photo_update">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-enquiry-signature_update" class="col-form-label"><?php _e( 'Signature', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->signature_id ) ) { ?>
			    <img src="<?php echo wp_get_attachment_url( $row->signature_id ); ?>" class="img-responsive photo-signature">
				<input type="hidden" name="signature_in_db" value="<?php echo $row->signature_id; ?>">
				<?php } ?>
			    <input name="signature" type="file" id="wlim-enquiry-signature_update">
			</div>
		</div>
		<div class="form-group">
			<label for="wlim-enquiry-message_update" class="col-form-label"><?php _e( 'Message', WL_IMP_DOMAIN ); ?>:</label>
			<textarea name="message" class="form-control" rows="3" id="wlim-enquiry-message_update" placeholder="<?php _e( "Message", WL_IMP_DOMAIN ); ?>"><?php echo $row->message; ?></textarea>
		</div>
		<div class="form-check pl-0">
			<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-enquiry-is_active_update" <?php echo $row->is_active ? "checked" : ""; ?>>
			<label class="form-check-label" for="wlim-enquiry-is_active_update">
			<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
			</label>
		</div>
		<input type="hidden" name="enquiry_id" value="<?php echo $row->id; ?>">
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
		<?php 
		$wlim_date_selector = '.wlim-date_of_birth_update';
		require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_date_picker.php' ); ?>
		<script>
			/* Select single option */
			jQuery('#wlim-enquiry-course_update').selectpicker({
				liveSearch: true
			});
			jQuery('#wlim-enquiry-course_update').selectpicker('val', '<?php echo $row->course_id; ?>');

			/* Select gender */
			jQuery("input[name=gender][value=<?php echo $row->gender; ?>]").prop('checked', true);

			/* Select date of birth */
			jQuery('<?php echo $wlim_date_selector; ?>').data("DateTimePicker").date(moment("<?php echo $row->date_of_birth; ?>"));
		</script>
	<?php
		die();
	}

	/* Update enquiry */
	public static function update_enquiry() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['enquiry_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-enquiry-$id"], "update-enquiry-$id" ) ) {
			die();
		}
		global $wpdb;

		$course_id        = isset( $_POST['course'] ) ? intval( sanitize_text_field( $_POST['course'] ) ) : NULL;
		$first_name       = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
		$last_name        = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
		$gender           = isset( $_POST['gender'] ) ? sanitize_text_field( $_POST['gender'] ) : '';
		$date_of_birth    = ( isset( $_POST['date_of_birth'] ) && ! empty( $_POST['date_of_birth'] ) ) ? date( "Y-m-d", strtotime( sanitize_text_field( $_REQUEST['date_of_birth'] ) ) ) : NULL;
		$id_proof         = ( isset( $_FILES['id_proof'] ) && is_array( $_FILES['id_proof'] ) ) ? $_FILES['id_proof'] : NULL;
		$id_proof_in_db   = isset( $_POST['id_proof_in_db'] ) ? intval( sanitize_text_field( $_POST['id_proof_in_db'] ) ) : NULL;
		$father_name      = isset( $_POST['father_name'] ) ? sanitize_text_field( $_POST['father_name'] ) : '';
		$mother_name      = isset( $_POST['mother_name'] ) ? sanitize_text_field( $_POST['mother_name'] ) : '';
		$address          = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
		$city             = isset( $_POST['city'] ) ? sanitize_text_field( $_POST['city'] ) : '';
		$zip              = isset( $_POST['zip'] ) ? sanitize_text_field( $_POST['zip'] ) : '';
		$state            = isset( $_POST['state'] ) ? sanitize_text_field( $_POST['state'] ) : '';
		$nationality      = isset( $_POST['nationality'] ) ? sanitize_text_field( $_POST['nationality'] ) : '';
		$phone            = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
		$qualification    = isset( $_POST['qualification'] ) ? sanitize_text_field( $_POST['qualification'] ) : '';
		$email            = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
		$photo            = ( isset( $_FILES['photo'] ) && is_array( $_FILES['photo'] ) ) ? $_FILES['photo'] : NULL;
		$photo_in_db      = isset( $_POST['photo_in_db'] ) ? intval( sanitize_text_field( $_POST['photo_in_db'] ) ) : NULL;
		$signature        = ( isset( $_FILES['signature'] ) && is_array( $_FILES['signature'] ) ) ? $_FILES['signature'] : NULL;
		$signature_in_db  = isset( $_POST['signature_in_db'] ) ? intval( sanitize_text_field( $_POST['signature_in_db'] ) ) : NULL;
		$message          = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';
		$is_active        = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $course_id ) ) {
			$errors['course'] = __( 'Please select a course.', WL_IMP_DOMAIN );
		}

		if ( empty( $first_name ) ) {
			$errors['first_name'] = __( 'Please provide first name.', WL_IMP_DOMAIN );
		}

		if ( strlen( $first_name ) > 255 ) {
			$errors['first_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $last_name ) > 255 ) {
			$errors['last_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( ! in_array( $gender, WL_IMP_Helper::get_gender_data() ) ) {
			throw new Exception( __( 'Please select valid gender.', WL_IMP_DOMAIN ) );
		}

		if ( empty( $date_of_birth ) ) {
			$errors['date_of_birth'] = __( 'Please provide date of birth.', WL_IMP_DOMAIN );
		}

		if( ! empty( $date_of_birth ) && ( strtotime( date('Y') - 2 ) <= strtotime( $date_of_birth ) ) ) {
			$errors['date_of_birth'] = __( 'Please provide valid date of birth.', WL_IMP_DOMAIN );
		}

		if( ! empty( $id_proof ) ) {
			$file_name = sanitize_file_name( $id_proof['name'] );
			$file_type = $id_proof['type'];
			$allowed_file_types = WL_IMP_Helper::get_id_proof_file_types();

			if( ! in_array( $file_type, $allowed_file_types ) ) {
				$errors['id_proof'] = __( 'Please provide ID Proof in PDF, JPG, JPEG or PNG format.', WL_IMP_DOMAIN );
			}
		}

		if ( strlen( $father_name ) > 255 ) {
			$errors['father_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $mother_name ) > 255 ) {
			$errors['mother_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $city ) > 255 ) {
			$errors['city'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $zip ) > 255 ) {
			$errors['zip'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $state ) > 255 ) {
			$errors['state'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $nationality ) > 255 ) {
			$errors['nationality'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( empty( $phone ) ) {
			$errors['phone'] = __( 'Please provide phone number.', WL_IMP_DOMAIN );
		}

		if ( strlen( $phone ) > 255 ) {
			$errors['phone'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $qualification ) > 255 ) {
			$errors['qualification'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $email ) > 255 ) {
			$errors['email'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( ! empty( $email ) && ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			$errors['email'] = __( 'Please provide a valid email address.', WL_IMP_DOMAIN );
		}

		if( ! empty( $photo ) ) {
			$file_name = sanitize_file_name( $photo['name'] );
			$file_type = $photo['type'];
			$allowed_file_types = WL_IMP_Helper::get_image_file_types();

			if( ! in_array( $file_type, $allowed_file_types ) ) {
				$errors['photo'] = __( 'Please provide photo in JPG, JPEG or PNG format.', WL_IMP_DOMAIN );
			}
		}

		if( ! empty( $signature ) ) {
			$file_name = sanitize_file_name( $signature['name'] );
			$file_type = $signature['type'];
			$allowed_file_types = WL_IMP_Helper::get_image_file_types();
			if( ! in_array( $file_type, $allowed_file_types ) ) {
				$errors['signature'] = __( 'Please provide signature in JPG, JPEG or PNG format.', WL_IMP_DOMAIN );
			}
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 AND id = $course_id" );

		if ( ! $count ) {
			$errors['course'] = __( 'Please select a valid course.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				$data = array(
					'course_id'     => $course_id,
					'first_name'    => $first_name,
				    'last_name'     => $last_name,
					'gender'        => $gender,
					'date_of_birth' => $date_of_birth,
					'father_name'   => $father_name,
					'mother_name'   => $mother_name,
					'address'       => $address,
					'city'          => $city,
					'zip'           => $zip,
				    'state'         => $state,
				    'nationality'   => $nationality,
				    'phone'         => $phone,
				    'qualification' => $qualification,
				    'email'         => $email,
				    'message'       => $message,
				    'is_active'     => $is_active,
				    'updated_at'    => date('Y-m-d H:i:s')
				);

				if( ! empty( $id_proof ) ) {					
					$id_proof = media_handle_upload( 'id_proof', 0 );
					if ( is_wp_error( $id_proof ) ) {
	  					throw new Exception( __( $id_proof->get_error_message(), WL_IMP_DOMAIN ) );
					}
					$data['id_proof'] = $id_proof;
				}

				if( ! empty( $photo ) ) {
					$photo = media_handle_upload( 'photo', 0 );
					if ( is_wp_error( $photo ) ) {
	  					throw new Exception( __( $photo->get_error_message(), WL_IMP_DOMAIN ) );
					}
					$data['photo_id'] = $photo;
				}

				if( ! empty( $signature ) ) {
					$signature = media_handle_upload( 'signature', 0 );
					if ( is_wp_error( $signature ) ) {
	  					throw new Exception( __( $signature->get_error_message(), WL_IMP_DOMAIN ) );
					}
					$data['signature_id'] = $signature;
				}

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_enquiries", $data, array( 'is_deleted' => 0, 'id' => $id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$wpdb->query( 'COMMIT;' );

				if( ! empty( $id_proof ) && ! empty( $id_proof_in_db) ) {
					wp_delete_attachment( $id_proof_in_db, true );
				}

				if( ! empty( $photo ) && ! empty( $photo_in_db) ) {
					wp_delete_attachment( $photo_in_db, true );
				}

				if( ! empty( $signature ) && ! empty( $signature_in_db) ) {
					wp_delete_attachment( $signature_in_db, true );
				}

				wp_send_json_success( array( 'message' => __( 'Enquiry updated successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Delete enquiry */
	public static function delete_enquiry() {
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-enquiry-$id"], "delete-enquiry-$id" ) ) {
			die();
		}
		global $wpdb;

		try {
			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_enquiries",
					array(
						'is_deleted' => 1,
						'deleted_at' => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'id' => $id )
				);
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$wpdb->query( 'COMMIT;' );
			wp_send_json_success( array( 'message' => __( 'Enquiry removed successfully.', WL_IMP_DOMAIN ) ) );
		} catch ( Exception $exception ) {
	  		$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error( __( $exception->getMessage(), WL_IMP_DOMAIN ) );
		}
	}

	/* Check permission to manage enquiry */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_enquiries' ) ) {
			die();
		}
	}
}