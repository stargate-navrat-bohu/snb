<?php

require './data_1.php';

$restart_1=0;

$zpracuj = filter_input(INPUT_POST, 'zpracuj');
if ($zpracuj) {

$adresa="http://sg-nb.cz";

if(($REMOTE_ADDR == "88.86.100.176") OR ($REMOTE_ADDR == "195.47.4.135") OR ($REMOTE_ADDR == "84.16.106.9") OR ($REMOTE_ADDR == "127.0.0.1"))
{
	setcookie("logjmeno",$jmeno1,null);
	setcookie("logheslo",md5($heslo1),null);
}
else 
{
	setcookie("logjmeno",$jmeno1,time()+10800);
	setcookie("logheslo",md5($heslo1),time()+10800);
}

if(empty($k)):

	mt_srand(time());

	$c=mt_rand(1000000000,9999999999);

	setcookie("k",$c,time()+5184001);

endif;



		@$vysledek = MySQL_Query("SELECT jmeno,admin,heslo,cislo,rasa,skin,gold,silver FROM uzivatele ORDER BY jmeno");

		if (!$vysledek):

		endif;



		$zastaveno2 = MySQL_Query("SELECT cislo,zutok,zhra FROM servis where cislo='1'");	

		$zastaveno = MySQL_Fetch_Array($zastaveno2);	



		if($zastaveno[zhra]!=""){echo "<center><font size=9 color=FFFFFF>$zastaveno[zhra]</font></center>";exit;};

	

		

		if(isset($jmeno1)):

			$heslo_bak=$heslo1;

			$heslo1=md5($heslo1);

		$dobre = 1;



		$cislo=$zaznam[cislo];



			if (($dobre==1) && ($zaznam["heslo"]==$heslo1) && $_POST['over_post']==1):

				if($jmeno1=="kronik��"):

					

				else:

					@$kuk = MySQL_Query("SELECT * FROM  mul where jmeno = '$jmeno1'");



					$id=$REMOTE_ADDR;

					$date_for_g=time();



					$ban = MySQL_Query("SELECT ip,jmeno FROM ban");	

      		while($ban = @MySQL_Fetch_Array($ban)):

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

					MySQL_Query("INSERT INTO online values('$jmeno1','$zaznam[rasa]','$t')");

					

			$dnu = 2;

      setcookie("logcislo", $cislo, time()+$dnu*24*60*60);



if($zaznam[gold]==1 or $zaznam[silver]==1){

$hlavni='hlavni.php?page=info';

}

elseif($zaznam[rasa]==77){

$hlavni='vyber_rasy_restart.php';

}

else{

$hlavni='hlavni.php?page=info';

}

					$id=$REMOTE_ADDR;

					$date_for_g=time();

					MySQL_Query("INSERT INTO error (jmeno, datum, ip, result) VALUES ('$jmeno1', '$date_for_g', '$id', '1')");

		      ///--------------------------------

		      $cas15=Date("U");

          MySQL_Query("update uzivatele set patnactminut='$cas15' where jmeno='$jmeno1'") or die(mysql_error());

		      ///--------------------------------

					header("Location: hlavni.php");

				endif;

			elseif($dobre==0):

				$error = "<font class='text_cerveny'>Toto uživatelské jméno neexituje</font><p />";					

			else:

				$error = "<font class='text_cerveny'>Špatné heslo</font><p />";

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

    <meta http-equiv="content-language" content="cs">



    <meta http-equiv="imagetoolbar" content="no">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">





    <meta name="description" content="Stargate,Hvězdná brána,Stargate ,Hvězdná brána -Návrat bohů,serial Hvězdná brána,Online hra,Textová hra.">

    <meta name='keywords' content='Online Game,Text Game,Online text game,Stargate,Hvězdná brána,Stargate, Hvězdná brána -Návrat bohů,serial Hvězdná br�na,Online hra,Textová hra,hra,webová hra,zábava.' lang='cs' />

    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <link rel="stylesheet" type="text/css" href="default_index1.css">

  </head>

  <body>



    <div align="center">



      <div class="sirka">





	<div class="lista_top_mezera"></div>

	<div class="menu_top">

	    <div class="menu_top_button1">



			<?php include("navstevy.php"); ?>



	    </div>

	</div>

	<div class="logo">

	    <div class="logo_prihlaseni">



						<?php

			$vys6 = MySQL_Query("SELECT jmeno FROM online");

		$o = mysql_num_rows($vys6);



	if($o<=80):

		if($restart_1==0){



		echo"

	      <FORM name=form action=index.php method=post>

	      <INPUT type=hidden value=1 name=zpracuj>

		    <input type='hidden' name='over_post' value='1'>

		    <div class='pri_jmeno'>Jm�no: <input name='jmeno1' type='text' class='input' size='13'></div>

		    Heslo: &nbsp;&nbsp;<input name='heslo1' type='password' class='input' size='13'>

		    <div class='logo_prihlaseni2'>

		      <input type='submit' value='P�ihl�sit se' class='button'>

		    </div>

	      </FORM>";

			}

		else{ echo "Prob�h� restart hry"; }



	else:

		echo"<font class='text_zeleny'>Omlouváme se, ale již je přihlášeno příliš hráčů.Děkujeme za pochopení.</font>";

	endif;



?>



	    </div>

	</div>

	<div class="lista_logo"></div>

	<div class="menu">

	    <div class="menu_nadpis"></div>

	    <div class="menu_button"><span class="men_butt"><a href="index.php">Index</a></span></div>

	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=registrace">registrace</a></span></div>

	    <div class="menu_button"><span class="men_butt"><a href="index.php?page=novinky">novinky</a></span></div>

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

	    <div style="color: white; font-size: 18px">

	    Vítejte na opravě se pracuje.Děkuji za pochopeni.

 nelze se přihlásit.

	    </div>

		<div class="telo_text"><p />Hra stagnuje málo času,lidí a podobně ..... již brzy v provozu nebude

		<font style="color: white;"></font>  

			

			<?php

      		$page = $_GET["page"];

      		// $error pro spatne uz. jmeo nebo heslo

      		if($error && !$_GET["error"]){ echo $error; }

      		else{

		  		  if(!$page){ $page = "vitej"; }

      			 if(file_exists("./$page.php")){

      			  include("./$page.php");}

     			  else{ echo "<div align=\"center\" style=\"padding: 100px\">Str�nka $page.php je zatím prázdné pracuje se na dokončení</div>";} 

     			}

      			?>
             
      			 <p /><hr><p /> Sponzor    zatím není -->> zkouška   

      		    <a target="_blank" href="http://sg-nb.cz//"><img src="reklama/liverp1.jpg" border="0"></a>
       
		</div>
     
	<div class="telo_paticka"></div>

	    </div>

	</div>

      </div>



    </div>





</body>





</html>

