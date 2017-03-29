

<?

mysql_query("SET NAMES cp1250");

	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");	

	$zaznam1 = MySQL_Fetch_Array($vys1);	

	

	require("adkontrola.php");



if(isset($_POST["msg"])){

    $msg = $_POST["msg"];

    $msg=Str_Replace("\r\n","<br>",$msg);

    $msg=NL2BR($msg);

    $edit_msg = mysql_query("UPDATE servis SET admin_zprava = '$msg'") or die("chyba");

}



if(isset($hracn) and $_POST['over_post']==1):

		do{

			$vys2 = MySQL_Query("SELECT jmeno FROM uzivatele");

			while($hrac2 = MySQL_Fetch_Array($vys2)):

				if($hrac2["jmeno"]==$hracn){$dobre=1;break;};		

			endwhile;

			if($dobre!=1){echo "<h1>Neexistující login</h1>";break;};

			$kontrola1 = MySQL_Query("SELECT cislo,jmeno,penize FROM uzivatele where jmeno = '$hracn'");

			do{

				$dobre2=1;

				$kontrola=MySQL_Fetch_Array($kontrola1);

				if($hracn==$kontrola[jmeno]){$dobre2=0;$cislo=$kontrola[cislo];};

			}while($dobre2);

			$p=$kontrola[penize]+$naq;

			MySQL_Query("update uzivatele set penize=$p where cislo=$cislo");

			echo "<h1>Hráèi $hracn posláno $naq naq.</h1>";



		  	$den = Date("U");

			$jmeno="$logjmeno";

			$rasa="admin";

			$text="Hráèi $hracn posláno jako kompenzace $naq naq.";

			$text=HTMLSpecialChars($text);

			$text=NL2BR($text);

			$text=AddSlashes($text);

			$stat=6;

			$kde="sys";

			//MySQL_Query("INSERT INTO forum (den,jmeno,rasa,text,kde,stat) VALUES ('$den','$jmeno','$rasa','$text','$kde',$stat)");			

				MySQL_Query ("INSERT INTO forum VALUES('0','$den','$jmeno','$rasa','$text','$kde','$stat','$titulek','$pohlavi','$stat_2','$rasa', '$logcislo')");

      

      MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('1',$den,'$hracn','poslán naq hráèi',$naq,'$zaznam1[jmeno]')");

		}while(false);

	endif;

	

	if(isset($rase) and $_POST['over_post']==1):

		$vys2 = MySQL_Query("SELECT rasa,fond FROM vudce where rasa=$rase");	

		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa=$rase");	

		$zaznam3 = MySQL_Fetch_Array($vys3);		

		

		$p=$zaznam2[fond]+$naq;

		MySQL_Query("update vudce set fond=$p where rasa=$rase");

		echo "<h1>Rase $zaznam3[nazevrasy] posláno $naq naq.</h1>";

	 	$den = Date("U");

		$jmeno="$logjmeno";

		$rasa="admin";

		$text="Rase $zaznam3[nazevrasy] posláno jako kompenzace $naq naq.";

		$text=HTMLSpecialChars($text);

		$text=NL2BR($text);

		$text=AddSlashes($text);

		$stat=6;

		$kde="sys";

			$vys11 = MySQL_Query("SELECT nazevrasy FROM rasy where rasa = '$logcislo'");	

    	$zaznam11 = MySQL_Fetch_Array($vys11);	

	//	MySQL_Query("INSERT INTO forum (den,jmeno,rasa,text,kde,stat) VALUES ('$den','$jmeno','$rasa','$text','$kde',$stat)");	

		MySQL_Query ("INSERT INTO forum VALUES('0','$den','$jmeno','$rasa','$text','$kde','$stat','$titulek','$pohlavi','$stat_2','$rasa', '$logcislo')");

      

  	MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('3',$den,'$zaznam3[nazevrasy]','poslán naq rase',$naq,'$zaznam1[jmeno]')");							

	endif;

	

	if(isset($hrach) and $_POST['over_post']==1):

		do{

			$vys2 = MySQL_Query("SELECT jmeno,heslo FROM uzivatele");

			while($hrac2 = MySQL_Fetch_Array($vys2)):

				if($hrac2["jmeno"]==$hrach){$dobre=1;break;};		

			endwhile;

			if($dobre!=1){echo "<h1>Neexistující login</h1>";break;};

			$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$hrach'");

			do{

				$dobre2=1;

				$kontrola=MySQL_Fetch_Array($kontrola1);

				if($hrach==$kontrola[jmeno]){$dobre2=0;$cislo=$kontrola[cislo];};

			}while($dobre2);

			$den=Date("U");

			$h=md5($heslo);//echo "$heslo<br>$cislo<br>$h<br>$kontrola[jmeno]";

			MySQL_Query("update uzivatele set heslo='$h' where cislo=$cislo");

	    MySQL_Query("INSERT INTO log (cil,den,cilt,akce,admin) VALUES ('18',$den,'$hrach','zmeneno heslo','$zaznam1[jmeno]')");

    	echo "<h1>Hráèi $hrach heslo zmìnìno.</h1>";

		}while(false);

	endif;

	

	if(isset($cp) and $_POST['over_post']==1):

		do{

			$vys3 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa=$rasecp");	

			$zaznam3 = MySQL_Fetch_Array($vys3);

			

			$vys5 = MySQL_Query("SELECT cislo,sila FROM uzivatele where rasa=$rasecp order by sila DESC");	

			$zaznam5 = MySQL_Fetch_Array($vys5);			

			

			$vys4 = MySQL_Query("SELECT cislo,cp FROM servis where cislo=1");	

			$zaznam4 = MySQL_Fetch_Array($vys4);

			

			$nazavrasyprocp=addslashes($zaznam3[nazevrasy]);

			//echo "<h6>$nazavrasyprocp";

			$lidi=5000000000;

			$mesta=500;

			$vyrobna=55000;

			$den = Date("U");

			$cislo=$zaznam5[cislo];

			$typ="Veliké mìsto";

			MySQL_Query("insert into planety (cislo,nazev,majitel,cislomaj,lidi,mesta,vyrobna,typ,status) values($zaznam4[cp],'$cp','$nazavrasyprocp',$cislo,$lidi,$mesta,$vyrobna,'$typ',2)");	

			MySQL_Query("insert into log (cil,admin,akce,konk,cilt,den) values ('9','$zaznam1[jmeno]','vytvoøení CP','$cp','$nazavrasyprocp',$den)");

      //, '$zaznam3[nazevrasy]', 'vytvoreni CP', '$nazavrasyprocp', '$zaznam1[jmeno]')");

      $c=$zaznam4[cp]+1;

			MySQL_Query("update servis set cp = $c where cislo=1");

			}while(false);

	endif;

	

	if(isset($dbp) and $_POST['over_post']==1):

		do{

			$vys3 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa=$rasedbp");	

			$zaznam3 = MySQL_Fetch_Array($vys3);

			

			$vys5 = MySQL_Query("SELECT cislo,sila FROM uzivatele where rasa=$rasedbp order by sila DESC");	

			$zaznam5 = MySQL_Fetch_Array($vys5);			

			

			$vys4 = MySQL_Query("SELECT cislo,cp FROM servis where cislo=1");	

			$zaznam4 = MySQL_Fetch_Array($vys4);

			

			$nazavrasyprodbp=addslashes($zaznam3[nazevrasy]);

			//echo "<h6>$nazavrasyprocp";

			$lidi=3950000;

			$mesta=500;

			$vyrobna=28000;

			$den = Date("U");

			$cislo=$zaznam5[cislo];

			$typ="dobyvaci";

			MySQL_Query("insert into planety (cislo,nazev,majitel,cislomaj,lidi,mesta,vyrobna,typ,status) values($zaznam4[cp],'$dbp','$nazavrasyprodbp',$cislo,$lidi,$mesta,$vyrobna,'$typ',3)");	

			MySQL_Query("insert into log (cil,admin,akce,konk,cilt,den) values ('10','$zaznam1[jmeno]','vytvoøení PP','$dbp','$nazavrasyprodbp',$den)");

			$c=$zaznam4[cp]+1;

			MySQL_Query("update servis set cp = $c where cislo=1");

		}while(false);

	endif;



	if(isset($posta) and $_POST['over_post']==1):

		switch($posta){

			case 0:

				$vys2 = MySQL_Query("SELECT jmeno,posta FROM uzivatele");

				$text=HTMLSpecialChars($text);

				$text=NL2BR($text);

				$text=AddSlashes($text);

				$text="Admin pošta pro všechny:<br>".$text;

				$den = Date("U");

				$odesilatel="Admin";

				$adresat="všichni";

				$rasa="admin";

				MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text,rasa2) VALUES ($den,'$odesilatel','$adresat','$rasa','$text','$rasa')");				

				//MySQL_Query("update uzivatele set posta=+1");

				break;

			case 1:

				$i=0;

				$odesilatel="Admin";

				$adresat="vùdcové";

				$den = Date("U");

				$rasa="admin";

				$predmet = $_POST["predmet"];

				$predmet=HTMLSpecialChars($predmet);

				$predmet=NL2BR($predmet);

				$predmet=AddSlashes($predmet);

				$text=HTMLSpecialChars($text);

				$text=NL2BR($text);

				$text=AddSlashes($text);

				$text="Admin pošta, pro všechny vùdce:<br>".$text;

				$sql_vudce_posta = mysql_query("SELECT jmeno, rasa FROM uzivatele WHERE status = '1'");

				while($row = mysql_fetch_array($sql_vudce_posta)){

          $adresat = $row["jmeno"];

          $rasa_prijemce = $row["rasa"];

        $id_posta = MySQL_Query("SELECT id FROM pocitani_id WHERE sekce='posta' ");

		    $id_posta_1 = MySQL_Fetch_Array($id_posta);

        $id=$id_posta_1[id]+1;

		    MySQL_Query("update pocitani_id set id='$id' WHERE sekce='posta' ") or die(mysql_error());

				

				echo "odesila se posta pro vudce $adresat :)<br />";

        MySQL_Query("INSERT INTO posta (id,odeslano_kdy,odesilatel,adresat,nazev,rasa_odesilatel,text,rasa_prijemce,`p/n`,typ,smaz) VALUES ($id,$den,'$odesilatel','$adresat','$predmet','99','$text','$rasa_prijemce','n','2','0')") or die("nejde odeslat");

				

        MySQL_Query("update uzivatele set posta = posta + 1 where jmeno = '$adresat'");



        

        }

        





				break;			

			case 2:

				$vys9 = MySQL_Query("SELECT jmeno,cislo,posta FROM uzivatele where jmeno = '$komu'");

				$zaznam9 = MySQL_Fetch_Array($vys9);

				$odesilatel="Admin";

				$adresat=$komu;

				$rasa5="admin";

				$rasa6="admin";

				$text=HTMLSpecialChars($text);

				$text=NL2BR($text);

				$text=AddSlashes($text);

				$i=0;

				do{

					if($i>30){break;};

					$proved=1;

					$den = Date("U");

					MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text,rasa2) VALUES ($den,'$odesilatel','$adresat','$rasa5','$text','$rasa6')");

					$kont2 = MySQL_Query("SELECT den,odesilatel FROM posta where den=$den");

					$kont = MySQL_Fetch_Array($kont2);

					if($kont[odesilatel]=="admin"){$proved=0;};

					$i++;

				}while($proved);

				$p=$zaznam9["posta"]+1;	

				MySQL_Query("update uzivatele set posta = $p where jmeno = '$adresat'");

				break;

        

        

        case 3:

				$i=0;

				$odesilatel="Admin";

				$adresat="vùdcové";

				$den = Date("U");

				$rasa="admin";

				$predmet = $_POST["predmet"];

				$predmet=HTMLSpecialChars($predmet);

				$predmet=NL2BR($predmet);

				$predmet=AddSlashes($predmet);

				$text=HTMLSpecialChars($text);

				$text=NL2BR($text);

				$text=AddSlashes($text);

				$text="Admin pošta, pro všechny uèitele:<br>".$text;

				$sql_ucitel_posta = mysql_query("SELECT jmeno, rasa FROM uzivatele WHERE statusucitel = '1'");

				while($row = mysql_fetch_array($sql_ucitel_posta)){

          $adresat = $row["jmeno"];

          $rasa_prijemce = $row["rasa"];

        $id_posta = MySQL_Query("SELECT id FROM pocitani_id WHERE sekce='posta' ");

		    $id_posta_1 = MySQL_Fetch_Array($id_posta);

        $id=$id_posta_1[id]+1;

		    MySQL_Query("update pocitani_id set id='$id' WHERE sekce='posta' ") or die(mysql_error());

				

				echo "odesila se posta pro uèitele $adresat :)<br />";

        MySQL_Query("INSERT INTO posta (id,odeslano_kdy,odesilatel,adresat,nazev,rasa_odesilatel,text,rasa_prijemce,`p/n`,typ,smaz) VALUES ($id,$den,'$odesilatel','$adresat','$predmet','99','$text','$rasa_prijemce','n','2','0')") or die("nejde odeslat");

				

        MySQL_Query("update uzivatele set posta = posta + 1 where jmeno = '$adresat'");



        

        }

        

        		

		}

	endif;	

	

	if(isset($vyzkumco) and $_POST['over_post']==1):

		do{

			if($vyzkumkolik<0){echo "Èísla musí být vìtší jak nula";break;};

			$vys = MySQL_Query("select * from vyzkum");

			while($zaznam1 = MySQL_Fetch_Array($vys)):

				$cislo=$zaznam1[rasa];

				$rasa2 = MySQL_Query("select rasa,vyr_vyrob from rasy where rasa=$cislo");

				$zaznam2 = MySQL_Fetch_Array($rasa2);

				$max=$zaznam2[vyr_vyrob]*$vyzkumkolik;

				MySQL_Query("update vyzkum set max=$max where rasa=$cislo");

			endwhile;

			MySQL_Query("update servis set vyzkum='$vyzkumco' where cislo=1");			

			MySQL_Query("update vyzkum set kolik=0");			

		}while(false);

	endif;

	

	if(isset($hjmeno) and $_POST['over_post']==1):

		$hhr2 = MySQL_Query("select cislo,hrdinove from servis where cislo=1");

		$hhr = MySQL_Fetch_Array($hhr2);			

		$hrdinove=$hhr[hrdinove];

		$text=addslashes($text);

		$den = Date("U");

		$vek=Date("U")-(3600*24*20*12);

		//echo $hrdinove;

		MySQL_Query("insert into hrdinove (cislo,cislomaj,zivot,status,rasa,text,obr,jmeno,typ,level,zkus) values 

										('$hrdinove',0,'$vek',1,'$hrasa','$text','$hobr','$hjmeno','$htyp',25,250000)");



  	 $vys21 = MySQL_Query("SELECT nazev FROM typh where typ = '$htyp'");	

	   $zaznam21 = MySQL_Fetch_Array($vys21);	

   	 $vys22 = MySQL_Query("SELECT nazevrasy FROM rasy where rasa = '$hrasa'");	

	   $zaznam22 = MySQL_Fetch_Array($vys22);	



				

		MySQL_Query("insert into log (cil,admin,akce,konk,cilt,den) values ('8','$zaznam1[jmeno]','vytvoøení NH','$zaznam21[nazev]','$zaznam22[nazevrasy]',$den)");

		$hrdinove+=1;

		MySQL_Query("update servis set hrdinove='$hrdinove' where cislo=1");

	endif;

	

?>

</head>

<body>

<font class=text_bili>

<form name='form' method='post' action='hlavni.php?page=admin4'>

Poslat èastku <input type='text' name="naq" size=10> naq hráèi <input type='text' name='hracn'><input type='hidden' name='over_post' value=1><input type='submit' value="pošli">

</form>



<form name='form2' method='post' action='hlavni.php?page=admin4'>

Poslat <input type='text' name="naq" size=10> naq rase

<select name='rase'>";

<?

	$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa != 11");

	while ($zaznam4 = MySQL_Fetch_Array($vys4)):

		echo "<option value = ".$zaznam4[rasa].">".$zaznam4["nazevrasy"];

	endwhile;

?>

</select>

<input type='hidden' name='over_post' value=1><input type='submit' value='pošli'>	

</form>



<form name='form3' method='post' action='hlavni.php?page=admin4'>

Zmìnit hráèi <input type='text' name="hrach"> heslo na <input type='password' name="heslo" size=15><input type='hidden' name='over_post' value=1><input type='submit' value="zmìò">

</form>



<form name='form4' method='post' action='hlavni.php?page=admin4'>

Vytvoø CP se jménem <input type='text' name="cp" size=20> patøící rase

<select name='rasecp'>

<?

	$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa != 11");

	while ($zaznam4 = MySQL_Fetch_Array($vys4)):

		echo "<option value = ".$zaznam4[rasa].">".$zaznam4["nazevrasy"];

	endwhile;

?>

</select>

<input type='hidden' name='over_post' value=1><input type='submit' value='vytvoø'>	

</form>



<form name='form4' method='post' action='hlavni.php?page=admin4'>

Vytvoø dobývací planetu se jménem <input type='text' name="dbp" size=20> patøící rase

<select name='rasedbp'>

<?

	$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa != 11");

	while ($zaznam4 = MySQL_Fetch_Array($vys4)):

		echo "<option value = ".$zaznam4[rasa].">".$zaznam4["nazevrasy"];

	endwhile;

?>

</select>

<input type='hidden' name='over_post' value=1><input type='submit' value='vytvoø'>	

</form>



<form name='form5' method='post' action='hlavni.php?page=admin4'>

Pošli 

<select name='posta'>

	<?php //<option value=99>všem ?>

	<option value=1>vùdcùm

	<?php //<option value=2>jednotlivci	?>

	<option value=3>uèitelùm

</select>

 Pøedmìt: <input type='text' name='predmet' size='20'>	

<br><textarea name='text' rows=5 cols=60></textarea>

<br><input type='hidden' name='over_post' value=1><input type='submit' value='pošli'></form>



<form name='form6' method='post' action='hlavni.php?page=admin4'>

Vytvoø hrdinu <input type='text' name="hjmeno" size=20 value=jmeno> rase

<select name='hrasa'>

<?

	$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa != 11");

	while ($zaznam4 = MySQL_Fetch_Array($vys4)):

		echo "<option value = ".$zaznam4[rasa].">".$zaznam4["nazevrasy"];

	endwhile;

?>

</select><br>

typ 

<select name='htyp'>

<?

	$vys4 = MySQL_Query("SELECT typ,nazev FROM typh");

	while ($zaznam4 = MySQL_Fetch_Array($vys4)):

		echo "<option value = ".$zaznam4[typ].">".$zaznam4["nazev"];

	endwhile;

?>

</select>

 adresa obr <input type='text' name="hobr" size=20>

<br><textarea name='text' rows=5 cols=60>text k hrdinovi</textarea>

<br><input type='hidden' name='over_post' value=1><input type='submit' value='vytvoø'></form>

<?		

/*

	if(isset($zmena_vyzkumu)):			

		MySQL_Query("update vyzkum set nazevvyz='$vyzco1', max=$vyzmax1, kolik='0' WHERE rasa = '1'");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco2', max=$vyzmax2, kolik='0' WHERE rasa = 2");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco3', max=$vyzmax3, kolik='0' WHERE rasa = 3");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco4', max=$vyzmax4, kolik='0' WHERE rasa = 4");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco5', max=$vyzmax5, kolik='0' WHERE rasa = 5");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco6', max=$vyzmax6, kolik='0' WHERE rasa = 6");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco7', max=$vyzmax7, kolik='0' WHERE rasa = 7");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco8', max=$vyzmax8, kolik='0' WHERE rasa = 8");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco9', max=$vyzmax9, kolik='0' WHERE rasa = 9");

		MySQL_Query("update vyzkum set nazevvyz='$vyzco10', max=$vyzmax10, kolik='0' WHERE rasa = 10");

		MySQL_Query("update servis set vyzkum='$nazvyz' WHERE cislo = 1");

	endif;	

  

  if(isset($nuluj)):

		MySQL_Query("update vyzkum set kolik='0' WHERE rasa<11 and rasa>0");

  endif;  





    $border= 'border=1';

		echo "<br><br><br><b><u>Nastavení výzkumu:</b></u>";

		echo "<form action='hlavni.php?page=admin4' method='post'>";

		echo "<TABLE ".$table." ".$border.">";

		echo "<tr>";

		echo "<th>Rasa</th>";

		echo "<th>Cíl výzkumu</th>";

		echo "<th>Cena výzkumu</th>";

		echo "</tr>";

		

		$vyz1 = MySQL_Query("SELECT rasa, nazevrasy FROM rasy");

		while($row=mysql_fetch_array($vyz1)){

      $rasa2[$row["rasa"]] = $row["nazevrasy"];

    }

		

		for($i=1; $i<=10; $i++){ 

		  $vyz1 = MySQL_Query("SELECT * FROM vyzkum where rasa = $i");

		  $vyz1 = MySQL_Fetch_Array($vyz1);

		  echo "<tr>";

		  echo "<td>".$rasa2[$i]."</td>";		

		  echo "<td><input type='text' size = 30 value='$vyz1[nazevvyz]' name='vyzco$i'></td>";		

		  echo "<td><input type='text' size = 15 value='$vyz1[max]' name='vyzmax$i'></td>";		

		  echo "</tr>";

    }

		

		

		echo "</table>";

			$vys44 = MySQL_Query("SELECT * FROM servis where cislo=1");	

			$zaznam44 = MySQL_Fetch_Array($vys44);

		echo "<br></br><form>Název výzkumu: <input type='text' size = 30 value='$zaznam44[vyzkum]' name='nazvyz'>";



		echo "<tr>";

		echo "<input type='hidden' name='zmena_vyzkumu' value='1'>";

		echo "<input type='submit' value='zmìò'>";

		echo "</form>";



		echo "<form action='hlavni.php?page=admin4' method='post'><input type='hidden' name='nuluj' value='1'>";

		echo "<input type='submit' value='vynuluj výzkum'>";

		echo "</form>";

		echo "</tr>";

		*/



  if(isset($cena)):

		MySQL_Query("update rasy set jed7_cena='$agent',jed7_lidi=10 WHERE rasa>0");

  endif;  





$vys54 = MySQL_Query("SELECT jed7_cena FROM rasy where rasa=1");	

$zaznam54 = MySQL_Fetch_Array($vys54);

		echo "<tr>";



		echo "<br></br><form>Nastavení ceny agenta (soèasná cena je $zaznam54[jed7_cena] * výroba jedné tìžírny) : <input type='text' size = 5 value='$zaznam54[jed7_cena]' name='agent'>";

		echo "<input type='hidden' name='cena' value='1'>";

		echo "<input type='submit' value='zmìò'>";



/*		echo "<br></br><form>Cena zlodìje (soèasná cena je $zaznam54[jed6_cena] * výroba jedné tìžírny) : <input type='text' size = 5 value='$zaznam54[jed6_cena]' name='zlodej'>";

		echo "<input type='hidden' name='cena' value='1'>";

		echo "<input type='submit' value='zmìò'>";

*/		echo "</form>";

		echo "</tr>";



  	echo "<br><br><br><tr><form>";

  	echo "Postaví na každé CP 28 000 výroben ";

		echo "<input type='hidden' name='postavvyrovnynacp' value='1'>";

		echo "<input type='submit' value='postav výrobny na CP'>";

		echo "</form>";

		echo "</tr><br /><br /><br />";

		

		$sql_servis = mysql_query("SELECT admin_zprava FROM servis");

		$servis = mysql_fetch_array($sql_servis);

		

		echo "Zpráva dne(zobrazovana na infu): ";

		echo "<form method='post' action='hlavni.php?page=admin4'>";

		  echo "<textarea name='msg' cols='60' rows='6'>".$servis["admin_zprava"]."</textarea>";

		  echo "<input type='submit' value='Vloz zpravu'>";

		echo "</form>";



if(isset($postavvyrovnynacp)):

MySQL_Query("UPDATE `planety` SET lidi=3697000,vyrobna='28000' WHERE status='2';");

endif;

?>

</font>

</body>

</html>

</html>

