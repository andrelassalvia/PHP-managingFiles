<?php

require_once("config.php");

$sql = new Sql();
$usuarios = $sql->select("SELECT * from tb_usuarios ORDER BY deslogin");
$headers = array();

foreach ($usuarios[0] as $key => $value) {
    array_push($headers, ucfirst($key));
}

// to print a comma we use the implode() function. Expected 2 parameters -> the delimiter and the array

$file = fopen("usuarios.csv", "w+");
fwrite($file, implode(",", $headers)."\r\n");

foreach ($usuarios as $row) {
    $data = array();

    foreach ($row as $key => $value) {
        array_push($data, $value);
    }
    fwrite($file, implode(",", $data)."\r\n");
}
fclose($file);
echo "usuarios.csv is done!";

