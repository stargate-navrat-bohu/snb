<form action="pp.php" method="get"><input type="text" name="planety"><input type="hidden" name="sent" value="1"><input type="submit"></form>
<?php
mysql_query("SET NAMES cp1250");
	require "data_1.php";
	if ($sent==1) {
	echo "<table border=\"1\">";
	$vys1 = MySQL_Query("SELECT * FROM utok where planety='$planety' ORDER BY den DESC");
	  echo "<tr>";
	  echo "<td>Datum</td>";
	  echo "<td>Utocnik</td>";
	  echo "<td>Obrance</td>";
	  echo "<td>Planeta</td>";  
	  echo "<td>Vysledek</td>";
	  echo "<td>Typ</td>";  	  
 	  echo "<td>ujed1</td>";
	  echo "<td>ujed2</td>";
	  echo "<td>ujed5</td>";
	  echo "<td>ojed1</td>";  
	  echo "<td>ojed2</td>";  
	  echo "<td>ojed5</td>";    	  	  	  
	  echo "</tr>";
	while ($vys = MySQL_Fetch_Array($vys1)) {
	  echo "<tr>";
	  $datum = Date("G:i:s j.m.Y",$vys["den"]);
	  echo "<td>" . $datum . "</td>";
	  echo "<td>" . $vys[utocnik] . "</td>";
	  echo "<td>" . $vys[obrance] . "</td>";
	  echo "<td>" . $vys[planety] . "</td>";	  
	  echo "<td>" . $vys[uspesnost] . "</td>";	  
	  echo "<td>" . $vys[typ] . "</td>";
	  echo "<td>" . $vys[ujed1] . "</td>";	  	  
	  echo "<td>" . $vys[ujed2] . "</td>";	  	    	  
	  echo "<td>" . $vys[ujed5] . "</td>";	  	  	  	  	  
	  echo "<td>" . $vys[ojed1] . "</td>";	  	  
	  echo "<td>" . $vys[ojed2] . "</td>";	  	   	  
	  echo "<td>" . $vys[ojed5] . "</td>";	  	
	  echo "</tr>";
	}
   echo "</table>"	;
   }
   MySQL_Close($spojeni);		
?>
