<?php
mysql_query("SET NAMES cp1250");
$vysp = MySQL_Query("SELECT nazev,cislo,majitel FROM planety where majitel='$logcislo'");
echo"<form name=\"form1\" >";
echo"<select name=\"planety\">";
while($planety = MySQL_Fetch_Array($vysp)):

 echo  " <option value=\"".$planety[nazev]."\">".$planety[nazev]."</option>";
     
endwhile;
echo"</select>";
echo"<input type=\"submit\" name=\"Submit\" value=\"Prodat\">
</form>";
?>
