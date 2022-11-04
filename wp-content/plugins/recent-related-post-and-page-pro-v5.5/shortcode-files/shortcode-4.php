<style>
	@import url(<?php echo WL_RP_RP_PLUGIN_URL.'css/font-awesome-latest/css/fontawesome-all.min.css'?>);
	.menu span a:before {
		font-family: FontAwesome;
		speak: none;
		text-indent: 0em;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	#r_r_post_link_<?php echo esc_attr($p_o_s_t)?>
	{
	   margin-right: 5px !important;
    margin-left: 5px !important;
	}
	#r_r_post_link_<?php echo esc_attr($p_o_s_t)?> > a.r_r_p_link
	{
		border-radius:0px !important;
		padding:10px !important;
		border-bottom: 0px !important;
		font-size:<?php echo esc_attr($link_font_size)?>px !important;
		font-weight: bolder !important;
		color:<?php echo esc_attr($link_font_Color)?> !important;
		background-color: <?php echo esc_attr($link_back_Color)?>!important;
		text-decoration: none !important;
		font-family: <?php echo esc_attr($NWT_Font_Style) ?>!important;
		border: 0px !important;
		word-wrap:break-word !important;
	}

	#r_r_post_link_<?php echo esc_attr($p_o_s_t)?> a:hover
	{
		background-color:<?php echo esc_attr($hover_Color)?> !important;
		color:<?php echo $hover_text_color?> !important;
	}
	#r_r_post_date_<?php echo esc_attr($p_o_s_t)?>
	{
		margin-top: 30px !important;
		margin-bottom: 20px !important;
			}
	#date_span_date_<?php echo esc_attr($p_o_s_t)?> > a.date1
	{
		
		margin-right: 10px !important;
		margin-left: 10px !important;
		font-size:<?php echo esc_attr($date_font_size);?>px !important;
		color:<?php echo esc_attr($date_font_color);?> !important;
		font-family: <?php echo esc_attr($NWT_Font_Style); ?> !important;
		background-color: <?php echo esc_attr($date_back_Color); ?> !important;
		padding:10px !important;
		word-wrap:break-word !important;
		font-weight: bolder !important;
	}

	#outer_div_<?php echo esc_attr($p_o_s_t); ?>
	{
		width: 100% !important;
	}

	#mytemplate_<?php echo esc_attr($p_o_s_t); ?>
	{
		padding:10px !important;
		background-color: <?php echo esc_attr($back_ground_color);?> !important;
		border-bottom: <?php echo esc_attr($bottom_bdr_size);?>px <?php echo esc_attr($bottom_bdr_type); ?> <?php echo esc_attr($bottom_bdr_color);?>;
	}


	#r_r_post_title_<?php echo esc_attr($p_o_s_t);?>
	{
		margin-bottom: 10px !important;
		margin-top: 20px !important;
		margin-left:10px !important;
		margin-right:10px!important;
	}

	#r_r_post_title_<?php echo esc_attr($p_o_s_t);?> a.web_ticker_title
	{
		font-size:<?php echo esc_attr($char_font_size)?>px !important;
		color:<?php echo esc_attr($char_color)?> !important;
		font-family: <?php echo esc_attr($NWT_Font_Style) ?> !important;
		word-wrap:break-word !important;
		text-decoration: none !important;
		border: 0px !important;
		word-wrap:break-word !important;
		font-weight: bolder !important;
	}

	#r_r_post_content_<?php echo esc_attr($p_o_s_t)?>.web_ticker_content
	{
		margin-bottom: 40px !important;
		font-size:<?php echo esc_attr($dis_font_size)?>px !important;
		color:<?php echo esc_attr($dis_text_Color)?> !important;
		font-family: <?php echo esc_attr($NWT_Font_Style) ?> !important;
		word-wrap:break-word !important;
		margin-left:10px !important;
		margin-right:10px!important;
	}
	#slider_div_<?php echo esc_attr($p_o_s_t); ?>
	{
		display:none;
	}
	#preloader_<?php echo esc_attr($p_o_s_t); ?> img
	{
		max-width:none !important;
		height:auto !important;
		width:auto !important;
	}
	#date_span_date_<?php echo esc_attr($p_o_s_t)?>.left
{
  display: block !important;
  float:<?php echo esc_attr($date_align) ?> !important;
}

#r_r_post_link_<?php echo esc_attr($p_o_s_t)?>.right
{
  display: block!important;
  float:<?php echo esc_attr($link_align) ?> !important;
}
#r_r_post_image_<?php echo esc_attr($p_o_s_t)?>.activity_rounded
	{
		margin-left:10px !important;
		margin-right:10px !important;
		margin-top: 20px !important;
		margin-bottom: 10px !important;
		display: inline-block;
		-webkit-border-radius: <?php echo $layout_4?>% !important;
		-moz-border-radius:<?php echo $layout_4?>% !important;
		border-radius: <?php echo $layout_4?>% !important;
		-khtml-border-radius:<?php echo $layout_4?>% !important;
		border:<?php echo esc_attr($bdr_size_4);?>px <?php echo esc_attr($img_bdr_type_4); ?> <?php echo esc_attr($img_bdr_color_4);?> !important;
	}

	#r_r_post_image_<?php echo esc_attr($p_o_s_t)?>.activity_rounded img
	{
		 width:170px !important;
		 height: 170px !important;
         max-width: 100%!important;
		-webkit-border-radius: <?php echo $layout_4?>% !important;
		-moz-border-radius: <?php echo $layout_4?>% !important;
		border-radius: <?php echo $layout_4?>% !important;
		-khtml-border-radius: <?php echo $layout_4?>% !important;
		vertical-align: middle;

	}
</style>

<style>
	<?php echo $nwt_custom_css; ?>
</style>
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
<script type="text/javascript">
	WebFont.load({
		google: {
          families: ['<?php echo $NWT_Font_Style; ?>'] // saved value
      }
  });
	jQuery(document).ready(function () {
		jQuery(window).load(function () {
			jQuery('div#slider_div_<?php echo esc_attr($p_o_s_t); ?>').show();
			jQuery('div#preloader_<?php echo esc_attr($p_o_s_t); ?>').hide();

		});
	});
</script>
<?php $a;?>
<div id="preloader_<?php echo esc_attr($p_o_s_t); ?>" align="center"> <img src="<?php echo WL_RP_RP_PLUGIN_URL.'settings/images/Preloader_1.gif'; ?>"/></div>
<div id="slider_div_<?php echo $p_o_s_t; ?>" class="vticker_<?php echo esc_attr($p_o_s_t).$a; ?>  ">

	<?php
// The Query
	$args = array( 'posts_per_page' =>$total_post_value, 'order'=>$post_order, 'orderby' =>$order_by, 'post_type' => array($checkboxvar_page,$checkboxvar_post),'post_status' =>$post_sta_tus );
	$the_query = new WP_Query( $args );?>

	<div  id="outer_div_<?php echo $p_o_s_t; ?>"  style="width:100%">
		<?php
		if ( $the_query->have_posts() )
		{

			while ( $the_query->have_posts() )
			{
				?> <div id="mytemplate_<?php echo $p_o_s_t; ?>" > <?php
				$the_query->the_post();
				$post_info = get_post( get_the_ID() );
				$rest=get_the_title();
				$title=substr($rest, 0,$charcter_limit);

			    $rest_content=get_the_content();
				$rest_content = preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $rest_content);
			   $rest_content = preg_replace("/&nbsp;/","",$rest_content);
				$rest_content=strip_tags($rest_content);
				$rest_content = trim($rest_content);
				$demo_content=substr($rest_content,0,$dis_char_lmit);
                $count_content=strlen($rest_content);
				
				if($count_content>600)
				{
					$content=$demo_content.'...';
				}
				else
				{
					$content=$demo_content;
				}
				?>
				<?php $date_post=get_the_date();
                $my_image=wp_get_attachment_url( get_post_thumbnail_id($post_info));?>
				<?php  if($featured_image_2=="default"){ $my_image; }   if($featured_image_2=="upload"){$my_image=$user_image_2; }  if($featured_image_2=="none"){$my_image=""; } ?>
				<?php if(!$my_image==''){?>
				<div align="center" id=" r_r_post_image_div_<?php echo esc_attr($p_o_s_t)?>">
					<div id="r_r_post_image_<?php echo esc_attr($p_o_s_t)?>" class="activity_rounded" ><?php echo  "<img src=' $my_image '>";   ?></div>
				</div>
				<?php }?>
				<div id="r_r_post_title_<?php echo esc_attr($p_o_s_t)?>"  ><a href="<?php if($title_link=='yes') {the_permalink();} else {  echo '#';  } ?>" class="web_ticker_title"> <?php  echo esc_attr($title); ?></a></div>
				<div id="r_r_post_content_<?php echo $p_o_s_t?>" class="web_ticker_content"style=""><?php  echo $content?></div>
					<div id="r_r_post_date_<?php echo esc_attr($p_o_s_t)?>">
<?php if($show_hide=="show"){?>	<span  id="date_span_date_<?php echo esc_attr($p_o_s_t)?>" class="left">  <a class="date1"><?php  echo esc_attr($date_post) ?></a></span> <?php } ?>
				<span  id="r_r_post_link_<?php echo esc_attr($p_o_s_t)?>" class="right"> <a href="<?php the_permalink(); ?>" class="r_r_p_link"> <?php echo esc_attr($link_text) ?></a></span>
				<div style="clear: both;"></div>
				</div>
			</div>
			<?php
		}?>

		<?php
	}
	else
	{
	echo "<div align='center' class='alert alert-danger'>".__("Sorry! no posts found", WL_R_P_R_P )."</div>";
	}
	/* Restore original Post Data */
	wp_reset_postdata(); ?>

</div>
<a id="up_<?php echo $p_o_s_t?>" class="carousel-control-up  upper_<?php echo $p_o_s_t.$a?>" href="#" data-slide="prev"><i class=" fa fa-chevron-up"></i></a>
<a id="down_<?php echo $p_o_s_t?>" class="carousel-control-down downer_<?php echo $p_o_s_t.$a?>" href="#" data-slide="next"><i class="fa fa-chevron-down"></i></a>
</div>