
<?

mysql_query("SET NAMES cp1250");
	$table="borderColor=#ff9900 borderColorDark=#ff9900 borderColorLight=#ffffff";
	$border="border=1";
	$borders="border=1";
	
	if(isset($jmeno)):
		require "data_1.php";
		
		$i=0;
		while($i<10):
			$j=rand(1,4);
			if($j==1):
				$k=rand(48,57);
				$hsl.=chr($k);
			else:
				$k=rand(97,122);
				$hsl.=chr($k);
			endif;	
			$i++;
		endwhile;
			
		$heslo1=md5($hsl);
		$vys1 = MySQL_Query("select * from uzivatele where jmeno='$jmeno'");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		$jmeno=AddSlashes($jmeno);
		$cislo=$zaznam1[cislo];
		//echo "<h1>$heslo1";
		if($zaznam1[kod]==$kod):
			MySQL_Query("update uzivatele set heslo='$heslo1' where cislo=$cislo");
			$zprava="Nov� heslo k loginu $jmeno je $hsl";
			@mail ($zaznam1[email],"Nov� heslo na SG-web",$zprava);
			echo "<h6>Zm�na hesla u loginu $jmeno byla provedena a nov� heslo bylo zasl�no na email " . $zaznam1[email] . ".</h6>";
			//echo "<br>$hsl";
		else:
			echo "<h6>Zadan� registra�n� k�d je chybn�.</h6>";
		endif;	
		MySQL_Close($spojeni);
	endif;
		?>

<center>

<form name='form1' method='post' action='heslozap.php'>


<font class="text_bili"><h1>Zapomenut� heslo</h1></font><br><br>
<font class="text_modry">

Pokud jste zapomn�li sv� heslo, vypl�te formul�� um�st�n� n�e. Budou-li zadan� �daje zpr�vn�, bude vygenerov�n� nov� heslo a zasl�no na email, kter� jste zadal p�i registraci.
</form>

<br><br>
<table id="registrace">
  <tr>
    <td class="a">
	<font class="text_modry">Login:</font> 
    </td>
    <td class="b">
	<input type=text name=jmeno class="input">
    </td>	
  </tr>
  <tr>
    <td class="a">
	<font class="text_modry">Reg. k�d:</font>
    </td>
    <td class="b">
	<input type=text name=kod class="input">
    </td>
  </tr>
  <tr>
    <td colspan=2 class="b" id="reg">
	<input type= submit value=Po�li class="button">
    </td>
  </tr>
</table>
</font>
</center>


