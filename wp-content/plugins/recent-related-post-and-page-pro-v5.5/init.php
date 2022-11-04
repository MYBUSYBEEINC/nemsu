<?php
add_filter( 'widget_text', 'do_shortcode' );	
/**
 * Load plugin text domain
 */
function add_plugin_info() {
	$rp_and_rp_product_name ="Recent Related Post And Page";
	$rp_and_rp_product_version ="5.3";
	$rp_and_rp_wordpress_supported_version="4.9.7";
	$rp_and_rp_wordpress_tested_version="4.9.7";

	$Info_Array[] = array(
		'rp_and_rp_product_name' => $rp_and_rp_product_name,
		'rp_and_rp_product_version' => $rp_and_rp_product_version,
		'rp_and_rp_wordpress_supported_version' => $rp_and_rp_wordpress_supported_version,
		'rp_and_rp_wordpress_tested_version' => $rp_and_rp_wordpress_tested_version,
	);

	update_option('rp_and_rp_plugin_info', serialize($Info_Array));
}
add_action('init', 'add_plugin_info');

function WL_R_P_R_P() {
	load_plugin_textdomain( 'WL_R_P_R_P', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'WL_R_P_R_P' );

add_action( 'admin_menu', array( 'WL_RRPPP_Menu', 'create_menu' ), 1 );

$wl_rrppp_lm_val = WL_RRPPP_LM::get_instance()->is_valid();


function R_P_R_P_submenu_Settings_Page() {
	global $wl_rrppp_lm_val;
	if ( isset( $wl_rrppp_lm_val ) && $wl_rrppp_lm_val ) {
		add_submenu_page('recent-relate-page-and-post-license', 'All Shortcode', 'All Shortcode', 'administrator', 'edit.php?post_type=rp_and_rp',null);
		add_submenu_page('recent-relate-page-and-post-license', 'Add New', 'Add New', 'administrator', 'post-new.php?post_type=rp_and_rp',null);
		add_submenu_page('recent-relate-page-and-post-license', 'RRPP Settings ', 'Page/Post settings', 'administrator', '','r_p_a_r_p_settings_function');
	}	
	
	add_submenu_page('recent-relate-page-and-post-license', 'Help and Support ', 'Help and Support', 'administrator', 'recent-related-post-and-page_pro', 'r_p_a_r_p_pro_page_function');
	add_submenu_page('recent-relate-page-and-post-license', 'Our Products', 'Our Products', 'administrator', 'recent-related-post-and-page_pro_product', 'r_p_a_r_p_pro_product_function');
	add_submenu_page('recent-relate-page-and-post-license', 'Recommendation', 'Recommendation', 'administrator', 'recent-related-post-and-page-plugin-recommendation', 'r_p_a_r_p_plugin_recommendation');
	add_submenu_page('recent-relate-page-and-post-license', 'Offers', 'Offers', 'administrator', 'recent-related-post-and-page-plugin-offers', 'r_p_a_r_p_plugin_offers');
}
add_action('admin_menu', 'R_P_R_P_submenu_Settings_Page');

function r_p_a_r_p_settings_function() {  
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker');
	wp_enqueue_script('post_page_rp_rp-tool-tip-js',WL_RP_RP_PLUGIN_URL.'tooltip/jquery.darktooltip.min.js', array('jquery'));
	wp_enqueue_style('post_page_rp_rp-tool-tip-css', WL_RP_RP_PLUGIN_URL.'tooltip/darktooltip.min.css');
	require_once("page-post-settings.php");
}

function r_p_a_r_p_pro_page_function() {
	require_once("recent-related-post-and-page-pro-help-and-support.php");
}

function r_p_a_r_p_pro_product_function() {
	
	wp_enqueue_style('about-me-pro-product-function-bootstrap-latest', WL_RP_RP_PLUGIN_URL.'css/bootstrap-latest/bootstrap-latest.css');
	wp_enqueue_style('rp_rp-font-awesome-5', WL_RP_RP_PLUGIN_URL.'css/font-awesome-latest/css/fontawesome-all.min.css');
	require_once("our_product.php");
}

function r_p_a_r_p_plugin_recommendation() {
	//css
	wp_enqueue_style('rp-recom-css', WL_RP_RP_PLUGIN_URL.'css/recom.css');
	require_once("recommendations.php");
}

function r_p_a_r_p_plugin_offers() {
	require_once("offers.php");
}

function RP_RP_Plugin_Scripts() {
	//js scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('rp_and_rp-jquery-slider', WL_RP_RP_PLUGIN_URL.'js/jquery.easy-ticker.js', array('jquery'), '', true);
	wp_enqueue_script('rprp-jquery-sliderPro-js', WL_RP_RP_PLUGIN_URL.'js/jquery.easing.min.js', array('jquery'), '', true);
	wp_enqueue_script('rpost_and_rpost-jquery-slide', WL_RP_RP_PLUGIN_URL.'js/jquery.easy-ticker.min.js', array('jquery'), '1.1.0', true);
}
add_action( 'wp_enqueue_scripts', 'RP_RP_Plugin_Scripts' );


function RRPPP_wl_remove_items() {
	delete_option( 'wl-rrppp-key' );
	delete_option( 'wl-rrppp-valid' );
	delete_option( 'wl-rrppp-cache' );
	delete_option( 'RRPPP_updation_detail' );
}

class RP_RP_PRO
{
	public function __construct() {
		if (is_admin()) {
			add_action('init', array(&$this, 'rp_rp_shortcode'));
			add_action('add_meta_boxes', array(&$this, 'Add_all_recent_post_meta_boxes'),1);
			add_action('admin_enqueue_scripts', array(&$this,'my_rp_rp_style_files'),1);
			add_action('save_post', array(&$this, 'Nwt_Save_meta_box_save'), 9, 1);
		}
	}
	
	public function my_rp_rp_style_files($hook) {
		if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) {
			return;
		}
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('theme-preview');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('upload_media_widget', WL_RP_RP_PLUGIN_URL . 'js/upload-media.js', array('jquery'));
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script('rp_and_rp-jquery-slider_1', WL_RP_RP_PLUGIN_URL.'js/jquery.easy-ticker.js', array('jquery'));
		wp_enqueue_script('rprp-jquery-sliderPro-js_2', WL_RP_RP_PLUGIN_URL.'js/jquery.easing.min.js', array('jquery'));
		wp_enqueue_script('rpost_and_rpost-jquery-slide_3', WL_RP_RP_PLUGIN_URL.'js/jquery.easy-ticker.min.js', array('jquery'));
		//font awesome css
		wp_enqueue_style('rp_rp-font-awesome-5', WL_RP_RP_PLUGIN_URL.'css/font-awesome-latest/css/fontawesome-all.min.css');
       //tool-tip js & css
		wp_enqueue_script('rp_rp-tool-tip-js',WL_RP_RP_PLUGIN_URL.'tooltip/jquery.darktooltip.min.js', array('jquery'));
		wp_enqueue_style('rp_rp-tool-tip-css', WL_RP_RP_PLUGIN_URL.'tooltip/darktooltip.min.css');


	    // enqueue style and script of code mirror 
	    wp_enqueue_style('rp_rp_codemirror-css', WL_RP_RP_PLUGIN_URL.'css/codemirror/codemirror.css');
	    wp_enqueue_style('rp_rp_blackboard', WL_RP_RP_PLUGIN_URL.'css/codemirror/blackboard.css');
	    wp_enqueue_style('rp_rp_show-hint-css', WL_RP_RP_PLUGIN_URL.'css/codemirror/show-hint.css');

	    wp_enqueue_script('rp_rp_codemirror-js',WL_RP_RP_PLUGIN_URL.'css/codemirror/codemirror.js',array('jquery'));
	    wp_enqueue_script('rp_rp_css-js',WL_RP_RP_PLUGIN_URL.'css/codemirror/rp_rp-css.js',array('jquery'));
	    wp_enqueue_script('rp_rp_css-hint-js',WL_RP_RP_PLUGIN_URL.'css/codemirror/css-hint.js',array('jquery'));
	}
	
	// Register Custom Post Type
	public function rp_rp_shortcode() {
		$labels = array(
			'name' => __('Recent Related Post And Page Pro','post type general name','rp_and_rp' ),
			'singular_name' => __('Recent Related Post And Page Pro','post type singular name','rp_and_rp' ),
			'menu_name' => __( 'RR Post & Page Pro', 'rp_and_rp'),
			'add_new' => __('Add New ', 'rp_and_rp' ),
			'add_new_item' => __('Add New ', 'rp_and_rp' ),
			'edit_item' => __('Edit Recent Related Post And Page Pro', 'rp_and_rp' ),
			'new_item' => __('New Recent Related Post And Page Pro', 'rp_and_rp' ),
			'view_item' => __('View Recent Related Post And Page Pro', 'rp_and_rp' ),
			'search_items' => __('Search Recent Related Post And Page Pro', 'rp_and_rp' ),
			'not_found' => __('No data found', 'rp_and_rp' ),
			'not_found_in_trash' => __('No data found in Trash', 'rp_and_rp' ),
			'parent_item_colon' => __('Parent Recent Related Post And Page Pro:', 'rp_and_rp' ),
			'all_items' => __('All Shortcode', 'rp_and_rp' ),
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title'),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => false,
			'menu_position' => 65,
			'menu_icon' => 'dashicons-admin-post',
			'show_in_nav_menus' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => false,
			'capability_type' =>'post'
		);
		register_post_type( 'rp_and_rp', $args );
		add_filter( 'manage_edit-rp_and_rp_columns', array(&$this, 'rp_and_rp_columns' )) ;
		add_action( 'manage_rp_and_rp_posts_custom_column', array(&$this, 'rp_and_rp_manage_columns' ), 10, 2 );
	}
	
	function rp_and_rp_columns( $columns ) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Recent Related Post And Page' ),
			'shortcode' => __( 'Recent Related Post And Page Shortcode' ),
			'date' => __( 'Date' )
			);
		return $columns;
	}
	
	function rp_and_rp_manage_columns( $column, $post_id ) {
		global $post;
		switch( $column ) {
			case 'shortcode' :
			echo '<input type="text" value="[RRPP id='.$post_id.']" readonly="readonly" />';
			break;
			default :
			break;
		}
	}
	
    //add metaboxes
	public function Add_all_recent_post_meta_boxes() {
		add_meta_box( __(' Add Images', 'WL_R_P_R_P'), __('Select Template', 'WL_R_P_R_P'), array(&$this, 'post_image_meta_box_setting_function'), 'rp_and_rp', 'normal', 'low' );
		add_meta_box ( __('Add settings', 'WL_R_P_R_P'), __('Add settings', 'WL_R_P_R_P'), array(&$this, 'post_data_meta_box_setting_function'), 'rp_and_rp', 'normal', 'low');
		add_meta_box ( __('Recent Related Post And Page Box', 'WL_R_P_R_P'), __(' Recent Related Post And Page Shortcode', 'WL_R_P_R_P'), array(&$this, 'shotcode_meta_box_function'), 'rp_and_rp', 'side', 'low');
		add_meta_box ( __('Recent Related Post And Page Preview Box', 'WL_R_P_R_P'), __('Related and recent post Preview Box', 'WL_R_P_R_P'), array(&$this, 'rp_rp_preview_box'), 'rp_and_rp', 'side', 'low');
		add_meta_box(__('Recent Related Post And Page pro Widget', 'WL_R_P_R_P') , __('Recent Related Post And Page pro Widget', 'WL_R_P_R_P'), array(&$this,'rp_rp_use_widget_meta_box'), 'rp_and_rp', 'side', 'low');
	}
	
	//add setting page of general settings
	public function post_image_meta_box_setting_function($post) {
		require("settings/template-settings.php");
	}
	
	public function post_data_meta_box_setting_function($post) {
		require("settings/general-settings.php");
	}
	
    //display short code on custom post type page
	public function shotcode_meta_box_function() { ?>
		<p><?php _e("Use below shortcode in any Page/Post to publish your Recent Related Post And Page", 'WL_R_P_R_P');?></p>
		<input readonly="readonly" type="text" value="<?php echo "[RRPP id=".get_the_ID()."]"; ?>">
		<?php
	}
	
	public function rp_rp_preview_box() {
		if(isset($_REQUEST['post'])) {
			echo '<div style="text-align:center;padding:10px 0;">'._e('<h3 align="center">Click here to preview</h3>','WL_R_P_R_P').'<input alt="#TB_inline?height=800&amp;width=750&amp;inlineId=A_B_t_Popup1" title="Recent Related Post And Page Pro Preview" class="button-primary thickbox" type="button" value="Preview" /></div>';
			$ABT=$_REQUEST['post'];
			echo '<div id="A_B_t_Popup1"  style="width:auto%;height:100%;display:none"> <h2>Preview</h2>'.do_shortcode( '[RRPP id="'.$ABT.'"]').'</div>';
		} else {
			echo _e('<h4 align="center">Please publish first to preview</h4>','WL_R_P_R_P');
		}
	}
	
	function rp_rp_use_widget_meta_box(){
		?>
		<div>
			<p><?php _e("To activate widget into any widget area", 'WL_R_P_R_P');?></p>
			<p align="center"><a class="button button-primary button-hero" href="<?php get_site_url();?>./widgets.php" ><?php _e("Click Here", 'WL_R_P_R_P');?></a>. </p>
			<p><?php _e("Find",'WL_R_P_R_P')?> <b><?php _e("Recent Related Post And Page Pro Widget", 'WL_R_P_R_P');?></b> <?php _e("and place it to your widget area. Select any Shortcode for the dropdown and save changes.", 'WL_R_P_R_P');?></p>
		</div>
		<?php
	}

	//save data in database
	public function Nwt_Save_meta_box_save($PostID) {
		if(isset($_POST['post_order']) && isset($_POST['post_sta_tus'])) {
			// common-settings
			$show_hide = sanitize_text_field($_POST['show_hide']);
			$bottom_bdr_color = sanitize_text_field($_POST['bottom_bdr_color']);
			$bottom_bdr_size = sanitize_text_field($_POST['bottom_bdr_size']);
			$bottom_bdr_type = sanitize_text_field($_POST['bottom_bdr_type']);
			$link_align = sanitize_text_field($_POST['link_align']);
			$date_align = sanitize_text_field($_POST['date_align']);
			$date_back_Color = sanitize_text_field($_POST['date_back_Color']);
			$sliding_arrows_size = sanitize_text_field($_POST['sliding_arrows_size']);
			$hover_text_color = sanitize_text_field($_POST['hover_text_color']);
			$title_link = sanitize_text_field($_POST['title_link']);
			$silder_direction = sanitize_text_field($_POST['silder_direction']);
			$pause_silder = sanitize_text_field($_POST['pause_silder']);
			$arrow_color = sanitize_text_field($_POST['arrow_color']);
			$slider_speed = sanitize_text_field($_POST['slider_speed']);
			$hover_Color = sanitize_text_field($_POST['hover_Color']);
			$slider_speed_value = sanitize_text_field($_POST['slider_speed_value']);
			$post_in_slide = sanitize_text_field($_POST['post_in_slide']);
			$total_post_value = sanitize_text_field($_POST['total_post_value']);
			$checkboxvar_post = sanitize_text_field($_POST['checkboxvar_post']);
			$checkboxvar_page = sanitize_text_field($_POST['checkboxvar_page']);
			$order_by = sanitize_text_field($_POST['order_by']);
			$post_sta_tus = sanitize_text_field($_POST['post_sta_tus']);
			$post_order = sanitize_text_field($_POST['post_order']);
			$charcter_limit = sanitize_text_field($_POST['charcter_limit']);
			$char_font_size = sanitize_text_field($_POST['char_font_size']);
			$char_color = sanitize_text_field($_POST['char_color']);
			$back_ground_color = sanitize_text_field($_POST['back_ground_color']);
			$dis_char_lmit = sanitize_text_field($_POST['dis_char_lmit']);
			$dis_font_size = sanitize_text_field($_POST['dis_font_size']);
			$dis_text_Color = sanitize_text_field($_POST['dis_text_Color']);
			$date_font_size = sanitize_text_field($_POST['date_font_size']);
			$date_font_color = sanitize_text_field($_POST['date_font_color']);
			$link_text = stripslashes($_POST['link_text']);
			$link_font_size = sanitize_text_field($_POST['link_font_size']);
			$link_font_Color = sanitize_text_field($_POST['link_font_Color']);
			$link_back_Color = sanitize_text_field($_POST['link_back_Color']);
			$NWT_Font_Style = sanitize_text_field($_POST['NWT_Font_Style']);
			$nwt_custom_css = stripslashes($_POST['nwt_custom_css']);
			
			//Template-1
			$featured_image_1 = sanitize_text_field($_POST['featured_image_1']);
			$user_image_1 = sanitize_text_field($_POST['user_image_1']);
			$img_bdr_type_1 = sanitize_text_field($_POST['img_bdr_type_1']);
			$bdr_size_1 = sanitize_text_field($_POST['bdr_size_1']);
			$img_bdr_color_1 = sanitize_text_field($_POST['img_bdr_color_1']);
			$layout_1 = sanitize_text_field($_POST['layout_1']);
			
			//Template-2
			$featured_image_2 = sanitize_text_field($_POST['featured_image_2']);
			$user_image_2 = sanitize_text_field($_POST['user_image_2']);
			$img_bdr_type_2 = sanitize_text_field($_POST['img_bdr_type_2']);
			$bdr_size_2 = sanitize_text_field($_POST['bdr_size_2']);
			$img_bdr_color_2 = sanitize_text_field($_POST['img_bdr_color_2']);
			$layout_2 = sanitize_text_field($_POST['layout_2']);
			
			//Template-3
			$featured_image_3 = sanitize_text_field($_POST['featured_image_3']);
			$back_user_image_3 = sanitize_text_field($_POST['back_user_image_3']);
			$back_image_height_3 = sanitize_text_field($_POST['back_image_height_3']);
			
			//Template-4
			$featured_image_4 = sanitize_text_field($_POST['featured_image_4']);
			$user_image_4 = sanitize_text_field($_POST['user_image_4']);
			$img_bdr_type_4 = sanitize_text_field($_POST['img_bdr_type_4']);
			$bdr_size_4 = sanitize_text_field($_POST['bdr_size_4']);
			$img_bdr_color_4 = sanitize_text_field($_POST['img_bdr_color_4']);
			$layout_4 = sanitize_text_field($_POST['layout_4']);
			
			//Template-5
			$featured_image_5 = sanitize_text_field($_POST['featured_image_5']);
			$header_image_5 = sanitize_text_field($_POST['header_image_5']);
			 
			 //Template-6
			$featured_image_6 = sanitize_text_field($_POST['featured_image_6']);
			$back_user_image_6 = sanitize_text_field($_POST['back_user_image_6']);
			
			//Template-7
			$featured_image_7 = sanitize_text_field($_POST['featured_image_7']);
			$back_user_image_7 = sanitize_text_field($_POST['back_user_image_7']);
			$img_bdr_type_7 = sanitize_text_field($_POST['img_bdr_type_7']);
			$bdr_size_7 = sanitize_text_field($_POST['bdr_size_7']);
			$img_bdr_color_7 = sanitize_text_field($_POST['img_bdr_color_7']);
			$back_image_height_7 = sanitize_text_field($_POST['back_image_height_7']);
			
			//Template-8
			$featured_image_8 = sanitize_text_field($_POST['featured_image_8']);
			$back_user_image_8 = sanitize_text_field($_POST['back_user_image_8']);
		   
			$Tem_pl_at_e = sanitize_text_field($_POST['Tem_pl_at_e']);
			$NWTArray[] = array(

				'link_align' => $link_align,
				'bottom_bdr_color' => $bottom_bdr_color,
				'bottom_bdr_size' => $bottom_bdr_size,
				'bottom_bdr_type' => $bottom_bdr_type,
				  
				'date_align' => $date_align,
				'date_back_Color' => $date_back_Color,
				'sliding_arrows_size' => $sliding_arrows_size,
				'hover_text_color' => $hover_text_color,
				'title_link' => $title_link,
				'silder_direction' => $silder_direction,
				'pause_silder' => $pause_silder,
				'arrow_color' => $arrow_color,
				'slider_speed' => $slider_speed,
				'hover_Color' => $hover_Color,
				'slider_speed_value' => $slider_speed_value,
				'post_in_slide' => $post_in_slide,
				'total_post_value' => $total_post_value,
				'checkboxvar_post' => $checkboxvar_post,
				'checkboxvar_page' => $checkboxvar_page,
				'order_by' => $order_by,
				'post_sta_tus' => $post_sta_tus,
				'post_order' => $post_order,
				'charcter_limit' => $charcter_limit,
				'char_font_size' => $char_font_size,
				'char_color' => $char_color,
				'back_ground_color' => $back_ground_color,
				'dis_char_lmit' => $dis_char_lmit,
				'dis_font_size' => $dis_font_size,
				'dis_text_Color' => $dis_text_Color,
				'date_font_size' => $date_font_size,
				'date_font_color' => $date_font_color,
				'link_text' => $link_text,
				'link_font_size' => $link_font_size,
				'link_font_Color' => $link_font_Color,
				'link_back_Color' => $link_back_Color,
				'NWT_Font_Style' => $NWT_Font_Style,
				'nwt_custom_css' => $nwt_custom_css,
				'show_hide' => $show_hide,
				'Tem_pl_at_e' => $Tem_pl_at_e,
				
				'featured_image_1' => $featured_image_1,
				'user_image_1' => $user_image_1,
				'img_bdr_type_1' => $img_bdr_type_1,
				'bdr_size_1' => $bdr_size_1,
				'img_bdr_color_1' => $img_bdr_color_1,
				'layout_1' => $layout_1,
				
				'featured_image_2' => $featured_image_2,
				'user_image_2' => $user_image_2,
				'img_bdr_type_2' => $img_bdr_type_2,
				'bdr_size_2' => $bdr_size_2,
				'img_bdr_color_2' => $img_bdr_color_2,
				'layout_2' => $layout_2,
				
				'featured_image_3' => $featured_image_3,
				'back_user_image_3' => $back_user_image_3,
				'back_image_height_3' => $back_image_height_3,
				 
				'featured_image_4' => $featured_image_4,
				'user_image_4' => $user_image_4,
				'img_bdr_type_4' => $img_bdr_type_4,
				'bdr_size_4' => $bdr_size_4,
				'img_bdr_color_4' => $img_bdr_color_4,
				'layout_4' => $layout_4,
				
				'featured_image_5' => $featured_image_5,
				'header_image_5' => $header_image_5,
				 
				'featured_image_6' => $featured_image_6,
				'back_user_image_6' => $back_user_image_6,
				
				'featured_image_7' => $featured_image_7,
				'back_user_image_7' => $back_user_image_7,
				'img_bdr_type_7' => $img_bdr_type_7,
				'bdr_size_7' => $bdr_size_7,
				'img_bdr_color_7' => $img_bdr_color_7,
				'back_image_height_7' => $back_image_height_7,
				
				'featured_image_8' => $featured_image_8,
				'back_user_image_8' => $back_user_image_8,			
			);
			$R_P_A_R_P_Settings_="R_P_A_R_P_Settings_".$PostID;
			update_post_meta($PostID, $R_P_A_R_P_Settings_, serialize($NWTArray));
		}
	}
} //end of class

//create object of About_me_shorcode_and_widget class
global $RP_RP_PRO;
$RP_RP_PRO = new RP_RP_PRO();
require_once("recent-related-post-and-page-shortcode.php");
require_once("recent-related-post-and-page-widget-code.php");

//add media button fuction
add_action('media_buttons_context', 'rp_rp_add_rpg_custom_button');
add_action('admin_footer', 'rp_rp_add_rpg_inline_popup_content');

function rp_rp_add_rpg_custom_button($context) {
	$container_id = 'RPRP';
	$title =  __('Select  Recent Related Post And Page Shortcode to insert with content','WL_R_P_R_P') ;
	$context = '<a class="button button-primary thickbox"  title="'. __("Select Recent Related Post And Page Shortcode to insert into content",'WL_R_P_R_P').'"
	href="#TB_inline?width=400&inlineId='.$container_id.'">
	'. __(" Related & Recent Posts","'WL_R_P_R_P'").'
	</a>';
	return $context;
}

function rp_rp_add_rpg_inline_popup_content() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#RP_RP_insert').on('click', function() {
				var id = jQuery('#rp_rp_post option:selected').val();
				window.send_to_editor('<p>[RRPP id=' + id + ']</p>');
				tb_remove();
			})
		});
	</script>
	<div id="RPRP" style="display:none;">
		<?php $all_posts = wp_count_posts( 'rp_and_rp')->publish; 
		if(!$all_posts==null) { ?>
			<h3><?php _e('Select Recent Related Post And Page Shortcode To Insert Into Post','WL_R_P_R_P');?></h3>
			<select id="rp_rp_post">
				<?php
				global $wpdb;
				$shortcodegallerys = $wpdb->get_results("SELECT post_title, ID FROM $wpdb->posts WHERE post_status = 'publish'	AND post_type='rp_and_rp' ");	
				foreach ($shortcodegallerys as $shortcodegallery) {
					if($shortcodegallery->post_title) { $title_var=$shortcodegallery->post_title; } else { $title_var="(no title)"; }
					echo "<option value='".$shortcodegallery->ID."'>".$title_var."</option>";
				} ?>
			</select>
			<button class='button primary' id='RP_RP_insert'><?php _e('Insert Recent Related Post And Page Shortcode','WL_R_P_R_P');?></button>
			<?php 
		} else {
			?><h1 align="center"><?php _e('Sorry! No Shortcode found.','WL_R_P_R_P');?></h1><?php
		}
		?>
	</div>
	<?php
}
	
	function Load_related_post_and_page_info_after_post_content($content){
		if (is_single() && get_post_type( $post = get_post() ) == "post") {
			$ABio_settings = unserialize(get_option('rp_rp_info_Settings'));
			$use_post=$ABio_settings[0]['post_rp_rp_short_code'];
			$switch_off_post = $ABio_settings[0]['switch_off_post'];
			if($switch_off_post=='yes') {
				if($use_post) {
					$content .= page_post_r_p_a_r_p($use_post);
				}
			}
		}
		return $content;
	}
	add_filter( "the_content", "Load_related_post_and_page_info_after_post_content", 20);

	function Load_related_post_and_page_info_after_page_content($content) {
		if (!is_single()  && get_post_type( $post = get_post() ) == "page") {
			$ABio_settings = unserialize(get_option('rp_rp_info_Settings'));
			$use_page=$ABio_settings[0]['page_rp_rp_short_code'];
			$switch_off_page = $ABio_settings[0]['switch_off_page'];
			if($switch_off_page=='yes') {
				if($use_page) {
					$content .= page_post_r_p_a_r_p($use_page);
				}
			}
		}
		return $content;
	}
	add_filter( "the_content", "Load_related_post_and_page_info_after_page_content", 20 );
	require_once("on-page-post-settings/on-page-post-shortcode.php");
?>