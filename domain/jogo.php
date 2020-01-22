<?php

class Jogo{
    public $id;
    public $nomejogo;
    public $foto;
    public $plataforma;
    


    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os jogos cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela jogo 
        $query = "select * from jogo";

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
        #Selecione todos os campos da tabela jogo 
        $query = "select * from jogo where id=?";

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
        #Selecione todos os campos da tabela jogo 
        $query = "select * from jogo where nome like ?";

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
    Função para cadastrar os jogos no banco de dados
    */
    public function jogo(){
        $query = "insert into jogo set nomejogo=:n, foto=:f, plataforma=:p";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->nomejogo = htmlspecialchars(strip_tags($this->nomejogo));
        $this->foto = htmlspecialchars(strip_tags($this->foto));
        $this->plataforma = htmlspecialchars(strip_tags($this->plataforma));
       


        $stmt->bindParam(":n",$this->nomejogo);
        $stmt->bindParam(":f",$this->foto);
        $stmt->bindParam(":p",$this->plataforma);
        

        


        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }

    public function alterarjogo(){
        $query = "update jogo set  nomejogo=:n, foto=:f, plataforma=:p where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":n",$this->nomejogo);
        $stmt->bindParam(":f",$this->foto);
        $stmt->bindParam(":p",$this->plataforma);
        $stmt->bindParam(":i",$this->id);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from jogo where id=?";

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