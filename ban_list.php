<?php
mysql_query("SET NAMES cp1250");


$sql = mysql_query("SELECT jmeno, admin, statusmoderator FROM uzivatele WHERE jmeno = '$logjmeno'") or die("Špatny dotaz");
$zaz = mysql_fetch_array($sql);

if($zaz["admin"]!=0 OR $zaz["statusmoderator"]==1){

if(isset($_POST["udel_ban"])) {
$cas = MKTime();
$kde = $_POST["kde"];
$jmeno = $_POST["ban_komu"];
$kdo = $logjmeno;
$duvod = $_POST["duvod"];
$konec = ($_POST["konec"]*60)+$cas;

mysql_query("INSERT INTO `banfor` ( `cas` , `jmeno` , `kdo` , `duvod` , `konec` ) VALUES ('$cas', '$jmeno', '$kdo', '$duvod', '$konec')") or die("Nepodaøilo se udìlit ban");
$akce = $_POST["akce"];
  if($akce == "1"){
    echo "<script language='JavaScript'>";
    echo "location.href='hlavni.php?page=ban_list';";
    echo "</script>";
  } elseif($akce == "2"){
    echo "<script language='JavaScript'>";
    echo "location.href='hlavni.php?page=forum&kde=".$kde."';";
    echo "</script>";
  } else {
    echo "<script language='JavaScript'>";
    echo "location.href='hlavni.php?page=info';";
    echo "</script>";  
  }
}

if(isset($_POST["ban"])) {
  $ban_komu = $_POST["ban"];
  $kde = $_POST["kde"];
  
  echo "<form method=\"post\" action=\"hlavni.php?page=ban_list\">";
    echo "<table>";
      echo "<tr>";
        echo "<th>Jméno</th>";
        echo "<th>Dùvod</th>";
        echo "<th>Trvání</th>";
        echo "<th>Akce</th>";
        echo "<th>Potvrzení</th>";
      echo "</tr>";
      echo "<tr>";
        echo "<td><input type='text' name='ban_komu' value='".$ban_komu."' size='12'</td>";
        echo "<td><input type='text' name='duvod' size='40'></td>";
        echo "<td><input type='text' name='konec' size='12'></td>";
        echo "<td>";
          echo "<select name='akce'>";
            echo "<option value='1'";
              if($kde==""){ echo "selected"; }
              echo ">Zpen k ban list</option>";
            echo "<option value='2'";
              if($kde!=""){ echo "selected"; }
              echo ">Zpet na forum</option>";
          echo "</select>";
        echo "</td>";
        echo "<td>";
          echo "<input type='hidden' name='udel_ban' value='1'>";
          echo "<input type='hidden' name='kde' value='$kde'>";
          echo "<input type='submit' value='Udìl ban'>";
        echo "</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>Na jak dlouho v minutach</td>";
        echo "<td>Kam pak?</td>";
        echo "<td>&nbsp;</td>";
      echo "</tr>";
    echo "</table>";
  echo "</form>";
}

if(isset($_GET["smaz"]) AND $_GET["smaz"]!=""){
  $cas = $_GET["smaz"];
  $mazu = mysql_query("DELETE FROM banfor WHERE cas = $cas") or die("Nepodaøilo se smazat záznam");
  if($mazu == true){
    echo "Záznam byl úspìšnì smazán<br />";
  }
}

if(isset($_POST["uprav_ban"])){
$cas = MKTime();
$kde = $_POST["kde"];
$jmeno = $_POST["ban_komu"];
$kdo = $logjmeno;
$duvod = $_POST["duvod"];
if($_POST["konec"]!= ""){
  $konec = $_POST["konec"]+$cas;
} else {
$konec = $_POST["konec_old"];
}
echo $cas." ".$kdo." ".$duvod." ".$konec." ".$jmeno."<br />";
mysql_query("UPDATE banfor SET cas='$cas', kdo='$kdo', duvod='$duvod ', konec='$konec' WHERE jmeno='$jmeno'");
$akce = $_POST["akce"];
  if($akce == "1"){
    echo "<script language='JavaScript'>";
    echo "location.href='hlavni.php?page=ban_list';";
    echo "</script>";
  } elseif($akce == "2"){
    echo "<script language='JavaScript'>";
    echo "location.href='hlavni.php?page=forum&kde=".$kde."';";
    echo "</script>";
  } else {
    echo "<script language='JavaScript'>";
    echo "location.href='hlavni.php?page=info';";
    echo "</script>";  
  }

}

if(isset($_GET["uprav"]) AND $_GET["uprav"]!=""){
  $cas = $_GET["uprav"];
  $sql2 = mysql_query("SELECT * FROM banfor WHERE cas = $cas") or die("Nepodaøilo se najít pøíslušný záznam");
  $zaznam2 = mysql_fetch_array($sql2);
  $ban_komu = $zaznam2["jmeno"];
  $duvod = $zaznam2["duvod"];
  $konec = $zaznam2["konec"];
  echo "<form method=\"post\" action=\"hlavni.php?page=ban_list\">";
    echo "<table>";
      echo "<tr>";
        echo "<th>Jméno</th>";
        echo "<th>Dùvod</th>";
        echo "<th>Trvání</th>";
        echo "<th>Akce</th>";
        echo "<th>Potvrzení</th>";
      echo "</tr>";
      echo "<tr>";
        echo "<td><input type='text' name='ban_komu' value='".$ban_komu."' size='12'</td>";
        echo "<td><input type='text' name='duvod' value='".$duvod."' size='40'></td>";
        echo "<td><input type='text' name='konec' size='12'>".Date("G:i:s j.m.Y",$konec)."</td>";
        echo "<td>";
          echo "<select name='akce'>";
            echo "<option value='1'";
              if($kde==""){ echo "selected"; }
              echo ">Zpen k ban list</option>";
            echo "<option value='2'";
              if($kde!=""){ echo "selected"; }
              echo ">Zpet na forum</option>";
          echo "</select>";
        echo "</td>";
        echo "<td>";
          echo "<input type='hidden' name='konec_old' value='$konec'>";
          echo "<input type='hidden' name='uprav_ban' value='1'>";
          echo "<input type='hidden' name='kde' value='$kde'>";
          echo "<input type='submit' value='Uprav ban'>";
        echo "</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>Na jak dlouho v s</td>";
        echo "<td>Kam pak?</td>";
        echo "<td>&nbsp;</td>";
      echo "</tr>";
    echo "</table>";
  echo "</form>";

}



  $vysledek_celk = mysql_query("SELECT jmeno FROM banfor WHERE 1=1");

  $pocet_li = "25";  
  if (!isset($_GET["list"])) {
    $list = 1;
    $zaznam_li = 0;
  } else {
    $list = $_GET["list"];
    $newlist = $list - 1;
    $zaznam_li = $pocet_li * $newlist;
  }

$sql1 = mysql_query("SELECT * FROM banfor WHERE 1=1 LIMIT $zaznam_li, $pocet_li");
echo "<table border='1' cellspacing='0' cellpadding='0'>";
  echo "<tr>";
    echo "<th>Jméno</th>";
    echo "<th>IP</th>";
    echo "<th>Dùvod</th>";
    echo "<th>Konce</th>";
    echo "<th>Udìlil</th>";
    echo "<th>Uprav</th>";
    echo "<th>Smaž</th>";
  echo "</tr>";
  while($zaznam1 = mysql_fetch_array($sql1)){
    echo "<tr>"; 
      echo "<td width='100px'>".$zaznam1["jmeno"]."</td>";
      echo "<td width='75px'>".$zaznam1["ip"]."&nbsp;</td>"; 
      echo "<td width='250px'>".$zaznam1["duvod"]."</td>";
      echo "<td width='75px'>". Date("G:i:s j.m.Y",$zaznam1["konec"])."</td>";
      echo "<td width='100px'>".$zaznam1["kdo"]."</td>";
      echo "<td><a href='hlavni.php?page=ban_list&uprav=".$zaznam1["cas"]."&kde=$kde'>Uprav</a></td>";
      echo "<td><a href='hlavni.php?page=ban_list&smaz=".$zaznam1["cas"]."&kde=$kde'>Smaž</a></td>";
    echo "</td>";
  }
echo "</table>";
echo "<font color='white'>";
  include('listovani.php');
echo "</font>";

echo "<form method='post' action='hlavni.php?page=ban_list'>";
  echo "<input type='hidden' name='ban' value='Zadej jméno'>";
  echo "<input type='submit' value='Pøidat ban'>";
echo "</form>";

}
?>
