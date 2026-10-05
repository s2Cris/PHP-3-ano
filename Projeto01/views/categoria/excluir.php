<?php
    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
        include_once '../controller/CategoriaController.php';
        $cat = new CategoriaController();
        $cat->setId($id);

        if ($cat->excluir()) {
    ?>
            <div class="alert alert-primary" role="alert">
                Excluído com sucesso
            </div>
    <?php
        }
    }
    ?>
    <meta http-equiv="refresh" CONTENT="1;URL=?p=categorias">
