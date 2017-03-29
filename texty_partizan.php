<?
			switch ($rasa1){
				case 1: $uvod="Ihned poté co Vrchní velení dostalo od ".$logjmeno." flotilami našimi elitními vojáky byly komanda zmobilizovány! Do pár hodin byly pøipraveny k akci a a naloïovaly se do transportních lodí. Další jednotky èekaly u Hvìzdné brány.";
					break;
				case 2: $uvod="Ihned poté co tvùj první mu dostal od ".$logjmeno."rozkaz ke skrytému Jaffskému útoku se naši Jaffové pøipravili na pozemní boj! Do pár hodin byli pøipraveni k útoku a naloïovaly se do Teltakù . Další jednotky èekaly u Chaapa'ai.";
					break;
				
				case 3: $uvod="Ihned poté co Starší dostali od ".$logjmeno." ádost o klasickı krvavı pìchotní útok na Ovladatelné se zfanatizované skupiny Reetou pøipravily na krvavou a bezhlavou pozemní øe! Do pár hodin byly skupiny pøipraveny k akci a naloïovaly se do transportních lodí . Další skupiny èekaly u Hvìzdné brány";
					break;

				case 4: $uvod="Jakmile naši vojevùdcové v èele s Thorem dostali oznámení k útoku od ".$logjmeno."  byly replikátoøi rychle naprogramováni pro nastávající akci ihned poté byly pøipraveny bojovat za ideály a èest naší rasy. Do pár hodin byly houfy replikátorù nachystané a naloïovaly se do mateøskıch lodí. Další jednotky èekaly u brány";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do transportních kójí v Mateøskıch lodích ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u mocné brány.";
					break;

				case 5: $uvod="Ihned poté co Velení Rádcù dostalo od ".$logjmeno." rozkaz k útoku se oddané jednotky Tok'rù pøipravily na útok. Do pár hodin byli všichni pøipraveni k boji a naloïovaly se do Teltakù. Další jednotky èekaly u Hvìzdné brány. ";
					break;


				case 6: $uvod="Ihned poté co Chulie dostala od Senátora ".$logjmeno."  informace o guerillovém útoku se vznešená elita Security force pøipravila k boji za své ideály. Iontové pušky byly pøipraveny! Do pád hodin se oddíly naloïovaly se do raketoplánù. Další jednotky èekaly u umìlé Hvìzdné brány.";
					break;

				case 7: $uvod="Ihned poté co Konfederaèní vojenské vedení dostalo od ".$logjmeno." rozkaz k mechovému útoku se elitní osádky Mechù zmobilizovaly k boji. Do pád hodin tyto ohromné stroje naloïovány do transportních lodí. Další jednotky èekaly u brány. ";
					break;

				case 9: $uvod="Ihned poté co Nejvyšší generalisimové dostali od ".$logjmeno." informace  o útoku neschopné jednotky davy odvedencù plouivì dostavily na pøehlídku. Do pár hodin byly tisíce vojákù pøipraveny jít na smrt a naloïovaly se do transportních Bombardérù. Další jednotky èekaly u Hvìzdné brány. ";
					break;

				case 8: $uvod="Ihned poté co Diktátor schválil od ".$logjmeno." plán k útoku se fanatické posádky komanda pøipravila k pozemnímu boji, za Neferta! Do pád hodin byly komanda pøipraveny k akci a naloïovaly se do Samoletù. Další jednotky èekaly u brány.";
					break;

				case 10: $uvod="Ihned poté co chemickı bojovníci schválil od ".$logjmeno."   útok na nepøítele se naše hrdé prapory SG èet pøipravily k boji! Do pád hodin byly jednotky pøipraveny k pøepadení nepøátelské planety a zanedlouho se naloïovaly se do Prometheù. Další jednotky èekaly u Hvìzdné brány. ";
					break;

			}
			echo "<div id='pa1' class='infon'>".$uvod."<br><br></div>";
if($us==1 and $ztraty<30):
	$x=20;

	echo "<div id='pa2' class='infon'>Krátce po poèátku útoku zaèaly naše jednotky nepøítele zatlaèovat! Jinde jsme prolomili obranu u jejich velkého mìsta a zastihli nepøítele nepøipravené!<br><br></div>";
	echo "<div id='pa3' class='infon'>Ustupující nepøátelé nám zpùsobují nìjaké škody, ale nejde o nic vıznamného. Z nìkolika ostrovù jsme nepøítele vytlaèili bìhem pár hodin, nìjaké jednotky se uchılily do lesù<br><br></div>";
	echo "<div id='pa4' class='infon'>Ve finální bitvì o jejich kosmodrom jsme prorazili a uletìli k naším lodím, aèkoliv jsme pøišli o další jednotky, ale nepøítel byl sraen. Jeho planeta hoøí, škody námi zpùsobené jsou strašlivé!<br><br></div>";

elseif($us==1 and $ztraty<70):
	$kam="lesy";	

	echo "<div id='pa2' class='infon'>Krátce po poèátku útoku se ukázalo e naše pìchotní skupiny jsou na akci málo pøipravené! Naše ztráty zaèaly narùstat!<br><br></div>";
	echo "<div id='pa3' class='infon'>Pøes poèáteèní tìké ztráty se vaší velitelé uchılily do lesù. Poté jsme napadli vojáky nepøítele zboku skrz lesy a vyplenili mnoho nechránìnıch mìst. Naším dalším cílem je 500km vzdálená pouš, kde nás evakuují lodì, pøedtím ale musíme znièit protivzdušnou…<br><br></div>";
	echo "<div id='pa4' class='infon'>Bitva u stanovištì protivzdušné i pochod k evakuaci z vyplenìné planety zabraly, naše lodì hromadnì pøistávaly a braly nás ze znièené planety, naše ztráty jsou ale hrozivé…<br><br></div>";

elseif($us==1 and $ztraty<100):
	$x=13;
	$x2=20;

	echo "<div id='pa2' class='infon'>Krátce po poèátku útoku byly naši pìšáci zastaveni a obklíèeny vlnami nepøátel! Plno našich jednotek uniklo, jiné byly zabity a další se pod obklíèením bránily v ruinách mìst!<br><br></div>";
	echo "<div id='pa3' class='infon'>Po nìkolika dnech kdy bylo plno našich obklíèenıch jednotek znièeno naši velitelé evakuovali zbylé pìšáky a neèekanì je transportovaly jinam na planetu, tentokrát do vzdálenìjších lesù. Tato pøekvapila nepøítele!Naše elitní pìchotní  skupiny provádìly nìkolik tıdnù záškodnické akce<br><br></div>";
	echo "<div id='pa4' class='infon'>Poté ale velitelé invaze usoudili, e cíl byl splnìn a evakuovali naše pìšáky domù. Tato krvavá bitva vešla ve známost, bude jistì nìkolikrát proslavena v eposech!<br><br></div>";

endif;

if($us==0 and $ztratyj<25):
	echo "<div id='pa2' class='infon'>Krátce po poèátku útoku byly naši pìšáci zastaveni a obklíèeny vlnami nepøátel! Plno našich jednotek uniklo, jiné byly zabity a další se pod obklíèením bránily v ruinách mìst!<br><br></div>";
	echo "<div id='pa3' class='infon'> .. víme jen, e …  padlí … proboha! Bombardují nás! .. [signál rušen]..další útoky … podaøilo se nám objevit obøí stanovištì nepøátel, snaíme se je zastihnout nepøipravené a… [signál rušen]… byli jsme zastaveni a obklíè…[signál rušen]<br><br></div>";
	echo "<div id='pa4' class='infon'>[nouzové voláni; dva tıdny po poèátku útoku] … jsme v obleení, je nás u jen nìkolik, nepøátelé nemají skoro ádné padlé, … teï to vypadá e nìco montují nedaleko, moná e je to zbraò, ale nejsem si jis…[bùùùm!! ] … medik! …[bùùùm!! ] … [signál ztracen; kanál ztracen]<br><br></div>";

elseif($us==0 and $ztratyj<50):
	echo "<div id='pa2' class='infon'>Krátce po poèátku útoku byly naši pìšáci zastaveni a obklíèeny vlnami nepøátel! Plno našich jednotek uniklo, jiné byly zabity a další se pod obklíèením bránily v ruinách mìst!<br><br></div>";
	echo "<div id='pa3' class='infon'>Naše obklíèené jednotky ustoupily do opuštìné pevnosti Helm..[signál rušen].., kde jsme se zakopali. Pøesila nepøátel sem míøících je velká, prozatím nepomıšlíme ani na splnìní úkolù, ani na evakuaci, … naše lodì jsou na orbitì odøíznuty protivzdušnou…<br><br></div>";
	echo "<div id='pa4' class='infon'>[nouzové voláni; 11 dní po poèátku útoku] .. pevnost je skoro dobyta, nepøítel hlídkuje v oblasti letadly… teï pøichází další útok, boe, my to nezvládnem..[signál rušen]… útok jsme pøestáli, ale na další nemáme národ … pøichází další silnı útok, to nedáme…[signál ztracen; kanál ztracen]<br><br></div>";
	
elseif($us==0 and $ztratyj<100):
	$kam="lesù";

	echo "<div id='pa2' class='infon'>Krátce po poèátku útoku zaèaly naše jednotky nepøítele zatlaèovat! Jinde jsme prolomili obranu u jejich velkého mìsta a zastihli nepøítele nepøipravené!<br><br></div>";
	echo "<div id='pa3' class='infon'>[signál zachycen o 5 dní pozdìji; záloní kanál] byla to past! To velkomìsto bylo plné vıbušnin, obklíèeno masami vojákù, jsme uprostøed toho mìsta obklíèeni…..[signál rušen].. naše situace je zlá, zastavili jsme zbìsilı postup nepøátel a zpùsobili jim velké škody na pìchotì, ale další nápor nezastavíme ..[signál rušen]..,  <br><br></div>";
	echo "<div id='pa4' class='infon'>[signál zachycen o 2 dny pozdìji]… Krvává øe uprostøed totálnì znièeného mìsta, tak to tady vypadá, my nemáme šanci se vrátit, pozdravujte naše rodiny ..[signál ztracen]<br><br></div>";

endif;
?>
