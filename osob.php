<?
Header ("Cache control: no-cache");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
mysql_query("SET NAMES cp1250");
			require 'data_1.php';	
	
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		$info=1;
		$adre=$zaznam1["img"];
if($smi){
MySQL_Query("UPDATE uzivatele SET smiles='$smile' WHERE jmeno='".$logjmeno."'");
}

		$sm=$zaznam1[smiles];
		require("kontrola.php");

		$styl="styl".$zaznam1[skin];
		if($zaznam1[skin]==1 or $zaznam1[skin]==2 or $zaznam1[skin]==3 or $zaznam1[skin]==4){$styl="styl1";};
?>
<style type="text/css">
@import url(<?echo $styl?>.css);
</style>
</head>
<body>
<?
//upload obrazku
if(isset($picture))
{
	$chyba=0;
	
	//kontrola velikosti
	if($picture_size>"5120")
	{
		echo "<h1>Maximální velikost obrázku je 5kB!</h1>";
		$chyba=1;
	}
	
	//kontrola typu souboru
	if($picture_type=="image/gif")
		$pripona=".gif";
	elseif($picture_type=="image/jpeg")
		$pripona=".jpeg";
	elseif($picture_type=="image/pjpeg")
		$pripona=".jpg";
	else
	{
		echo "<h1>Nepodporovanı formát souboru</h1>";
		$chyba=1;
	}
	//vlastni upload
	if($chyba == "0")
	{
		if($adre!="0.jpg"){
		$adres="obrazky/$adre";
		@unlink($adres);
		}
		$obrazek="".$logcislo."".$pripona."";
		$adresa="obrazky/$obrazek";
		move_uploaded_file($picture, $adresa);
		mysql_query("update uzivatele set img='".$obrazek."' where jmeno='".$logjmeno."'");
		echo "<font class=pozor>Obrázek byl úspìšnì nahrán<br></font>";
	}
}

if($nova_zru){
mysql_query("update uzivatele set novacek='0' where jmeno='$logjmeno'");
}


if(isset($s)):
			
			$ss=$s;
			$s=md5($s);
			$n=md5($n);
			$nn_to_mail=$nn;
			$nn=md5($nn);
			if($zaznam1["heslo"]==$s):
				if($n==$nn):
					if(strlen($nn_to_mail)<=5){echo "<h1>Heslo musí mít aspoò 6 znakù</h1>";}
				    	else {
							$email=$zaznam1[email];
							$zprava="Heslo v loginu $logjmeno zmìnìno na $nn_to_mail.";
							mail ($email,"Zmìna hesla na stargateweb",$zprava);
							MySQL_Query("update uzivatele set heslo = '$n' where cislo=$logcislo");
							echo "<h1>Heslo zmìnìno</h1>";}
				else:
					echo "<h1>Nová hesla nejsou stejná</h1>";
				endif;
			else:
				echo "<h1>Staré heslo nesouhlasí</h1>";
			endif;
		endif;
		
		if(isset($icq)):
			do{
				if( (!ereg("^[[:digit:]]{5,}$",$icq)) and ($icq!="")){echo "<h1>Je poadováno ICQ#</h1>";};
				
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
				$mesto=HTMLSpecialChars($mesto);
				$mesto=AddSlashes($mesto);
				$web=HTMLSpecialChars($web);
				$web=AddSlashes($web);
				MySQL_Query("update uzivatele set zobrd=$aa,www='$web',icq='$icq',mesto='$mesto' where cislo=$logcislo");
			}while(false);
		endif;

		if(isset($dnu)):
			$s=md5($heslodnu);
		do{
      if($dnu<1){echo "<h1>Minimální doba zmraení je 1 den!</h1>";break;};
			if($zaznam1["heslo"]==$s):
				
				$ut2 = MySQL_Query("SELECT den,utocnik FROM utok where utocnik='$logjmeno' order by den DESC");
				do{
					$on=0;
					$ut = MySQL_Fetch_Array($ut2);
					if($ut[utocnik]!=$zaznam1[jmeno]){$ut=1;};
				}while($on);

				if(($ut[den]+24*3600)<Date("U")):
					$prach=$zaznam1[den]+(86400*$dnu);
					$kdy=Date("U")+($dnu*3600*24);
					MySQL_Query("update uzivatele set hra=1,zmrazeni=$kdy,den=$prach where cislo=$logcislo");
					echo "<h1>Login zmraen</h1>";
				else:
					$utoc=Round((Date("U")-$ut[den])/60);
					$hod=Round((Date("U")-$ut[den])/3600);
					echo "<h1>Útoèil jste teprve pøed ".$hod." hodinami (".$utoc." minut).</h1>";
				endif;
			else:
				echo "<h1>Špatné heslo</h1>";
			endif;
			}while(false);
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
						MySQL_Query("update uzivatele set volen = $kolik where jmeno = '$kdo'");
						MySQL_Query("update uzivatele set koho='' where koho='$logjmeno'");
		        MySQL_Query("DELETE FROM uzivatele WHERE cislo=$logcislo");
						MySQL_Query("update planety set cislomaj=0,poslpredani=0 where cislomaj='$logcislo' and status=2");
						MySQL_Query("DELETE FROM planety WHERE cislomaj = $logcislo");
						MySQL_Query("DELETE FROM mul WHERE jmeno='$zaznam1[jmeno]'");
						MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");	
						MySQL_Query("DELETE FROM obchodmesta WHERE prodavajici='$logjmeno'");		
						MySQL_Query("DELETE FROM sazky WHERE jmeno='$logjmeno'");
						MySQL_Query("DELETE FROM multaci WHERE cislo=$logcislo");
						if($adre!="0.jpg"){
						$adres="obrazky/$adre";
						@unlink($adres);};
					else:
						MySQL_Query("DELETE FROM uzivatele WHERE cislo=$logcislo");			
						MySQL_Query("update uzivatele set koho='' where koho='$logjmeno'");
						MySQL_Query("update planety set cislomaj=0,poslpredani=0 where cislomaj='$logcislo' and status=2");
						MySQL_Query("DELETE FROM planety WHERE cislomaj = $logcislo");
						MySQL_Query("DELETE FROM mul WHERE jmeno='$zaznam1[jmeno]'");
						MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");		
						MySQL_Query("DELETE FROM obchodmesta WHERE prodavajici='$logjmeno'");		
						MySQL_Query("DELETE FROM multaci WHERE cislo=$logcislo");
						MySQL_Query("DELETE FROM sazky WHERE jmeno='$logjmeno'");
						if($adre!="0.jpg"){
						$adres="obrazky/$adre";
						@unlink($adres);}
					endif;

					// Odstraneni hlasovani v referendech - begin
					$kdo=$zaznam1[jmeno];
					$vys5 = MySQL_Query("SELECT ref,refn FROM uzivatele where jmeno = '$kdo'");
					$zaznam1 = MySQL_Fetch_Array($vys5);

					$refer = MySQL_Query("SELECT * FROM referendum where cislo = 0");
					$ref = MySQL_Fetch_Array($refer);
				    if ($zaznam1[ref]==1) {
				      $aaa=$ref[ano]-1;
				      MySQL_Query("update referendum set ano = $aaa where cislo=0");
				    } elseif ($zaznam1[ref]==2) {
				      $nnn=$ref[ne]-1;
				      MySQL_Query("update referendum set ne = $nnn where cislo=0");
				    };
				
					$refer = MySQL_Query("SELECT * FROM referendum where cislo=$zaznam1[rasa]");
					$ref = MySQL_Fetch_Array($refer);
				    if ($zaznam1[refn]==1) {
				      $aaa=$refn[ano]-1;
				      MySQL_Query("update referendum set ano = $aaa where cislo=$zaznam1[rasa]");
				    } elseif ($zaznam1[refn]==2) {
				      $nnn=$refn[ne]-1;
				      MySQL_Query("update referendum set ne = $nnn where cislo=$zaznam1[rasa]");
				    };	
					// Odstraneni hlasovani v referendech - end
			
						echo "<script languague='JavaScript'>alert('Odhlášení probìhlo úspìšnì, nyní se prosím odhlašte.Není to však nutné, staèí zavøít okno.')</script>";
						echo "<script languague='JavaScript'>location.href='info.php'</script>";
				else:
					echo "<h1>Špatné heslo</h1>";
				endif;
			else:
				$utoc=Round((Date("U")-$ut[den])/60);
				$hod=Round((Date("U")-$ut[den])/3600);
				echo "<h1>Útoèil jste teprve pøed ".$hod." hodinami (".$utoc." minut).</h1>";
			endif;						
		endif;

		if(isset($skin)):
		if($skin==1){echo "<h1>Neplatné zadání!</h1>";exit;}
				MySQL_Query("update uzivatele set skin = '$skin' where cislo = $logcislo");
				echo "<script language=JavaScript>location.href='info.php';</script>";
		endif;		
		
		if(isset($prepocet)):
			do{
			$heslo=md5($heslop);
				$ted=Date("U");
				$ted-=86400;
			if($zaznam1[zmenavojpre]>$ted){echo "<h1>Zmìnu lze provést 24 hodin po pøedchozí zmìnì</h1>";break;}
			if($zaznam1["heslo"]==$heslo):
				$h=Date("G");
				$m=Date("i");
				$se=Date("s");
				$sek=Date("U");
				$zmenavojpre=$sek;
				$chci=$prepocet;
				$sek-=$m*60;
				$sek-=$se;
				$a=$h-$chci;
				$sek-=$a*3600;
				//$sek+=24*3600;
				//echo "<font class=info>".$zaznam1[den]." zaznam1[den]<br>";
				//echo "<font class=info>".$sek." sek<br>";
				//echo "<font class=info>".($sek-Date("U"))." rozdil<br>";
				//echo "<font class=info>".Date("H:i:s j.m.Y",$sek)." novdat<br>";
				//$datum2 = Date("H:i:s j.m.Y",$zaznam1[den]);
				//echo "<font class=info>".$a." a<br>";
				MySQL_Query("update uzivatele set zmenavojpre=$zmenavojpre,den=$sek,prepocet=$prepocet,restutoky=$vojprepocet where cislo = $logcislo");
			else:
				echo "<h1>Špatné heslo</h1>";
			endif;
			}while(false);
	endif;
		$kodek=$zaznam1[kod];
		if(isset($reg_kod)):
				if($kodek==$reg_kod):
					MySQL_Query("update uzivatele set reg=1 where cislo = $logcislo");
					echo "<h1>Registrace dokonèena</h1>";
					$kodek=0;
				else:
					echo "<h1>Špatnı registraèní kód</h1>";
				endif;		
		endif;
		
	if(isset($duvod)):
			$text=HTMLSpecialChars($duvod);
			$text=NL2BR($text);
			$text=AddSlashes($text);	
			MySQL_Query("update multaci set duvod='$text' WHERE cislo=$logcislo");	
	endif;

	$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
	$zaznam1 = MySQL_Fetch_Array($vys1);
	
	$am2 = MySQL_Query("SELECT * FROM multaci where cislo=$logcislo");
	$am = MySQL_Fetch_Array($am2);	


?>
<font class="info">
<?
if($zaznam1[reg]==0):
?>
<h6><font class=kapital>R</font>egistraèní kód</h6>
<form name="form" method="post" action="osob.php">
kód <input type="text" name="reg_kod">
<input type="submit" value="pošli">
</form>
<?
endif;
?>
<?
if($am[cislo]>0):
?>
<h6><font class=kapital>M</font>uláctví</h6>
<form name="form" method="post" action="osob.php">
<font class=info>Byl jste naøèen z muláctví, prosím smate své profily nebo jejich existenci oduvodnìte v tomto oknì.</font>
<br><textarea name="duvod" cols=60 rows=5><?echo $am[duvod]?></textarea><br>
<input type="submit" value="odešli">
</form>
<?
endif;
if($zaznam1[novacek]==1){echo "Myslíte-li si, e jste ji se hrou øádnì seznámen a chcete se stát bìnım hráèem, mùete si odebrat status nováèka zde: <form action=osob.php method=post><input type=submit value=odebrat name=nova_zru></form>";}
?>
<table>
<tr>
<td>
<h6><font class=kapital>Z</font>mìna hesla</h6>
<form name="form2" method="post" action="osob.php">
<table>
<tr>
	<td>staré heslo</td>
	<td><input type="password" name="s"></td>
</tr><tr>
	<td>nové heslo</td>
	<td><input type="password" name="n"></td>
</tr><tr>
	<td>znovu nové heslo</td>
	<td><input type="password" name="nn"></td>
</tr><tr>
	<td colspan=2><input type="submit" value="zmìò heslo"></td>
</tr>
</table>
</form>
</td>
<td>
<h6><font class=kapital>Z</font>rušení loginu</h6>
<form name="form1" method="post" action="osob.php">
<font class=info>Lze a za 48 hodinách po posledním útoku.</font><br><br>
heslo <input type="password" name="heslo">
<br><br><input type="submit" value="zruš login">
</form>
</td>
</tr>
<tr>
<td>
<h6><font class=kapital>Z</font>mraení loginu</h6>
<form name="form4" method="post" action="osob.php">
<font class=info>Pokud je login zmraen, nelze za nìj hrát, nepøibıvá za ten èas co je loginu zmrazen naquadah, nelze na nìj útoèit. Login lze zmrazit pokud s nim 24 hodin nebylo útoèeno.<br><br>
<table>
<tr>
	<td>Zmrazit na kolik dní: </td>
	<td><input type="text" name="dnu"></td>
</tr>
<tr>
	<td>heslo</td>
	<td><input type="password" name="heslodnu"></td>
</tr>
<tr>
	<td colspan=2><input type="submit" value="zmra login"></td>
</tr>
</table>
</font>
</form>
</td>
<td>
<h6><font class=kapital>N</font>astavení pøepoètu</h6>
<form name="form3" method="post" action="osob.php">
<font class=info>Mùete si zmìnit èas vašeho pøepoètu. Pokud to udìláte další pøepoèet se provede nejdøíve za 24 hodin. Zmìna jakéhokoliv pøepoètu ovlivní i druhı pøepoèet. Je umonìna pouze jedna zmìna za 24 hodin.<br><br>
<table>
<tr>
	<td>Pøepoèet v: </td>
	<td><select name="prepocet">
<?
$i=0;
while($i<24):
	$ch="";
	//if($i==11){$ch="selected";};
	if($zaznam1[prepocet]==$i){$ch="selected";};
	if($i<10):
		echo "<option ".$ch.">0".$i;
	else:
		echo "<option ".$ch.">".$i;
	endif;
	$i++;
endwhile;
?>
	</select></td>
<tr>
	<td>Voj. pøepoèet v: </td>
	<td><select name="vojprepocet">
<?
$j=0;
while($j<24):
	$ch="";
	//if($i==11){$ch="selected";};
	if($zaznam1[restutoky]==$j){$ch="selected";};
	if($j<10):
		echo "<option ".$ch.">0".$j;
	else:
		echo "<option ".$ch.">".$j;
	endif;
	$j++;
endwhile;
?>
	</select></td>
</tr>
<tr>
	<td>heslo</td>
	<td><input type="password" name="heslop"></td>
</tr>
<tr>
	<td colspan=2><input type="submit" value="zmìò pøepoèet"></td>
</tr>
</table>
</font>
</form>
</td>
</tr>
<tr>
<td>
</form>
<h6><font class=kapital>Z</font>mìna skinu.</h6>
<font class=info>Pro naètení všech obrázkù, zmáèknìte po odeslání stránky F5</font><br>
<form name="form5" method="post" action="osob.php">
<select name="skin">
<option value=0 <?if($zaznam1[skin]==0){echo "selected";};?>>základní

</select>
<input type="submit" value="zmìò">
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
<h6><font class=kapital>D</font>etaily.</h6>
<form name="form6" method="post" action="osob.php">
<table>
<tr>
<td>ICQ</td>
<td><input type="text" name=icq value="<?echo $zaznam1[icq]?>"></td>
</tr>
<tr>
<td>web</td>
<td><input type="text" name=web value="<?echo $zaznam1[www]?>"></td>
</tr>
<tr>
<td>Mìsto</td>
<td><input type="text" name=mesto value="<?echo $zaznam1[mesto]?>"></td>
</tr>
<tr>
<td rowspan=3>zobrazovat&nbsp;&nbsp;&nbsp;</td>
<td><input type="checkbox" <? echo $a;?> name=zicq> ICQ</td>
</tr>
<tr>
<td><input type="checkbox" <? echo $b;?> name=zweb> web</td>
</tr>
<tr>
<td><input type="checkbox" <? echo $c;?> name=zemail> email&nbsp;&nbsp;(<font class=pole><? echo $zaznam1[email];?></font>)</td>
</tr>
</table>
<input type="submit" value="zmìò">

</form>

</td>
</tr>
<tr><td>
<h6><font class=kapital>S</font>miles</h6>
<font class=info>Zaškrknuté políèko znamená, e smiles jsou zapnuty.</font>
<form action=osob.php method=post>Smiles: <input type="checkbox" name="smile" value="1" <? if($sm=="1"){ echo "checked";} ?>> <input type="submit" value="zmìò" name="smi"></form></td></tr>
</table>

</font>


</body>
</html>
