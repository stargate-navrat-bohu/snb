<? 
mysql_query("SET NAMES cp1250");
require "data_1.php";

/*

echo '<script type="text/javascript" src="cotojatka/tooltips.js"></script>';



echo ('<style type="text/css">.name{font-weight:bold;}</style>'."\n");

*/

/*

	$kolik_1 = MySQL_Query("SELECT kym FROM privedeno where kym='1001400' ");
	      $kolik = mysql_num_rows($kolik_1);
			echo " $kolik ";


MySQL_Query("update privedeno set kym='1001400' WHERE kym='1001400' ");


*/

/*

	$jmena_1 = MySQL_Query("SELECT jmeno FROM uzivatele where rasa='77'");

//	mysql_query("DELETE FROM `uzivatele` WHERE rasa='77' LIMIT 100");

echo "
<table border='1'><tr>
<th>èíslo</th>
<th>jméno</th></tr>";

$cislo=1;

	      while($jmena = mysql_fetch_array($jmena_1)){

			echo " <tr><th> $cislo </th>";

			echo " <th> $jmena[jmeno] </th></tr>";
$cislo++;
}


echo "
            <p>
              <a href=\"a/?url=http://b\" target=\"_blank\" title=\"<strong>Reklamní kampaò</strong> c <br /><br /><em>Pøejít na stránku reklamní kampanì</em>\">xx</a>
            </p> ";

echo "<p style=\"text-align:center;\"><a href=\"pridat/\" title=\"Pøidat reklamní kampaò\">Pøidat reklamní kampaò</a></p>";

*/





/*

	$jmena_1 = MySQL_Query("SELECT odesilatel, adresat, typ, text FROM posta where adresat='Santino_Corleone'");

echo "
<table border='1'><tr>
<th>èíslo</th>
<th>adresat</th>
<th>odesilatel</th>
<th>text</th>
<th>druh</th></tr>";

$cislo=1;

	      while($jmena = mysql_fetch_array($jmena_1)){

			echo " <tr><th> $cislo </th>";

			echo " <th> $jmena[adresat] </th>";
			echo " <th> $jmena[odesilatel] </th>";
			echo " <th> $jmena[text] </th>";
			echo " <th> $jmena[typ] </th></tr>";
$cislo++;
}

*/

	        $d=Date("U")-86400;
		$smazdny=86400*8;

				MySQL_Query("DELETE FROM uzivatele WHERE (($d-den)>$smazdny and rasa=98) LIMIT 50 ");


?>

</table>