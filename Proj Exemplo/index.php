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

            // Captura e sanitiza o parâmetro
            $pagina = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_SPECIAL_CHARS);
            // Define páginas permitidas (lista branca)
            
            $paginasPermitidas = [
                'index' => 'home.php',
                'home' => 'home.php',
                'sobre' => 'sobre.php',
                'contato' => 'contato.php',
                'produtos' => 'produtos.php'
            ];

            // Página padrão
            if (empty($pagina)) {
                $pagina = 'index';
                }

            // Verifica se está na lista branca
            if (array_key_exists($pagina, $paginasPermitidas)) {
                include_once $paginasPermitidas[$pagina];
            } else {
                http_response_code(404);
                ?>
                <div class="alert alert-danger" role="alert">
                    Erro 404 - Página não encontrada!
                </div>
                <?php
            }

            ?>

        </div>

    </div>

    <?php include_once 'scripts.php' ?>

</body>
</html>