<?php
// Image Crop Size Function 
add_image_size( 'rpgp_12_thumb', 500, 9999, array( 'center', 'top' ) );
add_image_size( 'rpgp_346_thumb', 400, 9999, array( 'center', 'top' ) );
add_image_size( 'rpgp_12_same_size_thumb', 500, 500, array( 'center', 'top' ) );
add_image_size( 'rpgp_346_same_size_thumb', 400, 400, array( 'center', 'top' ) );

function RPGP_Help_and_Support_page() {
	require_once( "help_and_support.php" );
}

function RPGP_recommendation_page() {
	//css
	wp_enqueue_style( 'rpgp-recom', RPGP_PLUGIN_URL . 'css/recom.css' );
	require_once( "recommendations.php" );
}

function RPGP_Our_Offers_page() {
	wp_enqueue_style( 'rpgp-offers-boot-strap-latest', RPGP_PLUGIN_URL . 'css/bootstrap-latest/bootstrap.min.css' );
	wp_enqueue_script( 'rpgp-bootstrap-js', RPGP_PLUGIN_URL . 'js/bootstrap.min.js' );
	require_once( "offers.php" );
}

//Load Plugin Translation
function RPGP_GetReadyTranslation() {
	load_plugin_textdomain( RPGP_TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'RPGP_GetReadyTranslation' );

$wl_rpgp_lm_val = WL_RPGP_LM::get_instance()->is_valid();

/**
 * Support and Our Products Page
 */
add_action( 'admin_menu', 'rpgp_SettingsPage' );
function rpgp_SettingsPage() {
	global $wl_rpgp_lm_val;
	if ( isset( $wl_rpgp_lm_val ) && $wl_rpgp_lm_val ) {
		add_submenu_page( 'responsive-photo-gallery-pro-license', __( 'All Galleries', RPGP_TEXT_DOMAIN ), __( 'All Galleries', RPGP_TEXT_DOMAIN ), 'administrator', 'edit.php?post_type=rpgp_gallery', null );
		add_submenu_page( 'responsive-photo-gallery-pro-license', __( 'Add New Gallery', RPGP_TEXT_DOMAIN ), __( 'Add New Gallery', RPGP_TEXT_DOMAIN ), 'administrator', 'post-new.php?post_type=rpgp_gallery', null );
	}
	add_submenu_page( 'responsive-photo-gallery-pro-license', __( 'Help and Support', RPGP_TEXT_DOMAIN ), __( 'Help and Support', RPGP_TEXT_DOMAIN ), 'administrator', 'RPGP-help-page', 'RPGP_Help_and_Support_page' );
	add_submenu_page( 'responsive-photo-gallery-pro-license', __( 'Recommendation', RPGP_TEXT_DOMAIN ), __( 'Recommendation', RPGP_TEXT_DOMAIN ), 'administrator', 'RPGP-recommendation-page', 'RPGP_recommendation_page' );
	add_submenu_page( 'responsive-photo-gallery-pro-license', __( 'Our Offers', RPGP_TEXT_DOMAIN ), __( 'Our Offers', RPGP_TEXT_DOMAIN ), 'administrator', 'RPGP-Our-Offers-page', 'RPGP_Our_Offers_page' );
}

add_action( 'admin_menu', array( 'WL_RPGP_Menu', 'create_menu' ), 1 );

/**
 * Weblizar Image Gallery Shortcode Detect Function
 */
function WeblizarImageGalleryShortCodeDetect() {
	global $wp_query;
	$Posts   = $wp_query->posts;
	$Pattern = get_shortcode_regex();
	foreach ( $Posts as $Post ) {
		//if(isset($Post->post_content)){
		//if (   preg_match_all( '/'. $Pattern .'/s', $Post->post_content, $Matches ) && array_key_exists( 2, $Matches ) && in_array( 'RPG', $Matches[2] ) ) {
		if ( isset( $Post->post_content ) && strpos( $Post->post_content, 'RPG' ) ) {
			/**
			 * js scripts
			 */
			wp_enqueue_script( 'jquery' );
			//wp_enqueue_script('rpgp-jquery-min-js',RPGP_PLUGIN_URL.'js/jquery.min.js', array('jquery'));
			wp_enqueue_script( 'rpgp-hover-pack-js', RPGP_PLUGIN_URL . 'js/hover-pack.js', array( 'jquery' ) );
			wp_enqueue_script( 'rpgp-rpg-script', RPGP_PLUGIN_URL . 'js/reponsive_photo_gallery_script.js', array( 'jquery' ) );

			/**
			 * Load Light Box 1 Nivobox JS CSS
			 */
			wp_enqueue_style( 'rpgp-nivo-lightbox-min-css', RPGP_PLUGIN_URL . 'lightbox/nivo/nivo-lightbox.min.css' );
			wp_enqueue_script( 'rpgp-nivo-lightbox-min-js', RPGP_PLUGIN_URL . 'lightbox/nivo/nivo-lightbox.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'rpgp-enigma-lightbox-js', RPGP_PLUGIN_URL . 'lightbox/nivo/enigma_lightbox.js', array( 'jquery' ) );

			/**
			 * Load Light Box 2  Photobox JS CSS
			 */
			wp_enqueue_style( 'rpgp-photobox-css', RPGP_PLUGIN_URL . 'lightbox/photobox/photobox.css' );
			wp_enqueue_script( 'rpgp-photobox-js', RPGP_PLUGIN_URL . 'lightbox/photobox/jquery.photobox.js', array( 'jquery' ) );

			/**
			 * Load Light Box 3  preety photo JS CSS
			 */
			wp_enqueue_style( 'wl-rpg-pretty-css1', RPGP_PLUGIN_URL . 'lightbox/prettyphoto/prettyPhoto.css' );
			wp_enqueue_script( 'wl-rpg-pretty-js1', RPGP_PLUGIN_URL . 'lightbox/prettyphoto/jquery.prettyPhoto.js', array( 'jquery' ) );

			/**
			 * Load Light Box 4 Swipebox JS CSS
			 */
			wp_enqueue_style( 'wl-rpg-swipe-css', RPGP_PLUGIN_URL . 'lightbox/swipebox/swipebox.css' );
			wp_enqueue_script( 'wl-rpg-swipe-js', RPGP_PLUGIN_URL . 'lightbox/swipebox/jquery.swipebox.js' );

			/**
			 * css scripts
			 */
			wp_enqueue_style( 'rpgp-hover-pack-css', RPGP_PLUGIN_URL . 'css/hover-pack.css' );
			wp_enqueue_style( 'rpgp-reset-css', RPGP_PLUGIN_URL . 'css/reset.css' );
			wp_enqueue_style( 'rpgp-bootstrap-css', RPGP_PLUGIN_URL . 'css/bootstrap-latest/bootstrap.min.css' );
			wp_enqueue_style( 'rpgp-img-gallery-css', RPGP_PLUGIN_URL . 'css/img-gallery.css' );

			/**
			 * font awesome css
			 */
			wp_enqueue_style( 'rpgp-font-awesome-5', RPGP_PLUGIN_URL . 'css/font-awesome-latest/css/fontawesome-all.min.css' );

			/**
			 * envira & isotope js
			 */
			wp_enqueue_script( 'envira-js', RPGP_PLUGIN_URL . 'js/envira.js', array(), '1.5.26', true );
			wp_enqueue_script( 'isotope-js', RPGP_PLUGIN_URL . 'js/gl_isotope.js', array(), '', true );

			break;
			//}
		}        //end of if
	} //end of foreach
}

add_action( 'wp', 'WeblizarImageGalleryShortCodeDetect' );

function rpg_remove_image_box() {
	remove_meta_box( 'postimagediv', 'rpgp_gallery', 'side' );
}

add_action( 'do_meta_boxes', 'rpg_remove_image_box' );

function RPGP_wl_remove_items() {
	delete_option( 'wl-rpgp-key' );
	delete_option( 'wl-rpgp-valid' );
	delete_option( 'wl-rpgp-cache' );
	delete_option( 'Responsive_photo_gallery_updation_detail' );
}

class RPGP {

	private static $instance;
	private $admin_thumbnail_size = 150;
	private $thumbnail_size_w = 150;
	private $thumbnail_size_h = 150;
	var $counter;

	public static function forge() {
		if ( ! isset( self::$instance ) ) {
			$className      = __CLASS__;
			self::$instance = new $className;
		}

		return self::$instance;
	}

	private function __construct() {
		$this->counter = 0;
		add_action( 'admin_print_scripts-post.php', array( &$this, 'rpgp_admin_print_scripts' ) );
		add_action( 'admin_print_scripts-post-new.php', array( &$this, 'rpgp_admin_print_scripts' ) );
		add_image_size( 'rpg_gallery_admin_thumb', $this->admin_thumbnail_size, $this->admin_thumbnail_size, true );
		add_image_size( 'rpg_gallery_thumb', $this->thumbnail_size_w, $this->thumbnail_size_h, true );
		add_shortcode( 'rpggallery', array( &$this, 'shortcode' ) );
		if ( is_admin() ) {
			add_action( 'init', array( &$this, 'ResponsivePhotoGalleryPro' ), 1 );
			add_action( 'add_meta_boxes', array( &$this, 'add_all_rpgp_meta_boxes' ) );
			add_action( 'admin_init', array( &$this, 'add_all_rpgp_meta_boxes' ), 1 );

			add_action( 'save_post', array( &$this, 'add_image_meta_box_save' ), 9, 1 );
			add_action( 'save_post', array( &$this, 'rpgp_settings_meta_save' ), 9, 1 );

			add_action( 'wp_ajax_rpggallery_get_thumbnail', array( &$this, 'ajax_get_thumbnail' ) );
		}
	}

	//Required JS & CSS
	public function rpgp_admin_print_scripts() {
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'rpgp-media-uploader-js', RPGP_PLUGIN_URL . 'js/rpgp-multiple-media-uploader.js', array( 'jquery' ) );


		wp_enqueue_media();
		//custom add image box css
		wp_enqueue_style( 'rpgp-meta-css', RPGP_PLUGIN_URL . 'css/rpg-meta.css' );

		//color-picker css n js
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'rpgp-color-picker-script', plugins_url( 'js/wl-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );

		//font awesome css
		wp_enqueue_style( 'rpgp-font-awesome-5', RPGP_PLUGIN_URL . 'css/font-awesome-latest/css/fontawesome-all.min.css' );

		wp_enqueue_style( 'rpgp_codemirror-css', RPGP_PLUGIN_URL . 'css/codemirror/codemirror.css' );
		wp_enqueue_style( 'rpgp_blackboard', RPGP_PLUGIN_URL . 'css/codemirror/blackboard.css' );
		wp_enqueue_style( 'rpgp_show-hint-css', RPGP_PLUGIN_URL . 'css/codemirror/show-hint.css' );

		wp_enqueue_script( 'rpgp_codemirror-js', RPGP_PLUGIN_URL . 'css/codemirror/codemirror.js', array( 'jquery' ) );
		wp_enqueue_script( 'rpgp_css-js', RPGP_PLUGIN_URL . 'css/codemirror/lbsp-css.js', array( 'jquery' ) );
		wp_enqueue_script( 'rpgp_css-hint-js', RPGP_PLUGIN_URL . 'css/codemirror/css-hint.js', array( 'jquery' ) );

		//single media uploader js
		wp_enqueue_script('rpg-media-uploads',RPGP_PLUGIN_URL.'js/rpg-media-upload-script.js',array('media-upload','thickbox','jquery'));
	}

	// Register Custom Post Type
	public function ResponsivePhotoGalleryPro() {
		global $wl_rpgp_lm_val;
		$labels = array(
			'name'               => _x( 'Responsive Photo Gallery Pro', 'rpgp_gallery' ),
			'singular_name'      => _x( 'Responsive Photo Gallery Pro', 'rpgp_gallery' ),
			'add_new'            => _x( 'Add New Gallery', 'rpgp_gallery' ),
			'add_new_item'       => _x( 'Add New Gallery', 'rpgp_gallery' ),
			'edit_item'          => _x( 'Edit Photo Gallery', 'rpgp_gallery' ),
			'new_item'           => _x( 'New Gallery', 'rpgp_gallery' ),
			'view_item'          => _x( 'View Gallery', 'rpgp_gallery' ),
			'search_items'       => _x( 'Search Galleries', 'rpgp_gallery' ),
			'not_found'          => _x( 'No galleries found', 'rpgp_gallery' ),
			'not_found_in_trash' => _x( 'No galleries found in Trash', 'rpgp_gallery' ),
			'parent_item_colon'  => _x( 'Parent Gallery:', 'rpgp_gallery' ),
			'all_items'          => __( 'All Galleries', RPGP_TEXT_DOMAIN ),
			'menu_name'          => _x( 'Responsive Photo Gallery Pro', 'rpgp_gallery' ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'supports'            => array( 'title', 'thumbnail' ),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'menu_position'       => 10,
			'menu_icon'           => 'dashicons-format-gallery',
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => false,
			'capability_type'     => 'post'
		);

		if ( isset( $wl_rpgp_lm_val ) && $wl_rpgp_lm_val ) {
			register_post_type( 'rpgp_gallery', $args );
		}
		add_filter( 'manage_edit-rpgp_gallery_columns', array( &$this, 'rpgp_gallery_columns' ) );
		add_action( 'manage_rpgp_gallery_posts_custom_column', array( &$this, 'rpgp_gallery_manage_columns' ), 10, 2 );
	}

	function rpgp_gallery_columns( $columns ) {
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'title'     => __( 'Gallery' ),
			'shortcode' => __( 'Gallery Shortcode' ),
			'date'      => __( 'Date' )
		);

		return $columns;
	}

	function rpgp_gallery_manage_columns( $column, $post_id ) {
		global $post;
		switch ( $column ) {
			case 'shortcode' :
				echo '<input type="text" value="[RPG id=' . $post_id . ']" readonly="readonly" />';
				break;
			default :
				break;
		}
	}

	public function add_all_rpgp_meta_boxes() {
		add_meta_box( __( 'Add Images', RPGP_TEXT_DOMAIN ), __( 'Add Images', RPGP_TEXT_DOMAIN ), array(
			&$this,
			'rpgp_generate_add_image_meta_box_function'
		), 'rpgp_gallery', 'normal', 'low' );
		add_meta_box( __( 'Apply Setting On Photo Gallery', RPGP_TEXT_DOMAIN ), __( 'Apply Setting On Photo Gallery', RPGP_TEXT_DOMAIN ), array(
			&$this,
			'rpgp_settings_meta_box_function'
		), 'rpgp_gallery', 'normal', 'low' );
		add_meta_box( __( 'Photo Gallery Shortcode', RPGP_TEXT_DOMAIN ), __( 'Photo Gallery Shortcode', RPGP_TEXT_DOMAIN ), array(
			&$this,
			'rpgp_shotcode_meta_box_function'
		), 'rpgp_gallery', 'side', 'low' );
		//add_meta_box(__('Please Rate Us', RPGP_TEXT_DOMAIN) , __('Please Rate Us', RPGP_TEXT_DOMAIN), array($this, 'Rate_us_meta_box_function'), 'rpgp_gallery', 'side', 'low');
	}

	/**
	 * This function display Add New Image interface
	 * Also loads all saved gallery photos into photo gallery
	 */
	public function rpgp_generate_add_image_meta_box_function( $post ) { ?>
        <div id="rpggallery_container">
            <input type="hidden" id="rpg_wl_action" name="rpg_wl_action" value="rpg-save-settings">
            <ul id="rpg_gallery_thumbs" class="clearfix">
				<?php
				/* load saved photos into gallery */
				$RPGP_AllPhotosDetails = unserialize( base64_decode( get_post_meta( $post->ID, 'rpgp_all_photos_details', true ) ) );
				$TotalImages           = get_post_meta( $post->ID, 'rpgp_total_images_count', true );
				if ( $TotalImages ) {
					foreach ( $RPGP_AllPhotosDetails as $RPGP_SinglePhotoDetails ) {
						$name         = $RPGP_SinglePhotoDetails['rpgp_image_label'];
						$UniqueString = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, 5 );
						$url          = $RPGP_SinglePhotoDetails['rpgp_image_url'];
						$url1         = $RPGP_SinglePhotoDetails['rpgp_12_thumb'];
						$url2         = $RPGP_SinglePhotoDetails['rpgp_346_thumb'];
						$url3         = $RPGP_SinglePhotoDetails['rpgp_12_same_size_thumb'];
						$url4         = $RPGP_SinglePhotoDetails['rpgp_346_same_size_thumb'];
						?>
                        <li class="rpg-image-entry" id="rpg_img">
                            <a class="gallery_remove rpggallery_remove" href="#gallery_remove" id="rpg_remove_bt"><img
                                        src="<?php echo RPGP_PLUGIN_URL . 'images/Close-icon-new.png'; ?>"/></a>
                            <img src="<?php echo $url; ?>" class="rpg-meta-image" alt="" style="">
                            <input type="button" id="upload-background-<?php echo $UniqueString; ?>"
                                   name="upload-background-<?php echo $UniqueString; ?>" value="Upload Image"
                                   class="button-primary " onClick="weblizar_image('<?php echo $UniqueString; ?>')"/>
                            <input type="text" id="rpgp_image_label[]" name="rpgp_image_label[]"
                                   value="<?php echo html_entity_decode( $name, ENT_QUOTES, "UTF-8" ); ?>"
                                   placeholder="Enter Image Label" class="rpg_label_text">

                            <input type="text" id="rpgp_image_url[]" name="rpgp_image_url[]" class="rpg_label_text"
                                   value="<?php echo $url; ?>" readonly="readonly" style="display:none;"/>
                            <input type="text" id="rpgp_image_url1[]" name="rpgp_image_url1[]" class="rpg_label_text"
                                   value="<?php echo $url1; ?>" readonly="readonly" style="display:none;"/>
                            <input type="text" id="rpgp_image_url2[]" name="rpgp_image_url2[]" class="rpg_label_text"
                                   value="<?php echo $url2; ?>" readonly="readonly" style="display:none;"/>
                            <input type="text" id="rpgp_image_url3[]" name="rpgp_image_url3[]" class="rpg_label_text"
                                   value="<?php echo $url3; ?>" readonly="readonly" style="display:none;"/>
                            <input type="text" id="rpgp_image_url4[]" name="rpgp_image_url4[]" class="rpg_label_text"
                                   value="<?php echo $url4; ?>" readonly="readonly" style="display:none;"/>
                        </li>
						<?php
					} // end of foreach
				} else {
					$TotalImages = 0;
				}
				?>
            </ul>
        </div>

        <!--Add New Image Button-->
        <div class="rpg-image-entry add_rpg_new_image" id="rpg_gallery_upload_button" data-uploader_title="Upload Image"
             data-uploader_button_text="Select">
            <div class="dashicons dashicons-plus"></div>
            <p>
				<?php _e( 'Add New Image', RPGP_TEXT_DOMAIN ); ?>
            </p>
        </div>

        <!--Delete Image Button-->
        <div class="rpg-image-entry rpg_del_image" id="rpg_delete_all_button">
            <div class="dashicons dashicons-trash"></div>
            <p>
				<?php _e( 'Delete All Images', RPGP_TEXT_DOMAIN ); ?>
            </p>
        </div>
        <div style="clear:left;"></div>
        <p><strong><?php _e( "Tips", RPGP_TEXT_DOMAIN ); ?>
                :</strong> <?php _e( "Plugin crop images with same size thumbnails", RPGP_TEXT_DOMAIN ); ?>
            . <?php _e( "So please upload all gallery images using Add New Image button", RPGP_TEXT_DOMAIN ); ?>
            . <?php _e( "Do not use or add pre-uploaded images which are uploaded previously using Media or Post or Page", RPGP_TEXT_DOMAIN ); ?>
            .</p>
		<?php
	}

	/**
	 * This function display Add New Image interface
	 * Also loads all saved gallery photos into photo gallery
	 */
	public function rpgp_settings_meta_box_function( $post ) {
		require_once( 'responsive-photo-gallery-settings-meta-box.php' );
	}

	public function rpgp_shotcode_meta_box_function() { ?>
        <p><?php _e( "Use below shortcode in any Page/Post to publish your photo gallery", RPGP_TEXT_DOMAIN ); ?></p>
        <input readonly="readonly" type="text" value="<?php echo "[RPG id=" . get_the_ID() . "]"; ?>">
		<?php
	}

	public function admin_thumb( $id ) {
		$image        = wp_get_attachment_image_src( $id, 'rpggallery_admin_medium', true );
		$image1       = wp_get_attachment_image_src( $id, 'rpgp_12_thumb', true );
		$image2       = wp_get_attachment_image_src( $id, 'rpgp_346_thumb', true );
		$image3       = wp_get_attachment_image_src( $id, 'rpgp_12_same_size_thumb', true );
		$image4       = wp_get_attachment_image_src( $id, 'rpgp_346_same_size_thumb', true );
		$UniqueString = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, 5 );
		?>
        <li class="rpg-image-entry" id="rpg_img">
            <a class="gallery_remove rpggallery_remove" href="#gallery_remove" id="rpg_remove_bt"><img
                        src="<?php echo RPGP_PLUGIN_URL . 'images/Close-icon-new.png'; ?>"/></a>
            <img src="<?php echo $image[0]; ?>" class="rpg-meta-image" alt="" style="">
            <input type="button" id="upload-background-<?php echo $UniqueString; ?>"
                   name="upload-background-<?php echo $UniqueString; ?>" value="Upload Image" class="button-primary "
                   onClick="weblizar_image('<?php echo $UniqueString; ?>')"/>
            <input type="text" id="rpgp_image_label[]" name="rpgp_image_label[]" placeholder="Enter Image Label"
                   value="" class="rpg_label_text">

            <input type="text" id="rpgp_image_url[]" name="rpgp_image_url[]" class="rpg_label_text"
                   value="<?php echo $image[0]; ?>" readonly="readonly" style="display:none;"/>
            <input type="text" id="rpgp_image_url1[]" name="rpgp_image_url1[]" class="rpg_label_text"
                   value="<?php echo $image1[0]; ?>" readonly="readonly" style="display:none;"/>
            <input type="text" id="rpgp_image_url2[]" name="rpgp_image_url2[]" class="rpg_label_text"
                   value="<?php echo $image2[0]; ?>" readonly="readonly" style="display:none;"/>
            <input type="text" id="rpgp_image_url3[]" name="rpgp_image_url3[]" class="rpg_label_text"
                   value="<?php echo $image3[0]; ?>" readonly="readonly" style="display:none;"/>
            <input type="text" id="rpgp_image_url4[]" name="rpgp_image_url4[]" class="rpg_label_text"
                   value="<?php echo $image4[0]; ?>" readonly="readonly" style="display:none;"/>
        </li>
		<?php
	}


	public function ajax_get_thumbnail() {
		echo $this->admin_thumb( $_POST['imageid'] );
		die;
	}

	public function add_image_meta_box_save( $PostID ) {
		
        // echo "<pre>";
        // print_r($_POST);
		// echo "</pre>";
		
        // print_r("Hello");
		// die;
		if ( isset( $PostID ) && isset( $_POST['rpg_wl_action'] ) ) {
			$TotalImages = count( $_POST['rpgp_image_url'] );
			$ImagesArray = array();
			if ( $TotalImages ) {
				for ( $i = 0; $i < $TotalImages; $i ++ ) {
					$image_label   = stripslashes( $_POST['rpgp_image_label'][ $i ] );
					$url           = $_POST['rpgp_image_url'][ $i ];
					$url1          = $_POST['rpgp_image_url1'][ $i ];
					$url2          = $_POST['rpgp_image_url2'][ $i ];
					$url3          = $_POST['rpgp_image_url3'][ $i ];
					$url4          = $_POST['rpgp_image_url4'][ $i ];
					$ImagesArray[] = array(
						'rpgp_image_label'         => $image_label,
						'rpgp_image_url'           => $url,
						'rpgp_12_thumb'            => $url1,
						'rpgp_346_thumb'           => $url2,
						'rpgp_12_same_size_thumb'  => $url3,
						'rpgp_346_same_size_thumb' => $url4
					);
				}
				update_post_meta( $PostID, 'rpgp_all_photos_details', base64_encode( serialize( $ImagesArray ) ) );
				update_post_meta( $PostID, 'rpgp_total_images_count', $TotalImages );
			} else {
				$TotalImages = 0;
				update_post_meta( $PostID, 'rpgp_total_images_count', $TotalImages );
				$ImagesArray = array();
				update_post_meta( $PostID, 'rpgp_all_photos_details', base64_encode( serialize( $ImagesArray ) ) );
			}
		}
	}

	//save settings meta box values
	public function rpgp_settings_meta_save( $PostID ) {
		if ( isset( $PostID ) && isset( $_POST['wl_rpgp_action'] ) ) {
			$WL_Show_Gallery_Title   = $_POST['wl-show-gallery-title'];
			$WL_Show_Image_Label     = $_POST['wl-show-image-label'];
			$WL_Image_Label_Position = $_POST['wl-image-label-position'];
			$WL_Hover_Animation      = $_POST['wl-hover-animation'];
			$WL_Gallery_Layout       = $_POST['wl-gallery-layout'];
			$WL_Thumbnail_Layout     = $_POST['wl-thumbnail-layout'];
			$WL_Hover_Color          = $_POST['wl-hover-color'];
			$WL_Hover_Text_Color     = $_POST['wl-hover-text-color'];
			$WL_Footer_Text_Color    = $_POST['wl-footer-text-color'];
			$WL_Icon_Color           = $_POST['wl-icon-color'];
			$WL_Hover_Color_Opacity  = $_POST['wl-hover-color-opacity'];
			$WL_Font_Style           = $_POST['wl-font-style'];
			$WL_Image_View_Icon      = $_POST['wl-image-view-icon'];
			$WL_Image_View_Icon_Size = $_POST['wl-image-view-icon-size'];
			$WL_Light_Box            = $_POST['wl-light-box'];
			$WL_Show_Image_Lightbox  = $_POST['wl-show-image-lightbox'];
			$WL_Custom_Css           = $_POST['wl-custom-css'];

			$RPGP_Settings_Array = serialize( array(
				'WL_Show_Gallery_Title'   => $WL_Show_Gallery_Title,
				'WL_Show_Image_Label'     => $WL_Show_Image_Label,
				'WL_Image_Label_Position' => $WL_Image_Label_Position,
				'WL_Hover_Animation'      => $WL_Hover_Animation,
				'WL_Gallery_Layout'       => $WL_Gallery_Layout,
				'WL_Thumbnail_Layout'     => $WL_Thumbnail_Layout,
				'WL_Hover_Color'          => $WL_Hover_Color,
				'WL_Hover_Text_Color'     => $WL_Hover_Text_Color,
				'WL_Footer_Text_Color'    => $WL_Footer_Text_Color,
				'WL_Icon_Color'           => $WL_Icon_Color,
				'WL_Hover_Color_Opacity'  => $WL_Hover_Color_Opacity,
				'WL_Font_Style'           => $WL_Font_Style,
				'WL_Image_View_Icon'      => $WL_Image_View_Icon,
				'WL_Image_View_Icon_Size' => $WL_Image_View_Icon_Size,
				'WL_Light_Box'            => $WL_Light_Box,
				'WL_Show_Image_Lightbox'  => $WL_Show_Image_Lightbox,
				'WL_Custom_Css'           => $WL_Custom_Css
			) );

			$RPGP_Gallery_Settings = "RPGP_Gallery_Settings_" . $PostID;
			update_post_meta( $PostID, $RPGP_Gallery_Settings, $RPGP_Settings_Array );
		}
	}
}

global $RPGP;
$RPGP = RPGP::forge();

/**
 * Responsive Photo Gallery Short Code [RPG]
 */
require_once( "responsive-photo-gallery-short-code.php" );

/**
 * Hex Color code to RGB Color Code converter function
 */
if ( ! function_exists( 'RPGhex2rgb' ) ) {
	function RPGhex2rgb( $hex ) {
		$hex = str_replace( "#", "", $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );

		return $rgb; // returns an array with the rgb values
	}
}

add_action( 'media_buttons_context', 'add_rpg_custom_button' );
add_action( 'admin_footer', 'add_rpg_inline_popup_content' );


function add_rpg_custom_button( $context ) {
	$img          = plugins_url( '/images/Photos-icon.png', __FILE__ );
	$container_id = 'RPG';
	$title        = 'Select Responsive Photo Gallery to insert into post';
	$context      .= '<a class="button button-primary thickbox" title="Select portfolio gallery to insert into post"    href="#TB_inline?width=400&inlineId=' . $container_id . '">
		<span class="wp-media-buttons-icon" style="background: url(' . $img . '); background-repeat: no-repeat; background-position: left bottom;"></span>
	Responsive Photo Gallery Pro Shortcode
	</a>';

	return $context;
}

function add_rpg_inline_popup_content() {
	?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#rpggalleryinsert').on('click', function () {
                var id = jQuery('#rpg-gallery-select option:selected').val();
                window.send_to_editor('<p>[RPG id=' + id + ']</p>');
                tb_remove();
            })
        });
    </script>

    <div id="RPG" style="display:none;">
        <h3><?php _e( "Select Responsive photo Gallery to insert into post", RPGP_TEXT_DOMAIN ); ?></h3>
		<?php
		$all_posts = wp_count_posts( 'rpgp_gallery' )->publish;
		$args      = array( 'post_type' => 'rpgp_gallery', 'posts_per_page' => $all_posts );
		global $rpg_galleries;
		$rpg_galleries = new WP_Query( $args );
		if ( $rpg_galleries->have_posts() ) { ?>
            <select id="rpg-gallery-select"> <?php
				while ( $rpg_galleries->have_posts() ) : $rpg_galleries->the_post(); ?>
                    <option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
				<?php endwhile; ?>
            </select>
            <button class='button primary'
                    id='rpggalleryinsert'><?php _e( "Insert Gallery Shortcode", RPGP_TEXT_DOMAIN ); ?></button>
			<?php
		} else {
			_e( "No Gallery Found", RPGP_TEXT_DOMAIN );
		} ?>
    </div>
	<?php
}

?>