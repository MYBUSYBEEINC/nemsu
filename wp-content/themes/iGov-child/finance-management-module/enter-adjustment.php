<?php //Template Name: Finance - Enter Adjustment

// get_template_part('scripts.php');
acf_form_head();
get_header(); 
$title = "Enter Adjsutments";

?>
<title><?=$title?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
<style>
	
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 p-0 bg-white">
            <?php
                if (isset($_POST["btn-find-student"])) {
                    $input_adjustment_no = $_POST["adjustment-no"];
                    query_posts( array( 
                        'post_type' => 'student_information', 
                        'post_status' => array('publish'),
                        'posts_per_page' => 1,
                        'meta_query'     => array(
                            'relation' => 'AND',
                            array(
                                'key' => 'adjustment_no',
                                'value' => $input_adjustment_no,
                                'compare' => '==',
                            ),
                        )
                    ));
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                            // student name
                            // $student_photo = get_field('student_photo');
                            // $student_no  = get_field('student_no');
                            // $lname = get_field('last_name');
                            // $fname = get_field('first_name');
                            // $mname = get_field('middle_name');
                            // $suffix = get_field('suffix');
                            $adjustment_no = get_field('adjustment_no');
                            $account_no = get_field('account_no');
                            $studentType = get_field('student_type');
                            $accountName = get_field('account_name');
                            $adjDate = get_field('adjustment_date');
                            $adjtype = get_field('adjustment_type');
                            $course = get_field('course');
                            // $departmentG = get_field('department');
                            $schoolYear = get_field('school_year');
                            $yearLevel = get_field('year_level');
                            $remarks = get_field('remarks');
                        endwhile;
                    endif;
                }
            ?>

            <div class="container">
                <div class="fw-bold mt-5 mb-5"><h6><?=$title;?></h6></div>
                <div class="row mt-3 mb-3">
                    <div class="col-lg-4 col-md-12">
                        <h6><label>Adjustment No:</label></h6> 
                        <form method="post">
                            <input type="text" name="adjustment-no" class="form-control" value="<?php echo $adjustment_no ?>">     
                    </div>
                    <div class="col-lg-4">
                            <input type="submit" name="btn-find-student" class="mt-4 btn btn-sm" value="Find">
                        </form>   
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-lg-4 col-md-12">
                        <h6><label>Account No.:</label></h6> 
                        <input type="text" name="adjustment-no" class="form-control" value="<?=$account_no ?>" readonly>        
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <h6><label>Adjsutment Date:</label></h6>
                        <input type="text" class="form-control" value="<?=$adjDate?>" readonly>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <h6><label>Adjsutment Type:</label></h6>
                        <input type="text" class="form-control" value="<?=$adjtype?>" readonly>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-lg-4 col-md-12">
                        <h6><label>Account Name</label></h6>
                        <input type="text" class="form-control" value="<?=$accountName?>" readonly>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <h6><label>Course:</label></h6> 
                        <input type="text" name="adjustment-no" class="form-control" value="<?=$course?>" readonly>        
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-lg-4 col-md-12">
                        <h6><label>School Year:</label></h6>
                        <input type="text" class="form-control" value="<?=$schoolYear?>" readonly>
                    </div>
                    
                    <div class="col-lg-8 col-md-12">
                        <h6><label>Department</label></h6>
                        <input type="text" class="form-control" value="" readonly>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <h6><label>Remarks:</label></h6>
                        <textarea name="remarks"  class="form-control"  rows="3" readonly><?=$remarks?></textarea>
                    </div>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-lg-12 bg-white">
                        <table class="table mt-5" id="filter-enter-adjustment">
                            <thead>
                                <tr>
                                    <?php
                                        $titleHead = array(
                                            "Reference No", 
                                            "Particular", 
                                            "Balance", 
                                            "Adjustments Remarks",
                                            "Adj Amount"
                                        );

                                        foreach ($titleHead as $value) :?>
                                            <th scope='col' class='text-center'><?=$value?></th>
                                    <?php endforeach;?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class='text-center'></td>
                                    <td class='text-center'></td>
                                    <td class='text-center'></td>
                                    <td class='text-center'><?=$remarks?></td>
                                    <td class='text-center'></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div id="primary" class="content-area p-3">
    <div id="content" class="site-content" role="main">
        <?php 
            acf_form(
                array(
                    'post_id' => $post_id,
                    'post_title'   => false,
                    'post_content' => false,
                    'field_groups'  => array(
                        'group_637add98cce55'
                    ),
                    'updated_message' => __("", 'acf'),
                    'return' => add_query_arg(array('updated' => 'true'), get_permalink()),
                    'submit_value'  => __('Save'),
                )
            );
        ?>
    </div>
    
</div> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script>
    $(function() {
        var table = $("#filter-enter-adjustment").DataTable();

        // Date range vars
        minDateFilter = "";
        maxDateFilter = "";

        $("#date").daterangepicker();
        $("#date").on("apply.daterangepicker", function(ev, picker) {
        minDateFilter = Date.parse(picker.startDate);
        maxDateFilter = Date.parse(picker.endDate);
        
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var date = Date.parse(data[1]);

        if (
        (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
        (isNaN(minDateFilter) && date <= maxDateFilter) ||
        (minDateFilter <= date && isNaN(maxDateFilter)) ||
        (minDateFilter <= date && date <= maxDateFilter)
        ) {
        return true;
        }
        return false;
        });
        table.draw();
        }); 
        

    });
</script>



