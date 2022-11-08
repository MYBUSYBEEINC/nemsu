<?php

add_filter('acf/validate_value/name=password', 'validatePassword', 10, 4);
function validatePassword( $valid, $value, $field, $input ){
    // bail early if value is already invalid
    if( !$valid ) {
        return $valid;
    }
    
    $password           = $_POST['acf']['field_62a14d8b8c916'];   // password
    $confirm_password   = $_POST['acf']['field_62a14d9c8c917'];   // confirm password
    
    if ($password != $confirm_password) {
        $valid = 'Passwords do not match! Please try again';
    } else {
    
    }
    return $valid;
}

add_filter('acf/validate_value/name=confirm_password', 'validateConfirmPassword', 10, 4);
function validateConfirmPassword( $valid, $value, $field, $input ){
    // bail early if value is already invalid
    if( !$valid ) {
        return $valid;
    }
    
    $password           = $_POST['acf']['field_62a14d8b8c916'];   // password
    $confirm_password   = $_POST['acf']['field_62a14d9c8c917'];   // confirm password
    
    if ($password != $confirm_password) {
        $valid = 'Passwords do not match! Please try again';
    } else {
    
    }
    return $valid;
}

add_filter('acf/validate_value/name=username', 'validateUsername', 10, 4);
function validateUsername( $valid, $value, $field, $input ){
    // bail early if value is already invalid
    if( !$valid ) {
        return $valid;
    }
    
    $username = $_POST['acf']['field_62a14d708c914'];   // username
    
    $user_data = get_user_by( 'login', $username );
    if ( empty( $user_data ) ) {
    } else {
        $valid = "Username already exists. Please enter new username.";
    }
    
    return $valid;
}

add_filter('acf/validate_value/name=email', 'validateEmail', 10, 4);
function validateEmail( $valid, $value, $field, $input ){
    // bail early if value is already invalid
    if( !$valid ) {
        return $valid;
    }
    
    $email = $_POST['acf']['field_62a14d7b8c915'];   // email
    
    $user_data = get_user_by( 'email', $email );
    if ( empty( $user_data ) ) {
    } else {
        $valid = "Email Address already exists. Please enter new email.";
    }
    
    return $valid;
}

?>