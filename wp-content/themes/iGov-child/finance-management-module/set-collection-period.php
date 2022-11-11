<?php //Template Name: Set Collection Period?>

<?php 
    acf_form_head();
get_header(); ?>

<style>
    .acf-field .acf-label label {
        display: block;
        font-weight: 700;
        margin: 0 0 3px;
        padding: 0;
    }
    .acf-field input[type=text], .acf-field input[type=password], .acf-field input[type=date], .acf-field input[type=datetime], .acf-field input[type=datetime-local], .acf-field input[type=email], .acf-field input[type=month], .acf-field input[type=number], .acf-field input[type=search], .acf-field input[type=tel], .acf-field input[type=time], .acf-field input[type=url], .acf-field input[type=week], .acf-field textarea, .acf-field select {
    width: 100%;
    padding: 12px 8px !important;
    margin: 0;
    box-sizing: border-box;
    font-size: 14px;
    line-height: 20.4;
}
</style>

<div id="primary" class="content-area"><center>
    <div id="content" class="site-content" role="main" style="width:514px;height:200px;margin-top:50px">

        <div class="contact-us-wrapper">
            <div class="contact-us-container">    
                <?php if(isset($_GET['submitted'])){ ?>
                    <div class="thankyouBox">
                        <h3 class="align-center">Set collection period sucessfully inserting data. </h3>
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
                            'group_636de6d7e08e6' // Contact Form
                        ),
                        'new_post'		=> array(
                            'post_title'    => $token,
                            'post_type' 	=> 'set_collect_period',
                            'post_status'	=> 'publish',
                        ),
                        'submit_value'  => 'Submit',
                        'return' => '?submitted=y'
                    ));
                } ?>
            </div>
        </div>
    </div><!-- #content -->
</div><!-- #primary -->
</center>

<!-- <php get_footer(); ?> -->


   
