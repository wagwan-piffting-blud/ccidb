function goback() {
	window.history.back();
}

//NOTE: ANY function using sleep MUST be declared "async function"! As well, the sleep call MUST be preceded by "await sleep(ms)"!

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

function updatetherecord() {
	var elements = document.getElementById('datalinediv').children;
	var elements = Array.prototype.slice.call(elements);
	elements.forEach((element, i) => {
		var value = myregex.exec(element.innerHTML);
		if(value !== null) {
			var finalvalue = value[1];
			finalvalue = finalvalue.padStart(12, '0');
			document.cookie = "barcode=" + finalvalue;
			window.location.href = "update.php";
		}
	});
}

function deletetheimage() {
	var elements = document.getElementById('datalinediv').children;
	var elements = Array.prototype.slice.call(elements);
	elements.forEach((element, i) => {
		var value = myregex.exec(element.innerHTML);
		if(value !== null) {
			var finalvalue = value[1];
			finalvalue = finalvalue.padStart(12, '0');
			document.cookie = "barcode=" + finalvalue;
			window.location.href = "delimg.php";
		}
	});
}

function backtotherecord() {
	var elements = document.getElementById('main').children;
	var elements = Array.prototype.slice.call(elements);
	elements.forEach((element, i) => {
		var value = myregex.exec(element.innerHTML);
		if(value !== null) {
			var finalvalue = value[1];
			finalvalue = finalvalue.padStart(12, '0');
			document.cookie = "barcode=" + finalvalue;
			window.location.href = "lookup.php";
		}
	});
}

function uploadtheimage() {
	var path = window.location.pathname;
	var page = path.split("/").pop();
	if(page == "show_output.php") {
		var elements = document.getElementById('datalinediv').children;
		var elements = Array.prototype.slice.call(elements);
		elements.forEach((element, i) => {
			var value = myregex.exec(element.innerHTML);
			if(value !== null) {
				var finalvalue = value[1];
				finalvalue = finalvalue.padStart(12, '0');
				document.cookie = "barcode=" + finalvalue;
				window.location.href = "upload.php";
			}
		});
	}
	else {
		var elements = document.getElementById('myform').children;
		var elements = Array.prototype.slice.call(elements);
		elements.forEach((element, i) => {
			var value = myregex.exec(element.innerHTML);
			if(value !== null) {
				var finalvalue = value[1];
				finalvalue = finalvalue.padStart(12, '0');
				document.cookie = "barcode=" + finalvalue;
				window.location.href = "upload.php";
			}
		});
	}
}

function calculate() {
	var obvwid = obverse.offsetWidth;
	var obvhei = obverse.offsetHeight;
	
	var revwid = reverse.offsetWidth;
	var revhei = reverse.offsetHeight;
	
	if((obvwid >= revwid) && (obvhei >= revhei)) {
		reverse.setAttribute("style", "width: " + obvwid + "px; height: " + obvhei + "px;");
	}
	
	else if((obvwid <= revwid) && (obvhei <= revhei)) {
		obverse.setAttribute("style", "width: " + revwid + "px; height: " + revhei + "px;");
	}
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

var updaterecord = document.getElementById('updaterecord');
var backtorecord = document.getElementById('backtorecord');
var uploadimage = document.getElementById('uploadimage');
var deleteimage = document.getElementById('deleteimage');
var back = document.getElementById('back');
var obverse = document.getElementById('obverse');
var reverse = document.getElementById('reverse');
var navaway = document.getElementById('navaway');

var newwindowtargets = document.getElementsByClassName("new_window");
var myregex = /\#(\d{12})/g;

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

if(updaterecord !== null) {
	updaterecord.addEventListener("click", updatetherecord, false);
}

if(deleteimage !== null) {
	deleteimage.addEventListener("click", deletetheimage, false);
}

if(backtorecord !== null) {
	backtorecord.addEventListener("click", backtotherecord, false);
	
	document.addEventListener("keyup", function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("backtorecord").click();
		}
	});
}

if(uploadimage !== null) {
	uploadimage.addEventListener("click", uploadtheimage, false);
}

if(back !== null) {
	back.addEventListener("click", goback, false);
	
	document.addEventListener("keyup", function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("back").click();
		}
	});
}

if(reverse !== null) {
	reverse.addEventListener("load", calculate, false);
}

if(navaway !== null) {
    navaway.addEventListener("click", function () { 
        window.addEventListener('beforeunload', (event) => {
          event.preventDefault();
          event.returnValue = '';
        });
    }, false);
}