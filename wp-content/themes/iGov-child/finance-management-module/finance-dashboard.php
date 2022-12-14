<?php //Template Name: Finance - Dashboard?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <?php 
get_header(); ?>

    <style>
        
    </style>
  </head>
  <body>

    <div class="container-fluid">
        <div class="row mt-3">
            <?php
                query_posts(array(    
                    'posts_per_page' => 5,
                    'orderby' => 'ASC',
                    'post_type' => array(
                    'finance_dashboard')));
                if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                ?>
                    <div class="col">
                        <div class="card border-0 text-bg-white mt-3 mb-3">
                            <div class="card-body">
                                <a href="<?php echo get_site_url();?>/<?php echo get_field('path_link')?>" target="_blank">
                                    <h5 class="card-title text-center"><?php echo get_the_title();?></h5>
                                    <p class="card-text"><?php echo get_field('description');?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                the_content();
                endwhile; endif;
            ?>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12 col-md-12 mb-3">
                <div class="ps-5 pt-3 pb-3 bg-white">
                    <h3>Finance Chart</h3>
                    <small>Keep track your financial plan</small>
                </div>
            </div>

            <div class="col-lg-12 " >
                <div class="p-3 bg-white">
                    <canvas height="60vh" id="myChart"></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <?php
                $titleHead1 = array("View Daily Collection Deposit", "Set Collection Date", "Enter Adjustments", 
                "Accept Collection","Enter Group Adjustments");

                foreach ($titleHead1 as $value1) {
                echo " 
                    <div class='col'>
                        <div class='card border-0 text-bg-white mt-3 mb-3 rounded'>
                            <div class='card-body'>
                                <h5 class='card-title text-center'>$value1</h5>
                                <p class='card-text'>
                                Eum eu prima vitae deterruisset. Vel et accumsan salutandi forensibus, ut est esse posse 5
                                </p>
                            </div>
                        </div>
                    </div>
                ";
                }
            ?>
        </div>
        <div class="row mb-3">
            <?php
                $titleHead2 = array("Print Subsidiary Ledge","Print Admission Slip"
            ,"Approve Scholarship or Grant","Set Teller OR Num. Range","View Student Outstanding Balance");

                foreach ($titleHead2 as $value1) {
                echo " 
                    <div class='col'>
                        <div class='card border-0 text-bg-white mt-3 mb-3 rounded'>
                            <div class='card-body'>
                                <h5 class='card-title text-center'>$value1</h5>
                                <p class='card-text'>
                                Eum eu prima vitae deterruisset. Vel et accumsan salutandi forensibus, ut est esse posse 5
                                </p>
                            </div>
                        </div>
                    </div>
                ";
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

        <script>
            const labels = [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ];

            const data = {
                labels: labels,
                datasets: [{
                label: 'Statistic',
                backgroundColor: '#0C25B2',
                borderColor: '#0C25B2',
                data: [0, 10, 5, 2, 20, 30, 45, 34, 67, 66, 78, 99, 87],
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>
  </body>
</html>