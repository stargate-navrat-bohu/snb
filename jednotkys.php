

<?
mysql_query("SET NAMES cp1250");
		
require "data_1.php";

?>

<center>

<font class=text_bili><font class=text_modry>S</font>tatistiky jednotek</font>
<br><br>

<a href='hlavni.php?page=jednotkys&vybe=1' >P�chota</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=jednotkys&vybe=2' >Univerz�lov�</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=jednotkys&vybe=3' >ZHN</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=jednotkys&vybe=4' >Orbity</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=jednotkys&vybe=5' >N�jemn� vrazy</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=jednotkys&vybe=6' >Agit�to�i</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=jednotkys&vybe=7' >Sondy</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=jednotkys&vybe=8' >Zlod�ji</a>

<br><br>


<?

		if($zaznam1[status]==4):
			$a=1.5;
		else:
			$a=1;
		endif;


	if(empty($vybe)){$vybe=1;};


//*******************************************************P�chota******************************
	if($vybe==1):


		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);


		
		echo "<center><b><font class=text_bili><font class=text_modry>P</font>�chota</font></b><br><br>";

	
                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>P��k</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/j".$zaznam1[rasa]."1.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";

			echo "<th>�tok</th>";
			echo "<th>Obrana</th>";
			echo "<th>M�st v kas�rn�ch</th>";
			echo "<th>Cena</th>";

			echo "</tr>";


			echo "<td><center>".$zaznam2[jed1_utok]."</td>";
			echo "<td><center>".$zaznam2[jed1_obrana]."</td>";
			echo "<td><center>".$zaznam2[jed1_lidi]."</td>";
                        echo "<td><center>".$zaznam2[jed1_cena]."</td>";
			echo "</tr>";
			echo "</table>";


//****************************************************Univerz�lov�************************************	
	elseif($vybe==2):


		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>U</font>niverz�lov�</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Univers�l</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/j".$zaznam1[rasa]."2.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>�tok</th>";
			echo "<th>Obrana</th>";
			echo "<th>M�st v kas�rn�ch</th>";
			echo "<th>Cena</th>";
			echo "</tr>";



			echo "<td><center>".$zaznam2[jed2_utok]."</td>";
			echo "<td><center>".$zaznam2[jed2_obrana]."</td>";
			echo "<td><center>".$zaznam2[jed2_lidi]."</td>";
                        echo "<td><center>".$zaznam2[jed2_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************ZHN************************************	
	elseif($vybe==3):



		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>Z</font>HN</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>ZHN</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/j".$zaznam1[rasa]."3.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th colspan=2>��inek</th>";
			echo "<th>M�st v kas�rn�ch</th>";
			echo "<th>Cena</th>";
			echo "</tr>";



			echo "<td colspan=2><center>".$zaznam2[jed3_ucinek]."</td>";
			echo "<td><center>".$zaznam2[jed3_lidi]."</td>";
                        echo "<td><center>".$zaznam2[jed3_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Orbity************************************	
	elseif($vybe==4):



		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>O</font>rbity</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Orbit</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/j".$zaznam1[rasa]."4.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th>�tok</th>";
			echo "<th>Obrana</th>";
			echo "<th>M�st v kas�rn�ch</th>";
			echo "<th>Cena</th>";
			echo "</tr>";



			echo "<td><center>".$zaznam2[jed4_utok]."</td>";
			echo "<td><center>".$zaznam2[jed4_obrana]."</td>";
			echo "<td><center>".$zaznam2[jed4_lidi]."</td>";
                        echo "<td><center>".$zaznam2[jed4_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************N�jemn� vrazy************************************	
	elseif($vybe==5):


		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);


		
		echo "<center><b><font class=text_bili><font class=text_modry>N</font>�jemn� vrazy</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>N�jemn� vrah</th>";
				echo "<th colspan=5>Speci�ln� jednotka</th>";

			echo "</tr>";
			echo "</table>";

//****************************************************Agit�to�i************************************	
	elseif($vybe==6):



		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>A</font>git�to�i</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Agit�tor</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/j".$zaznam1[rasa]."6.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th colspan=2>��inek</th>";
			echo "<th>M�st v kas�rn�ch</th>";
			echo "<th>Cena</th>";
			echo "</tr>";



			echo "<td colspan=2><center>".$zaznam2[jed6_ucinek]."</td>";
			echo "<td><center>".$zaznam2[jed6_lidi]."</td>";
                        echo "<td><center>".$zaznam2[jed6_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Sondy************************************	
	elseif($vybe==7):



		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);
	
		
		echo "<center><b><font class=text_bili><font class=text_modry>S</font>ondy</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Sonda</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/j".$zaznam1[rasa]."8.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th colspan=2>��inek</th>";
			echo "<th>M�st v kas�rn�ch</th>";
			echo "<th>Cena</th>";
			echo "</tr>";



			echo "<td colspan=2><center>".$zaznam2[jed7_ucinek]."</td>";
			echo "<td><center>".$zaznam2[jed7_lidi]."</td>";
                        echo "<td><center>".$zaznam2[jed7_cena]."</td>";
			echo "</tr>";
			echo "</table>";

//****************************************************Zlod�ji************************************	
	elseif($vybe==8):



		$rasa1 = $zaznam1["rasa"];

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);
		
		echo "<center><b><font class=text_bili><font class=text_modry>Z</font>lod�ji</font></b><br><br>";



                        echo "<TABLE border='1' width='500'>";
			echo "<tr>";
				echo "<th colspan=5>Zlod�j</th>";
				echo "</tr>";

				echo "<th colspan=5><img src='obr/j".$zaznam1[rasa]."7.JPG' height='83' width='111' border='0'></th>";
				echo "</tr>";

				echo "<tr>";
			echo "<th colspan=2>��inek</th>";
			echo "<th>M�st v kas�rn�ch</th>";
			echo "<th>Cena</th>";
			echo "</tr>";



			echo "<td colspan=2><center>".$zaznam2[jed8_ucinek]."</td>";
			echo "<td><center>".$zaznam2[jed8_lidi]."</td>";
                        echo "<td><center>".$zaznam2[jed8_cena]."</td>";
			echo "</tr>";
			echo "</table>";

	endif;

?>


