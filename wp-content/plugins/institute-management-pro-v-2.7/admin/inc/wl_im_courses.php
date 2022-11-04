<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-graduation-cap"></i> <?php _e( 'Courses', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can either add a new course or edit existing courses.', WL_IMP_DOMAIN ); ?>
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
						<div class="h3"><?php _e( 'Manage Courses', WL_IMP_DOMAIN ); ?></div>
					</div>
					<div class="col-md-3 col-xs-12">
						<button type="button" class="btn btn-outline-primary float-right add-course" data-toggle="modal" data-target="#add-course"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Course', WL_IMP_DOMAIN ); ?>
						</button>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col">
						<table class="table table-hover table-striped table-bordered" id="course-table">
							<thead>
								<tr>
						        	<th scope="col"><?php _e( 'Course Code', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Course Name', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Duration', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Fees', WL_IMP_DOMAIN ); ?></th>
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

<!-- add new course modal -->
<div class="modal fade" id="add-course" tabindex="-1" role="dialog" aria-labelledby="add-course-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-course-label"><?php _e( 'Add New Course', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4">
				<form id="wlim-add-course-form">
					<?php $nonce = wp_create_nonce( 'add-course' ); ?>
	                <input type="hidden" name="add-course" value="<?php echo $nonce; ?>">
					<div class="row">
						<div class="col form-group">
							<label for="wlim-course-course_code" class="col-form-label"><?php _e( 'Course Code', WL_IMP_DOMAIN ); ?>:</label>
							<input name="course_code" type="text" class="form-control" id="wlim-course-course_code" placeholder="<?php _e( "Course Code", WL_IMP_DOMAIN ); ?>">
						</div>
						<div class="col form-group">
							<label for="wlim-course-course_name" class="col-form-label"><?php _e( 'Course Name', WL_IMP_DOMAIN ); ?>:</label>
							<input name="course_name" type="text" class="form-control" id="wlim-course-course_name" placeholder="<?php _e( "Course Name", WL_IMP_DOMAIN ); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="wlim-course-course_detail" class="col-form-label"><?php _e( 'Course Detail', WL_IMP_DOMAIN ); ?>:</label>
						<textarea name="course_detail" class="form-control" rows="3" id="wlim-course-course_detail" placeholder="<?php _e( "Course Detail", WL_IMP_DOMAIN ); ?>"></textarea>
					</div>
					<div class="row">
						<div class="col form-group">
							<label for="wlim-course-duration" class="col-form-label"><?php _e( 'Duration', WL_IMP_DOMAIN ); ?>:</label>
							<input name="duration" type="number" class="form-control" id="wlim-course-duration" placeholder="<?php _e( "Duration", WL_IMP_DOMAIN ); ?>" step="1" min="0">
						</div>
						<div class="col form-group wlim_select_col">
							<label for="wlim-course-duration_in" class="pt-2"><?php _e( 'Duration In', WL_IMP_DOMAIN ); ?>:</label>
							<select name="duration_in" class="form-control" id="wlim-course-duration_in">
								<?php
								foreach( WL_IMP_Helper::get_duration_in() as $value ) { ?>
								<option value="<?php echo $value; ?>"><?php _e( $value, WL_IMP_DOMAIN ); ?></option>
								<?php
								} ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="wlim-course-fees" class="col-form-label"><?php _e( 'Fees', WL_IMP_DOMAIN ); ?>:</label>
						<input name="fees" type="number" class="form-control" id="wlim-course-fees" placeholder="<?php _e( "Fees", WL_IMP_DOMAIN ); ?>" min="0">
					</div>
					<div class="form-check pl-0">
						<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-course-is_active" checked>
						<label class="form-check-label" for="wlim-course-is_active">
						<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
						</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary add-course-submit"><?php _e( 'Add New Course', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - add new course modal -->

<!-- update course modal -->
<div class="modal fade" id="update-course" tabindex="-1" role="dialog" aria-labelledby="update-course-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="update-course-label"><?php _e( 'Update Course', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="fetch_course"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary update-course-submit"><?php _e( 'Update Course', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - update course modal -->