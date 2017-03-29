
<?
mysql_query("SET NAMES cp1250");
	$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);

	$vys2 = MySQL_Query("SELECT * FROM ucet");	
	$zaznam2 = MySQL_Fetch_Array($vys2);

$celekk=$zaznam2[prijem]-$zaznam2[vydej];

	require("adkontrola.php");

	if(isset($platby)):	


$celekk=$zaznam2[prijem]-$zaznam2[vydej];

$prijatoo=$zaznam2[prijem]+$prijato;

$vydanoo=$zaznam2[vydej]+$vydano;

$datum=Date("U");

		MySQL_Query("update ucet set prijem='$prijatoo' ");
		MySQL_Query("update ucet set vydej='$vydanoo' ");
		MySQL_Query("update ucet set celek='$celekk' ");

		MySQL_Query("INSERT INTO ucely (ucel,prijem,vydej,celek,datum) VALUES ('$ucel','$prijato','$vydano','$celekk','$datum')");

echo '<script languague="JavaScript">location.href="http://www.sg-nb.cz/hlavni.php?page=ucet"</script>';

	endif;	
?>

<?
if($zaznam1[admin]!=1){echo "<h1>Sem nemáš pøístup!</h1>";exit;}
?>

</head>

<font class=text_cerveny>Kdo tu hru omylem zbankrotuje tomu rozmlatim jeho hlavu mou sadou na golf...</font><br><br>

<font class='text_bili'>Úèet SG-RTG</font><br><br>

<font class='text_bili'>Zústatek na úètu: <? echo "".$celekk.""; ?></font><br><br>

</center>

<?

    $border= 'border=1';

    echo "<center><TABLE ".$border.">";

		echo "<form action='hlavni.php?page=ucet' method='post'>";

                echo "<tr><th colspan=2>Penìžní formuláø</th></tr>";


		echo "<tr>";
		echo "<th>Pøíjem</th>";
		echo "<th><input type='text' name='prijato'></th>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<th>Platby (bez -)</th>";
		echo "<th><input type='text' name='vydano'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Dùvod pøíjmù - plateb</th>";
		echo "<th><input type='text' name='ucel'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<input type='hidden' name='platby' value='1'>";
		echo "<th colspan=2><input type='submit' value='Zapsat'></th>";
		echo "</form>";
		echo "</tr>";

		echo "</table>";


echo "<br><br><font class='text_bili'>Historie</font><br><br>";

    echo "<center><TABLE ".$border.">";


		echo "<tr>";
		echo "<th>Den</th>";
		echo "<th>Úèel</th>";
		echo "<th>Pøíjem</th>";
		echo "<th>Výdej</th>";
		echo "</tr>";
		

	$vys3 = MySQL_Query("SELECT * FROM ucely ORDER BY datum DESC ");	
	while($zaznam3 = MySQL_Fetch_Array($vys3)){

$den = Date("G:i:s j.m.Y",$zaznam3["datum"]);

		echo "<tr>";
		echo "<th>".$den."</th>";
		echo "<th>".$zaznam3[ucel]."</th>";
		echo "<th>".$zaznam3[prijem]."</th>";
		echo "<th>".$zaznam3[vydej]."</th>";
		echo "</tr>";
}

		echo "</table>";

?>