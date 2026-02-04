<?php

require __DIR__ . '/../../model/cadastroAlunos/modelCadAlunos.php';

$cdAlun = new CadastroAlunos();


if (isset($_POST['op'])) {

    if ($_POST['op'] == 'cadastrarTurma') {
        $turma = $_POST['turma'];
        $ano = $_POST['ano'];

        $resp = $cdAlun->cadastrarTurma($turma, $ano);
        echo $resp;
    } else if ($_POST['op'] == 'getTurmasParaCadAlunos') {

        $resp = $cdAlun->getTurmasParaCadAlunos();
        echo $resp;
    } else if ($_POST['op'] == 'cadastrarAlunos') {
        $turma = $_POST['turma'];
        $nome = $_POST['nome'];
        $dtNasc = $_POST['dtNasc'];
        $telef = $_POST['telef'];
        $end = $_POST['end'];

        $resp = $cdAlun->cadastrarAlunos($turma, $nome, $dtNasc, $telef, $end);
        echo $resp;
    }
}
