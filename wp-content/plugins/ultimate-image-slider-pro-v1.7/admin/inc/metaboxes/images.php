<?php
defined( 'ABSPATH' ) || die();

$post_id = $post->ID;

$images = get_post_meta( $post_id, 'urisp_image', true );

wp_nonce_field( 'save_slider_meta_' . $post_id, 'slider_meta_' . $post_id );
?>
<div id="urisp-container">
	<ul id="urisp-slider-images" class="clearfix">
	<?php
	if ( is_array( $images ) && count( $images ) ) {
		foreach( $images as $key => $image ) {
		?>
		<li class="urisp-image-entry">
			<input type="hidden" name="image[]" value="<?php echo esc_attr( $image['id'] ); ?>">
			<span class="urisp-remove-image-btn dashicons dashicons-no-alt"></span>
			<img src="<?php echo esc_url( wp_get_attachment_url( $image['id'] ) ); ?>" />
			<label><?php esc_html_e( 'Enter slide title', 'urisp' ); ?></label>
			<input type="text" name="image_title[]" placeholder="<?php esc_attr_e( 'Enter slide title', 'urisp' ); ?>" value="<?php echo esc_attr( $image['title'] ); ?>" />
			<label><?php esc_html_e( 'Enter slide title link', 'urisp' ); ?></label>
			<input type="text" name="image_link[]" placeholder="<?php esc_attr_e( 'Enter slide link', 'urisp' ); ?>" value="<?php echo esc_attr( isset( $image['link'] ) ? $image['link'] : '' ); ?>" />
			<label><?php esc_html_e( 'Enter slide description', 'urisp' ); ?></label>
			<textarea rows="4" class="urisp_textarea_<?php echo esc_attr( $image['id'] ); ?>" name="image_desc[]" placeholder="<?php esc_attr_e( 'Enter slide description', 'urisp' ); ?>"><?php echo wp_kses_post( $image['desc'] ); ?></textarea>
			<button type="button" data-id="<?php echo esc_attr( $image['id'] ); ?>" class="btn btn-sm btn-info btn-block urisp-rich-editor-btn" data-toggle="modal" data-target="#urisp-editor-modal">
				<?php esc_html_e( 'Use Rich Text Editor', 'urisp' ); ?> <span class="dashicons dashicons-admin-appearance"></span>
			</button>
		</li>
		<?php
		}
	}
	?>
	</ul>
</div>

<div class="urisp-action-container clearfix">
	<div class="urisp-image-entry add-urisp-image" id="urisp-upload-image-btn" data-title="<?php esc_attr_e( 'Upload Image', 'urisp' ); ?>" data-button-text="<?php esc_attr_e( 'Select', 'urisp' ); ?>" data-slide-title="<?php esc_attr_e( 'Enter slide title', 'urisp' ); ?>" data-slide-desc="<?php esc_attr_e( 'Enter slide description', 'urisp' ); ?>" data-slide-link="<?php esc_attr_e( 'Enter slide link', 'urisp' ); ?>" data-rich-editor="<?php esc_attr_e( 'Use Rich Text Editor', 'urisp' ); ?>">
		<div class="dashicons dashicons-plus"></div>
		<p><?php esc_html_e( 'Add New Slide', 'urisp' ); ?></p>
	</div>
	<div class="urisp-image-entry delete-urisp-image" id="urisp-delete-all-btn" data-message="<?php esc_attr_e( 'Are you sure to delete all the slides?', 'urisp' ); ?>">
		<div class="dashicons dashicons-trash"></div>
		<p><?php esc_html_e( 'Delete All Slides' , 'urisp' ); ?></p>
	</div>
</div>

<div class="modal fade" id="urisp-editor-modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php esc_attr_e( 'Rich Editor', 'urisp' ); ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>
					<?php
					$settings = array( 'media_buttons' => false ,'quicktags' => array( 'buttons' => 'strong,em,del,link,close' ) );
					wp_editor( '', 'fetch_wpeditor_data', $settings );
					?>
					<input type="hidden" value="" id="fetch_wpelement" name="fetch_wpelement" />
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary urisp-rich-editor-continue-btn" data-dismiss="modal"><?php esc_attr_e( 'Continue', 'urisp' ); ?></button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php esc_attr_e( 'Exit', 'urisp' ); ?></button>
			</div>
		</div>
	</div>
</div>
