
function login() {
    let emailLogin = $("#emailLogin").val().trim();
    let senha = $("#senhaLogin").val().trim()
    let dados = new FormData();

    if (!emailLogin.trim() || !senha.trim()) {
        alerta("error", "Campo vazio");
        return;
    }

    dados.append('email', emailLogin);
    dados.append('senha', senha);
    dados.append('op', 'login');

    $.ajax({
        url: 'assets/controller/login/controllerlogin.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (resp) {

            console.log(resp);

            if (resp.msg) {
                alerta("success", "Bem-vindo")
                setTimeout(() => {
                    window.location.href = './colaborador.php';
                }, 1500);

            } else if (resp.erro) {
                alerta("error", resp.erro);
            }

        })

        .fail(function (jqXHR, textStatus) {
            console.log(textStatus)
        })
}


function logout() {
    let dados = new FormData();
    dados.append('op', 'logout');

    $.ajax({
        url: 'assets/controller/login/controllerlogin.php',
        method: 'POST',
        data: dados,
        dataType: 'html',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (res) {

            alerta("success", res);
            console.log(res)

            setTimeout(() => {
                window.location.href = 'index.php';
            }, 1500);

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}
