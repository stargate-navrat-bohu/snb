<?

	require("adkontrola.php");
mysql_query("SET NAMES cp1250");

	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	

if($zaloz){
if($zaltema!="" and $zaltema!="Vložte název"){
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
else{echo "<script language=\"JavaScript\">\n alert(\"Musíte zadat název.\")\n </script>\n<script languague='JavaScript'>location.href='hlavni.php?page=vytv_for'</script>";
}
}


echo "
<font class='text_bili'>
<form method='post' name='enter' action=hlavni.php?page=vytv_for><input type='hidden' value='".$logjmeno."' name='autor'>
<table style='width: 100%;'>
  <tr>
    <td style='text-align: right'>
      Založit novou místnost
    </td>
    <td>
     <input type='text' value='Vložte název' style=\"color: #0099FF\" size=25 name='zaltema' class='input'>
    </td>
  </tr>
  <tr>
    <td style='text-align: right'>
      Typ fóra
    </td>
    <td style='text-align: left'>
<select name='typ' class='select'>
<option value=x>Vyberte</option>
<option value=1>Systémové</option>
<option value=2>Diskuzní</option>
<option value=3>Zábava</option>
</select>
    </td>
  </tr>
";

echo "
  <tr>
    <td style='text-align: right'>
      Pøístupnost
    </td>
    <td style='text-align: left'>
<select name='statusa' class='select'>
<option value=x>Vyberte</option>
<option value=1>Všem</option>
<option value=2>Vládì</option>
<option value=3>Vùdcùm</option>
<option value=4>Adminùm</option>
<option value=5>Povýdkáøùm</option>
<option value=6>Gold hráèùm</option>
<option value=7>Novináøùm</option>
<option value=8>Moderátorùm</option>
</select>
    </td>
  </tr>
  <tr>
    <td style='text-align: right'>
      Pøístupnost
    </td>
    <td style='text-align: left'>  
<select name='blab' class='select'>
<option value=x>Vyberte</option>
<option value=1>Všem</option>
<option value=2>Pouze dané rase</option>
</select>
    </td>
  </tr>
  <tr>
    <td style='text-align: right'>
      Mùže psát:
    </td>
    <td style='text-align: left'>  
      <input type='checkbox' name='moderator'> Moderator | <input type='checkbox' name='vudce'> Vùdce | <input type='checkbox' name='vlada'> Vláda | <br />
      <input type='checkbox' name='povidkar'> Povídkár | <input type='checkbox' name='gas'> Gold a Silver | <input type='checkbox' name='novinar'> Novináø | <input type='checkbox' name='vsichni'> Všichni |
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
      <input type='submit' style=\"color: #0099FF\" value='Založit' name=zaloz class='button'>
    </td>
  </tr>


</table>

 Návod jak vytvoøit fórum tak aby bylo funkèní se souèasným systémem na SG-nb<br />
 1) Systémová forá mohou být nastavena: Všem,Vládì,Vùdcùm,Adminùm,Pvýdkáøùm. Musí být nastavena pøístupnost na Všem<br />
 2) Diskuzní forá mohou být nastavena: Všem - Všem; Vládì - Všem,Rase; Vùdcùm - Všem,Rase; Adminum - Všem Povýdkáøùm - Všem<br />
 3) Zábavná fora mohou být nastavena: Všem,Vládì,Vùdcùm,Adminùm,Poýdkáøùm,Gold hráèùm,Novináøùm a to všem<br />
</form>
</font>";

?>
