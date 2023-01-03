<?php //Template Name: Finance - Enter Adjustment

// get_template_part('scripts.php');
acf_form_head();
get_header(); 


?>
<title>Enter Adjsutments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="<?php echo get_stylesheet_directory_uri(); ?>/finance-management-module/modules-style.css" rel="stylesheet" />
<style>
	
</style>

<div id="primary" class="content-area p-3">
    <div id="content" class="site-content" role="main">
        <?php 
            acf_form(
                array(
                    'post_id' => $post_id,
                    'post_title'   => false,
                    'post_content' => false,
                    'field_groups'  => array(
                        'group_637add98cce55'
                    ),
                    'updated_message' => __("", 'acf'),
                    'return' => add_query_arg(array('updated' => 'true'), get_permalink()),
                    'submit_value'  => __('Save'),
                )
            );
        ?>
    </div>
    <div class="row">
        <div class="col-lg-12 bg-white">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <?php
                            $titleHead = array("Reference No", "Particular", "Balance", "Adjustments Remarks","Adj Amount");

                            foreach ($titleHead as $value) {
                                echo "<th scope='col' class='text-center'>$value</th>";
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            $tableContent = array("08907896", "Cardo dalisay", "Agila", "02/13/2015","1,200");

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



