<?php //Template Name: Enter Old Subjects ?>
<?php
acf_form_head();
get_header(); ?>
<style>
.site-main{
    margin-left: 13.1rem;
}
</style>
<div class="old-subject-wrapper">
        <div class="old-subject-container">
            <div class="old-subject-post">
            <?php 
            //  if ( is_user_logged_in() ) : 
            // echo 'login';
            ?>   
    

            <?php if(isset($_GET['updated'])){
                echo' <div class="noteBox">Old Subject Submitted!</div>'; ?>

                <script>
                    window.setTimeout(function() {
                    window.location.href = '<?php echo esc_url( home_url( '/' ) ); ?>student-information';
                    }, 5000);
                </script>

            <?php } else{  ?>
                <div class="new-post">
                    <?php 
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
                            'post_id'       => 'new_post',
                                                'post_content' => false,
                                                'html_before_fields' => '<h1 style="font-size:18px;">Enter Old Subjects</h1>',
                                                'field_groups'  => array(
                                                    'group_63749ca464650',
                                                    'group_63749dbdc722e'
                            ),
                            'new_post' => array (
                                'post_type' => 'old_subjects',
                                'post_title' =>  $token,
                                'post_status' => 'publish',
                            ),
                            'html_submit_spinner' => '<span class="acf-spinner"></span>',
                            'return' => add_query_arg(array('updated' => 'true'), get_permalink()),
                            'submit_value'  => __('Save', 'acf'),
                        )); 
                    } ?>
    
                    <?php 
                        // } 
                        ?>
    
                    <?php
                    // else: 
                    ?>
            
                    <!-- Please login to access this page -->
    
                    <?php
                    //  endif; 
                    ?> 
                </div>

            </div>
        </div>
    </div>


    
	

<?php get_footer(); ?>
