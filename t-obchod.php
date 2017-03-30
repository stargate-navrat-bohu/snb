<?php
//mysql_query("SET NAMES cp1250");
Header ("Cache control: no-cache");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<?php
require "data_1.php";

$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
$zaznam1 = MySQL_Fetch_Array($vys1);

$styl="styl".$zaznam1[skin];
if($zaznam1['skin']==1 or $zaznam1['skin']==2 or $zaznam1['skin']==3 or 	$zaznam1['skin']==4){
    $styl="styl1";
}
?>
<style type="text/css">
@import url(<?php echo $styl?>.css);
td{text-align:center;}
alink{color:white;};
</style>
<script language="JavaScript" src="a.php" >
</script>
<?php
if((Date("U")-$zaznam1['vek'])<86400){
    echo "<h1>Nemůžete obchodovat. Nejste tu ještě ani 24 hodin a tak nejste zapsán v obchodním rejstříku.</h1>";
    exit;
}
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
</head>
<body bgcolor="bbbbbb">

<center><h6>
<a href="obchod.php?co=1" target="hlavni" id=a onMouseOver=Rozsvitit('a') onMouseOut=Zhasnout('a')>Prodej jednotek</a>
&nbsp;&nbsp;
<a href="obchod.php?co=2" target="hlavni" id=b onMouseOver=Rozsvitit('b') onMouseOut=Zhasnout('b')>Prodej nezaměstnaných</a>
&nbsp;&nbsp;
<a href="obchod.php?co=3" target="hlavni" id=c onMouseOver=Rozsvitit('c') onMouseOut=Zhasnout('c')>Koupě jednotek</a>
&nbsp;&nbsp;
<a href="obchod.php?co=4" target="hlavni" id=d onMouseOver=Rozsvitit('d') onMouseOut=Zhasnout('d')>Ostatní koupě</a>
</h6></center>
<?php
	$trasa=$zaznam1['rasa'];

	require("kontrola.php");

	$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $trasa");
	$politika = MySQL_Fetch_Array($politika1);

	$narod1 = MySQL_Query("SELECT * FROM narody where cislo=".$zaznam1['narod']);
	$narod = MySQL_Fetch_Array($narod1);

	$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=".$zaznam1['zrizeni']);
	$zriz = MySQL_Fetch_Array($zrizeni1);

	$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$trasa'");
	$zaznam2 = MySQL_Fetch_Array($vys2);

	if(isset($j1) && $co==1):
		$j1*=1;
		$j2*=1;
		$j3*=1;
		$j4*=1;
		$cj1*=1;
		$cj2*=1;
		$cj3*=1;
		$cj4*=1;
		do{
			if($j1<0 or $j2<0 or $j3<0 or $j4<0){echo "<h1>Čísla musí být větší jak nula</h1>";break;};
			if($j1>$zaznam1['jed1'] or $j2>$zaznam1['jed2'] or $j3>$zaznam1['jed3'] or $j4>$zaznam1['jed4']){echo "<h1>Tolik jednotek nemáte</h1>";break;};

			$den=Date("U");
			$minut=rand(15,30);
			$minut=$minut*60;
			$den+=$minut;
			
			$cena=$j1*$cj1+$j2*$cj2+$j3*$cj3+$j4*$cj4;
			echo "<font class=info>";
			$ocena=($j1*$zaznam2['jed1_cena']*$politika['cenaj']/100)+($j2*$zaznam2['jed2_cena']*$politika['cenaj']/100)+($j4*$zaznam2['jed4_cena']*$politika['cenaj']/100)+($j3*$zaznam2['jed3_cena']*$politika['cenaj']/100*$politika['cena3j']/100);
			if(($cena/$ocena)<=0.5){echo "<h1>Zvolená celková cena nesmí být menší jak 50% výrobní ceny</h1>";break;};
			if(($cena/$ocena)>=1.5){echo "<h1>Zvolená celková cena nesmí být větší jak 150% výrobní ceny</h1>";break;};
			$zjed1=$zaznam1['jed1']-$j1;
			$zjed2=$zaznam1['jed2']-$j2;
			$zjed3=$zaznam1['jed3']-$j3;
			$zjed4=$zaznam1['jed4']-$j4;
			
			$utok=$zjed1*$zaznam2["jed1_utok"];
			$utok+=$zjed2*$zaznam2["jed2_utok"];
			$utok+=$zjed4*$zaznam2["jed4_utok"];
			$utok+=$zaznam1["jed5"]*$zold_utok;
			$utok*=$politika['utok']/100;
			$utok*=$narod['utok']/100;
			$utok*=$zriz['utok']/100;
			$obrana=$zjed1*$zaznam2["jed1_obrana"];
			$obrana+=$zjed2*$zaznam2["jed2_obrana"];
			$obrana+=$zjed4*$zaznam2["jed4_obrana"];
			$obrana+=$zaznam1["jed5"]*$zold_obrana;
			$obrana*=$politika['obrana']/100;
			$obrana*=$narod['obrana']/100;
			$obrana*=$zriz['obrana']/100;
			$sila=$utok+$obrana;

			MySQL_Query("update uzivatele set jed1=$zjed1,jed2=$zjed2,jed3=$zjed3,jed4=$zjed4,sila=$sila where cislo=$logcislo");

			$nahoda=rand(1,5);

			if($nahoda==5):
				echo "<centrum><h1>";			
				$nahoda2=rand(1,10);
				switch($nahoda2){
					case 1:	echo "P��rodn� katastrofa, do na�e transportn�h lod� potkali p�s asteroid�, nikdo nep�e�il.";
							$kat=0;break;
					case 2:	echo "P��rodn� katastrofa, do na�e transportn�h lod� potkali houf asteroid�, ztr�ty 75%.";
							$kat=0.25;break;
					case 3:	echo "P��rodn� katastrofa, do na�e transportn�h lod� potkali p�r asteroid�, ztr�ty 50%.";
							$kat=0.50;break;
					case 4:	echo "Na�e p�epravn� lod� byly p�epadeny arm�dou pir�t�, plno na�ich lid� povra�dily, zbytek se bu� k nim p�idal nebo je prodali do otroctv�.";
							$kat=0;break;
					case 5:	echo "Na�e p�epravn� lod� byly p�epadeny bandou pir�t�, ubr�nily se, ale ztr�ty na �ivotech a na zbo��ch byly velk� - 75%";
							$kat=0.25;break;
					case 6:	echo "Na�e p�epravn� lod� byly p�epadeny skupinou pir�t�, ubr�nily se, ale ztr�ty byly nezanedbateln� - 50%";
							$kat=0.5;break;
					case 7:	echo "Chyba organick�ho p�vodu, na�i piloti jsou p�e�erpan� a tak se ob�as spletou, narazili do sebe a vytvo�ili hav�rku - 25% ztr�ty na zbo�� a �ivotech";
							$kat=0.75;break;
					case 8:	echo "Stala se stra�n� v�c, nespokojen� frakce s nyn�j�� vl�dou sabotovaly 75% na�ich lod�. Byly to profesion�ln� sabot�e a nikdo na po�kozen�ch lod�ch nep�e�il";
							$kat=0.25;break;
					case 9:	echo "Ztratily jsme s na�imi lod�mi spojen�, nikdo nev� co se stalo. Mo�n� �patn� pr�let hyperprostorem, �ern� d�ra, opot�ebovan� lod� ...";
							$kat=0;break;
					case 10:echo "Hnusn� zlo�in, n�kdo prodal na�e lidi, zm�nil sou�adnice hyperprostoru do souhv�zd� pir�t�. Na�i nem�li �anci";
							$kat=0;break;
				};
				echo "</h1></centrum>";
				if($kat!=0){
					$j1*=$kat;$j2*=$kat;$j3*=$kat;$j4*=$kat;
					MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,jed2,jed3,jed4,cj1,cj2,cj3,cj4,vyr,typ) VALUES ($den,'$logjmeno',$trasa,$j1,$j2,$j3,$j4,$cj1,$cj2,$cj3,$cj4,$cena,0)");					
				};
			else:
				MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,jed2,jed3,jed4,cj1,cj2,cj3,cj4,vyr,typ) VALUES ($den,'$logjmeno',$trasa,$j1,$j2,$j3,$j4,$cj1,$cj2,$cj3,$cj4,$cena,0)");
			endif;
		}while(false);
	endif;

	if(isset($smazn)):
		$zpet2 = MySQL_Query("SELECT * FROM obchod where den = $smazn");
		$zpet = MySQL_Fetch_Array($zpet2);

		$sila=$zpet['jed1']*$zaznam2['jed1_utok']+$zpet['jed1']*$zaznam2['jed1_obrana'];
		$sila+=$zpet['jed2']*$zaznam2['jed2_utok']+$zpet['jed2']*$zaznam2['jed2_obrana'];
		$sila+=$zpet['jed4']*$zaznam2['jed4_utok']+$zpet['jed4']*$zaznam2['jed4_obrana'];
		$sila+=$zaznam1['sila'];
		
		if($sila>$max_sila){
            echo "<h1>Jednotky se nemůžou vrátit, měl byste moc velkou sílu.</h1>";
            //break;//XXX ondrejd ???
        }
		if($zpet['navrhovatel']!=$zaznam1['jmeno']){
            echo "<h1>Tyto jednotky nejsou vaše.</h1>";
            //break;//XXX ondrejd ???
        }

		$zjed1=$zaznam1['jed1']+$zpet['jed1'];
		$zjed2=$zaznam1['jed2']+$zpet['jed2'];
		$zjed3=$zaznam1['jed3']+$zpet['jed3'];
		$zjed4=$zaznam1['jed4']+$zpet['jed4'];
		MySQL_Query("update uzivatele set jed1=$zjed1,jed2=$zjed2,jed3=$zjed3,jed4=$zjed4,sila=$sila where cislo=$logcislo");
		MySQL_Query("DELETE FROM obchod WHERE den = $smazn");
	endif;

	if(isset($vrat)):
		do{
		$zpet2 = MySQL_Query("SELECT * FROM obchod where den = $vrat");
		$zpet = MySQL_Fetch_Array($zpet2);

		$cena=$zpet['cj1']*0.75;
		$cena=Round($cena);

		MySQL_Query("update obchod set cj1=$cena where den = $vrat");
		}while(false);
	endif;

	if(isset($kup)):
		do{
		$j1=$koliklid*1;

		$vysak2 = MySQL_Query("SELECT * FROM obchod where den = $kup");
		$zaz = MySQL_Fetch_Array($vysak2);

		$cj1=$zaz['cj1'];
		$jrasa=$zaz['rasa'];

		$politika22 = MySQL_Query("SELECT rasa,koupe,prodej FROM politika where rasa = $jrasa");
		$politika2 = MySQL_Fetch_Array($politika22);

		$planetak = MySQL_Query("SELECT nazev,cislo,mesta,lidi FROM planety where cislo = $kaml");
		$pl = MySQL_Fetch_Array($planetak);

		$kcena=$koliklid*$cj1;
    	$pcena=$koliklid*$cj1;

		if($j1>$zaz['jed1']){echo "<h1>Tolik lid� v nab�dce nen�</h1>";break;};
		if($j1<0){echo "<h1>��sla mus� b�t v�t�� ne� nula</h1>";break;};
		if(($pl['lidi']+($j1*1000))>($pl['mesta']*10000000)){echo"<h1>Tolik lid� se na c�lovou planetu nevejde</h1>";break;};
		if($kcena>$zaznam1['penize']){echo "<h1>Tolik naquadahu nem�te.</h1>";break;};

		$on=$zaz[navrhovatel];
		$prodejce = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$on'");
		$prod = MySQL_Fetch_Array($prodejce);

		$posta=$prod['posta']+1;
		$pocena=$pcena*($politika2['koupe']/100);
		$text="Koupil V�mi nab�zen� obyvatele celkem za ".$pocena."kg naquadahu";
		MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text) VALUES ($prijm,'$logjmeno','$on','$trasa','$text')");

		$p1=$zaznam1['penize']-($kcena*$politika['prodej']/100);
		$p2=$prod['penize']+($pcena*$politika2['koupe']/100);

		$je1=$pl['lidi']+($j1*1000);
		MySQL_Query("update planety set lidi=$je1 where cislo=$kaml");
		MySQL_Query("update uzivatele set penize=$p2, posta=$posta where jmeno = '$on'");
		MySQL_Query("update uzivatele set penize=$p1 where cislo = $logcislo");

		$j1=$zaz['jed1']-$j1;
		if($j1>0):
			MySQL_Query("update obchod set jed1=$j1 where den = $kup");
		else:
			MySQL_Query("delete from obchod where den = $kup");
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
		$jrasa=$zaz['rasa'];
		$ras2 = MySQL_Query("SELECT * FROM rasy where rasa = $jrasa");
		$rasa2 = MySQL_Fetch_Array($ras2);

		$politika22 = MySQL_Query("SELECT rasa,koupe,prodej FROM politika where rasa = $jrasa");
		$politika2 = MySQL_Fetch_Array($politika22);

		$cj1=$zaz['cj1'];
		$cj2=$zaz['cj2'];
		$cj3=$zaz['cj3'];
		$cj4=$zaz['cj4'];

		$cj1=($cj1/$rasa2['jed1_cena'])*$zaznam2['jed1_cena'];
		$cj1=Round($cj1);
		$cj2=($cj2/$rasa2['jed2_cena'])*$zaznam2['jed2_cena'];
		$cj2=Round($cj2);
		$cj3=($cj3/$rasa2['jed3_cena'])*$zaznam2['jed3_cena'];
		$cj3=Round($cj3);
		$cj4=($cj4/$rasa2['jed4_cena'])*$zaznam2['jed4_cena'];
		$cj4=Round($cj4);

		$sj1=$j1*$rasa2['jed1_obrana']+$j1*$rasa2['jed1_utok'];
		$tsj1=$j1*$zaznam2['jed1_obrana']+$j1*$zaznam2['jed1_utok'];
		$sj2=$j2*$rasa2['jed2_obrana']+$j2*$rasa2['jed2_utok'];
		$tsj2=$j2*$zaznam2['jed2_obrana']+$j2*$zaznam2['jed2_utok'];
		$sj4=$j4*$rasa2['jed4_obrana']+$j4*$rasa2['jed4_utok'];
		$tsj4=$j4*$zaznam2['jed4_obrana']+$j4*$zaznam2['jed4_utok'];

		$tsc=$tsj1+$tsj2+$tsj4;
		$tsc+=$zaznam1['sila'];

		if($tsc>50000000){echo "<h1>Nesm�te m�t s�lu v�t�� jak 50 mil.</h1>";break;};
		
		$mj2=$mj1=$mj4=$pj4=$pj2=$pj1=0;
			
		if($sj1>0):
			$pomer1=$tsj1/$sj1;
			$pj1=ceil($pomer1*$j1);
			$pomer11=$sj1/$tsj1;			
			$mj1=ceil($pomer11*$zaz['jed1']);
		endif;
		if($pj1==0 and $j1>0){$pj1=1;};
		if($sj2>0):
			$pomer2=$tsj2/$sj2;
			$pj2=ceil($pomer2*$j2);
			$pomer21=$sj2/$tsj2;
			$mj2=Ceil($pomer21*$zaz['jed2']);
		endif;
		if($pj2==0 and $j2>0){$pj2=1;};
		if($sj4>0):
			$pomer4=$tsj4/$sj4;
			$pj4=ceil($pomer4*$j4);
			//echo $pomer2.", ".$j4.", ".$pj4;
			$pomer41=$sj4/$tsj4;
			$mj4=ceil($pomer41*$zaz['jed4']);
		endif;
		if($pj2==0 and $j2>0){$pj2=1;};
		$mj3=$zaz['jed3'];
		$pj3=$j3;
		$kcena=$j1*$cj1+$j2*$cj2+$j3*$cj3+$j4*$cj4;
    	$pcena=$zaz['cj1']*$pj1+$zaz['cj2']*$pj2+$zaz['cj3']*$pj3+$zaz['cj4']*$pj4;
		$pcena*=0.8;
		//echo "<font class=info>";
		//echo "$kcena<br>";
		//echo "$pcena<br>";		

		if(($j1>$mj1) or ($j2>$mj2) or ($j3>$mj3) or ($j4>$mj4)){echo "<h1>Tolik jednotek v nab�dce nen�</h1>";break;};
		if($j1<0 or $j2<0 or $j3<0 or $j4<0){echo "<h1>��sla mus� b�t v�t�� ne� nula</h1>";break;};
		if($kcena>$zaznam1['penize']){echo "<h1>Tolik naquadahu nem�te.</h1>";break;};

		$on=$zaz[navrhovatel];
		$prodejce = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$on'");
		$prod = MySQL_Fetch_Array($prodejce);

		$posta=$prod['posta']+1;
		$pocena=$pcena*($politika2['koupe']/100);
		$trasa2=Addslashes($zaznam2['nazevrasy']);
		$jrasa2=Addslashes($rasa2['nazevrasy']);		
		$text="Koupil V�mi nab�zen� jednotky celkem za ".$pocena." kg naquadahu";
		//echo "<h6>$trasa2";
		//echo "<h6>$jrasa2";
		$denp=Date("U");
		MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text,stav,rasa2) VALUES ($denp,'$logjmeno','$on','$trasa2','$text',1,'$jrasa2')");
//		MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text,stav,rasa2) VALUES ('2064344789','bla','bla','bla','bla',1,'bla')");		
//										den odesilatel adresat rasa text stav rasa2 

		$p1=$zaznam1['penize']-($kcena*$politika['prodej']/100);
		$p2=$prod['penize']+($pcena*$politika2['koupe']/100);

		$j1=$zaznam1['jed1']+$j1;
		$j2=$zaznam1['jed2']+$j2;
		$j3=$zaznam1['jed3']+$j3;
		$j4=$zaznam1['jed4']+$j4;

		MySQL_Query("update uzivatele set jed1=$j1,jed2=$j2,jed3=$j3,jed4=$j4,penize=$p1 where cislo=$logcislo");
		MySQL_Query("update uzivatele set penize=$p2, posta=$posta where jmeno = '$on'");

		$pj1=$zaz['jed1']-$pj1;
		$pj2=$zaz['jed2']-$pj2;
		$pj3=$zaz['jed3']-$pj3;
		$pj4=$zaz['jed4']-$pj4;

		if(($pj1>0) or ($pj2>0) or ($pj3>0) or ($pj4>0)):
			MySQL_Query("update obchod set jed1=$pj1,jed2=$pj2,jed3=$pj3,jed4=$pj4 where den = $prijm");
		else:
			MySQL_Query("delete from obchod where den = $prijm");
		endif;
		
		}while(false);
	endif;

	if(isset($lidipr)):
		do{
			$odkud = MySQL_Query("SELECT * FROM planety where cislo = $odkudl");

			if(!$odkud){echo "<h1>Planeta ".$odkudlj." neexistuje</h1>";break;};

			$od = MySQL_Fetch_Array($odkud);
			$odkudlj=$od['nazev'];

			if($lidipr<0){echo "<h1>Mus�te zad�vat klad� ��sla</h1>";break;};
			if($lidice<0){echo "<h1>Mus�te zad�vat klad� ��sla</h1>";break;};			
			if($od[majitel]!=$logjmeno){echo "<h1>Planeta ".$odkudl." nen� Va�e</h1>";break;};
			if($lidipr>99999){echo "<h1>Najednou m��ete prodat maxim�ln� 99 milion� lid�</h1>";break;};
			$kolik=$lidipr*1000;

			$nez=$od["lidi"]-$od["vyrobna"]*$zaznam2['vyr_lidi'];
			$nez-=$od["sdi"]*$zaznam2['sdi_lidi'];
			$nez-=$od["laborator"];

			if($kolik<=$nez):
				$zbylo=$od['lidi']-$kolik;
				$den=Date("U");

				$minut=rand(15,30);
				$minut=$minut*60;
				$den+=$minut;

				MySQL_Query("update planety set lidi=$zbylo where cislo = $odkudl");
				MySQL_Query("INSERT INTO obchod (den,navrhovatel,jed1,cj1,typ) VALUES ($den,'$logjmeno',$lidipr,$lidice,1)");
			else:
				echo "<h1>Tolik nezam�stnan�ch l�d� na planet� ".$odkudlj." neni.</h1>";
			endif;
		}while(false);
	endif;

	if(isset($kupbr)):
		do{
		$br = MySQL_Query("SELECT den,typ,jed1,vyr FROM obchod where (typ=2 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);
		$pl = MySQL_Query("SELECT cislo,nazev,brana,cislomaj FROM planety where cislo=$kamb");
		$planeta = MySQL_Fetch_Array($pl);

		if($brana['vyr']>$zaznam1['penize']){echo "<h1>Nem�te dost pen�z</h1>";break;};
		if($logcislo!=$planeta['cislomaj']){echo "<h1>Planeta ".$paneta['nazev']." nen� va�e.</h1>";break;};
		if(0<$planeta['brana']){echo "<h1>Na planet� ".$paneta['nazev']." u� hv�zdn� br�na je.</h1>";break;};
		if(1>$brana['jed1']){echo "<h1>Bohu�el v nab�dce u� ��dn� br�na neni, n�kdo v�s p�edb�hl.</h1>";break;};

    		$prachy=$zaznam1['penize']-$brana['vyr'];
    		$branak=$zaznam1['bran']+1;

		MySQL_Query("update planety set brana=1 where cislo=$kamb");
		MySQL_Query("update uzivatele set penize=$prachy,bran=$branak where cislo=$logcislo");
  
    		$jed1=$brana['jed1']-1;
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

		$celkem=$brana['cj1']*$zoldaku;

		$sila=$zoldaku*($zold_utok*$politika['utok']/100*$zriz['utok']/100*$narod['utok']/100);
		$sila+=$zoldaku*($zold_obrana*$politika['obrana']/100*$zriz['obrana']/100*$narod['obrana']/100);

		if($zoldaku<0){echo "<h1>��slo mus� b�t v�t�� jak dv�</h1>";break;};
		if($celkem>$zaznam1['penize']){echo "<h1>Nem�te dost pen�z</h1>";break;};
		if($sila+$zaznam1['sila']>$max_sila){echo "<h1>M�l byste v�t�� s�lu jak ".$max_sila."</h1>";break;};
		if($zoldaku>$brana['jed1']){echo "<h1>Bohu�el v nab�dce tolik �old�k� nen�.</h1>";break;};

    		$prachy=$zaznam1['penize']-$celkem;
		$jed5=$zaznam1['jed5']+$zoldaku;

		MySQL_Query("update uzivatele set penize=$prachy,jed5=$jed5 where cislo=$logcislo");
  
    		$jed1=$brana['jed1']-$zoldaku;
    		if($jed1>0):
  			MySQL_Query("update obchod set jed1=$jed1 where (navrhovatel='' and typ=3)");
    		else:
  			MySQL_Query("update obchod set jed1=0 where (navrhovatel='' and typ=3)");  		
    		endif;
		}while(false);
	endif;

	

	$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
	$zaznam1 = MySQL_Fetch_Array($vys1);

	echo "<center>";

	echo "<h6>M�te dohromady naquadahu: ".number_format($zaznam1['penize'],2,"."," ")."</h6>";
//-------------------------------------------------prodej jednotek----------------------------
if($co==1 or empty($co)):
	echo "<h6><font class=kapital>P</font>rodej jednotek</h6>";
	echo "<form name='form' method='post' action='obchod.php'>";
	echo "<input type='hidden' name='co' value='1'>";
	echo "<TABLE ".$table." ".$border." align=center>";
	echo "<tr>";
	echo "<th>n�zev</th>";
	echo "<th>m�te</th>";
	echo "<th>v�robn� cena</th>";
	echo "<th>prodat jednotek</th>";
	echo "<th>cena jedn�</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=pole>".$zaznam2['jed1_nazev']."</td>";
	echo "<td>".$zaznam1['jed1']."</td>";
	echo "<td>".($zaznam2['jed1_cena']*$politika['cenaj']/100)."</td>";
	echo "<td><input type='text' name='j1' size=6></td>";
	echo "<td><input type='text' name='cj1' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=pole>".$zaznam2['jed2_nazev']."</td>";
	echo "<td>".$zaznam1['jed2']."</td>";
	echo "<td>".($zaznam2['jed2_cena']*$politika['cenaj']/100)."</td>";
	echo "<td><input type='text' name='j2' size=6></td>";
	echo "<td><input type='text' name='cj2' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=pole>".$zaznam2['jed4_nazev']."</td>";
	echo "<td>".$zaznam1['jed4']."</td>";
	echo "<td>".($zaznam2['jed4_cena']*$politika['cenaj']/100)."</td>";
	echo "<td><input type='text' name='j4' size=6></td>";
	echo "<td><input type='text' name='cj4' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=pole>".$zaznam2['jed3_nazev']."</td>";
	echo "<td>".$zaznam1['jed3']."</td>";
	echo "<td>".($zaznam2['jed3_cena']*$politika['cenaj']/100*$politika['cena3j']/100)."</td>";
	echo "<td><input type='text' name='j3' size=6></td>";
	echo "<td><input type='text' name='cj3' size=3></td>";
	echo "</tr>";
	echo "</table>";
	echo "<br><input type='submit' value='   n�b�dnout jednotky   '></form>";

	$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel='$logjmeno' and typ=0) order by den desc ");
	echo "<br><h6><font class=kapital>V</font>�mi nab�zen� jednotky</h6>";
	echo "<center><font class=info>Po nab�dnut� V�mi se jednotky p�ev�ej� do vesm�rn�ho skladu. To trv� 15-30 minut.</font></center><br>";

	echo "<TABLE ".$table." ".$border." align=center>";
	echo "<tr>";
	echo "<th>den nab�dnut�</th>";
	echo "<th>status</th>";
	echo "<th>".$zaznam2['jed1_nazev']."</th>";
	echo "<th>".$zaznam2['jed2_nazev']."</th>";
	echo "<th>".$zaznam2['jed4_nazev']."</th>";
	echo "<th>".$zaznam2['jed3_nazev']."</th>";
	echo "<th>Celkov� cena</th>";
	echo "<th>&nbsp;</th>";
	echo "</tr>";
		
	$ted=Date("U");
	//echo "<h6><br>";
	//echo $ted."<br>";
	while($obchod = MySQL_Fetch_Array($obch)):
			$den=$obchod['den'];
	//echo $den."<br>";
			$datum = Date("j.m.Y",$den);
			
			echo "<tr><form name='form' method='post' action='obchod.php' >";
			echo "<td class=pole>".$datum."</td>";

			if($den>$ted):
				echo "<td><font color='red'>&nbsp;&nbsp;p�esun&nbsp;&nbsp;</td>";
			else:
				echo "<td><font color='green'>&nbsp;&nbsp;nab�zeno&nbsp;&nbsp;</font></td>";	
			endif;
			

			if($obchod['jed1']>0):
				echo "<td>".$obchod['jed1']." kr�t po ".$obchod['cj1']."kg</td>";
				$celkem+=$obchod['jed1']*$obchod['cj1'];
			else:
				echo "<td>Nenab�z�te</td>";
			endif;

			if($obchod['jed2']>0):
				echo "<td>".$obchod['jed2']." kr�t po ".$obchod['cj2']."kg</td>";
				$celkem+=$obchod['jed2']*$obchod['cj2'];
			else:
				echo "<td>Nenab�z�te</td>";
			endif;

			if($obchod['jed4']>0):
				echo "<td>".$obchod['jed4']." kr�t po ".$obchod['cj4']."kg</td>";
				$celkem+=$obchod['jed4']*$obchod['cj4'];
			else:
				echo "<td>Nenab�z�te</td>";
			endif;

			if($obchod['jed3']>0):
				echo "<td>".$obchod['jed3']." kr�t po ".$obchod['cj3']."kg</td>";
				$celkem+=$obchod['jed3']*$obchod['cj3'];
			else:
				echo "<td>Nenab�z�te</td>";
			endif;
			
			echo "<td>".$celkem." kg </td>";
			echo "<td><input type='submit' value='zru� nab�dku'>
				<input type='hidden' name='smazn' value=".$den.">
				<input type='hidden' name='co' value='1'>
			      </td>";
			echo "</form></tr>";
			$celkem=0;
	endwhile;
endif;

//-------------------------------------------------prodej nezam�stnan�ch----------------------------------
if($co==2):

	if($politika[status]==3):
		echo "<h6><font class=kapital>P</font>rodej nezam�stnan�ch</h6>";

		$pla = MySQL_Query("SELECT * FROM planety where cislomaj=$logcislo order by nazev desc");

		echo "<form name='form' method='post' action='obchod.php' ><input type='hidden' name='co' value='2'>";
		echo "<table>";
		echo "<tr>";
		echo "<td>Z jak� planety prodat</td>";
		echo "<td><select name='odkudl'>";
		while ($zaznam3 = MySQL_Fetch_Array($pla)):
			echo "<option value=".$zaznam3["cislo"].">".$zaznam3["nazev"];
		endwhile;
    		echo "</select>";
		echo "</td></tr><tr>";
		echo "<td>Kolik tis�c nez. prodat</td>";
		echo "<td><input type='text' name='lidipr' size=8></td>";
		echo "</tr><tr>";
		echo "<td>Tis�c nezam�stnan�ch za</td>"; 
		echo "<td><input type='text' name='lidice' size=8></td>";
		echo "</tr><tr>";
		echo "<td colspan=2><input type='submit' value='prodat'></form></td>";
		echo "</tr></table>";		

		echo "<h6><font class=kapital>S</font>eznam Va�ich nab�dek lid�</h6>";

echo "<center><font class=info>Po nab�dnut� V�mi se nezam�stnan� p�ev�ej� do vesm�rn�ho skladu. To trv� 15-30 minut.</font></center><br>";
	
		$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel='$logjmeno' and typ=1) order by den desc ");

		echo "<TABLE ".$table." ".$border." align=center>";
		echo "<tr>";
		echo "<th>den nab�dnut�</th>";
		echo "<th>status</th>";
		echo "<th>kolik lid� (v tis�c�ch)</th>";
		echo "<th>cena za tis�c lid�</th>";
		echo "<th>Celkov� cena</th>";
		echo "<th>&nbsp;</th>";
		echo "</tr>";

		$ted=Date("U");
		while($obchod = MySQL_Fetch_Array($obch)):
			$den=$obchod['den'];
			$datum = Date("j.m.Y",$den);
			echo "<tr><form name='form' method='post' action='obchod.php' >";
			echo "<td>".$datum."</td>";

			if($den>$ted):
				echo "<td><font color='red'>&nbsp;&nbsp;p�esun&nbsp;&nbsp;</td>";
			else:
				echo "<td><font color='green'>&nbsp;&nbsp;nab�zeno&nbsp;&nbsp;</font></td>";	
			endif;

			echo "<td>".$obchod['jed1']."</td>";
			echo "<td>".$obchod['cj1']."</td>";			
			echo "<td>".($obchod['jed1']*$obchod['cj1'])."</td>";
			echo "<td>
				<input type='submit' value='zlevnit o �tvrtinu'>
				<input type='hidden' name='vrat' value=".$den.">
				<input type='hidden' name='co' value='2'>
			      </td>";
			echo "</form></tr>";
		endwhile;
		echo "</table>";
		

		echo "<h6><font class=kapital>S</font>eznam planet</h6>";

		$pla = MySQL_Query("SELECT * FROM planety where cislomaj='$logcislo' order by nazev desc");

		echo "<TABLE ".$table." ".$border." align=center>";
		echo "<tr>";
		echo "<th>n�zev planet</th>";
		echo "<th>po�et m�st</th>";
		echo "<th>celkem lid� (v tis.)</th>";
		echo "<th>z toho nezam�stnan�ch (v tis.)</th>";
		echo "</tr>";

		while($planety1 = MySQL_Fetch_Array($pla)):
			$nez=$planety1["lidi"]-$planety1["vyrobna"]*$zaznam2['vyr_lidi'];
			$nez-=$planety1["sdi"]*$zaznam2['sdi_lidi'];
			$nez-=$planety1["laborator"]*$zaznam2['lab_lidi'];
			$nez=Floor($nez/1000);
			$lidi=Floor($planety1["lidi"]/1000);
			echo "<tr>";
			echo "<td class=pole>".$planety1['nazev']."</td>";
			echo "<td>".$planety1['mesta']."</td>";
			echo "<td>".number_format($lidi,0,0," ")."</td>";
			echo "<td>".number_format($nez,0,0," ")."</td>";
			echo "</tr>";
		endwhile;

	else:
		echo "<h1>Jen rasy se statusem zl� m��ou prod�vat lidi.</h1>";
	endif;
endif;

//-------------------------------------------------koup� jednotek----------------------------------
if($co==3):
	echo "<h6><font class=kapital>K</font>oup� �old�k�</h6>";
		$br = MySQL_Query("SELECT den,typ,jed1,cj1 FROM obchod where (typ=3 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);
		$cena=$brana['cj1'];
		$cas=$brana['den'];
		$kolik=$brana['jed1'];
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

		echo "<font class=info align=center>Zde je mo�no koupit �old�ky, toto je neutr�ln� nab�dka. Nab�dka se m�n� ka�d� ".$zmena." minuty. P��t� zm�na za <font class=pole>".$sek."</font> ".$sekslovy."</font>";

		if($ted>($cas+60*$zmena)):
			$bran=10000;
			$bran=Round($bran);
			$katar=rand(-2,4);
			$kolik=rand($bran/2,$bran);
			//echo "<h6>",$katar;
			$cas=$ted;
			$cena=$zaznam2["vyr_vyrob"]*$zold_cena*(1+$katar/10);
			MySQL_Query("update obchod set cj1=$cena,den=$cas,jed1=$kolik where (navrhovatel = '' and typ=3)");
		endif;

		if($kolik>0):
			switch ($kolik){
				case 1: $pred="je nab�zena";$slovo="br�na";break;
				case 2:
				case 3:
				case 4: $pred="jsou nab�zeny";$slovo="br�ny";break;
				default: $pred="je nab�zeno";$slovo="bran";		
			}

			if($sila<50000000):
				$mjed=Floor($zaznam1['penize']/$cena);
				if($mjed>$kolik){$mjed=$kolik;};

				if($zold_mist==0):$zold_lidi="nezab�raj�";
				else:$zold_lidi=$zold_mist;
				endif;
  				echo "<form name='form' method='post' action='obchod.php' ><input type='hidden' name='co' value='3'>";
	echo "<TABLE ".$table." ".$border." align=center width=100%>";
				echo "<tr>";
				echo "<th>n�zev</th>";
				echo "<th>�tok/obrana</th>";
				echo "<th>m�st v kas�rn�ch</th>";
				echo "<th>cena</th>";
				echo "<th>je nab�zeno</th>";
				echo "<th>m��ete</th>";
				echo "<th>chcete</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class=pole>".$zold_nazev."</td>";
				echo "<td>".($zold_utok*$politika['utok']/100*$zriz['utok']/100*$narod['utok']/100)."/".($zold_obrana*$politika['obrana']/100*$zriz['obrana']/100*$narod['obrana']/100)."</td>";
				echo "<td>".$zold_lidi."</td>";
				echo "<td>".$cena."</td>";
				echo "<td>".$kolik."</td>";
				echo "<td>$mjed</td>";
				echo "<td><input type='text' name='zoldaku'></td>";
				echo "<td><input type='submit' value='Nakoupit'></td>";
				echo "</tr>";

	 			echo "</table></form>";
  			else:
			  	echo "<br><br><center><font class=info><b>M�te u� maxim�ln� s�lu</b></font></center>";	
	  		endif;
		else:
			echo "<br><br><center><font class=info><b>��dn� �old�ci nejsou nyn� na prodej.</b></font></center>";	
		endif;


	echo "<h6><font class=kapital>K</font>oup� jednotek</h6>";
	$den=Date("U");
	if(empty($xr) or $xr<0){$xr=1;};
	$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel!='$logjmeno' and typ=0 and den<$den) order by den desc limit $xr,30");

	echo "<TABLE ".$table." ".$border." align=center width=100%>";
	echo "<tr>";
	echo "<th>�as nab�dnut�</th>";
	echo "<th>".$zaznam2['jed1_nazev']."</th>";
	echo "<th>".$zaznam2['jed2_nazev']."</th>";
	echo "<th>".$zaznam2['jed4_nazev']."</th>";
	echo "<th>".$zaznam2['jed3_nazev']."</th>";
	echo "<th>&nbsp;</th>";
	echo "</tr>";

	while($obchod = MySQL_Fetch_Array($obch)):
			$den=$obchod['den'];
			$datum = Date("G:i j.m.Y",$den);

				$urasa=$obchod['rasa'];		
				$rasa2 = MySQL_Query("SELECT * FROM rasy where rasa = $urasa");
				$rasa = MySQL_Fetch_Array($rasa2);
	
				$pj1=$j1=$obchod['jed1'];
				$pj2=$j2=$obchod['jed2'];
				$j3=$obchod['jed3'];
				$pj4=$j4=$obchod['jed4'];
				$cj1=$obchod['cj1'];
				$cj2=$obchod['cj2'];
				$cj3=$obchod['cj3'];
				$cj4=$obchod['cj4'];
echo "<font class=info>";
				if($urasa!=$trasa):
					$sj1=$j1*$rasa['jed1_obrana']+$j1*$rasa['jed1_utok'];
					$tsj1=$j1*$zaznam2['jed1_obrana']+$j1*$zaznam2['jed1_utok'];
					$sj2=$j2*$rasa['jed2_obrana']+$j2*$rasa['jed2_utok'];
					$tsj2=$j2*$zaznam2['jed2_obrana']+$j2*$zaznam2['jed2_utok'];
					$sj4=$j4*$rasa['jed4_obrana']+$j4*$rasa['jed4_utok'];
					$tsj4=$j4*$zaznam2['jed4_obrana']+$j4*$zaznam2['jed4_utok'];
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
					$cj1=($cj1/$rasa['jed1_cena'])*$zaznam2['jed1_cena'];
					$cj1=Round($cj1);
					$cj2=($cj2/$rasa['jed2_cena'])*$zaznam2['jed2_cena'];
					$cj2=Round($cj2);
					$cj3=($cj3/$rasa['jed3_cena'])*$zaznam2['jed3_cena'];
					$cj3=Round($cj3);
					$cj4=($cj4/$rasa['jed4_cena'])*$zaznam2['jed4_cena'];
					$cj4=Round($cj4);
				endif;

			echo "<tr><form name='form' method='post' action='obchod.php' >";
			echo "<td class=pole>".$datum."</td>";
			
			if($obchod['jed1']>0):
				echo "<td><input type='text' name='j1' size=5 value=$pj1> kr�t po ".$cj1."kg</td>";
				$celkem+=$obchod['jed1']*$obchod['cj1'];
			else:
				echo "<td>Nenab�z�</td>";
			endif;

			if($obchod['jed2']>0):
				echo "<td><input type='text' name='j2' size=5 value=$pj2> kr�t po ".$cj2."kg</td>";
				$celkem+=$obchod['jed2']*$obchod['cj2'];
			else:
				echo "<td>Nenab�z�</td>";
			endif;

			if($obchod['jed4']>0):
				echo "<td><input type='text' name='j4' size=5 value=$pj4> kr�t po ".$cj4."kg</td>";
				$celkem+=$obchod['jed4']*$obchod['cj4'];
			else:
				echo "<td>Nenab�z�</td>";
			endif;

			if($obchod['jed3']>0):
				echo "<td><input type='text' name='j3' size=5 value=$j3> kr�t po ".$cj3."kg</td>";
				$celkem+=$obchod['jed3']*$obchod['cj3'];
			else:
				echo "<td>Nenab�z�</td>";
			endif;

			echo "<td>
				<input type='submit' value='nakoupit'>
				<input type='hidden' name='prijm' value=".$den.">
				<input type='hidden' name='co' value='3'>
			      </td>";
			echo "</form></tr>";		
	endwhile;
	echo "</table></center>";	
	$y=$xr+20;
	$z=$xr-20;
	echo "<h6><a href=obchod.php?xr=".$z."&co=3 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>p�edchoz�ch 20 nab�dek</a><br>";
	echo "<a href=obchod.php?xr=".$y."&co=3 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>dal��ch 20 nab�dek</a></h6>";	
endif;

//-------------------------------------------------ostatn� koup�----------------------------------------------------
if($co==4):
		echo "<h6><font class=kapital>K</font>oup� hv�zdn� br�ny</h6>";
		$br = MySQL_Query("SELECT den,typ,jed1,vyr FROM obchod where (typ=2 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);
		$cena=$brana['vyr'];
		$cas=$brana['den'];
		$kolik=$brana['jed1'];
		$ted=Date("U");
		$zmena=0.3;
		$sek=($zmena*60)-($ted-$cas);

		switch ($sek){
			case 1: $sekslovy="sekunda";break;
			case 2:
			case 3:
			case 4: $sekslovy="sekundy";break;
			default: $sekslovy="sekund";		
		}

		echo "<font class=info align=center>Zde je mo�no koupit hv. br�nu, toto je neutr�ln� nab�dka. Nab�dka se m�n� ka�d� ".$zmena." minuty. P��t� zm�na za <font class=pole>".$sek."</font> ".$sekslovy."</font>";

		if($ted>($cas+60*$zmena)):
			$bran=$zaznam1['bran']+($zaznam1['bran']/2)+1;
			$bran=Round($bran);
			$katar=rand(1,$bran);
			$kolik=rand(1,$bran);
			//echo "<h6>",$katar;
			$cas=$ted;
			$cena=$zaznam2["bra_cena"]*2*$katar*$katar;
			MySQL_Query("update obchod set vyr=$cena,den=$cas,jed1=$kolik where (navrhovatel = '' and typ=2)");
		endif;

		if($kolik>0):
			switch ($kolik){
				case 1: $pred="je nab�zena";$slovo="br�na";break;
				case 2:
				case 3:
				case 4: $pred="jsou nab�zeny";$slovo="br�ny";break;
				default: $pred="je nab�zeno";$slovo="bran";		
			}

			$pla = MySQL_Query("SELECT * FROM planety where (cislomaj=$logcislo and brana=0) order by nazev desc");
			$hbran = mysql_num_rows($pla);
			
			if($hbran!=$zaznam1['planety']):
	  			echo "<form name='form' method='post' action='obchod.php' ><input type='hidden' name='co' value='4'>";
			  	echo "<table>";
  				echo "<tr>";
		  		echo "<td>Na jakou planetu koupit</td>";
	  			echo "<td><select name='kamb'>";
			  	while ($zaznam3 = MySQL_Fetch_Array($pla)):
					  echo "<option value=".$zaznam3["cislo"].">".$zaznam3["nazev"];
  				endwhile;
		   		echo "</select>";
			  	echo "</td></tr><tr>";
  				echo "<td>Hv�zdn� br�na stoj�</td>";

	  			echo "<td>".number_format($cena,0,0," ")." kg</td>";
			  	echo "</tr><tr>";
  				echo "<td colspan=2>Za tuto cenu ".$pred." ".$kolik." ".$slovo."</td>";
		  		echo "</tr><tr>";
	  			if($cena>$zaznam1['penize']):
			  		echo "<td colspan=2>Vy na n� bohu�el nem�te.</form></td>";			
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
			  	echo "<br><br><center><font class=info><b>V�echny Va�e planety maj� hv�zdnou br�nu.</b></font></center>";	
  			endif;
		else:
			echo "<br><br><center><font class=info><b>��dn� br�na nen� ihned k odb�ru.</b></font></center>";	
		endif;
		
//*************************
		echo "<h6><font class=kapital>K</font>oup� nezam�stnan�ch</h6>";

		$den=Date("U");

		$nej=MySQL_Query("SELECT den,typ,jed1,cj1,navrhovatel FROM obchod where (typ=1 and navrhovatel!='".$zaznam1['jmeno']."' and den<$den) order by cj1");
		@$nejl = MySQL_Fetch_Array($nej);

		if($nejl):
			//$nejl = MySQL_Fetch_Array($nej);
			$den=$nejl['den'];
			$koliklid=$nejl['jed1'];
			$nejlev=$nejl['cj1'];
			$mamna=Floor($zaznam1['penize']/$nejl['cj1']);

			$pla = MySQL_Query("SELECT * FROM planety where cislomaj=$logcislo order by nazev desc");

			echo "<form name='form' method='post' action='obchod.php' ><input type='hidden' name='co' value='2'>";
			echo "<table>";
			echo "<tr>";
			echo "<td>Na jakou planetu koupit</td>";
			echo "<td><select name='kaml'>";
			while ($zaznam3 = MySQL_Fetch_Array($pla)):
				echo "<option value=".$zaznam3["cislo"].">".$zaznam3["nazev"];
			endwhile;
	    		echo "</select>";
			echo "</td></tr><tr>";
			echo "<td>Kolik tis�c nez. koupit</td>";
			echo "<td><input type='text' name='koliklid' size=8 value=".$koliklid."></td>";
			echo "</tr><tr>";
			echo "<td>Tis�c nezam�stnan�ch je za</td>"; 
			echo "<td>".$nejlev." kg</td>";
			echo "</tr><tr>";
			echo "<td>Za tuto cenu m�te na</td>"; 
			echo "<td>".$mamna." tis. nez.</td>";
			echo "</tr><tr>";
			echo "<td colspan=2>
				<input type='hidden' name='co' value='4'>
				<input type='submit' value='koupit'>
				<input type='hidden' name='kup' value=".$den.">
				</form>
			       </td>";
			echo "</tr></table>";		

			echo "<h6><font class=kapital>S</font>eznam planet</h6>";

			$pla = MySQL_Query("SELECT * FROM planety where cislomaj='$logcislo' order by nazev desc");

			echo "<TABLE ".$table." ".$border." align=center>";
			echo "<tr>";
			echo "<th>n�zev planety</th>";
			echo "<th>po�et m�st</th>";
			echo "<th>celkem lid� (v tis.)</th>";
			echo "<th>m�st pro lidi (v tis.)</th>";
			echo "</tr><h6>";

			while($planety1 = MySQL_Fetch_Array($pla)):
				$lidi=Floor($planety1["lidi"]/1000);
				$zbylo=$planety1['mesta']*10000;
				$zbylo-=$lidi;
				echo "<tr>";
				echo "<td class=pole>".$planety1['nazev']."</td>";
				echo "<td>".$planety1['mesta']."</td>";
				echo "<td>".number_format($lidi,0,0," ")."</td>";
				echo "<td>".number_format($zbylo,0,0," ")."</td>";
				echo "</tr>";
			endwhile;
		else:
			echo "<center><font class=info><b>Nikdo nezam�stnan� nenab�z�.</b></font></center>";		
		endif;

endif;


	MySQL_Close($spojeni);		
?>

</body>
</html>