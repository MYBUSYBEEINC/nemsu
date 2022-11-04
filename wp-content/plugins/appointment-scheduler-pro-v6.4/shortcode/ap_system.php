<?php
//shortcode file
add_shortcode('appointment','ap_system');
function ap_system($id) {
	ob_start();	
	include ("appointment.php");

	
	return ob_get_clean();
}
?>