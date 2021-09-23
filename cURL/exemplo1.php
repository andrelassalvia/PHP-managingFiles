<?php

// cURL é uma biblioteca

$cep = "01310100";
$link =  "https://viacep.com.br/ws/$cep/json/"; // url para o json de qualquer cep no brasil

// iniciar a biblioteca curl
$ch = curl_init($link); // a biblioteca curl vai interpretar o link e trazer o json sempre atualizado

/*curl_setopt(qual a biblioteca iniciada, informar que espero retorno da informacao enviada, 1 = vai e volta);*/  // define algumas opcoes para a biblioteca curl

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //PARA FUGIR DA VALIDACAO HTTPS

$response = curl_exec($ch); // depois de definir as opcoes acima é aqui que executamos a secao. Vai retornar um json

curl_close($ch); //para encerrar a secao. O que queremos ja esta em $response.

// vamos transformar o json do $response em um array

$data = json_decode($response, true);  // o true serve para virar array. Se nao o informarmos, ele decodifica o json e vira objeto.
print_r($data);