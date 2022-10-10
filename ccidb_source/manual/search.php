<?php

require_once("../tempnologin.php");
printpagestart("The Search Function"); ?>
				<br>
				<span>Let's say you forgot what line number or barcode a record is under. No worries! You can use the search function to find out based on any of the other criteria. For example, say you know the coin is a 1999 penny. All you need to do is type "1999" into the year box and you'll get ALL of your coins made in 1999 (of course, as long as the year field is properly filled out!) Pretty neat, right?</span>
				<br>
				<br>
				<span><a href="assets/search.png" target="_blank"><img class="manualimg" src="assets/search.png" alt="Search Screen" title="Search Screen"></img></a></span>
				<br>
				<br>
				<span><a href="assets/searchresults.png" target="_blank"><img class="manualimg" src="assets/searchresults.png" alt="Search Results Screen" title="Search Results Screen"></img></a></span>
				<br>
				<br>
				<span>You can also search through multiple criteria at once. So, for example, you can type "1999" and "US" into the year and country of origin boxes and you'll ONLY get your US coins made in 1999, none of your world coins made that year if you have any. Please keep the following in mind when using this function:</span>
				<br>
				<br>
				<span>- Search results are 10/page, and you can page through all the results using the buttons that appear near the top left and right of the page.</span>
				<br>
				<span>- The search function uses the "is like" operator. This means if, for example, you only type "a" into the description box, you may potentially get A LOT of results. This is great if you're looking for a lot of coins at once, but may have a performance impact on your computer, ESPECIALLY if you have rather large images uploaded for all those records. Search wisely!</span>
				<br>
				<br>
				<span>Let's jump on ahead to the statistics and heatmapping functions.</span>
                <br>
                <br>
				<a href="images.php"><button>Previous Page: Uploading/Deleting Images</button></a>
				<a href="stats.php"><button>Next Page: The Statistics Screen And Heatmap Function</button></a>
				<br>
				<a href="index.php"><button type="button">Return to manual index</button></a>
				<br>
				<br>
				<br>
<?php printpageend(); ?>