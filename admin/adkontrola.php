<?php
require"ad1234.php";
//mysql_query("SET NAMES cp1250");
// if(!(($zaznam1["heslo"]==$logheslo)and($zaznam1["jmeno"]==$logjmeno)and($zaznam1["cislo"]==$logcislo)and($zaznam1["heslo2"]==$aheslo)))
// {echo "<script languague='JavaScript'>location.href='neprihlas.htm'</script>"; exit;};

$zmraz=$zaznam1[hra];

// if( $zaznam1[admin]!=1 AND $zaznam1[admin]!=2 AND $zaznam1[admin]!=3 AND $zaznam1[admin]!=4){echo "<h1>Nejste admin proto nem�te p��stup k admin rozhran�.</h1>";exit;};

if($page=="admin17"){

  $cas_1 = mktime(20,0,0,2,8,2007); //hodiny,minuty,sekundy,mesic,den,rok
  $cas_2 = mktime();

  $d_sec = $cas_2 - $cas_1;
  $d_day = floor($d_sec/86400);
  $d_sec -= $d_day * 86400;
  $d_hrs = floor($d_sec/3600);
  $d_sec -= $d_hrs * 3600;
  $d_min = floor($d_sec/60);
  $d_sec -= $d_min * 60;


if($d_day<'2'){

echo "<br /><br /><span class='text_cerveny'>Prob�h� v�k. Restart nelze prov�st d��ve ne� po 30 dnech.</span><br />
<span class='text_cerveny'>Posledn� restart p�ed ".$d_day." dny! </span><br /><br />";exit;

		 }
			}

if($zaznam1[zmrazeni]<Date("U")){
$zmraz=0;
MySQL_Query("update uzivatele set hra=0 where cislo = '$logcilo'");
}


if($zmraz==1):
	$cas = Date("h:i:s j.m.Y",$zaznam1[zmrazeni]);
	echo "<center><h1>Tento login je zmrazen az do ".$cas.". Pokud je login zmrazen, tak s n�m nelze nic d�lat, ale ani na n�j nejde �to�it.</h1></center>";
	exit;
endif;

$T=Date("U");
MySQL_Query("update online set posl=$T where jmeno = '$logjmeno'");


//deklarace �old�k�

$zold_utok=8;
$zold_obrana=8;
$zold_cena=100;
$zold_nazev="Elitn� bojovn�k";
$zold_mist=0;
$max_sila=10000000;
$zold_text="Tito nejlep�� bojovn�ci b�val�ch majitel� jsou zocelen� m�s�ci tr�ninku. B�val� majitel� je prodali, ale jim to a� zas tak nevad�, bojuj� za toho kdo d� v�c. A �e bojuj� dob�e! Jsou pova�ov�ni za nejlep�� voj�ky galaxie! Porad� s ��mkoliv, berou v�zbroj, v�stroj i stroje nep��tel i sv�ch majitel�! Zach�zej s nimi opatrn�.";
