<?php

require_once __DIR__ . '/../../model/login/modellogin.php';

$lg = new Login();


if (isset($_POST['op'])) {

    if ($_POST['op'] == 1) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $res = $lg->login($email, $senha);
        echo $res;
    }
}
