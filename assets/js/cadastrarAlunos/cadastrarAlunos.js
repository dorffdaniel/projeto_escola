
function cadastrarTurma() {
    let dados = new FormData();
    let turma = $("#novaTurma").val();

    let data = new Date();
    let ano = data.getFullYear();

    if (!turma) {
        alerta("error", "Preencha o campo da turma");
        return;
    }


    dados.append('op', 'cadastrarTurma');
    dados.append('turma', turma);
    dados.append('ano', ano);

    $.ajax({
        url: 'assets/controller/cadastroAlunos/cadastroAlunos.php',
        method: 'Post',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (resp) {
            console.log(resp)
            if (resp.msg) {
                alerta("success", resp.msg);
                $("#novaTurma").val("");
            } else {
                console.log(resp.erro);
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}