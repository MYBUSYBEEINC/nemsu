<!-- Login Attempt settings -->
<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<style>
    <?php if($enable_login_attempts=="no"){
	?>
    .las_fields {
        display: none;
    }

    <?php
		}
	?>
</style>
<div class="row">
    <div class="post-social-wrapper clearfix">
        <div class="col-md-12 post-social-item">
            <div class="panel panel-default">
                <div class="panel-heading padding-none">
                    <div class="post-social post-social-xs" id="post-social-5">
                        <div class="text-center padding-all text-center">
                            <div class="textbox text-white   margin-bottom settings-title">
								<?php _e( 'Login Retry Setting', WEBLIZAR_ACL_PRO ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Heading -->
    <div class="panel panel-primary panel-default content-panel">
        <div class="panel-body">
            <table class="form-table">
                <tr>
                    <th scope="row"
                        colspan="2"><?php _e( 'This Setting Prevents Unauthorized Users To invalid Login Attempts and Disable the login form for a while', WEBLIZAR_ACL_PRO ) ?></th>
                </tr>

                <tr>
                    <th scope="row"><?php _e( '', WEBLIZAR_ACL_PRO ) ?></th>
                    <td></td>
                </tr>
                <tr class="radio-span" style="border-bottom:none;">
                    <td>
						<span>
							<input type="radio" name="enable_login_attempts" value="yes"
                                   id="enable_login_attempts1" <?php if ( $enable_login_attempts == "yes" ) {
								echo "checked";
							} ?> />&nbsp;<?php _e( 'Enable', WEBLIZAR_ACL_PRO ) ?><br>
						</span>
                        <span>
							<input type="radio" name="enable_login_attempts" value="no"
                                   id="enable_login_attempts2" <?php if ( $enable_login_attempts == "no" ) {
								echo "checked";
							} ?> />&nbsp;<?php _e( 'Disable', WEBLIZAR_ACL_PRO ) ?><br>
						</span>
                    </td>
                </tr>
                <tr class="las_fields">
                    <th scope="row"><?php _e( 'Maximum Login Attempts', WEBLIZAR_ACL_PRO ) ?></th>
                    <td></td>
                </tr>
                <tr class="radio-span las_fields" style="border-bottom:none;">
                    <td>
                        <input type="text" class="pro_text" id="no_attempts" name="no_attempts"
                               placeholder="<?php _e( 'Maximum No Of Attempts', WEBLIZAR_ACL_PRO ) ?>" size="56"
                               value="<?php echo $no_attempts; ?>"/>
                        <p><?php _e( 'Maximum Allowed login attempt by user with wrong credentials', WEBLIZAR_ACL_PRO ) ?>
                            .</p>
                        <p></p>
                    </td>
                </tr>
                <tr class="las_fields">
                    <th scope="row"><?php _e( 'Time Duration ', WEBLIZAR_ACL_PRO ) ?></th>
                    <td></td>
                </tr>
                <tr class="radio-span las_fields" style="border-bottom:none;">
                    <td>
                        <input type="text" class="pro_text" id="time_duration_nxt_attempt"
                               name="time_duration_nxt_attempt"
                               placeholder="<?php _e( 'Time in minutes', WEBLIZAR_ACL_PRO ) ?>" size=""
                               value="<?php echo $time_duration_nxt_attempt; ?>"/>
                        <p><?php _e( 'Halt user after maximum login attempts', WEBLIZAR_ACL_PRO ) ?></p>
                        <p><?php _e( 'Time duration to halt user after maximum login attempts', WEBLIZAR_ACL_PRO ) ?>
                            .</p>
                        <span><?php _e( 'Enter numeric value e.g. 15', WEBLIZAR_ACL_PRO ) ?>
                            (<?php _e( 'Time duration 15 min', WEBLIZAR_ACL_PRO ) ?>)</span>
                    </td>
                </tr>
                <tr class="radio-span las_fields" style="border-bottom:none;">
                    <th scope="row"><?php _e( 'Enable Login Form Key', WEBLIZAR_ACL_PRO ) ?></th>
                </tr>
                <tr class="radio-span las_fields" style="border-bottom:none;">
                    <td>
                        <input type="text" class="pro_text" name="enable_login_form_key" id="enable_login_form_key"
                               value="<?php echo $enable_login_form_key; ?>">
                        <p>
                            <i><?php _e( 'This key remove the halt occured due to entering wrong username and password', WEBLIZAR_ACL_PRO ) ?></i>
                        </p>
                        <span>(<?php _e( 'For admin use only', WEBLIZAR_ACL_PRO ) ?>)</span>
						<?php if ( isset( $enable_login_form_key ) && ! empty( $enable_login_form_key ) ) {
							?>
                            <span><i><?php echo site_url() . "/wp-admin/?enable_login_form_key=" . $enable_login_form_key; ?></i></span>
							<?php
						}
						?>
                        <span></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <button data-dialog504="somedialog504" class="dialog-button504" style="display:none">Open Dialog</button>
    <div id="somedialog504" class="dialog" style="position: fixed; z-index: 9999;">
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
                <h2><?php _e( 'Login Attempts', WEBLIZAR_ACL_PRO ); ?><?php _e( 'Setting Saved Successfully', WEBLIZAR_ACL_PRO ); ?></h2>
                <div>
                    <button class="action dialog-button-close" data-dialog-close
                            id="dialog-close-button504"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                </div>
            </div>
        </div>
    </div>
    <button data-dialog505="somedialog505" class="dialog-button505" style="display:none">Open Dialog</button>
    <div id="somedialog505" class="dialog" style="position: fixed; z-index: 9999;">
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
                <h2><?php _e( 'Login Attempt', WEBLIZAR_ACL_PRO ) ?><?php _e( 'Reset Successfully', WEBLIZAR_ACL_PRO ) ?></h2>
                <div>
                    <button class="action dialog-button-close" data-dialog-close
                            id="dialog-close-button505"><?php _e( 'Close', WEBLIZAR_ACL_PRO ) ?></button>
                </div>
            </div>
        </div>
    </div>

    <button data-dialog514="somedialog514" class="dialog-button514" style="display:none">Open Dialog</button>
    <div id="somedialog514" class="dialog" style="position: fixed; z-index: 9999;">
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
                <h2><?php _e( 'Please Enter Valid Value', WEBLIZAR_ACL_PRO ); ?><?php _e( 'Example: 5', WEBLIZAR_ACL_PRO ); ?></h2>
                <div>
                    <button class="action dialog-button-close" data-dialog-close
                            id="dialog-close-button514"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                </div>
            </div>
        </div>
    </div>

    <button data-dialog515="somedialog515" class="dialog-button515" style="display:none">Open Dialog</button>
    <div id="somedialog515" class="dialog" style="position: fixed; z-index: 9999;">
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
                <h2><?php _e( 'Please Enter Valid Value of Time in Minutes', WEBLIZAR_ACL_PRO ); ?><?php _e( 'Example: 15', WEBLIZAR_ACL_PRO ); ?></h2>
                <div>
                    <button class="action dialog-button-close" data-dialog-close
                            id="dialog-close-button515"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary save-button-block">
        <div class="panel-body">
            <div class="pull-left">
                <!-- <button type="button" onclick="return login_attempt('attemptSave', '');" class="btn btn-info btn-lg"><?php _e( 'Save Changes', WEBLIZAR_ACL_PRO ) ?></button> -->
                <button type="button" onclick="return la('attemptSave', '');"
                        class="btn btn-info btn-lg"><?php _e( 'Save Changes', WEBLIZAR_ACL_PRO ) ?></button>
            </div>
            <div class="pull-right">
                <button type="button" onclick="return la('attemptReset', '');"
                        class="btn btn-primary btn-lg"><?php _e( 'Reset Default', WEBLIZAR_ACL_PRO ) ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("input[name = 'enable_login_attempts']").click(function () {
            var inputValue = jQuery(this).attr("value");
            if (inputValue == "yes") {
                jQuery(".las_fields").show(1000);
            }
            else {
                jQuery(".las_fields").hide(1000);
            }
        });
    });

    function la(Action, id) {
        if (Action == "attemptSave") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog504]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog504')),
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
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog514]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog514')),
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

            (function () {
                var dlgtrigger = document.querySelector('[data-dialog515]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog515')),
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
            var no_attempts = jQuery("#no_attempts").val();
            var time_duration_nxt_attempt = jQuery("#time_duration_nxt_attempt").val();
            var enable_login_form_key = jQuery("#enable_login_form_key").val();
            if (document.getElementById('enable_login_attempts1').checked) {
                var enable_login_attempts = document.getElementById('enable_login_attempts1').value;
            } else {
                var enable_login_attempts = document.getElementById('enable_login_attempts2').value;
            }
            if (enable_login_attempts == 'yes' && no_attempts == '') {
                // alert("Can't leave the field empty");
                jQuery(".dialog-button514").click();
                setTimeout(function () {
                    jQuery("#dialog-close-button514").click();
                }, 2000);
                jQuery("#no_attempts").focus();
                return false;
            }
            if (enable_login_attempts == 'yes' && time_duration_nxt_attempt == '') {
                jQuery(".dialog-button515").click();
                setTimeout(function () {
                    jQuery("#dialog-close-button515").click();
                }, 2000);
                jQuery("#time_duration_nxt_attempt").focus();
                return false;
            }
            if (enable_login_form_key == '') {
                jQuery("#enable_login_form_key").focus();
                return false;
            }
            var PostData = "Action=" + Action + "&no_attempts=" + no_attempts + "&time_duration_nxt_attempt=" + time_duration_nxt_attempt + "&enable_login_attempts=" + enable_login_attempts + "&enable_login_form_key=" + enable_login_form_key;
            jQuery.ajax({
                dataType: 'html',
                type: 'POST',
                url: location.href,
                cache: false,
                data: PostData,
                complete: function () {
                },
                success: function (data) {
                    jQuery(".dialog-button504").click();
                    setTimeout(function () {
                        jQuery("#dialog-close-button504").click();
                    }, 1000);
                }
            });

        }

        if (Action == "attemptReset") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog505]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog505')),
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
                    document.getElementById("no_attempts").value = "";
                    document.getElementById("time_duration_nxt_attempt").value = "";
                    jQuery(document).ready(function () {
                        jQuery('input[name=enable_login_attempts]').val(['no']);
                    });
                    // Reset message box open
                    jQuery(".dialog-button505").click();
                    // Function to close message box
                    setTimeout(function () {
                        jQuery("#dialog-close-button505").click();
                    }, 1000);
                }
            });
        }
    }

</script>
<?php
if ( isset( $_POST['Action'] ) ) {
	$Action = $_POST['Action'];
	/*Save Page Values */
	if ( $Action == "attemptSave" ) {
		$no_attempts               = sanitize_text_field( $_POST['no_attempts'] );
		$time_duration_nxt_attempt = sanitize_text_field( $_POST['time_duration_nxt_attempt'] );
		$enable_login_attempts     = sanitize_text_field( $_POST['enable_login_attempts'] );
		$enable_login_form_key     = sanitize_text_field( $_POST['enable_login_form_key'] );
		/* save values in option table */
		$attempt_page = serialize( array(
			'no_attempts'               => $no_attempts,
			'time_duration_nxt_attempt' => $time_duration_nxt_attempt,
			'enable_login_attempts'     => $enable_login_attempts,
			'enable_login_form_key'     => $enable_login_form_key,

		) );
		update_option( 'Admin_custome_login_attempts', $attempt_page );
	}

	/*Reset Page Settings */
	if ( $Action == "attemptReset" ) {
		$attempt_page = serialize( array(

			'no_attempts'               => '',
			'time_duration_nxt_attempt' => '',
			'enable_login_attempts'     => 'no',
			'enable_login_form_key'     => '',

		) );
		update_option( 'Admin_custome_login_attempts', $attempt_page );
	}
}
?>