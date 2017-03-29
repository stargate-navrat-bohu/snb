
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
			$zprava="Nové heslo k loginu $jmeno je $hsl";
			@mail ($zaznam1[email],"Nové heslo na SG-web",$zprava);
			echo "<h6>Zmìna hesla u loginu $jmeno byla provedena a nové heslo bylo zasláno na email " . $zaznam1[email] . ".</h6>";
			//echo "<br>$hsl";
		else:
			echo "<h6>Zadaný registraèní kód je chybný.</h6>";
		endif;	
		MySQL_Close($spojeni);
	endif;
		?>

<center>

<form name='form1' method='post' action='heslozap.php'>


<font class="text_bili"><h1>Zapomenuté heslo</h1></font><br><br>
<font class="text_modry">

Pokud jste zapomnìli své heslo, vyplòte formuláø umístìní níže. Budou-li zadané údaje zprávné, bude vygenerováné nové heslo a zasláno na email, který jste zadal pøi registraci.
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
	<font class="text_modry">Reg. kód:</font>
    </td>
    <td class="b">
	<input type=text name=kod class="input">
    </td>
  </tr>
  <tr>
    <td colspan=2 class="b" id="reg">
	<input type= submit value=Pošli class="button">
    </td>
  </tr>
</table>
</font>
</center>


