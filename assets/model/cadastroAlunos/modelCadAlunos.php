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

    function getTurmasParaCadAlunos()
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * from turma
        order by nome");
        $stmt->execute();

        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $dados[] = $row;
        }

        $stmt->close();
        $conn->close();

        return json_encode($dados);
    }

    function cadastrarAlunos($turma, $nome, $dtNasc, $telef, $end)
    {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO alunos(nome, dataNasci, telefone, endereco, turma_id) values (?,?,?,?,?)");

        $stmt->bind_param("ssssi", $nome, $dtNasc, $telef, $end, $turma);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $arr = json_encode(["msg" => "Adicionado com sucesso"]);
        } else {
            $arr = json_encode(["erro" => "Erro ao adicionar o aluno"]);
        }

        $stmt->close();
        $conn->close();

        return $arr;
    }
}
