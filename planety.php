<?php
$mezi_ovl=1;

require 'data_1.php';
require 'functions.php';


  

		if(isset($kam)){
			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo='$logcislo'") or die(mysql_error());
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa1 = $zaznam1["rasa"] ;
			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);
			$vys3 = MySQL_Query("SELECT * FROM planety where cislo = '$kam'");
			$zaznam3 = MySQL_Fetch_Array($vys3);
			if($zaznam3[cislomaj]!=$logcislo){echo "<font class='text_cerveny'>Tato planeta nen� va�e</font>";exit;};
      		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=8 and mrtev!=1)") or die(mysql_error());
			@$stav = MySQL_Fetch_Array($stavitel2);
		 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ=8");
			$typhs = MySQL_Fetch_Array($typhs2);

			$bstav=1-($stav[level]*$typhs[ucinek]);
			if($stav[cislomaj]!=$logcislo){$bstav=1;};
			//echo "<font class text_bili>".$bstav;
			$cislos=$stav[cislo];
			$typp=$zaznam3[typ];

			$plan = MySQL_Query("SELECT * FROM typp where typ = '$typp'") or die(mysql_error());				
			$pla = MySQL_Fetch_Array($plan);
			$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'") or die(mysql_error());
			$politika = MySQL_Fetch_Array($politika1);
			$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'") or die(mysql_error());
			$narod = MySQL_Fetch_Array($narod1);
			$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'") or die(mysql_error());
			$zriz = MySQL_Fetch_Array($zrizeni1);

			if($zaznam1[bran]==0):
				$brany=1;
			else:
				$brany=$zaznam1[bran];
			endif;
//echo $kasaren,$vyroben,$sdi,$par ;
			$cmkas=$mkas=$kasaren*1;
			$cmvyr=$mvyr=$vyroben*1;
			$cmmes=$mmes=$mest*1;
			$cmsdi=$msdi=$sdi*1;
			$cmpar=$mpar=$par*1;
			$cmlab=$mlab=$lab*1;
			$cmbra=$mbra=$bra*1;
			$cmpol=$mpol=$pol*1;
			//echo gettype($mmes);
			
		   do{
			if($zaznam3[status]==2){echo "<P align=center><font class='text_cerveny'>Na CP se nesm�  stav�t ani bourat ��dn� budovy<font>";break;};
			//if(($mkas<0 || $mvyr<0 || $mmes<0)){echo "<font class='text_cerveny'>��sla nesm� b�t z�porn�</font>";break;};
			
			$c=$zaznam3[cas]+43200;
			if(Date("U")<$c):
				$kdy=Date("h:i:s j.m.Y",$c);
				if(($mkas<0) or ($mvyr<0) or ($mmes<0) or ($msdi<0) or ($mpar<0) or ($mlab<0) or ($mbra<0) or ($mpol<0))
					{echo "<font class='text_cerveny'>Na planet� ".$zaznam3[nazev]." nem��eme prod�vat budovy kv�li jej�mu ned�vn�mu obsazen�. Prod�vat budovy m��eme nejd��ve v ".$kdy."</font>";break;};
			endif;

			if((Is_double($mkas) || Is_double($mvyr) || Is_double($mmes) || Is_double($msdi)|| Is_double($mpar)|| Is_double($mlab)|| Is_double($mbra))){echo "<font class='text_cerveny'>��sla nesm� b�t desetinn�</font>";break;};

			if(($mkas+$zaznam3["kasarna"])<0){$mkas=0;$cmkas=0;};
			if(($mvyr+$zaznam3["vyrobna"])<0){$mvyr=0;$cmvyr=0;};
			if(($mmes+$zaznam3["mesta"])<0){$mmes=0;$cmmes=0;};
			if(($msdi+$zaznam3["sdi"])<0){$msdi=0;$cmsdi=0;};
			if(($mpar+$zaznam3["par"])<0){$mpar=0;$cmpar=0;};
			if(($mlab+$zaznam3["laborator"])<0){$mlab=0;$cmlab=0;};
			if(($mbra+$zaznam3["brana"])<0){$mbra=0;$cmbra=0;};


			if($mvyr<0){$cmvyr*=0.25;};
			if($mkas<0){$cmkas*=0.25;};
			if($mmes<0){$cmmes*=0.25;};
			if($msdi<0){$cmsdi*=0.25;};
			if($mpar<0){$cmpar*=0.25;};
			if($mlab<0){$cmlab*=0.25;};
			if($mpol<0){$cmpol*=0.25;};
			//if($mbra<0){$cmbra*=0.25;}; neprod�v�n� bran
			if($mbra<0){$cmbra*=0;};																	

      $celkpenez=$cmvyr*$zaznam2["vyr_cena"]*$bstav*$politika[cenas]/100*$politika[cenat]/100*$narod[cenav]/100*$zriz[cenav]/100;
			$celkpenez+=$cmmes*($zaznam2["mes_cena"]*$bstav*$politika[cenas]/100*$pla[cmesta]/100);
			$celkpenez+=$cmkas*$zaznam2["kas_cena"]*$bstav;
			$celkpenez+=$cmsdi*($zaznam2["sdi_cena"]*$bstav*$politika[cenas]/100);
			$celkpenez+=$cmpar*($zaznam2["park_cena"]*$bstav*$politika[cenas]/100);
			$celkpenez+=$cmlab*($zaznam2["lab_cena"]*$bstav*$politika[cenas]/100);
			$celkpenez+=$cmbra*($zaznam2["bra_cena"]*2*$bstav*$brany*$brany*$politika[cenas]/100);
			$celkpenez+=$cmpol*($zaznam2["pol_cena"]*$bstav*$politika[cenas]/100);
			

$zbyva=($zaznam2["mest"]*$zaznam3["mesta"])-$zaznam3["kasarna"]-$zaznam3["vyrobna"]-$zaznam3["sdi"];
             
             if(Is_double($pol)){echo "<font class='text_cerveny'>Nepovolen� po�et staveb.</font><BR>";break;}
             if ($pol<0){
             if($zaznam3[pol] < (abs($pol)) ){echo "".$pol." ".$zaznam3["pol"]."<font class='text_cerveny'>Nepovolen� po�et staveb.</font><BR>";break;}
              }


                //if($pol<0 or $zbyva<$pol){echo "".$zaznam3["pol"]."<font class='text_cerveny'>Nepovolen� po�et staveb.</font><BR>";break;}

			if($celkpenez<=$zaznam1["penize"]):
				$celklidi=($mvyr+$zaznam3["vyrobna"])*$zaznam2["vyr_lidi"];
				$celklidi+=($msdi+$zaznam3["sdi"])*$zaznam2["sdi_lidi"];
				$celklidi+=($mlab+$zaznam3["laborator"])*$zaznam2["lab_lidi"];
				if($celklidi<=$zaznam3["lidi"]):
					$celkzas=$mvyr+$zaznam3["vyrobna"]+$mkas+$zaznam3["kasarna"]+$msdi+$zaznam3["sdi"];
					$celkzas+=$mpar+$zaznam3["par"]+$mlab+$zaznam3["laborator"];
					if(($celkzas<=($zaznam3["mesta"]*$zaznam2["mest"]))&&(($zaznam3["mesta"]+$mmes)<=$pla[mest])):
						$nvyr=$zaznam3["vyrobna"]+$mvyr;
						$nmes=$zaznam3["mesta"]+$mmes;
						$nkas=$zaznam3["kasarna"]+$mkas;
						$nsdi=$zaznam3["sdi"]+$msdi;						
						$npar=$zaznam3["par"]+$mpar;
						$nlab=$zaznam3["laborator"]+$mlab;
						$nbra=$zaznam3["brana"]+$mbra;
						$npol=$zaznam3["pol"]+$mpol;						
						$npez=$zaznam1["penize"]-$celkpenez;
						if($npez<0){$npez=0;};
						if($nbra<2):
						
							if($zaznam3["lidi"]>0):
								$spok=$nsdi*$zaznam2["sdi_lidi"]+$nvyr*$zaznam2["vyr_lidi"];
								$spok+=$nlab*$zaznam2["lab_lidi"];
								$spok/=($zaznam3["lidi"]/100);
							else:
								$spok=0;
							endif;
							$spok*=$politika[spokojenost]/100;
							$spok*=$narod[spokojenost]/100;
							$spok*=$zriz[spokojenost]/100;
							$spok=Floor($spok);
							$spok+=$npar*$zaznam2[park_proc];
							$spok+=$pla[spokojenost];
							if($spok>100){$spok=100;};
							if($nbra>0){$spok+=20;};
							//echo "".$nkas.",".$nsdi.",".$npar."" ;
							MySQL_Query("update planety set vyrobna='$nvyr',spokojenost='$spok',mesta='$nmes',kasarna='$nkas',pol='$npol' where cislo = '$kam'") or die(mysql_error());
							MySQL_Query("update planety set sdi='$nsdi',par='$npar',laborator='$nlab',brana='$nbra' where cislo = '$kam'") or die(mysql_error());
							$brany=$zaznam1["bran"]+$mbra;
							MySQL_Query("update uzivatele set penize='$npez',bran='$brany' where cislo='$logcislo'");
						else:
							echo "<font class='text_cerveny'>Na jedn� planet� m��e b�t jen jedna hv�zdn� br�na.</font>";
						endif;	

						$zkusn=($celkpenez/$zaznam2["mes_cena"]);
						//echo "<br><font class=text_bili>".$zkusn;
						//$zkusn=@($celkpenez/($zaznam1[prijem]/100))/10;
							$zkusn=((1000.0*$celkpenez)/($zaznam1["prijem"]/1.0))/1.0;
						//echo "<br><font class=text_bili>".$zkusn;
						$zkusn=Floor($zkusn)+$stav["zkus"];
						//$lv=bcsqrt(abs($zkusn)/1000);
						$lv=sqrt(abs($zkusn)/550.0);
						$lv=Floor($lv);
						if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};
						MySQL_Query("update `hrdinove` set `zkus`='$zkusn',`level`='$lv' where `cislo`='$cislos'");					
					else:
						echo "<font class='text_cerveny'>M�lo m�sta nebo m�lo m�st</font>";
					endif;
				else:
					echo "<font class='text_cerveny'>M�lo nezam�stnan�ch lid� na planet�</font>";			
				endif;
			else:
				echo "<font class='text_cerveny'>Mate m�lo naquadahu</font>";							
			endif;
		   }while(false);
		};
		
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo='$logcislo'")or die(mysql_error());
		$zaznam1 = MySQL_Fetch_Array($vys1);

		require("kontrola.php");




include "menupl.php";



		if($zaznam1[status]==4):
			$a=1.5;
		else:
			$a=1;
		endif;


	if(empty($vyber)){$vyber=1;};


//*******************************************************CP******************************
	if($vyber==3):


        $vys10 = MySQL_Query("SELECT jmeno,heslo,rasa,status,admin,heslo2,dobyl,dobyl_part,dobyl_zhn FROM uzivatele where cislo='$logcislo'");
	$zaznam10 = MySQL_Fetch_Array($vys10);
  	$rasahrace=$zaznam10[rasa];	

	$vys11 = MySQL_Query("SELECT rasa,nazevrasy,status FROM rasy where rasa='$rasahrace'");
	$zaznam11 = MySQL_Fetch_Array($vys11);	

  	$rasahraces=$zaznam11[nazevrasy];



                $query3 = mysql_query("SELECT presunod FROM rasy where rasa='$rasahrace'");
$rot3 = mysql_fetch_array($query3);
$presunod=$rot3[presunod];

$casted=Date("U");  
$b=((86400-($casted-$presunod))/3600);
//echo "".$casted." ".$presunod.""; 
if($casted-$presunod<=86400){echo "<center><font class='text_cerveny'>Dal�� p�esun je mo�n� a� za ".number_format($b,1,"."," ")." hodin</h1></center>";die;};  



	if(isset($gocp)):
		do{
			$vys2 = MySQL_Query("SELECT rasa,cislo,jmeno FROM uzivatele where jmeno = '$jmeno'");
			$zaznam2 = MySQL_Fetch_Array($vys2);
			$vys4 = MySQL_Query("SELECT cislo,nazev,cislomaj FROM planety where cislo = '$planeta'");
			$zaznam4 = MySQL_Fetch_Array($vys4);
			$majitel=$zaznam4[cislomaj];
			$vys5 = MySQL_Query("SELECT rasa,cislo,jmeno FROM uzivatele where cislo = '$majitel'");
			$zaznam5 = MySQL_Fetch_Array($vys5);

                        $presunod=Date("U");
			if($zaznam5[rasa]!=$rasahrace){echo "<font class='text_cerveny'>Planeta nen� v dr�en� Va�� rasy</font>";break;};
			if($zaznam2[rasa]!=$rasahrace){echo "<font class='text_cerveny'>Tento hr�� nen� z Va�� rasy</font>";break;};
			if($zaznam10[status]!=1 and $zaznam10[status]!=5){echo "<font class='text_cerveny'>Toto m��e d�lat jedin� v�dce nebo ministr.</font>";break;};
			
			MySQL_Query("update planety set cislomaj=$zaznam2[cislo] where cislo=$planeta");
                        MySQL_Query("update rasy set presunod='$presunod' where rasa='$rasahrace'");
		}while(false);
	endif;




                        echo "<TABLE border='1' width='500' align=center>";
			echo "<tr>";
			$vys1 = MySQL_Query("SELECT * FROM planety where status>1 order by majitel");
			if($zaznam10[status]==1 or $zaznam10[status]==5):
				echo "<th colspan=5>CP</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<th>&nbsp;</th>";
			else:
				echo "<th colspan=3>CP</th>";
				echo "</tr>";
				echo "<tr>";
			endif;
			echo "<th>n�zev</th>";
			echo "<th>rasy</th>";
			echo "<th>majitel</th>";
			echo "</tr>";
			$vys1 = MySQL_Query("SELECT * FROM planety where status>1 order by majitel");
			$nadpis = "Centr�ln� planety";	
			while ($zaznam1 = MySQL_Fetch_Array($vys1)):
				$cislomaj=$zaznam1[cislomaj];
				$vys3 = MySQL_Query("SELECT jmeno,rasa FROM uzivatele where cislo=$cislomaj");
				$zaznam3 = MySQL_Fetch_Array($vys3);
				$rasa1 = $zaznam3["rasa"] ;
				$vys2 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa = '$rasa1'");
				$zaznam2 = MySQL_Fetch_Array($vys2);
				$a=$zaznam1[majitel];
				$b=$zaznam2[nazevrasy];
				$c=$rasahraces;
				if($b==$a){$color="green";}
				else{$color="red";}
				echo "<tr>";
				if(($zaznam10[status]==1 or $zaznam10[status]==5) and ($a==$c)){
					echo "<form name='form' method='post' action='hlavni.php?page=planety&vyber=3'>";
					echo "<td><input type=submit value='zm��'></td>";
					}
				elseif($zaznam10[status]==1 or $zaznam10[status]==5){echo "<td>&nbsp;</td>";};
				echo "<td>".$zaznam1[nazev]."</td>";
				echo "<td>".$a."</td>";
				$i=0;
				if(($zaznam10[status]==1 or $zaznam10[status]==5) and ($a==$c)):
					echo "<td><font color=".$color."><input type=text value='".$zaznam3[jmeno]."' name='jmeno' size=15> (".$b.")</font>";
					echo "<input type=hidden name=planeta value='".$zaznam1[cislo]."'><input type=hidden value=1 name='gocp'></td>";
					echo "</form>";

					$i++;
				else:
					echo "<td><font color=".$color.">".$zaznam3[jmeno]." (".$b.")</font></td>";
				endif;
				echo "</tr>";
			endwhile;
			echo "</table>";


//****************************************************Nov�************************************	
	elseif($vyber==4):

	include "planety2x.php";

	endif;




//****************************************Banka*******************************************
	if($vyber==5):

        $kderasa=$zaznam1[rasa];

	$vysbanka = MySQL_Query("SELECT * FROM rasy where rasa = '$kderasa' ");	
	$zaznambanka = MySQL_Fetch_Array($vysbanka);


                $banka=$zaznam1[banka];

		$banka1=$banka;

                $bankau=$zaznam1[bankau];

		$bankau1=$bankau;

                $bankao=$banka+$bankau;


                $penize=$zaznam1["penize"];

                $penize1=$penize;

                $maxpovoleno=1000000000;
                $minpovoleno=500000;

                $jebudova=$zaznam1[bankabudova];

                $jebudovakontrola=$zaznam1[kontrolabankabudova];
   
                $cenabanky=$zaznambanka[vyr_vyrob]*200000;

                $nasemena=$zaznambanka[vyr_vyrob];

                $poplatek=6;
                $poplatekp=8;

                $aktdatum=Date("U");

                $casodeslanip=$zaznam1[bankaposl];

                $bankapouzita=$zaznam1[bankap];

                $vazanodokdy=$zaznam1[bankav];

                $mmmm=Date("G:i:s j.m.Y",$vazanodokdy);

                $bvj=$casodeslanip-$aktdatum;
                $bvb=$bvj/60;


echo "<center>";


echo "<center><br><br><font class='text_bili'><font class='text_modry'>B</font>anka</font><br><br>";



echo "<div align = 'left' style='margin-left: 10px'><font class='text_bili'>Naquadah: <font class='text_cerveny'>".number_format($bankao,0,0," ")."</font><br /> 
Term�novan� vklad: <font class='text_cerveny'>".number_format($bankau1,0,0," ")."</font><br />
Klasick� ��et: <font class='text_cerveny'>".number_format($banka1,0,0," ")."</font><p /> </div>";

if($jebudova!=1):
echo "<center><font class='text_cerveny'>Bou�el je�t� nem�te banku. Banku m��ete postavit, ale bude v�s to st�t ".fcis($cenabanky).".</font> <br><br><form name='form' method='post' action='hlavni.php?page=planety&vyber=5'><input type='hidden' value='1' name='budova'>
<input type='submit' value='Postavit banku'></form></center>";

if(isset($budova)):
if($jebudovakontrola=="0"){
if($zaznam1[penize]>$cenabanky){

$zustatekv=$zaznam1[penize]-$cenabanky;

MySQL_Query("update uzivatele set bankabudova = '1' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set kontrolabankabudova = '1' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set penize = '$zustatekv' where jmeno='$logjmeno'");

echo "<font class='text_cerveny'><center>Banka byla postavena.</font></center>";

}
else{echo "<font class='text_cerveny'><center>Nem�te naquadah na postaven� banky.</font></center>";
}

}
else{echo "<font class='text_cerveny'><center>Nem��ete postavit v�ce jak jednu banku.</font></center>";
}

endif;

else:

if($bankav):
if($vloz!==""){
if($vloz<$penize1){
if((is_numeric($vloz))){
if($vloz>0){
if(!(Is_double($vloz))){
if($banka1<$maxpovoleno){
if($vloz<$maxpovoleno){	


$zustatek=$zaznam1[penize]-$vloz;
$zustatekbanka=$zaznam1[banka]+$vloz;


$denc=Date("U");
$typc=Vklad;


MySQL_Query("INSERT INTO banka (den,kdo,kdojmeno,typ,castka,vazano,urok,poplatek) VALUES ($denc,'$logcislo','$logjmeno','$typc','$vloz','0','0','0')");
MySQL_Query("update uzivatele set banka = '$zustatekbanka' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set penize = '$zustatek' where jmeno='$logjmeno'");

echo "<font class='text_cerveny'><center>Bylo vlo�eno ".fcis($vloz)." naquadahu.</font></center>";

}
else{echo "<font class='text_cerveny'><center>Banka v�m takto obrovsk� obnos odm�tla p�ijmout.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Banka v�m ji� ulo�ila maxim�ln� mo�n� obnos.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Zadan� ��slo nesm� b�t desetinn�.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze zadat pouze kladn� ��slo.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze vkl�dat pouze cel� ��sla.</font></center>";
}

}
else{echo "<font class='text_cerveny'><center>Tolik naquadahu nem�te.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Nelze vlo�it 0 naquadahu.</font></center>";
}
endif;


if($bankat):
if($vlozt!==""){
if($vlozt<"$penize1"){
if((is_numeric($vlozt))){
if($vlozt>0){
if(!(Is_double($vlozt))){
if($bankau1<$maxpovoleno){
if($vlozt<$maxpovoleno){
if($bankapouzita==0){		


$denc=Date("U");
$typc=Vklad;

if ($typt == 1)
  {
    $vazanoa=Date("U")+(5*86400);
    $uroka=($vlozt/100)*10;
  }
elseif ($typt == 2)
  {
    $vazanoa=Date("U")+(10*86400);
    $uroka=($vlozt/100)*30;
  }
elseif ($typt == 3)
  {
    $vazanoa=Date("U")+(30*86400);
    $uroka=($vlozt*1.5);
  }


$zustatek=$zaznam1[penize]-$vlozt;
$zustatekbanka=($zaznam1[bankau]+$vlozt)+$uroka;


MySQL_Query("INSERT INTO banka (den,kdo,kdojmeno,typ,castka,vazano,urok,poplatek) VALUES ($denc,'$logcislo','$logjmeno','$typc','$vlozt','$vazanoa','$uroka','0')");
MySQL_Query("update uzivatele set bankau = '$zustatekbanka' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set penize = '$zustatek' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set bankav = '$vazanoa' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set bankap = '1' where jmeno='$logjmeno'");

$dokdyv=Date("G:i:s j.m.Y",$vazanoa);
$cilc=$vlozt+$uroka;

echo "<font class='text_cerveny'><center>Bylo vlo�eno ".fcis($vlozt)." naquadahu, vklad je v�z�n do ".$dokdyv." a c�lov� ��stka je ".fcis($cilc).".</font></center>";



}
else{echo "<font class='text_cerveny'><center>Lze vlo�it pouze jeden term�novan� vklad. Dal�� vklad bude umo�n�n a� po vyzvednut� sou�asn�ho vkladu.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Banka v�m takto obrovsk� obnos odm�tla p�ijmout.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Banka v�m ji� ulo�ila maxim�ln� mo�n� obnos.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Zadan� ��slo nesm� b�t desetinn�.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze zadat pouze kladn� ��slo.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze vkl�dat pouze cel� ��sla.</font></center>";
}

}
else{echo "<font class='text_cerveny'><center>Tolik naquadahu nem�te.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Nelze vlo�it 0 naquadahu.</font></center>";
}
endif;


if($bankab):
if($vyberb!==""){
if($vyberb<"$banka1"){
if((is_numeric($vyberb))){
if($vyberb>0){
if(!(Is_double($vyberb))){
if($vyberb<$maxpovoleno){

$poplatekc=$vyberb * 0.06;

$zustatekb=$zaznam1[penize]+($vyberb-$poplatekc);
$zustatekbankab=$zaznam1[banka]-$vyberb;

$denv=Date("U");
$typv="V�b�r";


MySQL_Query("INSERT INTO banka (den,kdo,kdojmeno,typ,castka,vazano,urok,poplatek) VALUES ($denv,'$logcislo','$logjmeno','$typv','$vyberb','0','0','$poplatekc')");
MySQL_Query("update uzivatele set banka = '$zustatekbankab' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set penize = '$zustatekb' where jmeno='$logjmeno'");


echo "<font class='text_cerveny'><center>Bylo vybr�no ".fcis($vyberb)." naquadahu.</font></center>";

}
else{echo "<font class='text_cerveny'><center>Banka v�m takto obrovsk� obnos odm�tla vydat.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Zadan� ��slo nesm� b�t desetinn�.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze zadat pouze kladn� ��slo.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze vkl�dat pouze cel� ��sla.</font></center>";
}

}
else{echo "<font class='text_cerveny'><center>V bance tolik naquadahu nen�.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Nelze vybrat 0 naquadahu.</font></center>";
}
endif;



if($bankatv):
if($vybert!==""){
if(($vybert-1)<"$bankau1"){
if((is_numeric($vybert))){
if($vybert>0){
if(!(Is_double($vybert))){
if($vybert<$maxpovoleno){
if($bankapouzita==1){
if($aktdatum>$vazanodokdy){		


$zustatekb=$zaznam1[penize]+($vybert);
$zustatekbankab=$zaznam1[bankau]-$vybert;

$denv=Date("U");
$typv="V�b�r";

MySQL_Query("INSERT INTO banka (den,kdo,kdojmeno,typ,castka,vazano,urok,poplatek) VALUES ($denv,'$logcislo','$logjmeno','$typv','$vybert','0','0','0')");
MySQL_Query("update uzivatele set bankau = '$zustatekbankab' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set penize = '$zustatekb' where jmeno='$logjmeno'");
MySQL_Query("update uzivatele set bankap = '0' where jmeno='$logjmeno'");

echo "<font class='text_cerveny'><center>Bylo vybr�no ".fcis($bankau1)." z va�eho term�novan�ho ��tu.</font></center>";

}
else
{
echo "<font class='text_cerveny'><center>Tento vklad je v�z�n do ".$mmmm." .</center></font>";
}
}
else{echo "<font class='text_cerveny'><center>Poku� chcete vyb�rat mus�te tak� n�co vlo�it.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Banka v�m takto obrovsk� obnos odm�tla vydat.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Zadan� ��slo nesm� b�t desetinn�.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze zadat pouze kladn� ��slo.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze vkl�dat pouze cel� ��sla.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>V bance tolik naquadahu nen�.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Nelze vybrat 0 naquadahu.</font></center>";
}
endif;


if($prevod):
if($prevodj!=""){
if($prevodb<"$zaznam1[banka]"){
if((is_numeric($prevodb))){
if($prevodb>0){
if(!(Is_double($prevodb))){
if($prevodb<$maxpovoleno){

	$kontrolajmena1 = MySQL_Query("SELECT jmeno,bankabudova FROM uzivatele where jmeno='$prevodj'");	
	$kontrolajmena2 = MySQL_Fetch_Array($kontrolajmena1);
        $kontrolujujmeno=$kontrolajmena2[jmeno];

if($prevodj==$kontrolujujmeno){
if($prevodj!=$logjmeno){
if($aktdatum>$casodeslanip){
if($prevodb>$minpovoleno){
if($kontrolajmena2[bankabudova]==1){
	

$poplatekpp=$prevodb * 0.08;

	$zaznamxz1 = MySQL_Query("SELECT cislo,rasa,banka,posta3 FROM uzivatele where jmeno='$prevodj' ");	
	$zaznamxy1 = MySQL_Fetch_Array($zaznamxz1);

        $vypsatcislorasy=$zaznamxy1[rasa];
        $cislokohop=$zaznamxy1[cislo];

	$zaznamxz11 = MySQL_Query("SELECT vyr_vyrob FROM rasy where rasa='$vypsatcislorasy' ");	
	$zaznamxy11 = MySQL_Fetch_Array($zaznamxz11);


        $prevodmeny=$zaznamxy11[vyr_vyrob];


$pppp=$prevodb/$nasemena;
$zustatekpenez=$zaznam1[banka]-($prevodb+$poplatekpp);
$zustatekpenezb=$zaznamxy1[banka]+($pppp*$prevodmeny);

$prevedlo=$pppp*$prevodmeny;


$denv=Date("U");
$typv="P�evod";
$datumposlp=Date("U")+(30*60);


$p=$zaznamxy1["posta3"]+1;
$rasabb=$zaznam1["rasa"];
$vys8 = MySQL_Query("SELECT * FROM rasy where rasa = $rasabb");
$zaznam8 = MySQL_Fetch_Array($vys8);
$rasa5=AddSlashes($zaznam8["nazevrasy"]);
$text= "Odes�latel V�m bankovn�m p�evodem zaslal ".$prevedlo." naquadahu";

MySQL_Query("INSERT INTO banka (den,kdo,kdojmeno,typ,castka,vazano,urok,poplatek,komu) VALUES ($denv,'$logcislo','$logjmeno','$typv','$prevodb','0','0','$poplatekpp','$prevodj')");
MySQL_Query("update uzivatele set banka = '$zustatekpenez' where jmeno='$logjmeno'");

MySQL_Query("update uzivatele set bankaposl = '$datumposlp' where jmeno='$logjmeno'");

MySQL_Query("update uzivatele set banka = '$zustatekpenezb' where jmeno='$prevodj'");
MySQL_Query("update uzivatele set posta3 = '$p' WHERE jmeno = '$prevodj'");
MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,rasa2,text,stav,nepr,typ,smaz) VALUES ($denv,'$logjmeno','$prevodj','Bankovn� p�evod','$rasa5','$rasa6','$text','1','1','3','0')");
                              



echo "<font class='text_cerveny'><center>Z va�eho ��tu bylo p�evedeno ".$prevodb." naquadahu na ��et hr��e ".$prevodj.", v jeho m�n� to bylo ".$prevedlo.".</font></center>";


}
else{echo "<font class='text_cerveny'><center>C�lov� login nem� banku.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Minim�ln� ��stka pro p�evod je ".$minpovoleno." naquadahu.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Dal�� bankovn� p�evod je mo�n� a� za ".number_format($bvb,1,"."," ")." minut.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Nelze pos�lat naquadah s�m sob�.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>C�lov� ��et neexistuje.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Banka v�m takto obrovsk� obnos odm�tla p�ev�st.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Zadan� ��slo nesm� b�t desetinn�.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze zadat pouze kladn� ��slo.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Lze vkl�dat pouze cel� ��sla.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>Tolik naquadahu nem�te.</font></center>";
}
}
else{echo "<font class='text_cerveny'><center>C�lov� ��et neexistuje.</font></center>";
}
endif;

?>


<center>

<table border='1'>

<tr>

<th><font class='text_modry'>Typ</th>

<th><font class='text_modry'>Zadejte ��stku</th>

<th><font class='text_modry'>C�lov� ��et</th>

<th><font class='text_modry'>Pozn�mka</th>

<th><font class='text_modry'>Prov�st</font></th>


</tr>


<tr>

<th><font class='text_bili'>Vlo�it do banky bez mo�nosti �ro�en�</font></th>

<form name='form' method='post' action='hlavni.php?page=planety&vyber=5'>

<th><input type='text' value='<? echo $vloz;?>' size=10 name='vloz'></th>

<th>&nbsp;</th>

<th><font class='text_bili'>Klasick� - neterm�novan� vklad bez mo�nosti �ro�en�</font></th>

<th><input type='submit' value='Vlo�it' name=bankav></form></th>

</tr>

<tr>

<th><font class='text_bili'>Term�novan� vklad klasik</font></th>

<form name='form' method='post' action='hlavni.php?page=planety&vyber=5'>

<th><input type='text' value='<? echo $vlozt;?>' size=10 name='vlozt'></th>
<input type='hidden' value = '1' name = 'typt'>

<th>&nbsp;</th>

<th><font class='text_bili'>Term�novan� vklad (s t�mto vkladem nelze nakl�dat po dobu 5 dn�, vklad je �ro�en 10%)</font></th>

<th><input type='submit' value='Vlo�it' name=bankat></form></th>

</tr>

<tr>

<th><font class='text_bili'>Term�novan� vklad plus</font></th>

<form name='form' method='post' action='hlavni.php?page=planety&vyber=5'>

<th><input type='text' value='<? echo $vloztt;?>' size=10 name='vlozt'></th>
<input type='hidden' value = '2' name = 'typt'>

<th>&nbsp;</th>

<th><font class='text_bili'>Term�novan� vklad (s t�mto vkladem nelze nakl�dat po dobu 10 dn�, vklad je �ro�en 30%)</font></th>

<th><input type='submit' value='Vlo�it' name=bankat></form></th>

</tr>

<tr>

<th><font class='text_bili'>Term�novan� vklad extra</font></th>

<form name='form' method='post' action='hlavni.php?page=planety&vyber=5'>

<th><input type='text' value='<? echo $vlozttt;?>' size=10 name='vlozt'></th>
<input type='hidden' value = '3' name = 'typt'>

<th>&nbsp;</th>

<th><font class='text_bili'>Term�novan� vklad (s t�mto vkladem nelze nakl�dat po dobu 30 dn�, vklad je �ro�en 150%)</font></th>

<th><input type='submit' value='Vlo�it' name=bankat></form></th>

</tr>

<tr>

<th><font class='text_bili'>Vybrat z klasick�ho ��tu</font></th>

<form name='form' method='post' action='hlavni.php?page=planety&vyber=5'>

<th><input type='text' value='<? echo $vyberb;?>' size='10' name='vyberb'></th>

<th>&nbsp;</th>

<?

echo "<th><font class='text_bili'>Poplatek za v�b�r ".$poplatek."% z v��ky v�b�ru.</font></th>";
?>

<th><input type='submit' value='Vyber' name=bankab></form></th>

</tr>

<tr>

<th><font class='text_bili'>Vybrat z term�novan�ho ��tu</font></th>

<form name='form' method='post' action='hlavni.php?page=planety&vyber=5'>

<?
echo "<th><font class='text_bili'><input type='hidden' value='".$bankau1."' name='vybert'> ".$bankau1."</font> </th>";
?>

<th>&nbsp;</th>


<th><font class='text_bili'>V�b�r z term�novan�ho ��tu (lze jen celou ��stku)</font></th>


<th><input type='submit' value='Vyber' name=bankatv></form></th>

</tr>



<tr>

<th><font class='text_bili'>P�evod naquadahu</font></th>

<form name='form' method='post' action='hlavni.php?page=planety&vyber=5'>

<th><input type='text' value='<? echo $prevodb;?>' size='10' name='prevodb'></th>
<th><input type='text' value='<? echo $prevodj;?>' size='10' name='prevodj'></th>

<?
echo "<th><font class='text_bili'>P�ev�st naquadah na ��et jin�ho hr��e, poplatek za p�evod ".$poplatekp."% z v��ky p�ev�zen�ho naquadahu.</font></th>";
?>

<th><input type='submit' value='P�eve�' name=prevod></form></th>

</tr>


</table>

</center>

<br>


<center>

<?

echo "<br><br><font class='text_bili'><font class='text_modry'>V</font>�pis bankovn�ch transakc�</font><br><br>";

echo "<table border='1'>";
echo "<tr>";

echo "<th><font class='text_modry'>Datum p�evodu</font></th>";
echo "<th><font class='text_modry'>Typ p�evodu</font></th>";
echo "<th><font class='text_modry'>P�ev�d�n� ��stka</font></th>";
echo "<th><font class='text_modry'>C�lov� ��et</font></th>";
echo "<th><font class='text_modry'>Poplatek za p�evod</font></th>";
echo "<th><font class='text_modry'>V�z�no v bance do</font></th>";
echo "<th><font class='text_modry'>�rok</font></th>";
echo "</tr>";



	if(($x<0 or empty($x))){$x=0;};
	$bankatab = MySQL_Query("SELECT * FROM banka where kdo = '$logcislo' order by den desc LIMIT $x,20");	
	while($bankatabb = MySQL_Fetch_Array($bankatab)):


        $typ=$bankatabb[typ];
        $castka=$bankatabb[castka];

        if($bankatabb[poplatek]!=0):

        $poplatekk=$bankatabb[poplatek];
        
        else:

        $poplatekk=Zdarma;

        endif;

        
        if($bankatabb[vazano]!=0):

        $vazano=Date("G:i:s j.m.Y",$bankatabb[vazano]);
        
        else:

        $vazano="-";

        endif;


        if($bankatabb[urok]!=0):

        $urok=$bankatabb[urok];
        
        else:

        $urok="-";

        endif;


        $poslanok=$bankatabb[komu];

        $datumprevodu=Date("G:i:s j.m.Y",$bankatabb[den]);


echo "<tr>";
echo "<th><font class='text_bili'>".$datumprevodu."</font></th>";
echo "<th><font class='text_bili'>".$typ."</font></th>";
echo "<th><font class='text_bili'>".fcis($castka)."</font></th>";
echo "<th><font class='text_bili'>".$poslanok."</font></th>";
echo "<th><font class='text_bili'>".fcis($poplatekk)."</font></th>";
echo "<th><font class='text_bili'>".$vazano."</font></th>";
echo "<th><font class='text_bili'>".fcis($urok)."</font></th>";
echo "</tr>";

endwhile;

	echo "</table></center><br><br>";

	$y=$x+20;
	$z=$x-20;
	echo "<a href=planety.php?x=".$z."&vyber=5 id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>20 nov�j��ch transakc�</a><br>";
	echo "<a href=planety.php?x=".$y."&vyber=5 id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>20 star��ch transakc�</a>";	

endif;
endif;

//*******************************************************Nove******************************
	if($vyber==2):


		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$bstav=1-($stav[level]*$typhs[ucinek]);
		//echo "<font class text_bili>".$bstav;
		if($stav[cislomaj]!=$logcislo){$bstav=1;};
		//echo "<br><font class text_bili>".$bstav;
		//echo "<br><font class text_bili>".$stav[cislomaj];

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		if($zaznam1[bran]==0):
			$brany=1;
		else:
			$brany=$zaznam1[bran];
		endif;
		$mmest=$zaznam1["penize"]/($zaznam2[mes_cena]*$politika[cenas]/100);
		$mmest=Floor($mmest);
		$mvyr=$zaznam1["penize"]/($zaznam2[vyr_cena]*($politika[cenas]/100)*($politika[cenat]/100)*($narod[cenav]/100)*($zriz[cenav]/100));
		$mvyr=Floor($mvyr);
		$mkas=$zaznam1["penize"]/($zaznam2[kas_cena]*$bstav);
		$mkas=Floor($mkas);
		$msdi=$zaznam1["penize"]/($zaznam2[sdi_cena]*$bstav*$politika[cenas]/100);
		$msdi=Floor($msdi);

		$mpol=$zaznam1["penize"]/($zaznam2[pol_cena]*$bstav*$politika[cenas]/100);
		$mpol=Floor($mpol);

		$mpar=$zaznam1["penize"]/($zaznam2[park_cena]*$bstav*$politika[cenas]/100);
		$mpar=Floor($mpar);
		$mlab=$zaznam1["penize"]/($zaznam2[lab_cena]*$bstav*$politika[cenas]/100);
		$mlab=Floor($mlab);
		$mbra=$zaznam1["penize"]/(($zaznam2[bra_cena]*2*$brany)*$brany*$bstav*$politika[cenas]/100);
		$mbra=Floor($mbra);
		
		echo "<br><br><center><font class=text_bili><font class=text_modry>D</font>opl�kov� stavby</font><br><br>";
		

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' order by nazev ASC")or die(mysql_error());
      
		
		echo "<TABLE border='1'>";
		echo "<tr>";
		echo "<th><font class=text_modry>Budova:</th>";
		echo "<th>&nbsp;</th>";

		echo "<th><a href='hlavni.php?page=budovy&vybe=5'>Laborato�</font></th>";
		echo "<th><a href='hlavni.php?page=budovy&vybe=8'>".$zaznam2[pol_nazev]."</font></th>";
		echo "<th><a href='hlavni.php?page=budovy&vybe=6'>".$zaznam2[park_nazev]."</font></th>";
		echo "<th><a href='hlavni.php?page=budovy&vybe=7'>Br�na</font></th>";
	
		echo "</tr>";	

		echo "<tr>";
		echo "<th><font class=text_modry>Cena:</th>";
		echo "<th>&nbsp;</th>";
		echo "<th><font class=text_bili>".Round($zaznam2["lab_cena"]*$bstav*$politika[cenas]/100)."</font></th>";
		echo "<th><font class=text_bili>".Round($zaznam2["pol_cena"]*$bstav*$politika[cenas]/100)."</font></th>";
		echo "<th><font class=text_bili>".Round($zaznam2["park_cena"]*$bstav*$politika[cenas]/100)."</font></th>";
		echo "<th><font class=text_bili>".Round($zaznam2["bra_cena"]*$bstav*2*$brany*$brany*$politika[cenas]/100)."</font></th>";
	
		echo "</tr>";

		echo "<tr>";
		echo "<th><font class=text_modry>M�te na:</th>";
		echo "<th>&nbsp;</th>";	

		echo "<th><font class=text_bili>".fcis($mlab)."</font></th>";
		echo "<th><font class=text_bili>".fcis($mpol)."</font></th>";
		echo "<th><font class=text_bili>".fcis($mpar)."</font></th>";
		echo "<th><font class=text_bili>".fcis($mbra)."</font></th>";

		echo "</tr>";

		echo "<tr>";
		echo "<th><font class=text_modry>V�b�r:</th>";	
		echo "<th>"
?>	
                <form name='form' method='post' action='hlavni.php?page=planety&vyber=2' >
		<select name='kam'>
<?
			while ($zaznam3 = MySQL_Fetch_Array($vys3)):
				if($kam==$zaznam3["cislo"]):
					$if="selected";
				else:
					$if="";
				endif;
				echo "<option ".$if." value=".$zaznam3[cislo].">".$zaznam3["nazev"];
			endwhile;
?>
    		</select>
<?
"</th>";
		echo "<th><input type='text' name='lab' size='5'></th>";
		echo "<th><input type='text' name='pol' size='5'></th>";
		echo "<th><input type='text' name='par' size='5'></th>";
		echo "<th><input type='text' name='bra' size='5'></th>";
		echo "</tr>";


		echo "<tr>";
		echo "<th><font class=text_modry>Potvrdit:</font></th>";	
		echo "<th colspan=5><input type='submit' value='postavit'></form></th>";
		echo "</tr>";
		
		
		/*
		echo "<tr>";
		echo "<th colspan='6'>Postavit na ka�dou planetu <input type='text' name='kolkobudov' size = '5'> kr�t budovu&nbsp;<select name='akubudovu'>";
    
    echo "
    <option value='' selected></option>
    <option value='M�sto'>M�sto</option>
    <option value='".$zaznam2['vyr_nazev']."'>".$zaznam2['vyr_nazev']."</option>
    <option value='Obrana'>Obrana</option>
    <option value='Kas�rna'>Kas�rna</option>
    <option value='Laborato�'>Laborato�</option>
    <option value='".$zaznam2['pol_nazev']."'>".$zaznam2['pol_nazev']."</option>
    <option value='".$zaznam2['park_nazev']."'>".$zaznam2['park_nazev']."</option>
    <option value='Br�na'>Br�na</option>
    ";
    
    echo"</select>&nbsp;<input type='submit' value='Postavit'></th>";
		echo "</tr>";
*/

		echo "<tr>";
		echo "<th><font class=text_modry>Jm�no planety</font></th>";
		echo "<th><font class=text_bili>zastav�no/mo�no</font></th>";

		echo "<th><font class=text_bili>mo�no postavit</font></th>";
		echo "<th><font class=text_bili>mo�no postavit</font></th>";
		echo "<th><font class=text_bili>mo�no postavit</font></th>";
		echo "<th><font class=text_bili>mo�no postavit</font></th>";
		echo "</tr>";	


		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	
		while ($zaznam3 = MySQL_Fetch_Array($vys3)):
			$typp=$zaznam3[typ];
			$plan = MySQL_Query("SELECT * FROM typp where typ = '$typp'")or die(mysql_error());			
			$pla = MySQL_Fetch_Array($plan);

			$w=$zaznam3["lidi"]-$zaznam3["vyrobna"]*$zaznam2["vyr_lidi"];
			$w-=$zaznam3["sdi"]*$zaznam2["sdi_lidi"];
			$w-=$zaznam3["laborator"]*$zaznam2["lab_lidi"];
			$zbyva=($zaznam2["mest"]*$zaznam3["mesta"])-$zaznam3["kasarna"]-$zaznam3["vyrobna"]-$zaznam3["sdi"];
			//echo $zbyva;
			$zbyva=$zbyva-$zaznam3["laborator"]-$zaznam3["par"]-$zaznam3["pol"];
			$je=$zaznam3["kasarna"]+$zaznam3["vyrobna"]+$zaznam3["sdi"]+$zaznam3["par"]+$zaznam3["laborator"]+$zaznam3["pol"];

$nnn2=Floor($w/$zaznam2["vyr_lidi"]);

if($nnn2>$zbyva){$nnn2=$zbyva;}

$nnn3=Floor($w/$zaznam2["sdi_lidi"]);

if($nnn3>$zbyva){$nnn3=$zbyva;}

$nnn4=Floor($w/$zaznam2["lab_lidi"]);

if($nnn4>$zbyva){$nnn4=$zbyva;}

$nnn5=$mkas;

if($nnn5>$zbyva){$nnn5=$zbyva;}

$nnn6=$mpar;

if($nnn6>$zbyva){$nnn6=$zbyva;}

$nnn7=1;

if($nnn7>$zbyva){$nnn7=$zbyva;}

$nnn8=$mpol;

if($nnn8>$zbyva){$nnn8=$zbyva;}



			if($zaznam3[status]==2):
				$mestje=0;//echo "<tr>aa</tr>";
			else:
				$mestje=$pla[mest]-$zaznam3["mesta"];
			endif;
			echo "<tr>";
			echo "<td><center><font class=text_cerveny>".$zaznam3["nazev"]."</font></center></td>";
			echo "<td><center><font class=text_bili>".fcis($je)."/".fcis($zbyva)."</font></center></td>";


   

                        echo "<td><center><br>"
?>
		        <form name='form' method='post' action='hlavni.php?page=planety&vyber=2'>
                        <input type='hidden' name='lab' value='<?echo Floor($nnn4)?>'>
                        <input type='hidden' name='kam' value='<?echo $zaznam3["cislo"]?>'>
		        <input type='submit' value='<?echo "".fcis(Floor($nnn4)).""; ?>'>
		        </form>

<?
		      
"</td></center>";



                        echo "<td><center><br>"
?>
		        <form name='form' method='post' action='hlavni.php?page=planety&vyber=2'>
                        <input type='hidden' name='pol' value='<?echo Floor($nnn8)?>'>
                        <input type='hidden' name='kam' value='<?echo $zaznam3["cislo"]?>'>
		        <input type='submit' value='<?echo "".fcis(Floor($nnn8)).""; ?>'>
		        </form>

<?
		      
"</td></center>";



                        echo "<td><center><br>"
?>
		        <form name='form' method='post' action='hlavni.php?page=planety&vyber=2'>
                        <input type='hidden' name='par' value='<?echo Floor($nnn6)?>'>
                        <input type='hidden' name='kam' value='<?echo $zaznam3["cislo"]?>'>
		        <input type='submit' value='<?echo "".fcis(Floor($nnn6)).""; ?>'>
		        </form>

<?
		      
"</td></center>";

                        echo "<td><center><br>"
?>
		        <form name='form' method='post' action='hlavni.php?page=planety&vyber=2'>
                        <input type='hidden' name='bra' value='<?echo Floor($nnn7)?>'>
                        <input type='hidden' name='kam' value='<?echo $zaznam3["cislo"]?>'>
		        <input type='submit' value='<?echo "".fcis(Floor($nnn7)).""; ?>'>
		        </form>

<?
		      
"</td></center>";

	        
			echo "</tr>";
		endwhile;
endif;
		echo "</table>";

//****************************************Stavby*******************************************
	if($vyber==1):
?>

<?
		$rasa1 = $zaznam1["rasa"];

		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ='8' and mrtev!='1')")or die(mysql_error());
		@$stav = MySQL_Fetch_Array($stavitel2);

	 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ='8'")or die(mysql_error());
		$typhs = MySQL_Fetch_Array($typhs2);

		$bstav=1-($stav[level]*$typhs[ucinek]);
		//echo "".$bstav;
		if($stav[cislomaj]!=$logcislo){$bstav=1;};
		//echo "<br>".$bstav;
		//echo "<br>".$stav[cislomaj];

		$tex = MySQL_Query("SELECT * FROM texty where rasa ='$rasa1'")or die(mysql_error());
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'")or die(mysql_error());
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa1'")or die(mysql_error());
		$politika = MySQL_Fetch_Array($politika1);

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'")or die(mysql_error());
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'")or die(mysql_error());
		$zriz = MySQL_Fetch_Array($zrizeni1);
	
		if($zaznam1[bran]==0):
			$brany=1;
		else:
			$brany=$zaznam1[bran];
		endif;
		$mmest=$zaznam1["penize"]/($zaznam2[mes_cena]*$politika[cenas]/100);
		$mmest=Floor($mmest);
		$mvyr=$zaznam1["penize"]/($zaznam2[vyr_cena]*($politika[cenas]/100)*($politika[cenat]/100)*($narod[cenav]/100)*($zriz[cenav]/100));
		$mvyr=Floor($mvyr);
		$mkas=$zaznam1["penize"]/($zaznam2[kas_cena]*$bstav);
		$mkas=Floor($mkas);
		$msdi=$zaznam1["penize"]/($zaznam2[sdi_cena]*$bstav*$politika[cenas]/100);
		$msdi=Floor($msdi);
		$mpar=$zaznam1["penize"]/($zaznam2[park_cena]*$bstav*$politika[cenas]/100);
		$mpar=Floor($mpar);
		$mlab=$zaznam1["penize"]/($zaznam2[lab_cena]*$bstav*$politika[cenas]/100);
		$mlab=Floor($mlab);
		$mbra=$zaznam1["penize"]/(($zaznam2[bra_cena]*2*$brany)*$brany*$bstav*$politika[cenas]/100);
		$mbra=Floor($mbra);

		echo "<form name='form' method='post' action='hlavni.php?page=planety&vyber=1' ></form>";
		
		echo "<center><font class=text_bili><font class=text_modry>S</font>tavby</font><br><br>";

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' order by nazev ASC")or die(mysql_error());
      
		echo "<center>";
		echo "<TABLE border='1'>";
		echo "<tr>";
		echo "<th><font class=text_modry>Budova:</font></th>";

		echo "<th>&nbsp;</th>";	
		echo "<th><a href='hlavni.php?page=budovy&vybe=1'>M�sto</font></a></th>";
		echo "<th><a href='hlavni.php?page=budovy&vybe=2'>".$zaznam2["vyr_nazev"]."</font></a></th>";
		echo "<th><a href='hlavni.php?page=budovy&vybe=3'>Obrana</font></a></th>";
		echo "<th><a href='hlavni.php?page=budovy&vybe=4'>Kas�rna</font></a></th>";
		echo "</tr>";	

		echo "<tr>";
		echo "<th><font class=text_modry>Cena:</font></th>";

		echo "<th>&nbsp;</th>";	
		echo "<th><font class=text_bili>".Round($zaznam2["mes_cena"]*$bstav*$politika[cenas]/100)."</font></th>";
		echo "<th><font class=text_bili>".Round($zaznam2["vyr_cena"]*($politika[cenas]/100)*$bstav*($politika[cenat]/100)*($narod[cenav]/100)*($zriz[cenav]/100))."</font></th>";
		echo "<th><font class=text_bili>".Round($zaznam2["sdi_cena"]*$bstav*$politika[cenas]/100)."</font></th>";
		echo "<th><font class=text_bili>".Round($zaznam2["kas_cena"]*$bstav)."</font></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<th><font class=text_modry>M�te na:</font></th>";

		echo "<th>&nbsp;</th>";	
		echo "<th><font class=text_bili>".fcis($mmest)."</font></th>";
		echo "<th><font class=text_bili>".fcis($mvyr)."</font></th>";
		echo "<th><font class=text_bili>".fcis($msdi)."</font></th>";
		echo "<th><font class=text_bili>".fcis($mkas)."</font></th>";	
		echo "</tr>";

		echo "<tr>";
		echo "<th><font class=text_modry>V�b�r:</font></th>";	
		//echo "<th>";
?>	
                <form name='form' method='post' action='hlavni.php?page=planety&vyber=1' ><th>
		<select name='kam'>
<?
			while ($zaznam3 = MySQL_Fetch_Array($vys3)):
				if($kam==$zaznam3["cislo"]):
					$if="selected";
				else:
					$if="";
				endif;
				echo "<option ".$if." value=".$zaznam3[cislo].">".$zaznam3["nazev"];
			endwhile;
?>
    		</select>
<?
echo "</th>";
		echo "<th><input type='text' name='mest' size='5'></th>";
		echo "<th><input type='text' name='vyroben' size='5'></th>";
		echo "<th><input type='text' name='sdi' size='5'></th>";
		echo "<th><input type='text' name='kasaren' size='5'></th>";//";
    echo "</tr>";



		echo "<tr>";
		echo "<th><font class=text_modry>Potvrdit:</font></th>";	

		echo "<th  colspan = 5><input type='submit' value='Postavit' size='5'></th></form>";
    echo "</tr>";
    
    /*		
		echo "<tr>";
		echo "<th colspan='6'>Postavit na ka�dou planetu <input type='text' name='kolkobudov' size = '5'> kr�t budovu&nbsp;<select name='akubudovu'>";
    
    echo "
    <option value='M�sto'>M�sto</option>
    <option value='".$zaznam2['vyr_nazev']."'>".$zaznam2['vyr_nazev']."</option>
    <option value='Obrana'>Obrana</option>
    <option value='Kas�rna'>Kas�rna</option>
    <option value='Laborato�'>Laborato�</option>
    <option value='".$zaznam2['pol_nazev']."'>".$zaznam2['pol_nazev']."</option>
    <option value='".$zaznam2['park_nazev']."'>".$zaznam2['park_nazev']."</option>
    <option value='Br�na'>Br�na</option>
    ";
    
    echo"</select>&nbsp;<input type='submit' value='Postavit'></th>";
		echo "</tr>";
*/
//*****

		echo "<tr>";
		echo "<th><font class=text_modry>Jm�no planety</font></th>";
		echo "<th><font class=text_bili>zastav�no/mo�no</font></th>";

		echo "<th><font class=text_bili>mo�no postavit</font></th>";
		echo "<th><font class=text_bili>mo�no postavit</font></th>";
		echo "<th><font class=text_bili>mo�no postavit</font></th>";
		echo "<th><font class=text_bili>mo�no postavit</font></th>";
		echo "</tr>";	


		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = '$logcislo' ORDER BY nazev ASC")or die(mysql_error());	
		while ($zaznam3 = MySQL_Fetch_Array($vys3)):
			$typp=$zaznam3[typ];
			$plan = MySQL_Query("SELECT * FROM typp where typ = '$typp'")or die(mysql_error());			
			$pla = MySQL_Fetch_Array($plan);

			$w=$zaznam3["lidi"]-$zaznam3["vyrobna"]*$zaznam2["vyr_lidi"];
			$w-=$zaznam3["sdi"]*$zaznam2["sdi_lidi"];
			$w-=$zaznam3["laborator"]*$zaznam2["lab_lidi"];
			$zbyva=($zaznam2["mest"]*$zaznam3["mesta"])-$zaznam3["kasarna"]-$zaznam3["vyrobna"]-$zaznam3["sdi"];
			//echo $zbyva;
			$zbyva=$zbyva-$zaznam3["laborator"]-$zaznam3["par"]-$zaznam3["pol"];
			$je=$zaznam3["kasarna"]+$zaznam3["vyrobna"]+$zaznam3["sdi"]+$zaznam3["par"]+$zaznam3["laborator"]+$zaznam3["pol"];

$nnn2=Floor($w/$zaznam2["vyr_lidi"]);

if($nnn2>$zbyva){$nnn2=$zbyva;}

$nnn3=Floor($w/$zaznam2["sdi_lidi"]);

if($nnn3>$zbyva){$nnn3=$zbyva;}

$nnn4=Floor($w/$zaznam2["lab_lidi"]);

if($nnn4>$zbyva){$nnn4=$zbyva;}

$nnn5=$mkas;

if($nnn5>$zbyva){$nnn5=$zbyva;}

$nnn6=$mpar;

if($nnn6>$zbyva){$nnn6=$zbyva;}

$nnn7=$mbra;

if($nnn7>$zbyva){$nnn7=$zbyva;}


			if($zaznam3[status]==2):
				$mestje=0;//echo "<tr>aa</tr>";
			else:
				$mestje=$pla[mest]-$zaznam3["mesta"];
			endif;
			echo "<tr>";
			echo "<td><center><font class=text_cerveny>".$zaznam3["nazev"]."</font></center></td>";
			echo "<td><center><font class=text_bili>".fcis($je)."/".fcis($zbyva)."</font></center></td>";


                        echo "<td><center><br>"
?>
		        <form name='form' method='post' action='hlavni.php?page=planety&vyber=1'>
                        <input type='hidden' name='mest' value='<?echo Floor($mestje)?>'>
                        <input type='hidden' name='kam' value='<?echo $zaznam3["cislo"]?>'>
		        <input type='submit' value='<?echo "".fcis(Floor($mestje)).""; ?>'>
		        </form>

<?
		      
"</td></center>";

                        echo "<td><center><br>"
?>
		        <form name='form' method='post' action='hlavni.php?page=planety&vyber=1'>
                        <input type='hidden' name='vyroben' value='<?echo Floor($nnn2)?>'>
                        <input type='hidden' name='kam' value='<?echo $zaznam3["cislo"]?>'>
		        <input type='submit' value='<?echo "".fcis(Floor($nnn2)).""; ?>'>
		        </form>

<?
		      
"</td></center>";
                        echo "<td><center><br>"
?>
		        <form name='form' method='post' action='hlavni.php?page=planety&vyber=1'>
                        <input type='hidden' name='sdi' value='<?echo Floor($nnn3)?>'>
                        <input type='hidden' name='kam' value='<?echo $zaznam3["cislo"]?>'>
		        <input type='submit' value='<?echo "".fcis(Floor($nnn3)).""; ?>'>
		        </form>

<?
		      
"</td></center>";





                        echo "<td><center><br>"
?>
		        <form name='form' method='post' action='hlavni.php?page=planety&vyber=1'>
                        <input type='hidden' name='kasaren' value='<?echo Floor($nnn5)?>'>
                        <input type='hidden' name='kam' value='<?echo $zaznam3["cislo"]?>'>
		        <input type='submit' value='<?echo "".fcis(Floor($nnn5)).""; ?>'>
		        </form>

<?
		      
"</td></center>";

	        
			echo "</tr>";
		endwhile;
endif;
		echo "</table>";
