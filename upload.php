<?
if (is_uploaded_file($soubor)) { if ($soubor_type == "image/jpg") 
{ if (move_uploaded_file ($soubor, "data/$soubor_name")) 
{ print "Soubor $soubor_name o velikosti $soubor_size bajt� byl �sp�n� uploadnut na server
"; } else { print "P�i nahr�v�n� souboru do�lo k chyb�!
"; } } else { print "Soubor nen� po�adov�ho typu!
"; } }
?>
