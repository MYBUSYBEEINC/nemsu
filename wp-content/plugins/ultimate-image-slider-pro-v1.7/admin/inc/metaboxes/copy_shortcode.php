<?php
defined( 'ABSPATH' ) || die();
?>

</p><?php esc_html_e( 'Copy below shortcode in any Page/Post to publish your slider', 'urisp' ); ?></p>
<input readonly="readonly" type="text" value="<?php echo '[UISP id=' . esc_attr( get_the_ID() ) . ']'; ?>">
