//NOTE: ANY function using sleep MUST be declared "async function"! As well, the sleep call MUST be preceded by "await sleep(ms)"!

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

function changeWidth(selector) {
    let ghostSelect = document.createElement('select');
    const select = selector;
    var x = select.options[select.selectedIndex].text;
    
    const ghostOption = document.createElement("option");
    ghostOption.setAttribute("value", x);
    var t = document.createTextNode(x);
    ghostOption.appendChild(t);
    ghostSelect.appendChild(ghostOption);
    window.document.body.appendChild(ghostSelect);
    select.style.width = ghostSelect.offsetWidth + 'px';
    window.document.body.removeChild(ghostSelect);
}

function updatecurrency() {
	var currentcurrency = currencyselect.options[currencyselect.selectedIndex].value;
	currencyswitch(currentcurrency);
}

function currencyswitch(currentcurrency) {
	switch(currentcurrency) {
		case "$":
			const escaped = escapeHTMLPolicy.createHTML("$");
            currencyexample.innerHTML = escaped;
			break;
		case "AU$":
			const escaped2 = escapeHTMLPolicy.createHTML("AU$");
            currencyexample.innerHTML = escaped2;
			break;
		case "CA$":
			const escaped3 = escapeHTMLPolicy.createHTML("CA$");
            currencyexample.innerHTML = escaped3;
			break;
		case "US$":
			const escaped4 = escapeHTMLPolicy.createHTML("US$");
            currencyexample.innerHTML = escaped4;
			break;
		case "₿":
			const escaped5 = escapeHTMLPolicy.createHTML("₿");
            currencyexample.innerHTML = escaped5;
			break;
		case "¥":
			const escaped6 = escapeHTMLPolicy.createHTML("¥");
            currencyexample.innerHTML = escaped6;
			break;
		case "€":
			const escaped7 = escapeHTMLPolicy.createHTML("€");
            currencyexample.innerHTML = escaped7;
			break;
		case "£":
			const escaped8 = escapeHTMLPolicy.createHTML("£");
            currencyexample.innerHTML = escaped8;
			break;
		case "₩":
			const escaped9 = escapeHTMLPolicy.createHTML("₩");
            currencyexample.innerHTML = escaped9;
			break;
	}
}

function updatefont() {
	var currentfont = fontselect.options[fontselect.selectedIndex].value;
	fontswitch(currentfont);
}

function fontswitch(currentfont) {
	switch(currentfont) {
		case "Luxi Mono":
			fontexample.style = "font-family: Luxi Mono";
			break;
		case "Arial":
			fontexample.style = "font-family: Arial";
			break;
		case "Segoe UI":
			fontexample.style = "font-family: Segoe UI";
			break;
		case "Times New Roman":
			fontexample.style = "font-family: Times New Roman";
			break;
		case "Verdana":
			fontexample.style = "font-family: Verdana";
			break;
	}
}

function updatecolorscheme() {
	var currentcolorscheme = colorschemeselect.options[colorschemeselect.selectedIndex].value;
	colorschemeswitch(currentcolorscheme);
}

function colorschemeswitch(currentcolorscheme) {
	switch(currentcolorscheme) {
		case "dark":
			var css = document.getElementById("htmltag");
			css.classList.remove("light");
			css.classList.add("dark");
			break;
		case "light":
			var css2 = document.getElementById("htmltag");
			css2.classList.remove("dark");
			css2.classList.add("light");
			break;
	}
}


function updateunpw() {
	var currentchangeunpw = unpwselect.options[unpwselect.selectedIndex].value;
	unpwswitch(currentchangeunpw);
}

function unpwswitch(currentchangeunpw) {
	switch(currentchangeunpw) {
		case "yes":
			changeunpwelements.forEach((element, i) =>  { element.style = "display: inline-block"});
			document.getElementById("pwlabel").classList.add("required");
			document.getElementById("password").required = true;
			break;
		case "no":
			document.getElementById("pwlabel").classList.remove("required");
			document.getElementById("password").required = false;
			changeunpwelements.forEach((element, i) =>  { element.style = "display: none"});
			break;
	}
}

var colorschemeselect = document.getElementById("colorscheme");
var currencyselect = document.getElementById("currencysymbol");
var fontselect = document.getElementById("font");
var currencyexample = document.getElementById("currencyexample");
var fontexample = document.getElementById("fontexample");
var timezone = document.getElementById("timezone");
var unpwselect = document.getElementById("changeunpw");
var changeunpwelements = document.querySelectorAll('.changeunpwyes');

var colorschemearray = ["dark", "light"];
var currencyarray = ["$", "AU$", "CA$", "US$", "₿", "¥", "€", "£", "₩"];
var fontarray = ["Luxi Mono", "Arial", "Segoe UI", "Times New Roman", "Verdana"];

if(colorschemeselect.options[colorschemeselect.selectedIndex] !== undefined && colorschemeselect.options[colorschemeselect.selectedIndex] !== null) {
    var currentcolorscheme = colorschemeselect.options[colorschemeselect.selectedIndex].value;
    var currentcurrency = currencyselect.options[currencyselect.selectedIndex].value;
    var currentfont = fontselect.options[fontselect.selectedIndex].value;
}

if(typeof trustedTypes == 'undefined')trustedTypes={createPolicy:(n, rules) => rules};

const escapeHTMLPolicy = trustedTypes.createPolicy("myEscapePolicy", {
	createHTML: (string) => string.replace(/>/g, "<")
});

if(timezone !== null) {
	if(timezone.value) {
	}
	
	else {
	    timezone.value = Intl.DateTimeFormat().resolvedOptions().timeZone;
	}
}

if(colorschemeselect !== null) {
	var colorschemetest = colorschemearray.every((item)=>{return item!=currentcolorscheme;});
	
	if(colorschemetest === true) {
		var currentcolorscheme = "dark";
		colorschemeselect.value = "dark";
	}
	
	else {
		var currentcolorscheme = colorschemeselect.options[colorschemeselect.selectedIndex].value;
	}
	
	colorschemeswitch(currentcolorscheme);
	colorschemeselect.addEventListener("change", function() { updatecolorscheme(); changeWidth(colorschemeselect); }, false);
	colorschemeselect.dispatchEvent(new Event('change'));
}

if(currencyselect !== null) {
	/* https://stackoverflow.com/questions/61351594/how-to-test-that-all-values-in-an-array-are-not-equal-to-a-specific-value 
	
	We use this test in case the user decides to manually change the currency or font outside of the settings module. If the value is outside of the array, we simply set it to the default values. */
	var currencytest = currencyarray.every((item)=>{return item!=currentcurrency;});
	
	if(currencytest === true) {
		var currentcurrency = "$";
		currencyselect.value = "$";
	}
	
	else {
		var currentcurrency = currencyselect.options[currencyselect.selectedIndex].value;
	}
	
	currencyswitch(currentcurrency);
	currencyselect.addEventListener("change", function() { updatecurrency(); changeWidth(currencyselect); }, false);
	currencyselect.dispatchEvent(new Event('change'));
}

if(fontselect !== null) {
	var fonttest = fontarray.every((item)=>{return item!=currentfont;});
	
	if(fonttest === true) {
		var currentfont = "Luxi Mono";
		fontselect.value = "Luxi Mono";
	}
	
	else {
		var currentfont = fontselect.options[fontselect.selectedIndex].value;
	}
	
	fontswitch(currentfont);
	fontselect.addEventListener("change", function() { updatefont(); changeWidth(fontselect); }, false);
	fontselect.dispatchEvent(new Event('change'));
}

if(unpwselect !== null) {
	var currentchangeunpw = unpwselect.options[unpwselect.selectedIndex].value;
	unpwswitch(currentchangeunpw);
	unpwselect.addEventListener("change", updateunpw, false);
}