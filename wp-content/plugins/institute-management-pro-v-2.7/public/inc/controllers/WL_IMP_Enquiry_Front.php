<?php
defined( 'ABSPATH' ) or die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Enquiry_Front {
	/* Add new enquiry */
	public static function add_enquiry() {		
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
				$errors['id_proof'] = __( 'Please provide Aadhaar ID in PDF, JPG, JPEG or PNG format.', WL_IMP_DOMAIN );
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
			$errors['course'] = __( 'Please select a valid course', WL_IMP_DOMAIN );
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
				    'is_active'     => 1
				);

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_enquiries", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

		  		$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Your enquiry has been received. Thank you.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}
}
?>