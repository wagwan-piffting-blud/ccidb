<?php

//Automatically grab all columns in the database as well as global vars. All columns are saved to the array `$allcolumns`.
require_once("allcolumns.php");
require_once("globalvars.php");

//Grab source filename and output to user if needed (near bottom of file).
$sourcefile = debug_backtrace();

if(isset($sourcefile[1])) {
	$filetoinclude = preg_replace("/(.*\\\\)(.*\.php)/", "$2", $sourcefile[1]["file"]);
	$filetoinclude = preg_replace("/(.*\/)(.*\.php)/", "$2", $filetoinclude);
}

else {
	$filetoinclude = preg_replace("/(.*\\\\)(.*\.php)/", "$2", $sourcefile[0]["file"]);
	$filetoinclude = preg_replace("/(.*\/)(.*\.php)/", "$2", $filetoinclude);
}

//validate.php
if($filetoinclude === "validate.php") {
	//Initialize session string array.
	$_SESSION['string'] = array();
	
	//Begin looping through all columns.
	foreach($allcolumns as $ident => $data) {
		//By default, don't skip a column.
		$skip = 0;
		
		//If the column does need to be skipped, it can be done here.
		if($ident === "something") {
			$skip = 1;
		}
		
		//Otherwise, simply save the column and its data to the newly created array.
		if($skip === 0) {
			$_SESSION['string'][$ident] = $row[$ident];
		}
	}
}

//search.php
elseif($filetoinclude === "search.php") {
	//Begin looping through all columns.
	foreach($allcolumns as $ident => $data) {
		//By default, don't skip a column.
		$skip = 0;
		
		//We skip hasimg and nnh because their values are purely binary.
		if($ident === "hasimg" || $ident === "nnh") {
			$skip = 1;
			
			//Set the variables `$ishasimgset` and `$isnnhset` to "yes" if they are set.
			if(isset($_POST[$ident])) {
				$runcount += 1;
				${"is" . $ident . "set"}  = "yes";
			}
		}
		
		//Do the same as above, but with all other columns.
		if($skip === 0) {
			if(isset($_POST[$ident]) && !empty($_POST[$ident])) {
				$runcount += 1;
				${"is" . $ident . "set"} = "yes";
			}
		}
	}
	
	//A hacky fix for if "barcode" just has a 0 in it and nothing else.
	if($_POST['barcode'] === "0") {
		$_POST['barcode'] = 000000000000;
		$runcount += 1;
		$isbarcodeset = "yes";
	}
	
	//Pad the barcode if the user entered one in search.
	$_POST['barcode'] = str_pad($_POST['barcode'], 12, "0", STR_PAD_LEFT);
	
	//Prepare the SQL query for search (only run if runcount is 1).
	if($runcount === 1) {
		foreach($allcolumns as $ident => $data) {
			$skip = 0;
			
			if($ident === "line" || $ident === "barcode" || $ident === "nnh") {
				$skip = 1;
				
				if($ident === "line" || $ident === "barcode") {
					if(isset(${"is" . $ident . "set"}) && ${"is" . $ident . "set"} === "yes") {
						$sql .= $ident . " = :" . $ident . " ;";
					}
				}
				
				elseif($ident === "nnh") {
					if(isset(${"is" . $ident . "set"}) && ${"is" . $ident . "set"} === "yes") {
						$sql .= $ident . " = 1;";
					}
				}
			}
			
			if($skip === 0) {
				if(isset(${"is" . $ident . "set"}) && ${"is" . $ident . "set"} === "yes") {
					$sql .= $ident . " ILIKE '%'::text || :" . $ident . "::text || '%'::text;";
				}
			}
		}
	}
	
	//Prepare the SQL query for search (if runcount is greater than 1).
	elseif($runcount > 1) {
		$last = array_key_last($allcolumns);
		for($i = 1; $i <= $runcount; $i++){
			foreach($allcolumns as $ident => $data) {
				$skip = 0;
				
				if($ident === "line" || $ident === "barcode" || $ident === "nnh" && $i === $runcount) {
					$skip = 1;
					
					if(isset(${"is" . $ident . "set"}) && ${"is" . $ident . "set"} === "yes") {
						$sql .= $ident . " = :" . $ident . " ;";
						break 2;
					}
				}
				
				elseif($ident === "line" || $ident === "barcode" || $ident === "nnh" && $i < $runcount) {
					$skip = 1;
					
					if(isset(${"is" . $ident . "set"}) && ${"is" . $ident . "set"} === "yes") {
						$sql .= $ident . " = :" . $ident . " AND ";
					}
					
					if($ident == $last) {
						break 2;
					}
				}
				
				elseif($skip === 0 && $i === $runcount) {
					if(isset(${"is" . $ident . "set"}) && ${"is" . $ident . "set"} === "yes") {
						$sql .= $ident . " ILIKE '%'::text || :" . $ident . "::text || '%'::text;";
						break 2;
					}
				}
				
				elseif($skip === 0 && $i < $runcount) {
					if(isset(${"is" . $ident . "set"}) && ${"is" . $ident . "set"} === "yes") {
						$sql .= $ident . " ILIKE '%'::text || :" . $ident . "::text || '%'::text AND ";
					}
					if($ident == $last) {
						$sql = preg_replace("/ AND $/", ";", $sql);
						break 2;
					}
				}
			}
		}
	}
}

//update.php
elseif($filetoinclude === "update.php") {
	$sql1 = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
	
	$_POST["barcode"] = str_pad($_POST["barcode"], 12, "0", STR_PAD_LEFT);
	
	try {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$stmt = $pdo->prepare($sql1);
		
		$stmt->bindValue(":barcode", $_POST["barcode"]);
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$result = $stmt->execute();
		
		if($result) {
			if(!($stmt->fetch())) {
				$sql2 = "INSERT INTO " . $_SESSION["tablename"] . " (";
				
				$runcount = 0;
				
				foreach($allcolumns as $ident => $data) {
					if($ident === "img_obverse" || $ident === "img_reverse" || $ident === "img_bonus1" || $ident === "img_bonus2" || $ident === "img_bonus3" || $ident === "img_bonus4") {
						$skippingstone = 1;
					}
					
					else {
						$skippingstone = 0;
					}
					
					if($skippingstone === 0) {
						$runcount += 1;
						
						if($runcount === (count($allcolumns) - 6)) {
							$sql2 .= $ident . ") VALUES (";
						}
						
						else {
							$sql2 .= $ident . ", ";
						}
					}
				}
				
				$runcount = 0;
				
				foreach($allcolumns as $ident => $data) {
					if($ident === "img_obverse" || $ident === "img_reverse" || $ident === "img_bonus1" || $ident === "img_bonus2" || $ident === "img_bonus3" || $ident === "img_bonus4") {
						$skippingstone2 = 1;
					}
					
					else {
						$skippingstone2 = 0;
					}
					
					if($skippingstone2 === 0) {
						$runcount += 1;
						
						if($runcount === (count($allcolumns) - 6)) {
							$sql2 .= ":" . $ident . ");";
						}
						
						else {
							$sql2 .= ":" . $ident . ", ";
						}
					}
				}
				
				$runcount = 0;
				
				$stmt2 = $pdo->prepare($sql2);
				
				foreach($allcolumns as $ident => $data) {
					if($ident === "img_obverse" || $ident === "img_reverse" || $ident === "img_bonus1" || $ident === "img_bonus2" || $ident === "img_bonus3" || $ident === "img_bonus4") {
						$skipper = 1;
					}
					
					else {
						$skipper = 0;
					}
					
					if($skipper === 1) {
					}
					
					elseif(($skipper === 0) && ($ident === "melt" || $ident === "nnh" || $ident === "line" || $ident === "barcode" || $ident === "hasimg")) {
						if($ident === "nnh" && isset($_POST["nnh"])) {
							$stmt2->bindValue(":" . $ident, 1, PDO::PARAM_INT);
						}
						
						elseif($ident === "melt" && isset($_POST["melt"])) {
							$stmt2->bindValue(":" . $ident, 1, PDO::PARAM_INT);
						}
						
						elseif($ident === "line" && isset($_POST["line"])) {
							$stmt2->bindValue(":" . $ident, $_POST["line"], PDO::PARAM_INT);
						}
						
						elseif($ident === "barcode" && isset($_POST["barcode"])) {
							$stmt2->bindValue(":" . $ident, $_POST["barcode"], PDO::PARAM_INT);
						}
						
						else {
							$stmt2->bindValue(":" . $ident, 0, PDO::PARAM_INT);
						}
					}
					
					else {
						$stmt2->bindValue(":" . $ident, $_POST[$ident], PDO::PARAM_STR);
					}
				}
				
				$result2 = $stmt2->execute();
				
				//If the create passes, send the user to updated.php.
				if($result2) {
					$_SESSION["statusstring"] = "Successfully created record #" . $_POST["barcode"] . "!";
					$_SESSION["statusclass"] = "good";
					header("Location: updated.php");
				}
				
				//If the create fails, send the user to updated.php with an error.
				else {
					$_SESSION["statusstring"] = "Failed to create record #" . $_POST["barcode"] . ".";
					$_SESSION["statusclass"] = "bad";
					header("Location: updated.php");
				}
			}
			
			else {				
				$sql2 = "UPDATE " . $_SESSION["tablename"] . " SET ";
	
				//For each column, update the query.
				foreach($allcolumns as $ident => $data) {
					$skip = 0;
					
					if($ident === "barcode" || $ident === "hasimg" || $ident === "img_obverse" || $ident === "img_reverse" || $ident === "img_bonus1" || $ident === "img_bonus2" || $ident === "img_bonus3" || $ident === "img_bonus4") {
						$skip = 1;
					}
					
					if($skip === 0) {
						$sql2 .= $ident . " = :" . $ident . ", ";
					}
				}
				
				//Replace the final comma and space with a single space, if present.
				$sql2 = preg_replace("/\, $/", " ", $sql2);
				
				//Only update the record that needs updating.
				$sql2 .= "WHERE barcode = :barcode;";
				
				//Prepare and bind the query.
				$stmt2 = $pdo->prepare($sql2);
				
				foreach($allcolumns as $ident => $data) {
					$skip = 0;
					
					if($ident === "hasimg" || $ident === "img_obverse" || $ident === "img_reverse" || $ident === "img_bonus1" || $ident === "img_bonus2" || $ident === "img_bonus3" || $ident === "img_bonus4") {
						$skip = 1;
					}
					
					if($skip === 1) {	
					}
					
					elseif(($skip === 0) && ($ident === "melt" || $ident === "nnh" || $ident === "line" || $ident === "barcode" || $ident === "hasimg")) {
						if($ident === "nnh" && isset($_POST["nnh"])) {
							$stmt2->bindValue(":" . $ident, 1, PDO::PARAM_INT);
						}
						
						elseif($ident === "melt" && isset($_POST["melt"])) {
							$stmt2->bindValue(":" . $ident, 1, PDO::PARAM_INT);
						}
						
						elseif($ident === "line" && isset($_POST["line"])) {
							$stmt2->bindValue(":" . $ident, $_POST["line"], PDO::PARAM_INT);
						}
						
						elseif($ident === "barcode" && isset($_POST["barcode"])) {
							$stmt2->bindValue(":" . $ident, $_POST["barcode"], PDO::PARAM_INT);
						}
						
						else {
							$stmt2->bindValue(":" . $ident, 0, PDO::PARAM_INT);
						}
					}
					
					elseif($skip === 0) {
						$stmt2->bindValue(":" . $ident, $_POST[$ident], PDO::PARAM_STR);
					}
				}
				
				$result2 = $stmt2->execute();
				
				if($result2) {
					$_SESSION["statusstring"] = "Successfully updated record #" . $_POST["barcode"] . "!";
					$_SESSION["statusclass"] = "good";
					$database = null;
					header("Location: updated.php");
				}
				
				else {
					$_SESSION["statusstring"] = "Failed to update record #" . $_POST["barcode"] . ".";
					$_SESSION["statusclass"] = "bad";
					$database = null;
					header("Location: updated.php");
				}
			}
		}
		
		else {
			$_SESSION["statusstring"] = "Failed to select record #" . $_POST["barcode"] . ".";
			$_SESSION["statusclass"] = "bad";
			$database = null;
			header("Location: updated.php");
		}
	}
	
	catch(PDOException $e) {
		echo $e->getMessage();
		die();
	}
}

//If the file is not included, throw an error and stop execution.
else {
	print_r($filetoinclude . " is not included in databasevars.php! Please include the file before retrying.");
	die();
} ?>