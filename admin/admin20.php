<?

mysql_query("SET NAMES cp1250");
	
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

<h6>Syst�m nov�ch hr��� (seznam bod�)</h6>

<?

	$priv = MySQL_Query("SELECT jmeno,cislo,privedeno FROM uzivatele WHERE privedeno!='0' ORDER BY privedeno ASC");		


			echo "<TABLE ".$table." ".$border." width='25%' align=center>";
			echo "<tr>";
			echo "<th colspan=3><font color='FF0D0D'>Po�ad�</font></th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Jm�no</th>";
			echo "<th>Po�et bod�</th>";
			echo "<th>��slo</th>";
			echo "</tr>";
	while($priv_1 = MySQL_Fetch_Array($priv)){



				echo "<tr>";
				echo "<td><a href='hlavni.php?page=posta&komuop=".$priv_1[jmeno]."'>".$priv_1[jmeno]."</font></a></td>";
				echo "<td>".$priv_1[privedeno]."</font></td>";
				echo "<td>".$priv_1[cislo]."</font></td>";
				echo "</tr>";
}

			echo "</table>";


?>

<br /></center>

<h6>Vz�t status u�itel hr��i:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='uberuci' size='8' value=<?echo $uberuci;?>>
<input type=submit value="prove�"><br>
</font>
</form>


<?


		if(isset($uberuci)):		

                                $statsv=0;

				MySQL_Query("update uzivatele set  statusucitel=$statsv where jmeno='$uberuci' ");


		endif;




		

		MySQL_Close($spojeni);
?>


</body>
</html>
