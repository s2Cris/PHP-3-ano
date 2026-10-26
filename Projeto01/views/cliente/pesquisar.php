<?php
require_once '../controller/ClienteController.php';

$controller = new ClienteController();
$clientes = $controller->pesquisar();
$busca = $_GET['busca'] ?? '';
?>

<h3 class="mt-3 text-primary">Pesquisar cliente</h3>

<form method="GET" action="index.php" class="row g-2 mb-4">
    <input type="hidden" name="p" value="pesquisar/cliente">
    <div class="col-sm-9">
        <input type="text" name="busca" class="form-control"
               placeholder="Digite o nome do cliente"
               value="<?= htmlspecialchars($busca) ?>">
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-primary">PESQUISAR</button>
    </div>
</form>

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($clientes) === 0): ?>
        <tr><td colspan="3" class="text-center">Nenhum cliente encontrado.</td></tr>
    <?php else: ?>
        <?php foreach ($clientes as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['nome']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>