<?php

require_once("globalvars.php");

$final = "";
$mycount = 0;

if(isset($_SESSION['result']) && is_array($_SESSION['result']) && !empty($_SESSION['result'])) {
	$arraycount = count($_SESSION['result']);
	 
	function custom_sort($a,$b) {
		return $a['line']>$b['line'];
	}
	
	usort($_SESSION['result'], "custom_sort");
	
	$mycount = count($_SESSION['result']);
	
	$mycount2 = count($_SESSION['result'][0]);
	
	for($i = 0; $i < $mycount; $i++) {
		for($i2 = 0; $i2 < $mycount2; $i2++) {
			$_SESSION['result'][$i][$i2] = "";
			
			if ($_SESSION['result'][$i][$i2] == "") {
				unset($_SESSION['result'][$i][$i2]);
			}
		}
	}
	
	$_SESSION['result'] = array_filter($_SESSION['result']);
	
	$mycount = count($_SESSION['result']);
	
	preg_match('/(\d)\D*$/', $_SESSION['nrows'], $m);
	$lastnum = $m[1];
}

else {
	$_SESSION['result'] = "";
}

if(isset($_SESSION['statusstring']) && !empty($_SESSION['statusstring']) && isset($_GET['startat']) && $_GET['startat'] != "" && isset($_GET['pagesize']) && !empty($_GET['pagesize']) && is_array($_SESSION["result"]) && !empty($_SESSION["result"])) { 
	require_once("template.php");
	printpagestartnew("Search Results"); ?>
	<div id="cover"><span>Loading search results...</span></div>
	<script src="removecover.js"></script>
	<div class="supercentercont">
		<div class="supercenter">
			<?php
				if($_GET['pagesize'] == 10) {
					if(($_GET['startat'] + 20) >= $_SESSION["nrows"]) {
						$setlastnum = true;
					}
					
					if($_GET['startat'] == 0 && (($_GET['startat'] + 10) <= ($_SESSION["nrows"] - 1))) { ?>
						<div class="flexbox-search">
							<span class="invisible"><button class="">############<?php if(($_GET['startat'] + 10) >= (($_SESSION["nrows"] - $lastnum) / 10)) { print_r($lastnum); } else { print_r($_GET['pagesize']); } ?> record<?php if($_GET['pagesize'] > 1 || $_GET['pagesize'] == 0) { print_r("s"); } else { print_r(""); } ?></button></span>
							<span><?php print_r($_SESSION['statusstring']); ?><br>You are on records #<?php print_r(($_GET['startat'] + 1) . "-"); if(($_GET['startat'] + 10) >= ($_SESSION["nrows"] - 1)) { print_r($_SESSION['nrows']); } else { print_r($_GET['startat'] + 10); } ?>/<?php print_r($_SESSION['nrows']); ?>.</span>
							<span><a class="" href="searchresults.php?startat=<?php print_r($_GET['startat'] + 10); ?>&pagesize=10"><button class="">Go forward<span class="invisible">0</span> <?php if(isset($setlastnum) && $setlastnum === true) { print_r($lastnum); } else { print_r($_GET['pagesize']); } ?> record<?php if($_GET['pagesize'] > 1 || $_GET['pagesize'] == 0) { print_r("s"); } else { print_r(""); } ?></button></a></span>
						</div>
						<hr>
					<?php 
						if($_GET['startat'] == 0) {
							$_SESSION['oldstart'] = 0;
						}
						
						elseif($_GET['startat'] > $_SESSION['oldstart']) {
							$_SESSION['oldstart'] = $_GET['startat'] - 10;
						}
						
						else {
							$_SESSION['oldstart'] = $_GET['startat'] + 10;
						}
					}
					
					elseif($_GET['startat'] == 0 && ($_GET['startat'] + 10) >= ($_SESSION["nrows"] - 1)) { ?>
						<div class="flexbox-search">
							<span class="invisible"><button class="">############<?php if(($_GET['startat'] + 10) >= (($_SESSION["nrows"] - $lastnum) / 10)) { print_r($lastnum); } else { print_r($_GET['pagesize']); } ?> record<?php if($_GET['pagesize'] > 1 || $_GET['pagesize'] == 0) { print_r("s"); } else { print_r(""); } ?></button></span>
							<span><?php print_r($_SESSION['statusstring']); ?><br>You are on records #<?php print_r(($_GET['startat'] + 1) . "-"); if(($_GET['startat'] + 10) >= ($_SESSION["nrows"] - 1)) { print_r($_SESSION['nrows']); } else { print_r($_GET['startat'] + 10); } ?>/<?php print_r($_SESSION['nrows']); ?>.</span>
							<span class="invisible"><button class="">############<?php if(($_GET['startat'] + 10) >= (($_SESSION["nrows"] - $lastnum) / 10)) { print_r($lastnum); } else { print_r($_GET['pagesize']); } ?> record<?php if($_GET['pagesize'] > 1 || $_GET['pagesize'] == 0) { print_r("s"); } else { print_r(""); } ?></button></span>
						</div>
						<hr>
					<?php 
						if($_GET['startat'] == 0) {
							$_SESSION['oldstart'] = 0;
						}
						
						elseif($_GET['startat'] > $_SESSION['oldstart']) {
							$_SESSION['oldstart'] = $_GET['startat'] - 10;
						}
						
						else {
							$_SESSION['oldstart'] = $_GET['startat'] + 10;
						}
					}
					
					elseif(($_GET['startat'] + 10) >= $_SESSION["nrows"]) { ?>
						<div class="flexbox-search">
							<span><a class="" href="searchresults.php?startat=<?php print_r($_GET['startat'] - 10); ?>&pagesize=10"><button class="">Go backward <?php print_r($_GET['pagesize']); ?> record<?php if($_GET['pagesize'] > 1 || $_GET['pagesize'] == 0) { print_r("s"); } else { print_r(""); } ?></button></a></span>
							<span><?php print_r($_SESSION['statusstring']); ?><br>You are on records #<?php print_r(($_GET['startat'] + 1) . "-"); if(($_GET['startat'] + 10) >= ($_SESSION["nrows"] - 1)) { print_r($_SESSION['nrows']); } else { print_r($_GET['startat'] + 10); } ?>/<?php print_r($_SESSION['nrows']); ?>.</span>
							<span class="invisible"><button class="">############<?php if(($_GET['startat'] + 10) >= (($_SESSION["nrows"] - $lastnum) / 10)) { print_r($lastnum); } else { print_r($_GET['pagesize']); } ?> record<?php if($_GET['pagesize'] > 1 || $_GET['pagesize'] == 0) { print_r("s"); } else { print_r(""); } ?></button></span>
						</div>
						<hr>
					<?php 
						if($_GET['startat'] == 0) {
							$_SESSION['oldstart'] = 0;
						}
						
						elseif($_GET['startat'] > $_SESSION['oldstart']) {
							$_SESSION['oldstart'] = $_GET['startat'] - 10;
						}
						
						else {
							$_SESSION['oldstart'] = $_GET['startat'] + 10;
						}
					}
					
					else { ?>
						<div class="flexbox-search">
							<span><a class="" href="searchresults.php?startat=<?php print_r($_GET['startat'] - 10); ?>&pagesize=10"><button class="">Go backward <?php print_r($_GET['pagesize']); ?> record<?php if($_GET['pagesize'] > 1 || $_GET['pagesize'] == 0) { print_r("s"); } else { print_r(""); } ?></button></a></span>
							<span><?php print_r($_SESSION['statusstring']); ?><br>You are on records #<?php print_r(($_GET['startat'] + 1) . "-"); if(($_GET['startat'] + 10) >= $_SESSION["nrows"]) { print_r($_SESSION['nrows']); } else { print_r($_GET['startat'] + 10); } ?>/<?php print_r($_SESSION['nrows']); ?>.</span>
							<span><a class="" href="searchresults.php?startat=<?php print_r($_GET['startat'] + 10); ?>&pagesize=10"><button class="">Go forward<span class="invisible">0</span> <?php if(isset($setlastnum) && $setlastnum === true) { print_r($lastnum); } else { print_r($_GET['pagesize']); } ?> record<?php if($_GET['pagesize'] > 1 || $_GET['pagesize'] == 0) { print_r("s"); } else { print_r(""); } ?></button></a></span>
						</div>
						<hr>
					<?php 
						if($_GET['startat'] == 0) {
							$_SESSION['oldstart'] = 0;
						}
						
						elseif($_GET['startat'] > $_SESSION['oldstart']) {
							$_SESSION['oldstart'] = $_GET['startat'] - 10;
						}
						
						else {
							$_SESSION['oldstart'] = $_GET['startat'] + 10;
						}
					}
				} 
			?>
		</div>
	</div>
	<?php require("outputs.php"); ?>
	<hr>
	<div class="supercentercont">
		<div class="supercenter">
			<form name="form" action="search.php" method="post">
				<button class="navaway" type="submit">Back to search</button>
			</form>
			<a class="navaway" href="index.php"><button class="navaway" type="button">Return to top page</button></a>
		</div>
	</div>
	<script src="navigateaway.js"></script>
<?php
printpageendnew();
}

elseif(isset($_SESSION['statusstring']) && !is_array($_SESSION['result'])) {
	require_once("template.php");
	printpagestart("Search failed!"); ?>
	<span class="bad"><?php print_r($_SESSION['statusstring']); ?></span>
	<hr>
	<form name="form" action="search.php" method="post">
		<button type="submit">Back to search</button>
	</form>
	<a href="index.php"><button type="button">Return to top page</button></a>
<?php 
}

else { 
	header("Location: search.php");
}
?>