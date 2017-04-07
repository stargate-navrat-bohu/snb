
<style type="text/css">
@import url(default.css);
</style>

<?php
require 'data_1.php';

mysql_query("SET NAMES cp1250");


$konstrozdil=1; $pocetras = 6;

function kont($co,$cim){
  if($co==$cim){ echo "checked"; }
}

function kont2($co,$cim){
  if($co==$cim){ echo "selected"; }
}
	
	$i=1;
	$rasa2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa<($pocetras+1) and rasa>0) order by rasa");
	$udaju=mysql_num_rows($rasa2);
	for($cislo=0;$cislo<$udaju; $cislo++){
    $rasn[$cislo] = mysql_result($rasa2, $cislo, "nazev");
    $j[$cislo] = mysql_result($rasa2, $cislo, "nazev");
  }

    // narodnosti
    $bonusy[1]="��dn� klady";
  	$negativy[1]="��dn� z�pory";
  	$bonusy[2]="-20% cena t�ebny";
  	$negativy[2]="-10 �tok, +10% cena p�choty";
  	$bonusy[3]="-15% ceny v obchod�, +5% v�zkum";
  	$negativy[3]="+30% cena t�ebny";
  	$bonusy[4]="-25% cena p�choty, -5% ceny ZHN";
  	$negativy[4]="-20% spokojenost, +20% ceny v obchod�";
  	$bonusy[5]="+20% spokojenost, +10% obrana";
  	$negativy[5]="+20% cena p�choty, +100% ceny ZHN";
  	$bonusy[6]="+30% na v�zkum";
  	$negativy[6]="-15% �tok, +100% ceny ZHN";
  	$bonusy[7]="+25% obrana";
  	$negativy[7]="+15% cena p�choty, -10% �tok";
  	$bonusy[8]="+10% spokojenost, +10% na v�zkum";
  	$negativy[8]="+50% cena t�ebny, +100% ceny ZHN";
  	$bonusy[9]="-25% cena t�ebny";
  	$negativy[9]="-20% �tok";

    // statni zrizeni
  	$bonusy1[1]="��dn� klady";
  	$negativy1[1]="��dn� z�pory";
  	$bonusy1[2]="+10% spokojenost";
  	$negativy1[2]="-20% �tok";
  	$bonusy1[3]="-20% cena bojov�ch jednotek";
  	$negativy1[3]="-15% spokojenost, +10% cena t�ebny";
  	$bonusy1[4]="+25% �tok, -10% cena ZHN";
  	$negativy1[4]="-25% spokojenost, -10% obrana";
 	  $bonusy1[5]="+25% na v�zkum";
  	$negativy1[5]="-10% �tok, nemo�nost budovat ZHN";
  	$bonusy1[6]="+50% obrana, -20% cena ZHN";
  	$negativy1[6]="-25% �tok";
  	$bonusy1[7]="-25% cena t�ebny";
  	$negativy1[7]="-10% �tok";
  	$bonusy1[8]="-30% cena planety";
  	$negativy1[8]="-5% �tok, +10% cena bojov�ch jednotek";
  	$bonusy1[9]="-50% cena ZHN";
  	$negativy1[9]="-50% spokojenost";



	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho,rasa,penize FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	


if($zaznam1[rasa]!=77){ echo"<font class='text_cerveny' size='19'>..:Zde nem�te pr�vo b�t:..</font>";exit; }


	$vys2 = MySQL_Query("SELECT rasa,uzi,nazevrasy FROM rasy where (rasa!=99 and rasa!=0 and rasa!=98 and rasa!=97) order by rasa");
	$celkuzi=0;
	while($zaznam2 = MySQL_Fetch_Array($vys2)):
		$celkuzi+=$zaznam2["uzi"];
		$pocuziv[]=$zaznam2["uzi"];
		$nr[]=$zaznam2["nazevrasy"];	
	endwhile;
	$prumuzi=Round($celkuzi/$pocetras);


echo "<center>";

echo "<h6>Pr�v� prob�hl restart hry. Pros�me vyberte si rasu, dobu sv�ho p�epo�tu a druh politiky a ode�lete formul��.</h6>";

echo "</center>";



if($zaznam1[rasa]!=77){
	


echo "<h1>Zde nem�te co pohled�vat!!!</h1>";exit;}





//****************************************************V�b�r Restart SQL************************************


	if(isset($vyber_restart)):

$datum=Date(U);

		$penize_1 = MySQL_Query("SELECT rasa,vyr_vyrob FROM rasy where rasa = '$rasa'");
		$penize_2 = MySQL_Fetch_Array($penize_1);

$ppenize=200000*$penize_2["vyr_vyrob"];

	//	MySQL_Query("update `uzivatele` set  `rasa`='$rasa',`penize`=$penize_d,`narod`='$narrod',`zrizeni`='$zrizeni',`zmenanar`='$datum',`zmenazri`='$datum',`prepocet`='$prepocet',`prepocet_voj`='$prepocet' where `cislo`=$logcislo");
	MySQL_Query("update `uzivatele` set  `rasa`='$rasa',`penize`=$ppenize,`narod`='$narrod',`zrizeni`='$zrizeni',`zmenanar`='$datum',`zmenazri`='$datum',`prepocet`='$prepocet',`prepocet_voj`='$prepocet' where `cislo`=$logcislo");

      echo "<script languague='JavaScript'>location.href='hlavni.php?page=info'</script>";

	endif;	



//****************************************************Restart Formul��************************************

    $border= 'border=1';

    echo "<center><TABLE ".$border.">";

		echo "<form action='vyber_rasy_restart.php' method='post'>";

                echo "<tr><th colspan=2>Vypl�te formul��</th></tr>";

		echo "<tr>";
		echo "<th>Rasa</th>";

?>
		<th>


	 <select name='rasa' class='input'>
        <option value='77'>vyberte</option>
      <?php
		  for($i=0;$i<$udaju;$i++):
		    $j = $i; $js = $i+1;
		    if(($prumuzi+$konstrozdil)>$pocuziv[$i]){echo "<option value=".$js." "; kont2($rasa1, $js); echo ">".$rasn[$j]."</option>\r\n";}
		  endfor;
        ?>

      </select></th>
     </tr>
<?php

		echo "<tr>";
		echo "<th>P�epo�et</th>";
		echo "<th>
	<select name='prepocet'>
  		  <option selected>00
        	  <option>01
  		  <option>02
        	  <option>03
   		  <option>04
        	  <option>05
  		  <option>06
        	  <option>07
        	  <option>08
  		  <option>09
        	  <option>10
 		  <option>11
                  <option>12
        	  <option>13
   		  <option>14
        	  <option>15
                  <option>16
    		  <option>17
        	  <option>18
     		  <option>19
        	  <option>20
      		  <option>21
       		  <option>22
       		  <option>23
		</select></th>";
		echo "</tr>";


		echo "<tr>";
		echo "<th>N�rod</th>";
		echo "<th>      
	<select name='narrod' class='input'>
        <option value='1'>vyberte</option>
        <option value=1 >1. typ
        <option value=2 >2. typ
        <option value=3 >3. typ
        <option value=4 >4. typ
        <option value=5 >5. typ
        <option value=6 >6. typ
        <option value=7 >7. typ
        <option value=8 >8. typ
        <option value=9 >9. typ
      </select></th>";
		echo "</tr>";



		echo "<tr>";
		echo "<th>Z��zen�</th>";
		echo "<th>      
	<select name='zrizeni' class='input'>
        <option value='1'>vyberte</option>
        <option value=1 >1. typ
        <option value=2 >2. typ
        <option value=3 >3. typ
        <option value=4 >4. typ
        <option value=5 >5. typ
        <option value=6 >6. typ
        <option value=7 >7. typ
        <option value=8 >8. typ
        <option value=9 >9. typ
      </select></th>";
		echo "</tr>";



		echo "<tr>";
		echo "<th colspan=2>&nbsp;</th>";
		echo "</tr>";

		echo "<tr>";
		echo "<input type='hidden' name='vyber_restart' value='1'>";
		echo "<th colspan=2><input type='submit' value='Odeslat'></th>";
		echo "</form>";
		echo "</tr>";

		echo "</table><br />";




?>

<font class="text_bili"><h2>Detaily</h2></font>
<font class="text_modry">Na vyv�enost ras je ovliv�ov�n po�et u�ivatel� v jednotliv�ch ras�ch. Je to pr�m�r u�ivatelu na jednu rasu s maxim�ln�m nav��en�m 
<?= $konstrozdil ?> 
u�ivatel�. V n�sleduj�c� tabulce je p�ehled ras s po�ty u�ivatel� v nich.
Limit: <?= ($prumuzi+$konstrozdil); ?></font>
<table class='table' align="center" cellpadding=0 cellspacing=0>
  <tr class="vrsek">
    <th>N�zev rasy</th>
    <th>Po�et u�ivatel�</th>
    <th>P�ihl�sit</th>
  </tr>
<?php

	$i=0;
	while($i<$pocetras):
		echo "<tr class='spodek'>";
		if(($prumuzi+$konstrozdil)>$pocuziv[$i]):
			$barva="#0099FF";
			$barva2="white";
			$prihlasit="lze";
		else:
			$barva="red";
			$barva2="red";
			$prihlasit="nelze";
		endif;
		 echo "<td><font color='".$barva."'>".$nr[$i]."</font></td>";
		 echo "<td><font color=".$barva2.">".$pocuziv[$i]."</font></td>";
		 echo "<td><font color=".$barva2.">".$prihlasit."</font></td>";
		echo "</tr>";
		$i++;
	endwhile;
      ?>
</table>
<br>
<font class="text_bili"><h2>Seznam n�rodnost�</h2></font>
<table class="table" align="center" cellpadding=0 cellspacing=0>
  <tr class="vrsek">
    <th>��slo</th>
    <th>Bonusy</th>
    <th>Negativy</th>
  </tr>
  <?php
      $i=1;
	  while($i<10):
		  echo "<tr class='spodek'>";
		  echo "<td><font color='".$barva."'>".$i."</font></td>";
		  echo "<td>".$bonusy[$i]."</td>";
		  echo "<td>".$negativy[$i]."</td>";
		  echo "</tr>\r\n";
		  $i++;
	 endwhile;
  ?>
</table>

<br>
<font class="text_bili"><h2>Seznam st�n�ch z�izen�</h2></font>
<table class='table' align="center" cellpadding=0 cellspacing=0>
  <tr class="vrsek">
    <th>��slo</th>
    <th>Bonusy</th>
    <th>Negativy</th>
  </tr>
  <?php
      $i=1;
	  while($i<10):
		  echo "<tr class='spodek'>";
		  echo "<td><font color='".$barva."'>".$i."</font></td>";
		  echo "<td>".$bonusy1[$i]."</td>";
		  echo "<td>".$negativy1[$i]."</td>";
		  echo "</tr>\r\n";
		  $i++;
	 endwhile;
  ?>
</table>

</body>
</html>
