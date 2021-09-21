<?php

// fgetsContent => to read files like images or others binary files.
$filename = 'html5.png';

$base64 = base64_encode(file_get_contents($filename)); // base 64 - convert a binary in text

// create dinamyc classes
$fileinfo = new finfo(FILEINFO_MIME_TYPE); //constructor method to get the file type. Use to change automaticaly the pattern

$mimetype = $fileinfo->file($filename);

$base64encode = "data:".$mimetype.";base64,".$base64;

// exibition pattern
// echo "data:".$mimetype."; base64,".$base64;
?>


<a href="<?=$base64encode?>">Link</a>
<img src="<?=$base64encode?>">