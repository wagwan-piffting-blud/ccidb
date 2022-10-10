<?php 

//Version number using semantic versioning system. https://semver.org/
$version = "1.0.0";

$sessionstartfile = "requires/session_start.php";
$dbfile = "requires/database.php";
$authfile = "requires/auth.php";

require_once($sessionstartfile);

$sourcefile = debug_backtrace();

if(isset($sourcefile[1])) {
	$filetoinclude = preg_replace("/(.*\\\\)(.*\.php)/", "$2", $sourcefile[1]["file"]);
	$filetoinclude = preg_replace("/(.*\/)(.*\.php)/", "$2", $filetoinclude);
	$filetoinclude = preg_replace("/(.*\.php)\?returnto\=.*/", "$1", $filetoinclude);
}

else {
	$filetoinclude = preg_replace("/(.*\\\\)(.*\.php)/", "$2", $sourcefile[0]["file"]);
	$filetoinclude = preg_replace("/(.*\/)(.*\.php)/", "$2", $filetoinclude);
	$filetoinclude = preg_replace("/(.*\.php)\?returnto\=.*/", "$1", $filetoinclude);
}

if(isset($_SESSION['mustchangepw']) && $_SESSION['mustchangepw'] === true && $filetoinclude !== "offlineinit.php") { 
    header("Location: offlineinit.php");
}

if(!isset($pdo)) {
	require_once($dbfile);
}

if(isset($pdo) && $pdo !== "notadatabase") {
	require_once($authfile);
} 

?>