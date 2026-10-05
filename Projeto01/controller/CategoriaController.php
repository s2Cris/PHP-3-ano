<?php

//exige a tipificação dos atributos e métodos
declare(strict_types=1);

require_once '../models/Categoria.php';
require_once '../dao/CategoriaDAO.php';

class CategoriaController
{

    private Categoria $categoria;
    private CategoriaDAO $dao;

    public function __construct()
    {
        $this->categoria = new Categoria();
        $this->dao = new CategoriaDAO();
    }

    public function setId(int $id): void
    {
        $this->categoria->setId($id);
    }
    
    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function buscar(int $id): ?Categoria
    {
        return $this->dao->consultarPorID($id);
    }

    public function excluir(): bool
    {
        return $this->dao->excluir($this->categoria->getId());
    }

    public function salvar(): bool
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->categoria->setId($id);
        }
        $this->categoria->setNome((string) filter_input(INPUT_POST, 'txtnome'));
        $this->categoria->setInformacoes((string) filter_input(INPUT_POST, 'txtinformacoes'));
        return $this->dao->salvar($this->categoria);
    }

    }