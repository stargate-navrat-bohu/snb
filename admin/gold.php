
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


<h6>Vyhledat hráèe se statusem gold nebo silver</h6>
<form name='form1' method='post' action='hlavni.php?page=gold'>
<font class=text_bili>
<input type=hidden name=novac value=1>
<input type=submit value="najdi"><br>
</font>
</form>

<?


		if(isset($novac)):		
  $vys1=MySQL_Query("SELECT jmeno,rasa,gold,silver FROM uzivatele where gold!='0' or silver!='0' order by jmeno");

  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jméno</th>";
	echo "<th colspan=1><font color=white>Gold</th>";
	echo "<th colspan=1><font color=white>Silver</th>";
	echo "<th colspan=1><font color=white>Rasa</th>";
	echo "</tr>";

echo "</tr>";


while ($zaznam1=MySQL_Fetch_Array($vys1)) {



echo "<tr>";
echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
echo "<th><font color=white>".$zaznam1[gold]."</th>";
echo "<th><font color=white>".$zaznam1[silver]."</th>";
echo "<th><font color=white>".$zaznam1[rasa]."</th>";
echo "</tr>";
}							
echo "</table>";exit;

		endif;


?>






<br>


<center>

<h6>Udìlit status gold hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=gold'>
<font class=text_bili>
<input type='text' name='pridejnov' size='8' value=<?echo $pridejnov;?>>
<input type=submit value="pøidej"><br>
</font>
</form>


<br><center>

<h6>Vzít status gold hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=gold'>
<font class=text_bili>
<input type='text' name='ubernov' size='8' value=<?echo $ubernov;?>>
<input type=submit value="proveï"><br>
</font>
</form>



<br>

<center>

<h6>Udìlit status silver hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=gold'>
<font class=text_bili>
<input type='text' name='pridejuci' size='8' value=<?echo $pridejuci;?>>
<input type=submit value="pøidej"><br>
</font>
</form>


<br><center>

<h6>Vzít status silver hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=gold'>
<font class=text_bili>
<input type='text' name='uberuci' size='8' value=<?echo $uberuci;?>>
<input type=submit value="proveï"><br>
</font>
</form>




<br>


<center>

<h6>Udìlit status legenda hráèi:</h6> Nezadávat!! ve vývoji
<form name='form1' method='post' action='hlavni.php?page=gold'>
<font class=text_bili>
<input type='text' name='pridejnov' size='8' value=<?echo $pridejnov;?>>
<input type=submit value="pøidej"><br>
</font>
</form>


<br><center>

<h6>Vzít status legenda hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=gold'>
<font class=text_bili>
<input type='text' name='ubernov' size='8' value=<?echo $ubernov;?>>
<input type=submit value="proveï"><br>
</font>
</form>

<?


		if(isset($pridejnov)):		

				MySQL_Query("update uzivatele set gold='1',bankabudova='1',kontrolabankabudova='1' where jmeno='$pridejnov' ");


		endif;



		if(isset($ubernov)):		


				MySQL_Query("update uzivatele set gold='0' where jmeno='$ubernov' ");


		endif;





		if(isset($pridejuci)):		


				MySQL_Query("update uzivatele set  silver='1',bankabudova='1',kontrolabankabudova='1' where jmeno='$pridejuci' ");


		endif;



		if(isset($uberuci)):		


				MySQL_Query("update uzivatele set  silver='0' where jmeno='$uberuci' ");


		endif;




		

		MySQL_Close($spojeni);
?>


</body>
</html>
