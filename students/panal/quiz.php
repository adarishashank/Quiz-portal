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
    $get_hash = $_GET['key'];
    date_default_timezone_set('Asia/Kolkata');
    $time = date('H:i:s');
    $date = date('Y-m-d');
    $get_quiz_details = mysqli_query($conn,"select * from quiz_name where hash='$get_hash';");
    $get_quiz_details = mysqli_fetch_assoc($get_quiz_details);
    $quiz_name = $get_quiz_details['quiz_name'];
    $course_name = get_course_name($get_quiz_details['course_name']);
    $quesation_limit = $get_quiz_details['max_quesation'];
    $duration = $get_quiz_details['duration'];
    $status = mysqli_query($conn,"select * from result where id='$regid' and quiz_id='$get_hash';");
    if(mysqli_num_rows($status)==0)
    {
      $selectedTime = strtotime($time);
      $end_time = $selectedTime+(60*$duration);
      $end_time = date("H:i:s", $end_time);
      mysqli_query($conn,"insert into result (id,time,quiz_id,end_time) values('$regid','$time','$get_hash','$end_time');");
    }
    else{
      header("Location: ../login");
    }
  }
}

function get_course_name($a){
  require("../conn.php");
  $get_c = mysqli_query($conn,"select * from courses where id='$a';");
  $get_c = mysqli_fetch_assoc($get_c);
  return $get_c['course_name'];
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
  <style>
                .quesation_box p{
                    padding-top: 50px;
                }
                .quesation_box .options{
                  float: left;
                  width: 100%; 
                  height: 30px;
                }
                .quesation_box .options input{
                  margin: 0px 20px 0px 20px;
                }
                </style>
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
  .quesation_box{
      font-size: 18px;
      font-family: arial;
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
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Quiz</h5>
                <p class="card-category"></p>
                <table style="width: 90%;">
                <tr>
                <td style="padding: 5px;">Course Name : <?php echo $course_name; ?></td>
                <td rowspan="3" style="padding: 5px; text-align: center; font-size: 20px;"><b id="count_time"></b></td>
                </tr>
                <tr>
                <td style="padding: 5px;">Quiz Name : <?php echo $quiz_name; ?></td>
                </tr>
                </table>
                
                <div id="quiz_quesations">
           
              

             <script>
             var min = <?php echo $duration; ?>;var sec = 0;setInterval(function(){
               document.getElementById("count_time").innerHTML = "Remaining Time : "+time_str(min)+":"+time_str(sec);
               if(sec==0){sec = 59;if(min==0){submit();}min--;}sec --;},1000);function time_str(a){if(a<=9){a='0'+a;}return a;}
             </script>
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
                        $get_data = mysqli_query($conn,"select * from quesations where hashkey='$get_hash' ORDER BY RAND() limit $quesation_limit;");
                        $count = 1;
                        while($get_details = mysqli_fetch_assoc($get_data)){
                          $quesation = $get_details['quesation'];
                          $quesation_id = $get_details['id'];
                          $marks = $get_details['quesation_marks'];
                          $option_a = $get_details['a_option'];
                          $option_b = $get_details['b_option'];
                          $option_c = $get_details['c_option'];
                          $option_d = $get_details['d_option'];
                          $type = $get_details['answer_type'];
                          echo '<div class="quesation_box">
                          <div style="width: 100%; height: auto;">
                            <p id="'.$quesation_id.'" style="float: left;">'.$count.' . '.$quesation.'</p>
                            <p style="float: right;">'.$marks.' Marks</p>
                          </div>';
                          if($type=='single'){
                            echo '<div class="options">
                            <input value="A" name="'.$count.'"  type="radio">A . '.$option_a.'</input>
                            <input value="B" name="'.$count.'"  type="radio">B . '.$option_b.'</input>
                            <input value="C" name="'.$count.'"  type="radio">C . '.$option_c.'</input>
                            <input value="D" name="'.$count.'"  type="radio">D . '.$option_d.'</input>
                          </div>
                        </div>';
                          }else{
                            echo '<div class="options">
                            <input value="A" type="checkbox">A . '.$option_a.'</input>
                            <input value="B" type="checkbox">B . '.$option_b.'</input>
                            <input value="C" type="checkbox">C . '.$option_c.'</input>
                            <input value="D" type="checkbox">D . '.$option_d.'</input>
                          </div>
                        </div>';
                          }
                          $count++;
                        }
                      }
                    }
                ?>
               
                
                </div>


              </div>
           <div style="width: 100%; height: 40px; text-align: center; margin: 40px 0px 20px 0px;">
           <button onclick="submit();">Submit</button>
           </div>
            </div>
          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script>
          var main_data = [];
          function submit(){
            var data = document.getElementById("quiz_quesations");
            for (var i=0;i<data.querySelectorAll(".quesation_box").length;i++){
              var temp_d = {};
              var temp = data.querySelectorAll(".quesation_box")[i];
              var quesation = temp.querySelectorAll("div")[0];
              temp_d["quesation"] = quesation.querySelectorAll("p")[0].id;
              var answers = temp.querySelectorAll("div")[1];
              answers = answers.querySelectorAll("input");
                var temp_answers = [];
                for(var j=0;j<answers.length;j++){
                  if(answers[j].checked==true){
                    temp_answers.push(answers[j].value);
                  }
                }
                temp_d['answers'] = temp_answers;
                main_data.push(temp_d);
            }
                $.ajax({
                  url: "submit_quiz.php",
                  type: "post",
                  data: {main_data : main_data, hashkey : "<?php echo $get_hash; ?>"},
                  success: function(d) {
                    d=d.trim();
                    if(d=="Ok"){
                      location.reload();
                    }
                  }
              });
          }
          </script>
         
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
