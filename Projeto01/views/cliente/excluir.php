<?php
    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
        include_once '../models/Cliente_copy.php';
        $cli = new Cliente();
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
    <meta http-equiv="refresh" CONTENT="1;URL=?p=categorias">