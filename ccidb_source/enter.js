function submit(){
	if(document.getElementById("searchform") !== null) {
		document.getElementById("searchform").submit();
	}
	
	else if (document.getElementById("updateform") !== null) {
		document.getElementById("updateform").submit();
	}
}

function enterPressed(){
	if (event.which == 13 || event.keyCode == 13) {
		submit();
	}
}

function toppage() {
	window.location = "index.php";
}

var textarea = document.getElementsByTagName('textarea');
var button = document.getElementById('top');

if(textarea !== null) {
	for(i = 0; i < textarea.length; i++) {
		textarea[i].addEventListener("keypress", enterPressed)
	}
}

if(button !== null) {
	button.addEventListener("click", toppage, false);
}