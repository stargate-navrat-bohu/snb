<?
	require("adkontrola.php");
mysql_query("SET NAMES cp1250");
	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2 FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
?>

<center>

<h3>Kontrola U�ivatel�</h3>


<form name='form1' method='post' action='hlavni.php?page=kontr_uz'>
Zobrazit podrobnosti hr��e <? echo "<input type=text name='hrac_jm' value='nick hr��e' onclick='this.value=\"\";' /> / <input type=text name='hrac_cis' value='��slo hr��e' onclick='this.value=\"\";' />"; ?>
<input type=submit value="Zobrazit">
</form>

<form name='form1' method='post' action='hlavni.php?page=kontr_uz'>
Zobrazit podrobnosti hr��� rasy <select name='rasa' class='select'>
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

if($hrac["jmeno"]=="" and $hrac["cislo"]==""){ echo "<font class='text_cerveny'>Mus�te zadat jm�no nebo ��slo hr��e.</font>";exit; }

include "scripty/scr_uz_1.php";

			echo "<TABLE border='1' align=center>";
			echo "<form method='post' name='enter' action='hlavni.php?page=kontr_uz&hrac_jm=$hrac[jmeno]'>";

			echo "<tr>";
			echo "<th class=text_modry colspan = 2>Vybr�n hr�� ".$hrac["jmeno"]."</th>";
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
			<option value=1 >Hlavn� administr�tor
			<option value=2 >Z�stupce
			<option value=3 >P��b�h��
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
			echo "<th>Identifika�n� ��slo</th>";
			echo "<td>".$hrac["cislo"]."</td>";
			echo "</tr>";	

			echo "<tr>";
			echo "<th>zisk</th>";
			echo "<td> ".$vyroba." </td>";
			echo "</tr>";

			echo "<tr>";		
			echo "<th>v�k</th>";
			echo "<td>".Floor((Date("U")-$hrac["vek"])/86400)." dn�</td>";
			echo "</tr>";	

			echo "<tr>";
			echo "<th>penize</th>";
			echo "<td>".number_format($hrac["penize"],0,0," ")."</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>populace</th>";
			echo "<td>".number_format($hrac["populace"],0,0," ")." milion�</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>sila</th>";
			echo "<td>".number_format($hrac["sila"],0,0," ")." tis�c</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>mocnost</th>";
			echo "<td>".number_format(($hrac["populace"]*$hrac["sila"]*$hrac["planety"]*0.001),0,0," ")."</td>";		
			echo "</tr>";

			echo "<tr>";		
			echo "<th>po�et planet</th>";
			echo "<td>".$hrac["planety"]."</td>";
			echo "</tr>";

			echo "<tr>";		
			echo "<th>dnes dobyt</th>";
			echo "<td>".$hrac["dobyt"]." kr�t</td>";
			echo "</tr>";

			echo "<tr align=center>";	
			echo "<th>Prov�st zm�ny</th>";	
			echo "<td><input type=submit value='Prov�st zm�ny'></form></td>";
			echo "</tr>";

			echo "<tr align=center>";		
			echo "<th>Smazat hr��e</th>";
			echo "<form method='post' name='enter' action='hlavni.php?page=kontr_uz&hrac_jm=$hrac[jmeno]'>";
			echo "<input type='hidden' name=hracn value=$hrac[jmeno]>";
			echo "<input type='hidden' name=smaz value=$hrac[cislo]>";
			echo "<td><input type=submit value='Smazat hr��e'></form></td>";
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