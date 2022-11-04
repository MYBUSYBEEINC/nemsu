<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Notice {
	/* Get notice data to display on table */
	public static function get_notice_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_notices WHERE is_deleted = 0 ORDER BY id DESC" );
		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id        = $row->id;
				$title     = stripcslashes( $row->title );
				$url       = $row->url;
				$priority  = $row->priority;
				$is_acitve = $row->is_active ? __( 'Yes', WL_IMP_DOMAIN ) : __( 'No', WL_IMP_DOMAIN );
				$added_on  = date_format( date_create( $row->created_at ), "d-m-Y g:i A" );
				$added_by  = ( $user = get_userdata( $row->added_by ) ) ? $user->user_login : '-';

				$results["data"][] = array(
					$title,
					$url,
					$priority,
					$is_acitve,
					$added_on,
					$added_by,
					'<a class="mr-3" href="#update-notice" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" delete-notice-security="' . wp_create_nonce( "delete-notice-$id" ) . '"delete-notice-id="' . $id . '" class="delete-notice"> <i class="fa fa-trash text-danger"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Add new notice */
	public static function add_notice() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-notice'], 'add-notice' ) ) {
			die();
		}
		global $wpdb;

		$title      = isset( $_POST['title'] ) ? sanitize_textarea_field( $_POST['title'] ) : '';
		$link_to    = isset( $_POST['notice_link_to'] ) ? sanitize_text_field( $_POST['notice_link_to'] ) : 'url';
		$attachment = ( isset( $_FILES['attachment'] ) && is_array( $_FILES['attachment'] ) ) ? $_FILES['attachment'] : NULL;
		$url        = isset( $_POST['url'] ) ? esc_url_raw( $_POST['url'] ) : NULL;
		$priority   = isset( $_POST['priority'] ) ? intval( sanitize_text_field( $_POST['priority'] ) ) : 10;
		$is_active  = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $title ) ) {
			$errors['title'] = __( 'Please provide notice title.', WL_IMP_DOMAIN );
		}

		if ( empty( $link_to ) ) {
			wp_send_json_error( __( 'Please select notice link.', WL_IMP_DOMAIN ) );
		} else {
			if ( $link_to == 'attachment' ) {
				if( ! empty( $attachment ) ) {
					$file_name = sanitize_file_name( $attachment['name'] );
					$file_type = $attachment['type'];
					$allowed_file_types = WL_IMP_Helper::get_notice_attachment_file_types();

					if( ! in_array( $file_type, $allowed_file_types ) ) {
						$errors['attachment'] = __( 'Please provide attachment in PDF, JPG, JPEG PNG, DOC, DOCX, XLS, XLSX, PPT or PPTX format.', WL_IMP_DOMAIN );
					}
				} else {
					$errors['attachment'] = __( 'Please provide valid attachment.', WL_IMP_DOMAIN );
				}
			} elseif( $link_to == 'url' ) {
				if( empty( $url ) ) {
					$errors['url'] = __( 'Please provide valid url.', WL_IMP_DOMAIN );
				}
			} else {
				wp_send_json_error( __( 'Please select valid notice link.', WL_IMP_DOMAIN ) );
			}
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
			  	$wpdb->query( 'BEGIN;' );

				if( ! empty( $attachment ) ) {
					$attachment = media_handle_upload( 'attachment', 0 );
					if ( is_wp_error( $attachment ) ) {
	  					throw new Exception( __( $attachment->get_error_message(), WL_IMP_DOMAIN ) );
					}
				}

				$data = array(
					'title'      => $title,
				    'url'        => $url,
				    'attachment' => $attachment,
				    'link_to'    => $link_to,
					'priority'   => $priority,
				    'is_active'  => $is_active,
				    'added_by'   => get_current_user_id()
				);

				$success = $wpdb->insert( "{$wpdb->prefix}wl_im_notices", $data );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

		  		$wpdb->query( 'COMMIT;' );
				wp_send_json_success( array( 'message' => __( 'Notice added successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Fetch notice to update */
	public static function fetch_notice() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_notices WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}
		?>
		<?php $nonce = wp_create_nonce( "update-notice-$id" ); ?>
	    <input type="hidden" name="update-notice-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
	    <input type="hidden" name="action" value="wl-im-update-notice">
		<div class="form-group">
			<label for="wlim-notice-title_update" class="col-form-label">* <?php _e( 'Notice Title', WL_IMP_DOMAIN ); ?>:</label>
			<textarea name="title" class="form-control" rows="3" id="wlim-notice-title_update" placeholder="<?php _e( "Notice Title", WL_IMP_DOMAIN ); ?>"><?php echo stripcslashes( $row->title ); ?></textarea>
		</div>
	    <div class="form-group mt-3 pl-0 pt-3 border-top">
	    	<label><?php _e( 'Link to', WL_IMP_DOMAIN ); ?>:</label><br>
	    	<div class="row">
		    	<div class="col">
					<label class="radio-inline"><input type="radio" name="notice_link_to" value="attachment" id="wlim-notice-attachment_update"><?php _e( 'Attachment', WL_IMP_DOMAIN ); ?></label>
				</div>
		    	<div class="col">
		    		<label class="radio-inline"><input type="radio" name="notice_link_to" value="url" id="wlim-notice-url_update"><?php _e( 'URL', WL_IMP_DOMAIN ); ?></label>
		    	</div>
	    	</div>
		</div>
		<div class="form-group wlim-notice-attachment">
			<input type="hidden" name="attachment_in_db" value="<?php echo $row->attachment; ?>">
			<label for="wlim-notice-attachment_update" class="col-form-label"><?php _e( 'Attachment', WL_IMP_DOMAIN ); ?>:</label><br>
		    <?php if( ! empty ( $row->attachment ) ) { ?>
		    <a href="<?php echo wp_get_attachment_url( $row->attachment ); ?>" target="_blank" class="btn btn-sm btn-outline-primary"><?php _e( 'View Attachment', WL_IMP_DOMAIN ); ?></a><br>
			<input type="hidden" name="attachment_in_db" value="<?php echo $row->attachment; ?>">
			<?php } ?>
		    <input name="attachment" type="file" id="wlim-notice-attachment_update">
		</div>
		<div class="form-group wlim-notice-url">
			<label for="wlim-notice-url_update" class="col-form-label"><?php _e( 'URL', WL_IMP_DOMAIN ); ?>:</label>
			<input name="url" type="text" class="form-control" id="wlim-notice-url_update" placeholder="<?php _e( "Notice URL", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->url; ?>">
		</div>
		<div class="form-group">
			<label for="wlim-notice-priority_update" class="col-form-label"><?php _e( 'Priority', WL_IMP_DOMAIN ); ?>:</label>
			<input name="priority" type="number" class="form-control" id="wlim-notice-priority_update" placeholder="<?php _e( "Notice Priority", WL_IMP_DOMAIN ); ?>" step="1" value="<?php echo $row->priority; ?>">
		</div>
		<div class="form-check pl-0">
			<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-notice-is_active_update" <?php echo $row->is_active ? "checked" : ""; ?>>
			<label class="form-check-label" for="wlim-notice-is_active_update">
			<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
			</label>
		</div>
		<input type="hidden" name="notice_id" value="<?php echo $row->id; ?>">
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . '/assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
		<script>
			<?php if( $row->link_to == 'url' ) { ?>
				jQuery('.wlim-notice-attachment').hide();
				jQuery('.wlim-notice-url').show();
				jQuery("input[name=notice_link_to][value='url']").prop("checked", true);
			<?php
			} else { ?>
				jQuery('.wlim-notice-url').hide();
				jQuery('.wlim-notice-attachment').show();
				jQuery("input[name=notice_link_to][value='attachment']").prop("checked", true);
			<?php
			} ?>
		</script>
	<?php
		die();
	}

	/* Update notice */
	public static function update_notice() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['notice_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-notice-$id"], "update-notice-$id" ) ) {
			die();
		}
		global $wpdb;

		$title            = isset( $_POST['title'] ) ? sanitize_textarea_field( $_POST['title'] ) : '';
		$link_to          = isset( $_POST['notice_link_to'] ) ? sanitize_text_field( $_POST['notice_link_to'] ) : 'url';
		$attachment       = ( isset( $_FILES['attachment'] ) && is_array( $_FILES['attachment'] ) ) ? $_FILES['attachment'] : NULL;
		$attachment_in_db = isset( $_POST['attachment_in_db'] ) ? intval( sanitize_text_field( $_POST['attachment_in_db'] ) ) : NULL;
		$url              = isset( $_POST['url'] ) ? esc_url_raw( $_POST['url'] ) : NULL;
		$priority         = isset( $_POST['priority'] ) ? intval( sanitize_text_field( $_POST['priority'] ) ) : 10;
		$is_active        = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		/* Validations */
		$errors = [];
		if ( empty( $link_to ) ) {
			wp_send_json_error( __( 'Please select notice link.', WL_IMP_DOMAIN ) );
		} else {
			if ( $link_to == 'attachment' ) {
				if( ! empty( $attachment ) ) {
					$file_name = sanitize_file_name( $attachment['name'] );
					$file_type = $attachment['type'];
					$allowed_file_types = WL_IMP_Helper::get_notice_attachment_file_types();

					if( ! in_array( $file_type, $allowed_file_types ) ) {
						$errors['attachment'] = __( 'Please provide attachment in PDF, JPG, JPEG PNG, DOC, DOCX, XLS, XLSX, PPT or PPTX format.', WL_IMP_DOMAIN );
					}
				} else {
					if ( empty( $attachment_in_db ) ) {
						$errors['attachment'] = __( 'Please provide valid attachment.', WL_IMP_DOMAIN );
					}
				}
			} elseif( $link_to == 'url' ) {
				if( empty( $url ) ) {
					$errors['url'] = __( 'Please provide valid url.', WL_IMP_DOMAIN );
				}
			} else {
				wp_send_json_error( __( 'Please select valid notice link.', WL_IMP_DOMAIN ) );
			}
		}
		/* End validations */

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				$data = array(
					'title'      => $title,
				    'url'        => $url,
				    'link_to'    => $link_to,
					'priority'   => $priority,
				    'is_active'  => $is_active,
				    'updated_at' => date('Y-m-d H:i:s')
				);

				if( ! empty( $attachment ) ) {					
					$attachment = media_handle_upload( 'attachment', 0 );
					if ( is_wp_error( $attachment ) ) {
	  					throw new Exception( __( $attachment->get_error_message(), WL_IMP_DOMAIN ) );
					}
					$data['attachment'] = $attachment;
				}

				$success = $wpdb->update( "{$wpdb->prefix}wl_im_notices", $data, array( 'is_deleted' => 0, 'id' => $id ) );
				if ( ! $success ) {
		  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
				}

				$wpdb->query( 'COMMIT;' );

				if( ! empty( $attachment ) && ! empty( $attachment_in_db) ) {
					wp_delete_attachment( $attachment_in_db, true );
				}

				wp_send_json_success( array( 'message' => __( 'Notice updated successfully.', WL_IMP_DOMAIN ) ) );
			} catch ( Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}

	/* Delete notice */
	public static function delete_notice() {
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-notice-$id"], "delete-notice-$id" ) ) {
			die();
		}
		global $wpdb;

		try {
			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->update( "{$wpdb->prefix}wl_im_notices",
					array(
						'is_deleted' => 1,
						'deleted_at' => date('Y-m-d H:i:s')
					), array( 'is_deleted' => 0, 'id' => $id )
				);
			if ( ! $success ) {
	  			throw new Exception( __( 'An unexpected error occurred.', WL_IMP_DOMAIN ) );
			}

			$wpdb->query( 'COMMIT;' );
			wp_send_json_success( array( 'message' => __( 'Notice removed successfully.', WL_IMP_DOMAIN ) ) );
		} catch ( Exception $exception ) {
	  		$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error( __( $exception->getMessage(), WL_IMP_DOMAIN ) );
		}
	}

	/* Check permission to manage noticeboard */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_noticeboard' ) ) {
			die();
		}
	}
}