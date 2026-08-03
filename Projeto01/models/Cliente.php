<?php

include_once 'Conn.php';

//Extensão PHP Getters & Setters

class Cliente {
    private $id;
    private $nome;
    private $email;
    private $conn;
    private $tabela = "cliente";

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

    public function getEmail() {
        return $this->email;
    }

    
    public function setEmail($email): mixed
    {
        $this->email = $email;
        return $email;
    }

    public function salvar() 
    {
        try{
            $this->conn = new Conn();
            $sql = "Call salvar_cliente(?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->email));
            return $executar->execute() == 1 ? true : false;
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function listar($var_id)
    {
        try {
            $this->conn = new Conn();
            $sql = "CALL listar_cliente(?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $var_id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }



    // métodos sem procedure

    public function excluir()
    {
        try{
            $this->conn = new Conn();
            $sql = "DELETE FROM {$this->tabela} WHERE id= ?";
            $executar = $this->conn->prepare($sql); 
            $executar->bindValue(1,$this->id);
            return $executar->execute() == 1 ? true : false;
        } catch (PDOException $erro){
            echo $erro->getMessage();
        }
    }

    public function inserir()
    {
        try {
            $this->conn = new Conn();
            $sql = "INSERT INTO cliente VALUES (?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->email));
            return $executar->execute() == 1 ? true : false;
        } catch (PDOException $erro){
            echo $erro->getMessage();
        }
    }

    public function alterar()
    {
        try {
            $this->conn = new Conn();
            $sql = "UPDATE cliente 
                    SET nome = ?, email = ?,
                    WHERE id = ?";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, mb_strtoupper($this->nome));
            $executar->bindValue(2, mb_strtoupper($this->email));
            $executar->bindValue(3, $this->id); 
            return $executar->execute() == 1 ? true :false;
        } catch (PDOException $erro){
            echo $erro->getMessage();
        }
    }

    public function listarSemProcedure()
    {
        try {
            $this->conn = new Conn();
            $sql = "SELECT * FROM {$this->tabela} ORDER BY nome";
            $executar = $this->conn->prepare($sql); 
            return $executar->execute() == 1 ? true :false;
        } catch (PDOException $erro){
            echo $erro->getMessage();
        }
    }

    public function consultarPorID()
    {
        try {
            $this->conn = new Conn();
            $sql = "SELECT * FROM {$this->tabela} WHERE id = ?";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id); 
            return $executar->execute() == 1 ? true :false;
        } catch (PDOException $erro){
            echo $erro->getMessage();
        }
    }
    
}
