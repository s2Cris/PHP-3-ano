<?php

include_once 'Conn.php';

//Extensão PHP Getters & Setters

class Categoria {
    private $id;
    private $nome;
    private $informacoes;
    private $conn;
    private $tabela = "categoria";

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

    public function getInformacoes(): mixed
    {
        return $this->informacoes;
    }

    
    public function setInformacoes($informacoes): static
    {
        $this->informacoes = $informacoes;
        return $this;
    }

    public function salvar() 
    {
        try{
            $this->conn = new Conn();
            $sql = "Call salvar_categoria(?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->informacoes));
            return $executar->execute() == 1 ? true : false;
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function listar($var_id)
    {
        try {
            $this->conn = new Conn();
            $sql = "CALL listar_categoria(?)";
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
            return $executar->execute();
        } catch (PDOException $erro){
            echo $erro->getMessage();
            return false;
        }
    }
    
    public function inserir()
    {
        try {
            $this->conn = new Conn();
            $sql = "INSERT INTO {$this->tabela}
            (id, nome, informacoes) 
            VALUES (?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->informacoes));
            return $executar->execute() ;
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
                    SET nome = ?, informacoes = ?,
                    WHERE id = ?";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, mb_strtoupper($this->nome));
            $executar->bindValue(2, mb_strtoupper($this->informacoes));
            $executar->bindValue(3, $this->id); 
            return $executar->execute() ;
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

    
    public function crudPhp($opcao)
    {
        try {

            $this->conn = new Conn();

            switch ($opcao) {

                case 'I':

                    $sql = "INSERT INTO {$this->tabela}
                        (id, nome, informacoes)
                        VALUES (?, ?, ?)";

                    $executar = $this->conn->prepare($sql);
                    
                    $executar->bindValue(1, $this->id);
                    $executar->bindValue(2, mb_strtoupper($this->nome));
                    $executar->bindValue(3, mb_strtoupper($this->informacoes));

                    break;

                case 'A':

                    $sql = "UPDATE {$this->tabela}
                           SET nome = ?,
                               informacoes = ?
                         WHERE id = ?";

                    $executar = $this->conn->prepare($sql);

                    $executar->bindValue(1, mb_strtoupper($this->nome));
                    $executar->bindValue(2, mb_strtoupper($this->informacoes));
                    $executar->bindValue(3, $this->id);

                    break;

                case 'E':

                    $sql = "DELETE FROM {$this->tabela}
                        WHERE id = ?";

                    $executar = $this->conn->prepare($sql);
                    $executar->bindValue(1, $this->id);

                    break;

                default:
                    return false;
            }

            return $executar->execute();

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }
    
}