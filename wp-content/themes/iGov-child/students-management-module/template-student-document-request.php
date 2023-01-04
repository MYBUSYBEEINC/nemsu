<?php //Template Name: Student Document Request ?>
<?php get_header(); ?>
<style>
.site-main{
    margin-left: 13.1rem;
}
</style>

		<div class="class-wrapper-index">
      <div class="class-container">
      <?php
        query_posts(array(
        'post_type' => 'student_document_req',
        'posts_per_page' => -1,
        ));
        if ( have_posts() ) : ?>
        <table id="student-info">
            <thead>
                <tr>
                    <th>Request No.</th>
                    <th>Request Date</th>
                    <th>O.R No.</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Last School Year</th>
                    <th>Document Type</th>
                    <th>Legend</th>
                    <th>Encoded By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php while ( have_posts() ) : the_post(); 
            $cpost=get_the_ID(); 
            $title=get_the_title($cpost);
            ?>
            <tbody>
                <tr>
                    <td><?php the_title(); ?></td>
              
                    <td><?php get_the_date(); ?></td>
              
                    <td><?php the_title(); ?></td>
               
                    <td><?php the_field('student_name'); ?></td>
               
                    <td><?php the_field('level'); ?></td>
            
                    <td><?php the_field('school_year'); ?></td>
               
                    <td><?php the_sub_field('requirement_name'); ?></td>

                    <td>PRINTED</td>

                    <td><?php get_author_name(); ?></td>

                    <td>
                        <a class="student-icon" href="view-student-information?post_id=<?php echo $cpost?>" title="View">
                        <i class="fas fa-eye"></i>
                        </a>
                        <a class="student-icon print" href=""  title="Print">
                        <i class="fas fa-print"></i>
                        </a>
                        <a class="student-icon" href="edit-student-information?post_id=<?php echo $cpost?>" title="Edit" >
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
        <a class="button-addnew" href="add-new-request">Add New Request</a>
      </div>
    </div>

<script>
    $(document).ready(function () {
    $('#student-info').DataTable({
        order: [[3, 'desc']],
    });
    });
</script>
    
	

<?php get_footer(); ?>
