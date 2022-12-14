<?php //Template Name: Student Information List ?>
<?php get_header(); ?>
<style>
    .site-main{
    margin-left: 13.1rem;
}
</style>

		<div class="class-wrapper">
      <div class="class-container">
      <?php
        query_posts(array(
        'post_type' => 'student_information',
        'posts_per_page' => -1,
        ));
        if ( have_posts() ) : ?>
        <table id="student-info">
            <thead>
                <tr>
                    <th>Roll</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th>Mobile No</th>
                    <th>E-mail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php while ( have_posts() ) : the_post(); 
            $cpost=get_the_ID(); 
            $title=get_the_title($cpost);
            ?>
            <tbody>
                <tr>
                    <td><?php the_field('roll_id'); ?></td>
                
                    <td>
                        <?php
                        $img = get_field('student_photo'); 
                        if(!empty($img)) { ?>
                            <img src="<?php echo $img; ?>" alt="">
                       <?php } else { ?>
                        <img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/11/avatar.jpg">
                      <?php } ?>
                    </td>
               
                    <td><?php the_field('student_name'); ?></td>
              
                    <td><?php the_field('gender'); ?></td>
              
                    <td><?php the_field('class'); ?></td>
               
                    <td><?php the_field('section'); ?></td>
               
                    <td><?php the_field('email'); ?></td>
            
                    <td><?php the_field('date_of_birth'); ?></td>
               
                    <td><?php the_field('mobile_number'); ?></td>
              
                    <td><?php the_field('address'); ?></td>

                    <td>
                        <a class="student-icon" href="view-student-information?post_id=<?php echo $cpost?>" title="View">
                        <i class="fas fa-eye"></i>
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
