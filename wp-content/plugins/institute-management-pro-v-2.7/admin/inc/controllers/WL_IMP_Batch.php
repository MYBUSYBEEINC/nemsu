<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Batch {
	/* Get batch data to display on table */
	public static function get_batch_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 ORDER BY id DESC" );
		$course_data = $wpdb->get_results( "SELECT id, course_name, course_code FROM {$wpdb->prefix}wl_im_courses ORDER BY course_name", OBJECT_K );

		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id         = $row->id;
				$batch_code = $row->batch_code;
				$batch_name = $row->batch_name ? $row->batch_name : '-';
				$is_acitve  = $row->is_active ? __( 'Yes', WL_IMP_DOMAIN ) : __( 'No', WL_IMP_DOMAIN );
				$added_on   = date_format( date_create( $row->created_at ), "d-m-Y g:i A" );
				$added_by   = ( $user = get_userdata( $row->added_by ) ) ? $user->user_login : '-';

				$count_former_students  = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND batch_id = $row->id AND course_completed = 1" );
				$count_current_students = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND batch_id = $row->id AND course_completed = 0 AND is_active = 1" );

				$course = '-';
				if ( $row->course_id && isset( $course_data[$row->course_id] ) ) {
					$course_name = $course_data[$row->course_id]->course_name;
					$course_code = $course_data[$row->course_id]->course_code;
					$course      = "$course_name ($course_code)";
				}

				$results["data"][] = array(
					$batch_code,
					$batch_name,
					$course,
					'<a class="text-primary" href="' . admin_url( 'admin.php?page=institute-management-pro-students' ) . '&status=current&course_id=' . $row->course_id . '&batch_id=' . $id . '">' . $count_current_students . '</a>',
					'<a class="text-primary" href="' . admin_url( 'admin.php?page=institute-management-pro-students' ) . '&status=former&course_id=' . $row->course_id . '&batch_id=' . $id . '">' . $count_former_students . '</a>',
					$is_acitve,
					$added_on,
					$added_by,
					'<a class="mr-3" href="#update-batch" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" delete-batch-security="' . wp_create_nonce( "delete-batch-$id" ) . '"delete-batch-id="' . $id . '" class="delete-batch"> <i class="fa fa-trash text-danger"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Add new batch */
	public static function add_batch() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-batch'], 'add-batch' ) ) {
			die();
		}
		global $wpdb;

		$course_id  = isset( $_POST['course'] ) ? intval( sanitize_text_field( $_POST['course'] ) ) : NULL;
		$batch_code = isset( $_POST['batch_code'] ) ? sanitize_text_field( $_POST['batch_code'] ) : '';
		$batch_name = isset( $_POST['batch_name'] ) ? sanitize_text_field( $_POST['batch_name'] ) : '';
		$is_active  = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $course_id ) ) {
			$errors['course'] = __( 'Please select a course.', WL_IMP_DOMAIN );
		}

		if ( empty( $batch_code ) ) {
			$errors['batch_code'] = __( 'Please provide batch code.', WL_IMP_DOMAIN );
		}

		if ( strlen( $batch_code ) > 191 ) {
			$errors['batch_code'] = __( 'Maximum length cannot exceed 191 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $batch_name ) > 255 ) {
			$errors['batch_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 AND id = $course_id" );

		if ( ! $count ) {
			$errors['course'] = __( 'Please select a valid course.', WL_IMP_DOMAIN );
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND batch_code = '$batch_code' AND course_id = '$course_id'" );

		if ( $count ) {
			$errors['batch_code'] = __( 'Batch code in this course already exists.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
			  	$wpdb->query( 'BEGIN;' );

				$data = array(
					'course_id'  => $course_id,
					'batch_code' => $batch_code,
					'batch_name' => $batch_name,
				    'is_active'  => $is_active,
				    'added_by'   => get_current_user_id()
				);

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_batches", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

		  		$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Batch added successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Fetch batch to update */
	public static function fetch_batch() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}
		$wlim_active_courses = WL_IMP_Helper::get_active_courses();
		?>
		<form id="wlim-update-batch-form">
			<?php $nonce = wp_create_nonce( "update-batch-$id" ); ?>
		    <input type="hidden" name="update-batch-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
			<div class="form-group">
	            <label for="wlim-batch-course_update" class="col-form-label">* <?php _e( "Course", WL_IMP_DOMAIN ); ?>:</label>
	            <select name="course" class="form-control selectpicker" id="wlim-batch-course_update">
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
				<div class="col form-group">
					<label for="wlim-batch-batch_code_update" class="col-form-label">* <?php _e( 'Batch Code', WL_IMP_DOMAIN ); ?>:</label>
					<input name="batch_code" type="text" class="form-control" id="wlim-batch-batch_code_update" placeholder="<?php _e( "Batch Code", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->batch_code; ?>">
				</div>
				<div class="col form-group">
					<label for="wlim-batch-batch_name_update" class="col-form-label"><?php _e( 'Batch Name', WL_IMP_DOMAIN ); ?>:</label>
					<input name="batch_name" type="text" class="form-control" id="wlim-batch-batch_name_update" placeholder="<?php _e( "Batch Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->batch_name; ?>">
				</div>
			</div>
			<div class="form-check pl-0">
				<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-batch-is_active_update" <?php echo $row->is_active ? "checked" : ""; ?>>
				<label class="form-check-label" for="wlim-batch-is_active_update">
				<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
				</label>
			</div>
			<input type="hidden" name="batch_id" value="<?php echo $row->id; ?>">
		</form>
		<script>
			/* Select single option */
			jQuery('#wlim-batch-course_update').selectpicker({
				liveSearch: true
			});
			jQuery('#wlim-batch-course_update').selectpicker('val', '<?php echo $row->course_id; ?>');
		</script>
	<?php
		die();
	}

	/* Update batch */
	public static function update_batch() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['batch_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-batch-$id"], "update-batch-$id" ) ) {
			die();
		}
		global $wpdb;

		$course_id  = isset( $_POST['course'] ) ? intval( sanitize_text_field( $_POST['course'] ) ) : NULL;
		$batch_code = isset( $_POST['batch_code'] ) ? sanitize_text_field( $_POST['batch_code'] ) : '';
		$batch_name = isset( $_POST['batch_name'] ) ? sanitize_text_field( $_POST['batch_name'] ) : '';
		$is_active  = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $course_id ) ) {
			$errors['course'] = __( 'Please select a course.', WL_IMP_DOMAIN );
		}

		if ( empty( $batch_code ) ) {
			$errors['batch_code'] = __( 'Please provide batch code.', WL_IMP_DOMAIN );
		}

		if ( strlen( $batch_code ) > 191 ) {
			$errors['batch_code'] = __( 'Maximum length cannot exceed 191 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $batch_name ) > 255 ) {
			$errors['batch_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND is_active = 1 AND id = $course_id" );

		if ( ! $count ) {
			$errors['course'] = __( 'Please select a valid course.', WL_IMP_DOMAIN );
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_batches WHERE is_deleted = 0 AND id != $id AND batch_code = '$batch_code' AND course_id = '$course_id'" );

		if ( $count ) {
			$errors['batch_code'] = __( 'Batch code in this course already exists.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				$data = array(
					'course_id'  => $course_id,
					'batch_code' => $batch_code,
					'batch_name' => $batch_name,
				    'is_active'  => $is_active,
				    'updated_at' => date('Y-m-d H:i:s')
				);

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_batches", $data, array( 'is_deleted' => 0, 'id' => $id ) );
				if ( ! $success ) {
					var_dump($wpdb->last_error);
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Batch updated successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Delete batch */
	public static function delete_batch() {
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-batch-$id"], "delete-batch-$id" ) ) {
			die();
		}
		global $wpdb;

		try {
			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_batches",
					array(
						'is_deleted' => 1,
						'deleted_at' => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'id' => $id )
				);
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$wpdb->query( 'COMMIT;' );
			wp_send_json_success( array( 'message' => __( 'Batch removed successfully.', WL_IMP_DOMAIN ) ) );
		} catch ( Exception $exception ) {
	  		$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error( __( $exception->getMessage(), WL_IMP_DOMAIN ) );
		}
	}

	/* Check permission to manage batch */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_batches' ) ) {
			die();
		}
	}
}