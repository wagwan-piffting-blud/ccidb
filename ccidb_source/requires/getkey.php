<?php

function printpagestart($title) { ?><!DOCTYPE html>
<html lang="en" id="htmltag" class="dark">
	<head>
		<meta name="robots" content="noindex, nofollow">
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/ccidb.php">
		<title><?php print_r($title); ?></title>
	</head>
	<body>
		<div class="wrapper">
			<div class="main" id="main"><?php }
			
function printpagestartnew($title) { ?><!DOCTYPE html>
<html lang="en" id="htmltag" class="dark">
	<head>
		<meta name="robots" content="noindex, nofollow">
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/ccidb.php">
		<title><?php print_r($title); ?></title>
	</head>
	<body>
		<div class="divs">
<?php }

function printpageend() { ?>
			</div>
		</div>
	</body>
</html>
<?php }

function printpageendnew() { ?>
		</div>
	</body>
</html>
<?php }

if(!empty($_POST) && $_SESSION['csrf'] == $_POST['csrf']) {
    $_SESSION["actkey"] = $_POST['actkey'];
    
    $_SESSION["attempts"] += 1;
    
    $sql1 = "SELECT * FROM licenses WHERE act_key = :act_key;";
		
    try {
    	$host = "127.0.0.1";
    	$dsnlicense = "pgsql:host=$host;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_licensing'] . ";";
    	$pdolicense = new PDO($dsnlicense, $_SESSION['postgres_username'], $_SESSION['postgres_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
    	
    	$pdolicense->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    	
    	$stmt = $pdolicense->prepare($sql1);
    	
    	$stmt->bindValue(":act_key", $_SESSION["actkey"]);
    	
    	$stmt->setFetchMode(PDO::FETCH_ASSOC);
    	
    	$result = $stmt->execute();
    	
    	if($result) {
    		$record = $stmt->fetch();
    		
    		if(!empty($record)) {
        		$currdate = new DateTime(date("Y-m-d"));
        		$date = new DateTime($record['issue_date']);
                $date2 = new DateTime($record['valid_until']);
                
                if($currdate < $date2) {
        		    header("Location: index.php");
        		}
        		
        		elseif($_SESSION["attempts"] < 3) {
            		 printpagestart("Activation Key"); ?>
                    <span>It looks like your key is no longer valid. Please contact the developer for more information.</span>
                	<br>
                	<br>
                	<form name="form" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
                		<button type="submit">Okay</button>
                	</form>
                <?php 
        		    unset($_POST);
        		    unset($_SESSION["actkey"]);
        		}
        		
        		else {
        		    printpagestart("Locked Out"); ?>
                    <span>You have entered too many incorrect activation keys. Please wait 1 hour, then try again.</span>
                	<br>
                	<br>
                	<form name="form" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
                		<button type="submit">Okay</button>
                	</form>
                <?php 
        		    unset($_POST);
        		    unset($_SESSION["actkey"]);
        		}
    		}
    		
    		else {
    		    if($_SESSION["attempts"] < 3) {
            	    printpagestart("Activation Key"); ?>
                    <span>That was not a valid key. Try again.</span>
                	<br>
                	<br>
                	<form name="form" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
                		<button type="submit">Okay</button>
                	</form>
                <?php 
        		    unset($_POST);
        		    unset($_SESSION["actkey"]);
        		}
        		
        		else {
        		    printpagestart("Locked Out"); ?>
                    <span>You have entered too many incorrect activation keys. Please wait 1 hour, then try again.</span>
                	<br>
                	<br>
                	<form name="form" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
                		<button type="submit">Okay</button>
                	</form>
                <?php 
        		    unset($_POST);
        		    unset($_SESSION["actkey"]);
        		}
    		}
    	}
    }
    
    catch(PDOException $e) {
    	echo $e->getMessage();
    	die();
    }
}

else {
    if(!isset($_SESSION["attempts"])) {
        require_once("session_start.php");
        $_SESSION["attempts"] = 0;
    }
    
    if($_SESSION["attempts"] < 3) {
        $_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));
    }
    
    else {
        $_SESSION['csrf'] = ":)";
        if(!isset($_COOKIE["expires"])) {
        	$time = time() + 3600;
        	setcookie("PHPSESSID", session_id(), $time, "/", "", true, true);
        	setcookie("expires", date("U", $time), date(DATE_COOKIE, $time), "/", "", false, false);
        	$_COOKIE["expires"] = date("U", $time);
        }
        $_SESSION['locked'] = true;
    }
    
	$sql1 = "SELECT * FROM licenses;";
		
        try {
        	$host = "127.0.0.1";
        	$dsnlicense = "pgsql:host=$host;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_licensing'] . ";";
        	$pdolicense = new PDO($dsnlicense, $_SESSION['postgres_username'], $_SESSION['postgres_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
        	
        	$pdolicense->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        	
        	$stmt = $pdolicense->prepare($sql1);
        	
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
        	
        	$result = $stmt->execute();
        	
        	if($result) {
        		$record = $stmt->fetch();
        	    $actkey = $record['act_key'];
        	}
        }
        
        catch(PDOException $e) {
        	echo $e->getMessage();
        	die();
        }
	
    printpagestart("Activation Key"); ?>
    <span id="message">Please click the button below to begin using CCIDB:</span>
	<br>
	<br>
    <form id="login" name="login" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
		<input type="hidden" id="csrf" name="csrf" value="<?php print_r($_SESSION['csrf']); ?>" required>
		<input type="hidden" id="actkey" name="actkey" value="<?php print_r($actkey); ?>" autocomplete="off" autofocus="autofocus" pattern="CCIDB-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}" maxlength="35" required readonly>
		<button type="submit">Proceed</button>
	</form>
	<script type="text/javascript" src="/relativetime.js"></script>
	<script type="text/javascript" src="/login.js"></script>
<?php } 
    printpageend();?>