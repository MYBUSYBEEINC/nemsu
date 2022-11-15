<?php acf_form_head(); get_header(); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="class-wrapper">
    <div class="class-container">

        <?php if(isset($_GET['submitted'])){ ?>
            <?php $getCurrentlySubmittedID = $_GET['edit']; ?>
            
            <div id="alert-container">
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! <strong><?php echo get_field('department', $getCurrentlySubmittedID); ?></strong> has been successfully edited.
                </div>
            </div>
        <?php } ?>

        <div class="bg-white padding-15 border-radius-5">
            <div class="page-title-container">
                <h4 class="card-title">Departments Details Management</h4>
            </div>

            <?php if(isset($_GET['edit'])) { ?>

                <div class="acf-container">
                    <?php
                    acf_form(array(
                        'post_id' => $$_GET['edit'],
                        'field_groups' => array(
                            'group_637334e64b342'  // Department
                        ) ,
                        $$_GET['edit'] => array(
                            'post_type' => 'department',
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
                        <td>Department Code</td>
                        <td><?php the_field("department_code"); ?></td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td><?php the_field("department"); ?></td>
                    </tr>
                    <tr>
                        <td>Head</td>
                        <td><?php the_field("department_head"); ?></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td><?php the_field("department_type"); ?></td>
                    </tr>
                    <tr>
                        <td>With Course Filter on Block Sectioning?</td>
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
                        <td>Status</td>
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

            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>