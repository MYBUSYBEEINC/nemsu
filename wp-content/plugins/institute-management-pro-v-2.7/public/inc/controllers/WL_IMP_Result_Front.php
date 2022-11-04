<?php
defined( 'ABSPATH' ) or die();

require_once( WL_IMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/WL_IMP_Helper.php' );

class WL_IMP_Result_Front {
	/* Get result */
	public static function get_result() {		
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-im' ) ) {
			die();
		}
		global $wpdb;

		$exam_id       = isset( $_REQUEST['exam'] ) ? intval( sanitize_text_field( $_REQUEST['exam'] ) ) : NULL;
		$enrollment_id = isset( $_REQUEST['enrollment_id'] ) ? sanitize_text_field( $_REQUEST['enrollment_id'] ) : NULL;

		global $wpdb;

		/* Validations */
		$errors = [];
		if ( empty( $exam_id ) ) { ?>
			<strong class="text-danger"><?php _e( 'Please select an exam.', WL_IMP_DOMAIN ); ?></strong>
		<?php
			die();
		}

		if ( empty( $enrollment_id ) ) { ?>
			<strong class="text-danger"><?php _e( 'Please provide an enrollmend ID.', WL_IMP_DOMAIN ); ?></strong>
		<?php
			die();
		}

		$exam = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_exams WHERE is_deleted = 0 AND id = $exam_id AND is_published = 1" );
		if ( ! $exam ) { ?>
			<strong class="text-danger"><?php _e( 'Invalid exam selection.', WL_IMP_DOMAIN ); ?></strong>
		<?php
			die();
		}
		/* End validations */

		$student_id = WL_IMP_Helper::get_student_id( $enrollment_id );

		$student = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_students WHERE is_deleted = 0 AND id = $student_id" );
		if ( ! $student ) { ?>
			<strong class="text-danger"><?php _e( 'Student not found.', WL_IMP_DOMAIN ); ?></strong>
		<?php
			die();
		}

		$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = $exam_id AND student_id = $student_id" );
		if ( ! $result ) { ?>
			<strong class="text-danger"><?php _e( 'Result not found.', WL_IMP_DOMAIN ); ?></strong>
		<?php
			die();
		}

		$id = $student->id;
		$enrollment_id = WL_IMP_Helper::get_enrollment_id( $student->id );
		$name = $student->first_name;
		if ( $student->last_name ) {
			$name .= " $student->last_name";
		}

		$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_im_results WHERE is_deleted = 0 AND exam_id = " . $exam->id . " AND student_id = " . $id );

		$marks  = unserialize( $exam->marks ); ?>
		<div class="wlim-exam-result card mb-3">
			<div class="card-header bg-primary text-white">
				<strong><?php _e( 'Exam Result', WL_IMP_DOMAIN ); ?></strong>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col">
						<div class="border p-2 mb-2">
						<span class="text-dark"><?php _e( "Exam", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo "$exam->exam_title ( $exam->exam_code )"; ?></strong>
						</div>
						<label class="col-form-label"><strong><?php _e( 'Student Details', WL_IMP_DOMAIN ); ?>:</strong></label>
						<ul class="list-group m-0">
							<li class="list-group-item"><span class="text-dark"><?php _e( "Student ID", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo $enrollment_id; ?></strong></li>
							<li class="list-group-item"><span class="text-dark"><?php _e( "Name", WL_IMP_DOMAIN ); ?>: </span><strong><?php echo $name; ?></strong></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="mb-3 mt-2">
							<label class="col-form-label"><strong><?php _e( 'Exam Marks', WL_IMP_DOMAIN ); ?>:</strong></label>
					        <div class="exam_marks_obtained_box">
					            <table class="table table-bordered">
					                <thead>
					                    <tr>
					                        <th><?php _e( 'Subject', WL_IMP_DOMAIN ); ?></th>
					                        <th><?php _e( 'Maximum Marks', WL_IMP_DOMAIN ); ?></th>
					                        <th><?php _e( 'Marks Obtained', WL_IMP_DOMAIN ); ?></th>
					                    </tr>
					                </thead>
					                <tbody class="exam_marks_obtained_rows exam_marks_obtained_table">
					                	<?php
					                	$marks_obtained = null;
										if ( $result ) {
											$marks_obtained = unserialize( $result->marks );
										}
										$total_maximum_marks  = 0;
										$total_marks_obtained = 0;
					                	foreach( $marks['subject'] as $subject_key => $subject_value ) {
					                		$marks_obtained_in_subject = 0;
					                		if ( ! empty( $marks_obtained ) ) {
					                			$marks_obtained_in_subject = $marks_obtained[$subject_key];
					                		}
					                		$total_maximum_marks += $marks['maximum'][$subject_key];
					                		$total_marks_obtained += $marks_obtained_in_subject;
					                	?>
					                    <tr>
					                        <td>
        										<span class="text-dark"><?php echo $subject_value; ?></span>
					                        </td>
					                        <td>
        										<span class="text-dark"><?php echo $marks['maximum'][$subject_key]; ?></span>
					                        </td>
					                        <td>
        										<span class="text-dark"><?php echo $marks_obtained_in_subject; ?></span>
					                        </td>
					                    </tr>
					                    <?php
					        			} ?>
					        			<tr>
					        				<th><?php _e( 'Total', WL_IMP_DOMAIN ); ?></th>
					        				<th><?php echo $total_maximum_marks; ?></th>
					        				<th><?php echo $total_marks_obtained; ?></th>
					        			</tr>
					        			<tr>
					        				<th></th>
					        				<th><?php _e( 'Percentage', WL_IMP_DOMAIN ); ?></th>
					        				<th><?php echo number_format( max( floatval( ( $total_marks_obtained / $total_maximum_marks ) * 100 ), 0 ), 2, '.', '' ); ?> %</th>
					        			</tr>
					                </tbody>
					            </table>
					        </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		die();
	}
}
?>