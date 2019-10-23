<?php
require("../conn.php");
$sesion_key = $_COOKIE["student_hash"];
$check_hashkey = mysqli_query($conn,"select * from studets where hashkey='$sesion_key';");
  if(mysqli_num_rows($check_hashkey)==1){
    header("Location: ../panal");
  }


if(isset($_POST['login'])){
    $email = $_POST['email'];
	$password =$_POST['pass'];
    $check=mysqli_query($conn,"select * from studets where id='$email' and password='$password';");
    if(mysqli_num_rows($check)==1){
        $hash = md5(uniqid(rand(), true));
        setcookie("student_hash", $hash, time() + (86400 * 30), "/");
        mysqli_query($conn,"update studets set hashkey='$hash' where id='$email';");
        header("Location: ../panal");
    }else{
        echo "Error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Student Portal</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>
                <?php
                if($_GET['sucreeg']=='1'){
                    echo '<p style="text-align: center; margin-top: 20px; color: green;">Registered Sucessfully</p>';
                }
                ?>
				<form class="login100-form validate-form" action="index.php" enctype="multipart/form-data" method="post">
					<div class="wrap-input100" data-validate="Username is required">
						<span class="label-input100">Reg Id</span>
						<input class="input100" type="text" name="email" placeholder="Enter Registered Id">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
                        <label class="label" style="color: #999999; font-size: 15px;">
								<a href="../registration">Register</a>
							</label>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button name="login" class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>