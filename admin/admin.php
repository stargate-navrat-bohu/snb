<?php
require 'data_1.php';
require 'ad1234.php';

$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,admin FROM uzivatele where cislo = '$logcislo'");	
$zaznam1 = MySQL_Fetch_Array($vys1);	
$info=1;
$ip = $REMOTE_ADDR;

require 'kontrola.php';

if( $zaznam1['jmeno']!='prx' && $zaznam1['jmeno']!='puchy2' && $zaznam1['jmeno']!='sutech' && $zaznam1['jmeno']!='Raynoer' and $zaznam1['jmeno']!='Rada' and $zaznam1['jmeno']!='BenO' and $zaznam1['jmeno']!='marse4' and $zaznam1['jmeno']!='ETNyx' and $zaznam1['jmeno']!='Rusty' and $zaznam1['jmeno']!='Anubis' and $zaznam1['jmeno']!='Pyrotechnik' and $zaznam1['jmeno']!='Martinus' and $zaznam1['jmeno']!='Big Lebowsky' and $zaznam1['jmeno']!='zipakn' and $zaznam1['jmeno'] != 'Eleatee' && $zaznam1['jmeno']!='Mario' && $zaznam1['jmeno']!='Kr.Pa.' && $zaznam1['jmeno']!='RoobyJ'){
    echo "<h1>Nejste admin proto nemáte přístup do admin rozhraní.</h1>";
    exit;
}

if(isset($heslox)):
    if($heslox==$zaznam1['heslo'] and $heslo2==$aheslo && $heslo3==$bheslo && $zaznam1['admin']==1):
        MySQL_Query("update uzivatele set heslo2='$aheslo' where cislo = '$logcislo'");
        echo "<script type='text/javascript'>location.href='admin/hlavni.php?page=admin1'</script>";
    else:
        echo "<h1>Špatné heslo</h1>";
    endif;
endif;

$d=Date("U");
?>
<style type="text/css">
@import url(styl6.css);
</style>
</head>
<body>
<?php
include"admin_prihl_zab.php";
?>
<form name='form' method='post' action='hlavni.php?page=admin'>
<input type='hidden' name='zpracuj' value='1'>
<table>
	<tr>
	<td>heslo1: </td>
	 <td><input type="password" name="heslox" value="<?= $heslomoje ?>" size=30></td>
	</tr>
	<tr>
	 <td>heslo2: </td>
	 <td><input type="password" name="heslo2" value="<?= $heslomoje2 ?>" size=30></td>
	</tr>
	<tr>
	 <td>heslo3: </td>
	 <td><input type="password" name="heslo3" value="<?= $heslomoje3 ?>" size=30></td>
	</tr>	
	<tr>
	 <td colspan=2 align="center"><input type="submit" value="Proveď"><td>
	</tr>
 </table>
</form>
<?php
MySQL_Close($spojeni);
echo "</font>";
