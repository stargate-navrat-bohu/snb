<?

	require("adkontrola.php");
mysql_query("SET NAMES cp1250");

	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	

if($zaloz){
if($zaltema!="" and $zaltema!="Vlo�te n�zev"){
$zaltema=HTMLSpecialChars($zaltema);
$zaltema=Str_Replace("\r\n","<br>",$zaltema);
$zaltema=NL2BR($zaltema);

$vlozeno=Date("U");


$ochrana = "1*";
if($_POST["moderator"] == "on"){ $ochrana .= "1*"; } else { $ochrana .= "0*"; }
if($_POST["vudce"] == "on"){ $ochrana .= "1*"; } else { $ochrana .= "0*"; }
if($_POST["vlada"] == "on"){ $ochrana .= "1*"; } else { $ochrana .= "0*"; }
if($_POST["povidkar"] == "on"){ $ochrana .= "1*"; } else { $ochrana .= "0*"; }
if($_POST["gas"] == "on"){ $ochrana .= "1*"; } else { $ochrana .= "0*"; }
if($_POST["novinar"] == "on"){ $ochrana .= "1*"; } else { $ochrana .= "0*"; }
if($_POST["vsichni"] == "on"){ $ochrana .= "1"; } else { $ochrana .= "0"; }

echo $_POST["moderator"]."<br />";
echo $ochrana;

MySQL_Query ("INSERT INTO forum_mistnosti VALUES('$kde','$zaltema','$vlozeno','$typ','1','$autor','$statusa','$blab', '$ochrana')");


echo MySQL_Error();
}
else{echo "<script language=\"JavaScript\">\n alert(\"Mus�te zadat n�zev.\")\n </script>\n<script languague='JavaScript'>location.href='hlavni.php?page=vytv_for'</script>";
}
}


echo "
<font class='text_bili'>
<form method='post' name='enter' action=hlavni.php?page=vytv_for><input type='hidden' value='".$logjmeno."' name='autor'>
<table style='width: 100%;'>
  <tr>
    <td style='text-align: right'>
      Zalo�it novou m�stnost
    </td>
    <td>
     <input type='text' value='Vlo�te n�zev' style=\"color: #0099FF\" size=25 name='zaltema' class='input'>
    </td>
  </tr>
  <tr>
    <td style='text-align: right'>
      Typ f�ra
    </td>
    <td style='text-align: left'>
<select name='typ' class='select'>
<option value=x>Vyberte</option>
<option value=1>Syst�mov�</option>
<option value=2>Diskuzn�</option>
<option value=3>Z�bava</option>
</select>
    </td>
  </tr>
";

echo "
  <tr>
    <td style='text-align: right'>
      P��stupnost
    </td>
    <td style='text-align: left'>
<select name='statusa' class='select'>
<option value=x>Vyberte</option>
<option value=1>V�em</option>
<option value=2>Vl�d�</option>
<option value=3>V�dc�m</option>
<option value=4>Admin�m</option>
<option value=5>Pov�dk���m</option>
<option value=6>Gold hr���m</option>
<option value=7>Novin���m</option>
<option value=8>Moder�tor�m</option>
</select>
    </td>
  </tr>
  <tr>
    <td style='text-align: right'>
      P��stupnost
    </td>
    <td style='text-align: left'>  
<select name='blab' class='select'>
<option value=x>Vyberte</option>
<option value=1>V�em</option>
<option value=2>Pouze dan� rase</option>
</select>
    </td>
  </tr>
  <tr>
    <td style='text-align: right'>
      M��e ps�t:
    </td>
    <td style='text-align: left'>  
      <input type='checkbox' name='moderator'> Moderator | <input type='checkbox' name='vudce'> V�dce | <input type='checkbox' name='vlada'> Vl�da | <br />
      <input type='checkbox' name='povidkar'> Pov�dk�r | <input type='checkbox' name='gas'> Gold a Silver | <input type='checkbox' name='novinar'> Novin�� | <input type='checkbox' name='vsichni'> V�ichni |
    </td>
  </tr>
  <tr>
    <td style='text-align: right'>
      Zadejte zkratku fora (3 znaky)
    </td>
    <td style='text-align: left'>
      <input type='text' value='xxx' style=\"color: #0099FF\" size=3 name='kde' class='input' maxlength='3'>
    </td>
  </tr> 
  <tr>
    <td colspan=2 style='text-align: center'>
      <input type='submit' style=\"color: #0099FF\" value='Zalo�it' name=zaloz class='button'>
    </td>
  </tr>


</table>

 N�vod jak vytvo�it f�rum tak aby bylo funk�n� se sou�asn�m syst�mem na SG-nb<br />
 1) Syst�mov� for� mohou b�t nastavena: V�em,Vl�d�,V�dc�m,Admin�m,Pv�dk���m. Mus� b�t nastavena p��stupnost na V�em<br />
 2) Diskuzn� for� mohou b�t nastavena: V�em - V�em; Vl�d� - V�em,Rase; V�dc�m - V�em,Rase; Adminum - V�em Pov�dk���m - V�em<br />
 3) Z�bavn� fora mohou b�t nastavena: V�em,Vl�d�,V�dc�m,Admin�m,Po�dk���m,Gold hr���m,Novin���m a to v�em<br />
</form>
</font>";

?>
