<?php //Template Name: Evaluate New Students or Transferees?>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <?php 
        acf_form_head();
        get_header(); 

        $title = "Evaluate New Students or Transferees"
    ?>
    <title><?=$title?></title>

    <style>
        .form-control{
            background-color:#F5F5F5;
            border: 0;
        }
        .form-select{
            background-color:#F5F5F5;
            border: 0;
        }
        body{
            background-color:#F5F5F5;
        }
        .table thead th {
            background-color: #F3F9FD !important;
            font-size: 13px;
            color: #000 !important;
        }
        td{
            text-align:center;
            background-color: #F3F9FD !important;
        }
        
    </style>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12"><h6 class="text-uppercase mb-3 fw-bold">Recommendation Units</h5></div>
            <div class="col-lg-6 col-md-12">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label>Application No</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Entollment No</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Student Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Course</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Curriculum</label>
                        <input type="date" class="form-control">
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-md-12">
                <form class="row g-3">
                    <div class="col-md-12">
                        <label>Year Level</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Student Type</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="1">New</option>
                            <option value="2">Old</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>School Year</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-info w-100">Other Subjects</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 com-md-12">
                <img src="https://cdn-icons-png.flaticon.com/512/2784/2784403.png" class="img-thumbnail" style="height:35vh">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-12 col-md-12">
                <h5 class="card-header bg-white border-0"><?=$title?></h5>
                <table class="table">
                    <thead>
                        <tr>
                            <?php
                                $titleHead = array(
                                    "System", 
                                    "Recommended", 
                                    "Subject Name", 
                                    "Pre-Requisite",
                                    "Subject Description",
                                    "Cr Units", 
                                    "Grade", 
                                    "Taken"
                                );
                                foreach ($titleHead as $value) {
                                    echo "<th scope='col' class='text-center'>$value</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                            $data['items'] = array(
                                array(
                                    'system' => '1st Year-First Semester', 
                                    'recommended' => "<input type='checkbox'>", 
                                    'subjectName' => "Math 1", 
                                    'preRequisite' => "", 
                                    'subjectDescription' => "Calculation", 
                                    'crUnits'=> "", 
                                    'grade' => "78.5", 
                                    'taken' =>"<input type='checkbox'>"
                                ),array(
                                    'system' => "1st Year-First Semester", 
                                    'recommended' => "<input type='checkbox'>", 
                                    'subjectName' => "PE 1", 
                                    'preRequisite' => "", 
                                    'subjectDescription' => "Calculation", 
                                    'crUnits'=> "", 
                                    'grade' => "78.5", 
                                    'taken' =>"<input type='checkbox'>"),
                                );

                            foreach ($data['items'] as $rows) :?>
                                <tr>
                                    <td> <?=$rows['system']; ?></td>
                                    <td> <?=$rows['recommended']; ?></td>
                                    <td> <?=$rows['subjectName']; ?></td>
                                    <td> <?=$rows['preRequisite']; ?></td>
                                    <td> <?=$rows['subjectDescription']; ?></td>
                                    <td> <?=$rows['crUnits']; ?></td>
                                    <td> <?=$rows['grade']; ?></td>
                                    <td> <?=$rows['taken']; ?></td>
                                </tr>
                            <?php endforeach;?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Table row section -->
        <div class="row">
            <div class="col-lg-12 col-md-12 bg-white">
                <div class="row">
                    <div class="col-lg-3">
                        <?php
                            $recommendationUnits = array(
                                "System" =>'<input type="number" class="form-control" placeholder="0.0" class="mb-2">',
                                "Evaluation" => '<input type="number" class="form-control" placeholder="0">'
                            );
                            
                            foreach($recommendationUnits as $key => $value){
                                echo 
                                    "<div class='d-flex flex-row'>
                                        <div class='p-2'>$key</div>
                                        <div class='p-2'>$value</div>
                                    </div>";
                            }
                        ?>

                        <div class="pt-3">
                            <fieldset class="border-0">
                                <input class="recommended-block" type="checkbox" name="recommended-block" value="1" />
                                <label for="recommended-block">Recommended Block</label>
                            </fieldset>

                            <fieldset class="btnChecked">
                                <label>Block</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">New</option>
                                    <option value="2">Old</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <h6 class="text-uppercase mb-3">Recommendation Units</h5>
                        <?php
                            $recommendationUnits = array(
                                "ACDEMIC ADVISING",
                                "ADMISSION TO COLLEGE",
                                "PHOTOGRAPH",
                                "REGISTRATION",
                                "STUDENT INFORMATION-ENTRY"
                            );
                            
                            foreach($recommendationUnits as $value){
                                echo $value . "<br>";
                            }
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <h6 class="text-uppercase mb-3">Recommendation Units</h5>
                        
                        <input type="text" class="form-control w-100" placeholder="New">
                        <div class="pt-3">
                            <textarea type="text" class="form-control w-100" row="8"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-between mt-5">
                        
                            <input type="checkbox" class="" placeholder="New"> NSTP Complete
                            <input type="checkbox" class="" placeholder="New"> NSTP Exempted
                        </div>
                        <div class="pt-3">
                            <textarea type="text" class="form-control w-100" row="8"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="p-2"><button type="button" class="btn btn-info text-white">Done</button></div>
                    <div class="p-2"><button type="button" class="btn btn-danger text-white">Cancel</button></div>
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        $(".btnChecked").hide();
        $(".recommended-block").click(function() {
            if($(this).is(":checked")) {
                $(".btnChecked").show();
            } else {
                $(".btnChecked").hide();
            }
        });
    </script>