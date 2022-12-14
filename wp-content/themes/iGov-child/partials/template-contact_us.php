<?php

/**
 * Template Name: Contact Us
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
acf_form_head();
get_header();
?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

        <div class="contact-us-wrapper">
            <div class="contact-us-container">    
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
                            'group_628c7b0ecbcd3',  // Contact Form
                            'group_6298087585007'   // Captcha
                        ),
                        'new_post'		=> array(
                            'post_title'    => $token,
                            'post_type' 	=> 'cpt-contact-forms',
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

<?php get_footer(); ?>