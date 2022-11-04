<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Notification {
	/* Notification Configure */
	public static function notification_configure() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}

		$notification_by = isset( $_REQUEST['notification_by'] ) ? sanitize_text_field( $_REQUEST['notification_by'] ) : '';

		if ( ! in_array( $notification_by, array_keys( WL_IMP_Helper::get_notification_by_list() ) ) ) { ?>
		<strong class="text-danger">
		<?php
			_e( 'Please select valid option.', WL_IMP_DOMAIN ); ?>
		</strong>
		<?php
			die();
		}

		global $wpdb;

		if ( $notification_by == 'by-batch' ) {
			/* Get batches */
			$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 ORDER BY id DESC" );
			$course_data = $wpdb->get_results( "SELECT id, course_name, course_code FROM {$wpdb->prefix}wl_im_courses ORDER BY course_name", OBJECT_K );
			if ( count( $data ) !== 0 ) { ?>
                <input type="hidden" name="notification_for" value="batch">
	            <div class="form-group wlim-selectpicker">
	                <label for="wlim-batch" class="col-form-label text-primary"><?php _e( "Batch", WL_IMP_DOMAIN ); ?>:</label>
	                <select name="batch" class="form-control selectpicker" id="wlim-batch">
	                    <option value="">-------- <?php _e( "Select a Batch", WL_IMP_DOMAIN ); ?> --------</option>
	                <?php
						foreach ( $data as $row ) {
							$id          = $row->id;
							$batch_code  = $row->batch_code;
							$course      = '-';
							if ( $row->course_id && isset( $course_data[$row->course_id] ) ) {
								$course_name = $course_data[$row->course_id]->course_name;
								$course_code = $course_data[$row->course_id]->course_code;
								$course      = "$course_name ($course_code)";
							} ?>
	                    <option value="<?php echo $id; ?>"><?php echo "$batch_code - $course"; ?></option>
						<?php
						} ?>
	                </select>
	            </div>
				<div class="form-check mb-2">
					<input type="checkbox" checked name="current_students" class="form-check-input mt-1" id="wlim-current_students">
					<label class="form-check-label mb-1 ml-4" for="wlim-current_students"><?php _e( 'To Current Students', WL_IMP_DOMAIN ); ?></label>
				</div>
				<div class="form-check mb-2">
					<input type="checkbox" name="former_students" class="form-check-input mt-1" id="wlim-former_students">
					<label class="form-check-label mb-1 ml-4" for="wlim-former_students"><?php _e( 'To Former Students', WL_IMP_DOMAIN ); ?></label>
				</div>
				<script>
					/* Select single option */
					jQuery('#wlim-batch').selectpicker({
						liveSearch: true
					});
				</script>
			<?php
				die();
			} else { ?>
			<strong class="text-danger">
			<?php
				_e( 'There is no batch.', WL_IMP_DOMAIN ); ?>
			</strong>
			<?php
				die();
			}

		} elseif ( $notification_by == 'by-course' ) {
			/* Get courses */
			$data = $wpdb->get_results( "SELECT id, course_code, course_name FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 ORDER BY id DESC" );
			if ( count( $data ) !== 0 ) { ?>
                <input type="hidden" name="notification_for" value="course">
	            <div class="form-group wlim-selectpicker">
	                <label for="wlim-course" class="col-form-label text-primary"><?php _e( "Course", WL_IMP_DOMAIN ); ?>:</label>
	                <select name="course" class="form-control selectpicker" id="wlim-course">
	                    <option value="">-------- <?php _e( "Select a Course", WL_IMP_DOMAIN ); ?> --------</option>
	                <?php
						foreach ( $data as $row ) {
							$id     = $row->id;
							$course = "$row->course_name ($row->course_code)"; ?>
	                    <option value="<?php echo $id; ?>"><?php echo $course; ?></option>
						<?php
						} ?>
	                </select>
	            </div>
				<div class="form-check mb-2">
					<input type="checkbox" checked name="current_students" class="form-check-input mt-1" id="wlim-current_students">
					<label class="form-check-label mb-1 ml-4" for="wlim-current_students"><?php _e( 'To Current Students', WL_IMP_DOMAIN ); ?></label>
				</div>
				<div class="form-check mb-2">
					<input type="checkbox" name="former_students" class="form-check-input mt-1" id="wlim-former_students">
					<label class="form-check-label mb-1 ml-4" for="wlim-former_students"><?php _e( 'To Former Students', WL_IMP_DOMAIN ); ?></label>
				</div>
				<script>
					/* Select single option */
					jQuery('#wlim-course').selectpicker({
						liveSearch: true
					});
				</script>
			<?php
				die();
			} else { ?>
			<strong class="text-danger">
			<?php
				_e( 'There is no course.', WL_IMP_DOMAIN ); ?>
			</strong>
			<?php
				die();
			}

		} elseif ( $notification_by == 'by-pending-fees' ) {
			/* Get students having pending fees */
			$data = $wpdb->get_results( "SELECT id, first_name, last_name FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND is_active = 1 AND ( fees_payable - fees_paid > 0 ) ORDER BY id DESC" );
			if ( count( $data ) !== 0 ) { ?>
                <input type="hidden" name="notification_for" value="pending-fees">
	            <div class="form-group wlim-selectpicker">
	                <label for="wlim-students" class="col-form-label text-primary"><?php _e( "Students", WL_IMP_DOMAIN ); ?>:</label>
	                <select name="student[]" class="form-control selectpicker" id="wlim-students" multiple>
	                <?php
						foreach ( $data as $row ) {
							$id            = $row->id;
							$enrollment_id = WL_IMP_Helper::get_enrollment_id( $id );
							$name          = $row->first_name;
							if ( $row->last_name ) {
								$name .= " $row->last_name";
							}
							$student       = "$name ($enrollment_id)"; ?>
	                    <option value="<?php echo $id; ?>"><?php echo $student; ?></option>
						<?php
						} ?>
	                </select>
	            </div>
				<script>
					/* Select multiple option */
					jQuery('#wlim-students').selectpicker({
						liveSearch: true,
						actionsBox: true
					});
					jQuery('#wlim-students').selectpicker('selectAll');
				</script>
			<?php
				die();
			} else { ?>
			<strong class="text-danger">
			<?php
				_e( 'There is no student with pending fees.', WL_IMP_DOMAIN ); ?>
			</strong>
			<?php
				die();
			}

		} elseif ( $notification_by == 'by-current-students' ) {
			/* Get current students */
			$data = $wpdb->get_results( "SELECT id, first_name, last_name FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND is_active = 1 AND course_completed = 0 ORDER BY id DESC" );
			if ( count( $data ) !== 0 ) { ?>
                <input type="hidden" name="notification_for" value="current-students">
	            <div class="form-group wlim-selectpicker">
	                <label for="wlim-students" class="col-form-label text-primary"><?php _e( "Students", WL_IMP_DOMAIN ); ?>:</label>
	                <select name="student[]" class="form-control selectpicker" id="wlim-students" multiple>
	                <?php
						foreach ( $data as $row ) {
							$id            = $row->id;
							$enrollment_id = WL_IMP_Helper::get_enrollment_id( $id );
							$name          = $row->first_name;
							if ( $row->last_name ) {
								$name .= " $row->last_name";
							}
							$student       = "$name ($enrollment_id)"; ?>
	                    <option value="<?php echo $id; ?>"><?php echo $student; ?></option>
						<?php
						} ?>
	                </select>
	            </div>
				<script>
					/* Select multiple option */
					jQuery('#wlim-students').selectpicker({
						liveSearch: true,
						actionsBox: true
					});
					jQuery('#wlim-students').selectpicker('selectAll');
				</script>
			<?php
				die();
			} else { ?>
			<strong class="text-danger">
			<?php
				_e( 'There is no current student.', WL_IMP_DOMAIN ); ?>
			</strong>
			<?php
				die();
			}

		} elseif ( $notification_by == 'by-former-students' ) {
			/* Get former students */
			$data = $wpdb->get_results( "SELECT id, first_name, last_name FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND course_completed = 1 ORDER BY id DESC" );
			if ( count( $data ) !== 0 ) { ?>
                <input type="hidden" name="notification_for" value="former-students">
	            <div class="form-group wlim-selectpicker">
	                <label for="wlim-students" class="col-form-label text-primary"><?php _e( "Students", WL_IMP_DOMAIN ); ?>:</label>
	                <select name="student[]" class="form-control selectpicker" id="wlim-students" multiple>
	                <?php
						foreach ( $data as $row ) {
							$id            = $row->id;
							$enrollment_id = WL_IMP_Helper::get_enrollment_id( $id );
							$name          = $row->first_name;
							if ( $row->last_name ) {
								$name .= " $row->last_name";
							}
							$student       = "$name ($enrollment_id)"; ?>
	                    <option value="<?php echo $id; ?>"><?php echo $student; ?></option>
						<?php
						} ?>
	                </select>
	            </div>
				<script>
					/* Select multiple option */
					jQuery('#wlim-students').selectpicker({
						liveSearch: true,
						actionsBox: true
					});
					jQuery('#wlim-students').selectpicker('selectAll');
				</script>
			<?php
				die();
			} else { ?>
			<strong class="text-danger">
			<?php
				_e( 'There is no former student.', WL_IMP_DOMAIN ); ?>
			</strong>
			<?php
				die();
			}

		} elseif ( $notification_by == 'by-individual-students' ) {
			/* Get individual students */
			$data = $wpdb->get_results( "SELECT id, first_name, last_name FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 ORDER BY id DESC" );
			if ( count( $data ) !== 0 ) { ?>
                <input type="hidden" name="notification_for" value="individual-students">
	            <div class="form-group wlim-selectpicker">
	                <label for="wlim-students" class="col-form-label text-primary"><?php _e( "Students", WL_IMP_DOMAIN ); ?>:</label>
	                <select name="student[]" class="form-control selectpicker" id="wlim-students" multiple>
	                <?php
						foreach ( $data as $row ) {
							$id            = $row->id;
							$enrollment_id = WL_IMP_Helper::get_enrollment_id( $id );
							$name          = $row->first_name;
							if ( $row->last_name ) {
								$name .= " $row->last_name";
							}
							$student       = "$name ($enrollment_id)"; ?>
	                    <option value="<?php echo $id; ?>"><?php echo $student; ?></option>
						<?php
						} ?>
	                </select>
	            </div>
				<script>
					/* Select multiple option */
					jQuery('#wlim-students').selectpicker({
						liveSearch: true,
						actionsBox: true
					});
				</script>
			<?php
				die();
			} else { ?>
			<strong class="text-danger">
			<?php
				_e( 'There is no student.', WL_IMP_DOMAIN ); ?>
			</strong>
			<?php
				die();
			}
		}
	}

	/* Send Notification */
	public static function send_notification() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['security'], 'wl-im-send-notification' ) ) {
			die();
		}

		$notification_for   = isset( $_POST['notification_for'] ) ? sanitize_text_field( $_POST['notification_for'] ) : NULL;
		$email_notification = isset( $_POST['email_notification'] ) ? boolval( sanitize_text_field( $_POST['email_notification'] ) ) : 0;

		if( empty( $email_notification ) ) {
			wp_send_json_error( __( 'Please select notification channel.', WL_IMP_DOMAIN ) );
		}

		if( $email_notification ) {
			$email_from    = isset( $_POST['email_from'] ) ? sanitize_text_field( $_POST['email_from'] ) : '';
			$email_subject = isset( $_POST['email_subject'] ) ? sanitize_text_field( $_POST['email_subject'] ) : '';
			$email_body    = isset( $_POST['email_body'] ) ? wp_kses_post( $_POST['email_body'] ) : '';
			$attachments   = ( isset( $_FILES['attachment'] ) && is_array( $_FILES['attachment'] ) ) ? $_FILES['attachment'] : NULL;
			$email_from    = empty( $email_from ) ? get_option( 'institute_pro_email_from' ) : '';

			/* Validations */
			$errors = [];
			if ( empty( $email_subject ) ) {
				$errors['email_subject'] = __( 'Please specify email subject.', WL_IMP_DOMAIN );
			}

			if ( empty( $email_body ) ) {
				$errors['email_body'] = __( 'Please specify email body.', WL_IMP_DOMAIN );
			}
			/* End validations */

			if ( ! ( count( $errors ) < 1 ) ) {
				wp_send_json_error( $errors );
			}
		}

		if ( $notification_for == 'batch' ) {
			self::send_batch_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments );
		} elseif( $notification_for == 'course' ) {
			self::send_course_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments );
		} elseif( $notification_for == 'pending-fees' ) {
			self::send_students_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments );
		} elseif( $notification_for == 'current-students' ) {
			self::send_students_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments );
		} elseif( $notification_for == 'former-students' ) {
			self::send_students_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments );
		} elseif( $notification_for == 'individual-students' ) {
			self::send_students_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments );
		} else {
			wp_send_json_error( __( 'Invalid notification.', WL_IMP_DOMAIN ) );
		}
	}

	/* Send Batch Notification */
	private static function send_batch_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments ) {
		global $wpdb;

		$batch_id         = isset( $_POST['batch'] ) ? intval( sanitize_text_field( $_POST['batch'] ) ) : NULL;
		$current_students = isset( $_POST['current_students'] ) ? boolval( sanitize_text_field( $_POST['current_students'] ) ) : 0;
		$former_students  = isset( $_POST['former_students'] ) ? boolval( sanitize_text_field( $_POST['former_students'] ) ) : 0;

		/* Validations */
		$errors = [];
		if( empty( $current_students ) && empty( $former_students ) ) {
			wp_send_json_error( __( 'Please specify either current students or former students or both.', WL_IMP_DOMAIN ) );
		}

		if ( empty( $batch_id ) ) {
			$errors['batch'] = __( 'Please select a valid batch.', WL_IMP_DOMAIN );
		} else {
			$data = NULL;
			if( $current_students && $former_students ) {
				$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND batch_id = $batch_id" );
			} elseif( $current_students ) {
				$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND batch_id = $batch_id AND is_active = 1 AND course_completed = 0" );
			} elseif( $former_students ) {
				$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND batch_id = $batch_id AND course_completed = 1" );
			}

			if ( count( $data ) == 0 ) {
				wp_send_json_error( __( 'There is no student in this batch.', WL_IMP_DOMAIN ) );
			}
		}
		/* End validations */

		self::submit_notification( $errors, $data, $email_notification, $email_subject, $email_body, $email_from, $attachments );
	}

	/* Send Course Notification */
	private static function send_course_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments ) {
		global $wpdb;

		$course_id        = isset( $_POST['course'] ) ? intval( sanitize_text_field( $_POST['course'] ) ) : NULL;
		$current_students = isset( $_POST['current_students'] ) ? boolval( sanitize_text_field( $_POST['current_students'] ) ) : 0;
		$former_students  = isset( $_POST['former_students'] ) ? boolval( sanitize_text_field( $_POST['former_students'] ) ) : 0;

		/* Validations */
		$errors = [];
		if( empty( $current_students ) && empty( $former_students ) ) {
			wp_send_json_error( __( 'Please specify either current students or former students or both.', WL_IMP_DOMAIN ) );
		}

		if ( empty( $course_id ) ) {
			$errors['course'] = __( 'Please select a valid course.', WL_IMP_DOMAIN );
		} else {
			$data = NULL;
			if( $current_students && $former_students ) {
				$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND course_id = $course_id" );
			} elseif( $current_students ) {
				$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND course_id = $course_id AND is_active = 1 AND course_completed = 0" );
			} elseif( $former_students ) {
				$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND course_id = $course_id AND course_completed = 1" );
			}

			if ( count( $data ) == 0 ) {
				wp_send_json_error( __( 'There is no student in this course.', WL_IMP_DOMAIN ) );
			}
		}
		/* End validations */

		self::submit_notification( $errors, $data, $email_notification, $email_subject, $email_body, $email_from, $attachments );
	}

	/* Send Students Notification */
	private static function send_students_notification( $email_notification, $email_subject, $email_body, $email_from, $attachments ) {
		global $wpdb;

		$students    = ( isset( $_POST['student'] ) && is_array( $_POST['student'] ) ) ? $_POST['student'] : array();
		$students    = array_map( 'esc_attr', $students );
		$student_ids = implode( $students, ',' );

		/* Validations */
		$errors = [];

		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id IN ($student_ids)" );

		if ( count( $data ) == 0 ) {
			wp_send_json_error( __( 'There is no student.', WL_IMP_DOMAIN ) );
		}
		/* End validations */

		self::submit_notification( $errors, $data, $email_notification, $email_subject, $email_body, $email_from, $attachments );
	}

	private static function submit_notification( $errors, $data, $email_notification, $email_subject, $email_body, $email_from, $attachments ) {
		if ( count( $errors ) < 1 ) {
			try {
				if( $email_notification ) {
					/* Send email notification */
					$mail = self::initialize_email();
					$mail->setFrom( $mail->Username, $email_from );
		            $mail->Subject = $email_subject;
		            $mail->Body    = $email_body;
	    			$mail->IsHTML( true );
	    			if( isset( $attachments["tmp_name"] ) && is_array( $attachments ) ) {
	    				foreach( $attachments["tmp_name"] as $key => $attachment ) {
	    					$mail->addAttachment( $attachment, sanitize_file_name( $attachments["name"][$key] ) );
	    				}
	    			}

					foreach ( $data as $row ) {
						$email         = $row->email ? $row->email : NULL;
						$first_name    = $row->first_name ? $row->first_name : NULL;
						$last_name     = $row->last_name ? $row->last_name : NULL;
						$name          = $first_name;
						if ( $last_name ) {
							$name .= " $last_name";
						}

						if ( $email ) {
				            $mail->AddAddress( $email, $name );
						}
					}
		            $email_notification_sent = $mail->Send();
				}

				if ( $email_notification_sent ) {
					$message = __( 'Email notification sent successfully.', WL_IMP_DOMAIN );
				} else {
					$message = __( 'Unable to send notification.', WL_IMP_DOMAIN );
					wp_send_json_error( $message );
				}
				wp_send_json_success( array( 'message' => $message ) );
			} catch ( Exception $exception ) {
				wp_send_json_error( $exception->getMessage() );
			}
		}
		else {
			wp_send_json_error( $errors );
		}
	}

	private static function initialize_email() {
		
	    global $wp_version;
	
		require_once(ABSPATH . WPINC . '/PHPMailer/PHPMailer.php');
		require_once(ABSPATH . WPINC . '/PHPMailer/SMTP.php');
		require_once(ABSPATH . WPINC . '/PHPMailer/Exception.php');
		$mail = new PHPMailer\PHPMailer\PHPMailer( true );
	    $mail->IsSMTP();
		$mail->Host       = get_option( 'institute_pro_email_host' );
		$mail->SMTPAuth   = true;
		$mail->Username   = get_option( 'institute_pro_email_username' );
		$mail->Password   = get_option( 'institute_pro_email_password' );
		$mail->SMTPSecure = get_option( 'institute_pro_email_encryption' );
		$mail->Port       = get_option( 'institute_pro_email_port' );

	    if( empty( $mail->Host ) || empty( $mail->Username ) || empty( $mail->Password ) || empty( $mail->SMTPSecure ) || empty( $mail->Port ) ) {
			wp_send_json_error( __( 'Please configure SMTP Settings to send email notifications.', WL_IMP_DOMAIN ) );
	    }
	    return $mail;
	}

	/* Check permission to manage notification */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_notifications' ) ) {
			die();
		}
	}
}