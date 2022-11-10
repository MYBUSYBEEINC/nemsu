<?php //Template Name: Schedule Proposal?>

<?php 
    acf_form_head();
get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
            <div>
                <h4 style="color:mediumblue;">
                    <b>Schedule Proposal</b> 
                </h4>
            </div>
            <div class="contact-us-container">    
                
                <br>
                <?php if(isset($_GET['submitted'])){ ?>
                    <div class="thankyouBox">
                        <h3 class="align-center">Your Message has been sent</h3>
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
                            'group_636a43dc39f65',
                            'group_636b320a0a834'
                        ),
                        'new_post'		=> array(
                            'post_title'    => $token,
                            'post_type' 	=> 'schedule_proposal',
                            'post_status'	=> 'publish',
                        ),
                        'submit_value'  => 'Submit',
                        'return' => '?submitted=y'
                    ));
                } ?>
            </div>
    </div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>


   
