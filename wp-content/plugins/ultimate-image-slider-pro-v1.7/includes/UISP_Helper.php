<?php
defined( 'ABSPATH' ) || die();

require_once UISP_PLUGIN_DIR_PATH . 'admin/inc/UISP_LM.php';

class UISP_Helper {
	public static function layer_background_opacity() {
		return array(
			'1'   => esc_html__( '1', 'urisp' ),
			'0.9' => esc_html__( '0.9', 'urisp' ),
			'0.8' => esc_html__( '0.8', 'urisp' ),
			'0.7' => esc_html__( '0.7', 'urisp' ),
			'0.6' => esc_html__( '0.6', 'urisp' ),
			'0.5' => esc_html__( '0.5', 'urisp' ),
			'0.4' => esc_html__( '0.4', 'urisp' ),
			'0.3' => esc_html__( '0.3', 'urisp' ),
			'0.2' => esc_html__( '0.2', 'urisp' ),
			'0.1' => esc_html__( '0.1', 'urisp' ),
		);
	}

	public static function width_height_ratio() {
		return array(
			'1'   => esc_html__( '1', 'urisp' ),
			'0.9' => esc_html__( '0.9', 'urisp' ),
			'0.8' => esc_html__( '0.8', 'urisp' ),
			'0.7' => esc_html__( '0.7', 'urisp' ),
			'0.6' => esc_html__( '0.6', 'urisp' ),
			'0.5' => esc_html__( '0.5', 'urisp' ),
			'0.4' => esc_html__( '0.4', 'urisp' ),
			'0.3' => esc_html__( '0.3', 'urisp' ),
			'0.2' => esc_html__( '0.2', 'urisp' ),
			'0.1' => esc_html__( '0.1', 'urisp' ),
		);
	}

	public static function lm_valid() {
		$uisp_lm     = UISP_LM::get_instance();
		$uisp_lm_val = $uisp_lm->is_valid();
		if ( isset( $uisp_lm_val ) && $uisp_lm_val ) {
			return true;
		}
		return false;
	}
}
