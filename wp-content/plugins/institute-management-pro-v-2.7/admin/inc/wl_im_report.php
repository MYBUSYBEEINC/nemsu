<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

$wlim_students = WL_IMP_Helper::get_students();
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-bar-chart-o"></i> <?php _e( 'Report', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can view and print report.', WL_IMP_DOMAIN ); ?>
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
					<div class="col-md-12 col-xs-12">
						<div class="h3"><?php _e( 'View Report', WL_IMP_DOMAIN ); ?></div>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col-md-8 col-xs-12">
			            <div id="wlim-view-report"></div>
						<form id="wlim-view-report-form">
				            <div class="form-group">
				                <label for="wlim-report-student" class="col-form-label"><?php _e( "View Report", WL_IMP_DOMAIN ); ?>:</label>
				                <select name="student" class="form-control selectpicker" id="wlim-report-student">
				                    <option value="">-------- <?php _e( "Select a Student", WL_IMP_DOMAIN ); ?> --------</option>
				                <?php
				                if ( count( $wlim_students ) > 0 ) {
				                    foreach ( $wlim_students as $student ) {
				                    	$name = $student->first_name;
				                    	$name .= $student->middle_name ? " $student->middle_name" : "";
				                    	$name .= $student->last_name ? " $student->last_name" : "";
				                    ?>
				                    <option value="<?php echo $student->id; ?>"><?php echo "$name (" . WL_IMP_Helper::get_enrollment_id( $student->id ) . ")"; ?></option>
				                <?php
				                    }
				                } ?>
				                </select>
				            </div>
							<div class="wlim-loading text-center mt-3">
								<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
								<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
							</div>
							<div class="mt-3 float-right">
								<button type="submit" class="btn btn-primary view-report-submit"><?php _e( 'Get Report!', WL_IMP_DOMAIN ); ?></button>
							</div>
						</form>
					</div>
				</div>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
	<!-- end - row 2 -->
</div>

<!-- print student modal -->
<div class="modal fade" id="print-student" tabindex="-1" role="dialog" aria-labelledby="print-student-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" id="print-student-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title w-100 text-center" id="print-student-label"><?php _e( 'View and Print Student', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="print_student"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - print student modal -->

<!-- print student admission detail modal -->
<div class="modal fade" id="print-student-admission-detail" tabindex="-1" role="dialog" aria-labelledby="print-student-admission-detail-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" id="print-student-admission-detail-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title w-100 text-center" id="print-student-admission-detail-label"><?php _e( 'View and Print Admission Detail', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="print_student_admission_detail"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - print student admission detail modal -->

<!-- print student fees report -->
<div class="modal fade" id="print-student-fees-report" tabindex="-1" role="dialog" aria-labelledby="print-student-fees-report-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" id="print-student-fees-report-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title w-100 text-center" id="print-student-fees-report-label"><?php _e( 'View and Print Fees Report', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="print_student_fees_report"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - print student fees report -->

<!-- print student certificate modal -->
<div class="modal fade" id="print-student-certificate" tabindex="-1" role="dialog" aria-labelledby="print-student-certificate-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" id="print-student-certificate-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title w-100 text-center" id="print-student-certificate-label"><?php _e( 'View and Print Completion Certificate', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="print_student_certificate"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - print student certificate modal -->