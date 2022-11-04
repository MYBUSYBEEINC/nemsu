<?php
defined( 'ABSPATH' ) or die();
require_once WL_IMP_PLUGIN_DIR_PATH . '/admin/WL_IMP_LM.php';
require_once WL_IMP_PLUGIN_DIR_PATH . '/admin/WL_IMP_LC_Menu.php';

add_action( 'admin_menu', array( 'WL_IMP_LC_Menu', 'create_menu' ) );
?>