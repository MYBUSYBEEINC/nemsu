<?php defined( 'ABSPATH' ) or die(); ?>
<div class="wrap license-container">
	<div class="top_head">
		<div class="column-3">
			<div class="logo-section">
				<img class="logo" src="<?php echo WL_IMP_PLUGIN_URL . '/admin/inc/images/logo.png'; ?>">
			</div>
		</div>
		<div class="column-9">
			<h1><?php _e( "Thank you for choosing Institute Management Pro Plugin", WL_IMP_DOMAIN ); ?>!</h1>
			<p class="license_info"><?php _e( "Please activate this plugin with a license key. If you don’t have a license yet, you can purchase it from ", WL_IMP_DOMAIN ); ?>
				<a href="https://weblizar.com/amember/signup/institute-management-pro" target="_blank"><?php _e( "here", WL_IMP_DOMAIN ); ?></a>
			</p>
		</div>
		
	</div>
	<div class="clearfix"></div>
	<div class="license-section">
		<div class="license-section-inner">
		<h2><?php _e( "Let’s get some work done!", WL_IMP_DOMAIN ); ?> </h2>
		<p><?php _e( "We have some useful links to get you started", WL_IMP_DOMAIN ); ?>: </p>
		<?php
		require_once WL_IMP_PLUGIN_DIR_PATH . '/admin/WL_IMP_LM.php';
		$wl_imp_lm = WL_IMP_LM::get_instance();
		$validated = $wl_imp_lm->is_valid();

		if ( isset( $_POST['key'] ) && ! empty( $_POST['key'] ) ) {
			$license_key = preg_replace( '/[^A-Za-z0-9-_]/', '', trim( $_POST['key'] ) ); 
			if( $wl_imp_lm->validate( $license_key ) ) {
				$validated = true;
			}
		} else {
			$wl_imp_lm->error_message = __( "Get Your License Key", WL_IMP_DOMAIN ) . ' ' . '<a target="_blank" href="https://weblizar.com/amember/softsale/license">' . __( "Click Here", WL_IMP_DOMAIN ) . '</a>';
		} ?>
			<div class="column-6">
		<?php
		if( $validated ) {
			$key = get_option( 'wl-imp-key' );
			$first_letters = substr( $key, 0, 3 );
			$last_letters = substr( $key, -3 );
		?>
				<h2 class="license-message">
					<?php _e( "License Key applied", WL_IMP_DOMAIN ); ?>
					<span><a href="<?php echo admin_url(); ?>"><?php _e( "Click here to navigate to dashboard", WL_IMP_DOMAIN ); ?></a></span>
				</h2>

				<div class="label">
					<label for="license_key"><?php _e( "License Key", WL_IMP_DOMAIN ); ?>:</label>
				</div>
				<div class="input-box">
					<input id="license_key" name="key" type="text" class="regular-text" value="<?php echo "{$first_letters}****************{$last_letters}"; ?>" disabled>
				</div>
				<div class="Configuration_btn">
					<h2><?php _e("Congratulation! Institute Management Pro Plugin is activated.", WL_IMP_DOMAIN); ?></h2>
					<div class="">
						<a class="conf_btn" href="<?php echo get_admin_url(); ?>admin.php?page=institute-management-pro-settings"><?php _e( "Plugin Configuration Click Here", WL_IMP_DOMAIN ); ?></a>
					</div>
				</div>
		<?php
		} else {
			if ( $wl_imp_lm->error_message ) { ?>
				<h3 class="license-message"><?php echo $wl_imp_lm->error_message; ?></h3>
			<?php
			} ?>
				<form method='post'>
					<div class="label">
						<label for="license_key"><?php _e( "License Key", WL_IMP_DOMAIN ); ?>:</label>
					</div>
					<div class="input-box">
						<input id="license_key" name="key" type="text" class="regular-text">
					</div>
					<input type="submit" class="button button-primary" value="Register plugin">
				</form>
		<?php
		} ?>
			</div>
			<div class="column-6">
				<ul class="weblizar-links">
					<li><h3><?php _e( "Getting Started", WL_IMP_DOMAIN ); ?></h3></li>
					<li><i class="dashicons dashicons-video-alt3"></i><a target="_blank" href="https://www.youtube.com/channel/UCFve0DTmWU4OTHXAtUOpQ7Q/playlists"><?php _e( "Video Tutorial", WL_IMP_DOMAIN ); ?></a></li>
					<li><i class="dashicons dashicons-portfolio"></i><a target="_blank" href="https://weblizar.com/plugins/"><?php _e( "More Products", WL_IMP_DOMAIN ); ?></a></li>
					<li><i class="dashicons dashicons-admin-generic"></i><a target="_blank" href="http://weblizar.com/"><?php _e( "Help Center", WL_IMP_DOMAIN ); ?></a></a></li>
				</ul>
				<ul class="weblizar-links">
					<li><h3><?php _e( "Guides & Support", WL_IMP_DOMAIN ); ?></h3></li>
					<li><i class="dashicons dashicons-welcome-view-site"></i><a target="_blank" href="http://demo.weblizar.com/institute-management-pro/"><?php _e( "Demo", WL_IMP_DOMAIN ); ?></a></li>
					<li><i class="dashicons dashicons-admin-users"></i><a target="_blank" href="https://weblizar.com/documentation/institute-management/"><?php _e( "Documentation guide", WL_IMP_DOMAIN ); ?></a></li>
					<li><i class="dashicons dashicons-format-status"></i><a target="_blank" href="https://weblizar.com/forum/"><?php _e( "Support forum", WL_IMP_DOMAIN ); ?></a></li>
				</ul>
				<div class="clearfix"></div>
				<div class="wlim-change-log">
					<div class="wlim-change-log-title-box">
						<div class="change-log-title"><a target="_blank" href="<?php echo WL_IMP_PLUGIN_URL . 'changelog.txt'; ?>"><?php echo _e( "Change Log", WL_IMP_DOMAIN ); ?></a></div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>