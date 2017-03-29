<style type="text/css">
@import url(default.css);
</style>

<?
		require "data_1.php";
  

			$vys1 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni FROM uzivatele where admin!='1' ORDER BY (planety*sila*populace) DESC LIMIT 50 ");
			$nadpis1 = "mocnost";

			$vys2 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni FROM uzivatele where admin!='1' ORDER BY planety DESC LIMIT $qx,$qxx");
			$nadpis2 = "planety";

			$vys3 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni FROM uzivatele where admin!='1' ORDER BY sila DESC LIMIT $qx,$qxx");
			$nadpis3 = "sila";

			$vys4 = MySQL_Query("SELECT jmeno,dobyt,vek,rasa,sila,populace,planety,zmrazeni,icq,status,admin,jed1,jed2,jed4,jed5,narod,zrizeni FROM uzivatele where admin!='1' ORDER BY populace DESC LIMIT $qx,$qxx");
			$nadpis4 = "populace (v milionéch)";

echo "<table>";
				echo "<tr colspan=3>".$nadpis1."";
				echo "</tr>";

				echo "<tr>";

				echo "<td><font color=".$color.">Jméno</font></a></td>";
				echo "<td><font color=".$color.">rasa</font></td>";
				echo "<td><font color=".$color.">mocnost</font></td>";


			while($zaznam1 = MySQL_Fetch_Array($vys1)):
$mocnost=$zaznam1[populace]*$zaznam1[sila]*$zaznam1[planety];

				echo "<td><font color=".$color.">".$zaznam1[jmeno]."</font></a></td>";
				echo "<td><font color=".$color.">".$zaznam1[rasa]."</font></td>";
				echo "<td><font color=".$color.">".$mocnost."</font></td>";
				echo "</tr>";
			endwhile;

echo "</table>";
?>




<a href='hlavni.php?page=info'>---------------------------- !!!ZDE!!! kliknìte pro návrat do hry... ----------------------------</a>

</center>


