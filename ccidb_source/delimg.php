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
	
	$sql1 = "SELECT img_obverse, img_reverse, img_bonus1, img_bonus2, img_bonus3, img_bonus4 FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
	
	try {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$stmt = $pdo->prepare($sql1);
		
		$stmt->bindValue(":barcode", $_SESSION["barcode"]);
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$result = $stmt->execute();
		
		if($result) {
			$_SESSION["stmtresult"] = $stmt->fetch();
			if($_SESSION["stmtresult"]["img_obverse"]) {
				try {
					$pdo->beginTransaction();
				
					$oid1 = $_SESSION["stmtresult"]["img_obverse"];
					$_SESSION["imgs"]["img_obverse"] = $pdo->pgsqlLOBOpen($oid1, 'r');
					
					$oid2 = $_SESSION["stmtresult"]["img_reverse"];
					$_SESSION["imgs"]["img_reverse"] = $pdo->pgsqlLOBOpen($oid2, 'r');
					
					if($_SESSION["stmtresult"]["img_bonus1"]) {
						$oid3 = $_SESSION["stmtresult"]["img_bonus1"];
						$_SESSION["imgs"]["img_bonus1"] = $pdo->pgsqlLOBOpen($oid3, 'r');
					}
					
					else {
						$oid3 = "";
						$_SESSION["imgs"]["img_bonus1"] = "";
					}
					
					if($_SESSION["stmtresult"]["img_bonus2"]) {
						$oid4 = $_SESSION["stmtresult"]["img_bonus2"];
						$_SESSION["imgs"]["img_bonus2"] = $pdo->pgsqlLOBOpen($oid4, 'r');
					}
					
					else {
						$oid4 = "";
						$_SESSION["imgs"]["img_bonus2"] = "";
					}
					
					if($_SESSION["stmtresult"]["img_bonus3"]) {
						$oid5 = $_SESSION["stmtresult"]["img_bonus3"];
						$_SESSION["imgs"]["img_bonus3"] = $pdo->pgsqlLOBOpen($oid5, 'r');
					}
					
					else {
						$oid5 = "";
						$_SESSION["imgs"]["img_bonus3"] = "";
					}
					
					if($_SESSION["stmtresult"]["img_bonus4"]) {
						$oid6 = $_SESSION["stmtresult"]["img_bonus4"];
						$_SESSION["imgs"]["img_bonus4"] = $pdo->pgsqlLOBOpen($oid6, 'r');
					}
					
					else {
						$oid6 = "";
						$_SESSION["imgs"]["img_bonus4"] = "";
					}
					
					$pdo->commit();

					header("Location: delimgconfirm.php");
				}
				
				catch(PDOException $e) {
					$pdo->rollback();
					echo $e->getMessage();
					die();
				}
			}
			
			else {
				$_SESSION['string'] = "No images found for this barcode!";
				header("Location: delimgconfirm.php");
			}
		}
		
		else {
			$_SESSION['string'] = "Database error!";
			header("Location: delimgconfirm.php");
		}
	}

	catch(PDOException $e) {
		echo $e->getMessage();
		die();
	}
}

else { 
	require_once("template.php");
	printpagestart("Image Deletion Tool"); ?>
					<form action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
						<label class="required">Barcode:</label>&nbsp;&nbsp;<input type="text" name="barcode" id="barcode" value="<?php if(isset($_COOKIE['barcode'])) { print_r($_COOKIE['barcode']); }?>" required <?php if(isset($_COOKIE['barcode'])) { print_r("readonly"); }?> autocomplete="off">
						<br>
						<label class="small">&nbsp;indicates a required field.</label>
						<br>
						<button type="submit" name="submit" class="danger">Delete Images</button>
					</form>
					<a href="index.php"><button type="button">Return to top page</button></a>
					<script src="imagerender.js"></script>
	<?php
	printpageend();
}
?>