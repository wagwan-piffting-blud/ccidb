function getcookie(cookiename) {
	//Get cookie from browser.
	cookiename = document.cookie.split('; ').find(row => row.startsWith(cookiename + '='));
	
	if(cookiename !== undefined && cookiename !== null) {
	    cookiename = cookiename.split('=')[1];
	}
	
	else {
	    return null;
	}
	
	//Initialize extra vars.
	var fullregexp = /\+/gm;
	var result;
	
	//Decode cookie data.
	cookiename = decodeURIComponent(cookiename);
	
	//Test for font.
	if (cookiename.match(fullregexp) !== null) {
		result = cookiename.replace(fullregexp, ' ');
		cookiename = result;
		//cookiename = result.toLowerCase();
	}
	
	//Pass cookie data.
	return cookiename;
}

//Initialize vars.
var colorscheme = getcookie("colorscheme");
var currencysymbol = getcookie("currencysymbol");
var timezone = getcookie("timezone");
var font = getcookie("font");

if(getcookie("metalsapi")) {
    var metalsapi = getcookie("metalsapi");
}

var colorschemeselect = document.getElementById("colorscheme");
var currencyselect = document.getElementById("currencysymbol");
var timezoneselect = document.getElementById("timezone");
var fontselect = document.getElementById("font");

if(getcookie("metalsapi")) {
    var metalsapiinput = document.getElementById("metalsapi");
}

//Set values.
colorschemeselect.value = colorscheme;
currencyselect.value = currencysymbol;
timezoneselect.value = timezone;
fontselect.value = font;

if(getcookie("metalsapi")) {
    metalsapiinput.value = metalsapi;
}