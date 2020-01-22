<?php

class Cadastro{
    public $id;
    public $nome;
    public $cpf;
    public $email;
    public $foto;
    public $senha;
    public $nick;


    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os cadastros cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela cadastro 
        $query = "select * from cadastro";

        /*
        Foi criada a variavel stmt(Statment -> Sentença) para guardar a preparação da consulta
        select que será executada posteriomente.
        */

        $stmt = $this -> conexao -> prepare ($query);

        #execução da consulta a guarda de dados na variavel stml

        $stmt->execute();

        #retorna os dados do usuario a camada data.
        return $stmt;
    }



    public function pesquisar_id(){
        #Selecione todos os campos da tabela cadastro 
        $query = "select * from cadastro where id=?";

        /*
        Foi criada a variavel stmt(Statment -> Sentença) para guardar a preparação da consulta
        select que será executada posteriomente.
        */

        $stmt = $this -> conexao -> prepare ($query);
        $stmt->bindParam(1,$this->id);

        #execução da consulta a guarda de dados na variavel stml

        $stmt->execute();

        #retorna os dados do usuario a camada data.
        return $stmt;
    }

    public function pesquisar_nome(){
        #Selecione todos os campos da tabela cadastro 
        $query = "select * from cadastro where nome like ?";

        /*
        Foi criada a variavel stmt(Statment -> Sentença) para guardar a preparação da consulta
        select que será executada posteriomente.
        */

        $stmt = $this -> conexao -> prepare ($query);
        $stmt->bindParam(1,$this->nome);

        #execução da consulta a guarda de dados na variavel stml

        $stmt->execute();

        #retorna os dados do usuario a camada data.
        return $stmt;
    }

    
    /*
    Função para cadastrar os cadastros no banco de dados
    */
    public function cadastro(){
        $query = "insert into cadastro set nome=:n, cpf=:c, email=:e, foto=:f, senha=:s, nick=:k";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->foto = htmlspecialchars(strip_tags($this->foto));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->nick = htmlspecialchars(strip_tags($this->nick));


        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":c",$this->cpf);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":f",$this->foto);
        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":k",$this->nick);

        


        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }

    public function alterarcadastro(){
        $query = "update cadastro set  nome=:n, cpf=:c, email=:e, foto=:f, senha=:s, nick=:k where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":c",$this->cpf);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":f",$this->foto);
        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":k",$this->nick);
        $stmt->bindParam(":i",$this->id);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from cadastro where id=?";

        $stmt=$this->conexao->prepare($query);

        $stmt->bindParam(1,$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    }

?>