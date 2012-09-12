<?php

	session_start();

	if(isset($_SESSION['SESS_CHANGEID']) == TRUE)
	{
		session_unset();
		session_regenerate_id();
	}

	require("konfiguracja.php");
	
	$db = mysql_connect($dbhost, $dbuser, $dbpassword);
      mysql_query("SET NAMES cp1250");
	mysql_select_db($dbdatabase, $db);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">	
<head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
	<title><?php echo $config_sitename; ?></title>
	<link href="arkusz_styli.css" rel="stylesheet">
</head>
<body>
	<div id="header">
	<h1><?php echo $config_sitename; ?></h1>
	</div>
	<div id="menu">
		<a href="<?php echo $config_basedir; ?>">Główna strona</a> -
		<a href="<?php echo $config_basedir; ?>wyswietlanie_koszyka.php">Wywietlanie koszyka/Płacenie</a>
	</div>
	<div id="container">
		<div id="bar">
			<?php
				
				require("pasek.php");
				echo "<hr>";
				
				if(isset($_SESSION['SESS_LOGGEDIN']) == TRUE)
				{
					echo "Zalogowany jako <strong>" . $_SESSION['SESS_USERNAME'] . "</strong> [<a href='" . $config_basedir . "wylogowywanie.php'>wyloguj</a>]";
				}
				else
				{
					echo "<a href='" . $config_basedir . "logowanie.php'>Logowanie</a>";
				}
			?>
			
		</div>

		<div id="main">