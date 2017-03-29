<?php 

session_start();

header ("Content-type: image/png");
//generovani kodu
$potvr_kod=mt_rand(11111,99999);

//vytvoreni session s kodem
$_SESSION["kod"] = $potvr_kod;

//vygenerovani obrazku s kodem
$vyska = 52;
$sirka = 20;
$img = ImageCreate ($vyska, $sirka);
$pozadi_barva = ImageColorAllocate ($img, 0, 0, 0);  // 


$text_barva = ImageColorAllocate ($img, 0, 204, 255);  // ty 3 cisla jsou cisla barev RGB
ImageString ($img, 31, 5, 5, "$potvr_kod", $text_barva);      //obrazek,velikost pismen,osa x a osa y,vygenerovany kod,barva textu

//vypis obrazku
$a=ImagePng ($img);
echo "$a";

?>
