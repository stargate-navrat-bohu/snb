<?	
	//require("adkontrola.php");
mysql_query("SET NAMES cp1250");
?>


<h3>Vytvoøení Centrální planety</h3>


<center><table border=1 width=50%>
	<tr>
	<th colspan=1><font color=white>Název planety</th>
	<th colspan=1><font color=white>Mìst</th>
	<th colspan=1><font color=white>Výroben</th>
	<th colspan=1><font color=white>Obyvatel</th>
	<th colspan=1><font color=white>Rasy</th>
	<th colspan=1><font color=white>Typ</th>
	<th colspan=1><font color=white>Vytvoøit CP</th>
	</tr>


	<tr>
	<form name='form1' method='post' action='hlavni.php?page=cp'>
	<th><input type='text' name="cp_naz" size=6></th>
	<th><input type='text' name='mest' value=500 size='1'></th>
	<th><input type='text' name='vyroben' value=55000 size='3'></th>
	<th><input type='text' name='obyvatel' value=5000000000 size='6'></th>
	<th>

		<select name='rasecp' class='select'>
		<?
	$cp_vytv = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa != 11 ORDER BY rasa ASC");
	while ($cp_vytv_1 = MySQL_Fetch_Array($cp_vytv)):
		echo "<option value = ".$cp_vytv_1[rasa].">".$cp_vytv_1["nazevrasy"];
	endwhile;
		?>
		</select></th>

	<th colspan=1><font color=white>

		<select name="typ" class='select'>
		<?
	$typpp = MySQL_Query("SELECT typ FROM typp");
	while ($typp = MySQL_Fetch_Array($typpp)):
		echo "<option>".$typp["typ"];
	endwhile;
		?>
    		</select></th>

		<input type='hidden' name='vytv_cp' value=1>
	<th colspan=1><font color=white><input type='submit' value='Vytvoøit' name=vytv_cp></form></th>
	</tr>
</table>


<br />


<h3>Seznam centrálních planet</h3>

<?




  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Název planety</th>";
	echo "<th colspan=1><font color=white>Èíslo planety</th>";
	echo "<th colspan=1><font color=white>Majitel jméno</th>";
	echo "<th colspan=1><font color=white>Majitel id</th>";
	echo "<th colspan=1><font color=white>Rasy</th>";
	echo "<th colspan=1><font color=white>Naposledy pøesunuta</th>";
	echo "<th colspan=1><font color=white>Zmìnit údaje</th>";
	echo "</tr>";



		$cp = MySQL_Query("SELECT * FROM planety where status='2' ORDER BY majitel DESC");


		while($cp_0 = MySQL_Fetch_Array($cp)){


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
echo "<th><input type='hidden' name=zmencp1 value=1><input type='submit' value='Zmìnit údaje' name=zmencp1></th>";
echo "</form></tr>";

}	

echo "</table>";


/*

  echo "<br /><br /><center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Název planety</th>";
	echo "<th colspan=1><font color=white>Typ planety</th>";
	echo "<th colspan=1><font color=white>Mìst</th>";
	echo "<th colspan=1><font color=white>Výroben</th>";
	echo "<th colspan=1><font color=white>Obyval</th>";
	echo "<th colspan=1><font color=white>Zmìnit údaje</th>";
	echo "<th colspan=1><font color=white>Smazat planetu</th>";
	echo "</tr>";




		$cp = MySQL_Query("SELECT * FROM planety where status='2' ORDER BY majitel DESC");
		while($cp_0 = MySQL_Fetch_Array($cp)){




echo "<tr><form name='form3' method='post' action='hlavni.php?page=cp'>";
echo "<th><input type='text' name='naz' value='".$cp_0[nazev]."' size='8'></th>";
echo "<th><input type='text' name='dr' value='".$cp_0['typ']."' size='8'></th>";
echo "<th><input type='text' name='mes' value='".$cp_0[mesta]."' size='8'></th>";
echo "<th><input type='text' name='vyr' value='".$cp_0[vyrobna]."' size='8'></th>";
echo "<th><input type='text' name='lid' value='".$cp_0[lidi]."' size='8'></th>";
echo "<input type='hidden' name='cislopl' value='".$cp_0[cislo]."'>";
echo "<th><input type='hidden' name=zmencp2 value=1><input type='submit' value='Zmìnit údaje' name=zmencp2></th>";

echo "<form name='form4' method='post' action='hlavni.php?page=cp'>";
echo "<input type='hidden' name='cislopla' value='".$cp_0[cislo]."'>";
echo "<th><input type='hidden' name=smazcp value=1><input type='submit' value='Smazat planetu' name=smazcp></th>";
echo "</form></tr>";

}	

echo "</table>";

*/


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
			MySQL_Query("insert into log (cil,admin,akce,konk,cilt,den) values ('9','$zacatek_1[jmeno]','vytvoøení CP','$cp','$nazavrasyprocp',$den)");

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

						
?>