<head>
    <meta charset="utf-8">
</head>    
<?mysql_query("SET NAMES cp1250");
require('data_1.php');



unset($zaznam1);
unset($rot3);
unset($row);
unset($rot2);
    mysql_query("SET NAMES cp1250");
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);

$rasa=$zaznam1["rasa"];
$jmeno=AddSlashes($logjmeno);
$stat=$zaznam1[status];
$query2 = MySQL_Query("SELECT nazevrasy FROM rasy where rasa='".$rasa."'");
$row = MySQL_Fetch_Array($query2);		
$nazevrasy=AddSlashes($row[nazevrasy]);
$prispevkyod=$zaznam1[prispevkyod];
$casted=Date("U"); 
$bcv=(15-($casted-$prispevkyod));
$query_min1 = MySQL_Query("SELECT min1 FROM `vudce` where rasa='".$rasa."'");
$row_min1 = MySQL_Fetch_Array($query_min1);



if($zaznam1["gold"]==1) { $stat_2=2; }
if($zaznam1["silver"]==1) { $stat_2=21; }
if($zaznam1["statusnovacek"]==1) { $stat_2=3; }
if($zaznam1["statusucitel"]==1) { $stat_2=4; }
if($zaznam1["statusextra"]==1) { $stat_2=5; }
if($zaznam1["novinar"]==1) { $stat_2=6; }
if($zaznam1["status"] == 4) {$stat_2 = 10;}
if($zaznam1["statusmoderator"]==1) { $stat_2=7; }
if( ($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4) ){ $stat_2=1; }
//------------------------------------------------------------------------------
if($zaznam1["statusnovacek"]==1 and $zaznam1["gold"]==1) { $stat_2=31; }
if($zaznam1["statusnovacek"]==1 and $zaznam1["silver"]==1) { $stat_2=321; }

if($zaznam1["statusucitel"]==1 and $zaznam1["gold"]==1) { $stat_2=41; }
if($zaznam1["statusucitel"]==1 and $zaznam1["silver"]==1) { $stat_2=421; }

if($zaznam1["statusextra"]==1 and $zaznam1["gold"]==1) { $stat_2=51; }
if($zaznam1["statusextra"]==1 and $zaznam1["silver"]==1) { $stat_2=521; }

if($zaznam1["novinar"]==1 and $zaznam1["gold"]==1) { $stat_2=61; }
if($zaznam1["novinar"]==1 and $zaznam1["silver"]==1) { $stat_2=621; }

if($zaznam1["statusmoderator"]==1 and $zaznam1["gold"]==1) { $stat_2=71; }
if($zaznam1["statusmoderator"]==1 and $zaznam1["silver"]==1) { $stat_2=721; }

if ($row_min1["min1"]==$zaznam1["jmeno"]) { $stat_2=77; }
if ($row_min1["min1"]==$zaznam1["jmeno"] and $zaznam1["gold"]==1) { $stat_2=771; }
if ($row_min1["min1"]==$zaznam1["jmeno"] and $zaznam1["silver"]==1) { $stat_2=772; }
if( ($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4) ) { $stat_2=1; }

require("kontrola.php");

$ban = MySQL_Query("SELECT ip,jmeno,duvod,konec FROM banfor");	
while($banf = MySQL_Fetch_Array($ban)){
/*  if($id=="$banf[ip]") {
    echo "<font color='cc4030' size='4px' family='Times New Roman' Weight='bold'>Protože: ".$banf["duvod"].". Byl vám pøístup na fora zakázán. Ban je udìlen do ".$banf["konec"].".</font>"; 
    die;
  }*/
	if($logjmeno=="$banf[jmeno]") {
    $cas = MKTime();
    if($cas >= $banf["konec"]){
      MySQL_Query("DELETE FROM banfor WHERE jmeno = '$logjmeno'") or die("chyba");
      $zaban = 0;
      //echo "Refreshujte stránku";
    } else { 
      $konec1 = $banf["konec"];
      echo "<font class='text_cerveny'>Z dùvodu ".$banf["duvod"]." vám byl udìlen ban. Ban je udìlen do ".Date("G:i:s j.m.Y",$konec1).".</font>";
      $zaban = 1;
      
    }
  }
}




if(!$kde){ echo "<center><font class='text_bili'><font class='text_modry'>F</font>órum</font>"; }


$vaseuk=$zaznam1[prispevky];
echo "<br><font class='text_bili'>Vaše ukecanost: ".$vaseuk." ";

	
		           

$casted=Date("U");



if($kde==""){


  echo "<center><br>";
  echo "<font class='tabulka'>";
    echo "<a href='hlavni.php?page=ukecanost'>Ukecanost</a>&nbsp;|&nbsp;";
    echo "<a href='hlavni.php?page=casnasg'>Èas na SG-NB</a>";
    if($zaznam1[admin] != 0 OR $zaznam1[statusmoderator] != 0){ 
      echo "&nbsp;|&nbsp;<a href='hlavni.php?page=ban_list'>Bann list</a>";
    }
  echo "<br /><br /></font>";

  echo "<font class='tabulka'>Herní místnosti<br></font>";
  if($zaznam1[admin]!=0){    // fora jen admini
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='1' AND status='4' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  
  if($zaznam1[admin]!=0 OR $zaznam1[statusmoderator] == 1){    // fora admini a moderatori
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='1' AND status='8' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
   
  if($zaznam1[admin]!=0 OR $zaznam1[status]==1){   // fora admini a vudcove
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='1' AND status='3' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  } 
  if($zaznam1[admin]!=0 OR $zaznam1[status]==1 OR $zaznam1[status]==2 OR $zaznam1[status]==5 OR $zaznam1[statusmoderator]==1 ){ // admini a vlady
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='1' AND status='2' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	  
    }
  } 
  if($zaznam1[admin]!=0 OR $zaznam1[povydkar]!=0 OR $zaznam1[statusmoderator]==1){  // admini a povydkari
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='1' AND status='5' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	  
    }
  }
  $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='1' AND status='1' ORDER BY dulezitost DESC");
  while($temata = MySQL_Fetch_Array($tem1)){
    $datum1=Date("j.m.Y",$temata1[zalozeni]);
    $kam=$temata[kde];	
    $nazev=$temata[nazev];
    echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
  }
  
//////////////////////////////////////////////////////////////////////////////////////////  
  echo "<br><br><font class='tabulka'>Diskuzní místnosti<br></font>";	
//////////////////////////////////////////////////////////////////////////////////////////

  if($zaznam1[admin]!=0){    // fora jen admini
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='2' AND status='4' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  } 
  
  if($zaznam1[admin]!=0 OR $zaznam1[statusmoderator] == 1){    // fora admini a moderatori
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='2' AND status='8' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  
  if($zaznam1[admin]!=0 OR $zaznam1[status]==1){   // fora admini a vudcove
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='2' AND status='3' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  } 
  if($zaznam1[admin]!=0 OR $zaznam1[status]==1 OR $zaznam1[status]==2 OR $zaznam1[status]==5 OR $zaznam1[statusmoderator]==1){ // admini a vlady
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='2' AND status='2' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";   
    }
  } 
  if($zaznam1[admin]!=0 OR $zaznam1[gold]!=0 OR $zaznam[silver]!=0 OR $zaznam1[statusmoderator]==1){  // admini a gold + silver
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='2' AND status='6' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  
  if($zaznam1[admin]!=0 OR $zaznam1[povydkar]!=0 OR $zaznam1[statusmoderator]==1){  // admini a povydkari
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='2' AND status='5' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='2' AND status='1' ORDER BY dulezitost DESC");
  while($temata = MySQL_Fetch_Array($tem1)){
    $datum1=Date("j.m.Y",$temata1[zalozeni]);
    $kam=$temata[kde];	
    $nazev=$temata[nazev];  
    echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	  
  }
 
//////////////////////////////////////////////////////////////////////////////////////////
  echo "<br><br><font class='tabulka'>Zábavné místnosti<br></font>";
//////////////////////////////////////////////////////////////////////////////////////////

  if($zaznam1[admin]!=0){    // fora jen admini
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='4' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  if($zaznam1[admin]!=0 OR $zaznam1[statusmoderator]==1){    // fora admini a moderatori
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='8' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
   
  if($zaznam1[admin]!=0 OR $zaznam1[status]==1){   // fora admini a vudcove
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='3' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  } 
  if($zaznam1[admin]!=0 OR $zaznam1[status]==1 OR $zaznam1[status]==2 OR $zaznam1[status]==5 OR $zaznam1[statusmoderator]==1){ // admini a vlady
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='2' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  } 
  if($zaznam1[admin]!=0 OR $zaznam1[povydkar]!=0 OR $zaznam1[statusmoderator]==1){  // admini a povydkari
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='5' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  if($zaznam1[admin]!=0 OR $zaznam1[gold]!=0 OR $zaznam[silver]!=0 OR $zaznam1[statusmoderator]==1){  // admini a povydkari
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='6' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  if($zaznam1[admin]!=0 OR $zaznam1[gold]!=0 OR $zaznam[silver]!=0 OR $zaznam1[statusmoderator]==1){  // admini a gold + silver
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='6' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  if($zaznam1[admin]!=0 OR $zaznam1[novinar]!=0 OR $zaznam1[statusmoderator]==1){  // admini a povydkari
    $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='7' ORDER BY dulezitost DESC");
    while($temata = MySQL_Fetch_Array($tem1)){
      $datum1=Date("j.m.Y",$temata1[zalozeni]);
      $kam=$temata[kde];	
      $nazev=$temata[nazev];
      echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
    }
  }
  $tem1 = MySQL_Query("SELECT * FROM forum_mistnosti WHERE typ='3' AND status='1' ORDER BY dulezitost DESC");
  while($temata = MySQL_Fetch_Array($tem1)){
    $datum1=Date("j.m.Y",$temata1[zalozeni]);
    $kam=$temata[kde];	
    $nazev=$temata[nazev];
    echo "<font class='tabulka'><a href='hlavni.php?page=forum&kde=$kam'>".$nazev."</a></font>&nbsp;|&nbsp;";	
  }



}
else {
  echo "<center><b>";
  if($del){
    if($stat<"6") {
      if(($_GET["kde"]=="adm" OR $_POST["kde"]=="adm") AND $zaznam1["admin"]=="0"){
      Mysql_query("UPDATE forum SET text='$logcislo' WHERE id='$delete'");
      } else {
      MySQL_Query("DELETE FROM forum where id='$delete'");
      }
    }
    elseif($stat>"5") {
      if(($_GET["kde"]=="adm" OR $_POST["kde"]=="adm") AND $zaznam1["admin"]=="0"){
      Mysql_query("UPDATE forum SET text='$logcislo' WHERE id='$delete'");
      } else {
      MySQL_Query("DELETE FROM forum where id='$delete'");
      }
    }
  }
/////////////////////////////////////////////////////////////////// vkladani prispevku do fora
	$povoleni1 = MySQL_Query("SELECT status, cil, ochrana FROM forum_mistnosti where kde='$kde' ");
  $povoleni = MySQL_Fetch_Array($povoleni1);
	$cteni = $povoleni["status"];
	$ochrana = $povoleni["ochrana"];
  $ochrana = explode("*",$ochrana);
		
  if( ($ochrana[0] == 1 AND $zaznam1[admin] != 0) OR 
      ($ochrana[1] == 1 AND $zaznam1[statusmoderator] == 1) OR 
      ($ochrana[2] == 1 AND $zaznam1[status] == 1) OR 
      ($ochrana[3] == 1 AND ($zaznam1[status] == 1 OR $zaznam1[status] == 2 OR $zaznam1[status] == 5)) OR
      ($ochrana[4] == 1 AND $zaznam1[povydkar] != 0) OR 
      ($ochrana[5] == 1 AND ($zaznam1[gold] != 0 OR $zaznam1[silver] != 0) ) OR
      ($ochrana[6] == 1 AND $zaznam1[novinar] != 0) OR ($ochrana[7] == 1) ) {
    if($forum) {
      if($text!=="") {
        if($zaznam1[prispevkyod]+15<Date("U")) {
          if(($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4)) {
          } else { $text=HTMLSpecialChars($text); }
          if(!isset($_POST["edit_set"])) {    ////////// upravujem pripevek nebo ne?
            $text=Str_Replace("\r\n","<br>",$text);
            $text=NL2BR($text);

            include "smail.php";

            if(($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4)) {
            } else{ $titulek=HTMLSpecialChars($titulek); }

            if($kde==adm AND ($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4)) {
		          MySQL_Query("update uzivatele set adm=adm + 1");
            }
            if($kde==pri AND ($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4)) {
              MySQL_Query("update uzivatele set pri='1'");
            }
            if($kde==ov AND ($zaznam1[status]==1 OR $zaznam1[status]==2 OR $zaznam1[status]==5)) {
              MySQL_Query("update uzivatele set ov=(ov + 1) where rasa = ".$zaznam1[rasa]." ") or die("chyba");
            }

            $prispevky=$zaznam1[prispevky]+1;
            $prispevkyod=Date("U"); 
            MySQL_Query("update uzivatele set prispevky='$prispevky', prispevkyod='$prispevkyod' WHERE jmeno='".$logjmeno."'");

            $pohlavi=$zaznam1["pohlavi"];
            $d4tum=Date("U");
            MySQL_Query ("INSERT INTO forum VALUES('0','$d4tum','$jmeno','$nazevrasy','$text','$kde','$stat','$titulek','$pohlavi','$stat_2','$rasa', '$logcislo')");
            echo MySQL_Error();
          } else { /////////////////// pokud jde o upravu tak,...
            $text=Str_Replace("\r\n","<br>",$text);
            $text=NL2BR($text);

            include "smail.php";

            if(($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4)) { 
            } else { $titulek=HTMLSpecialChars($titulek); }

            $id = $_POST["edit_set"];
            $kde = $_POST["kde"];
            $pohlavi=$zaznam1["pohlavi"];
            $d4tum=Date("U");
            MySQL_Query("UPDATE forum SET text='$text', titulek='$titulek' WHERE id='$id' AND kde = '$kde'") or die("Nepodarilo se upravit zaznam");
            echo MySQL_Error();
          }
        } else{echo "<font class=pozor><b><center>Další pøíspìvek lze odeslat až za ".$bcv." vteøin...</font></center></b>";}
      } else{echo "<font class=pozor><b><center>Nelze vkládat zprávy bez textu...</font></center></b>"; }
    }

//// zobrazeni jednotlivých for ////////////

    if(!isset($_POST["edit"])) {   /// jede o editaci nebo psani noveho pripspevku??
      echo"<a name=\"formular\"> </a><form name=enter action=\"hlavni.php?page=forum&$kde\" method=post>";
//------------------------------------------------------------------------------
      echo"<font color=#01BAFF size=2>admin</font> | 
        <font color=#FFFF00 size=2>vùdce</font> | 
        <font color=#FFFFFF size=2>zástupce</font> | 
        <font color=#c60d00 size=2>premiér</font> | 
        <font color=#fda307 size=2>ministr</font> | 
        <font color=#3846C2 size=2>moderátor</font> |
        <font color=#919191 size=2>obèan</font> | 
        <font color=#705010 size=2>vyhnanec</font> | 
        <font color=#009251 size=2>uèitel</font> | 
        <font color=#2DF96B size=2>nováèek</font> | 
        <font color=#FF6600 size=2>novináø</font><BR><br />";
                //***************************************online moderator******************
        
        echo "<div align='left' style='margin-left: 12px'>";
        $bvys2 = MySQL_Query("SELECT jmeno FROM online");
        $poc = mysql_num_rows($bvys2);

          $cvys2 = MySQL_Query("SELECT jmeno FROM uzivatele where (statusmoderator='1') order by cislo desc");
          $pocet_mod = mysql_num_rows($cvys2);

          if ($poc!=0){
          echo "<font style='font-size: 12px'>Online moderátoøi: </font>";

            for($i=0;$i<$pocet_mod;$i++){
              $jmeno_info1 = mysql_result($cvys2, $i, "jmeno");
             for($is=0;$is<$poc;$is++){
             $jmeno_info2 = mysql_result($bvys2, $is, "jmeno");
              if($jmeno_info1==$jmeno_info2){
        $col="#3846C2";
	     echo "<span class='text'><a href='hlavni.php?page=posta&vyber=1&komuposl=".$jmeno_info1."'><font color=$col style='font-size: 12px'>$jmeno_info1</a>, </font></span>";
      }
    }
  }
}
echo "<br />";
        $bvys2 = MySQL_Query("SELECT jmeno FROM online");
        $poc = mysql_num_rows($bvys2);

          $cvys2 = MySQL_Query("SELECT jmeno FROM uzivatele where (novinar='1') order by cislo desc");
          $pocet_mod = mysql_num_rows($cvys2);

          if ($poc!=0){
          echo "<font style='font-size: 12px'>Online novináøi: </font>";

            for($i=0;$i<$pocet_mod;$i++){
              $jmeno_info1 = mysql_result($cvys2, $i, "jmeno");
             for($is=0;$is<$poc;$is++){
             $jmeno_info2 = mysql_result($bvys2, $is, "jmeno");
              if($jmeno_info1==$jmeno_info2){
        $col="#a400a4";
	     echo "<span class='text'><a href='hlavni.php?page=posta&vyber=1&komuposl=".$jmeno_info1."'><font color=$col style='font-size: 12px'>$jmeno_info1</a>, </font></span>";
      }
    }
  }
}
echo "</div><p />";

        
        //********************************************************************
//------------------------------------------------------------------------------
      echo"<form method='post' name='enter' action=hlavni.php?page=forum&kde=".$kde.">";
      
      ?>
      <script type='text/javascript' src='smajl2.php'></script>
      <?php
if ($zaban == 0 ) {
      echo "<table border=0 id='f_form'>";
      echo "<tr><td class='nadpis'><b>Nadpis:</b></td><td> <input name='titulek' class='input' size='50' value='' maxlength='100'></td><tr>\r\n";

    ?>
      <tr>
        <td class="nadpis" valign="top"><b>Text:</b></td>
        <td><textarea name='text' cols='75' rows='6' class="textarea"></textarea></td>
      </tr>
      <tr>
        <td colspan=2 align="center">
      <?

      if($zaznam1[smail]!="1") {
        include "smail_2.php";
      }

      if(($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4 )) {
        echo"<BR>
          <a href=\"javascript:smilie(29)\">Èervené</a>
          <a href=\"javascript:smilie(30)\">Bílé</a> 
          <a href=\"javascript:smilie(31)\">Tuèné</a> 
          <a href=\"javascript:smilie(32)\">Kurzíva</a> 
          <a href=\"javascript:smilie(33)\">Podtrhnout</a>";
      }
      ?>
        <br><br>
        <input type='hidden' value='<? echo $kde;?>' name='kde'>
        <input type='submit' value='Odeslat' name="forum" class="button"> <input type='reset' value='Vymazat' class="button"></form>
        </td>
      </tr>
    </table>
    <?
}
elseif ($zaban == 1)
  {
    echo "<font class='text_cerveny'>Byl vám udìlen ban, proto sem nemùžete psát</font><p />";
  }
    } else { ////////////// pokud jde o editaci tak,...
      echo"<a name=\"formular\"> </a><form name=enter action=\"hlavni.php?page=forum&kde=$kde\" method=post>";

//------------------------------------------------------------------------------
        echo "<font color=#01BAFF size=2>admin</font> | 
        <font color=#FFFF00 size=2>vùdce</font> | 
        <font color=#FFFFFF size=2>zástupce</font> | 
        <font color=#c60d00 size=2>1. ministr</font> | 
        <font color=#fda307 size=2>ministr</font> | 
        <font color=#3846C2 size=2>moderátor</font> |
        <font color=#919191 size=2>obèan</font> | 
        <font color=#705010 size=2>vyhnanec</font> | 
        <font color=#009251 size=2>uèitel</font> | 
        <font color=#2DF96B size=2>nováèek</font> | 
        <font color=#FF6600 size=2>novináø</font><BR><br />";
                //***************************************online moderator******************
        echo "<div align='left' style='margin-left: 12px'>";
        $bvys2 = MySQL_Query("SELECT jmeno FROM online");
        $poc = mysql_num_rows($bvys2);

          $cvys2 = MySQL_Query("SELECT jmeno FROM uzivatele where (statusmoderator='1') order by cislo desc");
          $pocet_mod = mysql_num_rows($cvys2);

          if ($poc!=0){
          echo "<font style='font-size: 12px'>Online moderátoøi: </font>";

            for($i=0;$i<$pocet_mod;$i++){
              $jmeno_info1 = mysql_result($cvys2, $i, "jmeno");
             for($is=0;$is<$poc;$is++){
             $jmeno_info2 = mysql_result($bvys2, $is, "jmeno");
              if($jmeno_info1==$jmeno_info2){
        $col="#3846C2";
	     echo "<span class='text'><a href='hlavni.php?page=posta&vyber=1&komuposl=".$jmeno_info1."'><font color=$col  style='font-size: 12px'>$jmeno_info1</a>, </font></span>";
      }
    }
  }
}
echo "<br />";

        $bvys2 = MySQL_Query("SELECT jmeno FROM online");
        $poc = mysql_num_rows($bvys2);

          $cvys2 = MySQL_Query("SELECT jmeno FROM uzivatele where (novinar='1') order by cislo desc");
          $pocet_mod = mysql_num_rows($cvys2);

          if ($poc!=0){
          echo "<font style='font-size: 12px'>Online novináøi: </font>";

            for($i=0;$i<$pocet_mod;$i++){
              $jmeno_info1 = mysql_result($cvys2, $i, "jmeno");
             for($is=0;$is<$poc;$is++){
             $jmeno_info2 = mysql_result($bvys2, $is, "jmeno");
              if($jmeno_info1==$jmeno_info2){
        $col="#a400a4";
	     echo "<span class='text'><a href='hlavni.php?page=posta&vyber=1&komuposl=".$jmeno_info1."'><font color=$col style='font-size: 12px'>$jmeno_info1</a>, </font></span>";
      }
    }
  }
}
echo "</div><p />";

        
        //********************************************************************
//------------------------------------------------------------------------------
      echo"<form method='post' name='enter' action=hlavni.php?page=forum&kde=".$kde.">";
        ?> <script type='text/javascript' src='smajl2.php'></script> <?php

              if ($zaban == 0 ) {
        
        echo "<table border=0 id='f_form'>";
        echo "<tr><td class='nadpis'><b>Nadpis:</b></td><td> <input name='titulek' class='input' size='50' value='".$_POST["titulek"]."' maxlength='100'></td><tr>\r\n";
        $text = $_POST["text"];
        $text=Str_Replace("<br />"," \n",$text);
        $text=Str_Replace("<br>"," \n",$text);
        
        $text = str_replace("<img src=smiles/1.png>","*1**", "$text");
        $text = str_replace("<img src=smiles/2.png>","*2**", "$text");
        $text = str_replace("<img src=smiles/26.png>","*3**", "$text");
        $text = str_replace("<img src=smiles/4.png>","*4**", "$text");
        $text = str_replace("<img src=smiles/5.png>","*5**", "$text");
        $text = str_replace("<img src=smiles/6.png>","*6**", "$text");
        $text = str_replace("<img src=smiles/7.png>","*7**", "$text");
        $text = str_replace("<img src=smiles/8.png>","*8**", "$text");
        $text = str_replace("<img src=smiles/9.png>","*9**", "$text");
        $text = str_replace("<img src=smiles/10.png>","*10**", "$text");
        $text = str_replace("<img src=smiles/11.png>","*11**", "$text");
        $text = str_replace("<img src=smiles/12.png>","*12**", "$text");
        $text = str_replace("<img src=smiles/13.png>","*13**", "$text");
        $text = str_replace("<img src=smiles/14.png>","*14**", "$text");
        $text = str_replace("<img src=smiles/15.png>","*15**", "$text");
        $text = str_replace("<img src=smiles/16.png>","*16**", "$text");
        $text = str_replace("<img src=smiles/18.png>","*17**", "$text");
        $text = str_replace("<img src=smiles/19.png>","*18**", "$text");
        $text = str_replace("<img src=smiles/20.png>","*19**", "$text");
        $text = str_replace("<img src=smiles/21.png>","*20**", "$text");
        $text = str_replace("<img src=smiles/22.png>","*21**", "$text");
        $text = str_replace("<img src=smiles/23.png>","*22**", "$text");
        $text = str_replace("<img src=smiles/24.png>","*23**", "$text");
        $text = str_replace("<img src=smiles/25.png>","*24**", "$text");
        $text = str_replace("<img src=smiles/3.png>","*25**", "$text");
        $text = str_replace("<img src=smiles/27.png>","*26**", "$text");
        $text = str_replace("<img src=smiles/28.png>","*27**", "$text");
        
        echo "
        <tr>
          <td class='nadpis' valign='top'><b>Text:</b> </td>
          <td><textarea name='text' cols='75' rows='6' class='textarea'>$text</textarea></td>
        </tr>
        <tr>
          <td colspan=2 align='center'> ";
    
        if($zaznam1[smail]!="1") { include "smail_2.php"; }

        if(($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4) ){
          echo"<BR>
            <a href=\"javascript:smilie(29)\">Èervené</a>
            <a href=\"javascript:smilie(30)\">Bílé</a> 
            <a href=\"javascript:smilie(31)\">Tuèné</a> 
            <a href=\"javascript:smilie(32)\">Kurzíva</a> 
            <a href=\"javascript:smilie(33)\">Podtrhnout</a>";
        }
      echo "<br><br>
      <input type='hidden' value='".$kde."' name='kde'>
      <input type='hidden' value=".$_POST['edit']." name='edit_set' >
      <input type='submit' value='Upravit' name='forum' class='button'> <input type='reset' value='Vymazat' class='button'></form>
      </td></tr></table>";
      }
      elseif ($zaban == 1)
      {
        echo "<font class = 'text_cerveny'>Byl vám udìlen ban, proto sem nemùžete psát</font><p />";
      }
    }
  }else { echo "<font class=pozor><b><center>Nemáte právo sem vkládat pøispìvky</font></center></b>"; } 
/*
<option value=1>Všem</option>
<option value=2>Vládì</option>
<option value=3>Vùdcùm</option>
<option value=4>Adminùm</option>
<option value=5>Povýdkáøùm</option>
<option value=6>Gold hráèùm</option>
<option value=7>Novináøùm</option>
<option value=8>Moderátorùm</option>
*/  
  if( ($cteni == 4 AND $zaznam1[admin] != 0) OR 
      ($cteni == 8 AND ($zaznam1[statusmoderator] == 1 OR $zaznam1[admin] != 0)) OR 
      ($cteni == 3 AND ($zaznam1[status] == 1 OR $zaznam1[statusmoderator] == 1 OR $zaznam1[admin] != 0)) OR 
      ($cteni == 2 AND ($zaznam1[status] == 1 OR $zaznam1[status] == 2 OR $zaznam1[status] == 5 OR $zaznam1[statusmoderator] == 1 OR $zaznam1[admin] != 0)) OR
      ($cteni == 5 AND ($zaznam1[povydkar] != 0 OR $zaznam1[statusmoderator] == 1 OR $zaznam1[admin] != 0)) OR 
      ($cteni == 6 AND ($zaznam1[gold] != 0 OR $zaznam1[silver] != 0 OR $zaznam1[statusmoderator] == 1 OR $zaznam1[admin] != 0) ) OR
      ($cteni == 7 AND ($zaznam1[novinar] != 0 OR $zaznam1[statusmoderator] == 1 OR $zaznam1[admin] != 0)) OR ($cteni == 1) ) {
  echo "<div id='f_refresh'><a href='hlavni.php?page=forum&kde=".$kde."'>Refresh</a></div>";
  if($kde==pri) { MySQL_Query("update uzivatele set pri='0' where cislo=$logcislo"); }
  if($kde==adm) { MySQL_Query("update uzivatele set adm='0' where cislo=$logcislo"); }
  if($kde==ov) { MySQL_Query("UPDATE uzivatele set ov='0' where cislo=$logcislo"); }
  if ($pocet == "") { 
    $pocet = 0; 
  }
  $pocet_20 = 20;

  $i = 0;
  ++$i; 
  $max_pocet = $pocet + 20; 
  if($povoleni["cil"]=="1") {
    $query = mysql_query("SELECT * FROM forum where kde='$kde' order by den desc limit $pocet, $pocet_20");
  }
  if($povoleni["cil"]=="2") {
    $query = mysql_query("SELECT * FROM forum where kde='$kde' and rasac='$zaznam1[rasa]' order by den desc limit $pocet, $pocet_20");
  }
  if(true){
    while($rot = MySQL_Fetch_Array($query)){
      $stat2=$rot["stat"];
      $stat1=$rot["stat_2"];
      if($stat2=="1") { $color="#FFFF00"; }//vudce
      elseif($stat2=="2") { $color="#FFFFFF"; }//zastupce
      elseif($stat2=="3") { $color="#c60d00"; }//1min
      elseif($stat1=="77" OR $stat1=="771" OR $stat1=="772" ) { $color="#c60d00"; }
      elseif($stat2=="5") { $color="#fda307"; }//ministr
      elseif($stat1=="4" OR $stat1=="41" OR $stat1=="421") { $color="#009251"; }//ucitel
      elseif($stat1=="3" OR $stat1=="31" OR $stat1=="321") { $color="#2DF96B"; }//novacek
      elseif($stat1=="5" OR $stat1=="51" OR $stat1=="521") { $color="#DB603F"; }//extra
      elseif($stat1=="6" OR $stat1=="61" OR $stat1=="621") { $color="#FF6600"; }//novinar
      elseif($stat1=="7" OR $stat1=="71" OR $stat1=="721") { $color="#3846C2"; }//moderator
      elseif($stat1=="10") { $color="#705010";} //exulant
      else { $color="#919191"; }//obcan
      if($stat1=="3" OR $stat1=="31" OR $stat1=="321"){ $color="#2DF96B"; } //novacek
      if($stat1=="1") { $color="#01BAFF"; }//admin
      if($zaznam1[smail]=="1") {
        $text=$rot[text];
        $rot[text]=$text;
              
      }
      if($rot["pohlavi"]==2){ $pohlavi1="&#9792;";}
      if($rot["pohlavi"]==1){ $pohlavi1="&#9794;";}
      
      $datum=Date("G:i:s j.m.Y",$rot["den"]);
      $jm1=$rot["jmeno"];
      $on_obr="";
      $on_off=0;
      $queryonline = mysql_query("SELECT patnactminut FROM uzivatele where jmeno='$jm1'");
      $online_on = MySQL_Fetch_Array($queryonline);
      $on_off=Date("U")-$online_on["patnactminut"];
      if ($on_off< (60*5)) { $on_obr="<img src='img/on.jpg' border=0>"; }
      if ($on_off> (60*5) and $on_off<= (60*15)) { $on_obr="<img src='img/off.jpg' border=0>"; }
      if ($on_off> (60*15)) { $on_obr=""; }
      $obrg="";
      if($stat1=="2" OR $stat1=="31" OR $stat1=="41" OR $stat1=="51" OR $stat1=="61" OR $stat1=="771"){
        $obrg="<img src='obr/gold.gif' border=0>";
      }
      if($stat1=="21" OR $stat1=="321" OR $stat1=="421" OR $stat1=="521" OR $stat1=="621" OR $stat1=="772"){
        $obrg="<img src='obr/silver.gif' border=0>";
      }
      echo $on_obr;
      echo"<font color=".$color." size=3><b><a href='hlavni.php?page=posta&vyber=1&komuposl=".$rot["jmeno"]."'>
        <span class='unnamed1'><font color=".$color." size=3>".$rot["jmeno"]."</font></span></a>&nbsp;".$obrg."
        <font color=".$color." size=3>".$pohlavi1."</font>&nbsp;
        <span class='unnamed1'><font color=".$color." size=3>(".$rot["rasa"].")&nbsp;&nbsp;".$datum."&nbsp;</font></span>
        <a href=\"hlavni.php?page=forum&kde=".$kde."#formular\" onClick=\"PridejTitulek('".$rot["jmeno"]."',".$rot["id"].");\">
        <span class='unnamed1'><font color=".$color." size=3>ID: ".$rot["id"]."</font></span></a>&nbsp;&nbsp;<span class='unnamed1'>
        </span>"; 

      // zobrazeni avataru - obrazku
      $hrac_id = $rot["hrac_id"];
      if($hrac_id != 0) {
        if(file_exists("./avatary/$hrac_id.jpg")) { $nazev_image = $hrac_id.".jpg"; }
        if(file_exists("./avatary/$hrac_id.gif")) { $nazev_image = $hrac_id.".gif"; }
        if(file_exists("./avatary/$hrac_id.JPG")) { $nazev_image = $hrac_id.".JPG"; }
        if(file_exists("./avatary/$hrac_id.GIF")) { $nazev_image = $hrac_id.".GIF"; }

        if($nazev_image){

            echo "
            <table border=0 width=\"650\"><tr><td width=\"65\"><img src=\"avatary/$nazev_image\" border=0 width=\"100\" height=\"100\"></td>
            <td align=\"center\"> <font color='#FFCC33' size=3>".$rot["titulek"]."</font><br>
            <font color=$color size=2>".$rot["text"]."</font></td><tr></table>";

        
          unset($nazev_image);
        } else { 
          echo "<center>
            <font color='#FFCC33' size=3>".$rot["titulek"]."</font><br>
            <font color=$color size=2>".$rot["text"]."</font></center>";
        }
      }

      if( $rot["jmeno"]=="$logjmeno" or ((($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4) or ($zaznam1[statusmoderator]!=0 AND $ochrana[1] == 1)) AND $stat1!=1) ) {
        echo "<div style='position:relative; left:240px; float: left; padding-left: 10px; padding-bottom: 0px; margin-bottom: 0px;'><form action='hlavni.php?page=forum' method='post'><input type='hidden' value=\"".$rot["id"]."\" name='delete'><input type='hidden' value='$kde' name='kde'><input type='submit' value='Smaž' name='del' class='button'></form></div>";
        echo "<div style='position:relative; left:240px; float: left; padding-left: 10px; padding-bottom: 0px; margin-botton: 0px;'><form action='hlavni.php?page=forum' method='post'><input type='hidden' value=\"".$rot["id"]."\" name='edit'><input type='hidden' value='$kde' name='kde'><input type='hidden' name='titulek' value='".$rot["titulek"]."'><input type='hidden' name='text' value='".$rot["text"]."'><input type=submit value=Uprav name=uprav class='button'></form></div>";
        if($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 or $zaznam1[admin]==4 or $zaznam1[statusmoderator]!=0) {
            echo "<div style='position:relative; left:240px; float: left; padding-left: 10px; padding-bottom: 0px; margin-bottom: 0px;'><form action='hlavni.php?page=ban_list' method='post'><input type='hidden' value=\"".$rot["jmeno"]."\" name='ban'><input type='hidden' value='$kde' name='kde'><input type='submit' value='Udìl ban' name='dej_ban' class='button'></form></div>";
        }
        echo "<br />";
        if($del AND $pom_minyme != 1) {
          MySQL_Query("update uzivatele set prispevky=prispevky - 1 WHERE jmeno='".$rot["jmeno"]."'");
        }
        $pom_minyme =1;
      }
      echo "<br><hr width=100% color=0099FF size=2>";
    }
    $zpet = $pocet - 20; 
    $vpred = $pocet + 20; 
    echo "<font class='text_forum'><a href=\"hlavni.php?page=forum&kde=$kde&pocet=".$zpet."\"><B>Dalších 20 pøíspìvkù</B></A> &nbsp;&nbsp; <a href=\"hlavni.php?page=forum&kde=$kde&pocet=".$vpred."\"><B>Pøedchozích 20 pøíspìvkù</B></A></font>"; 
  }
  }
}
MySQL_Close($spojeni);		
?>
