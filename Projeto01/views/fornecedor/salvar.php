<h3 class="mt-3 text-primary">
    Fornecedores
</h3>

<div class="card shadow mt-3"><!-- acrescentei um card com sombra aqui tbm -->
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">

        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Nome
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Nome"
                    value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Cidade
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtcidade" name="txtcidade" rows="3" placeholder="Cidade" value="">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit"
                    class="btn btn-primary"
                    name="btnsalvar"
                    value="Cadastrar">
            </div>
            <!-- faltou um link aqui-->
            <a href="?p=fornecedor" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>

<?php
    //verificar se o botão btnsalvar foi acionado
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST,'txtnome');
    $info = filter_input(INPUT_POST,'txtcidade');

    include_once '../models/Fornecedor.php' ;
    $cat = new Fornecedor();

    //enviando os dados do form aos atributos da classe
    $cat->setID(NULL);
    $cat->setNome($nome);
    $cat->setCidade($info);

    //efetivar o insert into
    if($cat->salvar()){
        ?>
            <div class="alert alert-primary mt-3" role="alert">
                Fornecedor - Cadastro efetuado com sucesso.
            </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            Fornecedor - erro ao cadastrar.
        </div>
    <?php
    }
}