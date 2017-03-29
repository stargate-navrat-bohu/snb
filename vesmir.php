<?php
mysql_query("SET NAMES cp1250");		
require "data_1.php";


	$vys10 = MySQL_Query("SELECT jmeno,heslo,rasa,status,admin,heslo2,dobyl,dobyl_part,dobyl_zhn,dobyl_orb,dobyl_uni,gold,silver FROM uzivatele where cislo='$logcislo'");
	$zaznam10 = MySQL_Fetch_Array($vys10);	

                $cxyz1 = MySQL_Query("SELECT cislo FROM uzivatele");
        $zhnm = MySQL_Query("SELECT dobyl_zhn FROM uzivatele where cislo='$cxyz1'");
        $partm = MySQL_Query("SELECT dobyl_part FROM uzivatele where cislo='$cxyz1'");

  	$rasahrace=$zaznam10[rasa];
    

	$vys9x = MySQL_Query("SELECT rasa,min,fond,darz,dara,posta,minv,darv,min1,min2,min3,min4,min5 FROM vudce where rasa = $rasahrace");
	$zaznam9x = MySQL_Fetch_Array($vys9x);

                $query3 = mysql_query("SELECT presunod FROM rasy where rasa='$rasahrace'");
$rot3 = mysql_fetch_array($query3);
$presunod=$rot3[presunod];

$casted=Date("U");  
$b=(86400-($casted-$presunod));
//echo "".$casted."   ".$presunod."";                  

	
	$vys11 = MySQL_Query("SELECT rasa,nazevrasy,status FROM rasy where rasa='$rasahrace'");
	$zaznam11 = MySQL_Fetch_Array($vys11);	

  	$rasahraces=$zaznam11[nazevrasy];
	$statrashrace=$zaznam11[status];
	$iii = MySQL_Query("SELECT icq FROM uzivatele where icq='$iii'");
	$iicq="<img src=http://web.icq.com/whitepages/online?icq=$iii&img=5>";
	$dobu="<left><img src=1.gif height=11 width=11 border='0' alt='Dobývací'></left>";
	$partu="<left><img src=2.gif height=11 width=11 border='0' alt='Partyzánský'></left>";
	$raketu="<left><img src=3.gif height=11 width=11 border='0' alt='ZHN'></left>";
	$orbital="<left><img src=4.gif height=11 width=11 border='0' alt='Orbitální'></left>";
	$unii="<left><img src=5.gif height=11 width=11 border='0' alt='Univerzální'></left>";
	$letu="<left><img src=utok3.jpg height=10 width=10 border='0'></left>";
		/*$xc=15-$zaznam10["dobyl_zhn"];
		$xd=5-$zaznam10["dobyl"];
		$xp=15-$zaznam10["dobyl_part"];*/
    
      if($zaznam10[gold]==1 or $zaznam10[silver]==1){

$zhn_m=12;
$dobyl_m=7;
$part_m=12;
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
    
    /*$xc=15-$zaznam10["dobyl_zhn"];
		$xd=5-$zaznam10["dobyl"];
		$xp=15-$zaznam10["dobyl_part"];
    */
    $xc=$zhn_m-$zaznam10["dobyl_zhn"];
		$xd=$dobyl_m-$zaznam10["dobyl"];
		$xp=$part_m-$zaznam10["dobyl_part"];
		
    $xu=$uni_m-$zaznam10["dobyl_uni"];
		$xo=$orb_m-$zaznam10["dobyl_orb"];
	/*	$xa=$age_m-$zaznam10["dobyl_age"];
		$xl=$lid_m-$zaznam10["dobyl_lid"];
		$xpl=$pol_m-$zaznam10["dobyl_pol"];
    */
    


                $kdemahledat=$zaznam10[jmeno];


		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra,statusucitel,statusmoderator,novinar,rasa FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);


$stat2=$nnnnn["status"];
/*
if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#FF6600";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
else{
$color="#626CC6";
}

if($nnnnn["admin"]=="1"){
$color="#01BAFF";
}

if($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}

if($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}


*/

      if($stat2=="1") { $color="#FFFF00"; }//vudce
      elseif($stat2=="2") { $color="#FFFFFF"; }//zastupce
      elseif($stat2=="5") { $color="#fda307"; }//ministr
      elseif($stat2=="3") { $color="#c60d00"; }//1min
      elseif($stat2=="4") { $color="#705010"; }//exil
      elseif($nnnnn["statusucitel"]=="1") { $color="#009251"; }//ucitel
      elseif($nnnnn["statusnovacek"]=="1") { $color="#2DF96B"; }//novacek
      elseif($nnnnn["statusextra"]=="1") { $color="#DB603F"; }//extra
      elseif($nnnnn["novinar"]=="1") { $color="#FF6600"; }//novinar
      elseif($nnnnn["statusmoderator"]=="1") { $color="#3846C2"; }//moderator
      else { $color="#626CC6"; }//obcan626CC6x919191
      if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
      if($stat1=="3" OR $stat1=="31" OR $stat1=="321"){ $color="#2DF96B"; } //novacek
      if($nnnnn["admin"]!="0") { $color="#01BAFF"; }//admin


/*	

	$rasn2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa>0 and rasa<13) or (rasa>94 and rasa<100) order by rasa");	
	$i=1;

	while($rasn = MySQL_Fetch_Array($rasn2)):
	
  	echo "<a href='hlavni.php?page=vesmir&jak=$rasn[rasa]'>$rasn[nazev]</a>&nbsp;&nbsp;";
		$i++;
	endwhile;

*/




	if(isset($zmena) and $_POST['over_post']==1 and $zaznam10[status]==1):
		//echo "zmena";
		$text=HTMLSpecialChars($zmena);
		$text=NL2BR($text);
		MySQL_Query("update rasy set web='$text' where rasa=$zaznam10[rasa]");
	endif;

	$vys1 = MySQL_Query("SELECT jmeno,heslo,rasa,cislo,hra,zmrazeni,skin,heslo2,reg,admin,status FROM uzivatele where cislo='$logcislo'");
	$zaznam1 = MySQL_Fetch_Array($vys1);
	require("kontrola.php");
	$styl="styl".$zaznam1[skin];
	if($zaznam1[skin]==1 or $zaznam1[skin]==2 or $zaznam1[skin]==3 or $zaznam1[skin]==4){$styl="styl1";};
?>


<script language="JavaScript">
function zmena(){
document.formw.planeta.value=1;
}
</script>

<?

	echo "<center><a href='hlavni.php?page=vesmir&jak=mocnost' >Seøazení hráèù</a>&nbsp;&nbsp;";
	
	echo "<a href='hlavni.php?page=vesmir&jak=online' >Online hráèi</a>&nbsp;&nbsp;";
	
	echo "<a href='hlavni.php?page=vesmir&jak=rasy' >Seøazení ras</a>&nbsp;&nbsp;";
	
	echo "<a href='hlavni.php?page=vesmir&jak=vztahy' >Vztahy</a>&nbsp;&nbsp;";
	
	echo "<a href='hlavni.php?page=vesmir&jak=smlouvy' >Smlouvy</a>&nbsp;&nbsp;";
	
	echo "<a href='hlavni.php?page=vesmir&jak=cp' >Centrální planety</a>&nbsp;&nbsp;";	
	
	echo "<a href='hlavni.php?page=vesmir&jak=hrd' >Nár. hrdinové</a>&nbsp;&nbsp;";	
	
	echo "<a href='hlavni.php?page=vesmir&jak=ant' >Antimulti</a>&nbsp;&nbsp;";	
	
	echo "<a href='hlavni.php?page=vesmir&jak=ucitel' >Nováèci a uèitelé</a>&nbsp;&nbsp;";

	echo "<a href='hlavni.php?page=vesmir&jak=gold' >Gold hráèi</a>&nbsp;&nbsp;</center><br />";	
	
///-----------
echo "<br>";
 $rasn2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa>0) and rasa<13 or (rasa>96 and rasa<99) order by rasa");	
	$i=1;
		echo "<font class='text_bili'>Seøazení v rasách:&nbsp;&nbsp;<br>";
	while($rasn = MySQL_Fetch_Array($rasn2)):
		echo "<font class='text_bili'><a href='hlavni.php?page=vesmir&jak=$rasn[rasa]' id='a$i' onMouseOver = Rozsvitit('a$i') onMouseOut=Zhasnout('a$i')>$rasn[nazev]</a>&nbsp;&nbsp;</font>";
		$i++;
	endwhile;
	echo "<br><br><br>";
///-----------

	
	if(isset($hledat)):
		if($planeta==1):
			$vys5 = MySQL_Query("SELECT nazev,majitel FROM planety");
			$planeta=$hledat;					
			while ($zaznam5 = MySQL_Fetch_Array($vys5)):
				if($zaznam5["nazev"]==$hledat){$hledat=$zaznam5["majitel"];$dobre=1;break;};
				//echo $hledat;
			endwhile;
			if($dobre!=1){echo "<font class='text_cerveny'>Tato planeta neexistuje</font>";exit;};
		endif;

/*
		$ex1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele");
		while($ex = MySQL_Fetch_Array($ex1)):
        		if($ex[jmeno]==$hledat){$exis=1;break;};
		endwhile;
*/
//echo "aaaaaaaaaaaaaaaaa";
		$vys1 = MySQL_Query("SELECT jmeno,planety,sila,populace,rasa,status,dobyt,icq,vek,zobrd,www,admin,email,posl,cislo FROM uzivatele ORDER BY (planety*sila*populace) DESC");

		$i=1;
		while ($zaznam1 = MySQL_Fetch_Array($vys1)):
			if($zaznam1["jmeno"]==$hledat){$dobre=1;break;};
			$i++;
		endwhile;
		if($dobre!=1){echo "<font class='text_cerveny'>Toto jmeno neexistuje</font>";exit;};

		$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$hledat'");
		do{
			$dobre=1;
			$kontrola=MySQL_Fetch_Array($kontrola1);
			if($hledat==$kontrola[jmeno]){$dobre=0;$cislohl=$kontrola[cislo];};
		}while($dobre);

		$rasa1 = $zaznam1["rasa"] ;
		$vys2 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa = '$rasa1'");
		$zaznam2 = MySQL_Fetch_Array($vys2);
//	----

                $kdemahledat=$zaznam1[jmeno];


		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra,statusucitel,statusmoderator,novinar,rasa FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);

	$rrasa=$nnnnn["rasa"];
$query_min1 = MySQL_Query("SELECT min1 FROM `vudce` where rasa='$rrasa'");
$row_min1 = MySQL_Fetch_Array($query_min1);

$stat2=$nnnnnn["status"];
/*
if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#fda307";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
elseif($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}

elseif($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}

elseif($nnnnn["statusucitel"]=="1"){
$color="#009251";}
else{
$color="#626CC6";
}
if($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}
if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
/// Oprava by ETNyx if($zaznam1["admin"]=="1"){
if($zaznam1["admin"]!="0"){
$color="#01BAFF";
}
*/

      if($stat2=="1") { $color="#FFFF00"; }//vudce
      elseif($stat2=="2") { $color="#FFFFFF"; }//zastupce
      elseif($stat2=="5") { $color="#fda307"; }//ministr
      elseif($stat2=="3") { $color="#c60d00"; }//1min
      elseif($stat2=="4") { $color="#705010"; }//exil
      elseif($nnnnn["statusucitel"]=="1") { $color="#009251"; }//ucitel
      elseif($nnnnn["statusnovacek"]=="1") { $color="#2DF96B"; }//novacek
      elseif($nnnnn["statusextra"]=="1") { $color="#DB603F"; }//extra
      elseif($nnnnn["novinar"]=="1") { $color="#FF6600"; }//novinar
      elseif($nnnnn["statusmoderator"]=="1") { $color="#3846C2"; }//moderator
      else { $color="#626CC6"; }//obcan626CC6x919191
      if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
      if($stat1=="3" OR $stat1=="31" OR $stat1=="321"){ $color="#2DF96B"; } //novacek
      if($nnnnn["admin"]!="0") { $color="#01BAFF"; }//admin


#01BAFF
// ------  
    switch ($zaznam1["status"]){
			case 1:
				$status="Vùdce";
				break;
			case 2:
				$status="Zástupce";
				break;
			case 3:
				$status="Asistent";
				break;
			case 4:
				$status="Vyhnanec";
				break;
			case 5:
				$status="Ministr";
				break;				
			case 0:
				$status="Obèan";
				break;
			}
/////---
			if($zaznam1["admin"]=="1"){
$status="Admin";}

			if($nnnnn["statusextra"]=="1"){
$status="VIP";}

			if($nnnnn[statusnovacek]=="1"){
$status="Nováèek";}
///////---
		if($zaznam1[icq]==""){$icq="nezadáno";}
		elseif($zaznam1[zobrd]==4 or $zaznam1[zobrd]==5 or $zaznam1[zobrd]==6 or $zaznam1[zobrd]==8){$icq=$zaznam1[icq];}
		else{$icq="vypnuto";};
		
		if($zaznam1[www]==""){$web="nezadáno";}
		elseif($zaznam1[zobrd]==3 or $zaznam1[zobrd]==5 or $zaznam1[zobrd]==7 or $zaznam1[zobrd]==8){$web=$zaznam1[www];}
		else{$web="vypnuto";};

		if($zaznam1[zobrd]==2 or $zaznam1[zobrd]==6 or $zaznam1[zobrd]==7 or $zaznam1[zobrd]==8){$email=$zaznam1[email];}
		else{$email="vypnuto";}		
		echo "<TABLE ".$table." ".$border." width='25%' align=center>";
		echo "<tr>";
		$hrac_id = $zaznam1["cislo"];
if($hrac_id != 0){
  if(file_exists("./avatary/$hrac_id.jpg")){ $nazev_image = $hrac_id.".jpg"; }
  if(file_exists("./avatary/$hrac_id.gif")){ $nazev_image = $hrac_id.".gif"; }
  if(file_exists("./avatary/$hrac_id.JPG")){ $nazev_image = $hrac_id.".JPG"; }
  if(file_exists("./avatary/$hrac_id.GIF")){ $nazev_image = $hrac_id.".GIF"; }
}
  if($nazev_image!=null):		
			echo "<th class=text_modry colspan = 2><font color=$color>".$zaznam1["jmeno"]." (".$zaznam2["nazevrasy"].")<br><img src=\"avatary/".$nazev_image."\" border=0 width=\"100\" height=\"100\"></th>";
	else:
		echo "<th class=text_modry colspan = 2><font color=$color>".$zaznam1["jmeno"]." (".$zaznam2["nazevrasy"].")</th>";
	//echo $hrac_id;
  endif;
    echo "</tr>";
		echo "<tr>";
			echo "<th><font color=$color>status</th>";
			echo "<td>".$status."</td>";
		echo "</tr>";
		echo "<tr>";		
			echo "<th><font color=$color>vìk</th>";
			echo "<td>".Floor((Date("U")-$zaznam1["vek"])/86400)." dní</td>";
		echo "</tr>";		
		echo "<tr>";
			echo "<th><font color=$color>poøadí v mocnosti</th>";
			echo "<td>".$i.".</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<th><font color=$color>populace</th>";
			echo "<td>".number_format($zaznam1["populace"],0,0," ")." milionù</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<th><font color=$color>sila</th>";
			echo "<td>".number_format($zaznam1["sila"],0,0," ")."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<th><font color=$color>mocnost</th>";
			echo "<td>".number_format(($zaznam1["populace"]*$zaznam1["sila"]*$zaznam1["planety"]/100000),0,0," ")."</td>";		
		echo "</tr>";
		echo "<tr>";		
			echo "<th><font color=$color>poèet planet</th>";
			echo "<td>".$zaznam1["planety"]."</td>";
		echo "</tr>";
		echo "<tr>";		
			echo "<th><font color=$color>naposledy pøihlášen</th>";
			$den1=$zaznam1["posl"];
      $datum = Date("H:i j.m",$den1);
			echo "<td>".$datum.".</td>";
		echo "</tr>";
		echo "<tr>";		
			echo "<th><font color=$color>dnes dobyt</th>";
			echo "<td>".$zaznam1["dobyt"]." krát</td>";
		echo "</tr>";
		echo "<tr>";		
			echo "<th><font color=$color>ICQ#</th>";
			if($zaznam1[icq]!=0):
         $iicq="<img src=http://web.icq.com/whitepages/online?icq=".$zaznam1["icq"]."&img=5>";
         echo "<td>".$icq." ".$iicq."</td>";
      else:
         echo "<td>".$icq."</td>";
      endif;
      
      
      //$iicq="<img src=http://web.icq.com/whitepages/online?icq=".$zaznam1["icq"]."&img=5>";
		//	echo "<td>".$icq." ".$iicq."</td>";
		echo "</tr>";
		echo "<tr>";		
			echo "<th><font color=$color>web</th>";
			echo "<td><a href='http://".$web."' target=_blank>".$web."</a></td>";
		echo "</tr>";				
		echo "<tr>";		
			echo "<th><font color=$color>email</th>";
			echo "<td><a href='mailto:$email'>$email</td>";
		echo "</tr>";

		echo "</table><center>";
		$jak=10;
		echo "<br><font class=text_bili>Seznam planet:<br> </font><font color=$color>";
		
		$vysak = MySQL_Query("SELECT nazev,majitel,status FROM planety where cislomaj='$cislohl'");
		$zaznamm = MySQL_Fetch_Array($vysak);
		if($planeta==$zaznamm[nazev]):
			$planety="<font color=$color>".$zaznamm[nazev]."<font color=$color>";
		else:
			$planety=$zaznamm[nazev];
		endif;
		while ($zaznamm = MySQL_Fetch_Array($vysak)):
			
      if($planeta==$zaznamm[nazev]):
				$planety=$planety.", <font color=red>".$zaznamm[nazev]."</font>";
			else:
			  if($zaznamm[status]==2):$planety=$planety.", <font color=#C000C0>".$zaznamm[nazev]."(CP)</font>";
				else:
        $planety=$planety.", ".$zaznamm[nazev];
			 endif;
      endif;
		endwhile;
		echo $planety;

		$id1 = MySQL_Query("SELECT jmeno,id,c1 FROM mul where jmeno='$hledat'");
		$zaznamm = MySQL_Fetch_Array($id1);
		$idd=$zaznamm[id];
		$c1=$zaznamm[c1];
	
		if($zaznam1[admin]==0):
			echo "<br><br><font class=text_bili>Hráèi se stejným id: </font>";	
			$id1 = MySQL_Query("SELECT jmeno,id FROM mul where id='$idd'");
			while ($zaznamm = MySQL_Fetch_Array($id1)):
				if($zaznamm[jmeno]==$hledat):
					continues;
				else:
					echo $zaznamm[jmeno].", ";
				endif;
			endwhile;
			echo "<br><br><font class=text_bili>Hráèi hrající ze stejného PC: </font>";	
			$id1 = MySQL_Query("SELECT jmeno,c1 FROM mul where c1='$c1'");
			while (@$zaznamm = MySQL_Fetch_Array($id1)):
				if($zaznamm[jmeno]==$hledat):
					continues;
				else:
					echo $zaznamm[jmeno].", ";
				endif;
			endwhile;
		endif;

		$jak=10;

		echo "</font></center>";
	endif;
	


	if(isset($gocp)):
		do{
			$vys2 = MySQL_Query("SELECT rasa,cislo,jmeno FROM uzivatele where jmeno = '$jmeno'");
			$zaznam2 = MySQL_Fetch_Array($vys2);
			$vys4 = MySQL_Query("SELECT cislo,nazev,cislomaj FROM planety where cislo = '$planeta'");
			$zaznam4 = MySQL_Fetch_Array($vys4);
			$majitel=$zaznam4[cislomaj];
			$vys5 = MySQL_Query("SELECT rasa,cislo,jmeno FROM uzivatele where cislo = '$majitel'");
			$zaznam5 = MySQL_Fetch_Array($vys5);

			if($zaznam5[rasa]!=$rasahrace){echo "<font class='text_cerveny'>Planeta není v držení Vaší rasy</font>";break;};
			if($zaznam2[rasa]!=$rasahrace){echo "<font class='text_cerveny'>Tento hráè není z Vaší rasy</font>";break;};
			if($zaznam10[status]!=1 and $zaznam10[status]!=5){echo "<font class='text_cerveny'>Toto mùže dìlat jedinì vùdce nebo ministr.</font>";break;};
			
			MySQL_Query("update planety set cislomaj=$zaznam2[cislo] where cislo=$planeta");
		}while(false);
	endif;
	
	if(isset($pridat)):
		$uzje2 = MySQL_Query("SELECT cislo FROM antimulty where cislo='$logcislo'");
		$uzje = mysql_num_rows($uzje2);	
		if($uzje>0):
		$vys99 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno='$pridat'");
		$zaznam99 = MySQL_Fetch_Array($vys99);

		if($zaznam99[cislo]>0):
		$cislo=$zaznam99[cislo];
		$amm2 = MySQL_Query("SELECT * FROM multaci where cislo='$cislo'");	
		$amm = MySQL_Fetch_Array($amm2);
		if($amm[cislo]!=$cislo):
			$odesilatel="Admin";
			$adresat=$zaznam99[jmeno];//echo $adresat;
			$kolik=0;
			$co="Pozor, nìkdo Vás udal z porušování pravidel, máte možná pøíliš loginù. Buïto je smažte nebo napište v osbních nastaveních dùvod. Je tu ovšem možnost že je toto naøèení neopodstatnìné.";
			$predmet = "Admin(Antimulti)";
      $text=HTMLSpecialChars($co);
			$text=NL2BR($text);
			$text=AddSlashes($text);
			$rasa="admin";
			$i=0;
			do{
				if($i>30){break;};
				$proved=1;
				$den = Date("U");
				$id_posta = MySQL_Query("SELECT id FROM pocitani_id WHERE sekce='posta' ");
	     	$id_posta_1 = MySQL_Fetch_Array($id_posta);
        $id=$id_posta_1[id]+1;
				
				//MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text) VALUES ('$den','$odesilatel','$adresat','$rasa','$text')");
        MySQL_Query("INSERT INTO posta (id,odeslano_kdy,odesilatel,adresat,nazev,rasa_odesilatel,text,rasa_prijemce,`p/n`,typ,smaz) VALUES ($id,$den,'$odesilatel','$adresat','$predmet','99','$text','$rasa_prijemce','n','2','0')") or die("nejde odeslat");
				$kont2 = MySQL_Query("SELECT odeslano_kdy,odesilatel FROM posta where odeslano_kdy=$den");
				$kont = MySQL_Fetch_Array($kont2);
				if($kont[odesilatel]=="Admin"){$proved=0;};
			//$proved=1;
				$i++;
			}while($proved);
			if($proved==0):
				$p=$zaznam9["posta"]+1;	
				MySQL_Query("update uzivatele set posta = $p where jmeno = '$adresat'");
				MySQL_Query("insert into multaci (cislo,jmeno,varovani,kdy,udavac) values ('$cislo','$pridat',$kolik,$den,'$logjmeno')");
			else:
				echo "<font class='text_cerveny'>Pošta se bohužel nepodaøila poslat, zkuste pozdìji.</font>";
			endif;
		else:
			echo "<font class='text_cerveny'>Tento login už v tabulce je.</font>";			
		endif;
		else:
			echo "<font class='text_cerveny'>Tento login neexistuje.</font>";	
		endif;
		else:
			echo "<font class='text_cerveny'>Nejste v antimulti teamu.</font>";
		endif;
	endif;	

	if(isset($jak)){	
		if(!isset($qx)||$qx<0){$qx=0;};//--------------------------------------------------------------
		//echo $qx;
		$qxx=50;
		//echo $qxx;		
		if($jak=="mocnost")://echo "aa";
		  //OPRAVA by ETNyx puvodni podminka WHERE admin!='1'
			$vys1 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni FROM uzivatele where admin='0' ORDER BY (planety*sila*populace) DESC");
			$nadpis = "mocnost";
		elseif ($jak=="planety"):
			$vys1 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni FROM uzivatele where admin!='1' ORDER BY planety DESC");
			$nadpis = "planety";
		elseif ($jak=="sila"):
			$vys1 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni FROM uzivatele where admin!='1' ORDER BY sila DESC");
			$nadpis = "sila";
		elseif ($jak=="populace"):
			$vys1 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni FROM uzivatele where admin!='1' ORDER BY populace DESC ");
			$nadpis = "populace (v milionéch)";

		elseif ($jak=="gold"):
			$vys1=MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,gold,silver FROM uzivatele where gold!='0' or silver!='0' order by gold");
			$nadpis = "Gold a Silver hráèi";





		elseif ($jak=="rasy"):
			$vys1 = MySQL_Query("SELECT rasa,sila,populace,planety,status,admin FROM uzivatele  ORDER BY (planety*sila*populace) DESC");
			
			
      $nadpis = "rasy (rozhloha)";


		elseif ($jak=="vztahy"):
			$vys1 = MySQL_Query("SELECT * FROM vztahy where (rasa>0 and rasa<11) ORDER BY rasa ASC");
			$nadpis = "Seznam vztahù";
			//echo $pocetras;
		elseif ($jak=="online"):
			$vys1 = MySQL_Query("SELECT * FROM online order by rasa,jmeno");
			$nadpis = "Online hráèi";
		elseif ($jak=="cp"):
			$vys1 = MySQL_Query("SELECT * FROM planety where status>1 order by majitel");
			$nadpis = "Centrální planety";			
		elseif ($jak=="hrd"):
			$vys1 = MySQL_Query("SELECT * FROM hrdinove where rasa!=0 order by rasa");
			$nadpis = "Národní hrdinové";		
		elseif ($jak=="ucitel"):
			$vys1 = MySQL_Query("SELECT * FROM uzivatele where statusnovacek!=0 order by tvujucitel");		
		elseif ($jak=="ant"):
			if($antco==1 or empty($antco) ):
				$vys1 = MySQL_Query("SELECT * FROM multaci where varovani!=4 order by jmeno");
				$nadpis = "Antimulti tabulka";
			else:
				$vys1 = MySQL_Query("SELECT * FROM multaci where varovani=4 order by kdy DESC");
				$nadpis = "Smazaní hráèi";			
			endif;
		elseif(($jak<150)):
			$rasn2 = MySQL_Query("SELECT rasa,nazev FROM rasy where rasa='$jak'");	
			$rasn = @MySQL_Fetch_Array($rasn2);
			$vys1 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni,patnactminut,gold,silver FROM uzivatele where rasa = '$jak' ORDER BY sila DESC LIMIT $qx,$qxx");
			$nadpis = "$rasn[nazev] (síla)";				
		endif;

		if($jak=="ant"):
			$uzje2 = MySQL_Query("SELECT cislo FROM antimulty where cislo=$logcislo");
			$uzje = mysql_num_rows($uzje2);		
			
			echo "<center><font class='text_bili'>";
			echo "<a href='hlavni.php?page=vesmir&jak=ant&antco=1' id=qaa onMouseOver = Rozsvitit('qaa') onMouseOut=Zhasnout('qaa')>tabulka antimulti</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
			echo "<a href='hlavni.php?page=vesmir&jak=ant&antco=2' id=qba onMouseOver = Rozsvitit('qba') onMouseOut=Zhasnout('qba')>smazaní hráèi</a><br>";	
			echo "</font>";
			
			if($uzje>0):
			echo"
			<font class='text_bili'>Pøidání nìkoho do tabulky</font> 
			<form name='form' method='post' action='hlavni.php?page=vesmir'>
			<input type=text name=pridat><input type=submit value='Pøidej'>
			<input type=hidden name=jak value=ant>
			<input type=hidden name=antco value=$antco>			
			</form></center>";
			endif;
				
			if($antco==1 or empty($antco)):
				echo "<TABLE ".$table." ".$border." width='98%' align=center>";
				echo "<tr>";
				echo "<th>jméno</th>";
				echo "<th>poslední zmìna</th>";
				echo "<th>oduvodnìní hráèe</th>";
				echo "<th>status</th>";
				echo "</tr>";
				while ($zaznam1 = MySQL_Fetch_Array($vys1)):
					$a=$zaznam1[rasa];
					$datek=Date("G:i:s j.m.Y",$zaznam1["kdy"]);
					$duvod=$zaznam1[duvod];
					if($zaznam1[duvod]==""){$duvod="neuvedeno";};	
					switch($zaznam1[varovani]):
						case 0: $status="pouze udán";
							$color="#66FF33";
							break;
						case 1: $status="jednou varován";
							$color="#7D7D00"/*"#666600"*/;
							break;
						case 2: $status="dvakrát varován";
							$color="#CC6600";
							break;
						case 3: $status="tøikrát varován";
							$color="#CC0000";
							break;
						case 9: $status="oèištìn";
							$color="#008000";
							break;							
					endswitch;									
					echo "<tr>";
					echo "<td>$zaznam1[jmeno]</td>";
					echo "<td>$datek</td>";
					echo "<td>$duvod</td>";
					echo "<td><font color=$color>$status</font></td>";
					echo "</tr>";
				endwhile;
			else:
				echo "<TABLE ".$table." ".$border." width='50%' align=center>";
				echo "<tr>";
				echo "<th>jméno</th>";
				echo "<th>èas smazání</th>";
				echo "</tr>";
				while ($zaznam1 = MySQL_Fetch_Array($vys1)):
					$datek=Date("G:i:s j.m.Y",$zaznam1["kdy"]);
					echo "<tr>";
					echo "<td>$zaznam1[jmeno]</td>";
					echo "<td>$datek</td>";
					echo "</tr>";
				endwhile;				
			endif;
		
		elseif($jak=="hrd"):
			$typ2 = MySQL_Query("SELECT * FROM typh order by typ");
			$i=1;
			while($typ1 = MySQL_Fetch_Array($typ2)):
				$typ[$i]=$typ1[nazev];
				$i++;
			endwhile;
			$rasa2 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where (rasa!=0 and rasa!=11) order by rasa");
			$i=1;
			while($rasa1 = MySQL_Fetch_Array($rasa2)):
				$rasa[$i]=$rasa1[nazevrasy];
				$i++;
			endwhile;			
			$nadpis = "Národní hrdinové";						
			echo "<TABLE ".$table." ".$border." width='100%' align=center>";
			echo "<tr>";
			echo "<th>obr</th>";
			echo "<th>jméno (level)</th>";
			echo "<th>rasa</th>";
			echo "<th>typ</th>";
			echo "<th>text</th>";
			echo "</tr>";
			while ($zaznam1 = MySQL_Fetch_Array($vys1)):
				$a=$zaznam1[rasa];
				$b=$zaznam1[typ];
				echo "<tr>";
				echo "<td><img src='hrdinove/".$zaznam1[obr]."'></td>";
				echo "<td>$zaznam1[jmeno] ($zaznam1[level])</td>";
				echo "<td>$rasa[$a]</td>";
				echo "<td>$typ[$b]</td>";
				echo "<td>$zaznam1[text]</td>";
				echo "</tr>";
			endwhile;
		elseif($jak=="cp"):


			echo "<TABLE ".$table." ".$border." width='500' align=center>";
			echo "<tr>";
				echo "<th colspan=3>".$nadpis."</th>";
				echo "</tr>";
				echo "<tr>";
			echo "<th>název</th>";
			echo "<th>rasy</th>";
			echo "<th>majitel</th>";
			echo "</tr>";
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
				echo "<td>".$zaznam1[nazev]."</td>";
				echo "<td>".$a."</td>";
				echo "<td><font color=".$color.">".$zaznam3[jmeno]." (".$b.")</font></td>";
				echo "</tr>";
			endwhile;
			echo "</table>";
		elseif($jak=="online"):

	


			echo "<TABLE ".$table." ".$border." width='25%' align=center>";
			echo "<tr>";
			echo "<th colspan=3>".$nadpis."</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>jméno</th>";
			echo "<th>rasa</th>";
			echo "<th>Poèet planet</th>";
			echo "</tr>";
			while ($zaznam1 = MySQL_Fetch_Array($vys1)):


                $kdemahledat=$zaznam1[jmeno];


		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra,statusucitel,statusmoderator,novinar,rasa FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);

	$rrasa=$nnnnn["rasa"];
$query_min1 = MySQL_Query("SELECT min1 FROM `vudce` where rasa='$rrasa'");
$row_min1 = MySQL_Fetch_Array($query_min1);

$stat2=$nnnnn["status"];
/*
if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#fda307";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
elseif($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}

elseif($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}

elseif($nnnnn["statusucitel"]=="1"){
$color="#009251";}
else{
$color="#626CC6";
}
if($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}
if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
// oprava ETNyx if($nnnnn["admin"]=="1"){
if($nnnnn["admin"]!="0"){
$color="#01BAFF";
}
*/

      if($stat2=="1") { $color="#FFFF00"; }//vudce
      elseif($stat2=="2") { $color="#FFFFFF"; }//zastupce
      elseif($stat2=="5") { $color="#fda307"; }//ministr
      elseif($stat2=="3") { $color="#c60d00"; }//1min
      elseif($stat2=="4") { $color="#705010"; }//exil
      elseif($nnnnn["statusucitel"]=="1") { $color="#009251"; }//ucitel
      elseif($nnnnn["statusnovacek"]=="1") { $color="#2DF96B"; }//novacek
      elseif($nnnnn["statusextra"]=="1") { $color="#DB603F"; }//extra
      elseif($nnnnn["novinar"]=="1") { $color=""; }//novinar
      elseif($nnnnn["statusmoderator"]=="1") { $color="#3846C2"; }//moderator
      else { $color="#626CC6"; }//obcan626CC6x919191
      if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
      if($stat1=="3" OR $stat1=="31" OR $stat1=="321"){ $color="#2DF96B"; } //novacek
      if($nnnnn["admin"]!="0") { $color="#01BAFF"; }//admin


                $kdemahledatx=$zaznam1[jmeno];


		$vvvvvx = MySQL_Query("SELECT planety FROM uzivatele where jmeno='$kdemahledatx'");

		$nnnnnx = MySQL_Fetch_Array($vvvvvx);


				$jmen=$zaznam1[jmeno];
				$vys3 = MySQL_Query("SELECT jmeno,rasa FROM uzivatele where jmeno='$jmen'");
				$zaznam3 = MySQL_Fetch_Array($vys3);
				$rasa1 = $zaznam3["rasa"] ;
				$vys2 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa = '$rasa1'");
				$zaznam2 = MySQL_Fetch_Array($vys2);
				echo "<tr>";
				echo "<td><a href='hlavni.php?page=posta&vyber=1&komuposl=".$jmen."'><font color=".$color.">".$jmen."</font></a></td>";
				echo "<td><font color=".$color.">".$zaznam2[nazevrasy]."</font></td>";
				echo "<td><font color=".$color.">".$nnnnnx[planety]."</font></td>";
				echo "</tr>";
			endwhile;
			echo "</table>";






		elseif($jak=="ucitel"):

if($posta){


$text="Žádost o udelení statusu uèitel";


$vlozeno=Date("U");
$odesilatel=$logjmeno;
$adresat=null;
$cislorasy=$zaznam1[rasa];
$nazev="Žádost o uèitele";

		$rasa1 = MySQL_Query("SELECT * FROM rasy where rasa='$cislorasy'");
		$rasa11 = MySQL_Fetch_Array($rasa1);

$rasa=$rasa11[nazevrasy];


		$rasa1b = MySQL_Query("SELECT * FROM uzivatele where jmeno='$komuposl'");
		$rasa11b = MySQL_Fetch_Array($rasa1);

$cislorasyb=$rasa11b[rasa];

		$rasa2 = MySQL_Query("SELECT * FROM rasy where rasa='$cislorasyb'");
		$rasa22 = MySQL_Fetch_Array($rasa1);

$rasab=$rasa22[nazevrasy];
	

		$vys9 = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$komuposl'");
		$zaznam9 = MySQL_Fetch_Array($vys9);

$p=$zaznam9["posta"]+1;	

$p=$zaznam9["zadall"]+1;	

MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,rasa2,text,stav,nepr,typ,smaz) VALUES ($vlozeno,'$odesilatel','$adresat','$nazev','$rasa','$rasab','$text','1','1','8','0')");

MySQL_Query("update uzivatele set posta = '$p' where jmeno = '$adresat'");

MySQL_Query("update uzivatele set zadall = '$pp' where jmeno = '$adresat'");

echo MySQL_Error();

}

			echo "<TABLE ".$table." ".$border." width='25%' align=center>";
			echo "<tr>";
			echo "<th colspan=6><font color='2DF96B'>Nováèci</font> a <font color='FF0D0D'>uèitelé</font></th>";
                       	echo "</tr>";
                        echo "<tr>";
                         echo "<th colspan=6><font class=text_bili>V pøípadì, že máte zájem stát se uèitelem, napište hernému adminovi.<br></th>";
                       /* echo "<th colspan=6><font class=text_bili>Zažádat o status uèitel:<br>
<form method='post' name='enter' action='hlavni.php?page=vesmir&jak=ucitel'>
<input type='submit' value='Odeslat žádost' name='posta'></form>
</form>
</th>";*/
                        echo "</tr>";
			echo "<tr>";
			echo "<th>jméno</th>";
			echo "<th>rasa</th>";
			echo "<th>Poèet planet</th>";
			echo "<th>Online</th>";
			echo "<th>Jeho uèitel</th>";
                        echo "<th>Pøibrat si tohoto nováèka</th>";
			echo "</tr>";

			while ($zaznam1 = MySQL_Fetch_Array($vys1)):


                $kdemahledat=$zaznam1[jmeno];



		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra,statusucitel,statusmoderator,novinar,rasa FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);


$stat2=$nnnnn["status"];

/*if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#009251";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
elseif($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}


else{
$color="#626CC6";
}

if($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}

if($nnnnn[statusucitel]=="1"){
$color="#009251";}
//Oprava by ETNyx if($nnnnn["admin"]=="1"){
if($nnnnn["admin"]!="0"){
$color="#01BAFF";
}
*/

      if($stat2=="1") { $color="#FFFF00"; }//vudce
      elseif($stat2=="2") { $color="#FFFFFF"; }//zastupce
      elseif($stat2=="5") { $color="#fda307"; }//ministr
      elseif($stat2=="3") { $color="#c60d00"; }//1min
      elseif($stat2=="4") { $color="#705010"; }//exil
      elseif($nnnnn["statusucitel"]=="1") { $color="#009251"; }//ucitel
      elseif($nnnnn["statusnovacek"]=="1") { $color="#2DF96B"; }//novacek
      elseif($nnnnn["statusextra"]=="1") { $color="#DB603F"; }//extra
      elseif($nnnnn["novinar"]=="1") { $color="#FF6600"; }//novinar
      elseif($nnnnn["statusmoderator"]=="1") { $color="#3846C2"; }//moderator
      else { $color="#626CC6"; }//obcan626CC6x919191
      if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
      if($stat1=="3" OR $stat1=="31" OR $stat1=="321"){ $color="#2DF96B"; } //novacek
      if($nnnnn["admin"]!="0") { $color="#01BAFF"; }//admin


                $kdemahledatx=0;




		$vvvvvx = MySQL_Query("SELECT jmeno FROM uzivatele where statusnovacek!='$kdemahledatx'");

		$nnnnnx = MySQL_Fetch_Array($vvvvvx);


				$jmen=$zaznam1[jmeno];
				$vys3 = MySQL_Query("SELECT jmeno,rasa FROM uzivatele where jmeno='$jmen'");
				$zaznam3 = MySQL_Fetch_Array($vys3);
				$rasa1 = $zaznam3["rasa"] ;
				$vys2 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa = '$rasa1'");
				$zaznam2 = MySQL_Fetch_Array($vys2);
			        $onlinebone = MySQL_Query("SELECT jmeno FROM online where jmeno='$kdemahledat' ");
			        $zaznam55f = MySQL_Fetch_Array($onlinebone);

$noveff=$zaznam55f[jmeno];
$novefe=$zaznam1[jmeno];


           $onlinenebone=ANO;
if($noveff!=$novefe){$onlinenebone=NE;}




		$vvvvvb = MySQL_Query("SELECT status,admin,statusnovacek,statusextra,statusucitel,statusmoderator,novinar,rasa FROM uzivatele where jmeno='$logjmeno'");

		$nnnnnb = MySQL_Fetch_Array($vvvvvb);




		if(isset($pridejucitele)):		


				MySQL_Query("update uzivatele set tvujucitel='$logjmeno',masnemas='1' WHERE jmeno = '$nevim' ");

$vlozeno=Date("U");
$odesilatel=$logjmeno;

$text="Byl Vám pøidìlen uèitel ".$odesilatel.". Pokud Vám ve høe bude nìco nejasné tento uèitel Vám na Váš dotaz rád odpový.";

$adresat=$nevim;
$cislorasy=$zaznam1[rasa];
$nazev="Byl Vám pøiøazen uèitel";

		$rasa1 = MySQL_Query("SELECT * FROM rasy where rasa='$cislorasy'");
		$rasa11 = MySQL_Fetch_Array($rasa1);

$rasa=$rasa11[nazevrasy];


		$rasa1b = MySQL_Query("SELECT * FROM uzivatele where jmeno='$nevim'");
		$rasa11b = MySQL_Fetch_Array($rasa1);

$cislorasyb=$rasa11b[rasa];

		$rasa2 = MySQL_Query("SELECT * FROM rasy where rasa='$cislorasyb'");
		$rasa22 = MySQL_Fetch_Array($rasa1);

$rasab=$rasa22[nazevrasy];
	

		$vys9 = MySQL_Query("SELECT * FROM uzivatele where jmeno = '$nevim'");
		$zaznam9 = MySQL_Fetch_Array($vys9);

$p=$zaznam9["posta"]+1;	

MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,nazev,rasa,rasa2,text,stav,nepr,typ,smaz) VALUES ($vlozeno,'$odesilatel','$adresat','$nazev','$rasa','$rasab','$text','1','1','1','0')");

MySQL_Query("update uzivatele set posta = '$p' where jmeno = '$adresat'");

echo "<script languague='JavaScript'>location.href='hlavni.php?page=vesmir&jak=ucitel'</script>";

		endif;


				echo "<tr>";
				echo "<td><a href='hlavni.php?page=posta&vyber=1&komuposl=".$zaznam1[jmeno]."'><font color=".$color.">".$zaznam1[jmeno]."</font></a></td>";
				echo "<td><font color=".$color.">".$zaznam2[nazevrasy]."</font></td>";
				echo "<td><font color=".$color.">".$zaznam1[planety]."</font></td>";
				echo "<td><font color=".$color.">".$onlinenebone."</font></td>";



                                if($zaznam1[masnemas]=='1'):

echo "<td><a href='hlavni.php?page=posta&vyber=1&komuposl=".$zaznam1[tvujucitel]."'><font color='#ff0000'>".$zaznam1[tvujucitel]."</font></a></td>";

else:

echo "<td><font color='#FFFFFF'>Nemá uèitele</font></td>";

endif;

                                if($nnnnnb["statusucitel"]=="1" and $zaznam1[masnemas]==0):

echo "<td>
<form name='form1' method='post' action='hlavni.php?page=vesmir&jak=ucitel'>
<input type='hidden' name='nevim' value='".$zaznam1[jmeno]."'>
<input type='submit' name='pridejucitele' value='Pøiber'>
</form>
</td>";

else:

echo "<td>Nelze</td>";

endif;

				echo "</tr>";

			endwhile;

			echo "</table>";






		elseif($jak=="vztahy"):
			$vys2 = MySQL_Query("SELECT rasa,nazev,nazevrasy FROM rasy where (rasa>0 and rasa<11) order by rasa ASC");

			echo "<TABLE ".$table." ".$border." width='100%' align=center style='text-align: center;'>";

			echo "<tr>";
			echo "<th colspan=11>".$nadpis."</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>&nbsp;</th>";
			while ($zaznam2 = MySQL_Fetch_Array($vys2)):
				echo "<th>".$zaznam2[nazev]."</th>";
				$nazevr[$zaznam2[rasa]]=$zaznam2[nazev];
			endwhile;
			echo "</tr>";
      
      $vztahy["nic"] = '&nbsp;';
      $vztahy[1] = 'Pakt';
      $vztahy[2] = 'Neútoè.';
      $vztahy[3] = 'Mír';
      $vztahy[4] = 'Neutral.';
      $vztahy[5] = 'Válka';
      
      $barva[1] = 'green';
      $barva[2] = '#00dddd';
      $barva[3] = 'white';
      $barva[4] = 'yellow';
      $barva[5] = 'red';
      
      while($zaznam1 = mysql_fetch_array($vys1)){
        switch($zaznam1["rasa"]){
          case 1:
            $zaznam1["a"] = 'nic';
            break;
          case 2:
            $zaznam1["b"] = 'nic';
            break;
          case 3:
            $zaznam1["c"] = 'nic';
            break;
          case 4:
            $zaznam1["d"] = 'nic';
            break;
          case 5:
            $zaznam1["e"] = 'nic';
            break;
          case 6:
            $zaznam1["f"] = 'nic';
            break;
          case 7:
            $zaznam1["g"] = 'nic';
            break;
          case 8:
            $zaznam1["h"] = 'nic';
            break;
          case 9:
            $zaznam1["i"] = 'nic';
            break;
          case 10:
            $zaznam1["j"] = 'nic';
            break;
        }
        
        echo '<tr>
          <th>
            '.$nazevr[$zaznam1["rasa"]].'
          </th>
          <td style="color: '.$barva[$zaznam1["a"]].';">
            '.$vztahy[$zaznam1["a"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["b"]].';">
            '.$vztahy[$zaznam1["b"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["c"]].';">
            '.$vztahy[$zaznam1["c"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["d"]].';">
            '.$vztahy[$zaznam1["d"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["e"]].';">
            '.$vztahy[$zaznam1["e"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["f"]].';">
            '.$vztahy[$zaznam1["f"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["g"]].';">
            '.$vztahy[$zaznam1["g"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["h"]].';">
            '.$vztahy[$zaznam1["h"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["i"]].';">
            '.$vztahy[$zaznam1["i"]].'
          </td>
          <td style="color: '.$barva[$zaznam1["j"]].';">
            '.$vztahy[$zaznam1["j"]].'
          </td>

        </tr>            
        ';
      }
      
      /* stary vypis vztahu
      $xx=1;
			while ($zaznam1 = MySQL_Fetch_Array($vys1)):
	    	    $cx="cx";
		        for($i=1;$i<10;$i++){
    		       switch($cx){
        		    case "cx":$cx="ca";$v="a";break;
            		case "ca":$cx="cb";$v="b";break;
		            case "cb":$cx="cc";$v="c";break;
    		        case "cc":$cx="cd";$v="d";break;
        		    case "cd":$cx="ce";$v="e";break;
            		case "ce":$cx="cf";$v="f";break;
            		case "cf":$cx="cg";$v="g";break;
            		case "cg":$cx="ch";$v="h";break;
            		case "ch":$cx="ci";$v="i";break;
            		
		            
		          }
    		      switch($zaznam1[$v]){
    				case "1": $$cx="green";$zaznam1[$v]="Pakt";break;	 
        			case "2": $$cx="#00dddd";$zaznam1[$v]="Neútoèení";break;
	        		case "3":	$$cx="white";$zaznam1[$v]="Mír";break;	 	 
    				case "4": $$cx="yellow";$zaznam1[$v]="Neutralita";break;	 
    				case "5":$$cx="red";$zaznam1[$v]="Válka";break;
					case "blokáda":$$cx="red";break;
					case "spojenectví":$$cx="green";break;
				  }
		        }
				echo "<tr>";
				echo "<td class=text_modry>".$nazevr[$zaznam1[rasa]]."</td>";
        		$mez="&nbsp;";
				
				if($xx==1 and $zaznam1[rasa]==1):echo "<td>$mez</td>";elseif(1<=$pocetras):echo "<td><font color=".$ca.">".$zaznam1[a]."</font></td>";endif;
				if($xx==2 and $zaznam1[rasa]==2):echo "<td>$mez</td>";elseif(2<=$pocetras):echo "<td><font color=".$cb.">".$zaznam1[b]."</font></td>";endif;
				if($xx==3 and $zaznam1[rasa]==3):echo "<td>$mez</td>";elseif(3<=$pocetras):echo "<td><font color=".$cc.">".$zaznam1[c]."</font></td>";endif;
				if($xx==4 and $zaznam1[rasa]==4):echo "<td>$mez</td>";elseif(4<=$pocetras):echo "<td><font color=".$cd.">".$zaznam1[d]."</font></td>";endif;
				if($xx==5 and $zaznam1[rasa]==5):echo "<td>$mez</td>";elseif(5<=$pocetras):echo "<td><font color=".$ce.">".$zaznam1[e]."</font></td>";endif;
				if($xx==6 and $zaznam1[rasa]==6):echo "<td>$mez</td>";elseif(6<=$pocetras):echo "<td><font color=".$cf.">".$zaznam1[f]."</font></td>";endif;
				if($xx==7 and $zaznam1[rasa]==7):echo "<td>$mez</td>";elseif(7<=$pocetras):echo "<td><font color=".$cg.">".$zaznam1[g]."</font></td>";endif;
				if($xx==8 and $zaznam1[rasa]==8):echo "<td>$mez</td>";elseif(8<=$pocetras):echo "<td><font color=".$ch.">".$zaznam1[h]."</font></td>";endif;
				if($xx==9 and $zaznam1[rasa]==9):echo "<td>$mez</td>";elseif(9<=$pocetras):echo "<td><font color=".$ci.">".$zaznam1[i]."</font></td>";endif;

				echo "</tr>";$xx++;
			endwhile;
      */
			echo "</table>";


		elseif($jak=="smlouvy"):
			
	                 include "smlouvy.php";


		elseif($jak=="planety" || $jak=="sila" || $jak=="populace" || $jak=="mocnost"):

			echo "<font class='text_zeleny'><i>*pro seøazení dle jiných kritérií kliknìte na pøíslušný odkaz v nadpisu tabulky</i></font><br />";

			echo "<TABLE ".$table." ".$border." width='90%' align=center>";
			$qwe=$qx+1;//echo $qxx;
			echo "<tr>";
			echo "<th colspan=9>Øadící kritérium: ".$nadpis."</th>";
			//echo "<th>Øadící kritérium: ".$nadpis."</th>";
			echo "</tr><tr>";
			echo "<th>poøadí</th>";
			echo "<th>jméno</th>";
			echo "<th>rasa</th>";
			echo "<th><a href='hlavni.php?page=vesmir&jak=planety' >planety</a></th>";
			echo "<th><a href='hlavni.php?page=vesmir&jak=populace' >populace</a></th>";
			echo "<th><a href='hlavni.php?page=vesmir&jak=sila' >sila</a></th>";
			echo "<th><a href='hlavni.php?page=vesmir&jak=mocnost' >mocnost</a></th>";
			echo "<th>dnes dobyt</th>";
			//echo "<th>ICQ</th>";
			echo "</tr>";

			
			$pole[1]="a";$pole[2]="b";$pole[3]="c";$pole[4]="d";$pole[5]="e";
			$pole[6]="f";$pole[7]="g";

			$hracvztahy2 = MySQL_Query("SELECT * FROM vztahy where rasa = '$rasahrace'");
			$hracvztahy = MySQL_Fetch_Array($hracvztahy2);			
			$vys2 = MySQL_Query("SELECT rasa,nazevrasy,status FROM rasy order by rasa");
			//$i=1;
			while($zaznam2 = MySQL_Fetch_Array($vys2)):
				$nazevrasyu[$zaznam2[rasa]]=$zaznam2[nazevrasy];
				$statras[$zaznam2[rasa]]=$zaznam2[status];
				//$i++;
			endwhile;
			while ($zaznam1 = MySQL_Fetch_Array($vys1)):


$vys2 = MySQL_Query("SELECT jed1_utok,jed2_utok,jed4_utok,jed1_obrana,jed2_obrana,jed4_obrana FROM rasy where rasa='$zaznam1[rasa]'");
		$zaznam2 = MySQL_Fetch_Array($vys2);

$politika1 = MySQL_Query("SELECT * FROM politika where rasa ='$zaznam1[rasa]'");
		$politika = MySQL_Fetch_Array($politika1);

$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'");
		$narod = MySQL_Fetch_Array($narod1);
$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'");
		$zriz = MySQL_Fetch_Array($zrizeni1);


		$utok=$zaznam1["jed1"] * $zaznam2["jed1_utok"];
		$utok+=$zaznam1["jed2"]*$zaznam2["jed2_utok"];
		$utok+=$zaznam1["jed4"]*$zaznam2["jed4_utok"];
		$utok+=$zaznam1["jed5"]*$zold_utok;
		
                $bonusut=1*$politika[utok]/100;
		$bonusut*=$narod[utok]/100;
		$bonusut*=$zriz[utok]/100;
		$utok*=$bonusut;

		$obrana=$zaznam1["jed1"]*$zaznam2["jed1_obrana"];
		$obrana+=$zaznam1["jed2"]*$zaznam2["jed2_obrana"];
		$obrana+=$zaznam1["jed4"]*$zaznam2["jed4_obrana"];
		$obrana+=$zaznam1["jed5"]*$zold_obrana;

		$bonusob=1*$politika[obrana]/100;
		$bonusob*=$narod[obrana]/100;
		$bonusob*=$zriz[obrana]/100;		
		$obrana*=$bonusob;		

		$sila=$obrana+$utok;


                $kdemahledat=$zaznam1[jmeno];


		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra,statusucitel,statusmoderator,novinar,rasa FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);
		$rrasa=$nnnnn["rasa"];
$query_min1 = MySQL_Query("SELECT min1 FROM `vudce` where rasa='$rrasa'");
$row_min1 = MySQL_Fetch_Array($query_min1);

$stat2=$zaznam1["status"];
/*
if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#fda307";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
elseif($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}

elseif($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}

elseif($nnnnn["statusucitel"]=="1"){
$color="#009251";}
else{
$color="#626CC6";
}
if($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}
if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
//Oprava by ETNyx if($zaznam1["admin"]=="1"){
if($zaznam1["admin"]!="0"){
$color="#01BAFF";
}
*/

      if($stat2=="1") { $color="#FFFF00"; }//vudce
      elseif($stat2=="2") { $color="#FFFFFF"; }//zastupce
      elseif($stat2=="5") { $color="#fda307"; }//ministr
      elseif($stat2=="3") { $color="#c60d00"; }//1min
      elseif($stat2=="4") { $color="#705010"; }//exil
      elseif($nnnnn["statusucitel"]=="1") { $color="#009251"; }//ucitel
      elseif($nnnnn["statusnovacek"]=="1") { $color="#2DF96B"; }//novacek
      elseif($nnnnn["statusextra"]=="1") { $color="#DB603F"; }//extra
      elseif($nnnnn["novinar"]=="1") { $color="#FF6600"; }//novinar
      elseif($nnnnn["statusmoderator"]=="1") { $color="#3846C2"; }//moderator
      else { $color="#626CC6"; }//obcan626CC6x919191
      if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
      if($nnnnn["admin"]!="0") { $color="#01BAFF"; }//admin


#01BAFF
// ------  
//-----------------
				$rasa1 = $zaznam1["rasa"] ;
				echo "<tr>";
				$mozno=1;
				if($zaznam1[planety]>10):
					$maxim=Round($zaznam1[planety]/10);
				else:
					$maxim=1;
				endif;
				if($zaznam10[jmeno]==$zaznam1["jmeno"]){$class="class=ty";}
				else{$class="";}
				
			
				  if ($zaznam1["jmeno"] == $logjmeno)
          {
          echo "<td ".$class." bgcolor=#3436A5>".$qwe."</td>";
          echo "<td ".$class." bgcolor=#3436A5><font color=$color><a href='hlavni.php?page=vesmir&hledat=".$zaznam1[jmeno]."'><font color=$color>".$zaznam1["jmeno"]."</a></td>";	
				  echo "<td ".$class." bgcolor=#3436A5><font color=$color>".$nazevrasyu[$rasa1]."</td>";
				  echo "<td ".$class." bgcolor=#3436A5><center><font color=$color>".$zaznam1["planety"]."</center></td>";
				  echo "<td ".$class." bgcolor=#3436A5><font color=$color>".number_format($zaznam1["populace"],0,0," ")."</td>";
				  echo "<td ".$class." bgcolor=#3436A5><font color=$color>".number_format($sila,0,0," ")."</td>";
				  echo "<td ".$class." bgcolor=#3436A5><font color=$color>".number_format(Round($sila*$zaznam1["populace"]*$zaznam1["planety"]/100000),0,0," ")."</td>";	
				  echo "<td ".$class." bgcolor=#3436A5><font color=$color>".$zaznam1["dobyt"]." krát</td>";
          //echo "<td".$class." bgcolor=#3436A5>&nbsp;</td>";

          }
				else 
          {
          echo "<td ".$class.">".$qwe."</td>";
					echo "<td ".$class."><font color=$color><a href='hlavni.php?page=vesmir&hledat=".$zaznam1[jmeno]."'><font color=$color>".$zaznam1["jmeno"]."</a></td>";	
				  echo "<td ".$class."><font color=$color>".$nazevrasyu[$rasa1]."</td>";
				  echo "<td ".$class."><center><font color=$color>".$zaznam1["planety"]."</center></td>";
				  echo "<td ".$class."><font color=$color>".number_format($zaznam1["populace"],0,0," ")."</td>";
				  echo "<td ".$class."><font color=$color>".number_format($sila,0,0," ")."</td>";
				  echo "<td ".$class."><font color=$color>".number_format(Round($sila*$zaznam1["populace"]*$zaznam1["planety"]/100000),0,0," ")."</td>";	
				  echo "<td ".$class."><font color=$color>".$zaznam1["dobyt"]." krát</td>";
          //echo "<td".$class.">&nbsp;</td>";
          }
			
				echo "</tr>";
			
				$qwe++;
					
			endwhile;
			$y=$qx+50;
			$z=$qx-50;
			$v=$y+50;
			$a=$qx;
			$m=$qx-49;
			if($z<1){$m=1;$a=51;};
			$b=$qx+51;
			echo "<font class='text_bili'><a href=hlavni.php?page=vesmir&qx=".$z."&jak=".$jak." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Profily s èíslem ".$m." - ".$a."</a>&nbsp;&nbsp;";
			echo "<a href=hlavni.php?page=vesmir&qx=".$y."&jak=".$jak." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Profily s èíslem ".$b." - ".$v."</a></font><br><br>";

		elseif($jak=="rasy"):
			echo "<TABLE ".$table." ".$border." width='100%' align=center>";
			$r1=$r2=$r3=$r4=$r5=$r6=$r7=$r8=$r9=$r10=$r97=$r98=0;
			$u1=$u2=$u3=$u4=$u5=$u6=$u7=$u8=$u9=$u10=$u97=$u98=0;
      			$p1=$p2=$p3=$p4=$p5=$p6=$p7=$p8=$p9=$p10=$p97=$p98=0;
      			$h1=$h2=$h3=$h4=$h5=$h6=$h7=$h8=$h9=$h10=$h97=$h98=0;			
			while ($zaznam1 = MySQL_Fetch_Array($vys1)):
		 
      if ($zaznam1["admin"]!=1):
      
      if($zaznam1["planety"]>0 AND ($zaznam1["sila"]>0 OR $zaznam1["populace"]>0)  ){
      
      	switch($zaznam1["rasa"]){
				case 1:
				  $pocplan1=$zaznam1["planety"]+$pocplan1;
					$r1+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p1+=$zaznam1["populace"]*$zaznam1["planety"];
					$u1++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h1++;};
					break;
				case 2:
				  $pocplan2=$zaznam1["planety"]+$pocplan2;
					$r2+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p2+=$zaznam1["populace"]*$zaznam1["planety"];
					$u2++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h2++;};
					break;
				case 3:
				   $pocplan3=$zaznam1["planety"]+$pocplan3;
					$r3+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p3+=$zaznam1["populace"]*$zaznam1["planety"];
					$u3++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h3++;};
					break;
				case 4:
				  $pocplan4=$zaznam1["planety"]+$pocplan4;
					$r4+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p4+=$zaznam1["populace"]*$zaznam1["planety"];
					$u4++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h4++;};
					break;
				case 5:
				  $pocplan5=$zaznam1["planety"]+$pocplan5;
					$r5+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p5+=$zaznam1["populace"]*$zaznam1["planety"];
					$u5++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h5++;};
					break;
				case 6:
				  $pocplan6=$zaznam1["planety"]+$pocplan6;
					$r6+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p6+=$zaznam1["populace"]*$zaznam1["planety"];
					$u6++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h6++;};
					break;
				case 7:
				  $pocplan7=$zaznam1["planety"]+$pocplan7;
					$r7+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p7+=$zaznam1["populace"]*$zaznam1["planety"];
					$u7++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h7++;};
					break;
				case 8:
				$pocplan8=$zaznam1["planety"]+$pocplan8;
					$r8+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p8+=$zaznam1["populace"]*$zaznam1["planety"];
					$u8++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h8++;};
					break;
				case 9:
				$pocplan9=$zaznam1["planety"]+$pocplan9;
					$r9+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p9+=$zaznam1["populace"]*$zaznam1["planety"];
					$u9++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h9++;};
					break;


        case 10:
        $pocplan10=$zaznam1["planety"]+$pocplan10;
					$r10+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p10+=$zaznam1["populace"]*$zaznam1["planety"];
					$u10++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h10++;};
					break;


				case 97:
				$pocplan97=$zaznam1["planety"]+$pocplan97;
					$r97+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p97+=$zaznam1["populace"]*$zaznam1["planety"];
					$u97++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h97++;};
					break;
				case 98:
				$pocplan98=$zaznam1["planety"]+$pocplan98;
					$r98+=Round($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000);
					$p98+=$zaznam1["populace"]*$zaznam1["planety"];
					$u98++;
					if(($zaznam1["sila"]*$zaznam1["populace"]*$zaznam1["planety"]/100000)>0){$h98++;};
					break;
        default:


					};
					}
					endif;
			endwhile; 
			MySQL_Query("update rasy set mocnost = $r1, uzi = $u1, rozlehlost = $p1,hracu=$h1, poc_planet=$pocplan1 where rasa = 1");
			MySQL_Query("update rasy set mocnost = $r2, uzi = $u2, rozlehlost = $p2,hracu=$h2, poc_planet=$pocplan2 where rasa = 2");
			MySQL_Query("update rasy set mocnost = $r3, uzi = $u3, rozlehlost = $p3,hracu=$h3, poc_planet=$pocplan3 where rasa = 3");
			MySQL_Query("update rasy set mocnost = $r4, uzi = $u4, rozlehlost = $p4,hracu=$h4, poc_planet=$pocplan4 where rasa = 4");
			MySQL_Query("update rasy set mocnost = $r5, uzi = $u5, rozlehlost = $p5,hracu=$h5, poc_planet=$pocplan5 where rasa = 5");
			MySQL_Query("update rasy set mocnost = $r6, uzi = $u6, rozlehlost = $p6,hracu=$h6, poc_planet=$pocplan6 where rasa = 6");
			MySQL_Query("update rasy set mocnost = $r7, uzi = $u7, rozlehlost = $p7,hracu=$h7, poc_planet=$pocplan7 where rasa = 7");
			MySQL_Query("update rasy set mocnost = $r8, uzi = $u8, rozlehlost = $p8,hracu=$h8, poc_planet=$pocplan8 where rasa = 8");
			MySQL_Query("update rasy set mocnost = $r9, uzi = $u9, rozlehlost = $p9,hracu=$h9, poc_planet=$pocplan9 where rasa = 9");
			MySQL_Query("update rasy set mocnost = $r10, uzi = $u10, rozlehlost = $p10,hracu=$h10, poc_planet=$pocplan10 where rasa = 10");
			MySQL_Query("update rasy set mocnost = $r97, uzi = $u97, rozlehlost = $p97,hracu=$h97, poc_planet=$pocplan97 where rasa = 97");
			MySQL_Query("update rasy set mocnost = $r98, uzi = $u98, rozlehlost = $p98,hracu=$h98, poc_planet=$pocplan98 where rasa = 98");
			
			$x=1;
			echo "<tr>";
			echo "<th colspan=8>Øadící kritérium: ".$nadpis."</th>";
			echo "</tr><tr>";
			echo "<th>poøadí</th>";
			echo "<th>rasa</th>";
			echo "<th>poèet<br>planet</th>";
			echo "<th>poèet<BR>hráèù(*)</th>";
			echo "<th>prùmìrná<br>mocnost</th>";
			echo "<th>rozloha <br>(planety * <br>populace)</th>";
			echo "<th>obsazení<br>vesmíru</th>";
			echo "<th>prùmìrná<br>rozloha(*)</th>";
			echo "</tr>";
      		//$celk=($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8+$p9+$p10+$p11)/$pocetras;
			$celk=($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8+$p9+$p10+$p97+$p98);
		//	$vys5 = MySQL_Query("SELECT rasa,nazevrasy,mocnost,uzi,rozlehlost,web,hracu,poc_planet FROM rasy where rasa!=0 and rasa<12 or rasa=95 or rasa=97 or rasa=98 ORDER BY (mocnost/hracu) DESC");
			$vys5 = MySQL_Query("SELECT rasa,nazevrasy,mocnost,uzi,rozlehlost,web,hracu,poc_planet FROM rasy where rasa!=0 and rasa<12 or rasa=95 or rasa=97 or rasa=98 ORDER BY (rozlehlost) DESC");
		
      $i=1;
			while ($zaznam5 = MySQL_Fetch_Array($vys5)):
				echo "<tr>";
				if($zaznam5[rasa]==$zaznam10[rasa]):
					$bla="class=ty";
				else:
					$bla="";
				endif;
				$i++;
				echo "<td $bla>".$x."</td>";
				echo "<td $bla><a href='http://".$zaznam5["web"]."' target='_blank'><font color=#01BAFF>".$zaznam5["nazevrasy"]."</a></td>";
				echo "<td $bla>".$zaznam5["poc_planet"]."</td>";
        echo "<td $bla>".$zaznam5["uzi"]."($zaznam5[hracu])</td>";
				if($zaznam5["hracu"]>0):echo "<td $bla>".number_format(Round($zaznam5["mocnost"]/$zaznam5["hracu"]),0,0," ")."</td>";
				else:echo "<td $bla>0</td>";
				endif;
				echo "<td $bla>".number_format($zaznam5["rozlehlost"],0,0," ")."</td>";
				echo "<td $bla>".number_format(Round($zaznam5["rozlehlost"]/($celk/100)),0,0," ")."%</td>";
				//echo "<td $bla><a href='http://".$zaznam5["web"]."' target='_blank'><font color=white>".$zaznam5["web"]."</font></a></td>";
				//$web=$zaznam5["web"];
				
				if($zaznam5["hracu"]>0):
        echo "<td $bla>".number_format($zaznam5["rozlehlost"]/$zaznam5["hracu"],0,0," ")."</td>"; 
				else: echo "<td $bla>0</td>";
				endif;
        MySQL_Query("update rasy set poradi=$i where rasa=$zaznam5[rasa]");					
				echo "</tr>";
				$x++;
			endwhile;
			echo "</table>";
			if($zaznam10[status]==1):
				echo "<center><font class='text_bili'><font class=text_modry>Z</font>mìna adresy webu</font></center>";
				echo "<form name='form2' method='post' action='vesmir.php?jak=rasy'>";
				echo "<font class=text_modry>http:// </font><input type='hidden' name='over_post' value='1'><input type=text value='".$web."' name='zmena'><br>";
				echo "<input type=submit value='Zmìò'>";
				echo "</form>";
			endif;			
			
			echo "<br><br><font class=text_bili><i>(*) - hráèi s mocností vìtší jak nula</i></font>";
			
		elseif(is_string($jak)):
			$vys9 = MySQL_Query("SELECT vudce,zastupce,asistent,rasa,jvudce,jzastupce,jasistent FROM vudce where rasa='$jak'");
			$zaznam9 = MySQL_Fetch_Array($vys9);

			if($jak==1):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." Anubis:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." 1.jaffa:</th><th>".$zaznam9[zastupce]."</th></tr><table>";

			elseif($jak==2):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." Vrchní velitel:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." Zástupce:</th><th>".$zaznam9[zastupce]."</th></tr><table>";


			elseif($jak==3):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." Velitel SGC:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." Velitel SG-1:</th><th>".$zaznam9[zastupce]."</th></tr><table>";



			elseif($jak==4):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." Nejvyšší radní:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." Èlen nejvyšší rady:</th><th>".$zaznam9[zastupce]."</th></tr><table>";



			elseif($jak==5):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." Starší:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." 1.radní:</th><th>".$zaznam9[zastupce]."</th></tr><table>";



			elseif($jak==6):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." Nejvyšší kancléø:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." Ministøi:</th><th>".$zaznam9[zastupce]."</th></tr><table>";
			
			elseif($jak==7):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." Nejvyšší radní:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." Èlen nejvyšší rady:</th><th>".$zaznam9[zastupce]."</th></tr><table>";

			elseif($jak==8):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." Nejvyšší kancléø:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." Minitøi:</th><th>".$zaznam9[zastupce]."</th></tr><table>";

			elseif($jak==9):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." My:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." My:</th><th>".$zaznam9[zastupce]."</th></tr><table>";


      elseif($jak==10):
				echo "<table class='text_cerveny'><tr><th>".$zaznam9[jvudce]." My:</th><th>".$zaznam9[vudce]."</th></tr>";
				echo "<tr><th>".$zaznam9[jzastupce]." My:</th><th>".$zaznam9[zastupce]."</th></tr><table>";
				
      elseif($jak==95):
                                echo "<font class=text_cerveny><center>Tato rasa nemá vládu.</center></font><br><br>";

			elseif($jak==97):
 				echo "<font class=text_cerveny><center>Tato rasa nemá vládu.</center></font><br><br>";


			elseif($jak==98):
                                echo "<font class=text_cerveny><center>Tato rasa nemá vládu.</center></font><br><br>";

			elseif($jak==99):
                                echo "<font class=text_cerveny><center>Admini nejsou souèástí hry.</center></font><br><br>";
			endif;

			$y=$qx+50;
			$z=$qx-50;
			$v=$y+50;
			$a=$qx;
			$m=$qx-49;
			if($z<1){$m=1;$a=51;};
			$b=$qx+51;
			echo "<font class='text_bili'><a href=hlavni.php?page=vesmir&qx=".$z."&jak=".$jak." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Profily s èíslem ".$m." - ".$a."</a>&nbsp;&nbsp;";
			echo "<a href=hlavni.php?page=vesmir&qx=".$y."&jak=".$jak." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Profily s èíslem ".$b." - ".$v."</a></font><br><br>";			
			$x=$qx+1;			
			echo "<TABLE ".$table." ".$border." width='95%' align=center>";
			echo "<tr>";
			echo "<th colspan=12>Øadící kritérium: ".$nadpis."</th>";
			echo "</tr><tr>";
			echo "<th>poøadí</th>";
			echo "<th>jméno</th>";
			echo "<th>planety</th>";
			echo "<th>populace</th>";
			echo "<th>sila</th>";
			echo "<th>mocnost</th>";
			echo "<th>dnes<br>dobyt</th>";
			echo "<th>D</th>";
			echo "<th>P</th>";
			echo "<th>Z</th>";
			echo "<th>O</th>";
			echo "<th>U</th>";
			echo "</tr>";
			
			$pole[1]="a";$pole[2]="b";$pole[3]="c";$pole[4]="d";$pole[5]="e";
			$pole[6]="f";$pole[7]="g";$pole[8]="h";$pole[9]="i";
			$hracvztahy2 = MySQL_Query("SELECT * FROM vztahy where rasa = '$rasahrace'");
			$hracvztahy = MySQL_Fetch_Array($hracvztahy2);		
				
			$vys2 = MySQL_Query("SELECT rasa,nazevrasy,status FROM rasy order by rasa");
			while($zaznam2 = MySQL_Fetch_Array($vys2)):
				$nazevrasyu[$zaznam2[rasa]]=$zaznam2[nazevrasy];
				$statras[$zaznam2[rasa]]=$zaznam2[status];
			endwhile;

			while ($zaznam1 = MySQL_Fetch_Array($vys1)):
				

$vys2 = MySQL_Query("SELECT jed1_utok,jed2_utok,jed4_utok,jed1_obrana,jed2_obrana,jed4_obrana FROM rasy where rasa='$zaznam1[rasa]'");
		$zaznam2 = MySQL_Fetch_Array($vys2);

$politika1 = MySQL_Query("SELECT * FROM politika where rasa ='$zaznam1[rasa]'");
		$politika = MySQL_Fetch_Array($politika1);

$narod1 = MySQL_Query("SELECT * FROM narody where cislo='$zaznam1[narod]'");
		$narod = MySQL_Fetch_Array($narod1);
$zrizeni1 = MySQL_Query("SELECT * FROM zrizeni where cislo='$zaznam1[zrizeni]'");
		$zriz = MySQL_Fetch_Array($zrizeni1);


		$utok=$zaznam1["jed1"] * $zaznam2["jed1_utok"];
		$utok+=$zaznam1["jed2"]*$zaznam2["jed2_utok"];
		$utok+=$zaznam1["jed4"]*$zaznam2["jed4_utok"];
		$utok+=$zaznam1["jed5"]*$zold_utok;
		
                $bonusut=1*$politika[utok]/100.0;
		$bonusut*=$narod[utok]/100.0;
		$bonusut*=$zriz[utok]/100.0;
		$utok*=$bonusut;

		$obrana=$zaznam1["jed1"]*$zaznam2["jed1_obrana"];
		$obrana+=$zaznam1["jed2"]*$zaznam2["jed2_obrana"];
		$obrana+=$zaznam1["jed4"]*$zaznam2["jed4_obrana"];
		$obrana+=$zaznam1["jed5"]*$zold_obrana;

		$bonusob=1*$politika[obrana]/100.0;
		$bonusob*=$narod[obrana]/100.0;
		$bonusob*=$zriz[obrana]/100.0;		
		$obrana*=$bonusob;		

		$sila=$obrana+$utok;


                $kdemahledat=$zaznam1[jmeno];



		$vvvvv = MySQL_Query("SELECT status,admin,statusnovacek,statusextra,statusucitel,statusmoderator,novinar,rasa FROM uzivatele where jmeno='$kdemahledat'");

		$nnnnn = MySQL_Fetch_Array($vvvvv);
$rrasa=$nnnnn["rasa"];
$query_min1 = MySQL_Query("SELECT min1 FROM `vudce` where rasa='$rrasa'");
$row_min1 = MySQL_Fetch_Array($query_min1);

$stat2=$zaznam1["status"];

$stat2=$zaznam1["status"];
/*
if($stat2=="1"){
$color="#FFFF00";
}
elseif($stat2=="2"){
$color="#FFFFFF";
}
elseif($stat2=="0"){
$color="#626CC6";
}
elseif($stat2=="3"){
$color="#B48223";
}
elseif($stat2=="4"){
$color="#555555";
}
elseif($stat2=="5"){
$color="#fda307";
}
elseif($stat2=="6"){
$color="#01BAFF";
}
elseif($nnnnn["statusextra"]=="1"){
$color="#13FAE7";
}

elseif($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}

elseif($nnnnn["statusucitel"]=="1"){
$color="#009251";}
else{
$color="#626CC6";
}
if($nnnnn[statusnovacek]=="1"){
$color="#2DF96B";
}
if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
//Oprava by ETNyx if($zaznam1["admin"]=="1"){
if($zaznam1["admin"]!="0"){
$color="#01BAFF";
}
*/
      if($stat2=="1") { $color="#FFFF00"; }//vudce
      elseif($stat2=="2") { $color="#FFFFFF"; }//zastupce
      elseif($stat2=="5") { $color="#fda307"; }//ministr
      elseif($stat2=="3") { $color="#c60d00"; }//1min
      elseif($stat2=="4") { $color="#705010"; }//exil
      elseif($nnnnn["statusucitel"]=="1") { $color="#009251"; }//ucitel
      elseif($nnnnn["statusnovacek"]=="1") { $color="#2DF96B"; }//novacek
      elseif($nnnnn["statusextra"]=="1") { $color="#DB603F"; }//extra
      elseif($nnnnn["novinar"]=="1") { $color="#FF6600"; }//novinar
      elseif($nnnnn["statusmoderator"]=="1") { $color="#3846C2"; }//moderator
      else { $color="#626CC6"; }//obcan626CC6x919191
      if ($row_min1["min1"]==$zaznam1["jmeno"]){$color="#c60d00";}
      if($stat1=="3" OR $stat1=="31" OR $stat1=="321"){ $color="#2DF96B"; } //novacek
      if($nnnnn["admin"]!="0") { $color="#01BAFF"; }//admin





#01BAFF
// ------  
//-----------------
        
        $rasa1 = $zaznam1["rasa"] ;
				echo "<tr>";
				$mozno=1;
				if($zaznam1[planety]>10):
					$maxim=Round($zaznam1[planety]/10);
				else:
					$maxim=1;
				endif;
				if($statras[$rasa1]==1 and $statrashrace==1){$mozno=0;};
				if($zaznam1[planety]<2){$mozno=0;};
				if((Date("U")-$zaznam1[vek])<259200){$mozno=0;};
				switch($rasa1){
					case 1: if($hracvztahy[$pole[1]]=="pakt" or $hracvztahy[$pole[1]]=="neútoèení"){$mozno=0;};break;
					case 2: if($hracvztahy[$pole[2]]=="pakt" or $hracvztahy[$pole[2]]=="neútoèení"){$mozno=0;};break;		
					case 3: if($hracvztahy[$pole[3]]=="pakt" or $hracvztahy[$pole[3]]=="neútoèení"){$mozno=0;};break;
					case 4: if($hracvztahy[$pole[4]]=="pakt" or $hracvztahy[$pole[4]]=="neútoèení"){$mozno=0;};break;
					case 5: if($hracvztahy[$pole[5]]=="pakt" or $hracvztahy[$pole[5]]=="neútoèení"){$mozno=0;};break;
					case 6: if($hracvztahy[$pole[6]]=="pakt" or $hracvztahy[$pole[6]]=="neútoèení"){$mozno=0;};break;
					case 7: if($hracvztahy[$pole[7]]=="pakt" or $hracvztahy[$pole[7]]=="neútoèení"){$mozno=0;};break;
				}	
				if($rasa1==$rasahrace){$mozno=0;};
				if($zaznam10[jmeno]==$zaznam1["jmeno"]){$class="class=ty";}
				elseif($zaznam1[zmrazeni]>Date("U")){$class="class=zmraz";$mozno=0;}
				else{$class="";}
				
				
			//	$jm1=$rot["jmeno"];
//echo $jm1;
$on_obr="";
$on_off=0;
//$queryonline = mysql_query("SELECT patnactminut FROM uzivatele where jmeno='$jm1'");
//$online_on = MySQL_Fetch_Array($queryonline);
$on_off=Date("U")-$zaznam1["patnactminut"];
if ($on_off< (60*5)){$on_obr="<img src='img/on.jpg' border=0>";}
if ($on_off> (60*5) and $on_off<= (60*15)){$on_obr="<img src='img/off.jpg' border=0>";}
if ($on_off> (60*15)){$on_obr="";}
$obrg22="";

if($zaznam1[silver]==1){
$obrg22="<img src='obr/silver.gif' border=0>";}
if($zaznam1[gold]==1){
$obrg22="<img src='obr/gold.gif' border=0>";}				
	


  
  			
				
				
				echo "<td ".$class.">".$x."".$on_obr."</td>";
				if($mozno==1 and $zaznam1[dobyt]<$maxim):
					echo "<td ".$class."><font color=$color><a href='hlavni.php?page=utok&jak=0&cil=".$zaznam1[jmeno]."'><font color=$color>".$zaznam1["jmeno"]."</a>".$obrg22."</td>";	
				else:
					echo "<td ".$class."><font color=$color>".$zaznam1["jmeno"]."".$obrg22."</td>";	
				endif;				
				echo "<td ".$class."><font color=$color><center>".$zaznam1["planety"]."</center></td>";
				echo "<td ".$class."><font color=$color>".number_format($zaznam1["populace"],0,0," ")."</td>";
				echo "<td ".$class."><font color=$color>".number_format($sila,0,0," ")."</td>";
				echo "<td ".$class."><font color=$color>".number_format(Round($sila*$zaznam1["populace"]*$zaznam1["planety"]/100000),0,0," ")."</td>";
				echo "<td ".$class."><font color=$color>".$zaznam1["dobyt"]." krát</td>";
				if($mozno==1 and $zaznam1[dobyt]<$maxim and $xd>0):
         echo "<td ".$class."><center><a href='hlavni.php?page=utok&jak=0&cil=".$zaznam1[jmeno]."'>".$dobu."</a></center></td>";
         
         else:
         echo "<td ".$class.">&nbsp;</td>";
         endif;
				if($mozno==1 and $xp>0):
         echo "<td ".$class."><center><a href='hlavni.php?page=utok&jakej=2&cil=".$zaznam1[jmeno]."'>".$partu."</a></center></td>";
         
         else:
         echo "<td".$class.">&nbsp;</td>";
         endif;
				if($mozno==1 and $xc>0):
         echo "<td ".$class."><center><a href='hlavni.php?page=utok&jakej=1&cil=".$zaznam1[jmeno]."'>".$raketu."</a></center></td>";
         
         else:
         echo "<td".$class.">&nbsp;</td>";
         endif;
        
        if($mozno==1 and $xo>0):
         echo "<td ".$class."><center><a href='hlavni.php?page=utok&jakej=4&cil=".$zaznam1[jmeno]."'>".$orbital."</a></center></td>";
         
         else:
         echo "<td".$class.">&nbsp;</td>";
         endif;
         if($mozno==1 and $xu>0):
         echo "<td ".$class."><center><a href='hlavni.php?page=utok&jakej=3&cil=".$zaznam1[jmeno]."'>".$unii."</a></center></td>";
         
         else:
         echo "<td".$class.">&nbsp;</td>";
         endif;
         
				echo "</tr>";
                               $x++;
			endwhile;
		endif;

		echo "</table>";

if($jak==1 or $jak==2 or $jak==3 or $jak==4 or $jak==5 or $jak==4 or $jak==6 or $jak==7 or $jak==8 or $jak==9 or $jak==10 or $jak==11 or $jak==12 or $jak==95 or $jak==97 or $jak==98 or $jak==99 or $jak==planety or $jak==sila or $jak==populace or $jak==mocnost){
			echo "<br><font class='text_bili'><a href=hlavni.php?page=vesmir&qx=".$z."&jak=".$jak." id=ww onMouseOver = Rozsvitit('ww') onMouseOut=Zhasnout('ww')>Profily s èíslem ".$m." - ".$a."</a>&nbsp;&nbsp;";
			echo "<a href=hlavni.php?page=vesmir&qx=".$y."&jak=".$jak." id=qq onMouseOver = Rozsvitit('qq') onMouseOut=Zhasnout('qq')>Profily s èíslem ".$b." - ".$v."</a></font>";
}	
	
	}
		$vys9 = MySQL_Query("SELECT * FROM uzivatele where cislo='$logcislo'");
		$zaznam9 = MySQL_Fetch_Array($vys9);
		if(($zaznam9["heslo"]!=$logheslo)||($zaznam9["jmeno"]!=$logjmeno)){
			echo "<script languague='JavaScript'>location.href='neprihlas.htm'</script>";
		};
	if(!(isset($jak))):

echo "<font color='#FFFF00'>Vùdce</font>&nbsp;&nbsp;<font color='#FFFFFF'>Zástupce</font>&nbsp;&nbsp;<font color='#c60d00'>Premiér</font>&nbsp;&nbsp;<font color='#fda307'>Ministr</font>";


	
	$k55=$k56=$k57=0;
	for ($ii55=0;$ii55<2;$ii55++):
 $k55=$k55+$k56;
 $k56=$k56+5+$ii55;//$i+6;

 echo"<br />";

 
  	$i=1;
    echo "<font class=text_bili>";
		$rasn2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa>0 and rasa<11) order by rasa ASC LIMIT $k55,$k56");
		$vys9 = MySQL_Query("SELECT vudce,zastupce,asistent,rasa,min1,min2,min3,min4,min5 FROM vudce where (rasa>0 and rasa<11) order by rasa ASC LIMIT $k55,$k56");
	
	
	/*	$i=1;echo "<font class=text_bili>";
		$rasn2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa>0 and rasa<7) order by rasa");
		$vys9 = MySQL_Query("SELECT vudce,zastupce,asistent,rasa,min1,min2,min3,min4,min5 FROM vudce where (rasa>0 and rasa<7) order by rasa");
		*/
		$s=NULL;
		

    while($zaznam9 = MySQL_Fetch_Array($vys9)):
			$s[$i]=$zaznam9[vudce];
			$s[$i+1]=$zaznam9[zastupce];
			//$s[$i+2]=$zaznam9[asistent];
			$j=1;
			while($j<7):
				$a="min".$j;
				if($zaznam9[$a]!=""){$s[$i+$j+1]=$zaznam9[$a];};
				$j++;
			endwhile;
			$i+=7;
		endwhile;

		echo "<table align=center>";
		echo "<tr>";
			echo "<td> </th>";
		while($rasn = MySQL_Fetch_Array($rasn2)):
			echo "<th><a href='hlavni.php?page=vesmir&jak=$rasn[rasa]'>$rasn[nazev]</a>&nbsp;&nbsp;</th>";
		endwhile;
		echo "</tr>";
		$i=0;
		while($i<7):
			switch($i){
				case 0: $col="#FFFF00";break;
				case 1: $col="#FFFFFF";break;
				case 2: $col="#c60d00";break;
				case 3: $col="#fda307";break;
				case 4: $col="#fda307";break;
				case 5: $col="#fda307";break;
				case 6: $col="#fda307";break;
				};
			$k=$i;
			echo "<tr>";
			echo "<td><center><font color=$col>$meno</font></center></td>";
			$j=1;
			for ($ii=1;$ii<($pocetras+1);$ii++):
				echo "<td><center><font color=$col>".$s[$j+$k]."</font></center></td>";
				$j+=7;				
			endfor;
			echo "</tr>";				
			$i++;
		endwhile;
		echo "</table>";



		echo "</table>";
//************
endfor;	
	endif;


	echo "<br><br><center><form name='formw' method='post' action='hlavni.php?page=vesmir'>";
	echo "<input type='text' name='hledat' value=$hledat>&nbsp;";
	echo "<input type='submit' value='Najdi profil'>&nbsp;";
	echo "<input type='hidden' name='planeta' value='0'>";
	echo "<input type='submit' value='Najdi planetu' onClick='zmena()'>";
	echo "</form></font></center>";

MySQL_Close($spojeni);
	
?>



<p align="center">&nbsp;</p>
<hr noshade color="#FFFFFF" size="1">
<center>

<br />

<br />


</center>
