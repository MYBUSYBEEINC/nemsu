<?php //Template Name: Course Schedule Proposal - Block Section ?>

<?php acf_form_head(); get_header(); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="row" style="margin-left:40px !important;">
   
        <div style="width: 160px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/course-schedule-proposal/">
                <div class="card p-1 card-nav card-red">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/schedule.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Propose Schedule</p>
                    
                </div>
            </a>
        </div>
        <div class="" style="width: 160px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/course-schedule-proposal/block-section/">
                <div class="card p-1 card-nav card-blue1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/section.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Block Section</p>
               
                </div>
            </a>
        </div>
        <div class="" style="width: 160px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>">
                <div class="card p-1 card-nav card-green">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/approved.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Approve Schedule</p>
                  
                </div>
            </a>
        </div>
        <div class="" style="width: 160px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>">
                <div class="card p-1 card-nav card-blue2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/plot.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Plot Schedule</p>
                   
                </div>
            </a>
        </div>
        <div class="" style="width: 160px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>">
                <div class="card p-1 card-nav card-blue2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/finalize.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Finalize Schedule</p>
                 
                </div>
            </a>
        </div>
        <div class="" style="width: 160px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>">
                <div class="card p-1 card-nav card-blue2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/teacher.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Professor List</p>
                 
                </div>
            </a>
        </div>
</div>


<div class="class-wrapper">
    <div class="class-container">

        <?php if(isset($_GET['delete']) || isset($_GET['deleted'])){
            if($_GET['delete']){
                wp_trash_post( $_GET['delete'] ); ?>
                <script>
                    window.location.href = "<?php echo site_url().'/home/course-schedule-proposal/block-section/?deleted='.$_GET['delete']; ?>";
                </script>
            <?php } ?>

            <div id="alert-container">
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-trash" aria-hidden="true"></i> Block Section has been successfully deleted.
                </div>
            </div>

        <?php } ?>



        <?php if(isset($_GET['submitted']) || isset($_GET['changeTitle'])){
            $getCurrentlySubmittedID;

            if($_GET['changeTitle']){
                query_posts( array( 
                    'post_type'         => 'create_block_section',
                    'posts_per_page'    => 1,
                    's'                 => $_GET['submitted']
                ));
                if ( have_posts() ) {
                    while ( have_posts() ) { the_post();
                        $getCurrentlySubmittedID = get_the_id();
                    }
                }
                wp_reset_query();

                $data = array(
                    'ID'           => $getCurrentlySubmittedID,
                    'post_title'   => get_field('create_block_section', $getCurrentlySubmittedID),
                );

                wp_update_post( $data );
                ?>
                <script>
                    window.location.href = "<?php echo site_url().'/course-schedule-proposal/block-section/?submitted='.$getCurrentlySubmittedID; ?>";
                </script>
            <?php } else {
                $getCurrentlySubmittedID = $_GET['submitted'];
            } ?>

            <div id="alert-container">
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! <strong><?php echo get_field('course_schedule_pros', $getCurrentlySubmittedID); ?></strong> has been successfully created.
                </div>
            </div>
        <?php } ?>
        <div class="bg-white padding-15 border-radius-5">
            <div class="page-title-container">
                <h4 class="card-title">Block Section</h4>
            </div>

            <div class="action-btns" id="action-btns">
                <button class="addNewModal" data-toggle="modal" data-target="#addNewModal">Add New</button>
            </div>

            <table id="dept-details-mgmt">
                <thead>
                    <tr>
                        <th>Section Code</th>
                        <th>Descriptions</th>
                        <th>School Year</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    query_posts(array(
                    'post_type' => 'create_block_section',
                    'posts_per_page' => -1,
                    ));

                    if ( have_posts() ) : 
                        while ( have_posts() ) : the_post(); 
                            $cpost=get_the_ID(); 
                            $title=get_the_title($cpost); ?>

                            <tr>
                                <td><?php the_field('section_code'); ?></td>
                                <td><?php the_field('section_desriptions'); ?></td>
                                <td><?php the_field('school_year'); ?></td>
                                <td><?php the_field('departments'); ?></td>
                                <td class="align-center">
                                    <?php
                                    if(get_field('active')){
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    }
                                    ?>
                                </td>
                                
                                <td class="actions">
                                    <div class="align-center">
                                        <a href="#" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i></a>
                                        <a href="<?php echo get_the_permalink().'/?edit='.get_the_id(); ?>"><i class="fas fa-edit"></i></a> 
                                        <a href="#" data-toggle="modal" data-target="#confirmationModal"><i class="fas fa-trash-alt"></i></a>
                                    </div>

                                    <div class="modal fade newModal" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?php the_field('department'); ?></h5>
                                                </div>
                                                <div class="modal-body">
                                                    <table>
                                                        <tr>
                                                            <td><strong>Department Code</strong></td>
                                                            <td><?php the_field('department_code'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Department</strong></td>
                                                            <td><?php the_field('department'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Head</strong></td>
                                                            <td><?php the_field('department_head'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Type</strong></td>
                                                            <td><?php the_field('department_type'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>With Course Filter on Block Sectioning?</strong></td>
                                                            <td>
                                                                <?php
                                                                if(get_field('with_course_filter_on_block_sectioning')){
                                                                    echo "Yes";
                                                                } else {
                                                                    echo "No";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Status</strong></td>
                                                            <td>
                                                                <?php
                                                                if(get_field('department_status')){
                                                                    echo "Active";
                                                                } else {
                                                                    echo "Inactive";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade newModal" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Are you sure you want to delete this entry?</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <table>
                                                        <tr>
                                                            <td><strong>Department Code</strong></td>
                                                            <td><?php the_field('department_code'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Department</strong></td>
                                                            <td><?php the_field('department'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Head</strong></td>
                                                            <td><?php the_field('department_head'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Type</strong></td>
                                                            <td><?php the_field('department_type'); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo site_url(); ?>/system/departments-details-management/?delete=<?php echo get_the_id(); ?>'">Confirm</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php endwhile; ?>
                    <?php endif; wp_reset_query(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<div class="modal fade newModal" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Department</h5>
            </div>
            <div class="modal-body">
                <div class="acf-container">
                    <?php function generateRandomString($length) {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        return $randomString;
                    }
                    $token = generateRandomString(15);
                    
                    acf_form(array(
                        'post_id'       => 'new_post',
                        'field_groups'  => array(
                            'group_63719f8da057d	',  // Create Block Section
                            
                        ),
                        'new_post'      => array(
                            'post_title'    => $token,
                            'post_type'     => 'create_block_section',
                            'post_status'   => 'publish',
                        ),
                        'submit_value'  => 'Proceed',
                        'return' => '?submitted='.$token.'&changeTitle=y'
                    )); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closePassModal">Close</button>
                <button type="button" class="btn btn-primary" onclick="showNextStep('submit')">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('#dept-details-mgmt').DataTable({
            "aaSorting": [],
            "columnDefs": [
                { "width": "120px", "targets": -1 },
                { "bSortable": false, "aTargets": [ -1 ] }
            ]
        });

        $("#dept-details-mgmt_filter.dataTables_filter").append($("#action-btns button"));
    });

    function showNextStep(thisStep) {
        if(thisStep == "submit"){
            jQuery(function($) {
                $(".acf-form-submit .acf-button")[0].click();
                $("#closePassModal").click();
            });
        }
    }
</script>