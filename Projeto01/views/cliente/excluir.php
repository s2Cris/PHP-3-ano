<?php
    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
        include_once '../controller/ClienteController.php';
        $cli = new ClienteController();
        $cli->setId($id);

        if ($cli->excluir()) {
    ?>
            <div class="alert alert-primary" role="alert">
                Excluído com sucesso
            </div>
    <?php
        }
    }
    ?>
    <meta http-equiv="refresh" CONTENT="1;URL=?p=cliente">