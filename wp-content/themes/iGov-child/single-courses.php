<?php acf_form_head(); get_header(); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="class-wrapper">
    <div class="class-container">

        <?php if(isset($_GET['submitted'])){ ?>
            <?php $getCurrentlySubmittedID = $_GET['edit']; ?>
            
            <div id="alert-container">
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! Course has been successfully edited.
                </div>
            </div>
        <?php } ?>

        <div class="bg-white padding-15 border-radius-5">
            <div class="page-title-container">
                <h4 class="card-title">Course Details Management</h4>
            </div>

            <?php if(isset($_GET['edit'])) { ?>

                <div class="acf-container">
                    <?php
                    acf_form(array(
                        'post_id' => $$_GET['edit'],
                        'field_groups' => array(
                            'group_637c8f1980b95',  // Course
                        ) ,
                        $$_GET['edit'] => array(
                            'post_type' => 'courses',
                            'post_status' => 'publish',
                        ) ,
                        'submit_value'  => 'Save',
                        'return' => '?edit='.$_GET['edit'].'&submitted=y'
                    ));
                    ?>
                </div>

            <?php } else { ?>

                <table class="sngl-info">
                    <tr>
                        <td><strong>Course Code</strong></td>
                        <td><?php the_field('course_code'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Course Description</strong></td>
                        <td><?php the_field('course_description'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Course Title</strong></td>
                        <td><?php the_field('course_title'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Course Major</strong></td>
                        <td><?php the_field('course_major'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Academic Level</strong></td>
                        <td><?php the_field('course_academic_level'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Department</strong></td>
                        <td><?php echo get_field('department', get_field('course_department')); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Supervising Agency</strong></td>
                        <td><?php echo get_field('supervising_agency', get_field('course_supervising_agency')); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Course Group</strong></td>
                        <td><?php echo get_field('course_group', get_field('course_course_group')); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Course Discipline</strong></td>
                        <td><?php echo get_field('course_discipline', get_field('course_course_discipline')); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Grade Equivalent Table</strong></td>
                        <td><?php echo get_field('course_grade_equivalent_table'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Normal Length</strong></td>
                        <td><?php echo get_field('course_normal_length'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Passing Grade</strong></td>
                        <td><?php echo get_field('course_passing_grade'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>
                            <?php
                            if(get_field('course_status')){
                                echo "Active";
                            } else {
                                echo "Inactive";
                            }
                            ?>
                        </td>
                    </tr>
                </table>

            <?php } ?>
        </div>
    </div>
</div>

<div class="clear"></div>

<?php get_footer(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>