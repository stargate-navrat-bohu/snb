<?php
header('Cache control: no-cache');

require 'data_1.php';

$vys1 = MySQL_Query('SELECT cislo,jmeno,rasa,vek,timedora,timezra FROM uzivatele WHERE cislo="'.$logcislo.'" ');
$zaznam1 = MySQL_Fetch_Array($vys1);
?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <style type="text/css">
a { font-family:Verdana, Sans-Serif; font-weight:bold; text-decoration:none; color:#09F; font-size:8pt; }
a:hover { background-color:#09F; color:black; }
h1 { color:#09F; }
body { background-color:black; color:orange; }
        </style>
    </head>
    <body>
        <div align="center"> 
            <a href="info.php" target="hlavni">Info</a><br/>
            <a href="planety.php" target="hlavni">Planety</a><br/>
            <a href="jednotky.php" target="hlavni">Jednotky</a><br/>
            <a href="vesmir.php" target="hlavni">Vesmír</a><br/>
            <a href="utok.php" target="hlavni">Útok</a><br/>
            <a href="posta.php" target="hlavni">Pošta</a><br/>
            <a href="forum.php" target="hlavni">Fórum</a><br>
            <a href="vlada.php" target="hlavni">Vláda</a><br/>
            <a href="politika.php" target="hlavni">Politika</a><br/>
            <a href="ref.php" target="hlavni">Hlasování</a><br/>
            <a href="fond.php" target="hlavni">Fondy</a><br/>
            <a href="obchod.php" target="hlavni">Obchod</a><br/>
            <a href="nastav.php" target="hlavni">Osobní nastavení</a><br/>
            <a href="http://www.sg-rtg.net/help/" target="hlavni">HNápověda</a><br/>
            <a href="http://www.sg-rtg.net/kronika/" target="hlavni">Kronika</a><br/>
            <a href="dotazy.php" target="hlavni">Dotazy</a><br/>
            <a href="bug.php" target="hlavni">Chyby</a><br/>
            <a href="odhlasit.php" target=_parent>Odhlášení</a><br/>
        </div>
    </body> 
</html>