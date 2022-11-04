<?php
defined( 'ABSPATH' ) || die();
require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

$data                      = WL_IMP_Helper::get_data();
$count                     = $data['count'];
$course_data               = $data['course_data'];
$recent_enquiries          = $data['recent_enquiries'];
$popular_courses_enquiries = $data['popular_courses_enquiries'];
$revenue                   = $data['revenue'];
?>

<div class="container-fluid wl_im_container">
	<!-- row 1 -->
	<div class="row">
		<div class="col">
			<!-- main header content -->
			<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-tachometer"></i> <?php _e( 'Dashboard', WL_IMP_DOMAIN ); ?></span></h1>
			<div class="mt-3 alert alert-info text-center" role="alert">
				<?php _e( 'Here, you can view statistics and reports.', WL_IMP_DOMAIN ); ?>
			</div>
			<!-- end main header content -->
		</div>
	</div>
	<!-- end - row 1 -->

	<!-- row 2 -->
	<div class="row">
		<div class="card col">
			<div class="card-header">
				<!-- card header content -->
				<div class="row">
					<div class="col-xs-12">
						<div class="h3"><?php _e( 'View Statistics and Reports', WL_IMP_DOMAIN ); ?></div>
					</div>
				</div>
				<!-- end - card header content -->
			</div>
			<div class="card-body">
				<!-- card body content -->
				<div class="row text-center">
					<?php
					if ( current_user_can( 'wl_im_manage_courses' ) ) { ?>
					<div class="col-md-3 col-sm-4 col-xs-2 mb-4">
						<ul class="list-group">
							<li class="list-group-item active h5"><i class="fa fa-graduation-cap"></i> 
								<a href="<?php menu_page_url( 'institute-management-pro-courses' ); ?>" class="text-white">
									<?php _e( 'Courses', WL_IMP_DOMAIN ); ?>
								</a>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Total Courses', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->courses; ?></span>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Active Courses', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->courses_active; ?></span>
							</li>
						</ul>
					</div>
					<?php
					}
					if ( current_user_can( 'wl_im_manage_batches' ) ) { ?>
					<div class="col-md-3 col-sm-4 col-xs-2 mb-4">
						<ul class="list-group">
							<li class="list-group-item active h5"><i class="fa fa-object-group"></i> 
								<a href="<?php menu_page_url( 'institute-management-pro-batches' ); ?>" class="text-white">
									<?php _e( 'Batches', WL_IMP_DOMAIN ); ?>
								</a>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Total Batches', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->batches; ?></span>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Active Batches', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->batches_active; ?></span>
							</li>
						</ul>
					</div>
					<?php
					}
					if ( current_user_can( 'wl_im_manage_enquiries' ) ) { ?>
					<div class="col-md-3 col-sm-4 col-xs-2 mb-4">
						<ul class="list-group">
							<li class="list-group-item active h5"><i class="fa fa-envelope"></i> 
								<a href="<?php menu_page_url( 'institute-management-pro-enquiries' ); ?>" class="text-white">
									<?php _e( 'Enquiries', WL_IMP_DOMAIN ); ?>
								</a>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Total Enquiries', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->enquiries; ?></span>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Active Enquiries', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->enquiries_active; ?></span>
							</li>
						</ul>
					</div>
					<?php
					}
					if ( current_user_can( 'wl_im_manage_students' ) ) { ?>
					<div class="col-md-3 col-sm-4 col-xs-2 mb-4">
						<ul class="list-group">
							<li class="list-group-item active h5"><i class="fa fa-users"></i> 
								<a href="<?php menu_page_url( 'institute-management-pro-students' ); ?>" class="text-white">
									<?php _e( 'Students', WL_IMP_DOMAIN ); ?>
								</a>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Total Students', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->students; ?></span>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Current Students', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->students_current; ?></span>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Former Students', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->students_former; ?></span>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Students Discontinued', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->students_discontinued; ?></span>
							</li>
						</ul>
					</div>
					<?php
					}
					if ( current_user_can( 'wl_im_manage_fees' ) ) { ?>
					<div class="col-md-3 col-sm-4 col-xs-2 mb-4">
						<ul class="list-group">
							<li class="list-group-item active h5"><i class="fa fa-usd"></i> 
								<a href="<?php menu_page_url( 'institute-management-pro-fees' ); ?>" class="text-white">
									<?php _e( 'Fees', WL_IMP_DOMAIN ); ?>
								</a>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Active Students with Fees Pending', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->students_fees_pending; ?></span>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Students with Fees Paid', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->students_fees_paid; ?></span>
							</li>
						</ul>
					</div>
					<?php
					}
					if ( current_user_can( 'wl_im_manage_fees' ) ) { ?>
					<div class="col-md-3 col-sm-4 col-xs-2 mb-4">
						<ul class="list-group">
							<li class="list-group-item active h5"><i class="fa fa-usd"></i> 
								<a href="<?php menu_page_url( 'institute-management-pro-fees' ); ?>" class="text-white">
									<?php _e( 'Installments', WL_IMP_DOMAIN ); ?>
								</a>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Total Installments', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $count->installments; ?></span>
							</li>
							<li class="list-group-item h6">
								<span class="text-secondary"><?php _e( 'Revenue', WL_IMP_DOMAIN ); ?>:</span>
								<span><?php echo $revenue; ?></span>
							</li>
						</ul>
					</div>
					<?php
					} ?>
				</div>
				<div class="row">
					<?php
					if ( current_user_can( 'wl_im_manage_enquiries' ) ) { ?>
					<div class="col bg-primary m-3 border-bottom border-primary">
						<div class="h5 mt-3 mb-3 text-white text-center"><i class="fa fa-envelope"></i> 
							<a href="<?php menu_page_url( 'institute-management-pro-enquiries' ); ?>" class="text-white">
								<?php _e( 'Recent Enquiries', WL_IMP_DOMAIN ); ?>
							</a>
						</div>
						<?php
						if ( count ( $recent_enquiries ) > 0 ) { ?>
						<ul class="list-group list-group-flush">
							<?php foreach( $recent_enquiries as $enquiry ) {
								$course = '-';
								if ( $enquiry->course_id && isset( $course_data[$enquiry->course_id] ) ) {
									$course_name = $course_data[$enquiry->course_id]->course_name;
									$course_code = $course_data[$enquiry->course_id]->course_code;
									$course      = "$course_name ($course_code)";
								}
							?>
							<li class="list-group-item align-items-center">
								<?php echo "<strong class='text-secondary'>" . WL_IMP_Helper::get_enquiry_id( $enquiry->id ) . "</strong> - <strong>" . $course . "</strong>"; ?>
								<span class="text-secondary float-right">
									<?php echo date_format( date_create( $enquiry->created_at ), "d-m-Y g:i A" ); ?>
								</span>
							</li>
							<?php
							} ?>
						</ul>
						<?php
						} else { ?>
							<div class="text-white text-center pb-3"><?php _e( 'There is no enquiry.', WL_IMP_DOMAIN ); ?></div>
						<?php
						} ?>
					</div>
					<?php
					}
					if ( current_user_can( 'wl_im_manage_courses' ) ) { ?>
					<div class="col bg-primary m-3 border-bottom border-primary">
						<div class="h5 mt-3 mb-3 text-white text-center"><i class="fa fa-graduation-cap"></i> 
							<a href="<?php menu_page_url( 'institute-management-pro-courses' ); ?>" class="text-white">
								<?php _e( 'Popular Courses', WL_IMP_DOMAIN ); ?>
							</a>
						</div>
						<?php
						$popular_courses_count = 0;
						if ( count ( $popular_courses_enquiries ) > 0 ) { ?>
						<ul class="list-group list-group-flush">
							<?php
							foreach( $popular_courses_enquiries as $enquiry ) {
								if ( $enquiry->course_id && isset( $course_data[$enquiry->course_id] ) ) {
									if ( $course_data[$enquiry->course_id]->is_deleted == 0 ) {
										$course_name = $course_data[$enquiry->course_id]->course_name;
										$course_code = $course_data[$enquiry->course_id]->course_code;
										$course      = "$course_name ($course_code)";
									?>
							<li class="list-group-item align-items-center">
								<?php echo "<strong>" . $course . "</strong>"; ?>
								<span class="text-secondary float-right">
									<?php echo $enquiry->students; ?> <?php echo ( $enquiry->students == 1 ) ? __( 'Student', WL_IMP_DOMAIN ) : __( 'Students', WL_IMP_DOMAIN ); ?>
								</span>
							</li>
									<?php
										$popular_courses_count++;
									}
								}
							?>
							<?php
							} ?>
						</ul>
						<?php
						} if ( $popular_courses_count == 0 ) { ?>
							<div class="text-white text-center pb-3"><?php _e( 'There is no popular course.', WL_IMP_DOMAIN ); ?></div>
						<?php
						} ?>
					</div>
					<?php
					} ?>
				</div>
				<!-- end - card body content -->
			</div>
		</div>
	</div>
	<!-- end - row 2 -->
</div>