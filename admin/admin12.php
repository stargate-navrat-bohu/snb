<?
	


	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	

  $id=$REMOTE_ADDR;

	require("adkontrola.php");
mysql_query("SET NAMES cp1250");

?>

<?
	if($zaznam1[admin]==2){echo "<h1>Sem nemaj� pomocn� admin� p��stup!</h1>";exit;}



	if(isset($ban)):
    	$vys2 = MySQL_Query("SELECT jmeno FROM uzivatele where ip = '$ban'");	
    	$zaznam2 = MySQL_Fetch_Array($vys2);
      $cas=Date("U");
			MySQL_Query("insert into ban (cas,IP,jmeno,kdo) values ($cas,'$ban','$zaznam2[jmeno]','$zaznam1[jmeno]')");
	endif;	
	if(isset($banname)):
      $cas=Date("U");
			MySQL_Query("insert into ban (cas,ip,jmeno,kdo) values ($cas,'0','$banname','$zaznam1[jmeno]')");
	endif;	
	if(isset($povol)):
		MySQL_Query("delete from ban where cas=$povol");				
	endif;

?>
<h6><font class='text_modry'>Z</font>amezen� p��stup� na Sg-nb</h6>
<form name='form' method='post' action='hlavni.php?page=admin12'>
<h6>Zak�zat p��stup z IP :
<input type=text name=ban><input type=submit value="P�idej IP">
</form>
<b>Zak�e vstup na Sg-nb v�em hr���m ze zadan� IP adresy.</b>
<form name='form' method='post' action='hlavni.php?page=admin12'>
<h6>Zak�zat p��stup hr��i :
<input type=text name=banname><input type=submit value="P�idej hr��e">
</form>
<b>Zak�e vstup na Sg-nb zadan�mu hr��i (IP nem� ��dn� vliv).</b>

<h6><font class='text_modry'>Z</font>abanovan� IP</h6>
<?echo "<TABLE ".$table." ".$border." >";?>
<tr>
<th>datum</th>
<th>IP</th>
<th>Jm�no</th>
<th>Zak�zal</th>
<th>Znovu povolit</th>
</tr> 
<?
  $vys3 = MySQL_Query("SELECT cas,ip,jmeno,kdo FROM ban order by jmeno");	
while($bn = MySQL_Fetch_Array($vys3)):
	$cas=Date("G:i:s j.m.Y",$bn[cas]);
	echo "<td>$cas</td>";
	echo "<td>$bn[ip]</td>";
	echo "<td>$bn[jmeno]</td>";
	echo "<td>$bn[kdo]</td>";
	echo "<form name='form123' method='post' action='hlavni.php?page=admin12'>";	
	echo "<td><input type=submit value='povolit'>&nbsp;";
	echo "<input type=hidden name='povol' value=$bn[cas]></td></form>";
	echo "</tr>";
endwhile;
echo "</table>";	





	if(isset($ban2)):
    	$vys2 = MySQL_Query("SELECT jmeno FROM uzivatele where ip = '$ban2'");	
    	$zaznam2 = MySQL_Fetch_Array($vys2);
      $cas=Date("U");
			MySQL_Query("insert into banfor (cas,IP,jmeno,kdo) values ($cas,'$ban2','$zaznam2[jmeno]','$zaznam1[jmeno]')");
	endif;	
	if(isset($ban2name)):
      $cas=Date("U");
			MySQL_Query("insert into banfor (cas,ip,jmeno,kdo) values ($cas,'0','$ban2name','$zaznam1[jmeno]')");
	endif;	
	if(isset($povol)):
		MySQL_Query("delete from banfor where cas=$povol");				
	endif;

?>
<h6><font class='text_modry'>Z</font>amezen� p��stup� na forum</h6>
<form name='form' method='post' action='hlavni.php?page=admin12'>
<h6>Zak�zat p��stup z IP :
<input type=text name=ban2><input type=submit value="P�idej IP">
</form>
<b>Zak�e vstup na Sg-nb forum v�em hr���m ze zadan� IP adresy.</b>
<form name='form' method='post' action='hlavni.php?page=admin12'>
<h6>Zak�zat p��stup hr��i :
<input type=text name=ban2name><input type=submit value="P�idej hr��e">
</form>
<b>Zak�e vstup na forum zadan�mu hr��i (IP nem� ��dn� vliv).</b>

<h6><font class='text_modry'>Z</font>abanovan� IP</h6>
<?echo "<TABLE ".$table." ".$border." >";?>
<tr>
<th>datum</th>
<th>IP</th>
<th>Jm�no</th>
<th>Zak�zal</th>
<th>Znovu povolit</th>
</tr> 
<?
  $vys3 = MySQL_Query("SELECT cas,ip,jmeno,kdo FROM banfor order by jmeno");	
while($bn = MySQL_Fetch_Array($vys3)):
	$cas=Date("G:i:s j.m.Y",$bn[cas]);
	echo "<td>$cas</td>";
	echo "<td>$bn[ip]</td>";
	echo "<td>$bn[jmeno]</td>";
	echo "<td>$bn[kdo]</td>";
	echo "<form name='form123' method='post' action='hlavni.php?page=admin12'>";	
	echo "<td><input type=submit value='povolit'>&nbsp;";
	echo "<input type=hidden name='povol' value=$bn[cas]></td></form>";
	echo "</tr>";
endwhile;
echo "</table>";		

	
?>
</body>
</html>
