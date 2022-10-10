function preventdef(event) {
	event.preventDefault();
	document.getElementById('submitbtn').disabled = true;
	document.getElementById('submitbtn').classList.add("danger");
}

function allowdef(event) {
	document.getElementById('submitbtn').disabled = false;
	document.getElementById('submitbtn').classList.remove("danger");
}

function changerupper() {
	if(document.getElementById('bonusyn').value == "yes") {
		document.getElementById('bonusnumberlabel').style.display = "inline";
		document.getElementById('bonusnumber').style.display = "inline-block";
		document.getElementById('bonusnumber').dispatchEvent(new Event('change'));
	}
	
	else {
		document.getElementById('bonusnumber').style.display = "none";
		document.getElementById('bonusnumberlabel').style.display = "none";
		document.getElementById('bonus1label').style.display = "none";
		document.getElementById('bonus1br').style.display = "none";
		document.getElementById('bonus1').src = "placeholder.png";
		document.getElementById('fileToUpload3').style.display = "none";
		document.getElementById('fileToUpload3').value = '';
		document.getElementById("fileToUpload3").required = false;
		document.getElementById('bonus1tdr1').style.display = "none";
		document.getElementById('bonus1tdr2').style.display = "none";
		document.getElementById('bonus2label').style.display = "none";
		document.getElementById('bonus2br').style.display = "none";
		document.getElementById('bonus2').src = "placeholder.png";
		document.getElementById('fileToUpload4').style.display = "none";
		document.getElementById('fileToUpload4').value = '';
		document.getElementById("fileToUpload4").required = false;
		document.getElementById('bonus2tdr1').style.display = "none";
		document.getElementById('bonus2tdr2').style.display = "none";
		document.getElementById('bonus3label').style.display = "none";
		document.getElementById('bonus3br').style.display = "none";
		document.getElementById('bonus3').src = "placeholder.png";
		document.getElementById('fileToUpload5').style.display = "none";
		document.getElementById('fileToUpload5').value = '';
		document.getElementById("fileToUpload5").required = false;
		document.getElementById('bonus3tdr1').style.display = "none";
		document.getElementById('bonus3tdr2').style.display = "none";
		document.getElementById('bonus4label').style.display = "none";
		document.getElementById('bonus4br').style.display = "none";
		document.getElementById('bonus4').src = "placeholder.png";
		document.getElementById('fileToUpload6').style.display = "none";
		document.getElementById('fileToUpload6').value = '';
		document.getElementById("fileToUpload6").required = false;
		document.getElementById('bonus4tdr1').style.display = "none";
		document.getElementById('bonus4tdr2').style.display = "none";
	}
}

function changerupper2() {
	switch(document.getElementById('bonusnumber').value) {
		case '1':
			document.getElementById('bonus1').src = "placeholder.png";
			document.getElementById('fileToUpload3').addEventListener("change", bonus1img, true);
			document.getElementById('bonus1label').style.display = "inline";
			document.getElementById('bonus1br').style.display = "inline";
			document.getElementById('fileToUpload3').style.display = "inline-block";
			document.getElementById("fileToUpload3").required = true;
			document.getElementById('bonus1tdr1').style.display = "table-cell";
			document.getElementById('bonus1tdr2').style.display = "table-cell";
			document.getElementById('bonus2label').style.display = "none";
			document.getElementById('bonus2br').style.display = "none";
			document.getElementById('fileToUpload4').style.display = "none";
			document.getElementById('bonus2').src = "placeholder.png";
			document.getElementById('fileToUpload4').value = '';
			document.getElementById("fileToUpload4").required = false;
			document.getElementById('bonus2tdr1').style.display = "none";
			document.getElementById('bonus2tdr2').style.display = "none";
			document.getElementById('bonus3label').style.display = "none";
			document.getElementById('bonus3br').style.display = "none";
			document.getElementById('fileToUpload5').style.display = "none";
			document.getElementById('bonus3').src = "placeholder.png";
			document.getElementById('fileToUpload5').value = '';
			document.getElementById("fileToUpload5").required = false;
			document.getElementById('bonus3tdr1').style.display = "none";
			document.getElementById('bonus3tdr2').style.display = "none";
			document.getElementById('bonus4label').style.display = "none";
			document.getElementById('bonus4br').style.display = "none";
			document.getElementById('fileToUpload6').style.display = "none";
			document.getElementById('bonus4').src = "placeholder.png";
			document.getElementById('fileToUpload6').value = '';
			document.getElementById("fileToUpload6").required = false;
			document.getElementById('bonus4tdr1').style.display = "none";
			document.getElementById('bonus4tdr2').style.display = "none";
			break;
		case '2':
			document.getElementById('bonus1').src = "placeholder.png";
			document.getElementById('fileToUpload3').addEventListener("change", bonus1img, true);
			document.getElementById('bonus2').src = "placeholder.png";
			document.getElementById('fileToUpload4').addEventListener("change", bonus2img, true);
			document.getElementById('bonus1label').style.display = "inline";
			document.getElementById('bonus1br').style.display = "inline";
			document.getElementById('fileToUpload3').style.display = "inline-block";
			document.getElementById("fileToUpload3").required = true;
			document.getElementById('bonus1tdr1').style.display = "table-cell";
			document.getElementById('bonus1tdr2').style.display = "table-cell";
			document.getElementById('bonus2label').style.display = "inline";
			document.getElementById('bonus2br').style.display = "inline";
			document.getElementById('fileToUpload4').style.display = "inline-block";
			document.getElementById("fileToUpload4").required = true;
			document.getElementById('bonus2tdr1').style.display = "table-cell";
			document.getElementById('bonus2tdr2').style.display = "table-cell";
			document.getElementById('bonus3label').style.display = "none";
			document.getElementById('bonus3br').style.display = "none";
			document.getElementById('bonus3').src = "placeholder.png";
			document.getElementById('fileToUpload5').style.display = "none";
			document.getElementById('fileToUpload5').value = '';
			document.getElementById("fileToUpload5").required = false;
			document.getElementById('bonus3tdr1').style.display = "none";
			document.getElementById('bonus3tdr2').style.display = "none";
			document.getElementById('bonus4label').style.display = "none";
			document.getElementById('bonus4br').style.display = "none";
			document.getElementById('bonus4').src = "placeholder.png";
			document.getElementById('fileToUpload6').style.display = "none";
			document.getElementById('fileToUpload6').value = '';
			document.getElementById("fileToUpload6").required = false;
			document.getElementById('bonus4tdr1').style.display = "none";
			document.getElementById('bonus4tdr2').style.display = "none";
			break;
		case '3':
			document.getElementById('bonus1').src = "placeholder.png";
			document.getElementById('fileToUpload3').addEventListener("change", bonus1img, true);
			document.getElementById('bonus2').src = "placeholder.png";
			document.getElementById('fileToUpload4').addEventListener("change", bonus2img, true);
			document.getElementById('bonus3').src = "placeholder.png";
			document.getElementById('fileToUpload5').addEventListener("change", bonus3img, true);
			document.getElementById('bonus1label').style.display = "inline";
			document.getElementById('bonus1br').style.display = "inline";
			document.getElementById('fileToUpload3').style.display = "inline-block";
			document.getElementById("fileToUpload3").required = true;
			document.getElementById('bonus1tdr1').style.display = "table-cell";
			document.getElementById('bonus1tdr2').style.display = "table-cell";
			document.getElementById('bonus2label').style.display = "inline";
			document.getElementById('bonus2br').style.display = "inline";
			document.getElementById('fileToUpload4').style.display = "inline-block";
			document.getElementById("fileToUpload4").required = true;
			document.getElementById('bonus2tdr1').style.display = "table-cell";
			document.getElementById('bonus2tdr2').style.display = "table-cell";
			document.getElementById('bonus3label').style.display = "inline";
			document.getElementById('bonus3br').style.display = "inline";
			document.getElementById('fileToUpload5').style.display = "inline-block";
			document.getElementById("fileToUpload5").required = true;
			document.getElementById('bonus3tdr1').style.display = "table-cell";
			document.getElementById('bonus3tdr2').style.display = "table-cell";
			document.getElementById('bonus4label').style.display = "none";
			document.getElementById('bonus4br').style.display = "none";
			document.getElementById('bonus4').src = "placeholder.png";
			document.getElementById('fileToUpload6').style.display = "none";
			document.getElementById('fileToUpload6').value = '';
			document.getElementById("fileToUpload6").required = false;
			document.getElementById('bonus4tdr1').style.display = "none";
			document.getElementById('bonus4tdr2').style.display = "none";
			break;
		case '4':
			document.getElementById('obverse').src = "placeholder.png";
			document.getElementById('fileToUpload1').addEventListener("change", obverseimg, true);
			document.getElementById('reverse').src = "placeholder.png";
			document.getElementById('fileToUpload2').addEventListener("change", reverseimg, true);
			document.getElementById('bonus1').src = "placeholder.png";
			document.getElementById('fileToUpload3').addEventListener("change", bonus1img, true);
			document.getElementById('bonus2').src = "placeholder.png";
			document.getElementById('fileToUpload4').addEventListener("change", bonus2img, true);
			document.getElementById('bonus3').src = "placeholder.png";
			document.getElementById('fileToUpload5').addEventListener("change", bonus3img, true);
			document.getElementById('bonus4').src = "placeholder.png";
			document.getElementById('fileToUpload6').addEventListener("change", bonus4img, true);
			document.getElementById('bonus1label').style.display = "inline";
			document.getElementById('bonus1br').style.display = "inline";
			document.getElementById('fileToUpload3').style.display = "inline-block";
			document.getElementById("fileToUpload3").required = true;
			document.getElementById('bonus1tdr1').style.display = "table-cell";
			document.getElementById('bonus1tdr2').style.display = "table-cell";
			document.getElementById('bonus2label').style.display = "inline";
			document.getElementById('bonus2br').style.display = "inline";
			document.getElementById('fileToUpload4').style.display = "inline-block";
			document.getElementById("fileToUpload4").required = true;
			document.getElementById('bonus2tdr1').style.display = "table-cell";
			document.getElementById('bonus2tdr2').style.display = "table-cell";
			document.getElementById('bonus3label').style.display = "inline";
			document.getElementById('bonus3br').style.display = "inline";
			document.getElementById('fileToUpload5').style.display = "inline-block";
			document.getElementById("fileToUpload5").required = true;
			document.getElementById('bonus3tdr1').style.display = "table-cell";
			document.getElementById('bonus3tdr2').style.display = "table-cell";
			document.getElementById('bonus4label').style.display = "inline";
			document.getElementById('bonus4br').style.display = "inline";
			document.getElementById('fileToUpload6').style.display = "inline-block";
			document.getElementById("fileToUpload6").required = true;
			document.getElementById('bonus4tdr1').style.display = "table-cell";
			document.getElementById('bonus4tdr2').style.display = "table-cell";
			break;
	}
}

function obverseimg() {
	document.getElementById('obverse').src = window.URL.createObjectURL(this.files[0]);
	
	const fi = document.getElementById('fileToUpload1');

	if (fi.files.length > 0) {
		for (var i = 0; i <= fi.files.length - 1; i++) {
			const fsize = fi.files.item(i).size;
			
			if (fsize > 10485760) {
				const escaped = escapeHTMLPolicy.createHTML("File exceeds 10 MB.");
				document.getElementById('obverseerrmsg').innerHTML = escaped;
				window.obversetoobig = true;
				document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
			}
			
			else {
				const escaped = escapeHTMLPolicy.createHTML("");
				document.getElementById('obverseerrmsg').innerHTML = escaped;
				window.obversetoobig = false;
				
				if(window.obversetoobig === false && window.reversetoobig === false && window.bonus1toobig === false && window.bonus2toobig === false && window.bonus3toobig === false && window.bonus4toobig === false) {
					document.getElementById('imgupload').addEventListener("submit", allowdef(event), false);
				}
				
				else {
					document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
				}
			}
		}
	}
}

function reverseimg() {
	document.getElementById('reverse').src = window.URL.createObjectURL(this.files[0]);
	
	const fi = document.getElementById('fileToUpload2');

	if (fi.files.length > 0) {
		for (var i = 0; i <= fi.files.length - 1; i++) {
			const fsize = fi.files.item(i).size;
			
			if (fsize > 10485760) {
				const escaped = escapeHTMLPolicy.createHTML("File exceeds 10 MB.");
				document.getElementById('reverseerrmsg').innerHTML = escaped;
				window.reversetoobig = true;
				document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
			}
			
			else {
				const escaped = escapeHTMLPolicy.createHTML("");
				document.getElementById('reverseerrmsg').innerHTML = escaped;
				window.reversetoobig = false;
				
				if(window.obversetoobig === false && window.reversetoobig === false && window.bonus1toobig === false && window.bonus2toobig === false && window.bonus3toobig === false && window.bonus4toobig === false) {
					document.getElementById('imgupload').addEventListener("submit", allowdef(event), false);
				}
				
				else {
					document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
				}
			}
		}
	}
}

function bonus1img() {
	document.getElementById('bonus1').src = window.URL.createObjectURL(this.files[0]);
	
	const fi = document.getElementById('fileToUpload3');

	if (fi.files.length > 0) {
		for (var i = 0; i <= fi.files.length - 1; i++) {
			const fsize = fi.files.item(i).size;
			
			if (fsize > 10485760) {
				const escaped = escapeHTMLPolicy.createHTML("File exceeds 10 MB.");
				document.getElementById('bonus1errmsg').innerHTML = escaped;
				window.bonus1toobig = true;
				document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
			}
			
			else {
				const escaped = escapeHTMLPolicy.createHTML("");
				document.getElementById('bonus1errmsg').innerHTML = escaped;
				window.bonus1toobig = false;
				
				if(window.obversetoobig === false && window.reversetoobig === false && window.bonus1toobig === false && window.bonus2toobig === false && window.bonus3toobig === false && window.bonus4toobig === false) {
					document.getElementById('imgupload').addEventListener("submit", allowdef(event), false);
				}
				
				else {
					document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
				}
			}
		}
	}
}

function bonus2img() {
	document.getElementById('bonus2').src = window.URL.createObjectURL(this.files[0]);
	
	const fi = document.getElementById('fileToUpload4');

	if (fi.files.length > 0) {
		for (var i = 0; i <= fi.files.length - 1; i++) {
			const fsize = fi.files.item(i).size;
			
			if (fsize > 10485760) {
				const escaped = escapeHTMLPolicy.createHTML("File exceeds 10 MB.");
				document.getElementById('bonus2errmsg').innerHTML = escaped;
				window.bonus2toobig = true;
				document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
			}
			
			else {
				const escaped = escapeHTMLPolicy.createHTML("");
				document.getElementById('bonus2errmsg').innerHTML = escaped;
				window.bonus2toobig = false;
				
				if(window.obversetoobig === false && window.reversetoobig === false && window.bonus1toobig === false && window.bonus2toobig === false && window.bonus3toobig === false && window.bonus4toobig === false) {
					document.getElementById('imgupload').addEventListener("submit", allowdef(event), false);
				}
				
				else {
					document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
				}
			}
		}
	}
}

function bonus3img() {
	document.getElementById('bonus3').src = window.URL.createObjectURL(this.files[0]);
	
	const fi = document.getElementById('fileToUpload5');

	if (fi.files.length > 0) {
		for (var i = 0; i <= fi.files.length - 1; i++) {
			const fsize = fi.files.item(i).size;
			
			if (fsize > 10485760) {
				const escaped = escapeHTMLPolicy.createHTML("File exceeds 10 MB.");
				document.getElementById('bonus3errmsg').innerHTML = escaped;
				window.bonus3toobig = true;
				document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
			}
			
			else {
				const escaped = escapeHTMLPolicy.createHTML("");
				document.getElementById('bonus3errmsg').innerHTML = escaped;
				window.bonus3toobig = false;
				
				if(window.obversetoobig === false && window.reversetoobig === false && window.bonus1toobig === false && window.bonus2toobig === false && window.bonus3toobig === false && window.bonus4toobig === false) {
					document.getElementById('imgupload').addEventListener("submit", allowdef(event), false);
				}
				
				else {
					document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
				}
			}
		}
	}
}

function bonus4img() {
	document.getElementById('bonus4').src = window.URL.createObjectURL(this.files[0]);
	
	const fi = document.getElementById('fileToUpload6');

	if (fi.files.length > 0) {
		for (var i = 0; i <= fi.files.length - 1; i++) {
			const fsize = fi.files.item(i).size;
			
			if (fsize > 10485760) {
				const escaped = escapeHTMLPolicy.createHTML("File exceeds 10 MB.");
				document.getElementById('bonus4errmsg').innerHTML = escaped;
				window.bonus4toobig = true;
				document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
			}
			
			else {
				const escaped = escapeHTMLPolicy.createHTML("");
				document.getElementById('bonus4errmsg').innerHTML = escaped;
				window.bonus4toobig = false;
				
				if(window.obversetoobig === false && window.reversetoobig === false && window.bonus1toobig === false && window.bonus2toobig === false && window.bonus3toobig === false && window.bonus4toobig === false) {
					document.getElementById('imgupload').addEventListener("submit", allowdef(event), false);
				}
				
				else {
					document.getElementById('imgupload').addEventListener("submit", preventdef(event), false);
				}
			}
		}
	}
}

var obverse = document.getElementById('fileToUpload1');
var reverse = document.getElementById('fileToUpload2');
var bonus1 = document.getElementById('fileToUpload3');
var bonus2 = document.getElementById('fileToUpload4');
var bonus3 = document.getElementById('fileToUpload5');
var bonus4 = document.getElementById('fileToUpload6');
var bonusyn = document.getElementById('bonusyn');
var bonusnumber = document.getElementById('bonusnumber');

if(typeof trustedTypes == 'undefined')trustedTypes={createPolicy:(n, rules) => rules};

const escapeHTMLPolicy = trustedTypes.createPolicy("myEscapePolicy", {
	createHTML: (string) => string.replace(/>/g, "<")
});

if(obverse !== null) {
	window.obversetoobig = false;
	window.reversetoobig = false;
	window.bonus1toobig = false;
	window.bonus2toobig = false;
	window.bonus3toobig = false;
	window.bonus4toobig = false;
	
	bonusyn.addEventListener("change", changerupper, false);
	bonusnumber.addEventListener("change", changerupper2, false);
	
	bonusnumber.style.display = "none";
	document.getElementById('bonusnumberlabel').style.display = "none";
	document.getElementById('bonus1label').style.display = "none";
	document.getElementById('bonus1br').style.display = "none";
	document.getElementById('bonus1').src = "placeholder.png";
	document.getElementById('fileToUpload3').style.display = "none";
	document.getElementById('bonus1tdr1').style.display = "none";
	document.getElementById('bonus1tdr2').style.display = "none";
	document.getElementById('bonus2label').style.display = "none";
	document.getElementById('bonus2br').style.display = "none";
	document.getElementById('bonus2').src = "placeholder.png";
	document.getElementById('fileToUpload4').style.display = "none";
	document.getElementById('bonus2tdr1').style.display = "none";
	document.getElementById('bonus2tdr2').style.display = "none";
	document.getElementById('bonus3label').style.display = "none";
	document.getElementById('bonus3br').style.display = "none";
	document.getElementById('bonus3').src = "placeholder.png";
	document.getElementById('fileToUpload5').style.display = "none";
	document.getElementById('bonus3tdr1').style.display = "none";
	document.getElementById('bonus3tdr2').style.display = "none";
	document.getElementById('bonus4label').style.display = "none";
	document.getElementById('bonus4br').style.display = "none";
	document.getElementById('bonus4').src = "placeholder.png";
	document.getElementById('fileToUpload6').style.display = "none";
	document.getElementById('bonus4tdr1').style.display = "none";
	document.getElementById('bonus4tdr2').style.display = "none";
	
	document.getElementById('obverse').src = "placeholder.png";
	document.getElementById('fileToUpload1').addEventListener("change", obverseimg, true);

	document.getElementById('reverse').src = "placeholder.png";
	document.getElementById('fileToUpload2').addEventListener("change", reverseimg, true);
}