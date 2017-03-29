<?
		$mezi_ovl=1;
		
		$maxhrd = 5;

mysql_query("SET NAMES cp1250");
		require 'data_1.php';	

echo '<script type="text/javascript" src="cotojatka/tooltips.js"></script>';


		function fcislo($a){

		$a=number_format($a,1,"."," ");

		return $a;	

		}
		
		function fcis($a){

		$a=number_format($a,0,""," ");

		return $a;	

		}


		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		$rasa1=$zaznam1[rasa];
		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
		$zaznam2 = MySQL_Fetch_Array($vys2);		
		
		$obch2 = MySQL_Query("SELECT den,navrhovatel,jed1,jed2,jed4,jed3,typ FROM obchod where (navrhovatel='$logjmeno' and typ=0)");
		while($obch = MySQL_Fetch_Array($obch2)):
			$obchod+=$obch[jed1]*$zaznam2[jed1_lidi];
			$obchod+=$obch[jed2]*$zaznam2[jed2_lidi];
			$obchod+=$obch[jed3]*$zaznam2[jed3_lidi];			
			$obchod+=$obch[jed4]*$zaznam2[jed4_lidi];		
		endwhile;
		//echo $obchod;
		//$obchod=0;
		
		$diletace=72;
		if(((Date("U")-$zaznam1[vek])<($diletace*3600)) and $vyber==3){echo "<font color=red size=6>Jednotky lze do rasové armády posílat až po 72 hodinách od registrace.</font>";exit;};
		
		if(isset($jednotek1) and $vyber==3 and $_POST['over_post']==1):
		      do{//echo "xx";
			$jednotek1*=1;
			$jednotek2*=1;
			$jednotek3*=1;
			$jednotek4*=1;
			$jednotek5*=1;
			$jednotek7*=1;
			$jednotek8*=1;
			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa1 = $zaznam1["rasa"] ;
			require("kontrola.php");

			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);

  			$ra2 = MySQL_Query("SELECT * FROM rasarm where rasa=$rasa1");
			$ra = MySQL_Fetch_Array($ra2);

			if(!(is_numeric($jednotek1) and is_numeric($jednotek2) and is_numeric($jednotek3) and is_numeric($jednotek4) and is_numeric($jednotek5) and is_numeric($jednotek7) and is_numeric($jednotek8))){echo "<font class='text_cerveny'>Zadána mohou být jen èísla</font>";break;};
		 	if($jednotek1>$zaznam1[jed1] or $jednotek2>$zaznam1[jed2] or $jednotek3>$zaznam1[jed3] or $jednotek4>$zaznam1[jed4] or $jednotek5>$zaznam1[jed5] or $jednotek7>$zaznam1[jed7] or $jednotek6>$zaznam1[jed6] or $jednotek8>$zaznam1[jed8]){echo "<font class='text_cerveny'>Tolik jenotek nemáte</font>";break;};
			if($jednotek8<0 or $jednotek1<0 or $jednotek2<0 or $jednotek3<0 or $jednotek4<0 or $jednotek5<0 or $jednotek7<0){echo "<font class='text_cerveny'>Èísla nesmmí být záporná</font>";break;};
			if(Is_double($jednotek8) or Is_double($jednotek1) or Is_double($jednotek2) or Is_double($jednotek3) or Is_double($jednotek4) or Is_double($jednotek5) or Is_double($jednotek7)){echo "<font class='text_cerveny'>Èísla nesmí být desetinné</font>";break;};	

			$vys11 = MySQL_Query("SELECT jmeno,posta FROM uzivatele where ((status = 1) and (rasa = $rasa1))");
			$zaznam11 = MySQL_Fetch_Array($vys11);
			$komu=$zaznam11[jmeno];
			$p=$zaznam11["posta2"]+1;
			$dat = Date("U");
			$rasa5=AddSlashes($zaznam2["nazevrasy"]);
			$nazev= " Zpráva rasové armády ";
			$text= $logjmeno." Poslal do rasové armády ";
      		if($jednotek1>0){$text.="$jednotek1 krát $zaznam2[jed1_nazev]";};
      		if($jednotek2>0){$text.=" $jednotek2 krát $zaznam2[jed2_nazev]";};
      		if($jednotek3>0){$text.=" $jednotek3 krát $zaznam2[jed3_nazev]";};
      		if($jednotek4>0){$text.=" $jednotek4 krát $zaznam2[jed4_nazev]";};
      		if($jednotek5>0){$text.=" $jednotek5 krát Nájemný vrah";};
      		if($jednotek7>0){$text.=" $jednotek7 krát $zaznam2[jed7nazev]";};
      		if($jednotek8>0){$text.=" $jednotek8 krát $zaznam2[jed8_nazev]";};
			$od="Správce armády";
    		$jed1=$jednotek1+$ra[jed1];
   			$jed2=$jednotek2+$ra[jed2];
   			$jed3=$jednotek3+$ra[jed3];
    		$jed4=$jednotek4+$ra[jed4];
   			$jed5=$jednotek5+$ra[jed5];
   			$jed7=$jednotek7+$ra[jed7];
   			$jed8=$jednotek8+$ra[jed8];
    		$jedu1=$zaznam1[jed1]-$jednotek1;
    		$jedu2=$zaznam1[jed2]-$jednotek2;
    		$jedu3=$zaznam1[jed3]-$jednotek3;
    		$jedu4=$zaznam1[jed4]-$jednotek4;
    		$jedu5=$zaznam1[jed5]-$jednotek5;
    		$jedu7=$zaznam1[jed7]-$jednotek7;
    		$jedu8=$zaznam1[jed8]-$jednotek8;
    	
//    	$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
//			$zaznam1 = MySQL_Fetch_Array($vys1);
    	$vys51 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
			$zaznam51 = MySQL_Fetch_Array($vys51);
			$vys61 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
			$zaznam61 = MySQL_Fetch_Array($vys61);
			$vys71 = MySQL_Query("SELECT * FROM politika where rasa='$rasa1'");
			$zaznam71 = MySQL_Fetch_Array($vys71);
			
      $sila=($jednotek1*$zaznam2[jed1_utok]*$zaznam61[utok]/100)*($zaznam51[utok]/100)*($zaznam71[utok]/100)+$jednotek1*($zaznam2[jed1_obrana]*$zaznam61[obrana]/100)*($zaznam51[obrana]/100)*($zaznam71[obrana]/100);
			$sila+=($jednotek2*$zaznam2[jed2_utok]*$zaznam61[utok]/100)*($zaznam51[utok]/100)*($zaznam71[utok]/100)+$jednotek2*($zaznam2[jed2_obrana]*$zaznam61[obrana]/100)*($zaznam51[obrana]/100)*($zaznam71[obrana]/100);
			$sila+=($jednotek4*$zaznam2[jed4_utok]*$zaznam61[utok]/100)*($zaznam51[utok]/100)*($zaznam71[utok]/100)+$jednotek4*($zaznam2[jed4_obrana]*$zaznam61[obrana]/100)*($zaznam51[obrana]/100)*($zaznam71[obrana]/100);
			$sila+=($jednotek5*$zold_utok*$zaznam61[utok]/100*($zaznam51[utok]/100))*($zaznam71[utok]/100)+$jednotek5*($zold_obrana*$zaznam61[obrana]/100)*($zaznam51[obrana]/100)*($zaznam71[obrana]/100);
      $silaz=$zaznam1[sila]-$sila;
      
$casted=Date("U");  
$b=(60-($casted-$zaznam1[dora]));

      //if ($zaznam1[dora]+60>Date("U")){echo "<font class='text_cerveny'>Další jednotky do RA je možné poslat až za ".$b."s...</font>";break;}

			$cislo=$jednotek1*$zaznam2[jed1_cena]+$jednotek2*$zaznam2[jed2_cena]+$jednotek3*$zaznam2[jed3_cena]+$jednotek4*$zaznam2[jed4_cena]+$jednotek5*$zold_cena+$jednotek7*$zaznam2[jed7_cena];
			$dat = Date("U");	
 			MySQL_Query("update rasarm set jed1=$jed1,jed2=$jed2,jed3=$jed3,jed4=$jed4,jed5=$jed5,jed7=$jed7 where rasa=$rasa1");			
			
  			$ra2 = MySQL_Query("SELECT * FROM rasarm where rasa=$rasa1");
			$ra = MySQL_Fetch_Array($ra2);
			
			if($ra[jed1]>=$jed1 and $ra[jed2]>=$jed2 and $ra[jed3]>=$jed3 and $ra[jed4]>=$jed4 and $ra[jed5]>=$jed5 and $ra[jed7]>=$jed7):
				MySQL_Query("INSERT INTO ciny (cas,rasa,cin,kdo,status,cislo) VALUES ($dat,$rasa1,7,'$logjmeno','$zaznam1[status]',$cislo)");
   				MySQL_Query("update uzivatele set jed1=$jedu1,jed2=$jedu2,jed3=$jedu3,jed4=$jedu4,jed5=$jedu5,jed7=$jedu7,jed8=$jedu8,sila=$silaz,dora=$dat where cislo=$logcislo");
	      		MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,text,rasa2,stav,nepr,typ,smaz) VALUES ($dat,'$od','$komu','$nazev','$rasa5','$text','$rasa5','1','1','2',',0')");
				MySQL_Query("update uzivatele set posta2 = $p where jmeno = '$komu'");				
			else:
				echo "<font class='text_cerveny'>Pøesun se nezdaøil</font>";
			endif;
      }while(false);
    endif;
		if(isset($jednotek1) and $vyber==1 and $_POST['over_post']==1) {
			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa1 = $zaznam1["rasa"] ;
			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);
			$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = $logcislo");

      		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=10 and mrtev!=1)");
			@$stav = MySQL_Fetch_Array($stavitel2);

		 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ=10");
			$typhs = MySQL_Fetch_Array($typhs2);

			$bstav=1-(($stav[level]*$typhs[ucinek]));

			if($stav[cislomaj]!=$logcislo){$bstav=1;};
			//echo "<font class =text_bili>".$bstav;
			$cislos=$stav[cislo];
	
			$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika = MySQL_Fetch_Array($politika1);

			$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
			$narod = MySQL_Fetch_Array($narod1);

			$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
			$zriz = MySQL_Fetch_Array($zrizeni1);
			
			if($zaznam1[status]==4):
				$a=1.5;
				$prodej_jednotek=0;
			else:
				$a=1;
				$prodej_jednotek=1;
			endif;

			while ($zaznam3 = MySQL_Fetch_Array($vys3)):
		 	 $pkasarna=$pkasarna+$zaznam3["kasarna"];
         		endwhile;
			$cmkasarna=$pkasarna*$zaznam2["kas_lidi"];
			do{
			$cj1=$jednotek1*=1;
			$cj2=$jednotek2*=1;
			$cj3=$jednotek3*=1;
			$cj4=$jednotek4*=1;
			$cj6=$jednotek6*=1;
			$cj7=$jednotek7*=1;
			$cj8=$jednotek8*=1;
			if(Is_double($jednotek1) || Is_double($jednotek2) || Is_double($jednotek3) || Is_double($jednotek4) || Is_double($jednotek6) || Is_double($jednotek7) || Is_double($jednotek8)){echo "<font class='text_cerveny'>Èísla nesmí být desetinné</font>";break;};	

			if($zriz[zhn]==200 and $cj3>0){echo "<font class='text_cerveny'>Se státním zøízením jaké máme nemùžeme stavìt ZHN</font>";break;};	

			if(($jednotek1+$zaznam1["jed1"])<0){$jednotek1=0;$cj1=0;};
			if(($jednotek2+$zaznam1["jed2"])<0){$jednotek2=0;$cj2=0;};
			if(($jednotek3+$zaznam1["jed3"])<0){$jednotek3=0;$cj3=0;};
			if(($jednotek4+$zaznam1["jed4"])<0){$jednotek4=0;$cj4=0;};
			if(($jednotek6+$zaznam1["jed6"])<0){$jednotek6=0;$cj6=0;};
			if(($jednotek7+$zaznam1["jed7"])<0){$jednotek7=0;$cj7=0;};
			if(($jednotek8+$zaznam1["jed8"])<0){$jednotek8=0;$cj8=0;};

			$pj1=$zaznam2["jed1_cena"];
			$pj2=$zaznam2["jed2_cena"];
			$pj3=$zaznam2["jed3_cena"];
			$pj4=$zaznam2["jed4_cena"];
			$pj6=$zaznam2["jed6_cena"];
			$pj7=$zaznam2["jed7_cena"];
			$pj8=$zaznam2["jed8_cena"];
//****
			if($jednotek1<0){$cj1=round($jednotek1*0.5);$pj1*=0.5*$prodej_jednotek;};
			if($jednotek2<0){$cj2=round($jednotek2*0.5);$pj2*=0.5*$prodej_jednotek;};
			if($jednotek3<0){$cj3=round($jednotek3*0.5);$pj3*=0.5*$prodej_jednotek;};
			if($jednotek4<0){$cj4=round($jednotek4*0.5);$pj4*=0.5*$prodej_jednotek;};
			if($jednotek6<0){$cj6=round($jednotek6*0.5);$pj6*=0.5*$prodej_jednotek;};
			if($jednotek7<0){$cj7=round($jednotek7*0.5);$pj7*=0.5*$prodej_jednotek;};
  		if($jednotek8<0){$cj8=round($jednotek8*0.5);$pj8*=0.5*$prodej_jednotek;};
//*****
			$vmkasarna=$cmkasarna;
			$vmkasarna-=$zaznam2["jed1_lidi"]*$zaznam1["jed1"];
			$vmkasarna-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];
			$vmkasarna-=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];
			$vmkasarna-=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];
			$vmkasarna-=$zaznam2["jed6_lidi"]*$zaznam1["jed6"];
			$vmkasarna-=$zaznam2["jed7_lidi"]*$zaznam1["jed7"];
			$vmkasarna-=$zaznam2["jed8_lidi"]*$zaznam1["jed8"];
			$vmkasarna-=$obchod;

			$celkcena+=($pj1*$bstav*$politika[cenaj]/100*$narod[pechota]/100*$zriz[jednotky]/100)*$cj1*$a;
			$celkcena+=($pj2*$bstav*$politika[cenaj]/100*$zriz[jednotky]/100)*($narod[univerzal]/100)*$cj2*$a;
			$celkcena+=($pj3*$bstav*$politika[cenaj]/100*$politika[cena3j]/100*$narod[zhn]/100*$zriz[zhn]/100)*$cj3*$a;//echo $celkcena;
			$celkcena+=($pj4*$bstav*$politika[cenaj]/100*$zriz[jednotky]/100)*$cj4*$a;//echo (($bstav*$politika[cenaj]/100*$zriz[jednotky]/100));
	    $celkcena+=($pj6*$a*$cj6);
	    $celkcena+=($pj7*$a*$cj7);
	    $celkcena+=($pj8*$a*$cj8);

//			$celkovacena=(($pj1*$bstav*$politika[cenaj]/100*$narod[pechota]/100*$zriz[jednotky]/100)*$cj1*$a)+(($pj2*$bstav*$politika[cenaj]/100*$zriz[jednotky]/100)*($narod[univerzal]/100)*$cj2*$a)+(($pj3*$bstav*$politika[cenaj]/100*$politika[cena3j]/100*$narod[zhn]/100*$zriz[zhn]/100)*$cj3*$a)+(($pj4*$bstav*$politika[cenaj]/100*$zriz[jednotky]/100)*$cj4*$a)+($pj6*$a*$cj6)+($pj7*$a*$cj7*$zaznam2[vyr_vyrob])+($pj8*$a*$cj8*$zaznam2[vyr_vyrob]);
			$celkovacena=(($pj1*$bstav*$politika[cenaj]/100*$narod[pechota]/100*$zriz[jednotky]/100)*$cj1*$a)+(($pj2*$bstav*$politika[cenaj]/100*$zriz[jednotky]/100)*($narod[univerzal]/100)*$cj2*$a)+(($pj3*$bstav*$politika[cenaj]/100*$politika[cena3j]/100*$narod[zhn]/100*$zriz[zhn]/100)*$cj3*$a)+(($pj4*$bstav*$politika[cenaj]/100*$zriz[jednotky]/100)*$cj4*$a)+($pj6*$a*$cj6)+($pj7*$a*$cj7*$zaznam2[vyr_vyrob])+($pj8*$a*$cj8*$zaznam2[vyr_vyrob]);
//echo"<font class='text_cerveny'> $pj8*$a*$cj8*$zaznam2[vyr_vyrob]//$celkovacena($celkcena)/$zaznam1[penize]";
	    
			$utok=($zaznam1["jed1"]+$jednotek1)*$zaznam2["jed1_utok"];
			$utok+=($zaznam1["jed2"]+$jednotek2)*$zaznam2["jed2_utok"];
			$utok+=($zaznam1["jed4"]+$jednotek4)*$zaznam2["jed4_utok"];
			$utok+=$zaznam1["jed5"]*$zold_utok;
			$utok*=$politika[utok]/100;
			$utok*=$narod[utok]/100;
			$utok*=$zriz[utok]/100;

			$obrana=($zaznam1["jed1"]+$jednotek1)*$zaznam2["jed1_obrana"];
			$obrana+=($zaznam1["jed2"]+$jednotek2)*$zaznam2["jed2_obrana"];
			$obrana+=($zaznam1["jed4"]+$jednotek4)*$zaznam2["jed4_obrana"];
			$obrana+=$zaznam1["jed5"]*$zold_obrana;
			$obrana*=$politika[obrana]/100;
			$obrana*=$narod[obrana]/100;
			$obrana*=$zriz[obrana]/100;

			$sila=$obrana+$utok;
			MySQL_Query("update uzivatele set sila = $sila where cislo=$logcislo");			
			
			$celkmist=$zaznam2["jed1_lidi"]*$jednotek1;
			$celkmist+=$zaznam2["jed2_lidi"]*$jednotek2;
			$celkmist+=$zaznam2["jed3_lidi"]*$jednotek3;
			$celkmist+=$zaznam2["jed4_lidi"]*$jednotek4;
			$celkmist+=$zaznam2["jed6_lidi"]*$jednotek6;
			$celkmist+=$zaznam2["jed7_lidi"]*$jednotek7;
			$celkmist+=$zaznam2["jed8_lidi"]*$jednotek8;

			$n=$zaznam1["penize"]-$celkovacena;
			if($n<0){$n=0;};
			$njed1=$zaznam1["jed1"]+$jednotek1;
			$njed2=$zaznam1["jed2"]+$jednotek2;
			$njed3=$zaznam1["jed3"]+$jednotek3;
			$njed4=$zaznam1["jed4"]+$jednotek4;
			$njed6=$zaznam1["jed6"]+$jednotek6;
			$njed7=$zaznam1["jed7"]+$jednotek7;
			$njed8=$zaznam1["jed8"]+$jednotek8;

			require("kontrola.php");
			$maxsila=$max_sila;//echo $celkmist;
			
			if(($celkmist<=$vmkasarna)&&($celkovacena<=$zaznam1["penize"])&&($sila<=$maxsila or $zaznam1[admin]==1)&&($jednotek1!=-1)&&($jednotek2!=-1)&&($jednotek3!=-1)&&($jednotek4!=-1)):
				MySQL_Query("update uzivatele set jed1=$njed1,jed2=$njed2,jed3=$njed3,jed4=$njed4,jed6=$njed6,jed7=$njed7,jed8=$njed8,penize=$n,sila=$sila where cislo = $logcislo");
				$zkusn=($celkcena/($zaznam2[mes_cena]*100));
				$zkusn*=@($celkcena/($zaznam1[prijem]/100))/10;
				$zkusn=Floor($zkusn)+$stav[zkus];
				$lv=bcsqrt($zkusn/1000);
				$lv=Floor($lv);
				if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};
				MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislos");
			elseif($celkovacena>$zaznam1["penize"]):
				echo "<font class='text_cerveny'>Máte málo penìz</font>";
			elseif($sila>$maxsila and $zaznam1[admin]!=1):
				echo "<font class='text_cerveny'>Není možné mít více než ".($maxsila/1000000)." milionù síly</font>";				
			elseif($jednotek1==-1 or $jednotek2==-1 or $jednotek3==-1 or $jednotek4==-1 or $jednotek6==-1 or $jednotek7==-1 or $jednotek8==-1):
				echo "<font class='text_cerveny'>Jednu jednotku není možné prodat.</font>";	
			else:
				echo "<font class='text_cerveny'>Máte málo místa v kasárnách</font>";
			endif;
			$vmkasarna=0;
			$pkasarna=0;
			}while(false);
		};

		if(isset($propustit) and $but=="propustit"):
			do{
				$hrdin2 = MySQL_Query("SELECT * FROM hrdinove where cislo = $propustit");
				$hrdin = MySQL_Fetch_Array($hrdin2);

				if($hrdin[cislomaj]!=$logcislo){echo "<font class='text_cerveny'>Tento hrdina není váš.</font>";break;};
				MySQL_Query("delete FROM hrdinove where cislo=$propustit");				
			}while(false);

		endif;

		if(isset($propustit) and $but=="pøejmen."):
			do{
				$jm=HTMLSpecialChars($nname);
				$hrdj2 = MySQL_Query("SELECT cislo,jmeno FROM hrdinove where jmeno='$jm'");
				$hrdj = MySQL_Fetch_Array($hrdj2);

				if($hrdj[cislo]>1000000){echo "<font class='text_cerveny'>Toto jméno už je obsazeno</font>";break;};		

				$hrdin2 = MySQL_Query("SELECT * FROM hrdinove where cislo = $propustit");
				$hrdin = MySQL_Fetch_Array($hrdin2);

				if($hrdin[cislomaj]!=$logcislo){echo "<font class='text_cerveny'>Tento hrdina není váš.</font>";break;};
				MySQL_Query("update hrdinove set jmeno='$jm' where cislo=$propustit");	
			}while(false);
		endif;

		if(isset($propustit) and $but=="oživit"):
			do{
				$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
				$zaznam1 = MySQL_Fetch_Array($vys1);
				$rasa1 = $zaznam1["rasa"] ;
				$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
				$zaznam2 = MySQL_Fetch_Array($vys2);

				$hrdin2 = MySQL_Query("SELECT * FROM hrdinove where cislo = $propustit");
				$hrdin = MySQL_Fetch_Array($hrdin2);

				$zkusn=$hrdin[zkus]*0.8;

				$lv=bcsqrt($hrd[zkusn]/1000);
				$lv=Floor($lv);
				if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};

				$pen=$hrdin[level]*$zaznam2[vyr_vyrob]*150;

				if($hrdin[cislomaj]!=$logcislo){echo "<font class='text_cerveny'>Tento hrdina není váš.</font>";break;};
				if($hrdin[mrtev]!=1){echo "<font class='text_cerveny'>Tento hrdina není mrtev.</font>";break;};
				if($zaznam1[penize]<$pen){echo "<font class='text_cerveny'>Na oživení nemáte dost penìz.</font>";break;};

				$penn=$zaznam1[penize]-$pen;
				//echo $penn;

				MySQL_Query("update uzivatele set penize=$penn where cislo=$logcislo");
				MySQL_Query("update hrdinove set mrtev=0,zkus=$zkusn where cislo=$propustit");
			}while(false);
		endif;
		
		if(isset($propustit) and $but=="zmìò"):
			do{
				$vys1 = MySQL_Query("SELECT jmeno,cislo,status,rasa,heslo FROM uzivatele where cislo=$logcislo");
				$zaznam1 = MySQL_Fetch_Array($vys1);
				$rasa1 = $zaznam1["rasa"];
				$aha=$_POST["$propustit"];//echo $aha;
				$vys11 = MySQL_Query("SELECT jmeno,cislo,rasa FROM uzivatele where jmeno='$aha'");
				$zaznam11 = MySQL_Fetch_Array($vys11);
				
				$hrdin2 = MySQL_Query("SELECT * FROM hrdinove where cislo = '$propustit'");
				$hrdin = MySQL_Fetch_Array($hrdin2);
				
				$jehohrd = MySQL_Query("SELECT cislo,cislomaj,typ FROM hrdinove where cislomaj=$zaznam11[cislo]");
				$pocet=0;
				while($jh = MySQL_Fetch_Array($jehohrd)):
					$pocet++;
					if($hrdin[typ]==$jh[typ]){$spatne=1;break;};
				endwhile;

				if($pocet>4 or $spatne==1){echo "<font class='text_cerveny'>Tento login už má 5 hrdinù nebo hrdinu stejného typu.</font>";break;};
				if($hrdin[rasa]!=$rasa1){echo "<font class='text_cerveny'>Tento hrdina není naší rasy.</font>";break;};
				if($zaznam11[rasa]!=$rasa1){echo "<font class='text_cerveny'>Tento uživatel není z naší rasy.!".$zaznam11[rasa]."x".$rasa1."!</font>";break;};				
				if($zaznam1[status]!=1 and $zaznam1[status]!=5 and $zaznam1[status]!=2){echo "<font class='text_cerveny'>Toto mùže jen vùdce, jeho zástupce a poradci.</font>";break;};
				

				MySQL_Query("update hrdinove set cislomaj=$zaznam11[cislo] where cislo=$propustit");
			}while(false);
		endif;		

		if(isset($poshr) and $_POST['over_post']==1):
		do{
			$pos1*=1;
			$pos2*=1;
			$pos3*=1;
			$pos4*=1;
			$pos5*=1;
			$pos7*=1;
		
			$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			
			
$casted=Date("U");  
$c=(20-($casted-$zaznam1[zra]));

			if ($zaznam1[zra]+20>Date("U")){echo "<font class='text_cerveny'>Další jednotky z RA lze poslat až za ".$c."s...</font>";break;}

			require("kontrola.php");
			$rasa1 = $zaznam1["rasa"] ;
			$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam2 = MySQL_Fetch_Array($vys2);
			$ra2 = MySQL_Query("SELECT * FROM rasarm where rasa=$rasa1");
			$ra = MySQL_Fetch_Array($ra2);
			$vys41 = MySQL_Query("SELECT * FROM uzivatele where jmeno='$poshr'");
			$zaznam41 = MySQL_Fetch_Array($vys41);
			$vys51 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam41[narod]");
			$zaznam51 = MySQL_Fetch_Array($vys51);
			$vys61 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam41[zrizeni]");
			$zaznam61 = MySQL_Fetch_Array($vys61);
			$vys71 = MySQL_Query("SELECT * FROM politika where rasa='$rasa1'");
			$zaznam71 = MySQL_Fetch_Array($vys71);

//			$vys112 = MySQL_Query("SELECT jed7 FROM rasarm where rasa=$rasa1");
//			$zaznam112 = MySQL_Fetch_Array($vys112);


      //************************************kontrola mist v kasarni******************
      
     			$vy = MySQL_Query("SELECT * FROM uzivatele where jmeno='$poshr'");
			$zazna = MySQL_Fetch_Array($vy);
			$logc = $zazna["cislo"];
			$vys111 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logc");
			$zaznam111 = MySQL_Fetch_Array($vys111);
			$rasa1 = $zaznam1["rasa"] ;
			$vys211 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam211 = MySQL_Fetch_Array($vys211);
			$vys311 = MySQL_Query("SELECT * FROM planety where cislomaj = $logc");

      		$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logc and typ=10 and mrtev!=1)");
			@$stav = MySQL_Fetch_Array($stavitel2);

		 	$typhs2 = MySQL_Query("SELECT * FROM typh where typ=10");
			$typhs = MySQL_Fetch_Array($typhs2);

			$bstav=1-(($stav["level"]*$typhs["ucinek"]));

			
			//echo "<font class =text_bili>".$bstav;
			$cislos=$stav["cislo"];
	
			$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika = MySQL_Fetch_Array($politika1);

			$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
			$narod = MySQL_Fetch_Array($narod1);

			$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
			$zriz = MySQL_Fetch_Array($zrizeni1);
			
			if($zaznam111["status"]==4):
				$a=1.5;
				$prodej_jednotek=0;
			else:
				$a=1;
				$prodej_jednotek=1;
			endif;

			while ($zaznam311 = MySQL_Fetch_Array($vys311)):
		 	 $pkasarna=$pkasarna+$zaznam311["kasarna"];
         		endwhile;
			$cmkasarna=$pkasarna*$zaznam211["kas_lidi"];
			do{
			$cj1=$jednotek1*=1;
			$cj2=$jednotek2*=1;
			$cj3=$jednotek3*=1;
			$cj4=$jednotek4*=1;
			$cj6=$jednotek6*=1;
			$cj7=$jednotek7*=1;
			$cj8=$jednotek8*=1;
	

			$pj1=$zaznam2["jed1_cena"];
			$pj2=$zaznam2["jed2_cena"];
			$pj3=$zaznam2["jed3_cena"];
			$pj4=$zaznam2["jed4_cena"];
			$pj6=$zaznam2["jed6_cena"];
			$pj7=$zaznam2["jed7_cena"];
			$pj8=$zaznam2["jed8_cena"];
//****
//*****
			$vmkasarna=$cmkasarna;
			echo $vmkasarna;
			$vmkasarna-=$zaznam2["jed1_lidi"]*$zaznam41["jed1"];
			$vmkasarna-=$zaznam2["jed2_lidi"]*$zaznam41["jed2"];
			$vmkasarna-=$zaznam2["jed3_lidi"]*$zaznam41["jed3"];
			$vmkasarna-=$zaznam2["jed4_lidi"]*$zaznam41["jed4"];
			$vmkasarna-=$zaznam2["jed6_lidi"]*$zaznam41["jed6"];
			$vmkasarna-=$zaznam2["jed7_lidi"]*$zaznam41["jed7"];
			$vmkasarna-=$zaznam2["jed8_lidi"]*$zaznam41["jed8"];
			$vmkasarna-=$obchod;
			}while(false);
			
			//echo $vmkasarna . " kas";
			

    
    $celkpj = ($pos1 * $zaznam2["jed1_lidi"]) + ($pos2 * $zaznam2["jed2_lidi"]) + ($pos3 * $zaznam2["jed3_lidi"]) + ($pos4 * $zaznam2["jed4_lidi"]) + ($pos5 * $zaznam2["jed5_lidi"]);
    	
  
      
      //*******************************************************************************

			if(!(is_numeric($pos1) and is_numeric($pos2) and is_numeric($pos3) and is_numeric($pos4) and is_numeric($pos5) and is_numeric($pos7))){echo "<font class='text_cerveny'>Zadána mohou být jen èísla</font>";break;};			
			if($pos1>$ra[jed1] or $pos2>$ra[jed2] or $pos3>$ra[jed3] or $pos7>$ra[jed7] or $pos4>$ra[jed4] or $pos5>$ra[jed5]){echo "<font class='text_cerveny'>Tolik jednotek v rasové armádì není.</font>";break;};
			if($pos1<0 or $pos2<0 or $pos3<0 or $pos4<0 or $pos5<0 or $pos7<0){echo "<font class ='text_cerveny'>Èísla musí být vìtší jak nula</font>";break;};
			
			if($vmkasarna < $celkpj)
        {
          
          echo "<font class = 'text_cerveny'>" .$poshr. " nemá tolik místa v kasárnách. Zasílané jednotky zabírají ". fcis($celkpj) ." místa, ale ". $poshr ." má jenom " . fcis($vmkasarna) ." volného místa.</font>";
          break;
        };
			
			if(Is_double($pos1) or Is_double($pos2) or Is_double($pos3) or Is_double($pos4) or Is_double($pos5) or Is_double($pos7)){echo "<font class='text_cerveny'>Èísla nesmí být desetinná</font>";break;};
			if($zaznam1[status]!=1 and $zaznam1[status]!=5 and $zaznam1[status]!=5){echo "<font class='text_cerveny'>Toto smí jen vùdce a jeho poradci</font>";break;};
			
			$sila=($pos1*$zaznam2[jed1_utok]*$zaznam61[utok]/100)*($zaznam51[utok]/100)*($zaznam71[utok]/100)+$pos1*($zaznam2[jed1_obrana]*$zaznam61[obrana]/100)*($zaznam51[obrana]/100)*($zaznam71[obrana]/100);
			$sila+=($pos2*$zaznam2[jed2_utok]*$zaznam61[utok]/100)*($zaznam51[utok]/100)*($zaznam71[utok]/100)+$pos2*($zaznam2[jed2_obrana]*$zaznam61[obrana]/100)*($zaznam51[obrana]/100)*($zaznam71[obrana]/100);
			$sila+=($pos4*$zaznam2[jed4_utok]*$zaznam61[utok]/100)*($zaznam51[utok]/100)*($zaznam71[utok]/100)+$pos4*($zaznam2[jed4_obrana]*$zaznam61[obrana]/100)*($zaznam51[obrana]/100)*($zaznam71[obrana]/100);
			$sila+=($pos5*$zold_utok*$zaznam61[utok]/100*($zaznam51[utok]/100))*($zaznam71[utok]/100)+$pos5*($zold_obrana*$zaznam61[obrana]/100)*($zaznam51[obrana]/100)*($zaznam71[obrana]/100);
      $silav=$sila+$zaznam41[sila];
			$i=0;
			$kontrola1 = MySQL_Query("SELECT cislo,jmeno,rasa FROM uzivatele where jmeno = '$poshr'");
			do{
				$i++;	
				if($i>10){break;};
				$dobre=1;
	  			$kontrola=MySQL_Fetch_Array($kontrola1);
				if($poshr==$kontrola[jmeno]){$dobre=0;$cislopos=$kontrola[cislo];};
		  	}while($dobre);

			if($dobre==0 and $rasa1==$kontrola[rasa]):
		  		$hrac2 = MySQL_Query("SELECT * FROM uzivatele where cislo=$cislopos");
		  	 	$hrac = MySQL_Fetch_Array($hrac2);

  				//if(($hrac[sila]+$sila)>$max_sila){echo "<font class='text_cerveny'>Cílový login by mìl sílu vìtší než 150 miliónù</font>";break;};

				$jed1=$hrac[jed1]+$pos1;
				$jed2=$hrac[jed2]+$pos2;
				$jed3=$hrac[jed3]+$pos3;
				$jed4=$hrac[jed4]+$pos4;
				$jed5=$hrac[jed5]+$pos5;
				$jed7=$hrac[jed7]+$pos7;
				$r1=$ra[jed1]-$pos1;
				$r2=$ra[jed2]-$pos2;
				$r3=$ra[jed3]-$pos3;
				$r4=$ra[jed4]-$pos4;
				$r5=$ra[jed5]-$pos5;//echo $rasa1;
				$r7=$ra[jed7]-$pos7;

	  			$ra2 = MySQL_Query("SELECT * FROM rasarm where rasa=$rasa1");
				$ra = MySQL_Fetch_Array($ra2);
				$datum=Date("U");
			
				if($ra[jed1]>=$r1 and $ra[jed2]>=$r2 and $ra[jed3]>=$r3 and $ra[jed4]>=$r4 and $ra[jed5]>=$r5 and $ra[jed7]>=$r7):
					MySQL_Query("update uzivatele set jed1=$jed1,jed2=$jed2,jed3=$jed3,jed4=$jed4,jed5=$jed5,jed7=$jed7,sila=$silav where cislo=$cislopos");
					MySQL_Query("update rasarm set jed1=$r1,jed2=$r2,jed3=$r3,jed4=$r4,jed5=$r5,jed7=$r7 where rasa=$rasa1");
					MySQL_Query("update uzivatele set zra=$datum where cislo=$logcislo");
				
					$odesilatel=$logjmeno;
					$adresat=$poshr;
					$rasa5=AddSlashes($zaznam2["nazevrasy"]);
			                $nazev= " Zpráva rasové armády ";
					$text="Z rasové armády Vám bylo posláno: ";
	      				if($pos1>0){$text.=" $pos1 * $zaznam2[jed1_nazev]";};
	      				if($pos2>0){$text.=" $pos2 * $zaznam2[jed2_nazev]";};
    	  				if($pos3>0){$text.=" $pos3 * $zaznam2[jed3_nazev]";};
      					if($pos4>0){$text.=" $pos4 * $zaznam2[jed4_nazev]";};
	      				if($pos5>0){$text.=" $pos5 * $zold_nazev";};
	      				if($pos7>0){$text.=" $pos7 * $zaznam2[jed7nazev]";};
					$i=0;
					$cislo=$pos1*$zaznam2[jed1_cena]+$pos2*$zaznam2[jed2_cena]+$pos3*$zaznam2[jed3_cena]+$pos4*$zaznam2[jed4_cena]+$pos5*$zold_cena+$pos7*$zaznam2[jed7cena];
					$dat = Date("U");
					MySQL_Query("INSERT INTO ciny (cas,rasa,cin,kdo,status,koho,cislo) VALUES ($dat,$rasa1,5,'$logjmeno','$zaznam1[status]','$adresat',$cislo)");								
					do{
						if($i>30){break;};
						$proved=1;
						$den = Date("U");
						//MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,text,rasa2,stav,nepr,typ,smaz) VALUES ($den,'$odesilatel','$adresat','$nazev','$rasa5','$text','$rasa5','1','1','2','0')");
	
						$kont2 = MySQL_Query("SELECT den,odesilatel FROM posta where den=$den");
						@$kont = MySQL_Fetch_Array($kont2);
						if($kont[odesilatel]==$logjmeno){$proved=0;};
						$i++;
					}while($proved);
					if($proved==0):
						$p=$zaznam9["posta2"]+1;	
						MySQL_Query("update uzivatele set posta2 = $p where jmeno = '$adresat'");
					else:
						echo " ";
					endif;
				else:
					echo "<font class='text_cerveny'>Pøesun se nezdaøil</font>";
				endif;
			else:
				echo "<font class='text_cerveny'>Takový login neexistuje nebo není z naší rasy!</font>";
			endif;
		}while(false);
		endif;
		
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);

		require("kontrola.php");

		$styl="styl".$zaznam1[skin];
		if($zaznam1[skin]==1 or $zaznam1[skin]==2 or $zaznam1[skin]==3 or $zaznam1[skin]==4){$styl="styl1";};
?>





<center><font class='text_bili'>
<br>
<a href="hlavni.php?page=jednotky&vyber=1" id=a onMouseOver=Rozsvitit('a') onMouseOut=Zhasnout('a')>Jednotky</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=jednotky&vyber=2&hhh=1" id=b onMouseOver=Rozsvitit('b') onMouseOut=Zhasnout('b')>Vaši hrdinové</a>
&nbsp;&nbsp;
<a href="hlavni.php?page=jednotky&vyber=4" id=bb onMouseOver=Rozsvitit('bb') onMouseOut=Zhasnout('bb')>Najímání hrdinù</a>
&nbsp;&nbsp;


<?
if($zaznam1[rasa]!=98 and $zaznam1[rasa]!=0 and $zaznam1[rasa]!=97):
	echo "<a href=\"hlavni.php?page=jednotky&vyber=2&hhh=2\" id=ba onMouseOver=Rozsvitit('ba') onMouseOut=Zhasnout('ba')>Národní hrdinové</a>
&nbsp;&nbsp;<a href='hlavni.php?page=jednotky&vyber=3' id=c onMouseOver=Rozsvitit('c') onMouseOut=Zhasnout('c')>Rasová armáda</a>

";
endif;
?>
<br><br>
</center></font>
<?
		$rasa1 = $zaznam1["rasa"] ;

		$ra2 = MySQL_Query("SELECT * FROM rasarm where rasa=$rasa1");
		$ra = MySQL_Fetch_Array($ra2);

		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
		$politika = MySQL_Fetch_Array($politika1);

    	$stavitel2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=10 and mrtev!=1)");
		@$stav = MySQL_Fetch_Array($stavitel2);

		$typhs2 = MySQL_Query("SELECT * FROM typh where typ=10");
		$typhs = MySQL_Fetch_Array($typhs2);

		$bstav=1-($stav[level]*$typhs[ucinek]);

		if($stav[cislomaj]!=$logcislo){$bstav=1;};
		$cislos=$stav[cislo];

		$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
		$narod = MySQL_Fetch_Array($narod1);

		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
		$zriz = MySQL_Fetch_Array($zrizeni1);

		$tex = MySQL_Query("SELECT * FROM texty where rasa = $rasa1");
		$text = MySQL_Fetch_Array($tex);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
		$zaznam2 = MySQL_Fetch_Array($vys2);

		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = $logcislo");	

		if($zaznam1[status]==4):
			$a=1.5;
		else:
			$a=1;
		endif;

	if(empty($vyber)){$vyber=1;};
//*******************************************************rasarmy******************************
	if($vyber==3):

    echo "<center><font class='text_bili'><font class=text_modry>N</font>árodní armáda</font>";

    if($ra["jed1"] >= 0 AND $ra["jed1"] <= 90) { $jednotek1 = "Družstvo"; }
    if($ra["jed1"] > 90 AND $ra["jed1"]<= 900) { $jednotek1 = "Èeta"; }
    if($ra["jed1"] > 900 AND $ra["jed1"]<= 9000) { $jednotek1 = "Rota"; }
    if($ra["jed1"] > 9000 AND $ra["jed1"]<= 90000) { $jednotek1 = "Prapor"; }
    if($ra["jed1"] > 90000 AND $ra["jed1"]<= 900000) { $jednotek1 = "Pluk"; }
    if($ra["jed1"] > 900000 AND $ra["jed1"]<= 9000000) { $jednotek1 = "Brigáda"; }
    if($ra["jed1"] > 9000000 AND $ra["jed1"]<= 90000000) { $jednotek1 = "Divize"; }
    if($ra["jed1"] > 90000000 AND $ra["jed1"]<= 900000000) { $jednotek1 = "Armáda"; }
    if($ra["jed1"] > 900000000) { $jednotek1 = "Nìkolik armád"; }

    if($ra["jed2"] >= 0 AND $ra["jed2"] <= 90) { $jednotek2 = "Družstvo"; }
    if($ra["jed2"] > 90 AND $ra["jed2"]<= 900) { $jednotek2 = "Èeta"; }
    if($ra["jed2"] > 900 AND $ra["jed2"]<= 9000) { $jednotek2 = "Rota"; }
    if($ra["jed2"] > 9000 AND $ra["jed2"]<= 90000) { $jednotek2 = "Prapor"; }
    if($ra["jed2"] > 90000 AND $ra["jed2"]<= 900000) { $jednotek2 = "Pluk"; }
    if($ra["jed2"] > 900000 AND $ra["jed2"]<= 9000000) { $jednotek2 = "Brigáda"; }
    if($ra["jed2"] > 9000000 AND $ra["jed2"]<= 90000000) { $jednotek2 = "Divize"; }
    if($ra["jed2"] > 90000000 AND $ra["jed2"]<= 900000000) { $jednotek2 = "Armáda"; }
    if($ra["jed2"] > 900000000) { $jednotek2 = "Nìkolik armád"; }
    
    if($ra["jed3"] >= 0 AND $ra["jed3"] <= 9) { $jednotek3 = "Družstvo"; }
    if($ra["jed3"] > 9 AND $ra["jed3"]<= 90) { $jednotek3 = "Èeta"; }
    if($ra["jed3"] > 90 AND $ra["jed3"]<= 900) { $jednotek3 = "Rota"; }
    if($ra["jed3"] > 900 AND $ra["jed3"]<= 9000) { $jednotek3 = "Prapor"; }
    if($ra["jed3"] > 9000 AND $ra["jed3"]<= 90000) { $jednotek3 = "Pluk"; }
    if($ra["jed3"] > 90000 AND $ra["jed3"]<= 900000) { $jednotek3 = "Brigáda"; }
    if($ra["jed3"] > 900000 AND $ra["jed3"]<= 9000000) { $jednotek3 = "Divize"; }
    if($ra["jed3"] > 9000000 AND $ra["jed3"]<= 90000000) { $jednotek3 = "Armáda"; }
    if($ra["jed3"] > 90000000) { $jednotek3 = "Nìkolik armád"; }
    
    if($ra["jed4"] >= 0 AND $ra["jed4"] <= 9) { $jednotek4 = "Družstvo"; }
    if($ra["jed4"] > 9 AND $ra["jed4"]<= 90) { $jednotek4 = "Èeta"; }
    if($ra["jed4"] > 90 AND $ra["jed4"]<= 900) { $jednotek4 = "Rota"; }
    if($ra["jed4"] > 900 AND $ra["jed4"]<= 9000) { $jednotek4 = "Prapor"; }
    if($ra["jed4"] > 9000 AND $ra["jed4"]<= 90000) { $jednotek4 = "Pluk"; }
    if($ra["jed4"] > 90000 AND $ra["jed4"]<= 900000) { $jednotek4 = "Brigáda"; }
    if($ra["jed4"] > 900000 AND $ra["jed4"]<= 9000000) { $jednotek4 = "Divize"; }
    if($ra["jed4"] > 9000000 AND $ra["jed4"]<= 90000000) { $jednotek4 = "Armáda"; }
    if($ra["jed4"] > 90000000) { $jednotek4 = "Nìkolik armád"; }
    
    if($ra["jed5"] >= 0 AND $ra["jed5"] <= 9) { $jednotek5 = "Družstvo"; }
    if($ra["jed5"] > 9 AND $ra["jed5"]<= 90) { $jednotek5 = "Èeta"; }
    if($ra["jed5"] > 90 AND $ra["jed5"]<= 900) { $jednotek5 = "Rota"; }
    if($ra["jed5"] > 900 AND $ra["jed5"]<= 9000) { $jednotek5 = "Prapor"; }
    if($ra["jed5"] > 9000 AND $ra["jed5"]<= 90000) { $jednotek5 = "Pluk"; }
    if($ra["jed5"] > 90000 AND $ra["jed5"]<= 900000) { $jednotek5 = "Brigáda"; }
    if($ra["jed5"] > 900000 AND $ra["jed5"]<= 9000000) { $jednotek5 = "Divize"; }
    if($ra["jed5"] > 9000000 AND $ra["jed5"]<= 90000000) { $jednotek5 = "Armáda"; }
    if($ra["jed5"] > 90000000) { $jednotek5 = "Nìkolik armád"; }

   	$putok=$zaznam1["jed1"]*$zaznam2["jed1_utok"];
		$uutok=$zaznam1["jed2"]*$zaznam2["jed2_utok"];
		$uutok+=$zaznam1["jed7"]*$zaznam2["jed7_utok"];
		$outok=$zaznam1["jed4"]*$zaznam2["jed4_utok"];
		$zutok=$zaznam1["jed5"]*$zold_utok;


		    
		$bonusut=1*$politika[utok]/100;
		$bonusut*=$narod[utok]/100;
		$bonusut*=$zriz[utok]/100;

		$utok=($putok+$uutok+$outok+$zutok)*$bonusut;
		$pozutok=($putok+$uutok+$zutok+$outok/2)*$bonusut;
		$orbutok=($uutok/2+$outok)*$bonusut;
		$parutok=($putok+$zutok)*$bonusut;

		$pobrana=$zaznam1["jed1"]*$zaznam2["jed1_obrana"];
		$uobrana=$zaznam1["jed2"]*$zaznam2["jed2_obrana"];
		$uobrana+=$zaznam1["jed7"]*$zaznam2["jed7_obrana"];
		$oobrana=$zaznam1["jed4"]*$zaznam2["jed4_obrana"];
		$zobrana=$zaznam1["jed5"]*$zold_obrana;

		$bonusob=1*$politika[obrana]/100;
		$bonusob*=$narod[obrana]/100;
		$bonusob*=$zriz[obrana]/100;

		$obrana=($pobrana+$uobrana+$oobrana+$zobrana)*$bonusob;
		$pozobrana=($pobrana+$uobrana+$zobrana)*$bonusob;
		$orbobrana=($oobrana)*$bonusob;
		$parobrana=($pobrana+$zobrana)*$bonusob;

		$sila=$obrana+$utok;

    echo "<center><font class=text_cerveny>Vaše síla: ".number_format($sila,0,0," ")."</font><center><br>";


    if($zaznam1[status]==1 or $zaznam1[status]==5){echo "<form name='form' method='post' action='hlavni.php?page=jednotky'>";};

    echo "<TABLE border='1'>";
		echo "<tr>";
		echo "<th><font class=text_modry>Název</font></th>";
		echo "<th><font class=text_modry>Útok/obrana</font></th>";
		echo "<th><font class=text_modry>Je v armádì</font></th>";
		if($zaznam1[status]==1 or $zaznam1[status]==5 OR $zaznam1["status"]==2){echo "<th>Poslat hráèi</th>";};

		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$zaznam2["jed1_nazev"]."</td>";

		echo "<td><font class=text_bili>".($zaznam2["jed1_utok"]*$politika[utok]/100)."/".($zaznam2["jed1_obrana"]*$politika[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>";
    if($zaznam1["status"]==1 OR $zaznam1["status"]==2 OR $zaznam1["status"]==5){
      echo fcis($ra["jed1"]);
    } else {
      echo $jednotek1;
    }
    echo "</font></td>";
		if($zaznam1[status]==1 or $zaznam1[status]==5 OR $zaznam1["status"]==2){echo "<td><input type=text name=pos1 size=8></td>";};

		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$zaznam2["jed2_nazev"]."</td>";

		echo "<td><font class=text_bili>".($zaznam2["jed2_utok"]*$politika[utok]/100)."/".($zaznam2["jed2_obrana"]*$politika[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>";
    if($zaznam1["status"]==1 OR $zaznam1["status"]==2 OR $zaznam1["status"]==5){
      echo fcis($ra["jed2"]);
    } else {
      echo $jednotek2;
    }
    echo "</font></td>";
		if($zaznam1[status]==1 or $zaznam1[status]==5 OR $zaznam1["status"]==2){echo "<td><input type=text name=pos2 size=8></td>";};

		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$zaznam2["jed4_nazev"]."</td>";

		echo "<td><font class=text_bili>".($zaznam2["jed4_utok"]*$politika[utok]/100)."/".($zaznam2["jed4_obrana"]*$politika[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>";
    if($zaznam1["status"]==1 OR $zaznam1["status"]==2 OR $zaznam1["status"]==5){
      echo fcis($ra["jed4"]);
    } else {
      echo $jednotek4;
    }
    echo "</font></td>";
		if($zaznam1[status]==1 or $zaznam1[status]==5 OR $zaznam1["status"]==2){echo "<td><input type=text name=pos4 size=8></td>";};

		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$zaznam2["jed3_nazev"]."</td>";

		echo "<td><font class=text_bili>".$zaznam2["jed3_ucinek"]."</font></td>";
		echo "<td><font class=text_bili>";
    if($zaznam1["status"]==1 OR $zaznam1["status"]==2 OR $zaznam1["status"]==5){
      echo fcis($ra["jed3"]);
    } else {
      echo $jednotek3;
    }
    echo "</font></td>";
		if($zaznam1[status]==1 or $zaznam1[status]==5 OR $zaznam1["status"]==2){echo "<td><input type=text name=pos3 size=8></td>";};

		echo "</tr>";
		echo "<tr>";
		echo "<td class=text_modry>".$zold_nazev."</td>";

		echo "<td><font class=text_bili>".($zold_utok*$politika[utok]/100)."/".($zold_obrana*$politika[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>";
    if($zaznam1["status"]==1 OR $zaznam1["status"]==2 OR $zaznam1["status"]==5){
      echo fcis($ra["jed5"]);
    } else {
      echo $jednotek5;
    }
    echo "</font></td>";
		if($zaznam1[status]==1 or $zaznam1[status]==5 OR $zaznam1["status"]==2){echo "<td><input type=text name=pos5 size=8></td>";};



		echo "</tr>";
		echo "</table>";
		echo "<input type='hidden' name='over_post' value='1'>";
	if($zaznam1[status]==1 or $zaznam1[status]==5 OR $zaznam1["status"]==2):
		echo "<font class=text_bili>poslat hráèi </font><input type=text name=poshr size=20><input type = 'submit' value='poslat'>";
		echo "<input type='hidden' name='vyber' value=3></form>";
	endif;
	
    echo "<br><br><center><font class='text_bili'><font class=text_modry>P</font>oslat do rasové armády</font><br><br>";

    echo "<form name='formdora' method='post' action='hlavni.php?page=jednotky'>";
  	echo "<TABLE border='1'>";
		echo "<tr>";
		echo "<th><font class=text_modry>Název jednotky</font></th>";
		echo "<th><font class=text_modry>Útok/obrana</font></th>";
		echo "<th><font class=text_modry>Máte</font></th>";
		echo "<th><font class=text_modry>Poslat do RA</font></th>";
		echo "<th></th>";
		echo "</tr>";

		echo "<tr>";
		echo "<td class=text_modry>".$zaznam2["jed1_nazev"]."</td>";

		echo "<td><font class=text_bili>".fcislo($zaznam2["jed1_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".fcislo($zaznam2["jed1_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed1"])."</font></font></td>";
		echo "<td><input type='text' name='jednotek1' size=10></td>";
		echo "<td><input type='button' onclick='document.formdora.jednotek1.value = $zaznam1[jed1]' value=vše></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td class=text_modry>".$zaznam2["jed2_nazev"]."</td>";

		echo "<td><font class=text_bili>".fcislo($zaznam2["jed2_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".fcislo($zaznam2["jed2_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed2"])."</font></td>";

		echo "<td><input type='text' name='jednotek2' size=10></td>";
				echo "<td><input type='button' onclick='document.formdora.jednotek2.value = $zaznam1[jed2]' value=vše></td>";
		echo "</tr>";


		echo "<tr>";
		echo "<td class=text_modry>".$zaznam2["jed4_nazev"]."</td>";

		echo "<td><font class=text_bili>".fcislo($zaznam2["jed4_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".fcislo($zaznam2["jed4_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed4"])."</font></td>";
		echo "<td><input type='text' name='jednotek4' size=10></td>";
				echo "<td><input type='button' onclick='document.formdora.jednotek4.value = $zaznam1[jed4]' value=vše></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td class=text_modry>".$zaznam2["jed3_nazev"]."</td>";

		echo "<td><font class=text_bili>".$zaznam2["jed3_ucinek"]."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed3"])."</font></td>";
		echo "<td><input type='text' name='jednotek3' size=10></td>";
				echo "<td><input type='button' onclick='document.formdora.jednotek3.value = $zaznam1[jed3]' value=vše></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td class=text_modry>".$zold_nazev."</td>";

		echo "<td><font class=text_bili>".fcislo($zold_utok*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".fcislo($zold_obrana*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed5"])."</font></td>";
		echo "<td><input type='text' name='jednotek5' size=10></td>";
				echo "<td><input type='button' onclick='document.formdora.jednotek5.value = $zaznam1[jed5]' value=vše></td>";
		echo "</tr>";

    echo "</table>";

		echo "<br><br><input type='hidden' name='vyber' value=3><input type='hidden' name='over_post' value='1'><input type='submit' value='poslat'>";
		echo "</form>";		

//****************************************************hrdinové************************************	
	elseif($vyber==2):
		$typy2 = MySQL_Query("SELECT * FROM typh");
		$i=1;
		while($typy = MySQL_Fetch_Array($typy2)):
			$tnazev[$i]=$typy[nazev];
			$tpopis[$i]=$typy[popis];
			$tucinek[$i]=$typy[ucinek];
			$i++;
		endwhile;
		$maxi=$i;

		if($hhh==2):
			echo "<center><font class='text_bili'><font class=text_modry>S</font>eznam národních hrdinù</font><br><br>";	


	
			$hrd2 = MySQL_Query("SELECT cislo,text,rasa FROM hrdinove where rasa=$rasa1");
			$poslsloupec="majitel";
			$celk=mysql_num_rows($hrd2);
			echo "			
			<script language='JavaScript'>
			var data = new Array($celk);";
			$p=0;
			while($hrd = MySQL_Fetch_Array($hrd2)):
				$p++;
				$s=$hrd[text];//$s="a";
				echo "data[$p]=\"$s\";";
			endwhile;
			echo "
			function objev(co){
				x=event.x;
				y=event.y;
				a='textak';
				document.all.item('tt').style.top=y+10;
				document.all.item('tt').style.left=x+10;
				document.all.item('tt').style.display='block';
				document.all.item('tt').innerText=data[co];
			}

			function zmiz(){
				a='textak';
				document.all.item('tt').style.display='none';
				}
			</script>
			";		
			$hrd2 = MySQL_Query("SELECT * FROM hrdinove where rasa=$rasa1");	
		else:
			echo "<center><font class='text_bili'><font class=text_modry>S</font>eznam vašich hrdinù</font><br><br>";		
			$hrd2 = MySQL_Query("SELECT * FROM hrdinove where cislomaj=$logcislo");		
			


                        echo "<font class=text_bili>Zde je seznam Vašich hrdinù. Pokud váš hrdina zemøe mùžete ho oživit, toto oživení stojí poèet levelù hrdiny krát ".number_format(($zaznam2[vyr_vyrob]*150),0,0," ")." , hrdina pøijde o 20% zkušeností. Hrdina mùže zemøít maximálnì 5 krát, pak už oživit nelze. Maximálne múžete mít " . $maxhrd . " hrdinù.</font><br><br></center>";						
			$poslsloupec="&nbsp;";			
		endif;		
		echo "<center><TABLE border='1' width=100% font-color=white>";
		echo "<tr>";
		if($hhh==2){echo "<th><font class=text_modry>obr</font></th>";};
		echo "<th><font class=text_modry>Jméno</font></th>";
		echo "<th><font class=text_modry>Vìk</font></th>";
		echo "<th><font class=text_modry>Typ</font></th>";
		if($hhh==1){echo "<th><font class=text_modry>Vlastnost na této úrovni</font></th>";};
		echo "<th><font class=text_modry>Úroveò</font></th>";
		echo "<th><font class=text_modry>Zkušeností (do další úr.)</font></th>";
		echo "<th><font class=text_modry>Status (celkem zabit)</font></th>";
		echo "<th><font class=text_modry>$poslsloupec</font></th>";
		echo "</tr>";
		$aa=0;		
		//echo "<font class=text_bili>$hhh";
		while($hrd = MySQL_Fetch_Array($hrd2)):
			$vek=Date("U")-$hrd[zivot];
			$rok=Floor($vek/(3600*24*12));
			$mes=$vek-$rok*(3600*24*12);
			if($rok<25){$colorv="green";}
			elseif($rok<35){$colorv="yellow";}
			else{$colorv="red";}

			$stath="živý";$colort="green";
			if($hrd[mrtev]==1){$stath="mrtev";$colort="red";};
			if($hrd[smrt]>5 and $hrd[status]==0){MySQL_Query("delete from hrdinove where cislo=$hrd[cislo]");$stath="navždy mrtev";echo "<font class='text_cerveny'>Hrdina ".$hrd[jmeno]." nás navždy opustil, odpoèívej v pokoji.</font>";};
			$lv=bcsqrt($hrd[zkus]/1000);
			$lv=Floor($lv);
			if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};
			MySQL_Query("update hrdinove set level=$lv where cislo=$hrd[cislo]");
			$dalsi=number_format(((($lv+1)*($lv+1)*1000)-$hrd[zkus]),0,0," ");
			if($lv>=20){$dalsi="max level";};
			echo "<tr>";
			echo "<form name='form' method='post' action='hlavni.php?page=jednotky'>";
			if($hhh==2){$aa++;echo "<td><img src='hrdinove/".$hrd[obr]."' onMouseOver='objev($aa)' onMouseOut='zmiz()' onMouseMove='objev($aa)'></td>";};
			if($hrd[status]==1):
				$cislomaj=$hrd[cislomaj];
				$vys33 = MySQL_Query("SELECT jmeno,rasa FROM uzivatele where cislo=$cislomaj");
				$zaznam33 = MySQL_Fetch_Array($vys33);
				$majitel=$zaznam33[jmeno];
				echo "<td class=text_modry>$hrd[jmeno]</td>";
			else:
				echo "<td class=text_modry><input type=text value=".$hrd[jmeno]." size='20' name='nname'></td>";
			endif;
		  	echo "<td><font color=".$colorv.">".$rok."</font></td>";
		  	echo "<td><font class=text_bili>".$tnazev[$hrd[typ]]."</font></td>";
		  	if($hhh==1){echo "<td><font class=text_bili>".($tucinek[$hrd[typ]]*$hrd[level]*100)."% ".$tpopis[$hrd[typ]]."</font></td>";};
		  	echo "<td><font class=text_bili>".$lv."</td>";
		  	echo "<td><font class=text_bili>".number_format($hrd[zkus],0,0," ")." (".$dalsi.")</font></td>";
		  	echo "<td><font color=".$colort.">".$stath."</font><font class=text_bili> (".$hrd[smrt]." krát)</font></td>";
			if($hrd[status]!=1):
				echo "<td><input type='submit' name=but value='pøejmen.'>";			
				echo "<input type='submit' name=but value='propustit'>";
			elseif($hhh==1):
				echo "<td class=text_modry>národní hrdina";
			elseif($zaznam1[status]==1 or $zaznam1[status]==5 and $hhh==2):
				echo "<td class=text_modry><input type=text value='$majitel' name='$hrd[cislo]' size=15>";
				echo "<input type='submit' name=but value='zmìò'>";				
			else:
				echo "<td class=text_modry>$majitel";
			endif;
			if($stath=="mrtev"){echo "<input type='submit' name=but value='oživit'>";};
			if($hhh==1){echo "<input type=hidden name=hhh value=1>";}
			else{echo "<input type=hidden name=hhh value=2>";}
			echo	"<input type='hidden' name='propustit' value=".$hrd[cislo].">
				<input type='hidden' name='vyber' value='2'>
			      </td>";
			echo "</form></tr>";
			$pochr++;
		endwhile;

		echo "</table></center>";
		echo "<span class='text_bili' id='tt'></span>";

		echo "<br><br><center><font class=text_bili><font class=text_modry>S</font>eznam typù hrdinù</font></center><br><br>";

		echo "<center><TABLE border='1'>";
		echo "<tr>";
		echo "<th><font class=text_modry>Název</font></th>";
		echo "<th><font class=text_modry>Vlastnost</font></th>";
		echo "<th><font class=text_modry>Úèinost na 1. úrovni</font></th>";
		echo "</tr>";

		$i=1;
		while($i<$maxi):
			echo "<tr>";
			echo "<td><font class=text_modry>".$tnazev[$i]."</font></td>";
			echo "<td><font class=text_bili>".$tpopis[$i]."</font></td>";
			echo "<td><font class=text_bili>".($tucinek[$i]*100)." %</font></td>";
			echo "</tr>";
			$i++;
		endwhile;
		echo "</table></center>";


//****************************************************Nové************************************	
	elseif($vyber==4):

	$vys1 = MySQL_Query("SELECT jmeno,heslo,penize,cislo,heslo2,skin,koho,rasa FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);

  $rasahrace=$zaznam1[rasa];

  $vys2 = MySQL_Query("SELECT rasa,vyr_vyrob,hrdcen FROM rasy where rasa = '$rasahrace'");	
	$zaznam2 = MySQL_Fetch_Array($vys2);
	
 $celkpenez=(($zaznam2["vyr_vyrob"]) * 1000) + 100000;
	    if ($zaznam1["penize"]<$celkpenez){echo "<center><font class='text_bili'><font class=text_modry>N</font>ajímání hrdinù</font><br><br><font class='text_cerveny'>Nemáte dostatek naquadahu. Pro najmutí hrdiny potøebujete ".fcis($celkpenez)." naq.</h1></center>";die;};
       
       	
	if(isset($hjmeno) and $_POST['over_post']==1):
		$hhr2 = MySQL_Query("select cislo,hrdinove from servis where cislo=1");
		$hhr = MySQL_Fetch_Array($hhr2);			
		$hrdinove=$hhr[hrdinove];
		$text=addslashes($text);
		$den = Date("U");
		$vek=Date("U")-(3600*24*20*12);
		//echo $hrdinove;
		
		$npez=$zaznam1["penize"]-$celkpenez;
		MySQL_Query("insert into hrdinove (cislo,cislomaj,zivot,status,rasa,text,obr,jmeno,typ,level,zkus) values 
										('$hrdinove',$logcislo,'$vek',0,'$hrasa','$text','$hobr','$hjmeno','$htyp',10,100000)");
	  MySQL_Query("update uzivatele set penize='$npez' where cislo='$logcislo'");

  	 $vys21 = MySQL_Query("SELECT nazev FROM typh where typ = '$htyp'");	
	   $zaznam21 = MySQL_Fetch_Array($vys21);	
   	 $vys22 = MySQL_Query("SELECT nazevrasy FROM rasy where rasa = '$hrasa'");	
	   $zaznam22 = MySQL_Fetch_Array($vys22);	

				
		$hrdinove+=1;
		MySQL_Query("update servis set hrdinove='$hrdinove' where cislo=1");
  endif;

?>
<center>
<br>



<font class='text_bili'><font class=text_modry>N</font>ajímání hrdinù</font>
<form name='form6' method='post' action='hlavni.php?page=jednotky&vyber=4'>
<center><? echo "<center><font class=text_bili>Cena jednoho hrdiny je ".fcis($celkpenez)." naq.</font></center>"; ?><br>

<?
$hrd2 = MySQL_Query("SELECT * FROM hrdinove where cislomaj=$logcislo");	
while($hrd = MySQL_Fetch_Array($hrd2)):
  $pochr++;
endwhile;

if ($pochr >= $maxhrd)
{
  echo "<font class='text_cerveny'>Máte " . $maxhrd . " hrdinù. Pokud chcete najmout nové, musíte nekteré propustit.</font>";
}
else
{
  echo "<input type='text' name=\"hjmeno\" size=20 value=jmeno>";
	$vys4 = MySQL_Query("SELECT cislo,jmeno,rasa FROM uzivatele where rasa != 11");
	while ($zaznam4 = MySQL_Fetch_Array($vys4)):
		
	endwhile;
  echo "</select>
  <font class='text_bili'>typ</font> 
  <select name='htyp'>";
	$vys4 = MySQL_Query("SELECT typ,nazev FROM typh");
	while ($zaznam4 = MySQL_Fetch_Array($vys4)):
		echo "<option value = ".$zaznam4[typ].">".$zaznam4["nazev"];
	endwhile;

echo "
</select>
<input type='hidden' name='over_post' value=1><input type='submit' value='vytvoø'></form>
";}
?><br><br><br>

<center><font class='text_bili'><font class=text_modry>S</font>eznam typù hrdinù</font></center><br><br>

<center>
<TABLE border='1'>
<tr><th><font class=text_modry>Název</font></th>
<th><font class=text_modry>Vlastnost</font></th>
<th><font class=text_modry>Úèinost na 1. úrovni</font></th>
</tr>

<tr><td class=text_modry>dobyvatel</font></td>
<td><font class='text_bili'>zvýšení útoku</font></td>
<td><font class='text_bili'>0.5 %</font></td>
</tr>

<tr><td class=text_modry>obránce</font></td>
<td><font class='text_bili'>zvýšení obrany</font></td>
<td><font class='text_bili'>0.5 %</font></td>
</tr>

<tr><td class=text_modry>nièitel</font></td>
<td><font class='text_bili'>zvýšení poètu ZHN</font></td>
<td><font class='text_bili'>0.5 %</font></td>
</tr>

<tr><td class=text_modry>ekonom</font></td>
<td><font class='text_bili'>zvýšení produkce</font></td>
<td><font class='text_bili'>1 %</font></td>
</tr>

<tr><td class=text_modry>vìdec</font></td>
<td><font class='text_bili'>zvýšení výzkumu</font></td>
<td><font class='text_bili'>1 %</font></td>
</tr>

<tr><td class=text_modry>medik</font></td>
<td><font class='text_bili'>snížení ztrát</font></td>
<td><font class='text_bili'>0.5 %</font></td>
</tr>

<tr><td class=text_modry>vrah</font></td>
<td><font class='text_bili'>zabití hrdiny</font></td>
<td><font class='text_bili'>1 %</font></td>
</tr>

<tr><td class=text_modry>stavitel</font></td>
<td><font class='text_bili'>snížená cena budov</font></td>
<td><font class='text_bili'>1 %</font></td></tr>

<tr><td class=text_modry>kolonizátor</font></td>
<td><font class='text_bili'>snížená cena planety</font></td>
<td><font class='text_bili'>1.5 %</font></td></tr>

<tr><td class=text_modry>verb</font></td>
<td><font class='text_bili'>snížená cena jednotek</font></td>
<td><font class='text_bili'>0.5 %</font></td>
</tr>

</table></center>


<?

//****************************************norml jednotky*******************************************
elseif($vyber==1):
?>
<font class='text_bili'><font class='text_modry'>J</font>ednotky</font><br><br>

<font class='text_bili'>Zde mùžete kupovat jednotky. Staèí, když si postavíte urèitý poèet kasáren a mùžete kupovat jednotky. Staèí jen mít dost naquadahu. Jednotky zde mùžete rovnìž prodávat. Prodejem jednotky dostanete zpìt pouze 25% ceny jednotky (je možné propustit pouze dvì a více jednotek najednou).
</font>
<?	

		
		$putok=$zaznam1["jed1"]*$zaznam2["jed1_utok"];
		$uutok=$zaznam1["jed2"]*$zaznam2["jed2_utok"];
		$outok=$zaznam1["jed4"]*$zaznam2["jed4_utok"];
		$zutok=$zaznam1["jed5"]*$zold_utok;
		    
		$bonusut=1*$politika[utok]/100;
		$bonusut*=$narod[utok]/100;
		$bonusut*=$zriz[utok]/100;

		$utok=($putok+$uutok+$outok+$zutok)*$bonusut;
		$pozutok=($putok+$uutok+$zutok+$outok/2)*$bonusut;
		$orbutok=($uutok/2+$outok)*$bonusut;
		$parutok=($putok+$zutok)*$bonusut;

		$pobrana=$zaznam1["jed1"]*$zaznam2["jed1_obrana"];
		$uobrana=$zaznam1["jed2"]*$zaznam2["jed2_obrana"];
		$oobrana=$zaznam1["jed4"]*$zaznam2["jed4_obrana"];
		$zobrana=$zaznam1["jed5"]*$zold_obrana;

		$bonusob=1*$politika[obrana]/100;
		$bonusob*=$narod[obrana]/100;
		$bonusob*=$zriz[obrana]/100;

		$obrana=($pobrana+$uobrana+$oobrana+$zobrana)*$bonusob;
		$pozobrana=($pobrana+$uobrana+$zobrana)*$bonusob;
		$orbobrana=($oobrana)*$bonusob;
		$parobrana=($pobrana+$zobrana)*$bonusob;

		$sila=$obrana+$utok;
				
		while ($zaznam3 = MySQL_Fetch_Array($vys3)):
		  $pkasarna=$pkasarna+$zaznam3["kasarna"];
        endwhile;
		$cmkasarna=$pkasarna*$zaznam2["kas_lidi"];
		$vmkasarna=$cmkasarna;
		$vmkasarna-=$zaznam2["jed1_lidi"]*$zaznam1["jed1"];
		$vmkasarna-=$zaznam2["jed2_lidi"]*$zaznam1["jed2"];
		$vmkasarna-=$zaznam2["jed3_lidi"]*$zaznam1["jed3"];
		$vmkasarna-=$zaznam2["jed4_lidi"]*$zaznam1["jed4"];
		$vmkasarna-=$zaznam2["jed6_lidi"]*$zaznam1["jed6"];
		$vmkasarna-=$zaznam2["jed7_lidi"]*$zaznam1["jed7"];
		$vmkasarna-=$zaznam2["jed8_lidi"]*$zaznam1["jed8"];
		$vmkasarna-=$obchod;
		$omkasarna=$zaznam2["jed1_lidi"]*$zaznam1["jed1"]+$zaznam2["jed2_lidi"]*$zaznam1["jed2"]+$zaznam2["jed3_lidi"]*$zaznam1["jed3"]+$zaznam2["jed4_lidi"]*$zaznam1["jed4"]+$zaznam2["jed6_lidi"]*$zaznam1["jed6"]+$zaznam2["jed7_lidi"]*$zaznam1["jed7"]+$zaznam2["jed8_lidi"]*$zaznam1["jed8"]+$obchod;

		if($vmkasarna<0):
			echo"<font class='text_cerveny'>Máte pøíliš mnoho jednotek a pro nìkteré již není místo v kasárnách! Pokud nìkteré jednotky neprodáte nebo nepostavíte více kasáren, tak èást jednotek zemøe.</font>";
			$vmkasarna=0;
		endif;

		$c1=$zaznam2["jed1_cena"]*$a*$bstav*$politika[cenaj]/100*$narod[pechota]/100*$zriz[jednotky]/100;
		$mjed1=$zaznam1["penize"]/$c1;
		$mjed1=Floor($mjed1);
		if($mjed1>($vmkasarna/$zaznam2["jed1_lidi"])):
			$mjed1=Floor($vmkasarna/$zaznam2["jed1_lidi"]);
		endif;

		$c2=$zaznam2["jed2_cena"]*$bstav*$a*$politika[cenaj]/100*$zriz[jednotky]/100*$narod[univerzal]/100;
		$mjed2=$zaznam1["penize"]/$c2;
		$mjed2=Floor($mjed2);
		if($mjed2>@($vmkasarna/$zaznam2["jed2_lidi"])):
			$mjed2=Floor($vmkasarna/$zaznam2["jed2_lidi"]);
		endif;

		$c3=$zaznam2["jed3_cena"]*$bstav*$a*$politika[cenaj]/100*$politika[cena3j]/100;
		$c3*=@($narod[zhn]/100*$zriz[zhn]/100);
		$mjed3=$zaznam1["penize"]/$c3;
		$mjed3=Floor($mjed3);
		if($mjed3>($vmkasarna/$zaznam2["jed3_lidi"])):
			$mjed3=Floor(@($vmkasarna/$zaznam2["jed3_lidi"]));
		endif;
		
		$c4=$zaznam2["jed4_cena"]*$bstav*$a*$politika[cenaj]/100*$zriz[jednotky]/100;//echo $bstav*$politika[cenaj]/100*$zriz[jednotky]/100;
		$mjed4=$zaznam1["penize"]/$c4;
		$mjed4=Floor($mjed4);
		if($mjed4>($vmkasarna/$zaznam2["jed4_lidi"])):
			$mjed4=Floor(@($vmkasarna/$zaznam2["jed4_lidi"]));
		endif;
		
		$c6=$zaznam2["jed6_cena"];
		$c6*=1;
		$mjed6=@($zaznam1["penize"]/$c6);
		$mjed6=Floor($mjed6);
		if($mjed6>@($vmkasarna/$zaznam2["jed6_lidi"])):
			$mjed6=Floor(@($vmkasarna/$zaznam2["jed6_lidi"]));
		endif;

		$c7=$zaznam2["jed7_cena"]*$zaznam2[vyr_vyrob];
		$c7*=1;
		$mjed7=@($zaznam1["penize"]/$c7);
		$mjed7=Floor($mjed7);

		$c8=$zaznam2["jed8_cena"]*$zaznam2[vyr_vyrob];
		$c8*=1;
		$mjed8=@($zaznam1["penize"]/$c8);
		$mjed8=Floor($mjed8);


		echo "<left><br><br><form name='formjed' method='post' action='hlavni.php?page=jednotky'>";
		echo "<font class='text_bili'>Vaše celková síla je <font  class=text_cerveny>".number_format($sila,0,0," ")."</font> z toho útok <font  class=text_cerveny>".number_format($utok,0,0," ")."</font> a obrana <font  class=text_cerveny>".number_format($obrana,0,0," ")."</font><br>";
		echo "<font class='text_bili'>Vaše pozemní síla je <font  class=text_cerveny>".number_format(($pozutok+$pozobrana),0,0," ")."</font> z toho útok <font  class=text_cerveny>".number_format($pozutok,0,0," ")."</font> a obrana <font  class=text_cerveny>".number_format($pozobrana,0,0," ")."</font><br>";
		echo "<font class='text_bili'>Vaše orbitální síla je <font  class=text_cerveny>".number_format(($orbutok+$orbobrana),0,0," ")."</font> z toho útok <font  class=text_cerveny>".number_format($orbutok,0,0," ")."</font> a obrana <font  class=text_cerveny>".number_format($orbobrana,0,0," ")."</font><br>";
		echo "<font class='text_bili'>Vaše partizánská síla je <font  class=text_cerveny>".number_format(($parutok+$parobrana),0,0," ")."</font> z toho útok <font  class=text_cerveny>".number_format($parutok,0,0," ")."</font> a obrana <font  class=text_cerveny>".number_format($parobrana,0,0," ")."</font><br><br>";


		$size="size = 10";
		

		echo "Celkem místa v kasárnách: <font  class=text_cerveny>".number_format($cmkasarna,0,0," ")."</font><br>";
		echo "Celkem kasáren: <font  class=text_cerveny>".number_format($pkasarna,0,0," ")."</font><br>";
		echo "Obsazeno míst v kasárnách: <font  class=text_cerveny>".number_format($omkasarna,0,0," ")."</font><br>";
		echo "Volných míst v kasárnách: <font  class=text_cerveny>".number_format($vmkasarna,0,0," ")."</font><br><br></left>";


		echo "<TABLE border='1'>";
		echo "<tr>";
		echo "<th><font class=text_modry>Název</font></th>";
		echo "<th><font class=text_modry>Útok/obrana</font></th>";
		echo "<th><font class=text_modry>Míst v kasárnách</font></th>";
		echo "<th><font class=text_modry>Cena</font></th>";
		echo "<th><font class=text_modry>Máte</font></th>";
		echo "<th><font class=text_modry>Mùžete</font></th>";
		echo "<th><font class=text_modry>Chcete</font></th>";
		echo "<th>&nbsp;</th>";		
		echo "</tr>";

		echo "<tr onClick=\"zmena('jed1')\">";
		echo "<td><p><a href='hlavni.php?page=jednotkys&vybe=1' title='<strong>Pìší jednotka</strong> ".$zaznam2["jed1_nazev"]."<br /><br /><em>Kliknutím zobrazíte více informací</em> '>".$zaznam2["jed1_nazev"]."</a></p></td>";

		echo "<td><font class=text_bili>".fcislo($zaznam2["jed1_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".fcislo($zaznam2["jed1_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>".$zaznam2["jed1_lidi"]."</font></td>";
		echo "<td><font class=text_bili>".number_format(($zaznam2["jed1_cena"]*$a*$bstav*$politika[cenaj]/100*$narod[pechota]/100*$zriz[jednotky]/100),1,"."," ")."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed1"])."</font></td>";
		echo "<td><font class=text_bili><span id='1'>".fcis($mjed1)."</span></font></td>";
    echo "<input type=hidden name='hj1' value='".$mjed1."'>";
     
		echo "<td><input type='text'  ".$size." name='jednotek1'></td>";
		echo "<td><input type='button' onclick=\"document.forms['formjed'].jednotek1.value = $mjed1\" value=\"vše\"></td>";
		echo "</tr>";


		echo "<tr onClick=\"zmena('jed2')\">";
		echo "<td><a href='hlavni.php?page=jednotkys&vybe=2' title='<strong>Universální jednotka</strong> ".$zaznam2["jed2_nazev"]."<br /><br /><em>Kliknutím zobrazíte více informací</em> '>".$zaznam2["jed2_nazev"]."</a></td>";

		echo "<td><font class=text_bili>".fcislo($zaznam2["jed2_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".fcislo($zaznam2["jed2_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>".$zaznam2["jed2_lidi"]."</font></td>";
		echo "<td><font class=text_bili>".number_format(($zaznam2["jed2_cena"]*$bstav*$a*$politika[cenaj]/100*$zriz[jednotky]/100*$narod[univerzal]/100),1,"."," ")."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed2"])."</font></td>";
		echo "<td><font class=text_bili><span id='2'>".fcis($mjed2)."</span></font></td>";
    echo "<input type=hidden name='hj2' value='".$mjed2."'>";
    
		echo "<td><input type='text'  ".$size." name='jednotek2'></td>";
		echo "<td><input type='button' onclick=\"document.forms['formjed'].jednotek2.value = $mjed2\" value=vše></td>";
		echo "</tr>";


		echo "<tr onClick=\"zmena('jed4')\">";
		echo "<td><a href='hlavni.php?page=jednotkys&vybe=4' title='<strong>Orbitální jednotka</strong> ".$zaznam2["jed4_nazev"]."<br /><br /><em>Kliknutím zobrazíte více informací</em> '>".$zaznam2["jed4_nazev"]."</a></td>";

		echo "<td><font class=text_bili>".fcislo($zaznam2["jed4_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".fcislo($zaznam2["jed4_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>".$zaznam2["jed4_lidi"]."</font></td>";
		echo "<td><font class=text_bili>".number_format(($zaznam2["jed4_cena"]*$bstav*$a*$politika[cenaj]/100*$zriz[jednotky]/100),1,"."," ")."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed4"])."</font></td>";
		echo "<td><font class=text_bili><span id='4'>".fcis($mjed4)."</span></font></td>";
     echo "<input type=hidden name='hj4' value='".$mjed4."'>";
     
		echo "<td><input type='text'  ".$size." name='jednotek4'></td>";
		echo "<td><input type='button' onclick=\"document.forms['formjed'].jednotek4.value = $mjed4\" value=vše></td>";
		echo "</tr>";

		echo "<tr onClick=\"zmena('jed3')\">";
		echo "<td><a href='hlavni.php?page=jednotkys&vybe=3'>".$zaznam2["jed3_nazev"]."</a></td>";

		echo "<td><font class=text_bili>".$zaznam2["jed3_ucinek"]."</font></td>";
		echo "<td><font class=text_bili>".$zaznam2["jed3_lidi"]."</font></td>";
		if ($zriz[zhn]!=200):
    echo "<td><font class=text_bili>".number_format(($zaznam2["jed3_cena"]*$a*$bstav*$politika[cenaj]/100*$politika[cena3j]/100*$zriz[zhn]/100*$narod[zhn]/100),1,"."," ")."</font></td>";
    else:
    echo "<td><font class=text_bili>Nelze kupovat ZHN</font></td>";
    endif;
		echo "<td>".fcis($zaznam1["jed3"])."</td>";
		if ($zriz[zhn]!=200):
		echo "<td><font class=text_bili><span id='3'>".fcis($mjed3)."</span></font></td>";
		echo "<input type=hidden name='hj3' value='".$mjed3."'>";
    else:
    echo "<td><font class=text_bili>Nelze kupovat ZHN</font></td>";
    endif;

		if ($zriz[zhn]!=200):
		echo "<td><input type='text'  ".$size." name='jednotek3'></td>";
    else:
    echo "<td><font class=text_bili>Nelze kupovat ZHN</font></td>";
    endif;
		if ($zriz[zhn]!=200):
		echo "<td><input type='button' onclick=\"document.forms['formjed'].jednotek3.value = $mjed3\" value=vše></td>";
    else:
    echo "<td>&nbsp</td>";
    endif;
		echo "</tr>";



		echo "<tr onClick=\"zmena('jed5')\">";
		echo "<td><a href='hlavni.php?page=jednotkys&vybe=5'>".$zold_nazev."</a></td>";

		echo "<td><font class=text_bili>".fcislo($zold_utok*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".fcislo($zold_obrana*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</font></td>";
		echo "<td><font class=text_bili>".$zold_mist."</font></td>";
		echo "<td><font class=text_bili>není k dispozici</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed5"])."</font></td>";
		echo "<td><font class=text_bili>0</font></td>";
		echo "<td><font class=text_bili>Lze kupovat jen v obchodì</font></td>";
		echo "<td>&nbsp;</td>";
		echo "</tr>";


		
		echo "<tr onClick=\"zmena('jed6')\">";
		echo "<td><a href='hlavni.php?page=jednotkys&vybe=6'>".$zaznam2["jed6_nazev"]."</a></td>";

		echo "<td><font class=text_bili>".$zaznam2["jed6_ucinek"]."</font></td>";
		echo "<td><font class=text_bili>".$zaznam2["jed6_lidi"]."</font></td>";
		echo "<td><font class=text_bili>".number_format(($zaznam2["jed6_cena"]),1,"."," ")."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed6"])."</font></td>";
		echo "<td><font class=text_bili><span id='6'>".fcis($mjed6)."</span></font></td>";
    echo "<input type=hidden name='hj6' value='".$mjed6."'>";

		echo "<td><input type='text'  ".$size." name='jednotek6'></td>";
		//echo "<td>&nbsp;</td>";
		echo "<td><input type='button' onclick=\"document.forms['formjed'].jednotek6.value = $mjed6\" value=vše></td>";
		echo "</tr>";


		
		echo "<tr onClick=\"zmena('jed7')\">";
		echo "<td><a href='hlavni.php?page=jednotkys&vybe=7'>".$zaznam2["jed7_nazev"]."</a></td>";

		echo "<td><font class=text_bili>".$zaznam2["jed7_ucinek"]."</font></td>";
		echo "<td><font class=text_bili>".$zaznam2["jed7_lidi"]."</font></td>";
		echo "<td><font class=text_bili>".number_format(($c7),1,"."," ")."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed7"])."</font></td>";
		echo "<td><font class=text_bili><span id='7'>".fcis($mjed7)."</span></font></td>";
    echo "<input type=hidden name='hj7' value='".$mjed7."'>";

		echo "<td><input type='text'  ".$size." name='jednotek7'></td>";
		//echo "<td>&nbsp;</td>";
		echo "<td><input type='button' onclick=\"document.forms['formjed'].jednotek7.value = $mjed7\" value=vše></td>";
		echo "</tr>";



		echo "<tr onClick=\"zmena('jed8')\">";
		echo "<td><a href='hlavni.php?page=jednotkys&vybe=8'>".$zaznam2["jed8_nazev"]."</a></td>";

		echo "<td><font class=text_bili>".$zaznam2["jed8_ucinek"]."</font></td>";
		echo "<td><font class=text_bili>".$zaznam2["jed8_lidi"]."</font></td>";
		echo "<td><font class=text_bili>".number_format(($c8),1,"."," ")."</font></td>";
		echo "<td><font class=text_bili>".fcis($zaznam1["jed8"])."</font></td>";
		echo "<td><font class=text_bili><span id='8'>".fcis($mjed8)."</span></font></td>";
    echo "<input type=hidden name='hj8' value='".$mjed8."'>";
  
		echo "<td><input type='text'  ".$size." name='jednotek8'></td>";
		//echo "<td>&nbsp;</td>";
		echo "<td><input type='button' onclick=\"document.forms['formjed'].jednotek8.value = $mjed8\" value=vše></td>";
		echo "</tr>";

		echo "</table>";

		echo "<br><center><input type='hidden' name='vyber' value=1><input type='hidden' name='over_post' value=1><input type = 'submit' value='vyzbrojit'>";
		echo "</form>";

		MySQL_Query("update uzivatele set sila = $sila where cislo=$logcislo");	
	endif;	

	


//MySQL_Close($spojeni);

?>

