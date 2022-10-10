function showtools(run) {
	
	var toolsdiv = document.getElementById('tools');
	var toolsbutton = document.getElementById('toolsbutton');
	
	if (run % 2 == 0) {
		run += 1;
		sessionStorage.setItem("run", run);
		toolsdiv.style.display = "none";
		toolsbutton.innerHTML = "Show tools";
	}
	
	else {
		run += 1;
		sessionStorage.setItem("run", run);
		toolsdiv.style.display = "inline";
		toolsbutton.innerHTML = "Hide tools";
	}
}

function passrun() {
	var toolsbutton = document.getElementById('toolsbutton');

	var run = parseInt(sessionStorage.getItem("run"));
	
	if(isNaN(run)) {
		run = 0;
		
		run += 1;

		sessionStorage.setItem("run", run);
		
		showtools(run);
	}
	
	else {
		showtools(run);
	}
}

if(toolsbutton !== null) {
	toolsbutton.addEventListener("click", passrun, false);
}

window.onbeforeunload = function(){
	sessionStorage.setItem("run", "1")
};