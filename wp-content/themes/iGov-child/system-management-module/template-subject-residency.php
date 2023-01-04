<?php //Template Name: System - Subject Residency Charges Management ?>

<?php acf_form_head(); get_header(); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="class-wrapper">
    <div class="class-container">

        <?php if(isset($_GET['delete']) || isset($_GET['deleted'])){
            if($_GET['delete']){
                wp_trash_post( $_GET['delete'] ); ?>
                <script>
                    window.location.href = "<?php echo site_url().'/system/subject-residency-charges-management/?deleted='.$_GET['delete']; ?>";
                </script>
            <?php } ?>

            <div id="alert-container">
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-trash" aria-hidden="true"></i> Subject Residency has been successfully deleted.
                </div>
            </div>

        <?php } ?>

        <?php if(isset($_GET['submitted'])){
            $getCurrentlySubmittedID;
            query_posts( array( 
                'post_type'         => 'subject_residency',
                'posts_per_page'    => 1,
                's'                 => $_GET['submitted']
            ));
            if ( have_posts() ) {
                while ( have_posts() ) { the_post();
                    $getCurrentlySubmittedID = get_the_id();
                }
            }
            wp_reset_query();
            ?>

            <div id="alert-container">
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! Subject Residency has been successfully created.
                </div>
            </div>
        <?php } ?>
        

        
        <div class="bg-white padding-15 border-radius-5">
            <div class="page-title-container">
                <h4 class="card-title">Subject Residency Charges Management</h4>
            </div>

            <div class="action-btns" id="action-btns">
                <button class="addNewModal" data-toggle="modal" data-target="#addNewModal">Add New</button>
            </div>

            <table id="dept-details-mgmt">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Subject Description</th>
                        <th>Subject Group</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    query_posts(array(
                    'post_type' => 'subject_residency',
                    'posts_per_page' => -1,
                    ));

                    if ( have_posts() ) : 
                        while ( have_posts() ) : the_post(); 
                            $cpost=get_the_ID(); 
                            $title=get_the_title($cpost); ?>

                            <tr>
                                <td class="align-center"><?php the_field('subject_code'); ?></td>
                                <td class="align-center"><?php the_field('subject_name'); ?></td>
                                <td class="align-center"><?php the_field('subject_description'); ?></td>
                                <td class="align-center"><?php the_field('subject_group'); ?></td>
                                <td><?php echo get_field('department', get_field('subject_department')); ?></td>
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
                                                    <h5 class="modal-title">Subject Residency Details</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <table>
                                                        <tr>
                                                            <td><strong>Status</strong></td>
                                                            <td>
                                                                <?php
                                                                if(get_field('subject_status')){
                                                                    echo "Active";
                                                                } else {
                                                                    echo "Inactive";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Subject Code</strong></td>
                                                            <td><?php echo get_field('subject_code'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Subject Name</strong></td>
                                                            <td><?php echo get_field('subject_name'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Subject Description</strong></td>
                                                            <td><?php the_field('subject_description'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Subject Group</strong></td>
                                                            <td><?php the_field('subject_group'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Department</strong></td>
                                                            <td><?php echo get_field('department', get_field('subject_department')); ?></td>
                                                        </tr>
                                                    </table>

                                                    <div id="viewAccordion" class="accordion acf-field">
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                                                                <div class="acf-label">
                                                                    <label>Main Information</label>
                                                                </div>
                                                            </div>

                                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#viewAccordion">
                                                                <div class="card-body">
                                                                    <table>
                                                                        <tr>
                                                                            <td class="align-center td-head" colspan="4"><strong>Lecture</strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Lecture Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['lecture_units']; ?></td>
                                                                            <td><strong>Lecture Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['lecture_hours']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Pay Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['pay_units']; ?></td>
                                                                        </tr>
                                                                    </table>

                                                                    <table>
                                                                        <tr>
                                                                            <td class="align-center td-head" colspan="4"><strong>Laboratory</strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Laboratory Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['laboratory_units']; ?></td>
                                                                            <td><strong>Laboratory Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['laboratory_hours']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Required Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['required_hours']; ?></td>
                                                                            <td><strong>Credit Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['credit_units']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>With Affiliation Fee?</strong></td>
                                                                            <td>
                                                                                <?php
                                                                                if(get_field('subject_main_information')['with_affiliation_fee']){
                                                                                    echo "Yes";
                                                                                } else {
                                                                                    echo "No";
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                    </table>

                                                                    <table>
                                                                        <tr>
                                                                            <td class="align-center td-head" colspan="4"><strong>RLE/OJT</strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>RLE/OJT Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['rleojt_units']; ?></td>
                                                                            <td><strong>RLE/OJT Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['rleojt_hours']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Total RLE/OJT Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['total_rleojt_hours']; ?></td>
                                                                            <td><strong>Subject Fee</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['subject_fee']; ?></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
                                                                <div class="acf-label">
                                                                    <label>Pre-Requisite Subjects</label>
                                                                </div>
                                                            </div>
                                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#viewAccordion">
                                                                <div class="card-body">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">
                                                                <div class="acf-label">
                                                                    <label>Co-Requisite Subjects</label>
                                                                </div>
                                                            </div>
                                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#viewAccordion">
                                                                <div class="card-body">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                            <td><strong>Status</strong></td>
                                                            <td>
                                                                <?php
                                                                if(get_field('subject_status')){
                                                                    echo "Active";
                                                                } else {
                                                                    echo "Inactive";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Subject Code</strong></td>
                                                            <td><?php echo get_field('subject_code'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Subject Name</strong></td>
                                                            <td><?php echo get_field('subject_name'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Subject Description</strong></td>
                                                            <td><?php the_field('subject_description'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Subject Group</strong></td>
                                                            <td><?php the_field('subject_group'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Department</strong></td>
                                                            <td><?php echo get_field('department', get_field('subject_department')); ?></td>
                                                        </tr>
                                                    </table>

                                                    <div id="deleteAccordion" class="accordion acf-field">
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                                                                <div class="acf-label">
                                                                    <label>Main Information</label>
                                                                </div>
                                                            </div>

                                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#deleteAccordion">
                                                                <div class="card-body">
                                                                    <table>
                                                                        <tr>
                                                                            <td class="align-center td-head" colspan="4"><strong>Lecture</strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Lecture Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['lecture_units']; ?></td>
                                                                            <td><strong>Lecture Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['lecture_hours']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Pay Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['pay_units']; ?></td>
                                                                        </tr>
                                                                    </table>

                                                                    <table>
                                                                        <tr>
                                                                            <td class="align-center td-head" colspan="4"><strong>Laboratory</strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Laboratory Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['laboratory_units']; ?></td>
                                                                            <td><strong>Laboratory Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['laboratory_hours']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Required Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['required_hours']; ?></td>
                                                                            <td><strong>Credit Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['credit_units']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>With Affiliation Fee?</strong></td>
                                                                            <td>
                                                                                <?php
                                                                                if(get_field('subject_main_information')['with_affiliation_fee']){
                                                                                    echo "Yes";
                                                                                } else {
                                                                                    echo "No";
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                    </table>

                                                                    <table>
                                                                        <tr>
                                                                            <td class="align-center td-head" colspan="4"><strong>RLE/OJT</strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>RLE/OJT Units</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['rleojt_units']; ?></td>
                                                                            <td><strong>RLE/OJT Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['rleojt_hours']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Total RLE/OJT Hours</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['total_rleojt_hours']; ?></td>
                                                                            <td><strong>Subject Fee</strong></td>
                                                                            <td><?php echo get_field('subject_main_information')['subject_fee']; ?></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
                                                                <div class="acf-label">
                                                                    <label>Pre-Requisite Subjects</label>
                                                                </div>
                                                            </div>
                                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#deleteAccordion">
                                                                <div class="card-body">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">
                                                                <div class="acf-label">
                                                                    <label>Co-Requisite Subjects</label>
                                                                </div>
                                                            </div>
                                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#deleteAccordion">
                                                                <div class="card-body">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo site_url(); ?>/system/subject-residency-charges-management/?delete=<?php echo get_the_id(); ?>'">Confirm</button>
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
                <h5 class="modal-title">Create New Subject Residency</h5>
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
                            'group_63747d0ca536c',  // Dean's List Grading
                            
                        ),
                        'new_post'      => array(
                            'post_title'    => $token,
                            'post_type'     => 'subject_residency',
                            'post_status'   => 'publish',
                        ),
                        'submit_value'  => 'Proceed',
                        'return' => '?submitted='.$token
                    )); ?>


                    <div id="accordion" class="accordion acf-field">
                        <div class="card">
                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                                <div class="acf-label">
                                    <label>Main Information</label>
                                </div>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
                                <div class="acf-label">
                                    <label>Pre-Requisite Subjects</label>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">
                                <div class="acf-label">
                                    <label>Co-Requisite Subjects</label>
                                </div>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>
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

        $(".acf-field-63747dde07291").after($("#accordion"));
        $("#accordion #collapseOne .card-body").append($(".acf-field.acf-field-group.acf-field-637484259eb57"));
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