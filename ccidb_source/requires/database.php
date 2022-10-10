<?php

$_SESSION['postgres_username'] = 	  'YOUR_USERNAME_HERE';
$_SESSION['postgres_password'] = 	  'YOUR_PASSWORD_HERE';
$_SESSION['pgsql_start_password'] =   'YOUR_PGSQL_PASS_HERE';

//DO NOT TOUCH ANYTHING BELOW THIS LINE UNLESS YOU KNOW WHAT YOU ARE DOING!!!
$host =                               '127.0.0.1';
$_SESSION['pgsql_port'] = 			  '5432';
$_SESSION['pgsql_data'] = 			  'ccidb_data';
$_SESSION['pgsql_licensing'] = 		  'ccidb_licensing';
try {
	$dsn = "pgsql:host=$host;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_data'] . ";";
	$pdo = new PDO($dsn, $_SESSION['postgres_username'], $_SESSION['postgres_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);

	if($pdo) {
	}
	
	else {
		$pdo = "notadatabase";
	}
}

catch(PDOException $e) {
	$pdo = "notadatabase";
}

$sourcefile = debug_backtrace();
$filetoinclude = preg_replace("/(.*\\\\)(.*\.php)/", "$2", $sourcefile[1]["file"]);
$filetoinclude = preg_replace("/(.*\/)(.*\.php)/", "$2", $filetoinclude);

if($pdo === "notadatabase" && $filetoinclude !== "offlineinit.php") {
	die("<!DOCTYPE html><html class=\"dark\" lang=\"en\"><head><meta name=\"robots\" content=\"noindex, nofollow\"><meta charset=\"utf-8\"/><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"><title>Database error!</title><link rel=\"stylesheet\" href=\"css/ccidb.php\"></head><body><div class=\"wrapper\"><div class=\"main\"><span class=\"bad\">The database could not be opened!</span><br><br><span>If this is your first time using CCIDB, you may visit the <a href=\"offlineinit.php\">initializer</a>.</span></div></div></body></html>");
} ?>