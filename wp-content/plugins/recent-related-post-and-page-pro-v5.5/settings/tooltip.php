<script>
jQuery(document).ready( function(){
	//Basic
	jQuery('#a1').darkTooltip();
	jQuery('#a2').darkTooltip();
	jQuery('#a3_1').darkTooltip();
	jQuery('#a3_2').darkTooltip();
	jQuery('#a4').darkTooltip();
	jQuery('#a5').darkTooltip();
	jQuery('#a6').darkTooltip();
	jQuery('#a7_1').darkTooltip();
	jQuery('#a7_2').darkTooltip();
	jQuery('#a8_1').darkTooltip();
	jQuery('#a8_2').darkTooltip();
	jQuery('#a9').darkTooltip();
	jQuery('#a10').darkTooltip();
	jQuery('#a11').darkTooltip();
	jQuery('#a12').darkTooltip();
	jQuery('#a13_1').darkTooltip();
	jQuery('#a13_2').darkTooltip();
	jQuery('#a14').darkTooltip();
	jQuery('#a15').darkTooltip();
	jQuery('#a16').darkTooltip();
	jQuery('#a17').darkTooltip();
	jQuery('#a18').darkTooltip();
	jQuery('#a19').darkTooltip();
	jQuery('#a20_1').darkTooltip();
	jQuery('#a20_2').darkTooltip();
	jQuery('#a21').darkTooltip();
	jQuery('#a22').darkTooltip();
	jQuery('#a23').darkTooltip();
	jQuery('#a24_1').darkTooltip();
	jQuery('#a24_2').darkTooltip();
	jQuery('#a25').darkTooltip();
	jQuery('#a26').darkTooltip();
	jQuery('#a27').darkTooltip();
	jQuery('#a28').darkTooltip();
	jQuery('#a29').darkTooltip();
	jQuery('#a30').darkTooltip();
	jQuery('#a31_1').darkTooltip();
	jQuery('#a31_2').darkTooltip();
	jQuery('#a32').darkTooltip();
	jQuery('#a33').darkTooltip();
	jQuery('#a34').darkTooltip();
	jQuery('#a35').darkTooltip();
	jQuery('#a36').darkTooltip();
	
	//Template settings
	jQuery('.e1').darkTooltip();
	jQuery('.e2').darkTooltip();
	jQuery('.e4').darkTooltip();
	jQuery('.e3').darkTooltip();
	jQuery('.e5').darkTooltip();
	jQuery('.e6').darkTooltip();
	jQuery('.e7').darkTooltip();
	jQuery('.e8').darkTooltip();
	jQuery('.e9').darkTooltip();
	
	//page post settings
	jQuery('#w1_1').darkTooltip();
	jQuery('#w1_2').darkTooltip();
	jQuery('#w2_1').darkTooltip();
	jQuery('#w2_2').darkTooltip();
	jQuery('#w3').darkTooltip();
	jQuery('#w4').darkTooltip();
	jQuery('#w5').darkTooltip();
	jQuery('#w6').darkTooltip();
	jQuery('#w7').darkTooltip();
	jQuery('#w8').darkTooltip();
	jQuery('#w9').darkTooltip();
	jQuery('#w10').darkTooltip();
	
	
	
	
	//With some options
	jQuery('#light').darkTooltip({
		animation:'flipIn',
		gravity:'west',
		confirm:true,
		theme:'light'
	});
});
</script>

<!--layout tooltip start-->
<div style="display:none;" id="f1">
	<h4><?php _e('Display Featured Images (Default) - Display featured image added during creating page/post.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="f2">
	<h4><?php _e('Display Featured Images (Plugin Uploaded) - If you want to display only own selected feature image then use this option to set a new feature image.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="f3">
	<h4><?php _e('Display Featured Images (None) - This option hides the feature image from the post.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="f4">
	<h4><?php _e('Featured Images Border Style - Select a border style from the list.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="f5">
	<h4><?php _e('Featured Images Border Size - You can set featured image border size.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="f6">
	<h4><?php _e('Featured Images Border Color - You can set a color for featured image border.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="f7">
	<h4><?php _e('Featured Images Layout Style - You can select feature image shape circle.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="f8">
	<h4><?php _e(' Featured Images Layout Style - You can select feature image shape rectangle.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="f9">
	<h4><?php _e('Background Image Height - You can set featured image background height size.','WL_R_P_R_P')?> </h4>
</div>
<!---------- common settings tooltip ---------->

<div style="display:none;" id="b1">
	<h4><?php _e('Post Order - You can display post/pages either in ascending order or descending order.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b2">
	<h4><?php _e('Post Status - Which type of post status do you want to display into the shortcode, choose an option from the list.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b3_1">
	<h4><?php _e('Post Types - You can display both post and post using shortcode or you can display post/page using the shortcode.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b3_2">
	<h4><?php _e('Post Types - You can display both post and post using shortcode or you can display post/page using the shortcode.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b4">
	<h4><?php _e('Order By - You can specify post order by a more specific filter like -date etc.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b5">
	<h4><?php _e('Total Posts To Show - Set how many posts you want to display into a shortcode.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b6">
	<h4><?php _e('No. Of Post To Show In Slide - How many posts do you want to display at a time in recent post slider.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b7_1">
	<h4><?php _e('Slider Direction - You can set sliding directing UP.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b7_2">
	<h4><?php _e('Slider Direction - You can set sliding directing Down.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b8_1">
	<h4><?php _e('Pause Slide On Mouse Hover - If this setting is Yes, hover mouse on the slider it will pause the current slide.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b8_2">
	<h4><?php _e('Pause Slide On Mouse Hover - If this setting is No, hover mouse on the slider it will not pause the slide.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b9">
	<h4><?php _e('Sliding Arrow Color - You can set slide arrow color.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b10">
	<h4><?php _e('Sliding Arrow Size - You can set slide arrow size.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b11">
	<h4><?php _e('Slider Speed - You can select sliding speed like slow, medium.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b12">
	<h4><?php _e('Background Color - You can select slides background color using this setting.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b13_1">
	<h4><?php _e('Use Title As Link - If this setting Yes, then the title will assign post link.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b13_2">
	<h4><?php _e('Use Title As Link - If this setting N0, then the title will not assign post link.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b14">
	<h4><?php _e('Number Of Letters In Title - How many characters do you want to display into post title.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b15">
	<h4><?php _e('Font Size - This will specify the font size of the post title.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b16">
	<h4><?php _e('Font Text Color - This will specify the font color of the post title.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b17">
	<h4><?php _e('Number Of Letters In Description - How many characters do you want to display into post description.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b18">
	<h4><?php _e('Font Size - This will specify the font size of post description.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b19">
	<h4><?php _e('Font Text Color - This will specify the font color of post description.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b20_1">
	<h4><?php _e('Date - Set yes to display the date on the slide.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b20_2">
	<h4><?php _e('Date - Set no to hide the date on the slide.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b21">
	<h4><?php _e('Font Size - This will specify the font size of post date.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b22">
	<h4><?php _e('Font Text Color - This will specify the text color of post date.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b23">
	<h4><?php _e('Background Color - This will specify the background color of post date.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b24_1">
	<h4><?php _e('Align Date - This will specify the right alignment of post date.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b24_2">
	<h4><?php _e('Align Date - This will specify the left alignment of post date.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b25">
	<h4><?php _e('Text - Read More button text can be customized from here.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b26">
	<h4><?php _e('Font Size - This will specify the font size of Read More button text.','WL_R_P_R_P')?></h4>
</div>


<div style="display:none;" id="b27">
	<h4><?php _e('Font Text Color - This will specify the text color of Read More button text.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b28">
	<h4><?php _e('Background Color - This will specify the background color of Read More button.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b29">
	<h4><?php _e('Background Color On Hover - This will specify the background color of Read More button when you mouse hover the button.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b30">
	<h4><?php _e('Font Text Color On Hover - This will specify the color of Read More button text when you mouse hover on the button.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b31_1">
	<h4><?php _e('Align Link - This will specify the right alignment of Read More button.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b31_2">
	<h4><?php _e('Align Link - This will specify the left alignment of Read More button.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b32">
	<h4><?php _e('Border Style - You can set slide border-bottom-style using this option.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b33">
	<h4><?php _e('Border Size - You can set slide border bottom border size using this setting.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b34">
	<h4><?php _e('Border Color - You can set slide border bottom border color using this setting.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b35">
	<h4><?php _e('Font Family    - This setting applies font family to all text appearing on slides like title text, description text, date text, and read more button text.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="b36">
	<h4><?php _e('Custom CSS - If you want to apply your own design and style then use this setting freely.','WL_R_P_R_P')?></h4>
</div>

<?php //page post settings ?>
<div style="display:none;" id="q1_1">
	<h4><?php _e('On Page - If you want to display recent & related PAGES after each published page then set this setting Yes.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="q1_2">
	<h4><?php _e('On Page - If you does not want to display recent & related PAGES after each published page then set this setting No.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="q2_1">
	<h4><?php _e('On Post - If you  want to display recent & related POSTS after each published post then set this setting Yes.','WL_R_P_R_P')?></h4>
</div>


<div style="display:none;" id="q2_2">
	<h4><?php _e('On Post - If you does not want to display recent & related POSTS after each published post then set this setting No.','WL_R_P_R_P')?></h4>
</div>

<div style="display:none;" id="q3">
	<h4><?php _e('Select Any Shortcode Style - Select which shortcode style & settings you want to apply which will be displayed after your page content.','WL_R_P_R_P')?> </h4>
</div>


<div style="display:none;" id="q4">
	<h4><?php _e('Select Any Shortcode Style - Select which shortcode style & settings you want to apply which will be displayed after your post content.','WL_R_P_R_P')?> </h4>
</div>


<div style="display:none;" id="q5">
	<h4><?php _e('Label Text For Page - This option display a label text before recent & related post shortcode display after page content.','WL_R_P_R_P')?></h4>
</div>


<div style="display:none;" id="q6">
	<h4><?php _e('Label Text For Post - This option display a label text before recent & related post shortcode display after post content.','WL_R_P_R_P')?></h4>
</div>


<div style="display:none;" id="q7">
	<h4><?php _e('Font size - This option will specify the font size of Label Text.','WL_R_P_R_P')?></h4>
</div>


<div style="display:none;" id="q8">
	<h4><?php _e('Background Color - This option will specify the background color of Label Text.','WL_R_P_R_P')?></h4>
</div>


<div style="display:none;" id="q9">
	<h4><?php _e('Font Color - This option will specify font color of Label Text.','WL_R_P_R_P')?> </h4>
</div>



<div style="display:none;" id="q10">
	<h4><?php _e('Font Family - This option will specify font family of Label Text.','WL_R_P_R_P')?></h4>
</div>
