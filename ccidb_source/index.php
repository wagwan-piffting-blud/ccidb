<?php

require_once("globalvars.php");

require_once("template.php");
printpagestart("CCIDB (Version " . $version . ")"); ?>
				<span><img id="imhero" src="/assets/ogpcrop.png"></img></span>
                <br>
				<span>Enter an ID to lookup here, or scan barcode on asset:</span>
				<br>
				<br>
				<form name="form" action="lookup.php" method="post">
					<input type="text" id="inputid" name="inputid" value="" autocomplete="off" autofocus="autofocus" pattern="\d*" maxlength="22" required>
					<button type="submit">Submit</button>
					<br class="mobileonly">
					<a href="takeapic.php" class="mobileonly"><button class="mobileonly" type="button">Take A Picture</button></a>
				</form>
				<br>
				<span>Supported formats: UPC-A (12 digits); Line number (1-5 digits)</span>
				<br>
				<br>
				<button id="toolsbutton">Show tools</button>
				<br>
				<div id="tools">
					<a href="update.php"><button type="button">Create a record</button></a>
					<a href="delrecord.php"><button type="button" class="danger">Delete a record</button></a>
					<br>
					<a href="upload.php"><button type="button">Upload images</button></a>
					<a href="delimg.php"><button type="button" class="danger">Delete images</button></a>
					<br>
					<a href="search.php"><button type="button">Search for a record</button></a>
					<a href="generate.php"><button type="button">Generate new barcodes</button></a>
					<br>
					<a href="stats.php"><button type="button">Statistics</button></a>
					<a href="settings.php"><button type="button" class="danger">Update settings</button></a>
					<br>
					<a href="#"><button type="button">Backup/Restore (coming soon!)</button></a>
				</div>
				<div id="about">
					<span>
					    <span><a href="manual">View Help Manual</a></span>&nbsp;
					    <span><a href="about.php">About CCIDB...</a></span>&nbsp;
					    <span><a href="logout.php">Log out</a></span>
					</span>
				</div>
				<script src="tools.js"></script>
<?php printpageend(); ?>