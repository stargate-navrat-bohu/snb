<?
                        include "data_1.php";
mysql_query("SET NAMES cp1250");
			$vys1 = MySQL_Query("SELECT * FROM online") or die(mysql_error());
			$zaznam1 = MySQL_Fetch_Array($vys1);

?>



