<?php
defined( 'ABSPATH' ) || die();

wp_enqueue_style( 'fancybox', UISP_PLUGIN_URL . 'assets/css/fancybox.min.css' );
wp_enqueue_script( 'jquery-fancybox', UISP_PLUGIN_URL . 'assets/js/jquery.fancybox.min.js', array( 'jquery' ), true, true );

wp_register_script( 'urisp-layout2', '' );
wp_enqueue_script( 'urisp-layout2' );

$layout2_settings = get_post_meta( $id, 'urisp_layout2_setting', true );

if ( is_array( $layout2_settings ) ) {
	if ( isset( $layout2_settings['custom_css'] ) && ! empty( $layout2_settings['custom_css'] ) ) {
		$l2_custom_css = $layout2_settings['custom_css'];
	}
	if ( isset( $layout2_settings['show_thumbnails'] ) ) {
		$l2_show_thumbnails = (bool) $layout2_settings['show_thumbnails'];
	}
	if ( isset( $layout2_settings['show_toolbar'] ) ) {
		$l2_show_toolbar = (bool) $layout2_settings['show_toolbar'];
	}
	if ( isset( $layout2_settings['show_infobar'] ) ) {
		$l2_show_infobar = (bool) $layout2_settings['show_infobar'];
	}
	if ( isset( $layout2_settings['arrows'] ) ) {
		$l2_arrows = (bool) $layout2_settings['arrows'];
	}
	if ( isset( $layout2_settings['title_color'] ) ) {
		$l2_title_color = $layout2_settings['title_color'];
	}
	if ( isset( $layout2_settings['title_link_color'] ) ) {
		$l2_title_link_color = $layout2_settings['title_link_color'];
	}
	if ( isset( $layout2_settings['desc_color'] ) ) {
		$l2_desc_color = $layout2_settings['desc_color'];
	}
	if ( isset( $layout2_settings['font_family'] ) ) {
		$l2_font_family = $layout2_settings['font_family'];
	}
	if ( isset( $layout2_settings['link_new_tab'] ) ) {
		$l2_link_new_tab = (bool) $layout2_settings['link_new_tab'];
	}

	if ( '#ffffff' !== $l2_title_color ) {
		$css = '.urisp-layout2-title-' . esc_attr( $id ) . ' { color: ' . sanitize_hex_color( $l2_title_color ) . '; } ';
		$l2_custom_css = $css . $l2_custom_css;
	}

	if ( '#1e73be' !== $l2_title_link_color ) {
		$css = '.urisp-layout2-title-' . esc_attr( $id ) . ' a { color: ' . sanitize_hex_color( $l2_title_link_color ) . ' !important; }';
		$l2_custom_css = $css . $l2_custom_css;
	}

	if ( '#ffffff' !== $l2_desc_color ) {
		$css = '.urisp-layout2-desc-' . esc_attr( $id ) . ' { color: ' . sanitize_hex_color( $l2_desc_color ) . '; } ';
		$l2_custom_css = $css . $l2_custom_css;
	}

	if ( '' !== $l2_font_family ) {
		$font = preg_replace( '/\+/', ' ', $l2_font_family );
		$font = explode( ' ', $font );
		$css = '.urisp-slider-' . esc_attr( $id ) . ' { font-family: ' . esc_attr( $font[0] ) . '; } ';
		$css .= '.urisp-layout2-title-' . esc_attr( $id ) . ' { font-family: ' . esc_attr( $font[0] ) . '; } ';
		$css .= '.urisp-layout2-title-' . esc_attr( $id ) . ' a { font-family: ' . esc_attr( $font[0] ) . '; } ';
		$css .= '.urisp-layout2-desc-' . esc_attr( $id ) . ' { font-family: ' . esc_attr( $font[0] ) . '; } ';
		$l2_custom_css = $css . $l2_custom_css;
	}

	if ( ! empty( $l2_custom_css ) ) {
		wp_register_style( 'urisp-layout2', '' );
		wp_enqueue_style( 'urisp-layout2' );
		wp_add_inline_style( 'urisp-layout2', $l2_custom_css );
	}

	if ( '' !== $l2_font_family ) {
		wp_enqueue_style( 'google_font_' . esc_attr( $l2_font_family ), esc_url( "https://fonts.googleapis.com/css?family=$l2_font_family"), false );
	}

	$js = '
	(function($) {
		"use strict";
		$(document).ready(function() {
			$("[data-fancybox=\'urisp-slider-' . esc_attr( $id ) . '\']").fancybox({
				thumbs: {
					autoStart: ' . ( (bool) $l2_show_thumbnails ? "true" : "false" ) . '
				},
				loop: true,
				protect: true,
				arrows: ' . ( (bool) $l2_arrows ? "true" : "false" ) . ',
				infobar: ' . ( (bool) $l2_show_infobar ? "true" : "false" ) . ',
				toolbar: ' . ( (bool) $l2_show_toolbar ? "true" : "false" ) . ',
			});
		});
	})(jQuery);';
	wp_add_inline_script( 'urisp-layout2', $js );
}
?>

<div class="urisp-layout urisp-layout2 urisp-slider-<?php echo esc_attr( $id ); ?>">
	<?php if ( $display_slide_title ) { ?>
	<h2 class="urisp-slider-title"><?php echo esc_html( get_the_title( $id ) ) ?></h2>
	<?php } ?>
	<div id="urisp-slider-<?php echo esc_attr( $id ); ?>">
	<?php
	if ( $l2_link_new_tab ) {
		$target_blank = ' target="_blank"';
	} else {
		$target_blank = '';
	}

	if ( is_array( $images ) && count( $images ) ) {
		foreach( $images as $key => $image ) {
			$caption = '';
			if ( ! empty( $image['link'] ) ) {
				$title = '<a class="urisp-layout2-link urisp-layout2-link-' . esc_attr( $id ) . '" href="' . esc_url( $image['link'] ) . '"' . $target_blank . '>';
				$title .= $image['title'];
				$title .= '</a>';
			} else {
				$title = $image['title'];
			}

			if ( ! empty( $title ) ) {
				$caption = '<span class="urisp-layout2-title urisp-layout2-title-' . esc_attr( $id ) . '">' . esc_attr( $title ) . '</span>';
			}
			if ( ! empty( $image['desc'] ) ) {
				$caption .= '<span class="urisp-layout2-desc urisp-layout2-desc-' . esc_attr( $id ) . '">' . esc_attr( $image['desc'] ) . '</span>';
			}
		?>
		<a data-fancybox="urisp-slider-<?php echo esc_attr( $id ); ?>" href="<?php echo esc_url( wp_get_attachment_url( $image['id'] ) ); ?>" data-caption="<?php echo esc_attr( $caption ); ?>">
			<img src="<?php echo esc_url( wp_get_attachment_image_url( $image['id'] ) ); ?>" alt="<?php echo esc_attr( $image['title'] ); ?>">
		</a>
		<?php
		}
	} ?>
	</div>
</div>
