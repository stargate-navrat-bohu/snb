<?php

include 'data_1.php';

$kolikv = '1';

$cas_1 = time(0,0,0,07,14,2008); //hodiny,minuty,sekundy,mesic,den,rok
$cas_2 = time();

$d_sec = $cas_2 - $cas_1;
$d_day = floor($d_sec/86400);
$d_sec -= $d_day * 86400;
$d_hrs = floor($d_sec/3600);
$d_sec -= $d_hrs * 3600;
$d_min = floor($d_sec/60);
$d_sec -= $d_min * 60;

$d_day2 = 60 - $d_day;

$css_cls = 'text_cerveny';

if($d_day2 < 3) {
    $css_cls = 'text_cerveny';
}
?>
<span class="<?= $css_cls ?>">Probíhá <?= $kolikv ?> věk.</span><br>
<span class="<?= $css_cls ?>">Restart před <?= $d_day ?> dny.</span><br>
<span class="<?= $css_cls ?>">Do konce věku zbývá <?= $d_day2 ?> dní.</span>
