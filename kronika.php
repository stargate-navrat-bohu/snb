<p /><font class='text_bili'><font class='text_modry'>K</font>ronika</font></font>

<p />

<a href="index.php?page=kronika&kde=1"> Rasy</a>&nbsp;&nbsp;
<a href="index.php?page=kronika&kde=2"> Hr��i</a>&nbsp;&nbsp;
<p />
<?
mysql_query("SET NAMES cp1250");
	if(empty($kde)){$kde=1;};

require "data_1.php";


if ($kde == 1)
  {
    echo "<font style='color: white'>V�sledky v�k� (rasy)</font>
    <p />
    <table border='1' align='center' cellpadding='1' cellspacing='0'>
      <tr>
        <td style='color: #0099FF;'></td>
        <td style='color: #0099FF;'>1. m�sto</td>
        <td style='color: #0099FF;'>2. m�sto</td>
        <td style='color: #0099FF;'>3. m�sto</td>
      </tr>
      <tr>
        <td style='color: #0099FF;'></td>
        <td style='color: #FFFFFF;'></td>
        <td style='color: #FFFFFF;'></td>
        <td style='color: #FFFFFF;'></td>
      </tr>
    </table>
    ";
    
  }
  
  if ($kde == 2)
  {
    echo "<font style='color: white'>V�sledky v�k� (hr��i)</font>
    <p />
    <table border='1' align='center' cellpadding='1' cellspacing='0'>
      <tr>
        <td style='color: #0099FF;'></td>
        <td style='color: #0099FF;'>1. m�sto</td>
        <td style='color: #0099FF;'>2. m�sto</td>
        <td style='color: #0099FF;'>3. m�sto</td>
        <td style='color: #0099FF;'>4. m�sto</td>
        <td style='color: #0099FF;'>5. m�sto</td>
      </tr>
      <tr>
        <td style='color: #0099FF;'></td>
        <td style='color: #FFFFFF;'>M�ca10</td>
        <td style='color: #FFFFFF;'></td>
        <td style='color: #FFFFFF;'></td>
        <td style='color: #FFFFFF;'></td>
        <td style='color: #FFFFFF;'></td>
        <td style='color: #FFFFFF;'>�ku�ebn� Kronik��</td>
        <td style='color: #FFFFFF;'></td>
      </tr>
    </table>
    ";
    
  }
?>