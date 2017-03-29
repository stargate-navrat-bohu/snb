<?
  require('data_1.php');
mysql_query("SET NAMES cp1250");
		$vys1 = MySQL_Query("SELECT cislo,admin FROM uzivatele where admin='0' ");
		

	while ($zaznam1 = MySQL_Fetch_Array($vys1)):
	
MySQL_Query("DELETE FROM uzivatele where cislo='$zaznam1[cislo]'");

endwhile;

MySQL_Close($spojeni);		
?>
