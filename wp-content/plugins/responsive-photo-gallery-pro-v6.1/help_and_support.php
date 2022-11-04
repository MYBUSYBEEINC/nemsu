<div>
    <center><h2 class="head_title"><?php _e( 'Responsive Photo Gallery Pro', RPGP_TEXT_DOMAIN ); ?></h2></center>
    <center>
        <h3 class="head_desc"><?php _e( 'Responsive Portfolio Pro allow you to add unlimited images galleries integrated with various light box', RPGP_TEXT_DOMAIN ); ?>
            , <?php _e( 'animation hover effects', RPGP_TEXT_DOMAIN ); ?>
            , <?php _e( 'font styles', RPGP_TEXT_DOMAIN ); ?>, <?php _e( 'icons', RPGP_TEXT_DOMAIN ); ?>
            , <?php _e( 'colors', RPGP_TEXT_DOMAIN ); ?>.</h3></center>
</div>
<p class="well"><?php _e( 'View Support Docs or Open a Ticket', RPGP_TEXT_DOMAIN ); ?></p>
<h4 class="para"><a href="https://weblizar.com/forum/" target="_new"
                    class="btn btn-primary btn-lg"><?php _e( 'Click Here', '' ) ?></a></h4>

<p class="well"><?php _e( 'Rate Us', RPGP_TEXT_DOMAIN ); ?></p>
<h4 class="para"><?php _e( 'If you are enjoying using our', RPGP_TEXT_DOMAIN ); ?> <b>Responsive Photo Gallery Pro
    </b> <?php _e( 'plugin and find it useful', RPGP_TEXT_DOMAIN ); ?>
    , <?php _e( 'then please consider writing a positive feedback', RPGP_TEXT_DOMAIN ); ?>
    . <?php _e( 'Your feedback will help us to encourage and support the plugin continued development and better user support', RPGP_TEXT_DOMAIN ); ?>
    .</h4>
<div style="background:#EF4238;display:inline-block;margin-left: 30px;">
    <a class="acl-rate-us" style="text-align:center; text-decoration: none;font:normal 30px; "
       href="https://wordpress.org/plugins/responsive-photo-gallery/#reviews" target="_blank">
        <span class="dashicons dashicons-star-filled"></span>
        <span class="dashicons dashicons-star-filled"></span>
        <span class="dashicons dashicons-star-filled"></span>
        <span class="dashicons dashicons-star-filled"></span>
        <span class="dashicons dashicons-star-filled"></span>
    </a>
</div>
<p class="well"><?php _e( 'Share Us Your Suggestion', RPGP_TEXT_DOMAIN ); ?></p>
<h4 class="para"><?php _e( 'If you have any suggestion or features in your mind then please share us', RPGP_TEXT_DOMAIN ); ?>
    . <?php _e( 'We will try our best to add them in this plugin', RPGP_TEXT_DOMAIN ); ?>.</h4>

<p class="well"><?php _e( 'Language Contribution', RPGP_TEXT_DOMAIN ); ?></p>
<h4 class="para"><?php _e( 'Translate this plugin into your language', RPGP_TEXT_DOMAIN ); ?></h4>
<h4 class="para"><span class="list_point"><?php _e( 'Question', RPGP_TEXT_DOMAIN ); ?></span>
    : <?php _e( 'How to convert Plguin into My Language ', RPGP_TEXT_DOMAIN ); ?>?</h4>
<h4 class="para"><span class="list_point"><?php _e( 'Answer', RPGP_TEXT_DOMAIN ); ?></span>
    : <?php _e( 'Contact as to', RPGP_TEXT_DOMAIN ); ?>
    lizarweb@gmail.com <?php _e( 'for translate this plugin into your language', RPGP_TEXT_DOMAIN ); ?>.</h4>

<p class="well"><?php _e( 'Change Old Server Image URL', RPGP_TEXT_DOMAIN ); ?></p>
<form action="" method="post">
    <input type="submit" value="Change image URL" name="rpgpchangeurl" class="chng_btn">
</form>
<h4 class="para"><span class="list_point"><?php _e( 'Note', RPGP_TEXT_DOMAIN ); ?>
        :</span> <?php _e( 'Use this option after import', RPGP_TEXT_DOMAIN ); ?> <span
            class="plug_list_point"><?php _e( 'Gallery Settings', RPGP_TEXT_DOMAIN ); ?></span> <?php _e( 'to change old server image url to new server image url', RPGP_TEXT_DOMAIN ); ?>
    .</h4>

<?php
if ( isset( $_REQUEST['rpgpchangeurl'] ) ) {
	$all_posts = wp_count_posts( 'rpgp_gallery' )->publish;
	$args      = array( 'post_type' => 'rpgp_gallery', 'posts_per_page' => $all_posts );
	global $rpg_galleries;
	$rpg_galleries = new WP_Query( $args );

	while ( $rpg_galleries->have_posts() ) : $rpg_galleries->the_post();


		$RPGP_Id               = get_the_ID();
		$RPGP_AllPhotosDetails = unserialize( base64_decode( get_post_meta( $RPGP_Id, 'rpgp_all_photos_details', true ) ) );

		$TotalImages = get_post_meta( $RPGP_Id, 'rpgp_total_images_count', true );

		if ( $TotalImages ) {
			foreach ( $RPGP_AllPhotosDetails as $RPGP_SinglePhotoDetails ) {
				$name = $RPGP_SinglePhotoDetails['rpgp_image_label'];
				$url  = $RPGP_SinglePhotoDetails['rpgp_image_url'];
				$url1 = $RPGP_SinglePhotoDetails['rpgp_12_thumb'];
				$url2 = $RPGP_SinglePhotoDetails['rpgp_346_thumb'];
				$url3 = $RPGP_SinglePhotoDetails['rpgp_12_same_size_thumb'];
				$url4 = $RPGP_SinglePhotoDetails['rpgp_346_same_size_thumb'];

				//die($url.$url2.$url3.$url4.$url5.$url6.$circle);
				$upload_dir = wp_upload_dir();
				$data       = $url;
				if ( strpos( $data, 'uploads' ) !== false ) {
					list( $oteher_path, $image_path ) = explode( "uploads", $data );
					$url = $upload_dir['baseurl'] . $image_path;
				}

				$data = $url1;
				if ( strpos( $data, 'uploads' ) !== false ) {
					list( $oteher_path, $image_path ) = explode( "uploads", $data );
					$url1 = $upload_dir['baseurl'] . $image_path;
				}

				$data = $url2;
				if ( strpos( $data, 'uploads' ) !== false ) {
					list( $oteher_path, $image_path ) = explode( "uploads", $data );
					$url2 = $upload_dir['baseurl'] . $image_path;
				}

				$data = $url3;
				if ( strpos( $data, 'uploads' ) !== false ) {
					list( $oteher_path, $image_path ) = explode( "uploads", $data );
					$url3 = $upload_dir['baseurl'] . $image_path;
				}

				$data = $url4;
				if ( strpos( $data, 'uploads' ) !== false ) {
					list( $oteher_path, $image_path ) = explode( "uploads", $data );
					$url4 = $upload_dir['baseurl'] . $image_path;
				}


				$ImagesArray[] = array(
					'rpgp_image_label'         => $name,
					'rpgp_image_url'           => $url,
					'rpgp_12_thumb'            => $url1,
					'rpgp_346_thumb'           => $url2,
					'rpgp_12_same_size_thumb'  => $url3,
					'rpgp_346_same_size_thumb' => $url4
				);

			}
			update_post_meta( $RPGP_Id, 'rpgp_all_photos_details', base64_encode( serialize( $ImagesArray ) ) );
			$ImagesArray = "";
		}

	endwhile;
}
?>
<style>
    body {
        /* This has to be same as the text-shadows below */
        background: #fafafa;
    }

    .acl-rate-us span.dashicons {
        width: 30px;
        height: 30px;
    }

    .acl-rate-us span.dashicons-star-filled:before {
        content: "\f155";
        font-size: 30px;
    }

    .acl-rate-us {
        color: #FBD229 !important;
        padding-top: 5px !important;
    }

    .acl-rate-us span {
        display: inline-block;
    }

    h1 {
        font-family: Helvetica, Arial, sans-serif;
        font-weight: bold;
        font-size: 6em;
        line-height: 1em;
    }

    .inset-text {
        /* Shadows are visible under slightly transparent text color */
        color: rgba(10, 60, 150, 0.8);
        text-shadow: 1px 4px 6px #def, 0 0 0 #000, 1px 4px 6px #def;
    }

    /* Don't show shadows when selecting text */
    ::-moz-selection {
        background: #5af;
        color: #fff;
        text-shadow: none;
    }

    ::selection {
        background: #5af;
        color: #fff;
        text-shadow: none;
    }

    .well {
        min-height: 20px;
        padding: 19px;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
    }

    .head_title {
        color: red;
        font-size: 30px;
    }

    .head_desc {

    }

    .para {
        padding-left: 25px;
        font-size: 15px;
        font-weight: 600;
    }

    .list_point {
        color: #006799;
        font-weight: 700;
    }

    .plug_list_point {
        color: red;
        font-weight: 700;
    }

    .chng_btn {
        margin-top: 0px;
        margin-right: 10px;
        font-size: 18px;
        cursor: pointer;
        font-weight: 700;
        margin-left: 30px;
        color: #fff;
        background: #dc3232;
        text-decoration: none;
    }

    h3.head_desc {
        padding-top: 16px;
        padding-bottom: 20px;
    }
</style>