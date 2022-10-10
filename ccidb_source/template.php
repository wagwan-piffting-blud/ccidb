<?php 

require_once("globalvars.php");

if(str_replace('\\', '/', __FILE__) == $_SERVER['SCRIPT_FILENAME']) {
	header("Location: index.php");
}

else {
	function printpagestart($title) { ?><!DOCTYPE html>
	<html lang="en" id="htmltag" class="<?php print_r($_SESSION['colorscheme']); ?>">
		<head>
			<meta name="robots" content="noindex, nofollow">
			<meta charset="utf-8"/>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="/css/ccidb.php">
			
			<!-- Discord/OGP Meta Tags -->
    		<meta property="og:title" content="Coin Collection Information DataBase" />
    		<meta property="og:type" content="website" />
    		<meta property="og:image" content="https://ccidb.wagspuzzle.space/assets/ogp.png" />
    		<meta property="og:url" content="https://ccidb.wagspuzzle.space/" />
    		<meta property="og:description" content="A site for tracking your coin collection. By Wags, for the greater good, with love." />
    		
    		<!-- Twitter Meta Tags -->
    		<meta name="twitter:card" content="summary_large_image" />
    		<meta name="twitter:site" content="https://ccidb.wagspuzzle.space/" />
    		<meta name="twitter:title" content="Coin Collection Information DataBase" />
    		<meta name="twitter:creator" content="wagwan_piffting_blud" />
    		<meta name="twitter:description" content="A site for tracking your coin collection. By Wags, for the greater good, with love." />
    		<meta name="twitter:image:src" content="https://ccidb.wagspuzzle.space/assets/ogp.png" />
    		
    		<!-- Favicon Tags -->
    		<link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
            <link rel="manifest" href="/assets/site.webmanifest">
            <link rel="mask-icon" href="/assets/safari-pinned-tab.svg" color="#5bbad5">
            <link rel="shortcut icon" href="/assets/favicon.ico">
            <meta name="msapplication-TileColor" content="#33B5E5">
            <meta name="msapplication-config" content="/assets/browserconfig.xml">
            <meta name="theme-color" content="#33B5E5">
			
			<title><?php print_r($title); ?></title>
		</head>
		<body>
			<div class="wrapper">
				<div class="main" id="main"><?php }
				
	function printpagestartnew($title) { ?><!DOCTYPE html>
	<html lang="en" id="htmltag" class="<?php print_r($_SESSION['colorscheme']); ?>">
		<head>
			<meta name="robots" content="noindex, nofollow">
			<meta charset="utf-8"/>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="/css/ccidb.php">
			
			<!-- Discord/OGP Meta Tags -->
    		<meta property="og:title" content="Coin Collection Information DataBase" />
    		<meta property="og:type" content="website" />
    		<meta property="og:image" content="https://ccidb.wagspuzzle.space/assets/ogp.png" />
    		<meta property="og:url" content="https://ccidb.wagspuzzle.space/" />
    		<meta property="og:description" content="A site for tracking your coin collection. By Wags, for the greater good, with love." />
    		
    		<!-- Twitter Meta Tags -->
    		<meta name="twitter:card" content="summary_large_image" />
    		<meta name="twitter:site" content="https://ccidb.wagspuzzle.space/" />
    		<meta name="twitter:title" content="Coin Collection Information DataBase" />
    		<meta name="twitter:creator" content="wagwan_piffting_blud" />
    		<meta name="twitter:description" content="A site for tracking your coin collection. By Wags, for the greater good, with love." />
    		<meta name="twitter:image:src" content="https://ccidb.wagspuzzle.space/assets/ogp.png" />
    		
    		<!-- Favicon Tags -->
    		<link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
            <link rel="manifest" href="/assets/site.webmanifest">
            <link rel="mask-icon" href="/assets/safari-pinned-tab.svg" color="#5bbad5">
            <link rel="shortcut icon" href="/assets/favicon.ico">
            <meta name="msapplication-TileColor" content="#33B5E5">
            <meta name="msapplication-config" content="/assets/browserconfig.xml">
            <meta name="theme-color" content="#33B5E5">
			
			<title><?php print_r($title); ?></title>
		</head>
		<body>
			<div class="divs">
	<?php }

	function printpageend() { ?>
				</div>
			</div>
		</body>
	</html>
	<?php }

	function printpageendnew() { ?>
			</div>
		</body>
	</html>
	<?php }
} ?>