<?php

class Ganhador{
    public $id;
    public $id_torneio;
    public $data;
    public $hora;
    


    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os ganhadors cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela ganhador 
        $query = "select * from ganhador";

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
        #Selecione todos os campos da tabela ganhador 
        $query = "select * from ganhador where id=?";

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
        #Selecione todos os campos da tabela ganhador 
        $query = "select * from ganhador where nome like ?";

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
    Função para cadastrar os ganhadors no banco de dados
    */
    public function ganhador(){
        $query = "insert into ganhador set id_torneio=:t, data=:d, hora=:h";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->id_torneio = htmlspecialchars(strip_tags($this->id_torneio));
        $this->data = htmlspecialchars(strip_tags($this->data));
        $this->hora = htmlspecialchars(strip_tags($this->hora));
       


        $stmt->bindParam(":t",$this->id_torneio);
        $stmt->bindParam(":d",$this->data);
        $stmt->bindParam(":h",$this->hora);
        

        


        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }

    public function alterarganhador(){
        $query = "update ganhador set  ganhador set id_torneio=:t, data=:d, hora=:h where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":t",$this->id_torneio);
        $stmt->bindParam(":d",$this->data);
        $stmt->bindParam(":h",$this->hora);
        $stmt->bindParam(":i",$this->id);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from ganhador where id=?";

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