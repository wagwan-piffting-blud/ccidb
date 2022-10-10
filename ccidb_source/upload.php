<?php

require_once("globalvars.php");

if(!empty($_POST)) {
	if(isset($_COOKIE['barcode'])) {
		$_COOKIE["barcode"] = "";
		setcookie("barcode", "", time() - 10);
	}
	
	$_POST["barcode"] = str_pad($_POST["barcode"], 12, "0", STR_PAD_LEFT);
	$_SESSION["status"] = "";
	$_SESSION["string"] = "";
	
	$img_obverse_err = $_FILES["fileToUpload1"]["error"];
	$img_reverse_err = $_FILES["fileToUpload2"]["error"];
	$img_bonus1_err = $_FILES["fileToUpload3"]["error"];
	$img_bonus2_err = $_FILES["fileToUpload4"]["error"];
	$img_bonus3_err = $_FILES["fileToUpload5"]["error"];
	$img_bonus4_err = $_FILES["fileToUpload6"]["error"];
	
	for($i = 1; $i < 6; $i++) {
	    preg_match_all("/^(image)\/(png)?(svg+xml)?(apng)?(webp)?(gif)?(jpeg)?$/", $_FILES["fileToUpload" . $i]['type'], $mimetypearray);
		
	    if(!is_array($mimetypearray[0])) {
	        $_SESSION["status"] = "bad";
			$_SESSION["string"] .= "The images you uploaded for record #" . $_POST["barcode"] . " don't appear to be valid images.";
			header("Location: uploaded.php");
			die();
	    }
	    
	    elseif($_FILES["fileToUpload" . $i]['size'] > 10485760) {
	        $_SESSION["status"] = "bad";
			$_SESSION["string"] .= "The images you uploaded for record #" . $_POST["barcode"] . " are too big! Maximum allowed size for each individual image is 10 MB. Please make sure it is under this limit before retrying.";
			header("Location: uploaded.php");
			die();
	    }
	}
	
	$sql1 = "SELECT hasimg FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
	
	try {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$stmt = $pdo->prepare($sql1);
			
		$stmt->bindValue(":barcode", $_POST["barcode"]);
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$result = $stmt->execute();
		
		if($result) {
			$hasimg = $stmt->fetch();
			$hasimg = $hasimg['hasimg'];
			
			if($hasimg != 1) {
				$pdo->beginTransaction();
	
				$rolledback = false;

				if($img_obverse_err === 0) {		
					$oid1 = $pdo->pgsqlLOBCreate();
					
					$stream = $pdo->pgsqlLOBOpen($oid1, 'w');
					
					$local = fopen($_FILES["fileToUpload1"]["tmp_name"], 'rb');
					
					stream_copy_to_stream($local, $stream);
					
					$local = null;
					$stream = null;
				}
				
				else {
					$pdo->rollback();
					$rolledback = true;
				}
				
				if($img_reverse_err === 0) {
					$oid2 = $pdo->pgsqlLOBCreate();
					
					$stream = $pdo->pgsqlLOBOpen($oid2, 'w');
					
					$local = fopen($_FILES["fileToUpload2"]["tmp_name"], 'rb');
					
					stream_copy_to_stream($local, $stream);
					
					$local = null;
					$stream = null;
				}
				
				elseif(isset($img_reverse_err) && $img_reverse_err != 4 && $rolledback === false) {
					$pdo->rollback();
					$rolledback = true;
				}
				
				if(isset($img_bonus1_err) && $img_bonus1_err === 0) {
					$oid3 = $pdo->pgsqlLOBCreate();
					
					$stream = $pdo->pgsqlLOBOpen($oid3, 'w');
					
					$local = fopen($_FILES["fileToUpload3"]["tmp_name"], 'rb');
					
					stream_copy_to_stream($local, $stream);
					
					$local = null;
					$stream = null;
				}
				
				elseif(isset($img_bonus1_err) && $img_bonus1_err != 4 && $rolledback === false) {
					$pdo->rollback();
					$rolledback = true;
				}
				
				if(isset($img_bonus2_err) && $img_bonus2_err === 0) {
					$oid4 = $pdo->pgsqlLOBCreate();
					
					$stream = $pdo->pgsqlLOBOpen($oid4, 'w');
					
					$local = fopen($_FILES["fileToUpload4"]["tmp_name"], 'rb');
					
					stream_copy_to_stream($local, $stream);
					
					$local = null;
					$stream = null;
				}
				
				elseif(isset($img_bonus2_err) && $img_bonus2_err != 4 && $rolledback === false) {
					$pdo->rollback();
					$rolledback = true;
				}
				
				if(isset($img_bonus3_err) && $img_bonus3_err === 0) {
					$oid5 = $pdo->pgsqlLOBCreate();
					
					$stream = $pdo->pgsqlLOBOpen($oid5, 'w');
					
					$local = fopen($_FILES["fileToUpload5"]["tmp_name"], 'rb');
					
					stream_copy_to_stream($local, $stream);
					
					$local = null;
					$stream = null;
				}
				
				elseif(isset($img_bonus3_err) && $img_bonus3_err != 4 && $rolledback === false) {
					$pdo->rollback();
					$rolledback = true;
				}
				
				if(isset($img_bonus4_err) && $img_bonus4_err === 0) {
					$oid6 = $pdo->pgsqlLOBCreate();
					
					$stream = $pdo->pgsqlLOBOpen($oid6, 'w');
					
					$local = fopen($_FILES["fileToUpload6"]["tmp_name"], 'rb');
					
					stream_copy_to_stream($local, $stream);
					
					$local = null;
					$stream = null;
				}
				
				elseif(isset($img_bonus4_err) && $img_bonus4_err != 4 && $rolledback === false) {
					$pdo->rollback();
					$rolledback = true;
				}
				
				if(isset($oid1) && is_numeric($oid1)) {
					$sql2 = "UPDATE " . $_SESSION["tablename"] . " SET hasimg = 1, img_obverse = :img_obverse, img_reverse = :img_reverse, img_bonus1 = :img_bonus1, img_bonus2 = :img_bonus2, img_bonus3 = :img_bonus3, img_bonus4 = :img_bonus4 WHERE barcode = :barcode;";
									
					try {
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
						
						$stmt = $pdo->prepare($sql2);
						
						$stmt->bindValue(":barcode", $_POST["barcode"]);
						$stmt->bindValue(":img_obverse", $oid1);
						$stmt->bindValue(":img_reverse", $oid2);
						
						if(isset($oid3)) {
							$stmt->bindValue(":img_bonus1", $oid3);
						}
						
						else {
							$stmt->bindValue(":img_bonus1", '');
						}
						
						if(isset($oid3)) {
							$stmt->bindValue(":img_bonus2", $oid4);
						}
						
						else {
							$stmt->bindValue(":img_bonus2", '');
						}
						
						if(isset($oid3)) {
							$stmt->bindValue(":img_bonus3", $oid5);
						}
						
						else {
							$stmt->bindValue(":img_bonus3", '');
						}
						
						if(isset($oid3)) {
							$stmt->bindValue(":img_bonus4", $oid6);
						}
						
						else {
							$stmt->bindValue(":img_bonus4", '');
						}
						
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						$result = $stmt->execute();
						
						if($result) {
							$_SESSION["status"] = "good";
							$_SESSION["string"] .= "(DB Update OK) ";
							$_SESSION["string"] .= "The images for record #" . $_POST["barcode"] . " have been uploaded successfully!";
							$pdo->commit();
							header("Location: uploaded.php");
						}
						
						else {
							$_SESSION["status"] = "bad";
							$_SESSION["string"] .= "(DB Update FAILED) ";
							$_SESSION["string"] .= "The images for record #" . $_POST["barcode"] . " could not be uploaded for some reason.";
							$pdo->rollback();
							header("Location: uploaded.php");
						}
					}
					
					catch(PDOException $e) {
						$pdo->rollback();
						echo $e->getMessage();
						die();
					}
				}
			}
			
			else {
				$_SESSION["status"] = "bad";
				$_SESSION["string"] .= "Record #" . $_POST["barcode"] . " already has images! Please <a href=\"delimg.php\">delete them first</a> before trying to upload new ones.";
				header("Location: uploaded.php");
			}
		}
		
		else {
			$_SESSION["status"] = "bad";
			$_SESSION["string"] .= "Failed to check if record #" . $_POST["barcode"] . " already has images, aborting!";
			header("Location: uploaded.php");
		}
	}

	catch(PDOException $e) {
		echo $e->getMessage();
		die();
	}
}

else { 
    if(isset($_COOKIE['barcode'])) {
		$_SESSION["barcode"] = $_COOKIE['barcode'];
		$_COOKIE["barcode"] = "";
		setcookie("barcode", "", time() - 10);
	}
	require_once("template.php");
	printpagestart("Image Upload"); 
	?>
				<form action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post" id="imgupload" name="imgupload" enctype="multipart/form-data">
					<label class="required" for="fileToUpload1">Choose Obverse file:</label>&nbsp;&nbsp;<input accept="image/*" type="file" name="fileToUpload1" id="fileToUpload1" required>
					<br>
					<label class="required" for="fileToUpload2">Choose Reverse file:</label>&nbsp;&nbsp;<input accept="image/*" type="file" name="fileToUpload2" id="fileToUpload2" required>
					<br>
					<br>
					<label id="bonusynlabel" for="bonusyn">Would you like to add any bonus images (up to 4)?&nbsp;&nbsp;</label>
					<select id="bonusyn" name="bonusyn">
						<option value="no">No (default)</option>
						<option value="yes">Yes</option>
					</select>
					<label id="bonusnumberlabel" for="bonusnumber"><br>Alright, how many bonus images?&nbsp;&nbsp;</label>
					<select id="bonusnumber" name="bonusnumber">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
					<br>
					<br>
					<label class="required" id="bonus1label" for="fileToUpload3">Choose Bonus Image #1 file:&nbsp;&nbsp;</label><input accept="image/*" type="file" name="fileToUpload3" id="fileToUpload3"><br id="bonus1br">
					<label class="required" id="bonus2label" for="fileToUpload4">Choose Bonus Image #2 file:&nbsp;&nbsp;</label><input accept="image/*" type="file" name="fileToUpload4" id="fileToUpload4"><br id="bonus2br">
					<label class="required" id="bonus3label" for="fileToUpload5">Choose Bonus Image #3 file:&nbsp;&nbsp;</label><input accept="image/*" type="file" name="fileToUpload5" id="fileToUpload5"><br id="bonus3br">
					<label class="required" id="bonus4label" for="fileToUpload6">Choose Bonus Image #4 file:&nbsp;&nbsp;</label><input accept="image/*" type="file" name="fileToUpload6" id="fileToUpload6"><br id="bonus4br">
					<br>
					<br>
					<label for="barcode" class="required">Barcode:&nbsp;&nbsp;</label><input type="text" pattern="\d{12}" name="barcode" id="barcode" autocomplete="off" value="<?php if(isset($_SESSION["barcode"])) { print_r($_SESSION["barcode"]); }?>" required <?php if(isset($_SESSION["barcode"])) { print_r("readonly"); }?>>
					<br>
					<label class="small">&nbsp;indicates a required field.</label>
					<br>
					<button type="submit" name="submitbtn" id="submitbtn">Submit Images</button>
					<a href="index.php" id="navaway"><button type="button">Return to top page</button></a>
				</form>
				<table id="imagestable">
					<tbody>
						<tr>
							<td><span>Obverse</span></td>
							<td><span>Reverse</span></td>
						</tr>
						<tr>
							<td><img id="obverse" src="#" alt="Obverse"></img></td>
							<td><img id="reverse" src="#" alt="Reverse"></img></td>
						</tr>
						<tr>
							<td><span class="bad" id="obverseerrmsg"></span></td>
							<td><span class="bad" id="reverseerrmsg"></span></td>
						</tr>
					</tbody>
				</table>
				<table id="imagestablebonus">
					<tbody>
						<tr>
							<td id="bonus1tdr1"><span>Bonus Image #1</span></td>
							<td id="bonus2tdr1"><span>Bonus Image #2</span></td>
							<td id="bonus3tdr1"><span>Bonus Image #3</span></td>
							<td id="bonus4tdr1"><span>Bonus Image #4</span></td>
						</tr>
						<tr>
							<td id="bonus1tdr2"><img id="bonus1" src="#" alt="Bonus Image #1"></img></td>
							<td id="bonus2tdr2"><img id="bonus2" src="#" alt="Bonus Image #2"></img></td>
							<td id="bonus3tdr2"><img id="bonus3" src="#" alt="Bonus Image #3"></img></td>
							<td id="bonus4tdr2"><img id="bonus4" src="#" alt="Bonus Image #4"></img></td>
						</tr>
						<tr>
							<td><span class="bad" id="bonus1errmsg"></span></td>
							<td><span class="bad" id="bonus2errmsg"></span></td>
							<td><span class="bad" id="bonus3errmsg"></span></td>
							<td><span class="bad" id="bonus4errmsg"></span></td>
						</tr>
					</tbody>
				</table>
				<script src="imagerender.js"></script>
				<script src="navigateaway.js"></script>
<?php 
    unset($_SESSION["barcode"]);
	printpageend();
} ?>