
function getTurmas() {
    let dados = new FormData();
    dados.append('op', 'getTurma');

    $.ajax({
        url: 'assets/controller/lancamentoNota/controllerLanc.php',
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

            resp.msg.forEach((el, index) => {
                op += `<option value='${el.idTurm}'> ${el.nome} - ${el.ano}  </option>`

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


function getAlunosPorTurma() {
    let idTurm = $("#turma").val();
    let dados = new FormData();
    dados.append('idTurm', idTurm);
    dados.append('op', 'getAlunoTurma')

    $.ajax({
        url: 'assets/controller/lancamentoNota/controllerLanc.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            console.log(msg)
        })


        .fail(function (textStatus) {
            console.log(textStatus)
        })
}


$(() => {
    getTurmas();
})