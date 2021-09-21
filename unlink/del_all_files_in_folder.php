<?php

// Let's erase all files in a folder
if (!is_dir('images')) mkdir('images'); //create a directory

$images = scandir('images'); // scan folder images
foreach ($images as $img) { // for each image in the folder
    if (!in_array($img, array('.','..'))){ // check if the array is a . or ..
        unlink('images/'.$img); // delete images in the folder
    }
}
