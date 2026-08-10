<?php

include_once 'Conn.php';

//Extensão PHP Getters & Setters

class Funcionario {
    private $id;
    private $nome;
    private $email;
    private $cargo;
    private $conn;
    private $tabela = "funcionario";

    public function getID(): mixed {
        return $this->id;
    }

    public function setID($id): static 
    {
        $this->id = $id;
        return $this;
    }

    public function getNome(): mixed {
        return $this->nome;
    }

    public function setNome($nome): static
    {
        $this->nome = $nome;
        return $this;
    }

    public function getEmail(): mixed {
        return $this->email;
    }

    public function setEmail($email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getCargo(): mixed {
        return $this->cargo;
    }

    public function setCargo($cargo): static
    {
        $this->cargo = $cargo;
        return $this;
    }

    /*
    public function salvar() 
    {
        try{
            $this->conn = new Conn();
            $sql = "Call salvar_funcionario(?, ?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->email));
            $executar->bindValue(4, mb_strtoupper($this->cargo));
            return $executar->execute() == 1 ? true : false;
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function listar($var_id)
    {
        try {
            $this->conn = new Conn();
            $sql = "CALL listar_funcionario(?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $var_id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }
    */
    
    public function salvar()
    {
        return $this->inserir();
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
            $sql = "INSERT INTO {$this->tabela} (id, nome, email, cargo) VALUES (?, ?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->email));
            $executar->bindValue(4, mb_strtoupper($this->cargo));
            return $executar->execute();
        } catch (PDOException $erro){
            echo $erro->getMessage();
            return false;
        }
    }

    public function alterar()
    {
        try {
            $this->conn = new Conn();
            $sql = "UPDATE {$this->tabela} 
                    SET nome = ?, email = ?, cargo = ?
                    WHERE id = ?";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, mb_strtoupper($this->nome));
            $executar->bindValue(2, mb_strtoupper($this->email));
            $executar->bindValue(3, mb_strtoupper($this->cargo));
            $executar->bindValue(4, $this->id); 
            return $executar->execute();
        } catch (PDOException $erro){
            echo $erro->getMessage();
            return false;
        }
    }

    public function listarSemProcedure()
    {
        try {
            $this->conn = new Conn();
            $sql = "SELECT * FROM {$this->tabela} ORDER BY nome";
            $executar = $this->conn->prepare($sql); 
            $executar->execute();
            return $executar->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro){
            echo $erro->getMessage();
            return false;
        }
    }

    public function consultarPorID()
    {
        try {
            $this->conn = new Conn();
            $sql = "SELECT * FROM {$this->tabela} WHERE id = ?";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id); 
            $executar->execute();
            return $executar->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $erro){
            echo $erro->getMessage();
            return false;
        }
    }

}
