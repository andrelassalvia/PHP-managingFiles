<?php

class Usuario {

    private $id_usuario;
    private $deslogin;
    private $dessenha;
    private $dt_cadastro;

    public function getIdusuario(){
        return $this->id_usuario;
    }

    public function setIdusuario($value){
        $this->id_usuario = $value;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dt_cadastro;
    }

    public function setDtcadastro($value){
        $this->dt_cadastro = $value;
    }



    // =================================================================== //
    // =============   ENCONTRAR COM ID ========================= //
   
    // criar uma funcao para carregar os dados do usuario pelo seu id_usuario
    // Como se estivessemos fazendo um set dos dados que estao no BD nos atributos para depois recuperarmos estes dados via get e mostrar na tela

    public function loadById($id){
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID", array( //mesma logica do python
            ":ID"=>$id
        ));

        if (isset($result[0])){ // se existir o Id mencionado...
            // $row = $result[0];
            // $this->setIdusuario($row['id_usuario']); // =1 - pega o valor 1 que esta em id_usuario e aplica a funcao set para modificar o atributo $id_usuario.
            // $this->setDeslogin($row['deslogin']); // = user
            // $this->setDessenha($row['dessenha']); // = 12345
            // $this->setDtcadastro(new DateTime($row['dt_cadastro'])); // = 2021-09-08 12:46:49

            $this->setData($result[0]);
        } else{
            throw new Exception ('Inexiste esse caboclo');
        }
    }

// ======================================================================================= //




// ======================================================================================= //
// ====================== LISTA TODOS =================================================== //

    // Vamos criar um metodo para trazer todos os usuarios que estao em uma tabela
    // Como esta funcao nao vai ter $this-> podemos nomina-la como estatica.
    // Nao ter $this significa que podemos utiliza-la dentro e fora deste escopo.
    public static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
    }
// ======================================================================================= //



// ====================================================================== //
// ================ BUSCA - SEARCH ==================================== //

    // Vamos criar uma funcao de busca
    public static function search($login){

        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin like :SEARCH ORDER BY deslogin", array( // like tests whether a string contains a specified pattern or not. VEM DO SQL
            ":SEARCH"=>'%'.$login.'%' // The percentage ( % ) wildcard matches any string of zero or more characters. VEM DO SQL
        ));
    }
// ========================================================================================= //



// ================================================================================ //
// ===================== AUTENTICACAO USUARIO ================================ //

    // Vamos criar uma AUTENTICACAO. Por exemplo, retorna as informacoes caso o login e a senha estejam corretos
    // Basta passar um AND dentro do SELECT

    public function login($login, $password){

        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :ID AND dessenha = :SENHA", array(
            ':ID'=>$login,
            ':SENHA'=>$password
        ));

        if(isset($result[0])){
           $this->setData($result[0]);
            
        } else{
            throw new Exception ('Inexiste esse caboclo');
        }

    }

// ====================================================================================== //




// ==================================================================================== //
// ================ INSERCAO DE DADOS ====================================== //

// Vamos CRIAR UM NOVO USUARIO a partir dos metodos
// Vamos utilizar uma standart procedure do SQL para isso

public function insert(){

    $sql = new Sql();

    $result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
        ':LOGIN'=>$this->getDeslogin(),
        ':PASSWORD'=>$this->getDessenha()
    ));
    if (count($result) > 0){
       
        $this->setData($result[0]);
       
    } else {
        throw new Exception ('Vixe');
    }
    
}

// ================================================================== //



// ================================================================== //
// ============== UPDATE DADOS =========================== //

public function update($login, $password){

    $this->setDeslogin($login);
    $this->setDessenha($password);

    $sql = new Sql();

    $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE id_usuario = :ID", array(
        ':LOGIN'=>$this->getDeslogin(),
        ':PASSWORD'=>$this->getDessenha(),
        ':ID'=>$this->getIdusuario()
    ));
}

// ================================================================== //




// ================================================================== //
// ============== DELETE DADOS =========================== //
    public function delete($id){

        $sql = new Sql();

        $result = $sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :ID", array(
            'ID'=>$id
        ));

        // if(isset($result[0])){
        //     echo 'Usuario deletado 🧏🏻‍♂️';
        // }else{
        //     throw new Exception ('Usuario nao existe');
        // }
    }

// ================================================================== //



// trecho de codigo repetido
    public function setData($data){

        $this->setIdusuario($data['id_usuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dt_cadastro']));
        
    }

// Metodo magico para 

    public function __toString(){ // para fazer o get e mostrar na tela

        return json_encode(array(
            'id_usuario'=>$this->getIdusuario(),
            'deslogin'=>$this->getDeslogin(),
            'dessenha'=>$this->getDessenha(),
            'dt_cadastro'=>$this->getDtcadastro()
        ));
    }

    public function __construct($login = '', $password = ''){ // se chamar a classe Usuario com login e senha otimo se nao chamar o = '' toma o lugar

        $this->setDeslogin($login);
        $this->setDessenha($password);
    }
}

