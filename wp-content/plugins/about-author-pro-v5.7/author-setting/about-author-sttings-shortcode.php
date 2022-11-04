<?php
add_shortcode( 'ABINFO', 'ABOUTMEUSER2' );
function ABOUTMEUSER2( $Id ) {

	ob_start();

	if ( isset( $Id['id'] ) ) {

		/**
		 * Load About_author Custom Post Type
		 */
		$post_id       = get_the_ID();
		$post_info     = get_post( get_the_ID() );
		$author        = $post_info->post_author;
		$ABTM_CPT_Name = "about_author";
		$AllABTM       = array(
			'p'           => $Id['id'],
			'post_type'   => $ABTM_CPT_Name,
			'orderby'     => 'ASC',
			'post_status' => 'publish'
		);
		$loop          = new WP_Query( $AllABTM );
		while ( $loop->have_posts() ) : $loop->the_post();

			$ID           = get_the_ID();
			$abt_Settings = "abt_Settings_" . $ID;
			$ABT_M_sets   = unserialize( get_post_meta( $ID, $abt_Settings, true ) );
			foreach ( $ABT_M_sets as $ABT_Settings ) {
				$p_o_s_t                    = $ID;
				$profile_user_image         = $ABT_Settings['profile_user_image'];
				$user_header_image          = $ABT_Settings['user_header_image'];
				$temp9_user_header_image    = $ABT_Settings['temp9_user_header_image'];
				$About_author_bg_color      = $ABT_Settings['About_author_bg_color'];
				$user_ID                    = $author;
				$user_info                  = get_userdata( $user_ID );
				$name                       = get_user_meta( $user_ID, 'first_name', true );
				$last_name                  = get_user_meta( $user_ID, 'last_name', true );
				$About_author_user_name     = $name . ' ' . $last_name;
				$About_author_dis           = get_user_meta( $user_ID, 'description', true );
				$About_author_web_site_name = $user_info->user_url;
				$followbitbucket            = get_user_meta( $user_ID, 'followbitbucket', true );
				$followdropbox              = get_user_meta( $user_ID, 'followdropbox', true );
				$followfb                   = get_user_meta( $user_ID, 'followfb', true );
				$followflicker              = get_user_meta( $user_ID, 'followflicker', true );
				$followgithub               = get_user_meta( $user_ID, 'followgithub', true );
				$followgoogle               = get_user_meta( $user_ID, 'followgoogle', true );
				$followinsta                = get_user_meta( $user_ID, 'followinsta', true );
				$followlinkdln              = get_user_meta( $user_ID, 'followlinkdln', true );
				$followpinterest            = get_user_meta( $user_ID, 'followpinterest', true );
				$followtumbler              = get_user_meta( $user_ID, 'followtumbler', true );
				$followtwit                 = get_user_meta( $user_ID, 'followtwit', true );
				$followtVk                  = get_user_meta( $user_ID, 'followtVk', true );
				$followDigg                 = get_user_meta( $user_ID, 'followDigg', true );
				$followyoutube              = get_user_meta( $user_ID, 'followyoutube', true );
				$followskype                = get_user_meta( $user_ID, 'followskype', true );
				$followtelegram             = get_user_meta( $user_ID, 'followtelegram', true );
				$followwhatsapp             = get_user_meta( $user_ID, 'followwhatsapp', true );


				$bodr                      = $ABT_Settings['bodr'];
				$img_bdr_type              = $ABT_Settings['img_bdr_type'];
				$bdr_size                  = $ABT_Settings['bdr_size'];
				$img_bdr_color             = $ABT_Settings['img_bdr_color'];
				$name_font_size            = $ABT_Settings['name_font_size'];
				$name_Color                = $ABT_Settings['name_Color'];
				$weblink_font_size         = $ABT_Settings['weblink_font_size'];
				$weblink_text_color        = $ABT_Settings['weblink_text_color'];
				$dis_font_size             = $ABT_Settings['dis_font_size'];
				$dis_text_color            = $ABT_Settings['dis_text_color'];
				$name_font_family          = $ABT_Settings['PGPP_Font_Style'];
				$About_author_social_color = $ABT_Settings['About_author_social_color'];
				$About_author_custom_css   = $ABT_Settings['About_author_custom_css'];
				$Tem_pl_at_e               = $ABT_Settings['Tem_pl_at_e'];
				$Social_icon_size          = $ABT_Settings['Social_icon_size'];
				$Us_sr_H_der_img_Width     = "100";
				$Us_sr_H_der_img_High      = "100";
				$my_hea_der_im_g           = " ";
				$use_dis_cription          = substr( $About_author_dis, 0, 325 );
				$count_discription         = strlen( $About_author_dis );
				if ( $count_discription > 325 ) {
					$About_author_dis_cription = $use_dis_cription . '......';
				} else {
					$About_author_dis_cription = $use_dis_cription;
				}
				if ( $bodr == true ) {
					if ( $bodr == '1' ) {
						$my_bodr = "border-radius:50% 50% 50% 50%";
					}
					if ( $bodr == '2' ) {
						$my_bodr = "border-radius:10% 50% 10% 50%";

					}
					if ( $bodr == '3' ) {
						$my_bodr = "border-radius:0% 0% 0% 0%";
					}
					if ( $bodr == '4' ) {
						$my_bodr = "border-radius:10% 60% 10% 10%";

					}
					if ( $bodr == '5' ) {
						$my_bodr = "border-radius:60% 60% 10% 10%";

					}
					if ( $bodr == '6' ) {
						$my_bodr = "border-radius:100% 0% 0% 0%";

					}
					if ( $bodr == '7' ) {
						$my_bodr = "border-radius:100% 0% 0% 500%";

					}
					if ( $bodr == '8' ) {
						$my_bodr = "border-radius:50% 50% 50% 50% / 60% 60% 40% 40%";
					}
				}
				if ( $Tem_pl_at_e == '11' ) {
					include( "shortcode-files/template-1-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '12' ) {
					include( "shortcode-files/template-2-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '13' ) {
					include( "shortcode-files/template-3-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '14' ) {
					include( "shortcode-files/template-4-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '15' ) {
					include( "shortcode-files/template-5-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '16' ) {
					include( "shortcode-files/template-6-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '17' ) {
					include( "shortcode-files/template-7-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '18' ) {
					include( "shortcode-files/template-8-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '19' ) {
					include( "shortcode-files/template-9-shortcode.php" );
				}
				if ( $Tem_pl_at_e == '20' ) {
					include( "shortcode-files/template-10-shortcode.php" );
				}
				?>

				<?php
			}// end of foreach

		endwhile;
	} else {
		echo "<div align='center' class='alert alert-danger'>" . __( "Sorry! Invalid About Author Shortcode Embedded", WL_ABTM_TXT_DM ) . "</div>";
	}
	wp_reset_query();

	return ob_get_clean();
} ?>