<?php

// Para recuperar um cookie vamos utilizar um array super global ($_cookie)que recupera os cookies que estao na maquina da pessoa

if(isset($_COOKIE["NOME_DO_COOKIE"])){
    $obj = json_decode($_COOKIE["NOME_DO_COOKIE"]);
    echo $obj->empresa;
}
