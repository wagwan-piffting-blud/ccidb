<?php

require_once("globalvars.php");

$missingfields = "You appear to be missing some fields, please try again.";
if(isset($_SESSION["statusstring"]) && $_SESSION["statusstring"] != "") { 
	require_once("template.php");
	printpagestart("Record Update"); ?>
				<span class=<?php print_r($_SESSION["statusclass"]); ?>><?php print_r($_SESSION['statusstring']);?></span>
				<br>
				<button id="<?php if($_SESSION["statusstring"] === $missingfields) { print_r("back"); } else { print_r("backtorecord"); } ?>">Back <?php if($_SESSION["statusstring"] === $missingfields) { print_r(""); } else { print_r("to record"); } ?></button>
				<br>
				<?php if($_SESSION["statusstring"] != $missingfields) { ?>
					<form name="form" action="update.php" method="post">
						<button type="submit">Add a new record</button>
					</form>
				<?php } ?>
				<a href="index.php"><button type="button">Return to top page</button></a>
				<script src="navigateaway.js"></script>
<?php 
	printpageend();

	if(isset($_SESSION["postdata"])) {
		unset($_SESSION["statusstring"]);
		unset($_SESSION["statusclass"]);
		unset($_SESSION["postdata"]);
	}

	elseif(!isset($_SESSION["postdata"])) {
		unset($_SESSION["statusstring"]);
		unset($_SESSION["statusclass"]);
	}
}

else { 
	header("Location: update.php"); 
} ?>