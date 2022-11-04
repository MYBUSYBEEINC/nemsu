<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @param Login Restriction According To Role
 * @param Login Restriction According to Ip (ip range or paricular ip address)
 */
/* create html */
?>
<div class="row">
    <div class="post-social-wrapper clearfix">
        <div class="col-md-12 post-social-item">
            <div class="panel panel-default">
                <div class="panel-heading padding-none">
                    <div class="post-social post-social-xs" id="post-social-5">
                        <div class="text-center padding-all text-center">
                            <div class="textbox text-white   margin-bottom settings-title">
								<?php _e( 'Login Restriction', WEBLIZAR_ACL_PRO ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Heading -->
    <div class="col-md-12">
        <ul class="nav nav-tabs product-tbs">
            <li class="active"><a data-toggle="tab"
                                  href="#rr"><?php _e( 'Restriction Using Role', WEBLIZAR_ACL_PRO ) ?></a></li>
            <li><a data-toggle="tab"
                   href="#rbyno"><?php _e( 'Restriction According to No of Users Login', WEBLIZAR_ACL_PRO ) ?></a></li>
            <li><a data-toggle="tab" href="#rbyip"><?php _e( 'Restriction According to IP', WEBLIZAR_ACL_PRO ) ?></a>
            </li>
            <li><a data-toggle="tab"
                   href="#rbyuser"><?php _e( 'Restriction According to Users', WEBLIZAR_ACL_PRO ) ?></a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="rr" class="tab-pane fade in active">
            <div class="panel panel-primary panel-default content-panel">
                <div class="panel-body">
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e( 'Restriction Settings', WEBLIZAR_ACL_PRO ) ?></th>
                            <td></td>
                        </tr>

                        <tr>
                            <td scope="row"><?php _e( 'Restrict the users to login by user role. Select a role, e.g. Editor, and save it. Now, users with role Editor, will not able to login to wp-admin', WEBLIZAR_ACL_PRO ) ?>
                                .
                            </td>
                            <td></td>
                        </tr>
                        <tr class="radio-span" style="border-bottom:none;">
                            <td>
									<span>
										<input type="radio" name="enable_restrict_attempts" value="yes"
                                               id="enable_restrict_attempts1"
											<?php if ( $enable_restrict_attempts == "yes" ) {
												echo "checked";
											} ?> />&nbsp;<?php _e( 'Enable', WEBLIZAR_ACL_PRO ) ?><br>
									</span>
                                <span>
										<input type="radio" name="enable_restrict_attempts" value="no"
                                               id="enable_restrict_attempts2"
											<?php if ( $enable_restrict_attempts == "no" ) {
												echo "checked";
											} ?> />&nbsp;<?php _e( 'Disable', WEBLIZAR_ACL_PRO ) ?><br>
									</span>
                            </td>
                        </tr>
                        <tr class="las_fields_11">
                            <th scope="row"><?php _e( 'Select The Role', WEBLIZAR_ACL_PRO ) ?></th>
                            <td></td>
                        </tr>
                        <tr class="radio-span las_fields_11" style="border-bottom:none;">
                            <td>
                                <select class="standard-dropdown" id="user_role" name="user_role">
                                    <option value="">Select A Role</option>
									<?php
									foreach ( $roles as $role ) {
										if ( $role != 'Administrator' ) {
											?>
                                            <option <?php echo( $user_role == strtolower( $role ) ? 'selected' : '' ) ?>
                                                    value="<?php echo strtolower( $role ); ?>"><?php echo $role; ?></option>
											<?php
										}
									}
									?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Panel -->
            <button data-dialog506="somedialog506" class="dialog-button506" style="display:none">Open Dialog</button>
            <div id="somedialog506" class="dialog" style="position: fixed; z-index: 9999;">
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
                        <h2><?php _e( 'Login Restriction', WEBLIZAR_ACL_PRO ); ?>
                            &nbsp;<?php _e( 'Setting Saved Successfully', WEBLIZAR_ACL_PRO ); ?></h2>
                        <div>
                            <button class="action dialog-button-close" data-dialog-close
                                    id="dialog-close-button506"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <button data-dialog507="somedialog507" class="dialog-button507" style="display:none">Open Dialog</button>
            <div id="somedialog507" class="dialog" style="position: fixed; z-index: 9999;">
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
                                    id="dialog-close-button507"><?php _e( 'Close', WEBLIZAR_ACL_PRO ) ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Save & Reset Button -->
            <div class="panel panel-primary save-button-block">
                <div class="panel-body">
                    <div class="pull-left">
                        <button type="button" onclick="return ls('restrictionSave', '');"
                                class="btn btn-info btn-lg"><?php _e( 'Save Changes', WEBLIZAR_ACL_PRO ) ?></button>
                    </div>
                    <div class="pull-right">
                        <button type="button" onclick="return ls('restrictionReset', '');"
                                class="btn btn-primary btn-lg"><?php _e( 'Reset Default', WEBLIZAR_ACL_PRO ) ?></button>
                    </div>
                </div>
            </div>
        </div> <!-- restriction by role tab -->
        <div id="rbyno" class="tab-pane fade">
            <div class="panel panel-primary panel-default content-panel">
                <div class="panel-body">
                    <table class="form-table">
                        <tr class="radio-span" style="border-bottom:none;">
                            <td>
									<span>
										<input type="radio" name="enable_restrict_maxuser" value="yes"
                                               id="enable_restrict_maxuser1"
											<?php if ( $enable_restrict_maxuser == "yes" ) {
												echo "checked";
											} ?> />&nbsp;<?php _e( 'Enable', WEBLIZAR_ACL_PRO ) ?><br>
									</span>
                                <span>
										<input type="radio" name="enable_restrict_maxuser" value="no"
                                               id="enable_restrict_maxuser2"
											<?php if ( $enable_restrict_maxuser == "no" ) {
												echo "checked";
											} ?> />&nbsp;<?php _e( 'Disable', WEBLIZAR_ACL_PRO ) ?><br>
									</span>
                            </td>
                        </tr>
                        <tr class="las_fields_2">
                            <th scope="row"><?php _e( 'Max No Of Users', WEBLIZAR_ACL_PRO ) ?></th>
                            <td></td>
                        </tr>
                        <tr class="las_fields_2">
                            <td scope="row"><?php _e( 'Restrict limited no of users to login wp admin panel. E.g. 4, can login the admin panel, please enter 4 and save. Now only 4 users can login to wordpress admin panel.', WEBLIZAR_ACL_PRO ) ?></td>
                            <td></td>
                        </tr>
                        <tr class="las_fields_2">
                            <th scope="row"><?php _e( 'Enter No Of Users', WEBLIZAR_ACL_PRO ) ?></th>
                            <td>
                                <input type="text" name="max_users" id="max_users" class="pro_text"
                                       placeholder="Max Users Allowed" value="<?php echo $max_user; ?>">
                                <span><i>example: 5</i></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <button data-dialog508="somedialog508" class="dialog-button508" style="display:none">Open Dialog
                </button>
                <div id="somedialog508" class="dialog" style="position: fixed; z-index: 9999;">
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
                            <h2><?php _e( 'Login Attempts', WEBLIZAR_ACL_PRO ); ?>
                                &nbsp;<?php _e( 'Setting Saved Successfully', WEBLIZAR_ACL_PRO ); ?></h2>
                            <div>
                                <button class="action dialog-button-close" data-dialog-close
                                        id="dialog-close-button508"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button data-dialog509="somedialog509" class="dialog-button509" style="display:none">Open Dialog
                </button>
                <div id="somedialog509" class="dialog" style="position: fixed; z-index: 9999;">
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
                                        id="dialog-close-button509"><?php _e( 'Close', WEBLIZAR_ACL_PRO ) ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button data-dialog516="somedialog516" class="dialog-button516" style="display:none">Open Dialog
                </button>
                <div id="somedialog516" class="dialog" style="position: fixed; z-index: 9999;">
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
                            <h2><?php _e( 'Please Enter Valid Number Of Users', WEBLIZAR_ACL_PRO ); ?>
                                &nbsp;<?php _e( 'Example: 5', WEBLIZAR_ACL_PRO ); ?></h2>
                            <div>
                                <button class="action dialog-button-close" data-dialog-close
                                        id="dialog-close-button516"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Save & Reset Button -->
                <div class="panel panel-primary save-button-block">
                    <div class="panel-body">
                        <div class="pull-left">
                            <button type="button" onclick="return ls('restriction_MaxuserSave', '');"
                                    class="btn btn-info btn-lg"><?php _e( 'Save Changes', WEBLIZAR_ACL_PRO ) ?></button>
                        </div>
                        <div class="pull-right">
                            <button type="button" onclick="return ls('restriction_MaxuserReset', '');"
                                    class="btn btn-primary btn-lg"><?php _e( 'Reset Default', WEBLIZAR_ACL_PRO ) ?></button>
                        </div>
                    </div>
                </div>
            </div><!-- Panel -->
        </div><!-- restriction based on number of loggedin users -->
        <div id="rbyip" class="tab-pane fade">
            <div class="panel panel-primary panel-default content-panel">
                <div class="panel-body">
                    <table class="form-table">
                        <tr class="radio-span" style="border-bottom:none;">
                            <td>
									<span>
										<input type="radio" name="enable_restrict_ip" value="yes"
                                               id="enable_restrict_ip1"
											<?php if ( $enable_restrict_ip == "yes" ) {
												echo "checked";
											} ?> />&nbsp;<?php _e( 'Enable', WEBLIZAR_ACL_PRO ) ?><br>
									</span>
                                <span>
										<input type="radio" name="enable_restrict_ip" value="no"
                                               id="enable_restrict_ip2"
											<?php if ( $enable_restrict_ip == "no" ) {
												echo "checked";
											} ?> />&nbsp;<?php _e( 'Disable', WEBLIZAR_ACL_PRO ) ?><br>
									</span>
                            </td>
                        </tr>
                    </table>
                    <table class="table iptable">
                        <tr class="">
                            <th scope="row"><?php _e( 'Restrict Users To Access WP Admin Dashboard By IP Address', WEBLIZAR_ACL_PRO ) ?></th>
                            <td></td>
                        </tr>
                        <!-- <tr class="">
								<td scope="row" ><?php _e( '', WEBLIZAR_ACL_PRO ) ?></td>
								<td></td>
							</tr> -->

                        <tr class="">
                            <td scope="row">
								<?php _e( 'IP Address', WEBLIZAR_ACL_PRO ) ?>
                                (<?php _e( 'Setting work on ip range', WEBLIZAR_ACL_PRO ) ?>)
                                <br>
                                <p>
									<?php _e( 'Allowed IP addresses to access WP Admin dashboard', WEBLIZAR_ACL_PRO ) ?>
                                </p>
                                <p>
                                    <?php _e( 'Example: 192.168.100.101, 192.168.101.101, 192.168.102.101', WEBLIZAR_ACL_PRO ) ?>
                                </p>
                            </td>

                            <td>
                                <input type="text" name="ip_address" id="ip_address" class="pro_text"
                                       placeholder="IP Address" value="<?php echo $ip_address; ?>">
                            </td>
                        </tr>
                    </table>
                </div>
                <button data-dialog510="somedialog510" class="dialog-button510" style="display:none">Open Dialog
                </button>
                <div id="somedialog510" class="dialog" style="position: fixed; z-index: 9999;">
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
                            <h2><?php _e( 'IP Restriction', WEBLIZAR_ACL_PRO ); ?><?php _e( 'Setting Saved Successfully', WEBLIZAR_ACL_PRO ); ?></h2>
                            <div>
                                <button class="action dialog-button-close" data-dialog-close
                                        id="dialog-close-button510"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button data-dialog511="somedialog511" class="dialog-button511" style="display:none">Open Dialog
                </button>
                <div id="somedialog511" class="dialog" style="position: fixed; z-index: 9999;">
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
                            <h2><?php _e( 'IP Restriction', WEBLIZAR_ACL_PRO ) ?><?php _e( 'Setting Reset Successfully', WEBLIZAR_ACL_PRO ) ?></h2>
                            <div>
                                <button class="action dialog-button-close" data-dialog-close
                                        id="dialog-close-button511"><?php _e( 'Close', WEBLIZAR_ACL_PRO ) ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button data-dialog517="somedialog517" class="dialog-button517" style="display:none">Open Dialog
                </button>
                <div id="somedialog517" class="dialog" style="position: fixed; z-index: 9999;">
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
                            <h2><?php _e( 'Please Enter Valid IP Address', WEBLIZAR_ACL_PRO ); ?>
                                &nbsp;<?php _e( 'Example: 16.24.17.29', WEBLIZAR_ACL_PRO ); ?></h2>
                            <div>
                                <button class="action dialog-button-close" data-dialog-close
                                        id="dialog-close-button517"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Save & Reset Button -->
                <div class="panel panel-primary save-button-block">
                    <div class="panel-body">
                        <div class="pull-left">
                            <button type="button" onclick="return ls('restriction_IpSave', '');"
                                    class="btn btn-info btn-lg"><?php _e( 'Save Changes', WEBLIZAR_ACL_PRO ) ?></button>
                        </div>
                        <div class="pull-right">
                            <button type="button" onclick="return ls('restriction_IpReset', '');"
                                    class="btn btn-primary btn-lg"><?php _e( 'Reset Default', WEBLIZAR_ACL_PRO ) ?></button>
                        </div>
                    </div>
                </div>
            </div><!-- Panel -->
        </div><!-- restriction based on number of loggedin users -->
        <div id="rbyuser" class="tab-pane fade">
            <div class="panel panel-primary panel-default content-panel">
                <form class="banned_user" method="post">
                    <div class="panel-body">
                        <table class="table user_list">
                            <tr class="radio-span" style="border-bottom:none;">
                                <td width="25%">
									<span>
										<input type="radio" name="enable_restrict_user" value="yes"
                                               id="enable_restrict_user1"
											<?php if ( $banned_user_allow == "yes" ) {
												echo "checked";
											} ?> />&nbsp;<?php _e( 'Enable', WEBLIZAR_ACL_PRO ) ?><br>
									</span>
                                    <span>
										<input type="radio" name="enable_restrict_user" value="no"
                                               id="enable_restrict_user2"
											<?php if ( $banned_user_allow == "no" ) {
												echo "checked";
											} ?> />&nbsp;<?php _e( 'Disable', WEBLIZAR_ACL_PRO ) ?><br>
									</span>
                                </td>
                            </tr>
                        </table>
                        <table class="table user_list_none">
                            <tr class="">
                                <th scope="row" colspan="3"><?php _e( 'All WordPress Users', WEBLIZAR_ACL_PRO ) ?></th>
                            </tr>

                            <tr class="">
                                <td scope="row"
                                    colspan="2"><?php _e( 'You can check users to ban for accessing WP admin dashboard. Only checked users will not be allowed for accessing WP dashboard', WEBLIZAR_ACL_PRO ) ?></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="c_all" id="c_all" value=""></td>
                                <td><strong>User E-mail</strong></td>
                                <td><strong>User Login</strong></td>
                                <td><strong>User Role</strong></td>
                            </tr>


							<?php
							$list_users_temp = get_users();
							foreach ( $list_users_temp as $abc => $cba ) {
								//var_dump($cba);
								if ( $cba->ID != 1 ) {
									?>
                                    <tr>
                                        <td>
											<?php
											if ( is_array( $banned_user_array ) ) {
												?>
                                                <input type="checkbox" name="banned_user[]"
                                                       id="c_<?php echo $cba->ID; ?>" class="banned_user_box"
                                                       value="<?php echo $cba->ID; ?>" <?php if ( in_array( $cba->ID, $banned_user_array ) ) {
													echo "checked";
												} ?> />
												<?php
											} else {
												?>
                                                <input type="checkbox" name="banned_user[]"
                                                       id="c_<?php echo $cba->ID; ?>" class="banned_user_box"
                                                       value="<?php echo $cba->ID; ?>"/>
												<?php
											}
											?>
                                        </td>
                                        <td><?php echo $cba->user_email; ?></td>
                                        <td><?php echo $cba->user_login; ?></td>
                                        <td><?php echo $cba->roles[0]; ?></td>
                                    </tr>
									<?php
								}
							}
							?>
                        </table>
                    </div>
                    <button data-dialog512="somedialog512" class="dialog-button512" style="display:none">Open Dialog
                    </button>
                    <div id="somedialog512" class="dialog" style="position: fixed; z-index: 9999;">
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
                                            id="dialog-close-button512"><?php _e( 'Close', WEBLIZAR_ACL_PRO ); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button data-dialog513="somedialog513" class="dialog-button513" style="display:none">Open Dialog
                    </button>
                    <div id="somedialog513" class="dialog" style="position: fixed; z-index: 9999;">
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
                                <h2><?php _e( 'Login Attempt', WEBLIZAR_ACL_PRO ) ?>
                                    &nbsp;<?php _e( 'Reset Successfully', WEBLIZAR_ACL_PRO ) ?></h2>
                                <div>
                                    <button class="action dialog-button-close" data-dialog-close
                                            id="dialog-close-button513"><?php _e( 'Close', WEBLIZAR_ACL_PRO ) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Save & Reset Button -->
                    <div class="panel panel-primary save-button-block">
                        <div class="panel-body">
                            <div class="pull-left">
                                <button type="button" onclick="return ls('restriction_UserSave', '');"
                                        class="btn btn-info btn-lg"><?php _e( 'Ban Users', WEBLIZAR_ACL_PRO ) ?></button>
                                <!-- <input type="submit" value="sub" name="bandit"> -->
                            </div>
                            <div class="pull-right">
                                <button type="button" onclick="return ls('restriction_UserReset', '');"
                                        class="btn btn-primary btn-lg"><?php _e( 'Reset Default', WEBLIZAR_ACL_PRO ) ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- Panel -->
        </div><!-- restriction based on name of users -->

    </div><!-- tab-content -->
</div><!-- row -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("input[name = 'enable_restrict_attempts']").click(function () {
            var inputValue = jQuery(this).attr("value");
            if (inputValue == "yes") {
                jQuery(".las_fields_11").show(1000);
            }
            else {
                jQuery(".las_fields_11").hide(1000);
            }
        });

        //c_all
        jQuery('#c_all').click(function () {
            jQuery('input:checkbox').prop('checked', this.checked);
        });

        jQuery("input[name = 'enable_restrict_maxuser']").click(function () {
            var inputValue = jQuery(this).attr("value");
            if (inputValue == "yes") {
                jQuery(".las_fields_2").show(1000);
            }
            else {
                jQuery(".las_fields_2").hide(1000);
            }
        });
        jQuery("input[name = 'enable_restrict_user']").click(function () {
            var enable_res_user = jQuery(this).attr("value");
            if (enable_res_user == "yes") {
                jQuery(".user_list_none").show(1000);
            }
            else {
                jQuery(".user_list_none").hide(1000);
            }
        });

        jQuery("input[name = 'enable_restrict_ip']").click(function () {
            var enable_restrict_ip = jQuery(this).attr("value");
            if (enable_restrict_ip == "yes") {
                jQuery(".iptable").show(1000);
            }
            else {
                jQuery(".iptable").hide(1000);
            }
        });
        jQuery("input[name = 'enable_restrict_maxuser']").click(function () {
            var enable_restrict_maxuser = jQuery(this).attr("value");
            if (enable_restrict_maxuser == "yes") {
                jQuery(".las_fields_2").show(1000);
            }
            else {
                jQuery(".las_fields_2").hide(1000);
            }
        });
    });

    function ls(Action, id) {
        if (Action == "restrictionSave") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog506]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog506')),
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
            if (document.getElementById('enable_restrict_attempts1').checked) {
                var enable_restrict_attempts = document.getElementById('enable_restrict_attempts1').value;
            } else {
                var enable_restrict_attempts = document.getElementById('enable_restrict_attempts2').value;
            }
            var user_role = jQuery("#user_role").val();
            //var ip = jQuery("#ip").val();
            // var PostData = "Action="+ Action + "&enable_restrict_attempts=" + enable_restrict_attempts + "&user_role=" + user_role + "&ip=" + ip;
            var PostData = "Action=" + Action + "&enable_restrict_attempts=" + enable_restrict_attempts + "&user_role=" + user_role;
            //alert(PostData);
            jQuery.ajax({
                dataType: 'html',
                type: 'POST',
                url: location.href,
                cache: false,
                data: PostData,
                complete: function () {
                },
                success: function (data) {
                    jQuery(".dialog-button506").click();
                    setTimeout(function () {
                        jQuery("#dialog-close-button506").click();
                    }, 1000);
                }
            });
        }
        if (Action == "restrictionReset") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog507]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog507')),
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

                    jQuery("input[name = 'enable_restrict_attempts']").val("no");
                    document.getElementById("user_role").value = "";
                    /*jQuery(document).ready( function() {
						jQuery('input[name=enable_login_restris]').val(['no']);
					});*/
                    // Reset message box open
                    jQuery(".dialog-button507").click();
                    // Function to close message box
                    setTimeout(function () {
                        jQuery("#dialog-close-button507").click();
                    }, 1000);
                }
            });
        }
        /* code to save the max user restriction data */
        if (Action == "restriction_MaxuserSave") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog508]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog508')),
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
                var dlgtrigger = document.querySelector('[data-dialog516]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog516')),
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
            if (document.getElementById('enable_restrict_maxuser1').checked) {
                var enable_restrict_maxuser = document.getElementById('enable_restrict_maxuser1').value;
            } else {
                var enable_restrict_maxuser = document.getElementById('enable_restrict_maxuser2').value;
            }
            var max_users = jQuery("#max_users").val();

            if (max_users == '' && enable_restrict_maxuser == 'yes') {
                jQuery(".dialog-button516").click();
                setTimeout(function () {
                    jQuery("#dialog-close-button516").click();
                }, 2000);
                jQuery("#no_attempts").focus();
                jQuery("#max_users").focus();
                return false;
            }

            var PostData = "Action=" + Action + "&enable_restrict_maxuser=" + enable_restrict_maxuser + "&max_users=" + max_users;
            jQuery.ajax({
                dataType: 'html',
                type: 'POST',
                url: location.href,
                cache: false,
                data: PostData,
                complete: function () {
                },
                success: function (data) {
                    jQuery(".dialog-button508").click();
                    setTimeout(function () {
                        jQuery("#dialog-close-button508").click();
                    }, 1000);
                }
            });
        }
        //restriction_MaxuserReset
        if (Action == "restriction_MaxuserReset") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog509]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog509')),
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
                    document.getElementById("max_users").value = "";
                    jQuery(document).ready(function () {
                        jQuery('input[name=enable_restrict_maxuser]').val(['no']);
                    });
                    // Reset message box open
                    jQuery(".dialog-button509").click();
                    // Function to close message box
                    setTimeout(function () {
                        jQuery("#dialog-close-button509").click();
                    }, 1000);
                }
            });
        }
        /* code to save the IP restriction data */
        if (Action == "restriction_IpSave") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog510]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog510')),
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
                var dlgtrigger = document.querySelector('[data-dialog517]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog517')),
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
            if (document.getElementById('enable_restrict_ip1').checked) {
                var enable_restrict_ip = document.getElementById('enable_restrict_ip1').value;
            } else {
                var enable_restrict_ip = document.getElementById('enable_restrict_ip2').value;
            }
            var ip_address = jQuery("#ip_address").val();

            if (enable_restrict_ip == 'yes' && ip_address == '') {
                jQuery(".dialog-button517").click();
                setTimeout(function () {
                    jQuery("#dialog-close-button517").click();
                }, 2000);
                jQuery("#ip_address").focus();
                return false;
            }

            var PostData = "Action=" + Action + "&enable_restrict_ip=" + enable_restrict_ip + "&ip_address=" + ip_address;
            // alert(PostData);
            jQuery.ajax({
                dataType: 'html',
                type: 'POST',
                url: location.href,
                cache: false,
                data: PostData,
                complete: function () {
                },
                success: function (data) {
                    jQuery(".dialog-button510").click();
                    setTimeout(function () {
                        jQuery("#dialog-close-button510").click();
                    }, 1000);
                }
            });
        }
        //restriction_IpReset
        if (Action == "restriction_IpReset") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog511]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog511')),
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
                    document.getElementById("ip_address").value = "";
                    jQuery(document).ready(function () {
                        jQuery('input[name=enable_restrict_ip]').val(['no']);
                    });
                    // Reset message box open
                    jQuery(".dialog-button511").click();
                    // Function to close message box
                    setTimeout(function () {
                        jQuery("#dialog-close-button511").click();
                    }, 1000);
                }
            });
        }
        /* code to save the User restriction data */
        if (Action == "restriction_UserSave") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog512]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog512')),
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
            if (document.getElementById('enable_restrict_user1').checked) {
                var enable_restrict_user = document.getElementById('enable_restrict_user1').value;
            } else {
                var enable_restrict_user = document.getElementById('enable_restrict_user2').value;
            }
            var banned_user = jQuery('form.banned_user').serialize();
            var PostData = "Action=" + Action + "&enable_restrict_user=" + enable_restrict_user + "&banned_user=" + banned_user;
            // console.log(PostData);
            // alert(PostData);
            jQuery.ajax({
                dataType: 'html',
                type: 'POST',
                url: location.href,
                cache: false,
                data: PostData,
                complete: function () {
                },
                success: function (data) {
                    jQuery(".dialog-button512").click();
                    setTimeout(function () {
                        jQuery("#dialog-close-button512").click();
                    }, 1000);
                }
            });
        }
        if (Action == "restriction_UserReset") {
            (function () {
                var dlgtrigger = document.querySelector('[data-dialog513]'),
                    somedialog = document.getElementById(dlgtrigger.getAttribute('data-dialog513')),
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
                    jQuery("input[name = 'enable_restrict_user']").val("no");
                    // Reset message box open
                    jQuery(".dialog-button513").click();
                    // Function to close message box
                    setTimeout(function () {
                        jQuery("#dialog-close-button513").click();
                    }, 1000);
                }
            });
        }
    }
</script>
<?php
if ( isset( $_POST['Action'] ) ) {
	$Action = $_POST['Action'];
	if ( $Action == "restrictionSave" ) {
		$enable_restrict_attempts = sanitize_text_field( $_POST['enable_restrict_attempts'] );
		$user_role                = $_POST['user_role'];
		//$ip = $_POST['ip'];
		$restict_user = serialize( array(
			'enable_restrict_attempts' => $enable_restrict_attempts,
			'user_role'                => $user_role,
		) );
		update_option( 'Admin_custome_login_restrict', $restict_user );
	}
	if ( $Action == "restriction_MaxuserSave" ) {
		$enable_restrict_maxuser = sanitize_text_field( $_POST['enable_restrict_maxuser'] );
		$max_users               = $_POST['max_users'];
		$restict_maxuser         = serialize( array(
			'enable_restrict_maxuser' => $enable_restrict_maxuser,
			'max_users'               => $max_users,
		) );
		update_option( 'Admin_custome_login_restrict_maxuser', $restict_maxuser );
	}
	if ( $Action == "restriction_IpSave" ) {
		$enable_restrict_ip = sanitize_text_field( $_POST['enable_restrict_ip'] );
		$ip_address         = $_POST['ip_address'];
		$allow_ip           = serialize( array(
			'enable_restrict_ip' => $enable_restrict_ip,
			'ip_address'         => $ip_address,
		) );
		update_option( 'Admin_custome_login_allow_ip', $allow_ip );
	}
	if ( $Action == "restriction_MaxuserReset" ) {
		$restict_maxuser = serialize( array(
			'enable_restrict_maxuser' => "",
			'max_users'               => "",
		) );
		update_option( 'Admin_custome_login_restrict_maxuser', $restict_maxuser );
	}
	if ( $Action == "restrictionReset" ) {
		$restict_user = serialize( array(
			'enable_restrict_attempts' => '',
			'user_role'                => 'no',
		) );
		update_option( 'Admin_custome_login_restrict', $restict_user );
	}
	if ( $Action == "restriction_UserSave" ) {
		$enable_restrict_user = sanitize_text_field( $_POST['enable_restrict_user'] );
		$banned_user          = $_POST['banned_user'];
		$banned_user_data     = serialize( array(
			'enable_restrict_user' => $enable_restrict_user,
			'banned_user'          => $banned_user,
		) );
		update_option( 'Admin_custome_banned_user', $banned_user_data );
	}
	//restriction_UserReset
	if ( $Action == "restriction_UserReset" ) {
		$banned_user_data = serialize( array(
			'enable_restrict_user' => 'no',
			'banned_user'          => '',
		) );
		update_option( 'Admin_custome_banned_user', $banned_user_data );
	}
}
?>
<style type="text/css">
    input[type=checkbox] {
        visibility: visible;
    }

    .las_fields_11 {
    <?php
	if(isset($enable_restrict_attempts) && $enable_restrict_attempts == "no"){
		echo "display: none;";
	}
?>
    }

    .user_list_none {
    <?php
		if(isset($banned_user_allow) && $banned_user_allow=="no"){
		?> display: none;
    <?php
	}
?>
    }

    .user_role {
    <?php
	if(isset($enable_restrict_attempts) && $enable_restrict_attempts == "no"){
		echo "display: none;";
	}
?>
    }

    .las_fields_2 {
    <?php
	if(isset($enable_restrict_maxuser) && $enable_restrict_maxuser == "no"){
		echo "display: none;";
	}
?>
    }

    .iptable {
    <?php
	if(isset($enable_restrict_ip) && $enable_restrict_ip == "no"){
		echo "display: none;";
	}
?>
    }
</style>