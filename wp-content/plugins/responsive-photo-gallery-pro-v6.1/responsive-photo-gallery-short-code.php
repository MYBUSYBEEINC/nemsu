<?php
add_shortcode( 'RPG', 'ResponsivePhotoGalleryProShortCode' );
function ResponsivePhotoGalleryProShortCode( $Id ) {

	ob_start();
	/**
	 * Load Saved Responsive Photo Gallery Settings
	 */
	if ( ! isset( $Id['id'] ) ) {
		$Id['id']                = "";
		$WL_Show_Gallery_Title   = "yes";
		$WL_Show_Image_Label     = "yes";
		$WL_Image_Label_Position = "hover";
		$WL_Hover_Animation      = "fade";
		$WL_Gallery_Layout       = "col-md-6";
		$WL_Thumbnail_Layout     = "same-size";
		$WL_Hover_Color          = "#31A3DD";
		$WL_Hover_Text_Color     = "#FFFFFF";
		$WL_Footer_Text_Color    = "#000000";
		$WL_Icon_Color           = "#FFFFFF";
		$WL_Hover_Color_Opacity  = 0.5;
		$WL_Font_Style           = "font-name";
		$WL_Image_View_Icon      = "fas fa-camera";
		$WL_Image_View_Icon_Size = "fa-3x";
		$WL_Light_Box            = "lightbox2";
		$WL_Show_Image_Lightbox  = "yes";
		$WL_Custom_Css           = "";
	} else {
		$RPGP_Id               = $Id['id'];
		$RPGP_Gallery_Settings = "RPGP_Gallery_Settings_" . $RPGP_Id;
		$RPGP_Gallery_Settings = unserialize( get_post_meta( $RPGP_Id, $RPGP_Gallery_Settings, true ) );
		if ( count( $RPGP_Gallery_Settings ) ) {
			$WL_Show_Gallery_Title   = $RPGP_Gallery_Settings['WL_Show_Gallery_Title'];
			$WL_Show_Image_Label     = $RPGP_Gallery_Settings['WL_Show_Image_Label'];
			$WL_Image_Label_Position = $RPGP_Gallery_Settings['WL_Image_Label_Position'];
			$WL_Hover_Animation      = $RPGP_Gallery_Settings['WL_Hover_Animation'];
			$WL_Gallery_Layout       = $RPGP_Gallery_Settings['WL_Gallery_Layout'];
			$WL_Thumbnail_Layout     = $RPGP_Gallery_Settings['WL_Thumbnail_Layout'];
			$WL_Hover_Color          = $RPGP_Gallery_Settings['WL_Hover_Color'];
			$WL_Hover_Text_Color     = $RPGP_Gallery_Settings['WL_Hover_Text_Color'];
			$WL_Footer_Text_Color    = $RPGP_Gallery_Settings['WL_Footer_Text_Color'];
			$WL_Icon_Color           = $RPGP_Gallery_Settings['WL_Icon_Color'];
			$WL_Hover_Color_Opacity  = $RPGP_Gallery_Settings['WL_Hover_Color_Opacity'];
			$WL_Font_Style           = $RPGP_Gallery_Settings['WL_Font_Style'];
			$WL_Image_View_Icon      = $RPGP_Gallery_Settings['WL_Image_View_Icon'];
			$WL_Image_View_Icon_Size = $RPGP_Gallery_Settings['WL_Image_View_Icon_Size'];
			$WL_Light_Box            = $RPGP_Gallery_Settings['WL_Light_Box'];
			$WL_Show_Image_Lightbox  = $RPGP_Gallery_Settings['WL_Show_Image_Lightbox'];
			$WL_Custom_Css           = $RPGP_Gallery_Settings['WL_Custom_Css'];
		}
	}

	$RGB           = RPGhex2rgb( $WL_Hover_Color );
	$HoverColorRGB = implode( ", ", $RGB );
	?>

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>


    <style>
        #weblizar_<?php echo $RPGP_Id; ?> .rpgp-header-label {
            color: <?php echo $WL_Hover_Text_Color; ?> !important;
        }

        #weblizar_<?php echo $RPGP_Id; ?> .rpgp-footer-label {
            color: <?php echo $WL_Footer_Text_Color; ?> !important;
            font-size: 16px;
            margin-bottom: 5px;
            margin-top: 5px;
            text-align: center;
            font-weight: normal;
        }

        #weblizar_<?php echo $RPGP_Id; ?> .fa {
            color: <?php echo $WL_Icon_Color; ?> !important;
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-wrapper p a i {
            color: <?php echo $WL_Icon_Color?> !important;
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-fade .b-wrapper, #weblizar_<?php echo $RPGP_Id; ?> .b-link-fade .b-top-line {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-flow .b-wrapper, #weblizar_<?php echo $RPGP_Id; ?> .b-link-flow .b-top-line {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-stroke .b-top-line {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-stroke .b-bottom-line {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-box .b-top-line {

            border: 16px solid rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-box .b-bottom-line {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-stripe .b-line {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-apart-horisontal .b-top-line, #weblizar_<?php echo $RPGP_Id; ?> .b-link-apart-horisontal .b-top-line-up {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);

        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-apart-horisontal .b-bottom-line, #weblizar_<?php echo $RPGP_Id; ?> .b-link-apart-horisontal .b-bottom-line-up {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-apart-vertical .b-top-line, #weblizar_<?php echo $RPGP_Id; ?> .b-link-apart-vertical .b-top-line-up {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-apart-vertical .b-bottom-line, #weblizar_<?php echo $RPGP_Id; ?> .b-link-apart-vertical .b-bottom-line-up {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-link-diagonal .b-line {
            background: rgba(<?php echo $HoverColorRGB; ?>, <?php echo $WL_Hover_Color_Opacity; ?>);
        }

        #weblizar_<?php echo $RPGP_Id; ?> .b-wrapper {
            font-family: <?php echo str_ireplace("+", " ", $WL_Font_Style); ?>;
        / / real name pass here
        }

        #weblizar_<?php echo $RPGP_Id; ?> .rpgp-header-label {
            font-family: <?php echo str_ireplace("+", " ", $WL_Font_Style); ?> !important;
        / / real name pass here
        }

        #weblizar_<?php echo $RPGP_Id; ?> .rpgp-footer-label {
            font-family: <?php echo str_ireplace("+", " ", $WL_Font_Style); ?> !important;
        / / real name pass here
        }

        @media (min-width: 992px) {
            .col-md-6 {
                width: 49.97% !important;
            }

            .col-md-4 {
                width: 33.30% !important;
            }

            .col-md-3 {
                width: 24.90% !important;
            }
        }

        <?php if ($WL_Image_Label_Position == "hover"){ ?>
        @media (max-width: 992px) {
            #weblizar_<?php echo $RPGP_Id; ?> .rpgp-header-label {
                display: none;
            }
        }

        @media (min-width: 993px) {
            #weblizar_<?php echo $RPGP_Id; ?> .rpgp-footer-label {
                display: none;
            }
        }

        <?php }else { ?>
        #weblizar_<?php echo $RPGP_Id; ?> .rpgp-header-label {
            display: none;
        }

        <?php }?>
        #weblizar_<?php echo $RPGP_Id; ?> a {
            border-bottom: none;
        }

        .rpgp-gallery-head {
            font-weight: bolder;
            padding-bottom: 10px;
            border-bottom: 2px solid #cccccc;
            margin-bottom: 20px;
            font-size: 24px;
            font-family: <?php echo $WL_Font_Style; ?>;
        }

        #swipebox-caption {
            font-family: <?php echo $WL_Font_Style; ?>;
        }

        <?php echo $WL_Custom_Css; ?>
    </style>

	<?php

	/**
	 * Load All Image Gallery Custom Post Type
	 */
	$IG_CPT_Name  = "rpgp_gallery";
	$AllGalleries = array( 'p' => $Id['id'], 'post_type' => $IG_CPT_Name, 'orderby' => 'ASC' );
	$loop         = new WP_Query( $AllGalleries );
	?>
    <div class="gal-container <?php if ( $WL_Light_Box == "lightbox2" ) {
		echo "photobox-lightbox_$RPGP_Id";
	} ?> ">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <!--get the post id-->
			<?php $post_id = get_the_ID(); ?>

			<?php if ( $WL_Show_Gallery_Title == "yes" ) { ?>
                <!-- gallery title -->
                <div class="rpgp-gallery-head">
					<?php echo get_the_title( $post_id ); ?>
                </div>
			<?php } ?>

            <div class="gallery1" id="weblizar_<?php echo get_the_ID(); ?>">
				<?php
				/**
				 * Get All Photos from Gallery Details Post Meta
				 */
				get_the_ID();
				$RPGP_AllPhotosDetails = unserialize( base64_decode( get_post_meta( get_the_ID(), 'rpgp_all_photos_details', true ) ) );
				$TotalImages           = get_post_meta( get_the_ID(), 'rpgp_total_images_count', true );
				$i                     = 1;

				foreach ( $RPGP_AllPhotosDetails as $RPGP_SinglePhotoDetails ) {
					$name     = $RPGP_SinglePhotoDetails['rpgp_image_label'];
					$url      = $RPGP_SinglePhotoDetails['rpgp_image_url'];
					$url_full = $RPGP_SinglePhotoDetails['rpgp_image_url'];
					$url1     = $RPGP_SinglePhotoDetails['rpgp_12_thumb'];
					$url2     = $RPGP_SinglePhotoDetails['rpgp_346_thumb'];
					$url3     = $RPGP_SinglePhotoDetails['rpgp_12_same_size_thumb'];
					$url4     = $RPGP_SinglePhotoDetails['rpgp_346_same_size_thumb'];
					$i ++;

					if ( $WL_Gallery_Layout == "col-md-12" ) { // one column
						$Thummb_Url = $url;
					}
					if ( $WL_Gallery_Layout == "col-md-6" ) { // two column
						if ( $WL_Thumbnail_Layout == "same-size" ) {
							$Thummb_Url = $url3;
						}
						if ( $WL_Thumbnail_Layout == "masonry" ) {
							$Thummb_Url = $url1;
						}
						if ( $WL_Thumbnail_Layout == "original" ) {
							$Thummb_Url = $url;
						}
					}
					if ( $WL_Gallery_Layout == "col-md-4" || $WL_Gallery_Layout == "col-md-3" || $WL_Gallery_Layout == "col-md-2" ) {// 3 4 6 column
						if ( $WL_Thumbnail_Layout == "same-size" ) {
							$Thummb_Url = $url4;
						}
						if ( $WL_Thumbnail_Layout == "masonry" ) {
							$Thummb_Url = $url2;
						}
						if ( $WL_Thumbnail_Layout == "original" ) {
							$Thummb_Url = $url;
						}
					}

					?>
                    <div class="<?php echo $WL_Gallery_Layout; ?> col-sm-6 wl-gallery swipebox ">
                        <div class="b-link-<?php echo $WL_Hover_Animation; ?> b-animate-go">
							<?php if ( $WL_Show_Image_Lightbox == "yes" ) { ?>
                                <img src="<?php echo $Thummb_Url; ?>" class="gall-img-responsive"
                                     alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>">
                                <div class="b-wrapper">
									<?php if ( $WL_Gallery_Layout == "col-md-12" || $WL_Gallery_Layout == "col-md-6" || $WL_Gallery_Layout == "col-md-4" ) { ?>
										<?php if ( $WL_Show_Image_Label == "yes" ) { ?>
                                            <h2 class="b-from-left b-animate b-delay03">
                                                <div class=" rpgp-header-label"><?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?></div>
                                            </h2>
										<?php } ?>
									<?php }
									//photobox
									if ( $WL_Light_Box == "lightbox2" ) { ?>
                                        <p class="b-from-right b-animate b-delay03">
                                            <a href="<?php echo $url; ?>"
                                               alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>">
                                                <i class="<?php echo $WL_Image_View_Icon; ?> <?php echo $WL_Image_View_Icon_Size; ?>"></i>
                                                <img src="<?php echo $Thummb_Url; ?>" class="gall-img-responsive"
                                                     style="display:none !important; visibility:hidden"
                                                     alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>">
                                            </a>
                                        </p>
										<?php
									}
									//nivo box
									if ( $WL_Light_Box == "lightbox1" ) {
										?>
                                        <p class="b-from-right b-animate b-delay03">
                                            <a data-lightbox-gallery="enigma_lightbox"
                                               alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                               class="nivoz_<?php echo $RPGP_Id; ?>" href="<?php echo $url_full; ?>">
                                                <i class="<?php echo $WL_Image_View_Icon; ?> <?php echo $WL_Image_View_Icon_Size; ?>"></i>
                                            </a>
                                        </p>
										<?php
									}

									// 3 - pretty photo Box
									if ( $WL_Light_Box == "lightbox3" ) { ?>
                                        <p class="b-from-right b-animate b-delay03">
                                            <a class="portfolio-zoom icon-resize-full"
                                               data-rel="prettyPhoto_<?php echo $RPGP_Id; ?>[portfolio]"
                                               alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                               href="<?php echo $url; ?>">
                                                <i class="<?php echo $WL_Image_View_Icon; ?> <?php echo $WL_Image_View_Icon_Size; ?>"></i>
                                            </a>
                                        </p>  <?php
									}

									// 4 - Swipe Box
									if ( $WL_Light_Box == "lightbox4" ) { ?>
                                        <p class="b-from-right b-animate b-delay03">
                                            <a title="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                               alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                               class="swipebox_<?php echo $RPGP_Id; ?>" href="<?php echo $url_full; ?>">
                                                <i class="<?php echo $WL_Image_View_Icon; ?> <?php echo $WL_Image_View_Icon_Size; ?>"></i>
                                            </a>
                                        </p> <?php
									} ?>
                                </div>
								<?php
							} else {
								//photobox
								if ( $WL_Light_Box == "lightbox2" ) { ?>
                                    <a href="<?php echo $url; ?>"
                                       alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>">
                                        <img src="<?php echo $Thummb_Url; ?>" class="gall-img-responsive"
                                             alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>">
                                        <div class="b-wrapper"> <?php
											if ( $WL_Gallery_Layout == "col-md-12" || $WL_Gallery_Layout == "col-md-6" || $WL_Gallery_Layout == "col-md-4" ) { ?>
												<?php if ( $WL_Show_Image_Label == "yes" ) { ?>
                                                    <h2 class="b-from-left b-animate b-delay03 rpgp-header-label"><?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?> </h2>
												<?php } ?>
											<?php } ?>
                                        </div>
                                    </a>
									<?php
								}

								// nivobox
								if ( $WL_Light_Box == "lightbox1" ) {
									?>
                                    <a data-lightbox-gallery="enigma_lightbox"
                                       alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                       class="nivoz_<?php echo $RPGP_Id; ?>" href="<?php echo $url; ?>">
                                        <img src="<?php echo $Thummb_Url; ?>" class="gall-img-responsive"
                                             alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>">
                                        <div class="b-wrapper">
											<?php if ( $WL_Gallery_Layout == "col-md-12" || $WL_Gallery_Layout == "col-md-6" || $WL_Gallery_Layout == "col-md-4" ) { ?>
												<?php if ( $WL_Show_Image_Label == "yes" ) { ?>
                                                    <h2 class="b-from-left b-animate b-delay03 rpgp-header-label"><?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?> </h2>
												<?php } ?>
											<?php }
											?>
                                        </div>
                                    </a>
									<?php
								}

								// pretty photo
								if ( $WL_Light_Box == "lightbox3" ) {
									?>
                                    <a class="portfolio-zoom icon-resize-full"
                                       data-rel="prettyPhoto_<?php echo $RPGP_Id; ?>[portfolio]"
                                       alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                       href="<?php echo $url; ?>">
                                        <img src="<?php echo $Thummb_Url; ?>" class="gall-img-responsive"
                                             alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>">
                                        <div class="b-wrapper">
											<?php if ( $WL_Gallery_Layout == "col-md-12" || $WL_Gallery_Layout == "col-md-6" || $WL_Gallery_Layout == "col-md-4" ) { ?>
												<?php if ( $WL_Show_Image_Label == "yes" ) { ?>
                                                    <h2 class="b-from-left b-animate b-delay03 rpgp-header-label"><?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?> </h2>
												<?php } ?>
											<?php }
											?>
                                        </div>
                                    </a>
									<?php
								}

								// swipe box
								if ( $WL_Light_Box == "lightbox4" ) {
									?>
                                    <div id="swipebox-title">
                                        <a title="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                           alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                           class="swipebox_<?php echo $RPGP_Id; ?>" href="<?php echo $url; ?>">
                                            <img src="<?php echo $url_full; ?>" class="gall-img-responsive"
                                                 alt="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                                 title="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>">
                                            <div class="b-wrapper">
												<?php if ( $WL_Gallery_Layout == "col-md-12" || $WL_Gallery_Layout == "col-md-6" || $WL_Gallery_Layout == "col-md-4" ) { ?>
													<?php if ( $WL_Show_Image_Label == "yes" ) { ?>
                                                        <h2 class="b-from-left b-animate b-delay03 rpgp-header-label"><?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?> </h2>
													<?php } ?>
												<?php }
												?>
                                            </div>
                                        </a>
                                    </div>
									<?php
								}
							}
							?>
                        </div>
						<?php if ( $WL_Show_Image_Label == "yes" ) { ?>
                            <h4 class="rpgp-footer-label"><?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?></h4>
						<?php } ?>
                    </div>
					<?php
				}
				?>
            </div>
		<?php endwhile; ?>
    </div>

	<?php if ( $WL_Light_Box == "lightbox2" ) { ?>
        <script>
            jQuery('.photobox-lightbox_<?php echo $RPGP_Id; ?>').photobox('a');
            // or with a fancier selector and some settings, and a callback:
            jQuery('.photobox-lightbox_<?php echo $RPGP_Id; ?>').photobox('a:first', {
                thumbs: false,
                time: 0
            }, imageLoaded);

            function imageLoaded() {
                console.log('image has been loaded...');
            }
        </script>
	<?php } ?>

	<?php if ( $WL_Light_Box == "lightbox3" ) { ?>
        <script>
            jQuery(document).ready(function () {
                jQuery("a[data-rel^='prettyPhoto_<?php echo $RPGP_Id; ?>']").prettyPhoto({
                    animation_speed: 'fast', /* fast/slow/normal */
                    slideshow: 2000, /* false OR interval time in ms */
                    autoplay_slideshow: false, /* true/false */
                    opacity: 0.80  /* Value between 0 and 1 */
                });
            });
        </script>
	<?php } ?>

    <!-- swipe box-->
	<?php if ( $WL_Light_Box == "lightbox4" ) { ?>
        <script type="text/javascript">
            ;(function (jQuery) {
                jQuery('.swipebox_<?php echo $RPGP_Id; ?>').swipebox({
                    useCSS : true, // false will force the use of jQuery for animations</span>
                    useSVG : true, // false to force the use of png for buttons</span>
                    initialIndexOnArray : 0, // which image index to init when a array is passed</span>
                    hideCloseButtonOnMobile : false, // true will hide the close button on mobile devices</span>
                    removeBarsOnMobile : true, // false will show top bar on mobile devices</span>
                    hideBarsDelay : 3000, // delay before hiding bars on desktop</span>
                    videoMaxWidth : 1140, // videos max width</span>
                    beforeOpen: function() {}, // called before opening</span>
                    afterOpen: null, // called after opening</span>
                    afterClose: function() {}, // called after closing</span>
                    loopAtEnd: false // true will return to the first image after the last image is reached</span>
                });
            })(jQuery);
        </script>
	<?php }
	if ( $WL_Light_Box == "lightbox1" ) { ?>
        <script>
            jQuery(document).ready(function () {
                jQuery('.nivoz_<?php echo $RPGP_Id; ?>').nivoLightbox();
            });
        </script>
		<?php
	}
	?>

	<?php wp_reset_query();

	return ob_get_clean();
}

?>