<?php
setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "pt_BR.utf-8", 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include_once 'cabecalho.php'; ?>
</head>

<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container mt-3">
        <div class="alert alert-primary" role="alert">
            <?php
            echo "Seja bem vindo";
            ?>
        </div>

        <?php
        $var = 10;
        if ($var == 10) {
            $mgs = 'Igual a 10';
        }else if ($var > 10) {
            $mgs = 'maior que 10';
        }else{
            $mgs = 'menor que 10';
        }

        $mgs.= ' teste';

        echo $mgs;
        ?>
    </div>

    <?php include_once "scripts.php"; ?>
</body>

</html>