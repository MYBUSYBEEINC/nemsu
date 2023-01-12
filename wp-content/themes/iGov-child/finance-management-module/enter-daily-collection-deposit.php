<?php //Template Name: Finance - Enter Daily Collection Deposit
    acf_form_head();
    get_header(); 
    $title =  'ENTER DAILY COLLECTION DEPOSIT';
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>finance-management-module/modules-style.css" rel="stylesheet" />

    <title><?=$title?></title>
    <style>
        .acf-field input[type=text], .acf-field input[type=password], .acf-field input[type=date], .acf-field input[type=datetime], .acf-field input[type=datetime-local], .acf-field input[type=email], .acf-field input[type=month], .acf-field input[type=number], .acf-field input[type=search], .acf-field input[type=tel], .acf-field input[type=time], .acf-field input[type=url], .acf-field input[type=week], .acf-field textarea{
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
            border-radius: 5px;
            color: #fff !important;
            display: inline-block;
            padding: 11px 24px 10px;
            text-decoration: none;
            float: right;
            margin-right: 17px;
        } .table thead th {
            font-size: 14px !important;
            color: #fff !important;
            border:solid 1px #000;
        }
       td{
            border:solid 1px #000;
            text-align:center;
        }
        .acf-field[data-width] + .acf-field[data-width] {
            border-left: 0px solid #eeeeee !important;
        }
        .acf-fields > .acf-field {
            position: relative;
            margin: 0;
            padding: 16px;
            border-top-width: 0px !important;
            border-top-style: solid !important;
            border-top-color: #EAECF0 !important;
        }
    </style>

<body <?php body_class(); ?> style="background: #F5F5F5;">
    <?php wp_body_open(); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 p-0 mt-3 mb-5">
                    <h5 class="card-header bg-white border-0 text-capitalize"><?=$title?></h5>
                    <div class="card-body p-0">
                        <?php if(isset($_GET['submitted']) || isset($_GET['edcp'])){
                            $getEnterDailyCollectDepositID;

                            if($_GET['edcp']){
                                query_posts( array( 
                                    'post_type'         => 'enter_daily_collect',
                                    'posts_per_page'    => 1,
                                    's'                 => $_GET['submitted']
                                ));
                                if ( have_posts() ) {
                                    while ( have_posts() ) { the_post();
                                        $getEnterDailyCollectDepositID = get_the_id();
                                    }
                                }
                                wp_reset_query();

                                $data = array(
                                    'ID'           => $getEnterDailyCollectDepositID,
                                    'post_title'   => get_field('transaction_no', $getEnterDailyCollectDepositID),
                                );

                                wp_update_post( $data );
                                ?>
                                <script>
                                    window.location.href = "<?=site_url().'/finance-dashboard/enter-daily-collection-deposit/?submitted='.$getEnterDailyCollectDepositID; ?>";
                                </script>
                            <?php } else {
                                $getEnterDailyCollectDepositID = $_GET['submitted'];
                            } ?>

                            <div id="alert-container">
                                <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! 
                                    <strong><?php echo get_field('transaction_no', $getEnterDailyCollectDepositID); ?></strong> has been successfully created.
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
                                    'group_63802f4d34050'          // Test Group Field
                                ),
                                'new_post'      => array(
                                    'post_title'    =>  $token,
                                    'post_type'     => 'enter_daily_collect',  // Custom Post Type
                                    'post_status'   => 'publish'
                                ),
                                'submit_value'  => 'Save',        // Submit button label
                                'return' => '?submitted='.$token.'&edcp=y'
                                
                                
                            ));
                        ?>
                    </div>
                </div>
                <div class="p-3">
                    <h6 class="mb-3 fw-bold">DEPOSIT TO:</h6>
                    <table class="table mt-5 filter-base-date">
                        <thead>
                            <tr>
                                <?php
                                    $titleHead = array(
                                        "ACCT NO.", 
                                        "BANK", 
                                        "TYPE", 
                                        "DATE",
                                        "CASH",
                                        "CHEQUE",
                                        "TOTAL"
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
                                        <td><?=the_field('transaction_no')?></td>
                                        <td><?= the_field('bank')?></td>
                                        <td><?= the_field('type')?></td>
                                        <td><?= the_field('date')?></td>
                                        <td><?= the_field('cash')?></td>
                                        <td><?= the_field('cheque')?></td>
                                        <td><?= the_field('total')?></td>
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
</body>
       

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

