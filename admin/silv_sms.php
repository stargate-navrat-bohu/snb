<?
mysql_query("SET NAMES cp1250");
  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jméno</th>";
	echo "<th colspan=1><font color=white>Pøijatá èástka</th>";
	echo "<th colspan=1><font color=white>Gold</th>";
	echo "<th colspan=1><font color=white>Silver</th>";
	echo "<th colspan=1><font color=white>Rasa</th>";
	echo "</tr>";

echo "</tr>";

				
		$vypsat_0 = MySQL_Query("select text,hodnota from platby");
		while ($vypsat_1 = MySQL_Fetch_Array($vypsat_0)) {		

$cislosms=$vypsat_1[text];	


		$vypsat_2 = MySQL_Query("select cislo,jmeno,gold,silver,rasa from uzivatele where cislo=$cislosms");
		$vypsat_3 = MySQL_Fetch_Array($vypsat_2);



echo "<tr>";
echo "<th><font color=white>".$vypsat_3[jmeno]."</th>";
echo "<th><font color=white>".$vypsat_1[hodnota]."</th>";
echo "<th><font color=white>".$vypsat_3[gold]."</th>";
echo "<th><font color=white>".$vypsat_3[silver]."</th>";
echo "<th><font color=white>".$vypsat_3[rasa]."</th>";
echo "</tr>";
}							
echo "</table>";

	
?>
