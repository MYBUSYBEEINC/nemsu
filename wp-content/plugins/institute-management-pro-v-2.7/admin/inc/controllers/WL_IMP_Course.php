<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Course {
	/* Get course data to display on table */
	public static function get_course_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 ORDER BY id DESC" );
		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id          = $row->id;
				$course_code = $row->course_code;
				$course_name = $row->course_name ? $row->course_name : '-';
				$duration    = $row->duration;
				$duration_in = $row->duration_in;
				$duration_in = ( $duration < 2 ) ? __( substr( $duration_in, 0, -1 ), WL_IMP_DOMAIN ) : __( $duration_in, 0, -1, WL_IMP_DOMAIN );
				$fees        = $row->fees;
				$is_acitve   = $row->is_active ? __( 'Yes', WL_IMP_DOMAIN ) : __( 'No', WL_IMP_DOMAIN );
				$added_on    = date_format( date_create( $row->created_at ), "d-m-Y g:i A" );
				$added_by    = ( $user = get_userdata( $row->added_by ) ) ? $user->user_login : '-';

				$count_former_students = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND course_id = $row->id AND course_completed = 1" );
				$count_current_students = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND course_id = $row->id AND course_completed = 0 AND is_active = 1" );

				$results["data"][] = array(
					$course_code,
					$course_name,
					"$duration $duration_in",
					$fees,
					'<a class="text-primary" href="' . admin_url( 'admin.php?page=institute-management-pro-students' ) . '&status=current&course_id=' . $id . '">' . $count_current_students . '</a>',
					'<a class="text-primary" href="' . admin_url( 'admin.php?page=institute-management-pro-students' ) . '&status=former&course_id=' . $id . '">' . $count_former_students . '</a>',
					$is_acitve,
					$added_on,
					$added_by,
					'<a class="mr-3" href="#update-course" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" delete-course-security="' . wp_create_nonce( "delete-course-$id" ) . '"delete-course-id="' . $id . '" class="delete-course"> <i class="fa fa-trash text-danger"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Add new course */
	public static function add_course() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-course'], 'add-course' ) ) {
			die();
		}
		global $wpdb;

		$course_code   = isset( $_POST['course_code'] ) ? sanitize_text_field( $_POST['course_code'] ) : '';
		$course_name   = isset( $_POST['course_name'] ) ? sanitize_text_field( $_POST['course_name'] ) : '';
		$course_detail = isset( $_POST['course_detail'] ) ? sanitize_textarea_field( $_POST['course_detail'] ) : '';
		$duration      = isset( $_POST['duration'] ) ? intval( sanitize_text_field( $_POST['duration'] ) ) : 0;
		$duration_in   = isset( $_POST['duration_in'] ) ? sanitize_text_field( $_POST['duration_in'] ) : '';
		$fees          = number_format( isset( $_POST['fees'] ) ? max( floatval( sanitize_text_field( $_POST['fees'] ) ), 0 ) : 0, 2, '.', '' );
		$is_active     = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $course_code ) ) {
			$errors['course_code'] = __( 'Please provide course code.', WL_IMP_DOMAIN );
		}

		if ( strlen( $course_code ) > 191 ) {
			$errors['course_code'] = __( 'Maximum length cannot exceed 191 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $course_name ) > 255 ) {
			$errors['course_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( $duration < 1 ) {
			$errors['duration'] = __( 'Duration must be at least 1.', WL_IMP_DOMAIN );
		}

		if ( ! in_array( $duration_in, WL_IMP_Helper::get_duration_in() ) ) {
			$errors['duration_in'] = __( 'Please select valid duration in.', WL_IMP_DOMAIN );
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND course_code = '$course_code'" );

		if ( $count ) {
			$errors['course_code'] = __( 'Course code already exists.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
			  	$wpdb->query( 'BEGIN;' );

				$data = array(
					'course_code'   => $course_code,
					'course_name'   => $course_name,
				    'course_detail' => $course_detail,
				    'duration'      => $duration,
				    'duration_in'   => $duration_in,
				    'fees'          => $fees,
				    'is_active'     => $is_active,
				    'added_by'      => get_current_user_id()
				);

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_courses", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

		  		$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Course added successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Fetch course to update */
	public static function fetch_course() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}
		?>
		<form id="wlim-update-course-form">
			<?php $nonce = wp_create_nonce( "update-course-$id" ); ?>
		    <input type="hidden" name="update-course-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
		    <div class="row">
				<div class="col form-group">
					<label for="wlim-course-course_code_update" class="col-form-label"><?php _e( 'Course Code', WL_IMP_DOMAIN ); ?>:</label>
					<input name="course_code" type="text" class="form-control" id="wlim-course-course_code_update" placeholder="<?php _e( "Course Code", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->course_code; ?>">
				</div>
				<div class="col form-group">
					<label for="wlim-course-course_name_update" class="col-form-label"><?php _e( 'Course Name', WL_IMP_DOMAIN ); ?>:</label>
					<input name="course_name" type="text" class="form-control" id="wlim-course-course_name_update" placeholder="<?php _e( "Course Name", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->course_name; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="wlim-course-course_detail_update" class="col-form-label"><?php _e( 'Course Detail', WL_IMP_DOMAIN ); ?>:</label>
				<textarea name="course_detail" class="form-control" rows="3" id="wlim-course-course_detail_update" placeholder="<?php _e( "Course Detail", WL_IMP_DOMAIN ); ?>"><?php echo $row->course_detail; ?></textarea>
			</div>
			<div class="row">
				<div class="col form-group">
					<label for="wlim-course-duration_update" class="col-form-label"><?php _e( 'Duration', WL_IMP_DOMAIN ); ?>:</label>
					<input name="duration" type="number" class="form-control" id="wlim-course-duration_update" placeholder="<?php _e( "Duration", WL_IMP_DOMAIN ); ?>" step="1" min="0" value="<?php echo $row->duration; ?>">
				</div>
				<div class="col form-group wlim_select_col">
					<label for="wlim-course-duration_in_update" class="pt-2"><?php _e( 'Duration In', WL_IMP_DOMAIN ); ?>:</label>
					<select name="duration_in" class="form-control" id="wlim-course-duration_in_update">
						<?php
						foreach( WL_IMP_Helper::get_duration_in() as $value ) { ?>
						<option value="<?php echo $value; ?>"><?php _e( $value, WL_IMP_DOMAIN ); ?></option>
						<?php
						} ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="wlim-course-fees_update" class="col-form-label"><?php _e( 'Fees', WL_IMP_DOMAIN ); ?>:</label>
				<input name="fees" type="number" class="form-control" id="wlim-course-fees_update" placeholder="<?php _e( "Fees", WL_IMP_DOMAIN ); ?>" min="0" value="<?php echo $row->fees; ?>">
			</div>
			<div class="form-check pl-0">
				<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-course-is_active_update" <?php echo $row->is_active ? "checked" : ""; ?>>
				<label class="form-check-label" for="wlim-course-is_active_update">
				<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
				</label>
			</div>
			<input type="hidden" name="course_id" value="<?php echo $row->id; ?>">
		</form>
		<script>
	    	jQuery("#wlim-course-duration_in_update").val("<?php echo $row->duration_in; ?>");
		</script>
	<?php
		die();
	}

	/* Update course */
	public static function update_course() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['course_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-course-$id"], "update-course-$id" ) ) {
			die();
		}
		global $wpdb;

		$course_code   = isset( $_POST['course_code'] ) ? sanitize_text_field( $_POST['course_code'] ) : '';
		$course_name   = isset( $_POST['course_name'] ) ? sanitize_text_field( $_POST['course_name'] ) : '';
		$course_detail = isset( $_POST['course_detail'] ) ? sanitize_textarea_field( $_POST['course_detail'] ) : '';
		$duration      = isset( $_POST['duration'] ) ? intval( sanitize_text_field( $_POST['duration'] ) ) : 0;
		$duration_in   = isset( $_POST['duration_in'] ) ? sanitize_text_field( $_POST['duration_in'] ) : '';
		$fees          = number_format( isset( $_POST['fees'] ) ? max( floatval( sanitize_text_field( $_POST['fees'] ) ), 0 ) : 0, 2, '.', '' );
		$is_active     = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $course_code ) ) {
			$errors['course_code'] = __( 'Please provide course code.', WL_IMP_DOMAIN );
		}

		if ( strlen( $course_code ) > 191 ) {
			$errors['course_code'] = __( 'Maximum length cannot exceed 191 characters.', WL_IMP_DOMAIN );
		}

		if ( strlen( $course_name ) > 255 ) {
			$errors['course_name'] = __( 'Maximum length cannot exceed 255 characters.', WL_IMP_DOMAIN );
		}

		if ( $duration < 1 ) {
			$errors['duration'] = __( 'Duration must be at least 1.', WL_IMP_DOMAIN );
		}

		if ( ! in_array( $duration_in, WL_IMP_Helper::get_duration_in() ) ) {
			$errors['duration_in'] = __( 'Please select valid duration in.', WL_IMP_DOMAIN );
		}

		$count = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}wl_im_courses WHERE is_deleted = 0 AND id != $id AND course_code = '$course_code'" );

		if ( $count ) {
			$errors['course_code'] = __( 'Course code already exists.', WL_IMP_DOMAIN );
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				$data = array(
					'course_code'   => $course_code,
					'course_name'   => $course_name,
				    'course_detail' => $course_detail,
				    'duration'      => $duration,
				    'duration_in'   => $duration_in,
				    'fees'          => $fees,
				    'is_active'     => $is_active,
				    'updated_at'    => date('Y-m-d H:i:s')
				);

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_courses", $data, array( 'is_deleted' => 0, 'id' => $id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Course updated successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Delete course */
	public static function delete_course() {
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-course-$id"], "delete-course-$id" ) ) {
			die();
		}
		global $wpdb;

		try {
			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_courses",
					array(
						'is_deleted' => 1,
						'deleted_at' => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'id' => $id )
				);
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$wpdb->query( 'COMMIT;' );
			wp_send_json_success( array( 'message' => __( 'Course removed successfully.', WL_IMP_DOMAIN ) ) );
		} catch ( Exception $exception ) {
	  		$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error( __( $exception->getMessage(), WL_IMP_DOMAIN ) );
		}
	}

	/* Check permission to manage course */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_courses' ) ) {
			die();
		}
	}
}