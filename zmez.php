<html>
<head>
<title></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="sjoj@seznam.cz">
<meta name="generator" content="AceHTML 5 Freeware">
</head>
<body>
<?php
  mysql_query("SET NAMES cp1250");
	require "data_1.php";
	
	$vys1 = Mysql_Query("Select * from uzivatele where jmeno = '$logjmeno'");
  $zaznam = Mysql_fetch_array($vys1);
      
  if ($zaznam["admin"] == 1)
    {
	   MySQL_Query("ALTER TABLE servis ADD zmezi text");
	   MySQL_Query("update servis set zmezi='V meziv�ku nen� mo�n� pou��vat' where cislo=1");

	   MySQL_Close($spojeni);	
	  }
?>
</body>
</html>