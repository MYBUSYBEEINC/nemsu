<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<style>
    .cave-wrapper {
       width:100%;
    }
    .cave-container{
        width:80%;
        margin:0 auto;
    }
</style>
    
			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>
				<!--Header Settings-->
				
                <!---->
	<div id="primary" class="content-area">
		<!--<div id="content" class="site-content" role="main">-->

					<div class="entry-content">
						<?php
						wp_link_pages(
							array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							)
						);
						?>
					</div><!-- .entry-content -->
					<?php if (is_page('7229')) { ?>
					<div class="cave-wrapper">
					    <div class="cave-container">
					        <div class="cave">
                                <div class="cave-title">
                                    <img src="<?php the_field('top_Icon');?>">
                                    <h2><?php the_field('title');?></h2>
                                </div>
                                    <?php the_content(); ?>
                            </div>
                        </div>
                                <div class="partners">
                                    <div class="cave-container">
                                        <?php 
                                            if(have_rows('list_of_partners')):
                                                while (have_rows('list_of_partners')): the_row();
                                                $img=get_sub_field('images');
                                        ?>
                                        
                                            <img src="<?php echo $img; ?>">
                                        
                                        <?php
                                            endwhile;
                                            else: echo ('No Available Logo');
                                            endif;
                                        ?>
                                    </div>
                                </div>
                            
					    
					</div>
                    
                    
                    <?php } ?>
                    <!---->
                    <?php if (is_page('7231')) { ?>
                    <div class="cave-wrapper">
					    <div class="cave-container">
					        <div class="cave">
                                <div class="wetland-title">
                                    <h2><?php the_field('title');?></h2>
                                </div>
                                    <?php the_content(); ?>
                            </div>
                        </div>
                                <div class="partners">
                                    <div class="cave-container">
                                        <?php 
                                            if(have_rows('list_of_partners')):
                                                while (have_rows('list_of_partners')): the_row();
                                                $img=get_sub_field('images');
                                        ?>
                                        
                                            <img src="<?php echo $img; ?>">
                                        
                                        <?php
                                            endwhile;
                                            else: echo ('No Available Logo');
                                            endif;
                                        ?>
                                    </div>
                                </div>
                            
					    
					</div>
                    <?php } ?>
					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

		<!--</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
