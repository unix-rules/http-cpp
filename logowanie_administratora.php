<?php
	session_start();

	require("bd.php");
	
	if(isset($_SESSION['SESS_ADMINLOGGEDIN']) == TRUE) {
		header("Location: " . $config_basedir);
	}
	
	if($_POST['submit'])
	{
		$loginsql = "SELECT * FROM administratorzy WHERE nazwa_uzytkownika = '" . $_POST['userBox'] . "' AND haslo = '" . $_POST['passBox'] . "'";
		$loginres = mysql_query($loginsql);
		$numrows = mysql_num_rows($loginres);
		
		if($numrows == 1)
		{
			$loginrow = mysql_fetch_assoc($loginres);
			
			session_register("SESS_ADMINLOGGEDIN");
			
			$_SESSION['SESS_ADMINLOGGEDIN'] = 1;

			header("Location: " . $config_basedir  . "zamowienia_administrator.php");

		}
		else
		{
			header("Location: " . $config_basedir  . "logowanie_administratora.php?error=1");
		}
	}
	else
	{

	require("naglowek.php");
		
	echo "<h1>Logowanie administratora</h1>";
	
	if($_GET['error'] == 1) {
		echo "<strong>Niepoprawna nazwa u¿ytkownika / haslo!</strong>";
	}
?>
	<p>
	<form action="<?php echo $SCRIPT_NAME; ?>" method="POST">
	<table>
		<tr>
			<td>Nazwa konta</td>
			<td><input type="textbox" name="userBox">
		</tr>
		<tr>
			<td>Has³o</td>
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