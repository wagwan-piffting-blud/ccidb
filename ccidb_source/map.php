<?php require_once("globalvars.php"); require_once("template.php"); printpagestart("Map Of Countries"); ?>
<script src="/heatmap/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
<script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/4/geodata/data/countries2.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<span>This is a heat map of all of the countries this coin collection represents.</span>
<br>
<br>
<div id="mapdiv"></div>
<script type="text/javascript" src="heatmap.php"></script>
<br>
<a href="stats.php"><button>Return to stats page</button></a>
<br>
<a href="index.php"><button>Return to top page</button></a>
<script src="navigateaway.js" type="text/javascript"></script><?php printpageend(); ?>