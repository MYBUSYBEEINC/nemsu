<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_StudentHelper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_PaymentHelper.php' );

$student = WL_IMP_StudentHelper::get_student();
$notices = WL_IMP_StudentHelper::get_notices();

if ( ! $student ) {
	die();
}
$id   = $student->id;
$name = $student->first_name;
if ( $student->last_name ) {
	$name .= " $student->last_name";
}
$course =  WL_IMP_Helper::get_course( $student->course_id );
$course = ( ! empty ( $course ) ) ? "{$course->course_name} ({$course->course_code})" : '';

$batch =  WL_IMP_Helper::get_batch( $student->batch_id );
$batch = ( ! empty ( $batch ) ) ? $batch->batch_code : '';

$pending_fees = number_format( $student->fees_payable - $student->fees_paid, 2, '.', '' );
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-tachometer"></i> <?php _e( 'Student Dashboard', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can find your details.', WL_IMP_DOMAIN ); ?>
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
					<div class="col-md-12 wlim-noticboard-background pt-2 pb-2">
						<div class="wlim-student-heading text-center display-4"><span class="text-white"><?php _e( 'Welcome', WL_IMP_DOMAIN ); ?> <span class="wlim-student-name-heading"><?php echo $student->first_name; ?></span> !</span></div>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="card col-sm-6 col-xs-12">
						<div class="card-header wlim-noticboard-background">
							<h5 class="text-white border-light"><?php _e( 'Noticeboard', WL_IMP_DOMAIN ); ?></h5>
						</div>
						<div class="card-body">
							<?php
							if( count( $notices ) > 0 ) { ?>
								<div class="wlim-noticeboard-section">
									<ul class="wlim-noticeboard">
									<?php
									foreach( $notices as $key => $notice ) {
										if( $notice->link_to == 'url' ) {
											$link_to = $notice->url;
										} elseif ( $notice->link_to == 'attachment' ) {
											$link_to = wp_get_attachment_url( $notice->attachment );
										} else {
											$link_to = '#';
										}
									?>
										<li class="mb-3"><span class="wlim-noticeboard-notice font-weight-bold">&#9656; </span>
											<a class="wlim-noticeboard-notice" target="_blank" href="<?php echo esc_url( $link_to ); ?>"><?php echo stripcslashes( $notice->title ); ?> (<?php echo date_format( date_create( $notice->created_at ), "d M, Y" ); ?>)</a>
										<?php
										if ( $key < 3 ) { ?>
											<img class="ml-1" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/newicon.gif'; ?>">
										<?php
										} ?>
										</li>
									<?php
									} ?>
									</ul>
								</div>
								<div class="mt-4 mr-3 float-right"><a class="wlim-view-all-notice text-dark font-weight-bold" href="<?php menu_page_url( 'institute-management-pro-student-noticeboard' ); ?>"><?php _e( 'View all', WL_IMP_DOMAIN ); ?></a></div>
								<?php
							} else { ?>
								<span class="text-dark"><?php _e( 'There is no notice.', WL_IMP_DOMAIN ); ?></span>
							<?php
							} ?>
						</div>
					</div>
					<div class="card col-sm-6 col-xs-12">
						<div class="card-header wlim-noticboard-background">
							<h5 class="text-white border-light"><?php _e( 'Your Details', WL_IMP_DOMAIN ); ?></h5>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item mt-2">
								<strong><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?></strong>:&nbsp;
								<?php echo WL_IMP_Helper::get_enrollment_id( $id ); ?>
							</li>
							<li class="list-group-item">
								<strong><?php _e( 'Name', WL_IMP_DOMAIN ); ?></strong>:&nbsp;
								<?php echo $name; ?>
							</li>
							<li class="list-group-item">
								<strong><?php _e( 'Course', WL_IMP_DOMAIN ); ?></strong>:&nbsp;
								<?php echo $course; ?>
							</li>
							<?php
							if ( $batch ) { ?>
							<li class="list-group-item">
								<strong><?php _e( 'Batch', WL_IMP_DOMAIN ); ?></strong>:&nbsp;
								<?php echo $batch; ?>
							</li>
							<?php
							} ?>
							<li class="list-group-item">
								<strong><?php _e( 'Status', WL_IMP_DOMAIN ); ?></strong>:&nbsp;
								<?php
								if ( $student->course_completed ) { ?>
									<strong class="text-success"><?php _e( 'Former Student', WL_IMP_DOMAIN ); ?></strong>
								<?php
								} elseif( ! $student->is_active ) { ?>
									<strong class="text-danger"><?php _e( 'Inactive Student', WL_IMP_DOMAIN ); ?></strong>
								<?php
								} else {
								?>
									<strong class="text-primary"><?php _e( 'Current Student', WL_IMP_DOMAIN ); ?></strong> <strong class="text-secondary"><?php echo '('. __( 'In progress', WL_IMP_DOMAIN ) .')'; ?></strong>
								<?php
								} ?>
							</li>
							<li class="list-group-item">
								<strong><?php _e( 'ID Card', WL_IMP_DOMAIN ); ?></strong>: 
								<a class="ml-2" href="#print-student" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="<?php echo $id; ?>"><i class="fa fa-print"></i></a>
							</li>
							<li class="list-group-item">
								<strong><?php _e( 'Admission Detail', WL_IMP_DOMAIN ); ?></strong>: 
								<a class="ml-2" href="#print-student-admission-detail" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="<?php echo $id; ?>"><i class="fa fa-print"></i></a>
							</li>
							<li class="list-group-item">
								<strong><?php _e( 'Fees Report', WL_IMP_DOMAIN ); ?></strong>: 
								<a class="ml-2" href="#print-student-fees-report" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="<?php echo $id; ?>"><i class="fa fa-print"></i></a>
							</li>
							<?php
							if ( $student->course_completed ) { ?>
							<li class="list-group-item">
								<strong><?php _e( 'Completion Certificate', WL_IMP_DOMAIN ); ?></strong>: 
								<a class="ml-2" href="#print-student-certificate" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="<?php echo $id; ?>"><i class="fa fa-print"></i></a>
							</li>
							<?php
							} ?>
						</ul>
					</div>
				</div>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
	<!-- end - row 2 -->

	<!-- row 3 -->
	<div class="row">
		<div class="card col">
			<div class="card-header">
				<!-- card header content -->
				<div class="row">
					<div class="col-xs-12">
						<div class="wlim-student-heading"><?php _e( 'Pay Fees', WL_IMP_DOMAIN ); ?></div>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<?php
				if ( $pending_fees > 0 ) { ?>
				<div class="alert alert-info" role="alert">
					<span class="wlim-student-fee-status"><i class="fa fa-clock-o"></i> <?php _e( 'You have pending fee: ', WL_IMP_DOMAIN ); ?></span><strong class="wlim-student-fee-amount"><?php echo WL_IMP_PaymentHelper::get_currency_symbol() . $pending_fees; ?></strong>
				</div>
				<?php
					if ( ! WL_IMP_PaymentHelper::payment_methods_unavailable() ) { ?>
				<div class="row">
					<div class="col-md-6 wlim-pay-fees-now">
						<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlim-pay-fees">
							<?php $nonce = wp_create_nonce( 'pay-fees' ); ?>
							<input type="hidden" name="pay-fees" value="<?php echo $nonce; ?>">
		                	<input type="hidden" name="action" value="wl-im-pay-fees">
							<div class="form-group">
								<label for="wlim-fees-amount" class="col-form-label"><?php _e( 'Enter Amount to Pay', WL_IMP_DOMAIN ); ?>:</label>
								<input name="amount" type="number" class="form-control" id="wlim-fees-amount" placeholder="<?php _e( "Enter Amount to Pay", WL_IMP_DOMAIN ); ?>" value="<?php echo $pending_fees; ?>">
							</div>
							<div class="form-group">
								<label class="col-form-label"><?php _e( 'Payment Method', WL_IMP_DOMAIN ); ?>:</label><br>
						    	<div class="row mt-2">
						    		<div class="col-sm-12">
						    			<?php
						    			if ( WL_IMP_PaymentHelper::razorpay_enabled() ) { ?>
										<label class="radio-inline mr-3"><input checked type="radio" name="payment_method" class="mr-2" value="razorpay" id="wlim-payment-razorpay"><?php _e( 'Razorpay', WL_IMP_DOMAIN ); ?></label>
										<?php
										}
						    			if ( WL_IMP_PaymentHelper::paystack_enabled() ) { ?>
										<label class="radio-inline mr-3"><input checked type="radio" name="payment_method" class="mr-2" value="paystack" id="wlim-payment-paystack"><?php _e( 'Paystack', WL_IMP_DOMAIN ); ?></label>
										<?php
										}
										if ( WL_IMP_PaymentHelper::paypal_enabled() ) { ?>
						    			<label class="radio-inline"><input type="radio" name="payment_method" class="mr-2" value="paypal" id="wlim-payment-paypal"><?php _e( 'Paypal', WL_IMP_DOMAIN ); ?></label>
						    			<?php
						    			} ?>
					    			</div>
						    	</div>
							</div>
							<div class="wlim-loading text-center mt-3">
								<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
								<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
							</div>
							<button type="submit" class="mt-2 float-right btn btn-primary pay-fees-submit"><?php _e( 'Pay Now', WL_IMP_DOMAIN ); ?></button>
						</form>
					</div>
				</div>
					<?php
					}
				} else { ?>
				<div class="alert alert-success" role="alert">
					<span class="wlim-student-fee-status"><i class="fa fa-check"></i> <?php _e( 'No pending fees.', WL_IMP_DOMAIN ); ?></span>
				</div>
				<?php
				} ?>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
	<!-- end - row 3 -->
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

<!-- razorpay script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- paystack script -->
<script src="https://js.paystack.co/v1/inline.js"></script>
