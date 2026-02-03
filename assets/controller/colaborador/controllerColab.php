<?php

session_start();

require __DIR__ . '/../../model/colaborador/modelColab.php';

$id = $_SESSION['userId'];

$colab = new Colaborador();

if ($_POST['op'] && $_POST['op'] == 'getColab') {

    $resp = $colab->getColaborador($id);
    echo $resp;
} else if ($_POST['op'] == 'salvarDadosPessoais') {

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $dtNasc = $_POST['dtNasc'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $end = $_POST['endEdit'];


    $resp = $colab->salvarDadosPessoais($id, $nome, $cpf, $dtNasc, $email, $tel, $end);
    echo $resp;
}
