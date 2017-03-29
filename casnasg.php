<?
mysql_query("SET NAMES cp1250");
echo "<h4><font color=#0099FF>P</font><font color=white>oèet minut na SG</h4>";

  $vys1=MySQL_Query("SELECT jmeno,casnasg FROM uzivatele where (casnasg>0) order by casnasg desc limit 20;");
  echo "<table border=1 width=100%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Poøadí</th>";
	echo "<th colspan=1><font color=white>Hráè</th>";
	echo "<th colspan=1><font color=white>Poèet minut</th>";
	echo "</tr>";

echo "</tr>";
$counter = 1;
while ($zaznam1=MySQL_Fetch_Array($vys1)) {
echo "<tr>";
echo "<th><font color=white>", $counter, "</th>";
echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
$minut=$zaznam1[casnasg]/60;
$minut=floor($minut);
echo "<td><font color=white>".$minut."</td>";
echo "</tr>";
$counter++;
}

MySQL_Close($spojeni);
?>
</table>
