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
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-envelope"></i> <?php _e( 'Enquiries', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can either add a new enquiry or edit existing enquiries.', WL_IMP_DOMAIN ); ?>
			</div>
			<div class="text-center">
				<?php _e( 'To Display Enquiry Form on Front End, Copy and Paste Shortcode', WL_IMP_DOMAIN ); ?>:
				<div class="col-12 justify-content-center align-items-center">
					<span class="col-6">
 						<strong id="wl_im_enquiry_form_shortcode">[institute_enquiry_form]</strong>
					</span>
					<span class="col-6">
						<button id="wl_im_enquiry_form_shortcode_copy" class="btn btn-outline-success btn-sm" type="button">Copy</button>
					</span>
				</div>
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
						<div class="h3"><?php _e( 'Manage Enquiries', WL_IMP_DOMAIN ); ?></div>
					</div>
					<div class="col-md-3 col-xs-12">
						<button type="button" class="btn btn-outline-primary float-right add-enquiry" data-toggle="modal" data-target="#add-enquiry"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Enquiry', WL_IMP_DOMAIN ); ?>
						</button>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col">
						<table class="table table-hover table-striped table-bordered" id="enquiry-table">
							<thead>
								<tr>
						        	<th scope="col"><?php _e( 'Enquiry ID', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Course', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'First Name', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Last Name', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Phone', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Email', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Is Active', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Added By', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Date', WL_IMP_DOMAIN ); ?></th>
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

<!-- add new enquiry modal -->
<div class="modal fade" id="add-enquiry" tabindex="-1" role="dialog" aria-labelledby="add-enquiry-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-enquiry-label"><?php _e( 'Add New Enquiry', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-add-enquiry-form" enctype="multipart/form-data">
				<div class="modal-body pr-4 pl-4">
					<?php $nonce = wp_create_nonce( 'add-enquiry' ); ?>
	                <input type="hidden" name="add-enquiry" value="<?php echo $nonce; ?>">
	                <input type="hidden" name="action" value="wl-im-add-enquiry">
	                <div class="wlim-add-enquiry-form-fields">
			            <div class="form-group wlim-selectpicker">
			                <label for="wlim-enquiry-course" class="col-form-label">* <?php _e( "Admission For", WL_IMP_DOMAIN ); ?>:</label>
			                <select name="course" class="form-control selectpicker" id="wlim-enquiry-course">
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
						<div class="form-check pl-0">
							<input name="is_active" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-enquiry-is_active" checked>
							<label class="form-check-label" for="wlim-enquiry-is_active">
							<?php _e( 'Is Active?', WL_IMP_DOMAIN ); ?>
							</label>
						</div>
						<div class="wlim-loading text-center mt-3">
							<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
							<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
					<button type="submit" class="btn btn-primary add-enquiry-submit"><?php _e( 'Add New Enquiry', WL_IMP_DOMAIN ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end - add new enquiry modal -->

<!-- update enquiry modal -->
<div class="modal fade" id="update-enquiry" tabindex="-1" role="dialog" aria-labelledby="update-enquiry-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="update-enquiry-label"><?php _e( 'Update Enquiry', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-update-enquiry-form" enctype="multipart/form-data">
				<div class="modal-body pr-4 pl-4" id="fetch_enquiry"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
					<button type="submit" class="btn btn-primary update-enquiry-submit"><?php _e( 'Update Enquiry', WL_IMP_DOMAIN ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end - update enquiry modal -->