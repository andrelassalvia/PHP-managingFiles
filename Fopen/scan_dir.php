<?php
// scan dir
$images = scandir("images"); // return will be an array. We can use a foreach to run along
var_dump($images);
$data = array();

foreach ($images as $img) { // the first 2 positions in array are . and ..
    if(!in_array($img, array('.','..'))){ // check if the value exist in array

        $fileName = 'images'.DIRECTORY_SEPARATOR.$img;
        $info = pathinfo($fileName); // returns informations about a file path
        $info['size'] = filesize($fileName); // gets de file size
        $info["modified"] = date('d/m/Y H:i:s', filemtime($fileName)); // filemtime - format a local time date about file modification
        $info["url"] = "http://localhost/hcode/11-Manipulando%20Arquivos/".$fileName;  // acess by URL
        array_push($data, $info);
        
    } 
}

echo json_encode($data);

