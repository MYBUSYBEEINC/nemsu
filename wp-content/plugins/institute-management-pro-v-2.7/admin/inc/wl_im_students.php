<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/controllers/WL_IMP_Student.php' );

$wlim_active_courses = WL_IMP_Helper::get_active_courses();

$filters_applied = false;
if ( isset( $_GET['status'] ) ) {
	$status = esc_attr( $_GET['status'] );
	if ( $status == 'current' ) {
		$status_output = __( 'Current', WL_IMP_DOMAIN );
		$filters_applied = true;
	} elseif ( $status == 'former' ) {
		$status_output = __( 'Former', WL_IMP_DOMAIN );
		$filters_applied = true;
	}
}
if ( isset( $_GET['course_id'] ) ) {
	$course = WL_IMP_Helper::get_course( $_GET['course_id'] );
	if ( $course ) {
		$course_output = "$course->course_name ($course->course_code)";
		$filters_applied = true;
	}
}
if ( isset( $_GET['batch_id'] ) ) {
	$batch = WL_IMP_Helper::get_batch( $_GET['batch_id'] );
	if ( $batch ) {
		$batch_output = $batch->batch_code;
		$filters_applied = true;
	}
}
?>
<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-users"></i> <?php _e( 'Students', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can either add a new student or edit existing students.', WL_IMP_DOMAIN ); ?>
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
						<div class="h3"><?php _e( 'Manage Students', WL_IMP_DOMAIN ); ?></div>
					</div>
					<div class="col-md-3 col-xs-12">
						<button type="button" class="btn btn-outline-primary float-right add-student" data-toggle="modal" data-target="#add-student"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Student', WL_IMP_DOMAIN ); ?>
						</button>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col">
						<div class="float-left">
						<?php
						if ( isset( $_GET['year'] ) && ! empty( $_GET['year'] ) ) {
							$year        = esc_attr( $_GET['year'] );
							$date_format = __( "Year", WL_IMP_DOMAIN ) . ': ' . $year;
							if ( isset( $_GET['month'] ) && ! empty( $_GET['month'] ) ) {
								$date        = DateTime::createFromFormat( '!m', esc_attr( $_GET['month'] ) );
								$month       = $date->format( 'F' );
								$date_format = "$month, $year";
							}
						?>
							<span class="text-secondary"><?php _e( 'Showing Records For', WL_IMP_DOMAIN ); ?>&nbsp;<strong><?php echo "$date_format"; ?></strong></span>
							<a class="ml-1 text-primary" href="<?php echo admin_url( 'admin.php?page=institute-management-pro-students' ); ?>"><?php _e( 'Show All', WL_IMP_DOMAIN ); ?></a>
						<?php
						} else { ?>
							<span class="text-secondary"><?php _e( 'Showing All Records', WL_IMP_DOMAIN ); ?></span>
							<?php
							if ( $filters_applied ) { ?>
							<a class="ml-1 text-primary" href="<?php echo admin_url( 'admin.php?page=institute-management-pro-students' ); ?>"><?php _e( 'Clear Filters', WL_IMP_DOMAIN ); ?></a>
							<?php
							}
						} ?>
							<div class="row">
								<div class="col">
									<ul>
										<?php
										if ( isset( $status_output ) ) { ?>
										<li class="font-weight-bold mt-1"><?php echo $status_output . ' ' . __( 'Students', WL_IMP_DOMAIN ); ?></li>
										<?php
										}
										if ( isset( $course_output ) ) { ?>
										<li>
											<span class="font-weight-bold"><?php _e( 'Course', WL_IMP_DOMAIN ); ?>:</span> <span><?php echo $course_output; ?></span>
											<?php
											if ( isset( $batch_output ) ) { ?>
											<span class="ml-3"><span class="font-weight-bold"><?php _e( 'Batch', WL_IMP_DOMAIN ); ?>:</span> <span><?php echo $batch_output; ?></span>
											</span>
											<?php
											} ?>
										</li>
										<?php
										} ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="wlim-filter float-right mb-3">
							<form method="get" class="form-inline">
							<?php
							foreach( $_GET as $name => $value ) {
								$name  = esc_attr( $name );
								$value = esc_attr( $value );
								echo '<input type="hidden" name="'. $name .'" value="'. $value .'">';
							} ?>
								<input type="hidden" name="page" value="institute-management-pro-students">
								<div class="form-group">
									<label class="col-form-label font-weight-bold" for="wlim-student-filter_by_year">
										<?php _e( 'Year', WL_IMP_DOMAIN ); ?>:&nbsp;
									</label>
									<input type="text" name="year" class="form-control wlim-year" id="wlim-student-filter_by_year" placeholder="<?php _e( 'Year', WL_IMP_DOMAIN ); ?>">
								</div>&nbsp;
								<div class="form-group">
									<label class="col-form-label font-weight-bold" for="wlim-student-filter_by_month">
										<?php _e( 'Month', WL_IMP_DOMAIN ); ?>:&nbsp;
									</label>
									<input type="text" name="month" class="form-control wlim-month" id="wlim-student-filter_by_month" placeholder="<?php _e( 'Month', WL_IMP_DOMAIN ); ?>">
								</div>&nbsp;
								<button type="submit" class="btn btn-success"><?php _e( 'Apply Filter', WL_IMP_DOMAIN ); ?></button>
							</form>
						</div>

						<table class="table table-hover table-striped table-bordered" id="student-table">
							<thead>
								<tr>
									<th scope="col"><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Course', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Batch', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Duration', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'First Name', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Fees Payable', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Fees Paid', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Fees Status', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Email', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Address', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'City', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Zip', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'State', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Nationality', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Is Active', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Added By', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Registration Date', WL_IMP_DOMAIN ); ?></th>
									<th scope="col"><?php _e( 'Completion Date', WL_IMP_DOMAIN ); ?></th>
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

<!-- add new student modal -->
<div class="modal fade" id="add-student" tabindex="-1" role="dialog" aria-labelledby="add-student-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-student-label"><?php _e( 'Add New Student', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-add-student-form">
				<div class="modal-body pr-4 pl-4">
					<?php $nonce = wp_create_nonce( 'add-student' ); ?>
	                <input type="hidden" name="add-student" value="<?php echo $nonce; ?>">
	                <input type="hidden" name="action" value="wl-im-add-student">
	                <div class="wlim-add-student-form-fields">
						<div class="form-check pl-0 pb-3 mb-2 border-bottom">
							<input name="from_enquiry" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-student-from_enquiry">
							<label class="form-check-label" for="wlim-student-from_enquiry">
							<?php _e( 'From Enquiry?', WL_IMP_DOMAIN ); ?>
							</label>
						</div>
		                <div id="wlim-add-student-from-enquiries"></div>
		                <div id="wlim-add-student-form-fields">
			                <?php WL_IMP_Student::render_add_student_form( $wlim_active_courses ); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
					<button type="submit" class="btn btn-primary add-student-submit"><?php _e( 'Add New Student', WL_IMP_DOMAIN ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end - add new student modal -->

<!-- update student modal -->
<div class="modal fade" id="update-student" tabindex="-1" role="dialog" aria-labelledby="update-student-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="update-student-label"><?php _e( 'Update Student', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-update-student-form" enctype="multipart/form-data">
				<div class="modal-body pr-4 pl-4" id="fetch_student"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
					<button type="submit" class="btn btn-primary update-student-submit"><?php _e( 'Update Student', WL_IMP_DOMAIN ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end - update student modal -->