<?php //Template Name: Enrollment Dashboard?>

<?php 
    acf_form_head();
    get_header(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>
    .card-nav {
        border-radius: 15px;
        min-height: 150px;
    }
    .card-nav h4, p {
        color: #fff;
    }
    .card-nav.card-red {
        background: #F64E60;
    }
    .card-nav.card-blue1 {
        background: #6993FF;
    }
    .card-nav.card-green {
        background: #1BC5BD;
    }
    .card-nav.card-blue2 {
        background: #3699FF;
    }
</style>

<div class="container-fluid">


    <div class="row">
        <div class="col-lg-3 col-6 mb-2">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/guidance-result/">
                <div class="card p-2 card-nav card-red">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/enrollment-management-module/images/guidance-result.png" alt="" width="50">
                    <h4 class="card-title mt-2 mb-0">Guidance Result</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/admission-to-college/">
                <div class="card p-2 card-nav card-blue1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/enrollment-management-module/images/admission-to-college.png" alt="" width="50">
                    <h4 class="card-title mt-2 mb-0">Admission to College</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/evaluate/">
                <div class="card p-2 card-nav card-green">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/enrollment-management-module/images/evaluate.png" alt="" width="50">
                    <h4 class="card-title mt-2 mb-0">Evaluate</h4>
                    <p class="card-text">Evaluate new students or transferees</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <a class="card-block stretched-link text-decoration-none" href="<?= site_url(); ?>/enrollment/photograph/">
                <div class="card p-2 card-nav card-blue2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/enrollment-management-module/images/user-photograph.png" alt="" width="50">
                    <h4 class="card-title mt-2 mb-0">Photograph</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet</p>
                </div>
            </a>
        </div>
    </div>
    
    <div class="card border-0 mt-3">
        <div class="card-body">
            <h4 class="card-title">Enrolled Students List School Year 2022-2023</h4>
            <p class="card-description text-secondary"> More than 1,000+ enrolled students </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-uppercase text-12">
                            <th>Student Number</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>5412545125</td>
                            <td>Samso Park</td>
                            <td>Male</td>
                            <td>1</td>
                            <td>A</td>
                            <td>samso@gmail.com</td>
                            <td><label class="badge badge-success">Enrolled</label></td>
                        </tr>
                        <tr>
                            <td>5445122365</td>
                            <td>Andres Sthreet</td>
                            <td>Male</td>
                            <td>1</td>
                            <td>B</td>
                            <td>andres@gmail.com</td>
                            <td><label class="badge badge-success">Enrolled</label></td>
                        </tr>
                        <tr>
                            <td>9556526331</td>
                            <td>Park Mujin</td>
                            <td>Male</td>
                            <td>1</td>
                            <td>A</td>
                            <td>park@gmail.com</td>
                            <td><label class="badge badge-success">Enrolled</label></td>
                        </tr>
                        <tr>
                            <td>5542122211</td>
                            <td>Steven Gong</td>
                            <td>Male</td>
                            <td>2</td>
                            <td>C</td>
                            <td>steve@gmail.com</td>
                            <td><label class="badge badge-success">Enrolled</label></td>
                        </tr>
                        <tr>
                            <td>8845115001</td>
                            <td>Denice Lauriat</td>
                            <td>Female</td>
                            <td>1</td>
                            <td>A</td>
                            <td>denice@gmail.com</td>
                            <td><label class="badge badge-success">Enrolled</label></td>
                        </tr>
                        <tr>
                            <td>1000502101</td>
                            <td>Jonnie Bravio</td>
                            <td>Male</td>
                            <td>2</td>
                            <td>A</td>
                            <td>jonnie@gmail.com</td>
                            <td><label class="badge badge-success">Enrolled</label></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>