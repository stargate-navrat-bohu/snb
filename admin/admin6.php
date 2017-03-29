<?php
mysql_query("SET NAMES cp1250");
	
function fcislo($a){
    $a=number_format($a,1,"."," ");	
    return $a;	
}
function fcislo2($a){
    $a=number_format($a,0,"."," ");	
    return $a;	
}		

$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");
$zaznam1 = MySQL_Fetch_Array($vys1);

require("adkontrola.php");

if(isset($smaznekoho)):
    $den = Date("U");
    $jmeno="$zaznam1[jmeno]";
    $rasa="Bohov�";
    $text="Hr�� $hracn byl smaz�n z d�vodu dlouhodob� neaktivity";
    MySQL_Query("INSERT INTO log (cil,den,cilt,akce,admin) VALUES ('2','$den','$hracn','smaz�n� hr��e','$zaznam1[jmeno]')");

    $v1 = MySQL_Query("SELECT jmeno,cislo,koho,email FROM uzivatele where cislo = '$smaz'");	
    $z1 = MySQL_Fetch_Array($v1);				
    $email=$z1[email];echo $email;
    $zprava="Toto je informa�n� zpr�va ze hry stargate (http://sg-nb.cz). Jeliko� jste byl dlouhou dobu neaktivn�, tak byl v� profil".$hracn." smaz�n.";
    mail ($email,"Informa�n� zpr�va ze hry SG-RTG",$zprava);

    if($z1[koho]!=$hracn):
        $kdo=$z1[koho];
        $vys5 = MySQL_Query("SELECT jmeno,volen,ref FROM uzivatele where jmeno = '$kdo'");
        $zaznam5 = MySQL_Fetch_Array($vys5);
        $kolik=$zaznam5[volen]-1;
        MySQL_Query("update uzivatele set volen = $kolik where jmeno = '$kdo'");
        MySQL_Query("DELETE FROM uzivatele WHERE cislo='$smaz'");
        MySQL_Query("DELETE FROM planety WHERE cislomaj = '$smaz'");
        MySQL_Query("DELETE FROM mul WHERE jmeno='$hracn'");
        MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");					
        MySQL_Query("DELETE FROM multaci WHERE cislo='$smaz'");
    else:
        MySQL_Query("DELETE FROM uzivatele WHERE cislo='$smaz'");			
        MySQL_Query("DELETE FROM planety WHERE cislomaj = '$smaz'");
        MySQL_Query("DELETE FROM mul WHERE jmeno='$hracn'");
        MySQL_Query("DELETE FROM obchod WHERE navrhovatel='$logjmeno'");					
        MySQL_Query("DELETE FROM multaci WHERE cislo='$smaz'");
    endif;

    // Odstraneni hlasovani v referendech - begin
    $kdo=$z1[koho];
    $vys5 = MySQL_Query("SELECT `ref`,`refn` FROM `uzivatele` where `jmeno` = '$kdo'");
    $zaznam5 = MySQL_Fetch_Array($vys5);

    $refer = MySQL_Query("SELECT `ano`,`ne` FROM `referendum` where `cislo`='0'");
    @$ref = MySQL_Fetch_Array($refer);

    if ($zaznam5[ref]==1) {
      $aaa=$ref[ano]-1;
      MySQL_Query("update `referendum` set `ano`='$aaa' where `cislo`='0'");
    } elseif ($zaznam5[ref]==2) {
      $nnn=$ref[ne]-1;
      MySQL_Query("update `referendum` set `ne`='$nnn' where `cislo`='0'");
    }

    $refer = MySQL_Query("SELECT * FROM `referendum` where `cislo`='$zaznam5[rasa]'");
    @$refn = MySQL_Fetch_Array($refer);
    if ($zaznam5[refn]==1) {
      $aaa=$refn[ano]-1;
      MySQL_Query("update referendum set ano = '$aaa' where cislo='$zaznam5[rasa]'");
    } elseif ($zaznam5[refn]==2) {
      $nnn=$refn[ne]-1;
      MySQL_Query("update referendum set ne = '$nnn' where cislo='$zaznam5[rasa]'");
    };	
    // Odstraneni hlasovani v referendech - end
    echo "<font class='text_cerveny'>Smaz�no</font>";
    exit;
endif;

?>

<h6>Hodnoty</h6>
<form name='form' method='post' action='hlavni.php?page=admin6'>
<font class="text_bili">
vypiš loginy s naquadahem nad <input type=text name=naq value=<?echo $naq;?>><br>
vypiš loginy s planetami nad <input type=text name=pla value=<?echo $pla;?>><br>
vypiš loginy se s�lou nad <input type=text name=sil value=<?echo $sil;?>><br>
z�rove� nahla�uje v�echny loginy s z�porn�m naquadahem �i z�porn�mi jednotkami<br><br>
<input type="hidden" name="kon" value="1">
<input type="submit" value="hledej"></font>
</form>

<h6>Najde v�echny hr��e, kte�� maj� s jin�m hr��em stejn� ID</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
<input type=hidden name=hledat_multaky value=1>
<input type=submit value="prohledej"><br>
<i>(m��e trvat a� n�kolik (des�tek) sekund, extr�mn� n�ro�n� na db - OMEZTE U�IT�!)</i>
</font>
</form>

<?php
    if(isset($hledat_multaky)):
		echo "<br><br><font class=text_bili><b>V�ichni hr��i se stejn�m id</b>:<br><i>(v z�vorce je uveden po�et stejn�ch cookies, kter� maj� profily spole�n�)</i></font><br><br>";	
		$ji_id1 = MySQL_Query("SELECT jmeno,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10 FROM mul order by jmeno");		
		echo "<font class=text_bili>";
	    while ($ji_zaznam = MySQL_Fetch_Array($ji_id1)):
			$id1 = MySQL_Query("SELECT jmeno,id,c1 FROM mul where jmeno='$ji_zaznam[jmeno]'");
			$zaznamm = MySQL_Fetch_Array($id1);
			$idd=$zaznamm[id];
			$id1 = MySQL_Query("SELECT jmeno,id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10 FROM mul where id='$idd' order by jmeno");
	
			$rows = mysql_query ("select count(*) from mul where id='$idd'"); 
			$celkem_lidi = mysql_fetch_row ($rows);
			
			if ($celkem_lidi[0]>1):
				echo "<b>" . $ji_zaznam[jmeno] . "</b> - ";
				while ($zaznamm = MySQL_Fetch_Array($id1)):
					if($zaznamm[jmeno]==$ji_zaznam[jmeno]):
						continues;
					else:
						echo $zaznamm[jmeno];
						$pocet_cookies=0;
						if ($zaznamm[c1]==$ji_zaznam[c1]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c2]==$ji_zaznam[c2]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c3]==$ji_zaznam[c3]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c4]==$ji_zaznam[c4]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c5]==$ji_zaznam[c5]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c6]==$ji_zaznam[c6]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c7]==$ji_zaznam[c7]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c8]==$ji_zaznam[c8]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c9]==$ji_zaznam[c9]):
							$pocet_cookies++;
						endif;
						if ($zaznamm[c10]==$ji_zaznam[c10]):
							$pocet_cookies++;
						endif;
						echo " <font color=red>(".$pocet_cookies.")</font>";																																																			
						echo ", ";
					endif;
				endwhile;
				echo "<br>";
			endif;
		endwhile;
		echo "</font>";
		endif;
?>

<h6>Najde v�echny hr��e, kte�� maj� s jin�m hr��em stejn� heslo</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
<input type=hidden name=hledat_multaky2 value=1>
<input type=submit value="prohledej"><br>
</font>
</form>

<?php

    if(isset($hledat_multaky2)){
      echo "<br><br><font class=text_bili><b>V�ichni hr��i se stejn�m heslem</b>:<br></font><br><br>";	
      $sql = "SELECT COUNT( * ) AS `pocet` , `heslo` FROM `uzivatele` GROUP BY `heslo` ORDER BY `heslo`";
      $result = mysql_query($sql, $spojeni);
      $pocet = 0;
      while($row=mysql_fetch_array($result)){
        if($row["pocet"]>1){ $pocet = 1;
          $sql = "SELECT jmeno FROM uzivatele WHERE heslo = '{$row["heslo"]}'";
          $result2 = mysql_query($sql, $spojeni);
          if(mysql_num_rows($result)>0){
            while($row2=mysql_fetch_array($result2)){
              echo $row2["jmeno"]." - ";
            }
            echo "<br>\r\n";
          }
        }
      }
      if($pocet==0){
        echo "Nebyl nalezen z�dn� u�ivatel se stejn�m heslem";
      }	
		}

?>

<br>

<h6>Nabour�v�n� do loginu</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
Jm�no: <input type='text' name='nabourej' size='15' value="zadat jm�no">&nbsp;&nbsp;
V�e: <input type=radio name=vse value=2 checked>&nbsp;&nbsp;
Nezda�en�: <input type=radio name=vse value=1>
<input type=submit value="vypi�" name="akcenab"><br>
</font>
</form>
</table>

<?php
if(isset($akcenab)):	

    $vys1 = MySQL_Query("SELECT * FROM error where jmeno='$nabourej' and result!='$vse' order by datum ASC");
    $zaznam2=MySQL_Fetch_Array($vys1);

    echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jm�no</th>";
	echo "<th colspan=1><font color=white>den</th>";
	echo "<th colspan=1><font color=white>IP</th>";
	echo "<th colspan=1><font color=white>Result</th>";
	echo "</tr>";

    while ($zaznam1=MySQL_Fetch_Array($vys1)) {
        $den = Date("j.m.Y G:i:s",$zaznam1["datum"]);

        echo "<tr>";
        echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
        echo "<td><font color=white>".$den."</td>";
        echo "<td><font color=white>".$zaznam1[ip]."</td>";
        echo "<td><font color=white>".$zaznam1[result]."</td>";
        echo "</tr>";
    }

    echo "</table>";
endif;

?>

<br>

<h6>Najdi IP</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
IP adresa: <input type='text' name='ipn' size='15' value="zadat ip">&nbsp;&nbsp;
<input type=submit value="hledat" name="akceip"><br>
</font>
</form>
</table>
<?php

if(isset($akceip)):	

    $vys1 = MySQL_Query("SELECT jmeno,ip FROM uzivatele where ip='$ipn' ");

    echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jm�no</th>";
	echo "<th colspan=1><font color=white>IP</th>";
	echo "</tr>";

    $zaznam1=MySQL_Fetch_Array($vys1);

    echo "<tr>";
    echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
    echo "<td><font color=white>".$zaznam1[ip]."</td>";
    echo "</tr>";
					
    echo "</table>";
endif;

?>

<br>

<h6>Vyp�e registra�n� kolonku Kdo v�m o h�e �ekl</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
<input type=hidden name=rekl value=1>
<input type=submit value="vypi�"><br>
<i>(m��e trvat a� n�kolik (des�tek) sekund, extr�mn� n�ro�n� na db - OMEZTE U�IT�!)</i>
</font>
</form>
<?php

if(isset($rekl)):
    $vys1=MySQL_Query("SELECT jmeno,rekl FROM uzivatele where rekl!='nikdo' and rekl!=' ' order by rekl");
    $zaznam2=MySQL_Fetch_Array($vys1);

    echo "<center><table border=1 width=50%>";
	echo "<tr>";
	echo "<th colspan=1><font color=white>Jm�no</th>";
	echo "<th colspan=1><font color=white>�ekl</th>";
	echo "</tr>";

    $counter = 1;
    while ($zaznam1=MySQL_Fetch_Array($vys1)) {
        echo "<tr>";
        echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
        echo "<td><font color=white>".$zaznam1[rekl]."</td>";
        echo "</tr>";
        $counter++;
    }					
    echo "</table>";
endif;

?>

<br>

<h6>Vyp�e hr��e s neaktivitou del�� ne�</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
<input type='text' name='smazdny' size='3' value=<?echo $smazdny;?>>dn�
<input type=submit value="vypi�"><br>
<i>(m��e trvat a� n�kolik (des�tek) sekund, extr�mn� n�ro�n� na db - OMEZTE U�IT�!)</i>
</font>
</form>
</table>
<?php
	if(isset($smazdny)):	
		$d=Date("U")-86400;
		$e=Date("U");
		$smazdny*=86400;

        $vys1 = MySQL_Query("SELECT jmeno,den,koho,cislo,rasa,zmrazeni FROM uzivatele where ( ($d-den)>$smazdny and rasa!=20 and zmrazeni<$d)");
        $zaznam2=MySQL_Fetch_Array($vys1);

        echo "<center><table border=1 width=50%>";
        echo "<tr>";
        echo "<th colspan=1><font color=white>Jm�no</th>";
        echo "<th colspan=1><font color=white>Dn�</th>";
        echo "<th colspan=1><font color=white>Stav zmra�en�</th>";
        echo "<th colspan=1><font color=white>Rasa</th>";
        echo "<th colspan=1><font color=white>Sma�</th>";
        echo "</tr>";

        $counter = 1;
        while ($zaznam1=MySQL_Fetch_Array($vys1)) {
            $datum1=$zaznam1[den];
            $datum2=Date("U");
            $datum1=$datum2-$datum1;
            $datum1=$datum1/3600;
            $datum1=$datum1/24;
            $datum1=Round($datum1);

            echo "<tr>";
            echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
            echo "<td><font color=white>".$datum1."</td>";
            echo "<td><font color=white>".$zaznam1[zmrazeni]."</td>";
            echo "<td><font color=white>".$zaznam1[rasa]."</td>";
            echo "<td>
                <form name='form1' method='post' action='hlavni.php?page=admin6'>
                <input type='hidden' name=hracn value='".$zaznam1[jmeno]."'>
                <input type='hidden' name=smaz value='".$zaznam1[cislo]."'>
                <input type='submit' name='smaznekoho' value='Sma�'>
                </form>
                </td>";
            echo "</tr>";
            $counter++;
        }
        echo "</table>";
    endif;

?>

<br>


<h6>Vyhledat hr��e s po�kozen�m obchodem planet:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
<input type=hidden name=chybka value=1>
<input type=submit value="vypi�"><br>
<i>(m��e trvat a� n�kolik (des�tek) sekund, extr�mn� n�ro�n� na db - OMEZTE U�IT�!)</i>
</font>
</form>

<?php
if(isset($chybka)):		
  $vys1=MySQL_Query("SELECT jmeno,plan_koupe,plan_prodej FROM uzivatele where plan_koupe='4' or plan_prodej='4' or plan_prodej<'0' or plan_koupe<'0' ");
  $zaznam2=MySQL_Fetch_Array($vys1);

  echo "<center><table border=1 width=50%>";
    echo "<tr>";
    echo "<th colspan=1><font color=white>Jm�no</th>";
    echo "<th colspan=1><font color=white>Stav obchodu</th>";
    echo "<th colspan=1><font color=white>Stav obchodu2</th>";
    echo "</tr>";

    echo "</tr>";
    $counter = 1;
    while ($zaznam1=MySQL_Fetch_Array($vys1)) {
        echo "<tr>";
        echo "<th><font color=white>".$zaznam1[jmeno]."</th>";
        echo "<th><font color=white>".$zaznam1[plan_koupe]."</th>";
        echo "<th><font color=white>".$zaznam1[plan_prodej]."</th>";
        echo "</tr>";
        $counter++;
    }
    echo "</table>";
endif;

?>
<br>

<h6>Opravit prodej planet:</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
<input type=hidden name=chybkax value=1>
<input type=submit value="oprav"><br>
<i>(Pou��vat pouze po p�edchoz�m vyhled�n�)</i>
</font>
</form>

<?php

if(isset($chybkax)):		
    $vys1=MySQL_Query("SELECT jmeno,plan_koupe,plan_prodej FROM uzivatele where plan_koupe='4' or plan_prodej='4' or plan_prodej<'0' or plan_koupe<'0' ");
    $zaznam2=MySQL_Fetch_Array($vys1);
    $opravap=2;
    $opravak=2;

    MySQL_Query("update uzivatele set plan_koupe=$opravak where plan_koupe='4' or plan_koupe<'0' ");
    MySQL_Query("update uzivatele set plan_prodej=$opravap where plan_prodej='4' or plan_prodej<'0' ");

endif;

if(isset($kon)):
    echo "<font color=red>Loginy se z�porn�m naquadahem</font><br>";
    echo "<font class=text_bili>";
    $znaq2 = MySQL_Query("SELECT jmeno,penize FROM uzivatele where penize<0");	
    while($znaq = MySQL_Fetch_Array($znaq2)):
        echo $znaq[jmeno]." m� ".fcislo($znaq[penize])." naquadahu<br>";
    endwhile;
    echo "</font>";

    echo "<font color=red>Loginy se z�porn�mi jednotkami</font><br>";
    echo "<font class=text_bili>";
    $znaq2 = MySQL_Query("SELECT jmeno,jed1,jed2,jed3,jed4,jed5 FROM uzivatele where (jed1<0 or jed2<0 or jed3<0 or jed4<0 or jed5<0)");	
    while($znaq = MySQL_Fetch_Array($znaq2)):
        echo $znaq[jmeno]." m� ";
        if($znaq[jed1]<0){echo fcislo2($znaq[jed1])." jednotek1 ";};
        if($znaq[jed2]<0){echo fcislo2($znaq[jed2])." jednotek2 ";};
        if($znaq[jed3]<0){echo fcislo2($znaq[jed3])." jednotek3 ";};
        if($znaq[jed4]<0){echo fcislo2($znaq[jed4])." jednotek4 ";};
        if($znaq[jed5]<0){echo fcislo2($znaq[jed5])." jednotek5 ";};
        echo "<br>";
    endwhile;
    echo "</font>";				

    if($naq!=""):
        echo "<font class=text_modry>Loginy s naquadahem v�t��m ne� ".fcislo($naq)."</font><br>";
        echo "<font class=text_bili>";
        $naq2 = MySQL_Query("SELECT jmeno,penize FROM uzivatele where penize>$naq");	
        while($naq = MySQL_Fetch_Array($naq2)):
            echo $naq[jmeno]." m� ".fcislo($naq[penize])." naquadahu<br>";
        endwhile;
        echo "</font>";
    endif;

    if($pla!=""):
        echo "<font class=text_modry>Loginy s planetemi v�t�� ne� $pla</font><br>";
        echo "<font class=text_bili>";
        $plan2 = MySQL_Query("SELECT jmeno,planety FROM uzivatele where planety>$pla");	
        while($plan = MySQL_Fetch_Array($plan2)):
            echo "$plan[jmeno] m� $plan[planety] planet<br>";
        endwhile;			
        echo "</font>";				
    endif;			

    if($sil!=""):
        echo "<font class=text_modry>Loginy se s�lou v�t�� ne� ".fcislo($sil)."</font><br>";
        echo "<font class=text_bili>";
        $sila2 = MySQL_Query("SELECT jmeno,sila FROM uzivatele where sila>$sil");	
        while($sila = MySQL_Fetch_Array($sila2)):
            echo "$sila[jmeno] m� s�lu ".fcislo($sila[sila])."<br>";
        endwhile;			
        echo "</font>";				
    endif;							

endif;

if(isset($hlasy)):
    $den = Date("U");
    MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('6',$den,'vsichni','srovn�n� hlas�','N/A','$zaznam1[jmeno]')");

    $i=1000000;
    $vys11 = MySQL_Query("select cislo,jmeno,koho from uzivatele");
    while($zaznam11 = MySQL_Fetch_Array($vys11)):
        $prom="p".$zaznam11[koho];
        $$prom++;
    endwhile;

    $vys11 = MySQL_Query("select cislo,jmeno,koho from uzivatele");
    while($zaznam11 = MySQL_Fetch_Array($vys11)):
        $prom="p".$zaznam11[jmeno];
        $kolik=0;
        $kolik=$$prom;
        //echo $zaznam11[jmeno]." m� hlas�: ".$kolik."<br>";
        MySQL_Query("update uzivatele set volen=$kolik where cislo=$zaznam11[cislo]");
    endwhile;		
endif;

if(isset($stat)):
    $den = Date("U");
    MySQL_Query("INSERT INTO log (cil,den,cilt,akce,konk,admin) VALUES ('7',$den,'vsichni','srovn�n� s�ly','N/A','$zaznam1[jmeno]')");

    $j=1;
    while($j<12):
        $vys2 = MySQL_Query("SELECT rasa,jed1_utok,jed2_utok,jed4_utok,jed1_obrana,jed2_obrana,jed4_obrana FROM rasy where rasa='$j'");	
        $zaznam2 = MySQL_Fetch_Array($vys2);
        $vys11 = MySQL_Query("select cislo,jed1,jed2,jed4,jed5,narod,zrizeni from uzivatele where rasa=$j");
        while($zaznam11 = MySQL_Fetch_Array($vys11)):
            $kdez = $zaznam11[zrizeni];
            $kden = $zaznam11[narod];

            $xcz =  MySQL_Query("select cislo,utok,obrana from zrizeni where cislo='$kdez'");
            $xczy = MySQL_Fetch_Array($xcz);
            $xcn =  MySQL_Query("select cislo,utok,obrana from narody where cislo='$kden'");
            $xcny = MySQL_Fetch_Array($xcn);

            $bonusut=$xcny[utok]/100;
            $bonusut*=$xczy[utok]/100;

            $bonusob=$xcny[obrana]/100;
            $bonusob*=$xczy[obrana]/100;

            $u1=0;
            $u1=$zaznam11["jed1"]*$zaznam2["jed1_utok"]*$bonusut;
            $u1+=$zaznam11["jed2"]*$zaznam2["jed2_utok"]*$bonusut;
            $u1+=$zaznam11["jed4"]*$zaznam2["jed4_utok"]*$bonusut;
            //$u1+=$zaznam11["jed5"]*$zold_utok;
            $u1+=$zaznam11["jed1"]*$zaznam2["jed1_obrana"]*$bonusob;
            $u1+=$zaznam11["jed2"]*$zaznam2["jed2_obrana"]*$bonusob;
            $u1+=$zaznam11["jed4"]*$zaznam2["jed4_obrana"]*$bonusob;
            //$u1+=$zaznam11["jed5"]*$zold_obrana;
            MySQL_Query("update uzivatele set sila='$u1' where cislo='$zaznam11[cislo]'");
            //echo $u1;echo"<br>";
        endwhile;
        $j++;
    endwhile;		
endif;
MySQL_Close($spojeni);
?>
<h6>Hlasy</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
Srovn�n� hlas� <input type=hidden name=hlasy value=1>
<input type=submit value="srovnej"></font>
</form>

<h6>S�la</h6>
<form name='form1' method='post' action='hlavni.php?page=admin6'>
<font class=text_bili>
Srovn�n� s�ly <input type=hidden name=stat value=1>
<input type=submit value="srovnej"></font>
</form>
