jQuery(document).ready(function() {	/* MENU JS */	if( jQuery(window).width() > 767) {		   jQuery('.nav li.dropdown').hover(function() {			   jQuery(this).addClass('open');		   }, function() {			   jQuery(this).removeClass('open');		   }); 		   jQuery('.nav li.dropdown-menu').hover(function() {			   jQuery(this).addClass('open');		   }, function() {			   jQuery(this).removeClass('open');		   }); 		}				jQuery('.nav li.dropdown').find('i').each(function(){			jQuery(this).on('click', function(){				if( jQuery(window).width() < 768) {					jQuery(this).parent().next().slideToggle();				}				return false;			});		});});			/* MENU JS */jQuery(document).ready(function() {				/* Home Slider */	/*  var swiper = new Swiper('.home-slider', {        pagination: '.slider-page',		nextButton: '.slider-next',        prevButton: '.slider-prev',        slidesPerView: '1',        paginationClickable: true,        spaceBetween: 30,		autoplay: 2500,		//loop:true    }); */	/* Home Slider */			/* Home Timing */	 /* var swiper = new Swiper('.home-timing', {		nextButton: '.home-timing-next',        prevButton: '.home-timing-prev',        slidesPerView: '1',        paginationClickable: true,        spaceBetween: 10,		//autoplay: 2500,		//loop:true,		/* breakpoints: {            1024: {                slidesPerView: 5,                spaceBetween: 10            },            768: {                slidesPerView: 4,                spaceBetween: 10            },            640: {                slidesPerView: 3,                spaceBetween: 10            },            480: {                slidesPerView: 2,                spaceBetween: 10            },			320: {                slidesPerView: 2,                spaceBetween: 10            }        }     }); */	/* Home Timing */});jQuery(document).ready(function () {    jQuery("#groups").change(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#sub_groups").change(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#step1_next").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepback2").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepnext2").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepback3").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepnext3").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepback4").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepnext4").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepback5").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepnext5").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#stepback6").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(2500);	    });});jQuery(document).ready(function () {    jQuery("#ap-new").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(1000);	    });});jQuery(document).ready(function () {    jQuery("#ap-existing").click(function () {		jQuery("#change-loader").show();		jQuery("#change-loader").fadeOut(1000);	    });});	function myFunction() {		jQuery('.service').focus();		}				function myFunction1() {		jQuery('.ap-date').focus();		}jQuery.noConflict()(function (jQuery) { 	jQuery(document).ready(function() {			jQuery(window).preloader({			delay: 1500		});	});});jQuery.noConflict()(function (jQuery) {	jQuery(document).ready(function() {			jQuery("#appointment-scheduler-staff-carousel").owlCarousel({				items: 1,				slideSpeed: 500,				 pagination: false,				//paginationSpeed: 400,				singleItem: true,				loop: true,				autoPlay: true,				autoPlaySpeed: 500,				autoPlayTimeout: 100,				autoPlayHoverPause: true,			});	});});