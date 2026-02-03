<?php

require __DIR__ . '/../../model/cadastroAlunos/modelCadAlunos.php';

$cdAlun = new CadastroAlunos();


if (isset($_POST['op'])) {

    if ($_POST['op'] == 'cadastrarTurma') {
        $turma = $_POST['turma'];
        $ano = $_POST['ano'];

        $resp = $cdAlun->cadastrarTurma($turma, $ano);
        echo $resp;
    }
}
