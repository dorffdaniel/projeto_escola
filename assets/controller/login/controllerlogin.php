<?php

require_once __DIR__ . '/../../model/login/modellogin.php';

$lg = new Login();


if (isset($_POST['op'])) {

    if ($_POST['op'] == 'login') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $res = $lg->login($email, $senha);
        echo $res;
    } else if ($_POST['op'] == 'logout') {
        $res = $lg->logout();
        echo $res;
        exit;
    }
}
