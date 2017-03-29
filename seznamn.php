
<?
		require("data_1.php");
mysql_query("SET NAMES cp1250");		
?>

<center>

<font class=text_bili>Seznam a statistiky vašich nováèkù</font><br><br>

<?

		if(isset($odeberucitele)):		


				MySQL_Query("update uzivatele set tvujucitel='nemá',masnemas='0' WHERE jmeno = '$nevim' ");

$vlozeno=Date("U");
$odesilatel=$logjmeno;

$text="Váš uèitele ".$odesilatel.", Vám dal výpovìï z nám neznámého dùvodu, pokud je Vaším pøáním ho znát pište pøímo jemu dìkujeme.";

$adresat=$nevim;
$cislorasy=$zaznam1[rasa];
$nazev="Váš uèitel Vás pøestává uèit";

		$rasa1 = MySQL_Query("SELECT * FROM rasy where rasa='$cislorasy'");
		$rasa11 = MySQL_Fetch_Array($rasa1);

$rasa=$rasa11[nazevrasy];


		$rasa1b = MySQL_Query("SELECT * FROM uzivatele where jmeno='$nevim'");
		$rasa11b = MySQL_Fetch_Array($rasa1);

$cislorasyb=$rasa11b[rasa];

		$rasa2 = MySQL_Query("SELECT * FROM rasy where rasa='$cislorasyb'");
		$rasa22 = MySQL_Fetch_Array($rasa1);

$rasab=$rasa22[nazevrasy];
	

		$vys9 = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$nevim'");
		$zaznam9 = MySQL_Fetch_Array($vys9);

$p=$zaznam9["posta"]+1;	

MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,rasa2,text,stav,nepr,typ,smaz) VALUES ($vlozeno,'$odesilatel','$adresat','$nazev','$rasa','$rasab','$text','1','1','1','0')");

MySQL_Query("update uzivatele set posta = '$p' where jmeno = '$adresat'");

                           
echo "<script languague='JavaScript'>location.href='hlavni.php?page=seznamn'</script>";

		endif;




echo "<table border='1'>";

echo "<tr>";
echo "<th colspan=6><font class=text_bili>Vaši nováèci</font></th>";
echo "</tr>";

echo "<tr>";
echo "<th><font class=text_modry>Jméno</font></th>";
echo "<th><font class=text_modry>Planety</font></th>";
echo "<th><font class=text_modry>Síla</font></th>";
echo "<th><font class=text_modry>Online</font></th>";
echo "<th><font class=text_modry>Èas na sg</font></th>";
echo "<th><font class=text_modry>Vzdát se nováèka</font></th>";
echo "</tr>";

$novack = MySQL_Query("SELECT jmeno,planety,sila,casnasg FROM uzivatele where tvujucitel ='$logjmeno' ");
		while($novackk = MySQL_Fetch_Array($novack)):

			        $onlinebone = MySQL_Query("SELECT jmeno FROM online where jmeno='$novackk[jmeno]' ");
			        $zaznam55f = MySQL_Fetch_Array($onlinebone);

$noveff=$zaznam55f[jmeno];
$novefe=$novackk[jmeno];

           $onlinenebone=ANO;
if($noveff!=$novefe){$onlinenebone=NE;}

echo "<tr>";
echo "<th><font class=text_modry>".$novackk[jmeno]."</font></th>";
echo "<th><font class=text_bili>".$novackk[planety]."</font></th>";
echo "<th><font class=text_bili>".$novackk[sila]."</font></th>";
echo "<th><font class=text_bili>".$onlinenebone."</font></th>";
echo "<th><font class=text_bili>".$novackk[casnasg]."</font></th>";
echo "<th><font class=text_bili><form name='form1' method='post' action='hlavni.php?page=seznamn'>
<input type='hidden' name='nevim' value='".$novackk[jmeno]."'>
<input type='submit' name='odeberucitele' value='Vzdát'></form></font></th>";
echo "</tr>";


endwhile;

?>

</table>