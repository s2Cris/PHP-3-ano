<?php
    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
        include_once '../controller/FornecedorController.php';
        $forn = new FornecedorController();
        $forn->setId($id);

        if ($forn->excluir()) {
    ?>
            <div class="alert alert-primary" role="alert">
                Excluído com sucesso
            </div>
    <?php
        }
    }
    ?>
    <meta http-equiv="refresh" CONTENT="1;URL=?p=fornecedor">