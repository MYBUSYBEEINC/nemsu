<?php //Template Name: Finance - Set Subsidiary Ledger

    $title = 'Set Subsidiary Ledger';
?>

    <title><?=$title?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>finance-management-module/modules-style.css" rel="stylesheet" />
    <?php 
        get_header(); 
    ?>

    <style>
        /* .table thead th {
            background-color: #ffff !important;
            font-size: 15px !important;
            color: #000 !important;
        } */
        .form-control{
            background-color: #F5F5F5;
            border:0;
        }tr td{
            text-align:center;
        }
    </style>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <div class="card border-0 mt-3">
                <h5 class="card-header bg-white border-0"><?=$title?></h5>
                <div class="card-body">
                <?php
                    $postid= $_GET['post_id'];
                    //echo $email;
                    $posts = get_posts(array(
                    'posts_per_page'=> -1, 
                    'p' => $postid, 
                    'post_type'		=> 'student_information',
                    ));
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $cpost=get_the_ID();
                    // student name
                    $student_photo = get_field('student_photo');
                    $student_no  = get_field('student_no');
                    // $title = get_field('title');
                    $lname = get_field('last_name');
                    $fname = get_field('first_name');
                    $mname = get_field('middle_name');
                    $suffix = get_field('suffix');
                    // student information
                    $bday  = get_field('birth_date');
                    $age = get_field('age');
                    $gender = get_field('genderr');
                    $cstatus = get_field('civil_status');
                    $religion = get_field('religion');
                    $province = get_field('province');
                    $country = get_field('country');
                    $bplace = get_field('birth_place');
                    $houseNo = get_field('house_no');
                    $address = get_field('address');
                    $city = get_field('city');
                    $province2 = get_field('province2');
                    $country2 = get_field('country2');
                    $pcode  = get_field('postal_code');
                    $bplace2 = get_field('birth_place2');
                    $email = get_field('email_address');
                    $telNo = get_field('telphone_no');
                    $cellNo  = get_field('cellphone_no');
                    // Educational Background
                    // contact information
                    $guardian = get_field('guardian');
                    $gaddress = get_field('guardian_address');
                    $gtellNo = get_field('guardian_telephone_no');
                    $gCellNo = get_field('guardian_cellphone_no');
                    $gEmail = get_field('guardian_email_address');
                    // current course information
                    $courseCode  = get_field('course_code');
                    $course = get_field('course');
                    $department = get_field('department');
                    $studentType = get_field('student_type');
                    $schoolYear = get_field('school_year');
                    $yearLevel = get_field('year_level');
                    // admission data
                    $basisAdmission = get_field('basis_of_admission');
                    $dateAdmission = get_field('date_of_admission');
                    $admissionStatus = get_field('admission_status');
                    $remarks = get_field('remarks');
                    // var_dump($fname);
                    // acf fields here..

                ?>

                <?php
                the_content();
                endwhile; endif;
                ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Student No</label>
                                <input type="number" class="form-control" value="<?=$student_no ?>">
                            </div>
                            <!-- <div class="mb-3">
                                <label  class="form-label fw-bd">Course</label>
                                <input type="text" class="form-control" value="<?php echo $department ?>">
                            </div> -->
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Address</label>
                                <input type="text" class="form-control" value="<?php echo $gaddress ?>">
                            </div>

                            <form class="row">
                                <div class="col-md-6 ps-0">
                                    <div class="mb-3 m">
                                        <label  class="form-label fw-bd">Telephone</label>
                                        <input type="number" class="form-control" value="<?php echo $gtellNo ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Mobile</label>
                                        <input type="number" class="form-control" value="><?php echo $gcellNo ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Student Name</label>
                                <input type="text" class="form-control" value="<?php echo $lname." ". $fname." ". $mname." ". $suffix?>">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Department</label>
                                <input type="text" class="form-control" value="<?php echo $course ?>">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Email</label>
                                <input type="email" class="form-control" value="<?php echo $gEmail ?>">
                            </div>

                            <form class="row">
                                <div class="col-md-6 ps-0">
                                    <div class="mb-3 m">
                                        <label  class="form-label fw-bd">Citizenship</label>
                                        <input type="text" class="form-control" value="<?php echo $country ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Birth Date</label>
                                        <input type="date" class="form-control" value="<?php echo $bday ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Balance</label>
                                <input type="number" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <div class="d-flex flex-row mb-3">
                                <div class="p-2">
                                    <button type="button" class="btn btn-primary rounded mt-4">View Details</button>
                                </div>
                                <div class="p-2">
                                    <button type="button" class="btn btn-primary rounded mt-4">Adjustment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white text-muted p-3">
                <table class="table mt-5 filter-base-date">
                    <?php
                        query_posts(array(    
                            'posts_per_page' => -1,
                            'orderby' => 'DESC',
                            'post_type' => array(
                            'view_subsidiary_ledg')));
                        if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                        ?>
                
                        <?php
                        the_content();
                        endwhile; endif;
                        ?>
                    <thead>
                        <tr>
                            <?php
                                $titleHead = array(
                                    "Trx Date", 
                                    "Particular", 
                                    "Reference No.", 
                                    "Debit","Credit",
                                    "Balance",
                                    "Trx Type
                                ");

                                foreach ($titleHead as $value) {
                                    echo "<th scope='col' class='text-center'>$value</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo the_field('trx_date');?></td>
                            <td><?php echo the_field('particular');?></td>
                            <td><?php echo the_field('reference_no');?></td>
                            <td><?php echo the_field('debit');?></td>
                            <td><?php echo the_field('credit');?></td>
                            <td><?php echo the_field('balance');?></td>
                            <td><?php echo the_field('trx_type');?></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

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
