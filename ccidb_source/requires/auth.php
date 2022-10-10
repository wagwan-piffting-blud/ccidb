<?php

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

if(str_replace('\\', '/', __FILE__) == $_SERVER['SCRIPT_FILENAME']) {
	header("Location: index.php");
}

if(!isset($_SESSION)) {
	require_once("session_start.php");
}

if(1 == 1) {
	if(!isset($username)) {
		if(!isset($_SESSION['actkey'])) {
		    require_once("getkey.php");
		    die();
		}
		
		$sql1 = "SELECT * FROM licenses WHERE act_key = :act_key;";
		
        try {
        	$host = "127.0.0.1";
        	$dsnlicense = "pgsql:host=$host;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_licensing'] . ";";
        	$pdolicense = new PDO($dsnlicense, $_SESSION['postgres_username'], $_SESSION['postgres_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
        	
        	$pdolicense->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        	
        	$stmt = $pdolicense->prepare($sql1);
        	
        	$stmt->bindValue(":act_key", $_SESSION['actkey']);
        	
        	$stmt->setFetchMode(PDO::FETCH_ASSOC);
        	
        	$result = $stmt->execute();
        	
        	if($result) {
        		$record = $stmt->fetch();
				
        	    if(isset($record['user_hash'])) {
					$username = $record['user_hash'];
					$password = $record['pass_hash'];
					$_SESSION["font"] = $record['font'];
					$_SESSION["colorscheme"] = $record['colorscheme'];
					$_SESSION["currencysymbol"] = $record['currencysymbol'];
					$_SESSION["timezone"] = $record['timezone'];
					$_SESSION["metalsapi"] = $record['metalsapi'];
					$_SESSION["tablename"] = $record['tablename'];
				}
        	}
        }
        
        catch(PDOException $e) {
        	echo $e->getMessage();
        	die();
        }
	}
	
	if(isset($_SESSION["authtoken"]) && $_SESSION["authtoken"] === hash("sha512", $username . $password) && $filetoinclude !== "login.php") {
		
	}
	
	elseif(isset($_SESSION["authtoken"]) && $_SESSION["authtoken"] !== hash("sha512", $username . $password)) {
		if($filetoinclude !== "login.php") {
			if(isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME'])) {
				$filename = preg_replace("/^.*\/(.*\.php)/", "$1", $_SERVER['SCRIPT_FILENAME']);
				$return = "?returnto=" . $filename;
			}
			
			if(isset($return) && !empty($return)) {
				header("Location: login.php" . $return);
			}
			
			else {
				header("Location: login.php");
			}
		}
		
		else {
		}
	}
	
	elseif(!isset($_SESSION["authtoken"])) {
		if($filetoinclude !== "login.php") {
			if(isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME'])) {
				$filename = preg_replace("/^.*\/(.*\.php)/", "$1", $_SERVER['SCRIPT_FILENAME']);
				$return = "?returnto=" . $filename;
			}
			
			if(isset($return) && !empty($return)) {
				header("Location: login.php" . $return);
			}
			
			else {
				header("Location: login.php");
			}
		}
		
		else {
		}
	}
}