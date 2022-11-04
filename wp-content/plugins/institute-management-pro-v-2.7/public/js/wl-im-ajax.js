jQuery(document).ready(function() {
	/* Loading */
	var loading = jQuery('.wlim-loading');
	loading.hide();
	jQuery(document).ajaxStart(function() {
		jQuery('button[type="submit"]').prop('disabled', true);
		loading.show();
	}).ajaxStop(function() {
		jQuery('button[type="submit"]').prop('disabled', false);
		loading.hide();
	});

	/* Add or update record */
	function save(selector, form = null, alert = false) {
		jQuery(form).ajaxForm({
			success: function(response) {
				jQuery(selector).prop('disabled', false);
				if(response.success) {
					jQuery('span.text-danger').remove();
					jQuery(".is-valid").removeClass("is-valid");
					jQuery(".is-invalid").removeClass("is-invalid");
					if(alert) {
						jQuery('.wl_im_container .alert').remove();
						var alertBox = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-check"></i> &nbsp;' + response.data.message + '</strong></div>';
						jQuery(alertBox).insertBefore(form);
					}
					toastr.success(response.data.message);
					if (response.data.hasOwnProperty('reload') && response.data.reload) {
						location.reload();
					} else {
						jQuery(form)[0].reset();
					}
				} else {
					jQuery('span.text-danger').remove();
					if(response.data && jQuery.isPlainObject(response.data)) {
						jQuery(form + ' :input').each(function() {
							var input = this;
							jQuery(input).removeClass('is-valid');
							jQuery(input).removeClass('is-invalid');
							if(response.data[input.name]) {
								var errorSpan = '<span class="text-danger">' + response.data[input.name] + '</span>';
								jQuery(input).addClass('is-invalid');
								jQuery(errorSpan).insertAfter(input);
							} else {
								jQuery(input).addClass('is-valid');
							}
						});
					} else {
						var errorSpan = '<span class="text-danger">' + response.data + '<hr></span>';
						jQuery(errorSpan).insertBefore(form);
						toastr.error(response.data);
					}
				}
			},
			error: function(response) {
				jQuery(selector).prop('disabled', false);
				toastr.error(response.statusText);
			},
			uploadProgress(event, progress, total, percentComplete) {
				jQuery('#wlim-progress').text(percentComplete);
			}
		});
	}

	/* Fetch records */
	function fetchRecords(action, target, data = null) {
		jQuery.ajax({
			type : 'post',
			url : wlimajaxurl + '?security=' + WLIMAjax.security + '&action=' + action,
			data :  data,
			success : function(data) {
				jQuery(target).html(data);
			}
		});
	}

	/* Action to add enquiry */
	save('.add-enquiry-submit', '#wlim-add-enquiry-form', true);

	/* Action to get exam result */
	jQuery(document).on('submit', '#wlim-exam-result-form', function(e) {
		e.preventDefault();
		var data = jQuery('#wlim-exam-result-form').serialize();
		fetchRecords('wl-im-get-exam-result', '#wlim-get-exam-result', data);
	});
});