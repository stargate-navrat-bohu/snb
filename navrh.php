<?
mysql_query("SET NAMES cp1250");
/*
if (isset($HTTP_GET_VARS)){
$refer = getenv("HTTP_REFERER");
$PARAMS = explode('/', $refer); 
if ($PARAMS[2]!='www.sg-rtg.net')die('To už nezkoušejte');
}
if (isset($HTTP_POST_VARS)){
$refer = getenv("HTTP_REFERER");
$PARAMS = explode('/', $refer); 
if ($PARAMS[2]!='www.sg-rtg.net')die('To už nezkoušejte');
}*/

unset($zaznam1);
unset($bug11);

?>

<?
require "data_1.php";

$text=HTMLSpecialChars($text);
$text=Str_Replace("\r\n","<br>",$text);
$text=NL2BR($text);
//-----------------------------------------------------------------------------
$text2=HTMLSpecialChars($text2);
$text2=Str_Replace("\r\n","<br>",$text2);
$text2=NL2BR($text2);
//-----------------------------------------------------------------------------
$vys1 = MySQL_Query("SELECT cislo,jmeno,admin FROM uzivatele where cislo='$logcislo'") or die(mysql_error());
$zaznam1 = MySQL_Fetch_Array($vys1);
//-----------------------------------------------------------------------------
$bug1 = MySQL_Query("SELECT id,vlozil,text,vyjadreni FROM bugs") or die(mysql_error());
$bug11 = MySQL_Fetch_Array($bug1);
//-----------------------------------------------------------------------------
if ($text!=NULL){
MySQL_Query("INSERT INTO bugs (vlozil,text,vyjadreni) VALUES ('$zaznam1[jmeno]','$text','1')") or die(mysql_error());
}
//-----------------------------------------------------------------------------
if ($bugadmin!=NULL and ($zaznam1[admin]=='1' or $zaznam1[admin]=='2' or $zaznam1[admin]=='3' or $zaznam1[admin]=='4')){
MySQL_Query("update bugs set vyjadreni='$bugadmin' where id='$jmenov'") or die(mysql_error());
}
//-----------------------------------------------------------------------------
if ($jsmaz!=NULL and ($zaznam1[admin]=='1' or $zaznam1[admin]=='2' or $zaznam1[admin]=='3' or $zaznam1[admin]=='4')){
MySQL_Query("delete FROM bugs where id='$jsmaz'") or die(mysql_error());
}
//-----------------------------------------------------------------------------

?>


<body text='FFFFFF'>
<font class=text_bili><center><font class='text_modry'>N</font>ávrhy</center></font>

<form action=hlavni.php?page=navrh method=post>
<table align=center>
  <tr> 
    <td> 
      <textarea name=text rows=10 cols=60></textarea>
    </td>
  </tr>
  <tr> 
    <td> 
      <input type=submit value=pøidat name='submit'>
    </td>
  </tr>
</table>
<p>&nbsp;</p></form>


<table border=1 width=100% align=center>
  <tr>
    <td align=center width="15%"><font class=text_modry><b>Vložil</b></font>
    <td align=center><font class=text_modry><b>Návrh</b></font></td>
    <td align=center width="15%"><font class=text_modry><b>Vyjádøení adminù</b></font></td>
  </tr>
<?
$bug1 = MySQL_Query("SELECT id,vlozil,text,vyjadreni FROM bugs order by id desc") or die(mysql_error());
while ($bug11 = MySQL_Fetch_Array($bug1)) {
echo" <tr><td align=center class=text_modry><b>".$bug11[vlozil]."</b></td>
    <td align=center><font class=text_bili>".$bug11[text]."</font></td>
    <td align=center>"; 

if (($zaznam1[admin]=='1' or $zaznam1[admin]=='2' or $zaznam1[admin]=='3' or $zaznam1[admin]=='4') and ($bug11[vyjadreni]==1 or $bug11[vyjadreni]==2)):
$e1=NULL;
$e2=NULL;
$e3=NULL;
$e4=NULL;

if ($bug11[vyjadreni]==1) $e1='checked';
if ($bug11[vyjadreni]==2) $e2='checked';
if ($bug11[vyjadreni]==3) $e3='checked';
if ($bug11[vyjadreni]==4) $e4='checked';


if (($zaznam1[admin]=='1' or $zaznam1[admin]=='2' or $zaznam1[admin]=='3' or $zaznam1[admin]=='4') and $bug11[vyjadreni]==1){

echo"<form name='form1' action=hlavni.php?page=navrh method=post>
        <p>Èeká na vyjádøení
          <input type='radio' name='bugadmin' value='1'  ".$e1.">
          <br>
	   Pøijato
          <input type='radio' name='bugadmin' value='2'  ".$e2.">
          <br>
          Zamítnuto 
          <input type='radio' name='bugadmin' value='3' ".$e3." >
          <br>
        </p>
        <p>
          <input type='hidden' name='jmenov' value='".$bug11[id]."'>
        </p>
        <p>
          <input type='submit' name='Submit2' value='zmìnit'>
        </p>
        </form>
       <form name='form3' action='hlavni.php?page=navrh' method=post><input type=submit value=smazat name='submit'>
       <input type='hidden' name='jsmaz' value='".$bug11[id]."'> 
       </form>";
}
else{
echo"<form name='form1' action=hlavni.php?page=navrh method=post>
        <p>Provedeno
          <input type='radio' name='bugadmin' value='4' ".$e4." >
          <br>
        </p>
        <p>
          <input type='hidden' name='jmenov' value='".$bug11[id]."'>
        </p>
        <p>
          <input type='submit' name='Submit2' value='zmìnit'>
        </p>
        </form>
       <form name='form3' action='hlavni.php?page=navrh' method=post><input type=submit value=smazat name='submit'>
       <input type='hidden' name='jsmaz' value='".$bug11[id]."'> 
       </form>";
}

else:
if ($bug11[vyjadreni]==1) $e='<font class=text_bili>Èeká na vyjádøení</font>';
if ($bug11[vyjadreni]==2) $e='<font class=text_zluty>Pøijato</font>';
if ($bug11[vyjadreni]==3) $e='<font class=text_cerveny>Zamítnuto</font>';
if ($bug11[vyjadreni]==4) $e='<font class=text_zeleny>Provedeno</font>';
echo $e;
endif;
echo "</td></tr>";

}
?>
</table>
</body>
</html>
