<?php
mysql_query("SET NAMES cp1250");
	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	require("adkontrola.php");

    $result = mysql_query("SELECT `rasa`, `nazevrasy` FROM `rasy`", $spojeni);
		while($row=mysql_fetch_array($result)){
        $nazev_rasy[$row["rasa"]] = $row["nazevrasy"];
    }

?>

<h1>V�zkum</h1>
<?php

if(isset($_POST)) {
    if(isset($_GET["nuluj"])) {
        $sql = "UPDATE `vyzkum` SET `kolik` = '0' WHERE `rasa` = {$_POST["rasa"]} LIMIT 1";
        $vysledek = mysql_query($sql, $spojeni);
        if($vysledek) {
            echo "Rase {$nazev_rasy[$_POST["rasa"]]} byl vynulov�n v�zkum";
        }
    }
    else { 
        $sql = "UPDATE `vyzkum` SET `kolik` = '0', `max` = '{$_POST["cena"]}', `nazevvyz` = '{$_POST["nazev"]}' WHERE `rasa` = {$_POST["rasa"]} LIMIT 1";
        $vysledek = mysql_query($sql, $spojeni);
        if($vysledek) {
            echo "Rase {$nazev_rasy[$_POST["rasa"]]} byl zm�n�n v�zkum";
        }   
    }
}

?>

<table class="table" cellpadding=0 cellspacing=0>
  <tr class="vrsek">
    <td>Rasa</td>
    <td>N�zev v�zkumu</td>
    <td>Cena v�zkumu</td>
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
    <td><input type="submit" value="Zm�n"></td>
    <td><input type="submit" value="Vynulovat" onclick="this.form.action = \'hlavni.php?page=admin-vyzkum&nuluj=1\'"></form></td>
  </tr>';
      }
    }


?> 
</table>
