<?php

require_once("globalvars.php");
require_once("template.php");

if(isset($_COOKIE['barcode'])) {
	setcookie("barcode", "", time() - 10);
}

if(isset($_SESSION["string"])) {
	if(is_array($_SESSION["string"])) {
		printpagestartnew("Retrieved Data"); ?>
			<div id="cover">Loading record...</div>
			<div id="header">
				<div id="form">
					<span id="scanline">Enter another ID to lookup here, or scan barcode on asset:</span>
					<form id="formitself" name="form" action="lookup.php" method="post">
						<input type="text" id="inputid" name="inputid" value="" autocomplete="off" autofocus="autofocus" pattern="\d*" maxlength="22" required>
						<input type="hidden" name="action" value="Submit">
						<button type="submit" class="navaway">Submit</button>
						<a href="takeapic.php" class="navaway mobileonly"><button class="mobileonly" type="button">Take A Picture</button></a>
					</form>
				</div>
				<div class="hrsplit"></div>
				<div id="buttons">
					<?php if(isset($_SESSION["string"]['description']) && !empty($_SESSION["string"]['description'])) { ?><button id="updaterecord" class="danger">Update This Record</button><?php } else { ?><button id="updaterecord" class="" >Create This Record</button><?php } if(isset($_SESSION["string"]['hasimg']) && !empty($_SESSION["string"]['hasimg'])) { ?><button id="deleteimage" class="danger">Delete Images</button><?php } else { ?><button class="" id="uploadimage">Upload Images</button><?php } ?>
					<a class="navaway" href="index.php"><button class="navaway" type="button">Return to top page</button></a>
				</div>
			</div>
			<div class="hrsplit"></div>
			<hr>
			<div class="hrsplit"></div>
		<?php
		require_once("outputs.php");
		printpageendnew();
		unset($_SESSION["requestedid"]);
		unset($_SESSION["string"]);
	}

	else { 
		printpagestartnew("Error!"); ?>
			<div id="header">
				<div id="form">
					<span id="scanline">Enter another ID to lookup here, or scan barcode on asset:</span>
					<form id="formitself" name="form" action="lookup.php" method="post">
						<input type="text" id="inputid" name="inputid" value="" autocomplete="off" autofocus="autofocus" pattern="\d*" maxlength="22" required>
						<input type="hidden" name="action" value="Submit">
						<button type="submit">Submit</button>
						<a href="takeapic.php" class="mobileonly"><button class="mobileonly" type="button">Take A Picture</button></a>
					</form>
				</div>
				<div class="hrsplit"></div>
				<div id="buttons">
					<a href="index.php"><button type="button">Return to top page</button></a>
				</div>
			</div>
			<div class="hrsplit"></div>
			<hr>
			<div class="hrsplit"></div>
			<div class="wrapper">
				<div class="main">
					<span><?php print_r($_SESSION['string']); ?></span>
				</div>
			</div>
<?php
		printpageendnew(); 
		unset($_SESSION["requestedid"]);
		unset($_SESSION["string"]);
	}
}

else {
	header("Location: index.php");
}

?>