<?php //Template Name: Set Subsidiary Ledger?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Subsidiary Ledger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>finance-management-module/module-style.css" rel="stylesheet" />
    <?php 
get_header(); ?>

    <style>
        .table thead th {
            background-color: #ffff !important;
            font-size: 15px !important;
            color: #000 !important;
        }
    </style>
  </head>
  <body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="tab-content" id="acceptCollection">
                    <div class="card border-0 mt-3">
                        <h5 class="card-header bg-white border-0">Set Subsidiary Ledger</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Student No</label>
                                        <input type="number" class="form-control" placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Course</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Address</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>

                                    <form class="row">
                                        <div class="col-md-6 ps-0">
                                            <div class="mb-3 m">
                                                <label  class="form-label fw-bd">Telephone</label>
                                                <input type="number" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <div class="mb-3">
                                                <label  class="form-label fw-bd">Mobile</label>
                                                <input type="number" class="form-control">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Student Name</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Department</label>
                                        <input type="text" class="form-control" placeholder="">
                                        <!-- <textarea class="form-control" rows="3"></textarea> -->
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Email</label>
                                        <input type="email" class="form-control" placeholder="">
                                    </div>

                                    <form class="row">
                                        <div class="col-md-6 ps-0">
                                            <div class="mb-3 m">
                                                <label  class="form-label fw-bd">Citizenship</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <div class="mb-3">
                                                <label  class="form-label fw-bd">Birth Date</label>
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 col-md-12">
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Balance</label>
                                        <input type="number" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="d-flex flex-row mb-3">
                                        <div class="p-2">
                                            <button type="button" class="btn btn-primary rounded mt-4">View Details</button>
                                        </div>
                                        <div class="p-2">
                                            <button type="button" class="btn btn-primary rounded mt-4">Adjustment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-muted">
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>