<?php
	session_start();
	
	require("bd.php");
	require("funkcje.php");

	$validid = pf_validate_number($_GET['id'], "redirect", $config_basedir);

	$prodsql = "SELECT * FROM produkty WHERE id = " . $validid . ";";
	$prodres = mysql_query($prodsql);
	$numrows = mysql_num_rows($prodres);		
	$prodrow = mysql_fetch_assoc($prodres);

	if($numrows == 0)
	{
		header("Location: " . $config_basedir);
	}
	else
	{
		if($_POST['submit'])
		{
			if($_SESSION['SESS_ORDERNUM'])
			{
					$itemsql = "INSERT INTO pozycje_zamowienia(id_zamowienia, id_produktu, ilosc) VALUES("
						. $_SESSION['SESS_ORDERNUM'] . ", " . $validid . ", "
						. $_POST['amountBox'] . ")";
					mysql_query($itemsql);
			}
			else
			{
				if($_SESSION['SESS_LOGGEDIN'])
				{
					$sql = "INSERT INTO zamowienia(id_klienta, zarejestrowany, data) VALUES("
							. $_SESSION['SESS_USERID'] . ", 1, NOW())";
					mysql_query($sql);
					session_register("SESS_ORDERNUM");
					$_SESSION['SESS_ORDERNUM'] = mysql_insert_id();
					
					$itemsql = "INSERT INTO pozycje_zamowienia(id_zamowienia, id_produktu, ilosc) VALUES("
						. $_SESSION['SESS_ORDERNUM'] . ", " . $validid . ", "
						. $_POST['amountBox'] . ")";

					mysql_query($itemsql);
				}
				else
				{
					$sql = "INSERT INTO zamowienia(zarejestrowany, data, sesja) VALUES("
							. "0, NOW(), '" . session_id() . "')";
					mysql_query($sql);
					session_register("SESS_ORDERNUM");
					$_SESSION['SESS_ORDERNUM'] = mysql_insert_id();
					
					$itemsql = "INSERT INTO pozycje_zamowienia(id_zamowienia, id_produktu, ilosc) VALUES("
						. $_SESSION['SESS_ORDERNUM'] . ", " . $validid . ", "
						. $_POST['amountBox'] . ")";

					mysql_query($itemsql);
				}					
			}


			$totalprice = $prodrow['cena'] * $_POST['amountBox'] ;

			$updsql = "UPDATE zamowienia SET suma = suma + " . $totalprice . " WHERE id = " . $_SESSION['SESS_ORDERNUM'] . ";";
			mysql_query($updres);
			
			header("Location: " . $config_basedir . "wyswietlanie_koszyka.php");
		}
		else
		{
			require("naglowek.php");

			echo "<form action='dodawanie_do_koszyka.php?id=" . $_GET['id'] . "' method='POST'>";
			echo "<table cellpadding='10'>";
		
		
			echo "<tr>";
				if(empty($prodrow['obraz'])) {
					echo "<td><img src='./obrazy/brak_obrazu.jpg' width='50' alt='" . $prodrow['nazwa'] . "'></td>";
				}
				else {
					echo "<td><img src='./obrazy/" . $prodrow['obraz'] . "' width='50' alt='" . $prodrow['nazwa'] . "'></td>";
				}

				echo "<td>" . $prodrow['nazwa'] . "</td>";
				echo "<td>Okreœl iloœæ<select name='amountBox'>";
			
				for($i=1;$i<=100;$i++)
				{
					echo "<option>" . $i . "</option>";
				}
			
				echo "</select></td>";
				echo "<td><strong>&pound;" . sprintf('%.2f', $prodrow['cena']) . "</strong></td>";
				echo "<td><input type='submit' name='submit' value='Dodaj do koszyka'></td>";
			echo "</tr>";
							
			echo "</table>";
			echo "</form>";
		}
	}

	require("stopka.php");
?>