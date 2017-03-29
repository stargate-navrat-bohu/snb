<?php
mysql_query("SET NAMES cp1250");
Header ("Cache control: no-cache");
/*$i=0;
while($i<200){
	mysql_query("INSERT INTO refnew VALUES('$i', 'test', 'jede', 'jede', 'jede', '0')");
	$i++;
}*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">

<?php
require "data_1.php";

$vys1 = MySQL_Query("SELECT jmeno,heslo,volen,koho,rasa,status,ref,refn,cislo,hra,zmrazeni,skin,orp,admin,reg FROM uzivatele where cislo=$logcislo");
$zaznam1 = MySQL_Fetch_Array($vys1);

require("kontrola.php");

$styl="styl".$zaznam1[skin];
if($zaznam1[skin]==1 or $zaznam1[skin]==2 or $zaznam1[skin]==3 or $zaznam1[skin]==4){$styl="styl1";};
?>

<style type="text/css">
@import url(<?php echo $styl?>.css);
td{text-align:center;}
</style>
<script language="JavaScript" src="a.js"></script>
</head>
<body>

<?php
$rasa=$zaznam1[rasa];

// Zmena narodniho referenda - zacatek
if (isset($znar)) {
  do {
    if ($zaznam1[status]!=1)
    if ($zaznam1[status]!=2)
    if ($zaznam1[status]!=5) {
      echo "<h1>Toto je povoleno pouze vůdci, zástupci a poradcům.</h1>";
	  break;
	};
	$vys5 = MySQL_Query("SELECT jmeno FROM uzivatele where rasa ='$rasa'");
	$hhh = mysql_num_rows($vys5);    
	$refer = MySQL_Query("SELECT * FROM refnew where cislo = '$rasa'");
    $ref = MySQL_Fetch_Array($refer);
    $dohromady=$ref[ano]+$ref[ne];
    if ($hhh!=0) {$vysledek.= " (". Round(($ref[odp1]+$ref[odp2]+$ref[odp3])/$hhh*100) ."%).";} else {$vysledek.=".";};
	$znar.=" (Zadal: " . $zaznam1[jmeno] . ")";
  
  $otazka=HTMLSpecialChars($znar);
	$otazka=NL2BR($otazka);
	$odpoved1=HTMLSpecialChars($nodpoved1);
	$odpoved1=NL2BR($odpoved1);
	$odpoved2=HTMLSpecialChars($nodpoved2);
	$odpoved2=NL2BR($odpoved2);
	$odpoved3=HTMLSpecialChars($nodpoved3);
	$odpoved3=NL2BR($odpoved3);
    MySQL_Query("update uzivatele set refn=0 where rasa='$rasa'");
    MySQL_Query("update refnew set odpoved1='$odpoved1',odpoved2='$odpoved2',odpoved3='$odpoved3',otazka='$otazka',odp1='0',odp2='0',odp3='0' where cislo='$rasa'");
    MySQL_Query("update refnew set vysledek='$vysledek' where cislo='$rasa'");
  } while (false);
};
// Zmena narodniho referenda - konec

// Zmena celovesmirneho referenda - zacatek
if(isset($zmez)) {
  do {
    if($zaznam1[admin]!=1)
    if ($zaznam1[status]!=1) {
	  echo "<h1>Toto je dovoleno pouze adminům a vůdcům.</h1>";
	  break;
	};	
	$vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
	$hhh = mysql_num_rows($vys5);
	$refer = MySQL_Query("SELECT * FROM refnew where cislo = 0");
	$ref = MySQL_Fetch_Array($refer);
	$dohromady=$ref[odp1]+$ref[odp2]+$ref[odp3];
	$vysledek="Na otazku: \'".$ref[otazka]."\' pro odpověď: ".$ref[odpoved1]." hlasovalo ".$ref[odp1].", pro odpověď: ".$ref[odpoved2]." hlasovalo ".$ref[odp2]." a pro odpověď: ".$ref[odpoved3]." hlasovalo ".$ref[odp3].". Celkem hlasovalo lidí: ".$dohromady . " / " . $hhh;
	if ($hhh!=0) {$vysledek.= " (". Round(($ref[odp1]+$ref[odp2]+$ref[odp3])/$hhh*100) ."%).";} else {$vysledek.=".";};
	$zmez.=" (Zadal: " . $zaznam1[jmeno] . ")";
	
  $otazka=HTMLSpecialChars($zmez);
	$otazka=NL2BR($otazka);
	$odpoved1=HTMLSpecialChars($codpoved1);
	$odpoved1=NL2BR($odpoved1);
	$odpoved2=HTMLSpecialChars($codpoved2);
	$odpoved2=NL2BR($odpoved2);
	$odpoved3=HTMLSpecialChars($codpoved3);
	$odpoved3=NL2BR($odpoved3);
	MySQL_Query("update uzivatele set ref='0'");
	MySQL_Query("update refnew set odpoved1='$odpoved1',odpoved2='$odpoved2',odpoved3='$odpoved3',otazka='$otazka',odp1='0',odp2='0',odp3='0' where cislo='0'");
	MySQL_Query("update refnew set vysledek='$vysledek' where cislo='0'");
  }while(false);		
};
// Zmena celovesmirneho referenda - konec

// Hlasovani v celovesmirnem referendu - zacatek

// Z 1 NA 2 A Z 1 NA 3
$refer = MySQL_Query("SELECT * FROM refnew where cislo = 0");
$ref = MySQL_Fetch_Array($refer);

if (isset($r)) {
  if ($r=="odp1") {
    if ($zaznam1[ref]==1) {

	  echo " ";
	} elseif ($zaznam1[ref]==2) {
	
	  MySQL_Query("update uzivatele set ref = 1 where cislo='$logcislo'");
	  $oo1=$ref[odp1]+1;
   	  $oo2=$ref[odp2]-1;
	  MySQL_Query("update refnew set odp1 = '$oo1', odp2 = '$oo2' where cislo=0");
	} else {

	  MySQL_Query("update uzivatele set ref = 1 where cislo='$logcislo'");
	  $oo1=$ref[odp1]+1;
   	  MySQL_Query("update refnew set odp1 = '$oo1' where cislo=0");
	};

  } else {
    if($zaznam1[ref]==1) {

	  MySQL_Query("update uzivatele set ref = 2 where cislo='$logcislo'");
	  $oo1=$ref[odp1]-1;
	  $oo2=$ref[odp2]+1;
	  MySQL_Query("update refnew set odp1 = '$oo1', odp2 = '$oo2' where cislo=0");
	} elseif($zaznam1[ref]==2) {

	  echo " ";
	} else {

	  MySQL_Query("update uzivatele set ref = 2 where cislo=$logcislo");
  	  $oo2=$ref[odp2]+1;
	  MySQL_Query("update refnew set odp2 = '$oo2' where cislo=0");
	};
  };
};
// Hlasovani v celovesmirnem referendu - konec

// Hlasovani v narodnim referendu - zacatek
$refer = MySQL_Query("SELECT * FROM refnew where cislo='$rasa'");
$ref = MySQL_Fetch_Array($refer);

	if(isset($nar)):
		if($nar=="ano"):
			if($zaznam1[refn]==1):

				echo " ";
			elseif($zaznam1[refn]==2):

				MySQL_Query("update uzivatele set refn = 1 where cislo='$logcislo'");
				$aaa=$ref[ano]+1;
				$nnn=$ref[ne]-1;
				MySQL_Query("update refnew set ano = '$aaa', ne = '$nnn' where cislo='$rasa'");
			else:

				MySQL_Query("update uzivatele set refn = 1 where cislo='$logcislo'");
				$aaa=$ref[ano]+1;
				MySQL_Query("update refnew set ano = '$aaa' where cislo='$rasa'");
			endif;
		else:
			if($zaznam1[refn]==1):

				MySQL_Query("update uzivatele set refn = 2 where cislo='$logcislo'");
				$aaa=$ref[ano]-1;
				$nnn=$ref[ne]+1;
				MySQL_Query("update refnew set ano = '$aaa', ne = '$nnn' where cislo='$rasa'");
			elseif($zaznam1[refn]==2):

				echo " ";
			else:

				MySQL_Query("update uzivatele set refn = 2 where cislo='$logcislo'");
				$aaa=$ref[ne]+1;
				MySQL_Query("update refnew set ne ='$aaa' where cislo='$rasa'");
			endif;
		endif;
	endif;
// Hlasovani v narodnim referendu - konec
	
	
	$refer = MySQL_Query("SELECT * FROM refnew where cislo=0");
	$ref = MySQL_Fetch_Array($refer);
	$vys55 = MySQL_Query("SELECT jmeno,ref FROM uzivatele where cislo='$logcislo'");
	$zaznam55 = MySQL_Fetch_Array($vys55);
	
	if($zaznam55[ref]==1):
		$odp1="checked";
	elseif($zaznam55[ref]==2):
		$odp2="checked";
	elseif($zaznam55[ref]==3):
		$odp3="checked";
	else:
		echo " ";
	endif;
	$vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
	$hhh = mysql_num_rows($vys5);
	
	echo "<h6><font class=kapital>C</font>elovesmírné referendum.</h6><font class='info'>";
	echo "Otázka zní: <font class=pole>".$ref[otazka]."</font><br>";
	echo "Odpověď 1: <font class=pole>".$ref[odpoved1]."</font><br>";
	echo "Odpověď 2: <font class=pole>".$ref[odpoved2]."</font><br>";
	echo "Odpověď 3: <font class=pole>".$ref[odpoved3]."</font><br>";
	echo "Zatím odpovědělo: <font class=pole>";
	echo $ref[odp1]+$ref[odp2]+$ref[odp3] . " / " . $hhh;
	if ($hhh!=0) {echo " (". Round(($ref[odp1]+$ref[odp2]+$ref[odp3])/$hhh*100) ."%)</font>";};
	echo "<br>Odpověď 1 zvolilo: <font class=pole>".$ref[odp1];
	if (($ref[odp1]+$ref[odp2]+$ref[odp3])!=0) echo " (". Round($ref[odp1]/($ref[odp1]+$ref[odp2]+$ref[odp3])*100) ."%)";
	echo "</font>. Odpověď 2 zvolilo: <font class=pole>".$ref[odp2];
	if (($ref[odp1]+$ref[odp2]+$ref[odp3])!=0) echo " (". Round($ref[odp2]/($ref[odp1]+$ref[odp2]+$ref[odp3])*100) ."%)";
	echo "</font>. Odpověď 3 zvolilo: <font class=pole>".$ref[odp3];
	if (($ref[odp1]+$ref[odp2]+$ref[odp3])!=0) echo " (". Round($ref[odp3]/($ref[odp1]+$ref[odp2]+$ref[odp3])*100) ."%)";
	echo "</font>";
	echo "<form method='post' action='ref2.php'>";
	echo "<input type='radio' name='r' value='odp1' ".$odp1."> Odpověď 1 &nbsp;&nbsp;&nbsp;&nbsp;
  <input type='radio' name='r' value='odp2' ".$odp2."> Odpověď 2 &nbsp;&nbsp;&nbsp;&nbsp;
  <input type='radio' name='r' value='odp3' ".$odp3."> Odpověď 3 ";
	echo "<br><br><input type='submit' value='změň volbu'>";
	echo "</form>";
	echo "Výsledek minulého referenda: <font class=pole>".stripslashes($ref[vysledek])."</font></font>";

	$refer = MySQL_Query("SELECT * FROM refnew where cislo=$rasa");
	$ref = MySQL_Fetch_Array($refer);
	$vys55 = MySQL_Query("SELECT jmeno,refn FROM uzivatele where cislo=$logcislo");
	$zaznam55 = MySQL_Fetch_Array($vys55);
	
	//$ano=$ne="";

	if($zaznam55[refn]==1):
		$odp1="checked";
	elseif($zaznam55[refn]==2):
		$odp2="checked";
	elseif($zaznam55[refn]==3):
		$odp3="checked";
	else:
		echo " ";
	endif;
	if($rasa!=20 and $rasa!=0):
	$vys5 = MySQL_Query("SELECT jmeno FROM uzivatele where rasa='$rasa'");
	$hhh = mysql_num_rows($vys5);
	echo "<h6><font class=kapital>N</font>árodní referendum.</h6><font class='info'>";
	echo "Otázka zní: <font class=pole>".$ref[otazka]."</font><br>";
	echo "Odpověď 1: <font class=pole>".$ref[odpoved1]."</font><br>";
	echo "Odpověď 2: <font class=pole>".$ref[odpoved2]."</font><br>";
	echo "Odpověď 3: <font class=pole>".$ref[odpoved3]."</font><br>";
	echo "Zatím odpovědělo: <font class=pole>";
	echo $ref[odp1]+$ref[odp2]+$ref[odp3] . " / " . $hhh;
	if ($hhh!=0) {echo " (". Round(($ref[odp1]+$ref[odp2]+$ref[odp3])/$hhh*100) ."%)</font>";};
	echo "<br>Odpověď 1 zvolilo: <font class=pole>".$ref[odp1];
	if (($ref[odp1]+$ref[odp2]+$ref[odp3])!=0) echo " (". Round($ref[odp1]/($ref[odp1]+$ref[odp2]+$ref[odp3])*100) ."%)";
	echo "</font>. Odpověď 2 zvolilo: <font class=pole>".$ref[odp2];
	if (($ref[odp1]+$ref[odp2]+$ref[odp3])!=0) echo " (". Round($ref[odp2]/($ref[odp1]+$ref[odp2]+$ref[odp3])*100) ."%)";
	echo "</font>. Odpověď 3 zvolilo: <font class=pole>".$ref[odp3];
	if (($ref[odp1]+$ref[odp2]+$ref[odp3])!=0) echo " (". Round($ref[odp3]/($ref[odp1]+$ref[odp2]+$ref[odp3])*100) ."%)";
	echo "</font>";
	echo "<form method='post' action='ref2.php'>";
	echo "<input type='radio' name='r' value='odp1' ".$odp1."> Odpověď 1 &nbsp;&nbsp;&nbsp;&nbsp;
  <input type='radio' name='r' value='odp2' ".$odp2."> Odpověď 2 &nbsp;&nbsp;&nbsp;&nbsp;
  <input type='radio' name='r' value='odp3' ".$odp3."> Odpověď 3 ";
	echo "<br><br><input type='submit' value='změň volbu'>";
	echo "</form>";
	echo "Výsledek minulého referenda: <font class=pole>".stripslashes($ref[vysledek])."</font></font>";
	
	$refer = MySQL_Query("SELECT * FROM obrref where rasa=$rasa order by cas DESC");
	$ref = MySQL_Fetch_Array($refer);
	$vys55 = MySQL_Query("SELECT jmeno,orp FROM uzivatele where cislo=$logcislo");
	$zaznam55 = MySQL_Fetch_Array($vys55);
	
	if($zaznam55[orp]==1):
		$oa="q1";
	elseif($zaznam55[orp]==2):
		$oa="q2";
	elseif($zaznam55[orp]==3):
		$oa="q3";		
	endif;	

	if($zaznam1[status]==1 or $zaznam1[status]==5 or $zaznam1[status]==2):
		echo "<form method='post' action='ref2.php'>";
		echo "<h6><font class=kapital>Z</font>měnit narodní referndum.</h6><font class='info'>";
		echo "Otázka: <input type=text name=znar size=80><br>";
		echo "Odpověď 1: <input type=text name=nodpoved1 size=80><br>";
		echo "Odpověď 2: <input type=text name=nodpoved2 size=80><br>";
		echo "Odpověď 3: <input type=text name=nodpoved3 size=80><br>";
		echo "<br></font><input type='submit' value='změň referendum'>";
		echo "</form>";
	endif;
	endif;
	if($zaznam1[admin]==1):
		echo "<form method='post' action='ref2.php'>";
		echo "<h6><font class=kapital>Z</font>měnit celovesmírné referendum.</h6><font class='info'>";
		echo "Otázka: <input type=text name=zmez size=80><br>";
		echo "Odpověď 1: <input type=text name=codpoved1 size=80><br>";
		echo "Odpověď 2: <input type=text name=codpoved2 size=80><br>";
		echo "Odpověď 3: <input type=text name=codpoved3 size=80><br>";
		echo "<br></font><input type='submit' value='změň referendum'>";
		echo "</form>";
	endif;

	
	echo "</font>";
	MySQL_Close($spojeni);		
?>

</body>
</html>
