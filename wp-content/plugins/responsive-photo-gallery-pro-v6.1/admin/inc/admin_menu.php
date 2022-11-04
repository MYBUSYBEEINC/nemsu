<?php defined( 'ABSPATH' ) or die(); ?>
<div class="wrap license-container">

    <div class="top_head">
        <div class="column-3">
            <div class="logo-section">
                <img class="logo" src="<?php echo RPGP_PLUGIN_URL . '/admin/inc/images/logo.png'; ?>">
            </div>
        </div>
        <div class="column-9">
            <h1><?php _e( "Thank you for choosing Responsive Photo Gallery Pro Plugin", RPGP_TEXT_DOMAIN ); ?>!</h1>
            <p class="license_info"><?php _e( "Please activate this plugin with a license key. If you don’t have a license yet, you can purchase it from ", RPGP_TEXT_DOMAIN ); ?>
                <a href="https://weblizar.com/amember/signup/responsive-photo-gallery-pro"
                   target="_blank"><?php _e( "here", RPGP_TEXT_DOMAIN ); ?></a>
            </p>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="license-section">
        <div class="license-section-inner">
            <h2><?php _e( "Let’s get some work done!", RPGP_TEXT_DOMAIN ); ?> </h2>
            <p><?php _e( "We have some useful links to get you started", RPGP_TEXT_DOMAIN ); ?>: </p>
			<?php
			require_once RPGP_PLUGIN_DIR_PATH . '/admin/WL_RPGP_LM.php';
			$wl_rpgp_lm = WL_RPGP_LM::get_instance();
			$validated  = $wl_rpgp_lm->is_valid();

			if ( isset( $_POST['key'] ) && ! empty( $_POST['key'] ) ) {
				$license_key = preg_replace( '/[^A-Za-z0-9-_]/', '', trim( $_POST['key'] ) );
				if ( $wl_rpgp_lm->validate( $license_key ) ) {
					$validated = true;
				}
			} else {
				$wl_rpgp_lm->error_message = __( "Get Your License Key", RPGP_TEXT_DOMAIN ) . ' ' . '<a target="_blank" href="https://weblizar.com/amember/softsale/license">' . __( "Click Here", RPGP_TEXT_DOMAIN ) . '</a>';
			} ?>
            <div class="column-6">
				<?php
				if ( $validated ) {
					$key           = get_option( 'wl-rpgp-key' );
					$first_letters = substr( $key, 0, 3 );
					$last_letters  = substr( $key, - 3 );
					?>
                    <h2 class="license-message">
						<?php _e( "License Key applied", RPGP_TEXT_DOMAIN ); ?>
                        <span><a href="<?php echo admin_url(); ?>"><?php _e( "Click here to navigate to dashboard", RPGP_TEXT_DOMAIN ); ?></a></span>
                    </h2>

                    <div class="label">
                        <label for="license_key"><?php _e( "License Key", RPGP_TEXT_DOMAIN ); ?>:</label>
                    </div>
                    <div class="input-box">
                        <input id="license_key" name="key" type="text" class="regular-text"
                               value="<?php echo "{$first_letters}****************{$last_letters}"; ?>" disabled>
                    </div>
                    <div class="Configuration_btn">
                        <h2><?php _e( "Congratulation! Responsive Photo Gallery Pro Plugin is activated.", RPGP_TEXT_DOMAIN ); ?></h2>
                        <div class="">
                            <a class="conf_btn"
                               href="<?php echo get_admin_url(); ?>post-new.php?post_type=rpgp_gallery"><?php _e( "Plugin Configuration Click Here", RPGP_TEXT_DOMAIN ); ?></a>
                        </div>
                    </div>
					<?php
				} else {
					if ( $wl_rpgp_lm->error_message ) { ?>
                        <h3 class="license-message"><?php echo $wl_rpgp_lm->error_message; ?></h3>
						<?php
					} ?>
                    <form method='post'>
                        <div class="label">
                            <label for="license_key"><?php _e( "License Key", RPGP_TEXT_DOMAIN ); ?>:</label>
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
                    <li><h3><?php _e( "Getting Started", RPGP_TEXT_DOMAIN ); ?></h3></li>
                    <li><i class="dashicons dashicons-video-alt3"></i><a target="_blank"
                                                                         href="https://www.youtube.com/channel/UCFve0DTmWU4OTHXAtUOpQ7Q/playlists"><?php _e( "Video Tutorial", RPGP_TEXT_DOMAIN ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-portfolio"></i><a target="_blank"
                                                                        href="https://weblizar.com/plugins/"><?php _e( "More Products", RPGP_TEXT_DOMAIN ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-admin-customizer"></i><a target="_blank"
                                                                               href="https://weblizar.com/complete-website-set-design/"><?php _e( "Customize your site", RPGP_TEXT_DOMAIN ); ?></a>
                    </li>
                </ul>
                <ul class="weblizar-links">
                    <li><h3><?php _e( "Guides & Support", RPGP_TEXT_DOMAIN ); ?></h3></li>
                    <li><i class="dashicons dashicons-welcome-view-site"></i><a target="_blank"
                                                                                href="http://demo.weblizar.com/blog/responsive-photo-gallery-pro-demo/"><?php _e( "Demo", RPGP_TEXT_DOMAIN ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-admin-users"></i><a target="_blank"
                                                                          href="https://weblizar.com/documentation/plugins/responsive-photo-gallery-pro/"><?php _e( "Documentation guide", RPGP_TEXT_DOMAIN ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-format-status"></i><a target="_blank"
                                                                            href="https://weblizar.com/forum/"><?php _e( "Support forum", RPGP_TEXT_DOMAIN ); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>