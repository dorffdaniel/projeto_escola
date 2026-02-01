<?php

session_start();

require __DIR__ . '/../../model/lancamentoNota/modelLancamentoNota.php';


$lanc = new LancamentoNota();

if ($_POST['op'] == 'getTurma') {
    $resp = $lanc->getTurmas();

    echo $resp;
} else if ($_POST['op'] == 'getAlunoTurma') {
    $idTurm = (int) $_POST['idTurm'];

    if ($idTurm < 0) {
        echo json_encode(["erro" => "Selecione uma turma"]);
        exit;
    }

    $resp = $lanc->getAlunosPorTurma($idTurm);
    echo $resp;
} else if ($_POST['op'] == 'getTodosAlunos') {

    $resp = $lanc->getTodosAlunos();
    echo $resp;
} else if ($_POST['op'] == 'editarAluno') {
    $resp = $lanc->editarAluno($_POST['idAlun']);

    echo $resp;
} else if ($_POST['op'] == 'salvarEditPessoalAluno') {

    $idAlun = $_POST['idAlun'];
    $nome = $_POST['nomeEdit'];
    $tel = $_POST['telEdit'];
    $dtNasc = $_POST['dtNascEdit'];
    $end = $_POST['endEdit'];


    $resp = $lanc->salvarEditPessoalAluno($idAlun, $nome, $tel, $dtNasc, $end);
    echo $resp;
}
