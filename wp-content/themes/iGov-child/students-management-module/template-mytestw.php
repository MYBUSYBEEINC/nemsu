<?php //Template Name: template-sample ?>
<?php get_header(); ?>


				<div class="entry-content">
					<div class="site-content">
						hello devs 123
					</div>

				</div><!-- .entry-content -->
    
    
				

			<?php comments_template(); ?>

	</div><!-- #primary -->

<?php get_footer(); ?>


    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/owl.theme.default.min.css">
    <!-- javascript -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/jquery.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/owl.carousel.js"></script>

    <script>
     
        $(document).ready(function() {
          var owl = $('.owl-banner');
          owl.owlCarousel({
            margin: 0,
            nav: true,
            loop: false,
        	  dots: false,
            responsive: {
              0: {
                items: 1
              },
              600: {
                items: 1
              },
              1000: {
                items: 1
              }
            }
          })
        });
        
    </script>

    <!-- vendors -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/highlight.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owlcarousel/app.js"></script>
