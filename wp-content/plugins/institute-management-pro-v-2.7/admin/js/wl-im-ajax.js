jQuery(document).ready(function() {
	/* Loading */
	var loading = '.wlim-loading';
	jQuery(loading).hide();;
	jQuery(document).on('click', loading, function() {
		this.hide();
	});
	jQuery(document).ajaxStart(function() {
		jQuery('button[type="submit"]').prop('disabled', true);
		jQuery(loading).show();
	}).ajaxStop(function() {
		jQuery('button[type="submit"]').prop('disabled', false);
		jQuery(loading).hide();
	});

	/* Serialize object */
	(function($,undefined){
	  '$:nomunge';
	  $.fn.serializeObject = function(){
	    var obj = {};
	    $.each( this.serializeArray(), function(i,o){
	      var n = o.name,
	        v = o.value;
	        obj[n] = obj[n] === undefined ? v
	          : $.isArray( obj[n] ) ? obj[n].concat( v )
	          : [ obj[n], v ];
	    });
	    return obj;
	  };
	})(jQuery);

	/* Get data to display on table */
	function initializeDatatable(table, action) {
		jQuery(table).DataTable({
	        aaSorting: [],
	        responsive: true,
			ajax: {
				url: ajaxurl + '?security=' + WLIMAjax.security + '&action=' + action,
	            dataSrc: 'data'
			},
			language: {
				"loadingRecords": "Loading..."
			}
		});
	}

	/* Add or update record */
	function save(selector, action, form = null, modal = null, reloadTables = []) {
		jQuery(document).on('click', selector, function(event) {
			var data = {
				action: action
			};
			var formData = {};
			if(form) {
				formData = jQuery(form).serializeObject();
			}
			jQuery(selector).prop('disabled', true);
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: jQuery.extend(formData, data),
				success: function(response) {
					jQuery(selector).prop('disabled', false);
					if(response.success) {
						toastr.success(response.data.message);
						if (response.data.hasOwnProperty('reload') && response.data.reload) {
							location.reload();
						} else {
							jQuery(form)[0].reset();
							if(modal) {
								jQuery(modal).modal('hide');
							}
							reloadTables.forEach(function(table) {
								jQuery(table).DataTable().ajax.reload(null, false);
							});
						}
					} else {
						jQuery('span.text-danger').remove();
						if(response.data && jQuery.isPlainObject(response.data)) {
							jQuery(form + ' :input').each(function() {
								var input = this;
								if(response.data[input.name]) {
									var errorSpan = '<span class="text-danger">' + response.data[input.name] + '</span>';
									jQuery(errorSpan).insertAfter(this);
								}
							});
						} else {
							var errorSpan = '<span class="text-danger ml-3 mt-3">' + response.data + '<hr></span>';
							jQuery(errorSpan).insertBefore(form);
							toastr.error(response.data);
						}
					}
				},
				error: function(response) {
					jQuery(selector).prop('disabled', false);
					toastr.error(response.statusText);
				},
				dataType: 'json'
			});
		});
	}

	/* Fetch record to update */
	function fetch(modal, action, target) {
		jQuery(document).on('show.bs.modal', modal, function (e) {
			var id = jQuery(e.relatedTarget).data('id');
			jQuery.ajax({
				type : 'post',
				url : ajaxurl + '?security=' + WLIMAjax.security + '&action=' + action,
				data :  'id='+ id,
				success : function(data) {
					jQuery(target).html(data);
				}
			});
		});
	}

	/* Delete record */
	function remove(selector, id_attribute, nonce_attribute, nonce_name, action, reloadTables = []) {
		jQuery(document).on("click", selector, function (event) {
			var id = jQuery(this).attr(id_attribute);
			var nonce = jQuery(this).attr(nonce_attribute);
			jQuery.confirm({
			    title: 'Confirm!',
			    content: 'Please confirm!',
			    buttons: {
			        confirm: function () {
						jQuery.ajax({
							data: "id=" + id + "&" + nonce_name + "-" + id + "=" + nonce + "&action=" + action,
							url: ajaxurl,
							type: "POST",
							success: function(response) {
								if(response.success) {
									toastr.success(response.data.message);
									reloadTables.forEach(function(table) {
										jQuery(table).DataTable().ajax.reload(null, false);
									});
								} else {
									toastr.error(response.data);
								}
							},
							error: function(response) {
								toastr.error(response.statusText);
							}
						});
			        },
			        cancel: function () {
			        }
			    }
			});
		});
	}

	/* Fetch records */
	function fetchRecords(action, target, data = null) {
		jQuery.ajax({
			type : 'post',
			url : ajaxurl + '?security=' + WLIMAjax.security + '&action=' + action,
			data :  data,
			success : function(data) {
				jQuery(target).html(data);
			}
		});
	}

	/* Add or update record with files */
	function saveWithFiles(selector, form = null, modal = null, reloadTables = [], reset = true) {
		jQuery(form).ajaxForm({
			success: function(response) {
				jQuery(selector).prop('disabled', false);
				if(response.success) {
					jQuery('span.text-danger').remove();
					jQuery(".is-valid").removeClass("is-valid");
					jQuery(".is-invalid").removeClass("is-invalid");
					toastr.success(response.data.message);
					if(response.data.hasOwnProperty('reload') && response.data.reload) {
						location.reload();
					} else {
						if(reset) {
							jQuery(form)[0].reset();
						}
						if(modal) {
							jQuery(modal).modal('hide');
						}
						reloadTables.forEach(function(table) {
							jQuery(table).DataTable().ajax.reload(null, false);
						});
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
						var errorSpan = '<span class="text-danger ml-3 mt-3">' + response.data + '<hr></span>';
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

	/* Actions for administrator */
	initializeDatatable('#administrator-table', 'wl-im-get-administrator-data');
	save('.add-administrator-submit', 'wl-im-add-administrator', '#wlim-add-administrator-form', '#add-administrator', ['#administrator-table']);
	fetch('#update-administrator', 'wl-im-fetch-administrator', '#fetch_administrator');
	save('.update-administrator-submit', 'wl-im-update-administrator', '#wlim-update-administrator-form', '#update-administrator', ['#administrator-table']);

	/* Actions for course */
	initializeDatatable('#course-table', 'wl-im-get-course-data');
	save('.add-course-submit', 'wl-im-add-course', '#wlim-add-course-form', '#add-course', ['#course-table']);
	fetch('#update-course', 'wl-im-fetch-course', '#fetch_course');
	save('.update-course-submit', 'wl-im-update-course', '#wlim-update-course-form', '#update-course', ['#course-table']);
	remove('.delete-course', 'delete-course-id', 'delete-course-security', 'delete-course', 'wl-im-delete-course', ['#course-table']);

	/* Actions for batch */
	initializeDatatable('#batch-table', 'wl-im-get-batch-data');
	save('.add-batch-submit', 'wl-im-add-batch', '#wlim-add-batch-form', '#add-batch', ['#batch-table']);
	fetch('#update-batch', 'wl-im-fetch-batch', '#fetch_batch');
	save('.update-batch-submit', 'wl-im-update-batch', '#wlim-update-batch-form', '#update-batch', ['#batch-table']);
	remove('.delete-batch', 'delete-batch-id', 'delete-batch-security', 'delete-batch', 'wl-im-delete-batch', ['#batch-table']);

	/* Actions for enquiry */
	initializeDatatable('#enquiry-table', 'wl-im-get-enquiry-data');
	saveWithFiles('.add-enquiry-submit', '#wlim-add-enquiry-form', '#add-enquiry', ['#enquiry-table']);
	fetch('#update-enquiry', 'wl-im-fetch-enquiry', '#fetch_enquiry');
	saveWithFiles('.update-enquiry-submit', '#wlim-update-enquiry-form', '#update-enquiry', ['#enquiry-table']);
	remove('.delete-enquiry', 'delete-enquiry-id', 'delete-enquiry-security', 'delete-enquiry', 'wl-im-delete-enquiry', ['#enquiry-table']);

	/* Actions for student */
	saveWithFiles('.add-student-submit', '#wlim-add-student-form', '#add-student', ['#student-table']);
	fetch('#update-student', 'wl-im-fetch-student', '#fetch_student');
	saveWithFiles('.update-student-submit', '#wlim-update-student-form', '#update-student', ['#student-table']);
	remove('.delete-student', 'delete-student-id', 'delete-student-security', 'delete-student', 'wl-im-delete-student', ['#student-table']);

	/* Fetch student enquiries */
	jQuery(document).on('change', '#wlim-student-from_enquiry', function() {
		jQuery('span.text-danger').remove();
		if(this.checked) {
			fetchRecords('wl-im-add-student-fetch-enquiries', '#wlim-add-student-from-enquiries');
		} else {
			jQuery('#wlim-add-student-from-enquiries').html("");
			fetchRecords('wl-im-add-student-form', '#wlim-add-student-form-fields');
		}
	});

	/* Fetch student course batches */
	jQuery(document).on('change', '#wlim-student-course', function() {
		jQuery('span.text-danger').remove();
		if(this.value) {
			var data = 'id='+ this.value;
			fetchRecords('wl-im-add-student-fetch-course-batches', '#wlim-add-student-course-batches', data);
		} else {
			jQuery('#wlim-add-student-course-batches').html("");
		}
	});
	jQuery(document).on('change', '#wlim-student-course_update', function() {
		jQuery('span.text-danger').remove();
		if(this.value) {
			var batch_id = jQuery(this).data('batch_id');
			var data = 'id='+ this.value + '&batch_id=' + batch_id;
			fetchRecords('wl-im-add-student-fetch-course-update-batches', '#wlim-add-student-course-update-batches', data);
		} else {
			jQuery('#wlim-add-student-course-update-batches').html("");
		}
	});

	/* Fetch add student form on open modal */
	jQuery(document).on('shown.bs.modal', '#add-student', function() {
		var form = '#wlim-add-student-form';
		jQuery(form)[0].reset();
		jQuery(form + ' span.text-danger').remove();
		jQuery(form + ' .is-valid').removeClass('is-valid');
		jQuery(form + ' .is-invalid').removeClass('is-invalid');
		fetchRecords('wl-im-add-student-form', '#wlim-add-student-form-fields');
		jQuery('#wlim-add-student-from-enquiries').html('');
	});

	/* Fetch student enquiry */
	jQuery(document).on('change', '#wlim-student-enquiry', function() {
		var data = null;
		if(this.value) {
			data = 'id='+ this.value;
		}
		fetchRecords('wl-im-add-student-fetch-enquiry', '#wlim-add-student-form-fields', data);
	});

	/* Fetch student fees payable */
	jQuery(document).on('change', '#wlim-student-course', function() {
		var data = null;
		if(this.value) {
			data = 'id='+ this.value;
		}
		fetchRecords('wl-im-add-student-fetch-fees-payable', '#wlim-add-student-fetch-fees-payable', data);
	});

	/* Actions for fee */
	initializeDatatable('#installment-table', 'wl-im-get-installment-data');
	save('.add-installment-submit', 'wl-im-add-installment', '#wlim-add-installment-form', '#add-installment', ['#installment-table']);
	fetch('#update-installment', 'wl-im-fetch-installment', '#fetch_installment');
	save('.update-installment-submit', 'wl-im-update-installment', '#wlim-update-installment-form', '#update-installment', ['#installment-table']);
	remove('.delete-installment', 'delete-installment-id', 'delete-installment-security', 'delete-installment', 'wl-im-delete-installment', ['#installment-table']);
	fetch('#print-installment-fee-receipt', 'wl-im-print-installment-fee-receipt', '#print_installment_fee_receipt');

	/* Fetch student fees */
	jQuery(document).on('change', '#wlim-installment-student', function() {
		var data = null;
		if(this.value) {
			data = 'id='+ this.value;
			fetchRecords('wl-im-add-installment-fetch-fees', '#wlim_add_installment_fetch_fees', data);
		}
	});

	/* Actions for exam */
	initializeDatatable('#exam-table', 'wl-im-get-exam-data');
	saveWithFiles('.add-exam-submit', '#wlim-add-exam-form', '#add-exam', ['#exam-table']);
	fetch('#update-exam', 'wl-im-fetch-exam', '#fetch_exam');
	saveWithFiles('.update-exam-submit', '#wlim-update-exam-form', '#update-exam', ['#exam-table']);
	remove('.delete-exam', 'delete-exam-id', 'delete-exam-security', 'delete-exam', 'wl-im-delete-exam', ['#exam-table']);

	/* Actions for result */
	saveWithFiles('.save-result-submit', '#wlim-save-result-form', '#save-result', [], false);
	fetch('#update-result', 'wl-im-fetch-result', '#fetch_result');
	remove('.delete-result', 'delete-result-id', 'delete-result-security', 'delete-result', 'wl-im-delete-result', ['#result-table']);
	/* Fetch result course batches */
	jQuery(document).on('change', '#wlim-result-course', function() {
		jQuery('span.text-danger').remove();
		if(this.value) {
			var data = 'id='+ this.value;
			fetchRecords('wl-im-add-result-fetch-course-batches', '#wlim-add-result-course-batches', data);
		} else {
			jQuery('#wlim-add-result-course-batches').html("");
		}
	});
	/* Fetch result batch students */
	jQuery(document).on('change', '#wlim-result-batch', function() {
		jQuery('span.text-danger').remove();
		if(this.value) {
			var data = 'id='+ this.value;
			data += '&exam_id=' + jQuery('#wlim-result-exam').val();
			fetchRecords('wl-im-add-result-fetch-batch-students', '#wlim-add-result-batch-students', data);
		} else {
			jQuery('#wlim-add-result-batch-students').html("");
		}
	});
	/* Fetch exam results */
	jQuery(document).on('submit', '#wlim-get-exam-results-form', function(e) {
		e.preventDefault();
		jQuery('span.text-danger').remove();
		var data = jQuery('#wlim-get-exam-results-form').serialize();
		fetchRecords('wl-im-get-exam-results', '#wlim-get-exam-results', data);
	});

	/* Actions for report */
	jQuery(document).on('submit', '#wlim-view-report-form', function(e) {
		e.preventDefault();
		var data = jQuery('#wlim-view-report-form').serialize();
		fetchRecords('wl-im-view-report', '#wlim-view-report', data);
	});
	fetch('#print-student', 'wl-im-print-student', '#print_student');
	fetch('#print-student-admission-detail', 'wl-im-print-student-admission-detail', '#print_student_admission_detail');
	fetch('#print-student-fees-report', 'wl-im-print-student-fees-report', '#print_student_fees_report');
	fetch('#print-student-certificate', 'wl-im-print-student-certificate', '#print_student_certificate');

	/* Actions for notifications */
	jQuery(document).on('change', '#wlim-notification_by', function() {
		jQuery('span.text-danger').remove();
		var data = jQuery('#wlim-notification-configure-form').serialize();
		fetchRecords('wl-im-notification-configure', '#wlim-notification-configure', data);
	});
	jQuery('.send-notification-submit').mousedown(function() {
	    tinyMCE.triggerSave();
	});
	saveWithFiles('.send-notification-submit', '#send-notification-form', null, [], false);

	/* Actions for noticeboard */
	initializeDatatable('#notice-table', 'wl-im-get-notice-data');
	saveWithFiles('.add-notice-submit', '#wlim-add-notice-form', '#add-notice', ['#notice-table']);
	fetch('#update-notice', 'wl-im-fetch-notice', '#fetch_notice');
	saveWithFiles('.update-notice-submit', '#wlim-update-notice-form', '#update-notice', ['#notice-table']);
	remove('.delete-notice', 'delete-notice-id', 'delete-notice-security', 'delete-notice', 'wl-im-delete-notice', ['#notice-table']);

	/* Actions for payments */
	jQuery('#wlim-pay-fees').ajaxForm({
		success: function(response) {
			jQuery('.pay-fees-submit').prop('disabled', false);
			if(response.success) {
				jQuery('span.text-danger').remove();
				jQuery(".is-valid").removeClass("is-valid");
				jQuery(".is-invalid").removeClass("is-invalid");
				jQuery('#wlim-pay-fees')[0].reset();
				jQuery('.wlim-pay-fees-now').html(response.data.html);
			} else {
				jQuery('span.text-danger').remove();
				if(response.data && jQuery.isPlainObject(response.data)) {
					jQuery('#wlim-pay-fees :input').each(function() {
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
					var errorSpan = '<span class="text-danger ml-3 mt-3">' + response.data + '<hr></span>';
					jQuery(errorSpan).insertBefore('#wlim-pay-fees');
					toastr.error(response.data);
				}
			}
		},
		error: function(response) {
			jQuery('.pay-fees-submit').prop('disabled', false);
			toastr.error(response.statusText);
		},
		uploadProgress(event, progress, total, percentComplete) {
			jQuery('#wlim-progress').text(percentComplete);
		}
	});

	/* Reset plugin */
	var loaderContainer = jQuery('<span/>', {
        'class': 'wlim-loader ml-2'
    });
    var loader = jQuery('<img/>', {
        'src': WL_IMP_ADMIN_URL + 'images/spinner.gif',
        'class': 'wlim-loader-image mb-1'
    });
	jQuery('#wl-im-reset-plugin-form').ajaxForm({
		beforeSubmit: function(arr, $form, options) {
			var message = jQuery('.wl-im-reset-plugin-button').data('message');
			if(confirm(message)) {
				/* Disable submit button */
				jQuery('.wl-im-reset-plugin-button').prop('disabled', true);
				/* Show loading spinner */
		        loaderContainer.insertAfter(jQuery('.wl-im-reset-plugin-button'));
				loader.appendTo(loaderContainer);
		        return true;
			}
			return false;
		},
		success: function(response) {
			toastr.success(response.data.message);
		},
		error: function(response) {
			toastr.error(response.statusText);
		},
		complete: function(event, xhr, settings) {
			/* Enable submit button */
			jQuery('.wl-im-reset-plugin-button').prop('disabled', false);
			/* Hide loading spinner */
			loaderContainer.remove();
		}
	});

});