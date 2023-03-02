<?php
    header('Content-type: text/css');
    if(!isset($_SESSION)) {
    	require_once("../requires/session_start.php");
    }
?>
/* BEGIN CSS */

/* Font Import And Basic Declares */

@font-face {
	font-family: 'Luxi Mono';
	src: url('/css/luximb.eot?#iefix') format('embedded-opentype'), 
	     url('/css/luximb.woff') format('woff'), 
	     url('/css/luximb.woff2') format('woff2'), 
	     url('/css/luximb.ttf')  format('truetype'),
	     url('/css/luximb.svg') format('svg');
	font-display: swap;
}

.dark {
	/* Dark Mode colors */
	--darkmode-bg: #202020; /* Background color. Should be a very dark (but not pure black) grey. */
	--darkmode-fg: #F7F3F3; /* Foreground/text color. Should be opposite of background color, a very light (but not pure white) color. */
	--darkmode-in: #636363; /* Input color. Should be darker than background. */
	--darkmode-ro: #3B3B3B; /* Read only input color. Should be darker than input color. All text in a read only should be the below lighter red.*/
	--darkmode-rt: #D54642; /* Read only input text color. Should be a lighter red.*/
	--darkmode-gn: #205039; /* Green color. Should be forest green or a generally darker green color. */
	--darkmode-rd: #80082C; /* Red color. Should also be a generally darker red color (scarlet). */
	--darkmode-ul: #EFCF7C; /* Unvisited link color. Should be a gold color to indicate the information has not been visited. Visited links are below. */
	--darkmode-vl: #367AA0; /* Visited link color. Should be darker than the unvisited link color. */
}

.light {
	/* Light Mode colors */
	--lghtmode-bg: #F7F3F3; /* Background color. Should be a very light (but not pure white) color. */
	--lghtmode-fg: #202020; /* Foreground/text color. Should be opposite of background color, a very dark (but not pure black) color. */
	--lghtmode-in: #ADAAAA; /* Input color. Should be darker than background. */
	--lghtmode-ro: #828181; /* Read only input color. Should be darker than input color. All text in a read only should be the below lighter red.*/
	--lghtmode-rt: #DE6F6C; /* Read only input text color. Should be a lighter red than the below red.*/
	--lghtmode-gn: #279913; /* Green color. Should be lime green or a generally lighter green color. */
	--lghtmode-rd: #D0312D; /* Red color. Should also be a generally lighter red color (rose). */
	--lghtmode-ul: #EFB77C; /* Unvisited link color. Should be a bright color to indicate the information has not been visited. Visited links are below. */
	--lghtmode-vl: #6A0C56; /* Visited link color. Should be darker than the unvisited link color. */
	--lghtmode-bo: var(--lghtmode-bg); /* Override buttons to be white text on dark background. */
}

* {
	margin: 0;
	padding: 0;
	outline: 0;
}

:root {
	--font-name: "<?php if(isset($_SESSION['font'])) { print_r($_SESSION['font']); } else { print_r("Luxi Mono"); } ?>";
	background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
	color: var(--darkmode-fg, var(--lghtmode-fg, #F7F3F3));
	font-family: var(--font-name);
	font-size: 17pt;
	padding-left: 0.85vh;
	padding-right: 0.85vh;
}

/* End Font Import And Basic Declares */

/* Begin Element Level Selectors */

html, body {
	width: 99%;
	height: 95%;
}

img {
    width: 23vh;
    height: 23vh;
    object-fit: contain;
}

td {
	padding: 0.85vh 0.85vh;
	text-align: center;
}

hr {
	width: 100%;
    margin-left: 2vh;
}

input, pre, textarea {
	background-color: var(--darkmode-in, var(--lghtmode-in, #636363));
	color: var(--darkmode-fg, var(--lghtmode-fg, #F7F3F3));
	font-size: 18pt;
	overflow: hidden;
	text-align: center;
	font-family: var(--font-name);
}

button {
	background-color: var(--darkmode-gn, var(--lghtmode-gn, #205039));
	font-family: var(--font-name);
	border: none;
	color: var(--darkmode-fg, var(--lghtmode-bo, #F7F3F3));
	padding: 1.6vh 3.4vh;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 12pt;
	margin: 0.4vh 0.2vh;
}

textarea {
	width: 500px;
	height: 150px;
}

ol {
	display: inline-block;
}

ol li {
	color: #fff;
	font-family: var(--font-name);
	font-size: 18pt;
	text-align: center;
	display: list-item;
}

/* End Element Level Selectors */

/* Begin PseudoElement Level And Element.Class/Element#ID Level Selectors */

html::-webkit-scrollbar-track {
	-webkit-box-shadow: inset 0 0 0.64vh rgba(0, 0, 0, .3);
	border-radius: 1.06vh;
	background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

html::-webkit-scrollbar {
	width: 1.85vh;
	background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

html::-webkit-scrollbar-thumb {
	border-radius: 1.06vh;
	-webkit-box-shadow: inset 0 0 0.64vh rgba(0, 0, 0, .3);
	background-color: var(--darkmode-in, var(--lghtmode-in, #636363));
}

a:link {
	color: var(--darkmode-ul, var(--lghtmode-ul, #EFCF7C));
}

a:visited {
	color: var(--darkmode-vl, var(--lghtmode-vl, #367AA0));
}

input:read-only {
	background-color: var(--darkmode-ro, var(--lghtmode-ro, #3B3B3B));
	color: var(--darkmode-rt, var(--lghtmode-rt, #D54642));
}

label.required:before, label.small:before {
	content: "*";
	color: var(--darkmode-rt, var(--lghtmode-rt, #D54642));
}

button.danger {
	background-color: var(--darkmode-rd, var(--lghtmode-rd, #80082C));
}

img.bill {
	width: 45vh;
    height: 23vh;
    object-fit: contain;
}

div#tools {
	display: none;
}

/* End PseudoElement Level And Element.Class/Element#ID Level Selectors */

/* Begin Class Level Selectors */

.marginbr {
	margin: 15px;
}

.containerform {
	display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
}

.normalinput {
    background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

.slightlylonginput {
    width: 15vw;
    background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

.shortinput {
    width: 10vw;
    background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

.medshortinput {
    width: 7vw;
    background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

.reallyshortinput {
    width: 6vw;
    background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

.tpginput {
	width: 10vw;
	background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

.smallertextarea {
    width: 375px;
	height: 150px;
    background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

.hrsplit {
	margin-top: 0.7vh;
}

.wrapper {
	display: table;
	width: 100%;
	height: 100%;
}

.main {
	display: table-cell;
	vertical-align: middle;
	text-align: center;
}

.supercentercont {
	display: table;
	width: 100%;
	height: 100%;
}

.supercenter {
	display: table-cell;
	vertical-align: middle;
	text-align: center;
}

.nnh {
	color: var(--darkmode-rd, var(--lghtmode-rd, #80082C));
	font-size: 24pt;
}

.good {
	color: var(--darkmode-gn, var(--lghtmode-gn, #205039));
}

.bad {
	color: var(--darkmode-rd, var(--lghtmode-rd, #80082C));
}

.small, .smallnostar {
	font-size: 14px;
}

.separator {
	width: 10vh;
}

.separatorform {
	width: 1vh;
}

.custombr {
	height: 2vh;
}

.displaynone {
	display: none !important;
}

.displaynonenotimportant {
	display: none;
}

.mobileonly {
	display: none;
}

.smallscreenonly {
	display: none;
}

.zoom {
	zoom: 20%;
	-moz-transform: scale(20%);
	-moz-transform-origin: 0 0;
}

.luximono {
	font-family: "Luxi Mono";
}

.arial {
	font-family: "Arial";
}

.segoeui {
	font-family: "Segoe UI";
}

.tnr {
	font-family: "Times New Roman";
}

.verdana {
	font-family: "Verdana";
}

.changeunpwyes {
	display: none;
}

.flexbox-search {
	display: flex;
	flex-direction: row;
	justify-content: space-between;
	width: 100%;
}

.invisible {
	visibility: hidden;
	font-size: 18px;
}

.searchtable {
	font-family: var(--font-name);
	border-collapse: collapse;
	width: 90%;
	margin-left: auto;
	margin-right: auto;
	color: var(--darkmode-fg, var(--lghtmode-fg, #F7F3F3));
}

.searchtable td, .searchtable th {
	border: 1px solid #c3c7c7;
	padding: 8px;
}

.searchtable tr:nth-child(odd) {
	background-color: var(--darkmode-in, var(--lghtmode-in, #636363));
}

.searchtable tr:nth-child(even) {
	background-color: var(--darkmode-ro, var(--lghtmode-ro, #3B3B3B));
}

.searchtable tr:hover {
	background-color: var(--darkmode-gn, var(--lghtmode-gn, #205039));
}

.searchtable th {
	padding-top: 12px;
	padding-bottom: 12px;
	text-align: center;
	background-color: var(--darkmode-ro, var(--lghtmode-ro, #3B3B3B));
	color: var(--darkmode-fg, var(--lghtmode-fg, #F7F3F3));
}

.searchimg {
	width: 9vh;
	height: 9vh;
}

.divs {
	contain: content;
    word-wrap: break-word;
}

.flexbreak {
	flex-basis: 100%;
	height: 0;
}

.manualimg {
    width: 100vh;
    height: 25vh;
    object-fit: contain;
}

/* End Class Level Selectors */

/* Begin https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/ */

.takeapic {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}

.takeapic + label {
    font-size: 1.25em;
    font-weight: 700;
    color: white;
    background-color: #105733;
    display: inline-block;
}

.takeapic:focus + label, .takeapic + label:hover {
    background-color: var(--darkmode-rd, var(--lghtmode-rd, #80082C));
}

.takeapic + label {
	cursor: pointer;
}

.takeapic:focus + label, .takeapic.has-focus + label {
	outline: 1px dotted var(--darkmode-ro, var(--lghtmode-ro, #3B3B3B));
	outline: -webkit-focus-ring-color auto 5px;
}

.takeapic + label * {
	pointer-events: none;
}

/* End https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/ */

/* Begin ID Level Selectors */

#gumroad {
	width: 20%;
	height: 100%;
}

#cover {
	display: flex;
	justify-content: center;
	align-items: center;
	position: fixed;
	font-family: var(--font-name);
	font-size: 18px;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	z-index: 9999;
	color: var(--darkmode-fg, var(--lghtmode-fg, #F7F3F3));
	background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
}

#spoiler {
	display: none;
}

#imhero {
    width: 40vw;
    height: 20vh;
}

#mapdiv {
	width: 83vw;
	height: 80vh;
	text-align: center !important;
	display: inline-block;
}

#about {
	position: absolute;
	bottom: 3px;
	left: 3px;
}

#about a {
	font-size: 12px;
}

#wagslogo {
	border-radius: 50%;
	width: 100px;
	height: 100px;
	margin-left: 15px;
}

#misc {
	display: flex;
	flex-direction: column;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: space-evenly;
	max-width: 27vh;
	width: 27vh;
	height: auto;
}

#tpginfo {
	display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    align-items: center;
	width: 24vh;
    padding-left: 2vh;
    margin-left: 0vh;
    padding-bottom: 4vh;
    padding-top: 4vh;
    background-color: var(--darkmode-gn, var(--lghtmode-gn, #205039));
}

#tpginfoupdate {
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    align-items: center;
	width: 24vh;
    padding-left: 2vh;
    margin-left: -3vh;
    padding-bottom: 4vh;
    padding-top: 4vh;
    background-color: var(--darkmode-gn, var(--lghtmode-gn, #205039));
}

#basics, #meltinfo, .container {
    display: flex;
    flex-direction: row;
}

#leftmost {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    align-content: flex-start;
    justify-content: flex-start;
    align-items: center;
}

#leftmostform, #descnotesform, #rightmostform {
	padding-top: 1.17vh;
    padding-bottom: 1.45vh;
    padding-left: 1.43vh;
    padding-right: 1vh;
	display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: center;
    align-items: center;
}

#searchform, #updateform {
	display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    align-content: center;
	background-color: var(--darkmode-in, var(--lghtmode-in, #636363));
}

#basicsform {
	display: flex;
}

#descnotes {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: flex-start;
	width: 420vh;
}

#rightmost {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    align-content: flex-end;
    align-items: center;
    max-width: 101vh;
}

#imagestable, #imagestablebonus {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: center;
    justify-content: space-evenly;
    align-items: center;
}

#form, #header, #bottom, #top {
    display: flex;
    flex-direction: column;
    align-items: center;
	flex-wrap: wrap;
}

#composition, #composition_amount {
	padding-right: 5vh;
}

#type {
	padding-left: 1vh;
	padding-right: 4vh;
}

#year {
	padding-right: 3vh;
}

#mintmark {
	padding-right: 4vh;
}

#denomination {
	padding-right: 3vh;
}

#country_of_origin {
	padding-right: 1vh;
}

#meltline {
	padding-top: 0.5vh;
}

#leftmost, #descnotes, #rightmost {
	padding-top: 1.17vh;
    padding-bottom: 1.45vh;
    padding-left: 1.43vh;
    padding-right: 1vh;
    max-height: 126vh;
    background-color: var(--darkmode-in, var(--lghtmode-in, #636363));
}

#header {
	margin-top: 0;
}

#form {
	margin-bottom: -8px;
}

#datalinediv {
	display: flex;
	flex-direction: row;
	flex-wrap: nowrap;
}

#allimages {
	display: flex;
	flex-direction: column;
	flex-wrap: nowrap;
}

/* End ID Level Selectors */

/* Begin Media Queries */

/* Begin Half Window Size */

@media screen and not (min-width: 1223px) {
	html, body {
		width: 99%;
		height: 95%;
	}
	
	.container {
		display: flex;
		flex-direction: column;
	}
	
	#basics {
		display: flex;
		flex-direction: row;
	}
	
	#basicsform {
		display: flex;
		flex-direction: column;
	}
	
	#leftmost, #descnotes, #rightmost {
		display: flex;
		flex-direction: column;
		width: 99%;
		align-content: center;
		justify-content: center;
		align-items: center;
	}
	
	#rightmost {
		width: 99%;
		height: 145%;
		max-width: initial;
		max-height: initial;
	}
	
	#notes {
		text-align: center;
	}
	
	#misc {
		display: flex;
		flex-direction: column;
		flex-wrap: wrap;
	}
	
	#tpginfo {
		display: flex;
		flex-direction: column;
		align-content: center;
		justify-content: center;
		align-items: center;
		width: 32vh;
		margin-left: 0vh;
		padding-left: 3vh;
		padding-right: 3vh;
		padding-bottom: 5vh;
		padding-top: 5vh;
		background-color: var(--darkmode-gn, var(--lghtmode-gn, #205039));
	}
	
	#searchform, #updateform {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: center;
		align-items: center;
		align-content: center;
		background-color: var(--darkmode-in, var(--lghtmode-in, #636363));
	}
	
	#rightmostform {
		width: 40vw;
	}
	
	#tpginfoupdate {
		width: 25vw;
	}
	
	.normalinput {
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
    
    .slightlylonginput {
        width: 20vw;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
    
    .shortinput {
        width: 30vw;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
    
    .medshortinput {
        width: 10vw;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
    
    .reallyshortinput {
        width: 10vw;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
	
	.tpginput {
		width: 15vw;
		background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
	}
    
    .smallertextarea {
        width: 450px;
    	height: 210px;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
}

/* End Half Window Size */


/* Begin Phones */

@media screen and (max-width:699px) {
	@font-face {
    	font-family: 'Luxi Mono';
    	src: url('/css/luximb.eot?#iefix') format('embedded-opentype'), 
    	     url('/css/luximb.woff') format('woff'), 
    	     url('/css/luximb.woff2') format('woff2'), 
    	     url('/css/luximb.ttf')  format('truetype'),
    	     url('/css/luximb.svg') format('svg');
    	font-display: swap;
    }
    
	html, body {
		width: 99%;
		height: 95%;
	}
	
	img {
		width: 100%;
		height: auto;
		object-fit: contain;
	}
	
	img.bill {
		width: 100%;
		height: auto;
		object-fit: contain;
	}
	
	/* Begin Class Level Selectors */
	
	.searchrow {
		display: flex;
		flex-direction: column;
		flex-wrap: wrap;
		width: 100%;
	}
	
	.flexbox-search {
		display: flex;
		flex-direction: column;
		width: 100%;
		flex-wrap: nowrap;
		align-items: flex-start;
	}
	
	.custombr {
		min-height: 3vh;
	}
	
	.mobileonly {
		display: inline-block;
	}
	
	.container {
		display: flex;
		flex-direction: column;
		flex-wrap: nowrap;
	}
	
	.separator {
    	width: 10vh;
    }
	
	.normalinput {
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
    
    .slightlylonginput {
        width: 50vw;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
    
    .shortinput {
        width: 30vw;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
    
    .medshortinput {
        width: 35vw;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
    
    .reallyshortinput {
        width: 30vw;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
	
	.tpginput {
		width: 50vw;
		background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
	}
    
    .smallertextarea {
        width: 325px;
    	height: 150px;
        background-color: var(--darkmode-bg, var(--lghtmode-bg, #202020));
    }
	
	.manualimg {
		width: 40vh;
		height: 8vh;
		object-fit: contain;
	}
	
	/* End Class Level Selectors */
	
	/* Begin ID Level Selectors */
	
	#searchthead {
		width: 215%;
	}
	
	#searchtbody {
		display: flex;
		flex-direction: column;
		flex-wrap: wrap;
		align-content: flex-start;
		justify-content: center;
		align-items: flex-start;
	}
	
	#searchtable {
		display: flex;
		flex-direction: column;
		align-content: flex-start;
		justify-content: center;
		align-items: flex-start;
	}
	
	#tpginfoupdate {
		width: 26vh;
		padding-left: 2vh;
		margin-left: -2vh;
		padding-bottom: 6vh;
		padding-top: 6vh;
		background-color: var(--darkmode-gn, var(--lghtmode-gn, #205039));
	}
	
	#imhero {
        width: 105%;
        height: 20vh;
    }
	
	#leftmost, #descnotes, #rightmost {
		width: 95%;
		max-width: initial;
		max-height: initial;
	}
	
	#leftmost {
		display: flex;
		flex-direction: column;
		flex-wrap: nowrap;
		align-content: flex-start;
		justify-content: flex-start;
		align-items: flex-start;
	}
	
	#basics {
		display: flex;
		flex-direction: column;
		align-content: flex-start;
		justify-content: flex-start;
		align-items: flex-start;
		flex-wrap: nowrap;
	}
	
	#allimages {
		display: flex;
		flex-direction: row;
		align-content: flex-start;
		justify-content: flex-start;
		align-items: flex-start;
		flex-wrap: wrap;
	}
	
	#tpginfo {
		width: 36vw;
		/* margin-left: -8vw; */
	}
	
	#meltinfo {
		display: flex;
		flex-direction: column;
		flex-wrap: nowrap;
	}
	
	#datalinediv {
    	display: flex;
    	flex-direction: column;
    	flex-wrap: wrap;
    }
    
    #about {
	    position: absolute;
    	top: 3px;
    	left: 3px;
    	width: 100%;
    	height: 1%;
    }
	
	#searchform, #updateform {
		display: flex;
		flex-direction: column;
	}
	
	/* End ID Level Selectors */
}

/* End Phones */

/* End Media Queries */

/* END CSS */