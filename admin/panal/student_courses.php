<?php
require("../conn.php");
$sesion_key = $_COOKIE["tech_hash"];
if($sesion_key==''){
  header("Location: ../login");
}else{
  $check_hashkey = mysqli_query($conn,"select * from users where hashkey='$sesion_key';");
  if(mysqli_num_rows($check_hashkey)!=1){
    header("Location: ../login");
  }else{
    if(isset($_POST['add_course'])){
        $student_id = $_POST['student_id'];
        $course_name = $_POST['course_name'];
        $check = mysqli_query($conn,"select * from student_courses where student_id='$student_id' and course='$course_name';");
        if(mysqli_num_rows($check)!=1){
            mysqli_query($conn,"insert into student_courses (student_id,course) values ('$student_id','$course_name')");
        }
        header("Location: ?couadd=1");
    }
    if(isset($_POST['student_course_search'])){
        $student_id = $_POST['student_id_c'];
        header('Location: ?student_id='.$student_id.'');
    }
    if($_GET['delete_course']!=''){
        $delete_course = $_GET['delete_course'];
        $student_id = $_GET['id'];
        mysqli_query($conn,"delete from student_courses where student_id='$student_id' and course='$delete_course';");
        header("Location: ?coudel=1");
    }
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
  <style>
      .table_course_list{
          width: 90%;
          margin: auto;
      }
      .table_course_list tr td{
          padding : 5px;
      }
      
      </style>
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
                  <a class="dropdown-item" href="#">Logout</a>
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
                <h5 class="card-title">Add Course</h5>
              </div>
              <hr/>
              <?php
                if($_GET['couadd']==1){
                    echo '<p style="text-align: center; color: green;">Course Added Sucessfully</p>';
                }
              ?>
              <form action="student_courses.php" enctype="multipart/form-data" method="post">
                <fieldset style="margin: 10px;">
                    <legend style="font-size: 13px;">Student Id</legend>
                    <input name="student_id" type="text"/>
                </fieldset>
                <fieldset style="margin: 10px;">
                    <legend style="font-size: 13px;">Course Name</legend>
                    <select name="course_name" id="course_name">
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
                <div style="width: 100%; height: auto;">
                <button name="add_course" style="margin-bottom: 10px; width: 130px; float: right; cursor: pointer; margin: 20px;">Add Course</button>
    </div>
    </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-title">Student Courses</h5>
                <p class="card-category">Academics courses</p>
              </div>
              <hr/>
              <?php
                if($_GET['coudel']==1){
                    echo '<p style="text-align: center; color: red;">Course Deleted Sucessfully</p>';
                }
              ?>
              <?php
                if($_GET['couupt']==1){
                    echo '<p style="text-align: center; color: green;">Course Updated Sucessfully</p>';
                }
              ?>
                 <div style="width: 100%; height: auto;">
                 <form action="student_courses.php" enctype="multipart/form-data" method="post">
                 <fieldset style="margin: 10px;">
                    <legend style="font-size: 13px;">Student Id</legend>
                    <input name="student_id_c" type="text"/>
                </fieldset>
                <fieldset style="margin: 10px; margin-bottom: 50px;">
                    <button name="student_course_search">Search</button>
                </fieldset>
                </form>
                 <?php
                 if($_GET['student_id']!=''){
                     $id = $_GET['student_id'];
                    echo '
                    <table class="table_course_list">
                    <tr>
                        <th>Id</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th colspan="1">Status</th>
                    </tr>';
                    $get_courses = mysqli_query($conn,"select student_id,id,course_name,course_code from courses inner join student_courses on student_courses.course=courses.id where student_courses.student_id='$id';");
                    while($c=mysqli_fetch_assoc($get_courses))
                    {
                        echo "<tr>";
                        echo "<td>".$c['student_id']."</td>";
                        echo "<td>".$c['course_code']."</td>";
                        echo "<td>".$c['course_name']."</td>";
                        echo "<td style='color: red;'><a href='?delete_course=".$c['course_code']."&id=".$c['student_id']."'>Delete</a></td>";
                        echo "<tr>";
                    }
                    echo "</table>";
                 }
                 ?>
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
