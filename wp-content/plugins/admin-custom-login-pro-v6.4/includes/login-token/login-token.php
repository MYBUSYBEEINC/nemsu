<?php
/* user login process without username and password */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
include( 'generatetoken.php' );
?>
    <style type="text/css">
        .date_fields {
            display: none;
        }

        .extra_action {
            display: inline-block;
            padding: 5px 2.5px;
        }
    </style>
    <div class="row">
        <div class="post-social-wrapper clearfix">
            <div class="col-md-12 post-social-item">
                <div class="panel panel-default">
                    <div class="panel-heading padding-none">
                        <div class="post-social post-social-xs" id="post-social-5">
                            <div class="text-center padding-all text-center">
                                <div class="textbox text-white   margin-bottom settings-title">
									<?php _e( 'Login With Token', WEBLIZAR_ACL_PRO ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Heading -->
        <div class="col-md-12">
            <ul class="nav nav-tabs product-tbs">
                <li class="active"><a data-toggle="tab" href="#gToken"> Access Token </a></li>
                <li><a data-toggle="tab" href="#lToken"><?php _e( 'Token List', WEBLIZAR_ACL_PRO ) ?>
                    </a></li>
            </ul>
        </div>
        <!-- <form method="post"> -->
        <div class="tab-content">
            <div id="gToken" class="tab-pane fade in active">
                <div class="panel panel-primary panel-default content-panel">
                    <div class="panel-body">
                        <table class="form-table">
                            <tr>
                                <th scope="row"
                                    colspan="2"><?php _e( 'Setting Provide A Feature to Non Existing Users To Gain Access Of Current Website With A Time Boundation', WEBLIZAR_ACL_PRO ) ?></th>
                            </tr>
                            <tr>
                                <th scope="row"><?php _e( '', WEBLIZAR_ACL_PRO ) ?></th>
                                <td></td>
                            </tr>
                            <tr class="la_fields">
                                <th scope="row"><?php _e( 'Email Id *', WEBLIZAR_ACL_PRO ) ?></th>
                                <td></td>
                            </tr>
                            <tr class="radio-span la_fields" style="border-bottom:none;">
                                <td>
                                    <input type="text" class="pro_text" id="new_user_eid" name="new_user_eid"
                                           placeholder="<?php _e( 'Email ID', WEBLIZAR_ACL_PRO ) ?>" size="56"
                                           value="<?php //echo $new_user_eid; ?>"/>
                                    <span><?php _e( 'Example', WEBLIZAR_ACL_PRO ) ?>: demo@gmail.com</span>
                                </td>
                            </tr>
                            <tr class="la_fields">
                                <th scope="row"><?php _e( 'First Name', WEBLIZAR_ACL_PRO ) ?>*</th>
                                <td></td>
                            </tr>
                            <tr class="radio-span la_fields" style="border-bottom:none;">
                                <td>
                                    <input type="text" class="pro_text" id="first_name" name="first_name"
                                           placeholder="<?php _e( 'First Name', WEBLIZAR_ACL_PRO ) ?>" size=""
                                           value="<?php //echo $first_name; ?>"/>
                                </td>
                            </tr>

                            <tr class="la_fields">
                                <th scope="row"><?php _e( 'Last Name', WEBLIZAR_ACL_PRO ) ?>*</th>
                                <td></td>
                            </tr>
                            <tr class="radio-span la_fields" style="border-bottom:none;">
                                <td>
                                    <input type="text" class="pro_text" id="last_name" name="last_name"
                                           placeholder="<?php _e( 'Last Name', WEBLIZAR_ACL_PRO ) ?>" size=""
                                           value="<?php //echo $last_name; ?>"/>
                                    <span></span>
                                </td>
                            </tr>

                            <tr class="la_fields">
                                <th scope="row"><?php _e( 'Role', WEBLIZAR_ACL_PRO ) ?>*</th>
                                <td></td>
                            </tr>
                            <tr class="radio-span la_fields" style="border-bottom:none;">
                                <td>
                                    <select class="standard-dropdown" id="role_user" name="role_user">
                                        <option value="">Select A Role</option>
										<?php
										foreach ( $roles as $role ) {
											?>
                                            <option value="<?php echo strtolower( $role ); ?>"><?php echo $role; ?></option>
											<?php
										}
										?>
                                    </select>
                                    <span></span>
                                </td>
                            </tr>
                            <tr class="la_fields">
                                <th scope="row"><?php _e( 'Expiry Time', WEBLIZAR_ACL_PRO ) ?>*</th>
                                <td></td>
                            </tr>
                            <tr class="radio-span la_fields" style="border-bottom:none;">
                                <td>
                                    <select class="standard-dropdown" id="expiry" name="expiry">
                                        <option selected="selected" value="">Select Time Duration</option>
                                        <option value="week">One Week</option>
                                        <option value="hour">One Hour</option>
                                        <option value="3_hours">Three Hours</option>
                                        <option value="day">One Day</option>
                                        <option value="3_days">Three Days</option>
                                        <option value="month">One Month</option>
                                        <!-- <option value="custom_date">Custom Date</option> -->
                                    </select>
                                    <span></span>
                                </td>
                            </tr>
                            <!-- <tr class="la_fields date_fields">
							<th scope="row" ><?php _e( 'Custom Date', WEBLIZAR_ACL_PRO ) ?></th>
							<td></td>
						</tr> -->
                            <tr class="radio-span la_fields date_fields" style="border-bottom:none;">
                                <td>
                                    <input type="text" class="date_custom" id="datepicker"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button data-dialog="somedialog501" class="dialog-button501" style="display:none">Open Dialog</button>
                <div id="somedialog501" class="dialog" style="position: fixed; z-index: 9999;">
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
                            <h2><?php _e( 'Token', WEBLIZAR_ACL_PRO ); ?><?php _e( 'Generated Successfully', WEBLIZAR_ACL_PRO ); ?></h2>
                            <div>
                                <button class="action dialog-button-close" data-dialog-close
                                        id="dialog-close-button501"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button data-dialog501="somedialog501" class="dialog-button501" style="display:none">Open Dialog
                </button>
                <div id="somedialog501" class="dialog" style="position: fixed; z-index: 9999;">
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
                            <h2><?php _e( 'Login Token', WEBLIZAR_ACL_PRO ) ?><?php _e( 'Reset Successfully', WEBLIZAR_ACL_PRO ) ?></h2>
                            <div>
                                <button class="action dialog-button-close" data-dialog-close
                                        id="dialog-close-button501"><?php _e( 'Close', WEBLIZAR_ACL_PRO ) ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Save & Reset Button -->
                <div class="panel panel-primary save-button-block">
                    <div class="panel-body">
                        <div class="pull-left">
                            <button type="button" onclick="return login_token('tokenSave', '');"
                                    class="btn btn-info btn-lg"><?php _e( 'Save Changes', WEBLIZAR_ACL_PRO ) ?></button>
                            <!-- <input type="submit" name="sub" value="sun"> -->
                        </div>
                        <div class="pull-right">
                            <button type="button" onclick="return login_token('tokenReset', '');"
                                    class="btn btn-primary btn-lg"><?php _e( 'Reset Default', WEBLIZAR_ACL_PRO ) ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="lToken" class="tab-pane fade">
				<?php
				/* get the list of users from meta table and access token */
				$gtt = new Generatetoken();
				?>
                <table class="table">
                    <tr>
                        <th>Email</th>
                        <th>Time left</th>
                        <th>Token URl</th>
                        <th>Actions</th>
                    </tr>
					<?php
					$gtt->get_list_users();
					?>
                </table>
                <button data-dialog503="somedialog503" class="dialog-button503" style="display:none">Open Dialog
                </button>
                <div id="somedialog503" class="dialog" style="position: fixed; z-index: 9999;">
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
                            <h2><?php _e( 'Token', WEBLIZAR_ACL_PRO ); ?><?php _e( 'Deleted Successfully', WEBLIZAR_ACL_PRO ); ?></h2>
                            <div>
                                <button class="action dialog-button-close" data-dialog-close
                                        id="dialog-close-button501"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="update_token" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php _e( "Edit Token", WEBLIZAR_ACL_PRO ); ?> </h4>
                </div>
                <div id="fetch_token_model">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- </form> -->
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("#expiry").change(function () {
                var inputValue = jQuery(this, ":selected").val();
                if (inputValue == "custom_date") {
                    jQuery(".date_fields").show(1000);
                }
                else {
                    jQuery(".date_fields").hide(1000);
                }
            });
        });

        // jQuery( function() {
        // 	    jQuery( "#datepicker" ).datepicker();
        // 	  } );
        function login_token(Action, id) {
            if (Action == "tokenSave") {
                (function () {
                    var dlgtrigger = document.querySelector('[data-dialog501]'),
                        somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog501')),
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
                var expiry = '';
                var new_user_eid = jQuery("#new_user_eid").val();
                var first_name = jQuery("#first_name").val();
                var last_name = jQuery("#last_name").val();
                var role_user = jQuery("#role_user").val();
                var expiry_temp = jQuery("#expiry").val();
                if (expiry_temp == 'custom_date') {
                    expiry = jQuery('.date_custom').val();
                }
                else {
                    expiry = expiry_temp;
                }
                if (new_user_eid == '') {
                    jQuery("#new_user_eid").focus();
                    return false;
                }
                if (first_name == '') {
                    jQuery("#first_name").focus();
                    return false;
                }
                if (last_name == '') {
                    jQuery("#last_name").focus();
                    return false;
                }
                if (role_user == '') {
                    jQuery("#role_user").focus();
                    return false;
                }
                if (expiry_temp == '') {
                    jQuery("#expiry_temp").focus();
                    return false;
                }
                var PostData = "Action=" + Action + "&new_user_eid=" + new_user_eid + "&first_name=" + first_name + "&last_name=" + last_name + "&role_user=" + role_user + "&expiry=" + expiry;
                jQuery.ajax({
                    dataType: 'html',
                    type: 'POST',
                    url: location.href,
                    cache: false,
                    data: PostData,
                    complete: function () {
                    },
                    success: function (data) {
                        jQuery(".dialog-button501").click();
                        setTimeout(function () {
                            jQuery("#dialog-close-button501").click();
                        }, 1000);
                        location.reload();
                    }
                });
            }
            if (Action == "tokenReset") {
                (function () {
                    var dlgtrigger = document.querySelector('[data-dialog501]'),
                        somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog501')),
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
                        document.getElementById("new_user_eid").value = "";
                        document.getElementById("first_name").value = "";
                        document.getElementById("last_name").value = "";
                        document.getElementById("role_user").value = "";
                        document.getElementById("expiry").value = "";
                        // Reset message box open
                        jQuery(".dialog-button501").click();
                        // Function to close message box
                        setTimeout(function () {
                            jQuery("#dialog-close-button501").click();
                        }, 1000);
                    }
                });
            }
        }

        function del_token(user_id) {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog503]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog503')),
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
            jQuery.confirm({
                title: 'Delete confirmations',
                content: 'Do You Want To Delete Token',
                icon: 'fa fa-question-circle',
                animation: 'scale',
                closeAnimation: 'scale',
                opacity: 0.5,
                buttons: {
                    'confirm': {
                        text: 'Proceed',
                        btnClass: 'btn-blue',
                        action: function () {
                            jQuery.confirm({
                                title: 'Delete',
                                content: 'Confirm Delete',
                                icon: 'fa fa-warning',
                                animation: 'scale',
                                closeAnimation: 'zoom',
                                buttons: {
                                    confirm: {
                                        text: 'Yes',
                                        btnClass: 'btn-orange',
                                        action: function () {
                                            var PostData = "user_id=" + user_id;
                                            jQuery.ajax({
                                                dataType: 'html',
                                                type: 'POST',
                                                url: location.href,
                                                cache: false,
                                                data: PostData,
                                                complete: function () {
                                                },
                                                success: function (data) {
                                                    jQuery(".dialog-button503").click();
                                                    setTimeout(function () {
                                                        jQuery("#dialog-close-button503").click();
                                                    }, 1000);
                                                    location.reload();
                                                }
                                            });
                                        }
                                    },
                                    cancel: function () {
                                        jQuery.alert('<strong>Delete Operation Cancel</strong>');
                                    }
                                }
                            });
                        }
                    },
                    cancel: function () {
                        jQuery.alert('<strong>Delete Operation Cancel</strong>');
                    },
                }
            });
        }

        function edit_token(user_id) {
            var user_id = "";
        }

    </script>
<?php
// if(isset($_POST['sub'])) {
if ( isset( $_POST['Action'] ) ) {
	$Action = $_POST['Action'];
	if ( $Action == "tokenSave" ) {
		$new_user_eid = sanitize_text_field( $_POST['new_user_eid'] );
		$first_name   = sanitize_text_field( $_POST['first_name'] );
		$last_name    = sanitize_text_field( $_POST['last_name'] );
		$role_user    = sanitize_text_field( $_POST['role_user'] );
		$expiry       = sanitize_text_field( $_POST['expiry'] );
		$user_data    = array(
			'new_user_eid' => $new_user_eid,
			'first_name'   => $first_name,
			'last_name'    => $last_name,
			'role_user'    => $role_user,
			'expiry'       => $expiry,
		);

		$gt = new Generatetoken();
		$gt->get_form_data( $user_data );
		$gt->create_new_user();
	}
}

if ( isset( $_POST['user_id'] ) ) {
	$user_id = $_POST['user_id'];
	wp_delete_user( $user_id, '' );
	delete_user_meta( $user_id, 'wacl_user' );
	delete_user_meta( $user_id, 'wacl_created' );
	delete_user_meta( $user_id, 'wacl_token' );
	delete_user_meta( $user_id, 'wacl_expiry' );
	delete_user_meta( $user_id, 'show_welcome_panel' );

}
// }

?>