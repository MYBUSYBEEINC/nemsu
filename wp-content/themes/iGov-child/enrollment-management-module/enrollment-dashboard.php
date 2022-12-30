<?php //Template Name: Enrollment Dashboard?>

<?php 
    acf_form_head();
    get_header(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>
    .card-nav {
        border-radius: 15px;
        min-height: 150px;
    }
    .card-nav h4, p {
        color: #fff;
    }
    .card-nav.card-red {
        background: #F64E60;
    }
    .card-nav.card-blue1 {
        background: #6993FF;
    }
    .card-nav.card-green {
        background: #1BC5BD;
    }
    .card-nav.card-blue2 {
        background: #3699FF;
    }
</style>

<div class="container-fluid">


    <div class="row">
        <div class="col-lg-3 col-6 mb-2">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/guidance-result/">
                <div class="card p-2 card-nav card-red">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/enrollment-management-module/images/guidance-result.png" alt="" width="50">
                    <h4 class="card-title mt-2 mb-0">Guidance Result</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/admission-to-college/">
                <div class="card p-2 card-nav card-blue1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/enrollment-management-module/images/admission-to-college.png" alt="" width="50">
                    <h4 class="card-title mt-2 mb-0">Admission to College</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/evaluate/">
                <div class="card p-2 card-nav card-green">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/enrollment-management-module/images/evaluate.png" alt="" width="50">
                    <h4 class="card-title mt-2 mb-0">Evaluate</h4>
                    <p class="card-text">Evaluate new students or transferees</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/photograph/">
                <div class="card p-2 card-nav card-blue2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/enrollment-management-module/images/user-photograph.png" alt="" width="50">
                    <h4 class="card-title mt-2 mb-0">Photograph</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet</p>
                </div>
            </a>
        </div>
    </div>
    
    <div class="card border-0 mt-3">
        <div class="card-body">
            <h4 class="card-title">Enrolled Students List School Year 2022-2023</h4>
            <p class="card-description text-secondary"> More than 1,000+ enrolled students </p>
            <div class="table-responsive">
                <table class="table table-hover" id="enrolled-students-table">
                    <thead>
                        <tr class="text-uppercase text-12">
                            <th>Student Number</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        query_posts([
                            'post_type' => 'student_information',
                            'posts_per_page' => -1,
                        ]);
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post(); 
                                $cpost = get_the_ID(); 
                                $title = get_the_title($cpost);
                    ?>
                        <tr>
                            <td>--</td>
                            <td><?php the_field('student_name'); ?></td>
                            <td><?php the_field('gender'); ?></td>
                            <td><?php the_field('class'); ?></td>
                            <td><?php the_field('section'); ?></td>
                            <td><?php the_field('email'); ?></td>
                        </tr>
                        
                    <?php endwhile; ?>
                    <?php endif; wp_reset_query(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    $(document).ready(function() {
        $('#enrolled-students-table').DataTable();
    });
</script>