function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

document.addEventListener('DOMContentLoaded', async function() {
   await sleep(1000);
   document.getElementById('cover').style.display = "none";
}, false);