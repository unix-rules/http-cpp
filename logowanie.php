<?php
	session_start();
	require("bd.php");

	if(isset($_SESSION['SESS_LOGGEDIN'])) {
		header("Location: " . $config_basedir);
	}
	
	if($_POST['submit'])
	{
		$loginsql = "SELECT * FROM loginy WHERE nazwa_uzytkownika = '" . $_POST['userBox'] . "' AND haslo = '" . $_POST['passBox'] . "'";
		$loginres = mysql_query($loginsql);
		$numrows = mysql_num_rows($loginres);
		
		if($numrows == 1)
		{
			$loginrow = mysql_fetch_assoc($loginres);
			
			session_register("SESS_LOGGEDIN");
			session_register("SESS_USERNAME");
			session_register("SESS_USERID");
			
			$_SESSION['SESS_LOGGEDIN'] = 1;
			$_SESSION['SESS_USERNAME'] = $loginrow['nazwa_uzytkownika'];
			$_SESSION['SESS_USERID'] = $loginrow['id'];
			
			$ordersql = "SELECT id FROM zamowienia WHERE id_klienta = " . $_SESSION['SESS_USERID'] . " AND status < 2";
			$orderres = mysql_query($ordersql);
			$orderrow = mysql_fetch_assoc($orderres);
			
			session_register("SESS_ORDERNUM");
			$_SESSION['SESS_ORDERNUM'] = $orderrow['id'];
			
			header("Location: " . $config_basedir);
		}
		else
		{
			header("Location: http://" . $HTTP_HOST . $SCRIPT_NAME . "?error=1");
		}
	}
	else
	{
		require("naglowek.php");
?>
	<h1>Logowanie klienta</h1>
	W celu zalogowania się proszę podać nazwę konta użytkownika i hasło. Jeśli nie dysponuje się kontem, można je za darmo uzyskać. Wystarczy kliknąć odnośnik <a href="rejestrowanie.php">rejestrowanie</a>.
	<p>
	
	<?php
  if(isset($_GET) && isset($_GET['error'])){
			echo "<strong>Niepoprawna nazwa użytkownika / haslo</strong>";
		}
	?>
	
	<form action="<?php echo $SCRIPT_NAME; ?>" method="POST">
	<table>
		<tr>
			<td>Nazwa użytkownika</td>
			<td><input type="textbox" name="userBox">
		</tr>
		<tr>
			<td>Hasło</td>
			<td><input type="password" name="passBox">
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Zaloguj">
		</tr>		
	</table>
	</form>
	
<?php
	}
	
	require("stopka.php");
?>