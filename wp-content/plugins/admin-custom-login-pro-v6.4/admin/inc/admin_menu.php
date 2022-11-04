<?php defined( 'ABSPATH' ) or die(); ?>
<div class="wrap license-container">

    <div class="top_head">
        <div class="column-3">
            <div class="logo-section">
                <img class="logo" src="<?php echo WEBLIZAR_ACL_PLUGIN_URL_PRO . '/admin/inc/images/logo.png'; ?>">
            </div>
        </div>
        <div class="column-9">
            <h1><?php _e( "Thank you for choosing Admin Custom Login Pro Plugin", WEBLIZAR_ACL_PRO ); ?>!</h1>
            <p class="license_info"><?php _e( "Please activate this plugin with a license key. If you don’t have a license yet, you can purchase it from ", WEBLIZAR_ACL_PRO ); ?>
                <a href="https://weblizar.com/amember/signup/admin-custom-login-pro"
                   target="_blank"><?php _e( "here", WEBLIZAR_ACL_PRO ); ?></a>
            </p>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="license-section">
        <div class="license-section-inner">
            <h2><?php _e( "Let’s get some work done!", WEBLIZAR_ACL_PRO ); ?> </h2>
            <p><?php _e( "We have some useful links to get you started", WEBLIZAR_ACL_PRO ); ?>: </p>
			<?php
			require_once WEBLIZAR_ACL_PLUGIN_DIR_PATH_PRO . '/admin/WL_ACL_LM.php';
			$wl_acl_lm = WL_ACL_LM::get_instance();
			$validated = $wl_acl_lm->is_valid();

			if ( isset( $_POST['key'] ) && ! empty( $_POST['key'] ) ) {
				$license_key = preg_replace( '/[^A-Za-z0-9-_]/', '', trim( $_POST['key'] ) );
				if ( $wl_acl_lm->validate( $license_key ) ) {
					$validated = true;
				}
			} else {
				$wl_acl_lm->error_message = __( "Get Your License Key", WEBLIZAR_ACL_PRO ) . ' ' . '<a target="_blank" href="https://weblizar.com/amember/softsale/license">' . __( "Click Here", WEBLIZAR_ACL_PRO ) . '</a>';
			} ?>
            <div class="column-6">
				<?php
				if ( $validated ) {
					$key           = get_option( 'wl-acl-key' );
					$first_letters = substr( $key, 0, 3 );
					$last_letters  = substr( $key, - 3 );
					?>
                    <h2 class="license-message">
						<?php _e( "License Key applied", WEBLIZAR_ACL_PRO ); ?>
                        <span><a href="<?php echo admin_url(); ?>"><?php _e( "Click here to navigate to dashboard", WEBLIZAR_ACL_PRO ); ?></a></span>
                    </h2>

                    <div class="label">
                        <label for="license_key"><?php _e( "License Key", WEBLIZAR_ACL_PRO ); ?>:</label>
                    </div>
                    <div class="input-box">
                        <input id="license_key" name="key" type="text" class="regular-text"
                               value="<?php echo "{$first_letters}****************{$last_letters}"; ?>" disabled>
                    </div>
                    <div class="Configuration_btn">
                        <h2><?php _e( "Congratulation! Admin Custom Login Pro Plugin is activated.", WEBLIZAR_ACL_PRO ); ?></h2>
                        <div class="">
                            <a class="conf_btn"
                               href="<?php echo get_admin_url(); ?>admin.php?page=admin_custom_login"><?php _e( "Plugin Configuration Click Here", WEBLIZAR_ACL_PRO ); ?></a>
                        </div>
                    </div>
					<?php
				} else {
					if ( $wl_acl_lm->error_message ) { ?>
                        <h3 class="license-message"><?php echo $wl_acl_lm->error_message; ?></h3>
						<?php
					} ?>
                    <form method='post'>
                        <div class="label">
                            <label for="license_key"><?php _e( "License Key", WEBLIZAR_ACL_PRO ); ?>:</label>
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
                    <li><h3><?php _e( "Getting Started", WEBLIZAR_ACL_PRO ); ?></h3></li>
                    <li><i class="dashicons dashicons-video-alt3"></i><a target="_blank"
                                                                         href="https://www.youtube.com/channel/UCFve0DTmWU4OTHXAtUOpQ7Q/playlists"><?php _e( "Video Tutorial", WEBLIZAR_ACL_PRO ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-portfolio"></i><a target="_blank"
                                                                        href="https://weblizar.com/plugins/"><?php _e( "More Products", WEBLIZAR_ACL_PRO ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-admin-generic"></i><a target="_blank"
                                                                            href="https://weblizar.com/complete-website-set-design/"><?php _e( "Customize your site", WEBLIZAR_ACL_PRO ); ?></a></a>
                    </li>
                </ul>
                <ul class="weblizar-links">
                    <li><h3><?php _e( "Guides & Support", WEBLIZAR_ACL_PRO ); ?></h3></li>
                    <li><i class="dashicons dashicons-welcome-view-site"></i><a target="_blank"
                                                                                href="http://demo.weblizar.com/admin-custom-login-admin-demo/"><?php _e( "Plugin Demo", WEBLIZAR_ACL_PRO ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-admin-users"></i><a target="_blank"
                                                                          href="https://weblizar.com/documentation/plugins/admin-custom-login-pro/"><?php _e( "Documentation guide", WEBLIZAR_ACL_PRO ); ?></a>
                    </li>
                    <li><i class="dashicons dashicons-format-status"></i><a target="_blank"
                                                                            href="https://weblizar.com/forum/"><?php _e( "Support forum", WEBLIZAR_ACL_PRO ); ?></a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>