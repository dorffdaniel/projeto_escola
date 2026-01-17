
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
    dados.append('op', 1);

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
                window.location.href = './colaborador.php';
            } else if (resp.erro) {
                alerta("error", resp.erro);
            }

        })

        .fail(function (jqXHR, textStatus) {
            console.log(textStatus)
        })
}
