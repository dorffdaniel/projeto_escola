
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

    if ($.fn.DataTable.isDataTable('#tabelaDEfuncAtivos')) {
        $('#tabelaDEfuncAtivos').DataTable().destroy();
    }

    let idTurm = $("#turma").val();

    if (idTurm == "-1") {
        alerta("warning", "Selecione uma turma");
        return;
    }

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

            let mens = `<tr>`;
            mens += `<td> ${msg.nome} </td>`
            mens += `<td> not </td>`
            mens += `<td> not2 </td>`
            mens += `<td> not3 </td>`
            mens += `<td> not4 </td>`
            mens += `<td> notf </td>`
            mens += `<td> botoes </td>`
            mens += `</tr>`;


            $("#resTabelaAluno").html(mens);

            $('#tabelaDEfuncAtivos').DataTable({
                responsive: true,
                autoWidth: false
            });

            if (msg.erro) {
                alerta("warning", msg.erro);
                return;
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })
}


$(() => {
    getTurmas();
})