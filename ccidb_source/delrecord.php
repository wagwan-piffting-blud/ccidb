<?php

require_once("globalvars.php");

//If either post or a cookie are set, get the barcode and store it in a session variable.
if((isset($_POST["submit"]) && isset($_POST["barcode"]) && is_numeric($_POST["barcode"])) || (isset($_COOKIE['barcode']) && is_numeric($_COOKIE['barcode']))) {
	//Set from post.
	if(isset($_POST["barcode"])) {
		$_SESSION['barcode'] = str_pad($_POST["barcode"], 12, "0", STR_PAD_LEFT);
	}
	
	//Set from cookie.
	elseif(isset($_COOKIE['barcode'])) {
		$_SESSION['barcode'] = str_pad($_COOKIE['barcode'], 12, "0", STR_PAD_LEFT);
		setcookie("barcode", "", time() - 3600, "/");
		$_COOKIE['barcode'] = "";
	}
	
	$_SESSION["imgs"] = array();
	
	$sql1 = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
	
	try {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$stmt = $pdo->prepare($sql1);
		
		$stmt->bindValue(":barcode", $_SESSION["barcode"]);
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$result = $stmt->execute();
		
		if($result) {
			$_SESSION["stmtresult"] = $stmt->fetch();
			if($_SESSION["stmtresult"]["description"]) {
				header("Location: delrecordconfirm.php");
			}
			
			else {
				$_SESSION['string'] = "No active record found for this barcode!";
				header("Location: delrecordconfirm.php");
			}
		}
		
		else {
			$_SESSION['string'] = "Database error!";
			header("Location: delrecordconfirm.php");
		}
	}

	catch(PDOException $e) {
		echo $e->getMessage();
		die();
	}
}

else { 
	require_once("template.php");
	printpagestart("Record Deletion Tool"); ?>
					<form action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
						<label class="required">Barcode:</label>&nbsp;&nbsp;<input type="text" name="barcode" id="barcode" value="<?php if(isset($_COOKIE['barcode'])) { print_r($_COOKIE['barcode']); }?>" required <?php if(isset($_COOKIE['barcode'])) { print_r("readonly"); }?> autocomplete="off">
						<br>
						<label class="small">&nbsp;indicates a required field.</label>
						<br>
						<button type="submit" name="submit" class="danger">Delete Record</button>
					</form>
					<a href="index.php"><button type="button">Return to top page</button></a>
					<script src="imagerender.js"></script>
	<?php
	printpageend();
}
?>