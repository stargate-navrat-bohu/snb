<?
mysql_query("SET NAMES cp1250");		
require "data_1.php";



	$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
	$zaznam1 = MySQL_Fetch_Array($vys1);

	require("kontrola.php");

if($zaznam1["gold"]==1 or $zaznam1["silver"]==1):
$kolikdnu="1 den";
$kolikdnupocet=1;
else:
$kolikdnu="2 dny";
$kolikdnupocet=2;
endif;

?>

<script language="JavaScript">
function zmena(){
document.formw.planeta.value=1;
}
</script>

<center><h6>
<a href="hlavni.php?page=politika&vyber=1" >Národnost a státní zøízení</a>
&nbsp;&nbsp;
<?
/////if($zaznam1[rasa]!=0 and $zaznam1[rasa]!=7){echo "<a href='hlavni.php?page=politika&vyber=2' >Celorasová politika</a>";};
if($zaznam1[rasa]!=0){echo "<a href='hlavni.php?page=politika&vyber=2' >Celorasová politika</a>";};
?>
</h6></center>


<?
$polc=100;

	$rasa1 = $zaznam1["rasa"] ;
	$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
	$zaznam2 = MySQL_Fetch_Array($vys2);
	$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = $logcislo");	
	
	$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
	$politika = MySQL_Fetch_Array($politika1);
        $konstantax = 100;

	if(isset($polit)):
		$fond1 = MySQL_Query("SELECT rasa,fond FROM vudce where rasa = $rasa1");
		$fond = MySQL_Fetch_Array($fond1);
		$cena=($zaznam2[uzi]*$zaznam2[vyr_vyrob]*$polc) + 500000;
		$posl=$politika["posl"] + 86400;
		if($fond[fond]<$cena){echo "Ve fondu neni dost penìz";break;};
		if($posl>Date("U")){echo "Poslední zmìna byla provedena pøíliš nedávno";break;};		
			
		$stara=$politika[priorita];
		$vyzkum=$politika[vyzkum];
		$obrana=$politika[obrana];
		$utok=$politika[utok];
		$cenaj=$politika[cenaj];
		$spokojenost=$politika[spokojenost];
		$cenap=$politika[cenap];
		$presun=$politika[presun];
		$cenas=$politika[cenas];
		$prodej=$politika[prodej];
		$koupe=$politika[koupe];
		$cenav=$politika[cenav];
		switch($stara){
			case 1: $cenap=$konstantax;
				$obrana=$konstantax;
				$utok=$konstantax;
				$vyzkum=$konstantax;
				$presun=$konstantax;
				$cenaj=$konstantax;
				$spokojenost=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;
				$cenas=$konstantax;
				break;
			case 2:	$vyzkum=$konstantax-10;
				$obrana=$konstantax+10;
				$utok=$konstantax+10;
				$cenaj=$konstantax-15;
				$spokojenost=$konstantax;
                                $cenap=$konstantax;
				$presun=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;
				$cenas=$konstantax;
				break;
			case 3:	$cenaj=$konstantax+15;
				$obrana=$konstantax-10;
				$utok=$konstantax-10;
				$spokojenost=$konstantax+20;
				$vyzkum=$konstantax;
                                $cenap=$konstantax;
				$presun=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;
				$cenas=$konstantax;
				break;
			case 4:	$cenap=$konstantax+35;
				$obrana=$konstantax+20;
				$utok=$konstantax+20;
				$vyzkum=$konstantax+10;
				$presun=100;
				$cenaj=$konstantax;
				$spokojenost=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;
				$cenas=$konstantax;
				break;
			case 5:	$spokojenost=$konstantax-10;
				$cenas=$konstantax+20;
				$cenap=$konstantax-40;
				$cenaj=$konstantax-10;
				$vyzkum=$konstantax;
				$obrana=$konstantax;
				$utok=$konstantax;
				$presun=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;

				break;
			case 6:	$vyzkum=$konstantax+20;
				$obrana=$konstantax+25;
				$koupe=$konstantax-30;
				$prodej=$konstantax+20;
				$utok=$konstantax;
				$cenaj=$konstantax;
				$spokojenost=$konstantax;
                                $cenap=$konstantax;
				$presun=$konstantax;
				$cenas=$konstantax;
				break;
			}
		MySQL_Query("update politika set vyzkum=$vyzkum,obrana=$obrana,utok=$utok,cenaj=$cenaj,spokojenost=$spokojenost,cenap=$cenap where rasa=$rasa1");
        MySQL_Query("update politika set presun=$presun,cenas=$cenas,prodej=$prodej,koupe=$koupe,cenav=$cenav where rasa=$rasa1");

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
		$politika = MySQL_Fetch_Array($politika1);
                $konstanta = 100;

   		$vyzkum=$politika[vyzkum];
		$obrana=$politika[obrana];
		$utok=$politika[utok];
		$cenaj=$politika[cenaj];
		$spokojenost=$politika[spokojenost];
		$cenap=$politika[cenap];
		$presun=$politika[presun];
		$cenas=$politika[cenas];
		$prodej=$politika[prodej];
		$koupe=$politika[koupe];
		$cenav=$politika[cenav];
    	//echo $polit;
		switch($polit){
			case 1: break;
			case 2:	
        		        $vyzkum=$konstanta+10;
				$obrana=$konstanta-10;
				$utok=$konstanta-10;
				$cenaj=$konstanta+15;
				$spokojenost=$konstantax;
                                $cenap=$konstantax;
				$presun=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;
				$cenas=$konstantax;
        		break;
			case 3:	$cenaj=$konstanta-15;
				$obrana=$konstanta+10;
				$utok=$konstanta+10;
				$spokojenost=$konstanta-20;
				$vyzkum=$konstantax;
                                $cenap=$konstantax;
				$presun=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;
				$cenas=$konstantax;
				break;
			case 4:	$cenap=$konstanta-35;
				$obrana=$konstanta-20;
				$utok=$konstanta-20;
				$vyzkum=$konstanta-10;
				$presun=150;
				$cenaj=$konstantax;
				$spokojenost=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;
				$cenas=$konstantax;
				break;
			case 5:	$spokojenost=$konstanta+10;
				$cenas=$konstanta-20;
				$cenap=$konstanta+40;
				$cenaj=$konstanta+10;

				$vyzkum=$konstantax;
				$obrana=$konstantax;
				$utok=$konstantax;
				$presun=$konstantax;
				$koupe=$konstantax;
				$prodej=$konstantax;
				break;
			case 6:	$vyzkum=$konstanta-20;
				$obrana=$konstanta-25;
				$koupe=$konstanta+30;
				$prodej=$konstanta-20;
				$utok=$konstantax;
				$cenaj=$konstantax;
				$spokojenost=$konstantax;
                                $cenap=$konstantax;
				$presun=$konstantax;
				$cenas=$konstantax;
				break;
			}
		$f=$fond[fond]-$cena;
		$p=Date("U");
		MySQL_Query("update vudce set fond=$f where rasa=$rasa1");
		MySQL_Query("update politika set vyzkum=$vyzkum,obrana=$obrana,utok=$utok,cenaj=$cenaj,spokojenost=$spokojenost,cenap=$cenap where rasa=$rasa1");
		MySQL_Query("update politika set presun=$presun,cenas=$cenas,prodej=$prodej,koupe=$koupe,cenav=$cenav,priorita=$polit,posl=$p where rasa=$rasa1");
	endif;
/*
	if(isset($stat)):
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
				$spokojenost=$politika[spokojenost]+15;											$dent=$politika[dent]+10;
				break;
			}
		MySQL_Query("update politika set vyzkum=$vyzkum,obrana=$obrana,utok=$utok,spokojenost=$spokojenost where rasa=$rasa1");
		MySQL_Query("update politika set cenat=$cenat,cena3j=$cena3j,dent=$dent where rasa=$rasa1");

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
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
				$spokojenost=$politika[spokojenost]-15;											$dent=$politika[dent]-10;
				break;
			}
		MySQL_Query("update politika set vyzkum=$vyzkum,obrana=$obrana,utok=$utok,spokojenost=$spokojenost where rasa=$rasa1");
		MySQL_Query("update politika set cenat=$cenat,cena3j=$cena3j,dent=$dent,status=$stat where rasa=$rasa1");
	endif;
	*/

	if(isset($nnar)):
		do{//echo "narod";
		//$posl=$zaznam1[zmenanar]+(86400*2);
		$posl=$zaznam1[zmenanar]+(86400*$kolikdnupocet);
	
		$zmena=Round(($zaznam2[planeta]*$zaznam1[planety]/10));
		$zmena = $zmena * 50;
		$zn=Date("U");
		$pen=$zaznam1[penize]-$zmena;

        if($nnar<1 or $nnar>9){echo "<h1>Tohle ani nezkoušejte. Neplatné zadání národu.</h1>";break;};
		if($zaznam1[penize]<$zmena){echo "<h1>Na zmìnu politiky nemáte dost naquadahu.</h1>";break;};
		if($posl>Date("U")){echo "<h1>Zmìna byla provedena pøíliš nedávno.</h1>";break;};

		MySQL_Query("update `uzivatele` set `narod`='$nnar',`zmenanar`='$zn',`penize`='$pen' where `cislo` = '$logcislo'");
		}while(false);
	endif;

	if(isset($nzri)):
		do{//echo "stat";
		//$posl=$zaznam1[zmenazri]+(86400*2);
		$posl=$zaznam1[zmenazri]+(86400*$kolikdnupocet);
		$zmena=Round(($zaznam2[planeta]*$zaznam1[planety]/10));
		$zn=Date("U");
		$pen=$zaznam1[penize]-$zmena;

        if($nzri<1 or $nzri>9){echo "<h1>Tohle ani nezkoušejte. Neplatné zadání zøízení.</h1>";break;};
		if($zaznam1[penize]<$zmena){echo "<h1>Na zmìnu nemáte dost penìz.</h1>";break;};
		if($posl>Date("U")){echo "<h1>Zmìna byla provedena teprve nedávno.</h1>";break;};

		MySQL_Query("update `uzivatele` set `zrizeni`='$nzri',`zmenazri`='$zn',`penize`='$pen' where `cislo` = '$logcislo'");
		}while(false);
	endif;

	if(empty($vyber)){$vyber=1;};

	$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
	$zaznam1 = MySQL_Fetch_Array($vys1);

	$politika1 = MySQL_Query("SELECT rasa,priorita,status,posl FROM politika where rasa = $rasa1");
	$politika = MySQL_Fetch_Array($politika1);

if($vyber==1):
	echo "<center><font class=text_bili>Máte naquadahu: ".number_format($zaznam1[penize],1,"."," ")."</font></center>";
	echo "<center><h6><font class=text_modry>N</font>árodnost</h6>";

  	$bonusy[1]="Žádné klady";
  	$negativy[1]="Žádné záopry";
  	$bonusy[2]="-20% cena tìžebny";
  	$negativy[2]="-10 útok, +10% cena pìchoty";
  	$bonusy[3]="-5% ceny v obchodì, +5% výzkum";
  	$negativy[3]="+30% cena tìžebny";
  	$bonusy[4]="-5% cena pìchoty, -5% ceny ZHN";
  	$negativy[4]="-20% spokojenost, +20% ceny v obchodì";
 	$bonusy[5]="+20% spokojenost, +10% obrana";
  	$negativy[5]="+20% cena pìchoty, +100% ceny ZHN";
  	$bonusy[6]="+30% na výzkum";
  	$negativy[6]="-15% útok, +100% ceny ZHN";
  	$bonusy[7]="+10% obrana";
  	$negativy[7]="+15% cena pìchoty, -10% útok";
  	$bonusy[8]="+10% spokojenost, +10% na výzkum";
  	$negativy[8]="+50% cena tìžebny, +100% ceny ZHN";
  	$bonusy[9]="-25% cena tìžebny";
  	$negativy[9]="-20% útok";
	$ras=$rasa1."r";
	if($zaznam1[rasa]==20 or $zaznam1[rasa]==0){$ras="1r";};

	$zmena=Round(($zaznam2[planeta]*$zaznam1[planety]/10));
	$zmena = $zmena * 50;

	$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
	$narod = MySQL_Fetch_Array($narod1);
	$vyb1 = MySQL_Query("SELECT * FROM narody");

	echo "<center><font class=text_bili>My jsme v národu <font class=text_modry>".$narod[$ras]."</font>, to znamená <font class=text_modry>".$bonusy[$narod[cislo]]."</font> ale bohužel taky <font class=text_modry>".$negativy[$narod[cislo]]."</font></font></center>";

	echo "<br>";

	echo "<form name='form' method='post' action='hlavni.php?page=politika&vyber=1'><input type='hidden' name='co' value='4'>";
	echo "<center><font class=text_bili>Mùžeme zmìnit národnost jednou za ".$kolikdnu.", zmìna bude stát <font class=text_modry>".number_format($zmena,0,0," ")." kg NAQ</font>.";

	$posl=$zaznam1["zmenanar"]+(86400*$kolikdnupocet);
	if($zaznam1[penize]>$zmena and $posl<Date("U")):
		echo "<br>Zmìnit národnost na <select name='nnar'>";
		while ($vyb = MySQL_Fetch_Array($vyb1)):
			if($vyb[cislo]==$zaznam1[narod]){continue;};
			echo "<option value=".$vyb[cislo].">".$vyb[$ras];
		endwhile;
		echo "</select>&nbsp;&nbsp;<input type=submit value='Zmìò'></font></center>";
	elseif($posl>Date("U")):
		$posl+=60;
		$datum = Date("H:i j.m.Y",$posl);
		echo "<br>Zmìna byla provedena teprve nedávno, další bude možna v $datum";
	else:
		echo "<br>Na zmìnu nemáte dost penìz";
	endif;

	echo "</form><center><h6><font class=text_modry>S</font>eznam národností</h6>";

	$narod1 = MySQL_Query("SELECT * FROM narody");

	echo "<TABLE ".$table." ".$border." align=center>";
	echo "<tr>";
	echo "<th>Jméno</th>";
	echo "<th>Bonusy</th>";
	echo "<th>Negativy</th>";
	echo "<th>Poèet hráèù z rasy (procent)</th>";
	echo "</tr>";

	$hracu = MySQL_Query("SELECT cislo,narod FROM uzivatele where rasa=$rasa1");
	$hr = mysql_num_rows($hracu);

	while($narod = MySQL_Fetch_Array($narod1)):
		$hracuv = MySQL_Query("SELECT cislo,narod FROM uzivatele where (rasa=$rasa1 and narod=$narod[cislo])");
		$pocet = mysql_num_rows($hracuv);
		$proc=Round($pocet/($hr/100));

		echo "<tr>";
		echo "<td class=text_modry>".$narod[$ras]."</td>";
		echo "<td>".$bonusy[$narod[cislo]]."</td>";
		echo "<td>".$negativy[$narod[cislo]]."</td>";
		echo "<td>".$pocet." &nbsp;(".$proc."%)</td>";
		echo "</tr>";
	endwhile;
	echo "</table>";
	/*<form name='form' method='post' action='hlavni.php?page=politika'>
  	<input type='hidden' name='co' value='4'>*/

//******************************************************************************************************

	echo "<center><h6><font class=text_modry>S</font>tátní zøizení</h6>";

  	$bonusy[1]="Žádné klady";
  	$negativy[1]="Žádné zápory";
  	$bonusy[2]="+10% spokojenost";
  	$negativy[2]="-20% útok";
  	$bonusy[3]="-5% cena bojových jednotek";
  	$negativy[3]="-15% spokojenost, +10% cena tìžebny";
  	$bonusy[4]="+10% útok, -10% cena ZHN";
  	$negativy[4]="-25% spokojenost, -10% obrana";
 	$bonusy[5]="+25% na výzkum";
  	$negativy[5]="-10% útok, +50% cena ZHN";
  	$bonusy[6]="+15% obrana, -20% cena ZHN";
  	$negativy[6]="-25% útok";
  	$bonusy[7]="-25% cena tìžebny";
  	$negativy[7]="-10% útok";
  	$bonusy[8]="-30% cena planety";
  	$negativy[8]="-5% útok, +10% cena bojových jednotek";
  	$bonusy[9]="-50% cena ZHN";
  	$negativy[9]="-50% spokojenost";
	$ras=$rasa1."r";
	if($zaznam1[rasa]==20 or $zaznam1[rasa]==0){$ras="1r";};

	$zmena=Round(($zaznam2[planeta]*$zaznam1[planety]/10));
	$zmena = $zmena * 50;

	$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
	$zriz = MySQL_Fetch_Array($zrizeni1);

	$vyb2 = MySQL_Query("SELECT * FROM zrizeni");

	echo "<center><font class=text_bili>Naše státní zøízení je <font class=text_modry>".$zriz[$ras]."</font>, to znamená <font class=text_modry>".$bonusy[$zriz[cislo]]."</font> ale bohužel taky <font class=text_modry>".$negativy[$zriz[cislo]]."</font></font></center>";

	echo "<br>";

	echo "<form name='form' method='post' action='hlavni.php?page=politika&vyber=1'><input type='hidden' name='co' value='4'>";
	echo "<center><font class=text_bili>Mùžeme zmìnit státní zøízení jednou za ".$kolikdnu.", zmìna bude stát <font class=text_modry>".number_format($zmena,0,0," ")." kg NAQ</font>.";

	$posl=$zaznam1["zmenazri"]+(86400*$kolikdnupocet);
	if($zaznam1[penize]>$zmena and $posl<Date("U")):
		echo "<br>Zmìnit státní zøízení na <select name='nzri'>";
		while ($vybb = MySQL_Fetch_Array($vyb2)):
			if($vybb[cislo]==$zaznam1[zrizeni]){continue;};
			echo "<option value=".$vybb[cislo].">".$vybb[$ras];
		endwhile;
		echo "</select>&nbsp;&nbsp;<input type=submit value='Zmìò'></font></center>";
	elseif($posl>Date("U")):
		$posl+=60;
		$datum = Date("H:i j.m.Y",$posl);
		echo "<br>Zmìna byla provedena teprve nedávno, další bude možna v $datum";
	else:
		echo "<br>Na zmìnu nemáte dost penìz";
	endif;

	echo "</form><center><h6><font class=text_modry>S</font>eznam sátních zøizení</h6>";

	$zriz1 = MySQL_Query("SELECT * FROM zrizeni");

	echo "<TABLE ".$table." ".$border." align=center>";
	echo "<tr>";
	echo "<th>Jméno</th>";
	echo "<th>Bonusy</th>";
	echo "<th>Negativy</th>";
	echo "<th>Poèet hráèù z rasy (procent)</th>";
	echo "</tr>";

	$hracu = MySQL_Query("SELECT cislo,narod FROM uzivatele where rasa=$rasa1");
	$hr = mysql_num_rows($hracu);

	while($zriz = MySQL_Fetch_Array($zriz1)):
		$hracuv = MySQL_Query("SELECT cislo,zrizeni FROM uzivatele where (rasa=$rasa1 and zrizeni=$zriz[cislo])");
		$pocet = mysql_num_rows($hracuv);
		$proc=Round($pocet/($hr/100));

		echo "<tr>";
		echo "<td class=text_modry>".$zriz[$ras]."</td>";
		echo "<td>".$bonusy[$zriz[cislo]]."</td>";
		echo "<td>".$negativy[$zriz[cislo]]."</td>";
		echo "<td>".$pocet." &nbsp;(".$proc."%)</td>";
		echo "</tr>";
	endwhile;
	echo "</table>";
endif;

//*********************************************Politika vùdce******************************************************
if ($zaznam1[rasa]==11 or $zaznam1[rasa]==98 ) {echo "<h1>Vyvrhelové nemají vùdce proto nemohou mìnit politiku.</h1>";exit;};
if ($zaznam1[rasa]==97) {echo "<h1>Furlingové nemají vùdce proto nemohou mìnit politiku.</h1>";exit;};

if($vyber==2):
//echo $rasa1;
	$fond1 = MySQL_Query("SELECT rasa,fond FROM vudce where rasa = $rasa1");
	$fond = MySQL_Fetch_Array($fond1);
?>
<form name='form' method='post' action='hlavni.php?page=politika&vyber=2'>
<center><h6><font class=text_modry>P</font>olitika vùdce</h6>
<?
$cena=($zaznam2[uzi]*$zaznam2[vyr_vyrob]*$polc) + 500000;
//echo number_format($fond[fond],0,0," ");
echo "<font class=text_bili>Zmìna se mùže provést jednou za den, zmìna stojí <font class=text_modry>".number_format($cena,0,0," ")." kg NAQ</font></font><br><br>";
$p1=$p2=$p3=$p4=$p5=$p6=0;
switch($politika[priorita]){
		case 1:	$p1="checked";
			$co="nic";
			$pm="nic dobrého ani zlého";
			break;
		case 2:	$p2="checked";
			$co="výzkum";
			$pm="+10% naquadah do výzkumu,-10% obrana,-10% útok,+15% cena jednotek";
			break;
		case 3:	$p3="checked";
			$co="boj";
			$pm="-15% cena jednotek,+10% obrana,+10% útok,-20% spokojenost obyvatel";
			break;
		case 4:	$p4="checked";
			$co="kolonizaci";
			$pm="-35% ceny planety; na nové planetì je již 10 mìst a tedy i 100 mil. lidí, možnost pøesouvat 3mld. dennì,-20% síla,-10% výzkum";
			break;
		case 5:	$p5="checked";
			$co="infrastrukturu";
			$pm="+10 spokojenost obyvatel,-20 cena staveb (kromì kasáren),+10 cena jednotek,+ 40% cena planety";
			break;
			/*
		case 6:	$p6="checked";
			$co="obchod";
			$pm="-20% výzkum,-25% obrana,pøi úspìšném prodeji získá 130% ceny(ale hráè to koupí za nabízenou cenu),pøi úspìšné koupi ztratí jen 80% požadované èástky(ale cizí hráè co to nabízel dostane plnou èástku)";
			break;
		*/
		}

if($zaznam1[status]==1):
$posl=$politika[posl]+86400;//echo $posl;
	if($posl<Date("U") and $cena<$fond[fond]):
		echo "<font class=text_bili><input type=radio name=polit value=1 ".$p1."> Normální";
		echo "<input type=radio name=polit value=2 ".$p2."> Výzkum ";
		echo "<input type=radio name=polit value=3 ".$p3."> Boj ";
		echo "<input type=radio name=polit value=4 ".$p4."> Kolonizace ";
		echo "<input type=radio name=polit value=5 ".$p5."> Infrastruktura ";
		// echo "<input type=radio name=polit value=6 ".$p6."> Obchod ";
		echo "<br><br><input type=submit value='Zmìò'></font>";
		echo "<input type=hidden name='vyber' value='2'>";
	elseif($posl>Date("U")):
		$posl+=60;
		$datum = Date("H:i j.m.Y",$posl);
		echo "<font class=text_bili>Zmìna byla teprve nedávno, další až v $datum</font><br><br>";
		echo "<font class=text_bili>Náš vùdce preferuje <font class=text_modry>".$co."</font>, to znamená ".$pm."</font>";		
	else:
		echo "<font class=text_bili>V rasovém fondu není dost naquadahu.</font><br><br>";
		echo "<font class=text_bili>Náš vùdce preferuje <font class=text_modry>".$co."</font>, to znamená ".$pm."</font>";
	endif;
else:
	echo "<font class=text_bili>Náš vùdce preferuje <font class=text_modry>".$co."</font>, to znamená ".$pm."</font>";
endif;
?>
</form>
<TABLE <? echo $table." ".$border; ?> align=center>
<tr>
<th colspan=2>Politika</th>
</tr>
<tr>
<td class=text_modry>Normální</td>
<td>nic dobrého ani zlého</td>
</tr>
<tr>
<td class=text_modry>Výzkum</td>
<td>+10% naquadah do výzkumu,-10% obrana,-10% útok,+15% cena jednotek</td>
</tr>
<tr>
<td class=text_modry>Boj</td>
<td>-15% cena jednotek,+10% obrana,+10% útok,-20% spokojenost obyvatel</td>
</tr>
<tr>
<td class=text_modry>Kolonizace</td>
<td>-35% ceny planety; na nové planetì je již 10 mìst a tedy i 100 mil. lidí, možnost pøesouvat 3mld. dennì,-20% síla,-10% výzkum</td>
</tr>
<tr>
<td class=text_modry>Infrastruktura</td>
<td>+10 spokojenost obyvatel,-20 cena staveb (kromì kasáren),+10 cena jednotek,+ 40% cena planety</td>
</tr>
<!--
<tr>
<td class=text_modry>Obchod</td>
<td>-20% výzkum,-25% obrana,pøi úspìšném prodeji získá 130% ceny(ale hráè to koupí za nabízenou cenu),pøi úspìšné koupi ztratí jen 80% požadované èástky(ale cizí hráè co to nabízel dostane plnou èástku)</td>
</tr>
-->
</table>
<?/*
<form name='form' method='post' action='hlavni.php?page=politika'>
echo "<br><h6><font class=text_modry>Ch</font>ování rasy</h6>";

$s1=$s2=$s3=0;
switch($politika[status]){
		case 1:	$s1="checked";
			$co="dobré";
			$pm="+10% obrana,+10% spokojenost,+5%výzkum,+25% cena tìžební budovy";
			break;
		case 2:	$s2="checked";
			$co="neutrální";
			$pm="nic dobrého ani zlého";
			break;
		case 3:	$s3="checked";
			$co="zlé";
			$pm="+15% útok,-40% cena 3.jednotky,-15 spokojenost,-10% denní tìžby";
			break;
		}

if($zaznam1[status]==1):
		echo "<font class=text_bili><input type=radio name=stat value=1 ".$s1."> Dobrý ";
		echo "<input type=radio name=stat value=2 ".$s2."> Neutrál ";
		echo "<input type=radio name=stat value=3 ".$s3."> Zlý ";
		echo "<br><input type=submit value='Zmìò'></font>";
else:
	echo "<font class=text_bili>Náš vùdce urèil chování rasy jako <font class=text_modry>".$co."</font>, to znamená ".$pm."</font>";
endif;
?>
</form>

<TABLE <? echo $table." ".$border; ?> align=center>
<tr>
<th colspan=2>Chování</th>
</tr>
<tr>
<td class=text_modry>Dobrý</td>
<td>+10% obrana,+10% spokojenost,+5%výzkum,+25% cena tìžební budovy</td>
</tr>
<tr>
<td class=text_modry>Neutrál</td>
<td>nic dobrého ani zlého</td>
</tr>
<tr>
<td class=text_modry>Zlý</td>
<td>+15% útok,-40% cena 3.jednotky,-15 spokojenost,-10% denní tìžby</td>
</tr>
</table>
</center>
<?*/
endif;
MySQL_Close($spojeni);
?>

