<?php

include_once 'Conn_php';

//Extensão PHP Getters & Setters

class Categoria {
    private $id;
    private $nome;
    private $informacoes;
    private $conn;

    public function getID(): mixed {
        return $this->id;
    }

    public function setID($id): static 
    {
        $this->id = $id;
        return $this;
    }

    public function getNome($nome): mixed {
        return $this->nome;
    }

    public function setID($id): mixed
    {
        $this->nome = $nome;
        return $nome;
    }

    public function getInformacoes() {
        return $this->inforcacoes;
    }

    public function setInformacoes($informacoes): mixed
    {
        $this->informacoes = $informacoes;
        return $informacoes;
    }

    public function salvar() 
    {
        try{
            $this->conn = new Conn();
            $sql = "Call salvar_categoria(?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id)
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->informacoes));
            return $executar->executar() == 1 ? true > false;
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    
    }
}
