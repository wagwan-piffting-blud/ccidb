<?php

require_once("globalvars.php");

function barcodemath($code) {
	require("requires/database.php");
	print_r("<span>" . "Original: " . $code . "</span><br>");

	$codearray = str_split($code);
	$sumofodd = ($codearray[0] + $codearray[2] + $codearray[4] + $codearray[6] + $codearray[8] + $codearray[10]) * 3;
	
	print_r("<span>" . "Sum of odd numbers: " . $sumofodd . "</span><br>");
	
	$sumofeven = $codearray[1] + $codearray[3] + $codearray[5] + $codearray[7] + $codearray[9];
	
	print_r("<span>" . "Sum of even numbers: " . $sumofeven . "</span><br>");
	
	$total = $sumofodd + $sumofeven;
	
	print_r("<span>" . "Odd + even = " . $total . "</span><br>");
	print_r("<span>" . "Rounded UP to nearest 10: " . (ceil($total / 10) * 10) . "</span><br>");
	
	$check = (ceil($total / 10) * 10) - $total;
	
	print_r("<span>" . "Checksum: " . $check . "</span><br><br>"); 
	
	print_r("<span>" . "FINAL: " . $code . $check . "</span><br><br>");
	
	$dbcheck = $code . $check;
	
	$dbcheck = str_pad($dbcheck, 12, "0", STR_PAD_LEFT);
	
	try {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode";
		
		$stmt = $pdo->prepare($sql);
		
		$stmt->bindValue(":barcode", $dbcheck);
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$result = $stmt->execute();
		
		if($result) {
			$isalreadyindb = $stmt->fetch();
			
			if($isalreadyindb) {
				print_r("<span>Is in DB already:</span>&nbsp;&nbsp;<span class=\"bad\">YES</span>&nbsp;&nbsp;<span>(Please generate a new barcode.)</span><br><br>");
			}
			
			elseif(!$isalreadyindb) {
				print_r("<span>Is in DB already:</span>&nbsp;&nbsp;<span class=\"good\">No</span>&nbsp;&nbsp;<span>(You're good!)</span><br><br>");
			}
		}
		
		else {
			print_r("<span>Failed to check if barcode is in database.</span><br><br>");
		}
	}

	catch(PDOException $e) {
		echo $e->getMessage();
		die();
	}
	
	print_r("<a href=\"" . basename($_SERVER["SCRIPT_FILENAME"]) . "\"><button type=\"button\">Generate more barcodes</button></a><br><br><a href=\"index.php\"><button type=\"button\">Return to top page</button></a>");
}

if(isset($_POST["inputURL"]) && !empty($_POST["inputURL"])) {
	$code = str_pad($_POST["inputURL"], 11, "0", STR_PAD_LEFT);
	require_once("template.php");
	printpagestart("Barcode Generator");
	barcodemath($code);
	printpageend();
}

elseif(isset($_POST["lucky"])) {
	$code = $_POST["lucky"];
	require_once("template.php");
	printpagestart("Barcode Generator");
	barcodemath($code);
	printpageend();
}

else {
	require_once("template.php");
	printpagestart("Barcode Generator"); ?>
				<span>Enter 11 digits to generate checksum:</span>
				<br>
				<br>
				<form name="form" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
					<input type="text" id="inputURL" name="inputURL" value="" autocomplete="off" autofocus="autofocus" pattern="\d*" maxlength="11">
					<input type="hidden" id="lucky" name="lucky" value="<?php print_r(random_int(10000000000, 99999999999));?>" autocomplete="off">
					<br>
					<button type="submit">Submit</button>
					<button type="submit" id="lucky">"I'm Feeling Lucky"</button>
				</form>
				<br>
				<a href="index.php"><button>Return to top page</button></a>
<?php
	printpageend();
} ?>