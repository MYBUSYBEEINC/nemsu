<?php
defined( 'ABSPATH' ) || die();

wp_enqueue_style( 'slider-pro', UISP_PLUGIN_URL . 'assets/css/slider-pro.min.css' );
wp_enqueue_script( 'jquery-slider-pro', UISP_PLUGIN_URL . 'assets/js/jquery.sliderPro.min.js', array( 'jquery' ), true, true );

wp_register_script( 'urisp-layout1', '' );
wp_enqueue_script( 'urisp-layout1' );

$layout1_settings = get_post_meta( $id, 'urisp_layout1_setting', true );

if ( is_array( $layout1_settings ) ) {
	if ( isset( $layout1_settings['custom_css'] ) && ! empty( $layout1_settings['custom_css'] ) ) {
		$l1_custom_css = $layout1_settings['custom_css'];
	}
	if ( isset( $layout1_settings['autoplay'] ) ) {
		$l1_autoplay = (bool) $layout1_settings['autoplay'];
	}
	if ( isset( $layout1_settings['autoplay_on_hover'] ) ) {
		$l1_autoplay_on_hover = $layout1_settings['autoplay_on_hover'];
	}
	if ( isset( $layout1_settings['autoplay_interval'] ) ) {
		$l1_autoplay_interval = $layout1_settings['autoplay_interval'];
	}
	if ( isset( $layout1_settings['full_screen'] ) ) {
		$l1_full_screen = (bool) $layout1_settings['full_screen'];
	}
	if ( isset( $layout1_settings['width_type'] ) ) {
		$l1_width_type = $layout1_settings['width_type'];
	}
	if ( isset( $layout1_settings['width_fixed'] ) ) {
		$l1_width_fixed = $layout1_settings['width_fixed'];
	}
	if ( isset( $layout1_settings['width_percentage'] ) ) {
		$l1_width_percentage = $layout1_settings['width_percentage'];
	}
	if ( isset( $layout1_settings['force_size'] ) ) {
		$l1_force_size = $layout1_settings['force_size'];
	}
	if ( isset( $layout1_settings['height_type'] ) ) {
		$l1_height_type = $layout1_settings['height_type'];
	}
	if ( isset( $layout1_settings['height_fixed'] ) ) {
		$l1_height_fixed = $layout1_settings['height_fixed'];
	}
	if ( isset( $layout1_settings['height_percentage'] ) ) {
		$l1_height_percentage = $layout1_settings['height_percentage'];
	}
	if ( isset( $layout1_settings['auto_height'] ) ) {
		$l1_auto_height = (bool) $layout1_settings['auto_height'];
	}
	if ( isset( $layout1_settings['fade'] ) ) {
		$l1_fade = (bool) $layout1_settings['fade'];
	}
	if ( isset( $layout1_settings['image_scale_mode'] ) ) {
		$l1_image_scale_mode = $layout1_settings['image_scale_mode'];
	}
	if ( isset( $layout1_settings['slide_distance'] ) ) {
		$l1_slide_distance = $layout1_settings['slide_distance'];
	}
	if ( isset( $layout1_settings['orientation'] ) ) {
		$l1_orientation = $layout1_settings['orientation'];
	}
	if ( isset( $layout1_settings['pagination'] ) ) {
		$l1_navigation = (bool) $layout1_settings['pagination'];
	}
	if ( isset( $layout1_settings['thumbnail_type'] ) ) {
		$l1_thumbnail_type = $layout1_settings['thumbnail_type'];
	}
	if ( isset( $layout1_settings['arrows'] ) ) {
		$l1_arrows = (bool) $layout1_settings['arrows'];
	}
	if ( isset( $layout1_settings['thumbnail_arrows'] ) ) {
		$l1_thumbnail_arrows = (bool) $layout1_settings['thumbnail_arrows'];
	}
	if ( isset( $layout1_settings['thumbnail_pointer'] ) ) {
		$l1_thumbnail_pointer = (bool) $layout1_settings['thumbnail_pointer'];
	}
	if ( isset( $layout1_settings['thumbnail_pointer_color'] ) ) {
		$l1_thumbnail_pointer_color = $layout1_settings['thumbnail_pointer_color'];
	}
	if ( isset( $layout1_settings['thumbnails_position'] ) ) {
		$l1_thumbnails_position = $layout1_settings['thumbnails_position'];
	}
	if ( isset( $layout1_settings['thumbnail_width'] ) ) {
		$l1_thumbnail_width = $layout1_settings['thumbnail_width'];
	}
	if ( isset( $layout1_settings['thumbnail_height'] ) ) {
		$l1_thumbnail_height = $layout1_settings['thumbnail_height'];
	}
	if ( isset( $layout1_settings['shuffle'] ) ) {
		$l1_shuffle = (bool) $layout1_settings['shuffle'];
	}
	if ( isset( $layout1_settings['title_link_color'] ) ) {
		$l1_title_link_color = $layout1_settings['title_link_color'];
	}
	if ( isset( $layout1_settings['layer_text_color'] ) ) {
		$l1_layer_text_color = $layout1_settings['layer_text_color'];
	}
	if ( isset( $layout1_settings['layer_background_color'] ) ) {
		$l1_layer_background_color = $layout1_settings['layer_background_color'];
	}
	if ( isset( $layout1_settings['layer_background_opacity'] ) ) {
		$l1_layer_background_opacity = $layout1_settings['layer_background_opacity'];
	}
	if ( isset( $layout1_settings['layer_title_font_size'] ) ) {
		$l1_layer_title_font_size = $layout1_settings['layer_title_font_size'];
	}
	if ( isset( $layout1_settings['layer_text_font_size'] ) ) {
		$l1_layer_text_font_size = $layout1_settings['layer_text_font_size'];
	}
	if ( isset( $layout1_settings['thumbnail_title_font_size'] ) ) {
		$l1_thumbnail_title_font_size = $layout1_settings['thumbnail_title_font_size'];
	}
	if ( isset( $layout1_settings['thumbnail_text_font_size'] ) ) {
		$l1_thumbnail_text_font_size = $layout1_settings['thumbnail_text_font_size'];
	}
	if ( isset( $layout1_settings['layer_text_align'] ) ) {
		$l1_layer_text_align = $layout1_settings['layer_text_align'];
	}
	if ( isset( $layout1_settings['title_layer_position'] ) ) {
		$l1_title_layer_position = $layout1_settings['title_layer_position'];
	}
	if ( isset( $layout1_settings['text_layer_position'] ) ) {
		$l1_text_layer_position = $layout1_settings['text_layer_position'];
	}
	if ( isset( $layout1_settings['font_family'] ) ) {
		$l1_font_family = $layout1_settings['font_family'];
	}
	if ( isset( $layout1_settings['full_screen'] ) ) {
		$l1_full_screen = (bool) $layout1_settings['full_screen'];
	}
	if ( isset( $layout1_settings['link_new_tab'] ) ) {
		$l1_link_new_tab = (bool) $layout1_settings['link_new_tab'];
	}
	if ( isset( $layout1_settings['show_thumbnails'] ) ) {
		$l1_show_thumbnails = (bool) $layout1_settings['show_thumbnails'];
	}

	if ( '#ff0000' !== $l1_thumbnail_pointer_color ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' .sp-bottom-thumbnails.sp-has-pointer .sp-selected-thumbnail:before { border-color: ' . sanitize_hex_color( $l1_thumbnail_pointer_color ) . '; } ' . '#urisp-slider-' . esc_attr( $id ) . ' .sp-bottom-thumbnails.sp-has-pointer .sp-selected-thumbnail:after { border-bottom-color: ' . sanitize_hex_color( $l1_thumbnail_pointer_color ) . '; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( '#ffffff' !== $l1_title_link_color ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' .urisp-title span a { color: ' . sanitize_hex_color( $l1_title_link_color ) . '; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( '#ffffff' !== $l1_layer_text_color ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' .urisp-title span { color: ' . sanitize_hex_color( $l1_layer_text_color ) . '; } ';
		$css .= '#urisp-slider-' . esc_attr( $id ) . ' .sp-slides .sp-black { color: ' . sanitize_hex_color( $l1_layer_text_color ) . '; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( ( '#000000' !== $l1_layer_background_color ) || ( '0.7' !== $l1_layer_background_opacity ) ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' .sp-slides .sp-black { background-color: ' . sanitize_hex_color( $l1_layer_background_color ) . '; opacity: ' . (float) $l1_layer_background_opacity . ' !important; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( 18 !== $l1_layer_title_font_size ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' .urisp-title span, #urisp-slider-' . esc_attr( $id ) . ' .urisp-title span a' . ' { font-size: ' . $l1_layer_title_font_size . 'px; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( 14 !== $l1_layer_text_font_size ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' p.urisp-desc.sp-layer { font-size: ' . $l1_layer_text_font_size . 'px; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( 18 !== $l1_thumbnail_title_font_size ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' .sp-thumbnail-title { font-size: ' . $l1_thumbnail_title_font_size . 'px; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( 14 !== $l1_thumbnail_text_font_size ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' .sp-thumbnail-description { font-size: ' . $l1_thumbnail_text_font_size . 'px; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( 'left' !== $l1_layer_text_align ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' p.sp-layer.sp-black.sp-padding.urisp-desc { text-align: ' . esc_attr( $l1_layer_text_align ) . '; } ';
		$l1_custom_css = $css . $l1_custom_css;
	}

	if ( ! empty( $l1_custom_css ) ) {
		wp_register_style( 'urisp-layout1', '' );
		wp_enqueue_style( 'urisp-layout1' );
		wp_add_inline_style( 'urisp-layout1', $l1_custom_css );
	}

	if ( '' !== $l1_font_family ) {
		wp_enqueue_style( 'google_font_' . esc_attr( $l1_font_family ), esc_url( "https://fonts.googleapis.com/css?family=$l1_font_family"), false );
	}

	$js = '
	(function($) {
		"use strict";
		$(document).ready(function() {

			var font = "' . esc_attr( $l1_font_family ) . '";
			if("" !== font) {
				font = font.replace(/\+/g, " ");
				font = font.split(":");
				$(".urisp-slider-' . esc_attr( $id ) . '").css("font-family", font[0]);
			}

			$("#urisp-slider-' . esc_attr( $id ) . '").sliderPro({
				fullScreen: ' . ( (bool) $l1_full_screen ? "true" : "false" ) . ',
				autoplay: ' . ( (bool) $l1_autoplay ? "true" : "false" ) . ',
				autoplayOnHover: "' . esc_attr( $l1_autoplay_on_hover ) . '",
				autoplayDelay: ' . abs( $l1_autoplay_interval ) . ',
				width: ' . ( ( 'fixed' === $l1_width_type ) ? esc_attr( $l1_width_fixed ) : '"' . esc_attr( $l1_width_percentage . '%' ) . '"' ) . ',
				height: ' . ( ( 'fixed' === $l1_height_type ) ? esc_attr( $l1_height_fixed ) : '"' . esc_attr( $l1_height_percentage . '%' ) . '"' ) . ',
				autoHeight: ' . ( (bool) $l1_auto_height ? "true" : "false" ) . ',
				arrows: ' . ( (bool) $l1_arrows ? "true" : "false" ) . ',
				fade: ' . ( (bool) $l1_fade ? "true" : "false" ) . ',
				fadeDuration: 500,
				imageScaleMode: "' . esc_attr( $l1_image_scale_mode ) . '",
				fadeArrows: true,
				buttons: ' . ( (bool) $l1_navigation? "true" : "false" ) . ',
				slideDistance: ' . abs( $l1_slide_distance ) . ',
				orientation: "' . esc_attr( $l1_orientation ) . '",
				shuffle: ' . ( (bool) $l1_shuffle ? "true" : "false" ) . ',
				slideAnimationDuration: 700,
				forceSize: "' . esc_attr( $l1_force_size ) . '",
				thumbnailsPosition: "' . esc_attr( $l1_thumbnails_position ) . '",
				thumbnailArrows: ' . ( (bool) $l1_thumbnail_arrows ? "true" : "false" ) . ',
				thumbnailPointer: ' . ( (bool) $l1_thumbnail_pointer ? "true" : "false" ) . ',
				thumbnailWidth: ' . esc_attr( $l1_thumbnail_width ) . ',
				thumbnailHeight: ' . esc_attr( $l1_thumbnail_height ) . '
			});
		});
	})(jQuery);';
	wp_add_inline_script( 'urisp-layout1', $js );
}
?>

<div class="urisp-layout urisp-layout1 urisp-slider-<?php echo esc_attr( $id ); ?>">
	<?php if ( $display_slide_title ) { ?>
	<h2 class="urisp-slider-title"><?php echo esc_html( get_the_title( $id ) ) ?></h2>
	<?php } ?>
	<div class="slider-pro" id="urisp-slider-<?php echo esc_attr( $id ); ?>">
		<div class="sp-slides">
		<?php if ( is_array( $images ) && count( $images ) ) { ?>

			<?php foreach( $images as $key => $image ) { ?>
			<div class="sp-slide">
				<img class="sp-image" src="<?php echo esc_url( UISP_PLUGIN_URL . 'assets/img/blank.gif' ); ?>" data-src="<?php echo esc_url( wp_get_attachment_url( $image['id'] ) ); ?>"/>

				<?php if ( ! empty( $image['title'] ) ) { ?>
				<div class="sp-layer sp-black sp-padding urisp-title" data-position="<?php echo esc_attr( $l1_title_layer_position ); ?>" data-show-transition="left" data-show-delay="300" data-hide-transition="right">
					<span>
						<?php if ( ! empty( $image['link'] ) ) { ?>
						<a class="sp-layer urisp-link" href="<?php echo esc_url( $image['link'] ); ?>" <?php if ( $l1_link_new_tab ) { echo 'target="_blank"'; } ?>>
						<?php } ?>
							<?php echo esc_html( $image['title'] ); ?>
						<?php if ( ! empty( $image['link'] ) ) { ?>
						</a>
						<?php } ?>
					</span>
				</div>
				<?php } ?>

				<?php if ( ! empty( $image['desc'] ) ) { ?>
				<p class="sp-layer sp-black sp-padding urisp-desc" data-position="<?php echo esc_attr( $l1_text_layer_position ); ?>" data-horizontal="center" data-show-transition="left" data-show-delay="300" data-hide-transition="right" data-width="100%">
					<?php echo wp_kses_post( $image['desc'] ); ?>
				</p>
				<?php } ?>
			</div>
			<?php } ?>

			<?php if ( $l1_show_thumbnails ) { ?>
			<div class="sp-thumbnails">

				<?php if ( 'text' === $l1_thumbnail_type ) { ?>
					<?php foreach( $images as $key => $image ) { ?>
				<div class="sp-thumbnail">
					<div class="sp-thumbnail-title"><?php echo esc_html( $image['title'] ); ?></div>
					<div class="sp-thumbnail-description"><?php echo wp_kses_post( $image['desc'] ); ?></div>
				</div>
					<?php } ?>
				<?php } else { ?>
					<?php foreach( $images as $key => $image ) { ?>
				<img class="sp-thumbnail" src="<?php echo esc_url( UISP_PLUGIN_URL . 'assets/img/blank.gif' ); ?>" data-src="<?php echo esc_url( wp_get_attachment_image_url( $image['id'] ) ); ?>"/>
					<?php } ?>
				<?php } ?>

			</div>
			<?php } ?>

		<?php } ?>
		</div>
	</div>
</div>
