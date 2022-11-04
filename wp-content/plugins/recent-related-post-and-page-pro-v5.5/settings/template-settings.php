<?php
if (isset($_REQUEST['post'])) {
	$postid = $_REQUEST['post'];
} else {
	$postid = $post->ID;
}
if (!isset($Tem_pl_at_e)) {
	$Tem_pl_at_e = "11";
}

$NWT_Setting = "R_P_A_R_P_Settings_" . $postid;
$NWT_Settings = unserialize(get_post_meta($postid, $NWT_Setting, true));
if ($NWT_Settings != null) {
	if ($NWT_Settings[0] && count($NWT_Settings[0]) == 1) {
		$Tem_pl_at_e = $NWT_Settings[0]['Tem_pl_at_e'];

		//Template 1
		$featured_image_1 = $NWT_Settings[0]['featured_image_1'];
		$user_image_1     = $NWT_Settings[0]['user_image_1'];
		$img_bdr_type_1   = $NWT_Settings[0]['img_bdr_type_1'];
		$bdr_size_1       = $NWT_Settings[0]['bdr_size_1'];
		$img_bdr_color_1  = $NWT_Settings[0]['img_bdr_color_1'];
		$layout_1         = $NWT_Settings[0]['layout_1'];

		//Template 2
		$featured_image_2 = $NWT_Settings[0]['featured_image_2'];
		$user_image_2     = $NWT_Settings[0]['user_image_2'];
		$img_bdr_type_2   = $NWT_Settings[0]['img_bdr_type_2'];
		$bdr_size_2       = $NWT_Settings[0]['bdr_size_2'];
		$img_bdr_color_2  = $NWT_Settings[0]['img_bdr_color_2'];
		$layout_2         = $NWT_Settings[0]['layout_2'];


		//Template 3
		$featured_image_3    = $NWT_Settings[0]['featured_image_3'];
		$back_user_image_3   = $NWT_Settings[0]['back_user_image_3'];
		$back_image_height_3 = $NWT_Settings[0]['back_image_height_3'];


		//Template 4
		$featured_image_4 = $NWT_Settings[0]['featured_image_4'];
		$user_image_4     = $NWT_Settings[0]['user_image_4'];
		$img_bdr_type_4   = $NWT_Settings[0]['img_bdr_type_4'];
		$bdr_size_4       = $NWT_Settings[0]['bdr_size_4'];
		$img_bdr_color_4  = $NWT_Settings[0]['img_bdr_color_4'];
		$layout_4         = $NWT_Settings[0]['layout_4'];


		//Template 5
		$featured_image_5 = $NWT_Settings[0]['featured_image_5'];
		$header_image_5   = $NWT_Settings[0]['header_image_5'];


		//Template 6
		$back_user_image_6 = $NWT_Settings[0]['back_user_image_6'];
		$featured_image_6  = $NWT_Settings[0]['featured_image_6'];

		//Template 7
		$featured_image_7    = $NWT_Settings[0]['featured_image_7'];
		$back_user_image_7   = $NWT_Settings[0]['back_user_image_7'];
		$img_bdr_type_7      = $NWT_Settings[0]['img_bdr_type_7'];
		$bdr_size_7          = $NWT_Settings[0]['bdr_size_7'];
		$img_bdr_color_7     = $NWT_Settings[0]['img_bdr_color_7'];
		$back_image_height_7 = $NWT_Settings[0]['back_image_height_7'];



		//Template 8
		$featured_image_8  = $NWT_Settings[0]['featured_image_8'];
		$back_user_image_8 = $NWT_Settings[0]['back_user_image_8'];
	}
}
?>



<style>
	.lbl_temp {
		font-size: 15px;
		font-family: Courier New;
		margin-right: 0px;
		font-weight: bold;

	}

	label>input {
		display: none;
	}

	label>input+span {
		cursor: pointer;
		border: 5px solid transparent;
	}

	label>input:checked+span {
		display: inline;
		background: #2580a2 url("<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/hover.png'; ?>") right center no-repeat;
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

	.rang_span_style {
		width: auto;
		height: 30px;
		margin: auto;
		display: inline-block;
		border: 2px solid gray;
		vertical-align: middle;
		border-radius: 8px;
		background-color: #FFFFFF;
		text-align: center;
		font-size: 20px;
		margin-left: 20px;
		margin-bottom: 20px;
		padding: 5px 10px;
	}

	.text_in_put {
		width: 80%;
	}

	#upload_image {
		display: none;
	}
</style>
<script>
	function back_image_size(vol) {
		jQuery("span.back_image_span").text(vol);
	}
</script>
<?php require_once("tooltip.php"); ?>
<div id='cssmenu' align="center">
	<ul id="temp_menu">
		<li>
			<label class="lbl_temp arrow-left ">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="11" onclick=" dis_play_ed(this.value);" <?php checked('11', $Tem_pl_at_e); ?> checked style="display:none;" />
				<span><?php _e('Template 1 ', 'WL_R_P_R_P'); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="12" onclick="dis_play_ed(this.value);" <?php checked('12', $Tem_pl_at_e); ?> style="display:none;" />
				<span> <?php _e('Template 2', 'WL_R_P_R_P'); ?></span>
			</label>
		</li>

		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="13" onclick="dis_play_ed(this.value);" <?php checked('13', $Tem_pl_at_e); ?> style="display:none;" />
				<span> <?php _e('Template 3', 'WL_R_P_R_P'); ?></span>
			</label>
		</li>


		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="14" onclick="dis_play_ed(this.value);" <?php checked('14', $Tem_pl_at_e); ?> style="display:none;" />
				<span> <?php _e('Template 4', 'WL_R_P_R_P'); ?></span>
			</label>
		</li>
		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="15" onclick="dis_play_ed(this.value);" <?php checked('15', $Tem_pl_at_e); ?> style="display:none;" />
				<span> <?php _e('Template 5', 'WL_R_P_R_P'); ?></span>
			</label>
		</li>
		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="16" onclick="dis_play_ed(this.value);" <?php checked('16', $Tem_pl_at_e); ?> style="display:none;" />
				<span> <?php _e('Template 6', 'WL_R_P_R_P'); ?></span>
			</label>
		</li>
		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="17" onclick="dis_play_ed(this.value);" <?php checked('17', $Tem_pl_at_e); ?> style="display:none;" />
				<span> <?php _e('Template 7', 'WL_R_P_R_P'); ?></span>
			</label>
		</li>
		<li>
			<label class="lbl_temp">
				<input id="Tem_pl_at_e" name="Tem_pl_at_e" type="radio" value="18" onclick="dis_play_ed(this.value);" <?php checked('18', $Tem_pl_at_e); ?> style="display:none;" />
				<span> <?php _e('Template 8', 'WL_R_P_R_P'); ?></span>
			</label>
		</li>
	</ul>
</div>

<?php //Template Style 1 
?>
<div id="t_m_p_l_1">
	<table>
		<tr>
			<th><span style=" font-size: 30px;font-family: Courier New;"> <?php _e('Template Style 1', 'WL_R_P_R_P'); ?></span></th>
		</tr>
		<tr>
			<th>&nbsp </th>
		</tr>
		<tr>
			<td>
				<img src="<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/template-1.jpg'; ?>" width="90%" height="auto" />

			</td>
		</tr>
	</table>
</div>

<?php //Template Style 2 
?>
<div id="t_m_p_l_2">
	<table>
		<tr>
			<th><span style=" font-size: 30px;font-family: Courier New;"><?php _e('Template Style 2 ', 'WL_R_P_R_P'); ?></span></th>
		</tr>
		<tr>
			<th>&nbsp </th>
		</tr>
		<tr>
			<td>

				<img src="<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/template-2.jpg'; ?>" width="90%" height="auto" />
			</td>
		</tr>

	</table>
</div>


<?php //Template Style 3 
?>
<div id="t_m_p_l_3">
	<table>
		<tr>
			<th><span style=" font-size: 30px;font-family: Courier New;"><?php _e('Template Style 3 ', 'WL_R_P_R_P'); ?></span></th>
		</tr>
		<tr>
			<th>&nbsp </th>
		</tr>
		<tr>
			<td>

				<img src="<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/template-3.jpg'; ?>" width="90%" height="70%" />
			</td>
		</tr>

	</table>
</div>


<?php //Template Style 4 
?>
<div id="t_m_p_l_4">
	<table>
		<tr>
			<th><span style=" font-size: 30px;font-family: Courier New;"> <?php _e('Template Style 4', 'WL_R_P_R_P'); ?></span></th>
		</tr>
		<tr>
			<th>&nbsp </th>
		</tr>
		<tr>
			<td>

				<img src="<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/template_4.jpg'; ?>" width="90%" height="auto" />

			</td>
		</tr>

	</table>
</div>


<?php //Template Style 5 
?>
<div id="t_m_p_l_5">
	<table>
		<tr>
			<th><span style=" font-size: 30px;font-family: Courier New;"> <?php _e('Template Style 5', 'WL_R_P_R_P'); ?></span></th>
		</tr>
		<tr>
			<th>&nbsp </th>
		</tr>
		<tr>
			<td>

				<img src="<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/template_5.jpg'; ?>" width="auto" height="auto" />

			</td>
		</tr>

	</table>
</div>


<?php //Template Style 6 
?>
<div id="t_m_p_l_6">
	<table>
		<tr>
			<th><span style=" font-size: 30px;font-family: Courier New;"> <?php _e('Template Style 6', 'WL_R_P_R_P'); ?></span></th>
		</tr>
		<tr>
			<th>&nbsp </th>
		</tr>
		<tr>
			<td>

				<img src="<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/template-6.jpg'; ?>" width="80%" height="auto" />

			</td>
		</tr>

	</table>
</div>

<?php //Template Style 7 
?>
<div id="t_m_p_l_7">
	<table>
		<tr>
			<th><span style=" font-size: 30px;font-family: Courier New;"> <?php _e('Template Style 7', 'WL_R_P_R_P'); ?></span></th>
		</tr>
		<tr>
			<th>&nbsp </th>
		</tr>
		<tr>
			<td>

				<img src="<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/template-7.jpg'; ?>" width="90%" height="70%" />

			</td>
		</tr>

	</table>
</div>

<?php //Template Style 8 
?>
<div id="t_m_p_l_8">
	<table>
		<tr>
			<th><span style=" font-size: 30px;font-family: Courier New;"> <?php _e('Template Style 8', 'WL_R_P_R_P'); ?></span></th>
		</tr>
		<tr>
			<th>&nbsp </th>
		</tr>
		<tr>
			<td>

				<img src="<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/template-8.jpg'; ?>" width="90%" height="auto" />

			</td>
		</tr>

	</table>
</div>

<table class="form-table">
	<!----------------------------- layout 1 settings ------------------------------>


	<tr class="template_1_settings">
		<th><label><?php _e(' Display Featured Images', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($featured_image_1)) {
			$featured_image_1 = "default";
		} else {
			$featured_image_1;
		} ?>
		<td>
			<input type="radio" name="featured_image_1" id="featured_image_1" value="default" <?php checked('default', $featured_image_1); ?> onclick="displayed_img_temp_1(this.value);"><?php _e('Default', 'WL_R_P_R_P'); ?>
			<a href="#" class="e1" data-tooltip="#f1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_1" id="featured_image_1" value="upload" <?php checked('upload', $featured_image_1); ?> onclick="displayed_img_temp_1(this.value);"><?php _e('Plugin Upload', 'WL_R_P_R_P'); ?>
			<a href="#" class="e2" data-tooltip="#f2"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_1" id="featured_image_1" value="none" <?php checked('none', $featured_image_1); ?> onclick="displayed_img_temp_1(this.value);"><?php _e('None', 'WL_R_P_R_P'); ?>
			<a href="#" class="e3" data-tooltip="#f3"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr class="template_1_settings">

		<th class="upload_image_temp_1"><label><?php _e('Upload', 'WL_R_P_R_P'); ?></label></th>
		<td class="upload_image_temp_1">
			<input type="text" class="widefat" id="user_image_1" name="user_image_1" placeholder="<?php _e('No media selected!', 'WL_R_P_R_P') ?>" readonly name="user_image_1" value="<?php if (!isset($user_image_1)) {
																																															echo	esc_url($user_image_1 = WL_RP_RP_PLUGIN_URL . 'settings/images/WL-Wall-paper-2.jpg');
																																														} else {
																																															echo esc_url($user_image_1);
																																														} ?>" style="width:100%;" />
			<input type="button" value="<?php _e('Upload', 'WL_R_P_R_P') ?>" class="button-primary upload_image_button" />
			<p class="description"><b><?php _e('Note: Please upload image of 300*350 pixel maximum.', 'WL_R_P_R_P') ?></b></p>
		</td>
	</tr>

	<tr class=" template_1_settings">

		<th class="n_o_n_e_temp_1"><label><?php _e('Featured Images Border Style', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_1"> <?php if (!isset($img_bdr_type_1)) {
										$img_bdr_type_1 = "solid";
									} ?>
			<select name="img_bdr_type_1" id="img_bdr_type_1">
				<?php $options_bdr_type = array('none', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset');
				foreach ($options_bdr_type as $option_bdr_type_img) {
					echo '<option
									value="' . esc_attr($option_bdr_type_img) . '"
									id="' . esc_attr($option_bdr_type_img) . '"',
						$img_bdr_type_1 == $option_bdr_type_img ? ' selected="selected"' : '',
						'>',
						$option_bdr_type_img,
						'</option>';
				}
				?>
			</select>
			<a href="#" class="e4" data-tooltip="#f4"><span class="dashicons dashicons-info info_info"></span></a>

		</td>
	</tr>

	<tr class="template_1_settings">
		<th class="n_o_n_e_temp_1"><label><?php _e('Featured Images Border Size', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_1">
			<input type="range" min="0" max="10" step="1" value="<?php if (!isset($bdr_size_1)) {
																		echo	esc_attr($bdr_size_1 = "5");
																	} else {
																		echo esc_attr($bdr_size_1);
																	} ?>" data-orientation="vertical" id="bdr_size_1 " name="bdr_size_1" oninput="output_img_bdr(value);" />
			<span class="img_border_span rang_span_style" id="img_bdr_span_value" name="img_bdr_span_value"><?php echo esc_attr($bdr_size_1); ?></span>
			<a href="#" class="e5" data-tooltip="#f5"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="n_o_n_e_temp_1 template_1_settings">
		<th class="n_o_n_e_temp_1"><label><?php _e('Featured Images Border Color', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_1">
			<input class="my-color-picker" id="img_bdr_color_1" name="img_bdr_color_1" type="text" value="<?php if (!isset($img_bdr_color_1)) {
																												echo	esc_attr($img_bdr_color_1 = "#ffffff");
																											} else {
																												echo esc_attr($img_bdr_color_1);
																											} ?>">
			<a href="#" class="e6" data-tooltip="#f6"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_1_settings">
		<th class="n_o_n_e_temp_1"><label><?php _e('Featured Images Layout Style', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($layout_1)) {
			$layout_1 = "50";
		} ?>
		<td class="n_o_n_e_temp_1">
			<input type="radio" name="layout_1" id="layout_1" value="50" <?php checked('50', $layout_1); ?>><?php _e('In Circle', 'WL_R_P_R_P'); ?>
			<a href="#" class="e7" data-tooltip="#f7"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="layout_1" id="layout_1" value="0" <?php checked('0', $layout_1); ?>><?php _e('In Square', 'WL_R_P_R_P'); ?>
			<a href="#" class="e8" data-tooltip="#f8"><span class="dashicons dashicons-info info_info"></span></a>

		</td>
	</tr>

	<!----------------------------- layout 1 settings end -------------------------->


	<!----------------------------- layout 2 settings ------------------------------>


	<tr class="template_2_settings">
		<th><label><?php _e(' Display Featured Images', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<?php if (!isset($featured_image_2)) {
				$featured_image_2 = "default";
			} else {
				$featured_image_2;
			} ?>
			<input type="radio" name="featured_image_2" id="featured_image_2" value="default" <?php checked('default', $featured_image_2); ?> onclick="displayed_img_temp_2(this.value);"><?php _e('Default', 'WL_R_P_R_P'); ?>
			<a href="#" class="e1" data-tooltip="#f1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_2" id="featured_image_2" value="upload" <?php checked('upload', $featured_image_2); ?> onclick="displayed_img_temp_2(this.value);"><?php _e('Plugin Upload', 'WL_R_P_R_P'); ?>
			<a href="#" class="e2" data-tooltip="#f2"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_2" id="featured_image_2" value="none" <?php checked('none', $featured_image_2); ?> onclick="displayed_img_temp_2(this.value);"><?php _e('None', 'WL_R_P_R_P'); ?>
			<a href="#" class="e3" data-tooltip="#f3"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr class="template_2_settings  ">
		<th class="upload_image_temp_2"><label><?php _e('Upload', 'WL_R_P_R_P'); ?></label></th>
		<td class="upload_image_temp_2">
			<input type="text" class="widefat" id="user_image_2" name="user_image_2" placeholder="<?php _e('No media selected!', 'WL_R_P_R_P') ?>" readonly name="user_image_2" value="<?php if (!isset($user_image_2)) {
																																															echo	esc_url($user_image_2 = WL_RP_RP_PLUGIN_URL . 'settings/images/WL-Wall-paper-2.jpg');
																																														} else {
																																															echo esc_url($user_image_2);
																																														} ?>" style="width:100%;" />
			<input type="button" value="<?php _e('Upload', 'WL_R_P_R_P') ?>" class="button-primary upload_image_button" />
			<p class="description"><b><?php _e('Note: Please upload image of 300*350 pixel maximum.', 'WL_R_P_R_P') ?></b></p>
		</td>
	</tr>

	<tr class="template_2_settings">
		<th class="n_o_n_e_temp_2"><label><?php _e('Featured Images Border Style', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_2"> <?php if (!isset($img_bdr_type_2)) {
										$img_bdr_type_2 = "solid";
									} ?>
			<select name="img_bdr_type_2" id="img_bdr_type_2">
				<?php $options_bdr_type = array('none', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset');
				foreach ($options_bdr_type as $option_bdr_type_img) {
					echo '<option
							value="' . esc_attr($option_bdr_type_img) . '"
							id="' . esc_attr($option_bdr_type_img) . '"',
						$img_bdr_type_2 == $option_bdr_type_img ? ' selected="selected"' : '',
						'>',
						$option_bdr_type_img,
						'</option>';
				}
				?>
			</select>
			<a href="#" class="e4" data-tooltip="#f4"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_2_settings">
		<th class="n_o_n_e_temp_2"><label><?php _e('Featured Images Border Size', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_2">
			<input type="range" min="0" max="10" step="1" value="<?php if (!isset($bdr_size_2)) {
																		echo	esc_attr($bdr_size_2 = "5");
																	} else {
																		echo esc_attr($bdr_size_2);
																	} ?>" data-orientation="vertical" id="bdr_size_2" name="bdr_size_2" oninput="output_img_bdr(value);" />
			<span class="img_border_span rang_span_style" id="img_bdr_span_value" name="img_bdr_span_value"><?php echo esc_attr($bdr_size_2); ?></span>
			<a href="#" class="e5" data-tooltip="#f5"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_2_settings">
		<th class="n_o_n_e_temp_2"><label><?php _e('Featured Images Border Color', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_2">
			<input class="my-color-picker" id="img_bdr_color_2" name="img_bdr_color_2" type="text" value="<?php if (!isset($img_bdr_color_2)) {
																												echo	esc_attr($img_bdr_color_2 = "#ffffff");
																											} else {
																												echo esc_attr($img_bdr_color_2);
																											} ?>">
			<a href="#" class="e6" data-tooltip="#f6"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_2_settings">
		<th class="n_o_n_e_temp_2"><label><?php _e('Featured Images Layout Style', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($layout_2)) {
			$layout_2 = "50";
		} ?>
		<td class="n_o_n_e_temp_2">
			<input type="radio" name="layout_2" id="layout_2" value="50" <?php checked('50', $layout_2); ?>><?php _e('In Circle', 'WL_R_P_R_P'); ?>
			<a href="#" class="e7" data-tooltip="#f7"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="layout_2" id="layout_2" value="0" <?php checked('0', $layout_2); ?>><?php _e('In Square', 'WL_R_P_R_P'); ?>
			<a href="#" class="e8" data-tooltip="#f8"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<!----------------------------- layout 2 settings end -------------------------->


	<!----------------------------- layout 3 settings ------------------------------>

	<tr class="template_3_settings">
		<?php if (!isset($featured_image_3)) {
			$featured_image_3 = "default";
		} else {
			$featured_image_3;
		} ?>
		<th><label><?php _e(' Display Featured Images', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="radio" name="featured_image_3" id="featured_image_3" value="default" <?php checked('default', $featured_image_3); ?> onclick="displayed_img_temp_3(this.value);"><?php _e('Default', 'WL_R_P_R_P'); ?>
			<a href="#" class="e1" data-tooltip="#f1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_3" id="featured_image_3" value="upload" <?php checked('upload', $featured_image_3); ?> onclick="displayed_img_temp_3(this.value);"><?php _e('Plugin Upload', 'WL_R_P_R_P'); ?>
			<a href="#" class="e2" data-tooltip="#f2"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_3" id="featured_image_3" value="none" <?php checked('none', $featured_image_3); ?> onclick="displayed_img_temp_3(this.value);"><?php _e('None', 'WL_R_P_R_P'); ?>
			<a href="#" class="e3" data-tooltip="#f3"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr class="template_3_settings">
		<th class="upload_image_temp_3"><label><?php _e('Upload', 'WL_R_P_R_P'); ?></label></th>
		<td class="upload_image_temp_3">
			<input type="text" class="widefat" id="back_user_image_3" name="back_user_image_3" placeholder="<?php _e('No media selected!', 'WL_R_P_R_P') ?>" readonly name="back_user_image_3" value="<?php if (!isset($back_user_image_3)) {
																																																			echo	esc_url($back_user_image_3 = WL_RP_RP_PLUGIN_URL . 'settings/images/Wallpaper-back.jpg');
																																																		} else {
																																																			echo esc_url($back_user_image_3);
																																																		} ?>" style="width:100%;" />
			<input type="button" value="<?php _e('Upload', 'WL_R_P_R_P') ?>" class="button-primary upload_image_button" />
			<p class="description"><b> <?php _e('Note: Please upload image of 500*300 pixel maximum.', 'WL_R_P_R_P') ?></b></p>
		</td>
	</tr>

	<tr class="template_3_settings">
		<th class="n_o_n_e_temp_3"><label><?php _e('Background Image Height', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_3">
			<input type="range" min="200" max="400" step="1" value="<?php if (!isset($back_image_height_3)) {
																		echo $back_image_height_3 = "300";
																	} else {
																		echo $back_image_height_3;
																	} ?>" data-orientation="vertical" id="back_image_height_3" name="back_image_height_3" oninput="back_image_size(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="back_image_span rang_span_style"><?php echo $back_image_height_3 ?> </span>
			<a href="#" class="e9" data-tooltip="#f9"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<!----------------------------- layout 3 settings end -------------------------->


	<!----------------------------- layout 4 settings ------------------------------>

	<tr class="template_4_settings">
		<?php if (!isset($featured_image_4)) {
			$featured_image_4 = "default";
		} else {
			$featured_image_4;
		} ?>
		<th><label><?php _e(' Display Featured Images', 'WL_R_P_R_P'); ?></label></th>

		<td>
			<input type="radio" name="featured_image_4" id="featured_image_4" value="default" <?php checked('default', $featured_image_4); ?> onclick="displayed_img_temp_4(this.value);"><?php _e('Default', 'WL_R_P_R_P'); ?>
			<a href="#" class="e1" data-tooltip="#f1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_4" id="featured_image_4" value="upload" <?php checked('upload', $featured_image_4); ?> onclick="displayed_img_temp_4(this.value);"><?php _e('Plugin Upload', 'WL_R_P_R_P'); ?>
			<a href="#" class="e2" data-tooltip="#f2"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_4" id="featured_image_4" value="none" <?php checked('none', $featured_image_4); ?> onclick="displayed_img_temp_4(this.value);"><?php _e('None', 'WL_R_P_R_P'); ?>
			<a href="#" class="e3" data-tooltip="#f3"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr class="template_4_settings">

		<th class="upload_image_temp_4"><label><?php _e('Upload', 'WL_R_P_R_P'); ?></label></th>
		<td class="upload_image_temp_4">
			<input type="text" class="widefat" id="user_image_4" name="user_image_4" placeholder="<?php _e('No media selected!', 'WL_R_P_R_P') ?>" readonly name="user_image_4" value="<?php if (!isset($user_image_4)) {
																																															echo	esc_url($user_image_4 = WL_RP_RP_PLUGIN_URL . 'settings/images/WL-Wall-paper-2.jpg');
																																														} else {
																																															echo esc_url($user_image_4);
																																														} ?>" style="width:100%;" />
			<input type="button" value="<?php _e('Upload', 'WL_R_P_R_P') ?>" class="button-primary upload_image_button" />
			<p class="description"><b> <?php _e('Note: Please upload image of 300*350 pixel maximum.', 'WL_R_P_R_P') ?></b></p>
		</td>
	</tr>

	<tr class="template_4_settings">
		<th class="n_o_n_e_temp_4"><label><?php _e('Featured Images Border Style', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_4"> <?php if (!isset($img_bdr_type_4)) {
										$img_bdr_type_4 = "solid";
									} ?>
			<select name="img_bdr_type_4" id="img_bdr_type_4">
				<?php $options_bdr_type = array('none', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset');
				foreach ($options_bdr_type as $option_bdr_type_img) {
					echo '<option
					value="' . esc_attr($option_bdr_type_img) . '"
					id="' . esc_attr($option_bdr_type_img) . '"',
						$img_bdr_type_4 == $option_bdr_type_img ? ' selected="selected"' : '',
						'>',
						$option_bdr_type_img,
						'</option>';
				}
				?>
			</select>
			<a href="#" class="e4" data-tooltip="#f4"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_4_settings">
		<th class="n_o_n_e_temp_4"><label><?php _e('Featured Images Border Size', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_4">
			<input type="range" min="0" max="10" step="1" value="<?php if (!isset($bdr_size_4)) {
																		echo	esc_attr($bdr_size_4 = "5");
																	} else {
																		echo esc_attr($bdr_size_4);
																	} ?>" data-orientation="vertical" id="bdr_size_4" name="bdr_size_4" oninput="output_img_bdr(value);" />
			<span class="img_border_span rang_span_style" id="img_bdr_span_value" name="img_bdr_span_value"><?php echo esc_attr($bdr_size_4); ?></span>
			<a href="#" class="e5" data-tooltip="#f5"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_4_settings">
		<th class="n_o_n_e_temp_4"><label><?php _e('Featured Images Border Color', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_4">
			<input class="my-color-picker" id="img_bdr_color_4" name="img_bdr_color_4" type="text" value="<?php if (!isset($img_bdr_color_4)) {
																												echo	esc_attr($img_bdr_color_4 = "#ffffff");
																											} else {
																												echo esc_attr($img_bdr_color_4);
																											} ?>">
			<a href="#" class="e6" data-tooltip="#f6"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_4_settings">
		<th class="n_o_n_e_temp_4"><label><?php _e('Featured Images Layout Style', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($layout_4)) {
			$layout_4 = "50";
		} ?>
		<td class="n_o_n_e_temp_4">
			<input type="radio" name="layout_4" id="layout_4" value="50" <?php checked('50', $layout_4); ?>><?php _e('In Circle', 'WL_R_P_R_P'); ?>
			<a href="#" class="e7" data-tooltip="#f7"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="layout_4" id="layout_4" value="0" <?php checked('0', $layout_4); ?>><?php _e('In Square', 'WL_R_P_R_P'); ?>
			<a href="#" class="e8" data-tooltip="#f8"><span class="dashicons dashicons-info info_info"></span></a>

		</td>
	</tr>

	<!----------------------------- layout 4 settings end -------------------------->


	<!----------------------------- layout 5 settings ------------------------------>

	<tr class="template_5_settings ">

		<th><label><?php _e(' Display Featured Images', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($featured_image_5)) {
			$featured_image_5 = "default";
		} else {
			$featured_image_5;
		} ?>
		<td>
			<input type="radio" name="featured_image_5" id="featured_image_5" value="default" <?php checked('default', $featured_image_5); ?> onclick="displayed_img_temp_5(this.value);"><?php _e('Default', 'WL_R_P_R_P'); ?>
			<a href="#" class="e1" data-tooltip="#f1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_5" id="featured_image_5" value="upload" <?php checked('upload', $featured_image_5); ?> onclick="displayed_img_temp_5(this.value);"><?php _e('Plugin Upload', 'WL_R_P_R_P'); ?>
			<a href="#" class="e2" data-tooltip="#f2"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_5" id="featured_image_5" value="none" <?php checked('none', $featured_image_5); ?> onclick="displayed_img_temp_5(this.value);"><?php _e('None', 'WL_R_P_R_P'); ?>
			<a href="#" class="e3" data-tooltip="#f3"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr class="template_5_settings">
		<th class="upload_image_temp_5"><label><?php _e('Upload', 'WL_R_P_R_P'); ?></label></th>
		<td class="upload_image_temp_5">
			<input type="text" class="widefat" id="header_image_5" name="header_image_5" placeholder="<?php _e('No media selected!', 'WL_R_P_R_P') ?>" readonly name="header_image_5" value="<?php if (!isset($header_image_5)) {
																																																	echo	esc_url($header_image_5 = WL_RP_RP_PLUGIN_URL . 'settings/images/WL-blue_wormhole-wallpaper.jpg');
																																																} else {
																																																	echo esc_url($header_image_5);
																																																} ?>" style="width:100%;" />
			<input type="button" value="<?php _e('Upload', 'WL_R_P_R_P') ?>" class="button-primary upload_image_button" />
			<p class="description"><b><?php _e('Note: Please upload image of 900*200 pixel maximum.', 'WL_R_P_R_P') ?></b></p>
		</td>
	</tr>
	<!----------------------------- layout 5 settings end -------------------------->


	<!----------------------------- layout 6 settings ------------------------------>

	<tr class="template_6_settings">
		<th><label><?php _e(' Display Featured Images', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($featured_image_6)) {
			$featured_image_6 = "default";
		} else {
			$featured_image_6;
		} ?>
		<td>
			<input type="radio" name="featured_image_6" id="featured_image_6" value="default" <?php checked('default', $featured_image_6); ?> onclick="displayed_img_temp_6(this.value);"><?php _e('Default', 'WL_R_P_R_P'); ?>
			<a href="#" class="e1" data-tooltip="#f1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_6" id="featured_image_6" value="upload" <?php checked('upload', $featured_image_6); ?> onclick="displayed_img_temp_6(this.value);"><?php _e('Plugin Upload', 'WL_R_P_R_P'); ?>
			<a href="#" class="e2" data-tooltip="#f2"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_6" id="featured_image_6" value="none" <?php checked('none', $featured_image_6); ?> onclick="displayed_img_temp_6(this.value);"><?php _e('None', 'WL_R_P_R_P'); ?>
			<a href="#" class="e3" data-tooltip="#f3"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_6_settings">
		<th class="upload_image_temp_6"><label><?php _e('Upload', 'WL_R_P_R_P'); ?></label></th>
		<td class="upload_image_temp_6">
			<input type="text" class="widefat" id="back_user_image_6" name="back_user_image_6" placeholder="<?php _e('No media selected!', 'WL_R_P_R_P') ?>" readonly name="back_user_image_6" value="<?php if (!isset($back_user_image_6)) {
																																																			echo	esc_url($back_user_image_6 = WL_RP_RP_PLUGIN_URL . 'settings/images/Wallpaper-back.jpg');
																																																		} else {
																																																			echo esc_url($back_user_image_6);
																																																		} ?>" style="width:100%;" />
			<input type="button" value="<?php _e('Upload', 'WL_R_P_R_P') ?>" class="button-primary upload_image_button" />
			<p class="description"><b><?php _e('Note: Please upload image of 500*300 pixel maximum.', 'WL_R_P_R_P') ?></b></p>
		</td>
	</tr>
	<!----------------------------- layout 6 settings end -------------------------->


	<!----------------------------- layout 7 settings ------------------------------>

	<tr class="template_7_settings">
		<?php if (!isset($featured_image_7)) {
			$featured_image_7 = "default";
		} else {
			$featured_image_7;
		} ?>
		<th><label><?php _e(' Display Featured Images', 'WL_R_P_R_P'); ?></label></th>

		<td>
			<input type="radio" name="featured_image_7" id="featured_image_7" value="default" <?php checked('default', $featured_image_7); ?> onclick="displayed_img_temp_7(this.value);"><?php _e('Default', 'WL_R_P_R_P'); ?>
			<a href="#" class="e1" data-tooltip="#f1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_7" id="featured_image_7" value="upload" <?php checked('upload', $featured_image_7); ?> onclick="displayed_img_temp_7(this.value);"><?php _e('Plugin Upload', 'WL_R_P_R_P'); ?>
			<a href="#" class="e2" data-tooltip="#f2"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_7" id="featured_image_7" value="none" <?php checked('none', $featured_image_7); ?> onclick="displayed_img_temp_7(this.value);"><?php _e('None', 'WL_R_P_R_P'); ?>
			<a href="#" class="e3" data-tooltip="#f3"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr class="template_7_settings">
		<th class="upload_image_temp_7"><label><?php _e('Upload', 'WL_R_P_R_P'); ?></label></th>
		<td class="upload_image_temp_7">
			<input type="text" class="widefat" id="back_user_image_7" name="back_user_image_7" placeholder="<?php _e('No media selected!', 'WL_R_P_R_P') ?>" readonly name="back_user_image_7" value="<?php if (!isset($back_user_image_7)) {
																																																			echo	esc_url($back_user_image_7 = WL_RP_RP_PLUGIN_URL . 'settings/images/Wallpaper-back.jpg');
																																																		} else {
																																																			echo esc_url($back_user_image_7);
																																																		} ?>" style="width:100%;" />
			<input type="button" value="<?php _e('Upload', 'WL_R_P_R_P') ?>" class="button-primary upload_image_button" />
			<p class="description"><b><?php _e('Note: Please upload image of 500*300 pixel maximum.', 'WL_R_P_R_P') ?></b></p>
		</td>
	</tr>

	<tr class=" template_7_settings ">
		<th class="n_o_n_e_temp_7"><label><?php _e('Featured Images Border Style', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_7"> <?php if (!isset($img_bdr_type_7)) {
										$img_bdr_type_7 = "solid";
									} ?>
			<select name="img_bdr_type_7" id="img_bdr_type_7">
				<?php $options_bdr_type = array('none', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset');
				foreach ($options_bdr_type as $option_bdr_type_img) {
					echo '<option
			value="' . esc_attr($option_bdr_type_img) . '"
			id="' . esc_attr($option_bdr_type_img) . '"',
						$img_bdr_type_7 == $option_bdr_type_img ? ' selected="selected"' : '',
						'>',
						$option_bdr_type_img,
						'</option>';
				}
				?>
			</select>
			<a href="#" class="e4" data-tooltip="#f4"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_7_settings ">
		<th class="n_o_n_e_temp_7"><label><?php _e('Featured Images Border Size', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_7">
			<input type="range" min="0" max="10" step="1" value="<?php if (!isset($bdr_size_7)) {
																		echo	esc_attr($bdr_size_7 = "5");
																	} else {
																		echo esc_attr($bdr_size_7);
																	} ?>" data-orientation="vertical" id="bdr_size_7" name="bdr_size_7" oninput="output_img_bdr(value);" />
			<span class="img_border_span rang_span_style" id="img_bdr_span_value" name="img_bdr_span_value"><?php echo esc_attr($bdr_size_7); ?></span>
			<a href="#" class="e5" data-tooltip="#f5"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class=" template_7_settings ">
		<th class="n_o_n_e_temp_7"><label><?php _e('Featured Images Border Color', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_7">
			<input class="my-color-picker" id="img_bdr_color_7" name="img_bdr_color_7" type="text" value="<?php if (!isset($img_bdr_color_7)) {
																												echo	esc_attr($img_bdr_color_7 = "#ffffff");
																											} else {
																												echo esc_attr($img_bdr_color_7);
																											} ?>">
			<a href="#" class="e6" data-tooltip="#f6"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="template_7_settings ">
		<th class="n_o_n_e_temp_7"><label><?php _e('Background Image Height', 'WL_R_P_R_P'); ?></label></th>
		<td class="n_o_n_e_temp_7">
			<input type="range" min="200" max="400" step="1" value="<?php if (!isset($back_image_height_7)) {
																		echo $back_image_height_7 = "300";
																	} else {
																		echo $back_image_height_7;
																	} ?>" data-orientation="vertical" id="back_image_height_7" name="back_image_height_7" oninput="back_image_size(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="back_image_span rang_span_style"><?php echo $back_image_height_7 ?> </span>
			<a href="#" class="e9" data-tooltip="#f9"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<!----------------------------- layout 7 settings end -------------------------->


	<!----------------------------- layout 8 settings ------------------------------>

	<tr class="template_8_settings">
		<?php if (!isset($featured_image_8)) {
			$featured_image_8 = "default";
		} else {
			$featured_image_8;
		} ?>
		<th><label><?php _e(' Display Featured Images', 'WL_R_P_R_P'); ?></label></th>

		<td>
			<input type="radio" name="featured_image_8" id="featured_image_8" value="default" <?php checked('default', $featured_image_8); ?> onclick="displayed_img_temp_8(this.value);"><?php _e('Default', 'WL_R_P_R_P'); ?>
			<a href="#" class="e1" data-tooltip="#f1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_8" id="featured_image_8" value="upload" <?php checked('upload', $featured_image_8); ?> onclick="displayed_img_temp_8(this.value);"><?php _e('Plugin Upload', 'WL_R_P_R_P'); ?>
			<a href="#" class="e2" data-tooltip="#f2"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="featured_image_8" id="featured_image_8" value="none" <?php checked('none', $featured_image_8); ?> onclick="displayed_img_temp_8(this.value);"><?php _e('None', 'WL_R_P_R_P'); ?>
			<a href="#" class="e3" data-tooltip="#f3"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr class="template_8_settings">
		<th class="upload_image_temp_8"><label><?php _e('Upload', 'WL_R_P_R_P'); ?></label></th>
		<td class="upload_image_temp_8">
			<input type="text" class="widefat" id="back_user_image_8" name="back_user_image_8" placeholder="<?php _e('No media selected!', 'WL_R_P_R_P') ?>" readonly name="back_user_image_8" value="<?php if (!isset($back_user_image_8)) {
																																																			echo	esc_url($back_user_image_8 = WL_RP_RP_PLUGIN_URL . 'settings/images/Wallpaper-back.jpg');
																																																		} else {
																																																			echo esc_url($back_user_image_8);
																																																		} ?>" style="width:100%;" />
			<input type="button" value="<?php _e('Upload', 'WL_R_P_R_P') ?>" class="button-primary upload_image_button" />
			<p class="description"><b><?php _e('Note: Please upload image of 500*300 pixel maximum.', 'WL_R_P_R_P') ?></b></p>
		</td>
	</tr>
	<!----------------------------- layout 8 settings end -------------------------->
</table>
<div style="clear:both"></div>
<script>
	jQuery("#t_m_p_l_1").hide();
	jQuery("#t_m_p_l_2").hide();
	jQuery("#t_m_p_l_3").hide();
	jQuery("#t_m_p_l_4").hide();
	jQuery("#t_m_p_l_5").hide();
	jQuery("#t_m_p_l_6").hide();
	jQuery("#t_m_p_l_7").hide();
	jQuery("#t_m_p_l_8").hide();
	jQuery("tr.template_1_settings").hide();
	jQuery("tr.template_2_settings").hide();
	jQuery("tr.template_3_settings").hide();
	jQuery("tr.template_4_settings").hide();
	jQuery("tr.template_5_settings").hide();
	jQuery("tr.template_6_settings").hide();
	jQuery("tr.template_7_settings").hide();
	jQuery("tr.template_8_settings").hide();

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
			jQuery("tr.template_1_settings").show();
			jQuery("tr.template_2_settings").hide();
			jQuery("tr.template_3_settings").hide();
			jQuery("tr.template_4_settings").hide();
			jQuery("tr.template_5_settings").hide();
			jQuery("tr.template_6_settings").hide();
			jQuery("tr.template_7_settings").hide();
			jQuery("tr.template_8_settings").hide();


		} else if (vol == "12") {
			jQuery("#t_m_p_l_2").show();
			jQuery("#t_m_p_l_1").hide();
			jQuery("#t_m_p_l_3").hide();
			jQuery("#t_m_p_l_4").hide();
			jQuery("#t_m_p_l_5").hide();
			jQuery("#t_m_p_l_6").hide();
			jQuery("#t_m_p_l_7").hide();
			jQuery("#t_m_p_l_8").hide();
			jQuery("tr.template_1_settings").hide();
			jQuery("tr.template_2_settings").show();
			jQuery("tr.template_3_settings").hide();
			jQuery("tr.template_4_settings").hide();
			jQuery("tr.template_5_settings").hide();
			jQuery("tr.template_6_settings").hide();
			jQuery("tr.template_7_settings").hide();
			jQuery("tr.template_8_settings").hide();
		} else if (vol == "13") {
			jQuery("#t_m_p_l_3").show();
			jQuery("#t_m_p_l_1").hide();
			jQuery("#t_m_p_l_2").hide();
			jQuery("#t_m_p_l_4").hide();
			jQuery("#t_m_p_l_5").hide();
			jQuery("#t_m_p_l_6").hide();
			jQuery("#t_m_p_l_7").hide();
			jQuery("#t_m_p_l_8").hide();
			jQuery("tr.template_1_settings").hide();
			jQuery("tr.template_2_settings").hide();
			jQuery("tr.template_3_settings").show();
			jQuery("tr.template_4_settings").hide();
			jQuery("tr.template_5_settings").hide();
			jQuery("tr.template_6_settings").hide();
			jQuery("tr.template_7_settings").hide();
			jQuery("tr.template_8_settings").hide();
		} else if (vol == "14") {
			jQuery("#t_m_p_l_4").show();
			jQuery("#t_m_p_l_1").hide();
			jQuery("#t_m_p_l_2").hide();
			jQuery("#t_m_p_l_3").hide();
			jQuery("#t_m_p_l_5").hide();
			jQuery("#t_m_p_l_6").hide();
			jQuery("#t_m_p_l_7").hide();
			jQuery("#t_m_p_l_8").hide();
			jQuery("tr.template_1_settings").hide();
			jQuery("tr.template_2_settings").hide();
			jQuery("tr.template_3_settings").hide();
			jQuery("tr.template_4_settings").show();
			jQuery("tr.template_5_settings").hide();
			jQuery("tr.template_6_settings").hide();
			jQuery("tr.template_7_settings").hide();
			jQuery("tr.template_8_settings").hide();
		} else if (vol == "15") {
			jQuery("#t_m_p_l_5").show();
			jQuery("#t_m_p_l_1").hide();
			jQuery("#t_m_p_l_2").hide();
			jQuery("#t_m_p_l_3").hide();
			jQuery("#t_m_p_l_4").hide();
			jQuery("#t_m_p_l_6").hide();
			jQuery("#t_m_p_l_7").hide();
			jQuery("#t_m_p_l_8").hide();
			jQuery("tr.template_1_settings").hide();
			jQuery("tr.template_2_settings").hide();
			jQuery("tr.template_3_settings").hide();
			jQuery("tr.template_4_settings").hide();
			jQuery("tr.template_5_settings").show();
			jQuery("tr.template_6_settings").hide();
			jQuery("tr.template_7_settings").hide();
			jQuery("tr.template_8_settings").hide();
		} else if (vol == "16") {
			jQuery("#t_m_p_l_6").show();
			jQuery("#t_m_p_l_1").hide();
			jQuery("#t_m_p_l_2").hide();
			jQuery("#t_m_p_l_3").hide();
			jQuery("#t_m_p_l_4").hide();
			jQuery("#t_m_p_l_5").hide();
			jQuery("#t_m_p_l_7").hide();
			jQuery("#t_m_p_l_8").hide();
			jQuery("tr.template_1_settings").hide();
			jQuery("tr.template_2_settings").hide();
			jQuery("tr.template_3_settings").hide();
			jQuery("tr.template_4_settings").hide();
			jQuery("tr.template_5_settings").hide();
			jQuery("tr.template_6_settings").show();
			jQuery("tr.template_7_settings").hide();
			jQuery("tr.template_8_settings").hide();
		} else if (vol == "17") {
			jQuery("#t_m_p_l_7").show();
			jQuery("#t_m_p_l_1").hide();
			jQuery("#t_m_p_l_2").hide();
			jQuery("#t_m_p_l_3").hide();
			jQuery("#t_m_p_l_4").hide();
			jQuery("#t_m_p_l_6").hide();
			jQuery("#t_m_p_l_5").hide();
			jQuery("#t_m_p_l_8").hide();
			jQuery("tr.template_1_settings").hide();
			jQuery("tr.template_2_settings").hide();
			jQuery("tr.template_3_settings").hide();
			jQuery("tr.template_4_settings").hide();
			jQuery("tr.template_5_settings").hide();
			jQuery("tr.template_6_settings").hide();
			jQuery("tr.template_7_settings").show();
			jQuery("tr.template_8_settings").hide();

		} else if (vol == "18") {
			jQuery("#t_m_p_l_8").show();
			jQuery("#t_m_p_l_1").hide();
			jQuery("#t_m_p_l_2").hide();
			jQuery("#t_m_p_l_3").hide();
			jQuery("#t_m_p_l_4").hide();
			jQuery("#t_m_p_l_6").hide();
			jQuery("#t_m_p_l_5").hide();
			jQuery("#t_m_p_l_7").hide();
			jQuery("tr.template_1_settings").hide();
			jQuery("tr.template_2_settings").hide();
			jQuery("tr.template_3_settings").hide();
			jQuery("tr.template_4_settings").hide();
			jQuery("tr.template_5_settings").hide();
			jQuery("tr.template_6_settings").hide();
			jQuery("tr.template_7_settings").hide();
			jQuery("tr.template_8_settings").show();
		}

	}
	var Layout = jQuery('input[name=Tem_pl_at_e]:checked').val();
	if (Layout == "11") {
		jQuery("tr.template_1_settings").show();
		jQuery("div#t_m_p_l_1").show()
	}
	if (Layout == "12") {
		jQuery("tr.template_2_settings").show();
		jQuery("div#t_m_p_l_2").show()
	}
	if (Layout == "13") {
		jQuery("tr.template_3_settings").show();
		jQuery("div#t_m_p_l_3").show()
	}
	if (Layout == "14") {
		jQuery("tr.template_4_settings").show();
		jQuery("div#t_m_p_l_4").show()
	}
	if (Layout == "15") {
		jQuery("tr.template_5_settings").show();
		jQuery("div#t_m_p_l_5").show()
	}
	if (Layout == "16") {
		jQuery("tr.template_6_settings").show();
		jQuery("div#t_m_p_l_6").show()
	}
	if (Layout == "17") {
		jQuery("tr.template_7_settings").show();
		jQuery("div#t_m_p_l_7").show()
	}
	if (Layout == "18") {
		jQuery("tr.template_8_settings").show();
		jQuery("div#t_m_p_l_8").show()
	}

	function displayed_img_temp_1(vol) {
		if (vol == "default") {
			jQuery(".upload_image_temp_1").hide();
			jQuery(".n_o_n_e_temp_1").show();
		}
		if (vol == "upload") {
			jQuery(".upload_image_temp_1").show();
			jQuery(".n_o_n_e_temp_1").show();
		}
		if (vol == "none") {
			jQuery(".upload_image_temp_1").hide();
			jQuery(".n_o_n_e_temp_1").hide();
		}

	}
	var featured_image_1_1 = jQuery('input[name=featured_image_1]:checked').val();
	if (featured_image_1_1 == "none") {
		jQuery(".n_o_n_e_temp_1").hide();
		jQuery(".upload_image_temp_1").hide();
	}
	if (featured_image_1_1 == "default") {
		jQuery(".upload_image_temp_1").hide();
	}
	if (featured_image_1_1 == "upload") {
		jQuery(".upload_image_temp_1").show();
	}


	function displayed_img_temp_2(vol) {
		if (vol == "default") {
			jQuery(".upload_image_temp_2").hide();
			jQuery(".n_o_n_e_temp_2").show();
		}
		if (vol == "upload") {
			jQuery(".upload_image_temp_2").show();
			jQuery(".n_o_n_e_temp_2").show();
		}
		if (vol == "none") {
			jQuery(".upload_image_temp_2").hide();
			jQuery(".n_o_n_e_temp_2").hide();
		}

	}
	var featured_image_2_2 = jQuery('input[name=featured_image_2]:checked').val();
	if (featured_image_2_2 == "none") {
		jQuery(".n_o_n_e_temp_2").hide();
		jQuery(".upload_image_temp_2").hide();
	}
	if (featured_image_2_2 == "default") {
		jQuery(".upload_image_temp_2").hide();
	}
	if (featured_image_2_2 == "upload") {
		jQuery(".upload_image_temp_2").show();
	}

	function displayed_img_temp_3(vol) {
		if (vol == "default") {
			jQuery(".upload_image_temp_3").hide();
			jQuery(".n_o_n_e_temp_3").show();
		}
		if (vol == "upload") {
			jQuery(".upload_image_temp_3").show();
			jQuery(".n_o_n_e_temp_3").show();
		}
		if (vol == "none") {
			jQuery(".upload_image_temp_3").hide();
			jQuery(".n_o_n_e_temp_3").hide();
		}

	}

	var featured_image_3_3 = jQuery('input[name=featured_image_3]:checked').val();
	if (featured_image_3_3 == "none") {
		jQuery(".n_o_n_e_temp_3").hide();
		jQuery(".upload_image_temp_3").hide();
	}
	if (featured_image_3_3 == "default") {
		jQuery(".upload_image_temp_3").hide();
	}
	if (featured_image_3_3 == "upload") {
		jQuery(".upload_image_temp_3").show();
	}

	function displayed_img_temp_4(vol) {
		if (vol == "default") {
			jQuery(".upload_image_temp_4").hide();
			jQuery(".n_o_n_e_temp_4").show();
		}
		if (vol == "upload") {
			jQuery(".upload_image_temp_4").show();
			jQuery(".n_o_n_e_temp_4").show();
		}
		if (vol == "none") {
			jQuery(".upload_image_temp_4").hide();
			jQuery(".n_o_n_e_temp_4").hide();
		}

	}
	var featured_image_4_4 = jQuery('input[name=featured_image_4]:checked').val();
	if (featured_image_4_4 == "none") {
		jQuery(".n_o_n_e_temp_4").hide();
		jQuery(".upload_image_temp_4").hide();
	}
	if (featured_image_4_4 == "default") {
		jQuery(".upload_image_temp_4").hide();
	}
	if (featured_image_4_4 == "upload") {
		jQuery(".upload_image_temp_4").show();
	}

	function displayed_img_temp_5(vol) {
		if (vol == "default") {
			jQuery(".upload_image_temp_5").hide();
		}
		if (vol == "upload") {
			jQuery(".upload_image_temp_5").show();
		}
		if (vol == "none") {
			jQuery(".upload_image_temp_5").hide();
		}

	}
	var featured_image_5_5 = jQuery('input[name=featured_image_5]:checked').val();
	if (featured_image_5_5 == "none") {
		jQuery(".upload_image_temp_5").hide();
	}
	if (featured_image_5_5 == "default") {
		jQuery(".upload_image_temp_5").hide();
	}
	if (featured_image_5_5 == "upload") {
		jQuery(".upload_image_temp_5").show();
	}

	function displayed_img_temp_6(vol) {
		if (vol == "default") {
			jQuery(".upload_image_temp_6").hide();
		}
		if (vol == "upload") {
			jQuery(".upload_image_temp_6").show();
		}
		if (vol == "none") {
			jQuery(".upload_image_temp_6").hide();
		}

	}

	var featured_image_6_6 = jQuery('input[name=featured_image_6]:checked').val();
	if (featured_image_6_6 == "none") {
		jQuery(".upload_image_temp_6").hide();
	}
	if (featured_image_6_6 == "default") {
		jQuery(".upload_image_temp_6").hide();
	}
	if (featured_image_6_6 == "upload") {
		jQuery(".upload_image_temp_6").show();
	}

	function displayed_img_temp_7(vol) {
		if (vol == "default") {
			jQuery(".upload_image_temp_7").hide();
			jQuery(".n_o_n_e_temp_7").show();
		}
		if (vol == "upload") {
			jQuery(".upload_image_temp_7").show();
			jQuery(".n_o_n_e_temp_7").show();
		}
		if (vol == "none") {
			jQuery(".upload_image_temp_7").hide();
			jQuery(".n_o_n_e_temp_7").hide();
		}

	}
	var featured_image_7_7 = jQuery('input[name=featured_image_7]:checked').val();
	if (featured_image_7_7 == "none") {
		jQuery(".upload_image_temp_7").hide();
		jQuery(".n_o_n_e_temp_7").hide();
	}
	if (featured_image_7_7 == "default") {
		jQuery(".upload_image_temp_7").hide();
	}
	if (featured_image_7_7 == "upload") {
		jQuery(".upload_image_temp_7").show();
	}

	function displayed_img_temp_8(vol) {
		if (vol == "default") {
			jQuery(".upload_image_temp_8").hide();
		}
		if (vol == "upload") {
			jQuery(".upload_image_temp_8").show();
		}
		if (vol == "none") {
			jQuery(".upload_image_temp_8").hide();
		}

	}
	var featured_image_8_8 = jQuery('input[name=featured_image_8]:checked').val();
	if (featured_image_8_8 == "none") {
		jQuery(".upload_image_temp_8").hide();
	}
	if (featured_image_8_8 == "default") {
		jQuery(".upload_image_temp_8").hide();
	}
	if (featured_image_8_8 == "upload") {
		jQuery(".upload_image_temp_8").show();
	}
</script>