<?php
require "data_1.php";

$kolikv=4;

$cas_1 = time(00,00,0,06,10,2008); //hodiny,minuty,sekundy,mesic,den,rok
$cas_2 = time();

$d_sec = $cas_2 - $cas_1;
$d_day = floor($d_sec/86400);
$d_sec -= $d_day * 86400;
$d_hrs = floor($d_sec/3600);
$d_sec -= $d_hrs * 3600;
$d_min = floor($d_sec/60);
$d_sec -= $d_min * 60;

$vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
$hhh = mysql_num_rows($vys5);
$vys6 = MySQL_Query("SELECT jmeno FROM online");
$o = mysql_num_rows($vys6);

$h=Date("G");
$m=Date("i");
$s=Date("s");
$sek=Date("U");

$chci=0;

$sek-=$m*60;
$sek-=$s;

$a=$h-$chci;
if($a>0){
    $a-=24;
}

$sek-=$a*3600;
$datum = Date("H:i:s j.m.Y",$sek);

$vys7 = MySQL_Query("SELECT cislo,posl FROM uzivatele where (posl-$sek)>0");
$dnes = mysql_num_rows($vys7);

$vaseipst = $_SERVER['REMOTE_ADDR'];
?><span>Celkem hráčů:</span><?= $hhh ?></span>
                        <span>On Line hráčů:</span><?= $o ?></span>
                        <span>Dnes hráčů:</span><span><?= $dnes ?></span>
