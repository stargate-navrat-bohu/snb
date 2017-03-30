<?php
//mysql_query("SET NAMES cp1250");
	
function fcislo($a){
    $a=number_format($a,1,"."," ");	
    return $a;	
}
function fcislo2($a){
    $a=number_format($a,0,"."," ");	
    return $a;	
}

$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");
$zaznam1 = MySQL_Fetch_Array($vys1);

require("adkontrola.php");

?>

<center> <br /><br />

<h6>Systém nových hráčů (seznam bodů)</h6>

<?php
$priv = MySQL_Query("SELECT jmeno,cislo,privedeno FROM uzivatele WHERE privedeno!='0' ORDER BY privedeno ASC");		

echo "<TABLE ".$table." ".$border." width='25%' align=center>";
echo "<tr>";
echo "<th colspan=3><font color='FF0D0D'>Pořadí</font></th>";
echo "</tr>";
echo "<tr>";
echo "<th>Jméno</th>";
echo "<th>Počet bodů</th>";
echo "<th>Číslo</th>";
echo "</tr>";

while($priv_1 = MySQL_Fetch_Array($priv)){
    echo "<tr>";
    echo "<td><a href='hlavni.php?page=posta&amp;komuop=".$priv_1[jmeno]."'>".$priv_1[jmeno]."</font></a></td>";
    echo "<td>".$priv_1[privedeno]."</font></td>";
    echo "<td>".$priv_1[cislo]."</font></td>";
    echo "</tr>";
}

echo "</table>";
?>
<br /></center>

<h6>Vzít status učitel hráči:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='uberuci' size='8' value=<?php echo $uberuci;?>>
<input type=submit value="proveď"><br>
</font>
</form>
<?php
if(isset($uberuci)):
    $statsv=0;
    MySQL_Query("update uzivatele set  statusucitel=$statsv where jmeno='$uberuci' ");
endif;

MySQL_Close($spojeni);
?>
</body>
</html>
