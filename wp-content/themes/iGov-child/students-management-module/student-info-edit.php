<?php //Template Name: Student Information Edit ?>
<?php
acf_form_head();
get_header(); ?>

	<div class="student-edit-wrapper">
        <div class="student-edit-container">
            <div class="student-edit">
            <?php 
            //  if ( is_user_logged_in() ) : 
            // echo 'login';
            ?>   
    

            <?php if(isset($_GET['updated'])){
                echo' <div class="noteBox">Student Information has been updated!</div>'; ?>

                <script>
                    window.setTimeout(function() {
                    window.location.href = '<?php echo esc_url( home_url( '/' ) ); ?>student-information';
                    }, 5000);
                </script>

            <?php } else{  ?>
    
                <?php
                    // $rejected = array(
                    //     'numberposts'    => 1,
                    //     'post_type'        => 'posttype',
                    //     'meta_key'        => 'username',
                    //     'meta_value'    => $current_user->user_login,
                    // );
                    // $args = array('numberposts' => '1', 'order' => 'DESC', 'post_type' => 'members', 'p' => $postid, 'meta_query');
                    // $recent_posts = wp_get_recent_posts($rejected); 
                    ?>
                <div class="profile-update">
                   
                    <?php
                    //  foreach ($recent_posts as $recent) {
                    //     $post_id = $recent["ID"];
                        ?>
                    <?php 
                     $post_id = $_GET['post_id'];
                    acf_form(array(
                            'post_id'       => $post_id, //Variable that you'll get from the URL
                                                'post_title'   => false,
                                                'post_content' => false,
                                                'html_before_fields' => '<h1 style="text-align:center;font-size:18px;">Student Information</h1>',
                                                'field_groups'  => array(
                                                    'group_636c8f36729cf',
                                                    'group_637209e28d3df',
                                                    'group_63720a4da8b8a',
                                                    'group_63720be55255d',
                                                    'group_6372190919e9f',
                                                    'group_6372198fa3096',
                                                    'group_63721a1b5cc08'
                            ),
                            'html_submit_spinner' => '<span class="acf-spinner"></span>',
                    'updated_message' => __("", 'acf'),
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
