<?php
/**
 * Load Saved Responsive Photo Gallery Settings
 */
$PostId                = $post->ID;
$RPGP_Gallery_Settings = "RPGP_Gallery_Settings_" . $PostId;
$RPGP_Gallery_Settings = unserialize( get_post_meta( $PostId, $RPGP_Gallery_Settings, true ) );

if ($RPGP_Gallery_Settings != null) {
    if ($RPGP_Gallery_Settings['WL_Show_Gallery_Title'] && $RPGP_Gallery_Settings['WL_Hover_Color'] && $RPGP_Gallery_Settings['WL_Image_View_Icon']) {
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
} else {
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
}
?>

<script>
    jQuery(document).ready(function () {
        var editor = CodeMirror.fromTextArea(document.getElementById("wl-custom-css"), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,
            hint: true,
            theme: 'blackboard',
            lineWrapping: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
        });
    });
</script>
<style>
    #smoothup {
        height: 50px;
        width: 50px;
        position: fixed;
        bottom: 50px;
        right: 250px;
        text-indent: -9999px;
        display: none;
        background: url("<?php echo RPGP_PLUGIN_URL.'images/up.png'; ?>");
        -webkit-transition-duration: 0.4s;
        -moz-transition-duration: 0.4s;
        transition-duration: 0.4s;
    }

    #smoothup:hover {
        -webkit-transform: rotate(360deg)
    }

    background:

    url
    (
    ''
    )
    no-repeat

    ;
    }
</style>


<input type="hidden" id="wl_rpgp_action" name="wl_rpgp_action" value="wl-rpgp-save-settings">
<table class="form-table">
    <tbody>

    <tr>
        <th scope="row"><label><?php _e( "Show Gallery Title", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Show_Gallery_Title ) ) {
				$WL_Show_Gallery_Title = "yes";
			} ?>
            <input type="radio" name="wl-show-gallery-title" id="wl-show-gallery-title"
                   value="yes" <?php if ( $WL_Show_Gallery_Title == 'yes' ) {
				echo "checked";
			} ?>> <i class="fa fa-check fa-2x"></i>
            <input type="radio" name="wl-show-gallery-title" id="wl-show-gallery-title"
                   value="no" <?php if ( $WL_Show_Gallery_Title == 'no' ) {
				echo "checked";
			} ?>> <i class="fa fa-times fa-2x"></i>
            <p class="description"><?php _e( "Select Yes", RPGP_TEXT_DOMAIN ); ?>
                /<?php _e( "No option to hide or show gallery title", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Show Image Label", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Show_Image_Label ) ) {
				$WL_Show_Image_Label = "yes";
			} ?>
            <input type="radio" name="wl-show-image-label" id="wl-show-image-label"
                   value="yes" <?php if ( $WL_Show_Image_Label == 'yes' ) {
				echo "checked";
			} ?>> <i class="fa fa-check fa-2x"></i>
            <input type="radio" name="wl-show-image-label" id="wl-show-image-label"
                   value="no" <?php if ( $WL_Show_Image_Label == 'no' ) {
				echo "checked";
			} ?>> <i class="fa fa-times fa-2x"></i>
            <p class="description"><?php _e( "Select Yes", RPGP_TEXT_DOMAIN ); ?>
                / <?php _e( "No option to hide or show label on image", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Image Label Position", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Image_Label_Position ) ) {
				$WL_Image_Label_Position = "hover";
			} ?>
            <input type="radio" name="wl-image-label-position" id="wl-image-label-position"
                   value="hover" <?php if ( $WL_Image_Label_Position == 'hover' ) {
				echo "checked";
			} ?>> <?php _e( "On Hover", RPGP_TEXT_DOMAIN ); ?> &nbsp;&nbsp;
            <input type="radio" name="wl-image-label-position" id="wl-image-label-position"
                   value="footer" <?php if ( $WL_Image_Label_Position == 'footer' ) {
				echo "checked";
			} ?>> <?php _e( "On Footer", RPGP_TEXT_DOMAIN ); ?>
            <p class="description"><?php _e( "Select option to show image label on Hover or Footer", RPGP_TEXT_DOMAIN ); ?>
                .</p>

        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Image Hover Animation", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Hover_Animation ) ) {
				$WL_Hover_Animation = "diagonal";
			} ?>
            <select name="wl-hover-animation" id="wl-hover-animation">
                <optgroup label="Select Animation">
                    <option value="fade" <?php if ( $WL_Hover_Animation == 'fade' ) {
						echo "selected=selected";
					} ?>>Fade
                    </option>
                    <option value="stroke" <?php if ( $WL_Hover_Animation == 'stroke' ) {
						echo "selected=selected";
					} ?>>Stroke
                    </option>
                    <option value="flow" <?php if ( $WL_Hover_Animation == 'flow' ) {
						echo "selected=selected";
					} ?>>Flow
                    </option>
                    <option value="box" <?php if ( $WL_Hover_Animation == 'box' ) {
						echo "selected=selected";
					} ?>>Box
                    </option>
                    <option value="stripe" <?php if ( $WL_Hover_Animation == 'stripe' ) {
						echo "selected=selected";
					} ?>>Stripe
                    </option>
                    <option value="apart-horisontal" <?php if ( $WL_Hover_Animation == 'apart-horisontal' ) {
						echo "selected=selected";
					} ?>>Apart Horizontal
                    </option>
                    <option value="apart-vertical" <?php if ( $WL_Hover_Animation == 'apart-vertical' ) {
						echo "selected=selected";
					} ?>>Apart Vertical
                    </option>
                    <option value="diagonal" <?php if ( $WL_Hover_Animation == 'diagonal' ) {
						echo "selected=selected";
					} ?>>Diagonal
                    </option>
                </optgroup>
            </select>
            <p class="description"><?php _e( "Choose an animation effect apply on images after mouse hover", RPGP_TEXT_DOMAIN ); ?>
                .</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Gallery Layout", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Gallery_Layout ) ) {
				$WL_Gallery_Layout = "col-md-6";
			} ?>
            <select name="wl-gallery-layout" id="wl-gallery-layout">
                <optgroup label="Select Gallery Layout">
                    <option value="col-md-12" <?php if ( $WL_Gallery_Layout == 'col-md-12' ) {
						echo "selected=selected";
					} ?>>One Column
                    </option>
                    <option value="col-md-6" <?php if ( $WL_Gallery_Layout == 'col-md-6' ) {
						echo "selected=selected";
					} ?>>Two Column
                    </option>
                    <option value="col-md-4" <?php if ( $WL_Gallery_Layout == 'col-md-4' ) {
						echo "selected=selected";
					} ?>>Three Column
                    </option>
                    <option value="col-md-3" <?php if ( $WL_Gallery_Layout == 'col-md-3' ) {
						echo "selected=selected";
					} ?>>Four Column
                    </option>
                    <option value="col-md-2" <?php if ( $WL_Gallery_Layout == 'col-md-2' ) {
						echo "selected=selected";
					} ?>>Six Column
                    </option>
                </optgroup>
            </select>
            <p class="description"><?php _e( "Choose a column layout for image gallery", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Thumbnail Layout", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Thumbnail_Layout ) ) {
				$WL_Thumbnail_Layout = "same-size";
			} ?>
            <input type="radio" name="wl-thumbnail-layout" id="wl-thumbnail-layout"
                   value="same-size" <?php if ( $WL_Thumbnail_Layout == 'same-size' ) {
				echo "checked";
			} ?>> <?php _e( "Show Same Size Thumbnails", RPGP_TEXT_DOMAIN ); ?>
            <input type="radio" name="wl-thumbnail-layout" id="wl-thumbnail-layout"
                   value="masonry" <?php if ( $WL_Thumbnail_Layout == 'masonry' ) {
				echo "checked";
			} ?>> <?php _e( "Show Masonry Style Thumbnails", RPGP_TEXT_DOMAIN ); ?>
            <input type="radio" name="wl-thumbnail-layout" id="wl-thumbnail-layout"
                   value="original" <?php if ( $WL_Thumbnail_Layout == 'original' ) {
				echo "checked";
			} ?>> <?php _e( "Show Original Image As Thumbnails", RPGP_TEXT_DOMAIN ); ?>
            <p class="description"><?php _e( "Select an option for thumbnail layout setting", RPGP_TEXT_DOMAIN ); ?>
                .</p>
            <p class="description"><?php _e( "If Same Size Thumbnail option selected than minimum image size required in following layouts", RPGP_TEXT_DOMAIN ); ?>
                :</p>
            <p class="description"><?php _e( "Minimum image size required in 1 & 2 Column Gallery Layout", RPGP_TEXT_DOMAIN ); ?>
                : 500x500px</p>
            <p class="description"><?php _e( "Minimum image size required in 3", RPGP_TEXT_DOMAIN ); ?>
                , <?php _e( "4 & 6 Column Gallery Layout", RPGP_TEXT_DOMAIN ); ?>: 400x400px</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Hover Color", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Hover_Color ) ) {
				$WL_Hover_Color = "#0074a2";
			} ?>
            <input id="wl-hover-color" name="wl-hover-color" type="text" value="<?php echo $WL_Hover_Color; ?>"
                   class="my-color-field" data-default-color="#ffffff"/>
            <p class="description"><?php _e( "Choose a Image Hover Color", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Hover Text Color", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Hover_Text_Color ) ) {
				$WL_Hover_Text_Color = "#FFFFFF";
			} ?>
            <input id="wl-hover-text-color" name="wl-hover-text-color" type="text"
                   value="<?php echo $WL_Hover_Text_Color; ?>" class="my-color-field" data-default-color="#ffffff"/>
            <p class="description"><?php _e( "Choose a Image Hover Text Color", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Footer Text Color", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Footer_Text_Color ) ) {
				$WL_Footer_Text_Color = "#000000";
			} ?>
            <input id="wl-footer-text-color" name="wl-footer-text-color" type="text"
                   value="<?php echo $WL_Footer_Text_Color; ?>" class="my-color-field" data-default-color="#ffffff"/>
            <p class="description"><?php _e( "Choose a Color for Footer Text", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Hover Icon Color", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Icon_Color ) ) {
				$WL_Icon_Color = "#FFFFFF";
			} ?>
            <input id="wl-icon-color" name="wl-icon-color" type="text" value="<?php echo $WL_Icon_Color; ?>"
                   class="my-color-field" data-default-color="#ffffff"/>
            <p class="description"><?php _e( "Choose a Color for Icon", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Hover Color Opacity", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Hover_Color_Opacity ) ) {
				$WL_Hover_Color_Opacity = "0.5";
			} ?>
            <select name="wl-hover-color-opacity" id="wl-hover-color-opacity">
                <optgroup label="Select Color Opacity">
                    <option value="1" <?php if ( $WL_Hover_Color_Opacity == '1' ) {
						echo "selected=selected";
					} ?>>1
                    </option>
                    <option value="0.9" <?php if ( $WL_Hover_Color_Opacity == '0.9' ) {
						echo "selected=selected";
					} ?>>0.9
                    </option>
                    <option value="0.8" <?php if ( $WL_Hover_Color_Opacity == '0.8' ) {
						echo "selected=selected";
					} ?>>0.8
                    </option>
                    <option value="0.7" <?php if ( $WL_Hover_Color_Opacity == '0.7' ) {
						echo "selected=selected";
					} ?>>0.7
                    </option>
                    <option value="0.6" <?php if ( $WL_Hover_Color_Opacity == '0.6' ) {
						echo "selected=selected";
					} ?>>0.6
                    </option>
                    <option value="0.5" <?php if ( $WL_Hover_Color_Opacity == '0.5' ) {
						echo "selected=selected";
					} ?>>0.5
                    </option>
                    <option value="0.4" <?php if ( $WL_Hover_Color_Opacity == '0.4' ) {
						echo "selected=selected";
					} ?>>0.4
                    </option>
                    <option value="0.3" <?php if ( $WL_Hover_Color_Opacity == '0.3' ) {
						echo "selected=selected";
					} ?>>0.3
                    </option>
                    <option value="0.2" <?php if ( $WL_Hover_Color_Opacity == '0.2' ) {
						echo "selected=selected";
					} ?>>0.2
                    </option>
                    <option value="0.1" <?php if ( $WL_Hover_Color_Opacity == '0.1' ) {
						echo "selected=selected";
					} ?>>0.1
                    </option>
                </optgroup>
            </select>
            <p class="description"><?php _e( "Choose hover color opacity on images", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Caption Font Style", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
            <select name="wl-font-style" class="standard-dropdown" id="wl-font-style">
                <optgroup label="Default Fonts">
                    <option value="Arial" <?php selected( $WL_Font_Style, 'Arial' ); ?>>Arial</option>
                    <option value="Arial Black" <?php selected( $WL_Font_Style, 'Arial Black' ); ?>>Arial Black</option>
                    <option value="Courier New" <?php selected( $WL_Font_Style, 'Courier New' ); ?>>Courier New</option>
                    <option value="Georgia" <?php selected( $WL_Font_Style, 'Georgia' ); ?>>Georgia</option>
                    <option value="Grande"<?php selected( $WL_Font_Style, 'Grande' ); ?>>Grande</option>
                    <option value="Helvetica Neue" <?php selected( $WL_Font_Style, 'Helvetica Neue' ); ?>>Helvetica
                        Neue
                    </option>
                    <option value="Impact" <?php selected( $WL_Font_Style, 'Impact' ); ?>>Impact</option>
                    <option value="Lucida" <?php selected( $WL_Font_Style, 'Lucida' ); ?>>Lucida</option>
                    <option value="Lucida Console"<?php selected( $WL_Font_Style, 'Lucida Console' ); ?>>Lucida
                        Console
                    </option>
                    <option value="Open Sans" <?php selected( $WL_Font_Style, 'Open Sans' ); ?>>Open Sans</option>
                    <option value="Palatino" <?php selected( $WL_Font_Style, 'Palatino' ); ?>>Palatino</option>
                    <option value="sans" <?php selected( $WL_Font_Style, 'sans' ); ?>>Sans</option>
                    <option value="sans-serif" <?php selected( $WL_Font_Style, 'sans-serif' ); ?>>Sans-Serif</option>
                    <option value="Tahoma" <?php selected( $WL_Font_Style, 'Tahoma' ); ?>>Tahoma</option>
                    <option value="Times New Roman"<?php selected( $WL_Font_Style, 'Times New Roman' ); ?>>Times New
                        Roman
                    </option>
                    <option value="Trebuchet MS" <?php selected( $WL_Font_Style, 'Trebuchet MS' ); ?>>Trebuchet MS
                    </option>
                    <option value="Verdana" <?php selected( $WL_Font_Style, 'Verdana' ); ?>>Verdana</option>
                </optgroup>
                <optgroup label="Google Fonts">
					<?php
					// fetch the Google font list

					$google_api_url    = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAccXEBQEkF2rMcxcanpJKQ6y9n2lz6avM';
					$response_font_api = wp_remote_retrieve_body( wp_remote_get( $google_api_url, array( 'sslverify' => false ) ) );
					if ( ! is_wp_error( $response_font_api ) ) {
						$fonts_list = json_decode( $response_font_api, true );
						// that's it
						if ( is_array( $fonts_list ) ) {
							$g_fonts = $fonts_list['items'];
							foreach ( $g_fonts as $g_font ) {
								$font_name = $g_font['family']; ?>
                                <option
                                value="<?php echo $font_name; ?>" <?php selected( $WL_Font_Style, $font_name ); ?>><?php echo $font_name; ?></option><?php
							}
						} else {
							echo "<option disabled>Error to fetch Google fonts.</option>";
							echo "<option disabled>Google font will not available in offline mode.</option>";
						}
					}
					?>
                </optgroup>
            </select>
            <p class="description"><?php _e( "Choose a caption font style", RPGP_TEXT_DOMAIN ); ?>.</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Light Box Styles", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Light_Box ) ) {
				$WL_Light_Box = "lightbox2";
			} ?>
            <select name="wl-light-box" id="wl-light-box">
                <optgroup label="Select Light Box Styles">
                    <option value="lightbox1" <?php if ( $WL_Light_Box == 'lightbox1' ) {
						echo "selected=selected";
					} ?>>Nivo Box
                    </option>
                    <option value="lightbox2" <?php if ( $WL_Light_Box == 'lightbox2' ) {
						echo "selected=selected";
					} ?>>Photobox
                    </option>
                    <option value="lightbox3" <?php if ( $WL_Light_Box == 'lightbox3' ) {
						echo "selected=selected";
					} ?>>Pretty photo
                    </option>
                    <option value="lightbox4" <?php if ( $WL_Light_Box == 'lightbox4' ) {
						echo "selected=selected";
					} ?>>Swipe Box
                    </option>
                </optgroup>
            </select>
            <p class="description"><?php _e( "Choose a image light box style for large preview after click on an image", RPGP_TEXT_DOMAIN ); ?>
                .</p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Show Lightbox on icon", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Show_Image_Lightbox ) ) {
				$WL_Show_Image_Lightbox = "yes";
			} ?>
            <input type="radio" name="wl-show-image-lightbox" id="wl-show-image-lightbox"
                   value="yes" <?php if ( $WL_Show_Image_Lightbox == 'yes' ) {
				echo "checked";
			} ?>> <i class="fa fa-check fa-2x"></i>
            <input type="radio" name="wl-show-image-lightbox" id="wl-show-image-lightbox"
                   value="no" <?php if ( $WL_Show_Image_Lightbox == 'no' ) {
				echo "checked";
			} ?>> <i class="fa fa-times fa-2x"></i>
            <p class="description"><?php _e( "Select Yes if show lightbox on icon or select No if want show lightbox on image click", RPGP_TEXT_DOMAIN ); ?></p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Image View Icon", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Image_View_Icon ) ) {
				$WL_Image_View_Icon = "fa-camera";
			} ?>
            <input type="text" name="wl-image-view-icon" id="wl-image-view-icon"
                   value="<?php echo $WL_Image_View_Icon; ?>">
            <p class="description"><?php _e( "Choose an image view icon class within the 946 new FREE font awesome icons", RPGP_TEXT_DOMAIN ); ?>
                : <a href="https://fontawesome.com/icons?d=gallery&m=free"
                     target="_blank"><?php _e( "Get Icon", RPGP_TEXT_DOMAIN ); ?></a></p>
            <p class="description"><?php _e( "How to get icon class?", RPGP_TEXT_DOMAIN ); ?> <a
                        href="https://www.youtube.com/watch?v=qEQ_YqhmzcI"
                        target="_blank"><?php _e( "Watch This Video", RPGP_TEXT_DOMAIN ); ?></a></p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label><?php _e( "Icon Size", RPGP_TEXT_DOMAIN ); ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Image_View_Icon_Size ) ) {
				$WL_Image_View_Icon_Size = "fa-3x";
			} ?>
            <input type="radio" name="wl-image-view-icon-size" id="wl-image-view-icon-size"
                   value="fa-lg" <?php if ( $WL_Image_View_Icon_Size == 'fa-lg' ) {
				echo "checked";
			} ?>> <i class="<?php echo $WL_Image_View_Icon; ?> fa-lg"></i>
            <input type="radio" name="wl-image-view-icon-size" id="wl-image-view-icon-size"
                   value="fa-2x" <?php if ( $WL_Image_View_Icon_Size == 'fa-2x' ) {
				echo "checked";
			} ?>> <i class="<?php echo $WL_Image_View_Icon; ?> fa-2x"></i>
            <input type="radio" name="wl-image-view-icon-size" id="wl-image-view-icon-size"
                   value="fa-3x" <?php if ( $WL_Image_View_Icon_Size == 'fa-3x' ) {
				echo "checked";
			} ?>> <i class="<?php echo $WL_Image_View_Icon; ?> fa-3x"></i>
            <input type="radio" name="wl-image-view-icon-size" id="wl-image-view-icon-size"
                   value="fa-4x" <?php if ( $WL_Image_View_Icon_Size == 'fa-4x' ) {
				echo "checked";
			} ?>> <i class="<?php echo $WL_Image_View_Icon; ?> fa-4x"></i>
            <input type="radio" name="wl-image-view-icon-size" id="wl-image-view-icon-size"
                   value="fa-5x" <?php if ( $WL_Image_View_Icon_Size == 'fa-5x' ) {
				echo "checked";
			} ?>> <i class="<?php echo $WL_Image_View_Icon; ?> fa-5x"></i>
            <p class="description"><?php _e( "Choose image view icon Size", RPGP_TEXT_DOMAIN ); ?>
                . <?php _e( "Click", RPGP_TEXT_DOMAIN ); ?> <a href="http://fortawesome.github.io/Font-Awesome/icons/"
                                                               target="_blank"><?php _e( "here", RPGP_TEXT_DOMAIN ); ?></a> <?php _e( "to find out more icon names", RPGP_TEXT_DOMAIN ); ?>
                .</p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label><?php _e( 'Custom CSS', 'RPGP_TEXT_DOMAIN' ) ?></label></th>
        <td>
			<?php if ( ! isset( $WL_Custom_Css ) ) {
				$WL_Custom_Css = "";
			} ?>
            <textarea id="wl-custom-css" name="wl-custom-css" type="text" class=""
                      style="width:80%"><?php echo $WL_Custom_Css; ?></textarea>
            <p class="description">
				<?php _e( 'Enter any custom css you want to apply on this gallery.', 'RPGP_TEXT_DOMAIN' ) ?>
            </p>
            <p class="custnote"><?php _e( "Note", RPGP_TEXT_DOMAIN ); ?>
                : <?php _e( "Please Do Not Use", RPGP_TEXT_DOMAIN ); ?>
                <b><?php _e( "Style", RPGP_TEXT_DOMAIN ); ?></b> <?php _e( "Tag With Custom CSS", RPGP_TEXT_DOMAIN ); ?>
            </p>
        </td>
    </tr>
    </tbody>
</table>
<script>
    jQuery(document).ready(function ($) {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() < 200) {
                jQuery('#smoothup').fadeOut();
            } else {
                jQuery('#smoothup').fadeIn();
            }
        });
        jQuery('#smoothup').on('click', function () {
            jQuery('html, body').animate({scrollTop: 0}, 'fast');
            return false;
        });
    });
</script>
<a href="#top" id="smoothup" title="Back to top"></a>