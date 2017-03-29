<?php
mysql_query("SET NAMES cp1250");
//	1)	ulozte si na svuj PHP hosting tento soubor
//	2)	na serveru pipay.cz nasmerujte svou platebni branu na presnou URL tohoto souboru
//	3)	poslete si SMSku a jeji text naleznete v souboru log.txt hned vedle

//	if (getenv(REMOTE_ADDR) != '87.236.196.249') {	//kontola opravnenosti pristupu
//		echo "access denied";
//		exit;
//	}


  require('data_1.php');

$textt=$text;
$debugg=$debug;
$datum=Date("U");


if($price==20){

  $sql = "insert into platby_o values ('$textt', '$price', '$datum')";
  $result = mysql_query($sql);


	echo "Dekujeme, Vase odpoved byla vporadku zpracovana.";  

}



if($price==47.60){

  $sql = "insert into platby_o values ('$textt', '$price', '$datum')";
  $result = mysql_query($sql);


	echo "Dekujeme, Vase odpoved byla vporadku zpracovana.";

}




?>