<?php
if (isset($_POST['submit'])) {
	$page_rp_rp_short_code = sanitize_text_field($_POST['page_rp_rp_short_code']);
	$post_rp_rp_short_code = sanitize_text_field($_POST['post_rp_rp_short_code']);
	$switch_off_page       = sanitize_text_field($_POST['switch_off_page']);
	$switch_off_post       = sanitize_text_field($_POST['switch_off_post']);
	$p_p_lbl_text_page     = stripslashes($_POST['p_p_lbl_text_page']);
	$p_p_lbl_text_post     = stripslashes($_POST['p_p_lbl_text_post']);
	$p_p_bg_color          = sanitize_text_field($_POST['p_p_bg_color']);
	$p_p_color             = sanitize_text_field($_POST['p_p_color']);
	$p_p_lbl_text_font     = sanitize_text_field($_POST['p_p_lbl_text_font']);
	$P_P_PGPP_Font_Style   = sanitize_text_field($_POST['P_P_PGPP_Font_Style']);

	$ABio_Array[] = array(
		'page_rp_rp_short_code' => $page_rp_rp_short_code,
		'post_rp_rp_short_code' => $post_rp_rp_short_code,
		'switch_off_page'       => $switch_off_page,
		'switch_off_post'       => $switch_off_post,
		'p_p_lbl_text_page'     => $p_p_lbl_text_page,
		'p_p_lbl_text_post'     => $p_p_lbl_text_post,
		'p_p_bg_color'          => $p_p_bg_color,
		'p_p_color'             => $p_p_color,
		'p_p_lbl_text_font'     => $p_p_lbl_text_font,
		'P_P_PGPP_Font_Style'   => $P_P_PGPP_Font_Style,

	);

	update_option('rp_rp_info_Settings', serialize($ABio_Array));
}

$ABio_settings = unserialize(get_option('rp_rp_info_Settings'));
if ($ABio_settings != null) {
	if (count($ABio_settings[0])) {
		$page_rp_rp_short_code = $ABio_settings[0]['page_rp_rp_short_code'];
		$post_rp_rp_short_code = $ABio_settings[0]['post_rp_rp_short_code'];
		$switch_off_page       = $ABio_settings[0]['switch_off_page'];
		$switch_off_post       = $ABio_settings[0]['switch_off_post'];
		$p_p_lbl_text_page     = $ABio_settings[0]['p_p_lbl_text_page'];
		$p_p_lbl_text_post     = $ABio_settings[0]['p_p_lbl_text_post'];
		$p_p_bg_color          = $ABio_settings[0]['p_p_bg_color'];
		$p_p_color             = $ABio_settings[0]['p_p_color'];
		$p_p_lbl_text_font     = $ABio_settings[0]['p_p_lbl_text_font'];
		$P_P_PGPP_Font_Style   = $ABio_settings[0]['P_P_PGPP_Font_Style'];
	}
}
?>
<script>
	function page_settings(vol) {
		if (vol == "yes") {
			jQuery(".page_context").show();
		}
		if (vol == "no") {
			jQuery(".page_context").hide();
		}
	}

	function post_settings(vol) {
		if (vol == "yes") {
			jQuery(".post_context").show();
		}
		if (vol == "no") {
			jQuery(".post_context").hide();
		}
	}
	jQuery(document).ready(function() {
		jQuery('input.my-color-picker').wpColorPicker();
	});

	function outputUpdate(vol) {
		jQuery("span.font_size").text(vol);
	}
</script>
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

	.page_context {
		display: none;
	}

	.post_context {
		display: none;
	}

	.info_info {
		text-decoration: none;
		margin-left: 10px;
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
</style>
<?php require_once("settings/tooltip.php"); ?>
<div class="row-fluid pricing-table pricing-three-column" style="margin-top: 10px; display:block; width:100%; overflow:hidden; background:white; box-shadow: 0 0 5px hsla(0, 0%, 20%, 0.3);padding-bottom:70px">
	<form method="post" action="">
		<div class="plan-name" style="margin-top:20px;text-align: center;">
			<h2 style="font-weight: bold;font-size: 36px;padding-top: 30px;padding-bottom: 10px;color:#D9534F;"><?php _e('Page/Post settings', 'WL_R_P_R_P'); ?></h2>
		</div>
		<table class="form-table" style="margin-left:20px; width: 98%;">
			<tr>
				<td colspan="2"><label class="lbl"> <?php _e('Display settings', 'WL_R_P_R_P'); ?> </label></td>
			</tr>
			<tr>
				<?php if (!isset($switch_off_page)) {
					$switch_off_page = "yes";
				} ?>
				<th><?php _e('On page', 'WL_R_P_R_P'); ?></th>
				<td>
					<input type="radio" name="switch_off_page" id="switch_off_page" value="yes" <?php checked('yes', $switch_off_page); ?> onclick="page_settings(this.value);"><?php _e('Yes', 'WL_R_P_R_P'); ?>
					<a href="#" id="w1_1" data-tooltip="#q1_1"><span class="dashicons dashicons-info info_info"></span></a>
					<input type="radio" name="switch_off_page" id="switch_off_page" value="no" <?php checked('no', $switch_off_page); ?> onclick="page_settings(this.value);"><?php _e('No', 'WL_R_P_R_P'); ?>
					<a href="#" id="w1_2" data-tooltip="#q1_2"><span class="dashicons dashicons-info info_info"></span></a>
				</td>
			</tr>
			<?php if (!isset($switch_off_post)) {
				$switch_off_post = "yes";
			} ?>
			<tr>
				<th><?php _e('On post', 'WL_R_P_R_P'); ?></th>
				<td>
					<input type="radio" name="switch_off_post" id="switch_off_post" value="yes" <?php checked('yes', $switch_off_post); ?> onclick="post_settings(this.value);"><?php _e('Yes', 'WL_R_P_R_P'); ?>
					<a href="#" id="w2_1" data-tooltip="#q2_1"><span class="dashicons dashicons-info info_info"></span></a>
					<input type="radio" name="switch_off_post" id="switch_off_post" value="no" <?php checked('no', $switch_off_post); ?> onclick="post_settings(this.value);"><?php _e('No', 'WL_R_P_R_P'); ?>
					<a href="#" id="w2_2" data-tooltip="#q2_2"><span class="dashicons dashicons-info info_info"></span></a>
				</td>
			</tr>
			<tr class="page_context" <?php if ($switch_off_page == "yes") {
											echo 'style="display: table-row;"';
										} ?>>
				<td colspan="2"><label class="lbl"><?php _e('Select Shortcode Style To Display On Page Context ', 'WL_R_P_R_P'); ?></label></td>
			</tr>
			<?php if (!isset($page_rp_rp_short_code)) {
				$page_rp_rp_short_code = "1";
			} ?>
			<?php $ABT_CPT_Name = "rp_and_rp";
			$ABT_All_Posts = wp_count_posts($ABT_CPT_Name)->publish;
			global $All_ABTM;
			$All_ABTM = array('post_type' => $ABT_CPT_Name, 'orderby' => 'ASC', 'posts_per_page' => $ABT_All_Posts);
			$All_ABTM = new WP_Query($All_ABTM);
			?>
			<tr class="page_context" <?php if ($switch_off_page == "yes") {
											echo 'style="display: table-row;"';
										} ?>>
				<th><?php _e('All Shortcode', 'WL_R_P_R_P'); ?></th>
				<td><select id="page_rp_rp_short_code" name="page_rp_rp_short_code">
						<option value="1">
							<--Select one-->
						</option>
						<?php
						if ($All_ABTM->have_posts()) {	 ?>
							<?php
							while ($All_ABTM->have_posts()) : $All_ABTM->the_post();
								$PostId = get_the_ID();
								$PostTitle = get_the_title($PostId);
							?>
								<option value="<?php echo $PostId; ?>" <?php if ($page_rp_rp_short_code == $PostId) echo 'selected="selected"'; ?>><?php if ($PostTitle) echo $PostTitle;
																																				else _e("No Title", WL_R_P_R_P); ?></option>
							<?php endwhile; ?>
						<?php
						} else {
							echo "<option>Sorry! No Recent Related Post And Page Shortcode Found.</option>";
						}
						?>
					</select>
					<a href="#" id="w3" data-tooltip="#q3"><span class="dashicons dashicons-info info_info"></span></a>
				</td>
			</tr>

			<tr class="post_context" <?php if ($switch_off_post == "yes") {
											echo 'style="display: table-row;"';
										} ?>>
				<td colspan="2"><label class="lbl"><?php _e('Select Shortcode Style To Display On Post Context ', 'WL_R_P_R_P'); ?></label></td>
			</tr>
			<?php if (!isset($post_rp_rp_short_code)) {
				$post_rp_rp_short_code = "1";
			} ?>
			<?php $ABT_CPT_Name = "rp_and_rp";
			$ABT_All_Posts = wp_count_posts($ABT_CPT_Name)->publish;
			global $All_ABTM;
			$All_ABTM = array('post_type' => $ABT_CPT_Name, 'orderby' => 'ASC', 'posts_per_page' => $ABT_All_Posts);
			$All_ABTM = new WP_Query($All_ABTM);
			?>
			<tr class="post_context" <?php if ($switch_off_post == "yes") {
											echo 'style="display: table-row;"';
										} ?>>
				<th><?php _e('All Shortcode', 'WL_R_P_R_P'); ?></th>
				<td><select id="post_rp_rp_short_code" name="post_rp_rp_short_code">
						<option value="1">
							<--Select one-->
						</option>
						<?php
						if ($All_ABTM->have_posts()) {	 ?>
							<?php
							while ($All_ABTM->have_posts()) : $All_ABTM->the_post();
								$PostId = get_the_ID();
								$PostTitle = get_the_title($PostId);
							?>
								<option value="<?php echo $PostId; ?>" <?php if ($post_rp_rp_short_code == $PostId) echo 'selected="selected"'; ?>><?php if ($PostTitle) echo $PostTitle;
																																				else _e("No Title", WL_R_P_R_P); ?></option>
							<?php endwhile; ?>
						<?php
						} else {
							echo "<option>Sorry! No Recent Related Post And Page Shortcode Found.</option>";
						}
						?>
					</select>
					<a href="#" id="w4" data-tooltip="#q4"><span class="dashicons dashicons-info info_info"></span></a>
				</td>
			</tr>
			<tr>
				<td colspan="2"><label class="lbl"><?php _e('Recent Related Post And Page label settings', 'WL_R_P_R_P'); ?></label></td>
			</tr>

			<tr>
				<th><?php _e('Label Text For Page', 'WL_R_P_R_P'); ?></th>
				<?php if (!isset($p_p_lbl_text_page)) {
					$p_p_lbl_text_page = "Recent Pages";
				} ?>
				<td>
					<input type="text" name="p_p_lbl_text_page" id="p_p_lbl_text_page" value="<?php echo esc_attr($p_p_lbl_text_page); ?>" />
					<a href="#" id="w5" data-tooltip="#q5"><span class="dashicons dashicons-info info_info"></span></a>
				</td>
			</tr>
			<tr>
				<th><?php _e('Label Text For Post', 'WL_R_P_R_P'); ?></th>
				<?php if (!isset($p_p_lbl_text_post)) {
					$p_p_lbl_text_post = "Recent Posts";
				} ?>
				<td>
					<input type="text" name="p_p_lbl_text_post" id="p_p_lbl_text_post" value="<?php echo esc_attr($p_p_lbl_text_post); ?>" />
					<a href="#" id="w6" data-tooltip="#q6"><span class="dashicons dashicons-info info_info"></span></a>
				</td>
			</tr>

			<tr>
				<th><label><?php _e('Font size', 'WL_R_P_R_P'); ?></label></th>
				<td>
					<input type="range" min="12" max="32" step="1" value="<?php if (!isset($p_p_lbl_text_font)) {
																				echo  esc_attr($p_p_lbl_text_font = "20");
																			} else {
																				echo esc_attr($p_p_lbl_text_font);
																			} ?>" data-orientation="vertical" id="p_p_lbl_text_font" name="p_p_lbl_text_font" oninput="outputUpdate(value);" />
					<span id="p_p_lbl_text_font" name="p_p_lbl_text_font" class="font_size rang_span_style "><?php echo esc_attr($p_p_lbl_text_font); ?></span>
					<a href="#" id="w7" data-tooltip="#q7"><span class="dashicons dashicons-info info_info"></span></a>
				</td>
			</tr>
			<tr>
				<th><label><?php _e('Background Color', 'WL_R_P_R_P'); ?> </label> </th>
				<td>
					<input type="text" class="my-color-picker" id="p_p_bg_color" name="p_p_bg_color" value="<?php if (!isset($p_p_bg_color)) {
																												echo esc_attr($p_p_bg_color = "#dd3333");
																											} else {
																												echo esc_attr($p_p_bg_color);
																											} ?>" />
					<a href="#" id="w8" data-tooltip="#q8"><span class="dashicons dashicons-info info_info"></span></a>
				</td>

			</tr>
			<tr>
				<th><label><?php _e('Font Color', 'WL_R_P_R_P'); ?></label></th>
				<td>
					<input class="my-color-picker" id="p_p_color" name="p_p_color" type="text" value="<?php if (!isset($p_p_color)) {
																											echo esc_attr($p_p_color = "#ffffff");
																										} else {
																											echo esc_attr($p_p_color);
																										} ?>">
					<a href="#" id="w9" data-tooltip="#q9"><span class="dashicons dashicons-info info_info"></span></a>
				</td>
			</tr>
			<tr>
				<th><label><?php _e('Font Family', 'WL_R_P_R_P'); ?></label></th>
				<td> <?php if (!isset($P_P_PGPP_Font_Style)) {
							$P_P_PGPP_Font_Style = "Open Sans";
						} ?>
					<select name="P_P_PGPP_Font_Style" id="P_P_PGPP_Font_Style" class="standard-dropdown">
						<optgroup label="Default Fonts">
							<option value="Arial Black" <?php selected($P_P_PGPP_Font_Style, 'Arial Black'); ?>>Arial Black</option>
							<option value="Courier New" <?php selected($P_P_PGPP_Font_Style, 'Courier New'); ?>>Courier New</option>
							<option value="cursive" <?php selected($P_P_PGPP_Font_Style, 'cursive'); ?>>Cursive</option>
							<option value="fantasy" <?php selected($P_P_PGPP_Font_Style, 'fantasy'); ?>>Fantasy</option>
							<option value="Georgia" <?php selected($P_P_PGPP_Font_Style, 'Georgia'); ?>>Georgia</option>
							<option value="Grande" <?php selected($P_P_PGPP_Font_Style, 'Grande'); ?>>Grande</option>
							<option value="Helvetica Neue" <?php selected($P_P_PGPP_Font_Style, 'Helvetica Neue'); ?>>Helvetica Neue</option>
							<option value="Impact" <?php selected($P_P_PGPP_Font_Style, 'Impact'); ?>>Impact</option>
							<option value="Lucida" <?php selected($P_P_PGPP_Font_Style, 'Lucida'); ?>>Lucida</option>
							<option value="Lucida Console" <?php selected($P_P_PGPP_Font_Style, 'Lucida Console'); ?>>Lucida Console</option>
							<option value="monospace" <?php selected($P_P_PGPP_Font_Style, 'monospace'); ?>>Monospace</option>
							<option value="Open Sans" <?php selected($P_P_PGPP_Font_Style, 'Open Sans'); ?>>Open Sans</option>
							<option value="Palatino" <?php selected($P_P_PGPP_Font_Style, 'Palatino'); ?>>Palatino</option>
							<option value="sans" <?php selected($P_P_PGPP_Font_Style, 'sans'); ?>>Sans</option>
							<option value="sans-serif" <?php selected($P_P_PGPP_Font_Style, 'sans-serif'); ?>>Sans-Serif</option>
							<option value="Tahoma" <?php selected($P_P_PGPP_Font_Style, 'Tahoma'); ?>>Tahoma</option>
							<option value="Times New Roman" <?php selected($P_P_PGPP_Font_Style, 'Times New Roman'); ?>>Times New Roman</option>
							<option value="Trebuchet MS" <?php selected($P_P_PGPP_Font_Style, 'Trebuchet MS'); ?>>Trebuchet MS</option>
							<option value="Verdana" <?php selected($P_P_PGPP_Font_Style, 'Verdana'); ?>>Verdana</option>
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
										<option value="<?php echo $font_name; ?>" <?php selected($P_P_PGPP_Font_Style, $font_name); ?>><?php echo $font_name; ?></option><?php
																																										}
																																									} else {
																																										echo "<option disabled>Error to fetch Google fonts.</option>";
																																										echo "<option disabled>Google font will not available in offline mode.</option>";
																																									}
																																								}
																																											?>
						</optgroup>
					</select>
					<a href="#" id="w10" data-tooltip="#q10"><span class="dashicons dashicons-info info_info"></span></a>
					<p class="description">
						<?php _e('Choose a caption font style.', 'WL_ABTM_TXT_DM') ?>
					</p>
				</td>
			</tr>
			</tr>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="save" id="save" class="button-primary" style="font-size: 18px;width:70%;">
				</td>
			</tr>

		</table>

	</form>
</div>