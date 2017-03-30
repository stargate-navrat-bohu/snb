<?php
//mysql_query("SET NAMES cp1250");

unset($zaznam1);
unset($bug11);

require "data_1.php";
$text=HTMLSpecialChars($text);
$text=Str_Replace("\r\n","<br>",$text);
$text=NL2BR($text);
$vyjadreni=HTMLSpecialChars($vyjadreni);
$vyjadreni=Str_Replace("\r\n","<br>",$vyjadreni);
$vyjadreni=NL2BR($vyjadreni);

//-----------------------------------------------------------------------------
$vyjadreni=HTMLSpecialChars($vyjadreni);
$vyjadreni=Str_Replace("\r\n","<br>",$vyjadreni);
$vyjadreni=NL2BR($vyjadreni);
//-----------------------------------------------------------------------------
$vys1 = MySQL_Query("SELECT cislo,jmeno,admin FROM uzivatele where cislo='$logcislo'") or die(mysql_error());
$zaznam1 = MySQL_Fetch_Array($vys1);
//-----------------------------------------------------------------------------
$bug1 = MySQL_Query("SELECT id,vlozil,text,vyjadreni FROM dotazy") or die(mysql_error());
$bug11 = MySQL_Fetch_Array($bug1);
//-----------------------------------------------------------------------------
if ($text!=NULL){
    MySQL_Query("INSERT INTO dotazy (vlozil,text,vyjadreni) VALUES ('".$zaznam1['jmeno']."','$text','$vyjadreni')") or die(mysql_error());
}
//-----------------------------------------------------------------------------
if ($vyjadreni!=NULL and ($zaznam1['admin']=='1' or $zaznam1['admin']=='2'or $zaznam1['admin']=='3'or $zaznam1['admin']=='4') ){
    MySQL_Query("update dotazy set vyjadreni='$vyjadreni' where id='$jmenov'") or die(mysql_error());
}
//-----------------------------------------------------------------------------
if ($jsmaz!=NULL and ($zaznam1['admin']=='1' or $zaznam1['admin']=='2'or $zaznam1['admin']=='3'or $zaznam1['admin']=='4')){
    MySQL_Query("delete FROM dotazy where id='$jsmaz'") or die(mysql_error());
}
//-----------------------------------------------------------------------------
?>
</head>
<body>
<center>
<script type="text/javascript" src="a.php" >
alink{color:white;
font-size: 11px;};
</script>

<a href='hlavni.php?page=dotazy&amp;vyber=1' id=a onMouseOver=Rozsvitit('a') onMouseOut=Zhasnout('a')>Dotazy pro adminy</a>
&nbsp;&nbsp;

<a href='hlavni.php?page=dotazy&amp;vyber=2' id=b onMouseOver=Rozsvitit('b') onMouseOut=Zhasnout('b')>Dotazy nov��k�</a>
&nbsp;&nbsp;
<?php
if($zaznam1[['status']]==4):
    $a=1.5;
else:
    $a=1;
endif;

if(empty($vyber)){$vyber=1;};

//*******************************************************admini******************************
if($vyber==1):
?>
    <br><br><font class=text_bili><font class='text_modry'>D</font>otazy určené adminem hry </font>
  </center></h1>
<form action='hlavni.php?page=dotazy&vyber=1' method=post>
<table align=center>
  <tr> 
    <td> 
      <textarea name=text rows=10 cols=60></textarea>
    </td>
  </tr>
  <tr> 
    <td> 
      <input type=submit value=p�idat name='submit'>
    </td>
  </tr>
</table>
<p>&nbsp;</p></form>

<table border=1 width=100% align=center>
  <tr>
    <td align=center width="15%"><font class=text_modry><b>Vložil</b></font>
    <td align=center><font class=text_modry><b>Popis</b></font></td>
    <td align=center width="15%"><font class=text_modry><b>Vyjádření adminů</b></font></td>
  </tr>
<?php
	if(($x<0 or empty($x))){$x=0;};

$bug1 = MySQL_Query("SELECT id,vlozil,text,vyjadreni FROM dotazy ORDER BY id DESC LIMIT $x,30 ") or die(mysql_error());
while ($bug11 = MySQL_Fetch_Array($bug1)) {
if($bug11['vyjadreni']==NULL): $vyj="<font class=text_cerveny>nezadano</font>";
else:$vyj="<font class=text_zeleny>".$bug11['vyjadreni']."</font>";
endif;
echo" <tr>
    <td align=center class=pole><b><a href='hlavni.php?page=posta&amp;vyber=1&komuposl=".$bug11['vlozil']."'>".$bug11['vlozil']."</a></b></td>
    <td align=center><font class=text_bili>".$bug11['text']."</font></td>
    <td align=center>".$vyj."</td>"; 

if ($zaznam1['admin']==1 or $zaznam1['admin']=='2'or $zaznam1['admin']=='3'or $zaznam1['admin']=='4'):
echo" 
    <td><form name='form2' action='hlavni.php?page=dotazy&amp;vyber=1' method=post> 
        <textarea name=vyjadreni rows=10 cols=25>".$bug11['vyjadreni']."</textarea>
        <input type=submit value='přidat' name='submit'>
        <input type='hidden' name='jmenov' value='".$bug11['id']."'>
       </form>
       <form name='form3' action='hlavni.php?page=dotazy&amp;vyber=1' method=post><input type=submit value='smazat' name='submit'>
       <input type='hidden' name='jsmaz' value='".$bug11['id']."'> 
       </form>
   </td>";

endif;
echo"</tr>";}

echo "</table>";

	$y=$x+30;
	$z=$x-30;
	echo "<br><br><center><font class='text_bili'><a href=hlavni.php?page=dotazy&amp;x=".$z." >30 novějších dotazů</a>&nbsp;&nbsp;";
	echo "<a href=hlavni.php?page=dotazy&amp;x=".$y." >30 starších dotazů</a></font>";				

//****************************************************novacci************************************	
	elseif($vyber==2):


$textn=HTMLSpecialChars($textn);
$textn=Str_Replace("\r\n","<br>",$textn);
$textn=NL2BR($textn);
$vyjadrenin=HTMLSpecialChars($vyjadrenin);
$vyjadrenin=Str_Replace("\r\n","<br>",$vyjadrenin);
$vyjadrenin=NL2BR($vyjadrenin);
//-----------------------------------------------------------------------------
$vyjadrenin=HTMLSpecialChars($vyjadrenin);
$vyjadrenin=Str_Replace("\r\n","<br>",$vyjadrenin);
$vyjadrenin=NL2BR($vyjadrenin);
//-----------------------------------------------------------------------------
$vys11 = MySQL_Query("SELECT cislo,jmeno,admin FROM uzivatele where cislo='$logcislo'") or die(mysql_error());
$zaznam11 = MySQL_Fetch_Array($vys11);
//-----------------------------------------------------------------------------
$bug1n = MySQL_Query("SELECT idn,vloziln,textn,vyjadrenin FROM dotazyn") or die(mysql_error());
$bug11n = MySQL_Fetch_Array($bug1n);
//-----------------------------------------------------------------------------
if ($textn!=NULL){
    MySQL_Query("INSERT INTO dotazyn (vloziln,textn,vyjadrenin,idn) VALUES ('".$zaznam11['jmeno']."','$textn','$vyjadrenin','$idx')") or die(mysql_error());
}
//-----------------------------------------------------------------------------
if ($vyjadrenin!=NULL and ($zaznam11['admin']=='1' or $zaznam11['admin']=='2'or $zaznam11['admin']=='3'or $zaznam11['admin']=='4')){
    MySQL_Query("update dotazyn set vyjadrenin='$vyjadrenin' where idn='$jmenovn'") or die(mysql_error());
}
//-----------------------------------------------------------------------------
if ($jsmazn!=NULL and ($zaznam11['admin']=='1' or $zaznam11['admin']=='2'or $zaznam11['admin']=='3'or $zaznam11['admin']=='4')){
    MySQL_Query("delete FROM dotazyn where idn='$jsmazn'") or die(mysql_error());
}
//-----------------------------------------------------------------------------
?>
    <br><br><font class=text_bili><font class='text_modry'>D</font>otazy nováčků</font>
  </center></h1>
<form action='hlavni.php?page=dotazy&amp;vyber=2' method=post>
<table align=center>
  <tr> 
    <td> 
      <textarea name=textn rows=10 cols=60></textarea>
    </td>
  </tr>
  <tr> 
    <td><?php
    $casted=Date("U");
    echo '<input type="hidden" name="idx" value="'.$casted.'">';
    echo '<input type="submit" value="přidat" name="submit">';
    ?></td>
  </tr>
</table>
<p>&nbsp;</p></form>

<table border=1 width=100% align=center>
  <tr>
    <td align=center width="15%"><font class=text_modry><b>Vložil</b></font>
    <td align=center><font class=text_modry><b>Popis</b></font></td>
    <td align=center width="15%"><font class=text_modry><b>Vyjádření užitelů</b></font></td>
  </tr>
<?php
$bug1n = MySQL_Query("SELECT idn,vloziln,textn,vyjadrenin FROM dotazyn order by idn desc") or die(mysql_error());
while ($bug11n = MySQL_Fetch_Array($bug1n)) {
if($bug11n['vyjadrenin']==NULL): $vyjn="<font class=text_cerveny>nezadano</font>";
else:$vyjn="<font class=text_zeleny>".$bug11n['vyjadrenin']."</font>";
endif;
echo" <tr>
    <td align=center <font class=text_modry><b><a href='hlanvi.php?posta&vyber=1&komuposl=".$bug11n[vloziln]."'>".$bug11n[vloziln]."</a></b></td>
    <td align=center><font class=text_bili>".$bug11n['textn']."</font></td>
    <td align=center>".$vyjn."</td>";

// XXX ondrejd: `$zaznam11['status']` je spatne - overit v prvni initial commit!
if ($zaznam11['admin']==1 or $zaznam11['status']==1 or $zaznam11['admin']=='2'or $zaznam11['admin']=='3'or $zaznam11['admin']=='4'):
echo" 
    <td><form name='form2' action='hlavni.php?page=dotazy&amp;vyber=2' method=post> 
        <textarea name=vyjadrenin rows=10 cols=25>".$bug11n['vyjadrenin']."</textarea>
        <input type=submit value='přidat' name='submit'>
        <input type='hidden' name='jmenovn' value='".$bug11n['idn']."'>
       </form>
       <form name='form3' action='hlavni.php?page=dotazy&vyber=2' method=post><input type=submit value=smazat name='submit'>
       <input type='hidden' name='jsmazn' value='".$bug11n['idn']."'> 
       </form>
   </td>";

endif;
echo"</tr>";}

	endif;
?>
</table>