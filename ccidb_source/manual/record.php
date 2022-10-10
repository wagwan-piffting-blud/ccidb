<?php

require_once("../tempnologin.php");
printpagestart("The Record Screen"); ?>
				<br>
				<span>The mighty record. Everything you need to know about a single coin, or slab, or coin album, or... what have you! </span>
				<br>
				<br>
				<span>Let's take a deeper look at that record screen, using the same "test" record we have.</span>
				<br>
				<br>
				<span><a href="assets/testrecord.png" target="_blank"><img class="manualimg" src="assets/testrecord.png" alt="Record Screen" title="Record Screen"></img></a></span>
				<br>
				<br>
				<span>Starting at the very top, we have where you can search for your coins, either by barcode or by line number. This is especially helpful if you have a setup consisting of a basic barcode scanner hooked up to your computer. Also note the buttons where you can update the record and upload/delete images. As well, a "return to home" button is present for convenience.</span>
				<br>
				<br>
				<span><a href="assets/header.png" target="_blank"><img class="manualimg" src="assets/header.png" alt="Record Screen Header" title="Record Screen Header"></img></a></span>
				<br>
				<br>
				<span>Next, we have the data line, mentioned in the previous page on the guide. Pretty self-explanatory, but very helpful nonetheless.</span>
				<br>
				<br>
				<span><a href="assets/dataline.png" target="_blank"><img class="manualimg" src="assets/dataline.png" alt="Record Screen Data Line" title="Record Screen Data Line"></img></a></span>
				<br>
				<br>
				<span>Now we make our way to the images section, where your coins can be shown off for others to see without having to worry about them mishandling it. You can upload up to 6 images total, with a total upload limit of 60MB (10 MB per image).</span>
				<br>
				<br>
				<span><a href="assets/imgs.png" target="_blank"><img class="manualimg" src="assets/imgs.png" alt="Record Screen Images" title="Record Screen Images"></img></a></span>
				<br>
				<br>
				<span>All the info you need to know about the coin, such as year, mintmark, etc. will be displayed below the image. If you want a current overview of melt prices for things like gold and silver coins, you can do that too with the power of a Metals-API key! <a href="https://metals-api.com/" target="_blank">Metals-API</a> is a free service which provides "up to the minute" melt prices (free accounts are limited to hourly updates). All you need to do to enable this is have the <a href="https://metals-api.com/currencies" target="_blank">metal composition code</a> in the Composition field (for example, "XAU" for Pure Gold and "XAG" for Pure Silver), and the amount in ounces (a "pure" ounce conversion chart is below, or you can visit <a href="https://www.silver-calculator.com/" target="_blank">this website</a> to convert coin silver to pure silver ounces). Once you input this info and check the button in the "Create/Update Record" screen, you will have "live" melt prices at your fingertips!</span>
				<br>
				<br>
				<span><a href="assets/allinfo.png" target="_blank"><img class="manualimg" src="assets/allinfo.png" alt="Record Screen Info" title="Record Screen Info"></img></a></span>
				<br>
				<br>
				<span><a href="assets/allinfomelt.png" target="_blank"><img class="manualimg" src="assets/allinfomelt.png" alt="Record Screen Info With Metals-API Key" title="Record Screen Info With Metals-API Key"></img></a></span>
				<br>
				<br>
				<span><a href="assets/ozconvert.png" target="_blank"><img class="manualimg" src="assets/ozconvert.png" alt="Ounces Conversion Chart" title="Ounces Conversion Chart"></img></a></span>
				<br>
				<br>
				<span>After that, we move to the description and notes. How are they different? The description is, well, a literal description of the coin in question (for example, "Draped Bust Half Cent" for a half cent made between 1800-1808). This can be helpful in situations where you need a coin identified, and you can save that information for later. Notes, on the other hand, are your own observations and comments. For example, "has a scratch on obverse" or "major die break reverse".</span>
				<br>
				<br>
				<span><a href="assets/descnotes.png" target="_blank"><img class="manualimg" src="assets/descnotes.png" alt="Record Screen Description/Notes" title="Record Screen Description/Notes"></img></a></span>
				<br>
				<br>
				<span>CCIDB supports info about graded coins too! This is under a special green box with 3 fields, TPG (meaning "Third Party Grader", for example, "PCGS" or "NGC"), Grade (all the way from "PO 01" to "MS 70", including distinguishers like "UCAM" or "DMPL"), and the certification number for the graded coin. In a large majority of cases, CCIDB will also generate a link to the coin on the grader's website! This way, you can always verify with the grader themselves in addition to the info in CCIDB.</span>
				<br>
				<br>
				<span><a href="assets/tpginfo.png" target="_blank"><img class="manualimg" src="assets/tpginfo.png" alt="Record Screen TPG Info" title="Record Screen TPG Info"></img></a></span>
				<br>
				<br>
				<span>We're almost done! To finish up, we have some miscellaneous fields, which we will quickly go over. "Serial" is primarily for bills, but can be applied to limited run coins that are numbered (like "001/500" for the first coin out of a limited run of 500). Location is pretty self explanatory, you can keep track of where you put your coins if you wish (for example, "Living Room" or "Upstairs Safe" or whatever you can think of). PCGS Coinfacts and NGC Coin Explorer are also very self explanatory. In the case of PCGS graded coins, the Coinfacts number is printed on the slab near the barcode. For example, say you have a slab that says "4321.56/12345678" near the barcode. This means the Coinfacts number is "4321", the grade is "AU 56", and the Certification number is "12345678". Simple! While NGC graded coins do not feature the Coin Explorer number near the barcode/certification number, it can be found on NGC's website when viewing a graded coin's details. Finally, we have the Cost field, which is displayed with the currency symbol you set when you first start using CCIDB. This can be changed any time in the settings as well!</span>
				<br>
				<br>
				<span><a href="assets/extrainfo.png" target="_blank"><img class="manualimg" src="assets/extrainfo.png" alt="Record Screen Extra Info" title="Record Screen Extra Info"></img></a></span>
				<br>
				<br>
				<span>And that covers the entire record screen! Next, we'll click the "Update Record" button and find out what that process looks like (hint: it's much simpler than you think!).</span>
                <br>
                <br>
				<a href="cataloging.php"><button>Previous Page: Cataloging YOUR Collection</button></a>
				<a href="createupdate.php"><button>Next Page: Creating/Updating Records</button></a>
				<br>
				<a href="index.php"><button type="button">Return to manual index</button></a>
				<br>
				<br>
<?php printpageend(); ?>