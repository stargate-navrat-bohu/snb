
<?
		require "data_1.php";

mysql_query("SET NAMES cp1250");

		
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);


		require("kontrola.php");
		
				function fcis($a){

		$a=number_format($a,0,""," ");

		return $a;	

		}
		
?>

<center>
<?

include "menupl.php";

?>

<br><br><font class='text_bili'><font class='text_modry'>O</font>sidlov�n� planet</font><br><br>

<font class='text_bili'>Zde m�te mo�nost os�dlit planety(maxim�ln� v�ak 25) pak u� mus�te jen dob�vat. Planety m��ete tak� opustit(nelze opustit centr�ln� a domovskou planetu). Poku� m�te jen jednu planetu nelze na v�s �to�it, vy nesm�te �to�it a nesm�te p�izp�vat na v�zkum. </font><br><br>

<?

				if($zaznam1[planety]+1>25):
                                echo "<font class='text_cerveny'>Ji� jste os�dlil maxim�ln� po�et planet. Dal�� lze z�skat dob�vac�m �tokem, nebo lze koupit v obchod�.</font>";die;
                                endif;                                      


		if(($odesli=="hm")){
			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa1 = $zaznam1["rasa"] ;

			$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika = MySQL_Fetch_Array($politika1);

      		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=9 and mrtev!=1)");
			@$stav = MySQL_Fetch_Array($stavitel2);

		 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ=9");
			$typhs = MySQL_Fetch_Array($typhs2);

			$bstav=1-($stav[level]*$typhs[ucinek]);

			if($stav[cislomaj]!=$logcislo){$bstav=1;};
			//echo "<font class =info>".$bstav;
			$cislos=$stav[cislo];

			$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
			$narod = MySQL_Fetch_Array($narod1);

			$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
			$zriz = MySQL_Fetch_Array($zrizeni1);

			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);

			$vys3 = MySQL_Query("SELECT nazev FROM planety");
			$bla = $zaznam2["planeta"]*$bstav*$politika[cenap]/100*$zriz[planeta]/100*(1+$zaznam1[planety]/10) * 5;
			
      

      if($vyber=="os"){
				for ($i=0;$i<strlen($nazev1);$i++): 
					$blb=ord($nazev1[$i]);
					//echo "$nazev1[$i]($blb)<br>";
					if (!(ord($nazev1[$i])==32 or ord($nazev1[$i])==95 or (ord($nazev1[$i])>=40 and ord($nazev1[$i])<=57) or (ord($nazev1[$i])>=60 and ord($nazev1[$i])<=90) or (ord($nazev1[$i])>=97 and ord($nazev1[$i])<=122) or ord($nazev1[$i])==138 or ord($nazev1[$i])==141 or ord($nazev1[$i])==142 or ord($nazev1[$i])==154 or ord($nazev1[$i])==157 or ord($nazev1[$i])==158 or ord($nazev1[$i])==200 or ord($nazev1[$i])==201 or ord($nazev1[$i])==204 or ord($nazev1[$i])==205 or ord($nazev1[$i])==207 or ord($nazev1[$i])==210 or ord($nazev1[$i])==211 or ord($nazev1[$i])==216 or ord($nazev1[$i])==217 or ord($nazev1[$i])==218 or ord($nazev1[$i])==221 or ord($nazev1[$i])==225 or ord($nazev1[$i])==229 or ord($nazev1[$i])==232 or ord($nazev1[$i])==233 or ord($nazev1[$i])==236 or ord($nazev1[$i])==237 or ord($nazev1[$i])==242 or ord($nazev1[$i])==253 or (ord($nazev1[$i])>=248 and ord($nazev1[$i])<=250))): 
						echo "<font class='text_cerveny'>M�te �patn� znak $nazev1[$i]($blb)</font>";
						exit;
					endif; 
				endfor;//exit;
				if($zaznam1[planety]+1<=25):
				if($typ!="n�hodn�"){$bla*=5;};
				if($zaznam1["penize"]>=$bla):
				$nazev1 = str_replace(" ","_",$nazev1);
				if($nazev1==""){echo "<font class='text_cerveny'>Zadejte n�zev planety.</font>";exit;};
					while ($zaznam3 = MySQL_Fetch_Array($vys3)):
						if(strtolower($zaznam3["nazev"])==strtolower($nazev1)){
							echo "<font class='text_cerveny'>Planeta s t�mto jm�nem ji� existuje.<br></font>";$spatne=1;	
						};
					endwhile;
				      	$katar=rand(1,5);
					$br=0;
					if($katar==5){$br=1;};
					$tt=3;
					if($typ=="n�hodn�"):
					    $plan=rand(1,6);
						$tt=1;
						switch ($plan){
							case 1: $typ="M�rn� planeta";break; 
							case 2: $typ="Planeta technologi�";break;
							case 3: $typ="Zaledn�n� planeta";break;
							case 4: $typ="Obchodn� p��stav";break;
							case 5: $typ="Tropick� planeta";break;
							case 6: $typ="Naquadahov� d�l";break;
							}
					endif;
				    $nah=rand(1,4);
					switch ($nah){
						case 1: if($politika[cenap]==100):
									$lidi=500000000;
									$tez=5000;
									$mest=50;
								else:
									$lidi=500000000;
									$tez=5000;
									$mest=50;
								endif;
								break; 
						case 2:	if($politika[cenap]==100):
									$lidi=150000000;
									$tez=500;
									$mest=20;
								else:
									$lidi=150000000;
									$tez=500;
									$mest=20;
								endif;
								break; 							
						case 3:	if($politika[cenap]==100):
									$lidi=150000000;
									$tez=500;
									$mest=20;
								else:
									$lidi=100000000;
									$tez=80;
									$mest=15;
								endif;
								break; 							
						case 4: if($politika[cenap]==100):
									$lidi=80000000;
									$tez=80;
									$mest=10;
								else:
									$lidi=80000000;
									$tez=80;
									$mest=10;
								endif;
								break;
            case 5: if($politika[cenap]==100):
									$lidi=15000000;
									$tez=150;
									$mest=10;
								else:
									$lidi=100000000;
									$tez=100;
									$mest=10;
								endif;
								break;
						case 6: if($politika[cenap]==100):
									$lidi=200000000;
									$tez=200;
									$mest=20;
								else:
									$lidi=50000000;
									$tez=50;
									$mest=10;
								endif;
								break;
						}
					if($spatne!=1){
					   $i=0;
					   do{	
						if($i>10){echo "<font class='text_cerveny'>Os�dlen� planety se neprovedlo proto�e pobl� nen� ��dn� vyhovuj�c� planeta. Zkuste pozd�ji.</font>";break;};
						$vytvor=1;
						$howw = MySQL_Query("SELECT cislo,planety FROM servis where cislo=1");
						$how = MySQL_Fetch_Array($howw);
						$uzje=$how[planety];
						$uzje*=2;
						$uzje/=2;
						$uzje+=1000001;
						$uje=$uzje-1000000;
						//echo "<font class='tabulka'>".$uzje;

						MySQL_Query("update servis set planety = '$uje' where cislo=1");

						$n=$zaznam1["penize"]-$bla;
						$p=$zaznam1["planety"]+1;
						$c=Date("U");
						MySQL_Query("INSERT INTO planety(cislo,nazev,majitel,lidi,mesta,vyrobna,cas,brana,typ,cislomaj) VALUES($uzje,'$nazev1','$logjmeno',$lidi,$mest,$tez,$c,$br,'$typ',$logcislo)");

						$kpv = MySQL_Query("SELECT * FROM planety where nazev='$nazev1'");
						$kp = MySQL_Fetch_Array($kpv);
						if(($kp[cislomaj]=$logcislo) and ($kp[nazev]=$nazev1)){$vytvor=0;};
						$i++;
					    }while($vytvor);

					    if($vytvor==0):
						if($n<0){$n=0;};
						MySQL_Query("update uzivatele set penize=$n,planety=$p where cislo=$logcislo");
						$zkusn=($zaznam2["planeta"]/100);
						$zkusn*=$zaznam1[planety]*$tt;
//echo "<font class='tabulka'>".$zkusn;
						$zkusn=Floor($zkusn)+$stav[zkus];
						$lv=bcsqrt($zkusn/250);
						$lv=Floor($lv);
						if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};
						MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislos");
					    
			 echo "<font class='text_cerveny'>Byla os�dlena planeta s n�zvem ".$nazev1." typu ".$typ." za ".fcis($bla)." naquadahu a nach�z� se na n� ".fcis($mest)."m�st, ".fcis($tez)."t�eben, ".$br."H. bran a ".fcis($lidi)."lid�.<br></font>";	

                                endif;

					};
				else:
					 echo "<font class='text_cerveny'>M�te m�lo naquadahu</font>";
				endif;
				else:
					 echo "<font class='text_cerveny'>Nesm�te os�dlit v�ce jak 25 planet. Te� m��ete u� jen dob�vat.</font><br>";					
				endif;
			}
			else{   
				$vys33 = MySQL_Query("SELECT * FROM planety where nazev = '$nazev1'");
				$zaznam3 = MySQL_Fetch_Array($vys33);	
				if($zaznam3[status]!=2)://echo "$zaznam3[cislomaj]";
					if($zaznam3["cislomaj"]==$logcislo):
						$c=$zaznam3[cas]+43200;
						if(Date("U")>$c):
							$n=$zaznam1["penize"]+($bla*0.5);
							$pod=0.25;
							$n+=$zaznam3[vyrobna]*($zaznam2[vyr_cena]*$politika[cenas]/100)*$pod;
							$n+=$zaznam3[kasarna]*$zaznam2[kas_cena]*$pod;
							$n+=$zaznam3[mesta]*($zaznam2[mes_cena]*$politika[cenas]/100)*$pod;	
							$n+=$zaznam3[par]*($zaznam2[park_cena]*$politika[cenas]/100)*$pod;
							$n+=$zaznam3[pol]*($zaznam2[pol_cena]*$politika[cenas]/100)*$pod;
              $p=$zaznam1["planety"]-1;
							MySQL_Query("DELETE FROM planety WHERE nazev = '$nazev1'");
							MySQL_Query("update uzivatele set penize = $n where cislo=$logcislo");
							MySQL_Query("update uzivatele set planety = $p where cislo=$logcislo");
						else:
							$kdy=Date("H:i:s j.m.Y",$c);
							echo "<font class='text_cerveny'>Planetu ".$zaznam3[nazev]." nem��eme opustit kv�li jej�mu ned�vn�mu obsazen�. Panuje na n� zmatek a my nejsme schopni se te� evakuovat. Toho budeme schopni nejd��ve v ".$kdy."</font>";
						endif;
					endif;
				else:
					echo "<font class='text_cerveny'>Centr�ln� planetu nelze opustit.</font>";				
				endif;
			};

		}

		if(isset($optl) and $_POST['over_post']==1):
			$vys3 = MySQL_Query("SELECT * FROM planety where cislo = $optl");
			$zaznam3 = MySQL_Fetch_Array($vys3);

			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa1 = $zaznam1["rasa"] ;

			$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika = MySQL_Fetch_Array($politika1);

			$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
			$narod = MySQL_Fetch_Array($narod1);

			$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
			$zriz = MySQL_Fetch_Array($zrizeni1);

			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);
			if($zaznam3[status]!=2):
				if($zaznam3["cislomaj"]==$logcislo):
					$c=$zaznam3[cas]+43200;
					if(Date("U")>$c):
						$bla = $zaznam2["planeta"]*$politika[cenap]/100*$zriz[planeta]/100;
						$bla*=(1+$zaznam1[planety]/10);
						$n=$zaznam1["penize"]+($bla*0.5);
						$pod=0.25;
						$n+=$zaznam3[vyrobna]*($zaznam2[vyr_cena]*$politika[cenas]/100)*$pod;
						$n+=$zaznam3[kasarna]*$zaznam2[kas_cena]*$pod;
						$n+=$zaznam3[mesta]*($zaznam2[mes_cena]*$politika[cenas]/100)*$pod;	
						$n+=$zaznam3[par]*($zaznam2[park_cena]*$politika[cenas]/100)*$pod;
						$n+=$zaznam3[pol]*($zaznam2[pol_cena]*$politika[cenas]/100)*$pod;
            $p=$zaznam1["planety"]-1;
						MySQL_Query("DELETE FROM planety WHERE cislo = $optl");
						MySQL_Query("update uzivatele set penize = $n where cislo=$logcislo");
						MySQL_Query("update uzivatele set planety = $p where cislo=$logcislo");
					else:
						$kdy=Date("H:i:s j.m.Y",$c);
						echo "<font class='text_cerveny'>Planetu ".$zaznam3[nazev]." nem��eme opustit kv�li jej�mu ned�vn�mu obsazen�. Panuje na n� zmatek a my nejsme schopni se te� evakuovat. Toho budeme schopni nejd��ve v ".$kdy."</font>";
					endif;
				else:
					echo "<font class='text_cerveny'>Tato planety nen� Va�e</font>";
				endif;
			else:
				echo "<font class='text_cerveny'>Centr�ln� planetu nelze opustit.</font>";				
			endif;
		endif;
				
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		$rasa1 = $zaznam1["rasa"] ;

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
		$politika = MySQL_Fetch_Array($politika1);

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=9 and mrtev!=1)");
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ=9");
		$typhs = MySQL_Fetch_Array($typhs2);

		$bstav=1-($stav[level]*$typhs[ucinek]);

		if($stav[cislomaj]!=$logcislo){$bstav=1;};
		//echo "<font class =info>".$bstav;
		$cislos=$stav[cislo];

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
		$zriz = MySQL_Fetch_Array($zrizeni1);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = $logcislo ORDER BY nazev ASC");	
		

		
		$bla = $zaznam2["planeta"]*$bstav*($politika[cenap]/100)*($zriz[planeta]/100)*(1+$zaznam1[planety]/10) * 5;
		echo "<font class='text_bili'>M��ete os�dlit n�hodnou planetu za <font class='text_cerveny'>".number_format($bla,0,0," ")."</font> kg nebo os�dlit c�lenou planetu za <font class='text_cerveny'>".number_format((5*$bla),0,0," ")."</font> kg. Planetu m�ete opustit za <font class='text_cerveny'>".number_format(($bla/2),0,0," ")." </font>kg.</font><br><br>";

?>
		<form name="form" method="post" action="hlavni.php?page=planety4">
<center>
<table border='1'>
		<tr>
			<td><font class='text_bili'>Jm�no planety</font></td>
			<td><input type=text name="nazev1"></td>
		</tr>
		<tr>		
			<td><font class='text_bili'>Vyberte typ planety</font></td><td>
<?
			$typpp = MySQL_Query("SELECT typ FROM typp");
			echo "<select name='typ'>";
				echo "<option>n�hodn�";
				while ($typp = MySQL_Fetch_Array($typpp)):
					if ($typp["typ"]=='dobyvaci') {echo "";} else {echo "<option>".$typp["typ"];}
				endwhile;
    		 	 echo "</select><br>";

//&nbsp;&nbsp;&nbsp;
?>
		</tr>
		
              <input type='hidden' name='over_post' value=1><input type='hidden' name="vyber" value="os">
              <font class='text_bili'><input type='hidden' name='over_post' value=1></font>       
		<tr>
		<td colspan='2' align=center><input type=submit value="Os�dlit" name="os" >
		<input type=hidden value="hm" name="odesli">
                </td>
               
                </tr>
		</form></center></font>
</table>

<table>
<tr>
<td>
<?


		echo "<TABLE border='1'>";

	echo "<center><br><br><font class='text_bili'><font class='text_modry'>S</font>eznam typ� planet</font><br><br>";

	$plan = MySQL_Query("SELECT * FROM typp limit 0,11");
	
	echo "<TABLE border=''>";
	echo "<tr>";
	echo "<th><font class='text_modry'>Obr</font></th>";
	echo "<th><font class='text_modry'>Typ</font></th>";
	echo "<th><font class='text_modry'>Po�et m�st</font></th>";
	echo "<th><font class='text_modry'>N�r�st populace</font></th>";
	echo "<th><font class='text_modry'>Cena m�st</font></th>";
	echo "<th><font class='text_modry'>Dal�� vlastnosti</font></th>";
	echo "</tr>";
	$i=1;
	while ($pla = MySQL_Fetch_Array($plan)):
		$vlast="";
		if($pla[obrana]>0){$vlast.="zv��en� obrana o ".$pla[obrana]."%<br>";};
		if($pla[obchod]>0){$vlast.="zv��en� v�hodnosti obchodu o ".($pla[obchod]/10)."%<br>";};
		if($pla[spokojenost]>0){$vlast.="zv��en� spokojenost o ".$pla[spokojenost]."%<br>";};
		if($pla[vyzkum]>0){$vlast.="zv��en� v�zkum o ".$pla[vyzkum]."%<br>";};
		if($pla[prijem]>0){$vlast.="p�id�v� ".fcis(($pla[prijem]*$zaznam2[vyr_vyrob]))." kg naquadahu denn�<br>";};
		$vlast.="&nbsp;";
		echo "<tr>";
		echo "<td><img border='0' src='obr/zp".$i.".JPG'  width='100'></a></td>";
		echo "<td><font class='text_bili'>".$pla[typ]."</font></td>";
		echo "<td><font class='text_bili'>".$pla[mest]."</font></td>";
		echo "<td><font class='text_bili'>".$pla[populace]."%</font></td>";
		echo "<td><font class='text_bili'>".$pla[cmesta]."% ceny</font></td>";
		echo "<td><font class='text_bili'>".$vlast."</font></td>";
		echo "</tr>";
		$i++;
	endwhile;
	echo "</table></center>";
MySQL_Close($spojeni);		
?>

</td>
</tr>
</table>

</body>
</html>
