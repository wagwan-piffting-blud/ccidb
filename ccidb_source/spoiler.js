var totalcost = document.getElementById("spoiler");
var clicktoreveal = document.getElementById("spoiler2");
var hidden = true;

if(typeof trustedTypes == 'undefined')trustedTypes={createPolicy:(n, rules) => rules};

const escapeHTMLPolicy = trustedTypes.createPolicy("myEscapePolicy", {
	createHTML: (string) => string.replace(/>/g, "<")
});

clicktoreveal.addEventListener("click", function () {
	if(hidden === true) {
		const escaped = escapeHTMLPolicy.createHTML("&nbsp;(click to hide)");
		clicktoreveal.innerHTML = escaped;
		totalcost.style.display = "inline-block";
		hidden = false;
	}
	
	else {
		const escaped = escapeHTMLPolicy.createHTML("(click to reveal)");
		clicktoreveal.innerHTML = escaped;
		totalcost.style.display = "none";
		hidden = true;
	}
}, false);