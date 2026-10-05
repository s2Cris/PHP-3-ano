<?php
require_once "../controller/CategoriaController.php";
$cat = new CategoriaController();

/*acesso à classe (em models)
    include_once '../models/Categoria_copy.php' ;
    $cat = new Categoria();

    //enviando os dados do form aos atributos da classe
    $cat->setID(NULL);
    $cat->setNome($nome);
    $cat->setInformacoes($info); */

    //efetivar o insert into
    //if ($cat->salvar()) { - com procedure

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$registro = $id ? $cat->buscar($id) : null;
$editando = $registro !== null;
?>

<h3 class="mt-3 text-primary">
    <?= $editando ? 'Editar Categoria' : 'Categoria' ?>
</h3>

<div class="card shadow mt-3">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3">
        <?php if ($editando): ?>
            <input type="hidden" name="id" value="<?= $registro->getId() ?>">
        <?php endif; ?>

        <div class="form-group row">
            <label for="txtnome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Categoria"
                       value="<?= $editando ? htmlspecialchars($registro->getNome()) : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="txtinformacoes" class="col-sm-2 col-form-label">Informações</label>
            <div class="col-sm-10">
                <textarea name="txtinformacoes" id="txtinformacoes" rows="3" placeholder="Informações aqui"
                          class="form-control"><?= $editando ? htmlspecialchars($registro->getInformacoes()) : '' ?></textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <div class="col-sm-10">
                <input type="submit" class="btn btn-primary mr-2" name="btnsalvar"
                       value="<?= $editando ? 'Salvar alterações' : 'Cadastrar' ?>">
            </div>
            <a href="?p=categorias" class="btn btn-danger col-form-control">Cancelar</a>
        </div>
    </form>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    if ($cat->salvar()) {
        ?>
        <div class="alert alert-primary mt-3" role="alert">
            Categoria - <?= filter_input(INPUT_POST, 'id') ? 'alterada' : 'cadastrada' ?> com sucesso.
        </div>
        <meta http-equiv="refresh" content="1;URL=?p=categorias">
        <?php
    } else {
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            Categoria - erro ao salvar.
        </div>
        <?php
    }
}