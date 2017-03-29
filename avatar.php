<?

if(!$_POST["send"]){ header("Location: hlavni.php?page=info"); }

  $ok=1; 			// pomocna promenna
  $adresar = "avatary/";	// adresar pro ukladani souboru (lomitko je dulezite!)
  $avart["sirka"] = 100;
  $avart["vyska"] = 100;
  $avart["size"] = 100; // maximalni velikost v kB

if($soubor){
  if(is_uploaded_file($soubor)){
    
    if($soubor_size>$avart["size"]*1024){ 
      $error .= "Soubor <strong>$soubor_name</strong> má vìtsí velikost než stanovená maximální velikost souboru, která èiní ".$avart["size"]." kB.";
      $ok=0;
    } else if($avart_size[0]>$avart["sirka"] or $avart_size[1]>$avart["vyska"]){
      $error .= "Soubor je vìt‘í než ".$avart["sirka"]."x".$avart["vyska"]." pixelù";
      $ok=0;
    }
    
    $avart_nazev = $logcislo.strtolower(substr($soubor_name, strlen($soubor_name)-4));
    if($ok==1){
      if ($_FILES['soubor']['type'] == "image/jpeg" or $_FILES['soubor']['type']="image/gif" or $_FILES['soubor']['type']="image/jpg")
      //if($soubor_type=="image/jpg" or $soubor_type=="image/jpeg" or $soubor_type=="image/gif")
      {
        if(move_uploaded_file($soubor, $adresar.$avart_nazev)){
        
          chmod($adresar.$avart_nazev, 0664);
          header("Location: hlavni.php?page=nastav&avart_ok=1");
        }
      } else {
        $error .= "Soubor není požadového typu!";      
      }
    } 
  }
}



?> 
<HTML>
<HEAD>
<TITLE>Upload souboru</TITLE>
</HEAD>
<BODY>

<? echo $error; ?><br> <br>
<a href="hlavni.php?page=nastav">Zpìt</a>

</BODY>
</HTML> 
