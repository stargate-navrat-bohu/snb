<?
mysql_query("SET NAMES cp1250");
echo "<h4><font color=#0099FF></font><font color=white>Poèet pøíspìvkù</h4>";

  $vys1=MySQL_Query("SELECT jmeno,prispevky FROM uzivatele where (prispevky>0) order by prispevky desc limit 20;");
  echo "<table border=1 width=100%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Poøadí</th>";
	echo "<th colspan=1><font color=white>Hráè</th>";
	echo "<th colspan=1><font color=white>Poèet pøíspìvkù</th>";
	echo "</tr>";

$counter = 1;
while ($zaznam1=MySQL_Fetch_Array($vys1)) {
echo "<tr>";
echo "<th><font color=white>", $counter, "</th>";
echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
echo "<td><font color=white>".$zaznam1[prispevky]."</td>";
echo "</tr>";
$counter++;
}


?>

</table>
