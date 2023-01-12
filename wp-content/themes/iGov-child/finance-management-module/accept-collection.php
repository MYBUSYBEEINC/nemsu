<?php //Template Name: Finance - Accept Collection 
	acf_form_head();
	get_header(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
<style>
    .acf-field .acf-label label {
        display: block;
        font-weight: 700;
        margin: 0 0 3px;
        padding: 0;
    }
    button, input[type="submit"], input[type="button"], input[type="reset"] {
        background: #F5F5F5;
        background: -webkit-linear-gradient(top, #F5F5F5 0%, #F5F5F5 100%);
        background: linear-gradient(to bottom, #F5F5F5 0%, #F5F5F5 100%);
        border: none;
        border-bottom: 3px solid #F5F5F5 !important;
        border-radius: 8px;
        color: #fff !important;
        display: inline-block;
        padding: 8px 20px;
        text-decoration: none;
    }
    .acf-form-submit {
        margin-bottom: 40px;
        float: right;
    }.assess-steps[data-name=step1] {
        display: block;
    }.btn-cancel{
        margin-right: 7px;
        margin-top:0px;
        border: none;
        font-size:14px;
    }
</style>

<body <?php body_class(); ?> style="background: #F5F5F5;">
	<?php wp_body_open(); ?>
    <div class="container bg-white pt-5">
        <div class="row">
            <div class="col-lg-12">
				<div id="primary" class="content-area">
                    <div id="content" class="site-content" role="main" >

            			<?php if($_GET['steps'] == 1) { ?>
                
							<div style="display: block;">    
								<?php
									$new_post = $_GET['id'];

									acf_form(array(
										'post_id' => $new_post,
										'field_groups' => array(
											'group_636de6d7e08e6', // Set Collection Period
										) ,
										$new_post => array(
											'post_type' =>'set_collection_period',
											'post_status' => 'publish',
										) ,
										'updated_message' => __("", 'acf'),
										'submit_value'  => 'Next',
										'return' => '?id='.$new_post.'&steps=2'
									));
								?>

								<div class="btns align-right">
									<button type="button" class="btn btn-md bg-danger btn-cancel rounded p-2" onclick='cancel_form()'>Cancel</button>
								</div>
                        	</div> 
                		<?php } else if($_GET['steps'] == 2) { ?>

                    		<?php $new_post = $_GET['id'];?>
					
							<div><h5>ACCEPT COLLECTION</h5></div>
							<!-- <php $cpost = $_GET['id']; ?> -->
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
										'group_636cbf361e0bf'          // Test Group Field
									),
									'new_post'      => array(
										'post_title'    =>  $token,
										'post_type'     => 'accept_collection',  // Custom Post Type
										'post_status'   => 'publish'
									),
									'submit_value'  => 'Submit',        // Submit button label
									'return' => '?Submitted=y'          // Return URL after submitting the form
									
									
								));
							?> -->
							<?php
								acf_form(array(
									'post_id' => 'new_post',
									'field_groups' => array(
										'group_636cbf361e0bf', // Accept Collection
									) ,
									'new_post' => array(
										'post_type' => 'accept_collection',
										'post_status' => 'publish',
									) ,
									'updated_message' => __("", 'acf'),
									'submit_value'  => 'Proceed',
									'return' => '?id='.$new_post.'&ac=true'
								));
							?>

							<div class="btns align-right">
								<button class="multiStepsBtn" id="showPrevious" onclick="onButtonClick('back')">Back</button>
								<button class="multiStepsBtn" id="showNextStep" onclick="onButtonClick('submit')">Submit</button>
							</div>

						<?php } else if(isset($_GET['submitted']) || isset($_GET['ac'])){
                            $getAcceptCollectID;

                            if($_GET['ac']){
                                query_posts( array( 
                                    'post_type'         => 'accept_collection',
                                    'posts_per_page'    => 1,
                                    's'                 => $_GET['submitted']
                                ));
                                if ( have_posts() ) {
                                    while ( have_posts() ) { the_post();
                                        $getAcceptCollectID = get_the_id();
                                    }
                                }
                                wp_reset_query();

                                $data = array(
                                    'ID'           => $getAcceptCollectID,
                                    'post_title'   => get_field('account_name', $getAcceptCollectID),
                                );

                                wp_update_post( $data );
                                ?>
                                <script>
                                    window.location.href = "<?=site_url().'/finance-dashboard/accept-collection/?submitted='.$getAcceptCollectID; ?>";
                                </script>
                            <?php } else {
                                $getAcceptCollectID = $_GET['submitted'];
                            } ?>

                            <div id="alert-container">
                                <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Success! 
                                    <strong><?php echo get_field('account_name', $getAcceptCollectID); ?></strong> has been successfully created.
                                </div>
                            </div>
                        <?php } ?>
            		</div>
        		</div>
    		</div>
    	</div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script>
    // Set Collection Period
    function onButtonClick(thisAction) {
        if(thisAction == "back"){
            window.location.href = "<?= site_url().'/finance-dashboard/accept-collection/?id='.$new_post.'&steps=1'; ?>";
        } else if(thisAction == "submit") {
            jQuery(function($) {
                $(".acf-form-submit .acf-button")[0].click();
            });
        }
    }

	function cancel_form() {
        window.location.href = '<?= site_url().'/finance-dashboard/accept-collection/?id='.$new_post.'&steps=1' ?>';
    }
    
    function openStep(thisStep){
        console.log("<?= site_url().'/finance-dashboard/accept-collection/?id='.$_GET['id'].'&steps='; ?>"+thisStep);
        
        if(thisStep) {
            window.location.href = "<?= site_url().'/finance-dashboard/accept-collection/?id='.$_GET['id'].'&steps='; ?>"+thisStep;
        }
    }
</script>

	



   
