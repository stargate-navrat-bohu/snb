

<?

		
require "data_1.php";
mysql_query("SET NAMES cp1250");
?>

<center>

<font class=text_bili><font class=text_modry>S</font>tatistiky budov</font>
<br><br>

<a href='hlavni.php?page=budovy&vybe=1' >M�sta</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=2' >V�robny</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=3' >Obrany</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=4' >Kas�rny</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=5' >Laborato�e</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=6' >Parky</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=7' >Hv.Br�ny</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=budovy&vybe=8' >S�dlo obrany</a>

<br><br>


<?

		if($zaznam1[status]==4):
			$a=1.5;
		else:
			$a=1;
		endif;


	if(empty($vybe)){$vybe=1;};


//*******************************************************M�sta******************************
	if($vybe==1):


		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

	

		echo "<center><b><font class=text_bili><font class=text_modry>M</font>�sta</font></b><br><br>";

                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>M�sto</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."1.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zam�stn� lid�</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>0</td>";
			echo "<td><center>Umo�n� postavit ".$zaznam2[mest]." budov a umo�n� p��bytek ".$zaznam2[mes_lidi]." lid�</td>";
                        echo "<td><center>".$zaznam2[mes_cena]."</td>";
			echo "</tr>";
			echo "</table>";


//****************************************************V�robny************************************	
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
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>V</font>�robny</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>V�robna</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."2.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zam�stn� lid�</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>".$zaznam2[vyr_lidi]."</td>";
			echo "<td><center>Vyd�l�v� ".$zaznam2[vyr_vyrob]."naq. denn�</td>";
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
			echo "<th>Zam�stn� lid�</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>".$zaznam2[sdi_lidi]."</td>";
			echo "<td><center>Ubr�n� planetu od ".$zaznam2[sdi_ucinek]." nep��telsk�ch ZHN</td>";
                        echo "<td><center>".$zaznam2[sdi_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Kas�rny************************************	
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
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>K</font>as�rny</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Kas�rna</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."4.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zam�stn� lid�</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>0</td>";
			echo "<td><center>Vytvo��  ".$zaznam2[kas_lidi]." m�st v kas�rn�ch</td>";
                        echo "<td><center>".$zaznam2[kas_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Laborato�e************************************	
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
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>M</font>�sta</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Laborato�</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."5.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zam�stn� lid�</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>".$zaznam2[lab_lidi]."</td>";
			echo "<td><center>P�id�v� na v�zkum ".$zaznam2[lab_vyz]."naq. denn�</td>";
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
			echo "<th>Zam�stn� lid�</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>0</td>";
			echo "<td><center>Zv��� spokojenost na planet� o ".$zaznam2[park_proc]."%</td>";
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
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>S</font>�dlo obrany</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>S�dlo obrany</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."8.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zam�stn� lid�</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>".$zaznam2[pol_lidi]."</td>";
			echo "<td><center>Odhal� ".$zaznam2[pol_ucinek]." zlod�j� pokou�ej�c�ch se kr�st na va�ich planet�ch</td>";
                        echo "<td><center>".$zaznam2[pol_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Hv.Br�ny************************************	
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
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>H</font>v.Br�ny</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Hv.Br�na</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/b".$zaznam1[rasa]."7.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>Zam�stn� lid�</th>";
			echo "<th>Funkce</th>";
			echo "<th>Cena</th>";
			echo "</tr>";


			echo "<td><center>0</td>";
			echo "<td><center>Zvy�uje spokojenost, �tok, obranu</td>";
                        echo "<td><center>".$zaznam2[bra_cena]."</td>";
			echo "</tr>";
			echo "</table>";

	endif;

?>


