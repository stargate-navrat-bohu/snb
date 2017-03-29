<?
require "data_1.php";
mysql_query("SET NAMES cp1250");
// prijmuti hrace do rasy
if($_POST["zadost"]=="1"){
  $id = $_POST["id"];
  $rasa_prijemce = $_POST["rasa_prijemce"];
  $jmeno_zadatele = $_POST["jmeno_zadatele"];
  $sql_prijmuti = mysql_query("UPDATE uzivatele SET rasa = $rasa_prijemce WHERE jmeno = '$jmeno_zadatele'") or die("nepodarilo se prijmout noveho clnena rasy");
  $sql_del_zadost = mysql_query("DELETE FROM posta WHERE id='$id'") or die("Nepodaøilo se smazat pøijmací poštu");
  echo "Hraè $jmeno_zadatele byl úspìšnì prijmut do vaši rasy<br /><br />";
}
// prijmuti hrace do rasy...konec

// Mazani vsechny posty...zacatek

if($_POST["smaz_vse"]=="ano") {
$delete_all = mysql_query("DELETE FROM posta WHERE odesilatel='$logjmeno' OR  adresat='$logjmeno'") or die("chyba");
}

// mazani vsechny posty konec

?>

<center>
<h2></h2>

<font class='text_bili'><font class='text_modry'>P</font>ošta</font><br /><br /></font>

<font class='text_bili'><a href='hlavni.php?page=posta&vyber=1'>Napsat zprávu</a>&nbsp;&nbsp;

<?

$posta_A = MySQL_Query("SELECT jmeno,cislo,rasa,admin,status,prechod FROM uzivatele where cislo='$logcislo'");
$posta_1 = MySQL_Fetch_Array($posta_A);
$prechod_akiv = $posta_1[prechod]+172800;
$ted = Date("U");
if( ($posta_1[rasa]==11 OR $posta_1[rasa]==97 OR $posta_1[rasa]==98) AND ($prechod_akiv<= $ted)){

echo " <a href='hlavni.php?page=posta&vyber=11'>Žádost o pøijetí do rasy</a>&nbsp;&nbsp; ";
}

//menu...zacatek
?>
<a href='hlavni.php?page=posta&vyber=2'>Pøíchozí pošta  	(<? echo $nova1 ;?>)</a>&nbsp;&nbsp;

<a href='hlavni.php?page=posta&vyber=3'>Odeslaná pošta  	</a>&nbsp;&nbsp;

<a href='hlavni.php?page=posta&vyber=4'>Rasová pošta		(<? echo $nova4 ;?>)</a>&nbsp;&nbsp;

<a href='hlavni.php?page=posta&vyber=5'>Obchodní pošta  	(<? echo $nova5 ;?>)</a>&nbsp;&nbsp;

<a href='hlavni.php?page=posta&vyber=6'>Bankovní pošta  	(<? echo $nova6; ?>)</a>&nbsp;&nbsp;

<a href='hlavni.php?page=posta&vyber=7'>Adminská pošta 	 	(<? echo $nova7; ?>)</a>&nbsp;&nbsp;

<?

if( ($posta_1[status]==1) or ($posta_1[status]==2) or ($posta_1[status]==5) or ($posta_1[admin]==1) ){

echo " <a href='hlavni.php?page=posta&vyber=8'>Vládní pošta    	($nova8)</a>&nbsp;&nbsp; ";

}

if( ($posta_1[admin]==1) or ($posta_1[admin]==2) or ($posta_1[admin]==3) or ($posta_1[admin]==4) ){

echo " <a href='hlavni.php?page=posta&vyber=9'>Interní adminská pošta  ($nova9)</a>&nbsp;&nbsp; ";

}

echo "<p>";
/*
if( ($posta_1[admin]==1) or ($posta_1[admin]==2) or ($posta_1[admin]==3) or ($posta_1[admin]==4) ){

echo " <a href='hlavni.php?page=posta&vyber=12'>Žádosti o uèitele      ($nova12)</a>&nbsp;&nbsp; ";

}

echo "<a href='hlavni.php?page=posta&vyber=10'>Nastavení pošty</a>&nbsp;&nbsp;";
echo "<br /><br />";*/
//menu...konec


//odeslani zpravy...zacatek

if($nazev or $text){
if($typz==""){$typz=2;}
if($typz!=2){$komuposl="všeobecná";}
if($text!=""){
if($nazev!=""){
if($komuposl!=""){
$posta_D = MySQL_Query("SELECT jmeno,rasa FROM uzivatele where jmeno='$komuposl'");
$posta_4 = MySQL_Fetch_Array($posta_D);
if($posta_4[jmeno]!="" or $komuposl=="všeobecná"){

$nazev=HTMLSpecialChars($nazev);
$nazev=Str_Replace("\r\n","<br>",$nazev);
$nazev=NL2BR($nazev);
if($posta_1[admin]!=1 and $posta_1[admin]!=2 and $posta_1[admin]!=3 and $posta_1[admin]!=4){
$text=HTMLSpecialChars($text);
}
$text=Str_Replace("\r\n","<br>",$text);
$text=NL2BR($text);
include "smail.php";

		$id_posta = MySQL_Query("SELECT id FROM pocitani_id WHERE sekce='posta' ");
		$id_posta_1 = MySQL_Fetch_Array($id_posta);
$id=$id_posta_1[id]+1;
		MySQL_Query("update pocitani_id set id='$id' WHERE sekce='posta' ") or die(mysql_error());

$vlozeno=Date("U");
MySQL_Query ("INSERT INTO posta (id, odeslano_kdy, odesilatel, adresat, nazev, rasa_odesilatel, rasa_prijemce, text, `p/n`, typ, smaz) VALUES ('$id','$vlozeno','$logjmeno','$komuposl','$nazev','$posta_1[rasa]','$posta_4[rasa]','$text', 'n','$typz','0')");

if($typz==2){
MySQL_Query("update uzivatele set posta = posta + 1 where jmeno = '$komuposl'");
}
elseif($typz==4){
MySQL_Query("update uzivatele set posta4=posta4 + 1 WHERE rasa = '$posta_1[rasa]' AND cislo!='$logcislo'");
}
elseif($typz==7){
MySQL_Query("UPDATE uzivatele SET posta7=posta7 + 1 ");
}
elseif($typz==8){
MySQL_Query("UPDATE uzivatele SET posta8=posta8 + 1 WHERE rasa='$posta_1[rasa]' AND (status='1' or status='2' or status='5') AND cislo!='$logcislo' ");
}
elseif($typz==9){
MySQL_Query("UPDATE uzivatele SET posta9=posta9 + 1 WHERE admin='1' AND cislo!='$logcislo'");
}

echo "Zpráva byla odeslána<p>";

}
else{echo " <font class=text_cerveny> Zadaný adresát neexistuje. Zkontrolujte prosím Vaše zadání. </font> <br /><br /> ";}
}
else{echo " <font class=text_cerveny> Je nutné zadat adresáta zprávy.</font> <br /><br /> ";}
}
else{echo " <font class=text_cerveny> Je nutné zadat název zprávy.</font> <br /><br /> ";}
}
else{echo " <font class=text_cerveny> Je nutné zadat text zprávy.</font> <br /><br /> ";}
}

if($vyber==1 or ($vyber=="" and $cela=="")){

echo "<form method='post' name='enter' action='hlavni.php?page=posta&vyber=1'>
<font class=text_bili>
<script type='text/javascript' src='smail_3.php'></script>
Adresát: <input type='text' value='$komuposl' size=17 name='komuposl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Nadpis zprávy: <input type='text' value='$nazev' size=17 name='nazev'><br />
<textarea name='text' cols='70' rows='6'></textarea>";
include "smail_2.php";

if((($posta_1[admin]==1 or $posta_1[admin]==2 or $posta_1[admin]==3 or $posta_1[admin]==4) or $posta_1[admin]==2 or $posta_1[admin]==3 or $posta_1[admin]==4) or ($posta_1[status]==1 or $posta_1[status]==2 or $posta_1[status]==5)){
echo "<br />Typ zprávy:<br />";
}

if(($posta_1[status]==1 or $posta_1[status]==2 or $posta_1[status]==5) and ($posta_1[admin]!=1 and $posta_1[admin]!=2 and $posta_1[admin]!=3 and $posta_1[admin]!=4)){
echo "
Normální &nbsp;<INPUT TYPE='radio' name='typz' value='2' checked>&nbsp;&nbsp;
Rasová &nbsp;<INPUT TYPE='radio' name='typz' value='4'>&nbsp;&nbsp;
Vládní &nbsp;<INPUT TYPE='radio' name='typz' value='8'>";
}
else{$typz==2;}

if((($posta_1[admin]==1 or $posta_1[admin]==2 or $posta_1[admin]==3 or $posta_1[admin]==4) or $posta_1[admin]==2 or $posta_1[admin]==3 or $posta_1[admin]==4)){
echo "
Normální &nbsp;<INPUT TYPE='radio' name='typz' value='2' checked>&nbsp;&nbsp;
Rasová &nbsp;<INPUT TYPE='radio' name='typz' value='4'>&nbsp;&nbsp;
Adminská &nbsp;<INPUT TYPE='radio' name='typz' value='7'>&nbsp;&nbsp;
Vládní &nbsp;<INPUT TYPE='radio' name='typz' value='8'>&nbsp;&nbsp;
Interní adminská &nbsp;<INPUT TYPE='radio' name='typz' value='9'> ";
}

echo "<br /><br />";
echo "<input type='submit' value='Odeslat zprávu' name=posta class='button'></form>";
echo "<br />";

}
//odeslani zpravy...konec


//zobrazeni cele zpravy...zacatek

if($cela){

$posta_C = MySQL_Query("SELECT id, odeslano_kdy, odesilatel, nazev, rasa_odesilatel, text, typ FROM posta WHERE (id=$cela and (adresat = '$logjmeno' or ( (odesilatel='$logjmeno') or (typ=4 and rasa_odesilatel=$posta_1[rasa]) or (typ=7) or (typ=8 and rasa_odesilatel=$posta_1[rasa] and ($posta_1[status]=2 or $posta_1[status]=1 or $posta_1[status]=5)) or (typ=9 and ($posta_1[admin]=1 or $posta_1[admin]=2 or $posta_1[admin]=3 or $posta_1[admin]=4)) or (typ=12 and ($posta_1[admin]=1 or $posta_1[admin]=2 or $posta_1[admin]=3 or $posta_1[admin]=4))  )) and smaz=0 ) ") or die(mysql_error());
$posta_3 = MySQL_Fetch_Array($posta_C);

if($posta_3[id]!=""){
if(($posta_1["status"] == 1 AND $posta_3["typ"]=="11") OR ($posta_3["typ"]!="11")){
$vlozeno=Date("G:i:s j.m.Y",$posta_3["odeslano_kdy"]);
	if($posta_3["odesilatel"]!=$logjmeno){
		MySQL_Query("update posta set `p/n`='p' WHERE id=$posta_3[id] ") or die(mysql_error());
	}
echo "<hr color='A1CA00' width='50%'>";
echo" <br /> <font class=text_zeleny> ".$vlozeno." &nbsp;&nbsp; ".$posta_3["nazev"]." &nbsp;&nbsp; ".$posta_3["odesilatel"]." </font> <br /><br /> ".$posta_3["text"]." ";
//Oprava by ETNyx pridano elseif( ( ($posta_3[typ]==4 OR $posta_3[typ]==8) AND $posta_1[status]!=1 AND $posta_3[odesilatel]!=$logjmeno ) OR ($posta_3[typ]==7 AND $posta_1[admin]!=1 AND $posta_3[odesilatel]!=$logjmeno) ){ echo "<font color=\"#01BAFF\">Nelze odpovìdìt &nbsp;&nbsp;&nbsp;&nbsp; Nelze smazat</th>";} // zamezi mazani posty nepovolanych hracu (rasova, vladni)
echo "<br /><br />"; if($posta_3[typ]==7 and $posta_1[admin]!=1){ echo "";} elseif( ( ($posta_3[typ]==4 OR $posta_3[typ]==8) AND $posta_1[status]!=1 AND $posta_3[odesilatel]!=$logjmeno ) OR ($posta_3[typ]==7 AND $posta_1[admin]!=1 AND $posta_3[odesilatel]!=$logjmeno) ){ echo "<font color=\"#0099FF\">Nelze odpovìdìt &nbsp;&nbsp;&nbsp;&nbsp; Nelze smazat</th>";} else { echo "<a href='hlavni.php?page=posta&komuposl=".$posta_3['odesilatel']."&nazev=RE:".$posta_3["nazev"]."'>odpovìdìt</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href='hlavni.php?page=posta&smazat=".$posta_3['id']."&povoleni=1'>smazat</a>";}
} else { echo " <br /><br /> <font class=text_cerveny> Tato zpráva je žádostí o pøijetí do rasy </font>"; }
}
else {echo " <br /><br /> <font class=text_cerveny> Tato zpráva neexistuje, nebo nemáte právo ji èíst! </font>";}
}


//zobrazeni cele zpravy...konec


//zobrazeni cele postovni schranky...zacatek
//smazat zpravu...zaèátek
if($smazat and $povoleni==1){

MySQL_Query ("UPDATE posta set smaz=2 where id='$smazat' and typ!='7'");

echo "Zpráva byla smazána<p>";

}
//smazat zpravu...konec

if($vyber and $vyber!=1 and $vyber<10){
if($vyber==2){$vyber="";}
MySQL_Query("UPDATE uzivatele SET posta$vyber='0' where jmeno='$logjmeno'");
if($vyber==""){$vyber=2;}
//nastaveni strankovani...zaèátek
$pocet = 15;
if(!empty($_GET["pozice"])){
$pozice = $_GET["pozice"];
}else{
$pozice = 0;
}
$posta__str = mysql_query("SELECT id FROM posta WHERE ( (typ=$vyber or ($vyber=3 and odesilatel='$logjmeno') ) and (adresat = '$logjmeno' or ( ($vyber=3 and odesilatel='$logjmeno') or (typ=4 and rasa_odesilatel=$posta_1[rasa]) or (typ=7) or (typ=8 and rasa_odesilatel=$posta_1[rasa] and ($posta_1[status]=1 or $posta_1[status]=2 or $posta_1[status]=5) ) or (typ=9 and ($posta_1[admin]=1 or $posta_1[admin]=2 or $posta_1[admin]=3 or $posta_1[admin]=4)) or (typ=12 and ($posta_1[admin]=1 or $posta_1[admin]=2 or $posta_1[admin]=3 or $posta_1[admin]=4))  )) and smaz=0 ) ");
//nastaveni strankovani...konec

$posta_B = MySQL_Query("SELECT id, odeslano_kdy, odesilatel, adresat, nazev, rasa_odesilatel, typ, `p/n` FROM posta WHERE ( (typ=$vyber or ($vyber=3 and odesilatel='$logjmeno') or (typ=11 and adresat='$logjmeno') ) and (adresat = '$logjmeno' or ( ($vyber=3 and odesilatel='$logjmeno') or (typ=4 and rasa_odesilatel=$posta_1[rasa]) or (typ=7) or (typ=8 and rasa_odesilatel=$posta_1[rasa] and ($posta_1[status]=1 or $posta_1[status]=2 or $posta_1[status]=5) ) or (typ=9 and ($posta_1[admin]=1 or $posta_1[admin]=2 or $posta_1[admin]=3 or $posta_1[admin]=4)) or (typ=12 and ($posta_1[admin]=1 or $posta_1[admin]=2 or $posta_1[admin]=3 or $posta_1[admin]=4))  )) and smaz=0 ) ORDER BY odeslano_kdy DESC LIMIT ".$pozice.",".$pocet."") or die(mysql_error());

echo "<hr color='A1CA00' width='50%'>";
echo "<span class='text_normal_novinky_posledni'>Seznam $nazev pošty (øazeno podle data):</span><br>";
echo "<table border='0'>";

echo "<tr>";
echo "<th>Odesláno</th>";
echo "<th>Nadpis</th>";
echo "<th>Odesilatel</th>";
if($vyber==3){ echo "<th>Pøíjemce</th>"; }
echo "<th>Celý text</th>";
if( ($vyber==7 and $posta_1[admin]!=1)){ echo "";} else { echo "<th>Smazat</th>";}
echo "<th>Stav zprávy</th>";
echo "</tr>";

while($posta_2 = MySQL_Fetch_Array($posta_B)){

$vlozeno=Date("G:i:s j.m.Y",$posta_2[odeslano_kdy]);

switch($posta_2["p/n"]){
				default:
				case n: $stav="<font class='text_cerveny'>nepøeètená </font>";break;
				case p:
				 $stav="<font class='text_zeleny'>pøeètená </font>";break;
			}

echo "<tr>";
echo "<th>".$vlozeno."</th>";
echo "<th>".$posta_2[nazev]."</th>";
echo "<th><a href='hlavni.php?page=vesmir&hledat=".$posta_2["odesilatel"]."'>".$posta_2[odesilatel]."</a></th>";
if($vyber==3){ echo "<th><a href='hlavni.php?page=vesmir&hledat=".$posta_2["adresat"]."'>".$posta_2[adresat]."</a></th>"; }
echo "<th><a href='hlavni.php?page=posta&cela=".$posta_2['id']."'>celá zpráva</a></th>";
//Oprava by ETNyx pridano  elseif( $posta_2[typ]==4 AND $posta_1[status]!=1 AND $posta_2[odesilatel]!=$logjmeno ){ echo "<th>Nelze smazat</th>";} // zamezi mazani posty nepovolanych hracu (rasova, vladni)
if($posta_2[typ]==7 and $posta_1[admin]!=1){ echo "";} elseif( ( ($posta_2[typ]==4 OR $posta_2[typ]==8) AND $posta_1[status]!=1 AND $posta_2[odesilatel]!=$logjmeno ) OR ($posta_2[typ]==7 AND $posta_1[admin]!=1 AND $posta_2[odesilatel]!=$logjmeno) ){ echo "<th>Nelze smazat</th>";} else { echo "<th><a href='hlavni.php?page=posta&vyber=$vyber&smazat=".$posta_2['id']."&povoleni=1'>smazat</a></th>";}
echo "<th>$stav</th>";
echo "</tr>";

/*$posta_C11 = MySQL_Query("SELECT id, odeslano_kdy, odesilatel, adresat, nazev, rasa_odesilatel, typ, `p/n` FROM posta WHERE typ=11") or die("nesmysl");
while($posta_11 = MySQL_Fetch_Array($posta_C11) ){
  echo "zadost o prijeti do rasy";
}*/
}
echo "</table>";

echo "<br /><font class='text_novinky'>Stránka: ";

$pocet_posty = mysql_num_rows($posta__str);
$strana = ($pocet_posty/$pocet);

for($i=0; $i<=$strana; $i++){
if(($i*$pocet) == $_GET["pozice"]){
echo ($i+1);
}else{
echo " | <a href=\"hlavni.php?page=posta&vyber=$vyber&pozice=".($i*$pocet)."\" title=\"Pøejít na stranu ".($i+1)."\">".($i+1)."</a> | ";
}
}
echo "<br /><br />";
echo "<form method='post' action='hlavni.php?page=posta'>";
  echo "<font class='text_cerveny'>Pozor!! tímto zmažete poštu jak sobì tak druhé stranì od které jste poštu pøijmali nebo posílali</font><br />";
  echo "<input type='hidden' name='smaz_vse' value='ano'>";
  echo "<input type='submit' value='Smaž všechnu postu'>";
echo "</form>";
}


if($vyber==2){$vyber="";}




//zobrazeni cele postovni schranky...konec


//nastaveni posty...zaèátek

if($vyber==10){

echo "Nastavení";
echo "<br /><br />";
echo "Nastavení zobrazení zpráv: Zobrazovat pouze seznam zpráv <input type='radio' name='' class=''> &nbsp;&nbsp;&nbsp; Zobrazovat celé zprávy <input type='radio' name='' class=''>";

echo "<br /><br />";

echo "Ignor list";
echo "Pøidat do ignorlistu <input type='text' name='' size='' class=''> &nbsp;&nbsp;&nbsp; Odebrat z ignorlistu <input type='text' name='' size='' class=''>";

echo "<br /> Ve vašem ignor listu jsou: $ignor";

echo "<br /><br />";

}
//nastaveniposty...konec



// odeslani zadosti o prijmuti hrace k nove rase (treba obmedzit na furlingov a vyvrhelov+casove obmedzenie)
if  ($vyber==11){
      if($_POST["pozadat"] == "true"){
        $vlozeno=Date("U");
				$rasa_prijemce= $_POST["rasa_prijemce"];
        $sql_adresat = mysql_query("SELECT jmeno FROM uzivatele WHERE status = '1' AND rasa = $rasa_prijemce");
        $row_adresat = mysql_fetch_array($sql_adresat);
        $adresat = $row_adresat["jmeno"];

        $id_posta = MySQL_Query("SELECT id FROM pocitani_id WHERE sekce='posta' ");
		    $id_posta_1 = MySQL_Fetch_Array($id_posta);
        $id=$id_posta_1[id]+1;
		    MySQL_Query("update pocitani_id set id='$id' WHERE sekce='posta' ") or die(mysql_error());

				$predmet =  "Žádost o vstup do rasy";
				$text="Hráè $logjmeno žáda o vstup do vaši rasy.<br /><br />";
				$text.= "<form method=\"post\" action=\"hlavni.php?page=posta&vyber=2\">";
				  $text.= "<input type=\"hidden\" name=\"zadost\" value=\"1\">";
				  $text.= "<input type=\"hidden\" name=\"rasa_prijemce\" value=\"$rasa_prijemce\">";
				  $text.= "<input type=\"hidden\" name=\"jmeno_zadatele\" value=\"$logjmeno\">";
				  $text.= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
				  $text.= "<input type=\"submit\" value=\"Schválit žádost\">";
				$text.= "</from><br /><br />";
			
				
				MySQL_Query ("INSERT INTO posta (id, odeslano_kdy, odesilatel, adresat, nazev, rasa_odesilatel, rasa_prijemce, text, `p/n`, typ, smaz) VALUES ('$id','$vlozeno','$logjmeno','$adresat','$predmet','$posta_1[rasa]','$rasa_prijemce','$text', 'n','11','0')") or die(mysql_error());

        MySQL_Query("update uzivatele set posta = posta + 1 where jmeno = '$adresat'");
        $prechod=Date("U");
        MySQL_query("UPDATE uzivatele SET prechod = $prechod WHERE jmeno = '$logjmeno'");
        
        echo "<script language='JavaScript'>";
          echo "location.href='hlavni.php?page=posta';";
        echo "</script>";
        
      }
    echo "<form method=\"post\" action=\"hlavni.php?page=posta&vyber=11\">";
      echo "<select name=\"rasa_prijemce\">";
        $sql_rasa = mysql_query("SELECT * FROM rasy WHERE rasa != 99 AND rasa != 98 AND rasa != 44 AND rasa != 66 AND rasa != 10 AND rasa != 9 AND rasa != 97");
        while($row_rasa = mysql_fetch_array($sql_rasa)){
          echo "<option value=\"$row_rasa[rasa]\">$row_rasa[nazevrasy]</option>";        
        }
      echo "</select>";
      echo " <input type=\"hidden\" value=\"true\" name=\"pozadat\">";
      echo " <input type=\"submit\" value=\"Požádat vùdce rasy o pøijetí\">";
    echo "</form>";
        


}

else {
	echo "Nejsi vyvrhel ani Furling proto nemužeš žádat o pøijetí do rasy!";
}
// oodeslani zadosti o prijmuti hrace k nove rase...konec
?>
