<?php

// vamos criar 2 diretorios para podermos mover um arquivo que está em um dos diretorios para o outro
$dir1 = "folder_01";
$dir2 = "folder_02";

if(!is_dir($dir1)) mkdir($dir1);
if(!is_dir($dir2)) mkdir($dir2);

// vamos criar um arquivo dentro da pasta 01
$filename = "README.txt"; // criamos um arquivo chamado readme.txt

$address1 = $dir1.DIRECTORY_SEPARATOR.$filename;
$address2 = $dir2.DIRECTORY_SEPARATOR.$filename;
if(!file_exists($address1)){//se o readme.txt nao existir dentro da pasta dir1

    $file = fopen($address1, "w+"); //criaremos o readme.txt dentro da pasta dir1 e posicionaremos o cursor no começo do arquivo para escrever 
    fwrite($file, date("Y-m-d H:i:s")); // escreva a data dentro do arquivo readme.txt
    fclose($file); // abrimos uma edicao no cache, fechamos a edicao no cache.
}

// AGORA VAMOS MOVER O ARQUIVO README.TXT DO DIR1 PARA O DIR2
// rename() -> funcao utilizada para mover arquivos
// rename("caminho de onde está o arquivo", "caminho para onde vai o arquivo")  
rename($address2, $address1);