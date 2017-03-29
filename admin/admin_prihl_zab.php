<?
mysql_query("SET NAMES cp1250");
if(($zaznam1[jmeno]=='maca' and $ip=='89.190.90.135') or ($zaznam1[jmeno]=='zdenda' and $ip=='0.0.0.0')){

	$hesla = MySQL_Query("SELECT heslo FROM uzivatele where jmeno = '$zaznam1[jmeno]'");	
	$heslo = MySQL_Fetch_Array($hesla);

	$hesla_a = MySQL_Query("SELECT heslo FROM adminspass where id = 0 ");	
	$heslo_a = MySQL_Fetch_Array($hesla_a);
	$hesla_b = MySQL_Query("SELECT heslo FROM adminspass where id = 1 ");	
	$heslo_b = MySQL_Fetch_Array($hesla_b);

$heslomoje=$heslo[heslo];
$heslomoje2=$heslo_a[heslo];
$heslomoje3=$heslo_b[heslo];

}

?>