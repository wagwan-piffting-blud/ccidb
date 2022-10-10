<?php

require_once("functions.php");

require_once("globalvars.php");

require_once("allcolumns.php");

date_default_timezone_set($_SESSION['timezone']);

$sourcefile = debug_backtrace();

if(isset($sourcefile[1])) {
	$filetoinclude = preg_replace("/(.*\\\\)(.*\.php)/", "$2", $sourcefile[1]["file"]);
	$filetoinclude = preg_replace("/(.*\/)(.*\.php)/", "$2", $filetoinclude);
}

else {
	$filetoinclude = preg_replace("/(.*\\\\)(.*\.php)/", "$2", $sourcefile[0]["file"]);
	$filetoinclude = preg_replace("/(.*\/)(.*\.php)/", "$2", $filetoinclude);
}

//search.php
if($filetoinclude === "search.php") { ?>
        <div class="containerform">
			<form name="searchform" id="searchform" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post">
				<input type="hidden" id="csrf" name="csrf" value="<?php print_r($_SESSION['csrf']);?>" autocomplete="off" required>
				<input type="hidden" id="rpp" name="rpp" value="10"></input>
				<div id="leftmostform">
					<div id="datalinediv">
						<?php print_r("<label>Needs new holder?&nbsp;<input type=\"checkbox\" id=\"nnh\" name=\"nnh\" autocomplete=\"off\"></label>"); ?>
						<div class="separator"></div>
						<br class="mobileonly">
						<span id="dataline"><?php print_r("<label>Barcode: <br><input class=\"slightlylonginput\" type=\"text\" id=\"" . 'barcode' . "\" name=\"" . 'barcode' . "\" value=\"\" autocomplete=\"off\" pattern=\"\d*\"></label><br><br>"); ?></span>
						<div class="separator"></div>
						<span id="dataline2"><?php print_r("<label>Line: <br><input class=\"reallyshortinput\" type=\"text\" id=\"" . 'line' . "\" name=\"" . 'line' . "\" value=\"\" autocomplete=\"off\" pattern=\"\d*\"></label><br><br>"); ?></span>
					</div>
					<div id="basicsform">
						<span id="type"><?php print_r("<label title=\"The available choices for this field are Bill, Coin, Slab, Special, Token, and Whitman. More information is available in the manual.\" alt=\"The available choices for this field are Bill, Coin, Slab, Special, Token, and Whitman. More information is available in the manual.\">Type: <br><input class=\"medshortinput\" type=\"text\" id=\"type\" name=\"type\" value=\"\" autofocus=\"autofocus\" autocomplete=\"off\" pattern=\"^(Coin)?(Bill)?(Token)?(Whitman)?(Special)?(Slab)?$\"></label>"); ?></span>
						<br class="mobileonly">
						<span id="year"><?php print_r("<label>Year: <br><input class=\"medshortinput\" type=\"text\" id=\"year\" name=\"year\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br class="mobileonly">
						<span id="mintmark"><?php print_r("<label>Mint Mark: <br><input class=\"medshortinput\" type=\"text\" id=\"mintmark\" name=\"mintmark\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br class="mobileonly">
						<span id="denomination"><?php print_r("<label>Denomination: <br><input class=\"medshortinput\" type=\"text\" id=\"denomination\" name=\"denomination\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br class="mobileonly">
						<span id="country_of_origin"><?php print_r("<label>Country Of Origin: <br><input class=\"normalinput\" type=\"text\" id=\"country_of_origin\" name=\"country_of_origin\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
					</div>
					<div class="custombr"></div>
					<div id="meltinfo">
						<span id="composition"><?php print_r("<label>Composition: <br><input class=\"normalinput\" type=\"text\" id=\"composition\" name=\"composition\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br class="mobileonly">
						<span id="composition_amount"><?php print_r("<label>Composition Amount: <br><input class=\"normalinput\" type=\"text\" id=\"composition_amount\" name=\"composition_amount\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
					</div>
				</div>
				<div class="separatorform"></div>
				<div id="descnotesform">
					<span id="description"><?php print_r("<label>Description: <br><textarea class=\"smallertextarea\" id=\"description\" name=\"description\" autocomplete=\"off\"></textarea></label></span>"); ?>
					<br>
					<span id="notes"><?php print_r("<label>Notes: <br><textarea class=\"smallertextarea\" id=\"notes\" name=\"notes\" autocomplete=\"off\"></textarea></label></span>"); ?></span>
					<br>
				</div>
				<div class="separatorform"></div>
				<div id="rightmostform">
					<div id="tpginfoupdate">
						<span id="tpg"><?php print_r("<label>TPG: <br><input class=\"tpginput\" type=\"text\" id=\"tpg\" name=\"tpg\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br>
						<span id="grade"><?php print_r("<label>Grade: <br><input class=\"tpginput\" type=\"text\" id=\"grade\" name=\"grade\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br>
						<span id="cert"><?php print_r("<label>Cert: <br><input class=\"tpginput\" type=\"text\" id=\"cert\" name=\"cert\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
					</div>
					<div id="misc">
						<span id="serial"><?php print_r("<label>Serial: <br><input class=\"shortinput\" type=\"text\" id=\"serial\" name=\"serial\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br>
						<span id="location"><?php print_r("<label>Location: <br><input class=\"shortinput\" type=\"text\" id=\"location\" name=\"location\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br>
						<span id="pcgs_coinfacts"><?php print_r("<label>PCGS Coinfacts: <br><input class=\"medshortinput\" type=\"text\" id=\"pcgs_coinfacts\" name=\"pcgs_coinfacts\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br>
						<span id="ngc_coin_explorer"><?php print_r("<label>NGC Coin Explorer: <br><input class=\"medshortinput\" type=\"text\" id=\"ngc_coin_explorer\" name=\"ngc_coin_explorer\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
						<br>
						<span id="cost"><?php print_r("<label>Cost: <br>" . $_SESSION["currencysymbol"] . "<input class=\"medshortinput\" type=\"text\" id=\"cost\" name=\"cost\" value=\"\" autocomplete=\"off\"></label>"); ?></span>
					</div>
				</div>
			</form>
		</div>
<?php }

//show_output.php
elseif($filetoinclude === "show_output.php") {
	$_SESSION["string"]['barcode'] = str_pad($_SESSION["string"]['barcode'], 12, "0", STR_PAD_LEFT);
	
	$varcount = 0;
	
	foreach($allcolumns as $ident => $data) {
		$skip = 0;
		
		${$ident} = $_SESSION["string"][$ident];
		
		${$ident} = preg_replace("/(https?:\/\/?[^\s.]+\.[\w][^\s]+)/", "<span><a href=\"$1\" class=\"new_window\">$1</a></span>", ${$ident});
		
		${$ident} = preg_replace("/\r\n/", "<br>", ${$ident});
		
		${$ident} = preg_replace("/\'\'/", "'", ${$ident});
	} 
	
	if($hasimg === "1") {
		$sql1 = "SELECT img_obverse, img_reverse, img_bonus1, img_bonus2, img_bonus3, img_bonus4 FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
		
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			
			$stmt = $pdo->prepare($sql1);
			
			$stmt->bindValue(":barcode", $barcode);
			
			$stmt->execute();
			
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($result) {
				$oid_obverse = $result["img_obverse"];
				$oid_reverse = $result["img_reverse"];
				$oid_bonus1 = $result["img_bonus1"];
				$oid_bonus2 = $result["img_bonus2"];
				$oid_bonus3 = $result["img_bonus3"];
				$oid_bonus4 = $result["img_bonus4"];
				
				if(!empty($oid_obverse)) {
					$pdo->beginTransaction();
					$stream_obverse = $pdo->pgsqlLOBOpen($oid_obverse, 'r');
					$tempimg_obverse = base64_encode(stream_get_contents($stream_obverse));
					$mimetype_obverse = mime_content_type($stream_obverse);
					$img_obverse = "data:" . $mimetype_obverse . ";base64," . $tempimg_obverse;
					fclose($stream_obverse);
					$pdo->commit();
					
					$pdo->beginTransaction();
					$stream_reverse = $pdo->pgsqlLOBOpen($oid_reverse, 'r');
					$tempimg_reverse = base64_encode(stream_get_contents($stream_reverse));
					$mimetype_reverse = mime_content_type($stream_reverse);
					$img_reverse = "data:" . $mimetype_reverse . ";base64," . $tempimg_reverse;
					fclose($stream_reverse);
					$pdo->commit();
				}
				
				if(!empty($oid_bonus1)) {
					$pdo->beginTransaction();
					$stream_bonus1 = $pdo->pgsqlLOBOpen($oid_bonus1, 'r');
					$tempimg_bonus1 = base64_encode(stream_get_contents($stream_bonus1));
					$mimetype_bonus1 = mime_content_type($stream_bonus1);
					$img_bonus1 = "data:" . $mimetype_bonus1 . ";base64," . $tempimg_bonus1;
					fclose($stream_bonus1);
					$pdo->commit();
				}
				
				if(!empty($oid_bonus2)) {
					$pdo->beginTransaction();
					$stream_bonus2 = $pdo->pgsqlLOBOpen($oid_bonus2, 'r');
					$tempimg_bonus2 = base64_encode(stream_get_contents($stream_bonus2));
					$mimetype_bonus2 = mime_content_type($stream_bonus2);
					$img_bonus2 = "data:" . $mimetype_bonus2 . ";base64," . $tempimg_bonus2;
					fclose($stream_bonus2);
					$pdo->commit();
				}
				
				if(!empty($oid_bonus3)) {
					$pdo->beginTransaction();
					$stream_bonus3 = $pdo->pgsqlLOBOpen($oid_bonus3, 'r');
					$tempimg_bonus3 = base64_encode(stream_get_contents($stream_bonus3));
					$mimetype_bonus3 = mime_content_type($stream_bonus3);
					$img_bonus3 = "data:" . $mimetype_bonus3 . ";base64," . $tempimg_bonus3;
					fclose($stream_bonus3);
					$pdo->commit();
				}
				
				if(!empty($oid_bonus4)) {
					$pdo->beginTransaction();
					$stream_bonus4 = $pdo->pgsqlLOBOpen($oid_bonus4, 'r');
					$tempimg_bonus4 = base64_encode(stream_get_contents($stream_bonus4));
					$mimetype_bonus4 = mime_content_type($stream_bonus4);
					$img_bonus4 = "data:" . $mimetype_bonus4 . ";base64," . $tempimg_bonus4;
					fclose($stream_bonus4);
					$pdo->commit();
				}
			}
		}

		catch(PDOException $e) {
			echo $e->getMessage();
			die();
		}
	}
	
	?>
	<div class="container">
		<div id="leftmost">
			<div id="datalinediv">
				<span id="dataline">Data for entry #<?php print_r($barcode); ?></span>
				<span id="dataline2">&nbsp;(line #<?php print_r($line); ?>):</span>
			</div>
			<div id="allimages">
				<table id="imagestable">
					<tbody>
						<tr>
							<td><span>Obverse</span></td>
							<td><span>Reverse</span></td>
						</tr>
						<tr>
							<td><img <?php if($type === "Bill") { print_r("class=\"bill\" "); } else { print_r(" "); } ?>id="obverse" src="<?php if($hasimg === "1") { print_r($img_obverse); } else { print_r("placeholder.png"); } ?>" alt="Obverse Image"></td>
							<td><img <?php if($type === "Bill") { print_r("class=\"bill\" "); } else { print_r(" "); } ?>id="reverse" src="<?php if($hasimg === "1") { print_r($img_reverse); } else { print_r("placeholder.png"); } ?>" alt="Reverse Image"></td>
						</tr>
					</tbody>
				</table>
				<table id="imagestablebonus">
					<tbody>
						<tr>
							<td><span>Bonus Image #1</span></td>
							<td><span>Bonus Image #2</span></td>
							<td><span>Bonus Image #3</span></td>
							<td><span>Bonus Image #4</span></td>
						</tr>
						<tr>
							<td><img id="bonus1" src="<?php if($hasimg === "1" && !empty($img_bonus1)) { print_r($img_bonus1); } else { print_r("placeholder.png"); } ?>" alt="Bonus Image #1"></td>
							<td><img id="bonus2" src="<?php if($hasimg === "1" && !empty($img_bonus2)) { print_r($img_bonus2); } else { print_r("placeholder.png"); } ?>" alt="Bonus Image #2"></td>
							<td><img id="bonus3" src="<?php if($hasimg === "1" && !empty($img_bonus3)) { print_r($img_bonus3); } else { print_r("placeholder.png"); } ?>" alt="Bonus Image #3"></td>
							<td><img id="bonus4" src="<?php if($hasimg === "1" && !empty($img_bonus4)) { print_r($img_bonus4); } else { print_r("placeholder.png"); } ?>" alt="Bonus Image #4"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="basics">
				<span id="type">Type:<br><?php if(!empty($type)) { print_r($type); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="year">Year:<br><?php if(!empty($year)) { print_r($year); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="mintmark">Mint:<br><?php if(!empty($mint)) { print_r($mint); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="denomination">Denomination:<br><?php if(!empty($denomination)) { print_r($denomination); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="country_of_origin">Country Of Origin:<br><?php if(!empty($country_of_origin)) { print_r($country_of_origin); } else { print_r("NONE"); } ?></span>
			</div>
			<div class="custombr"></div>
			<div id="meltinfo">
				<span id="composition">Composition:<br><?php if(!empty($composition)) { print_r($composition); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="composition_amount">Composition Amount:<br><?php if(!empty($composition_amount)) { print_r($composition_amount); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="melt">Melt:<br><?php if(isset($melt) && !empty($melt) && isset($composition) && !empty($composition) && isset($composition_amount) && !empty($composition_amount)) {
					preg_match("/[Xx][Pp]?[Aa]?[GUTDgutd]/", $composition, $metalmatcharray);
					preg_match("/\d\.\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?/", $composition_amount, $compamountarray);
					
					if(isset($_SESSION['metalsapi']) && !empty($_SESSION['metalsapi'])) {
						if(isset($_SESSION['currencysymbol'])) {
							switch($_SESSION['currencysymbol']) {
								case '$':
									$tocurrency = "USD";
									break;
								case 'AU$':
									$tocurrency = "AUD";
									break;
								case 'CA$':
									$tocurrency = "CAD";
									break;
								case 'US$':
									$tocurrency = "USD";
									break;
								case '₿':
									$tocurrency = "BTC";
									break;
								case '¥':
									$tocurrency = "JPY";
									break;
								case '€':
									$tocurrency = "EUR";
									break;
								case '£':
									$tocurrency = "GBP";
									break;
								case '₩':
									$tocurrency = "KRW";
									break;
								default:
									$tocurrency = "USD";
									break;
							}
						}
						
						else {
							$tocurrency = "USD";
						}
						
						$curl = curl_init();

						curl_setopt_array($curl, array(
							CURLOPT_URL => 'https://metals-api.com/api/convert?access_key=' . $_SESSION['metalsapi'] . '&from=' . $metalmatcharray[0] . '&to=' . $tocurrency . '&amount=' . $compamountarray[0],
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'GET',
						));

						$data = curl_exec($curl);

						$httpcode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

						if (curl_errno($curl)) {
							$error_msg = curl_error($curl);
						}

						curl_close($curl);

						if (isset($error_msg)) {
							$error = "cURL Error: \"" . $error_msg . "\", aborting!";
							print_r($error);
							
						}

						if($httpcode === 200) {
							$json = json_decode($data, true);
							$amount = (float) $json["result"];
							$currenttime = $json["info"]["timestamp"];
							$amount = number_format($amount, 2, '.', ',');
							$date = DateTime::createFromFormat("U", $currenttime);
							$date->setTimezone(new DateTimeZone($_SESSION['timezone']));
							$reqtime = $date->format("h:i:s a \o\\n Y\-m\-d");

							print_r("Approximately " . $_SESSION['currencysymbol'] . $amount);
							
							$meltline = "(Amount current as of " . $reqtime . ".)";
						}
						
						else {
							$error = "Expected HTTP 200, got " . $httpcode . " instead, aborting!";
							print_r($error);
						}
					}
					
					else {
						$error = "You must have a Metals-API key to view melt values.";
						print_r($error);
					} 
				}

				else {
					print_r("NONE");
					$error = "";
				} ?></span>
			</div>
			<span id="meltline" class="smallnostar"><?php if(isset($meltline)) { print_r($meltline); } else { print_r($error); } ?></span>
		</div>
		<div class="separator"></div>
		<div id="descnotes">
			<?php if($nnh === "1") { ?>
			<span class="nnh">THIS COIN NEEDS A NEW HOLDER! REPLACE IT AS SOON AS POSSIBLE.</span>
			<br class="marginbr">
			<?php } 
			
			if(isset($description) && !empty($description)) { ?>
			<span id="description">Description:<br><?php print_r($description); ?></span>
			<br class="marginbr">
			<span id="notes">Notes:<br><?php if(!empty($notes)) { print_r($notes); } else { print_r("NONE"); } ?></span>
			<?php } 
			
			else {
				print_r("<span id=\"description\">This entry has no information associated with it. You may \"create\" it by using the button above.</span>");
			} ?>
			<br>
		</div>
		<div class="separator"></div>
		<div id="rightmost">
			<div id="misc">
					<div id="tpginfo">
						<span id="tpg">TPG:<br><?php if(!empty($tpg)) { print_r($tpg); } else { print_r("NONE"); } ?></span>
						<br class="marginbr">
						<span id="grade">Grade:<br><?php if(!empty($grade)) { print_r($grade); } else { print_r("NONE"); } ?></span>
						<br class="marginbr">
						<span id="cert">Cert:<br><?php
						if(isset($cert) && !empty($cert) && isset($tpg) && !empty($tpg) && strtolower($tpg) === "pcgs") {
							print_r("<a href=\"https://www.pcgs.com/cert/" . $cert . "\" class=\"new_window\">" . $cert . "</a>");
						}
						
						elseif(isset($cert) && !empty($cert) && isset($tpg) && !empty($tpg) && isset($grade) && !empty($grade) && strtolower($tpg) === "ngc") {
							if(preg_match("/(\d\d)/", $grade, $ngcmatch)) {
								$finalgrade = $ngcmatch[0];
								//break;
							}
								
							elseif(preg_match("/Ancients/", $grade)) {
								$finalgrade = "NGCAncients";
								//break;
							}
							
							elseif(preg_match("/Details/", $grade)) {
								$finalgrade = "NGCDetails";
								//break;
							}
							
							elseif(preg_match("/Other/", $grade)) {
								$finalgrade = "Other";
								//break;
							}
							
							else {
								$finalgrade = "Other";
								//break;
							}
							
							$finalgrade = preg_replace("/\s+/", "", $finalgrade);
							
							print_r("<a href=\"https://www.ngccoin.com/certlookup/" . $cert . "/" . $finalgrade . "\" class=\"new_window\">" . $cert . "</a>");
						}
						
						elseif(isset($cert) && !empty($cert) && isset($tpg) && !empty($tpg) && strtolower($tpg) === "anacs") {
							print_r("<a href=\"https://www.anacs.com/Verify/CertVerification.aspx?cert=" . $cert . "\" class=\"new_window\">" . $cert . "</a>");
						}
						
						elseif(isset($cert) && !empty($cert)) {
							print_r($cert);
						}
						
						else {
							print_r("NONE");
						} ?></span>
				</div>
				<span id="serial">Serial:<br><?php if(!empty($serial)) { print_r($serial); } else { print_r("NONE"); } ?></span>
				<br class="marginbr">
				<span id="location">Location:<br><?php if(!empty($location)) { print_r($location); } else { print_r("NONE"); } ?></span>
				<br class="marginbr">
				<span id="pcgs_coinfacts">PCGS Coinfacts:<br><?php
				
				if(isset($pcgs_coinfacts) && !empty($pcgs_coinfacts) && preg_match("/\,\ /", $pcgs_coinfacts)) {
					$coinfactsarray = explode(", ", $pcgs_coinfacts);
					
					foreach($coinfactsarray as $cfkey => $cfdata) {
						if($cfkey === count($coinfactsarray) - 1) {
							print_r("<a href=\"https://www.pcgs.com/coinfacts/coin/detail/" . $cfdata . "\" class=\"new_window\">" . $cfdata . "</a>");
						}
						
						else {
							print_r("<a href=\"https://www.pcgs.com/coinfacts/coin/detail/" . $cfdata . "\" class=\"new_window\">" . $cfdata . "</a>, ");
						}
					}
				}
				
				elseif(isset($pcgs_coinfacts) && !empty($pcgs_coinfacts)) {
					print_r("<a href=\"https://www.pcgs.com/coinfacts/coin/detail/" . $pcgs_coinfacts . "\" class=\"new_window\">" . $pcgs_coinfacts . "</a>");
				}
				
				else {
					print_r("NONE");
				} ?></span>
				<br class="marginbr">
				<span id="ngc_coin_explorer">NGC Coin Explorer:<br><?php
				
				if(isset($ngc_coin_explorer) && !empty($ngc_coin_explorer) && preg_match("/\,\ /", $ngc_coin_explorer)) {
					$coinexplorerarray = explode(", ", $ngc_coin_explorer);
					
					foreach($coinexplorerarray as $cekey => $cedata) {
						if($cekey === count($coinexplorerarray) - 1) {
							print_r("<a href=\"https://www.ngccoin.com/redirects/coin-explorer/" . $cedata . "\" class=\"new_window\">" . $cedata . "</a>");
						}
						
						else {
							print_r("<a href=\"https://www.ngccoin.com/redirects/coin-explorer/" . $cedata . "\" class=\"new_window\">" . $cedata . "</a>, ");
						}
					}
				}
				
				elseif(isset($ngc_coin_explorer) && !empty($ngc_coin_explorer)) {
					print_r("<a href=\"https://www.ngccoin.com/redirects/coin-explorer/" . $ngc_coin_explorer . "\" class=\"new_window\">" . $ngc_coin_explorer . "</a>");
				}
				
				else {
					print_r("NONE");
				} ?></span>
				<br class="marginbr">
				<span id="cost">Cost:<br><?php if(!empty($cost)) { print_r($_SESSION['currencysymbol'] . $cost); } else { print_r("NONE"); } ?></span>
			</div>
		</div>
	</div>
	<script src="removecover.js"></script>
	<script src="navigateaway.js"></script>
<?php }

//update.php
elseif($filetoinclude === "update.php") {
	if((isset($row) && isset($row['nnh'])) && ($row['nnh'] === "1" || $row['nnh'] === 1)) {
		$nnh = 1;
	}
	
	else {
		$nnh = 0;
	}
	
	if((isset($row) && isset($row['melt'])) && ($row['melt'] === "1" || $row['melt'] === 1)) {
		$melt = 1;
	}
	
	else {
		$melt = 0;
	}
	
	foreach($allcolumns as $ident => $data) {
    	if(isset($row['type'])) {
			${$ident} = $row[$ident];
		}
    } ?>
        <div class="containerform">
			<form name="updateform" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post" id="updateform">
				<input type="hidden" id="csrf" name="csrf" value="<?php print_r($_SESSION['csrf']);?>" required>
				<div id="leftmostform">
					<div id="datalinediv">
						<?php if(!isset($row["nnh"]) && !isset($setme)) { print_r("<label>Needs new holder?&nbsp;<input type=\"checkbox\" id=\"nnh\" name=\"nnh\" autocomplete=\"off\"></label>"); } elseif($row["nnh"] === 1 && isset($setme)) { print_r("<label>Needs new holder?&nbsp;<input type=\"checkbox\" id=\"nnh\" name=\"nnh\" autocomplete=\"off\" checked></label>"); } elseif($row["nnh"] === 0 && isset($setme)) { print_r("<label>Needs new holder?&nbsp;<input type=\"checkbox\" id=\"nnh\" name=\"nnh\" autocomplete=\"off\"></label>"); } ?>
						<div class="separator"></div>
						<br class="mobileonly">
						<span id="dataline"><?php if(!isset($barcode) && !isset($setme)) { 
															$keepgoing = true;
															
															function generate() {
																$randomint = random_int(10000000000, 99999999999);
																$codearray = str_split($randomint);
																$sumofodd = ($codearray[0] + $codearray[2] + $codearray[4] + $codearray[6] + $codearray[8] + $codearray[10]) * 3;
																$sumofeven = $codearray[1] + $codearray[3] + $codearray[5] + $codearray[7] + $codearray[9];
																$total = $sumofodd + $sumofeven;
																$check = (ceil($total / 10) * 10) - $total;
																$dbcheck = $randomint . $check;
																return $dbcheck;
															}
															
															while($keepgoing === true) {
																$sql2 = "SELECT * FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
																
																try {
																	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
																	
																	$stmt2 = $pdo->prepare($sql2);
																	
																	$generated = generate();
																	
																	$stmt2->bindValue(":barcode", $generated);
																	
																	$stmt2->setFetchMode(PDO::FETCH_ASSOC);
																	
																	$result2 = $stmt2->execute();
																	
																	if($result) {
																		$exists = $stmt2->fetch();
																		if(!$exists) {
																			$keepgoing = false;
																			print_r("<label class=\"required\">Barcode: <br><input class=\"slightlylonginput\" type=\"text\" id=\"" . 'barcode' . "\" name=\"" . 'barcode' . "\" value=\"" . $generated . "\" autocomplete=\"off\" pattern=\"\d*\" readonly required></label><br><br>");
																			break;
																		}
																		
																		else {
																			$keepgoing = true;
																		}
																	}
																	
																	else {
																		$keepgoing = false;
																		print_r("<label class=\"required\">Barcode: <br><input class=\"slightlylonginput\" type=\"text\" id=\"" . 'barcode' . "\" name=\"" . 'barcode' . "\" value=\"1Failed to check DB.\" autocomplete=\"off\" pattern=\"\d*\" readonly required></label><br><br>");
																		break;
																	}
																}
																
																catch(PDOException $e) {
																	echo $e->getMessage();
																	die();
																}
															}
														} else { print_r("<label class=\"required\">Barcode: <br><input class=\"slightlylonginput\" type=\"text\" id=\"" . 'barcode' . "\" name=\"" . 'barcode' . "\" value=\"" . $row['barcode'] . "\" autocomplete=\"off\" pattern=\"\d*\" readonly required></label><br><br>"); } ?></span>
														<div class="separator"></div>
						<span id="dataline2"><?php if(!isset($line) && !isset($setme)) {
																$sql1 = "SELECT MAX(line) FROM " . $_SESSION["tablename"] . " WHERE line != '123456';";
																
																try {
																	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
																	
																	$stmt = $pdo->prepare($sql1);
																	
																	$stmt->setFetchMode(PDO::FETCH_ASSOC);
																	
																	$result = $stmt->execute();
																	
																	if($result) {
																		$maxline = $stmt->fetch();
																		$maxline = $maxline["max"];
																		$intmaxline = (int) $maxline;
																		$intmaxline++;
																		print_r("<label class=\"required\">Line: <br><input class=\"reallyshortinput\" type=\"text\" id=\"" . 'line' . "\" name=\"" . 'line' . "\" value=\"" . $intmaxline . "\" autocomplete=\"off\" pattern=\"\d*\" readonly required></label><br><br>");
																	}
																	
																	else {
																		print_r("<label class=\"required\">Line: <br><input class=\"reallyshortinput\" type=\"text\" id=\"" . 'line' . "\" name=\"" . 'line' . "\" value=\"Failed to get last line.\" autocomplete=\"off\" pattern=\"\d*\" readonly required></label><br><br>");
																	}
																}
																
																catch(PDOException $e) {
																	echo $e->getMessage();
																	die();
																}
															}
															
															else {
																print_r("<label class=\"required\">Line: <br><input class=\"reallyshortinput\" type=\"text\" id=\"" . 'line' . "\" name=\"" . 'line' . "\" value=\"" . $row['line'] . "\" autocomplete=\"off\" pattern=\"\d*\" readonly required></label><br><br>");
															}
															
															?></span>
					</div>
					<div id="basicsform">
						<span id="type"><?php if(!isset($type) && !isset($setme)) { print_r("<label title=\"The available choices for this field are Bill, Coin, Slab, Special, Token, and Whitman. More information is available in the manual.\" alt=\"The available choices for this field are Bill, Coin, Slab, Special, Token, and Whitman. More information is available in the manual.\" class=\"required\">Type: <br><input class=\"medshortinput\" type=\"text\" id=\"type\" name=\"type\" value=\"\" autofocus=\"autofocus\" autocomplete=\"off\" pattern=\"^(Coin)?(Bill)?(Token)?(Whitman)?(Special)?(Slab)?$\" required></label>"); } elseif(isset($type) && isset($setme)) { print_r("<label title=\"The available choices for this field are Bill, Coin, Slab, Special, Token, and Whitman. More information is available in the manual.\" alt=\"The available choices for this field are Bill, Coin, Slab, Special, Token, and Whitman. More information is available in the manual.\"class=\"required\">Type: <br><input class=\"medshortinput\" type=\"text\" id=\"type\" name=\"type\" value=\"" . $row['type'] . "\" autofocus=\"autofocus\" autocomplete=\"off\" pattern=\"^(Coin)?(Bill)?(Token)?(Whitman)?(Special)?(Slab)?$\" required></label>"); } ?></span>
						<br class="mobileonly">
						<span id="year"><?php if(!isset($year) && !isset($setme)) { print_r("<label>Year: <br><input class=\"medshortinput\" type=\"text\" id=\"year\" name=\"year\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($year) && isset($setme)) { print_r("<label>Year: <br><input class=\"medshortinput\" type=\"text\" id=\"year\" name=\"year\" value=\"" . $row['year'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br class="mobileonly">
						<span id="mintmark"><?php if(!isset($mintmark) && !isset($setme)) { print_r("<label>Mint Mark: <br><input class=\"medshortinput\" type=\"text\" id=\"mintmark\" name=\"mintmark\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($mintmark) && isset($setme)) { print_r("<label>Mint Mark: <br><input class=\"medshortinput\" type=\"text\" id=\"mintmark\" name=\"mintmark\" value=\"" . $row['mintmark'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br class="mobileonly">
						<span id="denomination"><?php if(!isset($denomination) && !isset($setme)) { print_r("<label>Denomination: <br><input class=\"medshortinput\" type=\"text\" id=\"denomination\" name=\"denomination\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($denomination) && isset($setme)) { print_r("<label>Denomination: <br><input class=\"medshortinput\" type=\"text\" id=\"denomination\" name=\"denomination\" value=\"" . $row['denomination'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br class="mobileonly">
						<span id="country_of_origin"><?php if(!isset($country_of_origin) && !isset($setme)) { print_r("<label>Country Of Origin: <br><input class=\"normalinput\" type=\"text\" id=\"country_of_origin\" name=\"country_of_origin\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($country_of_origin) && isset($setme)) { print_r("<label>Country Of Origin: <br><input class=\"normalinput\" type=\"text\" id=\"country_of_origin\" name=\"country_of_origin\" value=\"" . $row['country_of_origin'] . "\" autocomplete=\"off\"></label>"); } ?></span>
					</div>
					<div class="custombr"></div>
					<div id="meltinfo">
						<span id="composition"><?php if(!isset($composition) && !isset($setme)) { print_r("<label>Composition: <br><input class=\"normalinput\" type=\"text\" id=\"composition\" name=\"composition\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($composition) && isset($setme)) { print_r("<label>Composition: <br><input class=\"normalinput\" type=\"text\" id=\"composition\" name=\"composition\" value=\"" . $row['composition'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br class="mobileonly">
						<span id="composition_amount"><?php if(!isset($composition_amount) && !isset($setme)) { print_r("<label>Composition Amount: <br><input class=\"normalinput\" type=\"text\" id=\"composition_amount\" name=\"composition_amount\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($composition_amount) && isset($setme)) { print_r("<label>Composition Amount: <br><input class=\"normalinput\" type=\"text\" id=\"composition_amount\" name=\"composition_amount\" value=\"" . $row['composition_amount'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br class="mobileonly">
						<span id="melt"><?php if(!isset($row["melt"]) && !isset($setme)) { print_r("<label>Display melt values?&nbsp;<input type=\"checkbox\" id=\"melt\" name=\"melt\" autocomplete=\"off\"></label>"); } elseif($row["melt"] === 1 && isset($setme)) { print_r("<label>Display melt values?&nbsp;<input type=\"checkbox\" id=\"melt\" name=\"melt\" autocomplete=\"off\" checked></label>"); } elseif($row["melt"] === 0 && isset($setme)) { print_r("<label>Display melt values?&nbsp;<input type=\"checkbox\" id=\"melt\" name=\"melt\" autocomplete=\"off\"></label>"); } ?></span>
					</div>
				</div>
				<div class="separatorform"></div>
				<div id="descnotesform">
					<span id="description"><?php if(!isset($description) && !isset($setme)) { print_r("<label class=\"required\">Description: <br><textarea class=\"smallertextarea\" id=\"description\" name=\"description\" autocomplete=\"off\" required></textarea></label></span>"); } elseif(isset($description) && isset($setme)) { print_r("<label class=\"required\">Description: <br><textarea class=\"smallertextarea\" id=\"description\" name=\"description\" autocomplete=\"off\" required>" . $row['description'] . "</textarea></label></span>"); } ?>
					<br>
					<span id="notes"><?php if(!isset($notes) && !isset($setme)) { print_r("<label>Notes: <br><textarea class=\"smallertextarea\" id=\"notes\" name=\"notes\" autocomplete=\"off\"></textarea></label></span>"); } elseif(isset($notes) && isset($setme)) { print_r("<label>Notes: <br><textarea class=\"smallertextarea\" id=\"notes\" name=\"notes\" autocomplete=\"off\">" . $row['notes'] . "</textarea></label></span>"); } ?></span>
					<br>
				</div>
				<div class="separatorform"></div>
				<div id="rightmostform">
					<div id="tpginfoupdate">
						<span id="tpg"><?php if(!isset($tpg) && !isset($setme)) { print_r("<label>TPG: <br><input class=\"tpginput\" type=\"text\" id=\"tpg\" name=\"tpg\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($tpg) && isset($setme)) { print_r("<label>TPG: <br><input class=\"tpginput\" type=\"text\" id=\"tpg\" name=\"tpg\" value=\"" . $row['tpg'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br>
						<span id="grade"><?php if(!isset($grade) && !isset($setme)) { print_r("<label>Grade: <br><input class=\"tpginput\" type=\"text\" id=\"grade\" name=\"grade\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($grade) && isset($setme)) { print_r("<label>Grade: <br><input class=\"tpginput\" type=\"text\" id=\"grade\" name=\"grade\" value=\"" . $row['grade'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br>
						<span id="cert"><?php if(!isset($cert) && !isset($setme)) { print_r("<label>Cert: <br><input class=\"tpginput\" type=\"text\" id=\"cert\" name=\"cert\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($cert) && isset($setme)) { print_r("<label>Cert: <br><input class=\"tpginput\" type=\"text\" id=\"cert\" name=\"cert\" value=\"" . $row['cert'] . "\" autocomplete=\"off\"></label>"); } ?></span>
					</div>
					<div id="misc">
						<span id="serial"><?php if(!isset($serial) && !isset($setme)) { print_r("<label>Serial: <br><input class=\"medshortinput\" type=\"text\" id=\"serial\" name=\"serial\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($serial) && isset($setme)) { print_r("<label>Serial: <br><input class=\"medshortinput\" type=\"text\" id=\"serial\" name=\"serial\" value=\"" . $row['serial'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br>
						<span id="location"><?php if(!isset($location) && !isset($setme)) { print_r("<label>Location: <br><input class=\"shortinput\" type=\"text\" id=\"location\" name=\"location\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($location) && isset($setme)) { print_r("<label>Location: <br><input class=\"shortinput\" type=\"text\" id=\"location\" name=\"location\" value=\"" . $row['location'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br>
						<span id="pcgs_coinfacts"><?php if(!isset($pcgs_coinfacts) && !isset($setme)) { print_r("<label>PCGS Coinfacts: <br><input class=\"medshortinput\" type=\"text\" id=\"pcgs_coinfacts\" name=\"pcgs_coinfacts\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($pcgs_coinfacts) && isset($setme)) { print_r("<label>PCGS Coinfacts: <br><input class=\"medshortinput\" type=\"text\" id=\"pcgs_coinfacts\" name=\"pcgs_coinfacts\" value=\"" . $row['pcgs_coinfacts'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br>
						<span id="ngc_coin_explorer"><?php if(!isset($ngc_coin_explorer) && !isset($setme)) { print_r("<label>NGC Coin Explorer: <br><input class=\"medshortinput\" type=\"text\" id=\"ngc_coin_explorer\" name=\"ngc_coin_explorer\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($ngc_coin_explorer) && isset($setme)) { print_r("<label>NGC Coin Explorer: <br><input class=\"medshortinput\" type=\"text\" id=\"ngc_coin_explorer\" name=\"ngc_coin_explorer\" value=\"" . $row['ngc_coin_explorer'] . "\" autocomplete=\"off\"></label>"); } ?></span>
						<br>
						<span id="cost"><?php if(!isset($cost) && !isset($setme)) { print_r("<label>Cost: <br>" . $_SESSION["currencysymbol"] . "<input class=\"medshortinput\" type=\"text\" id=\"cost\" name=\"cost\" value=\"\" autocomplete=\"off\"></label>"); } elseif(isset($cost) && isset($setme)) { print_r("<label>Cost: <br>" . $_SESSION["currencysymbol"] . "<input class=\"medshortinput\" type=\"text\" id=\"cost\" name=\"cost\" value=\"" . $row['cost'] . "\" autocomplete=\"off\"></label>"); } ?></span>
					</div>
					<div class="custombr"></div>
					<label class="small">&nbsp;indicates a required field.</label>
				</div>
			</form>
		</div>
<?php 
}

//searchresults.php
elseif($filetoinclude === "searchresults.php") {
	if(is_array($_SESSION['result'])) {
		if($_GET['pagesize'] == 10) { 
			$temparray = array_slice($_SESSION["result"], $_GET['startat'], $_GET['pagesize']);
			if(!isset($_SESSION['tens'])) {
				$_SESSION['tens'] = 10;
				$_SESSION['i3'] = 0;
				preg_match('/(\d)\D*$/', $_SESSION['nrows'], $m);
				$lastnum = $m[1];
			}
			else {
				if($_SESSION['oldstart'] < $_GET['startat']) {
					$_SESSION['tens'] = 10;
					$_SESSION['i3'] = 0;
					preg_match('/(\d)\D*$/', $_SESSION['nrows'], $m);
					$lastnum = $m[1];
				}
				
				else {
					$_SESSION['tens'] = 10;
					$_SESSION['i3'] = 0;
					preg_match('/(\d)\D*$/', $_SESSION['nrows'], $m);
					$lastnum = $m[1];
				}
			}
		?>
			<table class="searchtable" id="searchtable">
				<thead>
					<tr class="searchrow" id="searchthead">
						<th>Obverse</th>
						<th>Reverse</th>
						<th>Barcode</th>
						<th>Line</th>
						<th>Type</th>
						<th>Year</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody id="searchtbody">
		<?php
		
		if(isset($_SESSION['i3'])) {
			if(($_GET['startat'] + 10) >= $_SESSION['nrows']) {
				for($_SESSION['i3'] = $_SESSION['i3']; $_SESSION['i3'] < $lastnum; $_SESSION['i3']++) {
					$run = 0;
					$concat = "";
					$yearmm = "";
					$varcount = 0;
					$match = "";
					
					foreach($allcolumns as $ident => $data) {
						$skip = 0;
						
						if($skip === 0) {
							${$ident} = $temparray[$_SESSION['i3']][$ident];
							
							if($ident === "barcode") {
								${$ident} = str_pad(${$ident}, 12, "0", STR_PAD_LEFT);
							}
						}
					}
					
					if($hasimg === 1) {
						$sql1 = "SELECT img_obverse, img_reverse FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
						
						try {
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
							
							$stmt = $pdo->prepare($sql1);
							
							$stmt->bindValue(":barcode", $barcode);
							
							$stmt->execute();
							
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							
							if($result) {
								$oid_obverse = $result["img_obverse"];
								$oid_reverse = $result["img_reverse"];
								
								if(!empty($oid_obverse)) {
									$pdo->beginTransaction();
									$stream_obverse = $pdo->pgsqlLOBOpen($oid_obverse, 'r');
									$tempimg_obverse = base64_encode(stream_get_contents($stream_obverse));
									$mimetype_obverse = mime_content_type($stream_obverse);
									$img_obverse = "data:" . $mimetype_obverse . ";base64," . $tempimg_obverse;
									fclose($stream_obverse);
									$pdo->commit();
									
									$pdo->beginTransaction();
									$stream_reverse = $pdo->pgsqlLOBOpen($oid_reverse, 'r');
									$tempimg_reverse = base64_encode(stream_get_contents($stream_reverse));
									$mimetype_reverse = mime_content_type($stream_reverse);
									$img_reverse = "data:" . $mimetype_reverse . ";base64," . $tempimg_reverse;
									fclose($stream_reverse);
									$pdo->commit();
								}
							}
						}
						
						catch(PDOException $e) {
							echo $e->getMessage();
							die();
						}
					}
					
					else {
						$img_obverse = "placeholder.png";
						$img_reverse = "placeholder.png";
					}
					
					print_r("<tr class=\"searchrow\">\n<td><img class=\"searchimg\" src=\"" . $img_obverse . "\"></img></td>\n<td><img class=\"searchimg\" src=\"" . $img_reverse . "\"></img></td>\n<td>" . $barcode . "</td>\n<td>" . $line . "</td>\n<td>" . $type . "</td>\n<td>" . $year . "</td>\n<td>" . $description . "</td>\n</tr>");
				} 
				unset($_SESSION['i3']);
				?>
					</tbody>
				</table>
			<?php 
			}
			
			elseif(($_GET['startat'] + 10) <= $_SESSION['nrows']) {
				//die("found 028494");
				for($_SESSION['i3'] = $_SESSION['i3']; $_SESSION['i3'] < $_SESSION['tens']; $_SESSION['i3']++) {
					$run = 0;
					$concat = "";
					$yearmm = "";
					$varcount = 0;
					$match = "";
					
					foreach($allcolumns as $ident => $data) {
						$skip = 0;
						
						if($skip === 0) {
							${$ident} = $temparray[$_SESSION['i3']][$ident];
							
							if($ident === "barcode") {
								${$ident} = str_pad(${$ident}, 12, "0", STR_PAD_LEFT);
							}
						}
					}
					
					if($hasimg === 1) {
						$sql1 = "SELECT img_obverse, img_reverse FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
						
						try {
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
							
							$stmt = $pdo->prepare($sql1);
							
							$stmt->bindValue(":barcode", $barcode);
							
							$stmt->execute();
							
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							
							if($result) {
								$oid_obverse = $result["img_obverse"];
								$oid_reverse = $result["img_reverse"];
								
								if(!empty($oid_obverse)) {
									$pdo->beginTransaction();
									$stream_obverse = $pdo->pgsqlLOBOpen($oid_obverse, 'r');
									$tempimg_obverse = base64_encode(stream_get_contents($stream_obverse));
									$mimetype_obverse = mime_content_type($stream_obverse);
									$img_obverse = "data:" . $mimetype_obverse . ";base64," . $tempimg_obverse;
									fclose($stream_obverse);
									$pdo->commit();
									
									$pdo->beginTransaction();
									$stream_reverse = $pdo->pgsqlLOBOpen($oid_reverse, 'r');
									$tempimg_reverse = base64_encode(stream_get_contents($stream_reverse));
									$mimetype_reverse = mime_content_type($stream_reverse);
									$img_reverse = "data:" . $mimetype_reverse . ";base64," . $tempimg_reverse;
									fclose($stream_reverse);
									$pdo->commit();
								}
							}
						}
						
						catch(PDOException $e) {
							echo $e->getMessage();
							die();
						}
					}
					
					else {
						$img_obverse = "placeholder.png";
						$img_reverse = "placeholder.png";
					}
					
					print_r("<tr class=\"searchrow\">\n<td><img class=\"searchimg\" src=\"" . $img_obverse . "\"></img></td>\n<td><img class=\"searchimg\" src=\"" . $img_reverse . "\"></img></td>\n<td>" . $barcode . "</td>\n<td>" . $line . "</td>\n<td>" . $type . "</td>\n<td>" . $year . "</td>\n<td>" . $description . "</td>\n</tr>");
				}
			?>
				</tbody>
			</table>
		<?php
			}
		}
		
		else {
			for($_SESSION['i3'] = 0; $_SESSION['i3'] < $_SESSION['tens']; $_SESSION['i3']++) {
					$run = 0;
					$concat = "";
					$yearmm = "";
					$varcount = 0;
					$match = "";
					
					foreach($allcolumns as $ident => $data) {
						$skip = 0;
						
						if($skip === 0) {
							${$ident} = $temparray[$_SESSION['i3']][$ident];
							
							if($ident === "barcode") {
								${$ident} = str_pad(${$ident}, 12, "0", STR_PAD_LEFT);
							}
						}
					}
					
					if($hasimg === 1) {
						$sql1 = "SELECT img_obverse, img_reverse FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
						
						try {
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
							
							$stmt = $pdo->prepare($sql1);
							
							$stmt->bindValue(":barcode", $barcode);
							
							$stmt->execute();
							
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							
							if($result) {
								$oid_obverse = $result["img_obverse"];
								$oid_reverse = $result["img_reverse"];
								
								if(!empty($oid_obverse)) {
									$pdo->beginTransaction();
									$stream_obverse = $pdo->pgsqlLOBOpen($oid_obverse, 'r');
									$tempimg_obverse = base64_encode(stream_get_contents($stream_obverse));
									$mimetype_obverse = mime_content_type($stream_obverse);
									$img_obverse = "data:" . $mimetype_obverse . ";base64," . $tempimg_obverse;
									fclose($stream_obverse);
									$pdo->commit();
									
									$pdo->beginTransaction();
									$stream_reverse = $pdo->pgsqlLOBOpen($oid_reverse, 'r');
									$tempimg_reverse = base64_encode(stream_get_contents($stream_reverse));
									$mimetype_reverse = mime_content_type($stream_reverse);
									$img_reverse = "data:" . $mimetype_reverse . ";base64," . $tempimg_reverse;
									fclose($stream_reverse);
									$pdo->commit();
								}
							}
						}
						
						catch(PDOException $e) {
							echo $e->getMessage();
							die();
						}
					}
					
					else {
						$img_obverse = "placeholder.png";
						$img_reverse = "placeholder.png";
					}
					
					print_r("<tr class=\"searchrow\">\n<td><img class=\"searchimg\" src=\"" . $img_obverse . "\"></img></td>\n<td><img class=\"searchimg\" src=\"" . $img_reverse . "\"></img></td>\n<td>" . $barcode . "</td>\n<td>" . $line . "</td>\n<td>" . $type . "</td>\n<td>" . $year . "</td>\n<td>" . $description . "</td>\n</tr>");
				}
			?>
				</tbody>
			</table>
		<?php
			}
		}
	}
}

//delrecordconfirm.php
elseif($filetoinclude === "delrecordconfirm.php") {
	$_SESSION["stmtresult"]['barcode'] = str_pad($_SESSION["stmtresult"]['barcode'], 12, "0", STR_PAD_LEFT);

	$varcount = 0;

	foreach($allcolumns as $ident => $data) {
		$skip = 0;
		
		${$ident} = $_SESSION["stmtresult"][$ident];
		
		${$ident} = preg_replace("/(https?:\/\/?[^\s.]+\.[\w][^\s]+)/", "<span><a href=\"$1\" class=\"new_window\">$1</a></span>", ${$ident});
		
		${$ident} = preg_replace("/\r\n/", "<br>", ${$ident});
		
		${$ident} = preg_replace("/\'\'/", "'", ${$ident});
	} 

	if($hasimg === "1") {
		$sql1 = "SELECT img_obverse, img_reverse, img_bonus1, img_bonus2, img_bonus3, img_bonus4 FROM " . $_SESSION["tablename"] . " WHERE barcode = :barcode;";
		
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			
			$stmt = $pdo->prepare($sql1);
			
			$stmt->bindValue(":barcode", $barcode);
			
			$stmt->execute();
			
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($result) {
				$oid_obverse = $result["img_obverse"];
				$oid_reverse = $result["img_reverse"];
				$oid_bonus1 = $result["img_bonus1"];
				$oid_bonus2 = $result["img_bonus2"];
				$oid_bonus3 = $result["img_bonus3"];
				$oid_bonus4 = $result["img_bonus4"];
				
				if(!empty($oid_obverse)) {
					$pdo->beginTransaction();
					$stream_obverse = $pdo->pgsqlLOBOpen($oid_obverse, 'r');
					$tempimg_obverse = base64_encode(stream_get_contents($stream_obverse));
					$mimetype_obverse = mime_content_type($stream_obverse);
					$img_obverse = "data:" . $mimetype_obverse . ";base64," . $tempimg_obverse;
					fclose($stream_obverse);
					$pdo->commit();
					
					$pdo->beginTransaction();
					$stream_reverse = $pdo->pgsqlLOBOpen($oid_reverse, 'r');
					$tempimg_reverse = base64_encode(stream_get_contents($stream_reverse));
					$mimetype_reverse = mime_content_type($stream_reverse);
					$img_reverse = "data:" . $mimetype_reverse . ";base64," . $tempimg_reverse;
					fclose($stream_reverse);
					$pdo->commit();
				}
				
				if(!empty($oid_bonus1)) {
					$pdo->beginTransaction();
					$stream_bonus1 = $pdo->pgsqlLOBOpen($oid_bonus1, 'r');
					$tempimg_bonus1 = base64_encode(stream_get_contents($stream_bonus1));
					$mimetype_bonus1 = mime_content_type($stream_bonus1);
					$img_bonus1 = "data:" . $mimetype_bonus1 . ";base64," . $tempimg_bonus1;
					fclose($stream_bonus1);
					$pdo->commit();
				}
				
				if(!empty($oid_bonus2)) {
					$pdo->beginTransaction();
					$stream_bonus2 = $pdo->pgsqlLOBOpen($oid_bonus2, 'r');
					$tempimg_bonus2 = base64_encode(stream_get_contents($stream_bonus2));
					$mimetype_bonus2 = mime_content_type($stream_bonus2);
					$img_bonus2 = "data:" . $mimetype_bonus2 . ";base64," . $tempimg_bonus2;
					fclose($stream_bonus2);
					$pdo->commit();
				}
				
				if(!empty($oid_bonus3)) {
					$pdo->beginTransaction();
					$stream_bonus3 = $pdo->pgsqlLOBOpen($oid_bonus3, 'r');
					$tempimg_bonus3 = base64_encode(stream_get_contents($stream_bonus3));
					$mimetype_bonus3 = mime_content_type($stream_bonus3);
					$img_bonus3 = "data:" . $mimetype_bonus3 . ";base64," . $tempimg_bonus3;
					fclose($stream_bonus3);
					$pdo->commit();
				}
				
				if(!empty($oid_bonus4)) {
					$pdo->beginTransaction();
					$stream_bonus4 = $pdo->pgsqlLOBOpen($oid_bonus4, 'r');
					$tempimg_bonus4 = base64_encode(stream_get_contents($stream_bonus4));
					$mimetype_bonus4 = mime_content_type($stream_bonus4);
					$img_bonus4 = "data:" . $mimetype_bonus4 . ";base64," . $tempimg_bonus4;
					fclose($stream_bonus4);
					$pdo->commit();
				}
			}
		}

		catch(PDOException $e) {
			echo $e->getMessage();
			die();
		}
	}
	?>
	<div class="container">
		<div id="leftmost">
			<div id="datalinediv">
				<span id="dataline">Data for entry #<?php print_r($barcode); ?></span>
				<span id="dataline2">&nbsp;(line #<?php print_r($line); ?>):</span>
			</div>
			<div id="allimages">
				<table id="imagestable">
					<tbody>
						<tr>
							<td><span>Obverse</span></td>
							<td><span>Reverse</span></td>
						</tr>
						<tr>
							<td><img <?php if($type === "Bill") { print_r("class=\"bill\" "); } else { print_r(" "); } ?>id="obverse" src="<?php if($hasimg === "1") { print_r($img_obverse); } else { print_r("placeholder.png"); } ?>" alt="Obverse Image"></td>
							<td><img <?php if($type === "Bill") { print_r("class=\"bill\" "); } else { print_r(" "); } ?>id="reverse" src="<?php if($hasimg === "1") { print_r($img_reverse); } else { print_r("placeholder.png"); } ?>" alt="Reverse Image"></td>
						</tr>
					</tbody>
				</table>
				<table id="imagestablebonus">
					<tbody>
						<tr>
							<td><span>Bonus Image #1</span></td>
							<td><span>Bonus Image #2</span></td>
							<td><span>Bonus Image #3</span></td>
							<td><span>Bonus Image #4</span></td>
						</tr>
						<tr>
							<td><img id="bonus1" src="<?php if($hasimg === "1" && !empty($img_bonus1)) { print_r($img_bonus1); } else { print_r("placeholder.png"); } ?>" alt="Bonus Image #1"></td>
							<td><img id="bonus2" src="<?php if($hasimg === "1" && !empty($img_bonus2)) { print_r($img_bonus2); } else { print_r("placeholder.png"); } ?>" alt="Bonus Image #2"></td>
							<td><img id="bonus3" src="<?php if($hasimg === "1" && !empty($img_bonus3)) { print_r($img_bonus3); } else { print_r("placeholder.png"); } ?>" alt="Bonus Image #3"></td>
							<td><img id="bonus4" src="<?php if($hasimg === "1" && !empty($img_bonus4)) { print_r($img_bonus4); } else { print_r("placeholder.png"); } ?>" alt="Bonus Image #4"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="basics">
				<span id="type">Type:<br><?php if(!empty($type)) { print_r($type); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="year">Year:<br><?php if(!empty($year)) { print_r($year); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="mintmark">Mint:<br><?php if(!empty($mint)) { print_r($mint); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="denomination">Denomination:<br><?php if(!empty($denomination)) { print_r($denomination); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="country_of_origin">Country Of Origin:<br><?php if(!empty($country_of_origin)) { print_r($country_of_origin); } else { print_r("NONE"); } ?></span>
			</div>
			<div class="custombr"></div>
			<div id="meltinfo">
				<span id="composition">Composition:<br><?php if(!empty($composition)) { print_r($composition); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="composition_amount">Composition Amount:<br><?php if(!empty($composition_amount)) { print_r($composition_amount); } else { print_r("NONE"); } ?></span>
				<br class="mobileonly">
				<span id="melt">Melt:<br><?php if(isset($melt) && !empty($melt) && isset($composition) && !empty($composition) && isset($composition_amount) && !empty($composition_amount)) {
					preg_match("/[Xx][Pp]?[Aa]?[GUTDgutd]/", $composition, $metalmatcharray);
					preg_match("/\d\.\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?\d?/", $composition_amount, $compamountarray);
					
					if(isset($_SESSION['metalsapi']) && !empty($_SESSION['metalsapi'])) {
						if(isset($_SESSION['currencysymbol'])) {
							switch($_SESSION['currencysymbol']) {
								case '$':
									$tocurrency = "USD";
									break;
								case 'AU$':
									$tocurrency = "AUD";
									break;
								case 'CA$':
									$tocurrency = "CAD";
									break;
								case 'US$':
									$tocurrency = "USD";
									break;
								case '₿':
									$tocurrency = "BTC";
									break;
								case '¥':
									$tocurrency = "JPY";
									break;
								case '€':
									$tocurrency = "EUR";
									break;
								case '£':
									$tocurrency = "GBP";
									break;
								case '₩':
									$tocurrency = "KRW";
									break;
								default:
									$tocurrency = "USD";
									break;
							}
						}
						
						else {
							$tocurrency = "USD";
						}
						
						$curl = curl_init();

						curl_setopt_array($curl, array(
							CURLOPT_URL => 'https://metals-api.com/api/convert?access_key=' . $_SESSION['metalsapi'] . '&from=' . $metalmatcharray[0] . '&to=' . $tocurrency . '&amount=' . $compamountarray[0],
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'GET',
						));

						$data = curl_exec($curl);

						$httpcode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

						if (curl_errno($curl)) {
							$error_msg = curl_error($curl);
						}

						curl_close($curl);

						if (isset($error_msg)) {
							$error = "cURL Error: \"" . $error_msg . "\", aborting!";
							print_r($error);
							
						}

						if($httpcode === 200) {
							$json = json_decode($data, true);
							$amount = (float) $json["result"];
							$currenttime = $json["info"]["timestamp"];
							$amount = number_format($amount, 2, '.', ',');
							$date = DateTime::createFromFormat("U", $currenttime);
							$date->setTimezone(new DateTimeZone($_SESSION['timezone']));
							$reqtime = $date->format("h:i:s a \o\\n Y\-m\-d");

							print_r("Approximately " . $_SESSION['currencysymbol'] . $amount);
							
							$meltline = "(Amount current as of " . $reqtime . ".)";
						}
						
						else {
							$error = "Expected HTTP 200, got " . $httpcode . " instead, aborting!";
							print_r($error);
						}
					}
					
					else {
						$error = "You must have a Metals-API key to view melt values.";
						print_r($error);
					} 
				}

				else {
					print_r("NONE");
					$error = "";
				} ?></span>
			</div>
			<span id="meltline" class="smallnostar"><?php if(isset($meltline)) { print_r($meltline); } else { print_r($error); } ?></span>
		</div>
		<div class="separator"></div>
		<div id="descnotes">
			<?php if($nnh === "1") { ?>
			<span class="nnh">THIS COIN NEEDS A NEW HOLDER! REPLACE IT AS SOON AS POSSIBLE.</span>
			<br>
			<?php } 
			
			if(isset($description) && !empty($description)) { ?>
			<span id="description">Description:<br><?php print_r($description); ?></span>
			<br>
			<span id="notes">Notes:<br><?php if(!empty($notes)) { print_r($notes); } else { print_r("NONE"); } ?></span>
			<?php } 
			
			else {
				print_r("<span id=\"description\">This entry has no information associated with it. You may \"create\" it by using the button above.</span>");
			} ?>
			<br>
		</div>
		<div class="separator"></div>
		<div id="rightmost">
			<div id="tpginfo">
				<span id="tpg">TPG:<br><?php if(!empty($tpg)) { print_r($tpg); } else { print_r("NONE"); } ?></span>
				<br>
				<span id="grade">Grade:<br><?php if(!empty($grade)) { print_r($grade); } else { print_r("NONE"); } ?></span>
				<br>
				<span id="cert">Cert:<br><?php
				if(isset($cert) && !empty($cert) && isset($tpg) && !empty($tpg) && strtolower($tpg) === "pcgs") {
					print_r("<a href=\"https://www.pcgs.com/cert/" . $cert . "\" class=\"new_window\">" . $cert . "</a>");
				}
				
				elseif(isset($cert) && !empty($cert) && isset($tpg) && !empty($tpg) && isset($grade) && !empty($grade) && strtolower($tpg) === "ngc") {
					if(preg_match("/(\d\d)/", $grade, $ngcmatch)) {
						$finalgrade = $ngcmatch[0];
						//break;
					}
						
					elseif(preg_match("/Ancients/", $grade)) {
						$finalgrade = "NGCAncients";
						//break;
					}
					
					elseif(preg_match("/Details/", $grade)) {
						$finalgrade = "NGCDetails";
						//break;
					}
					
					elseif(preg_match("/Other/", $grade)) {
						$finalgrade = "Other";
						//break;
					}
					
					else {
						$finalgrade = "Other";
						//break;
					}
					
					$finalgrade = preg_replace("/\s+/", "", $finalgrade);
					
					print_r("<a href=\"https://www.ngccoin.com/certlookup/" . $cert . "/" . $finalgrade . "\" class=\"new_window\">" . $cert . "</a>");
				}
				
				elseif(isset($cert) && !empty($cert) && isset($tpg) && !empty($tpg) && strtolower($tpg) === "anacs") {
					print_r("<a href=\"https://www.anacs.com/Verify/CertVerification.aspx?cert=" . $cert . "\" class=\"new_window\">" . $cert . "</a>");
				}
				
				elseif(isset($cert) && !empty($cert)) {
					print_r($cert);
				}

				else {
					print_r("NONE");
				} ?></span>
			</div>
			<div id="misc">
				<span id="serial">Serial:<br><?php if(!empty($serial)) { print_r($serial); } else { print_r("NONE"); } ?></span>
				<br>
				<span id="location">Location:<br><?php if(!empty($location)) { print_r($location); } else { print_r("NONE"); } ?></span>
				<br>
				<span id="pcgs_coinfacts">PCGS Coinfacts:<br><?php
				
				if(isset($pcgs_coinfacts) && !empty($pcgs_coinfacts) && preg_match("/\,\ /", $pcgs_coinfacts)) {
					$coinfactsarray = explode(", ", $pcgs_coinfacts);
					
					foreach($coinfactsarray as $cfkey => $cfdata) {
						if($cfkey === count($coinfactsarray) - 1) {
							print_r("<a href=\"https://www.pcgs.com/coinfacts/coin/detail/" . $cfdata . "\" class=\"new_window\">" . $cfdata . "</a>");
						}
						
						else {
							print_r("<a href=\"https://www.pcgs.com/coinfacts/coin/detail/" . $cfdata . "\" class=\"new_window\">" . $cfdata . "</a>, ");
						}
					}
				}
				
				elseif(isset($pcgs_coinfacts) && !empty($pcgs_coinfacts)) {
					print_r("<a href=\"https://www.pcgs.com/coinfacts/coin/detail/" . $pcgs_coinfacts . "\" class=\"new_window\">" . $pcgs_coinfacts . "</a>");
				}
				
				else {
					print_r("NONE");
				} ?></span>
				<br>
				<span id="ngc_coin_explorer">NGC Coin Explorer:<br><?php
				
				if(isset($ngc_coin_explorer) && !empty($ngc_coin_explorer) && preg_match("/\,\ /", $ngc_coin_explorer)) {
					$coinexplorerarray = explode(", ", $ngc_coin_explorer);
					
					foreach($coinexplorerarray as $cekey => $cedata) {
						if($cekey === count($coinexplorerarray) - 1) {
							print_r("<a href=\"https://www.ngccoin.com/redirects/coin-explorer/" . $cedata . "\" class=\"new_window\">" . $cedata . "</a>");
						}
						
						else {
							print_r("<a href=\"https://www.ngccoin.com/redirects/coin-explorer/" . $cedata . "\" class=\"new_window\">" . $cedata . "</a>, ");
						}
					}
				}
				
				elseif(isset($ngc_coin_explorer) && !empty($ngc_coin_explorer)) {
					print_r("<a href=\"https://www.ngccoin.com/redirects/coin-explorer/" . $ngc_coin_explorer . "\" class=\"new_window\">" . $ngc_coin_explorer . "</a>");
				}
				
				else {
					print_r("NONE");
				} ?></span>
				<br>
				<span id="cost">Cost:<br><?php if(!empty($cost)) { print_r($_SESSION['currencysymbol'] . $cost); } else { print_r("NONE"); } ?></span>
			</div>
		</div>
	</div>
	<script src="removecover.js"></script>
<?php }

//If the file is not included, throw an error and stop execution.
else {
	print_r($filetoinclude . " is not included in outputs.php! Please include the file before retrying.");
	die();
} ?>