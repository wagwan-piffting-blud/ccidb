<?php

require_once("globalvars.php");

if($_SESSION["stmtresult"]["description"]) { 
	if(!empty($_POST)) { 
		$sql2 = "UPDATE " . $_SESSION["tablename"] . " SET nnh = 0, hasimg = 0, type = '', year = '', mint = '', denomination = '', country_of_origin = '', description = '', notes = '', tpg = '', grade = '', cert = '', serial = '', location = '', composition = '', composition_amount = '', melt = 0, pcgs_coinfacts = '', ngc_coin_explorer = '', cost = '', img_obverse = '', img_reverse = '', img_bonus1 = '', img_bonus2 = '', img_bonus3 = '', img_bonus4 = '' WHERE barcode = :barcode;";
		$_SESSION["finalstring"] = "";
		
		try {
			$pdo->beginTransaction();
			
			if($_SESSION["stmtresult"]["img_obverse"]) {
				$oid1 = $_SESSION["stmtresult"]["img_obverse"];
				$pdo->pgsqlLOBUnlink($oid1);
				
				$oid2 = $_SESSION["stmtresult"]["img_reverse"];
				$pdo->pgsqlLOBUnlink($oid2);
			}
			
			else {
				$oid1 = "";
				$_SESSION["imgs"]["img_obverse"] = "";
				$oid2 = "";
				$_SESSION["imgs"]["img_reverse"] = "";
			}
			
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
					$_SESSION["finalstring"] .= "Record deleted successfully for barcode #" . $_SESSION["barcode"] . "!";
					
					require_once("template.php");
					printpagestart("Record Deletion Tool"); ?>
							<span class="<?php print_r($class);?>"><?php print_r($_SESSION["finalstring"]) ?></span>
							<br>
							<br>
							<button id="backtorecord">Back to record</button>
							<br>
							<a href="delrecord.php"><button>Delete more images</button></a>
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
					$_SESSION["finalstring"] .= "Record deletion failed for barcode #" . $_SESSION["barcode"] . "!";
					
					require_once("template.php");
			
					printpagestart("Record Deletion Tool"); ?>
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
		printpagestartnew("Confirmation"); ?>
						<div id="cover">Loading record...</div>
						<div id="top">
							<span>WARNING!!! WARNING!!! WARNING!!!</span>
							<br>
							<span>The following record's data will be&nbsp;<span class="bad">DELETED PERMANENTLY</span>!!!</span>
							<br>
							<span>Please review the record below and make sure it is the one you wish to delete.</span>
							<br>
							<span>Please note that the record's line and barcode numbers will still be present in the database so you may reuse the record at a later time, however, all of the other data will be deleted.</span>
							<br>
							<span class="invisible">This is just here to make sure the above lines are all centered. Also, hi!</span>
						</div>
						<div class="hrsplit"></div>
						<hr>
						<div class="hrsplit"></div>
						<?php require_once("outputs.php"); ?>
						<div class="hrsplit"></div>
						<hr>
						<div class="hrsplit"></div>
						<div id="bottom">
							<span>Are you sure you wish to&nbsp;<span class="bad">PERMANENTLY DELETE</span>&nbsp;the above record?</span>
							<form action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
								<input type="hidden" value="submit" id="submit" name="submit">
								<button class="danger" type="submit">Yes</button>
							</form>
							<a href="delrecord.php"><button type="button">No</button></a>
						</div>
		<?php 
		printpageendnew();
	}
}

elseif(isset($_SESSION['string'])) { 
	require_once("template.php");
	printpagestart("Record Deletion Tool"); ?>
	<span><?php print_r($_SESSION['string']); ?></span>
	<br>
	<br>
	<a href="delrecord.php"><button>Go back</button></a>
	<?php 
	printpageend();
	unset($_SESSION["string"]);
}

else {
	header("Location: delrecord.php");
} ?>