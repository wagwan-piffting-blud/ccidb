<?php

require_once("globalvars.php");

$sql2 = "SELECT * FROM licenses WHERE tablename = :tablename;";

try {
	$host = "127.0.0.1";
	$dsnlicense = "pgsql:host=$host;port=" . $_SESSION['pgsql_port'] . ";dbname=" . $_SESSION['pgsql_licensing'] . ";";
	$pdolicense = new PDO($dsnlicense, $_SESSION['postgres_username'], $_SESSION['postgres_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
	
	$pdolicense->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$stmt2 = $pdolicense->prepare($sql2);
	
	$stmt2->bindValue(":tablename", $_SESSION['tablename']);
	
	$stmt2->setFetchMode(PDO::FETCH_ASSOC);
	
	$result2 = $stmt2->execute();
	
	if($result2) {
		$record2 = $stmt2->fetch();
		
		setcookie("colorscheme", $record2['colorscheme'], time()+120, "/", "", 0);
        setcookie("currencysymbol", $record2['currencysymbol'], time()+120, "/", "", 0);
        setcookie("timezone", $record2['timezone'], time()+120, "/", "", 0);
        setcookie("font", $record2['font'], time()+120, "/", "", 0);
        setcookie("metalsapi", $record2['metalsapi'], time()+120, "/", "", 0);
	}
}

catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));

require_once("template.php");
printpagestart("CCIDB Settings"); ?>
				<span>Here you can change the settings of your CCIDB instance if you wish, including the default currency code, timezone, font, and your password.</span>
				<hr>
				<form id="settingsform" action="init.php" method="post" autocomplete="off">
					<input type="hidden" id="csrf" name="csrf" value="<?php print_r($_SESSION["csrf"]); ?>" required />
					<label for="colorscheme" class="required">Default color scheme (this will be the color scheme used throughout CCIDB):</label>&nbsp;
            		<select id="colorscheme" name="colorscheme">
            			<option value="dark">Dark (default)</option>
            			<option value="light">Light</option>
            		</select>
            		<br>
            		<br>
            		<label for="currencysymbol" class="required">Default Currency Code/Symbol (this will be appended to the "Cost" and "Melt Value" fields):</label>&nbsp;
            		<select id="currencysymbol" name="currencysymbol" required>
            			<option value="$">Australian/Canadian/United States Dollar (no country prefix) (default)</option>
            			<option value="AU$">Australian Dollar</option>
            			<option value="CA$">Canadian Dollar</option>
            			<option value="US$">United States Dollar</option>
            			<option value="₿">Bitcoin</option>
            			<option value="¥">Chinese/Japanese Yen</option>
            			<option value="€">Euro</option>
            			<option value="£">Great British Pound</option>
            			<option value="₩">Korean Won</option>
            		</select>
            		<br>
            		<span>Example:</span>&nbsp;<span id="currencyexample"></span><span>10.00</span>
            		<br>
            		<br>
            		<label for="timezone" class="required">Default Timezone (this will be used for melt values, you can find a list of timezone codes <a href="https://en.wikipedia.org/wiki/List_of_tz_database_time_zones" class="new_window">here</a>)</label>&nbsp;
            		<input type="text" id="timezone" name="timezone" value="" autocomplete="off" required>
            		<br>
            		<br>
            		<label for="font" class="required">Default Font (this will be the font used throughout CCIDB):</label>&nbsp;
            		<select id="font" name="font" required>
            			<option class="luximono" value="Luxi Mono">Luxi Mono (default)</option>
            			<option class="arial" value="Arial">Arial</option>
            			<option class="segoeui" value="Segoe UI">Segoe UI</option>
            			<option class="tnr" value="Times New Roman">Times New Roman</option>
            			<option class="verdana" value="Verdana">Verdana</option>
            		</select>
            		<br>
            		<span id="fontexample">Sphinx of black quartz, judge my vow.</span>
            		<br>
            		<br>
            		<label for="metalsapi">Your <a href="https://metals-api.com/" class="new_window">Metals-API</a> API key (this will be used for melt values if provided, OPTIONAL):</label>&nbsp;<input type="text" id="metalsapi" name="metalsapi" value="" autocomplete="off" pattern="\w{60}" maxlength="60">
            		<br>
            		<br>
					<label for="changeunpw">Do you wish to change your password at this time?</label>&nbsp;
					<select id="changeunpw" name="changeunpw">
						<option value="no">No (default)</option>
						<option value="yes">Yes</option>
					</select>
					<br class="changeunpwyes">
					<br class="changeunpwyes">
					<span class="changeunpwyes">Choose a new password:</span>
					<br class="changeunpwyes">
					<br class="changeunpwyes">
					<label class="changeunpwyes" for="password" id="pwlabel">Password:</label>&nbsp;<input class="changeunpwyes" type="password" id="password" name="password" value="" autocomplete="off" maxlength="72">
					<br>
		            <label class="small">&nbsp;indicates a required field.</label>
				</form>
				<br>
				<br>
				<button id="submitter" type="submit" form="settingsform" value="proceed" class="danger">Proceed</button>
				<br>
				<a href="index.php"><button type="button">Return to top page</button></a>
				<script type="text/javascript" src="settings.js"></script>
				<script type="text/javascript" src="init.js"></script>
				<script type="text/javascript" src="navigateaway.js"></script>
<?php printpageend(); ?>