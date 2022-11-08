<?php // Template Name: Login
get_header();
?>
<?php if (has_post_thumbnail( $post->ID ) ): ?>
    <?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<?php endif; ?>

<div id="primary" class="content-area page-login">
    <div id="content" class="site-content" role="main">
        <div class="login-wrapper">
            <div class="login-container">
                <?php if($loggedin){ ?>
                    <div class="this-logout align-center">
                        <h2>Welcome back <?php echo $current_user->display_name; ?>!</h2>
                        <h3>Click <a onclick="window.open(this.href,'_new');return false;" href="<?php echo site_url().'/wp-admin'; ?>">here</a> to view dashboard</h3>
                        
                    </div>
                <?php } else { ?>
                    <div class="this-login">
                        <h2>Welcome back!</h2>
                        <?php wp_login_form(); ?>
                    </div>
                        
                    <div class="this-register">
                        <p>Dont have an account? <a href="<?php echo site_url().'/registration'; ?>">Register Account</a></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div><!-- #content -->
</div><!-- #primary -->


<style>
    #primary {
        background-image: url(<?php echo $featured_image[0]; ?>);
    }
</style>
<?php get_footer(); ?>