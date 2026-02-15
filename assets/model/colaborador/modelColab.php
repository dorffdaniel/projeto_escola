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


    function salvarDadosPessoais($id, $nome, $cpf, $dtNasc, $email, $tel, $end)
    {
        global $conn;

        $stmt = $conn->prepare("UPDATE colaboradores 
        SET nome = ?, cpf = ?, dataNasc = ?, email = ?, telefone = ?, endereco = ?
        WHERE id = ?");

        $stmt->bind_param("ssssssi", $nome, $cpf, $dtNasc, $email, $tel, $end, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $arr = json_encode(["msg" => "Editado com sucesso"]);
        } else {
            $arr = json_encode(["erro" => "Erro ao editar"]);
        }

        $stmt->close();
        $conn->close();
        return $arr;
    }

    function salvarImgPerfil($nomeUnico, $id)
    {
        global $conn;

        $stmt = $conn->prepare("UPDATE colaboradores
        SET imgPerfil = ?
        WHERE id = ?");

        $stmt->bind_param("si", $nomeUnico, $id);
        $stmt->execute();

        $resp = $stmt->affected_rows > 0;

        $stmt->close();
        $conn->close();

        if ($resp) {
            return $resp;
        }
    }
}
