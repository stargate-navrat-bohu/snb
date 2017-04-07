<?php
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

$styl="styl".$zaznam1['skin'];
if($zaznam1['skin']==1 or $zaznam1['skin']==2 or $zaznam1['skin']==3 or $zaznam1['skin']==4){
    $styl="styl1";
}
?>
<script type="text/javascript" src="a.php" ></script>
<?php
$diletace=72;

if((Date("U")-$zaznam1['vek'])<($diletace*3600)){
    echo "<font class='text_cerveny'>Nemůžete obchodovat. Nejste tu ještě ani $diletace hodin a tak nejste zapsán v obchodním rejstříku.</br>Obchod pokazeny</font>";
    exit;
}

if ($zaznam1['rasa']==97 || $zaznam1['rasa']==98 ) {
    echo "<font class='text_cerveny'>Vyvrhelové nemohou obchodovat. A Furlingovia su bugnuty sry..</font><BR><BR><BR><BR><BR>";
    exit;
}
       
?>
<script type="text/javascript">
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
<a href="hlavni.php?page=obchod&amp;co=1" id=a onMouseOver=Rozsvitit('a') onMouseOut=Zhasnout('a')>Prodávání jednotek</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=obchod&amp;co=2" id=b onMouseOver=Rozsvitit('b') onMouseOut=Zhasnout('b')>Prodávání nezaměstnaných</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=obchod&amp;co=3" id=c onMouseOver=Rozsvitit('c') onMouseOut=Zhasnout('c')>Nákup jednotek</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=obchod&amp;co=4" id=d onMouseOver=Rozsvitit('d') onMouseOut=Zhasnout('d')>Ostatní koupě</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=obchod&amp;co=5" id=e onMouseOver=Rozsvitit('e') onMouseOut=Zhasnout('e')>Obchod s planetami</a>
</h6></center>
<?php
$query3 = mysql_query("SELECT obchodod FROM uzivatele where cislo='$logcislo'");
$rot3 = mysql_fetch_array($query3);
$obchodod=$rot3['obchodod'];

$casted=Date("U");  
$b=((300-($casted-$obchodod))/60);

if($casted-$obchodod<=300 && $co!=2 && $co!=3 && $co!=4 && $co!=5){
    echo "<center><font class='text_cerveny'>Další obchod je možný až za ".number_format($b,1,"."," ")." minut</font></center>";
    die;
}

$trasa=$zaznam1['rasa'];

require("kontrola.php");

$politika1 = MySQL_Query("SELECT * FROM politika where rasa ='$trasa'");
$politika = MySQL_Fetch_Array($politika1);

$narod1 = MySQL_Query("SELECT * FROM narody where cislo='".$zaznam1['narod']."'");
$narod = MySQL_Fetch_Array($narod1);

$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='".$zaznam1['zrizeni']."'");
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
        if($j1<0 or $j2<0 or $j3<0 or $j4<0){
            echo "<font class='text_cerveny'>Čísla musí být větší jak nula</font>";
            break;
        }
			
        if(is_double($j1) || is_double($j2) || is_double($j3) || is_double($j4)){
            echo "<font class='text_cerveny'>Císla nesmí být desetinná</font>";
            break;
        }
        
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
        if($cena==0 or $cena<0){echo"Asi nic neprodáváte ;)</font>";break;}
        echo "<font class=text_bili>";
        $ocena=($j1*$zaznam2['jed1_cena']*$politika['cenaj']/100)+($j2*$zaznam2['jed2_cena']*$politika['cenaj']/100)+($j4*$zaznam2['jed4_cena']*$politika['cenaj']/100)+($j3*$zaznam2['jed3_cena']*$politika['cenaj']/100*$politika['cena3j']/100);
        if(($cena/$ocena)<=0.75){echo "<font class='text_cerveny'>Zvolená celková cena nesmí být menší jak 75% výrobní ceny</font>";break;}
        if(($cena/$ocena)>=1.05){echo "<font class='text_cerveny'>Zvolená celková cena nesmí být větší jak 105% výrobní ceny</font>";break;}
        if(($zaznam1['poslobchod']+300)>Date("U")){echo "<font class='text_cerveny'>Další jednotky lze do obchodu poslat 5 minut po odeslání předchozí nabídky</font>";break;}
		if($zaznam1['jed1']<$j1){echo "<font class='text_cerveny'>Tolik jednotek nemáte</font>";break;}
		if($zaznam1['jed2']<$j2){echo "<font class='text_cerveny'>Tolik jednotek nemáte</font>";break;}
		if($zaznam1['jed3']<$j3){echo "<font class='text_cerveny'>Tolik jednotek nemáte</font>";break;}
		if($zaznam1['jed4']<$j4){echo "<font class='text_cerveny'>Tolik jednotek nemáte</font>";break;}

        $zjed1=$zaznam1['jed1']-$j1;
        $zjed2=$zaznam1['jed2']-$j2;
        $zjed3=$zaznam1['jed3']-$j3;
        $zjed4=$zaznam1['jed4']-$j4;

        $utok=$zjed1*$zaznam2['jed1_utok'];
        $utok+=$zjed2*$zaznam2['jed2_utok'];
        $utok+=$zjed4*$zaznam2['jed4_utok'];
        $utok+=$zaznam1['jed5']*$zold_utok;
        $utok*=$politika['utok']/100;
        $utok*=$narod['utok']/100;
        $utok*=$zriz['utok']/100;
        $obrana=$zjed1*$zaznam2['jed1_obrana'];
        $obrana+=$zjed2*$zaznam2['jed2_obrana'];
        $obrana+=$zjed4*$zaznam2['jed4_obrana'];
        $obrana+=$zaznam1['jed5']*$zold_obrana;
        $obrana*=$politika['obrana']/100;
        $obrana*=$narod['obrana']/100;
        $obrana*=$zriz['obrana']/100;
        $sila=$utok+$obrana;
        $obchodod=Date("U");
        MySQL_Query("update uzivatele set jed1='$zjed1',jed2='$zjed2',jed3='$zjed3',jed4='$zjed4',sila='$sila' where cislo='$logcislo'");
        MySQL_Query("update uzivatele set obchodod='$obchodod' where cislo='$logcislo'");

        $nahoda=rand(1,200);
        echo "$nahoda<br>";				
        if($nahoda==5) {
            echo "<centrum><h1>";			
            $nahoda2=rand(1,10);
            switch($nahoda2){
                case 1:	echo "Někdo změnil cíl cesty našich transportních lodí. Ty se objevily v dalekém a neprozkoumaném vesmíru a byly napadeny a zničeny. Nikdo tohle neočekával a proto byly naše jednotky nepřipravené a lehce zranitelné. Nikdo nepřežil.";
                        $kat=0;break;
                case 2:	echo "Piloti několika našich transportních lodí nezvladli průlet pásem asteroidů. Ztráty byly 70%.";
                        $kat=0.30;break;
                case 3:	echo "Piloti několika našich transportních lodí nezvladli průlet pásem asteroidů. Ztráty byly 40%.";
                        $kat=0.60;break;
                case 4:	echo "Naše přepravní lodě byly přepadeny vesmírnými piráty, spoustu našich jednotek povraždili, někteří se k nim přidali a zbytek prodali do otroctví. Ztráty byly 100%";
                        $kat=0;break;
                case 5:	echo "Skupina vesmírných pirátu se pokusila přepadnout naše transportní lodě. Ubránily se, ale i přesto ztráty byly veliké. Ztráty byly 35%";
                        $kat=0.65;break;
                case 6:	echo "Skupina vesmírných pirátu se pokusila přepadnout naše transportní lodě. Ubránily se, ale i přesto byly nějaké ztráty. Ztráty byly 10%";
                        $kat=0.9;break;
                case 7:	echo "Během transportu byly palubní počítače našich transportních lodí napadeny neznámým virem, než se podařilo vše opravit stihl neznámý virus část lodí zcela zničit. Ztráty byly 50%";
                        $kat=0.5;break;
                case 8:	echo "Několika našim pilotům se nelíbila naše vláda a tak tajně pracovali pro nepřítele. Podařilo se jim sabotovat celý náš transport. Ztráty byly 100%";
                        $kat=0;break;
                case 9:	echo "Ztratili jsme spojení s našimi transportními loděmi, nikdo neví co se stalo. Vina se připisuje na vrub špatnému stavu a zastaralosti našich transportních lodí. Ztráty byly 100%";
                        $kat=0;break;
                case 10:echo "Neznámé rase se podařilo převzít kontrolu nad našimi transportními loděmi. Jejich osud je zřejmě spečetšn. Ztráty byly 100%";
                        $kat=0;break;
            }
            echo "</font></centrum>";
            if($kat!=0){
                $j1*=$kat;$j2*=$kat;$j3*=$kat;$j4*=$kat;
                MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,jed2,jed3,jed4,cj1,cj2,cj3,cj4,vyr,typ) VALUES ('$den','$logjmeno','$trasa','$j1','$j2','$j3','$j4','$cj1','$cj2','$cj3','$cj4','$cena','0')");
                MySQL_Query("INSERT INTO obchodlog (datum,cislo,kdo,rasa,pechota,univerzal,zhn,orbit,c1,c2,c3,c4,celkcena) VALUES ('$denn','$logcislo','$logjmeno','$trasa','$j1','$j2','$j3','$j4','$cj1','$cj2','$cj3','$cj4','$cena')");
            }
        } else {
            MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,jed2,jed3,jed4,cj1,cj2,cj3,cj4,vyr,typ) VALUES ($den,'$logjmeno',$trasa,$j1,$j2,$j3,$j4,$cj1,$cj2,$cj3,$cj4,$cena,0)");
            MySQL_Query("INSERT INTO obchodlog (datum,cislo,kdo,rasa,pechota,univerzal,zhn,orbit,c1,c2,c3,c4,celkcena) VALUES ($denn,$logcislo,'$logjmeno',$trasa,$j1,$j2,$j3,$j4,$cj1,$cj2,$cj3,$cj4,$cena)");
            MySQL_Query("update uzivatele set poslobchod='$denn' where cislo='$logcislo'");
        }
    }
    while(false);
endif;

if(isset($smazn)):
    $zpet2 = MySQL_Query("SELECT * FROM obchod where den ='$smazn'");
    $zpet = MySQL_Fetch_Array($zpet2);

    $sila=$zpet['jed1']*$zaznam2['jed1_utok']+$zpet['jed1']*$zaznam2['jed1_obrana'];
    $sila+=$zpet['jed2']*$zaznam2['jed2_utok']+$zpet['jed2']*$zaznam2['jed2_obrana'];
    $sila+=$zpet['jed4']*$zaznam2['jed4_utok']+$zpet['jed4']*$zaznam2['jed4_obrana'];
    $sila+=$zaznam1['sila'];

    if($sila>$max_sila){echo "<font class='text_cerveny'>Jednotky se nemůžou vrátit, měl byste moc velkou s�lu.</font>";}
    if($zpet['navrhovatel']!=$zaznam1['jmeno']){echo "<font class='text_cerveny'>Tyto jednotky nejsou va�e.</font>";}

    $zjed1=$zaznam1['jed1']+($zpet['jed1']*0.9);
    $zjed2=$zaznam1['jed2']+($zpet['jed2']*0.9);
    $zjed3=$zaznam1['jed3']+($zpet['jed3']*0.9);
    $zjed4=$zaznam1['jed4']+($zpet['jed4']*0.9);
    MySQL_Query("update uzivatele set jed1='$zjed1',jed2='$zjed2',jed3='$zjed3',jed4='$zjed4',sila='$sila' where cislo='$logcislo'");
    MySQL_Query("DELETE FROM obchod WHERE den = '$smazn'");
endif;

if(isset($vrat)):
    do{
        $zpet2 = MySQL_Query("SELECT * FROM obchod where den = $vrat");
        $zpet = MySQL_Fetch_Array($zpet2);

        $cena=$zpet['cj1']*0.5;
        if ($cena<10) {
            $cena=Round($cena,1); 
            if ($cena==0.2) {
                $cena=0.1;
            }
        }
        else {
            $cena=Round($cena);
        }
        MySQL_Query("update obchod set cj1=$cena where den = $vrat");
    }while(false);
endif;

if(isset($kup)):
    do{
    $j1=$koliklid*1;

    $vysak2 = MySQL_Query("SELECT * FROM obchod where den = '$kup'");
    $zaz = MySQL_Fetch_Array($vysak2);

    $cj1=$zaz['cj1'];
    $jrasa=$zaz['rasa'];

    $politika22 = MySQL_Query("SELECT rasa,koupe,prodej FROM politika where rasa = '$jrasa'");
    $politika2 = MySQL_Fetch_Array($politika22);

    $planetak = MySQL_Query("SELECT nazev,cislo,mesta,lidi FROM planety where cislo = '$kaml'");
    $pl = MySQL_Fetch_Array($planetak);

    $kcena=$koliklid*$cj1;
    $pcena=$koliklid*$cj1;

    if($j1>$zaz['jed1']){echo "<font class='text_cerveny'>Tolik lidí v nabídce není</font>";break;}
    if($j1<0){echo "<font class='text_cerveny'>Čísla musí být větší než nula</font>";break;}
    if(($pl['lidi']+($j1*1000))>($pl['mesta']*60000000)){echo"<font class='text_cerveny'>Tolik lidí se na cílovou planetu nevejde</font>";break;}
    if($kcena>$zaznam1['penize']){echo "<font class='text_cerveny'>Tolik naquadahu nemáte.</font>";break;}

    $on=$zaz['navrhovatel'];
    $prodejce = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$on'");
    $prod = MySQL_Fetch_Array($prodejce);

    $posta=$prod['posta2']+1;
    $postab=$zaznam1['posta2']+1;
    $pocena=$pcena*($politika2['koupe']/100);
    $text="Koupil Vámi nabízené obyvatele celkem za ".$pocena."kg naquadahu";
    $textt="Koupil jste nabízené obyvatele celkem za ".$pocena."kg naquadahu";
    $nazev="Obchod s otroky";

    $den=Date("U");
    MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,text,stav,nepr,typ,smaz) VALUES ('$den','".$zaznam1['jmeno']."','$on','$nazev','$trasa','$textt','1','1','2','0')");
    MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,text,stav,nepr,typ,smaz) VALUES ('$den','$on','".$zaznam1['jmeno']."','$nazev','".$prod['rasa']."','$text','1','1','2','0')");

    $p1=$zaznam1['penize']-($kcena*$politika['prodej']/100);
    $p2=$prod['penize']+($pcena*$politika2['koupe']/100);

    $je1=$pl['lidi']+($j1*1000);
    MySQL_Query("update planety set lidi='$je1' where cislo='$kaml'");
    MySQL_Query("update uzivatele set penize='$p2', posta2='$posta' where jmeno = '$on'");
    MySQL_Query("update uzivatele set penize='$p1', posta2='$postab' where cislo = '$logcislo'");

    $j1=$zaz['jed1']-$j1;
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
    $jrasa=$zaz[rasa];
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

    if($tsc>150000000){echo "<font class='text_cerveny'>Nesmíte mít sílu větší jak 150 miliónů</font>";break;}

    $mj2=$mj1=$mj4=$pj4=$pj2=$pj1=0;

    if($sj1>0):
        $pomer1=$tsj1/$sj1;
        $pj1=ceil($pomer1*$j1);
        $pomer11=$sj1/$tsj1;			
        $mj1=ceil($pomer11*$zaz['jed1']);
    endif;
    if($pj1==0 && $j1>0){$pj1=1;}
    if($sj2>0):
        $pomer2=$tsj2/$sj2;
        $pj2=ceil($pomer2*$j2);
        $pomer21=$sj2/$tsj2;
        $mj2=Ceil($pomer21*$zaz['jed2']);
    endif;
    if($pj2==0 && $j2>0){$pj2=1;}
    if($sj4>0):
        $pomer4=$tsj4/$sj4;
        $pj4=ceil($pomer4*$j4);
        $pomer41=$sj4/$tsj4;
        $mj4=ceil($pomer41*$zaz['jed4']);
    endif;
    if($pj2==0 && $j2>0){$pj2=1;}
    $mj3=$zaz['jed3'];
    $pj3=$j3;
    $kcena=$j1*$cj1+$j2*$cj2+$j3*$cj3+$j4*$cj4;
    $pcena=$zaz['cj1']*$pj1+$zaz['cj2']*$pj2+$zaz['cj3']*$pj3+$zaz['cj4']*$pj4;
    $pcena*=0.8;

    if(($j1>$mj1) or ($j2>$mj2) or ($j3>$mj3) or ($j4>$mj4)){echo "<font class='text_cerveny'>Tolik jednotek v nabídce není</font>";break;}
    if(($j1<0) or ($j2<0) or ($j3<0) or ($j4<0)){echo "<font class='text_cerveny'>Čísla musí být větší než nula</font>";break;}
    if($kcena>$zaznam1['penize']){echo "<font class='text_cerveny'>Tolik naquadahu nemáte.</font>";break;}
    if(is_double($j1) or is_double($j2) or is_double($j3) or is_double($j4)){echo "<font class='text_cerveny'>Čísla nesmí být desetinná</font>";break;}

    $on=$zaz['navrhovatel'];
    $prodejce = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$on'");
    $prod = MySQL_Fetch_Array($prodejce);

    $posta=$prod['posta2']+1;
    $pocena=$pcena*($politika2['koupe']/100);
    $trasa2=Addslashes($zaznam2['nazevrasy']);
    $jrasa2=Addslashes($rasa2['nazevrasy']);		
    $text="Koupil Vámi nabízené jednotky celkem za ".$pocena." kg naquadahu";
    $nazev="Prodej jednotek";

    $denp=Date("U");
    MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,rasa2,text,stav,nepr,typ,smaz) VALUES ($denp,'$logjmeno','$on','$nazev','$trasa2','$jrasa2','$text','1','1','2','0')");

    $p1=$zaznam1['penize']-($kcena*$politika['prodej']/100);
    $p2=$prod['penize']+($pcena*$politika2['koupe']/100);

    $j1=$zaznam1['jed1']+$j1;
    $j2=$zaznam1['jed2']+$j2;
    $j3=$zaznam1['jed3']+$j3;
    $j4=$zaznam1['jed4']+$j4;

    MySQL_Query("update uzivatele set jed1=$j1,jed2=$j2,jed3=$j3,jed4=$j4,penize=$p1 where cislo=$logcislo");
    MySQL_Query("update uzivatele set penize=$p2, posta2=$posta where jmeno = '$on'");

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
//--------------gold prodej vsech nezamestnanych

$poc_gold=0;
if ($zaznam1['admin']==1 or $zaznam1['jmeno']=='Mario'):
	if(isset($lidipr_gold)):
	
        $plan_gold = MySQL_Query("SELECT cislo FROM planety where cislomaj = ".$zaznam1['cislo']." AND (status=1 OR status=0)");
        $poc_gold=-1;

        while($od_gold = MySQL_Fetch_Row($plan_gold)):
            $poc_gold++;
            $odkudl=$od_gold[$poc_gold];

            if($lidice<0.1){
                echo "<font class='text_cerveny'>0.1 je minimální cena. Nezamestnané není možné nabídnout levněji.</font>";
                break;
            }

            do{
                $odkud = MySQL_Query("SELECT majitel,nazev,vyrobna,lidi,sdi,laborator FROM planety where cislo = $odkudl");
                @$od = MySQL_Fetch_Array($odkud);
                $odkudlj=$od['nazev'];
                $nez=$od["lidi"]-$od["vyrobna"]*$zaznam2['vyr_lidi'];
                $nez-=$od["sdi"]*$zaznam2['sdi_lidi'];
                $nez-=$od["laborator"];

                $zbylo=$od['lidi']-$nez;
                $den=Date("U");

                $minut=rand(1,15);
                $minut=$minut*60;
                $den+=$minut;
                $lidipr=$nez;

                if ($lidipr>0){
                    MySQL_Query("update planety set lidi='$zbylo' where cislo = '$odkudl'");
                    MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,cj1,typ) VALUES ('$den','$logjmeno','".$zaznam1['rasa']."','$lidipr','$lidice',1)");
                }

            }while(false);
        endwhile;
    endif;
endif;

//----------------------------------------------
if(isset($lidipr) && $poc_gold<1):
	do{
        $odkud = MySQL_Query("SELECT * FROM planety where cislo = $odkudl");

        if(!$odkud){
            echo "<font class='text_cerveny'>Planeta "; 
            echo $odkudlj;
            echo"neexistuje</font>";
            break;
        }

        $od = MySQL_Fetch_Array($odkud);
        $odkudlj=$od[nazev];
        $lidice*=1;
        $lidipr*=1;

        if (is_int($lidipr)):
            if($lidipr<=0){echo "<font class='text_cerveny'>Musíte zadávat kladná čísla</font>";break;}
			if($lidice<=0){echo "<font class='text_cerveny'>Musíte zadávat kladná čísla</font>";break;}
			if($lidice<0.1){echo "<font class='text_cerveny'>0.1 je minimální cena. Nezamestnané není možné nabídnout levněji.</font>";break;}
            if($od['majitel']!=$logjmeno){echo "<font class='text_cerveny'>Planeta ".$odkudl." není Vaše</font>";break;}
			if($lidipr>5000000){echo "<font class='text_cerveny'>Najednou můžete prodat maximálně 5 miliard nezaměstnaných</font>";break;}
			
            if($lidipr<=0 OR $lidice<=0 OR $lidice<0.1 OR $od['majitel']!=$logjmeno OR $lidipr>5000000):
            else:
                $lidipr=abs($lidipr);
                $kolik=$lidipr*1000;

                $nez=$od["lidi"]-$od["vyrobna"]*$zaznam2['vyr_lidi'];
                $nez-=$od["sdi"]*$zaznam2['sdi_lidi'];
                $nez-=$od["laborator"];

                if($kolik<=$nez):
                    $zbylo=$od['lidi']-$kolik;
                    $den=Date("U");

                    $minut=rand(1,15);
                    $minut=$minut*60;
                    $den+=$minut;

                    MySQL_Query("update planety set lidi='$zbylo' where cislo = '$odkudl'");
                    MySQL_Query("INSERT INTO obchod (den,navrhovatel,rasa,jed1,cj1,typ) VALUES ('$den','$logjmeno','".$zaznam1['rasa']."','$lidipr','$lidice',1)");
                else:
                    echo "<font class='text_cerveny'>Tolik nezaměstnaných lidí na planetě ".$odkudlj." není.</font>";
                endif;
			endif;
        else: 
            break;
        endif;
    }while(false);
endif;

if(isset($kupbr)):
    do{
        $br = MySQL_Query("SELECT den,typ,jed1,vyr FROM obchod where (typ=2 and navrhovatel='')");
        $brana = MySQL_Fetch_Array($br);
        $pl = MySQL_Query("SELECT cislo,nazev,brana,cislomaj FROM planety where cislo=$kamb");
        $planeta = MySQL_Fetch_Array($pl);

        if($brana['vyr']>$zaznam1['penize']){echo "<font class='text_cerveny'>Nemáte dost naquadahu</font>";break;}
        if($logcislo!=$planeta['cislomaj']){echo "<font class='text_cerveny'>Planeta ".$paneta['nazev']." není vaše.</font>";break;}
        if(0<$planeta['brana']){echo "<font class='text_cerveny'>Na planetě ".$paneta['nazev']." už hvězdná brána je.</font>";break;}
        if(1>$brana['jed1']){echo "<font class='text_cerveny'>Bohužel v nabídce už žádná brána neni, někdo vás předběhl.</font>";break;}

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

        if($zoldaku<0){echo "<font class='text_cerveny'>Císlo musí být větší jak dvě</font>";break;}
        if($celkem>$zaznam1['penize']){echo "<font class='text_cerveny'>Nemáte dost naquadahu</font>";break;}
        if($sila+$zaznam1['sila']>$max_sila){echo "<font class='text_cerveny'>Měl byste větší sílu než ".$max_sila."</font>";break;}
        if($zoldaku>$brana['jed1']){echo "<font class='text_cerveny'>Bohužel v nabídce tolik žoldáků není.</font>";break;}

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

$vys1 = MySQL_Query("SELECT * FROM `uzivatele` where `cislo`='$logcislo'");
$zaznam1 = MySQL_Fetch_Array($vys1);

echo "<center>";

//*******	
echo "<h6>Celkem máte naquadahu: ";
echo number_format($zaznam1['penize'],2,"."," ");
echo"</h6>";
//-------------------------------------------------prodej jednotek----------------------------
if($co==1 or empty($co)):
	echo "<h6><font class=text_modry>P</font>rodej jednotek</h6>";
	echo "<form name='form' method='post' action='hlavni.php?page=obchod'>";
	echo "<input type='hidden' name='co' value='1'>";
	echo "<TABLE ".$table." ".$border." align=center>";
	echo "<tr>";
	echo "<th>typ jednotky</th>";
	echo "<th>m�te</th>";
	echo "<th>v�robn� cena</th>";
	echo "<th>prodat jednotek</th>";
	echo "<th>cena jedn�</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=text_modry>".$zaznam2['jed1_nazev']."</td>";
	echo "<td>".$zaznam1['jed1']."</td>";
	echo "<td>".($zaznam2['jed1_cena']*$politika['cenaj']/100)."</td>";
	echo "<td><input type='text' name='j1' size=6></td>";
	echo "<td><input type='text' name='cj1' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=text_modry>".$zaznam2['jed2_nazev']."</td>";
	echo "<td>".$zaznam1['jed2']."</td>";
	echo "<td>".($zaznam2['jed2_cena']*$politika['cenaj']/100)."</td>";
	echo "<td><input type='text' name='j2' size=6></td>";
	echo "<td><input type='text' name='cj2' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=text_modry>".$zaznam2['jed4_nazev']."</td>";
	echo "<td>".$zaznam1['jed4']."</td>";
	echo "<td>".($zaznam2['jed4_cena']*$politika['cenaj']/100)."</td>";
	echo "<td><input type='text' name='j4' size=6></td>";
	echo "<td><input type='text' name='cj4' size=3></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=text_modry>".$zaznam2['jed3_nazev']."</td>";
	echo "<td>".$zaznam1['jed3']."</td>";
	echo "<td>".($zaznam2['jed3_cena']*$politika['cenaj']/100*$politika['cena3j']/100)."</td>";
	echo "<td><input type='text' name='j3' size=6></td>";
	echo "<td><input type='text' name='cj3' size=3></td>";
	echo "</tr>";
	echo "</table>";

	echo "<br><input type='submit' value='Odeslat nabídku do obchodu'></td></form>";

	$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel='$logjmeno' and typ=0) order by den desc ");
	echo "<br><h6><font class=text_modry>V</font>aše obchodní nabídky</h6>";
	echo "<center><font class=text_bili>Po odeslání nabídky se Vaše jednotky převádějí do vesmírného skladu. To může trvat 5 minut, ale také až 60 minut.</font></center><br>";
	echo "<center><font class=text_bili>Při zrušení nabídky se vrátí zpět jen 90% jednotek!</font></center><br>";

	echo "<TABLE ".$table." ".$border." align=center>";
	echo "<tr>";
	echo "<th>Datum nabídnutí</th>";
	echo "<th>status</th>";
	echo "<th>".$zaznam2['jed1_nazev']."</th>";
	echo "<th>".$zaznam2['jed2_nazev']."</th>";
	echo "<th>".$zaznam2['jed4_nazev']."</th>";
	echo "<th>".$zaznam2['jed3_nazev']."</th>";
	echo "<th>Celková cena</th>";
	echo "<th>&nbsp;</th>";
	echo "</tr>";
		
	$ted=Date("U");

	while($obchod = MySQL_Fetch_Array($obch)):
        $den=$obchod['den'];
        $datum = Date("j.m.Y",$den);

        echo "<tr><form name='form' method='post' action='hlavni.php?page=obchod' >";
        echo "<td class=text_modry>".$datum."</td>";

        if($den>$ted):
            echo "<td><font color='red'>&nbsp;&nbsp;transport&nbsp;&nbsp;</td>";
        else:
            echo "<td><font color='green'>&nbsp;&nbsp;nab�zeno&nbsp;&nbsp;</font></td>";	
        endif;


        if($obchod['jed1']>0):
            echo "<td>".$obchod['jed1']." * po ".$obchod['cj1']."NQ</td>";
            $celkem+=$obchod['jed1']*$obchod['cj1'];
        else:
            echo "<td>N/A</td>";
        endif;

        if($obchod['jed2']>0):
            echo "<td>".$obchod['jed2']." * po ".$obchod['cj2']."NQ</td>";
            $celkem+=$obchod['jed2']*$obchod['cj2'];
        else:
            echo "<td>N/A</td>";
        endif;

        if($obchod['jed4']>0):
            echo "<td>".$obchod['jed4']." * po ".$obchod['cj4']."NQ</td>";
            $celkem+=$obchod['jed4']*$obchod['cj4'];
        else:
            echo "<td>N/A</td>";
        endif;

        if($obchod['jed3']>0):
            echo "<td>".$obchod['jed3']." * po ".$obchod['cj3']."NQ</td>";
            $celkem+=$obchod['jed3']*$obchod['cj3'];
        else:
            echo "<td>N/A</td>";
        endif;

        echo "<td>".$celkem." kg </td>";
        echo "<td>
                <input type='submit' value='zruš nabídku'>
                <input type='hidden' name='smazn' value=".$den.">
                <input type='hidden' name='co' value='1'>
              </td>";
        echo "</form></tr>";
        $celkem=0;
	endwhile;
	echo "</table>";
endif;

//-------------------------------------------------prodej nezamestnanych----------------------------------
if($co==2):
	if(isset($nastaveni)):
        do{
			if($nastaveni<=0){echo "<font class='text_cerveny'>Mus�te zad�vat klad� ��sla</font>";break;}			
			if($nastaveni<0.1){echo "<font class='text_cerveny'>0.10 je minim�ln� cena. Nezam�stnan� nen� mo�n� nab�dnout levn�ji.</font>";break;};			
                        if(is_double($nastaveni)){echo "<font class='text_cerveny'>��sla nesm� b�t desetinn�</font>";break;};	
    	                if($nastaveni<0){echo "<font class='text_cerveny'>��sla mus� b�t v�t�� jak nula</font>";break;};
         
                       if(!( is_numeric($nastaveni))){echo "<font class='text_cerveny'>Zad�na mohou b�t jen ��sla</font>";break;};
$nastaveni=abs($nastaveni);

		$nas = MySQL_Query("SELECT nastaveniobch FROM uzivatele where cislo='$logcislo' ");
		$nass = MySQL_Fetch_Array($nas);

		MySQL_Query("update uzivatele set nastaveniobch='$nastaveni' where cislo='$logcislo'");
  
		}while(false);
	endif;

		$nas1 = MySQL_Query("SELECT `nastaveniobch` FROM `uzivatele` WHERE `cislo` ='$logcislo'"); 
    //MySQL_Error();
		$nass = MySQL_Fetch_Array($nas1);
    

	if($politika[status]==3):
		echo "<h6><font class=text_modry>P</font>rodej nezam�stnan�ch</h6>";

		$pla = MySQL_Query("SELECT * FROM planety where cislomaj=$logcislo order by nazev desc");

		echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";
		echo "<table>";
		echo "<tr>";
		echo "<td>Z jak� planety prodat </td>";
		echo "<td><select name='odkudl'>";
		while ($zaznam3 = MySQL_Fetch_Array($pla)):
			$check="";
			if($zaznam3["cislo"]==$odkudl){$check="selected";};
			echo "<option value='".$zaznam3["cislo"]."' ".$check.">".$zaznam3["nazev"];
		endwhile;
    		echo "</select>";
		echo "</td></tr><tr>";
		echo "<td>Kolik tis�c nez. prodat</td>";
		echo "<td><input type='text' name='lidipr' size=8>
                      <input type='hidden' name='lidice' value=".$nass[nastaveniobch]."></td>";
		echo "</tr><tr>";
		echo "<td colspan=2><input type='submit' value='prodat'></form></td>";
		echo "</tr><tr>";


		echo "<td>Nastavit cenu za tis�c nezam�stnan�ch</td>";
                echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";	
		echo "<td><input type='text' name='nastaveni' size=5 value=".$nass[nastaveniobch]."></td>";
		echo "</tr><tr>";
                echo "<td colspan=2><input type='submit' value='nastavit'></form></td>";
                echo "</tr><tr>";
		
  if ($zaznam1[gold]==1 or $zaznam1[silver]==1 or  $zaznam1[jmeno]=='Mario'):  
    echo "<td>Prodat v�echny nezam�stnan� ze v�ech planet (zatim nefunkcni ;) )</td>";
    echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";	
		echo "<input type='hidden' name='lidice' value=".$nass[nastaveniobch].">";
    echo "<input type='hidden' name='lidipr_gold' value='1'>";
    echo "</tr><tr>";
    echo "<td colspan=2><input type='submit' value='prodat'></form></td>";
	endif;	
    
    echo "</tr></table>";		

	
		$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel='$logjmeno' and typ='1') order by den desc ");

		echo "<TABLE ".$table." ".$border." align=center>";
		echo "<tr>";
		echo "<th>Datum nab�dnut�</th>";
		echo "<th>status</th>";
		echo "<th>nezam�stnan�ch (v tis�c�ch M)</th>";
		echo "<th>cena za tis�c nezam�stnan�ch</th>";
		echo "<th>Celkov� cena</th>";
		echo "<th>&nbsp;</th>";
		echo "</tr>";

		$ted=Date("U");
		while($obchod = MySQL_Fetch_Array($obch)):
			$den=$obchod[den];
			$datum = Date("j.m.Y",$den);
			echo "<tr><form name='form' method='post' action='hlavni.php?page=obchod' >";
			echo "<td>".$datum."</td>";

			if($den>$ted):
				echo "<td><font color='red'>&nbsp;&nbsp;transport&nbsp;&nbsp;</td>";
			else:
				echo "<td><font color='green'>&nbsp;&nbsp;nab�zeno&nbsp;&nbsp;</font></td>";	
			endif;

			echo "<td>".$obchod[jed1]."</td>";
			echo "<td>".$obchod[cj1]."</td>";			
			echo "<td>".($obchod[jed1]*$obchod[cj1])."</td>";
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
		echo "<th>n�zev planet</th>";
		echo "<th>po�et m�st</th>";
		echo "<th>celkem lid� (v tis.M)</th>";
		echo "<th>z toho nezam�stnan�ch (v tis.M)</th>";
		echo "</tr>";

		while($planety1 = MySQL_Fetch_Array($pla)):
			$nez=$planety1["lidi"]-$planety1["vyrobna"]*$zaznam2[vyr_lidi];
			$nez-=$planety1["sdi"]*$zaznam2[sdi_lidi];
			$nez-=$planety1["laborator"]*$zaznam2[lab_lidi];
			$nez=Floor($nez/1000);
			$lidi=Floor($planety1["lidi"]/1000000);
		$nas = MySQL_Query("SELECT nastaveniobch FROM uzivatele where cislo='$logcislo' ");
		$nass = MySQL_Fetch_Array($nas);
			echo "<tr>";
			echo "<td class=text_modry>".$planety1[nazev]."</td>";
			echo "<td>".$planety1[mesta]."</td>";
			echo "<td>".number_format($lidi,0,0," ")."</td>";
                        echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";
                        echo "<td>
                        <input type='hidden' name='lidice' value=".$nass[nastaveniobch].">
                        <input type='hidden' name='lidipr' value=".$nez.">
                        <input type='hidden' name='odkudl' value=".$planety1[cislo].">";
		      
          //  <input type='submit' value=".number_format($nez,0,0," ")."></td>";
		        
echo "<input type='submit' value='";
echo floor($nez);
echo"'></td>";
		        
			echo "</form></tr>";
		endwhile;

	else:
		echo "<font class='text_cerveny'>Jen rasy se statusem zl� m��ou prod�vat lidi.</font>";
	endif;

	echo "</table>";
//else:
///echo"opravuje se....";
endif;//endif;

//-------------------------------------------------koup� jednotek----------------------------------
if($co==3):
	echo "<h6><font class=text_modry>K</font>oup� n�jemn�ch vrah�</h6>";
		$br = MySQL_Query("SELECT den,typ,jed1,cj1 FROM obchod where (typ=3 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);
		$cena=$brana[cj1];
		$cas=$brana[den];
		$kolik=$brana[jed1];
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

		echo "<font class=text_bili align=center>Zde je mo�no najmout nov� n�jemn� vrahy, jde o neutr�ln� nab�dku. Nab�dka se m�n� ka�d� ".$zmena." minuty. Dal�� zm�na bude za <font class=text_modry>".$sek."</font> ".$sekslovy."</font>";

		if($ted>($cas+60*$zmena)):
			$bran=7500;
			$bran=Round($bran);
			$katar=rand(-2,4);
			$kolik=rand($bran/2,$bran);
			//echo "<h6>",$katar;
			$cas=$ted;
			//----------$cena=$zaznam2["vyr_vyrob"]*$zold_cena*(1+$katar/10);
			$cena=$zaznam2["vyr_vyrob"]*(1+$katar/10);
			$cena*=45;

			MySQL_Query("update obchod set cj1=$cena,den=$cas,jed1=$kolik where (navrhovatel = '' and typ=3)");
			MySQL_Query("INSERT INTO `obchod` VALUES (1083404776, '', 0, 62, 0, 0, '0.0', '0.0', '0.0', 291600000, 0, '0.0', 3,0);");
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
				$mjed=Floor($zaznam1[penize]/$cena);
				if($mjed>$kolik){$mjed=$kolik;};

				if($zold_mist==0):$zold_lidi="nezab�raj�";
				else:$zold_lidi=$zold_mist;
				endif;
  				echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='3'>";
	echo "<TABLE ".$table." ".$border." align=center width=100%>";
				echo "<tr>";
				echo "<th>typ jednotky</th>";
				echo "<th>�tok / obrana</th>";
				echo "<th>m�st v kas�rn�ch</th>";
				echo "<th>cena</th>";
				echo "<th>je v nab�dce</th>";
				echo "<th>m�te na</th>";
				echo "<th>chcete koupit</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class=text_modry>".$zold_nazev."</td>";
				echo "<td>".($zold_utok*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".($zold_obrana*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td>".$zold_lidi."</td>";
				echo "<td>".$cena."</td>";
				echo "<td>".$kolik."</td>";
				echo "<td>$mjed</td>";
				echo "<td><input type='text' name='zoldaku'></td>";
				echo "<td><input type='submit' value='Koupit'></td>";
				echo "</tr>";

	 			echo "</table></form>";
  			else:
			  	echo "<br><br><center><font class=text_bili><b>M�te u� maxim�ln� s�lu</b></font></center>";	
	  		endif;
		else:
			echo "<br><br><center><font class=text_bili><b>��dn� N�jemn� vrazi nejsou nyn� k dispozici.</b></font></center>";	
		endif;


	echo "<h6><font class=text_modry>N</font>�kup jednotek</h6>";
	$den=Date("U");
	if(empty($xr) or $xr<0){$xr=1;};
	$obch = MySQL_Query("SELECT * FROM obchod where (navrhovatel!='$logjmeno' and typ=0 and den<$den) order by den desc limit $xr,30");

	echo "<TABLE ".$table." ".$border." align=center width=100%>";
	echo "<tr>";
	echo "<th>�as a datum nab�dnut�</th>";
	echo "<th>".$zaznam2[jed1_nazev]."</th>";
	echo "<th>".$zaznam2[jed2_nazev]."</th>";
	echo "<th>".$zaznam2[jed4_nazev]."</th>";
	echo "<th>".$zaznam2[jed3_nazev]."</th>";
	echo "<th>&nbsp;</th>";
	echo "</tr>";

	while($obchod = MySQL_Fetch_Array($obch)):
			$den=$obchod[den];
			$datum = Date("G:i j.m.Y",$den);

				$urasa=$obchod[rasa];		
				$rasa2 = MySQL_Query("SELECT * FROM rasy where rasa = $urasa");
				$rasa = MySQL_Fetch_Array($rasa2);
	
				$pj1=$j1=$obchod[jed1];
				$pj2=$j2=$obchod[jed2];
				$j3=$obchod[jed3];
				$pj4=$j4=$obchod[jed4];
				$cj1=$obchod[cj1];
				$cj2=$obchod[cj2];
				$cj3=$obchod[cj3];
				$cj4=$obchod[cj4];
				
				  //if(is_double($pj1) or is_double($pj2) or is_double($j3) or is_double($pj4)){echo "<font class='text_cerveny'>��sla nesm� b�t desetinn�</font>";break;};	
    	    //if($pj1<0 or $pj2<0 or $j3<0 or $pj4<0){echo "<font class='text_cerveny'>��sla mus� b�t v�t�� jak nula</font>";break;};
          //if(!(ctype_digit($pj1) and ctype_digit($pj2) and ctype_digit($j3) and ctype_digit($pj4))){echo "<font class='text_cerveny'>Zad�na mohou b�t jen ��sla</font>";break;};	
	  	    
	  	    
echo "<font class=text_bili>";
				if($urasa!=$trasa):
					$sj1=$j1*$rasa[jed1_obrana]+$j1*$rasa[jed1_utok];
					$tsj1=$j1*$zaznam2[jed1_obrana]+$j1*$zaznam2[jed1_utok];
					$sj2=$j2*$rasa[jed2_obrana]+$j2*$rasa[jed2_utok];
					$tsj2=$j2*$zaznam2[jed2_obrana]+$j2*$zaznam2[jed2_utok];
					$sj4=$j4*$rasa[jed4_obrana]+$j4*$rasa[jed4_utok];
					$tsj4=$j4*$zaznam2[jed4_obrana]+$j4*$zaznam2[jed4_utok];
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
					$cj1=($cj1/$rasa[jed1_cena])*$zaznam2[jed1_cena];
					$cj1=Round($cj1);
					$cj2=($cj2/$rasa[jed2_cena])*$zaznam2[jed2_cena];
					$cj2=Round($cj2);
					$cj3=($cj3/$rasa[jed3_cena])*$zaznam2[jed3_cena];
					$cj3=Round($cj3);
					$cj4=($cj4/$rasa[jed4_cena])*$zaznam2[jed4_cena];
					$cj4=Round($cj4);
				endif;

			echo "<tr><form name='form' method='post' action='hlavni.php?page=obchod' >";
			echo "<td class=text_modry>".$datum."</td>";
			
			if($obchod[jed1]>0):
				echo "<td><input type='text' name='j1' size=5 value=$pj1> kr�t po ".$cj1."kg</td>";
				$celkem+=$obchod[jed1]*$obchod[cj1];
	
    	   if($pj1<0){echo "<font class='text_cerveny'>��sla mus� b�t v�t�� jak nula</font>";break;};
         //if(!(ctype_digit($pj1))){echo "<font class='text_cerveny'>Zad�na mohou b�t jen ��sla</font>";break;};	
			//if(!(is_numeric($pj1))){echo "<font class='text_cerveny'>Zad�na mohou b�t jen ��sla</font>";break;};	
			if(!(is_numeric($pj1))){echo "<font class='text_cerveny'>Zad�na mohou b�t jen ��sla</font>";break;};	
			
      
      else:
				echo "<td>Nenab�z�</td>";
			endif;

			if($obchod[jed2]>0):
				echo "<td><input type='text' name='j2' size=5 value=$pj2> kr�t po ".$cj2."kg</td>";
				$celkem+=$obchod[jed2]*$obchod[cj2];
			else:
				echo "<td>Nenab�z�</td>";
			endif;

			if($obchod[jed4]>0):
				echo "<td><input type='text' name='j4' size=5 value=$pj4> kr�t po ".$cj4."kg</td>";
				$celkem+=$obchod[jed4]*$obchod[cj4];
			else:
				echo "<td>Nenab�z�</td>";
			endif;

			if($obchod[jed3]>0):
				echo "<td><input type='text' name='j3' size=5 value=$j3> kr�t po ".$cj3."kg</td>";
				$celkem+=$obchod[jed3]*$obchod[cj3];
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
	$y=$xr+50;
	$z=$xr-50;
	echo "<h6><a href=hlavni.php?page=obchod&xr=".$z."&co=3 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>p�edchoz�ch 50 nab�dek</a><br>";
	echo "<a href=hlavni.php?page=obchod&xr=".$y."&co=3 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>dal��ch 50 nab�dek</a></h6>";	
endif;

//-------------------------------------------------ostatn� koup�----------------------------------------------------
if($co==4):
		echo "<h6><font class=text_modry>N</font>�kup hv�zdn�ch bran</h6>";
		$br = MySQL_Query("SELECT den,typ,jed1,vyr FROM obchod where (typ=2 and navrhovatel='')");
		$brana = MySQL_Fetch_Array($br);
		$cena=$brana[vyr];
		$cas=$brana[den];
		$kolik=$brana[jed1];
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

		echo "<font class=text_bili align=center>Zde je mo�no koupit hv�zdn� br�ny, jde o neutr�ln� nab�dky. Nab�dka se m�n� ka�d� ".$zmena." minuty. P��t� zm�na bude za <span><font class=text_modry>".$sek."</font></span> ".$sekslovy."</font>";

		if($ted>($cas+60*$zmena)):
			$bran=$zaznam1[bran]+($zaznam1[bran]/2)+1;
			$bran=Round($bran);
			$katar=rand(1,$bran);
			$kolik=rand(1,$bran);
			//echo "<h6>",$katar;
			$cas=$ted;
			$cena=$zaznam2["bra_cena"]*2*$katar*$katar*15000;
			MySQL_Query("update obchod set vyr='$cena',den='$cas',jed1='$kolik' where (navrhovatel = '' and typ=2)");
			MySQL_Query("INSERT INTO `obchod` VALUES (1083404775, '', 0, 62, 0, 0, '0.0', '0.0', '0.0', 291600000, 0, '0.0', 2,0);");
		endif;

		if($kolik>0):
			switch ($kolik){
				case 1: $pred="je nab�zena";$slovo="br�na";break;
				case 2:
				case 3:
				case 4: $pred="jsou nab�zeny";$slovo="br�ny";break;
				default: $pred="je nab�zeno";$slovo="bran";		
			}

			$pla = MySQL_Query("SELECT brana,cislomaj FROM planety where (cislomaj=$logcislo and brana=1) order by nazev desc");
			$hbran = mysql_num_rows($pla);
			
			if($hbran<$zaznam1[planety]):
          $pla = MySQL_Query("SELECT * FROM planety where (cislomaj=$logcislo and brana=0) order by nazev desc");
	  			echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='4'>";
			  	echo "<table>";
  				echo "<tr>";
		  		echo "<td>Na kterou planetu si p�ejete hv�zdnou br�nu koupit</td>";
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
	  			if($cena>$zaznam1[penize]):
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
			  	echo "<br><br><center><font class=text_bili><b>Na v�ech na�ich planet�ch m�me hv�zdn� br�ny.</b></font></center>";	
  			endif;
		else:
			echo "<br><br><center><font class=text_bili><b>Moment�ln� nen� nab�zena ��dn� hv�zdn� br�na. P�ij�te pozd�ji.</b></font></center>";	
		endif;
		
//*************************
		echo "<h6><font class=text_modry>N</font>�kup nezam�stnan�ch</h6>";

		$den=Date("U");

		$nej=MySQL_Query("SELECT den,typ,jed1,cj1,navrhovatel FROM obchod where (typ=1 and navrhovatel!='$zaznam1[jmeno]' and den<$den) order by cj1");
		@$nejl = MySQL_Fetch_Array($nej);

		if($nejl):
			//$nejl = MySQL_Fetch_Array($nej);
			$den=$nejl[den];
			$koliklid=$nejl[jed1];
			$nejlev=$nejl[cj1];
			$mamna=Floor($zaznam1[penize]/$nejl[cj1]);

			$pla = MySQL_Query("SELECT * FROM planety where cislomaj=$logcislo order by nazev asc");

			echo "<form name='form' method='post' action='hlavni.php?page=obchod' ><input type='hidden' name='co' value='2'>";
			echo "<table>";
			echo "<tr>";
			echo "<td>Na jakou planetu koupit nezam�stnan�</td>";
			echo "<td><select name='kaml'>";
			while ($zaznam3 = MySQL_Fetch_Array($pla)):
				$check="";
				if($zaznam3["cislo"]==$kaml){$check="selected";};			
				echo "<option value=".$zaznam3["cislo"]." $check>".$zaznam3["nazev"];
			endwhile;
	    		echo "</select>";
			echo "</td></tr><tr>";
			echo "<td>Kolik nezam�stnan�ch chcete koupit (v tis�c�ch)</td>";
			echo "<td><input type='text' name='koliklid' size=8 value=".$koliklid."></td>";
			echo "</tr><tr>";
			echo "<td>1000 nezam�stnan�ch je moment�ln� nab�zen za</td>"; 
			echo "<td>".$nejlev." kg</td>";
			echo "</tr><tr>";
			echo "<td>za tuto cenu si m��ete koupit</td>"; 
			echo "<td>".$mamna." tis�c nezam�stnan�ch</td>";
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
			echo "<th>n�zev planety</th>";
			echo "<th>po�et m�st na planet�</th>";
			echo "<th>lid� na planet� (v tis�c�ch)</th>";
			echo "<th>zb�v� m�st pro lidi (v tis�c�ch)</th>";
			echo "</tr><h6>";

			while($planety1 = MySQL_Fetch_Array($pla)):
				$lidi=Floor($planety1["lidi"]/1000);
				$zbylo=$planety1[mesta]*60000;
				$zbylo-=$lidi;
				echo "<tr>";
				echo "<td class=text_modry>".$planety1[nazev]."</td>";
				echo "<td>".$planety1[mesta]."</td>";
				echo "<td>".number_format($lidi,0,0," ")."</td>";
				echo "<td>".number_format($zbylo,0,0," ")."</td>";
				echo "</tr>";
			endwhile;
		else:
			echo "<center><font class=text_bili><b>Nikdo nezam�stnan� nenab�z�.</b></font></center>";		
		endif;

			echo "</table>";


endif;
//---------------------------------nove
//_____________________OBCHOD s PLANETAMI_______________________________________
if($co==5):

//maxcena----------------
 if ($cenaplanety>1000000000):echo"<H>P��li� velk� ��stka!!!</H>";
 else:
//----------------- 

if ($zaznam1[admin]==1)
{
$uprava = MySQL_Query("UPDATE `uzivatele` SET `plan_koupe` = '0'  WHERE   `plan_koupe` = '4'");
$uprava = MySQL_Query("UPDATE `uzivatele` SET `plan_prodej` = '0'  WHERE   `plan_prodej` = '4'");
}


 
 

//echo "<font class='text_cerveny' size='18'>Obchod s planetami uzav�en!!! V�chy vlo�en� planety byly nen�vratn� a bez n�hrady straceny!!! P��t� u� mo�n� bugovat nebudete!!!</font>";exit;


//----------------------------if ($zaznam1[admin]==1 or $zaznam1[jmeno]==TestMan):
////ceny vyrob
$poc=1;
$vysceny = MySQL_Query("SELECT vyr_vyrob FROM rasy order by rasa ASC");
while($cenyr = MySQL_Fetch_Array($vysceny)):
$ceny[$poc]=$cenyr[vyr_vyrob];

$poc++;if ($poc==11){$poc=97;}
endwhile;
//////////////////zruseni
if ($zrusit!=null){
$vyspz1 = MySQL_Query("SELECT id,den,prodejce,cislo,cena,typ,mesta,vyrobna,spokojenost,rasa FROM obchod_planety where cislo='$zrusit'");
$zrusit1= MySQL_Fetch_Array($vyspz1);

$vyspz3 = MySQL_Query("update planety set majitel='$zrusit1[prodejce]',cislomaj='$zaznam1[cislo]' where  cislo='$zrusit1[cislo]'"); 
$vyspz3a= MySQL_Query("DELETE FROM obchod_planety WHERE cislo='$zrusit'");
//$zaznam1[planety]=$zaznam1[planety]+1;
 //     $vyspp3= MySQL_Query("update uzivatele set planety='$zaznam1[planety]' where  jmeno='$zaznam1[jmeno]'");
$pocet_plan=$zaznam1[plan_prodej]-1;
    $vyspp3= MySQL_Query("update uzivatele set plan_prodej='$pocet_plan' where  jmeno='$zaznam1[jmeno]'"); 

}
////////////////////sleva
if($zlevnit!=null){
///echo $zlevnit;
$vyspzl1 = MySQL_Query("SELECT cena FROM obchod_planety where cislo='$zlevnit'");
$zlevnit1= MySQL_Fetch_Array($vyspzl1);
//echo "<br>".$zlevnit1[cena]."";
$zlevnit1[cena]=$zlevnit1[cena]-($zlevnit1[cena]/10.0);
//echo "<br>".$zlevnit1[cena]."";

if ($zlevnit1[cena]<=1){ $zlevnit1[cena]=1;}

$vysp3 = MySQL_Query("update obchod_planety set cena='$zlevnit1[cena]' where  cislo='$zlevnit'"); 
}

////____________________vlozeni planety do obchodu__________________________________________________
////////////////////////////////////////////////////////////////////////////////////////////////////

$castedp=Date("U");
$time_obch_plan_p=$zaznam1['time_obch_plan_p'];
$casb=(30-($castedp-$time_obch_plan_p));

if(($castedp-$time_obch_plan_p)<30){echo "<center><font class='text_cerveny'>Dal�� prodej je mo�n� a� za ".$casb."s</font></center>";}                   
if((($castedp-$time_obch_plan_p)>=30) or $zaznam1[admin]==1):

////////////////////////////////////////////////////////////////////////////////////////////////////
/////min pocet planet!!!!!
$min_pocet_planet=25;

if ($zaznam1[admin]==1){
$min_pocet_planet=0; 
};



if ($zaznam1[planety]>$min_pocet_planet):
//////////////////////////

if ($zaznam1[plan_prodej]<4){
$casp=Date("U");
$cas_p=$casp-(3600*24);
if ($zaznam1[poc_prodej]>=3 and $zaznam1[prodej_cas]<=$cas_p ){
$zaznam1[poc_prodej]=0;
$vyspp3= MySQL_Query("update uzivatele set poc_prodej='$zaznam1[poc_prodej]' where  jmeno='$zaznam1[jmeno]'"); 
}
if ($zaznam1[poc_prodej]<=2){
////////////////////////if ($zaznam1[prodej_cas]<=$cas_p ){

$cenaplanety=htmlspecialchars($cenaplanety);
$cenaplanety=strip_tags($cenaplanety);
 //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


 
 if (ctype_digit($cenaplanety)){
  $vyspocplanet = MySQL_Query("SELECT prodejce FROM obchod_planety where prodejce='$zaznam1[jmeno]'");
  $pocplanet1= MySQL_Num_Rows($vyspocplanet);

  if ($zaznam1[admin]==1){

$pocplanet1=1;
}
  if ($pocplanet1<3){
  
  if($cenaplanety>1):
    //echo $oplanety;
  if ($zaznam1[plan_prodej]==2){

if ($zaznam1[admin]==1){
$casp=0;

}

$vyspp2= MySQL_Query("update uzivatele set prodej_cas='$casp' where  jmeno='$zaznam1[jmeno]'"); 
}


    $vysp1bb = MySQL_Query("SELECT spokojenost,mesta,vyrobna,typ FROM planety where cislo='$oplanety'");
       $planety2= MySQL_Fetch_Array($vysp1bb);
     
      $den=Date("U");
      $planeta_obchodni="1_pplaneta_obchodni";
      $vysp2=MySQL_Query("INSERT INTO `obchod_planety` ( `id` , `den` , `prodejce` , `cislo` , `cena` , `typ` , `mesta` , `vyrobna` , `spokojenost` , `rasa` ) VALUES (null,'$den','$zaznam1[jmeno]','$oplanety','$cenaplanety','$planety2[typ]','$planety2[mesta]','$planety2[vyrobna]','$planety2[spokojenost]','$zaznam1[rasa]')");
      
      $vysp3 = MySQL_Query("update planety set majitel='$planeta_obchodni',cislomaj='1' where  cislo='$oplanety'"); 
      $pocet_plan=1+$zaznam1['plan_prodej'];

if ($zaznam1['admin']==1){
    $pocet_plan=1;
}

      $vyspp3= MySQL_Query('update uzivatele set plan_prodej="'.$pocet_plan.'" where  jmeno="'.$zaznam1['jmeno'].'" ');
      $zprodej=$zaznam1['poc_prodej']+1;
if ($zaznam1['admin']==1){
    $zaznam1['poc_prodej']=1;
}
      $vyspp3= MySQL_Query('update uzivatele set poc_prodej="'.$zprodej.'" where  jmeno="'.$zaznam1['jmeno'].'" ');
        MySQL_Query("update uzivatele set time_obch_plan_p='$castedp' where cislo=$logcislo");

endif;}
if ($pocplanet1==3){
    echo "<font class='text_cerveny'>Můžete mít v obchodš jen 3 planety</font>";
}
}}

if ($zaznam1['poc_prodej']==3 && $zaznam1['prodej_cas']>$cas_p ){
    $cc=$zaznam1['prodej_cas']+(3600*24);
    $kdy=Date("H:i:s j.m.Y",$cc);
    echo "<font class='text_cerveny'>Můžete prodat jen 3 planety za 24 hodin!<br>Další můžete v ".$kdy."</font>";
}

}


endif;  
if ($zaznam1['planety']<=$min_pocet_planet && $zaznam1['admin']!=1){
    echo"<font class='text_cerveny'>Musíte mít víc jak ".$min_pocet_planet." planet abyste je mohli vložit do obchodu!!!</font>";
}
endif;
//-------------------------------koupit
$castedp=Date("U");
$time_obch_plan_k=$zaznam1['time_obch_plan_k'];
$casa=(30-($castedp-$time_obch_plan_k));

if(($castedp-$time_obch_plan_k)<30){
    echo "<center><font class='text_cerveny'>Další koupě je možná až za ".$casa."s</font></center>";
}
if(($castedp-$time_obch_plan_k)>=30): 
if($kupplanetu!=null){

///
if ($zaznam1[plan_koupe]<4){
$casp=Date("U");
$cas_p=$casp-(3600*24);
if ($zaznam1[poc_koupe]>=3 and $zaznam1[koupe_cas]<=$cas_p ){
$zaznam1[poc_koupe]=0;
$vyspp3= MySQL_Query("update uzivatele set poc_koupe='$zaznam1[poc_koupe]' where  jmeno='$zaznam1[jmeno]'"); 
}
if ($zaznam1[poc_koupe]<=2){

if ($zaznam1[plan_koupe]==2){

$vyspp2= MySQL_Query("update uzivatele set koupe_cas='$casp' where  jmeno='$zaznam1[jmeno]'"); 
}

$vyspk1 = MySQL_Query("SELECT prodejce,cislo,cena,rasa FROM obchod_planety where cislo='$kupplanetu'");
$koupit1= MySQL_Fetch_Array($vyspk1);

  $prasa=$koupit1[rasa];
  $cena=$koupit1[cena]*($ceny[$trasa]/$ceny[$prasa]);

  if($cena>$zaznam1[penize]):
    echo "<font class='text_cerveny'>Tolik naquadahu nem�te.</font>";
  else:
     $penizek=$zaznam1[penize]-$cena;
    
    $vyspk2 = MySQL_Query("SELECT nazev,cislo,majitel FROM planety where cislo='$koupit1[cislo]'");
    $koupit2= MySQL_Fetch_Array($vyspk2);
    $vyspk2b = MySQL_Query("SELECT penize,posta,planety FROM uzivatele where jmeno='$koupit1[prodejce]'");
    $koupit2b= MySQL_Fetch_Array($vyspk2b);
    
    $koupit2b_penize=$koupit2b[penize]+$koupit1[cena];

    $vyspk3 = MySQL_Query("update planety set majitel='$zaznam1[jmeno]',cislomaj='$zaznam1[cislo]' where  cislo='$koupit1[cislo]'"); 
        $zaznam1[planety]++;

        $koupit2b[planety]= $koupit2b[planety]-1;
    $vyspk4 = MySQL_Query("update uzivatele set penize='$penizek',planety='$zaznam1[planety]' where  jmeno='$zaznam1[jmeno]'"); 
   $vyspk5 = MySQL_Query("update uzivatele set penize='$koupit2b_penize',planety='$koupit2b[planety]' where  jmeno='$koupit1[prodejce]'"); 
   $vyspk6= MySQL_Query("DELETE FROM obchod_planety WHERE cislo='$kupplanetu'");

		$posta=$koupit2b[posta2]+1;
		$den=Date("U");
                $nazev="Obchod s planetami";
		$text="Koupil Vámi nabízenou planetu za ".$koupit1[cena]."kg naquadahu, v jeho měně to bylo ".$cena.".";
		MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,text,stav,nepr,typ,smaz) VALUES ($den,'$zaznam1[jmeno]','$koupit1[prodejce]','$nazev','$trasa','$text','1','1','2','0')");

		MySQL_Query("update uzivatele set posta2='$posta' where jmeno = '$koupit1[prodejce]'");

    $zaznam1[planety]=$zaznam1[planety]+1;
    
$pocet_plan=1+$zaznam1[plan_koupe];
      $vyspp3= MySQL_Query("update uzivatele set plan_koupe='$pocet_plan' where  jmeno='$zaznam1[jmeno]'"); 
      $zaznam1[poc_koupe]++;
      $vyspp3= MySQL_Query("update uzivatele set poc_koupe='$zaznam1[poc_koupe]' where  jmeno='$zaznam1[jmeno]'"); 
   $castedp=Date("U");
   MySQL_Query("update uzivatele set time_obch_plan_k='$castedp' where cislo=$logcislo");

endif;

}

if ($zaznam1['poc_koupe']==3 and $zaznam1['koupe_cas']>$cas_p ){ 
    $cc1=$zaznam1['koupe_cas']+(3600*24);
    $kdy=Date("H:i:s j.m.Y",$cc1);
    echo "<font class='text_cerveny'>Můžete koupit jen 3 planety za 24 hodin!<br>Další můžete v ".$kdy."</font>";
}

}}
endif;

///////nacteni planet do formulare na prodej	
$vysp = MySQL_Query('SELECT nazev,cislo,majitel,status FROM planety where majitel="'.$zaznam1['jmeno'].'" ');

echo'<form name="form" method="post" action="hlavni.php?page=obchod&amp;co=5">'.
    '<h6>Prodat planetu'.
    '<select name="oplanety">';
while($planety = MySQL_Fetch_Array($vysp)):
    if ($planety['status']<1){
        echo  '<option value="'.$planety['cislo'].'">'.$planety['nazev'].'</option>';
    }
endwhile;

echo'</select>';
$caspl=Date("U");
echo' za cenu <input type="text" name="cenaplanety"> naquadahu ';
echo'<input type="submit" name="Submit" value="Prodat">'.
    '<input type="hidden" name="planety_interval" value="'.$caspl.'">'.
    '</form><br>';
///////konec nacteni planet do formulare na prodej
/////planety v obchode 
$vysp1 = MySQL_Query("SELECT id,den,prodejce,cislo,cena,typ,mesta,vyrobna,spokojenost,rasa FROM obchod_planety order by den desc");
echo"  <TABLE bordercolorlight=#FFFFFF bordercolordark=#FFFFFF bordercolor=#FFFFFF border=1 align=center width=100%>
    <tr> 
      <th>Čas a datum nabídnutí</th>
      <th>Typ planety</th>
      <th>Cena</th>
      <th>Města</th>
      <th>Výrobny</th>
      <th>Spokojenost</th>
      <th>&nbsp;</th>
    </tr>";


while($planety_obchod = MySQL_Fetch_Array($vysp1)):

    $datum = Date("j.m.Y",$planety_obchod['den']);

    if($planety_obchod['vyrobna']==null){
        $planety_obchod['vyrobna']="0";
    }

    $prasa=$planety_obchod['rasa'];
    @$cena=$planety_obchod['cena']*($ceny[$trasa]/$ceny[$prasa]);
    @$cena=floor($cena);

    if($planety_obchod['prodejce']==$zaznam1['jmeno']){
        echo"<tr> 
              <th>".$datum."</th>
              <th>".$planety_obchod['typ']."</th>
              <th>".number_format($cena,2,"."," ")."</th>
              <th>".$planety_obchod['mesta']."</th>
              <th>".$planety_obchod['vyrobna']."</th>
              <th>".$planety_obchod['spokojenost']."%</th>
              <th>
                <form name='form' method='post' action='hlavni.php?page=obchod&amp;co=5'>
                    <input type='submit' value='zrušit'>
                    <input type='hidden' name='zrusit' value='".$planety_obchod['cislo']."'>
                </form>
                <form name='form' method='post' action='hlavni.php?page=obchod&amp;co=5'>
                    <input type='submit' value='zlevnit o 10%'>
                    <input type='hidden' name='zlevnit' value='".$planety_obchod['cislo']."'>
                </form>
              </th></tr>";
    }

    if($trasa!=$planety_obchod['rasa']){
        echo"<tr> 
             <th>".$datum."</th>
             <th>".$planety_obchod['typ']."</th>
             <th>".number_format($cena,2,"."," ")."</th>
             <th>".$planety_obchod['mesta']."</th>
             <th>".$planety_obchod['vyrobna']."</th>
             <th>".$planety_obchod['spokojenost']."%</th>
             <th>
               <form name='form' method='post' action='hlavni.php?page=obchod&amp;co=5'>
                   <input type='submit' value='Koupit'>
                   <input type='hidden' name='kupplanetu' value='".$planety_obchod['cislo']."'>
               </form>
             </th></tr>";
    }

endwhile;

echo"</table>";

$vpocplanet = MySQL_Query("SELECT majitel FROM planety where majitel='$zaznam1[jmeno]'");
$pocplanet1= MySQL_Num_Rows($vpocplanet);
$pocplanet1a=$pocplanet1;
$vyppp3= MySQL_Query("update uzivatele set planety='$pocplanet1a' where  cislo=$logcislo");
endif;endif;

MySQL_Close($spojeni);
