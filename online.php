<?  require "data_1.php";
mysql_query("SET NAMES cp1250");
$result = mysql_query("SELECT count( jmeno ) AS online FROM online LIMIT 1");
$online = mysql_result($result, 0, "online");
@mysql_close($spojeni);

// hlavicka
echo $online;


?>
