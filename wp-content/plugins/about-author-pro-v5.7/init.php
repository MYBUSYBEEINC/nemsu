<?php
add_action( 'plugins_loaded', 'myplugin_load_WL_ABTM_TXT_DM' );
/**
 * Load plugin textdomain.
 */
function myplugin_load_WL_ABTM_TXT_DM() {
	load_plugin_textdomain( WL_ABTM_TXT_DM, false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'admin_menu', array( 'WL_AAP_Menu', 'create_menu' ), 1 );
$wl_aap_lm_val = WL_AAP_LM::get_instance()->is_valid();

add_action( 'admin_menu', 'about_auhor_submenu_Settings_Page' );
function about_auhor_submenu_Settings_Page() {
	global $wl_aap_lm_val;
	if ( isset( $wl_aap_lm_val ) && $wl_aap_lm_val ) {
		add_submenu_page( 'about-author-pro-license', 'All Shortcodes', 'All Shortcodes', 'administrator', 'edit.php?post_type=about_author', null );
		add_submenu_page( 'about-author-pro-license', 'Add New ', 'Add New', 'administrator', 'post-new.php?post_type=about_author', null );
		add_submenu_page( 'about-author-pro-license', 'Author Settings', 'Author Settings', 'administrator', '', 'author_settings_function' );
	}
	add_submenu_page( 'about-author-pro-license', 'Help and Support ', 'Help and Support', 'administrator', 'about_author_pro', 'about_author_pro_page_function' );
	add_submenu_page( 'about-author-pro-license', 'Recommendation', 'Recommendation', 'administrator', 'author-plugin-recommendation', 'AUTHOR_plugin_recommendation' );
}

add_action( 'admin_enqueue_scripts', 'wp_enqueue_color_picker_my' );
function wp_enqueue_color_picker_my( $hook ) {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}

function about_author_pro_page_function() {
	require_once( "about-auhor-pro-help-and-support.php" );
}

function author_settings_function() {
	require_once( "author-setting-page.php" );
}

function AUTHOR_plugin_recommendation() {
	//css
	wp_enqueue_style( 'rp-recom-css', WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'css/recom.css' );
	require_once( "recommendations.php" );
}

function AAP_wl_remove_items() {
	delete_option( 'wl-aap-key' );
	delete_option( 'wl-aap-valid' );
	delete_option( 'wl-aap-cache' );
	delete_option( 'About_Author_Pro_updation_detail' );
}

class About_author_shortcode_and_widget {

	public function __construct() {
		if ( is_admin() ) {
			add_action( 'init', array( &$this, 'About_author_Shortcode' ) );
			add_action( 'add_meta_boxes', array( &$this, 'Add_all_about_author_meta_boxes' ), 1 );
			add_action( 'admin_enqueue_scripts', array( &$this, 'my_about_author_style_files' ), 1 );
			add_action( 'save_post', array( &$this, 'Abt_Save_fag_meta_box_save' ), 9, 1 );

		}
	}

	public function my_about_author_style_files( $hook ) {
		if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) {
			return;
		}
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'theme-preview' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'upload_media_widget', WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'js/upload-media.js', array( 'jquery' ) );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_style( 'font-awesome-latest', WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL . 'css/font-awesome-latest/css/fontawesome-all.min.css' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}


	// Register Custom Post Type
	public function About_author_Shortcode() {
		$labels = array(
			'name'               => __( 'About Author Shortcode & Widget', 'post type general name', 'about_author' ),
			'singular_name'      => __( 'About Author Shortcode And Widget', 'post type singular name', 'about_author' ),
			'menu_name'          => __( 'About Author', 'about_author' ),
			'add_new'            => __( 'Add New', 'about_author' ),
			'add_new_item'       => __( 'Add New', 'about_author' ),
			'edit_item'          => __( 'Edit About Author', 'about_author' ),
			'new_item'           => __( 'New About Author', 'about_author' ),
			'view_item'          => __( 'View About Author', 'about_author' ),
			'search_items'       => __( 'Search About Author', 'about_author' ),
			'not_found'          => __( 'No data found', 'about_author' ),
			'not_found_in_trash' => __( 'No data found in Trash', 'about_author' ),
			'parent_item_colon'  => __( 'Parent About_author:', 'about_author' ),
			'all_items'          => __( 'All Shortcode', 'about_author' ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'supports'            => array( 'title' ),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'menu_position'       => 65,
			'menu_icon'           => 'dashicons-id',
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => false,
			'capability_type'     => 'post'
		);
		register_post_type( 'about_author', $args );

		add_filter( 'manage_edit-about_author_columns', array( &$this, 'about_author_columns' ) );
		add_action( 'manage_about_author_posts_custom_column', array( &$this, 'about_author_manage_columns' ), 10, 2 );
	}

	function about_author_columns( $columns ) {
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'title'     => __( 'About Author' ),
			'shortcode' => __( 'About Author Shortcode' ),
			'date'      => __( 'Date' )
		);

		return $columns;
	}

	function about_author_manage_columns( $column, $post_id ) {
		global $post;
		switch ( $column ) {
			case 'shortcode' :
				echo '<input type="text" value="[ABTM id=' . $post_id . ']" readonly="readonly" />';
				break;
			default :
				break;
		}
	}

	//add metaboxes

	public function Add_all_about_author_meta_boxes() {
		add_meta_box( __( ' Add Images', WL_ABTM_TXT_DM ), __( 'Select Template', WL_ABTM_TXT_DM ), array(
			&$this,
			'about_author_meta_box_setting_function'
		), 'about_author', 'normal', 'low' );
		add_meta_box( __( 'Add set-tt-ings', WL_ABTM_TXT_DM ), __( 'Add settings', WL_ABTM_TXT_DM ), array(
			&$this,
			'me_meta_box_setting_function'
		), 'about_author', 'normal', 'low' );
		add_meta_box( __( 'About Author Shortcode', WL_ABTM_TXT_DM ), __( 'About Author Shortcode', WL_ABTM_TXT_DM ), array(
			&$this,
			'ABTM_shotcode_meta_box_function'
		), 'about_author', 'side', 'low' );
		add_meta_box( __( 'About Author Preview Box', WL_ABTM_TXT_DM ), __( 'About Author Preview Box', WL_ABTM_TXT_DM ), array(
			&$this,
			'ab_preview_box'
		), 'about_author', 'side', 'low' );
		add_meta_box( __( 'Activate About Author pro Widget', WL_ABTM_TXT_DM ), __( 'Activate About Author pro Widget', WL_ABTM_TXT_DM ), array(
			&$this,
			'abtm_use_widget_meta_box'
		), 'about_author', 'side', 'low' );
	}

	//add setting page of general settings
	public function about_author_meta_box_setting_function( $post ) {
		require( "settings/template-settings.php" );
	}

	public function me_meta_box_setting_function( $post ) {
		require( "settings/general-settings.php" );
	}

	//display short code on custom post type page
	public function ABTM_shotcode_meta_box_function() { ?>
        <p><?php _e( "Use below shortcode in any Page/Post to publish your Author information", WL_ABTM_TXT_DM ); ?></p>
        <input readonly="readonly" type="text" value="<?php echo "[ABTM id=" . get_the_ID() . "]"; ?>">
		<?php
	}

	public function ab_preview_box() {
		if ( isset( $_REQUEST['post'] ) ) {
			echo '
	<div style="text-align:center;padding:10px 0;">
		<h3>Click here to preview</h3>
		<input alt="#TB_inline?height=700&amp;width=750&amp;inlineId=A_B_t_Popup1" title="About me shortcode and widget pro preview" class="button-primary thickbox" type="button" value="Preview" />
	</div>';

			$ABT = $_REQUEST['post'];
			echo '
	<div id="A_B_t_Popup1"  style="width:100%;height:100%;display:none"> <h2>Preview</h2>' . do_shortcode( '[ABTM id="' . $ABT . '"]' ) . '</div>';
		} else {
			echo "<h4>please save first to preview</h4> ";
		}
	}

	function abtm_use_widget_meta_box() {
		?>
        <div>
            <p><?php _e( 'To activate widget into any widget area', WL_ABTM_TXT_DM ); ?></p>
            <p><a class="button button-primary button-hero"
                  href="<?php get_site_url(); ?>./widgets.php"><?php _e( 'Click Here', WL_ABTM_TXT_DM ); ?></a>. </p>
            <p> <?php _e( 'Find ', WL_ABTM_TXT_DM ); ?>
                <b><?php _e( 'About Author', WL_ABTM_TXT_DM ); ?></b> <?php _e( 'and place it to your widget area. Select any About Author Pro from the dropdown and save changes.', WL_ABTM_TXT_DM ); ?>
            </p>
        </div>
		<?php
	}

	//save data in database
	public function Abt_Save_fag_meta_box_save( $PostID ) {
		if ( isset( $_POST['About_author_user_name'] ) && isset( $_POST['About_author_web_site_name'] ) ) {
			$profile_user_image = $_POST['profile_user_image'];
			sanitize_file_name( $profile_user_image );
			$user_header_image = $_POST['user_header_image'];
			sanitize_file_name( $user_header_image );
			$temp9_user_header_image = $_POST['temp9_user_header_image'];
			sanitize_file_name( $temp9_user_header_image );
			$About_author_bg_color = sanitize_text_field( $_POST['About_author_bg_color'] );
			//$About_author_user_name = sanitize_text_field($_POST['About_author_user_name']);
			$About_author_user_name     = stripslashes_deep( $_POST['About_author_user_name'] );
			$About_author_user_name     = str_replace( "\\", "", $About_author_user_name );
			$About_author_web_site_name = sanitize_text_field( $_POST['About_author_web_site_name'] );
			//$About_author_dis_cription =  sanitize_text_field($_POST['About_author_dis_cription']);
			$About_author_dis_cription = stripslashes_deep( $_POST['About_author_dis_cription'] );
			$About_author_dis_cription = str_replace( "\\", "", $About_author_dis_cription );
			$followbitbucket           = sanitize_text_field( $_POST['followbitbucket'] );
			$followdropbox             = sanitize_text_field( $_POST['followdropbox'] );
			$followfb                  = sanitize_text_field( $_POST['followfb'] );
			$followflicker             = sanitize_text_field( $_POST['followflicker'] );
			$followgithub              = sanitize_text_field( $_POST['followgithub'] );
			$followgoogle              = sanitize_text_field( $_POST['followgoogle'] );
			$followinsta               = sanitize_text_field( $_POST['followinsta'] );
			$followlinkdln             = sanitize_text_field( $_POST['followlinkdln'] );
			$followpinterest           = sanitize_text_field( $_POST['followpinterest'] );
			$followtumbler             = sanitize_text_field( $_POST['followtumbler'] );
			$followtwit                = sanitize_text_field( $_POST['followtwit'] );
			$followtVk                 = sanitize_text_field( $_POST['followtVk'] );
			$followDigg                = sanitize_text_field( $_POST['followDigg'] );
			$followyoutube             = sanitize_text_field( $_POST['followyoutube'] );
			$followskype               = sanitize_text_field( $_POST['followskype'] );
			$followtelegram            = sanitize_text_field( $_POST['followtelegram'] );
			$followwhatsapp            = sanitize_text_field( $_POST['followwhatsapp'] );

			$bodr                      = sanitize_text_field( $_POST['bodr'] );
			$img_bdr_type              = sanitize_text_field( $_POST['img_bdr_type'] );
			$bdr_size                  = sanitize_text_field( $_POST['bdr_size'] );
			$img_bdr_color             = sanitize_text_field( $_POST['img_bdr_color'] );
			$name_font_size            = sanitize_text_field( $_POST['name_font_size'] );
			$name_Color                = sanitize_text_field( $_POST['name_Color'] );
			$weblink_font_size         = sanitize_text_field( $_POST['weblink_font_size'] );
			$weblink_text_color        = sanitize_text_field( $_POST['weblink_text_color'] );
			$dis_font_size             = sanitize_text_field( $_POST['dis_font_size'] );
			$dis_text_color            = sanitize_text_field( $_POST['dis_text_color'] );
			$PGPP_Font_Style           = sanitize_text_field( $_POST['PGPP_Font_Style'] );
			$About_author_social_color = sanitize_text_field( $_POST['About_author_social_color'] );
			$About_author_custom_css   = sanitize_text_field( $_POST['About_author_custom_css'] );
			$Tem_pl_at_e               = sanitize_text_field( $_POST['Tem_pl_at_e'] );
			$Social_icon_size          = sanitize_text_field( $_POST['Social_icon_size'] );

			$ABTArray[] = array(
				'About_author_bg_color'      => $About_author_bg_color,
				'About_author_user_name'     => $About_author_user_name,
				'About_author_web_site_name' => $About_author_web_site_name,
				'About_author_dis_cription'  => $About_author_dis_cription,
				'followbitbucket'            => $followbitbucket,
				'followdropbox'              => $followdropbox,
				'followfb'                   => $followfb,
				'followflicker'              => $followflicker,
				'followgithub'               => $followgithub,
				'followgoogle'               => $followgoogle,
				'followinsta'                => $followinsta,
				'followlinkdln'              => $followlinkdln,
				'followpinterest'            => $followpinterest,
				'followtumbler'              => $followtumbler,
				'followtwit'                 => $followtwit,
				'followtVk'                  => $followtVk,
				'followDigg'                 => $followDigg,
				'followyoutube'              => $followyoutube,
				'followskype'                => $followskype,
				'followtelegram'             => $followtelegram,
				'followwhatsapp'             => $followwhatsapp,

				'bodr'                      => $bodr,
				'img_bdr_type'              => $img_bdr_type,
				'bdr_size'                  => $bdr_size,
				'img_bdr_color'             => $img_bdr_color,
				'name_font_size'            => $name_font_size,
				'name_Color'                => $name_Color,
				'weblink_font_size'         => $weblink_font_size,
				'weblink_text_color'        => $weblink_text_color,
				'dis_font_size'             => $dis_font_size,
				'dis_text_color'            => $dis_text_color,
				'PGPP_Font_Style'           => $PGPP_Font_Style,
				'profile_user_image'        => $profile_user_image,
				'user_header_image'         => $user_header_image,
				'temp9_user_header_image'   => $temp9_user_header_image,
				'About_author_social_color' => $About_author_social_color,
				'About_author_custom_css'   => $About_author_custom_css,
				'Tem_pl_at_e'               => $Tem_pl_at_e,
				'Social_icon_size'          => $Social_icon_size,
			);

			$abt_Settings = "abt_Settings_" . $PostID;
			update_post_meta( $PostID, $abt_Settings, serialize( $ABTArray ) );
		}
	}

}

//create object of About_author_shortcode_and_widget class
global $About_author_shortcode_and_widget;
$About_author_shortcode_and_widget = new About_author_shortcode_and_widget();
//include short code file
require_once( "about-author-use-shortcode.php" );
// include widget code file
require_once( "about-author-widget-code.php" );
add_action( 'media_buttons_context', 'ABTM_add_rpg_custom_button' );
add_action( 'admin_footer', 'ABTM_add_rpg_inline_popup_content' );

//add media button fuction
function ABTM_add_rpg_custom_button( $context ) {
	$container_id = 'AASAW';
	$title        = __( 'Select About Author to insert into post', WL_ABTM_TXT_DM );
	$context      = '<a class="button button-primary thickbox"  title="' . __( "Select About Author to insert into post", WL_ABTM_TXT_DM ) . '"
	href="#TB_inline?width=400&inlineId=' . $container_id . '">
	' . __( "About Author & Widget Pro", "WL_ABTM_TXT_DM" ) . '
</a>';

	return $context;
}

function ABTM_add_rpg_inline_popup_content() {
	?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#Ab_tm_insert').on('click', function () {
                var id = jQuery('#Ab_Tm_ME option:selected').val();
                window.send_to_editor('<p>[ABTM id=' + id + ']</p>');
                tb_remove();
            })
        });
    </script>
    <div id="AASAW" style="display:none;">
        <h3><?php _e( 'Select About Author And Widget To Insert Into Post', WL_ABTM_TXT_DM ); ?></h3>
		<?php
		$all_posts = wp_count_posts( 'about_author' )->publish;
		$args      = array( 'post_type' => 'about_author', 'posts_per_page' => $all_posts );
		global $AMSAW_shortcode;
		$AMSAW_shortcode = new WP_Query( $args );
		if ( $AMSAW_shortcode->have_posts() ) { ?>
            <select id="Ab_Tm_ME">
				<?php
				while ( $AMSAW_shortcode->have_posts() ) : $AMSAW_shortcode->the_post();
					$PostId    = get_the_ID();
					$PostTitle = get_the_title( $PostId ); ?>
                    <option value="<?php echo $PostId; ?>"><?php if ( $PostTitle ) {
							echo $PostTitle;
						} else {
							echo "(no title)";
						} ?></option>
				<?php
				endwhile;
				?>
            </select>
            <button class='button primary'
                    id='Ab_tm_insert'><?php _e( 'Insert About Author Shortcode', WL_ABTM_TXT_DM ); ?></button>
			<?php
		} else {
			_e( 'No About Author found', WL_ABTM_TXT_DM );
		}
		?>
    </div>
	<?php
}

function fb_add_custom_user_profile_fields( $user ) {
	?>
    <h3><?php _e( 'Social Profile Information', 'your_textdomain' ); ?></h3>
    <table class="form-table">
        <tr>
            <th>
                <label><a target="_blank" style="text-decoration: none;"> <i
                                class="fa fa-facebook web_lizar_Social_icon"></i></a>Facebook</label>
            </th>
            <td><input id="followfb" name="followfb" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followfb', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th>
                <label> <a target="_blank" style="text-decoration: none;"><i
                                class="fa fa-twitter web_lizar_Social_icon"></i></a>Twitter</label>
            </th>
            <td><input id="followtwit" name="followtwit" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followtwit', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th>
                <label> <a target="_blank" style="text-decoration: none;"><i
                                class="fa fa-google-plus  web_lizar_Social_icon"></i></a> Google</label></th>
            <td><input id="followgoogle" name="followgoogle" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followgoogle', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th>
                <label> <a target="_blank" style="text-decoration: none;"> <i
                                class="fa fa-linkedin web_lizar_Social_icon"></i></a>LinkedIn</label>
            </th>
            <td><input id="followlinkdln" name="followlinkdln" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followlinkdln', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th>
                <label> <a target="_blank" style="text-decoration: none;"><i
                                class="fa fa-flickr web_lizar_Social_icon"></i> </a> Flickr</label>
            </th>
            <td><input id="followflicker" name="followflicker" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followflicker', $user->ID ) ); ?>"
                       class="regular-text"/>

            </td>
        </tr>
        <tr>
            <th>
                <label><a target="_blank" style="text-decoration: none;"><i
                                class="fa fa-pinterest web_lizar_Social_icon"></i></a>Pinterest</label>
            </th>
            <td><input id="followpinterest" name="followpinterest" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followpinterest', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th>
                <label><a target="_blank" style="text-decoration: none;"><i
                                class="fa fa-tumblr web_lizar_Social_icon"></i></a>Tumblr</label</th>
            <td><input id="followtumbler" name="followtumbler" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followtumbler', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th>
                <label> <a target="_blank" style="text-decoration: none;"><i id="bitbucket_jqs"
                                                                             class="fa fa-bitbucket web_lizar_Social_icon"></i></a>Bitbucket
                </label>
            </th>
            <td><input id="followbitbucket" name="followbitbucket" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followbitbucket', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th>
                <label><a target="_blank"><i class="fa fa-dropbox web_lizar_Social_icon"></i></a>Dropbox</label>
            </th>
            <td><input id="followdropbox" name="followdropbox" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followdropbox', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th>
                <label> <a target="_blank" style="text-decoration: none;"><i
                                class="fa fa-github web_lizar_Social_icon"></i> </a>Github</label>
            </th>
            <td><input id="followgithub" name="followgithub" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followgithub', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>

        <tr>
            <th><label><a target="_blank" style="text-decoration: none;"><i
                                class="fa fa-instagram web_lizar_Social_icon"></i></a> Instagram</label>
            </th>
            <td><input id="followinsta" name="followinsta" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followinsta', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>

        <tr>
            <th>
                <label> <a target="_blank" style="text-decoration: none;"> <i
                                class="fa fa-vk web_lizar_Social_icon"></i></a>VK</label>
            </th>
            <td><input id="followtVk" name="followtVk" type="text"
                       value="<?php echo esc_attr( get_the_author_meta( 'followtVk', $user->ID ) ); ?>"
                       class="regular-text"/>
            </td>
        </tr>
    </table>
<?php }

function fb_save_custom_user_profile_fields( $user_id ) {

	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	$metas = array(
		'followbitbucket' => sanitize_text_field( $_POST['followbitbucket'] ),
		'followdropbox'   => sanitize_text_field( $_POST['followdropbox'] ),
		'followfb'        => sanitize_text_field( $_POST['followfb'] ),
		'followflicker'   => sanitize_text_field( $_POST['followflicker'] ),
		'followgithub'    => sanitize_text_field( $_POST['followgithub'] ),
		'followgoogle'    => sanitize_text_field( $_POST['followgoogle'] ),
		'followinsta'     => sanitize_text_field( $_POST['followinsta'] ),
		'followlinkdln'   => sanitize_text_field( $_POST['followlinkdln'] ),
		'followpinterest' => sanitize_text_field( $_POST['followpinterest'] ),
		'followtumbler'   => sanitize_text_field( $_POST['followtumbler'] ),
		'followtwit'      => sanitize_text_field( $_POST['followtwit'] ),
		'followtVk'       => sanitize_text_field( $_POST['followtVk'] ),
		'followDigg'      => sanitize_text_field( $_POST['followDigg'] ),
		'followyoutube'   => sanitize_text_field( $_POST['followyoutube'] ),
		'followskype'     => sanitize_text_field( $_POST['followskype'] ),
		'followtelegram'  => sanitize_text_field( $_POST['followtelegram'] ),
		'followwhatsapp'  => sanitize_text_field( $_POST['followwhatsapp'] ),
	);

	foreach ( $metas as $key => $value ) {
		update_user_meta( $user_id, $key, $value );
	}

}

add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );

function Load_author_info_after_post_content( $content ) {
	if ( is_single() && get_post_type( $post = get_post() ) == "post" ) {
		$ABio_settings   = unserialize( get_option( 'author_info_Settings' ) );
		$use_page        = $ABio_settings[0]['Author_short_code'];
		$switch_off_post = $ABio_settings[0]['switch_off_post'];
		if ( $switch_off_post == 'yes' ) {
			if ( $use_page ) {
				$content .= do_shortcode( '[ABINFO id=' . $use_page . ']' );
			}
		}
	}

	return $content;
}

add_filter( "the_content", "Load_author_info_after_post_content", 20 );

function Load_author_info_after_page_content( $content ) {
	if ( ! is_single() && get_post_type( $post = get_post() ) == "page" ) {
		$ABio_settings   = unserialize( get_option( 'author_info_Settings' ) );
		if ($ABio_settings != false ) {
			$use_page        = $ABio_settings[0]['Author_short_code'];
			$switch_off_page = $ABio_settings[0]['switch_off_page'];
			if ($switch_off_page == 'yes') {
				if ($use_page) {
					$content .= do_shortcode('[ABINFO id=' . $use_page . ']');
				}
			}
		}
	}

	return $content;
}

add_filter( "the_content", "Load_author_info_after_page_content", 20 );
require_once( "author-setting/about-author-sttings-shortcode.php" );
?>