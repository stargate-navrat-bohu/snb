<html>
<head>
<style type="text/css">
@import url(styl0.css);
</style>
</head>
<body bgcolor="bbbbbb">
<?
mysql_query("SET NAMES cp1250");
do{
	require "data_1.php";
	echo "<h6>oprava tabulky servis:<br>";

	$vys = MySQL_Query("select cislo from uzivatele order by cislo desc");
	$zaznam1 = MySQL_Fetch_Array($vys);
	$loginy=$zaznam1[cislo]+1-1000000;

	$vys = MySQL_Query("select cislo from planety order by cislo desc");
	$zaznam1 = MySQL_Fetch_Array($vys);
	$planety=$zaznam1[cislo]+1-1000000;	
	
	$vys2 = MySQL_Query("select cislo,status from planety where status=2 order by cislo desc");
	$zaznam12 = MySQL_Fetch_Array($vys2);
	$cp=$zaznam12[cislo]+1;		
	
	$vys2 = MySQL_Query("select cislo from hrdinove order by cislo desc");
	$zaznam12 = MySQL_Fetch_Array($vys2);
	$hrdinove=$zaznam12[cislo]+1;		
	
	MySQL_Query("update servis set loginy=$loginy,planety=$planety,cp=$cp,hrdinove=$hrdinove where cislo=1");
	echo "loginy: $loginy<br>";
	echo "planety: $planety<br>";
	echo "cp: $cp<br>";
	echo "hrdinove: $hrdinove<br>";		
	MySQL_Close($spojeni);
	}while(false);
?>
<br>
</body>
</html>
