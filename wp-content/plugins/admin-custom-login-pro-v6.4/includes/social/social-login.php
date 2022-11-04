<!-- Dashboard Settings panel content -->
<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="row">
    <div class="post-social-wrapper clearfix">
        <div class="col-md-12 post-social-item">
            <div class="panel panel-default">
                <div class="panel-heading padding-none">
                    <div class="post-social post-social-xs" id="post-social-5">
                        <div class="text-center padding-all text-center">
                            <div class="textbox text-white   margin-bottom settings-title">
								<?php _e( 'Social Login', WEBLIZAR_ACL_PRO ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary panel-default content-panel">
        <div class="panel-body">
            <table class="form-table">
                <tr class="radio-span" style="border-bottom:none;">
                    <th scope="row">
                        <i><?php _e( 'Note', WEBLIZAR_ACL_PRO ); ?>
                            : <?php _e( 'Social Login will only work on top level domain(s)', WEBLIZAR_ACL_PRO ); ?>
                            .</i>
                        <p><i>Valid URL www.example.com</i></p>
                        <p><i>Invalid URL www.example.com/demosite/</i></p>
                    </th>
                </tr>
                <tr>
                    <th scope="row"><?php _e( 'Login with Facebook', WEBLIZAR_ACL_PRO ) ?></th>
                    <td></td>
                </tr>
                <tr class="radio-span" style="border-bottom:none;">
                    <td>
						<span>
							<input type="radio" name="enable_facebook_login" value="yes" id="enable_facebook_login1"
								<?php if ( $enable_facebook_login == "yes" ) {
									echo "checked";
								} ?> />&nbsp;<?php _e( 'Enable', WEBLIZAR_ACL_PRO ) ?><br>
						</span>
                        <span>
							<input type="radio" name="enable_facebook_login" value="no" id="enable_facebook_login2"
								<?php if ( $enable_facebook_login == "no" ) {
									echo "checked";
								} ?> />&nbsp;<?php _e( 'Disable', WEBLIZAR_ACL_PRO ) ?><br>
						</span>
                    </td>
                </tr>
                <tr class="radio-span" style="border-bottom:none;">
                    <td>
                        <ul class="rcp_social_profile_admin">
							<?php
							if ( ! is_ssl() ) {
								?>
                                <li><?php _e( 'Facebook Login needs HTTPS. You currently do not have SSL installed.', WEBLIZAR_ACL_PRO ) ?></li>
								<?php
							} ?>
                            <li>
                                <label for="facebook-app-id"><?php _e( 'Facebook App ID', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="facebook-app-id" name="facebook-app-id"
                                        placeholder="<?php _e( 'Facebook App ID', WEBLIZAR_ACL_PRO ) ?>" size="56"
                                        value="<?php echo $facebook_app_id; ?>"/></li>
                            <li>
                                <label for="facebook-app-secret"><?php _e( 'Facebook App Secret', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="facebook-app-secret" name="facebook-app-secret"
                                        placeholder="<?php _e( 'Facebook App Secret', WEBLIZAR_ACL_PRO ) ?>" size="56"
                                        value="<?php echo $facebook_app_secret; ?>"/></li>
                            <li>
                                <label for="facebook-redirect-url"><?php _e( 'Facebook Redirect URL', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="facebook-redirect-url"
                                        name="facebook-redirect-url"
                                        placeholder="<?php _e( 'Facebook Redirect URL', WEBLIZAR_ACL_PRO ); ?>"
                                        size="56" value="<?php echo $facebook_redirect_url; ?>"/></li>
                        </ul>
                        <span><?php _e( 'Register your website with Facebook to get required Appid & Secret key', WEBLIZAR_ACL_PRO ); ?>
                            . <a href="https://weblizar.com/get-facebook-app-id/"><?php _e( 'Get the facebook Appid & Secret key', WEBLIZAR_ACL_PRO ); ?></a></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e( 'Login with Google', WEBLIZAR_ACL_PRO ) ?></th>
                    <td></td>
                </tr>
                <tr class="radio-span" style="border-bottom:none;">
                    <td>
						<span>
							<input type="radio" name="enable_google_login" value="yes" id="enable_google_login1"
								<?php if ( $enable_google_login == "yes" ) {
									echo "checked";
								} ?> />&nbsp;<?php _e( 'Enable', WEBLIZAR_ACL_PRO ) ?><br>
						</span>
                        <span>
							<input type="radio" name="enable_google_login" value="no" id="enable_google_login2"
								<?php if ( $enable_google_login == "no" ) {
									echo "checked";
								} ?> />&nbsp;<?php _e( 'Disable', WEBLIZAR_ACL_PRO ) ?><br>
						</span>
                    </td>
                </tr>
                <tr class="radio-span" style="border-bottom:none;">
                    <td>
                        <ul class="rcp_social_profile_admin">
                            <li>
                                <label for="google-client-id"><?php _e( 'Google Client ID', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="google-client-id" name="google-client-id"
                                        placeholder="<?php _e( 'Google Client ID', WEBLIZAR_ACL_PRO ) ?>" size="56"
                                        value="<?php echo $google_client_id; ?>"/></li>
                            <li>
                                <label for="google-client-secret"><?php _e( 'Google Client Secret', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="google-client-secret"
                                        name="google-client-secret"
                                        placeholder="<?php _e( 'Google Client Secret', WEBLIZAR_ACL_PRO ) ?>" size="56"
                                        value="<?php echo $google_client_secret; ?>"/></li>
                            <li>
                                <label for="google-redirect-url"><?php _e( 'Google Redirect URL', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="google-redirect-url" name="google-redirect-url"
                                        placeholder="<?php _e( 'Google Redirect URL', WEBLIZAR_ACL_PRO ); ?>" size="56"
                                        value="<?php echo $google_redirect_url; ?>"/></li>
                        </ul>
                        <span><?php _e( 'Register your website with Google to get required Appid & Secret key', WEBLIZAR_ACL_PRO ); ?>
                            . <a href="https://weblizar.com/blog/get-google-calendar-client-id-and-client-secret-key/"><?php _e( 'Get the Google Appid & Secret key', WEBLIZAR_ACL_PRO ); ?></a></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e( 'Login with Twitter', WEBLIZAR_ACL_PRO ) ?></th>
                    <td></td>
                </tr>
                <tr class="radio-span" style="border-bottom:none;">
                    <td>
						<span>
							<input type="radio" name="enable_twitter_login" value="yes" id="enable_twitter_login1"
								<?php if ( $enable_twitter_login == "yes" ) {
									echo "checked";
								} ?> />&nbsp;<?php _e( 'Enable', WEBLIZAR_ACL_PRO ) ?><br>
						</span>
                        <span>
							<input type="radio" name="enable_twitter_login" value="no" id="enable_twitter_login2"
								<?php if ( $enable_twitter_login == "no" ) {
									echo "checked";
								} ?> />&nbsp;<?php _e( 'Disable', WEBLIZAR_ACL_PRO ) ?><br>
						</span>
                    </td>
                </tr>
                <tr class="radio-span" style="border-bottom:none;">
                    <td>
                        <ul class="rcp_social_profile_admin">
                            <li>
                                <label for="twitter-consumer-key"><?php _e( 'Twitter Consumer Key', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="twitter-consumer-key"
                                        name="twitter-consumer-key"
                                        placeholder="<?php _e( 'Twitter Consumer Key', WEBLIZAR_ACL_PRO ) ?>" size="56"
                                        value="<?php echo $twitter_consumer_key; ?>"/></li>
                            <li>
                                <label for="twitter-consumer-secret"><?php _e( 'Twitter Consumer Secret', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="twitter-consumer-secret"
                                        name="twitter-consumer-secret"
                                        placeholder="<?php _e( 'Twitter Consumer Secret', WEBLIZAR_ACL_PRO ) ?>"
                                        size="56" value="<?php echo $twitter_consumer_secret; ?>"/></li>
                            <li>
                                <label for="twitter-oauth-callback"><?php _e( 'Twitter OAUTH Callback Url', WEBLIZAR_ACL_PRO ) ?></label><br><input
                                        type="text" class="pro_text" id="twitter-oauth-callback"
                                        name="twitter-oauth-callback"
                                        placeholder="<?php _e( 'Twitter OAUTH Callback Url', WEBLIZAR_ACL_PRO ); ?>"
                                        size="56" value="<?php echo $twitter_oauth_callback; ?>"/></li>
                        </ul>
                        <span><?php _e( 'Register your website with Twitter to get required Consumer Key & Consumer Secret', WEBLIZAR_ACL_PRO ); ?>
                            . <a href="https://weblizar.com/blog/"><?php _e( 'Get the Consumer Key & Consumer Secret', WEBLIZAR_ACL_PRO ); ?></a></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <button data-dialog51="somedialog51" class="dialog-button51" style="display:none">Open Dialog</button>
    <div id="somedialog51" class="dialog" style="position: fixed; z-index: 9999;">
        <div class="dialog__overlay"></div>
        <div class="dialog__content">
            <div class="morph-shape"
                 data-morph-open="M33,0h41c0,0,0,9.871,0,29.871C74,49.871,74,60,74,60H32.666h-0.125H6c0,0,0-10,0-30S6,0,6,0H33"
                 data-morph-close="M33,0h41c0,0-5,9.871-5,29.871C69,49.871,74,60,74,60H32.666h-0.125H6c0,0-5-10-5-30S6,0,6,0H33">
                <svg xmlns="" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
                    <path d="M33,0h41c0,0-5,9.871-5,29.871C69,49.871,74,60,74,60H32.666h-0.125H6c0,0-5-10-5-30S6,0,6,0H33"></path>
                </svg>
            </div>
            <div class="dialog-inner">
                <h2>
                    <strong><?php _e( 'Social Login', WEBLIZAR_ACL_PRO ) ?></strong> <?php _e( 'Setting Save Successfully', WEBLIZAR_ACL_PRO ) ?>
                </h2>
                <div>
                    <button class="action dialog-button-close" data-dialog-close
                            id="dialog-close-button51"><?php _e( 'Close', WEBLIZAR_ACL_PRO ) ?></button>
                </div>
            </div>
        </div>
    </div>
    <button data-dialog61="somedialog61" class="dialog-button61" style="display:none">Open Dialog</button>
    <div id="somedialog61" class="dialog" style="position: fixed; z-index: 9999;">
        <div class="dialog__overlay"></div>
        <div class="dialog__content">
            <div class="morph-shape"
                 data-morph-open="M33,0h41c0,0,0,9.871,0,29.871C74,49.871,74,60,74,60H32.666h-0.125H6c0,0,0-10,0-30S6,0,6,0H33"
                 data-morph-close="M33,0h41c0,0-5,9.871-5,29.871C69,49.871,74,60,74,60H32.666h-0.125H6c0,0-5-10-5-30S6,0,6,0H33">
                <svg xmlns="" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
                    <path d="M33,0h41c0,0-5,9.871-5,29.871C69,49.871,74,60,74,60H32.666h-0.125H6c0,0-5-10-5-30S6,0,6,0H33"></path>
                </svg>
            </div>
            <div class="dialog-inner">
                <h2>
                    <strong><?php _e( 'Social Login', WEBLIZAR_ACL_PRO ) ?></strong> <?php _e( 'Setting Reset Successfully', WEBLIZAR_ACL_PRO ) ?>
                </h2>
                <div>
                    <button class="action dialog-button-close" data-dialog-close
                            id="dialog-close-button61"><?php _e( 'Close', WEBLIZAR_ACL_PRO ) ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary save-button-block">
        <div class="panel-body">
            <div class="pull-left">
                <button type="button" onclick="return Custom_login_social_login('socialLoginSave', '');"
                        class="btn btn-info btn-lg"><?php _e( 'Save Changes', WEBLIZAR_ACL_PRO ) ?></button>
            </div>
            <div class="pull-right">
                <button type="button" onclick="return Custom_login_social_login('socialLoginReset', '');"
                        class="btn btn-primary btn-lg"><?php _e( 'Reset Default', WEBLIZAR_ACL_PRO ) ?></button>
            </div>
        </div>
    </div>
</div>
<!-- /row -->
<script>
    function Custom_login_social_login(Action, id) {
        if (Action == "socialLoginSave") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog51]'),

                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog51')),
                    // svg..
                    morphEl = somedialog.querySelector('.morph-shape'),
                    s = Snap(morphEl.querySelector('svg')),
                    path = s.select('path'),
                    steps = {
                        open: morphEl.getAttribute('data-morph-open'),
                        close: morphEl.getAttribute('data-morph-close')
                    },
                    dlg = new DialogFx(somedialog, {
                        onOpenDialog: function (instance) {
                            // animate path
                            setTimeout(function () {
                                path.stop().animate({'path': steps.open}, 1500, mina.elastic);
                            }, 250);
                        },
                        onCloseDialog: function (instance) {
                            // animate path
                            path.stop().animate({'path': steps.close}, 250, mina.easeout);
                        }
                    });
                dlgtrigger.addEventListener('click', dlg.toggle.bind(dlg));
            })();

            //enable disable
            if (document.getElementById('enable_facebook_login1').checked) {
                var enable_facebook_login = 'yes';
            } else {
                var enable_facebook_login = 'no';
            }
            if (document.getElementById('enable_google_login1').checked) {
                var enable_google_login = 'yes';
            } else {
                var enable_google_login = 'no';
            }
            if (document.getElementById('enable_twitter_login1').checked) {
                var enable_twitter_login = 'yes';
            } else {
                var enable_twitter_login = 'no';
            }

            //social login keys
            var facebook_app_id = encodeURIComponent(jQuery("#facebook-app-id").val());
            var facebook_app_secret = encodeURIComponent(jQuery("#facebook-app-secret").val());
            var facebook_redirect_url = encodeURIComponent(jQuery("#facebook-redirect-url").val());
            var google_client_id = encodeURIComponent(jQuery("#google-client-id").val());
            var google_client_secret = encodeURIComponent(jQuery("#google-client-secret").val());
            var google_redirect_url = encodeURIComponent(jQuery("#google-redirect-url").val());
            var twitter_consumer_key = encodeURIComponent(jQuery("#twitter-consumer-key").val());
            var twitter_consumer_secret = encodeURIComponent(jQuery("#twitter-consumer-secret").val());
            var twitter_oauth_callback = encodeURIComponent(jQuery("#twitter-oauth-callback").val());

            var PostData = "Action=" + Action + "&enable_facebook_login=" + enable_facebook_login + "&enable_google_login=" + enable_google_login + "&enable_twitter_login=" + enable_twitter_login + "&facebook_app_id=" + facebook_app_id + "&facebook_app_secret=" + facebook_app_secret + "&facebook_redirect_url=" + facebook_redirect_url + "&google_client_id=" + google_client_id + "&google_client_secret=" + google_client_secret + "&google_redirect_url=" + google_redirect_url + "&twitter_consumer_key=" + twitter_consumer_key + "&twitter_consumer_secret=" + twitter_consumer_secret + "&twitter_oauth_callback=" + twitter_oauth_callback;

            jQuery.ajax({
                dataType: 'html',
                type: 'POST',
                url: location.href,
                cache: false,
                data: PostData,
                complete: function () {
                },
                success: function (data) {
                    // Save message box open
                    jQuery(".dialog-button51").click();
                    // Function to close message box
                    setTimeout(function () {
                        jQuery("#dialog-close-button51").click();
                    }, 1000);
                }
            });
        }
        // Save Message box Close On Mouse Hover
        document.getElementById('dialog-close-button51').disabled = false;
        jQuery('#dialog-close-button51').hover(function () {
            jQuery("#dialog-close-button51").click();
            document.getElementById('dialog-close-button51').disabled = true;
        });

        // Reset Message box Close On Mouse Hover
        document.getElementById('dialog-close-button61').disabled = false;
        jQuery('#dialog-close-button61').hover(function () {
            jQuery("#dialog-close-button61").click();
            document.getElementById('dialog-close-button61').disabled = true;
        });
        if (Action == "socialLoginReset") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog61]'),

                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog61')),
                    // svg..
                    morphEl = somedialog.querySelector('.morph-shape'),
                    s = Snap(morphEl.querySelector('svg')),
                    path = s.select('path'),
                    steps = {
                        open: morphEl.getAttribute('data-morph-open'),
                        close: morphEl.getAttribute('data-morph-close')
                    },
                    dlg = new DialogFx(somedialog, {
                        onOpenDialog: function (instance) {
                            // animate path
                            setTimeout(function () {
                                path.stop().animate({'path': steps.open}, 1500, mina.elastic);
                            }, 250);
                        },
                        onCloseDialog: function (instance) {
                            // animate path
                            path.stop().animate({'path': steps.close}, 250, mina.easeout);
                        }
                    });
                dlgtrigger.addEventListener('click', dlg.toggle.bind(dlg));
            })();

            var PostData = "Action=" + Action;
            jQuery.ajax({
                dataType: 'html',
                type: 'POST',
                url: location.href,
                cache: false,
                data: PostData,
                complete: function () {
                },
                success: function (data) {
                    jQuery('input:radio[name="enable_facebook_login"]').filter('[value="no"]').attr('checked', true);
                    jQuery('input:radio[name="enable_google_login"]').filter('[value="no"]').attr('checked', true);
                    jQuery('input:radio[name="enable_twitter_login"]').filter('[value="no"]').attr('checked', true);

                    document.getElementById("facebook-app-id").value = "";
                    document.getElementById("facebook-app-secret").value = "";
                    document.getElementById("facebook-redirect-url").value = "<?php echo home_url( 'index.php' ); ?>";
                    document.getElementById("google-client-id").value = "";
                    document.getElementById("google-client-secret").value = "";
                    document.getElementById("google-redirect-url").value = "<?php echo home_url(); ?>";
                    document.getElementById("twitter-consumer-key").value = "";
                    document.getElementById("twitter-consumer-secret").value = "";
                    document.getElementById("twitter-oauth-callback").value = "<?php echo home_url(); ?>";
                    // Save message box open
                    jQuery(".dialog-button61").click();
                    // Function to close message box
                    setTimeout(function () {
                        jQuery("#dialog-close-button61").click();
                    }, 1000);
                }
            });
        }
    }
</script>
<?php
if ( isset( $_POST['Action'] ) ) {
	$Action = $_POST['Action'];
	//Save
	if ( $Action == "socialLoginSave" ) {
		$enable_facebook_login = sanitize_option( 'enable_facebook_login', $_POST['enable_facebook_login'] );
		$enable_google_login   = sanitize_option( 'enable_google_login', $_POST['enable_google_login'] );
		$enable_twitter_login  = sanitize_option( 'enable_twitter_login', $_POST['enable_twitter_login'] );

		$facebook_app_id         = sanitize_text_field( $_POST['facebook_app_id'] );
		$facebook_app_secret     = sanitize_text_field( $_POST['facebook_app_secret'] );
		$facebook_redirect_url   = sanitize_text_field( $_POST['facebook_redirect_url'] );
		$google_client_id        = sanitize_text_field( $_POST['google_client_id'] );
		$google_client_secret    = sanitize_text_field( $_POST['google_client_secret'] );
		$google_redirect_url     = sanitize_text_field( $_POST['google_redirect_url'] );
		$twitter_consumer_key    = sanitize_text_field( $_POST['twitter_consumer_key'] );
		$twitter_consumer_secret = sanitize_text_field( $_POST['twitter_consumer_secret'] );
		$twitter_oauth_callback  = sanitize_text_field( $_POST['twitter_oauth_callback'] );

		$Social_login = serialize( array(
			'enable_facebook_login'   => $enable_facebook_login,
			'enable_google_login'     => $enable_google_login,
			'enable_twitter_login'    => $enable_twitter_login,
			'facebook_app_id'         => $facebook_app_id,
			'facebook_app_secret'     => $facebook_app_secret,
			'facebook_redirect_url'   => $facebook_redirect_url,
			'google_client_id'        => $google_client_id,
			'google_client_secret'    => $google_client_secret,
			'google_redirect_url'     => $google_redirect_url,
			'twitter_consumer_key'    => $twitter_consumer_key,
			'twitter_consumer_secret' => $twitter_consumer_secret,
			'twitter_oauth_callback'  => $twitter_oauth_callback,
		) );
		update_option( 'Admin_custome_login_Social_login', $Social_login );
	}

	if ( $Action == "socialLoginReset" ) {
		$Social_login = serialize( array(
			'enable_facebook_login'   => 'no',
			'enable_google_login'     => 'no',
			'enable_twitter_login'    => 'no',
			'facebook_app_id'         => '',
			'facebook_app_secret'     => '',
			'facebook_redirect_url'   => home_url( 'index.php' ),
			'google_client_id'        => '',
			'google_client_secret'    => '',
			'google_redirect_url'     => home_url(),
			'twitter_consumer_key'    => '',
			'twitter_consumer_secret' => '',
			'twitter_oauth_callback'  => home_url(),
		) );
		update_option( 'Admin_custome_login_Social_login', $Social_login );
	}
}
?>