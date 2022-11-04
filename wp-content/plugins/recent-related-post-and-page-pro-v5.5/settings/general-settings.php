<?php
if (isset($_REQUEST['post'])) {
	$postid = $_REQUEST['post'];
} else {
	$postid = $post->ID;
}
$NWT_Setting = "R_P_A_R_P_Settings_" . $postid;
$NWT_Settings = unserialize(get_post_meta($postid, $NWT_Setting, true));

if ($NWT_Settings != null) {
	if ($NWT_Settings[0] && count($NWT_Settings[0]) == 1) {
		$show_hide           = $NWT_Settings[0]['show_hide'];
		$bottom_bdr_color    = $NWT_Settings[0]['bottom_bdr_color'];
		$bottom_bdr_size     = $NWT_Settings[0]['bottom_bdr_size'];
		$bottom_bdr_type     = $NWT_Settings[0]['bottom_bdr_type'];
		$link_align          = $NWT_Settings[0]['link_align'];
		$date_align          = $NWT_Settings[0]['date_align'];
		$date_back_Color     = $NWT_Settings[0]['date_back_Color'];
		$sliding_arrows_size = $NWT_Settings[0]['sliding_arrows_size'];
		$hover_text_color    = $NWT_Settings[0]['hover_text_color'];
		$title_link          = $NWT_Settings[0]['title_link'];
		$post_order          = $NWT_Settings[0]['post_order'];
		$post_sta_tus        = $NWT_Settings[0]['post_sta_tus'];
		$checkboxvar_page    = $NWT_Settings[0]['checkboxvar_page'];
		$checkboxvar_post    = $NWT_Settings[0]['checkboxvar_post'];
		$order_by            = $NWT_Settings[0]['order_by'];
		$silder_direction    = $NWT_Settings[0]['silder_direction'];
		$pause_silder        = $NWT_Settings[0]['pause_silder'];
		$arrow_color         = $NWT_Settings[0]['arrow_color'];
		$slider_speed        = $NWT_Settings[0]['slider_speed'];
		$hover_Color         = $NWT_Settings[0]['hover_Color'];
		$slider_speed_value  = $NWT_Settings[0]['slider_speed_value'];
		$post_in_slide       = $NWT_Settings[0]['post_in_slide'];
		$total_post_value    = $NWT_Settings[0]['total_post_value'];
		$charcter_limit      = $NWT_Settings[0]['charcter_limit'];
		$char_font_size      = $NWT_Settings[0]['char_font_size'];
		$char_color          = $NWT_Settings[0]['char_color'];
		$back_ground_color   = $NWT_Settings[0]['back_ground_color'];
		$dis_char_lmit       = $NWT_Settings[0]['dis_char_lmit'];
		$dis_font_size       = $NWT_Settings[0]['dis_font_size'];
		$dis_text_Color      = $NWT_Settings[0]['dis_text_Color'];
		$date_font_size      = $NWT_Settings[0]['date_font_size'];
		$date_font_color     = $NWT_Settings[0]['date_font_color'];
		$link_text           = $NWT_Settings[0]['link_text'];
		$link_font_size      = $NWT_Settings[0]['link_font_size'];
		$link_font_Color     = $NWT_Settings[0]['link_font_Color'];
		$link_back_Color     = $NWT_Settings[0]['link_back_Color'];
		$NWT_Font_Style      = $NWT_Settings[0]['NWT_Font_Style'];
		$nwt_custom_css      = $NWT_Settings[0]['nwt_custom_css'];
	}
}
?>
<style>
	.lbl {
		float: left;
		width: 100%;
		margin-right: 0.7em;
		padding-top: 0.3em;
		padding-bottom: 0.3em;
		text-align: center;
		font-weight: bold;
		background-color: #F44336;
		font-size: 20px;
		color: white;
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

	.form-table input.tog,
	.form-table input[type=radio] {
		margin-top: -4px;
		margin-right: 4px;
		/*margin-left: 4%;*/
		float: none;
	}

	input,
	select {
		margin-right: 2%;
		/*margin-left: 5%;*/
	}

	.wp-core-ui .button,
	.wp-core-ui .button-primary,
	.wp-core-ui .button-secondary {
		margin-top: 1%;
	}

	#speed_slider {
		display: none;
	}

	.info_info {
		text-decoration: none;
		margin-left: 10px;
	}

	.info_custom {
		vertical-align: text-top;
		text-decoration: none;
		margin-left: 10px;
	}

	.custnote {
		background-color: rgba(23, 31, 22, 0.64);
		color: #fff;
		width: 324px;
		border-radius: 5px;
		padding-right: 5px;
		padding-left: 5px;
		padding-top: 2px;
		padding-bottom: 2px;
	}
</style>
<script>
	jQuery(document).ready(function() {
		jQuery('.my-color-picker').wpColorPicker();
	});

	function outputUpdate(vol) {
		jQuery("span.volum").text(vol);
	}

	function title_limit(vol) {
		jQuery("span.title_limit").text(vol);
	}

	function date_limit(vol) {
		jQuery("span.date_limit").text(vol);
	}

	function description_limit(vol) {
		jQuery("span.dis_limit").text(vol);
	}

	function outputUpdate_title(vol) {
		jQuery("span.ti_tle").text(vol);
	}

	function outputUpdate_des(vol) {
		jQuery("span.discri_ption").text(vol);
	}

	function outputUpdate_date(vol) {
		jQuery("span.date_font_size").text(vol);
	}

	function outputUpdate_link(vol) {
		jQuery("span.link_font").text(vol);
	}

	function total_post(vol) {
		jQuery("span.total_post_span").text(vol);
	}

	function total_post_slide(vol) {
		jQuery("span.total_post_slide_span").text(vol);
	}

	function slider_speed_function(vol) {
		jQuery("span.slider_speed_span").text(vol);
	}

	function output_img_bdr(vol) {
		jQuery("span.img_border_span").text(vol);
	}

	function slider_arrow_size(vol) {
		jQuery("span.slider_arrow_span").text(vol);
	}

	function border_bottom_bdr(vol) {
		jQuery("span.bottom_border_span").text(vol);
	}

	function displayed_text(vol) {
		if (vol == "slow") {
			jQuery("#speed_slider").hide();
		}
		if (vol == "medium") {
			jQuery("#speed_slider").hide();
		}
		if (vol == "fast") {
			jQuery("#speed_slider").hide();
		}
		if (vol == "custom") {
			jQuery("#speed_slider").show();
		}
	}

	function date_text_hide(vol) {
		if (vol == "show") {
			jQuery("tr.my_date_option").show();
		}
		if (vol == "hide") {
			jQuery("tr.my_date_option").hide();
		}

	}
</script>
<?php require_once("tooltip.php"); ?>
<table class="form-table">
	<tr>
		<td colspan="2"><label class="lbl"><?php _e('General option', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><label><?php _e('Post Order', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($post_order)) {
			$post_order = "ASC";
		} ?>
		<td>
			<select style="width:50%;" name="post_order" id="post_order" class="widefat">
				<option value="ASC" <?php selected($post_order, 'ASC'); ?>>Ascending</option>
				<option value="DESC" <?php selected($post_order, 'DESC'); ?>>Descending</option>
			</select>
			<a href="#" id="a1" data-tooltip="#b1"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Post Status', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($post_sta_tus)) {
			$post_sta_tus = "publish";
		} ?>
		<td>
			<select class="widefat" id="post_sta_tus" name="post_sta_tus" style="width:50%;">
				<option value="publish" <?php selected($post_sta_tus, 'publish'); ?>>Published</option>
				<option value="future" <?php selected($post_sta_tus, 'future'); ?>>Future</option>
				<option value="draft" <?php selected($post_sta_tus, 'draft'); ?>>Draft</option>
				<option value="pending" <?php selected($post_sta_tus, 'pending'); ?>>Pending</option>
				<option value="private" <?php selected($post_sta_tus, 'private'); ?>>Private</option>
				<option value="trash " <?php selected($post_sta_tus, 'trash'); ?>>Trash </option>
				<option value="auto-draft" <?php selected($post_sta_tus, 'auto-draft'); ?>>Auto-draft</option>
				<option value="inherit" <?php selected($post_sta_tus, 'inherit'); ?>>Inherit</option>

			</select>
			<a href="#" id="a2" data-tooltip="#b2"><span class="dashicons dashicons-info info_info"></span></a>
			<p class="description">
				<b>
					<?php _e('Note: Please Select Post Type .', 'WL_R_P_R_P') ?>
				</b>
			</p>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Post Types', 'WL_R_P_R_P'); ?></label></th>

		<td>
			<?php if (!isset($checkboxvar_post) && !isset($checkboxvar_page)) {
				$checkboxvar_post = "post";
			} ?>
			<?php if (!isset($checkboxvar_post)) {
				$checkboxvar_post = "";
			} ?>
			<input name="checkboxvar_post" value="0" type="hidden">
			<input type="checkbox" name="checkboxvar_post" id="checkboxvar_post" value="post" <?php checked('post', $checkboxvar_post); ?>><?php _e('Post', 'WL_R_P_R_P'); ?>
			<a href="#" id="a3_1" data-tooltip="#b3_1"><span class="dashicons dashicons-info info_info"></span></a>
			<?php if (!isset($checkboxvar_page)) {
				$checkboxvar_page = "";
			} ?>
			<input name="checkboxvar_page" value="0" type="hidden">
			<input type="checkbox" name="checkboxvar_page" id="checkboxvar_page" value="page" <?php checked('page', $checkboxvar_page); ?>><?php _e('Page', 'WL_R_P_R_P'); ?>
			<a href="#" id="a3_2" data-tooltip="#b3_2"><span class="dashicons dashicons-info info_info"></span></a>
			<p class="description">
				<b>
					<?php _e('Note: Please Select atleast one .', 'WL_R_P_R_P') ?>
				</b>
			</p>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Order By', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($order_by)) {
			$order_by = "title";
		} ?>
		<td><select class="widefat" id="order_by" name="order_by" style="width:50%;">
				<option value="ID" <?php selected($order_by, 'ID'); ?>>ID</option>
				<option value="author" <?php selected($order_by, 'author'); ?>>Author</option>
				<option value="title" <?php selected($order_by, 'title'); ?>>Title</option>
				<option value="date" <?php selected($order_by, 'date'); ?>>Date</option>
				<option value="modified" <?php selected($order_by, 'modified'); ?>>Recently Modified</option>
				<option value="rand" <?php selected($order_by, 'rand'); ?>>Random</option>
				<option value="comment_count" <?php selected($order_by, 'comment_count'); ?>>Comment Count</option>
				<option value="menu_order" <?php selected($order_by, 'menu_order'); ?>>Menu Order</option>
			</select>
			<a href="#" id="a4" data-tooltip="#b4"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr>
		<td colspan="2"><label class="lbl"><?php _e('Slider Display Options', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><label><?php _e('Total Posts To Show', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="1" max="30" step="1" value="<?php if (!isset($total_post_value)) {
																		echo $total_post_value = "5";
																	} else {
																		echo $total_post_value;
																	} ?>" data-orientation="vertical" id="total_post_value" name="total_post_value" oninput="total_post(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="total_post_span rang_span_style"><?php echo $total_post_value ?></span>
			<a href="#" id="a5" data-tooltip="#b5"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('No. Of Post To Show In Slide', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="1" max="10" step="1" value="<?php if (!isset($post_in_slide)) {
																		echo $post_in_slide = "1";
																	} else {
																		echo $post_in_slide;
																	} ?>" data-orientation="vertical" id="post_in_slide" name="post_in_slide" oninput="total_post_slide(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="total_post_slide_span rang_span_style"><?php echo $post_in_slide ?></span>
			<a href="#" id="a6" data-tooltip="#b6"><span class="dashicons dashicons-info info_info"></span></a>
		</td>

	</tr>
	<tr>
		<th><label><?php _e('Slider Direction', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($silder_direction)) {
			$silder_direction = "up";
		} else {
			$silder_direction;
		} ?>
		<td>
			<input type="radio" name="silder_direction" id="silder_direction" value="up" <?php checked('up', $silder_direction); ?>><?php _e('Up', 'WL_R_P_R_P'); ?>
			<a href="#" id="a7_1" data-tooltip="#b7_1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="silder_direction" id="silder_direction" value="down" <?php checked('down', $silder_direction); ?>><?php _e('Down', 'WL_R_P_R_P'); ?>
			<a href="#" id="a7_2" data-tooltip="#b7_2"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Pause Slide On Mouseover', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($pause_silder)) {
			$pause_silder = "1";
		} else {
			$pause_silder;
		} ?>
		<td>
			<input type="radio" name="pause_silder" id="pause_silder" value="1" <?php checked('1', $pause_silder); ?>><?php _e('Yes', 'WL_R_P_R_P'); ?>
			<a href="#" id="a8_1" data-tooltip="#b8_1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="pause_silder" id="pause_silder" value="0" <?php checked('0', $pause_silder); ?>><?php _e('No', 'WL_R_P_R_P'); ?>
			<a href="#" id="a8_2" data-tooltip="#b8_2"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Sliding Arrow Color', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="my-color-picker" id="arrow_color" name="arrow_color" type="text" value="<?php if (!isset($arrow_color)) {
																										echo $arrow_color = "#eeee22 ";
																									} else {
																										echo $arrow_color;
																									} ?>">
			<a href="#" id="a9" data-tooltip="#b9"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>

	<tr>
		<th><label><?php _e('Sliding Arrow Size', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="10" max="100" step="1" value="<?php if (!isset($sliding_arrows_size)) {
																		echo $sliding_arrows_size = "50";
																	} else {
																		echo $sliding_arrows_size;
																	} ?>" data-orientation="vertical" id="sliding_arrows_size" name="sliding_arrows_size" oninput="slider_arrow_size(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="slider_arrow_span rang_span_style"><?php echo $sliding_arrows_size ?> </span>
			<a href="#" id="a10" data-tooltip="#b10"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Slider Speed', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($slider_speed)) {
			$slider_speed = "medium";
		} else {
			$slider_speed;
		} ?>
		<td>
			<input type="radio" name="slider_speed" id="slider_speed" value="slow" <?php checked('slow', $slider_speed); ?> onclick="displayed_text(this.value);"> <?php _e('Slow', 'WL_R_P_R_P');   ?>
			<input type="radio" name="slider_speed" id="slider_speed" value="medium" <?php checked('medium', $slider_speed); ?> onclick="displayed_text(this.value);"> <?php _e('Medium', 'WL_R_P_R_P'); ?>
			<input type="radio" name="slider_speed" id="slider_speed" value="fast" <?php checked('fast', $slider_speed); ?> onclick="displayed_text(this.value);"> <?php _e('Fast', 'WL_R_P_R_P'); ?>
			<input type="radio" name="slider_speed" id="slider_speed" value="custom" <?php checked('custom', $slider_speed); ?> onclick="displayed_text(this.value);"><?php _e('Custom', 'WL_R_P_R_P'); ?>
			<a href="#" id="a11" data-tooltip="#b11"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<?php if ($slider_speed == "custom") {
		$my_speed_variable = "style = 'display: table-row'";
	} else {
		$my_speed_variable = "";
	} ?>
	<tr id="speed_slider" <?php echo $my_speed_variable; ?>>
		<th><label><?php _e('Set custom value', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="100" max="10000" step="1" value="<?php if (!isset($slider_speed_value)) {
																			echo $slider_speed_value = "1000";
																		} else {
																			echo $slider_speed_value;
																		} ?>" data-orientation="vertical" id="slider_speed_value" name="slider_speed_value" oninput="slider_speed_function(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="slider_speed_span rang_span_style"><?php echo $slider_speed_value ?> </span><br>
			<span class="description" style="font-size: 16px;"><b><?php _e('ex : 10 (in milliseconds)', 'WL_R_P_R_P') ?></b></span>
		</td>
	</tr>
	<tr>
		<td colspan="2"><label class="lbl"><?php _e('Background Color', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><label><?php _e('Background Color', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="my-color-picker" id="back_ground_color" name="back_ground_color" type="text" value="<?php if (!isset($back_ground_color)) {
																													echo $back_ground_color = "#ff6347";
																												} else {
																													echo $back_ground_color;
																												} ?>">
			<a href="#" id="a12" data-tooltip="#b12"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<td colspan="2"><label class="lbl"><?php _e('Title option', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><label><?php _e('Use Title As Link ', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($title_link)) {
			$title_link = "yes";
		} else {
			$title_link;
		} ?>
		<td>
			<input type="radio" name="title_link" id="title_link" value="yes" <?php checked('yes', $title_link); ?>><?php _e('Yes', 'WL_R_P_R_P'); ?>
			<a href="#" id="a13_1" data-tooltip="#b13_1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="title_link" id="title_link" value="no" <?php checked('no', $title_link); ?>><?php _e('No', 'WL_R_P_R_P'); ?>
			<a href="#" id="a13_2" data-tooltip="#b13_2"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Number Of Letters In Title', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="0" max="50" step="1" value="<?php if (!isset($charcter_limit)) {
																		echo $charcter_limit = "30";
																	} else {
																		echo $charcter_limit;
																	} ?>" data-orientation="vertical" id="charcter_limit" name="charcter_limit" oninput="title_limit(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="title_limit rang_span_style"><?php echo $charcter_limit ?></span>
			<a href="#" id="a14" data-tooltip="#b14"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Font size', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="8" max="32" step="1" value="<?php if (!isset($char_font_size)) {
																		echo $char_font_size = "24";
																	} else {
																		echo $char_font_size;
																	} ?>" data-orientation="vertical" id="char_font_size" name="char_font_size" oninput="outputUpdate_title(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="ti_tle rang_span_style"><?php echo $char_font_size ?></span>
			<a href="#" id="a15" data-tooltip="#b15"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Font Text Color', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="my-color-picker" id="char_color" name="char_color" type="text" value="<?php if (!isset($char_color)) {
																									echo $char_color = "#ffffff";
																								} else {
																									echo $char_color;
																								} ?>">
			<a href="#" id="a16" data-tooltip="#b16"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<td colspan="2"><label class="lbl"><?php _e('Description option', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><label><?php _e('Number Of Letters In Description', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="0" max="600" step="1" value="<?php if (!isset($dis_char_lmit)) {
																		echo $dis_char_lmit = "200";
																	} else {
																		echo $dis_char_lmit;
																	} ?>" data-orientation="vertical" id="dis_char_lmit" name="dis_char_lmit" oninput=" description_limit(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="dis_limit rang_span_style" style="width:35px;"><?php echo $dis_char_lmit ?></span>
			<a href="#" id="a17" data-tooltip="#b17"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Font Size', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="8" max="24" step="1" value="<?php if (!isset($dis_font_size)) {
																		echo $dis_font_size = "16";
																	} else {
																		echo $dis_font_size;
																	} ?>" data-orientation="vertical" id="dis_font_size" name="dis_font_size" oninput="outputUpdate_des(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="discri_ption rang_span_style"><?php echo $dis_font_size ?></span>
			<a href="#" id="a18" data-tooltip="#b18"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Font Text Color', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="my-color-picker" id="dis_text_Color" name="dis_text_Color" type="text" value="<?php if (!isset($dis_text_Color)) {
																											echo $dis_text_Color = "#ffffff";
																										} else {
																											echo $dis_text_Color;
																										} ?>">
			<a href="#" id="a19" data-tooltip="#b19"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<td colspan="2"><label class="lbl"><?php _e('Date option', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><?php _e('Date', 'WL_R_P_R_P'); ?></th>
		<?php if (!isset($show_hide)) {
			$show_hide = "show";
		} ?>
		<td>
			<input type="radio" name="show_hide" id="show_hide" value="show" <?php checked('show', $show_hide); ?> onclick="date_text_hide(this.value);"><?php _e('Yes', 'WL_R_P_R_P'); ?>
			<a href="#" id="a20_1" data-tooltip="#b20_1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="show_hide" id="show_hide" value="hide" <?php checked('hide', $show_hide); ?> onclick="date_text_hide(this.value);"><?php _e('No', 'WL_R_P_R_P'); ?>
			<a href="#" id="a20_2" data-tooltip="#b20_2"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="my_date_option" <?php if ($show_hide == "hide") {
									echo "style='display: none;'";
								} ?>>
		<th><label><?php _e('Font size', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="12" max="32" step="1" value="<?php if (!isset($date_font_size)) {
																		echo $date_font_size = "14";
																	} else {
																		echo $date_font_size;
																	} ?>" data-orientation="vertical" id="date_font_size" name="date_font_size" oninput="outputUpdate(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="volum rang_span_style"><?php echo $date_font_size ?></span>
			<a href="#" id="a21" data-tooltip="#b21"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="my_date_option" <?php if ($show_hide == "hide") {
									echo "style='display: none;'";
								} ?>>
		<th><label><?php _e('Font Text Color', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="my-color-picker" id="date_font_color" name="date_font_color" type="text" value="<?php if (!isset($date_font_color)) {
																												echo $date_font_color = "#ffffff";
																											} else {
																												echo $date_font_color;
																											} ?>">
			<a href="#" id="a22" data-tooltip="#b22"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="my_date_option" <?php if ($show_hide == "hide") {
									echo "style='display: none;'";
								} ?>>
		<th><label><?php _e('BackgroundColor', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="my-color-picker" id="date_back_Color" name="date_back_Color" type="text" value="<?php if (!isset($date_back_Color)) {
																												echo $date_back_Color = "#dd3333";
																											} else {
																												echo $date_back_Color;
																											} ?>">
			<a href="#" id="a23" data-tooltip="#b23"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr class="my_date_option" <?php if ($show_hide == "hide") {
									echo "style='display: none;'";
								} ?>>
		<th><label><?php _e('Align Date ', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($date_align)) {
			$date_align = "left";
		} else {
			$date_align;
		} ?>
		<td>
			<input type="radio" name="date_align" id="date_align" value="right" <?php checked('right', $date_align); ?>><?php _e('Right', 'WL_R_P_R_P'); ?>
			<a href="#" id="a24_1" data-tooltip="#b24_1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="date_align" id="date_align" value="left" <?php checked('left', $date_align); ?>><?php _e('Left', 'WL_R_P_R_P'); ?>
			<a href="#" id="a24_2" data-tooltip="#b24_2"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<td colspan="2"><label class="lbl"><?php _e('Link option', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><label> <?php _e('Text', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="widefat" id="link_text" name="link_text" type="text" value="<?php if (!isset($link_text)) {
																							echo esc_attr($link_text = "Read More");
																						} else {
																							echo esc_attr($link_text);
																						} ?>" style="width:50%;" maxlength="20" />
			<a href="#" id="a25" data-tooltip="#b25"><span class="dashicons dashicons-info info_info"></span></a>
			<b>
				<p class="description"><?php _e('Maximum charcter Limit 20.', 'WL_R_P_R_P') ?></p>
			</b>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Font size', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="8" max="32" step="1" value="<?php if (!isset($link_font_size)) {
																		echo $link_font_size = "14";
																	} else {
																		echo $link_font_size;
																	} ?>" data-orientation="vertical" id="link_font_size" name="link_font_size" oninput="outputUpdate_link(value);" />
			<span id="name_set_span_value" name="name_set_span_value" class="link_font rang_span_style"><?php echo $link_font_size ?></span>
			<a href="#" id="a26" data-tooltip="#b26"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Font Text Color', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="my-color-picker" id="link_font_Color" name="link_font_Color" type="text" value="<?php if (!isset($link_font_Color)) {
																												echo $link_font_Color = "#ffffff";
																											} else {
																												echo $link_font_Color;
																											} ?>">
			<a href="#" id="a27" data-tooltip="#b27"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('BackgroundColor', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input class="my-color-picker" id="link_back_Color" name="link_back_Color" type="text" value="<?php if (!isset($link_back_Color)) {
																												echo $link_back_Color = "#dd3333";
																											} else {
																												echo $link_back_Color;
																											} ?>">
			<a href="#" id="a28" data-tooltip="#b28"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('BackgroundColor On Hover', 'WL_R_P_R_P'); ?></label></th>

		<td>
			<input class="my-color-picker" id="hover_Color" name="hover_Color" type="text" value="<?php if (!isset($hover_Color)) {
																										echo $hover_Color = "#ffffff";
																									} else {
																										echo $hover_Color;
																									} ?>">
			<a href="#" id="a29" data-tooltip="#b29"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Font Text Color On Hover', 'WL_R_P_R_P'); ?></label></th>

		<td>
			<input class="my-color-picker" id="hover_text_color" name="hover_text_color" type="text" value="<?php if (!isset($hover_text_color)) {
																												echo $hover_text_color = "#dd3333";
																											} else {
																												echo $hover_text_color;
																											} ?>">
			<a href="#" id="a30" data-tooltip="#b30"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Align Link ', 'WL_R_P_R_P'); ?></label></th>
		<?php if (!isset($link_align)) {
			$link_align = "right";
		} else {
			$link_align;
		} ?>
		<td>
			<input type="radio" name="link_align" id="link_align" value="right" <?php checked('right', $link_align); ?>><?php _e('Right', 'WL_R_P_R_P'); ?>
			<a href="#" id="a31_1" data-tooltip="#b31_1"><span class="dashicons dashicons-info info_info"></span></a>
			<input type="radio" name="link_align" id="link_align" value="left" <?php checked('left', $link_align); ?>><?php _e('Left', 'WL_R_P_R_P'); ?>
			<a href="#" id="a31_2" data-tooltip="#b31_2"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<td colspan="2"><label class="lbl"><?php _e(' Bottom Border option', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><label><?php _e('Border Style', 'WL_R_P_R_P'); ?></label></th>
		<td> <?php if (!isset($bottom_bdr_type)) {
					$bottom_bdr_type = "none";
				} ?>
			<select name="bottom_bdr_type" id="bottom_bdr_type">
				<?php $options_bdr_type = array('none', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset');
				foreach ($options_bdr_type as $option_bdr_type_img) {
					echo '<option
					value="' . esc_attr($option_bdr_type_img) . '"
					id="' . esc_attr($option_bdr_type_img) . '"',
						$bottom_bdr_type == $option_bdr_type_img ? ' selected="selected"' : '',
						'>',
						$option_bdr_type_img,
						'</option>';
				}
				?>
			</select>
			<a href="#" id="a32" data-tooltip="#b32"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Border Size', 'WL_R_P_R_P'); ?></label></th>
		<td>
			<input type="range" min="1" max="10" step="1" value="<?php if (!isset($bottom_bdr_size)) {
																		echo	esc_attr($bottom_bdr_size = "3");
																	} else {
																		echo esc_attr($bottom_bdr_size);
																	} ?>" data-orientation="vertical" id="bottom_bdr_size" name="bottom_bdr_size" oninput="border_bottom_bdr(value);" />
			<span class="bottom_border_span rang_span_style" id="img_bdr_span_value" name="img_bdr_span_value"><?php echo esc_attr($bottom_bdr_size); ?></span>
			<a href="#" id="a33" data-tooltip="#b33"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Border Color', 'WL_ABTM_TXT_DM'); ?></label></th>
		<td><input class="my-color-picker" id="bottom_bdr_color" name="bottom_bdr_color" type="text" value="<?php if (!isset($bottom_bdr_color)) {
																												echo	esc_attr($bottom_bdr_color = "#ffffff");
																											} else {
																												echo esc_attr($bottom_bdr_color);
																											} ?>">
			<a href="#" id="a34" data-tooltip="#b34"><span class="dashicons dashicons-info info_info"></span></a>
		</td>
	</tr>
	<tr>
		<td colspan="2"><label class="lbl"><?php _e('Font Family', 'WL_R_P_R_P'); ?></label></td>
	</tr>

	<tr>
		<th><label><?php _e('Font Family', 'WL_ABTM_TXT_DM'); ?></label></th>
		<td> <?php if (!isset($NWT_Font_Style)) {
					$NWT_Font_Style = "Open Sans";
				} ?>
			<select name="NWT_Font_Style" id="NWT_Font_Style" class="standard-dropdown">
				<optgroup label="Default Fonts">
					<option value="Arial" <?php selected($NWT_Font_Style, 'Arial'); ?>>Arial</option>
					<option value="Arial Black" <?php selected($NWT_Font_Style, 'Arial Black'); ?>>Arial Black</option>
					<option value="Courier New" <?php selected($NWT_Font_Style, 'Courier New'); ?>>Courier New</option>
					<option value="cursive" <?php selected($NWT_Font_Style, 'cursive'); ?>>Cursive</option>
					<option value="fantasy" <?php selected($NWT_Font_Style, 'fantasy'); ?>>Fantasy</option>
					<option value="Georgia" <?php selected($NWT_Font_Style, 'Georgia'); ?>>Georgia</option>
					<option value="Grande" <?php selected($NWT_Font_Style, 'Grande'); ?>>Grande</option>
					<option value="Helvetica Neue" <?php selected($NWT_Font_Style, 'Helvetica Neue'); ?>>Helvetica Neue</option>
					<option value="Impact" <?php selected($NWT_Font_Style, 'Impact'); ?>>Impact</option>
					<option value="Lucida" <?php selected($NWT_Font_Style, 'Lucida'); ?>>Lucida</option>
					<option value="Lucida Console" <?php selected($NWT_Font_Style, 'Lucida Console'); ?>>Lucida Console</option>
					<option value="monospace" <?php selected($NWT_Font_Style, 'monospace'); ?>>Monospace</option>
					<option value="Open Sans" <?php selected($NWT_Font_Style, 'Open Sans'); ?>>Open Sans</option>
					<option value="Palatino" <?php selected($NWT_Font_Style, 'Palatino'); ?>>Palatino</option>
					<option value="sans" <?php selected($NWT_Font_Style, 'sans'); ?>>Sans</option>
					<option value="sans-serif" <?php selected($NWT_Font_Style, 'sans-serif'); ?>>Sans-Serif</option>
					<option value="Tahoma" <?php selected($NWT_Font_Style, 'Tahoma'); ?>>Tahoma</option>
					<option value="Times New Roman" <?php selected($NWT_Font_Style, 'Times New Roman'); ?>>Times New Roman</option>
					<option value="Trebuchet MS" <?php selected($NWT_Font_Style, 'Trebuchet MS'); ?>>Trebuchet MS</option>
					<option value="Verdana" <?php selected($NWT_Font_Style, 'Verdana'); ?>>Verdana</option>
				</optgroup>
				<optgroup label="Google Fonts">
					<?php
					// fetch the Google font list
					$google_api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAccXEBQEkF2rMcxcanpJKQ6y9n2lz6avM';
					$response_font_api = wp_remote_retrieve_body(wp_remote_get($google_api_url, array('sslverify' => false)));
					if (!is_wp_error($response_font_api)) {
						$fonts_list = json_decode($response_font_api,  true);
						// that's it
						if (is_array($fonts_list)) {
							$g_fonts = $fonts_list['items'];
							foreach ($g_fonts as $g_font) {
								$font_name = $g_font['family']; ?>
								<option value="<?php echo $font_name; ?>" <?php selected($NWT_Font_Style, $font_name); ?>><?php echo $font_name; ?></option><?php
																																							}
																																						} else {
																																							echo "<option disabled>Error to fetch Google fonts.</option>";
																																							echo "<option disabled>Google font will not available in offline mode.</option>";
																																						}
																																					}
																																								?>
				</optgroup>
			</select>
			<a href="#" id="a35" data-tooltip="#b35"><span class="dashicons dashicons-info info_info"></span></a>
			<p class="description">
				<?php _e('Choose a caption font style.', 'WL_R_P_R_P') ?>
			</p>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<label class="lbl"><?php _e('Custom CSS', 'WL_R_P_R_P'); ?></label></td>
	</tr>
	<tr>
		<th><label><?php _e('Custom CSS', 'WL_R_P_R_P'); ?></label> </th>
		<td>
			<textarea class="widefat" id="nwt_custom_css" name="nwt_custom_css" style="width:50%;height: 125px;;" placeholder="<?php _e('Enter custom css here', 'WL_R_P_R_P')  ?>"><?php if (!isset($nwt_custom_css)) {
																																														echo esc_attr($nwt_custom_css = "");
																																													} else {
																																														echo esc_attr($nwt_custom_css);
																																													} ?></textarea>
			<p class="description">
				<?php _e('Enter any custom css you want to apply on this gallery.', 'WL_R_P_R_P') ?><br>
			</p>
			<p class="custnote">Note: Please Do Not Use <b>Style</b> Tag With Custom CSS</p>
		</td>
		<td></td>
	</tr>
</table>
<script>
	jQuery(document).ready(function($) {
		jQuery(window).scroll(function() {
			if (jQuery(this).scrollTop() < 200) {
				jQuery('#smoothup').fadeOut();
			} else {
				jQuery('#smoothup').fadeIn();
			}
		});
		jQuery('#smoothup').on('click', function() {
			jQuery('html, body').animate({
				scrollTop: 0
			}, 'fast');
			return false;
		});
		var editor = CodeMirror.fromTextArea(document.getElementById("nwt_custom_css"), {
			lineNumbers: true,
			styleActiveLine: true,
			matchBrackets: true,
			hint: true,
			theme: 'blackboard',
			lineWrapping: true,
			extraKeys: {
				"Ctrl-Space": "autocomplete"
			},
		});
	});
</script>
<a href="#top" id="smoothup" title="Back to top"></a>
<style>
	#smoothup {
		height: 50px;
		width: 50px;
		position: fixed;
		bottom: 50px;
		right: 250px;
		text-indent: -9999px;
		display: none;
		background: url("<?php echo WL_RP_RP_PLUGIN_URL . 'settings/images/up.png'; ?>");
		-webkit-transition-duration: 0.4s;
		-moz-transition-duration: 0.4s;
		transition-duration: 0.4s;
	}

	#smoothup:hover {
		-webkit-transform: rotate(360deg)
	}

	background: url('') no-repeat;
	}
</style>