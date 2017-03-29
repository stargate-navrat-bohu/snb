<?php

require "session.php";

/*

$refer = getenv("HTTP_REFERER");

$PARAMS = explode('/', $refer); 



if ($PARAMS[2]=='http://sg-nb.cz' OR $PARAMS[2]==NULL):

*/

//-----------------------------------------------------

  @$server = "localhost";

   @$user = "root";

   @$password = "root";

   @$base = "textova-hra";

@$spojeni = mysql_connect($server, $user, $password);// or die ('<script languague="JavaScript">location.href="podpora_vypadek.php"</script>');

@$vysledek = mysql_select_db("$base",$spojeni);// or die ('<script languague="JavaScript">location.href="podpora_vypadek.php"</script>');

//mysql_query("USE `$base`") or die('<script languague="JavaScript">location.href="podpora_vypadek.php"</script>');

//-----------------------------------------------------

/*else:

endif;*/

?>