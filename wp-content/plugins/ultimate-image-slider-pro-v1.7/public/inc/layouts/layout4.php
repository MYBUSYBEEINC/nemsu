<?php
defined( 'ABSPATH' ) || die();

wp_enqueue_style( 'simplelightbox', UISP_PLUGIN_URL . 'assets/css/simplelightbox.min.css' );
wp_enqueue_script( 'simple-lightbox', UISP_PLUGIN_URL . 'assets/js/simple-lightbox.min.js', array( 'jquery' ), true, true );

wp_register_script( 'urisp-layout4', '' );
wp_enqueue_script( 'urisp-layout4' );

$layout4_settings = get_post_meta( $id, 'urisp_layout4_setting', true );

if ( is_array( $layout4_settings ) ) {
	if ( isset( $layout4_settings['custom_css'] ) && ! empty( $layout4_settings['custom_css'] ) ) {
		$l4_custom_css = $layout4_settings['custom_css'];
	}

	if ( isset( $layout4_settings['overlay'] ) ) {
		$l4_overlay = (bool) $layout4_settings['overlay'];
	}
	if ( isset( $layout4_settings['spinner'] ) ) {
		$l4_spinner = (bool) $layout4_settings['spinner'];
	}
	if ( isset( $layout4_settings['nav'] ) ) {
		$l4_nav = (bool) $layout4_settings['nav'];
	}
	if ( isset( $layout4_settings['swipe_close'] ) ) {
		$l4_close = (bool) $layout4_settings['swipe_close'];
	}
	if ( isset( $layout4_settings['swipe_close'] ) ) {
		$l4_swipe_close = (bool) $layout4_settings['swipe_close'];
	}
	if ( isset( $layout4_settings['doc_close'] ) ) {
		$l4_doc_close = (bool) $layout4_settings['doc_close'];
	}
	if ( isset( $layout4_settings['counter'] ) ) {
		$l4_counter = (bool) $layout4_settings['counter'];
	}
	if ( isset( $layout4_settings['preloading'] ) ) {
		$l4_preloading = (bool) $layout4_settings['preloading'];
	}
	if ( isset( $layout4_settings['keyboard'] ) ) {
		$l4_keyboard = (bool) $layout4_settings['keyboard'];
	}
	if ( isset( $layout4_settings['loop'] ) ) {
		$l4_loop = (bool) $layout4_settings['loop'];
	}
	if ( isset( $layout4_settings['width_ratio'] ) ) {
		$l4_width_ratio = $layout4_settings['width_ratio'];
	}
	if ( isset( $layout4_settings['height_ratio'] ) ) {
		$l4_height_ratio = $layout4_settings['height_ratio'];
	}
	if ( isset( $layout4_settings['scale_image_to_ratio'] ) ) {
		$l4_scale_image_to_ratio = (bool) $layout4_settings['scale_image_to_ratio'];
	}
	if ( isset( $layout4_settings['disable_right_click'] ) ) {
		$l4_disable_right_click = (bool) $layout4_settings['disable_right_click'];
	}
	if ( isset( $layout4_settings['double_tap_zoom'] ) ) {
		$l4_double_tap_zoom = $layout4_settings['double_tap_zoom'];
	}
	if ( isset( $layout4_settings['max_zoom'] ) ) {
		$l4_max_zoom = $layout4_settings['max_zoom'];
	}
	if ( isset( $layout4_settings['animation_slide'] ) ) {
		$l4_animation_slide = (bool) $layout4_settings['animation_slide'];
	}
	if ( isset( $layout4_settings['animation_speed'] ) ) {
		$l4_animation_speed = $layout4_settings['animation_speed'];
	}
	if ( isset( $layout4_settings['caption'] ) ) {
		$l4_caption = (bool) $layout4_settings['caption'];
	}
	if ( isset( $layout4_settings['caption_position'] ) ) {
		$l4_caption_position = $layout4_settings['caption_position'];
	}
	if ( isset( $layout4_settings['title_font_size'] ) ) {
		$l4_title_font_size = $layout4_settings['title_font_size'];
	}
	if ( isset( $layout4_settings['text_font_size'] ) ) {
		$l4_text_font_size = $layout4_settings['text_font_size'];
	}
	if ( isset( $layout4_settings['title_align'] ) ) {
		$l4_title_align = $layout4_settings['title_align'];
	}
	if ( isset( $layout4_settings['text_align'] ) ) {
		$l4_text_align = $layout4_settings['text_align'];
	}
	if ( isset( $layout4_settings['title_color'] ) ) {
		$l4_title_color = $layout4_settings['title_color'];
	}
	if ( isset( $layout4_settings['title_link_color'] ) ) {
		$l4_title_link_color = $layout4_settings['title_link_color'];
	}
	if ( isset( $layout4_settings['desc_color'] ) ) {
		$l4_desc_color = $layout4_settings['desc_color'];
	}
	if ( isset( $layout4_settings['caption_background_color'] ) ) {
		$l4_caption_background_color = $layout4_settings['caption_background_color'];
	}
	if ( isset( $layout4_settings['font_family'] ) ) {
		$l4_font_family = $layout4_settings['font_family'];
	}
	if ( isset( $layout4_settings['link_new_tab'] ) ) {
		$l4_link_new_tab = (bool) $layout4_settings['link_new_tab'];
	}

	if ( '' !== $l4_font_family ) {
		$font = preg_replace( '/\+/', ' ', $l4_font_family );
		$font = explode( ' ', $font );
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .urisp-slider-title { font-family: ' . esc_attr( $font[0] ) . '; } ';
		$css .= '.urisp-layout4-title-' . esc_attr( $id ) . ' { font-family: ' . esc_attr( $font[0] ) . '; } ';
		$css .= '.urisp-layout4-title-' . esc_attr( $id ) . ' a { font-family: ' . esc_attr( $font[0] ) . '; } ';
		$css .= '.urisp-layout4-desc-' . esc_attr( $id ) . ' { font-family: ' . esc_attr( $font[0] ) . '; } ';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( '#ffffff' !== $l4_title_color ) {
		$css = '.urisp-layout4-title-' . esc_attr( $id ) . ' { color: ' . sanitize_hex_color( $l4_title_color ) . '; } ';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( '#0274be' !== $l4_title_link_color ) {
		$css = '.urisp-layout4-title-' . esc_attr( $id ) . ' a { color: ' . sanitize_hex_color( $l4_title_link_color ) . ' !important; }';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( '#ffffff' !== $l4_desc_color ) {
		$css = '.urisp-layout4-desc-' . esc_attr( $id ) . ' { color: ' . sanitize_hex_color( $l4_desc_color ) . '; } ';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( '#000000' !== $l4_caption_background_color ) {
		$css = '.sl-wrapper .sl-image .sl-caption-' . esc_attr( $id ) . ' { background-color: ' . sanitize_hex_color( $l4_caption_background_color ) . '; opacity: 0.8; } ';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( 16 !== $l4_title_font_size ) {
		$css = '.urisp-layout4-title-' . esc_attr( $id ) . ' { font-size: ' . $l4_title_font_size . 'px; } ';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( 13 !== $l4_text_font_size ) {
		$css = '.urisp-layout4-desc-' . esc_attr( $id ) . ' { font-size: ' . $l4_text_font_size . 'px; } ';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( 'left' !== $l4_title_align ) {
		$css = '.urisp-layout4-title-' . esc_attr( $id ) . ' { text-align: ' . $l4_title_align . '; } ';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( 'left' !== $l4_text_align ) {
		$css = '.urisp-layout4-desc-' . esc_attr( $id ) . ' { text-align: ' . $l4_text_align . '; } ';
		$l4_custom_css = $css . $l4_custom_css;
	}

	if ( ! empty( $l4_custom_css ) ) {
		wp_register_style( 'urisp-layout4', '' );
		wp_enqueue_style( 'urisp-layout4' );
		wp_add_inline_style( 'urisp-layout4', $l4_custom_css );
	}

	if ( '' !== $l4_font_family ) {
		wp_enqueue_style( 'google_font_' . esc_attr( $l4_font_family ), esc_url( "https://fonts.googleapis.com/css?family=$l4_font_family"), false );
	}

	$js = '
	(function($) {
		"use strict";
		$(document).ready(function() {
			$("#urisp-slider-' . esc_attr( $id ) . ' a").simpleLightbox({
				sourceAttr: "href",
				overlay: ' . ( (bool) $l4_overlay ? "true" : "false" ) . ',
				spinner: ' . ( (bool) $l4_spinner ? "true" : "false" ) . ',
				nav: ' . ( (bool) $l4_nav ? "true" : "false" ) . ',
				navText: ["&larr;","&rarr;"],
				captions: ' . ( (bool) $l4_caption ? "true" : "false" ) . ',
				captionDelay: 0,
				captionSelector: "img",
				captionType: "attr",
				captionPosition: "' . esc_attr( $l4_caption_position ) . '",
				captionClass: "sl-caption-' . esc_attr( $id ) . '",
				captionsData: "title",
				close: ' . ( (bool) $l4_close ? "true" : "false" ) . ',
				closeText: "X",
				swipeClose: ' . ( (bool) $l4_swipe_close ? "true" : "false" ) . ',
				showCounter: ' . ( (bool) $l4_counter ? "true" : "false" ) . ',
				fileExt: "png|jpg|jpeg|gif",
				animationSlide: ' . ( (bool) $l4_animation_slide ? "true" : "false" ) . ',
				animationSpeed: ' . abs( $l4_animation_speed ) . ',
				preloading: ' . ( (bool) $l4_preloading ? "true" : "false" ) . ',
				enableKeyboard: ' . ( (bool) $l4_keyboard ? "true" : "false" ) . ',
				loop: ' . ( (bool) $l4_loop ? "true" : "false" ) . ',
				rel: false,
				docClose: ' . ( (bool) $l4_doc_close ? "true" : "false" ) . ',
				swipeTolerance: 50,
				className: "simple-lightbox",
				widthRatio: ' . (float) $l4_width_ratio . ',
				heightRatio: ' . (float) $l4_height_ratio . ',
				scaleImageToRatio: ' . ( (bool) $l4_scale_image_to_ratio ? "true" : "false" ) . ',
				disableRightClick: ' . ( (bool) $l4_disable_right_click ? "true" : "false" ) . ',
				alertError: true,
				alertErrorMessage: "' . esc_attr__( 'Image not found, next image will be loaded', 'urisp' ) . '",
				additionalHtml: false,
				history: true,
				throttleInterval: 0,
				doubleTapZoom: ' . abs( $l4_double_tap_zoom ) . ',
				maxZoom: ' . abs( $l4_max_zoom ) . '
			});
		});
	})(jQuery);';
	wp_add_inline_script( 'urisp-layout4', $js );
}
?>

<div class="urisp-layout urisp-layout4 urisp-slider-<?php echo esc_attr( $id ); ?>">
	<?php if ( $display_slide_title ) { ?>
	<h2 class="urisp-slider-title"><?php echo esc_html( get_the_title( $id ) ) ?></h2>
	<?php } ?>
	<div id="urisp-slider-<?php echo esc_attr( $id ); ?>">
	<?php
	if ( $l4_link_new_tab ) {
		$target_blank = ' target="_blank"';
	} else {
		$target_blank = '';
	}

	if ( is_array( $images ) && count( $images ) ) {
		foreach( $images as $key => $image ) {
			$caption = '';
			if ( ! empty( $image['link'] ) ) {
				$title = '<a class="urisp-layout4-link urisp-layout4-link-' . esc_attr( $id ) . '" href="' . esc_url( $image['link'] ) . '"' . $target_blank . '>';
				$title .= $image['title'];
				$title .= '</a>';
			} else {
				$title = $image['title'];
			}

			if ( ! empty( $title ) ) {
				$caption = '<span class="urisp-layout4-title urisp-layout4-title-' . esc_attr( $id ) . '">' . esc_attr( $title ) . '</span>';
			}
			if ( ! empty( $image['desc'] ) ) {
				$caption .= '<span class="urisp-layout4-desc urisp-layout4-desc-' . esc_attr( $id ) . '">' . esc_attr( $image['desc'] ) . '</span>';
			}
		?>
		<a href="<?php echo esc_url( wp_get_attachment_url( $image['id'] ) ); ?>" class="big">
			<img src="<?php echo esc_url( wp_get_attachment_image_url( $image['id'] ) ); ?>" alt="<?php echo esc_attr( $image['title'] ); ?>" title="<?php echo esc_attr( $caption ); ?>">
		</a>
		<?php
		}
	}
	?>
	</div>
</div>
