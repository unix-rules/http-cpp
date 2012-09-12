<?php
	session_start();

	require("naglowek.php");	
	require("funkcje.php");

	echo "<h1>Twój koszyk zakupów</h1>";
	showcart();

	if(isset($_SESSION['SESS_ORDERNUM']) == TRUE) {
		$sql = "SELECT * FROM pozycje_zamowienia WHERE id_zamowienia = " . $_SESSION['SESS_ORDERNUM'] . ";";
		$result = mysql_query($sql);
		$numrows = mysql_num_rows($result);
		
		if($numrows >= 1) {
			echo "<h2><a href='placenie_adres.php'>Do kasy</a></h2>";
		}
	}
	
	
	require("stopka.php");
?>