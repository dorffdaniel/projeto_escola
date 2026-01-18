<?php

session_start();

require __DIR__ . '/../../model/lancamentoNota/modelLancamentoNota.php';


$lanc = new LancamentoNota();

if ($_POST['op'] == 'getTurma') {
    $resp = $lanc->getTurmas();

    echo $resp;
} else if ($_POST['op'] == 'getAlunoTurma') {
    $idTurm = $_POST['idTurm'];
    $resp = $lanc->getAlunosPorTurma($idTurm);

    echo $resp;
}
