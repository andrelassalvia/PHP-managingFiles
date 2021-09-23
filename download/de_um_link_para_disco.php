<?php

/* Podemos solicitar que o PHP contate diretamente um terceiro servidor e baixe o arquivo desejado de lá*/
$link = "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png";

$content = file_get_contents($link); // file_get_contents aceita tanto um arquivo local como um link externo

// Nesse caso, como trata-se de um arquivo externo, precisamos jogá-lo dentro de um arquivo fisico
// Para isso precisamos interpretar a URL através de um parse
$parse = parse_url($link);
/*var_dump($parse);*/ // "/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png"
// so precisamos do googlelogo pra frente, que é o basename do link na chave 'path'

$basename = basename($parse['path']);
var_dump($basename);

// vamos gravar em disco o $basename
$file = fopen($basename, 'w+');

// para escrever dentro do arquivo:
fwrite($file, $content);

fclose($file);

?>

<img src="<?=$basename?>" alt="logo google">

