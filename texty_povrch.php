<?
			switch ($rasa1){
				case 1: $uvod="Ihned pot� co Vrchn� velen� dostalo od ".$logjmeno." rozkaz k �toku,";
					if($tu1>0){$uvod.=" SG t�my";};
					if($tu2>0){$uvod.=" mechanizovan� SG t�my";};
					if($tu4>0){$uvod.=" lod� typu X303";};
					$uvod.=" byly mobilizov�ny. Do p�r hodin byly jednotky p�ipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do transportn�ch raketopl�n� ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u br�ny v komplexech SGC z�kladen.";
					break;
				case 2: $uvod="Ihned pot� co tv�j prvn� mu� dostal od ".$logjmeno." rozkaz k �toku, se odd�ly ,";
					if($tu1>0){$uvod.=" Jaff�";};
					if($tu2>0){$uvod.=" Kluz�k�";};
					if($tu4>0){$uvod.=" Hatack�";};
					$uvod.=" p�ipravily na �e�! Do p�r hodin byly na�i hrdinn� bojovn�ci  p�ipraveni k �toku a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do Teltak� ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� bojovn�ci �ekali u Chaapa'ai.";
					break;
				
				case 3: $uvod="Ihned pot� co Star�� dostali od ".$logjmeno." ��dost o �tok na Ovladateln� se zfanatizovan� ,";
					if($tu1>0){$uvod.=" Skupinky Reetou";};
					if($tu2>0){$uvod.=" Terorist�";};
					if($tu4>0){$uvod.=" Cyborgov�";};
					$uvod.=" p�ipravily na krvavou a bezhlavou �e�! Do p�r hodin byly odd�ly p�ipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do neviditeln�ch transportn�ch lod ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u br�ny.";
					break;

				case 4: $uvod="Jakmile na�i vojev�dcov� v �ele s Thorem dostali ozn�men� k �roku od ".$logjmeno."  byly jednotky Asgard� o ,";
					if($tu1>0){$uvod.=" Ocho�en�ch replik�torech ";};
					if($tu2>0){$uvod.=" Jormundech";};
					if($tu4>0){$uvod.=" nejlep��ch lod�ch galaxie";};
					$uvod.=" p�ipraveny bojovat za ide�ly a �est jejich rasy. Do p�r hodin byly jednotky p�ipraveny k �toku a  ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do transportn�ch k�j� v Mate�sk�ch lod�ch ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u mocn� br�ny.";
					break;

				case 5: $uvod="Ihned pot� co Velen� R�dc� dostalo od ".$logjmeno." rozkaz k �toku se oddan� ,";
					if($tu1>0){$uvod.=" Skupinky Tok'r� ";};
					if($tu2>0){$uvod.=" Seizmick�ch bomb";};
					if($tu4>0){$uvod.=" Bombardovac�ch Teltak�";};
					$uvod.=" byly mobilizov�ny. zmobilizov�ny. Do p�r hodin byly odd�ly p�ipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do Teltak� ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u Hv�zdn� br�ny. ";
					break;


				case 6: $uvod="Ihned pot� co Chulie dostala od Sen�tora ".$logjmeno."  informace o �toku se vzne�en�  ,";
					if($tu1>0){$uvod.=" Security force ";};
					if($tu2>0){$uvod.=" Iontov� d�la ";};
					if($tu4>0){$uvod.=" Fregaty";};
					$uvod.=" p�ipravily k boji za sv� ide�ly. Do p�d hodin byly odd�ly p�ipraveny p�ed kas�rnami k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do Carrier� ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u um�le vytvo�en� Hv�zdn� br�ny.";
					break;

				case 7: $uvod="Ihned pot� co Konfedera�n� vojensk� veden� dostalo od ".$logjmeno." rozkaz k �toku se elitn� jednotky ";
					if($tu1>0){$uvod.=" Mech� ";};
					if($tu2>0){$uvod.=" Gunship� ";};
					if($tu4>0){$uvod.=" Harvester� ";};
					$uvod.=" zmobilizov�ny k boji. Do p�d hodin byly odd�ly p�ipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do transportn�ch lod� ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u a v Harvesterech u Hv�zdn� br�ny.";
					break;

				case 9: $uvod="Ihned pot� co Nejvy��� generalisimov� dostali od ".$logjmeno." informace  o �toku se neschopn� jednotky ";
					if($tu1>0){$uvod.=" Odvedenc� ";};
					if($tu2>0){$uvod.=" Bombard�r� ";};
					if($tu4>0){$uvod.=" Chemick�ch bojovn�k� ";};
					$uvod.=" vyplou�ily ze smradlav�ch kas�ren. Do p�d hodin byly arm�dy p�ipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do Transportn�ch bombard�r� ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly v podzemn�ch z�kladn�ch u Hv�zdn� br�ny.";
					break;

				case 8: $uvod="Ihned pot� co Dikt�tor schv�lil od ".$logjmeno." pl�n k �toku se fanatick�  ";
					if($tu1>0){$uvod.=" Komanda ";};
					if($tu2>0){$uvod.=" Artilerie ";};
					if($tu4>0){$uvod.=" Samolety ";};
					$uvod.=" p�ipravily k boji za Neferta! Do p�d hodin byly odd�ly p�ipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do Transportn�ch Samolet� ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u Hv�zdn� br�ny.";
					break;

				case 10: $uvod="Ihned pot� co V�dce odboje schv�lil od ".$logjmeno."  �tok na nep��tele se na�e hrd� jednotky ";
					if($tu1>0){$uvod.=" SG �et ";};
					if($tu2>0){$uvod.=" F/A-302 Jerrymouse ";};
					if($tu4>0){$uvod.=" BC-303 Prometheus2  ";};
					$uvod.=" p�ipravily k boji! Do p�d hodin byly jednotky p�ipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do Transportn�ch lod� ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u Hv�zdn� br�ny.";
					break;

			}
			echo "<div id='p1' class='infon'>".$uvod."<br><br></div>";
if($uspoz==1 and $ztraty<30):
	$x=20;

	echo "<div id='p2' class='infon'>Kr�tce po po��tku �toku za�aly na�e jednotky nep��tele zatla�ovat! Jinde jsme prolomili obranu u jejich velk� vojensk� z�kladny a zastihli nep��tele nep�ipraven�!<br><br></div>";
	echo "<div id='p3' class='infon'>Ustupuj�c� nep��tel� n�m zp�sobuj� n�jak� �kody, ale nejde o nic v�znamn�ho. Z n�kolika kontinent� jsme nep��tele vytla�ili b�hem ".$x." dn�, nyn� zb�v� pouze jejich posledn� z�kladna!<br><br></div>";
	echo "<div id='p4' class='infon'>Ve fin�ln� bitv� o jejich posledn� b�zi jsme p�i�li o dal�� jednotky, ale nep��tel byl pora�en. N�kolik jeho lod� ale z obsazen� planety uniklo!<br><br></div>";

elseif($uspoz==1 and $ztraty<70):
	$kam="lesy";	

	echo "<div id='p2' class='infon'>Kr�tce po po��tku �toku se uk�zalo �e na�e jednotky jsou na akci m�lo p�ipraven�! Na�e ztr�ty za�aly nar�stat!<br><br></div>";
	echo "<div id='p3' class='infon'>P�es po��te�n� t�k� ztr�ty va�i velitel� napadli arm�dami nep��tele zboku skrz ".$kam." a obsadily mnoho nechr�n�n�ch m�st. Obkl��ili nep��tele a spustili k��ovou palbu!<br><br></div>";
	echo "<div id='p4' class='infon'>Obkl��en� arm�dy se pokusily ne�sp�n� o proti�tok, ale neusp�ly a rozbily se o na�i obranu. Pot� se zoufal� a demoralizovan� jednotky nep��tele pokusily uniknout a nane�t�st� se to n�kolika z nich poda�ilo�<br><br></div>";

elseif($uspoz==1 and $ztraty<100):
	$x=13;
	$x2=20;

	echo "<div id='p2' class='infon'>Kr�tce po po��tku �toku byly na�e jednotky zastaveny a obkl��eny vlnami nep��tel! Plno na�ich jednotek uniklo, jin� byly zabity a dal�� se pod obkl��en�m br�nily v ruin�ch m�st!<br><br></div>";
	echo "<div id='p3' class='infon'>Po ".$x." dnech kdy� bylo plno na�ich obkl��en�ch jednotek zni�eno na�i velitel� provedli druhou invazi, tentokr�t na druhou polokouli. P�ekvapen� obr�nci sp�chali na druhou polokouli zat�mco my jsme se zabarik�dovali v m�stech druh� polokoule! <br><br></div>";
	echo "<div id='p4' class='infon'>Bitva o tyto m�sta byla mimo��dn� krvav� a zmasakrovala plno civilist�. M�sta byla pobo�ena a na�e i ciz� jednotky utrp�ly katastrof�ln� ztr�ty! Plno �ivot� bylo zma�eno, ale po ".$x2." dnech je planeta ".$naco." na�e!<br><br></div>";

endif;

if($uspoz==0 and $ztratyj<25):
	echo "<div id='p2' class='infon'>Jakmile za�al �tok na�e jednotky se ocitly pod stra�livou palbou! Velitel t�et� skupiny jednotek se sna�� o proti�tok ze severu .. xYwoeueXoejwgdt .. [sign�l ru�en] .. m�me t�k� ztr�ty .. [sign�l ru�en]<br><br></div>";
	echo "<div id='p3' class='infon'> .. v�me jen, �e �  padl� � proboha! Transport�ry jsou sest�elov�ny!! Mus�me evakuv� [sign�l ztracen]� � tady je z�lo�n� v�le�n� report�r, ten p�vodn� byl zabit, situace je takov� �e � [sign�l ru�en]<br><br></div>";
	echo "<div id='p4' class='infon'>[nouzov� vol�ni na z�lo�n�m kan�lu; t�den po po��tku �toku] � na�e posledn� jednotky se uch�lily na kopec asi 130 kilometr� od m�sta zni�en� p�t� arm�dy � [sign�l ru�en].. je n�s p��li� m�lo, jejich �tok se ned� zastavit .. pom�.. [sign�l ztracen; z�lo�n� kan�l ztracen]<br><br></div>";

elseif($uspoz==0 and $ztratyj<50):
	echo "<div id='p2' class='infon'>Kr�tce po zah�jen� �toku se na�e arm�dy st�etli s masivn� p�evahou protivn�ka! Polovina jednotek byla zni�ena b�hem pokusu obsadit velkom�sto [sign�l ru�en], kter� je v�znamn�m industri�ln�m centrem..<br><br></div>";
	echo "<div id='p3' class='infon'>Ji�n� arm�dy byly nuceny ustoupit do rokliny [sign�l ru�en] .. zde se na�e jednotky zakopaly a byly p�ipraveny na obranu, zd� se �e [sign�l ztracen; kan�l ztracen]<br><br></div>";
	echo "<div id='p4' class='infon'>[nouzov� vol�ni na z�lo�n�m kan�lu; 18 dn� po po��tku �toku] .. rokle je pln� trosek a mrtv�ch, jak na�ich tak nep��tel. V�ude je plno [sign�l ru�en] .. mysl�m �e m�me �anci.. [nov� sign�l zachycen o 3 dny pozd�ji] .. jsme po palbou p�e�iv��ch nep��tel! Dosta�te n�s odsud! To je [sign�l ztracen; z�lo�n� kan�l ztracen]<br><br></div>";
	
elseif($uspoz==0 and $ztratyj<100):
	$kam="les�";

	echo "<div id='p2' class='infon'>Brzy po za��tku �toku bylo plno jednotek zni�eno, nep��tel ale nen� tolik jak jsme p�edpokl�dali! Snad to bude snadn� akc�[sign�l ztracen; prim�rn� kan�l zni�en]<br><br></div>";
	echo "<div id='p3' class='infon'>[sign�l zachycen o 8 dn� pozd�ji; z�lo�n� kan�l] � proti�tok na n�s byl p��li� drtiv�, ale snad to zvl�dneme! Nyn� obkli�uje nep��tele v p��stavn�m m�st� [sign�l ru�en], kde chceme oslabit jeho vojska! � Co to je! Jsme pod palbou!! [sign�l ztracen; sekund�rn� kan�l ztracen]<br><br></div>";
	echo "<div id='p4' class='infon'>[sign�l zachycen o 4 dny pozd�ji; posledn� z�lo�n� kan�l]� Byli jsme zatla�eni do ".$kam." , ale pouze za cenu jejich t�k�ch ztr�t! Sna��me se odtud dostat. Kurva, za�ali znova �to�it! Je jich p��li� mnoho!... [sign�l ztracen; posledn� z�lo�n� kan�l ztracen]�<br><br></div>";

endif;
?>
