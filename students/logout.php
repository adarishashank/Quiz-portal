<?php
$sesion_key = $_COOKIE["student_hash"];
setcookie("student_hash","", time() + (86400 * 30), "/");
header("Location: login/");
?>