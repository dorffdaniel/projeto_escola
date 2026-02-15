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
} else if ($_POST['op'] == 'salvarImg') {
    $img = $_FILES['img'];

    $nomeUnico =  uniqid() . "-" . $img['name'];

    $pastaImg = __DIR__ . '/../../imagens/imgColab/';

    $caminho = $pastaImg . $nomeUnico;

    if (!move_uploaded_file($img['tmp_name'], $caminho)) {
        echo json_encode([
            "status" => false,
            "msg" => "erro ao guardar a imagem"
        ]);
    }

    $resp = $colab->salvarImgPerfil($nomeUnico, $id);

    if ($resp) {
        echo json_encode([
            "status" => true,
            "msg" => "Imagem salva com sucesso"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "msg" => "falha ao salvar imagem"
        ]);
    }
}
