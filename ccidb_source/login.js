function getcookie(cookiename) {
	//Get cookie from browser.
	var cookiename = document.cookie.split('; ').find(row => row.startsWith(cookiename + '=')).split('=')[1];
	
	//Initialize vars.
	var fullregexp = /\$.* = \"(.*)\";/gm
	var result;
	
	//Decode cookie data.
	var cookiename = decodeURIComponent(cookiename);
	
	//If the string is a "full string" like "$variable = "value";", change it to just be "value" (which in our case will generally be one character).
	while ((result = fullregexp.exec(cookiename)) !== null) {
		cookiename = result[1];
	}
	
	//Pass cookie data.
	return cookiename;
}

var isloggedout = document.cookie.match(/^(.*;)?\s*loggedout\s*=\s*[^;]+(.*)?$/);

if(isloggedout !== null) {
	var loggedout = getcookie("loggedout");
}

else {
	var loggedout = null;
}

var message = document.getElementById("message");
var loginform = document.getElementById("login");
var extra = document.getElementById("extra");

if(typeof trustedTypes == 'undefined')trustedTypes={createPolicy:(n, rules) => rules};

const escapeHTMLPolicy = trustedTypes.createPolicy("myEscapePolicy", {
	createHTML: (string) => string.replace(/>/g, "<")
});

if(loggedout !== null) {
	const escaped = escapeHTMLPolicy.createHTML("You have been successfully logged out. Please come back again soon! You may log back in by refreshing the page.");
	message.innerHTML = escaped;
	document.cookie = "loggedout=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
	loginform.style.display = "none";
	if(extra !== null) {
	    extra.style.display = "none";
	}
}

else {
	loginform.style.display = "block";
	if(extra !== null) {
	    extra.style.display = "block";
	}
}