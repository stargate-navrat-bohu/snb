<?
			switch ($rasa1){
				case 1: $uvod="Ihned pot� co Vrchn� velen� dostalo od ".$logjmeno." flotilami na�imi elitn�mi voj�ky byly komanda zmobilizov�ny! Do p�r hodin byly p�ipraveny k akci a a nalo�ovaly se do transportn�ch lod�. Dal�� jednotky �ekaly u Hv�zdn� br�ny.";
					break;
				case 2: $uvod="Ihned pot� co tv�j prvn� mu� dostal od ".$logjmeno."rozkaz ke skryt�mu Jaffsk�mu �toku se na�i Jaffov� p�ipravili na pozemn� boj! Do p�r hodin byli p�ipraveni k �toku a nalo�ovaly se do Teltak� . Dal�� jednotky �ekaly u Chaapa'ai.";
					break;
				
				case 3: $uvod="Ihned pot� co Star�� dostali od ".$logjmeno." ��dost o klasick� krvav� p�chotn� �tok na Ovladateln� se zfanatizovan� skupiny Reetou p�ipravily na krvavou a bezhlavou pozemn� �e�! Do p�r hodin byly skupiny p�ipraveny k akci a nalo�ovaly se do transportn�ch lod� . Dal�� skupiny �ekaly u Hv�zdn� br�ny";
					break;

				case 4: $uvod="Jakmile na�i vojev�dcov� v �ele s Thorem dostali ozn�men� k �toku od ".$logjmeno."  byly replik�to�i rychle naprogramov�ni pro nast�vaj�c� akci ihned pot� byly p�ipraveny bojovat za ide�ly a �est na�� rasy. Do p�r hodin byly houfy replik�tor� nachystan� a nalo�ovaly se do mate�sk�ch lod�. Dal�� jednotky �ekaly u br�ny";
					if($tu1>0 or $tu2>0){$uvod.=" nalo�ovaly se do transportn�ch k�j� v Mate�sk�ch lod�ch ";};
					if($tu4>0){$uvod.=" let�ly k c�lov� planet�. ";};
					$uvod.=".Dal�� jednotky �ekaly u mocn� br�ny.";
					break;

				case 5: $uvod="Ihned pot� co Velen� R�dc� dostalo od ".$logjmeno." rozkaz k �toku se oddan� jednotky Tok'r� p�ipravily na �tok. Do p�r hodin byli v�ichni p�ipraveni k boji a nalo�ovaly se do Teltak�. Dal�� jednotky �ekaly u Hv�zdn� br�ny. ";
					break;


				case 6: $uvod="Ihned pot� co Chulie dostala od Sen�tora ".$logjmeno."  informace o guerillov�m �toku se vzne�en� elita Security force p�ipravila k boji za sv� ide�ly. Iontov� pu�ky byly p�ipraveny! Do p�d hodin se odd�ly nalo�ovaly se do raketopl�n�. Dal�� jednotky �ekaly u um�l� Hv�zdn� br�ny.";
					break;

				case 7: $uvod="Ihned pot� co Konfedera�n� vojensk� veden� dostalo od ".$logjmeno." rozkaz k mechov�mu �toku se elitn� os�dky Mech� zmobilizovaly k boji. Do p�d hodin tyto ohromn� stroje nalo�ov�ny do transportn�ch lod�. Dal�� jednotky �ekaly u br�ny. ";
					break;

				case 9: $uvod="Ihned pot� co Nejvy��� generalisimov� dostali od ".$logjmeno." informace  o �toku neschopn� jednotky davy odvedenc� plou�iv� dostavily na p�ehl�dku. Do p�r hodin byly tis�ce voj�k� p�ipraveny j�t na smrt a nalo�ovaly se do transportn�ch Bombard�r�. Dal�� jednotky �ekaly u Hv�zdn� br�ny. ";
					break;

				case 8: $uvod="Ihned pot� co Dikt�tor schv�lil od ".$logjmeno." pl�n k �toku se fanatick� pos�dky komanda p�ipravila k pozemn�mu boji, za Neferta! Do p�d hodin byly komanda p�ipraveny k akci a nalo�ovaly se do Samolet�. Dal�� jednotky �ekaly u br�ny.";
					break;

				case 10: $uvod="Ihned pot� co chemick� bojovn�ci schv�lil od ".$logjmeno."   �tok na nep��tele se na�e hrd� prapory SG �et p�ipravily k boji! Do p�d hodin byly jednotky p�ipraveny k p�epaden� nep��telsk� planety a zanedlouho se nalo�ovaly se do Promethe�. Dal�� jednotky �ekaly u Hv�zdn� br�ny. ";
					break;

			}
			echo "<div id='pa1' class='infon'>".$uvod."<br><br></div>";
if($us==1 and $ztraty<30):
	$x=20;

	echo "<div id='pa2' class='infon'>Kr�tce po po��tku �toku za�aly na�e jednotky nep��tele zatla�ovat! Jinde jsme prolomili obranu u jejich velk�ho m�sta a zastihli nep��tele nep�ipraven�!<br><br></div>";
	echo "<div id='pa3' class='infon'>Ustupuj�c� nep��tel� n�m zp�sobuj� n�jak� �kody, ale nejde o nic v�znamn�ho. Z n�kolika ostrov� jsme nep��tele vytla�ili b�hem p�r hodin, n�jak� jednotky se uch�lily do les�<br><br></div>";
	echo "<div id='pa4' class='infon'>Ve fin�ln� bitv� o jejich kosmodrom jsme prorazili a ulet�li k na��m lod�m, a�koliv jsme p�i�li o dal�� jednotky, ale nep��tel byl sra�en. Jeho planeta ho��, �kody n�mi zp�soben� jsou stra�liv�!<br><br></div>";

elseif($us==1 and $ztraty<70):
	$kam="lesy";	

	echo "<div id='pa2' class='infon'>Kr�tce po po��tku �toku se uk�zalo �e na�e p�chotn� skupiny jsou na akci m�lo p�ipraven�! Na�e ztr�ty za�aly nar�stat!<br><br></div>";
	echo "<div id='pa3' class='infon'>P�es po��te�n� t�k� ztr�ty se va�� velitel� uch�lily do les�. Pot� jsme napadli voj�ky nep��tele zboku skrz lesy a vyplenili mnoho nechr�n�n�ch m�st. Na��m dal��m c�lem je 500km vzd�len� pou��, kde n�s evakuuj� lod�, p�edt�m ale mus�me zni�it protivzdu�nou�<br><br></div>";
	echo "<div id='pa4' class='infon'>Bitva u stanovi�t� protivzdu�n� i pochod k evakuaci z vyplen�n� planety zabraly, na�e lod� hromadn� p�ist�valy a braly n�s ze zni�en� planety, na�e ztr�ty jsou ale hroziv�<br><br></div>";

elseif($us==1 and $ztraty<100):
	$x=13;
	$x2=20;

	echo "<div id='pa2' class='infon'>Kr�tce po po��tku �toku byly na�i p��ci zastaveni a obkl��eny vlnami nep��tel! Plno na�ich jednotek uniklo, jin� byly zabity a dal�� se pod obkl��en�m br�nily v ruin�ch m�st!<br><br></div>";
	echo "<div id='pa3' class='infon'>Po n�kolika dnech kdy� bylo plno na�ich obkl��en�ch jednotek zni�eno na�i velitel� evakuovali zbyl� p��ky a ne�ekan� je transportovaly jinam na planetu, tentokr�t do vzd�len�j��ch les�. Tato p�ekvapila nep��tele!Na�e elitn� p�chotn�  skupiny prov�d�ly n�kolik t�dn� z�kodnick� akce<br><br></div>";
	echo "<div id='pa4' class='infon'>Pot� ale velitel� invaze usoudili, �e c�l byl spln�n a evakuovali na�e p��ky dom�. Tato krvav� bitva ve�la ve zn�most, bude jist� n�kolikr�t proslavena v eposech!<br><br></div>";

endif;

if($us==0 and $ztratyj<25):
	echo "<div id='pa2' class='infon'>Kr�tce po po��tku �toku byly na�i p��ci zastaveni a obkl��eny vlnami nep��tel! Plno na�ich jednotek uniklo, jin� byly zabity a dal�� se pod obkl��en�m br�nily v ruin�ch m�st!<br><br></div>";
	echo "<div id='pa3' class='infon'> .. v�me jen, �e �  padl� � proboha! Bombarduj� n�s! .. [sign�l ru�en]..dal�� �toky � poda�ilo se n�m objevit ob�� stanovi�t� nep��tel, sna��me se je zastihnout nep�ipraven� a� [sign�l ru�en]� byli jsme zastaveni a obkl��[sign�l ru�en]<br><br></div>";
	echo "<div id='pa4' class='infon'>[nouzov� vol�ni; dva t�dny po po��tku �toku] � jsme v oble�en�, je n�s u� jen n�kolik, nep��tel� nemaj� skoro ��dn� padl�, � te� to vypad� �e n�co montuj� nedaleko, mo�n� �e je to zbra�, ale nejsem si jis�[b���m!! ] � medik! �[b���m!! ] � [sign�l ztracen; kan�l ztracen]<br><br></div>";

elseif($us==0 and $ztratyj<50):
	echo "<div id='pa2' class='infon'>Kr�tce po po��tku �toku byly na�i p��ci zastaveni a obkl��eny vlnami nep��tel! Plno na�ich jednotek uniklo, jin� byly zabity a dal�� se pod obkl��en�m br�nily v ruin�ch m�st!<br><br></div>";
	echo "<div id='pa3' class='infon'>Na�e obkl��en� jednotky ustoupily do opu�t�n� pevnosti Helm..[sign�l ru�en].., kde jsme se zakopali. P�esila nep��tel sem m���c�ch je velk�, prozat�m nepom��l�me ani na spln�n� �kol�, ani na evakuaci, � na�e lod� jsou na orbit� od��znuty protivzdu�nou�<br><br></div>";
	echo "<div id='pa4' class='infon'>[nouzov� vol�ni; 11 dn� po po��tku �toku] .. pevnost je skoro dobyta, nep��tel hl�dkuje v oblasti letadly� te� p�ich�z� dal�� �tok, bo�e, my to nezvl�dnem..[sign�l ru�en]� �tok jsme p�est�li, ale na dal�� nem�me n�rod � p�ich�z� dal�� siln� �tok, to ned�me�[sign�l ztracen; kan�l ztracen]<br><br></div>";
	
elseif($us==0 and $ztratyj<100):
	$kam="les�";

	echo "<div id='pa2' class='infon'>Kr�tce po po��tku �toku za�aly na�e jednotky nep��tele zatla�ovat! Jinde jsme prolomili obranu u jejich velk�ho m�sta a zastihli nep��tele nep�ipraven�!<br><br></div>";
	echo "<div id='pa3' class='infon'>[sign�l zachycen o 5 dn� pozd�ji; z�lo�n� kan�l] byla to past! To velkom�sto bylo pln� v�bu�nin, obkl��eno masami voj�k�, jsme uprost�ed toho m�sta obkl��eni�..[sign�l ru�en].. na�e situace je zl�, zastavili jsme zb�sil� postup nep��tel a zp�sobili jim velk� �kody na p�chot�, ale dal�� n�por nezastav�me ..[sign�l ru�en]..,  <br><br></div>";
	echo "<div id='pa4' class='infon'>[sign�l zachycen o 2 dny pozd�ji]� Krv�v� �e� uprost�ed tot�ln� zni�en�ho m�sta, tak to tady vypad�, my nem�me �anci se vr�tit, pozdravujte na�e rodiny ..[sign�l ztracen]<br><br></div>";

endif;
?>
