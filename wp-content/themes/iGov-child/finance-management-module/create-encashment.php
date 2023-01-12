<?php //Template Name: Finance - Encashment
     acf_form_head();
     get_header(); 
     $title =  'Create Encashment';
?>

<title><?=$title?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
<style>
    .acf-field select {
        padding: 9px 8px !important;
        border: 0;
        border-radius: 5px;
        line-height: 2.5;
    }
</style>
<body <?php body_class(); ?> style="background: #F5F5F5;">
<?php wp_body_open(); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card border-0 mt-3">
                    <h5 class="card-header bg-white border-0 ml-3 mt-3"><?=$title?></h5>
                    <div class="card-body">
                        <?php if(isset($_GET['submitted']) || isset($_GET['createEncashment'])){
                            $getCreateEncashmentID;

                            if($_GET['createEncashment']){
                                query_posts( array( 
                                    'post_type'         => 'create_encashment',
                                    'posts_per_page'    => 1,
                                    's'                 => $_GET['submitted']
                                ));
                                if ( have_posts() ) {
                                    while ( have_posts() ) { the_post();
                                        $getCreateEncashmentID = get_the_id();
                                    }
                                }
                                wp_reset_query();

                                $data = array(
                                    'ID'           => $getCreateEncashmentID,
                                    'post_title'   => get_field('transaction_no', $getCreateEncashmentID),
                                );

                                wp_update_post( $data );
                                ?>
                                <script>
                                    window.location.href = "<?=site_url().'/finance-dashboard/create-encashment/?submitted='.$getCreateEncashmentID; ?>";
                                </script>
                            <?php } else {
                                $getCreateEncashmentID = $_GET['submitted'];
                            } ?>

                            <div id="alert-container">
                                <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! 
                                    <strong><?php echo get_field('transaction_no', $getCreateEncashmentID); ?></strong> has been successfully created.
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
                                    'group_636b9c9460f69',          // Test Group Field
                                ),
                                'new_post'      => array(
                                    'post_title'    =>  $token,
                                    'post_type'     => 'create_encashment',  // Custom Post Type
                                    'post_status'   => 'publish'
                                ),
                                'submit_value'  => 'Submit',
                                'return' => '?submitted='.$token.'&createEncashment=y'
                            ));
                        ?>     
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>