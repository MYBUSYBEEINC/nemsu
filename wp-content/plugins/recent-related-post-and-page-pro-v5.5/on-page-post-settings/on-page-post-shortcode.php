<?php
function page_post_r_p_a_r_p($Id)
{
	ob_start();

	if(isset($Id))
	{
		$RPARP_CPT_Name = "rp_and_rp";
		$AllRPARP = array(  'p' => $Id, 'post_type' => $RPARP_CPT_Name, 'orderby' => 'ASC', 'post_status' => 'publish');
		$loop = new WP_Query( $AllRPARP );
		while ( $loop->have_posts() ) : $loop->the_post();
		$ID = get_the_ID();
		$RPARP_Settings= "R_P_A_R_P_Settings_".$ID;
		$RPARP_M_sets = unserialize(get_post_meta( $ID, $RPARP_Settings, true));

		foreach($RPARP_M_sets as $RPARP_Setting)
		{
			$p_o_s_t=$ID;
			//common-settings
			$bottom_bdr_color = $RPARP_Setting['bottom_bdr_color'];
			$bottom_bdr_size = $RPARP_Setting['bottom_bdr_size'];
			$bottom_bdr_type = $RPARP_Setting['bottom_bdr_type'];
			$link_align = $RPARP_Setting['link_align'];
			$date_align = $RPARP_Setting['date_align'];
			$date_back_Color = $RPARP_Setting['date_back_Color'];
			$sliding_arrows_size = $RPARP_Setting['sliding_arrows_size'];
			$hover_text_color = $RPARP_Setting['hover_text_color'];
			$title_link = $RPARP_Setting['title_link'];
			$post_order = $RPARP_Setting['post_order'];
			$post_sta_tus = $RPARP_Setting['post_sta_tus'];
			$checkboxvar_page = $RPARP_Setting['checkboxvar_page'];
			$checkboxvar_post = $RPARP_Setting['checkboxvar_post'];
			$order_by = $RPARP_Setting['order_by'];
			$arrow_color = $RPARP_Setting['arrow_color'];
			$hover_Color = $RPARP_Setting['hover_Color'];
			$total_post_value = $RPARP_Setting['total_post_value'];
			$post_in_slide = $RPARP_Setting['post_in_slide'];
			$slider_speed_value = $RPARP_Setting['slider_speed_value'];
			$pause_silder = $RPARP_Setting['pause_silder'];
			$silder_direction = $RPARP_Setting['silder_direction'];
			$slider_speed = $RPARP_Setting['slider_speed'];
			$charcter_limit = $RPARP_Setting['charcter_limit'];
			$char_font_size = $RPARP_Setting['char_font_size'];
			$char_color = $RPARP_Setting['char_color'];
			$back_ground_color = $RPARP_Setting['back_ground_color'];
			$dis_char_lmit = $RPARP_Setting['dis_char_lmit'];
			$dis_font_size = $RPARP_Setting['dis_font_size'];
			$dis_text_Color = $RPARP_Setting['dis_text_Color'];
			$date_font_size = $RPARP_Setting['date_font_size'];
			$date_font_color = $RPARP_Setting['date_font_color'];
			$link_text = $RPARP_Setting['link_text'];
			$link_font_size = $RPARP_Setting['link_font_size'];
			$link_font_Color = $RPARP_Setting['link_font_Color'];
			$link_back_Color = $RPARP_Setting['link_back_Color'];
			$NWT_Font_Style = $RPARP_Setting['NWT_Font_Style'];
			$nwt_custom_css = $RPARP_Setting['nwt_custom_css'];
			$show_hide = $RPARP_Setting['show_hide'];
			
			//Template-style-1
			$featured_image_1 = $RPARP_Setting['featured_image_1'];
			$user_image_1 = $RPARP_Setting['user_image_1'];
	        $img_bdr_type_1 = $RPARP_Setting['img_bdr_type_1'];
	        $bdr_size_1 = $RPARP_Setting['bdr_size_1'];
	        $img_bdr_color_1 = $RPARP_Setting['img_bdr_color_1'];
	        $layout_1 = $RPARP_Setting['layout_1'];
			
			//Template-style-2
			$featured_image_2 = $RPARP_Setting['featured_image_2'];
			$user_image_2 = $RPARP_Setting['user_image_2'];
			$img_bdr_type_2 = $RPARP_Setting['img_bdr_type_2'];
			$bdr_size_2 = $RPARP_Setting['bdr_size_2'];
			$img_bdr_color_2 = $RPARP_Setting['img_bdr_color_2'];
			$layout_2 = $RPARP_Setting['layout_2'];
			
			//Template-style-3
			 $featured_image_3 = $RPARP_Setting['featured_image_3'];
			 $back_user_image_3 = $RPARP_Setting['back_user_image_3'];
			 $back_image_height_3 = $RPARP_Setting['back_image_height_3'];
					
			//Template-style-4
			$featured_image_4 = $RPARP_Setting['featured_image_4'];
			$user_image_4 = $RPARP_Setting['user_image_4'];
			$img_bdr_type_4 = $RPARP_Setting['img_bdr_type_4'];
			$bdr_size_4 = $RPARP_Setting['bdr_size_4'];
			$img_bdr_color_4 = $RPARP_Setting['img_bdr_color_4'];
			$layout_4 = $RPARP_Setting['layout_4'];
			
			//Template-style-5
			$featured_image_5 = $RPARP_Setting['featured_image_5'];
			$header_image_5 = $RPARP_Setting['header_image_5'];
			
			//Template-style-6
			$featured_image_6 = $RPARP_Setting['featured_image_6'];
			$back_user_image_6 = $RPARP_Setting['back_user_image_6'];
			
			//Template-style-7
			$featured_image_7 = $RPARP_Setting['featured_image_7'];
		    $back_user_image_7 = $RPARP_Setting['back_user_image_7'];
			$img_bdr_type_7 = $RPARP_Setting['img_bdr_type_7'];
			$bdr_size_7 = $RPARP_Setting['bdr_size_7'];
			$img_bdr_color_7 = $RPARP_Setting['img_bdr_color_7'];
			$back_image_height_7 = $RPARP_Setting['back_image_height_7'];
			
			//Template-style-8
			$featured_image_8 = $RPARP_Setting['featured_image_8'];
			$back_user_image_8 = $RPARP_Setting['back_user_image_8'];
			if($slider_speed=="slow" || $slider_speed=="medium" || $slider_speed=="fast" ) {  $slider_speed_value="3000"; } else {  $slider_speed_value; }
			$Tem_pl_at_e = $RPARP_Setting['Tem_pl_at_e'];
            $a=uniqid();
			include("shortcode-files/slidercode.php");
			if($Tem_pl_at_e=='11')
			{
				include("shortcode-files/shortcode-1.php");
			}
			if($Tem_pl_at_e=='12')
			{
				include("shortcode-files/shortcode-2.php");
			}
			if($Tem_pl_at_e=='13')
			{
				include("shortcode-files/shortcode-3.php");
			}
			if($Tem_pl_at_e=='14')
			{
				include("shortcode-files/shortcode-4.php");
			}
			if($Tem_pl_at_e=='15')
			{
				include("shortcode-files/shortcode-5.php");
			}
			if($Tem_pl_at_e=='16')
			{
				include("shortcode-files/shortcode-6.php");
			}
			if($Tem_pl_at_e=='17')
			{
				include("shortcode-files/shortcode-7.php");
			}
			if($Tem_pl_at_e=='18')
			{
				include("shortcode-files/shortcode-8.php");
			}


		}

		endwhile;
	}
	else
	{
		echo "<div align='center' class='alert alert-danger'>".__('Sorry! Invalid Shortcode Embedded', 'WL_R_P_R_P' )."</div>";
	}
	wp_reset_query();
	return ob_get_clean();

}?>