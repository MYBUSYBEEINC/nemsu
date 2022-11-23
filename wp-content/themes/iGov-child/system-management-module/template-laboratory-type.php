<?php //Template Name: System - Laboratory Type Management ?>

<?php acf_form_head(); get_header(); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="class-wrapper">
    <div class="class-container">

        <?php if(isset($_GET['delete']) || isset($_GET['deleted'])){
            if($_GET['delete']){
                wp_trash_post( $_GET['delete'] ); ?>
                <script>
                    window.location.href = "<?php echo site_url().'/system/laboratory-type-management/?deleted='.$_GET['delete']; ?>";
                </script>
            <?php } ?>

            <div id="alert-container">
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-trash" aria-hidden="true"></i> Laboratory Type has been successfully deleted.
                </div>
            </div>

        <?php } ?>



        <?php if(isset($_GET['submitted']) || isset($_GET['changeTitle'])){
            $getCurrentlySubmittedID;

            if($_GET['changeTitle']){
                query_posts( array( 
                    'post_type'         => 'laboratory_type_mgmt',
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
                    'post_title'   => get_field('laboratory_type', $getCurrentlySubmittedID),
                );

                wp_update_post( $data );
                ?>
                <script>
                    window.location.href = "<?php echo site_url().'/system/laboratory-type-management/?submitted='.$getCurrentlySubmittedID; ?>";
                </script>
            <?php } else {
                $getCurrentlySubmittedID = $_GET['submitted'];
            } ?>

            <div id="alert-container">
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! Laboratory Type has been successfully created.
                </div>
            </div>
        <?php } ?>
        

        
        <div class="bg-white padding-15 border-radius-5">
            <div class="page-title-container">
                <h4 class="card-title">Laboratory Type Management</h4>
            </div>

            <div class="action-btns" id="action-btns">
                <button class="addNewModal" data-toggle="modal" data-target="#addNewModal">Add New</button>
            </div>

            <table id="dept-details-mgmt">
                <thead>
                    <tr>
                        <th>Laboratory Type Code</th>
                        <th>Laboratory Type</th>
                        <th>Charge Code</th>
                        <th>Succeeding Laboratory Discount (%)</th>
                        <th>Charge Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    query_posts(array(
                    'post_type' => 'laboratory_type_mgmt',
                    'posts_per_page' => -1,
                    ));

                    if ( have_posts() ) : 
                        while ( have_posts() ) : the_post(); 
                            $cpost=get_the_ID(); 
                            $title=get_the_title($cpost); ?>

                            <tr>
                                <td><?php the_field('laboratory_type_code'); ?></td>
                                <td><?php the_field('laboratory_type'); ?></td>
                                <td><?php the_field('charge_code'); ?></td>
                                <td class="align-center"><?php the_field('succeeding_laboratory_discount'); ?></td>
                                <td><?php the_field('charge_description'); ?></td>
                                <td class="align-center">
                                    <?php
                                    if(get_field('status')){
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    }
                                    ?>
                                </td>
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
                                                    <h5 class="modal-title"><?php the_field('laboratory_type'); ?></h5>
                                                </div>
                                                <div class="modal-body">
                                                    <table>
                                                        <tr>
                                                            <td><strong>Laboratory Type Code</strong></td>
                                                            <td><?php the_field('laboratory_type_code'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Laboratory Type</strong></td>
                                                            <td><?php the_field('laboratory_type'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Charge Code</strong></td>
                                                            <td><?php the_field('charge_code'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Succeeding Laboratory Discount (%)</strong></td>
                                                            <td><?php the_field('succeeding_laboratory_discount'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Charge Description</strong></td>
                                                            <td><?php the_field('charge_description'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Default Charge Rate</strong></td>
                                                            <td><?php the_field('default_charge_rate'); ?></td>
                                                        </tr>
                                                        <tr>
                                                        	<td><strong>Status</strong></td>
                                                        	<td>
							                                    <?php
							                                    if(get_field('status')){
							                                        echo "Active";
							                                    } else {
							                                        echo "Inactive";
							                                    }
							                                    ?>
							                                </td>
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
                                                            <td><strong>Laboratory Type Code</strong></td>
                                                            <td><?php the_field('laboratory_type_code'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Laboratory Type</strong></td>
                                                            <td><?php the_field('laboratory_type'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Charge Code</strong></td>
                                                            <td><?php the_field('charge_code'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Succeeding Laboratory Discount (%)</strong></td>
                                                            <td><?php the_field('succeeding_laboratory_discount'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Charge Description</strong></td>
                                                            <td><?php the_field('charge_description'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Default Charge Rate</strong></td>
                                                            <td><?php the_field('default_charge_rate'); ?></td>
                                                        </tr>
                                                        <tr>
                                                        	<td><strong>Status</strong></td>
                                                        	<td>
							                                    <?php
							                                    if(get_field('status')){
							                                        echo "Active";
							                                    } else {
							                                        echo "Inactive";
							                                    }
							                                    ?>
							                                </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo site_url(); ?>/system/laboratory-type-management/?delete=<?php echo get_the_id(); ?>'">Confirm</button>
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
                <h5 class="modal-title">Create New Laboratory Type</h5>
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
                            'group_637dd8968879a',  // Laboratory Type
                            
                        ),
                        'new_post'      => array(
                            'post_title'    => $token,
                            'post_type'     => 'laboratory_type_mgmt',
                            'post_status'   => 'publish',
                        ),
                        'submit_value'  => 'Proceed',
                        'return' => '?submitted='.$token.'&changeTitle=y'
                    )); ?>
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