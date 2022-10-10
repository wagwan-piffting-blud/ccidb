<?php

require_once("globalvars.php");

if(isset($_SESSION["string"])) { 
	require_once("template.php");
	printpagestart("Upload Status"); ?>
				<span class="<?php print_r($_SESSION["status"]);?>"><?php print_r($_SESSION["string"]); ?></span>
				<br>
				<br>
				<button id="backtorecord">Back to record</button>
				<br>
				<a href="upload.php"><button type="button">Upload more images</button></a>
				<br>
				<a href="index.php"><button type="button">Return to top page</button></a>
				<script src="navigateaway.js"></script>
<?php
	printpageend();
	unset($_SESSION["string"]);
	unset($_SESSION["status"]);
}

else {
	header("Location: upload.php");
} ?>