<?mysql_query("SET NAMES cp1250");
  $vys1=MySQL_Query("SELECT * FROM rasy where (rasa>0 and rasa<12) order by rasa");
  $udaju=mysql_num_rows($vys1);
  
  function vrsek(){
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">N�zev</th>'."\r\n";
    echo '    <th class="a3">Obr�zek</th>'."\r\n";
    echo '    <th class="a4">�tok/Obrana</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">M�st v kas�rn�ch</th>'."\r\n";
    echo '  </tr>'."\r\n";
  }
  
  function table($stat){
    echo '<table align="center" class="table" id="'.$stat.'" cellpadding=0 cellspacing=0>'."\r\n";
  }
  
  function konec(){ echo "</table><div class='nahoru'><a href='#top'>nahoru</a></div>\r\n"; }
  
?>
<font class="text_bili"><h1>Statistiky jednotek a budov jednotliv�ch ras</h1></font>

<h3>
  <a href="#pechota">P�chota</a> -
  <a href="#ujednotka">Univerz�ln� jednotka</a> -
  <a href="#zhniceni">Zbran� hromadn�ho ni�en�</a> -
  <a href="#ojednotka">Orbit�ln� jednotka</a><br>
  <a href="#stavby">Stavby:</a>
    <a href="#vyroba">V�roba</a> -
    <a href="#kasarna">Kas�rna</a> -
    <a href="#obrana">Obrana</a> -
    <a href="#zabava">Z�bava</a> -
    <a href="#laborator">Laborato�</a>

</h3>

<font class="text_bili"><h3><a name=pechota></a>P�chota</h3></font>
<?
table("stat");
vrsek();
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "jed1_nazev")."</td>\r\n";
	echo "   <td><img src='obr/j".mysql_result($vys1, $cislo, "rasa")."1.jpg'";
  echo " alt='"./*mysql_result($vys1, $cislo, "jed1").*/"' width = 75></td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed1_utok")." / ";
  echo mysql_result($vys1, $cislo, "jed1_obrana")."</td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed1_cena")."</td>\r\n"; 
	echo "   <td>".mysql_result($vys1, $cislo, "jed1_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();

echo "<font class=text_bili><h3><a name=ujednotka></a>Univerz�ln� jednotka</h3></font>\r\n";
table("stat");
vrsek();
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "jed2_nazev")."</td>\r\n";
	echo "   <td><img src='obr/j".mysql_result($vys1, $cislo, "rasa")."2.jpg'";
  echo " alt='"./*mysql_result($vys1, $cislo, "jed1").*/  "' width = 75></td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed2_utok")." / ";
  echo mysql_result($vys1, $cislo, "jed2_obrana")."</td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed2_cena")."</td>\r\n"; 
	echo "   <td>".mysql_result($vys1, $cislo, "jed2_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();

echo "<font class=text_bili><h3><a name=zhniceni></a>Zbran� hromadn�ho ni�en�</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">N�zev</th>'."\r\n";
    echo '    <th class="a3">Obr�zek</th>'."\r\n";
    echo '    <th class="a4">��inek</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">M�st v kas�rn�ch</th>'."\r\n";
    echo '  </tr>'."\r\n";
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "jed3_nazev")."</td>\r\n";
	echo "   <td><img src='obr/j".mysql_result($vys1, $cislo, "rasa")."3.jpg' width = 75></td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed3_ucinek")."</td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed3_cena")."</td>\r\n"; 
	echo "   <td>".mysql_result($vys1, $cislo, "jed3_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();


echo "<font class=text_bili><h3><a name=ojednotka></a>Orbit�ln� jednotka</h3></font>\r\n";
table("stat");
vrsek();
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "jed4_nazev")."</td>\r\n";
	echo "   <td><img src='obr/j".mysql_result($vys1, $cislo, "rasa")."4.jpg' width = 75></td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed4_utok")." / ";
  echo mysql_result($vys1, $cislo, "jed4_obrana")."</td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed4_cena")."</td>\r\n"; 
	echo "   <td>".mysql_result($vys1, $cislo, "jed4_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();

/*
echo "<h3>P�chota</h3>\r\n";
table("stat");
vrsek();
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "jed7_nazev")."</td>\r\n";
	echo "   <td><img src='obr/j".mysql_result($vys1, $cislo, "rasa")."7.jpg'></td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed7_utok")." / ";
  echo mysql_result($vys1, $cislo, "jed7_obrana")."</td>\r\n";
	
  echo "   <td>".mysql_result($vys1, $cislo, "jed7_cena")."</td>\r\n"; 
	echo "   <td>".mysql_result($vys1, $cislo, "jed7_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();*/

echo "<font class=text_bili><h2><a name=stavby></a>Stavby</h2></font>\r\n";
echo "<font class=text_bili><h3><a name=vyroba></a>V�roba</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">N�zev</th>'."\r\n";
    echo '    <th class="a3">Obr�zek</th>'."\r\n";
    echo '    <th class="a4">Produkce</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">M�st pro lidi</th>'."\r\n";
    echo '  </tr>'."\r\n";
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "vyr_nazev")."</td>\r\n";
	echo "   <td><img src='obr/b".mysql_result($vys1, $cislo, "rasa")."2.jpg' width = 75></td>\r\n";
  echo "   <td>".mysql_result($vys1, $cislo, "vyr_vyrob")."</td>\r\n";

  echo "   <td>".mysql_result($vys1, $cislo, "vyr_cena")."</td>\r\n"; 
	echo "   <td>".mysql_result($vys1, $cislo, "vyr_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();


echo "<font class=text_bili><h3><a name=kasarna></a>Kas�rna</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">Cena</th>'."\r\n";
    echo '    <th class="a3">Obr�zek</th>'."\r\n";
    echo '    <th class="a6">M�st pro lidi</th>'."\r\n";
    echo '  </tr>'."\r\n";
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "kas_cena")."</td>\r\n";
	echo "   <td><img src='obr/b".mysql_result($vys1, $cislo, "rasa")."4.jpg' width = 75></td>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "kas_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();

echo "<font class=text_bili><h3><a name=obrana></a>Obrana</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">N�zev</th>'."\r\n";
    echo '    <th class="a3">Obr�zek</th>'."\r\n";
    echo '    <th class="a4">Zni�� ZHN</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">M�st pro lidi</th>'."\r\n";
    echo '  </tr>'."\r\n";
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "sdi_nazev")."</td>\r\n";
	echo "   <td><img src='obr/b".mysql_result($vys1, $cislo, "rasa")."3.jpg' width = 75></td>\r\n";
  echo "   <td>".mysql_result($vys1, $cislo, "sdi_ucinek")."</td>\r\n";
  echo "   <td>".mysql_result($vys1, $cislo, "sdi_cena")."</td>\r\n"; 
	echo "   <td>".mysql_result($vys1, $cislo, "sdi_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();

echo "<font class=text_bili><h3><a name=zabava></a>Z�bava</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">N�zev</th>'."\r\n";
    echo '    <th class="a3">Obr�zek</th>'."\r\n";
    echo '    <th class="a4">Nav��en� spok.</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '  </tr>'."\r\n";
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td>".mysql_result($vys1, $cislo, "park_nazev")."</td>\r\n";
	echo "   <td><img src='obr/b".mysql_result($vys1, $cislo, "rasa")."6.jpg' width = 75></td>\r\n";
  echo "   <td>".mysql_result($vys1, $cislo, "park_proc")."</td>\r\n";
  echo "   <td>".mysql_result($vys1, $cislo, "park_cena")."</td>\r\n"; 
  echo "  </tr>\r\n";
}
konec();

echo "<font class=text_bili><h3><a name=laborator></a>Laborato�</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a3">Obr�zek</th>'."\r\n";
    echo '    <th class="a4">P�id�n� do v�zkumu</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">M�st pro lidi</th>'."\r\n";
    echo '  </tr>'."\r\n";
for($cislo=0;$cislo<$udaju; $cislo++){
  echo "  <tr class='spodek'>\r\n";
	echo "   <th>".mysql_result($vys1, $cislo, "nazevrasy")."</th>\r\n";
	echo "   <td><img src='obr/b".mysql_result($vys1, $cislo, "rasa")."5.jpg' width = 75></td>\r\n";
  echo "   <td>".mysql_result($vys1, $cislo, "lab_vyz")."</td>\r\n";
  echo "   <td>".mysql_result($vys1, $cislo, "lab_cena")."</td>\r\n"; 
	echo "   <td>".mysql_result($vys1, $cislo, "lab_lidi")."</td>\r\n";
  echo "  </tr>\r\n";
}
konec();

?>
