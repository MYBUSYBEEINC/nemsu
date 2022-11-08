<?php //Template Name: Cron - Register Account ?>
<?php acf_form_head(); ?>
<style>
    body{
        font-family:Monospace;
        font-size:13px;
    }
    table{ width:100%; }
    .center { text-align: center; }
</style>

<!-- REGISTRANTS -->
<div>
    <h2 class="center">Pending Registrants</h2>
    <?php
    query_posts( array( 
        'post_type' => array('cpt-registrants'), 
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status',
                'value'    => 'Approved',
                'compare'  => '=='
            ),
            array(
                'key'      => 'update_user',
                'value'    => '1',
                'compare'  => '=='
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $pending_postid             = get_the_ID();
                
                $pending_firstname          = get_field('first_name');
                $pending_lastname           = get_field('last_name');
                $pending_username           = get_field('username');
                $pending_email              = get_field('email');
                $pending_password           = get_field('password'); 
                $pending_status             = get_field('status');
                $pending_update_user        = get_field('update_user');
                $userole                    = 'registrants';
                ?>
                
                <tr>
                    <td><?php echo $pending_postid; ?></td>
                    <td><?php echo $pending_firstname.' '.$pending_lastname; ?></td>
                    <td><?php echo $pending_username; ?></td>
                    <td><?php echo $pending_email; ?></td>
                    <td><?php echo $pending_password; ?></td>
                    <td><?php echo 'Status: '.$pending_status; ?></td>
                    <td><?php echo 'Update user: '.$pending_update_user; ?></td>
                </tr> 
                
                <?php
                    $userdata = array(
                        'user_login'    => $pending_username,
                        'user_pass'     => $pending_password,
                        'user_email'    => $pending_email,
                        'first_name'    => $pending_firstname,
                        'last_name'     => $pending_lastname,
                        'display_name' => "$pending_firstname $pending_lastname",
                        'role' => $userole
                    );
                    $user_id = wp_insert_user($userdata);
                    update_post_meta($pending_postid, 'update_user', 0);
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Accounts.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>
