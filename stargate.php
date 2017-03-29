<?  require "data_1.php"; session_start();
mysql_query("SET NAMES cp1250");
Header ("Cache control: no-cache");

if($_POST["zpracuj"]){

$adresa="http://www.sg-nb.cz";
//$adresa="http://www.sg-nb.cz";
setcookie("logjmeno",$jmeno1,time()+10800);
setcookie("logheslo",md5($heslo1),time()+10800);
if(empty($k)):
	mt_srand(time());
	$c=mt_rand(1000000000,9999999999);
	setcookie("k",$c,time()+5184001);
endif;

		@$vysledek = MySQL_Query("SELECT jmeno,admin,heslo,cislo,rasa,skin,gold,silver FROM  uzivatele ORDER BY jmeno");
		if (!$vysledek):
		endif;

		$zastaveno2 = MySQL_Query("SELECT cislo,zutok,zhra FROM servis where cislo=1");	
		$zastaveno = MySQL_Fetch_Array($zastaveno2);	

		if($zastaveno[zhra]!=""){echo "<center><font size=9 color=FFFFFF>$zastaveno[zhra]</font></center>";exit;};
	
		
		if(isset($jmeno1)):
			$heslo_bak=$heslo1;
			$heslo1=md5($heslo1);
			while ($zaznam = MySQL_Fetch_Array($vysledek)):
		 	 if($zaznam["jmeno"]==$jmeno1):
			       $dobre=1;
				break;
                  	 endif;
		  	endwhile;

			$cislo=$zaznam[cislo];

			if (($dobre==1) && ($zaznam["heslo"]==$heslo1) && $_POST['over_post']==1):
				if($jmeno1=="kronikář"):
					echo "<script languague='JavaScript'>location.href='kron.php'</script>";
				else:
					@$kuk = MySQL_Query("SELECT * FROM  mul where jmeno = '$jmeno1'");

					$id=$REMOTE_ADDR;
					$date_for_g=time();

					$ban = MySQL_Query("SELECT ip,jmeno FROM ban");	
      		while($ban = MySQL_Fetch_Array($ban)):
          if($id=="$ban[ip]") {echo "<font color='cc4030' size='4px' family='Times New Roman' Weight='bold'>Porušil jste pravidla hry a z toho důvodu vám byl přístup do hry zakázán.</font>"; exit;};
				  if($jmeno1=="$ban[jmeno]") {echo "<font color='cc4030' size='5px' family='Times New Roman' Weight='bold'>Porušil jste pravidla hry a z toho důvodu vám byl přístup do hry zakázán.</font>"; exit;};
				  endwhile;

					if($k!=0){$c=$k;};
                    $mul = MySQL_Fetch_Array($kuk);

					if($zaznam[admin]!=0 or $zaznam[rasa]==0):
							MySQL_Query("update mul set c10='',c9='',c8='',c7='',c6='',c5='',c4='',c3='',c2='',c1='',id='0' where jmeno='$jmeno1'");					
					elseif($mul[id]==""):
						//echo "<script languague='JavaScript'>alert('0')</script>";
						MySQL_Query("INSERT INTO mul (jmeno, id, c1) VALUES ('$jmeno1', '$id', '$c')");
					else:
						//echo "<script languague='JavaScript'>alert(\"".$c."\")</script>";
						
						if($c!=$mul[c1]):
							$c10=$mul[c9];
							$c9=$mul[c8];
							$c8=$mul[c7];
							$c7=$mul[c6];
							$c6=$mul[c5];
							$c5=$mul[c4];
							$c4=$mul[c3];
							$c3=$mul[c2];
							$c2=$mul[c1];
							$c1=$c;
							MySQL_Query("update mul set c10=$c10,c9=$c9,c8=$c8,c7=$c7 ,c6=$c6,c5=$c5,c4=$c4,c3=$c3,c2=$c2,c1 = $c1,id='$id' where jmeno='$jmeno1'");
						else:
							MySQL_Query("update mul set id='$id' where jmeno='$jmeno1'");
						endif;
					endif;
$t=Date("U");
					MySQL_Query("INSERT INTO online values('$jmeno1',$zaznam[rasa],$t)");
					
			$dnu = 2;
      setcookie("logcislo", $cislo, time()+$dnu*24*60*60);

if($zaznam[gold]==1 or $zaznam[silver]==1){
$hlavni='hlavni.php';
}
else{
$hlavni='index.php?page=podpora';
}
					//echo $adresa;
					//exit;".$adresa."
		
					$id=$REMOTE_ADDR;
					$date_for_g=time();
					MySQL_Query("INSERT INTO error (jmeno, datum, ip, result) VALUES ('$jmeno1', '$date_for_g', '$id', '1')");
		      ///--------------------------------
		      $cas15=Date("U");
          MySQL_Query("update uzivatele set patnactminut='$cas15' where jmeno='$jmeno1'") or die(mysql_error());
		      ///--------------------------------
					echo "<script languague='JavaScript'>location.href='$hlavni'</script>";
				endif;
			elseif($dobre==0):
				$error = "Toto uživatelské jméno neexituje";					
			else:
				$error = "Špatné heslo";
				$id=$REMOTE_ADDR;
				$date_for_g=time();
				MySQL_Query("INSERT INTO error (jmeno, datum, ip, result) VALUES ('$jmeno1', '$date_for_g', '$id', '0')");
			endif;	
		endif;

		$vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
		$hhh = mysql_num_rows($vys5);
		$vys6 = MySQL_Query("SELECT jmeno FROM online");
		$o = mysql_num_rows($vys6);

		$h=Date("G");
		$m=Date("i");
		$s=Date("s");
		$sek=Date("U");
		$chci=0;
		$sek-=$m*60;
		$sek-=$s;
		$a=$h-$chci;
		if(a>0){$a-=24;};
		$sek-=$a*3600;
	 	$datum = Date("H:i:s j.m.Y",$sek);		
	
		$vys7 = MySQL_Query("SELECT cislo,posl FROM uzivatele where (posl-$sek)>0");
		$dnes = mysql_num_rows($vys7);		
	//noresize=noresize
  $vasei= $REMOTE_ADDR;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Stargate - Návrat bohů</title>
	<meta charset="UTF-8">
    <meta http-equiv="content-language" content="cs">
    <meta http-equiv="imagetoolbar" content="no">
    <meta name="robots" content="all, follow">
    <meta name="description" content="Stargate,Hvězdná brána,Stargate NB,Sg-nb,serial Hvězdná brána,Online hra,Textová hra.">
    <meta name='keywords' content='Stargate,Hvězdná brána,Stargate NB,Sg-nb,serial Hvězdná brána,Online hra,Textová hra,hra,webová hra,zábava.' lang='cs' />
    <meta name="author" content="Maca">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="default_index.css">
  </head>
  <body>

    <div align="center">

      <div class="sirka">

	<div class="lista_top">
	</div>
	<div class="lista_top_mezera"></div>
	<div class="menu_top">
	    <div class="menu_top_button1">

		<? include("navstevy.php"); ?>

	    </div>
	</div>
	<div class="logo">
	    <div class="logo_prihlaseni">
	      <FORM name=form action=index.php method=post>
	      <INPUT type=hidden value=1 name=zpracuj>
		    <input type='hidden' name='over_post' value='1'>
		    <div class="pri_jmeno">Jméno: <input name="jmeno1" type="text" class="input" size="13"></div>
		    Heslo: &nbsp;&nbsp;<input name="heslo1" type="password" class="input" size="13">
		    <div class="logo_prihlaseni2">
		      <input type="submit" value="Přihlásit se" class="button">
		    </div>
	      </FORM>
	    </div>
	</div>
	<div class="lista_logo"></div>
	<div class="menu">
	    <div class="menu_nadpis"></div>
	    <div class="menu_button"><span class="men_butt"><a href="index.php">Index</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=registrace">registrace</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=heslozap">zapoměli jste heslo?</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=stat">statistiky</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=pravidla">pravidla</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=help">help</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=kronika">kronika</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=credits">credits</a></span></div>
	    <div class="menu_paticka"></div>

	    <div class="info"></div>
	    <div class="reklama_telo"> <? include("vek.php"); ?></div>
	    <div class="menu_paticka"></div>

	    <div class="reklama"></div>
	    <div class="reklama_telo"> <? include("reklama.php"); ?> </div>
	    <div class="menu_paticka"></div>
        </div>
	<div class="telo">
	    <div class="telo_telo">
		<div class="telo_text">
			<br><br>
			<?php
      		$page = $_GET["page"];
      		// $error pro spatne uz. jmeo nebo heslo
      		if($error && !$_GET["error"]){ echo $error; }
      		else{
		  		  if(!$page){ $page = "vitej2"; }
      			 if(file_exists("./$page.php")){
      			  include("./$page.php");}
     			  else{ echo "<div align=\"center\" style=\"padding: 100px\">Stránka $page.php je zatím prázdná</div>";} 
     			}
      			?>
		</div>
	<div class="telo_paticka"></div>
	    </div>
	</div>
      </div>

    </div>
  </body>

<a href="http://www.toplist.cz/"><script language="JavaScript" type="text/javascript">
<!--
document.write ('<img src="http://toplist.cz/dot.asp?id=105640&http='+escape(document.referrer)+'" width="1" height="1" border=0 alt="TOPlist" />');
//--></script><noscript><img src="http://toplist.cz/dot.asp?id=105640" border="0"
alt="TOPlist" width="1" height="1" /></noscript></a>
</html>
