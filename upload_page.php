<?php
	require_once('fileupload-class.php');
	
	
	/* Create a new instance of the class
	 * 
	 * @examples:	$f = new uploader(); 		// English error messages
	 *				$f = new uploader('fr');	// French error messages
	 *				$f = new uploader('de');	// German error messages
	 *				$f = new uploader('nl');	// Dutch error messages
	 *				$f = new uploader('it');	// Italian error messages
	 *				$f = new uploader('fi');	// Finnish error messages
	 *				$f = new uploader('es');	// Spanish error messages
	 *				$f = new uploader('no');	// Norwegian error messages
	 *				$f = new uploader('da');	// Danish error messages
	 */
	$my_uploader = new uploader('en'); 
	
	
	// Set the max filesize of uploadable files in bytes
	$my_uploader->max_filesize(90000);
	
	
	// For images, you can set the max pixel dimensions 
	$my_uploader->max_image_size(150, 300); // ($width, $height)
	
	
	// UPLOAD the file
	$my_uploader->upload("userfile", "", ".jpg");
	
	
	// MOVE THE FILE to its final destination
	//	$mode = 1 ::	overwrite existing file
	//	$mode = 2 ::	rename new file if a file
	//	           		with the same name already 
	//             		exists: file.txt becomes file_copy0.txt
	//	$mode = 3 ::	do nothing if a file with the
	//	           		same name already exists
	$mode = 2;
	$my_uploader->save_file("uploads/", $mode);
	
	
	// Check if everything worked
	if ($my_uploader->error) {
		echo $my_uploader->error . "<br>";
	
	} else {
		// Successful upload!
		print($my_uploader->file['name'] . " was successfully uploaded!<br><br>\n");
		
		// If it's an image, let's display the file
		if(stristr($my_uploader->file['type'], "image")) {
			echo "<img src=\"uploads/" . $my_uploader->file['name'] . "\" border=\"0\" alt=\"\"><br><br>\n";
		}

	
	}
?>
