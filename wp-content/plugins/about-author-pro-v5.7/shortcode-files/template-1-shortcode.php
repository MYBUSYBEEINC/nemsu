<style>
    @import url(<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL."css/font-awesome-latest/css/fontawesome-all.min.css"; ?>);

    .menu span a:before {
        font-family: Font Awesome\ 5 Brands;
        speak: none;
        text-indent: 0em;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #A_b_t_main_<?php echo esc_attr($p_o_s_t); ?>.web_lizar_main_div {
        width: auto;
        height: auto;
        border: 1px solid #ccc;
        background-color: <?php echo esc_attr($About_author_bg_color);?>;
        overflow: hidden;
    }

    #A_b_t_img_<?php echo esc_attr($p_o_s_t); ?>.web_lizar_image_div {
        margin-top: 35px;
    }

    #A_b_t_img_<?php echo esc_attr($p_o_s_t); ?> img.web_lizar_image_User {
    <?php echo esc_attr($my_bodr); ?>;
        border: <?php echo esc_attr($bdr_size),"px"," ",esc_attr($img_bdr_type)," ",esc_attr($img_bdr_color); ?>;
        width: 130px;
        height: 130px;
    }

    #A_b_t_name_div_<?php echo esc_attr($p_o_s_t); ?>.web_lizar_user_name_div {
        margin-top: 25px;
    }

    #A_b_t_name_div_<?php echo esc_attr($p_o_s_t); ?> h3.name_user {
        color: <?php echo esc_attr($name_Color); ?>;
        font-size: <?php echo esc_attr($name_font_size); ?>px;
        font-family: <?php echo  esc_attr($name_font_family); ?> !important;
        margin-bottom: 0px;
        margin-top: 0px;
        word-wrap: break-word;
        float: none;
        border-bottom: 0;
        text-align: center;
        font-weight: normal;
    }

    #A_b_t_discription_div_<?php echo esc_attr($p_o_s_t); ?>.web_lizar_discription_div {
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 0px !important;
        margin-top: 25px;
        word-wrap: break-word;
    }

    #A_b_t_discription_div_<?php echo esc_attr($p_o_s_t); ?> p {
        color: <?php echo esc_attr($dis_text_color); ?>;
        font-size: <?php echo esc_attr($dis_font_size); ?>px;
        font-family: <?php echo  esc_attr($name_font_family); ?>;
        margin-bottom: 0em;
        word-wrap: break-word;
        text-align: center !important;
        line-height: normal !important;

    }

    #A_b_t_social_icon_div_<?php echo esc_attr($p_o_s_t); ?>.web_lizar_social_icon_div_use {
        padding-left: 10px;
        padding-right: 10px;
        margin-top: 25px;
        height: auto;
    }

    #A_b_t_social_icon_div_<?php echo esc_attr($p_o_s_t); ?> a > span.web_lizar_Social_icon {
        color: <?php echo esc_attr($About_author_social_color); ?>;
        margin: 5px;
        font-family: Font Awesome\ 5 Brands;
        border-bottom: 0;
        font-size: <?php echo esc_attr($Social_icon_size);?>px;
    }

    #A_b_t_social_icon_div_<?php echo esc_attr($p_o_s_t); ?> a {
        border-bottom: 0;
    }

    #A_b_t_web_link_div_<?php echo esc_attr($p_o_s_t); ?> {
        margin-top: 25px;
        padding-bottom: 40px;
    }

    #A_b_t_web_link_div_<?php echo esc_attr($p_o_s_t); ?> a.web_lizar_web_link {
        color: <?php echo esc_attr($weblink_text_color); ?>;
        font-size: <?php echo esc_attr($weblink_font_size);?>px;
        font-family: <?php echo  esc_attr($name_font_family); ?>;
        border-bottom: 0;
        word-wrap: break-word;
    }

    #A_b_t_social_icon_div_<?php echo esc_attr($p_o_s_t); ?> a.icon {
        text-decoration: none;
        box-shadow: none !important;
    }

    #A_b_t_web_link_div_<?php echo esc_attr($p_o_s_t) ; ?> a.icon {
        text-decoration: none;
        box-shadow: none !important;
    }

</style>

<style type="text/css">
    <?php echo 	esc_attr($About_author_custom_css); ?>
</style>

<div class="web_lizar_main_div " id="A_b_t_main_<?php echo esc_attr( $p_o_s_t ); ?>">
    <div align="center" class="web_lizar_image_div " id="A_b_t_img_<?php echo esc_attr( $p_o_s_t ); ?>">
        <img class="web_lizar_image_User" src="<?php echo esc_url( $profile_user_image ); ?>"/>
    </div>
    <div align="center" class="web_lizar_user_name_div" id="A_b_t_name_div_<?php echo esc_attr( $p_o_s_t ); ?>">
        <h3 class="name_user"><?php echo esc_attr( $About_author_user_name ); ?></h3>
    </div>
    <div align="center" class="web_lizar_discription_div"
         id="A_b_t_discription_div_<?php echo esc_attr( $p_o_s_t ); ?>">
        <p><?php echo esc_attr( $About_author_dis_cription ); ?></p>
    </div>
	<?php
	if ( $followbitbucket !== "" || $followdropbox !== "" || $followfb !== "" || $followflicker !== "" || $followgithub !== "" || $followgoogle !== "" || $followinsta !== "" || $followlinkdln !== "" || $followpinterest !== "" || $followtumbler !== "" || $followtwit !== "" || $followtVk !== "" ) {
		?>
        <div class="web_lizar_social_icon_div_use" id="A_b_t_social_icon_div_<?php echo esc_attr( $p_o_s_t ); ?>"
             align="center">
			<?php if ( $followbitbucket !== "" ) {
				?>
                <a class="icon " href="<?php echo esc_url( $followbitbucket ); ?>" target="_blank" style="">
                    <span id="bitbucket_jqs" class="fab fa-bitbucket web_lizar_Social_icon"></span>
                </a>
				<?php
			}
			?>
			<?php if ( $followdropbox !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followdropbox ); ?>" target="_blank"
                   style="text-decoration: none;">
                    <span class="fab fa-dropbox web_lizar_Social_icon"></span>
                </a>
				<?php
			}
			?>
			<?php if ( $followfb !== "" ) {
				?>

                <a class="icon" href="<?php echo esc_url( $followfb ); ?>" target="_blank"
                   style="text-decoration: none;">
                    <span class="fab fa-facebook-f web_lizar_Social_icon"></span>
                </a>
				<?php
			}
			?>
			<?php if ( $followflicker !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followflicker ); ?>" target="_blank"
                   style="text-decoration: none;">
                    <span class="fab fa-flickr web_lizar_Social_icon"></span>
                </a>
				<?php
			}
			?>
			<?php if ( $followgithub !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followgithub ); ?>" target="_blank"
                   style="text-decoration: none;">
                    <span class="fab fa-github web_lizar_Social_icon"></span>
                </a>
				<?php
			}
			?>
			<?php if ( $followgoogle !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followgoogle ); ?>" target="_blank"
                   style="text-decoration: none;">
                    <span class="fab fa-google-plus-g  web_lizar_Social_icon"></span>
                </a>
				<?php
			}
			?>
			<?php if ( $followinsta !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followinsta ); ?>" target="_blank"
                   style="text-decoration: none;">
                    <span class="fab fa-instagram web_lizar_Social_icon"></span>
                </a>
				<?php
			}
			?>
			<?php if ( $followlinkdln !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followlinkdln ); ?>" target="_blank"
                   style="text-decoration: none;">
                    <span class="fab fa-linkedin-in web_lizar_Social_icon" ">
                    </span>
                </a>
				<?php
			}
			?>
			<?php if ( $followpinterest !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followpinterest ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-pinterest-p web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>
			<?php if ( $followtumbler !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followtumbler ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-tumblr web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>
			<?php if ( $followtwit !== "" ) {
				?>

                <a class="icon" href="<?php echo esc_url( $followtwit ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-twitter web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>

			<?php if ( $followtVk !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followtVk ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-vk web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>

			<?php if ( $followDigg !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followDigg ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-digg web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>

			<?php if ( $followyoutube !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followyoutube ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-youtube-square web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>

			<?php if ( $followskype !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followskype ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-skype web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>

			<?php if ( $followtelegram !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followtelegram ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-telegram-plane web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>

			<?php if ( $followwhatsapp !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followwhatsapp ); ?>" target="_blank"
                   style="text-decoration: none;">
					<span class="fab fa-whatsapp web_lizar_Social_icon">
					</span>
                </a>
				<?php
			}
			?>

        </div>
		<?php
	}
	?>
    <div align="center" id="A_b_t_web_link_div_<?php echo esc_attr( $p_o_s_t ); ?>"><a target="_blank"
                                                                                       class="web_lizar_web_link icon"
                                                                                       href="<?php echo esc_url( $About_author_web_site_name ); ?>"><?php echo esc_attr( $About_author_web_site_name ); ?></a>
    </div>
</div>