<?php //Template Name: Enrollment Guidance Result?>
<?php 
    acf_form_head();
    get_header(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>
    
</style>

<div class="container-fluid">
    
    <h4 class="title text-uppercase">Guidance Result</h4>

    <div class="card">
        <div class="card-body">

        <?php
            $rejected = array(
                'numberposts' => 1,
                'post_type'   => 'student_information',
                'meta_key'    => 'username',
                'meta_value'  => $current_user->user_login,
            );
            $args = array('numberposts' => '1', 'order' => 'DESC', 'post_type' => 'members', 'p' => $postid, 'meta_query');
            $recent_posts = wp_get_recent_posts($rejected); 
        ?>

        <div class="profile-update">
            <?php 
                foreach ($recent_posts as $recent):
                    $post_id = $recent["ID"];
                    
                    acf_form(
                        array(
                            'post_id' => $post_id,
                            'post_title'   => false,
                            'post_content' => false,
                            'field_groups'  => array(
                                'group_62a2a3fa95e32'
                            ),
                            'updated_message' => __("", 'acf'),
                            'return' => add_query_arg(array('updated' => 'true'), get_permalink()),
                            'submit_value'  => __('Update', acf),
                        )
                    );
                endforeach; 
            ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>