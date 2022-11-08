<?php
if( isset( $_GET['y'] ) ):
	$year = $_GET['y'];
else:
	$year = '';
endif;
if( isset( $_GET['month'] ) ):
	$month = $_GET['month'];
else:
	$month = '';
endif;
if( isset( $_GET['orderby'] ) ):
	$orderby = $_GET['orderby'];
else:
	$orderby = 'date';
endif;
if( isset( $_GET['id'] ) ):
	$post_id_name = $_GET['id'];
else:
	$post_id_name = '';
endif;

?>