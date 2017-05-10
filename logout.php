<?php
session_start();

unset($_SESSION["login"]);
unset($_SESSION["name"]);
unset($_SESSION["type"]);
unset($_SESSION["email"]);
header("Location: index.php");
exit();
?>
