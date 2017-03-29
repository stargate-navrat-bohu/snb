
<?
mysql_query("SET NAMES cp1250");
	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	
	require("adkontrola.php");

echo "MIMO PROVOZ";die;

	if(isset($smazdny)):
		$d=Date("U")-86400;
		$e=Date("U");
		if($smazdnyv<5){echo "Moc málo dní";exit;};		
		if($smazdny<5){echo "Moc málo dní";exit;};
		if($smazdnyv==""){$smazdnyv=$smazdny;};
		if($dnu==""){$dnu=5;};
		$smazdny*=86400;
		$smazdnyv*=86400;
		$smaz2 = MySQL_Query("SELECT jmeno,den,koho,cislo,rasa,zmrazeni FROM uzivatele where (((($d-den)>$smazdny and rasa!=20) or (($d-den)>$smazdnyv and rasa=20)) and zmrazeni<$d)");
/*
		MySQL_Query("DELETE FROM forum WHERE den<$d");
		MySQL_Query("DELETE FROM posta WHERE den<$d");
		MySQL_Query("DELETE FROM utok WHERE den<$d");
*/	
		$i=0;echo "<font class=text_bili>";
		while($smaz = MySQL_Fetch_Array($smaz2)):
			$i++;;
			if($i>$dnu){break;};
   			$datum1=$smaz[den];
		  	$datum2=Date("U");
	  		$datum1=$datum2-$datum1;
			$datum1=$datum1/3600;
  			$datum1=$datum1/24;
	  		$datum1=Round($datum1);

			echo " smazáno ". $smaz[jmeno]." nebyl tu dní ".$datum1."<br>";
			$jmen = $smaz[jmeno];			
			$jmen = addslashes($jmen);
//			$vys2 = MySQL_Query("SELECT jmeno,den,koho FROM uzivatele where jmeno = $jmen");
//			$zaznam2 = MySQL_Fetch_Array($vys2);
			$jo=1;
			
//			if($zaznam2[koho]!=$zaznam2[jmeno] and $jo==1):
			if($smaz[koho]!=$smaz[jmeno] and $jo==1):
				//echo $zaznam2[koho];
				//echo "%";
				$kdo=$zaznam2[koho];
				$vys5 = MySQL_Query("SELECT jmeno,volen,rasa FROM uzivatele where jmeno = '$kdo'");
				$zaznam5 = MySQL_Fetch_Array($vys5);
				$kolik=$zaznam5[volen]-1;
				MySQL_Query("update uzivatele set volen = $kolik where jmeno = '$kdo'");
		        MySQL_Query("DELETE FROM uzivatele WHERE cislo = $smaz[cislo]");
				MySQL_Query("DELETE FROM planety WHERE cislomaj = $smaz[cislo]");
				MySQL_Query("DELETE FROM mul WHERE jmeno='$jmen'");
		        MySQL_Query("DELETE FROM multaci WHERE cislo = $smaz[cislo]");				
			elseif($jo==1):
				//echo "%";			
			    MySQL_Query("DELETE FROM uzivatele WHERE cislo = $smaz[cislo]");
				MySQL_Query("DELETE FROM planety WHERE cislomaj = $smaz[cislo]");
				MySQL_Query("DELETE FROM mul WHERE jmeno='$jmen'");
		        MySQL_Query("DELETE FROM multaci WHERE cislo = $smaz[cislo]");
			endif;
			
			// Odstraneni hlasovani v referendech - begin
			$kdo=$jmen;
			$vys5 = MySQL_Query("SELECT ref,refn FROM uzivatele where jmeno = '$kdo'");
			$zaznam5 = MySQL_Fetch_Array($vys5);

			$refer = MySQL_Query("SELECT * FROM referendum where cislo = 0");
			$ref = MySQL_Fetch_Array($refer);
		    if ($zaznam5[ref]==1) {
		      $aaa=$ref[ano]-1;
		      MySQL_Query("update referendum set ano = $aaa where cislo=0");
		    } elseif ($zaznam5[ref]==2) {
		      $nnn=$ref[ne]-1;
		      MySQL_Query("update referendum set ne = $nnn where cislo=0");
		    };
				
			$refer = MySQL_Query("SELECT * FROM referendum where cislo=$zaznam5[rasa]");
			$ref = MySQL_Fetch_Array($refer);
		    if ($zaznam5[refn]==1) {
		      $aaa=$refn[ano]-1;
		      MySQL_Query("update referendum set ano = $aaa where cislo=$zaznam5[rasa]");
		    } elseif ($zaznam5[refn]==2) {
		      $nnn=$refn[ne]-1;
		      MySQL_Query("update referendum set ne = $nnn where cislo=$zaznam5[rasa]");
		    };	
			// Odstraneni hlasovani v referendech - end

		endwhile;
	endif;
	/*
	if(isset($pop0)):
		MySQL_Query("DELETE FROM uzivatele WHERE populace='0'");
	endif;
	*/

	if(isset($nezalog)):
		$stari = (Date("U")-86400);
		$aktcas = Date("U");
		$nez1 = MySQL_Query("SELECT * FROM uzivatele WHERE (reg='0' AND (($aktcas-vek-86400)>0))");
		$nez3 = MySQL_Fetch_Array($nez1);
		echo "<font color='red'>";
		$koliksmaz = count($nez3);
		echo "<b>Celkem smazáno: " . $koliksmaz . "</b><br>";
		while ($nez2 = MySQL_Fetch_Array($nez1)):
			MySQL_Query("DELETE FROM mul WHERE jmeno='$nez2[jmeno]'");
	        MySQL_Query("DELETE FROM multaci WHERE jmeno='$nez2[jmeno]'");

			// Odstraneni hlasovani v referendech - begin
			$kdo=$nez2[jmeno];
			$vys5 = MySQL_Query("SELECT ref,refn FROM uzivatele where jmeno = '$kdo'");
			$nez2 = MySQL_Fetch_Array($vys5);

			$refer = MySQL_Query("SELECT * FROM referendum where cislo = 0");
			$ref = MySQL_Fetch_Array($refer);
		    if ($nez2[ref]==1) {
		      $aaa=$ref[ano]-1;
		      MySQL_Query("update referendum set ano = $aaa where cislo=0");
		    } elseif ($nez2[ref]==2) {
		      $nnn=$ref[ne]-1;
		      MySQL_Query("update referendum set ne = $nnn where cislo=0");
		    };
				
			$refer = MySQL_Query("SELECT * FROM referendum where cislo=$nez2[rasa]");
			$ref = MySQL_Fetch_Array($refer);
		    if ($nez2[refn]==1) {
		      $aaa=$refn[ano]-1;
		      MySQL_Query("update referendum set ano = $aaa where cislo=$nez2[rasa]");
		    } elseif ($nez2[refn]==2) {
		      $nnn=$refn[ne]-1;
		      MySQL_Query("update referendum set ne = $nnn where cislo=$nez2[rasa]");
		    };	
			// Odstraneni hlasovani v referendech - end
					
			echo "Smazán: <b>" . $nez2[jmeno] . "</b>; Registrován pøed (dny): ";
			echo Floor((Date("U")-$nez2[vek])/86400);
//			echo " " . $nez2[reg];			
			echo "<br>";
		endwhile;		
		echo "</font>";
		MySQL_Query("DELETE FROM uzivatele WHERE (reg='0' AND ($aktcas-vek-86400)>0)");
		

	endif;
	if(isset($posta)):
		if($posta<5){$posta=10;};
		if($forum<5){$forum=10;};
		if($utok<5){$utok=10;};		
		if($ciny<5){$ciny=10;};		
		$p=Date("U")-(864000*$posta);
		$f=Date("U")-(864000*$forum);
		$u=Date("U")-(864000*$utok);
		$c=Date("U")-(864000*$ciny);
		
		MySQL_Query("DELETE FROM forum WHERE den<$p");
		MySQL_Query("DELETE FROM posta WHERE den<$f");
		MySQL_Query("DELETE FROM utok WHERE den<$u");	
		MySQL_Query("DELETE FROM ciny WHERE cas<$c");			
	endif;
?>

<font class=text_bili>

<form name='form6' method='post' action='hlavni.php?page=admin7'>
<h6>Smazat</h6> 
nezmrazené  hráèe  neaktivní po <input type='text' name="smazdny" size=3> dnù,<br>
nezmr. vyvrhele(*) neaktivní po <input type='text' name="smazdnyv" size=3> dnù,<br>
smazat maximálnì hráèù(**) <input type='text' name="dnu" size=3><br>
<input type='submit' value="smaž">
</form>
<i>
(*)&nbsp;&nbsp;(implicitnì jako norm hráèe)<br>
(**)&nbsp;(implicitnì smaže 50)
</i>
<!--
<br>
<form name='formpop' method='post' action='hlavni.php?page=admin7'>
<h6>Smazat</h6> 
všechny hráèe s populací 0
<input type='hidden' name="pop0" value="1"<br>
<input type='submit' size=3 value="smaž"><br>
</form>
-->
<br>
<form name='formnezalog' method='post' action='hlavni.php?page=admin7'>
<h6>Smazat</h6> 
všechny hráèe s nezadaným reg. kódem a registrací starší než 24h 
<input type='hidden' name="nezalog" value="1"><br>
<input type='submit' size=3 value="smaž"><br>
</form>

<br>
<form name='form1' method='post' action='hlavni.php?page=admin7'>
<h6>Smazat</h6> 
poštu starší jak <input type='text' name="posta" size=3> dnù,<br>
forum starší jak <input type='text' name="forum" size=3> dnù,<br>
útok starší jak <input type='text' name="utok" size=3> dnù,<br>
èiny vedení starší jak <input type='text' name="ciny" size=3> dnù.<br>
<input type='submit' value="smaž">
</form>
<i>
vše je implicitnì 10 dnù<br>
minimálnì 5 dní
</i>
<?		
		
MySQL_Close($spojeni);
?>