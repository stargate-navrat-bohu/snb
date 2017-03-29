<?
mysql_query("SET NAMES cp1250");

// kontrola cislic :)

$jednot1 = $_POST["jednot1"];
$jednot2 = $_POST["jednot2"];
$jednot3 = $_POST["jednot3"];
$jednot4 = $_POST["jednot4"];
$jednot5 = $_POST["jednot5"];
$jednot6 = $_POST["jednot6"];


$chybaaa = 0;
for($b = 1; $b<=5; $b++){
  //echo $b." ";
  $jednotaaa[$b] =  $_POST["jednot$b"];
  if(ereg("^[0-9]{0,}$", $jednotaaa[$b])){
    //echo $jednotaaa[$b]." OK";
  } else {
    //echo $jednotaaa[$b]." NEE";
    $chybaaa = 1;
  }
  //echo "<br />";
}

if($chybaaa == 1){
echo "Chyba byla opravena tento bug jiû vÌckr·t nezkouöejte <br />";
break;
die;
}


//<?

$utoc11=$utocnik;
$obran11=$obrance;
$typage=$typ;
//$konpar - konstanta na p¯evod partiz·n˘
$konpar=10000;
//$jakej=3;
if(isset($jakej) and $jakej==0 and isset($naco)):
  echo "<body onLoad='outok()'>";
elseif(isset($jakej) and $jakej==1 and isset($naco)):
  echo "<body onLoad='sutok();'>";
elseif(isset($jakej) and $jakej==2 and isset($naco)):
  echo "<body onLoad='pautok();'>";
else:
  echo "<body>";
endif;

//echo "<h6>".$jakej;
		$mezi_ovl=1;	
//		@$spojeni = MySQL_Connect("mysql.....","uz.jmeno","uz.heslo..");
		require 'data_1.php';	

		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		
		$rasahrace=$zaznam1[rasa];


		require("kontrola.php");

?>

<center>
<a href='hlavni.php?page=utok' >⁄tok</a>
&nbsp;&nbsp;
<a href='hlavni.php?page=sutok'>Vaöe vojenskÈ aktivity</a>
&nbsp;&nbsp;
<?
?>


<?
//</script>
if($zaznam1[gold]==1 or $zaznam1[silver]==1){

$zhn_m=10;
$dobyl_m=7;
$part_m=10;
$uni_m=7;
$orb_m=7;
$age_m=7;
$lid_m=7;
$pol_m=7;
}
else{
$zhn_m=10;
$dobyl_m=5;
$part_m=10;
$uni_m=5;
$orb_m=5;
$age_m=5;
$lid_m=5;
$pol_m=5;
}


		$zastaveno2 = MySQL_Query("SELECT cislo,zutok FROM servis where cislo=1");	
		$zastaveno = MySQL_Fetch_Array($zastaveno2);	
		
		if($zastaveno[zutok]!=""){echo "<center><h6>$zastaveno[zutok]</h6></center>";exit;};
		
		if((Date("U")-$zaznam1[vek])<259200){echo "<font class='text_cerveny'>Vy jeötÏ nesmÌte ˙toËit. Nejste tu jeötÏ ani 72 hodin.</font>";exit;}

                $rasa1 = $zaznam1["rasa"];
		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
		$zaznam2 = MySQL_Fetch_Array($vys2);
		$vys3 = MySQL_Query("SELECT * FROM planety where majitel = '$logjmeno' order by nazev");
		$politika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
		$politika = MySQL_Fetch_Array($politika1);
		$narod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam1[narod]");
		$narod = MySQL_Fetch_Array($narod1);
		$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam1[zrizeni]");
		$zriz = MySQL_Fetch_Array($zrizeni1);
		$vztah = MySQL_Query("SELECT * FROM vztahy where rasa = '$rasa1'");
		$vztahy = MySQL_Fetch_Array($vztah);
		$cpdb2 = MySQL_Query("SELECT * FROM cp where rasa = '$rasa1'");
		$cpdb = MySQL_Fetch_Array($cpdb2);		
		$ex1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele");

		$xz=$zhn_m-$zaznam1["dobyl_zhn"];
		$xd=$dobyl_m-$zaznam1["dobyl"];
		$xp=$part_m-$zaznam1["dobyl_part"];
		$xu=$uni_m-$zaznam1["dobyl_uni"];
		$xo=$orb_m-$zaznam1["dobyl_orb"];
		$xa=$age_m-$zaznam1["dobyl_age"];
		$xl=$lid_m-$zaznam1["dobyl_lid"];
		$xpl=$pol_m-$zaznam1["dobyl_pol"];
		
		while($ex = MySQL_Fetch_Array($ex1)):
        	if($ex[jmeno]==$cil){$exis=1;break;};
    	endwhile;

    	if(isset($cil) and $exis==1):
  	  		$kontrola1 = MySQL_Query("SELECT cislo,jmeno,planety,populace FROM uzivatele where jmeno = '$cil'");
  	  		do{
		    	$dobre=1;
  		  		$kontrola=MySQL_Fetch_Array($kontrola1);
		    	if($cil==$kontrola[jmeno]){$dobre=0;$cislocil=$kontrola[cislo];};
//		    	if(($kontrola[populace]*$kontrola[planety])*5<$zaznam1[planety]*$zaznam1[populace]){echo "<font class='text_cerveny'><center>NajdÏte si rovnocenÏjöÌho protivnÌka!</font>";exit;}
  	  		}while($dobre);

	   		$vys4 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislocil");
		  	$zaznam4 = MySQL_Fetch_Array($vys4);
		  	$rasa2 = $zaznam4["rasa"];
		  	$jpolitika1 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
		  	$jpolitika = MySQL_Fetch_Array($jpolitika1);
		  	$jnarod1 = MySQL_Query("SELECT * FROM narody where cislo=$zaznam4[narod]");
		  	$jnarod = MySQL_Fetch_Array($jnarod1);
		  	$jzrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo=$zaznam4[narod]");
		  	$jzriz = MySQL_Fetch_Array($jzrizeni1);
    		$vys22 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
	     	$zaznam22 = MySQL_Fetch_Array($vys22);
//	    	if($zaznam22[uzi]*$zaznam22[rozlehlost]*3<$zaznam2[uzi]*$zaznam2[rozlehlost] and $zaznam22[rasa]!=14){echo "<font class='text_cerveny'><center>NesmÌte ˙toËit na rasu kter· m· mnohem menöÌ rozlehlost neû naöe rasa!</font>";exit;};

    	elseif(isset($cil) and $exis==0):
      		echo "<font class='text_cerveny'>NeexistujÌcÌ uûivatel...</font>";exit;
    	else:
      		echo " ";
    	endif;
		
		switch ($rasa2){
			case 1: $pis="a";
				break;
			case 2: $pis="b";
				break;
			case 3: $pis="c";
				break;
			case 4: $pis="d";
				break;
			case 5: $pis="e";
				break;
			case 6: $pis="f";
				break;				
			case 7: $pis="g";
				break;	
			case 8: $pis="h";
				break;	
  			case 9: $pis="i";
				break;	
  			case 10: $pis="j";
				break;	
			}
		switch ($vztahy[$pis]){
			case "1": $bonus=0;$spatne=1;$cov=" pakt";break;
			case "2": $bonus=0;$spatne=1;$cov=" ne˙toËenÌ";break;
			case "3": $bonus=-0.40;$cov="mÌr";$znm=" 40% snÌûenÌ ˙toku"; break;
			case "4": $bonus=0;$cov="neutralitu";$znm=" norm·lnÌ ˙tok";break;
			case "5": $bonus=0.05;$cov="v·lku";$znm=" 5% zv˝öenÌ ˙toku";break;
      	default: $bonus=0;$cov="neutralita";$znm=" norm·lnÌ ˙tok.";break;
		}

		if($spatne==1):
			echo "<font class='text_cerveny'>NesmÌte ˙toËit na rasu, s kterou m·te pakt nebo mÌr...</font>";
			exit;
		endif;
		
		if(isset($cil)):
 	       if($zaznam4[planety]<=9):
		        $max=1;
		   else:
        		$max=Round($zaznam4[planety]/10);
		    endif;



	  		$jetocp=0;
			$jetodp=0;
			if($zaznam4["planety"]<2 or $zaznam4["dobyt"]>=$max):
				$dbjetocp2 = MySQL_Query("SELECT cislo,status FROM planety where cislomaj = $cislocil");
				while ($dbjetocp = mysql_fetch_array($dbjetocp2)) {
				  if($dbjetocp[status]==2){$jetocp=1;};
				  if($dbjetocp[status]==3){$jetodp=1;};
			    }
			endif;

			//upraveno and $zaznam1[rasa]!=98
			if($politika[status]==1 and $jpolitika[status]==1 and $zaznam1[rasa]!=98){echo "<font class='text_cerveny'>Naöe rasa i rasa na kterou chcete ˙toËit jsou dobrÈ rasy a dobrÈ rasy na sebe ne˙toËÌ. To se prostÏ nedÏl·...</font>";exit;}
			if((Date("U")-$zaznam4[vek])<259200){echo "<font class='text_cerveny'>Tento nep¯Ìtel je jeötÏ pod ochranou. NenÌ tu jeötÏ ani 72 hodin...</font>";exit;}
			if($zaznam4==""){echo "<font class='text_cerveny'>Tento nep¯Ìtel neexistuje...</font>";exit;}
			if($zaznam4["rasa"]==$zaznam1["rasa"] and $zaznam1[rasa]!=98){echo "<font class='text_ceveny'>Nelze ˙toËit na vlastnÌ rasu!</font>";exit;}
			if($zaznam4["planety"]<2 and $jetocp==0 and $jetodp==0){echo "<font class='text_cerveny'>N·ö nep¯Ìtel m· mÈnÏ neû dvÏ planety...</font>";exit;}
			if($zaznam4["dobyt"]>=$max and $zaznam4[rasa]!=11 and $zaznam4[rasa]!=98 and $jetodp==0 and $jakej==0){echo "<font class='text_cerveny'>N·ö protivnÌk byl dnes jiû p¯ipraven o maximum planet...</font>";exit;}
			echo "<h6> K hr·Ëi ".$cil." m·me vztah ".$cov." a to znamen· ".$znm."<br />";
			if($zaznam1["dobyl"]>=$dobyl_m and $jakej==0){echo "<font class='text_cerveny'>Dnes uû jsme dobyli maxim·lnÌ poËet planet...</font>";exit;}
			if($zaznam1["dobyl_part"]>=$part_m and $jakej==2){echo "<font class='text_cerveny'>Dnes uû jsme vyplenili maxim·lnÌ poËet planet...</font>";exit;}
			if($zaznam1["dobyl_zhn"]>=$zhn_m and $jakej==1){echo "<font class='text_cerveny'>Dnes jsme jiû odp·lili maximum ZHN...</font>";exit;}			
			if($zaznam1["dobyl_uni"]>=$uni_m and $jakej==3){echo "<font class='text_cerveny'>Dnes uû jsme pomocÌ univerz·lnÌch jednotek za˙zoËili na maximum planet...</font>";exit;}
			if($zaznam1["dobyl_orb"]>=$orb_m and $jakej==4){echo "<font class='text_cerveny'>Dnes uû jsme pomocÌ orbit·lnÌch jednotek za˙zoËili na maximum planet...</font>";exit;}
			if($zaznam1["dobyl_pol"]>=$pol_m and $jakej==5){echo "<font class='text_cerveny'>Dnes uû jsme uskuteËnili maxim·lnÌ poËet kr·deûÌ...</font>";exit;}
			if($zaznam1["dobyl_age"]>=$age_m and $jakej==7){echo "<font class='text_cerveny'>Dnes uû jsme vyslali maxim·lnÌ poËet zvÏd˘...</font>";exit;}
			if($zaznam1["dobyl_lid"]>=$lid_m and $jakej==8){echo "<font class='text_cerveny'>Dnes uû jsme vyslali maxim·lnÌ poËet agit·tor˘...</font>";exit;}
$castedc=Date("U");  
$bcv=(30-($castedc-$zaznam1[poslutok]));

			if (($zaznam1[poslutok]+30>Date("U")) and ($jakej==0 or $jakej==1 or $jakej==2 or $jakej==3 or $jakej==4 or $jakej==5 or $jakej==7 or $jakej==8)){echo "<font class='text_cerveny'>DalöÌ ˙tok m˘ûeme uskuteËnit aû za ".$bcv."s...</font>";exit;}
		endif;

		if(isset($naco)):
			if ($_POST['over_post']!=1) {exit;}
			$i=0;


$castedc=Date("U");  
$bcv=(30-($castedc-$zaznam1[poslutok]));

			if ($zaznam1[poslutok]+30>Date("U")){echo "<font class='text_cerveny'>DalöÌ ˙tok m˘ûeme uskuteËnit aû za ".$bcv."s...</font>";exit;}

      $cisloplan=$naco;
			$vysp = MySQL_Query("SELECT cislo,status,cislomaj FROM planety where cislo=$cisloplan");
			$zaznamp = MySQL_Fetch_Array($vysp);
			if($zaznamp[status]==1):
				echo "<font class='text_cerveny'>NenÌ moûnÈ ˙toËit na domovskou planetu...</font>";
				exit;
			endif;
			if($zaznamp[status]==2 and $jakej!=0):
				echo "<font class='text_cerveny'>NenÌ moûnÈ ˙toËit partyz·nsky ani nekonvenËnÏ na CP!</font>";
				exit;
			endif;
			if($zaznamp[status]==2 and $cpdb[dobyto]>0):
				echo "<font class='text_cerveny'>N·öe rasa uû dnes dobyla maximum CP...</font>";
				exit;
			endif;
			if($zaznamp[cislomaj]!=$cislocil):
				echo "<font class='text_cerveny'>Planeta, na kterou se pokouöÌme ˙toËit, nepat¯Ì naöemu cÌli...</font>";
				exit;
			endif;			
		endif;
//echo "bklaa";
		if(isset($naco)):
//*********************************************hrdinovÈ - zaË·tek********************************************
    //**medikovÈ
		 	$typhm2 = MySQL_Query("SELECT * FROM typh where typ=6");
			$typhm = MySQL_Fetch_Array($typhm2);

 			$mediku2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=6 and mrtev!=1)");
			@$medu = MySQL_Fetch_Array($mediku2);
			$bmedu=($medu[level]*$typhm[ucinek]);
			if($medu[cislomaj]!=$logcislo){$bmedu=0;};
			//echo "<font class =text_bili>".$bmedu;
			$cislomu=$medu[cislo];

 			$mediko2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$cislocil and typ=6 and mrtev!=1)");
			@$medo = MySQL_Fetch_Array($mediko2);
			$bmedo=($medo[level]*$typhm[ucinek]);
			if($medo[cislomaj]!=$cislocil){$bmedo=0;};
			//echo "<font class =text_bili>".$bmedo;
			$cislomo=$medo[cislo];

    		//**dobyvatel
		 	$typhd2 = MySQL_Query("SELECT * FROM typh where typ=1");
			$typhd = MySQL_Fetch_Array($typhd2);

 			$dob2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=1 and mrtev!=1)");
			@$dob = MySQL_Fetch_Array($dob2);
			$bdob=($dob[level]*$typhd[ucinek]);
			if($dob[cislomaj]!=$logcislo){$bdob=0;};
			//echo "<font class =text_bili>".$bdob;
			$cislod=$dob[cislo];

    		//**obr·nce
		 	$typho2 = MySQL_Query("SELECT * FROM typh where typ=2");
			$typho = MySQL_Fetch_Array($typho2);

 			$obr2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$cislocil and typ=2 and mrtev!=1)");
			@$obr = MySQL_Fetch_Array($obr2);
			$bobr=($obr[level]*$typho[ucinek]);
			if($obr[cislomaj]!=$cislocil){$bobr=0;};
			//echo "<font class =text_bili>".$bobr;
			$cisloo=$obr[cislo];

               //**vrazi
		 	$typhv2 = MySQL_Query("SELECT * FROM typh where typ=7");
			$typhv = MySQL_Fetch_Array($typhv2);

 			$vrahu2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$logcislo' and typ=7 and mrtev!=1)");
			@$vrahu = MySQL_Fetch_Array($vrahu2);
			$bvrahu=($vrahu[level]*$typhv[ucinek]);
			if($vrahu[cislomaj]!=$logcislo){$bvrahu=0;};
			//echo "<font class =text_bili>".$bobr;
			$cislovu=$vrahu[cislo];

 			$vraho2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj='$cislocil' and typ=7 and mrtev!=1)");
			@$vraho = MySQL_Fetch_Array($vraho2);
			$bvraho=($vraho[level]*$typhv[ucinek]);
			if($vraho[cislomaj]!=$cislocil){$bvraho=0;};
			//echo "<font class =text_bili>".$bobr;
			$cislovo=$vraho[cislo];
//*********************************************hrdinovÈ - konec********************************************

			//konstanta procentuÈlnÌch ztr·t - $ztr
			$ztr=0.75-$bmedo;//$ztr=0.2;
			//konstanta procentuÈlnÌch ztr·t ˙toËnÌka - $ztru
			$ztru=1-$bmedu;//$ztru=0.2;
			if($zaznam1[rasa]==0){if(($ztru-0.5)>0){$ztru-=0.5;}else{$ztru=0;};;};
			if($zaznam4[rasa]==0){if(($ztr-0.5)>0){$ztr-=0.5;}else{$ztr=0;};;};		
			//echo "ztru $ztru";
			//echo "<br />ztr $ztr";
//exit;
		if($jakej==0):
			//echo "<script languague='JavaScript'>alert('11')</script>";
			if(($jednot1>$zaznam1[jed1])or($jednot2>$zaznam1[jed2])or($jednot4>$zaznam1[jed4])or($jednot5>$zaznam1[jed5]))
				{echo "<font class='text_cerveny'>Tolik jednotek nem·te...</font>";exit;};

			$jednot1=$jednot1*1;
			$jednot2=$jednot2*1;
			$jednot4=$jednot4*1;
			$jednot5=$jednot5*1;

			if(($jednot1<=0) and ($jednot2<=0) and ($jednot4<=0) and ($jednot5<=0))
			  {echo "<font class='text_cerveny'>MusÌte do ˙toku vyslat nejmÈnÏ jednu jednotku</font>";break;};

			if(($jednot1<0) or ($jednot1!=$jednot1*1))
				{echo "<font class='text_cerveny'>MusÌte vyslat alespoÚ jednu jednotku...</font>";break;};
			if(($jednot2<0) or ($jednot2!=$jednot2*1))
				{echo "<font class='text_cerveny'>MusÌte vyslat alespoÚ jednu jednotku...</font>";break;};
			if(($jednot4<0) or ($jednot4!=$jednot4*1))
				{echo "<font class='text_cerveny'>MusÌte vyslat alespoÚ jednu jednotku...</font>";break;};
			if(($jednot5<0) or ($jednot5!=$jednot5*1))
				{echo "<font class='text_cerveny'>MusÌte vyslat alespoÚ jednu jednotku...</font>";break;};

			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys6 = MySQL_Query("SELECT * FROM planety where cislo=$cisloplan");
			$zaznam6 = MySQL_Fetch_Array($vys6);
			
			$naconazev=$zaznam6[nazev];
					
			$typp=$zaznam6[typ];

			$plan = MySQL_Query("SELECT typ,obrana,dobyvaci FROM typp where typ = '$typp'");				
			$pla = MySQL_Fetch_Array($plan);

			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
			$politika2 = MySQL_Fetch_Array($politika22);

			$tu1=$ujed1=$jednot1;
			$tu2=$ujed2=$jednot2;
			$tu4=$ujed4=$jednot4;
			$tu5=$ujed5=$jednot5;
			$to1=$ojed1=$zaznam4["jed1"];
			$to2=$ojed2=$zaznam4["jed2"];
			$to4=$ojed4=$zaznam4["jed4"];
			$to5=$ojed5=$zaznam4["jed5"];
			
			if($zaznam6[status]==2){$bcp=1.5;};

			$buj1=$zaznam2["jed1_utok"]*$bonus+$zaznam2["jed1_utok"]*(1.0-($narod[utok]/100.0))+$zaznam2["jed1_utok"]*(1.0-($zriz[utok]/100.0));
			$buj1+=$zaznam2["jed1_utok"]*$bdob;
			$buj2=$zaznam2["jed2_utok"]*$bonus+$zaznam2["jed2_utok"]*(1.0-($narod[utok]/100.0))+$zaznam2["jed2_utok"]*(1.0-($zriz[utok]/100.0));
			$buj2+=$zaznam2["jed2_utok"]*$bdob;
			$buj4=$zaznam2["jed4_utok"]*$bonus+$zaznam2["jed4_utok"]*(1.0-($narod[utok]/100.0))+$zaznam2["jed4_utok"]*(1.0-($zriz[utok]/100.0));
			$buj4+=$zaznam2["jed4_utok"]*$bdob;
			$buj5=$zold_utok*$bonus+$zold_utok*(1.0-($narod[utok]/100.0))+$zold_utok*(1.0-($zriz[utok]/100.0));
			$buj5+=$zold_utok*$bdob;

			$boj1=$zaznam5["jed1_obrana"]*($pla[obrana]/100.0)+$zaznam5["jed1_obrana"]*(1.0-($jpolitika[obrana]/100.0));
			$boj1+=$zaznam5["jed1_obrana"]*(1.0-($jnarod[obrana]/100.0))+$zaznam5["jed1_obrana"]*(1.0-($jzriz[obrana]/100.0));
			$boj1+=$zaznam5["jed1_obrana"]*$bobr+$zaznam5["jed1_obrana"]*$bcp;
			$boj2=$zaznam5["jed2_obrana"]*($pla[obrana]/100.0)+$zaznam5["jed2_obrana"]*(1-($jpolitika[obrana]/100.0));
			$boj2+=$zaznam5["jed2_obrana"]*(1-($jnarod[obrana]/100.0))+$zaznam5["jed2_obrana"]*(1.0-($jzriz[obrana]/100.0));
			$boj2+=$zaznam5["jed2_obrana"]*$bobr+$zaznam5["jed2_obrana"]*$bcp;
			$boj4=$zaznam5["jed4_obrana"]*($pla[obrana]/100.0)+$zaznam5["jed4_obrana"]*(1.0-($jpolitika[obrana]/100.0));
			$boj4+=$zaznam5["jed4_obrana"]*(1.0-($jnarod[obrana]/100.0))+$zaznam5["jed4_obrana"]*(1.0-($jzriz[obrana]/100.0));
			$boj4+=$zaznam5["jed4_obrana"]*$bobr+$zaznam5["jed4_obrana"]*$bcp;
			$boj5=$zold_obrana*($pla[obrana]/100.0)+$zold_obrana*(1.0-($jpolitika[obrana]/100.0));
   			$boj5+=$zold_obrana*(1.0-($jnarod[obrana]/100.0))+$zold_obrana*(1.0-($jzriz[obrana]/100.0));
			$boj5+=$zold_obrana*$bobr+$zold_obrana*$bcp;

			if($zaznam6[brana]==1):
				$boj1-=$zaznam5["jed1_obrana"]*0.25;
				$boj2-=$zaznam5["jed2_obrana"]*0.25;
				$boj4-=$zaznam5["jed4_obrana"]*0.25;
				$boj5-=$zold_obrana*0.25;
			endif;

			$utokorb=$ujed2*($zaznam2["jed2_utok"]+$buj2)*0.5;
			$utokorb+=$ujed4*($zaznam2["jed4_utok"]+$buj4);	
			$utokorb*=$politika[utok]/100.0;

			$obranaorb+=$ojed4*($zaznam5["jed4_obrana"]+$boj4);
			$obranaorb*=$politika2[obrana]/100.0;

//*************************************************orbit·lnÌ ˙tok****************************************
			$utok=$utokorb;
			$obrana=$obranaorb;

			if($utokorb==$obranaorb):
				$zujed4=Round($ztru*$ujed4);
				$ujed4-=$zujed4;
				$zujed2=Round($ztru*$ujed2);
				$ujed2-=$zujed2;

				$zojed4=Round($zojed4*$ztr);
				$ojed4-=$zojed4;

				$usorb=0;				
			elseif($utokorb > $obranaorb):
				if(($ujed4*($zaznam2["jed4_utok"]+$buj4))>=$obrana):
					$zujed4=Round(($obrana/(($zaznam2["jed4_utok"]+$buj4)*$politika[utok]/100.0))*$ztru);
					$ujed4-=$zujed4;
					$zujed2=0.0;

					$zojed4=Round($ojed4*$ztr);
					$ojed4-=$zojed4;
				else:
					$a=$obrana;
					$a-=$ujed4*($zaznam2["jed4_utok"]+$buj4);

					$zujed4=Round($ujed4*$ztru);
					$ujed4-=$zujed4;

					$zujed2=Round(($a/(($zaznam2["jed2_utok"]+$buj2)*0.5*$politika[utok]/100.0))*$ztru);
					$ujed2-=$zujed2;

					$zojed4=Round($ojed4*$ztr);
					$ojed4-=$zojed4;
				endif;
				$usorb=1;
			else:
				$zojed4=Round($utok/(($zaznam5["jed4_obrana"]+$boj4)*$politika2[obrana]/100.0));
				$zojed4=Round($zojed4*$ztr);
				$ojed4-=$zojed4;

				$zujed4=Round($ujed4*$ztru);
				$ujed4-=$zujed4;
				$zujed2=Round($ujed2*$ztru);
				$ujed2-=$zujed2;
				//echo "<script languague='JavaScript'>alert(".$zujed4.")</script>";
				//echo "<script languague='JavaScript'>alert(".$ujed4.")</script>";
				$usorb=0;
			endif;
//*****************************************************texty_orbit-begin*********************************************

?>
<SCRIPT language=JavaScript>
	<!--  
var bla2="o1";
var oprodleva;
 	function outok(){
	if(bla2=="o999"){bla2="o9999";}
	if(bla2=="o4"){document.all.item(bla2).style.visibility = "visible";bla2="o999";putok();}
	if(bla2=="o3"){document.all.item(bla2).style.visibility = "visible";bla2="o4";}
	if(bla2=="o2"){document.all.item(bla2).style.visibility = "visible";bla2="o3";}
	if(bla2=="o1"){document.all.item(bla2).style.visibility = "visible";bla2="o2";}
  //alert(bla2);
	oprodleva=setTimeout("outok()",7000);
	}
	//-->
</SCRIPT>

<?

			$ztraty=$ztratyj=0.0;
			if($tu2>0){$ztraty+=$ujed2/($tu2/100.0);};
			if($tu4>0){$ztraty+=$ujed4/($tu4/100.0);};
			if($to2>0){$ztratyj+=$ojed2/($to2/100.0);};
			if($to4>0){$ztratyj+=$ojed4/($to4/100.0);};

			$ztraty/=2;
			$ztraty=Round($ztraty);
			$ztraty=100-$ztraty;
			if($tu4==0 and $tu2==0){$ztraty=0;};
			$ztratyc=$ztraty;
//echo "<br /><font class=text_bili>ztraty ".$ztraty;

			$ztratyj/=2;
			$ztratyj=Round($ztratyj);
			$ztratyj=100.0-$ztratyj;
			if($to4==0 and $to2==0){$ztratyj=0;};
			$ztratyjc=$ztratyj;
//echo "<br /><font class=text_bili>ztratyj ".$ztratyj;

//echo "<h6>".$ztraty;

			echo "<font class='text_bili'>";
			echo "<center><h6><font class=text_modry>Z</font>pr·vy z orbit·lnÌho ˙toku</h6></center>";
			include("texty_orbit.php");
			echo "</font>";
//****************************************************texty-end****************************************
			if($usorb==1):
//*************************************************pozemnÌ ˙tok****************************************
			$utokpoz=$ujed1*($zaznam2["jed1_utok"]+$buj1)+$ujed2*($zaznam2["jed2_utok"]+$buj2);
			$utokpoz+=$ujed4*($zaznam2["jed4_utok"]+$buj4)*0.5;
			$utokpoz+=$ujed5*($zold_utok+$buj5);
			$utokpoz*=$politika[utok]/100.0;

			$obranapoz=$ojed1*($zaznam5["jed1_obrana"]+$boj1)+$ojed2*($zaznam5["jed2_obrana"]+$boj2);
			$obranapoz+=$ojed5*($zold_obrana+$boj5);	
			$obranapoz*=$politika2[obrana]/100.0;

			//echo "<script languague='JavaScript'>alert('".$utokpoz."')</script>";

			$obrana=$obranapoz;
			$utok=$utokpoz;

			if($utokpoz==$obranapoz):
				//echo "<script languague='JavaScript'>alert('1')</script>";
				$zujed1=Round($ujed1*$ztru);
				$ujed1-=$zujed1;
				$zujed2+=Round($ujed2*$ztru);
				$ujed2-=Round($ujed2*$ztru);
				$zujed4+=Round($ujed4*$ztru);
				$ujed4-=Round($ujed4*$ztru);
				$zujed5+=Round($ujed5*$ztru);
				$ujed5-=Round($ujed5*$ztru);

				$zojed1=Round($ojed1*$ztr);
				$ojed1-=$zojed1;
				$zojed2=Round($ojed2*$ztr);
				$ojed2-=$zojed2;
				$zojed5=Round($ojed5*$ztr);
				$ojed5-=$zojed5;
				$uspoz=0;				
			elseif($utokpoz>$obranapoz):
				//echo "<script languague='JavaScript'>alert('2')</script>";
				if(($ujed1*($zaznam2["jed1_utok"]+$buj1))>=$obrana):
					$zujed1=Round(($obrana/(($zaznam2["jed1_utok"]+$buj1)*$politika[utok]/100.0))*$ztru);
					$ujed1-=$zujed1;
					$zujed5=0;
					//$zujed2=0;// - uû nÏjak˝ ztr·ty z orbitu
					//$zujed4=0;// - uû nÏjak˝ ztr·ty z orbitu

					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;
					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;

				elseif(($ujed1*($zaznam2["jed1_utok"]+$buj1)+$ujed2*($zaznam2["jed2_utok"]+$buj1))>=$obrana):
					$a=$obrana;
					$a-=$ujed1*($zaznam2["jed1_utok"]+$buj1);

					$zujed1=Round($ujed1*$ztru);
					$ujed1-=$zujed1;
					$zujed2+=Round(($a/(($zaznam2["jed2_utok"]+$buj2)*$politika[utok]/100.0))*$ztru);
					$ujed2-=Round(($a/(($zaznam2["jed2_utok"]+$buj2)*$politika[utok]/100.0))*$ztru);
					$zujed5=0;
					//$zujed4=0; // - uû nÏjak˝ ztr·ty z orbitu

					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;
					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;
				elseif(($ujed1*($zaznam2["jed1_utok"]+$buj1)+$ujed2*($zaznam2["jed2_utok"]+$buj1)+$ujed5*($zold_utok+$buj5))>=$obrana):
					$a=$obrana;
					$a-=$ujed1*($zaznam2["jed1_utok"]+$buj1);

					$zujed1=Round($ujed1*$ztru);
					$ujed1-=Round($ujed1*$ztru);

					$b=$a-$ujed2*($zaznam2["jed2_utok"]+$buj2);
  					$zujed2+=Round($ujed2*$ztru);
					$ujed2-=Round($ujed2*$ztru);

					$zujed5=Round(($b/(($zold_utok+$buj5)*$politika[utok]/100.0))*$ztru);
					$ujed5-=$zujed5;
					//$zujed4=0; // - uû nÏjak˝ ztr·ty z orbitu

					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;
					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;
      			else:
					$a=$obrana;
					$a-=$ujed1*($zaznam2["jed1_utok"]+$buj1);

					$zujed1=Round($ujed1*$ztru);
					$ujed1-=Round($ujed1*$ztru);

					$b=$a-$ujed2*($zaznam2["jed2_utok"]+$buj2);
					$zujed2+=Round($ujed2*$ztru);
					$ujed2-=Round($ujed2*$ztru);

					$c=$b-$ujed5*($zold_utok+$buj5);
					$zujed5+=Round($ujed5*$ztru);
					$ujed5-=$zujed5;

					$zujed4+=Round(($c/(($zaznam2["jed4_utok"]+$buj4)*0.5*$politika[utok]/100.0))*$ztru);
					$ujed4-=Round(($c/(($zaznam2["jed4_utok"]+$buj4)*0.5*$politika[utok]/100.0))*$ztru);

					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;
					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;
				endif;
				$uspoz=1;
			else:
				//echo "<script languague='JavaScript'>alert('3')</script>";			
				if(($ojed1*($zaznam5["jed1_obrana"]+$boj1))>=$utok):
					//echo "<script languague='JavaScript'>alert('1')</script>";			
					$zojed1=Round($utok/(($zaznam5["jed1_obrana"]+$boj1)*$politika2[obrana]/100.0));

					$zojed1=Round($zojed1*$ztr);
					$ojed1-=$zojed1;
					$zojed2=0;
					$zojed5=0;

					$zujed1=Round($ujed1*$ztru);
					$ujed1=Round($ujed1*(1.0-$ztru));
					$zujed2+=Round($ujed2*$ztru);
					$ujed2=Round($ujed2*(1.0-$ztru));
					$zujed4+=Round($ujed4*$ztru);
					$ujed4=Round($ujed4*(1.0-$ztru));
					$zujed5=Round($ujed5*$ztru);
					$ujed5-=$zujed5;

				elseif(($ojed1*($zaznam5["jed1_obrana"]+$boj1))+($ojed5*($zold_obrana+$boj5))>=$utok):
					//echo "<script languague='JavaScript'>alert('2')</script>";				
					$a=$utok;
					$a-=$ojed1*($zaznam5["jed1_obrana"]+$boj1)*($politika2[obrana]/100.0);
					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;

					$zojed5=Round($a/(($zold_obrana+$boj5)*$politika2[obrana]/100.0));
					$zojed5=Round($zojed5*$ztr);
					$ojed5-=$zojed5;

          			$zojed2=0;     
					$zujed1=Round($ujed1*$ztru);
					$ujed1=Round($ujed1*(1.0-$ztru));
					$zujed2+=Round($ujed2*$ztru);
					$ujed2=Round($ujed2*(1.0-$ztru));
					$zujed4+=Round($ujed4*$ztru);
					$ujed4=Round($ujed4*(1.0-$ztru));
					$zujed5=Round($ujed5*$ztru);
					$ujed5-=$zujed5;
        		else:
					///echo "<script languague='JavaScript'>alert('3')</script>";
					$a=$utok;
					$a-=$ojed1*($zaznam5["jed1_obrana"]+$boj1)*($politika2[obrana]/100.0);
					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;

					$b=$a-($ojed5*($zold_obrana+$boj5)*($politika2[obrana]/100.0));
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;//;echo "<br />".$a."<br />$b";

					$zojed2=Round($b/(($zaznam5["jed2_obrana"]+$boj2)*$politika2[obrana]/100.0));
					$zojed2=Round($zojed2*$ztr);
					$ojed2-=$zojed2;

					$zujed1=Round($ujed1*$ztru);
					$ujed1=Round($ujed1*(1.0-$ztru));
					$zujed2+=Round($ujed2*$ztru);
					$ujed2=Round($ujed2*(1.0-$ztru));
					$zujed4+=Round($ujed4*$ztru);
					$ujed4=Round($ujed4*(1.0-$ztru));
					$zujed5=Round($ujed5*$ztru);
					$ujed5-=$zujed5;
				endif;
				$uspoz=0;
			endif;
//echo $zujed4;
//echo "<br />$zojed2";
//*****************************************************texty_povrch-begin*********************************************

?>
<SCRIPT language=JavaScript>
	<!--  
var bla="p1";
var prodleva;
 	function putok(){
	if(bla=="p4"){document.all.item(bla).style.visibility = "visible";bla="p999";}
	if(bla=="p3"){document.all.item(bla).style.visibility = "visible";bla="p4";}
	if(bla=="p2"){document.all.item(bla).style.visibility = "visible";bla="p3";}
	if(bla=="p1"){document.all.item(bla).style.visibility = "visible";bla="p2";}
  //alert(bla);
	prodleva=setTimeout("putok()",7000);
	}
	//-->
</SCRIPT>

<?

			$ztraty=$ztratyj=0;
			if($tu1>0){$ztraty+=$ujed1/($tu1/100.0);};
			if($tu2>0){$ztraty+=$ujed2/($tu2/100.0);};
			if($tu4>0){$ztraty+=$ujed4/($tu4/100.0);};
			if($tu5>0){$ztraty+=$ujed5/($tu5/100.0);};
			if($to1>0){$ztratyj+=$ojed1/($to1/100.0);};
			if($to2>0){$ztratyj+=$ojed2/($to2/100.0);};
			if($to4>0){$ztratyj+=$ojed4/($to4/100.0);};
			if($to5>0){$ztratyj+=$ojed5/($to5/100.0);};

			$ztraty/=4.0;
			$ztraty=Round($ztraty);
			$ztraty=100.0-$ztraty;
			if($tu4==0 and $tu2==0 and $tu1=0){$ztraty=0;};
			$ztratyc+=$ztraty;
			$ztratyc/=2.0;

			$ztratyj/=4.0;
			$ztratyj=Round($ztratyj);
			$ztratyj=100.0-$ztratyj;
			if($to4==0 and $to2==0 and $to1=0){$ztratyj=0;};
			$ztratyjc+=$ztratyj;
			$ztratyjc/=2.0;

			echo "<font class='text_bili'>";
			echo "<center><h6><font class=text_modry>Z</font>pr·vy z pozemnÌho ˙toku</h6></center>";
			include("texty_povrch.php");
			echo "</font>";
//****************************************************texty-end****************************************
		else:
        	echo "<h6>Nedobyli jsme orbit, proto nem˘ûeme udÏlat v˝sadek a ovl·dnout planetu.</h6>";
?>
<SCRIPT language=JavaScript>
<!--  
 	function putok(){
	
	}
	//-->
</SCRIPT>   

<?
		endif;
//*********************************************************vyhodnocenÌ hrdin˘*******************************
		//medikovÈ
			$zkusn=($medu[level]*($ztratyc)*($utokpoz+$utokorb))/1000000000.0;
			//echo "<br /><font class=text_bili>$ztratyc ".$ztratyc;
			$zkusn+=$medo[level]*1000.0;
			//echo "<br /><font class=text_bili>medu: ".$zkusn;
			$zkusn=Floor($zkusn)+$medu[zkus];
			$lv=bcsqrt($zkusn/1000.0);
			$lv=Floor($lv);
      		if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};
			MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislomu");

			$zkusn=($medo[level]*($ztratyjc)*($obranapoz+$obranaorb))/10000000000.0;
			$zkusn+=$medu[level]*1000.0;
			//echo "<br /><font class=text_bili>medo ".$zkusn;
			$zkusn=Floor($zkusn)+$medo[zkus];
			$lv=bcsqrt($zkusn/1000.0);
			$lv=Floor($lv);
     		if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};
			MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislomo");

    //dobyvatel
			if($uspoz==1 and $usorb==1):
        		$vy=30;
        		$pr=1;
      		else:
        		$vy=1;
        		$pr=30;
      		endif;
			@$zkusn=(($obranapoz+$obranaorb)/($utokpoz+$utokorb));
		    if($zkusn>5){$zkusn=5;};
			$zkusn*=$dob[level]*$vy*300.0;
			//echo "<br /><font class=text_bili>dob ".$zkusn;
			$zkusn=Floor($zkusn)+$dob[zkus];
			$lv=bcsqrt($zkusn/1000.0);
			$lv=Floor($lv);
	      	if($lv>20){$lv=20;$zkusn=$lv*$lv*1000.0;};
			MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislod");

    //obr·nce
			@$zkusn=(($utokpoz+$utokorb)/($obranapoz+$obranaorb));
      		if($zkusn>5){$zkusn=5;};
			$zkusn*=$obr[level]*$pr;
			//echo "<br /><font class=text_bili>obr ".$zkusn;
			$zkusn=Floor($zkusn)+$obr[zkus];
			$lv=bcsqrt($zkusn/750.0);
			$lv=Floor($lv);
      		if($lv>20){$lv=20;$zkusn=$lv*$lv*1000.0;};
			MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cisloo");

    //vrazi
      		$mzu=100.0-($bvrahu*100.0);
      		$zhu=rand(1,$mzu);
      		if($zhu==($mzu-1) and $vrahu[cislo]>1000000):
          		$zab=1;
          		$smrt=$obr[smrt]+1;
     			MySQL_Query("update hrdinove set smrt=$smrt,mrtev=1 where cislo=$cisloo");         
          		echo "<h6>N·ö hrdina ".$vrahu[jmeno]." povol·nÌm vrah zabil nep¯·telskÈho hrdinu ".$obr[jmeno].", kter˝ byl na ".$obr[level]."  ˙rovni</h6>";
      		endif;

			$zkusn=$obr[level]*100.0;
			$zkusn+=$zab*$obr[level]*2500.0;
			//echo "<br /><font class=text_bili>vrahu ".$zkusn;
			$zkusn=Floor($zkusn)+$vrahu[zkus];
			$lv=bcsqrt($zkusn/1000.0);
			$lv=Floor($lv);
      		if($lv>20){$lv=20;$zkusn=$lv*$lv*1000.0;};
			MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislovu");

      		$mzu2=100.0-($bvraho*100.0);
      		$zhu2=rand(1,$mzu2);
      		if($zhu2==($mzu2-1) and $vraho[cislo]>1000000):
          		$zab2=1;
          		$smrt=$dob[smrt]+1;
     			MySQL_Query("update hrdinove set smrt=$smrt,mrtev=1 where cislo=$cislod");         
          		echo "<h6>Nep¯·telsk˝ vrah zabil naöeho hrdinu ".$dob[jmeno].", kter˝ byl na ".$dob[level]." . ˙rovni</h6>";
      		endif;

			$zkusn=$dob[level]*100.0;
			$zkusn+=$zab2*$dob[level]*2500.0;
			//echo "<br /><font class=text_bili>vraho ".$zkusn;
			$zkusn=Floor($zkusn)+$vraho[zkus];
			$lv=bcsqrt($zkusn/1000);
			$lv=Floor($lv);
      		if($lv>20){$lv=20;$zkusn=$lv*$lv*1000.0;};
			MySQL_Query("update hrdinove set zkus='$zkusn',level='$lv' where cislo=$cislovo");

//************************************************************************************************************

 //   	do{

			$vys99 = MySQL_Query("SELECT den FROM utok");
			$dat = Date("G:i:s j.m.Y");
			
			if($uspoz==1 and $usorb==1):$us=1;
			else:$us=0;
			endif;
			
			$ujed1+=$zaznam1["jed1"];
			$ujed1-=$jednot1;
			$ujed2+=$zaznam1["jed2"];
			$ujed2-=$jednot2;
			$ujed4+=$zaznam1["jed4"];
			$ujed4-=$jednot4;
			$ujed5+=$zaznam1["jed5"];
			$ujed5-=$jednot5;

			if($ujed1<0){$ujed1=0;};
			if($ujed2<0){$ujed2=0;};
			if($ujed4<0){$ujed4=0;};
			if($ujed5<0){$ujed5=0;};
			if($ojed1<0){$ojed1=0;};
			if($ojed2<0){$ojed2=0;};
			if($ojed4<0){$ojed4=0;};
			if($ojed5<0){$ojed5=0;};
			$zujed1=$zujed1;$zujed2=$zujed2;$zujed4=$zujed4;$zujed5=$zujed5;
			$zojed1=$zojed1;$zojed2=$zojed2;$zojed4=$zojed4;$zojed5=$zojed5;			
			$naconazev=addslashes($naconazev);			
			
      
        $kont2_u = MySQL_Query("SELECT `den`,`planety` FROM `utok` where `den` >'$den-1' AND `den` <'$den-1' ");
				$kont_u = MySQL_Fetch_Array($kont2_u);
				if($kont_u["planety"]==$cil ){
        echo "<font class='text_cerveny'>Br·na je p¯etÌûena, zkuste za˙toËit pozdÏji.</font>";
        exit;
        }
      
      do{
				if($i>50){break;};
				$proved=1;
				$den = Date("U");
				MySQL_Query("INSERT INTO `utok` (`den`,`utocnik`,`obrance`,`planety`,`uspesnost`,`ujed1`,`ujed2`,`ujed4`,`ujed5`,`ojed1`,`ojed2`,`ojed4`,`ojed5`,`urasa`,`orasa`,`typ`)VALUES ('$den','$logjmeno','$cil','$naconazev','$us','$zujed1','$zujed2','$zujed4','$zujed5','$zojed1','$zojed2','$zojed4','$zojed5','$rasa1','$rasa2',0)");
				MySQL_Query("update `uzivatele` set `poslutok`='$den' where `cislo`='$logcislo'");

			//	$kont2 = MySQL_Query("SELECT den,utocnik FROM utok where den='$den'");
				$kont2 = MySQL_Query("SELECT `den`,`utocnik` FROM `utok` where `den`='$den'");
				$kont = MySQL_Fetch_Array($kont2);
				if($kont["utocnik"]==$logjmeno){$proved=0;};
				
				
				$i++;
			}while($proved);
			  
        $kont2_u = MySQL_Query("SELECT `den`,`utocnik`,`planety` FROM `utok` where `den` >'$den-1' AND `den` <'$den-1' ");
				$kont_u = MySQL_Fetch_Array($kont2_u);
				if($kont_u["planety"]==$cil AND $kont_u["planety"]!=$logjmeno) 
        {
              $proved==1;
        }
      
				
			if($proved==1):
				echo "<font class='text_cerveny'>Br·na je p¯etÌûena, zkuste za˙toËit pozdÏji.</font>";exit;
			else:
					
			if($uspoz==1 and $usorb==1):
				$us=1;
				if($pla[dobyvaci]!=1):
					$dob=$zaznam4[dobyt]+1;
				else:
					$dob=$zaznam4[dobyt];
				endif;
				$dobyl=$zaznam1[dobyl]+1;
				$t=$zaznam1["planety"]+1;
				$j=$zaznam4["planety"]-1;
				$l=$zaznam6["lidi"]*0.5;
				$l=Floor($l);
				$c=Date("U");
				$s=Floor($zaznam6["vyrobna"]*0.5);
				$dcpp=$zaznam4[dobyto]+1;
				if($zaznam6[status]==2):
					$dcp=$cpdb[dobyto]+1;
					MySQL_Query("update planety set cislomaj=$logcislo where cislo=$cisloplan");
					MySQL_Query("update planety set cas = $c where cislo=$cisloplan");
					MySQL_Query("update uzivatele set planety = $j,dobyt = $dob where cislo = $cislocil");
					MySQL_Query("update uzivatele set planety = $t,dobyl=$dobyl where cislo=$logcislo");
					MySQL_Query("update cp set dobyto = $dcpp where rasa=$rasa1");	

		$zaznamut1 = MySQL_Query("SELECT utoceno FROM uzivatele where jmeno=$cil");
		$zaznamut = MySQL_Fetch_Array($zaznamut1);

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo = $cislocil");
				
				else:
					MySQL_Query("update planety set lidi = '$l' where cislo=$cisloplan");
					MySQL_Query("update planety set vyrobna = '$s' where cislo=$cisloplan");
					MySQL_Query("update planety set majitel='$logjmeno',cislomaj=$logcislo where cislo=$cisloplan");
					MySQL_Query("update planety set cas = '$c' where cislo='$cisloplan'");
					MySQL_Query("update uzivatele set planety ='$j',dobyt = $dob where cislo = $cislocil");
					MySQL_Query("update uzivatele set planety ='$t',dobyl='$dobyl' where cislo=$logcislo");

		$zaznamut1 = MySQL_Query("SELECT `utoceno` FROM `uzivatele` where `jmeno`='$cil'");
		$zaznamut = MySQL_Fetch_Array($zaznamut1);

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo = $cislocil");

				endif;
			
        		$zemhrd=rand(1,20);
        		if($zemhrd==19 and ($obr[cislo]>1000000)):
		          		$smrt=$obr[smrt]+1;
     					MySQL_Query("update hrdinove set smrt=$smrt,mrtev=1 where cislo=$cisloo");         
          				echo "<h6>Nep¯·telsk˝ hrdina ".$obr[jmeno].", kter˝ byl na ".$obr[level]." . ˙rovni, byl v bitvÏ zabit</h6>";
        		endif;

        		$novhrd=rand(1,12);

        		if($novhrd==2):
          			$ph2 = MySQL_Query("select cislo,cislomaj from hrdinove where cislomaj=$logcislo");
          			$ph = mysql_num_rows($ph2);
          			//echo $ph;
          			if($ph<5):
			           	$uroven=rand(1,5);
    	    		    $zkusn=$uroven*$uroven*1000;
		    		 	$hhh2 = MySQL_Query("SELECT cislo,cislomaj,typ FROM hrdinove where cislomaj=$logcislo");
						$poceth=0;
						while($hhh = MySQL_Fetch_Array($hhh2)):
							$poceth++;
							$hu[$poceth]=$hhh[typ];
						endwhile;
	            		do{
							$ranh=rand(1,10);
							if($ranh!=$hu[1] and $ranh!=$hu[2] and $ranh!=$hu[3] and $ranh!=$hu[4] and $ranh!=$hu[5]){$bla=0;};
						}while($bla);
						$typ=$ranh;
		    		//optimalitovano 	$typh2 = MySQL_Query("SELECT * FROM typh where typ='$typ'");
		    		 	$typh2 = MySQL_Query("SELECT nazev FROM typh where typ='$typ'");
      					$typh = MySQL_Fetch_Array($typh2);						
			            $i=0;
        		    	do{
            		  		$i++;
              				if($i>50){break;};
	              			$proved=1;
    	    				$poshrd2 = MySQL_Query("SELECT cislo,hrdinove FROM servis where cislo = 1");
			  	      		$poshrd = MySQL_Fetch_Array($poshrd2);
				            $cislo=$poshrd[hrdinove];
            				$jmeno=$typh[nazev];
	              			$zivot=Date("U")-(3600*24*20*12);
	//echo $i;
    	         			MySQL_Query("INSERT INTO hrdinove(cislo,cislomaj,jmeno,typ,level,zkus,zivot,smrt,mrtev)values($cislo,$logcislo,'$jmeno',$typ,$uroven,$zkusn,$zivot,0,0)");
	    	    			$kont2 = MySQL_Query("SELECT cislo,cislomaj FROM hrdinove where cislo ='$cislo'");
				  	      	$kont = MySQL_Fetch_Array($kont2);
        			      	if($kont[cislomaj]==$logcislo){$proved=0;};
            			}while($proved);
	            		if($proved==0):
    	          			echo "<h6>BÏhem bitvÏ se k n·m p¯idal nov˝ hrdina! Je to ".$typh[nazev]." a je na ".$uroven." . ˙rovni.</h6>";
        	      			$a=$cislo+1;
					      	//MySQL_Query("update hrdinove set zivot = $a where cislo=1");
							MySQL_Query("update servis set hrdinove = $a where cislo=1");
		        	    endif;
	        		endif;
        		endif;
			else:
				$us=0;
	    	    $zemhrd=rand(1,20);
        		//$zemhrd=19;
    		    if($zemhrd==19 and ($dob[cislo]>1000000)):
			        $smrt=$dob[smrt]+1;
	     			MySQL_Query("update hrdinove set smrt=$smrt,mrtev=1 where cislo=$cislod");
        			echo "<h6>N·ö hrdina ".$dob[jmeno].", kter˝ byl na ".$dob[level]." . ˙rovni, byl v bitvÏ zabit</h6>";
        		endif;
			endif;
			$den = Date("U");

			MySQL_Query("update uzivatele set jed1=$ujed1,jed2=$ujed2,jed4=$ujed4,jed5=$ujed5 where cislo=$logcislo");
			MySQL_Query("update uzivatele set jed1=$ojed1,jed2=$ojed2,jed4=$ojed4,jed5=$ojed5 where cislo=$cislocil");
			
			$vys111 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam111 = MySQL_Fetch_Array($vys111);
			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
			$politika2 = MySQL_Fetch_Array($politika22);
			$politika11 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika1 = MySQL_Fetch_Array($politika11);
			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys51 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam51 = MySQL_Fetch_Array($vys51);
			$vys4 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislocil");
			$zaznam4 = MySQL_Fetch_Array($vys4);
			$vys44 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam4[narod]");
			$zaznam44 = MySQL_Fetch_Array($vys44);
			$vys444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam4[zrizeni]");
			$zaznam444 = MySQL_Fetch_Array($vys444);
			$vys14 = MySQL_Query("SELECT * FROM uzivatele where cislo = $logcislo");
			$zaznam14 = MySQL_Fetch_Array($vys14);
			$vys144 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam111[narod]");
			$zaznam144 = MySQL_Fetch_Array($vys144);
			$vys1444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam111[zrizeni]");
			$zaznam1444 = MySQL_Fetch_Array($vys1444);


			$u1=$zaznam111["jed1"]*$zaznam51["jed1_utok"];
			$u1+=$zaznam111["jed2"]*$zaznam51["jed2_utok"];
			$u1+=$zaznam111["jed4"]*$zaznam51["jed4_utok"];
			$u1+=$zaznam111["jed5"]*$zold_utok;
			$u1*=$politika1[utok]/100;
			$u1*=$zaznam144[utok]/100;
			$u1*=$zaznam1444[utok]/100;
			$u2+=$zaznam111["jed1"]*$zaznam51["jed1_obrana"];
			$u2+=$zaznam111["jed2"]*$zaznam51["jed2_obrana"];
			$u2+=$zaznam111["jed4"]*$zaznam51["jed4_obrana"];
			$u2+=$zaznam111["jed5"]*$zold_obrana;
			$u2*=$politika1[obrana]/100;
			$u2*=$zaznam44[obrana]/100;
			$u2*=$zaznam444[obrana]/100;
			
			$u=$u1+$u2;

			$o1=$zaznam4["jed1"]*$zaznam5["jed1_utok"];
			$o1+=$zaznam4["jed2"]*$zaznam5["jed2_utok"];
			$o1+=$zaznam4["jed4"]*$zaznam5["jed4_utok"];
			$o1+=$zaznam4["jed5"]*$zold_utok;
			$o1*=$politika2[utok]/100;
			$o1*=$zaznam44[utok]/100;
			$o1*=$zaznam444[utok]/100;
			$o2+=$zaznam4["jed1"]*$zaznam5["jed1_obrana"];
			$o2+=$zaznam4["jed2"]*$zaznam5["jed2_obrana"];
			$o2+=$zaznam4["jed4"]*$zaznam5["jed4_obrana"];
			$o2+=$zaznam4["jed5"]*$zold_obrana;
			$o2*=$politika2[obrana]/100;
			$o2*=$zaznam44[obrana]/100;
			$o2*=$zaznam444[obrana]/100;
			
			$o=$o1+$o2;


			MySQL_Query("update uzivatele set sila = $u where cislo=$logcislo");			
			MySQL_Query("update uzivatele set sila = $o where cislo=$cislocil");
      echo "<center><h6><a href='hlavni.php?page=info' title='info'>PokraËovat na info</a></h6></center>";
      exit;
	  endif;
//			}while(false);
//**************************************************************************************************************

//****************************************************partizan ˙tok**********************************************
//**************************************************************************************************************
   elseif($jakej==2):
			//echo "<script languague='JavaScript'>alert('11')</script>";
			if(($jednot1>$zaznam1[jed1])or($jednot5>$zaznam1[jed5]))
				{echo "<font class='text_cerveny'>Tolik jednotek nem·te</font>";break;};

			$jednot1=$jednot1*1;
			$jednot5=$jednot5*1;

			if(($jednot1<=0) and ($jednot5<=0))
			  {echo "<font class='text_cerveny'>MusÌte do ˙toku vyslat nejmÈnÏ jednu jednotku...</font>";break;};

			if(($jednot1<0) or ($jednot1!=$jednot1*1))
				{echo "<font class='text_cerveny'>MusÌte vyslat alespoÚ jednu jednotku...</font>";break;};
			if(($jednot5<0) or ($jednot5!=$jednot5*1))
				{echo "<font class='text_cerveny'>MusÌte vyslat alespoÚ jednu jednotku...</font>";break;};

			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys6 = MySQL_Query("SELECT * FROM planety where cislo='$cisloplan'");
			$zaznam6 = MySQL_Fetch_Array($vys6);
			$naconazev=$zaznam6[nazev];		
			$typp=$zaznam6[typ];

			$plan = MySQL_Query("SELECT typ,obrana FROM typp where typ = '$typp'");				
			$pla = MySQL_Fetch_Array($plan);

			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = '$rasa2'");
			$politika2 = MySQL_Fetch_Array($politika22);

			$tu1=$ujed1=$jednot1;
			$tu5=$ujed5=$jednot5;
			$to1=$ojed1=$zaznam4["jed1"];
			$to5=$ojed5=$zaznam4["jed5"];

			$cisloplan=$naco;
			$buj1=$zaznam2["jed1_utok"]*$bonus+$zaznam2["jed1_utok"]*(1-($narod[utok]/100))+$zaznam2["jed1_utok"]*(1-($zriz[utok]/100));
		    $buj1+=$zaznam2["jed1_utok"]*$bdob;
			$buj5=$zold_utok*$bonus+$zold_utok*(1-($narod[utok]/100))+$zold_utok*(1-($zriz[utok]/100));
		    $buj5+=$zold_utok*$bdob;

			$boj1=$zaznam5["jed1_obrana"]*($pla[obrana]/100)+$zaznam5["jed1_obrana"]*(1-($jpolitika[obrana]/100));
			$boj1+=$zaznam5["jed1_obrana"]*(1-($jnarod[obrana]/100))+$zaznam5["jed1_obrana"]*(1-($jzriz[obrana]/100));
			$boj1+=$zaznam5["jed1_obrana"]*$bobr;

			$boj5=$zold_obrana*($pla[obrana]/100)+$zold_obrana*(1-($jpolitika[obrana]/100));
			$boj5+=$zold_obrana*(1-($jnarod[obrana]/100))+$zold_obrana*(1-($jzriz[obrana]/100));
			$boj5+=$zold_obrana*$bobr;


			if($zaznam6[brana]==1):
				$boj1-=$zaznam5["jed1_obrana"]*0.1;
				$boj5-=$zold_obrana*0.1;
			endif;


			$utok=$ujed1*($zaznam2["jed1_utok"]+$buj1);
			$utok+=$ujed5*($zold_utok+$buj5);
			$utok*=$politika[utok]/100;

			$obrana=$ojed1*($zaznam5["jed1_obrana"]+$boj1);
			$obrana+=$ojed5*($zold_obrana+$boj5);	
			$obrana*=$politika2[obrana]/100;

			if($utok==$obrana):
				//echo "<script languague='JavaScript'>alert('1')</script>";
				$zujed1=Round($ujed1*$ztru);
				$ujed1-=$zujed1;
				$zujed5+=Round($ujed5*$ztru);
				$ujed5-=Round($ujed5*$ztru);

				$zojed1=Round($ojed1*$ztr);
				$ojed1-=$zojed1;
				$zojed5=Round($ojed5*$ztr);
				$ojed5-=$zojed5;
				$us=0;				
			elseif($utok>$obrana):
				//echo "<script languague='JavaScript'>alert('2')</script>";
				if(($ujed1*($zaznam2["jed1_utok"]+$buj1))>=$obrana):
					$zujed1=Round(($obrana/(($zaznam2["jed1_utok"]+$buj1)*$politika[utok]/100))*$ztru);
					$ujed1-=$zujed1;
			        $zujed5=0;

					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;
				else:
					$a=$obrana;
					$a-=$ujed1*($zaznam2["jed1_utok"]+$buj1);
					$zujed1=Round($ujed1*$ztru);
					$ujed1-=Round($ujed1*$ztru);

					$zujed5=Round(($a/(($zold_utok+$buj5)*$politika[utok]/100))*$ztru);
					$ujed5-=$zujed5;

					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;
		        endif;
				$us=1;
        		$nicim=$ujed1*($zaznam2["jed1_utok"]+$buj1)*($politika[utok]/100);
        		$nicim+=$ujed5*($zold_utok+$buj5)*($politika[utok]/100);
				//echo "<font class='text_cerveny'>$nicim";
			else:
				//echo "<script languague='JavaScript'>alert('3')</script>";
				if(($ojed1*($zaznam5["jed1_obrana"]+$boj1))>=$utok):
					$zojed1=Round($utok/($zaznam5["jed1_obrana"]+$boj1));

					$zojed1=Round($zojed1*$ztr);
					$ojed1-=$zojed1;
					$zojed5=0;

					$zujed1=Round($ujed1*$ztru);
					$ujed1=Round($ujed1*(1-$ztru));
					$zujed5=Round($ujed5*$ztru);
					$ujed5-=$zujed5;

				else:
				//echo "<script languague='JavaScript'>alert('3')</script>";
					$a=$utok;
					$a-=$ojed1*($zaznam5["jed1_obrana"]+$boj1);
					$zojed1=Round($ojed1*$ztr);
					$ojed1-=$zojed1;

					$zojed5=Round($a/(($zold_obrana+$boj5)));
					$zojed5=Round($zojed5*$ztr);
					$ojed5-=$zojed5;

					$zujed1=Round($ujed1*$ztru);
					$ujed1=Round($ujed1*(1-$ztru));
					$zujed5=Round($ujed5*$ztru);
					$ujed5-=$zujed5;
				endif;
				$us=0;
			endif;
//*****************************************************texty_partizan-begin*********************************************

?>
<SCRIPT language=JavaScript>
	<!--  
var blaf="pa1";
var prodlevapa;
 	function pautok(){
	if(blaf=="pa4"){document.all.item(blaf).style.visibility = "visible";blaf="pa999";}
	if(blaf=="pa3"){document.all.item(blaf).style.visibility = "visible";blaf="pa4";}
	if(blaf=="pa2"){document.all.item(blaf).style.visibility = "visible";blaf="pa3";}
	if(blaf=="pa1"){document.all.item(blaf).style.visibility = "visible";blaf="pa2";}
  //alert(bla);
	prodlevapa=setTimeout("pautok()",7000);
	}
	//-->
</SCRIPT>

<?
      $ztraty=$ztratyj=0;
      if($tu1>0){$ztraty+=$ujed1/($tu1/100);};
      if($tu5>0){$ztraty+=$ujed5/($tu5/100);};
      if($to1>0){$ztratyj+=$ojed1/($to1/100);};
      if($to5>0){$ztratyj+=$ojed5/($to5/100);};

      $ztraty/=2;
      $ztraty=Round($ztraty);
      $ztraty=100-$ztraty;
      if($tu5==0 and $tu1=0){$ztraty=0;};

      $ztratyj/=2;
      $ztratyj=Round($ztratyj);
      $ztratyj=100-$ztratyj;
      if($to5==0 and $to1=0){$ztratyj=0;};

      echo "<font class='text_bili'>";
		  echo "<center><h6><font class=text_modry>Z</font>pr·vy z partiz·nskÈho ˙toku</h6></center>";
			include("texty_partizan.php");
      echo "</font>";
//****************************************************texty-end****************************************
//*********************************************vyhodnocenÌ partiz·n˘********************************************
    	do{

			$vys99 = MySQL_Query("SELECT den FROM utok");

			$dat = Date("G:i:s j.m.Y");
			if($us==1):
		        $zniceno=Round($nicim/$konpar);
				$rzl=rand(61,159);
        $l=$zaznam6["lidi"]-$zniceno*$rzl;
				$l=Floor($l);
				$s=$zaznam6["vyrobna"]-$zniceno;
		        $s=Floor($s);
				if($l<0){$l=0;};
				if($s<0){$s=0;}
				$lz=$zaznam6[lidi]-$l;
				$sz=$zaznam6[vyrobna]-$s;
        		$kl=Floor($lz/1);

		        $ucinek="PÏchota zabila ".$lz." lidÌ a zniËila ".$sz." v˝roben.";

				MySQL_Query("update planety set lidi='$l',vyrobna='$s' where (cislo='$cisloplan' and cislomaj='$cislocil')");
        		$zemhrd=rand(1,20);
		        if($zemhrd==19 and ($obr[cislo]>1000000)):
        			$smrt=$obr[smrt]+1;
		   			MySQL_Query("update hrdinove set smrt=$smrt,mrtev=1 where cislo=$cisloo");         
        			echo "<h6>Nep¯·telsk˝ hrdina ".$obr[jmeno].", kter˝ byl na ".$obr[level]." . ˙rovni, byl v bitvÏ zabit</h6>";
		        endif;

		$zaznamut1 = MySQL_Query("SELECT utoceno FROM uzivatele where jmeno='$cil'");
		$zaznamut = MySQL_Fetch_Array($zaznamut1);

				$dobyl_part=$zaznam1[dobyl_part]+1;
				MySQL_Query("update uzivatele set dobyl_part=$dobyl_part where cislo=$logcislo");

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo = $cislocil");


    		else:
		        $ucinek="é·dnÈ";
        		$zemhrd=rand(1,20);
		        if($zemhrd==19 and ($dob[cislo]>1000000)):
        			$smrt=$dob[smrt]+1;
	     			MySQL_Query("update hrdinove set smrt=$smrt,mrtev=1 where cislo=$cislod");
    			    echo "<h6>N·ö hrdina ".$dob[jmeno].", kter˝ byl na ".$dob[level]." . ˙rovni, byl v bitvÏ zabit</h6>";
				endif;	
			endif;

			while ($zaznam99 = MySQL_Fetch_Array($vys99)):
				if($zaznam99["den"]==$dat){$spatne=1;break;};
			endwhile;
			if($spatne==1){echo "<font class='text_cerveny'>Datab·ze je p¯etÌûena, zkuste za˙toËit pozdÏji</font>";break;};

			$ujed1+=$zaznam1["jed1"];
			$ujed1-=$jednot1;
			$ujed5+=$zaznam1["jed5"];
			$ujed5-=$jednot5;

			if($ujed1<0){$ujed1=0;};
			if($ujed5<0){$ujed5=0;};
			if($ojed1<0){$ojed1=0;};
			if($ojed5<0){$ojed5=0;};

			$den = Date("U");
			//echo "<script languague='JavaScript'>alert(".$ujed1.")</script>";
			//echo "<script languague='JavaScript'>alert(".$ujed2.")</script>";

			MySQL_Query("update uzivatele set jed1=$ujed1,jed5=$ujed5 where cislo=$logcislo");
			MySQL_Query("update uzivatele set jed1=$ojed1,jed5=$ojed5 where cislo=$cislocil");
			
			$vys111 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam111 = MySQL_Fetch_Array($vys111);
			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
			$politika2 = MySQL_Fetch_Array($politika22);
			$politika11 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika1 = MySQL_Fetch_Array($politika11);
			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys51 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam51 = MySQL_Fetch_Array($vys51);
			$vys4 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislocil");
			$zaznam4 = MySQL_Fetch_Array($vys4);
			$vys44 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam4[narod]");
			$zaznam44 = MySQL_Fetch_Array($vys44);
			$vys444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam4[zrizeni]");
			$zaznam444 = MySQL_Fetch_Array($vys444);
			$vys14 = MySQL_Query("SELECT * FROM uzivatele where cislo = $logcislo");
			$zaznam14 = MySQL_Fetch_Array($vys14);
			$vys144 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam111[narod]");
			$zaznam144 = MySQL_Fetch_Array($vys144);
			$vys1444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam111[zrizeni]");
			$zaznam1444 = MySQL_Fetch_Array($vys1444);


			$u1=$zaznam111["jed1"]*$zaznam51["jed1_utok"];
			$u1+=$zaznam111["jed2"]*$zaznam51["jed2_utok"];
			$u1+=$zaznam111["jed4"]*$zaznam51["jed4_utok"];
			$u1+=$zaznam111["jed5"]*$zold_utok;
			$u1*=$politika1[utok]/100;
			$u1*=$zaznam144[utok]/100;
			$u1*=$zaznam1444[utok]/100;
			$u2+=$zaznam111["jed1"]*$zaznam51["jed1_obrana"];
			$u2+=$zaznam111["jed2"]*$zaznam51["jed2_obrana"];
			$u2+=$zaznam111["jed4"]*$zaznam51["jed4_obrana"];
			$u2+=$zaznam111["jed5"]*$zold_obrana;
			$u2*=$politika1[obrana]/100;
			$u2*=$zaznam44[obrana]/100;
			$u2*=$zaznam444[obrana]/100;
			
			$u=$u1+$u2;

			$o1=$zaznam4["jed1"]*$zaznam5["jed1_utok"];
			$o1+=$zaznam4["jed2"]*$zaznam5["jed2_utok"];
			$o1+=$zaznam4["jed4"]*$zaznam5["jed4_utok"];
			$o1+=$zaznam4["jed5"]*$zold_utok;
			$o1*=$politika2[utok]/100;
			$o1*=$zaznam44[utok]/100;
			$o1*=$zaznam444[utok]/100;
			$o2+=$zaznam4["jed1"]*$zaznam5["jed1_obrana"];
			$o2+=$zaznam4["jed2"]*$zaznam5["jed2_obrana"];
			$o2+=$zaznam4["jed4"]*$zaznam5["jed4_obrana"];
			$o2+=$zaznam4["jed5"]*$zold_obrana;
			$o2*=$politika2[obrana]/100;
			$o2*=$zaznam44[obrana]/100;
			$o2*=$zaznam444[obrana]/100;
			
			$o=$o1+$o2;


			MySQL_Query("update uzivatele set sila = '$u' where cislo='$logcislo'");			
			MySQL_Query("update uzivatele set sila = '$o' where cislo='$cislocil'");
      $naconazev=addslashes($naconazev);			
			MySQL_Query("INSERT INTO utok (den,utocnik,obrance,planety,uspesnost,ujed1,ujed5,ojed1,ojed5,urasa,orasa,typ,ucinek)VALUES ('$den','$logjmeno','$cil','$naconazev','$us','$zujed1','$zujed5','$zojed1','$zojed5','$rasa1','$rasa2',2,'$ucinek')");
			MySQL_Query("update uzivatele set poslutok=$den where cislo=$logcislo");
			//MySQL_Close($spojeni);
			//echo "<script languague='JavaScript'>location.href='hlavni.php?page=info'</script>";
      echo "<center><h6><a href='hlavni.php?page=info' title='info'>PokraËovat na info</a></h6></center>";
      exit;
			}while(false);
//**************************************************************************************************************


//****************************************************orbitalni ˙tok**********************************************
//**************************************************************************************************************
   elseif($jakej==4):
			//echo "<script languague='JavaScript'>alert('11')</script>";
			if($jednot4>$zaznam1[jed4])
				{echo "<font class='text_cerveny'>Tolik jednotek nem·te...</font>";break;};
			$jednot4=$jednot4;

			if(($jednot4<=0) or ($jednot4!=$jednot4*1))
				{echo "<font class='text_cerveny'>MusÌte vyslat alespoÚ jednu jednotku...</font>";break;};
      //if($jednot4=0)
        //{echo "<font class='text_cerveny'>MusÌte poslat do ˙toku aspoÚ jednu jednotku...</font>";break;};

			
			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys6 = MySQL_Query("SELECT * FROM planety where cislo=$cisloplan");
			$zaznam6 = MySQL_Fetch_Array($vys6);
			$naconazev=$zaznam6[nazev];		
			$typp=$zaznam6[typ];

			$plan = MySQL_Query("SELECT typ,obrana FROM typp where typ = '$typp'");				
			$pla = MySQL_Fetch_Array($plan);

			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
			$politika2 = MySQL_Fetch_Array($politika22);

			$tu4=$ujed4=$jednot4;
			$to4=$ojed4=$zaznam4["jed4"];
			$to2=$ojed2=$zaznam4["jed2"];


			$cisloplan=$naco;
			$buj4=$zaznam2["jed4_utok"]*$bonus+$zaznam2["jed4_utok"]*(1-($narod[utok]/100))+$zaznam2["jed4_utok"]*(1-($zriz[utok]/100));
		    $buj4+=$zaznam2["jed4_utok"]*$bdob;
			
			$boj4=$zaznam5["jed4_obrana"]*($pla[obrana]/100)+$zaznam5["jed4_obrana"]*(1-($jpolitika[obrana]/100));
			$boj4+=$zaznam5["jed4_obrana"]*(1-($jnarod[obrana]/100))+$zaznam5["jed4_obrana"]*(1-($jzriz[obrana]/100));
			$boj4+=$zaznam5["jed4_obrana"]*$bobr;

			$boj1=$zaznam5["jed2_obrana"]*($pla[obrana]/100)+$zaznam5["jed2_obrana"]*(1-($jpolitika[obrana]/100));
			$boj1+=$zaznam5["jed2_obrana"]*(1-($jnarod[obrana]/100))+$zaznam5["jed2_obrana"]*(1-($jzriz[obrana]/100));
			$boj1+=$zaznam5["jed2_obrana"]*$bobr;


			if($zaznam6[brana]==1):
				$boj4-=$zaznam5["jed4_obrana"]*0.5;
				$boj1-=$zaznam5["jed2_obrana"]*0.5;
			endif;
        
			$utok=$ujed4*($zaznam2["jed4_utok"]+$buj4);
			$utok*=$politika[utok]/100;

			$obrana=$ojed4*($zaznam5["jed4_obrana"]+$boj4);
			$obrana+=$ojed2*($zaznam5["jed2_obrana"]+$boj2);	
			$obrana*=$politika2[obrana]/100;

			if($utok==$obrana):
				//echo "<script languague='JavaScript'>alert('1')</script>";
				$zujed4=Round($ujed4*$ztru);
				$ujed4-=$zujed4;

				$zojed4=Round($ojed4*$ztr);
				$ojed4-=$zojed4;
				$zojed2=Round($ojed2*$ztr);
				$ojed2-=$zojed2;
				$us=0;				
			elseif($utok>$obrana):
				//echo "<script languague='JavaScript'>alert('2')</script>";
				if(($ujed4*($zaznam2["jed4_utok"]+$buj4))>=$obrana):
					$zujed4=Round(($obrana/(($zaznam2["jed4_utok"]+$buj4)*$politika[utok]/100))*$ztru);
					$ujed4-=$zujed4;

					$zojed4=Round($ojed4*$ztr);
					$ojed4-=$zojed4;
					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;
				else:
					$a=$obrana;
					$a-=$ujed4*($zaznam2["jed4_utok"]+$buj4);
					$zujed4=Round($ujed4*$ztru);
					$ujed4-=Round($ujed4*$ztru);


					$zojed4=Round($ojed4*$ztr);
					$ojed4-=$zojed4;
					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;
		        endif;
				$us=1;
        		$nicim=$ujed4*($zaznam2["jed4_utok"]+$buj4)*($politika[utok]/100);
				//echo "<font class='text_cerveny'>$nicim";
			else:
				//echo "<script languague='JavaScript'>alert('3')</script>";
				if(($ojed4*($zaznam5["jed4_obrana"]+$boj4))>=$utok):
					$zojed4=Round($utok/($zaznam5["jed4_obrana"]+$boj4));

					$zojed4=Round($zojed4*$ztr);
					$ojed4-=$zojed4;
					$zojed2=0;

					$zujed4=Round($ujed4*$ztru);
					$ujed4=Round($ujed4*(1-$ztru));
					$zujed2=Round($ujed2*$ztru);
					$ujed2-=$zujed2;

				else:
				//echo "<script languague='JavaScript'>alert('3')</script>";
					$a=$utok;
					$a-=$ojed4*($zaznam5["jed4_obrana"]+$boj4);
					$zojed4=Round($ojed4*$ztr);
					$ojed4-=$zojed4;

					$zojed2=Round($a/(($zaznam5["jed2_obrana"]*2+$boj2)));
					$zojed2=Round($zojed2*$ztr);
					$ojed2-=$zojed2;

					$zujed4=Round($ujed4*$ztru);
					$ujed4=Round($ujed4*(1-$ztru));
				endif;
				$us=0;
			endif;
//*********************************************vyhodnocenÌ orbitu********************************************
    	do{

			$vys99 = MySQL_Query("SELECT den FROM utok");

			$dat = Date("G:i:s j.m.Y");
			if($us==1):
		          $zniceno=Round($nicim/$konpar);
				//$l=$zaznam6["lidi"]-$zniceno*100;
				//$l=Floor($l);
				$m=$zaznam6["mesta"]-$zniceno/100;
		    //$o=$zaznam4[jed4]-$jed4*100;
						$m=Floor($m);
						//$o=Floor($o);
				//if($o<0){$o=0;};
        //if($l<0){$l=0;};
				if($m<0){$m=0;}
				//$oz=$zaznam4[jed4]-$o;
        //$lz=$zaznam6[lidi]-$l;
				$mz=$zaznam6[mesta]-$m;
        		//$al=Floor($lz/1000);
        		$ucinek="N·letem na plantu bylo zniËeno ".$mz." mÏst";
			 MySQL_Query("update planety set mesta=$m where (cislo=$cisloplan and cislomaj=$cislocil)");
       //MySQL_Query("update uzivatele set jed4=$o where jmeno='$cilocil'"); 		
            $zemhrd=rand(1,20);
		        if($zemhrd==19 and ($obr[cislo]>1000000)):
        			$smrt=$obr[smrt]+1;
		   			MySQL_Query("update hrdinove set smrt=$smrt,mrtev=1 where cislo=$cisloo");         
    		    echo "<h6>Nep¯·telsk˝ hrdina ".$obr[jmeno].", kter˝ byl na ".$obr[level]." . ˙rovni, byl v bitvÏ zabit</h6>";
		        endif;
				$dobyl_orb=$zaznam1[dobyl_orb]+1;
				MySQL_Query("update uzivatele set dobyl_orb=$dobyl_orb where cislo=$logcislo");

		$zaznamut1 = MySQL_Query("SELECT utoceno FROM uzivatele where jmeno='$cil'");
		@$zaznamut = MySQL_Fetch_Array($zaznamut1);

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo = $cislocil");
        else:
		        $ucinek="é·dnÈ";
        		$zemhrd=rand(1,20);
		        if($zemhrd==19 and ($dob[cislo]>1000000)):
        			$smrt=$dob[smrt]+1;
	     			MySQL_Query("update hrdinove set smrt=$smrt,mrtev=1 where cislo=$cislod");
    			    echo "<h6>N·ö hrdina ".$dob[jmeno].", kter˝ byl na ".$dob[level]." . ˙rovni, byl v bitvÏ zabit</h6>";
				endif;	
			endif;

			while ($zaznam99 = MySQL_Fetch_Array($vys99)):
				if($zaznam99["den"]==$dat){$spatne=1;break;};
			endwhile;
			if($spatne==1){echo "<font class='text_cerveny'>dtb je p¯etÌûena, zkusme za˙toËit pozdÏji</font>";break;};

			$ujed4+=$zaznam2["jed4"];
			$ujed4-=$jednot4;
      
      $utjed4=$zaznam1["jed4"]-$zujed4;
      
			if($ujed4<0){$ujed4=0;};
			if($ojed4<0){$ojed4=0;};
			if($ojed2<0){$ojed2=0;};

			$den = Date("U");
			//echo "<script languague='JavaScript'>alert(".$ujed2.")</script>";
			//echo "<script languague='JavaScript'>alert(".$ujed2.")</script>";

			MySQL_Query("update uzivatele set jed4=$utjed4 where cislo=$logcislo");
			MySQL_Query("update uzivatele set jed4=$ojed4,jed2=$ojed2 where cislo=$cislocil");
			
			$vys111 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam111 = MySQL_Fetch_Array($vys111);
			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
			$politika2 = MySQL_Fetch_Array($politika22);
			$politika11 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika1 = MySQL_Fetch_Array($politika11);
			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys51 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam51 = MySQL_Fetch_Array($vys51);
			$vys4 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislocil");
			$zaznam4 = MySQL_Fetch_Array($vys4);
			$vys44 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam4[narod]");
			$zaznam44 = MySQL_Fetch_Array($vys44);
			$vys444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam4[zrizeni]");
			$zaznam444 = MySQL_Fetch_Array($vys444);
			$vys14 = MySQL_Query("SELECT * FROM uzivatele where cislo = $logcislo");
			$zaznam14 = MySQL_Fetch_Array($vys14);
			$vys144 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam111[narod]");
			$zaznam144 = MySQL_Fetch_Array($vys144);
			$vys1444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam111[zrizeni]");
			$zaznam1444 = MySQL_Fetch_Array($vys1444);


			$u1=$zaznam111["jed1"]*$zaznam51["jed1_utok"];
			$u1+=$zaznam111["jed2"]*$zaznam51["jed2_utok"];
			$u1+=$zaznam111["jed4"]*$zaznam51["jed4_utok"];
			$u1+=$zaznam111["jed5"]*$zold_utok;
			$u1*=$politika1[utok]/100;
			$u1*=$zaznam144[utok]/100;
			$u1*=$zaznam1444[utok]/100;
			$u2+=$zaznam111["jed1"]*$zaznam51["jed1_obrana"];
			$u2+=$zaznam111["jed2"]*$zaznam51["jed2_obrana"];
			$u2+=$zaznam111["jed4"]*$zaznam51["jed4_obrana"];
			$u2+=$zaznam111["jed5"]*$zold_obrana;
			$u2*=$politika1[obrana]/100;
			$u2*=$zaznam44[obrana]/100;
			$u2*=$zaznam444[obrana]/100;
			
			$u=$u1+$u2;

			$o1=$zaznam4["jed1"]*$zaznam5["jed1_utok"];
			$o1+=$zaznam4["jed2"]*$zaznam5["jed2_utok"];
			$o1+=$zaznam4["jed4"]*$zaznam5["jed4_utok"];
			$o1+=$zaznam4["jed5"]*$zold_utok;
			$o1*=$politika2[utok]/100;
			$o1*=$zaznam44[utok]/100;
			$o1*=$zaznam444[utok]/100;
			$o2+=$zaznam4["jed1"]*$zaznam5["jed1_obrana"];
			$o2+=$zaznam4["jed2"]*$zaznam5["jed2_obrana"];
			$o2+=$zaznam4["jed4"]*$zaznam5["jed4_obrana"];
			$o2+=$zaznam4["jed5"]*$zold_obrana;
			$o2*=$politika2[obrana]/100;
			$o2*=$zaznam44[obrana]/100;
			$o2*=$zaznam444[obrana]/100;
			
			$o=$o1+$o2;

			MySQL_Query("update uzivatele set sila = $u where cislo=$logcislo");			
			MySQL_Query("update uzivatele set sila = $o where cislo=$cislocil");

      $naconazev=addslashes($naconazev);			
			MySQL_Query("INSERT INTO utok (den,utocnik,obrance,planety,uspesnost,ujed4,ujed2,ojed4,ojed2,urasa,orasa,typ,ucinek)VALUES ($den,'$logjmeno','$cil','$naconazev',$us,'$zujed4','$zujed2','$zojed4','$zojed2','$rasa1','$rasa2',4,'$ucinek')");
			MySQL_Query("update uzivatele set poslutok=$den where cislo=$logcislo");
			//MySQL_Close($spojeni);
			//echo "<script languague='JavaScript'>location.href='hlavni.php?page=info'</script>";
      echo "<center><h6><a href='hlavni.php?page=info' title='info'>PokraËovat na info</a></h6></center>";
      exit;
			}while(false);
//**************************************************************************************************************

//****************************************************˙tok spionu**********************************************
//**************************************************************************************************************
   elseif($jakej==7):
			//echo "<script languague='JavaScript'>alert('11')</script>";
			if($jednot7>$zaznam1[jed7])
				{echo "<font class='text_cerveny'>Tolik jednotek nem·te</font>";break;};
			$jednot7=$jednot7;

			if(($jednot7<100) or ($jednot7!=$jednot7*1 or ($jednot7>6000)))
				{echo "<font class='text_cerveny'>PoËet vyslan˝ch jednotek musÌ b˝t v rozmezÌ 100 aû 6000 a nesmÌ b˝t pouûito desetinnÈ ËÌslo...</font>";exit;};
			
			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys6 = MySQL_Query("SELECT * FROM planety where cislo=$cisloplan");
			$zaznam6 = MySQL_Fetch_Array($vys6);
			$naconazev=$zaznam6[nazev];		
			$typp=$zaznam6[typ];

			$plan = MySQL_Query("SELECT typ,obrana FROM typp where typ = '$typp'");				
			$pla = MySQL_Fetch_Array($plan);

    	do{

			$vys99 = MySQL_Query("SELECT den FROM utok");

			$dat = Date("G:i:s j.m.Y");
			$nadk=rand(1,50);
			$podk=rand(1,20);
      if ($jednot7>999){$kat3=($jednot7/$nadk);}
      if ($jednot7<1000){$kat3=($jednot7/$podk);}
      //$kat4=$kat3*(rand(1,50)/100);
      ///if ($kat3>1){$kat3=1;}
      //$zemrelout=$jednot7*$kat3;
      if ($kat3>$jednot7){$kat3=$jednot7;}
      $proslo=$jednot7-$kat3;

      $us=rand(0,1);
//      if ($proslo=0){$us=0;}
//      if ($proslo>0){$us=rand(0,1);}
      if ($zaznam6[brana]=="1"){$hb="je na nÌ HvÏzdn· br·na";}
      if ($zaznam6[brana]=="0"){$hb="nenÌ na nÌ HvÏzdn· br·na";}
			if ($us==1):
			  if ($proslo<200){$nahoda2=rand(0,1);}
			  if ($proslo>200 and $proslo<501){$nahoda2=rand(0,3);}
			  if ($proslo>500 and $proslo<1001){$nahoda2=rand(4,10);}
			  if ($proslo>1000 and $proslo<2501){$nahoda2=rand(9,12);}
			  if ($proslo>2500 and $proslo<4001){$nahoda2=rand(12,16);}
			  if ($proslo>4000){$nahoda2=rand(14,17);}
				  switch($nahoda2){
					 case 0:  $ucinek= "Agenti zjistili nÏjakÈ informace, ale nedok·zali je kv˘li atmosferick˝m poruch·m odeslat ";$kat=0.3;$kat2=0.1;break;
                                         case 1:    	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[lidi] lidÌ";$kat=0.2;$kat2=0.1;break;
					 case 2:	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[vyrobna] v˝roben";$kat=0.25;$kat2=0.05;break;
					 case 3:	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[kasarna] kas·ren";$kat=0.4;$kat2=0.1;break;
					 case 4:	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[mesta] mÏst a $zaznam6[vyrobna] v˝roben";$kat=0.3;$kat2=0.1;break;
					 case 5:	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[mesta] mÏst a $zaznam6[sdi] obran";$kat=0.4;$kat2=0.05;break;
					 case 6:	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[laborator] laborato¯Ì a $hb";$kat=0.7;$kat2=0.05;break;
 					 case 7:  $ucinek= "Agenti nedok·zali kv˘li atmosferick˝m poruch·m odeslat zpr·vu";$kat=0.3;$kat2=0.0;break;
 					 case 8:  $ucinek= "Agenti nepodali û·dnou zpr·vu kv˘li z·vadÏ na komunikaËnÌm za¯ÌzenÌ";$kat=0.2;$kat2=0.1;break;
 					 case 9:  $ucinek= "Agenti nepodali û·dnou zpr·vu kv˘li z·vadÏ na komunikaËnÌm za¯ÌzenÌ";$kat=0.1;$kat2=0.05;break;
 					 case 10: $ucinek= "Agenti nedok·zali kv˘li atmosferick˝m poruch·m odeslat zpr·vu";$kat=0.25;$kat2=0.1;break;
					 case 11:	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[sdi] obran a $hb";$kat=0.7;$kat2=0.1;break;
					 case 12:	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[pol] policejnÌch stanic a $hb";$kat=0.6;$kat2=0.1;break;
					 case 13:	$ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[lidi] lidÌ a $zaznam6[pol] policejnÌch stanic a $zaznam6[mesta] mÏst";$kat=0.8;$kat2=0.1;break;
					 case 14: $ucinek= "Na planetÏ $naconazev bylo zjiötÏno $zaznam6[sdi] obran a $zaznam6[pol] policejnÌch stanic";$kat=1;$kat2=0;break;
 					 case 15: $ucinek= "Agenti zjistili nÏjakÈ informace, ale nedok·zali je kv˘li atmosferick˝m poruch·m odeslat ";$kat=0.3;$kat2=0.1;break;
 					 case 16: $ucinek= "Agent˘m se poda¯ilo nÏco zjistit, ale neposlali û·dnou zpr·vu kv˘li z·vadÏ na komunikaËnÌm za¯ÌzenÌ";$kat=0.2;$kat2=0.1;break;
 					 case 17: $ucinek= "Agenti zjistili ûe planeta $naconazev je $zaznam6[typ] a je na nÌ $zaznam6[mesta] mÏst a $hb";$kat=0.6;$kat2=0.1;break;
          };
       else: $ucinek=" äpioni neuspÏli";
   		//if ($us=0){$kat3=$jednot7*(rand(40,70)/100);}

   		endif;
        $zuut=($zaznam1[jed7]-$kat3);
        if ($zemrelout>$jednot7){$zemrelout=$jednot7;}

			$vys54 = MySQL_Query("SELECT dobyl_age FROM uzivatele where cislo = $logcislo");
			$zaznam54 = MySQL_Fetch_Array($vys54);

				$dobyl_age=$zaznam54[dobyl_age]+1;
				MySQL_Query("update uzivatele set dobyl_age = $dobyl_age where cislo = $logcislo");

		$zaznamut1 = MySQL_Query("SELECT utoceno FROM uzivatele where jmeno='$cil'");
		$zaznamut = MySQL_Fetch_Array($zaznamut1);

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo = $cislocil");

			while ($zaznam99 = MySQL_Fetch_Array($vys99)):
				if($zaznam99["den"]==$dat){$spatne=1;break;};
			endwhile;
			if($spatne==1){echo "<font class='text_cerveny'>dtb je p¯etÌûena, zkusme za˙toËit pozdÏji</font>";break;};


			$den = Date("U");

			MySQL_Query("update uzivatele set jed7=$zuut where cislo=$logcislo");
//			MySQL_Query("update uzivatele set jed7=$zuob where cislo=$cislocil");
			
			$naconazev=addslashes($naconazev);			
			MySQL_Query("INSERT INTO utok (den,utocnik,obrance,planety,uspesnost,ujed1,ojed1,urasa,orasa,typ,ucinek)VALUES ($den,'$logjmeno','$cil','$naconazev',$us,$kat3,'0','$rasa1','$rasa2',7,'$ucinek')");
			MySQL_Query("update uzivatele set poslutok=$den where cislo=$logcislo");
      echo "<center><h6><a href='hlavni.php?page=info' title='info'>PokraËovat na info</a></h6></center>";

      exit;
			}while(false);
//**************************************************************************************************************


//****************************************************univerzalni ˙tok**********************************************
//**************************************************************************************************************
   elseif($jakej==3):
			//echo "<script languague='JavaScript'>alert('11')</script>";
			if($jednot2>$zaznam1[jed2])
				{echo "<font class='text_cerveny'>Tolik jednotek nem·te</font>";break;};

			$jednot2=$jednot2;

			if(($jednot2<=0) or ($jednot2!=$jednot2*1))
				{echo "<font class='text_cerveny'>PoËet vyslan˝ch jednotek musÌ b˝t minim·lnÏ 1 a nesmÌ b˝t pouûito desetinnÈ ËÌslo...</font>";break;};
			
			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys6 = MySQL_Query("SELECT * FROM planety where cislo=$cisloplan");
			$zaznam6 = MySQL_Fetch_Array($vys6);
			$naconazev=$zaznam6[nazev];		
			$typp=$zaznam6[typ];

			$plan = MySQL_Query("SELECT typ,obrana FROM typp where typ = '$typp'");				
			$pla = MySQL_Fetch_Array($plan);

			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
			$politika2 = MySQL_Fetch_Array($politika22);

			$tu2=$ujed2=$jednot2;
			$to2=$ojed2=$zaznam4["jed2"];
			$to5=$ojed5=$zaznam4["jed5"];

/*
		  	$kontrola1 = MySQL_Query("SELECT cislo,nazev,cislomaj FROM planety where (nazev = '$naco')");
  	  		do{
				$i++;
				if($i>50){break;};
		    	$dobre=1;
  		  		$kontrola=MySQL_Fetch_Array($kontrola1);
		    	if($naco==$kontrola[nazev]){$dobre=0;$cisloplan=$kontrola[cislo];};
  	  		}while($dobre);
*/

			$cisloplan=$naco;
			$buj2=$zaznam2["jed2_utok"]*$bonus+$zaznam2["jed2_utok"]*(1-($narod[utok]/100))+$zaznam2["jed2_utok"]*(1-($zriz[utok]/100));
		    $buj2+=$zaznam2["jed2_utok"]*$bdob;
			
			$boj2=$zaznam5["jed2_obrana"]*($pla[obrana]/100)+$zaznam5["jed2_obrana"]*(1-($jpolitika[obrana]/100));
			$boj2+=$zaznam5["jed2_obrana"]*(1-($jnarod[obrana]/100))+$zaznam5["jed2_obrana"]*(1-($jzriz[obrana]/100));
			$boj2+=$zaznam5["jed2_obrana"]*$bobr;

			$boj5=$zold_obrana*($pla[obrana]/100)+$zold_obrana*(1-($jpolitika[obrana]/100));
			$boj5+=$zold_obrana*(1-($jnarod[obrana]/100))+$zold_obrana*(1-($jzriz[obrana]/100));
			$boj5+=$zold_obrana*$bobr;


			if($zaznam6[brana]==1):
				$boj2-=$zaznam5["jed2_obrana"]*0.25;
				$boj5-=$zold_obrana*0.25;
			endif;


			$utok=$ujed2*($zaznam2["jed2_utok"]+$buj2);
			$utok*=$politika[utok]/100;

			$obrana=$ojed2*($zaznam5["jed2_obrana"]+$boj2);
			$obrana+=$ojed5*($zold_obrana+$boj5);	
			$obrana*=$politika2[obrana]/100;

			if($utok==$obrana):
				//echo "<script languague='JavaScript'>alert('1')</script>";
				$zujed2=Round($ujed2*$ztru);
				$ujed2-=$zujed2;

				$zojed2=Round($ojed2*$ztr);
				$ojed2-=$zojed2;
				$zojed5=Round($ojed5*$ztr);
				$ojed5-=$zojed5;
				$us=0;				
			elseif($utok>$obrana):
				//echo "<script languague='JavaScript'>alert('2')</script>";
				if(($ujed2*($zaznam2["jed2_utok"]+$buj2))>=$obrana):
					$zujed2=Round(($obrana/(($zaznam2["jed2_utok"]+$buj2)*$politika[utok]/100))*$ztru);
					$ujed2-=$zujed2;

					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;
				else:
					$a=$obrana;
					$a-=$ujed2*($zaznam2["jed2_utok"]+$buj2);
					$zujed2=Round($ujed2*$ztru);
					$ujed2-=Round($ujed2*$ztru);


					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;
					$zojed5=Round($ojed5*$ztr);
					$ojed5-=$zojed5;
		        endif;
				$us=1;
        		$nicim=$ujed2*($zaznam2["jed2_utok"]+$buj2)*($politika[utok]/100);
				//echo "<font class='text_cerveny'>$nicim";
			else:
				//echo "<script languague='JavaScript'>alert('3')</script>";
				if(($ojed2*($zaznam5["jed2_obrana"]+$boj2))>=$utok):
					$zojed2=Round($utok/($zaznam5["jed2_obrana"]+$boj2));

					$zojed2=Round($zojed2*$ztr);
					$ojed2-=$zojed2;
					$zojed5=0;

					$zujed2=Round($ujed2*$ztru);
					$ujed2=Round($ujed2*(1-$ztru));
					$zujed5=Round($ujed5*$ztru);
					$ujed5-=$zujed5;

				else:
				//echo "<script languague='JavaScript'>alert('3')</script>";
					$a=$utok;
					$a-=$ojed2*($zaznam5["jed2_obrana"]+$boj2);
					$zojed2=Round($ojed2*$ztr);
					$ojed2-=$zojed2;

					$zojed5=Round($a/(($zold_obrana+$boj5)));
					$zojed5=Round($zojed5*$ztr);
					$ojed5-=$zojed5;

					$zujed2=Round($ujed2*$ztru);
					$ujed2=Round($ujed2*(1-$ztru));
				endif;
				$us=0;
			endif;
//*********************************************vyhodnocenÌ univerzalu********************************************
    	do{

			$vys99 = MySQL_Query("SELECT den FROM utok");

			$dat = Date("G:i:s j.m.Y");
			if($us==1):
		          $zniceno=Round($nicim/$konpar);
				//$l=$zaznam6["lidi"]-$zniceno*100;
				//$l=Floor($l);
				$a=$zaznam6["kasarna"]-$zniceno;
		    //$o=$zaznam4[jed4]-$jed4*100;
						$a=Floor($a);
						//$o=Floor($o);
				//if($o<0){$o=0;};
        //if($l<0){$l=0;};
				if($a<0){$a=0;}
				//$oz=$zaznam4[jed4]-$o;
        //$lz=$zaznam6[lidi]-$l;
				$az=$zaznam6[kasarna]-$a;
        		//$al=Floor($lz/1000);
        		$ucinek="˙tokem bylo zniËeno ".$az." kas·ren";
			 MySQL_Query("update planety set kasarna='$a' where (cislo='$cisloplan' and cislomaj='$cislocil')");
       //MySQL_Query("update uzivatele set jed4=$o where jmeno='$cilocil'"); 		
            $zemhrd=rand(1,20);
		        if($zemhrd==19 and ($obr[cislo]>1000000)):
        			$smrt=$obr[smrt]+1;
		   			MySQL_Query("update hrdinove set smrt='$smrt',mrtev=1 where cislo='$cisloo'");         
    		    echo "<h6>Nep¯·telsk˝ hrdina ".$obr[jmeno].", kter˝ byl na ".$obr[level]." . ˙rovni, byl v bitvÏ zabit</h6>";
		        endif;
				$dobyl_uni=$zaznam1[dobyl_uni]+1;
				MySQL_Query("update uzivatele set dobyl_uni='$dobyl_uni' where cislo='$logcislo'");

		$zaznamut1 = MySQL_Query("SELECT utoceno FROM uzivatele where jmeno='$cil'");
		$zaznamut = MySQL_Fetch_Array($zaznamut1);

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo ='$cislocil'");
        else:
		        $ucinek="é·dnÈ";
        		$zemhrd=rand(1,20);
		        if($zemhrd==19 and ($dob[cislo]>1000000)):
        			$smrt=$dob[smrt]+1;
	     			MySQL_Query("update hrdinove set smrt='$smrt',mrtev=1 where cislo='$cislod'");
    			    echo "<h6>N·ö hrdina ".$dob[jmeno].", kter˝ byl na ".$dob[level]." . ˙rovni, byl v bitvÏ zabit</h6>";
				endif;	
			endif;

			while ($zaznam99 = MySQL_Fetch_Array($vys99)):
				if($zaznam99["den"]==$dat){$spatne=1;break;};
			endwhile;
			if($spatne==1){echo "<font class='text_cerveny'>dtb je p¯etÌûena, zkusme za˙toËit pozdÏji</font>";break;};

			$ujed2+=$zaznam2["jed2"];
			$ujed2-=$jednot2;
      
      $utjed2=$zaznam1["jed2"]-$zujed2;
      
			if($ujed2<0){$ujed2=0;};
			if($ojed2<0){$ojed2=0;};
			if($ojed5<0){$ojed5=0;};

			$den = Date("U");
			//echo "<script languague='JavaScript'>alert(".$ujed2.")</script>";
			//echo "<script languague='JavaScript'>alert(".$ujed2.")</script>";

			MySQL_Query("update uzivatele set jed2='$utjed2' where cislo='$logcislo'");
			MySQL_Query("update uzivatele set jed2='$ojed2',jed5='$ojed5' where cislo='$cislocil'");
			
			$vys111 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
			$zaznam111 = MySQL_Fetch_Array($vys111);
			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
			$politika2 = MySQL_Fetch_Array($politika22);
			$politika11 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika1 = MySQL_Fetch_Array($politika11);
			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys51 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam51 = MySQL_Fetch_Array($vys51);
			$vys4 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislocil");
			$zaznam4 = MySQL_Fetch_Array($vys4);
			$vys44 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam4[narod]");
			$zaznam44 = MySQL_Fetch_Array($vys44);
			$vys444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam4[zrizeni]");
			$zaznam444 = MySQL_Fetch_Array($vys444);
			$vys14 = MySQL_Query("SELECT * FROM uzivatele where cislo = $logcislo");
			$zaznam14 = MySQL_Fetch_Array($vys14);
			$vys144 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam111[narod]");
			$zaznam144 = MySQL_Fetch_Array($vys144);
			$vys1444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam111[zrizeni]");
			$zaznam1444 = MySQL_Fetch_Array($vys1444);


			$u1=$zaznam111["jed1"]*$zaznam51["jed1_utok"];
			$u1+=$zaznam111["jed2"]*$zaznam51["jed2_utok"];
			$u1+=$zaznam111["jed4"]*$zaznam51["jed4_utok"];
			$u1+=$zaznam111["jed5"]*$zold_utok;
			$u1*=$politika1[utok]/100;
			$u1*=$zaznam144[utok]/100;
			$u1*=$zaznam1444[utok]/100;
			$u2+=$zaznam111["jed1"]*$zaznam51["jed1_obrana"];
			$u2+=$zaznam111["jed2"]*$zaznam51["jed2_obrana"];
			$u2+=$zaznam111["jed4"]*$zaznam51["jed4_obrana"];
			$u2+=$zaznam111["jed5"]*$zold_obrana;
			$u2*=$politika1[obrana]/100;
			$u2*=$zaznam44[obrana]/100;
			$u2*=$zaznam444[obrana]/100;
			
			$u=$u1+$u2;

			$o1=$zaznam4["jed1"]*$zaznam5["jed1_utok"];
			$o1+=$zaznam4["jed2"]*$zaznam5["jed2_utok"];
			$o1+=$zaznam4["jed4"]*$zaznam5["jed4_utok"];
			$o1+=$zaznam4["jed5"]*$zold_utok;
			$o1*=$politika2[utok]/100;
			$o1*=$zaznam44[utok]/100;
			$o1*=$zaznam444[utok]/100;
			$o2+=$zaznam4["jed1"]*$zaznam5["jed1_obrana"];
			$o2+=$zaznam4["jed2"]*$zaznam5["jed2_obrana"];
			$o2+=$zaznam4["jed4"]*$zaznam5["jed4_obrana"];
			$o2+=$zaznam4["jed5"]*$zold_obrana;
			$o2*=$politika2[obrana]/100;
			$o2*=$zaznam44[obrana]/100;
			$o2*=$zaznam444[obrana]/100;
			
			$o=$o1+$o2;


			MySQL_Query("update uzivatele set sila = $u where cislo=$logcislo");			
			MySQL_Query("update uzivatele set sila = $o where cislo=$cislocil");
      $naconazev=addslashes($naconazev);			
			MySQL_Query("INSERT INTO utok (den,utocnik,obrance,planety,uspesnost,ujed2,ujed5,ojed2,ojed5,urasa,orasa,typ,ucinek)VALUES ($den,'$logjmeno','$cil','$naconazev',$us,'$zujed2','$zujed5','$zojed2','$zojed5','$rasa1','$rasa2',3,'$ucinek')");
			MySQL_Query("update uzivatele set poslutok=$den where cislo=$logcislo");
			//MySQL_Close($spojeni);
			//echo "<script languague='JavaScript'>location.href='hlavni.php?page=info'</script>";
      echo "<center><h6><a href='hlavni.php?page=info' title='info'>PokraËovat na info</a></h6></center>";
      exit;
			}while(false);
//**************************************************************************************************************

//****************************************************politick˝ ˙tok**********************************************
	  elseif($jakej==8):
	     $jednot8=$jednot8*1;

			if($jednot8>($zaznam1[jed8])){echo "<font class='text_cerveny'>Tolik jednotek nem·te...</font>";exit;};
			if(Is_double($jednot8)){echo "<font class='text_cerveny'>NesmÌ b˝t pouûito desetinnÈ ËÌslo!</font>";exit;};
      		$i=0;
			$cisloplan=$naco;

	    $vys81 = MySQL_Query("SELECT penize FROM uzivatele where cislo=$logcislo");
			$zaznam81 = MySQL_Fetch_Array($vys81);

      $vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys6 = MySQL_Query("SELECT * FROM planety where cislo=$cisloplan");
			$zaznam6 = MySQL_Fetch_Array($vys6);	

	    $vys61 = MySQL_Query("SELECT * FROM rasy where rasa='$rasa1'");
			$zaznam61 = MySQL_Fetch_Array($vys61);
      $prevod=$zaznam61[vyr_vyrob]/$zaznam5[vyr_vyrob];
			
			$naconazev=$zaznam6[nazev];		

			$celj8=$jed8=$jednot8;
			do{
			$vys99 = MySQL_Query("SELECT den FROM utok");

			$dat = Date("G:i:s j.m.Y");
			
			while ($zaznam99 = MySQL_Fetch_Array($vys99)):
				if($zaznam99["den"]==$dat){$spatne=1;break;};
			endwhile;
			if($spatne==1){echo "<font class='text_cerveny'>Br·na je p¯etÌûena, za˙toË pozdÏji</font>";break;};
				$znici=$zaznam5[pol_ucinek]*$zaznam6[pol];
				$jed8-=$znici;
      if ($jed8<0){$jed8=0;}
			if($jed8>0):
						$zl=500;//zabije 12 lidÌ
						$l=$zaznam6[lidi]-$jed8*$zl;
						$pridat=$jed8*$zl;
						if($l<0){$l=0;$pridat=$zaznam6[lidi];};
						$vys3 = MySQL_Query("SELECT * FROM planety where majitel = '$logjmeno'");
						$hotovo=0;
						while($zaznam3 = MySQL_Fetch_Array($vys3)):
							$max=$zaznam3[mesta]*$zaznam2[mes_lidi];
							$bude=$je=$zaznam3[lidi];
							$nazev=$zaznam3[nazev];
							if($max>$je):
								$chce=$max-$je;
								if(($pridat-$chce)>0):
									$pridat-=$chce;
									$bude=$max;
								else:
									$bude=$je+$pridat;
									$hotovo=1;
								endif;
							endif;
							MySQL_Query("update planety set lidi=$bude where nazev = '$nazev'");
							if($hotovo==1){break;};						
						endwhile;
						MySQL_Query("update planety set lidi=$l where cislo=$cisloplan");
						$lz=$zaznam6[lidi]-$l;
						$ucinek=" Agit·to¯i p¯esvÏdËili ".number_format($lz,0,"."," ")." lidÌ, kte¯i s nimi odeöli";
//						break;

		    $us=1;
			     else:
				    $us=0;
				    $ucinek="nic";
			   endif;
	       $dobyl_lid=$zaznam1[dobyl_lid]+1;
			   MySQL_Query("update uzivatele set dobyl_lid=$dobyl_lid where cislo='$logcislo'");

		$zaznamut1 = MySQL_Query("SELECT utoceno FROM uzivatele where jmeno='$cil'");
		$zaznamut = MySQL_Fetch_Array($zaznamut1);

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo = $cislocil");
			
      $qz=$zaznam1["jed8"]-$jednot8;
			$zz8=$jednot8-$jed8;
			if ($zz8>$jednot8) {$zz8=$jednot8;};
      $qj=$qz+$jed8;
			$den = Date("U");
			$naconazev=addslashes($naconazev);

			MySQL_Query("update uzivatele set jed8 = $qj where cislo=$logcislo");
			MySQL_Query("INSERT INTO utok (den,utocnik,obrance,planety,uspesnost,ujed8,zujed8,urasa,orasa,typ,ucinek)VALUES
			                                   ($den,'$logjmeno','$cil','$naconazev',$us,'$jednot8','$zz8','$rasa1','$rasa2',8,'$ucinek')");
      MySQL_Query("update uzivatele set poslutok=$den where cislo=$logcislo");
      echo "<center><h6><a href='hlavni.php?page=info' title='info'>PokraËovat na info</a></h6></center>";
      exit;
      }while(false);

//***************************************************konec politickeho utoku****************************************
//****************************************************policejni ˙tok**********************************************
	  elseif($jakej==5):
	     $jednot6=$jednot6*1;

			if($jednot6>($zaznam1[jed6])){echo "<font class='text_cerveny'>Tolik jednotek nem·te...</font>";exit;};
			if(Is_double($jednot6)){echo "<font class='text_cerveny'>NesmÌ b˝t pouûito desetinnÈ ËÌslo!</font>";exit;};
      		$i=0;
			$cisloplan=$naco;

	    $vys81 = MySQL_Query("SELECT penize FROM uzivatele where cislo=$logcislo");
			$zaznam81 = MySQL_Fetch_Array($vys81);

      $vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys6 = MySQL_Query("SELECT * FROM planety where cislo=$cisloplan");
			$zaznam6 = MySQL_Fetch_Array($vys6);	

	    $vys61 = MySQL_Query("SELECT * FROM rasy where rasa='$rasa1'");
			$zaznam61 = MySQL_Fetch_Array($vys61);
	    //$vys71 = MySQL_Query("SELECT penize FROM rasy where rasa='$rasa2'");
			//$zaznam71 = MySQL_Fetch_Array($vys71);
      $prevod=$zaznam61[vyr_vyrob]/$zaznam5[vyr_vyrob];
			
			$naconazev=$zaznam6[nazev];		

			$celj6=$jed6=$jednot6;
			do{
			$vys99 = MySQL_Query("SELECT den FROM utok");

			$dat = Date("G:i:s j.m.Y");
			
			while ($zaznam99 = MySQL_Fetch_Array($vys99)):
				if($zaznam99["den"]==$dat){$spatne=1;break;};
			endwhile;
			if($spatne==1){echo "<font class='text_cerveny'>Br·na je p¯etÌûena, za˙toË pozdÏji</font>";break;};
      		//$jed6*=$bnic;
//			if($rasa1!=12):			
				$znici=$zaznam5[pol_ucinek]*$zaznam6[pol];
				$jed6-=$znici;
//			endif;
      if ($jed6<0){$jed6=0;}
			if($jed6>0):
			 switch($rasa1){
			   case 1://--------------------------utok AG----------------------
				    $un=50;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 2://--------------------------utok Asgardu----------------------
				    $un=75;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 3://--------------------------utok Tauri----------------------
				    $un=55;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 4://--------------------------utok Jaffa----------------------
				    $un=40;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 5://--------------------------utok Nox----------------------
				    $un=60;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 6://--------------------------utok Replik----------------------
				    $un=100;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 7://--------------------------utok sm----------------------
				    $un=154;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
												
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 8://--------------------------utok jm----------------------
				    $un=112;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 9://--------------------------utok reetou----------------------
				    $un=47;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;

			   case 10://--------------------------utok aschena----------------------
				    $un=98.7;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 11://--------------------------utok vyvrhela----------------------
				    $un=45;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 12://--------------------------utok replikatora----------------------
				    $un=5000;//ukradne 500 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 13://--------------------------utok enkarena----------------------
				    $un=235;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
			   case 14://--------------------------utok nez·vislÈho bojovnÌka----------------------
				    $un=350;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
												case 97://--------------------------utok furlingove----------------------
				    $un=200;//ukradne 200 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="Teleport transportoval ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;
						
			   case 15://--------------------------utok abydossana----------------------
				    $un=500;//ukradne 50 naqu
            $pre=$zaznam5[vyr_vyrob]/$zaznam61[vyr_vyrob];
            $up=$un*$pre;
            $u=(($zaznam4[penize])-($jed6*$up));
						if($u<0){$u=0;};
						$pu=$zaznam4[penize]-$u;
            $pr=$pu/$pre;
						$ucinek="zlodÏji ukradli ".number_format($pr,0,"."," ")." naquadahu (v mÏnÏ " .$zaznam5["nazevrasy"]. " to bylo ".number_format($pu,0,"."," ")." naquadahu)";
						$znicij6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
				    $zjed6=$zaznam1[jed6]-$znicij6;
						
            MySQL_Query("update uzivatele set penize=$u where jmeno='$cil'");		
            MySQL_Query("update uzivatele set penize=$nup where jmeno='$logcislo'");		
						break;

        }							
		    $us=1;
			     else:
				//neprorazil
				    $us=0;
				    $ucinek="nic";
			   endif;
	       $dobyl_pol=$zaznam1[dobyl_pol]+1;
			   MySQL_Query("update uzivatele set dobyl_pol=$dobyl_pol where cislo='$logcislo'");

		$zaznamut1 = MySQL_Query("SELECT utoceno FROM uzivatele where jmeno='$cil'");
		$zaznamut = MySQL_Fetch_Array($zaznamut1);

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo = '$cislocil'");
			
			//$zujed6=(($zaznam5[pol_ucinek])*($zaznam6[pol]));
			//if($zujed6>){$zujed6=0;};
			$naq=$zaznam1["penize"]+($pu*$prevod);
      $qz=$zaznam1["jed6"]-$jednot6;
			$zz6=$jednot6-$jed6;
			if ($zz6>$jednot6) {$zz6=$jednot6;};
      $qj=$qz+$jed6;
			$den = Date("U");
			$naconazev=addslashes($naconazev);

			MySQL_Query("update uzivatele set penize=$naq,jed6 = $qj where cislo=$logcislo");
			MySQL_Query("INSERT INTO utok (den,utocnik,obrance,planety,uspesnost,ujed6,zujed6,urasa,orasa,typ,ucinek)VALUES
			                                   ($den,'$logjmeno','$cil','$naconazev',$us,'$jednot6','$zz6','$rasa1','$rasa2',5,'$ucinek')");
      MySQL_Query("update uzivatele set poslutok=$den where cislo=$logcislo");
      echo "<center><h6><a href='hlavni.php?page=info' title='info'>PokraËovat na info</a></h6></center>";
      exit;
      }while(false);


//***************************************************konec policejniho utoku****************************************


//****************************************************special ˙tok - ZHN**********************************************
//**************************************************************************************************************
	elseif($jakej==1):
			$jednot1=$jednot3*1;

			if($jednot1>$zaznam1[jed3])
				{echo "<font class='text_cerveny'>Tolik jednotek nem·te...</font>";exit;};
			if($zaznam1[zrizeni]==5)
				{echo "<font class='text_cerveny'>S naöim z¯ÌzenÌm nem˘ûeme odpalovat ZHN!</font>";exit;};

			//echo "<script languague='JavaScript'>alert('".gettype($jednot1)."')</script>";break;		
			if(($jednot1<=0) OR ($jednot1!=$jednot1*1))
				{echo "<font class='text_cerveny'>MusÌte vyslat alespoÚ jednu jednotku...</font>";break;};
      		$i=0;
/*  
		  	$kontrola1 = MySQL_Query("SELECT cislo,nazev,cislomaj FROM planety where (nazev = '$naco')");
  	  		do{
				$i++;
				if($i>50){break;};
		    	$dobre=1;
  		  		$kontrola=MySQL_Fetch_Array($kontrola1);
		    	if($naco==$kontrola[nazev]){$dobre=0;$cisloplan=$kontrola[cislo];};
  	  		}while($dobre);
*/
			$cisloplan=$naco;
			//hrdina niËitel
		 	$typhn2 = MySQL_Query("SELECT * FROM typh where typ=3");
			$typhn = MySQL_Fetch_Array($typhn2);

 			$nic2 = MySQL_Query("SELECT * FROM hrdinove where (cislomaj=$logcislo and typ=3)");
			@$nic = MySQL_Fetch_Array($nic2);
			$bnic=1+($nic[level]*$typhn[ucinek]);
			if($nic[cislomaj]!=$logcislo){$bnic=1;};
			//echo "<font class =text_bili>".$bnic;
			$cislon=$nic[cislo];
			//konec niËitela

			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys6 = MySQL_Query("SELECT * FROM planety where cislo=$cisloplan");
			$zaznam6 = MySQL_Fetch_Array($vys6);	
			
			$naconazev=$zaznam6[nazev];		

			$celj1=$jed1=$jednot1;
			//echo "<br /><font class =text_bili>cislonaco ".$cislonaco;
			do{
			//if($zaznam6[status]==)
			$vys99 = MySQL_Query("SELECT den FROM utok");

			$dat = Date("G:i:s j.m.Y");
			
			while ($zaznam99 = MySQL_Fetch_Array($vys99)):
				if($zaznam99["den"]==$dat){$spatne=1;break;};
			endwhile;
			if($spatne==1){echo "<font class='text_cerveny'>Datab·ze je p¯etÌûena, za˙toË pozdÏji</font>";break;};
      		$jed1*=$bnic;
				$znici=$zaznam5[sdi_ucinek]*$zaznam6[sdi];
				$jed1-=$znici;

			//niËitels zkuöenosti
			$zkusn=$jed1;
      		if($zkusn<0){$zkusn=0;};
			//echo "<br /><font class=text_bili>niËitel ".$zkusn;
			$zkusn=Floor($zkusn)+$nic[zkus];
			$lv=bcsqrt($zkusn/1000);
			$lv=Floor($lv);
      		if($lv>20){$lv=20;$zkusn=$lv*$lv*1000;};
			MySQL_Query("update hrdinove set zkus=$zkusn,level=$lv where cislo=$cislon");
			//konec nz

			//echo "<script languague='JavaScript'>alert('".$jed1."')</script>";
			if($jed1>0):
				//prorazil
			//echo "<script languague='JavaScript'>alert('prorazil')</script>";




            $zp=$zaznam2[jed3_jed1];//$zp=2000;//zabije pÏö·k˘
            $zu=$zaznam2[jed3_jed2];//$zu=500;//zabije univerzalu
            $zz=$zaznam2[jed3_jed3];//$zz=500;//zabije zhn
            $zj=$zaznam2[jed3_jed4];//$zj=100;//zabije orbit˘
						$znv=$zaznam2[jed3_jed5];//$znv=50;//zabije najemnych vrahu
						$zzl=$zaznam2[jed3_jed6];//$zzl=50;//zabijje zlodeju
						$zag=$zaznam2[jed3_jed7];//$zag=50;//zabije agentu
						$zpo=$zaznam2[jed3_pop]/100;// zabije % populace
						$zvy=$zaznam2[jed3_vyrobna];// znicÌ vyroben
						$zme=$zaznam2[jed3_mesta];// znici mest
						$zka=$zaznam2[jed3_kasarna];// znici kasaren
						$zob=$zaznam2[jed3_sdi];//znici obran
						$zla=$zaznam2[jed3_laborator];// znici laboratori
           /* echo $zaznam2[nazevrasy]."<br>";
						echo $zaznam4[jed1]."-".$jed1."*".$zp.";<br>";*/
						$p=$zaznam4[jed1]-$jed1*$zp;
						$u=$zaznam4[jed2]-$jed1*$zu;
						$z=$zaznam4[jed3]-$jed1*$zz;					
						$j=$zaznam4[jed4]-$jed1*$zj;
            $nv=$zaznam4[jed5]-$jed1*$znv;
						$zl=$zaznam4[jed6]-$jed1*$zzl;
						$ag=$zaznam4[jed7]-$jed1*$zag;
						$po=$zaznam6[lidi]-(($jed1*$zpo)*$zaznam6[lidi]);  /// kolik zustane lidi na planete
						$rvy = rand (0,100);
						if($rvy>=65){ $vy=$zaznam6[vyrobna]-$jed1*$zvy; } else { $vy=$zaznam6[vyrobna]; }
						$rme = rand (0, 100);
						if($rme>=75){ $me=$zaznam6[mesta]-$jed1*$zme; } else { $me=$zaznam6[mesta]; }
            $rka = rand (0, 100);
            if($rka>=65){ $ka=$zaznam6[kasarna]-$jed1*$zka;	} else { $ka=$zaznam6[kasarna]; }
            $rob = rand (0, 100);
            if($rob>=65){ $ob=$zaznam6[sdi]-$jed1*$zob; } else { $ob=$zaznam6[sdi]; }
            $rla = rand (0, 100);
            if($rla>=65){ $la=$zaznam6[laborator]-$jed1*$zla; } else { $la=$zaznam6[laborator]; }
            /*
            echo "pechoty na zacatku ".$zaznam4[jed1]."<br>";
            echo "pechoty po utoku ".$p."<br>";*/
						if($j<0){$j=0;};
						if($u<0){$u=0;};
						if($z<0){$z=0;};
						if($p<0){$p=0;};
						if($zl<0){$zl=0;};
						if($ag<0){$ag=0;};
						if($nv<0){$nv=0;};
						if($po<0){$po=0;};
						if($vy<0){$vy=0;};
						if($me<0){$me=0;};
						if($ka<0){$ka=0;};
						if($ob<0){$ob=0;};
						if($la<0){$la=0;};
						
						$jz=$zaznam4[jed4]-$j;
						$uz=$zaznam4[jed2]-$u;
						$zz=$zaznam4[jed3]-$z;
						$pz=$zaznam4[jed1]-$p;
						$pnv=$zaznam4[jed5]-$nv;
						$pzl=$zaznam4[jed6]-$zl;
						$pag=$zaznam4[jed7]-$ag;
						$pop=$zaznam6[lidi]-$po;  /// kolik bylo zabyto lidi
						$vyz=$zaznam6[vyrobna]-$vy;
						$mez=$zaznam6[mesta]-$me;
						$kaz=$zaznam6[kasarna]-$ka;
						$obz=$zaznam6[sdi]-$ob;
						$laz=$zaznam6[laborator]-$la;
						
						//$ucinek="V pÌseËnÈ bou¯i bylo zniËeno ".$jz." orbit·lnÌch jednotek, ".$uz." univerz·l˘,
            //zahynulo ".$pz." jednotek pÏchoty, ".$pnv." n·jemn˝ch vrah˘, ".$pzl." zlodÏj˘, ".$pag." 
            //agent˘ a zrnka pÌsku nen·vratnÏ poökodily ".$zz." zhn";
						$ucinek = $zaznam5[jed3_nazev]." zniËil(a): ";
						if($pz>0) { $ucinek .= $p." pÏöÌch jednotek, "; }
						if($uz>0) { $ucinek .= $uz." univerz·lnÌvh jednotek, "; } 
            if($jz>0) { $ucinek .= $jz." orbit·lnÌch jednotek, "; }
            if($zz>0) { $ucinek .= $zz." ZHN, "; }
            if($pnv>0) { $ucinek .= $pnv." n·jemn˝ch vrah˘"; }
            if($pzl>0) { $ucinek .= $pzl." zldÏj˘"; }
            if($pag>0) { $ucinek .= $pag." agent˘, "; }
            if($pop>0) { $ucinek .= $po." lidi, "; }
            if($vyz>0) { $ucinek .= $vyz." v˝roben, "; }
            if($mez>0) { $ucinek .= $mez." mÏst, "; }
            if($kaz>0) { $ucinek .= $kaz." kas·ren, "; }
            if($obz>0) { $ucinek .= $obz." obran(SDI), "; }
            if($laz>0) { $ucinek .= $laz." laborato¯Ì, "; }
                
            MySQL_Query("update uzivatele set jed2=$u,jed4=$j,jed1=$p,jed3=$z,jed5=$nv,jed6=$zl,jed7=$ag where jmeno='$cil'") or die("Nepodarilo se dokoncit utok na jednotky");
						MySQL_Query("update planety set vyrobna=$vy,lidi=$po,vyrobna=$vy,mesta=$me,kasarna=$ka,sdi=$ob,laborator=$la where cislo=$cisloplan") or die("Nepodarilo se dokoncit utok na planetu");

					
//*******************************************************************************************
				//}
				$us=1;
				
			else:
				//neprorazil
				$us=0;
				$ucinek="nic";
			endif;
//echo "<br>".$us."<br>";
		$zaznamut1 = MySQL_Query("SELECT `utoceno` FROM `uzivatele` where `jmeno`='$cil'");
		$zaznamut = MySQL_Fetch_Array($zaznamut1);

			$vysledek_kolik=$zaznamut[utoceno]+1;
			MySQL_Query("update uzivatele set utoceno='$vysledek_kolik' where cislo = $cislocil");

			$dobyl_zhn=$zaznam1[dobyl_zhn]+1;
			MySQL_Query("update uzivatele set dobyl_zhn=$dobyl_zhn where cislo=$logcislo");			
			$zujed1=$jednot1;
			$qj=$zaznam1["jed3"]-$jednot1;
			$den = Date("U");
			$naconazev=addslashes($naconazev);			
 
 			$vys11 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam11 = MySQL_Fetch_Array($vys11);

      
      $uj3n=$zaznam11["jed3_nazev"];
      
			MySQL_Query("update uzivatele set jed3 = $qj where cislo=$logcislo");

//*****obnova sily
			$politika22 = MySQL_Query("SELECT * FROM politika where rasa = $rasa2");
			$politika2 = MySQL_Fetch_Array($politika22);
			$politika11 = MySQL_Query("SELECT * FROM politika where rasa = $rasa1");
			$politika1 = MySQL_Fetch_Array($politika11);
			$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa2'");
			$zaznam5 = MySQL_Fetch_Array($vys5);
			$vys51 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
			$zaznam51 = MySQL_Fetch_Array($vys51);
			$vys4 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislocil");
			$zaznam4 = MySQL_Fetch_Array($vys4);
			$vys44 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam4[narod]");
			$zaznam44 = MySQL_Fetch_Array($vys44);
			$vys444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam4[zrizeni]");
			$zaznam444 = MySQL_Fetch_Array($vys444);
			$vys14 = MySQL_Query("SELECT * FROM uzivatele where cislo = $logcislo");
			$zaznam14 = MySQL_Fetch_Array($vys14);
			$vys144 = MySQL_Query("SELECT * FROM narody where cislo = $zaznam1[narod]");
			$zaznam144 = MySQL_Fetch_Array($vys144);
			$vys1444 = MySQL_Query("SELECT * FROM zrizeni where cislo = $zaznam1[zrizeni]");
			$zaznam1444 = MySQL_Fetch_Array($vys1444);


			$o1=$zaznam4["jed1"]*$zaznam5["jed1_utok"];
			$o1+=$zaznam4["jed2"]*$zaznam5["jed2_utok"];
			$o1+=$zaznam4["jed4"]*$zaznam5["jed4_utok"];
			$o1+=$zaznam4["jed5"]*$zold_utok;
			$o1*=$politika2[utok]/100;
			$o1*=$zaznam44[utok]/100;
			$o1*=$zaznam444[utok]/100;
			$o2+=$zaznam4["jed1"]*$zaznam5["jed1_obrana"];
			$o2+=$zaznam4["jed2"]*$zaznam5["jed2_obrana"];
			$o2+=$zaznam4["jed4"]*$zaznam5["jed4_obrana"];
			$o2+=$zaznam4["jed5"]*$zold_obrana;
			$o2*=$politika2[obrana]/100;
			$o2*=$zaznam44[obrana]/100;
			$o2*=$zaznam444[obrana]/100;
			
			$o=$o1+$o2;

			//MySQL_Query("update uzivatele set sila = $u where cislo=$logcislo");			
			MySQL_Query("update uzivatele set sila = $o where cislo=$cislocil");
//******konec obnovy sily

			MySQL_Query("INSERT INTO utok (den,utocnik,obrance,planety,uspesnost,ujed1,urasa,orasa,typ,ucinek,ujed3_nazev)VALUES
                                   ($den,'$logjmeno','$cil','$naconazev',$us,'$zujed1','$rasa1','$rasa2',1,'$ucinek','$uj3n')");			
      MySQL_Query("update uzivatele set poslutok=$den where cislo=$logcislo");
			MySQL_Close($spojeni);	
      echo "<center><h6><a href='hlavni.php?page=info' title='info'>PokraËovat na info</a></h6></center>";
			}while(false);		
      exit;
		   endif;
//**************************************************konec special ˙tok***************************************

//************************************************************************************************************
  elseif(isset($cil)):
		  do{
    	$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$cil'");
    	 do{
		    $dobre=0;
    		$kontrola=MySQL_Fetch_Array($kontrola1);
		    if($cil==$kontrola[jmeno]){$dobre=0;$cislocil=$kontrola[cislo];};
    	    }while($dobre);

			$vys4 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislocil");
			$zaznam4 = MySQL_Fetch_Array($vys4);

      if($zaznam4[planety]<=9):
        $max=1;
      else:
        $max=Round($zaznam4[planety]/10);
      endif;
	  		$jetocp=0;
			$jetodp=0;
			if($zaznam4["planety"]<2 or $zaznam4["dobyt"]>=$max):
				$dbjetocp2 = MySQL_Query("SELECT cislo,status FROM planety where cislomaj = $cislocil");
				while ($dbjetocp = mysql_fetch_array($dbjetocp2)) {
				  if($dbjetocp[status]==2){$jetocp=1;};
				  if($dbjetocp[status]==3){$jetodp=1;};
			    }
			endif;
			if($zaznam4[hra]==1 and $zaznam4[zmrazeni]>Date("U")){echo "<font class='text_cerveny'>Tento nep¯Ìtel je zmraûen...</font>";break;}
			if($zaznam4==""){echo "<font class='text_cerveny'>Tento nep¯Ìtel neexistuje...</font>";break;}
			//uprva and $zaznam1["rasa"]!=98 utok vyvrhelu
      if($zaznam4["rasa"]==$zaznam1["rasa"] and $zaznam1["rasa"]!=98){echo "<font class='text_cerveny'>Vûdyù je to p¯ece tvoje rasa...</font>";break;}
			if($zaznam4["planety"]<2 and $jetocp==0 and $jetodp==0){echo "<font class='text_cerveny'>M· mÌÚ jak dvÏ planety...</font>";exit;}
			if(($zaznam4[admin]==1 or $zaznam4[admin]==2 or $zaznam4[admin]==3 or $zaznam4[admin]==4) and $zaznam1[admin]!=1){echo "<font class='text_cerveny'>Na adminy je zak·z·no ˙toËit!</font>";break;}


			if($zaznam4["dobyt"]>=$max and $zaznam4[rasa]!=11 and $zaznam4[rasa]!=98 and $jetodp==0 and $jakej==0){echo "<font class='text_cerveny'>Tento den uû byl protivnÌk p¯ipraven o maximum planet...</font>";break;}
			if($zaznam1["planety"]<2){echo "<font class='text_cerveny'>M·te mÌÚ jak dvÏ planety...</font>";break;}
			echo "<form name='formjed' method='post' action='hlavni.php?page=utok'>";
			//echo "<form name='form2' method='post' action='hlavni.php?page=utok'>";
			echo "<input type='hidden' name='cil' value='$cil'>";
			echo "<input type='hidden' name='jakej' value='$jakej'>";
			echo "<font class='text_bili'>na jakou planetu </font>";
			$vys5 = MySQL_Query("SELECT * FROM planety where cislomaj = $cislocil order by nazev");//echo $cil;
			echo "<select name='naco'>";
			//$domov=trim($cil)."_domovsk·";
			//$dom=$zaznam4[jmeno]."_domovsk·";
			while ($zaznam5 = MySQL_Fetch_Array($vys5)):
				//if($zaznam5["nazev"]==$domov or $zaznam5["nazev"]==$dom){continue;};
				if($zaznam5["status"]==1){continue;};
                                $cccp=_;
                                if($zaznam5["status"]==2){$cccp=(CP);};
				echo "<option value='".$zaznam5[cislo]."'>".$zaznam5["nazev"]." ".$cccp;					
   			 endwhile;	
			echo "</select>";
			echo "<input type='hidden' name='over_post' value='1'>";
			echo "<input type='submit' value='   za˙toË   '>";
			echo "<br /><br /><font class='text_bili'>»Ìm chcete za˙toËit</font><br />";
			echo "<table ".$border." ".$table.">";
			if($jakej==0):
				echo "<tr>";
				echo "<th>n·zev</th>";
				echo "<th>˙tok/obrana</th>";
				echo "<th>m·te</th>";
				echo "<th>chcete poslat do ˙toku</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed1_nazev"]."</td>";
				echo "<td>".Floor($zaznam2["jed1_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".Floor($zaznam2["jed1_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td><span id='1'>".$zaznam1["jed1"]."</span></td>";
				echo "<input type=hidden name='hj1' value='".$zaznam1["jed1"]."'>";
				echo "<td><input type='text' name='jednot1'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot1.value = $zaznam1[jed1]\" value=vöe></td>";
				//echo "<input type=hidden name='hj1' value='".$zaznam1["jed1"]."'>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class=text_modry>".$zold_nazev."</td>";
				echo "<td>".Floor($zold_utok*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".Floor($zold_obrana*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td><span id='5'>".$zaznam1["jed5"]."</span></td>";
				echo "<td><input type='text' name='jednot5'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot5.value = $zaznam1[jed5]\" value=vöe></td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed2_nazev"]."</td>";
				echo "<td>".Floor($zaznam2["jed2_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".Floor($zaznam2["jed2_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td><span id='2'>".$zaznam1["jed2"]."</span></td>";
				echo "<td><input type='text' name='jednot2'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot2.value = $zaznam1[jed2]\" value=vöe></td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed4_nazev"]."</td>";
				echo "<td>".Floor($zaznam2["jed4_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".Floor($zaznam2["jed4_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td><span id='4'>".$zaznam1["jed4"]."</span></td>";
				echo "<td><input type='text' name='jednot4'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot4.value = $zaznam1[jed4]\" value=vöe></td>";
				
				echo "<input type=hidden name='hj5' value='".$zaznam1["jed5"]."'>";
				echo "<input type=hidden name='hj2' value='".$zaznam1["jed2"]."'>";
				echo "<input type=hidden name='hj4' value='".$zaznam1["jed4"]."'>";
        echo "</tr>";
			
      elseif($jakej==1):
				echo "<tr>";
				echo "<th>n·zev</th>";
				echo "<th>˙Ëinek</th>";
				echo "<th>m·te</th>";
				echo "<th>chcete poslat do ˙toku</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed3_nazev"]."</td>";
				echo "<td>".$zaznam2["jed3_ucinek"]."</td>";
				echo "<td><span id='3'>".$zaznam1["jed3"]."</span></td>";
				echo "<td><input type='text' name='jednot3'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot3.value = $zaznam1[jed3]\" value=vöe></td>";
				echo "<input type=hidden name='hj3' value='".$zaznam1["jed3"]."'>";
				
        echo "</tr></form>";
				
			elseif($jakej==2):
				echo "<tr>";
				echo "<th>n·zev</th>";
				echo "<th>˙Ëinek</th>";
				echo "<th>m·te</th>";
				echo "<th>chcete poslat do ˙toku</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed1_nazev"]."</td>";
				echo "<td>".Floor($zaznam2["jed1_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".Floor($zaznam2["jed1_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td><span id='1'>".$zaznam1["jed1"]."</span></td>";
				echo "<td><input type='text' name='jednot1'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot1.value = $zaznam1[jed1]\" value=vöe></td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class=text_modry>".$zold_nazev."</td>";
				echo "<td>".Floor($zold_utok*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".Floor($zold_obrana*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td><span id='5'>".$zaznam1["jed5"]."</span></td>";
				echo "<td><input type='text' name='jednot5'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot5.value = $zaznam1[jed5]\" value=vöe></td>";
				echo "<input type=hidden name='hj1' value='".$zaznam1["jed1"]."'>";
				echo "<input type=hidden name='hj5' value='".$zaznam1["jed5"]."'>";
        echo "</tr></form>";
			
      elseif($jakej==3):
			  echo "<tr>";
				echo "<th>n·zev</th>";
				echo "<th>˙Ëinek</th>";
				echo "<th>m·te</th>";
				echo "<th>chcete poslat do ˙toku</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed2_nazev"]."</td>";
				echo "<td>".Floor($zaznam2["jed2_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".Floor($zaznam2["jed2_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td><span id='2'>".$zaznam1["jed2"]."</span></td>";
				echo "<td><input type='text' name='jednot2'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot2.value = $zaznam1[jed2]\" value=vöe></td>";
				echo "<input type=hidden name='hj2' value='".$zaznam1["jed2"]."'>";
				echo "</tr></form>";
										  
		  elseif($jakej==4):
			  echo "<tr>";
				echo "<th>n·zev</th>";
				echo "<th>˙Ëinek</th>";
				echo "<th>m·te</th>";
				echo "<th>chcete poslat do ˙toku</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed4_nazev"]."</td>";
				echo "<td>".Floor($zaznam2["jed4_utok"]*$politika[utok]/100*$zriz[utok]/100*$narod[utok]/100)."/".Floor($zaznam2["jed4_obrana"]*$politika[obrana]/100*$zriz[obrana]/100*$narod[obrana]/100)."</td>";
				echo "<td><span id='4'>".$zaznam1["jed4"]."</span></td>";
				echo "<td><input type='text' name='jednot4'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot4.value = $zaznam1[jed4]\" value=vöe></td>";
				echo "<input type=hidden name='hj4' value='".$zaznam1["jed4"]."'>";
				
        echo "</tr></form>";

			elseif($jakej==5):
				echo "<tr>";
				echo "<th>n·zev</th>";
				echo "<th>˙Ëinek</th>";
				echo "<th>m·te</th>";
				echo "<th>chcete poslat do ˙toku</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed6_nazev"]."</td>";
				echo "<td>".$zaznam2["jed6_ucinek"]."</td>";
				echo "<td><span id='6'>".$zaznam1["jed6"]."</span></td>";
				echo "<td><input type='text' name='jednot6'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot6.value = $zaznam1[jed6]\" value=vöe></td>";
				echo "<input type=hidden name='hj6' value='".$zaznam1["jed6"]."'>";
				
        echo "</tr></form>";

			elseif($jakej==7):
				echo "<tr>";
				echo "<th>n·zev</th>";
				echo "<th>˙Ëinek</th>";
				echo "<th>m·te</th>";
				echo "<th>chcete poslat do ˙toku</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class=text_modry>".$zaznam2["jed7_nazev"]."</td>";
				echo "<td>PokusÌ se zjistit informace o planetÏ</td>";
				echo "<td><span id='7'>".$zaznam1["jed7"]."</span></td>";
				echo "<td><input type='text' name='jednot7'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot7.value = $zaznam1[jed7]\" value=vöe></td>";
				echo "<input type=hidden name='hj7' value='".$zaznam1["jed7"]."'>";
				
        echo "</tr></form>";

			elseif($jakej==8):
				echo "<tr>";
				echo "<th>n·zev</th>";
				echo "<th>˙Ëinek</th>";
				echo "<th>m·te</th>";
				echo "<th>chcete poslat do ˙toku</th>";
				echo "<th>&nbsp;</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class=text_modry>politik</td>";
				echo "<td>ukradne 12 lidÌ</td>";
				echo "<td><span id='8'>".$zaznam1["jed8"]."</span></td>";
				echo "<td><input type='text' name='jednot8'></td>";
				echo "<td><input type='button' onclick=\"document.forms['formjed'].jednot8.value = $zaznam1[jed8]\" value=vöe></td>";
				echo "<input type=hidden name='hj8' value='".$zaznam1["jed8"]."'>";
				
        echo "</tr></form>";

      
			endif;
			echo "</table>";
		 }while(false);
		else:



$castedc=Date("U");  
$bcv=(30-($castedc-$zaznam1[poslutok]));

			if ($zaznam1[poslutok]+30<Date("U")):
		
			echo "<form name='form' method='post' action='hlavni.php?page=utok'>";
			      echo "<h6><center><font class=text_modry>Na koho chcete za˙toËit: </font><input type='text' name='cil'></h6>";

			echo "<h6><center>Vyberte typ ˙toku : ";

                        echo "<center> <input type=radio name='jakej' value='0' checked> <font class=text_modry>Dob˝vacÌ</font> (".$xd." D - pokusÌte se ovl·dnout planetu)&nbsp;";
			echo " <input type=radio name='jakej' value='1'><font class=text_modry> ZHN</font> (".$xz." ZHN)&nbsp;";
			echo " <input type=radio name='jakej' value='2'><font class=text_modry> Partyz·nsk˝</font> (".$xp." P - ˙toËÌ pÏchota)&nbsp;";
			echo " <br /> <input type=radio name='jakej' value='3'><font class=text_modry> Univerz·lnÌ</font> (".$xu." U - ˙toËÌ univerz·lovÈ)&nbsp;";
			echo " <input type=radio name='jakej' value='4'><font class=text_modry> Orbit·lnÌ</font> (".$xo." O - ˙toËÌ orbity)&nbsp;";
			echo " <input type=radio name='jakej' value='5'><font class=text_modry> Kr·deû</font> (".$xpl." K - pokusÌte se okr·st vybranÈho hr·Ëe)&nbsp;";
			echo " <input type=radio name='jakej' value='7'><font class=text_modry> InfiltraËnÌ</font> (".$xa." I - pokusÌte se infiltrovat na planetu a zjistit pot¯ebnÈ informace)&nbsp;";
			echo " <input type=radio name='jakej' value='8'><font class=text_modry> Agitace</font> (".$xl." A - pokusÌte se p¯evÈst lidi)&nbsp;</font>";
			echo "<br />";
      echo "<input type='hidden' name='over_post' value='1'>";
			echo "<br /><input type='submit' value=' POKRA»OVAT '></form>";

			else:
                           echo "<center><font class='text_cerveny'>DalöÌ ˙tok m˘ûeme uskuteËnit aû za ".$bcv."s...</font>";
			endif;
		endif;

		if(!(isset($naco) or isset($cil))):


		
		$wh="where";
		echo "<br /><br /><form name='form' method='post' action='hlavni.php?page=utok'>";
		echo "<center><font class='text_bili'><font class=text_modry>P</font>ouûÌt filtr na seznam ˙tok˘</font></center><br />";
		echo "<font class='text_bili'>⁄toËÌcÌ rasa";
		$rasak = MySQL_Query("SELECT rasa, nazev FROM rasy where (rasa<12 and rasa!=0) OR (rasa>96 and rasa<100) order by rasa");
		echo "<select name='utocnik'>";
			$i=0;
			echo "<option value=''>Vöichni";
			while ($rasa = MySQL_Fetch_Array($rasak)):
				echo "<option value='".$rasa["rasa"]."'>".$rasa["nazev"];
				$planety[$rasa["rasa"]]=$rasa["nazev"];
				$rasy[$rasa["rasa"]]=$rasa["rasa"];
				$i++;
			endwhile;
    		echo "</select>";
		echo " Br·nÌcÌ se rasa";
		echo "<select name='obrance'>";
			$i=100;
      $j=1;
			echo "<option value=''>Vöichni";
			while ($j<=$i-1):
				if ($rasy[$j]!=NULL){
        echo "<option value='".$rasy[$j]."'>".$planety[$j];}
				$j++;
			endwhile;
				//echo "<option value='11'>VyvrhelovÈ";
    		echo "</select>";
		echo " Typ ˙toku";
		echo "<select name='typ'>";
		echo "<option value=''>Vöechny";
		echo "<option value='0'>Dob˝vacÌ";
		$typy[0]="Dob˝vacÌ";
		echo "<option value='1'>ZHN";
		$typy[1]="ZHN";
		echo "<option value='2'>Partyz·nsk˝";
		$typy[2]="Partyz·nsk˝";
		echo "<option value='3'>UniverzalnÌ";
		$typy[3]="Univerz·lnÌ";
    echo "<option value='4'>Orbit·lnÌ";
   	$typy[4]="Orbit·lnÌ";
   	echo "<option value='5'>ZlodÏjsk˝";
   	$typy[5]="ZlodÏjsk˝";
   	echo "<option value='8'>AgitaËnÌ";
   	$typy[8]="AgitaËnÌ";
   	echo "<option value='7'>InfiltraËnÌ";
   	$typy[7]="InfiltraËnÌ";
   	echo "</select>";
		echo "<input type='submit' value='vyber'>";
		echo "</font></form>";

		$q=$utocnik;//echo "$utocnik";
		$w=$obrance;
		$vtyp=$typy[$typ];

		$utok=$planety[$q];
		$obran=$planety[$w];
		if($q==''){$utok="Vöichni";};
		if($w==''){$obran="Vöichni";};
		if($typ==""){$vtyp="Vöechny";};

		//echo $utocnik;

		echo "<br /><font class='text_bili'>Byl pouûit tento filtr: &nbsp;&nbsp;⁄toËnÌk - <font class=text_modry>".$utok."</font>&nbsp;&nbsp;Obr·nce - <font class=text_modry>".$obran."</font>&nbsp;&nbsp;Typ ˙toku - <font class=text_modry>".$vtyp."</font></font>";
		/*echo "</center>";
		$y=$x+20;
		$z=$x-20;
		echo "<h6><a href=hlavni.php?page=utok&x=".$z." id=ii onMouseOver = Rozsvitit('ii') onMouseOut=Zhasnout('ii')>novÏjöÌch 50 ˙tok˘</a><br />";
		echo "<a href=hlavni.php?page=utok&x=".$y." id=jj onMouseOver = Rozsvitit('jj') onMouseOut=Zhasnout('jj')>staröÌch 50 ˙tok˘</a></h6>";
		//echo "<center>";*/
			
		echo "<center><h6><font class=text_modry>S</font>eznam ˙tok˘</h6>";
		echo "<table ".$border." ".$table." width=90%>";
		echo "<tr>";
		echo "<th width=5%>Datum ˙toku</th>";
		echo "<th width=25%>⁄toËÌcÌ login</th>";
		echo "<th width=25%>Br·nÌcÌ se login</th>";
		echo "<th width=35%>V˝sledek utoku</th>";
		echo "</tr>";

		if($utocnik!=""){$utocnik="urasa = ".$utocnik;};
		if($obrance!=""){$obrance="orasa = ".$obrance;};
		if($typ!=""){$typ="typ = ".$typ;};

		if(($utocnik!="") and ($obrance!="")  and ($typ!="")):
			$obrance=" and ".$obrance." and ";
		elseif(($utocnik!="") and (($obrance!="") or ($typ!=""))):
			$obrance=" and ".$obrance;
		elseif(($obrance!="") and ($typ!="")):
			$obrance=$obrance." and ";
		endif;

		if(($utocnik=="") and ($obrance=="")  and ($typ=="")){$wh="";};
		if(!isset($x)||$x<0){$x=0;};
		$xx=20;
		// optimalizovano $vys9 = MySQL_Query("SELECT * FROM utok $wh $utocnik $obrance $typ ORDER BY den DESC limit $x,$xx");
		$vys9 = MySQL_Query("SELECT den,typ,uspesnost,utocnik,obrance,planety,urasa,orasa FROM utok $wh $utocnik $obrance $typ ORDER BY den DESC limit $x,$xx");
		
    
    while($zaznam9 = MySQL_Fetch_Array($vys9)):
			$datum = Date("G:i:s j.m.Y",$zaznam9["den"]);
		  	
			$datak=$datum1=$zaznam9["den"];
			$datum2=Date("U");
			$datum1=$datum2-$datum1;
			$datum1=$datum1/3600;
			$datum1=$datum1/24;
			$datum1=Round($datum1);
			if($datum1>7){MySQL_Query("DELETE FROM utok WHERE den = $datak");};

			if($zaznam9[typ]==0):
				if($zaznam9["uspesnost"]==1):
					$us="dobyl planetu ";
				else:
					$us="nepoda¯ilo se dob˝t planetu ";
				endif;
				$barva="#BE7E00";
			
      elseif($zaznam9[typ]==1):
				if($zaznam9["uspesnost"]==1):
					$us=" raket·m se poda¯ilo prorazit obranu planety ";
				else:
					$us=" rakety byly zneökodnÏny obranou planety ";
				endif;
				$barva="#836600";
			
			elseif($zaznam9[typ]==5):
				if($zaznam9["uspesnost"]==1):
					$us=" zlodÏji vykradli z·soby planety ";
				else:
					$us=" nepoda¯ilo se vykr·st z·soby n planete ";
				endif;
				$barva="#6C4128";
			
      elseif($zaznam9[typ]==4):
			  if($zaznam9["uspesnost"]==1):
          $us=" byla vybombardov·na planeta ";
			  else:
					$us=" nepoda¯ilo se bombardovat planetu ";
				endif;
			   $barva="#6E9900";

      elseif($zaznam9[typ]==7):
			  if($zaznam9["uspesnost"]==1):
          $us=" byly zjiötÏny nÏkterÈ informace o planete ";
			  else:
					$us=" nepoda¯ilo se zjistit informace o planete ";
				endif;
			   $barva="#2C7E7E";
      
      elseif($zaznam9[typ]==3):
			  if($zaznam9["uspesnost"]==1):
          $us=" Univerz·lovÈ uspely na planete ";
			  else:
					$us=" univerz·lovÈ neuspÏly na planetÏ ";
				endif;
			   $barva="#717100";

      elseif($zaznam9[typ]==8):
			  if($zaznam9["uspesnost"]==1):
          $us=" Otrokarske lode ukradly lidi ";
			  else:
					$us=" Otrokarskym lodim se nepodarilo ukrast lidi ";
				endif;
			   $barva="#717100";
      
      elseif($zaznam9[typ]==2):
				if($zaznam9["uspesnost"]==1):
					$us=" pÏchota poökodila infrastrukturu na planete ";
				else:
					$us=" neprorazil silnou br·nÌcÌ se pÏchotu na planete ";
				endif;
				$barva="#477100";
		endif;

			switch ($zaznam9["urasa"]):			
				case 1:	$urasa = $planety[1];break;
				case 2:	$urasa = $planety[2];break;
				case 3:	$urasa = $planety[3];break;
				case 4:	$urasa = $planety[4];break;
				case 5:	$urasa = $planety[5];break;
				case 6:	$urasa = $planety[6];break;
				case 7:	$urasa = $planety[7];break;
				case 8:	$urasa = $planety[8];break;
				case 9:	$urasa = $planety[9];break;
				case 10:$urasa = $planety[10];break;
				//case 11:$urasa = "Vyvrhel";break;
				case 98:$urasa = "Vyvrhel";break;
				case 12:$urasa = $planety[12];break;
				case 13:$urasa = $planety[13];break;
				case 14:$urasa = $planety[14];break;
				case 15:$urasa = "Tajemn· rasa";break;
				case 97:$urasa = $planety[97];break;
				case 99:$urasa = $planety[99];break;
				case 0:$urasa = $planety[0];break;					
			endswitch;

			switch ($zaznam9["orasa"]):
				case 1:	$orasa = $planety[1];break;
				case 2:	$orasa = $planety[2];break;
				case 3:	$orasa = $planety[3];break;
				case 4:	$orasa = $planety[4];break;
				case 5:	$orasa = $planety[5];break;
				case 6:	$orasa = $planety[6];break;
				case 7:	$orasa = $planety[7];break;
				case 8:	$orasa = $planety[8];break;
				case 9:	$orasa = $planety[9];break;
				case 10:$orasa = $planety[10];break;
				//case 11:$orasa = "Vyvrhel";break;
				case 98:$orasa = "Vyvrhel";break;
				case 12:$orasa = $planety[12];break;
				case 13:$orasa = $planety[13];break;
				case 14:$orasa = $planety[14];break;
				case 15:$orasa = "Tajemn· rasa";break;
				case 97:$orasa = $planety[97];break;
				case 99:$orasa = $planety[99];break;
				case 0:$orasa = $planety[0];break;
			endswitch;	
					
			echo "<tr>";
			echo "<th><h7><font color='".$barva."'>".$datum."</font></h7></th>";
			echo "<th><h7><font color='".$barva."'>".$zaznam9["utocnik"]." (".$urasa.")</font></h7></th>";
			echo "<th><h7><font color='".$barva."'>".$zaznam9["obrance"]." (".$orasa.")</font></h7></th>";
			echo "<th><h7><font color='".$barva."'>".$us,$zaznam9[planety]."</font></h7></th>";
			echo "</tr>";
		endwhile;
		echo "</table>";
		echo "</center>";		
		$y=$x+20;
		$z=$x-20;
		echo "<h6><a href=hlavni.php?page=utok&x=".$z."&utocnik=".$utoc11."&obrance=".$obran11."&typ=".$typage." id=i onMouseOver = Rozsvitit('i') onMouseOut=Zhasnout('i')>novÏjöÌch 20 ˙tok˘</a><br />";
		echo "<a href=hlavni.php?page=utok&x=".$y."&utocnik=".$utoc11."&obrance=".$obran11."&typ=".$typage." id=j onMouseOver = Rozsvitit('j') onMouseOut=Zhasnout('j')>staröÌch 20 ˙tok˘</a></h6>";		
		//echo "<center>";		
		endif;
//MySQL_Close($spojeni);	
?>
