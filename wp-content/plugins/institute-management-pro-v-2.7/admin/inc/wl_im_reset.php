<?php
defined( 'ABSPATH' ) || die();
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-refresh"></i> <?php _e( 'Reset Plugin', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can reset the plugin to its initial state.', WL_IMP_DOMAIN ); ?>
			</div>
			<!-- end main header content -->
		</div>
	</div>
	<!-- end - row 1 -->

	<!-- row 2 -->
	<div class="row">
		<div class="card col">
			<div class="card-body">
				<!-- card body content -->
				<div class="">
					<div class="ml-4 font-weight-bold h5"><?php _e( 'This will', WL_IMP_DOMAIN ); ?>:</div>
					<ul class="list-group list-group-flush text-danger font-weight-bold">
						<li class="list-group-item">* <?php _e( 'Remove all database tables created by institute plugin and recreate them.', WL_IMP_DOMAIN ); ?></li>
						<li class="list-group-item">* <?php _e( 'Remove all attachments (photo, signature, ID etc.) related to institute.', WL_IMP_DOMAIN ); ?></li>
						<li class="list-group-item">* <?php _e( "Remove all student user accounts.", WL_IMP_DOMAIN ); ?></li>
						<li class="list-group-item">* <?php _e( 'Reset all settings of institute.', WL_IMP_DOMAIN ); ?></li>
					</ul>
				</div>
				<div class="ml-4 mt-4">
					<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wl-im-reset-plugin-form" >
						<?php $nonce = wp_create_nonce( 'reset-plugin' ); ?>
		                <input type="hidden" name="reset-plugin" value="<?php echo $nonce; ?>">
		                <input type="hidden" name="action" value="wl-im-reset-plugin">
						<button type="submit" class="btn btn-lg btn-info text-white wl-im-reset-plugin-button" data-message="<?php _e( "Are you sure to reset the plugin?", WL_IMP_DOMAIN ); ?>"><?php _e( 'Reset Plugin', WL_IMP_DOMAIN ); ?></button>
					</form>
				</div>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
	<!-- end - row 2 -->
</div>