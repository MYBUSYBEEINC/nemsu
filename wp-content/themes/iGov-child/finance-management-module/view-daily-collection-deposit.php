<?php //Template Name: View Daily Collection Deposit?>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>finance-management-module/modules-style.css" rel="stylesheet" />
    <?php 
    get_header(); 
        $title =  'VIEW DAILY COLLECTION DEPOSIT';
    ?>
    <title><?=$title?></title>
    <style>
        .table thead th {
            background-color: #90ADCB !important;
            font-size: 14px !important;
            color: #fff !important;
            border:solid 1px #000;
        }
        td{
            text-align:center;
        }
        .form-control{
            background-color: #F5F5F5;
            border:0;
        }td{
            border:solid 1px #000;
        }
    </style>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <div class="card border-0 mt-3">
                <h5 class="card-header bg-white border-0 text-capitalize"><?=$title?></h5>
                <div class="card-body">
                    <div class="row">
                        <h6>Date range</h6>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">From</label>
                                <input type="date" class="form-control" id="date">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">To</label>
                                <input type="date" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer bg-white text-muted">
                    <table class="table mt-5 filter-base-date">
                        <thead>
                            <tr>
                                <?php
                                    $titleHead = array(
                                        "Date", 
                                        "Teller", 
                                        "Total Collection", 
                                        "Total Deposit Amount",
                                        "Undeposit Amount",
                                    );

                                    foreach ($titleHead as $value) {
                                        echo "<th scope='col' class='text-center'>$value</th>";
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    query_posts(array(    
                                        'posts_per_page' => -1,
                                        'orderby' => 'DESC',
                                        'post_type' => array(
                                        'enter_daily_collect')));
                                    if ( have_posts() ) :
                                    while ( have_posts() ) : the_post();
                                ?>
                                    <td><?=the_field('date')?></td>
                                    <td><?php echo the_field('teller');?></td>
                                    <td><?php echo the_field('total_collection');?></td>
                                    <td><?php echo the_field('total_deposit_amount');?></td>
                                    <td><?php echo the_field('undeposit_amount');?></td>
                                <?php
                                    the_content();
                                    endwhile; endif;
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


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
