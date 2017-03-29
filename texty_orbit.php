<?
			switch ($rasa1){
				case 1: $uvod="Ihned poté co Vrchní adminiralita dostalo od ".$logjmeno." rozkaz k útoku ";
					if($tu2>0){$uvod.=" flotilami stíhaèek";};
					if($tu4>0){$uvod.=" lodí Prometheus";};
					$uvod.=" byly flotila mobilizována. Do pár hodin byly lodì pøipraveny k akci a letìly hyperprostorem k cílové planetì.";
					break;
				case 2: $uvod="Ihned poté co Váš první mu dostal od ".$logjmeno." rozkaz k náletu, se oddíly ,";
					if($tu2>0){$uvod.=" letky Kluzákù";};
					if($tu4>0){$uvod.=" Hatackù";};
					$uvod.=" pøipravily na vesmírná boj! Do pár hodin byly lodì prøipraveny k náletu a vstupovaly do heperprostoru";
					break;
				
				case 3: $uvod="Ihned poté co Starší dostali od ".$logjmeno." ádost o kosmickı útok na Ovladatelné se zfanatizovaní ,";
					if($tu2>0){$uvod.=" Teroristé";};
					if($tu4>0){$uvod.=" Cyborgové";};
					$uvod.=" pøipravily na krvavou a bezhlavou øe! Do pár hodin byly oddíly pøipraveny k akci a smìøovaly hyperprostorem k cílové planetì";
					break;

				case 4: $uvod="Jakmile naši admirálové v èele s Thorem dostali oznámení k útoku od ".$logjmeno."  byly lodì Asgardù o ,";
					if($tu2>0){$uvod.=" Jormundech";};
					if($tu4>0){$uvod.=" nejlepších lodích galaxie";};
					$uvod.=" pøipraveny bojovat za ideály a èest jejich rasy. Do pár hodin byly lodì pøipraveny k útoku a a smìøovaly subprostorem k cíli. ";
					break;

				case 5: $uvod="Ihned poté co Velení Rádcù dostalo od ".$logjmeno." rozkaz k útoku se oddané ";
					if($tu2>0){$uvod.=" programátoøi Seizmickıch bomb";};
					if($tu4>0){$uvod.=" osádky Bombardovacích Teltakù";};
					$uvod.=" pøipravily na útok. Do pár hodin byly flotila pøipravena k akci a letìla hyperprostorem k cíli";
					break;


				case 6: $uvod="Ihned poté co Chulie dostala od Senátora ".$logjmeno."  informace o kosmickém útoku se vznešené osádky,";
					if($tu2>0){$uvod.=" Iontovıch dìl ";};
					if($tu4>0){$uvod.=" mateøskıch lodí";};
					$uvod.=" pøipravily k boji za své ideály. Do pád hodin byly oddíly pøipraveny na orbitì k akci a zanedlouho letìly hyperprostorem k cíli.";
					break;

				case 7: $uvod="Ihned poté co Konfederaèní vojenské vedení dostalo od ".$logjmeno." rozkaz k útoku se elitní jednotky ";
					if($tu4>0){$uvod.=" Gunshipù ";};
					if($tu2>0){$uvod.=" Harvesterù ";};
					$uvod.=" zmobilizovány k boji. Do pár hodin byly na orbitì Vaší domovské planety a zanedlouho u hyperprostorem smìøovaly k nepøátelské flotile...";
					break;

				case 9: $uvod="Ihned poté co Nejvyšší generalisimové dostali od ".$logjmeno." informace  o útoku se neschopné jednotky ";
					if($tu2>0){$uvod.=" chemickı bojovníci ";};
					if($tu4>0){$uvod.=" bombardéøi ";};
					$uvod.=" vystartovaly z ponoèenıch orbitálních dokù. Do pár hodin byly letky pøipraveny k akci a vztupovali do hyperprostoru.";
					break;

				case 8: $uvod="Ihned poté co Diktátor schválil od ".$logjmeno." plán k útoku se fanatické posádky ";
					if($tu2>0){$uvod.=" Artilerií ";};
					if($tu4>0){$uvod.=" Samoletù ";};
					$uvod.=" pøipravily k orbitálnímu boji, za Neferta! Do pár hodin byla flotila pøipravena k akci a letìla k cíly";
					break;

				case 10: $uvod="Ihned poté co Vùdce odboje povolil od ".$logjmeno."  útok na nepøítele se naše hrdé flotily ";
					if($tu2>0){$uvod.=" F/A-302 Jerrymouse ";};
					if($tu4>0){$uvod.="  BC-303 Prometheus2 ";};
					$uvod.=" pøipravily k boji! Do pár hodin byly jednotky pøipraveny k pøepadení nepøátelské orbity a zanedlouho u letìly k cíly.";
					break;

			}
			echo "<div id='o1' class='infon'>".$uvod."<br><br></div>";
if($usorb==1 and $ztraty<30):
	$x=20;

	echo "<div id='o2' class='infon'>Nepøátelské lodì byly zaskoèeny a zastiené nepøipravené. Takøka ádná nemìla zapnuté štíty a byly bleskovì znièeny našimi zbranìmi!<br><br></div>";
	echo "<div id='o3' class='infon'>Ale náhle se objevily nepøátelské posily! Následná bitva trvala ji déle, pøesnìji ".$x." hodin, ale byla vítìzná! Nyní ji zbıvá jen nepøátelskı orbitální dok!<br><br></div>";
	echo "<div id='o4' class='infon'>Obrana doku byla docela silná a naše kapitány zaskoèila, ale není nic, co by naše flotila nezvládla a zanedlouho jsme bitvu vyhráli za malıch ztrát. Máme nyní nadvládu nad orbitou!<br><br></div>";

elseif($usorb==1 and $ztraty<70):
	$kam="lesy";	

	echo "<div id='o2' class='infon'>Nepøátelské lodì byly zaskoèeny a zastiené nepøipravené. Takøka ádná nemìla zapnuté štíty a byly bleskovì znièeny našimi zbranìmi!<br><br></div>";
	echo "<div id='o3' class='infon'>Ale náhle se objevily nepøátelské posily! Z hyperprostoru vylétala stále nová a nová loï! Naše vlastní lodì se snaily opravdu hodnì, ale zanedlouho jsme museli ustoupit pøed pøesilou nepøátel na mìsíc planety…<br><br></div>";
	echo "<div id='o4' class='infon'>Obklíèení jsme vymysleli lest, k jejímu uplatnìní jsme pouili nepøátelskou zajatou loï! To neèekali! Následnì pøiletìly naše posily a nepøátelé jen ztìí staèili uletìt! Orbita je naše, mùe zaèít vylodìní!<br><br></div>";

elseif($usorb==1 and $ztraty<100):
	$x=13;
	$x2=20;

	echo "<div id='o2' class='infon'>Krátce po poèátku útoku byly naše lodì zaskoèeny ji èekajícími lodìmi nepøátel! Nìkdo nás prozradil! [signál rušen]<br><br></div>";
	echo "<div id='o3' class='infon'>Podaøilo se nám ale schovat se za odvrácenou stranou místního slunce a nalákat nepøátelé do pasti! [signál rušen] …<br><br></div>";
	echo "<div id='o4' class='infon'> … [signál rušen] … Napadli jsme je zezadu a navíc vyvolali umìlou erupci, která je … pocuchala :-) I tak ale další bitva trvala ".$x." hodin a zanechala naši flotilu v troskách! Oblast kolem tohoto slunce nadále zùstane poseta troskami naších i nepøátelskıch lodí. Ale zbıvající poslední lodì zajistily prostor pro vısadek!<br><br></div>";

endif;

if($usorb==0 and $ztratyj<25):
	echo "<div id='o2' class='infon'>Krátce po poèátku útoku byly naše lodì zaskoèeny ji èekajícími lodìmi nepøátel! Nìkdo nás prozradil! [signál rušen]<br><br></div>";
	echo "<div id='o3' class='infon'>.. víme jen, e …  znièené … proboha! Naše lodì mají vypadnuté štíty! EMP pulsy …[signál rušen] Musíme zmize… [signál ztracen]… … tady je záloní váleènı reportér, ten pùvodní byl zabit na vlajkové lodi , situace je taková e … [signál rušen] …<br><br></div>";
	echo "<div id='o4' class='infon'>[nouzové voláni na záloním kanálu; den po poèátku útoku] … naše poslední lodì se uchılily dvacet miliónù kilometrù odsud, za plynného obra a doufáme e zde bitvu zvrátíme v náš prospìch … [signál rušen].. je nás pøíliš málo, jejich útok se nedá zastavit .. pomó.. [signál ztracen; záloní kanál ztracen]<br><br></div>";

elseif($usorb==0 and $ztratyj<50):
	echo "<div id='o2' class='infon'>Krátce po vyskoèení z hyperprostoru se naše lodì støetly s nepøítelem! Klíèové silné lodì byly díky pøekvapivému útoku nepøátel znièeny a my musíme ustoupit ke slunci .. [signál rušen]…<br><br></div>";
	echo "<div id='o3' class='infon'>Nìkteré lodì se snaí o prùlom na nechránìné transportní lodì, ale nepøítel naše záškodníky 16 hodin po poèátku útoku pøekvapit a jsou pod palbou.. .. [signál rušen]… vydáváme se jim pomoct! .. [signál rušen]…<br><br></div>";
	echo "<div id='o4' class='infon'>[nouzové voláni na záloním kanálu; 10 hodin po poèátku útoku] byla to past! Pøiletìli jsme sem a byly tu jen trosky záškodníkù! Brzy nato se odmaskovali nepøátelé a byli jsme obklíèeni! .. [signál rušen]… naše lodì selhávají .. [signál rušen]… naøídil jsem evakuaci posádek, má loï bude poslední a bude se snait osádky ochránit jak dlouho to pùjde….. [signál rušen]… štíty na 40% [bùùùm!!!] štíty na 8% .. [signál rušen]… všechnu energii do štítù .. opuste loï .. [signál rušen]… jsem tu sám, nastavil jsem autodestrukci a jsem nyní pod velmi tìkou [bùùùm!!!] palbou uprostøed nepøátelské [bùùùm!!!] flotily! [loï ztracena; autodestrukce zdvojené naquadriové hlavice byla úspìšná, znièeno plno nepøátelskıch lodí; linka ztracena]<br><br></div>";
	
elseif($usorb==0 and $ztratyj<100):
	$kam="lesù";

	echo "<div id='o2' class='infon'>Krátce po vyskoèení z hyperprostoru se naše flotily støetli s masivní pøevahou lodí protivníka! Polovina lodí byla znièena bìhem pokusu obletìt nepøátelské lodì a znièit je z boku… [signál rušen].. ale nweszs… [signál rušen]..<br><br></div>";
	echo "<div id='o3' class='infon'>Zbytek se pokusil o prùlom na vlajkovou loï nepøítele ale ani to se nepodaøilo… nìkteré osádky zaèaly letìt pryè z boje… zbytek se .. [signál rušen]…<br><br></div>";
	echo "<div id='o4' class='infon'>[nouzové voláni na záloním kanálu; 14 hodin po poèátku útoku] .. trosky našich i nepøátelskıch lodí padají atmosférou a zpùsobují svìtelnou šou.. [signál rušen] .. myslím e máme šanci.. [novı signál zachycen o 3 hodiny pozdìji] .. jsme po palbou nepøátelskıch posil! Naše motory, jak inerciální tak hyperprostové jsou znièení! Zbranì tìce ponièené! Štíty drí jen tak tak… [signál rušen].. všechnu energii do štítù…[signál rušen].. boe, vemte ho na ošetøovnu.. [signál rušen].. ihned opuste loï!  [signál ztracen; záloní kanál ztracen]<br><br></div>";

endif;
?>
