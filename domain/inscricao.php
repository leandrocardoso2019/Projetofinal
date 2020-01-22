<?php

class Inscricao{
    public $id;
    public $id_jogo;
    public $id_cadastro;
    public $id_torneio;
    


    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os inscricaos cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela inscricao 
        $query = "select * from inscricao";

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
        #Selecione todos os campos da tabela inscricao 
        $query = "select * from inscricao where id=?";

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
        #Selecione todos os campos da tabela inscricao 
        $query = "select * from inscricao where nome like ?";

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
    Função para cadastrar os inscricaos no banco de dados
    */
    public function inscricao(){
        $query = "insert into inscricao set id_jogo=:j, id_cadastro=:c, id_torneio=:t";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->id_jogo = htmlspecialchars(strip_tags($this->id_jogo));
        $this->id_cadastro = htmlspecialchars(strip_tags($this->id_cadastro));
        $this->id_torneio = htmlspecialchars(strip_tags($this->id_torneio));
       


        $stmt->bindParam(":j",$this->id_jogo);
        $stmt->bindParam(":c",$this->id_cadastro);
        $stmt->bindParam(":t",$this->id_torneio);
        

        


        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }

    public function alterarinscricao(){
        $query = "update inscricao set   id_jogo=:j, id_cadastro=:c, id_torneio=:t where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":j",$this->id_jogo);
        $stmt->bindParam(":c",$this->id_cadastro);
        $stmt->bindParam(":t",$this->id_torneio);
        $stmt->bindParam(":i",$this->id);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from inscricao where id=?";

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