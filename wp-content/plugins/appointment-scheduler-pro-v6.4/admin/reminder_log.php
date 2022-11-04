<script>
//FETCH REMINDER LOGS DATA 

jQuery(document).ready(function() {
	var table = jQuery('#table_reminder').DataTable( {
		stateSave: true,
		responsive: true,
		ajax: ajaxurl+'?action=reminder_json_ajax_request',
		"aoColumnDefs" : [
		{ 'bSortable' : false, className: 'all', 'aTargets' : ['nosort'],},
		{className: 'all', orderable: true, targets:['sh_ow']}
		],

		"language": {
			"loadingRecords": "__('No Customer Add',WL_A_P_SYSTEM)"
		},

		
	} );
} );

</script>
<?php
global $wpdb;
$ap_payment=$wpdb->get_results("select * from $wpdb->prefix"."apt_payment");
//update status

?>
<div class="panel panel-default">
	<div class="panel-heading"><i class="fas fa-bell"></i><span class="panel_heading"><?php _e('Reminder Logs',WL_A_P_SYSTEM); ?></span> 
	</div>

	<div class="panel-body">

		<div id="paymentdiv" class="table-responsive">
			<table id="table_reminder" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="sh_ow"><?php _e('Appointment Id',WL_A_P_SYSTEM); ?></th>
						<th><?php _e('Client Name',WL_A_P_SYSTEM); ?></th>
						<th><?php _e('Client Email',WL_A_P_SYSTEM); ?></th>
						<th><?php _e('Retries',WL_A_P_SYSTEM); ?></th>
						<th><?php _e('Date and Time',WL_A_P_SYSTEM); ?></th>
						<th><?php _e('Status',WL_A_P_SYSTEM); ?></th>
					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>