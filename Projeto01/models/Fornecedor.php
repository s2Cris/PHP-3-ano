<?php

include_once 'Conn.php';

//Extensão PHP Getters & Setters

class Fornecedor {
    private $id;
    private $nome;
    private $cidade;
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

    public function setNome($nome): mixed
    {
        $this->nome = $nome;
        return $nome;
    }

    public function getCidade() {
        return $this->cidade;
    }

    
    public function setCidade($cidade): mixed
    {
        $this->cidade = $cidade;
        return $cidade;
    }

    public function salvar() 
    {
        try{
            $this->conn = new Conn();
            $sql = "Call salvar_fornecedor(?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->cidade));
            return $executar->execute() == 1 ? true : false;
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }
}
