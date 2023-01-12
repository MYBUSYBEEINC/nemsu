<?php //Template Name: Finance - Enter Group Adjustment

    // get_template_part('scripts.php');
    acf_form_head();
    get_header(); 
    $title =  'Enter Group  Adjsutments';
?>
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
    <style>
        td{text-align:center}
    </style>

<body <?php body_class(); ?> style="background: #F5F5F5;">
<?php wp_body_open(); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 mt-3">
                    <h5 class="card-header bg-white border-0 ml-3 mt-3"><?=$title?></h5>
                    <div class="card-body">
                        <?php if(isset($_GET['submitted']) || isset($_GET['ega'])){
                            $getEnterGroupAdjustmentsID;

                            if($_GET['ega']){
                                query_posts( array( 
                                    'post_type'         => 'enter_adjustments',
                                    'posts_per_page'    => 1,
                                    's'                 => $_GET['submitted']
                                ));
                                if ( have_posts() ) {
                                    while ( have_posts() ) { the_post();
                                        $getEnterGroupAdjustmentsID = get_the_id();
                                    }
                                }
                                wp_reset_query();

                                $data = array(
                                    'ID'           => $getEnterGroupAdjustmentsID,
                                    'post_title'   => get_field('adjustment_no', $getEnterGroupAdjustmentsID),
                                );

                                wp_update_post( $data );
                                ?>
                                <script>
                                    window.location.href = "<?=site_url().'/finance-dashboard/enter-group-adjustments/?submitted='.$getEnterGroupAdjustmentsID; ?>";
                                </script>
                            <?php } else {
                                $getEnterGroupAdjustmentsID = $_GET['submitted'];
                            } ?>

                            <div id="alert-container">
                                <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! 
                                    <strong><?php echo get_field('adjustment_no', $getEnterGroupAdjustmentsID); ?></strong> has been successfully created.
                                </div>
                            </div>
                        <?php } ?>


                        <?php 
                            function generateRandomString($length) {
                                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                $charactersLength = strlen($characters);
                                $randomString = '';
                                for ($i = 0; $i < $length; $i++) {
                                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                                }
                                return $randomString;
                            }
                            $token = generateRandomString(15);

                            acf_form(array(
                                'post_id'       => 'new_post',
                                'field_groups'  => array(
                                    'group_637add98cce55'          // Test Group Field
                                ),
                                'new_post'      => array(
                                    'post_title'    =>  $token,
                                    'post_type'     => 'enter_adjustments',  // Custom Post Type
                                    'post_status'   => 'publish'
                                ),
                                'submit_value'  => 'Save',        // Submit button label
                                'return' => '?submitted='.$token.'&ega=y'
                                
                                
                            ));
                        ?>
                        <div class="pl-3 pr-3 pt-5">
                            <table class="table mt-5 filter-base-date">
                                <thead>
                                    <tr>
                                        <?php
                                            $titleHead = array("Student No", 
                                            "Student Name", 
                                            "Adj Amount",
                                            "Remarks");

                                            foreach ($titleHead as $value) {
                                                echo "<th scope='col' class='text-center text-capitalize'>$value</th>";
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                            query_posts(array(    
                                                'posts_per_page' => -1,
                                                'orderby' => 'DESC',
                                                'post_type' => array(
                                                'student_information')));
                                            if ( have_posts() ) :
                                            while ( have_posts() ) : the_post();
                                                // get_field('', $ID)['']
                                                $lname = get_field('last_name');
                                                $fname = get_field('first_name');
                                                $mname = get_field('middle_name');
                                                $suffix = get_field('suffix');
                                                $fullName = "$fname $lname $mname $suffix";
                                        ?>
                                            <tr>
                                                <td><?=get_field('student_no')?></td>
                                                <td class="text-capitalize"><?=$fullName?></td>
                                                <td></td>
                                                <td><?=get_field('remarks')?></td>
                                            </tr>
                                        <?php
                                            the_content();
                                            endwhile; endif;
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(function() {
        var table = $(".filter-base-date").DataTable();

        // Date range vars
        minDateFilter = "";
        maxDateFilter = "";

        $("#date").daterangepicker();
        $("#date").on("apply.daterangepicker", function(ev, picker) {
        minDateFilter = Date.parse(picker.startDate);
        maxDateFilter = Date.parse(picker.endDate);
        
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var date = Date.parse(data[1]);

        if (
        (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
        (isNaN(minDateFilter) && date <= maxDateFilter) ||
        (minDateFilter <= date && isNaN(maxDateFilter)) ||
        (minDateFilter <= date && date <= maxDateFilter)
        ) {
        return true;
        }
        return false;
        });
        table.draw();
        }); 
        

    });
</script>


