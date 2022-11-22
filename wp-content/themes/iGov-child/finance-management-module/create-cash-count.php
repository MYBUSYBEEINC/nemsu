<?php //Template Name: Create Cash Count?>

    <title>Create Cash Count</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
    <?php 
        acf_form_head();
        get_header(); 
    ?>

    <style>
        .form-control{
            background-color:#F5F5F5;
            border: 0;
        }
        body{
            background-color:#F5F5F5;
        }
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="tab-content" id="acceptCollection">
                    <div class="card border-0 mt-3">
                        <h5 class="card-header bg-white border-0">Cash Count</h5>
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

                                    <!-- <php 
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
                                    ?> -->
                                <!-- </div> -->

                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-4">
                                        <div class="mb-3">
                                            <label  class="form-label fw-bd">Transaction No.</label>
                                            <input type="number" class="form-control" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label  class="form-label fw-bd">Teller</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label  class="form-label fw-bd">Collection Date</label>
                                            <input type="date" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="row">
                                            
                                        <?php
                                            $titleHead = array("","Cash", "Cheque", "Total");

                                            foreach ($titleHead as $value) {
                                                
                                                echo "
                                                <div class='col-sm-3 mb-3'>
                                                <label  class='form-label fw-bd text-end'>$value</label></div>
                                                ";
                                            }
                                            ?>
                                        </div>
                                        <?php

                                            $i = 1;

                                            while($i <= 3) {
                                            echo 
                                                "
                                                <div class='mb-3 row'>
                                                <label class='col-sm-3 col-form-label text-end'>Total Collection</label>
                                                    <div class='col-sm-3'>
                                                        <input type='number' class='form-control' >
                                                    </div>
                                                    <div class='col-sm-3'>
                                                        <input type='number' class='form-control' >
                                                    </div>
                                                    <div class='col-sm-3'>
                                                        <input type='number' class='form-control' >
                                                    </div>
                                                </div>
                                            ";
                                            $i++;
                                            }
                                            
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-12">
                                        <?php
                                            $titleHead = array("1000 x", "500 x", "200 x", "100 x", "50 x", "20 x", "10 x", "5 x", "1 x", "0.25x", "0.10 x", "0.5 x", "0.01 x");

                                            foreach ($titleHead as $value) {
                                                echo "
                                                <div class='mb-3 row'>
                                                <label class='col-sm-3 col-form-label'>$value</label>
                                                    <div class='col-sm-9'>
                                                        <input type='number' class='form-control' >
                                                    </div>
                                                    </div>
                                                ";
                                            }
                                        ?>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <?php
                                            $i = 1;

                                            while($i <= 13) {
                                            echo 
                                                "
                                                <div class='mb-3 row'>
                                                <label class='col-sm-2 col-form-label'>=</label>
                                                    <div class='col-sm-10'>
                                                        <input type='number' class='form-control' >
                                                    </div>
                                                    </div>
                                            ";
                                            $i++;
                                            }
                                            
                                        ?>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <table>
                                            <tr><th class="text-center">ITEM DESCRIPTION</th>
                                            <th class="text-center">ITEM DESCRIPTION</th></tr>

                                            <tr>
                                                <td style="height:90vh;background-color:#F5F5F5;"></td>
                                                <td style="height:90vh;background-color:#F5F5F5;"></td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <div class='mb-3 row'>
                                            <label class='col-sm-3 col-form-label text-end'>Processed By:</label>
                                            <div class='col-sm-9'>
                                                <input type='number' class='form-control' >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class='mb-3 row'>
                                            <label class='col-sm-3 col-form-label text-end'>Date :</label>
                                            <div class='col-sm-9'>
                                                <input type='date' class='form-control' >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
