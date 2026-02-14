<?php
session_start();
require __DIR__ . '/../../model/cadastro/modelCad_professor.php';

$cad = new Cadastro();

if (isset($_POST['op'])) {

    if ($_POST['op'] == 1) {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $dtNasc = $_POST['dtNasc'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $end = $_POST['end'];
        $senha =  trim($_POST['senha']);
        $img = $_FILES['imgPerfil'];

        // uniqid() nome unico
        $nomeImg = uniqid() . "-" . $img['name'];
        // aqui que vou guardar a img
        $pastaImg = __DIR__ . '/../../imagens/imgColab/';

        $caminho = $pastaImg . $nomeImg;

        if (!move_uploaded_file($img['tmp_name'], $caminho)) {
            echo json_encode([
                "status" => false,
                "msg" => "erro ao guardar a imagem"
            ]);
        }

        $hash = password_hash($senha, PASSWORD_BCRYPT);

        $res = $cad->cadastrar($nome, $cpf, $dtNasc, $email, $tel, $end, $hash, $nomeImg);

        if ($res) {
            echo json_encode([
                "status" => true,
                "msg" => "Cadastrado com sucesso"
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg' => 'Erro ao cadastrar'
            ]);
        }
    }
}
