<?php
		require "data_1.php";
mysql_query("SET NAMES cp1250");
		$rasa1=10;
		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
		$zaznam2 = MySQL_Fetch_Array($vys2);

//deklarace �old�k�

$zold_utok=100;
$zold_obrana=100;
$zold_cena=5000;
$zold_nazev="N�jemn� vrah";
$zold_mist=0;
$max_sila=80000000;
//$zold_text="Tito nejlep�� bojovn�ci b�val�ch majitel� jsou zocelen� m�s�ci tr�ninku. B�val� majitel� je prodali, ale jim to a� zas tak nevad�, bojuj� za toho kdo d� v�c. A �e bojuj� dob�e! Jsou pova�ov�ni za nejlep�� voj�ky galaxie! Porad� s ��mkoliv, berou v�zbroj, v�stroj i stroje nep��tel i sv�ch majitel�! Zach�zej s nimi opatrn�.";		
		

		
		
$vys4 = MySQL_Query("SELECT * FROM utok where (utocnik='Commander Ergara' or obrance='Commander Ergara') ORDER BY den DESC");
while ($zaznam4 = MySQL_Fetch_Array($vys4)):
 if ($zaznam4["utocnik"]=='Commander Ergara') {$my="u";$on="o";};
 if ($zaznam4["obrance"]=='Commander Ergara') {$my="o";$on="u";}; 
 $pocet1=$pocet1+$zaznam4[($my.'jed1')];
 $pocet5=$pocet5+$zaznam4[($my.'jed5')];
 $pocet2=$pocet2+$zaznam4[($my.'jed2')];
 $pocet4=$pocet4+$zaznam4[($my.'jed4')];
 $pocet21=$pocet1+$zaznam4[($on.'jed1')];
 $pocet25=$pocet5+$zaznam4[($on.'jed5')];
 $pocet22=$pocet2+$zaznam4[($on.'jed2')];
 $pocet24=$pocet4+$zaznam4[($on.'jed4')]; 
 $uspech_a=$uspech_a+$zaznam4["uspesnost"];
 if ($zaznam4["uspesnost"]==0) {$uspech_b=$uspech_b+1;};  
endwhile;	
echo $pocet1 . " - " . $zaznam2["jed1_nazev"];
echo "<br>";
echo $pocet5 . " - " . $zold_nazev;
echo "<br>";
echo $pocet2 . " - " . $zaznam2["jed2_nazev"];
echo "<br>";
echo $pocet4 . " - " . $zaznam2["jed4_nazev"];
echo "<br>";
echo "U:" . $uspech_a;
echo "<br>";
echo "N:" . $uspech_b;
/*{echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed1_nazev"];};
>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed4')]." * ".$zaznam2["jed4_nazev"];};*/
$vys4 = MySQL_Query("SELECT * FROM utok where (utocnik='Avzo' or obrance='Avzo') ORDER BY den DESC");
while ($zaznam4 = MySQL_Fetch_Array($vys4)):
 if ($zaznam4["utocnik"]=='Avzo') {$my="u";$on="o";};
 if ($zaznam4["obrance"]=='Avzo') {$my="o";$on="u";}; 
 $pocet1=$pocet1+$zaznam4[($my.'jed1')];
 $pocet5=$pocet5+$zaznam4[($my.'jed5')];
 $pocet2=$pocet2+$zaznam4[($my.'jed2')];
 $pocet4=$pocet4+$zaznam4[($my.'jed4')];
 $pocet21=$pocet1+$zaznam4[($on.'jed1')];
 $pocet25=$pocet5+$zaznam4[($on.'jed5')];
 $pocet22=$pocet2+$zaznam4[($on.'jed2')];
 $pocet24=$pocet4+$zaznam4[($on.'jed4')]; 
 $uspech_a=$uspech_a+$zaznam4["uspesnost"];
 if ($zaznam4["uspesnost"]==0) {$uspech_b=$uspech_b+1;};  
endwhile;	
echo "<br>";
echo "<br>";
echo $pocet1 . " - " . $zaznam2["jed1_nazev"];
echo "<br>";
echo $pocet5 . " - " . $zold_nazev;
echo "<br>";
echo $pocet2 . " - " . $zaznam2["jed2_nazev"];
echo "<br>";
echo $pocet4 . " - " . $zaznam2["jed4_nazev"];
echo "<br>";
echo "U:" . $uspech_a;
echo "<br>";
echo "N:" . $uspech_b;

?>
