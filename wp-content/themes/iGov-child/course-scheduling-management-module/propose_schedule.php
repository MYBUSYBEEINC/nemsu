<?php //Template Name: Course Schedule Proposal?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<style>
.acf-field[data-width] + .acf-field[data-width] {
    border: 0px !important;
}
</style>
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

                            <!--  -->
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

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Schedule Proposal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="card border-0 ">
                                                        <div class="card-body">
                                                            
                                                            <?php if(isset($_GET['submitted'])){ ?>
                                                                <div class="thankyouBox">
                                                                    <h3 class="align-center">Course Schedule Proposal Save</h3>
                                                                </div>
                                                            <?php } else { 
                                                                function generateRandomStringq($length) {

                                                                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                                    $charactersLength = strlen($characters);
                                                                    $randomString = '';
                                                                    for ($i = 0; $i < $length; $i++) {
                                                                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                                                                    }
                                                                    return $randomString;
                                                                }
                                                                $token = generateRandomStringq(15);
                                                                
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="createBlockSectionModal">Close</button>
                                                <button type="button" onclick="createBlockSectionModal('submit')" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card border-0 mt-3 col-lg-12">
                                        <div class="card-body">
                                            
                                            <button type="button" style="float: right; background-color:#1ED94D; border-radius:3%; border:0;" class="btn btn-primary ml-2" >
                                            Remove
                                            </button>
                                            <!-- Button trigger modal -->
                                            <button type="button" style="float: right; background-color:#1ED94D; border-radius:5%; border:0;" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Add
                                            </button>
                                            <!-- Modal -->
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

                            <!--  -->
                           
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="row">
                                    <div class="card border-0 col-lg-16">
                                        <div class="card-body">
                                            <div>
                                                <h4 style="color:mediumblue;">
                                                    <b>Approve Schedule</b> 
                                                </h4>
                                            </div>
                                            <?php if(isset($_GET['submitted'])){ ?>
                                                <div class="thankyouBox">
                                                    <h3 class="align-center">Block Section Save</h3>
                                                </div>
                                                
                                            <?php } else { 
                                                function generateRandomStringsssa($length) {

                                                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                    $charactersLength = strlen($characters);
                                                    $randomString = '';
                                                    for ($i = 0; $i < $length; $i++) {
                                                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                                                    }
                                                    return $randomString;
                                                }
                                                $token = generateRandomStringsssa(15);
                                                
                                                acf_form(array(
                                                    'post_id'		=> 'new_post',
                                                    'field_groups'  => array(
                                                        'group_63732fdcb280d',
                                                        
                                                    ),
                                                    'new_post'		=> array(
                                                        'post_title'    => $token,
                                                        'post_type' 	=> 'approve_schedule',
                                                        'post_status'	=> 'publish',
                                                    ),
                                                    'submit_value'  => 'Done',
                                                
                                                    'return' => '?submitted=y'
                                                ));
                                            } ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- <style>
                                    .acf-form-submit {
                                        display: none;
                                    }
                                </style> -->
                                <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="courseModalLabel">Add Schedule Proposal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="card border-0 ">
                                                        <div class="card-body">
                                                            
                                                            <?php if(isset($_GET['submitted'])){ ?>
                                                                <div class="thankyouBox">
                                                                    <h3 class="align-center">Course Schedule Proposal Save</h3>
                                                                </div>
                                                            <?php } else { 
                                                                function generateRandomStringqsd($length) {

                                                                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                                    $charactersLength = strlen($characters);
                                                                    $randomString = '';
                                                                    for ($i = 0; $i < $length; $i++) {
                                                                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                                                                    }
                                                                    return $randomString;
                                                                }
                                                                $token = generateRandomStringqsd(15);
                                                                
                                                                acf_form(array(
                                                                    'post_id'		=> 'new_post',
                                                                    'field_groups'  => array(
                                                                        'group_636b60795a859',
                                                                        
                                                                    ),
                                                                    'new_post'		=> array(
                                                                        'post_title'    => $token,
                                                                        'post_type' 	=> 'approve_schedule',
                                                                        'post_status'	=> 'publish',
                                                                    ),
                                                                    'submit_value'  => 'Done'
                                                                ));
                                                            } ?>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="approveSchedModal">Close</button>
                                                <button type="button" onclick="approveSchedModal('submit')" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card border-0 mt-3 col-lg-12">
                                        <div class="card-body">
                                            
                                            <button type="button" style="float: right; background-color:#1ED94D; border-radius:3%; border:0;" class="btn btn-primary ml-2" >
                                            Remove
                                            </button>
                                            <!-- Button trigger modal -->
                                            <button type="button"  style="float: right; background-color:#1ED94D; border-radius:5%; border:0;" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#courseModal">
                                            Add
                                            </button>
                                            <!-- Modal -->
                                            <div class="table-responsive">
                                                
                                                <table class="table">
                                                    <tr>
                                                        <th>School ID</th>
                                                        <th>Subject Name</th>
                                                        <th>Section</th>
                                                        <th>Course</th>
                                                        <th>Max Student</th>
                                                        <th>Update remarks</th>
                                                        <th>Select</th>
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
                                                        <td><?php echo the_field('section');?></td>
                                                        <td><?php echo the_field('course');?></td>
                                                        <td><?php echo the_field('max_student');?></td>
                                                        <td><?php echo the_field('remarks');?></td>
                                                        <td><input type="checkbox"></td>
                                                        

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
                        </div>
                    </div>
                </div>
            </div>
        </section>

<script>
function createBlockSectionModal(thisStep) {
    if(thisStep == "submit"){
            jQuery(function($) {
                $(".acf-form-submit .acf-button")[0].click();
                // $("#createBlockSectionModal").click();
            });
    }
}

function approveSchedModal(thisStep) {
    if(thisStep == "submit"){
            jQuery(function($) {
                $(".acf-form-submit .acf-button")[0].click();
                // $("#approveSchedModal").click();
            });
    }
}
</script>

<?php get_footer(); ?>