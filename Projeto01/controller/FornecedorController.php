<?php

//exige a tipificação dos atributos e métodos
declare(strict_types=1);

require_once '../models/Fornecedor.php';
require_once '../dao/FornecedorDAO.php';

class FornecedorController
{

    private Fornecedor $fornecedor;
    private FornecedorDAO $dao;

    public function __construct()
    {
        $this->fornecedor = new Fornecedor();
        $this->dao = new FornecedorDAO();
    }

    public function setId(int $id): void
    {
        $this->fornecedor->setId($id);
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function buscar(int $id): ?Fornecedor
    {
        return $this->dao->consultarPorID($id);
    }

    public function excluir(): bool
    {
        return $this->dao->excluir($this->fornecedor->getId());
    }

    public function salvar(): bool
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->fornecedor->setId($id);
        }
        $this->fornecedor->setRazaoSocial((string) filter_input(INPUT_POST, 'txtrazaosocial'));
        $this->fornecedor->setEmail((string) filter_input(INPUT_POST, 'txtemail'));
        $this->fornecedor->setTelefone((string) filter_input(INPUT_POST, 'txttelefone'));
        return $this->dao->salvar($this->fornecedor);
    }
    
    public function pesquisar(): array
{
    $termo = trim($_GET['busca'] ?? '');

    return $termo === '' ? $this->dao->listar() : $this->dao->pesquisarPorRazaoSocial($termo);
}

    }