<div style="text-align:left; padding-left: 10px;">
    <?php
    require 'data_1.php';
    mysql_query("SET NAMES cp1250");
    $vys1 = MySQL_Query("SELECT jmeno,heslo,volen,koho,rasa,status,ref,refn,cislo,hra,zmrazeni,skin,orp,admin,reg FROM uzivatele where cislo=$logcislo");
    $zaznam1 = MySQL_Fetch_Array($vys1);

    require("kontrola.php");


    $rasa = $zaznam1[rasa];

// Zmena referenda - zacatek
    if (isset($znar)) {
        do {
            if (($zaznam1[status] != 1) and ($zaznam1[status] != 2) and ($zaznam1[status] != 5)) {
                echo "<h1>Toto je povoleno pouze vùdci, zástupci a poradcùm.</h1>";
                break;
            };
            $vys5 = MySQL_Query("SELECT jmeno FROM uzivatele where rasa = '$rasa'");
            $hhh = mysql_num_rows($vys5);
            $refer = MySQL_Query("SELECT * FROM refnew where cislo = '$rasa'");
            $ref = MySQL_Fetch_Array($refer);


// Vypocet hlasujicich obcanu pro danou otazku
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='1' and rasa='$rasa'");
            $poc1 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='2' and rasa='$rasa'");
            $poc2 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='3' and rasa='$rasa'");
            $poc3 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='4' and rasa='$rasa'");
            $poc4 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='5' and rasa='$rasa'");
            $poc5 = mysql_num_rows($query);
            /* if($poc1<"1"){$poc1=1;}
              if($poc2<"1"){$poc2=1;}
              if($poc3<"1"){$poc3=1;}
              if($poc4<"1"){$poc4=1;}
              if($poc5<"1"){$poc5=1;} */

            $j = 0;
            for ($i = 1; $i < 6; $i++) {
                if ($ref["odpoved$i"] != "") {
                    $j++;
                }
            }

            $dohromady = $poc1 + $poc2 + $poc3 + $poc4 + $poc5;

            if ($j == 2) {
                $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc1 . " (" . Round($poc1 / ($poc1 + $poc2) * 100) . "%) a pro " . $ref[odpoved2] . " se vyslovilo " . $poc2 . " (" . Round($poc2 / ($poc1 + $poc2) * 100) . "%). Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            }

            if ($j == 3) {
                $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc1 . " (" . Round($poc1 / ($poc1 + $poc2 + $poc3) * 100) . "%), pro " . $ref[odpoved2] . " se vyslovilo " . $poc2 . " (" . Round($poc2 / ($poc1 + $poc2 + $poc3) * 100) . "%) a pro " . $ref[odpoved3] . " se vyslovilo " . $poc3 . " (" . Round($poc3 / ($poc1 + $poc2 + $poc3) * 100) . "%). Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            }

            if ($j == 4) {
                $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc1 . " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%), pro " . $ref[odpoved2] . " se vyslovilo " . $poc2 . " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%), pro " . $ref[odpoved3] . " se vyslovilo " . $poc3 . " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%) a pro " . $ref[odpoved4] . " se vyslovilo " . $poc4 . " (" . Round($poc4 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%). Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            }

            if ($j == 5) {
                $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc1 . " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved2] . " se vyslovilo " . $poc2 . " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved3] . " se vyslovilo " . $poc3 . " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved4] . " se vyslovilo " . $poc4 . " (" . Round($poc4 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%) a pro " . $ref[odpoved5] . " se vyslovilo " . $poc5 . " (" . Round($poc5 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%) . Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            }

            if ($hhh != 0) {
                $vysledek.= " (" . Round(($poc1 + $poc2 + $poc3 + $poc4 + $poc5) / $hhh * 100) . "%).";
            } else {
                $vysledek.=".";
            };
            $znar.=" (Zadal: " . $zaznam1[jmeno] . ")";
            $otazka = HTMLSpecialChars($znar);
            $otazka = NL2BR($otazka);
            $odpo1 = HTMLSpecialChars($odpo1);
            $odpo2 = HTMLSpecialChars($odpo2);
            $odpo3 = HTMLSpecialChars($odpo3);
            $odpo4 = HTMLSpecialChars($odpo4);
            $odpo5 = HTMLSpecialChars($odpo5);
            //echo $odpo1 . " dd " . $odpo2 . " dd " . $odpo3 . " dd " . $odpo4 . " dd " . $odpo5 . " dd "; 
            MySQL_Query("update uzivatele set refn='0' where rasa='$rasa'");
            MySQL_Query("update refnew set otazka='', odpoved1='', odpoved2='', odpoved3='', odpoved4='', odpoved5='' where cislo = '$rasa' ");
            MySQL_Query("update refnew set otazka='$otazka', odpoved1='$odpo1', odpoved2='$odpo2', odpoved3='$odpo3', odpoved4='$odpo4', odpoved5='$odpo5' where cislo='$rasa'");
            MySQL_Query("update refnew set vysledek='$vysledek' where cislo='$rasa'");
        } while (false);
    };
// Zmena referenda - konec
// Zmena vesmírného referenda - zacatek
    if (isset($zmez)) {
        do {
            if (($zaznam1[admin] != 1 and $zaznam1[admin] != 2)) {
                echo "<h1>Toto je dovoleno pouze adminùm.</h1>";
                break;
            };
            $vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
            $hhh = mysql_num_rows($vys5);
            $refer = MySQL_Query("SELECT * FROM refnew where cislo = '0'");
            $ref = MySQL_Fetch_Array($refer);

// Vypocet hlasujicich hracu pro danou otazku
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='1'");
            $poc1 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='2'");
            $poc2 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='3'");
            $poc3 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='4'");
            $poc4 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='5'");
            $poc5 = mysql_num_rows($query);
            /* if($poc4<"1"){$poc4=1;}
              if($poc5<"1"){$poc5=1;}
              if($poc6<"1"){$poc6=1;} */

            $j = 0;
            for ($i = 1; $i < 6; $i++) {
                if ($ref["odpoved$i"] != "") {
                    $j++;
                }
            }


            $dohromady = $poc1 + $poc2 + $poc3 + $poc4 + $poc5;

            if ($j == 2) {
                $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc1 . " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%) a pro " . $ref[odpoved2] . " se vyslovilo " . $poc2 . " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%). Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            }

            if ($j == 3) {
                $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc1 . " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved2] . " se vyslovilo " . $poc2 . " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%) a pro " . $ref[odpoved3] . " se vyslovilo " . $poc3 . " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%). Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            }

            if ($j == 4) {
                $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc1 . " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved2] . " se vyslovilo " . $poc2 . " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved3] . " se vyslovilo " . $poc3 . " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%) a pro " . $ref[odpoved4] . " se vyslovilo " . $poc4 . " (" . Round($poc4 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%). Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            }

            if ($j == 5) {
                $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc1 . " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved2] . " se vyslovilo " . $poc2 . " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved3] . " se vyslovilo " . $poc3 . " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%), pro " . $ref[odpoved4] . " se vyslovilo " . $poc4 . " (" . Round($poc4 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%) a pro " . $ref[odpoved5] . " se vyslovilo " . $poc5 . " (" . Round($poc5 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%). Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            }

            if ($hhh != 0) {
                $vysledek.= " (" . Round(($poc1 + $poc2 + $poc3 + $poc4 + $poc5) / $hhh * 100) . "%).";
            } else {
                $vysledek.=".";
            };
            $zmez.=" (Zadal: " . $zaznam1[jmeno] . ")";
            $otazka = HTMLSpecialChars($zmez);
            $otazka = NL2BR($otazka);
            $odpo1 = HTMLSpecialChars($odpo1);
            $odpo2 = HTMLSpecialChars($odpo2);
            $odpo3 = HTMLSpecialChars($odpo3);
            $odpo4 = HTMLSpecialChars($odpo4);
            $odpo5 = HTMLSpecialChars($odpo5);
            MySQL_Query("update uzivatele set ref='0' ");
            MySQL_Query("update refnew set otazka='', odpoved1='', odpoved2='', odpoved3='', odpoved4='', odpoved5='' where cislo = '0' ");

            MySQL_Query("update refnew set otazka='" . $otazka . "',odpoved1='" . $odpo1 . "',odpoved2='" . $odpo2 . "',odpoved3='" . $odpo3 . "',odpoved4='" . $odpo4 . "',odpoved5='" . $odpo5 . "' where cislo='0'");
            MySQL_Query("update refnew set vysledek='" . $vysledek . "' where cislo='0'");
        } while (false);
    };
// Zmena vesmírného referenda - konec
// Zmena admin referenda - zacatek
    if (isset($zmeza)) {
        do {
            if (($zaznam1[admin] != 1 and $zaznam1[admin] != 2 and $zaznam1[admin] != 3 and $zaznam1[admin] != 4)) {
                echo "<h1>Toto je dovoleno pouze adminùm.</h1>";
                break;
            };
            $vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
            $hhh = mysql_num_rows($vys5);
            $refer = MySQL_Query("SELECT * FROM refnew where cislo = '108'");
            $ref = MySQL_Fetch_Array($refer);

// Vypocet hlasujicich hracu pro danou otazku
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE (ref='1' and (admin='1' or admin='2' or admin='3' or admin='4')) ");
            $poc7 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE (ref='2' and (admin='1' or admin='2' or admin='3' or admin='4')) ");
            $poc8 = mysql_num_rows($query);
            $query = mysql_query("SELECT jmeno FROM uzivatele WHERE (ref='3' and (admin='1' or admin='2' or admin='3' or admin='4')) ");
            $poc9 = mysql_num_rows($query);
            if ($poc7 < "1") {
                $poc7 = 1;
            }
            if ($poc8 < "1") {
                $poc8 = 1;
            }
            if ($poc9 < "1") {
                $poc9 = 1;
            }
            $dohromady = $poc7 + $poc8 + $poc9;
            $vysledek = "Na otazku: " . $ref[otazka] . " se pro " . $ref[odpoved1] . " vyslovilo " . $poc7 . " (" . Round($poc7 / ($poc7 + $poc8 + $poc9) * 100) . "%), pro " . $ref[odpoved2] . " se vyslovilo " . $poc8 . " (" . Round($poc8 / ($poc7 + $poc8 + $poc9) * 100) . "%) a pro " . $ref[odpoved3] . " se vyslovilo " . $poc9 . " (" . Round($poc9 / ($poc7 + $poc8 + $poc9) * 100) . "%) . Celkem hlasovalo lidí " . $dohromady . " / " . $hhh;
            if ($hhh != 0) {
                $vysledek.= " (" . Round(($poc7 + $poc8 + $poc9) / $hhh * 100) . "%).";
            } else {
                $vysledek.=".";
            };
            $zmeza.=" (Zadal: " . $zaznam1[jmeno] . ")";
            $otazka = HTMLSpecialChars($zmeza);
            $otazka = NL2BR($otazka);
            $odpo1 = HTMLSpecialChars($odpo1);
            $odpo2 = HTMLSpecialChars($odpo2);
            $odpo3 = HTMLSpecialChars($odpo3);

            MySQL_Query("update uzivatele set refa='0' WHERE (admin='1' or admin='2' or admin='3' or admin='4') ");
            MySQL_Query("update refnew set otazka='', odpoved1='', odpoved2='', odpoved3='', odpoved4='', odpoved5='' where cislo = '108' ");
            MySQL_Query("update refnew set otazka='" . $otazka . "',odpoved1='" . $odpo1 . "',odpoved2='" . $odpo2 . "',odpoved3='" . $odpo3 . "' where cislo='108'");
            MySQL_Query("update refnew set vysledek='" . $vysledek . "' where cislo='108'");
        } while (false);
    };
// Zmena admin referenda - konec
// Hlasovani v referendu - zacatek

    if (isset($nar)) {
        if ($zaznam1[refn] < "1") {
            MySQL_Query("update uzivatele set refn = '$nar' where cislo='$logcislo'");
        } else {
            echo "<font class=text_modry>Vy už jste v tomto referendu hlasoval/a!</font>";
        }
    } elseif (isset($r)) {
        if ($zaznam1[ref] < "1") {
            MySQL_Query("update uzivatele set ref = '$r' where cislo='$logcislo'");
        } else {
            echo "<font class=text_modry>Vy už jste v tomto referendu hlasoval/a!</font>";
        }
    } elseif (isset($ar)) {
        if ($zaznam1[refa] < "1") {
            MySQL_Query("update uzivatele set refa = '$ar' where cislo='$logcislo'");
        } else {
            echo "<font class=text_modry>Vy už jste v tomto referendu hlasoval/a!</font>";
        }
    } else {
        echo "";
    }

// Hlasovani v referendu - konec
// Vypocet hlasujicich hracu pro danou otazku admin...zaèátek

    if ($zaznam1[admin] == 1 or $zaznam1[admin] == 2 or $zaznam1[admin] == 3 or $zaznam1[admin] == 4) {

        $query = mysql_query("SELECT jmeno FROM uzivatele WHERE (refa='1' and (admin='1' or admin='2' or admin='3' or admin='4') ) ");
        $poc7 = mysql_num_rows($query);
        $query = mysql_query("SELECT jmeno FROM uzivatele WHERE (refa='2' and (admin='1' or admin='2' or admin='3' or admin='4') ) ");
        $poc8 = mysql_num_rows($query);
        $query = mysql_query("SELECT jmeno FROM uzivatele WHERE (refa='3' and (admin='1' or admin='2' or admin='3' or admin='4') ) ");
        $poc9 = mysql_num_rows($query);

        $refer = MySQL_Query("SELECT * FROM refnew where cislo='108'");
        $ref = MySQL_Fetch_Array($refer);
        $vys55 = MySQL_Query("SELECT jmeno,ref,refn,refa FROM uzivatele where cislo='$logcislo'");
        $zaznam55 = MySQL_Fetch_Array($vys55);

        $vys5 = MySQL_Query("SELECT jmeno FROM uzivatele WHERE (admin='1' or admin='2' or admin='3' or admin='4') ");
        $hhh = mysql_num_rows($vys5);

        echo "<h6><font class=text_modry>A</font>dminské referendum.</h6><font class='text_bili'>";
        echo "Otázka zní: <font class=text_modry>" . $ref[otazka] . "</font><br>";
        echo "Zatím odpovìdìlo: <font class=text_modry>";
        echo $poc7 + $poc8 + $poc9 . " / " . $hhh;
        if ($hhh != 0) {
            echo " (" . Round(($poc7 + $poc8 + $poc9) / $hhh * 100) . "%)</font><br />";
        };
        echo "<br>Pro <font class=text_modry>" . $ref[odpoved1] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc7 . "";
        if (($poc7 + $poc8 + $poc9) != 0)
            echo " (" . Round($poc7 / ($poc7 + $poc8 + $poc9) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved2] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc8 . "";
        if (($poc7 + $poc8 + $poc9) != 0)
            echo " (" . Round($poc8 / ($poc7 + $poc8 + $poc9) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved3] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc9 . "";
        if (($poc7 + $poc8 + $poc9) != 0)
            echo " (" . Round($poc9 / ($poc7 + $poc8 + $poc9) * 100) . "%)";
        echo "</font>";
        if ($zaznam55[refa] < "1") {
            echo "<form method='post' action='hlavni.php?page=ref'>";
            echo "<input type='radio' name='ar' value='1'";
            if ($zaznam55[refa] == "1") {
                echo " checked";
            }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='ar' value='2'";
            if ($zaznam55[refa] == "2") {
                echo " checked";
            }echo " > " . $ref[odpoved2] . "  &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='ar' value='3'";
            if ($zaznam55[refa] == "3") {
                echo " checked";
            }echo " > " . $ref[odpoved3] . " ";
            echo "<br><br><input type='submit' value='zmìò volbu'>";
            echo "</form>";
        } else {
            echo "<br>Vy jste hlasoval pro: <font class=text_modry>";
            if ($zaznam55[refa] == "1") {
                echo "" . $ref[odpoved1] . "";
            } elseif ($zaznam55[refa] == "2") {
                echo "" . $ref[odpoved2] . "";
            } elseif ($zaznam55[refa] == "3") {
                echo "" . $ref[odpoved3] . "";
            }echo "</font><p />";
        }
        echo "Výsledek minulého referenda: <font class=text_modry>" . stripslashes($ref[vysledek]) . "</font></font>";
    }
// Vypocet hlasujicich hracu pro danou otazku admin...konec
// Vypocet hlasujicich hracu pro danou otazku vesmirne...zaèátek

    $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='1'");
    $poc1 = mysql_num_rows($query);
    $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='2'");
    $poc2 = mysql_num_rows($query);
    $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='3'");
    $poc3 = mysql_num_rows($query);
    $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='4'");
    $poc4 = mysql_num_rows($query);
    $query = mysql_query("SELECT jmeno FROM uzivatele WHERE ref='5'");
    $poc5 = mysql_num_rows($query);


    $refer = MySQL_Query("SELECT * FROM refnew where cislo='0'");
    $ref = MySQL_Fetch_Array($refer);
    $vys55 = MySQL_Query("SELECT jmeno,ref,refn FROM uzivatele where cislo='$logcislo'");
    $zaznam55 = MySQL_Fetch_Array($vys55);

    $vys5 = MySQL_Query("SELECT jmeno FROM uzivatele");
    $hhh = mysql_num_rows($vys5);

    echo "<h6><font class=text_modry>C</font>elovesmírné referendum.</h6><font class='text_bili'>";
    echo "Otázka zní: <font class=text_modry>" . $ref[otazka] . "</font><br>";
    echo "Zatím odpovìdìlo: <font class=text_modry>";
    echo $poc1 + $poc2 + $poc3 + $poc4 + $poc5 . " / " . $hhh;
    if ($hhh != 0) {
        echo " (" . Round(($poc1 + $poc2 + $poc3 + $poc4 + $poc5) / $hhh * 100) . "%)</font><br />";
    };

    $j = 0;
    for ($i = 1; $i < 6; $i++) {
        if ($ref["odpoved$i"] != "") {
            $j++;
        }
    }

    if ($j == 2) {
        echo "<br>Pro <font class=text_modry>" . $ref[odpoved1] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc1 . "";
        if (($poc1 + $poc2) != 0)
            echo " (" . Round($poc1 / ($poc1 + $poc2) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved2] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc2 . "";
        if (($poc1 + $poc2) != 0)
            echo " (" . Round($poc2 / ($poc1 + $poc2) * 100) . "%)<br>";
    }

    if ($j == 3) {
        echo "<br>Pro <font class=text_modry>" . $ref[odpoved1] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc1 . "";
        if (($poc1 + $poc2 + $poc3) != 0)
            echo " (" . Round($poc1 / ($poc1 + $poc2 + $poc3) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved2] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc2 . "";
        if (($poc1 + $poc2 + $poc3) != 0)
            echo " (" . Round($poc2 / ($poc1 + $poc2 + $poc3) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved3] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc3 . "";
        if (($poc1 + $poc2 + $poc3) != 0)
            echo " (" . Round($poc3 / ($poc1 + $poc2 + $poc3) * 100) . "%)<br>";
    }

    if ($j == 4) {
        echo "<br>Pro <font class=text_modry>" . $ref[odpoved1] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc1 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4) != 0)
            echo " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved2] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc2 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4) != 0)
            echo " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved3] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc3 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4) != 0)
            echo " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved4] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc4 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4) != 0)
            echo " (" . Round($poc4 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%)<br>";
    }

    if ($j == 5) {
        echo "<br>Pro <font class=text_modry>" . $ref[odpoved1] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc1 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
            echo " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved2] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc2 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
            echo " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved3] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc3 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
            echo " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved4] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc4 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
            echo " (" . Round($poc4 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
        echo "</font>Pro <font class=text_modry>" . $ref[odpoved5] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc5 . "";
        if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
            echo " (" . Round($poc5 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
    }

    echo "</font>";
    if ($zaznam55[ref] < "1") {
        echo "<form method='post' action='hlavni.php?page=ref'>";

        if ($j == 2) {
            echo "<input type='radio' name='r' value='1'";
            if ($zaznam55[ref] == "1") {
                echo " checked";
            }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='2'";
            if ($zaznam55[ref] == "2") {
                echo " checked";
            }echo " > " . $ref[odpoved2] . " ";
        }

        if ($j == 3) {
            echo "<input type='radio' name='r' value='1'";
            if ($zaznam55[ref] == "1") {
                echo " checked";
            }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='2'";
            if ($zaznam55[ref] == "2") {
                echo " checked";
            }echo " > " . $ref[odpoved2] . "  &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='3'";
            if ($zaznam55[ref] == "3") {
                echo " checked";
            }echo " > " . $ref[odpoved3] . " ";
        }

        if ($j == 4) {
            echo "<input type='radio' name='r' value='1'";
            if ($zaznam55[ref] == "1") {
                echo " checked";
            }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='2'";
            if ($zaznam55[ref] == "2") {
                echo " checked";
            }echo " > " . $ref[odpoved2] . "  &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='3'";
            if ($zaznam55[ref] == "3") {
                echo " checked";
            }echo " > " . $ref[odpoved3] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='4'";
            if ($zaznam55[ref] == "4") {
                echo " checked";
            }echo " > " . $ref[odpoved4] . " ";
        }

        if ($j == 5) {
            echo "<input type='radio' name='r' value='1'";
            if ($zaznam55[ref] == "1") {
                echo " checked";
            }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='2'";
            if ($zaznam55[ref] == "2") {
                echo " checked";
            }echo " > " . $ref[odpoved2] . "  &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='3'";
            if ($zaznam55[ref] == "3") {
                echo " checked";
            }echo " > " . $ref[odpoved3] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='4'";
            if ($zaznam55[ref] == "4") {
                echo " checked";
            }echo " > " . $ref[odpoved4] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='r' value='5'";
            if ($zaznam55[ref] == "5") {
                echo " checked";
            }echo " > " . $ref[odpoved5] . " ";
        }

        echo "<p><input type='submit' value='zmìò volbu'>";
        echo "</form>";
    } else {
        echo "<br>Vy jste hlasoval pro: <font class=text_modry>";
        if ($zaznam55[ref] == "1") {
            echo "" . $ref[odpoved1] . "";
        } elseif ($zaznam55[ref] == "2") {
            echo "" . $ref[odpoved2] . "";
        } elseif ($zaznam55[ref] == "3") {
            echo "" . $ref[odpoved3] . "";
        } elseif ($zaznam55[ref] == "4") {
            echo "" . $ref[odpoved4] . "";
        } elseif ($zaznam55[ref] == "5") {
            echo "" . $ref[odpoved5] . "";
        }echo "</font><p />";
    }
    echo "<p>";
    echo "Výsledek minulého referenda: <font class=text_modry>" . stripslashes($ref[vysledek]) . "</font></font>";

// Vypocet hlasujicich hracu pro danou otazku vesmirne...konec

// Vypocet hlasujicich obcanu pro danou otazku rasove...zaèátek

    if ($rasa != 11 and $rasa != 0 and $rasa != 98 and $rasa != 97):

        $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='1' and rasa='$rasa'");
        $poc1 = mysql_num_rows($query);
        $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='2' and rasa='$rasa'");
        $poc2 = mysql_num_rows($query);
        $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='3' and rasa='$rasa'");
        $poc3 = mysql_num_rows($query);
        $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='4' and rasa='$rasa'");
        $poc4 = mysql_num_rows($query);
        $query = mysql_query("SELECT jmeno FROM uzivatele WHERE refn='5' and rasa='$rasa'");
        $poc5 = mysql_num_rows($query);

        $refer = MySQL_Query("SELECT * FROM refnew where cislo='$rasa'");
        $ref = MySQL_Fetch_Array($refer);

        $vys5 = MySQL_Query("SELECT jmeno FROM uzivatele where rasa='$rasa'");
        $hhh = mysql_num_rows($vys5);
        echo "<h6><font class=text_modry>N</font>árodní referendum.</h6><font class='text_bili'>";
        echo "Otázka zní: <font class=text_modry>" . $ref[otazka] . "</font><br>";
        echo "Zatím odpovìdìlo: <font class=text_modry>";
        echo $poc1 + $poc2 + $poc3 + $poc4 + $poc5 . " / " . $hhh;
        if ($hhh != 0) {
            echo " (" . Round(($poc1 + $poc2 + $poc3 + $poc4 + $poc5) / $hhh * 100) . "%)</font><br />";
        }
        //******************************

        $j = 0;
        for ($i = 1; $i < 6; $i++) {
            if ($ref["odpoved$i"] != "") {
                $j++;
            }
        }
        if ($j == 2) {
            echo "<br>Pro <font class=text_modry>" . $ref["odpoved1"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc1 . " ";
            if (($poc1 + $poc2) != 0)
                echo " (" . Round($poc1 / ($poc1 + $poc2) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved2"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc2 . " ";
            if (($poc1 + $poc2) != 0)
                echo " (" . Round($poc2 / ($poc1 + $poc2) * 100) . "%)<br>";
            echo "</font>";
        }

        if ($j == 3) {
            echo "<br>Pro <font class=text_modry>" . $ref["odpoved1"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc1 . " ";
            if (($poc1 + $poc2 + $poc3) != 0)
                echo " (" . Round($poc1 / ($poc1 + $poc2 + $poc3) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved2"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc2 . " ";
            if (($poc1 + $poc2 + $poc3) != 0)
                echo " (" . Round($poc2 / ($poc1 + $poc2 + $poc3) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved3"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc3 . " ";
            if (($poc1 + $poc2 + $poc3) != 0)
                echo " (" . Round($poc3 / ($poc1 + $poc2 + $poc3) * 100) . "%)<br>";
            echo "</font>";
        }

        if ($j == 4) {
            echo "<br>Pro <font class=text_modry>" . $ref["odpoved1"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc1 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4) != 0)
                echo " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved2"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc2 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4) != 0)
                echo " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved3"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc3 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4) != 0)
                echo " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved4"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc4 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4) != 0)
                echo " (" . Round($poc4 / ($poc1 + $poc2 + $poc3 + $poc4) * 100) . "%)<br>";
            echo "</font>";
        }

        if ($j == 5) {
            echo "<br>Pro <font class=text_modry>" . $ref["odpoved1"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc1 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
                echo " (" . Round($poc1 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved2"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc2 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
                echo " (" . Round($poc2 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved3"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc3 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
                echo " (" . Round($poc3 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved4"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc4 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
                echo " (" . Round($poc4 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
            echo "</font>Pro <font class=text_modry>" . $ref["odpoved5"] . "</font> zatím hlasovalo: <font class=text_modry>" . $poc5 . " ";
            if (($poc1 + $poc2 + $poc3 + $poc4 + $poc5) != 0)
                echo " (" . Round($poc5 / ($poc1 + $poc2 + $poc3 + $poc4 + $poc5) * 100) . "%)<br>";
            echo "</font>";
        }

        //*******************************
        if ($zaznam55[refn] < "1") {
            echo "<form method='post' action='hlavni.php?page=ref'>";
            //**********************************************

            if ($j == 2) {
                echo "<input type='radio' name='nar' value='1'";
                if ($zaznam55[refn] == "1") {
                    echo " checked";
                }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='2'";
                if ($zaznam55[refn] == "2") {
                    echo " checked";
                }echo " > " . $ref[odpoved2];
            }

            if ($j == 3) {
                echo "<input type='radio' name='nar' value='1'";
                if ($zaznam55[refn] == "1") {
                    echo " checked";
                }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='2'";
                if ($zaznam55[refn] == "2") {
                    echo " checked";
                }echo " > " . $ref[odpoved2] . "  &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='3'";
                if ($zaznam55[refn] == "3") {
                    echo " checked";
                }echo " > " . $ref[odpoved3];
            }

            if ($j == 4) {
                echo "<input type='radio' name='nar' value='1'";
                if ($zaznam55[refn] == "1") {
                    echo " checked";
                }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='2'";
                if ($zaznam55[refn] == "2") {
                    echo " checked";
                }echo " > " . $ref[odpoved2] . "  &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='3'";
                if ($zaznam55[refn] == "3") {
                    echo " checked";
                }echo " > " . $ref[odpoved3] . "   &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='4'";
                if ($zaznam55[refn] == "4") {
                    echo " checked";
                }echo " > " . $ref[odpoved4];
            }

            if ($j == 5) {
                echo "<input type='radio' name='nar' value='1'";
                if ($zaznam55[refn] == "1") {
                    echo " checked";
                }echo " > " . $ref[odpoved1] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='2'";
                if ($zaznam55[refn] == "2") {
                    echo " checked";
                }echo " > " . $ref[odpoved2] . "  &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='3'";
                if ($zaznam55[refn] == "3") {
                    echo " checked";
                }echo " > " . $ref[odpoved3] . "   &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='4'";
                if ($zaznam55[refn] == "4") {
                    echo " checked";
                }echo " > " . $ref[odpoved4] . " &nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='nar' value='5'";
                if ($zaznam55[refn] == "5") {
                    echo " checked";
                }echo " > " . $ref[odpoved5];
            }

            //**********************************************
            echo "<br><br><input type='submit' value='zmìò volbu'>";
            echo "</form>";
        } else {
            echo "<br>Vy jste hlasoval pro: <font class=text_modry>";
            if ($zaznam55[refn] == "1") {
                echo "" . $ref[odpoved1] . "";
            } elseif ($zaznam55[refn] == "2") {
                echo "" . $ref[odpoved2] . "";
            } elseif ($zaznam55[refn] == "3") {
                echo "" . $ref[odpoved3] . "";
            } elseif ($zaznam55[refn] == "4") {
                echo "" . $ref[odpoved4] . "";
            } elseif ($zaznam55[refn] == "5") {
                echo "" . $ref[odpoved5] . "";
            }echo "</font><p />";
        }
        echo "<p>";
        echo "Výsledek minulého referenda: <font class=text_modry>" . stripslashes($ref[vysledek]) . "</font></font>";
        echo "<p />";
        echo "<hr color='#0099FF'>";

        // Vypocet hlasujicich obcanu pro danou otazku rasove...konec


        if (($zaznam1[status] == 1) or ($zaznam1[status] == 2) or ($zaznam1[status] == 5)):
//--------------        
    echo "<form method='post' action='hlavni.php?page=ref'>";
            echo "<h6><font class=text_modry>Z</font>mìnit národní referndum.</h6><font class='text_bili'>";

            echo "Vyberte poèet odpovìdí: &nbsp;<select name='pocodn'>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    </select> &nbsp;<input type='submit' value='Vyber'><p />";

            if ($pocodn == 2) {
                
                echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=znar size=80><p>";
                echo "1.Odpovìï: <input name=odpo1 size=80><br>
    2.Odpovìï: <input name=odpo2 size=80><br>";
                echo "<br></font><input type='submit' value='zmìò referendum'>";
            }

            if ($pocodn == 3) {
                echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=znar size=80><p>";
                echo "1.Odpovìï: <input name=odpo1 size=80><br>
    2.Odpovìï: <input name=odpo2 size=80><br>
    3.Odpovìï: <input name=odpo3 size=80><br>";
                echo "<br></font><input type='submit' value='zmìò referendum'>";
            }

            if ($pocodn == 4) {
                echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=znar size=80><p>";
                echo "1.Odpovìï: <input name=odpo1 size=80><br>
    2.Odpovìï: <input name=odpo2 size=80><br>
    3.Odpovìï: <input name=odpo3 size=80><br>
    4.Odpovìï: <input name=odpo4 size=80><br>";
                echo "<br></font><input type='submit' value='zmìò referendum'>";
            }

            if ($pocodn == 5) {
                echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=znar size=80><p>";
                echo "1.Odpovìï: <input name=odpo1 size=80><br>
    2.Odpovìï: <input name=odpo2 size=80><br>
    3.Odpovìï: <input name=odpo3 size=80><br>
    4.Odpovìï: <input name=odpo4 size=80><br>
    5.Odpovìï: <input name=odpo5 size=80><br>";
                echo "<br></font><input type='submit' value='zmìò referendum'>";
echo "</form>";
            }
            echo "</form>";
        endif;
        echo "</form>";
    endif;
//echo "</form>";

//--------------

//---

//---

    if ($zaznam1[admin] == 1 or $zaznam1[admin] == 2):
        echo "<form method='post' action='hlavni.php?page=ref'>";
        echo "<h6><font class=text_modry>Z</font>mìnit celovesmírné referendum.</h6><font class='text_bili'>";

        echo "Vyberte poèet odpovìdí: &nbsp;<select name='pocodc'>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    </select> &nbsp;<input type='submit' value='Vyber'><p />";

        if ($pocodc == 2) {
            echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='zmez' size=80><p>";
            echo "1.Odpovìï: <input name='odpo1' size=80><br>
    2.Odpovìï: <input name='odpo2' size=80><br>";
            echo "<br></font><input type='submit' value='zmìò referendum'>";
        }

        if ($pocodc == 3) {
            echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='zmez' size=80><p>";
            echo "1.Odpovìï: <input name='odpo1' size=80><br>
    2.Odpovìï: <input name='odpo2' size=80><br>
    3.Odpovìï: <input name='odpo3' size=80><br>";
            echo "<br></font><input type='submit' value='zmìò referendum'>";
        }

        if ($pocodc == 4) {
            echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='zmez' size=80><p>";
            echo "1.Odpovìï: <input name='odpo1' size=80><br>
    2.Odpovìï: <input name='odpo2' size=80><br>
    3.Odpovìï: <input name='odpo3' size=80><br>
    4.Odpovìï: <input name='odpo4' size=80><br>";
            echo "<br></font><input type='submit' value='zmìò referendum'>";
         
        }

        if ($pocodc == 5) {
            echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='zmez' size=80><p>";
            echo "1.Odpovìï: <input name='odpo1' size=80><br>
    2.Odpovìï: <input name='odpo2' size=80><br>
    3.Odpovìï: <input name='odpo3' size=80><br>
    4.Odpovìï: <input name='odpo4' size=80><br>
    5.Odpovìï: <input name='odpo5' size=80><br>";
            echo "<br></font><input type='submit' value='zmìò referendum'>";
        }

        echo "</form>";
    endif;
  echo "</form>";

    if ($zaznam1[admin] == 1 or $zaznam1[admin] == 2 or $zaznam1[admin] == 3 or $zaznam1[admin] == 4):
        echo "<form method='post' action='hlavni.php?page=ref'>";
        echo "<h6><font class=text_modry>Z</font>mìnit adminské referendum.</h6><font class='text_bili'>";


        echo "Otázka: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='zmeza' size=80><p>";
        echo "1.Odpovìï: <input name='odpo1' size=80><br>
    2.Odpovìï: <input name='odpo2' size=80><br>
    3.Odpovìï: <input name='odpo3' size=80><br>";
        echo "<br></font><input type='submit' value='zmìò referendum'>";

        echo "</form>";
    endif;




    echo "</font>";
        echo "</form>";
//	MySQL_Close($spojeni);		
    ?>
</div>

