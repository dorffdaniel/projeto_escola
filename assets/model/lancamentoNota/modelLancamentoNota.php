<?php

require_once __DIR__ . '/../../model/bd.php';

class LancamentoNota
{


    function getTurmas()
    {

        global $conn;

        $stmt = $conn->prepare("SELECT * FROM turma");
        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            return json_encode(["erro" => "nenhuma turma encontrada"]);
        }

        $arr = [];

        while ($row = $res->fetch_assoc()) {
            $arr[] = $row;
        }


        $stmt->close();
        $conn->close();

        return json_encode(["msg" => $arr]);
    }

    function getAlunosPorTurma($idTurm)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT a.nome
        FROM turma as t
        JOIN alunos as a on t.idaluno = a.idAlun
        WHERE t.idTurm = ?");

        $stmt->bind_param("i", $idTurm);
        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            return json_encode(["erro" => "nenhum aluno encontrado nessa turma"]);
        }

        $arr = [];
        while ($row = $res->fetch_assoc()) {
            $arr = $row;
        }

        $stmt->close();
        $conn->close();

        return json_encode($arr);
    }
}
