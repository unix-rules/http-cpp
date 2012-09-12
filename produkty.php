<?php
	require("bd.php");
	require("funkcje.php");

	$validid = pf_validate_number($_GET['id'], "redirect", $config_basedir);

	require("naglowek.php");
	
	$prodcatsql = "SELECT * FROM produkty WHERE id_kat = " . $_GET['id'] . ";";
	$prodcatres = mysql_query($prodcatsql);
	$numrows = mysql_num_rows($prodcatres);		

	if($numrows == 0)
	{
		echo "<h1>Brak produktów</h1>";
		echo "Kategoria nie posiada produktów.";
	}
	else
	{
	
		echo "<table cellpadding='10'>";
		
		while($prodrow = mysql_fetch_assoc($prodcatres))
		{
			echo "<tr>";
				if(empty($prodrow['obraz'])) {
					echo "<td><img src='./obrazy/brak_obrazu.jpg' alt='" . $prodrow['nazwa'] . "'></td>";
				}
				else {
					echo "<td><img src='./obrazy/" . $prodrow['obraz'] . "' alt='" . $prodrow['nazwa'] . "'></td>";
				}
				
				echo "<td>";
					echo "<h2>" . $prodrow['nazwa'] . "</h2>";
					echo "<p>" . $prodrow['opis'];
					echo "<p><strong>NASZA CENA: &pound;" . sprintf('%.2f', $prodrow['cena']) . "</strong>";
					echo "<p>[<a href='dodawanie_do_koszyka.php?id=" . $prodrow['id'] . "'>kup</a>]";
				echo "</td>";
			echo "</tr>";
		}
		
		echo "</table>";
	}

	require("stopka.php");
?>