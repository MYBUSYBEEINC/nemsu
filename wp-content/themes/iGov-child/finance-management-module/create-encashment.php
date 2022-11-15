<?php //Template Name: Encashment?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Encashment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
    <?php 
        acf_form_head();
        get_header(); 
    ?>

    <style>
        /* .form-control{
            background-color:#F5F5F5;
            border: 0;
        }
        body{
            background-color:#F5F5F5;
        }
        .acf-field[data-width] + .acf-field[data-width] {
            border-left: 0 !important;
        }
        .acf-fields > .acf-field {
            position: relative;
            margin: 0;
            padding: 16px;
            border-top-width: 0 !important;
            border-top-style: solid !important;
            border-top-color: 0 !important;
        }
        .acf-field input[type=text], .acf-field input[type=password], .acf-field input[type=date], .acf-field input[type=datetime], .acf-field input[type=datetime-local], .acf-field input[type=email], .acf-field input[type=month], .acf-field input[type=number], .acf-field input[type=search], .acf-field input[type=tel], .acf-field input[type=time], .acf-field input[type=url], .acf-field input[type=week], .acf-field textarea, .acf-field select {
            width: 100%;
            padding: 4px 8px;
            margin: 0;
            box-sizing: border-box;
            font-size: 14px;
            line-height: 2.5;
            background-color: #F5F5F5;
            border: 0;
            border-radius: 5px;
        }
        .finance-amount{
            right: 0;
        }
        button, input[type="submit"], input[type="button"], input[type="reset"] {
            background: #F5F5F5;
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
        } */
        
    </style>
  </head>
  <body>

    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-lg-2">
                <div class="tab-cont">
                    <button class="btnFinanceTab" onclick="financeTabs(event, 'acceptCollection')">Accept Collection</button>
                    <button class="btnFinanceTab" onclick="financeTabs(event, 'createEncashment')">Create Encashment</button>
                    <button class="btnFinanceTab" onclick="financeTabs(event, 'createCashCount')">Create Cash Count</button>
                </div>
            </div> -->
            <div class="col-lg-12 col-md-12">
                <div class="tab-content" id="acceptCollection">
                    <div class="card border-0 mt-3">
                        <h5 class="card-header bg-white border-0">Encashment</h5>
                        <div class="card-body">
                            <!-- <div class="row">
                                <div class="col-lg-12 col-md-12"> -->
                                <!-- <php
                                query_posts(array(
                                'post_type' => 'your-posttype',
                                'posts_per_page' => 3,
                                'meta_key' => 'your-custom-field-name',
                                'meta_value' => 'your-field-value'
                                ));
                                if ( have_posts() ) : ?>
                                <ul>
                                <php while ( have_posts() ) : the_post(); ?>
                                <li>
                                <a href="<php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </li>
                                <php endwhile; ?>
                                </ul>
                                <php endif; wp_reset_query(); ?> -->

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
                                                'group_636b9c9460f69',          // Test Group Field

                                                // 'field_key' => 'acf-field_636b68bc9fa7c'
                                            ),
                                            'new_post'      => array(
                                                'post_title'    =>  $token,
                                                'post_type'     => 'create_encashment',  // Custom Post Type
                                                'post_status'   => 'publish'
                                            ),
                                            'submit_value'  => 'Submit',        // Submit button label
                                            'return' => '?Submitted=y'          // Return URL after submitting the form
                                            
                                            
                                        ));
                                    ?>
                                    <!-- <div class="mb-3">
                                        <label  class="form-label fw-bd">Transaction No.</label>
                                        <input type="number" class="form-control" placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Particular</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>

                                    <form class="row">
                                        <div class="col-md-6 ps-0">
                                            <div class="mb-3 m">
                                                <label  class="form-label fw-bd">Type</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <div class="mb-3">
                                                <label  class="form-label fw-bd">Trans Date.</label>
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                    </form>

                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Cheque No.</label>
                                        <input type="number" class="form-control" placeholder="">
                                    </div> -->
                                <!-- </div> -->
                                <!-- <div class="col-lg-6 col-md-12">
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">From Teller</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">To Teller</label>
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="d-flex flex-row-reverse">
                                        <div class="ps-2 pr-0">
                                            <input type="number" class="form-control pr-0" placeholder="">
                                        </div>
                                        <div class="p-2">Amount</div>
                                    </div>
                                </div> -->
                            <!-- </div>
                            


                        </div> -->
                        <!-- <div class="card-footer bg-white text-muted">
                            <form class="row">
                                <div class="col-lg-3 col-md-12">
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Last Update by</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="mb-3">
                                        <label  class="form-label fw-bd">Date</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        var button = document.getElementsByClassName('btnFinanceTab'),
            tabContent = document.getElementsByClassName('tab-content');
            button[0].classList.add('active');
            tabContent[0].style.display = 'block';


        function financeTabs(e, financeTabs) {
            var i;
            for (i = 0; i < button.length; i++) {
                tabContent[i].style.display = 'none';
                button[i].classList.remove('active');
            }
            document.getElementById(financeTabs).style.display = 'block';
            e.currentTarget.classList.add('active');
        }

    </script>
  </body>
</html>