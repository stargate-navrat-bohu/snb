<?

//require "data_1.php";
mysql_query("SET NAMES cp1250");
@$passs = MySQL_Query("SELECT * FROM adminspass where id = '0'");
	@$heslo_1 = MySQL_Fetch_Array($passs);
		@$aheslo=$heslo_1[heslo];
@$passs = MySQL_Query("SELECT * FROM adminspass where id = '1'");
	@$heslo_2 = MySQL_Fetch_Array($passs);
		@$bheslo=$heslo_2[heslo];

?>