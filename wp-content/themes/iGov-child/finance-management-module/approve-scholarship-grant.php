<?php //Template Name: Finance - Approve Scholarship Grant?>


<title>Approve Scholarship Grant</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="<?php echo get_stylesheet_directory_uri(); ?>finance-management-module/modules-style.css" rel="stylesheet" />
<style>td{text-align:center;text-transform: capitalize;}</style>
<?php 
    get_header(); 
?>
<div class="container-fluid">
    <table class="table mt-5 filter-base-date display nowrap" id="scrollbar-horizontal" style="width:100%">
        <thead>
            <tr>
                <?php
                    $titleHead = array(
                        "Student No", 
                        "Student Name", 
                        "Approved", 
                        "Units Enrolled",
                        "Rate/Unit",
                        "Tuition Fee",
                        "Miscellaneous",
                        "Larboratory Fee",
                        "TF Percent",
                        "Misc. Percent",
                        "Lab Percent",
                        "Tution Fee Discount",
                        "Misc Fee Discount",
                        "Lab Fee Discount",
                        "Other Benefits",
                        "Total Discount"
                    );
                    foreach ($titleHead as $value) {
                        echo "<th scope='col' class='text-center'style='font-size:14px;'>$value</th>";
                    }
                ?>
            </tr>
        </thead>
        
        <?php
            query_posts(array(    
                'posts_per_page' => -1,
                'orderby' => 'DESC',
                'post_type' => array(
                'student_information')));
            if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                $lname = get_field('last_name');
                $fname = get_field('first_name');
                $mname = get_field('middle_name');
                $suffix = get_field('suffix');
                $fullName = "$fname $mname $lname $suffix";
        ?>

        <tbody>
            <tr>
                <td><?php echo get_field('student_no');?></td>
                <td><?=$fullName?></td>
                <td><?php if(get_field('approve') =='Yes'):?>
                    <?php echo get_field('approve');?>

                    <?php else: ?>
                        <?php echo get_field('approve');?>
                    <?php endif ?>
                </td>
                <td><?php echo get_field('units_enrolled');?></td>
                <td><?php echo get_field('rateunit');?></td>
                <td><?php echo get_field('tuition_fee');?></td>
                <td><?php echo get_field('miscellaneous');?></td>
                <td><?php echo get_field('larboratory_fee');?></td>
                <td><?php echo get_field('tf_percent');?></td>
                <td><?php echo get_field('misc_percent');?></td>
                <td><?php echo get_field('lab_percent');?></td>
                <td><?php echo get_field('tution_fee_discount');?></td>
                <td><?php echo get_field('misc_fee_discount');?></td>
                <td><?php echo get_field('lab_fee_discount');?></td>
                <td><?php echo get_field('other_benefits');?></td>
                <td><?php echo get_field('total_discount');?></td>
            </tr>
        </tbody>
    
        <?php
            the_content();
            endwhile; endif;
        ?>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script>

    $(document).ready(function() {
        var table = $('#scrollbar-horizontal').dataTable( {
            "sScrollX": "100%",
            "sScrollXInner": "110%",
            "bScrollCollapse": true
        });
    }); 
   
</script>
