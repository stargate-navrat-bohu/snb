<?mysql_query("SET NAMES cp1250");

	if(isset($auto)):
		if(($af=="on") and ($av=="on")){$aa=3;};
		if(($af!="on") and ($av=="on")){$aa=2;};
		if(($af=="on") and ($av!="on")){$aa=1;};
		if(($af!="on") and ($av!="on")){$aa=0;};
		MySQL_Query("update uzivatele set auto = $aa where cislo=$logcislo");
	endif;


        $nvyzk='upgrade všeho';
	$vekhrace = $zaznam1[vek];
	require("kontrola.php");

	$ser1 = MySQL_Query("SELECT cislo,vyzkum FROM servis where cislo=1");
	$ser = MySQL_Fetch_Array($ser1);
	
	$cil=$ser[vyzkum];

	
?>

<center>
<font class='text_bili'>


<?	


	if($zaznam1[rasa]==98){echo "<font class='text_cerveny'>Vyvrhelové nemají fond.</font>";exit;};
	if($zaznam1[rasa]==87){echo "<font class='text_cerveny'>Replikátoøi nemají fond.</font>";exit;};	

	$rt=$zaznam1[rasa];

	$vyso = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa = '$rt'");
	$rasa1 = MySQL_Fetch_Array($vyso);

	$nr=$rasa1[nazevrasy];

	if(isset($fond)):
		do{
		$fond*=1;
    	$vys1 = MySQL_Query("SELECT jmeno,fond,rasa FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		$rasa=$zaznam1["rasa"];
		$vys2 = MySQL_Query("SELECT min,rasa FROM vudce where rasa = $rasa");
		$zaznam2 = MySQL_Fetch_Array($vys2);	
		if($fond<0){echo "<font class='text_cerveny'>Vklad nesmí být záporný</font>";break;};
		if(Is_double($fond)){echo "<font class='text_cerveny'>Vklad nesmí být desetinný</font>";break;};
		if($fond>50){echo "<font class='text_cerveny'>Vklad nesmí být víc jak 50%</font>";break;};
		if($fond>=$zaznam2["min"]):
			MySQL_Query("update uzivatele set fond = $fond where cislo=$logcislo");
		else:
			echo "<font class='text_cerveny'>Vklad nesmí být menší než pøikázaný</font>";
		endif;
    		}while(false);
	endif;

	if(isset($vyz)):
		do{
		$vyz*=1;
    	$vys1 = MySQL_Query("SELECT jmeno,vyzkum,rasa,planety FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		$rasa=$zaznam1["rasa"];
		$vys2 = MySQL_Query("SELECT min,rasa,minv FROM vudce where rasa = $rasa");
		$zaznam2 = MySQL_Fetch_Array($vys2);	
		if(($vyz<0 )){echo "<font class='text_cerveny'>Vklad nesmí být záporný</font>";break;};
		if(Is_double($vyz)){echo "<font class='text_cerveny'>Vklad nesmí být desetinný</font>";break;};
		if($vyz>50){echo "<font class='text_cerveny'>Vklad nesmí být víc jak 50%</font>";break;};
		if($zaznam1[planety]<2){echo "<font class='text_cerveny'>Musíte mít minimálnì 2 planety</font>";break;};
		if($vyz>=$zaznam2["minv"]):
			MySQL_Query("update uzivatele set vyzkum = $vyz where cislo=$logcislo");
		else:
			echo "<font class='text_cerveny'>Vklad nesmí být menší než pøikázaný</font>";
		endif;
    		}while(false);
	endif;


	if(isset($kolik)):
		$kolik*=1;
		if ($proc <> ""):	
		if($kolik>=500):
			do{
			$dat=Date("U");
			$vys1 = MySQL_Query("SELECT jmeno,fond,penize,rasa,planety,status FROM uzivatele where cislo=$logcislo");
			$zaznam1 = MySQL_Fetch_Array($vys1);
			$rasa=$zaznam1["rasa"];
			if($zaznam1[planety]<2){echo "<font class='text_cerveny'>Musíte mít minimálnì 2 planety</font>";break;};	
			$vys10 = MySQL_Query("SELECT fond FROM vudce where rasa = '$rasa'");
			$zaznam10 = MySQL_Fetch_Array($vys10);

			$vys11 = MySQL_Query("SELECT jmeno,posta FROM uzivatele where ((status = 1) and (rasa = $rasa))");
			$zaznam11 = MySQL_Fetch_Array($vys11);
			$komu=$zaznam11[jmeno];
			if(($zaznam1[penize]-$kolik)>=0):
				$fon=$zaznam10["fond"]+$kolik;
				$pen=$zaznam1["penize"]-$kolik;
				$p=$zaznam11["posta"]+1;
				$dat = Date("U");
				$rasa5=AddSlashes($zaznam8["nazevrasy"]);
				$text= $logjmeno." poslal do fondu $kolik naquadahu";
				//$od=$logjmeno;
				$od="Správce fondu";
		       // MySQL_Query("INSERT INTO posta (den,odesilatel,adresat,rasa,text) VALUES ($dat,'$od','$komu','$rasa5','$text')");
		        //MySQL_Query("update uzivatele set posta = $p where jmeno = '$komu'");
				MySQL_Query("update vudce set fond = $fon where rasa = $rasa");
				MySQL_Query("update uzivatele set penize = $pen where cislo=$logcislo");
			MySQL_Query("INSERT INTO ciny (cas,rasa,cin,kdo,status,cislo, proc) VALUES ($dat,$rasa,6,'$logjmeno','$zaznam1[status]',$kolik, '$proc')");				
			else:
				echo "<font class='text_cerveny'>Tolik naquadahu nemáte</font>";
			endif;
			}while(false);
		else:
			echo "<font class='text_cerveny'>Nejmenší povolený vklad je 500 kg naquadahu.</font>";
		endif;
		else:
			echo "<font class='text_cerveny'>Zadejte dùvod</font>";
		endif;
	endif;

	$vys1 = MySQL_Query("SELECT jmeno,heslo,fond,rasa,penize,vyzkum,auto FROM uzivatele where cislo=$logcislo");
	$zaznam1 = MySQL_Fetch_Array($vys1);

	$rasa=$zaznam1["rasa"];
	if($rasa==98){echo "<font class='text_cerveny'><center>Vyvrhelové nemají ani fond ani výzkum!</center></font>";exit;};
	$vys2 = MySQL_Query("SELECT rasa,min,fond,minv FROM vudce where rasa = $rasa");
	$zaznam2 = MySQL_Fetch_Array($vys2);	

	$vyzz = MySQL_Query("SELECT * FROM vyzkum where rasa = $rasa");
	$vyzkum = MySQL_Fetch_Array($vyzz);	

	/////$vyz2 = MySQL_Query("SELECT * FROM vyzkum where (rasa>0 and rasa<7)  ORDER BY (kolik/max/100) desc");
   $vyz2 = MySQL_Query("SELECT * FROM vyzkum where (rasa>0 and rasa<98)  ORDER BY (kolik/max/100) desc");
	//$vyz2 = MySQL_Query("SELECT * FROM vyzkum where (rasa>0 and rasa<99)  ORDER BY rasa desc");
	$fond=$zaznam1["fond"];
	$min=$zaznam2["min"];

	if(!isset($vyz))
	$vyz=$zaznam1["vyzkum"];

	$i=1;
	/////$rasn2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa>0 and rasa<7)  order by rasa");
	$rasn2 = MySQL_Query("SELECT rasa,nazev FROM rasy where (rasa>0 and rasa<98) order by rasa");

  while($rasn = MySQL_Fetch_Array($rasn2)):
		$nar[$i]=$rasn[nazev];
		$i++;
	endwhile;
	$i=1;	
	$vyzkum2 = MySQL_Fetch_Array($vyz2);
//while ($i<7):
	while ($i<10):
	if ($vyzkum2[max]>0):
  	$proc=$vyzkum2[kolik]/($vyzkum2[max]/100);
	else: $vyzkum2[max]=0;
	endif;
    //$proc=number_format($proc,3);
		$procento[$i]=$proc;
		//$nazev[$i]=$vyzkum2[nazev];
		$nazev[$i]=$nar[$vyzkum2[rasa]];
		if($proc>=100):
			MySQL_Query("update uzivatele set vyzkum = 0 where rasa = $vyzkum2[rasa]");
			MySQL_Query("update vyzkum set kolik = $vyzkum2[max] where rasa = $vyher");
		endif;
		//$vyzkum2 = MySQL_Fetch_Array($vyz2);
		$rasav[$i]=$vyzkum2[rasa];
		$peniz[$i]=$vyzkum2[kolik];
		$nazevvyz[$i]=$vyzkum2[nazevvyz];
		if($vyzkum2[rasa]==$rt){$vz=$proc;};
		if($vyzkum2[rasa]==$rt and $cil=="projekt"){$cil=$nazevvyz[$i];};
		$vyzkum2 = MySQL_Fetch_Array($vyz2);
		$i++;
	endwhile;
	$vyherce=$vyzkum2[nazev];
		
?>
<center><font class='text_bili'><font class=text_modry>F</font>ond</font></center>
<font class="text_bili">
Minimální vklad naøízen vedením je <font class=text_modry><? echo $min?>%</font><br>
<?
if((Date("U")-$vekhrace)>259200)
{
 echo "Ve fondu je <font class=text_modry>" . fcis($zaznam2["fond"]). "kg</font> naquadahu<br>";
}
else 
{
  echo "<font class='text_cerveny'>Nejste tu ještì ani 72 hodin, tak nemùžete vidìt stav fondu</font>";
}
?>
<form name="form" method="post" action="hlavni.php?page=vlada&vyber=5">
Pøispívat do fondu: <input type="text" size = '2' name="fond" value="<?echo $fond;?>">% &nbsp;
<input type="submit" value="zmìò pøispívání">
</form>

<?

if((Date("U")-$vekhrace)>259200):


echo "<form name='penize' method='post' action='hlavni.php?page=vlada&vyber=5'>";
echo "Poslat do fondu (máte <font class=text_bili>"; 
echo fcis($zaznam1[penize]);  
echo " kg</font>) &nbsp;<input type='text' name='kolik'> naquadahu z dùvodu &nbsp;<input type='text' name='proc'>"; 
echo "<br><input type='submit' value='pošli'>";
echo "</form><br>";

else: echo "<font class='text_cerveny'>Nemùžete posílat naquadah. Nejste tu ještì ani 72 hodin a tak ještì nebyly synchronizovány komunikaèní protokoly s nejvyšším velením.</font>";
endif;
?>

<?
switch($zaznam1[auto]){
	case 1: $a="checked";
		break;
	case 2: $b="checked";
		break;
	case 3: $a="checked";
		$b="checked";
		break;
};
?>
<form name="form" method="post" action="hlavni.php?page=vlada&vyber=5">
<center><font class='text_bili'><font class=text_modry>A</font>utomatika</font></center>
Pokud zaškrtnìte bude Váš pøíspìvek vždy tolik, kolik naøídí vedení jako minimální vklad.<br>
mìnit vklad do fondu<input type="checkbox" name="af" <? echo $a?>>,&nbsp;  mìnit pøíspìvek naquadahu.<input type="checkbox" name="av" <? echo $b?>>  
<input type="hidden" name="auto" value="1">
<br><input type="submit" value="zmìò">
</form>
</font>

<center><font class='text_bili'><font class=text_modry>V</font>ýzkum</font></center>

<?
/*
if(($vyherce=="") and ($vyher!="")):
	$vyz2 = MySQL_Query("SELECT * FROM vyzkum ORDER BY (kolik/max/100) desc");
	$vyzkum2 = MySQL_Fetch_Array($vyz2);
	$i=1;
	while ($i<11):
		$proc=$vyzkum2[kolik]/($vyzkum2[max]/100);
		$proc=number_format($proc,3);
		if($vyzkum2[rasa]==$vyher):
			$kdo=$vyzkum2[nazev];
		endif;
		$procento[$i]=$proc;
		$nazev[$i]=$vyzkum2[nazev];
		$vyzkum2 = MySQL_Fetch_Array($vyz2);
		$i++;
	endwhile;

endif;
if($vyherce!=""):

	$vyz2 = MySQL_Query("SELECT * FROM vyzkum ORDER BY (kolik/max/100) desc");
	$vyzkum2 = MySQL_Fetch_Array($vyz2);
	$i=1;
	while ($i<11):
		$proc=$vyzkum2[kolik]/($vyzkum2[max]/100);
		$proc=number_format($proc,3);
		if($vyzkum2[rasa]==$vyherce):
			$kdo=$vyzkum2[nazev];
		endif;
		$procento[$i]=$proc;
		$nazev[$i]=$vyzkum2[nazev];
		$vyzkum2 = MySQL_Fetch_Array($vyz2);
		$i++;
	endwhile;

endif;
*/

?>

<font class="text_bili">
Cílem nynìjšího výzkumu je <font class=text_modry><? echo $vyzkum[nazev]?> </font><br>
Minimální pøíspìvek na výzkum naøízen vedením je <font class=text_modry><? echo $zaznam2[minv]?>%</font><br>
<?
	echo "<form name='form' method='post' action='hlavni.php?page=vlada&vyber=5'>";
  	echo "Pøispívat na výzkum: <input type='text' size='2' name='vyz' value='".$vyz."'>% &nbsp;";
	echo "<input type='submit' value='zmìò pøispívání'></form>";


?>
<p />
Cena výzkumu: <font class=text_modry><? echo fcis($vyzkum["max"])?></font> naquadahu<br>
Vydaného: <font class=text_modry><? echo fcis($vyzkum["kolik"])?></font> naquadahu 
<? 
  $perc = round($vyzkum["kolik"] / $vyzkum["max"] * 100);
  
  if ($perc < 100)
    {
      echo "(" . $perc . "%)";
    }
  elseif ($perc >= 100)
      {
      echo "(100%)";
    }
?>
<br />
<table class="table" cellpadding=0 cellspacing=0>
  <tr class="vrsek">
    <th>Rasa</th>
    <th>Název výzkumu</th>
    <th>Z kolika procent je výzkum hotov</th>
</tr>
<?
    $result = mysql_query("SELECT * FROM `vyzkum`", $spojeni); // nacteni vyzkumu
    while($row=mysql_fetch_array($result)){
      if(strlen($nar[$row["rasa"]])>0) { // pokud existuje nazev rasy ve vyzkumu
        if($row["max"]>0) {
          $procento = $row["kolik"]/($row["max"]/100);
        }
        if($rasav[$i]==$rt) { // pokud je hrac z teto rasy
          $barva = 'style="color: #ff9900;"';
        }
        echo '<tr class="spodek">
          <th'.$barva.'>'.$nar[$row["rasa"]].'</th>
          <td'.$barva.'>'.$row["nazevvyz"].'</td>
          <td'.$barva.'>';
          if($procento<100) { 
            echo number_format($procento,3);
          }
          else {
            echo 'Výzkum ukonèen';
          }
        echo '</td>
          </td>
        </tr>';
      }
    }

mysql_close($spojeni);    

/*
$i=1;
while ($i<10):
	echo "<tr>";
	echo "<td class=text_modry>".$nazev[$i]."</td>";
	if($rasav[$i]==$rt):
		echo "<td background=ff9900 color=#ff9900>".$nazevvyz[$i]."</td>";
	    if($procento[$i]<100):
    			echo "<td  background= ff9900 color=#ff9900>".number_format($procento[$i],3)."</td>";
		else:
    			echo "<td  background=ff9900 color=#ff9900>Výzkum dokonèen</td>";
		endif;
	else:
		echo "<td>".$nazevvyz[$i]."</td>";	
	    if($procento[$i]<100):
    			echo "<td>".number_format($procento[$i],3)."</td>";
		else:
    			echo "<td><font class=text_bili>Výzkum dokonèen</font></td>";
		endif;
	endif;
	echo "</tr>";
	$i++;
endwhile;
*/
?>
</table>
</font>

