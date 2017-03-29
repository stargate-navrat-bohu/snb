<?
mysql_query("SET NAMES cp1250");
Header ("Cache control: no-cache");
?>
<html>
<head>
<style type="text/css">
<!--
a, a:visited {
	color: #FFFFFF;
	text-decoration: none;
}

body{background:#000000;
		SCROLLBAR-BASE-COLOR: #000000;
		SCROLLBAR-ARROW-COLOR: #ffffff;	
		}


a:hover, a:active {
	color: #FFFFFF;
	text-decoration: underline;
}  
input {
	background-color: #CCCCCC;
	border: 1px solid #000000;
}
-->
</style>
</head>
<body bgcolor="black" text="FFFFFF">
<?
if(isset($heslo)):
		require "data_1.php";
		$vys1 = MySQL_Query("SELECT jmeno,heslo,koho,cislo FROM uzivatele");

		while($zaznam1 = MySQL_Fetch_Array($vys1)):
				if($zaznam1["jmeno"]==$jmeno){$dobre=1;break;};		
		endwhile;

		if($dobre==1):
		
			$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$jmeno'");
			do{
				$dobre2=1;
				$kontrola=MySQL_Fetch_Array($kontrola1);
				if($jmeno==$kontrola[jmeno]){$dobre2=0;$cislo=$kontrola[cislo];};
			}while($dobre2);		
			
			$heslo=md5($heslo);
			$ut2 = MySQL_Query("SELECT den,utocnik FROM utok where utocnik='$jmeno' order by den DESC");
			do{//echo "<h1>1";
				$on=0;
				$ut = MySQL_Fetch_Array($ut2);
				if($ut[utocnik]!=$jmeno){$ut=1;};
			}while($on);

			if(($ut[den]+48*3600)<Date("U")):			
				if($zaznam1["heslo"]==$heslo):
					if($zaznam1[koho]!=$zaznam1[jmeno]):
						$kdo=$zaznam1[koho];
						$vys5 = MySQL_Query("SELECT jmeno,volen FROM uzivatele where jmeno = '$kdo'");
						$zaznam5 = MySQL_Fetch_Array($vys5);
						$kolik=$zaznam5[volen]-1;
						MySQL_Query("update uzivatele set volen = $kolik where jmeno = '$kdo'");
					    MySQL_Query("DELETE FROM uzivatele WHERE cislo=$cislo");
						MySQL_Query("DELETE FROM planety WHERE cislomaj = $cislo");
						MySQL_Query("DELETE FROM mul WHERE jmeno='$zaznam1[jmeno]'");
					else:
						MySQL_Query("DELETE FROM uzivatele WHERE cislo=$cislo");			
						MySQL_Query("DELETE FROM planety WHERE cislomaj = $cislo");
						MySQL_Query("DELETE FROM mul WHERE jmeno='$zaznam1[jmeno]'");
					endif;
					echo "<h1>Profil zrušen</h1>";
				else:
					echo "<h1>Špatné heslo</h1>";
				endif;
			else:
				$utoc=Round((Date("U")-$ut[den])/60);
				$hod=Round((Date("U")-$ut[den])/3600);
				echo "<h1>Tento profil útoèil teprve pøed ".$hod." hodinami (".$utoc." minut).</h1>";				
			endif;
		else:	
			echo "<h1>Neexistující jméno</h1>";
		endif;
			
		MySQL_Close($spojeni);
endif;

?>
<font class="info">
<center>
Zde je možno zrušit Váš profil (nenávratnì).<br>

<form name="form" method="post" action="smazat.php">
<table>
<tr>	<td>jméno</td>
	<td><input type="text" name="jmeno"></td>
</tr><tr>
	<td>heslo</td>
	<td><input type="password" name="heslo"></td>
</tr><tr>
<td colspan=2><input type="submit" value="zruš registraci"><td>
</tr>
</table>
</form>
</center>
<br><a href="index.php">zpìt na index</a>
</font>


<p align="center">&nbsp;</p>
<hr noshade color="#FFFFFF" size="1">
<center>
<p>
<a href="http://www.backgammonhome.com/" target="new">backgammon</a> - The best online BackGammon.
</p>
</center>

</body>
</html>
