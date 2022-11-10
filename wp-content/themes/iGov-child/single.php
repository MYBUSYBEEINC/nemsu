<?php
/**
 * Single Post 
 */
acf_form_head();
$current_user = wp_get_current_user();
get_header(); ?>

<div class="pageHeader" style="height: 30vh; background: #005E94;">
    <div class="pageWrapper">
        <div class="pagebanner-content">
            <h1><?php echo get_the_title(); ?></h1>
        </div> 
    </div>
</div>

<?php if((get_post_type() == 'cpt-caves') || (get_post_type()) == 'cpt-wetlands') { ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.3/css/lightslider.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<div class="sngle container margin-tb-70">
    <div class="site-content">
        <div class="pageContainer">
            <div class="sngl-gallery sngl-divider">
                <div class="main-info">
                    <div class="col-mid-50">
                        <div class="sliderGallery padding-right">
                            <?php 
                            $images = get_field('gallery');
                            if( $images ): ?>
                                <ul id="lightSlider">
                                    <?php foreach( $images as $image ): ?>
                                        <li data-thumb="<?php echo esc_url($image['url']); ?>">
                                            <a href="<?php echo esc_url($image['url']); ?>"><img src="<?php echo esc_url($image['url']); ?>" /></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-mid-50">
                        <div class="sngl-row">
                            <div class="col-mid-25">
                                <p class="title">Location</p>
                                <p class="value"><?php echo get_field('location'); ?></p>
                            </div>
                            <div class="col-mid-25">
                                <p class="title">Barangay</p>
                                <p class="value"><?php echo get_field('barangay'); ?></p>
                            </div>
                            <div class="col-mid-25">
                                <p class="title">Longtitude</p>
                                <p class="value"><?php echo get_field('longitude'); ?></p>
                            </div>
                            <div class="col-mid-25">
                                <p class="title">Latitude</p>
                                <p class="value"><?php echo get_field('latitude'); ?></p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        
                        <div class="sngl-row">
                            <div class="col-mid-25">
                                <p class="title">Elevation</p>
                                <p class="value"><?php echo get_field('elevation'); ?></p>
                            </div>
                            <div class="col-mid-75">
                                <p class="title">Speleothems</p>
                                <p class="value"><?php echo get_field('speleothems'); ?></p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="sngl-overview sngl-divider">
                <h3 class="sngl-divider-title">Overview</h3>
                <?php  if ( is_user_logged_in() ) : ?>   
    

                <?php if(isset($_GET['updated'])){
                	echo' <div class="noteBox">Your details has been updated!</div>'; ?>
                
                	<?php } else{  ?>
                	
                                <?php
                                    $rejected = array(
                                        'numberposts'    => 1,
                                        'post_type'        => 'cpt-caves',
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
            <div class="sngl-other">
                <h3 class="sngl-divider-title">You can also check other featured caves and wetlands</h3>
                <div class="banner-wrapper">
            		<div id="featuredBanner" class="bannerSlider owl-banner owl-carousel owl-theme">
        				<div class="item">
        				    <a href="#">
    		                    <div class="sliderImg">
    		                        <div class="tintContent" style="background-color: <?php echo $opacity; ?>"></div>
    		                        <div class="item-image" style="background-image:url('https://staging1.beecr8tive.net/bmb/wp-content/uploads/2022/05/cave-bg.png');"></div>
    		                        <div class="caption">
    		                        	<div class="center-content">
    			                            <p class="feat-title">Angib Cave</p>
    			                            <div class="feat-desc">
    			                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    			                            </div>
    			                        </div>
    		                        </div>
    		                    </div>
		                    </a>
		                </div>
		                <div class="item">
        				    <a href="#">
    		                    <div class="sliderImg">
    		                        <div class="tintContent" style="background-color: <?php echo $opacity; ?>"></div>
    		                        <div class="item-image" style="background-image:url('https://staging1.beecr8tive.net/bmb/wp-content/uploads/2022/05/cave-bg.png');"></div>
    		                        <div class="caption">
    		                        	<div class="center-content">
    			                            <p class="feat-title">Baolan Cave</p>
    			                            <div class="feat-desc">
    			                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    			                            </div>
    			                        </div>
    		                        </div>
    		                    </div>
		                    </a>
		                </div>
		                <div class="item">
        				    <a href="#">
    		                    <div class="sliderImg">
    		                        <div class="tintContent" style="background-color: <?php echo $opacity; ?>"></div>
    		                        <div class="item-image" style="background-image:url('https://staging1.beecr8tive.net/bmb/wp-content/uploads/2022/05/cave-bg.png');"></div>
    		                        <div class="caption">
    		                        	<div class="center-content">
    			                            <p class="feat-title">Agapang Cave</p>
    			                            <div class="feat-desc">
    			                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    			                            </div>
    			                        </div>
    		                        </div>
    		                    </div>
		                    </a>
		                </div>
		                <div class="item">
        				    <a href="#">
    		                    <div class="sliderImg">
    		                        <div class="tintContent" style="background-color: <?php echo $opacity; ?>"></div>
    		                        <div class="item-image" style="background-image:url('https://staging1.beecr8tive.net/bmb/wp-content/uploads/2022/05/cave-bg.png');"></div>
    		                        <div class="caption">
    		                        	<div class="center-content">
    			                            <p class="feat-title">Putek Cave</p>
    			                            <div class="feat-desc">
    			                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    			                            </div>
    			                        </div>
    		                        </div>
    		                    </div>
		                    </a>
		                </div>
		                <div class="item">
        				    <a href="#">
    		                    <div class="sliderImg">
    		                        <div class="tintContent" style="background-color: <?php echo $opacity; ?>"></div>
    		                        <div class="item-image" style="background-image:url('https://staging1.beecr8tive.net/bmb/wp-content/uploads/2022/05/cave-bg.png');"></div>
    		                        <div class="caption">
    		                        	<div class="center-content">
    			                            <p class="feat-title">Agusan Marsh</p>
    			                            <div class="feat-desc">
    			                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    			                            </div>
    			                        </div>
    		                        </div>
    		                    </div>
		                    </a>
		                </div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.10.1.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.3/js/lightslider.min.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script>
    $('#lightSlider').lightSlider({
        gallery: true,
        item: 1,
        loop:true,
        slideMargin: 0,
        thumbItem: 9
    });
</script>

<!-- Owl Stylesheets -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/owl.theme.default.min.css">
<!-- javascript -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/owl.carousel.js"></script>

<script>
 
    $(document).ready(function() {
      var owl = $('#featuredBanner');
      owl.owlCarousel({
        margin: 15,
        nav: true,
        loop: false,
        dots: false,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1200: {
            items: 3
          },
          1366: {
            items: 5
          }
        }
      })
    });
    
</script>

<!-- vendors -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/highlight.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/app.js"></script>

<?php } else { ?>

<div class="container margin-tb-50">
    <div class="site-content">
        <div class="col-mid-75">
            <div class="pageContainer">
                <div class="margin-right">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                    
                    <div class="clear"></div>
                    <div class="clear"></div>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59acd07c7c35fbc8"></script>
                    <div class="addthis_inline_share_toolbox" style="margin-top:20px;"></div>
                    <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
                </div>
            
            </div>
        </div>
        <div class="col-mid-25" style="background-color: #f9f9f9;">
            <div class="sidebar">
                <?php include("sidebar.php"); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php } ?>

<?php get_footer(); ?>


