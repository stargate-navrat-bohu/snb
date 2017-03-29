<?php
//mysql_query("SET NAMES cp1250");
echo Date("d.m.Y G:i","1182021569");
$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,koho FROM uzivatele where cislo = '$logcislo'");	
$zaznam1 = MySQL_Fetch_Array($vys1);	

require("adkontrola.php");

if(isset($_POST["clean"]) AND $_POST["clean"]=="ano"){
    $ted =  Date("U");
    $kdy = $ted - 345600;
    $sql = "UPDATE `uzivatele` SET `rasa` = '98', `koho` = 'Neplatne' WHERE (planety = 1 OR planety = 0) AND den < $kdy AND rasa != 98 AND zmrazeni = 0 AND admin = 0";
    $sql_proc = mysql_query($sql) or die("chyba");
}
	
	if(isset($smaz)):
		@$zk = MySQL_Query("SELECT * FROM forum where den = $smaz");
		@$zkou = MySQL_Fetch_Array($zk);
		MySQL_Query("DELETE from forum WHERE den = $smaz");
	endif;	
	
	if(isset($zmena_armad)):			
		MySQL_Query("update rasarm set jed1=$nove_jed1,jed2=$nove_jed2,jed3=$nove_jed3,jed4=$nove_jed4,jed5=$nove_jed5 WHERE rasa = $rasa");
		$pro_log="Jed1: " . $jed1_puv . ">" . "$nove_jed1" . "; Jed2: " . $jed2_puv . ">" . "$nove_jed2" . "; Jed3: " . $jed3_puv . ">" . "$nove_jed3" . "; Jed4: " . $jed4_puv . ">" . "$nove_jed4" . "; Jed5: " . $jed5_puv . ">" . "$nove_jed5" . "; "; 
		$den = Date("U");
		MySQL_Query("INSERT INTO log (den,cil,akce,admin,konk) VALUES ($den,'$rasa','6','$zaznam1[jmeno]','$pro_log')");
	endif;	

	if(isset($stat)):
		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa");
		$politika = MySQL_Fetch_Array($politika1);		
			
		$stara=$politika[status];
		$vyzkum=$politika[vyzkum];
		$obrana=$politika[obrana];
		$utok=$politika[utok];
		$spokojenost=$politika[spokojenost];
		$cenat=$politika[cenat];
		$dent=$politika[dent];
		$cena3j=$politika[cena3j];

		switch($stara){
			case 1: $vyzkum=$politika[vyzkum]-5;
				$obrana=$politika[obrana]-10;
				$spokojenost=$politika[spokojenost]-10;
				$cenat=$politika[cenat]-25;
				break;
			case 2:	break;
			case 3:	$utok=$politika[utok]-15;
				$cena3j=$politika[cena3j]+40;
				$spokojenost=$politika[spokojenost]+15;											
				$dent=$politika[dent]+10;
				break;
			}
		MySQL_Query("update politika set vyzkum=$vyzkum,obrana=$obrana,utok=$utok,spokojenost=$spokojenost where rasa=$rasa");
		MySQL_Query("update politika set cenat=$cenat,cena3j=$cena3j,dent=$dent where rasa=$rasa");

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa");
		$politika = MySQL_Fetch_Array($politika1);

		$vyzkum=$politika[vyzkum];
		$obrana=$politika[obrana];
		$utok=$politika[utok];
		$spokojenost=$politika[spokojenost];
		$cenat=$politika[cenat];
		$dent=$politika[dent];
		$cena3j=$politika[cena3j];
		//echo $stat;
		switch($stat){
			case 1: $vyzkum=$politika[vyzkum]+5;
				$obrana=$politika[obrana]+10;
				$spokojenost=$politika[spokojenost]+10;
				$cenat=$politika[cenat]+25;
				break;
			case 2:	break;
			case 3:	$utok=$politika[utok]+15;
				$cena3j=$politika[cena3j]-40;
				$spokojenost=$politika[spokojenost]-15;											
				$dent=$politika[dent]-10;
				break;
			}
		MySQL_Query("update politika set vyzkum=$vyzkum,obrana=$obrana,utok=$utok,spokojenost=$spokojenost where rasa=$rasa");
		MySQL_Query("update politika set cenat=$cenat,cena3j=$cena3j,dent=$dent,status=$stat where rasa=$rasa");
		MySQL_Query("update rasy set status=$stat where rasa=$rasa");
	endif;
	
	$styl="styl".$zaznam1[skin];
	if($zaznam1[skin]==1 or $zaznam1[skin]==2 or $zaznam1[skin]==3 or $zaznam1[skin]==4){$styl="styl1";};

?>
<style type="text/css">
@import url(<?echo $styl?>.css);
</style>
<script language="JavaScript" src="a.php" >
</script>
</head>
<body>
</center>
<font class=text_bili>

<form method='post' action='hlavni.php?page=admin5'>
  Vyhod� 5 dn� neaktivn� hra�e s 1 planetou
  <input type='hidden' name='clean' value='ano'>
  <input type='submit' value='Vy�isti rasy'>
</form><br /><br /><br />

<form name='form1' method='post' action='hlavni.php?page=admin5'>
Vyber rasu <select name='rasa'>
<?
$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa>0 and rasa<100 order by rasa");
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
		$vu1 = MySQL_Query("SELECT * FROM vudce where rasa = $rasa");
		$vu = MySQL_Fetch_Array($vu1);
		$rs1 = MySQL_Query("SELECT * FROM rasarm where rasa = $rasa");
		$rs = MySQL_Fetch_Array($rs1);		
		$refer = MySQL_Query("SELECT * FROM refnew where cislo='$rasa'");
		$ref = MySQL_Fetch_Array($refer);
		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa");
		$politika = MySQL_Fetch_Array($politika1);			
			
		echo "<h6>Rasov� arm�da</h6>";
		echo "<form action='hlavni.php?page=admin5' method='post'>";
		echo "<TABLE ".$table." ".$border.">";
		echo "<tr>";
		echo "<th>n�zev</th>";
		echo "<th>�tok/obrana</th>";
		echo "<th>je v arm�d�</th>";
		echo "<th>nov� stav</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$ra["jed1_nazev"]."</td>";		
		echo "<td>".$ra["jed1_utok"]."/".$ra["jed1_obrana"]."</td>";
		echo "<td>".$rs["jed1"]."</td>";
		echo "<td><input type='text' value='".$rs["jed1"]."' name='nove_jed1'></td>";		
		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$ra["jed2_nazev"]."</td>";		
		echo "<td>".$ra["jed2_utok"]."/".$ra["jed2_obrana"]."</td>";
		echo "<td>".$rs["jed2"]."</td>";
		echo "<td><input type='text' value='".$rs["jed2"]."' name='nove_jed2'></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$ra["jed4_nazev"]."</td>";		
		echo "<td>".$ra["jed4_utok"]."/".$ra["jed4_obrana"]."</td>";
		echo "<td>".$rs["jed4"]."</td>";
		echo "<td><input type='text' value='".$rs["jed4"]."' name='nove_jed4'></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$ra["jed3_nazev"]."</td>";		
		echo "<td>".$ra["jed3_ucinek"]."</td>";
		echo "<td>".$rs["jed3"]."</td>";
		echo "<td><input type='text' value='".$rs["jed3"]."' name='nove_jed3'></td>";		
		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$zold_nazev."</td>";
		echo "<td>".$zold_utok."/".$zold_obrana."</td>";
		echo "<td>".$rs["jed5"]."</td>";
		echo "<td><input type='text' value='".$rs["jed5"]."' name='nove_jed5'></td>";		
		echo "</tr>";
		echo "</table>";
		echo "<input type='hidden' name='rasa' value='$rasa'>";
		echo "<input type='hidden' name='zmena_armad' value='1'>";
		echo "<input type='hidden' name='jed1_puv' value='$rs[jed1]'>";
		echo "<input type='hidden' name='jed2_puv' value='$rs[jed2]'>";
		echo "<input type='hidden' name='jed3_puv' value='$rs[jed3]'>";
		echo "<input type='hidden' name='jed4_puv' value='$rs[jed4]'>";
		echo "<input type='hidden' name='jed5_puv' value='$rs[jed5]'>";				
		echo "<input type='submit' value='zm��'>";
		echo "</form>";
		echo "<h6>Referendum</h6>";
	echo "<h6><font class=text_modry>N</font>�rodn� referendum.</h6><font class='text_bili'>";
	echo "Ot�zka zn�: <font class=text_modry>".$ref[otazka]."</font><br>";
	echo "Zat�m odpov�d�lo: <font class=text_modry>";
	echo $poc1+$poc2+$poc3 . " / " . $hhh;
	if ($hhh!=0) {echo " (". Round(($poc1+$poc2+$poc3)/$hhh*100) ."%)</font>";};
	echo "<br>Pro <font class=text_modry>" .$ref[odpoved1]. "</font> zat�m hlasovalo: <font class=text_modry>" .$poc1. " ";
	if (($poc1+$poc25+$poc3)!=0) echo " (". Round($poc1/($poc1+$poc2+$poc3)*100) ."%)<br>";
	echo "</font>Pro <font class=text_modry>".$ref[odpoved2]."</font> zat�m hlasovalo: <font class=text_modry>".$poc2." ";
	if (($poc1+$poc2+$poc3)!=0) echo " (". Round($poc2/($poc1+$poc2+$poc3)*100) ."%)<br>";
	echo "</font>Pro <font class=text_modry>".$ref[odpoved3]."</font> zat�m hlasovalo: <font class=text_modry>".$poc3." ";
	if (($poc1+$poc2+$poc3)!=0) echo " (". Round($poc3/($poc1+$poc2+$poc3)*100) ."%)";
	echo "</font>";
	if($zaznam55[refn]<"1"){
	echo "<form method='post' action='hlavni.php?page=ref'>";
	echo "<input type='radio' name='nar' value='1'"; if($zaznam55[refn]=="1"){echo " checked";}echo " > ".$ref[odpoved1]." &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='2'"; if($zaznam55[refn]=="2"){echo " checked";}echo " > ".$ref[odpoved2]."  &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='3'"; if($zaznam55[refn]=="3"){echo " checked";}echo " > ".$ref[odpoved3]." ";
	echo "</form>";
	}else{
	echo "<br>Vy jste hlasoval pro: <font class=text_modry>"; if($zaznam55[refn]=="1"){echo "".$ref[odpoved1]."";}elseif($zaznam55[refn]=="2"){echo "".$ref[odpoved2]."";}elseif($zaznam55[refn]=="3"){echo "".$ref[odpoved3]."";}echo "</font><br>";
	}
	echo "V�sledek minul�ho referenda: <font class=text_modry>".stripslashes($ref[vysledek])."</font></font>";
		
		echo "<h6>Fond</h6>";
		echo "Ve fondu je: <font class=text_modry>".number_format($vu[fond],0,0," ")."</font><br>";

		echo "<h6>Tabulka hlas�</h6>";
		echo "<table border='1'>";
		echo "<tr>";
		echo "<td>po�ad�</td>";
		echo "<td>jm�no</td>";
		echo "<td>hlas�</td>";
		echo "</tr>";

		$vys1 = MySQL_Query("SELECT jmeno,volen,status,cislo FROM uzivatele where (rasa = $rasa and status!=5) ORDER BY volen DESC");
		$x=1;
		while($zaznam1=MySQL_Fetch_Array($vys1)):
			echo "<tr>";
			echo "<td>".$x."</td>";
			echo "<td>".$zaznam1["jmeno"]."</td>";
			echo "<td>".$zaznam1["volen"]."</td>";
			echo "</tr>";
			$j=$zaznam1["cislo"];
			$r=$rasa;
/*			if($x==1):
			    MySQL_Query("update vudce set vudce = '$zaznam1[jmeno]' where rasa = '$r'");
				MySQL_Query("update uzivatele set status = 1 where cislo=$j");
   			elseif($x==2):
				MySQL_Query("update vudce set zastupce = '$zaznam1[jmeno]' where rasa = '$r'");
				MySQL_Query("update uzivatele set status = 2 where cislo=$j");
        	elseif($zaznam1["status"]==4):
				MySQL_Query("update uzivatele set status = 4 where jmeno = '$j'");
    		elseif($zaznam1["status"]==5):
				MySQL_Query("update uzivatele set status = 5 where jmeno = '$j'");
			else:
				MySQL_Query("update uzivatele set status = 0 where jmeno = '$j'");
			endif; */
			$x++;
			if($x==20){break;};
		endwhile;

	echo "</table>";

?>
<form name='form' method='post' action='hlavni.php?page=admin5'>
<?
echo "<br><h6><font class=text_modry>Ch</font>ov�n� rasy</h6>";

$s1=$s2=$s3=0;
switch($politika[status]){
		case 1:	$s1="checked";
			$co="dobr�";
			$pm="+10% obrana,+10% spokojenost,+5%v�zkum,+25% cena t�ebn� budovy";
			break;
		case 2:	$s2="checked";
			$co="neutr�ln�";
			$pm="nic dobr�ho ani zl�ho";
			break;
		case 3:	$s3="checked";
			$co="zl�";
			$pm="+15% �tok,-40% cena 3.jednotky,-15 spokojenost,-10% denn� t�by";
			break;
		}

		echo "<font class=text_bili><input type=radio name=stat value=1 ".$s1."> Dobr� ";
		echo "<input type=radio name=stat value=2 ".$s2."> Neutr�l ";
		echo "<input type=radio name=stat value=3 ".$s3."> Zl� ";
		echo "<input type=hidden name=rasa value='$rasa'>";;
		echo "<br><input type=submit value='Zm��'></font>";
/*
?>
</form>

<TABLE <? echo $table." ".$border; ?> align=center>
<tr>
<th colspan=2>Chov�n�</th>
</tr>
<tr>
<td class=text_modry>Dobr�</td>
<td>+10% obrana,+10% spokojenost,+5%v�zkum,+25% cena t�ebn� budovy</td>
</tr>
<tr>
<td class=text_modry>Neutr�l</td>
<td>nic dobr�ho ani zl�ho</td>
</tr>
<tr>
<td class=text_modry>Zl�</td>
<td>+15% �tok,-40% cena 3.jednotky,-15 spokojenost,-10% denn� t�by</td>
</tr>
</table>
</center>
<?	
*/
	endif;
MySQL_Close($spojeni);		
?>
<body bgcolor="bbbbbb">


</body>
</html>
