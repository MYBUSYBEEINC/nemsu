 <?php if(is_front_page()){ ?>	
	<div class="breadcrumbs" style="text-align:left;">You are here: HOME</div>
	<?php }else{ ?>
	<div class="breadcrumbs">You are here: <?php wp_title( '|', true, 'right' ); ?></div> 
<?php } ?>