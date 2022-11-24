<?php //Template Name: Daily Collection Deposit?>
    
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
        }
    </style>
  </head>
  <body>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <div class="card border-0 mt-3">
                <h5 class="card-header bg-white border-0 text-capitalize"><?=$title?></h5>
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
                <div class="card-footer bg-white text-muted">
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <?php
                                $titleHead = array("Account No", "Bank", "Type", "Date","Cash","Cheque","total
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
                                $tableContent = array("08907896", "Cardo dalisay", "Agila", "02/13/2015","1,200","6,000","7,200
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