<?
			switch ($rasa1){
				case 1: $uvod="Strategick� velen� dostalo rozkaz k vysl�n� raket od ".$logjmeno." na nep��telskou planetu!";
					if($brana==0){$uvod.=" Sila se otev�ela a mezihv�zdn� nosi�e bomb odstartovaly";}
					else{$uvod.=" Na�e mobiln� bomby vj�d�j� do Hv�zdn� br�ny�. ";}
					break;
				case 2: $uvod="Tv�j prvn� mu� vyslal na tv�j rozkaz ".$logjmeno." ke startu otrok��sk� lod�! Lod� ji� vstoupily do hyperprostoru�";
					break;
				
				case 5: $uvod="Tok'ersk� R�dce pro zbran� hromadn�ho ni�en� si p�ipravil na tv�j rozkaz, ".$logjmeno.", sv� s�ly seizmick�ch bomb";
					if($brana==0){$uvod.=" Bomby ji� stoupily do hyperprostoru�";}
					else{$uvod.=" Bomby ji� �ekaj� p�ed br�nou�  ";}
					break;

				case 4: $uvod="Jakmile na�i vojev�dcov� v �ele s Thorem dostali ozn�men� k �toku od ".$logjmeno."  byly v�dci rozru�en� a rychle p�ipravily st�ely nalo�en� Ragnaroku!";
					$uvod.=" Brzy tyto st�ely ji� na palub�ch mate�sk�ch lod� m��ily k c�li� ";
					break;

				case 3: $uvod="Ihned pot� co Star�� dostali od  ".$logjmeno." ��dost o �tok chemick�mi zbran�mi se piloti pomal�ch a k�ehk�ch lod� p�ipravili na posledn� let. Maj� dopravit zbran� a� na m�sto a narazit do zem� a aby tak uvolnily smrt�c� plyny. A lod� ji� odstartovaly�";
					break;


				case 6: $uvod="Ihned pot� co Chulie dostala od Sen�tora ".$logjmeno."  informace o palb� skrz otev�enou br�nu pomoc� urychlova�� ��stic se in�en��i p�ipravili na akci�  urychlova�e ji� �ekaj� u br�ny�";
					break;

				case 7: $uvod="Ihned pot� co Konfedera�n� vojensk� veden� dostalo od ".$logjmeno." rozkaz k vyst�elen� biologick� zbran� na c�lovou planetu zavl�dlo vzru�en�.  ";
					if($brana==0){$uvod.=" Brzy nato ji� pumy m��ily na palub� Gunship� na c�l�";}
					else{$uvod.=" Brzy nato ji� u br�ny �ekal jeden Harvester h�zej�c� pumy do otev�en� br�ny�";}
					break;

				case 9: $uvod="Ihned pot� co Nejvy��� generalisimov� dostali od ".$logjmeno." informace  o �toku se neboj�cn� piloti kamikadze bomber p�ipravili na smrt!";
					if($brana==0){$uvod.=" V�rni ide�l�m ji� let� na c�l hyperprostorem! ";}
					else{$uvod.=" V�rni ide�l�m ji� prol�taj� otev�enou branou na c�l� ";}
					break;

				case 8: $uvod="Ihned pot� co Dikt�tor schv�lil od ".$logjmeno." pl�n k �toku se fanati�t� �dr�b��i elektrick�ch bomb ji� chystali na jejich vypou�t�n� na c�l  ";
					if($brana==0){$uvod.=" A nyn�? Bomby ji� let�! ";}
					else{$uvod.="Bomby ji� stoj� p�ed br�nou!. ";}
					break;

				case 10: $uvod="Ihned pot� co F/A-302 Jerrymouse schv�lil od ".$logjmeno."  �tok na nep��tele se os�dky lod� Travala p�ipravily na skok k c�lov� planet�, kde maj� vypustit atomov� bomby! A skok ji� prob�h�!";
					break;

			}
			echo "<div id='s1' class='infon'>".$uvod."<br><br></div>";
if($us==1 and $brana==0):
	$x=20;

	echo "<div id='s2' class='infon'>Na�e zbran� jsou nad c�lovou planetou! Nep��tel je zam��il! Zbran� vstoupily do atmosf�ry a �<br><br></div>";
	echo "<div id='s3' class='infon'>� prol�taj�! Dopadaj� na povrch a zab�jej� a ni��. Nyn� je ji� �as na oslavy!</div>";
	
elseif($us==1 and $brana==1):
	echo "<div id='s2' class='infon'>Na�e zbran� pr�v� vystoupili u c�le z br�ny. Ostraha je minim�ln�, Iris nikde! Nep��tel je zasko�en, ale ji� detekuji .. impulsy SDI! Co bude d�le�<br><br></div>";
	echo "<div id='s3' class='infon'� SDI na n�s nesta�ila. Zbran� ni�� c�le! Nyn� je ji� �as na oslavy!</div>";

endif;
	
if($us==0 and $brana=0):
	echo "<div id='s2' class='infon'>Na�e zbran� jsou nad c�lovou planetou! Nep��tel je zam��il! Zbran� vstoupily do atmosf�ry a �<br><br></div>";
	echo "<div id='s3' class='infon'>� jedna za druhou jsou ni�eny SDI! Ani jedna nedok�e dopadnout� �tok se nezda�il</div>";

elseif($us==0 and $brana=1):
	echo "<div id='s2' class='infon'>Na�e zbran� pr�v� vystoupili u c�le z br�ny. Ostraha je siln�, Iris dlouho z�st�v� neprora�ena! Pot� se to zda��, Iris je zni�ena, ale nep��tel nen� zasko�en, ji� detekuji .. impulsy SDI! Co bude d�le�<br><br></div>";
	echo "<div id='s3' class='infon'>� SDI ni�� jednu zbra� za druhou, ani jedna nezni�ila c�l� �tok se nezda�il</div>";
endif;	
?>
