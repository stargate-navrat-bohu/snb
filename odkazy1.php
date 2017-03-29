<?
Header ("Cache control: no-cache");
?>
<HTML> 
<HEAD>


 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
		require "data_1.php";

		$vys1 = MySQL_Query("SELECT cislo,jmeno,rasa,vek,timedora,timezra FROM uzivatele where cislo='$logcislo'") or die(mysql_error());
		$zaznam1 = MySQL_Fetch_Array($vys1);
?>

<STYLE type="text/css"> 
<!-- 
A { 
font-family:Verdana, Sans-Serif; 
font-weight:bold; 
text-decoration:none; 
color:#0099FF; 
font-size:8pt; 
} 
A:hover { 
background-color:0099FF; 
color:black; 
} 

H1 { 
color:#0099FF; 
} 
BODY { 
background-color:black; 
color:orange; 
} 
--> 
</STYLE> 

</HEAD> 

<BODY> 
<?
  $i=$zaznam1["rasa"];
?>


<DIV align="center"> 
<table width="100" border="0" background="<? echo'.$i.'; ?>.jpg" height="120" align="center">
<br>
<A href="info.php" target="hlavni">&nbsp;Info&nbsp;</A> <br>
<A href="planety.php" target="hlavni">&nbsp;Planety&nbsp;</A> <br>
<A href="jednotky.php" target="hlavni">&nbsp;Jednotky&nbsp;</A> <br>
<A href="vesmir.php" target="hlavni">&nbsp;Vesmír&nbsp;</A> <br>

<A href="utok.php" target="hlavni">&nbsp;Útok&nbsp;</A> <br>
<A href="posta.php" target="hlavni">&nbsp;Pošta&nbsp;</A> <br>
<A href="forum.php" target="hlavni">&nbsp;Forum&nbsp;</a><br>
<A href="vlada.php" target="hlavni">&nbsp;Vláda&nbsp;</A> <br>
<A href="politika.php" target="hlavni">&nbsp;Politika&nbsp;</A> <br>
<A href="ref.php" target="hlavni">&nbsp;Hlasování&nbsp;</A> <br>
<A href="fond.php" target="hlavni">&nbsp;Fondy&nbsp;</A> <br>
<A href="obchod.php" target="hlavni">&nbsp;Obchod&nbsp;</A> <br>
<A href="nastav.php" target="hlavni">&nbsp;Osobní nastavení&nbsp;</A> <br>
<A href="http://www.sg-rtg.net/help/" target="hlavni">&nbsp;Help &nbsp;</A> <br>
<A href="http://www.sg-rtg.net/kronika/" target="hlavni">&nbsp;Kronika &nbsp;</A> <br>

<A href="dotazy.php" target="hlavni">&nbsp;Dotazy&nbsp;</A> <br>
<A href="bug.php" target="hlavni">&nbsp;Bugy&nbsp;</A> <br>

<A href="odhlasit.php" target=_parent>&nbsp;Odhlášení&nbsp;</A> <br>


</BODY> 
</HTML>
