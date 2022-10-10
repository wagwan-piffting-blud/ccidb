<?php

//Basic variable declaration.
require_once("globalvars.php");

//Country counter.
$countries = "";
$countrycount = 0;
$sql = "SELECT DISTINCT country_of_origin FROM " . $_SESSION["tablename"] . " WHERE country_of_origin IS NOT NULL AND country_of_origin != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		while($row = $stmt->fetch()) {
			$countrycount++;
		}
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

//Record counter.
$sql = "SELECT COUNT(type) FROM " . $_SESSION["tablename"] . " WHERE type IS NOT NULL AND type != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$recordcount = $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

//Image counter.
$sql = "SELECT COUNT(img_obverse) FROM " . $_SESSION["tablename"] . " WHERE img_obverse IS NOT NULL AND img_obverse != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$runningman = $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$sql = "SELECT COUNT(img_reverse) FROM " . $_SESSION["tablename"] . " WHERE img_reverse IS NOT NULL AND img_reverse != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$runningman += $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$sql = "SELECT COUNT(img_bonus1) FROM " . $_SESSION["tablename"] . " WHERE img_bonus1 IS NOT NULL AND img_bonus1 != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$runningman += $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$sql = "SELECT COUNT(img_bonus2) FROM " . $_SESSION["tablename"] . " WHERE img_bonus2 IS NOT NULL AND img_bonus2 != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$runningman += $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$sql = "SELECT COUNT(img_bonus3) FROM " . $_SESSION["tablename"] . " WHERE img_bonus3 IS NOT NULL AND img_bonus3 != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$runningman += $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$sql = "SELECT COUNT(img_bonus4) FROM " . $_SESSION["tablename"] . " WHERE img_bonus4 IS NOT NULL AND img_bonus4 != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$runningman += $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

//Number of records that have images.
$sql = "SELECT COUNT(hasimg) FROM " . $_SESSION["tablename"] . " WHERE hasimg IS NOT NULL AND hasimg != '0' AND type IS NOT NULL AND type != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$recordimagecount = $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

//Number of records that do NOT have images.
$sql = "SELECT COUNT(hasimg) FROM " . $_SESSION["tablename"] . " WHERE hasimg IS NOT NULL AND hasimg != '1' AND type IS NOT NULL AND type != '' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$row = $stmt->fetch();
		$recordnoimagecount = $row["count"];
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

//Cost calculator.
$sql = "SELECT SUM(cost::money) FROM " . $_SESSION["tablename"] . " WHERE cost IS NOT NULL AND cost != '' AND cost != '0' AND line != 123456;";

try {
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt = $pdo->prepare($sql);
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $stmt->execute();
	
	if($result) {
		$costtotal = $stmt->fetch();
		$costtotal = $costtotal["sum"];
		$costtotal = str_replace("$", "", $costtotal);
		if(empty($costtotal)) {
			$costtotal = "0.00";
		}
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

//Line counter, requires.
chdir("requires/");
$directory = getcwd();
$phplinecount = 0;
$jslinecount = 0;
$scanned_directory = array_diff(scandir($directory), array('..', '.'));

if(is_array($scanned_directory)) {
	foreach($scanned_directory as $key => $file) {
		if(preg_match("/.php$/", $file)) {
			$handleFile = fopen($file, "r");
			
			while(!feof($handleFile)){
			  $line = fgets($handleFile);
			  $phplinecount++;
			}
			
			fclose($handleFile);
		}
		elseif(preg_match("/.js$/", $file)) {
			$handleFile2 = fopen($file, "r");
			
			while(!feof($handleFile2)){
			  $line2 = fgets($handleFile2);
			  $jslinecount++;
			}
			
			fclose($handleFile2);
		}
	}
}

//Line counter, main.
chdir("../");
$directory = getcwd();
$phplinecount = 0;
$jslinecount = 0;
$scanned_directory = array_diff(scandir($directory), array('..', '.'));

if(is_array($scanned_directory)) {
	foreach($scanned_directory as $key => $file) {
		if(preg_match("/.php$/", $file)) {
			$handleFile = fopen($file, "r");
			
			while(!feof($handleFile)){
			  $line = fgets($handleFile);
			  $phplinecount++;
			}
			
			fclose($handleFile);
		}
		elseif(preg_match("/.js$/", $file)) {
			$handleFile2 = fopen($file, "r");
			
			while(!feof($handleFile2)){
			  $line2 = fgets($handleFile2);
			  $jslinecount++;
			}
			
			fclose($handleFile2);
		}
	}
}

require_once("template.php");
printpagestart("Statistics"); ?>
<span>This instance of CCIDB is currently running version <?php print_r($version) ?>, with a total of <?php print_r(number_format($phplinecount)); ?> lines of PHP and <?php print_r(number_format($jslinecount)); ?> lines of JavaScript.</span>
<br>
<br>
<span>Total number of active records: <?php print_r(number_format($recordcount)); ?>.</span>
<br>
<br>
<span>Of all these records, there are a total of <a href="map.php"><?php print_r($countrycount); ?> countries represented</a>.</span>
<br>
<br>
<span>Currently, there are <?php print_r(number_format($recordimagecount)); ?> records imaged, with a total of <?php print_r(number_format($runningman)); ?> images spanning those records. This also means there are only <?php print_r(number_format($recordnoimagecount)); ?> records without images.</span>
<br>
<br>
<span>Did you know... you have spent a total of <span id="spoiler"><?php print_r($_SESSION['currencysymbol'] . $costtotal); ?></span><span id="spoiler2">(click to reveal)</span> on coins so far! Take that information how you will.</span>
<br>
<br>
<a href="index.php"><button>Return to top page</button></a>
<script src="spoiler.js"></script>
<?php printpageend(); ?>