<?php
	session_start();
	
	require("bd.php");
	require("funkcje.php");
		
	if($_POST['paypalsubmit'])
	{
		$upsql = "UPDATE zamowienia SET status = 2, metoda_platnosci = 1 WHERE id = " . $_SESSION['SESS_ORDERNUM'];
		$upres = mysql_query($upsql);

		$itemssql = "SELECT suma FROM zamowienia WHERE id = " . $_SESSION['SESS_ORDERNUM'];
		$itemsres = mysql_query($itemssql);
		$row = mysql_fetch_assoc($itemsres);

		if($_SESSION['SESS_LOGGEDIN'])
		{
			unset($_SESSION['SESS_ORDERNUM']);
		}
		else
		{
			session_register("SESS_CHANGEID");
			$_SESSION['SESS_CHANGEID'] = 1;
		}

		header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=firma%40twoj_adres.com&item_name=" . urlencode($config_sitename) . "+Order&item_number=PROD" . $row['id'] ."&amount=" . urlencode(sprintf('%.2f', $row['suma'])) . "&no_note=1&currency_code=GBP&lc=GB&submit.x=41&submit.y=15");

	}
	else if($_POST['chequesubmit'])
	{
		$upsql = "UPDATE zamowienia SET status = 2, metoda_platnosci = 2 WHERE id = " . $_SESSION['SESS_ORDERNUM'];
		$upres = mysql_query($upsql);

		if($_SESSION['SESS_LOGGEDIN'])
		{
			unset($_SESSION['SESS_ORDERNUM']);
		}
		else
		{
			session_register("SESS_CHANGEID");
			$_SESSION['SESS_CHANGEID'] = 1;
		}

		require("naglowek.php");
?>
		<h1>P�atno�� czekiem</h1>
		Czek zostanie wystawiony dla <strong><?php echo $config_sitename; ?></strong>.
		<p>
		Czek zostanie wys�any na adres:
		<p>
		<?php echo $config_sitename; ?><br>
		22, Miejsce,<br>
		Miasto,<br>
		Kraj,<br>
		FG43 F3D.<br>
<?php
	}
	else
	{
		require("naglowek.php");
		echo "<h1>P�acenie</h1>";
		showcart();
	
?>
		<h2>Wybieranie metody p�atno�ci</h2>
		<form action='placenie.php' method='POST'>
		<table cellspacing=10>
		<tr>
			<td><h3>PayPal</h3></td>
			<td>
			Witryna Looproducts.com u�ywa metody PayPal w celu akceptowania kart Switch/Visa/Mastercard. Nie jest wymagane �adne konto metody
			PayPal - podaje si� jedynie szczeg�y dotycz�ce karty,
			po czym rachunek zostanie obci��ony odpowiedni� kwot�.
			</td>
			<td><input type="submit" name="paypalsubmit" value="Zap�a� przy u�yciu metody PayPal"></td>
		</tr>
		<tr>
			<td><h3>Czek</h3></td>
			<td>
			Je�li zamierza si� zap�aci� czekiem, po wystawieniu go na ca�kowit� kwot� nale�y wys�a� do siedziby witryny Looproducts.com.
			</td>
			<td><input type="submit" name="chequesubmit" value="Zap�a� czekiem"></td>
		</tr>
		</table>
		</form>
	
<?php
	}
			
	require("stopka.php");
?>