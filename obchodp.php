<?php
$vysp = MySQL_Query("SELECT nazev,cislo,majitel FROM planety where majitel='$logcislo'");
?>
<form name="form1">
    <select name="planety">
        <?php while ($planety = MySQL_Fetch_Array($vysp)): ?>
        <option value="<?= $planety['nazev'] ?>"><?= $planety['nazev'] ?></option>
        <?php endwhile ?>
    </select>
    <input type="submit" name="Submit" value="Prodat">
</form>