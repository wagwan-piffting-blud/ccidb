<?php

require_once("globalvars.php");

function echodoc() {
		require_once("template.php");
		$_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32)); 
		unset($_SESSION['statusstring']);
		unset($_SESSION['result']);
		unset($_SESSION['i3']);
		unset($_SESSION['tens']);
		printpagestartnew("Search"); ?>
				<br>
				<div class="supercentercont">
				    <div class="supercenter">
                        <span>Here you can search for records by any of the following available fields:</span>
				    </div>
				</div>
				<br>
				<?php require_once("outputs.php"); ?>
				<div class="supercentercont">
				    <div class="supercenter">
                        <button type="submit" form="searchform">Submit</button>
				        <a href="index.php" id="navaway"><button type="button">Return to top page</button></a>  
				    </div>
				</div>
				<script src="enter.js"></script>
				<script src="navigateaway.js"></script>
		<?php
		printpageendnew();
		}

$runcount = 0;

if(isset($_POST['csrf'])) {
	if(isset($_SESSION['csrf']) && $_POST['csrf'] === $_SESSION['csrf']) {
		$_SESSION['result'] = array();
		
		$_SESSION['pagesize'] = $_POST['rpp'];
		
		if(isset($_POST['nnh'])) {
			$nnh = 1;
		}
		
		$sql = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE ";
		
		require_once("databasevars.php");
		
		if($sql != "SELECT * FROM " . $_SESSION["tablename"] . " WHERE ") {
			try {
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				
				$stmt = $pdo->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);

				$_POST["nnh"] = 1;
				
				foreach($allcolumns as $ident => $data) {
					if($ident === "img_obverse" || $ident === "img_reverse" || $ident === "img_bonus1" || $ident === "img_bonus2" || $ident === "img_bonus3" || $ident === "img_bonus4") {
						$skipme = 1;
					}
					
					else {
						$skipme = 0;
					}
					
					if($skipme === 0) {
						if(preg_match("/:" . $ident . "/", $sql)) {
							$stmt->bindValue(":" . $ident, $_POST[$ident]);
						}
					}
				}
				
				$result = $stmt->execute();
				
				/*var_dump(get_defined_vars());
				die();*/
				
				if($result) {
					$nrows = 0;
					$_SESSION["result"] = $stmt->fetchAll();
					$_SESSION['nrows'] = count($_SESSION["result"]);
					if($_SESSION['nrows'] > 0) {
						$_SESSION['statusstring'] = "Results: " . $_SESSION['nrows'] . ".";
						header("Location: searchresults.php?startat=0&pagesize=" . $_SESSION['pagesize']);
					}
					
					else {
						$_SESSION['statusstring'] = "No results.";
						$_SESSION["result"] = "";
						header("Location: searchresults.php");
					}
				}
				
				else {
					$_SESSION['statusstring'] = "Search failed.";
					$_SESSION["result"] = "";
					header("Location: searchresults.php");
				}
			}
		
			catch(PDOException $e) {
				echo $e->getMessage();
				die();
			}
		}
		
		else {
			$_SESSION['statusstring'] = "You did not enter anything to search for!";
			$_SESSION["result"] = "";
			header("Location: searchresults.php");
		}
	}
	
	else {
		echodoc();
		
	}
}

else {
	echodoc();
}
?>