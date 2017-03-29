<?
mysql_query("SET NAMES cp1250");
unset($rot3);
unset($politika);
unset($narod);
unset($zriz);
unset($zaznam2); 
unset($zaznam1);
unset($zpet);
unset($zaz);
unset($politika2);
unset($pl);
unset($prod); 
unset($zaz);
unset($rasa2); 
unset($politika2); 
unset($prod);
unset($od);
unset($brana); 
unset($planeta); 
unset($brana);
unset($obchod);
unset($zaznam3);
unset($planety1);
unset($brana);
unset($rasa);
unset($zaznam3); 
unset($nejl);
unset($cenyr);
unset($zrusit1);
unset($zlevnit1);
unset($planety2);
unset($koupit1);
unset($koupit2);
unset($koupit2b);
unset($planety);
unset($planety_obchod);



    $mezi_ovl=1;

	require "data_1.php";

	$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo='$logcislo'");
	$zaznam1 = MySQL_Fetch_Array($vys1);

	$styl="styl".$zaznam1[""skin""];
	if($zaznam1["skin"]==1 or $zaznam1["skin"]==2 or $zaznam1["skin"]==3 or $zaznam1["skin"]==4){$styl="styl1";};
?>
<script language="JavaScript" src="a.php" >
</script>
<?	
$diletace=72;
if((Date("U")-$zaznam1["vek"])<($diletace*3600)){echo "<font class='text_cerveny'>Nemùžete obchodovat. Nejste tu ještì ani $diletace hodin a tak nejste zapsán v obchodním rejstøíku.</font>";exit;}
if ($zaznam1["rasa"]==11 OR $zaznam1["rasa"]==98 ) {echo "<font class='text_cerveny'>Vyvrhelové nemohou obchodovat.</font><BR><BR><BR><BR><BR>";exit;};
               

?>
<script language="JavaScript">
function zmena(){
document.formw0.co.value=1;
document.formw1.co.value=1;
document.formw2.co.value=1;
alert(document.formw0.co.value);
alert(document.formw1.co.value);
alert(document.formw2.co.value);
}
</script>

<center><h6>
<a href="hlavni.php?page=obchod&co=1" id=a onMouseOver=Rozsvitit('a') onMouseOut=Zhasnout('a')>Prodávání jednotek</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=obchod&co=2" id=b onMouseOver=Rozsvitit('b') onMouseOut=Zhasnout('b')>Prodávání nezamìstnaných</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=obchod&co=3" id=c onMouseOver=Rozsvitit('c') onMouseOut=Zhasnout('c')>Nákup jednotek</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=obchod&co=4" id=d onMouseOver=Rozsvitit('d') onMouseOut=Zhasnout('d')>Ostatní koupì</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=obchod&co=5" id=e onMouseOver=Rozsvitit('e') onMouseOut=Zhasnout('e')>Obchod s planetami</a>
</h6></center>
<?
$query3 = mysql_query("SELECT obchodod FROM uzivatele where cislo='$logcislo'");
$rot3 = mysql_fetch_array($query3);
$obchodod=$rot3["obchodod"];

$casted=Date("U");  
$b=((300-($casted-$obchodod))/60);

if($casted-$obchodod<=300 and $co!=2 and $co!=3 and $co!=4 and $co!=5){echo "<center><font class='text_cerveny'>Další obchod je možný až za ".number_format($b,1,"."," ")." minut</font></center>";die;};


	$trasa=$zaznam1["rasa"];

	require("kontrola.php");

	$politika1 = MySQL_Query("SELECT * FROM politika where rasa ='$trasa'");
	$politika = MySQL_Fetch_Array($politika1);

	$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1["narod"]'");
	$narod = MySQL_Fetch_Array($narod1);

	$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1["zrizeni"]'");
	$zriz = MySQL_Fetch_Array($zrizeni1);

	$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$trasa'");
	$zaznam2 = MySQL_Fetch_Array($vys2);

	if(isset($j1) && $co==1):
		$j1=strip_tags($j1);
		$j2=strip_tags($j2);
		$j3=strip_tags($j3);
		$j4=strip_tags($j4);
		$cj1=strip_tags($cj1);
		$cj2=strip_tags($cj2);
		$cj3=strip_tags($cj3);
		$cj4=strip_tags($cj4);
    
    
    $j1*=1;
		$j2*=1;
		$j3*=1;
		$j4*=1;
		$cj1*=1;
		$cj2*=1;
		$cj3*=1;
		$cj4*=1;
		
    $j1=abs($j1);
		$j2=abs($j2);
		$j3=abs($j3);
		$j4=abs($j4);
		$cj1=abs($cj1);
		$cj2=abs($cj2);
		$cj3=abs($cj3);
		$cj4=abs($cj4);
		do{
			if($j1<0 or $j2<0 or $j3<0 or $j4<0){echo "<font class='text_cerveny'>Èísla musí být vìtší jak nula</font>";break;};

			
      if(Is_double($j1) or Is_double($j2) or Is_double($j3) or Is_double($j4)){echo "<font class='text_cerveny'>Èísla nesmí být desetinné</font>";break;};	
			$j1=abs($j1);
      $j2=abs($j2);
      $j3=abs($j3);
      $j4=abs($j4);
      
      $den=Date("U");
			$minut=rand(1,15);
			$minut=$minut*60;
			$den+=$minut;
			$denn=Date("U");
			
			$cena=$j1*$cj1+$j2*$cj2+$j3*$cj3+$j4*$cj4;
			if ($cena==0 or $cena<0){echo"Asi nic neprodáváte ;)</font>";break;}
      echo "<font class=text_bili>";
			$ocena=($j1*$zaznam2["jed1_cena"]*$politika["cenaj"]/100)+($j2*$zaznam2["jed2_cena"]*$politika["cenaj"]/100)+($j4*$zaznam2["jed4_cena"]*$politika["cenaj"]/100)+($j3*$zaznam2["jed3_cena"]*$politika["cenaj"]/100*$politika["cena3j"]/100);
			if(($cena/$ocena)<=0.75){echo "<font class='text_cerveny'>Zvolená celková cena nesmí být menší jak 75% výrobní ceny</font>";break;};
			if(($cena/$ocena)>=1.05){echo "<font class='text_cerveny'>Zvolená celková cena nesmí být vìtší jak 105% výrobní ceny</font>";break;};
			if (($zaznam1["poslobchod"]+300)>Date("U")){echo "<font class='text_cerveny'>Další jednotky lze do obchodu poslat 5 minut po odeslání pøedchozí nabídky</font>";break;};
			
		if($zaznam1["jed1"]<$j1){echo "<font class='text_cerveny'>Tolik jednotek nemáte</font>";break;};
		if($zaznam1["jed2"]<$j2){echo "<font class='text_cerveny'>Tolik jednotek nemáte</font>";break;};
		if($zaznam1["jed3"]<$j3){echo "<font class='text_cerveny'>Tolik jednotek nemáte</font>";break;};
		if($zaznam1["jed4"]<$j4){echo "<font class='text_cerveny'>Tolik jednotek nemáte</font>";break;};

                        $zjed1=$zaznam1["jed1"]-$j1;
			$zjed2=$zaznam1["jed2"]-$j2;
			$zjed3=$zaznam1["jed3"]-$j3;
			$zjed4=$zaznam1["jed4"]-$j4;

			
			$utok=$zjed1*$zaznam2[""jed1_utok""];
			$utok+=$zjed2*$zaznam2[""jed2_utok""];
			$utok+=$zjed4*$zaznam2[""jed4_utok""];
			$utok+=$zaznam1[""jed5""]*$zold_utok;
			$utok*=$politika["utok"]/100;
			$utok*=$narod["utok"]/100;
			$utok*=$zriz["utok"]/100;
			$obrana=$zjed1*$zaznam2[""jed1_obrana""];
			$obrana+=$zjed2*$zaznam2[""jed2_obrana""];
			$obrana+=$zjed4*$zaznam2[""jed4_obrana""];
			$obrana+=$zaznam1[""jed5""]*$zold_obrana;
			$obrana*=$politika["obrana"]/100;
			$obrana*=$narod["obrana"]/100;
			$obrana*=$zriz["obrana"]/100;
			$sila=$utok+$obrana;
			//echo "<h6>ssssss$sila";
                        $obchodod=Date("U");
			MySQL_Query("update uzivatele set jed1='$zjed1',jed2='$zjed2',jed3='$zjed3',jed4='$zjed4',sila='$sila' where cislo='$logcislo'");	
                        MySQL_Query("update uzivatele set obchodod='$obchodod' where cislo='$logcislo'");					
			//echo $zjed4;
			$nahoda=rand(1,200);
			//echo "$nahoda<br>";				
			if($nahoda==5):
				echo "<centrum><h1>";			
				$nahoda2=rand(1,10);
				switch($nahoda2){
					case 1:	echo "Nìkdo zmìnil cil cesty našich transportních lodí. Ty se objevily v dalekém a neprozkoumaném vesmíru a byly napadeny a znièeny. Nikdo tohle neoèekával a proto byly naše jednotky nepøipravéné a lehce zranitelné. Nikdo nepøežil.";
							$kat=0;break;
					case 2:	echo "Piloti nìkolika našich transportních lodí nezvladli prùlet pásem asteroidù. Ztráty byly 70%.";
							$kat=0.30;break;
					case 3:	echo "Piloti nìkolika našich transportních lodí nezvladli prùlet pásem asteroidù. Ztráty byly 40%.";
							$kat=0.60;break;
					case 4:	echo "Naše pøepravní lodì byly pøepadeny vesmírnými piráty, spoustu našich jednotek povraždili, nìkteøí se k nim pøidali a zbytek prodali do otroctví. Ztráty byly 100%";
							$kat=0;break;
					case 5:	echo "Skupina vesmírných pirátu se pokusila pøepadnout naše transportní lodì. Ubránily se, ale i pøes to ztráty byly veliké. Ztráty byly 35%";
							$kat=0.65;break;
					case 6:	echo "Skupina vesmírných pirátu se pokusila pøepadnout naše transportní lodì. Ubránily se, ale i pøes to byly nìjaké ztráty. Ztráty byly 10%";
							$kat=0.9;break;
					case 7:	echo "Bìhem transportu byly palubní poèítaèe našich transportních lodí napadeny neznámým virem, než se podaøilo vše opravit stih neznámý virus cast lodí zcela znièit. Ztráty byly 50%";
							$kat=0.5;break;
					case 8:	echo "Nìkolika našim pilotùm se nelíbila naše vláda a tak tajne pracovali pro nepøítele. Podaøilo se jim sabotovat celý náš transport. Ztráty byly 100%";
							$kat=0;break;
					case 9:	echo "Ztratili jsme spojení s našimi transportními lodìmi, nikdo neví co se stalo. Vina se pøipisuje na vrub špatnému stavu a zastaralosti našich transportních lodí. Ztráty byly 100%";
							$kat=0;break;
					case 10:echo "Neznámé rase se podaøilo pøevzít kontrolu nad našimi transportními lodìmi. Jejich osud je zøejmì speèetìn. Ztráty byly 100%";
							$kat=0;break;
				};
				echo "</font></centrum>";
				if($kat!=0){
					$j1*=$kat;$j2*=$kat;$j3*=$kat;$j4*=$kat;
					MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,jed2,jed3,jed4,cj1,cj2,cj3,cj4,vyr,typ) VALUES ('$den','$logjmeno','$trasa','$j1','$j2','$j3','$j4','$cj1','$cj2','$cj3','$cj4','$cena','0')");
					MySQL_Query("INSERT INTO obchodlog (datum,cislo,kdo,rasa,pechota,univerzal,zhn,orbit,c1,c2,c3,c4,celkcena) VALUES ('$denn','$logcislo','$logjmeno','$trasa','$j1','$j2','$j3','$j4','$cj1','$cj2','$cj3','$cj4','$cena')");
				};
			else:
			  //if ($zaznam51["datum"]+60<$den){echo "Další ednotky lze do obchodu poslat 60 vteøin po odeslání pøedchozí nabídky";break;};
				MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,jed2,jed3,jed4,cj1,cj2,cj3,cj4,vyr,typ) VALUES ($den,'$logjmeno',$trasa,$j1,$j2,$j3,$j4,$cj1,$cj2,$cj3,$cj4,$cena,0)");
				MySQL_Query("INSERT INTO obchodlog (datum,cislo,kdo,rasa,pechota,univerzal,zhn,orbit,c1,c2,c3,c4,celkcena) VALUES ($denn,$logcislo,'$logjmeno',$trasa,$j1,$j2,$j3,$j4,$cj1,$cj2,$cj3,$cj4,$cena)");
				MySQL_Query("update uzivatele set poslobchod='$denn' where cislo='$logcislo'");
			endif;
		}while(false);
	endif;

	if(isset($smazn)):
		$zpet2 = MySQL_Query("SELECT * FROM obchod where den ='$smazn'");
		$zpet = MySQL_Fetch_Array($zpet2);

		$sila=$zpet["jed1"]*$zaznam2["jed1_utok"]+$zpet["jed1"]*$zaznam2["jed1_obrana"];
		$sila+=$zpet["jed2"]*$zaznam2["jed2_utok"]+$zpet["jed2"]*$zaznam2["jed2_obrana"];
		$sila+=$zpet["jed4"]*$zaznam2["jed4_utok"]+$zpet["jed4"]*$zaznam2["jed4_obrana"];
		$sila+=$zaznam1["sila"];
		
		if($sila>$max_sila){echo "<font class='text_cerveny'>Jednotky se nemùžou vrátit, mìl byste moc velkou sílu.</font>";break;}
		if($zpet["navrhovatel"]!=$zaznam1["jmeno"]){echo "<font class='text_cerveny'>Tyto jednotky nejsou vaše.</font>";break;}

		$zjed1=$zaznam1["jed1"]+($zpet["jed1"]*0.9);
		$zjed2=$zaznam1["jed2"]+($zpet["jed2"]*0.9);
		$zjed3=$zaznam1["jed3"]+($zpet["jed3"]*0.9);
		$zjed4=$zaznam1["jed4"]+($zpet["jed4"]*0.9);
		MySQL_Query("update uzivatele set jed1='$zjed1',jed2='$zjed2',jed3='$zjed3',jed4='$zjed4',sila='$sila' where cislo='$logcislo'");
		MySQL_Query("DELETE FROM obchod WHERE den = '$smazn'");
	endif;

	if(isset($vrat)):
		do{
		$zpet2 = MySQL_Query("SELECT * FROM obchod where den = $vrat");
		$zpet = MySQL_Fetch_Array($zpet2);

		$cena=$zpet["cj1"]*0.5;
		if ($cena<10) {$cena=Round($cena,1); if ($cena==0.2) {$cena=0.1;};}
			else {$cena=Round($cena);};

		MySQL_Query("update obchod set cj1=$cena where den = $vrat");
		}while(false);
	endif;

	if(isset($kup)):
		do{
		$j1=$koliklid*1;

		$vysak2 = MySQL_Query("SELECT * FROM obchod where den = '$kup'");
		$zaz = MySQL_Fetch_Array($vysak2);

		$cj1=$zaz["cj1"];
		$jrasa=$zaz["rasa"];

		$politika22 = MySQL_Query("SELECT rasa,koupe,prodej FROM politika where rasa = '$jrasa'");
		$politika2 = MySQL_Fetch_Array($politika22);

		$planetak = MySQL_Query("SELECT nazev,cislo,mesta,lidi FROM planety where cislo = '$kaml'");
		$pl = MySQL_Fetch_Array($planetak);

		$kcena=$koliklid*$cj1;
    	$pcena=$koliklid*$cj1;

		if($j1>$zaz["jed1"]){echo "<font class='text_cerveny'>Tolik lidí v nabídce není</font>";break;};
		if($j1<0){echo "<font class='text_cerveny'>Èísla musí být vìtší než nula</font>";break;};
		if(($pl["lidi"]+($j1*1000))>($pl["mesta"]*60000000)){echo"<font class='text_cerveny'>Tolik lidí se na cílovou planetu nevejde</font>";break;};
		if($kcena>$zaznam1["penize"]){echo "<font class='text_cerveny'>Tolik naquadahu nemáte.</font>";break;};

		$on=$zaz["navrhovatel"];
		$prodejce = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$on'");
		$prod = MySQL_Fetch_Array($prodejce);

		$posta=$prod["posta2"]+1;
		$postab=$zaznam1["posta2"]+1;
		$pocena=$pcena*($politika2["koupe"]/100);
		$text="Koupil Vámi nabízené obyvatele celkem za ".$pocena."kg naquadahu";
		$textt="Koupil jste nabízené obyvatele celkem za ".$pocena."kg naquadahu";
                $nazev="Obchod s otroky";
		
		$den=Date("U");
		MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,text,stav,nepr,typ,smaz) VALUES ('$den','$zaznam1["jmeno"]','$on','$nazev','$trasa','$textt','1','1','2','0')");
                MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,text,stav,nepr,typ,smaz) VALUES ('$den','$on','$zaznam1["jmeno"]','$nazev','$prod["rasa"]','$text','1','1','2','0')");
	
  
		$p1=$zaznam1["penize"]-($kcena*$politika["prodej"]/100);
		$p2=$prod["penize"]+($pcena*$politika2["koupe"]/100);

		$je1=$pl["lidi"]+($j1*1000);
		MySQL_Query("update planety set lidi='$je1' where cislo='$kaml'");
		MySQL_Query("update uzivatele set penize='$p2', posta2='$posta' where jmeno = '$on'");
		MySQL_Query("update uzivatele set penize='$p1', posta2='$postab' where cislo = '$logcislo'");

		$j1=$zaz["jed1"]-$j1;
		if($j1>0):
			MySQL_Query("update obchod set jed1='$j1' where den = '$kup'");
		else:
			MySQL_Query("delete from obchod where den = '$kup'");
		endif;
		
		}while(false);
	endif;
	
	if(isset($prijm)):
		do{
		$j1*=1;
		$j2*=1;
		$j3*=1;
		$j4*=1;

		$vysak2 = MySQL_Query("SELECT * FROM obchod where den = $prijm");
		$zaz = MySQL_Fetch_Array($vysak2);
		$jrasa=$zaz["rasa"];
		$ras2 = MySQL_Query("SELECT * FROM rasy where rasa = $jrasa");
		$rasa2 = MySQL_Fetch_Array($ras2);

		$politika22 = MySQL_Query("SELECT rasa,koupe,prodej FROM politika where rasa = $jrasa");
		$politika2 = MySQL_Fetch_Array($politika22);

		$cj1=$zaz["cj1"];
		$cj2=$zaz["cj2"];
		$cj3=$zaz["cj3"];
		$cj4=$zaz["cj4"];

		$cj1=($cj1/$rasa2["jed1_cena"])*$zaznam2["jed1_cena"];
		$cj1=Round($cj1);
		$cj2=($cj2/$rasa2["jed2_cena"])*$zaznam2["jed2_cena"];
		$cj2=Round($cj2);
		$cj3=($cj3/$rasa2["jed3_cena"])*$zaznam2["jed3_cena"];
		$cj3=Round($cj3);
		$cj4=($cj4/$rasa2["jed4_cena"])*$zaznam2["jed4_cena"];
		$cj4=Round($cj4);

		//echo $cj3;

		$sj1=$j1*$rasa2["jed1_obrana"]+$j1*$rasa2["jed1_utok"];
		$tsj1=$j1*$zaznam2["jed1_obrana"]+$j1*$zaznam2["jed1_utok"];
		$sj2=$j2*$rasa2["jed2_obrana"]+$j2*$rasa2["jed2_utok"];
		$tsj2=$j2*$zaznam2["jed2_obrana"]+$j2*$zaznam2["jed2_utok"];
		$sj4=$j4*$rasa2["jed4_obrana"]+$j4*$rasa2["jed4_utok"];
		$tsj4=$j4*$zaznam2["jed4_obrana"]+$j4*$zaznam2["jed4_utok"];

		$tsc=$tsj1+$tsj2+$tsj4;
		$tsc+=$zaznam1["sila"];

		if($tsc>150000000){echo "<font class='text_cerveny'>Nesmíte mít sílu vìtší jak 150 miliónù</font>";break;};
		
		$mj2=$mj1=$mj4=$pj4=$pj2=$pj1=0;
			
		if($sj1>0):
			$pomer1=$tsj1/$sj1;
			$pj1=ceil($pomer1*$j1);
			$pomer11=$sj1/$tsj1;			
			$mj1=ceil($pomer11*$zaz["jed1"]);
		endif;
		if($pj1==0 and $j1>0){$pj1=1;};
		if($sj2>0):
			$pomer2=$tsj2/$sj2;
			$pj2=ceil($pomer2*$j2);
			//echo $pomer2.", ".$j2.", ".$pj2;
			$pomer21=$sj2/$tsj2;
			$mj2=Ceil($pomer21*$zaz["jed2"]);
		endif;
		if($pj2==0 and $j2>0){$pj2=1;};
		if($sj4>0):
			$pomer4=$tsj4/$sj4;
			$pj4=ceil($pomer4*$j4);
			//echo $pomer2.", ".$j4.", ".$pj4;
			$pomer41=$sj4/$tsj4;
			$mj4=ceil($pomer41*$zaz["jed4"]);
		endif;
		if($pj2==0 and $j2>0){$pj2=1;};
		$mj3=$zaz["jed3"];
		$pj3=$j3;
		$kcena=$j1*$cj1+$j2*$cj2+$j3*$cj3+$j4*$cj4;
    	$pcena=$zaz["cj1"]*$pj1+$zaz["cj2"]*$pj2+$zaz["cj3"]*$pj3+$zaz["cj4"]*$pj4;
		$pcena*=0.8;
	

		if(($j1>$mj1) or ($j2>$mj2) or ($j3>$mj3) or ($j4>$mj4)){echo "<font class='text_cerveny'>Tolik jednotek v nabídce není</font>";break;};
		if(($j1<0) or ($j2<0) or ($j3<0) or ($j4<0)){echo "<font class='text_cerveny'>Èísla musí být vìtší než nula</font>";break;};
		//if($j1==0 and $j2==0 and $j3==0 and $j4==0){echo "<font class='text_cerveny'>Nula jednotek nelze koupit</font>";break;};
		if($kcena>$zaznam1["penize"]){echo "<font class='text_cerveny'>Tolik naquadahu nemáte.</font>";break;};
    //if((ctype_digit($j1) or ctype_digit($j2) or ctype_digit($j3) or ctype_digit($j4))){echo "<font class='text_cerveny'>Zadána mohou být jen èísla</font>";break;};
		if(Is_double($j1) or Is_double($j2) or Is_double($j3) or Is_double($j4)){echo "<font class='text_cerveny'>Èísla nesmí být desetinné</font>";break;};	
		
		$on=$zaz["navrhovatel"];
		$prodejce = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$on'");
		$prod = MySQL_Fetch_Array($prodejce);

		$posta=$prod["posta2"]+1;
		$pocena=$pcena*($politika2["koupe"]/100);
		$trasa2=Addslashes($zaznam2["nazevrasy"]);
		$jrasa2=Addslashes($rasa2["nazevrasy"]);		
		$text="Koupil Vámi nabízené jednotky celkem za ".$pocena." kg naquadahu";
                $nazev="Prodej jednotek";

		$denp=Date("U");
		MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,rasa2,text,stav,nepr,typ,smaz) VALUES ($denp,'$logjmeno','$on','$nazev','$trasa2','$jrasa2','$text','1','1','2','0')");


		$p1=$zaznam1["penize"]-($kcena*$politika["prodej"]/100);
		$p2=$prod["penize"]+($pcena*$politika2["koupe"]/100);

		$j1=$zaznam1["jed1"]+$j1;
		$j2=$zaznam1["jed2"]+$j2;
		$j3=$zaznam1["jed3"]+$j3;
		$j4=$zaznam1["jed4"]+$j4;

		MySQL_Query("update uzivatele set jed1=$j1,jed2=$j2,jed3=$j3,jed4=$j4,penize=$p1 where cislo=$logcislo");
		MySQL_Query("update uzivatele set penize=$p2, posta2=$posta where jmeno = '$on'");

		$pj1=$zaz["jed1"]-$pj1;
		$pj2=$zaz["jed2"]-$pj2;
		$pj3=$zaz["jed3"]-$pj3;
		$pj4=$zaz["jed4"]-$pj4;

		if(($pj1>0) or ($pj2>0) or ($pj3>0) or ($pj4>0)):
			MySQL_Query("update obchod set jed1=$pj1,jed2=$pj2,jed3=$pj3,jed4=$pj4 where den = $prijm");
		else:
			MySQL_Query("delete from obchod where den = $prijm");
		endif;
		
		}while(false);
	endif;
//--------------gold prodej vsech nezamestnanych

$poc_gold=0;
if ($zaznam1["admin"]==1 or $zaznam1["jmeno"]=='Mario'):
	if(isset($lidipr_gold)):
	
	$plan_gold = MySQL_Query("SELECT cislo FROM planety where cislomaj = $zaznam1["cislo"] AND (status=1 OR status=0)");
	$poc_gold=-1;
  	while($od_gold = MySQL_Fetch_Row($plan_gold)):
	$poc_gold++;
	$odkudl=$od_gold["$poc_gold"];
	
	
	if($lidice<0.1){echo "<font class='text_cerveny'>0.1 je minimální cena. Nezamestnané není možné nabídnout levnìji.</font>";break;};
		
  	do{
			$odkud = MySQL_Query("SELECT majitel,nazev,vyrobna,lidi,sdi,laborator FROM planety where cislo = $odkudl");

			@$od = MySQL_Fetch_Array($odkud);
			$odkudlj=$od["nazev"];
	 //echo MySQL_Error();
			$nez=$od[""lidi""]-$od[""vyrobna""]*$zaznam2["vyr_lidi"];
			$nez-=$od[""sdi""]*$zaznam2["sdi_lidi"];
			$nez-=$od[""laborator""];

			
				$zbylo=$od["lidi"]-$nez;
				$den=Date("U");

				$minut=rand(1,15);
				$minut=$minut*60;
				$den+=$minut;
        $lidipr=$nez;
        
        if ($lidipr>0){
        MySQL_Query("update planety set lidi='$zbylo' where cislo = '$odkudl'");
				MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,cj1,typ) VALUES ('$den','$logjmeno','$zaznam1["rasa"]','$lidipr','$lidice',1)");
				}
			
		}while(false);
	endwhile;
  endif;
  endif;

//----------------------------------------------
	if(isset($lidipr) and $poc_gold<1):
	
	
		do{
			$odkud = MySQL_Query("SELECT * FROM planety where cislo = $odkudl");

			if(!$odkud){
      echo "<font class='text_cerveny'>Planeta "; 
      echo $odkudlj;
      echo"neexistuje</font>";break;};
      
      
			$od = MySQL_Fetch_Array($odkud);
			$odkudlj=$od["nazev"];
			$lidice*=1;
			$lidipr*=1;
      if (is_int($lidipr)):
      
			if($lidipr<=0){echo "<font class='text_cerveny'>Musíte zadávat kladá èísla</font>";break;}
			if($lidice<=0){echo "<font class='text_cerveny'>Musíte zadávat kladá èísla</font>";break;}			
			if($lidice<0.1){echo "<font class='text_cerveny'>0.1 je minimální cena. Nezamestnané není možné nabídnout levnìji.</font>";break;};			
			if($od["majitel"]!=$logjmeno){echo "<font class='text_cerveny'>Planeta ".$odkudl." není Vaše</font>";break;}
			if($lidipr>5000000){echo "<font class='text_cerveny'>Najednou mùžete prodat maximálnì 5 miliard nezamìstnaných</font>";break;};
			
      if($lidipr<=0 OR $lidice<=0 OR $lidice<0.1 OR $od["majitel"]!=$logjmeno OR $lidipr>5000000):
      else:
      $lidipr=abs($lidipr);
      $kolik=$lidipr*1000;

			$nez=$od[""lidi""]-$od[""vyrobna""]*$zaznam2["vyr_lidi"];
			$nez-=$od[""sdi""]*$zaznam2["sdi_lidi"];
			$nez-=$od[""laborator""];

			if($kolik<=$nez):
				$zbylo=$od["lidi"]-$kolik;
				$den=Date("U");

				$minut=rand(1,15);
				$minut=$minut*60;
				$den+=$minut;
        
        MySQL_Query("update planety set lidi='$zbylo' where cislo = '$odkudl'");
				MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,cj1,typ) VALUES ('$den','$logjmeno','$zaznam1["rasa"]','$lidipr','$lidice',1)");
			else:
				echo "<font class='text_cerveny'>Tolik nezamìstnaných lídí na planetì ".$odkudlj." neni.</font>";
			endif;
			endif;
			else: break;
      endif;
		}while(false);
	endif;
  
	if(isset($kupbr)):
		do{
		$br = MySQL_Query("SELECT den,typ,jed1,vyr FROM obchod where (typ=2 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);
		$pl = MySQL_Query("SELECT cislo,nazev,brana,cislomaj FROM planety where cislo=$kamb");
		$planeta = MySQL_Fetch_Array($pl);

		if($brana["vyr"]>$zaznam1["penize"]){echo "<font class='text_cerveny'>Nemáte dost naquadahu</font>";break;};
		if($logcislo!=$planeta["cislomaj"]){echo "<font class='text_cerveny'>Planeta ".$paneta["nazev"]." není vaše.</font>";break;};
		if(0<$planeta["brana"]){echo "<font class='text_cerveny'>Na planetì ".$paneta["nazev"]." už hvìzdná brána je.</font>";break;};
		if(1>$brana["jed1"]){echo "<font class='text_cerveny'>Bohužel v nabídce už žádná brána neni, nìkdo vás pøedbìhl.</font>";break;};

    		$prachy=$zaznam1["penize"]-$brana["vyr"];
    		$branak=$zaznam1["bran"]+1;

		MySQL_Query("update planety set brana=1 where cislo=$kamb");
		MySQL_Query("update uzivatele set penize=$prachy,bran=$branak where cislo=$logcislo");
  
    		$jed1=$brana["jed1"]-1;
    		if($jed1>0):
  			MySQL_Query("update obchod set jed1=$jed1 where (navrhovatel='' and typ=2)");
    		else:
  			MySQL_Query("update obchod set jed1=0 where (navrhovatel='' and typ=2)");  		
    		endif;
		}while(false);
	endif;

	if(isset($zoldaku)):
		do{
		$br = MySQL_Query("SELECT den,typ,jed1,cj1 FROM obchod where (typ=3 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);

		$celkem=$brana["cj1"]*$zoldaku;

		$sila=$zoldaku*($zold_utok*$politika["utok"]/100*$zriz["utok"]/100*$narod["utok"]/100);
		$sila+=$zoldaku*($zold_obrana*$politika["obrana"]/100*$zriz["obrana"]/100*$narod["obrana"]/100);

		if($zoldaku<0){echo "<font class='text_cerveny'>Èíslo musí být vìtší jak dvì</font>";break;};
		if($celkem>$zaznam1["penize"]){echo "<font class='text_cerveny'>Nemáte dost naquadahu</font>";break;};
		if($sila+$zaznam1["sila"]>$max_sila){echo "<font class='text_cerveny'>Mìl byste vìtší sílu než ".$max_sila."</font>";break;};
		if($zoldaku>$brana["jed1"]){echo "<font class='text_cerveny'>Bohužel v nabídce tolik žoldákù není.</font>";break;};

    		$prachy=$zaznam1["penize"]-$celkem;
		$jed5=$zaznam1["jed5"]+$zoldaku;

		MySQL_Query("update uzivatele set penize=$prachy,jed5=$jed5 where cislo=$logcislo");
  
    		$jed1=$brana["jed1"]-$zoldaku;
    		if($jed1>0):
  			MySQL_Query("update obchod set jed1=$jed1 where (navrhovatel='' and typ=3)");
    		else:
  			MySQL_Query("update obchod set jed1=0 where (navrhovatel='' and typ=3)");  		
    		endif;
		}while(false);
	endif;

	

	$vys1 = MySQL_Query("SELECT * FROM `uzivatele` where `cislo`='$logcislo'");
	$zaznam1 = MySQL_Fetch_Array($vys1);
  //echo $zaznam1["jmeno"];

	echo "<center>";

//*******	
//echo "<h6>Celkem máte naquadahu: ".number_format($zaznam1["penize"],2,"."," ")."</h6>";
echo "<h6>Celkem máte naquadahu: ";
//echo number_format($zaznam1["penize"],2,"."," ");
echo number_format($zaznam1["penize"],2,"."," ");
echo"</h6>";
//-------------------------------------------------prodej jednotek----------------------------
if($co==1 or empty($co)):
	echo "<h6><font class=text_modry>P</font>rodej jednotek</h6>";
	echo "<form name='form' method='post' action='hlavni.php?page=obchod'>";
	echo "<input type='hidden' name='co' value='1'>";
	echo "<TABLE ".$table." ".$border." align=center>";
	echo "<tr>";
	echo "<th>typ jednotky</th>";
	echo "<th>máte</th>";
	echo "<th>výrobní cena</th>";
	echo "<th>prodat jednotek</th>";
	echo "<th>cena jedné</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=text_modry>".$zaznam2["jed1_nazev"]."</td>";
	echo "<td>".$zaznam1["jed1"]."</td>";
	echo "<td>".($zaznam2["jed1_cena"]*$politika["cenaj"]/100)."</td>";
	echo "<td><input type='text' name='j1' size=6></td>";
	echo "<td><input type='text' name='cj1' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=text_modry>".$zaznam2["jed2_nazev"]."</td>";
	echo "<td>".$zaznam1["jed2"]."</td>";
	echo "<td>".($zaznam2["jed2_cena"]*$politika["cenaj"]/100)."</td>";
	echo "<td><input type='text' name='j2' size=6></td>";
	echo "<td><input type='text' name='cj2' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=text_modry>".$zaznam2["jed4_nazev"]."</td>";
	echo "<td>".$zaznam1["jed4"]."</td>";
	echo "<td>".($zaznam2["jed4_cena"]*$politika["cenaj"]/100)."</td>";
	echo "<td><input type='text' name='j4' size=6></td>";
	echo "<td><input type='text' name='cj4' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=text_modry>".$zaznam2["jed3_nazev"]."</td>";
	echo "<td>".$zaznam1["jed3"]."</td>";
	echo "<td>".($zaznam2["jed3_cena"]*$politika["cenaj"]/100*$politika["cena3j"]/100)."</td>";
	echo "<td><input type='text' name='j3' size=6></td>";
	echo "<td><input type='text' name='cj3' size=3></td>";
	echo "</tr>";
	echo "</table>";

	echo "<br><input type='submit' value='Odeslat nabídku do obchodu'></td></form>";

	$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel='$logjmeno' and typ=0) order by den desc ");
	echo "<br><h6><font class=text_modry>V</font>aše obchodní nabídky</h6>";
	echo "<center><font class=text_bili>Po odeslání nabídky se Vaše jednotky pøevážejí do vesmírného skladu. To mùže trvat 5 minut, ale také až 60 minut.</font></center><br>";
	echo "<center><font class=text_bili>Pøi zrušení nabídky se vrátí zpìt jen 90% jednotek!</font></center><br>";

	echo "<TABLE ".$table." ".$border." align=center>";
	echo "<tr>";
	echo "<th>Datum nabídnutí</th>";
	echo "<th>status</th>";
	echo "<th>".$zaznam2["jed1_nazev"]."</th>";
	echo "<th>".$zaznam2["jed2_nazev"]."</th>";
	echo "<th>".$zaznam2["jed4_nazev"]."</th>";
	echo "<th>".$zaznam2["jed3_nazev"]."</th>";
	echo "<th>Celková cena</th>";
	echo "<th>&nbsp;</th>";
	echo "</tr>";
		
	$ted=Date("U");
	//echo "<h6><br>";
	//echo $ted."<br>";
	while($obchod = MySQL_Fetch_Array($obch)):
			$den=$obchod["den"];
	//echo $den."<br>";
			$datum = Date("j.m.Y",$den);
			
			echo "<tr><form name='form' method='post' action='hlavni.php?page=obchod' >";
			echo "<td class=text_modry>".$datum."</td>";

			if($den>$ted):
				echo "<td><font color='red'>&nbsp;&nbsp;transport&nbsp;&nbsp;</td>";
			else:
				echo "<td><font color='green'>&nbsp;&nbsp;nabízeno&nbsp;&nbsp;</font></td>";	
			endif;
			

			if($obchod["jed1"]>0):
				echo "<td>".$obchod["jed1"]." * po ".$obchod["cj1"]."NQ</td>";
				$celkem+=$obchod["jed1"]*$obchod["cj1"];
			else:
				echo "<td>N/A</td>";
			endif;

			if($obchod["jed2"]>0):
				echo "<td>".$obchod["jed2"]." * po ".$obchod["cj2"]."NQ</td>";
				$celkem+=$obchod["jed2"]*$obchod["cj2"];
			else:
				echo "<td>N/A</td>";
			endif;

			if($obchod["jed4"]>0):
				echo "<td>".$obchod["jed4"]." * po ".$obchod["cj4"]."NQ</td>";
				$celkem+=$obchod["jed4"]*$obchod["cj4"];
			else:
				echo "<td>N/A</td>";
			endif;

			if($obchod["jed3"]>0):
				echo "<td>".$obchod["jed3"]." * po ".$obchod["cj3"]."NQ</td>";
				$celkem+=$obchod["jed3"]*$obchod["cj3"];
			else:
				echo "<td>N/A</td>";
			endif;
			
			echo "<td>".$celkem." kg </td>";
			echo "<td><input type='submit' value='zruš nabídku'>
				<input type='hidden' name='smazn' value=".$den.">
				<input type='hidden' name='co' value='1'>
			      </td>";
			echo "</form></tr>";
			$celkem=0;
	endwhile;
	echo "</table>";
endif;

//-------------------------------------------------prodej nezamìstnaných----------------------------------
if($co==2):

//if ($logcislo==1001548):

	if(isset($nastaveni)):
	
  	do{

			if($nastaveni<=0){echo "<font class='text_cerveny'>Musíte zadávat kladá èísla</font>";break;}			
			if($nastaveni<0.1){echo "<font class='text_cerveny'>0.10 je minimální cena. Nezamìstnané není možné nabídnout levnìji.</font>";break;};			
                        if(Is_double($nastaveni)){echo "<font class='text_cerveny'>Èísla nesmí být desetinné</font>";break;};	
    	                if($nastaveni<0){echo "<font class='text_cerveny'>Èísla musí být vìtší jak nula</font>";break;};
         
                       if(!( is_numeric($nastaveni))){echo "<font class='text_cerveny'>Zadána mohou být jen èísla</font>";break;};
$nastaveni=abs($nastaveni);

		$nas = MySQL_Query("SELECT nastaveniobch FROM uzivatele where cislo='$logcislo' ");
		$nass = MySQL_Fetch_Array($nas);

		MySQL_Query("update uzivatele set nastaveniobch='$nastaveni' where cislo='$logcislo'");
  
		}while(false);
	endif;

		$nas1 = MySQL_Query("SELECT `nastaveniobch` FROM `uzivatele` WHERE `cislo` ='$logcislo'"); 
    //MySQL_Error();
		$nass = MySQL_Fetch_Array($nas1);
    

	if($politika["status"]==3):
		echo "<h6><font class=text_modry>P</font>rodej nezamìstnaných</h6>";

		$pla = MySQL_Query("SELECT * FROM planety where cislomaj=$logcislo order by nazev desc");

		echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";
		echo "<table>";
		echo "<tr>";
		echo "<td>Z jaké planety prodat </td>";
		echo "<td><select name='odkudl'>";
		while ($zaznam3 = MySQL_Fetch_Array($pla)):
			$check="";
			if($zaznam3[""cislo""]==$odkudl){$check="selected";};
			echo "<option value='".$zaznam3[""cislo""]."' ".$check.">".$zaznam3[""nazev""];
		endwhile;
    		echo "</select>";
		echo "</td></tr><tr>";
		echo "<td>Kolik tisíc nez. prodat</td>";
		echo "<td><input type='text' name='lidipr' size=8>
                      <input type='hidden' name='lidice' value=".$nass["nastaveniobch"]."></td>";
		echo "</tr><tr>";
		echo "<td colspan=2><input type='submit' value='prodat'></form></td>";
		echo "</tr><tr>";


		echo "<td>Nastavit cenu za tisíc nezamìstnaných</td>";
                echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";	
		echo "<td><input type='text' name='nastaveni' size=5 value=".$nass["nastaveniobch"]."></td>";
		echo "</tr><tr>";
                echo "<td colspan=2><input type='submit' value='nastavit'></form></td>";
                echo "</tr><tr>";
		
  if ($zaznam1["gold"]==1 or $zaznam1["silver"]==1 or  $zaznam1["jmeno"]=='Mario'):  
    echo "<td>Prodat všechny nezamìstnané ze všech planet (zatim nefunkcni ;) )</td>";
    echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";	
		echo "<input type='hidden' name='lidice' value=".$nass["nastaveniobch"].">";
    echo "<input type='hidden' name='lidipr_gold' value='1'>";
    echo "</tr><tr>";
    echo "<td colspan=2><input type='submit' value='prodat'></form></td>";
	endif;	
    
    echo "</tr></table>";		

	
		$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel='$logjmeno' and typ='1') order by den desc ");

		echo "<TABLE ".$table." ".$border." align=center>";
		echo "<tr>";
		echo "<th>Datum nabídnutí</th>";
		echo "<th>status</th>";
		echo "<th>nezamìstnaných (v tisících M)</th>";
		echo "<th>cena za tisíc nezamìstnaných</th>";
		echo "<th>Celková cena</th>";
		echo "<th>&nbsp;</th>";
		echo "</tr>";

		$ted=Date("U");
		while($obchod = MySQL_Fetch_Array($obch)):
			$den=$obchod["den"];
			$datum = Date("j.m.Y",$den);
			echo "<tr><form name='form' method='post' action='hlavni.php?page=obchod' >";
			echo "<td>".$datum."</td>";

			if($den>$ted):
				echo "<td><font color='red'>&nbsp;&nbsp;transport&nbsp;&nbsp;</td>";
			else:
				echo "<td><font color='green'>&nbsp;&nbsp;nabízeno&nbsp;&nbsp;</font></td>";	
			endif;

			echo "<td>".$obchod["jed1"]."</td>";
			echo "<td>".$obchod["cj1"]."</td>";			
			echo "<td>".($obchod["jed1"]*$obchod["cj1"])."</td>";
			echo "<td>
				<input type='submit' value='slevnit o 50%'>
				<input type='hidden' name='vrat' value=".$den.">
				<input type='hidden' name='co' value='2'>
			      </td>";
			echo "</form></tr>";
		endwhile;
		echo "</table>";
		

		echo "<h6><font class=text_modry>S</font>eznam planet</h6>";

		$pla = MySQL_Query("SELECT * FROM planety where cislomaj='$logcislo' order by nazev desc");

		echo "<TABLE ".$table." ".$border." align=center>";
		echo "<tr>";
		echo "<th>název planet</th>";
		echo "<th>poèet mìst</th>";
		echo "<th>celkem lidí (v tis.M)</th>";
		echo "<th>z toho nezamìstnaných (v tis.M)</th>";
		echo "</tr>";

		while($planety1 = MySQL_Fetch_Array($pla)):
			$nez=$planety1[""lidi""]-$planety1[""vyrobna""]*$zaznam2["vyr_lidi"];
			$nez-=$planety1[""sdi""]*$zaznam2["sdi_lidi"];
			$nez-=$planety1[""laborator""]*$zaznam2["lab_lidi"];
			$nez=Floor($nez/1000);
			$lidi=Floor($planety1[""lidi""]/1000000);
		$nas = MySQL_Query("SELECT nastaveniobch FROM uzivatele where cislo='$logcislo' ");
		$nass = MySQL_Fetch_Array($nas);
			echo "<tr>";
			echo "<td class=text_modry>".$planety1["nazev"]."</td>";
			echo "<td>".$planety1["mesta"]."</td>";
			echo "<td>".number_format($lidi,0,0," ")."</td>";
                        echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";
                        echo "<td>
                        <input type='hidden' name='lidice' value=".$nass["nastaveniobch"].">
                        <input type='hidden' name='lidipr' value=".$nez.">
                        <input type='hidden' name='odkudl' value=".$planety1["cislo"].">";
		      
          //  <input type='submit' value=".number_format($nez,0,0," ")."></td>";
		        
echo "<input type='submit' value='";
echo floor($nez);
echo"'></td>";
		        
			echo "</form></tr>";
		endwhile;

	else:
		echo "<font class='text_cerveny'>Jen rasy se statusem zlý mùžou prodávat lidi.</font>";
	endif;

	echo "</table>";
//else:
///echo"opravuje se....";
endif;//endif;

//-------------------------------------------------koupì jednotek----------------------------------
if($co==3):
	echo "<h6><font class=text_modry>K</font>oupì nájemných vrahù</h6>";
		$br = MySQL_Query("SELECT den,typ,jed1,cj1 FROM obchod where (typ=3 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);
		$cena=$brana["cj1"];
		$cas=$brana["den"];
		$kolik=$brana["jed1"];
		$ted=Date("U");
		$zmena=3;
		$sek=($zmena*60)-($ted-$cas);

		switch ($sek){
			case 1: $sekslovy="sekunda";break;
			case 2:
			case 3:
			case 4: $sekslovy="sekundy";break;
			default: $sekslovy="sekund";		
		}

		echo "<font class=text_bili align=center>Zde je možno najmout nové nájemné vrahy, jde o neutrální nabídku. Nabídka se mìní každé ".$zmena." minuty. Další zmìna bude za <font class=text_modry>".$sek."</font> ".$sekslovy."</font>";

		if($ted>($cas+60*$zmena)):
			$bran=7500;
			$bran=Round($bran);
			$katar=rand(-2,4);
			$kolik=rand($bran/2,$bran);
			//echo "<h6>",$katar;
			$cas=$ted;
			//----------$cena=$zaznam2[""vyr_vyrob""]*$zold_cena*(1+$katar/10);
			$cena=$zaznam2[""vyr_vyrob""]*(1+$katar/10);
			$cena*=45;

			MySQL_Query("update obchod set cj1=$cena,den=$cas,jed1=$kolik where (navrhovatel = '' and typ=3)");
			MySQL_Query("INSERT INTO `obchod` VALUES (1083404776, '', 0, 62, 0, 0, '0.0', '0.0', '0.0', 291600000, 0, '0.0', 3,0);");
		endif;

		if($kolik>0):
			switch ($kolik){
				case 1: $pred="je nabízena";$slovo="brána";break;
				case 2:
				case 3:
				case 4: $pred="jsou nabízeny";$slovo="brány";break;
				default: $pred="je nabízeno";$slovo="bran";		
			}

			if($sila<50000000):
				$mjed=Floor($zaznam1["penize"]/$cena);
				if($mjed>$kolik){$mjed=$kolik;};

				if($zold_mist==0):$zold_lidi="nezabírají";
				else:$zold_lidi=$zold_mist;
				endif;
  				echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='3'>";
	echo "<TABLE ".$table." ".$border." align=center width=100%>";
				echo "<tr>";
				echo "<th>typ jednotky</th>";
				echo "<th>útok / obrana</th>";
				echo "<th>míst v kasárnách</th>";
				echo "<th>cena</th>";
				echo "<th>je v nabídce</th>";
				echo "<th>máte na</th>";
				echo "<th>chcete koupit</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class=text_modry>".$zold_nazev."</td>";
				echo "<td>".($zold_utok*$politika["utok"]/100*$zriz["utok"]/100*$narod["utok"]/100)."/".($zold_obrana*$politika["obrana"]/100*$zriz["obrana"]/100*$narod["obrana"]/100)."</td>";
				echo "<td>".$zold_lidi."</td>";
				echo "<td>".$cena."</td>";
				echo "<td>".$kolik."</td>";
				echo "<td>$mjed</td>";
				echo "<td><input type='text' name='zoldaku'></td>";
				echo "<td><input type='submit' value='Koupit'></td>";
				echo "</tr>";

	 			echo "</table></form>";
  			else:
			  	echo "<br><br><center><font class=text_bili><b>Máte už maximální sílu</b></font></center>";	
	  		endif;
		else:
			echo "<br><br><center><font class=text_bili><b>Žádní Nájemní vrazi nejsou nyní k dispozici.</b></font></center>";	
		endif;


	echo "<h6><font class=text_modry>N</font>ákup jednotek</h6>";
	$den=Date("U");
	if(empty($xr) or $xr<0){$xr=1;};
	$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel!='$logjmeno' and typ=0 and den<$den) order by den desc limit $xr,30");

	echo "<TABLE ".$table." ".$border." align=center width=100%>";
	echo "<tr>";
	echo "<th>èas a datum nabídnutí</th>";
	echo "<th>".$zaznam2["jed1_nazev"]."</th>";
	echo "<th>".$zaznam2["jed2_nazev"]."</th>";
	echo "<th>".$zaznam2["jed4_nazev"]."</th>";
	echo "<th>".$zaznam2["jed3_nazev"]."</th>";
	echo "<th>&nbsp;</th>";
	echo "</tr>";

	while($obchod = MySQL_Fetch_Array($obch)):
			$den=$obchod["den"];
			$datum = Date("G:i j.m.Y",$den);

				$urasa=$obchod["rasa"];		
				$rasa2 = MySQL_Query("SELECT * FROM rasy where rasa = $urasa");
				$rasa = MySQL_Fetch_Array($rasa2);
	
				$pj1=$j1=$obchod["jed1"];
				$pj2=$j2=$obchod["jed2"];
				$j3=$obchod["jed3"];
				$pj4=$j4=$obchod["jed4"];
				$cj1=$obchod["cj1"];
				$cj2=$obchod["cj2"];
				$cj3=$obchod["cj3"];
				$cj4=$obchod["cj4"];
				
	  	    
echo "<font class=text_bili>";
				if($urasa!=$trasa):
					$sj1=$j1*$rasa["jed1_obrana"]+$j1*$rasa["jed1_utok"];
					$tsj1=$j1*$zaznam2["jed1_obrana"]+$j1*$zaznam2["jed1_utok"];
					$sj2=$j2*$rasa["jed2_obrana"]+$j2*$rasa["jed2_utok"];
					$tsj2=$j2*$zaznam2["jed2_obrana"]+$j2*$zaznam2["jed2_utok"];
					$sj4=$j4*$rasa["jed4_obrana"]+$j4*$rasa["jed4_utok"];
					$tsj4=$j4*$zaznam2["jed4_obrana"]+$j4*$zaznam2["jed4_utok"];
					if($sj1>0 and $tsj1>0):
						$pomer1=$sj1/$tsj1;
						$pj1=Round($pomer1*$j1);
      					//echo $pj1."<br>";
					endif;
					if($sj2>0 and $tsj2>0):
						$pomer2=$sj2/$tsj2;
						$pj2=Round($pomer2*$j2);
      					//echo $pj2."<br>";
					endif;
					if($sj4>0 and $tsj4>0):
						$pomer4=$sj4/$tsj4;
						$pj4=Round($pomer4*$j4);
      					//echo $pj4."<br>";
					endif;
					$cj1=($cj1/$rasa["jed1_cena"])*$zaznam2["jed1_cena"];
					$cj1=Round($cj1);
					$cj2=($cj2/$rasa["jed2_cena"])*$zaznam2["jed2_cena"];
					$cj2=Round($cj2);
					$cj3=($cj3/$rasa["jed3_cena"])*$zaznam2["jed3_cena"];
					$cj3=Round($cj3);
					$cj4=($cj4/$rasa["jed4_cena"])*$zaznam2["jed4_cena"];
					$cj4=Round($cj4);
				endif;

			echo "<tr><form name='form' method='post' action='hlavni.php?page=obchod' >";
			echo "<td class=text_modry>".$datum."</td>";
			
			if($obchod["jed1"]>0):
				echo "<td><input type='text' name='j1' size=5 value=$pj1> krát po ".$cj1."kg</td>";
				$celkem+=$obchod["jed1"]*$obchod["cj1"];
	
    	   if($pj1<0){echo "<font class='text_cerveny'>Èísla musí být vìtší jak nula</font>";break;};
         //if(!(ctype_digit($pj1))){echo "<font class='text_cerveny'>Zadána mohou být jen èísla</font>";break;};	
			//if(!(is_numeric($pj1))){echo "<font class='text_cerveny'>Zadána mohou být jen èísla</font>";break;};	
			if(!(is_numeric($pj1))){echo "<font class='text_cerveny'>Zadána mohou být jen èísla</font>";break;};	
			
      
      else:
				echo "<td>Nenabízí</td>";
			endif;

			if($obchod["jed2"]>0):
				echo "<td><input type='text' name='j2' size=5 value=$pj2> krát po ".$cj2."kg</td>";
				$celkem+=$obchod["jed2"]*$obchod["cj2"];
			else:
				echo "<td>Nenabízí</td>";
			endif;

			if($obchod["jed4"]>0):
				echo "<td><input type='text' name='j4' size=5 value=$pj4> krát po ".$cj4."kg</td>";
				$celkem+=$obchod["jed4"]*$obchod["cj4"];
			else:
				echo "<td>Nenabízí</td>";
			endif;

			if($obchod["jed3"]>0):
				echo "<td><input type='text' name='j3' size=5 value=$j3> krát po ".$cj3."kg</td>";
				$celkem+=$obchod["jed3"]*$obchod["cj3"];
			else:
				echo "<td>Nenabízí</td>";
			endif;

			echo "<td>
				<input type='submit' value='nakoupit'>
				<input type='hidden' name='prijm' value=".$den.">
				<input type='hidden' name='co' value='3'>
			      </td>";
			echo "</form></tr>";	

	endwhile;
	echo "</table></center>";	
	$y=$xr+50;
	$z=$xr-50;
	echo "<h6><a href=hlavni.php?page=obchod&xr=".$z."&co=3 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>pøedchozích 50 nabídek</a><br>";
	echo "<a href=hlavni.php?page=obchod&xr=".$y."&co=3 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>dalších 50 nabídek</a></h6>";	
endif;

//-------------------------------------------------ostatní koupì----------------------------------------------------
if($co==4):
		echo "<h6><font class=text_modry>N</font>ákup hvìzdných bran</h6>";
		$br = MySQL_Query("SELECT den,typ,jed1,vyr FROM obchod where (typ=2 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);
		$cena=$brana["vyr"];
		$cas=$brana["den"];
		$kolik=$brana["jed1"];
		$ted=Date("U");
		$zmena=3;

		$sek=($zmena*60)-($ted-$cas);

		switch ($sek){
			case 1: $sekslovy="sekunda";break;
			case 2:
			case 3:
			case 4: $sekslovy="sekundy";break;
			default: $sekslovy="sekund";		
		}

		echo "<font class=text_bili align=center>Zde je možno koupit hvìzdné brány, jde o neutrální nabídky. Nabídka se mìní každé ".$zmena." minuty. Pøíští zmìna bude za <span><font class=text_modry>".$sek."</font></span> ".$sekslovy."</font>";

		if($ted>($cas+60*$zmena)):
			$bran=$zaznam1["bran"]+($zaznam1["bran"]/2)+1;
			$bran=Round($bran);
			$katar=rand(1,$bran);
			$kolik=rand(1,$bran);
			//echo "<h6>",$katar;
			$cas=$ted;
			$cena=$zaznam2[""bra_cena""]*2*$katar*$katar*15000;
			MySQL_Query("update obchod set vyr='$cena',den='$cas',jed1='$kolik' where (navrhovatel = '' and typ=2)");
			MySQL_Query("INSERT INTO `obchod` VALUES (1083404775, '', 0, 62, 0, 0, '0.0', '0.0', '0.0', 291600000, 0, '0.0', 2,0);");
		endif;

		if($kolik>0):
			switch ($kolik){
				case 1: $pred="je nabízena";$slovo="brána";break;
				case 2:
				case 3:
				case 4: $pred="jsou nabízeny";$slovo="brány";break;
				default: $pred="je nabízeno";$slovo="bran";		
			}

			$pla = MySQL_Query("SELECT brana,cislomaj FROM planety where (cislomaj=$logcislo and brana=1) order by nazev desc");
			$hbran = mysql_num_rows($pla);
			
			if($hbran<$zaznam1["planety"]):
          $pla = MySQL_Query("SELECT * FROM planety where (cislomaj=$logcislo and brana=0) order by nazev desc");
	  			echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='4'>";
			  	echo "<table>";
  				echo "<tr>";
		  		echo "<td>Na kterou planetu si pøejete hvìzdnou bránu koupit</td>";
	  			echo "<td><select name='kamb'>";
			  	while ($zaznam3 = MySQL_Fetch_Array($pla)):
					  echo "<option value=".$zaznam3[""cislo""].">".$zaznam3[""nazev""];
  				endwhile;
		   		echo "</select>";
			  	echo "</td></tr><tr>";
  				echo "<td>Hvìzdná brána stojí</td>";

	  			echo "<td>".number_format($cena,0,0," ")." kg</td>";
			  	echo "</tr><tr>";
  				echo "<td colspan=2>Za tuto cenu ".$pred." ".$kolik." ".$slovo."</td>";
		  		echo "</tr><tr>";
	  			if($cena>$zaznam1["penize"]):
			  		echo "<td colspan=2>Vy na ní bohužel nemáte.</form></td>";			
  				else:
		  			echo "<td colspan=2>
	  				<input type='hidden' name='co' value='4'>
			  		<input type='submit' value='koupit'>
					  <input type='hidden' name='kupbr' value=".$cas.">
  					</form>
			       </td>";
			  	endif;
  				echo "</tr></table>";
	  		else:
			  	echo "<br><br><center><font class=text_bili><b>Na všech našich planetách máme hvìzdné brány.</b></font></center>";	
  			endif;
		else:
			echo "<br><br><center><font class=text_bili><b>Momentálnì není nabízena žádná hvìzdná brána. Pøijïte pozdìji.</b></font></center>";	
		endif;
		
//*************************
		echo "<h6><font class=text_modry>N</font>ákup nezamìstnaných</h6>";

		$den=Date("U");

		$nej=MySQL_Query("SELECT den,typ,jed1,cj1,navrhovatel FROM obchod where (typ=1 and navrhovatel!='$zaznam1["jmeno"]' and den<$den) order by cj1");
		@$nejl = MySQL_Fetch_Array($nej);

		if($nejl):
			//$nejl = MySQL_Fetch_Array($nej);
			$den=$nejl["den"];
			$koliklid=$nejl["jed1"];
			$nejlev=$nejl["cj1"];
			$mamna=Floor($zaznam1["penize"]/$nejl["cj1"]);

			$pla = MySQL_Query("SELECT * FROM planety where cislomaj=$logcislo order by nazev asc");

			echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";
			echo "<table>";
			echo "<tr>";
			echo "<td>Na jakou planetu koupit nezamìstnané</td>";
			echo "<td><select name='kaml'>";
			while ($zaznam3 = MySQL_Fetch_Array($pla)):
				$check="";
				if($zaznam3[""cislo""]==$kaml){$check="selected";};			
				echo "<option value=".$zaznam3[""cislo""]." $check>".$zaznam3[""nazev""];
			endwhile;
	    		echo "</select>";
			echo "</td></tr><tr>";
			echo "<td>Kolik nezamìstnaných chcete koupit (v tisících)</td>";
			echo "<td><input type='text' name='koliklid' size=8 value=".$koliklid."></td>";
			echo "</tr><tr>";
			echo "<td>1000 nezamìstnaných je momentálnì nabízen za</td>"; 
			echo "<td>".$nejlev." kg</td>";
			echo "</tr><tr>";
			echo "<td>za tuto cenu si mùžete koupit</td>"; 
			echo "<td>".$mamna." tisíc nezamìstnaných</td>";
			echo "</tr><tr>";
			echo "<td colspan=2>
				<input type='hidden' name='co' value='4'>
				<input type='submit' value='koupit'>
				<input type='hidden' name='kup' value=".$den.">
				</form>
			       </td>";
			echo "</tr></table>";		

			echo "<h6><font class=text_modry>S</font>eznam planet</h6>";

			$pla = MySQL_Query("SELECT * FROM planety where cislomaj='$logcislo' order by nazev asc");

			echo "<TABLE ".$table." ".$border." align=center>";
			echo "<tr>";
			echo "<th>název planety</th>";
			echo "<th>poèet mìst na planetì</th>";
			echo "<th>lidí na planetì (v tisících)</th>";
			echo "<th>zbývá míst pro lidi (v tisících)</th>";
			echo "</tr><h6>";

			while($planety1 = MySQL_Fetch_Array($pla)):
				$lidi=Floor($planety1[""lidi""]/1000);
				$zbylo=$planety1["mesta"]*60000;
				$zbylo-=$lidi;
				echo "<tr>";
				echo "<td class=text_modry>".$planety1["nazev"]."</td>";
				echo "<td>".$planety1["mesta"]."</td>";
				echo "<td>".number_format($lidi,0,0," ")."</td>";
				echo "<td>".number_format($zbylo,0,0," ")."</td>";
				echo "</tr>";
			endwhile;
		else:
			echo "<center><font class=text_bili><b>Nikdo nezamìstnané nenabízí.</b></font></center>";		
		endif;

			echo "</table>";


endif;
//---------------------------------nove
//_____________________OBCHOD s PLANETAMI_______________________________________
if($co==5):

//maxcena----------------
 if ($cenaplanety>1000000000):echo"<H>Pøíliš velká èástka!!!</H>";
 else:
//----------------- 

if ($zaznam1["admin"]==1)
{
$uprava = MySQL_Query("UPDATE `uzivatele` SET `plan_koupe` = '0'  WHERE   `plan_koupe` = '4'");
$uprava = MySQL_Query("UPDATE `uzivatele` SET `plan_prodej` = '0'  WHERE   `plan_prodej` = '4'");
}

//----------------------------if ($zaznam1["admin"]==1 or $zaznam1["jmeno"]==TestMan):
////ceny vyrob
$poc=1;
$vysceny = MySQL_Query("SELECT vyr_vyrob FROM rasy order by rasa ASC");
while($cenyr = MySQL_Fetch_Array($vysceny)):
$ceny["$poc"]=$cenyr["vyr_vyrob"];

$poc++;if ($poc==11){$poc=97;}
endwhile;
//////////////////zruseni
if ($zrusit!=null){
$vyspz1 = MySQL_Query("SELECT id,den,prodejce,cislo,cena,typ,mesta,vyrobna,spokojenost,rasa FROM obchod_planety where cislo='$zrusit'");
$zrusit1= MySQL_Fetch_Array($vyspz1);

$vyspz3 = MySQL_Query("update planety set majitel='$zrusit1["prodejce"]',cislomaj='$zaznam1["cislo"]' where  cislo='$zrusit1["cislo"]'"); 
$vyspz3a= MySQL_Query("DELETE FROM obchod_planety WHERE cislo='$zrusit'");
//$zaznam1["planety"]=$zaznam1["planety"]+1;
 //     $vyspp3= MySQL_Query("update uzivatele set planety='$zaznam1["planety"]' where  jmeno='$zaznam1["jmeno"]'");
$pocet_plan=$zaznam1["plan_prodej"]-1;
    $vyspp3= MySQL_Query("update uzivatele set plan_prodej='$pocet_plan' where  jmeno='$zaznam1["jmeno"]'"); 

}
////////////////////sleva
if($zlevnit!=null){
///echo $zlevnit;
$vyspzl1 = MySQL_Query("SELECT cena FROM obchod_planety where cislo='$zlevnit'");
$zlevnit1= MySQL_Fetch_Array($vyspzl1);
//echo "<br>".$zlevnit1["cena"]."";
$zlevnit1["cena"]=$zlevnit1["cena"]-($zlevnit1["cena"]/10.0);
//echo "<br>".$zlevnit1["cena"]."";

if ($zlevnit1["cena"]<=1){ $zlevnit1["cena"]=1;}

$vysp3 = MySQL_Query("update obchod_planety set cena='$zlevnit1["cena"]' where  cislo='$zlevnit'"); 
}

////____________________vlozeni planety do obchodu__________________________________________________
////////////////////////////////////////////////////////////////////////////////////////////////////

$castedp=Date("U");
$time_obch_plan_p=$zaznam1["'time_obch_plan_p'"];
$casb=(30-($castedp-$time_obch_plan_p));

if(($castedp-$time_obch_plan_p)<30){echo "<center><font class='text_cerveny'>Další prodej je možný až za ".$casb."s</font></center>";}                   
if((($castedp-$time_obch_plan_p)>=30) or $zaznam1["admin"]==1):

////////////////////////////////////////////////////////////////////////////////////////////////////
/////min pocet planet!!!!!
$min_pocet_planet=25;

if ($zaznam1["admin"]==1){
$min_pocet_planet=0; 
};



if ($zaznam1["planety"]>$min_pocet_planet):
//////////////////////////

if ($zaznam1["plan_prodej"]<4){
$casp=Date("U");
$cas_p=$casp-(3600*24);
if ($zaznam1["poc_prodej"]>=3 and $zaznam1["prodej_cas"]<=$cas_p ){
$zaznam1["poc_prodej"]=0;
$vyspp3= MySQL_Query("update uzivatele set poc_prodej='$zaznam1["poc_prodej"]' where  jmeno='$zaznam1["jmeno"]'"); 
}
if ($zaznam1["poc_prodej"]<=2){
////////////////////////if ($zaznam1["prodej_cas"]<=$cas_p ){

$cenaplanety=htmlspecialchars($cenaplanety);
$cenaplanety=strip_tags($cenaplanety);
 //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


 
 if (ctype_digit($cenaplanety)){
  $vyspocplanet = MySQL_Query("SELECT prodejce FROM obchod_planety where prodejce='$zaznam1["jmeno"]'");
  $pocplanet1= MySQL_Num_Rows($vyspocplanet);

  if ($zaznam1["admin"]==1){

$pocplanet1=1;
}
  if ($pocplanet1<3){
  
  if($cenaplanety>1):
    //echo $oplanety;
  if ($zaznam1["plan_prodej"]==2){

if ($zaznam1["admin"]==1){
$casp=0;

}

$vyspp2= MySQL_Query("update uzivatele set prodej_cas='$casp' where  jmeno='$zaznam1["jmeno"]'"); 
}


    $vysp1bb = MySQL_Query("SELECT spokojenost,mesta,vyrobna,typ FROM planety where cislo='$oplanety'");
       $planety2= MySQL_Fetch_Array($vysp1bb);
      
      $den=Date("U");
/* if ($zaznam1["admin"]==1){     
 echo  "".$den.','.$zaznam1["jmeno"].','.$oplanety.','.$cenaplanety.','.$planety2["typ"].','.$planety2["mesta"].','.$planety2["vyrobna"].','.$planety2["spokojenost"].','.$zaznam1["rasa"]."";   
    }*/  
      $planeta_obchodni="1_pplaneta_obchodni";
     // echo $planety2["mesta"],$planety2["vyrobna"],$planety2["spokojenost"],$zaznam1["rasa"];
      $vysp2=MySQL_Query("INSERT INTO `obchod_planety` ( `id` , `den` , `prodejce` , `cislo` , `cena` , `typ` , `mesta` , `vyrobna` , `spokojenost` , `rasa` ) VALUES (null,'$den','$zaznam1["jmeno"]','$oplanety','$cenaplanety','$planety2["typ"]','$planety2["mesta"]','$planety2["vyrobna"]','$planety2["spokojenost"]','$zaznam1["rasa"]')");
     //echo $den;   

      $vysp3 = MySQL_Query("update planety set majitel='$planeta_obchodni',cislomaj='1' where  cislo='$oplanety'"); 
      $pocet_plan=1+$zaznam1["plan_prodej"];

if ($zaznam1["admin"]==1){
$pocet_plan=1;
}

      $vyspp3= MySQL_Query("update uzivatele set plan_prodej='$pocet_plan' where  jmeno='$zaznam1["jmeno"]'"); 
      //$zaznam1["poc_prodej"]++;
      $zprodej=$zaznam1["poc_prodej"]+1;
if ($zaznam1["admin"]==1){
$zaznam1["poc_prodej"]=1;
}
      $vyspp3= MySQL_Query("update uzivatele set poc_prodej='$zprodej' where  jmeno='$zaznam1["jmeno"]'"); 
                MySQL_Query("update uzivatele set time_obch_plan_p='$castedp' where cislo=$logcislo");
   //   $zaznam1_planety=(($zaznam1["planety"])-1);
     // $vysppp3= MySQL_Query("update uzivatele set planety='$zaznam1_planety' where  cislo=$logcislo");
//jmeno='$zaznam1["jmeno"]'"); 
///echo "pppppp,$zaznam1["plantety"],$zaznam1["poc_prodej"],$pocet_plan";

endif;}
if ($pocplanet1==3){echo "<font class='text_cerveny'>Mùžete mit v obchodì jen 3 planety</font>";
}
}}
//////////////////////}
//--------------
if ($zaznam1["poc_prodej"]==3 and $zaznam1["prodej_cas"]>$cas_p ){
//echo "<font class='text_cerveny'>Mùžete prodat jen 3 planety za 24 hodin!</font>";
$cc=$zaznam1["prodej_cas"]+(3600*24);
$kdy=Date("H:i:s j.m.Y",$cc);
echo "<font class='text_cerveny'>Mùžete prodat jen 3 planety za 24 hodin!<br>Další mùžete v ".$kdy."</font>";


}
//--------------
}
////-----------------------


endif;  
if ($zaznam1["planety"]<=$min_pocet_planet and $zaznam1["admin"]!=1){echo"<font class='text_cerveny'>Musíte mít víc jak ".$min_pocet_planet." planet abyste je mohli vložit do obchodu!!!</font>";

}
endif;
//-------------------------------koupit
////////////////////////////////////////////////////////////////////////////////
$castedp=Date("U");
$time_obch_plan_k=$zaznam1["'time_obch_plan_k'"];
$casa=(30-($castedp-$time_obch_plan_k));

if(($castedp-$time_obch_plan_k)<30){echo "<center><font class='text_cerveny'>Další koupì je možná až za ".$casa."s</font></center>";}                   
if(($castedp-$time_obch_plan_k)>=30): 
////////////////////////////////////////////////////////////////////////////////
if($kupplanetu!=null){

///
if ($zaznam1["plan_koupe"]<4){
$casp=Date("U");
$cas_p=$casp-(3600*24);
if ($zaznam1["poc_koupe"]>=3 and $zaznam1["koupe_cas"]<=$cas_p ){
$zaznam1["poc_koupe"]=0;
$vyspp3= MySQL_Query("update uzivatele set poc_koupe='$zaznam1["poc_koupe"]' where  jmeno='$zaznam1["jmeno"]'"); 
}
if ($zaznam1["poc_koupe"]<=2){
//////////////////////////////if ($zaznam1["koupe_cas"]<=$cas_p ){
if ($zaznam1["plan_koupe"]==2){

$vyspp2= MySQL_Query("update uzivatele set koupe_cas='$casp' where  jmeno='$zaznam1["jmeno"]'"); 
}

///
$vyspk1 = MySQL_Query("SELECT prodejce,cislo,cena,rasa FROM obchod_planety where cislo='$kupplanetu'");
$koupit1= MySQL_Fetch_Array($vyspk1);

  $prasa=$koupit1["rasa"];
  //...uprava $cena=$koupit1["cena"]*($ceny["$prasa"]/$ceny["$trasa"]);
  $cena=$koupit1["cena"]*($ceny["$trasa"]/$ceny["$prasa"]);

  if($cena>$zaznam1["penize"]):
    echo "<font class='text_cerveny'>Tolik naquadahu nemáte.</font>";
  else:
     $penizek=$zaznam1["penize"]-$cena;
    
    $vyspk2 = MySQL_Query("SELECT nazev,cislo,majitel FROM planety where cislo='$koupit1["cislo"]'");
    $koupit2= MySQL_Fetch_Array($vyspk2);
    $vyspk2b = MySQL_Query("SELECT penize,posta,planety FROM uzivatele where jmeno='$koupit1["prodejce"]'");
    $koupit2b= MySQL_Fetch_Array($vyspk2b);
    
    $koupit2b_penize=$koupit2b["penize"]+$koupit1["cena"];
///echo "".$koupit2b["penize"]."penize";

///echo "".$koupit1["cena"]."cena";
///echo "".$koupit2b_penize."penize2";

    $vyspk3 = MySQL_Query("update planety set majitel='$zaznam1["jmeno"]',cislomaj='$zaznam1["cislo"]' where  cislo='$koupit1["cislo"]'"); 
        $zaznam1["planety"]++;
   ///--
        $koupit2b["planety"]= $koupit2b["planety"]-1;
    $vyspk4 = MySQL_Query("update uzivatele set penize='$penizek',planety='$zaznam1["planety"]' where  jmeno='$zaznam1["jmeno"]'"); 
   $vyspk5 = MySQL_Query("update uzivatele set penize='$koupit2b_penize',planety='$koupit2b["planety"]' where  jmeno='$koupit1["prodejce"]'"); 
   $vyspk6= MySQL_Query("DELETE FROM obchod_planety WHERE cislo='$kupplanetu'");



	

		$posta=$koupit2b["posta2"]+1;
		$den=Date("U");
                $nazev="Obchod s planetami";
		//$pocena=$pcena*($politika2["koupe"]/100);
		$text="Koupil Vámi nabízenou planetu za ".$koupit1["cena"]."kg naquadahu, v jeho mìnì to bylo ".$cena.".";
		MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,text,stav,nepr,typ,smaz) VALUES ($den,'$zaznam1["jmeno"]','$koupit1["prodejce"]','$nazev','$trasa','$text','1','1','2','0')");

		MySQL_Query("update uzivatele set posta2='$posta' where jmeno = '$koupit1["prodejce"]'");

    $zaznam1["planety"]=$zaznam1["planety"]+1;
    
      //$vyspp3= MySQL_Query("update uzivatele set planety='$zaznam1["planety"]' where  jmeno='$zaznam1["jmeno"]'");

//
$pocet_plan=1+$zaznam1["plan_koupe"];
      $vyspp3= MySQL_Query("update uzivatele set plan_koupe='$pocet_plan' where  jmeno='$zaznam1["jmeno"]'"); 
      $zaznam1["poc_koupe"]++;
      $vyspp3= MySQL_Query("update uzivatele set poc_koupe='$zaznam1["poc_koupe"]' where  jmeno='$zaznam1["jmeno"]'"); 
   $castedp=Date("U");
   MySQL_Query("update uzivatele set time_obch_plan_k='$castedp' where cislo=$logcislo");
//


endif;
////////////////////////}
////
}
//---
if ($zaznam1["poc_koupe"]==3 and $zaznam1["koupe_cas"]>$cas_p ){ 
$cc1=$zaznam1["koupe_cas"]+(3600*24);
$kdy=Date("H:i:s j.m.Y",$cc1);
echo "<font class='text_cerveny'>Mùžete koupit jen 3 planety za 24 hodin!<br>Další mùžete v ".$kdy."</font>";

//echo"<font class='text_cerveny'>Mùžete koupit jen 3 planety za 24 hodin</font>";
}

//---
}}
endif;


///////nacteni planet do formulare na prodej	
$vysp = MySQL_Query("SELECT nazev,cislo,majitel,status FROM planety where majitel='$zaznam1["jmeno"]'");

echo"<form name=\"form\" method=\"post\" action=\"hlavni.php?page=obchod&co=5\">";
echo"<h6>Prodat planetu<select name=\"oplanety\">";
while($planety = MySQL_Fetch_Array($vysp)):
if ($planety["status"]<1){
 echo  " <option value=\"".$planety["cislo"]."\">".$planety["nazev"]."</option>";
     }
endwhile;
echo"</select>";$caspl=Date("U");
echo" za cenu <input type=\"text\" name=\"cenaplanety\"> naquadahu ";
echo"<input type=\"submit\" name=\"Submit\" value=\"Prodat\">
 <input type='hidden' name='planety_interval' value='".$caspl."'>
</form><br>";
///////konec nacteni planet do formulare na prodej
/////planety v obchode 
$vysp1 = MySQL_Query("SELECT id,den,prodejce,cislo,cena,typ,mesta,vyrobna,spokojenost,rasa FROM obchod_planety order by den desc");
//$pocet_planet_obchod=0;
echo"  <TABLE bordercolorlight=#FFFFFF bordercolordark=#FFFFFF bordercolor=#FFFFFF border=1 align=center width=100%>
    <tr> 
      <th>èas a datum nabídnutí</th>
      <th>Typ planety</th>
      <th>Cena</th>
      <th>Mìsta</th>
      <th>Výrobny</th>
      <th>Spokojenost</th>
      <th>&nbsp;</th>
    </tr>";

while($planety_obchod = MySQL_Fetch_Array($vysp1)):
 
  //$planety_obchod1 = MySQL_Fetch_Row($vysp2a);
 //doplnit prepocet ceny

 //echo  $planety_obchod["den"];
 $datum = Date("j.m.Y",$planety_obchod["den"]);
 if($planety_obchod["vyrobna"]==null){$planety_obchod["vyrobna"]="0";}
$prasa=$planety_obchod["rasa"];
//$pokk=$ceny["$prasa"];

//uprava.... @$cena=$planety_obchod["cena"]*($ceny["$prasa"]/$ceny["$trasa"]);
@$cena=$planety_obchod["cena"]*($ceny["$trasa"]/$ceny["$prasa"]);
@$cena=floor($cena);
if($planety_obchod["prodejce"]==$zaznam1["jmeno"]){
echo"<tr> 
      <th>".$datum."</th>
      <th>".$planety_obchod["typ"]."&nbsp;</th>
      <th>".number_format($cena,2,"."," ")."&nbsp;</th>
      <th>".$planety_obchod["mesta"]."&nbsp;</th>
      <th>".$planety_obchod["vyrobna"]."&nbsp;</th>
      <th>".$planety_obchod["spokojenost"]."%&nbsp;</th>
      <th><form name='form' method='post' action='hlavni.php?page=obchod&co=5' >";
    		 //if($trasa!=$planety_obchod["rasa"]){
     echo"<input type='submit' value='zrušit'>
				 <input type='hidden' name='zrusit' value='".$planety_obchod["cislo"]."'></form>
         <form name='form' method='post' action='hlavni.php?page=obchod&co=5' >";
     echo"<input type='submit' value='zlevnit o 10%'>
				 <input type='hidden' name='zlevnit' value='".$planety_obchod["cislo"]."'></form>
         </th>
         </tr>";

}

 if($trasa!=$planety_obchod["rasa"]){
 echo"<tr> 
      <th>".$datum."</th>
      <th>".$planety_obchod["typ"]."&nbsp;</th>
      <th>".number_format($cena,2,"."," ")."&nbsp;</th>
      <th>".$planety_obchod["mesta"]."&nbsp;</th>
      <th>".$planety_obchod["vyrobna"]."&nbsp;</th>
      <th>".$planety_obchod["spokojenost"]."%&nbsp;</th>
      <th><form name='form' method='post' action='hlavni.php?page=obchod&co=5' >";
    		 //if($trasa!=$planety_obchod["rasa"]){
    		 
     echo"<input type='submit' value='Koupit'>
				 <input type='hidden' name='kupplanetu' value='".$planety_obchod["cislo"]."'>
        
         </form>
         </th></tr>";}
 
//if($planety_obchod["majitel"]==$zaznam1["jmeno"]){$pocet_planet_obchod++;}   
 // if($planety_obchod["majitel"]==$zaznam1["jmeno"]){
/// zrusit nabidku  
/// zlevnit
//  }  
endwhile;

//echo"$pocplanet1";
echo"</table>";

//---------------else: echo"<font class='text_cerveny'>Obchod s planetama doèasnì uzavøen</font>";
//---------------endif;


$vpocplanet = MySQL_Query("SELECT majitel FROM planety where majitel='$zaznam1["jmeno"]'");
$pocplanet1= MySQL_Num_Rows($vpocplanet);
$pocplanet1a=$pocplanet1;
$vyppp3= MySQL_Query("update uzivatele set planety='$pocplanet1a' where  cislo=$logcislo");
endif;endif;


	MySQL_Close($spojeni);		
?>

