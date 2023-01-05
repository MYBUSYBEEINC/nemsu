<?php //Template Name: Finance - Approve Scholarship Grant?>


<title>Approve Scholarship Grant</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="<?php echo get_stylesheet_directory_uri(); ?>finance-management-module/modules-style.css" rel="stylesheet" />
<style>td{text-align:center;text-transform: capitalize;}</style>
<?php 
    get_header(); 
?>
<div class="container-fluid">

    <?php
        if (isset($_POST["btn-find-student"])) {
            $input_student_no = $_POST["student-no"];
            query_posts( array( 
                'post_type' => 'student_information', 
                'post_status' => array('publish'),
                'posts_per_page' => 1,
                'meta_query'     => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'student_no',
                        'value' => $input_student_no,
                        'compare' => '==',
                    ),
                )
            ));
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    // student name
                    $student_photo = get_field('student_photo');
                    $student_no  = get_field('student_no');
                    $title = get_field('title');
                    $lname = get_field('last_name');
                    $fname = get_field('first_name');
                    $mname = get_field('middle_name');
                    $suffix = get_field('suffix');               
                    // current course information
                    $course = get_field('course');
                    // $department = get_field('department');
                    $schoolYear = get_field('school_year');
                    $yearLevel = get_field('year_level');
                    $studentType = get_field('student_type');
                endwhile;
            endif;
        }
    ?>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <h6><label>Student No.:</label></h6> 
                </div>
                <div class="col-lg-9 col-md-12">
                    <form method="post">
                        <input type="text" name="student-no" style="width:50%;" value="<?php echo $student_no ?>">
                        <input type="submit" name="btn-find-student" value="Find">
                    </form>                   
                </div>            
            </div>
            <div class="row mt-3 mb-3">  
                <div class="col-lg-3 col-md-12">
                    <h6><label>Student Name:</label></h6>
                </div>
                <div class="col-lg-9 col-md-12 mb-3">
                    <input type="text" style="width:60%;" value="<?php echo $fname .' '. $mname .' '. $lname .' '. $suffix ?>" readonly>
                </div>

                <div class="col-lg-3 col-md-12">
                    <label><h6>School Year:</h6></label>
                </div>
                <div class="col-lg-9 col-md-12 mb-3">
                    <input type="text" style="width:60%;" value="<?=$schoolYear?>">
                </div>

                <div class="col-lg-3 col-md-12">
                    <h6><label>Year Level:</label></h6>
                </div>
                <div class="col-lg-9 col-md-12 mb-3">
                    <input type="text" style="width:60%;" value="<?=$yearLevel ?>" readonly>
                </div>
            
                <div class="col-lg-3 col-md-12">
                    <h6><label>Current Course:</label></h6>
                </div>
                <div class="col-lg-9 col-md-12 mb-3">
                    <input  type="text" style="width:60%;" value="<?=$course ?>" readonly>
                </div>
                
                <div class="col-lg-3 col-md-12">
                    <label><h6>Type:</h6></label>
                </div>
                <div class="col-lg-9 col-md-12 mb-3">
                    <input type="text" style="width:60%;" value="<?=$studentType?>">
                </div>
            </div>
        </div>
    </div>


    <table class="table mt-5 filter-base-date display nowrap" id="scrollbar-horizontal" style="width:100%">
        <thead>
            <tr>
                <?php
                    $titleHead = array(
                        "Student No", 
                        "Student Name", 
                        "Approved", 
                        "Units Enrolled",
                        "Rate/Unit",
                        "Tuition Fee",
                        "Miscellaneous",
                        "Larboratory Fee",
                        "TF Percent",
                        "Misc. Percent",
                        "Lab Percent",
                        "Tution Fee Discount",
                        "Misc Fee Discount",
                        "Lab Fee Discount",
                        "Other Benefits",
                        "Total Discount"
                    );
                    foreach ($titleHead as $value) {
                        echo "<th scope='col' class='text-center'style='font-size:14px;'>$value</th>";
                    }
                ?>
            </tr>
        </thead>
        
        <?php
            query_posts(array(    
                'posts_per_page' => -1,
                'orderby' => 'DESC',
                'post_type' => array(
                'student_information')));
            if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                $lname = get_field('last_name');
                $fname = get_field('first_name');
                $mname = get_field('middle_name');
                $suffix = get_field('suffix');
                $fullName = "$fname $mname $lname $suffix";
        ?>

        <tbody>
            <tr>
                <td><?php echo get_field('student_no');?></td>
                <td><?=$fullName?></td>
                <td><?php if(get_field('approve') =='Yes'):?>
                    <?php echo get_field('approve');?>

                    <?php else: ?>
                        <?php echo get_field('approve');?>
                    <?php endif ?>
                </td>
                <td><?php echo get_field('units_enrolled');?></td>
                <td><?php echo get_field('rateunit');?></td>
                <td><?php echo get_field('tuition_fee');?></td>
                <td><?php echo get_field('miscellaneous');?></td>
                <td><?php echo get_field('larboratory_fee');?></td>
                <td><?php echo get_field('tf_percent');?></td>
                <td><?php echo get_field('misc_percent');?></td>
                <td><?php echo get_field('lab_percent');?></td>
                <td><?php echo get_field('tution_fee_discount');?></td>
                <td><?php echo get_field('misc_fee_discount');?></td>
                <td><?php echo get_field('lab_fee_discount');?></td>
                <td><?php echo get_field('other_benefits');?></td>
                <td><?php echo get_field('total_discount');?></td>
            </tr>
        </tbody>
    
        <?php
            the_content();
            endwhile; endif;
        ?>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script>

    $(document).ready(function() {
        var table = $('#scrollbar-horizontal').dataTable( {
            "sScrollX": "100%",
            "sScrollXInner": "110%",
            "bScrollCollapse": true
        });
    }); 
   
</script>
