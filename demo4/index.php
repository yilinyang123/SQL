
<style>

thead,
tfoot {
    background: linear-gradient(#6600cc, #000066); 
    color: #fff;
}

tbody {
    background-color: #fff;
}

table {
    border-collapse: collapse;
    font-family: inherit;
 
}
 
th,td {
    padding: 5px 30px 5px 30px;
    font-family: inherit;
    
}

td {
    text-align: center;
    border: 1px solid #aaa;
}

th:first-child {
     border-radius: 12px 0 0 0;
}
 
th:last-child {
     border-radius: 0 12px 0 0; 
}
 
tr:last-child td:first-child {
     border-radius: 0 0 0 12px;
}
 
tr:last-child td:last-child {
     border-radius: 0 0 12px 0;
}

tbody tr:hover {
    background: linear-gradient(#fff, #aaa); 
    /*font-size: 17px;*/
}

</style>



<!-- <?php
$profpic = "images/bg-img-01.jpg";
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <div class="deep-purple-wrapper">
        <h1 align="center" style="color:#fff">Looking for a Doctor?</a></h1>
    </div>


    <link rel="stylesheet" href="css/spin.css">
    <script src="css/spin.js"></script>
    <!-- Required meta tags-->
<!--     <style type="text/css">

    body {
    background-image: url('<?php echo $profpic;?>');
        }
    </style> -->
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colrolib Templates">
    <meta name="author" content="Colrolib">
    <meta name="keywords" content="Colrolib Templates">

    <!-- Title Page-->
    <title>Au Form Wizard</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-img-1 p-t-165 p-b-100">
    <p class="vitals-description"><em><strong>Discover Medicare</em></strong> is the largest online database of patient reviews for doctors and facilities. We give you the tools you need to find the best hospital or doctor for you!</p>
        <div class="wrapper wrapper--w720">
            <div class="card card-3">
                <div class="card-body">
                    <ul class="tab-list" id = 'myTab'>
                        <li class="tab-list__item active">
                            <a class="tab-list__link" href="#tab1" data-toggle="tab">Hospitals</a>
                        </li>
                        <li class="tab-list__item">
                            <a class="tab-list__link" href="#tab2" data-toggle="tab">Doctors</a>
                        </li>
                        <li class="tab-list__item">
                            <a class="tab-list__link" href="#tab3" data-toggle="tab">Evaluation</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <form method="POST" action="#">
                                <div class="input-group">
                                    <label class="label">location</label>
                                    <input type="text" name="city" id="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>" placeholder="City name" required="required">
                                    <i class="zmdi zmdi-pin input-group-symbol"></i>
                                </div>
                                <button class="btn-submit btn-submit-h" type="submit" name="submit" >search</button>                             
                                <span class='btn-submit btn-submit-h' align=center><?php include "form.php"; ?></span>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab2">
                            <form method="POST" action="#">                    
                                <div class="row row-space">
                                    <div class="col-2">                              
                                        <div class="input-group">
                                        <label class="label">location</label>
                                        <input type="text" name="city2" id="city2" value="<?php echo isset($_POST['city2']) ? $_POST['city2'] : '' ?>" placeholder="City name" required="required">
                                        <i class="zmdi zmdi-pin input-group-symbol"></i>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group">
                                        <label class="label">condition</label>
                                        <input type="text" name="condition" id="condition" value="<?php echo isset($_POST['condition']) ? $_POST['condition'] : '' ?>" placeholder="e.g. Surgery" required="required">
                                        
                                        </div>
                                    </div>
                                </div>                                                       
                                <button class="btn-submit btn-submit-h" type="submit" name="submit2">search</button>
                                <span class='btn-submit btn-submit-h' align=center><?php include "form2.php"; ?></span>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <form method="POST" action="#">
                                <div class="input-group">
                                    <label class="label">Hospital name</label>
                                    <i class="zmdi zmdi-pin input-group-symbol"></i>
                                    <input type="text" name="hospital_insert" id="hospital_insert" value="<?php echo isset($_POST['hospital_insert']) ? $_POST['hospital_insert'] : '' ?>" placeholder="hospital name" required="required">
                                </div>

                                <div class="input-group">
                                    <label class="label">Measure</label>
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="measure_insert" type="text" id="measure_insert">
                                            <option value="" disabled selected hidden>Please Choose...</option>                  
                                            <option value="CAHPS_GRP_1">Getting timely care, appointments, and information</option>
                                            <option value="CAHPS_GRP_2">How well clinicians communicate</option>
                                            <option value="CAHPS_GRP_3">Patients' rating of clinicians</option>
                                            <option value="CAHPS_GRP_5">Health promotion and education</option>
                                            <option value="CAHPS_GRP_8">Courteous and helpful office staff</option>
                                            <option value="CAHPS_GRP_9">Clinicians working together for your care</option>
                                            <option value="CAHPS_GRP_10">Between visit communication</option>
                                            <option value="CAHPS_GRP_12">Attention to patient medication cost</option>
                                        </select>
                                    <div class="select-dropdown"></div>

                                    </div>
                                </div>

                                <div class="input-group">
                                    <label class="label">Score</label>
                                    <input type="text" name="score_insert" value="<?php echo isset($_POST['score_insert']) ? $_POST['score_insert'] : '' ?>" placeholder="between 0 and 100" required="required">
                                </div>

                                <button class="btn-submit btn-submit-h" type="submit" name="submit3">submit</button>
                                <span class='btn-submit btn-submit-2' type="submit" name="submit3" align=center><?php include "insert.php"; ?></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/jquery-validate/jquery.validate.min.js"></script>
    <script src="vendor/bootstrap-wizard/bootstrap.min.js"></script>
    <script src="vendor/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

    <script>
        if (location.hash) {
            $('a[href=\'' + location.hash + '\']').tab('show');
        }


// if (location.hash) {               // do the test straight away
//         window.scrollTo(0, 0);         // execute it straight away
//         setTimeout(function() {
//             window.scrollTo(0, 0);     // run it a bit later also for browser compatibility
//         }, 1);
//     }
var activeTab = localStorage.getItem('activeTab'); if (location.hash) { $('a[href=\'' + location.hash + '\']').tab('show'); } else if (activeTab) { $('a[href="' + activeTab + '"]').tab('show'); }

$('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
  // e.preventDefault()
  var tab_name = this.getAttribute('href')
  if (history.pushState) {
    history.pushState(null, null, tab_name)
  }
  else {
    location.hash = tab_name
  }
  localStorage.setItem('activeTab', tab_name)

  $(this).tab('show');
  return false;
});
$(window).on('popstate', function () {
    var anchor = location.hash ||
    $('a[data-toggle=\'tab\']').first().attr('href');
  $('a[href=\'' + anchor + '\']').tab('show');
});

// $(document).ready(function(){
//     $('#myTab a:first').tab('show');
// })

    </script>




</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->