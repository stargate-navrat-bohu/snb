<h2>Seznam adminù</h2>
<?php
mysql_query("SET NAMES cp1250");

		require "data_1.php";
		$vys1 = MySQL_Query("SELECT * FROM uzivatele where cislo=$logcislo");
		$zaznam1 = MySQL_Fetch_Array($vys1);
		require("kontrola.php");

if($zaznam1["admin"]==1){
  echo '<center><a href="hlavni.php?page=admini&nova=1">Pøidat</a></center>';
  if(isset($del)){
    $sql = "DELETE FROM `admini` WHERE `id` = '$del' LIMIT 1;";
    mysql_query($sql, $spojeni);
  }
  if(isset($send)){
    $sql = "INSERT INTO `admini` ( `id` , `jmeno` , `text` ) VALUES (NULL , '$jmeno', '$text');";
    mysql_query($sql, $spojeni);
  }
  if(isset($nova)){
    echo '<br> <br>
    <form action="hlavni.php?page=admini" method="post">
      <input type="hidden" name="send" value="1">
      <table align="center">
        <tr>
          <td style="text-align: right">
            Jméno(a):
          </td>
          <td>
             <input type="text" name="jmeno" value="" class="input" size=25>
          </td>
        </tr>
        <tr>
          <td>
             Co mají na starosti:
           </td>
           <td>
             <input type="text" name="text" value="" class="input" size=25>
           </td>
         </tr>
         <tr>
           <td colspan=2 style="text-align: center"> 
             <input type="submit" value="Pøidat" class="button">
           </td>
         </tr>
       </table>
    </form>
    ';    
  }
}
		
		$sql = "SELECT * FROM `admini` ORDER BY `id` ASC ";
		$result = mysql_query($sql, $spojeni);
		if(mysql_num_rows($result)){
		  echo '
      <table style="text-align: center" class="table" cellpadding=0 cellspacing=0 align="center">
        <tr class="vrsek">
          <th>
            Kdo
          </th>
          <th>
            Co má na starosti
          </th>
          <th>
          </th>
        <tr>';  
      while($row=mysql_fetch_array($result)){
        echo '
        <tr class="spodek">
          <td>
            '.$row["jmeno"].'
          </td>
          <td>
            '.$row["text"].'
          </td>
          <td>&nbsp;';
          if($zaznam1["admin"]==1){
            echo '<a href="hlavni.php?page=admini&del='.$row["id"].'">Smazat</a>';
          }
          echo '
          </td>
        ';
      }
      echo '</table>';
		}

?>
