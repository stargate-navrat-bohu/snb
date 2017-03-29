<?



	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	require("adkontrola.php");
mysql_query("SET NAMES cp1250");
	if(isset($zmena_armad)):			
		MySQL_Query("update rasy set jed1_nazev='$jed1',jed1_utok=$jed1u,jed1_obrana=$jed1o,jed1_cena=$jed1c,jed1_lidi=$jed1l WHERE rasa = $rasa");
		MySQL_Query("update rasy set jed4_nazev='$jed4',jed4_utok=$jed4u,jed4_obrana=$jed4o,jed4_cena=$jed4c,jed4_lidi=$jed4l WHERE rasa = $rasa");
		MySQL_Query("update rasy set jed2_nazev='$jed2',jed2_utok=$jed2u,jed2_obrana=$jed2o,jed2_cena=$jed2c,jed2_lidi=$jed2l WHERE rasa = $rasa");
		MySQL_Query("update rasy set jed3_nazev='$jed3',jed3_ucinek='$jed3u',jed3_cena=$jed3c,jed3_lidi=$jed3l WHERE rasa = $rasa");
		MySQL_Query("update rasy set jed6_nazev='$jed6',jed6_ucinek='$jed6u',jed6_cena=$jed6c,jed6_lidi=$jed6l WHERE rasa = $rasa");
		
		MySQL_Query("update rasy set jed7_nazev='$jed7',jed7_ucinek='$jed7u',jed7_cena=$jed7c,jed7_lidi=$jed7l WHERE rasa = $rasa");

		MySQL_Query("update rasy set jed8_nazev='$jed8',jed8_ucinek='$jed8u',jed8_cena=$jed8c,jed8_lidi=$jed8l WHERE rasa = $rasa");

		MySQL_Query("update rasy set planeta='$cpc' WHERE rasa = $rasa");

                MySQL_Query("update rasy set vyr_nazev='$vyn',vyr_vyrob=$vyv,vyr_lidi=$vyl,vyr_cena=$vyc WHERE rasa = $rasa");
		MySQL_Query("update rasy set sdi_nazev='$sn',sdi_ucinek=$sv,sdi_lidi=$sl,sdi_cena=$sc WHERE rasa = $rasa");
		MySQL_Query("update rasy set pol_nazev='$pon',pol_ucinek=$pou,pol_cena = $poc WHERE rasa = $rasa");
		MySQL_Query("update rasy set kas_lidi=$kl,kas_cena=$kc WHERE rasa = $rasa");
		MySQL_Query("update rasy set mes_lidi=$ml,mes_cena=$mc,mest=$mm WHERE rasa = $rasa");
		MySQL_Query("update rasy set lab_lidi=$ll,lab_cena=$lc,lab_vyz=$lv WHERE rasa = $rasa");
		MySQL_Query("update rasy set park_proc=$pp,park_cena=$pc,park_nazev='$pn' WHERE rasa = $rasa");
		MySQL_Query("update rasy set bra_cena=$bc WHERE rasa = $rasa");
	endif;	

if($zaznam1[admin]==2){echo "<h1>Sem nemají pomocní adminé pøístup!</h1>";exit;}
?>

</center>
<font class=text_bili>

<form name='form1' method='post' action='hlavni.php?page=admin11'>
Vyber rasu <select name='rasa'>
<?
$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa>0 and rasa<99 order by rasa");
while ($zaznam4 = MySQL_Fetch_Array($vys4)):
	echo "<option value = ".$zaznam4[rasa];
	if ($rasa==$zaznam4["rasa"]) {echo " selected";}
	echo ">".$zaznam4["nazevrasy"]."</option>";
endwhile;
?>
</select>
<input type=submit value="zobraz">
</form>
<?
	if(isset($rasa)):
		$ra1 = MySQL_Query("SELECT * FROM rasy where rasa = $rasa");
		$ra = MySQL_Fetch_Array($ra1);
    $border= 'border=1';
		echo "<center><h1>$ra[nazevrasy]</h1></center>";
    echo "<TABLE ".$table." ".$border.">";
		echo "<td><form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<b><u>Nastavení jednotek:</b></u>";
		echo "<tr>";
		echo "<th>název</th>";
		echo "<th>útok</th>";
		echo "<th>obrana</th>";
		echo "<th>cena</th>";
		echo "<th>míst</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' value='$ra[jed1_nazev]' name='jed1'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed1_utok]' name='jed1u'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed1_obrana]' name='jed1o'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed1_cena]' name='jed1c'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed1_lidi]' name='jed1l'></td>";		
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' value='$ra[jed2_nazev]' name='jed2'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed2_utok]' name='jed2u'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed2_obrana]' name='jed2o'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed2_cena]' name='jed2c'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed2_lidi]' name='jed2l'></td>";		
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' value='$ra[jed4_nazev]' name='jed4'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed4_utok]' name='jed4u'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed4_obrana]' name='jed4o'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed4_cena]' name='jed4c'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed4_lidi]' name='jed4l'></td>";		
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' value='$ra[jed3_nazev]' name='jed3'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed3_ucinek]' name='jed3u'></td>";
		echo "<td></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed3_cena]' name='jed3c'></td>";	
		echo "<td><input type='text' size = 5 value='$ra[jed3_lidi]' name='jed3l'></td>";		
                echo "</tr>";

		echo "<tr>";
		echo "</table>";

    echo "</td>";

		echo "<td><b><u>Nastavení Nebojových jednotek</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<tr>";
		echo "<th>název</th>";
		echo "<th>úèinek</th>";
		echo "<th>cena</th>";
		echo "<th>míst</th>";
		echo "</tr>";
                echo "<tr>";
		echo "<td><input type='text' value='$ra[jed6_nazev]' name='jed6'></td>";		
		echo "<td><input type='text' size = 20 value='$ra[jed6_ucinek]' name='jed6u'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed6_cena]' name='jed6c'></td>";	
		echo "<td><input type='text' size = 5 value='$ra[jed6_lidi]' name='jed6l'></td>";
                echo "</tr>";	
                echo "<tr>";
		echo "<td><input type='text' value='$ra[jed7_nazev]' name='jed7'></td>";		
		echo "<td><input type='text' size = 20 value='$ra[jed7_ucinek]' name='jed7u'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed7_cena]' name='jed7c'></td>";	
		echo "<td><input type='text' size = 5 value='$ra[jed7_lidi]' name='jed7l'></td>";
                echo "</tr>";	
                echo "<tr>";
		echo "<td><input type='text' value='$ra[jed8_nazev]' name='jed8'></td>";		
		echo "<td><input type='text' size = 20 value='$ra[jed8_ucinek]' name='jed8u'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[jed8_cena]' name='jed8c'></td>";	
		echo "<td><input type='text' size = 5 value='$ra[jed8_lidi]' name='jed8l'></td>";
                echo "</tr>";	

		echo "<tr>";
		echo "</table>";

		echo "</table><br>";
	


		echo "<TABLE ".$table." ".$border.">";
		echo "<td><b><u>Nastavení výrobny:</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<tr>";
		echo "<th>název</th>";
		echo "<th>tìžba</th>";
		echo "<th>lidí</th>";
		echo "<th>cena</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' value='$ra[vyr_nazev]' name='vyn'></td>";		
		echo "<td><input type='text' size = 4 value='$ra[vyr_vyrob]' name='vyv'></td>";		
		echo "<td><input type='text' size = 6 value='$ra[vyr_lidi]' name='vyl'></td>";		
		echo "<td><input type='text' size = 4 value='$ra[vyr_cena]' name='vyc'></td>";		
		echo "</tr>";
		echo "</table>";
		
		echo "<b><u>Nastavení sdi:</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<th>název</th>";
		echo "<th>ucinek</th>";
		echo "<th>lidí</th>";
		echo "<th>cena</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' value='$ra[sdi_nazev]' name='sn'></td>";		
		echo "<td><input type='text' size = 4 value='$ra[sdi_ucinek]' name='sv'></td>";		
		echo "<td><input type='text' size = 6 value='$ra[sdi_lidi]' name='sl'></td>";		
		echo "<td><input type='text' size = 4 value='$ra[sdi_cena]' name='sc'></td>";		
		echo "</tr>";
		echo "</table></table></td>";
		echo "<td></td>";

		echo "<TABLE ".$table." ".$border.">";
		echo "<td><b><u>Nastavení policejni stanice:</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<tr>";
    echo "<th>název</th>";
    echo "<th>úèinek</th>";
		echo "<th>cena</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' size = 7 value='$ra[pol_nazev]' name='pon'></td>";
		echo "<td><input type='text' size = 5 value='$ra[pol_ucinek]' name='pou'></td>";		
		echo "<td><input type='text' size = 5 value='$ra[pol_cena]' name='poc'></td>";
		echo "</tr>";
		echo "</table></td>";
		echo "<td></td>";

    echo "<td><b><u>Nastavení mìst:</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<tr>";
    echo "<th>lidí</th>";
		echo "<th>cena</th>";
		echo "<th>budov</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' size = 7 value='$ra[mes_lidi]' name='ml'></td>";
    echo "<td><input type='text' size = 4 value='$ra[mes_cena]' name='mc'></td>";
    echo "<td><input type='text' size = 4 value='$ra[mest]' name='mm'></td>";		
		echo "</tr>";
		echo "</table></table><br></td>";
		echo "<td></td>";
		
		echo "<TABLE ".$table." ".$border.">";
		echo "<td><b><u>Nastavení kasáren:</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<tr>";
		echo "<th>míst</th>";
		echo "<th>cena</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' size = 6 value='$ra[kas_lidi]' name='kl'></td>";		
		echo "<td><input type='text' size = 6 value='$ra[kas_cena]' name='kc'></td>";
		echo "</tr>";
		echo "</table></td>";
		echo "<td></td>";

		echo "<td><b><u>Nastavení laboratoøí:</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<tr>";
		echo "<th>výzkum</th>";
		echo "<th>cena</th>";
		echo "<th>lidí</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' size = 4 value='$ra[lab_vyz]' name='lv'></td>";		
		echo "<td><input type='text' size = 4 value='$ra[lab_cena]' name='lc'></td>";
		echo "<td><input type='text' size = 6 value='$ra[lab_lidi]' name='ll'></td>";
		echo "</tr>";
		echo "</table></td>";
		echo "<td></td>";
		
		echo "<td><b><u>Nastavení parku:</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<tr>";
		echo "<th>název</th>";
		echo "<th>cena</th>";
		echo "<th>ucinek</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' size = 12 value='$ra[park_nazev]' name='pn'></td>";		
		echo "<td><input type='text' size = 6 value='$ra[park_cena]' name='pc'></td>";
		echo "<td><input type='text' size = 4 value='$ra[park_proc]' name='pp'></td>";
		echo "</tr>";
    echo "</table></td>";
    
		echo "<td><b><u>cena brány:</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<tr>";
		echo "<th>cena</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' size = 12 value='$ra[bra_cena]' name='bc'></td>";
		echo "</tr>";
    echo "</table></td></table>";



		echo "<TABLE ".$table." ".$border.">";
		echo "<td><b><u>Cena planety(*vyrobna):</b></u>";
		echo "<form action='hlavni.php?page=admin11' method='post'>";
		echo "<tr>";
		echo "<th>cena</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><input type='text' size = 12 value='$ra[planeta]' name='cpc'></td>";
		echo "</tr>";
    echo "</table><br>";

		echo "<tr>";
		echo "</table>";
		echo "<input type='hidden' name='rasa' value='$rasa'>";
		echo "<input type='hidden' name='zmena_armad' value='1'>";
		echo "<input type='submit' value='zmìò'>";
		echo "</form>";
	endif;
?>