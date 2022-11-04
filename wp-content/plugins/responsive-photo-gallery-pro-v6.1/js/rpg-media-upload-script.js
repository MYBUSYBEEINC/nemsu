/**
 * This JS script file used by single uploader to replace 
 * single uploaded image with previous once.
 */
function weblizar_image(image_id) {
	// media upload js
	var uploadID = ''; /*setup the var*/
	var showImg= '';
	var upload_image_button="#upload-background-"+image_id;
	showImg 	= jQuery(upload_image_button).prev('img');
	uploadID 	= jQuery(upload_image_button).next('input'); 			/*grab the specific input*/			
	uploadItems = jQuery(upload_image_button).nextAll('input'); 			/*grab the specific input*/			
	formfield 	= jQuery('.upload').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	
	window.send_to_editor = function(html, title ) {
		// console.log(title);

		
		imgurl = jQuery('img',html).attr('src');
		showImg.attr('src',imgurl);
		uploadItems.each( function ( index ,item) {
			jQuery(item).val(imgurl);
		});
		// uploadID.val(imgurl);
		// uploadID.val(imgurl); /*assign the value to the input*/
		tb_remove();
	};		
	return false;
}	