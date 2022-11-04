<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Report {

	/* View report */
	public static function view_report() {
		self::check_permission();
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_REQUEST['student'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) { ?>
		<span class="text-danger"><?php _e( 'Student not found.', WL_IMP_DOMAIN ); ?></span>
		<?php
			die();
		}
		?>
		<div class="row">
			<div class="col">
				<div class="mb-3 mt-2">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<strong><?php _e( 'Enrollment ID', WL_IMP_DOMAIN ); ?></strong>:&nbsp;
							<?php echo WL_IMP_Helper::get_enrollment_id( $id ); ?>
						</li>
						<li class="list-group-item">
							<strong><?php _e( 'Status', WL_IMP_DOMAIN ); ?></strong>:&nbsp;
							<?php
							if ( $row->course_completed ) { ?>
								<strong class="text-success"><?php _e( 'Former Student', WL_IMP_DOMAIN ); ?></strong>
							<?php
							} elseif( ! $row->is_active ) { ?>
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
						if ( $row->course_completed ) { ?>
						<li class="list-group-item">
							<strong><?php _e( 'Completion Certificate', WL_IMP_DOMAIN ); ?></strong>: 
							<a class="ml-2" href="#print-student-certificate" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="<?php echo $id; ?>"><i class="fa fa-print"></i></a>
						</li>
						<?php
						} ?>
					</ul>
				</div>
			</div>
		</div>
	<?php
		die();
	}

	/* View and print student */
	public static function print_student() {
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}

		$user = null;
		if ( $row->user_id ) {
			$user = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}users WHERE ID = $row->user_id" );
		}
		$authorized = false;
		if ( current_user_can( 'wl_im_manage_report' ) ) {
			$authorized = true;
		} else {
			if ( current_user_can( 'wl_im_student' ) ) {
				if ( ( get_current_user_id() != 0 ) && ( get_current_user_id() == $user->ID ) ) {
					$authorized = true;
				}
			} else {
				$authorized = false;
			}
		}
		if ( ! $authorized ) {
			die();
		}
		?>
		<div class="row">
			<div class="col">
				<div class="mb-3 mt-2">
					<div class="text-center">
						<button type="button" id="wl-id-card-print" class="btn btn-sm btn-success"><i class="fa fa-print text-white"></i>&nbsp;<?php _e( 'Print ID Card', WL_IMP_DOMAIN ); ?></button><hr>
					</div>
					<?php
					require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_id_card.php' ); ?>
					<script>
						/* Function to print ID card */
						jQuery('#wl-id-card-print').on('click', function() {
			                jQuery.print("#wl-id-card");
			            });
					</script>
				</div>
			</div>
		</div>
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . '/assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
	<?php
		die();
	}

	/* View and print student admission detail */
	public static function print_student_admission_detail() {
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id" );
		if ( ! $row ) {
			die();
		}

		$user = null;
		if ( $row->user_id ) {
			$user = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}users WHERE ID = $row->user_id" );
		}
		$authorized = false;
		if ( current_user_can( 'wl_im_manage_report' ) ) {
			$authorized = true;
		} else {
			if ( current_user_can( 'wl_im_student' ) ) {
				if ( ( get_current_user_id() != 0 ) && ( get_current_user_id() == $user->ID ) ) {
					$authorized = true;
				}
			} else {
				$authorized = false;
			}
		}
		if ( ! $authorized ) {
			die();
		}
		?>
		<div class="row">
			<div class="col">
				<div class="mb-3 mt-2">
					<div class="text-center">
						<button type="button" id="wl-admission-detail-print" class="btn btn-sm btn-success"><i class="fa fa-print text-white"></i>&nbsp;<?php _e( 'Print Admission Detail', WL_IMP_DOMAIN ); ?></button><hr>
					</div>
					<?php
					require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_admission_detail.php' ); ?>
					<script>
						/* Function to print admission detail */
						jQuery('#wl-admission-detail-print').on('click', function() {
			                jQuery.print("#wl-admission-detail");
			            });
					</script>
				</div>
			</div>
		</div>
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . '/assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
	<?php
		die();
	}

	/* View and print student fees report */
	public static function print_student_fees_report() {
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id           = intval( sanitize_text_field( $_POST['id'] ) );
		$row          = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id" );
		$installments = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_im_installments WHERE is_deleted = 0  AND student_id = $id ORDER BY id DESC" );
		if ( ! $row ) {
			die();
		}

		if ( count ( $installments ) > 20 ) {
			$installments_recent    = array_slice( $installments, 0, 20 );
			$installments_remaining = array_slice( $installments, 20, count ( $installments ) - 20 );
		}

		$user = null;
		if ( $row->user_id ) {
			$user = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}users WHERE ID = $row->user_id" );
		}
		$authorized = false;
		$is_student = false;
		if ( current_user_can( 'wl_im_manage_report' ) ) {
			$authorized = true;
		} else {
			if ( current_user_can( 'wl_im_student' ) ) {
				$is_student = true;
				if ( ( get_current_user_id() != 0 ) && ( get_current_user_id() == $user->ID ) ) {
					$authorized = true;
				}
			} else {
				$authorized = false;
			}
		}
		if ( ! $authorized ) {
			die();
		}

		$pending_fees = number_format( $row->fees_payable - $row->fees_paid, 2, '.', '' );
		?>
		<div class="row">
			<div class="col">
				<div class="mb-3 mt-2">
					<div class="text-center">
						<button type="button" id="wl-fees-report-print" class="btn btn-sm btn-success"><i class="fa fa-print text-white"></i>&nbsp;<?php _e( 'Print Fees Report', WL_IMP_DOMAIN ); ?></button><hr>
					</div>
					<div>
						<?php
						if ( $is_student ) {
							require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_student_fees_report.php' );
						} else {
							require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_fees_report.php' );
						} ?>
						<script>
							/* Function to print fees report */
							jQuery('#wl-fees-report-print').on('click', function() {
				                jQuery.print("#wl-fees-report");
				            });
						</script>
	  				</div>
				</div>
			</div>
		</div>
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . '/assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
	<?php
		die();
	}

	/* View and print student certificate */
	public static function print_student_certificate() {
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $id AND course_completed = 1" );
		if ( ! $row ) {
			die();
		}

		$user = null;
		if ( $row->user_id ) {
			$user = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}users WHERE ID = $row->user_id" );
		}
		$authorized = false;
		if ( current_user_can( 'wl_im_manage_report' ) ) {
			$authorized = true;
		} else {
			if ( current_user_can( 'wl_im_student' ) ) {
				if ( ( get_current_user_id() != 0 ) && ( get_current_user_id() == $user->ID ) ) {
					$authorized = true;
				}
			} else {
				$authorized = false;
			}
		}
		if ( ! $authorized ) {
			die();
		}
		?>
		<div class="row">
			<div class="col">
				<div class="mb-3 mt-2">
					<div class="text-center">
						<button type="button" id="wl-certificate-print" class="btn btn-sm btn-success"><i class="fa fa-print text-white"></i>&nbsp;<?php _e( 'Print Certificate', WL_IMP_DOMAIN ); ?></button><hr>
					</div>
					<?php
					require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/partials/wl_im_certificate.php' ); ?>
					<script>
						/* Function to print certificate */
						jQuery('#wl-certificate-print').on('click', function() {
			                jQuery.print("#wl-certificate");
			            });
					</script>
				</div>
			</div>
		</div>
		<div class="wlim-loading text-center mt-3">
			<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . '/assets/images/loading.gif'; ?>">
			<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
		</div>
	<?php
		die();
	}

	/* Check permission to manage report */
	private static function check_permission() {
		if ( ! current_user_can( 'wl_im_manage_report' ) ) {
			die();
		}
	}
}