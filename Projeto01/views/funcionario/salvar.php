<?php
require_once "../controller/FuncionarioController.php";
$func = new FuncionarioController();

/*
    //enviando os dados do form aos atributos da classe
    $func->setID(NULL);
    $func->setNome($nome);
    $func->setEmail($email);
    $func->setCargo($cargo);
    */

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$registro = $id ? $func->buscar($id) : null;
$editando = $registro !== null;
?>

<h3 class="mt-3 text-primary">
    <?= $editando ? 'Editar Funcionário' : 'Funcionários' ?>
</h3>

<div class="card shadow mt-3">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3">
        <?php if ($editando): ?>
            <input type="hidden" name="id" value="<?= $registro->getId() ?>">
        <?php endif; ?>

        <div class="form-group row">
            <label for="txtnome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Nome"
                       value="<?= $editando ? htmlspecialchars($registro->getNome()) : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="txtemail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtemail" name="txtemail" placeholder="Email"
                       value="<?= $editando ? htmlspecialchars($registro->getEmail()) : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="txtcargo" class="col-sm-2 col-form-label">Cargo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtcargo" name="txtcargo" placeholder="Cargo"
                       value="<?= $editando ? htmlspecialchars($registro->getCargo()) : '' ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnsalvar"
                       value="<?= $editando ? 'Salvar alterações' : 'Cadastrar' ?>">
            </div>
            <a href="?p=funcionario" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    if ($func->salvar()) {
        ?>
        <div class="alert alert-primary mt-3" role="alert">
            Funcionário - <?= filter_input(INPUT_POST, 'id') ? 'alterado' : 'cadastrado' ?> com sucesso.
        </div>
        <meta http-equiv="refresh" content="1;URL=?p=funcionario">
        <?php
    } else {
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            Funcionário - erro ao salvar.
        </div>
        <?php
    }
}