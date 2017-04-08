<?php
/**
 * Temporary file with functions created (or moved from) during refactoration 
 * from the original source codes.
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link https://github.com/stargate-navrat-bohu/snb for the canonical source repository
 */

/**
 * Prints login area (login form or message why user can not perform login).
 * @global int $restart_1
 * @return void
 */
function print_login() {
    global $restart_1;

    if ($restart_1 == 0) {
        echo 'Probíhá restart hry.';
        return;
    }

    $vys6 = MySQL_Query("SELECT jmeno FROM online");
    $o = mysql_num_rows($vys6);

    if ($o <= 80) {
        echo '<font class="text_zeleny">Omlouváme se, ale již je přihlášeno příliš hráčů. Děkujeme za pochopení.</font>';
        return;
    }
?>
<form name="form" action="index.php" method="post">
    <input type="hidden" value="1" name="zpracuj">
    <input type="hidden" name="over_post" value="1">
    <div class="pri_jmeno">Jméno: <input name="jmeno1" type="text" class="input" size="13"></div>
    Heslo: &nbsp;&nbsp;<input name="heslo1" type="password" class="input" size="13">
    <div class="logo_prihlaseni2">
        <input type="submit" value="Přihlásit se" class="button">
    </div>
</form>
<?php
}



/**
 * Format float number.
 * @param float $a
 * @return string
 */
function fcis($a) {
    return number_format($a , 0, '', ' ');
}



/**
 * @global string $zold_nazev
 * @param string $prefix
 * @param array $arr1
 * @param array $arr2
 * @return string
 */
function print_casualties($prefix, $arr1, $arr2) {
    global $zold_nazev;

    if ($arr1[$prefix.'jed1'] > 0) {
        return $arr1[$prefix.'jed1'].' * '.$arr2['jed1_nazev'];
    }
    if ($arr1[$prefix.'jed5'] > 0) {
        return $arr1[$prefix.'jed5'].' * '.$zold_nazev;
    }
    if ($arr1[$prefix.'jed2'] > 0) {
        return $arr1[$prefix.'jed2'].' * '.$arr2['jed2_nazev'];
    }
    if ($arr1[$prefix.'jed4'] > 0) {
        return $arr1[$prefix.'jed4'].' * '.$arr2['jed4_nazev'];
    }
    if ($arr1[$prefix.'jed1'] < 1 && $arr1[$prefix.'jed2'] < 1 && $arr1[$prefix.'jed4'] < 1 && $arr1[$prefix.'jed5'] < 1) {
        return 'Źádné';
    }

    return '';
}
