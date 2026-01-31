
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
            if (msg.length > 0) {
                msg.forEach(el => {
                    mens += `<td class="text-center"> ${el.nome} </td>`
                    mens += `<td class="text-center">${el.nota_b1 || ''} </td>`
                    mens += `<td class="text-center">${el.nota_b2 || ''}</td>`
                    mens += `<td class="text-center">${el.nota_b3 || ''}</td>`
                    mens += `<td class="text-center">${el.nota_b4 || ''}</td>`
                    mens += `<td class="text-center"></td>`
                    mens += `<td class="text-center"> 
                <button class="btn btn-warning">editar</button>
                <button class="btn btn-success">info</button>
                <button class="btn btn-danger">apgar</button>
                </td>`
                    mens += `</tr>`;
                })
            } else {
                mens += `<td class="text-center"> Sem alunos</td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"> 
                </td>`
                mens += `</tr>`;
            }



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



function getTodosAlunos() {
    if ($.fn.DataTable.isDataTable('#tabelaDEfuncAtivos')) {
        $('#tabelaDEfuncAtivos').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append('op', 'getTodosAlunos');

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
            console.log(resp)

            let mens = `<tr>`;
            if (resp.length > 0) {
                resp.forEach(el => {
                    mens += `<td class="text-center"> ${el.nome} </td>`
                    mens += `<td class="text-center">${el.nota_b1 || ''}</td>`
                    mens += `<td class="text-center">${el.nota_b2 || ''}</td>`
                    mens += `<td class="text-center">${el.nota_b3 || ''}</td>`
                    mens += `<td class="text-center">${el.nota_b4 || ''}</td>`
                    mens += `<td class="text-center"></td>`
                    mens += `<td class="text-center"> 
                <button class="btn btn-warning">editar</button>
                <button class="btn btn-success">info</button>
                <button class="btn btn-danger">apgar</button>
                </td>`
                    mens += `</tr>`;
                })
            } else {
                mens += `<td class="text-center"> sem alunos </td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center">
                </td>`
                mens += `</tr>`;
            }

            $("#resTabelaAluno").html(mens);

            $('#tabelaDEfuncAtivos').DataTable({
                responsive: true,
                autoWidth: false
            });


        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })
}



$(() => {
    getTurmas();
    getTodosAlunos();
})