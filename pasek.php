<h1>Kategorie produktów</h1>
<ul>
<?php

	$catsql = "SELECT * FROM kategorie;";
	$catres = mysql_query($catsql);
	
	while($catrow = mysql_fetch_assoc($catres))
	{
		echo "<li><a href='" . $config_basedir . "/produkty.php?id=" . $catrow['id'] . "'>" . $catrow['nazwa'] . "</a></li>";
	}
?>
</ul>