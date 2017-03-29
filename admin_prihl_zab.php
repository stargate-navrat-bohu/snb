<?
mysql_query("SET NAMES cp1250");
// if( ($zaznam1[jmeno]=='puchy2' and $ip=='89.103.50.18') or ($zaznam1[jmeno]=='sutech' and ($ip=='213.151.202.200' OR $ip=='217.119.115.194')) or ($zaznam1[jmeno]=='lucky' and $ip=='194.228.224.2') or ($zaznam1[jmeno]=='marse4' and $ip=='85.70.128.246') or ($zaznam1[jmeno]=='ETNyx' and ($ip=='89.102.145.89' OR $ip=='85.70.129.206')) or ($zaznam1[jmeno]=='ACE1' and $ip=='85.70.227.211') or ($zaznam1[jmeno]=='Pyrotechnik' and ($ip=='89.102.147.200' OR $ip=='192.168.123.100')) or ($zaznam1[jmeno]=='Martinus' and $ip=='85.248.15.67') or ($zaznam1[jmeno]=='Big Lebowsky' and $ip=='217.117.217.178') or ($zaznam1[jmeno]=='zipakn' and $ip=='220.249.114.134') or ($zaznam1[jmeno]=='Eleatee' and $ip='85.70.128.246') or ($zaznam1[jmeno]=='Mario' and $ip='81.88.143.146') or ($zaznam1[jmeno]=='Kr.Pa.' and $ip='10.100.97.19')or ($zaznam1[jmeno]=='RoobyJ' and $ip='212.71.164.105')){

	$hesla = MySQL_Query("SELECT heslo FROM uzivatele where jmeno = '$zaznam1[jmeno]'");	
	$heslo = MySQL_Fetch_Array($hesla);

	$hesla_a = MySQL_Query("SELECT heslo FROM adminspass where id = 0 ");
	$heslo_a = MySQL_Fetch_Array($hesla_a);
	$hesla_b = MySQL_Query("SELECT heslo FROM adminspass where id = 1 ");	
	$heslo_b = MySQL_Fetch_Array($hesla_b);

$heslomoje=$heslo[heslo];
$heslomoje2=$heslo_a[heslo];
$heslomoje3=$heslo_b[heslo];

// }

?>
