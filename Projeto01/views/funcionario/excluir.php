<?php
    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
        include_once '../controller/FuncionarioController.php';
        $func = new FuncionarioController();
        $func->setId($id);

        if ($func->excluir()) {
    ?>
            <div class="alert alert-primary" role="alert">
                Excluído com sucesso
            </div>
    <?php
        }
    }
    ?>
    <meta http-equiv="refresh" CONTENT="1;URL=?p=funcionario">