<?php
defined( 'ABSPATH' ) or die();

class WL_IMP_Language {
	public static function load_translation() {
		load_plugin_textdomain( WL_IMP_DOMAIN, false, basename( WL_IMP_PLUGIN_DIR_PATH ) . '/languages' );
	}
}