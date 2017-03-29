<?
mysql_query("SET NAMES cp1250");
/*
	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	require("adkontrola.php");
*/

echo "<center>";

echo "<font class='text_cerveny'>!!!POZOR!!! - vyplnìní a odeslání formuláøe znamená nenávratný !!!RESTART!!!</font>";

echo "<h6>Restart hry</h6>";

echo "</center>";



if($zaznam1[admin]==2){echo "<h1>Sem nemají pomocní adminé pøístup!</h1>";exit;}


//****************************************************Restart Politiky Oba************************************

$vyzkum="90";
$obrana="90";
$utok="90";
$cenaj="100";
$spokojenost="100";
$cenap="65";
$presun="100";
$cenas="100";
$prodej="100";
$koupe="100";
$cenav="100";
$cena3j="100";
$dent="100";
$cenat="100";



//****************************************************Kompletní Restart SQL************************************

	if(isset($restart_kompletni)):	

		MySQL_Query("DELETE FROM antimulty");

		MySQL_Query("DELETE FROM banka");

		MySQL_Query("DELETE FROM bugs");

		MySQL_Query("DELETE FROM ciny");

		MySQL_Query("update cp set den='0',dobyto='0',fond='0',vyzkum='0'");

		MySQL_Query("DELETE FROM dotazy");

		MySQL_Query("DELETE FROM dotazyn");

		MySQL_Query("DELETE FROM error");

		MySQL_Query("DELETE FROM forum");
		
		MySQL_Query("DELETE FROM logprep");

		MySQL_Query("DELETE FROM posta");

		MySQL_Query("DELETE FROM proxy");

		MySQL_Query("DELETE FROM hrdinove where `status`!='1'");

		MySQL_Query("DELETE FROM log");

		MySQL_Query("DELETE FROM mul");

		MySQL_Query("DELETE FROM multaci");

		MySQL_Query("DELETE FROM obchod where navrhovatel!='' ");

		MySQL_Query("DELETE FROM obchod_planety");

		MySQL_Query("DELETE FROM planety where typ!='2' ");

		MySQL_Query("update politika set vyzkum='$vyzkum',obrana='$obrana',utok='$utok',cenaj='$cenaj',spokojenost='$spokojenost',cenap='$cenap',presun='$presun',cenas='$cenas',prodej='$prodej',koupe='$koupe',cenav='$cenav',cena3j='$cena3j',dent='$dent',cenat='$cenat',priorita='$jakapol',status='3',posl='0' ");

		MySQL_Query("update rasarm set jed1='$jednotek1',jed2='$jednotek2',jed3='$jednotek3',jed4='$jednotek4',jed5='$jednotek5',jed6='$jednotek6',jed7='$jednotek7',jed8='$jednotek8',");

		MySQL_Query("update refnew set otazka='',odpoved1='',odpoved2='',odpoved3='', vysledek='' ");

		MySQL_Query("update servis set loginy='100',planety='100',cp='40',hrdinove='100' ");

		MySQL_Query("DELETE FROM smlouvy");

		MySQL_Query("DELETE FROM utok");

		MySQL_Query("DELETE FROM uzivatele where admin!='1' ");
		
    MySQL_Query("update `hrdinove`  set `level`='10',`zkus`='100000'");
    
		MySQL_Query("update vudce set  vudce='',zastupce='',asistent='',min='0',darz='0',dara='0',fond='0',denz='0',dena='0',posta='',minv='0',denv='0',darv='0',min1='',min2='',min3='',min4='',min5='' ");

		MySQL_Query("update vyzkum set co='Neprobíhá', kolik='0',max='0',nazev='Neprobíhá',nazevvyz='Neprobíhá' ");

		MySQL_Query("update vztahy set a='4',b='4',c='4',d='4' ");

		MySQL_Query("update rasy set  mocnost='0', uzi='0',rozlehlost='0', web='$web',poradi='0',status='3',hracu='0',presunod='0',hrdcen='$hrdcen' where rasa<'12' ");



	endif;	


//****************************************************Malý Restart SQL************************************


	if(isset($restart_maly)):

$kde_smazat=Date("U")-(24*3600);

		MySQL_Query("update `planety` set `cislomaj`='0' where `status`='2' ");

		//MySQL_Query("DELETE FROM `antimulty`");

		MySQL_Query("DELETE FROM `banka`");

		MySQL_Query("DELETE FROM `ciny`");

		MySQL_Query("update `cp` set `den`='0',`dobyto`='0',`fond`='0',vyzkum='0'");

		MySQL_Query("DELETE FROM `error`");

		MySQL_Query("DELETE FROM `forum` where (`kde`!='kin' AND `kde`!='pri')");

		MySQL_Query("DELETE FROM `posta`");

		MySQL_Query("DELETE FROM `hrdinove` where `status`!='1'");

		MySQL_Query("DELETE FROM `log`");

		MySQL_Query("DELETE FROM `online`");

		//MySQL_Query("DELETE FROM `mul`");

		//MySQL_Query("DELETE FROM `multaci`");

		MySQL_Query("DELETE FROM `obchod` where `navrhovatel`!='' ");

		MySQL_Query("DELETE FROM `obchod_planety`");

		//MySQL_Query("DELETE FROM `planety` where (`status`!='2' and `status`!='1') ");
    MySQL_Query("DELETE FROM `planety` where `status`='0'");
    
    MySQL_Query("update `hrdinove`  set `level`='10',`zkus`='100000'");
		MySQL_Query("update `politika` set `vyzkum`='$vyzkum',`obrana`='$obrana',`utok`='$utok',`cenaj`='$cenaj',`spokojenost`='$spokojenost',`cenap`='$cenap',`presun`='$presun',`cenas`='$cenas',`prodej`='$prodej',`koupe`='$koupe',`cenav`='$cenav',`cena3j`='$cena3j',`dent`='$dent',`cenat`='$cenat',`priorita`='$jakapol',`status`='3',`posl`='0' ");

		MySQL_Query("update rasarm set jed1='0',jed2='0',jed3='0',jed4='0',jed5='0',jed6='0',jed7='0',jed8='0' ");

		MySQL_Query("update rasy set uzi='0',poradi='0',hracu='0',presunod='0',poc_planet='0'");

		MySQL_Query("update refnew set `otazka`='',`odpoved1`='',`odpoved2`='',`odpoved3`='', `vysledek`='' ");

		MySQL_Query("DELETE FROM `smlouvy`");

		MySQL_Query("DELETE FROM `utok`");

		MySQL_Query("update `vudce` set  `vudce`='',`zastupce`='',`asistent`='',`min`='0',`darz`='0',`dara`='0',`fond`='0',`denz`='0',`dena`='0',`posta`='',`minv`='0',`denv`='0',`darv`='0',`min1`='',`min2`='',`min3`='',`min4`='',`min5`='' ");

		MySQL_Query("update vyzkum set co='Neprobíhá', kolik='0',max='0',nazev='Neprobíhá',nazevvyz='Neprobíhá' ");

		MySQL_Query("update vztahy set a='4',b='4',c='4',d='4',e='4',f='4',g='4',h='4',i='4',j='4',k='4',l='4',m='4' ");
	
		MySQL_Query("update uzivatele set  `rasa`='77',`penize`='$penez1',`banka`='0',`bankau`='0',`bankaposl`='0',`bankap`='0',`bankav`='0',`bankabudova`='0',`kontrolabankabudova`='0',`planety`='1',`den`='0',`jed1`='0',`jed2`='0',`jed7`='0',`jed8`='0',`jed6`='0',`populace`='0',`sila`='0',`posta`='0',`posta2`='0',`posta3`='0',`posta4`='0',`posta5`='0',`posta6`='0',`posta8`='0',`posta9`='0',`posta10`='0',`volen`='1',`koho`='',`status`='',`fond`='0',`ref`='0',`jed3`='0',`smlouvy`='0',`vyzkum`='0',`dobyt`='0',`dendobyt`='0',`refn`='0',`auto`='0',`jed4`='0',`bran`='0',`narod`='1',`zrizeni`='1',`zmenanar`='0',`zmenazri`='0',prijem='0',jed5='1000',heslo2='',posl='0',hra='0',zmrazeni='0',prepocet='0',vek='$vek',zobrd='0',orp='0',posl='0',destinace='0',dobyl='0',dobyl_part='0',dobyl_zhn='0',dobyl_uni='0',nep_sys='0',vel_fram='0',plan_koupe='0',koupe_cas='0',plan_prodej='0',prodej_cas='0',poc_prodej='0',poc_koupe='0',timedora='0',timezra='0',prispevky='0',prispevkyod='0',utokod='0',utoceno='0',time_obch_plan_p='0',time_obch_plan_k='0',obchodod='0',dobyl_orb='0',dobyl_pol='0',dobyl_age='0',dobyl_lid='0',gold='0',silver='0',poslutok='0', patnactminut='0',casnasg='0',dora='0',zra='0',statusextra='0',statusnovacek='0',statusucitel='0',tvujucitel='',masnemas='0',prechod='0',povydkar='0',prepocet_voj='0' ");




	endif;	



//****************************************************Kompletní Restart Formuláø************************************

    $border= 'border=1';

    echo "<center><TABLE ".$border.">";

		echo "<form action='hlavni.php?page=admin17' method='post'>";

                echo "<tr><th colspan=2>Vyplòte formuláø (kompletní restart)</th></tr>";


		echo "<tr>";
		echo "<th>Rasový web</th>";
		echo "<th><input type='text' value='$web' name='web'></th>";
		echo "</tr>";


		echo "<tr>";
		echo "<th>Cena hrdinù (*vyrobna)</th>";
		echo "<th><input type='text' value='$hrdcen' name='hrdcen'></th>";
		echo "</tr>";


                echo "<tr><th colspan=2>Jednotky v RA (nevyplnìno=0)</th></tr>";

		echo "<tr>";
		echo "<th>1. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$jednotek1' name='jednotek1'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>2. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$jednotek2' name='jednotek2'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>3. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$jednotek3' name='jednotek3'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>4. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$jednotek4' name='jednotek4'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>5. jednotky</th>";		
		echo "<th><input type='text' size = 10 value='$jednotek5' name='jednotek5'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>6. jednotky</th>";		
		echo "<th><input type='text' size = 10 value='$jednotek6' name='jednotek6'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>7. jednotky</th>";		
		echo "<th><input type='text' size = 10 value='$jednotek7' name='jednotek7'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>8. jednotky</th>";		
		echo "<th><input type='text' size = 10 value='$jednotek8' name='jednotek8'></th>";
		echo "</tr>";





		echo "<tr>";
		echo "<th colspan=2>&nbsp;</th>";
		echo "</tr>";

		echo "<tr>";
		echo "<input type='hidden' name='rasa' value='$rasa'>";
		echo "<input type='hidden' name='restart_kompletni' value='1'>";
		echo "<th colspan=2><input type='submit' value='Restartovat'></th>";
		echo "</form>";
		echo "</tr>";

		echo "</table><br />";


//****************************************************Malý Restart Formuláø************************************

    $border= 'border=1';
$vek=Date("U");

    echo "<br /><center><TABLE ".$border.">";

		echo "<form action='hlavni.php?page=admin17' method='post'>";

                echo "<tr><th colspan=2>Vyplòte formuláø (malý restart)</th></tr>";


		echo "<tr>";
		echo "<th>Rasový web</th>";
		echo "<th><input type='text' value='$web' name='web'></th>";
		echo "</tr>";


		echo "<tr>";
		echo "<th>Cena hrdinù (*vyrobna)</th>";
		echo "<th><input type='text' value='$hrdcen' name='hrdcen'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Startovací naquadah (*vyrobna)</th>";
		echo "<th><input type='text' value='$penez1' name='penez1'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th colspan=2>&nbsp;</th>";
		echo "</tr>";

		echo "<tr>";
		echo "<input type='hidden' name='rasa' value='$rasa'>";
		echo "<input type='hidden' name='restart_maly' value='1'>";
		echo "<input type hidden name='vek' value='$vek'>";	
		echo "<th colspan=2><input type='submit' value='Restartovat'></th>";
		echo "</form>";
		echo "</tr>";

		echo "</table>";


?>
</body>
</html>
