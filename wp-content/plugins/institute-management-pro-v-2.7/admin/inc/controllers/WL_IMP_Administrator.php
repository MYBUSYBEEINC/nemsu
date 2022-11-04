<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Administrator {
	/* Get administrator data to display on table */
	public static function get_administrator_data() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}users ORDER BY id DESC" );
		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id          = $row->ID;
				$first_name  = get_user_meta( $id, 'first_name', true ) ? get_user_meta( $id, 'first_name', true ) : '-';
				$last_name   = get_user_meta( $id, 'last_name', true ) ? get_user_meta( $id, 'last_name', true ) : '-';
				$username    = $row->user_login;
				$permissions = implode( '<br>', array_intersect_key( WL_IMP_Helper::get_capabilities(), array_flip( array_intersect( array_keys( ( new WP_User( $id ) )->allcaps ), array_keys( WL_IMP_Helper::get_capabilities() ) ) ) ) );
				$added_on    = date_format( date_create( $row->user_registered ), "d-m-Y g:i A" );

				$results["data"][] = array(
					$first_name,
					$last_name,
					$username,
					$permissions,
					$added_on,
					'<a class="mr-3" href="#update-administrator" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fa fa-edit"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	/* Add new administrator */
	public static function add_administrator() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_POST['add-administrator'], 'add-administrator' ) ) {
			die();
		}

		$first_name       = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
		$last_name        = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
		$username         = isset( $_POST['username'] ) ? sanitize_text_field( $_POST['username'] ) : '';
		$password         = isset( $_POST['password'] ) ? $_POST['password'] : '';
		$password_confirm = isset( $_POST['password_confirm'] ) ? $_POST['password_confirm'] : '';
		$permissions      = ( isset( $_POST['permissions'] ) && is_array( $_POST['permissions'] ) ) ? $_POST['permissions'] : [];

		$errors = [];
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

		if ( ! array_intersect( $permissions, array_keys( WL_IMP_Helper::get_capabilities() ) ) == $permissions ) {
			wp_send_json_error( __( 'Please select valid permissions.', WL_IMP_DOMAIN ) );
		}

		if ( count( $errors ) < 1 ) {
			$data = array(
				'first_name' => $first_name,
				'last_name'  => $last_name,
			    'user_login' => $username,
			    'user_pass'  => $password
			);

			$user_id = wp_insert_user( $data );
			if ( is_wp_error( $user_id ) ) {
				wp_send_json_error( __( $user_id->get_error_message(), WL_IMP_DOMAIN ) );
			}

			$user = new WP_User( $user_id );
			foreach( $permissions as $capability ) {
				$user->add_cap( $capability );
			}

			wp_send_json_success( array( 'message' => __( 'Administrator added successfully.', WL_IMP_DOMAIN ) ) );
		}
		wp_send_json_error( $errors );
	}

	/* Fetch administrator to update */
	public static function fetch_administrator() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}users WHERE ID = $id" );
		if ( ! $row ) {
			die();
		}
		?>
		<form id="wlim-update-administrator-form">
			<?php $nonce = wp_create_nonce( "update-administrator-$id" ); ?>
		    <input type="hidden" name="update-administrator-<?php echo $id; ?>" value="<?php echo $nonce; ?>">
			<div class="row">
				<div class="col form-group">
					<label for="wlim-administrator-first_name_update" class="col-form-label"><?php _e( 'First Name', WL_IMP_DOMAIN ); ?>:</label>
					<input name="first_name" type="text" class="form-control" id="wlim-administrator-first_name_update" placeholder="<?php _e( "First Name", WL_IMP_DOMAIN ); ?>" value="<?php echo get_user_meta( $id, 'first_name', true ); ?>">
				</div>
				<div class="col form-group">
					<label for="wlim-administrator-last_name_update" class="col-form-label"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?>:</label>
					<input name="last_name" type="text" class="form-control" id="wlim-administrator-last_name_update" placeholder="<?php _e( "Last Name", WL_IMP_DOMAIN ); ?>" value="<?php echo get_user_meta( $id, 'last_name', true ); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="wlim-administrator-username_update" class="col-form-label"><?php _e( 'Username', WL_IMP_DOMAIN ); ?>: <small class="text-secondary"><em><?php _e( "cannot be changed.", WL_IMP_DOMAIN ); ?></em></small></label>
				<input name="username" type="text" class="form-control" id="wlim-administrator-username_update" placeholder="<?php _e( "Username", WL_IMP_DOMAIN ); ?>" value="<?php echo $row->user_login; ?>" disabled>
			</div>
			<div class="form-group">
				<label for="wlim-administrator-password_update" class="col-form-label"><?php _e( 'Password', WL_IMP_DOMAIN ); ?>:</label>
				<input name="password" type="password" class="form-control" id="wlim-administrator-password_update" placeholder="<?php _e( "Password", WL_IMP_DOMAIN ); ?>">
			</div>
			<div class="form-group">
				<label for="wlim-administrator-password_confirm_update" class="col-form-label"><?php _e( 'Confirm Password', WL_IMP_DOMAIN ); ?>:</label>
				<input name="password_confirm" type="password" class="form-control" id="wlim-administrator-password_confirm_update" placeholder="<?php _e( "Confirm Password", WL_IMP_DOMAIN ); ?>">
			</div>
			<label class="col-form-label"><?php _e( 'Permissions', WL_IMP_DOMAIN ); ?>: 
				<?php
				if ( user_can( $row->ID, WL_IMP_Helper::$core_capability ) ) { ?>
					<small class="text-secondary"><em><?php _e( "cannot be changed for users with role 'Administrator'.", WL_IMP_DOMAIN ); ?></em></small>
			    <?php
			    } ?>
			</label>
			<?php
			foreach( WL_IMP_Helper::get_capabilities() as $capability_key => $capability_value ) { ?>
			<div class="form-check pl-0">
				<input name="permissions[]" class="position-static mt-0 form-check-input" type="checkbox" id="<?php echo $capability_key."_update"; ?>" value="<?php echo $capability_key; ?>" <?php echo user_can( $row->ID, WL_IMP_Helper::$core_capability ) ? 'disabled' : '' ?>>
				<label class="form-check-label" for="<?php echo $capability_key."_update"; ?>"><?php _e( $capability_value, WL_IMP_DOMAIN ); ?></label>
			</div>
			<?php
			} ?>
			<input type="hidden" name="administrator_id" value="<?php echo $row->ID; ?>">
		</form>
		<script>
			<?php
			$permissions = array_intersect( array_keys( ( new WP_User( $id ) )->allcaps ), array_keys( WL_IMP_Helper::get_capabilities() ) );
			foreach( $permissions as $capability ) { ?>
			jQuery("#<?php echo $capability."_update"; ?>").prop('checked', true);
			<?php
			} ?>
		</script>
	<?php
		die();
	}

	/* Update administrator */
	public static function update_administrator() {
		self::check_permission();
		$id = intval( sanitize_text_field( $_POST['administrator_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-administrator-$id"], "update-administrator-$id" ) ) {
			die();
		}
		global $wpdb;

		$first_name       = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
		$last_name        = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
		$password         = isset( $_POST['password'] ) ? $_POST['password'] : '';
		$password_confirm = isset( $_POST['password_confirm'] ) ? $_POST['password_confirm'] : '';
		$permissions      = ( isset( $_POST['permissions'] ) && is_array( $_POST['permissions'] ) ) ? $_POST['permissions'] : [];

		$errors = [];
		if ( ! empty( $password ) && ( $password !== $password_confirm ) ) {
			$errors['password_confirm'] = __( 'Please confirm password.', WL_IMP_DOMAIN );
		}

		if ( ! array_intersect( $permissions, array_keys( WL_IMP_Helper::get_capabilities() ) ) == $permissions ) {
			wp_send_json_error( __( 'Please select valid permissions.', WL_IMP_DOMAIN ) );
		}

		if ( count( $errors ) < 1 ) {
			$data = array(
				'ID'         => $id,
				'first_name' => $first_name,
				'last_name'  => $last_name
			);

			$reload = false;
			if ( ! empty( $password ) ) {
				$data['user_pass'] = $password;
				if( get_current_user_id() == $id ) {
					$reload = true;
				}
			}

			$user_id = wp_update_user( $data );
			if ( is_wp_error( $user_id ) ) {
				wp_send_json_error( __( $user_id->get_error_message(), WL_IMP_DOMAIN ) );
			}

			$user = new WP_User( $user_id );

			if ( ! user_can( $user, WL_IMP_Helper::$core_capability ) ) {
				foreach( WL_IMP_Helper::get_capabilities() as $capability_key => $capability_value ) {
					if ( in_array( $capability_key, $permissions ) ) {
						$user->add_cap( $capability_key );
					} else {
						$user->remove_cap( $capability_key );
					}
				}
			}

	  		wp_send_json_success( array( 'message' => __( 'Administrator updated successfully.', WL_IMP_DOMAIN ), 'reload' => $reload ) );
		}
		wp_send_json_error( $errors );
	}

	/* Check permission to manage administrator */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_administrators' ) ) {
			die();
		}
	}
}