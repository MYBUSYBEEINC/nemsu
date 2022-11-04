(function($) {
	'use strict';
	$(document).ready(function() {

		$('#urisp_l1_font_family').fontselect();
		$('#urisp_l2_font_family').fontselect();
		$('#urisp_l3_font_family').fontselect();
		$('#urisp_l4_font_family').fontselect();

		var fileFrame;
		$('#urisp-upload-image-btn').on('click',function(e) {
			e.preventDefault();
			if(fileFrame) {
				fileFrame.open();
				return;
			}

			var imagesList = $('#urisp-slider-images');
			var title = $(this).data('title');
			var buttonText = $(this).data('button-text');

			var slideTitle = $(this).data('slide-title');
			var slideDesc = $(this).data('slide-desc');
			var slideLink = $(this).data('slide-link');
			var richEditor = $(this).data('rich-editor');

			fileFrame = wp.media.frames.file_frame = wp.media({
				title: title,
				button: {
					text: buttonText
				},
				multiple: true
			});

			fileFrame.on('select', function() {
				var attachment = fileFrame.state().get('selection').toJSON();
				if(attachment.length > 0) {
					var i;
					for(i = 0; i < attachment.length; i++) {
						imagesList.append('<li class="urisp-image-entry"><input type="hidden" name="image[]" value="' + attachment[i].id + '"><span class="urisp-remove-image-btn dashicons dashicons-no-alt"></span><img src="' + attachment[i].url + '" /><label>' + slideTitle + '</label><input type="text" name="image_title[]" placeholder="' + slideTitle + '" value="' + attachment[i].title + '" /><label>' + slideDesc + '</label><textarea rows="4" class="urisp_textarea_' + attachment[i].id + '" name="image_desc[]" placeholder="' + slideDesc + '">' + attachment[i].caption + '</textarea><button type="button" data-id="' + attachment[i].id + '" class="btn btn-sm btn-info btn-block urisp-rich-editor-btn" data-toggle="modal" data-target="#urisp-editor-modal">' + richEditor + ' <span class="dashicons dashicons-admin-appearance"></span></button><label>' + slideLink + '</label><input type="text" name="image_link[]" placeholder="' + slideLink + '" /></li>');
					}
				}
			});

			fileFrame.open();

		});

		jQuery('#urisp-slider-images').sortable({
			placeholder: '',
			revert: true
		});

		$(document).on('click', '.urisp-remove-image-btn', function() {
			$(this).parent().fadeOut(300, function() {
				$(this).remove();
			});
		});

		$(document).on('click', '#urisp-delete-all-btn', function() {
			if(confirm($(this).data('message'))) {
				$('#urisp-slider-images').html('');
			}
		});

		$(document).on('click', '.urisp-rich-editor-btn', function() {
			var id = $(this).data('id');
			var desc = $('.urisp_textarea_' + id).val();
			$('#fetch_wpeditor_data').val(desc);
			$("#fetch_wpelement").val(id);
		});

		$(document).on('click', '.urisp-rich-editor-continue-btn', function() {
			$("#fetch_wpeditor_data").click();
			$("#fetch_wpeditor_data-html").click();
			var id = $("#fetch_wpelement").val();
			var desc = $("#fetch_wpeditor_data").val();
			$('.urisp_textarea_' + id).val(desc);
		});

		var smoothUp = $('.urisp-smooth-up');
		$(window).on('scroll', function() {
			var scrollTop = $(this).scrollTop();
			if(scrollTop < 1000) {
				smoothUp.fadeOut();
			} else {
				smoothUp.fadeIn();
			}
		});

		$(document).on('click', '.urisp-smooth-up', function() {
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			return false;
		});

		var layout1 = $('.urisp-setting-layout1');
		var layout2 = $('.urisp-setting-layout2');
		var layout3 = $('.urisp-setting-layout3');
		var layout4 = $('.urisp-setting-layout4');
		var layout = $('.urisp-setting-general input[name="layout"]:checked').val();
		if('layout1' === layout) {
			layout1.show();
		} else if('layout2' === layout) {
			layout2.show();
		} else if('layout3' === layout) {
			layout3.show();
		} else if('layout4' === layout) {
			layout4.show();
		}

		$(document).on('change', '.urisp-setting-general input[name="layout"]', function() {
			var layout = this.value;
			var settingLayouts = $('.urisp-setting-layout');
			settingLayouts.hide();
			if('layout1' === layout) {
				layout1.fadeIn();
			} else if('layout2' === layout) {
				layout2.fadeIn();
			} else if('layout3' === layout) {
				layout3.fadeIn();
			} else if('layout4' === layout) {
				layout4.fadeIn();
			}
		});

		$('.urisp-custom-css').each(function(index, el) {
			CodeMirror.fromTextArea(el, {
				lineNumbers: true,
				styleActiveLine: true,
				theme: 'blackboard'
			});
		});

		var l1WidthFixed = $('.urisp_l1_width_fixed');
		var l1WidthPercentage = $('.urisp_l1_width_percentage');
		var l1WidthType = $('input[name="l1_width_type"]:checked').val();
		if('fixed' === l1WidthType) {
			l1WidthFixed.show();
		} else if('percentage' === l1WidthType) {
			l1WidthPercentage.show();
		}

		$(document).on('change', 'input[name="l1_width_type"]', function() {
			var l1WidthType = this.value;
			var l1Width = $('.urisp_l1_width');
			l1Width.hide();
			if('fixed' === l1WidthType) {
				l1WidthFixed.fadeIn();
			} else if('percentage' === l1WidthType) {
				l1WidthPercentage.fadeIn();
			}
		});

		var l1HeightFixed = $('.urisp_l1_height_fixed');
		var l1HeightPercentage = $('.urisp_l1_height_percentage');
		var l1HeightType = $('input[name="l1_height_type"]:checked').val();
		if('fixed' === l1HeightType) {
			l1HeightFixed.show();
		} else if('percentage' === l1HeightType) {
			l1HeightPercentage.show();
		}

		$(document).on('change', 'input[name="l1_height_type"]', function() {
			var l1HeightType = this.value;
			var l1Height = $('.urisp_l1_height');
			l1Height.hide();
			if('fixed' === l1HeightType) {
				l1HeightFixed.fadeIn();
			} else if('percentage' === l1HeightType) {
				l1HeightPercentage.fadeIn();
			}
		});

		$('.color-picker').wpColorPicker();

		var l3MaxHeightFixed = $('.urisp_l3_max_height_fixed');

		var l3MaxHeight = $('input[name="l3_max_height"]:checked').val();
		if('fixed' === l3MaxHeight) {
			l3MaxHeightFixed.show();
		}
		$(document).on('change', 'input[name="l3_max_height"]', function() {
			var l3MaxHeight = this.value;
			if('fixed' === l3MaxHeight) {
				l3MaxHeightFixed.fadeIn();
			} else {
				l3MaxHeightFixed.hide();
			}
		});

	});
})(jQuery);
