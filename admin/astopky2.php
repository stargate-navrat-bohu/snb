<?php
Header ("Cache control: no-cache");
?>
<html>
<head>
<?php
//mysql_query("SET NAMES cp1250");
$heslo1=md5($heslo1);
$heslo2=md5($heslo2);		

require"ad1234.php";
if($heslo1==$aheslo and $heslo2==$bheslo):
    if(isset($duvodh)):
        $duvodh=addslashes($duvodh);
        $duvodh=HTMLSpecialChars($duvodh);
        $duvodh=NL2BR($duvodh);
        MySQL_Query("update servis set zhra='$duvodh' WHERE cislo=1");		
    endif;

    if(isset($duvodu)):
        $duvodu=addslashes($duvodu);
        $duvodu=HTMLSpecialChars($duvodu);
        $duvodu=NL2BR($duvodu);
        MySQL_Query("update servis set zutok='$duvodu' WHERE cislo=1");		
    endif;

    if(isset($duvodm)):
        $duvodm=addslashes($duvodm);
        $duvodm=HTMLSpecialChars($duvodm);
        $duvodm=NL2BR($duvodm);
        MySQL_Query("update servis set zmezi='$duvodm' WHERE cislo=1");		
    endif;	

    if(isset($spustm)):
        $du="";
        MySQL_Query("update servis set zmezi='$du' WHERE cislo=1");
    endif;

    if(isset($spusth)):
        $du="";
        MySQL_Query("update servis set zhra='$du' WHERE cislo=1");
    endif;

    if(isset($spustu)):
        $du="";
        MySQL_Query("update servis set zutok='$du' WHERE cislo=1");
    endif;	

    $zastaveno2 = MySQL_Query("SELECT cislo,zutok,zhra,zmezi FROM servis where cislo=1");	
    $zastaveno = MySQL_Fetch_Array($zastaveno2);	
else:
    echo "<h6>Špatné heslo</h6>";
endif;
	
?>
<style type="text/css">
@import url(styl0.css);
</style>
<script type="text/javascript" src="a.php" >
</script>
</head>
<body>
<font class=info>
<center>
<h6>Zastavené hry</h6> 
<?php
if($zastaveno['zhra']==""):
?>
<form name='form1' method='post' action='astopky.php'>
    <textarea name=duvodh cols=50 rows=5>Důvod zastavené hry (zobrazí se na index.php)</textarea>
<br>
<table>
	<tr>
	<td>heslo1: </td>
	 <td><input type="password" name="heslo1" size=30></td>
	</tr>
	<tr>
	 <td>heslo2: </td>
	 <td><input type="password" name="heslo2" size=30></td>
	</tr>
 </table><br>
<input type='submit' value="zastav">
</form>
<?php
else:
?>
<form name='form1' method='post' action='astopky.php'>
<font class=info>Hra je zastavena</font><br>
<table>
	<tr>
	<td>heslo1: </td>
	 <td><input type="password" name="heslo1" size=30></td>
	</tr>
	<tr>
	 <td>heslo2: </td>
	 <td><input type="password" name="heslo2" size=30></td>
	</tr>
 </table>
<br><input type=hidden name=spusth value=1><input type='submit' value='pustit'>
</form>
<?php
endif;
?>

<h6>Zastavení útoku</h6> 
<?php
if($zastaveno['zutok']==""):
?>
<form name='form2' method='post' action='astopky.php'>
<textarea name=duvodu cols=50 rows=5>Důvod zastavení útoku (zobrazí se v utok.php)</textarea>
<table>
	<tr>
	<td>heslo1: </td>
	 <td><input type="password" name="heslo1" size=30></td>
	</tr>
	<tr>
	 <td>heslo2: </td>
	 <td><input type="password" name="heslo2" size=30></td>
	</tr>
 </table>
<br><input type='submit' value="zastav">
</form>
<?php
else:
?>
<form name='form2' method='post' action='astopky.php'>
<font class=info>�tok je zastaven</font><br>
<table>
	<tr>
	<td>heslo1: </td>
	 <td><input type="password" name="heslo1" size=30></td>
	</tr>
	<tr>
	 <td>heslo2: </td>
	 <td><input type="password" name="heslo2" size=30></td>
	</tr>
 </table>
<br><input type=hidden name=spustu value=1><input type='submit' value='pustit'>
</form>
<?php
endif;
?>

<h6>Mezivěk</h6> 
<?php
if($zastaveno['zmezi']==""):
?>
<form name='form3' method='post' action='astopky.php'>
<textarea name=duvodm cols=50 rows=5>průchozí text k mezivěku</textarea>
<table>
	<tr>
	<td>heslo1: </td>
	 <td><input type="password" name="heslo1" size=30></td>
	</tr>
	<tr>
	 <td>heslo2: </td>
	 <td><input type="password" name="heslo2" size=30></td>
	</tr>
 </table>
<br><input type='submit' value="spustit">
</form>
<?php
else:
?>
<form name='form3' method='post' action='astopky.php'>
<font class=info>Spuštěn mezivěk</font><br>
<table>
	<tr>
	<td>heslo1: </td>
	 <td><input type="password" name="heslo1" size=30></td>
	</tr>
	<tr>
	 <td>heslo2: </td>
	 <td><input type="password" name="heslo2" size=30></td>
	</tr>
 </table>
<br><input type=hidden name=spustm value=1><input type='submit' value='zastavit'>
</form>
<?php
endif;
?>
<i>
To samé lze i z adresy 'astopky.php', je to jediná možnost na spuštění hry
</i>
<?php		
MySQL_Close($spojeni);
?>
</center>
</body>
</html>
