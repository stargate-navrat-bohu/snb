
<?
mysql_query("SET NAMES cp1250");
unset($zaznam1);
unset($rasa1);
unset($rasa2);
require "data_1.php";

	$vys1 = MySQL_Query("SELECT cislo,rasa,admin FROM uzivatele where cislo=$logcislo");
	$zaznam1 = MySQL_Fetch_Array($vys1);



?>


<center><font class='tabulka'>
<a href="hlavni.php?page=vlada&vyber=1" >Funkce</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=vlada&vyber=2" >Èiny vedení</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=vlada&vyber=5" >Fond výzkum</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=vlada&vyber=7" >Pøepoèty</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=vlada&vyber=6" >Pøepoèet naquadahu</a>
&nbsp;&nbsp;
<?
if($zaznam1[admin]==1):
echo "<a href='hlavni.php?page=vlada&vyber=4'>Èiny adminù</a>
&nbsp;&nbsp;";

endif;
?>

<font class='tabulka'><center><font class='text_modry'>P</font>øepoèet naquadahu</font>


<script language="JavaScript">
function zmena(){
document.formw0.co.value=1;
document.formw1.co.value=1;
document.formw2.co.value=1;
alert(document.formw0.co.value);
alert(document.formw1.co.value);
alert(document.formw2.co.value);
}
</script>

<?
//----------------------------------------------------------------------------

// *** nacteni ras do pole $rasa ***
$sql = "SELECT `rasa`, `nazevrasy` FROM `rasy` WHERE `rasa`>0 and `rasa`<11 ORDER BY `nazevrasy` ASC;";
$result = mysql_query($sql, $spojeni);
while($row=mysql_fetch_array($result)){
  $array_rasy[$row["rasa"]] = $row["nazevrasy"];
}



?><center><table width="600" border="0" cellpadding="5" cellspacing="5">
  <tr> 
    <td colspan="2" valign="top" align="left"> <font color="#FFFFFF"> </font>
      <form name="form1" action="hlavni.php?page=vlada&vyber=6" method="post">
        <div align="center"><font color="#FFFFFF"> </font></div>
        <div align="center"></div>
        <font color="#FFFFFF"> </font>
        <p align="center">&nbsp;</p>
        <p align="center"> <font color="#FFFFFF">
          <select name="prvni" class="select">
		    <?php
		      foreach($array_rasy as $k => $v){
    			 echo '            <option value="'.$k.'">'.$v.'</option>'."\r\n";
		      }
		    ?>
           
            <option value="98">Vyvrhelové</option>
          </select>
          ---------&gt; 
          <select name="druhy" class="select">
		    <?php
		      foreach($array_rasy as $k => $v){
    			 echo '            <option value="'.$k.'">'.$v.'</option>'."\r\n";
		      }
		    ?>
            
            <option value="98">Vyvrhelové</option>
          </select>
          </font></p>
        <p align="center"><font color="#FFFFFF"> NAQ: 
          <input type="text" name="naq" class="input">
          </font></p>
        <p align="center"> <font color="#FFFFFF">
          <input type="submit" name="Submit" value="Vypoèítat" class="button" style="font-weight: bold;">
          </font></p>
      </form> 
      <p align="center"><?

$naq=htmlspecialchars($naq);
if ($chars==0 && !is_numeric($field)) 
     $error="NAQ nebyl zadán správnì!";
if (is_numeric($naq)){ 

	if($prvni<=10 OR $prvni==11 OR $prvni==98 OR $prvni==97){
	if($druhy<=10 OR $druhy==11 OR $druhy==98 OR $druhy==97){

	$vyr1 = MySQL_Query("SELECT vyr_vyrob,nazevrasy FROM rasy where rasa=$prvni");
	$rasa1 = MySQL_Fetch_Array($vyr1);
	$vyr2 = MySQL_Query("SELECT vyr_vyrob,nazevrasy FROM rasy where rasa=$druhy");
	$rasa2 = MySQL_Fetch_Array($vyr2);

        $castka=$naq*($rasa2[vyr_vyrob]/$rasa1[vyr_vyrob]);


echo"<centre><font class='pozor'> ".number_format($naq,0,0," ")." ".$rasa1[nazevrasy]." NAQ je ".number_format($castka,0,0," ")."NAQ v mìnì ".$rasa2[nazevrasy]."</centre></font>";

}}}

MySQL_Close($spojeni);		
//----------------------------------------------------------------------------
?>
</table>
