<?
mysql_query("SET NAMES cp1250");
unset($zaznam1);
unset($zaznam77);
unset($pochracu);
unset($zaznam777);
unset($volen);


		require "data_1.php";
	

for($rasa1=1;$rasa1<13;$rasa1++){

unset($zaznam77);
unset($pochracu);
//echo $zaznam1[rasa];	
//$zaznam1[rasa]
@$vys1 = MySQL_Query("SELECT jmeno FROM uzivatele where  rasa = '$rasa1'");
@$pochracu = MySQL_Num_Rows($vys1);
if($pochracu!=0){
$result = MySQL_Query("SELECT jmeno FROM uzivatele where  rasa = '$rasa1' ");

//-------------------------------------------------
$i = 0;
    while ($i<$pochracu):
$zaznam77[$i]=mysql_Result($result, $i);

$i++;
endwhile;


//echo $pochracu;
$i=0;
//-------------------------------------------------

for($i=0;$i<$pochracu;$i++){

$pocitadlo=0;

	@$vys2 = MySQL_Query("SELECT jmeno,koho,cislo FROM uzivatele where rasa='$rasa1' ORDER BY cislo LIMIT $i,1");
	@$zaznam777 = MySQL_Fetch_Array($vys2);

	for($j=0;$j<$pochracu;$j++){

		if($zaznam777[koho]==$zaznam77[$j]){$pocitadlo=1; $koho2=$zaznam77[$j];}



		}
//echo MySQL_Error();
if($pocitadlo==0){$koho2 = $zaznam777[jmeno];}
if ($koho2!=null){
MySQL_Query("update uzivatele set koho='$koho2' where cislo='$zaznam777[cislo]'") or die(mysql_error());		
//echo $zaznam777[jmeno];}
//echo"<BR>";
$koho2=null;
}
//-------------------------------------------------
for($i=0;$i<$pochracu;$i++){
$koho1=$zaznam77[$i];
$vys3 = MySQL_Query("SELECT koho FROM uzivatele where  (koho='$koho1' AND rasa ='$rasa1')");
$volen= MySQL_Num_Rows($vys3);
//echo $volen,  $zaznam77[$i];echo"<BR>";
MySQL_Query("update uzivatele set volen='$volen' where jmeno='$koho1'") or die(mysql_error());
}


}
}}

echo "hlasy srovnany";


?>
