<?php //Template Name: Create Course Schedule Proposal?>
<?php acf_form_head(); get_header(); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="row" style="margin-left:20px !important;">
   
        <div style="width: 200px; ">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/course-schedule-proposal">
                <div class="card p-1 card-nav card-red">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/schedule.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Propose Schedule</p>
                    <p class="card-text"></p>
                </div>
            </a>
        </div>
        <div class="" style="width: 200px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/admission-to-college/">
                <div class="card p-1 card-nav card-blue1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/section.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Create Block Section</p>
                    <p class="card-text"></p>
                </div>
            </a>
        </div>
        <div class="" style="width: 200px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>">
                <div class="card p-1 card-nav card-green">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/approved.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Approve Schedule</p>
                    <p class="card-text"></p>
                </div>
            </a>
        </div>
        <div class="" style="width: 200px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>">
                <div class="card p-1 card-nav card-blue2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/plot.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Plot Schedule</p>
                    <p class="card-text"></p>
                </div>
            </a>
        </div>
        <div class="" style="width: 200px; margin-left:20px;">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>">
                <div class="card p-1 card-nav card-blue2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/course-scheduling-management-module/icon/finalize.png" alt="" width="50">
                    <p class="card-title mt-2 mb-0">Finalize Schedule</p>
                    <p class="card-text"></p>
                </div>
            </a>
        </div>
</div>

<br>

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="card border-0 col-lg-16">
                        <div class="card-body">
                            <div>
                                <h4 style="color:mediumblue;">
                                    <b>Schedule Proposal</b> 
                                </h4>
                            </div>
                            <?php if(isset($_GET['submitted'])){ ?>
                                <div class="thankyouBox">
                                    <h3 class="align-center">Course Schedule Proposal Save</h3>
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
                                        'group_636b60795a859',
                                    ),
                                    'new_post'		=> array(
                                        'post_title'    => $token,
                                        'post_type' 	=> '',
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
    </div>
<?php get_footer(); ?>