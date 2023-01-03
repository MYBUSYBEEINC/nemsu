<?php //Template Name: Finance - Enter Daily Collection Deposit?>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>finance-management-module/modules-style.css" rel="stylesheet" />
    <?php 
    get_header(); 
        $title =  'DAILY COLLECTION DEPOSIT';
    ?>
    <title><?=$title?></title>
    <style>
        .table thead th {
            background-color: #90ADCB !important;
            font-size: 14px !important;
            color: #fff !important;
            border:solid 1px #000;
        }.form-control{
            background-color: #F5F5F5;
            border:0;
        }td{
            border:solid 1px #000;
        }.acf-field input[type=text], .acf-field input[type=password], .acf-field input[type=date], .acf-field input[type=datetime], .acf-field input[type=datetime-local], .acf-field input[type=email], .acf-field input[type=month], .acf-field input[type=number], .acf-field input[type=search], .acf-field input[type=tel], .acf-field input[type=time], .acf-field input[type=url], .acf-field input[type=week], .acf-field textarea{
            width: 100%;
            padding: 4px 8px !important;
            margin: 0;
            box-sizing: border-box;
            font-size: 14px;
            line-height: 2.3 !important;
            background-color: #F5F5F5;
            border: 0;
            border-radius: 5px;
            /* text-align: right; */
            padding-right:20px ;
        }.acf-field select {
            padding: 10px 8px !important;
            border: 0;
            border-radius: 5px;
            line-height: 2.3;
            background-color: #F5F5F5;
        }button, input[type="submit"], input[type="button"], input[type="reset"] {
    background: rgb(30 217 199) !important;
    background: -webkit-linear-gradient(top, #F5F5F5 0%, #F5F5F5 100%);
    background: linear-gradient(to bottom, #F5F5F5 0%, #F5F5F5 100%);
    border: none;
    border-bottom: 3px solid #F5F5F5 !important;
    border-radius: 2px;
    color: #000 !important;
    display: inline-block;
    padding: 11px 24px 10px;
    text-decoration: none;
    float: right;
    margin-right: 17px;
} .table thead th {
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
                                'group_63802f4d34050'          // Test Group Field
                            ),
                            'new_post'      => array(
                                'post_title'    =>  $token,
                                'post_type'     => 'enter_daily_collect',  // Custom Post Type
                                'post_status'   => 'publish'
                            ),
                            'submit_value'  => 'Save',        // Submit button label
                            'return' => '?Submitted=y'          // Return URL after submitting the form
                            
                            
                        ));
                    ?>
                    
                </div>
            </div>
            <div class="row mb-5">
                        <h6>Date range</h6>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">From</label>
                                <input type="date" class="form-control" id="daterange">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">To</label>
                                <input type="date" class="form-control" id="daterange">
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
                            
                                <?php
                                    query_posts(array(    
                                        'posts_per_page' => -1,
                                        'orderby' => 'DESC',
                                        'post_type' => array(
                                        'enter_daily_collect')));
                                    if ( have_posts() ) :
                                    while ( have_posts() ) : the_post();
                                ?>
                                <tr>
                                    <td><?=the_field('date')?></td>
                                    <td><?php echo the_field('teller');?></td>
                                    <td><?php echo the_field('total_collection');?></td>
                                    <td><?php echo the_field('total_deposit_amount');?></td>
                                    <td><?php echo the_field('undeposit_amount');?></td>
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

