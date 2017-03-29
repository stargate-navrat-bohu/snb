
<?
mysql_query("SET NAMES cp1250");
	$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho,admin FROM uzivatele where cislo = '$logcislo'");	
	$zaznam1 = MySQL_Fetch_Array($vys1);	
	
	require("adkontrola.php");
	
	if(isset($smaz)):
		@$zk = MySQL_Query("SELECT * FROM forum where den = $smaz");
		@$zkou = MySQL_Fetch_Array($zk);
		MySQL_Query("DELETE from forum WHERE den = $smaz");
	endif;	
	

	if(isset($odeslano)){
		do{
			if($zaznam1[admin]==0 and $kde!="adm"){echo "Do systémového fora smí psát jen admini";break;};
		  	$den = Date("U");
			$jmeno=$logjmeno;
			$rasafg="admin";
			if($kde=="dom"){$rasafg=addslashes($rasa);};
			$text=HTMLSpecialChars($co);
			$text=NL2BR($text);
			$text=AddSlashes($text);
			$stat=$zaznam1[status];
			if($zaznam1[admin]==1){$stat=6;};
			MySQL_Query("INSERT INTO forum (den,jmeno,rasa,text,kde,stat) VALUES ('$den','$jmeno','$rasafg','$text','$kde',$stat)");	
	 	}while(false);
	};
	
?>

<form name='form1' method='post' action='hlavni.php?page=admin2'>
<select name="kde">
	<option value=0>
	<option value=neu>neutrální
	<option value=vip>vip planeta
	<option value=sys>systémové forum
	<option value=adm>oznámení adminù
<?
//value = ".$zaznam4[rasa]."
	$i=1;
	$vys4 = MySQL_Query("SELECT rasa,nazevrasy FROM rasy where rasa != 20");
	while ($zaznam4 = MySQL_Fetch_Array($vys4)):
		$i++;
		echo "<option>".$zaznam4["nazevrasy"];
		$rasaxx[]=$zaznam4["nazevrasy"];
	endwhile;
?>
</select>
<input type=hidden value="1" name="vybrano">
<input type=submit value="zobraz">
</form>
<?

				if($kde!="vip" and $kde!="adm" and $kde!="sys" and $kde!="neu" and $rasa==""){$rasa=$kde;$kde="dom";};
				if($rasa=="Novévùv"){$rasa="Novévùv Goa\'uld";};
				if($rasa=="Raùv"){$rasa="Raùv Goa\'uld";};
				$rasa2=stripslashes($rasa);		
				echo "<h6>";
				switch ($kde){
					case "vip":	echo "Vip planeta";break;
					case "sys":	echo "Systémové forum";break;
					case "adm":	echo "Oznámení adminù";break;
					case "neu":	echo "Neutrální planeta";break;					
					case "dom":	echo "Planeta ";
								switch($rasa2){
									case $rasaxx[1]:echo $rasaxx[1];break;
									case $rasaxx[2]:echo $rasaxx[2];break;
									case $rasaxx[3]:echo $rasaxx[3];break;
									case $rasaxx[4]:echo $rasaxx[4];break;
									case $rasaxx[5]:echo $rasaxx[5];break;
									case $rasaxx[6]:echo $rasaxx[6];break;
									case $rasaxx[7]:echo $rasaxx[7];break;
									case $rasaxx[8]:echo $rasaxx[8];break;
									case $rasaxx[9]:echo $rasaxx[9];break;
									case $rasaxx[0]:echo $rasaxx[0];break;
							}
							break;
				}
				echo "</h6>";
				$kde2=$kde;
				$kde="kde = '".$kde."'";
				if($rasa==""):
					$rasa="";
					$kde3=$kde2;
				else:
					$rasa=addslashes($rasa);
					$rasa=" and rasa ='".$rasa."'";
					$kde3=$kde2."&rasa=".$rasa2;
				endif;
				//echo "<font class=text_bili>$rasa2";
				if(!isset($x)||$x<0){$x=0;};
				//echo "<h1>neutrální planeta</h1>";
				$xx=$x+20;

				if ($vybrano!=1) {exit;}

				if(!isset($x)||$x<0){$x=0;};
				$xx=20;
				
			    $vys2 = MySQL_Query("SELECT * FROM forum where $kde $rasa ORDER BY den DESC LIMIT $x,$xx");
				echo "<h6>Použité barevné rozlišení: <font color=#01BAFF>admin</font>, <font color=#FFFF00>vùdce</font>, <font color=#FFFFFF>zástupce</font>, <font color=#B48223>asistent</font>, <font color=#555555>vyhnanec</font>, <font color=#626CC6>obèan</font>. Status je brán v dobì odeslání pošty.</h6>";
				echo "</center>";
				if($kde2!="0"):	
					echo "<form method='post' action='hlavni.php?page=admin2&kde=".$kde3."'>";
					echo "<input type='hidden' value='jo' name='odeslano'>";
					echo "<textarea name='co' rows=10 cols=60></textarea><br>";
					echo "<input type='submit' value='odešli'>";
					echo "<center><a href='hlavni.php?page=admin2&kde=".$kde3."&vybrano=1'><img src='refresh2.jpg' border=0></a></center></form><br>";
				endif;

				while ($zaznam2 = MySQL_Fetch_Array($vys2)):
					  $vedne=$zaznam2["den"];
					  $vedne=Round($vedne/(3600*24));
					  $rok=Floor($vedne/24);
					  $mes=$vedne-($rok*24);
					  $rok+=1515;
					  switch($mes):
						case 1: $mesic="1.-15. ledna";break;
						case 2: $mesic="16.-31. ledna";break;
						case 3: $mesic="1.-15. února";break;
						case 4: $mesic="16.-28. února";break;
						case 5: $mesic="1.-15. bøezna";break;
						case 6: $mesic="16.-31. bøezna";break;
						case 7: $mesic="1.-15. dubna";break;
						case 8: $mesic="16.-30. dubna";break;
						case 9: $mesic="1.-15. kvìtna";break;
						case 10: $mesic="16.-31. kvìtna";break;
						case 11: $mesic="1.-15. èervna";break;
						case 12: $mesic="16.-30. èervna";break;
						case 13: $mesic="1.-15. èervence";break;
						case 14: $mesic="16.-31. èervence";break;
						case 15: $mesic="1.-15. srpna";break;
						case 16: $mesic="16.-31. srpna";break;
						case 17: $mesic="1.-15. záøí";break;
						case 18: $mesic="16.-30. záøí";break;
						case 19: $mesic="1.-15. øíjna";break;
						case 20: $mesic="16.-31. øíjna";break;
						case 21: $mesic="1.-15. listopadu";break;
						case 22: $mesic="16.-30. listopadu";break;
						case 23: $mesic="1.-15. prosince";break;
						case 0: $mesic="16.-31. prosince";break;
					  endswitch;
					//echo $mes;
				  switch ($zaznam2[stat]):
					case 1:
      					$barva="#FFFF00";
						break;
					case 2:
				        $barva="#FFFFFF";
						break;
					case 3: 
       					$barva="#B48223";
						break;
					case 4: 
     					$barva="#555555";
						break;
					case 5: 
     					$barva="#626CC6";
						break;						
					case 6: 
     					$barva="#01BAFF";
						break;						
					default: 
       					$barva="#626CC6";
				  endswitch;
				  
					  $datum=Date("h:i:s j.m.Y",$zaznam2["den"]);
					  $datak=$datum1=$zaznam2["den"];
					  $datum2=Date("U");
			  		  $datum1=$datum2-$datum1;
					  $datum1=$datum1/3600;
			  		  $datum1=$datum1/24;
			  		  $datum1=Round($datum1);
					  if($datum1>14){MySQL_Query("DELETE FROM forum WHERE den = $datak");};
					  echo "<font fontSize=12px fontfamily=Times New Roman color=".$barva."><b>";
					  echo "vesmírné datum: ".$mesic." ".$rok." (".$datum.")";
					  echo "<br>".$zaznam2["jmeno"]." (".$zaznam2["rasa"].") : <br>";
                	  		  echo stripslashes($zaznam2["text"]);
					  //if($zaznam2["jmeno"]==$logjmeno):
						echo "<br><form method='post' action='hlavni.php?page=admin2&kde=neu'>";
						echo "<input type='hidden' value='".$datak."' name='smaz'>";
						echo "<input type='submit' value='smaž'></form>";
					  //endif;	
					  echo "<br></b></font><br><br>";	
				 endwhile;
		



		$y=$x+20;
		$z=$x-20;
		echo "<h6><a href=hlavni.php?page=admin2&x=".$z."&kde=".$kde2."&rasa=".$rasa2."&vybrano=1>novìjších 20 zpráv</a><br>";
		echo "<a href=hlavni.php?page=admin2&x=".$y."&kde=".$kde2."&rasa=".$rasa2."&vybrano=1>starších 20 zpráv</a></h6>";
MySQL_Close($spojeni);		

?>