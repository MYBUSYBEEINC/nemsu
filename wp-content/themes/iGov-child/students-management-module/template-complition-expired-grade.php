<?php //Template Name: Completion of Expired Grades ?>
<?php get_header(); ?>


		<div class="class-wrapper">
      <div class="class-container">
        <h2>Completion of Expired Grades</h2>
      <?php
        query_posts(array(
        'post_type' => 'completion_of_grades',
        'posts_per_page' => -1,
        ));
        if ( have_posts() ) : ?>
        <table id="student-info">
            
            <thead>
                <tr>
                    <th>School Year</th>
                    <th>Grade Status</th>
                    <th>Final Completion Day</th>
                    <th>Status</th>
                    <th>Update</th>
                    <th>User</th>
                </tr>
            </thead>
            <?php while ( have_posts() ) : the_post(); 
            $cpost=get_the_ID(); 
            $title=get_the_title($cpost);
            ?>
            <tbody>
                <tr>  
                    <td><?php the_field('school_year'); ?></td>
              
                    <td><?php the_field('grade_status'); ?></td>
              
                    <td><?php the_field('final_completion_day'); ?></td>
               
                    <td><?php the_field('status'); ?></td>
               
                    <td><?php the_field('update'); ?></td>
            
                    <td><?php the_field('user'); ?></td>
                </tr>
                

            </tbody>
            <?php endwhile; ?>
            <?php endif; wp_reset_query(); ?>
        </table>
      </div>
    </div>

<script>
    $(document).ready(function () {
    $('#student-info').DataTable({
        dom: 'B<"clear">lfrtip',
    buttons: [ 'copy', 'csv', 'excel' ],
        order: [[3, 'desc']],
    });
    });
</script>
    
	

<?php get_footer(); ?>
