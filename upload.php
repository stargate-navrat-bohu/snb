<?
if (is_uploaded_file($soubor)) { if ($soubor_type == "image/jpg") 
{ if (move_uploaded_file ($soubor, "data/$soubor_name")) 
{ print "Soubor $soubor_name o velikosti $soubor_size bajtù byl úspìšnì uploadnut na server
"; } else { print "Pøi nahrávání souboru došlo k chybì!
"; } } else { print "Soubor není požadového typu!
"; } }
?>
