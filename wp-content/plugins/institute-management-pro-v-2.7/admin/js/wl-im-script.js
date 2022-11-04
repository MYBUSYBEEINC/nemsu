jQuery(document).ready(function() {
	/* Date time picker */
	function dateTimePicker() {
		var defaultDate = new Date();
		var maxDate = new Date();
		var minDate = new Date();
		defaultDate.setFullYear(defaultDate.getFullYear() - 15);
		maxDate.setFullYear(maxDate.getFullYear() - 2);
		minDate.setFullYear(minDate.getFullYear() - 100);
		jQuery('.wlim-date_of_birth').datetimepicker({
			format: 'DD-MM-YYYY',
			defaultDate: defaultDate,
			showClear: true,
			showClose: true,
			maxDate: maxDate,
			minDate: minDate
		});
		jQuery('.wlim-exam-exam_date').datetimepicker({
			format: 'DD-MM-YYYY',
			showClear: true,
			showClose: true
		});
	}

	// Show date time picker inside modal
	function showDateTimePickerInsideModal(modal, refresh = false, target = null) {
		jQuery(document).on('shown.bs.modal', modal, function() {
			dateTimePicker();
			jQuery('span.text-danger').remove();
			jQuery('.is-valid').removeClass('is-valid');
			jQuery('.is-invalid').removeClass('is-invalid');

			if(refresh) {
				jQuery(target).load(location.href + " " + target, function() {
					/* Select single option */
					try {
						jQuery('.selectpicker').selectpicker({
							liveSearch: true
						});
					} catch (error) {
					}
				});
			}
		});
	}

	/* Copy target content to clipboard on click */
	function copyToClipboard(selector, target) {
		jQuery(document).on('click', selector, function() {
			var value = jQuery(target).text();
			var temp = jQuery("<input>");
			jQuery("body").append(temp);
			temp.val(value).select();
			document.execCommand("copy");
			temp.remove();
			toastr.success('Copied to clipboard.');
		});
	}

	/* Reset form on open modal */
	function resetFormOnOpenModal(modal, form, refresh = false, target = null) {
		jQuery(document).on('shown.bs.modal', modal, function() {
			jQuery(form)[0].reset();
			jQuery('span.text-danger').remove();
			jQuery(form + ' .is-valid').removeClass('is-valid');
			jQuery(form + ' .is-invalid').removeClass('is-invalid');
			if(refresh) {
				jQuery(target).load(location.href + " " + target, function() {
					/* Select single option */
					try {
						jQuery('.selectpicker').selectpicker({
							liveSearch: true
						});
					} catch (error) {
					}
				});
			}
		});
	}

	/* Append modal to body */
	function appendModalToBody(modal) {
		jQuery(modal).appendTo("body");
	}

	/* Select single option */
	jQuery('.selectpicker').selectpicker({
		liveSearch: true
	});

	showDateTimePickerInsideModal('#add-enquiry', true, '.wlim-selectpicker');
	showDateTimePickerInsideModal('#add-student', true, '.wlim-selectpicker');
	showDateTimePickerInsideModal('#add-exam');

	copyToClipboard('#wl_im_enquiry_form_shortcode_copy', '#wl_im_enquiry_form_shortcode');
	copyToClipboard('#wl_im_exam_result_form_shortcode_copy', '#wl_im_exam_result_form_shortcode');

	resetFormOnOpenModal('#add-administrator', '#wlim-add-administrator-form');
	resetFormOnOpenModal('#add-course', '#wlim-add-course-form');
	resetFormOnOpenModal('#add-installment', '#wlim-add-installment-form', true, '.wlim-add-installment-form-fields');
	resetFormOnOpenModal('#add-batch', '#wlim-add-batch-form', true, '.wlim-selectpicker');
	resetFormOnOpenModal('#add-notice', '#wlim-add-notice-form');
	resetFormOnOpenModal('#add-exam', '#wlim-add-exam-form');

	appendModalToBody('#add-administrator');
	appendModalToBody('#update-administrator');
	appendModalToBody('#add-course');
	appendModalToBody('#update-course');
	appendModalToBody('#add-batch');
	appendModalToBody('#update-batch');
	appendModalToBody('#add-enquiry');
	appendModalToBody('#update-enquiry');
	appendModalToBody('#add-student');
	appendModalToBody('#update-student');
	appendModalToBody('#print-student');
	appendModalToBody('#print-student-admission-detail');
	appendModalToBody('#print-student-fees-report');
	appendModalToBody('#print-student-certificate');
	appendModalToBody('#add-installment');
	appendModalToBody('#update-installment');
	appendModalToBody('#print-installment-fee-receipt');
	appendModalToBody('#add-notice');
	appendModalToBody('#update-notice');
	appendModalToBody('#add-exam');
	appendModalToBody('#update-exam');

	/* On change notification channel */
	jQuery('.wlim-email-template').hide();
	jQuery(document).on('change', '#wlim-email-notification', function() {
		if ( this.checked ) {
			jQuery('.wlim-email-template').fadeIn();
		} else {
			jQuery('.wlim-email-template').fadeOut();
		}
	});

	/* On change link to notice */
	jQuery('.wlim-notice-attachment').hide();
	jQuery('.wlim-notice-url').hide();
	jQuery(document).on('change', 'input[type=radio][name=notice_link_to]', function() {
	    if(this.value == 'attachment') {
			jQuery('.wlim-notice-attachment').fadeIn();
			jQuery('.wlim-notice-url').hide();
	    }
	    else if(this.value == 'url') {
			jQuery('.wlim-notice-url').fadeIn();
			jQuery('.wlim-notice-attachment').hide();
	    }
	});

	/* Exam marks rows */
	jQuery(document).on('click', '.add-more-exam-marks', function() {
        jQuery('.exam_marks_rows > tr:first').clone().find('input').val('').end().appendTo('.exam_marks_rows');
    });
	jQuery(document).on('click', '.remove_row', function() {
        var rowCount =  jQuery('.exam_marks_rows tr').length;
        if(rowCount > 1) {
            jQuery(this).closest('tr').remove();
        }
    });

	/* Hide link to notice fields on open modal */
	jQuery(document).on('shown.bs.modal', '#add-notice', function() {
		jQuery('.wlim-notice-attachment').hide();
		jQuery('.wlim-notice-url').hide();
	});
});