<?php

require_once("globalvars.php");

function normalizeident($normalized) {
	$normalized = preg_replace('/_/', ' ', $normalized);
	
	if(preg_match("/^([Pp][Cc][Gg][Ss])?([Nn][Gg][Cc])? /", $normalized)) {
		$exploded = explode(" ", $normalized);
		foreach($exploded as $key => $data) {
			if($key == 0) {
				$exploded[0] = strtoupper($exploded[0]);
			}
			
			else {
				$exploded[$key] = ucwords($exploded[$key]);
			}
		}
		$normalized = implode(" ", $exploded);
	}
	
	elseif(strtolower($normalized) == "tpg") {
		$normalized = "TPG";
	}

	else {
		$normalized = ucwords($normalized);
	}
	
	return $normalized;
}

?>