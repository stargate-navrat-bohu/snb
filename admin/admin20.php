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

<h6>Systém nových hráèù (seznam bodù)</h6>

<?

	$priv = MySQL_Query("SELECT jmeno,cislo,privedeno FROM uzivatele WHERE privedeno!='0' ORDER BY privedeno ASC");		


			echo "<TABLE ".$table." ".$border." width='25%' align=center>";
			echo "<tr>";
			echo "<th colspan=3><font color='FF0D0D'>Poøadí</font></th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Jméno</th>";
			echo "<th>Poèet bodù</th>";
			echo "<th>Èíslo</th>";
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

<h6>Vzít status uèitel hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='uberuci' size='8' value=<?echo $uberuci;?>>
<input type=submit value="proveï"><br>
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
