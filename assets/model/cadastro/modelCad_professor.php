<?php

require __DIR__ . '/../../model/bd.php';

class Cadastro
{

    function cadastrar($nome, $cpf, $dtNasc, $email, $tel, $end, $senha)
    {
        global $conn;

        $msg = "";

        $stmt = $conn->prepare("INSERT INTO colaboradores(nome, cpf, dataNasc, email, telefone, endereco, senha ) values (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssss", $nome, $cpf, $dtNasc, $email, $tel, $end, $senha);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $msg = "Cadastrado com sucesso";
        }

        $stmt->close();
        $conn->close();

        return $msg;
    }
}
