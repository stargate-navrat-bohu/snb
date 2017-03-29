<?php
$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho,admin FROM uzivatele where cislo = '$logcislo'");	
$zaznam1 = MySQL_Fetch_Array($vys1);	
	
require("adkontrola.php");
//mysql_query("SET NAMES cp1250");	
?>
<font class='text_bili'>Vypsat �inny hr��e:</font>
<form name='form1' method='post' action='hlavni.php?page=admin10'>
<input type='text' name='kdov' value="">
<input type=submit value="hledej">
</form>

<form name='form1' method='post' action='hlavni.php?page=admin10'>
<select name="prasa">
<option value="0"></option>
<?php
//value = ".$zaznam4[rasa]."
	$i=1;
	$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa != 20");
	while ($zaznam4 = MySQL_Fetch_Array($vys4)):
		$i++;

echo "<option value='".$zaznam4["rasa"]."'";
if ($prasa==$zaznam4["rasa"]) {echo " selected";}
echo ">".$zaznam4["nazevrasy"]."</option>";
		$rasaxx[]=$zaznam4["nazevrasy"];
	endwhile;

?>
</select>
<input type=submit value="zobraz">
</form>
<?php

	if(($x<0 or empty($x))){$x=0;};
	$ciny2 = MySQL_Query("SELECT * FROM ciny where rasa = $prasa ORDER BY cas DESC LIMIT $x,30");
        $cinykd = MySQL_Query("SELECT * FROM ciny where kdo='$kdov' ORDER BY cas DESC LIMIT $x,15");
	echo "<center>";			
	echo "<TABLE ".$table." ".$border." width=90%>";
	echo "<tr>";
	echo "<th>�as</th>";
	echo "<th>kdo (status)</th>";	
	echo "<th>�in</th>";		
	echo "</tr>";


if ($prasa!=0 and $kdov=="") 
  {
	while($ciny = MySQL_Fetch_Array($ciny2)):	
		$cas=Date("G:i:s j.m.Y",$ciny["cas"]);;
		switch($ciny[status]){
			case 1 :$status="v�dce";break;
			case 2 :$status="z�stupce";break;
			case 3 :$status="asistent";break;
			case 4 :$status="vyhnanec";break;
			case 5 :$status="ministr";break;
			default: $status="ob�an";
		};
		switch($ciny[cin]){
			case 1 :$cin="P�ijmul vyvrhela $ciny[koho]";break;
			case 2 :$cin="Vyhodil k vyvrhel�m hr��e $ciny[koho]";break;
			case 3 :$cin="Poslal hr��i $ciny[koho] $ciny[cislo] NAQ";break;
			case 4 :$cin="Poslal rase $ciny[koho] $ciny[cislo] NAQ";break;
			case 5 :$cin="Poslal hr��i $ciny[koho] jednotky v hodnot� ".number_format($ciny[cislo],1,"."," ")." NAQ";break;			
			case 6 :$cin="Poslal do fondu $ciny[cislo] NAQ";break;			
			case 7 :$cin="Poslal do rasov� arm�dy jednotky v hodnot� ".number_format($ciny[cislo],1,"."," ")." NAQ";break;						
		};
		echo "<tr>";		
		echo "<td>$cas</td>";
		echo "<td>$ciny[kdo] ($status)</td>";	
		echo "<td>$cin</td>";				
		echo "</tr>";		
	endwhile;
  }



if ($kdov!="")
  {
	while($cinyk = MySQL_Fetch_Array($cinykd)):	
		$cas=Date("G:i:s j.m.Y",$cinyk["cas"]);;
		switch($cinyk[status]){
			case 1 :$status="v�dce";break;
			case 2 :$status="z�stupce";break;
			case 3 :$status="asistent";break;
			case 4 :$status="vyhnanec";break;
			case 5 :$status="ministr";break;
			default: $status="ob�an";
		};
		switch($cinyk[cin]){
			case 1 :$cin="P�ijmul vyvrhela $cinyk[koho]";break;
			case 2 :$cin="Vyhodil k vyvrhel�m hr��e $cinyk[koho]";break;
			case 3 :$cin="Poslal hr��i $cinyk[koho] $cinyk[cislo] NAQ";break;
			case 4 :$cin="Poslal rase $cinyk[koho] $ciny[cislo] NAQ";break;
			case 5 :$cin="Poslal hr��i $cinyk[koho] jednotky v hodnot� ".number_format($cinyk[cislo],1,"."," ")." NAQ";break;			
			case 6 :$cin="Poslal do fondu $cinyk[cislo] NAQ";break;			
			case 7 :$cin="Poslal do rasov� arm�dy jednotky v hodnot� ".number_format($cinyk[cislo],1,"."," ")." NAQ";break;						
		};
		echo "<tr>";		
		echo "<td>$cas</td>";
		echo "<td>$cinyk[kdo] ($status)</td>";	
		echo "<td>$cin</td>";				
		echo "</tr>";		
	endwhile;
  }

	echo "</table></center>";

if ($prasa!=0 and $kdov=="") 
  {
	$y=$x+30;
	$z=$x-30;
	echo "<h6><a href=hlavni.php?page=admin10&x=".$z."&vyber=2&prasa=".$prasa." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>30 nov�j��ch �in�</a><br>";
	echo "<a href=hlavni.php?page=admin10&x=".$y."&vyber=2&prasa=".$prasa." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>30 star��ch �in�</a></h6>";
}

if ($kdov!="") 
  {
	$y=$x+15;
	$z=$x-15;
	echo "<h6><a href=hlavni.php?page=admin10&x=".$z."&vyber=2&prasa=".$prasa."&kdov=".$kdov." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>15 nov�j��ch �in� tohoto hr��e</a><br>";
	echo "<a href=hlavni.php?page=admin10&x=".$y."&vyber=2&prasa=".$prasa."&kdov=".$kdov." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>15 star��ch �in� tohoto hr��e</a></h6>";
}

MySQL_Close($spojeni);		
