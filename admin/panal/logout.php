<?php
setcookie("tech_hash", "", time() + (86400 * 30), "/");
header("Location: ../login");
?>