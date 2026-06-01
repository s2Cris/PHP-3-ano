<h3 class="mt-3 text-primary">
    Funcionários
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
                Email
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtemail" name="txtemail" rows="3" placeholder="Email" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Cargo
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtcargo" name="txtcargo" rows="3" placeholder="Cargo" value="">
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
            <a href="?p=funcionario" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>

<?php
    //verificar se o botão btnsalvar foi acionado
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST,'txtnome');
    $email = filter_input(INPUT_POST,'txtemail');
    $cargo = filter_input(INPUT_POST,'txtcargo');

    include_once '../models/Funcionario.php' ;
    $func = new Funcionario();

    //enviando os dados do form aos atributos da classe
    $func->setID(NULL);
    $func->setNome($nome);
    $func->setEmail($email);
    $func->setCargo($cargo);

    //efetivar o insert into
    if($func->salvar()){
        ?>
            <div class="alert alert-primary mt-3" role="alert">
                Funcionário - Cadastro efetuado com sucesso.
            </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            Funcionário - erro ao cadastrar.
        </div>
    <?php
    }
}