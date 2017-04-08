<?php
require 'data_1.php';
require 'functions.php';

$vys1    = MySQL_Query('SELECT * FROM uzivatele where cislo = '.$logcislo.' ');
$zaznam1 = MySQL_Fetch_Array($vys1);

$vys2    = MySQL_Query('SELECT * FROM rasy where rasa = "'.$rasa1.'" ');
$zaznam2 = MySQL_Fetch_Array($vys2);
$vys3    = MySQL_Query('SELECT * FROM planety where cislomaj = '.$logcislo.' ');

if (empty($xm) || $xm<0){
    $xm=0;
}

$vys4    = MySQL_Query('SELECT * FROM utok WHERE (utocnik="'.$logjmeno.'" OR obrance="'.$logjmeno.'") ORDER BY den DESC LIMIT '.$xm.',5 ');
$vys5    = MySQL_Query('SELECT rasa,fond,denz,dena,denv,jvudce,jzastupce,jasistent,jobcan FROM vudce WHERE rasa ="'.$rasa1.'" ');
$zaznam5 = MySQL_Fetch_Array($vys5);

require 'kontrola.php';

?>
<h2>Vaše vojenské aktivity</h2>
<table align="center">
<?php

while ($zaznam4 = MySQL_Fetch_Array($vys4)):
    $datum = Date('G:i:s j.m.Y', $zaznam4['den']);

    switch($zaznam4['typ']){
        case 0: $typu = 'Dobívací'; break;
        case 1: $typu = 'Útok ZHN'; break;
        case 2: $typu = 'Partyzánský'; break;
        case 3: $typu = 'Útok univerzálních jednotek'; break;
        case 4: $typu = 'Orbitální útok'; break;
        case 5: $typu = 'Loupeživé operace'; break;
        case 7: $typu = 'Infiltrační operace'; break;
        case 8: $typu = 'Agitátorské operace'; break;
    }

    if($zaznam4['utocnik'] == $zaznam1['jmeno'] || $zaznam4['obrance'] == $zaznam1['jmeno']):
?>
    <tr>
        <td><strong>Datum</strong></td>
        <td><?= $datum ?></td>
    </tr>
    <tr>
<?php
        if($zaznam4['utocnik']==$logjmeno):
            $vys5 = MySQL_Query('SELECT * FROM rasy where rasa = "'.$zaznam4['orasa'].'" ');
            $zaznam5 = MySQL_Fetch_Array($vys5);
            $my  = 'u';
            $on  = 'o';
            $uts = 'Bylo posláno';
            $obs = 'Škody způsobené ZHN';
            $oas = 'Bylo ukradeno';
?>
        <td class="pole">Útočili jsme na</td>
        <td><?= $zaznam4['obrance'] . ' (' . $zaznam5['nazevrasy'] . ')' ?></td>
<?php
       	else:
            $vys5 = MySQL_Query('SELECT * FROM rasy where rasa = "'.$zaznam4['urasa'].'" ');
            $zaznam5 = MySQL_Fetch_Array($vys5);
		    $my  = 'o';
            $on  = 'u';
            $uts = 'Poslal na nás';
            $obs = 'Zničil nám';
            $oas = 'Ukradl nám';
?>
        <td class="text_cereny">Útočil na nás</td>
        <td><?= $zaznam4['utocnik'].' ('.$zaznam5['nazevrasy'].')' ?></td>
<?php
        endif;
?>
    </tr>
    <tr>
        <td class="pole">Útok</td>
        <td><?= $typu ?><td>
    </tr>
<?php
        if ($zaznam4['typ']==0):
            if($zaznam4['uspesnost']==1):
                //sprintf($vysledeku, $zaznam4['planety']);
                //sprintf($vysledeko, $zaznam4['planety']);
                $vysledeku = 'Podařilo se něm obsadit planetu %s.';
                $vysledeko = 'Ztratili jsme planetu %s.';
            else:
                $vysledeku = 'Nepodařilo se nám obsadit planetu %s.';
                $vysledeko = 'Ubránili jsme planetu %s před jejím obsazením.';
            endif;
?>
	<tr>
        <td  class="pole">Naše ztráty</td>
        <td><?= get_casualties($my, $zaznam4, $zaznam2) ?></td>
    </tr>
    <tr>
        <td  class="pole">Jeho ztráty</td>
        <td><?= get_casualties($on, $zaznam4, $zaznam5) ?></td>
    </tr>
<?php
        elseif ($zaznam4['typ'] == 1):
            if($zaznam4["uspesnost"]==1):
                $vysledeku = 'Naše ZHN vyslané na planetu %s.';
                $vysledeko = 'ZHN vyslané na planetu %s nebyly zničeny před dopadem na planetu.';
            else:
                $vysledeku = 'Naše ZHN vyslané na planetu %s byly zničeny obranou planety.';
                $vysledeko = 'ZHN vyslané na planetu %s byly zneškodněny obranou planety.';
            endif;
?>
    <tr>
        <td class="pole"><?= $uts ?></td>
        <td><?= $zaznam4['ujed1'].' * '.$zaznam4['ujed3_nazev'] ?></td>
    </tr>
    <tr>
        <td class="pole"><?= $obs ?></td>
        <td><?= $zaznam4['ucinek'] ?> nebyly zničeny před dopadem na planetu</td>
    </tr>
<?php
        elseif ($zaznam4['typ'] == 5):
            echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed6"]." * ".$zaznam2["jed6_nazev"]." z nich bylo zat�eno a popraveno ".$zaznam4["zujed6"]. " zlod�j�</td>";
            echo "</tr>";
            echo "<tr>";			
            echo "<td class='pole'>".$oas."</td><td>".$zaznam4["ucinek"]."</td>";
            if($zaznam4["uspesnost"]==1):
                $vysledeku="Na�im zlod�j�m kte�� operovali na planet� ".$zaznam4["planety"]." se poda�ilo ukr�st ��st z�sob ";
                $vysledeko="Ciz�m zlod�j�m kte�� operovali na planet� ".$zaznam4["planety"]." se poda�ilo ukr�st ��st na�ich z�sob ";
            else:
                $vysledeku="Na�i zlod�ji operuj�c� na planet� ".$zaznam4["planety"]." byli zat�eni a popraveni";
                $vysledeko="Poda�ilo se n�m chytit a popravit ciz� zlod�je operujc�ch na planet� ".$zaznam4["planety"];
            endif;

        elseif($zaznam4['typ']==8):
            echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed8"]." * ".$zaznam2["jed8_nazev"]." z nich bylo zat�eno a popraveno ".$zaznam4["zujed8"]. " agit�tor�</td>";
            echo "</tr>";
            echo "<tr>";			
            echo "<td class='pole'>".$oas."</td><td>".$zaznam4["ucinek"]."</td>";
            if($zaznam4["uspesnost"]==1):
                $vysledeku="P�esv�d�ov�n� lid� na planet� ".$zaznam4["planety"]." se vyda�ilo";
                $vysledeko="Ciz�m agit�tor�m se poda�ilo p�emluvit lidi na planet� ".$zaznam4["planety"]. " ";
            else:
                $vysledeku="Na�i agot�to�i byli chyceni a popraveni na planet� ".$zaznam4["planety"]." ";
                $vysledeko="Poda�ilo se chytit a popravit ciz� politiky operuj�c� na planet� ".$zaznam4["planety"];
            endif;

        		
        elseif($zaznam4['typ']==2):
            echo "<td  class='pole'>Na�e ztr�ty</td><td>";
            if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed1_nazev"];}
            if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;}
            if($zaznam4[($my.'jed1')]<1 && $zaznam4[($my.'jed5')]<1){echo "��dn�";}
            echo "</td></tr>";
            echo "</td></tr>";
            echo "<tr>";			
            echo "<td  class='pole'>Jeho ztr�ty</td><td>";
            if($zaznam4[($on.'jed1')]>0){echo $zaznam4[($on.'jed1')]." * ".$zaznam5["jed1_nazev"];}
            if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;}
            if($zaznam4[($on.'jed1')]<1 && $zaznam4[($on.'jed5')]<1){echo "��dn�";}
            echo "</td></tr>";
            echo "<tr>";			
            echo "<td  class='pole'>Ztr�ty v infrastruktu�e</td><td>".$zaznam4[ucinek]."</td>";
            echo "</tr>";
            if($zaznam4["uspesnost"]==1):
                $vysledeku="Na�e p�chota prorazila obranu planety ".$zaznam4["planety"]. " ";
                $vysledeko="�to�n�k prorazil na�i p�chotu na planet� ".$zaznam4["planety"];
            else:
                $vysledeku="Na�e p�chota na planet� ".$zaznam4["planety"]. " byla pora�ena";
                $vysledeko="Neprorazil na�� p�chotu na planet� ".$zaznam4["planety"];
            endif;

        elseif($zaznam4['typ']==7):
            echo "<td  class='pole'>Zabito</td><td>";
            if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed7nazev"];}
            if($zaznam4[($my.'jed1')]<1){echo "��dn�";}
            echo "</td></tr>";
            echo "</td></tr>";
            echo "<tr>";			
            echo "</td></tr>";
            echo "<tr>";			
            echo "<td  class='pole'>Zjistili</td><td>".$zaznam4[ucinek]."</td>";
            echo "</tr>";
            if($zaznam4["uspesnost"]==1):
                $vysledeku="Na�im agent�m se poda�ilo zjistit informace o planet� ".$zaznam4["planety"];
                $vysledeko="Na�i �pehov� zjistil informace o planet� ".$zaznam4["planety"];
            else:
                $vysledeku="Na�im �peh�m se nepod�ilo z�skat informace o planet� ".$zaznam4["planety"];
                $vysledeko="Ciz� �pehov� nezjistili nic o na�� planet� ".$zaznam4["planety"];
            endif;

        elseif($zaznam4[typ]==3):
            echo "<td  class='pole'>Na�e ztr�ty</td><td>";
            if($zaznam4[($my.'jed2')]>0){echo $zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];}
            if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;}
            if($zaznam4[($my.'jed2')]<1 && $zaznam4[($my.'jed5')]<1){echo "��dn�";}
            echo "</td></tr>";
            echo "</td></tr>";
            echo "<tr>";			
            echo "<td  class='pole'>Jeho ztr�ty</td><td>";
            if($zaznam4[($on.'jed2')]>0){echo $zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];}
            if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;}
            if($zaznam4[($on.'jed2')]<1 && $zaznam4[($on.'jed5')]<1){echo "��dn�";}
            echo "</td></tr>";
            echo "<tr>";			
            echo "<td  class='pole'>Zp�soben� �kody</td><td>".$zaznam4['ucinek']."</td>";
            echo "</tr>";
            if($zaznam4["uspesnost"]==1):
                $vysledeku="Univerz�ln� v�le�n�ci rozdrtili obranu planety ".$zaznam4["planety"]." ";
                $vysledeko="Na�i univerz�ln� v�le�n�ci na planet� ".$zaznam4["planety"]." byli pora�eni";
            else:
                $vysledeku="Na planet� ".$zaznam4["planety"]. " jsme nap�chali minimum �kod";
                $vysledeko="Na�i univerz�ln� v�le�n�ci na planet� ".$zaznam4["planety"]. " nebyli pora�eni";
            endif;

        elseif($zaznam4[typ]==4):
			echo "<td  class='pole'>Na�e ztr�ty</td><td>";
            if($zaznam4[($my.'jed4')]>0){echo $zaznam4[($my.'jed4')]." * ".$zaznam2["jed4_nazev"];}
       		if($zaznam4[($my.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];}
            if($zaznam4[($my.'jed4')]<1 && $zaznam4[($my.'jed2')]<1){echo "��dn�";}
            echo "</td></tr>";
            echo "</td></tr>";
            echo "<tr>";			
            echo "<td  class='pole'>Jeho ztr�ty</td><td>";
            if($zaznam4[($on.'jed4')]>0){echo $zaznam4[($on.'jed4')]." * ".$zaznam5["jed4_nazev"];};
            if($zaznam4[($on.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
            if($zaznam4[($on.'jed4')]<1 && $zaznam4[($on.'jed2')]<1){echo "��dn�";};
			echo "</td></tr>";
			echo "<tr>";			
            echo "<td  class='pole'>Zp�soben� �kody</td><td>".$zaznam4['ucinek']."</td>";
            echo "</tr>";
            if($zaznam4["uspesnost"]==1):
                $vysledeku=" Orbit�ln� �tok na  planetu ".$zaznam4["planety"]." prob�hl �sp�n� ";
                $vysledeko="Orbit�ln� �tok na na�i planetu ".$zaznam4["planety"]. " se nezda�il";
            else:
                $vysledeku="Orbit�ln� �tok na  planetu ".$zaznam4["planety"]." se nezda�il ";
                $vysledeko="Orbit�ln� �tok na na�i planetu ".$zaznam4["planety"]. " se nezda�il";
            endif;
        endif;

        echo "<tr>";
        echo "<td><font class='text_modry'>V�sledek</font><br><br><br><br></td>
        <td><font";
        if($zaznam4["utocnik"]==$logjmeno):
            echo "color='".$colortu."'>".$vysledeku;
        else:
            echo "color='".$colorto."'>".$vysledeko;
        endif;	
        echo "</font><br><br><br><br></td>";
    endif;

endwhile;

echo '</table>';

$y = $xm + 5;
$z = $xm - 5;

?>

    <p>
        <a href="hlavni.php?page=sutok&amp;xm=<?= $z ?>">Novějších 5 útoků</a> | 
        <a href="hlavni.php?page=sutok&amp;xm=<?= $y ?>">Starších 5 útoků</a>
    </p>

<?php
$vysledek_kolik=0;

MySQL_Query("update uzivatele set utoceno=$vysledek_kolik where jmeno='$logjmeno'");
