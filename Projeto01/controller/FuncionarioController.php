<?php

//exige a tipificação dos atributos e métodos
declare(strict_types=1);

require_once '../models/Funcionario.php';
require_once '../dao/FuncionarioDAO.php';

class FuncionarioController
{

    private Funcionario $funcionario;
    private FuncionarioDAO $dao;

    public function __construct()
    {
        $this->funcionario = new Funcionario();
        $this->dao = new FuncionarioDAO();
    }

    public function setId(int $id): void
    {
        $this->funcionario->setId($id);
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function buscar(int $id): ?Funcionario
    {
        return $this->dao->consultarPorID($id);
    }

    public function excluir(): bool
    {
        return $this->dao->excluir($this->funcionario->getId());
    }

    public function salvar(): bool
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->funcionario->setId($id);
        }
        $this->funcionario->setNome((string) filter_input(INPUT_POST, 'txtnome'));
        $this->funcionario->setEmail((string) filter_input(INPUT_POST, 'txtemail'));
        $this->funcionario->setCargo((string) filter_input(INPUT_POST, 'txtcargo'));
        return $this->dao->salvar($this->funcionario);
    }

    }