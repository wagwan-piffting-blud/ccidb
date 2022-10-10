//NOTE: ANY function using sleep MUST be declared "async function"! As well, the sleep call MUST be preceded by "await sleep(ms)"!

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

function updatetherecord(thebutton) {
	var lineregex = /(\d\d?\d?\d?\d?)/g;
	var mismatch = /(Line:)/g
	var linematch = lineregex.exec(thebutton);
	var count = parseInt(linematch[0]);
	var barcodeline = document.getElementById(count).children[2].innerHTML;
	if(mismatch.exec(barcodeline) !== null) {
		var barcodeline = document.getElementById(count).children[6].innerHTML;
	}		
	var myregex = /\#(\d{12})/g;
	var value = myregex.exec(barcodeline);
	var finalvalue = value[1];
	finalvalue = finalvalue.padStart(12, '0');
	document.cookie = "barcode=" + finalvalue;
	window.location.href = "update.php";
}

function uploadtheimage(thebutton) {
	var lineregex = /(\d\d?\d?\d?\d?)/g;
	var mismatch = /(Line:)/g
	var linematch = lineregex.exec(thebutton);
	var count = parseInt(linematch[0]);
	var barcodeline = document.getElementById(count).children[2].innerHTML;
	if(mismatch.exec(barcodeline) !== null) {
		var barcodeline = document.getElementById(count).children[6].innerHTML;
	}		
	var myregex = /\#(\d{12})/g;
	var value = myregex.exec(barcodeline);
	var finalvalue = value[1];
	finalvalue = finalvalue.padStart(12, '0');
	document.cookie = "barcode=" + finalvalue;
	window.location.href = "upload.php";
}

async function openwindow(url, newwindowtargets, allurls) {
	window.open(url, '_blank', 'width=600,height=400,status=0,menubar=0,location=0,toolbar=0,directories=0,titlebar=0');
	await sleep(1000);
	for(const count in newwindowtargets) {
		if(count < newwindowtargets.length) {
			newwindowtargets[count].href = allurls[count];
		}
	}
}

window.onload = (event) => {
	var haystack = document.getElementById("main").children;
	var needle = haystack[0].innerHTML;
	var myregex = /(\d\d?\d?\d?\d?)/g;
	var thematch = myregex.exec(needle);
	var count = parseInt(thematch[0]);
	var updaterecord = [];
	var uploadimage = [];
	var i;
	
	var newwindowtargets = document.getElementsByClassName("new_window");

	if(newwindowtargets !== null) {
		const allurls = new Array();
		for(const count in newwindowtargets) {
			if(count < newwindowtargets.length) {
				allurls[count] = newwindowtargets[count].href;
				newwindowtargets[count].addEventListener("click", function() {
					url = newwindowtargets[count].href;
					newwindowtargets[count].href = "#/";
					newwindowtargets[count].preventDefault;
					openwindow(url, newwindowtargets, allurls);
				}, false);
			}
		}
	}
	
	for(i = 1; i < (count + 1); i++) {
		updaterecord[i] = document.getElementById('updaterecord' + i);
		
		if(updaterecord[i] !== null) {
			updaterecord[i].addEventListener("click", function() { updatetherecord(this.id); }, false);
		}
		
		uploadimage[i] = document.getElementById('uploadimage' + i);
		
		if(uploadimage[i] !== null) {
			uploadimage[i].addEventListener("click", function() { uploadtheimage(this.id); }, false);
		}
	}
};