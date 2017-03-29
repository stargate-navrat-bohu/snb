<?php
require"ad1234.php";
//mysql_query("SET NAMES cp1250");
if(!(($zaznam1["heslo"]==$logheslo)and($zaznam1["jmeno"]==$logjmeno)and($zaznam1["cislo"]==$logcislo)and($zaznam1["heslo2"]==$aheslo)))
{echo "<script languague='JavaScript'>location.href='neprihlas.htm'</script>"; exit;};

$zmraz=$zaznam1[hra];

if(/*($zaznam1[admin]!=1 or $zaznam1[admin]!=2 or $zaznam1[admin]!=3 or $zaznam1[admin]!=4) and */$zaznam1[jmeno]!='prx' and $zaznam1[jmeno]!='sutech' and $zaznam1[jmeno]!='Raynoer' and $zaznam1[jmeno]!='Rada' and $zaznam1[jmeno]!='BenO' and $zaznam1[jmeno]!='marse4' and $zaznam1[jmeno]!='ETNyx' and $zaznam1[jmeno]!='Rusty' and $zaznam1[jmeno]!='Anubis' and $zaznam1[jmeno]!='ACE1' and $zaznam1[jmeno]!='Pyrotechnik' and $zaznam1[jmeno]!='Martinus' and $zaznam1[jmeno]!='zipakn' AND $zaznam1[jmeno]!='Mario' AND $zaznam1[jmeno]!='Kr.Pa.'){echo "<h1>Nejste admin proto nemáte přístup k admin rozhraní.</h1>";exit;};

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


if($d_day<'15'){

include"admin_menu.php";

echo "<br /><br /><span class='text_cerveny'>Probíhá věk. Restart nelze provést dříve než po 30 dnech.</span><br />
<span class='text_cerveny'>Poslední restart před ".$d_day." dny! </span><br /><br />";exit;

		 }
			}

if($zaznam1[zmrazeni]<Date("U")){
$zmraz=0;
MySQL_Query("update uzivatele set hra=0 where cislo = '$logcilo'");
}


if($zmraz==1):
	$cas = Date("h:i:s j.m.Y",$zaznam1[zmrazeni]);
	echo "<center><h1>Tento login je zmrazen az do ".$cas.". Pokud je login zmrazen, tak s ním nelze nic dělat, ale ani na něj nejde útočit.</h1></center>";
	exit;
endif;

$T=Date("U");
MySQL_Query("update online set posl=$T where jmeno = '$logjmeno'");


//deklarace žoldáků

$zold_utok=8;
$zold_obrana=8;
$zold_cena=100;
$zold_nazev="Elitní bojovník";
$zold_mist=0;
$max_sila=10000000;
$zold_text="Tito nejlepší bojovníci bývalých majitelů jsou zocelení měsíci tréninku. Bývalí majitelé je prodali, ale jim to až zas tak nevadí, bojují za toho kdo dá víc. A že bojují dobře! Jsou považováni za nejlepší vojáky galaxie! Poradí s čímkoliv, berou výzbroj, výstroj i stroje nepřátel i svých majitelů! Zacházej s nimi opatrně.";

include"admin_menu.php";

?>
<br /><br />
