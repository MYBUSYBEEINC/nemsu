<?php //Template Name: Course Schedule Proposal?>
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
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/block-section/">
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
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/approve-schedule/">
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
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/finalize.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Professor List</p>
                 
                </div>
            </a>
        </div>
</div>

<a href="http://localhost/nemsu/home/course-schedule-proposal/create-course-schedule-proposal/">Add New AAAA</a>

<div class="class-wrapper">
    <div class="class-container">

        <?php if(isset($_GET['delete']) || isset($_GET['deleted'])){
            if($_GET['delete']){
                wp_trash_post( $_GET['delete'] ); ?>
                <script>
                    window.location.href = "<?php echo site_url().'/course-schedule-proposal/?deleted='.$_GET['delete']; ?>";
                </script>
            <?php } ?>

            <div id="alert-container">
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-trash" aria-hidden="true"></i> Course Schedule Proposal has been successfully deleted.
                </div>
            </div>

        <?php } ?>



        <?php if(isset($_GET['submitted']) || isset($_GET['changeTitle'])){
            $getCurrentlySubmittedID;

            if($_GET['changeTitle']){
                query_posts( array( 
                    'post_type'         => 'course_schedule_pros',
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
                    'post_title'   => get_field('course_schedule_pros', $getCurrentlySubmittedID),
                );

                wp_update_post( $data );
                ?>
                <script>
                    window.location.href = "<?php echo site_url().'/home/course-schedule-proposal/?submitted='.$getCurrentlySubmittedID; ?>";
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
                <h4 class="card-title">Proposal Schedule</h4>
            </div>
            

            <table id="dept-details-mgmt">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>School Year</th>
                        <th>Department</th>
                        <th>Subject Name</th>
                        <th>Subject Desc</th>
                        <th>Curriculum Year</th>
                        <th>Section</th>
                        <th>Year Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    query_posts(array(
                    'post_type' => 'course_schedule_pros',
                    'posts_per_page' => -1,
                    ));

                    if ( have_posts() ) : 
                        while ( have_posts() ) : the_post(); 
                            $cpost=get_the_ID(); 
                            $title=get_the_title($cpost); ?>

                            <tr>
                                <td><?php the_field('course'); ?></td>
                                <td><?php the_field('school_year'); ?></td>
                                <td><?php the_field('department'); ?></td>
                                <td ><?php the_field('subject_name'); ?></td>

                                <td><?php the_field('subject_desc'); ?></td>
                                <td><?php the_field('curriculum_year'); ?></td>
                                <td ><?php the_field('section'); ?></td>
                                <td ><?php the_field('year_level'); ?></td>
                               
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
                                                    <h5 class="modal-title"><?php the_field('course_schedule_pros'); ?></h5>
                                                </div>
                                                <div class="modal-body">
                                                    <table>
                                                    <tr>
                                                            <td><strong>Course</strong></td>
                                                            <td><?php the_field('course'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>School year</strong></td>
                                                            <td><?php the_field('school_year'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Department</strong></td>
                                                            <td><?php the_field('department'); ?></td>
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
                                                            <td><strong></strong></td>
                                                            <td><?php the_field(''); ?></td>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- <script>
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
</script> -->