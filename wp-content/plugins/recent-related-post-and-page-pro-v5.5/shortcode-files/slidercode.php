<?php $a;?>
<style>
	slider_div_<?php echo $p_o_s_t.$a; ?>.vticker_<?php echo esc_attr($p_o_s_t).$a; ?>
	{
		border: 10px solid black;
		width: auto;
	}
	#up_<?php echo esc_attr($p_o_s_t)?>.carousel-control-up
	{
		position: absolute !important;
		top: 40% !important;
		left: 0px !important;
		font-size: <?php echo esc_attr($sliding_arrows_size); ?>px !important;
		color: <?php echo esc_attr($arrow_color)?> !important;
		border: none !important;
		text-decoration: none!important;

	}
	#down_<?php echo $p_o_s_t?>.carousel-control-down
	{
		left: auto;
		right: 0px !important;
		position: absolute !important;
		top:  40% !important;
		font-size: <?php echo esc_attr($sliding_arrows_size); ?>px !important;
		color: <?php echo esc_attr($arrow_color)?> !important;
		border: none !important;
		text-decoration: none!important;
	}
	a
	{
		box-shadow: 0 0px 0 0 currentColor !important;
	}
	a:focus
	{
		outline:none!important;;
	}
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery('.vticker_<?php echo esc_attr($p_o_s_t).$a;; ?>').easyTicker({
			direction: '<?php echo esc_attr($silder_direction) ?>',
			easing: 'linear',
			speed: '<?php if($slider_speed=="custom") { echo $slider_speed="slow";} else { echo $slider_speed; }; ?>',
			interval: <?php echo esc_attr($slider_speed_value);?>,
			height: 'auto',
			visible: <?php echo esc_attr($post_in_slide);?>,
			mousePause: '<?php echo esc_attr($pause_silder) ?>',
			controls: {
				up: '.upper_<?php echo esc_attr($p_o_s_t).$a;?>',
				down: '.downer_<?php echo esc_attr($p_o_s_t).$a;?>',
				toggle: '.toggle',
			}
		}).data('easyTicker');

	});
</script>