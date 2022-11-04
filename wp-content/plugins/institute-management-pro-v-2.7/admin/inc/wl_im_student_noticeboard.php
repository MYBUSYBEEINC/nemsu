<?php
defined( 'ABSPATH' ) || die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_StudentHelper.php' );
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_PaymentHelper.php' );

$student = WL_IMP_StudentHelper::get_student();
$notices = WL_IMP_StudentHelper::get_notices();

if ( ! $student ) {
	die();
}
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-tachometer"></i> <?php _e( 'Noticeboard Section', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can view all the notices.', WL_IMP_DOMAIN ); ?>
			</div>
			<!-- end main header content -->
		</div>
	</div>
	<!-- end - row 1 -->

	<!-- row 2 -->
	<div class="row">
		<div class="card col">
			<div class="card-header border-bottom-0 pb-0">
				<!-- card header content -->
				<div class="row">
					<div class="col-md-12 wlim-noticboard-background pt-2 pb-2">
						<div class="wlim-student-heading text-center display-4"><span class="text-white"><?php _e( 'Noticeboard', WL_IMP_DOMAIN ); ?></span></div>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body mt-0 pt-0">
				<!-- card body content -->
				<div class="row">
					<div class="card col-md-12 col-xs-12">
						<div class="card-body">
							<?php
							if( count( $notices ) > 0 ) { ?>
								<div class="wlim-noticeboard-all-section">
									<ul class="wlim-noticeboard-all">
									<?php
									foreach( $notices as $key => $notice ) {
										if( $notice->link_to == 'url' ) {
											$link_to = $notice->url;
										} elseif ( $notice->link_to == 'attachment' ) {
											$link_to = wp_get_attachment_url( $notice->attachment );
										} else {
											$link_to = '#';
										}
									?>
										<li class="mb-3"><span class="wlim-noticeboard-notice font-weight-bold">&#9656; </span>
											<a class="wlim-noticeboard-notice" target="_blank" href="<?php echo esc_url( $link_to ); ?>"><?php echo stripcslashes( $notice->title ); ?> (<?php echo date_format( date_create( $notice->created_at ), "d M, Y" ); ?>)</a>
										<?php
										if ( $key < 3 ) { ?>
											<img class="ml-1" src="<?php echo WL_IMP_PLUGIN_URL . 'assets/images/newicon.gif'; ?>">
										<?php
										} ?>
										</li>
									<?php
									} ?>
									</ul>
								</div>
								<div class="mt-4 mr-3 float-right"><a class="wlim-view-all-notice text-white" href="#"><?php _e( 'View all', WL_IMP_DOMAIN ); ?></a></div>
								<?php
							} else { ?>
								<span class="text-dark"><?php _e( 'There is no notice.', WL_IMP_DOMAIN ); ?></span>
							<?php
							} ?>
						</div>
					</div>
				</div>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
	<!-- end - row 2 -->
</div>
