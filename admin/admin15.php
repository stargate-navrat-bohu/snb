<?php

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


		if(isset($nove)):

  
                        

echo "<h6><font class='text_modry'>V</font>�pis bankovn�ch transakc� hr��e ".$ciny." </h6>";

echo "<table border='1'>";
echo "<tr>";

echo "<th>Datum p�evodu</th>";
echo "<th>Typ p�evodu</th>";
echo "<th>P�ev�d�n� ��stka</th>";
echo "<th>Poplatek za p�evod</th>";
echo "<th>V�z�no v bance do</th>";
echo "<th>�rok</th>";
echo "</tr>";



	if(($x<0 or empty($x))){$x=0;};
	$bankatab = MySQL_Query("SELECT * FROM banka where kdojmeno = '$ciny' order by den desc LIMIT $x,20");	
	while($bankatabb = MySQL_Fetch_Array($bankatab)):


        $typ=$bankatabb[typ];
        $castka=$bankatabb[castka];
        $poplatekk=$bankatabb[poplatek];
        $vazano=$bankatabb[vazano];
        $urok=$bankatabb[urok];		
        $datumprevodu=Date("G:i:s j.m.Y",$bankatabb[den]);


echo "<tr>";
echo "<th>".$datumprevodu."</th>";
echo "<th>".$typ."</th>";
echo "<th>".$castka."</th>";
echo "<th>".$poplatekk."</th>";
echo "<th>".$vazano."</th>";
echo "<th>".$urok."</th>";
echo "</tr>";

endwhile;

	echo "</table></center>";

echo "<center>";

	$y=$x+20;
	$z=$x-20;
	echo "<h6><a href=hlavni.php?page=admin15&x=".$z." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>20 nov�j��ch transakc�</a><br>";
	echo "<a href=hlavni.php?page=admin15&x=".$y." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>20 star��ch transakc�</a></h6>";	


		endif;



		if(isset($zbor)):		

                         
                        $den=Date("U");

                        MySQL_Query("update uzivatele set bankabudova='0' where jmeno='$komu'");

                        MySQL_Query("update uzivatele set kontrolabankabudova='0' where jmeno='$komu'");


			MySQL_Query("INSERT INTO log (cil,den,cilt,akce,admin) VALUES ('18','$den','$komu','Zbour�n� banky','$logjmeno')");


			echo "<font class='text_cerveny'>Byla zbour�na banka hr��i ".$komu.".</font>";exit;
                           

		endif;


?>
<h6><font class='text_modry'>K</font>ontrola bankovn�ch p�evod�.</h6>

<h6>Vyhledat hr��e kte�� maj� postavenou banku.</h6>
<form name='form1' method='post' action='hlavni.php?page=admin15'>
<font class=text_bili>
<input type=hidden name=jebanka value=1>
<input type=submit value="najdi"><br>
</font>
</form>



<h6>Postavit banku hr��i:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin15'>
<font class=text_bili>
<input type='text' name='postav_b' size='8' value=<?echo $postav_b;?>>
<input type=submit value="prove�"><br>
</font>
</form>





<?

		if(isset($postav_b)):		

				MySQL_Query("update uzivatele set bankabudova='1',kontrolabankabudova='1' where jmeno='$postav_b' ");


		endif;


		if(isset($jebanka)):



			$vys1c = MySQL_Query("SELECT * FROM uzivatele where bankabudova!=0 or kontrolabankabudova!=0 order by jmeno");	


			echo "<TABLE ".$table." ".$border." width='25%' align=center>";
			echo "<tr>";
			echo "<th colspan=8><font color='FF0D0D'>Majitel� bank</font></th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Jm�no</th>";
			echo "<th>V bance</th>";
			echo "<th>Budova</th>";
			echo "<th>Kontrola</th>";
			echo "<th>Rasa</th>";
			echo "<th>Hotovost</th>";
			echo "<th>Zbourat banku</th>";
			echo "<th>Vypsat bankovn� transakce</th>";
			echo "</tr>";
			while ($zaznam1c = MySQL_Fetch_Array($vys1c)):







                $kdemahledat=$zaznam1c[jmeno];



		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra FROM uzivatele where jmeno='$kdemahledat'");

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



				echo "<tr>";
				echo "<td><a href='hlavni.php?page=posta&komuop=".$zaznam1c[jmeno]."'><font color=".$color.">".$zaznam1c[jmeno]."</font></a></td>";
				echo "<td><font color=".$color.">".$zaznam1c[banka]."</font></td>";
				echo "<td><font color=".$color.">".$zaznam1c[bankabudova]."</font></td>";
				echo "<td><font color=".$color.">".$zaznam1c[kontrolabankabudova]."</font></td>";
				echo "<td><font color=".$color.">".$zaznam1c[rasa]."</font></td>";
				echo "<td><font color=".$color.">".$zaznam1c[penize]."</font></td>";

				echo "<td>
<form name='form1' method='post' action='hlavni.php?page=admin15'>
<input type='hidden' name=komu value='".$zaznam1c[jmeno]."'>
<input type='submit' name='zbor' value='Zbourat'>
</form>
</form></td>";

				echo "<td>
<form name='form1' method='post' action='hlavni.php?page=admin15'>
<input type='hidden' name=ciny value='".$zaznam1c[jmeno]."'>
<input type='submit' name='nove' value='Vypsat'>
</form>
</form></td>";

				echo "</tr>";



			endwhile;
			echo "</table>";


		endif;







echo "<form name='form1' method='post' action='hlavni.php?page=admin15'><h6>Vypsat posledn�ch 20 bankovn�ch transakc� hr��e <input type='text' size='10' name='ciny' value='$ciny'>.</h6>";
echo "<input type=submit name='nove' value='Vypsat'></form>";






		MySQL_Close($spojeni);
?>