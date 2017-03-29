<?php

	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	require("adkontrola.php");

    $result = mysql_query("SELECT `rasa`, `nazevrasy` FROM `rasy`", $spojeni);
		while($row=mysql_fetch_array($result)){
        $nazev_rasy[$row["rasa"]] = $row["nazevrasy"];
    }

?>

<h1>Výzkum</h1>
<?php

if(isset($_POST)) {
    if(isset($_GET["nuluj"])) {
        $sql = "UPDATE `vyzkum` SET `kolik` = '0' WHERE `rasa` = {$_POST["rasa"]} LIMIT 1";
        $vysledek = mysql_query($sql, $spojeni);
        if($vysledek) {
            echo "Rase {$nazev_rasy[$_POST["rasa"]]} byl vynulován výzkum";
        }
    }
    else { 
        $sql = "UPDATE `vyzkum` SET `kolik` = '0', `max` = '{$_POST["cena"]}', `nazevvyz` = '{$_POST["nazev"]}' WHERE `rasa` = {$_POST["rasa"]} LIMIT 1";
        $vysledek = mysql_query($sql, $spojeni);
        if($vysledek) {
            echo "Rase {$nazev_rasy[$_POST["rasa"]]} byl změněn výzkum";
        }   
    }
}

?>

<table class="table" cellpadding=0 cellspacing=0>
  <tr class="vrsek">
    <td>Rasa</td>
    <td>Název výzkumu</td>
    <td>Cena výzkumu</td>
    <td colspan=2>&nbsp;</td>
  </tr>
<?php
    
    $result = mysql_query("SELECT * FROM `vyzkum`", $spojeni);
    while($row=mysql_fetch_array($result)){
      if(strlen($nazev_rasy[$row["rasa"]])>0){
        echo '
  <tr class="spodek">
      <form action="hlavni.php?page=admin-vyzkum" method="post">
      <input type="hidden" name="rasa" value="'.$row["rasa"].'">
    <th>'.$nazev_rasy[$row["rasa"]].'</th>
    <td><input type="text" name="nazev" value="'.stripslashes($row["nazevvyz"]).'"></td>
    <td><input type="text" name="cena" value="'.stripslashes($row["max"]).'"></td>
    <td><input type="submit" value="Změn"></td>
    <td><input type="submit" value="Vynulovat" onclick="this.form.action = \'hlavni.php?page=admin-vyzkum&amp;nuluj=1\'"></form></td>
  </tr>';
      }
    }


?> 
</table>
