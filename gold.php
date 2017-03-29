<?
mysql_query("SET NAMES cp1250");
require "data_1.php";

		$vys1 = MySQL_Query("SELECT cislo FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);

?>


<div class="help_planety">
<h3>Gold Status o co vlastnì jde?</h3>
Jeliko hra je velmi nároèná donutila nás k zavedení gold statusù,nedìláme to proto ,e bysme na Vás chìli nìak vydìlávat,ale proto aby hra mohla bìet na vlastním serveru a aby se zaplatil její provoz.
Gold status má jisté vıhody ,proti normálnímu statusu,všechny vıhody jsou vypsanı níe.

<h3>Cena:</h3>
Cena je 30 Kè na jeden herní vìk,kterı trvá 30 dní.Tzn. e 1 den hry Vás pøíde na 1kè co je dle nás velmi dobrá cena.
<font class=text_cerveny>PØESNİ POPIS ZASÍLANÍ PENÌZ ZDE NALEZNETE NA ZAÈÁTKU NOVÉHO VÌKU</font>
<i>Ovšem pokud budete chtít pøispìt víc tak není problém,budem jen rádi..</i>
<h2>Zpùsob Platby:</h2>

Zaplatit budete moct bud  pøevodem na úèet(budete si moct zaplatit i  na nìkolik vìkù dopøedu).
<br />
bankovní úèet: <span class="text_cerveny">1799462103/0800</span><br/>
var. symbol prosím uveïte <span class="text_cerveny">vaše gold èíslo</span> "<font class=text_cerveny><? echo $zaznam1[cislo]; ?></font>"<br />
jako úèel platby zadejte gold status/minirasa.


<br /><br />Nebo Poštovní sloenkou.
<a href='http://www.sg-rtg.net/hlavni.php?page=help&sub=jak'>Pøíklad vyplnìné poštovní sloenky typu A</a> 


<br /><br />Nebo pomocí SMS.

<div class="stickie">
Pošlete SMS ve tvaru "<span class="text_cerveny">pay&nbsp;rtg <? echo $zaznam1[cislo]; ?></span>" na èíslo <span class="text_cerveny">9040479</span>.<br />
Cena za odeslání SMS zprávy je <span class="text_cerveny">79 Kè</span> s DPH. Slubu technicky zajišuje <a href="http://pipeline.cz">Pipeline a.s.</a><br />
Reklamace plateb na lince 720 488 319, 9-17 hodin, po-pá.<br />
Kontakt na provozovatele: <a href="mailto:j.puchy@seznam.cz">j.puchy@seznam.cz</a><br />
<font class=text_cerveny>POZOR PRO HRÁÈE ZE SLOVENSKA PLATÍ NÁVOD NÍE</font>.<br />
</div>

<div class="stickie">
Pošlete <span class="text_cerveny">3×</span> SMS ve tvaru "<span class="text_cerveny">pipay rtg <? echo $zaznam1[cislo]; ?></span>" na èíslo 6671.<br />
Cena za odeslání SMS zprávy je 47,60 Ks s DPH.<br />
Slubu technicky zajišuje DIMOCO s.r.o.<br />
Reklamace plateb na lince +420 720 488 319, 9-17 hodin, po-pá.<br />
Kontakt na provozovatele: j.puchy@seznam.cz<br />
<font class=text_cerveny>POZOR PLATÍ PRO HRÁÈE ZE SLOVENSKA</font>.<br />
</div>




<br /><br />

<hr>

<h3>Silver Status o co vlastnì jde?</h3>
Silver status je vlastnì skoro to samé jako Gold pouze v nìkolika vìcech se liší:
<br />
Silver status se narozdíl od Gold platí pomocí sms. Status silver získáte tedy buï za poslání sms, nebo za nìjakou høe prospìšnou vìc. Silver status má oproti Gold menší vıhody a to z toho dùvodu, e z sms kterou zašlete máme asi cca 12Kè... (viz. tabulka níe).

<div class="stickie">
Pošlete SMS ve tvaru "<span class="text_cerveny">pay&nbsp;rtg <? echo $zaznam1[cislo]; ?></span>" na èíslo <span class="text_cerveny">9040450</span>.<br />

Cena za odeslání SMS zprávy je <span class="text_cerveny">50 Kè</span> s DPH. Slubu technicky zajišuje <a href="http://pipeline.cz">Pipeline a.s.</a><br />
Reklamace plateb na lince 720 488 319, 9-17 hodin, po-pá.<br />
Kontakt na provozovatele: <a href="mailto:j.puchy@seznam.cz">j.puchy@seznam.cz</a><br />
<font class=text_cerveny>POZOR PRO HRÁÈE ZE SLOVENSKA PLATÍ NÁVOD NÍE</font>.<br />
</div>

<div class="stickie">
Pošlete <span class="text_cerveny">2×</span> SMS ve tvaru "<span class="text_cerveny">pipay rtg <? echo $zaznam1[cislo]; ?></span>" na èíslo 6671.<br />
Cena za odeslání SMS zprávy je 47,60 Ks s DPH.<br />
Slubu technicky zajišuje DIMOCO s.r.o.<br />
Reklamace plateb na lince +420 720 488 319, 9-17 hodin, po-pá.<br />
Kontakt na provozovatele: j.puchy@seznam.cz<br />
<font class=text_cerveny>POZOR PLATÍ PRO HRÁÈE ZE SLOVENSKA</font>.<br />
</div>

<hr>

<h4>Vıhody Gold hráèe:</h4>
<table class="table" align="center" cellpadding=0 cellspacing=0>
    <tr class="vrsek">
      <th>Èíslo</th>
      <th>Vıhoda</th>
    </tr>
    <tr class="spodek">
      <td class="pole">1</td>
      <td>Zmìna politik kadı den.</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">2</td>
      <td>Poèet všech útokù +25%.</td>
      
    </tr>

    <tr class="spodek">
      <td class="pole">3</td>
      <td>Postavená Banka</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">4</td>
      <td>Nebude se Vám zobrazovat reklama na Aukro</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">5</td>
      <td>Jiná barva</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">6</td>
      <td>Podpoøíte hru</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">7</td>
      <td>+ 10% vydelek </td>
      
  </tr>
    <tr class="spodek">
      <td class="pole">8</td>
      <td>Speciální rasa pouze pro gold háèe.</td>

  </tr>
    <tr class="spodek">
      <td class="pole">9</td>
      <td>Speciální forum pouze pro gold hráèe.</td>

      
    </tr>
    <tr class="spodek">
      <td class="pole">10</td>
      <td>Email nick@sg-rtg.net .</td>
      
    </tr>
</table>


<h4>Vıhody Silver hráèe:</h4>
<table class="table" align="center" cellpadding=0 cellspacing=0>
    <tr class="vrsek">
      <th>Èíslo</th>
      <th>Vıhoda</th>
    </tr>
    <tr class="spodek">
      <td class="pole">1</td>
      <td>Zmìna politik kadı den.</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">2</td>
      <td>Poèet všech útokù +25%.</td>
      
    </tr>

    <tr class="spodek">
      <td class="pole">3</td>
      <td>Postavená Banka</td>
      
    </tr>

    <tr class="spodek">
      <td class="pole">4</td>
      <td>Jiná barva</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">5</td>
      <td>Podpoøíte hru</td>
      
    </tr>
    <tr class="spodek">
      <td class="pole">6</td>
      <td>+ 10% vydelek </td>
      
  </tr>
    <tr class="spodek">
      <td class="pole">7</td>
      <td>Speciální rasa pouze pro gold háèe.</td>

  </tr>
    <tr class="spodek">
      <td class="pole">8</td>
      <td>Speciální forum pouze pro gold hráèe.</td>
      
    </tr>

</table>


<h4>Závìrem</h4>
Rádi bychom Vám všem,kteøí jsi gold status koupí chìli podìkovat a všem pøejeme pøíjemnou a vıpadky nerušenou hru.


</div>
