<?php

//exige a tipificação dos atributos e métodos
declare(strict_types=1);

require_once '../models/Cliente.php';
require_once '../dao/ClienteDAO.php';

class ClienteController
{

    private Cliente $cliente;
    private  ClienteDAO $dao;

    public function __construct()
    {
        $this->cliente = new Cliente();
        $this->dao = new ClienteDAO();
    }

    public function setId(int $id): void
    {
        $this->cliente->setId($id);
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function buscar(int $id): ?Cliente
    {
        return $this->dao->consultarPorID($id);
    }

    public function excluir(): bool
    {
        return $this->dao->excluir($this->cliente->getId());
    }
    
    public function salvar(): bool
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->cliente->setId($id);
        }
        $this->cliente->setNome((string) filter_input(INPUT_POST, 'txtnome'));
        $this->cliente->setEmail((string) filter_input(INPUT_POST, 'txtemail'));
        $this->cliente->setTelefone((string) filter_input(INPUT_POST, 'txttelefone'));
        return $this->dao->salvar($this->cliente);
    }

    public function pesquisar(): array
{
    $termo = trim($_GET['busca'] ?? '');

    return $termo === '' ? $this->dao->listar() : $this->dao->pesquisarPorNome($termo);
}
    
    }