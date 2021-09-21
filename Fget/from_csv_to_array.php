<?php

// Retrieving csv content and reading as array

$filename = 'usuarios.csv';

if(file_exists($filename)){
    $file = fopen($filename, 'r'); // open and read
    
    // $headers = fgets($file);
    // var_dump($headers);
    $headers = explode(',', fgets($file)); // The first line is the header
    // echo json_encode($headers);

    $data = array(); // create an array to put all usuarios.csv content

    while($row = fgets($file)){ // while are lines to be read
        $rowData = explode(',', $row); // transform the line in array
        // echo json_encode($rowData);
        $line = array(); // create an array to receive the line

        for ($i=0; $i < count($headers) ; $i++) { 
            $line[$headers[$i]] = $rowData[$i]; // Key => value
            
        }

        array_push($data, $line);

    // 
    }
    echo json_encode($data);

    fclose($file);
}



