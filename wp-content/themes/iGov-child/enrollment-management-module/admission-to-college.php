<?php //Template Name: Enrollment Admission to College?>
<?php 
    get_template_part('scripts.php');
    acf_form_head();
    get_header(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>
    a, a:hover {
        text-decoration: none
    }
    .acf-field input[type=text], select, .acf-field input[type=password], .acf-field input[type=date], .acf-field input[type=datetime], .acf-field input[type=datetime-local], .acf-field input[type=email], .acf-field input[type=month], .acf-field input[type=number], .acf-field input[type=search], .acf-field input[type=tel], .acf-field input[type=time], .acf-field input[type=url], .acf-field input[type=week], .acf-field textarea{
        width: 100%;
        padding: 4px 8px !important;
        margin: 0;
        box-sizing: border-box;
        font-size: 14px;
        line-height: 2.5;
        background-color: #F5F5F5;
        border: 0;
        border-radius: 5px;
        /* text-align: right; */
        padding-right:20px ;
    }
</style>

<div class="container-fluid">
    
    <a href="../"><< Back</a>
    
    <h4 class="title text-uppercase mt-4 mb-4">Admission to College</h4>

    <div class="card">
        <div class="card-body">

            <div class="profile-update">

                <?php 
                    acf_form(
                        array(
                            // 'post_id' => $post_id,z
                            'post_title'   => false,
                            'post_content' => false,
                            'field_groups'  => array(
                                'group_636c8f36729cf',
                                'group_637209e28d3df',
                                'group_63720a4da8b8a',
                                'group_63720be55255d',
                                'group_6372190919e9f',
                                'group_6372198fa3096',
                                'group_63721a1b5cc08'
                            ),
                            'updated_message' => __("", 'acf'),
                            'return' => add_query_arg(array('updated' => 'true'), get_permalink()),
                            'submit_value'  => __('Update'),
                        )
                    );
                ?>
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>

<script>
    $(document).ready(function() {
        $(`
            <div class="form-group mr-3 text-right">
                <button type="button" class="btn btn-warning">Course Change</button>
            </div>
        `).insertBefore( ".acf-form-submit" );
    });
</script>