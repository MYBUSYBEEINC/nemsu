<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>


	<?php if ( is_single() ) : ?>
	
	
	  	
	<?php else: ?>
	
    <?php
    $website=get_field('website_url',10); 
 	$post_thumbnail_id = get_post_thumbnail_id( $post );
    $ctr+=1;
	if(!$post_thumbnail_id){
    $featured_img_url='https://staging1.beecr8tive.net/m-philpost/wp-content/uploads/2022/03/phlpost.png';
    }else{
    $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full'); 
	}
    $cpost=get_the_ID();

    ?>

	
    <article id="post-<?php the_ID(); ?>" class="list-articles">
    <div class="col-mid-20">
	<div class="thumbnail">
	<div class="margin-right">
	<a href="<?php the_permalink(); ?>" style="text-decoration:none; color:inherit;" ><img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>"></a>
	</div>
	</div>
	</div>
	<div class="col-mid-80">
	<div class="title"><a href="<?php the_permalink(); ?>" style="text-decoration:none; color:inherit;" ><?php the_title(); ?></a></div>

	<div class="term"><i class="fa fa-tag" aria-hidden="true" style="color: #726363;"></i> 
			<span> <?php echo get_the_date(); ?> </span> </div>

	<a href="<?php the_permalink(); ?>" style="text-decoration:none; color:inherit;" ><?php the_excerpt();?></a>

    <ul class='read-more' style="list-style:none; text-align:left; padding:0px;">
    <li><a href="<?php the_permalink(); ?>" style="text-decoration:none;" >Read More</a></li>
     </ul>
	 </div>
	<div class="clear"></div>
	</article><!-- #post -->
   
   
	<?php endif; ?>
	

