<?php 
    setlocale(LC_TIME, "pt_BR","pt_BR. utf-8", "pt-BR.utf-8", 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include_once 'cabecalho.php' ?>
</head>
<body>
    <?php include_once 'navbar.php' ?>
    
    <div class="container mt-3">

        <div class="alert alert-primary" role="alert">

            <?php
            $pagina = filter_input(INPUT_GET, 'p');
            if (empty($pagina)) {
                include_once 'home.php';
            } else {
                if(file_exists($pagina . '.php')){
                   include_once $pagina . '.php'; 
                } else { 
                    echo "Erro 404 - Página não encontrada!";
                }
                
            }

            ?>

        </div>

    </div>

    <?php include_once 'scripts.php' ?>

</body>
</html>