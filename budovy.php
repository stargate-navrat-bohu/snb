

<?

		
require "data_1.php";
mysql_query("SET NAMES cp1250");
?>

<center>

<font class=text_bili><font class=text_modry>S</font>tatistiky budov</font>
<br><br>

<a href='hlavni.php?page=budovy&vybe=1' >Mìsta</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=2' >Výrobny</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=3' >Obrany</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=4' >Kasárny</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=5' >Laboratoøe</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=6' >Parky</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=7' >Hv.Brány</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=8' >Sídlo obrany</a>

<br><br>


<?

		if($zaznam1[status]==4):
			$a=1.5;
		else:
			$a=1;
		endif;


	if(empty($vybe)){$vybe=1;};


//*******************************************************Mìsta******************************
	if($vybe==1):


		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

	

		echo "<center><b><font class=text_bili><font class=text_modry>M</font>ìsta</font></b><br><br>";

                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Mìsto</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."1.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zamìstná lidí</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>0</td>";
			echo "<td><center>Umožní postavit ".$zaznam2[mest]." budov a umožní pøíbytek ".$zaznam2[mes_lidi]." lidí</td>";
                        echo "<td><center>".$zaznam2[mes_cena]."</td>";
			echo "</tr>";
			echo "</table>";


//****************************************************Výrobny************************************	
	elseif($vybe==2):


		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>V</font>ýrobny</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Výrobna</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."2.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zamìstná lidí</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>".$zaznam2[vyr_lidi]."</td>";
			echo "<td><center>Vydìlává ".$zaznam2[vyr_vyrob]."naq. dennì</td>";
                        echo "<td><center>".$zaznam2[vyr_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Obrany************************************	
	elseif($vybe==3):


		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>O</font>brany</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Obrana</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."3.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zamìstná lidí</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>".$zaznam2[sdi_lidi]."</td>";
			echo "<td><center>Ubrání planetu od ".$zaznam2[sdi_ucinek]." nepøátelských ZHN</td>";
                        echo "<td><center>".$zaznam2[sdi_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Kasárny************************************	
	elseif($vybe==4):


		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>K</font>asárny</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Kasárna</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."4.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zamìstná lidí</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>0</td>";
			echo "<td><center>Vytvoøí  ".$zaznam2[kas_lidi]." míst v kasárnách</td>";
                        echo "<td><center>".$zaznam2[kas_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Laboratoøe************************************	
	elseif($vybe==5):


		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>M</font>ìsta</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Laboratoø</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."5.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zamìstná lidí</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>".$zaznam2[lab_lidi]."</td>";
			echo "<td><center>Pøidává na výzkum ".$zaznam2[lab_vyz]."naq. dennì</td>";
                        echo "<td><center>".$zaznam2[lab_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Parky************************************	
	elseif($vybe==6):


		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>P</font>arky</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Park</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."6.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zamìstná lidí</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>0</td>";
			echo "<td><center>Zvýší spokojenost na planetì o ".$zaznam2[park_proc]."%</td>";
                        echo "<td><center>".$zaznam2[park_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Obrana proti zlodejum************************************	
	elseif($vybe==8):


		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>S</font>ídlo obrany</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Sídlo obrany</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."8.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zamìstná lidí</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>".$zaznam2[pol_lidi]."</td>";
			echo "<td><center>Odhalí ".$zaznam2[pol_ucinek]." zlodìjù pokoušejících se krást na vašich planetách</td>";
                        echo "<td><center>".$zaznam2[pol_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Hv.Brány************************************	
	elseif($vybe==7):


		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>H</font>v.Brány</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Hv.Brána</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."7.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zamìstná lidí</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>0</td>";
			echo "<td><center>Zvyšuje spokojenost, útok, obranu</td>";
                        echo "<td><center>".$zaznam2[bra_cena]."</td>";
			echo "</tr>";
			echo "</table>";

	endif;

?>


