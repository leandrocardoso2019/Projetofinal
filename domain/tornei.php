<?php

class Torneio{
    public $id;
    public $data;
    public $hora;
    public $id_jogo;
    public $inscritos;
    public $id_premio;
    public $tempo;
    public $id_cadastro;
   


    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os torneios cadastrados no banco
    de dados. Essa função retorna uma listar com todos os dados.
    */
    public function listar(){
        #Selecione todos os campos da tabela torneio 
        $query = "select * from torneio";

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
        #Selecione todos os campos da tabela torneio 
        $query = "select * from torneio where id=?";

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
        #Selecione todos os campos da tabela torneio 
        $query = "select * from torneio where nome like ?";

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
    Função para cadastrar os torneios no banco de dados
    */
    public function torneio(){
        $query = "insert into torneio set data=:d, hora=:h, id_jogo=:j, inscritos=:o, id_premio=:p, tempo=:t ,id_cadastro=:c";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizado 2 funções para tratar os dados que estão vindo do usuário
        para o api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar-> retira as aspas e os 2 pontos que vem do formato json
        para cadastrar em banco.
        */

        $this->data = htmlspecialchars(strip_tags($this->data));
        $this->hora = htmlspecialchars(strip_tags($this->hora));
        $this->id_jogo = htmlspecialchars(strip_tags($this->id_jogo));
        $this->inscritos = htmlspecialchars(strip_tags($this->inscritos));
        $this->id_premio = htmlspecialchars(strip_tags($this->id_premio));
        $this->tempo = htmlspecialchars(strip_tags($this->tempo));
        $this->id_cadastro = htmlspecialchars(strip_tags($this->id_cadastro));


        $stmt->bindParam(":d",$this->data);
        $stmt->bindParam(":h",$this->hora);
        $stmt->bindParam(":j",$this->id_jogo);
        $stmt->bindParam(":o",$this->inscritos);
        $stmt->bindParam(":p",$this->id_premio);
        $stmt->bindParam(":t",$this->tempo);
        $stmt->bindParam(":c",$this->id_cadastro);

        


        if($stmt->execute()){
            return true;
        }
        else{
            return false;;
        }
    }

    public function alterartorneio(){
        $query = "update torneio set data=:d, hora=:h, id_jogo=:j, inscritos=:o, id_premio=:p, tempo=:t ,id_cadastro=:c where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":d",$this->data);
        $stmt->bindParam(":h",$this->hora);
        $stmt->bindParam(":j",$this->id_jogo);
        $stmt->bindParam(":o",$this->inscritos);
        $stmt->bindParam(":p",$this->id_premio);
        $stmt->bindParam(":t",$this->tempo);
        $stmt->bindParam(":c",$this->id_cadastro);
        $stmt->bindParam(":i",$this->id);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from torneio where id=?";

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