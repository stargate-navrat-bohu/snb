
<?
	require 'data_1.php';
mysql_query("SET NAMES cp1250");

	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	
  

?>

<h6>Hráèi odmìnìní za posledních 24 hodin:</h6>

</table>

<?
$datum=Date("U");
$datum_t=$datum - 86400;
		$vys1 = MySQL_Query("SELECT jmeno,rasa,ip,aukro FROM uzivatele where aukro >= '$datum_t' ORDER BY aukro DESC");



		  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>---</th>";
	echo "<th colspan=1><font color=white>Jméno</th>";
	echo "<th colspan=1><font color=white>Den</th>";
	//echo "<th colspan=1><font color=white>IP</th>";
	echo "<th colspan=1><font color=white>Pøipsaná èástka</th>";
	echo "</tr>";

echo "</tr>";

$counter = 1;
while ($zaznam1=MySQL_Fetch_Array($vys1)) {
  $den = Date("j.m.Y G:i:s",$zaznam1["aukro"]);

		$vys2 = MySQL_Query("SELECT rasa,vyr_vyrob FROM rasy where rasa = $zaznam1[rasa]");
		$zaznam2 = MySQL_Fetch_Array($vys2);
$zisk=30000*$zaznam2[vyr_vyrob];

echo "<tr>";
echo "<th><font color=white>", $counter, "</th>";
echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
echo "<td><font color=white>".$den."</td>";
//echo "<td><font color=white>".$zaznam1[ip]."</td>";
echo "<td><font color=white>".$zisk."</td>";
echo "</tr>";
$counter++;

}	
				
echo "</table>";

		


?>


