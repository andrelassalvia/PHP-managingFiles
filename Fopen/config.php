<?php

// spl_autoload_register(function ($class_name){

//     $fileName = $class_name.'.php';

//     if(file_exists($fileName)){
//         require_once($fileName);

//     }
// });

spl_autoload_register(function($class_name){

    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

    if (file_exists(($filename))) {

        require_once($filename);

    }

});