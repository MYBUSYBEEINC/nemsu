<?php //Template Name: Course Schedule Proposal?>

<?php 
acf_form_head();
get_header(); ?>






<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">Propose Schedule</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Create Block Section</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Approve Schedule</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Plot Schedule</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Professor List</button>
</div>

<div id="London" class="tabcontent">
    <div class="row">
    <div class="col-lg-12">
        
            <div class="container">
            <div>
                <h4 style="color:mediumblue;">
                    <b>Schedule Proposal</b> 
                </h4>
            </div>
                <?php if(isset($_GET['submitted'])){ ?>
                    <div class="thankyouBox">
                        <h3 class="align-center">Course Schedule Proposal Save</h3>
                    </div>
                <?php } else { 
                    function generateRandomString($length) {

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
                        'post_id'		=> 'new_post',
                        'field_groups'  => array(
                            'group_636b60795a859',
                            
                        ),
                        'new_post'		=> array(
                            'post_title'    => $token,
                            'post_type' 	=> 'course_schedule_pros',
                            'post_status'	=> 'publish',
                        ),
                        'submit_value'  => 'Done',
                       
                        'return' => '?submitted=y'
                    ));
                } ?>
            </div>
            
        </div>
    </div>
</div>

<div id="Paris" class="tabcontent">
  <h3>Paris</h3>
  <p>Paris is the capital of France.</p> 
</div>

<div id="Tokyo" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<?php get_footer(); ?>

<script>
function openCity(evt, courseSchedule) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(courseSchedule).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
   
