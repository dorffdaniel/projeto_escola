function btnCadastrar() {
    $("#cardLogin").addClass('ocultar');
    $("#cardCad").removeClass('ocultar');

}

function btnLogin() {
    $("#cardCad").addClass('ocultar');
    $("#cardLogin").removeClass('ocultar');
}

function cadastrar() {
    let nome = $('#nomeCad').val()
    let cpf = $('#cpfCad').val()
    let dtNasc = $('#dataCad').val()
    let email = $('#emailCad').val()
    let tel = $('#telCad').val()
    let end = $('#endCad').val()
    let senha = $('#senhaCad').val()
    let imgPerfil = $("#imgPerfil")[0].files[0];

    let dados = new FormData();
    dados.append('nome', nome)
    dados.append('cpf', cpf)
    dados.append('dtNasc', dtNasc)
    dados.append('email', email)
    dados.append('tel', tel)
    dados.append('end', end)
    dados.append('senha', senha)
    dados.append('imgPerfil', imgPerfil)
    dados.append('op', 1)


    $.ajax({
        url: 'assets/controller/cadastro/controllerCad_professor.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (resp) {

            if (resp.status) {
                alerta("success", resp.msg);
            } else {
                console.log(resp);
            }

        })

        .fail(function (jqXHR, textStatus) {
            console.log(textStatus)
        })

}