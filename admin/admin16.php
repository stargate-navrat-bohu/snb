<?

mysql_query("SET NAMES cp1250");

	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	require("adkontrola.php");

	if(isset($zmena_armad)):	
		
		MySQL_Query("insert into rasy (rasa, nazevrasy, nazev, jed1_nazev, jed1_utok, jed1_obrana, jed1_cena, jed1_lidi, jed4_nazev, jed4_utok,jed4_obrana, jed4_cena, jed4_lidi, jed2_nazev, jed2_utok, jed2_obrana, jed2_cena, jed2_lidi, jed3_nazev, jed3_ucinek, jed3_cena, jed3_lidi, jed6_nazev, jed6_ucinek, jed6_cena, jed6_lidi, jed7_nazev, jed7_ucinek, jed7_cena, jed7_lidi, jed8_nazev, jed8_ucinek, jed8_cena, jed8_lidi, planeta, vyr_nazev, vyr_vyrob, vyr_lidi, vyr_cena, sdi_nazev, sdi_ucinek, sdi_lidi, sdi_cena, pol_nazev, pol_ucinek, pol_cena, kas_lidi, kas_cena, mes_lidi, mes_cena, mest, lab_lidi, lab_cena, lab_vyz, park_proc, park_cena, park_nazev, bra_cena) VALUES ('$rasaci', '$rasanaz', '$rasanazz', '$jed1', '$jed1u', '$jed1o', '$jed1c', '$jed1l', '$jed4', '$jed4u', '$jed4o', '$jed4c', '$jed4l', '$jed2', '$jed2u', '$jed2o', '$jed2c', '$jed2l', '$jed3', '$jed3u', '$jed3c', '$jed3l', '$jed6', '$jed6u', '$jed6c', '$jed6l', '$jed7', '$jed7u', '$jed7c', '$jed7l', '$jed8', '$jed8u', '$jed8c', '$jed8l', '$cpc', '$vyn', '$vyv', '$vyl', '$vyc', '$sn', '$sv', '$sl', '$sc', '$pon', '$pou', '$poc', '$kl', '$kc', '$ml', '$mc', '$mm', '$ll', '$lc', '$lv', '$pp', '$pc', '$pn', '$bc')");


		MySQL_Query("insert into vudce (rasa) VALUES ('$rasaci')");

		MySQL_Query("insert into cp (rasa) VALUES ('$rasaci')");

		MySQL_Query("insert into rasarm (rasa) VALUES ('$rasaci')");

		MySQL_Query("insert into refnew (cislo) VALUES ('$rasaci')");

		MySQL_Query("insert into vyzkum (rasa) VALUES ('$rasaci')");

		MySQL_Query("insert into vztahy (rasa) VALUES ('$rasaci')");

	endif;	
?>


<?
if($zaznam1[admin]==2){echo "<h1>Sem nemají pomocní adminé pøístup!</h1>";exit;}
?>
</head>

<h6>Vytvoøit novou rasu</h6>

</center>

<?

    $border= 'border=1';

    echo "<center><TABLE ".$border.">";

		echo "<form action='hlavni.php?page=admin16' method='post'>";

                echo "<tr><th colspan=2>Vyplòte formuláø</th></tr>";



		echo "<tr>";
		echo "<th>Název rasy</th>";
		echo "<th><input type='text' value='$rasanaz' name='rasanaz'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Název rasy (bez ')</th>";
		echo "<th><input type='text' value='$rasanazz' name='rasanazz'></th>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<th>èíslo rasy</th>";
		echo "<th><input type='text' size = 10 value='$rasaci' name='rasaci'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>název 1. jednotky</th>";
		echo "<th><input type='text' value='$ra[jed1_nazev]' name='jed1'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>útok 1. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed1_utok]' name='jed1u'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>obrana 1. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed1_obrana]' name='jed1o'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>cena 1. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed1_cena]' name='jed1c'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>míst 1. jednotky</th>";		
		echo "<th><input type='text' size = 10 value='$ra[jed1_lidi]' name='jed1l'></th>";
		echo "</tr>";



		echo "<tr>";
		echo "<th>název 2. jednotky</th>";
		echo "<th><input type='text' value='$ra[jed2_nazev]' name='jed2'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>útok 2. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed2_utok]' name='jed2u'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>obrana 2. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed2_obrana]' name='jed2o'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>cena 2. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed2_cena]' name='jed2c'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>míst 2. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed2_lidi]' name='jed2l'></th>";
		echo "</tr>";




		echo "<tr>";
		echo "<th>název 4. jednotky</th>";
		echo "<th><input type='text' value='$ra[jed4_nazev]' name='jed4'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>útok 4. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed4_utok]' name='jed4u'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>obrana 4. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed4_obrana]' name='jed4o'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>cena 4. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed4_cena]' name='jed4c'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>míst 4. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed4_lidi]' name='jed4l'></th>";
		echo "</tr>";



		echo "<tr>";
		echo "<th>název 3. jednotky</th>";
		echo "<th><input type='text' value='$ra[jed3_nazev]' name='jed3'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>úèinek 3. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed3_ucinek]' name='jed3u'></th>";
		echo "</tr>";


		echo "<tr>";
		echo "<th>cena 3. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed3_cena]' name='jed3c'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>míst 3. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed3_lidi]' name='jed3l'></th>";
		echo "</tr>";


		echo "<tr>";
		echo "<th>název 6. jednotky</th>";
		echo "<th><input type='text' value='$ra[jed6_nazev]' name='jed6'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>úèinek 6. jednotky</th>";
		echo "<th><input type='text' size = 20 value='$ra[jed6_ucinek]' name='jed6u'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>cena 6. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed6_cena]' name='jed6c'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>míst 6. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed6_lidi]' name='jed6l'></th>";
		echo "</tr>";



		echo "<tr>";
		echo "<th>název 7. jednotky</th>";
		echo "<th><input type='text' value='$ra[jed7_nazev]' name='jed7'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>úèinek 7. jednotky</th>";
		echo "<th><input type='text' size = 20 value='$ra[jed7_ucinek]' name='jed7u'></th>";	
		echo "</tr>";

		echo "<tr>";
		echo "<th>cena 7. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed7_cena]' name='jed7c'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>míst 7. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed7_lidi]' name='jed7l'></th>";
		echo "</tr>";



		echo "<tr>";
		echo "<th>název 8. jednotky</th>";
		echo "<th><input type='text' value='$ra[jed8_nazev]' name='jed8'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>úèinek 8. jednotky</th>";
		echo "<th><input type='text' size = 20 value='$ra[jed8_ucinek]' name='jed8u'></th>";
		echo "</tr>";


		echo "<tr>";
		echo "<th>cena 8. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed8_cena]' name='jed8c'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>míst 8. jednotky</th>";
		echo "<th><input type='text' size = 10 value='$ra[jed8_lidi]' name='jed8l'></th>";
		echo "</tr>";






		echo "<tr>";
		echo "<th>Název výrobny</th>";
		echo "<th><input type='text' size = 20 value='$ra[vyr_nazev]' name='vyn'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Výrobna vyrobí</th>";
		echo "<th><input type='text' size = 10 value='$ra[vyr_vyrob]' name='vyv'></th>";	
		echo "</tr>";

		echo "<tr>";
		echo "<th>Výrobna lidí</th>";
		echo "<th><input type='text' size = 10 value='$ra[vyr_lidi]' name='vyl'></th>";	
		echo "</tr>";

		echo "<tr>";
		echo "<th>Cena výrobny</th>";
		echo "<th><input type='text' size = 10 value='$ra[vyr_cena]' name='vyc'></th>";
		echo "</tr>";


	

		echo "<tr>";
		echo "<th>SDI název</th>";
		echo "<th><input type='text' size = 20 value='$ra[sdi_nazev]' name='sn'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>SDI úèinek</th>";
		echo "<th><input type='text' size = 10 value='$ra[sdi_ucinek]' name='sv'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>SDI lidí</th>";
		echo "<th><input type='text' size = 10 value='$ra[sdi_lidi]' name='sl'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>SDI cena</th>";
		echo "<th><input type='text' size = 10 value='$ra[sdi_cena]' name='sc'></th>";
		echo "</tr>";
		



		echo "<tr>";
    		echo "<th>Sídlo obrany název</th>";
		echo "<th><input type='text' size = 20 value='$ra[pol_nazev]' name='pon'></th>";
		echo "</tr>";

		echo "<tr>";
    		echo "<th>Sídlo obrany úèinek</th>";
		echo "<th><input type='text' size = 10 value='$ra[pol_ucinek]' name='pou'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Sídlo obrany cena</th>";
		echo "<th><input type='text' size = 10 value='$ra[pol_cena]' name='poc'></th>";
		echo "</tr>";




		echo "<tr>";
    		echo "<th>Mìsta lidí</th>";
		echo "<th><input type='text' size = 10 value='$ra[mes_lidi]' name='ml'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Mìsta cena</th>";
   		echo "<th><input type='text' size = 10 value='$ra[mes_cena]' name='mc'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Mìsta budov</th>";
    		echo "<th><input type='text' size = 10 value='$ra[mest]' name='mm'></th>";
		echo "</tr>";
		



		echo "<tr>";
		echo "<th>Kasárny míst</th>";
		echo "<th><input type='text' size = 10 value='$ra[kas_lidi]' name='kl'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Kasárny cena</th>";
		echo "<th><input type='text' size = 10 value='$ra[kas_cena]' name='kc'></th>";
		echo "</tr>";





		echo "<tr>";
		echo "<th>Laboratoø pøidává</th>";
		echo "<th><input type='text' size = 10 value='$ra[lab_vyz]' name='lv'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Laboratoø cena</th>";
		echo "<th><input type='text' size = 10 value='$ra[lab_cena]' name='lc'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Laboratoø lidí</th>";
		echo "<th><input type='text' size = 10 value='$ra[lab_lidi]' name='ll'></th>";
		echo "</tr>";




		
		echo "<tr>";
		echo "<th>Park název</th>";
		echo "<th><input type='text' size = 20 value='$ra[park_nazev]' name='pn'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Park cena</th>";
		echo "<th><input type='text' size = 10 value='$ra[park_cena]' name='pc'></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Park úèinek</th>";
		echo "<th><input type='text' size = 10 value='$ra[park_proc]' name='pp'></th>";
		echo "</tr>";



    
		echo "<tr>";
		echo "<th>Stargate cena</th>";
		echo "<th><input type='text' size = 10 value='$ra[bra_cena]' name='bc'></th>";
		echo "</tr>";




		echo "<tr>";
		echo "<th>Planety cena</th>";
		echo "<th><input type='text' size = 10 value='$ra[planeta]' name='cpc'></th>";
		echo "</tr>";


		echo "<tr>";
		echo "<th colspan=2>&nbsp;</th>";
		echo "</tr>";

		echo "<tr>";
		echo "<input type='hidden' name='rasa' value='$rasa'>";
		echo "<input type='hidden' name='zmena_armad' value='1'>";
		echo "<th colspan=2><input type='submit' value='Vytvoøit'></th>";
		echo "</form>";
		echo "</tr>";

		echo "</table>";

?>
</body>
</html>
