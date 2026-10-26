<?php
require_once '../controller/FornecedorController.php';

$controller = new FornecedorController();
$fornecedores = $controller->pesquisar();
$busca = $_GET['busca'] ?? '';
?>

<h3 class="mt-3 text-primary">Pesquisar fornecedor</h3>

<form method="GET" action="index.php" class="row g-2 mb-4">
    <input type="hidden" name="p" value="pesquisar/fornecedor">
    <div class="col-sm-9">
        <input type="text" name="busca" class="form-control"
               placeholder="Digite a razão social"
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
            <th>Razão Social</th>
            <th>E-mail</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($fornecedores) === 0): ?>
        <tr><td colspan="3" class="text-center">Nenhum fornecedor encontrado.</td></tr>
    <?php else: ?>
        <?php foreach ($fornecedores as $f): ?>
            <tr>
                <td><?= $f['id'] ?></td>
                <td><?= htmlspecialchars($f['razao_social']) ?></td>
                <td><?= htmlspecialchars($f['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>