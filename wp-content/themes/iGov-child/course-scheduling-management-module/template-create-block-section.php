<?php //Template Name: Block Section - Create Block Section?>
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
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/teacher.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Professor List</p>
                 
                </div>
            </a>
        </div>
</div>

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="card border-0 col-lg-16">
                        <div class="card-body">
                            <div>
                                <h4 style="color:mediumblue;">
                                    <b>Create Block Section</b> 
                                </h4>
                            </div>
                            <?php if(isset($_GET['submitted'])){ ?>
                                <div class="thankyouBox">
                                    <h3 class="align-center">Block Section Save</h3>
                                </div>
                            <?php } else { 
                                function generateRandomString($length) {

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
                                    'post_id'		=> 'new_post',
                                    'field_groups'  => array(
                                        'group_63719f8da057d',
                                    ),
                                    'new_post'		=> array(
                                        'post_title'    => $token,
                                        'post_type' 	=> 'create_block_section',
                                        'post_status'	=> 'publish',
                                    ),
                                    'submit_value'  => 'Done'
                                ));
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="card border-0 mt-3 col-lg-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>School ID</th>
                                    <th>Subject Name</th>
                                    <th>Subject Descriptions</th>
                                    <th>Max Student</th>
                                </tr>
                                <?php
                                query_posts(array(    
                                    'posts_per_page' => -1,
                                    'orderby' => 'DESC',
                                    'post_type' => array(
                                    'course_schedule_pros')));
                                if ( have_posts() ) :
                                while ( have_posts() ) : the_post();
                                ?>
                                <tr>
                                    <td><?php echo the_field('schedule_id');?></td>
                                    <td><?php echo the_field('subject_name');?></td>
                                    <td><?php echo the_field('subject_desc');?></td>
                                    <td><?php echo the_field('max_student');?></td>

                                </tr>
                                <?php
                                the_content();
                                endwhile; endif;
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>





    </div>
<?php get_footer(); ?>