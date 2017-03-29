<?


	require "data_1.php";

mysql_query("SET NAMES cp1250");

		
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);


		require("kontrola.php");
		
		function fcis($a){

		$a=number_format($a,0,""," ");

		return $a;	

		}
?>

<center>

<?

include "menupl.php";

		echo "<br><br><center><font class=text_bili><font class=text_modry>S</font>eznam planet</font><br><br>";

?>



<font class=text_bili>Zde máte kompletní pøehled o vašich planetách. A také možnost pøesouvat nezamìstnané z planety na planetu, nebo svoji planetu pøejmenovat.</font><br><br>
<?


		if(isset($prejmenovat)):

			$kontroluj1 = MySQL_Query("SELECT nazev FROM planety where nazev='$prejmnn'");
			$kontroluj = MySQL_Fetch_Array($kontroluj1);

			if($kontroluj[nazev]==""){
				MySQL_Query("update planety set nazev='$prejmnn' where cislo='$prejmn'");
			}
			else{echo "<br><br><font class='text_cerveny'>Bohužel již existuje planeta s tímto jménem. Vyberte prosím nové jméno a zkuste to znovu</font><br><br>";}

					endif;

		if(isset($lidi)):	
			$lidi*=1;
			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa1 = $zaznam1["rasa"];
			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);

			$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika = MySQL_Fetch_Array($politika1);

//echo "<h6>".$kamt;
			$kam2 = MySQL_Query("SELECT * FROM planety where cislo = $kamt");
			$kam = MySQL_Fetch_Array($kam2);
			$odkud2 = MySQL_Query("SELECT * FROM planety where cislo = $odkudt");
			$odkud = MySQL_Fetch_Array($odkud2);

			$a=$odkud["lidi"]-$odkud["vyrobna"]*$zaznam2["vyr_lidi"]-$odkud["sdi"]*$zaznam2["sdi_lidi"];
			$b=$zaznam2[mes_lidi]*$kam[mesta]-$kam["lidi"];
			
			$e=$odkud[cas]+43200;
			do{
				if($politika[cenap]!=25):
					$presunik=3000000000;
					$pres=3;
				else:
					$presunik=2000000000;
					$pres=2;
				endif;
				if(($odkud[presun]+$lidi)>$presunik){echo "<font class='text_cerveny'>Z planety ".$odkud[nazev]." bylo už pøesunuto ".$odkud[presun].". Vy z ní chcete pøesunout dalších ".fcis($lidi)." lidí. Maximum je však ".fcis($pres)." miliardy</font>";break;};
				if($kam[cislomaj]!=$logcislo){echo "<font class='text_cerveny'>Nejste majitelem cílové planety</font>";break;};
				if($odkud[cislomaj]!=$logcislo){echo "<font class='text_cerveny'>Nejste majitelem výchozí planety</font>";break;};
				if($lidi>$a){echo "<font class='text_cerveny'>Tolik nezamìstnaných lidí na planetì ".$odkud[nazev]." neni</font>";break;};
				if($lidi>$b){echo "<font class='text_cerveny'>Tolik nezamìstnaných lidí se na cílovou planetu nevejde</font>";break;};
				if($lidi<0){echo "<font class='text_cerveny'>Špatný tvar èísla. Mùže být pouze celé kladné</font>";break;};
				if($kamt==$odkudt){echo "<font class='text_cerveny'>Nemùžete pøesouvat lidi na tu samou planetu</font>";break;};
				$kdy=Date("H:i:s j.m.Y",$e);
				if(Date("U")<$e){echo "<font class='text_cerveny'>Z planety ".$zaznam3[nazev]." nemùžeme pøesouvat lidi kvùli jejímu nedávnému obsazení. Toho budeme schopni nejdøíve v ".$kdy."</font>";break;};

				$c=$odkud["lidi"]-$lidi;
				$d=$kam["lidi"]+$lidi;
				$pre=$odkud[presun]+$lidi;
				//echo $c.", ". $d;
				//echo ", ".$odkudt.", ".$kamt;
				MySQL_Query("update planety set lidi = $c,presun = $pre where cislo = '$odkudt'");
				MySQL_Query("update planety set lidi = $d where cislo = '$kamt'");
				
			}while(false);
		endif;

		if(($odesli=="hm")){
			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa1 = $zaznam1["rasa"] ;

			$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika = MySQL_Fetch_Array($politika1);

      		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=9 and mrtev!=1)");
			@$stav = MySQL_Fetch_Array($stavitel2);

		 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ=9");
			$typhs = MySQL_Fetch_Array($typhs2);

			$bstav=1-($stav[level]*$typhs[ucinek]);

			if($stav[cislomaj]!=$logcislo){$bstav=1;};
			//echo "<font class =text_bili>".$bstav;
			$cislos=$stav[cislo];

			$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
			$narod = MySQL_Fetch_Array($narod1);

			$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
			$zriz = MySQL_Fetch_Array($zrizeni1);

			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);

			$vys3 = MySQL_Query("SELECT nazev FROM planety");
			$bla = $zaznam2["planeta"]*$bstav*$politika[cenap]/100*$zriz[planeta]/100*(1+$zaznam1[planety]/10);

}
					
		if(isset($optl) and $_POST['over_post']==1):
			$vys3 = MySQL_Query("SELECT * FROM planety where cislo = $optl");
			$zaznam3 = MySQL_Fetch_Array($vys3);

			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa1 = $zaznam1["rasa"] ;

			$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika = MySQL_Fetch_Array($politika1);

			$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
			$narod = MySQL_Fetch_Array($narod1);

			$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
			$zriz = MySQL_Fetch_Array($zrizeni1);

			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);
			if($zaznam3[status]!=2):
				if($zaznam3["cislomaj"]==$logcislo):
					$c=$zaznam3[cas]+43200;
					if(Date("U")>$c):
						$bla = $zaznam2["planeta"]*$politika[cenap]/100*$zriz[planeta]/100;
						$bla*=(1+$zaznam1[planety]/10);
						$n=$zaznam1["penize"]+($bla*0.5);
						$pod=0.25;
						$n+=$zaznam3[vyrobna]*($zaznam2[vyr_cena]*$politika[cenas]/100)*$pod;
						$n+=$zaznam3[kasarna]*$zaznam2[kas_cena]*$pod;
						$n+=$zaznam3[mesta]*($zaznam2[mes_cena]*$politika[cenas]/100)*$pod;	
						$n+=$zaznam3[par]*($zaznam2[park_cena]*$politika[cenas]/100)*$pod;
						$n+=$zaznam3[pol]*($zaznam2[pol_cena]*$politika[cenas]/100)*$pod;
            $p=$zaznam1["planety"]-1;
						MySQL_Query("DELETE FROM planety WHERE cislo = $optl");
						MySQL_Query("update uzivatele set penize = $n where cislo=$logcislo");
						MySQL_Query("update uzivatele set planety = $p where cislo=$logcislo");
					else:
						$kdy=Date("H:i:s j.m.Y",$c);
						echo "<font class='text_cerveny'>Planetu ".$zaznam3[nazev]." nemùžeme opustit kvùli jejímu nedávnému obsazení. Panuje na ní zmatek a my nejsme schopni se teï evakuovat. Toho budeme schopni nejdøíve v ".$kdy."</font>";
					endif;
				else:
					echo "<font class='text_cerveny'>Tato planety není Vaše</font>";
				endif;
			else:
				echo "<font class='text_cerveny'>Centrální planetu nelze opustit.</font>";				
			endif;
		endif;
				
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		$rasa1 = $zaznam1["rasa"] ;

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
		$politika = MySQL_Fetch_Array($politika1);

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=9 and mrtev!=1)");
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ=9");
		$typhs = MySQL_Fetch_Array($typhs2);

		$bstav=1-($stav[level]*$typhs[ucinek]);

		if($stav[cislomaj]!=$logcislo){$bstav=1;};
		//echo "<font class =text_bili>".$bstav;
		$cislos=$stav[cislo];

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
		$zriz = MySQL_Fetch_Array($zrizeni1);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = $logcislo ORDER BY nazev ASC");	
		
?>

<center>

<?


	$vysc = MySQL_Query("SELECT nazev,cislo,cislomaj FROM planety where cislomaj = $logcislo and status != '2' order by nazev");
	
	echo "<form name='form' method='post' action='hlavni.php?page=planety3'>";
		echo "<TABLE border='1'>";
		echo "<tr>";
	echo "<th><font class=text_bili>Z které planety</th>";

	echo "<th><font class=text_bili>Na planetu</th>";

	echo "<th><font class=text_bili>Kolik lidí pøesunout <input type=text name='lidi'></th>";

        echo "</tr>";

        echo "<tr>";

	echo "<th><select name='odkudt'>";
		$i=0;
		while ($zaznamc = MySQL_Fetch_Array($vysc)):
			echo "<option value=".$zaznamc[cislo].">".$zaznamc["nazev"];
			$planety[$i]=$zaznamc["nazev"];
			$planetyc[$i]=$zaznamc["cislo"];
			$i++;
		endwhile;
    	echo "</select></th>";

	echo "<th><select name='kamt'>";
		$j=0;
		while ($j<$i):
			echo "<option value=".$planetyc[$j].">".$planety[$j];
			$j++;
		endwhile;
    	echo "</select></th>";
	
	echo "<th><input type=submit value='Pøesunout'></th>";

	echo "</tr></form>";
        echo "</table>";



//prejmenovani planety


	$prejm = MySQL_Query("SELECT nazev,cislo FROM planety where cislomaj = $logcislo  and status != '2' order by nazev");
	
	echo "<br><br><form name='form' method='post' action='hlavni.php?page=planety3'>";
		echo "<TABLE border='1'>";
		echo "<tr>";
	echo "<th><font class=text_bili>Pøejmenovat planetu</th>";

	echo "<th><font class=text_bili>Na</th>";

	echo "<th><font class=text_bili>Provést</th>";

        echo "</tr>";

        echo "<tr>";

	echo "<th><select name='prejmn'>";
		$i=0;
		while ($prejmc = MySQL_Fetch_Array($prejm)):
			echo "<option value=".$prejmc[cislo].">".$prejmc["nazev"];
			$i++;
		endwhile;
    	echo "</select></th>";

	echo "<th><input type='text' name='prejmnn' value='Zadejte nový název'></th>";
	
	echo "<th><input type=submit value='Pøejmenovat' name='prejmenovat'></th>";

	echo "</tr></form>";
        echo "</table>";

//prejmenovani planety konec


?>

<br><br>

<?

		echo "<TABLE border='1'>";
		echo "<tr>";
		echo "<th>&nbsp;</th>";
		echo "<th><font class=text_modry>Název</font></th>";
		echo "<th><font class=text_modry>mìst / výroben / kasáren / obran / parkù / laboratoøí/ hv. brána / sídel obrany</font></th>";

		echo "<th><font class=text_modry>Zastavìné/volné</font></th>";
		echo "<th><font class=text_modry>Spokojenost</font></th>";

		echo "<th><font class=text_modry>Obyvatelé: celkem/nezam.</font></th>";
		echo "</tr>";
		while ($zaznam3 = MySQL_Fetch_Array($vys3)):
			if($zaznam3["brana"]==1):
				$brany="ano";
				$plus=20;
			else:
				$brany="ne";
			endif;
			$w=$zaznam3["lidi"]-$zaznam3["vyrobna"]*$zaznam2["vyr_lidi"];
			$w-=$zaznam3["sdi"]*$zaznam2["sdi_lidi"];
			$w-=$zaznam3["laborator"]*$zaznam2["lab_lidi"];
			$zastav=$zaznam3["kasarna"]+$zaznam3["vyrobna"]+$zaznam3["sdi"];
			$zastav+=$zaznam3["par"]+$zaznam3["laborator"]+$zaznam3["pol"];
			$vol=$zaznam3["mesta"]*$zaznam2[mest]-$zastav;
			$spok=$zaznam3["spokojenost"];
			$dom="";
			if($zaznam3[status]==0){$dom="<i>(".$zaznam3["typ"].")</i>";};
			if($zaznam3[status]==1){$dom="<i>(domovská)</i>";};
			if($zaznam3[status]==2){$dom="<i>(centrální)</i>";};
			echo "<tr>";
			echo "<form name='form' method='post' action='hlavni.php?page=planety3' >";
			if($zaznam3[status]!=1 and $zaznam3[status]!=2) {echo "<td>
				<input type='hidden' name='over_post' value=1>
		  		<input type='submit' value='opustit'>
				<input type='hidden' name='optl' value=".$zaznam3[cislo].">
			      </td>";}
		               else {echo "<td>&nbsp;</td>";};
			echo "<td><center><font class=text_cerveny>".$zaznam3["nazev"]."</font> <br> <font class=text_bili>".$dom."</font></center></td>";
			echo "<td><center><font class=text_bili>".fcis($zaznam3["mesta"])." / ".fcis($zaznam3["vyrobna"])." / ".fcis($zaznam3["kasarna"])." / ".fcis($zaznam3["sdi"])." / ".fcis($zaznam3["par"])." / ".fcis($zaznam3["laborator"])." / ".$brany." / ".$zaznam3["pol"]."</font></center></td>";

			echo "<td><center><font class=text_bili>".fcis($zastav)."/".fcis($vol)."</font></center></td>";
			echo "<td><center><font class=text_bili>".($spok)."%</font></center></td>";

			echo "<td><center><font class=text_bili>".number_format($zaznam3["lidi"]/1000000,0,0," ")."/".number_format($w/1000000,0,0," ")."</font></center></td>";
			echo "</form></tr>";
		endwhile;
		echo "</table>";



MySQL_Close($spojeni);		
?>
