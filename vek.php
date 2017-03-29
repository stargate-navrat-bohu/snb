<?php
 
include "data_1.php";
 
$kolikv="1";
 
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
if($d_day2 < 3){
 
echo "<span class='text_cerveny'>Probíhá ".$kolikv." věk.</span><br>
<span class='text_cerveny'>Restart před ".$d_day." dny</span><br>
<span class='text_cerveny'>Do konce věku zbývá $d_day2 dní</span>";
}
else{
echo "<span>Probíhá ".$kolikv." věk.</span><br>
<span>Restart před ".$d_day." dny</span><br>
<span>Do konce věku zbývá $d_day2 dní</span>";
}
 
?>