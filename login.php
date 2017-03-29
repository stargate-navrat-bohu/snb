require "session.php";
<FORM name=form action=index.php method=post>
<INPUT type=hidden value=1 name=zpracuj>
<input type='hidden' name='over_post' value='1'>
<div class="menu" id="login">
<div class="nadpis">
Přihlášení
</div>
<div class="login">
<div class="name">
Jméno:
<input name="jmeno1" type="text" class="input" size="13">
</div>
<div class="passw">
Heslo:
<input name="heslo1" type="password" class="input" size="13">
</div>
<div class="rem">
Zapomněl jsem heslo
</div>
<div class="pass">
<input type="submit" class="button" value="Přihlásit se">
</div>
</div>
<div class="spodek">
</div>
</div>
</form>
 
<div class="menu">
<div class="nadpis">
Info
</div>
<div class="sub">
<a href="index.php?page=registrace">Zaregistrovat se</a>
</div>
<div class="sub">
<a href="index.php?page=smazat">Smazat login</a>
</div>
<div class="sub">
<a href="index.php?page=stat">Statistiky ras</a>
</div>
<div class="sub">
<a href="./help/">Help</a>
</div>
<div class="sub">
<a href="index.php?page=novinky">Novinky</a>
</div>
<div class="sub">
<a href="index.php?page=credits">Credits</a>
</div>
<div class="spodek">
</div>
</div>
