<?php

// funcao para definir/criar um cookie
// setcookie(nome do cookie, informacoes que deseja guardar, tempo de permanencia em unix timestamp do cookie na maquina);

$data = array(
    "empresa" => "Hcode Treinamentos",
);

setcookie("NOME_DO_COOKIE", json_encode($data), time() + 3600 );

echo 'ok';