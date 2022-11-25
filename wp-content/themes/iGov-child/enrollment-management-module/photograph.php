<?php //Template Name: Photograph?>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <?php 
        acf_form_head();
        get_header(); 

        $title = "Evaluate New Students or Transferees"
    ?>
    <title><?=$title?></title>

    <style>
        .form-control{
            background-color:#F5F5F5;
            border: 0;
        }
        .form-select{
            background-color:#F5F5F5;
            border: 0;
        }
        body{
            background-color:#F5F5F5;
        }
        .table thead th {
            background-color: #0B6FC2 !important;
            font-size: 13px;
            color: #fff !important;
        }
        td{
            text-align:center;
            background-color: #F3F9FD !important;
        }
        
    </style>

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
        $title = get_field('title');
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

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12"><h6 class="text-uppercase mb-3 fw-bold">Recommendation Units</h5></div>
            <div class="col-lg-6 col-md-12">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label>Application No</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Year Level</label>
                        <input type="number" class="form-control" value="<?php echo $schoolYear;?>">
                    </div>
                    <div class="col-md-12">
                        <label>Student No</label>
                        <input type="text" class="form-control" name="student_no" value="<?php echo $student_no ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Course Code</label>
                        <input type="text" class="form-control" value="<?php echo $courseCode?>">
                    </div>
                    <div class="col-md-12">
                        <label>Course</label>
                        <input type="text" class="form-control" value="<?php echo $course?>">
                    </div>
                    <div class="col-md-12">
                        <label>Department</label>
                        <input type="text" class="form-control" value="<?php echo $department?>">
                    </div>
                </form>
            </div>
            <div class="col-lg-3 com-md-12">
                <img src="<?php echo $student_photo;?>" class="img-thumbnail" style="height:35vh">
                <div class="d-flex justify-content-between mt-3">
                    <div class="p-2"><input class="form-control" type="file" id="formFile"></div>
                    <div class="p-2"><button type="button" class="btn btn-danger">Remove</button></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
            <table class="table">
                    <thead>
                        <tr>
                            <?php
                                $titleHead = array(
                                    "Procedure", 
                                    "Status",  
                                    "Tag"
                                );
                                foreach ($titleHead as $value) {
                                    echo "<th scope='col' class='text-center bg-primary'>$value</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                            $data['items'] = array(
                                array(
                                    'procedure' => 'Academic Advising', 
                                    'status' => "Incomplete", 
                                    'tag' =>"<input type='checkbox'>"
                                ),array(
                                    'procedure' => 'Academic Advising', 
                                    'status' => "Incomplete", 
                                    'tag' =>"<input type='checkbox'>"
                                    ),
                                );

                            foreach ($data['items'] as $rows) :?>
                                <tr>
                                    <td> <?=$rows['procedure']; ?></td>
                                    <td> <?=$rows['status']; ?></td>
                                    <td> <?=$rows['tag']; ?></td>
                                </tr>
                            <?php endforeach;?>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        
        <form class="row mt-5 p-3 g-3">
            <div class="col-md-4">
                <label>Name</label>
                <input type="number" class="form-control" value="<?php echo $fname, $mname, $lname;?>">
            </div>
            <div class="col-md-4">
                <label>Telephone No</label>
                <input type="number" class="form-control" value="<?php echo $gtellNo;?>">
            </div>
            <div class="col-md-4">
                <label>Modified By</label>
                <input type="text" class="form-control" value="">
            </div>
            <div class="col-md-4">
                <label>Address</label>
                <textarea name="" class="form-control"  rows="2" value="<?php echo $gaddress;?>"></textarea>
            </div>
            <div class="col-md-4">
                <label>Cellphone No</label>
                <input type="number" class="form-control" value="<?php echo $gCellNo?>">
            </div>
            <div class="col-md-4">
                <label>Date </label>
                <input type="text" class="form-control" value="<?php echo $department?>">
            </div>
        </form>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>