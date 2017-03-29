<?php
require("adkontrola.php");
//mysql_query("SET NAMES cp1250");
$vys1 = MySQL_Query("SELECT jmeno,rasa,heslo,cislo FROM uzivatele where cislo = '$logcislo'");	
$zaznam1 = MySQL_Fetch_Array($vys1);
?>


<font class=text_bili>
<form name='form' method='post' action='hlavni.php?page=admin1'>
<input type='text' name="hracn" value="<?echo $hracn?>">
<input type='submit' value="najdi hr��e">
</form>

<form name='form' method='post' action='hlavni.php?page=admin1'>
<input type='text' name="posta" value="<?echo $posta?>">
<input type='submit' value="po�ta   hr��e">
</form>

<form name='form' method='post' action='hlavni.php?page=admin1'>
<input type='text' name="planetan" value="<?echo $planetan?>">
<input type='submit' value="najdi planetu">
</form>

<form name='form' method='post' action='hlavni.php?page=admin1'>
<input type='text' name="planetanv" value="<?echo $planetanv?>">
<input type='submit' value="najdi CP">
</form>

<?		
		if (isset($prasa)) {
			$den = Date("U");
				$vys41 = MySQL_Query("SELECT * FROM rasy where rasa = '$prasa'");	
      	$zaznam41 = MySQL_Fetch_Array($vys41);
      MySQL_Query("UPDATE uzivatele SET rasa='$prasa', jed1=0, jed2=0, jed3=0, jed4=0, jed5=0, jed6=0, jed7=0, sila=0, penize=0 where jmeno='$hracn'"); /* presun do jine rasy - provedeni*/
			MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('4',$den,'$hracn','p�esun hr��e','$zaznam41[nazevrasy]','$zaznam1[jmeno]')");
			}

		if(isset($smaz)):
		//echo "aaaaaa $hracn";
		  	$den = Date("U");
			$jmeno="$zaznam1[jmeno]";
			$rasa="Bohov�";
			$text="Hr�� $hracn byl smaz�n";
			MySQL_Query("INSERT INTO log (cil,den,cilt,akce,admin) VALUES ('2','$den','$hracn','smaz�n� hr��e','$zaznam1[jmeno]')");
			
			$text=HTMLSpecialChars($text);
			$text=NL2BR($text);
			$text=AddSlashes($text);
			$stat=6;
			$kde="sys";
		//	MySQL_Query("INSERT INTO forum (den,jmeno,rasa,text,kde,stat) VALUES ('$den','$jmeno','$rasa','$text','$kde','$stat')");
     // MySQL_Query("INSERT INTO forum (den,jmeno,rasa,text,kde,stat,titulek,pohlavi,stat2,rasac,hrac_id) VALUES ('$den','$jmeno','$rasa','$text','$kde','$stat','','','','')");
			MySQL_Query ("INSERT INTO forum VALUES('0','$den','$jmeno','$rasa','$text','$kde','$stat','$titulek','$pohlavi','$stat_2','$rasa', '$logcislo')");
      
      
      $v1 = MySQL_Query("SELECT jmeno,cislo,koho,email FROM uzivatele where cislo = '$smaz'");	
			$z1 = MySQL_Fetch_Array($v1);				
			$email=$z1[email];echo $email;
			$zprava="Toto je informa�n� zpr�va ze hry stargate (http://sg-nb.cz). Jeliko� jste poru�il pravidla hry, tak byl v� profil $hracn smaz�n.";
			mail ($email,"Informa�n� zpr�va ze hry SG-NB",$zprava);
			//exit;			
			if($z1[koho]!=$hracn):
				$kdo=$z1[koho];
				$vys5 = MySQL_Query("SELECT jmeno,volen,ref FROM uzivatele where jmeno = '$kdo'");
				$zaznam5 = MySQL_Fetch_Array($vys5);
				$kolik=$zaznam5[volen]-1;
				MySQL_Query("update uzivatele set volen = $kolik where jmeno = '$kdo'");
			    MySQL_Query("DELETE FROM uzivatele WHERE cislo='$smaz'");
				MySQL_Query("DELETE FROM planety WHERE cislomaj = '$smaz'");
				MySQL_Query("DELETE FROM mul WHERE jmeno='$hracn'");
     			MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");					
				MySQL_Query("DELETE FROM multaci WHERE cislo='$smaz'");
			else:
				MySQL_Query("DELETE FROM uzivatele WHERE cislo='$smaz'");			
				MySQL_Query("DELETE FROM planety WHERE cislomaj = '$smaz'");
				MySQL_Query("DELETE FROM mul WHERE jmeno='$hracn'");
				MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");					
				MySQL_Query("DELETE FROM multaci WHERE cislo='$smaz'");
			endif;

			// Odstraneni hlasovani v referendech - begin
/*			$kdo=$z1[koho];
			$vys5 = MySQL_Query("SELECT ref,refn FROM uzivatele where jmeno = '$kdo'");
			$zaznam5 = MySQL_Fetch_Array($vys5);

		//	$refer = MySQL_Query("SELECT * FROM referendum where cislo ='0'");
		$refer = MySQL_Query("SELECT * FROM refnew where cislo ='0'");
			$ref = MySQL_Fetch_Array($refer);
		    if ($zaznam5[ref]==0) {
		      $aaa=$ref[ano]-1;
		      //MySQL_Query("update referendum set ano = '$aaa' where cislo='0'");
		      MySQL_Query("update refnew set ano = '$aaa' where cislo='0'");
		    } elseif ($zaznam5[ref]==2) {
		      $nnn=$ref[ne]-1;
		      //MySQL_Query("update referendum set ne = '$nnn' where cislo='0'");
		      MySQL_Query("update refnew set ne = '$nnn' where cislo='0'");
		    };
				
			$refer = MySQL_Query("SELECT * FROM referendum where cislo='$zaznam5[rasa]'");
			$ref = MySQL_Fetch_Array($refer);
		    if ($zaznam5[refn]==1) {
		      $aaa=$refn[ano]-1;
		      MySQL_Query("update referendum set ano = '$aaa' where cislo='$zaznam5[rasa]'");
		    } elseif ($zaznam5[refn]==2) {
		      $nnn=$refn[ne]-1;
		      MySQL_Query("update referendum set ne = '$nnn' where cislo='$zaznam5[rasa]'");
		    };	*/
			// Odstraneni hlasovani v referendech - end

			echo "<h1>Smaz�no</h1><BR>".$text."";exit;
		endif;	



		
		if(isset($smazp)):
		  	$den = Date("U");
			$jmeno="$zaznam1[jmeno]";
			$rasa="Bohov�";
			$text="Hr��i $hracn byla jako trest smaz�na planeta $smazpj";
			$text=HTMLSpecialChars($text);
			$text=NL2BR($text);
			$text=AddSlashes($text);
			$stat=6;
			$kde="sys";			
			//MySQL_Query("INSERT INTO forum (den,jmeno,rasa,text,kde,stat) VALUES ('$den','$jmeno','$rasa','$text','$kde','$stat')");			
				MySQL_Query ("INSERT INTO forum VALUES('0','$den','$jmeno','$rasa','$text','$kde','$stat','$titulek','$pohlavi','$stat_2','$rasa', '$logcislo')");
      
      MySQL_Query("delete FROM planety where cislo='$smazp'");
			MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('5','$den','$hracn','smaz�n� planety','$smazpj','$zaznam1[jmeno]')");							
		endif;



		if(isset($presun)):
				MySQL_Query("update uzivatele set rasa = '$presun' where jmeno = '$hracn'");
				echo "<script language=JavaScript>location.href='hlavni.php?page=admin1';</script>";
		endif;


		if(isset($odebrat)):
				MySQL_Query ("update uzivatele set admin='$jakaa' where jmeno='$hracn' ");
		endif;



		if(isset($hracn)) {
			$vys2 = MySQL_Query("SELECT jmeno,heslo FROM uzivatele");
			while($hrac2 = MySQL_Fetch_Array($vys2)):
				if($hrac2["jmeno"]==$hracn){$dobre=1;break;};		
			endwhile;
			if($dobre!=1){echo "<h1>Neexistuj�c� login</h1>";exit;};
			$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$hracn'");
			do{
				$dobre2=1;
				$kontrola=MySQL_Fetch_Array($kontrola1);
				if($hracn==$kontrola[jmeno]){$dobre2=0;$cislo=$kontrola[cislo];};
			}while($dobre2);
			
			echo "<form name='form' method='post' action='hlavni.php?page=admin1'>";
			echo "<br><input type='submit' name=action value='sma� tohoto hr��e'>";
			echo "<input type='hidden' name=hracn value='".$hracn."'>";
			echo "<input type='hidden' name=smaz value='".$cislo."'></form>";

			$vysh = MySQL_Query("SELECT * FROM uzivatele where cislo='$cislo'");
			$hrac = MySQL_Fetch_Array($vysh);


// Mezirasovy presun - begin
?>
<tr>
<td>
<h6><font class=text_modry>P</font>�esun hr��e k jin� rase:</h6>
<form name="form" method="post" action="hlavni.php?page=admin1&hracn=$hrac[jmeno]">
<input type='hidden' name="hracn" value="<?echo $hracn?>">
<input type='hidden' name="prasa" value="<?echo $hracn?>">
<select name='presun'>
<?
$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa>0 and rasa<100  order by rasa");
while ($zaznam4 = MySQL_Fetch_Array($vys4)):
	echo "<option value = ".$zaznam4[rasa];
	if ($rasa==$zaznam4["rasa"]) {echo " selected";}
	echo ">".$zaznam4["nazevrasy"]."</option>";
endwhile;
	echo "<option value ='77'>Restart_rasa</option>";
?>
</select>

<input type="submit" value="p�esu�">
</form>
</td>
<td>
<?
switch($zaznam1["rasa"]){
	case 1: break;
	case 2: $c="checked";
		break;
	case 3: $b="checked";
		break;
	case 4: $a="checked";
		break;				
	case 5: $a="checked";
			$b="checked";
			break;
	case 6: $a="checked";
			$c="checked";
			break;
	case 7: $b="checked";
			$c="checked";
			break;
	case 8: $a="checked";
			$b="checked";
			$c="checked";			
			break;									
};
?>






<?
// Mezirasovy presun - end

			$vyroba=$hrac[prijem];

if($hrac[admin]==1){$funkce="administr�tor";}

			
			if($hrac[icq]==""){$icq="nezad�no";}
			elseif($hrac[zobrd]==0 or $hrac[zobrd]==2){$icq="vypnuto";}
			else{$icq=$hrac[icq];}
		
			switch ($hrac["status"]){
			case 1:
				$status="v�dce";
				break;
			case 2:
				$status="z�stupce";
				break;
			case 3:
				$status="asistent";
				break;
			case 4:
				$status="vyhnanec";
				break;
			case 0:
				$status="ob�an";
				break;
			case 5:
				$status="ministr";
				break;				
			}		

			$cislorasy=$hrac["rasa"];
			$vys_ras = MySQL_Query("SELECT * FROM rasy where rasa = '$cislorasy'");
        	$zaznam_ras = MySQL_Fetch_Array($vys_ras);
			
			if($hrac[www]==""){$web="nezad�no";}
			 elseif($hrac[zobrd]==0 or $hrac[zobrd]==1){$web="vypnuto";}
  			 else{$web=$hrac[www];};		
			if($hrac[pohlavi]=="1"){$hrac[pohlavi]="mu�";}
			 else{$hrac[pohlavi]="�ena";};
			if($hrac[destinace]=="1"){$hrac[destinace]="z domova";}
			 elseif($hrac[destinace]=="2"){$hrac[destinace]="ze �koly �i herny";}			
			 elseif($hrac[destinace]=="3"){$hrac[destinace]="oboje";};						 
			$kdy_naposled=$hrac["posl"];
			$kdy_naposled2 = Date("d.m.Y H:i:s",$kdy_naposled);
			echo "<TABLE ".$table." ".$border." align=center>";
			echo "<tr>";
			echo "<th class=text_modry colspan = 2>".$hrac["jmeno"]."</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>rasa</th>";
			echo "<td>".$zaznam_ras["nazevrasy"]."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>status</th>";
			echo "<td>".$status."</td>";
			echo "</tr>";
	
			$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,admin FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);
			echo "<tr>";
			echo "<th>admin</th>";
			
			if($zaznam1["admin"]==1){
			echo "<td><form method='post' name='enter' action='hlavni.php?page=admin1&hracn=$hrac[jmeno]'>


<select name='jakaa'>

<option value='".$hrac[admin]."' >".$funkce."
<option value=1 >Hlavn� administr�tor 
<option value=0 >Odebrat pravomoce

</select>
<input type='submit' value='Zm�nit' name=odebrat></form></td>"; //"Ciz�m administr�tor�m ned�v�m Hlavn�ho admina(dtb �islo 1) ale v databazi p�epsat na ��slo 3 (TZN omezene funkce)"
			
			
    }
			
			else
			{
			 echo "<td>" . $funkce . "</td>";
      }
echo "</tr>";
			echo "<tr>";		
			echo "<th>Identifika�n� ��slo</th>";
			echo "<td>".$hrac["cislo"]."</td>";
			echo "</tr>";	

			echo "<tr>";
			echo "<th>zisk</th>";
			echo "<td> ".$vyroba." </td>";
			echo "</tr>";

			echo "<tr>";		
			echo "<th>registrov�n</th>";
			echo "<td>".Date("d.m.Y H:i:s",$hrac["vek"])."</td>";
			echo "</tr>";
			echo "<tr>";		
			echo "<th>v�k</th>";
			echo "<td>".Floor((Date("U")-$hrac["vek"])/86400)." dn�</td>";
			echo "</tr>";		
			echo "<tr>";		
			echo "<th>posledn� p�ihl�en�</th>";
			echo "<td>".$kdy_naposled2."</td>";
			echo "</tr>";	
			echo "<tr>";		
			echo "<th>email</th>";
			echo "<td>".$hrac["email"]."</td>";
			echo "</tr>";		
			echo "<tr>";
			echo "<th>penize</th>";
			echo "<td>".number_format($hrac["penize"],0,0," ")."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>populace</th>";
			echo "<td>".number_format($hrac["populace"],0,0," ")." milion�</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>pozemn�ch jed.</th>";
			echo "<td>".number_format($hrac["jed1"],0,0," ")."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>univerz�ln�ch jed.</th>";
			echo "<td>".number_format($hrac["jed2"],0,0," ")."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>orbit�ln�ch jed.</th>";
			echo "<td>".number_format($hrac["jed4"],0,0," ")."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>pojeban� zkurven� jed.</th>";
			echo "<td>".number_format($hrac["jed7"],0,0," ")."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>ZHN</th>";
			echo "<td>".number_format($hrac["jed3"],0,0," ")."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>�old�k�</th>";
			echo "<td>".number_format($hrac["jed5"],0,0," ")."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>zlod�j�</th>";
			echo "<td>".number_format($hrac["jed6"],0,0," ")."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>sila</th>";
			echo "<td>".number_format($hrac["sila"],0,0," ")." tis�c</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>mocnost</th>";
			echo "<td>".number_format(($hrac["populace"]*$hrac["sila"]*$hrac["planety"]*0.001),0,0," ")."</td>";		
			echo "</tr>";
			echo "<tr>";		
			echo "<th>po�et planet</th>";
			echo "<td>".$hrac["planety"]."</td>";
			echo "</tr>";
			echo "<tr>";		
			echo "<th>dnes dobyt</th>";
			echo "<td>".$hrac["dobyt"]." kr�t</td>";
			echo "</tr>";
			echo "<tr>";		
			echo "<th>ICQ#</th>";
			echo "<td>".$icq."</td>";
			echo "</tr>";
			echo "<tr>";		
			echo "<th>web</th>";
			echo "<td><a href='http://".$web."'>".$web."</a></td>";
			echo "</tr>";				
			echo "<tr>";		
			echo "<th>odkud</th>";
			echo "<td>" . $hrac[destinace] . "</td>";
			echo "</tr>";				
			echo "<tr>";		
			echo "<th>pohlav�</th>";
			echo "<td>" . $hrac[pohlavi] . "</td>";
			echo "</tr>";
			echo "</table>";

//echo $hracn;
			$pmm = MySQL_Query("SELECT * FROM mul where jmeno = '$hracn'");
			$pm = MySQL_Fetch_Array($pmm);

			$id=$pm[id];
			$c1=$pm[c1];
			$c2=$pm[c2];
			$c3=$pm[c3];
			$c4=$pm[c4];
			$c5=$pm[c5];
			$c6=$pm[c6];
			$c7=$pm[c7];
			$c8=$pm[c8];
			$c9=$pm[c9];
			$c10=$pm[c10];
			$p0=$p1=$p2=$p3=$p4=$p5=0;

			echo "hr��i se stejn�m heslem: <br>";
			$mmm = MySQL_Query("SELECT * FROM uzivatele where heslo = '$hrac[heslo]'");
			while($a = MySQL_Fetch_Array($mmm)):
				if($a[jmeno]!=$p){echo $a[jmeno].", ";$pp0[]=$a[jmeno];$p0++;};
			endwhile;
			echo "<br><br>";

			echo "hr��i se stejnou adresou id: <br>";
			$mmm = MySQL_Query("SELECT * FROM mul where id = '$id'");
			while($a = MySQL_Fetch_Array($mmm)):
				if($a[jmeno]!=$p){echo $a[jmeno].", ";$pp0[]=$a[jmeno];$p0++;};
			endwhile;
			echo "<br>";
			
			echo "<br>";
  			if($pm[c1]!=0):
			echo "hr��i se stejn�m 1. cookie: <br>";
			$mc1 = MySQL_Query("SELECT * FROM mul where c1 = '$c1'");
			while($a = MySQL_Fetch_Array($mc1)):
				if($a[jmeno]!=$p){echo $a[jmeno].", ";$pp1[]=$a[jmeno];$p1++;};
			endwhile;
			echo "<br>";
			endif;
			if($pm[c2]!=0):
			echo "hr��i se stejn�m 2. cookie: <br>";
			$mc1 = MySQL_Query("SELECT * FROM mul where c2 = $c2");
			while($a = MySQL_Fetch_Array($mc1)):
				if($a[jmeno]!=$p){echo $a[jmeno].", ";$pp2[]=$a[jmeno];$p2++;};
			endwhile;
			echo "<br>";
			endif;
			if($pm[c3]!=0):
			echo "hr��i se stejn�m 3. cookie: <br>";
			$mc1 = MySQL_Query("SELECT * FROM mul where c3 = '$c3'");
			while($a = MySQL_Fetch_Array($mc1)):
				if($a[jmeno]!=$p){echo $a[jmeno].", ";$pp3[]=$a[jmeno];$p3++;};
			endwhile;
			echo "<br>";
			endif;
			if($pm[c4]!=0):
			echo "hr��i se stejn�m 4. cookie: <br>";
			$mc1 = MySQL_Query("SELECT * FROM mul where c4 = '$c4'");
			while($a = MySQL_Fetch_Array($mc1)):
				if($a[jmeno]!=$p){echo $a[jmeno].", ";$pp4[]=$a[jmeno];$p4++;};
			endwhile;
			echo "<br>";
			endif;
			if($pm[c5]!=0):
			echo "hr��i se stejn�m 5. cookie: <br>";
			$mc1 = MySQL_Query("SELECT * FROM mul where c5 = '$c5'");
			while($a = MySQL_Fetch_Array($mc1)):
				if($a[jmeno]!=$p){echo $a[jmeno].", ";$pp5[]=$a[jmeno];$p5++;};
			endwhile;
			echo "<br>";
			endif;
			echo "<br>";			
   			$pc=9;
			if($c1!=0 and $c2!=0){if($c1==$c2){$pc--;};};//echo $pc;
			if($c1!=0 and $c3!=0){if($c1==$c3){$pc--;};};//echo $pc;
			if($c1!=0 and $c4!=0){if($c1==$c4){$pc--;};};//echo $pc;
			if($c1!=0 and $c5!=0){if($c1==$c5){$pc--;};};//echo $pc;
			if($c2!=0 and $c3!=0){if($c2==$c3){$pc--;};};//echo $pc;
			if($c2!=0 and $c4!=0){if($c2==$c4){$pc--;};};//echo $pc;
			if($c2!=0 and $c5!=0){if($c2==$c5){$pc--;};};//echo $pc;
			if($c3!=0 and $c4!=0){if($c3==$c4){$pc--;};};//echo $pc;
			if($c3!=0 and $c5!=0){if($c3==$c5){$pc--;};};//echo $pc;
			if($c4!=0 and $c5!=0){if($c4==$c5){$pc--;};};//echo $pc;
			if($c1==0){$pc--;};
	        if($c2==0){$pc--;};
			if($c3==0){$pc--;};
			if($c4==0){$pc--;};
			if($c5==0){$pc--;};
			if($c7==0){$pc--;};
			if($c8==0){$pc--;};
			if($c9==0){$pc--;};
			if($c10==0){$pc--;};
			echo "po�et po��ta��, z kter�ch hraje: ".$pc."<br>";
			echo "po�et hr��� se stejn�m id: ".$p0."<br>";
			echo "po�et hr��� se stejn�m 1. cookie: ".$p1."<br>";
			echo "po�et hr��� se stejn�m 2. cookie: ".$p2."<br>";
			echo "po�et hr��� se stejn�m 3. cookie: ".$p3."<br>";
			echo "po�et hr��� se stejn�m 4. cookie: ".$p4."<br>";
			echo "po�et hr��� se stejn�m 5. cookie: ".$p5."<br>";
			echo "<br>";
		
			$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj='$cislo'");
	
			echo "<TABLE ".$table." ".$border.">";
			echo "<tr>";
			echo "<th>&nbsp;</th>";
			echo "<th>n�zev</th>";
			echo "<th>typ</th>";
			echo "<th>obyvatel</th>";
			echo "<th>m�st</th>";
			echo "<th>v�roben</th>";
			echo "<th>kas�ren</th>";
			echo "<th>obran</th>";
			echo "<th>park�</th>";
			echo "<th>laborato��</th>";
			echo "<th>hv. br�na</th>";
			echo "</tr>";
			while ($zaznam3 = MySQL_Fetch_Array($vys3)):
				if($zaznam3["brana"]==1):
					$brany="ano";
					$plus=20;
				else:
					$brany="ne";
				endif;
				$dom="";
				if($zaznam3[status]==1){$dom="<i>(domovsk�)</i>";};
				if($zaznam3[status]==2){$dom="<i>(centr�ln�)</i>";};
			    if($zaznam3[status]==3){$dom="<i>(dob�vac�)</i>";};
				echo "<tr>";
				echo "<form name='form' method='post' action='hlavni.php?page=admin1' >";
				echo "<td>
			  		<input type='submit' value='smazat'>
					<input type='hidden' name='smazp' value=".$zaznam3[cislo].">
					<input type='hidden' name=hracn value='".$hracn."'>
					<input type='hidden' name=smazpj value='".$zaznam3["nazev"]."'>					
				     </td>";
				echo "<td><font class='text_modry'>".$zaznam3["nazev"]."".$dom."</font></td>";
				echo "<td>".$zaznam3["typ"]."</td>";
				echo "<td>".number_format($zaznam3["lidi"]/1000000,0,0," ")." mil.</td>";
				echo "<td>".$zaznam3["mesta"]."</td>";
				echo "<td>".$zaznam3["vyrobna"]."</td>";
				echo "<td>".$zaznam3["kasarna"]."</td>";
				echo "<td>".$zaznam3["sdi"]."</td>";
				echo "<td>".$zaznam3["par"]."</td>";
				echo "<td>".$zaznam3["laborator"]."</td>";
				echo "<td>".$brany."</td>";
				echo "</form></tr>";
				$people_conf+=$zaznam3["lidi"];
			endwhile;
			echo "</table>";			
			echo number_format($people_conf/1000000,0,0," ");
	}



	// Utoky - begin
if(isset($hracn)) {
	echo "<br><br><h6><font class=text_modry>V</font>a�e (jeho ;-)) vojensk� aktivity</h6>";
	echo "<TABLE ".$border." ".$table.">";

	$utok_hrac=$hrac[jmeno];
	if(empty($xm) or $xm<0){$xm=0;};

	$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$zaznam_ras[rasa]'");
	$zaznam2 = MySQL_Fetch_Array($vys2);
	
	$vys4 = MySQL_Query("SELECT * FROM utok where (utocnik='$utok_hrac' or obrance='$utok_hrac') ORDER BY den DESC LIMIT $xm,5");
    while ($zaznam4 = MySQL_Fetch_Array($vys4)):
		$datum = Date("G:i:s j.m.Y",$zaznam4["den"]);
      	switch($zaznam4[typ]){
            case 0: $typu="obsazovac�";break;
            case 1: $typu="pomoc� zhn";break;
            case 2: $typu="partyz�nsk�";break;
            case 3: $typu="univerz�ln�";break;
            case 4: $typu="orbit�ln�";break;
            }
      	if($zaznam4["utocnik"]==$utok_hrac or $zaznam4["obrance"]==$utok_hrac):
				echo "<tr>";
				echo "<td><b>datum</b></td>";
				echo "<td><b>".$datum."</b></td>";
				echo "</tr>";
  				echo "<tr>";
       		if($zaznam4["utocnik"]==$utok_hrac):
		  		$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$zaznam4[orasa]'");
  				$zaznam5 = MySQL_Fetch_Array($vys5);
          		$my="u";$on="o";$uts="poslali jsme na n�j";$obs="zni�ili jsme mu";
  				echo "<td class='text_modry'>uto�ili jsme na</td><td>".$zaznam4["obrance"]." (".$zaznam5["nazevrasy"].")<td>";
        	else:
		  		$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$zaznam4[urasa]'");
  				$zaznam5 = MySQL_Fetch_Array($vys5);
		        $my="o";$on="u";$uts="poslal na n�s";$obs="zni�il n�m";
  				echo "<td class='text_modry'>uto�ili na n�s</td><td>".$zaznam4[utocnik]." (".$zaznam5["nazevrasy"].")<td>";
        	endif;
				echo "</tr>";
				echo "<tr>";
				echo "<td class=text_modry>typ �toku</td><td>".$typu."<td>";
				echo "</tr>";
				echo "<tr>";
        	if($zaznam4[typ]==0):
				echo "<td  class='text_modry'>na�e ztr�ty</td><td>";
				if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed1_nazev"];};
          		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
	          	if($zaznam4[($my.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
    	      	if($zaznam4[($my.'jed4')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed4')]." * ".$zaznam2["jed4_nazev"];};
        	  	if($zaznam4[($my.'jed1')]<1 and $zaznam4[($my.'jed2')]<1 and $zaznam4[($my.'jed4')]<1 and $zaznam4[($my.'jed5')]<1){echo "��dn�";};
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='text_modry'>jeho ztr�ty</td><td>";
		        if($zaznam4[($on.'jed1')]>0){echo $zaznam4[($on.'jed1')]." * ".$zaznam5["jed1_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
        		if($zaznam4[($on.'jed4')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed4')]." * ".$zaznam5["jed4_nazev"];};
		        if($zaznam4[($on.'jed1')]<1 and $zaznam4[($on.'jed2')]<1 and $zaznam4[($on.'jed4')]<1 and $zaznam4[($on.'jed5')]<1){echo "��dn�";};
				echo "</td>";
          		if($zaznam4["uspesnost"]==1):
		            $vysledeku="ziskali jsme planetu ".$zaznam4["planety"];
        		    $vysledeko="ztratily jsme planetu ".$zaznam4["planety"];
		        else:
        		    $vysledeku="nedobyli jsme planetu ".$zaznam4["planety"];
		            $vysledeko="ubr�nili jsme planetu ".$zaznam4["planety"];
        		endif;
			elseif($zaznam4[typ]==1):
 				echo "<td class='text_modry'>".$uts."</td><td>".$zaznam4["ujed1"]." * ".$zaznam2["jed3_nazev"]."</td>";
	  		  	echo "</tr>";
			    echo "<tr>";			
			    echo "<td class='text_modry'>".$obs."</td><td>".$zaznam4["ucinek"]."</td>";
          		if($zaznam4["uspesnost"]==1):
	        	    $vysledeku="prorazili jsme obranu na planet� ".$zaznam4["planety"];
    		        $vysledeko="prorazili na�� obranu na planet� ".$zaznam4["planety"];
		        else:
        		    $vysledeku="neprorazili jsme obranu na planet� ".$zaznam4["planety"];
		            $vysledeko="neprorazili na�� obranu na planet� ".$zaznam4["planety"];
        		endif;
			elseif($zaznam4[typ]==2):
				echo "<td  class='text_modry'>na�e ztr�ty</td><td>";
		        if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed1_nazev"];};
        		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($my.'jed1')]<1 and $zaznam4[($my.'jed5')]<1){echo "��dn�";};
		  		echo "</td></tr>";
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='text_modry'>jeho ztr�ty</td><td>";
		        if($zaznam4[($on.'jed1')]>0){echo $zaznam4[($on.'jed1')]." * ".$zaznam5["jed1_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed1')]<1 and $zaznam4[($on.'jed5')]<1){echo "��dn�";};
				echo "</td></tr>";
				echo "<tr>";			
  				echo "<td  class='text_modry'>ztr�ty v infrastruktu�e</td><td>".$zaznam4[ucinek]."</td>";
	  		    echo "</tr>";
    		    if($zaznam4["uspesnost"]==1):
            		$vysledeku="prorazili jsme obranu na planet� ".$zaznam4["planety"];
		            $vysledeko="prorazili na�� obranu na planet� ".$zaznam4["planety"];
        		else:
		            $vysledeku="neprorazili jsme obranu na planet� ".$zaznam4["planety"];
        		    $vysledeko="neprorazili na�� obranu na planet� ".$zaznam4["planety"];
		        endif;
		  elseif($zaznam4[typ]==3):
		    echo "<td  class='text_modry'>na�e ztr�ty</td><td>";
		        if($zaznam4[($my.'jed2')]>0){echo $zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
        		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($my.'jed2')]<1 and $zaznam4[($my.'jed5')]<1){echo "��dn�";};
		  		echo "</td></tr>";
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='text_modry'>jeho ztr�ty</td><td>";
		        if($zaznam4[($on.'jed2')]>0){echo $zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed2')]<1 and $zaznam4[($on.'jed5')]<1){echo "��dn�";};
				echo "</td></tr>";
				echo "<tr>";			
  				echo "<td  class='text_modry'>ztr�ty v infrastruktu�e</td><td>".$zaznam4[ucinek]."</td>";
	  		    echo "</tr>";
    		    if($zaznam4["uspesnost"]==1):
            		$vysledeku="prorazili jsme obranu na planet� ".$zaznam4["planety"];
		            $vysledeko="prorazili na�� obranu na planet� ".$zaznam4["planety"];
        		else:
		            $vysledeku="neprorazili jsme obranu na planet� ".$zaznam4["planety"];
        		    $vysledeko="neprorazili na�� obranu na planet� ".$zaznam4["planety"];
		        endif;
		  elseif($zaznam4[typ]==4):
		    echo "<td  class='text_modry'>na�e ztr�ty</td><td>";
		        if($zaznam4[($my.'jed4')]>0){echo $zaznam4[($my.'jed4')]." * ".$zaznam2["jed4_nazev"];};
        		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($my.'jed4')]<1 and $zaznam4[($my.'jed5')]<1){echo "��dn�";};
		  		echo "</td></tr>";
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='text_modry'>jeho ztr�ty</td><td>";
		        if($zaznam4[($on.'jed2')]>0){echo $zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
        		if($zaznam4[($on.'jed4')]>0){echo $zaznam4[($on.'jed4')]." * ".$zaznam5["jed4_nazev"];};
		        if($zaznam4[($on.'jed2')]<1 and $zaznam4[($on.'jed4')]<1){echo "��dn�";};
				echo "</td></tr>";
				echo "<tr>";			
  				echo "<td  class='text_modry'>ztr�ty v infrastruktu�e</td><td>".$zaznam4[ucinek]."</td>";
	  		    echo "</tr>";
    		    if($zaznam4["uspesnost"]==1):
            		$vysledeku="prorazili jsme obranu na planet� ".$zaznam4["planety"];
		            $vysledeko="prorazili na�� obranu na planet� ".$zaznam4["planety"];
        		else:
		            $vysledeku="neprorazili jsme obranu na planet� ".$zaznam4["planety"];
        		    $vysledeko="neprorazili na�� obranu na planet� ".$zaznam4["planety"];
		        endif;
		  elseif($zaznam4[typ]==5):
 				echo "<td class='text_modry'>".$uts."</td><td>".$zaznam4["ujed6"]." * ".$zaznam2["jed6_nazev"]." z nich bylo zat�eno, odsouzeno a popraveno ".$zaznam4["zujed6"]. " zlod�j�</td>";
 				//echo "<td  class='text_modry'>jeho ztr�ty</td><td>";
 				  echo "</tr>";
			    echo "<tr>";			
			    echo "<td class='text_modry'>".$oas."</td><td>".$zaznam4["ucinek"]."</td>";
          		if($zaznam4["uspesnost"]==1):
	        	    $vysledeku="na�im zlod�j�m se poda�ilo vykr�st z�soby naquadahu na planet� ".$zaznam4["planety"];
    		        $vysledeko="na planet� ".$zaznam4["planety"]. " se nezn�m�m zlod�j�m poda�ilo ukr�st z�soby naquadahu";
		        else:
        		    $vysledeku="na�i zlod�ji byli zat�eni, odsouzeni a popraveni na planet� ".$zaznam4["planety"]." ";
		            $vysledeko="poda�ilo se n�m chytit a popravit ciz� zlod�je na planet� ".$zaznam4["planety"];
        		endif;
        	endif;
			echo "<tr>";
			echo "<td class='text_modry'>v�sledek</td><td><font ";
			if($zaznam4["utocnik"]==$logjmeno):
		        echo "color='".$colortu."'>".$vysledeku;
			else:
				echo "color='".$colorto."'>".$vysledeko;
			endif;	
        	echo "</font></td>";
      	endif;
    endwhile;
	echo "</table><br>";
	$y=$xm+5;
	$z=$xm-5;
	echo "<h6><a href=hlavni.php?page=admin1&xm=".$z."&cislo=".$cislo."&hracn=".$hracn." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Nov�j��ch 5 �tok�</a><br>";
	echo "<a href=hlavni.php?page=admin1&xm=".$y."&cislo=".$cislo."&hracn=".$hracn." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Star��ch 5 �tok�</a></h6>";
	echo "</td></tr></table>";
}	
	// Utoky - end



	if(isset($posta)){
      if ($posta==""){echo "<h1>Mus�te zadat jm�no hr��e!</h1>";exit;}
    	if(empty($xm) or $xm<0){$xm=0;};
			$pla2 = mysql_Query("SELECT * FROM posta where (odesilatel='$posta' or adresat='$posta') order by odeslano_kdy desc LIMIT $xm,10");

	$y=$xm+10;
	$z=$xm-10;
	echo "<h6><a href=hlavni.php?page=admin1&xm=".$z."&cislo=".$cislo."&posta=".$posta." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Nov�j��ch 10 zpr�v</a><br>";
	echo "<a href=hlavni.php?page=admin1&xm=".$y."&cislo=".$cislo."&posta=".$posta." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Star��ch 10 zpr�v</a></h6>";

 			echo "<TABLE ".$table." ".$border." align=center>";
			echo "<tr>";
			echo "<th>�as</th>";
			echo "<th>odes�latel</th>";
			echo "<th>adres�t</th>";
			echo "<th>text</th>";
			echo "</tr>";

      while($planeta2 = mysql_Fetch_Array($pla2)):
			echo "<tr>";
			$p=Date("d.m.Y H:i:s",$planeta2[odeslano_kdy]);
			echo "<td><center>$p</td>";
			echo "<td><center>$planeta2[odesilatel]</td>";
			echo "<td><center>$planeta2[adresat]</td>";
			echo "<td>$planeta2[text]</td>";
			echo "</tr>";
      endwhile;
			echo "</table>";

	$y=$xm+10;
	$z=$xm-10;
	echo "<h6><a href=hlavni.php?page=admin1&xm=".$z."&cislo=".$cislo."&posta=".$posta." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Nov�j��ch 10 zpr�v</a><br>";
	echo "<a href=hlavni.php?page=admin1&xm=".$y."&cislo=".$cislo."&posta=".$posta." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Star��ch 10 zpr�v</a></h6>";


}


//*****najdi planetu start********

	if(isset($planetan)){
      if ($planetan==""){echo "<h1>Mus�te zadat n�zev planety!</h1>";exit;}
			$pla2 = mysql_Query("SELECT * FROM planety where nazev='$planetan'");
      $planeta2 = mysql_Fetch_Array($pla2);
echo "<br>";
echo "<br>";
echo "<br>";
 			echo "<TABLE ".$table." ".$border." align=center>";
			echo "<tr>";
			echo "<th class=text_modry colspan = 3>N�zev planety : ".$planeta2["nazev"]."</th>";
			echo "</tr>";

			echo "<form name='form' method='post' action='hlavni.php?page=admin1&planetan=$planetan'>";
			echo "<tr>";
			echo "<th>Majitel</th>";
			echo "<td><input type='text' size=22 name=majitel value='$planeta2[majitel]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Typ</th>";
			$typ12=$planeta2[typ];
			$typpp = MySQL_Query("SELECT typ FROM typp");
			echo "<td><select name='typ'>";
				while ($typp = MySQL_Fetch_Array($typpp)):
				$typ11="$typp[typ]";
        echo "<option value = '$typp[typ]'";
      	if ($typ11==$typ12){echo " selected";}
        echo ">".$typp["typ"]."</option>";
				endwhile;
    		 	 echo "</select></td></tr>";

			echo "<tr>";
			echo "<th>Po�et obyvatel</th>";
			$liidi=number_format($planeta2[lidi],0,0," ");
			echo "<td><input type='text' size=22 name=lidi value='$planeta2[lidi]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>M�st</th>";
			echo "<td><input type='text' size=22 name=mest value='$planeta2[mesta]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>V�roben</th>";
			echo "<td><input type='text' size=22 name=vyr value='$planeta2[vyrobna]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Kas�ren</th>";
			echo "<td><input type='text' size=22 name=kas value='$planeta2[kasarna]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>SDI</th>";
			echo "<td><input type='text' size=22 name=sdi value='$planeta2[sdi]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Pol. stanic</th>";
			echo "<td><input type='text' size=22 name=pol value='$planeta2[pol]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Park�</th>";
			echo "<td><input type='text' size=22 name=park value='$planeta2[par]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Datum posledn�ho obsazen�</th>";
			$obsaz=Date("d.m.Y H:i:s",$planeta2[cas]);
			echo "<td>$obsaz</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Laborato��</th>";
			echo "<td><input type='text' size=22 name=lab value='$planeta2[laborator]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Br�na</th>";
			if($planeta2[brana]==1){$bra="ano";};
			if($planeta2[brana]==0){$bra="ne";};
			echo "<td><select name='brana'>";
      echo "<option value=1";
      if ($bra==ano){echo " selected";}
       echo ">ano</option>";
      echo "<option value=0";
      if ($bra==ne){echo " selected";}
       echo ">ne</option>";
  	 	 echo "</select></td></tr>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Spokojenost</th>";
			echo "<td>$planeta2[spokojenost]</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>P�esunuto lid�</th>";
			echo "<td><input type='text' size=22 name=presun value='$planeta2[presun]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Posledn� p�ed�n�<br>(jen u CP)</th>";
			$pred=$planeta2[poslpredani]-86400;
      if($planeta2[status]==2){$presunuta=Date("d.m.Y H:i:s",$pred);}
      if($planeta2[status]!=2){$presunuta="nen� to CP";}
			echo "<td>$presunuta</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Status</th>";

			echo "<td><select name='status'>";
      echo "<option value=0";
      if ($planeta2[status]==0){echo " selected";}
       echo ">norm�ln�</option>";
      echo "<option value=1";
      if ($planeta2[status]==1){echo " selected";}
       echo ">domovsk�</option>";
      echo "<option value=2";
      if ($planeta2[status]==2){echo " selected";}
       echo ">centr�ln�</option>";
      echo "<option value=3";
      if ($planeta2[status]==3){echo " selected";}
       echo ">p��b�hov�</option>";
  	 	 echo "</select></td></tr>";

			echo "<th>P�ejmenov�n�</th><td><select name='prejm'>";
      echo "<option value=0";
      if ($planeta2[prejmen]==0){echo " selected";}
       echo ">nebyla p�ejmenov�na</option>";
      echo "<option value=1";
      if ($planeta2[prejmen]==1){echo " selected";}
       echo ">byla p�ejmenov�na</option>";
  	 	 echo "</select></td></tr>";

			echo "</table>";
      echo "<input type='submit' name=action value='zm��it detaily planety $planeta2[nazev]'>";
			echo "<input type='hidden' name=cislopl value='".$planeta2[cislo]."'></form><br><br>";

			echo "<form name='form' method='post' action='hlavni.php?page=admin1'>";
      echo "P�esunout tuto planetu hr��i <input type='text' name=planetapresun>";
			echo "<input type='submit' name=action value='p�esu�'>";
			
			echo "<input type='hidden' name=planetan value='".$planetan."'>";
			echo "<input type='hidden' name=puvmaj value='".$planeta2[majitel]."'>";
//			echo "<input type='hidden' name=smaz value='".$cislo."'></form>";
}

/***********presun CP*************/
if(isset($planetaCP)):
$pl11 = MySQL_Query("SELECT cislo FROM uzivatele where jmeno = '$planetapresun'");	
$zpl11 = MySQL_Fetch_Array($pl11);
$cislomajp=$zpl11[cislo];
if(MySQL_Query("update planety set cislomaj = '$cislomajp' where nazev='$planetanv'")){
$titulek="P�esun CP";
$text ="CP $planetanv p�enuta k hr��i  $planetapresun";

     	$den = Date("U");
			$jmeno="$zaznam1[jmeno]";
			$rasa="Bohov�";	
			$text=HTMLSpecialChars($text);
			$text=NL2BR($text);
			$text=AddSlashes($text);
			$stat=6;
			$kde="sys";

MySQL_Query ("INSERT INTO forum VALUES('0','$den','$jmeno','$rasa','$text','$kde','$stat','$titulek','$pohlavi','$stat_2','$rasa', '$logcislo')");
      
echo "<h1>P�esunuto</h1><BR>".$text."";exit;}
endif;




//*****najdi planetu start2********

	if(isset($planetanv)){
      if ($planetanv==""){echo "<h1>Mus�te zadat n�zev planety!</h1>";exit;}
			$pla2 = mysql_Query("SELECT * FROM planety where nazev='$planetanv' and status='2'");
      $planeta2 = mysql_Fetch_Array($pla2);
echo "<br>";
echo "<br>";
echo "<br>";
 			echo "<TABLE ".$table." ".$border." align=center>";
			echo "<tr>";
			echo "<th class=text_modry colspan = 3>N�zev planety : ".$planeta2["nazev"]."</th>";
			echo "</tr>";

			echo "<form name='form' method='post' action='hlavni.php?page=admin1&planetanv=$planetanv'>";
			echo "<tr>";
			echo "<th>Majitel</th>";
			echo "<td><input type='text' size=22 name=majitel value='$planeta2[majitel]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Typ</th>";
			$typ12=$planeta2[typ];
			$typpp = MySQL_Query("SELECT typ FROM typp");
			echo "<td><select name='typ'>";
				while ($typp = MySQL_Fetch_Array($typpp)):
				$typ11="$typp[typ]";
        echo "<option value = '$typp[typ]'";
      	if ($typ11==$typ12){echo " selected";}
        echo ">".$typp["typ"]."</option>";
				endwhile;
    		 	 echo "</select></td></tr>";

			echo "<tr>";
			echo "<th>Po�et obyvatel</th>";
			$liidi=number_format($planeta2[lidi],0,0," ");
			echo "<td><input type='text' size=22 name=lidi value='$planeta2[lidi]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>M�st</th>";
			echo "<td><input type='text' size=22 name=mest value='$planeta2[mesta]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>V�roben</th>";
			echo "<td><input type='text' size=22 name=vyr value='$planeta2[vyrobna]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Kas�ren</th>";
			echo "<td><input type='text' size=22 name=kas value='$planeta2[kasarna]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>SDI</th>";
			echo "<td><input type='text' size=22 name=sdi value='$planeta2[sdi]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Pol. stanic</th>";
			echo "<td><input type='text' size=22 name=pol value='$planeta2[pol]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Park�</th>";
			echo "<td><input type='text' size=22 name=park value='$planeta2[par]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Datum posledn�ho obsazen�</th>";
			$obsaz=Date("d.m.Y H:i:s",$planeta2[cas]);
			echo "<td>$obsaz</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Laborato��</th>";
			echo "<td><input type='text' size=22 name=lab value='$planeta2[laborator]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Br�na</th>";
			if($planeta2[brana]==1){$bra="ano";};
			if($planeta2[brana]==0){$bra="ne";};
			echo "<td><select name='brana'>";
      echo "<option value=1";
      if ($bra==ano){echo " selected";}
       echo ">ano</option>";
      echo "<option value=0";
      if ($bra==ne){echo " selected";}
       echo ">ne</option>";
  	 	 echo "</select></td></tr>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Spokojenost</th>";
			echo "<td>$planeta2[spokojenost]</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>P�esunuto lid�</th>";
			echo "<td><input type='text' size=22 name=presun value='$planeta2[presun]'></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Posledn� p�ed�n�<br>(jen u CP)</th>";
			$pred=$planeta2[poslpredani]-86400;
      if($planeta2[status]==2){$presunuta=Date("d.m.Y H:i:s",$pred);}
      if($planeta2[status]!=2){$presunuta="nen� to CP";}
			echo "<td>$presunuta</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<th>Status</th>";

			echo "<td><select name='status'>";
      echo "<option value=0";
      if ($planeta2[status]==0){echo " selected";}
       echo ">norm�ln�</option>";
      echo "<option value=1";
      if ($planeta2[status]==1){echo " selected";}
       echo ">domovsk�</option>";
      echo "<option value=2";
      if ($planeta2[status]==2){echo " selected";}
       echo ">centr�ln�</option>";
      echo "<option value=3";
      if ($planeta2[status]==3){echo " selected";}
       echo ">p��b�hov�</option>";
  	 	 echo "</select></td></tr>";

			echo "<th>P�ejmenov�n�</th><td><select name='prejm'>";
      echo "<option value=0";
      if ($planeta2[prejmen]==0){echo " selected";}
       echo ">nebyla p�ejmenov�na</option>";
      echo "<option value=1";
      if ($planeta2[prejmen]==1){echo " selected";}
       echo ">byla p�ejmenov�na</option>";
  	 	 echo "</select></td></tr>";

			echo "</table>";
      echo "<input type='submit' name=action value='zm��it detaily planety $planeta2[nazev]'>";
			echo "<input type='hidden' name=cislopl value='".$planeta2[cislo]."'></form><br><br>";

			echo "<form name='form' method='post' action='hlavni.php?page=admin1'>";
      echo "P�esunout tuto planetu hr��i <input type='text' name=planetapresun>";
			echo "<input type='submit' name=action value='p�esu�'>";
			echo "<input type='hidden' name=planetaCP value='CP'>";
			echo "<input type='hidden' name=planetanv value='".$planetanv."'>";
			echo "<input type='hidden' name=puvmaj value='".$planeta2[majitel]."'>";
//			echo "<input type='hidden' name=smaz value='".$cislo."'></form>";
}




		MySQL_Close($spojeni);

?>

</body>
</html>
