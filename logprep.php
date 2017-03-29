<?mysql_query("SET NAMES cp1250");

$spoj = Mysql_query("Select * from logprep");
$kol = mysql_num_rows($spoj);

$vys8 = MySQL_Query("SELECT * FROM logprep where kto = '$logjmeno' order by datum");
//$zaznam = MySQL_Fetch_Array($vys8);
?>
  <table align = "center" border="1">
      <tr>
        <th>&nbsp;Datum&nbsp;</th>
        <th>&nbsp;Denní zisk&nbsp;</th>
        <th>&nbsp;Pøíspìvek do fondu&nbsp;</th>
        <th>&nbsp;Pøíspìvek na výzkum&nbsp;</th>
      </tr>
    
<?
while ($zazn = Mysql_fetch_array($vys8))
  {
    $datum=Date("G:i:s j.m.Y", $zazn["datum"]);
    echo "
    <tr>
      <td align='center'>" . $vesmirné datum . "</td>
      <td align='center'>" . fcis($zazn["dz"]) . "</td>
      <td align='center'>" . fcis($zazn["rf"]) . "</td>
      <td align='center'>" . fcis($zazn["vf"]) . "</td>
     </tr>";
  }

?>
</table>
