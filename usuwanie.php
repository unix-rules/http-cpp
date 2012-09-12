<?php

	require("konfiguracja.php");
	require("bd.php");
	require("funkcje.php");

	$validid = pf_validate_number($_GET['id'], "redirect", $config_basedir . "wyswietlanie_koszyka.php");
	
	$itemsql = "SELECT * FROM pozycje_zamowienia WHERE id = " . $_GET['id'] . ";";
	$itemres = mysql_query($itemsql);
	$numrows = mysql_num_rows($itemres);
	
	if($numrows == 0) {
		header("Location: " . $config_basedir . "wyswietlanie_koszyka.php");
	}
	
	$itemrow = mysql_fetch_assoc($itemres);

	$prodsql = "SELECT cena FROM produkty WHERE id = " . $itemrow['id_produktu'] . ";";
	$prodres = mysql_query($prodsql);
	$prodrow = mysql_fetch_assoc($prodres);
	
	$sql = "DELETE FROM pozycje_zamowienia WHERE id = " . $_GET['id'];
	mysql_query($sql);
	
	$totalprice = $prodrow['cena'] * $itemrow['ilosc'] ;

	$updsql = "UPDATE zamowienia SET suma = suma - " . $totalprice . " WHERE id = " . $_SESSION['SESS_ORDERNUM'] . ";";
	mysql_query($updres);

	header("Location: " . $config_basedir . "/wyswietlanie_koszyka.php");

?>