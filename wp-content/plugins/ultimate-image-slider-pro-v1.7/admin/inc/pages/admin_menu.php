<?php defined( 'ABSPATH' ) || die(); ?>
<div class="wrap license-container">
    <div class="top_head">
        <div class="column-3">
            <div class="logo-section">
                <img class="logo" src="<?php echo UISP_PLUGIN_URL . '/assets/img/logo.png'; ?>">
            </div>
        </div>
        <div class="column-9">
            <h1><?php _e( "Thank you for choosing Ultimate Image Slider Pro Plugin", 'urisp' ); ?>!</h1>
            <p class="license_info"><?php _e( "Please activate this plugin with a license key. If you don’t have a license yet, you can purchase it from ", 'urisp' ); ?>
                <a href="https://weblizar.com/amember/signup/ultimate-image-slider-pro"
                   target="_blank"><?php _e( "here", 'urisp' ); ?></a>
            </p>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="license-section">
        <div class="license-section-inner">
            <h2><?php _e( "Let’s get some work done!", 'urisp' ); ?> </h2>
            <p><?php _e( "We have some useful links to get you started", 'urisp' ); ?>: </p>
			<?php
			require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/UISP_LM.php';
			$uisp_lm = UISP_LM::get_instance();
			$validated = $uisp_lm->is_valid();

			if ( isset( $_POST['key'] ) && ! empty( $_POST['key'] ) ) {
				$license_key = preg_replace( '/[^A-Za-z0-9-_]/', '', trim( $_POST['key'] ) );
				if ( $uisp_lm->validate( $license_key ) ) {
					$validated = true;
				}
			} else {
				$uisp_lm->error_message = __( "Get Your License Key", 'urisp' ) . ' ' . '<a target="_blank" href="https://weblizar.com/amember/softsale/license">' . __( "Click Here", 'urisp' ) . '</a>';
			} ?>
            <div class="column-6">
				<?php
				if ( $validated ) {
					$key           = get_option( 'wl-mim-key' );
					$first_letters = substr( $key, 0, 3 );
					$last_letters  = substr( $key, - 3 );
					?>
                    <h2 class="license-message">
						<?php _e( "License Key applied", 'urisp' ); ?>
                        <span><a href="<?php echo admin_url(); ?>"><?php _e( "Click here to navigate to dashboard", 'urisp' ); ?></a></span>
                    </h2>

                    <div class="label">
                        <label for="license_key"><?php _e( "License Key", 'urisp' ); ?>:</label>
                    </div>
                    <div class="input-box">
                        <input id="license_key" name="key" type="text" class="regular-text"
                               value="<?php echo "{$first_letters}****************{$last_letters}"; ?>" disabled>
                    </div>
                    <div class="Configuration_btn">
                        <h2><?php _e( "Congratulation! Ultimate Image Slider Pro Plugin is activated.", 'urisp' ); ?></h2>
                        <div class="">
                            <a class="conf_btn"
                               href="<?php echo get_admin_url(); ?>edit.php?post_type=urisp_slider"><?php _e( "Plugin Configuration Click Here", 'urisp' ); ?></a>
                        </div>
                    </div>
					<?php
				} else {
					if ( $uisp_lm->error_message ) { ?>
                        <h3 class="license-message"><?php echo $uisp_lm->error_message; ?></h3>
						<?php
					} ?>
                    <form method='post'>
                        <div class="label">
                            <label for="license_key"><?php _e( "License Key", 'urisp' ); ?>:</label>
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
                    <li><h3><?php _e( "Getting Started", 'urisp' ); ?></h3></li>
                    <li><i class="dashicons dashicons-video-alt3"></i><a target="_blank"
                                                                         href="https://www.youtube.com/channel/UCFve0DTmWU4OTHXAtUOpQ7Q/playlists"><?php _e( "Video Tutorial", 'urisp' ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-portfolio"></i><a target="_blank"
                                                                        href="https://weblizar.com/plugins/"><?php _e( "More Products", 'urisp' ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-admin-generic"></i><a target="_blank"
                                                                            href="http://weblizar.com/"><?php _e( "Help Center", 'urisp' ); ?></a></a>
                    </li>
                </ul>
                <ul class="weblizar-links">
                    <li><h3><?php _e( "Guides & Support", 'urisp' ); ?></h3></li>
                    <li><i class="dashicons dashicons-welcome-view-site"></i><a target="_blank"
                                                                                href="http://demo.weblizar.com/ultimate-image-slider-pro/"><?php _e( "Demo", 'urisp' ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-admin-users"></i><a target="_blank"
                                                                          href="https://weblizar.com/documentation/ultimate-image-slider-pro/"><?php _e( "Documentation guide", 'urisp' ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-format-status"></i><a target="_blank"
                                                                            href="https://weblizar.com/forum/"><?php _e( "Support forum", 'urisp' ); ?></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
                <div class="wlim-change-log">
                    <div class="wlim-change-log-title-box">
                        <div class="change-log-title"><a target="_blank"
                                                         href="<?php echo UISP_PLUGIN_URL . 'changelog.txt'; ?>"><?php echo _e( "Change Log", 'urisp' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>