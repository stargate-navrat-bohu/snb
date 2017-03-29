
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

  <head>
    <title>Hvězdná brána - Návrat bohů</title>
    <meta http-equiv="content-language" content="cs">
    <meta http-equiv="imagetoolbar" content="no">
    
    <meta name="description" content="Stargate,Hvězdná brána,Stargate, Hvězdná brána - Návrat bohů,serial Hvězdná brána,Online hra,Textová hra.">
    <meta name='keywords' content='Stargate,Hvězdná brána,Stargate ,Hvězdná brána - Návrat bohů,serial Hvězdná brána,Online hra,Textová hra,hra,webová hra,zábava.' lang='cs' />
    <meta name="author" content="Máca a Zdenda">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <link rel="stylesheet" type="text/css" href="default.css">
  </head>
  <body>

<?php

require "data_1.php";
mysql_query("SET NAMES cp1250");
		$vys1 = MySQL_Query("SELECT cislo,heslo,jmeno,heslo2,skin,admin,rasa FROM uzivatele where cislo = '$logcislo'");
		$zaznam1 = MySQL_Fetch_Array($vys1);
/*
//RESTART
if($zaznam1[admin] != 1)
	header("location: restart.html");
*/

if($_GET["action"]=="odhlasit"){

$max=Date("U")-(15*60);

MySQL_Query("DELETE FROM online WHERE jmeno = '$logjmeno'");
MySQL_Query("update uzivatele set heslo2='' WHERE cislo = $logcislo");
MySQL_Query("delete from online where posl<$max");
//MySQL_Close($spojeni);

setcookie("logjmeno"," ",time());
setcookie("logheslo"," ",time());
setcookie("logcislo"," ",time());
header("Location: index.php");

}
?>
<?
		

if($zaznam1[rasa]==77){ 
require 'vyber_rasy_restart.php';
//echo "Prosím nejprve vyberte svou rasu...";
die;
 }

		$info=1;
		require("kontrola.php");
		$styl=$zaznam1[skin];
		if($zaznam1[skin]==1 or $zaznam1[skin]==2 or $zaznam1[skin]==3 or $zaznam1[skin]==4){$styl="1";};

    unset($skin_name);
		switch($zaznam1[skin]){
      case 0: $cols="270"; break;
			case 1: $cols="220"; break;
			case 2: $cols="220";break;
			case 3: $cols="220";break;
			case 4: $cols="220";break;
			default: $cols="150";
		}

?>

  <body>
    <div align="center">

      <div class="sirka">	<div class="lista_top_mezera"></div>
	<div class="menu_top">
	    <div class="menu_top_button1">
	    

		<? include("horni.php"); ?>

	    </div>
	    
	    <div class="menu_top_button2" align="right">
		<span class="men_butt"><a href="hlavni.php?action=odhlasit">odhlasit</a></span>
	    </div>
	</div><div class="logo"></div>	<div class="lista_logo"></div>
	<div class="menu">
	    <div class="menu_nadpis"></div>   
      <?
      $vys1 = Mysql_Query("Select * from uzivatele where jmeno = '$logjmeno'");
      $zaznam = Mysql_fetch_array($vys1);
          
      if ($zaznam["admin"] == 1 or $zaznam["admin"] == 2 or $zaznam["admin"] == 3 or $zaznam["admin"] == 4)
        {
         echo "<div class=\"menu_button\"><span class=\"men_butt\"><a target=\"_blank\" href=\"hlavni.php?page=admin\">Vstup do AR</a></span></div>" ;
        }
      ?>      
	    <a href="hlavni.php?page=info"
onmouseover="document['info'].src = 'buttons/button1over.png' ;"
onmouseout="document['info'].src = 'buttons/button1up.png' ;">
    <img src="buttons/button1up.png" name="info";></a>

<a href="hlavni.php?page=planety"
onmouseover="document['planety/budovy'].src = 'buttons/button2over.png' ;"
onmouseout="document['planety/budovy'].src = 'buttons/button2up.png' ;">
    <img src="buttons/button2up.png" name="planety/budovy";>
    </a>
      
<a href="hlavni.php?page=jednotky"
onmouseover="document['jednotky'].src = 'buttons/button3over.png' ;"
onmouseout="document['jednotky'].src = 'buttons/button3up.png' ;">
    <img src="buttons/button3up.png" name="jednotky";>
    </a>

<a href="hlavni.php?page=vesmir"
onmouseover="document['vesmir'].src = 'buttons/button4over.png' ;"
onmouseout="document['vesmir'].src = 'buttons/button4up.png' ;">
    <img src="buttons/button4up.png" name="vesmir">
    </a>

<a href="hlavni.php?page=utok"
onmouseover="document['utok'].src = 'buttons/button5over.png' ;"
onmouseout="document['utok'].src = 'buttons/button5up.png' ;">
    <img src="buttons/button5up.png" name="utok";>
    </a>
    
<a href="hlavni.php?page=posta"
onmouseover="document['posta'].src = 'buttons/button6over.png' ;"
onmouseout="document['posta'].src = 'buttons/button6up.png' ;">
    <img src="buttons/button6up.png" name="posta";>
    </a>

<a href="hlavni.php?page=forum"
onmouseover="document['forum'].src = 'buttons/button7over.png' ;"
onmouseout="document['forum'].src = 'buttons/button7up.png' ;">
    <img src="buttons/button7up.png" name="forum";>
    </a>
    
    <a href="hlavni.php?page=vlada"
onmouseover="document['vlada'].src = 'buttons/button8over.png' ;"
onmouseout="document['vlada'].src = 'buttons/button8up.png' ;">
    <img src="buttons/button8up.png" name="vlada";>
    </a>
    
<a href="hlavni.php?page=politika"
onmouseover="document['politika'].src = 'buttons/button9over.png' ;"
onmouseout="document['politika'].src = 'buttons/button9up.png' ;">
    <img src="buttons/button9up.png" name="politika";>
    </a>
    
<a href="hlavni.php?page=ref"
onmouseover="document['referenda'].src = 'buttons/button10over.png' ;"
onmouseout="document['referenda'].src = 'buttons/button10up.png' ;">
    <img src="buttons/button10up.png" name="referenda";>
    </a>
    
<a href="hlavni.php?page=obchod"
onmouseover="document['obchod'].src = 'buttons/button11over.png' ;"
onmouseout="document['obchod'].src = 'buttons/button11up.png' ;">
    <img src="buttons/button11up.png" name="obchod";>
    </a>
    
<a href="hlavni.php?page=nastav"
onmouseover="document['nastaveni'].src = 'buttons/button13over.png' ;"
onmouseout="document['nastaveni'].src = 'buttons/button13up.png' ;">
    <img src="buttons/button13up.png" name="nastaveni";>
    </a>

<a href="hlavni.php?page=dotazy"
onmouseover="document['dotazy'].src = 'buttons/button14over.png' ;"
onmouseout="document['dotazy'].src = 'buttons/button14up.png' ;">
    <img src="buttons/button14up.png" name="dotazy";>
    </a>

<a href="hlavni.php?page=navrh"
onmouseover="document['navrhy'].src = 'buttons/button15over.png' ;"
onmouseout="document['navrhy'].src = 'buttons/button15up.png' ;">
    <img src="buttons/button15up.png" name="navrhy";>
     </a>     

<a href="hlavni.php?page=help"
onmouseover="document['help'].src = 'buttons/button16over.png' ;"
onmouseout="document['help'].src = 'buttons/button16up.png' ;">
    <img src="buttons/button16up.png" name="help";>
    </a>
    
    <a href="hlavni.php?page=pravidla"
onmouseover="document['pravidla'].src = 'buttons/button20over.png' ;"
onmouseout="document['pravidla'].src = 'buttons/button20up.png' ;">
    <img src="buttons/button20up.png" name="pravidla";>
    </a>
      
      <a href="hlavni.php?page=credits"
onmouseover="document['credits'].src = 'buttons/button18over.png' ;"
onmouseout="document['credits'].src = 'buttons/button18up.png' ;">
    <img src="buttons/button18up.png" name="credits";>
    </a>
      
      <a href="hlavni.php?page=odhlasit"
onmouseover="document['odhlasit'].src = 'buttons/button21over.png' ;"
onmouseout="document['odhlasit'].src = 'buttons/button21up.png' ;">
    <img src="buttons/button21up.png" name="odhlasit";>
    </a>
      
      <!--a href="hlavni.php?page=info"><img src="buttons/button1up.png" onmouseover="this.src = 'buttons/button1over.png';
"onmouseout="this.src = 'buttons/button1up.png';"></a-->

      <!--div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=info">info</a></span></div>
      <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=planety">planety / budovy</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=jednotky">jednotky</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=vesmir">vesmír</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=utok">útok</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=posta">pošta</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=forum">forum</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=vlada">vláda</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=politika">politika</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=ref">referenda</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=obchod">obchod</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=nastav">nastavení</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=dotazy">dotazy</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=navrh">návrhy</a></span></div>	    
            <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=help">help</a></span></div>
      	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=pravidla">pravidlá</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=credits">credits</a></span></div>>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?page=novinky">novinky</a></span></div>
	    <div class="menu_button"><span class="men_butt"><a href="hlavni.php?action=odhlasit">odhlášení</a></span></div-->
	    
      
      
      <div class="menu_paticka"></div>

	    <div class="info"></div>
	    <div class="reklama_telo"> <? include("horni-info.php"); ?></div>
	    <div class="menu_paticka"></div>

	    <div class="reklama"></div>
	    <div class="reklama_telo"> <? //include("reklama2.php"); ?> </div>
	    <div class="menu_paticka"></div>
        </div>




	<div class="telo">
	    <div class="telo_telo">
		<div class="telo_text">
			<br><br>
			<?php
      			/*if (!IsSet($_GET['page'])) { include("info.php"); } else { include("./".$_GET['page'].".php"); }*/
      			$page = $_GET["page"];
		  		if(!$page or $page=="info"){ 
          
          if ($zaznam1[rasa]==0 or ($zaznam1[rasa]>13 and $zaznam1[rasa]!=95 and $zaznam1[rasa]!=96 and $zaznam1[rasa]!=97 and $zaznam1[rasa]!=98 and $zaznam1[rasa]!=99) ): $page="vyber_rasy_restart";
          else:$page = "info";
          endif;
          
           }
      			if(file_exists("./$page.php")){
      			  include("./$page.php");}
     			else{ echo "<div align=\"center\" style=\"padding: 100px\">Stránka $page.php je zatím prázdná</div>";} 
      			?>

		</div>
	<div class="telo_paticka"></div>
	    </div>
	</div>
      </div>

    </div>
  </body>
</html>