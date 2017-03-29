<?php
Header ("Cache control: no-cache");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<?php

mysql_query("SET NAMES cp1250");
$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
$zaznam1 = MySQL_Fetch_Array($vys1);	

require("adkontrola.php");

?>


<center><h1>IN PROGRESS</h1></center>

<?php
		MySQL_Close($spojeni);
?>

</body>
</html>
