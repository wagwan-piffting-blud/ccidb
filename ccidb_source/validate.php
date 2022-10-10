<?php

require_once("globalvars.php");

function dbresponse($sql, $bindtoprepare) {
	require("requires/database.php");
	require("allcolumns.php");
	
	try {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$stmt = $pdo->prepare($sql);
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach($allcolumns as $ident => $data) {
			if(preg_match("/:" . $ident . "/", $sql)) {
				$stmt->bindValue(":" . $ident, $bindtoprepare);
			}
		}
		
		$result = $stmt->execute();
		
		if($result) {
			if($row = $stmt->fetch()) {
				require_once('databasevars.php');
			}
			
			else {
				$_SESSION["string"] = (string) "Sorry, no matches found.";
			}
		}
		
		if(!isset($_SESSION['string'])) {
			$_SESSION["string"] = (string) "Sorry, no matches found.";
		}
	}

	catch(PDOException $e) {
		echo $e->getMessage();
		die();
	}
}

function validate($code) {
	if(strlen($code) === 12){
		$codearray = str_split($code);
		$sumofodd = ($codearray[0] + $codearray[2] + $codearray[4] + $codearray[6] + $codearray[8] + $codearray[10]) * 3;
		$sumofeven = $codearray[1] + $codearray[3] + $codearray[5] + $codearray[7] + $codearray[9];
		$total = $sumofodd + $sumofeven;
		$check = (integer) (ceil($total / 10) * 10) - $total;
		$origcheck = (integer) substr($code, 11, 1);
		
		if($origcheck === $check) {
			$_SESSION["valuefromeval"] = "barcode";
			
			$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
		
			dbresponse($sql, $code);
			
			header("Location: show_output.php");
		}
		
		else {
			$_SESSION["valuefromeval"] = "invalid";
			$_SESSION["string"] = (string) "Invalid format.";
			header("Location: show_output.php");
		}
	}

	elseif(strlen($code) > 6 && strlen($code) < 12) {
		$paddedcode = str_pad($code, 12, "0", STR_PAD_LEFT);
		
		$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
		
		dbresponse($sql, $paddedcode);
		
		if($_SESSION["string"] === "Sorry, no matches found.") {
			$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
		
			dbresponse($sql, $code);
			
			if($_SESSION["string"] === "Sorry, no matches found.") {
				$_SESSION["string"] = (string) "Invalid format.";
				header("Location: show_output.php");
			}
			
			else {
				header("Location: show_output.php");
			}
		}
		
		else {
			header("Location: show_output.php");
		}
	}

	elseif(strlen($code) <= 6) {
		$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE line = :line;";
		
		dbresponse($sql, $code);
		
		header("Location: show_output.php");
	}
	
	elseif(strlen($code) === 22){
		$truncatedcert = preg_replace("/^(.*)(\d\d\d\d\d\d\d\d)$/", "$2", $code);
		
		$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
		
		dbresponse($sql, $truncatedcert);
		
		header("Location: show_output.php");
	}
	
	elseif(strlen($code) === 20 || strlen($code) === 18 || strlen($code) === 15){
		if(strlen($code) === 20) {
			$truncatedcert = preg_replace("/^(.*)(\d\d\d\d\d\d\d)(\d\d\d)$/", "$2-$3", $code);
		
			$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
			
			dbresponse($sql, $truncatedcert);
			
			header("Location: show_output.php");
		}
		
		elseif(strlen($code) === 18) {
			$truncatedcert = preg_replace("/^(.*)(\d\d\d\d\d\d\d)(\d\d\d)$/", "$2-$3", $code);
		
			$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
			
			dbresponse($sql, $truncatedcert);
			
			header("Location: show_output.php");
		}
		
		elseif(strlen($code) === 15) {
			$truncatedcert = preg_replace("/^(.*)(\d\d\d\d\d\d)(\d\d)$/", "$2-0$3", $code);
		
			$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
			
			dbresponse($sql, $truncatedcert);
			
			header("Location: show_output.php");
		}
	}
	
	elseif(strlen($code) === 16 || strlen($code) === 8) {
		if(strlen($code) === 16) {
			if((substr($code, 0, 1) === "0" && substr($code, 0, 2) != "00") || (substr($code, 0, 1) === "0" && substr($code, 0, 6) === "000000")) {
				//$_SESSION["valuefromeval"] = "ngc16";
				if(in_array(substr($code, 14, 3), range("001", "099")) ) {
					$truncatedcert = preg_replace("/^(.*)(\d\d\d\d\d)(\d\d\d)$/", "$2-$3", $code);
				}
				
				else {
					$truncatedcert = preg_replace("/^(.*)(\d\d\d\d\d\d)(\d\d)$/", "$2-0$3", $code);
				}
		
				$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
				
				dbresponse($sql, $truncatedcert);
				
				header("Location: show_output.php");
			}
			
			elseif(in_array(substr($code, 6, 2), range(1, 70)) || preg_match("/^([8-9][1-9])$/", substr($code, 6, 2))) {
				$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
				
				dbresponse($sql, $truncatedcert);
				
				header("Location: show_output.php");
			}
			
			else {
			
			}
		}
		
		elseif(strlen($code) === 8 && in_array(substr($code, 6, 2), range("01", "09"))) {
			$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
				
			dbresponse($sql, $truncatedcert);
			
			header("Location: show_output.php");
		}
		
		elseif(strlen($code) === 8 && in_array(substr($code, 6, 2), range(10, 99))) {
			$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE cert = :cert;";
				
			dbresponse($sql, $truncatedcert);
			
			header("Location: show_output.php");
		}
		
		else {
			//$_SESSION["string"] = (string) "Invalid format.";
			header("Location: show_output.php");
		}
	}
	
	else {
		//$_SESSION["string"] = (string) "Invalid format.";
		header("Location: show_output.php");
	}
}

?>