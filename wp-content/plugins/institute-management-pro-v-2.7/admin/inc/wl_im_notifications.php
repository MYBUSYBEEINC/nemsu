<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

$notification_by_list = WL_IMP_Helper::get_notification_by_list();
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-bell"></i> <?php _e( 'Notifications', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can send notifications to students.', WL_IMP_DOMAIN ); ?>
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
						<div class="h3"><?php _e( 'Send Notifications', WL_IMP_DOMAIN ); ?></div>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row">
					<div class="col-xs-12 col-md-8">
						<form id="wlim-notification-configure-form">
							<div class="form-group">
								<label for="wlim-notification_by" class="text-primary"><?php _e( 'Notification By', WL_IMP_DOMAIN ); ?>:</label>
								<select name="notification_by" class="form-control" id="wlim-notification_by">
									<option value="">---- <?php _e( 'Select Notification By', WL_IMP_DOMAIN ); ?> ----</option>
									<?php
									foreach( $notification_by_list as $key => $notification_by ) { ?>
									<option value="<?php echo $key; ?>"><?php _e( $notification_by, WL_IMP_DOMAIN ); ?></option>
									<?php
									} ?>
								</select>
							</div>
							<div class="wlim-loading text-center mt-3">
								<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
								<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-10">
						<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="send-notification-form" enctype="multipart/form-data">
							<?php $nonce = wp_create_nonce( 'wl-im-send-notification' ); ?>
			                <input type="hidden" name="security" value="<?php echo $nonce; ?>">
                			<input type="hidden" name="action" value="wl-im-send-notification">
			            	<div id="wlim-notification-configure"></div>
							<hr>
							<label class="text-primary"><?php _e( 'Notification Channel', WL_IMP_DOMAIN ); ?>: </label>
							<hr>
							<div class="form-check mb-3">
								<input type="checkbox" name="email_notification" class="form-check-input mt-1" id="wlim-email-notification">
								<label class="form-check-label mb-1 ml-4" for="wlim-email-notification"><?php _e( 'Email Notification', WL_IMP_DOMAIN ); ?></label>
							</div>
							<div class="card col wlim-email-template">
								<div class="card-header"><?php _e( 'Email Template', WL_IMP_DOMAIN ); ?></div>
								<div class="card-body">
									<div class="form-group">
										<label for="wlim-email-from" class="col-form-label"><?php _e( 'From', WL_IMP_DOMAIN ); ?>:</label>
										<input type="text" name="email_from" class="form-control" id="wlim-email-from" placeholder="<?php _e( "Email From", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_email_from' ); ?>">
									</div>
									<div class="form-group">
										<label for="wlim-email-subject" class="col-form-label">* <?php _e( 'Subject', WL_IMP_DOMAIN ); ?>:</label>
										<input type="text" name="email_subject" class="form-control" id="wlim-email-subject" placeholder="<?php _e( "Email Subject", WL_IMP_DOMAIN ); ?>">
									</div>
									<div class="form-group">
										<label for="wlim_email_body" class="col-form-label">* <?php _e( 'Body', WL_IMP_DOMAIN ); ?>:</label>
										<?php
										$settings = array(
											'media_buttons' => false,
											'textarea_name' => 'email_body',
											'textarea_rows' => 6,
											'quicktags' => array( 'buttons' => 'strong,em,del,ul,ol,li,code,close' )
										);
										wp_editor( '', 'wlim_email_body', $settings ); ?>
									</div>
									<div class="form-group">
										<label for="wlim-email-attachment" class="col-form-label"><?php _e( 'Attachments', WL_IMP_DOMAIN ); ?>:</label><br>
										<input type="file" name="attachment[]" id="wlim-email-attachment" multiple> (<?php _e( 'Hold Ctrl to select multiple files', WL_IMP_DOMAIN ); ?>)
									</div>
								</div>
							</div>
							<hr>
							<div class="wlim-loading text-center mt-3">
								<img class="mx-auto d-block" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/loading.gif'; ?>">
								<span class="text-secondary"><?php _e( 'Please wait', WL_IMP_DOMAIN ); ?>... <strong id="wlim-progress">0</strong>%</span>
							</div>
							<div class="mt-3">
								<button type="submit" class="btn btn-success float-right send-notification-submit"><?php _e( 'Send!', WL_IMP_DOMAIN ); ?></button>
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