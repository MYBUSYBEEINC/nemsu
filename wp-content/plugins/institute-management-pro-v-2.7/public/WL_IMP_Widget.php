<?php
defined( 'ABSPATH' ) or die();

require_once( 'inc/widgets/WL_IMP_Noticeboard_Widget.php' );

class WL_IMP_Widget {
	/* Register widgets */
	public static function register_widgets() {
  		register_widget( 'WL_IMP_Noticeboard_Widget' );
	}
}
?>