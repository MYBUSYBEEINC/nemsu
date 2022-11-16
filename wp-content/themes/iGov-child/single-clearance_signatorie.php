<?php acf_form_head(); get_header(); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="class-wrapper">
    <div class="class-container">

        <?php if(isset($_GET['submitted'])){ ?>
            <?php $getCurrentlySubmittedID = $_GET['edit']; ?>
            
            <div id="alert-container">
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! Clearance Signatory has been successfully edited.
                </div>
            </div>
        <?php } ?>

        <div class="bg-white padding-15 border-radius-5">
            <div class="page-title-container">
                <h4 class="card-title">Clearance Signatories Management</h4>
            </div>

            <?php if(isset($_GET['edit'])) { ?>

                <div class="acf-container">
                    <?php
                    acf_form(array(
                        'post_id' => $$_GET['edit'],
                        'field_groups' => array(
                            'group_637462c90c862'  // Clearance Signatories
                        ) ,
                        $$_GET['edit'] => array(
                            'post_type' => 'clearance_signatorie',
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
                        <td><strong>Position</strong></td>
                        <td><?php the_field('clearance_position'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><?php the_field('clearance_name'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>School Year</strong></td>
                        <td><?php the_field('clearance_school_year'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Department</strong></td>
                        <td><?php echo get_field('department', get_field('clearance_department')->ID); ?></td>
                    </tr>
                </table>

            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>