<?php
//require("adkontrola.php");
//mysql_query("SET NAMES cp1250");
?>

<h3>Vytvořené Centrální planety</h3>

<center><table border=1 width=50%>
	<tr>
	<th colspan=1><font color=white>N�zev planety</th>
	<th colspan=1><font color=white>M�st</th>
	<th colspan=1><font color=white>V�roben</th>
	<th colspan=1><font color=white>Obyvatel</th>
	<th colspan=1><font color=white>Rasy</th>
	<th colspan=1><font color=white>Typ</th>
	<th colspan=1><font color=white>Vytvo�it CP</th>
	</tr>


	<tr>
	<form name='form1' method='post' action='hlavni.php?page=cp'>
	<th><input type='text' name="cp_naz" size=6></th>
	<th><input type='text' name='mest' value=500 size='1'></th>
	<th><input type='text' name='vyroben' value=55000 size='3'></th>
	<th><input type='text' name='obyvatel' value=5000000000 size='6'></th>
	<th>

		<select name='rasecp' class='select'>
		<?php
$cp_vytv = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa != 11 ORDER BY rasa ASC");
while ($cp_vytv_1 = MySQL_Fetch_Array($cp_vytv)):
    echo "<option value = ".$cp_vytv_1[rasa].">".$cp_vytv_1["nazevrasy"];
endwhile;
		?>
		</select></th>

	<th colspan=1><font color=white>

		<select name="typ" class='select'>
		<?php
$typpp = MySQL_Query("SELECT typ FROM typp");
while ($typp = MySQL_Fetch_Array($typpp)):
    echo "<option>".$typp["typ"];
endwhile;
		?>
    		</select></th>

		<input type='hidden' name='vytv_cp' value=1>
	<th colspan=1><font color=white><input type='submit' value='Vytvo�it' name=vytv_cp></form></th>
	</tr>
</table>


<br />


<h3>Seznam centr�ln�ch planet</h3>

<?php
echo "<center><table border=1 width=50%>";
echo "<tr>";
echo "<th colspan=1><font color=white>N�zev planety</th>";
echo "<th colspan=1><font color=white>��slo planety</th>";
echo "<th colspan=1><font color=white>Majitel jm�no</th>";
echo "<th colspan=1><font color=white>Majitel id</th>";
echo "<th colspan=1><font color=white>Rasy</th>";
echo "<th colspan=1><font color=white>Naposledy p�esunuta</th>";
echo "<th colspan=1><font color=white>Zm�nit �daje</th>";
echo "</tr>";

$cp = MySQL_Query("SELECT * FROM planety where status='2' ORDER BY majitel DESC");

while($cp_0 = MySQL_Fetch_Array($cp)) {
    $cislomaj=$cp_0[cislomaj];
    $cp3 = MySQL_Query("SELECT jmeno FROM uzivatele where cislo=$cislomaj");
    $cp2 = MySQL_Fetch_Array($cp3);
    $majitel=$cp2[jmeno];

    echo "<tr><form name='form2' method='post' action='hlavni.php?page=cp'>";
    echo "<th><input type='text' name='naz' value='".$cp_0[nazev]."' size='8'></th>";
    echo "<th><input type='text' name='cis' value='".$cp_0[cislo]."' size='8'></th>";
    echo "<th>".$majitel."</th>";
    echo "<th><input type='text' name='cism' value='".$cp_0[cislomaj]."' size='8'></th>";
    echo "<th><input type='text' name='maj' value='".$cp_0[majitel]."' size='8'></th>";
    echo "<th><input type='text' name='pr' value='".$cp_0[presun]."' size='8'></th>";
    echo "<input type='hidden' name='cislopl' value='".$cp_0[cislo]."'>";
    echo "<th><input type='hidden' name=zmencp1 value=1><input type='submit' value='Zm�nit �daje' name=zmencp1></th>";
    echo "</form></tr>";
}	

echo "</table>";

if(isset($vytv_cp)):

    $zacatek = MySQL_Query("SELECT jmeno,heslo,cislo FROM uzivatele where cislo = '$logcislo'");	
    $zacatek_1 = MySQL_Fetch_Array($zacatek);

    $vys3 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa=$rasecp");	
    $zaznam3 = MySQL_Fetch_Array($vys3);

    $vys5 = MySQL_Query("SELECT cislo,status FROM uzivatele where (rasa=$rasecp and status=1) ");	
    $zaznam5 = MySQL_Fetch_Array($vys5);			

    $cp_vytv = MySQL_Query("SELECT cislo,cp FROM servis where cislo=1");	
    $cp_vytv_1 = MySQL_Fetch_Array($cp_vytv);

    $nazavrasyprocp=addslashes($zaznam3[nazevrasy]);
    $lidi=$obyvatel;
    $mesta=$mest;
    $vyrobna=$vyroben;
    $den = Date("U");
    $cislo=$zaznam5[cislo];
    $typ="$typ";

    MySQL_Query("insert into planety (cislo,nazev,majitel,cislomaj,lidi,mesta,vyrobna,typ,status) values($cp_vytv_1[cp],'$cp_naz','$nazavrasyprocp',$cislo,$lidi,$mesta,$vyrobna,'$typ',2)");	
    MySQL_Query("insert into log (cil,admin,akce,konk,cilt,den) values ('9','$zacatek_1[jmeno]','vytvo�en� CP','$cp','$nazavrasyprocp',$den)");

    $c=$cp_vytv_1[cp]+1;
    MySQL_Query("update servis set cp = $c where cislo=1");

     echo "<script languague='JavaScript'>location.href='hlavni.php?page=cp'</script>";

endif;


if(isset($zmencp1)): 
    MySQL_Query("update planety set nazev='$naz', cislo='$cis', cislomaj='$cism', majitel='$maj', presun='$pr' where cislo='$cislopl'");
    echo "<script languague='JavaScript'>location.href='hlavni.php?page=cp'</script>";	
endif;



if(isset($zmencp2)): 	
    MySQL_Query("update planety set nazev='$naz', typ='$dr', mesta='$mes', vyrobna='$vyr', lidi='$lid' where cislo='$cislopl'");	
    echo "<script languague='JavaScript'>location.href='hlavni.php?page=cp'</script>";
endif;


if(isset($smazcp)): 	
    MySQL_Query("DELETE from planety WHERE cislo='$cislopla'");	
    echo "<script languague='JavaScript'>location.href='hlavni.php?page=cp'</script>";
endif;
