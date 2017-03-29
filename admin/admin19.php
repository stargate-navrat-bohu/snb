<?php
mysql_query("SET NAMES cp1250");

	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	require("adkontrola.php");

$dotaz = $_SERVER["QUERY_STRING"];


if(isset($_POST["poslal"])){
  $sql = "INSERT INTO `programovani` ( `id` , `jmeno` , `text` , `sekce` , `datum` ) VALUES ('', '{$zaznam1["jmeno"]}', '$text', '$sekce', NOW( ));";
  mysql_query($sql, $spojeni);
}

if(isset($del)){
  $sql = "DELETE FROM `programovani` WHERE `id` = '$del' LIMIT 1;";
  mysql_query($sql, $spojeni);
}

echo '
<table style="width: 100%">
<tr>
  <td>';

$slozka = dir("./");
while($soubor=$slozka->read()) {
  if(is_file($soubor)==true){
    $koncovka = strtolower(substr($soubor, strlen($soubor)-3));
    if($koncovka=="php"){
      echo '<a href="hlavni.php?page=admin19&sekce='.$soubor.'">'.$soubor.'</a><br>'."\r\n";
    }
  }
}

echo '</td><td style="vertical-align: top">';

echo '
<form action="hlavni.php" method="get">
<input type="hidden" name="page" value="admin19">
Zobrazit soubor: <input type="text" name="sekce" value="" class="input">
<input type="submit" value="Ukaž ho" class="button">
</form>
';

if(isset($sekce)){
  if(file_exists($sekce)==true){
    echo '
    <form action="hlavni.php?'.$dotaz.'" method="post">
      <input type="hidden" name="poslal" value="1">
      Pøidání úpravy na souboru:<br /> 
      <textarea name="text" class="textarea" cols=50 rows=5></textarea><br />
      <input type="submit" value="Pøidat" class="button">
    </form>
    ';
  
    $sql = "SELECT *, DATE_FORMAT(`datum`, '%e.%c.%Y %H:%i') AS `datum2` FROM `programovani` WHERE `sekce` = '$sekce' ORDER BY `datum` DESC ;";
    $result = mysql_query($sql, $spojeni);
    if(@mysql_num_rows($result)>0){
      echo '<table style="width: 100%;">'."\r\n";
      while($row=mysql_fetch_array($result)){
        echo '<tr>
          <td style="padding: 2px;">
            '.$row["jmeno"].'
          </td>
          <td style="width: 100px">
            '.$row["datum2"].'
          </td>
          <td style="width: 50px">
            <a href="hlavni.php?page=admin19&sekce='.$sekce.'&del='.$row["id"].'">Smazat</a>
          </td>
        </tr>
        <tr>
          <td colspan=3 style="padding: 3px 3px 15px 3px; border-bottom: 1px solid gray;">
            '.nl2br($row["text"]).'
          </td>
        </tr>';
      }
      echo '</table>'."\r\n";
    }
  }else{
    echo "Soubor neexistuje";
  }
}

echo '</td>
</tr></table>';


?>
