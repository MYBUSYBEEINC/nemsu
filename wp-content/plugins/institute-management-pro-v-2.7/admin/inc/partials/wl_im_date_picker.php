<script>
jQuery(document).ready(function() {
	// Show date time picker inside modal
	var defaultDate = new Date();
	var maxDate = new Date();
	var minDate = new Date();
	defaultDate.setFullYear(defaultDate.getFullYear() - 15);
	maxDate.setFullYear(maxDate.getFullYear() - 2);
	minDate.setFullYear(minDate.getFullYear() - 100);
	jQuery('<?php echo $wlim_date_selector; ?>').datetimepicker({
		format: 'DD-MM-YYYY',
		defaultDate: defaultDate,
		showClear: true,
		showClose: true,
		maxDate: maxDate,
		minDate: minDate
	});
	jQuery('span.text-danger').remove();
	jQuery('.is-valid').removeClass('is-valid');
	jQuery('.is-invalid').removeClass('is-invalid');
	jQuery('.wlim-selectpicker').load(location.href + " " + '.wlim-selectpicker', function() {
		/* Select single option */
		try {
			jQuery('.selectpicker').selectpicker({
				liveSearch: true
			});
		} catch (error) {
		}
	});
});
</script>