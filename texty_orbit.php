<?
			switch ($rasa1){
				case 1: $uvod="Ihned pot� co Vrchn� adminiralita dostalo od ".$logjmeno." rozkaz k �toku ";
					if($tu2>0){$uvod.=" flotilami st�ha�ek";};
					if($tu4>0){$uvod.=" lod� Prometheus";};
					$uvod.=" byly flotila mobilizov�na. Do p�r hodin byly lod� p�ipraveny k akci a let�ly hyperprostorem k c�lov� planet�.";
					break;
				case 2: $uvod="Ihned pot� co V� prvn� mu� dostal od ".$logjmeno." rozkaz k n�letu, se odd�ly ,";
					if($tu2>0){$uvod.=" letky Kluz�k�";};
					if($tu4>0){$uvod.=" Hatack�";};
					$uvod.=" p�ipravily na vesm�rn� boj! Do p�r hodin byly lod� pr�ipraveny k n�letu a vstupovaly do heperprostoru";
					break;
				
				case 3: $uvod="Ihned pot� co Star�� dostali od ".$logjmeno." ��dost o kosmick� �tok na Ovladateln� se zfanatizovan� ,";
					if($tu2>0){$uvod.=" Terorist�";};
					if($tu4>0){$uvod.=" Cyborgov�";};
					$uvod.=" p�ipravily na krvavou a bezhlavou �e�! Do p�r hodin byly odd�ly p�ipraveny k akci a sm��ovaly hyperprostorem k c�lov� planet�";
					break;

				case 4: $uvod="Jakmile na�i admir�lov� v �ele s Thorem dostali ozn�men� k �toku od ".$logjmeno."  byly lod� Asgard� o ,";
					if($tu2>0){$uvod.=" Jormundech";};
					if($tu4>0){$uvod.=" nejlep��ch lod�ch galaxie";};
					$uvod.=" p�ipraveny bojovat za ide�ly a �est jejich rasy. Do p�r hodin byly lod� p�ipraveny k �toku a a sm��ovaly subprostorem k c�li. ";
					break;

				case 5: $uvod="Ihned pot� co Velen� R�dc� dostalo od ".$logjmeno." rozkaz k �toku se oddan� ";
					if($tu2>0){$uvod.=" program�to�i Seizmick�ch bomb";};
					if($tu4>0){$uvod.=" os�dky Bombardovac�ch Teltak�";};
					$uvod.=" p�ipravily na �tok. Do p�r hodin byly flotila p�ipravena k akci a let�la hyperprostorem k c�li";
					break;


				case 6: $uvod="Ihned pot� co Chulie dostala od Sen�tora ".$logjmeno."  informace o kosmick�m �toku se vzne�en� os�dky,";
					if($tu2>0){$uvod.=" Iontov�ch d�l ";};
					if($tu4>0){$uvod.=" mate�sk�ch lod�";};
					$uvod.=" p�ipravily k boji za sv� ide�ly. Do p�d hodin byly odd�ly p�ipraveny na orbit� k akci a zanedlouho let�ly hyperprostorem k c�li.";
					break;

				case 7: $uvod="Ihned pot� co Konfedera�n� vojensk� veden� dostalo od ".$logjmeno." rozkaz k �toku se elitn� jednotky ";
					if($tu4>0){$uvod.=" Gunship� ";};
					if($tu2>0){$uvod.=" Harvester� ";};
					$uvod.=" zmobilizov�ny k boji. Do p�r hodin byly na orbit� Va�� domovsk� planety a zanedlouho u� hyperprostorem sm��ovaly k nep��telsk� flotile...";
					break;

				case 9: $uvod="Ihned pot� co Nejvy��� generalisimov� dostali od ".$logjmeno." informace  o �toku se neschopn� jednotky ";
					if($tu2>0){$uvod.=" chemick� bojovn�ci ";};
					if($tu4>0){$uvod.=" bombard��i ";};
					$uvod.=" vystartovaly z pono�en�ch orbit�ln�ch dok�. Do p�r hodin byly letky p�ipraveny k akci a vztupovali do hyperprostoru.";
					break;

				case 8: $uvod="Ihned pot� co Dikt�tor schv�lil od ".$logjmeno." pl�n k �toku se fanatick� pos�dky ";
					if($tu2>0){$uvod.=" Artileri� ";};
					if($tu4>0){$uvod.=" Samolet� ";};
					$uvod.=" p�ipravily k orbit�ln�mu boji, za Neferta! Do p�r hodin byla flotila p�ipravena k akci a let�la k c�ly";
					break;

				case 10: $uvod="Ihned pot� co V�dce odboje povolil od ".$logjmeno."  �tok na nep��tele se na�e hrd� flotily ";
					if($tu2>0){$uvod.=" F/A-302 Jerrymouse ";};
					if($tu4>0){$uvod.="  BC-303 Prometheus2 ";};
					$uvod.=" p�ipravily k boji! Do p�r hodin byly jednotky p�ipraveny k p�epaden� nep��telsk� orbity a zanedlouho u� let�ly k c�ly.";
					break;

			}
			echo "<div id='o1' class='infon'>".$uvod."<br><br></div>";
if($usorb==1 and $ztraty<30):
	$x=20;

	echo "<div id='o2' class='infon'>Nep��telsk� lod� byly zasko�eny a zasti�en� nep�ipraven�. Tak�ka ��dn� nem�la zapnut� �t�ty a byly bleskov� zni�eny na�imi zbran�mi!<br><br></div>";
	echo "<div id='o3' class='infon'>Ale n�hle se objevily nep��telsk� posily! N�sledn� bitva trvala ji� d�le, p�esn�ji ".$x." hodin, ale byla v�t�zn�! Nyn� ji� zb�v� jen nep��telsk� orbit�ln� dok!<br><br></div>";
	echo "<div id='o4' class='infon'>Obrana doku byla docela siln� a na�e kapit�ny zasko�ila, ale nen� nic, co by na�e flotila nezvl�dla a zanedlouho jsme bitvu vyhr�li za mal�ch ztr�t. M�me nyn� nadvl�du nad orbitou!<br><br></div>";

elseif($usorb==1 and $ztraty<70):
	$kam="lesy";	

	echo "<div id='o2' class='infon'>Nep��telsk� lod� byly zasko�eny a zasti�en� nep�ipraven�. Tak�ka ��dn� nem�la zapnut� �t�ty a byly bleskov� zni�eny na�imi zbran�mi!<br><br></div>";
	echo "<div id='o3' class='infon'>Ale n�hle se objevily nep��telsk� posily! Z hyperprostoru vyl�tala st�le nov� a nov� lo�! Na�e vlastn� lod� se sna�ily opravdu hodn�, ale zanedlouho jsme museli ustoupit p�ed p�esilou nep��tel na m�s�c planety�<br><br></div>";
	echo "<div id='o4' class='infon'>Obkl��en� jsme vymysleli lest, k jej�mu� uplatn�n� jsme pou�ili nep��telskou zajatou lo�! To ne�ekali! N�sledn� p�ilet�ly na�e posily a nep��tel� jen zt�� sta�ili ulet�t! Orbita je na�e, m��e za��t vylod�n�!<br><br></div>";

elseif($usorb==1 and $ztraty<100):
	$x=13;
	$x2=20;

	echo "<div id='o2' class='infon'>Kr�tce po po��tku �toku byly na�e lod� zasko�eny ji� �ekaj�c�mi lod�mi nep��tel! N�kdo n�s prozradil! [sign�l ru�en]<br><br></div>";
	echo "<div id='o3' class='infon'>Poda�ilo se n�m ale schovat se za odvr�cenou stranou m�stn�ho slunce a nal�kat nep��tel� do pasti! [sign�l ru�en] �<br><br></div>";
	echo "<div id='o4' class='infon'> � [sign�l ru�en] � Napadli jsme je zezadu a nav�c vyvolali um�lou erupci, kter� je � pocuchala :-) I tak ale dal�� bitva trvala ".$x." hodin a zanechala na�i flotilu v trosk�ch! Oblast kolem tohoto slunce nad�le z�stane poseta troskami na��ch i nep��telsk�ch lod�. Ale zb�vaj�c� posledn� lod� zajistily prostor pro v�sadek!<br><br></div>";

endif;

if($usorb==0 and $ztratyj<25):
	echo "<div id='o2' class='infon'>Kr�tce po po��tku �toku byly na�e lod� zasko�eny ji� �ekaj�c�mi lod�mi nep��tel! N�kdo n�s prozradil! [sign�l ru�en]<br><br></div>";
	echo "<div id='o3' class='infon'>.. v�me jen, �e �  zni�en� � proboha! Na�e lod� maj� vypadnut� �t�ty! EMP pulsy �[sign�l ru�en] Mus�me zmize� [sign�l ztracen]� � tady je z�lo�n� v�le�n� report�r, ten p�vodn� byl zabit na vlajkov� lodi , situace je takov� �e � [sign�l ru�en] �<br><br></div>";
	echo "<div id='o4' class='infon'>[nouzov� vol�ni na z�lo�n�m kan�lu; den po po��tku �toku] � na�e posledn� lod� se uch�lily dvacet mili�n� kilometr� odsud, za plynn�ho obra a douf�me �e zde bitvu zvr�t�me v n� prosp�ch � [sign�l ru�en].. je n�s p��li� m�lo, jejich �tok se ned� zastavit .. pom�.. [sign�l ztracen; z�lo�n� kan�l ztracen]<br><br></div>";

elseif($usorb==0 and $ztratyj<50):
	echo "<div id='o2' class='infon'>Kr�tce po vysko�en� z hyperprostoru se na�e lod� st�etly s nep��telem! Kl��ov� siln� lod� byly d�ky p�ekvapiv�mu �toku nep��tel zni�eny a my mus�me ustoupit ke slunci .. [sign�l ru�en]�<br><br></div>";
	echo "<div id='o3' class='infon'>N�kter� lod� se sna�� o pr�lom na nechr�n�n� transportn� lod�, ale nep��tel na�e z�kodn�ky 16 hodin po po��tku �toku p�ekvapit a jsou pod palbou.. .. [sign�l ru�en]� vyd�v�me se jim pomoct! .. [sign�l ru�en]�<br><br></div>";
	echo "<div id='o4' class='infon'>[nouzov� vol�ni na z�lo�n�m kan�lu; 10 hodin po po��tku �toku] byla to past! P�ilet�li jsme sem a byly tu jen trosky z�kodn�k�! Brzy nato se odmaskovali nep��tel� a byli jsme obkl��eni! .. [sign�l ru�en]� na�e lod� selh�vaj� .. [sign�l ru�en]� na��dil jsem evakuaci pos�dek, m� lo� bude posledn� a bude se sna�it os�dky ochr�nit jak dlouho to p�jde�.. [sign�l ru�en]� �t�ty na 40% [b���m!!!] �t�ty na 8% .. [sign�l ru�en]� v�echnu energii do �t�t� .. opus�te lo� .. [sign�l ru�en]� jsem tu s�m, nastavil jsem autodestrukci a jsem nyn� pod velmi t�kou [b���m!!!] palbou uprost�ed nep��telsk� [b���m!!!] flotily! [lo� ztracena; autodestrukce zdvojen� naquadriov� hlavice byla �sp�n�, zni�eno plno nep��telsk�ch lod�; linka ztracena]<br><br></div>";
	
elseif($usorb==0 and $ztratyj<100):
	$kam="les�";

	echo "<div id='o2' class='infon'>Kr�tce po vysko�en� z hyperprostoru se na�e flotily st�etli s masivn� p�evahou lod� protivn�ka! Polovina lod� byla zni�ena b�hem pokusu oblet�t nep��telsk� lod� a zni�it je z boku� [sign�l ru�en].. ale nweszs� [sign�l ru�en]..<br><br></div>";
	echo "<div id='o3' class='infon'>Zbytek se pokusil o pr�lom na vlajkovou lo� nep��tele ale ani to se nepoda�ilo� n�kter� os�dky za�aly let�t pry� z boje� zbytek se .. [sign�l ru�en]�<br><br></div>";
	echo "<div id='o4' class='infon'>[nouzov� vol�ni na z�lo�n�m kan�lu; 14 hodin po po��tku �toku] .. trosky na�ich i nep��telsk�ch lod� padaj� atmosf�rou a zp�sobuj� sv�telnou �ou.. [sign�l ru�en] .. mysl�m �e m�me �anci.. [nov� sign�l zachycen o 3 hodiny pozd�ji] .. jsme po palbou nep��telsk�ch posil! Na�e motory, jak inerci�ln� tak hyperprostov� jsou zni�en�! Zbran� t�ce poni�en�! �t�ty dr�� jen tak tak� [sign�l ru�en].. v�echnu energii do �t�t��[sign�l ru�en].. bo�e, vemte ho na o�et�ovnu.. [sign�l ru�en].. ihned opus�te lo�!  [sign�l ztracen; z�lo�n� kan�l ztracen]<br><br></div>";

endif;
?>
