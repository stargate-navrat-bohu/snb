<?php
require("adkontrola.php");
//mysql_query("SET NAMES cp1250");
$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,koho FROM uzivatele where cislo = '$logcislo'");
$zaznam1 = MySQL_Fetch_Array($vys1);
?>

<center>

<h3>Kontrola Rasov� Arm�dy</h3>


<form name='form1' method='post' action='hlavni.php?page=kontr_ra'>
Zobrazit RA rasy <select name='rasa' class='select'>
<?php
$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa < 11 order by rasa ASC");
while ($zaznam4 = MySQL_Fetch_Array($vys4)):
	echo "<option value = ".$zaznam4[rasa];
	if ($rasa==$zaznam4["rasa"]) {echo " selected";}
	echo ">".$zaznam4["nazevrasy"]."</option>";
endwhile;
?>
</select>
<input type=submit value="Zobrazit">
</form>

<form name='form1' method='post' action='hlavni.php?page=kontr_ra'>
Zobrazit RA všech ras
<input type=hidden name='ra_vsech' value='1'> <input type=submit value="Zobrazit">
</form>

<?php

	if(isset($rasa)):

		$ra1 = MySQL_Query("SELECT * FROM rasy where rasa = $rasa");
		$ra = MySQL_Fetch_Array($ra1);
		$vu1 = MySQL_Query("SELECT * FROM vudce where rasa = $rasa");
		$vu = MySQL_Fetch_Array($vu1);
		$rs1 = MySQL_Query("SELECT * FROM rasarm where rasa = $rasa");
		$rs = MySQL_Fetch_Array($rs1);		
		$refer = MySQL_Query("SELECT * FROM refnew where cislo='$rasa'");
		$ref = MySQL_Fetch_Array($refer);
		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa");
		$politika = MySQL_Fetch_Array($politika1);

		echo "<form action='hlavni.php?page=kontr_ra&rasa=$rasa' method='post'>";
		echo "<TABLE border='1' align=center>";
		echo "<tr>";
		echo "<th colspan=5>Rasov� arm�da rasy ".$ra[nazevrasy]."</th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Název jednotky</th>";
		echo "<th>Útok</th>";
		echo "<th>Obrana</th>";
		echo "<th>Počet jednotek v RA</th>";
		echo "<th>Cena/ks</th>";
		echo "</tr>";

		echo "<tr  align=center>";
		echo "<td class=text_modry>".$ra["jed1_nazev"]."</td>";		
		echo "<td><input type='text' value='".$ra["jed1_utok"]."' name='nove_ut_jed1' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed1_obrana"]."' name='nove_ob_jed1' size='8'></td>";
		echo "<td><input type='text' value='".$rs["jed1"]."' name='nove_jed1' size='8'></td>";	
		echo "<td><input type='text' value='".$ra["jed1_cena"]."' name='nove_jed1_cena' size='8'></td>";		
		echo "</tr>";

		echo "<tr  align=center>";
		echo "<td class=text_modry>".$ra["jed2_nazev"]."</td>";		
		echo "<td><input type='text' value='".$ra["jed2_utok"]."' name='nove_ut_jed2' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed2_obrana"]."' name='nove_ob_jed2' size='8'></td>";
		echo "<td><input type='text' value='".$rs["jed2"]."' name='nove_jed2' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed2_cena"]."' name='nove_jed2_cena' size='8'></td>";
		echo "</tr>";

		echo "<tr  align=center>";
		echo "<td class=text_modry>".$ra["jed4_nazev"]."</td>";		
		echo "<td><input type='text' value='".$ra["jed4_utok"]."' name='nove_ut_jed4' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed4_obrana"]."' name='nove_ob_jed4' size='8'></td>";
		echo "<td><input type='text' value='".$rs["jed4"]."' name='nove_jed4' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed4_cena"]."' name='nove_jed4_cena' size='8'></td>";
		echo "</tr>";

		echo "<tr  align=center>";
		echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";		
		echo "<td colspan=2><input type='text' value='".$ra["jed3_ucinek"]."' name='nove_ucin_jed3' size='24'></td>";
		echo "<td><input type='text' value='".$rs["jed3"]."' name='nove_jed3' size='8'></td>";	
		echo "<td><input type='text' value='".$ra["jed3_cena"]."' name='nove_jed3_cena' size='8'></td>";	
		echo "</tr>";
		
		echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti p�chot�</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed1"]."' name='nove_jed3_jed1' size='8'></td>";
      echo "<td class=text_modry>Proti univerz�lum:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed2"]."' name='nove_jed3_jed2' size='8'></td>";
    echo"</tr>";
    
   
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti ZHN:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed3"]."' name='nove_jed3_jed3' size='8'></td>";
      echo "<td class=text_modry>Proti orbit�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed4"]."' name='nove_jed3_jed4' size='8'></td>";
    echo"</tr>";
    
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti n�jemn�m vrah�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed5"]."' name='nove_jed3_jed5' size='8'></td>";
      echo "<td class=text_modry>Proti zlod�j�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed6"]."' name='nove_jed3_jed6' size='8'></td>";
    echo"</tr>";
    
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti agent�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed7"]."' name='nove_jed3_jed7' size='8'></td>";
      echo "<td class=text_modry>Proti populaci:</td>";
      echo "<td><input type='text' value='".$ra["jed3_pop"]."' name='nove_jed3_pop' size='8'></td>";
    echo"</tr>";
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti v�robn�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_vyrobna"]."' name='nove_jed3_vyrobna' size='8'></td>";
      echo "<td class=text_modry>Proti m�st�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_mesta"]."' name='nove_jed3_mesta' size='8'></td>";
    echo"</tr>";
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti kas�rn�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_kasarna"]."' name='nove_jed3_kasarna' size='8'></td>";
      echo "<td class=text_modry>Proti sdi:</td>";
      echo "<td><input type='text' value='".$ra["jed3_sdi"]."' name='nove_jed3_sdi' size='8'></td>";
    echo"</tr>";
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti laborato��m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_laborator"]."' name='nove_jed3_laborator' size='8'></td>";
      echo "<td class=text_modry>&nbsp;</td>";
      echo "<td>&nbsp;</td>";
    echo"</tr>";

		echo "<tr  align=center>";
		echo "<td class=text_modry>".$zold_nazev."</td>";
		echo "<td>".$zold_utok."</td>";
		echo "<td>".$zold_obrana."</td>";
		echo "<td><input type='text' value='".$rs["jed5"]."' name='nove_jed5' size='8'></td>";	
		echo "<td>---</td>";
		echo "</tr>";	

		echo "<input type='hidden' name='rasak' value='$rasa'>";
		echo "<input type='hidden' name='zmena_armad' value='1'>";

		echo "<tr  align=center>";
		echo "<td colspan=5><input type='submit' value='Zm�nit'></td>";
		echo "</tr>";
		echo "</form>";
		echo "<br />";
		echo "<hr>";

		echo "</table>";

	endif;	



	if(isset($ra_vsech)):

		$ra1 = MySQL_Query("SELECT * FROM rasy where rasa < 11 ORDER BY rasa ASC");
		while($ra = MySQL_Fetch_Array($ra1)){

		$rasa=$ra[rasa];

		$vu1 = MySQL_Query("SELECT * FROM vudce where rasa = $rasa");
		$vu = MySQL_Fetch_Array($vu1);
		$rs1 = MySQL_Query("SELECT * FROM rasarm where rasa = $rasa");
		$rs = MySQL_Fetch_Array($rs1);		
		$refer = MySQL_Query("SELECT * FROM refnew where cislo='$rasa'");
		$ref = MySQL_Fetch_Array($refer);
		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa");
		$politika = MySQL_Fetch_Array($politika1);			
			
		echo "<form action='hlavni.php?page=kontr_ra&rasa=$rasa' method='post'>";
		echo "<TABLE border='1' align=center>";
		echo "<tr>";
		echo "<th colspan=5>Rasov� arm�da rasy ".$ra[nazevrasy]."</th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Název jednotky</th>";
		echo "<th>Útok</th>";
		echo "<th>Obrana</th>";
		echo "<th>Počet jednotek v RA</th>";
		echo "<th>Cena/ks</th>";
		echo "</tr>";

		echo "<tr align=center>";
		echo "<td class=text_modry>".$ra["jed1_nazev"]."</td>";		
		echo "<td><input type='text' value='".$ra["jed1_utok"]."' name='nove_ut_jed1' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed1_obrana"]."' name='nove_ob_jed1' size='8'></td>";
		echo "<td><input type='text' value='".$rs["jed1"]."' name='nove_jed1' size='8'></td>";	
		echo "<td><input type='text' value='".$ra["jed1_cena"]."' name='nove_jed1_cena' size='8'></td>";		
		echo "</tr>";

		echo "<tr  align=center>";
		echo "<td class=text_modry>".$ra["jed2_nazev"]."</td>";		
		echo "<td><input type='text' value='".$ra["jed2_utok"]."' name='nove_ut_jed2' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed2_obrana"]."' name='nove_ob_jed2' size='8'></td>";
		echo "<td><input type='text' value='".$rs["jed2"]."' name='nove_jed2' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed2_cena"]."' name='nove_jed2_cena' size='8'></td>";
		echo "</tr>";

		echo "<tr align=center>";
		echo "<td class=text_modry>".$ra["jed4_nazev"]."</td>";		
		echo "<td><input type='text' value='".$ra["jed4_utok"]."' name='nove_ut_jed4' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed4_obrana"]."' name='nove_ob_jed4' size='8'></td>";
		echo "<td><input type='text' value='".$rs["jed4"]."' name='nove_jed4' size='8'></td>";
		echo "<td><input type='text' value='".$ra["jed4_cena"]."' name='nove_jed4_cena' size='8'></td>";
		echo "</tr>";

		echo "<tr  align=center>";
		echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";		
		echo "<td colspan=2><input type='text' value='".$ra["jed3_ucinek"]."' name='nove_ucin_jed3' size='24'></td>";
		echo "<td><input type='text' value='".$rs["jed3"]."' name='nove_jed3' size='8'></td>";	
		echo "<td><input type='text' value='".$ra["jed3_cena"]."' name='nove_jed3_cena' size='8'></td>";	
		echo "</tr>";
		
		echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti p�chot�</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed1"]."' name='nove_jed3_jed1' size='8'></td>";
      echo "<td class=text_modry>Proti univerz�lum:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed2"]."' name='nove_jed3_jed2' size='8'></td>";
    echo"</tr>";
    
   
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti ZHN:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed3"]."' name='nove_jed3_jed3' size='8'></td>";
      echo "<td class=text_modry>Proti orbit�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed4"]."' name='nove_jed3_jed4' size='8'></td>";
    echo"</tr>";
    
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti n�jemn�m vrah�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed5"]."' name='nove_jed3_jed5' size='8'></td>";
      echo "<td class=text_modry>Proti zlod�j�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed6"]."' name='nove_jed3_jed6' size='8'></td>";
    echo"</tr>";
    
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti agent�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_jed7"]."' name='nove_jed3_jed7' size='8'></td>";
      echo "<td class=text_modry>Proti populaci:</td>";
      echo "<td><input type='text' value='".$ra["jed3_pop"]."' name='nove_jed3_pop' size='8'></td>";
    echo"</tr>";
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti v�robn�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_vyrobna"]."' name='nove_jed3_vyrobna' size='8'></td>";
      echo "<td class=text_modry>Proti m�st�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_mesta"]."' name='nove_jed3_mesta' size='8'></td>";
    echo"</tr>";
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti kas�rn�m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_kasarna"]."' name='nove_jed3_kasarna' size='8'></td>";
      echo "<td class=text_modry>Proti sdi:</td>";
      echo "<td><input type='text' value='".$ra["jed3_sdi"]."' name='nove_jed3_sdi' size='8'></td>";
    echo"</tr>";
    
    echo "<tr align=center>";
      echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";
      echo "<td class=text_modry>Proti laborato��m:</td>";
      echo "<td><input type='text' value='".$ra["jed3_laborator"]."' name='nove_jed3_laborator' size='8'></td>";
      echo "<td class=text_modry>&nbsp;</td>";
      echo "<td>&nbsp;</td>";
    echo"</tr>";

		echo "<tr  align=center>";
		echo "<td class=text_modry>".$zold_nazev."</td>";
		echo "<td>".$zold_utok."</td>";
		echo "<td>".$zold_obrana."</td>";
		echo "<td><input type='text' value='".$rs["jed5"]."' name='nove_jed5' size='8'></td>";	
		echo "<td>---</td>";
		echo "</tr>";	

		echo "<input type='hidden' name='rasak' value='$rasa'>";
		echo "<input type='hidden' name='zmena_armad' value='1'>";

		echo "<tr  align=center>";
		echo "<td colspan=5><input type='submit' value='Zm�nit'></td>";
		echo "</tr>";
		echo "</form>";
		echo "<br />";
		echo "<hr>";

}

    echo "</table>";

endif;	



if(isset($zmena_armad)):	
    MySQL_Query("update rasarm set jed1=$nove_jed1,jed2=$nove_jed2,jed3=$nove_jed3,jed4=$nove_jed4,jed5=$nove_jed5 WHERE rasa = $rasak");
    MySQL_Query("update rasy set jed1_utok=$nove_ut_jed1,jed2_utok=$nove_ut_jed2,jed3_ucinek='$nove_ucin_jed3',jed3_jed1=".$_POST["nove_jed3_jed1"].", jed3_jed2=".$_POST["nove_jed3_jed2"].",
                   jed3_jed3=".$_POST["nove_jed3_jed3"].",jed3_jed4=".$_POST["nove_jed3_jed4"].",jed3_jed5=".$_POST["nove_jed3_jed5"].", jed3_jed6=".$_POST["nove_jed3_jed6"].",jed3_jed7=".$_POST["nove_jed3_jed7"].",
                   jed3_pop=".$_POST["nove_jed3_pop"].",jed3_vyrobna=".$_POST["nove_jed3_vyrobna"].",jed3_mesta=".$_POST["nove_jed3_mesta"].",jed3_kasarna=".$_POST["nove_jed3_kasarna"].",jed3_sdi=".$_POST["nove_jed3_kasarna"].",
                   jed3_sdi=".$_POST["nove_jed3_sdi"].",jed3_laborator=".$_POST["nove_jed3_laborator"].",
                   jed4_utok=$nove_ut_jed4,jed1_obrana=$nove_ob_jed1,jed2_obrana=$nove_ob_jed2,jed4_obrana=$nove_ob_jed4 WHERE rasa = $rasak");

    echo "<script languague='JavaScript'>location.href='hlavni.php?page=kontr_ra&amp;rasa=$rasa'</script>";

endif;	
