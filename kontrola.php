<?php
mysql_query("SET NAMES cp1250");
$heslob="c22ff79a02363de9b0861e20662f72cd";

$zastaveno2 = MySQL_Query("SELECT cislo,zutok,zhra,zmezi FROM servis where cislo='1'");	
$zastaveno = MySQL_Fetch_Array($zastaveno2);
	
if($zastaveno[zhra]!="" and $zaznam1[admin]==0){echo "<center><h1>$zastaveno[zhra]</h1></center>";exit;};
if($zastaveno[zmezi]!="" and $mezi_ovl==1){echo "<center><h1>$zastaveno[zmezi]</h1></center>";exit;};
if(!(($zaznam1["heslo"]==$logheslo)and($zaznam1["jmeno"]==$logjmeno)and($zaznam1["cislo"]==$logcislo)))
{echo "<script languague='JavaScript'>location.href='neprihlas.htm'</script>"; exit;};

//----------------------/*

if ($horni_info==1):
$horni_info=0;
else:




 $stop1 = MySQL_Query("SELECT patnactminut,casnasg,admin FROM uzivatele where cislo='$logcislo'");
		$stop11 = MySQL_Fetch_Array($stop1);

$cas15=Date("U");
$stopp=(($stop11[patnactminut])+900);
//echo $cas15,$stopp;
if(($stopp<$cas15) AND ($stop11[admin]!=1 and $stop11[admin]!=2 and $stop11[admin]!=3 and $stop11[admin]!=4) ):
MySQL_Query("DELETE FROM online where  jmeno='".$logjmeno."'");
echo "<script languague='JavaScript'>location.href='neprihlasen.htm'</script>"; exit;
else:
$cassg=($cas15-$stop11[patnactminut])+$stop11[casnasg];
  MySQL_Query("update uzivatele set patnactminut='$cas15',casnasg='$cassg' where cislo='$logcislo'") or die(mysql_error());
endif;
endif;
//----------------------*/


if($zaznam1[heslo2]!=$heslob and ($zaznam1[rasa]==16 or $zaznam1[rasa]==17 or $zaznam1[rasa]==18) and $info!=1){echo "<script languague='JavaScript'>location.href='neprihlas.htm'</script>"; exit;};
$zmraz=$zaznam1[hra];
if($zaznam1[zmrazeni]<Date("U")){
$zmraz=0;
MySQL_Query("update uzivatele set hra=0 where cislo = '$logcilo'");
}
switch($zaznam1[skin]){
	case 0: $table="borderColor=#ffffff borderColorDark=#ffffff borderColorLight=#ffffff cellspacing=0";
			$border="border=1";
			$borders="border=0";
			$obr="";
			$color_hr="#99DDFF";
			break;
	case 1: $table="borderColorDark=#669999 borderColorLight=#ffffff borderColor=#669999 cellspacing=0";
			$border="border=1";
			$borders="border=0";
			$obr="background=info_obr/daniel.jpg height=298 width=431 align=left";
			$color_hr="#669999";
			break;
	case 2: $table="borderColorDark=#669999 borderColorLight=#ffffff borderColor=#669999 cellspacing=0";
			$border="border=1";
			$borders="border=0";
			$obr="background=info_obr/sam.jpg height=298 width=431 align=left";
			$color_hr="#669999";
			break;
	case 3: $table="borderColorDark=#669999 borderColorLight=#ffffff borderColor=#669999 cellspacing=0";
			$border="border=1";
			$borders="border=0";
			$obr="background=info_obr/jack.jpg height=298 width=431 align=left";
			$color_hr="#669999";
			break;
	case 4: $table="borderColorDark=#669999 borderColorLight=#ffffff borderColor=#669999 cellspacing=0";
			$border="border=1";
			$borders="border=0";
			$obr="background=info_obr/tealc.jpg height=298 width=431 align=left";
			$color_hr="#669999";			
			break;	
	case 5: $table="bordercolorlight=#FFFFFF bordercolordark=#FFFFFF bordercolor=#FFFFFF cellspacing=0";
			$border="border=1";
			$borders="border=1";
			$obr="";
			$color_hr="#ffffff";			
			break;	
	case 6: $table="bordercolorlight=#FFFFFF bordercolordark=#FFFFFF bordercolor=#FFFFFF cellspacing=0";
			$border="border=1";
			$borders="border=1";
			$obr="";
			$color_hr="#ffffff";			
			break;	
	case 7: $table="bordercolorlight=#FFFFFF bordercolordark=#FFFFFF bordercolor=#FFFFFF cellspacing=0";
			$border="border=1";
			$borders="border=1";
			$obr="";
			$color_hr="#ffffff";			
			break;										
	case 8: $table="bordercolorlight=#000000 bordercolordark=#000000 bordercolor=#000000 cellspacing=0";
			$border="border=1";
			$borders="border=1";
			$obr="";
			$color_hr="#000000";			
			break;				
	case 9: $table="borderColor=#ffffff borderColorLight=#64afe8 cellspacing=0";
			$border="border=1";
			$borders="border=0";
			$obr="background=info_obr/reet.jpg height=298 width=431 align=left";
			$color_hr="#64afe8";			
			break;					
			};					
if($zmraz==1):
	$cas = Date("H:i:s j.m.Y",$zaznam1[zmrazeni]);
	echo "<center><h1>Tento login je zmrazen az do ".$cas.". Pokud je login zmrazen, tak s ním nelze nic dìlat, ale ani na nìj nejde útoèit.</h1></center>";
	exit;
endif;

$T=Date("U");
MySQL_Query("update online set posl=$T where jmeno = '$logjmeno'");


//deklarace žoldákù

$zold_utok=80;
$zold_obrana=80;
$zold_cena=2000;
$zold_nazev="Nájemný vrah";
$zold_mist=0;
$max_sila=99999999999;
//$zold_text="Tito nejlepší bojovníci bývalých majitelù jsou zocelení mìsíci tréninku. Bývalí majitelé je prodali, ale jim to až zas tak nevadí, bojují za toho kdo dá víc. A že bojují dobøe! Jsou považováni za nejlepší vojáky galaxie! Poradí si s èímkoliv, berou výzbroj, výstroj i stroje nepøátel i svých majitelù! Zacházej s nimi opatrnì.";
$pocetras=9;
?>
