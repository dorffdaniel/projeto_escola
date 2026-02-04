
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


function getTurmasParaCadAlunos() {
    let dados = new FormData();

    dados.append('op', 'getTurmasParaCadAlunos');

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

            let op = `<option value='-1'>Selecione uma turma</option>`;

            resp.forEach(el => {
                op += `<option value='${el.idTurm}'> ${el.nome}  - ${el.ano} </option>`
            });

            $("#turmaCadAlun").html(op);
        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}


function cadastrarAlunos() {
    let dados = new FormData();
    let turma = $("#turmaCadAlun").val();
    let nome = $("#nomeAlunCad").val();
    let dtNasc = $("#dataAlunCad").val();
    let telef = $("#telAlunCad").val();
    let end = $("#endAlunCad").val();

    if (turma == '-1') {
        alerta("warning", "Selecione uma turma");
        return;
    }

    dados.append('op', 'cadastrarAlunos');
    dados.append('turma', turma);
    dados.append('nome', nome);
    dados.append('dtNasc', dtNasc);
    dados.append('telef', telef);
    dados.append('end', end);

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
            console.log(resp);

            if (resp.msg) {
                alerta("success", resp.msg);
                $("#turmaCadAlun").val("-1");
                $("#nomeAlunCad").val("");
                $("#dataAlunCad").val("");
                $("#telAlunCad").val("");
                $("#endAlunCad").val("");
            } else {
                console.log(resp.erro);
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}





$(() => {
    getTurmasParaCadAlunos();
})