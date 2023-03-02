<?php

require_once("globalvars.php");

function echodoc() {
	require_once("template.php");
	printpagestart("Take A Picture"); ?>
		<div id="cover">Please&nbsp;<a href="lookup.php" target="_blank" id="lookup">click here</a>&nbsp;to continue.</div>
		<span>Use this tool to take a photo with your mobile device's camera of a barcode and decode it on the fly.</span>
		<br>
		<br>
		<span>It's as simple as:</span>
		<br>
		<br>
		<span>1. Click the "Open camera" button below.</span>
		<br>
		<span>2. Take a nice, well lit, clear photo of the barcode from about 3-5 inches (8-13 cm) away.</span>
		<br>
		<span>3. Click OK (or whatever your device says).</span>
		<br>
		<span>4. Wait for a response from the server.</span>
		<br>
		<span>5. With any luck, you will then be redirected to that coin's entry in CCIDB.</span>
		<br>
		<br>
		<form enctype="multipart/form-data" name="form" id="form" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
			<input required type="file" accept="image/*" capture="camera" name="takeapic" id="takeapic" class="takeapic" />
			<label for="takeapic"><strong>Open camera...</strong></label>
		</form>
		<br>
		<span id="status">Status: Waiting on photo upload from user...</span>
		<br>
		<span id="indexbtn"><a href="index.php"><button type="button">Return to top page</button></a></span>
		<script src="takeapic.js"></script>
<?php
	printpageend();
}

if(isset($_FILES) && !empty($_FILES)) {
	$takeapic = getcwd() . "/file.";
	
	$mime = $_FILES['takeapic']['type'];
	
	$ext = preg_replace("/image\/(.*)/", "$1", $mime);
	
	move_uploaded_file($_FILES['takeapic']['tmp_name'], $takeapic . $ext);
	
	$keepgoing = true;
	
	while($keepgoing == true) {
		if(file_exists($takeapic . $ext)) {
			$keepgoing = false;
			
			$cmd = "/bin/python3.10 takeapic.py " . $takeapic . $ext;
			
			$pipes = array();
			
			$descriptors = array(
				0 => array("pipe", "r"),
				1 => array("pipe", "w"),
				2 => array("file", "/tmp/errors.txt", "a"),
			);
			
			$dumpme = proc_open($cmd, $descriptors, $pipes) or die("Can't open process!");
			
			$final = "";
			
			if(is_resource($dumpme)) {
				while (!feof($pipes[1])) {
					$final .= fgets($pipes[1], 1024);
				}
				
				fclose($pipes[1]);
				
				proc_close($dumpme);
			}
			
			if(preg_match_all("/^Barcode: (\d{12})$/", $final, $pregresult)) {
				if(isset($pregresult[1][0])) {
					setcookie("barcode", $pregresult[1][0], time() + 3600);
					unlink($takeapic . $ext);
					echodoc();
				}
			}
			
			else {
				unlink($takeapic . $ext);
				require_once("template.php");
				printpagestart("Failure!"); ?>
					<span class="bad">Error: <?php print_r($final); ?></span>
					<br>
					<br>
					<form name="form" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
						<button type="submit" value="submit">Return to upload</button>
						<br>
						<a href="index.php"><button type="button">Return to top page</button></a>
					</form>
			<?php
				printpageend();
			}
		}
		
		else {
			$keepgoing = true;
		}
	}
}

else {
	echodoc();
} ?>