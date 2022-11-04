<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-clipboard"></i> <?php _e( 'Noticeboard', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can either add a new notice or edit existing notices.', WL_IMP_DOMAIN ); ?>
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
						<div class="h3"><?php _e( 'Manage Notices', WL_IMP_DOMAIN ); ?></div>
					</div>
					<div class="col-md-3 col-xs-12">
						<button type="button" class="btn btn-outline-primary float-right add-notice" data-toggle="modal" data-target="#add-notice"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Notice', WL_IMP_DOMAIN ); ?>
						</button>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col">
						<table class="table table-hover table-striped table-bordered" id="notice-table">
							<thead>
								<tr>
						        	<th scope="col"><?php _e( 'Notice Title', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Notice URL', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Priority', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Is Active', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Added On', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Added By', WL_IMP_DOMAIN ); ?></th>
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

<!-- add new notice modal -->
<div class="modal fade" id="add-notice" tabindex="-1" role="dialog" aria-labelledby="add-notice-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-notice-label"><?php _e( 'Add New Notice', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-add-notice-form" enctype="multipart/form-data">
				<div class="modal-body pr-4 pl-4">
					<?php $nonce = wp_create_nonce( 'add-notice' ); ?>
	                <input type="hidden" name="add-notice" value="<?php echo $nonce; ?>">
	                <input type="hidden" name="action" value="wl-im-add-notice">
					<div class="form-group">
						<label for="wlim-notice-title" class="col-form-label">* <?php _e( 'Notice Title', WL_IMP_DOMAIN ); ?>:</label>
						<textarea name="title" class="form-control" rows="3" id="wlim-notice-title" placeholder="<?php _e( "Notice Title", WL_IMP_DOMAIN ); ?>"></textarea>
					</div>
				    <div class="form-group mt-3 pl-0 pt-3 border-top">
				    	<label><?php _e( 'Link to', WL_IMP_DOMAIN ); ?>:</label><br>
				    	<div class="row">
					    	<div class="col">
								<label class="radio-inline"><input type="radio" name="notice_link_to" value="attachment" id="wlim-notice-attachment"><?php _e( 'Attachment', WL_IMP_DOMAIN ); ?></label>
							</div>
					    	<div class="col">
					    		<label class="radio-inline"><input type="radio" name="notice_link_to" value="url" id="wlim-notice-url"><?php _e( 'URL', WL_IMP_DOMAIN ); ?></label>
					    	</div>
				    	</div>
					</div>
					<div class="form-group wlim-notice-attachment">
						<label for="wlim-notice-attachment" class="col-form-label"><?php _e( 'Attachment', WL_IMP_DOMAIN ); ?>:</label><br>
					    <input name="attachment" type="file" id="wlim-notice-attachment">
					</div>
					<div class="form-group wlim-notice-url">
						<label for="wlim-notice-url" class="col-form-label"><?php _e( 'URL', WL_IMP_DOMAIN ); ?>:</label>
						<input name="url" type="text" class="form-control" id="wlim-notice-url" placeholder="<?php _e( "Notice URL", WL_IMP_DOMAIN ); ?>">
					</div>
					<div class="form-group">
						<label for="wlim-notice-priority" class="col-form-label"><?php _e( 'Priority', WL_IMP_DOMAIN ); ?>:</label>
						<input name="priority" type="number" class="form-control" id="wlim-notice-priority" placeholder="<?php _e( "Notice Priority", WL_IMP_DOMAIN ); ?>" step="1" value="10">
					</div>
					<div class="form-check pl-0">
						<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-notice-is_active" checked>
						<label class="form-check-label" for="wlim-notice-is_active">
						<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
						</label>
					</div>
					<div class="wlim-loading text-center mt-3">
						<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
						<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
					<button type="submit" class="btn btn-primary add-notice-submit"><?php _e( 'Add New Notice', WL_IMP_DOMAIN ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end - add new notice modal -->

<!-- update notice modal -->
<div class="modal fade" id="update-notice" tabindex="-1" role="dialog" aria-labelledby="update-notice-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="update-notice-label"><?php _e( 'Update Notice', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-update-notice-form" enctype="multipart/form-data">
			<div class="modal-body pr-4 pl-4" id="fetch_notice"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
					<button type="submit" class="btn btn-primary update-notice-submit"><?php _e( 'Update Notice', WL_IMP_DOMAIN ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end - update notice modal -->