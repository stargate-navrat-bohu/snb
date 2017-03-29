<?
mysql_query("SET NAMES cp1250");

			switch ($hrac["status"]){
			case 1:
				$status="vùdce";
				break;
			case 2:
				$status="zástupce";
				break;
			case 3:
				$status="asistent";
				break;
			case 4:
				$status="vyhnanec";
				break;
			case 0:
				$status="obèan";
				break;
			case 5:
				$status="ministr";
				break;				
			}

			$xxx_zk = MySQL_Query("SELECT gold,silver,statusextra FROM uzivatele where cislo = '$hrac[cislo]'");
        		$xxx_zk_1 = MySQL_Fetch_Array($xxx_zk);


if($xxx_zk_1[gold]==1) { $statse_m="Gold hráè"; }

elseif ($xxx_zk_1[silver]==1) { $statse_m="Silver hráè"; }
elseif ($xxx_zk_1[gold]==1 and $xxx_zk_1[silver]==1) { $statse_m="Gold hráè"; }
elseif ($xxx_zk_1[statusextra]==1) { $statse_m="Extra status"; }

else { $statse_m="Bez statusu"; }


			$cislorasy=$hrac["rasa"];
			$vys_ras = MySQL_Query("SELECT * FROM rasy where rasa = '$cislorasy'");
        	$zaznam_ras = MySQL_Fetch_Array($vys_ras);

			$vyroba=$hrac[prijem];

if($hrac[admin]==1){$funkce="Hlavní administrátor";}
if($hrac[admin]==2){$funkce="Zástupce";}
if($hrac[admin]==3){$funkce="Pøíbìháø";}
if($hrac[admin]==4){$funkce="Kontrolor";}
if($hrac[admin]==0){$funkce="Nemá práva";}





		if(isset($smaz)):

		  	$den = Date("U");
			$jmeno="$zaznam1[jmeno]";
			$rasa="Bohové";
			$text="Hráè $hracn byl smazán";
			MySQL_Query("INSERT INTO log (cil,den,cilt,akce,admin) VALUES ('2','$den','$hracn','smazání hráèe','$zaznam1[jmeno]')");
			
			$text=HTMLSpecialChars($text);
			$text=NL2BR($text);
			$text=AddSlashes($text);
			$stat=6;
			$kde="sys";

			MySQL_Query ("INSERT INTO forum VALUES('0','$den','$jmeno','$rasa','$text','$kde','$stat','$titulek','$pohlavi','$stat_2','$rasa', '$logcislo')");
      
      
      $v1 = MySQL_Query("SELECT jmeno,cislo,koho,email FROM uzivatele where cislo = '$smaz'");	
			$z1 = MySQL_Fetch_Array($v1);				
			$email=$z1[email];echo $email;
			$zprava="Toto je informaèní zpráva ze hry Stargate - Return Of The God (http://sg-rtg.net). Váš profil $hracn byl smazán za porušení pravidel, èi za dlouhodobou neaktivitu úètu.";
			mail ($email,"Informaèní zpráva ze hry SG-RTG",$zprava);
		
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


			echo "<br /><font class='text_cerveny'>".$text."</font><br /><br />";
		endif;


		if(isset($admin)):


				MySQL_Query("update uzivatele set admin = '$admin' where jmeno = '$kdo'");

if($admin==1){$pravomoc="Hlavní administrátor";}
if($admin==2){$pravomoc="Zástupce";}
if($admin==3){$pravomoc="Pøíbìháø";}
if($admin==4){$pravomoc="Kontrolor";}
if($admin==0){$pravomoc="Nemá práva";}

echo "Hráè $kdo získal status $pravomoc ";
			   
			endif;

?>