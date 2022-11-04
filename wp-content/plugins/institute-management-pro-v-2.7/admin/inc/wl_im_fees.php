<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

$wlim_active_students = WL_IMP_Helper::get_active_students();
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-usd"></i> <?php _e( 'Fees', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can find installments or add a new installment.', WL_IMP_DOMAIN ); ?>
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
						<div class="h3"><?php _e( 'Manage Fees', WL_IMP_DOMAIN ); ?></div>
					</div>
					<div class="col-md-3 col-xs-12">
						<button type="button" class="btn btn-outline-primary float-right add-installment" data-toggle="modal" data-target="#add-installment"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> <?php _e( 'Add New Installment', WL_IMP_DOMAIN ); ?>
						</button>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col">
						<table class="table table-hover table-striped table-bordered" id="installment-table">
							<thead>
								<tr>
						        	<th scope="col"><?php _e( 'Receipt', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Amount', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Student Name', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Payment Method', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Payment ID', WL_IMP_DOMAIN ); ?></th>
						        	<th scope="col"><?php _e( 'Date', WL_IMP_DOMAIN ); ?></th>
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

<!-- add new installment modal -->
<div class="modal fade" id="add-installment" tabindex="-1" role="dialog" aria-labelledby="add-installment-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-installment-label"><?php _e( 'Add New Installment', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4">
				<form id="wlim-add-installment-form">
					<?php $nonce = wp_create_nonce( 'add-installment' ); ?>
	                <input type="hidden" name="add-installment" value="<?php echo $nonce; ?>">
	                <div class="wlim-add-installment-form-fields">
						<div class="form-group">
	                        <label for="wlim-installment-student" class="col-form-label"><?php _e( "Student", WL_IMP_DOMAIN ); ?>:</label>
	                        <select name="student" class="form-control selectpicker" id="wlim-installment-student">
	                            <option value="">-------- <?php _e( "Select a Student", WL_IMP_DOMAIN ); ?> --------</option>
	                        <?php
	                        if ( count( $wlim_active_students ) > 0 ) {
	                            foreach ( $wlim_active_students as $active_student ) {  ?>
	                            <option value="<?php echo $active_student->id; ?>"><?php echo "$active_student->first_name $active_student->last_name (" . WL_IMP_Helper::get_enrollment_id( $active_student->id ) . ")"; ?></option>
	                        <?php
	                            }
	                        } ?>
	                        </select>
	                        <div id="wlim_add_installment_fetch_fees"></div>
	                	</div>
						<div class="form-group">
							<label for="wlim-installment-amount" class="col-form-label"><?php _e( 'Amount', WL_IMP_DOMAIN ); ?>:</label>
							<input name="amount" type="number" class="form-control" id="wlim-installment-amount" placeholder="<?php _e( "Amount", WL_IMP_DOMAIN ); ?>" min="0">
						</div>
						<div class="form-group">
							<label for="wlim_payment_method"><?php esc_html_e( 'Payment Method', WL_IMP_DOMAIN ); ?></label>
							<select class="form-control" name="payment_method" id="wlim_payment_method">
								<option value=""><?php esc_html_e( 'Select Payment Method', WL_IMP_DOMAIN ); ?></option>
								<?php foreach ( WL_IMP_Helper::get_payment_method_list() as $value ) { ?>
									<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $value ); ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="wlim_payment_id"><?php esc_html_e( 'Transaction / Payment ID', WL_IMP_DOMAIN ); ?></label>
							<input type="text" name="payment_id" class="form-control" id="wlim_payment_id" placeholder="<?php echo esc_attr( 'Transaction / Payment ID', WL_IMP_DOMAIN ); ?>">
						</div>
	                </div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary add-installment-submit"><?php _e( 'Add New Installment', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - add new installment modal -->

<!-- update installment modal -->
<div class="modal fade" id="update-installment" tabindex="-1" role="dialog" aria-labelledby="update-installment-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="update-installment-label"><?php _e( 'Update Installment', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="fetch_installment"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary update-installment-submit"><?php _e( 'Update Installment', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - update installment modal -->

<!-- print installment fee receipt -->
<div class="modal fade" id="print-installment-fee-receipt" tabindex="-1" role="dialog" aria-labelledby="print-installment-fee-receipt-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" id="print-installment-fee-receipt-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title w-100 text-center" id="print-installment-fee-receipt-label"><?php _e( 'View and Print Installment Fee Receipt', WL_IMP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="print_installment_fee_receipt"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Cancel', WL_IMP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- end - print installment fee receipt -->