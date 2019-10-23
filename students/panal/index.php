<?php
require("../conn.php");
$sesion_key = $_COOKIE["student_hash"];
if($sesion_key==''){
  header("Location: ../login");
}else{
  $check_hashkey = mysqli_query($conn,"select * from studets where hashkey='$sesion_key';");
  if(mysqli_num_rows($check_hashkey)!=1){
    header("Location: ../login");
  }
  else{
    $check_hashkey = mysqli_fetch_assoc($check_hashkey);
    $regid = $check_hashkey['id'];
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
                  <a class="dropdown-item" href="../logout.php">Logout</a>
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
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Quiz</h5>
                <p class="card-category"></p>
                <table style="width: 100%; height: auto;">
                <tr>
                <th>Quiz Name</th>
                <th>Subject</th>
                <th>Start date</th>
                <th>Start time</th>
                <th>End date</th>
                <th>End time</th>
                <th>Duration (in minutes)</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                <?php
                date_default_timezone_set('Asia/Kolkata');
                $time = date('H:i:s');
                $date = date('Y-m-d');
                $get_my_courses = mysqli_query($conn,"select * from student_courses where student_id='$regid';");
                while($get_my=mysqli_fetch_assoc($get_my_courses)){
                  $course_id = $get_my['course'];
                  $get_active_data = mysqli_query($conn,"select * from quiz_name  where end_date <= '$date' and end_time>='$time' and end_time>'$time' and course_name='$course_id';");
                while($data=mysqli_fetch_assoc($get_active_data)){
                  $hash = $data['hash'];
                  $quiz_name = $data['quiz_name'];
                  $course_name = get_course_name($data['course_name']);
                  $start_date = $data['start_date'];
                  $start_time = $data['start_time'];
                  $end_date = $data['end_date'];
                  $duration = $data['duration'];
                  $end_time = $data['end_time'];
                  echo '
                  <tr>
                  <td>'.$quiz_name.'</td>
                  <td>'.$course_name.'</td>
                  <td>'.$start_date.'</td>
                  <td>'.$start_time.'</td>
                  <td>'.$end_date.'</td>
                  <td>'.$end_time.'</td>
                  <td>'.$duration.'</td>
                  <td style="color: green;">Open</td>
                  <td><a href="quiz.php?key='.$hash.'">Link</a></td>
                  </tr>
                  ';
                }
                $get_active_data = mysqli_query($conn,"select * from quiz_name  where start_date<='$date' and start_time>'$time' and end_date <='$date' and end_time <='$time'  and course_name='$course_id';");
                while($data=mysqli_fetch_assoc($get_active_data)){
                  $hash = $data['hash'];
                  $quiz_name = $data['quiz_name'];
                  $course_name = get_course_name($data['course_name']);
                  $start_date = $data['start_date'];
                  $start_time = $data['start_time'];
                  $end_date = $data['end_date'];
                  $end_time = $data['end_time'];
                  $duration = $data['duration'];
                  echo '
                  <tr>
                  <td>'.$quiz_name.'</td>
                  <td>'.$course_name.'</td>
                  <td>'.$start_date.'</td>
                  <td>'.$start_time.'</td>
                  <td>'.$end_date.'</td>
                  <td>'.$end_time.'</td>
                  <td>'.$duration.'</td>
                  <td style="color: #ff914d;">Open Soon</td>
                  <td>-</td>
                  </tr>
                  ';
                }
                $get_active_data = mysqli_query($conn,"select * from quiz_name where where end_date <='$date' and end_time >='$time'
                course_name='$course_id';");
                while($data=mysqli_fetch_assoc($get_active_data)){
                  $hash = $data['hash'];
                  $quiz_name = $data['quiz_name'];
                  $course_name = get_course_name($data['course_name']);
                  $start_date = $data['start_date'];
                  $start_time = $data['start_time'];
                  $end_date = $data['end_date'];
                  $end_time = $data['end_time'];
                  $duration = $data['duration'];
                  echo '
                  <tr>
                  <td>'.$quiz_name.'</td>
                  <td>'.$course_name.'</td>
                  <td>'.$start_date.'</td>
                  <td>'.$start_time.'</td>
                  <td>'.$end_date.'</td>
                  <td>'.$end_time.'</td>
                  <td>'.$duration.'</td>
                  <td style="color: red;">Closed</td>
                  <td>-</td>
                  </tr>
                  ';
                }
                }
               
                function get_course_name($a){
                  require("../conn.php");
                  $get_c = mysqli_query($conn,"select * from courses where id='$a';");
                  $get_c = mysqli_fetch_assoc($get_c);
                  return $get_c['course_name'];
                }
                function check_attempt($a){
                  require("../conn.php");
                  $get_c = mysqli_query($conn,"select * from courses where id='$a';");
                  $get_c = mysqli_fetch_assoc($get_c);
                  return $get_c['course_name'];
                }
                ?>
                </table>
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
