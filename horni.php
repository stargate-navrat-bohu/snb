<?
		require "data_1.php";
mysql_query("SET NAMES cp1250");
			$vys1 = MySQL_Query("SELECT rasa,narod,zrizeni,penize,posta,posta2,posta3,posta4,posta5,posta6,posta7,posta8,posta9,posta10,jed1,jed2,jed4,jed5,utoceno, adm FROM uzivatele where cislo='$logcislo'") or die(mysql_error());
			$zaznam1 = MySQL_Fetch_Array($vys1);

$penize1=$zaznam1[penize];

$koliknut=$zaznam1[utoceno];

$nova1=$zaznam1[posta];
$nova2=$zaznam1[posta2];
$nova4=$zaznam1[posta4];
$nova5=$zaznam1[posta5];
$nova6=$zaznam1[posta6];
$nova7=$zaznam1[posta7];
$nova8=$zaznam1[posta8];
$nova9=$zaznam1[posta9];
$nova10=$zaznam1[posta10];
$nova12=$zaznam1[posta];
$kolikn=($nova1);
$koliknoa = $zaznam1[adm];

$vys2 = MySQL_Query("SELECT jed1_utok,jed2_utok,jed4_utok,jed1_obrana,jed2_obrana,jed4_obrana FROM rasy where rasa='$zaznam1[rasa]'");
		$zaznam2 = MySQL_Fetch_Array($vys2);

$politika1 = MySQL_Query("SELECT * FROM politika where rasa ='$zaznam1[rasa]'");
		$politika = MySQL_Fetch_Array($politika1);

$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'");
		$narod = MySQL_Fetch_Array($narod1);
$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'");
		$zriz = @MySQL_Fetch_Array($zrizeni1);


		$utok=$zaznam1["jed1"] * $zaznam2["jed1_utok"];
		$utok+=$zaznam1["jed2"]*$zaznam2["jed2_utok"];
		$utok+=$zaznam1["jed4"]*$zaznam2["jed4_utok"];
		$utok+=$zaznam1["jed5"]*$zold_utok;
		
                $bonusut=1*$politika[utok]/100;
		$bonusut*=$narod[utok]/100;
		$bonusut*=$zriz[utok]/100;
		$utok*=$bonusut;

		$obrana=$zaznam1["jed1"]*$zaznam2["jed1_obrana"];
		$obrana+=$zaznam1["jed2"]*$zaznam2["jed2_obrana"];
		$obrana+=$zaznam1["jed4"]*$zaznam2["jed4_obrana"];
		$obrana+=$zaznam1["jed5"]*$zold_obrana;

		$bonusob=1*$politika[obrana]/100;
		$bonusob*=$narod[obrana]/100;
		$bonusob*=$zriz[obrana]/100;		
		$obrana*=$bonusob;		

		$sila=$obrana+$utok;

if($kolikn>0){ $zprava = '<span style="color: blue"><a href="hlavni.php?page=posta&vyber=2">Nové zprávy: '.$kolikn.' </a></span>'; }
else { $zprava = "Nové zprávy: 0"; }

if($koliknut>0){ $zprava_utok = '<span style="color: red">Nové útoky: '.$koliknut.'</span>'; }
else { $zprava_utok = 'Nové útoky: 0'; }

if($koliknoa>0){ $zprava_oa = '<span style="color: blue"><a href="hlavni.php?page=forum&kde=adm">Nové OA: '.$koliknoa.' </a></span>'; }
else { $zprava_oa = 'Nové OA: 0'; }

echo "<left><font class='text_horni'>Naquadah: ".number_format($penize1,0,0," ")."&nbsp;|&nbsp;Síla: ".number_format($sila,0,0," ")."&nbsp;|&nbsp;".$zprava."&nbsp;|&nbsp; ".$zprava_utok."&nbsp;|&nbsp; ".$zprava_oa."</font><left>";

?>
