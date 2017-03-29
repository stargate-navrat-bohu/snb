
<?
mysql_query("SET NAMES cp1250");

	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	
	require("adkontrola.php");

	if(isset($duvodh)):
		$duvodh=addslashes($duvodh);
		$duvodh=HTMLSpecialChars($duvodh);
		$duvodh=NL2BR($duvodh);
		MySQL_Query("update servis set zhra='$duvodh' WHERE cislo=1");		
		$den = Date("U");
		MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('12',$den,'vsichni','zastavil hru','N/A','$zaznam1[jmeno]')");

	endif;
	
	if(isset($duvodu)):
		$duvodu=addslashes($duvodu);
		$duvodu=HTMLSpecialChars($duvodu);
		$duvodu=NL2BR($duvodu);
		MySQL_Query("update servis set zutok='$duvodu' WHERE cislo=1");		
		$den = Date("U");
		MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('14',$den,'vsichni','zastavil útok','N/A','$zaznam1[jmeno]')");

	endif;	

	if(isset($duvodm)):
		$duvodm=addslashes($duvodm);
		$duvodm=HTMLSpecialChars($duvodm);
		$duvodm=NL2BR($duvodm);
		MySQL_Query("update servis set zmezi='$duvodm' WHERE cislo=1");		
		$den = Date("U");
		MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('16',$den,'vsichni','spustil mezivìk','N/A','$zaznam1[jmeno]')");

	endif;	
	
	if(isset($spustm)):
		$du="";
		MySQL_Query("update servis set zmezi='$du' WHERE cislo=1");
  	$den = Date("U");
		MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('17',$den,'vsichni','ukonèl mezivìk','N/A','$zaznam1[jmeno]')");

	endif;

	if(isset($spusth)):
		$du="";
		MySQL_Query("update servis set zhra='$du' WHERE cislo=1");
  	$den = Date("U");
		MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('13',$den,'vsichni','spustil hru','N/A','$zaznam1[jmeno]')");
	
	endif;
	
	if(isset($spustu)):
		$du="";
		MySQL_Query("update servis set zutok='$du' WHERE cislo=1");
  	$den = Date("U");
		MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('15',$den,'vsichni','spustil útok','N/A','$zaznam1[jmeno]')");

	endif;	
	
	$zastaveno2 = MySQL_Query("SELECT cislo,zutok,zhra,zmezi FROM servis where cislo=1");	
	$zastaveno = MySQL_Fetch_Array($zastaveno2);	
	
?>

<font class=text_bili>
<h6>Zastavení hry</h6> 
<?
if($zastaveno[zhra]==""):
?>
<form name='form1' method='post' action='hlavni.php?page=admin8'>
<textarea name=duvodh cols=50 rows=5>Dùvod zastavení hry (zobrazí se na index.php)</textarea>
<br><input type='submit' value="zastav">
</form>
<?
else:
?>
<form name='form1' method='post' action='hlavni.php?page=admin8'>
<font class=text_bili>Hra je zastavena</font><br>
<br><input type=hidden name=spusth value=1><input type='submit' value='pustit'>
</form>
<?
endif;
?>

<h6>Zastavení útoku</h6> 
<?
if($zastaveno[zutok]==""):
?>
<form name='form2' method='post' action='hlavni.php?page=admin8'>
<textarea name=duvodu cols=50 rows=5>Dùvod zastavení útoku (zobrazí se v utok.php)</textarea>
<br><input type='submit' value="zastav">
</form>
<?
else:
?>
<form name='form2' method='post' action='hlavni.php?page=admin8'>
<font class=text_bili>Útok je zastaven</font><br>
<br><input type=hidden name=spustu value=1><input type='submit' value='pustit'>
</form>
<?
endif;
?>

<h6>Mezivìk</h6> 
<?
if($zastaveno[zmezi]==""):
?>
<form name='form3' method='post' action='hlavni.php?page=admin8'>
<textarea name=duvodm cols=50 rows=5>prùchozí text k mezivìku</textarea>
<br><input type='submit' value="spustit">
</form>
<?
else:
?>
<form name='form3' method='post' action='hlavni.php?page=admin8'>
<font class=text_bili>Spuštìn mezivìk</font><br>
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