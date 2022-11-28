<?php
// Template Name: Login

acf_form_head();
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
    <script src="https://kit.fontawesome.com/7fddb8c633.js" crossorigin="anonymous"></script>

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js?ver=3.7.0"></script>
    <![endif]-->
    
    <?php wp_head(); ?>
    <?php
    if ( is_user_logged_in() ) {
        $loggedin = "y";
        global $current_user; wp_get_current_user();
    } else {
        $loggedin = "";
    }
    ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="hfeed site login-page">
        <div id="main">

            <style>
                .site {
                    max-width: inherit;
                }
                .site-content {
                    font-size: inherit;
                }
                .login-container .welcome-msg-container {
                    background: #0267FF;
                    height: 100vh;
                }
                .login-container .welcome-msg-container .welcome-msg-wrapper {
                    height: 100%;
                    width: 50%;
                    margin: 0 auto;
                    padding-top: 25px;
                    padding-bottom: 25px;
                }
                .login-container .welcome-msg-container .welcome-msg-wrapper * {
                    color: #fff;
                }
                .login-container .welcome-msg-container .welcome-msg-wrapper h1 {
                    line-height: 1em;
                    font-size: 70px;
                }
                .login-container .welcome-msg-container .welcome-msg-wrapper p {
                    font-size: 18px;
                    line-height: 1em;
                }
                .login-container .login-form-container {
                    height: 100vh;
                }
                .login-container .login-form-container .login-form-wrapper {
                    height: 100%;
                    width: 50%;
                    margin: 0 auto;
                    padding-top: 25px;
                    padding-bottom: 25px;
                }
                .login-container .login-form-container .login-form-wrapper .login-form-texts h2 {
                    font-weight: 600;
                    color: #3C58A0;
                }
                .login-container .login-form-container .login-form-wrapper .login-form .login-username label,
                .login-container .login-form-container .login-form-wrapper .login-form .login-password label {
                    display: block;
                    color: #3C58A0;
                    font-weight: 600;
                }
                .login-container .login-form-container .login-form-wrapper .login-form .login-username input,
                .login-container .login-form-container .login-form-wrapper .login-form .login-password input {
                    width: 100%;
                    background: #E9EFFF;
                    border-color: #E9EFFF;
                }
                .login-container .login-form-container .login-form-wrapper .login-form .login-submit input {
                    width: 100%;
                    background: #FFA800;
                    border-bottom: none;

                    -webkit-transition: all 0.35s ease;
                    -moz-transition: all 0.35s ease;
                    -o-transition: all 0.35s ease;
                    transition: all 0.35s ease;
                }
                .login-container .login-form-container .login-form-wrapper .login-form .login-submit input:hover,
                .login-container .login-form-container .login-form-wrapper .login-form .login-submit input:active,
                .login-container .login-form-container .login-form-wrapper .login-form .login-submit input:focus {
                    background: #e1a126;
                    
                    -webkit-transition: all 0.35s ease;
                    -moz-transition: all 0.35s ease;
                    -o-transition: all 0.35s ease;
                    transition: all 0.35s ease;
                }
                .login-container .login-form-container .login-form-wrapper .login-form p,
                .login-container .login-form-container .login-form-wrapper .login-form p {
                    margin-bottom: 15px;
                }

                .login-page #content {
                    padding: 0;
                }
                .login-container .login-form-container .login-form-wrapper .login-form .login-remember {
                    text-align: right;
                }
                .login-container .login-form-container .login-form-wrapper .login-form a,
                .login-container .login-form-container .login-form-wrapper .login-form .login-remember {
                    display: inline-block;
                    width: 50%;
                }
            </style>
            <style>
                .txt-center {
                    text-align: center;
                }
                .margin-b-45 {
                    margin-bottom: 45px;
                }
                .pos-relative {
                    position: relative;
                }
                .vertical-center {
                    width: 100%;
                    position: absolute;
                    top:50%;
                    transform:translate(0%, -50%);
                    -webkit-transform:translate(0%, -50%);
                }
            </style>

            <div id="primary" class="content-area page-login">
                <div id="content" class="site-content" role="main">
                    <div class="login-wrapper">
                        <div class="login-container">
                            <div class="col-mid-50">
                                <div class="welcome-msg-container">
                                    <div class="welcome-msg-wrapper pos-relative">
                                        <div class="vertical-center">
                                            <div class="txt-center margin-b-45">
                                                <h2>Welcome to</h2>
                                                <h1>NEMSU <br> System</h1>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore .</p>
                                            <p>Lorem ipsum</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore .</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-mid-50">
                                <div class="login-form-container">
                                    <div class="login-form-wrapper pos-relative">
                                        <div class="vertical-center">
                                            <?php if($loggedin){ ?>
                                                <div class="login-form-texts txt-center margin-b-45">
                                                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/11/nemsu.png" style="width: 200px; margin-bottom: 15px;">
                                                    <h2>NEMSU System</h2>
                                                    <p>Free access to our dashboard</p>
                                                </div>

                                                <div class="login-form logged-in txt-center">
                                                    Welcome back, <?php echo $current_user->display_name; ?>!
                                                    <br>
                                                    Click <a href="<?php echo site_url().'/home'; ?>" style="width: auto;">here</a> to view dashboard
                                                </div>
                                            <?php } else { ?>
                                                <div class="login-form-texts txt-center margin-b-45">
                                                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/11/nemsu.png" style="width: 200px; margin-bottom: 15px;">
                                                    <h2>Log in NEMSU System</h2>
                                                    <p>Free access to our dashboard</p>
                                                </div>

                                                <div class="login-form logged-out">
                                                    <?php wp_login_form(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div><!-- #content -->
            </div><!-- #primary -->
        </div><!-- #main -->
        <div class="clear"></div>
    </div><!-- #page -->
    
    <?php wp_footer(); ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
