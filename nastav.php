<?

// nastaveni avartu
  $adresar = "avatary/";	// adresar pro ukladani souboru (lomitko je dulezite!)
  $avart["sirka"] = 100;
  $avart["vyska"] = 100;
  $avart["size"] = 100; // maximalni velikost v kB

		require "data_1.php";

		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo='$logcislo'");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		$info2=1;
		require("kontrola.php");

if(isset($s)):
			
			$ss=$s;
			$s=md5($s);
			$n=md5($n);
			$nn_to_mail=$nn;
			$nn=md5($nn);
			if($zaznam1["heslo"]==$s):
				if($n==$nn):
					if(strlen($nn_to_mail)<=5){echo "<font class='text_cerveny'>Heslo musí mít aspoò 6 znakù</font>";}
				    	else {
							$email=$zaznam1[email];
							$zprava="Heslo v loginu $logjmeno zmìnìno na $nn_to_mail.";
							mail ($email,"Zmìna hesla na stargateweb",$zprava);
							MySQL_Query("update uzivatele set heslo = '$n' where cislo='$logcislo'");
							echo "<font class='text_cerveny'>Heslo zmìnìno</font>";}
				else:
					echo "<font class='text_cerveny'>Nová hesla nejsou stejná</font>";
				endif;
			else:
				echo "<font class='text_cerveny'>Staré heslo nesouhlasí</font>";
			endif;
		endif;
		
		if(isset($icq)):
			do{
				if( (!ereg("^[[:digit:]]{5,}$",$icq)) and ($icq!="")){echo "<font class='text_cerveny'>Je poadováno ICQ#</font>";};
				
				if(($zicq!="on") and ($zweb!="on") and ($zemail!="on")){$aa=1;};
				if(($zicq!="on") and ($zweb!="on") and ($zemail=="on")){$aa=2;};
				if(($zicq!="on") and ($zweb=="on") and ($zemail!="on")){$aa=3;};
				if(($zicq=="on") and ($zweb!="on") and ($zemail!="on")){$aa=4;};
				if(($zicq=="on") and ($zweb=="on") and ($zemail!="on")){$aa=5;};
				if(($zicq=="on") and ($zweb!="on") and ($zemail=="on")){$aa=6;};
				if(($zicq!="on") and ($zweb=="on") and ($zemail=="on")){$aa=7;};
				if(($zicq=="on") and ($zweb=="on") and ($zemail=="on")){$aa=8;};

				/*if(($zicq!="on") and ($zweb=="on")){$aa=2;};
				if(($zicq=="on") and ($zweb!="on")){$aa=1;};
				if(($zicq!="on") and ($zweb!="on")){$aa=0;};*/
				$icq=HTMLSpecialChars($icq);
				$icq=AddSlashes($icq);
				$web=HTMLSpecialChars($web);
				$web=AddSlashes($web);
				MySQL_Query("update uzivatele set zobrd=$aa,www='$web',icq='$icq' where cislo=$logcislo");
			}while(false);
		endif;

		if(isset($dnu)):
			$s=md5($heslodnu);
			if($zaznam1["heslo"]==$s):
				
				$ut2 = MySQL_Query("SELECT den,utocnik FROM utok where utocnik='$logjmeno' order by den DESC");
				do{
					$on=0;
					$ut = MySQL_Fetch_Array($ut2);
					if($ut[utocnik]!=$zaznam1[jmeno]){$ut=1;};
				}while($on);

				if(($ut[den]+1*3600)<Date("U")):
					$prach=$zaznam1[den]+(86400*$dnu);
					$kdy=Date("U")+($dnu*3600*24);

            if (($dnu<"1") || ($dnu>"50") ) die("<font class='text_cerveny'>O co se tu pokoušíte??? TOHLE NENÍ ÁDNİ BUGLAND!!!</font>");
					MySQL_Query("update uzivatele set hra=1,zmrazeni='$kdy',den='$prach' where cislo='$logcislo'");
					echo "<h1>Login zmraen</h1>";

				else:
					$utoc=Round((Date("U")-$ut[den])/60);
					$hod=Round((Date("U")-$ut[den])/3600);
					echo "<font class='text_cerveny'>Útoèil jste teprve pøed ".$hod." hodinami (".$utoc." minut).</font>";
				endif;

			else:
				echo "<font class='text_cerveny'>Špatné heslo</font>";
		endif;
			endif;


		if(isset($heslo)):
			$heslo=md5($heslo);
			
			$ut2 = MySQL_Query("SELECT den,utocnik FROM utok where utocnik='$logjmeno' order by den DESC");
			do{
				$on=0;
				$ut = MySQL_Fetch_Array($ut2);
				if($ut[utocnik]!=$zaznam1[jmeno]){$ut=1;};
			}while($on);

			if(($ut[den]+48*3600)<Date("U")):
				if($zaznam1["heslo"]==$heslo):
					if($zaznam1[koho]!=$zaznam1[jmeno]):
						//echo $zaznam1[koho];
						$kdo=$zaznam1[koho];
						$vys5 = MySQL_Query("SELECT jmeno,volen FROM uzivatele where jmeno = '$kdo'");
						$zaznam5 = MySQL_Fetch_Array($vys5);
						$kolik=$zaznam5[volen]-1;
						MySQL_Query("update uzivatele set volen = '$kolik' where jmeno = '$kdo'");
				        MySQL_Query("DELETE FROM uzivatele WHERE cislo='$logcislo'");
						MySQL_Query("DELETE FROM planety WHERE cislomaj = '$logcislo'");
						MySQL_Query("DELETE FROM mul WHERE jmeno='$zaznam1[jmeno]'");
						MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");	
						MySQL_Query("DELETE FROM multaci WHERE cislo='$logcislo'");
					else:
						MySQL_Query("DELETE FROM uzivatele WHERE cislo='$logcislo'");			
						MySQL_Query("DELETE FROM planety WHERE cislomaj = '$logcislo'");
						MySQL_Query("DELETE FROM mul WHERE jmeno='$zaznam1[jmeno]'");
						MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");		
						MySQL_Query("DELETE FROM multaci WHERE cislo=$logcislo");
					endif;

					// Odstraneni hlasovani v referendech - begin
					$kdo=$zaznam1[jmeno];
					$vys5 = MySQL_Query("SELECT ref,refn FROM uzivatele where jmeno = '$kdo'");
					$zaznam1 = MySQL_Fetch_Array($vys5);

					$refer = MySQL_Query("SELECT * FROM referendum where cislo ='0'");
					$ref = MySQL_Fetch_Array($refer);
				    if ($zaznam1[ref]==1) {
				      $aaa=$ref[ano]-1;
				      MySQL_Query("update referendum set ano = '$aaa' where cislo='0'");
				    } elseif ($zaznam1[ref]==2) {
				      $nnn=$ref[ne]-1;
				      MySQL_Query("update referendum set ne = '$nnn' where cislo='0'");
				    };
				
					$refer = MySQL_Query("SELECT * FROM referendum where cislo='$zaznam1[rasa]'");
					$ref = MySQL_Fetch_Array($refer);
				    if ($zaznam1[refn]==1) {
				      $aaa=$refn[ano]-1;
				      MySQL_Query("update referendum set ano = '$aaa' where cislo='$zaznam1[rasa]'");
				    } elseif ($zaznam1[refn]==2) {
				      $nnn=$refn[ne]-1;
				      MySQL_Query("update referendum set ne = '$nnn' where cislo='$zaznam1[rasa]'");
				    };	
					// Odstraneni hlasovani v referendech - end
			
						echo "<script languague='JavaScript'>alert('Login byl uspìšnì smazán, nyní se prosím odhlašte.')</script>";
						echo "<script languague='JavaScript'>location.href='info.php'</script>";
				else:
					echo "<font class='text_cerveny'>Špatné heslo</font>";
				endif;
			else:
				$utoc=Round((Date("U")-$ut[den])/60);
				$hod=Round((Date("U")-$ut[den])/3600);
				echo "<font class='text_cerveny'>Útoèil jste teprve pøed ".$hod." hodinami (".$utoc." minut).</font>";
			endif;						
		endif;

		if(isset($skin)):
				MySQL_Query("update uzivatele set skin = '$skin' where cislo > '0'");
				echo "<script language=JavaScript>location.href='hlavni.php?page=nastav';</script>";
		endif;	

		if(isset($smail)):
				MySQL_Query("update uzivatele set smail = '$smail' where cislo = $logcislo");
				echo "<script language=JavaScript>location.href='hlavni.php?page=nastav';</script>";
		endif;		

		if(isset($refresh)):
				MySQL_Query("update uzivatele set refresh = '$refresh' where cislo = $logcislo");
				echo "<script language=JavaScript>location.href='hlavni.php?page=nastav';</script>";
		endif;
		
				if(isset($novacek)):
				MySQL_Query("update uzivatele set statusnovacek = '$novs' where cislo = $logcislo");
				echo "<script language=JavaScript>location.href='hlavni.php?page=nastav';</script>";
		endif;
		
		if(isset($prepocet)):
			$heslo=md5($heslop);
			//echo "<script languague='JavaScript'>alert(1)</script>";
			if($zaznam1["heslo"]==$heslo):
				$h=Date("G");
				$m=Date("i");
				$se=Date("s");
				$sek=Date("U");
				$chci=$prepocet;
				$sek-=$m*60;
				$sek-=$se;
				$a=$h-$chci;
				$sek-=$a*3600;
				//$sek+=24*3600;
				//echo "<font class=text_bili>".$zaznam1[den]." zaznam1[den]<br>";
				//echo "<font class=text_bili>".$sek." sek<br>";
				//echo "<font class=text_bili>".($sek-Date("U"))." rozdil<br>";
				//echo "<font class=text_bili>".Date("H:i:s j.m.Y",$sek)." novdat<br>";
				//$datum2 = Date("H:i:s j.m.Y",$zaznam1[den]);
				//echo "<font class=text_bili>".$a." a<br>";
				MySQL_Query("update uzivatele set den = '$sek',prepocet='$prepocet' where cislo = '$logcislo'");
			else:
				echo "<font class='text_cerveny'>Špatné heslo</font>";
			endif;
		endif;



		if(isset($prepocet_voje)):
			$heslo=md5($heslop);
			//echo "<script languague='JavaScript'>alert(1)</script>";
			if($zaznam1["heslo"]==$heslo):
				$h=Date("G");
				$m=Date("i");
				$se=Date("s");
				$sek=Date("U");
				$chci=$prepocet_voje;
				$sek-=$m*60;
				$sek-=$se;
				$a=$h-$chci;
				$sek-=$a*3600;
				//$sek+=24*3600;
				//echo "<font class=text_bili>".$zaznam1[den]." zaznam1[den]<br>";
				//echo "<font class=text_bili>".$sek." sek<br>";
				//echo "<font class=text_bili>".($sek-Date("U"))." rozdil<br>";
				//echo "<font class=text_bili>".Date("H:i:s j.m.Y",$sek)." novdat<br>";
				//$datum2 = Date("H:i:s j.m.Y",$zaznam1[den]);
				//echo "<font class=text_bili>".$a." a<br>";
				MySQL_Query("update uzivatele set den = '$sek',prepocet_voj='$prepocet_voje' where cislo = '$logcislo'");
			else:
				echo "<font class='text_cerveny'>Špatné heslo</font>";
			endif;
		endif;


		$kodek=$zaznam1[kod];
		if(isset($reg_kod)):
				if($kodek==$reg_kod):
					MySQL_Query("update uzivatele set reg='1' where cislo = '$logcislo'");
					echo "<font class='text_cerveny'>Registrace dokonèena</font>";
					$kodek=0;
				else:
					echo "<font class='text_cerveny'>Špatnı registraèní kód</font>";
				endif;		
		endif;
		
	if(isset($duvod)):
			$text=HTMLSpecialChars($duvod);
			$text=NL2BR($text);
			$text=AddSlashes($text);	
			MySQL_Query("update multaci set duvod='$text' WHERE cislo='$logcislo'");	
	endif;

	$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo='$logcislo'");
	$zaznam1 = MySQL_Fetch_Array($vys1);
	
	$am2 = MySQL_Query("SELECT * FROM multaci where cislo='$logcislo'");
	$am = MySQL_Fetch_Array($am2);	

MySQL_Close($spojeni);

?>
<font class="text_bili">
<?
if($zaznam1[reg]==0):
?>
<h6><font class=text_modry>R</font>egistraèní kód</h6>
<form name="form" method="post" action="hlavni.php?page=nastav">
kód <input type="text" name="reg_kod">
<input type="submit" value="pošli">
</form>
<?
endif;
?>
<?
if($am[cislo]>0):
?>
<h6><font class=text_modry>M</font>uláctví</h6>
<form name="form" method="post" action="hlavni.php?page=nastav">
<font class=text_bili>Byl jste naøèen z muláctví, prosím smate své profily nebo jejich existenci oduvodnìte v tomto oknì.</font>
<br><textarea name="duvod" cols=60 rows=5><?echo $am[duvod]?></textarea><br>
<input type="submit" value="odešli">
</form>
<?
endif;
?>

<?
$novacek=$zaznam1[statusnovacek];
if($novacek!=0):
?>
<font class='text_bili'><font class=text_modry>S</font>tatus nováèek</font><br>
<font class='text_bili'>Zde máte monost zrušit status nováèek. Status vám bude odebrán po kliknutí na tlaèítko odebrat.</font>
<form name="form5" method="post" action="hlavni.php?page=nastav">
<input type=hidden value=1 name=novacek>
<input type=hidden value=0 name=novs>
<br>
<input type="submit" value="Odebrat">
<br><br>
</form>
<?
endif;
?>

<table>
<tr>
<td>
<font class=text_bili><font class=text_modry>Z</font>mìna hesla</font>
<form name="form2" method="post" action="hlavni.php?page=nastav">
<table>
<tr>
	<td><font class=text_bili>staré heslo</font></td>
	<td><input type="password" name="s"></td>
</tr><tr>
	<td><font class=text_bili>nové heslo</font></td>
	<td><input type="password" name="n"></td>
</tr><tr>
	<td><font class=text_bili>znovu nové heslo</font></td>
	<td><input type="password" name="nn"></td>
</tr><tr>
	<td colspan=2><input type="submit" value="Zmìnit"></td>
</tr>
</table>
</form>
</td>
<td>
<font class=text_bili><font class=text_modry>Z</font>rušení loginu</font>
<form name="form1" method="post" action="hlavni.php?page=nastav">
<font class=text_bili>Lze a za 48 hodinách po posledním útoku.</font><br><br>
<font class=text_bili>heslo </font><input type="password" name="heslo">
<br><br><input type="submit" value="Zrušit login">
</form>
</td>
</tr>
<tr>
<td>
<font class=text_bili><font class=text_modry>Z</font>mraení loginu</font>
<form name="form4" method="post" action="hlavni.php?page=nastav">
<font class=text_bili>Pokud je login zmraen, nelze za nìj hrát, nepøibıvá za ten èas co je loginu zmrazen naquadah, nelze na nìj útoèit. Login lze zmrazit pokud s nim 24 hodin nebylo útoèeno. Login lze zmrazit na 1 a 50 dní.<br><br>
<table>
<tr>
	<td><font class=text_bili>Zmrazit na kolik dní: </font></td>
	<td><input type="text" name="dnu"></td>
</tr>
<tr>
	<td><font class=text_bili>heslo</font></td>
	<td><input type="password" name="heslodnu"></td>
</tr>
<tr>
	<td colspan=2><input type="submit" value="Zmrazit"></td>
</tr>
</table>
</font>
</form>
</td>
<td>

<font class=text_bili><font class=text_modry>N</font>astavení pøepoètu</font>
<form name="form3" method="post" action="hlavni.php?page=nastav">
<font class=text_bili>Mùete si zmìnit èas vašeho pøepoètu. Pokud to udìláte další pøepoèet se provede nejdøíve za 24 hodin.<br><br>
<table>
<tr>
	<td><font class=text_bili>Ekonomickı pøepoèet: </font></td>
	<td><select name="prepocet">
<?
$i=0;
while($i<24):
	$ch="";
	//if($i==11){$ch="selected";};
	if($zaznam1[prepocet]==$i){$ch=" selected";};
	if($i<10):
		echo "<option".$ch.">0".$i;
	else:
		echo "<option".$ch.">".$i;
	endif;
	$i++;
endwhile;
?>
	</select></td>
</tr>
<?
//<tr>
//	<td><font class=text_bili>heslo</font></td>
//	<td><input type="password" name="heslop"></td>
//</tr>
//<tr>
//	<td colspan=2><input type="submit" value="Zmìnit"></td>
//</tr>
//*/

?>



<tr>
	<td><font class=text_bili>Vojenskı pøepoèet: </font></td>
	<td><select name="prepocet_voje">
<?
$i=0;
while($i<23 and $i>=0):
	$ch="";
	//if($i==11){$ch="selected";};
	if($zaznam1[prepocet_voj]==$i){$ch="selected";};
	if($i<10):
		echo "<option ".$ch.">0".$i;
	else:
		echo "<option ".$ch.">".$i;
	endif;
	$i++;
endwhile;
?>
	</select></td>
</tr>
<tr>
	<td><font class=text_bili>heslo</font></td>
	<td><input type="password" name="heslop"></td>
</tr>
<tr>
	<td colspan=2><input type="submit" value="Zmìnit"></td>
</tr>
</table>
</font>
</form>
</td>
</tr>
<tr>
<td>
<font class=text_bili><font class=text_modry>G</font>old a silver statusy</font><br>
<font class=text_bili>Vaše identifikaèní èíslo je <font class=text_cerveny><? echo" ".$zaznam1[cislo]." "; ?> </font><br>
Více o statusu gold a silver naleznete <a href='hlavni.php?page=help&sub=gold'>ZDE</a>
</font> <br> <br>
</form>


<font class=text_bili><font class=text_modry>A</font>vatar</font><br>
<?  
// ------------ zobrazeni avartu ----------------
$hrac_id = $logcislo;

if($avatar_del){
  if(file_exists($adresar.$hrac_id.".jpg")){ unlink($adresar.$hrac_id.".jpg"); }
  else if(file_exists($adresar.$hrac_id.".gif")){ unlink($adresar.$hrac_id.".gif"); }
  else if(file_exists($adresar.$hrac_id.".GIF")){ unlink($adresar.$hrac_id.".GIF"); }
  else if(file_exists($adresar.$hrac_id.".JPG")){ unlink($adresar.$hrac_id.".JPG"); }
  else{ "Obrázek ".$adresar.$hrac_id." neextistuje"; }
}

if($hrac_id !== 0){
  if(file_exists($adresar.$hrac_id.".jpg")){ $nazev_image = $hrac_id.".jpg"; }
  if(file_exists($adresar.$hrac_id.".gif")){ $nazev_image = $hrac_id.".gif"; }
  if($nazev_image){
    echo '<div style="float: left; margin: 10px; margin-right: 20px; text-align: center;"><img src="'.$adresar.$nazev_image.'" border=0><br><a href="hlavni.php?page=nastav&avatar_del=1">Smazat</a></div>';
  }
}

if($avart_ok==1){ echo "Soubor byl úspìšnì uploadnut na server"; }

?> 

<form action="avatar.php" method="post" enctype="multipart/form-data">
<input type="file" name="soubor" SIZE="15"><br>
<font size="1">Maximální velikost je <? echo $avart["size"]; ?> kB, rozmìr (100x100)</font><br> <br>
<input type="submit" name="send" VALUE="Pøidat soubor">
</form>


</td>
<td>
<?

switch($zaznam1["zobrd"]){
	case 1: break;
	case 2: $c="checked";
		break;
	case 3: $b="checked";
		break;
	case 4: $a="checked";
		break;				
	case 5: $a="checked";
			$b="checked";
			break;
	case 6: $a="checked";
			$c="checked";
			break;
	case 7: $b="checked";
			$c="checked";
			break;
	case 8: $a="checked";
			$b="checked";
			$c="checked";			
			break;									
};

?>



<font class=text_bili><font class=text_modry>D</font>etaily</font>
<form name="form6" method="post" action="hlavni.php?page=nastav">
<table>
<tr>
<td><font class=text_bili>ICQ</font></td>
<td><input type="text" name=icq value="<?echo $zaznam1[icq]?>"></td>
</tr>
<tr>
<td><font class=text_bili>web</font></td>
<td><input type="text" name=web value="<?echo $zaznam1[www]?>"></td>
</tr>
<tr>
<td rowspan=3><font class=text_bili>zobrazovat&nbsp;&nbsp;&nbsp;</font></td>
<td><input type="checkbox" <? echo $a;?> name=zicq> ICQ</td>
</tr>
<tr>
<td><input type="checkbox" <? echo $b;?> name=zweb> web</td>
</tr>
<tr>
<td><input type="checkbox" <? echo $c;?> name=zemail><font class=text_bili> email&nbsp;&nbsp;(<font class=text_modry><? echo $zaznam1[email];?></font>)</font></td>
</tr>
</table>
<input type="submit" value="Zmìnit">

</form>

<tr>
<td>
<!--
<font class=text_bili><font class=text_modry>Z</font>obrazování smailù</font>
<form name="form5" method="post" action="hlavni.php?page=nastav">
<select name="smail">
<option value=0 <?if($zaznam1[smail]==0){echo "selected";};?>>ano
<option value=1 <?if($zaznam1[smail]==1){echo "selected";};?>>ne
</select>
<input type="submit" value="Zmìnit">
</form>
</td>
<td>
<?
switch($zaznam1["zobrd"]){
	case 1: break;
	case 2: $c="checked";
		break;
	case 3: $b="checked";
		break;
	case 4: $a="checked";
		break;				
	case 5: $a="checked";
			$b="checked";
			break;
	case 6: $a="checked";
			$c="checked";
			break;
	case 7: $b="checked";
			$c="checked";
			break;
	case 8: $a="checked";
			$b="checked";
			$c="checked";			
			break;									
};
?>

<tr>
<td>
<font class=text_bili><font class=text_modry>N</font>astavení refresh sekce online vláda, adminé a aktuální síla.</font>
<form name="form5" method="post" action="hlavni.php?page=nastav">
<select name="refresh">
<option value=5 <?if($zaznam1[refresh]==5){echo "selected";};?>>5
<option value=10 <?if($zaznam1[refresh]==10){echo "selected";};?>>10
<option value=15 <?if($zaznam1[refresh]==15){echo "selected";};?>>15
<option value=20 <?if($zaznam1[refresh]==20){echo "selected";};?>>20
<option value=25 <?if($zaznam1[refresh]==25){echo "selected";};?>>25
<option value=30 <?if($zaznam1[refresh]==30){echo "selected";};?>>30
<option value=35 <?if($zaznam1[refresh]==35){echo "selected";};?>>35
<option value=8000000000 <?if($zaznam1[refresh]==8000000000){echo "selected";};?>>vypnout
</select>
<input type="submit" value="Zmìnit">
</form>
</td>
<td>
<?
switch($zaznam1["zobrd"]){
	case 1: break;
	case 2: $c="checked";
		break;
	case 3: $b="checked";
		break;
	case 4: $a="checked";
		break;				
	case 5: $a="checked";
			$b="checked";
			break;
	case 6: $a="checked";
			$c="checked";
			break;
	case 7: $b="checked";
			$c="checked";
			break;
	case 8: $a="checked";
			$b="checked";
			$c="checked";			
			break;									
};
?>
-->
</td>
</tr>
</table>

</font>
