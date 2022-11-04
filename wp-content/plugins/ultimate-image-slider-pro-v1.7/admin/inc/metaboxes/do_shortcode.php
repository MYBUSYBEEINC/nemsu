<?php
defined( 'ABSPATH' ) || die();
?>

</p><?php esc_html_e( 'Use below code in your theme to display the slider', 'urisp' ); ?></p>
<input class="widefat" readonly="readonly" type="text" value="<?php echo '<?php echo do_shortcode( \'[UISP id=' . esc_attr( get_the_ID() ) . ']\' ); ?>'; ?>">
