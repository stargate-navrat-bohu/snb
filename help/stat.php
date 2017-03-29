<?mysql_query("SET NAMES cp1250");
  $vys1=MySQL_Query("SELECT * FROM rasy where (rasa>0 and rasa<12) order by rasa");
  $udaju=mysql_num_rows($vys1);
  
  function vrsek(){
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">Název</th>'."\r\n";
    echo '    <th class="a3">Obrázek</th>'."\r\n";
    echo '    <th class="a4">Útok/Obrana</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">Míst v kasárnách</th>'."\r\n";
    echo '  </tr>'."\r\n";
  }
  
  function table($stat){
    echo '<table align="center" class="table" id="'.$stat.'" cellpadding=0 cellspacing=0>'."\r\n";
  }
  
  function konec(){ echo "</table><div class='nahoru'><a href='#top'>nahoru</a></div>\r\n"; }
  
?>
<font class="text_bili"><h1>Statistiky jednotek a budov jednotlivých ras</h1></font>

<h3>
  <a href="#pechota">Pìchota</a> -
  <a href="#ujednotka">Univerzální jednotka</a> -
  <a href="#zhniceni">Zbranì hromadného nièení</a> -
  <a href="#ojednotka">Orbitální jednotka</a><br>
  <a href="#stavby">Stavby:</a>
    <a href="#vyroba">Výroba</a> -
    <a href="#kasarna">Kasárna</a> -
    <a href="#obrana">Obrana</a> -
    <a href="#zabava">Zábava</a> -
    <a href="#laborator">Laboratoø</a>

</h3>

<font class="text_bili"><h3><a name=pechota></a>Pìchota</h3></font>
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

echo "<font class=text_bili><h3><a name=ujednotka></a>Univerzální jednotka</h3></font>\r\n";
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

echo "<font class=text_bili><h3><a name=zhniceni></a>Zbranì hromadného nièení</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">Název</th>'."\r\n";
    echo '    <th class="a3">Obrázek</th>'."\r\n";
    echo '    <th class="a4">Úèinek</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">Míst v kasárnách</th>'."\r\n";
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


echo "<font class=text_bili><h3><a name=ojednotka></a>Orbitální jednotka</h3></font>\r\n";
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
echo "<h3>Pìchota</h3>\r\n";
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
echo "<font class=text_bili><h3><a name=vyroba></a>Výroba</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">Název</th>'."\r\n";
    echo '    <th class="a3">Obrázek</th>'."\r\n";
    echo '    <th class="a4">Produkce</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">Míst pro lidi</th>'."\r\n";
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


echo "<font class=text_bili><h3><a name=kasarna></a>Kasárna</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">Cena</th>'."\r\n";
    echo '    <th class="a3">Obrázek</th>'."\r\n";
    echo '    <th class="a6">Míst pro lidi</th>'."\r\n";
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
    echo '    <th class="a2">Název</th>'."\r\n";
    echo '    <th class="a3">Obrázek</th>'."\r\n";
    echo '    <th class="a4">Znièí ZHN</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">Míst pro lidi</th>'."\r\n";
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

echo "<font class=text_bili><h3><a name=zabava></a>Zábava</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a2">Název</th>'."\r\n";
    echo '    <th class="a3">Obrázek</th>'."\r\n";
    echo '    <th class="a4">Navýšení spok.</th>'."\r\n";
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

echo "<font class=text_bili><h3><a name=laborator></a>Laboratoø</h3></font>\r\n";
table("stat");
    echo '  <tr class="vrsek">'."\r\n";
    echo '    <th class="a1">Rasa</th>'."\r\n";
    echo '    <th class="a3">Obrázek</th>'."\r\n";
    echo '    <th class="a4">Pøidání do výzkumu</th>'."\r\n";
    echo '    <th class="a5">Cena</th>'."\r\n";
    echo '    <th class="a6">Míst pro lidi</th>'."\r\n";
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
