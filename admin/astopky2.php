<?
Header ("Cache control: no-cache");
?>
<html>
<head>
<?
mysql_query("SET NAMES cp1250");
	$heslo1=md5($heslo1);
	$heslo2=md5($heslo2);		
		
	//$bheslo="7c1a86fe2c114ea13edb9660128d6116";
	//$aheslo="5241ea8546be8f22155afc9a0aaff041";	
require"ad1234.php";
	if($heslo1==$aheslo and $heslo2==$bheslo)://echo "asdfffffffffffffffffffffddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd";
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
<script language="JavaScript" src="a.php" >
</script>
</head>
<body>
<font class=info>
<center>
<h6>Zastavení hry</h6> 
<?
if($zastaveno[zhra]==""):
?>
<form name='form1' method='post' action='astopky.php'>
<textarea name=duvodh cols=50 rows=5>Dùvod zastavení hry (zobrazí se na index.php)</textarea>
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
<?
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
<?
endif;
?>

<h6>Zastavení útoku</h6> 
<?
if($zastaveno[zutok]==""):
?>
<form name='form2' method='post' action='astopky.php'>
<textarea name=duvodu cols=50 rows=5>Dùvod zastavení útoku (zobrazí se v utok.php)</textarea>
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
<?
else:
?>
<form name='form2' method='post' action='astopky.php'>
<font class=info>Útok je zastaven</font><br>
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
<?
endif;
?>

<h6>Mezivìk</h6> 
<?
if($zastaveno[zmezi]==""):
?>
<form name='form3' method='post' action='astopky.php'>
<textarea name=duvodm cols=50 rows=5>prùchozí text k mezivìku</textarea>
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
<?
else:
?>
<form name='form3' method='post' action='astopky.php'>
<font class=info>Spuštìn mezivìk</font><br>
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
<?
endif;
?>

<i>
To samé lze i z adresy 'astopky.php', je to jediná možnost na spuštìní hry
</i>
<?		
		
MySQL_Close($spojeni);
?>
</center>
</body>
</html>
