<?php

require_once("globalvars.php");

if(str_replace('\\', '/', __FILE__) == $_SERVER['SCRIPT_FILENAME']) {
	header("Location: index.php");
}

else {
	//Prepare 3 arrays for data.
	$allcolumns = array();
	$allcolumnsqlmatches = array();
	$allcolumnarrayresult = array();

	//Select the test record from the database, and execute the prepared query.
	require("requires/database.php");
	$allcolumnsql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE line = :line;";
	
	try {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$allcolumnstmt = $pdo->prepare($allcolumnsql);
		
		$allcolumnstmt->bindValue(":line", 123456);
		
		$allcolumnstmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$allcolumnresult = $allcolumnstmt->execute();
		
		if($allcolumnresult) {
			$allcolumnresult = $allcolumnstmt->fetch();
			
			if($allcolumnresult) {
				$allcolumns = array_fill_keys(array_keys($allcolumnresult), null);
			}
			
			else {
				die("<!DOCTYPE html><html lang=\"en\"><head><meta name=\"robots\" content=\"noindex, nofollow\"><meta charset=\"utf-8\"/><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"><title>Database error!</title><link rel=\"stylesheet\" href=\"css/basic.css\"></head><body><div class=\"wrapper\"><div class=\"main\"><span class=\"bad\">The test record could not be found!</span><br><br><span>If you accidentally deleted it, please visit <a href=\"https://wagspuzzle.space/\" target=\"_blank\">this page for more information.</span></div></div></body></html>");
			}
		}
		
		else {
			die("<!DOCTYPE html><html lang=\"en\"><head><meta name=\"robots\" content=\"noindex, nofollow\"><meta charset=\"utf-8\"/><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"><title>Database error!</title><link rel=\"stylesheet\" href=\"css/basic.css\"></head><body><div class=\"wrapper\"><div class=\"main\"><span class=\"bad\">The test record could not be found!</span><br><br><span>If you accidentally deleted it, please visit <a href=\"https://wagspuzzle.space/\" target=\"_blank\">this page for more information.</span></div></div></body></html>");
		}
		
		unset($allcolumnsqlmatches);
		unset($allcolumnsql);
		unset($allcolumnarrayresult);
		unset($allcolumnstmt);
		unset($allcolumnresult);
	}

	catch(PDOException $e) {
		echo $e->getMessage();
		die();
	} 
} ?>