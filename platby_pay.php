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


if($price==10){

  $sql = "insert into platby values ('$textt', '$price', '$datum')";
  $result = mysql_query($sql);

	echo "Dekujeme, Vase platba byla vporadku zpracovana.";  

}

if($price==20){

  $sql = "insert into platby values ('$textt', '$price', '$datum')";
  $result = mysql_query($sql);


		$hhr2 = MySQL_Query("select cislo,hrdinove from servis where cislo=1");
		$hhr = MySQL_Fetch_Array($hhr2);	
		$hhr0 = MySQL_Query("select jmeno from uzivatele where cislo=$textt");
		$hhr_1 = MySQL_Fetch_Array($hhr0);		
		$hrdinove=$hhr[hrdinove];
		$texttt="Popis není";
		$den = Date("U");
		$vek=Date("U")-(3600*24*20*12);
		$hjmeno=" ".$hhr_1[jmeno]." hrdina";
		$htyp=4;
		
		MySQL_Query("insert into hrdinove (cislo,cislomaj,zivot,status,rasa,text,obr,jmeno,typ,level,zkus) values ('$hrdinove',$textt,'$vek',0,'$hrasa','$texttt','$hobr','$hjmeno','$htyp',20,400000)");


				
		$hrdinove+=1;
		MySQL_Query("update servis set hrdinove='$hrdinove' where cislo=1");



	echo "Dekujeme, Vase platba byla vporadku zpracovana.";  

}


if($price==50){

  $sql = "insert into platby values ('$textt', '$price', '$datum')";
  $result = mysql_query($sql);

MySQL_Query("update uzivatele set silver='1',bankabudova='1',kontrolabankabudova='1' where cislo=$textt") or die(mysql_error());

	echo "Dekujeme, Vase platba byla vporadku zpracovana.";  

}


if($price==47.60){

  $sql = "insert into platby values ('$textt', '$price', '$datum')";
  $result = mysql_query($sql);

		$platby_1_0 = MySQL_Query("SELECT platby_sk FROM uzivatele where cislo=$textt");
		$platby_1 = MySQL_Fetch_Array($platby_1_0);

if($platby_1[platby_sk]==0){

MySQL_Query("update uzivatele set platby_sk='1' where cislo=$textt") or die(mysql_error());

	echo "Dakujeme vasa pladba bola v poriadku zpracovana. Pre status silver zašlite ešte jednu SMS. Pre status gold zašlite ešte dve SMS.";  
}

if($platby_1[platby_sk]==1){

MySQL_Query("update uzivatele set platby_sk='2',silver='1',bankabudova='1',kontrolabankabudova='1' where cislo=$textt") or die(mysql_error());

	echo "Dakujeme vasa pladba bola v poriadku zpracovana. Pre status gold zašlite ešte jednu SMS.";  
}

if($platby_1[platby_sk]==2){

MySQL_Query("update uzivatele set platby_sk='3',gold='1',bankabudova='1',kontrolabankabudova='1' where cislo=$textt") or die(mysql_error());

	echo "Dakujeme vasa pladba bola v poriadku zpracovana.";  
}

}



if($price==79){

  $sql = "insert into platby values ('$textt', '$price', '$datum')";
  $result = mysql_query($sql);

MySQL_Query("update uzivatele set gold='1',bankabudova='1',kontrolabankabudova='1' where cislo=$textt") or die(mysql_error());

	echo "Dekujeme, Vase platba byla vporadku zpracovana.";  

}

if($price==99){

  $sql = "insert into platby values ('$text', '$price', '$datum')";
  $result = mysql_query($sql);



		$hhr2 = MySQL_Query("select cislo,hrdinove from servis where cislo=1");
		$hhr = MySQL_Fetch_Array($hhr2);	
		$hhr0 = MySQL_Query("select jmeno from uzivatele where cislo=$textt");
		$hhr_1 = MySQL_Fetch_Array($hhr0);		
		$hrdinove=$hhr[hrdinove];
		$texttt="Popis není";
		$den = Date("U");
		$vek=Date("U")-(3600*24*20*12);
		$hjmeno=" ".$hhr_1[jmeno]." hrdina";
		$htyp=4;
		
		MySQL_Query("insert into hrdinove (cislo,cislomaj,zivot,status,rasa,text,obr,jmeno,typ,level,zkus) values ('$hrdinove',$textt,'$vek',0,'$hrasa','$texttt','$hobr','$hjmeno','$htyp',40,800000)");


				
		$hrdinove+=1;
		MySQL_Query("update servis set hrdinove='$hrdinove' where cislo=1");


	echo "Dekujeme, Vase platba byla vporadku zpracovana.";  

}

?>