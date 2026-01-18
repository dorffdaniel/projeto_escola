<?php

require_once __DIR__ . '/../../model/bd.php';

class Colaborador
{

    function getColaborador($id)
    {

        global $conn;

        $stmt = $conn->prepare("SELECT * FROM colaboradores WHERE id = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            return json_encode(["erro" => "nenhum usuario encontrado"]);
        }

        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
        }

        $stmt->close();
        $conn->close();

        return json_encode($row);
    }

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
}
