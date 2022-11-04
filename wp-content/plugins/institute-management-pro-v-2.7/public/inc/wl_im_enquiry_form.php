<?php
defined( 'ABSPATH' ) or die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

$wlim_active_courses = WL_IMP_Helper::get_active_courses();
?>
<div class="wl_im_container wl_im">
	<div class="row">
    	<div class="col-xs-12">
			<div class="card">
    			<?php if ( get_option( 'enable_enquiry_form_title' ) ) { ?>
    			<div class="card-header">
	    			<div class="text-center wl_im_heading_title"><h2><span><?php _e( get_option( 'enquiry_form_title' ), WL_IMP_DOMAIN ); ?></span></h2></div>
    			</div>
    			<?php
    			} ?>
    			<div class="card-body">
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="wlim-add-enquiry-form" enctype="multipart/form-data">
						<?php $nonce = wp_create_nonce( 'add-enquiry' ); ?>
			            <input type="hidden" name="add-enquiry" value="<?php echo $nonce; ?>">
			            <input type="hidden" name="action" value="wl-im-add-enquiry">
			            <div class="form-group">
			                <label for="wlim-enquiry-course" class="col-form-label">* <?php _e( "Admission For", WL_IMP_DOMAIN ); ?>:</label>
			                <select name="course" class="form-control" id="wlim-enquiry-course">
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
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-first_name" class="col-form-label">* <?php _e( 'First Name', WL_IMP_DOMAIN ); ?>:</label>
								<input name="first_name" type="text" class="form-control" id="wlim-enquiry-first_name" placeholder="<?php _e( "First Name", WL_IMP_DOMAIN ); ?>">
							</div>
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-last_name" class="col-form-label"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?>:</label>
								<input name="last_name" type="text" class="form-control" id="wlim-enquiry-last_name" placeholder="<?php _e( "Last Name", WL_IMP_DOMAIN ); ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label class="col-form-label">* <?php _e( 'Gender', WL_IMP_DOMAIN ); ?>:</label><br>
						    	<div class="row mt-2">
						    		<div class="col-sm-12">
										<label class="radio-inline mr-3"><input checked type="radio" name="gender" class="mr-2" value="male" id="wlim-enquiry-male"><?php _e( 'Male', WL_IMP_DOMAIN ); ?></label>
						    			<label class="radio-inline"><input type="radio" name="gender" class="mr-2" value="female" id="wlim-enquiry-female"><?php _e( 'Female', WL_IMP_DOMAIN ); ?></label>
					    			</div>
						    	</div>
							</div>
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-date_of_birth" class="col-form-label">* <?php _e( 'Date of Birth', WL_IMP_DOMAIN ); ?>:</label>
								<input name="date_of_birth" type="text" class="form-control wlim-date_of_birth" id="wlim-enquiry-date_of_birth" placeholder="<?php _e( "Date of Birth", WL_IMP_DOMAIN ); ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-father_name" class="col-form-label"><?php _e( 'Father Name', WL_IMP_DOMAIN ); ?>:</label>
								<input name="father_name" type="text" class="form-control" id="wlim-enquiry-father_name" placeholder="<?php _e( "Father Name", WL_IMP_DOMAIN ); ?>">
							</div>
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-mother_name" class="col-form-label"><?php _e( 'Mother Name', WL_IMP_DOMAIN ); ?>:</label>
								<input name="mother_name" type="text" class="form-control" id="wlim-enquiry-mother_name" placeholder="<?php _e( "Mother Name", WL_IMP_DOMAIN ); ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-address" class="col-form-label"><?php _e( 'Address', WL_IMP_DOMAIN ); ?>:</label>
								<textarea name="address" class="form-control" rows="4" id="wlim-enquiry-address" placeholder="<?php _e( "Address", WL_IMP_DOMAIN ); ?>"></textarea>
							</div>
							<div class="col-sm-6 form-group">
								<div>
									<label for="wlim-enquiry-city" class="col-form-label"><?php _e( 'City', WL_IMP_DOMAIN ); ?>:</label>
									<input name="city" type="text" class="form-control" id="wlim-enquiry-city" placeholder="<?php _e( "City", WL_IMP_DOMAIN ); ?>">
								</div>
								<div>
									<label for="wlim-enquiry-zip" class="col-form-label"><?php _e( 'Zip Code', WL_IMP_DOMAIN ); ?>:</label>
									<input name="zip" type="text" class="form-control" id="wlim-enquiry-zip" placeholder="<?php _e( "Zip Code", WL_IMP_DOMAIN ); ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-state" class="col-form-label"><?php _e( 'State', WL_IMP_DOMAIN ); ?>:</label>
								<input name="state" type="text" class="form-control" id="wlim-enquiry-state" placeholder="<?php _e( "State", WL_IMP_DOMAIN ); ?>">
							</div>
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-nationality" class="col-form-label"><?php _e( 'Nationality', WL_IMP_DOMAIN ); ?>:</label>
								<input name="nationality" type="text" class="form-control" id="wlim-enquiry-nationality" placeholder="<?php _e( "Nationality", WL_IMP_DOMAIN ); ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-phone" class="col-form-label">* <?php _e( 'Phone', WL_IMP_DOMAIN ); ?>:</label>
								<input name="phone" type="text" class="form-control" id="wlim-enquiry-phone" placeholder="<?php _e( "Phone", WL_IMP_DOMAIN ); ?>">
							</div>
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-email" class="col-form-label"><?php _e( 'Email', WL_IMP_DOMAIN ); ?>:</label>
								<input name="email" type="text" class="form-control" id="wlim-enquiry-email" placeholder="<?php _e( "Email", WL_IMP_DOMAIN ); ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-qualification" class="col-form-label"><?php _e( 'Qualification', WL_IMP_DOMAIN ); ?>:</label>
								<input name="qualification" type="text" class="form-control" id="wlim-enquiry-qualification" placeholder="<?php _e( "Qualification", WL_IMP_DOMAIN ); ?>">
							</div>
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-id_proof" class="col-form-label"><?php _e( 'ID Proof', WL_IMP_DOMAIN ); ?>:</label><br>
							    <input name="id_proof" type="file" id="wlim-enquiry-id_proof">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-photo" class="col-form-label"><?php _e( 'Choose Photo', WL_IMP_DOMAIN ); ?>:</label><br>
							    <input name="photo" type="file" id="wlim-enquiry-photo">
							</div>
							<div class="col-sm-6 form-group">
								<label for="wlim-enquiry-signature" class="col-form-label"><?php _e( 'Choose Signature', WL_IMP_DOMAIN ); ?>:</label><br>
							    <input name="signature" type="file" id="wlim-enquiry-signature">
							</div>
						</div>
						<div class="form-group">
							<label for="wlim-enquiry-message" class="col-form-label"><?php _e( 'Message', WL_IMP_DOMAIN ); ?>:</label>
							<textarea name="message" class="form-control" rows="3" id="wlim-enquiry-message" placeholder="<?php _e( "Message", WL_IMP_DOMAIN ); ?>"></textarea>
						</div>
						<div class="wlim-loading text-center mt-3">
							<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
							<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
						</div>
						<div class="mt-3">
							<button type="submit" class="btn btn-block add-enquiry-submit"><?php _e( 'Submit!', WL_IMP_DOMAIN ); ?></button>
						</div>
					</form>
    			</div>
    		</div>
		</div>
	</div>
</div>