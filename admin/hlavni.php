<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Stargate - Návrat bohů</title>
    <meta http-equiv="content-language" content="cs">
    <meta http-equiv="imagetoolbar" content="no">
    <meta name="description" content="Stargate,Hv�zdn� br�na,Stargate ,Sg-nb,serial Hv�zdn� br�na,Online hra,Textov� hra.">
    <meta name='keywords' content='Stargate,Hv�zdn� br�na,Stargate ,Sg-nb,serial Hv�zdn� br�na,Online hra,Textov� hra,hra,webov� hra,z�bava.' lang='cs' />
    <meta name="author" content="M�ca10">
    <meta http-equiv="content-type" content="text/html; charset=windows-1250">
    <link rel="stylesheet" type="text/css" href="default.css">
  </head>
  <body>
  <div style="color: red; font-size: 14px;">
<?php
require "../data_1.php";
mysql_query("SET NAMES cp1250");
$vys1 = MySQL_Query("SELECT cislo,heslo,jmeno,heslo2,admin FROM uzivatele where cislo = $logcislo");
$zaznam1 = MySQL_Fetch_Array($vys1);
if($zaznam1[admin]==0){
if(!$logjmeno){$logjmeno=$_SERVER["REMOTE_ADDR"];}
echo "Neopravneny pristup!<br />";  
echo "&nbsp;" . $logjmeno;
echo ", nejsi admin, tak nemáš přístup do admin sekce. Nemáš tu co dělat a tímto bude tvé IP adresa zablokována?";
exit;
}	

?>
</div>
    <div align="center">
      <div class="sirka">
	<div class="lista_top">

	</div>
	<div class="lista_top_mezera"></div>
	<div class="menu_top">
	    <div class="menu_top_button1">
            <!-- ... -->
        </div>
	    <div class="menu_top_button2" align="right">
		<span class="men_butt"><a href="../hlavni.php?page=info" >Odhl�sit z admin</a></span>
	    </div>
	</div>
	<div class="logo">
		<?php
		$soubor_pocet="0";
		$slozka = dir("../images/logo");
		while($soubor=$slozka->read()) {
		  if ($soubor=="." || $soubor=="..") continue;
		  $soubor_pocet++;
		}
		$soubor_vyber=rand(1, $soubor_pocet);
		$slozka->close();
		echo "<img src='../images/logo/$soubor_vyber.jpg' border='0' style='margin: 0xp; padding: 0px;'>";
		?> 
        </div>
	<div class="lista_logo"></div>
	<div class="menu">
	    <div class="menu_nadpis"></div>     
<?php

if($zaznam1[admin]==1){
	echo '
	    <div class="menu_button"><a href="hlavni.php?page=cp" >Spr�va CP</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=kontr_ra" >Kontrola RA</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=kontr_uz" >Kontrola u�ivatel�</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=silv_sms" >Silver p�ez SMS</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=gold">Gold hr��i</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin17" >Restart</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=aukro" >Odm�ny za aukro</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=vytv_for" >Vytvo�it forum</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=ucet">RTG-��et</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin1" >U�ivatel�</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin6" >Kontrolor</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin5" >Rasy</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin4" >Naq</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin7" >Maz�k</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin8" >Stopky</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin12" >Bany</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin14" >Statusy</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin15" >Banka</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin16" >Nov� rasa</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin20">Syst�m nov�ch hr���</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin11" >�prava statistik</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin10" >�iny veden�</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin2" >F�ra</a></span></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin9" >Antimulti</a></span></div> 
            <div class="menu_button"><a href="hlavni.php?page=admin-vyzkum" >V�zkum</a></span></div> 

	    ';

}

if($zaznam1[admin]==2){
	echo '
	    <div class="menu_button"><a href="hlavni.php?page=cp" >Spr�va CP</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=kontr_ra" >Kontrola RA</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=kontr_uz" >Kontrola u�ivatel�</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=vytv_for" >Vytvo�it forum</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin1" >U�ivatel�</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin6" >Kontrolor</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin5" >Rasy</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin4" >Naq</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin12" >Bany</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin14" >Statusy</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin15" >Banka</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin16" >Nov� rasa</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin11" >�prava statistik</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin10" >�iny veden�</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin2" >F�ra</a></span></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin9" >Antimulti</a></span></div> 
            <div class="menu_button"><a href="hlavni.php?page=admin-vyzkum" >V�zkum</a></span></div>
	    ';
}

if($zaznam1[admin]==3){    
	echo '
	    <div class="menu_button"><a href="hlavni.php?page=cp" >Spr�va CP</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=kontr_uz" >Kontrola u�ivatel�</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin1" >U�ivatel�</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin6" >Kontrolor</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin5" >Rasy</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin4" >Naq</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin16" >Nov� rasa</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin10" >�iny veden�</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin2" >F�ra</a></span></span></div>
	    ';
}

if($zaznam1[admin]==4){    
	echo '
	    <div class="menu_button"><a href="hlavni.php?page=kontr_ra" >Kontrola RA</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=kontr_uz" >Kontrola u�ivatel�</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin1" >U�ivatel�</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin6" >Kontrolor</a></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin5" >Rasy</a></span></div>
        <!--<div class="menu_button"><a href="hlavni.php?page=admin4" >Naq</a></span></div>-->
        <div class="menu_button"><a href="hlavni.php?page=admin15" >Banka</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin10" >�iny veden�</a></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin2" >F�ra</a></span></span></div>
	    <div class="menu_button"><a href="hlavni.php?page=admin9" >Antimulti</a></span></div>
	    ';
}

?>

        <div class="menu_button"></span></div>
        <div class="menu_button"><a href="../hlavni.php?page=info" >Odhl�sit z admin sekce</a></span></div>
	    <div class="menu_paticka"></div>
	    <div class="info"></div>
	    <div class="reklama_telo"> </div>
	    <div class="menu_paticka"></div>
	    <div class="reklama"></div>
	    <div class="reklama_telo"></div>
	    <div class="menu_paticka"></div>
    </div>

	<div class="telo">
	    <div class="telo_telo">
		<div class="telo_text">
			<br><br>
			<?php
      			$page = $_GET["page"];
      			if(file_exists("./$page.php")){
      			  include("./$page.php");}
     			else{ echo "<div align=\"center\" style=\"padding: 100px\">Str�nka $page.php je zat�m pr�zdn�</div>";} 
      			?>

		</div>
	<div class="telo_paticka"></div>
	    </div>
	</div>
      </div>

    </div>
  </body>
</html>