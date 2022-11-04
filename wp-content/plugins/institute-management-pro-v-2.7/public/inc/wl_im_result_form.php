<?php
defined( 'ABSPATH' ) or die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

$wlim_exams = WL_IMP_Helper::get_published_exams();
?>
<div class="wl_im_container wl_im">
	<div class="row justify-content-md-center">
    	<div class="col-xs-12 col-md-12">
	        <div id="wlim-get-exam-result"></div>
			<form id="wlim-exam-result-form">
		        <div class="form-group wlim-selectpicker">
		            <label for="wlim-result-exam" class="col-form-label">* <strong><?php _e( "Exam", WL_IMP_DOMAIN ); ?>:</strong></label>
		            <select name="exam" class="form-control" id="wlim-result-exam">
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
				<div class="form-group">
					<label for="wlim-result-enrollment_id" class="col-form-label">* <strong><?php _e( 'Student ID', WL_IMP_DOMAIN ); ?>:</strong></label>
					<input name="enrollment_id" type="text" class="form-control" id="wlim-result-enrollment_id" placeholder="<?php _e( "Student ID", WL_IMP_DOMAIN ); ?>">
				</div>
				<div class="wlim-loading text-center mt-3">
					<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
					<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
				</div>
				<div class="mt-3 float-right">
					<button type="submit" class="btn btn-primary view-exam-result-submit"><?php _e( 'Get Result!', WL_IMP_DOMAIN ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>