<?php

mysql_query("SET NAMES cp1250");

require "data_1.php";

$vys1 = MySQL_Query("SELECT heslo,jmeno,cislo,heslo2,rasa,hra,skin,zmrazeni,admin FROM uzivatele where cislo='$logcislo'");

global $zaznam1;

$zaznam1 = MySQL_Fetch_Array($vys1);

require("kontrola.php");

$den=Date("U");

MySQL_Query("update uzivatele set posl=$den where cislo=$logcislo");

$styl="styl".$zaznam1[skin];

if($zaznam1[skin]==1 or $zaznam1[skin]==2 or $zaznam1[skin]==3 or $zaznam1[skin]==4){$styl="styl1";};

	

	

	if($smazat_admin==1)

	{

		if($zaznam1[admin]==1)

		{

			mysql_query("DELETE FROM smlouvy WHERE id='".$id."'");

		}

	}



	if($podepsat == 1)

	{

		$result_podepsat = mysql_query("SELECT * FROM smlouvy WHERE id=$id");

		$array_podepsat = mysql_fetch_array($result_podepsat);

		if($rasa == 1)

		{

			

			if($array_podepsat[podepsal2] == null)

			{

				

				$status = 0;

			}

			else

			{

				$status = 1;

			}

		} 

		if($rasa == 2)

		{

			if($array_podepsat[podepsal1] == null)

			{

				

				$status = 0;

			}

			else

			{

				$status = 1;

			}

		} 

		mysql_query("UPDATE smlouvy set status=".$status.", podepsal".$rasa."='".$logjmeno."', podepsana='".time()."' WHERE id=$id");

		

	}

	if($vypovedet == 1)

	{

		

		$result_vypovedet = mysql_query("SELECT lhuta FROM smlouvy WHERE id=$id");

		$array_vypovedet = mysql_fetch_array($result_vypovedet);

		$status = 2;

		$vyprsi = time() + 3600 * $array_vypovedet[lhuta];

		

		mysql_query("UPDATE smlouvy set status=".$status.", vyprsi = '".$vyprsi."', vypovezena = '".time()."' WHERE id=$id");

	}

	

//require("kontrola.php"); 

?>

<style type="text/css">

@import url(<?echo $styl?>.css);

td{text-align:center;};

.zmraz{color:#5555ee;

	 font-family:Times New Roman;

    text-align:center;}

.zmrazy{color:#ffffff;

    font-family:Times New Roman;

    text-align:center;

    /*font-Weight:bold;*/

    background:#cc6600;

	}

.ty{color:#ffffff;

    font-family:Arial;

    text-align:center;

    /*font-Weight:bold;*/

    background:#474747;

	}

</style>

<!--<form action="hlavni.php?page=smlouvy" method="post"><input type="text" name="smlouvy_rasy"><input type="submit" value="Vyhledat smlouvy rasy"></form>-->

<br>

<br>

<?php

$query_smlouvy = "SELECT * FROM smlouvy ORDER BY den DESC";

if(isset($smlouvy_rasy))

{

	$query_smlouvy = "SELECT * FROM smlouvy ORDER BY den DESC WHERE rasa1=$smlouvy_rasy OR rasa2=$smlouvy_rasy";

}

$result_smlouvy = mysql_query($query_smlouvy);

	

$query_user = "SELECT jmeno,cislo,rasa,heslo,status,admin FROM uzivatele WHERE cislo='$logcislo'";

$result_user = mysql_query($query_user);

$array_user = mysql_fetch_array($result_user);

	

$query_vlada = "SELECT rasa,vudce,min1 FROM vudce WHERE rasa=".$array_user[rasa]."";

$result_vlada = mysql_query($query_vlada);

$array_vlada = mysql_fetch_array($result_vlada);





	

$query_rasy = "SELECT rasa,nazevrasy FROM rasy ORDER BY rasa";

$result_rasy = mysql_query($query_rasy);

while($pom_rasy = mysql_fetch_array($result_rasy))

	{

		$array_rasy[$pom_rasy[rasa]] = $pom_rasy[nazevrasy];

	}

if(($array_vlada[vudce] == $logjmeno) || ($array_vlada[min1] == $logjmeno))

{

	?>

	<a href="hlavni.php?page=vesmir&jak=smlouvy&nova=1">Nová smlouva</a><br><br>

	<?php

	if($nova==1){

		?>

		<form action="hlavni.php?page=vesmir&jak=smlouvy" method="post">

		<table width="95%">

		<tr><td>s rasou</td><td>možné vztahy</td><td>výpovìdní lhùta(v hodinách)</td><td>poznámka(možno použít html tagy)</td></tr>

		<tr>

		

		<td>

		<select name="rasa2">

		<?php

		foreach($array_rasy as $rasa => $nazevrasy)

		{

			if($rasa < 1 || $rasa > ($pocetras+1) || $rasa == $array_user[rasa])

				continue;

			?>

			<option value="<?php echo $rasa;?>"><?php echo $nazevrasy; ?></option>

			<?php

		}

		?>

		</select>

		</td>

		<td align="left">

		Pakt <input type="checkbox" name="pakt" value="1"><br>

		Neútoèení <input type="checkbox" name="neutoceni" value="1"><br>

		Mír <input type="checkbox" name="mir" value="1"><br>

		Neutralita <input type="checkbox" name="neutralita" value="1"><br>

		Válka <input type="checkbox" name="valka" value="1"><br>

		</td>

		<td>

		<input type="text" name="lhuta" value="48">

		</td>

		<td>

		<textarea name="poznamka" cols="40" rows="5"></textarea>

		</td>

		

		</tr>

		</table><br>

		<input type="hidden" value="2" name="nova">

		<input type="submit">

		</form>

		<br><br><br>

		<?php

	}

	if($nova == 2)

	{

		/*echo "rasa1 - " . $array_user[rasa];		

		echo "<br>rasa2 - " . $rasa2;

		echo "<br> vztahy - " . $pakt . $neutoceni . $mir . $neutralita . $valka;

		echo "<br> lhuta - " . $lhuta;

		echo "<br> poznamka - ". $poznamka;*/

		if($pakt == null) $pakt = "0";

		if($neutoceni == null) $neutoceni = "0";

		if($mir == null) $mir = "0";

		if($neutralita == null) $neutralita = "0";

		if($valka == null) $valka = "0";

		mysql_query("INSERT INTO smlouvy (id,den,rasa1,rasa2,vztahy,lhuta,poznamka,podepsal1) VALUES ('','". time() ."','". $array_user[rasa] ."','". $rasa2 ."','". $pakt . $neutoceni . $mir . $neutralita . $valka ."','". $lhuta ."','". $poznamka ."','". $logjmeno ."')");

		$query_smlouvy = "SELECT * FROM smlouvy ORDER BY den DESC";

		$result_smlouvy = mysql_query($query_smlouvy);

	}

}



?>

<table width="95%"  border="1" cellpadding="5px">

  <tr>

    <td><strong>datum</strong></td>

    <td><strong>mezi rasami </strong></td>

    <td><strong>možné vztahy </strong></td>

    <td><strong>výpovìdní lhùta </strong></td>

    <td><strong>poznámka</strong></td>

    <td><strong>stav smlouvy </strong></td>

<?              if(($array_vlada[vudce] == $logjmeno) || ($array_vlada[min1] == $logjmeno) || ($zaznam1[admin]==1)){

	echo "<td><strong>Potvrzení smluvy</strong></td>";}

	else echo "";

?>

  </tr>

<?php

	

	

	

	

	function vztahy_decode($vztahy_data)

	{

		$array_vztahy_decoded = array();

		$array_vztahy_decoded = sscanf($vztahy_data,"%1d%1d%1d%1d%1d");

		

		

		for($i=0;$i<5;$i++)

		{

			if($array_vztahy_decoded[$i] != 0)

			{

				switch($i)

				{

					case 0: echo "<font color=green>pakt </font><br>";break;

					case 1: echo "<font color=#00dddd>neútoèení </font><br>";break;

					case 2: echo "<font color=white>mír </font><br>";break;

					case 3: echo "<font color=yellow>neutralita </font><br>";break;

					case 4: echo "<font color=red>válka </font><br>";break;

				}

				

			}

		}

	}

	

	function status_decode($status_data,$vyprsi_data,$id)

	{

		if(($vyprsi_data < time()) && ($vyprsi_data != null))

		{

			mysql_query("UPDATE smlouvy SET status = '3' WHERE id=$id");

			$status_data = 3;

		}

		switch($status_data)

		{

			case 0: echo "<font color=yellow>Èeká na podepsání</font>";break;

			case 1: echo "<font color=green>Podepsaná</font>";break;

			case 2: echo "<font color=yellow>Bìží výpovìdní lhùta<br>Vyprší:<br>".date("d. m. Y",$vyprsi_data) ."<br>". date("H:i:s",$vyprsi_data)."</font>";break;

			case 3: echo "<font color=red>Vypovìzená smlouva - ".date("d. m. Y",$vyprsi_data) ."<br>". date("H:i:s",$vyprsi_data)."</font>";break;

		}

	}

	

	function check_vudce($array_vlada,$logjmeno,$array_smlouvy)

	{

		

		if(($array_vlada[vudce] == $logjmeno) || ($array_vlada[min1] == $logjmeno))

		{

			

			if(($array_smlouvy[rasa1] == $array_vlada[rasa]) || ($array_smlouvy[rasa2] == $array_vlada[rasa]))

			{

				switch($array_vlada[rasa])

				{

					case $array_smlouvy[rasa1]: $rasa = 1;break;

					case $array_smlouvy[rasa2]: $rasa = 2;break;

				}

				

				if($array_smlouvy[status] == 0)

				{

									

					if($array_smlouvy["podepsal".$rasa] == null)

					{

					?>

					<a href="hlavni.php?page=vesmir&jak=smlouvy&podepsat=1&rasa=<?php echo $rasa;?>&id=<?php echo $array_smlouvy[id]; ?>">Podepsat</a>

					<?php

					}

				}

				

				if($array_smlouvy[status] == 1)

				{

					

					?>

					<a href="hlavni.php?page=vesmir&jak=smlouvy&vypovedet=1&rasa=<?php echo $rasa;?>&id=<?php echo $array_smlouvy[id]; ?>">Vypovìdìt</a>

					<?php

					

				}

				

			}

		}

		else return 0;

	}

	

	while($array_smlouvy = mysql_fetch_array($result_smlouvy))

	{

		?>

		<tr>

    		<td>vytvoøení:<br><?php echo date("d. m. Y",$array_smlouvy[den]) . "<br>" . date("H:i:s",$array_smlouvy[den]); ?><br><br>

    		<?php switch($array_smlouvy[status])

    		{

    			case "1": ?><font color="Green">podepsání:<br>

    			<?php echo date("d. m. Y",$array_smlouvy[podepsana]) . "<br>" . date("H:i:s",$array_smlouvy[podepsana]); ?></font>

    			<?php break;

    			case "2":

    			case "3": ?>

    			<font color="Green">podepsání:<br>

    			<?php echo date("d. m. Y",$array_smlouvy[podepsana]) . "<br>" . date("H:i:s",$array_smlouvy[podepsana]); ?></font><br><br>

    			

    			<font color="Red">vypovìzení:<br>

    			<?php echo date("d. m. Y",$array_smlouvy[vypovezena]) . "<br>" . date("H:i:s",$array_smlouvy[vypovezena]); ?></font>

    			<?php

    			break;

    		}

    		?>&nbsp;</td>

    		<td><?php echo $array_rasy[$array_smlouvy[rasa1]] ."<br>a<br>". $array_rasy[$array_smlouvy[rasa2]]; ?>&nbsp;</td>

    		<td><?php vztahy_decode($array_smlouvy[vztahy]); ?>&nbsp;</td>

    		<td><?php echo $array_smlouvy[lhuta]; ?>&nbsp;</td>

    		<td><?php echo $array_smlouvy[poznamka]; ?>&nbsp;</td>

    		<td><?php status_decode($array_smlouvy[status],$array_smlouvy[vyprsi],$array_smlouvy[id]); ?>&nbsp;</td>

            <?              

			if(($array_vlada[vudce] == $logjmeno) || ($array_vlada[min1] == $logjmeno) || ($zaznam1[admin]==1))

			{

				echo "<td>";

			}

			else echo "";

			?>

			<?php check_vudce($array_vlada,$logjmeno,$array_smlouvy); ?>

			<?  



			if($zaznam1[admin]==1 or $zaznam1[admin]==2 or $zaznam1[admin]==3 )

				{

					?>

					<a href="hlavni.php?page=vesmir&jak=smlouvy&smazat_admin=1&id=<?php echo $array_smlouvy[id]; ?>">Smazat</a>

					<?php

				}

			  

			if(($array_vlada[vudce] == $logjmeno) || ($array_vlada[min1] == $logjmeno) || ($zaznam1[admin]==1) || ($zaznam1[admin]==2) || ($zaznam1[admin]==3))

			{

				echo "&nbsp;</td>";

			}

			else echo "";

?>

  		</tr>





		

		<?php

	}



?>  

</table>

