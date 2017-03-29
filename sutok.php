<?
mysql_query("SET NAMES cp1250");

		require "data_1.php";
		
				function fcis($a){

		$a=number_format($a,0,""," ");

		return $a;	

		}


		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo = $logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);

		$vys2 = MySQL_Query("SELECT * FROM rasy where rasa = '$rasa1'");
		$zaznam2 = MySQL_Fetch_Array($vys2);
		$vys3 = MySQL_Query("SELECT * FROM planety where cislomaj = $logcislo");
		if(empty($xm) or $xm<0){$xm=0;};
		$vys4 = MySQL_Query("SELECT * FROM utok where (utocnik='$logjmeno' or obrance='$logjmeno') ORDER BY den DESC LIMIT $xm,5");
		$vys5 = MySQL_Query("SELECT rasa,fond,denz,dena,denv,jvudce,jzastupce,jasistent,jobcan FROM vudce where rasa ='$rasa1'");
		$zaznam5 = MySQL_Fetch_Array($vys5);
		require("kontrola.php");
		
		
		echo "<br><br><center><font class='text_bili'><font class='text_modry'>V</font>aše vojenské aktivity</font><br><br>";
		echo "<TABLE align=center>";

    while ($zaznam4 = MySQL_Fetch_Array($vys4)):
		$datum = Date("G:i:s j.m.Y",$zaznam4["den"]);
      	switch($zaznam4[typ]){
            case 0: $typu="Dobývací";break;
            case 1: $typu="Útok ZHN)";break;
            case 2: $typu="Partyzánský";break;
            case 3: $typu="Útok univerzálních jednotek";break;
            case 4: $typu="Orbitální útok";break;
            case 5: $typu="Loupeživá operace";break;
            case 7: $typu="Infiltraèní operace";break;
            case 8: $typu="Agitátorská operace";break;
            }
      	if($zaznam4["utocnik"]==$zaznam1[jmeno] or $zaznam4["obrance"]==$zaznam1[jmeno]):
				echo "<tr>";
				echo "<td><b>datum</b></td>";
				echo "<td><b>".$datum."</b></td>";
				echo "</tr>";
  				echo "<tr>";
       		if($zaznam4["utocnik"]==$logjmeno):
		  		$vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$zaznam4[orasa]'");
  				$zaznam5 = MySQL_Fetch_Array($vys5);
          		$my="u";$on="o";$uts="Bylo posláno";$obs="Škody zpùsobené ZHN";$oas="Bylo ukradeno";
  				echo "<td class='pole'>Útoèili jsme na</td><td>".$zaznam4["obrance"]." (".$zaznam5["nazevrasy"].")<td>";
        	else:
          $vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$zaznam4[urasa]'");
  				$zaznam5 = MySQL_Fetch_Array($vys5);
		          $my="o";$on="u";$uts="Poslal na nás";$obs="Znièil nám";$oas="Ukradl nám";
  				echo "<td class='text_cerveny'>Útoèil na nás</td><td>".$zaznam4["utocnik"]." (".$zaznam5["nazevrasy"].")<td>";
        	endif;
				echo "</tr>";
				echo "<tr>";
				echo "<td class=pole>Útok</td><td>".$typu."<td>";
				echo "</tr>";
				echo "<tr>";
        	if($zaznam4[typ]==0):
				echo "<td  class='pole'>Naše ztráty</td><td>";
				if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed1_nazev"];};
          		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
	          	if($zaznam4[($my.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
    	      	if($zaznam4[($my.'jed4')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed4')]." * ".$zaznam2["jed4_nazev"];};
        	  	if($zaznam4[($my.'jed1')]<1 and $zaznam4[($my.'jed2')]<1 and $zaznam4[($my.'jed4')]<1 and $zaznam4[($my.'jed5')]<1){echo "žádné";};
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='pole'>Jeho ztráty</td><td>";
		        if($zaznam4[($on.'jed1')]>0){echo $zaznam4[($on.'jed1')]." * ".$zaznam5["jed1_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
        		if($zaznam4[($on.'jed4')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed4')]." * ".$zaznam5["jed4_nazev"];};
		        if($zaznam4[($on.'jed1')]<1 and $zaznam4[($on.'jed2')]<1 and $zaznam4[($on.'jed4')]<1 and $zaznam4[($on.'jed5')]<1){echo "žádné";};
				echo "</td>";
          		if($zaznam4["uspesnost"]==1):
		            $vysledeku="Podaøilo se nám obsadit planetu ".$zaznam4["planety"]." ";
        		    $vysledeko="Ztratili jsme planetu ".$zaznam4["planety"]." ";
		        else:
        		    $vysledeku="Nepodaøilo se nám obsadit planetu ".$zaznam4["planety"]." ";
		            $vysledeko="Ubránili jsme planetu ".$zaznam4["planety"]." pøed jejím obsazením";
        		endif;
			elseif($zaznam4[typ]==1):
 				//if ($zaznam4[orasa]=$my="o"){echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed1"]." * ".$zaznam2["jed4_nazev"]."</td>";};
 				echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed1"]." * ".$zaznam4["ujed3_nazev"]."</td>";
	  		  	echo "</tr>";
			    echo "<tr>";			
			    echo "<td class='pole'>".$obs."</td><td>".$zaznam4["ucinek"]." nebyly znièeny pøed dopadem na planetu</td>";
          		if($zaznam4["uspesnost"]==1):
	        	    $vysledeku="Naše ZHN vyslané na planetu ".$zaznam4["planety"]." ";
    		        $vysledeko="ZHN vyslané na planetu ".$zaznam4["planety"]." nebyly znièeny pøed dopadem na planetu";
		        else:
        		    $vysledeku="Naše ZHN vyslané na planetu ".$zaznam4["planety"]." byly znièeny obranou planety";
		            $vysledeko="ZHN vyslané na planetu ".$zaznam4["planety"]." byly zneškodnìny obranou planety";
        		endif;

			elseif($zaznam4[typ]==5):
 				echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed6"]." * ".$zaznam2["jed6_nazev"]." z nich bylo zatèeno a popraveno ".$zaznam4["zujed6"]. " zlodìjù</td>";
 				//echo "<td  class='pole'>Jeho ztráty</td><td>";
 				 
	  		  	echo "</tr>";
			    echo "<tr>";			
			    echo "<td class='pole'>".$oas."</td><td>".$zaznam4["ucinek"]."</td>";
          		if($zaznam4["uspesnost"]==1):
	        	    $vysledeku="Našim zlodìjùm kteøí operovali na planetì ".$zaznam4["planety"]." se podaøilo ukrást èást zásob ";
    		        $vysledeko="Cizím zlodìjùm kteøí operovali na planetì ".$zaznam4["planety"]." se podaøilo ukrást èást našich zásob ";
		        else:
        		    $vysledeku="Naši zlodìji operující na planetì ".$zaznam4["planety"]." byli zatèeni a popraveni";
		            $vysledeko="Podaøilo se nám chytit a popravit cizí zlodìje operujcích na planetì ".$zaznam4["planety"];
        		endif;

			elseif($zaznam4[typ]==8):
 				echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed8"]." * ".$zaznam2["jed8_nazev"]." z nich bylo zatèeno a popraveno ".$zaznam4["zujed8"]. " agitátorù</td>";
 				//echo "<td  class='pole'>Jeho ztráty</td><td>";
 				 
	  		  	echo "</tr>";
			    echo "<tr>";			
			    echo "<td class='pole'>".$oas."</td><td>".$zaznam4["ucinek"]."</td>";
          		if($zaznam4["uspesnost"]==1):
	        	    $vysledeku="Pøesvìdèování lidí na planetì ".$zaznam4["planety"]." se vydaøilo";
    		            $vysledeko="Cizím agitátorùm se podaøilo pøemluvit lidi na planetì ".$zaznam4["planety"]. " ";
		        else:
        		    $vysledeku="Naši agotátoøi byli chyceni a popraveni na planetì ".$zaznam4["planety"]." ";
		            $vysledeko="Podaøilo se chytit a popravit cizí politiky operující na planetì ".$zaznam4["planety"];
        		endif;

        		
      elseif($zaznam4[typ]==2):
				echo "<td  class='pole'>Naše ztráty</td><td>";
		        if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed1_nazev"];};
        		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($my.'jed1')]<1 and $zaznam4[($my.'jed5')]<1){echo "žádné";};
		  		echo "</td></tr>";
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='pole'>Jeho ztráty</td><td>";
		        if($zaznam4[($on.'jed1')]>0){echo $zaznam4[($on.'jed1')]." * ".$zaznam5["jed1_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed1')]<1 and $zaznam4[($on.'jed5')]<1){echo "žádné";};
				echo "</td></tr>";
				echo "<tr>";			
  				echo "<td  class='pole'>Ztráty v infrastruktuøe</td><td>".$zaznam4[ucinek]."</td>";
	  		    echo "</tr>";
    		    if($zaznam4["uspesnost"]==1):
            		$vysledeku="Naše pìchota prorazila obranu planety ".$zaznam4["planety"]. " ";
		            $vysledeko="Útoèník prorazil naši pìchotu na planetì ".$zaznam4["planety"];
        		else:
		            $vysledeku="Naše pìchota na planetì ".$zaznam4["planety"]. " byla poražena";
        		    $vysledeko="Neprorazil naší pìchotu na planetì ".$zaznam4["planety"];
		        endif;

      elseif($zaznam4[typ]==7):
				echo "<td  class='pole'>Zabito</td><td>";
		        if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed7nazev"];};
		        if($zaznam4[($my.'jed1')]<1){echo "žádné";};
		  		echo "</td></tr>";
				echo "</td></tr>";
				echo "<tr>";			
				echo "</td></tr>";
				echo "<tr>";			
  				echo "<td  class='pole'>Zjistili</td><td>".$zaznam4[ucinek]."</td>";
	  		    echo "</tr>";
    		    if($zaznam4["uspesnost"]==1):
            		$vysledeku="Našim agentùm se podaøilo zjistit informace o planetì ".$zaznam4["planety"];
		            $vysledeko="Naši špehové zjistil informace o planetì ".$zaznam4["planety"];
        		else:
		            $vysledeku="Našim špehùm se nepodøilo získat informace o planetì ".$zaznam4["planety"];
        		    $vysledeko="Cizí špehové nezjistili nic o naší planetì ".$zaznam4["planety"];
		        endif;

		  elseif($zaznam4[typ]==3):
      echo "<td  class='pole'>Naše ztráty</td><td>";
		        if($zaznam4[($my.'jed2')]>0){echo $zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
        		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($my.'jed2')]<1 and $zaznam4[($my.'jed5')]<1){echo "žádné";};
		  		echo "</td></tr>";
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='pole'>Jeho ztráty</td><td>";
		        if($zaznam4[($on.'jed2')]>0){echo $zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed2')]<1 and $zaznam4[($on.'jed5')]<1){echo "žádné";};
				echo "</td></tr>";
				echo "<tr>";			
  				echo "<td  class='pole'>Zpùsobené škody</td><td>".$zaznam4[ucinek]."</td>";
	  		    echo "</tr>";
    		    if($zaznam4["uspesnost"]==1):
            		$vysledeku="Univerzální váleèníci rozdrtili obranu planety ".$zaznam4["planety"]." ";
		            $vysledeko="Naši univerzální váleèníci na planetì ".$zaznam4["planety"]." byli poraženi";
        		else:
		            $vysledeku="Na planetì ".$zaznam4["planety"]. " jsme napáchali minimum škod";
        		    $vysledeko="Naši univerzální váleèníci na planetì ".$zaznam4["planety"]. " nebyli poraženi";
		        endif;
		  elseif($zaznam4[typ]==4):
			echo "<td  class='pole'>Naše ztráty</td><td>";
		      if($zaznam4[($my.'jed4')]>0){echo $zaznam4[($my.'jed4')]." * ".$zaznam2["jed4_nazev"];};
       		if($zaznam4[($my.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
		      if($zaznam4[($my.'jed4')]<1 and $zaznam4[($my.'jed2')]<1){echo "žádné";};
		   echo "</td></tr>";
			 echo "</td></tr>";
			 echo "<tr>";			
			 echo "<td  class='pole'>Jeho ztráty</td><td>";
		      if($zaznam4[($on.'jed4')]>0){echo $zaznam4[($on.'jed4')]." * ".$zaznam5["jed4_nazev"];};
       		if($zaznam4[($on.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
		      if($zaznam4[($on.'jed4')]<1 and $zaznam4[($on.'jed2')]<1){echo "žádné";};
			echo "</td></tr>";
			echo "<tr>";			
  				echo "<td  class='pole'>Zpùsobené škody</td><td>".$zaznam4[ucinek]."</td>";
	  		    echo "</tr>";
    		    if($zaznam4["uspesnost"]==1):
            		$vysledeku=" Orbitální útok na  planetu ".$zaznam4["planety"]." probìhl úspìšnì ";
		            $vysledeko="Orbitální útok na naši planetu ".$zaznam4["planety"]. " se nezdaøil";
        		else:
		            $vysledeku="Orbitální útok na  planetu ".$zaznam4["planety"]." se nezdaøil ";
        		    $vysledeko="Orbitální útok na naši planetu ".$zaznam4["planety"]. " se nezdaøil";
		        endif;
        	endif;
			echo "<tr>";
			echo "<td><font class='text_modry'>Výsledek</font><br><br><br><br></td>
			<td><font";
			if($zaznam4["utocnik"]==$logjmeno):
		        echo "color='".$colortu."'>".$vysledeku;
			else:
				echo "color='".$colorto."'>".$vysledeko;
			endif;	
        	echo "</font><br><br><br><br></td>";
      	endif;

    endwhile;

	echo "</table><br><center>";
	$y=$xm+5;
	$z=$xm-5;
	echo "<font class='text_bili'><a href=hlavni.php?page=sutok&xm=".$z." >Novìjších 5 útokù</a><br>";
	echo "<a href=hlavni.php?page=sutok&xm=".$y.">Starších 5 útokù</a></font>";
	echo "</td></tr></table>";

			$vysledek_kolik=0;
			MySQL_Query("update uzivatele set utoceno=$vysledek_kolik where jmeno='$logjmeno'");

