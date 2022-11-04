<?php
add_shortcode( 'ABTM', 'ABOUTMEUSER' );
function ABOUTMEUSER( $Id ) {

	ob_start();

	if ( isset( $Id['id'] ) ) {

		/**
		 * Load About_author Custom Post Type
		 */
		$ABTM_CPT_Name = "about_author";

		$AllABTM = array( 'p'           => $Id['id'],
		                  'post_type'   => $ABTM_CPT_Name,
		                  'orderby'     => 'ASC',
		                  'post_status' => 'publish'
		);
		$loop    = new WP_Query( $AllABTM );

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
				$About_author_user_name     = $ABT_Settings['About_author_user_name'];
				$About_author_web_site_name = $ABT_Settings['About_author_web_site_name'];
				$About_author_dis_cription  = $ABT_Settings['About_author_dis_cription'];
				$followbitbucket            = $ABT_Settings['followbitbucket'];
				$followdropbox              = $ABT_Settings['followdropbox'];
				$followfb                   = $ABT_Settings['followfb'];
				$followflicker              = $ABT_Settings['followflicker'];
				$followgithub               = $ABT_Settings ['followgithub'];
				$followgoogle               = $ABT_Settings['followgoogle'];
				$followinsta                = $ABT_Settings['followinsta'];
				$followlinkdln              = $ABT_Settings['followlinkdln'];
				$followpinterest            = $ABT_Settings['followpinterest'];
				$followtumbler              = $ABT_Settings['followtumbler'];
				$followtwit                 = $ABT_Settings['followtwit'];
				$followtVk                  = $ABT_Settings['followtVk'];
				$followDigg                 = $ABT_Settings['followDigg'];
				$followyoutube              = $ABT_Settings['followyoutube'];
				$followskype                = $ABT_Settings['followskype'];
				$followtelegram             = $ABT_Settings['followtelegram'];
				$followwhatsapp             = $ABT_Settings['followwhatsapp'];

				$bodr           = $ABT_Settings['bodr'];
				$img_bdr_type   = $ABT_Settings['img_bdr_type'];
				$bdr_size       = $ABT_Settings['bdr_size'];
				$img_bdr_color  = $ABT_Settings['img_bdr_color'];
				$name_font_size = $ABT_Settings['name_font_size'];
				$name_Color     = $ABT_Settings['name_Color'];

				$weblink_font_size  = $ABT_Settings['weblink_font_size'];
				$weblink_text_color = $ABT_Settings['weblink_text_color'];

				$dis_font_size  = $ABT_Settings['dis_font_size'];
				$dis_text_color = $ABT_Settings['dis_text_color'];

				$name_font_family          = $ABT_Settings['PGPP_Font_Style'];
				$About_author_social_color = $ABT_Settings['About_author_social_color'];
				$About_author_custom_css   = $ABT_Settings['About_author_custom_css'];
				$Tem_pl_at_e               = $ABT_Settings['Tem_pl_at_e'];
				$Social_icon_size          = $ABT_Settings['Social_icon_size'];
				$Us_sr_H_der_img_Witdh     = "100";
				$Us_sr_H_der_img_High      = "100";
				$my_hea_der_im_g           = " ";
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
		echo "<div align='center' class='alert alert-danger'>" . __( "Sorry! Invalid About Author Shortcode Embedded", WEBLIZAR_ABOUT_ME_PLUGIN_DOMAIN ) . "</div>";
	}
	wp_reset_query();

	return ob_get_clean();
} ?>