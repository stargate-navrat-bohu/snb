<?
mysql_query("SET NAMES cp1250");
//$adresa = "http://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];
$adresa = "http://sg-nb.cz/hlavni.php";

if($sub=="rasy"){ $nadpis = "Rasy"; }
else if($sub=="jednotky"){ $nadpis = "Jednotky"; }
else if($sub=="planety"){ $nadpis = "Planety"; }
else if($sub=="stavby"){ $nadpis = "Stavby"; }
else if($sub=="vlada"){ $nadpis = "Vláda"; }
else if($sub=="gold"){ $nadpis = "Extra statusy"; }
else if($sub=="banka"){ $nadpis = "Banka"; }
//else if($sub=="bannery"){ $nadpis = "Bannery"; }
else if($sub=="fond-obchod"){ $nadpis = "Fond-Obchod"; }
else if($sub=="stat"){ $nadpis = "Statistiky"; }
else if($sub=="rady"){ $nadpis = "Rady pro nováèky"; }
else { $nadpis = "Rady pro nováèky"; }

echo "<h1>$nadpis</h1>";

echo '<a href="'.$adresa.'?page=help&amp;sub=rady">Rady</a>&nbsp;'."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=rasy">Rasy</a>&nbsp; '."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=jednotky">Jednotky</a>&nbsp; '."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=planety">Planety</a>&nbsp; '."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=stavby">Stavby</a>&nbsp; '."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=vlada">Vláda</a>&nbsp; '."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=gold">Extra statusy</a>&nbsp; '."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=banka">Banka</a>&nbsp;'."\r\n";
//echo '<a href="'.$adresa.'?page=help&amp;sub=bannery">Bannery</a>&nbsp;'."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=fond-obchod">Fond-Obchod</a>&nbsp; '."\r\n";
echo '<a href="'.$adresa.'?page=help&amp;sub=stat">Statistiky</a>'."\r\n";
echo "<br>\r\n";

  $sub = $_GET["sub"];
	if(!$sub){ $sub = "rady"; }
  	if(file_exists("./help/$sub.php")){
  	  include("./help/$sub.php");}
    else{ echo "<div align=\"center\" style=\"padding: 50px\">Stránka help/$sub je zatím prázdná</div>";} 
?>
