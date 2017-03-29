<h1>Pøihlášení úèastníci</h1>
<?php
mysql_query("SET NAMES cp1250");

require "data_1.php";
$res = mysql_query("SELECT * FROM sraz order by Id");
while ($row = mysql_fetch_array($res)) {
	echo $row[jmeno] . " " . $row[prijmeni] . " alias '" . $row[nick] . "'<br>";
	$i++;
}
?>
<br>Celkem: 
<?php
 echo mysql_num_rows($res);
?>
<br><br>
<form action="hlavni.php?page=sraz" method="POST">
<input type="text" name="jmeno"> - jméno<br>
<input type="text" name="prijmeni"> - pøíjmení<br>
<input type="text" name="tel"> - telefon<br>
<input type="text" name="mail"> - mail<br>
<input type="text" name="nick"> - nick

<br>
<br>
<input type="submit" value="zapsat" name="submit"><input type="reset" value="reset">
</form>

<?php

if($submit == "zapsat")
{
	mysql_query("INSERT INTO sraz SET jmeno = '$_POST[jmeno]', prijmeni = '$_POST[prijmeni]',telefon = '$_POST[tel]',mail = '$_POST[mail]',nick = '$_POST[nick]'");
	echo "<br> Zapsáno: jmeno = $_POST[jmeno], prijmeni = $_POST[prijmeni],telefon = $_POST[tel],mail = $_POST[mail],nick = $_POST[nick]";
}


?>



