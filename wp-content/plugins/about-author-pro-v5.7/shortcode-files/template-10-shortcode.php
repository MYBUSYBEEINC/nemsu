<style>
    @import url(<?php echo WEBLIZAR_ABOUT_AUTHOR_PLUGIN_URL."css/font-awesome-latest/css/fontawesome-all.min.css"; ?>);

    .menu li a:before {
        font-family: Font Awesome\ 5 Brands;
        speak: none;
        text-indent: 0em;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #A_b_t_main_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_main_div {
        width: auto;
        height: auto;
        border: 1px solid #ccc;
        overflow: hidden;
        background-image: url('<?php echo esc_url($temp9_user_header_image); ?>');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    #A_b_t_main_<?php echo  esc_attr($p_o_s_t); ?>:hover .web_lizar_image_User img {
        border-radius: 50%;
        transition: all 0.6s ease 0.1s;
    }

    #A_b_t_main_<?php echo  esc_attr($p_o_s_t); ?>:hover .web_lizar_image_User {
        border-radius: 50%;
        transform: scale(1.4);
        transition: all 0.6s ease 0.3s;
    }

    #A_b_t_img_<?php echo  esc_attr($p_o_s_t); ?> img.web_lizar_image_User {
    <?php echo $my_bodr; ?>;
        width: 130px;
        height: 130px;
        border: <?php echo $bdr_size,"px"," ",$img_bdr_type," ",$img_bdr_color ?>;
        position: relative;
        top: 60px;
        font-weight: normal;
    }

    #A_b_t_img_<?php echo  esc_attr($p_o_s_t); ?> h3.name_user {
        color: <?php echo $name_Color; ?>;
        font-size: <?php echo $name_font_size; ?>px;
        font-family: <?php echo  $name_font_family; ?> !important;
        margin-bottom: 0px;
        margin-top: 60px;
        word-wrap: break-word;
        text-align: center;
        float: none;
        border-bottom: 0;
        font-weight: normal;
    }

    #A_b_t_name_div_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_user_name_div:hover {
        text-shadow: 2px 1px pink;
        font-size: 30px;
        transition: all 0.6s ease 0.3s;
    }

    #A_b_t_discription_div_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_discription_div {
        margin-top: 120px;
        padding-left: 10px;
        padding-right: 10px;
        word-wrap: break-word;
    }

    #A_b_t_discription_div_<?php echo  esc_attr($p_o_s_t); ?> p {
        color: <?php echo $dis_text_color; ?>;
        font-size: <?php echo $dis_font_size; ?>px;
        font-family: <?php echo  $name_font_family; ?>;
        margin-bottom: 0em;
        word-wrap: break-word;
        text-align: center !important;
        line-height: normal !important;
    }

    #A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?>.web_lizar_social_icon_div_use {
        padding-left: 10px;
        padding-right: 10px;
        height: auto;
        margin-top: 40px;

    }

    #A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?> a > span.web_lizar_Social_icon {
        color: <?php echo $About_author_social_color; ?>;
        width: <?php echo $Social_icon_size+5;?>px;
        height: auto;
        text-align: center;
        border: 2px solid<?php echo $About_author_social_color;?>;
        border-radius: 0;
        border-radius: 50%;
        margin: 5px;
        line-height: 1.5;
        font-size: <?php echo $Social_icon_size;?>px;

    }

    #A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?> a > span:hover {
        border-top-left-radius: 5%;
        border-bottom-right-radius: 5%;
        transform: rotate(360deg);
        transition: all 0.6s ease 0.3s;
        color: <?php echo $About_author_social_color; ?>;
    }

    #A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?> a {
        border-bottom: 0;
    }

    #A_b_t_web_link_div_<?php echo  esc_attr($p_o_s_t); ?>.web_link_di_v {
        margin-top: 40px;
        padding-bottom: 40px;
    }

    #A_b_t_web_link_div_<?php echo  esc_attr($p_o_s_t); ?> a.web_lizar_web_link {
        color: <?php echo $weblink_text_color; ?>;
        font-size: <?php echo $weblink_font_size;?>px;
        font-family: <?php echo  $name_font_family; ?>;
        border-bottom: 0;
        word-wrap: break-word;

    }

    #A_b_t_social_icon_div_<?php echo  esc_attr($p_o_s_t); ?> a.icon {
        text-decoration: none;
        box-shadow: none !important;
    }

    #A_b_t_web_link_div_<?php echo  esc_attr($p_o_s_t) ; ?> a.icon {
        text-decoration: none;
        box-shadow: none !important;
    }

</style>
<style type="text/css">
    <?php echo 	$About_author_custom_css; ?>
</style>
<div class="web_lizar_main_div" id="A_b_t_main_<?php echo esc_attr( $p_o_s_t ); ?>">
	<?php
	if ( $followbitbucket !== "" || $followdropbox !== "" || $followfb !== "" || $followflicker !== "" || $followgithub !== "" || $followgoogle !== "" || $followinsta !== "" || $followlinkdln !== "" || $followpinterest !== "" || $followtumbler !== "" || $followtwit !== "" || $followtVk !== "" ) {
		?>
        <div class="web_lizar_social_icon_div_use" id="A_b_t_social_icon_div_<?php echo esc_attr( $p_o_s_t ); ?>"
             align="center">
			<?php if ( $followbitbucket !== "" ) {
				?>
                <a class="icon" href="<?php echo esc_url( $followbitbucket ); ?>" target="_blank"
                   style="text-decoration: none;">
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
					<span class="fab fa-linkedin-in web_lizar_Social_icon">
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
                   style="text-decoration:underline;">
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

    <div align="center" id="A_b_t_img_<?php echo esc_attr( $p_o_s_t ); ?>">
        <div align="center" class="web_lizar_user_name_div" id="A_b_t_name_div_<?php echo esc_attr( $p_o_s_t ); ?>">
            <h3 class="name_user"><?php echo esc_attr( $About_author_user_name ); ?></h3>
        </div>
        <img class="web_lizar_image_User" src="<?php echo esc_url( $profile_user_image ); ?>"/>
    </div>

    <div align="center" class="web_lizar_discription_div"
         id="A_b_t_discription_div_<?php echo esc_attr( $p_o_s_t ); ?>">
        <p><?php echo esc_attr( $About_author_dis_cription ); ?></p>
    </div>
    <div align="center" id="A_b_t_web_link_div_<?php echo esc_attr( $p_o_s_t ); ?>" class="web_link_di_v"><a
                target="_blank" class="web_lizar_web_link icon" style="text-decoration: none;"
                href="<?php echo esc_url( $About_author_web_site_name ); ?>"><?php echo esc_attr( $About_author_web_site_name ); ?></a>
    </div>
</div>