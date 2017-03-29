<?
mysql_query("SET NAMES cp1250");
setcookie("logjmeno",$jmeno1,time()+10800);
setcookie("logheslo",md5($heslo1),time()+10800);
/*
if(empty($k)):
	mt_srand(time());
	$c=mt_rand(1000000000,9999999999);
	setcookie("k",$c,time()+5184001);
endif;*/
Header ("Cache control: no-cache");
?>
<html>
<head>
<title> .::: STARCRAFT RETURN OF THE GOD :::.</title>
<script language="JavaScript" src="a.php" >
</script>

<style type="text/css">
@import url(sty6.css);
#tab{background-repeat:no-repeat;}
</style>
</head>
<?
if($color_hr==""){$color_hr="#cc6600";};

	$dobre=0;
		require "data_1.php";

if($zaznam1[jmeno]!='puchy2' and $zaznam1[jmeno]!='george111' and $zaznam1[jmeno]!='ACE1' and $zaznam1[jmeno]!='Bandur'){echo "<h1>Nejste admin proto nemáte pøístup do admin rozhraní.</h1>";exit;};

		@$vysledek = MySQL_Query("SELECT jmeno,admin,heslo,cislo,rasa FROM  uzivatele ORDER BY jmeno");
		if (!$vysledek):
		  echo "<h1>Bohužel se nepodaøilo pøipojit k DB</h1>";
		  exit;
		endif;


//exit;
		$ah="c22ff79a02363de9b0861e20662f72cd";
		$hm=md5($ahu);
		if(isset($jmeno1) and $ah==$hm):
			if(isset($jmeno1)):
				$heslo1=md5($heslo1);
				while ($zaznam = MySQL_Fetch_Array($vysledek)):
		 		 if($zaznam["jmeno"]==$jmeno1):
			    	   $dobre=1;
					break;
               	 endif;
			  	endwhile;

				$cislo=$zaznam[cislo];
	
				if (($dobre==1) && ($zaznam["heslo"]==$heslo1)):
					if($jmeno1=="kronikáø"):
						echo "<script languague='JavaScript'>location.href='kron.php'</script>";
					else:
						@$kuk = MySQL_Query("SELECT * FROM  mul where jmeno = '$jmeno1'");
						$id=$REMOTE_ADDR;
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
						MySQL_Query("INSERT INTO online values('$jmeno1',$t)");
					
						?>
						<script>
						function uloz(jmeno, hodnota, platnost_dni) {
						  var datum= new Date();
						  var dobaPlatnosti= platnost_dni*24*60*60*1000;
						  datum.setTime(datum.getTime()+dobaPlatnosti);
						  document.cookie= jmeno+"="+hodnota+";expires="+datum.toGMTString();
							}

						uloz("logcislo",<?echo $cislo?>,2);
						</script>
<?
						//echo $adresa;
						//exit;".$adresa."
						echo "<script languague='JavaScript'>location.href='hlavni.php'</script>";
					endif;
				elseif($dobre==0):
					echo "<h1>Chyba neexistuje tento uživatel</h1>";
				else:
					echo "<h1>špatné heslo</h1>";
				endif;	
			endif;
		elseif(isset($jmeno1)):
			echo "<h1>Špatné heslo</h1>";
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
?>
<body bgColor=#000000><center>
<br><br>
<CENTER>
<h1>Toto je servisní pøístup, jen pro zvanné.</h1>
<FONT class=info>
<P align=center><IMG src="hlavni_pozadi.jpg"> 
<P><FONT color=#cc6600>V</FONT><FONT color=#ffffff>ítejte na úvodní stránce hry 
STARGATE, inspirovanou televizním filmem a následnì seriálem stargate(hvìzdná 
brána). Abyste si mohli zahrát staèá se jen <A id=a onmouseover="Rozsvitit('a')" 
onmouseout="Zhasnout('a')" 
href="registrace.php">zaregistrovat</A> a pak se už 
pøihlásit a hrát. Doporuèuji si pøeèít <A id=b onmouseover="Rozsvitit('b')" 
onmouseout="Zhasnout('b')" href="help/" 
target=_blank>help</A>. Kdykoliv si svùj profil mùžete <A id=c 
onmouseover="Rozsvitit('c')" onmouseout="Zhasnout('c')" 
href="smazat.php">smazat</A>. Statistiky ras <A id=d 
onmouseover="Rozsvitit('d')" onmouseout="Zhasnout('d')" 
href="stat.php" target=_blank> zde</A>. Upozoròuji, že tyto stránky 
potøebují podporu javascriptu, kaskádových stylù (cascading style sheet) a 
povolení ukládání cookies. Pøeji pøíjemnou hru.&nbsp;</FONT> </P>
<P></FONT></P>
</font>
<FORM name=form action=servis.php method=post><INPUT type=hidden value=1 
name=zpracuj> 
<TABLE height=199 width=184 background=brana_pozadi.jpg id="tab" border=0>
  <TBODY>
  <TR>
    <TD width=193 height=21>&nbsp;</TD></TR>
  <TR>
    <TD width=193 height=118>
      <TABLE height=112 width=194>
        <TBODY>
        <TR>
          <TD width=100 height=25><B><FONT class=kapital>J</FONT>méno:</B> </TD>
          <TD width=85 height=25><B><input type="text" name="jmeno1" size=15 value=''></B></TD></TR>
        <TR>
          <TD width=100 height=25><B><FONT class=kapital>H</FONT>eslo:</B> </TD>
          <TD width=85 height=25><B><input type="password" name="heslo1" size=15 value=''></B></TD></TR>
        <TR>
          <TD width=100 height=25><B><FONT class=kapital>S</FONT>ervis heslo:</B> </TD>
          <TD width=85 height=25><B><input type="password" name="ahu" size=15 value=''></B></TD></TR>		  
        <TR>
          <TD width=100 height=19><B><FONT 
            class=kapital>P</FONT>rofilù:&nbsp;&nbsp;</B> </TD>
          <TD width=85 height=19><B><FONT color=#cc6600><?echo $hhh;?></FONT></B></TD></TR>
        <TR>
          <TD width=100 height=19><B><FONT 
            class=kapital>O</FONT>nline hráèù:&nbsp;&nbsp;</B> </TD>
          <TD width=85 height=19><B><FONT color=#cc6600><?echo $o;?></FONT></B></TD></TR>
        <TR>
          <TD width=100 height=19><B><FONT 
            class=kapital>D</FONT>nes hráèù:&nbsp;&nbsp;</B> </TD>
          <TD width=85 height=19><B><FONT color=#cc6600><?echo $dnes;?></FONT></B></TD></TR>		  
        <TR>
 <?
	if($o<=100):	
		echo "<TD align=middle width=162 colSpan=2 height=27><B><INPUT type=submit value=Pøihlaš name=B3></B>";
	else:
		echo "<TD align=middle width=162 colSpan=2 height=27><B>Je pøíliš online hráèù, zkuste pozdìji.</B>";	
	endif;
?>
    <br><font class=info><a href="heslozap.php" id=e onmouseover="Rozsvitit('e')" onmouseout="Zhasnout('e')"><i>Zapomnìli jste své heslo?</i></a></font>
	</TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD width=193 height=48><B>&nbsp;</B></TD></TR></TBODY></TABLE><INPUT 
type=hidden value=1 name=zpracuj> </FORM>
<iframe frameborder="1" noresize="resize" height="300" width="90%" src="http://www.sweb.cz/aegor/reklama.htm" name="reklama"></iframe>

<P class=info align=left><FONT color=#ffffff>Jákekoliv dotazy pripomínky mi 
piste na postu v sg na jméno sg. Nebo na <A 
href="mailto:sgweb@seznam.cz">sgweb@seznam.cz</A></FONT><br><FONT 
class=kapital>C</FONT><FONT color=#ffffff>redits:</FONT></P>
<P align=left>
<TABLE width="34%" border=0>
  <TBODY>
  <TR>
    <TD width="33%">.<FONT color=#ffffff>: Tomáš Fechtner</FONT></TD>
    <TD align=middle width="33%"><FONT color=#cc6600>sg</FONT></TD>
    <TD align=right width="34%"><FONT color=#ffffff>programing, DB :.</FONT></TD></TR>
  <TR>
    <TD width="33%"><FONT color=#ffffff>.: Laïa Loukota</FONT></TD>
    <TD align=middle width="33%"><FONT color=#cc6600>Raynor</FONT></TD>
    <TD align=right width="34%"><FONT color=#ffffff>obrázky a texty 
    :.</FONT></TD></TR>
  <TR>
    <TD width="33%"><FONT color=#ffffff>.: Johny Idler</FONT></TD>
    <TD align=middle width="33%">&nbsp;</TD>
    <TD align=right width="34%"><FONT color=#ffffff>kronika, DB :.</FONT></TD></TR>
  <TR>
    <TD width="33%"><FONT color=#ffffff>.: Marek B</FONT></TD>
    <TD align=middle width="33%"><FONT color=#cc6600>Sin_Jin_Hook</FONT></TD>
    <TD align=right width="34%"><FONT color=#ffffff>grafika 
  :.</FONT></TD></TR>
    <TR>
    <TD width="33%"><FONT color=#ffffff>.: Honza Z</FONT></TD>
    <TD align=middle width="33%"><FONT color=#cc6600>Aegor</FONT></TD>
    <TD align=right width="34%"><FONT color=#ffffff>texty, reklama 
  :.</FONT></TD></TR>
    <TR>
    <TD width="33%"><FONT color=#ffffff>.: Sinuhet</FONT></TD>
    <TD align=middle width="33%"><FONT color=#cc6600>&nbsp;</FONT></TD>
    <TD align=right width="34%"><FONT color=#ffffff>strážce brány 
  :.</FONT></TD></TR>
    <TR>
    <TD width="33%"><FONT color=#ffffff>.: Láïa Farják</FONT></TD>
    <TD align=middle width="33%"><FONT color=#cc6600>&nbsp;</FONT></TD>
    <TD align=right width="34%"><FONT color=#ffffff>programing
  :.</FONT></TD></TR>     </TBODY></TABLE>
<center>

<br><br>
<center><font class=info>Použité obrazové materiály z her série Command&Conquer, Empire Earth, StarCraft, Warcraft, World of Warcraft, Civilization-3, Homeworld-2, Fallout Tactics, Fallout-2, Sid Meier's Alpha Centauri, Serious Sam, Treasure Planet: Battle for Natrolis, Age of Mythology, Republic:the revolution, Atlantia Underwordl Tyccon, Mafia, Imperium Galactica-3, ; seriálù Star Trek:Voyager, Enterprise, Stargate SG-1 ; filmu Terminátor-3 ; dále použity materiály (nejen obrazové) z SG Game a 3D-UK.</font></center>

<?
//<iframe noresize=noresize frameborder=0 height=200 width=100% src="novinky.php" name="novinky"></iframe>
	echo "</center>";
	MySQL_Close($spojeni);
?>
</tbody>
</table>
</body>
</html>
