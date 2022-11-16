<?php //Template Name: Daily Collection Deposit?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DAILY COLLECTION DEPOSIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>finance-management-module/modules-style.css" rel="stylesheet" />
    <?php 
get_header(); ?>

    <style>
        .table thead th {
            background-color: #ffff !important;
            font-size: 15px !important;
            color: #000 !important;
        }.form-control{
            background-color: #F5F5F5;
            border:0;
        }
    </style>
  </head>
  <body>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <div class="card border-0 mt-3">
                <h5 class="card-header bg-white border-0">Daily Collection Deposit</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Transaction No</label>
                                <input type="number" class="form-control" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Teller</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Collection Date/Balance</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Total Collection</label>
                                <input type="number" class="form-control" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Total Deposit Amount</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label fw-bd">Undeposit Amount</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer bg-white text-muted border-0">
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <?php
                                $titleHead = array("Trx Date", "Particular", "Reference No.", "Debit","Credit","Balance","Trx Type
                                ");

                                foreach ($titleHead as $value) {
                                    echo "<th scope='col' class='text-center'>$value</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $tableContent = array("9/15/2022", "Current Account", "050066514", "0.00","1,200","6,000","OR
                                ");

                                foreach ($tableContent as $value) {
                                    echo "<td class='text-center'>$value</td>";
                                }
                            ?>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>