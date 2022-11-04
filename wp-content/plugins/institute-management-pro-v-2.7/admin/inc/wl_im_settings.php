<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_PaymentHelper.php' );
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-cog"></i> <?php _e( 'Settings', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can view and modify settings.', WL_IMP_DOMAIN ); ?>
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
					<div class="col-xs-12">
						<div class="h3"><?php _e( 'Settings', WL_IMP_DOMAIN ); ?></div>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<form action="options.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<?php settings_fields( 'wl_im_settings_group' ); ?>
						<div class="col-xs-12 col-md-6">
							<button type="button" class="mt-2 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlim_general_settings" aria-expanded="true" aria-controls="wlim_general_settings">
								<?php esc_html_e( 'General Settings', WL_IMP_DOMAIN ); ?>
							</button>

							<div class="collapse border border-top-0 border-primary p-3" id="wlim_general_settings">
								<div class="form-check pl-0 mb-3">
									<input name="enable_enquiry_form_title" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-setting-enable_enquiry_form_title" value="yes" <?php checked( get_option( 'enable_enquiry_form_title', 'yes' ), 'yes' ); ?>>
									<label for="wlim-setting-enable_enquiry_form_title" class="form-check-label">
										<?php _e( 'Enable Enquiry Form Title', WL_IMP_DOMAIN ); ?>
									</label>
								</div>

								<div class="form-group">
									<label for="wlim-setting-enquiry_form_title" class="col-form-label">
										<?php _e( 'Enquiry Form Title', WL_IMP_DOMAIN ); ?>:
									</label>
									<input name="enquiry_form_title" type="text" class="form-control" id="wlim-setting-enquiry_form_title" placeholder="<?php _e( "Enquiry Form Title", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'enquiry_form_title', 'Online Admission Form' ); ?>">
								</div>

								<div class="form-group">
									<label for="wlim-setting-institute_pro_logo" class="col-form-label">
										<?php _e( 'Institute Pro Logo', WL_IMP_DOMAIN ); ?>:
									</label>
									<?php
									if( ! empty ( $logo_url = get_option( 'institute_pro_logo' ) ) ) { ?>
										<img src="<?php echo esc_url( $logo_url ); ?>" id="wlim-institute_pro_logo" class="img-responsive">
									<?php
									} ?>
									<input name="institute_pro_logo" type="file" class="form-control" id="wlim-setting-institute_pro_logo" placeholder="<?php _e( "Institute Logo", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_logo', '' ); ?>">
								</div>

								<div class="form-check pl-0 mb-3">
									<input name="enable_institute_pro_logo" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-setting-enable_institute_pro_logo" value="yes" <?php checked( get_option( 'enable_institute_pro_logo' ), 'yes' ); ?>>
									<label for="wlim-setting-enable_institute_pro_logo" class="form-check-label">
										<?php _e( 'Enable Institute Pro Logo', WL_IMP_DOMAIN ); ?>
									</label>
								</div>

								<div class="form-group">
									<label for="wlim-setting-institute_pro_name" class="col-form-label">
										<?php _e( 'Institute Name', WL_IMP_DOMAIN ); ?>:
									</label>
									<input name="institute_pro_name" type="text" class="form-control" id="wlim-setting-institute_pro_name" placeholder="<?php _e( "Institute Name", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_name', 'Sample Institute Name' ); ?>">
								</div>

								<div class="form-group">
									<label for="wlim-setting-institute_pro_address" class="col-form-label">
										<?php _e( 'Institute Address', WL_IMP_DOMAIN ); ?>:
									</label>
									<textarea name="institute_pro_address" rows="4" type="text" class="form-control" id="wlim-setting-institute_pro_address" placeholder="<?php _e( "Institute Address", WL_IMP_DOMAIN ); ?>"><?php echo get_option( 'institute_pro_address', 'Sample Institute Address' ); ?></textarea>
								</div>

								<div class="form-group">
									<label for="wlim-setting-institute_pro_phone" class="col-form-label">
										<?php _e( 'Institute Phone', WL_IMP_DOMAIN ); ?>:
									</label>
									<input name="institute_pro_phone" type="text" class="form-control" id="wlim-setting-institute_pro_phone" placeholder="<?php _e( "Institute Phone", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_phone', '9999999999' ); ?>">
								</div>

								<div class="form-group">
									<label for="wlim-setting-institute_pro_email" class="col-form-label">
										<?php _e( 'Institute Email', WL_IMP_DOMAIN ); ?>:
									</label>
									<input name="institute_pro_email" type="email" class="form-control" id="wlim-setting-institute_pro_email" placeholder="<?php _e( "Institute Email", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_email', 'sample_institute@domain.com' ); ?>">
								</div>

								<div class="form-group">
									<label for="wlim-setting-institute_pro_settings_enrollment_id_prefix" class="col-form-label">
										<?php _e( 'Enrollment ID Prefix', WL_IMP_DOMAIN ); ?>:
									</label>
									<input name="institute_pro_settings[enrollment_id_prefix]" type="text" class="form-control" id="wlim-setting-institute_pro_settings_enrollment_id_prefix" placeholder="<?php _e( "Enrollment ID Prefix (Default: EN)", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option("institute_pro_settings['enrollment_id_prefix']", ''); ?>">
								</div>

								<div class="form-group">
									<label for="wlim-setting-institute_pro_settings_receipt_number_prefix" class="col-form-label">
										<?php _e( 'Receipt Number Prefix', WL_IMP_DOMAIN ); ?>:
									</label>
									<input name="institute_pro_settings[receipt_number_prefix]" type="text" class="form-control" id="wlim-setting-institute_pro_settings_receipt_number_prefix" placeholder="<?php _e( "Receipt Number Prefix (Default: R)", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option("institute_pro_settings ['receipt_number_prefix']", ''); ?>">
								</div>
							</div>
						</div>

						<div class="mt-1 col-xs-12 col-md-6">
							<button type="button" class="mt-2 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlim_notification_settings" aria-expanded="true" aria-controls="wlim_notification_settings">
								<?php esc_html_e( 'Notification Settings', WL_IMP_DOMAIN ); ?>
							</button>

							<div class="collapse border border-top-0 border-primary p-3" id="wlim_notification_settings">
								<button type="button" class="mt-2 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlim_email_settings" aria-expanded="true" aria-controls="wlim_email_settings">
									<?php esc_html_e( 'Email Settings', WL_IMP_DOMAIN ); ?>
								</button>

								<div class="collapse border border-top-0 border-light" id="wlim_email_settings">
									<div class="card-body border">
										<div class="form-group">
											<label for="wlim-setting-institute_pro_email_host" class="col-form-label">
												<?php _e( 'Host', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_email_host" type="text" class="form-control" id="wlim-setting-institute_pro_email_host" placeholder="<?php _e( "SMTP Host", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_email_host', '' ); ?>">
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_email_username" class="col-form-label">
												<?php _e( 'Username', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_email_username" type="text" class="form-control" id="wlim-setting-institute_pro_email_username" placeholder="<?php _e( "SMTP Username", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_email_username', '' ); ?>">
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_email_password" class="col-form-label">
												<?php _e( 'Password', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_email_password" type="password" class="form-control" id="wlim-setting-institute_pro_email_password" placeholder="<?php _e( "SMTP Password", WL_IMP_DOMAIN ); ?>">
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_email_encryption" class="col-form-label">
												<?php _e( 'Encryption', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_email_encryption" type="text" class="form-control" id="wlim-setting-institute_pro_email_encryption" placeholder="<?php _e( "SMTP Encryption", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_email_encryption', 'tls' ); ?>">
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_email_port" class="col-form-label">
												<?php _e( 'Port', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_email_port" type="text" class="form-control" id="wlim-setting-institute_pro_email_port" placeholder="<?php _e( "SMTP Port", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_email_port', '587' ); ?>">
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_email_from" class="col-form-label">
												<?php _e( 'From', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_email_from" type="text" class="form-control" id="wlim-setting-institute_pro_email_from" placeholder="<?php _e( "Email From", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( 'institute_pro_email_from', '' ); ?>">
										</div>

										<button type="button" class="mt-3 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlim_configure_smtp" aria-expanded="true" aria-controls="wlim_configure_smtp">
											<?php esc_html_e( 'How to configure SMTP?', WL_IMP_DOMAIN ); ?>
										</button>

										<div class="collapse border border-top-0 border-light" id="wlim_configure_smtp">
											<ul class="list-group list-group-flush">
												<li class="list-group-item"><?php esc_html_e( 'You can either use SMTP as email carrier.', WL_IMP_DOMAIN ); ?></li>
												<li class="list-group-item"><?php esc_html_e( 'For example, to use Gmail as SMTP provider, you need to set SMTP host, encryption, port number, username and password.', WL_IMP_DOMAIN ); ?>
												</li>
												<li class="list-group-item">
													<span class="wlsm-font-bold"><?php esc_html_e( 'Host:', WL_IMP_DOMAIN ); ?></span>
													<span>smtp.gmail.com</span>
												</li>
												<li class="list-group-item">
													<span class="wlsm-font-bold"><?php esc_html_e( 'Username:', WL_IMP_DOMAIN ); ?></span>
													<span><?php esc_html_e( 'Your Gmail account email.', WL_IMP_DOMAIN ); ?></span>
												</li>
												<li class="list-group-item">
													<span class="wlsm-font-bold"><?php esc_html_e( 'Password:', WL_IMP_DOMAIN ); ?></span>
													<span><?php esc_html_e( 'Your Gmail account password.', WL_IMP_DOMAIN ); ?></span>
												</li>
												<li class="list-group-item">
													<span class="wlsm-font-bold"><?php esc_html_e( 'Encryption:', WL_IMP_DOMAIN ); ?></span>
													<span>tls</span>
												</li>
												<li class="list-group-item">
													<span class="wlsm-font-bold"><?php esc_html_e( 'Port:', WL_IMP_DOMAIN ); ?></span>
													<span>587</span>
												</li>
												<li class="list-group-item">
													<span class="text-danger wlsm-font-bold"><?php esc_html_e( 'Lastly, you will need to allow less secure app in your Gmail account.', WL_IMP_DOMAIN ); ?></span>
													<a target="_blank" href="https://myaccount.google.com/lesssecureapps?pli=1" class="text-primary">https://myaccount.google.com/lesssecureapps?pli=1</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="mt-1 col-xs-12 col-md-6">
							<button type="button" class="mt-2 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlim_payment_settings" aria-expanded="true" aria-controls="wlim_payment_settings">
								<?php esc_html_e( 'Payment Settings', WL_IMP_DOMAIN ); ?>
							</button>

							<div class="collapse border border-top-0 border-primary p-3" id="wlim_payment_settings">
								<div class="row">
									<div class="col">
										<div class="form-group">
								            <label for="wlim-setting-institute_pro_business" class="col-form-label"><?php _e( "Currency", WL_IMP_DOMAIN ); ?>:</label>
								            <select name="institute_pro_business[currency]" class="form-control" id="wlim-setting-institute_pro_business">
								            	<option value=""><?php _e( "None", WL_IMP_DOMAIN ); ?></option>
								            	<?php
								            	foreach( WL_IMP_PaymentHelper::get_all_currencies() as $code => $value ) { ?>
								            	<option value="<?php echo $code; ?>" <?php selected( get_option( "institute_pro_business['currency']"), $code ); ?>><?php echo $value . " (" . $code . ")"; ?></option>
								            	<?php
								            	} ?>
								            </select>
							            </div>
									</div>
								</div>

								<button type="button" class="mt-2 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlsm_paypal_settings" aria-expanded="true" aria-controls="wlsm_paypal_settings">
									<?php esc_html_e( 'PayPal Payment Gateway', WL_IMP_DOMAIN ); ?>
								</button>

								<div class="collapse border border-top-0 border-light" id="wlsm_paypal_settings">
									<div class="card-body border">
										<div class="form-check pl-0 mb-3">
											<?php
											$institute_pro_paypal_enable = get_option( 'institute_pro_paypal' );
											$institute_pro_paypal_enable = isset( $institute_pro_paypal_enable['enable'] ) ? $institute_pro_paypal_enable['enable'] : false; ?>
											<input name="institute_pro_paypal[enable]" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-setting-institute_pro_paypal_enable" value="yes" <?php checked( $institute_pro_paypal_enable, 'yes' ); ?>>
											<label for="wlim-setting-institute_pro_paypal_enable" class="form-check-label">
												<?php _e( 'Enable PayPal', WL_IMP_DOMAIN ); ?>
											</label>
										</div>
										<div class="form-group">
								            <label for="wlim-setting-institute_pro_paypal_mode" class="col-form-label"><?php _e( "PayPal Mode", WL_IMP_DOMAIN ); ?>:</label>
								            <select name="institute_pro_paypal[mode]" class="form-control" id="wlim-setting-institute_pro_paypal_mode">
								            	<option value="sandbox" <?php selected( get_option("institute_pro_paypal['mode']"), 'sandbox' ); ?>><?php _e( "Sandbox", WL_IMP_DOMAIN ); ?></option>
								            	<option value="live" <?php selected( get_option("institute_pro_paypal['mode']"), 'live' ); ?>><?php _e( "Live", WL_IMP_DOMAIN ); ?></option>
								            </select>
							            </div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_paypal_business_email" class="col-form-label">
												<?php _e( 'Business Email', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_paypal[business_email]" type="email" class="form-control" id="wlim-setting-institute_pro_paypal_business_email" placeholder="<?php _e( "PayPal Business Email", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( "institute_pro_paypal['business_email']", ''); ?>">
										</div>
										<div>
											<label><?php _e( "PayPal Notify URL", WL_IMP_DOMAIN ); ?>: </label><br>
											<span class="text-primary"><?php echo WL_IMP_PaymentHelper::get_paypal_notify_url(); ?></span><br>
											<small class="font-weight-bold">( <?php _e( 'To save transactions, you need to enable PayPal IPN (Instant Payment Notification) in your PayPal Business Account and use this notify URL' ); ?> )</small>
											<small>
												<ol>
													<li><?php _e( 'Log into your PayPal account.' ); ?></li>
													<li><?php _e( 'Go to Profile then "My Selling Tools".' ); ?></li>
													<li><?php _e( 'Look for an option labelled "Instant Payment Notification". Click on the update button for that option.' ); ?></li>
													<li><?php _e( 'Click "Choose IPN Settings".' ); ?></li>
													<li><?php _e( 'Enter the URL given above and hit "Save".' ); ?></li>
												</ol>
											</small>
										</div>
										<?php
										if ( empty( get_option( "institute_pro_business" )['currency'] ) ) { ?>
											<div class="text-danger">
												<?php _e( "Paypal is disabled.", WL_IMP_DOMAIN ); ?>
												<?php _e( "Please select a valid currency.", WL_IMP_DOMAIN ); ?>
											</div>
										<?php
										} elseif( ! WL_IMP_PaymentHelper::paypal_support_currency() ) { ?>
											<div class="text-danger">
												<?php _e( "PayPal is disabled.", WL_IMP_DOMAIN ); ?>
												<?php _e( "Currency", WL_IMP_DOMAIN ); ?>: <strong><?php echo get_option( "institute_pro_business" )['currency']; ?></strong>&nbsp;<?php _e( "is not supported.", WL_IMP_DOMAIN ); ?>
											</div>
										<?php
										}
										?>
									</div>
								</div>

								<button type="button" class="mt-2 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlsm_razorpay_settings" aria-expanded="true" aria-controls="wlsm_razorpay_settings">
									<?php esc_html_e( 'Razorpay Payment Gateway', WL_IMP_DOMAIN ); ?>
								</button>

								<div class="collapse border border-top-0 border-light" id="wlsm_razorpay_settings">
									<div class="card-body border">
										<div class="form-check pl-0 mb-3">
											<?php
											$institute_pro_razorpay_enable = get_option( 'institute_pro_razorpay' );
											$institute_pro_razorpay_enable = isset( $institute_pro_razorpay_enable['enable'] ) ? $institute_pro_razorpay_enable['enable'] : false; ?>
											<input name="institute_pro_razorpay[enable]" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-setting-institute_pro_razorpay_enable" value="yes" <?php checked( $institute_pro_razorpay_enable, 'yes' ); ?>>
											<label for="wlim-setting-institute_pro_razorpay_enable" class="form-check-label">
												<?php _e( 'Enable Razorpay', WL_IMP_DOMAIN ); ?>
											</label>
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_razorpay_key" class="col-form-label">
												<?php _e( 'Razorpay Key', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_razorpay[key]" type="text" class="form-control" id="wlim-setting-institute_pro_razorpay_key" placeholder="<?php _e( "Razorpay Key", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( "institute_pro_razorpay['key']", ''); ?>">
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_razorpay_secret" class="col-form-label">
												<?php _e( 'Razorpay Secret', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_razorpay[secret]" type="text" class="form-control" id="wlim-setting-institute_pro_razorpay_secret" placeholder="<?php _e( "Razorpay Secret", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( "institute_pro_razorpay['secret']", ''); ?>">
										</div>
										<?php
										if ( empty( get_option( "institute_pro_business" )['currency'] ) ) { ?>
											<div class="text-danger">
												<?php _e( "Razorpay is disabled.", WL_IMP_DOMAIN ); ?>
												<?php _e( "Please select a valid currency.", WL_IMP_DOMAIN ); ?>
											</div>
										<?php
										} elseif( ! WL_IMP_PaymentHelper::razorpay_support_currency() ) { ?>
											<div class="text-danger">
												<?php _e( "Razorpay is disabled.", WL_IMP_DOMAIN ); ?>
												<?php _e( "Currency", WL_IMP_DOMAIN ); ?>: <strong><?php echo get_option( "institute_pro_business" )['currency']; ?></strong>&nbsp;<?php _e( "is not supported.", WL_IMP_DOMAIN ); ?>
											</div>
										<?php
										}
										?>
									</div>
								</div>

								<button type="button" class="mt-2 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlsm_paystack_settings" aria-expanded="true" aria-controls="wlsm_paystack_settings">
									<?php esc_html_e( 'Paystack Payment Gateway', WL_IMP_DOMAIN ); ?>
								</button>

								<div class="collapse border border-top-0 border-light" id="wlsm_paystack_settings">
									<div class="card-body border">
										<div class="form-check pl-0 mb-3">
											<?php
											$institute_pro_paystack_enable = get_option( 'institute_pro_paystack' );
											$institute_pro_paystack_enable = isset( $institute_pro_paystack_enable['enable'] ) ? $institute_pro_paystack_enable['enable'] : false; ?>
											<input name="institute_pro_paystack[enable]" class="position-static mt-0 form-check-input" type="checkbox" id="wlim-setting-institute_pro_paystack_enable" value="yes" <?php checked( $institute_pro_paystack_enable, 'yes' ); ?>>
											<label for="wlim-setting-institute_pro_paystack_enable" class="form-check-label">
												<?php _e( 'Enable Paystack', WL_IMP_DOMAIN ); ?>
											</label>
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_paystack_key" class="col-form-label">
												<?php _e( 'Paystack Public Key', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_paystack[key]" type="text" class="form-control" id="wlim-setting-institute_pro_paystack_key" placeholder="<?php _e( "Paystack Public Key", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( "institute_pro_paystack['key']", ''); ?>">
										</div>
										<div class="form-group">
											<label for="wlim-setting-institute_pro_paystack_secret" class="col-form-label">
												<?php _e( 'Paystack Secret Key', WL_IMP_DOMAIN ); ?>:
											</label>
											<input name="institute_pro_paystack[secret]" type="text" class="form-control" id="wlim-setting-institute_pro_paystack_secret" placeholder="<?php _e( "Paystack Secret Key", WL_IMP_DOMAIN ); ?>" value="<?php echo get_option( "institute_pro_paystack['secret']", ''); ?>">
										</div>
										<?php
										if ( empty( get_option( "institute_pro_business" )['currency'] ) ) { ?>
											<div class="text-danger">
												<?php _e( "Paystack is disabled.", WL_IMP_DOMAIN ); ?>
												<?php _e( "Please select a valid currency.", WL_IMP_DOMAIN ); ?>
											</div>
										<?php
										} elseif( ! WL_IMP_PaymentHelper::paystack_support_currency() ) { ?>
											<div class="text-danger">
												<?php _e( "Paystack is disabled.", WL_IMP_DOMAIN ); ?>
												<?php _e( "Currency", WL_IMP_DOMAIN ); ?>: <strong><?php echo get_option( "institute_pro_business" )['currency']; ?></strong>&nbsp;<?php _e( "is not supported.", WL_IMP_DOMAIN ); ?>
											</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-md-6">
							<button type="button" class="mt-2 btn btn-block btn-primary" data-toggle="collapse" data-target="#wlim_shortcodes" aria-expanded="true" aria-controls="wlim_shortcodes">
								<?php esc_html_e( 'Shortcodes', WL_IMP_DOMAIN ); ?>
							</button>

							<div class="collapse border border-top-0 border-primary p-3" id="wlim_shortcodes">
								<ul class="list-group list-group-flush">
									<li class="list-group-item">
										<div class="text-center">
											<?php _e( 'To Display Enquiry Form on Front End, Copy and Paste Shortcode', WL_IMP_DOMAIN ); ?>:
											<div class="col-12 justify-content-center align-items-center">
												<span class="col-6">
							 						<strong id="wl_im_enquiry_form_shortcode">[institute_enquiry_form]</strong>
												</span>
												<span class="col-6">
													<button id="wl_im_enquiry_form_shortcode_copy" class="btn btn-outline-success btn-sm" type="button"><?php _e( 'Copy', WL_IMP_DOMAIN ); ?></button>
												</span>
											</div>
										</div>
									</li>

									<li class="list-group-item">
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
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="my-3 col-xs-12 col-md-12 text-center">
						<?php submit_button( __( 'Save Settings', WL_IMP_DOMAIN ), 'button button-primary', 'submit', false, array( 'class' => 'btn btn-default' ) ); ?>
						</div>
					</div>
				</form>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
	<!-- end - row 2 -->
</div>