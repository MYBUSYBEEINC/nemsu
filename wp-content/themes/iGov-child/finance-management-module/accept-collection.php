<?php //Template Name: Finance - Accept Collection ?>
<?php 
acf_form_head();
get_header(); ?>

<link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
<style>
	
</style>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
			<div><h5>ACCEPT COLLECTION</h5></div>
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
			?>

		</div>
	</div>



   
