<?php
	session_start();

	require("konfiguracja.php");
	require("bd.php");
	require("funkcje.php");
		
	if(isset($_SESSION['SESS_ADMINLOGGEDIN']) == FALSE) {
		header("Location: " . $config_basedir);
	}

	if(isset($_GET['func']) == TRUE) {

		if($_GET['func'] != "conf") {
			header("Location: " . $config_basedir);
		}
	
		$validid = pf_validate_number($_GET['id'], "redirect", $config_basedir);
	
		$funcsql = "UPDATE zamowienia SET status = 10 WHERE id = " . $_GET['id'];
		mysql_query($funcsql);

		header("Location: " . $config_basedir . "zamowienia_administrator.php");
	}
	else {
		require("naglowek.php");
		echo "<h1>Realizowane zamówienia</h1>";
		$orderssql = "SELECT * FROM zamowienia WHERE status = 2";
		$ordersres = mysql_query($orderssql);
		$numrows = mysql_num_rows($ordersres);
		
		if($numrows == 0)
		{
			echo "<strong>Brak zamówieñ</strong>";
		}
		else
		{				
			echo "<table cellspacing=10>";
		
			while($row = mysql_fetch_assoc($ordersres))
			{
				echo "<tr>";
					echo "<td>[<a href='szczegoly_zamowienia_administrator.php?id=" . $row['id'] . "'>Wyœwietl</a>]</td>";
					echo "<td>" . date("D jS F Y g.iA", strtotime($row['data'])) . "</td>";
					echo "<td>";
					
					if($row['zarejestrowany'] == 1)
					{
						echo "Zarejestrowany klient";
					}
					else
					{
						echo "Niezarejestrowany klient";
					}
					
					echo "</td>";
		
					echo "<td>&pound;" . sprintf('%.2f', $row['suma']) . "</td>";
	
					echo "<td>";
					
					if($row['metoda_platnosci'] == 1)
					{
						echo "PayPal";
					}
					else
					{
						echo "Czek";
					}
				
					echo "</td>";
			
					echo "<td><a href='zamowienia_administrator.php?func=conf&id=" . $row['id'] . "'>PotwierdŸ p³atnoœæ</a></td>";
				echo "</tr>";	
			}

			echo "</table>";
		}
	}

	require("stopka.php");
?>