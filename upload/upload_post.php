<form method="post" enctype="multipart/form-data"> <!-- this enctype send any type of data -->

    <input type="file" name="upFile"> <!-- Return the message "Choose a File" -->

    <button type="submit">Send</button>

</form>


<?php

// if we are sending, is a post

if($_SERVER["REQUEST_METHOD"] === "POST"){ // if the method in the server is a post

    // lets retrieve the file $_POST we use to strings. Here we will use $_FILES
    $file = $_FILES["upFile"];  // A variable to store all datas about the file that we are receiving from the FORM

    // if we have any error in this array
    if ($file["error"]){

        throw new Exception("Error ".$file["error"]); // the message about the error is within $file["error"]
        
    }

    // Let's create a variable to store the directory name that will receive the uploads. Must be a directory out of the PHP
    $dirUploads = 'uploads';

    // let's check wether this folder exists or not
    if(!is_dir($dirUploads)){

        // if not exist, create it
        mkdir($dirUploads);
    }

    // now let's do the upload
    if(move_uploaded_file($file["tmp_name"], $dirUploads.DIRECTORY_SEPARATOR.$file["name"])){

        echo "Upload done!😁";
    } else{
        throw new Exception("Error Processing Upload");
        
    }; // result is TRUE or FALSE
}

?>