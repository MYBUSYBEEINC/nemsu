<?php
defined( 'ABSPATH' ) || die();

wp_enqueue_style( 'slippry', UISP_PLUGIN_URL . 'assets/css/slippry.css' );
wp_enqueue_script( 'slippry', UISP_PLUGIN_URL . 'assets/js/slippry.min.js', array( 'jquery' ), true, true );

wp_register_script( 'urisp-layout3', '' );
wp_enqueue_script( 'urisp-layout3' );

$layout3_settings = get_post_meta( $id, 'urisp_layout3_setting', true );

if ( is_array( $layout3_settings ) ) {
	if ( isset( $layout3_settings['custom_css'] ) && ! empty( $layout3_settings['custom_css'] ) ) {
		$l3_custom_css = $layout3_settings['custom_css'];
	}

	if ( isset( $layout3_settings['autoplay'] ) ) {
		$l3_autoplay = (bool) $layout3_settings['autoplay'];
	}
	if ( isset( $layout3_settings['auto_hover'] ) ) {
		$l3_auto_hover = (bool) $layout3_settings['auto_hover'];
	}
	if ( isset( $layout3_settings['speed'] ) ) {
		$l3_speed = $layout3_settings['speed'];
	}
	if ( isset( $layout3_settings['pause'] ) ) {
		$l3_pause = $layout3_settings['pause'];
	}
	if ( isset( $layout3_settings['arrows'] ) ) {
		$l3_arrows = (bool) $layout3_settings['arrows'];
	}
	if ( isset( $layout3_settings['pager'] ) ) {
		$l3_pager = (bool) $layout3_settings['pager'];
	}
	if ( isset( $layout3_settings['transition'] ) ) {
		$l3_transition = $layout3_settings['transition'];
	}
	if ( isset( $layout3_settings['adaptive_height'] ) ) {
		$l3_adaptive_height = (bool) $layout3_settings['adaptive_height'];
	}
	if ( isset( $layout3_settings['max_height_fixed'] ) ) {
		$l3_max_height_fixed = $layout3_settings['max_height_fixed'];
	}
	if ( isset( $layout3_settings['title_color'] ) ) {
		$l3_title_color = $layout3_settings['title_color'];
	}
	if ( isset( $layout3_settings['title_link_color'] ) ) {
		$l3_title_link_color = $layout3_settings['title_link_color'];
	}
	if ( isset( $layout3_settings['desc_color'] ) ) {
		$l3_desc_color = $layout3_settings['desc_color'];
	}
	if ( isset( $layout3_settings['pager_background_color'] ) ) {
		$l3_pager_background_color = $layout3_settings['pager_background_color'];
	}
	if ( isset( $layout3_settings['caption_background_color'] ) ) {
		$l3_caption_background_color = $layout3_settings['caption_background_color'];
	}
	if ( isset( $layout3_settings['caption_background_opacity'] ) ) {
		$l3_caption_background_opacity = $layout3_settings['caption_background_opacity'];
	}
	if ( isset( $layout3_settings['title_font_size'] ) ) {
		$l3_title_font_size = $layout3_settings['title_font_size'];
	}
	if ( isset( $layout3_settings['text_font_size'] ) ) {
		$l3_text_font_size = $layout3_settings['text_font_size'];
	}
	if ( isset( $layout3_settings['title_align'] ) ) {
		$l3_title_align = $layout3_settings['title_align'];
	}
	if ( isset( $layout3_settings['text_align'] ) ) {
		$l3_text_align = $layout3_settings['text_align'];
	}
	if ( isset( $layout3_settings['font_family'] ) ) {
		$l3_font_family = $layout3_settings['font_family'];
	}
	if ( isset( $layout3_settings['link_new_tab'] ) ) {
		$l3_link_new_tab = (bool) $layout3_settings['link_new_tab'];
	}

	if ( (bool) $l3_max_height_fixed ) {
		$css = '#urisp-slider-' . esc_attr( $id ) . ' .sy-slide img' . ' { max-height: ' . $l3_max_height_fixed . 'px; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( '#ffffff' !== $l3_title_color ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .urisp-layout3-title-' . esc_attr( $id ) . ' { color: ' . sanitize_hex_color( $l3_title_color ) . '; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( '#e24b70' !== $l3_title_link_color ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .urisp-layout3-title-' . esc_attr( $id ) . ' a { color: ' . sanitize_hex_color( $l3_title_link_color ) . ' !important; }';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( '#ffffff' !== $l3_desc_color ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .urisp-layout3-desc-' . esc_attr( $id ) . ' { color: ' . sanitize_hex_color( $l3_desc_color ) . '; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( '#e24b70' !== $l3_pager_background_color ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .sy-pager li.sy-active a' . ' { background-color: ' . sanitize_hex_color( $l3_pager_background_color ) . '; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( '#000000' !== $l3_caption_background_color ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .sy-caption-wrap .sy-caption' . ' { background-color: ' . sanitize_hex_color( $l3_caption_background_color ) . '; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( '0.5' !== $l3_caption_background_opacity ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .sy-caption-wrap .sy-caption' . ' { opacity: ' . (float) $l3_caption_background_opacity . '; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( 18 !== $l3_title_font_size ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .urisp-layout3-title' . ' { font-size: ' . $l3_title_font_size . 'px; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( 14 !== $l3_text_font_size ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .urisp-layout3-desc' . ' { font-size: ' . $l3_text_font_size . 'px; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( 'left' !== $l3_title_align ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .urisp-layout3-title' . ' { text-align: ' . $l3_title_align . '; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( 'left' !== $l3_text_align ) {
		$css = '.urisp-slider-' . esc_attr( $id ) . ' .urisp-layout3-desc' . ' { text-align: ' . $l3_text_align . '; } ';
		$l3_custom_css = $css . $l3_custom_css;
	}

	if ( ! empty( $l3_custom_css ) ) {
		wp_register_style( 'urisp-layout3', '' );
		wp_enqueue_style( 'urisp-layout3' );
		wp_add_inline_style( 'urisp-layout3', $l3_custom_css );
	}

	if ( '' !== $l3_font_family ) {
		wp_enqueue_style( 'google_font_' . esc_attr( $l3_font_family ), esc_url( "https://fonts.googleapis.com/css?family=$l3_font_family"), false );
	}

	$js = '
	(function($) {
		"use strict";
		$(document).ready(function() {

			var font = "' . esc_attr( $l3_font_family ) . '";
			if("" !== font) {
				font = font.replace(/\+/g, " ");
				font = font.split(":");
				$(".urisp-slider-' . esc_attr( $id ) . '").css("font-family", font[0]);
			}

			$("#urisp-slider-' . esc_attr( $id ) . '").slippry({
				adaptiveHeight: ' . ( (bool) $l3_adaptive_height ? "true" : "false" ) . ',
				loop: true,
				preload: "visible",
				pager: ' . ( (bool) $l3_pager ? "true" : "false" ) . ',
				controls: ' . ( (bool) $l3_arrows ? "true" : "false" ) . ',
				transition: ' . ( (bool) $l3_transition ? '"'. esc_attr( $l3_transition ) . '"' : "false" ) . ',
				slideMargin: 0,
				speed: ' . abs( $l3_speed ) . ',
				easing: "swing",
				auto: ' . ( (bool) $l3_autoplay ? "true" : "false" ) . ',
				autoHover: ' . ( (bool) $l3_auto_hover ? "true" : "false" ) . ',
				autoHoverDelay: 100,
				autoDelay: 500,
				pause: ' . abs( $l3_pause ) . '
			});
		});
	})(jQuery);';
	wp_add_inline_script( 'urisp-layout3', $js );
}
?>

<div class="urisp-layout urisp-layout3 urisp-slider-<?php echo esc_attr( $id ); ?>">
	<?php if ( $display_slide_title ) { ?>
	<h2 class="urisp-slider-title"><?php echo esc_html( get_the_title( $id ) ) ?></h2>
	<?php } ?>
	<ul class="" id="urisp-slider-<?php echo esc_attr( $id ); ?>">
		<?php
		if ( $l3_link_new_tab ) {
			$target_blank = ' target="_blank"';
		} else {
			$target_blank = '';
		}

		if ( is_array( $images ) && count( $images ) ) {
			foreach( $images as $key => $image ) {
				$caption = '';
				if ( ! empty( $image['link'] ) ) {
					$title = '<a class="urisp-layout3-link urisp-layout3-link-' . esc_attr( $id ) . '" href="' . esc_url( $image['link'] ) . '"' . $target_blank . '>';
					$title .= $image['title'];
					$title .= '</a>';
				} else {
					$title = $image['title'];
				}

				if ( ! empty( $title ) ) {
					$caption = '<span class="urisp-layout3-title urisp-layout3-title-' . esc_attr( $id ) . '">' . esc_attr( $title ) . '</span>';
				}
				if ( ! empty( $image['desc'] ) ) {
					$caption .= '<span class="urisp-layout3-desc urisp-layout3-desc-' . esc_attr( $id ) . '">' . esc_attr( $image['desc'] ) . '</span>';
				}
			?>
			<li>
				<img src="<?php echo esc_url( wp_get_attachment_url( $image['id'] ) ); ?>" alt="<?php echo esc_attr( $caption ); ?>">
			</li>
			<?php
			}
		} ?>
	</ul>
</div>
