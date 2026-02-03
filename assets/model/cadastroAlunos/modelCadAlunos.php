<?php

require_once __DIR__ . '/../../model/bd.php';

class CadastroAlunos
{

    function cadastrarTurma($turma, $ano)
    {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO turma(nome, ano) values(?,?)");
        $stmt->bind_param("si", $turma, $ano);

        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $arr = json_encode(["msg" => "Adicioanado com sucesso"]);
        } else {
            $arr = json_encode(["erro" => "Erro ao adicionar "]);
        }

        $stmt->close();
        $conn->close();

        return $arr;
    }
}
