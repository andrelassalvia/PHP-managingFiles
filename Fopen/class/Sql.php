<?php

// // Nesta classe vamos colocar todos os comandos basicos do sql. Vai fazer a query no BD

// class Sql extends PDO {
//     // criar uma private da conexao
//     private $conn;

//     // queremos que a classe conecte automaticamente quando chamada (metodo construtor)
//     public function __construct(){
//         $this->conn = new PDO ("mysql: host=localhost; dbname=db_php7", "root", "");
//     }

//     // criamos uma funcao para receber qualquer parametro
//     private function setParams($statement, $parameters = array()){ // da mesma forma precisa receber o statement e os dados
//         foreach ($parameters as $key => $value) {
//             $this->setParam($key, $value);
//         }
//     }

//     // e outra se for somente 1 parametro
//     private function setParam($statement, $key, $value){
//         $statement->bindParam($key, $value);
//     }

//     // e como executo comandos na classe? prepare, bind, execute etc...
//     // para fazer isso vamos chamar um metodo chamado query
//     public function query($rawQuery, $params = array()){ //$rawQuery recebe os comandos  SQL, $params recebe os dados recebidos pelos comandos
//         // vamos fazer o prepare com $rawQuery como parametro
//         $stmt = $this->conn->prepare($rawQuery);
//         // vamos fazer um foreach para percorrer a array de parametros
//         $this->setParams($stmt, $params);
//         $stmt->execute();
//         return $stmt;

//     }
// // vamos pensar num metodo para o select
    
//     public function select($rawQuery, $params = array()){
//         $stmt = $this->query($rawQuery, $params);
//         // precisamos fazer o fetch
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);

//     }
// }

class Sql extends PDO {

    private $conn;

    public function __construct() { // conecta automatico

        $this->conn = new PDO("mysql:host=localhost;dbname=db_php7", "root", "");

    }

    private function setParams($statment, $parameters = array()) {

        foreach ($parameters as $key => $value) {

            $this->setParam($statment, $key, $value);

        }

    }

    private function setParam($statment, $key, $value){

        $statment->bindParam($key, $value);

    }

    public function query($rawQuery, $params = array()) {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

    }

    public function select($rawQuery, $params = array()):array
    {

        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}