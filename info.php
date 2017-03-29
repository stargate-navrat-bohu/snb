<?php

require "session.php";

?>

<style type="text/css">

td, .obrstyl, mk{text-align:center};

 

</style>

 

<?php

 

mysql_query("SET NAMES cp1250");

require "data_1.php";

 

 

//**********************************************oprava dobytí - jednou denně - begin*************************

 

$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo = $logcislo");

$zaznam1 = MySQL_Fetch_Array($vys1);

 

$vaseip = $REMOTE_ADDR;

//////**************************************

//$_SERVER['REMOTE_ADDR'] = '';

 

 

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$_SERVER['HTTP_X_FORWARDED_FOR'] =

$_SERVER['HTTP_X_FORWARDED_FOR'];}else{$_SERVER['HTTP_X_FORWARDED_FOR'] = '';}

 

$theremote = $_SERVER{'REMOTE_ADDR'};

$theproxy = $_SERVER{'HTTP_X_FORWARDED_FOR'};

if ($theproxy == ''){

$RealIpAddress = $theremote;

} else {

$RealIpAddress = $theproxy;

}

if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

$ComputerName = GetHostByADDR($_SERVER['HTTP_X_FORWARDED_FOR']);

//$IP = GetHostByName($_SERVER['HTTP_X_FORWARDED_FOR']);

}else{

$ComputerName = GetHostByADDR($_SERVER['REMOTE_ADDR']);

//$IP = GetHostByName($_SERVER['REMOTE_ADDR']);

}

//$ProxyName = (gethostbyaddr($_SERVER['REMOTE_ADDR']));

$ProxyIP = (gethostbyname($_SERVER['REMOTE_ADDR']));

 

if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

 

$proxy1 = MySQL_Query("SELECT `proxy` FROM `proxy` where `jmeno`='$logjmeno'");

@$proxy2 = MySQL_Fetch_Array($proxy1);

//echo $proxy2[proxy];

if($proxy2[proxy]!=$ProxyIP or $proxy2[proxy]== NULL ){

MySQL_Query("INSERT INTO proxy (jmeno,ip,proxy) VALUES ('$logjmeno','$RealIpAddress','$ProxyIP')");

}

}

 

 

 

 

/////*************************************************

 

 

if($zaznam1[ip]!=$vaseip):

MySQL_Query("update uzivatele set ip='$vaseip' where cislo = $logcislo");

endif;

 

 

 

$ser1 = MySQL_Query("SELECT cislo,dendobyt,dendobyl,dendobyl_part,dendobyl_zhn,dendobyl_uni,dendobyl_orb,dendobyl_pol,dendobyl_lid,zmezi,dendobyl_age,admin_zprava FROM servis where cislo = 1");

$ser = MySQL_Fetch_Array($ser1);	

$ddd=Date("j");

if($ser[dendobyt]!=$ddd):

MySQL_Query("update servis set dendobyt=$ddd where cislo=1");

MySQL_Query("update uzivatele set dendobyt=$ddd,dobyt=0 where dendobyt!=$ddd");

endif;

if($ser[dendobyl]!=$ddd):

MySQL_Query("update servis set dendobyl=$ddd where cislo=1");

MySQL_Query("update uzivatele set dobyl=0 where dobyl!=0");

endif;

if($ser[dendobyl_part]!=$ddd):

MySQL_Query("update servis set dendobyl_part=$ddd where cislo=1");

MySQL_Query("update uzivatele set dobyl_part=0 where dobyl_part!=0");

endif;

if($ser[dendobyl_zhn]!=$ddd):

MySQL_Query("update servis set dendobyl_zhn=$ddd where cislo=1");

MySQL_Query("update uzivatele set dobyl_zhn=0 where dobyl_zhn!=0");

endif;

if($ser[dendobyl_uni]!=$ddd):

MySQL_Query("update servis set dendobyl_uni=$ddd where cislo=1");

MySQL_Query("update uzivatele set dobyl_uni=0 where dobyl_uni!=0");

endif;

if($ser[dendobyl_orb]!=$ddd):

MySQL_Query("update servis set dendobyl_orb=$ddd where cislo=1");

MySQL_Query("update uzivatele set dobyl_orb=0 where dobyl_orb!=0");

endif;

if($ser[dendobyl_pol]!=$ddd):

MySQL_Query("update servis set dendobyl_pol=$ddd where cislo=1");

MySQL_Query("update uzivatele set dobyl_pol=0 where dobyl_pol!=0");

endif;

if($ser[dendobyl_lid]!=$ddd):

MySQL_Query("update servis set dendobyl_lid=$ddd where cislo=1");

MySQL_Query("update uzivatele set dobyl_lid=0 where dobyl_lid!=0");

endif;

if($ser[dendobyl_age]!=$ddd):

MySQL_Query("update servis set dendobyl_age=$ddd where cislo=1");

MySQL_Query("update uzivatele set dobyl_age=0 where dobyl_age!=0");

endif;

 

//***********************************************oprava dobytí - end*****************************************

 

$info=1;

require("kontrola.php");

$den=Date("U");

MySQL_Query("update uzivatele set posl=$den where cislo=$logcislo");

 

$sekvek=Date("U")-$zaznam1[vek];

//echo $zaznam1[vek];

//echo "<br />".Date("U");

if($zaznam1[reg]!=1 and $sekvek>86400):

MySQL_Query("DELETE FROM uzivatele WHERE cislo=$logcislo");

MySQL_Query("DELETE FROM planety WHERE cislomaj = $logcislo");

MySQL_Query("DELETE FROM mul WHERE jmeno='$logjmeno'");

MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");	

echo "<font class='text_cerveny'>Tento login nebyl včas doregistrován, proto byl smazán.</font>";

endif;

 

 

if($zaznam1["utoceno"]!=0):

switch($zaznam1["utoceno"]){

case 1: $slovoutok="útok";break;

case 2:

case 3:

case 4: $slovoutok="útoky";break;

default: $slovoutok="útoků";	

}

 

switch($zaznam1["utoceno"]){

case 1: $slovoutokk="Byl na vás veden";break;

case 2:

case 3:

case 4: $slovoutokk="Byly na vás vedeny";break;

default: $slovoutokk="Bylo na vás vedeno";	

}

echo "<br /><font class='text_cerveny'><a href=hlavni.php?page=sutok>$slovoutokk ".$zaznam1["utoceno"]." $slovoutok</a></font><br /><br />";

endif;

 

 

 

if($zaznam1["posta"]!=0):

switch($zaznam1["posta"]){

case 1: $slovoposta="nepřečtenou zprávu";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtená zprávy";break;

default: $slovoposta="nepřečtených zpráv";	

}

echo "<font class='text_cerveny'><a href=hlavni.php?page=posta&vyber=2>Máte ".$zaznam1["posta"]." $slovoposta</a></font><br />";

endif;

 

 

if($zaznam1["posta4"]!=0):

switch($zaznam1["posta4"]){

case 1: $slovoposta="nepřečtenou rasovou zprávu";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtená rasová zprávy";break;

default: $slovoposta="nepřečtených rasových zpráv";	

}

echo "<font class='text_cerveny'><a href=hlavni.php?page=posta&vyber=4>Máte ".$zaznam1["posta4"]." $slovoposta</a></font><br />";

endif;

 

 

if($zaznam1["posta5"]!=0):

switch($zaznam1["posta5"]){

case 1: $slovoposta="nepřečtenou obchodní zprávu";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtená obchodní zprávy";break;

default: $slovoposta="nepřečtených obchodních zpráv";	

}

echo "<font class='text_cerveny'><a href=hlavni.php?page=posta&vyber=5>Máte ".$zaznam1["posta5"]." $slovoposta</a></font><br />";

endif;

 

if($zaznam1["posta6"]!=0):

switch($zaznam1["posta6"]){

case 1: $slovoposta="nepřečtenou bankovní zprávu";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtená bankovní zprávy";break;

default: $slovoposta="nepřečtených bankovních zpráv";	

}

echo "<font class='text_cerveny'><a href=hlavni.php?page=posta&vyber=6>Máte ".$zaznam1["posta6"]." $slovoposta</a></font><br />";

endif;

 

if($zaznam1["posta7"]!=0):

switch($zaznam1["posta7"]){

case 1: $slovoposta="nepřečtenou adminskou zprávu";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtená adminská zprávy";break;

default: $slovoposta="nepřečtených adminských zpráv";	

}

echo "<font class='text_cerveny'><a href=hlavni.php?page=posta&vyber=7>Máte ".$zaznam1["posta7"]." $slovoposta</a></font><br />";

endif;

 

if($zaznam1["posta8"]!=0):

switch($zaznam1["posta8"]){

case 1: $slovoposta="nepřečtenou vládní zprávu";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtený vládní zprávy";break;

default: $slovoposta="nepřečtených vládních zpráv";	

}

echo "<font class='text_cerveny'><a href=hlavni.php?page=posta&vyber=8>Máte ".$zaznam1["posta8"]." $slovoposta</a></font><br />";

endif;

 

if($zaznam1["posta9"]!=0):

switch($zaznam1["posta9"]){

case 1: $slovoposta="nepřečtenou interní adminskou zprávu";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtená interní adminská zprávy";break;

default: $slovoposta="nepřečtených interních adminských zpráv";	

}

echo "<font class='text_cerveny'><a href=hlavni.php?page=posta&vyber=9>Máte ".$zaznam1["posta9"]." $slovoposta</a></font><br />";

endif;

 

 

 

if($zaznam1["adm"]!=0):

switch($zaznam1["adm"]){

case 1: $slovoposta="nová zpráva";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtené zprávy";break;

default: $slovoposta="nepřečtených zpráv";	

}

echo "<font class='text_cerveny'><a href='hlavni.php?page=forum&kde=adm'>Na oznámení adminů je ".$zaznam1["adm"]." $slovoposta</a></font><br />";

endif;

 

if($zaznam1["ov"]!=0):

switch($zaznam1["ov"]){

case 1: $slovoposta="nová zpráva";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtené zprávy";break;

default: $slovoposta="nepřečtených zpráv";	

}

echo "<font class='text_cerveny'><a href='hlavni.php?page=forum&kde=ov'>Na oznámení vedeni je ".$zaznam1["ov"]." $slovoposta</a></font><br />";

endif;

 

 

 

 

if($zaznam1["online"]!=0):

switch($zaznam1["online"]){

case 1: $slovoposta="nepřečtenou zprávu";break;

case 2:

case 3:

case 4: $slovoposta="nepřečtené zprávy";break;

default: $slovoposta="nepřečtených zpráv";	

}

echo "<font class='text_cerveny'><a href=hlavni.php?page=posta>Máte ".$zaznam1["online"]." $slovoposta</a></font><br />";

endif;

 

 

if($zaznam1["ref"]==0){echo "<font class='text_cerveny'><a href='hlavni.php?page=ref'>Ve složce referendum je nové celovesmírné referendum, ve kterém jste ještě nehlasovali.</a></font><br />";};

 

if($zaznam1["refn"]==0 and $zaznam1["rasa"]!=97 and $zaznam1["rasa"]!=98){echo "<font class='text_cerveny'><a href='hlavni.php?page=ref'>Ve složce referendum je nové národní referendum, ve kterém jste ještě nehlasovali.</a></font><br />";};

if($zaznam1["refa"]==0 and ($zaznam1["admin"]==1 or $zaznam1["admin"]==2 or $zaznam1["admin"]==3 or $zaznam1["admin"]==4) ){echo "<font class='text_cerveny'><a href='hlavni.php?page=ref'>Ve složce referendum je nové adminské referendum, ve kterém jste ještě nehlasovali.</a></font><br />";};

 

if($zaznam1["pri"]==1){echo "<font class='text_cerveny'><a href='hlavni.php?page=forum&kde=pri'>Na příběhovém f�rum byl vložen příběh.</a></font><br />";};

if($zaznam1["vud"]==1){echo "<font class='text_cerveny'><a href='hlavni.php?page=forum&kde=vud'>Na oznámení vedení je nová zpráva.</a></font><br />";};

$as=$rasa1."r";

if($zaznam1[rasa]==11 or $zaznam1[rasa]==0){$as="1r";};

$tvujnarod=$narod[$as];

$tvujzriz=$zriz[$as];

 

//----------

$heslob="5ae9760064bbe620deb0afdae46633b3";

if($zaznam1[heslo2]==$heslob)	:

$heslicko=$zaznam1[heslo2];

else:

$heslicko=0;

endif;

if(isset($heslo1)):

$heslo1=md5($heslo1);

$heslo2=md5($heslo2);

$hesloa=$zaznam1[heslo];

if($heslo1==$hesloa and $heslo2==$heslob):

MySQL_Query("update uzivatele set heslo2='$heslob' where cislo=$logcislo");

$heslicko="$heslo2";

else:

$heslicko==0;

endif;	

endif;

 

$rasa1 = $zaznam1["rasa"] ;

 

$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");

$zaznam2 = MySQL_Fetch_Array($vys2);

$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = $logcislo");

if(empty($xm) or $xm<0){$xm=0;};

$vys4 = MySQL_Query("SELECT * FROM utok where (utocnik='$logjmeno' or obrance='$logjmeno') ORDER BY den DESC LIMIT $xm,5");

$vys5 = MySQL_Query("SELECT rasa,fond,denz,dena,denv,jvudce,jzastupce,jasistent,jobcan,rasova_zprava FROM vudce where rasa = $rasa1");

$zaznam5 = MySQL_Fetch_Array($vys5);

$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");

$politika = MySQL_Fetch_Array($politika1);

$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=4 and mrtev!=1)");

@$stav = MySQL_Fetch_Array($stavitel2);

$typhs2 = MySQL_Query("SELECT * FROM typh where typ=4");

$typhs = MySQL_Fetch_Array($typhs2);

$bstav=1+($stav[level]*$typhs[ucinek]);

if($stav[cislomaj]!=$logcislo){$bstav=1;};

//echo "<font class =info>".$bstav;

 

$ekonom2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=4 and mrtev!=1)");

@$eko = MySQL_Fetch_Array($ekonom2);

 

$obch2 = MySQL_Query("SELECT den,navrhovatel,jed1,jed2,jed7,jed4,jed3,typ FROM obchod where (navrhovatel='$logjmeno' and typ=0)");

while($obch = MySQL_Fetch_Array($obch2)):

$obchod+=$obch[jed1]*$zaznam2[jed1_lidi];

$obchod+=$obch[jed2]*$zaznam2[jed2_lidi];

$obchod+=$obch[jed7]*$zaznam2[jed7_lidi];

$obchod+=$obch[jed3]*$zaznam2[jed3_lidi];	

$obchod+=$obch[jed4]*$zaznam2[jed4_lidi];	

endwhile;	

 

$cislos=$stav[cislo];

$stavitel23 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=5 and mrtev!=1)");

@$stav3 = MySQL_Fetch_Array($stavitel23);

$typhs23 = MySQL_Query("SELECT * FROM typh where typ=5");

$typhs3 = MySQL_Fetch_Array($typhs23);

$bstav3=1+($stav3[level]*$typhs3[ucinek]);

if($stav3[cislomaj]!=$logcislo){$bstav3=1;};

//echo "<font class =info>".$bstav3;

$cislos3=$stav3[cislo];

 

 

$ekonom23 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=4 and mrtev!=1)");

@$eko3 = MySQL_Fetch_Array($ekonom23);

 

$narod1 = MySQL_Query("SELECT * FROM narody WHERE cislo='".$zaznam1["narod"]."'");

$narod = MySQL_Fetch_Array($narod1);

$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni WHERE cislo='".$zaznam1["zrizeni"]."'");

$zriz = MySQL_Fetch_Array($zrizeni1);

 

if($rasa1!=11 and $rasa1!=0 and $rasa1!=12 and $rasa1!=98):

$vys8 = MySQL_Query("SELECT * FROM vztahy where rasa = $rasa1");

$zaznam8 = MySQL_Fetch_Array($vys8);

endif;

 

$kplanet = MySQL_Query("SELECT nazev,majitel FROM planety where cislomaj = $logcislo");

$kolikplan = mysql_num_rows($kplanet);

$vyz = MySQL_Query("SELECT * FROM vyzkum where rasa = $rasa1");

$vyzkum = MySQL_Fetch_Array($vyz);	

$her = MySQL_Query("SELECT * FROM herna where jmeno = 'jackpot'");

$herna = @MySQL_Fetch_Array($her);

$cpdb2 = MySQL_Query("SELECT * FROM cp where rasa = $rasa1");

$cpdb = MySQL_Fetch_Array($cpdb2);

if(Date("j")!=$cpdb[den]):

$dencp=Date("j");

MySQL_Query("update cp set dobyto=0,den=$dencp where rasa=$rasa1");	

endif;	

 

if($herna[den]!=Date("j")):

$jackpot=$herna[kolik];

//**********************************herna**************************************************

$den=Date("j");

MySQL_Query("update herna set den = $den where jmeno = 'jackpot'");

$her = MySQL_Query("SELECT * FROM herna where jmeno != 'jackpot'");

$tah1=rand(1,30);

$tah2=rand(1,30);

$tah3=rand(1,30);

$tah4=rand(1,30);

$tah5=rand(1,30);

$tah6=rand(1,30);

while($herna = @MySQL_Fetch_Array($her)):

$nas=0;

if($herna[c1]==$tah1){$nas+=2;$t1=1;$c1=1;};

if($herna[c2]==$tah2){$nas+=2;$t2=1;$c2=1;};

if($herna[c3]==$tah3){$nas+=2;$t3=1;$c3=1;};

if($herna[c4]==$tah4){$nas+=2;$t4=1;$c4=1;};

if($herna[c5]==$tah5){$nas+=2;$t5=1;$c5=1;};

if($herna[c6]==$tah6){$nas+=2;$t6=1;$c6=1;};

$i=1;

while($i<7):

$pouzite="t".$i;

if($$pouzite!=1):

$co="tah".$i;

if(($$co==$herna[c1]) and ($c1!=1)):

$c1=1;

$nas+=0.5;

elseif(($$co==$herna[c2]) and ($c2!=1)):

$c2=1;

$nas+=0.5;

elseif(($$co==$herna[c3]) and ($c3!=1)):

$c3=1;

$nas+=0.5;

elseif(($$co==$herna[c4]) and ($c4!=1)):

$c4=1;

$nas+=0.5;

elseif(($$co==$herna[c5]) and ($c5!=1)):

$c5=1;

$nas+=0.5;

elseif(($$co==$herna[c6]) and ($c6!=1)):

$c6=1;

$nas+=0.5;

else:

$nas=$nas;

endif;

endif;

$i++;

endwhile;

//apdejty

$pridat=$herna[kolik]*$nas;

if($nas==12){$pridat=$jackpot;};

$jackpot-=$pridat;

$den=Date("U");

$odesilatel="Správce loterie";

$adresat=$herna[jmeno];

$text="V loterii jste vyhrýl ".$pridat." kg naquadahu<br />Vsadil jste na čísla: ".$herna[c1].", ".$herna[c2].", ".$herna[c3].", ".$herna[c4].", ".$herna[c5].", ".$herna[c6].". Vylosována byla: ".$tah1.", ".$tah2.", ".$tah3.", ".$tah4.", ".$tah5.", ".$tah6;

MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text) VALUES ($den,'$odesilatel','$adresat',' ','$text')");

 

$komuto=$herna[jmeno];

$vys9a = MySQL_Query("SELECT jmeno,penize,posta FROM uzivatele where jmeno = '$komuto'");

$zazm9 = MySQL_Fetch_Array($vys9a);

 

$posta=$zazm9[posta]+1;

$n=$zazm9["penize"]+$pridat;

MySQL_Query("update uzivatele set penize = $n where jmeno = '$komuto'");

MySQL_Query("update uzivatele set posta = $posta where jmeno = '$komuto'");

 

if($jackpot<0){$jackpot=0;};

endwhile;

MySQL_Query("update herna set kolik = $jackpot where jmeno = 'jackpot'");

MySQL_Query("DELETE FROM herna WHERE jmeno != 'jackpot'");

endif;

//*******************************herna-end******************************************

$sml = MySQL_Query("SELECT * FROM smlouvy where (((adresat = '$logjmeno') or (navrhovatel = '$logjmeno')) and (typ=4))");

@$h = mysql_num_rows($sml);

if($h>0):

$spen=0;

while($smlo = MySQL_Fetch_Array($sml)):

if($smlo[navrhovatel]==$logjmeno):

$on=$smlo[adresat];

$vy1 = MySQL_Query("SELECT planety FROM uzivatele where jmeno = '$on'");

$zaz1 = MySQL_Fetch_Array($vy1);

$spen+=($zaznam1[planety]+$zaz1[planety])*$zaznam2[vyr_vyrob]*100;

else:

$on=$smlo[navrhovatel];

$vy1 = MySQL_Query("SELECT planety FROM uzivatele where jmeno = '$on'");

$zaz1 = MySQL_Fetch_Array($vy1);

$spen+=($zaznam1[planety]+$zaz1[planety])*$zaznam2[vyr_vyrob]*100;

endif;

endwhile;

endif;

 

MySQL_Query("update uzivatele set planety = $kolikplan where cislo=$logcislo");

 

switch ($rasa1){

case 1: $pis="a";

break;

case 2: $pis="b";

break;

case 3: $pis="c";

break;

case 4: $pis="d";

break;

case 5: $pis="e";

break;

case 6: $pis="f";

break;	

case 7: $pis="g";

break;

case 8: $pis="h";

break;

case 9: $pis="i";

break;	

case 10: $pis="j";

break;

}

 

if($rasa1!=99 and $rasa1!=98 and $rasa1!=0 and $rasa1!=97):

$vys9 = MySQL_Query("SELECT rasa,$pis FROM vztahy");

$qq=1;

while($zaznam9 = MySQL_Fetch_Array($vys9)):

$d[$qq]=$zaznam9[$pis];//echo "<font class='tabulka'>".$d[$qq]."</font>";

$qq++;

endwhile;

$vys91 = MySQL_Query("SELECT rasa,status FROM rasy order by rasa");

while($zaznam91 = MySQL_Fetch_Array($vys91)):

$strs[$zaznam91[rasa]]=$zaznam91[status];

endwhile;	

endif;

$tyden = Date("d");

if($zaznam1[dendobyt]<>$tyden){

MySQL_Query("update uzivatele set dendobyt = $tyden,dobyt = 0 where cislo=$logcislo");

};

 

switch ($zaznam1["status"]) {

case 0:

$s = $zaznam5[jobcan]." (ob�an)";

$obyv = 0.5;

$peniz = 2*$politika[dent]/100;

break;

case 1:

$s = $zaznam5[jvudce]." (v�dce)";

$obyv = 0.5;

$peniz = 2*$politika[dent]/100;

if($zaznam5[denv]<>$tyden){

MySQL_Query("update vudce set darv = 0 where rasa = $rasa1");

MySQL_Query("update vudce set denv = $tyden where rasa = $rasa1");	

};

break;

case 2:

$s = $zaznam5[jzastupce]." (z�stupce)";

$obyv = 0.5;

$peniz = 2*$politika[dent]/100;

if($zaznam5[denz]<>$tyden){

MySQL_Query("update vudce set darz = 0 where rasa = $rasa1");

MySQL_Query("update vudce set denz = $tyden where rasa = $rasa1");	

};

break;

case 3:

$s = $zaznam5[jasistent]." (asistent)";

$obyv = 0.5;

$peniz = 2*$politika[dent]/100;

if($zaznam5[dena]<>$tyden){

MySQL_Query("update vudce set dara = 0 where rasa = $rasa1");

MySQL_Query("update vudce set dena = $tyden where rasa = $rasa1");

};

break;

case 4:

$s = "vyhnanec";

$obyv = 0.25;

$peniz = 1*$politika[dent]/100;

break;

case 5:

 

 

$vys9b = MySQL_Query("SELECT rasa,min1 FROM vudce where rasa = $rasa1");

$zaznam9b = MySQL_Fetch_Array($vys9b);

 

if($zaznam9b[min1]==$logjmeno){$s = "premiér";}

else{$s = "ministr";}

$obyv = 0.5;

$peniz = 2*$politika[dent]/100;

break;

}

 

 

switch ($zaznam1["gold"]) {

case 0:

break;

 

case 1:

$s2 ="(gold)";	

break;

}

 

if($zaznam1["novinar"]==1){

$s .= " (novinář)";

}

 

 

//echo "<font class=info>";

$h=Date("G");

$m=Date("i");

$se=Date("s");

$sek=Date("U");

$chci=$zaznam1[prepocet];

$sek-=$m*60;

$sek-=$se;

$a=$h-$chci;

if($a<0){$a+=24;};

$sek-=$a*3600;

$nebylsek=$sek-$zaznam1[den];

$vyvr1 = MySQL_Query("update rasy set heslo2='$vyvr2' where cislo=vyvr3");

 

//echo $sek." sek <br />";

//echo $zaznam1[den]." zaznam1[den]<br />";

//echo Date("U")." Date<br />";

//echo $nebylsek." nebyl sek<br />";

//echo Date("G:i:s j.m.Y",$zaznam1["den"])." zaznam1 �as<br />";

//echo Date("G:i:s j.m.Y",$sek)." sek �as<br />";

//echo (3600*24)." <br />";

//echo (Date("U")-$zaznam1[den])." Date-zaznam1[den]<br />";

//echo ($sek-$zaznam1[den])." sek-zaznam1[den]<br />";

 

$datum1=Floor($nebylsek/86400);

 

$nextsek=86400-(Date("U")-$zaznam1[den]);

$next=($nextsek/60)*10;

$next=Round($next)/10;

if($next<0){$next=0.0;};

$slovmin="minut";

if($datum1<0){$datum1=0;};

if($datum1>2){$datum1=2;};

if($ser[zmezi]!=""){$datum1=0;};

// $datum1=1;

//echo $datum1."<br />";

$penize1=$penize_zaklad=$zaznam1["penize"];

$penizex=0;	

 

//**********************begin cyklus planety**********************************

while ($zaznam3 = MySQL_Fetch_Array($vys3)):

$typpla=$zaznam3[typ];

$plan = MySQL_Query("SELECT * FROM typp where typ = '$typpla'");	

$pla = MySQL_Fetch_Array($plan);

$maxmest=$pla[mest];

$obyvat=$obyv;

if($pla[populace]==100){$obyvat*=2;};

$planetka=$zaznam3["cislo"];

$planetkam=$zaznam3["nazev"];	

 

if($zaznam3[mesta]>$pla[mest] and $zaznam3[status]!=2){echo "<font class='text_cerveny'>Osídlení planety $planetkam se nezdařilo, díky nepokojům na planetě se vám ji nepodařilo obsadit.</font><br />";MySQL_Query("DELETE FROM planety where cislo = $planetka");};

 

$lidix=$zaznam3["lidi"];

$lidix=$lidix+$zaznam3["lidi"]*$obyvat*$datum1;

$lidiz=$lidiy=$zaznam3["mesta"]*$zaznam2["mes_lidi"];

if(($datum1==0) and ($lidiy>=$zaznam3["lidi"]))$lidiy=$zaznam3["lidi"];	

$katar=rand(1,20);

if(($katar==20)and($datum1>0)and($zaznam3[brana]==1)and($zaznam3[status]!=2)and($zaznam3[status]!=3)):

echo "<font class='text_cerveny'>Na planetu ".$planetkam." byl hvězdnou bránou zanesen neznámý virus, zemřelo 10% populace a zbortilo se 5% výroben.</font><br />";

$bum=$zaznam3["vyrobna"]*0.95;

MySQL_Query("update planety set vyrobna = $bum where cislo = $planetka");

endif;

 

 

 

if(($katar==20)and($datum1>0)and($zaznam1[bankabudova]==1)):

echo "<font class='text_cerveny'>Ve vaší bance došlo ke zpronevěře. Boužel jste tím ztratil 5% uloženého naquadahu.</font><br />";

$bumm=$zaznam1["banka"]*0.95;

MySQL_Query("update uzivatele set banka = $bumm where cislo = $logcislo");

endif;

 

 

if($lidix<$lidiy):

if(($katar==20)and($datum1>0)and($zaznam3[brana]==1)):

$lidix=$lidix*0.9;

endif;

MySQL_Query("update planety set lidi = $lidix where cislo = $planetka");

$populace=$populace+$lidix;

else:

if(($katar==20)and($datum1>0)and($zaznam3[brana]==1)):

$lidiy=	$lidiy*0.9;

endif;

MySQL_Query("update planety set lidi = $lidiy where cislo = $planetka");

if($zaznam3["mesta"]!=$maxmest && $lidix>=$lidiz and $zaznam3[status]!=2){echo "<font class='text_cerveny'>".$planetkam." má nedostatek měst&nbsp;&nbsp;//</font>&nbsp;&nbsp;";};

$populace=$populace+$lidiy;

endif;

 

if($zaznam3[presun]>0 and $datum1>0)

{MySQL_Query("update planety set presun = 0 where cislo = $planetka");};

 

if(($zaznam3["vyrobna"]*$zaznam2["vyr_lidi"]+$zaznam3["sdi"]*$zaznam2["sdi_lidi"]+$zaznam3["laborator"]*$zaznam2["lab_lidi"])>$zaznam3["lidi"]):

$zbylobud=floor($zaznam3["lidi"]/$zaznam2["vyr_lidi"]);

$zbylolidi=$zaznam3["lidi"]-($zbylobud*$zaznam2["vyr_lidi"]);

$spadlo=$zaznam3["vyrobna"]-$zbylobud;

 

if($zbylolidi>0):

$zbylosdi=floor($zbylolidi/$zaznam2["sdi_lidi"]);

$zbylolidi=$zbylolidi-($zbylosdi*$zaznam2["sdi_lidi"]);

$spadlosdi=$zaznam3["sdi"]-$zbylosdi;

if($zbylolidi>0):

$zbylolab=floor($zbylolidi/$zaznam2["lab_lidi"]);

$spadlolab=$zaznam3["laborator"]-$zbylolab;

else:

$spadlolab=$zaznam3["lab"];

$zbylolab=0;

endif;	

else:	

$spadlosdi=$zaznam3["sdi"];

$zbylosdi=0;

$spadlolab=$zaznam3["lab"];

$zbylolab=0;

endif;

 

echo "<font class='text_cerveny'>Na planetě ".$planetkam." kvůli nedostatku personálu spadlo ".$spadlo." ".$zaznam2["vyr_nazev"].", ".$spadlosdi." ".$zaznam2["sdi_nazev"]." a ".$spadlolab." krát laboratoř</font><br />";

MySQL_Query("update planety set vyrobna = $zbylobud,sdi = $zbylosdi,laborator = $zbylolab where cislo = $planetka");	

endif;

 

if(($zaznam3["lidi"]/100)==0):

$spok=0;

else:

if($zaznam3[status]!=2):

$spok=$zaznam3["vyrobna"]*$zaznam2["vyr_lidi"];

$spok+=$zaznam3["sdi"]*$zaznam2["sdi_lidi"];

$spok+=$zaznam3["laborator"]*$zaznam2["lab_lidi"];

$spok/=($zaznam3["lidi"]/100);

$spok+=$pla[spokojenost];

$spok*=$politika[spokojenost]/100;

$spok*=$narod[spokojenost]/100;

$spok*=$zriz[spokojenost]/100;

else:

switch($zaznam2[poradi]){

case 1: $spok=105;break;

case 2: $spok=100;break;

case 3: $spok=95;break;

case 4: $spok=95;break;

case 5: $spok=95;break;

case 6: $spok=90;break;

case 7: $spok=85;break;

case 8: $spok=110;break;

case 9: $spok=115;break;

case 10: $spok=120;break;

}

endif;

endif;

$spok=Round($spok);	

$spok+=$zaznam3[par]*$zaznam2[park_proc];

 

if($spok>100 and $zaznam3[status]!=2){$spok=100;};

if($zaznam3["brana"]>0 and $zaznam3[status]!=2){$spok+=20;};

$prupro+=$spok;

if($zaznam3[status]!=2):

$lab+=$zaznam3["laborator"];

else:

$labcp+=$zaznam3["laborator"];

endif;

MySQL_Query("update planety set spokojenost = $spok where cislo = $planetka");

 

$pkasarna=$pkasarna+$zaznam3["kasarna"];

//$vyroba=$vyrobacp=0;

$vyroba=0;

if($zaznam3[status]!=2):

$vyroba=$zaznam3["vyrobna"]*$zaznam2["vyr_vyrob"]+((($zaznam3["vyrobna"]*$zaznam2["vyr_vyrob"])/100)*($eko[level]))*($zaznam3["spokojenost"]/100)*$peniz;

else:

$vyrobacp+=$zaznam3["vyrobna"]*$zaznam2["vyr_vyrob"]*($zaznam3["spokojenost"]/100)*$peniz;	

endif;

 

$jemist=$zaznam3[mesta]*$zaznam2[mest];

if(($zaznam3[vyrobna]+$zaznam3[kasarna]+$zaznam3[sdi]+$zaznam3[par]+$zaznam3[laborator])>$jemist):

if($zaznam3[par]>$jemist):

$zp=$jemist;

$sp=$zaznam3[par]-$jemist;

 

$zl=0;

$sl=$zaznam3[laborator];

$zs=0;

$ss=$zaznam3[sdi];

$zk=0;

$sk=$zaznam3[kasarna];

$zv=0;

$sv=$zaznam3[vyrobna];

elseif(($zaznam3[par]+$zaznam3[laborator])>$jemist):

$zp=$zaznam3[par];

$sp=0;

$jemist-=$zaznam3[par];

$zl=$jemist;

$sl=$zaznam3[laborator]-$jemist;

 

$zs=0;

$ss=$zaznam3[sdi];

$zk=0;

$sk=$zaznam3[kasarna];

$zv=0;

$sv=$zaznam3[vyrobna];

elseif(($zaznam3[par]+$zaznam3[laborator]+$zaznam3[sdi])>$jemist):

$zp=$zaznam3[par];

$sp=0;

$jemist-=$zaznam3[par];

$zl=$zaznam3[laborator];

$sl=0;	

$jemist-=$zaznam3[laborator];

$zs=$jemist;

$ss=$zaznam3[sdi]-$jemist;

 

$zk=0;

$sk=$zaznam3[kasarna];

$zv=0;

$sv=$zaznam3[vyrobna];

elseif(($zaznam3[par]+$zaznam3[laborator]+$zaznam3[sdi]+$zaznam3[kasarna])>$jemist):

$zp=$zaznam3[par];

$sp=0;

$jemist-=$zaznam3[par];

$zl=$zaznam3[laborator];

$sl=0;	

$jemist-=$zaznam3[laborator];

$zs=$zaznam3[sdi];

$ss=0;	

$jemist-=$zaznam3[sdi];

$zk=$jemist;

$sk=$zaznam3[kasarna]-$jemist;	

 

$zv=0;

$sv=$zaznam3[vyrobna];

else:

$zp=$zaznam3[par];

$sp=0;

$jemist-=$zaznam3[par];

$zl=$zaznam3[laborator];

$sl=0;

$jemist-=$zaznam3[laborator];

$zs=$zaznam3[sdi];

$ss=0;

$jemist-=$zaznam3[sdi];

$zk=$zaznam3[kasarna];

$sk=0;	

$jemist-=$zaznam3[kasarna];

$zv=$jemist;

$sk=$zaznam3[vyrobna]-$jemist;	

endif;

MySQL_Query("update planety set par=$zp,laborator=$zl,sdi=$zs,kasarna=$zk,vyrobna=$zv where cislo = $planetka");

echo "<font class=text_cerveny>Kvůli nedostatku místa spadlo na planetě $planetkam";

if($sp>0){echo " $sp krát $zaznam2[park_nazev]";};

if($sl>0){echo " $sl krát laboratoř";};

if($ss>0){echo " $ss krát $zaznam2[sdi_nazev]";};

if($sk>0){echo " $sk krát kasárna";};

if($sv>0){echo " $sv krát $zaznam2[vyr_nazev]";};

echo "</font><br />";

endif;	

$vyroba+=($pla[prijem]*$zaznam2["vyr_vyrob"])*$bstav;

// echo "!!!:" . ($pla[prijem]*$zaznam2["vyr_vyrob"])."<br>";

 

$penizex+=$vyroba;	

//$plavyz+=$vyroba*(1+$pla[vyzkum]/100);

$pridejdv+=$vyroba*($zaznam1["vyzkum"]/100);

// echo "DAL: ".$pridejdv."<br>";

 

if ($pla[vyzkum]!=0) $bonusyvyz=(($pla[prijem]*$zaznam2["vyr_vyrob"])*$bstav)*$pla[vyzkum]/100;

 

// echo "BV: " . $bonusyvyz;}

// echo "<font class=info>";

// echo "<br />".($vyroba*($zaznam1["fond"]/100+$pla[vyzkum]/100));

endwhile;

//**********************end cyklus planety**********************************

 

if($stav[zkus]>0 and $datum1>0):

$prupro/=$zaznam1[planety];

$cc=1;

if($datum1>0){$cc=1;};

$zkusn=($prupro/10)*2;

$zkusn*=$zaznam1[prijem]/($zaznam2[mes_cena]*10);

$zkusn*=$cc;

// echo "<font class='tabulka'>ss$zkusn</font>";

$zkusn=Floor($zkusn)+$stav[zkus];

$lv=bcsqrt($zkusn/750);

$lv=Floor($lv);

if($lv>20 and $datum1>0){$lv=20;$zkusn=$lv*$lv*1000;};

MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislos");

endif;

 

 

//*********************begin kontrola m�sta v kas�rn�ch***************************

$cmkasarna=$pkasarna*$zaznam2["kas_lidi"];

$vmkasarna=$cmkasarna-$zaznam2["jed1_lidi"]*$zaznam1["jed1"];

$vmkasarna-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];

$vmkasarna-=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];

$vmkasarna-=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];

$vmkasarna-=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];

$vmkasarna-=$zaznam2["jed6_lidi"]*$zaznam1["jed6"];

$vmkasarna-=$zaznam2["jed7_lidi"]*$zaznam1["jed7"];

$vmkasarna-=$zaznam2["jed8_lidi"]*$zaznam1["jed8"];

$vmkasarna-=$obchod;

$omkasarna=$zaznam2["jed1_lidi"]*$zaznam1["jed1"];

$omkasarna+=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];

$omkasarna+=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];

$omkasarna+=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];

$omkasarna+=$zaznam2["jed6_lidi"]*$zaznam1["jed6"];

$omkasarna+=$zaznam2["jed7_lidi"]*$zaznam1["jed7"];

$omkasarna+=$zaznam2["jed8_lidi"]*$zaznam1["jed8"];

$omkasarna+=$obchod;	

 

if($omkasarna>$cmkasarna):

if($vmkasarna<0):

$vmkasarna=0;

endif;

if(($zaznam2["jed4_lidi"]*$zaznam1["jed4"])>=$cmkasarna):

$zbjed4=Floor($vmk/$zaznam2["jed4_lidi"]);

$umjed4=$zaznam1["jed4"]-$zbjed4;

 

$zbjed3=0;

$umjed3=$zaznam1["jed3"];

 

$zbjed2=0;

$umjed2=$zaznam1["jed2"];

 

$zbjed1=0;

$umjed1=$zaznam1["jed1"];

 

$zbjed6=0;

$umjed6=$zaznam1["jed6"];

 

$zbjed7=0;

$umjed7=$zaznam1["jed7"];

 

$zbjed8=0;

$umjed8=$zaznam1["jed8"];

 

elseif(($zaznam2["jed4_lidi"]*$zaznam1["jed4"]+$zaznam2["jed2_lidi"]*$zaznam1["jed2"])>=$cmkasarna):

$vmk=$cmkasarna;

 

$zbjed4=$zaznam1["jed4"];

$umjed4=0;

$vmk-=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];

 

$zbjed3=0;

$umjed3=$zaznam1["jed3"];

 

$zbjed2=Floor($vmk/$zaznam2["jed2_lidi"]);

$umjed2=$zaznam1["jed2"]-$zbjed2;

 

$zbjed1=0;

$umjed1=$zaznam1["jed1"];

 

$zbjed6=0;

$umjed6=$zaznam1["jed6"];

 

$zbjed7=0;

$umjed7=$zaznam1["jed7"];

 

$zbjed8=0;

$umjed8=$zaznam1["jed8"];

 

elseif(($zaznam2["jed3_lidi"]*$zaznam1["jed3"]+$zaznam2["jed2_lidi"]*$zaznam1["jed2"]+$zaznam2["jed4_lidi"]*$zaznam1["jed4"])>=$cmkasarna):	

$vmk=$cmkasarna;

 

$zbjed4=$zaznam1["jed4"];

$umjed4=0;

$vmk-=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];

 

$zbjed2=$zaznam1["jed2"];

$umjed2=0;

$vmk-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];

 

$zbjed3=Floor($vmk/$zaznam2["jed3_lidi"]);

$umjed3=$zaznam1["jed3"]-$zbjed3;

 

$zbjed1=0;

$umjed1=$zaznam1["jed1"];

 

$zbjed6=0;

$umjed6=$zaznam1["jed6"];

$zbjed7=0;

$umjed7=$zaznam1["jed7"];

 

$zbjed8=0;

$umjed8=$zaznam1["jed8"];

 

//*******umirani zlodeju+politiku+agentu*********

elseif(($zaznam2["jed3_lidi"]*$zaznam1["jed3"]+$zaznam2["jed2_lidi"]*$zaznam1["jed2"]+$zaznam2["jed4_lidi"]*$zaznam1["jed4"]+$zaznam2["jed6_lidi"]*$zaznam1["jed6"])>=$cmkasarna):	

$vmk=$cmkasarna;

 

$zbjed4=$zaznam1["jed4"];

$umjed4=0;

$vmk-=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];

 

$zbjed2=$zaznam1["jed2"];

$umjed2=0;

$vmk-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];

 

$zbjed3=$zaznam1["jed3"];

$umjed3=0;

$vmk-=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];

 

$zbjed6=Floor($vmk/$zaznam2["jed6_lidi"]);

$umjed6=$zaznam1["jed6"]-$zbjed6;

 

$zbjed1=0;

$umjed1=$zaznam1["jed1"];

 

$zbjed7=0;

$umjed7=$zaznam1["jed7"];

 

$zbjed8=0;

$umjed8=$zaznam1["jed8"];

 

elseif(($zaznam2["jed3_lidi"]*$zaznam1["jed3"]+$zaznam2["jed2_lidi"]*$zaznam1["jed2"]+$zaznam2["jed4_lidi"]*$zaznam1["jed4"]+$zaznam2["jed6_lidi"]*$zaznam1["jed7"]+$zaznam2["jed7_lidi"]*$zaznam1["jed7"])>=$cmkasarna):	

$vmk=$cmkasarna;

 

$zbjed4=$zaznam1["jed4"];

$umjed4=0;

$vmk-=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];

 

$zbjed2=$zaznam1["jed2"];

$umjed2=0;

$vmk-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];

 

$zbjed3=$zaznam1["jed3"];

$umjed3=0;

$vmk-=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];

 

$zbjed6=$zaznam1["jed6"];

$umjed6=0;

$vmk-=$zaznam2["jed6_lidi"]*$zaznam1["jed6"];

 

$zbjed7=Floor($vmk/$zaznam2["jed7_lidi"]);

$umjed7=$zaznam1["jed7"]-$zbjed7;

 

$zbjed1=0;

$umjed1=$zaznam1["jed1"];

 

$zbjed8=0;

$umjed8=$zaznam1["jed8"];

 

elseif(($zaznam2["jed3_lidi"]*$zaznam1["jed3"]+$zaznam2["jed2_lidi"]*$zaznam1["jed2"]+$zaznam2["jed4_lidi"]*$zaznam1["jed4"]+$zaznam2["jed6_lidi"]*$zaznam1["jed6"]+$zaznam2["jed7_lidi"]*$zaznam1["jed7"]+$zaznam2["jed7_lidi"]*$zaznam1["jed8"]+$zaznam2["jed8_lidi"]*$zaznam1["jed8"])>=$cmkasarna):	

$vmk=$cmkasarna;

 

$zbjed4=$zaznam1["jed4"];

$umjed4=0;

$vmk-=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];

 

$zbjed2=$zaznam1["jed2"];

$umjed2=0;

$vmk-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];

 

$zbjed3=$zaznam1["jed3"];

$umjed3=0;

$vmk-=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];

 

$zbjed6=$zaznam1["jed6"];

$umjed6=0;

$vmk-=$zaznam2["jed6_lidi"]*$zaznam1["jed6"];

 

$zbjed7=$zaznam1["jed7"];

$umjed7=0;

$vmk-=$zaznam2["jed7_lidi"]*$zaznam1["jed7"];

 

$zbjed8=Floor($vmk/$zaznam2["jed8_lidi"]);

$umjed8=$zaznam1["jed8"]-$zbjed8;

 

$zbjed1=0;

$umjed1=$zaznam1["jed1"];

 

//********umirani zlodeju+politiku+agentu end**********

else:

$zbjed4=$zaznam1["jed4"];

$umjed4=0;

$vmk-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];

 

$zbjed2=$zaznam1["jed2"];

$umjed2=0;

$vmk-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];

 

$zbjed3=$zaznam1["jed3"];

$umjed3=0;

$vmk-=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];

 

$zbjed6=$zaznam1["jed6"];

$umjed6=0;

$vmk-=$zaznam2["jed6_lidi"]*$zaznam1["jed6"];

 

$zbjed1=Floor($vmk/$zaznam2["jed1_lidi"]);

$umjed1=$zaznam1["jed1"]-$zbjed1;

 

endif;

$umjed1*=0.5;

$umjed2*=0.5;

$umjed3*=0.5;

$umjed4*=0.5;

$umjed6*=0.5;

$zbjed1+=$umjed1;

$zbjed2+=$umjed2;

$zbjed3+=$umjed3;

$zbjed4+=$umjed4;

$zbjed6+=$umjed6;

 

echo "<font class='text_cerveny'>Kvůli nedostatku místa v kasárnách zemřelo ".$umjed1." krát ".$zaznam2["jed1_nazev"]." , ".$umjed2." krát ".$zaznam2["jed2_nazev"]." , ".$umjed3." krát ".$zaznam2["jed3_nazev"]." , ".$umjed4." krát ".$zaznam2["jed4_nazev"]." , ".$umjed6." krát ".$zaznam2["jed6_nazev"]." , ".$umjed7." krát ".$zaznam2["jed7nazev"]." , ".$umjed8." krát ".$zaznam2["jed8_nazev"]."</font><br />";

MySQL_Query("update uzivatele set jed1 = $zbjed1,jed2 = $zbjed2,jed3 = $zbjed3,jed4 = $zbjed4,jed6 = $zbjed6,jed7=$zbjed7,jed8=$zbjed8 where cislo=$logcislo");

endif;

//*********************end kontrola m�sta v kas�rn�ch***************************

if($datum1!=0):

MySQL_Query("update uzivatele set den = $sek where cislo=$logcislo");

endif;

if($kolikplan<2):

MySQL_Query("update uzivatele set vyzkum = 0 where cislo=$logcislo");

endif;

 

//*********************begin fond&vyzkum*****************************************

 

MySQL_Query("update uzivatele set populace = ($populace/1000000) where cislo=$logcislo");

///upraveno ACE1 14.9.2006

$dovyzkum1=$pridejdv;

$dovyzkum=$pridejdv*($zaznam1["bran"]*0.05+1);

// echo "dovyzkum=".$dovyzkum."<br>";

// echo "dovyzkum1=".$dovyzkum1."<br>";

 

// echo "DV: " . $dovyzkum."<br>";

$dofond=$penizex*($zaznam1["fond"]/100);

 

$dovyzkumcp=$vyrobacp*($cpdb[vyzkum]/100);

$dofondcp=$vyrobacp*($cpdb[fond]/100);	

//$penizex=($penizex-$dofond-$dovyzkum-$dofondcp-$dovyzkumcp)+$vyrobacp+$bonusyvz;

 

///*************************nove

$mischo = mysql_query("select * from uzivatele where cislo='$logcislo'");

$prx = Mysql_Fetch_Array($mischo);

 

 

if($zaznam1[rasa]==98 OR $zaznam1[rasa]==97):

if ($prx["gold"] == 1)

{

$penizex=(($penizex)+$vyrobacp+$bonusyvz) * 1.15;

}

else

{

$penizex=($penizex)+$vyrobacp+$bonusyvz;

}

else:

// echo $penizex;

//echo"<br />";

if ($prx["gold"] == 1)

{

$penizex=(($penizex-$dofond-$dovyzkum1-$dofondcp-$dovyzkumcp)+$vyrobacp+$bonusyvz) * 1.15;

}

else

{

$penizex=($penizex-$dofond-$dovyzkum1-$dofondcp-$dovyzkumcp)+$vyrobacp+$bonusyvz;	

}

/* echo "df";

  echo $dofond;

echo"<br />";

  echo "dv";

  echo $dovyzkum;

echo"<br />";

  echo "dfc";

  echo $dofondcp;

echo"<br />";

  echo "dvc";

  echo $dovyzkumcp;

echo"<br />";

  echo "vyc";

  echo $vyrobacp;

echo"<br />";

  echo "b";

  echo $bonusyvz;

echo"<br />";

 

  echo $penizex;

echo"<br />"; */

 

endif;

 

 

$prispevkyfo+=$dofondcp+$dofond;

 

$vyrobacp=($vyrobacp-$dofondcp)-$dovyzkumcp;

 

$dovyzkum*=$politika[vyzkum]/100;

// echo "+politika : $dovyzkum<br>";

$dovyzkum*=$narod[vyzkum]/100;

// echo "+narod : $dovyzkum<br>";

$dovyzkum*=$zriz[vyzkum]/100;

// echo "+zrizeni : $dovyzkum<br>";

if($zaznam1[planety]>1){$dovyzkum+=$lab*$zaznam2[lab_vyz];};

// echo "+laboratore : $dovyzkum<br>";

$dovyzkum*=$bstav3;

// echo "+cosi : $dovyzkum<br>";

$tyvyzkum=$dovyzkum;

// echo "+javyzkum : $dovyzkum<br>";

$dovyzkum+=$dovyzkumcp;

// echo "+cp : $dovyzkum<br>";

$prispevkyvy+=$dovyzkum;

// echo "+prispevkyvy : $prispevkyvy<br>";

 

$heh = mysql_query("Select * from planety where (majitel='$logjmeno') and (typ='Planeta technologií')");

$bobo = mysql_num_rows($heh);	

//EDITED BY FuF

//byl problem s vyzkumem a de delalo ty sotva 1/10 toho co tam melo jit

// puvodni: $prispevkyvy= ($prispevkyvy * 0.111) + (($penizex * 0.111) * ($bobo * 0.03));

$prispevkyvy+= ($prispevkyvy) * ($bobo * 0.03);

// echo "+prispevkyvy : $prispevkyvy<br>";

$dovyzkum = $prispevkyvy;

 

$dofond*=$datum1;

$dovyzkum*=$datum1;

$dofondcp*=$datum1;

$dovyzkumcp*=$datum1;

$vyrobacp*=$datum1;	

 

$penize1=$penize1+($penizex*$datum1);	

//$penize1=(($penize1-$dofond)-$dovyzkum)+$vyrobacp+$bonusyvz;

 

//$prispevky+=Round($dovyzkum/$datum1);

$dovyzkum+=$vyzkum["kolik"];

$cc=0;

if($datum1>0){$cc=1;};

$zkusn=($zaznam1["fond"]/100)/20;

$zkusn*=$tyvyzkum/($zaznam2[mes_cena]*10);

$zkusn*=$cc;

 

$zkusn=Floor($zkusn)+$stav3[zkus];

$lv=bcsqrt($zkusn/750);

$lv=Floor($lv);

if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};

MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislos3");

 

$dofond+=$dofondcp;	

$dofond+=$zaznam5["fond"];

$penize_zaklad=$penize1-$penize_zaklad;	

 

///*************************nove

if($zaznam1[rasa]==98 OR $zaznam1[rasa]==97){

$dofond=$zaznam5["fond"];;

$dovyzkum=0.0;

$prispevkyfo=0.0;

$prispevkyvy=0.0;

}

 

 

//*********************end fond&vyzkum*****************************************

 

//*********************změna vztahů - begin*********************************************

 

if((isset($v1))or(isset($v2))):

$i=1;

$pakt=0;

while($i<$pocetras):

$o="v".$i;

if($strs[$i]==1 and $zaznam2[status]==1)://echo "<font class='tabulka'>$i</font>";

switch($$o){

case 0:$x[$i]="spojenectví";break;

case 1:$x[$i]="neutralita";break;

case 2:$x[$i]="blokáda";break;	

}

$naz=$$o;	

else:

switch($$o){

case 0:$x[$i]="1";

if($rasa1!=$i){;$pakt++;};break;	

case 1:$x[$i]="2";

if($rasa1!=$i){;$neu++;};break;	

case 2:$x[$i]="3";break;	

case 3:$x[$i]="4";	break;	

case 4:$x[$i]="5";break;	

}

$naz=$$o;

endif;

$i++;

endwhile;

if($pakt<=2 and $neu<=7):

MySQL_Query("update vztahy set a = '$x[1]',b = '$x[2]',c = '$x[3]',d = '$x[4]',e = '$x[5]',f = '$x[6]',g = '$x[7]',h = '$x[8]',i = '$x[9]',j = '$x[10]' where rasa = $rasa1");

else:

echo "<font class='text_cerveny'>Nesmíte mít víc jak 1 pakt a více jak 7 neútočení.</font>";

endif;

endif;

//*********************změna vztahů - end*********************************************

if($rasa1!=97 and $rasa1!=0 and $rasa1!=98 and $rasa1!=99):

if($zaznam2[status]==1):

$vys8 = MySQL_Query("SELECT * FROM vztahy where rasa = $rasa1 order by rasa");

$zaznam8 = MySQL_Fetch_Array($vys8);

else:

$vys8 = MySQL_Query("SELECT * FROM vztahy where rasa = $rasa1 order by rasa");

$zaznam8 = MySQL_Fetch_Array($vys8);

endif;

endif;

 

$utok=$zaznam1["jed1"]*$zaznam2["jed1_utok"];

$utok+=$zaznam1["jed2"]*$zaznam2["jed2_utok"];

$utok+=$zaznam1["jed7"]*$zaznam2["jed7_utok"];

$utok+=$zaznam1["jed4"]*$zaznam2["jed4_utok"];

$utok+=$zaznam1["jed5"]*$zold_utok;

$bonusut=1*$politika[utok]/100;

$bonusut*=$narod[utok]/100;

$bonusut*=$zriz[utok]/100;

$utok*=$bonusut;

$obrana=$zaznam1["jed1"]*$zaznam2["jed1_obrana"];

$obrana+=$zaznam1["jed2"]*$zaznam2["jed2_obrana"];

$obrana+=$zaznam1["jed7"]*$zaznam2["jed7_obrana"];

$obrana+=$zaznam1["jed4"]*$zaznam2["jed4_obrana"];

$obrana+=$zaznam1["jed5"]*$zold_obrana;

$bonusob=1*$politika[obrana]/100;

$bonusob*=$narod[obrana]/100;

$bonusob*=$zriz[obrana]/100;	

$obrana*=$bonusob;	

 

$sila=$obrana+$utok;

$as=$rasa1."r";

if($zaznam1[rasa]==8 or $zaznam1[rasa]==0){$as="1r";};

$tvujnarod=$narod[$as];

$tvujzriz=$zriz[$as];

 

 

 

//***************************************************banka zacatek******************************

 

 

$banka=$zaznam1[banka];

 

$banka1=$banka;

 

//***************************************************banka konec******************************

 

 

//***************************************************multáctví-begin******************************

$am2 = MySQL_Query("SELECT cislo,varovani FROM multaci where cislo=$logcislo");

$am = MySQL_Fetch_Array($am2);	

 

switch($am[varovani]):

case 0: $statusam="pouze udán";

$coloram="#66FF33";

break;

case 1: $statusam="jednou varován";

$coloram="#7D7D00";

break;

case 2: $statusam="dvakrát varován";

$coloram="#CC6600";

break;

case 3: $statusam="třikrát varován";

$coloram="#CC0000";

break;

endswitch;

//***************************************************multáctví-end******************************

 

echo "<form name='vztahy' method='post' action='hlavni.php?page=info'>";

//

for($i=0;$i<14;$i++):

if ($zaznam1["rasa"]==$i){echo"<table width=\"100%\" border=\"0\" height=\"50%\" align=\"center\">";}

endfor;

 

echo "<font color='0099ff'>";

echo "Zpr�va dne: <br />";

echo "</font>";

echo "<font color='dc3c3c'>";

echo $ser["admin_zprava"];

echo "</font>";

 

//*******************************mocnost***********************************

$vys1 = MySQL_Query("SELECT populace, planety FROM uzivatele where cislo='$logcislo'");

$zaznamm = MySQL_Fetch_Array($vys1);

 

$mocnost = Round($sila*$zaznamm["populace"]*$zaznamm["planety"]/100000);

 

//***************************************************************************

 

 

//echo "<center><table width=100% >";

echo "<tr valign=top>";

echo "<td>";

echo "<TABLE align=left>";

echo "<tr>";

//echo "<td colspan=2><center><a href='hlavni.php?page=sraz'><h1><font color='red'>SRAZ</font></h1></a><br /><br /><font class='nadpis'>Statistiky</font></td>";

echo "<td colspan=2><font class='nadpis'>Statistiky</font></td>";

echo "</tr>";

echo "<tr>";

/*if(($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4)):

echo "<td><font class='text_modry'>Jm�no</font></td><td><font class='text_bili'><b><a href='hlavni.php?page=admin'>".$zaznam1["jmeno"]."</a></b></td>";

else:*/

echo "<td align=left><font class='text_modry'>Jm�no</font></td><td><font class='text_bili'><b>".$zaznam1["jmeno"]."</b></td>";

//endif;

echo "</tr>";

echo "<tr>";

echo "<td><font class='text_modry'>Status</font></td><td ><font class='text_bili'>".$s."</td>";

echo "</tr>";

echo "<tr>";

echo "<td><font class='text_modry'>Rasa</font></td><td ><font class='text_bili'>".$zaznam2["nazevrasy"]."</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Národ</font></td><td ><font class='text_bili'>".$tvujnarod."</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Státná zřízení</font></td><td ><font class='text_bili'>".$zriz[$as]."</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Síla</font></td><td><font class='text_bili'>".number_format($sila,0,0," ")."</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Mocnost</font></td><td><font class='text_bili'>".number_format($mocnost,0,0," ")."</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Věk profilu</font></td><td ><font class='text_bili'>".Floor($sekvek/86400)." dn�</td>";

echo "</tr>";	

echo "<tr>";

echo "<td ><font class='text_modry'>Nebyl jste tu dní</font></td><td ><font class='text_bili'>".$datum1."</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Další přepočet za</font></td><td ><font class='text_bili'>".$next." ".$slovmin."</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Aktuální čas</font></td><td ><font class='text_bili'>";require"hodiny2.php";echo"</td>";

echo "</tr>";

 

echo "<tr>";

echo "<td ><font class='text_modry'>čas serveru</font></td><td ><font class='text_bili'>".Date("H:i:s")."</td>";

echo "</tr>";

 

if($zaznam1[casnasg]>0):

$minut=$zaznam1[casnasg]/60;

$minut=floor($minut);

else:

$minut=0;

endif;

 

$minut=$zaznam1[casnasg]/60;

$minut=floor($minut);

 

 

echo "<tr>";

echo "<td ><font class='text_modry'>čas na SG - NB</font></td><td ><font class='text_bili'>".$minut." minut</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Planet</font></td><td ><font class='text_bili'>".$kolikplan."</td>";

echo "</tr>";

 

echo "<tr>";

echo "<td ><font class='text_modry'>Naquadah</font></td><td ><font class='text_bili'>".number_format($penize1,0,0," ")."</td>";

echo "</tr>";

 

echo "<tr>";

echo "<td ><font class='text_modry'>V bance</font></td><td ><font class='text_bili'>".number_format($banka1,0,0," ")."</td>";

echo "</tr>";

 

echo "<tr>";

echo "<td ><font class='text_modry'>Denní zisk</font></td><td ><font class='text_bili'>".number_format($penizex,0,0," ")."</td>";

echo "</tr>";

echo "<tr>";

echo "<td ><font class='text_modry'>Příspěvek do fondu</font></td><td ><font class='text_bili'>".number_format($prispevkyfo,0,0," ")."</td>";

echo "</tr>";	

echo "<tr>";

echo "<td ><font class='text_modry'>Příspěvek na výzkum</font></td><td ><font class='text_bili'>".number_format($prispevkyvy,0,0," ")."</td>";

echo "</tr>";	

echo "<tr>";

echo "<td ><font class='text_modry'>Populace</font></td><td><font class='text_bili'>" .number_format($populace/1000000,0,0," ") ." milionů</td>";

echo "</tr>";

 

if($zaznam1[statusucitel]==1):

 

echo "<tr>";

echo "<td ><font class='text_modry'>Vaši nováčci</font></td><td ><font class='text_bili'><a href=hlavni.php?page=seznamn>seznam nováčků</a></td>";

echo "</tr>";

endif;

 

if($am[varovani]>-1):

echo "<tr>";

echo "<td ><font class='text_modry'>Mulťáctví</font></td><td ><font class='text_bili'>"./*<font color=$coloram>".*/$statusam."</font></td>";

echo "</tr>";	

endif;

echo "</table>";

echo "</td>";

echo "<td>";

 

if ($datum1 > 0){

//$datum=Date("G:i:s j.m.Y");

$datum = Date("U");

 

//echo $datum . " den, " . number_format($penizex,0,0,"") . " penize, " . $prispevkyfo . " fond, " . $prispevkyvy. " vysk.";

 

mysql_query("insert into logprep (datum, kto, dz, rf, vf) values ('$datum', '$logjmeno', '$penizex', '$prispevkyfo', '$prispevkyvy')") or die("ee");	

}

 

//*****************************************zobrazení vztahů - begin ******************************

if($rasa1!=98 and $rasa1!=97 and $rasa1!=99)

{

echo "<TABLE width=100%>";

echo "<tr>";

echo "<td colspan=2><center><font class='nadpis'> Vztahy</td>";

echo "</tr>";

echo "<tr>";

 

echo "<td><b>S rasou</b></td>";

 

 

if($zaznam1["status"]!=1 and $zaznam9b["min1"]!=$logjmeno)

{

echo "<td><b>Vztah</b></td>";

}

else

{

echo "<td><b><font color=green>Pakt </font>/<font color=#00dddd> Ne�to�en� </font>/<font color=white> Mír </font> /<font color=yellow> Neutralita </font>/<font color=red> Válka</font></b></td>";

}

echo "<td><font class='text_bili'>Jejich postoj</td>";

echo "</tr>";

$tab=1;

 

 

$smlouvy_result = mysql_query("SELECT rasa1, rasa2, vztahy, status, vyprsi FROM smlouvy WHERE (rasa1='$rasa1' OR rasa2='$rasa1') AND (status='1' OR vyprsi > '".time()."') ORDER BY den ASC");

while($smlouvy_arr = mysql_fetch_array($smlouvy_result))

{

 

if($smlouvy_arr[rasa1] == $rasa1)

{

$sml_pole[$smlouvy_arr[rasa2]] = $smlouvy_arr[vztahy];

}

if($smlouvy_arr[rasa2] == $rasa1)

{

$sml_pole[$smlouvy_arr[rasa1]] = $smlouvy_arr[vztahy];

}

 

}

 

 

 

while($tab<3)

{

if($zaznam2[status]!=1)

{

$tab=7;

}

 

$i=1;

$abc[1]="a";$abc[2]="b";$abc[3]="c";$abc[4]="d";$abc[5]="e";$abc[6]="f";$abc[7]="g";$abc[8]="h";$abc[9]="i";$abc[10]="j";

$rasn2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa>0 and rasa<11) order by rasa");

while($rasn = MySQL_Fetch_Array($rasn2))

{

$pispole[$rasn[rasa]]=$abc[$rasn[rasa]];$nrasapole[$rasn[rasa]]=$rasn[nazev];

}

 

for($i=1;$i<$pocetras+2;$i++)

{

$pis=$pispole[$i];

$nrasa=$nrasapole[$i];

/*switch ($i){

case 1: $pis="a";$nrasa="Anubisovi Goa�uldi";break;

case 2: $pis="b";$nrasa="Asgardi";break;

case 3: $pis="c";$nrasa="Ta�uri";break;

case 4: $pis="d";$nrasa="Jaffové";break;

};*/

if($zaznam1[rasa]!=$i)

{

$m=$v=$a=$b=$c=0;

if(($zaznam2[status]!=1 or $strs[$i]!=1) and $tab==1 or $tab==7)

{

switch($zaznam8[$pis]){

case "1":$m="checked";$b1="green";$vztah_text1="Pakt";break;	

case "2":$a="checked";$b1="#00dddd";$vztah_text1="Neútočení";break;

case "3":$v="checked";$b1="white";$vztah_text1="Mír";break;	

case "4":$b="checked";$b1="yellow";$vztah_text1="Neutralita";break;	

case "5":$c="checked";$b1="red";$vztah_text1="Válka";break;	

default:$c="checked";$b1="black";$vztah_text1="&nbsp;";break;

}

switch($d[$i]){

case "1":$b2="green";$vztah_text2="Pakt";break;	

case "2":$b2="#00dddd";$vztah_text2="Neútočení";break;	

case "3":$b2="white";$vztah_text2="Mír";break;	

case "4":$b2="yellow";$vztah_text2="Neutralita";break;	

case "5":$b2="red";$vztah_text2="Válka";break;

default:$b2="black";$vztah_text2="&nbsp;";break;

}	

}

if((($zaznam2[status]!=1 or $strs[$i]!=1) and $tab==1 or $tab==7)or($zaznam2[status]==1 and $strs[$i]==1 and $tab==2))

{

echo "<tr>";

if($zaznam1["status"]!=1 and $zaznam9b["min1"]!=$logjmeno)

{	

echo "<td><font class='text_bili'>".$nrasa."</td><td><font class='text_bili'><font color=".$b1.">".$vztah_text1."</font></td>";

}

else

{

if($sml_pole[$i] == null)

$sml_pole[$i] = "11111";

$array_vztahy_decoded = array();

$array_vztahy_decoded = sscanf($sml_pole[$i],"%1d%1d%1d%1d%1d");

for($pica = 0;$pica < 9;$pica++)

{

if($array_vztahy_decoded[$pica] != 1)

{

$array_vztahy_text[$pica] = " disabled='true'";

}

else

{

$array_vztahy_text[$pica] = " ";

}

}

$pica = 0;

echo "<td><font class='text_bili'>".$nrasa."</td><td>";

echo "<input type=radio name='v".$i."' value='0' ".$m." ". $array_vztahy_text[0] . $array_vztahy_decoded[0] . ">&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<input type=radio name='v".$i."' value='1' ".$a." ". $array_vztahy_text[1] .">&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<input type=radio name='v".$i."' value='2' ".$v." ". $array_vztahy_text[2] .">&nbsp;&nbsp;&nbsp;&nbsp;";

if(($zaznam2[status]!=1 or $strs[$i]!=1) and $tab==1 or $tab==7)

{

echo "<input type=radio name='v".$i."' value='3' ".$b." ". $array_vztahy_text[3] .">&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<input type=radio name='v".$i."' value='4' ".$c." ". $array_vztahy_text[4] .">";

}

 

echo "</td>";

}

echo "<td><font class='text_bili'><font color=".$b2.">".$vztah_text2."</font></font></td>";

echo "</tr>";

}

}

}

$tab++;

}

 

echo "<tr>";

if($zaznam1["status"]!=1 and $zaznam9b["min1"]!=$logjmeno)

{

echo "";

}

else

{

echo "<td colspan=3><br />"?><input type="submit" class = "butt" value="Změnit vztahy"><?"</td><br />";

}

/* echo "<font class='text_cerveny'><center><a href='http://www.sg-rtg.net/hlavni.php?page=gold'>Objednejte si GOLD STATUS a z�skejte spoustu v�hod.</a>";

*/	echo "<br /></center><br /></font>";

 

echo "</tr>";

echo "</table>";

}

 

else

{

echo "<TABLE width=100%>";

echo "<tr>";

echo "<td><center><font class='nadpis'> Nemůžete měnit vztahy.</td>";

echo "<br /><br /></center><br /></font>";

echo "</tr>";

echo "<tr>";

echo "<td>&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />

&nbsp;<br />&nbsp;<br />&nbsp;<br /></td>";

echo "</tr>";

 

 

echo "</table>";

}	

 

?>

<br />

<?php

echo "<font color='0099ff'>Sdělení rasy:</font>";

 

echo "<div style='border: 0px solid red; margin-left: 60px; width: 380px;'>";

echo "<font color='dc3c3c'>";

echo $zaznam5["rasova_zprava"];

echo "</font>";

echo "</div><br />";	

 

 

 

 

 

 

echo "</td>";

echo "</tr>";

 

echo "</table>";

 

echo "</form>";	

 

//*****************************************zobrazení vztahů - end ******************************

 

//echo $dovyzkum;

 

 

 

MySQL_Query("update uzivatele set penize = $penize1,prijem=$penizex where cislo=$logcislo");

MySQL_Query("update vudce set fond = $dofond where rasa = $rasa1");

MySQL_Query("update vyzkum set kolik = $dovyzkum where rasa = $rasa1");

 

if(empty($xmm) or $xmm<0){$xmm=0;};	

$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = $logcislo ORDER BY spokojenost limit $xmm,20");	

 

 

MySQL_Close($spojeni);	

?>

 

 

 

</body>

</html>