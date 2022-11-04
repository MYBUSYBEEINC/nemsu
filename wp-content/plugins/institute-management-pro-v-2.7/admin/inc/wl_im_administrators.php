<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-user-secret"></i> <?php _e( 'Users and Administrators', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can either add a new administrator or assign administrative permissions to existing users.', WL_IMP_DOMAIN ); ?>
			</div>
			<!-- end main header content -->
		</div>
	</div>
	<!-- end - row 1 -->

	<!-- row 2 -->
	<div class="row">
		<div class="card col">
			<div class="card-header">
				<!-- card header content -->
				<div class="row">
					<div class="col-md-9 col-xs-12">
						<div class="h3"><?php _e( 'Manage Users and Administrators', WL_IMP_DOMAIN ); ?></div>
					</div>
					<div class="col-md-3 col-xs-12">
						<button type="button" class="btn btn-outline-primary float-right add-administrator" data-toggle="modal" data-target="#add-administrator"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Administrator', WL_IMP_DOMAIN ); ?>
						</button>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col">
						<table class="table table-hover table-striped table-bordered" id="administrator-table">
							<thead>
								<tr>
						        	<th scope="col"><?php _e( 'First Name', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Username', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Permissions', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Added On', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Edit', WL_IMP_DOMAIN ); ?></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
	<!-- end - row 2 -->
</div>

<!-- add new administrator modal -->
<div class="modal fade" id="add-administrator" tabindex="-1" role="dialog" aria-labelledby="add-administrator-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-administrator-label"><?php _e( 'Add New Administrator', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4">
				<form id="wlim-add-administrator-form">
					<?php $nonce = wp_create_nonce( 'add-administrator' ); ?>
	                <input type="hidden" name="add-administrator" value="<?php echo $nonce; ?>">
					<div class="row">
						<div class="col form-group">
							<label for="wlim-administrator-first_name" class="col-form-label"><?php _e( 'First Name', WL_IMP_DOMAIN ); ?>:</label>
							<input name="first_name" type="text" class="form-control" id="wlim-administrator-first_name" placeholder="<?php _e( "First Name", WL_IMP_DOMAIN ); ?>">
						</div>
						<div class="col form-group">
							<label for="wlim-administrator-last_name" class="col-form-label"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?>:</label>
							<input name="last_name" type="text" class="form-control" id="wlim-administrator-last_name" placeholder="<?php _e( "Last Name", WL_IMP_DOMAIN ); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="wlim-administrator-username" class="col-form-label"><?php _e( 'Username', WL_IMP_DOMAIN ); ?>:</label>
						<input name="username" type="text" class="form-control" id="wlim-administrator-username" placeholder="<?php _e( "Username", WL_IMP_DOMAIN ); ?>">
					</div>
					<div class="form-group">
						<label for="wlim-administrator-password" class="col-form-label"><?php _e( 'Password', WL_IMP_DOMAIN ); ?>:</label>
						<input name="password" type="password" class="form-control" id="wlim-administrator-password" placeholder="<?php _e( "Password", WL_IMP_DOMAIN ); ?>">
					</div>
					<div class="form-group">
						<label for="wlim-administrator-password_confirm" class="col-form-label"><?php _e( 'Confirm Password', WL_IMP_DOMAIN ); ?>:</label>
						<input name="password_confirm" type="password" class="form-control" id="wlim-administrator-password_confirm" placeholder="<?php _e( "Confirm Password", WL_IMP_DOMAIN ); ?>">
					</div>
					<label class="col-form-label"><?php _e( 'Permissions', WL_IMP_DOMAIN ); ?>:</label>
					<?php
					foreach( WL_IMP_Helper::get_capabilities() as $capability_key => $capability_value ) { ?>
					<div class="form-check pl-0">
						<input name="permissions[]" class="position-static mt-0 form-check-input" type="checkbox" id="<?php echo $capability_key; ?>" value="<?php echo $capability_key; ?>">
						<label class="form-check-label" for="<?php echo $capability_key; ?>"><?php _e( $capability_value, WL_IMP_DOMAIN ); ?></label>
					</div>
					<?php
					} ?>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary add-administrator-submit"><?php _e( 'Add New Administrator', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - add new administrator modal -->

<!-- update administrator modal -->
<div class="modal fade" id="update-administrator" tabindex="-1" role="dialog" aria-labelledby="update-administrator-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="update-administrator-label"><?php _e( 'Update Administrator', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="fetch_administrator"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary update-administrator-submit"><?php _e( 'Update Administrator', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - update administrator modal -->