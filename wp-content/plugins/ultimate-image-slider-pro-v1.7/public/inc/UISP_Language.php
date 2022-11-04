<?php
defined( 'ABSPATH' ) || die();

class UISP_Language {
	public static function load_translation() {
		load_plugin_textdomain( 'urisp', false, basename( UISP_PLUGIN_DIR_PATH ) . '/languages' );
	}
}
