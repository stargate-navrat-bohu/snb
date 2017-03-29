<?
			switch ($rasa1){
				case 1: $uvod="Ihned poté co Vrchní velení dostalo od ".$logjmeno." rozkaz k útoku,";
					if($tu1>0){$uvod.=" SG týmy";};
					if($tu2>0){$uvod.=" mechanizované SG týmy";};
					if($tu4>0){$uvod.=" lodì typu X303";};
					$uvod.=" byly mobilizovány. Do pár hodin byly jednotky pøipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do transportních raketoplánù ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u brány v komplexech SGC základen.";
					break;
				case 2: $uvod="Ihned poté co tvùj první muž dostal od ".$logjmeno." rozkaz k útoku, se oddíly ,";
					if($tu1>0){$uvod.=" Jaffù";};
					if($tu2>0){$uvod.=" Kluzákù";};
					if($tu4>0){$uvod.=" Hatackù";};
					$uvod.=" pøipravily na øež! Do pár hodin byly naši hrdinní bojovníci  pøipraveni k útoku a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do Teltakù ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další bojovníci èekali u Chaapa'ai.";
					break;
				
				case 3: $uvod="Ihned poté co Starší dostali od ".$logjmeno." žádost o útok na Ovladatelné se zfanatizované ,";
					if($tu1>0){$uvod.=" Skupinky Reetou";};
					if($tu2>0){$uvod.=" Teroristé";};
					if($tu4>0){$uvod.=" Cyborgové";};
					$uvod.=" pøipravily na krvavou a bezhlavou øež! Do pár hodin byly oddíly pøipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do neviditelných transportních lod ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u brány.";
					break;

				case 4: $uvod="Jakmile naši vojevùdcové v èele s Thorem dostali oznámení k úroku od ".$logjmeno."  byly jednotky Asgardù o ,";
					if($tu1>0){$uvod.=" Ochoèených replikátorech ";};
					if($tu2>0){$uvod.=" Jormundech";};
					if($tu4>0){$uvod.=" nejlepších lodích galaxie";};
					$uvod.=" pøipraveny bojovat za ideály a èest jejich rasy. Do pár hodin byly jednotky pøipraveny k útoku a  ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do transportních kójí v Mateøských lodích ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u mocné brány.";
					break;

				case 5: $uvod="Ihned poté co Velení Rádcù dostalo od ".$logjmeno." rozkaz k útoku se oddaní ,";
					if($tu1>0){$uvod.=" Skupinky Tok'rù ";};
					if($tu2>0){$uvod.=" Seizmických bomb";};
					if($tu4>0){$uvod.=" Bombardovacích Teltakù";};
					$uvod.=" byly mobilizovány. zmobilizovány. Do pár hodin byly oddíly pøipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do Teltakù ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u Hvìzdné brány. ";
					break;


				case 6: $uvod="Ihned poté co Chulie dostala od Senátora ".$logjmeno."  informace o útoku se vznešené  ,";
					if($tu1>0){$uvod.=" Security force ";};
					if($tu2>0){$uvod.=" Iontové dìla ";};
					if($tu4>0){$uvod.=" Fregaty";};
					$uvod.=" pøipravily k boji za své ideály. Do pád hodin byly oddíly pøipraveny pøed kasárnami k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do Carrierù ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u umìle vytvoøené Hvìzdné brány.";
					break;

				case 7: $uvod="Ihned poté co Konfederaèní vojenské vedení dostalo od ".$logjmeno." rozkaz k útoku se elitní jednotky ";
					if($tu1>0){$uvod.=" Mechù ";};
					if($tu2>0){$uvod.=" Gunshipù ";};
					if($tu4>0){$uvod.=" Harvesterù ";};
					$uvod.=" zmobilizovány k boji. Do pád hodin byly oddíly pøipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do transportních lodí ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u a v Harvesterech u Hvìzdné brány.";
					break;

				case 9: $uvod="Ihned poté co Nejvyšší generalisimové dostali od ".$logjmeno." informace  o útoku se neschopné jednotky ";
					if($tu1>0){$uvod.=" Odvedencù ";};
					if($tu2>0){$uvod.=" Bombardérù ";};
					if($tu4>0){$uvod.=" Chemických bojovníkù ";};
					$uvod.=" vyploužily ze smradlavých kasáren. Do pád hodin byly armády pøipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do Transportních bombardérù ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly v podzemních základnách u Hvìzdné brány.";
					break;

				case 8: $uvod="Ihned poté co Diktátor schválil od ".$logjmeno." plán k útoku se fanatické  ";
					if($tu1>0){$uvod.=" Komanda ";};
					if($tu2>0){$uvod.=" Artilerie ";};
					if($tu4>0){$uvod.=" Samolety ";};
					$uvod.=" pøipravily k boji za Neferta! Do pád hodin byly oddíly pøipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do Transportních Samoletù ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u Hvìzdné brány.";
					break;

				case 10: $uvod="Ihned poté co Vùdce odboje schválil od ".$logjmeno."  útok na nepøítele se naše hrdé jednotky ";
					if($tu1>0){$uvod.=" SG èet ";};
					if($tu2>0){$uvod.=" F/A-302 Jerrymouse ";};
					if($tu4>0){$uvod.=" BC-303 Prometheus2  ";};
					$uvod.=" pøipravily k boji! Do pád hodin byly jednotky pøipraveny k akci a ";
					if($tu1>0 or $tu2>0){$uvod.=" naloïovaly se do Transportních lodí ";};
					if($tu4>0){$uvod.=" letìly k cílové planetì. ";};
					$uvod.=".Další jednotky èekaly u Hvìzdné brány.";
					break;

			}
			echo "<div id='p1' class='infon'>".$uvod."<br><br></div>";
if($uspoz==1 and $ztraty<30):
	$x=20;

	echo "<div id='p2' class='infon'>Krátce po poèátku útoku zaèaly naše jednotky nepøítele zatlaèovat! Jinde jsme prolomili obranu u jejich velké vojenské základny a zastihli nepøítele nepøipravené!<br><br></div>";
	echo "<div id='p3' class='infon'>Ustupující nepøátelé nám zpùsobují nìjaké škody, ale nejde o nic významného. Z nìkolika kontinentù jsme nepøítele vytlaèili bìhem ".$x." dnù, nyní zbývá pouze jejich poslední základna!<br><br></div>";
	echo "<div id='p4' class='infon'>Ve finální bitvì o jejich poslední bázi jsme pøišli o další jednotky, ale nepøítel byl poražen. Nìkolik jeho lodí ale z obsazené planety uniklo!<br><br></div>";

elseif($uspoz==1 and $ztraty<70):
	$kam="lesy";	

	echo "<div id='p2' class='infon'>Krátce po poèátku útoku se ukázalo že naše jednotky jsou na akci málo pøipravené! Naše ztráty zaèaly narùstat!<br><br></div>";
	echo "<div id='p3' class='infon'>Pøes poèáteèní tìžké ztráty vaši velitelé napadli armádami nepøítele zboku skrz ".$kam." a obsadily mnoho nechránìných mìst. Obklíèili nepøítele a spustili køížovou palbu!<br><br></div>";
	echo "<div id='p4' class='infon'>Obklíèené armády se pokusily neúspìšnì o protiútok, ale neuspìly a rozbily se o naši obranu. Poté se zoufalé a demoralizované jednotky nepøítele pokusily uniknout a naneštìstí se to nìkolika z nich podaøilo…<br><br></div>";

elseif($uspoz==1 and $ztraty<100):
	$x=13;
	$x2=20;

	echo "<div id='p2' class='infon'>Krátce po poèátku útoku byly naše jednotky zastaveny a obklíèeny vlnami nepøátel! Plno našich jednotek uniklo, jiné byly zabity a další se pod obklíèením bránily v ruinách mìst!<br><br></div>";
	echo "<div id='p3' class='infon'>Po ".$x." dnech když bylo plno našich obklíèených jednotek znièeno naši velitelé provedli druhou invazi, tentokrát na druhou polokouli. Pøekvapení obránci spìchali na druhou polokouli zatímco my jsme se zabarikádovali v mìstech druhé polokoule! <br><br></div>";
	echo "<div id='p4' class='infon'>Bitva o tyto mìsta byla mimoøádnì krvavá a zmasakrovala plno civilistù. Mìsta byla poboøena a naše i cizí jednotky utrpìly katastrofální ztráty! Plno životù bylo zmaøeno, ale po ".$x2." dnech je planeta ".$naco." naše!<br><br></div>";

endif;

if($uspoz==0 and $ztratyj<25):
	echo "<div id='p2' class='infon'>Jakmile zaèal útok naše jednotky se ocitly pod strašlivou palbou! Velitel tøetí skupiny jednotek se snaží o protiútok ze severu .. xYwoeueXoejwgdt .. [signál rušen] .. máme tìžké ztráty .. [signál rušen]<br><br></div>";
	echo "<div id='p3' class='infon'> .. víme jen, že …  padlí … proboha! Transportéry jsou sestøelovány!! Musíme evakuv… [signál ztracen]… … tady je záložní váleèný reportér, ten pùvodní byl zabit, situace je taková že … [signál rušen]<br><br></div>";
	echo "<div id='p4' class='infon'>[nouzové voláni na záložním kanálu; týden po poèátku útoku] … naše poslední jednotky se uchýlily na kopec asi 130 kilometrù od místa znièení páté armády … [signál rušen].. je nás pøíliš málo, jejich útok se nedá zastavit .. pomó.. [signál ztracen; záložní kanál ztracen]<br><br></div>";

elseif($uspoz==0 and $ztratyj<50):
	echo "<div id='p2' class='infon'>Krátce po zahájení útoku se naše armády støetli s masivní pøevahou protivníka! Polovina jednotek byla znièena bìhem pokusu obsadit velkomìsto [signál rušen], které je významným industriálním centrem..<br><br></div>";
	echo "<div id='p3' class='infon'>Jižní armády byly nuceny ustoupit do rokliny [signál rušen] .. zde se naše jednotky zakopaly a byly pøipraveny na obranu, zdá se že [signál ztracen; kanál ztracen]<br><br></div>";
	echo "<div id='p4' class='infon'>[nouzové voláni na záložním kanálu; 18 dní po poèátku útoku] .. rokle je plná trosek a mrtvých, jak našich tak nepøátel. Všude je plno [signál rušen] .. myslím že máme šanci.. [nový signál zachycen o 3 dny pozdìji] .. jsme po palbou pøeživších nepøátel! Dostaòte nás odsud! To je [signál ztracen; záložní kanál ztracen]<br><br></div>";
	
elseif($uspoz==0 and $ztratyj<100):
	$kam="lesù";

	echo "<div id='p2' class='infon'>Brzy po zaèátku útoku bylo plno jednotek znièeno, nepøátel ale není tolik jak jsme pøedpokládali! Snad to bude snadná akc…[signál ztracen; primární kanál znièen]<br><br></div>";
	echo "<div id='p3' class='infon'>[signál zachycen o 8 dní pozdìji; záložní kanál] … protiútok na nás byl pøíliš drtivý, ale snad to zvládneme! Nyní obklièuje nepøítele v pøístavním mìstì [signál rušen], kde chceme oslabit jeho vojska! … Co to je! Jsme pod palbou!! [signál ztracen; sekundární kanál ztracen]<br><br></div>";
	echo "<div id='p4' class='infon'>[signál zachycen o 4 dny pozdìji; poslední záložní kanál]… Byli jsme zatlaèeni do ".$kam." , ale pouze za cenu jejich tìžkých ztrát! Snažíme se odtud dostat. Kurva, zaèali znova útoèit! Je jich pøíliš mnoho!... [signál ztracen; poslední záložní kanál ztracen]…<br><br></div>";

endif;
?>
