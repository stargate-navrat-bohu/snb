<?php
//mysql_query("SET NAMES cp1250");

if (!is_null($ocistit)) { MySQL_Query("UPDATE multaci set varovani='9' where cislo='$ocistit'"); }
if (!is_null($resetovat)) { MySQL_Query("UPDATE multaci set varovani='0' where cislo='$resetovat'"); }
if (!is_null($ztabpryc)) { MySQL_Query("DELETE from multaci where cislo='$ztabpryc'"); }

$vys1 = MySQL_Query("SELECT jmeno,heslo,cislo,heslo2,skin,koho FROM uzivatele where cislo = '$logcislo'");
$zaznam1 = MySQL_Fetch_Array($vys1);

require("adkontrola.php");

$akce1="Smaž zaškrtnuté záznamy";
$akce2="Proveď akce u zaškrtnutých záznamů";

	if($bla==$akce1):
		$am2 = MySQL_Query("SELECT cislo,jmeno FROM multaci where varovani!=4");
		while($am = MySQL_Fetch_Array($am2)):
		$co="pr".$am['cislo'];
			if($$co=='on'):
				MySQL_Query("delete from multaci where cislo=".$am['cislo']);
			endif;
		endwhile;	
	elseif($bla==$akce2):
		$am2 = MySQL_Query("SELECT cislo,jmeno,varovani FROM multaci where varovani!=4");
		while($am = MySQL_Fetch_Array($am2)):
			$co="pr".$am['cislo'];
			if($$co=='on'):
				$cislo=$am['cislo'];
				$kolik=$am['varovani']+1;
				if($kolik<4):
					$vys9 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislo");
					$zaznam9 = MySQL_Fetch_Array($vys9);
					$odesilatel="Admin";
					$adresat=$zaznam9['jmeno'];

					switch($kolik){
						case 1: $status="prvn� varov�n�";
							break;
						case 2: $status="druh� varov�n�";
							break;
						case 3: $status="t�et� a posledn� varov�n�";
							break;
					}		
					$co="Varujeme vás. Existuje podezření, že máte více než jeden login. To je porušení pravidel, za které vám hrozí smazání. V případě, že máte skutečně více loginů, tak je smažte. V případě opačném v sekci Osobní nastavení tento stav odůvodněte. Toto je ".$status.".";
					$text=HTMLSpecialChars($co);
					$text=NL2BR($text);
					$text=AddSlashes($text);
					$rasa_odesilatel="99";
					$i=0;
					do{
						if($i>30){break;}
						$proved=1;
						$den = Date("U");
    				    $id_posta = MySQL_Query("SELECT id FROM pocitani_id WHERE sekce='posta' ");
            	        $id_posta_1 = MySQL_Fetch_Array($id_posta);
                        $id=$id_posta_1['id']+1;
                        MySQL_Query("INSERT INTO posta (id,odeslano_kdy,odesilatel,adresat,rasa_odesilatel,text,nazev,`p/n`, typ) VALUES ($id,$den,'$odesilatel','$adresat','$rasa_odesilatel','$text', '$status', 'n', '2')");
                        MySQL_Query("update uzivatele set posta = posta + 1 where jmeno = '$adresat'");
		
						$kont2 = MySQL_Query("SELECT odeslano_kdy,odesilatel FROM posta where odeslano_kdy=$den");
						$kont = MySQL_Fetch_Array($kont2);
						if($kont['odesilatel']=="Admin"){$proved=0;}
						$i++;
					}while($proved);

					if($proved==0):
						$p=$zaznam9["posta"]+1;	
						MySQL_Query("update uzivatele set posta = $p where jmeno = '$adresat'");
						MySQL_Query("update multaci set varovani=$kolik,kdy=$den WHERE cislo=$cislo");
					else:
						echo "<h1>Poštu se bohužel nepodařilo odeslat, zkuste později.</h1>";
					endif;
				else:
					$vys9 = MySQL_Query("SELECT * FROM uzivatele where cislo = $cislo");
					$zaznam9 = MySQL_Fetch_Array($vys9);
					$hracn=$zaznam9['jmeno'];
					$smaz=$cislo;
					//echo "ble $am['jmeno']<br>";
					$den = Date("U");
					$jmeno="admin";
					$rasa="admin";
					$text="Hráč ".$hracn."byl smazán";
					$text=HTMLSpecialChars($text);
					$text=NL2BR($text);
					$text=AddSlashes($text);
					$stat=6;
					$kde="adm";

					$email=$zaznam9['email'];
					$zprava="Toto je informační zpráva ze hry SG-RTG (www.sg-rtg.net). Jelikož jste porušil(a) pravidla hry, tak byl váš profil ".$hracn." smazán.";
					mail ($email,"Informační zpráva z SG-RTG",$zprava);
					if($zaznam9['koho']!=$hracn):
						$kdo=$zaznam9['koho'];
						$vys5 = MySQL_Query("SELECT jmeno,volen FROM uzivatele where jmeno = '$kdo'");
						$zaznam5 = MySQL_Fetch_Array($vys5);
						$kolik=$zaznam5['volen']-1;
						MySQL_Query("update uzivatele set volen = $kolik where jmeno = '$kdo'");
					    MySQL_Query("DELETE FROM uzivatele WHERE cislo=$smaz");
						MySQL_Query("DELETE FROM planety WHERE cislomaj = $smaz");
						MySQL_Query("DELETE FROM mul WHERE jmeno='$hracn'");
						MySQL_Query("update multaci set varovani=4 WHERE cislo=$cislo");
					else:
						MySQL_Query("DELETE FROM uzivatele WHERE cislo=$smaz");			
						MySQL_Query("DELETE FROM planety WHERE cislomaj = $smaz");
						MySQL_Query("DELETE FROM mul WHERE jmeno='$hracn'");
						MySQL_Query("update multaci set varovani=4 WHERE cislo=$cislo");
					endif;
					echo "<h1>Smazáno $hracn</h1>";
				endif;
			endif;
		endwhile;
	endif;

	if(isset($pridat)):
		$vys99 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno='$pridat'");
		$zaznam99 = MySQL_Fetch_Array($vys99);

		if($zaznam99['cislo']>0):
		$cislo=$zaznam99['cislo'];
		$amm2 = MySQL_Query("SELECT * FROM multaci where cislo=$cislo");	
		$amm = MySQL_Fetch_Array($amm2);
		if($amm['cislo']!=$cislo):
			$odesilatel="Admin";
			$adresat=$zaznam99['jmeno'];
			$kolik=1;
			$co="Varuji Vás, porušejete pravidla, máte příliš loginů. Buďto je smažte nebo napište v osobních nastaveních důvod. Toto je první varování";
			$nazev = "Mulťáctví";
            $text=HTMLSpecialChars($co);
			$text=NL2BR($text);
			$text=AddSlashes($text);
			$rasa_odesilatel="99";
			$i=0;
			do{
				if($i>30){break;}
				$proved=1;
				$den = Date("U");
				$id_posta = MySQL_Query("SELECT id FROM pocitani_id WHERE sekce='posta' ");
                $id_posta_1 = MySQL_Fetch_Array($id_posta);
                $id=$id_posta_1['id']+1;
				MySQL_Query("INSERT INTO posta (id,odeslano_kdy,odesilatel,adresat,rasa_odesilatel,text,nazev,`p/n`, typ) VALUES ($id,$den,'$odesilatel','$adresat','$rasa_odesilatel','$text', '$nazev', 'n', '2')");
                MySQL_Query("update uzivatele set posta = posta + 1 where jmeno = '$adresat'");
        
				$kont2 = MySQL_Query("SELECT odeslano_kdy,odesilatel FROM posta where odeslano_kdy=$den");
				$kont = MySQL_Fetch_Array($kont2);
				if($kont['odesilatel']=="Admin"){$proved=0;}
                //$proved=1;
				$i++;
			}while($proved);

			if($proved==0):
				$p=$zaznam9["posta"]+1;	
				MySQL_Query("update uzivatele set posta = $p where jmeno = '$adresat'");
				MySQL_Query("insert into multaci (cislo,jmeno,varovani,kdy,udavac) values ($cislo,'$pridat',$kolik,$den,'$logjmeno')");
			else:
				echo "<h1>Pošta se bohužel nepodařila poslat, zkuste později.</h1>";
			endif;
		else:
			echo "<h1>Tento login už v tabulce je.</h1>";			
		endif;
		else:
			echo "<h1>Tento login neexistuje.</h1>";	
		endif;
	endif;
	
	if(isset($anti)):
		MySQL_Query("delete from antimulty where cislo=$anti");				
	endif;
	
	if(isset($pan)):
		$uzje2 = MySQL_Query("SELECT * FROM antimulty where jmeno='$pan'");	
		$uzje = mysql_num_rows($uzje2);
		
		$i=0;
		$kontrola1 = MySQL_Query("SELECT cislo,jmeno FROM uzivatele where jmeno = '$pan'");
		do{
			$i++;
			if($i>20){break;}
			$dobre=1;
			$kontrola=MySQL_Fetch_Array($kontrola1);
			if($pan==$kontrola['jmeno']){$dobre=0;$cislo=$kontrola['cislo'];}
		}while($dobre);				

		if($dobre==0 and $uzje<1):
			MySQL_Query("insert into antimulty (cislo,jmeno) values ($cislo,'$pan')");
		else:
			echo "<h1>Tento profil už v antimulti je nebo neexistuje</h1>";
		endif;
	endif;	
	if($podle==0 or empty($podle)):
		$am2 = MySQL_Query("SELECT * FROM multaci where varovani!=4 order by jmeno");	
		$at2 = MySQL_Query("SELECT * FROM antimulty order by jmeno");		
	elseif($podle==1):
		$am2 = MySQL_Query("SELECT * FROM multaci where varovani!=4 order by duvod DESC");	
		$at2 = MySQL_Query("SELECT * FROM antimulty order by jmeno");		
    endif;
	
?>
<font class=text_bili>
<h6><font class=text_modry>P</font>řidání někoho do tabulky</h6> 
<form name='form' method='post' action='hlavni.php?page=admin9'>
<input type=text name=pridat><input type=submit value="Přidej">
</form>

<script type="text/javascript">
<!--
function checkAll(formId, cName, check ) {
    for (i=0,n=formId.elements.length;i<n;i++)
        if (formId.elements[i].className.indexOf(cName) !=-1)
            formId.elements[i].checked = check;
}
-->
</script>

<form name='form' method='post' id='myform' action='hlavni.php?page=admin9'>
<input type=submit value="<?echo $akce1;?>" name="bla"><br>
<input type=submit value="<?echo $akce2;?>" name="bla"><br>
<a href="javascript:void(0);" onclick="checkAll(document.getElementById('myform'), 'filecheck', true);">vybrat vše</a>&nbsp;
<a href="javascript:void(0);" onclick="checkAll(document.getElementById('myform'), 'filecheck', false); checkAll(document.getElementById('myform'), 'filecheck2', true);">vybrat neodůvodněné</a>&nbsp;
<a href="javascript:void(0);" onclick="checkAll(document.getElementById('myform'), 'filecheck', false);">odvybrat vše</a>
<h6>Tabulka antimulti:  
<a href='?podle=0' id=qba onMouseOver = Rozsvitit('qba') onMouseOut=Zhasnout('qba')>podle abecedy</a>
<a href='?podle=1' id=qba onMouseOver = Rozsvitit('qba') onMouseOut=Zhasnout('qba')>nejdřív odůvodnění</a></h6>

<?= "<TABLE ".$table." ".$border." width=100%>";?>
<tr>
<th>Jméno</th>
<th>posl. změna</th>
<th>odůvodnění</th>
<th>status</th>
<th>udavač</th>
<th colspan="2">akce</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
<?php


while($am = MySQL_Fetch_Array($am2)):
	$datek=Date("G:i:s j.m.Y",$am["kdy"]);
	$duvod=$am['duvod'];
	if($am['duvod']==""){$duvod="neuvedeno";}
	switch($am['varovani']):
		case 0: $status="pouze udán";
				$akce="varovat poprvé";
				$color="#66FF33";
				$color2="#7D7D00";
				break;
		case 1: $status="jednou varován";
				$akce="varovat podruhé";
				$color="#7D7D00";
				$color2="#CC6600";
				break;
		case 2: $status="dvakrát varován";
				$akce="varovat potřetí";
				$color="#CC6600";
				$color2="#CC0000";
				break;
		case 3: $status="třikrát varován";
				$akce="smazat";
				$color="#CC0000";
				$color2="#770000";
				break;
		case 9: $status="očištěn";
				$akce="nic";
				$color="#008000";
				$color2="#FFFFFF";
				break;
	endswitch;
	$kolikik=$am['varovani']+1;
	
	echo "<td>".$am['jmeno']."</td>";
	echo "<td>$datek</td>";	
	echo "<td>$duvod</td>";
	echo "<td><font color=$color>$status</font></td>";
	echo "<td>".$am['udavac']."</td>";
	if ($am['varovani']==9) {
		echo "<td colspan='3'>";
		} else {
			if($duvod=='neuvedeno'):
                echo "<td><input type=\"checkbox\" name=\"pr".$am['cislo']."\" class=\"filecheck2\"></td>";
            else:
                echo "<td><input type=\"checkbox\" name=\"pr".$am['cislo']."\" class=\"filecheck\"></td>";
 		    endif;
			echo "<td><i><font color=$color2>$akce</font></i></td>";
		    echo "<td>";}
	if ($am['varovani']!=9) {
		echo "<a href='hlavni.php?page=admin9&amp;ocistit=".$am['cislo']."'>očistit</a>";
	} else {
		echo "<a href='hlavni.php?page=admin9&amp;resetovat=".$am['cislo']."'>resetovat</a>";
    }
	echo "</td>";
	echo "<td>";
	echo "<a href='hlavni.php?page=admin9&amp;ztabpryc=".$am['cislo']."'>X</a>";
	echo "</td>";
	echo "</tr>";
endwhile;
echo "</form></table>";
?>
<h6>Přidání do antimulti teamu</h6> 
<form name='form' method='post' action='hlavni.php?page=admin9'>
<input type=text name=pan><input type=submit value="Přidej">
</form>
<h6>Antimulti team</h6>
<?= "<TABLE ".$table." ".$border." >";?>
<tr>
<th>Jméno</th>
<th>Počet udání</th>
<th>Akce</th>
</tr> 
<?php

while($at = MySQL_Fetch_Array($at2)):
	$udal2 = MySQL_Query("SELECT cislo FROM multaci where udavac='".$at['jmeno']."'");
	$udal = mysql_num_rows($udal2);

	echo "<td>".$at['jmeno']."</td>";
	echo "<td>$udal</td>";
	echo "<form name='form123' method='post' action='hlavni.php?page=admin9'>";	
	echo "<td><input type=submit value='vyhoď'>";
	echo "<input type=hidden name='anti' value=".$at['cislo']."></td></form>";
	echo "</tr>";
endwhile;
echo "</table>";	

MySQL_Close($spojeni);
?>
