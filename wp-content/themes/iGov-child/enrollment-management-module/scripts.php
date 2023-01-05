<?php //Template Name: Enrollment Scripts

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$data = [
    'status' => 'error',
    'message' => 'invalid request'
];

if (isset($_GET['course']) && is_numeric($_GET['course'])) {
    $data = [
        'status' => 'error',
        'message' => 'course not found'
    ];
    query_posts( [ 
        'post_type'      => 'courses',
        'posts_per_page' => 1,
        'ID'             => $_GET['course']
    ]);
    if ( have_posts() ) {
        while ( have_posts() ) : the_post();
            if (get_field('course_code', $_GET['course']) != null) {
                $data['status'] = 'success';
                $data['message'] = 'course found';
                $data['data'] = [
                    'course_code' => get_field('course_code', $_GET['course']),
                    'course_title' => get_field('course_title', $_GET['course']),
                ];    
            }
        endwhile;
    }
    wp_reset_query();
}

header('Content-type: Application/json');
echo json_encode($data);
exit();