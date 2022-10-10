<?php

require("globalvars.php");

function echodoc() {
		require("requires/database.php");
		
		$_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));
		
		$sql1 = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
		
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			
			$stmt = $pdo->prepare($sql1);
			
			if(!empty($_POST["barcode"])) {
				$stmt->bindValue(":barcode", $_POST["barcode"]);
			}
			
			elseif(!empty($_COOKIE["barcode"])) {
				$setme = "true";
				$stmt->bindValue(":barcode", $_COOKIE["barcode"]);
			}
			
			else {
				$randomint = random_int(10000000000, 99999999999);
				$codearray = str_split($randomint);
				$sumofodd = ($codearray[0] + $codearray[2] + $codearray[4] + $codearray[6] + $codearray[8] + $codearray[10]) * 3;
				$sumofeven = $codearray[1] + $codearray[3] + $codearray[5] + $codearray[7] + $codearray[9];
				$total = $sumofodd + $sumofeven;
				$check = (ceil($total / 10) * 10) - $total;
				$random = $randomint . $check;
				$stmt->bindValue(":barcode", $random);
			}
			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$result = $stmt->execute();
			
			if($result) {
				$row = $stmt->fetch();
				if(is_array($row)) {
					$setme = "true";
				}
				setcookie("barcode", "", time() - 10);
			}
			
			else {
				$row = null;
			}
		}
		
		catch(PDOException $e) {
			echo $e->getMessage();
			die();
		}
		
		if(isset($_SESSION["postdata"])) {
			$row = $_SESSION["postdata"];
			$setme = true;
		}
		
		require_once("template.php");
		printpagestartnew("Update Record"); ?>
				<br>
				<br>
				<?php require_once("outputs.php"); ?>
				<br>
				<div class="supercentercont">
				    <div class="supercenter">
                        <button type="submit" form="updateform">Submit</button>
				        <a href="index.php" id="navaway"><button type="button">Return to top page</button></a>  
				    </div>
				</div>
				<script src="enter.js"></script>
				<script src="navigateaway.js"></script>
		<?php printpageendnew(); 
		
		unset($_SESSION["postdata"]); }

if(isset($_POST['csrf'])) {
	function quickcheck($code) {
		if(strlen($code) === 12) {
			$tempcode = preg_replace("/^(\d\d\d\d\d\d\d\d\d\d\d)(\d)$/", "$1", $code);
			$codearray = str_split($tempcode);
			$sumofodd = ($codearray[0] + $codearray[2] + $codearray[4] + $codearray[6] + $codearray[8] + $codearray[10]) * 3;
			$sumofeven = $codearray[1] + $codearray[3] + $codearray[5] + $codearray[7] + $codearray[9];
			$total = $sumofodd + $sumofeven;
			$check = (ceil($total / 10) * 10) - $total;
			$withcheck = $tempcode . $check;
			return $withcheck === $code;
		}
		
		else {
			$tempcode = str_pad($tempcode, 12, "0", STR_PAD_LEFT);
			$tempcode = preg_replace("/^(\d\d\d\d\d\d\d\d\d\d\d)(\d)$/", "$1", $code);
			$codearray = str_split($tempcode);
			$sumofodd = ($codearray[0] + $codearray[2] + $codearray[4] + $codearray[6] + $codearray[8] + $codearray[10]) * 3;
			$sumofeven = $codearray[1] + $codearray[3] + $codearray[5] + $codearray[7] + $codearray[9];
			$total = $sumofodd + $sumofeven;
			$check = (ceil($total / 10) * 10) - $total;
			$withcheck = $tempcode . $check;
			return $withcheck === $code;
		}
	}
	
	$quickcheck = quickcheck($_POST["barcode"]);
	
	if(isset($_SESSION['csrf']) && $_POST['csrf'] === $_SESSION['csrf'] && isset($_POST['type']) && preg_match("/^(Coin)?(Bill)?(Token)?(Whitman)?(Special)?(Slab)?$/", $_POST['type']) && isset($_POST['description']) && $_POST['description'] != "" && isset($_POST['barcode']) && $quickcheck === true) {
		if(isset($_POST['nnh'])) {
			$nnh = 1;
		}
		
		else {
			$nnh = 0;
		}
		
		require_once("databasevars.php");
	}
	
	else {
		$_SESSION["postdata"] = $_POST;
		$_SESSION["statusstring"] = "You appear to be missing some fields, please try again.";
		$_SESSION["statusclass"] = "bad";
		header("Location: updated.php");
	}
}

else {
	echodoc();
} ?>