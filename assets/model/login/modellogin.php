<?php
session_start();

require_once __DIR__ . '/../../model/bd.php';

class Login
{

    function login($email, $senhaDigitada)
    {
        global $conn;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $stmt = $conn->prepare("SELECT id, senha FROM colaboradores WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 0) {
            return json_encode(["erro" => "Nenhum usuário encontrado"]);
        }

        $dados = $res->fetch_assoc();
        $hashDoBanco = $dados['senha'];
        $id = $dados['id'];

        if (password_verify($senhaDigitada, $hashDoBanco)) {
            $_SESSION['userId'] = $id;
            return json_encode(["msg" => "Login ok"]);
        } else {
            return json_encode(["erro" => "Senha incorreta"]);
        }
    }
}