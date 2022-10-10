<?php

require_once("globalvars.php");

if(empty($_SESSION)) {
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	$_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));
	$_SESSION['error'] = "";
	$_SESSION['fail'] = 0;
	$_SESSION['locked'] = false;
	$_SESSION['unlockerror'] = "";
}

elseif(empty($_SESSION['csrf'])) {
	$_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));
	$_SESSION['error'] = "";
	$_SESSION['fail'] = 0;
	$_SESSION['locked'] = false;
	$_SESSION['unlockerror'] = "";
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
}

elseif(empty($_SESSION["locked"])) {
	$_SESSION['error'] = "";
	$_SESSION['fail'] = 0;
	$_SESSION['locked'] = false;
	$_SESSION['unlockerror'] = "";
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
}

else {
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
}

function printdoc() { 
	if(isset($_SESSION["authtoken"])) {
		unset($_SESSION["authtoken"]);
	}
	require_once("template.php");
	printpagestart("Login Portal");?>
				<span id="message">Please log in.</span>
				<form name="login" id="login" class="displaynonenotimportant" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
					<input type="hidden" id="csrf" name="csrf" value="<?php if(isset($_SESSION['locked']) && $_SESSION['locked'] === false) { print_r($_SESSION['csrf']); } elseif(isset($_SESSION['locked']) && $_SESSION['locked'] === true) { print_r(":)"); }?>" autocomplete="off" required<?php if(isset($_SESSION['locked']) && $_SESSION['locked'] === true) { print_r(" disabled"); } ?>>
					<label for="username">Username:</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="username" name="username" value="" autocomplete="off" autofocus="autofocus" required<?php if(isset($_SESSION['locked']) && $_SESSION['locked'] === true) { print_r(" disabled"); } ?>>
					<br>
					<label for="password">Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" id="password" name="password" value="" autocomplete="off" required<?php if(isset($_SESSION['locked']) && $_SESSION['locked'] === true) { print_r(" disabled"); } ?>>
					<br>
					<label for="rememberme">Remember me:</label>&nbsp;<input type="checkbox" id="rememberme" name="rememberme" value="rememberme"<?php if(isset($_SESSION['locked']) && $_SESSION['locked'] === true) { print_r(" disabled"); } ?>>
					<br>
					<input type="hidden" id="returnto" name="returnto" value="<?php if(isset($_GET['returnto']) && !empty($_GET['returnto'])) { print_r($_GET['returnto']); } ?>"<?php if(isset($_SESSION['locked']) && $_SESSION['locked'] === true) { print_r(" disabled"); } ?>>
					<?php if(!empty($_SESSION['error'])) { print_r("<br><span class=\"error\">" . $_SESSION['error'] . "</span>\n\t\t\t\t\t<br>"); } ?>
<button type="submit"<?php if(isset($_SESSION['locked']) && $_SESSION['locked'] === true) { print_r(" disabled"); } ?>>Log In</button>
				</form>
				<script type="text/javascript" src="relativetime.js"></script>
				<script type="text/javascript" src="login.js"></script>
<?php printpageend();
}

if(!empty($_POST)) {
	if(!isset($time)) {
		$time = time() + 3600;
	}
	if(isset($_SESSION['csrf']) && $_POST['csrf'] === $_SESSION['csrf'] && isset($_POST['username']) && isset($_POST['password'])) {
		if(password_verify($_POST['username'], $_SESSION['username']) && password_verify($_POST['password'], $_SESSION['password']) && $_SESSION['locked'] === false) {
			$_SESSION['authtoken'] = hash("sha512", $username . $password);
			
			if(isset($_POST["rememberme"])) {
				setcookie("PHPSESSID", session_id(), time() + 604800, "/", "", true, true);
			}
			
			else {
				setcookie("PHPSESSID", session_id(), time() + 86400, "/", "", true, true);
			}
			
			if(isset($_POST['returnto']) && !empty($_POST['returnto'])) {
				$returnpath = $_POST['returnto'];
				
				//The following regex is heavily based on https://stackoverflow.com/a/67489270 with slight modification.
				if(!preg_match_all("/^(?:https?:\/\/)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.(?!php\b)[a-z]{2,6}\b[-a-zA-Z0-9@:%_+.~#?&\/=]*$/", $returnpath)) {
					$returnpath = preg_replace("/^.*\/(.*\.php)/", "$1", $returnpath);
				}
				
				else {
					$returnpath = "index.php";
				}
				
				header("Location: " . $returnpath);
			}
			
			else {
				header("Location: index.php");
			}
		
			unset($_SESSION['username']);
			unset($_SESSION['password']);
			unset($_SESSION['csrf']);
			unset($_SESSION['error']);
			unset($_SESSION['fail']);
			unset($_SESSION['locked']);
			unset($_SESSION['unlockerror']);
		}
		
		else {
			if(isset($_SESSION['attempts'])) {
				$_SESSION['fail'] = $_SESSION['attempts']++;
			} 
			
			else {
				$_SESSION['attempts'] = 1;
			}
			
			if($_SESSION['fail'] > 2) {
				date_default_timezone_set($_SESSION['timezone']);
				if(!isset($_COOKIE["expires"])) {
					setcookie("PHPSESSID", session_id(), $time, "/", "", true, true);
					setcookie("expires", date("U", $time), $time, "/", "", false, false);
					$_COOKIE["expires"] = date("U", $time);
				}
				$_SESSION['error'] = "You have been locked out due to too many incorrect login attempts. Please try again <time datetime=\"" . date(DATE_ATOM, $_COOKIE["expires"]) . "\"></time>";
				$_SESSION['locked'] = true;
				printdoc();
			}
			
			else {
				$_SESSION['error'] = "Your credentials were incorrect. Please try again.";
				$_SESSION['locked'] = false;
				printdoc();
			}
		}
	}
	
	else {
		printdoc();
	}
}

else { printdoc(); } ?>