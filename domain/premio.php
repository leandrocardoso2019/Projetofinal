<?php

class Premio{
    public $id;
    public $nome;
    public $descricao;
    public $foto;
   


    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os premios cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela premio 
        $query = "select * from premio";

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
        #Selecione todos os campos da tabela premio 
        $query = "select * from premio where id=?";

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
        #Selecione todos os campos da tabela premio 
        $query = "select * from premio where nome like ?";

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
    Função para cadastrar os premios no banco de dados
    */
    public function premio(){
        $query = "insert into premio set nome=:n, descricao=:d, foto=:f";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->foto = htmlspecialchars(strip_tags($this->foto));


        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":d",$this->descricao);
        $stmt->bindParam(":f",$this->foto);
        


        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }

    public function alterarpremio(){
        $query = "update premio set  nome=:n, descricao=:d, foto=:f where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":d",$this->descricao);
        $stmt->bindParam(":f",$this->foto);
        $stmt->bindParam(":i",$this->id);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from premio where id=?";

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