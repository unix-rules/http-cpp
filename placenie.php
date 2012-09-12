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
		<h1>P³atnoœæ czekiem</h1>
		Czek zostanie wystawiony dla <strong><?php echo $config_sitename; ?></strong>.
		<p>
		Czek zostanie wys³any na adres:
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
		echo "<h1>P³acenie</h1>";
		showcart();
	
?>
		<h2>Wybieranie metody p³atnoœci</h2>
		<form action='placenie.php' method='POST'>
		<table cellspacing=10>
		<tr>
			<td><h3>PayPal</h3></td>
			<td>
			Witryna Looproducts.com u¿ywa metody PayPal w celu akceptowania kart Switch/Visa/Mastercard. Nie jest wymagane ¿adne konto metody
			PayPal - podaje siê jedynie szczegó³y dotycz¹ce karty,
			po czym rachunek zostanie obci¹¿ony odpowiedni¹ kwot¹.
			</td>
			<td><input type="submit" name="paypalsubmit" value="Zap³aæ przy u¿yciu metody PayPal"></td>
		</tr>
		<tr>
			<td><h3>Czek</h3></td>
			<td>
			Jeœli zamierza siê zap³aciæ czekiem, po wystawieniu go na ca³kowit¹ kwotê nale¿y wys³aæ do siedziby witryny Looproducts.com.
			</td>
			<td><input type="submit" name="chequesubmit" value="Zap³aæ czekiem"></td>
		</tr>
		</table>
		</form>
	
<?php
	}
			
	require("stopka.php");
?>