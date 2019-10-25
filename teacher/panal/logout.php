<?php
setcookie("tech_hash_", "", time() + (86400 * 30), "/");
header("Location: ../login");
?>