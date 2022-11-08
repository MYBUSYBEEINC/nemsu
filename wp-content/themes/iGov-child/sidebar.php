<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<?php $website ="https://staging1.beecr8tive.net/m-philpost"; ?>
<?php $post_type = get_post_type(); ?>
<?php  if(is_single()){ ?>
<?php  }else{
if($post_type=="careers"){?>
<div class="sidebarHeader">Category</div>
<?php $categories = get_categories('taxonomy=categories&post_type=careers'); ?>
<ul class="category-list">
   <?php foreach ($categories as $category) : 
      $term = get_term($category->cat_ID);
      $slug = $term->slug;
      ?>
   <?php
      $categories=$_GET['categories'];
      $board=$_GET['board'];
     ?>

    <li  id="<?php echo $slug; ?>"><a href="?projects_category=<?php echo $slug; ?>"><?php echo $category->name; ?></a></li>
 
    <?php endforeach; ?>
</ul>
<?php  } ?>
<div class="sidebarHeader">Archive Posts</div>
<div class="sidebarlinks">
   <?php
      $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = '".get_post_type()."' ORDER BY post_date DESC");
      if( $years ):
      	foreach( $years as $year ):
      		if( isset( $postyear ) ):
      			if(  $postyear  == $year ):
      				$classyear = 'activeyear';
      				$classcollapse = 'in';
      			else:
      				$classyear = '';
      				$classcollapse = '';							
      			endif;
      		else:
      			$classyear = '';
      			$classcollapse = '';
      		endif;
      
      	    $post_type=get_post_type();
                       $countPosts = $wp_the_query->post_count;
      		?>
   <div class="panel panel-default">
      <div class="panel-heading archive_month_<?php echo $year; ?>">
         <div class="float-80"><?php echo $year; ?></div>
      </div>
      <!--/.panel-heading -->
      <div id="<?php echo get_post_type().'-'.$year ?>" class="panel-collapse collapse archive_posts_<?php echo $year; ?>">
         <div class="panel-body">
            <ul>
               <?php $months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = '".get_post_type()."' AND YEAR(post_date) = '".$year."' ORDER BY post_date ASC");
                  foreach( $months as $month ):
                  	$monthletter = date( 'F', mktime(0, 0, 0, $month,1 ) ); 
                  
                  	if( isset( $postmonth ) ):
                  		if( $postyear == $year && $postmonth == $month ):
                  			$classmonth = 'activemonth';
                  		else:
                  			$classmonth = '';
                  		endif;
                  	else:
                  		$classmonth = '';
                  	endif;
                  
                  	?>
               <li>
                  <a class="raleway easeme month <?php echo $classmonth; ?>" href="<?php echo get_post_type_archive_link("$post_type").'?y='.$year.'&month='.sprintf("%02d", $month) ?>/">
                  <?php echo $monthletter; ?> 
                  </a>
               </li>
               <?php endforeach; ?>
               <script>
                  $('.archive_posts_<?php echo $year; ?>').hide();
                  	$('.archive_month_<?php echo $year; ?>').click(function() {
                  	$(this).parent().find('.archive_posts_<?php echo $year; ?>').slideToggle();
                  	});																		
               </script>	
            </ul>
         </div>
         <!--/.panel-body -->
      </div>
      <!--/.panel-collapse --> 
      <?php endforeach;
         endif; ?>
   </div>
</div>


<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<?php $post_type = get_post_type(); ?>
<?php if($post_type!="ongoing_projects"){?>
<div class="sidebarHeader">Latest News</div>
<div class="advisories-container"  style="height:240px !important;">
   <?php
        $featurednews = array(    
    'posts_per_page' => 6, 'orderby' => 'ASC',  'nopaging' => true,'orderby' => 'type',
    'post_type' => array(
    'news_and_updates'));
                        $variable_featured_news = new WP_Query($featurednews);
                        if ($variable_featured_news->have_posts()): the_post(); 
                        while( $variable_featured_news->have_posts() ): $variable_featured_news->the_post(); 
         $cpost=get_the_ID();
         $title=get_the_title($cpost);
         $ctr+=1;
         ?>
   <div class="advisory-post">
      <a href="<?php the_permalink(); ?>"  title="Read More..">
         <h4><?php  echo $title ; ?></h4>
      </a>
      <p class="excerpt">
         <a href="<?php the_permalink(); ?>"><?php echo get_the_excerpt(); ?></a>
      <div class="date-posted"><i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?></div>
      </p>
   </div>
   <?php 
      endwhile; 
      endif; 
      wp_reset_query(); 
      ?>
   <a href="<?php echo $website; ?>/advisories/" style="color:inherit;">
      <div class="viewall">View all News</div>
   </a>
</div>

<div class="sidebarHeader">Bid Opportunities</div>
<div class="advisories-container"  style="height:240px !important;">
   <?php
      query_posts( array( 'post_type' => array('bid_opportunities'),   'posts_per_page' => 4,  'orderby'=> 'DESC'));
         if ( have_posts() ) : while ( have_posts() ) : the_post();
         $cpost=get_the_ID();
         $title=get_the_title($cpost);
         $ctr+=1;
         ?>
    <div class="advisory-post">
     
         <h4><?php  echo $title ; ?></h4>
   
     
   </div>
   <?php 
      endwhile; 
      endif; 
      wp_reset_query(); 
      ?>
   <a href="<?php echo $website; ?>/news_and_updates/" style="color:inherit;">
      <div class="viewall">View all Opportunities</div>
   </a>
</div>

<?php } ?>
<?php  } ?>
  		<div class="sidebarHeader">Follow Us on Facebook</div>
            <center>
            <?php echo get_field('facebook_embed_page',63); ?>
</center>  