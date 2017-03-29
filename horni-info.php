<?
    $horni_info=1;
		require "data_1.php";
mysql_query("SET NAMES cp1250");
		$vys1 = MySQL_Query("SELECT rasa FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);

function vlada($jmeno, $col){
  if($jmeno!=null){
	  echo "<span class='text'><a href='hlavni.php?page=posta&vyber=1&komuposl=".$jmeno."'><font color=$col>$jmeno</a> </font></span><br>";
  }
}
        

//***********************  Online admin  *********************************

$bvys2 = MySQL_Query("SELECT jmeno FROM online");
$poc = mysql_num_rows($bvys2);

$cvys2 = MySQL_Query("SELECT jmeno FROM uzivatele where (admin='1' or admin='2' or admin='3' or admin='4') order by cislo desc");
$pocet_adminu = mysql_num_rows($cvys2);

if ($poc!=0){
  echo "<br><font class='text'>Online <a href='hlavni.php?page=admini'><font color='#01BAFF'>admini</font></a></font><br>";

  for($i=0;$i<$pocet_adminu;$i++){
    $jmeno_info1 = mysql_result($cvys2, $i, "jmeno");
    for($is=0;$is<$poc;$is++){
      $jmeno_info2 = mysql_result($bvys2, $is, "jmeno");
      if($jmeno_info1==$jmeno_info2){
        $col="#01BAFF";
	     echo "<span class='text'><a href='hlavni.php?page=posta&vyber=1&komuposl=".$jmeno_info1."'><font color=$col>$jmeno_info1</a> </font></span><br>";
      }
    }
  }
}

//***********************  Online ucitel  *********************************

$bvys2 = MySQL_Query("SELECT jmeno FROM online");
$poc = mysql_num_rows($bvys2);

$cvys2 = MySQL_Query("SELECT jmeno FROM uzivatele where (statusucitel='1') order by cislo desc");
$pocet_ucitelu = mysql_num_rows($cvys2);

if ($poc!=0){
  echo "<br><font class='text'>Online <font color='#2E8B57'>uèitelé</font></font></a></font><br>";

  for($i=0;$i<$pocet_ucitelu;$i++){
    $jmeno_info1 = mysql_result($cvys2, $i, "jmeno");
    for($is=0;$is<$poc;$is++){
      $jmeno_info2 = mysql_result($bvys2, $is, "jmeno");
      if($jmeno_info1==$jmeno_info2){
        $col="#009251";
	     echo "<span class='text'><a href='hlavni.php?page=posta&vyber=1&komuposl=".$jmeno_info1."'><font color=$col>$jmeno_info1</a> </font></span><br>";
      }
    }
  }
}

//***********************  Online vlada  *********************************
$arasa = $zaznam1["rasa"];

$cvys1 = MySQL_Query("SELECT vudce,zastupce,min1,min2,min3,min4,min5 FROM vudce where rasa='$arasa'");
$poc2 = mysql_num_rows($cvys1);

if ($poc!=0 & $arasa<12){
  echo "<br><span class='text'>Online <font color='#FFA500'>vláda</font></span><br>";

  $info_vudce = mysql_result($cvys1, 0, "vudce");
  $info_zastupce = mysql_result($cvys1, 0, "zastupce");
  $info_min1 = mysql_result($cvys1, 0, "min1");
  $info_min2 = mysql_result($cvys1, 0, "min2");
  $info_min3 = mysql_result($cvys1, 0, "min3");
  $info_min4 = mysql_result($cvys1, 0, "min4");
  $info_min5 = mysql_result($cvys1, 0, "min5");
  for($is=0;$is<$poc;$is++){
    $jmeno_info = mysql_result($bvys2, $is, "jmeno");
    if($info_vudce == $jmeno_info){ vlada($jmeno_info, "#FFFF00"); }
    if($info_zastupce == $jmeno_info){ vlada($jmeno_info, "#FFFFFF"); }
    if($info_min1 == $jmeno_info){ vlada($jmeno_info, "#c60d00"); }
    if($info_min2 == $jmeno_info){ vlada($jmeno_info, "#fda307"); }
    if($info_min3 == $jmeno_info){ vlada($jmeno_info, "#fda307"); }
    if($info_min4 == $jmeno_info){ vlada($jmeno_info, "#fda307"); }
    if($info_min5 == $jmeno_info){ vlada($jmeno_info, "#fda307"); }
  }
}

		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra FROM uzivatele where cislo=$logcislo");
		$nnnnn = MySQL_Fetch_Array($vvvvv);

$stat2=$nnnnn["status"];

$stat3=$nnnnn["statusnovacek"];
$stat4=$nnnnn["admin"];

if($stat2=="1"){
$status="<font color='#FFFF00'>vùdce</font>";
}
elseif($stat2=="2"){
$status="<font color='#FFFFFF'>zástupce</font>";
}
elseif($stat2=="0"){
$status="obèan";
}
elseif($stat2=="3"){
$status="neidentifikováno";
}
elseif($stat2=="4"){
$status="vyhnanec";
}
elseif($stat2=="5"){
$status="<font color='#FFA500'>ministr</font>";
}
elseif($stat2=="6"){
$status="<font color='#00BFFF'>admin</font>";
}
else{
$status="obèan";
}

if($stat3=="1"){
$status="<font color='#00FF00'>nováèek</font>";
}

if($stat4=="1"){
$status="<font color='#00BFFF'>admin</font>";
}

  echo "<br><span class='text'>Uživatel</span><br>";

echo "<font class='text_bili'><font class='text'>Jméno:</font> ".$logjmeno."</font>";
echo "<br><font class='text_bili'><font class='text'>Stav:</font> pøihlášen</font>";
echo "<br><font class='text_bili'><font class='text'>Status:</font> ".$status."</font>";


?>

