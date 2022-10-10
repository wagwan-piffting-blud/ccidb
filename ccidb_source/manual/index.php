<?php

require_once("../tempnologin.php");
printpagestart("CCIDB Help/Manual"); ?>
				<span><img id="imhero" src="/assets/ogpcrop.png"></img></span>
                <br>
				<span>Have some questions on using CCIDB? You've come to the right place! Please select a topic below and click on it to learn more.</span>
				<br>
				<br>
				<div id="helptopics">
					<a href="gettingstarted.php"><button type="button">Getting Started</button></a>
					<a href="cataloging.php"><button type="button">Cataloging YOUR Collection</button></a>
					<br>
					<a href="record.php"><button type="button">The Record Screen</button></a>
					<a href="createupdate.php"><button type="button">Creating/Updating Records</button></a>
					<br>
					<a href="deletingrecords.php"><button type="button">Deleting Records</button></a>
					<a href="images.php"><button type="button">Uploading/Deleting Images</button></a>
					<br>
					<a href="search.php"><button type="button">The Search Function</button></a>
					<a href="stats.php"><button type="button">The Statistics Screen And Heatmap Function</button></a>
					<br>
					<a href="settings.php"><button type="button">Updating Your Settings</button></a>
					<a href="contact.php"><button type="button">Questions/Comments/Support</button></a>
				</div>
				<br>
				<a href="/index.php"><button type="button">Return to top page</button></a>
<?php printpageend(); ?>