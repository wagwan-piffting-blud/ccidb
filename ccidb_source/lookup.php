<?php
require_once("globalvars.php");
require_once('validate.php');

if(isset($_POST['inputid']) || isset($_COOKIE['barcode'])) {
	if(isset($_COOKIE['barcode'])) {
		$_SESSION["requestedid"] = $_COOKIE['barcode'];
	}
	
	else {
		$_SESSION["requestedid"] = $_POST['inputid'];
	}

	$string = "";
	$concat = "";
	$run = 0;
	
	if(is_numeric($_SESSION["requestedid"])){
		validate($_SESSION["requestedid"]);
	}
	
	else {
		header("Location: index.php");
	}
}

else {
	header("Location: index.php");
} ?>