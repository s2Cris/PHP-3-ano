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

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function salvar(): bool
    {
        $this->funcionario->setNome(filter_input(INPUT_POST, 'txtnome'));
        $this->funcionario->setEmail(filter_input(INPUT_POST, 'txtemail'));
        $this->funcionario->setCargo(filter_input(INPUT_POST, 'txtcargo'));
        return $this->dao->salvar($this->funcionario);
        
    }

    }