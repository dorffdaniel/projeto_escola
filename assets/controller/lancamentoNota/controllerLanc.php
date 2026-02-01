<?php

session_start();

if (isset($_SESSION['userId'])) {
    $idColab = $_SESSION['userId'];
}

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
} else if ($_POST['op'] == 'getPeriodo') {
    $resp = $lanc->getPeriodo();

    echo $resp;
} else if ($_POST['op'] == 'salvarEditNotas') {

    $idAlun = $_POST['idAlun'];
    $periodo = $_POST['periodo'];
    $nota =  isset($_POST['notaEdit']) ? (float) $_POST['notaEdit'] : 0.0;


    $resp = $lanc->salvarEditNotas($idColab, $idAlun, $nota, $periodo);
    echo $resp;
} else if ($_POST['op'] == 'getPeriodoAdcNota') {

    $resp = $lanc->getPeriodoAdcNota();
    echo $resp;
}
