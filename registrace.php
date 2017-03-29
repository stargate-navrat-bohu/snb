<?php
require "data_1.php";
// Systém nových uživatelů start

$ip = $REMOTE_ADDR;

$privedeno_1 = MySQL_Query("SELECT ip,registr FROM privedeno where ip='$ip' ");
$privedeno_a = MySQL_Fetch_Array($privedeno_1);


if ($privedeno_a[registr] == 0 and $privedeno_a[ip] != "") {

	$privedeno_0 = MySQL_Query("SELECT kym FROM privedeno where ip='$ip' ");
	$privedeno_b = MySQL_Fetch_Array($privedeno_0);

	$kdo = $privedeno_b[kym];

	$privedeno_0 = MySQL_Query("SELECT privedeno FROM uzivatele where cislo='$kdo' ");
	$privedeno = MySQL_Fetch_Array($privedeno_0);

	$nove_c = $privedeno[privedeno] + 2;
	$date_p = Date("U");

	MySQL_Query("update uzivatele set privedeno=$nove_c where cislo='$kdo'");
	MySQL_Query("update privedeno set registr=1 where ip='$ip'");

	echo "";
} else {
	echo "";
}

// Systém nových uživatelů konec


$restart = 0;

if ($restart == 1) {
	echo "<font class=text_cerveny>Probíhá restart hry...</font><br /><br />";
	exit;
}

$vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
$hhh = mysql_num_rows($vys5);
$celkuzi = $hhh;

$pocetras = 8;

$pru = round($celkuzi / $pocetras);
$prumuzi = $pru - round($pru / 10);

$pompr = ($prumuzi / 10) + 2;

$konstrozdil = round($pompr);

function kont($co, $cim) {
	if ($co == $cim) {
		echo "checked";
	}
}

function kont2($co, $cim) {
	if ($co == $cim) {
		echo "selected";
	}
}

$vys1 = MySQL_Query("SELECT * FROM rasy where rasa!=0");
$uziv = MySQL_Query("SELECT jmeno FROM uzivatele");
if ($uziv):
	$h = mysql_num_rows($uziv);
	if ($h >= 1500):
		echo "<center><font class='pozor'>Maximální počet všech profilů je 1500. Tato hranice je už dosáhnuta, lituji.</font></center>";
		exit;
	endif;
endif;

$i = 1;
$rasa2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa<($pocetras+1) and rasa>0) order by rasa");
$udaju = mysql_num_rows($rasa2);
for ($cislo = 0; $cislo < $udaju; $cislo++) {
	$rasn[$cislo] = mysql_result($rasa2, $cislo, "nazev");
	$j[$cislo] = mysql_result($rasa2, $cislo, "nazev");
}

// narodnosti
$bonusy[1] = "žádné klady";
$negativy[1] = "žádné zápory";
$bonusy[2] = "-20% cena těžebny";
$negativy[2] = "-10 útok, +10% cena pěchoty";
$bonusy[3] = "-15% ceny v obchodě, +5% výzkum";
$negativy[3] = "+30% cena těžebny";
$bonusy[4] = "-25% cena pěchoty, -5% ceny ZHN";
$negativy[4] = "-20% spokojenost, +20% ceny v obchodě";
$bonusy[5] = "+20% spokojenost, +10% obrana";
$negativy[5] = "+20% cena pěchoty, +100% ceny ZHN";
$bonusy[6] = "+30% na výzkum";
$negativy[6] = "-15% útok, +100% ceny ZHN";
$bonusy[7] = "+25% obrana";
$negativy[7] = "+15% cena pěchoty, -10% útok";
$bonusy[8] = "+10% spokojenost, +10% na v�zkum";
$negativy[8] = "+50% cena těžebny, +100% ceny ZHN";
$bonusy[9] = "-25% cena těžebny";
$negativy[9] = "-20% �tok";
$nazvy[1] = "Neutrální";
$nazvy[2] = "Rozvoj";
$nazvy[3] = "Obchodník";
$nazvy[4] = "Zbrojíř";
$nazvy[5] = "Mír";
$nazvy[6] = "Věda";
$nazvy[7] = "Obránci";
$nazvy[8] = "Vyspělost";
$nazvy[9] = "Stavaři";

// statni zrizeni
$bonusy1[1] = "žádné klady";
$negativy1[1] = "žádné zápory";
$bonusy1[2] = "+10% spokojenost";
$negativy1[2] = "-20% útok";
$bonusy1[3] = "-20% cena bojových jednotek";
$negativy1[3] = "-15% spokojenost, +10% cena těžebny";
$bonusy1[4] = "+25% útok, -10% cena ZHN";
$negativy1[4] = "-25% spokojenost, -10% obrana";
$bonusy1[5] = "+25% na výzkum";
$negativy1[5] = "-10% útok, nemožnost budovat ZHN";
$bonusy1[6] = "+50% obrana, -20% cena ZHN";
$negativy1[6] = "-25% útok";
$bonusy1[7] = "-25% cena těžebny";
$negativy1[7] = "-10% útok";
$bonusy1[8] = "-30% cena planety";
$negativy1[8] = "-5% útok, +10% cena bojových jednotek";
$bonusy1[9] = "-50% cena ZHN";
$negativy1[9] = "-50% spokojenost";
$nazvy1[1] = "Neutrální";
$nazvy1[2] = "Mírové";
$nazvy1[3] = "Zbrojní";
$nazvy1[4] = "útočné";
$nazvy1[5] = "Výzkum";
$nazvy1[6] = "Obranný";
$nazvy1[7] = "Těžební";
$nazvy1[8] = "Kolonizační";
$nazvy1[9] = "Ničitel";

$rasa_a = $_POST["rasa1"];
if ($rasa_a != "") {
	$ko_reg_sql = mysql_query("SELECT registrace FROM rasy WHERE rasa = '$rasa_a'");
	$ko_reg = mysql_fetch_array($ko_reg_sql);
	$ko_registrace = $ko_reg["registrace"];
}
if ($ko_registrace == "true") {
	if ($uziv):
		$h = mysql_num_rows($uziv);
		if ($h >= 20000):
			echo "<center><font class='text_cerveny'>Maximální počet všech profilů je 20000. Tato hranice je už dosáhnuta, lituji.</font></center>";
			exit;
		endif;
	endif;
	$spatne = 0;
	if (isset($jmeno1)):
		do {
			/* if ($_POST['potvr_kod'] != $_SESSION["kod"]) {
			  echo "<font class='text_cerveny'>Potvrzovací kod byl špatně zadán</font>";
			  break;
			  } */
			$jmeno1 = HTMLSpecialChars(AddSlashes($jmeno1));
			$email = HTMLSpecialChars(AddSlashes($email));
			$dom = HTMLSpecialChars(AddSlashes($dom));
			//	$voj=HTMLSpecialChars(AddSlashes($voj));
			$icq = HTMLSpecialChars($icq);
			$icq = AddSlashes($icq);
			//echo "<font class='text_cerveny'>s".$icq;
			$web = HTMLSpecialChars($web);
			$web = AddSlashes($web);
			$rekl = HTMLSpecialChars($rekl);
			$rekl = AddSlashes($rekl);
			if ($pohl != 1 and $pohl != 2) {
				$pohl = 1;
			}; //echo $pohl;exit;
			if ($odkud != 1 and $odkud != 2 and $odkud != 3) {
				$odkud = 1;
			};
			if ($statusnovacek != 1) {
				$statusnovacek = 0;
			};
			if ($souhlasim != 1) {
				echo "<font class='text_cerveny'>Pro dokončení registrace je nutné souhlasit s pravidly hry.</font>";
				break;
			};
			if ($stat < 1 or $nar < 1 or $nar > 9 or $stat > 9) {
				echo "<font class='text_cerveny'>Neplatné zadání národu nebo zřízení.</font>";
				break;
			};
			if ($rasa1 < 1 or $rasa1 > 10) {
				echo "<font class='text_cerveny'>Za tuto rasu se nesmíte zaregistrovat</font>";
				break;
			};
			if ((!(ereg("^[[:digit:]]{5,}$", $icq))) and $icq != "") {
				echo "<font class='text_cerveny'>Je požadováno ICQ#</font>";
				break;
			};
			if ($dom == "") {
				$dom = $jmeno1 . "_domovská";
			}
			if ($voj == "") {
				$voj = $jmeno1 . "_vojenská";
			}
			if ($dom == $voj) {
				echo "Jména planet nesmí být stejná";
				break;
			};
			if (!(ereg("^.+@.+\\..+$", $email))) {
				echo "<font class='text_cerveny'>Neplatná emailová adresa</font>";
				break;
			};
			$jmeno1 = trim($jmeno1);
			if ($jmeno1 == "") {
				echo "<font class='text_cerveny'>Jméno není vyplněno</font>";
				break;
			};
			if ($jmeno1 == "testosteron") {
				echo "<font class='text_cerveny'>Neplatná bla fuj hnus</font>";
				break;
			};
			if ($heslo1 != $heslo2) {
				echo "<font class='text_cerveny'>Hesla nesouhlasí!</font>";
				break;
			};
			if (strlen($heslo1) <= 5) {
				echo "<font class='text_cerveny'>Heslo musí mít aspoň 6 znaků</font>";
				break;
			};
			@$vysledek = MySQL_Query("SELECT jmeno,email FROM  uzivatele ORDER BY jmeno");
			while ($zaznam = MySQL_Fetch_Array($vysledek)):
				if (strtolower($zaznam["jmeno"]) == strtolower($jmeno1)):
					echo "<font class='text_cerveny'>Toto jmeno nebo s jinak velkými písmeny už existuje. Zkuste prosím jiné.</font>";
					$spatne = 1;
					break;
				endif;
				if ($zaznam["email"] == $email):
					echo "<font class='text_cerveny'>Tento email už byl jednou zadán.Napište jiný.</font>";
					$spatne = 1;
					break;
				endif;
			endwhile;
			@$vysledek2 = MySQL_Query("SELECT nazev FROM  planety");
			while ($zaznam2 = MySQL_Fetch_Array($vysledek2)):
				if (strtolower($zaznam2["nazev"]) == strtolower($dom)):
					echo "<font class='text_cerveny'>Zadané jméno domovské planety už existuje</font>";
					$spatne = 1;
					break;
				endif;
			/* if(strtolower($zaznam2["nazev"])==strtolower($voj)):
			  echo "<font class='text_cerveny'>Zadané jméno vojenské planety už existuje</font>";
			  $spatne=1;
			  break;
			  endif; */
			endwhile;
			if ($spatne == 1) {
				break;
			};
			$heslo = $heslo1;
			$heslo1 = md5($heslo1);
			if ($rasa1 < 1 or $rasa1 > 9) {
				$rasa1 = 1;
			};
			$vys2 = MySQL_Query("SELECT rasa,planeta,nazevrasy,vyr_vyrob FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);
			//$pen=350000*$zaznam2["vyr_vyrob"];
			$pen = 15000000;
			$jmeno1 = HTMLSpecialChars($jmeno1);

			$nazev1 = $jmeno1;
			for ($i = 0; $i < strlen($nazev1); $i++):
				$blb = ord($nazev1[$i]);
				if (!(ord($nazev1[$i]) == 32 or ord($nazev1[$i]) == 95 or ( ord($nazev1[$i]) >= 40 and ord($nazev1[$i]) <= 57) or ( ord($nazev1[$i]) >= 60 and ord($nazev1[$i]) <= 90) or ( ord($nazev1[$i]) >= 97 and ord($nazev1[$i]) <= 122) or ord($nazev1[$i]) == 138 or ord($nazev1[$i]) == 141 or ord($nazev1[$i]) == 142 or ord($nazev1[$i]) == 154 or ord($nazev1[$i]) == 157 or ord($nazev1[$i]) == 158 or ord($nazev1[$i]) == 200 or ord($nazev1[$i]) == 201 or ord($nazev1[$i]) == 204 or ord($nazev1[$i]) == 205 or ord($nazev1[$i]) == 207 or ord($nazev1[$i]) == 210 or ord($nazev1[$i]) == 211 or ord($nazev1[$i]) == 216 or ord($nazev1[$i]) == 217 or ord($nazev1[$i]) == 218 or ord($nazev1[$i]) == 221 or ord($nazev1[$i]) == 225 or ord($nazev1[$i]) == 229 or ord($nazev1[$i]) == 232 or ord($nazev1[$i]) == 233 or ord($nazev1[$i]) == 236 or ord($nazev1[$i]) == 237 or ord($nazev1[$i]) == 242 or ord($nazev1[$i]) == 253 or ( ord($nazev1[$i]) >= 248 and ord($nazev1[$i]) <= 250))):
					echo "<font class='text_cerveny'>Máte špatný znak $nazev1[$i]($blb)</font>";
					exit;
				endif;
			endfor;

			$vek = Date("U");
			$h = Date("G", $vek);
			$m = Date("i", $vek);
			$s = Date("s", $vek);
			$sek = Date("U", $vek);
			$chci = $cas;
			$sek-=$m * 60;
			$sek-=$s;
			$a = $h - $chci;
			if (a > 0) {
				$a-=24;
			};
			$sek-=$a * 3600;
			//$den=$sek;
			$rasak = AddSlashes($zaznam2["nazevrasy"]);
			$cislovka = MySQL_Query("SELECT cislo,loginy,planety FROM servis where cislo=1");
			$cislo1 = MySQL_Fetch_Array($cislovka);
			$cislo = $cislo1[loginy] + 1000001;
			$uzje = $cislo1[planety];
			$uzje+=100001;
			//$uje=($uzje-100000)+1;
			$uje = ($uzje - 100000);
			$heslo1 = $heslo1;
			mt_srand(time());
			$c = mt_rand(1000000000, 9999999999);
			//if($web==""){$web=" ";};
			//if($icq==""){$icq=" ";};
			//if($rekl==""){$rekl=" ";};
			MySQL_Query("INSERT INTO uzivatele(cislo,jmeno,heslo,rasa,planety,penize,den,koho,posta,posta4,narod,zrizeni,email,vek,prepocet,kod,jed5,icq,www,zobrd,pohlavi,destinace,volen,rekl,statusnovacek) VALUES ('$cislo','$jmeno1','$heslo1','$rasa1','1','$pen','$sek','$jmeno1','1','0','$nar','$stat','$email','$vek','$cas','$c','625','$icq','$web','3','$pohl','$odkud','1','$rekl','$statusnovacek')") or die(mysql_error());
			$vys9 = MySQL_Query("SELECT rasa,posta FROM vudce where rasa = $rasa1");
			$zaznam9 = MySQL_Fetch_Array($vys9);
			$text = $zaznam9["posta"];
			/* $kontrlola_uvitaci_posty = MySQL_Query("SELECT odeslano_kdy FROM posta where (rasa='$rasa1' and odesilatel='Uv�tac� po�ta')");
			  //upraveno
			  $k_u_p= mysql_num_rows($kontrlola_uvitaci_posty);
			  if($k_u_p==1):
			  MySQL_Query("UPDATE posta set adresat='$jmeno1',text='$text', nazev = 'Uv�tac� po�ta' where (rasa='$rasa1' AND odesilatel='Uv�tac� po�ta') ");
			  else: */

			$id_posta = MySQL_Query("SELECT id FROM pocitani_id WHERE sekce='posta' ");
			$id_posta_1 = MySQL_Fetch_Array($id_posta);
			$id = $id_posta_1[id] + 1;

			MySQL_Query("INSERT INTO posta (id, odeslano_kdy, odesilatel, nazev, adresat, rasa_prijemce, text, `p/n`, typ, smaz) VALUES ('$id' ,'$vek', 'Vl�da', 'Uv�tac� po�ta','$jmeno1', '$rasak', '$text', 'n', '2', '0')") or die("dasdsad");
//	endif;
			///
			$typ = "Mírná planeta";
			MySQL_Query("INSERT INTO planety(cislo,nazev,majitel,mesta,lidi,vyrobna,cas,typ,cislomaj,status) VALUES	('$uzje','$dom','$jmeno1','10','100000000','50','$vek','$typ','$cislo','1')")or die(mysql_error());
			/*
			  $uzje++;
			  $plan=rand(1,4);
			  switch ($plan){
			  case 1: $typ="pouštní 1.typ";break;
			  case 2: $typ="pouštní 2.typ";break;
			  case 3: $typ="mírně skalnatá";break;
			  case 4: $typ="hodně skalnatá";break;
			  }
			  MySQL_Query("INSERT INTO planety(cislo,nazev,majitel,mesta,lidi,kasarna,laborator,cas,typ,cislomaj,status) VALUES ('$uzje','$voj','$jmeno1','1000','10000000000',8000,2000,$vek,'$typ',$cislo,0)")or die(mysql_error());
			 */
			$cislo-=100000;
			//echo "<h6>".$cislo."<br>";
			//echo $planety."<br>";
			MySQL_Query("update servis set loginy=$cislo,planety=$uje where cislo=1") or die(mysql_error());
			//echo $email;
			//exit;
			$zprava = "Toto jsou registrační údaje ze hry SG-NB (http://www.sg-nb.cz).\r\n \r\nLogin: $jmeno1\r\nHeslo: $heslo\r\n \r\n Tyto údaje si prosím uschovejte k pozdějšímu použití.\r\n \r\n UPOZORN�N�!!! Pou��vejte sv� heslo pouze k zalogov�n� p��mo do hry (http://www.sg-rtg.cz). \r\n Sv� heslo nikomu nesd�lujte. Vyhnete se tak mo�n�mu zcizen� loginu.\r\n\r\n \r\n T�mto je va�e registrace ukon�ena. Cel� admin t�m V�m p�eje p��jemnou hru.";
			mail($email, "SG-NB: Registracni udaje", $zprava, "From: SG-NB\r\n" . "Content-Type: text/plain; charset=\"UTF-8\"");
			echo "<script>location.href='index.php'</script>";
		} while (false);
		echo "<body bgcolor='bbbbbb'>";
	endif;
} else {
	/* echo "<font class='text_cerveny'>K teto rase se nemůže registrovat</font>"; */
}
$vys2 = MySQL_Query("SELECT rasa,uzi,nazevrasy FROM rasy where (rasa!=99 and rasa!=0 and rasa!=98 and rasa!=97) order by rasa");
$vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
$hhh = mysql_num_rows($vys5);
$celkuzi = $hhh;
$i = 0;
while ($zaznam2 = MySQL_Fetch_Array($vys2)):
	$aaa = $i + 1;
	$result = mysql_query("SELECT * FROM uzivatele where rasa like '$aaa'");
	$bbb = mysql_num_rows($result);
	/* echo $bbb . " "; */

	$pocuziv[$i] = $bbb;
	$nr[$i] = $zaznam2["nazevrasy"];
	$i ++;
endwhile;
$prumuzi = Round($celkuzi / $pocetras);
?>

<font class="text_bili"><h1>Registrace</h1></font>
<div id="help">
	<a href="index.php?page=help">Nápověda</font></a>
</div>
<form name="data" method="post" action="index.php?page=registrace">
	<table id="registrace">
		<tr>
			<td class="a">
				<font class="text_modry">Jméno:</font>
			</td>
			<td class="b">
				<input type="text" name="jmeno1" size=15 value="<?echo $jmeno1; ?>" class="input">
			</td>
		</tr>
		<tr>
			<td class="a">
				<font class="text_modry">Heslo:</font>
			</td>
			<td class="b">
				<input type="password" name="heslo1" size=15 class="input">
			</td>
		</tr>
		<tr>
			<td class="a">
				<font class="text_modry">Heslo:</font>
			</td>
			<td class="b">
				<input type="password" name="heslo2" size=15 class="input">
			</td>
		</tr>
		<tr>
			<td class="a">
				<font class="text_modry">Rasa:</font>
			</td>
			<td class="b">
				<select name="rasa1" class="input">
					<option value="">vyberte</option>
					<? 
					$min = $celkuzi;
					for ($i = 0; $i < $pocetras; $i++)
					{

					if ($min > $pocuziv[$i])
					{
					$min = $pocuziv[$i]; 
					}
					}
					$limit = $min + $konstrozdil;

					for($i=0;$i<$udaju;$i++):
					$j = $i; $js = $i+1;



					if(($limit)>$pocuziv[$i]){echo "<option value=".$js." "; kont2($rasa1, $js); echo ">".mb_convert_encoding($rasn[$j], "UTF-8")."</option>\r\n";}
					endfor;
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="a">
				<font class="text_modry">Email:</font>
			</td>
			<td class="b">
				<input type="text" name="email" size=25 value="<? echo $email; ?>" class="input"> <font class="text_bili_poznamka">(k zasl�n� reg. k�du)</font>
			</td>
		</tr>
		<tr>
			<td class="a">
				<font class="text_modry">Národ:</font>
			</td>
			<td class="b">
				<select name="nar" class="input">
					<option value="">vyberte</option>
					<option value=1 <? kont($nar, 1); ?>>Neutrální
				<option value=2 <? kont($nar, 2); ?>>Rozvoj
			<option value=3 <? kont($nar, 3); ?>>Obchodník
        <option value=4 <? kont($nar, 4); ?>>Zbrojíř
				<option value=5 <? kont($nar, 5); ?>>Mír
				<option value=6 <? kont($nar, 6); ?>>Věda
<option value=7 <? kont($nar, 7); ?>>Obránci
<option value=8 <? kont($nar, 8); ?>>Vyspělost
<option value=9 <? kont($nar, 9); ?>>Stavaři
</select>
</td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Státní zřízení:</font>
    </td>
    <td class="b">
		<select name="stat" class="input">
			<option value="">vyberte</option>
			<option value=1 <? kont($stat, 1); ?>>Neutrální
        <option value=2 <? kont($stat, 2); ?>>Mírové
		<option value=3 <? kont($stat, 3); ?>>Zbrojíř
		<option value=4 <? kont($stat, 4); ?>>útočné
<option value=5 <? kont($stat, 5); ?>>Výzkum
<option value=6 <? kont($stat, 6); ?>>Obranné
<option value=7 <? kont($stat, 7); ?>>Těžební
<option value=8 <? kont($stat, 8); ?>>Kolonizační
<option value=9 <? kont($stat, 9); ?>>Ničitel
</select>
</td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Hodina přepočtu:</font>
    </td>
    <td class="b">
		<select name="cas" class="input">
			<option selected>00
			<option>01
			<option>02
			<option>03
			<option>04
			<option>05
			<option>06
			<option>07
			<option>08
			<option>09
			<option>10
			<option>11
			<option>12
			<option>13
			<option>14
			<option>15
			<option>16
			<option>17
			<option>18
			<option>19
			<option>20
			<option>21
			<option>22
			<option>23			
		</select>
    </td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Jméno domovské planety:</font>
    </td>
    <td class="b">
		<input type="text" name="dom" size=15 value="<? echo $dom; ?>" class="input">
		<font class="text_bili_poznamka">(implicitní <i>jmeno</i>_domovská)</font>
    </td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">ICQ:</font>
    </td>
    <td class="b">
		<input type="text" name="icq" size=15 value="<? echo $icq; ?>" class="input">
		<font class="text_bili_poznamka">(možno později vypnout)</font>
    </td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Web:</font>
    </td>
    <td class="b">
		<input type="text" name="web" size=15 value="<? echo $web; ?>" class="input">
		<font class="text_bili_poznamka">(možno později vypnout)</font>
    </td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Od koho jsem o hře slyšel:</font>
    </td>
    <td class="b">
		<input type="text" name="rekl" size=15 value="<? echo $rekl; ?>" class="input">
		<font class="text_bili_poznamka">(zadejte nick hráče který vám ji doporučil popřípadě pole nevyplňujte)</font>
    </td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Pohlaví:</font>
    </td>
    <td class="b">
		<INPUT TYPE="radio" name="pohl" value=1 <? kont($pohl, 1); ?>> <font class="text_bili_poznamka">muž</font> 
		<INPUT TYPE="radio" name="pohl" value=2 <? kont($pohl, 2); ?>> <font class="text_bili_poznamka">žena</font>
    </td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Odkud hrajete:</font>
    </td>
    <td class="b">
		<INPUT TYPE="radio" name="odkud" value=1 <? kont($odkud, 1); ?>> <font class="text_bili_poznamka">domov</font><br>
		<INPUT TYPE="radio" name="odkud" value=2 <? kont($odkud, 2); ?>> <font class="text_bili_poznamka">škola/herna/kavárna</font><br> 
		<INPUT TYPE="radio" name="odkud" value=3 <? kont($odkud, 3); ?>> <font class="text_bili_poznamka">oboje</font>
    </td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Jste nováček:</font>
    </td>
    <td class="b">
		<INPUT TYPE="radio" name="statusnovacek" value=1 <? kont($statusnovacek, 1); ?>> <font class="text_bili_poznamka">ano</font> 
		<INPUT TYPE="radio" name="statusnovacek"> <font class="text_bili_poznamka">ne</font>
    </td>
</tr>
<tr>
    <td class="a">
		<font class="text_modry">Opište číselný kod z obrázku </font><img src="gd.php" border=0>:
    </td>
    <td class="b">
		<input type="text" name="potvr_kod" size="15" value="" class="input">
    </td>
</tr>
<tr>
    <td class="a">
		<INPUT TYPE="checkbox" name="souhlasim" value=1>
    </td>
    <td class="b" id="pravidla">
		<font class="text_modry">Souhlasím s <a href='index.php?page=pravidla'><i>pravidly</font><i></a></font>
					</td>
					</tr>
					<tr>
						<td colspan=2 class="b" id="reg">
							<input type="submit" value="Zaregistrovat se" name="odesli" class="button">
						</td>
					</tr>
					</table>
					</form>

<font class="text_bili"><h2>Detaily</h2></font>
<font class="text_modry">Na vyváženost ras je ovlivňován počet uživatelů v jednotlivých rasách. Je to počet lidí v rase s nejmenším počtem hráčů s maximálním navýšením 
<?echo $konstrozdil; ?> 
uživatelů. V následující tabulce je přehled ras s počty uživatelů v nich.<br />
Limit: <?
/*$limit = $prumuzi+$konstrozdil;*/
$min = $celkuzi;
for ($i = 0; $i < $pocetras; $i++)
{

					if ($min > $pocuziv[$i])
					{
					$min = $pocuziv[$i]; 
					}
					}
					$limit = $min + $konstrozdil;

					echo ($limit); 
					?></font>
					<table class='table' align="center" cellpadding=0 cellspacing=0>
						<tr class="vrsek">
							<th>Název rasy</th>
							<th>Počet uživatelů</th>
							<th>Přihlásit</th>
						</tr>
						<?
						$i=0;
						while($i<$pocetras):
						echo "<tr class='spodek'>";
						if($limit > $pocuziv[$i]):
						$barva="#0099FF";
						$barva2="white";
						$prihlasit="lze";
						else:
						$barva="red";
						$barva2="red";
						$prihlasit="nelze";
						endif;
						echo "<td><font color='".$barva."'>".$nr[$i]."</font></td>";
						echo "<td><font color=".$barva2.">".$pocuziv[$i]."</font></td>";
						echo "<td><font color=".$barva2.">".$prihlasit."</font></td>";
						echo "</tr>";
						$i++;
						endwhile;
						?>
					</table>
					<br>
					<font class="text_bili"><h2>Seznam národností</h2></font>
					<table class="table" align="center" cellpadding=0 cellspacing=0>
						<tr class="vrsek">
							<th>Název</th>
							<th>Bonusy</th>
							<th>Negativy</th>
						</tr>
						<?  	$i=1;
						$barva = "#0099FF";
						while($i<10):
						echo "<tr class='spodek'>";
						echo "<td><font color='".$barva."'>".$nazvy[$i]."</font></td>";
						echo "<td>".$bonusy[$i]."</td>";
						echo "<td>".$negativy[$i]."</td>";
						echo "</tr>\r\n";
						$i++;
						endwhile;
						?>
					</table>

					<br>
					<font class="text_bili"><h2>Seznam stáních zřizení</h2></font>
					<table class='table' align="center" cellpadding=0 cellspacing=0>
						<tr class="vrsek">
							<th>Název</th>
							<th>Bonusy</th>
							<th>Negativy</th>
						</tr>
						<?  	$i=1;
						while($i<10):
						echo "<tr class='spodek'>";
						echo "<td><font color='".$barva."'>".$nazvy1[$i]."</font></td>";
						echo "<td>".$bonusy1[$i]."</td>";
						echo "<td>".$negativy1[$i]."</td>";
						echo "</tr>\r\n";
						$i++;
						endwhile;
						?>
					</table>
