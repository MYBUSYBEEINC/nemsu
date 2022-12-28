<?php //Template Name: Shift Student ?>
<?php
acf_form_head();
get_header(); ?>

<style>
    select {
        border: 2px solid #d4d0ba;
        font-family: inherit;
        padding: 5px;
    }
    label {
        line-height: 2em;
    }
</style>

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
                $department = get_field('department');
                $schoolYear = get_field('school_year');
                $yearLevel = get_field('year_level');
            endwhile;
        endif;
    }
?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h4><label>Student No.:</label></h4> 
            </div>
            <div class="col-4">
                <form method="post">
                    <input type="text" name="student-no" value="<?php echo $student_no ?>">
                    <input type="submit" name="btn-find-student" value="Find">
                </form>                   
            </div>            
        </div>
        <div class="row border-bottom mb-3">  
            <div class="col-3">
                <h4><label>Student Name:</label></h4>
            </div>
            <div class="col">
                <input type="text" style="width:60%;" value="<?php echo $fname .' '. $mname .' '. $lname .' '. $suffix ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <h4><label>Year Level:</label></h4>
            </div>
            <div class="col">
                <input type="text" style="width:60%;" value="<?php echo $yearLevel ?>" readonly>
            </div>
        </div> 
        <div class="row">
            <div class="col-3">
                <h4><label>Current Department:</label></h4>
            </div>
            <div class="col">
                <input type="text" style="width:60%;" value="<?php echo $department ?>" readonly>
            </div>
        </div>        
        <div class="row border-bottom mb-3">
            <div class="col-3">
                <h4><label>Current Course:</label></h4>
            </div>
            <div class="col">
                <input  type="text" style="width:60%;" value="<?php echo $course ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <h4><label>New Course:</label></h4>
            </div>
            <div class="col">
                <select style="width:60%;" id="current-course" name="current-course">
                    <option value="">Select New Course</option>
                    <option value="bscs">BSCS - BACHELOR OF SCIENCE IN COMPUTER SCIENCE</option>
                    <option value="bsce">BSCE - BACHELOR OF SCIENCE IN CIVIL ENGINEERING</option>
                    <option value="bs-math">BS-MATH - BACHELOR OF SCIENCE IN MATHEMATICS</option>
                    <option value="jd">JD - Juris Doctor (JD) Non Thesis</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <label><h4>School Year:</h4></label>
            </div>
            <div class="col">
                <input type="text" style="width:60%;">
            </div>
        </div>
        <div class="row border-bottom mb-3">
            <div class="col-9 text-right p-2" style="margin-left:-50px;">
                <button>Save</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label><h4>Transactions:</h4></label>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <table id="recordsTable" class="table app-table-hover mb-0 text-left table-striped table-hover dt-responsive">
                    <thead>
                        <tr>
                            <th>Transacton No.</th>
                            <th>From Course</th>
                            <th>From Department</th>
                            <th>To Course</th>
                            <th>To Department</th>
                        </tr>
                    </thead>
                    <tbod>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>