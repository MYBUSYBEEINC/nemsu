<?php //Template Name: Print Student Information ?>
<?php get_header(); ?>

		<div class="class-wrapper">
      <div class="class-container-nolimit">
        <div id="tobePrint" class="print-student-info">
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
   
          <h2>DETAILS</h2>
          <div class="studentname">
            <div class="col-mid-20">
              <img src="<?php echo $student_photo ?>" alt="" title="<?php echo $fname. " ". $lname ?>">
            </div>
            <div class="col-mid-80">
              <div class="name">
                <h2>NAME</h2>
                <h3>Student No. : <span><?php echo $student_no ?></span></h3>            
                <h3>Name : <span><?php echo $lname.", ". $fname." ". $mname." ". $suffix?></span></h3>               
                <h3>Title : <span><?php echo $title?></span></h3>
              </div>
            </div>
            <div class="col-mid-80">
              <div class="name mg-t table-form">
                <h2>PERSONAL INFORMATION</h2>
                <div class="col-mid-50">
                  <h3>Birth Date : <span><?php echo $bday ?></span></h3>            
                  <h3>Age : <span><?php echo $age ?></span></h3>               
                  <h3>Gender : <span><?php echo $title?></span></h3>
                  <h3>Civil Status : <span><?php echo $cstatus ?></span></h3>
                  <h3>Religion : <span><?php echo $religion ?></span></h3>
                  <h3>Province : <span><?php echo $province ?></span></h3>
                  <h3>Country : <span><?php echo $country ?></span></h3>
                  <h3>Birth Place : <span><?php echo $bplace ?></span></h3>
                </div>
                <div class="col-mid-50">
                <h3>House No. : <span><?php echo $houseNo ?></span></h3>
                <h3>Address : <span><?php echo $address ?></span></h3>
                <h3>City : <span><?php echo $city ?></span></h3>
                <h3>Province : <span><?php echo $province2 ?></span></h3>
                <h3>Postal Code : <span><?php echo $pcode ?></span></h3>
                <h3>Email Address : <span><?php echo $email ?></span></h3>
                <h3>Telephone No. : <span><?php echo $telNo ?></span></h3>
                <h3>Cellphone No. : <span><?php echo $cellNo?></span></h3>
                </div>
                <div class="clear"></div>
                
              </div>
            </div>
            <div class="clear"></div>
            <div class="name mg-t center">
                  <h2>EDUCATIONAL BACKGROUND</h2>
                    <?php 
                    if( have_rows('educational_background') ):
                    while ( have_rows('educational_background') ) : the_row();
                    $school_level = get_sub_field('school_level');
                    $name_school = get_sub_field('name_of_school');
                    $year_grad = get_sub_field('year_graduated');
                    $awards = get_sub_field('awards_honor');
                    $report_grade = get_sub_field('report_card_grade');
                    $ncae_exameeNo = get_sub_field('ncae_examee_no');
                    $ncae_grade = get_sub_field('ncae_grade');
                    ?>
                <div class="col-mid-10">
                  <h4 class="hidden">NO VALUE </h4>
                  <h3><?php echo $school_level ?></h3> 
                </div>
                <div class="col-mid-16">
                  <h4>Name of School</h4>
                  <h3><span><?php echo $name_school ?></span></h3>
                </div>
                <div class="col-mid-16">
                  <h4>Year Graduated</h4>
                  <h3><span><?php echo $year_grad ?></span></h3>
                </div>
                <div class="col-mid-16">
                  <h4>Awards/Honor</h4>
                  <h3><span><?php echo  $awards ?></span></h3>
                </div>
                <div class="col-mid-10">
                  <h4>Report Card Grade</h4>
                  <h3><span><?php echo $report_grade ?></span></h3>
                </div>
                <div class="col-mid-16">
                  <h4>NCAE Examee No</h4>
                  <h3><span><?php echo $ncae_exameeNo?></span></h3>
                </div>
                <div class="col-mid-10">
                  <h4>NCAE Grade</h4>
                  <h3><span><?php echo $ncae_grade ?></span></h3>
                </div>
                <div class="clear"></div>
                <?php
                  endwhile;
                  else:
                      echo ('No Background Education Added');
                  endif;
                ?>
              
            </div>
            <div class="col-mid-33">
              <div class="name mg-t mg-r ad-height">
                 <h2>CONTACT INFORMATION</h2>
                 <h3>Guardian : <span><?php echo $guardian ?></span></h3>
                 <h3>Address : <span><?php echo $gaddress ?></span></h3>
                 <h3>Email Address : <span><?php echo $gEmail ?></span></h3>
                 <h3>Telephone No. : <span><?php echo $gtellNo ?></span></h3>
                 <h3>Cellphone No. : <span><?php echo $gcellNo ?></span></h3>
              </div>
            </div>
            <div class="col-mid-33">
              <div class="name mg-t mg-r">
                 <h2>CURRENT COURSE INFORMATION</h2>
                 <h3>Course Code : <span><?php echo $courseCode ?></span></h3>
                 <h3>Department : <span><?php echo $course ?></span></h3>
                 <h3>Course : <span><?php echo $department ?></span></h3>
                 <h3>Student Type : <span><?php echo $studentType ?></span></h3>
                 <h3>School Year : <span><?php echo $schoolYear ?></span></h3>
                 <h3>Year Level : <span><?php echo  $yearLevel ?></span></h3>
              </div>
            </div>
            <div class="col-mid-33">
              <div class="name mg-t ad-height">
                 <h2>ADMISSION DATA</h2>
                 <h3>Basis of Admission : <span><?php echo $basisAdmission ?></span></h3>
                 <h3>Date of Admission : <span><?php echo $dateAdmission ?></span></h3>
                 <h3>Admission Status : <span><?php echo $admissionStatus ?></span></h3>
                 <h3>Remarks : <span><?php echo $remarks ?></span></h3>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <?php
            endwhile;
            endif;

            ?>
            <input type="button" value="Print" onclick="windows.print();">
            <button onclick="dltoPDF();">Download</button>
          
        </div>
      </div>
    </div>
   
    <script>
        function dltoPDF() {
          var doc = new jsPDF();
          var specialElementHandlers = {
              '#editor': function (element, renderer) {
                  return true;
              }
          };

          $('#cmd').click(function () {
              doc.fromHTML($('#tobePrint').html(), 15, 15, {
                  'width': 170,
                      'elementHandlers': specialElementHandlers
              });
              doc.save('sample-file.pdf');
          });
        }
    </script>

    
	

<?php get_footer(); ?>
