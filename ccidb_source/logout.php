<?php

require_once("globalvars.php");

//session_start();
session_destroy();
setcookie("PHPSESSID", "", time() - 3600);
setcookie("loggedout", "loggedout", time() + 30);
header("Location: login.php");

?>