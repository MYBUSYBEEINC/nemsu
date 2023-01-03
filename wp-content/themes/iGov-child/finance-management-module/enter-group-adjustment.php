<?php //Template Name: Finance - Enter Group Adjustment

// get_template_part('scripts.php');
acf_form_head();
get_header(); 
$title =  'Enter Group  Adjsutments';

?>
<title><?=$title?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
<style>td{text-align:center}
</style>

<div id="primary" class="content-area p-3">
    <div id="content" class="site-content" role="main">
        <h5 class="fw-bold"><?=$title?></h5>
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
    <div class="row">
        <div class="col-lg-12 bg-white">
            <table class="table mt-5 filter-base-date">
                <thead>
                    <tr>
                        <?php
                            $titleHead = array("Student No", 
                            "Student Name", 
                            "Adj Amount",
                            "Remarks");

                            foreach ($titleHead as $value) {
                                echo "<th scope='col' class='text-center text-capitalize'>$value</th>";
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                            query_posts(array(    
                                'posts_per_page' => -1,
                                'orderby' => 'DESC',
                                'post_type' => array(
                                'student_information')));
                            if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                // get_field('', $ID)['']
                                $lname = get_field('last_name');
                                $fname = get_field('first_name');
                                $mname = get_field('middle_name');
                                $suffix = get_field('suffix');
                                $fullName = "$fname $lname $mname $suffix";

                                

                                // $student_photo = get_field('student_photo');
                                    // $student_no  = get_field('student_no');
                                    // $title = get_field('title');
                                    // $postid= $_GET['post_id'];
                                    // //echo $email;
                                    //     $posts = get_posts(array(
                                    //     'posts_per_page'=> -1, 
                                    //     'p' => $postid, 
                                    // 'post_type'		=> 'student_information',
                                    // ));
                                    // if ( have_posts() ) : while ( have_posts() ) : the_post();
                                    // $cpost=get_the_ID();
                                    // // student name
                                    // $student_photo = get_field('student_photo');
                                    // $student_no  = get_field('student_no');
                                    // $title = get_field('title');
                                    // $lname = get_field('last_name');
                                    // $fname = get_field('first_name');
                                    // $mname = get_field('middle_name');
                                    // $suffix = get_field('suffix');
                                    // // student information
                                    // $bday  = get_field('birth_date');
                                    // $age = get_field('age');
                                    // $gender = get_field('genderr');
                                    // $cstatus = get_field('civil_status');
                                    // $religion = get_field('religion');
                                    // $province = get_field('province');
                                    // $country = get_field('country');
                                    // $bplace = get_field('birth_place');
                                    // $houseNo = get_field('house_no');
                                    // $address = get_field('address');
                                    // $city = get_field('city');
                                    // $province2 = get_field('province2');
                                    // $country2 = get_field('country2');
                                    // $pcode  = get_field('postal_code');
                                    // $bplace2 = get_field('birth_place2');
                                    // $email = get_field('email_address');
                                    // $telNo = get_field('telphone_no');
                                    // $cellNo  = get_field('cellphone_no');
                                    // // Educational Background
                                    // // contact information
                                    // $guardian = get_field('guardian');
                                    // $gaddress = get_field('guardian_address');
                                    // $gtellNo = get_field('guardian_telephone_no');
                                    // $gCellNo = get_field('guardian_cellphone_no');
                                    // $gEmail = get_field('guardian_email_address');
                                    // // current course information
                                    // $courseCode  = get_field('course_code');
                                    // $course = get_field('course');
                                    // $department = get_field('department');
                                    // $studentType = get_field('student_type');
                                    // $schoolYear = get_field('school_year');
                                    // $yearLevel = get_field('year_level');
                                    // // admission data
                                    // $basisAdmission = get_field('basis_of_admission');
                                    // $dateAdmission = get_field('date_of_admission');
                                    // $admissionStatus = get_field('admission_status');
                                // $remarks = get_field('remarks');
                        ?>
                            <tr>
                                <td><?=get_field('student_no')?></td>
                                <td class="text-capitalize"><?=$fullName?></td>
                                <td></td>
                                <td><?=get_field('remarks')?></td>
                            </tr>
                        <?php
                            the_content();
                            endwhile; endif;
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(function() {
        var table = $(".filter-base-date").DataTable();

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


