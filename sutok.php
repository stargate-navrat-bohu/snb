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
		
		
		echo "<br><br><center><font class='text_bili'><font class='text_modry'>V</font>a�e vojensk� aktivity</font><br><br>";
		echo "<TABLE align=center>";

    while ($zaznam4 = MySQL_Fetch_Array($vys4)):
		$datum = Date("G:i:s j.m.Y",$zaznam4["den"]);
      	switch($zaznam4[typ]){
            case 0: $typu="Dob�vac�";break;
            case 1: $typu="�tok ZHN)";break;
            case 2: $typu="Partyz�nsk�";break;
            case 3: $typu="�tok univerz�ln�ch jednotek";break;
            case 4: $typu="Orbit�ln� �tok";break;
            case 5: $typu="Loupe�iv� operace";break;
            case 7: $typu="Infiltra�n� operace";break;
            case 8: $typu="Agit�torsk� operace";break;
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
          		$my="u";$on="o";$uts="Bylo posl�no";$obs="�kody zp�soben� ZHN";$oas="Bylo ukradeno";
  				echo "<td class='pole'>�to�ili jsme na</td><td>".$zaznam4["obrance"]." (".$zaznam5["nazevrasy"].")<td>";
        	else:
          $vys5 = MySQL_Query("SELECT * FROM rasy where rasa = '$zaznam4[urasa]'");
  				$zaznam5 = MySQL_Fetch_Array($vys5);
		          $my="o";$on="u";$uts="Poslal na n�s";$obs="Zni�il n�m";$oas="Ukradl n�m";
  				echo "<td class='text_cerveny'>�to�il na n�s</td><td>".$zaznam4["utocnik"]." (".$zaznam5["nazevrasy"].")<td>";
        	endif;
				echo "</tr>";
				echo "<tr>";
				echo "<td class=pole>�tok</td><td>".$typu."<td>";
				echo "</tr>";
				echo "<tr>";
        	if($zaznam4[typ]==0):
				echo "<td  class='pole'>Na�e ztr�ty</td><td>";
				if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed1_nazev"];};
          		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
	          	if($zaznam4[($my.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
    	      	if($zaznam4[($my.'jed4')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed4')]." * ".$zaznam2["jed4_nazev"];};
        	  	if($zaznam4[($my.'jed1')]<1 and $zaznam4[($my.'jed2')]<1 and $zaznam4[($my.'jed4')]<1 and $zaznam4[($my.'jed5')]<1){echo "��dn�";};
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='pole'>Jeho ztr�ty</td><td>";
		        if($zaznam4[($on.'jed1')]>0){echo $zaznam4[($on.'jed1')]." * ".$zaznam5["jed1_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
        		if($zaznam4[($on.'jed4')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed4')]." * ".$zaznam5["jed4_nazev"];};
		        if($zaznam4[($on.'jed1')]<1 and $zaznam4[($on.'jed2')]<1 and $zaznam4[($on.'jed4')]<1 and $zaznam4[($on.'jed5')]<1){echo "��dn�";};
				echo "</td>";
          		if($zaznam4["uspesnost"]==1):
		            $vysledeku="Poda�ilo se n�m obsadit planetu ".$zaznam4["planety"]." ";
        		    $vysledeko="Ztratili jsme planetu ".$zaznam4["planety"]." ";
		        else:
        		    $vysledeku="Nepoda�ilo se n�m obsadit planetu ".$zaznam4["planety"]." ";
		            $vysledeko="Ubr�nili jsme planetu ".$zaznam4["planety"]." p�ed jej�m obsazen�m";
        		endif;
			elseif($zaznam4[typ]==1):
 				//if ($zaznam4[orasa]=$my="o"){echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed1"]." * ".$zaznam2["jed4_nazev"]."</td>";};
 				echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed1"]." * ".$zaznam4["ujed3_nazev"]."</td>";
	  		  	echo "</tr>";
			    echo "<tr>";			
			    echo "<td class='pole'>".$obs."</td><td>".$zaznam4["ucinek"]." nebyly zni�eny p�ed dopadem na planetu</td>";
          		if($zaznam4["uspesnost"]==1):
	        	    $vysledeku="Na�e ZHN vyslan� na planetu ".$zaznam4["planety"]." ";
    		        $vysledeko="ZHN vyslan� na planetu ".$zaznam4["planety"]." nebyly zni�eny p�ed dopadem na planetu";
		        else:
        		    $vysledeku="Na�e ZHN vyslan� na planetu ".$zaznam4["planety"]." byly zni�eny obranou planety";
		            $vysledeko="ZHN vyslan� na planetu ".$zaznam4["planety"]." byly zne�kodn�ny obranou planety";
        		endif;

			elseif($zaznam4[typ]==5):
 				echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed6"]." * ".$zaznam2["jed6_nazev"]." z nich bylo zat�eno a popraveno ".$zaznam4["zujed6"]. " zlod�j�</td>";
 				//echo "<td  class='pole'>Jeho ztr�ty</td><td>";
 				 
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

			elseif($zaznam4[typ]==8):
 				echo "<td class='pole'>".$uts."</td><td>".$zaznam4["ujed8"]." * ".$zaznam2["jed8_nazev"]." z nich bylo zat�eno a popraveno ".$zaznam4["zujed8"]. " agit�tor�</td>";
 				//echo "<td  class='pole'>Jeho ztr�ty</td><td>";
 				 
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

        		
      elseif($zaznam4[typ]==2):
				echo "<td  class='pole'>Na�e ztr�ty</td><td>";
		        if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed1_nazev"];};
        		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($my.'jed1')]<1 and $zaznam4[($my.'jed5')]<1){echo "��dn�";};
		  		echo "</td></tr>";
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='pole'>Jeho ztr�ty</td><td>";
		        if($zaznam4[($on.'jed1')]>0){echo $zaznam4[($on.'jed1')]." * ".$zaznam5["jed1_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed1')]<1 and $zaznam4[($on.'jed5')]<1){echo "��dn�";};
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

      elseif($zaznam4[typ]==7):
				echo "<td  class='pole'>Zabito</td><td>";
		        if($zaznam4[($my.'jed1')]>0){echo $zaznam4[($my.'jed1')]." * ".$zaznam2["jed7nazev"];};
		        if($zaznam4[($my.'jed1')]<1){echo "��dn�";};
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
		        if($zaznam4[($my.'jed2')]>0){echo $zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
        		if($zaznam4[($my.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($my.'jed2')]<1 and $zaznam4[($my.'jed5')]<1){echo "��dn�";};
		  		echo "</td></tr>";
				echo "</td></tr>";
				echo "<tr>";			
				echo "<td  class='pole'>Jeho ztr�ty</td><td>";
		        if($zaznam4[($on.'jed2')]>0){echo $zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
        		if($zaznam4[($on.'jed5')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed5')]." * ".$zold_nazev;};
		        if($zaznam4[($on.'jed2')]<1 and $zaznam4[($on.'jed5')]<1){echo "��dn�";};
				echo "</td></tr>";
				echo "<tr>";			
  				echo "<td  class='pole'>Zp�soben� �kody</td><td>".$zaznam4[ucinek]."</td>";
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
		      if($zaznam4[($my.'jed4')]>0){echo $zaznam4[($my.'jed4')]." * ".$zaznam2["jed4_nazev"];};
       		if($zaznam4[($my.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($my.'jed2')]." * ".$zaznam2["jed2_nazev"];};
		      if($zaznam4[($my.'jed4')]<1 and $zaznam4[($my.'jed2')]<1){echo "��dn�";};
		   echo "</td></tr>";
			 echo "</td></tr>";
			 echo "<tr>";			
			 echo "<td  class='pole'>Jeho ztr�ty</td><td>";
		      if($zaznam4[($on.'jed4')]>0){echo $zaznam4[($on.'jed4')]." * ".$zaznam5["jed4_nazev"];};
       		if($zaznam4[($on.'jed2')]>0){echo "&nbsp;&nbsp;".$zaznam4[($on.'jed2')]." * ".$zaznam5["jed2_nazev"];};
		      if($zaznam4[($on.'jed4')]<1 and $zaznam4[($on.'jed2')]<1){echo "��dn�";};
			echo "</td></tr>";
			echo "<tr>";			
  				echo "<td  class='pole'>Zp�soben� �kody</td><td>".$zaznam4[ucinek]."</td>";
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

	echo "</table><br><center>";
	$y=$xm+5;
	$z=$xm-5;
	echo "<font class='text_bili'><a href=hlavni.php?page=sutok&xm=".$z." >Nov�j��ch 5 �tok�</a><br>";
	echo "<a href=hlavni.php?page=sutok&xm=".$y.">Star��ch 5 �tok�</a></font>";
	echo "</td></tr></table>";

			$vysledek_kolik=0;
			MySQL_Query("update uzivatele set utoceno=$vysledek_kolik where jmeno='$logjmeno'");

