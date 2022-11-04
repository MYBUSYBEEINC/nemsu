<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Result {
	/* Get exam data to display on table */
	public static function get_exam_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 ORDER BY id DESC" );

		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id           = $row->id;
				$exam_code    = $row->exam_code;
				$exam_title   = $row->exam_title ? $row->exam_title : '-';
				$exam_date    = date_format( date_create( $row->exam_date ), "d-m-Y" );
				$is_published = $row->is_published ? __( 'Yes', WL_IMP_DOMAIN ) : __( 'No', WL_IMP_DOMAIN );
				$published_at = $row->published_at ? date_format( date_create( $row->published_at ), "d-m-Y g:i A" ) : '-';
				$added_on     = date_format( date_create( $row->created_at ), "d-m-Y g:i A" );
				$added_by     = ( $user = get_userdata( $row->added_by ) ) ? $user->user_login : '-';

				$results["data"][] = array(
					$exam_code,
					$exam_title,
					$exam_date,
					$is_published,
					$published_at,
					$added_on,
					$added_by,
					'<a class="mr-3" href="#update-exam" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" delete-exam-security="' . wp_create_nonce( "delete-exam-$id" ) . '"delete-exam-id="' . $id . '" class="delete-exam"> <i class="fa fa-trash text-danger"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Add new exam */
	public static function add_exam() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-exam'], 'add-exam' ) ) {
			die();
		}
		global $wpdb;

		$exam_code    = isset( $_POST['exam_code'] ) ? sanitize_text_field( $_POST['exam_code'] ) : '';
		$exam_title   = isset( $_POST['exam_title'] ) ? sanitize_text_field( $_POST['exam_title'] ) : '';
		$exam_date    = ( isset( $_POST['exam_date'] ) && ! empty( $_POST['exam_date'] ) ) ? date( "Y-m-d", strtotime( sanitize_text_field( $_REQUEST['exam_date'] ) ) ) : NULL;
		$marks        = ( isset( $_POST['marks'] ) && is_array( $_POST['marks'] ) ) ? $_POST['marks'] : NULL;
		$is_published = isset( $_POST['is_published'] ) ? boolval( sanitize_text_field( $_POST['is_published'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $exam_code ) ) {
			$errors['exam_code'] = __( 'Please provide exam code.', WL_IMP_DOMAIN );
		}

		if ( strlen( $exam_code ) > 191 ) {
			$errors['exam_code'] = __( 'Maximum length cannot exceed 191 characters.', WL_IMP_DOMAIN );
		}

		if ( empty( $exam_title ) ) {
			$errors['exam_title'] = __( 'Please provide exam title.', WL_IMP_DOMAIN );
		}

		if ( empty( $exam_date ) ) {
			$errors['exam_date'] = __( 'Please specify exam date.', WL_IMP_DOMAIN );
		}

		if ( empty( $marks ) ) {
			wp_send_json_error( __( 'Please specify subjects and maximum marks.', WL_IMP_DOMAIN ) );
		}

		if ( ! array_key_exists( 'subject', $marks ) || ! array_key_exists( 'maximum', $marks ) ) {
			wp_send_json_error( __( 'Invalid subjects or maximum marks.', WL_IMP_DOMAIN ) );
		}

		if ( count( $marks['subject'] ) < 1 || ( count( $marks['subject'] ) != count( $marks['maximum'] ) ) ) {
			wp_send_json_error( __( 'Invalid subjects or maximum marks.', WL_IMP_DOMAIN ) );
		}

		if ( array_search( '', $marks['subject'] ) !== false ) {
			wp_send_json_error( __( 'Please specify subject.', WL_IMP_DOMAIN ) );
		}

		foreach( $marks['maximum'] as $key => $value ) {
			if ( $value < 0 || ( ! is_numeric( $value ) ) ) {
				wp_send_json_error( __( 'Please provide a valid maximum mark for a subject.', WL_IMP_DOMAIN ) );
			} else {
				$marks['maximum'][$key] = isset( $value ) ? max( floatval( sanitize_text_field( $value ) ), 0 ) : 0;
			}
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND exam_code = '$exam_code'" );

		if ( $count ) {
			$errors['exam_code'] = __( 'Exam code already exists.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
			  	$wpdb->query( 'BEGIN;' );

			  	$marks = serialize( $marks );

			  	$published_at = NULL;
			  	if ( $is_published ) {
			  		$published_at = date('Y-m-d H:i:s');
			  	}

				$data = array(
					'exam_code'    => $exam_code,
					'exam_title'   => $exam_title,
					'exam_date'    => $exam_date,
					'marks'        => $marks,
				    'is_published' => $is_published,
				    'published_at' => $published_at,
				    'added_by'     => get_current_user_id()
				);

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_exams", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

		  		$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Exam added successfully.', WL_IMP_DOMAIN ), 'reload' => true ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Fetch exam to update */
	public static function fetch_exam() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id  = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}

		$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = $id" );
		$results_exists = false;
		if ( count( $results ) ) {
			$results_exists = true;
		}
		?>
		<?php $nonce = wp_create_nonce( "update-exam-$id" ); ?>
	    <input type="hidden" name="update-exam-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
	    <input type="hidden" name="action" value="wl-im-update-exam">
		<div class="form-group">
			<label for="wlim-exam-exam_code_update" class="col-form-label">* <?php _e( 'Exam Code', WL_IMP_DOMAIN ); ?>:</label>
			<input name="exam_code" type="text" class="form-control" id="wlim-exam-exam_code_update" placeholder="<?php _e( "Exam Code", WL_IMP_DOMAIN ); ?>" min="0" step="any" value="<?php echo $row->exam_code; ?>">
		</div>
		<div class="form-group">
			<label for="wlim-exam-exam_title_update" class="col-form-label">* <?php _e( 'Exam Title', WL_IMP_DOMAIN ); ?>:</label>
			<input name="exam_title" type="text" class="form-control" id="wlim-exam-exam_title_update" placeholder="<?php _e( "Exam Title", WL_IMP_DOMAIN ); ?>" min="0" step="any" value="<?php echo $row->exam_title; ?>">
		</div>
		<div class="form-group">
			<label for="wlim-exam-exam_date_update" class="col-form-label">* <?php _e( 'Exam Date', WL_IMP_DOMAIN ); ?>:</label>
			<input name="exam_date" type="text" class="form-control wlim-exam-exam_date_update" id="wlim-exam-exam_date" placeholder="<?php _e( "Exam Date", WL_IMP_DOMAIN ); ?>">
		</div>
		<label class="col-form-label">* <?php _e( 'Exam Marks', WL_IMP_DOMAIN ); ?>:</label>
        <div class="exam_marks_box">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php _e( 'Subject', WL_IMP_DOMAIN ); ?></th>
                        <th><?php _e( 'Maximum Marks', WL_IMP_DOMAIN ); ?></th>
                        <?php
                        if ( ! $results_exists ) { ?>
                        <th></th>
                        <?php
                    	} ?>
                    </tr>
                </thead>
                <tbody class="exam_marks_rows exam_marks_table">
                	<?php
                	$marks = unserialize( $row->marks );
                	foreach( $marks['subject'] as $key => $value ) { ?>
                    <tr>
                        <td>
                    		<input type="text" name="marks[subject][]" class="form-control" placeholder="<?php _e( 'Subject', WL_IMP_DOMAIN ); ?>" value="<?php echo $marks['subject'][$key]; ?>">
                        </td>
                        <td>
                        	<input<?php echo ( $results_exists ) ? " disabled " : " "; ?>type="number" min="0" step="any" name="marks[maximum][]" class="form-control" placeholder="<?php _e( 'Maximum Marks', WL_IMP_DOMAIN ); ?>" value="<?php echo $marks['maximum'][$key]; ?>">
                        </td>
                        <?php
                        if ( ! $results_exists ) { ?>
                        <td>
                            <button class="remove_row btn btn-danger btn-sm" type="button">
                                <i class="fa fa-remove" aria-hidden="true"></i>
                            </button>
                        </td>
                        <?php
                    	} ?>
                    </tr>
                    <?php
        			} ?>
                </tbody>
            </table>
            <?php
            if ( ! $results_exists ) { ?>
            <div class="text-right">
                <button type="button" class="add-more-exam-marks btn btn-success btn-sm"><?php _e( 'Add More', WL_IMP_DOMAIN ); ?></button>
            </div>
            <?php
        	} ?>
        </div>
		<div class="form-check pl-0">
			<input name="is_published" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-exam-is_published_update" <?php echo $row->is_published ? "checked" : ""; ?>>
			<label class="form-check-label" for="wlim-exam-is_published_update">
			<?php _e( 'Is Published?', WL_IMP_DOMAIN ); ?>
			</label>
		</div>
		<input type="hidden" name="exam_id" value="<?php echo $row->id; ?>">
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/imges/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
		<script>
			/* Select exam date */
			jQuery('.wlim-exam-exam_date_update').datetimepicker({
				format: 'DD-MM-YYYY',
				showClear: true,
				showClose: true,
			});
			jQuery('.wlim-exam-exam_date_update').data("DateTimePicker").date(moment("<?php echo $row->exam_date; ?>"));
		</script>
	<?php
		die();
	}

	/* Update exam */
	public static function update_exam() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['exam_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-exam-$id"], "update-exam-$id" ) ) {
			die();
		}
		global $wpdb;

		$exam_code    = isset( $_POST['exam_code'] ) ? sanitize_text_field( $_POST['exam_code'] ) : '';
		$exam_title   = isset( $_POST['exam_title'] ) ? sanitize_text_field( $_POST['exam_title'] ) : '';
		$exam_date    = ( isset( $_POST['exam_date'] ) && ! empty( $_POST['exam_date'] ) ) ? date( "Y-m-d", strtotime( sanitize_text_field( $_REQUEST['exam_date'] ) ) ) : NULL;
		$marks        = ( isset( $_POST['marks'] ) && is_array( $_POST['marks'] ) ) ? $_POST['marks'] : NULL;
		$is_published = isset( $_POST['is_published'] ) ? boolval( sanitize_text_field( $_POST['is_published'] ) ) : 0;

		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}

		$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = $id" );
		$results_exists = false;
		if ( count( $results ) ) {
			$results_exists = true;
		}

		/* Validations */
		$errors = [];
		if ( empty( $exam_code ) ) {
			$errors['exam_code'] = __( 'Please provide exam code.', WL_IMP_DOMAIN );
		}

		if ( strlen( $exam_code ) > 191 ) {
			$errors['exam_code'] = __( 'Maximum length cannot exceed 191 characters.', WL_IMP_DOMAIN );
		}

		if ( empty( $exam_title ) ) {
			$errors['exam_title'] = __( 'Please provide exam title.', WL_IMP_DOMAIN );
		}

		if ( empty( $exam_date ) ) {
			$errors['exam_date'] = __( 'Please specify exam date.', WL_IMP_DOMAIN );
		}

		if ( $results_exists ) {
			if ( empty( $marks ) ) {
				wp_send_json_error( __( 'Please specify subjects.', WL_IMP_DOMAIN ) );
			}

			if ( ! array_key_exists( 'subject', $marks ) ) {
				wp_send_json_error( __( 'Invalid subjects.', WL_IMP_DOMAIN ) );
			}

			if ( count( $marks['subject'] ) < 1 ) {
				wp_send_json_error( __( 'Invalid subjects.', WL_IMP_DOMAIN ) );
			}

			if ( array_search( '', $marks['subject'] ) !== false ) {
				wp_send_json_error( __( 'Please specify subject.', WL_IMP_DOMAIN ) );
			}

			$maximum_marks = unserialize( $row->marks );
			$marks['maximum'] = $maximum_marks['maximum'];
		} else {
			if ( empty( $marks ) ) {
				wp_send_json_error( __( 'Please specify subjects and maximum marks.', WL_IMP_DOMAIN ) );
			}

			if ( ! array_key_exists( 'subject', $marks ) || ! array_key_exists( 'maximum', $marks ) ) {
				wp_send_json_error( __( 'Invalid subjects or maximum marks.', WL_IMP_DOMAIN ) );
			}

			if ( count( $marks['subject'] ) < 1 || ( count( $marks['subject'] ) != count( $marks['maximum'] ) ) ) {
				wp_send_json_error( __( 'Invalid subjects or maximum marks.', WL_IMP_DOMAIN ) );
			}

			if ( array_search( '', $marks['subject'] ) !== false ) {
				wp_send_json_error( __( 'Please specify subject.', WL_IMP_DOMAIN ) );
			}

			foreach( $marks['maximum'] as $key => $value ) {
				if ( $value < 0 || ( ! is_numeric( $value ) ) ) {
					wp_send_json_error( __( 'Please provide a valid maximum mark for a subject.', WL_IMP_DOMAIN ) );
				} else {
					$marks['maximum'][$key] = isset( $value ) ? max( floatval( sanitize_text_field( $value ) ), 0 ) : 0;
				}
			}
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND exam_code = '$exam_code' AND id != $id" );

		if ( $count ) {
			$errors['exam_code'] = __( 'Exam code already exists.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

			  	$marks = serialize( $marks );

				$data = array(
					'exam_code'    => $exam_code,
					'exam_title'   => $exam_title,
					'exam_date'    => $exam_date,
					'marks'        => $marks,
				    'is_published' => $is_published,
				    'updated_at'    => date('Y-m-d H:i:s')
				);

				if ( ! $is_published ) {
					$data['published_at'] = NULL;
				} elseif ( ! $row->published_at ) {
					$data['published_at'] = date('Y-m-d H:i:s');
				}

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_exams", $data, array( 'is_deleted' => 0, 'id' => $id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$wpdb->query( 'COMMIT;' );

				wp_send_json_success( array( 'message' => __( 'Exam updated successfully.', WL_IMP_DOMAIN ), 'reload' => true ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Delete exam */
	public static function delete_exam() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-exam-$id"], "delete-exam-$id" ) ) {
			die();
		}
		global $wpdb;

		try {
			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_exams",
					array(
						'is_deleted' => 1,
						'deleted_at' => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'id' => $id )
				);
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$sql = "DELETE FROM {$wpdb->prefix}wl_im_results WHERE exam_id = $id";

			$success = $wpdb->query( $sql );

			$wpdb->query( 'COMMIT;' );
			wp_send_json_success( array( 'message' => __( 'Exam removed successfully.', WL_IMP_DOMAIN ), 'reload' => true ) );
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
            <label for="wlim-result-batch" class="col-form-label">* <?php _e( "Batch", WL_IMP_DOMAIN ); ?>:</label>
            <select name="batch" class="form-control selectpicker" id="wlim-result-batch">
                <option value="">-------- <?php _e( "Select a Batch", WL_IMP_DOMAIN ); ?> --------</option>
            <?php
    			foreach ( $batches as $batch ) {
					$batch_info = $batch->batch_code;
					if ( $batch->batch_name ) {
						$batch_info .= " ( $batch->batch_name )";
					} ?>
                <option value="<?php echo $batch->id; ?>"><?php echo $batch_info; ?></option>
				<?php
	    		} ?>
            </select>
        </div>
        <div id="wlim-add-result-batch-students"></div>
		<script>
			/* Select single option */
			jQuery('#wlim-result-batch').selectpicker({
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

	/* Fetch batch students */
	public static function fetch_batch_students() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$batch_id = intval( sanitize_text_field( $_POST['id'] ) );
		$exam_id  = intval( sanitize_text_field( $_POST['exam_id'] ) );
		$row      = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND id = $batch_id" );

		if ( ! $row ) {
			die();
		}

		if ( ! $exam_id ) { ?>
			<span class="text-danger"><?php _e( "Please select an exam.", WL_IMP_DOMAIN ); ?></span>	
		<?php
			die();
		}

		$exam = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $exam_id" );

		if ( ! $exam ) { ?>
			<span class="text-danger"><?php _e( "Exam not found.", WL_IMP_DOMAIN ); ?></span>	
		<?php
			die();
		}

		$marks  = unserialize( $exam->marks );

		$students = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND batch_id = $batch_id ORDER BY id ASC" );
		if ( count( $students ) > 0 ) { ?>
		<ul class="list-group mt-4">
			<?php
			foreach( $students as $key => $student ) {
				$id = $student->id;
				$enrollment_id = WL_IMP_Helper::get_enrollment_id( $student->id );
				$name = $student->first_name;
				if ( $student->last_name ) {
					$name .= " $student->last_name";
				}
				$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = " . $exam->id . " AND student_id = " . $id );
			?>
			<li class="border p-2"><strong><?php echo $key + 1; ?>. </strong><span class="text-dark"><?php echo "$name ($enrollment_id)"; ?></span>
				<span class="ml-3">
					<a class="btn btn-success btn-sm" role="button" href="#wlim-result-add-student-marks-<?php echo $key; ?>" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="<?php echo $id; ?>" data-exam_id="<?php echo $exam_id; ?>">
						<?php
						if ( $result ) {
							_e( "Update Marks", WL_IMP_DOMAIN );
						} else {
							_e( "Add Marks", WL_IMP_DOMAIN );
						} ?>
					</a>
				</span>
				<!-- add student marks modal -->
				<div class="modal fade" id="wlim-result-add-student-marks-<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="wlim-result-add-student-marks-label-<?php echo $key; ?>" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" id="wlim-result-add-student-marks-dialog-<?php echo $key; ?>" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title w-100 text-center" id="wlim-result-add-student-marks-label-<?php echo $key; ?>"><?php _e( 'Add Student Marks', WL_IMP_DOMAIN ); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body pr-4 pl-4">
								<div class="row">
									<div class="col">
										<label class="col-form-label"><?php _e( 'Student Details', WL_IMP_DOMAIN ); ?>:</label>
										<ul class="list-group">
											<li class="list-group-item"><span class="text-dark"><?php _e( "Student ID", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo $enrollment_id; ?></strong></li>
											<li class="list-group-item"><span class="text-dark"><?php _e( "Name", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo $name; ?></strong></li>
										</ul>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3 mt-2">
											<label class="col-form-label">* <?php _e( 'Exam Marks', WL_IMP_DOMAIN ); ?>:</label>
									        <div class="exam_marks_obtained_box">
									            <table class="table table-bordered">
									                <thead>
									                    <tr>
									                        <th><?php _e( 'Subject', WL_IMP_DOMAIN ); ?></th>
									                        <th><?php _e( 'Maximum Marks', WL_IMP_DOMAIN ); ?></th>
									                        <th><?php _e( 'Marks Obtained', WL_IMP_DOMAIN ); ?></th>
									                        <th></th>
									                    </tr>
									                </thead>
									                <tbody class="exam_marks_obtained_rows exam_marks_obtained_table">
									                	<?php
									                	$marks_obtained = null;
														if ( $result ) {
															$marks_obtained = unserialize( $result->marks );
														}
									                	foreach( $marks['subject'] as $subject_key => $subject_value ) {
									                		$marks_obtained_in_subject = 0;
									                		if ( ! empty( $marks_obtained ) ) {
									                			$marks_obtained_in_subject = $marks_obtained[$subject_key];
									                		}
									                	?>
									                    <tr>
									                        <td>
                        										<span class="text-dark"><?php echo $subject_value; ?></span>
									                        </td>
									                        <td>
                        										<span class="text-dark"><?php echo $marks['maximum'][$subject_key]; ?></span>
									                        </td>
									                        <td>
                        										<input required type="number" min="0" step="any" name="marks_obtained[<?php echo $id; ?>][]" class="form-control" placeholder="<?php _e( 'Marks Obtained', WL_IMP_DOMAIN ); ?>" value="<?php echo $marks_obtained_in_subject; ?>">
									                        </td>
									                    </tr>
									                    <?php
									        			} ?>
									                </tbody>
									            </table>
									        </div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
								<button type="button" class="btn btn-success" data-dismiss="modal"><?php _e( 'Done', WL_IMP_DOMAIN ); ?></button>
							</div>
						</div>
					</div>
				</div>
				<style>
					@media (min-width: 576px) {
						#wlim-result-add-student-marks-<?php echo $key; ?> {
							z-index: 9999;
						}
						#wlim-result-add-student-marks-dialog-<?php echo $key; ?> {
							max-width: 700px !important;
						}
					}
				</style>
				<!-- end - add student marks modal -->
			</li>
			<?php
			} ?>
		</ul>
		<script>

		</script>
		<?php
        } else { ?>
			<div class="text-danger pt-3 pb-3 border-bottom"><?php _e( "Students not found.", WL_IMP_DOMAIN ); ?></div>
        <?php
    	}
    	die();
	}

	/* Save result */
	public static function save_result() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['save-result'], 'save-result' ) ) {
			die();
		}

		$course_id      = intval( sanitize_text_field( $_POST['course'] ) );
		$batch_id       = intval( sanitize_text_field( $_POST['batch'] ) );
		$exam_id        = intval( sanitize_text_field( $_POST['exam'] ) );
		$marks_obtained = ( isset( $_POST['marks_obtained'] ) && is_array( $_POST['marks_obtained'] ) ) ? $_POST['marks_obtained'] : NULL;

		global $wpdb;

		/* Validations */
		$errors = [];
		if ( empty( $course_id ) ) {
			wp_send_json_error( __( 'Please select a course.', WL_IMP_DOMAIN ) );
		}

		if ( empty( $batch_id ) ) {
			wp_send_json_error( __( 'Please select a batch.', WL_IMP_DOMAIN ) );
		}

		if ( empty( $exam_id ) ) {
			wp_send_json_error( __( 'Please select an exam.', WL_IMP_DOMAIN ) );
		}

		$course = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND id = $course_id" );
		if ( ! $course ) {
			$errors['course'] = __( 'Please select a valid course.', WL_IMP_DOMAIN );
		}

		$batch = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND id = $batch_id AND course_id = $course_id" );
		if ( ! $batch ) {
			$errors['batch'] = __( 'Please select a valid batch.', WL_IMP_DOMAIN );
		}

		$exam = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $exam_id" );
		if ( ! $exam ) {
			$errors['exam'] = __( 'Please select a valid exam.', WL_IMP_DOMAIN );
		}

		$marks = unserialize( $exam->marks );

		if ( empty( $marks_obtained ) ) {
			wp_send_json_error( __( 'Please specify marks obtained.', WL_IMP_DOMAIN ) );
		}

		$students = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND batch_id = $batch_id ORDER BY id ASC" );
		if ( ! count( $students ) ) {
			wp_send_json_error( __( 'There is no student in this batch.', WL_IMP_DOMAIN ) );
		}

		$result_data = array();
		foreach( $students as $key => $student ) {
			if ( ! array_key_exists( $student->id, $marks_obtained ) ) {
				wp_send_json_error( __( 'Invalid marks obtained for student with enrollment ID: ' . WL_IMP_Helper::get_enrollment_id( $student->id ), WL_IMP_DOMAIN ) );
			} else {
				foreach( $marks_obtained[$student->id] as $key => $value ) {
					if ( $value < 0 || ( ! is_numeric( $value ) ) ) {
						wp_send_json_error( __( 'Please provide a valid marks obtained.', WL_IMP_DOMAIN ) );
					} else {
						if ( $marks['maximum'][$key] < $value ) {
							wp_send_json_error( __( 'Marks obtained exceeded maximum marks for enrollment ID: ', WL_IMP_DOMAIN ) . WL_IMP_Helper::get_enrollment_id( $student->id ) );
						}
						$marks_obtained[$student->id][$key] = isset( $value ) ? max( floatval( sanitize_text_field( $value ) ), 0 ) : 0;
					}
				}
			}
			array_push( $result_data, array(
				'student_id'   => $student->id,
				'exam_id'      => $exam->id,
				'marks'        => serialize( $marks_obtained[$student->id] ),
			    'created_at'   => date('Y-m-d H:i:s'),
			    'updated_at'   => date('Y-m-d H:i:s')
			) );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				foreach( $result_data as $data ) {
					$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = " . $data['exam_id'] . " AND student_id = " . $data['student_id'] );
					if ( $result ) {
						/* Update result */
						$success = $wpdb->update( "{$wpdb->prefix}wl_im_results", $data, array( 'is_deleted' => 0, 'exam_id' => $data['exam_id'], 'student_id' => $data['student_id'] ) );
					} else {
						/* Insert result */
						$data['added_by'] = get_current_user_id();
						$success = $wpdb->insert( "{$wpdb->prefix}wl_im_results", $data );
					}
					if ( ! $success ) {
			  			throw new Exception( __( $wpdb->last_error, WL_IMP_DOMAIN ) );
					}
				}

				$wpdb->query( 'COMMIT;' );

				wp_send_json_success( array( 'message' => __( 'Results saved successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Add new result */
	public static function add_result() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-result'], 'add-result' ) ) {
			die();
		}
		global $wpdb;

		$student_id     = isset( $_REQUEST['student'] ) ? intval( sanitize_text_field( $_REQUEST['student'] ) ) : NULL;
		$exam_id        = isset( $_REQUEST['exam'] ) ? intval( sanitize_text_field( $_REQUEST['exam'] ) ) : NULL;
		$marks_obtained = ( isset( $_POST['marks_obtained'] ) && is_array( $_POST['marks_obtained'] ) ) ? $_POST['marks_obtained'] : NULL;

		/* Validations */
		$errors = [];

		if ( empty( $student_id ) ) {
			$errors['student'] = __( 'Please select a student.', WL_IMP_DOMAIN );
		}

		$exam = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $exam_id" );

		if ( ! $exam ) {
			wp_send_json_error( __( 'Exam not found.', WL_IMP_DOMAIN ) );
		}

		$student = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $student_id" );

		if ( ! $student ) {
			wp_send_json_error( __( 'Student not found.', WL_IMP_DOMAIN ) );
		}

		$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = $exam_id AND student_id = $student_id" );

		if ( $result ) {
			wp_send_json_error( __( 'Result for this exam already exists.', WL_IMP_DOMAIN ) );
		}

		$marks = unserialize( $exam->marks );

		if ( empty( $marks_obtained ) ) {
			wp_send_json_error( __( 'Please specify marks obtained.', WL_IMP_DOMAIN ) );
		}

		foreach( $marks_obtained as $key => $value ) {
			if ( $value < 0 || ( ! is_numeric( $value ) ) ) {
				wp_send_json_error( __( 'Please provide a valid marks obtained.', WL_IMP_DOMAIN ) );
			} else {
				if ( $marks['maximum'][$key] < $value ) {
					wp_send_json_error( __( 'Marks obtained exceeded maximum marks.', WL_IMP_DOMAIN ) );
				}
				$marks_obtained[$key] = isset( $value ) ? max( floatval( sanitize_text_field( $value ) ), 0 ) : 0;
			}
		}

		$data = array(
			'student_id' => $student_id,
			'exam_id'    => $exam_id,
			'marks'      => serialize( $marks_obtained ),
		    'added_by'   => get_current_user_id()
		);
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_results", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$wpdb->query( 'COMMIT;' );

				wp_send_json_success( array( 'message' => __( 'Result added successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Get exam results */
	public static function get_exam_results() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$exam_id  = intval( sanitize_text_field( $_REQUEST['exam'] ) );

		if ( empty( $exam_id ) ) { ?>
			<strong class="text-danger"><?php _e( 'Please select an exam.', WL_IMP_DOMAIN ); ?></strong>
		<?php
			die();
		}
		$exam = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $exam_id" );
		if ( ! $exam ) { ?>
			<strong class="text-danger"><?php _e( 'Exam not found.', WL_IMP_DOMAIN ); ?></strong>
		<?php
			die();
		}
		$marks = unserialize( $exam->marks );

		$results = $wpdb->get_col( "SELECT student_id FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = $exam_id" );

		$filter = "";
		if ( count( $results ) ) {
			$student_ids = implode( ',', $results );
 			$filter = " AND id NOT IN ($student_ids)";
		}

		$students = $wpdb->get_results( "SELECT id, first_name, last_name FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0$filter ORDER BY id DESC" );
		?>
		<div class="row">
			<div class="card col">
				<div class="card-header bg-info text-white">
					<div class="row">
						<div class="col-md-9 col-xs-12">
							<h6><?php _e( 'Exam Results', WL_IMP_DOMAIN ); ?>: <mark><?php echo "$exam->exam_title ( $exam->exam_code )"; ?></mark></h6>
						</div>
						<div class="col-md-3 col-xs-12">
							<button type="button" class="btn btn-outline-light float-right add-result" data-toggle="modal" data-target="#add-result"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Result', WL_IMP_DOMAIN ); ?>
							</button>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-hover table-striped table-bordered" id="result-table">
						<thead>
							<tr>
					        	<th scope="col"><?php _e( 'Student ID', WL_IMP_DOMAIN ); ?></th>
					        	<th scope="col"><?php _e( 'Name', WL_IMP_DOMAIN ); ?></th>
					        	<th scope="col"><?php _e( 'Course', WL_IMP_DOMAIN ); ?></th>
					        	<th scope="col"><?php _e( 'Batch', WL_IMP_DOMAIN ); ?></th>
					        	<th scope="col"><?php _e( 'Percentage', WL_IMP_DOMAIN ); ?></th>
					        	<th scope="col"><?php _e( 'Result', WL_IMP_DOMAIN ); ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- add new result modal -->
		<div class="modal fade" id="add-result" tabindex="-1" role="dialog" aria-labelledby="add-result-label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="add-result-label"><?php _e( 'Add New Result', WL_IMP_DOMAIN ); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-add-result-form">
						<div class="modal-body pr-4 pl-4">
							<div class="border p-2 mb-2">
							<span class="text-dark"><?php _e( "Exam", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo "$exam->exam_title ( $exam->exam_code )"; ?></strong>
							</div>
							<?php $nonce = wp_create_nonce( 'add-result' ); ?>
			                <input type="hidden" name="add-result" value="<?php echo $nonce; ?>">
			                <input type="hidden" name="action" value="wl-im-add-result">
			                <input type="hidden" name="exam" value="<?php echo $exam_id; ?>">
			                <?php
							if ( count( $students ) ) { ?>
					            <div class="form-group wlim-selectpicker">
					                <label for="wlim-students" class="col-form-label"><?php _e( "Student", WL_IMP_DOMAIN ); ?>:</label>
					                <select name="student" class="form-control selectpicker" id="wlim-students">
					                	<option value="">-------- <?php _e( "Select a Student", WL_IMP_DOMAIN ); ?> --------</option>
					                <?php
										foreach ( $students as $row ) {
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
								<div class="row">
									<div class="col">
										<div class="mb-3 mt-2">
											<label class="col-form-label">* <?php _e( 'Exam Marks', WL_IMP_DOMAIN ); ?>:</label>
									        <div class="exam_marks_obtained_box">
									            <table class="table table-bordered">
									                <thead>
									                    <tr>
									                        <th><?php _e( 'Subject', WL_IMP_DOMAIN ); ?></th>
									                        <th><?php _e( 'Maximum Marks', WL_IMP_DOMAIN ); ?></th>
									                        <th><?php _e( 'Marks Obtained', WL_IMP_DOMAIN ); ?></th>
									                        <th></th>
									                    </tr>
									                </thead>
									                <tbody class="exam_marks_obtained_rows exam_marks_obtained_table">
									                	<?php
									                	foreach( $marks['subject'] as $subject_key => $subject_value ) { ?>
									                    <tr>
									                        <td>
                        										<span class="text-dark"><?php echo $subject_value; ?></span>
									                        </td>
									                        <td>
                        										<span class="text-dark"><?php echo $marks['maximum'][$subject_key]; ?></span>
									                        </td>
									                        <td>
                        										<input required type="number" min="0" step="any" name="marks_obtained[]" class="form-control" placeholder="<?php _e( 'Marks Obtained', WL_IMP_DOMAIN ); ?>">
									                        </td>
									                    </tr>
									                    <?php
									        			} ?>
									                </tbody>
									            </table>
									        </div>
										</div>
									</div>
								</div>
								<script>
									/* Select multiple option */
									jQuery('#wlim-students').selectpicker({
										liveSearch: true,
										actionsBox: true
									});
								</script>
							<?php
							} else { ?>
							<strong class="text-danger">
							<?php
								_e( 'There is no student.', WL_IMP_DOMAIN ); ?>
							</strong>
							<?php
							} ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
							<button type="submit" class="btn btn-primary add-result-submit"><?php _e( 'Add New Result', WL_IMP_DOMAIN ); ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end - add new exam modal -->
		<!-- update result modal -->
		<div class="modal fade" id="update-result" tabindex="-1" role="dialog" aria-labelledby="update-result-label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="update-result-label"><?php _e( 'Update Result', WL_IMP_DOMAIN ); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-update-result-form">
						<div class="modal-body pr-4 pl-4" id="fetch_result"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
							<button type="submit" class="btn btn-primary update-result-submit"><?php _e( 'Update Result', WL_IMP_DOMAIN ); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- end - update result modal -->
		<script>
			jQuery('#update-result').appendTo("body");

			jQuery('#result-table').DataTable({
		        aaSorting: [],
		        responsive: true,
				ajax: {
					url: ajaxurl + '?security=' + WLIMAjax.security + '&action=wl-im-get-result-data&exam=' + '<?php echo $exam_id; ?>',
		            dataSrc: 'data'
				},
				language: {
					"loadingRecords": "Loading..."
				}
			});

			/* Add or update record with files */
			function saveWithFiles(selector, form = null, modal = null, reloadTables = [], reset = true) {
				jQuery(form).ajaxForm({
					success: function(response) {
						jQuery(selector).prop('disabled', false);
						if(response.success) {
							jQuery('span.text-danger').remove();
							jQuery(".is-valid").removeClass("is-valid");
							jQuery(".is-invalid").removeClass("is-invalid");
							toastr.success(response.data.message);
							if(response.data.hasOwnProperty('reload') && response.data.reload) {
								location.reload();
							} else {
								if(reset) {
									jQuery(form)[0].reset();
								}
								if(modal) {
									jQuery(modal).modal('hide');
								}
								reloadTables.forEach(function(table) {
									jQuery(table).DataTable().ajax.reload(null, false);
								});
							}
						} else {
							jQuery('span.text-danger').remove();
							if(response.data && jQuery.isPlainObject(response.data)) {
								jQuery(form + ' :input').each(function() {
									var input = this;
									jQuery(input).removeClass('is-valid');
									jQuery(input).removeClass('is-invalid');
									if(response.data[input.name]) {
										var errorSpan = '<span class="text-danger">' + response.data[input.name] + '</span>';
										jQuery(input).addClass('is-invalid');
										jQuery(errorSpan).insertAfter(input);
									} else {
										jQuery(input).addClass('is-valid');
									}
								});
							} else {
								var errorSpan = '<span class="text-danger ml-3 mt-3">' + response.data + '<hr></span>';
								jQuery(errorSpan).insertBefore(form);
								toastr.error(response.data);
							}
						}
					},
					error: function(response) {
						jQuery(selector).prop('disabled', false);
						toastr.error(response.statusText);
					},
					uploadProgress(event, progress, total, percentComplete) {
						jQuery('#wlim-progress').text(percentComplete);
					}
				});
			}

			/* Actions for result */
			saveWithFiles('.add-result-submit', '#wlim-add-result-form', '#add-result', ['#result-table']);
			saveWithFiles('.update-result-submit', '#wlim-update-result-form', '#update-result', ['#result-table']);
		</script>
		<?php
		die();
	}

	/* Get result data to display on table */
	public static function get_result_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$exam_id  = intval( sanitize_text_field( $_REQUEST['exam'] ) );
		$exam     = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $exam_id" );
		$data     = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = $exam_id" );
		$marks    = unserialize( $exam->marks );
		$course_data = $wpdb->get_results( "SELECT id, course_name, course_code, fees, duration, duration_in FROM {$wpdb->prefix}wl_im_courses ORDER BY course_name", OBJECT_K );

		$batch_data = $wpdb->get_results( "SELECT id, batch_code, batch_name FROM {$wpdb->prefix}wl_im_batches ORDER BY id", OBJECT_K );

		$total_maximum_marks = array_sum( $marks['maximum'] );

		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id = $row->id;
				$marks_obtained = unserialize( $row->marks );
				$total_marks_obtained = array_sum( $marks_obtained );
				$student = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $row->student_id" );
				if ( ! $student ) {
					continue;
				}
				$enrollment_id = WL_IMP_Helper::get_enrollment_id( $student->id );
				$name = $student->first_name;
				if ( $student->last_name ) {
					$name .= " $student->last_name";
				}
				$course = '-';
				$batch  = '-';
				if ( $student->course_id && isset( $course_data[$student->course_id] ) ) {
					$course_name = $course_data[$student->course_id]->course_name;
					$course_code = $course_data[$student->course_id]->course_code;
					$course      = "$course_name ($course_code)";
				}

				if ( $student->batch_id && isset( $batch_data[$student->batch_id] ) ) {
					$batch = $batch_data[$student->batch_id]->batch_code . ' ( ' . $batch_data[$student->batch_id]->batch_name . ' )';
				}

				$percentage = number_format( max( floatval( ( $total_marks_obtained / $total_maximum_marks ) * 100 ), 0 ), 2, '.', '' );

				$results["data"][] = array(
					$enrollment_id,
					$name,
					$course,
					$batch,
					"$percentage %",
					'<a class="mr-3" href="#update-result" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" delete-result-security="' . wp_create_nonce( "delete-result-$id" ) . '"delete-result-id="' . $id . '" class="delete-result"> <i class="fa fa-trash text-danger"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Fetch result to update */
	public static function fetch_result() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id     = intval( sanitize_text_field( $_POST['id'] ) );
		$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND id = $id" );
		if ( ! $result ) {
			die();
		}
		$exam_id =  $result->exam_id;
		$exam    = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $exam_id" );
		if ( ! $exam ) { ?>
			<strong class="text-danger"><?php _e( 'Exam not found.', WL_IMP_DOMAIN ); ?></strong>
		<?php
			die();
		}
		$student = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $result->student_id" );
		if ( ! $student ) {
			die();
		}
		$enrollment_id = WL_IMP_Helper::get_enrollment_id( $student->id );
		$name = $student->first_name;
		if ( $student->last_name ) {
			$name .= " $student->last_name";
		}
		$marks = unserialize( $exam->marks );
		?>
		<div class="row">
			<div class="col">
				<div class="border p-2 mb-2">
				<span class="text-dark"><?php _e( "Exam", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo "$exam->exam_title ( $exam->exam_code )"; ?></strong>
				</div>
				<label class="col-form-label"><strong><?php _e( 'Student Details', WL_IMP_DOMAIN ); ?>:</strong></label>
				<ul class="list-group">
					<li class="list-group-item"><span class="text-dark"><?php _e( "Student ID", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo $enrollment_id; ?></strong></li>
					<li class="list-group-item"><span class="text-dark"><?php _e( "Name", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo $name; ?></strong></li>
				</ul>
			</div>
		</div>
		<?php $nonce = wp_create_nonce( "update-result-$id" ); ?>
	    <input type="hidden" name="update-result-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
	    <input type="hidden" name="action" value="wl-im-update-result">
		<div class="row">
			<div class="col">
				<div class="mb-3 mt-2">
					<label class="col-form-label"><strong>* <?php _e( 'Exam Marks', WL_IMP_DOMAIN ); ?>:</strong></label>
			        <div class="exam_marks_obtained_box">
			            <table class="table table-bordered">
			                <thead>
			                    <tr>
			                        <th><?php _e( 'Subject', WL_IMP_DOMAIN ); ?></th>
			                        <th><?php _e( 'Maximum Marks', WL_IMP_DOMAIN ); ?></th>
			                        <th><?php _e( 'Marks Obtained', WL_IMP_DOMAIN ); ?></th>
			                        <th></th>
			                    </tr>
			                </thead>
			                <tbody class="exam_marks_obtained_rows exam_marks_obtained_table">
			                	<?php
			                	$marks_obtained = null;
								if ( $result ) {
									$marks_obtained = unserialize( $result->marks );
								}
								$total_maximum_marks  = 0;
								$total_marks_obtained = 0;
			                	foreach( $marks['subject'] as $subject_key => $subject_value ) {
			                		$marks_obtained_in_subject = 0;
			                		if ( ! empty( $marks_obtained ) ) {
			                			$marks_obtained_in_subject = $marks_obtained[$subject_key];
			                		}
			                		$total_maximum_marks += $marks['maximum'][$subject_key];
			                		$total_marks_obtained += $marks_obtained_in_subject;
			                	?>
			                    <tr>
			                        <td>
										<span class="text-dark"><?php echo $subject_value; ?></span>
			                        </td>
			                        <td>
										<span class="text-dark"><?php echo $marks['maximum'][$subject_key]; ?></span>
			                        </td>
			                        <td>
										<input required type="number" min="0" step="any" name="marks_obtained[]" class="form-control" placeholder="<?php _e( 'Marks Obtained', WL_IMP_DOMAIN ); ?>" value="<?php echo $marks_obtained_in_subject; ?>">
			                        </td>
			                    </tr>
			                    <?php
			        			} ?>
			        			<tr>
			        				<th><?php _e( 'Total', WL_IMP_DOMAIN ); ?></th>
			        				<th><?php echo $total_maximum_marks; ?></th>
			        				<th><?php echo $total_marks_obtained; ?></th>
			        			</tr>
			        			<tr>
			        				<th></th>
			        				<th><?php _e( 'Percentage', WL_IMP_DOMAIN ); ?></th>
			        				<th><?php echo number_format( max( floatval( ( $total_marks_obtained / $total_maximum_marks ) * 100 ), 0 ), 2, '.', '' ); ?> %</th>
			        			</tr>
			                </tbody>
			            </table>
			        </div>
				</div>
			</div>
		</div>
		<input type="hidden" name="result_id" value="<?php echo $id; ?>">
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/imges/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
	<?php
		die();
	}

	/* Update result */
	public static function update_result() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['result_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-result-$id"], "update-result-$id" ) ) {
			die();
		}
		global $wpdb;

		$marks_obtained = ( isset( $_POST['marks_obtained'] ) && is_array( $_POST['marks_obtained'] ) ) ? $_POST['marks_obtained'] : NULL;

		$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND id = $id" );
		if ( ! $result ) {
			die();
		}

		$exam_id =  $result->exam_id;
		$exam    = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $exam_id" );
		if ( ! $exam ) {
			wp_send_json_error( __( 'Exam not found.', WL_IMP_DOMAIN ) );
		}
		$marks = unserialize( $exam->marks );

		/* Validations */
		$errors = [];
		if ( empty( $marks_obtained ) ) {
			wp_send_json_error( __( 'Please specify marks obtained.', WL_IMP_DOMAIN ) );
		}

		foreach( $marks_obtained as $key => $value ) {
			if ( $value < 0 || ( ! is_numeric( $value ) ) ) {
				wp_send_json_error( __( 'Please provide a valid marks obtained.', WL_IMP_DOMAIN ) );
			} else {
				if ( $marks['maximum'][$key] < $value ) {
					wp_send_json_error( __( 'Marks obtained exceeded maximum marks.', WL_IMP_DOMAIN ) );
				}
				$marks_obtained[$key] = isset( $value ) ? max( floatval( sanitize_text_field( $value ) ), 0 ) : 0;
			}
		}

		$data = array(
			'marks'      => serialize( $marks_obtained ),
		    'updated_at' => date('Y-m-d H:i:s')
		);
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_results", $data, array( 'is_deleted' => 0, 'id' => $id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$wpdb->query( 'COMMIT;' );

				wp_send_json_success( array( 'message' => __( 'Result updated successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Delete result */
	public static function delete_result() {
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-result-$id"], "delete-result-$id" ) ) {
			die();
		}
		global $wpdb;

		try {
			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_results",
					array(
						'is_deleted' => 1,
						'deleted_at' => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'id' => $id )
				);
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$wpdb->query( 'COMMIT;' );
			wp_send_json_success( array( 'message' => __( 'Result removed successfully.', WL_IMP_DOMAIN ) ) );
		} catch ( Exception $exception ) {
	  		$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error( __( $exception->getMessage(), WL_IMP_DOMAIN ) );
		}
	}

	/* Check permission to manage result */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_results' ) ) {
			die();
		}
	}
}