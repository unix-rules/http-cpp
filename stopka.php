<?php
	echo "<p><i>Prawa autorskie &copy; " . $config_sitename . "</i></p>"; 

	//if($_SESSION['SESS_ADMINLOGGEDIN'] == 1)
	if(isset($_SESSION['SESS_ADMINLOGGEDIN']) && $_SESSION['SESS_ADMINLOGGEDIN'] == 1)
	{
		echo "[<a href='" . $config_basedir . "zamowienia_administrator.php'>admin</a>] [<a href='" . $config_basedir . "wylogowywanie_administratora.php'>wylogowanie administratora</a>]";
	}
?>

</div>
	</div>
</body>
</html>