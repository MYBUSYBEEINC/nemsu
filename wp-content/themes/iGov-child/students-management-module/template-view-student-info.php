<?php //Template Name: View Student Info ?>
<?php 
acf_form_head();
get_header(); ?>

		<div class="class-wrapper">
      <div class="class-container">
      <div class="edit">
         <?php 
        //  if ( is_user_logged_in() ) : 
        // echo 'login';
        ?>   
    

<?php if(isset($_GET['updated'])){
    echo' <div class="noteBox">Your details has been updated!</div>'; ?>

    <?php } else{  ?>
    
                <?php
                    $rejected = array(
                        'numberposts'    => 1,
                        'post_type'        => 'student_information',
                        'meta_key'        => 'username',
                        'meta_value'    => $current_user->user_login,
                    );
                    $args = array('numberposts' => '1', 'order' => 'DESC', 'post_type' => 'members', 'p' => $postid, 'meta_query');
                    $recent_posts = wp_get_recent_posts($rejected); ?>
<div class="profile-update">
                   
                    <?php foreach ($recent_posts as $recent) {
                        $post_id = $recent["ID"];
                        ?>

            

    <?php acf_form(array(
             'post_id'       => $post_id, //Variable that you'll get from the URL
                                'post_title'   => false,
                                'post_content' => false,
                                'field_groups'  => array(
                                    'group_62a2a3fa95e32'
            ),
 'updated_message' => __("", 'acf'),
            'return' => add_query_arg(array('updated' => 'true'), get_permalink()),
            'submit_value'  => __('Update', acf),
        )); 
    } ?>
    
    <?php } ?>
    
    <?php else: ?>
    
    Please login to access this page
    
<?php endif; ?> 
    </div>
</div>

      </div>
    </div>


    
	

<?php get_footer(); ?>
