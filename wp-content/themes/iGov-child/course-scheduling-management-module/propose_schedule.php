<?php //Template Name: Course Schedule Proposal?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php 

acf_form_head();
get_header(); ?>


<section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Propose Schedule</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Create Block Section</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Approve Schedule</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Plot Schedule</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Professor List</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                                        'post_type' 	=> 'course_schedule_pros',
                                                        'post_status'	=> 'publish',
                                                    ),
                                                    'submit_value'  => 'Done'
                                                ));
                                            } ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                
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
                                                function generateRandomStrings($length) {

                                                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                    $charactersLength = strlen($characters);
                                                    $randomString = '';
                                                    for ($i = 0; $i < $length; $i++) {
                                                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                                                    }
                                                    return $randomString;
                                                }
                                                $token = generateRandomStrings(15);
                                                
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
                                                    'submit_value'  => 'Done',
                                                
                                                    'return' => '?submitted=y'
                                                ));
                                            } ?>
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
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                EMPTY
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php get_footer(); ?>