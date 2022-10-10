<?php

require_once("globalvars.php");

function echodoc($string) {
	require_once("template.php");
	printpagestart("Unknown command!"); ?>
	<span><?php print_r($string); ?></span>
	<br>
	<a href="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>"><button>Go back</button></a>
	<?php printpageend();
	unset($string);
}

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

if(isset($_FILES['numista']) && $_FILES['numista']["type"] === "text/csv") {
	if(1 === 1) {
		$countries = array('AF' => 'Afghanistan', 'AX' => 'Aland Islands', 'AL' => 'Albania', 'DZ' => 'Algeria', 'AS' => 'American Samoa', 'AD' => 'Andorra', 'AO' => 'Angola', 'AI' => 'Anguilla', 'AQ' => 'Antarctica', 'AG' => 'Antigua And Barbuda', 'AR' => 'Argentina', 'AM' => 'Armenia', 'AW' => 'Aruba', 'AU' => 'Australia', 'AT' => 'Austria', 'AZ' => 'Azerbaijan', 'BS' => 'Bahamas', 'BH' => 'Bahrain', 'BD' => 'Bangladesh', 'BB' => 'Barbados', 'BY' => 'Belarus', 'BE' => 'Belgium', 'BZ' => 'Belize', 'BJ' => 'Benin', 'BM' => 'Bermuda', 'BT' => 'Bhutan', 'BO' => 'Bolivia', 'BA' => 'Bosnia And Herzegovina', 'BW' => 'Botswana', 'BV' => 'Bouvet Island', 'BR' => 'Brazil', 'IO' => 'British Indian Ocean Territory', 'BN' => 'Brunei Darussalam', 'BG' => 'Bulgaria', 'BF' => 'Burkina Faso', 'BI' => 'Burundi', 'KH' => 'Cambodia', 'CM' => 'Cameroon', 'CA' => 'Canada', 'CV' => 'Cape Verde', 'KY' => 'Cayman Islands', 'CF' => 'Central African Republic', 'TD' => 'Chad', 'CL' => 'Chile', 'CN' => 'China', 'CX' => 'Christmas Island', 'CC' => 'Cocos (Keeling) Islands', 'CO' => 'Colombia', 'KM' => 'Comoros', 'CG' => 'Congo', 'CD' => 'Congo, Democratic Republic', 'CK' => 'Cook Islands', 'CR' => 'Costa Rica', 'CI' => 'Cote D\'Ivoire', 'HR' => 'Croatia', 'CU' => 'Cuba', 'CY' => 'Cyprus', 'CZ' => 'Czech Republic', 'DK' => 'Denmark', 'DJ' => 'Djibouti', 'DM' => 'Dominica', 'DO' => 'Dominican Republic', 'EC' => 'Ecuador', 'EG' => 'Egypt', 'SV' => 'El Salvador', 'GQ' => 'Equatorial Guinea', 'ER' => 'Eritrea', 'EE' => 'Estonia', 'ET' => 'Ethiopia', 'FK' => 'Falkland Islands (Malvinas)', 'FO' => 'Faroe Islands', 'FJ' => 'Fiji', 'FI' => 'Finland', 'FR' => 'France', 'GF' => 'French Guiana', 'PF' => 'French Polynesia', 'TF' => 'French Southern Territories', 'GA' => 'Gabon', 'GM' => 'Gambia', 'GE' => 'Georgia', 'DE' => 'Germany', 'GH' => 'Ghana', 'GI' => 'Gibraltar', 'GR' => 'Greece', 'GL' => 'Greenland', 'GD' => 'Grenada', 'GP' => 'Guadeloupe', 'GU' => 'Guam', 'GT' => 'Guatemala', 'GG' => 'Guernsey', 'GN' => 'Guinea', 'GW' => 'Guinea-Bissau', 'GY' => 'Guyana', 'HT' => 'Haiti', 'HM' => 'Heard Island & Mcdonald Islands', 'VA' => 'Holy See (Vatican City State)', 'HN' => 'Honduras', 'HK' => 'Hong Kong', 'HU' => 'Hungary', 'IS' => 'Iceland', 'IN' => 'India', 'ID' => 'Indonesia', 'IR' => 'Iran, Islamic Republic Of', 'IQ' => 'Iraq', 'IE' => 'Ireland', 'IM' => 'Isle Of Man', 'IL' => 'Israel', 'IT' => 'Italy', 'JM' => 'Jamaica', 'JP' => 'Japan', 'JE' => 'Jersey', 'JO' => 'Jordan', 'KZ' => 'Kazakhstan', 'KE' => 'Kenya', 'KI' => 'Kiribati', 'KR' => 'Korea', 'KW' => 'Kuwait', 'KG' => 'Kyrgyzstan', 'LA' => 'Lao People\'s Democratic Republic', 'LV' => 'Latvia', 'LB' => 'Lebanon', 'LS' => 'Lesotho', 'LR' => 'Liberia', 'LY' => 'Libyan Arab Jamahiriya', 'LI' => 'Liechtenstein', 'LT' => 'Lithuania', 'LU' => 'Luxembourg', 'MO' => 'Macao', 'MK' => 'Macedonia', 'MG' => 'Madagascar', 'MW' => 'Malawi', 'MY' => 'Malaysia', 'MV' => 'Maldives', 'ML' => 'Mali', 'MT' => 'Malta', 'MH' => 'Marshall Islands', 'MQ' => 'Martinique', 'MR' => 'Mauritania', 'MU' => 'Mauritius', 'YT' => 'Mayotte', 'MX' => 'Mexico', 'FM' => 'Micronesia, Federated States Of', 'MD' => 'Moldova', 'MC' => 'Monaco', 'MN' => 'Mongolia', 'ME' => 'Montenegro', 'MS' => 'Montserrat', 'MA' => 'Morocco', 'MZ' => 'Mozambique', 'MM' => 'Myanmar', 'NA' => 'Namibia', 'NR' => 'Nauru', 'NP' => 'Nepal', 'NL' => 'Netherlands', 'AN' => 'Netherlands Antilles', 'NC' => 'New Caledonia', 'NZ' => 'New Zealand', 'NI' => 'Nicaragua', 'NE' => 'Niger', 'NG' => 'Nigeria', 'NU' => 'Niue', 'NF' => 'Norfolk Island', 'MP' => 'Northern Mariana Islands', 'NO' => 'Norway', 'OM' => 'Oman', 'PK' => 'Pakistan', 'PW' => 'Palau', 'PS' => 'Palestinian Territory, Occupied', 'PA' => 'Panama', 'PG' => 'Papua New Guinea', 'PY' => 'Paraguay', 'PE' => 'Peru', 'PH' => 'Philippines', 'PN' => 'Pitcairn', 'PL' => 'Poland', 'PT' => 'Portugal', 'PR' => 'Puerto Rico', 'QA' => 'Qatar', 'RE' => 'Reunion', 'RO' => 'Romania', 'RU' => 'Russian Federation', 'RW' => 'Rwanda', 'BL' => 'Saint Barthelemy', 'SH' => 'Saint Helena', 'KN' => 'Saint Kitts And Nevis', 'LC' => 'Saint Lucia', 'MF' => 'Saint Martin', 'PM' => 'Saint Pierre And Miquelon', 'VC' => 'Saint Vincent And Grenadines', 'WS' => 'Samoa', 'SM' => 'San Marino', 'ST' => 'Sao Tome And Principe', 'SA' => 'Saudi Arabia', 'SN' => 'Senegal', 'RS' => 'Serbia', 'SC' => 'Seychelles', 'SL' => 'Sierra Leone', 'SG' => 'Singapore', 'SK' => 'Slovakia', 'SI' => 'Slovenia', 'SB' => 'Solomon Islands', 'SO' => 'Somalia', 'ZA' => 'South Africa', 'GS' => 'South Georgia And Sandwich Isl.', 'ES' => 'Spain', 'LK' => 'Sri Lanka', 'SD' => 'Sudan', 'SR' => 'Suriname', 'SJ' => 'Svalbard And Jan Mayen', 'SZ' => 'Swaziland', 'SE' => 'Sweden', 'CH' => 'Switzerland', 'SY' => 'Syrian Arab Republic', 'TW' => 'Taiwan', 'TJ' => 'Tajikistan', 'TZ' => 'Tanzania', 'TH' => 'Thailand', 'TL' => 'Timor-Leste', 'TG' => 'Togo', 'TK' => 'Tokelau', 'TO' => 'Tonga', 'TT' => 'Trinidad And Tobago', 'TN' => 'Tunisia', 'TR' => 'Turkey', 'TM' => 'Turkmenistan', 'TC' => 'Turks And Caicos Islands', 'TV' => 'Tuvalu', 'UG' => 'Uganda', 'UA' => 'Ukraine', 'AE' => 'United Arab Emirates', 'GB' => 'United Kingdom', 'US' => 'United States', 'UM' => 'United States Outlying Islands', 'UY' => 'Uruguay', 'UZ' => 'Uzbekistan', 'VU' => 'Vanuatu', 'VE' => 'Venezuela', 'VN' => 'Viet Nam', 'VG' => 'Virgin Islands, British', 'VI' => 'Virgin Islands, U.S.', 'WF' => 'Wallis And Futuna', 'EH' => 'Western Sahara', 'YE' => 'Yemen', 'ZM' => 'Zambia', 'ZW' => 'Zimbabwe');
		$currencies = array("Afghani" => "؋", "Lek" => "Lek", "Dinar" => "دج", "Kwanza" => "Kz", "Peso" => "$", "Dram" => "֏", "Florin" => "ƒ", "Dollar" => "$", "Manat" => "m", "Dollar" => "B$", "Dinar" => ".د.ب", "Taka" => "৳", "Dollar" => "Bds$", "Ruble" => "Br", "Franc" => "fr", "Dollar" => "$", "Dollar" => "$", "Ngultrum" => "Nu.", "Bitcoin" => "฿", "Boliviano" => "Bs.", "Bosnia" => "KM", "Pula" => "P", "Real" => "R$", "Sterling" => "£", "Dollar" => "B$", "Lev" => "Лв.", "Franc" => "FBu", "Riel" => "KHR", "Dollar" => "$", "Escudo" => "$", "Dollar" => "$", "BCEAO" => "CFA", "BEAC" => "FCFA", "Franc" => "₣", "Peso" => "$", "Yuan" => "¥", "Peso" => "$", "Franc" => "CF", "Franc" => "FC", "ColÃ³n" => "₡", "Kuna" => "kn", "Peso" => "$, CUC", "Koruna" => "Kč", "Krone" => "Kr.", "Franc" => "Fdj", "Peso" => "$", "Dollar" => "$", "Pound" => "ج.م", "Nakfa" => "Nfk", "Kroon" => "kr", "Birr" => "Nkf", "Euro" => "€", "Pound" => "£", "Dollar" => "FJ$", "Dalasi" => "D", "Lari" => "ლ", "Mark" => "DM", "Cedi" => "GH₵", "Pound" => "£", "Drachma" => "₯", "Quetzal" => "Q", "Franc" => "FG", "Dollar" => "$", "Gourde" => "G", "Lempira" => "L", "Dollar" => "$", "Forint" => "Ft", "KrÃ³na" => "kr", "Rupee" => "₹", "Rupiah" => "Rp", "Rial" => "﷼", "Dinar" => "د.ع", "Sheqel" => "₪", "Lira" => "L,£", "Dollar" => "J$", "Yen" => "¥", "Dinar" => "ا.د", "Tenge" => "лв", "Shilling" => "KSh", "Dinar" => "ك.د", "Som" => "лв", "Kip" => "₭", "Lats" => "Ls", "Pound" => "£", "Loti" => "L", "Dollar" => "$", "Dinar" => "د.ل", "Litas" => "Lt", "Pataca" => "$", "Denar" => "ден", "Ariary" => "Ar", "Kwacha" => "MK", "Ringgit" => "RM", "Rufiyaa" => "Rf", "Ouguiya" => "MRU", "Rupee" => "₨", "Peso" => "$", "Leu" => "L", "Tugrik" => "₮", "Dirham" => "MAD", "Metical" => "MT", "Kyat" => "K", "Dollar" => "$", "Rupee" => "₨", "Guilder" => "ƒ", "Dollar" => "$", "Dollar" => "$", "CÃ³rdoba" => "C$", "Naira" => "₦", "Won" => "₩", "Krone" => "kr", "Rial" => ".ع.ر", "Rupee" => "₨", "Balboa" => "B/.", "Kina" => "K", "Guarani" => "₲", "Sol" => "S/.", "Peso" => "₱", "Zloty" => "zł", "Rial" => "ق.ر", "Leu" => "lei", "Ruble" => "₽", "Franc" => "FRw", "ColÃ³n" => "₡", "Tala" => "SAT", "Riyal" => "﷼", "Dinar" => "din", "Rupee" => "SRe", "Leone" => "Le", "Dollar" => "$", "Koruna" => "Sk", "Dollar" => "Si$", "Shilling" => "Sh.so.", "Rand" => "R", "Won" => "₩", "Rights" => "SDR", "Rupee" => "Rs", "Pound" => "£", "Pound" => ".س.ج", "Dollar" => "$", "Lilangeni" => "E", "Krona" => "kr", "Franc" => "CHf", "Pound" => "LS", "Dobra" => "Db", "Somoni" => "SM", "Shilling" => "TSh", "Baht" => "฿", "pa'anga" => "$", "Dollar" => "$", "Dinar" => "ت.د", "Lira" => "₺", "Manat" => "T", "Shilling" => "USh", "Hryvnia" => "₴", "Dirham" => "إ.د", "Peso" => "$", "Dollar" => "$", "Som" => "лв", "Vatu" => "VT", "BolÃvar" => "Bs", "Dong" => "₫", "Rial" => "﷼", "Kwacha" => "ZK");
		$currencies = array_unique($currencies);
		$currencies["Dollar"] = "$";
	}
	$linecount = 0;
	$_SESSION['finalstringnumista'] = "";
	
	$fh = fopen($_FILES['numista']["tmp_name"], "r");

	while(!feof($fh)){
		$line = fgets($fh, 4096);
		$linecount = $linecount + substr_count($line, PHP_EOL);
	}
	
	fclose($fh);
	
	$fh = fopen($_FILES['numista']["tmp_name"], "r");
	$start = fgets($fh);
	if(preg_match("/\"Country\"\,\"Currency\"\,\"Face value\"\,\"Title\"\,\"Year\"\,\"Mintmark\"\,\"Comment\"\,\"Quantity\"\,\"For exchange\"\,\"Grade\"\,\"Collection\"\,\"Buying price \(USD\)\"\,\"Estimate \(USD\)\"\,\"Private comment\"\,\"Public comment\"/", $start)) {
		for($i2 = 0; $i2 < ($linecount - 1); $i2++) {
			$currline = fgets($fh);
			$asarray = explode(",", $currline);
			foreach($asarray as $key => $data) {
				$asarray[$key] = preg_replace("/ \(.*\)/", "", $asarray[$key]);
				
				while(preg_match_all('/"(.*)"/', $asarray[$key], $m)) {
					if(isset($m[1][0])) {
						$asarray[$key] = $m[1][0];
					}
				}
			}
			
			if(in_array($asarray[0], $countries)) {
				$final_value_countryoforigin = preg_replace("/" . $asarray[0] . "/", array_keys($countries, $asarray[0])[0], $asarray[0]);
			}
			
			if(array_key_exists($asarray[1], $currencies)) {
				$currencysymbol = preg_replace("/" . $asarray[1] . "/", $currencies[$asarray[1]], $asarray[1]);
				$final_value_denomination = $currencysymbol . $asarray[2];
			}
			
			$final_value_description = $asarray[3];
			$final_value_year = $asarray[4];
			$final_value_mintmark = $asarray[5];
			$final_value_grade = $asarray[9];
			$final_value_notes = $asarray[13];
			
			for($i = 0; $i < $asarray[7]; $i++) {
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
					}
				}
				
				catch(PDOException $e) {
					echo $e->getMessage();
					die();
				}
				
				$keepgoing = true;
				
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
								$barcode = $generated;
								break;
							}
							
							else {
								$keepgoing = true;
							}
						}
						
						else {
							$keepgoing = false;
							break;
						}
					}
					
					catch(PDOException $e) {
						echo $e->getMessage();
						die();
					}
				}
				
				require("allcolumns.php");
				
				$sqlfinal = "INSERT INTO " . $_SESSION["tablename"] . " (";
				
				try {
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
					
					$runcount = 0;
					
					foreach($allcolumns as $ident => $data) {
						$runcount += 1;
							
						if($runcount === count($allcolumns)) {
							$sqlfinal .= $ident . ") VALUES (";
						}
						
						else {
							$sqlfinal .= $ident . ", ";
						}
					}
					
					$runcount = 0;
					
					foreach($allcolumns as $ident => $data) {
						$runcount += 1;
							
						if($runcount === count($allcolumns)) {
							$sqlfinal .= ":" . $ident . ");";
						}
						
						else {
							$sqlfinal .= ":" . $ident . ", ";
						}
					}
					
					$runcount = 0;
					
					$stmtfinal = $pdo->prepare($sqlfinal);
					
					$stmt2->setFetchMode(PDO::FETCH_ASSOC);
					
					foreach($allcolumns as $ident => $data) {
						if($ident === "nnh" || $ident === "hasimg" || $ident === "melt" || $ident === "line" || $ident === "barcode" || $ident === "country_of_origin" || $ident === "denomination" || $ident === "description" || $ident === "year" || $ident === "mintmark" || $ident === "grade" || $ident === "notes") {
							if($ident === "line" && isset($intmaxline)) {
								$stmtfinal->bindValue(":" . $ident, $intmaxline, PDO::PARAM_INT);
							}
							
							elseif($ident === "nnh" || $ident === "hasimg" || $ident === "melt") {
								$stmtfinal->bindValue(":" . $ident, 0, PDO::PARAM_INT);
							}
							
							elseif($ident === "barcode" && isset($barcode)) {
								$stmtfinal->bindValue(":" . $ident, (int) $barcode, PDO::PARAM_INT);
							}
							
							elseif($ident === "country_of_origin" && isset($final_value_countryoforigin)) {
								$stmtfinal->bindValue(":" . $ident, $final_value_countryoforigin, PDO::PARAM_STR);
							}
							
							elseif($ident === "denomination" && isset($final_value_denomination)) {
								$stmtfinal->bindValue(":" . $ident, $final_value_denomination, PDO::PARAM_STR);
							}
							
							elseif($ident === "description" && isset($final_value_description)) {
								$stmtfinal->bindValue(":" . $ident, $final_value_description, PDO::PARAM_STR);
							}
							
							elseif($ident === "year" && isset($final_value_year)) {
								$stmtfinal->bindValue(":" . $ident, $final_value_year, PDO::PARAM_STR);
							}
							
							elseif($ident === "mintmark" && isset($final_value_mintmark)) {
								$stmtfinal->bindValue(":" . $ident, $final_value_mintmark, PDO::PARAM_STR);
							}
							
							elseif($ident === "grade" && isset($final_value_grade)) {
								$stmtfinal->bindValue(":" . $ident, $final_value_grade, PDO::PARAM_STR);
							}
							
							elseif($ident === "notes" && isset($final_value_notes)) {
								$stmtfinal->bindValue(":" . $ident, $final_value_notes, PDO::PARAM_STR);
							}
						}
						
						else {
							$stmtfinal->bindValue(":" . $ident, "", PDO::PARAM_STR);
						}
					}
					
					$result2 = $stmtfinal->execute();
					
					if($result2) {
						$_SESSION['finalstringnumista'] .= "<span>Successfully inserted record " . $barcode . " with line number " . $intmaxline . ".</span><br><br>";
					}
					
					else {
						var_dump(get_defined_vars());
						die();
					}
				}
				
				catch(PDOException $e) {
					echo $e->getMessage();
					die();
				}
			}
		}
		require_once("template.php");
		printpagestart("Restore Complete!");?>
		<span><?php print_r($_SESSION['finalstringnumista'] . "<span>Restore completed successfully!</span>"); ?></span>
		<br>
		<br>
		<a href="index.php"><button>Return to top page</button></a>
		<?php 
		unset($_SESSION["finalstringnumista"]);
		printpageend();
	}
	
	else {
		var_dump(preg_match("/\"Country\"\,\"Currency\"\,\"Face value\"\,\"Title\"\,\"Year\"\,\"Mintmark\"\,\"Comment\"\,\"Quantity\"\,\"For exchange\"\,\"Grade\"\,\"Collection\"\,\"Buying price \(USD\)\"\,\"Estimate \(USD\)\"\,\"Private comment\"\,\"Public comment\"/", $start));
		var_dump($start);
		die();
	}
}

elseif(isset($_GET["command"])) {
	$command = $_GET["command"];
	
	if($command == "backup") {
		header(('Location: /dobackuprestore.php?command=' . $command));
	}
	
	elseif($command == "restore" && !isset($_GET['method'])) {
		require_once("template.php");
		printpagestart("Choose Restore Method");?>
		<span>Will you be restoring from a local backup of CCIDB (usually named "ccidb.dump"), or would you like to import a Numista CSV file (more info <a href="https://wagspuzzle.space/" target="_blank">here</a>)?</span>
		<br>
		<br>
		<a href="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>?command=restore&method=local"><button>Local Backup</button></a>
		<br>
		<a href="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>?command=restore&method=numista"><button>Numista CSV</button></a>
		<br>
		<br>
		<a href="index.php"><button>Return to top page</button></a>
		<?php printpageend();
	}
	
	elseif($command == "restore" && isset($_GET['method']) && $_GET['method'] === "local") {
		header(('Location: /dobackuprestore.php?command=' . $command));
	}
	
	elseif($command == "restore" && isset($_GET['method']) && $_GET['method'] === "numista") {
		require_once("template.php");
		printpagestart("Numista Restore");?>
		<span>Please select a Numista CSV file (usually named YourNumistaUsername_coins.csv) and click "Upload" to continue.</span>
		<br>
		<br>
		<form action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post" enctype="multipart/form-data">
			<label class="required">Choose Numista CSV</label>&nbsp;&nbsp;<input type="file" name="numista" id="numista" required>
			<br>
			<button type="submit" name="submit">Upload</button>
		</form>
		<br>
		<br>
		<a href="index.php"><button>Return to top page</button></a>
		<?php printpageend();
	}
	
	else {
		$string = "Unrecognized command. Try another command.";
		echodoc($string);
	}
}

else {
	require_once("template.php");
	printpagestart("Backup/Restore CCIDB");?>
		<span>Welcome to the backup/restore system! This system allows you to take a backup (or restore from a backup) of all your data. Please choose an option, and follow the prompts.</span>
		<br>
		<br>
		<a href="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>?command=backup"><button>Backup</button></a>
		<br>
		<a href="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>?command=restore"><button class="danger">Restore</button></a>
		<br>
		<br>
		<a href="index.php"><button>Return to top page</button></a>
	<?php printpageend();
}