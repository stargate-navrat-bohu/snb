<?
mysql_query("SET NAMES cp1250");
echo "<h4><font color=#0099FF></font><font color=white>Po�et p��sp�vk�</h4>";

  $vys1=MySQL_Query("SELECT jmeno,prispevky FROM uzivatele where (prispevky>0) order by prispevky desc limit 20;");
  echo "<table border=1 width=100%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Po�ad�</th>";
	echo "<th colspan=1><font color=white>Hr��</th>";
	echo "<th colspan=1><font color=white>Po�et p��sp�vk�</th>";
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
