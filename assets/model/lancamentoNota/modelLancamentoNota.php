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

        $stmt = $conn->prepare("SELECT a.idAlun, a.nome,
        MAX(CASE WHEN p.id = 1 THEN av.nota END) AS nota_b1,
        MAX(CASE WHEN p.id = 2 THEN av.nota END) AS nota_b2,
        MAX(CASE WHEN p.id = 3 THEN av.nota END) AS nota_b3,
        MAX(CASE WHEN p.id = 4 THEN av.nota END) AS nota_b4,

        ROUND( 
        (COALESCE(MAX(CASE WHEN p.id = 1 THEN av.nota END),0) +
            COALESCE(MAX(CASE WHEN p.id = 2 THEN av.nota END),0) +
            COALESCE(MAX(CASE WHEN p.id = 3 THEN av.nota END),0) +
            COALESCE(MAX(CASE WHEN p.id = 4 THEN av.nota END),0))/ 4 
            , 2) as nota_final
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

        $stmt = $conn->prepare("SELECT a.idAlun, a.nome,
        MAX(CASE WHEN p.id = 1 THEN av.nota END) AS nota_b1,
        MAX(CASE WHEN p.id = 2 THEN av.nota END) AS nota_b2,
        MAX(CASE WHEN p.id = 3 THEN av.nota END) AS nota_b3,
        MAX(CASE WHEN p.id = 4 THEN av.nota END) AS nota_b4,
        
      ROUND( 
       (COALESCE(MAX(CASE WHEN p.id = 1 THEN av.nota END),0) +
        COALESCE(MAX(CASE WHEN p.id = 2 THEN av.nota END),0) +
        COALESCE(MAX(CASE WHEN p.id = 3 THEN av.nota END),0) +
        COALESCE(MAX(CASE WHEN p.id = 4 THEN av.nota END),0))/ 4 
        , 2) as nota_final
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


    function editarAluno($idAlun)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT a.idAlun, a.nome, a.dataNasci, a.telefone, a.endereco, t.nome as nomeTurma,
        MAX(CASE WHEN p.id = 1 THEN av.nota END) AS nota_b1,
        MAX(CASE WHEN p.id = 2 THEN av.nota END) AS nota_b2,
        MAX(CASE WHEN p.id = 3 THEN av.nota END) AS nota_b3,
        MAX(CASE WHEN p.id = 4 THEN av.nota END) AS nota_b4  
        FROM alunos as a 
        join turma as t on a.turma_id = t.idTurm
        left join avaliacoes as av on a.idAlun = av.aluno_id
        left join periodo p ON av.periodo_id = p.id
        where a.idAlun = ?
        GROUP BY 
        a.idAlun,
        a.nome,
        a.dataNasci,
        a.telefone,
        a.endereco,
        t.nome");

        $stmt->bind_param("i", $idAlun);
        $stmt->execute();

        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
        }

        $stmt->close();
        $conn->close();

        return json_encode($row);
    }


    function salvarEditPessoalAluno($idAlun, $nome, $tel, $dtNasc, $end)
    {
        global $conn;

        $stmt = $conn->prepare("UPDATE alunos
        SET nome= ?, dataNasci= ?, telefone= ?, endereco=?
        WHERE idAlun= ?");

        $stmt->bind_param("ssssi", $nome, $dtNasc, $tel, $end, $idAlun);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $arr = json_encode(["msg" => "Editado com sucesso"]);
        } else {
            $arr = json_encode(["erro" => "erro ao editar" . $conn->error]);
        }

        $stmt->close();
        $conn->close();

        return $arr;
    }
}
