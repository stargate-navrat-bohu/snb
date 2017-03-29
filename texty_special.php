<?
			switch ($rasa1){
				case 1: $uvod="Strategické velení dostalo rozkaz k vyslání raket od ".$logjmeno." na nepøátelskou planetu!";
					if($brana==0){$uvod.=" Sila se otevøela a mezihvìzdné nosièe bomb odstartovaly";}
					else{$uvod.=" Naše mobilní bomby vjíždìjí do Hvìzdné brány…. ";}
					break;
				case 2: $uvod="Tvùj první muž vyslal na tvùj rozkaz ".$logjmeno." ke startu otrokáøské lodì! Lodì již vstoupily do hyperprostoru…";
					break;
				
				case 5: $uvod="Tok'erský Rádce pro zbranì hromadného nièení si pøipravil na tvùj rozkaz, ".$logjmeno.", své síly seizmických bomb";
					if($brana==0){$uvod.=" Bomby již stoupily do hyperprostoru…";}
					else{$uvod.=" Bomby již èekají pøed bránou…  ";}
					break;

				case 4: $uvod="Jakmile naši vojevùdcové v èele s Thorem dostali oznámení k útoku od ".$logjmeno."  byly vìdci rozrušení a rychle pøipravily støely naložené Ragnaroku!";
					$uvod.=" Brzy tyto støely již na palubách mateøských lodí míøily k cíli… ";
					break;

				case 3: $uvod="Ihned poté co Starší dostali od  ".$logjmeno." žádost o útok chemickými zbranìmi se piloti pomalých a køehkých lodí pøipravili na poslední let. Mají dopravit zbranì až na místo a narazit do zemì a aby tak uvolnily smrtící plyny. A lodì již odstartovaly…";
					break;


				case 6: $uvod="Ihned poté co Chulie dostala od Senátora ".$logjmeno."  informace o palbì skrz otevøenou bránu pomocí urychlovaèù èástic se inženýøi pøipravili na akci…  urychlovaèe již èekají u brány…";
					break;

				case 7: $uvod="Ihned poté co Konfederaèní vojenské vedení dostalo od ".$logjmeno." rozkaz k vystøelení biologické zbranì na cílovou planetu zavládlo vzrušení.  ";
					if($brana==0){$uvod.=" Brzy nato již pumy míøily na palubì Gunshipù na cíl…";}
					else{$uvod.=" Brzy nato již u brány èekal jeden Harvester házející pumy do otevøené brány…";}
					break;

				case 9: $uvod="Ihned poté co Nejvyšší generalisimové dostali od ".$logjmeno." informace  o útoku se nebojácní piloti kamikadze bomber pøipravili na smrt!";
					if($brana==0){$uvod.=" Vìrni ideálùm již letí na cíl hyperprostorem! ";}
					else{$uvod.=" Vìrni ideálùm již prolétají otevøenou branou na cíl… ";}
					break;

				case 8: $uvod="Ihned poté co Diktátor schválil od ".$logjmeno." plán k útoku se fanatiètí údržbáøi elektrických bomb již chystali na jejich vypouštìní na cíl  ";
					if($brana==0){$uvod.=" A nyní? Bomby již letí! ";}
					else{$uvod.="Bomby již stojí pøed bránou!. ";}
					break;

				case 10: $uvod="Ihned poté co F/A-302 Jerrymouse schválil od ".$logjmeno."  útok na nepøítele se osádky lodí Travala pøipravily na skok k cílové planetì, kde mají vypustit atomové bomby! A skok již probíhá!";
					break;

			}
			echo "<div id='s1' class='infon'>".$uvod."<br><br></div>";
if($us==1 and $brana==0):
	$x=20;

	echo "<div id='s2' class='infon'>Naše zbranì jsou nad cílovou planetou! Nepøítel je zamìøil! Zbranì vstoupily do atmosféry a …<br><br></div>";
	echo "<div id='s3' class='infon'>… prolétají! Dopadají na povrch a zabíjejí a nièí. Nyní je již èas na oslavy!</div>";
	
elseif($us==1 and $brana==1):
	echo "<div id='s2' class='infon'>Naše zbranì právì vystoupili u cíle z brány. Ostraha je minimální, Iris nikde! Nepøítel je zaskoèen, ale již detekuji .. impulsy SDI! Co bude dále…<br><br></div>";
	echo "<div id='s3' class='infon'… SDI na nás nestaèila. Zbranì nièí cíle! Nyní je již èas na oslavy!</div>";

endif;
	
if($us==0 and $brana=0):
	echo "<div id='s2' class='infon'>Naše zbranì jsou nad cílovou planetou! Nepøítel je zamìøil! Zbranì vstoupily do atmosféry a …<br><br></div>";
	echo "<div id='s3' class='infon'>… jedna za druhou jsou nièeny SDI! Ani jedna nedokáže dopadnout… útok se nezdaøil</div>";

elseif($us==0 and $brana=1):
	echo "<div id='s2' class='infon'>Naše zbranì právì vystoupili u cíle z brány. Ostraha je silná, Iris dlouho zùstává neproražena! Poté se to zdaøí, Iris je znièena, ale nepøítel není zaskoèen, již detekuji .. impulsy SDI! Co bude dále…<br><br></div>";
	echo "<div id='s3' class='infon'>… SDI nièí jednu zbraò za druhou, ani jedna neznièila cíl… útok se nezdaøil</div>";
endif;	
?>
