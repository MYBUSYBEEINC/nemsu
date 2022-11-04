<?php defined( 'ABSPATH' ) or die(); ?>
<div class="wrap license-container">

	<div class="top_head">
		<div class="column-3">
			<div class="logo-section">
				<img class="logo" src="<?php echo WEBLIZAR_A_P_SYSTEM . '/admin/inc/images/logo.png'; ?>">
			</div>
		</div>
		<div class="column-9">
			<h1><?php _e( "Thank you for choosing Appointment Scheduler Pro Plugin", WL_A_P_SYSTEM ); ?>!</h1>
			<p class="license_info"><?php _e( "Please activate this plugin with a license key. If you don’t have a license yet, you can purchase it from ", WL_A_P_SYSTEM ); ?>
				<a href="https://weblizar.com/amember/signup/appointment-scheduler-pro" target="_blank"><?php _e( "here", WL_A_P_SYSTEM ); ?></a>
			</p>
		</div>
		
	</div>
	<div class="clearfix"></div>
	<div class="license-section">
		<div class="license-section-inner">
		<h2><?php _e( "Let’s get some work done!", WL_A_P_SYSTEM ); ?> </h2>
		<p><?php _e( "We have some useful links to get you started", WL_A_P_SYSTEM ); ?>: </p>
		<?php
		require_once ASP_PLUGIN_DIR_PATH . '/admin/WL_ASP_LM.php';
		$wl_asp_lm = WL_ASP_LM::get_instance();
		$validated = $wl_asp_lm->is_valid();

		if ( isset( $_POST['key'] ) && ! empty( $_POST['key'] ) ) {
			$license_key = preg_replace( '/[^A-Za-z0-9-_]/', '', trim( $_POST['key'] ) ); 
			if( $wl_asp_lm->validate( $license_key ) ) {
				$validated = true;
			}
		} else {
			$wl_asp_lm->error_message = __( "Get Your License Key", WL_A_P_SYSTEM ) . ' ' . '<a target="_blank" href="https://weblizar.com/amember/softsale/license">' . __( "Click Here", WL_A_P_SYSTEM ) . '</a>';
		} ?>
			<div class="column-6">
		<?php
		if( $validated ) {
			$key = get_option( 'wl-acl-key' );
			$first_letters = substr( $key, 0, 3 );
			$last_letters = substr( $key, -3 );
		?>
				<h2 class="license-message">
					<?php _e( "License Key applied", WL_A_P_SYSTEM ); ?>
					<span><a href="<?php echo admin_url(); ?>"><?php _e( "Click here to navigate to dashboard", WL_A_P_SYSTEM ); ?></a></span>
				</h2>

				<div class="label">
					<label for="license_key"><?php _e( "License Key", WL_A_P_SYSTEM ); ?>:</label>
				</div>
				<div class="input-box">
					<input id="license_key" name="key" type="text" class="regular-text" value="<?php echo "{$first_letters}****************{$last_letters}"; ?>" disabled>
				</div>
				<div class="Configuration_btn">
					<h2><?php _e("Congratulation! Appointment Scheduler Pro Plugin is activated.", WL_A_P_SYSTEM); ?></h2>
					<div class="">
						<a class="conf_btn" href="<?php echo get_admin_url(); ?>admin.php?page=ap_system"><?php _e( "Plugin Configuration Click Here", WL_A_P_SYSTEM ); ?></a>
					</div>
				</div>
		<?php
		} else {
			if ( $wl_asp_lm->error_message ) { ?>
				<h3 class="license-message"><?php echo $wl_asp_lm->error_message; ?></h3>
			<?php
			} ?>
				<form method='post'>
					<div class="label">
						<label for="license_key"><?php _e( "License Key", WL_A_P_SYSTEM ); ?>:</label>
					</div>
					<div class="input-box">
						<input id="license_key" name="key" type="text" class="regular-text">
					</div>
					<input type="submit" class="button button-primary" value="Register plugin">
				</form>
		<?php
		} ?>
			</div>
			<div class="column-6-right">
				<ul class="weblizar-links">
					<li><h3><?php _e( "Getting Started", WL_A_P_SYSTEM ); ?></h3></li>
					<li><i class="dashicons dashicons-video-alt3"></i><a target="_blank" href="https://www.youtube.com/watch?v=0Bw_xYegHqM&t=130s"><?php _e("Video Tutorial", WL_A_P_SYSTEM); ?></a></li>
					<li><i class="dashicons dashicons-portfolio"></i><a target="_blank" href="https://weblizar.com/plugins/"><?php _e("More Products", WL_A_P_SYSTEM); ?></a></li>
					<li><i class="dashicons dashicons-admin-customizer"></i><a target="_blank" href="https://weblizar.com/complete-website-set-design/"><?php _e("Customize your site", WL_A_P_SYSTEM); ?></a></li>
				</ul>
				<ul class="weblizar-links">
					<li><h3><?php _e( "Guides & Support", WL_A_P_SYSTEM ); ?></h3></li>
					<li><i class="dashicons dashicons-welcome-view-site"></i><a target="_blank" href="http://demo.weblizar.com/blog/appointment-scheduler-pro/"><?php _e("Plugin Demo", WL_A_P_SYSTEM); ?></a></li>
					<li><i class="dashicons dashicons-admin-users"></i><a target="_blank" href="https://weblizar.com/documentation/plugins/appointment-scheduler-pro/"><?php _e("Documentation Guide", WL_A_P_SYSTEM); ?></a></li>
					<li><i class="dashicons dashicons-format-status"></i><a target="_blank" href="https://weblizar.com/forum/"><?php _e("Support forum", WL_A_P_SYSTEM ); ?></a></li>
					
				</ul>
			</div>
		</div>
	</div>
</div>