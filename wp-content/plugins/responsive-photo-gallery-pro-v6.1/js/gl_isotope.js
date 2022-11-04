			// Isotope blog
			var $service_style1 = jQuery('.gallery1');
			
		
          
			
            jQuery(window).load(function () {
                // Initialize Isotope
				
				
				$service_style1.isotope({
                    itemSelector: '.wl-gallery'
                });
				
				
            });
            jQuery(window).smartresize(function () {
               
				$service_style1.isotope('reLayout');
			
            });   

		