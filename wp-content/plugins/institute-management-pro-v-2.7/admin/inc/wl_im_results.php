<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
$wlim_exams          = WL_IMP_Helper::get_exams();
$wlim_active_courses = WL_IMP_Helper::get_active_courses();
?>

<div class="container-fluid wl_im_container">
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-bar-chart-o"></i> <?php _e( 'Exam Results', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can add and publish exam results.', WL_IMP_DOMAIN ); ?>
			</div>
			<!-- end main header content -->
		</div>
	</div>
	<div class="row">
		<div class="col card">
			<div class="card-header bg-primary text-white">
				<!-- card header content -->
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<span class="h5"><?php _e( 'Manage Exams and Results', WL_IMP_DOMAIN ); ?></span>
						<span class="float-right">
							<button type="button" class="btn btn-outline-light add-exam mr-2" data-toggle="modal" data-target="#add-exam"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Exam', WL_IMP_DOMAIN ); ?>
							</button>
						</span>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col">
						<table class="table table-hover table-striped table-bordered" id="exam-table">
							<thead>
								<tr>
						        	<th scope="col"><?php _e( 'Exam Code', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Exam Title', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Exam Date', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Is Published', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Published At', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Added On', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Added By', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Edit', WL_IMP_DOMAIN ); ?></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-wlim-exam-results-tab" data-toggle="pill" href="#pills-wlim-exam-results" role="tab" aria-controls="pills-wlim-exam-results" aria-selected="true"><?php _e( "Exam Results", WL_IMP_DOMAIN ); ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-wlim-batch-results-tab" data-toggle="pill" href="#pills-wlim-batch-results" role="tab" aria-controls="pills-wlim-batch-results" aria-selected="false"><?php _e( "Save Results By Batch", WL_IMP_DOMAIN ); ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-wlim-results-shortcode-tab" data-toggle="pill" href="#pills-wlim-results-shortcode" role="tab" aria-controls="pills-wlim-results-shortcode" aria-selected="false"><?php _e( "Shortcode", WL_IMP_DOMAIN ); ?></a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-wlim-exam-results" role="tabpanel" aria-labelledby="pills-wlim-exam-results-tab">
								<div class="row">
									<div class="col-md-8 col-xs-12">
										<form id="wlim-get-exam-results-form">
									        <div class="form-group wlim-selectpicker">
									            <label for="wlim-result-exam" class="col-form-label">* <?php _e( "Exam", WL_IMP_DOMAIN ); ?>:</label>
									            <select name="exam" class="form-control selectpicker">
									                <option value="">-------- <?php _e( "Select an Exam", WL_IMP_DOMAIN ); ?> --------</option>
									            <?php
									            if ( count( $wlim_exams ) > 0 ) {
									                foreach ( $wlim_exams as $exam ) {  ?>
									                <option value="<?php echo $exam->id; ?>"><?php echo "$exam->exam_title ( $exam->exam_code )"; ?></option>
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
												<button type="submit" class="btn btn-success"><?php _e( 'Get Results', WL_IMP_DOMAIN ); ?></button>
											</div>
										</form>
									</div>
								</div>
								<div id="wlim-get-exam-results"></div>
							</div>
							<div class="tab-pane fade" id="pills-wlim-batch-results" role="tabpanel" aria-labelledby="pills-wlim-batch-results-tab">
								<div class="row">
									<div class="col-md-8 col-xs-12">
										<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-save-result-form">
											<?php $nonce = wp_create_nonce( 'save-result' ); ?>
							                <input type="hidden" name="save-result" value="<?php echo $nonce; ?>">
							                <input type="hidden" name="action" value="wl-im-save-result">
									        <div class="form-group wlim-selectpicker">
									            <label for="wlim-result-exam" class="col-form-label">* <?php _e( "Exam", WL_IMP_DOMAIN ); ?>:</label>
									            <select name="exam" class="form-control selectpicker" id="wlim-result-exam">
									                <option value="">-------- <?php _e( "Select an Exam", WL_IMP_DOMAIN ); ?> --------</option>
									            <?php
									            if ( count( $wlim_exams ) > 0 ) {
									                foreach ( $wlim_exams as $exam ) {  ?>
									                <option value="<?php echo $exam->id; ?>"><?php echo "$exam->exam_title ( $exam->exam_code )"; ?></option>
									            <?php
									                }
									            } ?>
									            </select>
									        </div>
											<div class="form-group wlim-selectpicker">
									            <label for="wlim-result-course" class="col-form-label">* <?php _e( "Course", WL_IMP_DOMAIN ); ?>:</label>
									            <select name="course" class="form-control selectpicker" id="wlim-result-course">
									                <option value="">-------- <?php _e( "Select a Course", WL_IMP_DOMAIN ); ?> --------</option>
									            <?php
									            if ( count( $wlim_active_courses ) > 0 ) {
									                foreach ( $wlim_active_courses as $active_course ) {  ?>
											        <option value="<?php echo $active_course->id; ?>">
											        	<?php echo "$active_course->course_name ($active_course->course_code)"; ?>
										        	</option>
									            <?php
									                }
									            } ?>
									            </select>
									        </div>
									        <div id="wlim-add-result-course-batches"></div>
											<div class="wlim-loading text-center mt-3">
												<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
												<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
											</div>
											<div class="mt-3 float-right">
												<button type="submit" class="btn btn-success save-result-submit"><?php _e( 'Save Result', WL_IMP_DOMAIN ); ?></button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-wlim-results-shortcode" role="tabpanel" aria-labelledby="pills-wlim-results-shortcode-tab">
								<div class="row">
									<div class="col">
										<div class="text-center border-top border-bottom pt-2 pb-2">
											<?php _e( 'To Display Exam Results Form on Front End, Copy and Paste Shortcode', WL_IMP_DOMAIN ); ?>:
											<div class="col-12 justify-content-center align-items-center">
												<span class="col-6">
							 						<strong id="wl_im_exam_result_form_shortcode">[institute_exam_result]</strong>
												</span>
												<span class="col-6">
													<button id="wl_im_exam_result_form_shortcode_copy" class="btn btn-outline-success btn-sm" type="button"><?php _e( 'Copy', WL_IMP_DOMAIN ); ?></button>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
</div>

<!-- add new exam modal -->
<div class="modal fade" id="add-exam" tabindex="-1" role="dialog" aria-labelledby="add-exam-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-exam-label"><?php _e( 'Add New Exam', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-add-exam-form">
				<div class="modal-body pr-4 pl-4">
					<?php $nonce = wp_create_nonce( 'add-exam' ); ?>
	                <input type="hidden" name="add-exam" value="<?php echo $nonce; ?>">
	                <input type="hidden" name="action" value="wl-im-add-exam">
					<div class="form-group">
						<label for="wlim-exam-exam_code" class="col-form-label">* <?php _e( 'Exam Code', WL_IMP_DOMAIN ); ?>:</label>
						<input name="exam_code" type="text" class="form-control" id="wlim-exam-exam_code" placeholder="<?php _e( "Exam Code", WL_IMP_DOMAIN ); ?>" min="0">
					</div>
					<div class="form-group">
						<label for="wlim-exam-exam_title" class="col-form-label">* <?php _e( 'Exam Title', WL_IMP_DOMAIN ); ?>:</label>
						<input name="exam_title" type="text" class="form-control" id="wlim-exam-exam_title" placeholder="<?php _e( "Exam Title", WL_IMP_DOMAIN ); ?>" min="0">
					</div>
					<div class="form-group">
						<label for="wlim-exam-exam_date" class="col-form-label">* <?php _e( 'Exam Date', WL_IMP_DOMAIN ); ?>:</label>
						<input name="exam_date" type="text" class="form-control wlim-exam-exam_date" id="wlim-exam-exam_date" placeholder="<?php _e( "Exam Date", WL_IMP_DOMAIN ); ?>">
					</div>
					<label class="col-form-label">* <?php _e( 'Exam Marks', WL_IMP_DOMAIN ); ?>:</label>
			        <div class="exam_marks_box">
			            <table class="table table-bordered">
			                <thead>
			                    <tr>
			                        <th><?php _e( 'Subject', WL_IMP_DOMAIN ); ?></th>
			                        <th><?php _e( 'Maximum Marks', WL_IMP_DOMAIN ); ?></th>
			                        <th></th>
			                    </tr>
			                </thead>
			                <tbody class="exam_marks_rows exam_marks_table">
		                        <tr>
		                            <td>
		                        		<input type="text" name="marks[subject][]" class="form-control" placeholder="<?php _e( 'Subject', WL_IMP_DOMAIN ); ?>">
		                            </td>
		                            <td>
		                            	<input type="number" min="0" name="marks[maximum][]" class="form-control" placeholder="<?php _e( 'Maximum Marks', WL_IMP_DOMAIN ); ?>">
		                            </td>
		                            <td>
		                                <button class="remove_row btn btn-danger btn-sm" type="button">
		                                    <i class="fa fa-remove" aria-hidden="true"></i>
		                                </button>
		                            </td>
		                        </tr>
			                </tbody>
			            </table>
			            <div class="text-right">
			                <button type="button" class="add-more-exam-marks btn btn-success btn-sm"><?php _e( 'Add More', WL_IMP_DOMAIN ); ?></button>
			            </div>
			        </div>
					<div class="form-check pl-0">
						<input name="is_published" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-exam-is_published">
						<label class="form-check-label" for="wlim-exam-is_published">
						<?php _e( 'Is Published?', WL_IMP_DOMAIN ); ?>
						</label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
					<button type="submit" class="btn btn-primary add-exam-submit"><?php _e( 'Add New Exam', WL_IMP_DOMAIN ); ?></button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- end - add new exam modal -->

<!-- update exam modal -->
<div class="modal fade" id="update-exam" tabindex="-1" role="dialog" aria-labelledby="update-exam-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="update-exam-label"><?php _e( 'Update Exam', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-update-exam-form">
				<div class="modal-body pr-4 pl-4" id="fetch_exam"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
					<button type="submit" class="btn btn-primary update-exam-submit"><?php _e( 'Update Exam', WL_IMP_DOMAIN ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end - update exam modal -->