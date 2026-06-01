<<<<<<< HEAD
<?php
    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
        include_once '../models/Categoria.php';
        $cat = new Categoria();
        $cat->setId($id);

        if ($cat->excluir()) {
    ?>
=======
    <?php 
    $id = filter_input(INPUT_GET, 'id');

    if($id){
        include_once '../models/Categoria.php';
        $cat = new Categoria();
        $cat -> setId($id);

        if($cat->excluir()){
     ?>
>>>>>>> 1cc02b6b8f24ccb38eb4993fef0b1dfceb3b3348
            <div class="alert alert-primary" role="alert">
                Excluído com sucesso
            </div>
    <?php
        }
    }
    ?>
<<<<<<< HEAD
    <meta http-equiv="refresh" CONTENT="1;URL=?p=categorias">
=======
    <meta http-equiv="refresh" CONTENT="1.5;URL=?p=categorias"
>>>>>>> 1cc02b6b8f24ccb38eb4993fef0b1dfceb3b3348
