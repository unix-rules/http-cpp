<?php

	session_start();

	require("konfiguracja.php");

	session_unregister("SESS_ADMINLOGGEDIN");
	
	header("Location: " . $config_basedir);
?>