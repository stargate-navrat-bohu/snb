<?mysql_query("SET NAMES cp1250");  

  header('Content-Type: application/x-javascript');
    $fp = fopen('http://system.efektiv.cz/krp/input/?server=59&space=243&count=3&mwidth=80&mheight=60', 'r');
    for($i=0;$i<3;$i++) {
        $row = fgetcsv($fp, 4096, ',');
        if($row[0] != '') {
            echo(iconv('iso8859-2','utf-8','document.write(
                '<div class="efektiv-reklama"><a href="' . $row[1] . '">
                <img src="http://system.efektiv.cz/krp/image/?id=' . $row[6] . 
                '&mwidth=80&mheight=60" width="' . $row[7] . '" 
                height="' . $row[8] . '" style="float:left;clear:right;margin-right:15px;" 
                alt="" /></a><strong><a href="' . $row[1] . '">' . $row[3] . '</a>
                </strong><br /><small>' . $row[4] . '<br /><em>
                <a href="' . $row[1] . '">' . $row['5'] . '</a>
                </em></small></div>')'));
        }
    }

?>
    