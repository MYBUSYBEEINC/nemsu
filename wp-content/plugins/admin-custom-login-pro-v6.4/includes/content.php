<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once( 'load-saved-settings.php' );
?>
<style>
    #post-social-5 {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo WEBLIZAR_ACL_PLUGIN_URL_PRO.'css/img/pattern-1.png'; ?>') left top repeat, url('<?php echo WEBLIZAR_ACL_PLUGIN_URL_PRO.'css/img/bg1.jpg'; ?>') center center fixed;
    }
</style>
<!-- ==============================================
Fonts
=============================================== -->
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation"
         style="margin-bottom: 0; background-color:#29282f;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="sidebar-toggle hidden-xs" href="javascript:void(0);"><i class="fa fa-bars fa-2x"></i></a>
            <a class="navbar-brand coming-soon-admin-title" href="index.html"
               style="color:#fff;"><?php _e( 'Admin Custom Login Pro', WEBLIZAR_ACL_PRO ) ?></a>
        </div>

        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right coming-soon-top">
            <!-- Code for prev Login page-->
			<?php add_thickbox(); ?>
            <!-- /.dropdown -->
            <li class="dropdown" style="display:none">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>
                </a>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown" style="display:none">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-info fa-fw"></i>
                </a>
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav " id="side-menu">
                    <li class="sidebar-profile text-center">
						<span class="sidebar-profile-picture">
							<img src="<?php echo WEBLIZAR_ACL_PLUGIN_URL_PRO . 'css/img/logo.png'; ?>"
                                 alt="Profile Picture"/>
						</span>
                        <!--<p class="sidebar-profile-description">
							<?php _e( 'Powered By', WEBLIZAR_ACL_PRO ) ?>
						</p>
						<h3 class="sidebar-profile-name"><a href="http://weblizar.com/" target="_blank" style="background-color: #29282f; border-left:0px ; "><?php _e( 'Weblizar', WEBLIZAR_ACL_PRO ); ?></a></h3>-->


                        <h5 style="color:#fff"
                            class="acl-rate"><?php _e( 'Show Us Some Love (Rate Us)', WEBLIZAR_ACL_PRO ) ?></h5>
                        <a class="acl-rate-us" style="text-align:center; text-decoration: none;font:normal 30px/l;"
                           href="https://wordpress.org/plugins/admin-custom-login/" target="_blank">
                            <span class="dashicons dashicons-star-filled"></span>
                            <span class="dashicons dashicons-star-filled"></span>
                            <span class="dashicons dashicons-star-filled"></span>
                            <span class="dashicons dashicons-star-filled"></span>
                            <span class="dashicons dashicons-star-filled"></span>
                        </a>

                    </li>

                    <li>
                        <a class="active" href="#" id="ui-id-1">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fas fa-tachometer-alt fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Dashboard', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Application overview', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="ui-id-6">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-paint-brush fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Background Design', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Modify Background design here', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#" id="ui-id-8">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-paint-brush fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Login form Setting', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Modify Login design here', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#" id="ui-id-s1">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Login Retry Setting', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Set Login Retry Attempts', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#Text-And-Colour" id="ui-id-7">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fas fa-font fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Font Setting', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Modify Login Form Style here', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="#" id="ui-id-3">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Logo Settings', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Customize Logo Settings here', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>

                        <!-- /.nav-second-level -->
                    </li>

                    <!-- Login with token -->
                    <li>
                        <a href="#" id="ui-id-s2">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Login With Token', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Temproray Login Without Password', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                        <!-- /.nav-second-level -->
                    </li>
                    <!-- Login with token end -->

                    <!-- Login Restrictions -->
                    <li>
                        <a href="#" id="ui-id-s3">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-user-times fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Login Restrictions', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Restrict Users', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>
                    <!-- Login Restrictions end -->


                    <li>
                        <a href="#" id="ui-id-9">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-table fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Social Settings', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Connect with your social profile', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="ui-id-sg-9">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Social Login', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Login with your social media accounts', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="#" id="ui-id-13">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fab fa-google fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Google Captcha', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Explore captcha', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="#" id="ui-id-4">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-upload fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Export / Import', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Export / Import Your Data', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="ui-id-12">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-plug fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Recommendations', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Get More Free Useful Plugins', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="ui-id-2">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-question fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Help And Support', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'Ask your query', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="ui-id-18">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fab fa-angellist fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'Our Offers', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( '', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="ui-id-10">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-star fa-stack-1x fa-inverse"></i>
							</span>
                            <span class="sidebar-item-title"><?php _e( 'rate us', WEBLIZAR_ACL_PRO ) ?></span>
                            <span class="sidebar-item-subtitle"><?php _e( 'If you like us', WEBLIZAR_ACL_PRO ) ?></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div class="page-wrapper ui-tabs-panel active" id="option-ui-id-1">
		<?php require_once( 'dashboard/dashboard.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-3">
		<?php require_once( 'settings/page-settings.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-6">
		<?php require_once( 'design/background.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-7">
		<?php require_once( 'design/text_and_color.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-8">
		<?php require_once( 'login-form-setting/Login-form-background.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-9">
		<?php require_once( 'social/social.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-sg-9">
		<?php require_once( 'social/social-login.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-4">
		<?php require_once( 'import-export-setting/import_export.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-2">
		<?php require_once( 'help/help.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-10">
		<?php require_once( 'help/rate.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-13">
		<?php require_once( 'googlecaptcha-settings/gcaptcha-settings.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-12">
		<?php require_once( 'recommendations/recommendations.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-18">
		<?php require_once( 'offers.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-s1">
		<?php require_once( 'login-attempt/attempt.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-s2">
		<?php require_once( 'login-token/login-token.php' ); ?>
    </div>
    <div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-s3">
		<?php require_once( 'login-restriction/login_restrictions.php' ); ?>
    </div>
</div>
<!-- /#wrapper -->
<script>
    jQuery(function () {
        jQuery('.icp').iconpicker({
            title: 'Font Awesome Iocns', // Popover title (optional) only if specified in the template
            selected: false, // use this value as the current item and ignore the original
            defaultValue: true, // use this value as the current item if input or element value is empty
            placement: 'topRight', // (has some issues with auto and CSS). auto, top, bottom, left, right
            showFooter: true,
            mustAccept: false,
        });
    });
</script>