<?php
include('validation/validation.php');

// Disable the user admin bar on public side on registration
add_action('user_register','trash_public_admin_bar');
function trash_public_admin_bar($user_ID) {
    update_user_meta( $user_ID, 'show_admin_bar_front', 'false' );
}

if(function_exists('register_sidebar')){
	register_sidebar(array(
		'name' => __('Auxiliary Menu', 'twentythirteen'),
		'id' => 'Auxiliary Menu',
		'description' => __('Appears in the Auxiliary Menu section of the site.'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div>',
		'after_title' => '</div>',
	));
	
		register_sidebar(array(
		'name' => __('Footer Menu Quick Links', 'twentythirteen'),
		'id' => 'Footer Menu Quick Links',
		'description' => __('Appears in the Footer Menu Quick Links section of the site.'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));
}



add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page('Caves', 'Caves', 'manage_options', '../cave-inventory', '', 'dashicons-database', 20);
    add_submenu_page( '../cave-inventory', 'Cave Inventory', 'Cave Inventory', 'manage_options', '../cave-inventory');
    add_submenu_page( '../cave-inventory', 'Cave Assessment', 'Cave Assessment', 'manage_options', '../cave-assessment');
}

add_action( 'login_form_middle', 'add_lost_password_link' );
function add_lost_password_link() {
	return '<a href="'.site_url().'/wp-login.php?action=lostpassword">Lost Password?</a>';
}

function excerpt($limit){
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if(count($excerpt) >= $limit){
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt).'...';
	}else{
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
	return $excerpt;
}

function wpbeginner_numeric_posts_nav()
{
    if (is_singular()) return;
    global $wp_query;
    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1) return;
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);
    /** Add current page to the array */
    if ($paged >= 1) $links[] = $paged;
    /** Add the pages around the current page to the array */
    if ($paged >= 3)
    {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if (($paged + 2) <= $max)
    {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '
<div class="navigation">
   <ul>
      ' . "\n";
    /** Previous Post Link */
    if (get_previous_posts_link()) printf('
      <li>%s</li>
      ' . "\n", get_previous_posts_link());
    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links))
    {
        $class = 1 == $paged ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)) , '1');
        if (!in_array(2, $links)) echo '
      <li>…</li>
      ';
    }
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link)
    {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)) , $link);
    }
    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links))
    {
        if (!in_array($max - 1, $links)) echo '
      <li>…</li>
      ' . "\n";
        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)) , $max);
    }
    /** Next Post Link */
    if (get_next_posts_link()) printf('
      <li>%s</li>
      ' . "\n", get_next_posts_link());
    echo '
   </ul>
</div>
' . "\n";
}

// ADMIN STUFFS
function admin_style() {
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/wp-admin/style.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

function my_login_stylesheet() {
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/wp-admin/login.css');
}
add_action('login_enqueue_scripts', 'my_login_stylesheet');