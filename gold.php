<?
mysql_query("SET NAMES cp1250");
require "data_1.php";

		$vys1 = MySQL_Query("SELECT cislo FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);

?>


<div class="help_planety">
<h3>Gold Status o co vlastn� jde?</h3>
Jeliko� hra je velmi n�ro�n� donutila n�s k zaveden� gold status�,ned�l�me to proto ,�e bysme na V�s ch�li n�ak vyd�l�vat,ale proto aby hra mohla b�et na vlastn�m serveru a aby se zaplatil jej� provoz.
Gold status m� jist� v�hody ,proti norm�ln�mu statusu,v�echny v�hody jsou vypsan� n�e.

<h3>Cena:</h3>
Cena je 30 K� na jeden hern� v�k,kter� trv� 30 dn�.Tzn. �e 1 den hry V�s p��de na 1k� co� je dle n�s velmi dobr� cena.
<font class=text_cerveny>P�ESN� POPIS ZAS�LAN� PEN�Z ZDE NALEZNETE NA ZA��TKU NOV�HO V�KU</font>
<i>Ov�em pokud budete cht�t p�isp�t v�c tak nen� probl�m,budem jen r�di..</i>
<h2>Zp�sob Platby:</h2>

Zaplatit budete moct bud  p�evodem na ��et(budete si moct zaplatit i  na n�kolik v�k� dop�edu).
<br />
bankovn� ��et: <span class="text_cerveny">1799462103/0800</span><br/>
var. symbol pros�m uve�te <span class="text_cerveny">va�e gold ��slo</span> "<font class=text_cerveny><? echo $zaznam1[cislo]; ?></font>"<br />
jako ��el platby zadejte gold status/minirasa.


<br /><br />Nebo Po�tovn� slo�enkou.
<a href='http://www.sg-rtg.net/hlavni.php?page=help&sub=jak'>P��klad vypln�n� po�tovn� slo�enky typu A</a> 


<br /><br />Nebo pomoc� SMS.

<div class="stickie">
Po�lete SMS ve tvaru "<span class="text_cerveny">pay&nbsp;rtg <? echo $zaznam1[cislo]; ?></span>" na ��slo <span class="text_cerveny">9040479</span>.<br />
Cena za odesl�n� SMS zpr�vy je <span class="text_cerveny">79 K�</span> s DPH. Slu�bu technicky zaji��uje <a href="http://pipeline.cz">Pipeline a.s.</a><br />
Reklamace plateb na lince 720 488 319, 9-17 hodin, po-p�.<br />
Kontakt na provozovatele: <a href="mailto:j.puchy@seznam.cz">j.puchy@seznam.cz</a><br />
<font class=text_cerveny>POZOR PRO HR��E ZE SLOVENSKA PLAT� N�VOD N͎E</font>.<br />
</div>

<div class="stickie">
Po�lete <span class="text_cerveny">3�</span> SMS ve tvaru "<span class="text_cerveny">pipay rtg <? echo $zaznam1[cislo]; ?></span>" na ��slo 6671.<br />
Cena za odesl�n� SMS zpr�vy je 47,60 Ks s DPH.<br />
Slu�bu technicky zaji��uje DIMOCO s.r.o.<br />
Reklamace plateb na lince +420 720 488 319, 9-17 hodin, po-p�.<br />
Kontakt na provozovatele: j.puchy@seznam.cz<br />
<font class=text_cerveny>POZOR PLAT� PRO HR��E ZE SLOVENSKA</font>.<br />
</div>




<br /><br />

<hr>

<h3>Silver Status o co vlastn� jde?</h3>
Silver status je vlastn� skoro to sam� jako Gold pouze v n�kolika v�cech se li��:
<br />
Silver status se narozd�l od Gold plat� pomoc� sms. Status silver z�sk�te tedy bu� za posl�n� sms, nebo za n�jakou h�e prosp�nou v�c. Silver status m� oproti Gold men�� v�hody a to z toho d�vodu, �e z sms kterou za�lete m�me asi cca 12K�... (viz. tabulka n�e).

<div class="stickie">
Po�lete SMS ve tvaru "<span class="text_cerveny">pay&nbsp;rtg <? echo $zaznam1[cislo]; ?></span>" na ��slo <span class="text_cerveny">9040450</span>.<br />

Cena za odesl�n� SMS zpr�vy je <span class="text_cerveny">50 K�</span> s DPH. Slu�bu technicky zaji��uje <a href="http://pipeline.cz">Pipeline a.s.</a><br />
Reklamace plateb na lince 720 488 319, 9-17 hodin, po-p�.<br />
Kontakt na provozovatele: <a href="mailto:j.puchy@seznam.cz">j.puchy@seznam.cz</a><br />
<font class=text_cerveny>POZOR PRO HR��E ZE SLOVENSKA PLAT� N�VOD N͎E</font>.<br />
</div>

<div class="stickie">
Po�lete <span class="text_cerveny">2�</span> SMS ve tvaru "<span class="text_cerveny">pipay rtg <? echo $zaznam1[cislo]; ?></span>" na ��slo 6671.<br />
Cena za odesl�n� SMS zpr�vy je 47,60 Ks s DPH.<br />
Slu�bu technicky zaji��uje DIMOCO s.r.o.<br />
Reklamace plateb na lince +420 720 488 319, 9-17 hodin, po-p�.<br />
Kontakt na provozovatele: j.puchy@seznam.cz<br />
<font class=text_cerveny>POZOR PLAT� PRO HR��E ZE SLOVENSKA</font>.<br />
</div>

<hr>

<h4>V�hody Gold hr��e:</h4>
<table class="table" align="center" cellpadding=0 cellspacing=0>
    <tr class="vrsek">
      <th>��slo</th>
      <th>V�hoda</th>
    </tr>
    <tr class="spodek">
      <td class="pole">1</td>
      <td>Zm�na politik ka�d� den.</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">2</td>
      <td>Po�et v�ech �tok� +25%.</td>
      
    </tr>

    <tr class="spodek">
      <td class="pole">3</td>
      <td>Postaven� Banka</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">4</td>
      <td>Nebude se V�m zobrazovat reklama na Aukro</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">5</td>
      <td>Jin� barva</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">6</td>
      <td>Podpo��te hru</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">7</td>
      <td>+ 10% vydelek </td>
      
  </tr>
    <tr class="spodek">
      <td class="pole">8</td>
      <td>Speci�ln� rasa pouze pro gold h��e.</td>

  </tr>
    <tr class="spodek">
      <td class="pole">9</td>
      <td>Speci�ln� forum pouze pro gold hr��e.</td>

      
    </tr>
    <tr class="spodek">
      <td class="pole">10</td>
      <td>Email nick@sg-rtg.net .</td>
      
    </tr>
</table>


<h4>V�hody Silver hr��e:</h4>
<table class="table" align="center" cellpadding=0 cellspacing=0>
    <tr class="vrsek">
      <th>��slo</th>
      <th>V�hoda</th>
    </tr>
    <tr class="spodek">
      <td class="pole">1</td>
      <td>Zm�na politik ka�d� den.</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">2</td>
      <td>Po�et v�ech �tok� +25%.</td>
      
    </tr>

    <tr class="spodek">
      <td class="pole">3</td>
      <td>Postaven� Banka</td>
      
    </tr>

    <tr class="spodek">
      <td class="pole">4</td>
      <td>Jin� barva</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">5</td>
      <td>Podpo��te hru</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">6</td>
      <td>+ 10% vydelek </td>
      
  </tr>
    <tr class="spodek">
      <td class="pole">7</td>
      <td>Speci�ln� rasa pouze pro gold h��e.</td>

  </tr>
    <tr class="spodek">
      <td class="pole">8</td>
      <td>Speci�ln� forum pouze pro gold hr��e.</td>
      
    </tr>

</table>


<h4>Z�v�rem</h4>
R�di bychom V�m v�em,kte�� jsi gold status koup� ch�li pod�kovat a v�em p�ejeme p��jemnou a v�padky neru�enou hru.


</div>
