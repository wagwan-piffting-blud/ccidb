<?php

require_once("globalvars.php");
require_once("allcolumns.php");

$sql1 = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE line > 1000 AND line < 2000 ORDER BY line ASC;";
	
try {
	$database = new PDO("sqlite:". $filename);
	
	$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $database->prepare($sql1);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	$array = $stmt->fetchAll();
	
	$string = "";
	
	foreach($array as $key => $data) {
		foreach($data as $finalkey => $finaldata) {
			if($finalkey === "line") {
				$string .= $finaldata . ": ";
			}
			
			elseif($finalkey === "barcode") {
				$string .= str_pad($finaldata, 12, "0", STR_PAD_LEFT) . "<br>";
			}
		}
	}
	
	print_r($string);
	die();
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
} ?>