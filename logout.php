<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
setcookie('username', '', time() - 3600);
setcookie('pass', '', time() - 3600);
header("Location: login.php");
exit;
?>
