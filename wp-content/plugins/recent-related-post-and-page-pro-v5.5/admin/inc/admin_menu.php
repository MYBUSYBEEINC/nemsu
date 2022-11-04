<?php defined( 'ABSPATH' ) or die(); ?>
<div class="wrap license-container">

	<div class="top_head">
		<div class="column-3">
			<div class="logo-section">
				<img class="logo" src="<?php echo WL_RP_RP_PLUGIN_URL . '/admin/inc/images/logo.png'; ?>">
			</div>
		</div>
		<div class="column-9">
			<h1><?php _e( "Thank you for choosing Recent Related Post & Page Pro Plugin", 'rp_and_rp' ); ?>!</h1>
			<p class="license_info"><?php _e( "Please activate this plugin with a license key. If you don’t have a license yet, you can purchase it from ", 'rp_and_rp' ); ?>
				<a href="https://weblizar.com/amember/signup/recent-related-post-and-page-pro" target="_blank"><?php _e( "here", 'rp_and_rp' ); ?></a>
			</p>
		</div>
		
	</div>
	<div class="clearfix"></div>
	<div class="license-section">
		<div class="license-section-inner">
		<h2><?php _e( "Let’s get some work done!", 'rp_and_rp' ); ?> </h2>
		<p><?php _e( "We have some useful links to get you started", 'rp_and_rp' ); ?>: </p>
		<?php
		require_once RRPPP_PLUGIN_DIR_PATH . '/admin/WL_RRPPP_LM.php';
		$wl_rrppp_lm = WL_RRPPP_LM::get_instance();
		$validated = $wl_rrppp_lm->is_valid();

		if ( isset( $_POST['key'] ) && ! empty( $_POST['key'] ) ) {
			$license_key = preg_replace( '/[^A-Za-z0-9-_]/', '', trim( $_POST['key'] ) ); 
			if( $wl_rrppp_lm->validate( $license_key ) ) {
				$validated = true;
			}
		} else {
			$wl_rrppp_lm->error_message = __( "Get Your License Key", 'rp_and_rp' ) . ' ' . '<a target="_blank" href="https://weblizar.com/amember/softsale/license">' . __( "Click Here", 'rp_and_rp' ) . '</a>';
		} ?>
			<div class="column-6">
		<?php
		if( $validated ) {
			$key = get_option( 'wl-rrppp-key' );
			$first_letters = substr( $key, 0, 3 );
			$last_letters = substr( $key, -3 );
		?>
				<h2 class="license-message">
					<?php _e( "License Key applied", 'rp_and_rp' ); ?>
					<span><a href="<?php echo admin_url(); ?>"><?php _e( "Click here to navigate to dashboard", 'rp_and_rp' ); ?></a></span>
				</h2>

				<div class="label">
					<label for="license_key"><?php _e( "License Key", 'rp_and_rp' ); ?>:</label>
				</div>
				<div class="input-box">
					<input id="license_key" name="key" type="text" class="regular-text" value="<?php echo "{$first_letters}****************{$last_letters}"; ?>" disabled>
				</div>
				<div class="Configuration_btn">
					<h2><?php _e("Congratulation! Recent Related Post & Page Pro Plugin is activated.", 'rp_and_rp'); ?></h2>
					<div class="">
						<a class="conf_btn" href="<?php echo get_admin_url(); ?>post-new.php?post_type=rp_and_rp"><?php _e( "Plugin Configuration Click Here", 'rp_and_rp' ); ?></a>
					</div>
				</div>
		<?php
		} else {
			if ( $wl_rrppp_lm->error_message ) { ?>
				<h3 class="license-message"><?php echo $wl_rrppp_lm->error_message; ?></h3>
			<?php
			} ?>
				<form method='post'>
					<div class="label">
						<label for="license_key"><?php _e( "License Key", 'rp_and_rp' ); ?>:</label>
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
					<li><h3><?php _e( "Getting Started", 'rp_and_rp' ); ?></h3></li>
					<li><i class="dashicons dashicons-video-alt3"></i><a target="_blank" href="https://www.youtube.com/channel/UCFve0DTmWU4OTHXAtUOpQ7Q/playlists"><?php _e( "Video Tutorial", 'rp_and_rp' ); ?></a></li>
					<li><i class="dashicons dashicons-portfolio"></i><a target="_blank" href="https://weblizar.com/plugins/"><?php _e( "More Products", 'rp_and_rp' ); ?></a></li>
					<li><i class="dashicons dashicons-admin-customizer"></i><a target="_blank" href="https://weblizar.com/complete-website-set-design/"><?php _e( "Customize your site", "rp_and_rp" ); ?></a></li>
				</ul>
				<ul class="weblizar-links">
					<li><h3><?php _e( "Guides & Support", 'rp_and_rp' ); ?></h3></li>
					<li><i class="dashicons dashicons-welcome-view-site"></i><a target="_blank" href="http://demo.weblizar.com/recent-related-post-and-page-pro/"><?php _e( "Demo", 'rp_and_rp' ); ?></a></li>
					<li><i class="dashicons dashicons-admin-users"></i><a target="_blank" href="https://weblizar.com/documentation/plugins/recent-related-post-and-page-pro/"><?php _e( "Documentation guide", 'rp_and_rp' ); ?></a></li>
					<li><i class="dashicons dashicons-format-status"></i><a target="_blank" href="https://weblizar.com/forum/"><?php _e( "Support forum", 'rp_and_rp' ); ?></a></li>
					
				</ul>
			</div>
		</div>
	</div>
</div>