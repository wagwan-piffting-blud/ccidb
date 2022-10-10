<?php

require_once("globalvars.php");

if($_SESSION["stmtresult"]["img_obverse"]) { 
	if(!empty($_POST)) { 
		$sql2 = "UPDATE " . $_SESSION["tablename"] . " SET hasimg = 0, img_obverse = '', img_reverse = '', img_bonus1 = '', img_bonus2 = '', img_bonus3 = '', img_bonus4 = '' WHERE barcode = :barcode;";
		$_SESSION["finalstring"] = "";
		
		try {
			$pdo->beginTransaction();
			
			$oid1 = $_SESSION["stmtresult"]["img_obverse"];
			$pdo->pgsqlLOBUnlink($oid1);
			
			$oid2 = $_SESSION["stmtresult"]["img_reverse"];
			$pdo->pgsqlLOBUnlink($oid2);
			
			if($_SESSION["stmtresult"]["img_bonus1"]) {
				$oid3 = $_SESSION["stmtresult"]["img_bonus1"];
				$pdo->pgsqlLOBUnlink($oid3);
			}
			
			else {
				$oid3 = "";
				$_SESSION["imgs"]["img_bonus1"] = "";
			}
			
			if($_SESSION["stmtresult"]["img_bonus2"]) {
				$oid4 = $_SESSION["stmtresult"]["img_bonus2"];
				$pdo->pgsqlLOBUnlink($oid4);
			}
			
			else {
				$oid4 = "";
				$_SESSION["imgs"]["img_bonus2"] = "";
			}
			
			if($_SESSION["stmtresult"]["img_bonus3"]) {
				$oid5 = $_SESSION["stmtresult"]["img_bonus3"];
				$pdo->pgsqlLOBUnlink($oid5);
			}
			
			else {
				$oid5 = "";
				$_SESSION["imgs"]["img_bonus3"] = "";
			}
			
			if($_SESSION["stmtresult"]["img_bonus4"]) {
				$oid6 = $_SESSION["stmtresult"]["img_bonus4"];
				$pdo->pgsqlLOBUnlink($oid6);
			}
			
			else {
				$oid6 = "";
				$_SESSION["imgs"]["img_bonus4"] = "";
			}
			
			$pdo->commit();
			
			try {
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				
				$stmt = $pdo->prepare($sql2);
				
				$stmt->bindValue(":barcode", $_SESSION["barcode"]);
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				$result = $stmt->execute();
				
				if($result) {
					$class = "good";
					$_SESSION["finalstring"] .= "(DB Update OK) ";
					$_SESSION["finalstring"] .= "Images deleted successfully for barcode #" . $_SESSION["barcode"] . "!";
					
					require_once("template.php");
					printpagestart("Image Deletion Tool"); ?>
							<span class="<?php print_r($class);?>"><?php print_r($_SESSION["finalstring"]) ?></span>
							<br>
							<br>
							<button id="backtorecord">Back to record</button>
							<br>
							<a href="delimg.php"><button>Delete more images</button></a>
							<br>
							<a href="index.php"><button>Return to top page</button></a>
							<script src="navigateaway.js"></script>
					<?php printpageend();
					
					unset($_SESSION["finalstring"]);
					unset($_SESSION["barcode"]);
					unset($_SESSION["stmtresult"]);
					unset($_SESSION["imgs"]);
					
				}
				
				else {
					$class = "bad";
					$_SESSION["finalstring"] .= "(DB Update FAILED) ";
					$_SESSION["finalstring"] .= "Image deletion failed for barcode #" . $_SESSION["barcode"] . "!";
					
					require_once("template.php");
			
					printpagestart("Image Deletion Tool"); ?>
							<span class="<?php print_r($class);?>"><?php print_r($_SESSION["finalstring"]) ?></span>
							<br>
							<br>
							<button id="backtorecord">Back to record</button>
							<br>
							<a href="index.php"><button>Return to top page</button></a>
							<script src="navigateaway.js"></script>
					<?php printpageend();
					
					unset($_SESSION["finalstring"]);
					unset($_SESSION["barcode"]);
					unset($_SESSION["stmtresult"]);
					unset($_SESSION["imgs"]);
				}
			}
			
			catch(PDOException $e) {
				echo $e->getMessage();
				die();
			}
		}
		
		catch(PDOException $e) {
			$pdo->rollback();
			echo $e->getMessage();
			die();
		}
	}
	
	elseif(empty($_POST)) { 
	
	require_once("template.php");
	
	printpagestart("Confirmation"); ?>
						<span id="bad">WARNING!!! WARNING!!! WARNING!!!</span>
						<br>
						<br>
						<span>The following images will be</span>&nbsp;<span class="bad">DELETED PERMANENTLY</span><span>!!!</span><br><span>Please review the images below and make sure they are the ones you wish to delete.</span>
						<br>
						<br>
						<table id="imagestable">
							<tbody>
								<tr>
									<?php $oid_obverse = $_SESSION["stmtresult"]["img_obverse"];
									$oid_reverse = $_SESSION["stmtresult"]["img_reverse"];
									$oid_bonus1 = $_SESSION["stmtresult"]["img_bonus1"];
									$oid_bonus2 = $_SESSION["stmtresult"]["img_bonus2"];
									$oid_bonus3 = $_SESSION["stmtresult"]["img_bonus3"];
									$oid_bonus4 = $_SESSION["stmtresult"]["img_bonus4"];
									
									if(!empty($oid_obverse)) {
										$pdo->beginTransaction();
										$stream_obverse = $pdo->pgsqlLOBOpen($oid_obverse, 'r');
										$tempimg_obverse = base64_encode(stream_get_contents($stream_obverse));
										$mimetype_obverse = mime_content_type($stream_obverse);
										$img_obverse = "data:" . $mimetype_obverse . ";base64," . $tempimg_obverse;
										fclose($stream_obverse);
										$pdo->commit();
										
										$pdo->beginTransaction();
										$stream_reverse = $pdo->pgsqlLOBOpen($oid_reverse, 'r');
										$tempimg_reverse = base64_encode(stream_get_contents($stream_reverse));
										$mimetype_reverse = mime_content_type($stream_reverse);
										$img_reverse = "data:" . $mimetype_reverse . ";base64," . $tempimg_reverse;
										fclose($stream_reverse);
										$pdo->commit();
									}
									
									if(!empty($oid_bonus1)) {
										$pdo->beginTransaction();
										$stream_bonus1 = $pdo->pgsqlLOBOpen($oid_bonus1, 'r');
										$tempimg_bonus1 = base64_encode(stream_get_contents($stream_bonus1));
										$mimetype_bonus1 = mime_content_type($stream_bonus1);
										$img_bonus1 = "data:" . $mimetype_bonus1 . ";base64," . $tempimg_bonus1;
										fclose($stream_bonus1);
										$pdo->commit();
									}
									
									if(!empty($oid_bonus2)) {
										$pdo->beginTransaction();
										$stream_bonus2 = $pdo->pgsqlLOBOpen($oid_bonus2, 'r');
										$tempimg_bonus2 = base64_encode(stream_get_contents($stream_bonus2));
										$mimetype_bonus2 = mime_content_type($stream_bonus2);
										$img_bonus2 = "data:" . $mimetype_bonus2 . ";base64," . $tempimg_bonus2;
										fclose($stream_bonus2);
										$pdo->commit();
									}
									
									if(!empty($oid_bonus3)) {
										$pdo->beginTransaction();
										$stream_bonus3 = $pdo->pgsqlLOBOpen($oid_bonus3, 'r');
										$tempimg_bonus3 = base64_encode(stream_get_contents($stream_bonus3));
										$mimetype_bonus3 = mime_content_type($stream_bonus3);
										$img_bonus3 = "data:" . $mimetype_bonus3 . ";base64," . $tempimg_bonus3;
										fclose($stream_bonus3);
										$pdo->commit();
									}
									
									if(!empty($oid_bonus4)) {
										$pdo->beginTransaction();
										$stream_bonus4 = $pdo->pgsqlLOBOpen($oid_bonus4, 'r');
										$tempimg_bonus4 = base64_encode(stream_get_contents($stream_bonus4));
										$mimetype_bonus4 = mime_content_type($stream_bonus4);
										$img_bonus4 = "data:" . $mimetype_bonus4 . ";base64," . $tempimg_bonus4;
										fclose($stream_bonus4);
										$pdo->commit();
									} ?>
									<td><img id="obverse" src="<?php print_r($img_obverse);?>"></td>
									<td><img id="reverse" src="<?php print_r($img_reverse);?>"></td>
									<?php
										if(isset($img_bonus1)) { ?>
									<td><img id="bonus1" src="<?php print_r($img_bonus1);?>"></td>
										<?php }
										
										if(isset($img_bonus2)) { ?>
									<td><img id="bonus2" src="<?php print_r($img_bonus2);?>"></td>
										<?php }
										
										if(isset($img_bonus3)) { ?>
									<td><img id="bonus3" src="<?php print_r($img_bonus3);?>"></td>
										<?php }
										
										if(isset($img_bonus4)) { ?>
									<td><img id="bonus4" src="<?php print_r($img_bonus4);?>"></td>
										<?php }
									?>
								</tr>
							</tbody>
						</table>
						<br>
						<br>
						<span>Are you sure you wish to&nbsp;</span><span class="bad">PERMANENTLY DELETE</span><span>&nbsp;the above images?</span>
						<br>
						<br>
						<form action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
							<input type="hidden" value="submit" id="submit" name="submit">
							<button class="danger" type="submit">Yes</button>
						</form>
						<a href="delimg.php"><button type="button">No</button></a>
	<?php 
	printpageend();
	}
}

elseif(isset($_SESSION['string'])) { 
	require_once("template.php");
		
	printpagestart("Image Deletion Tool"); ?>
	<span><?php print_r($_SESSION['string']); ?></span>
	<br>
	<br>
	<a href="delimg.php"><button>Go back</button></a>
	<?php 
	printpageend();

	unset($_SESSION["string"]);
}

else {
	header("Location: delimg.php");
} ?>