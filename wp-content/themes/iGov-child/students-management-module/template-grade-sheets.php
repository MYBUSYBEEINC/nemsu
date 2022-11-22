<?php //Template Name: Grade Sheet ?>
<?php get_header(); ?>


		<div class="class-wrapper">
      <div class="class-container">
      <?php
        query_posts(array(
        'post_type' => 'grade_sheets',
        'posts_per_page' => -1,
        ));
        if ( have_posts() ) : ?>
        <table id="student-info">
            <thead>
                <tr>
                    <th></th>
                    <th>Schedule ID</th>
                    <th>Subject Name</th>
                    <th>Section</th>
                    <th>Subject Description</th>
                    <th>Date Submitted</th>
                    <th>Instructor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php while ( have_posts() ) : the_post(); 
            $cpost=get_the_ID(); 
            $title=get_the_title($cpost);
            ?>
            <tbody>
                <tr>  
                    <td></td>
                    <td><?php the_field('schedule_id'); ?></td>
              
                    <td><?php the_field('subject_name'); ?></td>
              
                    <td><?php the_field('section'); ?></td>
               
                    <td><?php the_field('subject_description'); ?></td>
               
                    <td><?php the_field('date_submitted'); ?></td>
            
                    <td><?php the_field('instructor'); ?></td>

                    <td>
                        <a class="student-icon" href="?post_id=<?php echo $cpost?>" title="View">
                        <i class="fas fa-eye"></i>
                        </a>
                        <a class="student-icon-print" href="" title="Print">
                        <i class="fas fa-print"></i>
                        </a>
                        <a class="student-icon" href="?post_id=<?php echo $cpost?>" title="Edit" >
                        <i class="fas fa-edit"></i>
                        </a> 
                        <a class="student-icon" href="  " title="Delete">
                        <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                

            </tbody>
            <?php endwhile; ?>
            <?php endif; wp_reset_query(); ?>
        </table>
            <div class="grade-buttons">
                <button>Lock All Grades</button>
                <button>Unlock ALl Grades</button>
                <button>Lock All Grades of Graduating Student</button>
                <button>Unloc k ALl Grades of Graduating Student</button>
            </div>
      </div>
    </div>

<script>
    $(document).ready(function() {
    $('#student-info').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    } );
} );
</script>
    
	

<?php get_footer(); ?>
