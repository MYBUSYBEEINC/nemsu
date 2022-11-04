<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Student {
	/* Get student data to display on table */
	public static function get_student_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		/* Filters */
		$filter_by_year  = ( isset( $_REQUEST['filter_by_year'] ) && ! empty( $_REQUEST['filter_by_year'] ) ) ? intval( sanitize_text_field( $_REQUEST['filter_by_year'] ) ) : NULL;
		$filter_by_month = ( isset( $_REQUEST['filter_by_month'] ) && ! empty( $_REQUEST['filter_by_month'] ) ) ? intval( sanitize_text_field( $_REQUEST['filter_by_month'] ) ) : NULL;
		$status          = isset( $_REQUEST['status'] ) ? sanitize_text_field( $_REQUEST['status'] ) : NULL;
		$course_id       = isset( $_REQUEST['course_id'] ) ? intval( sanitize_text_field( $_REQUEST['course_id'] ) ) : NULL;
		$batch_id        = isset( $_REQUEST['batch_id'] ) ? intval( sanitize_text_field( $_REQUEST['batch_id'] ) ) : NULL;

		$filters = array();

		/* Add Filter: year */
		if( ! empty( $filter_by_year ) ) {
			array_push( $filters, "YEAR(created_at) = $filter_by_year" );

			/* Add Filter: month */
			if ( ! empty( $filter_by_month ) ) {
				array_push( $filters, "MONTH(created_at) = $filter_by_month" );
			}
		}

		/* Add Filter: status */
		if( ! empty( $status ) ) {
			if ( $status == 'current' ) {
				array_push( $filters, "course_completed = 0" );
			} elseif( $status == 'former' ) {
				array_push( $filters, "course_completed = 1" );
			}
		}

		/* Add Filter: course */
		if ( ! empty( $course_id ) ) {
			array_push( $filters, "course_id = $course_id" );
		}

		/* Add Filter: branch */
		if ( ! empty( $batch_id ) ) {
			array_push( $filters, "batch_id = $batch_id" );
		}
		/* End filters */

		if ( count( $filters ) ) {
			$filter_query = 'AND ' . implode( ' AND ', $filters );
		} else {
			$filter_query = '';
		}

		if( ! empty( $filter_query ) ) {
			$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 $filter_query ORDER BY id DESC" );
		} else {
			$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 ORDER BY id DESC" );
		}

		$course_data = $wpdb->get_results( "SELECT id, course_name, course_code, fees, duration, duration_in FROM {$wpdb->prefix}wl_im_courses ORDER BY course_name", OBJECT_K );

		$batch_data = $wpdb->get_results( "SELECT id, batch_code FROM {$wpdb->prefix}wl_im_batches ORDER BY id", OBJECT_K );

		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id               = $row->id;
				$enrollment_id    = WL_IMP_Helper::get_enrollment_id( $id );
				$first_name       = $row->first_name ? $row->first_name : '-';
				$last_name        = $row->last_name ? $row->last_name : '-';
				$fees_payable     = $row->fees_payable;
				$fees_paid        = $row->fees_paid;
				$pending_fees     = number_format( $fees_payable - $fees_paid, 2, '.', '' );
				$phone            = $row->phone ? $row->phone : '-';
				$email            = $row->email ? $row->email : '-';
				$address          = $row->address ? $row->address : '-';
				$city             = $row->city ? $row->city : '-';
				$zip              = $row->zip ? $row->zip : '-';
				$state            = $row->state ? $row->state : '-';
				$nationality      = $row->nationality ? $row->nationality : '-';
				$is_acitve        = $row->is_active ? __( 'Yes', WL_IMP_DOMAIN ) : __( 'No', WL_IMP_DOMAIN );
				$date             = date_format( date_create( $row->created_at ), "d-m-Y g:i A" );
				$added_by         = ( $user = get_userdata( $row->added_by ) ) ? $user->user_login : '-';
				$course_completed = $row->course_completed;
				$completion_date  = $row->course_completed ? date_format( date_create( $row->completion_date ), "d-m-Y g:i A" ) : '-';

				$course   = '-';
				$duration = '-';
				$batch    = '-';
				if ( $row->course_id && isset( $course_data[$row->course_id] ) ) {
					$course_name = $course_data[$row->course_id]->course_name;
					$course_code = $course_data[$row->course_id]->course_code;
					$course      = "$course_name ($course_code)";
					$duration    = $course_data[$row->course_id]->duration . " " . $course_data[$row->course_id]->duration_in;
					if ( $course_completed ) {
						$duration .= ' <strong class="text-primary">' . __( 'Completed', WL_IMP_DOMAIN ) . '</strong>';
					}
				}

				if ( $row->batch_id && isset( $batch_data[$row->batch_id] ) ) {
					$batch = $batch_data[$row->batch_id]->batch_code;
				}

				if ( $pending_fees > 0 ) {
					$fees_status = '<strong class="text-danger">' . __( 'Pending', WL_IMP_DOMAIN ) . ': </strong><br><strong>' . $pending_fees . '</strong>';
				} else {
					$fees_status = '<strong class="text-success">' . __( 'Paid', WL_IMP_DOMAIN ) . '</strong>';
				}

				$results["data"][] = array(
					$enrollment_id,
					$course,
					$batch,
					$duration,
					$first_name,
					$last_name,
					$fees_payable,
					$fees_paid,
					$fees_status,
					$phone,
					$email,
					$address,
					$city,
					$zip,
					$state,
					$nationality,
					$is_acitve,
					$added_by,
					$date,
					$completion_date,
					'<a class="mr-3" href="#update-student" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" delete-student-security="' . wp_create_nonce( "delete-student-$id" ) . '"delete-student-id="' . $id . '" class="delete-student"> <i class="fa fa-trash text-danger"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Add new student */
	public static function add_student() {		
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-student'], 'add-student' ) ) {
			die();
		}
		global $wpdb;

		$course_id       = isset( $_POST['course'] ) ? intval( sanitize_text_field( $_POST['course'] ) ) : NULL;
		$batch_id        = isset( $_POST['batch'] ) ? intval( sanitize_text_field( $_POST['batch'] ) ) : NULL;
		$first_name      = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
		$last_name       = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
		$gender          = isset( $_POST['gender'] ) ? sanitize_text_field( $_POST['gender'] ) : '';
		$date_of_birth   = ( isset( $_POST['date_of_birth'] ) && ! empty( $_POST['date_of_birth'] ) ) ? date( "Y-m-d", strtotime( sanitize_text_field( $_REQUEST['date_of_birth'] ) ) ) : NULL;
		$id_proof        = ( isset( $_FILES['id_proof'] ) && is_array( $_FILES['id_proof'] ) ) ? $_FILES['id_proof'] : NULL;
		$id_proof_in_db  = isset( $_POST['id_proof_in_db'] ) ? intval( sanitize_text_field( $_POST['id_proof_in_db'] ) ) : NULL;
		$father_name     = isset( $_POST['father_name'] ) ? sanitize_text_field( $_POST['father_name'] ) : '';
		$mother_name     = isset( $_POST['mother_name'] ) ? sanitize_text_field( $_POST['mother_name'] ) : '';
		$address         = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
		$city            = isset( $_POST['city'] ) ? sanitize_text_field( $_POST['city'] ) : '';
		$zip             = isset( $_POST['zip'] ) ? sanitize_text_field( $_POST['zip'] ) : '';
		$state           = isset( $_POST['state'] ) ? sanitize_text_field( $_POST['state'] ) : '';
		$nationality     = isset( $_POST['nationality'] ) ? sanitize_text_field( $_POST['nationality'] ) : '';
		$phone           = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
		$qualification   = isset( $_POST['qualification'] ) ? sanitize_text_field( $_POST['qualification'] ) : '';
		$email           = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
		$photo           = ( isset( $_FILES['photo'] ) && is_array( $_FILES['photo'] ) ) ? $_FILES['photo'] : NULL;
		$photo_in_db     = isset( $_POST['photo_in_db'] ) ? intval( sanitize_text_field( $_POST['photo_in_db'] ) ) : NULL;
		$signature       = ( isset( $_FILES['signature'] ) && is_array( $_FILES['signature'] ) ) ? $_FILES['signature'] : NULL;
		$signature_in_db = isset( $_POST['signature_in_db'] ) ? intval( sanitize_text_field( $_POST['signature_in_db'] ) ) : NULL;
		$fees_payable    = number_format( isset( $_POST['fees_payable'] ) ? max( floatval( sanitize_text_field( $_POST['fees_payable'] ) ), 0 ) : 0, 2, '.', '' );
		$fees_paid       = number_format( isset( $_POST['fees_paid'] ) ? max( floatval( sanitize_text_field( $_POST['fees_paid'] ) ), 0 ) : 0, 2, '.', '' );
		$is_active       = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;
		$enquiry         = isset( $_POST['enquiry'] ) ? intval( sanitize_text_field( $_POST['enquiry'] ) ) : NULL;
		$from_enquiry    = isset( $_POST['from_enquiry'] ) ? boolval( sanitize_text_field( $_POST['from_enquiry'] ) ) : 0;
		$enquiry_action  = isset( $_POST['enquiry_action'] ) ? sanitize_text_field( $_POST['enquiry_action'] ) : '';

		$allow_login      = isset( $_POST['allow_login'] ) ? boolval( sanitize_text_field( $_POST['allow_login'] ) ) : 0;
		$username         = isset( $_POST['username'] ) ? sanitize_text_field( $_POST['username'] ) : '';
		$password         = isset( $_POST['password'] ) ? $_POST['password'] : '';
		$password_confirm = isset( $_POST['password_confirm'] ) ? $_POST['password_confirm'] : '';

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

		if ( $allow_login ) {
			if ( empty( $username ) ) {
				$errors['username'] = __( 'Please provide username.', WL_IMP_DOMAIN );
			}

			if ( empty( $password ) ) {
				$errors['password'] = __( 'Please provide password.', WL_IMP_DOMAIN );
			}

			if ( empty( $password_confirm ) ) {
				$errors['password_confirm'] = __( 'Please confirm password.', WL_IMP_DOMAIN );
			}

			if ( $password !== $password_confirm ) {
				$errors['password'] = __( 'Passwords do not match.', WL_IMP_DOMAIN );
			}
		}

		if ( ! in_array( $gender, WL_IMP_Helper::get_gender_data() ) ) {
			wp_send_json_error( __( 'Please select valid gender.', WL_IMP_DOMAIN ) );
		}

		if( ! empty( $date_of_birth ) && ( strtotime( date('Y') - 2 ) <= strtotime( $date_of_birth ) ) ) {
			$errors['date_of_birth'] = __( 'Please provide valid date of birth.', WL_IMP_DOMAIN );
		}

		if ( empty( $date_of_birth ) ) {
			$errors['date_of_birth'] = __( 'Please provide date of birth.', WL_IMP_DOMAIN );
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

		if ( $fees_paid > $fees_payable ) {
			$errors['fees_paid'] = __( 'Amount paid exceeded payable amount.', WL_IMP_DOMAIN );
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 AND id = $course_id" );

		if ( ! $count ) {
			$errors['course'] = __( 'Please select a valid course.', WL_IMP_DOMAIN );
		}

		if ( ! empty( $batch_id ) ) {
			$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND is_active = 1 AND id = $batch_id AND course_id = $course_id" );

			if ( ! $count ) {
				$errors['batch'] = __( 'Please select a valid batch.', WL_IMP_DOMAIN );
			}
		} else {
			$batch_id = NULL;
		}

		$valid_enquiry_action = false;
		if ( $from_enquiry ) {
			$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_enquiries WHERE is_deleted = 0 AND is_active = 1 AND id = $enquiry" );

			if ( ! $count ) {
				wp_send_json_error( __( 'Please select a valid enquiry', WL_IMP_DOMAIN ) );
			} else {
				if ( ! in_array( $enquiry_action, WL_IMP_Helper::get_enquiry_action_data() ) ) {
		  			throw new Exception( __( 'Please select valid action to perform after adding student.', WL_IMP_DOMAIN ) );
				} else {
					$valid_enquiry_action = true;
				}
			}
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
			  	$wpdb->query( 'BEGIN;' );

				$data = array(
					'course_id'     => $course_id,
					'batch_id'      => $batch_id,
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
				    'fees_payable'  => $fees_payable,
				    'fees_paid'     => $fees_paid,
				    'is_active'     => $is_active,
				    'added_by'      => get_current_user_id()
				);

				if( ! empty( $id_proof ) ) {
					$id_proof = media_handle_upload( 'id_proof', 0 );
					if ( is_wp_error( $id_proof ) ) {
	  					throw new Exception( __( $id_proof->get_error_message(), WL_IMP_DOMAIN ) );
					}
					$data['id_proof'] = $id_proof;
				} else {
					$data['id_proof'] = $id_proof_in_db;
				}

				if( ! empty( $photo ) ) {
					$photo = media_handle_upload( 'photo', 0 );
					if ( is_wp_error( $photo ) ) {
	  					throw new Exception( __( $photo->get_error_message(), WL_IMP_DOMAIN ) );
					}
					$data['photo_id'] = $photo;
				} else {
					$data['photo_id'] = $photo_in_db;
				}

				if( ! empty( $signature ) ) {
					$signature = media_handle_upload( 'signature', 0 );
					if ( is_wp_error( $signature ) ) {
	  					throw new Exception( __( $signature->get_error_message(), WL_IMP_DOMAIN ) );
					}
					$data['signature_id'] = $signature;
				} else {
					$data['signature_id'] = $signature_in_db;
				}

				if ( $allow_login ) {
					/* Student login data */
					$login_data = array(
						'first_name' => $first_name,
						'last_name'  => $last_name,
					    'user_login' => $username,
					    'user_pass'  => $password
					);

					$user_id = wp_insert_user( $login_data );
					if ( is_wp_error( $user_id ) ) {
						wp_send_json_error( __( $user_id->get_error_message(), WL_IMP_DOMAIN ) );
					}

					$user = new WP_User( $user_id );
					$user->add_cap( WL_IMP_Helper::get_student_capability() );

					if ( $user_id ) {
						$data['user_id']     = $user_id;
						$data['allow_login'] = $allow_login;
					}
				}

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_students", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}
				$student_id = $wpdb->insert_id;

				if ( $fees_paid > 0 ) {
					$data = array(
						'amount'     => $fees_paid,
						'student_id' => $student_id,
					    'added_by'   => get_current_user_id()
					);

					$success = $wpdb->insert( "{$wpdb->prefix}wl_im_installments", $data );
					if ( ! $success ) {
			  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
					}
				}

				if ( $valid_enquiry_action ) {
					if ( $enquiry_action == WL_IMP_Helper::get_enquiry_action_data()[1] ) {
						$success = $wpdb->update( "{$wpdb->prefix}wl_im_enquiries",
							array(
								'is_active' => 0,
								'updated_at' => date('Y-m-d H:i:s')
							), array( 'is_deleted' => 0, 'id' => $enquiry )
						);
					} else {
						$success = $wpdb->update( "{$wpdb->prefix}wl_im_enquiries",
							array(
								'is_deleted' => 1,
								'deleted_at' => date('Y-m-d H:i:s')
							), array( 'is_deleted' => 0, 'id' => $enquiry )
						);
					}

					if ( ! $success ) {
			  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
					}
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

				wp_send_json_success( array( 'message' => __( 'Student added successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Fetch student to update */
	public static function fetch_student() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}
		$wlim_active_courses = WL_IMP_Helper::get_active_courses();
		$batches = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND is_active = 1 AND course_id = $row->course_id ORDER BY id DESC" );
		$pending_fees        = number_format( $row->fees_payable - $row->fees_paid, 2, '.', '' );

		$username = '';
		if ( $row->user_id ) {
			$user     = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}users WHERE ID = $row->user_id" );
			$username = $user ? $user->user_login : '';
		}

		$nonce = wp_create_nonce( "update-student-$id" ); ?>
	    <input type="hidden" name="update-student-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
	    <input type="hidden" name="action" value="wl-im-update-student">
		<div class="row" id="wlim-student-enrollment_id">
			<div class="col">
				<label  class="col-form-label pb-0"><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?>:</label>
				<div class="card mb-3 mt-2">
					<div class="card-block">
	    				<span class="text-dark"><?php echo WL_IMP_Helper::get_enrollment_id( $row->id ); ?></span>
	  				</div>
				</div>
			</div>
		</div>
		<div class="form-group">
            <label for="wlim-student-course_update" class="col-form-label">* <?php _e( "Admission For", WL_IMP_DOMAIN ); ?>:</label>
            <select name="course" class="form-control selectpicker" id="wlim-student-course_update" data-batch_id='<?php echo $row->batch_id; ?>'>
                <option value="">-------- <?php _e( "Select a Course", WL_IMP_DOMAIN ); ?> --------</option>
            <?php
            if ( count( $wlim_active_courses ) > 0 ) {
                foreach ( $wlim_active_courses as $active_course ) {  ?>
		        <option value="<?php echo $active_course->id; ?>">
		        	<?php echo "$active_course->course_name ($active_course->course_code) (" . __( "Fees", WL_IMP_DOMAIN ) . ": $active_course->fees)"; ?>
	        	</option>
            <?php
                }
            } ?>
            </select>
        </div>
        <?php
		if ( count( $batches ) > 0 ) { ?>
        	<div id="wlim-add-student-course-update-batches">
				<div class="form-group pt-3">
		            <label for="wlim-student-batch_update" class="col-form-label"><?php _e( "Batch", WL_IMP_DOMAIN ); ?>:</label>
		            <select name="batch" class="form-control selectpicker" id="wlim-student-batch_update">
		                <option value="">-------- <?php _e( "Select a Batch", WL_IMP_DOMAIN ); ?> --------</option>
		            <?php
		    			foreach ( $batches as $batch ) {  ?>
		                <option value="<?php echo $batch->id; ?>"><?php echo $batch->batch_code; ?></option>
			            <?php
			    		} ?>>
		            </select>
		        </div>
        	</div>
        <?php
        } ?>
        <div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-first_name_update" class="col-form-label">* <?php _e( 'First Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="first_name" type="text" class="form-control" id="wlim-student-first_name_update" placeholder="<?php _e( "First Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->first_name; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-last_name_update" class="col-form-label"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="last_name" type="text" class="form-control" id="wlim-student-last_name_update" placeholder="<?php _e( "Last Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->last_name; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="col-form-label">* <?php _e( 'Gender', WL_IMP_DOMAIN ); ?>:</label><br>
		    	<div class="row mt-2">
		    		<div class="col-sm-12">
						<label class="radio-inline mr-3"><input type="radio" name="gender" class="mr-2" value="male" id="wlim-student-male_update"><?php _e( 'Male', WL_IMP_DOMAIN ); ?></label>
		    			<label class="radio-inline"><input type="radio" name="gender" class="mr-2" value="female" id="wlim-student-female_update"><?php _e( 'Female', WL_IMP_DOMAIN ); ?></label>
	    			</div>
		    	</div>
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-date_of_birth_update" class="col-form-label">* <?php _e( 'Date of Birth', WL_IMP_DOMAIN ); ?>:</label>
				<input name="date_of_birth" type="text" class="form-control wlim-date_of_birth_update" id="wlim-student-date_of_birth_update" placeholder="<?php _e( "Date of Birth", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-father_name_update" class="col-form-label"><?php _e( 'Father Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="father_name" type="text" class="form-control" id="wlim-student-father_name_update" placeholder="<?php _e( "Father Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->father_name; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-mother_name_update" class="col-form-label"><?php _e( 'Mother Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="mother_name" type="text" class="form-control" id="wlim-student-mother_name_update" placeholder="<?php _e( "Mother Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->mother_name; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-address_update" class="col-form-label"><?php _e( 'Address', WL_IMP_DOMAIN ); ?>:</label>
				<textarea name="address" class="form-control" rows="4" id="wlim-student-address_update" placeholder="<?php _e( "Address", WL_IMP_DOMAIN ); ?>"><?php echo $row->address; ?></textarea>
			</div>
			<div class="col-sm-6 form-group">
				<div>
					<label for="wlim-student-city_update" class="col-form-label"><?php _e( 'City', WL_IMP_DOMAIN ); ?>:</label>
					<input name="city" type="text" class="form-control" id="wlim-student-city_update" placeholder="<?php _e( "City", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->city; ?>">
				</div>
				<div>
					<label for="wlim-student-zip_update" class="col-form-label"><?php _e( 'Zip Code', WL_IMP_DOMAIN ); ?>:</label>
					<input name="zip" type="text" class="form-control" id="wlim-student-zip_update" placeholder="<?php _e( "Zip Code", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->zip; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-state_update" class="col-form-label"><?php _e( 'State', WL_IMP_DOMAIN ); ?>:</label>
				<input name="state" type="text" class="form-control" id="wlim-student-state_update" placeholder="<?php _e( "State", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->state; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-nationality_update" class="col-form-label"><?php _e( 'Nationality', WL_IMP_DOMAIN ); ?>:</label>
				<input name="nationality" type="text" class="form-control" id="wlim-student-nationality_update" placeholder="<?php _e( "Nationality", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->nationality; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-phone_update" class="col-form-label">* <?php _e( 'Phone', WL_IMP_DOMAIN ); ?>:</label>
				<input name="phone" type="text" class="form-control" id="wlim-student-phone_update" placeholder="<?php _e( "Phone", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->phone; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-email_update" class="col-form-label"><?php _e( 'Email', WL_IMP_DOMAIN ); ?>:</label>
				<input name="email" type="text" class="form-control" id="wlim-student-email_update" placeholder="<?php _e( "Email", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->email; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-qualification_update" class="col-form-label"><?php _e( 'Qualification', WL_IMP_DOMAIN ); ?>:</label>
				<input name="qualification" type="text" class="form-control" id="wlim-student-qualification_update" placeholder="<?php _e( "Qualification", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->qualification; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-id_proof_update" class="col-form-label"><?php _e( 'ID Proof', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->id_proof ) ) { ?>
			    <a href="<?php echo wp_get_attachment_url( $row->id_proof ); ?>" target="_blank" class="btn btn-sm btn-outline-primary"><?php _e( 'View ID Proof', WL_IMP_DOMAIN ); ?></a>
				<input type="hidden" name="id_proof_in_db" value="<?php echo $row->id_proof; ?>">
				<?php } ?>
			    <input name="id_proof" type="file" id="wlim-student-id_proof_update">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-photo_update" class="col-form-label"><?php _e( 'Photo', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->photo_id ) ) { ?>
			    <img src="<?php echo wp_get_attachment_url( $row->photo_id ); ?>" class="img-responsive photo-signature">
				<input type="hidden" name="photo_in_db" value="<?php echo $row->photo_id; ?>">
				<?php } ?>
			    <input name="photo" type="file" id="wlim-student-photo_update">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-signature_update" class="col-form-label"><?php _e( 'Signature', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->signature_id ) ) { ?>
			    <img src="<?php echo wp_get_attachment_url( $row->signature_id ); ?>" class="img-responsive photo-signature">
				<input type="hidden" name="signature_in_db" value="<?php echo $row->signature_id; ?>">
				<?php } ?>
			    <input name="signature" type="file" id="wlim-student-signature_update">
			</div>
		</div>
		<div class="form-group">
			<label for="wlim-student-fees_payable_update" class="col-form-label"><?php _e( 'Fees Payable', WL_IMP_DOMAIN ); ?>:</label>
			<input name="fees_payable" type="number" class="form-control" id="wlim-student-fees_payable_update" min="0" placeholder="<?php _e( "Fees Payable", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->fees_payable; ?>">
		</div>
		<div class="row" id="wlim-student-fees_paid_update">
			<div class="col">
				<label  class="col-form-label pb-0"><?php _e( 'Fees Paid', WL_IMP_DOMAIN ); ?>:</label>
				<div class="card mb-3 mt-2">
					<div class="card-block">
	    				<span class="text-dark"><?php echo $row->fees_paid; ?></span>
	  				</div>
				</div>
			</div>
		</div>
		<div class="row" id="wlim-student-fees_status">
			<div class="col">
				<label  class="col-form-label pb-0"><?php _e( 'Fees Status', WL_IMP_DOMAIN ); ?>:</label>
				<div class="card mb-3 mt-2">
					<div class="card-block">
						<?php
						if ( $pending_fees > 0 ) { ?>
	    				<strong class="text-danger"><?php _e( 'Pending', WL_IMP_DOMAIN ); ?>: </strong></span>
	    				<strong><?php echo $pending_fees; ?></strong>
	    				<?php
	    				} else { ?>
	    				<span class="text-success"><strong><?php _e( 'Paid', WL_IMP_DOMAIN ); ?></strong></span>
	    				<?php
	    				} ?>
	  				</div>
				</div>
			</div>
		</div>
		<div class="form-check pl-0">
			<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlmp-student-is_active_update" <?php echo $row->is_active ? "checked" : ""; ?>>
			<label class="form-check-label" for="wlmp-student-is_active_update">
			<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
			</label>
		</div>
		<hr>
		<div class="form-check pl-0">
			<input name="allow_login" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-student-allow_login_update" <?php echo $row->allow_login ? "checked" : ""; ?>>
			<label class="form-check-label" for="wlim-student-allow_login_update">
			<strong class="text-primary"><?php _e( 'Allow Student to Login?', WL_IMP_DOMAIN ); ?></strong>
			</label>
		</div>
		<div class="wlim-allow-login-fields">
			<hr>
			<div class="form-group">
				<label for="wlim-student-username_update" class="col-form-label"><?php _e( 'Username', WL_IMP_DOMAIN ); ?>:
				<?php
				if ( $username ) { ?>
				&nbsp;<small class="text-secondary"><em><?php _e( "cannot be changed.", WL_IMP_DOMAIN ); ?></em></small>
				<?php
				} ?>
				</label>
				<input name="username" type="text" class="form-control" id="wlim-student-username_update" placeholder="<?php _e( "Username", WL_IMP_DOMAIN ); ?>" value="<?php echo $username; ?>"<?php echo $username ? "disabled" : ''; ?>>
			</div>
			<div class="form-group">
				<label for="wlim-student-password_update" class="col-form-label"><?php _e( 'Password', WL_IMP_DOMAIN ); ?>:</label>
				<input name="password" type="password" class="form-control" id="wlim-student-password_update" placeholder="<?php _e( "Password", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="form-group">
				<label for="wlim-student-password_confirm_update" class="col-form-label"><?php _e( 'Confirm Password', WL_IMP_DOMAIN ); ?>:</label>
				<input name="password_confirm" type="password" class="form-control" id="wlim-student-password_confirm_update" placeholder="<?php _e( "Confirm Password", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<hr>
		<div class="form-check pl-0">
			<input name="course_completed" class="position-static mt-0 form-check-input" type="checkbox" id="wlmp-student-course_completed_update" <?php echo $row->course_completed ? "checked" : ""; ?>>
			<label class="form-check-label text-success" for="wlmp-student-course_completed_update">
				<strong><?php _e( 'Mark course as completed?', WL_IMP_DOMAIN ); ?></strong>
			</label>
		</div>
		<input type="hidden" name="student_id" value="<?php echo $row->id; ?>">
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
		<?php 
		$wlim_date_selector = '.wlim-date_of_birth_update';
		require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_date_picker.php' ); ?>
		<script>
			// Select single option
			jQuery('#wlim-student-course_update').selectpicker({
				liveSearch: true
			});
			jQuery('#wlim-student-course_update').selectpicker('val', '<?php echo $row->course_id; ?>');

			// Select single option
			jQuery('#wlim-student-batch_update').selectpicker({
				liveSearch: true
			});
			jQuery('#wlim-student-batch_update').selectpicker('val', '<?php echo $row->batch_id; ?>');

			try {
				/* Select gender */
				jQuery("input[name=gender][value=<?php echo $row->gender; ?>]").prop('checked', true);
			} catch (e) {}

			/* Select date of birth */
			jQuery('<?php echo $wlim_date_selector; ?>').data("DateTimePicker").date(moment("<?php echo $row->date_of_birth; ?>"));

			/* Allow student to login checkbox */
			<?php
			if ( ! $row->allow_login ) { ?>
			jQuery('.wlim-allow-login-fields').hide();
			<?php
			} ?>
			jQuery(document).on('change', '#wlim-student-allow_login_update', function() {
				if ( this.checked ) {
					jQuery('.wlim-allow-login-fields').fadeIn();
				} else {
					jQuery('.wlim-allow-login-fields').fadeOut();
				}
			});
		</script>
	<?php
		die();
	}

	/* Update student */
	public static function update_student() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['student_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-student-$id"], "update-student-$id" ) ) {
			die();
		}
		global $wpdb;

		$course_id        = isset( $_POST['course'] ) ? intval( sanitize_text_field( $_POST['course'] ) ) : NULL;
		$batch_id         = isset( $_POST['batch'] ) ? intval( sanitize_text_field( $_POST['batch'] ) ) : NULL;
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
		$fees_payable     = number_format( isset( $_POST['fees_payable'] ) ? max( floatval( sanitize_text_field( $_POST['fees_payable'] ) ), 0 ) : 0, 2, '.', '' );
		$is_active        = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;
		$course_completed = isset( $_POST['course_completed'] ) ? boolval( sanitize_text_field( $_POST['course_completed'] ) ) : 0;
		$completion_date  = $course_completed ? date('Y-m-d H:i:s') : NULL;

		$allow_login      = isset( $_POST['allow_login'] ) ? boolval( sanitize_text_field( $_POST['allow_login'] ) ) : 0;
		$username         = isset( $_POST['username'] ) ? sanitize_text_field( $_POST['username'] ) : '';
		$password         = isset( $_POST['password'] ) ? $_POST['password'] : '';
		$password_confirm = isset( $_POST['password_confirm'] ) ? $_POST['password_confirm'] : '';

		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}

		$user = NULL;
		if ( $row->user_id ) {
			$user = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}users WHERE ID = $row->user_id" );
		}

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

		if ( $allow_login ) {
			if ( $user ) {
				if ( ! empty( $password ) && ( $password !== $password_confirm ) ) {
					$errors['password_confirm'] = __( 'Please confirm password.', WL_IMP_DOMAIN );
				}
			} else {
				if ( empty( $username ) ) {
					$errors['username'] = __( 'Please provide username.', WL_IMP_DOMAIN );
				}

				if ( empty( $password_confirm ) ) {
					$errors['password_confirm'] = __( 'Please confirm password.', WL_IMP_DOMAIN );
				}

				if ( $password !== $password_confirm ) {
					$errors['password'] = __( 'Passwords do not match.', WL_IMP_DOMAIN );
				}
			}
		}

		if ( ! in_array( $gender, WL_IMP_Helper::get_gender_data() ) ) {
			wp_send_json_error( __( 'Please select valid gender.', WL_IMP_DOMAIN ) );
		}

		if( ! empty( $date_of_birth ) && ( strtotime( date('Y') - 2 ) <= strtotime( $date_of_birth ) ) ) {
			$errors['date_of_birth'] = __( 'Please provide valid date of birth.', WL_IMP_DOMAIN );
		}

		if ( empty( $date_of_birth ) ) {
			$errors['date_of_birth'] = __( 'Please provide date of birth.', WL_IMP_DOMAIN );
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

		if ( $course_completed ) {
			$pending_fees = number_format( $row->fees_payable - $row->fees_paid, 2, '.', '' );
			if ( $pending_fees > 0 ) {
				$errors['fees_payable'] = __( 'Pending Fees.', WL_IMP_DOMAIN );
			}
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 AND id = $course_id" );

		if ( ! $count ) {
			$errors['course'] = __( 'Please select a valid course.', WL_IMP_DOMAIN );
		}

		if ( ! empty( $batch_id ) ) {
			$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND is_active = 1 AND id = $batch_id AND course_id = $course_id" );

			if ( ! $count ) {
				$errors['batch'] = __( 'Please select a valid batch.', WL_IMP_DOMAIN );
			}
		} else {
			$batch_id = NULL;
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				$data = array(
					'course_id'        => $course_id,
					'batch_id'         => $batch_id,
					'first_name'       => $first_name,
				    'last_name'        => $last_name,
					'gender'           => $gender,
					'date_of_birth'    => $date_of_birth,
					'father_name'      => $father_name,
					'mother_name'      => $mother_name,
					'address'          => $address,
					'city'             => $city,
					'zip'              => $zip,
				    'state'            => $state,
				    'nationality'      => $nationality,
				    'phone'            => $phone,
				    'qualification'    => $qualification,
				    'email'            => $email,
				    'fees_payable'     => $fees_payable,
				    'course_completed' => $course_completed,
				    'completion_date'  => $completion_date,
				    'is_active'        => $is_active,
				    'updated_at'       => date('Y-m-d H:i:s')
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

				$reload = false;
				if ( $allow_login ) {
					if ( $user ) {
						/* Student login data */
						$login_data = array(
							'ID'         => $user->ID,
							'first_name' => $first_name,
							'last_name'  => $last_name
						);

						if ( ! empty( $password ) ) {
							$login_data['user_pass'] = $password;
							if( get_current_user_id() == $id ) {
								$reload = true;
							}
						}

						$user_id = wp_update_user( $login_data );
						if ( is_wp_error( $user_id ) ) {
							wp_send_json_error( __( $user_id->get_error_message(), WL_IMP_DOMAIN ) );
						}
					} else {
						/* Student login data */
						$login_data = array(
							'first_name' => $first_name,
							'last_name'  => $last_name,
						    'user_login' => $username,
						    'user_pass'  => $password
						);

						$user_id = wp_insert_user( $login_data );
						if ( is_wp_error( $user_id ) ) {
							wp_send_json_error( __( $user_id->get_error_message(), WL_IMP_DOMAIN ) );
						}

						$user = new WP_User( $user_id );
						$user->add_cap( WL_IMP_Helper::get_student_capability() );

						if ( $user_id ) {
							$data['user_id']     = $user_id;
							$data['allow_login'] = $allow_login;
						}
					}
				}

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_students", $data, array( 'is_deleted' => 0, 'id' => $id ) );
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

				wp_send_json_success( array( 'message' => __( 'Student updated successfully.', WL_IMP_DOMAIN ), 'reload' => $reload ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Delete student */
	public static function delete_student() {
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-student-$id"], "delete-student-$id" ) ) {
			die();
		}
		global $wpdb;

		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}

		$user = NULL;
		if ( $row->user_id ) {
			$user = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}users WHERE ID = $row->user_id" );
			if( $user ) {
				$user = new WP_User( $user->ID );
			}
		}

		try {
			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_students",
					array(
						'user_id'     => NULL,
						'allow_login' => false,
						'is_deleted'  => 1,
						'deleted_at'  => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'id' => $id )
				);
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			if ( $user ) {
				$user->remove_cap( WL_IMP_Helper::get_student_capability() );
				$user_deleted = wp_delete_user( $user->ID );
				if ( ! $user_deleted ) {
	  				throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}
			}

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_results",
					array(
						'is_deleted'  => 1,
						'deleted_at'  => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'student_id' => $id )
				);

			$wpdb->query( 'COMMIT;' );
			wp_send_json_success( array( 'message' => __( 'Student removed successfully.', WL_IMP_DOMAIN ) ) );
		} catch ( Exception $exception ) {
	  		$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error( __( $exception->getMessage(), WL_IMP_DOMAIN ) );
		}
	}

	/* Fetch course batches */
	public static function fetch_course_batches() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$course_id = intval( sanitize_text_field( $_POST['id'] ) );
		$row       = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND id = $course_id" );

		if ( ! $row ) {
			die();
		}

		$batches = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND is_active = 1 AND course_id = $course_id ORDER BY id DESC" );
		if ( count( $batches ) > 0 ) {
		?>
		<div class="form-group pt-3">
            <label for="wlim-student-batch" class="col-form-label"><?php _e( "Batch", WL_IMP_DOMAIN ); ?>:</label>
            <select name="batch" class="form-control selectpicker" id="wlim-student-batch">
                <option value="">-------- <?php _e( "Select a Batch", WL_IMP_DOMAIN ); ?> --------</option>
            <?php
    			foreach ( $batches as $batch ) {  ?>
                <option value="<?php echo $batch->id; ?>"><?php echo $batch->batch_code; ?></option>
	            <?php
	    		} ?>>
            </select>
        </div>
		<script>
			/* Select single option */
			jQuery('#wlim-student-batch').selectpicker({
				liveSearch: true
			});
		</script>
		<?php
        } else { ?>
			<div class="text-danger pt-3 pb-3 border-bottom"><?php _e( "Batches not found.", WL_IMP_DOMAIN ); ?></div>
        <?php
    	}
    	die();
	}

	/* Fetch course update batches */
	public static function fetch_course_update_batches() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$course_id = intval( sanitize_text_field( $_POST['id'] ) );
		$batch_id  = intval( sanitize_text_field( $_POST['batch_id'] ) );
		$row       = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND id = $course_id" );

		if ( ! $row ) {
			die();
		}

		$batches = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND is_active = 1 AND course_id = $course_id ORDER BY id DESC" );
		if ( count( $batches ) > 0 ) {
		?>
		<div class="form-group pt-3">
            <label for="wlim-student-batch_update" class="col-form-label"><?php _e( "Batch", WL_IMP_DOMAIN ); ?>:</label>
            <select name="batch" class="form-control selectpicker" id="wlim-student-batch_update">
                <option value="">-------- <?php _e( "Select a Batch", WL_IMP_DOMAIN ); ?> --------</option>
            <?php
    			foreach ( $batches as $batch ) {  ?>
                <option value="<?php echo $batch->id; ?>"><?php echo $batch->batch_code; ?></option>
	            <?php
	    		} ?>>
            </select>
        </div>
		<script>
			/* Select single option */
			jQuery('#wlim-student-batch_update').selectpicker({
				liveSearch: true
			});
			<?php
			if ( $batch_id ) { ?>
			jQuery('#wlim-student-batch_update').selectpicker('val', '<?php echo $batch_id; ?>');
			<?php
			} ?>
		</script>
		<?php
        } else { ?>
			<div class="text-danger pt-3 pb-3 border-bottom"><?php _e( "Batches not found.", WL_IMP_DOMAIN ); ?></div>
        <?php
    	}
    	die();
	}

	/* Fetch enquiries */
	public static function fetch_enquiries() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$enquiries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_enquiries WHERE is_deleted = 0 AND is_active = 1 ORDER BY id DESC" );
		if ( count( $enquiries ) > 0 ) {
		?>
		<div class="form-group pt-3">
            <label for="wlim-student-enquiry" class="col-form-label"><?php _e( "Enquiry", WL_IMP_DOMAIN ); ?>:</label>
            <select name="enquiry" class="form-control selectpicker" id="wlim-student-enquiry">
                <option value="">-------- <?php _e( "Select an Enquiry", WL_IMP_DOMAIN ); ?> --------</option>
            <?php
    			foreach ( $enquiries as $enquiry ) {  ?>
                <option value="<?php echo $enquiry->id; ?>"><?php echo "$enquiry->first_name $enquiry->last_name (" . WL_IMP_Helper::get_enquiry_id( $enquiry->id ) . ")"; ?></option>
	            <?php
	    		} ?>>
            </select>
        </div>
		<script>
			/* Select single option */
			jQuery('#wlim-student-enquiry').selectpicker({
				liveSearch: true
			});
		</script>
		<?php
        } else { ?>
			<div class="text-danger pt-3 pb-3 border-bottom"><?php _e( "Enquiries not found.", WL_IMP_DOMAIN ); ?></div>
        <?php
    	}
    	die();
	}

	/* Fetch enquiry */
	public static function fetch_enquiry() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_enquiries WHERE is_deleted = 0 AND id = $id" );
		$wlim_active_courses = WL_IMP_Helper::get_active_courses();

		if ( $row ) {
		?>
		<div class="form-group">
            <label for="wlim-student-course" class="col-form-label">* <?php _e( "Admission For", WL_IMP_DOMAIN ); ?>:</label>
            <select name="course" class="form-control selectpicker" id="wlim-student-course">
                <option value="">-------- <?php _e( "Select a Course", WL_IMP_DOMAIN ); ?> --------</option>
            <?php
            if ( count( $wlim_active_courses ) > 0 ) {
                foreach ( $wlim_active_courses as $active_course ) {  ?>
		        <option value="<?php echo $active_course->id; ?>">
		        	<?php echo "$active_course->course_name ($active_course->course_code) (" . __( "Fees", WL_IMP_DOMAIN ) . ": $active_course->fees)"; ?>
	        	</option>
            <?php
                }
            } ?>
            </select>
        </div>
        <div id="wlim-add-student-course-batches"></div>
        <div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-first_name" class="col-form-label">* <?php _e( 'First Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="first_name" type="text" class="form-control" id="wlim-student-first_name" placeholder="<?php _e( "First Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->first_name; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-last_name" class="col-form-label"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="last_name" type="text" class="form-control" id="wlim-student-last_name" placeholder="<?php _e( "Last Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->last_name; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="col-form-label">* <?php _e( 'Gender', WL_IMP_DOMAIN ); ?>:</label><br>
		    	<div class="row mt-2">
		    		<div class="col-sm-12">
						<label class="radio-inline mr-3"><input type="radio" name="gender" class="mr-2" value="male" id="wlim-student-male"><?php _e( 'Male', WL_IMP_DOMAIN ); ?></label>
		    			<label class="radio-inline"><input type="radio" name="gender" class="mr-2" value="female" id="wlim-student-female"><?php _e( 'Female', WL_IMP_DOMAIN ); ?></label>
	    			</div>
		    	</div>
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-date_of_birth" class="col-form-label">* <?php _e( 'Date of Birth', WL_IMP_DOMAIN ); ?>:</label>
				<input name="date_of_birth" type="text" class="form-control wlim-date_of_birth" id="wlim-student-date_of_birth" placeholder="<?php _e( "Date of Birth", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-father_name" class="col-form-label"><?php _e( 'Father Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="father_name" type="text" class="form-control" id="wlim-student-father_name" placeholder="<?php _e( "Father Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->father_name; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-mother_name" class="col-form-label"><?php _e( 'Mother Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="mother_name" type="text" class="form-control" id="wlim-student-mother_name" placeholder="<?php _e( "Mother Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->mother_name; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-address" class="col-form-label"><?php _e( 'Address', WL_IMP_DOMAIN ); ?>:</label>
				<textarea name="address" class="form-control" rows="4" id="wlim-student-address" placeholder="<?php _e( "Address", WL_IMP_DOMAIN ); ?>"><?php echo $row->address; ?></textarea>
			</div>
			<div class="col-sm-6 form-group">
				<div>
					<label for="wlim-student-city" class="col-form-label"><?php _e( 'City', WL_IMP_DOMAIN ); ?>:</label>
					<input name="city" type="text" class="form-control" id="wlim-student-city" placeholder="<?php _e( "City", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->city; ?>">
				</div>
				<div>
					<label for="wlim-student-zip" class="col-form-label"><?php _e( 'Zip Code', WL_IMP_DOMAIN ); ?>:</label>
					<input name="zip" type="text" class="form-control" id="wlim-student-zip" placeholder="<?php _e( "Zip Code", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->zip; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-state" class="col-form-label"><?php _e( 'State', WL_IMP_DOMAIN ); ?>:</label>
				<input name="state" type="text" class="form-control" id="wlim-student-state" placeholder="<?php _e( "State", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->state; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-nationality" class="col-form-label"><?php _e( 'Nationality', WL_IMP_DOMAIN ); ?>:</label>
				<input name="nationality" type="text" class="form-control" id="wlim-student-nationality" placeholder="<?php _e( "Nationality", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->nationality; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-phone" class="col-form-label">* <?php _e( 'Phone', WL_IMP_DOMAIN ); ?>:</label>
				<input name="phone" type="text" class="form-control" id="wlim-student-phone" placeholder="<?php _e( "Phone", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->phone; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-email" class="col-form-label"><?php _e( 'Email', WL_IMP_DOMAIN ); ?>:</label>
				<input name="email" type="text" class="form-control" id="wlim-student-email" placeholder="<?php _e( "Email", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->email; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-qualification" class="col-form-label"><?php _e( 'Qualification', WL_IMP_DOMAIN ); ?>:</label>
				<input name="qualification" type="text" class="form-control" id="wlim-student-qualification" placeholder="<?php _e( "Qualification", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->qualification; ?>">
			</div>
			<div class="col-sm-6 form-group">
				<input type="hidden" name="id_proof_in_db" value="<?php echo $row->id_proof; ?>">
				<label for="wlim-student-id_proof" class="col-form-label"><?php _e( 'ID Proof', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->id_proof ) ) { ?>
			    <a href="<?php echo wp_get_attachment_url( $row->id_proof ); ?>" target="_blank" class="btn btn-sm btn-outline-primary"><?php _e( 'View ID Proof', WL_IMP_DOMAIN ); ?></a>
				<input type="hidden" name="id_proof_in_db" value="<?php echo $row->id_proof; ?>">
				<?php } ?>
			    <input name="id_proof" type="file" id="wlim-student-id_proof">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-photo" class="col-form-label"><?php _e( 'Photo', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->photo_id ) ) { ?>
			    <img src="<?php echo wp_get_attachment_url( $row->photo_id ); ?>" class="img-responsive photo-signature">
				<input type="hidden" name="photo_in_db" value="<?php echo $row->photo_id; ?>">
				<?php } ?>
			    <input name="photo" type="file" id="wlim-student-photo">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-signature" class="col-form-label"><?php _e( 'Signature', WL_IMP_DOMAIN ); ?>:</label><br>
			    <?php if( ! empty ( $row->signature_id ) ) { ?>
			    <img src="<?php echo wp_get_attachment_url( $row->signature_id ); ?>" class="img-responsive photo-signature">
				<input type="hidden" name="signature_in_db" value="<?php echo $row->signature_id; ?>">
				<?php } ?>
			    <input name="signature" type="file" id="wlim-student-signature">
			</div>
		</div>
		<?php if( ! empty( $row->message ) ) { ?>
		<div class="row" id="wlim-student-message">
			<div class="col">
				<label  class="col-form-label pb-0"><?php _e( 'Message', WL_IMP_DOMAIN ); ?>:</label>
				<div class="card mb-3 mt-2">
					<div class="card-block">
	    				<span class="text-secondary"><?php echo $row->message; ?></span>
	  				</div>
				</div>
			</div>
		</div>
		<?php
		} ?>
		<div id="wlim-add-student-fetch-fees-payable">
			<div class="form-group">
				<label for="wlim-student-fees_payable" class="col-form-label"><?php _e( 'Fees Payable', WL_IMP_DOMAIN ); ?>:</label>
				<input name="fees_payable" type="number" class="form-control" id="wlim-student-fees_payable" min="0" placeholder="<?php _e( "Fees Payable", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="wlim-student-fees_paid" class="col-form-label"><?php _e( 'Fees Paid', WL_IMP_DOMAIN ); ?>:</label>
			<input name="fees_paid" type="number" class="form-control" id="wlim-student-fees_paid" min="0" placeholder="<?php _e( "Fees Paid", WL_IMP_DOMAIN ); ?>">
		</div>
		<div class="form-check pl-0">
			<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-student-is_active" checked>
			<label class="form-check-label" for="wlim-student-is_active">
			<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
			</label>
		</div>
		<hr>
		<div class="form-check pl-0">
			<input name="allow_login" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-student-allow_login" checked>
			<label class="form-check-label" for="wlim-student-allow_login">
			<strong class="text-primary"><?php _e( 'Allow Student to Login?', WL_IMP_DOMAIN ); ?></strong>
			</label>
		</div>
		<div class="wlim-allow-login-fields">
			<hr>
			<div class="form-group">
				<label for="wlim-student-username" class="col-form-label"><?php _e( 'Username', WL_IMP_DOMAIN ); ?>:</label>
				<input name="username" type="text" class="form-control" id="wlim-student-username" placeholder="<?php _e( "Username", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="form-group">
				<label for="wlim-student-password" class="col-form-label"><?php _e( 'Password', WL_IMP_DOMAIN ); ?>:</label>
				<input name="password" type="password" class="form-control" id="wlim-student-password" placeholder="<?php _e( "Password", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="form-group">
				<label for="wlim-student-password_confirm" class="col-form-label"><?php _e( 'Confirm Password', WL_IMP_DOMAIN ); ?>:</label>
				<input name="password_confirm" type="password" class="form-control" id="wlim-student-password_confirm" placeholder="<?php _e( "Confirm Password", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
	    <div class="form-group mt-3 pl-0 pt-3 border-top enquiry_action">
	    	<label><?php _e( 'After Adding Student', WL_IMP_DOMAIN ); ?>:</label><br>
	    	<div class="row">
		    	<div class="col">
					<label class="radio-inline"><input checked type="radio" name="enquiry_action" value="mark_enquiry_inactive" id="wlim-student-mark_enquiry_inactive"><?php _e( 'Mark Enquiry As Inactive', WL_IMP_DOMAIN ); ?></label>
				</div>
		    	<div class="col">
		    		<label class="radio-inline"><input type="radio" name="enquiry_action" value="delete_enquiry" id="wlim-student-delete_enquiry"><?php _e( 'Delete Enquiry', WL_IMP_DOMAIN ); ?></label>
		    	</div>
	    	</div>
		</div>
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
		<?php 
		$wlim_date_selector = '.wlim-date_of_birth';
		require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_date_picker.php' ); ?>
		<script>
			/* Select single option */
			jQuery('#wlim-student-course').selectpicker({
				liveSearch: true
			});
			jQuery('#wlim-student-course').selectpicker('val', '<?php echo $row->course_id; ?>');

			/* Select single option */
			jQuery('#wlim-student-batch').selectpicker({
				liveSearch: true
			});

			/* Select gender */
			jQuery("input[name=gender][value=<?php echo $row->gender; ?>]").prop('checked', true);

			/* Select date of birth */
			jQuery('<?php echo $wlim_date_selector; ?>').data("DateTimePicker").date(moment("<?php echo $row->date_of_birth; ?>"));

			/* Allow student to login checkbox */
			jQuery(document).on('change', '#wlim-student-allow_login', function() {
				if ( this.checked ) {
					jQuery('.wlim-allow-login-fields').fadeIn();
				} else {
					jQuery('.wlim-allow-login-fields').fadeOut();
				}
			});
		</script>
		<?php
        } else {
        	self::render_add_student_form( $wlim_active_courses );
        }
		die();
	}

	/* Fetch student fees payable */
	public static function fetch_fees_payable() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT fees FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 AND id = $id" );

		if ( $row ) {
		?>
		<div class="form-group">
			<label for="wlim-student-fees_payable" class="col-form-label"><?php _e( 'Fees Payable', WL_IMP_DOMAIN ); ?>:</label>
			<input name="fees_payable" type="number" class="form-control" id="wlim-student-fees_payable" min="0" placeholder="<?php _e( "Fees Payable", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->fees; ?>">
		</div>
		<?php
        } else { ?>
		<div class="form-group">
			<label for="wlim-student-fees_payable" class="col-form-label"><?php _e( 'Fees Payable', WL_IMP_DOMAIN ); ?>:</label>
			<input name="fees_payable" type="number" class="form-control" id="wlim-student-fees_payable" min="0" placeholder="<?php _e( "Fees Payable", WL_IMP_DOMAIN ); ?>">
		</div>
		<?php
        }
		die();
	}

	/* Get student registration form */
	public static function add_student_form() {
		$wlim_active_courses = WL_IMP_Helper::get_active_courses();
		self::render_add_student_form( $wlim_active_courses );
		die();
	}

	/* Render student registration form */
	public static function render_add_student_form($wlim_active_courses = []) {
	?>
		<div class="form-group wlim-selectpicker">
            <label for="wlim-student-course" class="col-form-label">* <?php _e( "Admission For", WL_IMP_DOMAIN ); ?>:</label>
            <select name="course" class="form-control selectpicker" id="wlim-student-course">
                <option value="">-------- <?php _e( "Select a Course", WL_IMP_DOMAIN ); ?> --------</option>
            <?php
            if ( count( $wlim_active_courses ) > 0 ) {
                foreach ( $wlim_active_courses as $active_course ) {  ?>
		        <option value="<?php echo $active_course->id; ?>">
		        	<?php echo "$active_course->course_name ($active_course->course_code) (" . __( "Fees", WL_IMP_DOMAIN ) . ": $active_course->fees)"; ?>
	        	</option>
            <?php
                }
            } ?>
            </select>
        </div>
        <div id="wlim-add-student-course-batches"></div>
        <div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-first_name" class="col-form-label">* <?php _e( 'First Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="first_name" type="text" class="form-control" id="wlim-student-first_name" placeholder="<?php _e( "First Name", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-last_name" class="col-form-label"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="last_name" type="text" class="form-control" id="wlim-student-last_name" placeholder="<?php _e( "Last Name", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="col-form-label">* <?php _e( 'Gender', WL_IMP_DOMAIN ); ?>:</label><br>
		    	<div class="row mt-2">
		    		<div class="col-sm-12">
						<label class="radio-inline mr-3"><input checked type="radio" name="gender" class="mr-2" value="male" id="wlim-student-male"><?php _e( 'Male', WL_IMP_DOMAIN ); ?></label>
		    			<label class="radio-inline"><input type="radio" name="gender" class="mr-2" value="female" id="wlim-student-female"><?php _e( 'Female', WL_IMP_DOMAIN ); ?></label>
	    			</div>
		    	</div>
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-date_of_birth" class="col-form-label">* <?php _e( 'Date of Birth', WL_IMP_DOMAIN ); ?>:</label>
				<input name="date_of_birth" type="text" class="form-control wlim-date_of_birth" id="wlim-student-date_of_birth" placeholder="<?php _e( "Date of Birth", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>	
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-father_name" class="col-form-label"><?php _e( 'Father Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="father_name" type="text" class="form-control" id="wlim-student-father_name" placeholder="<?php _e( "Father Name", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-mother_name" class="col-form-label"><?php _e( 'Mother Name', WL_IMP_DOMAIN ); ?>:</label>
				<input name="mother_name" type="text" class="form-control" id="wlim-student-mother_name" placeholder="<?php _e( "Mother Name", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-address" class="col-form-label"><?php _e( 'Address', WL_IMP_DOMAIN ); ?>:</label>
				<textarea name="address" class="form-control" rows="4" id="wlim-student-address" placeholder="<?php _e( "Address", WL_IMP_DOMAIN ); ?>"></textarea>
			</div>
			<div class="col-sm-6 form-group">
				<div>
					<label for="wlim-student-city" class="col-form-label"><?php _e( 'City', WL_IMP_DOMAIN ); ?>:</label>
					<input name="city" type="text" class="form-control" id="wlim-student-city" placeholder="<?php _e( "City", WL_IMP_DOMAIN ); ?>">
				</div>
				<div>
					<label for="wlim-student-zip" class="col-form-label"><?php _e( 'Zip Code', WL_IMP_DOMAIN ); ?>:</label>
					<input name="zip" type="text" class="form-control" id="wlim-student-zip" placeholder="<?php _e( "Zip Code", WL_IMP_DOMAIN ); ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-state" class="col-form-label"><?php _e( 'State', WL_IMP_DOMAIN ); ?>:</label>
				<input name="state" type="text" class="form-control" id="wlim-student-state" placeholder="<?php _e( "State", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-nationality" class="col-form-label"><?php _e( 'Nationality', WL_IMP_DOMAIN ); ?>:</label>
				<input name="nationality" type="text" class="form-control" id="wlim-student-nationality" placeholder="<?php _e( "Nationality", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-phone" class="col-form-label">* <?php _e( 'Phone', WL_IMP_DOMAIN ); ?>:</label>
				<input name="phone" type="text" class="form-control" id="wlim-student-phone" placeholder="<?php _e( "Phone", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-email" class="col-form-label"><?php _e( 'Email', WL_IMP_DOMAIN ); ?>:</label>
				<input name="email" type="text" class="form-control" id="wlim-student-email" placeholder="<?php _e( "Email", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-qualification" class="col-form-label"><?php _e( 'Qualification', WL_IMP_DOMAIN ); ?>:</label>
				<input name="qualification" type="text" class="form-control" id="wlim-student-qualification" placeholder="<?php _e( "Qualification", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-id_proof" class="col-form-label"><?php _e( 'ID Proof', WL_IMP_DOMAIN ); ?>:</label><br>
			    <input name="id_proof" type="file" id="wlim-student-id_proof">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="wlim-student-photo" class="col-form-label"><?php _e( 'Choose Photo', WL_IMP_DOMAIN ); ?>:</label><br>
			    <input name="photo" type="file" id="wlim-student-photo">
			</div>
			<div class="col-sm-6 form-group">
				<label for="wlim-student-signature" class="col-form-label"><?php _e( 'Choose Signature', WL_IMP_DOMAIN ); ?>:</label><br>
			    <input name="signature" type="file" id="wlim-student-signature">
			</div>
		</div>
		<div id="wlim-add-student-fetch-fees-payable">
			<div class="form-group">
				<label for="wlim-student-fees_payable" class="col-form-label"><?php _e( 'Fees Payable', WL_IMP_DOMAIN ); ?>:</label>
				<input name="fees_payable" type="number" class="form-control" id="wlim-student-fees_payable" min="0" placeholder="<?php _e( "Fees Payable", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="wlim-student-fees_paid" class="col-form-label"><?php _e( 'Fees Paid', WL_IMP_DOMAIN ); ?>:</label>
			<input name="fees_paid" type="number" class="form-control" id="wlim-student-fees_paid" min="0" placeholder="<?php _e( "Fees Paid", WL_IMP_DOMAIN ); ?>">
		</div>
		<div class="form-check pl-0">
			<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-student-is_active" checked>
			<label class="form-check-label" for="wlim-student-is_active">
			<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
			</label>
		</div>
		<hr>
		<div class="form-check pl-0">
			<input name="allow_login" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-student-allow_login" checked>
			<label class="form-check-label" for="wlim-student-allow_login">
			<strong class="text-primary"><?php _e( 'Allow Student to Login?', WL_IMP_DOMAIN ); ?></strong>
			</label>
		</div>
		<div class="wlim-allow-login-fields">
			<hr>
			<div class="form-group">
				<label for="wlim-student-username" class="col-form-label"><?php _e( 'Username', WL_IMP_DOMAIN ); ?>:</label>
				<input name="username" type="text" class="form-control" id="wlim-student-username" placeholder="<?php _e( "Username", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="form-group">
				<label for="wlim-student-password" class="col-form-label"><?php _e( 'Password', WL_IMP_DOMAIN ); ?>:</label>
				<input name="password" type="password" class="form-control" id="wlim-student-password" placeholder="<?php _e( "Password", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="form-group">
				<label for="wlim-student-password_confirm" class="col-form-label"><?php _e( 'Confirm Password', WL_IMP_DOMAIN ); ?>:</label>
				<input name="password_confirm" type="password" class="form-control" id="wlim-student-password_confirm" placeholder="<?php _e( "Confirm Password", WL_IMP_DOMAIN ); ?>">
			</div>
		</div>
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
		<?php 
		$wlim_date_selector = '.wlim-date_of_birth';
		require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_date_picker.php' ); ?>
		<script>
			/* Select single option */
			try {
				jQuery('.selectpicker').selectpicker({
					liveSearch: true
				});
			} catch (error) {
			}
			/* Allow student to login checkbox */
			jQuery(document).on('change', '#wlim-student-allow_login', function() {
				if ( this.checked ) {
					jQuery('.wlim-allow-login-fields').fadeIn();
				} else {
					jQuery('.wlim-allow-login-fields').fadeOut();
				}
			});
		</script>
	<?php
	}

	/* Check permission to manage student */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_students' ) ) {
			die();
		}
	}
}