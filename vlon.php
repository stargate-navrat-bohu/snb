<?
mysql_query("SET NAMES cp1250");
require "data_1.php";
$avys1 = MySQL_Query("SELECT * FROM uzivatele where cislo = $logcislo");
$a_rasa= MySQL_Fetch_Array($avys1);
$arasa=$a_rasa[rasa];

$bvys1 = MySQL_Query("SELECT * FROM online where rasa ='$arasa'");
$a_online= MySQL_Fetch_Array($bvys1);
$poc=mysql_num_rows($bvys1);


$cvys1 = MySQL_Query("SELECT vudce,zastupce,min1,min2,min3,min4 FROM vudce where rasa='$arasa'");
$a_vlada= MySQL_Fetch_Array($cvys1);
//echo"$poc";
//echo"$arasa";


if ($poc!=0)
{
 for($i=0;$i<$poc;$i++)
 {
	if($a_vlada[vudce]==$a_online[$i]){
        $col="#FFFF00";
	echo "<td><font color=$col>$a_vlada[vudce]</font></td>";
	}

	if($a_vlada[zastupce]==$a_online[$i]){
        $col="#FFFFFF";
	echo "<td><font color=$col>$a_vlada[zastupce]</font></td>";
	}

	if($a_vlada[min1]==$a_online[$i]){
        $col="#FF6600";
	echo "<td><font color=$col>$a_vlada[min1]</font></td>";
	}
	if($a_vlada[min2]==$a_online[$i]){
        $col="#FF6600";
	echo "<td><font color=$col>$a_vlada[min1]</font></td>";
	}
	if($a_vlada[min3]==$a_online[$i]){
        $col="#FF6600";
	echo "<td><font color=$col>$a_vlada[min1]</font></td>";
	}
	if($a_vlada[min4]==$a_online[$i]){
        $col="#FF6600";
	echo "<td><font color=$col>$a_vlada[min1]</font></td>";
	}


 }
}
	

?>