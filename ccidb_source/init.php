<?php

require_once("globalvars.php");

$sql2 = "SELECT * FROM licenses WHERE tablename = :tablename;";

try {
	$host = "127.0.0.1";
	$dsnlicense = "pgsql:host=$host;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_licensing'] . ";";
	$pdolicense = new PDO($dsnlicense, $_SESSION['postgres_username'], $_SESSION['postgres_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
	
	$pdolicense->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt2 = $pdolicense->prepare($sql2);
	
	$stmt2->bindValue(":tablename", $_SESSION['tablename']);
	
	$stmt2->setFetchMode(PDO::FETCH_ASSOC);
	
	$result2 = $stmt2->execute();
	
	if($result2) {
		$record2 = $stmt2->fetch();
		
		setcookie("colorscheme", $record2['colorscheme'], time()+120, "/", "", 0);
        setcookie("currencysymbol", $record2['currencysymbol'], time()+120, "/", "", 0);
        setcookie("timezone", $record2['timezone'], time()+120, "/", "", 0);
        setcookie("font", $record2['font'], time()+120, "/", "", 0);
        setcookie("metalsapi", $record2['metalsapi'], time()+120, "/", "", 0);
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$_SESSION['string'] = "";

if(!empty($_POST)) {
	function echodoc($settingsstring) { 
		require_once("template.php");
		printpagestart("Settings Results");
		print_r($settingsstring);
		printpageend();
		unset($_SESSION["string"]);
		unset($_SESSION["csrf"]);
		die();
	}
	
	function globalvarsinit($colorscheme, $currency, $timezone, $username, $password, $changeunpw, $metalsapi, $font) {
		if($changeunpw == "yes") {
		    $sql2 = "UPDATE licenses SET pass_hash = :passhash, font = :font, colorscheme = :colorscheme, currencysymbol = :currencysymbol, timezone = :timezone, metalsapi = :metalsapi WHERE tablename = :tablename;";
		}
		
		else {
		    $sql2 = "UPDATE licenses SET font = :font, colorscheme = :colorscheme, currencysymbol = :currencysymbol, timezone = :timezone, metalsapi = :metalsapi WHERE tablename = :tablename;";
        }
        
        try {
        	$host = "127.0.0.1";
        	$dsnlicense = "pgsql:host=$host;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_licensing'] . ";";
        	$pdolicense = new PDO($dsnlicense, $_SESSION['postgres_username'], $_SESSION['postgres_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
        	
        	$pdolicense->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        	
        	$stmt2 = $pdolicense->prepare($sql2);
        	
        	if($changeunpw == "yes") {
        	    $stmt2->bindValue(":passhash", password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]));
        	}
        	
        	$stmt2->bindValue(":font", $font);
        	$stmt2->bindValue(":colorscheme", $colorscheme);
        	$stmt2->bindValue(":currencysymbol", $currency);
        	$stmt2->bindValue(":timezone", $timezone);
        	$stmt2->bindValue(":metalsapi", $metalsapi);
        	$stmt2->bindValue(":tablename", $_SESSION['tablename']);
        	
        	$stmt2->setFetchMode(PDO::FETCH_ASSOC);
        	
        	$result2 = $stmt2->execute();
        	
        	if($result2) {
        		$record2 = $stmt2->fetch();
        		
        		if(is_array($record2)) {
        		    $_SESSION['string'] .= "<span>Your settings have been saved successfully.</span>";
					$_SESSION['colorscheme'] = $_POST['colorscheme'];
        		    $_SESSION['font'] = $_POST['font'];
        		}
        		
        		else {
        		    $_SESSION['string'] .= "<span>Failed to save settings!</span>";
        		}
        	}
        	
        	else {
        	    $_SESSION['string'] .= "<span>Failed to save settings!</span>";
        	}
        }
        
        catch(PDOException $e) {
        	echo $e->getMessage();
        	die();
        }
	}
	
	$colorscheme = $_POST["colorscheme"];
	$currency = $_POST["currencysymbol"];
	$font = $_POST["font"];
	$timezone = $_POST["timezone"];
	$metalsapi = $_POST["metalsapi"];
	$username = "";
	
	if(!empty($_POST["password"])) {
		$password = $_POST["password"];
	}
	
	else {
		$password = "";
	}
	
	$changeunpw = $_POST["changeunpw"];
	
	if($filetoinclude === "init.php" && $changeunpw == "yes" && !empty($password) && $_SESSION["csrf"] === $_POST["csrf"]) {
		$_SESSION["mustchangepw"] = true;
		globalvarsinit($colorscheme, $currency, $timezone, $username, $password, $changeunpw, $metalsapi, $font);
		$_SESSION['string'] .= "<br><br><span>You must now log back in for security.</span><br><br><a href=\"login.php\"><button type=\"button\">Return to login</button></a>";
		unset($_SESSION['mustchangepw']);
		echodoc($_SESSION['string']);
	}
	
	elseif($filetoinclude === "init.php" && empty($password) && $_SESSION["csrf"] === $_POST["csrf"]) {
		globalvarsinit($colorscheme, $currency, $timezone, $username, $password, $changeunpw, $metalsapi, $font);
		$_SESSION['string'] .= "<br><br><a href=\"index.php\"><button type=\"button\">Return to top page</button></a>";
		echodoc($_SESSION['string']);
	}
	
	else {
	}
}

else { 
	require_once("template.php");
    printpagestart("Init"); ?>
	<span>This file is not used in the offline version of CCIDB. Instead, please use offlineinit.php if you are trying to initialize the database for the first time, and settings.php to change your settings.</span>
<?php 
    printpageend();
}?>