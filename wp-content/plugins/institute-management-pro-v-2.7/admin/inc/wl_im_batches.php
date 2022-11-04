<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

$wlim_active_courses = WL_IMP_Helper::get_active_courses();
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-object-group"></i> <?php _e( 'Batches', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can either add a new batch or edit existing batches.', WL_IMP_DOMAIN ); ?>
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
						<div class="h3"><?php _e( 'Manage Batches', WL_IMP_DOMAIN ); ?></div>
					</div>
					<div class="col-md-3 col-xs-12">
						<button type="button" class="btn btn-outline-primary float-right add-batch" data-toggle="modal" data-target="#add-batch"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Batch', WL_IMP_DOMAIN ); ?>
						</button>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col">
						<table class="table table-hover table-striped table-bordered" id="batch-table">
							<thead>
								<tr>
						        	<th scope="col"><?php _e( 'Batch Code', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Batch Name', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Course', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Current Students', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Former Students', WL_IMP_DOMAIN ); ?></th>
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

<!-- add new batch modal -->
<div class="modal fade" id="add-batch" tabindex="-1" role="dialog" aria-labelledby="add-batch-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-batch-label"><?php _e( 'Add New Batch', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4">
				<form id="wlim-add-batch-form">
					<?php $nonce = wp_create_nonce( 'add-batch' ); ?>
	                <input type="hidden" name="add-batch" value="<?php echo $nonce; ?>">
		            <div class="form-group wlim-selectpicker">
		                <label for="wlim-batch-course" class="col-form-label">* <?php _e( "Course", WL_IMP_DOMAIN ); ?>:</label>
		                <select name="course" class="form-control selectpicker" id="wlim-batch-course">
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
							<label for="wlim-batch-batch_code" class="col-form-label">* <?php _e( 'Batch Code', WL_IMP_DOMAIN ); ?>:</label>
							<input name="batch_code" type="text" class="form-control" id="wlim-course-batch_code" placeholder="<?php _e( "Batch Code", WL_IMP_DOMAIN ); ?>">
						</div>
						<div class="col form-group">
							<label for="wlim-batch-batch_name" class="col-form-label"><?php _e( 'Batch Name', WL_IMP_DOMAIN ); ?>:</label>
							<input name="batch_name" type="text" class="form-control" id="wlim-batch-batch_name" placeholder="<?php _e( "Batch Name", WL_IMP_DOMAIN ); ?>">
						</div>
					</div>
					<div class="form-check pl-0">
						<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-batch-is_active" checked>
						<label class="form-check-label" for="wlim-batch-is_active">
						<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
						</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary add-batch-submit"><?php _e( 'Add New Batch', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - add new batch modal -->

<!-- update batch modal -->
<div class="modal fade" id="update-batch" tabindex="-1" role="dialog" aria-labelledby="update-batch-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="update-batch-label"><?php _e( 'Update Batch', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="fetch_batch"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary update-batch-submit"><?php _e( 'Update Batch', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - update batch modal -->