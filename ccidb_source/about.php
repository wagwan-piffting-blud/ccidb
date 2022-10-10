<?php

require_once("tempnologin.php");
printpagestart("More About CCIDB"); ?>
	<br>
	<span>About me and CCIDB:</span>
	<br>
	<br>
	<span><img src="wags.png" alt="My Logo" title="My Logo" id="wagslogo"></img></span>
	<br>
	<br>
	<span>I am very bad at writing in the third person, so here's a first person perspective about me, and about CCIDB. Most people call me Wags (or Wagwan), but Wags is what I personally like more, so you can refer to me as that. All you need to know about me is that I like crypto (as in cryptography, never cryptocurrency) puzzles and ARGs (Alternate Reality Games) and the like. I maintain a personal website which you can visit <a href="https://wagspuzzle.space/" class="new_window">here</a>. It's got things like puzzles, a blog, and some other, future content coming Soon™. But that's enough backstory, more about how CCIDB started and why you're here.</span>
	<br>
	<br>
	<span>I started making CCIDB during the COVID-19 pandemic/lockdown(s), as a way of cataloging my existing coin collection which had gone undocumented and untouched for a number of years. CCIDB initially started as a single text file with a small PHP backend, but quickly took on a life of its own, with the introduction of an SQLite database and full front and backend made in a combination of PHP, JavaScript, HTML, and even Python. PHP was chosen for its ease of learning and capabilities, despite its negative reputation within certain circles. This project was made solely in my free time, with no monetary support from any person or company, and took approximately 3 years to reach a "stable" status. While every effort is made to document where certain bits of code came from (mostly online sources like Stack Overflow), and what each bit of code does functionality wise, not everything is 100% covered at this point in time. Speaking of code, you can find a full list of other resources that I found useful beyond comparison when developing CCIDB. This includes other software either partially or fully implemented in CCIDB in some way or another (also known as dependencies).</span>
	<br>
	<br>
	<span>FOSS Credits/Dependencies</span>
	<br>
	<br>
	<span>What: <a href="http://boofcv.org/index.php?title=Main_Page" class="new_window">BoofCV Computer Vision Library</a> (<a href="https://github.com/lessthanoptimal/BoofCV/blob/SNAPSHOT/LICENSE-2.0.txt" class="new_window">Public copy of license</a>)</span>
	<br>
	<span>Why: For the mobile Micro QR code detection and decoding portion of CCIDB.</span>
	<br>
	<br>
	<span>What: <a href="https://numpy.org/" class="new_window">Numpy Library</a> (<a href="https://github.com/numpy/numpy/blob/main/LICENSE.txt" class="new_window">Public copy of license</a>)</span>
	<br>
	<span>Why: For the mobile Micro QR code detection and decoding portion of CCIDB (dependency of BoofCV).</span>
	<br>
	<br>
	<span>What: <a href="https://www.amcharts.com/" class="new_window">amCharts Library</a> (<a href="https://github.com/amcharts/amcharts4/blob/master/dist/script/LICENSE" class="new_window">Public copy of license</a>)</span>
	<br>
	<span>Why: For the collection heatmap portion of CCIDB, based on Numista's heatmapping system.</span>
	<br>
	<br>
	<span>What: <a href="https://phpdelusions.net/pdo" class="new_window">(The only proper) PDO tutorial</a></span>
	<br>
	<span>Why: For the PDO portion of CCIDB. PDO code in CCIDB heavily relies on this tutorial.</span>
	<br>
	<br>
	<span>What: <a href="https://xdebug.org/" class="new_window">XDebug PECL Plugin</a> (<a href="https://github.com/xdebug/xdebug/blob/master/LICENSE" class="new_window">Public copy of license</a>)</span>
	<br>
	<span>Why: For the constant, seemingly neverending debugging of CCIDB. Not implemented in the stable version, but still listed here.</span>
	<br>
	<br>
	<a href="index.php"><button type="button">Return to top page</button></a>
	<br>
	<br>
	<script src="navigateaway.js"></script>
	
<?php printpageend(); ?>