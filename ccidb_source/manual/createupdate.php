<?php

require_once("../tempnologin.php");
printpagestart("Creating/Updating Records"); ?>
				<br>
				<span>Depending on if you're creating a record for the first time or updating one, the process remains mostly the same. The main differences between the two are that creating a record starts with a brand new barcode and the next line number (starting at 1 and going from there depending on how many records you have). Updating a record, meanwhile, will pull that record's info and put it into the text boxes on the page for you automatically. Let's look at each of these text boxes and see how they work in depth.</span>
				<br>
				<br>
				<span><a href="assets/create.png" target="_blank"><img class="manualimg" src="assets/create.png" alt="Create Record Screen" title="Create Record Screen"></img></a></span>
				<br>
				<br>
				<span><a href="assets/update.png" target="_blank"><img class="manualimg" src="assets/update.png" alt="Create Record Screen" title="Create Record Screen"></img></a></span>
				<br>
				<br>
				<span>First is a checkbox labeled "Needs new holder?". This is useful in cases where you need to need to put a coin into a new 2x2 or airtite or what have you for any reason.</span>
				<br>
				<br>
				<span><a href="assets/nnh.png" target="_blank"><img class="manualimg" src="assets/nnh.png" alt="Needs New Holder Checkbox" title="Needs New Holder Checkbox"></img></a></span>
				<br>
				<br>
				<span>Next are the previously mentioned barcode and line number text boxes, these are set to be read only to prevent corruption.</span>
				<br>
				<br>
				<span><a href="assets/datatext.png" target="_blank"><img class="manualimg" src="assets/datatext.png" alt="Barcode And Line Text Boxes" title="Barcode And Line Text Boxes"></img></a></span>
				<br>
				<br>
				<span>Now we have a box called "Type". What is "type"? It's the type of record you are adding or editing. The available choices for this field are: "Bill", "Coin", "Slab", "Special", "Token", and "Whitman". If you need a quick reference for the available types, simply hover over the word "Type" and it will give you the available types. Each type is used to refer to different kinds of items, but in general, these are:</span>
				<br>
				<br>
				<span>- Bill: Self explanatory, this can range from a simple, single dollar bill on up to any amount of "negotiable currency".</span>
				<br>
				<span>- Coin: Any singular coin.</span>
				<br>
			    <span>- Slab: Encapsulated and graded coins from any third party grader.</span>
				<br>
				<span>- Special: Anything else, reference materials such as books, large coin albums, you name it.</span>
				<br>
				<span>- Token: Any non-legal coin-shaped objects, including challenge coins and bullion rounds. Exonumia, as well.</span>
				<br>
				<span>- Whitman: Smaller coin books or albums, named after the Whitman company that produces such items.</span>
				<br>
				<br>
				<span><a href="assets/type.png" target="_blank"><img class="manualimg" src="assets/type.png" alt="Type Box" title="Type Box"></img></a></span>
				<br>
				<br>
				<span><a href="assets/typehover.png" target="_blank"><img class="manualimg" src="assets/typehover.png" alt="Type Hover" title="Type Hover"></img></a></span>
				<br>
				<br>
				<span>Moving on to the "Year" box, this one is pretty self explanatory, it's the year that a particular coin was issued.</span>
				<br>
				<br>
				<span><a href="assets/year.png" target="_blank"><img class="manualimg" src="assets/year.png" alt="Year Box" title="Year Box"></img></a></span>
				<br>
				<br>
				<span>After that, we have a box labeled "Mint Mark". This is for any mint (or privy) mark on a coin. For example, the "D" under the year of issue of most modern American coins represents the Denver, Colorado mint.</span>
				<br>
				<br>
				<span><a href="assets/mintmark.png" target="_blank"><img class="manualimg" src="assets/mintmark.png" alt="Mint Mark box" title="Mint Mark box"></img></a></span>
				<br>
				<br>
				<span>Then comes the "Denomination" box. Personally, I prefer having the denominations in the form of "CCSn", where "CC" is the 2 letter Country Code (discussed later, an example is "US"), "S" is the symbol (for example, "$"), and "n" is the amount (for example, "1.00" for a single dollar). This would make the final Denomination value "US$1.00". How you determine and add denomination values is totally up to you, though!</span>
				<br>
				<br>
				<span><a href="assets/denom.png" target="_blank"><img class="manualimg" src="assets/denom.png" alt="Denomination Box" title="Denomination Box"></img></a></span>
				<br>
				<br>
				<span>Countries come, countries go, but the recognized format for this field is any International Standards Organization (ISO) 2 letter country code. You can find a list of country codes <a href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements" target="_blank">here on Wikipedia</a>.</span>
				<br>
				<br>
				<span><a href="assets/country.png" target="_blank"><img class="manualimg" src="assets/country.png" alt="Country Of Origin Box" title="Country Of Origin Box"></img></a></span>
				<br>
				<br>
				<span>Composition and Composition Amounts were discussed in the previous section, but if you need a refresher, these fields take advantage of a free service called <a href="https://metals-api.com" target="_blank">Metals-API</a> that gets current melt prices for any precious metal coins. You can view the supported <a href="https://metals-api.com/currencies" target="_blank">metal composition codes here</a> and <a href="https://www.silver-calculator.com/" target="_blank">convert between pure and coin silver/gold here</a>.</span>
				<br>
				<br>
				<span><a href="assets/composition.png" target="_blank"><img class="manualimg" src="assets/composition.png" alt="Composition And Amount Boxes" title="Composition And Amount Boxes"></img></a></span>
				<br>
				<br>
				<span>Descriptions and Notes go together like chocolate and peanut butter, so they're shown in the same place as on the record page. Note that the Description field is required, whereas the Notes field is not.</span>
				<br>
				<br>
				<span><a href="assets/descnotestext.png" target="_blank"><img class="manualimg" src="assets/descnotestext.png" alt="Description And Notes Boxes" title="Description And Notes Boxes"></img></a></span>
				<br>
				<br>
				<span>Coming up next are the Third Party Grader (TPG) fields, such as grader, grade, and certification number. These are shown in a green box to indicate importance.</span>
				<br>
				<br>
				<span><a href="assets/tpgtext.png" target="_blank"><img class="manualimg" src="assets/tpgtext.png" alt="TPG Boxes" title="TPG Boxes"></img></a></span>
				<br>
				<br>
				<span>As previously discussed, the serial field is mostly intended for limited run coins or bills.</span>
				<br>
				<br>
				<span><a href="assets/serial.png" target="_blank"><img class="manualimg" src="assets/serial.png" alt="Serial Box (get it?)" title="Serial Box (get it?)"></img></a></span>
				<br>
				<br>
				<span>Location, Location, Location! All your coins have to be located/stored somewhere, so you can tell yourself where if you need.</span>
                <br>
                <br>
                <span><a href="assets/location.png" target="_blank"><img class="manualimg" src="assets/location.png" alt="Location Box" title="Location Box"></img></a></span>
				<br>
				<br>
				<span></span>
				<br>
				<br>
				<span><a href="assets/pcgsngc.png" target="_blank"><img class="manualimg" src="assets/pcgsngc.png" alt="Coinfacts And Coin Explorer Boxes" title="Coinfacts And Coin Explorer Boxes"></img></a></span>
				<br>
				<br>
				<span>Finally, the cost field includes your current currency symbol you picked in the settings, so all you need to type is the amount, like "20.00".</span>
				<br>
				<br>
				<span><a href="assets/cost.png" target="_blank"><img class="manualimg" src="assets/cost.png" alt="Cost Box" title="Cost Box"></img></a></span>
				<br>
				<br>
				<span>Next up, learn how to permanently delete records if the need arises.</span>
				<br>
				<br>
				<a href="record.php"><button>Previous Page: The Record Screen</button></a>
				<a href="deletingrecords.php"><button>Next Page: Deleting Records</button></a>
				<br>
				<a href="index.php"><button type="button">Return to manual index</button></a>
				<br>
				<br>
				<br>
<?php printpageend(); ?>