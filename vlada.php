<?php
unset($zaznam1);
unset($ser);
unset($zaznam2);
unset($zaznam3);
unset($zaznam4);
unset($zaznam8);
unset($zaznam888);
unset($zaznam9);
unset($zaznam99);
unset($zaznam10);
unset($zaznam11);
unset($zaznam12);
unset($vu);
unset($vudce1);
unset($vudce2);
unset($kontrola);
unset($kon);
unset($zv);
unset($rasa9);
unset($ciny);
unset($log);
unset($zaznam77);
unset($pochracu);
unset($zaznam777);
unset($volen);

require 'data_1.php';
require 'functions.php';

if(isset($auto)):
    if(($af=="on") && ($av=="on")){$aa=3;}
    if(($af!="on") && ($av=="on")){$aa=2;}
    if(($af=="on") && ($av!="on")){$aa=1;}
    if(($af!="on") && ($av!="on")){$aa=0;}
    MySQL_Query("update uzivatele set auto = $aa where cislo=$logcislo");
endif;

$vys1 = MySQL_Query("SELECT jmeno,heslo,gold,silver,penize,volen,koho,rasa,status,ref,cislo,hra,zmrazeni,skin,vek,admin,reg FROM uzivatele where cislo=$logcislo");
$zaznam1 = MySQL_Fetch_Array($vys1);
$statusmuj=$zaznam1['status'];
$nvyzk='upgrade všeho';
$cisloz=$zaznam1['cislo'];
$vekhrace = $zaznam1['vek'];

require 'kontrola.php';

$ser1 = MySQL_Query("SELECT cislo,vyzkum FROM servis where cislo=1");
$ser = MySQL_Fetch_Array($ser1);
$cil=$ser['vyzkum'];
?>

<center><font class='text_bili'>
<br>
<?php

if($vyber!=6):
    echo "<a href='hlavni.php?page=vlada&amp;vyber=1'>Funkce</a>&nbsp;&nbsp;";
endif;

if($vyber!=6):
    echo "<a href='hlavni.php?page=vlada&vyber=2' >�iny veden�</a>&nbsp;&nbsp;";
endif;

if($vyber!=6):
    echo "<a href='hlavni.php?page=vlada&vyber=5' >Fond / v�zkum</a>&nbsp;&nbsp;";
endif;

if($vyber!=6):
    echo "<a href='hlavni.php?page=vlada&vyber=6' >P�epo�et naquadahu</a>&nbsp;&nbsp;";
endif;

if($vyber!=6):
    echo "<a href='hlavni.php?page=vlada&vyber=7' >P�epo�ety</a>&nbsp;&nbsp;";
endif;

if($zaznam1[admin]==1 && $vyber!=6):
    echo "<a href='hlavni.php?page=vlada&vyber=4' >�iny admin�</a>&nbsp;&nbsp;";
endif;

?>
<br><br>
<?php

if($zaznam1[status]==4):
    $a=1.5;
else:
    $a=1;
endif;

if(empty($vyber)){$vyber=1;}
?>
</center></font>
<?php
$diletace=12;

if((Date("U")-$zaznam1['vek'])<($diletace*3600) && $vyber!=5 && $vyber!=6){echo "<br><font class='text_cerveny'>Nem��ete volit v�dce. V�dce je mo�no volit a� po $diletace hodin�ch od registrace!</font>";

    echo '</div> <div class="telo_paticka"></div> </div> </div> </div> </div>';

    exit;};



        $stat=$zaznam1[status];

	$rasa=$zaznam1[rasa];

	if($rasa==98){echo "<font class='text_cerveny'><center>Vyvrhelov� nemaj� v�dce!</center></font>";exit;};

	if($rasa==0){echo "<font class='text_cerveny'><center>Antikov� nemaj� v�dce!</center></font>";exit;};

	$vys9 = MySQL_Query("SELECT rasa,min,fond,darz,dara,posta,minv,darv,rasova_zprava FROM vudce where rasa = $rasa");

  $zaznam9 = MySQL_Fetch_Array($vys9);



	$rasa=$zaznam1["rasa"];

	$kdo = $zaznam1["koho"];

	//echo "<font class=text_bili>";

	//echo "$kdo<br>";

	

	$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$kdo'");

	do{

		$dobre=0;

		$kontrola=MySQL_Fetch_Array($kontrola1);//echo "$kontrola[jmeno]<br>";

		if($kdo==$kontrola[jmeno]){$dobre=0;$cislokdo=$kontrola[cislo];};

	}while($dobre);



	$vys8 = MySQL_Query("SELECT * FROM rasy where rasa = $rasa");

	$zaznam8 = MySQL_Fetch_Array($vys8);



	if($kdo==""){

		$koho=$kdo=$logjmeno;

		$novv=$zaznam1["volen"]+1;

		MySQL_Query("update uzivatele set volen = '$novv', koho = '$logjmeno' where cislo='$logcislo'");

		};





		if(isset($vypsat)):



	//$ciny2 = MySQL_Query("SELECT * FROM `ciny` WHERE (`rasa`=$zaznam1[rasa] AND `kdo`=$ci) ORDER BY `cas` DESC LIMIT 0,'$kolik'");

	 	$temp_rasa=$zaznam1[rasa];

     $ciny2 = MySQL_Query("SELECT * FROM `ciny` WHERE (`rasa`='$temp_rasa' AND `kdo`='$ci') ORDER BY `cas` DESC LIMIT 0,$kolik");

                            

   

   

   if($zaznam1[admin]==1){

   echo MySQL_Error();  }

  echo "<center><br><br>";			

	echo "<TABLE ".$table." ".$border." wid=90%>";

	echo "<tr>";

	echo "<th>�as</th>";

	echo "<th>kdo (status)</th>";

	echo "<th>�in</th>";

	echo "</tr>";

	

	while($ciny=MySQL_Fetch_Array($ciny2, MYSQL_ASSOC)):	

		$cas=Date("G:i:s j.m.Y",$ciny["cas"]);;

		switch($ciny[status]){

			case 1 :$status="v�dce";break;

			case 2 :$status="z�stupce";break;

			case 3 :$status="asistent";break;

			case 4 :$status="vyhnanec";break;

			case 5 :$status="poradce";break;

			default: $status="ob�an";

		};

		switch($ciny[cin]){

			case 1 :$cin="P�ijmul od vyvrhel� hr��e $ciny[koho]";break;

			case 2 :$cin="Vyhodil k vyvrhel�m hr��e $ciny[koho]";break;

			case 3 :$cin="Poslal hr��i $ciny[koho] ".number_format($ciny[cislo],0,0," ")." NQ";break;

			case 4 :$cin="Poslal rase $ciny[koho] ".number_format($ciny[cislo],0,0," ")." NQ";break;

			case 5 :$cin="Poslal hr��i $ciny[koho] jednotky v hodnot� ".number_format($ciny[cislo],0,0," ")."NQ";break;			

			case 6 :$cin="Poslal do fondu ".number_format($ciny[cislo],0,0," ")." NQ";break;			

			case 7 :$cin="Poslal do rasov� arm�dy jednotky v hodnot� ".number_format($ciny[cislo],0,0," ")." NQ";break;						

		  case 20 :$cin="Rasa $ciny[koho] poslala ".number_format($ciny[cislo],0,0," ")." NQ";break;

		

    

    

    };

		echo "<tr>";		

		echo "<td>$cas</td>";

		echo "<td>$ciny[kdo] ($status)</td>";	

		echo "<td>$cin</td>";	

    echo "<td>&nbsp;</td>";				

		echo "</tr>";		

	endwhile;

	echo "</table></center>";exit;



					endif;



	

	if(isset($koho) && $_POST['over_post']==1):

		if($koho==$kdo):

			echo " ";

		else:

			$vys1 = MySQL_Query("SELECT jmeno,heslo,gold,silver,penize,volen,koho,rasa,status,ref,cislo,hra,zmrazeni,skin,vek,admin,reg,statusnovacek FROM uzivatele where rasa = $rasa ORDER BY volen DESC");

			while($zaznam1=MySQL_Fetch_Array($vys1)):

				if($koho==$zaznam1["jmeno"]){$dobre=1;$rasaj=$zaznam1[rasa];break;};

			endwhile;

			//$dobre=1;

			if($dobre==1 && $rasa==$rasaj):

			   $i=0;

			   $kontrola1 = MySQL_Query("SELECT `cislo`,`jmeno` FROM `uzivatele` where `jmeno` = '$koho'");

			   do{

				$i++;	

				if($i>10){break;};

				$dobre=1;

	  			$kontrola=MySQL_Fetch_Array($kontrola1);

				if($koho==$kontrola[jmeno]){$dobre=0;$cislokoho=$kontrola[cislo];};

		  	   }while($dobre);

			   if($zaznam1[status]!=4 AND $zaznam1[admin]!=1):

         //echo $cislokdo;

				$vys2 = MySQL_Query("SELECT cislo,jmeno,volen,koho FROM uzivatele where cislo = '$cislokdo'");

				$zaznam2 = MySQL_Fetch_Array($vys2);

	

				$a=$zaznam2[volen]-1;

	

				$vys3 = MySQL_Query("SELECT jmeno,volen,koho FROM uzivatele where cislo=$cislokoho");

				$zaznam3 = MySQL_Fetch_Array($vys3);

	

				$b=$zaznam3[volen]+1;

				MySQL_Query("update uzivatele set koho = '$koho' where cislo=$logcislo");

				MySQL_Query("update uzivatele set volen = '$a' where cislo=$cislokdo");

				MySQL_Query("update uzivatele set volen = '$b' where cislo=$cislokoho");

				$kdo=$koho;

			   elseif ($zaznam1[admin]==1):

				echo "<font class='text_cerveny'>Nelze volit admina.</font>";

			   else:

			   	echo "<font class='text_cerveny'>nelze volit exulanta (vyhnance)</font>";

        		   endif;	

			else:

			   echo "<font class='text_cerveny'>Tento login neexistuje nebo nen� ze stejn� rasy</font>";

			endif;		

		endif;

	endif;





	if(isset($komu) && $_POST['over_post']==1):

		$vys1 = MySQL_Query("SELECT jmeno,heslo,gold,silver,penize,volen,koho,rasa,status,ref,cislo,hra,zmrazeni,skin,vek,admin,reg,statusnovacek FROM uzivatele where rasa = $rasa");

		while($zaznam1=MySQL_Fetch_Array($vys1)):

			if($komu==$zaznam1["jmeno"]){$dobre=1;break;}				

		endwhile;

		if($stat==2):

			$dal=$zaznam9[darz];

			$maxim=4;

			$odes=" - z�stupce";

 			$dat=Floor($zaznam9[fond]*0.2);

		elseif($stat==3):

			$dal=$zaznam9[dara];

			$maxim=2;

			$odes=" - asistent";

      			$dat=Floor($zaznam9[fond]*0.1);

 		elseif($stat==1):

 			$dal=0;

			$maxim=999;

			$odes=" - v�dce";

      		$dat=$zaznam9[fond];

 		elseif($stat==5):

 			$dal=0;

			$maxim=999;

			$odes=" - ministr";

      		$dat=$zaznam9[fond];

		else:		

			$dobre=0;

		endif;

		$kolik=StrTr($kolik,",",".");

	if ($proc <> ""):	

	 if(is_numeric($kolik)):

		if(($dal<$maxim) && ($kolik>0) ):

			if($dobre==1):

			  	$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$komu'");

				do{

					$dobre=1;

  					$kontrola=MySQL_Fetch_Array($kontrola1);

				 	if($komu==$kontrola[jmeno]){$dobre=0;$cislokomu=$kontrola[cislo];}

			  	}while($dobre);



				$vys10 = MySQL_Query("SELECT fond FROM vudce where rasa = '$rasa'");

				$zaznam10 = MySQL_Fetch_Array($vys10);

				$vys11 = MySQL_Query("SELECT jmeno,penize,posta,cislo FROM uzivatele where cislo=$cislokomu");

				$zaznam11 = MySQL_Fetch_Array($vys11);

				if(($dat-$kolik)>=0):

					$fon=$zaznam10["fond"]-$kolik;

					$pen=$zaznam11["penize"]+$kolik;

					$k=$dal+1;

          			$p=$zaznam11["posta"]+1;

        			$dat = Date("U");

                                $nazev="Zpr�va fondu";

          			$rasa5=AddSlashes($zaznam8["nazevrasy"]);

          			$text= "Odes�latel V�m poslal z fondu " . fcis($kolik) ." naquadahu";

	  				$od=$logjmeno.$odes;

          			

					if(MySQL_Query("update vudce set `fond` = '$fon' where `rasa` = '$rasa'")):

					else:

						echo"<h1>Neode�etl se NAQ z fondu, zkuste to znovu</h1>";

						exit;

					endif;

					if(MySQL_Query("update uzivatele set `penize` = '$pen' where `cislo`='$cislokomu'")):

					else:

						echo"<h1>Nep�i�etl se NAQ z fondu u�ivateli, kontaktujte n�jak�ho z admin�!!</h1>";

						$texta="nedorazil naq hr��i".$komu."  celkem:".$kolik."";

						$komua="puchy2";

						//MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,nazev,text,stav,nepr,typ,smaz) VALUES ($dat,'$od','$komua','$rasa5','$nazev','$texta','1','1','3','0')");

						exit;

					endif;

				

					

					//MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,nazev,text,stav,nepr,typ,smaz) VALUES ($dat,'$od','$komu','$rasa5','$nazev','$text','1','1','3','0')");

          			//MySQL_Query("update uzivatele set posta = $p where cislo = $cislokomu");

					if($stat==2){MySQL_Query("update vudce set darz = $k where rasa = $rasa");}

					if($stat==3){MySQL_Query("update vudce set dara = $k where rasa = $rasa");}

					MySQL_Query("INSERT INTO ciny (cas,rasa,cin,kdo,status,koho,cislo, proc) VALUES ($dat,$rasa,3,'$logjmeno','$statusmuj','$komu',$kolik, '$proc')");					

				else:

					echo "<font class='text_cerveny'>Nedostatek naquadahu ve fondu nebo nedovolen� velk� p��sp�vek</font>";

				endif;

			else:

				echo "<font class='text_cerveny'>Neexistuj�c� jm�no</font>";

			endif;

		else:

			echo "<font class='text_cerveny'>Dnes jste dal u� v�echny p��sp�vky nebo jste zadal �patn� typ ��sla</font>";

		endif;

		else:

			echo "<font class='text_cerveny'>Byl zad�n �patn� typ ��sla</font>";

		endif;

		else:

			echo "<font class='text_cerveny'>Zadejte d�vod</font>";

		endif;



	endif;



	if(isset($rezignace)):

		if($zaznam1[status]==5):

			$vu2 = MySQL_Query("SELECT rasa,min1,min2,min3,min4,min5 FROM vudce where  rasa = $rasa");

			$vu = MySQL_Fetch_Array($vu2);	

			$co=0;

			$aa="";

			if($vu[min1]==$logjmeno):

				MySQL_Query("update vudce set min1 = '$aa' where rasa=$rasa");

			elseif($vu[min2]==$logjmeno):

				MySQL_Query("update vudce set min2 = '$aa' where rasa=$rasa");

			elseif($vu[min3]==$logjmeno):

				MySQL_Query("update vudce set min3 = '$aa' where rasa=$rasa");

			elseif($vu[min4]==$logjmeno):

				MySQL_Query("update vudce set min4 = '$aa' where rasa=$rasa");

			elseif($vu[min5]==$logjmeno):

				MySQL_Query("update vudce set min5 = '$aa' where rasa=$rasa");

			endif;

			MySQL_Query("update uzivatele set status=0 where cislo=$logcislo");

		else:

			echo "<font class='text_cerveny'>Nejste poradce.</font>";		

		endif;

	endif;

	$overeni2=Date("j")*$cisloz*2005;

	if(isset($f2rasa) && $_POST['over_post']==1 && $overeni2==$overeni):

	$kolik=StrTr($kolik,",",".");

		$vud1 = MySQL_Query("SELECT rasa,fond FROM vudce where rasa = '$rasa'");

		$vudce1 = MySQL_Fetch_Array($vud1);		

		//echo "<font class='text_bili'>$f2rasa</font>";

    	$vud2 = MySQL_Query("SELECT rasa,fond,vudce FROM vudce where rasa && rasa ='$f2rasa'");

		$vudce2 = MySQL_Fetch_Array($vud2);		

		$vu2=$vudce2[vudce];

		$vys11 = MySQL_Query("SELECT jmeno,penize,posta FROM uzivatele where jmeno='$vu2'");

		$zaznam11 = MySQL_Fetch_Array($vys11);

		//$vys12 = MySQL_Query("SELECT rasa,vyr_vyrob,nazevrasy FROM rasy where rasa < 11 && rasa!=0 &&  &&  rasa = $f2rasa");

		$vys12 = MySQL_Query("SELECT rasa,vyr_vyrob,nazevrasy FROM rasy where (rasa>'0' && rasa<'11') &&  rasa = $f2rasa");

		

    $zaznam12 = MySQL_Fetch_Array($vys12);



		$dat=$vudce1["fond"];

		$prav=0;

		if($statusmuj==1 || $statusmuj==5 ){$prav=1;};

		

		if ($procr <> ""){

		if((($dat-$kolik)>=0) && ($kolik>0) && ($prav==1)):

			$doslo=($kolik/$zaznam8[vyr_vyrob])*$zaznam12[vyr_vyrob];

			$doslo=Floor($doslo);

			//echo "<font class='text_bili'>$doslo</font>";

			$fon1=$vudce1["fond"]-$kolik;

			$fon2=$vudce2["fond"]+$doslo;

    		$p=$zaznam11["posta"]+1;

        	$dat = Date("U");

          	$rasa5=AddSlashes($zaznam8["nazevrasy"]);

			$rasa6=AddSlashes($zaznam12["nazevrasy"]);

          	$text= "V�dce t�to rasy poslal ze sv�ho do Va�eho fondu $kolik naquadahu, po p�evodu p�es Vesm�rnou burzu do�lo $doslo";

	  		$od=$logjmeno;

		//	MySQL_Query("update vudce set fond = '$fon2' where rasa = '$f2rasa'");



	    //	$kon2 = MySQL_Query("SELECT rasa,fond,vudce FROM vudce where rasa < 11 && rasa!=0 && rasa!=7 &&  rasa = $f2rasa");

			$kon2 = MySQL_Query("SELECT rasa,fond,vudce FROM vudce where  (rasa>'0' && rasa<'11') &&  rasa = '$f2rasa'");

			if($zaznam1[admin]==1){

      $kon2 = MySQL_Query("SELECT rasa,fond,vudce FROM vudce where   rasa ='$f2rasa'");

			}

      $kon = MySQL_Fetch_Array($kon2);					

			

			if($kon["fond"]<=$fon2):

    	      	/*MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text,rasa2) VALUES ('$dat','$od','$vu2','$rasa5','$text','$rasa6')");

        	  	MySQL_Query("update uzivatele set posta = '$p' where jmeno = '$vu2'");*/

				MySQL_Query("update `vudce` set `fond` = '$fon1' where `rasa` = '$rasa'");

				MySQL_Query("update `vudce` set `fond` = '$fon2' where `rasa` = '$f2rasa'");

				//MySQL_Query("INSERT INTO ciny (cas,rasa,cin,kdo,status,koho,cislo) VALUES ('$dat','$rasa','4','$logjmeno','$zaznam1[status]','$rasa6','$kolik')");

				MySQL_Query("INSERT INTO `ciny`  VALUES ('$dat','$rasa','4','$logjmeno','$zaznam1[status]','$rasa6','$kolik', '$procr')");

			  MySQL_Query("INSERT INTO `ciny`  VALUES ('$dat','$f2rasa','20','$logjmeno','$zaznam1[status]','$rasa5','$doslo', '$procr')");

      else:

				//echo $kon["fond"];

				

        echo "<font class='text_bili'>Transakce se nezda�ila, zkuste znovu.</font>";

			//echo $fon2;

      endif;

		else:

			echo "<font class='text_cerveny'>Nedostatek naquadahu ve fondu nebo nedostatek opr�vn�n�</font>";

		endif;

		}

		else

		{

		echo "<font class='text_cerveny'>Zadejte d�vod posl�n� naqadahu</font>";

    }



	endif;

	

	       	

        if ($doex == 1)

          { 

				    MySQL_Query("update uzivatele set status = 4 where jmeno='$doexilu'");

				  }

				  

				if ($zex == 1)

				  {

				    MySQL_Query("update uzivatele set status = 0 where jmeno='$zexilu'");

          }

    

          

	if(isset($posta) && $_POST['over_post']==1):

		$prav=0;

		if($statusmuj==1 || $statusmuj==5){$prav=1;};

		if($prav==1):

			$posta=HTMLSpecialChars($posta);

			//$posta=NL2BR($posta);

			$posta=StripSlashes($posta);

			MySQL_Query("update vudce set posta = '$posta' where rasa='$rasa'");

		else:

			echo "<font class='text_cerveny'>K t�to akci nem�te dostatek pravomoc�</font>";

		endif;

	endif;



	if(isset($prijmi) && $_POST['over_post']==1):

	  $prav=0;

	  if($statusmuj==1 || $statusmuj==5 || $statusmuj==2){$prav=1;};

	  if($prav==1):

		$vys1 = MySQL_Query("SELECT jmeno,status,statusnovacek,rasa,cislo,penize,gold,silver FROM uzivatele where rasa = $rasa");

		while($zaznam1=MySQL_Fetch_Array($vys1)):

			if($prijmi==$zaznam1["jmeno"]){$dobre=1;break;};				

		endwhile;



		if($dobre==1):

			$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$prijmi'");

		  	do{	

				$dobre=1;

		  		$kontrola=MySQL_Fetch_Array($kontrola1);

				if($prijmi==$kontrola[jmeno]){$dobre=0;$cisloprijmi=$kontrola[cislo];};

		  	}while($dobre);



			if($zaznam1["status"]==4):

				MySQL_Query("update uzivatele set status = 0 where cislo=$cisloprijmi");

			else:

				echo "<font class='text_cerveny'>Tento u�ivatel nen� v exilu</font>";			

			endif;

		else:

			echo "<font class='text_cerveny'>neexistuj�c� jm�no</font>";

		endif;

	  else:

		echo "<font class='text_cerveny'>K t�to akci nem�te dostatek pravomoc�</font>";

	  endif;					

	endif;



	if(isset($fond) && $_POST['over_post']==1):



	  $prav=0;

	  if($statusmuj==1 || $statusmuj==5 || $statusmuj==2){$prav=1;};

	  if($prav==1):	

	  if (is_numeric($fond)):

		if(($fond<=50) && ($fond>=0)): 

			//$fon=$zaznam10["fond"]-$kolik;

			//$pen=$zaznam11["penize"]+$kolik;

			MySQL_Query("update vudce set min = $fond where rasa = $rasa");

			MySQL_Query("update uzivatele set fond = $fond where rasa = $rasa && (auto=1 || auto=3)");

		else:

			echo "<font class='text_cerveny'>P��li� velk� minim�ln� vklad nebo z�porn� ��slo</font>";

		endif;

	  else:

		echo "<font class='text_cerveny'>Vlo�te jen cel� ��slo od 0 do 50</font>";		

	endif;

	else:

	echo "<font class='text_cerveny'>Vlo�te jen cel� ��slo od 0 do 50</font>";

	endif;

         endif;



	if(isset($vyz) && $_POST['over_post']==1):

	  $prav=0;

	  if($statusmuj==1 || $statusmuj==5 || $statusmuj==2){$prav=1;};

	  if($prav==1):

	  if (is_numeric($vyz)):		

		if(($vyz<=50) && ($vyz>=0)):

			MySQL_Query("update vudce set minv = $vyz where rasa = $rasa");

			MySQL_Query("update uzivatele set vyzkum = $vyz where rasa = $rasa && (auto=2 || auto=3)");

		else:

			echo "<font class='text_cerveny'>P��li� velk� minim�ln� vklad nebo z�porn� ��slo</font>";

		endif;

	  else:

		echo "<font class='text_cerveny'>Vlo�te jen cel� ��slo od 0 do 50</font>";

	endif;

	else:

	echo "<font class='text_cerveny'>Vlo�te jen cel� ��slo od 0 do 50</font>";

	endif;

         endif;



	if(isset($min1) && $_POST['over_post']==1):

	  $prav=0;

	  if($statusmuj==1){$prav=1;};

	  if($prav==1):		

			do{//echo "<h1>min22</h1>";exit;

			$min1=HTMLSpecialChars(trim($min1));	



			$nove = MySQL_Query("SELECT rasa FROM uzivatele where jmeno='$logjmeno' ");

			$novez = MySQL_Fetch_Array($nove);

			$rasavudce=$novez[rasa];



			if($zaznam1[status]!=1){echo "<font class='text_cerveny'>Nejste v�dce ani premi�r.</font>";break;};

			$vys1 = MySQL_Query("SELECT jmeno,rasa,cislo,penize,gold,silver FROM uzivatele where jmeno='$min1' ");

			while($zaznam1=MySQL_Fetch_Array($vys1)):

			

			

				if($min1==$zaznam1["jmeno"] || $min1==""){$dobre=1;$rasaj=$zaznam1[rasa];$cislo1=$zaznam1[cislo];break;};

			endwhile;



			if(($dobre!=1 || $rasavudce!=$rasaj) && $min1!=""){echo "<font class='text_cerveny'>Jm�no 1. poradce neexistuje nebo nen� z Va�� rasy</font>";break;};

			//echo "<h1>".$cislo1;			

			





			$vv = MySQL_Query("SELECT rasa,min1 FROM vudce where rasa = $rasa");

			$zv = MySQL_Fetch_Array($vv);

						

			MySQL_Query("update uzivatele set status='5' where jmeno = '$zv[min1]'");



						

			MySQL_Query("update uzivatele set status='5' where cislo = $cislo1");



			MySQL_Query("update vudce set min1='$min1' where rasa=$rasa");

			

			}while(false);

	  else:

		echo "<font class='text_cerveny'>K t�to akci nem�te dostatek pravomoc�</font>";

	  endif;				

	endif;





	if(isset($volitm) && $_POST['over_post']==1):



	  $prav=0;

	  if($statusmuj==1){$prav=1;};

	  if($prav==1):		







        	        $dat = Date("U");



          	        $rasab=$zaznam1[rasa];



			$nazr = MySQL_Query("SELECT nazevrasy,rasa FROM rasy where rasa = $rasab");

			$rasaa = MySQL_Fetch_Array($nazr);



                        $rasaaaa=$rasaa[nazevrasy];

			

			MySQL_Query("update uzivatele set koho='Neplatn�' where koho = '$logjmeno'");

		

			MySQL_Query("update uzivatele set volen='0' where jmeno = '$logjmeno'");



			MySQL_Query("update uzivatele set status='0' where jmeno = '$logjmeno'");			





	  else:

		echo "<font class='text_cerveny'>K t�to akci nem�te dostatek pravomoc�</font>";

	  endif;		

	endif;











	if(isset($min2) && $_POST['over_post']==1):

	  $prav=0;

	  if($statusmuj==5){$prav=1;};

	  if($prav==1):		

			do{//echo "<h1>min22</h1>";exit;

			$min2=HTMLSpecialChars(trim($min2));

			$min3=HTMLSpecialChars(trim($min3));

			$min4=HTMLSpecialChars(trim($min4));

			$min5=HTMLSpecialChars(trim($min5));	



			$nove = MySQL_Query("SELECT rasa FROM uzivatele where jmeno='$logjmeno' ");

			$novez = MySQL_Fetch_Array($nove);

			$rasavudce=$novez[rasa];



			if($zaznam1[status]!=5){echo "<font class='text_cerveny'>Nejste v�dce ani premi�r.</font>";break;};

	

			

			$vys1 = MySQL_Query("SELECT jmeno,rasa,cislo FROM uzivatele where jmeno='$min2' ");

			while($zaznam1=MySQL_Fetch_Array($vys1)):

			

				if($min2==$zaznam1["jmeno"] || $min2==""){$dobre=1;$rasaj=$zaznam1[rasa];$cislo2=$zaznam1[cislo];break;};

			endwhile;

			

			if(($dobre!=1 || $rasavudce!=$rasaj) && $min2!=""){echo "<font class='text_cerveny'>Jm�no 1. ministra neexistuje nebo nen� z Va�� rasy</font>";break;};

			

			$vys1 = MySQL_Query("SELECT jmeno,rasa,cislo FROM uzivatele where jmeno='$min3' ");

			while($zaznam1=MySQL_Fetch_Array($vys1)):

			

				if($min3==$zaznam1["jmeno"] || $min3==""){$dobre=1;$rasaj=$zaznam1[rasa];$cislo3=$zaznam1[cislo];break;};

			endwhile;

			

			if(($dobre!=1 || $rasavudce!=$rasaj) && $min3!=""){echo "<font class='text_cerveny'>Jm�no 2. ministra neexistuje nebo nen� z Va�� rasy</font>";break;};

			

			$vys1 = MySQL_Query("SELECT jmeno,rasa,cislo FROM uzivatele where jmeno='$min4' ");

			while($zaznam1=MySQL_Fetch_Array($vys1)):

			

				if($min4==$zaznam1["jmeno"] || $min4==""){$dobre=1;$rasaj=$zaznam1[rasa];$cislo4=$zaznam1[cislo];break;};

			endwhile;

			

			if(($dobre!=1 || $rasavudce!=$rasaj) && $min4!=""){echo "<font class='text_cerveny'>Jm�no 3. ministra neexistuje nebo nen� z Va�� rasy</font>";break;};

			

			$vys1 = MySQL_Query("SELECT jmeno,rasa,cislo FROM uzivatele where jmeno='$min5' ");

			while($zaznam1=MySQL_Fetch_Array($vys1)):

			

				if($min5==$zaznam1["jmeno"] || $min5==""){$dobre=1;$rasaj=$zaznam1[rasa];$cislo5=$zaznam1[cislo];break;};

			endwhile;

			

			if(($dobre!=1 || $rasavudce!=$rasaj) && $min5!=""){echo "<font class='text_cerveny'>Jm�no 4. ministra neexistuje nebo nen� z Va�� rasy</font>";break;};

			//echo "<font class='text_bili'>11-$min5</font>";

			//echo "<font class='text_bili'>11-$cislo5</font>";

			

			$vv = MySQL_Query("SELECT rasa,min2,min3,min4,min5 FROM vudce where rasa = $rasa");

			$zv = MySQL_Fetch_Array($vv);

						



			MySQL_Query("update uzivatele set status='0' where jmeno = '$zv[min2]'");

			MySQL_Query("update uzivatele set status='0' where jmeno = '$zv[min3]'");

			MySQL_Query("update uzivatele set status='0' where jmeno = '$zv[min4]'");

			MySQL_Query("update uzivatele set status='0' where jmeno = '$zv[min5]'");

						



			MySQL_Query("update uzivatele set status='5' where cislo = $cislo2");

			MySQL_Query("update uzivatele set status='5' where cislo = $cislo3");

			MySQL_Query("update uzivatele set status='5' where cislo = $cislo4");

			MySQL_Query("update uzivatele set status='5' where cislo = $cislo5");

			MySQL_Query("update vudce set min2='$min2',min3='$min3',min4='$min4',min5='$min5' where rasa=$rasa");

			

			}while(false);

	  else:

		echo "<font class='text_cerveny'>K t�to akci nem�te dostatek pravomoc�</font>";

	  endif;				

	endif;





	

	if(isset($cpvyz) && $_POST['over_post']==1):

	  $prav=0;

	  if($statusmuj==1 || $statusmuj==5 || $statusmuj==2){$prav=1;};

	  if($prav==1):		

			if(is_double($cpvyz) || is_double($cpfond)){
                echo "<font class='text_bili'>��sla mus� b�t cel�</font>";
                //break;
            }

			if($zaznam1['status']!=1 && $zaznam1['status']!=5){
                echo "<font class='text_bili'>Toto sm� jen v�dce a poradce</font>";
                //break;
            }

			if($cpvyz<0 || $cpfond<0){
                echo "<font class='text_cerveny'>��sla m�s� b�t kladn�</font>";
                //break;
            }

			if(($cpvyz+$cpfond)>100){
                echo "<font class='text_cerveny'>��sla m�s� dohormady d�t maxim�ln� 100%</font>";
                //break;
            }

	  if (is_numeric($cpvyz) && is_numeric($cpfond)):		
		if(($$cpfond<=50) && ($cpfond>=0)):
            MySQL_Query("update cp set vyzkum=$cpvyz,fond=$cpfond where rasa=$rasa");
		else:
			echo "<font class='text_cerveny'>P��li� velk� minim�ln� vklad nebo z�porn� ��slo</font>";
		endif;
	  else:
		echo "<font class='text_cerveny'>Vlo�te jen cel� ��slo od 0 do 50</font>";
 	endif;

	else:

	echo "<font class='text_cerveny'>Vlo�te jen cel� ��slo od 0 do 50</font>";

	endif;

         endif;



  if(isset($_POST["ramsg"]) && $_POST["over_post"]==1){

    $ramsg = $_POST["ramsg"];

    $ramsg=Str_Replace("\r\n","<br>",$ramsg);

    $ramsg=NL2BR($ramsg);

    $udpate = mysql_query("UPDATE vudce SET rasova_zprava = '$ramsg' WHERE rasa=$zaznam1[rasa]") || die("Nepoda�ilo se ulo�it novou zpravu");

  }





	if(isset($vyvr) && $_POST['over_post']==1):

	  $prav=0;

	  if($statusmuj==1 || $statusmuj==5){$prav=1;};

	  if($prav==1):		



        $vysledekd5 = mysql_query("SELECT * FROM uzivatele where rasa=$zaznam1[rasa]");

	$poc15=mysql_num_rows($vysledekd5);



if ($zaznam9[darv]<=($poc15)*0.2):





///////

    	do{

			$kontrola1 = MySQL_Query("SELECT cislo,jmeno,rasa FROM uzivatele where (jmeno = '$vyvr' && rasa=$rasa)");

			$i=0;

			do{

				if($i>30){break;};

				$i++;

				$dobre=1;

				$kontrola=MySQL_Fetch_Array($kontrola1);



				if($vyvr==$kontrola[jmeno]){$dobre=0;$cislovyvr=$kontrola[cislo];};

		    	}while($dobre);

			if($dobre==1){echo "<font class='text_cerveny'>Tento login neexistuje, nebo nen� z V�� rasy</font>";break;};

			$vys1 = MySQL_Query("SELECT cislo, jmeno, rasa, penize, koho, status, den, statusnovacek, jed1, jed2, jed3, jed4, jed5  FROM uzivatele where cislo=$cislovyvr");

			$zaznam1=MySQL_Fetch_Array($vys1);

			$jrasa=$zaznam1[rasa];

			$r = MySQL_Query("SELECT * FROM rasy where rasa = 20");

			$rasa9 = MySQL_Fetch_Array($r);

    

    $smazdny=432000;

    $den_t=Date("U");

    $kdy_t = $den_t - $smazdny;

    $neakt=$zaznam1[den];

    //echo "Tealc(u) tohle mi posli postou,... ".$neakt." < ".$kdy_t." ; ".($neakt-$kdy_t)." ".$vyvr;

    

      if ($procv <> ""){

			if(!($zaznam1["status"]==1 || $zaznam1["status"]==2 || $zaznam1["status"]==3 || $zaznam1["status"]==5 )){

			if(!($zaznam1["statusnovacek"]==1 && $neakt > $kdy_t)){



				$p=($zaznam1[penize]/$zaznam8[vyr_vyrob])*$rasa9[vyr_vyrob];

				$j1=$zaznam1['jed1'];
				$j2=$zaznam1['jed2'];
				$j3=$zaznam1['jed3'];				
				$j4=$zaznam1['jed4'];
				$j5=$zaznam1['jed5'];				

				$sj1=$j1*$rasa9[jed1_obrana]+$j1*$rasa9[jed1_utok];
				$tsj1=$j1*$zaznam8[jed1_obrana]+$j1*$zaznam8[jed1_utok];
				$sj2=$j2*$rasa9[jed2_obrana]+$j2*$rasa9[jed2_utok];
				$tsj2=$j2*$zaznam8[jed2_obrana]+$j2*$zaznam8[jed2_utok];
				$sj4=$j4*$rasa9[jed4_obrana]+$j2*$rasa9[jed4_utok];
				$tsj4=$j4*$zaznam8[jed4_obrana]+$j2*$zaznam8[jed4_utok];

				if($sj1>0):
					$pomer1=$tsj1/$sj1;
					$j1=Round($pomer1*$j1);
				endif;

				if($sj2>0):
					$pomer2=$tsj2/$sj2;
					$j2=Round($pomer2*$j2);
				endif;

				if($sj4>0):
					$pomer4=$tsj4/$sj4;
					$j4=Round($pomer4*$j4);
				endif;

				$j1=Round($j1/2);
				$j2=Round($j2/2);
				$j3=Round($j3/2);
				$j4=Round($j4/2);
				$j5=Round($j5/2);



			$vysvud = MySQL_Query("SELECT * FROM vudce where rasa='$zaznam1[rasa]'");

			$zaznamvud = MySQL_Fetch_Array($vysvud);

				

                        $jmenovudce=$zaznamvud[vudce];

			$vysvudb = MySQL_Query("SELECT * FROM vudce where vudce='$jmenovudce'");

			$zaznamvudb = MySQL_Fetch_Array($vysvudb) || die("Chyba");



                        $cislovudce=$zaznamvudb[cislo];





	                                MySQL_Query("update uzivatele set penize=$p,jed1=$j1,jed2=$j2,jed3=$j3,jed4=$j4,jed5=$j5,penize=0 where cislo=$cislovyvr");

				





                                        if($zaznam1[koho]!=$zaznam1["jmeno"]):



					MySQL_Query("update `uzivatele` set `rasa` = '98', `koho` = '$vyvr', `volen` = '1',`planety` = '1', `status`='0' where `cislo`='$zaznam1[cislo]'");



					MySQL_Query("update `uzivatele` set `koho` = 'Neplatn�' where `koho`='$vyvr'");



					MySQL_Query("update `planety` set `cislomaj`='$cislovudce' where `status`='2' && `cislomaj`='$cislovyvr'");

				



                                else:

					MySQL_Query("update `uzivatele` set `rasa` = '98', `status`='0', `volen` = '1', `status`='0',`planety` = '1' where `cislo`='$cislovyvr'");



					MySQL_Query("update uzivatele set koho = 'Neplatn�' where koho='$vyvr'");

				endif;







				$k=$zaznam9[darv]+1;



				MySQL_Query("update vudce set darv = $k where rasa = $rasa");



				$dat=Date("U");



				MySQL_Query("INSERT INTO ciny (cas,rasa,cin,kdo,status,koho, proc) VALUES ($dat,$rasa,2,'$logjmeno','$statusmuj','$vyvr', '$procv')");



				MySQL_Query("delete from obchod where navrhovatel='$vyvr'");	



			

      }								

			else{

				echo "<font class='text_cerveny'>Nelze vyhodit nov��ka, kter� je neaktivn� m�n� jak 6 dn�.</font>";

				}

				      }								

			else{

				echo "<font class='text_cerveny'>Nelze vyhodit premi�ra, ministra, z�stupce</font>";

				}

				

			}

				 else{

	   echo "<font class='text_cerveny'>Zadejte d�vod vyhozen� hr��e</font>";

      }

      }while(false);

		else:

                        echo "<font class=text_cerveny>Za den nesm�te vyhodit z rasy v�ce ne� 1/5 hr���.</font>";

		endif;

	  else:

		echo "<font class='text_cerveny'>K t�to akci nem�te dostatek pravomoc�</font>";

	  endif;			

	endif;













if(($vyber==1) || (empty($vyber))):



	$vys1 = MySQL_Query("SELECT jmeno,volen,status,cislo,gold,silver,penize FROM uzivatele where (rasa = $rasa && status!=5) ORDER BY volen DESC");

	echo "<TABLE width=100%>";

	echo "<tr>";

  	echo "<td textalign=left>";

	echo "<TABLE ".$table." ".$border." align=left>";

	$x=1;

	echo "<span style=\"text-align: left; display: block;\"><font class='text_bili'><font class=text_modry>T</font>abulka hlas�</font></span>";

	echo "<tr>";

	echo "<td>po�ad�</td>";

	echo "<td>jm�no</td>";

	echo "<td>hlas�</td>";

	echo "</tr>";

	MySQL_Query("update uzivatele set status = 0 where (rasa=$rasa && status!=4 && status!=5)");

	while($zaznam1=MySQL_Fetch_Array($vys1)):

		echo "<tr>";

		echo "<td>".$x."</td>";

		echo "<td>".$zaznam1["jmeno"]."</td>";

		echo "<td>".$zaznam1["volen"]."</td>";

		echo "</tr>";

		$j=$zaznam1["cislo"];

		$r=$rasa;

		if($x==1):

		    MySQL_Query("update vudce set vudce = '$zaznam1[jmeno]' where rasa = '$r'");

			MySQL_Query("update uzivatele set status = 1 where cislo=$j");

   		elseif($x==2):

        $vol = $zaznam1["volen"];

   		   if ($vol >= 2)

          {

			MySQL_Query("update vudce set zastupce = '$zaznam1[jmeno]' where rasa = '$r'");

			MySQL_Query("update uzivatele set status = 2 where cislo=$j");

      }

      elseif ($vol < 2)

      {

      MySQL_Query("update vudce set zastupce = '' where rasa = '$r'");

			MySQL_Query("update uzivatele set status = 0 where cislo=$j");  

      }

    	/*elseif($x==3):

    		MySQL_Query("update vudce set asistent = '$zaznam1[jmeno]' where rasa = '$r'");

			MySQL_Query("update uzivatele set status = 3 where cislo=$j");*/

    	elseif($zaznam1["status"]==4)

			MySQL_Query("update uzivatele set status = 4 where jmeno = '$j'");

    	elseif($zaznam1["status"]==5)

			MySQL_Query("update uzivatele set status = 5 where jmeno = '$j'");

		else

			MySQL_Query("update uzivatele set status = 0 where jmeno = '$j'");

		endif;

		$x++;

		if($x==11){break;};

	endwhile;



	echo "</table>";



	$vys9 = MySQL_Query("SELECT rasa,min,fond,darz,dara,posta,minv,darv,min1,min2,min3,min4,min5,rasova_zprava FROM vudce where rasa = $rasa");

	$zaznam9 = MySQL_Fetch_Array($vys9);

	$vys10 = MySQL_Query("SELECT rasa,fond,vyzkum FROM cp where rasa = $rasa");

	$zaznam10 = MySQL_Fetch_Array($vys10);	

  	$vys1 = MySQL_Query("SELECT cislo,jmeno,heslo,gold,silver,penize,volen,koho,rasa,status,ref,hra,zmrazeni,skin,vek,admin,reg,jed1,jed2,jed3,jed4,jed5,jed6,jed7,jed8 FROM uzivatele where cislo=$logcislo");

	$zaznam1 = MySQL_Fetch_Array($vys1);



 	echo "</td>";

  	echo "<td>";

		if($zaznam1["status"]==1 || $zaznam1["status"]==5 || $zaznam1["status"]==2):

			echo "<font class='text_bili'><font class=text_modry>U</font>v�tac� po�ta</font>";

			echo "<form name='uv' method='post' action='hlavni.php?page=vlada'>";

			echo "<textarea cols=50 rows=10 name='posta'>".$zaznam9["posta"]."</textarea><br>";

			echo "<input type='hidden' name='over_post' value='1'><input type='submit' value='Zm�nit uv�tac� po�tu'>";

      			echo "</form>";

		endif;

  	echo "</td>";

	echo "</tr>";

	echo "<tr>";

  	echo "<td align=left>";







		if(isset($prejdi)):



			$vysvud = MySQL_Query("SELECT vudce FROM vudce where rasa= '$prasa' ");

			$zaznamvud = MySQL_Fetch_Array($vysvud);



			$vysvudb = MySQL_Query("SELECT jmeno,cislo FROM uzivatele where jmeno= '$zaznamvud[vudce]' ");

			$zaznamvudb = MySQL_Fetch_Array($vysvudb);



				$zbytek_1=$zaznam1["jed1"]/2;

				$zbytek_2=$zaznam1["jed2"]/2;

				$zbytek_3=$zaznam1["jed3"]/2;

				$zbytek_4=$zaznam1["jed4"]/2;

				$zbytek_5=$zaznam1["jed5"]/2;

				$zbytek_6=$zaznam1["jed6"]/2;

				$zbytek_7=$zaznam1["jed7"]/2;

				$zbytek_8=$zaznam1["jed8"]/2;



				$prechod=Date("U");



				MySQL_Query("update `planety` set `cislomaj`='$zaznamvudb[cislo]' where `status`='2' && `cislomaj`='$hracc'");



				MySQL_Query("update `uzivatele` set `rasa` = '$prejdi' where `jmeno` = '$hracn'");



				MySQL_Query("update `uzivatele` set `penize` = '0', `banka` = '0',`bankau` = '0',`bankaposl` = '0',`bankap` = '0',`bankav` = '0',`bankabudova` = '0',`kontrolabankabudova` = '0', `status`='0' where `jmeno` = '$hracn'");



				MySQL_Query("update `uzivatele` set `jed1` = '$zbytek_1',`jed2` = '$zbytek_2',`jed3` = '$zbytek_3',`jed4` = '$zbytek_4',`jed5` = '$zbytek_5',`jed6` = '$zbytek_6',`jed7` = '$zbytek_7',`jed8` = '$zbytek_8' where `jmeno` = '$hracn'");



				MySQL_Query("update `uzivatele` set `koho` = '$hracn', `volen` = '1', `prechod`='$prechod', `planety` = '1' where `jmeno` = '$hracn'");



			        MySQL_Query("update `uzivatele` set `koho` = 'Neplatn�' `where` `koho` = '$hracn'");



				MySQL_Query("delete from `obchod` where `navrhovatel` = '$hracn'");





				echo "<script language=JavaScript>location.href='hlavni.php?page=vlada';</script>";

		endif;







		if(isset($prejdiii)):



if($zaznam1["gold"]==1 || $zaznam1["silver"]==1){



			$vysvud = MySQL_Query("SELECT vudce FROM vudce where rasa= '$prasa' ");

			$zaznamvud = MySQL_Fetch_Array($vysvud);



			$vysvudb = MySQL_Query("SELECT jmeno,cislo FROM uzivatele where jmeno= '$zaznamvud[vudce]' ");

			$zaznamvudb = MySQL_Fetch_Array($vysvudb);



				MySQL_Query("update planety set cislomaj='$zaznamvudb[cislo]' where status='2' && cislomaj='$hracc'");





				$zbytek_p=$zaznam1["penize"]/2;



				$zbytek_1=($zaznam1["jed1"]/4)*3;

				$zbytek_2=($zaznam1["jed2"]/4)*3;

				$zbytek_3=($zaznam1["jed3"]/4)*3;

				$zbytek_4=($zaznam1["jed4"]/4)*3;

				$zbytek_5=($zaznam1["jed5"]/4)*3;

				$zbytek_6=($zaznam1["jed6"]/4)*3;

				$zbytek_7=($zaznam1["jed7"]/4)*3;

				$zbytek_8=($zaznam1["jed8"]/4)*3;



				$prechod=Date("U");



				

				MySQL_Query("update uzivatele set rasa = '$prejdiii' where jmeno = '$hracn'");



				MySQL_Query("update uzivatele set penize = '$zbytek_p', banka = '0',bankau = '0',bankaposl = '0',bankap = '0',bankav = '0',bankabudova = '0',kontrolabankabudova = '0' status='0' where jmeno = '$hracn'");



				MySQL_Query("update uzivatele set jed1 = '$zbytek_1',jed2 = '$zbytek_2',jed3 = '$zbytek_3',jed4 = '$zbytek_4',jed5 = '$zbytek_5',jed6 = '$zbytek_6',jed7 = '$zbytek_7',jed8 = '$zbytek_8' where jmeno = '$hracn'");



				MySQL_Query("update uzivatele set koho = '$hracn', volen = '1', prechod='$prechod' where jmeno = '$hracn'");



			        MySQL_Query("update uzivatele set koho = 'Neplatn�' where koho = '$hracn'");



				echo "<script language=JavaScript>location.href='hlavni.php?page=vlada';</script>";

}

else{

				echo "<font class='text_cerveny'>Nejste gold ani silver hr��.</font>";exit;

}



		endif;





		if(isset($hlasy)):







//---------------------------------------upravenyhlasy----------------------------------------------

//echo $zaznam1[rasa];	

//$zaznam1[rasa]

@$vys1 = MySQL_Query("SELECT jmeno FROM uzivatele where  rasa = '$zaznam1[rasa]'");

@$pochracu = MySQL_Num_Rows($vys1);



$result = MySQL_Query("SELECT jmeno FROM uzivatele where  rasa = '$zaznam1[rasa]' ");



//-------------------------------------------------

$i = 0;

    while ($i<$pochracu):

$zaznam77[$i]=mysql_Result($result, $i);



$i++;

endwhile;





//echo $pochracu;

$i=0;

//-------------------------------------------------



for($i=0;$i<$pochracu;$i++){



$pocitadlo=0;



	@$vys2 = MySQL_Query("SELECT jmeno,koho,cislo FROM uzivatele where rasa='$zaznam1[rasa]' ORDER BY cislo LIMIT $i,1");

	@$zaznam777 = MySQL_Fetch_Array($vys2);

	//$zaznam7777[$i] = $zaznam777[jmeno];



	for($j=0;$j<$pochracu;$j++){



		if($zaznam777[koho]==$zaznam77[$j]){$pocitadlo=1; $koho=$zaznam77[$j];}







		}

//echo MySQL_Error();

if($pocitadlo!=1){$koho = $zaznam777[jmeno];}

MySQL_Query("update uzivatele set koho='$koho' where cislo='$zaznam777[cislo]'") || die(mysql_error());		

//echo $zaznam777[jmeno],$koho;

//echo"<BR>";

}

//-------------------------------------------------

for($i=0;$i<$pochracu;$i++){

$koho1=$zaznam77[$i];

$rasa2=$zaznam1[rasa];

$vys3 = MySQL_Query("SELECT koho FROM uzivatele where  (koho='$koho1' AND rasa ='$rasa2')");

$volen= MySQL_Num_Rows($vys3);

//echo $volen,  $zaznam77[$i];echo"<BR>";

MySQL_Query("update uzivatele set volen='$volen' where jmeno='$koho1'") || die(mysql_error());



}

//-------------------------------------------------------------------------------------------



/*

  		$den = Date("U");

	   	MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('6',$den,'vsichni','srovn�n� hlas�','N/A','$zaznam1[jmeno]')");



			$i=1000000;

			$vys11 = MySQL_Query("select cislo,jmeno,koho from uzivatele");

			while($zaznam11 = MySQL_Fetch_Array($vys11)):

				$prom="p".$zaznam11[koho];

				$$prom++;

			endwhile;



			$vys11 = MySQL_Query("select cislo,jmeno,koho from uzivatele");

			while($zaznam11 = MySQL_Fetch_Array($vys11)):

				$prom="p".$zaznam11[jmeno];

				$kolik=0;

				$kolik=$$prom;

				//echo $zaznam11[jmeno]." m� hlas�: ".$kolik."<br>";

				MySQL_Query("update uzivatele set volen=$kolik where cislo=$zaznam11[cislo]");

			endwhile;		

*/		endif;









?>



<form name="form" method="post" action="hlavni.php?page=vlada">
<span style="text-align: left; display: block;"><input type="text" name="koho" value="<?= $kdo?>"><br>
<input type=hidden name=hlasy value=1>
<input type=hidden value="srovnej">
<input type='hidden' name='over_post' value='1'>
<input type="submit" value="Změň volbu"></span>
</form> 

<?php

  	echo "</td>";

	echo "</tr>";

	echo "</table>";

	echo "<font class=text_bili><font class='text_bili'><font class=text_modry>P</font>r�va ";

	  switch ($zaznam1["status"]) {

//*******************************************ob�an************************************************	  

 			case 0:

	    		echo "ob�ana: </font><br><br>";



echo "Opustit st�vaj�c� rasu a p�ej�t k vyvrhel�m.<br>(Po p�echodu k vyvrhel�m v�m budou odejmutu v�echny CP ve va�em dr�en�, ztrat�te v�echen naquadah, p�ijdete o budovu banky a 50% va�ich jednotek. Rasu vyvrhelov� m��ete opustit a� po 48 hodin�ch.)<br><br>";

?>

<form name="form" method="post" action="hlavni.php?page=vlada">
<input type='hidden' name="hracc" value="<?= $zaznam1['cislo']?>">
<input type='hidden' name="hracn" value="<?= $zaznam1['jmeno']?>">
<input type='hidden' name="prasa" value="<?= $zaznam1['rasa']?>">
<input type='hidden' name="prejdi" value="98">
<input type="submit" value="Přejdi"><br><br>
</form>

<?php

//******************admins

/*if ($zaznam1[admin]==1):

$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa < 10 && rasa!=0 && rasa!=97 order by rasa");

				echo "<form name='rasak' method='post' action='hlavni.php?page=vlada'>";

				echo "Poslat rase <select name='f2rasa'>";

				while ($zaznam4 = MySQL_Fetch_Array($vys4)):

					if($zaznam4[rasa]==$rasa){continue;};

					echo "<option value = ".$zaznam4[rasa].">".$zaznam4["nazevrasy"];

				endwhile;

	    		  	echo "</select>";

				echo" z fondu ($zaznam9[fond] kg)<input type='text' name='kolik'>naquadahu <input type='hidden' name='over_post' value='1'><input type='submit' value='po�li'>";	

				$overeni1=Date("j")*$cisloz*2005;

				

        echo"<input type='hidden' name='overeni' value='".$overeni1."'>";

        echo "</form>";	

 endif; 

*/



	     		break;

	     		

	     		

    		

//*********************************************v�dce********************************************				

			case 1:

		        echo "v�dce: </font><br><br>";



				echo "<form name='rezig' method='post' action='hlavni.php?page=vlada'>";

				echo "Rezignovat na post v�dce &nbsp;<input type='hidden' name='volitm'><input type='hidden' name='over_post' value='1'><input type='submit' value='Rezignace'>";				

				echo "</form><p />";

				

				        

				echo "<form name='poradci' method='post' action='hlavni.php?page=vlada'>";

				echo "Jmenovat premi�ra: &nbsp;<input type='text' name='min1' value='$zaznam9[min1]' size=15>";
				



				echo "<input type='hidden' name='over_post' value='1'> &nbsp;<input type='submit' value='zm��'></form><br>";



        echo "<p />";



				echo "<form name='penize' method='post' action='hlavni.php?page=vlada'>";



				echo "Poslat u�ivateli &nbsp;<input type='text' size='15' name='komu'> &nbsp;z fondu &nbsp;(".fcis($zaznam9[fond])." kg) &nbsp;<input type='text' size='10' name='kolik'> &nbsp;naq. <input type='hidden' name='over_post' value='1'> z d�vodu <input type='text' size ='15' name='proc'>&nbsp;<input type='submit' value='po�li'>";	



        echo "</form>";



				$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa < 10 && rasa!=0 && rasa!=97 order by rasa");

				echo "<form name='rasak' method='post' action='hlavni.php?page=vlada'>";

				echo "Poslat rase &nbsp;<select name='f2rasa'>";

				while ($zaznam4 = MySQL_Fetch_Array($vys4)):

					if($zaznam4[rasa]==$rasa){continue;};

					echo "<option value = ".$zaznam4[rasa].">".$zaznam4["nazevrasy"];

				endwhile;

	    		  	echo "</select>";

				echo" &nbsp;z fondu &nbsp;(".fcis($zaznam9[fond])." kg) &nbsp;<input type='text' size='10' name='kolik'> &nbsp;naq.<input type='hidden' name='over_post' value='1'>&nbsp; z d�vodu <input type='text' size ='15' name='procr'>&nbsp;<input type='submit' value='po�li'>";	

				$overeni1=Date("j")*$cisloz*2005;

				

        echo"<input type='hidden' name='overeni' value='".$overeni1."'>";

        echo "</form>";

        

        echo "<p />";





				echo "<form name='mini' method='post' action='hlavni.php?page=vlada'>";

				echo "Minim�ln� vklad do fondu, maxim�ln� 50% &nbsp;<input type='text' size = '2' name='fond' value=$zaznam9[min]>% &nbsp;<input type='hidden' name='over_post' value='1'> &nbsp;<input type='submit' value='nastav'>";				

				echo "</form><br>";



        

				echo "<form name='mini' method='post' action='hlavni.php?page=vlada'>";

				echo "Minim�ln� vklad na v�zkum, maxim�ln� 50% &nbsp;<input type='text' size = '2'  name='vyz' value=$zaznam9[minv]>% &nbsp;<input type='hidden' name='over_post' value='1'> &nbsp;<input type='submit' value='nastav'>";

                                                                      				

				echo "</form><p />";



				

				echo "<form name='cp' method='post' action='hlavni.php?page=vlada'>";

				echo "P��sp�vky z centr�ln�ch planet: &nbsp;<input type='text' size = '2'  name='cpvyz' value=$zaznam10[vyzkum]>% z v�roby na v�zkum, &nbsp;<input type='text' size = '2' name='cpfond' value=$zaznam10[fond]>% z v�roby do fondu. &nbsp;<input type='hidden' name='over_post' value='1'><input type='submit' value='nastav'>";				

				echo "</form><p />";						



 				echo "<form name='ramsgfor' method='post' action='hlavni.php?page=vlada'>";

				echo "Rasov� zpr�va: <br />&nbsp;<textarea name='ramsg' cols='50' rows='5'>".$zaznam9["rasova_zprava"]."</textarea><input type='hidden' name='over_post' value='1'> &nbsp;<br /><input type='submit' value='Ulo� zpravu'>";				

				echo "</form><p />";        

        

                

				echo "<form name='vyvr' method='post' action='hlavni.php?page=vlada'>";

				echo "Vyhodit k vyvrhel�m hr��e &nbsp;<input type='text' name='vyvr'>&nbsp; z d�vodu <input type='text' size ='15' name='procv'>&nbsp;<input type='hidden' name='over_post' value='1'><input type='submit' value='vyho�'> <br /> Dnes u� bylo z na�� rasy vyhozeno k vyvrhel�m $zaznam9[darv] hr��� ";				

				echo "</form><p />";                       

        

				echo "<font class='text_bili'><font class=text_modry>S</font>eznam ob�an�</font>";

				echo "<TABLE ".$table." ".$border.">";

				if(empty($xr) || $xr<0){$xr=0;};

				$vys99 = MySQL_Query("SELECT jmeno,volen,rasa,status,fond,planety,vyzkum,sila,cislo,den,hra,posl,vek,zmrazeni FROM uzivatele where rasa = $rasa ORDER BY volen DESC limit $xr,30");		

				echo "<tr>";

				echo "<th>jm�no</th>";

				echo "<th>v�k</th>";

				echo "<th>posl. p�ihl.</th>";

				echo "<th>s�la</th>";

				echo "<th>po�et planet</th>";

				echo "<th>volen</th>";

				echo "<th>p�isp�v� % do fondu</th>";

				echo "<th>p�isp�v� % na v�zkum</th>";

				//echo "<th>exil</th>";

				echo "<th>Vyhnanstv�</th>";

				echo "</tr>";



		    $i = 0;



				while($zaznam99 = MySQL_Fetch_Array($vys99)):

				$i++;

				

				echo "<form name='exil' method='post' action='hlavni.php?page=vlada'>";			

				

					$den=$zaznam99["posl"];

					if($zmrazeni<$zaznam99["den"]):

						$dent = Date("H:i j.m",$den);

					else:

						$dent="<font color=blue>zmrazeno</font>";

					endif;

					if($zaznam99["status"]==4):

						$vyh="checked";

						$bex="class=text_modry";

					else:

						$vyh="ds";

						$bex="";

					endif;



					echo "<tr>";

					echo "<td class=text_modry>".$zaznam99["jmeno"]."</td>";

					echo "<td>" . Floor((Date("U")-$zaznam99["vek"])/86400) . "</td>";				

					echo "<td $bex>".$dent."</td>";

					echo "<td $bex>".fcis($zaznam99["sila"])."</td>";

					echo "<td $bex>".$zaznam99["planety"]."</td>";

					echo "<td $bex>".$zaznam99["volen"]."</td>";

					echo "<td $bex>".$zaznam99["fond"]."</td>";

					if($zaznam99["planety"]<2):

						echo "<td $bex>nem��e</td>";

					else:

						echo "<td $bex>".$zaznam99["vyzkum"]."</td>";

					endif;

					if(!($zaznam99["status"]==1 || $zaznam99["status"]==2 || $zaznam99["status"]==5)):

					//	echo "<td><input type='checkbox' name='".$zaznam99["cislo"]."' $vyh></td>";



					if($zaznam99["status"]==4):

            echo "<td $bex>Vyhnanec</td>";

					else:

						echo "<td>Ob�an</td>";

					endif;



					else:

						echo "<td>nelze</td>";

						



					endif;

					echo "</tr>";

				endwhile;

				

										

				echo "</table><p />";

				//*********************

				echo "Poslat do vyhnanstv� hr��e: ";

				

				$vysex = MySQL_Query("SELECT jmeno, status FROM uzivatele where rasa = '$rasa' order by jmeno");

        echo "<select name='doexilu'>

        <option value='' selected>";

        

				while ($zaznamex = MySQL_Fetch_Array($vysex)):

				  if ($zaznamex[status] == 0){

					echo "<option value = ".$zaznamex[jmeno].">".$zaznamex["jmeno"];

					}

				endwhile;

	    		  	echo "</select>&nbsp;<input type='hidden' name = 'doex' value='1'><input type='submit' value='Poslat'>";





	    		

          //-------------------  	

	     	echo "<br />P�ijmout z vyhnanstv� hr��e: ";

				

				$vysexx = MySQL_Query("SELECT jmeno, status FROM uzivatele where rasa = '$rasa' order by jmeno");

        echo "<select name='zexilu'>

        <option value='' selected>";

				while ($zaznamexx = MySQL_Fetch_Array($vysexx)):

				  if ($zaznamexx[status] == 4){

					echo "<option value = ".$zaznamexx[jmeno].">".$zaznamexx["jmeno"];

					}

				endwhile;

	    		  	echo "</select>&nbsp;<input type='hidden' name = 'zex' value='1'><input type='submit' value='P�ijmout'>";



	    		  	

	    	//**************************	  	

			/*	echo "<input type='hidden' name='exilan' value='1'>";

				echo "Za�krtnut� ob�an� jsou v exilu neza�krtnut� nejsou <input type='hidden' name='over_post' value='1'><input type='submit' value='zme� exil'><br>";

			*/	echo "<input type=hidden name='xr' value='$xr'></form>";

				$y=$xr+30;

				$z=$xr-30;

				$v=$y+30;

				$a=$xr;

				$m=$xr-29;

				if($z<1){$m=1;$a=31;};

				$b=$xr+31;

				echo "<center><font class='text_bili'><a href=hlavni.php?page=vlada&xr=".$z."&vyber=1 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Profily s ��slem ".$m." - ".$a."</a><br>";

				echo "<a href=hlavni.php?page=vlada&xr=".$y."&vyber=1 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Profily s ��slem ".$b." - ".$v."</a></font>";

	        	break;





//*****************************************z�stupce**************************************************				

		 	case 2:

				

				echo "<form name='penize' method='post' action='hlavni.php?page=vlada'>";

				echo "M��ete poslat za den 5 p��sp�vk�, ka�d� v hodnot� 33% ze skladu.<br /> Dnes jste poslali p��sp�vk�: $zaznam9[darz]. <br /> Maxim�ln� nyn�j�� mo�n� p��sp�vek: ".fcis(Floor($zaznam9[fond]*0.2))."<p>";

				echo "Poslat u�ivateli &nbsp;<input type='text' size='15' name='komu'> &nbsp;z fondu &nbsp;(".fcis($zaznam9[fond])." kg) &nbsp;<input type='text' size='10' name='kolik'> &nbsp;naq. <input type='hidden' name='over_post' value='1'> z d�vodu <input type='text' size ='15' name='proc'>&nbsp;<input type='submit' value='po�li'>";if($zaznam9[minv]<0){die;};	

			        
                               

				echo "</form><br>";

				echo "<form name='mini' method='post' action='hlavni.php?page=vlada'>";

				echo "Minim�ln� vklad do fondu, maxim�ln� 50% &nbsp;<input type='text' size = '2' name='fond' value=$zaznam9[min]>% &nbsp;<input type='hidden' name='over_post' value='1'>&nbsp;<input type='submit' value='nastav'>";

                                                                    				

				echo "</form><br>";



				echo "<form name='miniv' method='post' action='hlavni.php?page=vlada'>";

				echo "Minim�ln� vklad na v�zkum, maxim�ln� 50% &nbsp;<input type='text' name='vyz' size = '2' value=$zaznam9[minv]>% &nbsp;<input type='hidden' name='over_post' value='1'>&nbsp;<input type='submit' value='nastav'>";

                                                                      				

				echo "</form><p />";

				

				echo "<form name='ramsgfor' method='post' action='hlavni.php?page=vlada'>";

				echo "Rasov� zpr�va: <br />&nbsp;<textarea name='ramsg' cols='50' rows='5'>".$zaznam9["rasova_zprava"]."</textarea><input type='hidden' name='over_post' value='1'> &nbsp;<br /><input type='submit' value='Ulo� zpravu'>";				

				echo "</form><p />";  

				

				echo "<form name='prijm' method='post' action='hlavni.php?page=vlada'>";

				echo "P�ijmout u�ivatele &nbsp;<input type='text' name='prijmi'> &nbsp;z exilu &nbsp;<input type='hidden' name='over_post' value='1'>&nbsp;<input type='submit' value='p�ijmi'>";				

				echo "</form><p />";

				echo "<font class='text_bili'><font class=text_modry>S</font>eznam ob�an�</font>";

				echo "<TABLE ".$table." ".$border.">";

				if(empty($xr) || $xr<0){$xr=0;};

				$vys99 = MySQL_Query("SELECT jmeno,volen,rasa,status,fond,planety,sila,vyzkum,den,posl,vek FROM uzivatele where rasa = $rasa ORDER BY volen DESC limit $xr,30");		

				echo "<tr>";

				echo "<th>jm�no</th>";

				echo "<th>v�k</th>";

				echo "<th>posl. p�ihl.</th>";

				echo "<th>s�la</th>";

				echo "<th>po�et planet</th>";

				echo "<th>volen</th>";

				echo "<th>p�isp�v� % do fondu</th>";

				echo "<th>p�isp�v� % na v�zkum</th>";

				echo "<th>exil</th>";

				echo "</tr>";

				while($zaznam99 = MySQL_Fetch_Array($vys99)):

					$den=$zaznam99["posl"];

					$dent = Date("H:i j.m",$den);

					if($zaznam99["status"]==4):

						$vyh="ano";$colors="red";

					else:

						$vyh="ne";$colors="white";

					endif;

					if($zaznam99["vyzkum"]>0):

						$vyz=$zaznam99["vyzkum"];

					else:

						$vyz=0;

					endif;

					echo "<tr>";

					echo "<td>".$zaznam99["jmeno"]."</td>";

					echo "<td>" . Floor((Date("U")-$zaznam99["vek"])/86400) . "</td>";

					echo "<td>".$dent."</td>";

					echo "<td>".$zaznam99["sila"]."</td>";

					echo "<td>".$zaznam99["planety"]."</td>";

					echo "<td>".$zaznam99["volen"]."</td>";

					echo "<td>".$zaznam99["fond"]."</td>";

					if($zaznam99["planety"]<2):

						echo "<td>nem��e</td>";

					else:

						echo "<td>".$vyz."</td>";

					endif;

					echo "<td><font color=".$colors.">".$vyh."</font></td>";

					echo "</tr>";

				endwhile;

				echo "<input type=hidden name='xr' value='$xr'></table>";

				$y=$xr+30;

				$z=$xr-30;

				$v=$y+30;

				$a=$xr;

				$m=$xr-29;

				if($z<1){$m=1;$a=31;};

				$b=$xr+31;

				echo "<center><br><font class='text_bili'><a href=hlavni.php?page=vlada&xr=".$z."&vyber=1 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Profily s ��slem ".$m." - ".$a."</a><br>";

				echo "<a href=hlavni.php?page=vlada&xr=".$y."&vyber=1 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Profily s ��slem ".$b." - ".$v."</a></font>";

			    break;

/*

		 	case 3:

				echo "asistenta: </font><br>";

				echo "<form name='penize' method='post' action='hlavni.php?page=vlada'>";

				echo "M��ete poslat za den 2 p��sp�vky, ka�d� v hodnot� 10% ze skladu. Dnes jste poslali p��sp�vk�: $zaznam9[dara]. Maxim�ln� nyn�j�� mo�n� p��sp�vek: ".Floor($zaznam9[fond]*0.1)."<br>";

				echo "Poslat u�ivateli <input type='text' name='komu'> z fondu (ve fondu je $zaznam9[fond] kg) <input type='text' name='kolik'>naquadahu <input type='submit' value='po�li'>";	

			

				echo "</form><br>";

				echo "<form name='mini' method='post' action='hlavni.php?page=vlada'>";

				echo "Minim�ln� vklad do fondu, maxim�ln� 50%<input type='text' name='fond' value=$zaznam9[min]><input type='submit' value='nastav'>";				

				echo "</form><br>";



				echo "<form name='mini' method='post' action='hlavni.php?page=vlada'>";

				echo "Minim�ln� vklad na v�zkum, maxim�ln� 50% <input type='text' name='vyz' value=$zaznam9[minv]>%<input type='submit' value='nastav'>";				

				echo "</form><br>";

				break;

*/

//**************************************************exulant************************************

		 	case 4:

				echo "vyhnance: </font><br><br>";

				

echo "Opustit st�vaj�c� rasu a p�ej�t k vyvrhel�m.<br>(Po p�echodu k vyvrhel�m v�m budou odejmutu v�echny CP ve va�em dr�en�, ztrat�te v�echen naquadah, p�ijdete o budovu banky a 50% va�ich jednotek. Rasu vyvrhelov� m��ete opustit a� po 48 hodin�ch.)<br><br>";

?>



<form name="form" method="post" action="hlavni.php?page=vlada">
<input type='hidden' name="hracc" value="<?= $zaznam1['cislo']?>">
<input type='hidden' name="hracn" value="<?= $zaznam1['jmeno']?>">
<input type='hidden' name="prasa" value="<?= $zaznam1['rasa']?>">
<input type='hidden' name="prejdi" value="98">
<input type="submit" value="přejdi">
</form>



<?php

			    break;

//*********************************************poradce****************************

			case 5:

		        echo "ministra: </font><p>";

				

				echo "<form name='rezign' method='post' action='hlavni.php?page=vlada'>";

				echo "Rezignovat - vzd�t se funkce ministra <input type='hidden' name='over_post' value='1'><input type='submit' value='po�li'><input type=hidden name=rezignace value=1>";	

				echo "</form><p>";	





                                if($zaznam9[min1]==$logjmeno):

				echo "<form name='poradci' method='post' action='hlavni.php?page=vlada'>";

				echo "Jmenovat vl�du:<br>1. ministr: <input type='text' name='min2' value='$zaznam9[min2]' size=15><br>2. ministr: <input type='text' name='min3' value='$zaznam9[min3]' size=15><br>3. ministr: <input type='text' name='min4' value='$zaznam9[min4]' size=15><br>4. ministr: <input type='text' name='min5' value='$zaznam9[min5]' size=15>";

				echo "<br><input type='hidden' name='over_post' value='1'><input type='submit' value='zm��'></form><p>";

                                else:

                                echo "&nbsp;";

                                endif;

                                





                                if($zaznam9[min1]==$logjmeno || $zaznam9[min3]==$logjmeno || $zaznam9[min2]==$logjmeno):

				echo "<form name='penize' method='post' action='hlavni.php?page=vlada'>";

				

				echo "Poslat u�ivateli&nbsp;<input type='text' size='15' name='komu'>&nbsp;z fondu&nbsp;(".fcis($zaznam9[fond])." kg)&nbsp;<input type='text' size='10' name='kolik'>&nbsp;naq.<input type='hidden' name='over_post' value='1'> z d�vodu <input type='text' size ='13' name='proc'>&nbsp;<input type='submit' value='po�li'>";	



				echo "</form>";

                                else:

                                echo "&nbsp;";

                                endif;







                                if($zaznam9[min1]==$logjmeno || $zaznam9[min3]==$logjmeno):

$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa < 10 && rasa!=0 && rasa!=97 order by rasa");

				echo "<form name='rasak' method='post' action='hlavni.php?page=vlada'>";

				echo "Poslat rase &nbsp;<select name='f2rasa'>";

				while ($zaznam4 = MySQL_Fetch_Array($vys4)):

					if($zaznam4[rasa]==$rasa){continue;};

					echo "<option value = ".$zaznam4[rasa].">".$zaznam4["nazevrasy"];

				endwhile;

	    		  	echo "</select>";

				echo" &nbsp;z fondu &nbsp;(".fcis($zaznam9[fond])." kg) &nbsp;<input type='text' size='10' name='kolik'> &nbsp;naq. &nbsp;<input type='hidden' name='over_post' value='1'> z d�vodu <input type='text' size ='15' name='procr'>&nbsp;<input type='submit' value='po�li'>";	

				$overeni1=Date("j")*$cisloz*2005;

				

        echo"<input type='hidden' name='overeni' value='".$overeni1."'>";

        echo "</form>";

        

        echo "<p />";

                                else:

                                echo "&nbsp;";

                                endif;









                                if($zaznam9[min1]==$logjmeno || $zaznam9[min2]==$logjmeno):



				echo "<form name='mini' method='post' action='hlavni.php?page=vlada'>";

				echo "Minim�ln� vklad do fondu, maxim�ln� 50% &nbsp;<input type='text' size = '2' name='fond' value=$zaznam9[min]>% &nbsp;<input type='hidden' name='over_post' value='1'> &nbsp;<input type='submit' value='nastav'>";				

				echo "</form><br>";



        

				echo "<form name='mini' method='post' action='hlavni.php?page=vlada'>";

				echo "Minim�ln� vklad na v�zkum, maxim�ln� 50% &nbsp;<input type='text' size = '2'  name='vyz' value=$zaznam9[minv]>% &nbsp;<input type='hidden' name='over_post' value='1'> &nbsp;<input type='submit' value='nastav'>";

                                                                      				

				echo "</form><p />";



					echo "<form name='cp' method='post' action='hlavni.php?page=vlada'>";

				echo "P��sp�vky z centr�ln�ch planet: &nbsp;<input type='text' size = '2'  name='cpvyz' value=$zaznam10[vyzkum]>% z v�roby na v�zkum, &nbsp;<input type='text' size = '2' name='cpfond' value=$zaznam10[fond]>% z v�roby do fondu. &nbsp;<input type='hidden' name='over_post' value='1'><input type='submit' value='nastav'>";				

				echo "</form><p />";	



                                else:

                                echo "&nbsp;";

                                endif;			

                   

                                if($zaznam9[min1]==$logjmeno OR $zaznam9[min2]==$logjmeno){

 			echo "<form name='ramsgfor' method='post' action='hlavni.php?page=vlada'>";

				echo "Rasov� zpr�va: <br />&nbsp;<textarea name='ramsg' cols='50' rows='5'>".$zaznam9["rasova_zprava"]."</textarea><input type='hidden' name='over_post' value='1'> &nbsp;<br /><input type='submit' value='Ulo� zpravu'>";				

				echo "</form><p />";                                

                                } else {

                                  echo "&nbsp;";

                                }

                                

                                       if($zaznam9[min5]==$logjmeno || $zaznam9[min4]==$logjmeno || $zaznam9[min1]==$logjmeno):

				echo "<form name='vyvr' method='post' action='hlavni.php?page=vlada'>";

				echo "Vyhodit k vyvrhel�m hr��e <input type='text' name='vyvr'> z d�vodu <input type='text' size ='15' name='procv'>&nbsp;<input type='hidden' name='over_post' value='1'><input type='submit' value='vyho�'> <br /> Dnes u� bylo z na�� rasy vyhozeno k vyvrhel�m $zaznam9[darv] hr��� ";				

				echo "</form><br>";

                                else:

                                echo "&nbsp;";

                                endif;



			

				echo "<font class='text_bili'><font class=text_modry>S</font>eznam ob�an�</font>";

				echo "<TABLE ".$table." ".$border.">";

				if(empty($xr) || $xr<0){$xr=0;};

				$vys99 = MySQL_Query("SELECT jmeno,volen,rasa,status,fond,planety,vyzkum,sila,cislo,den,hra,posl,vek FROM uzivatele where rasa = $rasa ORDER BY volen DESC Limit $xr,30");		

				echo "<tr>";

				echo "<th>jm�no</th>";

				echo "<th>v�k</th>";

				echo "<th>posl. p�ihl.</th>";

				echo "<th>s�la</th>";

				echo "<th>po�et planet</th>";

				echo "<th>volen</th>";

				echo "<th>p�isp�v� % do fondu</th>";

				echo "<th>p�isp�v� % na v�zkum</th>";

        //echo "<th>exil</th>";

				echo "<th>Vyhnanstv�</th>";

				echo "</tr>";



		    $i = 0;



				while($zaznam99 = MySQL_Fetch_Array($vys99)):

				$i++;

				

				echo "<form name='exil' method='post' action='hlavni.php?page=vlada'>";			

				

					$den=$zaznam99["posl"];

					if($zmrazeni<$zaznam99["den"]):

						$dent = Date("H:i j.m",$den);

					else:

						$dent="<font color=blue>zmrazeno</font>";

					endif;

					if($zaznam99["status"]==4):

						$vyh="checked";

						$bex="class=text_modry";

					else:

						$vyh="ds";

						$bex="";

					endif;



					echo "<tr>";

					echo "<td class=text_modry>".$zaznam99["jmeno"]."</td>";

					echo "<td>" . Floor((Date("U")-$zaznam99["vek"])/86400) . "</td>";				

					echo "<td $bex>".$dent."</td>";

					echo "<td $bex>".fcis($zaznam99["sila"])."</td>";

					echo "<td $bex>".$zaznam99["planety"]."</td>";

					echo "<td $bex>".$zaznam99["volen"]."</td>";

					echo "<td $bex>".$zaznam99["fond"]."</td>";

					if($zaznam99["planety"]<2):

						echo "<td $bex>nem��e</td>";

					else:

						echo "<td $bex>".$zaznam99["vyzkum"]."</td>";

					endif;

					if(!($zaznam99["status"]==1 || $zaznam99["status"]==2 || $zaznam99["status"]==5)):

					//	echo "<td><input type='checkbox' name='".$zaznam99["cislo"]."' $vyh></td>";



					if($zaznam99["status"]==4):

            echo "<td $bex>Vyhnanec</td>";

					else:

						echo "<td>Ob�an</td>";

					endif;



					else:

						echo "<td>nelze</td>";

						



					endif;

					echo "</tr>";

				endwhile;

				

										

				echo "</table><p />";

				//*********************

				echo "Poslat do vyhnanstv� hr��e: ";

				

				$vysex = MySQL_Query("SELECT jmeno, status FROM uzivatele where rasa = '$rasa' order by jmeno");

        echo "<select name='doexilu'>

        <option value='' selected>";

        

				while ($zaznamex = MySQL_Fetch_Array($vysex)):

				  if ($zaznamex[status] == 0){

					echo "<option value = ".$zaznamex[jmeno].">".$zaznamex["jmeno"];

					}

				endwhile;

	    		  	echo "</select>&nbsp;<input type='hidden' name = 'doex' value='1'><input type='submit' value='Poslat'>";





	    		

          //-------------------  	

	     	echo "<br />P�ijmout z vyhnanstv� hr��e: ";

				

				$vysexx = MySQL_Query("SELECT jmeno, status FROM uzivatele where rasa = '$rasa' order by jmeno");

        echo "<select name='zexilu'>

        <option value='' selected>";

				while ($zaznamexx = MySQL_Fetch_Array($vysexx)):

				  if ($zaznamexx[status] == 4){

					echo "<option value = ".$zaznamexx[jmeno].">".$zaznamexx["jmeno"];

					}

				endwhile;

	    		  	echo "</select>&nbsp;<input type='hidden' name = 'zex' value='1'><input type='submit' value='P�ijmout'>";



	    		  	

	    	//**************************	  	

			/*	echo "<input type='hidden' name='exilan' value='1'>";

				echo "Za�krtnut� ob�an� jsou v exilu neza�krtnut� nejsou <input type='hidden' name='over_post' value='1'><input type='submit' value='zme� exil'><br>";

			*/echo "<input type=hidden name='xr' value='$xr'></form>";

				$y=$xr+30;

				$z=$xr-30;

				$v=$y+30;

				$a=$xr;

				$m=$xr-29;

				if($z<1){$m=1;$a=31;};

				$b=$xr+31;

				echo "<center><font class='text_bili'><a href=hlavni.php?page=vlada&xr=".$z."&vyber=1 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Profily s ��slem ".$m." - ".$a."</a><br>";

				echo "<a href=hlavni.php?page=vlada&xr=".$y."&vyber=1 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Profily s ��slem ".$b." - ".$v."</a></font>";				

	        	break;				

 		}

elseif($vyber==2):


echo "<form name='form' method='post' action='hlavni.php?page=vlada&vyber=2'>";

?>



<font class='text_bili'>Vypsat posledn�ch &nbsp;<input type='text' name='kolik' value='10' size='3'>&nbsp; �in� hr��e &nbsp;<input type='text' name='ci' value='Zadejte jm�no' size='15'>

<input type=submit value='Vypsat' name='vypsat'></font>

<?php

	if(($x<0 || empty($x))){$x=0;};

	$ciny2 = MySQL_Query("SELECT * FROM ciny where rasa = $rasa ORDER BY cas DESC LIMIT $x,30");

	echo "<center><br><br>";			

	echo "<TABLE ".$table." ".$border." wid=90%>";

	echo "<tr>";

	echo "<th>�as</th>";

	echo "<th>kdo (status)</th>";

	echo "<th>�in</th>";

	echo "<th>d�vod</th>";

	echo "</tr>";

	while($ciny = MySQL_Fetch_Array($ciny2)):	

		$cas=Date("G:i:s j.m.Y",$ciny["cas"]);;

		$proc = $ciny["proc"];

		switch($ciny[status]){

			case 1 :$status="v�dce";break;

			case 2 :$status="z�stupce";break;

			case 3 :$status="asistent";break;

			case 4 :$status="vyhnanec";break;

			case 5 :$status="poradce";break;

			default: $status="ob�an";

		};

		switch($ciny[cin]){

			case 1 :$cin="P�ijmul od vyvrhel� hr��e $ciny[koho]";break;

			case 2 :$cin="Vyhodil k vyvrhel�m hr��e $ciny[koho]";break;

			case 3 :$cin="Poslal hr��i $ciny[koho] ".number_format($ciny[cislo],0,0," ")." NQ";break;

			case 4 :$cin="Poslal rase $ciny[koho] ".number_format($ciny[cislo],0,0," ")." NQ";break;

			case 5 :$cin="Poslal hr��i $ciny[koho] jednotky v hodnot� ".number_format($ciny[cislo],0,0," ")." NQ";break;			

			case 6 :$cin="Poslal do fondu ".number_format($ciny[cislo],0,0," ")." NQ";break;			

			case 7 :$cin="Poslal do rasov� arm�dy jednotky v hodnot� ".number_format($ciny[cislo],0,0," ")." NQ";break;						

	    case 20 :$cin="Rasa $ciny[koho] poslala ".number_format($ciny[cislo],0,0," ")." NQ";break;

		

  	};

		echo "<tr>";		

		echo "<td>$cas</td>";

		echo "<td>$ciny[kdo] ($status)</td>";	

		echo "<td>$cin</td>";	

    echo "<td>$proc</td>";			

		echo "</tr>";		

	endwhile;

	echo "</table></center>";

	$y=$x+30;

	$z=$x-30;

	echo "<center><font class='text_bili'><a href=hlavni.php?page=vlada&x=".$z."&vyber=2 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>30 nov�j��ch �in�</a><br>";

	echo "<a href=hlavni.php?page=vlada&x=".$y."&vyber=2 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>30 star��ch �in�</a></font>";





	//***********nove***************

elseif($vyber==5):



		include "fond.php";





	//***********prepocet***************

elseif($vyber==6):



		include "naqprepocet.php";

		

		

  //***********log prepoctu************		

elseif($vyber==7):



    include "logprep.php";


				

	//***********ciny adminu***************

elseif($vyber==4):

	if(($x<0 || empty($x))){$x=0;};

	$log2 = MySQL_Query("SELECT * FROM log ORDER BY den DESC LIMIT $x,30");

	echo "<center>";			

	echo "<TABLE ".$table." ".$border." width=90%>";

	echo "<tr>";

	echo "<th>�as</th>";

	echo "<th>admin</th>";	

	echo "<th>�in</th>";		

	echo "</tr>";

	while($log = MySQL_Fetch_Array($log2)):	

		$den=Date("G:i:s j.m.Y",$log["den"]);;

		$log[admin];

    switch($log[cil]){

			case 1 :$cil="Poslal hr��i $log[cilt] $log[konk] NQ";break;

			case 2 :$cil="Smazal hr��e $log[cilt]";break;

			case 3 :$cil="Poslal rase $log[cilt] $log[konk] NQ";break;

			case 4 :$cil="P�esunul hr��e $log[cilt]"; $cil.=" k rase "; $cil.=$log[konk];break;

			case 5 :$cil="Smazal hr��i $log[cilt] planetu $log[konk]";break;			

			case 6 :$cil="Srovnal hlasy";break;			

			case 7 :$cil="Srovnal s�lu";break;

			case 8 :$cil="Vytvo�il rase $log[cilt] n�rodn�ho hrdinu $log[konk]";break;

			case 9 :$cil="Vytvo�il rase $log[cilt] CP se jm�nem $log[konk]";break;

			case 10 :$cil="Vytvo�il rase $log[cilt] PP se jm�nem $log[konk]";break;

			case 11 :$cil="Zm�nil rase $log[cilt] stav rasov� arm�dy $log[konk]";break;

			case 12 :$cil="Zastavil hru";break;

			case 13 :$cil="Spustil hru";break;

			case 14 :$cil="Zastavil �tok";break;

			case 15 :$cil="Spustil �tok";break;

			case 16 :$cil="Spustil meziv�k";break;

			case 17 :$cil="Ukon�il meziv�k";break;

			case 18 :$cil="Zbo�il banku hr��i $log[cilt]";break;

		};

		echo "<tr>";		

		echo "<td>$den</td>";

		echo "<td>$log[admin]</td>";	

		echo "<td>$cil</td>";				

		echo "</tr>";		

	endwhile;

	echo "</table></center>";

	$y=$x+30;

	$z=$x-30;

	echo "<center><font class='text_bili'><a href=hlavni.php?page=vlada&x=".$z."&vyber=4 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>30 nov�j��ch �in�</a><br>";

	echo "<a href=hlavni.php?page=vlada&x=".$y."&vyber=4 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>30 star��ch �in�</a></font>";				







	//*******************ciny adminu konec***********

	

	

else:	



endif;

	echo "</font>";

