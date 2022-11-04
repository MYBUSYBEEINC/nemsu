<?php
$postid       = $post->ID;
$abt_Settings = "abt_Settings_" . $postid;
$ABT_Settings = unserialize( get_post_meta( $post->ID, $abt_Settings, true ) );
if ( isset( $ABT_Settings[0] ) ) {
	$Tem_pl_at_e             = $ABT_Settings[0]['Tem_pl_at_e'];
	$profile_user_image      = $ABT_Settings[0]['profile_user_image'];
	$user_header_image       = $ABT_Settings[0]['user_header_image'];
	$temp9_user_header_image = $ABT_Settings[0]['temp9_user_header_image'];
}
if ( ! isset( $Tem_pl_at_e ) ) {
	$Tem_pl_at_e = "11";
}
?>
<script>
    function dis_play_ed(vol) {
        if (vol == "11") {
            jQuery("#t_m_p_l_1").show();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").show();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").hide();
            jQuery("tr.background_imgs").hide();


        }
        else if (vol == "12") {
            jQuery("#t_m_p_l_2").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").show();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").show();
            jQuery("tr.background_imgs").hide();
        }
        else if (vol == "13") {
            jQuery("#t_m_p_l_3").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").show();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").show();
            jQuery("tr.background_imgs").hide();
        }
        else if (vol == "14") {
            jQuery("#t_m_p_l_4").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").show();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").show();
            jQuery("tr.background_imgs").hide();
        }
        else if (vol == "15") {
            jQuery("#t_m_p_l_5").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").show();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").show();
            jQuery("tr.background_imgs").hide();
        }
        else if (vol == "16") {
            jQuery("#t_m_p_l_6").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").show();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").show();
            jQuery("tr.background_imgs").hide();
        }
        else if (vol == "17") {
            jQuery("#t_m_p_l_7").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").show();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").show();
            jQuery("tr.background_imgs").hide();

        }
        else if (vol == "18") {
            jQuery("#t_m_p_l_8").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").show();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").hide();
            jQuery("tr.background_imgs").show();
        }

        else if (vol == "19") {
            jQuery("#t_m_p_l_9").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_10").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").hide();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").hide();
            jQuery("tr.background_imgs").show();
        }
        else if (vol == "20") {
            jQuery("#t_m_p_l_10").show();
            jQuery("#t_m_p_l_1").hide();
            jQuery("#t_m_p_l_2").hide();
            jQuery("#t_m_p_l_3").hide();
            jQuery("#t_m_p_l_4").hide();
            jQuery("#t_m_p_l_6").hide();
            jQuery("#t_m_p_l_5").hide();
            jQuery("#t_m_p_l_7").hide();
            jQuery("#t_m_p_l_8").hide();
            jQuery("#t_m_p_l_9").hide();
            jQuery("#show_di_v").hide();
            jQuery("tr.co_lo_hi_d").hide();
            jQuery("tr.profile_imgs").show();
            jQuery("tr.header_imgs").hide();
            jQuery("tr.background_imgs").show();
        }

    }
</script>

<style>
    .lbl_temp {
        font-size: 15px;
        font-family: Courier New;
        margin-right: 0px;
        font-weight: bold;

    }

    label > input {
        display: none;
    }

    label > input + span {
        cursor: pointer;
        border: 5px solid transparent;
    }

    label > input:checked + span {
        display: inline;
        background: #2580a2 url("<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL.'settings/images/hover.png'; ?>") right center no-repeat;
        padding-right: 30px;
        border: 3px solid #000;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 30px;
    }

    li {
        padding-bottom: 10px;

        color: #fff;
        margin: 0;
        padding: 12px 0px;
    }

    #temp_menu {
        font-style: italic;
    }

    #cssmenu {
        background: #333;
        list-style: none;
        margin: 0;
        padding: 0;
        float: left;
        height: auto;
        width: auto;
        margin-right: 150px;
    }

    .text_in_put {
        width: 80%;
    }
</style>

<div id='cssmenu' align="center">
    <ul id="temp_menu">
        <li>
            <label class="lbl_temp arrow-left ">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="11"
                       onclick=" dis_play_ed(this.value);" <?php checked( '11', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 1', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>


        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="12"
                       onclick="dis_play_ed(this.value);" <?php checked( '12', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 2', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>

        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="13"
                       onclick="dis_play_ed(this.value);" <?php checked( '13', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 3', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>

        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="14"
                       onclick="dis_play_ed(this.value);" <?php checked( '14', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 4', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>

        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="15"
                       onclick="dis_play_ed(this.value);" <?php checked( '15', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 5', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>

        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="16"
                       onclick="dis_play_ed(this.value);" <?php checked( '16', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 6', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>

        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="17"
                       onclick="dis_play_ed(this.value);" <?php checked( '17', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 7', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>

        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="18"
                       onclick="dis_play_ed(this.value);" <?php checked( '18', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 8', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>

        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="19"
                       onclick="dis_play_ed(this.value);" <?php checked( '19', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 9', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>

        <li>
            <label class="lbl_temp">
                <input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="20"
                       onclick="dis_play_ed(this.value);" <?php checked( '20', $Tem_pl_at_e ); ?>
                       style="display:none;"/>
                <span><?php _e( 'Template 10', WL_ABTM_TXT_DM ); ?></span>
            </label>
        </li>
    </ul>
</div>

<div>
    <div id="t_m_p_l_1">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 1', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>
                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp11.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>

    <div id="t_m_p_l_2">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 2', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp22.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>

    <div id="t_m_p_l_3">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 3', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp3.png'; ?>"/>

                </td>
            </tr>

        </table>

    </div>

    <div id="t_m_p_l_4">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 4', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp4.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>

    <div id="t_m_p_l_5">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 5', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp5.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>

    <div id="t_m_p_l_6">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 6', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp6.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>

    <div id="t_m_p_l_7">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 7', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp7.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>

    <div id="t_m_p_l_8">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 8', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp8.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>

    <div id="t_m_p_l_9">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"><?php _e( 'Template Style 9', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp9.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>

    <div id="t_m_p_l_10">
        <table>
            <tr>
                <th>
                    <span style=" font-size: 30px;font-family: Courier New;"> <?php _e( 'Template Style 10', WL_ABTM_TXT_DM ); ?></span>
                </th>
            </tr>
            <tr>
                <th>&nbsp</th>
            </tr>
            <tr>
                <td>

                    <img src="<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/temp10.png'; ?>"/>

                </td>
            </tr>

        </table>
    </div>
    <table class="form-table">
        <tr class="profile_imgs">
            <th id="lbl_id">
                <label><?php _e( 'Upload profile Image', WL_ABTM_TXT_DM ); ?></label>
            </th>
            <td id="In_put_id">
                <input type="text" class="text_in_put" id="profile_user_image" name="profile_user_image"
                       placeholder="<?php _e( 'No media selected!', WL_ABTM_TXT_DM ) ?>" readonly name="upload_image"
                       value="<?php if ( ! isset( $profile_user_image ) ) {
					       echo esc_url( $profile_user_image = WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/1.jpg' );
				       } else {
					       echo esc_url( $profile_user_image );
				       } ?>"/>
                <input type="button" value="<?php _e( 'Upload', WL_ABTM_TXT_DM ) ?>"
                       class="button-primary upload_image_button"/>
                <img src="<?php echo esc_url( $profile_user_image ); ?>" width="150" height="150"
                     style="margin:auto; margin-top:10px; display: inline-block; border: 4px double #000000; vertical-align: middle; border-radius: 22px"/>
                <p class="description">
                    <b> <?php _e( '*Upload profile image size should be 200*200 pixel maximum and 150*150 minimum', WL_ABTM_TXT_DM ); ?>
                        <b></p>
            </td>
        <tr>
            <td>

            </td>
        </tr>
        </tr>
        <tr class="header_imgs">
            <th id="up_load_header_img"><label><?php _e( 'Upload Header Background Image', WL_ABTM_TXT_DM ); ?></label>
            </th>
            <td>
                <input type="text" class="text_in_put" id="user_header_image" name="user_header_image"
                       placeholder="<?php _e( 'No media selected!', WL_ABTM_TXT_DM ) ?>" name="upload_image" readonly
                       value="<?php if ( ! isset( $user_header_image ) ) {
					       echo esc_url( $user_header_image = WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/header_r.jpg' );
				       } else {
					       echo esc_url( $user_header_image );
				       } ?>"/>
                <input type="button" value="<?php _e( 'Upload', WL_ABTM_TXT_DM ) ?>"
                       class="button-primary  upload_image_button"/>
                <img src="<?php echo esc_url( $user_header_image ); ?>" width="150" height="150"
                     style="margin:auto; margin-top:10px; display: inline-block; border: 4px double #000000; vertical-align: middle; border-radius: 22px"/>
                <p class="description">
                    <b> <?php _e( '*Upload header background image size should be 800*150 pixel maximum and 600*150 minimum', WL_ABTM_TXT_DM ); ?>
                        <b></p>
            </td>
        </tr>

        <tr class="background_imgs">
            <th><label><?php _e( 'Upload Background Image', WL_ABTM_TXT_DM ); ?></label></th>
            <td>
                <input type="text" class="text_in_put" id="temp9_user_header_image" name="temp9_user_header_image"
                       placeholder="<?php _e( 'No media selected!', WL_ABTM_TXT_DM ) ?>" name="upload_image" readonly
                       value="<?php if ( ! isset( $temp9_user_header_image ) ) {
					       echo esc_url( $temp9_user_header_image = WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'settings/images/back9.jpg' );
				       } else {
					       echo esc_url( $temp9_user_header_image );
				       } ?>"/>
                <input type="button" value="<?php _e( 'Upload', WL_ABTM_TXT_DM ) ?>"
                       class="button-primary  upload_image_button"/>
                <img src="<?php echo esc_url( $temp9_user_header_image ); ?>" width="150" height="150"
                     style="margin:auto; margin-top:10px; display: inline-block; border: 4px double #000000; vertical-align: middle; border-radius: 22px"/>
                <p class="description">
                    <b><?php _e( '*Upload background image size should be 1000*700 minimum', WL_ABTM_TXT_DM ); ?><b></p>
            </td>
        </tr>

        <tr>
            <td>

            </td>
        </tr>

    </table>
</div>


<script>
    jQuery("#t_m_p_l_1").hide();
    jQuery("#t_m_p_l_2").hide();
    jQuery("#t_m_p_l_3").hide();
    jQuery("#t_m_p_l_4").hide();
    jQuery("#t_m_p_l_5").hide();
    jQuery("#t_m_p_l_6").hide();
    jQuery("#t_m_p_l_7").hide();
    jQuery("#t_m_p_l_8").hide();
    jQuery("#t_m_p_l_9").hide();
    jQuery("#t_m_p_l_10").hide();

    jQuery("tr.profile_imgs").hide();
    jQuery("tr.header_imgs").hide();
    jQuery("tr.background_imgs").hide();

    var Layout = jQuery('input[name=Tem_pl_at_e]:checked').val();
    //alert(Layout);

    if (Layout == "11") {
        jQuery("tr.profile_imgs").show();
        jQuery("#t_m_p_l_1").show();
    }

    if (Layout == "12") {
        jQuery("tr.header_imgs").show();
        jQuery("tr.profile_imgs").show();
        jQuery("#t_m_p_l_2").show();
    }

    if (Layout == "13") {
        jQuery("tr.header_imgs").show();
        jQuery("tr.profile_imgs").show();
        jQuery("#t_m_p_l_3").show();
    }

    if (Layout == "14") {
        jQuery("tr.header_imgs").show();
        jQuery("tr.profile_imgs").show();
        jQuery("#t_m_p_l_4").show();
    }

    if (Layout == "15") {
        jQuery("tr.header_imgs").show();
        jQuery("tr.profile_imgs").show();
        jQuery("#t_m_p_l_5").show();
    }

    if (Layout == "16") {
        jQuery("tr.header_imgs").show();
        jQuery("tr.profile_imgs").show();
        jQuery("#t_m_p_l_6").show();
    }

    if (Layout == "17") {
        jQuery("tr.header_imgs").show();
        jQuery("tr.profile_imgs").show();
        jQuery("#t_m_p_l_7").show();
    }

    if (Layout == "18") {
        jQuery("tr.profile_imgs").show();
        jQuery("tr.background_imgs").show();
        jQuery("#t_m_p_l_8").show();
    }

    if (Layout == "19") {
        jQuery("tr.profile_imgs").show();
        jQuery("tr.background_imgs").show();
        jQuery("#t_m_p_l_9").show();
    }

    if (Layout == "20") {
        jQuery("tr.profile_imgs").show();
        jQuery("tr.background_imgs").show();
        jQuery("#t_m_p_l_10").show();
    }

</script>
