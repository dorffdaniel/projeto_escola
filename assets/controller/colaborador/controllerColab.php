<?php

session_start();

require __DIR__ . '/../../model/colaborador/modelColab.php';

$id = $_SESSION['userId'];

$colab = new Colaborador();

if ($_POST['op'] && $_POST['op'] == 1) {

    $resp = $colab->getColaborador($id);
    echo $resp;
}
