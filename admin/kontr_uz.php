<?
	require("adkontrola.php");
mysql_query("SET NAMES cp1250");
	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2 FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
?>

<center>

<h3>Kontrola Uživatelù</h3>


<form name='form1' method='post' action='hlavni.php?page=kontr_uz'>
Zobrazit podrobnosti hráèe <? echo "<input type=text name='hrac_jm' value='nick hráèe' onclick='this.value=\"\";' /> / <input type=text name='hrac_cis' value='èíslo hráèe' onclick='this.value=\"\";' />"; ?>
<input type=submit value="Zobrazit">
</form>

<form name='form1' method='post' action='hlavni.php?page=kontr_uz'>
Zobrazit podrobnosti hráèù rasy <select name='rasa' class='select'>
<?
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



<?



	if(isset($hrac_jm) or ($hrac_cis)):

	$hrac_1 = MySQL_Query("SELECT * FROM uzivatele where (cislo = '$hrac_cis' or jmeno = '$hrac_jm' )");	
	$hrac = MySQL_Fetch_Array($hrac_1);	

if($hrac["jmeno"]=="" and $hrac["cislo"]==""){ echo "<font class='text_cerveny'>Musíte zadat jméno nebo èíslo hráèe.</font>";exit; }

include "scripty/scr_uz_1.php";

			echo "<TABLE border='1' align=center>";
			echo "<form method='post' name='enter' action='hlavni.php?page=kontr_uz&hrac_jm=$hrac[jmeno]'>";

			echo "<tr>";
			echo "<th class=text_modry colspan = 2>Vybrán hráè ".$hrac["jmeno"]."</th>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>rasa</th>";

                echo "<td><select name='hrac_rasa' class='select'>";
			$hr_vytv = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa < 20 ORDER BY rasa ASC");
			while ($hr_vytv_1 = MySQL_Fetch_Array($hr_vytv)):
		echo "<option value = ".$hrac[rasa].">".$zaznam_ras["nazevrasy"];
		echo "<option value = ".$hr_vytv_1[rasa].">".$hr_vytv_1["nazevrasy"];
			endwhile;

		echo "</select></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>status</th>";
			echo "<td>".$status."</td>";
			echo "</tr>";


			echo "<tr>";
			echo "<th>Extra statusy</th>";

                echo "<td><select name='hrac_status_e' class='select'>";
			$stats_e = MySQL_Query("SELECT gold,silver,statusextra FROM uzivatele where cislo = $hrac[cislo]");
			$stats_e_1 = MySQL_Fetch_Array($stats_e);
		echo "<option value = 0>".$statse_m;
		echo "<option value = 0>gold ";
		echo "<option value = 0>silver ";
		echo "<option value = 0>extra status ";
		echo "</select></td>";
			echo "</tr>";

			echo "<tr>";
			
			$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,admin FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);
	
			echo "<th>admin</th>";
			
			if($zaznam1["admin"]==1){
			echo "<td>

				<select name='admin' class='select'>
    
			<option value='".$hrac[admin]."' >".$funkce."
			<option value=1 >Hlavní administrátor
			<option value=2 >Zástupce
			<option value=3 >Pøíbìháø
			<option value=4 >Kontrolor
			<option value=0 >Odebrat pravomoce

				</select></td>";
        }
			
			else
			{
			 echo "<td>".$funkce."</td>";
      }
			echo "<input type='hidden' name=kdo value=$hrac[jmeno]>";
			echo "</tr>";

			echo "<tr>";		
			echo "<th>Identifikaèní èíslo</th>";
			echo "<td>".$hrac["cislo"]."</td>";
			echo "</tr>";	

			echo "<tr>";
			echo "<th>zisk</th>";
			echo "<td> ".$vyroba." </td>";
			echo "</tr>";

			echo "<tr>";		
			echo "<th>vìk</th>";
			echo "<td>".Floor((Date("U")-$hrac["vek"])/86400)." dní</td>";
			echo "</tr>";	

			echo "<tr>";
			echo "<th>penize</th>";
			echo "<td>".number_format($hrac["penize"],0,0," ")."</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>populace</th>";
			echo "<td>".number_format($hrac["populace"],0,0," ")." milionù</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>sila</th>";
			echo "<td>".number_format($hrac["sila"],0,0," ")." tisíc</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>mocnost</th>";
			echo "<td>".number_format(($hrac["populace"]*$hrac["sila"]*$hrac["planety"]*0.001),0,0," ")."</td>";		
			echo "</tr>";

			echo "<tr>";		
			echo "<th>poèet planet</th>";
			echo "<td>".$hrac["planety"]."</td>";
			echo "</tr>";

			echo "<tr>";		
			echo "<th>dnes dobyt</th>";
			echo "<td>".$hrac["dobyt"]." krát</td>";
			echo "</tr>";

			echo "<tr align=center>";	
			echo "<th>Provést zmìny</th>";	
			echo "<td><input type=submit value='Provést zmìny'></form></td>";
			echo "</tr>";

			echo "<tr align=center>";		
			echo "<th>Smazat hráèe</th>";
			echo "<form method='post' name='enter' action='hlavni.php?page=kontr_uz&hrac_jm=$hrac[jmeno]'>";
			echo "<input type='hidden' name=hracn value=$hrac[jmeno]>";
			echo "<input type='hidden' name=smaz value=$hrac[cislo]>";
			echo "<td><input type=submit value='Smazat hráèe'></form></td>";
			echo "</form>";
			echo "</tr>";

			echo "</table>";

	endif;



	if(isset($l)):	
		
		MySQL_Query("update rasarm set jed1=$nove_jed1 WHERE rasa = $");

		MySQL_Query("update rasy set jed1_utok=$nove_ut_jed1 WHERE rasa = $");

		echo "<script languague='JavaScript'>location.href='hlavni.php?page=kontr_uz&=$'</script>";

	endif;	
	
?>