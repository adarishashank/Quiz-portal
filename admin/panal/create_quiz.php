<?php
require("../conn.php");
$sesion_key = $_COOKIE["tech_hash"];
if($sesion_key==''){
  header("Location: ../login");
}else{
  $check_hashkey = mysqli_query($conn,"select * from users where hashkey='$sesion_key';");
  if(mysqli_num_rows($check_hashkey)!=1){
    header("Location: ../login");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  Dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Creative Tim
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <?php
      include('nav.php');
      ?>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="#pablo">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </li>
             
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">

  <canvas id="bigDashboardChart"></canvas>


</div> -->
      <div class="content">
     
        <div class="row">
          <div class="col-md-12">
            <div class="card card-chart">
              <div class="card-header">
                <?php
                  if($_GET['sucess']==1){
                    echo '<h5 class="card-title">Create New Quiz</h5>';
                  }
                ?>
              </div>
              <p style="text-align: center; color: green;">Quiz Created sucessfully</p>
              <div style="width: 100%; height: auto; margin-top: 20px;">
              <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
                    <legend style="font-size: 13px;">Quiz Name</legend>
                    <input name="quiz_name" id="quiz_name" type="text"/>
                </fieldset>
                <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
                    <legend style="font-size: 13px;">Course</legend>
                    <select id="course_name">
                      <?php
                      $course_details = mysqli_query($conn,"select * from courses;");
                      while($c=mysqli_fetch_assoc($course_details)){
                        $id = $c['id'];
                        $course_name = $c['course_name'];
                        echo "<option value='".$id."'>".$course_name."</option>";
                      }
                      ?>
                    </select>
                </fieldset>
</div>
<div style="width: 100%; height: auto; margin-top: 5px;">
              <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
                    <legend style="font-size: 13px;">Start Date</legend>
                    <input name="start_date" id="start_date" type="date"/>
                </fieldset>
                <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
                    <legend style="font-size: 13px;">Start Time</legend>
                    <input name="start_time" id="start_time" type="time"/>
                </fieldset>
</div>
<div style="width: 100%; height: auto; margin-top: 5px;">
              <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
                    <legend style="font-size: 13px;">End Date</legend>
                    <input name="end_date" id="end_date" type="date"/>
                </fieldset>
                <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
                    <legend style="font-size: 13px;">End Time</legend>
                    <input name="end_time" id="end_time" type="time"/>
                </fieldset>
</div>
<div style="width: 100%; height: auto; margin-top: 5px;">
              <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
                    <legend style="font-size: 13px;">Max Quesations</legend>
                    <input name="max_quesation" id="max_quesation" placeholder="Ex : 20" type="int"/>
                </fieldset>
                <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
                    <legend style="font-size: 13px;">Quiz Duration (in minutes)</legend>
                    <input name="quiz_duration" id="quiz_duration" placeholder="40" type="int"/>
                </fieldset>
</div>
<div style="width: 100%; height: auto;">
<button style="float: right; margin: 30px;" onclick="save()">Submit</button>
<button style="float: right; margin: 30px;" onclick="add_quesation()">Add Quesation</button>
</div>
</div>

<div id="quesation_list">

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  var i = 0;
  function add_quesation(){
     var temp = document.getElementById("quesation_dup");
     temp.querySelectorAll("#quesation_count")[0].innerHTML="# "+i;
     var quesation_list = document.getElementById("quesation_list");
     var clone = temp.cloneNode(true);
     clone.id = "quesation_dup"+i;
     clone.style.display="block";
     quesation_list.append(clone)
     i++;
  }
  function save(){
     var quesation = document.getElementById("quesation_list").querySelectorAll(".quesation_dup").length;
     var quesations_list = []
     var quiz_data = {}
     for(i=0;i<quesation;i++){
      var temp = document.getElementById("quesation_list").querySelector("#quesation_dup"+i);
        var def = {}
        def['quesation'] = temp.querySelector("#quesation").value;
        def['a_option'] = temp.querySelector("#a_option").value;
        def['b_option'] = temp.querySelector("#b_option").value;
        def['c_option'] = temp.querySelector("#c_option").value;
        def['d_option'] = temp.querySelector("#d_option").value;
        def['quesation_marks'] = temp.querySelector("#quesation_marks").value;
        def['quesation_answer'] = temp.querySelector("#quesation_answer").value;
        def['answer_type'] = temp.querySelector("#answer_type").value;
        quesations_list.push(def)
     }
     quiz_data["quiz_name"] = document.getElementById("quiz_name").value;
     quiz_data["course_name"] = document.getElementById("course_name").value;
     quiz_data["start_time"] = document.getElementById("start_time").value;
     quiz_data["start_date"] = document.getElementById("start_date").value;
     quiz_data["end_date"] = document.getElementById("end_date").value;
     quiz_data["end_time"] = document.getElementById("end_time").value;
     quiz_data["duration"] = document.getElementById("quiz_duration").value;
     quiz_data["max_quesation"] = document.getElementById("max_quesation").value;
     $.ajax({
              url: "post_quesation.php",
              type: "post",
              data: {quiz_data : quiz_data, quesations_list : quesations_list},
              success: function(d) {
                var url = window.location.href+"?sucess=1";
                window.location.replace(url);
              }
          });
  }
  </script>

<div style="display: none;" id="quesation_dup" class="quesation_dup">
<div class="row">
<div class="col-md-12">
  <div class="card card-chart">
    <div style="width: 100%; height: auto; margin-top: 20px;">
    <h5 style="margin-left: 30px;" id="quesation_count" class="card-title"></h5>
    <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
        <legend style="font-size: 13px;">Quesation</legend>
        <input  id="quesation" name="quesation" type="text"/>
    </fieldset>     
    </div>

    <div style="width: 100%; height: auto; margin-top: 20px;">
        <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
          <legend style="font-size: 13px;">A Option</legend>
          <input name="a_option" id="a_option" type="text"/>
        </fieldset>
        
        <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
          <legend style="font-size: 13px;">B Option</legend>
          <input name="b_option" id="b_option" type="text"/>
        </fieldset>

        <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
          <legend style="font-size: 13px;">C Option</legend>
          <input name="c_option" id="c_option" type="text"/>
        </fieldset>

        <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
          <legend style="font-size: 13px;">D Option</legend>
          <input name="d_option" id="d_option" type="text"/>
        </fieldset>
    </div>

    <div style="width: 100%; height: auto; margin-top: 20px;">
        <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
        <legend style="font-size: 13px;">Marks</legend>
        <input name="quesation_marks" id="quesation_marks" type="text"/>
        </fieldset>

        <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
        <legend style="font-size: 13px;">Answer</legend>
        <input name="quesation_answer" id="quesation_answer" placeholder="Ex: B,c" type="text"/>
        </fieldset>    

        <fieldset style="margin: 10px; float: left; margin-left: 20px; margin-right: 40px;">
        <legend style="font-size: 13px;">Answer Type</legend>
        <select id="answer_type">
        <option value="single">Single</option>
        <option value="multi">Multi</option>
        </select>
        </fieldset> 
    </div>
    <div style="width: 100%; height: 30px;">
</div>
  </div>
</div>
</div>
</div>


      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>


</body>

</html>
