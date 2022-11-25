<?php //Template Name: Enter Daily Collection Deposit?>
    
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
        </div>
    </div>
       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
