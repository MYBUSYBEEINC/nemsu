jQuery(document).ready(function() {
	/* Date time picker */
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
});