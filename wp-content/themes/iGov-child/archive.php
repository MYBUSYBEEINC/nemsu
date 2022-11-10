<?php
   /**
    * The template for displaying Archive pages
    *
    * Used to display archive-type pages if nothing more specific matches a query.
    * For example, puts together date-based pages if no date.php file exists.
    *
    * If you'd like to further customize these archive views, you may create a
    * new template file for each specific one. For example, Twenty Thirteen
    * already has tag.php for Tag archives, category.php for Category archives,
    * and author.php for Author archives.
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package WordPress
    * @subpackage Twenty_Thirteen
    * @since Twenty Thirteen 1.0
    */
   
   get_header(); ?>
 <?php $posttype=get_post_type(); ?>
 <?php if ($posttype == "careers") { ?>
    <div class="pageHeader" style="height: ; background: url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/iGov-child/images/careers.jpg')">
      <div class="pageWrapper">
        <div class="pagebanner-content">
          <h1><?php post_type_archive_title(); ?></h1></div>
      </div>
    </div>

<?php } else {?>
  <div class="pageHeader" style="height: ; background: url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/iGov-child/images/News and Updates 2.jpg')">
  <div class="pageWrapper">
    <div class="pagebanner-content">
      <h1><?php post_type_archive_title(); ?></h1></div>
  </div>
</div>
<?php } ?>

	    

<div class="container">
   <div class="site-content">
      <div class=" pageContainer">
       <div class="col-mid-75">
            <div class="margin-right">
                <?php include("breadcrumbs.php"); ?>
                 <?php 
				     if(isset($_POST['anythingsearch'])){
						 $search=$_POST['anything'];
						 echo "<div style='padding:4px; margin:3px 0px; 3px 0px; font-weight:700; font-size:18px;'> Search Result:  <span style='color:darkblue;'>$search</span> </div>";   
					 }elseif(isset($_GET['y'])){
					   $month=$_GET['month'];
                       $months=date("F", mktime(0, 0, 0, $month, 10));
                       $years=$_GET['y'];
                      echo "<div style='padding:4px; margin:3px 0px; 3px 0px; font-weight:700; font-size:18px;'> Filter Result: Month <span style='color:darkblue;'>$months</span>, and year <span style='color:darkblue;'>$years</span> </div>";   
                     }elseif($_GET['category']){
                         $category=$_GET['category'];
                        $term = get_term_by('slug', $category, 'form_type'); $name = $term->name;
                       echo "<div style='padding:4px; margin:3px 0px; 3px 0px; font-weight:700; font-size:18px;'> Filter Form Type: <span style='color:darkblue;'>$name</span></div>";
                     }elseif($_GET['pub_category']){
                        $category=$_GET['pub_category'];
                        $term = get_term_by('slug', $category, 'cat_archives'); $name = $term->name;
                       echo "<div style='padding:4px; margin:3px 0px; 3px 0px; font-weight:700; font-size:18px;'> Filter Category: <span style='color:darkblue;'>$name</span></div>";  
                     }elseif($_GET['form_type']){
                        $category=$_GET['form_type'];
                        $term = get_term_by('slug', $category, 'form_type'); $name = $term->name;
                       echo "<div style='padding:4px; margin:3px 0px; 3px 0px; font-weight:700; font-size:18px;'> Filter Type: <span style='color:darkblue;'>$name</span></div>";  
                     }else{
                         
                     }
                     ?>

               <?php include("sorting.php"); ?>
               <?php
                  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                  
                  if( $post_id_name ):
                  	$args = array(
                  		'post_type' => $posttype,
                  		'p'	=> $post_id_name,
                  		'post_status' => array('publish', 'future'),
                  		'posts_per_page' => 1,
                  	);
                  
                  elseif($_GET['category']):
                      $s=$_GET['category'];
                  	$args = array('post_type' => $posttype, 'posts_per_page' => 7, 'tax_query' => array(array(
                                        'taxonomy' => 'form_type', 'field' => 'slug', 'terms' => ''.$s.'')));
                  
                  elseif(isset($_GET['pub_category'])):
                  
                    $s=$_GET['pub_category'];
                  	$args = array('post_type' => $posttype, 'posts_per_page' => 7, 'tax_query' => array(array(
                                        'taxonomy' => 'cat_archives', 'field' => 'slug', 'terms' => ''.$s.'')));
                 elseif(isset($_GET['form_type'])):
                  
				
                    $s=$_GET['form_type'];
                  	$args = array('post_type' => $posttype, 'posts_per_page' => 7, 'tax_query' => array(array(
                                        'taxonomy' => 'form_type', 'field' => 'slug', 'terms' => ''.$s.'')));
                 elseif(isset($_POST['anythingsearch'])):
                    $anything=$_POST['anything'];
                  	$args = array('post_type' => $posttype, 'posts_per_page' => 7 , 's'  => $anything );
                    else:
                        $args = array(
                  		'post_type' => $posttype,
                  		'orderby'	=> $orderby,
                  		'order'		=> 'DESC',
                  		'year'		=> $year,
                  		'monthnum'	=> $month,
                  		'post_status' => array('publish', 'future'),
                  		'posts_per_page' => 8,
                  		'paged'=>$paged
                  	);
                  
                  endif;
                  
                  $variable = new WP_Query($args);
                  if ($variable->have_posts()): 
                  
                        the_post();
                  
                  ?>
               <div class="fileManager">
                 
                  <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                  <?php get_template_part( 'content', get_post_format() ); ?>
                  <?php endwhile; ?>
                  <div class="clear"></div>
                  <div style="padding-right:10px;">
                     <?php wpbeginner_numeric_posts_nav(); ?>
                  </div>
               </div>
               <?php else: ?>
               <div style='padding: 13px; margin: 3px 0px; font-weight: 700;xcolor: #695a5a;  font-size: 14px; background: #daa5a54a;'>No available post.</div>
               
               <p style="margin-top:10px; font-family:Poppins; text-transform:italic;">See our suggested posts:</p>
               
               
               <?php
                     $args = array(
                  		'post_type' => $posttype,
                  		'post_status' => array('publish', 'future'),
                  		'posts_per_page' => 4,
                  		'paged'=>$paged);
                 $variable = new WP_Query($args);
                  if ($variable->have_posts()): 
                  the_post();
                ?>
                <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
                <?php endif; ?>
                
               <?php endif; ?>
            </div>
         </div>
   
        <div class="col-mid-25" style="background-color: #f9f9f9;">
         <div class="sidebar">
            <?php include("sidebar.php"); ?>
         </div>
      </div>
   </div>
   <div class="clear"></div>
</div>
</div>	
</div>

<?php get_footer(); ?>