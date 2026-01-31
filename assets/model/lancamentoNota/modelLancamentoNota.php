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

        $stmt = $conn->prepare("SELECT a.nome,
        MAX(CASE WHEN p.id = 1 THEN av.nota END) AS nota_b1,
        MAX(CASE WHEN p.id = 2 THEN av.nota END) AS nota_b2,
        MAX(CASE WHEN p.id = 3 THEN av.nota END) AS nota_b3,
        MAX(CASE WHEN p.id = 4 THEN av.nota END) AS nota_b4
        FROM alunos a
        JOIN turma t ON a.turma_id = t.idTurm
        LEFT JOIN avaliacoes av ON a.idAlun = av.aluno_id
        LEFT JOIN periodo p ON av.periodo_id = p.id
        where t.idTurm = ?
        GROUP BY a.idAlun");

        $stmt->bind_param("i", $idTurm);
        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            return json_encode(["vazio" => "nenhum aluno encontrado nessa turma"]);
        }

        $arr = [];
        while ($row = $res->fetch_assoc()) {
            $arr[] = $row;
        }

        $stmt->close();
        $conn->close();

        return json_encode($arr);
    }


    function getTodosAlunos()
    {
        global $conn;

        $stmt = $conn->prepare("SELECT a.nome,
        MAX(CASE WHEN p.id = 1 THEN av.nota END) AS nota_b1,
        MAX(CASE WHEN p.id = 2 THEN av.nota END) AS nota_b2,
        MAX(CASE WHEN p.id = 3 THEN av.nota END) AS nota_b3,
        MAX(CASE WHEN p.id = 4 THEN av.nota END) AS nota_b4
        FROM alunos as a 
        join turma as t on a.turma_id = t.idTurm
        left join avaliacoes as av on a.idAlun = av.aluno_id
        left join periodo p ON av.periodo_id = p.id
        GROUP BY a.idAlun");

        $stmt->execute();

        $res = $stmt->get_result();

        $dados = [];

        while ($row = $res->fetch_assoc()) {
            $dados[] = $row;
        }

        $conn->close();
        $stmt->close();
        return json_encode($dados);
    }
}
