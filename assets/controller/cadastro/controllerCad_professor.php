<?php

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
        $senha = $_POST['senha'];

        $hash = password_hash($senha, PASSWORD_BCRYPT);

        $res = $cad->cadastrar($nome, $cpf, $dtNasc, $email, $tel, $end, $hash);

        echo $res;
    }
}
