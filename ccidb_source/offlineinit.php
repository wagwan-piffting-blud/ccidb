<?php

require_once("globalvars.php");

require_once("template.php");

if(!empty($_SERVER['HTTP_REFERER'])) {
	$filetoinclude = $_SERVER['HTTP_REFERER'];
	$filetoinclude = preg_replace("/(.*\/\/.*\/)(.*\.php)/", "$2", $filetoinclude);
	$filetoinclude = preg_replace("/(.*\/)(.*\.php)/", "$2", $filetoinclude);
}

else {
	$filetoinclude = "offlineinit.php";
}

$_SESSION['string'] = "";

if(!empty($_POST)) {
	$postgres_username = $_SESSION['postgres_username'];
    $postgres_password = $_SESSION['postgres_password'];
	
	function echodoc($settingsstring) { 
		require_once("template.php");
		printpagestart("Settings Results");
		print_r($settingsstring);
		printpageend();
		unset($_SESSION["string"]);
		unset($_SESSION["csrf"]);
		die();
	}
	
	function databaseinit($postgres_username, $postgres_password) {
		try {
			$dsn = "pgsql:host=127.0.0.1;port=" . $_SESSION['pgsql_port'] . ";dbname=postgres;";
			$pdo = new PDO($dsn, "postgres", $_SESSION['pgsql_start_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
			
			if($pdo) {
				$sql0 = "CREATE ROLE " . $postgres_username . " WITH PASSWORD '" . $postgres_password . "' LOGIN CREATEDB;";
				
				try {
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
					
					$stmt0 = $pdo->prepare($sql0);
					
					$stmt0->setFetchMode(PDO::FETCH_ASSOC);
					
					$result0 = $stmt0->execute();
					
					if($result0) {
						$sql1 = "CREATE DATABASE " . $_SESSION['pgsql_data'] . ";";
						
						try {
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
							
							$stmt = $pdo->prepare($sql1);
							
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
							$result = $stmt->execute();
							
							if($result) {
								$sql1 = "CREATE DATABASE " . $_SESSION['pgsql_licensing'] . ";";
								
								try {
									$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
									
									$stmt = $pdo->prepare($sql1);
									
									$stmt->setFetchMode(PDO::FETCH_ASSOC);
									
									$result = $stmt->execute();
									
									if($result) {
										$dsn = "pgsql:host=127.0.0.1;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_licensing'] . ";";
										$pdo = new PDO($dsn, $postgres_username, $postgres_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
										
										$sql1 = "CREATE TABLE licenses (act_key text PRIMARY KEY, issue_date date, valid_until date, user_hash text, pass_hash text, font text, colorscheme text, currencysymbol text, timezone text, metalsapi text, tablename text);";
										
										try {
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
											
											$stmt = $pdo->prepare($sql1);
											
											$stmt->setFetchMode(PDO::FETCH_ASSOC);
											
											$result = $stmt->execute();
											
											if($result) {
												$sql1 = "INSERT INTO licenses (act_key, issue_date, valid_until, user_hash, pass_hash, font, colorscheme, currencysymbol, timezone, metalsapi, tablename) VALUES (:act_key, :issue_date, :valid_until, :user_hash, :pass_hash, :font, :colorscheme, :currencysymbol, :timezone, :metalsapi, :tablename);";
												
												try {
													$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
													
													$stmt = $pdo->prepare($sql1);
													
													$stmt->bindValue(":act_key", $_POST['actkey']);
													$stmt->bindValue(":issue_date", $_POST['issuedate']);
													$stmt->bindValue(":valid_until", $_POST['validuntil']);
													$stmt->bindValue(":user_hash", password_hash($_POST['username'], PASSWORD_BCRYPT, ['cost' => 12]));
													$stmt->bindValue(":pass_hash", password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]));
													$stmt->bindValue(":font", $_POST['font']);
													$stmt->bindValue(":colorscheme", $_POST['colorscheme']);
													$stmt->bindValue(":currencysymbol", $_POST['currencysymbol']);
													$stmt->bindValue(":timezone", $_POST['timezone']);
													$stmt->bindValue(":tablename", $_POST['username'] . "_coins");
													
													if(isset($_POST['metalsapi'])) {
														$stmt->bindValue(":metalsapi", $_POST['metalsapi']);
													}
													
													else {
														$stmt->bindValue(":metalsapi", '');
													}
													
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
													
													$result = $stmt->execute();
													
													if($result) {
														$sql2 = "SELECT * FROM licenses WHERE act_key = :act_key;";
														
														try {
															$stmt2 = $pdo->prepare($sql2);
															
															$stmt2->bindValue(":act_key", $_POST['actkey']);
															
															$stmt2->setFetchMode(PDO::FETCH_ASSOC);
															
															$result2 = $stmt2->execute();
															
															if($result2) {
																$record2 = $stmt2->fetch();
																
																try {
																	$host = "127.0.0.1";
																	$dsndata = "pgsql:host=$host;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_data'] . ";";
																	$pdodata = new PDO($dsndata, $postgres_username, $postgres_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
																	
																	$pdodata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
																	
																	$sql3 = "CREATE TABLE " . $_POST['username'] . "_coins (nnh bigint, hasimg bigint, line bigint, barcode bigint PRIMARY KEY, type text, year text, mint text, denomination text, country_of_origin text, description text, notes text, tpg text, grade text, cert text, serial text, location text, composition text, composition_amount text, melt bigint, pcgs_coinfacts text, ngc_coin_explorer text, cost text, img_obverse text, img_reverse text, img_bonus1 text, img_bonus2 text, img_bonus3 text, img_bonus4 text);";
																	
																	$stmt3 = $pdodata->prepare($sql3);
																	
																	$stmt3->setFetchMode(PDO::FETCH_ASSOC);
																	
																	$result3 = $stmt3->execute();
																	
																	if($result3) {
																		try {
																			$result4 = true;
																			
																			if($result4) {
																				$sql6 = "ALTER TABLE " . $_POST['username'] . "_coins OWNER to " . $postgres_username . ";";

																				try {
																					$stmt6 = $pdodata->prepare($sql6);
																				
																					$result6 = $stmt6->execute();
																					
																					if($result6) {
																						$sql7 = "CREATE UNIQUE INDEX " . $_POST['username'] . "_myindex ON " . $_POST['username'] . "_coins USING btree (barcode ASC NULLS LAST, line ASC NULLS LAST);";
																						
																						try {
																							$stmt7 = $pdodata->prepare($sql7);
																							
																							$result7 = $stmt7->execute();
																							
																							if($result7) {
																								$sql8 = "CREATE INDEX " . $_POST['username'] . "_indextest2 ON " . $_POST['username'] . "_coins USING btree (location NULLS LAST, description NULLS LAST, notes NULLS LAST);";
																								
																								try {
																									$stmt8 = $pdodata->prepare($sql8);
																								
																									$result8 = $stmt8->execute();
																									
																									if($result8) {
																										$result9 = true;
																										
																										if($result9) {
																											$sql10 = "INSERT INTO " . $_POST['username'] . "_coins  (nnh, hasimg, line, barcode, type, year, mint, denomination, country_of_origin, description, notes, tpg, grade, cert, serial, location, composition, composition_amount, melt, pcgs_coinfacts, ngc_coin_explorer, cost) VALUES ('0', '0', '123456', '522416084776', 'Coin', '1907', 'P', 'US$10.00', 'US', '1907 $10 Gold Eagle (No Motto)', 'This is just a test record. Please do not delete it, things will break if you do.', 'PCGS', 'MS 66', '25226081', '1234567890', 'Living Room', '90% XAU (Gold)', '0.41016 Oz.', '1', '8852', '18852', '0.0001');";
																											
																											try {
																												$stmt10 = $pdodata->prepare($sql10);
																											
																												$result10 = $stmt10->execute();
																												
																												if($result10) {
																													printpagestart("Activated!");
																													print_r("<span>All done and welcome aboard! Please click below to log in.</span>"); ?>
																													<br>
																													<br>
																													<a href="login.php"><button type="button">Okay</button></a>
																													<?php 
																													session_destroy();
																													printpageend();
																												}
																											}
																										
																											catch(PDOException $e) {
																												echo $e->getMessage();
																												die();
																											}
																										}
																									}
																								}
																								
																								catch(PDOException $e) {
																									echo $e->getMessage();
																									die();
																								}
																							}
																						}
																						
																					   catch(PDOException $e) {
																							echo $e->getMessage();
																							die();
																						} 
																					}
																				}
																				
																				catch(PDOException $e) {
																					echo $e->getMessage();
																					die();
																				}
																			}
																		}
																		
																		catch(PDOException $e) {
																			echo $e->getMessage();
																			die();
																		}
																	}
																}
																
																catch(PDOException $e) {
																	echo $e->getMessage();
																	die();
																}
															}
														}
														
														catch(PDOException $e) {
															echo $e->getMessage();
															die();
														}
													}
													
													else {
														var_dump($result);
														die();
													}
												}
												
												catch(PDOException $e) {
													var_dump($e);
													die();
												}
											}
											
											else {
												var_dump($result);
												die();
											}
										}
										
										catch(PDOException $e) {
											var_dump($e);
											die();
										}
									}
									
									else {
										var_dump($result);
										die();
									}
								}
								
								catch(PDOException $e) {
									var_dump($e);
									die();
								}
							}
							
							else {
								var_dump($result);
								die();
							}
						}
						
						catch(PDOException $e) {
							var_dump($e);
							die();
						}
					}
					
					else {
						var_dump($result);
						die();
					}
				}
				
				catch(PDOException $e) {
					var_dump($e);
					die();
				}
			}
			
			else {
				var_dump($pdo);
				die();
			}
		}
		
		catch(PDOException $e) {
			var_dump($e);
			die();
		}
	}
	
	$colorscheme = $_POST["colorscheme"];
	$currency = $_POST["currencysymbol"];
	$font = $_POST["font"];
	$timezone = $_POST["timezone"];
	$metalsapi = $_POST["metalsapi"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$changeunpw = $_POST["changeunpw"];
	
	if($filetoinclude === "offlineinit.php" && $_SESSION["csrf"] === $_POST["csrf"]) {
		databaseinit($postgres_username, $postgres_password);
		$_SESSION['string'] .= "<span>Done.</span><br><br><a href=\"index.php\"><button type=\"button\">Return to top page</button></a>";
		echodoc($_SESSION['string']);
	}
	
	else {
	}
}

else { 
	$_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));
	$_SESSION['colorscheme'] = "dark";
	
	$key = strtoupper(base64_encode(openssl_random_pseudo_bytes(32)));
    $key = preg_replace("/\//", "", $key);
    $key = preg_replace("/\+/", "", $key);
    preg_match_all("/\w{5}/", $key, $keyarr);
    $final = "CCIDB-" . $keyarr[0][0] . "-" . $keyarr[0][1] . "-" . $keyarr[0][2] . "-" . $keyarr[0][3] . "-" . $keyarr[0][4];
	
	require_once("template.php");
	
	printpagestart("CCIDB Initializer"); ?>
				<span>Welcome to the CCIDB initializer! Please customize the following to your liking, then click "Proceed" when you're done:</span>
				<hr>
				<form id="form" action="<?php print_r(basename($_SERVER["SCRIPT_FILENAME"])); ?>" method="post" autocomplete="off">
					<input type="hidden" id="csrf" name="csrf" value="<?php print_r($_SESSION["csrf"]); ?>" required />
					<input type="hidden" id="actkey" name="actkey" value="<?php print_r($final); ?>" autocomplete="off" required readonly>
					<input type="hidden" id="changeunpw" name="changeunpw" value="yes" required />
					<span>
						<label for="colorscheme">Default Color Scheme:</label>&nbsp;
						<select id="colorscheme" name="colorscheme">
							<option value="dark">Dark (default)</option>
							<option value="light">Light</option>
						</select>
					</span>
					<br>
					<span>
						<label for="currencysymbol">Default Currency Code/Symbol:</label>&nbsp;
						<select id="currencysymbol" name="currencysymbol">
							<option value="$">Australian/Canadian/United States Dollar (default)</option>
							<option value="AU$">Australian Dollar</option>
							<option value="CA$">Canadian Dollar</option>
							<option value="US$">United States Dollar</option>
							<option value="₿">Bitcoin</option>
							<option value="¥">Chinese/Japanese Yen</option>
							<option value="€">Euro</option>
							<option value="£">Great British Pound</option>
							<option value="₩">Korean Won</option>
						</select>
					</span>
					<span><span>Example:</span>&nbsp;<span id="currencyexample"></span><span>10.00</span></span>
					<br>
					<span>
						<label for="timezone">Default Timezone:</label>&nbsp;
						<input type="text" id="timezone" name="timezone" value="" autocomplete="off" required>
					</span>
					<br>
					<span>
						<label for="font">Default Font:</label>&nbsp;
						<select id="font" name="font">
							<option class="luximono" value="Luxi Mono">Luxi Mono (default)</option>
							<option class="arial" value="Arial">Arial</option>
							<option class="segoeui" value="Segoe UI">Segoe UI</option>
							<option class="tnr" value="Times New Roman">Times New Roman</option>
							<option class="verdana" value="Verdana">Verdana</option>
						</select>
					</span>
					<span id="fontexample">Sphinx of black quartz, judge my vow.</span>
					<br>
					<span><label for="metalsapi">Metals-API Key (optional):</label>&nbsp;<input type="text" id="metalsapi" name="metalsapi" value="" autocomplete="off" pattern="\w{60}"></span>
					<br>
					<span>
						<span>Finally, please choose a username and password to access CCIDB (Please note, you CANNOT change your username once it is set!):</span>
						<br>
						<label for="username">Username:</label>&nbsp;<input type="text" id="username" name="username" value="" autocomplete="off" required>
						<br>
						<label for="password">Password:</label>&nbsp;<input type="password" id="password" name="password" value="" autocomplete="off" required>
					</span>
				</form>
				<br>
				<br>
				<button id="submitter" type="submit" form="form" value="proceed">Proceed</button>
				<script type="text/javascript" src="init.js"></script>
				<script type="text/javascript" src="navigateaway.js"></script>
<?php printpageend(); } ?>