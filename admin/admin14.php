<?

	
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
mysql_query("SET NAMES cp1250");
?>


<h6>Vyhledat hráèe se statusem nováèek</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type=hidden name=novac value=1>
<input type=submit value="najdi"><br>
</font>
</form>

<?


		if(isset($novac)):		
  $vys1=MySQL_Query("SELECT jmeno,statusnovacek,rasa,statusextra FROM uzivatele where statusnovacek!='0' ");
  $zaznam2=MySQL_Fetch_Array($vys1);

  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jméno</th>";
	echo "<th colspan=1><font color=white>Stav</th>";
	echo "<th colspan=1><font color=white>Rasa</th>";
	echo "</tr>";

echo "</tr>";


while ($zaznam1=MySQL_Fetch_Array($vys1)) {

                $kdemahledat=$zaznam1[jmeno];


		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);



$stat2=$rot["stat"];

if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#FF6600";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
else{
$color="#626CC6";
}


if($nnnnn["admin"]=="1"){
$color="#01BAFF";
}

if($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}

if($nnnnn["statusnovacek"]=="1"){
$color="#2DF96B";
}


echo "<tr>";
echo "<th><font color=white><font color=".$color.">".$zaznam1[jmeno]."</th>";
echo "<th><font color=white>".$zaznam1[statusnovacek]."</th>";
echo "<th><font color=white>".$zaznam1[rasa]."</th>";
echo "</tr>";
}							
  echo "</table>";exit;
		endif;

?>









<h6>Vyhledat hráèe se statusem povýdkáø</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type=hidden name=povydkar value=1>
<input type=submit value="najdi"><br>
</font>
</form>

<?


		if(isset($povydkar)):		
  $vys1=MySQL_Query("SELECT jmeno,statusnovacek,rasa,povydkar FROM uzivatele where povydkar!='0' ");
  $zaznam2=MySQL_Fetch_Array($vys1);

  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jméno</th>";
	echo "<th colspan=1><font color=white>Stav</th>";
	echo "<th colspan=1><font color=white>Rasa</th>";
	echo "</tr>";

echo "</tr>";

$counter = 0;
while ($zaznam1=MySQL_Fetch_Array($vys1)) {

                $kdemahledat=$zaznam1[jmeno];


		$vvvvv = MySQL_Query("SELECT status,admin,povydkar FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);



$stat2=$rot["stat"];

if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#FF6600";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
else{
$color="#626CC6";
}


if($nnnnn["admin"]=="1"){
$color="#01BAFF";
}



echo "<tr>";
echo "<th><font color=white><font color=".$color.">".$zaznam1[jmeno]."</th>";
echo "<th><font color=white>".$zaznam1[povydkar]."</th>";
echo "<th><font color=white>".$zaznam1[rasa]."</th>";
echo "</tr>";
$counter++;
}							

  echo "</table>";exit;
		endif;


?>






<h6>Vyhledat hráèe se statusem novináø</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type=hidden name=novinar1 value=1>
<input type=submit value="najdi"><br>
</font>
</form>

<?


if(isset($novinar1)){		
  $vys1=MySQL_Query("SELECT jmeno,status,rasa,admin FROM uzivatele where novinar>0");

  $sql = "SELECT `rasa`, `nazevrasy` FROM `rasy`";
  $result = mysql_query($sql);
  while($row=mysql_fetch_array($result)){
    $rasa[$row["rasa"]] = $row["nazevrasy"];
  }
  
  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jméno</th>";
	echo "<th colspan=1><font color=white>Rasa</th>";
	echo "</tr>";

  $color[0] = "#626CC6";
  $color[1] = "#FFFF00";
  $color[2] = "#FFFFFF";
  $color[3] = "#B48223";
  $color[4] = "#555555";
  $color[5] = "#FF6600";
  $color[6] = "#01BAFF";

  while ($zaznam1=MySQL_Fetch_Array($vys1)) {
    $colors = $color;
    if($nnnnn["admin"]=="1"){
      $colors[0] = "#01BAFF";
      $colors[1] = "#01BAFF";
      $colors[2] = "#01BAFF";
      $colors[3] = "#01BAFF";
      $colors[4] = "#01BAFF";
      $colors[5] = "#01BAFF";
      $colors[6] = "#01BAFF";
    }

    echo "<tr>";
    echo "<th><font color=white><font color=".$colors[$status].">".$zaznam1[jmeno]."</th>";
    echo "<th><font color=white>".$rasa[$zaznam1["rasa"]]."</th>";
    echo "</tr>";
  
  }							
  echo "</table>";
}

?>





<h6>Vyhledat hráèe se statusem extra</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type=hidden name=statusektra value=1>
<input type=submit value="najdi"><br>
</font>
</form>

<?


		if(isset($statusektra)):		
  $vys1=MySQL_Query("SELECT jmeno,statusnovacek,rasa,statusextra FROM uzivatele where statusextra!='0' ");
  $zaznam2=MySQL_Fetch_Array($vys1);

  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jméno</th>";
	echo "<th colspan=1><font color=white>Stav</th>";
	echo "<th colspan=1><font color=white>Rasa</th>";
	echo "</tr>";

echo "</tr>";


while ($zaznam1=MySQL_Fetch_Array($vys1)) {

                $kdemahledat=$zaznam1[jmeno];


		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);



$stat2=$rot["stat"];

if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#FF6600";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
else{
$color="#626CC6";
}


if($nnnnn["admin"]=="1"){
$color="#01BAFF";
}

if($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}


echo "<tr>";
echo "<th><font color=white><font color=".$color.">".$zaznam1[jmeno]."</th>";
echo "<th><font color=white>".$zaznam1[statusextra]."</th>";
echo "<th><font color=white>".$zaznam1[rasa]."</th>";
echo "</tr>";
}							

		endif;


?>

<h6>Vyhledat hráèe se statusem uèitel</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type=hidden name=statusucitel value=1>
<input type=submit value="najdi"><br>
</font>
</form>

<?

		if(isset($statusucitel)):



			$vys1c = MySQL_Query("SELECT * FROM uzivatele where statusucitel!=0 order by jmeno");	


			echo "<TABLE ".$table." ".$border." width='25%' align=center>";
			echo "<tr>";
			echo "<th colspan=3><font color='FF0D0D'>uèitelé</font></th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>jméno</th>";
			echo "<th>rasa</th>";
			echo "<th>Poèet planet</th>";
			echo "</tr>";
			while ($zaznam1c = MySQL_Fetch_Array($vys1c)):







                $kdemahledat=$zaznam1c[jmeno];



		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra,statusucitel FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);


$stat2=$nnnnn["status"];

if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#FF6600";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
else{
$color="#626CC6";
}

if($nnnnn["admin"]=="1"){
$color="#01BAFF";
}

if($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}

if($nnnnn["statusnovacek"]=="1"){
$color="#2DF96B";
}

if($nnnnn["statusucitel"]=="1"){
$color="#FF0D0D";
}		



				echo "<tr>";
				echo "<td><a href='hlavni.php?page=posta&komuop=".$zaznam1c[jmeno]."'><font color=".$color.">".$zaznam1c[jmeno]."</font></a></td>";
				echo "<td><font color=".$color.">".$zaznam1c[rasa]."</font></td>";
				echo "<td><font color=".$color.">".$zaznam1c[planety]."</font></td>";
				echo "</tr>";

			endwhile;
			echo "</table>";


		endif;


?>

<h6>Vyhledat hráèe se statusem moderátor</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type=hidden name=statusmoderator value=1>
<input type=submit value="najdi"><br>
</font>
</form>

<?


		if(isset($statusmoderator)):		
  $vys1=MySQL_Query("SELECT jmeno,statusmoderator,rasa,statusextra FROM uzivatele where statusmoderator!='0' ");

  echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jméno</th>";
	echo "<th colspan=1><font color=white>Stav</th>";
	echo "<th colspan=1><font color=white>Rasa</th>";
	echo "</tr>";

echo "</tr>";


while ($zaznam1=MySQL_Fetch_Array($vys1)) {

                $kdemahledat=$zaznam1[jmeno];
		$vvvvv = MySQL_Query("SELECT status,admin,statusmoderator,statusextra FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);


if($nnnnn["admin"]=="1"){
$color="#01BAFF";
}

if($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}

if($nnnnn["statusmoderator"]=="1"){
$color="#2DF96B";
}


echo "<tr>";
echo "<th><font color=white><font color=".$color.">".$zaznam1[jmeno]."</th>";
echo "<th><font color=white>".$zaznam1[statusmoderator]."</th>";
echo "<th><font color=white>".$zaznam1[rasa]."</th>";
echo "</tr>";
}							
  echo "</table>";exit;
		endif;

?>



<br><center>

<h6>Udìlit status povýdkáø hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='povydk' size='8' value=<?echo $povydk;?>>
<input type=submit value="proveï"><br>
</font>
</form>

<br><center>

<h6>Status novináø hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='novinar' size='8' value=<?echo $novinar;?>>
<input type=submit value="Pøidat" name="pridej"> <input type=submit value="Odebrat" name="odebrat"><br>
</font>
</form>


<br>


<center>

<h6>Udìlit status nováèek hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='pridejnov' size='8' value=<?echo $pridejnov;?>>
<input type=submit value="pøidej"><br>
</font>
</form>


<br><center>

<h6>Vzít status nováèek hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='ubernov' size='8' value=<?echo $ubernov;?>>
<input type=submit value="proveï"><br>
</font>
</form>



<br>


<center>

<h6>Udìlit status extra hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='pridejek' size='8' value=<?echo $pridejek;?>>
<input type=submit value="pøidej"><br>
</font>
</form>


<br><center>

<h6>Vzít status extra hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='uberek' size='8' value=<?echo $uberek;?>>
<input type=submit value="proveï"><br>
</font>
</form>



<br>


<center>

<h6>Udìlit status uèitel hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='pridejuci' size='8' value=<?echo $pridejuci;?>>
<input type=submit value="pøidej"><br>
</font>
</form>


<br><center>

<h6>Vzít status uèitel hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='uberuci' size='8' value=<?echo $uberuci;?>>
<input type=submit value="proveï"><br>
</font>
</form>
<br>


<center>

<h6>Udìlit status moderátor hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='pridejmod' size='8' value=<?echo $pridejmod;?>>
<input type=submit value="pøidej"><br>
</font>
</form>


<br><center>

<h6>Vzít status moderator hráèi:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin14'>
<font class=text_bili>
<input type='text' name='ubermod' size='8' value=<?echo $ubermod;?>>
<input type=submit value="proveï"><br>
</font>
</form>



<?

		if(isset($povydk)):		

                                $stats=1;

				MySQL_Query("update uzivatele set povydkar=$stats where jmeno='$povydk' ");


		endif;
		
		if(isset($novinar)):
      if(isset($pridej)){
        $stats=1;        
      } else{
        $stats=0;
      }
      MySQL_Query("update uzivatele set novinar=$stats where jmeno='$novinar' ");
		endif;


		if(isset($pridejnov)):		

                                $stats=1;

				MySQL_Query("update uzivatele set statusnovacek=$stats where jmeno='$pridejnov' ");


		endif;



		if(isset($ubernov)):		

                                $stats=0;

				MySQL_Query("update uzivatele set statusnovacek=$stats where jmeno='$ubernov' ");


		endif;






		if(isset($pridejek)):		

                                $stats=1;

				MySQL_Query("update uzivatele set statusnovacek=$stats where jmeno='$pridejek' ");


		endif;



		if(isset($uberek)):		

                                $stats=0;

				MySQL_Query("update uzivatele set statusnovacek=$stats where jmeno='$uberek' ");


		endif;


		if(isset($pridejuci)):		

                                $statsv=1;

				MySQL_Query("update uzivatele set  statusucitel=$statsv where jmeno='$pridejuci' ");


		endif;



		if(isset($uberuci)):		

                                $statsv=0;

				MySQL_Query("update uzivatele set  statusucitel=$statsv where jmeno='$uberuci' ");


		endif;
		
		if(isset($pridejmod)):		

                                $statmod=1;

				MySQL_Query("update uzivatele set  statusmoderator=$statmod where jmeno='$pridejmod' ");


		endif;



		if(isset($ubermod)):		

                                $statmod=0;

				MySQL_Query("update uzivatele set  statusmoderator=$statmod where jmeno='$ubermod' ");


		endif;




		

		MySQL_Close($spojeni);
?>


</body>
</html>
