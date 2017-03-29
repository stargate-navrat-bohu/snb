<?
		require "data_1.php";
mysql_query("SET NAMES cp1250");


MySQL_Query("UPDATE `planety` SET vyrobna='42857' WHERE cislo<'100';");
MySQL_Close($spojeni);
?>
