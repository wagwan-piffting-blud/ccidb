/* https://stackoverflow.com/a/5968306 */
function iscookienull(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    // because unescape has been deprecated, replaced with decodeURI
    return decodeURI(dc.substring(begin + prefix.length, end));
}

function removediv() {
	document.getElementById("cover").style.display = "none";
}

/* https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/ */
var takeapic = document.getElementById("takeapic");
var form = document.getElementById("form");
var indexbtn = document.getElementById("indexbtn");
var isbarcodepresent = iscookienull("barcode");

if(typeof trustedTypes == 'undefined')trustedTypes={createPolicy:(n, rules) => rules};

const escapeHTMLPolicy = trustedTypes.createPolicy("myEscapePolicy", {
	createHTML: (string) => string.replace(/>/g, "<")
});

if(isbarcodepresent == null) {
	document.getElementById("cover").style.display = "none";
	//window.open("lookup.php", "_blank", "popup=false");
}

else if(isbarcodepresent !== null) {
	document.getElementById("lookup").addEventListener("click", removediv, false);
}

takeapic.addEventListener('focus', function() { 
	takeapic.classList.add('has-focus'); 
});

takeapic.addEventListener('blur', function() {
	takeapic.classList.remove('has-focus');
});

/* https://stackoverflow.com/a/7321940 */
takeapic.onchange = function() {
    form.style.display = "none";
	indexbtn.style.display = "none";
	const escaped = escapeHTMLPolicy.createHTML("Status: File uploaded! Waiting for a potential match from the server...");
    document.getElementById("status").innerHTML = escaped;
	document.getElementById("form").submit();
};