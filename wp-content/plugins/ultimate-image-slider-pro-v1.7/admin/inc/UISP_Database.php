<?php
defined( 'ABSPATH' ) || die();

class UISP_Database {
	public static function deactivation() {
		delete_option( 'uisp-code' );
		delete_option( 'uisp-key' );
		delete_option( 'uisp-valid' );
		delete_option( 'uisp-cache' );
		delete_option( 'wl-urisp-updation-detail' );
	}
}
