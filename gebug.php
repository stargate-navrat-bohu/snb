<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">

<?php
require "data_1.php";
//mysql_query("SET NAMES cp1250");

$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
$zaznam1 = MySQL_Fetch_Array($vys1);
$styl="styl".$zaznam1['skin'];
if($zaznam1['skin']==1 or $zaznam1['skin']==2 or $zaznam1['skin']==3 or $zaznam1['skin']==4){
    $styl="styl1";
}
require("kontrola.php");             

$query = mysql_query("SELECT rasa,status,admin FROM uzivatele WHERE jmeno='".$logjmeno."'");
$rot = mysql_fetch_array($query);
$rasa=$rot["rasa"];
$jmeno=AddSlashes($logjmeno);
if($rot["admin"]!="1"){
    $stat=$rot["status"];
}
else{
$stat=6;
}
$query2 = MySQL_Query("SELECT nazevrasy FROM rasy where rasa='".$rasa."'");
$row = MySQL_Fetch_Array($query2);		
$nazevrasy=AddSlashes($row[nazevrasy]);
?>
<style type="text/css">
<!--
.unnamed1 {  line-height: 2px}
-->
</style>
<style type="text/css">
@import url(<?php echo $styl?>.css);
</style>
<script type="text/javascript" src="a.php" >
</script>
<body text="FFFFFF">
<P align="center">
<h2>Boužel zatím mimo provoz.</h2>
