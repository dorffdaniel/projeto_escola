
function getColaborador() {
    let dados = new FormData();
    dados.append('op', 'getColab');

    $.ajax({
        url: 'assets/controller/colaborador/controllerColab.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (resp) {

            if (resp.erro) {
                console.log(resp.erro);
            }

            console.log(resp)
            console.log(resp.nome)
            $("#nomeColab").html(resp.nome);
            $("#cpfColab").html(resp.cpf);
            $("#dtNascColab").html(resp.dataNasc);
            $("#emailColab").html(resp.email);
            $("#telColab").html(resp.telefone);
            $("#endColab").html(resp.endereco);
        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}

function getTurmas() {
    let dados = new FormData();
    dados.append('op', 'getTurma');

    $.ajax({
        url: 'assets/controller/colaborador/controllerColab.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false

    })

        .done(function (resp) {

            let op = '<option value="-1">selecione uma turma </option>';

            console.log(resp)

            resp.msg.forEach((el) => {
                op += `<option value="${el.id}"> ${el.nome} - ${el.ano}  </option>`
            })

            $("#turma").html(op);

            if (resp.erro) {
                console.log(resp.erro);
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })


}




$(() => {
    getColaborador();
    getTurmas();
})